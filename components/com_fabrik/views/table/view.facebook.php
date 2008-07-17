<?php
/**
* @package Joomla
* @subpackage Fabrik
* @copyright Copyright (C) 2005 Rob Clayburn. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

jimport('joomla.application.component.view');

class FabrikViewTable extends JView{
	
	var $_oTable 	= null;
	var $_data 		= null;
	var $_lists 	= null;
	var $_pageNav 	= null;
	var $_params 	= null;
	var $_aLinkElements = null;
	
	function FabrikViewTable( &$oTable ){
		$this->_oTable = $oTable;
	}
	
	function getManagementJS( $data = array() ){
		global $Itemid;
		
		echo "<script type='text/javascript'>";
		//include "components/com_fabrik/libs/slimbox.js";
		
		include "components/com_fabrik/views/table/table.facebook.js";
		
	//	return;
	//	echo "<style>";
	//	include "components/com_fabrik/css/slimbox/slimbox.css";
	//	echo "</style>";

		$tmpl = JRequest::getVar( 'layout', $this->_oTable->template );
		
		// temporarily set data to load requierd info for js templates

		$origRows 	= $this->rows;
		$this->rows = array(array());
		
		$row 		= new stdClass();
		$row->__pk_val = "{__pk_val}";
		$c = 0;
		foreach( $this->headings as $heading=>$label ){	
			$row->$heading = "{" . $heading . "}";
	 	}
	 	$step  		= ( $this->_oTable->_admin ) ? "../" : "";
	 	$canEdit 	= ( $this->_oTable->canEdit() ) ? "1" : "0";
	 	$canView 	= ( $this->_oTable->canView() ) ? "1" : "0";
	 	if( !isset($Itemid)){ $Itemid = 0;}
	 	
	 	if( file_exists( JPATH_SITE . "/components/com_fabrik/views/table/tmpl/" .$tmpl . "/row.php" ) ){
		 	ob_start();
			// include the requested template filename in the local scope
			require  $step . "components/com_fabrik/views/table/tmpl/" .$tmpl . "/row.php";
			$rowTpl = ob_get_contents();
			ob_end_clean();
	 	}else{
	 		$rowTpl = '';
	 	}
	 	if( file_exists( JPATH_SITE . "/components/com_fabrik/views/table/tmpl/" .$tmpl . "/group.php" ) ){
			ob_start();
			// include the requested template filename in the local scope
			require  $step . "components/com_fabrik/views/table/tmpl/" .$tmpl . "/group.php";
			$groupTpl = ob_get_contents();
			ob_end_clean();
	 	}else{
	 		$groupTpl = '';
	 	}
		
	 	$rowTpl = addslashes( $rowTpl );
	 	$rowTpl = str_replace( array( "\n", "\r", "\n\r", "\t" ), "",  $rowTpl );
	 	
	 	$groupTpl = addslashes( $groupTpl );
	 	$groupTpl = str_replace( array( "\n", "\r", "\n\r", "\t" ), "",  $groupTpl );
		?>
		
		
		var rowTmpl = ("<?php echo $rowTpl; ?> ") ;
		var groupTmpl = ("<?php echo $groupTpl; ?> ");
		oTable = new fabrikTable( <?php echo $this->_oTable->id;?>, 
		{
    			admin:'<?php echo $admin;?>',
				postMethod: '<?php echo $this->_oTable->_postMethod;?>',
				form: '<?php echo  'tableform_' . $this->_oTable->id;?>',
				headings: <?php echo $this->_oTable->_jsonHeadings();?>,
				primaryKey:'<?php echo $this->_oTable->db_primary_key;?>',
				data: <?php echo FastJSON::encode( $data );?>,
				Itemid: <?php echo $Itemid;?>,
				formid:<?php echo $this->_oTable->_oForm->id;?>,
				canEdit: <?php echo $canEdit;?>,
				canView: <?php echo $canView;?>,
				page:'<?php echo 'index.php';?>',
				rowTemplate: rowTmpl,
				groupTemplate: '<?php echo $groupTpl; ?> '
			}
		);
		aGraphs = [];
		<?php
		/* if( $this->_params->get('graph_type') != '' ){
			$jsonData = FastJSON::encode($this->_data);
			$labels = $this->_params->get('chart_label', "", "array");
			$graphs = $this->_params->get('graph_type', "", "array");
			$legends  = $this->_params->get('graph_show_legend', "", "array");
			$axisLabels = $this->_params->get('chart_axis_label', "", "array");
			$colourSchemes = $this->_params->get('graph_colour_scheme', "", "array");
			$orientations = $this->_params->get('bar_orientation', "", "array" );
			$radius = $this->_params->get('pie_radius', "", "array");
			$fillGraphs = $this->_params->get('fill_line_graph', "", "array");
			$chartElements = $this->_params->get('chart_elements', '', 'array');
			$chartElementColours = $this->_params->get('chart_elements_colour', '', 'array');
			$aCalcData = array();
			for($i=0;$i<count($graphs);$i++){
				if(trim($graphs[$i]) != ''){
					$legends[$i] = ( array_key_exists($i, $legends))? $legends[$i] : '0';
					$orientations[$i] = ( array_key_exists($i, $orientations))? $orientations[$i] : 'horizontal';
					$fillGraphs[$i] = ( array_key_exists($i, $fillGraphs))? $fillGraphs[$i] : '1';
					if($colourSchemes[$i] == 'custom'){
						$scheme = " new Hash({";
						for($x=0;$x<count($this->_chartCols[$i]);$x++){
							if(is_array($chartElementColours[$i])){
								$scheme .= "'" . $this->_chartCols[$i][$x]['label'] . "':'" .  $chartElementColours[$i][$x] . "',";
							}else{
								$scheme .= "'" . $this->_chartCols[$i][$x]['label'] . "':'" .  $chartElementColours[$i] . "',";
							}
							if($this->_chartCols[$i][$x]['type'] != 'element'){
								//its a calculation 	
								$cals = $this->calculations[$this->_chartCols[$i][$x]['key']];
								$cals = $cals->obj;
								//remove first total row
								unset($cals['calc']);
								$calcType = $this->_chartCols[$i][$x]['type'];
								$aCalcData[$this->_chartCols[$i][$x]['key']][$calcType] = $cals;
								
							}
						}
						$scheme = ltrim($scheme, ","). "}).obj";
					}else{
						$scheme = "'" . $colourSchemes[$i] . "'";
					}
					?>
					
					var options ={
					legend:  '<?php echo $legends[$i] ;?>',
					aChartKeys: (<?php echo FastJSON::encode($this->_chartCols[$i]);?>),
					axis_label: '<?php echo $axisLabels[$i];?>',
					json:(<?php echo $jsonData;?>),
					calculations:(<?php echo FastJSON::encode($aCalcData);?>),
					label:'<?php echo $labels[$i];?>',
					chartType:'<?php echo $graphs[$i];?>'
					};
			
					var layoutOptions = {
						padding: {left: 30, right: 0, top: 10, bottom: 30},
						backgroundColor: '#f2f2f2',
						colorScheme: <?php echo $scheme;?>,
						barOrientation: '<?php echo $orientations[$i];?>',
						pieRadius: '<?php echo $radius[$i];?>',
						shouldFill: <?php echo $fillGraphs[$i];?>
					}
				
					aGraphs.push(new fabrikGraph('graph_<?php echo $i;?>', options, layoutOptions));
			<?php }

			}
		}*/?>
		
		</script>		
		<?php
		//if( $this->_oTable->_inPackage ){
			echo "<script type=\"text/javascript\">".
			"oTable.addListenTo('form_" . $this->_oTable->_oForm->id . "');\n".
			"oTable.addListenTo('table_" . $this->_oTable->id . "');\n".
			"oPackage.addBlock('table" . $this->_oTable->id . "', oTable);</script>";
		//}

		//reset data back to original settings
		$this->rows = $origRows;
	}
	
	function display()
	{
		global $Itemid;
		$config		=& JFactory::getConfig();
		
		error_reporting(0);
		//facebook specific stuff
		// the facebook client library
		require_once  'components/com_fabrik/libs/facebook-client/facebook.php';
		
		// Get these from http://developers.facebook.com
		$appapikey = '202a65725bc4a7c83a9084a1e9a2b15b';
		$appsecret = 'e4135385bd31130390c661ca4a36c791';
		$facebook = new Facebook($appapikey, $appsecret);
		$user = $facebook->require_login();
	
		$appcallbackurl = 'http://fabrikar.com/versions/2.0/index.php?option=com_fabrik&Itemid=3&format=facebook&format=raw';
		//catch the exception that gets thrown if the cookie has an invalid session_key in it
		try {
		  if (!$facebook->api_client->users_isAppAdded()) {
		    $facebook->redirect($facebook->get_add_url());
		  }
		} catch (Exception $ex) {
		  //this will clear cookies for your application and redirect them to a login prompt
			 $facebook->set_user(null, null);
		  $facebook->redirect($appcallbackurl);
		}
		$facebookid = $facebook->get_loggedin_user();
		$fbXML =    '<fb:narrow>prefabrik - come later fbid='.$facebookid.'</fb:narrow>
		<fb:wide>prefabrik (wide) - come later '.$facebookid.'</fb:wide>';
		$facebook->api_client->profile_setFBML($fbXML, $facebookid);

		if( $this->_admin ){
			$tpl = "admin";
		}
		$this->rows = $model->_tableData;
		
		$this->_includeTemplateCSSFile( $tpl );
		//$inPackage = $this->_oTable->_inPackage;
		$this->table 			= new stdClass();
		$w = new FabrikWorker(); 
		$this->table->label 	= $w->parseMessageForPlaceHolder( $this->_oTable->label, $_REQUEST );
		$this->table->intro 	= $this->_oTable->introduction;
		$this->table->id		= $this->_oTable->id;
		$this->group_by			= $this->_oTable->group_by;
		$this->formid =  'tableform_' . $this->_oTable->id;
		$this->table->action 	=  "index.php?" . str_replace('&', '&amp;', $_SERVER['QUERY_STRING']);
		
		if( $this->_oTable->_postMethod == 'ajax' ){
			$this->table->action .= '&format=raw';
			$this->table->action = str_replace("task=package", "task=viewTable", $this->table->action);
			$this->table->action 	=  $this->table->action ;		
		}
		
		$this->showCSV 			= $this->_oTable->_params->get( 'csv_export_frontend', 0 );
		$this->showCSVImport	= $this->_oTable->_params->get( 'csv_import_frontend', 0);
		$this->nav 				= $this->_pageNav->getListFooter( $this->_oTable->id ) ;
		$this->fabrik_userid 	= $user->get('id');
		$this->canDelete 		= ($this->_oTable->canDelete()) ? true : false; 
		$this->deleteButton = ($this->_oTable->canDelete()) ?  "<input class='button' type='button' onclick=\"$this->jsfilter\" value='" . _DELETE . "' name='delete'/>" : '';
		if ( $this->showCSV ){
			$this->csvLink = "?option=com_fabrik&task=export&format=facebook&tableid=" . $this->_oTable->id . "&";
		}
		
		$this->csvImportLink = ( $this->showCSVImport ) ? JRoute::_("index.php?option=com_fabrik&view=import&fietype=csv&tableid=" . $table->id ) : '';
		$this->showAdd = $this->_oTable->canAdd();
		if($this->showAdd){
			$this->addRecordLink = ( $model->_postMethod == 'ajax' ) ? "#" : ("?option=com_fabrik&view=form&format=facebook&Itemid=$Itemid&fabrik=" . $this->_oTable->form_id . "&tableid=" . $this->_oTable->id ."&rowid=");
		}
		$this->addRecordId = "table_" . $this->_oTable->id . "_addRecord";
		$this->_oTable->_params->get('rss', 0) == 0 ? $this->showRSS = 0 : $this->showRSS = 1;
		if( $this->showRSS ){
			$this->rsslink = $this->_oTable->_rsssLink;
		}
		$this->filter_action = $this->_oTable->filter_action;
		count($this->_lists['filters']) > 0 ? $this->showFilters = '1' : $this->showFilters = '0';
		$filters = array();
		count($this->_lists['filters']) == 0 ? $this->showFilters = 0 : $this->showFilters = 1;
		foreach ( $this->_lists['filters'] as $name => $filter ) {
			$f 			= new stdClass();
			$f->label 	= $name;
			$f->element = $filter;
			$filters[] 	= $f;
		}
		$this->filters = $filters;
		
		$this->emptyDataMessage = $this->_oTable->_params->get( 'empty_data_msg' ) ;
		$aReturn = $this->_getTableHeadings( );
		$aTableHeadings 		= $aReturn[0];
		$aCols 					= $aReturn[1];
		$this->_aLinkElements 	= $aReturn[2];
		$aNamedHeadings 		= $aReturn[3];
		$this->headings 		= $aTableHeadings;
		
		$this->calculations 	= $this->_getCalculations( $aTableHeadings );
		$this->_loadTemplateBottom();
		//below this will be replaced in J1.5 with call to parent class

		//$tpl = $tpl . "template.php";
		
		$this->_templateDir =  "components/com_fabrik/views/table/tmpl/$tpl/"  ;
		if( $this->_admin ){
			$this->_templateDir = '../' . $this->_templateDir;
		}

		if(!is_null($tpl) && file_exists( $this->_templateDir . "template.php")){
			$this->_template = $this->_templateDir . "template.php";
		}else{
			$this->_template =  $this->_templateDir . "/default/template.php";
		}
		
		$this->jsPath = JURI::base()  . "/" . $this->_templateDir .  "/javascript.js";
		$this->getManagementJS( $this->_data );
		$form = $this->_oForm;
		
		
		// start capturing output into a buffer
		ob_start();
		// include the requested template filename in the local scope
		// (this will execute the view ).
		require $this->_template;

		// done with the requested template; get the buffer and
		// clear it.
		$this->_output = ob_get_contents();
		ob_end_clean();
		return $this->_output;
	}
	
	 /**
	  * returns the table headings, seperated from writetable function as
	  * when group_by is selected mutliple tables are written
	* @return array (table headings, array columns, $aLinkElements)
	*/

	 function _getTableHeadings( ){
	 	$user  = &JFactory::getUser();
	 	$session =& JFactory::getSession();
		$aLinkElements = array();
		$aNamedTableHeadings = array( );
		$aTableHeadings 	= array();
		$aCols 				= array();
		foreach( $this->_oTable->_oForm->_groups as $oGroup ){
			foreach( $oGroup->_aElements as $elementModel ){
				$element =& $elementModel->getElement();
				if( $element->show_in_table_summary ){
					
					//hide any elements that should not be access by the user for their group id
					if( $elementModel->canView( ) ){
						
						$key 		= $elementModel->getFullName( false, true, false );
						$orderKey 	= $elementModel->getOrderbyFullName( false, false );
						$aCols[$key] = '';
						if ($element->link_to_detail == '1') {
							$aLinkElements[] = $key;
						}
						if ($element->can_order == '1') {
							$sessionOrderKey = 'tableOrder{' . $option. '}{' . $this->_oTable->id . '}{' . $key . '}';
							$orderDir 	= $session->get( $sessionOrderKey,  '-');
							$class 		= "";
							$currentOrderDir = $orderDir;
							switch($orderDir){
								case "desc":
									$orderDir = "-";
									$class = "class='fabrikorder-desc'";
									break;
								case "asc":
									$orderDir = "desc";
									$class = "class='fabrikorder-asc'";
									break;
								case "-":
									$orderDir = "asc";
									$class = "";
									break;
							}

							if($class == ''){
								if($oTable->order_by == $key){
									if(strtolower($oTable->order_dir) == 'desc'){
										$class = "class='fabrikorder-desc'";
									}
								}	
							}
							
							$heading = "<a $class href='javascript:oTable.fabrikNavOrder(\"$orderKey\", \"$orderDir\")'>$element->label</a>";
						} else {
							$heading = $element->label;
						}
						$aTableHeadings[$key] = $heading;
						$aNamedTableHeadings[$key . "_heading"] = $heading;
					}
				}
			}
		}

		if($this->_oTable->canDelete()){
			$aTableHeadings['fabrik_delete'] = Text::_( 'delete' );
			$aNamedTableHeadings['fabrik_delete'] = Text::_( 'delete' );
		}
		//if no elements linking to the edit form add in a edit column (only if we have the right to edit/view of course!)
		if(empty($aLinkElements) and ($this->_oTable->canView() || $this->_oTable->canEdit())){
			if($this->_oTable->canEdit()){
				$aTableHeadings['fabrik_edit'] = 'Edit';
				$aNamedTableHeadings['fabrik_edit_heading'] = JText::_( 'edit' );
			}else{
				if($this->_oTable->canViewDetails()){
					$aTableHeadings['fabrik_edit'] = 'View';
					$aNamedTableHeadings['fabrik_edit_heading'] = JText::_( 'view' );
				}
			}
		}
		if( $this->_oTable->canViewDetails() && $this->_oTable->_params->get('detaillink') == '1' ){
			$aTableHeadings['__details_link'] = JText::_( 'view' );
			$aNamedTableHeadings['__details_link'] = JText::_( 'view' );
		}
		return array( $aTableHeadings, $aCols, $aLinkElements, $aNamedTableHeadings );
	 }


	function _getTableData( ){
		global $Itemid;
		$aGroups = array();
		$templatevars = '';

		if ( is_array( $this->_data ) ) {
			foreach ( $this->_data as $group ) {
				$aRows = array();
				foreach( $group as $row ){
					$primaryKeyVal = "";
					$oData = new stdClass();
					
					foreach ( $row as $key => $val ) {
					
						isset( $row->__pk_val) ? $primaryKeyVal = $row->__pk_val : 	$primaryKeyVal = $val;
						$nextaction = "viewTableRowDetails";
						if($this->_oTable->canEdit()){
							$nextaction = "viewForm";
						}
					
						if(in_array($key, $this->_aLinkElements)  && ( $this->_oTable->canEdit() || $this->_oTable->canView())){
							if( $this->_oTable->_postMethod == 'post'){
								$link = "?option=com_fabrik&amp;task=$nextaction&amp;Itemid=$Itemid&format=facebook&amp;fabrik=" . $this->_oTable->form_id . "&amp;rowid=$primaryKeyVal&amp;fabrik_cursor=" . $row->_cursor . "&amp;fabrik_total=" . $row->_total . "tableid=" .$this->_oTable->id;
							}else{
								$link = 'index.php?option=com_fabrik&format=facebook';
							}
							
							$aNamedRow["fabrik_link"] = $link;
							$val = "<a href='$link'>$val</a>";
						}
						$oData->$key = $val;
						$templatevars .= "$key = $val<br/>";
					}
	
					//add in a delete checkbox if the user has sufficient rights
					if($this->_oTable->canDelete()){
						$oData->fabrik_delete = "<input type=\"checkbox\" id='id_$row->_cursor' name='ids[$row->_cursor]' value='$primaryKeyVal' />";
					}else{
						$oData->fabrik_delete = '';
					}
					
					//add in an edit or view link if the user has sufficient rights and no element data links through to the record
					if(empty( $this->_aLinkElements ) and ($this->_oTable->canView() || $this->_oTable->canEdit())){
						if( $this->_oTable->_postMethod == 'post'){
							$link = "?option=com_fabrik&amp;task=$nextaction&amp;Itemid=$Itemid&format=facebook&amp;fabrik=" . $this->_oTable->form_id . "&amp;rowid=$primaryKeyVal&amp;tableid=" .$this->_oTable->id . "&amp;fabrik_cursor=" . $row->_cursor . "&amp;fabrik_total=" . $row->_total;
						}else{
							$link = '#';
						}
						$editId = "table_" . $this->_oTable->id . "_row_" . $row->_cursor . "_edit";
						if($this->_oTable->canEdit()){
							$oData->fabrik_edit = "<a class='fabrik___rowlink' href='$link'>" . JText::_( 'edit' ) . "</a>";
						}else{
							if($this->_oTable->canViewDetails()){
								$oData->fabrik_edit = "<a class='fabrik___rowlink' href='$link'>" . JText::_( 'view' ) . "</a>";
							}else{
								$oData->fabrik_edit = '';
							}
						}
						if($this->_oTable->canViewDetails()){
							$link = "?option=com_fabrik&amp;view=form&amp;Itemid=$Itemid&format=facebook&amp;fabrik=" . $this->_oTable->form_id . "&amp;rowid=$primaryKeyVal&amp;tableid=" .$this->_oTable->id . "&amp;fabrik_cursor=" . $row->_cursor . "&amp;fabrik_total=" . $row->_total;
							$oData->fabrik_view = "<a  class='fabrik___rowlink' href='$link'>" . JText::_( 'view' ) . "</a>";
						}
					}
				 	if(array_key_exists('__details_link', $row)){
						$oData->__details_link = "<a href=\"$row->__details_link;\">" . JText::_( 'view' ) . "</a>";
					}
					
					$aRows[] = $oData;
				}
				$aGroups[] = $aRows;
				$aRows = array();
			}
		}
		//group by tables might have an empty first data set 

		if(empty($aGroups[0])){
			array_shift($aGroups);
		}
		return $aGroups;
	}
	
	function _getCalculations( $aCols ){
		$aData = array();
		if ( is_array( $this->_data ) ) {
			foreach ( $aCols as $key=>$val ){
				$calc = '';
				$res = '';
				$oCalcs = new stdClass();
				if ( array_key_exists( $key, $this->_oTable->_aRunCalculations['sums'] ) ){
					$res = $this->_oTable->_aRunCalculations['sums'][$key];
					$calc .= _SUM . ": " . $res . "<br />";
					$tmpKey = str_replace(".", "___", $key) . "_calc_sum";
					$oCalcs->$tmpKey = $res;
				}
				if ( array_key_exists( $key . '_obj', $this->_oTable->_aRunCalculations['sums'] ) ){
					$res = $this->_oTable->_aRunCalculations['sums'][$key. '_obj'];
					$tmpKey =  "obj";
					$oCalcs->$tmpKey = $res;
				}
				
				
				if ( array_key_exists( $key, $this->_oTable->_aRunCalculations['avgs'] ) ){
					$res = $this->_oTable->_aRunCalculations['avgs'][$key];
					$calc .= _AVERAGE . ": " . $res . "<br />";
					$tmpKey = str_replace(".", "___", $key) . "_calc_average";
					$oCalcs->$tmpKey = $res;
					
				}
				if ( array_key_exists( $key, $this->_oTable->_aRunCalculations['medians'] ) ){
					$res = $this->_oTable->_aRunCalculations['medians'][$key];
					$calc .= _MEDIAN . ": " . $res . "<br />";
					$tmpKey = str_replace(".", "___", $key) . "_calc_median";
					$oCalcs->$tmpKey = $res;
					
				}
				if ( array_key_exists( $key, $this->_oTable->_aRunCalculations['count'] ) ){
					$res = $this->_oTable->_aRunCalculations['count'][$key];
					$calc .= _COUNT . ": " . $res . "<br />";
					$tmpKey = str_replace(".", "___", $key) . "_calc_count";
					$oCalcs->$tmpKey = $res;
				}
			$key = str_replace(".", "___", $key);
				$oCalcs->calc = $calc;
				$aData[$key] = $oCalcs;
			}
		}
		return $aData;
	}
	
	function _loadTemplateBottom(){
		global $Itemid;
		$this->hiddenFields  = "
		<input type='hidden' name='option' value='com_fabrik' id = 'option' />\n
		<input type='hidden' name='orderdir' value='' id = 'orderdir' />\n
		<input type='hidden' name='orderby' value='' id = 'orderby' />\n
		<input type='hidden' name='tableid' value='" . $this->_oTable->id . "' id = 'tableid' />\n
		<input type='hidden' name='Itemid' value='" . $Itemid . "' id = 'Itemid' />\n";
		//removed in favour of using table_{id}_limit dorop down box
		//<input type='hidden' name='pagelimit' value='" . $this->_pageNav->limit . "' id = 'pagelimit' />\n

		$this->hiddenFields  .= "<input type='hidden' name='task' value='viewTable' id = 'task' />\n
		<input type='hidden' name='pageURL' value='" . str_replace('&', '&amp;', $_SERVER['QUERY_STRING']) . "' id = 'pageURL' />\n
		<input type='hidden' name='format' id='format' value='html' />";
		//if( $this->_oTable->_inPackage ){
			$packageId = JRequest::getInt( '_packageId', 0 );
			$this->hiddenFields  .= "<input type='hidden' name='_packageId' value='$packageId' id='_packageId' />\n
";
		//}else{
		//	$this->hiddenFields  .= "<input type='hidden' name='_inPackage' value='0' id = '_inPackage' />\n";
		//}
	}
	
	function _includeTemplateCSSFile( $tmpl ){
		//you cant link to an external css file in facebook - use the <style> tag inside the template instead
		echo "<style>";
		require  "components/com_fabrik/views/table/tmpl/" . $tmpl . "/template.css";
		echo "</style>";
	}
	
	/**
	 * show an error page when front end csv import fails
	 *@param object import object
	 */

	function CSVImportFaliure( &$oImport ){
		echo "<h2>Sorry the following fields in the CSV File are not found in this table:</h2>";
		echo "<ul>";
		foreach($oImport->newHeadings as $h){
			echo "<li>$h</li>";
		}
		echo "</ul>";
	}
	
	/**
	 * show success page with csv front end import
	 * @param object import object
	 */

	function CSVImportSuccess( &$oImport, &$oTable ){
		?>
		<h2>CSV File Import Success!</h2>
		<?php
	}
}


?>