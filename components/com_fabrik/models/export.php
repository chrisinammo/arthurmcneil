<?php
/**
* @package Joomla
* @subpackage Fabrik
* @copyright Copyright (C) 2005 Rob Clayburn. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

jimport('joomla.application.component.model');
require_once(COM_FABRIK_FRONTEND.DS.'helpers'.DS.'string.php');


class FabrikModelExport {
	
	var $label				= '';
	var $tableIds 			= array();
	var $format 			= 'xml';
	var $includeData 		= false;
	var $fabrikData 		= false;
	var $incTableStructure  = false;
	
	var $packageModel = null;
	var $_aTables 			= array();
	var $_aFiles			= array();
	
	/**
	 * load a package for export
	 *
	 * @param int $id
	 */
	function load( $id )
	{
		$this->packageModel =& JModel::getInstance( 'Package', 'FabrikModel' );
		$this->packageModel->setId( $id );
		$this->packageModel->getPackage();
		$this->packageModel->loadTables();	
		$this->format  		= JRequest::getVar( 'format', 'xml' );
		$this->includeData 	= JRequest::getVar( 'tabledata', false );
		$this->fabrikData 	= JRequest::getVar( 'fabrikfields', false );
		$this->label		 	= JRequest::getVar( 'label', '' );
		$this->incTableStructure = JRequest::getVar( 'tablestructure', false );
		$this->setBufferFile( );
	}
    
	 /**
	 * export table data 
	 * @param string export format xml/csv
	 * @param bol export the table actual records
	 * @param bol export the msoform records associated with the table (group.elements, forms etc)
	 * @param bol save the exported file as a zip
	 */
	 
	function export( ){
		$db =& JFactory::getDBO();
		switch( $this->format ){
			case 'csv':
				$this->_csvExport( );
				break;
			case 'xml':
			default:
				$xml = $this->_buildXML( );
				$this->_xmlExport( $xml );
				break;
		}	
	}
	
	/**
	 * collates the template files
	 * @return string xml string
	 */
	 
	 function getTemplateFiles( ){
	 	
	 	$templatePath = JPATH_SITE . '/components/com_fabrik/tmpl/form/' ;
	 	$aFiles = array();
	 	foreach( $this->_aTables as $tableModel ){
	 		$table =& $tableModel->getTable();
	 		$formModel =& $tableModel->getForm();
	 		$form =& $formModel->getForm();
	 		if (!in_array( 'table/' . $table->template, $aFiles)) {
	 			$aFiles[] = 'table/' . $table->template;
	 		}
	 		if ($form->form_template != '') {
	 			if( is_dir( $templatePath . $form->form_template )) {
	 				if( !in_array( 'form/' . $form->form_template . '/elements.html', $aFiles) ){
	 					$aFiles[] = 'form/' . $form->form_template . '/elements.html';
	 				}
	 				if( !in_array( 'form/' . $form->form_template . '/form.html', $aFiles) ){
	 					$aFiles[] = 'form/' . $form->form_template . '/form.html';
	 				}
	 			} else {
	 				if( !in_array( 'form/' . $form->form_template, $aFiles) ){
	 					$aFiles[] = 'form/' . $form->form_template;
	 				}
	 			}
	 		}
	 		if ($form->view_only_template != '') {
	 			if (is_dir( $templatePath . $form->view_only_template )) {
	 				if (!in_array( 'viewonly/' . $form->view_only_template . '/elements.html', $aFiles )) {
	 					$aFiles[] = 'viewonly/' . $form->view_only_template . '/elements.html';
	 				}
	 				if (!in_array( 'viewonly/' . $form->view_only_template . '/form.html', $aFiles )) {
	 					$aFiles[] = 'viewonly/' . $form->view_only_template . '/form.html';
	 				}
	 			} else {
	 				if( !in_array( 'viewonly/' . $form->view_only_template, $aFiles) ){
	 					$aFiles[] = 'viewonly/' . $form->view_only_template;
	 				}
	 			}
	 		}
	 	}
	 	$xml = "<files>\n";
	 	foreach ($aFiles as $file) {
			$xml .= "\t<file>tmpl/$file</file>\n";
	 	}
	 	$this->_aFiles = $aFiles;
	 	$xml .= "</files>\n";	
	 	return $xml;
	 }
	 
	/**
	 * builds the xml installer file for a given table
	 * @return string xml file
	 */
	 
	function _buildXML( ){
		
		$db = &JFactory::getDBO();
		$this->clearExportBuffer();
		$strXML = "<?xml version=\"1.0\" ?>\n";
		$strXML .= "<install type=\"fabrik\" version=\"2.0\">\n";
		
		$strXML .= "<creationDate>" . JRequest::getVar( 'creationDate', '', 'post' ) . "</creationDate>\n";
	   	$strXML .= "<author>" . JRequest::getVar( 'creationDate', '', 'author' ) . "</author>\n";
	   	$strXML .= "<copyright>" . JRequest::getVar( 'creationDate', '', 'copyright' ) . "</copyright>\n";
	   	$strXML .= "<authorEmail>" . JRequest::getVar( 'creationDate', '', 'authoremail' ) . "</authorEmail>\n";
	   	$strXML .= "<authorUrl>" . JRequest::getVar( 'creationDate', '', 'authorurl' ) . "</authorUrl>\n";
	   	$strXML .= "<version>" . JRequest::getVar( 'creationDate', '', 'version' ) . "</version>\n";
	   	$strXML .= "<liscence>" . JRequest::getVar( 'creationDate', '', 'license' ) . "</liscence>\n";
	   	$strXML .= "<description>" . JRequest::getVar( 'creationDate', '', 'description' ) . "</description>\n";
	   	
		$aTableObjs = array();

		$tables =& $this->packageModel->_tables;
		$forms =& $this->packageModel->_forms;
		if( $this->fabrikData ){
			
			$strXML .= "<tables>\n";
			if(is_array($this->tableIds	)){
				/*foreach( $this->tableIds as $tableId ){
					$tableModel =& JModel::getInstance( 'Table', 'FabrikModel' );
					$tableModel->setId( $tableId );
					$table =& $tableModel->getTable();
					$tableModel->getForm();
					$this->_aTables[] = $tableModel;
					$vars = get_object_vars( $table );
					$strXML .= "\t<table>\n";
					foreach( $vars as $key=>$val ){
						if( substr( $key, 0, 1) != '_' ){
							$strXML .= "\t\t<$key><![CDATA[$val]]></$key>\n";
						}	
					}
					$strXML .= "\t</table>\n";
				}*/
				foreach ($tables as $table) {
					$vars = get_object_vars( $table );
					$strXML .= "\t<table>\n";
					foreach( $vars as $key=>$val ){
						if( substr( $key, 0, 1) != '_' ){
							$strXML .= "\t\t<$key><![CDATA[$val]]></$key>\n";
						}	
					}
				}
			}
			$strXML .= "</tables>\n\n";
			
			$strXML .= "<forms>\n";
			/*foreach( $this->_aTables as $tableModel ){
				$form = $tableModel->_oForm->getForm();
				$vars = get_object_vars( $form );
				$strXML .= "\t<form>\n";
				foreach( $vars as $key=>$val ){
					if( substr( $key, 0, 1) != '_' ){
						$strXML .= "\t\t<$key><![CDATA[$val]]></$key>\n";
					}
				}
				$strXML .= "\t</form>\n";
			}*/
			foreach ($forms as $form) {
				$vars = get_object_vars( $form );
				$strXML .= "\t<form>\n";
				foreach( $vars as $key=>$val ){
					if( substr( $key, 0, 1) != '_' ){
						$strXML .= "\t\t<$key><![CDATA[$val]]></$key>\n";
					}
				}
				$strXML .= "\t</form>\n";
			}
			$strXML .= "</forms>\n\n";
			
			$strElementXML 		= "<elements>\n";
			$strXML 			.= "<groups>\n";
			$strValidationXML 	= "<validations>\n";
			foreach( $this->_aTables as $tableModel ){
				$groups = $tableModel->_oForm->getGroupsHiarachy( false, false );
				
				$i = 0;
				foreach( $groups as $groupModel ){
					$group =& $groupModel->getGroup();
					$vars = get_object_vars( $group );
					$strXML .= "\t<group form_id=\"" . $tableModel->_oForm->_id  ."\" ordering=\"" . $i  ."\">\n";
					foreach( $vars as $key=>$val ){
						//dont insert join_id as this isnt in the group table
						if( $key != "join_id" ){
							if(substr( $key, 0, 1 ) != '_' ){
								$strXML .= "\t\t<$key><![CDATA[$val]]></$key>\n";
							}
						}	
					}
					$strXML .= "\t</group>\n";
					
					foreach( $groupModel->_aElements as $elementModel ){
						$element =& $elementModel->getElement();
						$vars = get_object_vars( $element );
						$strElementXML .= "\t<element>\n";
						foreach( $vars as $key=>$val ){
							if( substr( $key, 0, 1) != '_' ){
								$strElementXML .= "\t\t<$key><![CDATA[$val]]></$key>\n";
							}	
						}
						$strElementXML .= "\t</element>\n\n";
						
						foreach( $elementModel->_aValidations as $oValidation ){
							$vars = get_object_vars( $oValidation );
							$strValidationXML .= "\t<validation>\n";
							foreach( $vars as $key=>$val ){
								if( substr( $key, 0, 1) != '_' ){
									$strValidationXML .= "\t\t<$key><![CDATA[$val]]></$key>\n";
								}	
							}
							$strValidationXML .= "\t</validation>\n\n";
						}
					}
					$i++;
				}
			}
			$strXML 			.= "</groups>\n";
			$strElementXML 		.= "</elements>\n\n";
			$strValidationXML 	.= "</validations>\n\n";
			$strXML .= $strElementXML . $strValidationXML;
					
		}
		$this->writeExportBuffer( $strXML );
		if( $this->incTableStructure ){
			$strXML = $this->_createTablesXML( $strXML );
		}
		$strXML .= $this->getTemplateFiles( );
		$strXML .= "</install>";
		$this->writeExportBuffer( $strXML );	
	}
	
	/**
	 * 
	 */
	 
 function _createTablesXML( ){
	 	$strXML = "<queries>\n";
		for($i=0;$i<count($this->_aTables);$i++){
	 		$tmpTable = $this->_aTables[$i];
	 		$this->writeExportBuffer( "\t<query>" . $tmpTable->getDropTableSQL() . "</query>\n" ); 
	 		$this->writeExportBuffer("\t<query>" . $tmpTable->getCreateTableSQL() . "</query>\n" );
	 		if( $this->includeData ){
				$tmpTable->getInsertRowsSQL( $this );
	 		}
	 	}
	 	$this->writeExportBuffer("</queries>\n");
	 }
	 
	 function clearExportBuffer(){
	 	if(file_exists( $this->_bufferFile )){
	 		unlink( $this->_bufferFile );
	 	}
	 }
	 
	 function setBufferFile( ){
	 	 
	 	// doesnt work in windowz
	 	//$this->_bufferFile = '/tmp/fabrik_package-' . $this->label . '.xml';
		$this->_bufferFile = JPATH_SITE . "/administrator/components/com_fabrik/fabrik_package-". $this->label . '.xml';
	 }
	 
	 function writeExportBuffer( $str ){
	 	
	 	$filename =  $this->_bufferFile;
		// Let's make sure the file exists and is writable first.
		if (file_exists( $filename )){
			if(!is_writable($filename)) {
				return JError::raiseError( 500, JText::sprintf("The file %s is not writable", $filename));
			}
		}
		if (!$handle = fopen($filename, 'a')) {
			return JError::raiseError( 500, JText::sprintf("Cannot open file (%s)", $filename));
		}
	
    // Write $somecontent to our opened file.
    if (fwrite($handle, $str) === FALSE) {
			return JError::raiseError( 500, JText::sprintf("Cannot  write to file (%s)", $filename));
		}
		fclose($handle);
	}
	 
	/**
	 * 
	 */
	
	function _xmlExport( $xml ){
		
		$archieveName =  'fabrik_package-' . $this->label;
		require_once( JPATH_SITE . '/includes/Archive/Tar.php' );
		
		$archievePath = JPATH_SITE. '/components/com_fabrik/' . $archieveName . '.tgz';
		if(file_exists($archievePath)){
			@unlink($archievePath);
		}
		$zip = new Archive_Tar( $archievePath );
		$fileName =  $archieveName . '.xml';
		$fileName = $this->_bufferFile;
		//$ok = $zip->addModify('/tmp/' . $fileName, '', "/tmp/");
		//, '', dirname( $fileName)  . "/"
		$fileName = str_replace(JPATH_SITE, '', $this->_bufferFile);
		$fileName = FabrikString::ltrimword($fileName, "/administrator/");
		$ok = $zip->addModify( $fileName, '', "components/com_fabrik" );
		for( $i = 0;$i<count( $this->_aFiles );$i++ ){
			$this->_aFiles[$i] = JPATH_SITE. '/components/com_fabrik/tmpl/' . $this->_aFiles[$i];
		}
		$zip->addModify($this->_aFiles, '', JPATH_SITE. '/components/com_fabrik');
		$this->_output_file($archievePath, $archieveName . '.tgz');
	}
	
	function _csvExport( ){
		$db =& JFactory::getDBO();
		initGzip();
		$tableModel =& JModel::getInstance( 'Table', 'FabrikModel' );
		$tableModel->setAdmin( false );
		$id 	= $this->tableIds[0];
		$tableModel->setId( $id );
		$tableModel->_outPutFormat = 'csv';
		$table =& $tableModel->getTable();
		header('Content-Type: text/plain');
		header('Content-Disposition: attachment; filename="' . $table->label . '-export.csv"');
		$aTable 	= JArrayHelper::fromObject( $table );
		$fabrikDb 	=& $tableModel->getDb();
		$table 		= $table->db_table_name;
		$sql 				= "SELECT * FROM $table";
		$fabrikDb->setQuery( $sql );
		$elementData 	= $fabrikDb->loadObjectList( );
		//TODO: replace switchDb 
		//$aNewDbInfo 	= switchDatabase( $oTable, $oConn );
		//$fabrikDb 		= $aNewDbInfo[0];
		//$table 			= $aNewDbInfo[1];	
		$aFilter 		= array();
		$tableModel->getForm( );
		$tableModel->getFormGroupElementData();
		
		$tableModel->getParams();
		$limitLength 	= $tableModel->getTotalRecords( );
		$pageNav 		= $tableModel->_getPagination( count($elementData), 0, $limitLength );
		$formdata 		= $tableModel->getData( );
		if ( is_array( $formdata ) ) {
			$firstrow = JArrayHelper::fromObject( $formdata[0][0] );
			if ( is_array( $firstrow ) ){
				echo implode( ",", array_keys( $firstrow ) );
			}
			foreach( $formdata as $group ){
				foreach( $group as $row ){
					echo "\n";
					echo implode(",", array_map(array($this, "_quote"), array_values(JArrayHelper::fromObject($row))));
				}
			}
		}
		doGzip();
	}
	
	function _quote($n) {
		return '"'.str_replace('"', '""', $n).'"'; 
	}
	
	
	function _output_file( $file, $name ){
		/*do something on download abort/finish
		register_shutdown_function( 'function_name'  );*/
		if(!file_exists($file))
			die('file not exist!');
		$size = filesize($file);
		$name = rawurldecode($name);
	
		if (ereg('Opera(/| )([0-9].[0-9]{1,2})', $_SERVER['HTTP_USER_AGENT']))
			$UserBrowser = "Opera";
		elseif (ereg('MSIE ([0-9].[0-9]{1,2})', $_SERVER['HTTP_USER_AGENT']))
			$UserBrowser = "IE";
		else
			$UserBrowser = '';
	
		/* important for download im most browser */
		$mime_type = ($UserBrowser == 'IE' || $UserBrowser == 'Opera') ?
		 'application/octetstream' : 'application/octet-stream';
		@ob_end_clean(); 
		/* decrease cpu usage extreme */
		header('Content-Type: ' . $mime_type);
		header('Content-Disposition: attachment; filename="'.$name.'"');
		header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		header('Accept-Ranges: bytes');
		header("Cache-control: private");
		header('Pragma: private');
		
		/* multipart-download and resume-download */
		if(isset($_SERVER['HTTP_RANGE'])){
			list($a, $range) = explode("=",$_SERVER['HTTP_RANGE']);
			str_replace($range, "-", $range);
			$size2 = $size-1;
			$new_length = $size-$range;
			header("HTTP/1.1 206 Partial Content");
			header("Content-Length: $new_length");
			header("Content-Range: bytes $range$size2/$size");
		} else {
			$size2=$size-1;
			header("Content-Length: ".$size);
		}
		$chunksize = 1*(1024*1024);
		$this->bytes_send = 0;
		if ($file = fopen($file, 'r')){
			if(isset($_SERVER['HTTP_RANGE']))
				fseek($file, $range);
			while(!feof($file) and (connection_status()==0)){
				$buffer = fread($file, $chunksize);
				print($buffer);
				flush();
				$this->bytes_send += strlen($buffer);
				/*sleep(1); decrease download speed */
			}
		fclose($file);
		
		}else
			die('error can not open file');
		if(isset($new_length))
			$size = $new_length;
	}
}

?>