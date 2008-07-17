<?php

/**
 * @package		Joomla
 * @subpackage	Fabik
 * @copyright	Copyright (C) 2005 - 2008 Pollen 8 Design Ltd. All rights reserved.
 * @license		GNU/GPL
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

jimport('joomla.application.component.view');

class FabrikViewTable extends JView{

	var $_data 			= null;
	var $_pageNav 	= null;
	var $_params 		= null;
	var $_aLinkElements = null;
	var $_id 				= null;
	var $_isMambot 	= null;

	function setId( $id )
	{
		$this->_id = $id;
	}

	function copy()
	{
		$serialized_contents = serialize($this);
		return unserialize($serialized_contents);
	}

	function getManagementJS( $data = array() )
	{
		global $Itemid;
		$model =& $this->getModel();
		$table =& $model->getTable();

		FabrikHelperHTML::packageJS();
		$document =& JFactory::getDocument();
		FabrikHelperHTML::script( 'mootools-ext.js', 'components/com_fabrik/libs/', true );
		FabrikHelperHTML::script( 'slimbox.js', 'components/com_fabrik/libs/', true );
		FabrikHelperHTML::script( 'table.js', 'components/com_fabrik/views/table/', true );
		JHTML::stylesheet( 'slimbox.css', 'components/com_fabrik/css/slimbox/' );

		$tmpl = JRequest::getVar( 'layout', $table->template );

		// check for a custom css file and include it if it exists
		$ab_css_file = JPATH_SITE.DS."components".DS."com_fabrik".DS."views".DS."table".DS."tmpl".DS.$tmpl.DS."template.css";
		if (file_exists( $ab_css_file )) {
			JHTML::stylesheet(  'template.css', 'components/com_fabrik/views/table/tmpl/'.$tmpl . '/' );
		}

		// check for a custom js file and include it if it exists
		$aJsPath = JPATH_SITE.DS."components".DS."com_fabrik".DS."views".DS."table".DS."tmpl".DS.$tmpl.DS."javascript.js";
		if (file_exists( $aJsPath )) {
			FabrikHelperHTML::script( "javascript.js", 'components/com_fabrik/views/table/tmpl/'.$tmpl . '/', true );
		}
			
		// temporarily set data to load requierd info for js templates

		$origRows 	= $this->rows;
		$this->rows = array(array());

		$row 		= new stdClass();
		$row->__pk_val = "{__pk_val}";
		$c = 0;

		foreach ($this->headings as $heading=>$label) {
			$row->$heading = "{" . $heading . "}";
		}
		$step  		= ( $model->_admin ) ? "../" : "";
		$canEdit 	= ( $model->canEdit() ) ? "1" : "0";
		$canView 	= ( $model->canView() ) ? "1" : "0";
			
		$tmpItemid = ( !isset($Itemid)) ?  0 : $Itemid;
		
		$this->_c = 0;
		$this->_row = new stdClass();
			
		$tmpls = array( 'headings', 'row', 'group' );
		
		foreach ($tmpls as $t) {
			if (file_exists( JPATH_SITE .DS."components".DS."com_fabrik".DS."views".DS."table".DS."tmpl".DS.$tmpl . DS. $tmpl . "_$t.php" )) {
				ob_start();
				// include the requested template filename in the local scope
				require  $step . "components".DS."com_fabrik".DS."views".DS."table".DS."tmpl".DS.$tmpl .DS.$tmpl."_$t.php";
				$html = ob_get_contents();
				ob_end_clean();
			} else {
				$html = '';
			}
			$html = addslashes( $html );
			$html = str_replace( array( "\n", "\r", "\n\r", "\t" ), "",  $html );
			$k = $t . 'tmpl';
			$this->$k = $html; 
		}

		$script = "
		var rowTmpl = \"$this->rowtmpl\";
		var groupTmpl = \"$this->grouptmpl\";
		var headingTmpl = \"$this->headingstmpl\";
		";

		static $tableini;
		if (!$tableini) {
			$tableini = true;
			$script .= "var oTables = \$H();\n";
		}
		$jsonHeadings = $model->_jsonHeadings();
		//$inpackage = $model->_inPackage ? 1 : 0;
		$f =  'tableform_' . $model->_id;
		$script .= "
		var oTable = new fabrikTable($model->_id,
		{
		admin:'$model->_admin',
		postMethod: '$model->_postMethod',
		'filterMethod':'$this->filter_action',
		form: '$f',
		headings: $jsonHeadings,
		primaryKey:'$table->db_primary_key',
		data: ".FastJSON::encode( $data ).",
		Itemid: $tmpItemid,
		formid:{$model->_oForm->_id},
		canEdit: $canEdit,
		canView: $canView,
		page:'".JRoute::_('index.php')."',
		rowTemplate: rowTmpl,
		groupTemplate: groupTmpl,
		headingTmpl: headingTmpl
		},
		{
			'select_rows':'" . JText::_('Select some rows for deletion') . "'
		}
		);
		oTable.addListenTo('form_{$model->_oForm->_id}');
		oTable.addListenTo('table_{$model->_id}');
		oPackage.addBlock('table_{$model->_id}', oTable);";
		$script .= "
		oTables.set($model->_id, oTable);
		-->	";
		$document->addScriptDeclaration( $script );
		//reset data back to original settings
		$this->rows = $origRows;
	}

	/**
	 * display the template
	 *
	 * @param sting $tpl
	 */
	
	function display( $tpl = null )
	{
		require_once( COM_FABRIK_FRONTEND.DS.'helpers'.DS.'parent.php' );
		require_once( COM_FABRIK_FRONTEND.DS.'helpers'.DS.'json.php' );
		require_once( COM_FABRIK_FRONTEND.DS.'views'.DS.'modifiers.php' );
		global $Itemid, $mainframe;
		$user 		=& JFactory::getUser();
		$model		=& $this->getModel();
		if ($mainframe->_name == 'administrator') {
			$model->_admin = true;
		}
		$document =& JFactory::getDocument();

		//this gets teh component settings
		$usersConfig = &JComponentHelper::getParams( 'com_fabrik' );
		if (!isset( $this->_id )) {
			if ($model->_admin) {
				$tpl = "admin";
			} else {
				$model->setId( JRequest::getVar( 'tableid', $usersConfig->get( 'tableid' ) ) );
			}
		} else {
			//when in a package the id is set from the package view
			$model->setId( $this->_id );
		}
		$table			=& $model->getTable();

		$model->render( );
		$w = new FabrikWorker();
		if (!$this->_isMambot) {
			$document->setTitle( $w->parseMessageForPlaceHolder( $table->label, $_REQUEST ) );
		}
		$this->rows =& $model->_tableData;
		reset($this->rows);
		$firstRow = current($this->rows); //cant use numeric key '0' as group by uses groupd name as key
		$this->nodata = (count( $this->rows ) == 1 && empty( $firstRow )) ? true : false;
		$params 		=& $model->getParams();
		
		if (!$model->canPublish( )) {
			echo JText::_( 'Sorry this table is not published' );
			return false;
		}
		if (!$model->canView( )) {
			echo JText::_( 'ALERTNOTAUTH' );
			return false;
		}

		$this->table 					= new stdClass();
		$this->table->label 	= $w->parseMessageForPlaceHolder( $table->label, $_REQUEST );
		$this->table->intro 	= $table->introduction;
		$this->table->id			= $table->id;
		$this->group_by				= $table->group_by;
		$this->formid = 'tableform_' . $table->id ;
		$page =  ( $model->_postMethod == 'ajax' ) ? "index.php?format=raw" : "index.php?";
		$this->table->action 	=  $page . str_replace('&', '&amp;', $_SERVER['QUERY_STRING']);

		if ($model->_postMethod == 'ajax') {
			$this->table->action .= '&format=raw';
			$this->table->action = str_replace("task=package", "task=viewTable", $this->table->action);
			//$this->table->action 	= JRoute::_( $this->table->action );
		}
		$this->table->action 	= JRoute::_( $this->table->action );

		$this->showCSV 				= $params->get( 'csv_export_frontend', 0 );
		$this->showCSVImport	= $params->get( 'csv_import_frontend', 0 );
		$this->nav 						= $params->get( 'show-table-nav', 1) ? $model->_pageNav->getListFooter( $model->_id ) : '';
		$this->fabrik_userid 	= $user->get( 'id' );
		$this->canDelete 			= $model->canDelete() ? true : false;
		$jsdelete =  "oPackage.submitfabrikTable( $table->id, 'delete')";
		$this->deleteButton 	= $model->canDelete() ?  "<input class='button' type='button' onclick=\"$jsdelete\" value='" . JText::_('Delete') . "' name='delete'/>" : '';
		if ($this->showCSV) {
			$this->csvLink = JRoute::_( "index.php?option=com_fabrik&view=table&tableid=" . $model->_id . "&format=csv" );
		}

		$this->showPDF = $params->get( 'pdf', 0 );
		if ($this->showPDF) {
			$this->pdfLink = FabrikHelperHTML::pdfIcon( $model, $params, $model->_rowId );
		}

		$this->emptyButton = ($model->canEmpty())? "<input class='button' type='button' value='" . JText::_('empty') . "' name='doempty'/>" : "";
		
		$this->csvImportLink = ( $this->showCSVImport ) ? JRoute::_( "index.php?option=com_fabrik&view=import&fietype=csv&tableid=" . $table->id ) : '';
		$this->showAdd = $model->canAdd();
		if ($this->showAdd) {
			if ($model->_admin) {
				$this->addRecordLink = ( $model->_postMethod == 'ajax' ) ? "#" : JRoute::_( "index.php?option=com_fabrik&c=form&task=form&fabrik=" . $table->form_id . "&tableid=" . $model->_id ."&rowid=");
			} else {
				$this->addRecordLink = ( $model->_postMethod == 'ajax' ) ? "#" : JRoute::_( "index.php?option=com_fabrik&c=form&view=form&Itemid=$Itemid&fabrik=" . $table->form_id . "&tableid=" . $model->_id ."&rowid=");
			}
		}
		$this->addRecordId = "table_" . $model->_id . "_addRecord";
		$this->showRSS = $model->_params->get('rss', 0) == 0 ?  0 : 1;

		if ($this->showRSS) {
			$this->rssLink = $model->getRSSFeedLink( );
			if ($this->rssLink != '') {
				$this->rssLink = JRoute::_($this->rssLink.'&type=rss');
				$attribs = array('type' => 'application/rss+xml', 'title' => 'RSS 2.0');
				$document->addHeadLink( $this->rssLink, 'alternate', 'rel', $attribs );
			}
		}
		$aReturn = $model->_getTableHeadings( );
		$this->filter_action = $model->getFilterAction();
		$modelFilters = $model->makeFilters( );
		$this->showFilters = count($modelFilters) > 0 ?  1 : 0;
		$filters = array();
		foreach ($modelFilters as $name => $filter) {
			$f 			= new stdClass();
			$f->label 	= $name;
			$f->element = $filter;
			$filters[] 	= $f;
		}
		$this->filters = $filters;

		$this->emptyDataMessage = $model->_params->get( 'empty_data_msg' ) ;

		$aTableHeadings 				= $aReturn[0];
		$aCols 									= $aReturn[1];
		$aNamedHeadings 				= $aReturn[3];
		$this->headings 				= $aTableHeadings;

		$this->calculations 	= $this->_getCalculations( $aTableHeadings );

		$this->_loadTemplateBottom( );

		$this->getManagementJS( $this->rows );

		// get dropdown list of other tables for quick nav in admin
		$this->tablePicker = ($model->_admin) ? FabrikHelperHTML::tableList( $this->table->id ) : ''; 
			
		//force front end templates
		$this->_basePath = COM_FABRIK_FRONTEND . DS . 'views' ;
		$tmpl = JRequest::getVar( 'layout', $table->template );

		$this->_setPath( 'template', $this->_basePath.DS.$this->_name.DS.'tmpl'.DS.$tmpl );
		if ($this->_isMambot) {
			return $this->loadTemplate();
		} else {
			parent::display( );
		}
	}

	/**
	 *
	 */

	function _getCalculations( $aCols )
	{
		$aData = array();
		$model = $this->getModel();
		foreach ( $aCols as $key=>$val ){
			$calc = '';
			$res = '';
			$oCalcs = new stdClass();
			if ( array_key_exists( $key, $model->_aRunCalculations['sums'] ) ){
				$res = $model->_aRunCalculations['sums'][$key];
				$calc .= JText::_('Sum') . ": " . $res . "<br />";
				$tmpKey = str_replace(".", "___", $key) . "_calc_sum";
				$oCalcs->$tmpKey = $res;
			}
			if ( array_key_exists( $key . '_obj', $model->_aRunCalculations['sums'] ) ){
				$res = $model->_aRunCalculations['sums'][$key. '_obj'];
				$tmpKey =  "obj";
				$oCalcs->$tmpKey = $res;
			}

			if ( array_key_exists( $key, $model->_aRunCalculations['avgs'] ) ){
				$res = $model->_aRunCalculations['avgs'][$key];
				$calc .= JText::_('Average') . ": " . $res . "<br />";
				$tmpKey = str_replace(".", "___", $key) . "_calc_average";
				$oCalcs->$tmpKey = $res;

			}
			if ( array_key_exists( $key, $model->_aRunCalculations['medians'] ) ){
				$res = $model->_aRunCalculations['medians'][$key];
				$calc .= JText::_('Median') . ": " . $res . "<br />";
				$tmpKey = str_replace(".", "___", $key) . "_calc_median";
				$oCalcs->$tmpKey = $res;

			}
			if ( array_key_exists( $key, $model->_aRunCalculations['count'] ) ){
				$res = $model->_aRunCalculations['count'][$key];
				$calc .= JText::_('Count') . ": " . $res . "<br />";
				$tmpKey = str_replace(".", "___", $key) . "_calc_count";
				$oCalcs->$tmpKey = $res;
			}
			$key = str_replace(".", "___", $key);
			$oCalcs->calc = $calc;
			$aData[$key] = $oCalcs;
		}
		return $aData;
	}

	/**
	 *
	 */

	function _loadTemplateBottom()
	{
		global $Itemid, $_SERVER;
		$model =& $this->getModel();
		$table =& $model->getTable();
		$reffer = '';
		if (array_key_exists( 'REQUEST_URI', $_SERVER ) ){
			$reffer = $_SERVER['REQUEST_URI'];
		}
		$this->hiddenFields  = "
		<input type='hidden' name='option' value='com_fabrik' id = 'table_".$table->id."_option' />\n
		<input type='hidden' name='orderdir' value='' id ='table_".$table->id."_orderdir' />\n
		<input type='hidden' name='orderby' value='' id = 'table_".$table->id."_orderby' />\n
		<input type='hidden' name='tableid' value='" . $model->_id . "' id = 'table_".$table->id."_tableid' />\n
		<input type='hidden' name='Itemid' value='" . $Itemid . "' id = 'table_".$table->id."_Itemid' />\n";
		//removed in favour of using table_{id}_limit dorop down box

		$this->hiddenFields .= "	<input type='hidden' name='fabrik_referrer' value='" . $reffer . "' id='fabrik_referrer' />\n";
		$this->hiddenFields 	.= JHTML::_( 'form.token' );
		
		$this->hiddenFields  .= "<input type='hidden' name='view' value='table' id = 'table_".$table->id."_view' />\n
<input type='hidden' name='pageURL' value='" . str_replace('&', '&amp;', $_SERVER['QUERY_STRING']) . "' id = 'table_".$table->id."_pageURL' />\n
		<input type='hidden' name='format' id='table_".$table->id."_format' value='html' />";
		//if( $model->_inPackage ){
			$packageId = JRequest::getInt( '_packageId', 0 );
			$this->hiddenFields  .= "
			<input type='hidden' name='_packageId' value='$packageId' id='table_".$table->id."_packageId' />\n
";
	//	}else{
	//		$this->hiddenFields  .= "<input type='hidden' name='_inPackage' value='0' id = 'table_".$table->id."_inPackage' />\n";
	//	}
		if ($model->_admin){
			$this->hiddenFields  .=  "<input type='hidden' name='c' value='table' />";
			$this->hiddenFields  .= "<input type='hidden' name='task' value='viewTable' id = 'task' />\n";
		} else {
			$this->hiddenFields  .= "<input type='hidden' name='task' value='' id = 'task' />\n";
		}
	}


	/**
	 * show an error page when front end csv import fails
	 *@param object import object
	 */

	function CSVImportFaliure( &$oImport )
	{
		echo "<h2>" . JText::_('Sorry the following fields in the CSV File are not found in this table:') . "</h2>";
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

	function CSVImportSuccess( &$oImport, &$oTable )
	{
		?>
<h2><?php echo JText::_( 'CSV File Import Success!' );?></h2>
<?php
	}
}

?>