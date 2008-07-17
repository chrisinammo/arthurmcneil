<?php
/**
* Plugin element to render fields
* @package fabrikar
* @author Rob Clayburn
* @copyright (C) Rob Clayburn
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();


class FabrikModelFabrikRadiobutton  extends FabrikModelElement {

	var $_pluginName = 'radiobutton';
	
	var $hasLabel = false;
	/**
	* Constructor
	*/

	function __construct()
	{
		$this->hasSubElements = true;
		parent::__construct();
	}
	
	/**
	 * shows the data formatted for the table view
	 * @param string data
	 * @param object all the data in the tables current row
	 * @return string formatted value
	 */
	
	function renderTableData( $data, $oAllRowsData )
	{
		$str = '';
		if (strstr( $data, $this->_groupSplitter )) {
			$data = explode($this->_groupSplitter, $data);
			foreach ($data as $d) {
				$str .= $this->_renderTableData( $d, $oAllRowsData ) . "<br/>";			
			}
		} else {
			$str .= $this->_renderTableData( $data, $oAllRowsData );
		}
		return $str;
	}
	

	function _renderTableData( $data, $oAllRowsData )
	{
		$element =& $this->getElement();
		$params =& $this->getParams();
		$values = explode( "|", $element->sub_values );
		$labels 	= explode( "|", $element->sub_labels );
		
		//check if the data is in csv format, if so then the element is a multi drop down
		if (strstr( $data, ',' ) && $params->get( 'multiple', 0 ) == 1) {
			$aData = explode(',', $data);
			$sLabels = '';
			foreach ($aData as $tmpVal) {
				if ($params->get('icon_folder') != -1 && $params->get('icon_folder') != '') {
					$sLabels .= $this->_replaceWithIcons($tmpVal). "<br />";
				}else{
					$key = array_search( $tmpVal, $values );
					$sLabels.= $labels[$key]. "<br />";
				}
			}
			return rtrim( $sLabels, "<br />" );
		} else {
			if ($params->get('icon_folder') != -1 && $params->get('icon_folder') != '') {
				return $this->_replaceWithIcons($data). "<br />";
			}else{
				$key = array_search( $data, $values );
				return $labels[$key];
			}
		}
		return $data;
	}
	
	
	/**
	 *  can be overwritten in add on classes
	 * @param mixed thie elements posted form data  
	 * @param array posted form data
	 */
		
	function storeDatabaseFormat( $val, $data )
	{
		$str = '';
		$element = $this->getElement();
		if (is_array( $val )) {
			foreach ($val as $v) {
				if (is_array( $v )) { //repeat group
					foreach ($v as $w) {
						$str .= $w . $this->_groupSplitter;
					}
				} else {
					$str .= $v . $this->_groupSplitter;
				}
			}
			$str = FabrikString::rtrimword($str, $this->_groupSplitter);
		}
		return $str;
	}
	
	/**
	 * draws the form element
	 * @param int repeat group counter
	 * @return string returns element html
	 */
		
	function render( $data, $repeatCounter = 0 ) 
	{
		$elementHTMLName 	= $this->getHTMLName( $repeatCounter );

		$params 					=& $this->getParams();
		$element =& $this->getElement();
		
		$arVals = explode( "|", $element->sub_values );
		$arTxt 	= explode( "|", $element->sub_labels );

		
		$arSelected = $element->default;
		if (!is_array( $arSelected )) {
			$arSelected = array( $element->default );
		}
		$options_per_row = intval( $params->get( 'options_per_row', 0 )); // 0 for one line
		if ($options_per_row > 0) {
			$percentageWidth = floor(floatval(100) / $options_per_row) - 2 ;
			$div = "<div class='fabrik_subelement' style='float:left;width:" . $percentageWidth . "%'>\n";
		}
		$str ="<div class='fabirkElementContainer'>";
		$aRoValues = array();
		for ($ii = 0; $ii < count($arVals); $ii ++) {
			if ($options_per_row > 0 ){
				$str .= $div;
			}
			$thisId = $this->getHTMLId() . "_" . $ii;
			if (in_array( $arVals[$ii], $arSelected )) {
				$aRoValues[] = $arTxt[$ii];
				$checked = "checked=\"checked\"";
			} else {
				$checked = "";
			}
			if ($params->get( 'radio_element_before_label' )  == '1') {
				$str .= "<label><input class='fabrikinput' type=\"radio\" name=\"$elementHTMLName\" value=\"$arVals[$ii]\" id=\"$thisId\" $checked /><span>$arTxt[$ii]</span></label>\n";
			} else {
				$str .= "<label><span>$arTxt[$ii]</span><input type=\"radio\" class='fabrikinput' name=\"$elementHTMLName\" value=\"$arVals[$ii]\" id=\"$thisId\" $checked /></label>\n";
			}
			if ($options_per_row > 0) {
				$str .= "</div> <!-- end row div -->\n";
			}
		}
		if ( !$this->_editable ) {
			return implode( ',', $aRoValues );
		}
		$str .="</div>";
		if ($params->get( 'allow_frontend_addtoradio', false )) {
			$onlylabel = $params->get('rad-allowadd-onlylabel');
			$str .= $this->getAddOptionFields( $onlylabel );
		}
		return $str;
	}
	
	/**
	 * determines the value for the element in the form view
	 * @param array data
	 * @param bol editable element default = true
	 * @param int when repeating joinded groups we need to know what part of the array to access
	 */

	function getDefaultValue( $data, $editable = true, $repeatCounter = 0 )
	{
		$groupModel = $this->_group;
		$formModel 	= $this->_form;
		$element 		=& $this->getElement();
		$tableModel = $this->_table;
		$defaultVal = explode( "|", $element->sub_intial_selection );
		$table =& $tableModel->getTable();
		
	
		if ($groupModel->canRepeat( ) == '1') {
			
			$fullName = $table->db_table_name . $formModel->_joinTableElementStep . $element->name;
			if (isset( $data[$fullName ] )) {
				$defaultVal = $data[$fullName];
				if (is_string($defaultVal) && strstr( $defaultVal, $this->_groupSplitter )) {
					$defaultVal = explode( $this->_groupSplitter, $defaultVal );
				}
				if (is_array( $defaultVal ) && array_key_exists( $repeatCounter, $defaultVal )) {
					$defaultVal = $defaultVal[$repeatCounter];
					$element->default = $defaultVal;
					return $defaultVal;		
				}
			}
		}
		if ($groupModel->isJoin()) {
			$fullName = $this->getFullName( false, true, false );
			if (isset( $data[$fullName ] )) {
				$defaultVal = $data[$fullName];
				if (is_array( $defaultVal ) && array_key_exists( $repeatCounter, $defaultVal )) {
					$defaultVal = $defaultVal[$repeatCounter];	
				}
			}	
		} else {
			$fullName = $table->db_table_name . $formModel->_joinTableElementStep . $element->name;
			if (isset( $data[ $fullName ] )) {
				/* drop down  */
				if (is_array( $data[ $fullName ] )) {
					if (isset( $data[ $fullName ]['value'] )) { 
						/* if not its a file upload el */
						$defaultVal = $data[ $fullName ]['value'];
					} 
				} else {
					$defaultVal = $data[$fullName];
				}
			} else {
				//default should be left as $defaultVal!
				//$defaultVal = '';
			}
		}
		$element->default = $defaultVal;
		return $defaultVal;		
	}	
	
	function getFieldDescription()
	{
		return "TEXT";
	}
	
	/**
	 * render admin settings
	 */

	function renderAdminSettings( )
	{
		$params =& $this->getParams();
		$pluginParams =& $this->getPluginParams();
		$element =& $this->getElement();
		FabrikHelperHTML::script( 'admin.js', 'components/com_fabrik/plugins/element/fabrikradiobutton/', true );
		?>
	<div id="page-<?php echo $this->_name;?>" class="elementSettings" style="display:none">
	<?php 
	FabrikHelperAdminHTML::subElementFields( $element );
	echo $pluginParams->render( );
	?>
	<fieldset>
		<legend><?php echo JText::_('Sub elements');?></legend>
		<a class="addButton" href="#" id="addRadio"  style="text-align:right"><?php echo JText::_('Add'); ?></a>
		<div id="rad_subElementBody">
		</div>
	</fieldset>
	</div>
	<?php

	}
	
	function getAdminJS()
	{
		$element =& $this->getElement();
		$script  = "\tvar fabrikradiobutton = new fabrikAdminRadiobutton();\n".
		"\tpluginControllers.push({element:'fabrikradiobutton', controller: fabrikradiobutton});\n";
		$sub_values 	= explode( "|", $element->sub_values ); 
		$sub_texts 	= explode( "|", $element->sub_labels ); 
		$sub_intial_selections = explode( "|", $element->sub_intial_selection );
		
		if (!is_array( $sub_intial_selections )) {
			$sub_intial_selections = array( $sub_intial_selections );
		}
		for ($ii = 0; $ii < count( $sub_values ) && $ii < count( $sub_texts ); $ii ++) {
			if (in_array($sub_values[$ii], $sub_intial_selections)) {
				$bits[] = "[ '".addslashes( $sub_values[$ii ])."', '".addslashes( $sub_texts[$ii] )."', 'checked']";
			} else {
				$bits[] = "['".addslashes( $sub_values[$ii ])."', '".addslashes( $sub_texts[$ii] )."', '']";
			}
		}
		$script .= "\tfabrikradiobutton.addSubElements([";
		$script .= implode(",", $bits) . "]);\n";
		return $script;
	}
		

	/**
	 * used to format the data when shown in the form's email
	 * @param string data
	 * @return string formatted value
	 */
	
	function getEmailValue( $data )
	{
		$params =& $this->getParams();
		$element =& $this->getElement();
		$labels = explode( '|', $element->sub_labels );
		$values = explode( '|',  $element->sub_values );
		//check if the data is in csv format, if so then the element is a multi drop down
		if (strstr( $data, ',' ) && $params->get( 'multiple', 0 ) == 1) {
			$aData = explode(',', $data);
			$sLabels = '';
			foreach ($aData as $tmpVal) {
				$key = array_search( $tmpVal, $values );
				$sLabels.= $labels[$key]. "\n";
			}
			$val = rtrim($sLabels, "\n");
		} else {
			$key = array_search( $data, $values );
			$val = $labels[$key];
		}
		return $val;
	}

	/**
 	* return tehe javascript to create an instance of the class defined in formJavascriptClass
	 * @return string javascript to create instance. Instance name must be 'el'
	 */
	
	function elementJavascript( )
	{
		$params =& $this->getParams();
		$id = $this->getHTMLId();
		$element =& $this->getElement();
		$arSelected = $element->default; 
		$arVals = explode( "|", $element->sub_values );
		$arTxt 	= explode( "|", $element->sub_labels );
		if (is_string( $arSelected )) {
			$arSelected = array($arSelected);
		}
		$opts =& $this->getElementJSOptions();
		$opts->defaultVal = $arSelected;
		$opts->data = array_combine($arVals, $arTxt);
		$opts->allowadd = $params->get( 'allow_frontend_addtoradio', false );
		$opts = FastJSON::encode($opts);
		return "new fbRadio('$id', $opts)";
	}
	
	/**
	 * load the javascript class that manages interaction with the form element
	 * should only be called once
	 * @return string javascript class file
	 */

	function formJavascriptClass( )
	{
		FabrikHelperHTML::script( 'javascript.js', 'components/com_fabrik/plugins/element/fabrikradiobutton/', true );
	}
	
	 /**
	  * Get the table filter for the element
	  * @return string filter html
	  */
	 
	 function getFilter( )
	{
		global $mainframe;
	 	$tableModel  	= $this->_table;
	 	$groupModel		= $this->_group;
	 	$table				=& $tableModel->getTable();
	 	$element			=& $this->getElement();
	 	$origTable 		= $table->db_table_name;
	 	$fabrikDb 		=& $tableModel->getDb();
	 	$params 			=& $this->getParams( );
	 	$formModel		= $tableModel->getForm();
		$js 					= ""; 
		$elName 		= $this->getFullName( false, true, false );
		$dbElName		= $this->getFullName( false, false, false );
		$elName2 		= $this->getFullName( false, false, false );
		$ids 				= $tableModel->getColumnData( $elName2 );
		//for ids that are text with apostrophes in
	 	for($x=0;$x<count($ids);$x++){
			$ids[$x] = addSlashes($ids[$x]);	
		}
		$elLabel				= $element->label;
		$elExactMatch 	= $element->filter_exact_match;
		$v 				= $elName . "[value]";
		$t 				= $elName . "[type]";
		$e 				= $elName . "[match]";
		$jt 			= $elName . "[join_db_name]";
		$jk 			= $elName . "[join_key_column]";
		$jv 			= $elName . "[join_val_column]";
		$origDate 		= $elName . "[filterVal]";
		$fullword 		= $elName . "[full_words_only]";
		//corect default got
		$default = $this->getDefaultFilterVal( $origTable, $elName, $tableModel->_aFilter );
		
		$aThisFilter = array();
	
		//filter the drop downs lists if the table_view_own_details option is on
		//other wise the lists contain data the user should not be able to see
		// note, this should now use the prefilter data to filter the list

		/* check if the elements group id is on of the table join groups if it is then we swap over the table name*/
		$fromTable = $origTable;
		$joinStr = $tableModel->_buildQueryJoin();
		
		foreach ( $tableModel->_aJoins as $aJoin ) {
		/** not sure why the group id key wasnt found - but put here to remove error **/
			if ( array_key_exists( 'group_id', $aJoin ) ) {
				if ($aJoin->group_id == $element->group_id && $aJoin->element_id == 0) {
					$fromTable = $aJoin->table_join;
					$elName = str_replace( $origTable . '.', $fromTable . '.', $elName);
					$v = $fromTable . '___' . $element->name . "[value]";
					$t = $fromTable . '___' . $element->name . "[type]";
					$e = $fromTable . '___' . $element->name . "[match]";
					$fullword = $elName . "[full_words_only]";
				}
			}
		}		
		/* elname should be in format table.key add quotes:*/
		$dbElName = explode(".", $dbElName);
		$dbElName = "`" . $dbElName[0] . "`.`" . $dbElName[1] . "`";
		
		$sql = "SELECT DISTINCT( $dbElName ) AS elText, $dbElName AS elVal FROM `$origTable` $joinStr\n";
		$sql .= "WHERE $dbElName IN ('" . implode( "','", $ids ) . "')"
			. "\n AND TRIM($dbElName) <> '' GROUP BY elText ASC";
		
		$context = "com_fabrik.table." . $tableModel->_id . ".filter." . trim($elName);
		$default = $mainframe->getUserStateFromRequest( $context, trim($elName), $default );
		if (!is_array( $default )) {
			$default = array( 'value' => '' );
		}
		$values = explode( "|", $element->sub_values );
		$labels 	= explode( "|", $element->sub_labels );
		
		switch ( $element->filter_type )
		{
			case "range":
				if (!is_array( $default )) {
					$default = array( 'value' => array( '', '' ) );
				}
				$fabrikDb->setQuery( $sql );
				$oDistinctData = $fabrikDb->loadObjectList( );
				echo $fabrikDb->getErrorMsg( );
				
				$usedVals = array();
				$options[] = JHTML::_( 'select.option', '', JText::_( 'Please select' ) );
				foreach ($oDistinctData as $pair) {
					$a = explode( ",", $pair->elVal );
					foreach ($a as $val) {
						if (!in_array( $val,$usedVals )) {
							$usedVals[] = $val;
							$key = array_search( $val, $values );
							$options[] = JHTML::_( 'select.option', $val, $labels[$key] );
						}
					}
				}
				$attribs = 'class="inputbox" size="1" ';
				$return = JHTML::_('select.genericlist', $options , $v.'[]', 'class="inputbox fabrik_filter" size="1" ' . $js , "value", 'text', $default['value'][0], $element->name . "_filter_range_0");
				$return .= JHTML::_('select.genericlist', $options , $v.'[]', 'class="inputbox fabrik_filter" size="1" ' . $js , "value", 'text', $default['value'][1], $element->name . "_filter_range_0");
				break;				
				
			case "dropdown":
				$fabrikDb->setQuery( $sql );
				$oDistinctData = $fabrikDb->loadObjectList( );
				echo $fabrikDb->getErrorMsg( );
				
				$usedVals = array();
				$options[] = JHTML::_( 'select.option', '', JText::_( 'Please select' ) );
				foreach ($oDistinctData as $pair) {
					$a = explode( ",", $pair->elVal );
					foreach ($a as $val) {
						if (!in_array( $val,$usedVals )) {
							$usedVals[] = $val;
							$key = array_search( $val, $values );
							$options[] = JHTML::_( 'select.option', $val, $labels[$key] );
						}
					}
				}
				
				$return = JHTML::_('select.genericlist', $options , $v, 'class="inputbox fabrik_filter" size="1" ' , "value", 'text', $default);				
				break;
				
			case "field":
				$default = $default['value'];
				$return = "<input type='text' class='inputbox fabrik_filter' name='$v' value='$default'   />";	
				break;

			}
		$return .= "\n<input type='hidden' name='$t' value='$element->filter_type' />\n";
		$return .= "\n<input type='hidden' name='$e' value='$elExactMatch' />\n";
		$return .= "\n<input type='hidden' name='$fullword' value='" . $params->get('full_words_only', '0') . "' />\n";	 
		return $return;
	 }
	 
 /**
  * Get the sql for filtering the table data and the array of filter settings
  * @param string filter value
  * @return string filter value
  */
	
	 function prepareFilterVal( $val )
	 {
	 	$element =& $this->getElement();
	 	$arVals = explode( "|", $element->sub_values );
		$arTxt 	= explode( "|", $element->sub_labels );
		for ($i=0; $i<count($arTxt); $i++) {
			if (strtolower( $arTxt[$i] ) == strtolower( $val )) {
				$val =  $arVals[$i];
				return $val;
			}
		}
	 	return $val;
	 }
	 
	/**
	 * trigger called when a row is stored
	 * check if new options have been added and if so store them in the element for future use
	 * @param array data to store
	 */
	
	function onStoreRow(&$data)
	{
		$element =& $this->getElement();
		$params =& $this->getParams();
		if ($params->get('rad-savenewadditions')) {
			$added = stripslashes($data[$element->name . '_additions']);
			
   		$json = new Services_JSON();
			$added = $json->decode($added);
			$arVals = explode( "|", $element->sub_values );
			$arTxt 	= explode( "|", $element->sub_labels );
			//$data = explode($this->_groupSplitter2, $data[$element->name]);
			$found = false;
			foreach ($added as $obj) {
				if (!in_array($obj->val, $arVals)) {
					$arVals[] = $obj->val;
					$found = true;
					$arTxt[] = $obj->label;
				}
			}
			
			if($found)
			{
				$element->sub_values = implode("|", $arVals);
				$element->sub_labels = implode("|", $arTxt);
				$element->store();
			}
		}
	}

}	
?>