<?php
/**
 * @package Joomla
 * @subpackage Fabrik
 * @copyright Copyright (C) 2005 Rob Clayburn. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

require_once( COM_FABRIK_FRONTEND.DS.'helpers'.DS.'json.php' );
require_once( COM_FABRIK_FRONTEND.DS.'helpers'.DS.'pagination.php' );
require_once( COM_FABRIK_FRONTEND.DS.'helpers'.DS.'string.php' );


class FabrikModelTable extends JModel {

	/** @var object the tables connection object */
	var $_oConn = null;

	/** @var object table Table */
	var $_table = null;

	/** @var array filters applied to table */
	var $_aFilter = null;

	/** @var array prefilters applied to the table */
	var $_aPrefilters = array();

	/** @var object table's database connection object (loaded from connection object) */
	var $_oConnDB = null;

	/** @var object table's form model */
	var $_oForm = null;

	/** @var array joins */
	var $_aJoins = null;

	/** @var array column calculations */
	var $_aRunCalculations = array();

	/** @var string table output format - set to rss to collect correct element data within function gettData()*/
	var $_outPutFormat = 'html';

	var $_isMambot = false;

	var $_admin = false;

	/** @var object to contain access rights **/
	var $_access = null;

	/** @var int the id of the last inserted record (or if updated the last record updated) **/
	var $_lastInsertId = null;

	/** @var bol determine if we apply prefilters (0 = yes, 1 = no )*/
	var $_togglePreFilters = 0;

	/** @var array store data to create joined records from */
	var $_joinsToProcess = array();

	/** @var array database fields */
	var $_dbFields = null;

	/** @var bol force reload table calculations **/
	var $_reloadCalculations = false;

	/** @var array data contains request data **/
	var $_aData = null;

	/** 'var array data to render the table with **/
	var $_tableData = null;

	/** @var string method to use when submitting form data // post or ajax*/
	var $_postMethod = 'post';

	/** @var int package id */
	var $_packageId = null;

	/** @var object plugin manager */
	var $_pluginManager = null;

	/** @var int id of table to load */
	var $_id = null;

	/** @var string join sql **/
	var $_joinsSQL = null;

	/** @var bol is the object inside a package? */
	//var $_inPackage  = false;

	/** @var bol  when getting the tableData this decides if only the elements published to the
	 table view are loaded. Primarily used by visualization plugins to get all table data regardless
	 of whether its published to the table view */
	var $_onlyTableData = true;

	var $_formGroupElementData = array();

	var $_joinsToThisKey = null;

	var $_real_filter_action = null;

	var $_aAsFields = null;

	/** array merged request and session data used to potentially filter the table **/
	var $_request = null;

	var $_aRow = null;
	
	/** array rows to delete **/
	vaR $_rowsToDelete = null;

	/**
	 * Constructor
	 *
	 * @since 1.5
	 */

	function __construct()
	{
		parent::__construct();
		$usersConfig = &JComponentHelper::getParams( 'com_fabrik' );
		$id = JRequest::getInt( 'tableid', $usersConfig->get( 'tableid' ) );
		$this->setId($id);
		$this->_access = new stdClass();
	}

	/**
	 * main query to build table
	 *
	 */

	function render()
	{
		global $mainframe, $_PROFILER;
		$document =& JFactory::getDocument( );
		if (is_null( $this->_id ) || $this->_id == '0') {
			return JError::raiseError( 500, JText::_('Table id not set - can not render'));
		}
		$params =& $this->getParams();
		$session =& JFactory::getSession();
		$this->_outPutFormat = JRequest::getVar( 'format', 'html' );
		$pluginManager =& JModel::getInstance( 'Pluginmanager', 'FabrikModel' );
		$pluginManager->loadPlugInGroup( 'table' );
		if (!$pluginManager->runPlugins( 'onStartRender', $this, 'table' )) {
			return;
		}

		$table 		=& $this->getTable();

		//cant set time limit in safe mode so suppress warning
		@set_time_limit ( 800 );
		$this->_request 	= $this->getRequestData();
		$context					= 'com_fabrik.table.'. $this->_id.'.list.';
		$limitLength 			= $mainframe->getUserStateFromRequest( $context.'limitLength', 'limit', $table->rows_per_page );
		$limitStart			= $mainframe->getUserStateFromRequest($context.'limitstart',			'limitstart',		0,	'int');
		if ($this->_outPutFormat == 'feed') {
			$limitLength = JRequest::getVar( 'limit',  $params->get( 'rsslimit',150 ) );
			$maxLimit = $params->get( 'rsslimitmax', 2500 );
			if ($limitLength > $maxLimit) {
				$limitLength = $maxLimit;
			}
		}
		$total 						= $this->getTotalRecords( );
		$this->_pageNav		=& $this->_getPagination( $total, $limitStart, $limitLength );
		if ($limitLength == 0) {
			$pageNav->limit = 0;
		}
		$this->_tableData = $this->getData();
		$this->getCalculations( );
		$table->hit();
	}

	/**
	 * this merges session data for the fromForm with any request data
	 * allowing us to filter data results from both search forms and filters
	 *
	 * @return array
	 */

	function getRequestData()
	{
		global $_SESSION;
		//session_destroy();
		if (isset($this->_request)) {
			return $this->_request;
		}

		$aData 			= JRequest::get( 'request' );
		$formModel =& $this->getForm();
		$table =& $this->getTable();
		if (is_array( $_SESSION )) {

			if (array_key_exists( "fabrik",  $_SESSION )) {

				if (array_key_exists( 'fromForm',  $_SESSION["fabrik"] )) {
					$fromForm = $_SESSION["fabrik"]['fromForm'];
					//only merge if the fromForm is not the same as the current table's form id
					if ($_SESSION["fabrik"]['fromForm'] != $formModel->_id) {
						$this->_oFromForm =& JModel::getInstance( 'Form', 'FabrikModel' );

						$this->_oFromForm->setId( $fromForm );
						$fromFormTable = $this->_oFromForm->getForm();
							
						$fromFormParams = $this->_oFromForm->getParams();

						//fudge the sesson so that any search form data's keys are the same as the current
						//tables
						if (array_key_exists( $fromForm, $_SESSION['fabrik'] )) {
							foreach ($_SESSION['fabrik'][$fromForm] as $k1=>$v) {
								//only unset if not done previously
								if (strstr( $k1, "___" )) {
									$k2 = $table->db_table_name . "___" . array_pop(explode("___", $k1));
								} else {
									$k2 = $table->db_table_name . "___" . $k1;
								}

								if (array_key_exists( $k2, $aData )) {
									//override search form session info with any posted filters
									$v = $aData[$k2];
								}
								$_SESSION['fabrik'][$fromForm][$k2] = $v;
							}
						}
						if (array_key_exists( $fromForm, $_SESSION["fabrik"])) {
							$aData = array_merge( $aData, $_SESSION["fabrik"][$fromForm] );
						}
					}
					//$$$rob since after 1.0.5.2 DONT unset as page nav no longer picks up the filter
					//unset( $_SESSION["fabrik"]['fromForm'] );
				}
			}
		}
		return $aData;
	}

	/**
	 * get the table's data
	 *
	 * @return array of objects (rows)
	 */

	function getData()
	{
		$fabrikDb =& $this->getDb();
		$query = $this->_buildQuery();
		$fabrikDb->setQuery( $query, $this->_pageNav->limitstart, $this->_pageNav->limit );
		if (JRequest::getBool( 'fabrikdebug', 0 ) == 1) {
			echo "<pre>"; echo $fabrikDb->getQuery();echo "</pre>";
		}
		$data =  $fabrikDb->loadObjectList( );
		if ($data === false) {
			JError::raiseNotice(500,  'getData: ' . $fabrikDb->getErrorMsg( ) );
		}
		//append the cursor & total to the data
		if ($this->_outPutFormat == 'html' || $this->_outPutFormat == 'raw') {
			for ($i=0; $i<count($data); $i++) {
				$data[$i]->_cursor = $i + $this->_pageNav->limitstart;
				$data[$i]->_total = $this->_pageNav->total;
			}
		}
		$this->formatData( $data );
		return $data;
	}

	/**
	 * run the table data through element filters
	 *
	 * @param array $data
	 */

	function formatData( &$data )
	{
		jimport('joomla.filesystem.file');
		$form =& $this->getForm();
		$table =& $this->getTable();
		$pluginManager 	=& JModel::getInstance( 'Pluginmanager', 'FabrikModel' );
		$method 				= 'renderTableData_' . $this->_outPutFormat;
		$this->_aLinkElements = array();
		foreach ($form->_groups as $groupModel) {
			if (is_array( $groupModel->_aElements )) {
				foreach ($groupModel->_aElements as $elementModel) {
					$e =& $elementModel->getElement();
					$elementModel->setContext( $groupModel, $form, $this );
					$params =& $elementModel->getParams( );
					$col 	= $elementModel->getFullName( false, true, false );

					//check if there is  a custom out put handler for the tables format
					// currently supports "renderTableData_csv", "renderTableData_rss", "renderTableData_html", "renderTableData_json"
					if (!empty( $data ) && array_key_exists( $col, $data[0] )) {
						if (method_exists( $elementModel, $method )) {
							for ($i=0; $i<count( $data ); $i++) {
								$thisRow = $data[$i];
								$coldata = $data->$col;
								$d = $elementModel->$method( $coldata, $col, $thisRow );
								$data[$i]->$col = $this->_addLink( $d, $elementModel, $thisRow );
							}

						} else {
							$ec = count( $data );
							for ( $i=0; $i< $ec; $i++ ) {
								$thisRow = $data[$i];
								$coldata = $thisRow->$col;
								$d = $elementModel->renderTableData( $coldata, $thisRow );
								$data[$i]->$col = $this->_addLink( $d, $elementModel, $thisRow );
								$rawCol = $col . "_raw";
								if (!array_key_exists( $rawCol, $thisRow)){
									$data[$i]->$rawCol = $elementModel->renderRawTableData( $coldata, $thisRow );
								}
							}

							// run a final function for each fo the elements (basically here to
							// avoid you doing extraneous sql calls in renderTableData
							// ie create sql query in rendertabledata, then run it in mergeTableData
							// currently used for advanced table joins only
							$elementModel->mergeTableData( $data, $this );
						}

						//see if we replace data with icons
						/*
						if ($params->get('icon_folder') != -1 && $params->get('icon_folder') != '') {
							jimport('joomla.filesystem.file');
							for ($i=0; $i<count( $data ); $i++) {
								$thisRow = $data[$i];
								$coldata = $thisRow->$col;
								$data[$i]->$col = $elementModel->replaceWithIcons( $coldata );
							}
						}
*/
					}
				}
			}
		}
		$this->_aGroupInfo = array();
		$groupTitle = array();

		//check if the data has a group by applied to it
		if ($table->group_by != '') {
			$groupedData = array();
			$thisGroupedData = array();
			$groupBy = $table->group_by;
			//see if we can use a raw value instead
			if (!empty( $data ) && array_key_exists( $groupBy . "_raw", $data[0] )) {
				$groupBy = $groupBy . "_raw";
			}
			$groupTitle = null;
			$aGroupTitles = array();
			$groupId = 0;
			for ( $i=0; $i<count( $data ); $i++ ) {
				if (!in_array( $data[$i]->$groupBy , $aGroupTitles )) {
					$aGroupTitles[] = $data[$i]->$groupBy;
					$groupedData[$data[$i]->$groupBy] = array();
				}
				$data[$i]->_groupId = $data[$i]->$groupBy;
				$gKey = $data[$i]->$groupBy;
				//	if the group_by was added in in getAsFields remove it from the returned data set (to avoid mess in package view)
				if ($this->_group_by_added ){
					unset($data[$i]->$groupBy );
				}
				if ($this->_temp_db_key_addded ){
					$k = $table->db_primary_key;;
				}
				$groupedData[$gKey][] = $data[$i];

			}
			$data = $groupedData;
		} else {
			for( $i=0; $i<count( $data ); $i++ ){
				if ($this->_temp_db_key_addded ){
					$k = $table->db_primary_key;;
				}
			}
			//make sure that the none grouped data is in the same format
			$data = array( $data );
		}

		if ($this->_outPutFormat != 'pdf' && $this->_outPutFormat != 'csv' && $this->_outPutFormat != 'feed') {
			$this->addSelectBoxAndLinks( $data );
			if (JRequest::getVar( 'fabrikdebug' )) {
				echo "<pre>";print_r($data);echo"</pre>";
			}
		}
	}

	/**
	 * add the select box and various links into the data array
	 * @param array table row objects
	 */

	function addSelectBoxAndLinks( &$data )
	{
		global $Itemid;
		$table 		=& $this->getTable();
		$db 			=& JFactory::getDBO();
		$params 	=& $this->getParams();
		$nextview = ($this->canEdit()) ? "form" : "details";
		$tmpKey 	= '__pk_val';

		$aExisitngLinkedTables = $params->get('linkedtable', '', '_default', 'array');
		$aExisitngLinkedForms = $params->get('linkedform', '', '_default', 'array');

		$linkedform_linktype 		= $params->get( 'linkedform_linktype', '', '_default', 'array' );
		$linkedtable_linktype 	= $params->get( 'linkedtable_linktype', '', '_default', 'array' );
		$aExistingTableHeaders 	= $params->get( 'linkedtableheader', '', '_default', 'array' );
		$aExistingFormHeaders 	= $params->get( 'linkedformheader', '', '_default', 'array' );

		//get a list of fabrik tables and ids for view table and form links

		$action = ($this->_admin) ? "task" : "view";
			
		$sql = "SELECT id, label FROM #__fabrik_tables";
		$db->setQuery( $sql );
		$aTableNames = $db->loadObjectList( 'label' );
		$cx = count($data);
		$viewLinkAdded = false;
		//for ($x=0; $x<$cx; $x++) { //if grouped data then the key is not numeric
		foreach ($data as $key=>$group) {
			//$group =& $data[$key]; //Messed up in php 5.1 group positioning in data became ambiguous
			$cg = count( $group );
			for( $i=0; $i < $cg; $i++ ){
				$row =& $data[$key][$i];
				$pKeyVal = (array_key_exists( $tmpKey, $row )) ? $row->$tmpKey : '';
				$row->fabrik_delete =  ($this->canDelete()) ?  '<input type="checkbox" id="id_'.$row->_cursor .'" name="ids['.$row->_cursor.']" value="' . $pKeyVal . '" />' : '';
				//add in some default links if no element choosen to be a link
				if (empty( $this->_aLinkElements ) and ($this->canView() || $this->canEdit())){


					$link = ( $this->_outPutFormat == 'json' ) ? "#" : JRoute::_("index.php?option=com_fabrik&c=form&$action=$nextview&Itemid=$Itemid&fabrik=" . $table->form_id . "&rowid=$pKeyVal&tableid=" .$this->_id . "&fabrik_cursor=" . $row->_cursor . "&fabrik_total=" . $row->_total );
					if ($this->canEdit()) {
						$row->fabrik_edit = "<a class='fabrik___rowlink' href='$link'>" . JText::_('Edit') . "</a>";
					} else {
						if($this->canViewDetails()){
							$viewLinkAdded = true;
							$row->fabrik_edit = "<a class='fabrik___rowlink' href='$link'>" . JText::_('View') . "</a>";
						} else {
							$row->fabrik_edit = '';
						}
					}
				}
				//@TODO: test if all of these are necessary
				if ($this->canViewDetails()) {
					$link = JRoute::_( "index.php?option=com_fabrik&c=form&$action=form&Itemid=$Itemid&fabrik=" . $table->form_id . "&rowid=$pKeyVal&tableid=" .$this->_id . "&fabrik_cursor=" . $row->_cursor . "&fabrik_total=" . $row->_total );
					$row->fabrik_view = "<a class='fabrik___rowlink' href='$link'>" . JText::_('View') . "</a>";
				}

				if ($this->canViewDetails( ) && $params->get( 'detaillink' ) == '1' && !$viewLinkAdded ) {
					$row->__details_link = $this->viewDetailsLink( $pKeyVal );
				}
				// create columns containing links which point to tables associated with this table
				$joinsToThisKey = $this->getJoinsToThisKey( );
				$f = 0;
				foreach ($joinsToThisKey as $element) {
					$linkedTable 	= array_key_exists($f, $aExisitngLinkedTables) ? $aExisitngLinkedTables[$f] : false;
					$popUpLink 		= array_key_exists($f, $linkedtable_linktype) ? $linkedtable_linktype[$f] : false;
					if ($linkedTable != '0') {
						if ($element->tablelabel == $table->label) { //if the link points to the same table
							$thiskey 	= $table->db_table_name.'.'.$this->_oTable->_tbl_key;
							$key 		= $element->element_name;
							$x 			= $element->element_name;
							$val 		= $row->$thiskey;
						} else {
							$linkKey	= $element->db_table_name . "___" . $element->name;
							$key 		= $linkKey . "_table_heading";
							$val 		= $pKeyVal;
						}
						$element->table_id = ( array_key_exists( $element->tablelabel, $aTableNames)) ?  $aTableNames[$element->tablelabel]->id : '';

						if ($popUpLink != '0') {
							//pop up window link
							$url = JRoute::_( "index.php?option=com_fabrik&tmpl=component&Itemid=$Itemid&view=table&tableid=$element->table_id&$linkKey" . "[value]=$val&fabrik_cursor=" . $row->_cursor . "&fabrik_total=" . $row->_total );
							FabrikHelperHTML::mocha( 'a.popupwin' );
							$group[$i]->$key  =  '<a rel="{\'maximizable\':true}" href="'. $url.'" class="popupwin">'. JText::_('View') .'</a>';
						} else {
							$url = JRoute::_( "index.php?option=com_fabrik&Itemid=$Itemid&$action=table&tableid=$element->table_id&$linkKey" . "[value]=$val&fabrik_cursor=" . $row->_cursor . "&fabrik_total=" . $row->_total );
							$group[$i]->$key  = "<a href=\"$url\">" .  JText::_('View'). "</a>";
						}
					}
					$f ++;
				}

				$linksToForms =  $this->getLinksToThisKey( );
				$f = 0;
				//create columns containing links which point to forms assosciated with this table
				foreach ( $linksToForms as $element ) {
					if ($element != '') {
						$linkedForm 	= array_key_exists($f, $aExisitngLinkedForms) ? $aExisitngLinkedForms[$f] : false;
						$popUpLink 		= array_key_exists($f, $linkedform_linktype) ? $linkedform_linktype[$f] : false;
						$linkKey	= $element->db_table_name . "___" . $element->name;
						$key 		= $linkKey . "_form_heading";
						if ($linkedForm != '0') {
							if ($popUpLink != '0') {
								$url = JRoute::_("index.php?option=com_fabrik&tmpl=component&Itemid=$Itemid&$action=form&tableid=$element->table_id&fabrik=$element->form_id&$linkKey" . "[value]=$val");
								FabrikHelperHTML::mocha( 'a.popupwin' );
								$group[$i]->$key  =  '<a rel="{\'maximizable\':true}" href="'. $url.'" class="popupwin">'. JText::_('Add') .'</a>';
							} else {
								$url = JRoute::_("index.php?option=com_fabrik&Itemid=$Itemid&$action=form&tableid=$element->table_id&fabrik=$element->form_id&$linkKey" . "[value]=$val");
								$group[$i]->$key = "<a href=\"$url\">" . JText::_('Add') . "</a>";
							}
						}
					}
					$f ++;
				}
			}
		}
	}

	/**
	 * add a custom link to the element data
	 *
	 * @param string element $data
	 * @param object element
	 * @param object of all row data
	 */

	function _addLink( $data, &$elementModel, &$row )
	{
		global $Itemid;
		if ($this->_outPutFormat == 'csv') {
			return $data;
		}

		$nextview = ($this->canEdit()) ? "form" : "details";
		$params 	=& $elementModel->getParams();
		$element 	=& $elementModel->getElement();
		$table 		=& $this->getTable();

		if ($element->link_to_detail == '1' && ( $this->canEdit() || $this->canView())) {
			$this->_aLinkElements = $element->name;
			if ($this->_postMethod == 'post') {
				$primaryKeyVal = $this->getKeyIndetifier( $row );
				if ($this->_admin) {
					$link = JRoute::_( "index.php?option=com_fabrik&c=form&task=$nextview&fabrik=" . $table->form_id . "$primaryKeyVal&fabrik_cursor=" . @$row->_cursor . "&fabrik_total=" . @$row->_total . "&tableid=" .$this->_id );
				} else {
					$link = JRoute::_( "index.php?option=com_fabrik&c=form&view=$nextview&Itemid=$Itemid&fabrik=" . $table->form_id . "$primaryKeyVal&fabrik_cursor=" . @$row->_cursor . "&fabrik_total=" . @$row->_total . "&tableid=" .$this->_id );
				}
			} else {
				$link = '#';
			}
			//try to remove any previously entered links
			$data = preg_replace( '/<a(.*?)>|<\/a>/', '', $data );
			$data = "<a class='fabrik___rowlink' href='$link'>$data</a>";
		} else {
			$customLink = $params->get( 'custom_link' );
			if ($customLink != '') {
				//$w = new FabrikWorker();
				//$customLink = $w->parseMessageForPlaceHolder($customLink, JArrayHelper::fromObject( $row ));
				$customLink = $this->parseMessageForRowHolder($customLink, JArrayHelper::fromObject( $row ));
				//try to remove any previously entered links
				$data = preg_replace( '/<a(.*?)>|<\/a>/', '', $data );
				$data = "<a class='fabrik___rowlink' href='$customLink'>$data</a>";
			}
		}
		return $data;
	}

	/**
	 * get query to make records
	 * @return string sql
	 */

	function _buildQuery()
	{
		$query = $this->_buildQuerySelect();
		$query .= $this->_buildQueryJoin();
		$query .= $this->_buildQueryWhere();
		$query .= $this->_buildQueryOrder();
		return $query;
	}

	function _buildQuerySelect()
	{
		$form =& $this->getForm();
		$table =& $this->getTable();
		$form->getGroupsHiarachy( $this->_onlyTableData, true );
		$this->_getAsFields();
		$fields = (empty( $this->_aFields )) ? '' : implode( ", \n ", $this->_aFields ) . "\n ";
		if (trim( $table->db_primary_key ) != '' && ( $this->_outPutFormat == 'html' || $this->_outPutFormat == 'feed' ) ) {
			if ($this->isView()) {
				$strPKey = ''; //view dont have primary key!
			} else {
				$fields .= ", ";
				$strPKey = $table->db_primary_key . " AS __pk_val\n";
			}
			$query = 'SELECT DISTINCT ' . $fields . $strPKey;
		} else {
			$query = 'SELECT DISTINCT ' . trim($fields, ", \n")  . "\n";
		}
		$query .= " FROM `$table->db_table_name` \n" ;
		return $query;
	}

	/**
	 * get the part of the sql statement that orders the table data
	 * @return string ordering part of sql statement
	 */

	function _buildQueryOrder()
	{
		global $mainframe;
		$params = $this->getParams();
		if ($this->_outPutFormat == 'feed' )
		{
			$dateCol = $params->get( 'feed_date', '' );
			if( $dateCol != '' ){
				$this->order_dir = 'DESC';
				$this->order_by 	= $dateCol;
				return "\n ORDER BY `$dateCol` DESC";
			}
		}
		$session =& JFactory::getSession();
		$table =& $this->getTable();

		$postOrderBy =  JRequest::getVar( 'orderby', '', 'post' );
		$postOrderBy = str_replace( ".", "___", $postOrderBy );

		$postOrderDir = JRequest::getVar( 'orderdir', '', 'post' );
		$arOrderVals = array('asc', 'desc', '-');
		if (in_array( $postOrderDir, $arOrderVals )) {
			$context			= 'com_fabrik.table.'. $this->_id.'.order.'.$postOrderBy;
			$session->set( $context, $postOrderDir );
		}
		//build the order by statement from the session
		$strOrder = '';
		foreach ($this->_aAsFields as $field) {
			$field = str_replace('`', '', $field);
			$context			= 'com_fabrik.table.'. $this->_id.'.order.'.$field;
			$dir = $session->get( $context );
			if ($dir != '' && $dir != '-' && trim( $dir ) != 'Array' ) {
				$field = str_replace( "___", ".", $field );
				if (!strstr( $field, '.' )) {
					$field =  $table->db_table_name.'.'. $field ;
				}
				//ensure its quoted

				$field = explode( ".", $field );
				$field = "`" . $field[0] . "`.`" . $field[1] . "`";
				$strOrder == '' ? $strOrder = "\n ORDER BY " : $strOrder .= ',';
				$strOrder .= " $field $dir";
			}
		}

		//if nothing found in session use default ordering
		if ($strOrder == '' ) {
			if ($table->order_by != '') {
				$table->order_dir != ''? $dir = $table->order_dir : $dir = 'desc';
				$field = str_replace( "___", ".", $table->order_by );
				$field = explode( ".", $field );
				if(count($field) == 2 && $field[1] != '') {
					$field = "`" . $field[0] . "`.`" . $field[1] . "`";
					$strOrder = "\n ORDER BY $field $dir";
				}
			}
		}

		// apply group ordering
		$groupOrderBy = $params->get( 'group_by_order' );
		if ($groupOrderBy != '' && in_array( $groupOrderBy, $this->_aAsFields )) {
			$groupOrderDir = $this->_params->get( 'group_by_order_dir' );
			$strOrder == '' ? $strOrder = "\n ORDER BY " : $strOrder .= ',';
			$strOrder .= " `$groupOrderBy`  $groupOrderDir ";
		}
		return $strOrder;
	}

	/**
	 * get the part of the sql query that creates the joins
	 * used when building the table's data
	 *
	 * @return string join sql
	 */

	function _buildQueryJoin()
	{
		if (isset( $this->_joinSQL )) {
			return $this->_joinsSQL;
		}
		$sql = '';
		$joins 	=& $this->getJoins();
		
		$tableGroups = array();
		foreach ($joins as $join) {
			$sql .= strtoupper($join->join_type) ." JOIN `$join->table_join`" ;
			
			if ($join->table_join_alias == '') {
				/*$sql .=	" ON `$join->table_join`.`$join->table_join_key` = " .
									"`$join->join_from_table`.`$join->table_key` \n";*/
				$sql .=	" ON `$join->table_join`.`$join->table_join_key` = " .
									"`$join->keytable`.`$join->table_key` \n";
			} else {
				/*$sql .= " AS `" . $join->table_join_alias .
				"` ON `" . $join->table_join_alias . "`.`$join->table_join_key` = " .
				"`$join->join_from_table`.`$join->table_key` \n ";*/
				
				$sql .= " AS `" . $join->table_join_alias .
				"` ON `" . $join->table_join_alias . "`.`$join->table_join_key` = " .
				"`$join->keytable`.`$join->table_key` \n ";
				
			}
		}
		return $sql;
	}

	/**
	 * get the part of the sql query that relates to the where statement
	 *
	 * @param bol $incFilters
	 * @return string where query
	 */

	function _buildQueryWhere( $incFilters = true )
	{
		if (isset( $this->_whereSQL )) {
			return $this->_whereSQL[$incFilters];
		}
		$aFilters	=& $this->getFilterArray();
		$params =& $this->getParams();
		if (isset( $params ) && $this->_togglePreFilters == 0) {
			$aPrefilters = $this->getPrefilterArray( );
		} else {
			$aPrefilters = array();
		}
		$aOrSQL = array( );
		$aFoundOrGroupings = array( );
		$i = 0;

		$aSQLBits = array();
		if (is_array( $aFilters )) {
			/* stores sql for or statements */
			$c = 0;
			foreach ($aFilters as $key=>$val) {
				/*work through or columns first to build sql ( col = val or col = val...)
				 * then remove them from the rest of the array
				 */
				if ( isset( $val['aOrCols'] ) ) {

					$aOrColumns = $val['aOrCols'] ;
					$filterVal = isset( $val['value'] ) ? $val['value'] : '';
					/* check if we've already performed it elsewhere */
					$done 		= false;
					foreach ($aFoundOrGroupings as $aFoundOrGroupSet) {
						$a = filter_unused( $aFoundOrGroupSet, $aOrColumns );
						if (empty( $a )){
							$done = true;
						}
					}
					if (!$done) {
						/*
						 * ok we havent processed this group -
						 * lets add it to the groups the we have processed
						 */
						$aFoundOrGroupings[] = $aOrColumns;
						/*
						 *now lets build that query string!
						 */
						$orSql ='(';
						foreach ($aOrColumns as $col) {
							$col = FabrikWorker::getDbSafeName( $col );
							$orSql .= "`$col` = '$filterVal' OR " ;
						}
						$orSql = substr($orSql, 0, strlen($orSql)-3) . ')';
						$aOrSQL[] = $orSql;
					}
					/* ok, even if its been done before we still need to remove it from the filter array */
					unset ( $aFilters[$key] );
					$c++;
				}
			}
			foreach ($aFilters as $key=>$val) {
				$filterType 			= isset( $val['type'] )  ? $val['type']: 'dropdown';
				$filterVal 				= isset( $val['value'] ) ? $val['value'] : '';
				$filterExactMatch = isset( $val['match'] ) ? $val['match'] 	: '';
				$fullWordsOnly 		= isset( $val['full_words_only'] )? $val['full_words_only'] : '0';

				if (array_key_exists( $key, $aPrefilters )){
					if (array_key_exists( 'sqlCond' , $aPrefilters[$key] )) {
						$sqlCond = "( " .$val['sqlCond'] . " AND " . $aPrefilters[$key]['sqlCond'] . " )";
					} else {
						//$$$rob used for prefilter and table - "Tables with database join elements linking to this table " pointing to same prefilter opt
						$sqlCond = "( " .$val['sqlCond'];
						foreach ($aPrefilters[$key] as $tmpC) {
							$sqlCond .= " AND " . $tmpC['sqlCond'];
						}
						$sqlCond .= " )";
					}
					unset( $aPrefilters[$key] );
				} else {
					$sqlCond = $val['sqlCond'];
				}

				if ( $filterVal != "" ) {
					$aSQLBits[] = " AND ";
					$aSQLBits[] = $sqlCond;
					$i ++;
				}
			}
		}

		//add in any prefiltres not duplicated by filters
		//put them at the beginning of query as well

		$aSQLBits2 = array();
		foreach ($aPrefilters as $key=>$ar) {
			if ($key !== '') {
				$aSQLBits2[] = $ar['concat'];
				$aSQLBits2[] = $ar['sqlCond'];
			}
		}
		// $$$rob work out the where statment minus any filters (so only include prefilters)
		// this is needed to ensure that the filter drop downs contain the correct info.

		$sqlNoFilter = '';
		if (!empty( $aSQLBits2 )) {
			$aSQLBits2[0] = "WHERE";
			$sqlNoFilter .= implode(  ' ', $aSQLBits2 );
			if (count( $aOrSQL ) > 0) {
				if (empty( $aSQLBits2 )) {
					$sqlNoFilter .= " WHERE " . implode( ' AND ', $aOrSQL );
				} else {
					$sqlNoFilter .=  ' AND ' . implode( ' AND ', $aOrSQL );
				}
			}
		}
		//apply advanced filter query
		$advancedFilter = JRequest::getVar('advancedFilterContainer', array('value' => ''), 'default', 'none', 2);

		$sql = '';
		$aSQLBits = array_merge( $aSQLBits2, $aSQLBits );

		if (!empty( $aSQLBits )) {
			$aSQLBits[0] = "WHERE";
			$sql .= implode( ' ', $aSQLBits );
			if (count( $aOrSQL ) > 0) {
				if (empty( $aSQLBits )) {
					$sql .= " WHERE " . implode( ' AND ', $aOrSQL );
				} else {
					$sql .=  ' AND ' . implode( ' AND ', $aOrSQL );
				}
			}
		}
		if ($advancedFilter['value'] != '') {
			$sql .= empty( $sql ) ? " WHERE " : " AND ";
			$sql .= trim( trim( $advancedFilter['value'], "AND" ), "OR" );
		}
		$this->_whereSQL = array( '0'=>$sqlNoFilter, '1'=>$sql );
		return $this->_whereSQL[$incFilters];
	}

	/**
	 * get the part of the table sql statement that selects which fields to load
	 * (both this_>_aASFields and this->_aFields)
	 *
	 * @return array field names to select in getelement data sql query
	 */

	function &_getAsFields()
	{
		if (!is_null( $this->_aAsFields )) {
			return $this->_aAsFields;
		}
		$form 			=& $this->getForm();
		$table 			=& $this->getTable();
		$aJoinObjs 	=& $this->getJoins();
		$this->_aAsFields = array();
		$this->_aFields = array();
		$this->_temp_db_key_addded = false;

		foreach ($form->_groups as $groupModel) {
			$table_name = $table->db_table_name;
			$group =& $groupModel->getGroup();
			if ($group->is_join) {
				foreach ($aJoinObjs as $join) {
					//also ignore any joins that are elements
					if (array_key_exists( 'group_id', $join ) && $join->group_id == $group->id && $join->element_id == 0 ) {
						$table_name =  $join->table_join;
					}
				}
			}
			foreach ($groupModel->_aElements as $elementModel) {
				if (!$this->_onlyTableData || $elementModel->inTableFields( $this )) {
					$method = "getAsField_" . $this->_outPutFormat;
					if (!method_exists( $elementModel, $method )) {
						$method = "getAsField_html";
					}
					$elementModel->$method( $this->_aFields, $this->_aAsFields, $table_name );
				}
			}
		}
		//temporaraily add in the db key so that the edit links work, must remove it before final return
		//	of getData();

		if (!$this->isView()) {
			if (!$this->_temp_db_key_addded && $table->db_primary_key != '') {
				$str = str_replace( '___', '.', $table->db_primary_key ) . " AS " . str_replace( '.', '___', $table->db_primary_key );
				//if we are quoting the priamry key in the db then we need to remove these quotes
				$str = str_replace( '`___`', '___', $str );
				$this->_aFields[] = $str;
				$this->_aAsFields[] = $table->db_primary_key;
			}
		}
		//for raw data in packages

		if ($this->_outPutFormat == 'raw') {
			$str = str_replace( '___', '.', $table->db_primary_key ) . " AS __pk_val";
			$str = str_replace( '`___`', '___', $str );
			$this->_aFields[] = $str;
		}
		//end

		$this->_group_by_added = false;
		//if the group by element isnt in the fields add it (otherwise group by wont work)
		if (!in_array( $table->group_by, $this->_aAsFields ) && trim( $table->group_by ) != '') {
			$this->_aFields[] = str_replace( '___', '.', $table->group_by ) . " AS `$table->group_by`";
			$this->_aAsFields[] = $table->group_by;
			$this->_group_by_added = true;
		}
		return $this->_aAsFields;
	}

	/**
	 * checks if the params object has been created and if not creates and returns it
	 * @return object params
	 */

	function &getParams()
	{
		$table =& $this->getTable();
		if (!isset( $this->_params )) {
			$this->_params = &new fabrikParams( $table->attribs, JPATH_SITE . '/administrator/components/com_fabrik/models/table.xml', 'component' );
		}
		return $this->_params;
	}


	/**
	 * Method to set the table id
	 *
	 * @access	public
	 * @param	int	table ID number
	 */

	function setId( $id )
	{
		$this->_id		= $id;
	}

	/**
	 * sets the instances admin state
	 * @param bol admin state
	 */

	function setAdmin( $bol )
	{
		$this->_admin = $bol;
	}

	/**
	 * get the table object for the models _id
	 *
	 * @return object table
	 */

	function &getTable()
	{
		if (is_null( $this->_table )) {
			JTable::addIncludePath( JPATH_ADMINISTRATOR.DS.'components'.DS.'com_fabrik'.DS.'tables' );
			$row = JTable::getInstance( 'table', 'Table' );
			$row->load( $this->_id );
			$this->_table =& $row;
		}
		return $this->_table;
	}

	/**
	 * load  the database associated with the table
	 *@return object database
	 */

	function &getDb()
	{
		if (!isset( $this->_oConnDB )) {
			$cnn =& $this->getConnection();
			if (!is_object( $cnn )) {
				return JError::raiseError( 500, JText::_( 'Fabrik was unable to load the database object for this table' ) );
			}
			$this->_oConnDB =& $cnn->getDb( );
		}
		return $this->_oConnDB;
	}

	/**
	 * function get the tables connection object
	 * sets $this->_oConn to the tables connection
	 * @return object connection
	 */

	function &getConnection( )
	{
		$config =& JFactory::getConfig();
		if (!isset( $this->_oConn )) {
			$table =& $this->getTable();
			$connectionModel =& JModel::getInstance( 'connection', 'FabrikModel' );
			$connId = ( is_null( $table->connection_id ) ) ? JRequest::getVar( 'connection_id', null ) : $table->connection_id;
			$connectionModel->setId( $connId );
			if ($connId == '' || is_null( $connId ) ||  $connId == '-1' ){ //-1 for creating new table
				$connectionModel->loadDefaultConnection();
				$connectionModel->setId( $connectionModel->_connection->id );
			}
			$connection =& $connectionModel->getConnection( );
			// if its the default connection then load from the
			// config file
			if ($connectionModel->isDefault() ){
				$connection->host = $config->getValue('config.host');
				$connection->user = $config->getValue('config.user');
				$connection->password = $config->getValue('config.password');
				$connection->database = $config->getValue('config.db');
			}
			$this->_oConn =& $connectionModel;
		}
		return $this->_oConn;
	}

	/**
	 * is the table published
	 *
	 * @return bol published state
	 */

	function canPublish()
	{
		$table =& $this->getTable();
		
		global $mainframe;
		$db =& JFactory::getDBO();
		if (method_exists( $db, 'getNullDate' )) {
			$nullDate = $db->getNullDate( );
		} else {
			$nullDate = $this->getNullDate( );
		}
		$publishup =& JFactory::getDate($table->publish_up, $mainframe->getCfg('offset'));
		$publishup = $publishup->toUnix();
		
		$publishdown =& JFactory::getDate($table->publish_down, $mainframe->getCfg('offset'));
		$publishdown = $publishdown->toUnix();
		
		$jnow		=& JFactory::getDate();
		$now		= $jnow->toUnix();
		if ($table->state == '1') {
			if ($now >= $publishup || $table->publish_up == '' || $table->publish_up == $nullDate) {
				if ($now <= $publishdown || $table->publish_down == '' || $table->publish_down == $nullDate) {
					return true;
				}
			}
		}
		return false;
		
		return $table->state;
	}
	
	/**
	 * 
	 */
	
	function canEmpty()
	{
		$user  	=& JFactory::getUser();
		$acl 		=& JFactory::getACL();
		$table 	=& $this->getTable();
		$params =& $this->getParams();
		$a = $params->get( 'allow_drop', 0 );
		if ($a == '29'|| $a == ''|| $a == 0) {
			$this->_access->allow_drop =  true;
		} else {
			if (!is_object( $this->_access ) || !array_key_exists( 'allow_drop', $this->_access )) {
				$groupNames =& FabrikWorker::getACLGroups( $a );
				foreach ($groupNames as $name) {
					FabrikWorker::setACL( 'action', 'allow_drop', 'fabrik', $name, 'components', null );
				}
				if ($acl->acl_check( 'action', 'allow_drop', 'fabrik', $user->get(' usertype' ), 'components', null )) {
					$this->_access->allow_drop = true;
				} else {
					$this->_access->allow_drop = false;
				}
			}
		}
		return $this->_access->allow_drop;		
	}

	/**
	 * check if the user can view the detailed records
	 *
	 * @return bol
	 */

	function canViewDetails()
	{
		$user  	=& JFactory::getUser();
		$acl 		=& JFactory::getACL();
		$table 	=& $this->getTable();
		$params =& $this->getParams();
		$a = $params->get( 'allow_view_details', 0 );
		if ($a == '29'|| $a == ''|| $a == 0) {
			$this->_access->viewdetails =  true;
		} else {
			if (!is_object( $this->_access ) || !array_key_exists( 'viewdetails', $this->_access )) {
				$groupNames =& FabrikWorker::getACLGroups( $a );
				foreach ($groupNames as $name) {
					FabrikWorker::setACL( 'action', 'viewdetails', 'fabrik', $name, 'components', null );
				}
				if ($acl->acl_check( 'action', 'viewdetails', 'fabrik', $user->get(' usertype' ), 'components', null )) {
					$this->_access->viewdetails = true;
				} else {
					$this->_access->viewdetails = false;
				}
			}
		}
		return $this->_access->viewdetails;
	}

	/**
	 * checks user access for editing records
	 *
	 * @return bol access allowed
	 */

	function canEdit()
	{
		$user  	=& JFactory::getUser();
		$acl 		=& JFactory::getACL();
		$table 	=& $this->getTable();
		$params =& $this->getParams();
		$a = $params->get( 'allow_edit_details', 25 );
		if ($a == '29'|| $a == ''|| $a == 0) {
			$this->_access->edit =  true;
		} else {
			if(!is_object($this->_access) || !array_key_exists('edit', $this->_access)){
				$groupNames = FabrikWorker::getACLGroups( $a );
				foreach ($groupNames as $name) {
					FabrikWorker::setACL( 'action', 'edit', 'fabrik', $name, 'components', null );
				}
				if ($acl->acl_check( 'action', 'edit', 'fabrik', $user->get( 'usertype' ), 'components', null )) {
					$this->_access->edit = true;
				} else {
					$this->_access->edit = false;
				}
			}
		}
		return $this->_access->edit;
	}

	/**
	 * checks user access for deleting records
	 *
	 * @return bol access allowed
	 */

	function canDelete()
	{
		$user  	= &JFactory::getUser();
		$acl 		=& JFactory::getACL();
		$table 	=& $this->getTable();
		$params =& $this->getParams();
		$a = $params->get( 'allow_delete', 25 );
		if ($a == '29'|| $a == '' || $a == 0 ){
			$this->_access->delete =  true;
		} else {
			if (!is_object( $this->_access ) || !array_key_exists( 'delete', $this->_access )) {
				$groupNames = FabrikWorker::getACLGroups( $a );
				foreach ($groupNames as $name) {
					FabrikWorker::setACL( 'action', 'delete', 'fabrik', $name, 'components', null );
				}
				if ($acl->acl_check( 'action', 'delete', 'fabrik', $user->get( 'usertype' ), 'components', null )) {
					$this->_access->delete = true;
				} else {
					$this->_access->delete = false;
				}
			}
		}
		return $this->_access->delete;
	}

	/**
	 * checks user access for adding records
	 *
	 * @return bol access allowed
	 */

	function canAdd()
	{
		$user  	=& JFactory::getUser();
		$acl 		=& JFactory::getACL();
		$params =& $this->getParams();
		$table 	=& $this->getTable();
		$a = $params->get( 'allow_add', 25 );
		if ($a == '29' || $a == ''|| $a == 0){
			$this->_access->add =  true;
		} else {
			if (!is_object( $this->_access ) || !array_key_exists( 'add', $this->_access )) {
				$groupNames = FabrikWorker::getACLGroups( $a );
				foreach ($groupNames as $name) {
					FabrikWorker::setACL( 'action', 'add', 'fabrik', $name, 'components', null );
				}
				if ($acl->acl_check( 'action', 'add', 'fabrik', $user->get( 'usertype' ), 'components', null )) {
					$this->_access->add = true;
				} else {
					$this->_access->add = false;
				}
			}
		}
		return $this->_access->add;
	}

	/**
	 * check use can view the table
	 * @return bol can view or not
	 */

	function canView( ){
		$user  	=& JFactory::getUser();
		$acl 		=& JFactory::getACL();
		$table 	=& $this->getTable();
		if ($table->access == '29'|| $table->access == '' || $table->access == 0) {
			$this->_access->view =  true;
		} else {
			if (!is_object($this->_access) || !array_key_exists('view', $this->_access)) {
				$groupNames = FabrikWorker::getACLGroups( $table->access );
				foreach ($groupNames as $name) {
					FabrikWorker::setACL( 'action', 'view', 'fabrik', $name, 'components', null );
				}
				if ($acl->acl_check( 'action', 'view', 'fabrik', $user->get('usertype'), 'components', null )) {
					$this->_access->view =  true;
				} else {
					$this->_access->view = false;
				}
			}
		}
		return $this->_access->view;
	}

	/**
	 * load the table from the form_id value
	 * @param int $formId
	 * @return object table row
	 */

	function loadFromFormId( $formId ){
		JTable::addIncludePath( JPATH_ADMINISTRATOR.DS.'components'.DS.'com_fabrik'.DS.'table' );
		$row = JTable::getInstance( 'table', 'Table' );
		$origKey = $row->_tbl_key;
		$row->_tbl_key = "form_id";
		$row->load( $formId );
		$this->_table = $row;
		$row->_tbl_key = $origKey;
		$this->setId( $row->id );
		return $row;
	}

	/**
	 * alias to loadJoins - should be used instead
	 * @return array join objects (table rows - not table objects or models)
	 */

	function &getJoins()
	{
		if (!isset( $this->_aJoins )) {
			$form =& $this->getForm();
			$form->getGroupsHiarachy( false );
			$ids = $form->getElementIds();
			$table =& $this->getTable();
			$db =& JFactory::getDBO();
			$sql = "SELECT * FROM #__fabrik_joins WHERE table_id = '$this->_id'";
			if (!empty( $ids )) {
				$sql .= " OR element_id IN ( " . implode(", ", $ids) .")";
			}
			//maybe we will have to order by element_id asc to ensure that table joins are loaded
			//before element joins (if an element join is in a table join then its 'join_from_table' key needs to be updated
			$sql .= " ORDER BY id";
			$db->setQuery( $sql );
			$this->_aJoins = $db->loadObjectList( );
			if ($db->getErrorNum()) {
				JError::raiseError( 500, $db->stderr());
			}

			$aliases = array();
			$tableGroups = array();
			
			foreach ($this->_aJoins as $join) {
				//if their 'table_join' has been used then update with an alais
				if (in_array( $join->table_join, $aliases )) {
					$base = $join->table_join;
					$a = $base;
					$c = 0;
					while (in_array( $a, $aliases )) {
						$a = "{$base}_{$c}";
						$c ++;
					}
					$join->table_join_alias = $a;
				} else {
					$join->table_join_alias = $join->table_join;
				}
				$aliases[] = $join->table_join;

				//if they are element joins add in this tables name as the calling joining table.
				if ($join->join_from_table == '') {
					$join->join_from_table = $table->db_table_name;
				}
				
				// test case:
				/*
				 * you have a talbe that joins to a 2nd table
				 * in that 2nd table there is a database join element
				 * that 2nd elements key needs to point to the 2nd tables name and not the first
				 * 
				 * e.g. when you want to create a n-n relationship
				 * 
				 * events -> (table join) events_artists -> (element join) artist  
				 */
				
				$join->keytable = $join->join_from_table;
				if (!array_key_exists( $join->group_id, $tableGroups )) {
					$tableGroups[$join->group_id] = $join->table_join_alias;
				} else {
					if ($join->element_id != 0) {
						$join->keytable = $tableGroups[$join->group_id];
					}
				}
			}
		}
		return $this->_aJoins;
	}


	/**
	 * gets the field names for the given table
	 * @param string table name
	 * @return array table fields
	 */

	function getDBFields( $tbl = null )
	{
		if (is_null( $tbl )) {
			$table =& $this->getTable();
			$tbl = $table->db_table_name ;
		}
		if (!strstr( $tbl, '`' )) {
			$tbl = "`$tbl`";
		}
		if (!isset( $this->_dbFields[$tbl] ) ){
			$db =& $this->getDb();
			$db->setQuery( "DESCRIBE $tbl" );
			$this->_dbFields[$tbl] = $db->loadObjectList( );
		}
		return $this->_dbFields[$tbl];
	}

	/**
	 * add or update a database column via sql
	 * @param object element plugin
	 * @param bol is new
	 * @param string origional field name
	 */

	function alterStructure( &$elementModel, $new, $origColName=null )
	{
		$db =& JFactory::getDBO();
		$element =& $elementModel->getElement();
		$pluginManager =& JModel::getInstance( 'Pluginmanager', 'FabrikModel' );
		$basePlugIn =& $pluginManager->getPlugIn( $element->plugin, 'element' );
		$fbConfig = JComponentHelper::getParams( 'com_fabrik' );
		$fabrikDb =$this->getDb();
		$table =& $this->getTable();
		$tableName = $table->db_table_name;
		$objtype 		= $basePlugIn->getFieldDescription();
		$dbdescriptions = $this->getDBFields( $tableName );
		if (!$fbConfig->get( 'fbConf_alter_existing_db_cols' )) {
			foreach ($dbdescriptions as $f) {
				if ($f->Field == $origColName) {
					$objtype = $f->Type;
				}
			}
		}

		if (!is_null( $objtype )) {
			foreach ($dbdescriptions as $dbdescription) {
				$fieldname = $dbdescription->Field;
				$exitingfields[] = strtolower($fieldname);
			}
			$lastfield = $fieldname;
			if (in_array( strtolower($element->name), $exitingfields )) {
				return ;
			}

			FabrikString::safeColName( $element->name );
			FabrikString::safeColName( $tableName );
			FabrikString::safeColName( $lastfield );

			if (( $new && !in_array( strtolower($element->name), $exitingfields) ) || !in_array( strtolower($origColName), $exitingfields )) {
				$sql = "ALTER TABLE $tableName ADD COLUMN $element->name $objtype AFTER $lastfield";
			} else {
				if ($origColName == null) {
					$origColName = $element->name;
				}
				FabrikString::safeColName( $origColName );
				$sql = "ALTER TABLE $tableName CHANGE $origColName " . $element->name ;
				$sql .= " $objtype";
			}
			$fabrikDb->setQuery( $sql );
			if (!$fabrikDb->query( )) {
				return JError::raiseError( 500, 'alter structure: ' . $fabrikDb->getErrorMsg( ));
			}
			$this->createCacheQuery();
		}
		return true;
	}

	/**
	 * if not loaded this loads in the table's form object
	 * also binds a reference of the table to the form.
	 * @return object form model with form table loaded
	 */

	function &getForm()
	{
		if (is_null( $this->_oForm )) {
			$this->_oForm =& JModel::getInstance( 'Form', 'FabrikModel' );
			$table =& $this->getTable();
			$this->_oForm->setId( $table->form_id );
			$this->_oForm->getForm();
			$this->_oForm->setTableModel( $this );
			//ensure joins are loaded
		}
		return $this->_oForm;
	}

	/**
	 * tests if the table is in fact a view
	 * @returns true if table is a view
	 */

	function isView()
	{
		$params =& $this->getParams();
		$isview = $params->get('isview', null);

		if (is_null($isview)) {
			$db =& JFactory::getDBO();
			$table =& $this->getTable();
			$cn = $this->getConnection();
			$c = $cn->getConnection();
			$dbname = $c->database;
			$sql = "show table status like '$table->db_table_name'";
			$sql = " select table_name, table_type, engine from INFORMATION_SCHEMA.tables ".
			"where table_name = '$table->db_table_name' and table_type = 'view' and table_schema = '$dbname'";
			$db->setQuery( $sql );
			$row = $db->loadObjectList();
			$isview = empty($row) ? false : true;
			$intisview = $isview ? 1 : 0;
			//store and save param for following tests
			$params->set('isview', $isview);
			$table->attribs .= "\nisview=$intisview\n";
			$table->store();
		}
		return $isview;
	}

	/** DEPRECIATED SHOULD NOT BE NEEDED NOW
	 function _loadJoinOnce( $join )
	 {
		return $join->table_join;
		}
	 **/

	/**
	 * filter array is created in $this->_loadFilterArray
	 *@return array filters
	 */

	function &getFilterArray( )
	{
		if (isset( $this->_aFilter )) {
			return $this->_aFilter;
		}

		$user  					= &JFactory::getUser();
		$request 				= $this->getRequestData();
		$this->_aFilter = array();

		$this->_aPrefilters =& $this->getPrefilterArray();
		$form 					=& $this->getForm();

		$filterCondSQL	= '';
		$aPostFilters 	= array();
		$useFullName 		=  JRequest::getBool( 'fullName', 1 );

		if (is_null( $form->_groups )) {
			$form->getGroupsHiarachy();
		}
		foreach ($form->_groups as $groupModel) {
			$group =& $groupModel->getGroup();
			foreach ($groupModel->_aElements as $elementModel) {
				$element =& $elementModel->getElement();
				$thisData =  $this->_aData;
				if ($group->is_join) {
					if (@array_key_exists( 'join', $request ) && @is_array( $request['join'][$group->join_id] )) {
						$thisData = $this->_aData['join'][$group->join_id];
					}
					$key 	= $elementModel->getFilterFullName( false, true, false );
				} else {
					$key = $elementModel->getFilterFullName( true, true, false );
				}
				$dbKey = str_replace( "___", ".", $key );
				$dbKey = FabrikWorker::getDbSafeName( $dbKey );
				if (array_key_exists( $key, $request )) {
					$safeKey = FabrikWorker::getDbSafeName( $dbKey );
					$arr = $elementModel->getFilterConditionSQL( $request[$key], $this->_aFilter, $safeKey, $key );
					$arr['no-filter-setup'] = ($element->filter_type == '') ? 1 : 0;
					$arr['ellabel'] = $element->label;
					if (!empty( $arr['sqlCond'] )) {

						$sqlCond = "( " . $arr['sqlCond'] ;
						//check if the filter has a corresponding prefilter set.
						if (array_key_exists( $key, $this->_aPrefilters )) {
							$sqlCond .=  " AND " . $this->_aPrefilters[$key]['sqlCond'];
							unset( $this->_aPrefilters[$key] );
						}
						$sqlCond .= ")";
						$arr['sqlCond'] = $sqlCond;
						$arr['type'] = 'postfilter';
						//TODO: make this and/or choice somehow for use perhaps?
						$arr['concat'] = ' AND ';
						$arr['grouped_to_previous'] = false;
						$this->_aFilter[$key] = $arr;
					}
				}
			}
		}
		$this->_searchesNoFilterSetup = array();
		return $this->_aFilter;
	}

	/**
	 * creates array of prefilters
	 * @return array prefilter
	 */

	function &getPrefilterArray( )
	{
		$params =& $this->getParams();
		$afilterJoins 			= $params->get( 'filter-join', '', '_default', 'array' );
		$afilterFields 			= $params->get( 'filter-fields', '', '_default', 'array' );
		$afilterConditions 	= $params->get( 'filter-conditions', '', '_default', 'array' );
		$afilterValues 			= $params->get( 'filter-value', '', '_default', 'array' );
		$afilterAccess 			= $params->get( 'filter-access', '', '_default', 'array' );
		$afilterEval	 			= $params->get( 'filter-eval', '', '_default', 'array' );
		$afilterGrouped	 		= $params->get( 'filter-grouped', '', '_default', 'array' );
		$appliedPrefilters = 0;
		$selJoin = 'WHERE';
		$aReturn = array();
		$w = new FabrikWorker();
		for ( $i=0;$i<count( $afilterFields );$i++ ) {
			if (!array_key_exists(0, $afilterJoins) || $afilterJoins[0] == '' ){
				$afilterJoins[0] = 'and';
			}
			$selJoin 	  = $afilterJoins[$i];

			if (trim( strtolower( $selJoin ) ) == 'where' ) {
				$selJoin = "AND";
			}
			$selFilter 	  = $afilterFields[$i];
			$selCondition = $afilterConditions[$i];
			$selValue 	  = $afilterValues[$i];
			$filerEval	  = $afilterEval[$i]; // "" or "1"
			$filterGrouped= $afilterGrouped[$i];

			if ($filerEval == '1' ){
				$selValue 	= stripslashes( htmlspecialchars_decode( $selValue, ENT_QUOTES ) );
				$selValue 	  = eval( $selValue );
			}

			$selAccess 	  = $afilterAccess[$i];
			if (!$this->mustApplyFilter( $selAccess, $i )) {
				continue;
			}
			$selValue = $this->_prefilterParse( $selValue );

			$selValue 	  = $w->parseMessageForPlaceHolder( $selValue );

			//strip any quotes from the selValue (replaced back in the switch beneath)
			if (!in_array( $selCondition, array( '>',  '&gt;', ' > ', '<', '&lt;' ))) {
				$selValue = ltrim( $selValue, "'" );
				$selValue = rtrim( $selValue, "'" );
				$selValue = ltrim( $selValue, '"' );
				$selValue = rtrim( $selValue, '"' );
			}
			switch( $selCondition ){
				case 'notequals':
					$selCondition = " <> ";
					$selValue = "'$selValue'";
					break;
				case 'equals':
					$selCondition = " = ";
					$selValue = "'$selValue'";
					break;
				case 'begins':
					$selCondition = " LIKE ";
					//if its a quoted string put the % inside the quote
					if ($string{0} == '"' || $string{0} == '"') {
						$selValue = substr(0, -1) . "%" . $string{0};
					} else {
						$selValue = "'$selValue%'";
					}
					break;
				case 'ends':
					$selCondition = " LIKE ";
					if ($string{0} == '"' || $string{0} == '"') {
						$selValue = $string{0} . "%" .  substr(0, 1) ;
					} else {
						$selValue = "'%$selValue'";
					}
					break;
				case 'contains':
					$selCondition = " LIKE ";
					if ($string{0} == '"' || $string{0} == '"') {
						$selValue = $string{0} . "%" .  substr(0, 1) ;
					} else {
						$selValue = "'%$selValue%'";
					}
					break;
				case '>':
				case '&gt;':
					$selCondition = ' > ';
					break;
				case '<':
				case '&lt;':
					$selCondition = ' < ';
					break;
			}
				
			if ($selCondition == ' = ' && $selValue == "'_null_'") {
				$strCond = " $selFilter IS NULL ";
			} else {
				$strCond = " $selFilter $selCondition $selValue ";
			}
			$aReturn[] = array('type' => '', 'value' =>$selValue, 'filterVal' => $selValue,  'sqlCond' => $strCond, 'concat' => $selJoin,
				 'type' => 'prefilter', 'grouped_to_previous' => $filterGrouped);
			$appliedPrefilters ++;
		}
		return $aReturn;
	}

	/**
	 * get the total number of records in the table
	 * @return int total number of records
	 */

	function getTotalRecords( )
	{
		$db =& $this->getDb();
		$table = $this->getTable();
		$formModel =& $this->getForm();
		$this->getFormGroupElementData( );
		$count = "DISTINCT " . $table->db_primary_key;
		foreach ( $formModel->_groups as $groupModel ) {
			foreach ( $groupModel->_aElements as $elementModel ) {
				$element =& $elementModel->getElement();
				if ( $element->show_in_table_summary && $element->plugin == "fabrikDatabasejoin" ) {
					$count = "*";
				}
			}
		}
		$totalSql  	= "SELECT COUNT(" . $count . ") AS t FROM " . $table->db_table_name . " " . $this->_buildQueryJoin( );
		$totalSql 	.= " " . $this->_buildQueryWhere();
		$db->setQuery( $totalSql );
		$total  	= $db->loadResult( );
		return $total;
	}

	/**
	 * load in the elements for the table's form
	 * If no form loaded for the table object then one is loaded
	 * @param bol if true only those elements marked as 'show_in_table_view' are returned (leave null for default admin behaviour)
	 * @param bol if true only those elements that are published are returned
	 * @return array element objects
	 */

	function &getFormGroupElementData( $tableViewOnly = null, $excludeUnpublished = true )
	{
		$formModel =& $this->getForm( );
		if (is_null( $tableViewOnly )) {
			$tableViewOnly = true;
		}
			
		$k = $tableViewOnly.'.'.$excludeUnpublished;
		if (!array_key_exists( $k, $this->_formGroupElementData)) {
			$formModel->setTableModel( $this );
			$this->_formGroupElementData[$k] =& $formModel->getGroupsHiarachy( $tableViewOnly, $excludeUnpublished );
		}

		return $this->_formGroupElementData[$k];
	}

	/**
	 * require the correct pagenav class based on template
	 *
	 * @param int total
	 * @param int start
	 * @param int length
	 * @return object pageNav
	 */

	function &_getPagination( $total, $limitstart, $limit ){
		$o =& new FPagination( $total, $limitstart, $limit );
		$o->_postMethod = $this->_postMethod;
		return $o;
	}

	/**
	 * used to determine which filter action to use
	 *if a filter is a range then override tables setting with onsubmit
	 */

	function getFilterAction()
	{
		if (!isset( $this->_real_filter_action )) {
			$form =& $this->getForm();
			$table =& $this->getTable();
			$this->_real_filter_action = $table->filter_action;
			foreach ($form->_groups as $groupModel) {
				foreach ($groupModel->_aElements as $elementModel) {
					$element =& $elementModel->getElement();
					if ($element->filter_type <> '') {
						if ($elementModel->canView() && $elementModel->canUseFilter() && $element->show_in_table_summary == '1' ) {
							if($element->filter_type == 'range'){
								$this->_real_filter_action = 'submitform';
								return $this->_real_filter_action;
							}
						}
					}
				}
			}
		}
		return  $this->_real_filter_action;
	}

	/**
	 * gets the part of a url to describe the key that the link links to
	 * if a table this is rowid=x
	 * if a view this is view_primary_key={where statement}
	 *
	 * @param object row $data
	 * @return string
	 */

	function getKeyIndetifier( $data )
	{
		$table =& $this->getTable();
		if (!$this->isView()) {
			return "&rowid=$data->__pk_val";
		} else {
			$k = array();
			$fields = $this->_fetchFields();
			foreach ($fields as $f) {
				if ($f->primary_key == 1){
					$y = "{$f->table}___{$f->name}";
					$k[] = "{$f->table}.{$f->name} = " . $data->$y;
				}
			}
			$k = implode(' AND ', $k);
			$k = "&view_primary_key=" . urlencode($k);
			return $k;
		}
	}

	/**
	 * *get detailed info on each of the tables fields
	 *
	 * @return unknown
	 */

	function _fetchFields()
	{
		$table =& $this->getTable();
		$db =& $this->getDb();
		$db->setQuery("select * from $table->db_table_name limit 1");
		if (!($result = $db->query())) {
			return null;
		}
		$fields       = array();
		$num_fields   = mysql_num_fields($result);
		for ($i = 0; $i < $num_fields; $i++) {
			$fields[] = mysql_fetch_field($result, $i);
		}
		return $fields;
	}


	/**
	 * @return array of element objects that are database joins and that
	 * use this table's key as their foregin key
	 *
	 */

	function getJoinsToThisKey()
	{
		if (is_null( $this->_joinsToThisKey )) {
			$db =& JFactory::getDBO();
			$table =& $this->getTable();
			if ($table->id == 0 ) {
				$this->_joinsToThisKey = array();
			} else {
				$sql = "SELECT *, t.label AS tablelabel, t.db_table_name FROM #__fabrik_elements AS el " .
			  			"LEFT JOIN #__fabrik_formgroup AS fg 
						ON fg.group_id = el.group_id 
						LEFT JOIN #__fabrik_forms AS f 
						ON f.id = fg.form_id 
						LEFT JOIN #__fabrik_tables AS t 
						ON t.form_id = f.id " .
			  			"WHERE " . 
			  			" plugin = 'fabrikDatabasejoin' AND" .
			  			" el.attribs like '%join_db_name=".$table->db_table_name."%' " .
			  			"AND el.attribs like  '%join_conn_id=".$table->connection_id."%' ";
					
				$db->setQuery( $sql );
				$this->_joinsToThisKey = $db->loadObjectList( );
			}
		}
		return $this->_joinsToThisKey;
	}

	/**
	 * get an array of elements that point to a form where their data will be filtered
	 * @return array
	 */

	function getLinksToThisKey()
	{
		$params =& $this->getParams();
		$aExisitngLinked = $params->get( 'linkedform', '', '_default', 'array' );
		$aAllJoinsToThisKey = $this->getJoinsToThisKey( );
		$aJoinsToThisKey= array();
		foreach ( $aAllJoinsToThisKey as $join ) {
			if ( in_array( $join->db_table_name, $aExisitngLinked )){
				$aJoinsToThisKey[] = $join;
			} else {
				$aJoinsToThisKey[] = '';
			}
		}
		return $aJoinsToThisKey;
	}

	/**
	 * creates an array of html code for each filter
	 * @param object database
	 * @param string table name
	 * @param array current filter states
	 * @return array of html code for each filter
	 */

	function &makeFilters( )
	{
		$aFilters = array();
		$this->getFilterArray( );
		$form =& $this->getForm();
		$table =& $this->getTable();
		foreach ($form->_groups as $k => $val) {
			$groupModel =& $form->_groups[$k];
			foreach ($groupModel->_aElements as $kk => $val2) {
				$elementModel = $groupModel->_aElements[$kk]; //dont do with =& as this foobars up the last elementMOdel
				$element =& $elementModel->getElement();

				if ($element->filter_type <> '') {
					if ($elementModel->canView() && $elementModel->canUseFilter() && $element->show_in_table_summary == '1' ) {
						//force the correct group model into the element model to ensure no wierdness in getting the element name
						$elementModel->_group =& $groupModel;
						$aFilters[$element->label] = $elementModel->getFilter( );
					}
				}
			}
		}

		//check for search form filters - if they exists create hidden elements for them
		foreach( $this->_aFilter as $key=>$f) {
			if ($f['no-filter-setup']) {
				$name = str_replace('.', '___', $key) . "[value]";
				$aFilters[$f['ellabel']] = "<input class='fabrik_filter' type='hidden' name='$name' value='" . $f['filterVal'] . "' />" . $f['filterVal'];
			}
		}

		//new moved advanced filters to table settings
		$params =& $this->getParams();
		if ($params->get( 'advanced-filter', '0' )) {
			$fieldNames[] = JHTML::_( 'select.option', '', JText::_( 'Please select' ) );
			$longLabel = false;
			foreach ($form->_groups as $groupModel) {
				$group =& $groupModel->getGroup();
				if ($group->is_join) {
					$longLabel = true;
				}
			}
			foreach ($form->_groups as $groupModel) {
				foreach ($groupModel->_aElements as $elementModel) {
					$element =& $elementModel->getElement();
					$elParams =& $elementModel->getParams();
					if ($elParams->get('inc_in_adv_search', 1)) {
						$elName = $elementModel->getFullName( false, false, false );
						//@TODO add a switch to use $elName as the label??
						$l =  $longLabel ? $elName : $element->label;
						$fieldNames[] = JHTML::_( 'select.option', $elName, $l );
					}
				}
			}
			$fields = FastJSON::encode($fieldNames);
			//todo: make database join elements filtereable on all their join table's fields

			$advancedFilters = JRequest::getVar( 'advancedFilterContainer', array(), 'default', 'none', 2 );
			$document =& JFactory::getDocument();
			FabrikHelperHTML::mocha( 'a.popupwin' );
			$url = '#';
			$advancedSearch = '<a rel="{\'id\':\'advanced-search-win\',\'width\':690,\'loadMethod\':\'html\', \'title\':\'' .  JText::_('Advanced search') . '\', \'maximizable\':\'1\',\'contentType\':\'html\'}" href="'. $url.'" class="popupwin">'. JText::_('Advanced search') .'</a>';
			$aWords = (array_key_exists( 'value', $advancedFilters )) ? explode( " ", $advancedFilters['value'] )  : array('');
			if (!($aWords[0] == "AND" || $aWords[0] == "OR" )) {
				array_unshift( $aWords, "AND" );
			}

			$aGroupedAdvFilters = array();
			$g = 0;
			$tmp = array();
			foreach ($aWords as $word) {
				$tmp[] = $word;
				if ($g == 3) {
					$aGroupedAdvFilters[] = $tmp;
					$tmp = array();
					$g = 0;
				} else {
					$g ++;
				}
			}
			$searchOpts = "$fields, ";
			$searchOpts .= empty($aGroupedAdvFilters) ? 'true' : 'false';
			$searchOpts .= ( $table->filter_action != 'submitform') ? ', true' : ', false';
			$searchOpts .=",{
			tableid:'$table->id'
		}";
		$script = "mochaSearch.conf($searchOpts);";
			
		foreach ($aGroupedAdvFilters as $bits) {
			$selJoin  = $bits[0];
			if ($bits[0] != "AND" && $bits[0] != "OR") {
				array_unshift($bits, "WHERE");
			}
			$selJoin 			= $bits[0];
			$selFilter 		= $bits[1];
			$selCondition = $bits[2];
			$selValue 		= $bits[3];

			switch( $selCondition )
			{
				case "<>":
					$jsSel = 'NOT EQUALS';
					break;
				case "=":
					$jsSel = 'EQUALS';
					break;
				case "<":
					$jsSel = 'LESS THAN';
					break;
				case ">":
					$jsSel = 'GREATER THAN';
					break;
				default:
					$firstChar = substr( $selValue, 1, 1 );
					$lastChar = substr( $selValue, -2, 1 );
					switch( $firstChar )
					{
						case "%":
							$jsSel =( $lastChar == "%")? 'CONTAINS' : $jsSel = 'ENDS WITH';
							break;
						default:
							if( $lastChar == "%"){
								$jsSel = 'BEGINS WITH';
							}
							break;
					}
					break;
			}
			$selValue = trim( trim( $selValue, '"' ), "%" );
			$script .= "\n mochaSearch.addFilterOption('$selJoin', '$selFilter', '$jsSel', '$selValue');\n";
		}
		$document->addScriptDeclaration( $script );
		$aFilters['']  = $advancedSearch . "<input type='hidden' name=\"advancedFilterContainer[value]\" value='' id=\"advancedFilterContainer\" />";
		}
		return $aFilters;
	}

	/**
	 * returns the table headings, seperated from writetable function as
	 * when group_by is selected mutliple tables are written
	 * @return array (table headings, array columns, $aLinkElements)
	 */

	function _getTableHeadings( )
	{
		global $mainframe;
		$table =& $this->getTable();
		$aLinkElements 				= array();
		$aNamedTableHeadings 	= array( );
		$aTableHeadings 			= array();
		$aCols 								= array();

		$session =& JFactory::getSession();
		//$session->destroy();
		$formModel =& $this->getForm();
		foreach ($formModel->_groups as $groupModel) {
			foreach ($groupModel->_aElements as $key => $elementModel) {
				$viewLinkAdded = false;
				$element =& $elementModel->getElement();
				if (!$element->show_in_table_summary) {
					continue;
				}

				//hide any elements that should not be access by the user for their group id
				if (!$elementModel->canView( )) {
					continue;
				}
				$key 		= $elementModel->getFullName( false, true, false );
				$orderKey 	= $elementModel->getOrderbyFullName( false, false );
				$aCols[$key] = '';
				if ($element->link_to_detail == '1') {
					$aLinkElements[] = $key;
				}
				if ($element->can_order == '1' && $this->_outPutFormat != 'csv' ) {
					$context			= 'com_fabrik.table.' . $this->_id . '.order.' . $key;
					$orderDir			= $session->get( $context );
					$class 		= "";
					$currentOrderDir = $orderDir;
					switch ($orderDir) {
						case "desc":
							$orderDir = "-";
							$class = "class='fabrikorder-desc'";
							break;
						case "asc":
							$orderDir = "desc";
							$class = "class='fabrikorder-asc'";
							break;
						case "":
						case "-":
							$orderDir = "asc";
							$class = "class='fabrikorder'";
							break;
					}

					if ($class == '') {
						if ($table->order_by == $key) {
							if (strtolower( $table->order_dir ) == 'desc') {
								$class = "class='fabrikorder-desc'";
							}
						}
					}
					$orderjs = "oPackage.fabrikNavOrder( $table->id, ";
					$heading = "<a $class href='#'>$element->label</a>";
				} else {
					$heading = $element->label;
				}
				$aTableHeadings[$key] = $heading;
				$aNamedTableHeadings[$key . "_heading"] = $heading;
			}
		}
		if ( $this->_outPutFormat != 'pdf' && $this->_outPutFormat != 'csv' ){
			if ($this->canDelete()) {
				$delete = '<label><input type="checkbox" id="table_' . $this->_id . '_checkAll" />' . JText::_('Delete') . "</label>";
				$aTableHeadings['fabrik_delete'] = $delete;
				$aNamedTableHeadings['fabrik_delete_heading'] = $delete;
			}
			//if no elements linking to the edit form add in a edit column (only if we have the right to edit/view of course!)
			if (empty( $aLinkElements ) and ($this->canView() || $this->canEdit())) {
				if ($this->canEdit()) {
					$aTableHeadings['fabrik_edit'] = JText::_('Edit');
					$aNamedTableHeadings['fabrik_edit_heading'] = JText::_('Edit');
				} else {
					if ($this->canViewDetails()) {
						$aTableHeadings['fabrik_edit'] = 'View';
						$viewLinkAdded = true;
						$aNamedTableHeadings['fabrik_edit_heading'] = JText::_('View');
					}
				}
			}
			if ($this->canViewDetails() && $this->_params->get( 'detaillink' ) == '1' && !$viewLinkAdded ) {
				$aTableHeadings['__details_link'] = JText::_( 'View' );
				$aNamedTableHeadings['__details_link'] = JText::_( 'View' );
			}

			// create columns containing links which point to tables associated with this table
			$params =& $this->getParams();
			$aExisitngLinkedTables = $params->get('linkedtable', '', '_default', 'array');
			$aExistingTableHeaders = $params->get( 'linkedtableheader', '', '_default', 'array' );
			$joinsToThisKey = $this->getJoinsToThisKey( );
			$f = 0;
			foreach ($joinsToThisKey as $element) {
				if (is_object( $element )) {
					$linkedTable 	= array_key_exists( $f, $aExisitngLinkedTables ) ? $aExisitngLinkedTables[$f] : false;
					$heading = array_key_exists( $f, $aExistingTableHeaders ) ? $aExistingTableHeaders[$f] : false;
					if ($linkedTable != '0') {
						$prefix 	= ( $element->tablelabel == $table->label ) ? $table->db_primary_key : $element->db_table_name . "___" . $element->name;
						$aTableHeadings[$prefix . "_table_heading"] = empty($heading) ? $element->tablelabel . " " . JText::_('Table') : $heading;
						$aNamedTableHeadings[ $prefix . "_table_heading"] = empty($heading) ? $element->tablelabel . " " . JText::_('Table') : $heading;
					}
				}
				$f ++;
			}
			$linksToForms =  $this->getLinksToThisKey( );
			$aExisitngLinkedForms = $params->get( 'linkedform', '', '_default', 'array' );
			$aExistingFormHeaders 	= $params->get( 'linkedformheader', '_default', '', 'array' );

			$f = 0;
			foreach ($linksToForms as $element ) {
				$linkedForm 	= array_key_exists( $f, $aExisitngLinkedForms ) ? $aExisitngLinkedForms[$f] : false;
				if ($linkedForm != '0') {
					$heading = array_key_exists( $f, $aExistingFormHeaders ) ? $aExistingFormHeaders[$f] : '';
					$prefix	= $element->db_table_name . "___" . $element->name;
					$aTableHeadings[$prefix . "_form_heading"] = empty($heading) ? $element->tablelabel . " " . JText::_('Form') : $heading;
					$aNamedTableHeadings[ $prefix . "_form_heading"] = empty($heading) ? $element->tablelabel . " " . JText::_('Form') : $heading ;
				}
				$f ++;
			}
		}
		return array( $aTableHeadings, $aCols, $aLinkElements, $aNamedTableHeadings );
	}

	/**
	 * return mathematical column calculations (run at doCalculations() on for submission)
	 */

	function getCalculations( ){
		$user  = &JFactory::getUser();
		$aCalculations = array();
		$formModel =& $this->getForm();
		$aAvgs = array();
		$aSums = array();
		$aMedians = array();
		$aCounts = array();
		if ( !is_array($formModel->_groups ) ){
			$formModel->getGroupsHiarachy( );
		}
		if ( is_array( $formModel->_groups ) ){
			foreach ($formModel->_groups as $groupModel ){
				if ( is_array( $groupModel->_aElements ) ){
					foreach( $groupModel->_aElements as $elementModel ){
						$params = $elementModel->getParams();
						$elName = $elementModel->getFullName( false, true, false );
						$sum 			= $params->get( 'sum_on', '0' );
						$avg 			= $params->get( 'avg_on', '0' );
						$median 		= $params->get( 'median_on', '0' );
						$countOn 		= $params->get( 'count_on', '0' );

						$sumAccess 		= $params->get( 'sum_access', 0 );
						$avgAccess 		= $params->get( 'avg_access', 0 );
						$medianAccess 	= $params->get( 'median_access', 0 );
						$countAccess 	= $params->get( 'count_access', 0 );

						if ($sumAccess <= $user->get('gid') && $params->get('sum_value', '') != ''){
							$aSums[ $elName ] = $params->get('sum_value', '');
							$aSums[ $elName . "_obj" ] = unserialize($params->get('sum_value_serialized'));
						}

						if ($avgAccess <= $user->get('gid') && $params->get('avg_value', '') != ''){
							$aAvgs[ $elName ] = $params->get('avg_value', '');
							$aSums[ $elName . "_obj" ] = unserialize($params->get('avg_value_serialized'));
						}
						if ($medianAccess <= $user->get('gid') && $params->get('median_value', '') != ''){
							$aMedians[ $elName ] = $params->get('median_value', '');
						}
						if ($countAccess <= $user->get('gid') && $params->get('count_value', '') != ''){
							$aCounts[ $elName ] = $params->get('count_value', '');
							$aSums[ $elName . "_obj" ] = unserialize($params->get('count_value_serialized'));
						}
					}
				}
			}
		}
		$aCalculations['sums'] 			= $aSums;
		$aCalculations['avgs'] 			= $aAvgs;
		$aCalculations['medians'] 		= $aMedians;
		$aCalculations['count'] 		= $aCounts;
		$this->_aRunCalculations =& $aCalculations;
		return $aCalculations;
	}

	/**
	 * get table headings to pass into table js oject
	 *
	 * @return string headings tablename___name
	 */

	function _jsonHeadings()
	{
		$aHeadings = array();
		$table =& $this->getTable();
		$formModel =& $this->getForm();
		foreach ($formModel->_groups as $groupModel) {
			foreach ($groupModel->_aElements as $elementModel) {
				$element =& $elementModel->getElement();
				if ($element->show_in_table_summary) {
					$aHeadings[] = $table->db_table_name . '___' . $element->name;
				}
			}
		}
		return "['" . implode("','", $aHeadings) . "']";
	}

	/**
	 * when form saved (and set to record in database)
	 * this is run to see if there is any table join data, if there is it stores it in $this->_joinsToProcess
	 *
	 * @param array form post data
	 * @param int row id (of main database table atm - need to test this out)
	 * @param string to split up table___col data with
	 * @return array [joinid] = array(join, group array);
	 */

	function preProcessJoin( $aData, $rowId, $split='___' )
	{
		$this->_joinsToProcess = array( );
		$formModel = $this->getForm( );
		if (!is_array( $formModel->_groups )) {
			$formModel->getGroupsHiarachy( );
		}
		$aJoinGroups = array( );
		foreach ($formModel->_groups as $groupModel) {
			$group =& $groupModel->getGroup();
			if ($group->is_join) {
				$joinModel =& JModel::getInstance( 'Join', 'FabrikModel' );
				$join = $joinModel->loadFromGroupId( $group->id, $this->_id );
				if (!array_key_exists( $join->id, $aJoinGroups )) {
					$aJoinGroups[$join->id] = array("join"=>$join, "groups"=>array($groupModel));
				} else {
					$aJoinGroups[$join->id]["groups"][] = $groupModel;
				}
			}
		}
		return $aJoinGroups;
	}

	/**
	 * check to see if a table exists
	 * @param string name of table (ovewrites form_id val to test)
	 * @param object database that contains the table if null then default $db object used
	 * @return boolean false if no table fodund true if table found
	 */

	function databaseTableExists( $tableName = null, $fabrikDatabase = null ){
		$db =& $this->getDb();
		if ($tableName === '') {
			return false;
		}
		$table =& $this->getTable();
		if (is_null( $tableName )) {
			$tableName = $table->db_table_name;
		}
		$sql = "SHOW TABLES LIKE '$tableName'";
		/* use the default Joomla database if no table database specified */
		if (is_null( $fabrikDatabase ) || !is_object( $fabrikDatabase )) {
			$fabrikDatabase = $this->getDb();
		}
		$fabrikDatabase->setQuery( $sql );
		$total = $fabrikDatabase->loadResult();
		if ($total == "") {
			return false;
		} else {
			return true;
		}
	}

	/**
	 * strip the table names from the front of the key
	 * @param array data to strip
	 * @return array stripped data
	 */

	function removeTableNameFromSaveData( $data, $split='___' ){
		foreach ($data as $key=>$val) {
			$akey = explode( $split, $key);
			if (count($akey) > 1) {
				$newKey = $akey[1];
				unset($data[$key]);
			} else {
				$newKey = $akey[0];
			}
			$data[$newKey] = $val;
		}
		return $data;
	}

	/**
	 * saves posted form data into a table, you can supply table name etc to override the objects
	 * variables, this is needed to allow form class to use this object to save to a database table
	 * that doesnt have a table view associated with it
	 * @param array data to save
	 * @param int row id to edit/updated
	 * @param bol is the data being saved into a join table
	 * @param string table name (optional - if not supplied uses the objects db_table_name
	 * @return bol true if saved ok
	 */

	function storeRow( $data, $rowId, $isJoin = false, $table = null )
	{
		//dont save a record if no data collected
		if ($isJoin && implode( $data ) == '') {
			return;
		}
		$fabrikDb 	=& $this->getDb();

		if (is_null( $table )) {
			$table 		= $this->_table->db_table_name;
		}
		FabrikString::safeColName( $table );

		$formModel =& $this->getForm();
		if ($isJoin) {
			$this->getFormGroupElementData( false, false );
		}
		$oRecord = new stdClass();
		$noRepeatFields = array();
		$c = 0;
		foreach ($formModel->_groups as $groupModel) {
			$group =& $groupModel->getGroup();

			if (($isJoin && $group->is_join) || (!$isJoin && !$group->is_join)) {
				foreach ($groupModel->_aElements as $elementModel) {
					$element = $elementModel->getElement();
					$key = $element->name;
					if ($elementModel->recordInDatabase( $data )) {
						if (array_key_exists( $key, $data ) && !in_array( $key, $noRepeatFields )) {
							$noRepeatFields[] = $key;
							$lastKey = $key;
							$oRecord->$key = $elementModel->storeDatabaseFormat( $data[$key], $data, $key );
							$c++;
						}
					}
				}
			}
		}
		$primaryKey = $this->_shortKey();

		if ($rowId != '' && $c == 1 && $lastKey == $primaryKey) {
			return;
		}
		if($isJoin){
		//	echo trim( $primaryKey, '`' ). " $table ";print_r($oRecord);exit;
		}
		if ($rowId == '' || $rowId == 0) {
			$ok = $fabrikDb->insertObject( $table, $oRecord, trim( $primaryKey, '`' ), false );
		} else {
			$ok = $fabrikDb->updateObject( $table, $oRecord, trim( $primaryKey, '`' ), false );
		}
		$this->_tmpSQL = $fabrikDb->getQuery();
		if (!$ok) {
			return JError::raiseWarning( 500, 'Store row failed: ' . $fabrikDb->getQuery() ) ;
		} else {
			$this->_lastInsertId = $fabrikDb->insertid() ;
			return true;
		}
	}


	/**
	 * get the short version of the primary key, e.g if key = table.key return "key"
	 *
	 * @return string short version of the primary key
	 */

	function _shortKey( $key = null, $removeQuotes = false ){
		if (is_null( $key )) {
			$key = $this->_table->db_primary_key;
		}
		if (strstr( $key, "." )) {
			$bits = explode( ".", $key );
			$key = array_pop( $bits );
		}
		if($removeQuotes){
			$key = str_replace("`", "", $key );
		}
		return $key;
	}

	/**
	 * called when the form is submitted to perform calculations
	 */

	function doCalculations()
	{
		$db =& JFactory::getDBO();
		$formModel =& $this->getForm();
		if (!is_array( $formModel->_groups )) {
			$formModel->getGroupsHiarachy( );
		}
		foreach ($formModel->_groups as $groupModel) {
			foreach ($groupModel->_aElements as $elementModel) {
				$params =& $elementModel->getParams();
				$update = false;
				if ($params->get( 'sum_on', 0 )) {
					$aSumCals = $elementModel->sum( $this );
					$params->set( 'sum_value_serialized', serialize( $aSumCals[1] ) );
					$params->set( 'sum_value', $aSumCals[0] );
					$update = true;
				}
				if ($params->get( 'avg_on', 0 )) {
					$aAvgCals = $elementModel->avg( $this );
					$params->set( 'avg_value_serialized', serialize( $aAvgCals[1] ) );
					$params->set( 'avg_value', $aAvgCals[0] );
					$update = true;
				}
				if ($params->get( 'median_on', 0 )) {
					$params->set( 'median_value', $this->median( $elementModel->median( $this ) ));
					$update = true;
				}
				if ($params->get( 'count_on', 0 )) {
					$aCountCals = $elementModel->avg( $this );
					$params->set( 'count_value_serialized', serialize( $aCountCals[1] ) );
					$params->set( 'count_value', $aCountCals[0] );
					$update = true;
				}
				if ($update) {
					$element =& $elementModel->getElement();
					$element->attribs = $params->updateAttribsFromParams( $params->toArray() );
					$element->store();
				}
			}
		}
	}

	/**
	 * calculate the median of an array of data values
	 * @param array data to use
	 * @return int median value
	 */

	function median( $aData ){
		sort( $aData );
		if ((count( $aData ) % 2)==1){
			/* odd */
			$midKey = floor( count( $aData ) / 2);
			return $aData[$midKey];
		} else {
			$midKey = floor( count( $aData ) / 2) - 1;
			$midKey2 = floor( count( $aData ) / 2) ;
			return ($aData[$midKey] + $aData[$midKey2]) / 2;
		}
	}


	/**
	 * check to see if prefilter should be applied
	 * Kind of an inverse access lookup
	 * @param int group id to check against
	 * @param string ref for filter
	 * @return bol must apply filter - true, ignore filter (user has enough access rights) false;
	 */

	function mustApplyFilter( $gid, $ref )
	{
		$user  	=& JFactory::getUser();
		$acl 		=& JFactory::getACL();
		if ($user->get( 'gid' ) == 0 || $gid == 100 ) {
			return true;
		}
		$groupNames = FabrikWorker::getACLGroups( $gid, '<=' );
		foreach ($groupNames as $name) {
			FabrikWorker::setACL( 'action', 'prefilter' . $ref, 'fabrik', $name, 'components', null );
		}
		if ($acl->acl_check( 'action', 'prefilter' . $ref, 'fabrik', $user->get('usertype'), 'components', null )) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * set the connection id - used when creating a new table
	 * @param int connection id
	 */

	function setConnectionId( $id )
	{
		$this->_table->connection_id = $id;
	}

	/**
	 * run each time a table is saved (plus when an element is saved )
	 * builds the sql query that the table getData function will use
	 * stores it in the cache/fabrik folder
	 * retrieved by getData when table rendered
	 */

	function createCacheQuery()
	{
		$q = $this->_buildQuery();
		$cache = &JFactory::getCache( 'com_fabrik' );
		$cache->store( $q, 'tablequery' . $this->_id );
	}

	/**
	 * return the default set of attributes when creating a new
	 * fabrik table
	 *
	 * @return string attributes
	 */

	function getDefaultAttribs()
	{
		return "detaillink=0
empty_data_msg=
advanced-filter=0
show-table-nav=1
pdf=
rss=0
feed_title=
feed_date=
rsslimit=150
rsslimitmax=2500
csv_import_frontend=0
csv_export_frontend=0
csvfullname=0
access=0
allow_view_details=0
allow_edit_details=0
allow_add=0
allow_delete=0
group_by_order=
group_by_order_dir=ASC
prefilter_query="; 
	}

	/**
	 * save the table from admin
	 *
	 * @return bol true if saved ok
	 */

	function save( )
	{
		$db 		=& JFactory::getDBO();
		$user 	=& JFactory::getUser();
		$config =& JFactory::getConfig();
		$id 		= JRequest::getInt( 'id', 0, 'post' );
		$this->setId( $id );
		$row =& $this->getTable();
		$formModel 	=& JModel::getInstance( 'Form', 'FabrikModel' );

		$post	= JRequest::get( 'post' );
		if (!$row->bind( $post )) {
			return JError::raiseWarning( 500, $row->getError() );
		}

		$filter	= new JFilterInput( null, null, 1, 1 );
		$introduction = JRequest::getVar( 'introduction', '', 'post', 'string', JREQUEST_ALLOWRAW );
		$row->introduction =$filter->clean( $introduction );

		$details	= JRequest::getVar( 'details', array(), 'post', 'array' );
		$row->bind( $details );

		if ($id == 0) {
			$newtable = trim( JRequest::getVar( '_database_name', '', 'post' ));

			//check the entered database table doesnt already exist
			if ($newtable != '' && $this->databaseTableExists( $newtable )) {
				return JError::raiseWarning( 500, JText::_( 'Database table already exists' ) );
			}

			//create fabrik form
			$formModel =& $this->_createLinkedForm( );

			//create fabrik group
			$groupData = array( "name" => $row->label , "label" => $row->label );

			JRequest::setVar( '_createGroup', 1, 'post' );
			$groupId = $this->_createLinkedGroup( $groupData, false );

			if ($newtable != '') {
				$connectionModel =& JModel::getInstance( 'Connection', 'FabrikModel' );
				$connectionModel->setId( JRequest::getInt( 'connection_id', -1, 'post' ) );

				$fabrikDb =& $connectionModel->getDb();
				//update some default table values
				$row->db_table_name = $newtable;
				$row->db_primary_key = "`".$newtable.'`.`fabrik_internal_id`';
				$row->auto_inc = 1;

				$this->createDBTable( $formModel, $newtable, $fabrikDb );

			} else {
				//new fabrik table but existing db table
				$this->_createLinkedElements( $groupId, $post );

			}
			//	set the tables form id
			$this->_updateFormId( $formModel->_form->id );
		}

		// 	save params - this file no longer exists? do we use models/table.xml instead??
		$params = new fabrikParams( $row->attribs, JPATH_COMPONENT.DS.'xml'.DS.'table.xml' );

		$row->attribs = $params->updateAttribsFromParams( JRequest::getVar( 'params', array(), 'post', 'array' ) );
		$row->rows_per_page 	= JRequest::getInt( 'rows_per_page', 10, 'post' );
		$row->auto_inc		 		= JRequest::getInt( 'auto_inc', 1, 'post' );

		FabrikHelperFabrik::publishDown( $row->publish_down );

		$pk = JRequest::getVar( 'db_primary_key' );
		if ($pk == '') {
			$aKey = $this->getPrimaryKeyAndExtra();
			$row->db_primary_key = "`".$row->db_table_name . "`.`" . $aKey['colname'] . "`";
		}
		if (!strstr( $row->order_by, $row->db_table_name . "___" )) {
			$row->order_by = $row->db_table_name . "___" . $row->order_by;
		}
		if (!$row->store( )) {
			return JError::raiseWarning( 500, $row->getError() );
		}

		// load in all the tables data - even if it wasnt in the post data
		$table =& $this->getTable();
		//needed if saving a table for first time (otherwise id = 0)
		$this->setId( $table->id );
		$this->updateJoins( );
		if (!$this->isView()) {
			// this was only run on a new table - but I've put it here so that if you upload a new table you can ensure that its columns are fixed
			$this->makeSafeTableColumns( );
			$this->updatePrimaryKey( $row->db_primary_key, $row->auto_inc );
		}
		$row->checkin( );

		$this->createCacheQuery();
		return true;
	}

	/**
	 * when saving a table that links to a database for the first time we
	 * automatically create a form to allow the update/creation of that tables
	 * records
	 * @access private
	 * @return object form model
	 */

	function &_createLinkedForm( )
	{
		$config		=& JFactory::getConfig();
		$user			=& JFactory::getUser();

		jimport('joomla.utilities.date');
		$createdate =& JFactory::getDate();
		$createdate = $createdate->toMySQL();

		$form = JTable::getInstance( 'Form', 'Table' );
		$table =& $this->getTable();
		$form->label							= $table->label;
		$form->record_in_database = 1;

		$form->created 						= $createdate;
		$form->created_by 				= $user->get( 'id' );
		$form->created_by_alias 	= $user->get( 'username' );
		$form->error							= JText::_( 'Some parts of your form have not been fully filled in, please check the specific error messages below and try again' );
		// @TODO : fabrik : 0.5 : create a overall fabrik params admin page
		//which sets the default settings for all forms, from which these settings below can be populated
		$form->submit_button_label 	= JText::_( 'Save' );
		$form->state							= $table->state;
		$form->form_template			= 'default';
		$form->view_only_template	= 'default';

		if(! $form->store() ){
			return JError::raiseError( 500, $form->getError() );
		}

		$this->_oForm =& JModel::getInstance( 'Form', 'FabrikModel' );
		$this->_oForm->setId( $form->id );
		$this->_oForm->getForm();
		return $this->_oForm;
	}

	/**
	 * create a group
	 * used when creating a fabrik table from an existing db table
	 *
	 * NEW also creates the formgroup
	 *
	 * @access private
	 * @param array group data
	 * @param bol is the group a join default false
	 * @return int group id
	 */

	function _createLinkedGroup( $data, $isJoin = false ) {
		$user =& JFactory::getUser();
		//jimport( 'joomla.utilities.date' );
		$createdate = JFactory::getDate();
		$createdate = $createdate->toMySQL();

		$group 										=& JTable::getInstance( 'Group', 'Table' );
		$group->bind( $data );
		$group->created 					= $createdate;
		$group->created_by 				= $user->get('id');
		$group->created_by_alias 	= $user->get('username');
		$group->state 						= 1;
		$group->attribs = "repeat_group_button=0
repeat_group_show_first=1
repeat_group_js_add=
repeat_group_js_delete=";
		$group->is_join = ($isJoin == true) ? 1 : 0;

		$group->store( );
		if (!$group->store()) {
			JError::raiseError( 500, $group->getError() );
		}


		//create form group
		$formid = $this->_oForm->_id;
		$formGroup = JTable::GetInstance( 'FormGroup', 'Table' );
		$formGroup->form_id = $formid;
		$formGroup->group_id = $group->id;
		$formGroup->ordering = 999999;
		if (!$formGroup->store()) {
			JError::raiseError( 500, $formGroup->getError() );
		}

		$formGroup->reorder( " form_id = '$formid'" );
		return $group->id;
	}

	/**
	 * Create a table to store the forms' data depending upon what groups are assigned to the form
	 * @param object form model
	 * @param string table name - taken from the table oject linked to the form
	 * @param obj tables database object
	 */

	function createDBTable( &$formModel, $dbTableName = null, $tableDatabase = null ){
		$db 		=& JFactory::getDBO();

		if (is_null( $tableDatabase )) {
			$tableDatabase = $db;
		}
		$user  	=& JFactory::getUser();
		$config =& JFactory::getConfig();
		if (is_null( $dbTableName )) {
			$dbTableName = $this->_table->db_table_name;
		}
		$sql = "CREATE TABLE `$dbTableName` ( " ;

		$db->setQuery( "SELECT group_id FROM #__fabrik_formgroup WHERE form_id = $formModel->_id" );
		$groupIds = $db->loadResultArray( );
		/* create elements for the internal id and time_date fields */
		$element =& JTable::getInstance( 'Element', 'Table' );
		$element->name			= "fabrik_internal_id";
		$element->label			= "id";
		$element->plugin 		= 'fabrikinternalid';
		$element->hidden 		= 1;
		$element->group_id 	= $groupIds[0];
		$element->primary_key		= 1;
		$element->auto_increment	= 1;
		$element->created 			= JHTML::_( 'date', date( '%Y-%m-%d %H:%M:%S' ), '%Y-%m-%d %H:%M:%S', - $config->getValue( 'offset' ) );
		$element->created_by 		= $user->get( 'id' );
		$element->created_by_alias = $user->get( 'username' );
		$element->state 			= '1';
		$element->show_in_table_summary = '1';
		$element->link_to_detail = '1';
		$element->width 	= '30';
		$element->ordering 		= 0;
		if (!$element->store()) {
			return JError::raiseWarning( 500, $element->getError() );
		}
		$element =& JTable::getInstance( 'Element', 'Table' );
		$element->name		= "time_date";
		$element->label		= "time_date";
		$element->plugin 	= 'fabrikdate';
		$element->hidden 			= 1;
		$element->eval				= 1;
		$element->default			= "return date('Y-m-d h:i:s');";
		$element->group_id 		= $groupIds[0];
		$element->primary_key		= 0;
		$element->auto_increment	= 0;
		$element->created 			= JHTML::_( 'date', date( '%Y-%m-%d %H:%M:%S' ), '%Y-%m-%d %H:%M:%S', - $config->getValue( 'offset' ) );
		$element->created_by 		= $user->get( 'id' );
		$element->created_by_alias = $user->get( 'username' );
		$element->state 			= '1';
		$element->show_in_table_summary = '1';
		$element->width 	= '30';
		$element->ordering 		= 1;
		if (!$element->store( )) {
			return JError::raiseWarning( 500, $element->getError() );
		}
		$formModel->_loadGroupIds();
		$aGroups = $formModel->getGroupsHiarachy( false, false );
		$arAddedObj = array();
		//these two should be real elements not hacked in here
		$pluginManager =& JModel::getInstance('Pluginmanager', 'FabrikModel');
		foreach ($aGroups as $groupModel) {
			foreach ($groupModel->_aElements as $obj) {
				$element = $obj->getElement( );
				/* replace all non alphanumeric characters with _ */
				$objname = preg_replace( "/[^A-Za-z0-9]/", "_", $element->name );
				/* any elements that are names the same (eg radio buttons) can not be entered twice into the database */
				if (!in_array( $objname, $arAddedObj )) {
					$arAddedObj[] = $objname;
					$objtype = $obj->getFieldDescription();
					if ($objname != "" && !is_null( $objtype )) {
						if (stristr( $objtype, 'not null')) {
							$sql .= " `$objname` $objtype, ";
						} else {
							$sql .= " `$objname` $objtype null, ";
						}
					}
				}
			}
		}
		$sql .= " primary key (fabrik_internal_id))";
		$tableDatabase->setQuery( $sql );
		if (!$tableDatabase->query()) {
			return JError::raiseWarning( 500, $db->getErrorMsg() );
		}
	}

	/**
	 * when saving a table that links to a database for the first time we
	 * need to create all the elements based on the database table fields and their
	 * column type
	 *
	 * @access private
	 * @param int group id
	 * @param array newly created table data
	 * @param array of element objects - if this is not empty then we've come from the csv import and the elements
	 * have already been defined, use this instead of the field analysis to create correctly typed elements
	 */

	function _createLinkedElements( $groupId, $aTableData, $aSpecificElements = array() )
	{
		$db 			=& JFactory::getDBO();
		$user  		= &JFactory::getUser();
		$config		=& JFactory::getConfig();
		$createdate = JFactory::getDate();
		$createdate = $createdate->toMySQL();

		$tableName = JRequest::getVar( 'db_table_name' );

		$ordering = 0;
		$fabrikDb =& $this->getDb();

		if (!empty( $aSpecificElements )) {
			//we're asking the method to create predefined elements - e.g. when installing sample data.
			foreach ($aSpecificElements as $elementModel) {
				$element =& $element->getElement();
				if ($element->label == 'id' || $element->label == 'fabrik_internal_id') {
					$element->hidden = '1';
					$element->primary_key = '1';
					$element->auto_increment = '1';
				} else {
					$element->hidden = '0';
				}
				$element->name = strtolower(str_replace(' ', '', $element->name ));
				$element->group_id = $groupId;
				$element->created = $createdate;
				$element->created_by = $user->get('id');
				$element->created_by_alias = $user->get('username');
				$element->state = '1';
				$element->show_in_table_summary = '1';
				$element->width = '30';
				$element->height = '6';
				$element->ordering = 99999;
				$element->store( );
				$where = " group_id = '" . $element->group_id . "'";
				$element->updateOrder( $where );
			}
		} else {
			//here we're importing directly from the database schema
			$db->setQuery( "SELECT id FROM #__fabrik_tables WHERE `db_table_name` = '$tableName'" );
			$id = $db->loadResult();
			if ($id) {
				//a fabrik table already exists - so we can copy the formatting of its elements

				$groupTableModel = JModel::getInstance('table', 'FabrikModel' );

				$groupTableModel->setId($id);
				$table = $groupTableModel->getTable();
				//$this->_oForm = null; //reset form so that it loads new table form
				$groups = $groupTableModel->getFormGroupElementData( false, false );
				foreach ($groups as $groupModel) {
					foreach ($groupModel->_aElements as $elementModel) {
						$element =& $elementModel->getElement();
						$copy = $elementModel->copyRow( $element->id, '', $groupId );
					}
				}
			} else {
				$fields = $fabrikDb->getTableFields( array ("`$tableName`") );
				$fields = $fields["`$tableName`"];
				// no existing fabrik table so we take a guess at the most
				//relavent element types to  create
				foreach ($fields as $label => $type) {
					$element =& JTable::getInstance( 'Element', 'Table' );
					$element->label = str_replace( "_", " ", $label );
					switch ( $type )
					{
						case "int" :
						case "tinyint" :
						case "varchar" :
							$plugin = 'fabrikfield';
							break;
						case "text" :
						case "tinytext" :
						case "mediumtext" :
						case "longtext" :
							$plugin = 'fabriktextarea';
							break;
						case "datetime" :
						case "date" :
						case "time" :
						case "timestamp" :
							$plugin = 'fabrikdate';
							break;
						default :
							$plugin = 'fabrikfield';
							break;
					}
					$element->plugin = $plugin;
					$element->hidden = ( $element->label == 'id' )? '1' : '0';
					$element->group_id 			= $groupId;
					$element->name				 		= $label;
					$element->created 				= JHTML::_('date', date('%Y-%m-%d %H:%M:%S'), '%Y-%m-%d %H:%M:%S', - $config->getValue('offset'));
					$element->created_by 			= $user->get('id');
					$element->created_by_alias 	= $user->get('username');
					$element->state 				= '1';
					$element->show_in_table_summary = '1';
					$element->width 		= ($plugin == 'fabriktextarea') ? '60' : '30';
					$element->height 		= '6';
					$element->ordering 		= $ordering;
					if (!$element->store( )) {
						return JError::raiseError( 500, $element->getError() );
					}
					$ordering ++;
				}
			}
		}
	}

	/**
	 * updates the table record to point to the newly created form
	 * @params int form id
	 */

	function _updateFormId( $formId )
	{
		$db =& JFactory::getDBO();
		$table =& $this->getTable();
		$table->form_id = $formId;
		if (!$table->store()) {
			return JError::raiseWarning( 500, $db->getError() );
		}
	}


	/**
	 * get the tables primary key and if the primary key is auto increment
	 * @return mixed if ok returns array (key, extra, type, name) otherwise
	 * returns false
	 */

	function getPrimaryKeyAndExtra( )
	{
		$origColNames = $this->getDBFields( );
		if (is_array( $origColNames )) {
			foreach ($origColNames as $origColName) {
				$colName 	= $origColName->Field;
				$key 			= $origColName->Key;
				$extra 		= $origColName->Extra;
				$type 		= $origColName->Type;
				if ($key == "PRI") {
					return array( "key"=>$key, "extra"=>$extra, "type"=>$type, "colname"=>$colName );
				}
			}
		}
		return false;
	}

	/**
	 * deals with ensuring joins are managed correctly when table is saved
	 */

	function updateJoins( )
	{
		$db =& JFactory::getDBO();
		// $$$rob getJoins adds in element joins as well - dont use as we can get ids to delete that
		//arent table joins
		//$aOldJoins 			= $this->getJoins( );
		$db->setQuery("SELECT * FROM #__fabrik_joins WHERE table_id = '$this->_id'");
		$aOldJoins = $db->loadObjectList( );

		$aOldJoinsToKeep 	= array( );
		$joinModel			=& JModel::getInstance( 'Join', 'FabrikModel' );
		$joinIds 				= JRequest::getVar( 'join_id', array(), 'post' );
		$joinTypes 			= JRequest::getVar( 'join_type', array(), 'post' );
		$joinTableFrom  = JRequest::getVar( 'join_from_table', array(), 'post' );
		$joinTable 			= JRequest::getVar( 'table_join', array(), 'post' );
		$tableKey				= JRequest::getVar( 'table_key', array(), 'post' );
		$joinTableKey		= JRequest::getVar( 'table_join_key', array(), 'post' );
		$groupIds				= JRequest::getVar( 'group_id', array(), 'post' );

		for ($i = 0;$i < count( $joinTypes );$i++) {
			$existingJoin = false;
			foreach ($aOldJoins as $oOldJoin ){
				if ($joinIds[$i] == $oOldJoin->id) {
					$existingJoin = true;
				}
			}
			if (!$existingJoin) {
				$this->_makeNewJoin( $tableKey[$i], $joinTableKey[$i], $joinTypes[$i], $joinTable[$i], $joinTableFrom[$i] );
			} else {
				/* load in the exisitng join
				 * if the table_join has changed we need to create a new join and mark the loaded one as to be deleted
				 */
				$joinModel->setId( $joinIds[$i] );
				$join =& $joinModel->getJoin();
				if ($join->table_join != $joinTable[$i]) {
					$this->_makeNewJoin( $tableKey[$i], $joinTableKey[$i], $joinTypes[$i], $joinTable[$i], $joinTableFrom[$i] );
				} else {
					//the talbe_join has stayed the same so we simply update the join info
					$join->table_key 		= $tableKey[$i];
					$join->table_join_key 	= $joinTableKey[$i];
					$join->join_type 		= $joinTypes[$i];
					$join->store();
					$aOldJoinsToKeep[] 		= $joinIds[$i];
				}
			}
		}
		/* remove non exisiting joins */
		if (is_array( $aOldJoins )) {
			foreach ($aOldJoins as $oOldJoin) {
				if (!in_array( $oOldJoin->id, $aOldJoinsToKeep )) {
					/* delete join */
					$join =& JTable::getInstance( 'Join', 'Table' );
					$joinModel->setId( $oOldJoin->id );
					$joinModel->getJoin();
					$joinModel->deleteAll( $oOldJoin->group_id );
				}
			}
		}
	}

	/**
	 * run the prefilter sql and replace any placeholders in the subsequent prefilter
	 *
	 * @param string prefilter condition
	 * @return string prefilter condition
	 */

	function _prefilterParse( $selValue )
	{
		$preSQL = htmlspecialchars_decode( $this->_params->get('prefilter_query'), ENT_QUOTES );
		if (trim( $preSQL ) != '') {
			$db =& JFactory::getDBO();
			$w = new FabrikWorker();
			$preSQL = $w->parseMessageForPlaceHolder( $preSQL );
			$db->setQuery( $preSQL );
			$q = $db->loadObject( );
		}
		if (isset( $q )) {
			foreach ( $q as $key=>$val ) {
				if (substr( $key, 0, 1 ) != '_') {
					$found = false;
					if (strstr( $selValue, '{$q-&gt;'. $key )) {
						$found = true;
						$pattern = '{$q-&gt;'. $key. "}";
					}
					if (strstr( $selValue, '{$q->' . $key )) {
						$found = true;
						$pattern = '{$q->'. $key . "}";
					}
					if ($found) {
						$selValue = str_replace( $pattern, $val, $selValue );
					}
				}
			}
		} else {
			//parse for default values only
			$pattern = "/({[^}]+}).*}?/s";
			$ok = preg_match( $pattern, $selValue, $matches );
			foreach ($matches as $match) {
				$matchx = substr( $match, 1, strlen( $match ) - 2 );
				//a default option was set so lets use that
				if (strstr( $matchx, '|' )) {
					$bits = explode( '|', $matchx );
					$selValue = str_replace( $match, $bits[1], $selValue );
				}
			}
		}
		return $selValue;
	}

	/**
	 * replaces the table column names with a safer name - ie removes white
	 * space and none alpha numeric characters
	 */

	function makeSafeTableColumns()
	{
		$db = $this->getDb();
		$table =& $this->getTable();
		$origColNames = $this->getDBFields( );
		foreach ($origColNames as $origColName) {
			$colName = strtolower($origColName->Field);
			$type = $origColName->Type;
			$newColName = preg_replace("/[^A-Za-z0-9]/", "_", $colName);
			if ( $colName != $newColName ) {
				$sql = "ALTER TABLE `$table->db_table_name` CHANGE `$colName` `$newColName` $type";
				$db->setQuery( $sql );
				if (!$db->query( )) {
					JError::raiseWarning( 500, $db->getErrorMsg( ));
				}
			}
		}
	}

	/**
	 * adds a primary key to the database table
	 * @param string the column name to make into the primary key
	 * @param bol is the column an auto incrementing number
	 * @param string column type definition (eg varchar(255))
	 */

	function updatePrimaryKey( $fieldName, $autoIncrement, $type = 'int(11)' )
	{
		$fbConfig =& JComponentHelper::getParams( 'com_fabrik' );
		if (!$fbConfig->get( 'fbConf_alter_existing_db_cols' )) {
			$fabrikDatabase =& $this->getDb( );
			$aPriKey = $this->getPrimaryKeyAndExtra( );
			if (!$aPriKey) { // no primary key set so we should set it
				$this->_addKey( $fieldName, $autoIncrement, $type );
			} else {
				$shortKey = $this->_shortKey( $fieldName );
				if ($fieldName !=  $aPriKey['colname'] && $shortKey != $aPriKey['colname']) {
					$this->_dropKey( $aPriKey ); // primary key already exists so we should drop it
					$this->_addKey( $fieldName, $autoIncrement, $aPriKey['type'] );
				} else {
					//update the key
					$this->_updateKey( $fieldName, $autoIncrement, $type );
				}
			}
		}
	}

	/**
	 * internal function: update an exisitng key in the table
	 * @param string primary key column name
	 * @param bol is the column auto incrementing
	 * @param string the primary keys column type
	 */

	function _updateKey( $fieldName, $autoIncrement, $type = "INT(11)" ){
		$db =& $this->getDb();
		if(strstr($fieldName, '.')){
			$fieldName = array_pop(explode(".", $fieldName));
		}
		$table =& $this->getTable();
		$sql = "ALTER TABLE `$table->db_table_name` CHANGE `$fieldName` `$fieldName` $type NOT NULL ";
		/* update primary key */
		if ( $autoIncrement ){
			$sql .= " AUTO_INCREMENT";
		}
		$db->setQuery( $sql );
		if(!$db->query( )){
			JError::raiseWarning( 500, 'update key:'.$db->getErrorMsg( ));
		}
	}


	/**
	 * internal function: add a key to the table
	 * @param string primary key column name
	 * @param bol is the column auto incrementing
	 * @param string the primary keys column type
	 */

	function _addKey( $fieldName, $autoIncrement, $type = "INT(11)" ){
		$db =& $this->getDb();
		$table =& $this->getTable();
		if(strstr($fieldName, '.')){
			$fieldName = array_pop(explode(".", $fieldName));
		}
		$sql = "ALTER TABLE `$table->db_table_name` ADD PRIMARY KEY ($fieldName)";
		/* add a primary key */
		$db->setQuery( $sql );
		if(!$db->query( )){
			JError::raiseWarning(500, $db->getErrorMsg( ));
		}
		if ( $autoIncrement ){
			$sql = "ALTER TABLE `$table->db_table_name` CHANGE $fieldName $fieldName " . $type .  " NOT NULL AUTO_INCREMENT"; //add the autoinc
			$db->setQuery( $sql );
			if (!$db->query( ) ){
				return JError::raiseError( 500, 'add key: ' . $db->getErrorMsg( ));
			}
		}
	}


	/**
	 * internal function: drop the table's key
	 * @param array existing key data
	 * @param object fabrik database object
	 * @return bol true if ke droped
	 */

	function _dropKey( $aPriKey, $fabrikDatabase ){
		$db = $this->getDb();
		$table =& $this->getTable();
		$sql = "ALTER TABLE `$table->db_table_name` CHANGE `" . $aPriKey['colname'] . '` `'. $aPriKey['colname'] . '` '  . $aPriKey['type'] . " NOT NULL";
		/* removes the autoinc */
		$db->setQuery( $sql );
		if(!$db->query( )){
			JError::raiseWarning( 500, $db->getErrorMsg()) ;
			return false;
		}
		$sql = "ALTER TABLE `$table->db_table_name` DROP PRIMARY KEY";
		/* drops the primary key */
		$db->setQuery( $sql );
		if(!$db->query( )){
			JError::raiseWarning( 500, 'alter table: ' . $db->getErrorMsg()) ;
			return false;
		}
		return true;
	}

	/**
	 * deletes records from a table
	 * @param string key value to delete
	 * @param string key to use (leave empty to default to the table's key)
	 * @return string error message
	 */

	function deleteTableRows( $val, $key = '' )
	{
		$table =& $this->getTable();
		$db =& $this->getDb();


		if ($key == '') {
			$key = $table->db_primary_key;
			if ($key == '') {
				return JError::raisWarning( JText::_( "no key found for this table" ));
			}
		}

		if (is_array( $val )) {
			$c = count($val);
			$val = implode("','", $val);
		} else {
			$c = 1;
		}

		//@todo: run element->onDeleteRow()
		//load in rows to be deleted#
		$this->_pageNav =& $this->_getPagination( $c, 0, $c );
		$this->_whereSQL[true] = " WHERE " . $key . " IN ('" . $val . "')";
		$rows 	= $this->getData( );
		$this->_rowsToDelete =& $rows;
		$groups = $this->getFormGroupElementData( false, false );

		foreach ($groups as $group) {
			foreach ($group->_aElements as $element) {
				$element->onDeleteRows( $rows );
			}
		}
		
		$pluginManager =& JModel::getInstance( 'Pluginmanager', 'FabrikModel' );
		$pluginManager->loadPlugInGroup( 'table' );
		if (!$pluginManager->runPlugins( 'onDeleteRows', $this, 'table' )) {
			return;
		}
		
		$sql = 	"DELETE FROM `" .  $table->db_table_name  . "` WHERE " . $key . " IN ('" . $val . "')";
		$db->setQuery( $sql );
		if ( !$db->query( ) ) {
			return JError::raisWarning( $db->getErrorMsg( ) );
		}
		return true;
	}

	/**
	 * remove all records from the table
	 */

	function dropData()
	{
		$db =& $this->getDb();
		$sql = "DELETE FROM " .  $this->db_table_name;
		$db->setQuery( $sql );
		$msg= '';
		if (!$db->query( )) {
			return JError::raisWarning( JText::_($db->getErrorMsg( ) ));
		}
		return '';
	}

	/**
	 * drop the table containing the fabriktables data
	 */

	function drop()
	{
		$db =& $this->getDb();
		$sql = "DROP TABLE IF EXISTS `$this->db_table_name`;";
		$db->setQuery( $sql );
		if ( !$db->query( ) ) {
			return JError::raisWarning( JText::_($db->getErrorMsg( ) ));
		}
		return '';
	}
	
	function truncate()
	{
		$db =& $this->getDb();
		$table =& $this->getTable();
		$db->setQuery( "TRUNCATE `$table->db_table_name`");
		$db->query();
	}

	/**
	 *  new join make the group, group elements and formgroup entries for the join data
	 * @param string table key
	 * @param string join to table key
	 * @param string join type
	 * @param string join to table
	 * @param string join table
	 */

	function _makeNewJoin( $tableKey, $joinTableKey, $joinType, $joinTable, $joinTableFrom )
	{
		$db 	=& JFactory::getDBO();
		$formModel 	=& $this->getForm( );
		$aData = array(
			"name" => $this->_table->label ."- [" .$joinTable. "]",
			"label" =>  $joinTable,
		);
		$groupId = $this->_createLinkedGroup( $aData, true );

		$origTable = JRequest::getVar( 'db_table_name' );
		JRequest::setVar( 'db_table_name', $joinTable );
		$this->_createLinkedElements( $groupId, array() );
		JRequest::setVar('db_table_name', $origTable);
		$join =& JTable::getInstance( 'Join', 'Table');
		$join->table_id 		= $this->_id;
		$join->join_from_table = $joinTableFrom;
		$join->table_join 		= $joinTable;
		$join->table_join_key 	= $joinTableKey;
		$join->table_key 		= $tableKey;
		$join->join_type 		= $joinTypes;
		$join->group_id 		= $groupId;
		if(!$join->store( )){
			return JError::raiseWarning( 500, $join->getError() );
		}
	}


	/**
	 * Alter the forms' data collection table when the forms' groups and/or
	 * elements are altered
	 * @param object form
	 * @param string table name
	 * @param object database connection object
	 */

	function ammendTable( &$oForm, $tableName = null, $tableDatabase = null ){
		$db 		=& JFactory::getDBO();
		$user  	=& JFactory::getUser();
		$table =& $this->getTable();
		$pluginManager =& JModel::getInstance( 'Pluginmanager', 'FabrikModel' );
		$ammend 		= false;
		if (is_null( $tableName )) {
			$tableName = $table->db_table_name;
		}
		if (is_null( $tableDatabase ) || !is_object( $tableDatabase )) {
			$tableDatabase = $db;
		}
		$dbdescriptions = $this->getDBFields( $tableName );
		//@TODO: test (was strtolower($dbdescription->Field))  if this is going to cause issues, think fields should be case insenitvely compared as some joomla core fields are mixed case
		foreach ($dbdescriptions as $dbdescription) {
			$exitingfields[] = ($dbdescription->Field);
		}
		$lastfield = $exitingfields[count($exitingfields)-1];
		$sql = "ALTER TABLE `$tableName` " ;
		if (!isset( $_POST['current_groups_str'] )) {
			/* get a list of groups used by the form */
			$groupsql = "SELECT group_id FROM #__fabrik_formgroup WHERE form_id = '" . $oForm->_id . "'";
			$db->setQuery( $groupsql );
			$groups = $db->loadObjectList( );
			if (!$groups) {
				JError::raiseWarning(500,  'ammendTable: ' . $fabrikDb->getErrorMsg( ) );
			}
			$arGroups = array( );
			foreach ($groups as $g) {
				$arGroups[] = $g->group_id;
			}
		} else {
			$current_groups_str = JRequest::getVar( 'current_groups_str' );

			$arGroups = explode( ",", $current_groups_str );
		}

		$arAddedObj = array();
		foreach ($arGroups as $group_id) {
			$group = JTable::getInstance( 'Group', 'Table' );
			$group->load( $group_id );
			if ($group->is_join == '0'){
				$groupsql = "SELECT * FROM #__fabrik_elements WHERE group_id = '$group_id'";
				$db->setQuery( $groupsql );
				$elements = $db->loadObjectList( );
				foreach ($elements as $obj) {
					$objname = strtolower(preg_replace("/[^A-Za-z0-9]/", "_", $obj->name));
					/* replace all non alphanumeric characters with _*/
					if (!in_array( $objname, $exitingfields )) {
						/* make sure that the object is not already in the table*/
						if(!in_array( $objname, $arAddedObj )) {
							/* any elements that are names the same (eg radio buttons) can not be entered twice into the database*/
							$arAddedObj[] 		= $objname;
							$objtypeid 				= $obj->plugin;
							$pluginClassName 	= $obj->plugin;
							$plugin 					= $pluginManager->loadPlugIn( $pluginClassName, 'element' );
							$objtype 					= $plugin->getFieldDescription();
							if ($objname != "" && !is_null( $objtype )) {
								$ammend = true;
								$sql .= ", ADD COLUMN `$objname` $objtype null AFTER `$lastfield`";
							}
						}
					}
				}
			}
		}
		if ($ammend) {
			$tableDatabase->setQuery( $sql );
			if (!$tableDatabase->query()) {
				return JError::raiseWarning( 500, 'amend table: ' . $tableDatabase->getErrorMsg() ) ;
			}
			$this->createCacheQuery();
		}
	}

	/**
	 * @param int connection id to use
	 * @param string table to load fields for
	 * @param string show "please select" top option
	 * @param bol append field name values with table name
	 * @param string name of drop down
	 * @param string selected option
	 * @param string class name
	 * @return string html to be added to DOM
	 */

	function getFieldsDropDown( $cnnId, $tbl, $incSelect, $incTableName = false, $selectListName = 'order_by', $selected = null, $className = "inputbox" ){
		$this->setConnectionId( $cnnId );
		$aFields = $this->getDBFields( $tbl );
		$fieldNames = array( );
		if ($incSelect != '') {
			$fieldNames[] = JHTML::_('select.option', '', $incSelect );
		}
		if (is_array( $aFields ) ) {
			foreach( $aFields as $oField ) {
				if ($incTableName ){
					$fieldNames[] = JHTML::_('select.option', $tbl . "___" . $oField->Field, $oField->Field );
				} else {
					$fieldNames[] = JHTML::_('select.option', $oField->Field );
				}
			}
		}
		$fieldDropDown = JHTML::_('select.genericlist',  $fieldNames, $selectListName, "class=\"$className\"  size=\"1\" ", 'value', 'text', $selected );
		return str_replace("\n", "", $fieldDropDown);
	}

	/**
	 * used in advanced search
	 * @param bol add slashes to reutrn data
	 */

	function getFilterJoinDd( $addSlashes = true, $name = 'join' ){
		$aConditions = array( );
		$aConditions[] = JHTML::_('select.option', 'AND' );
		$aConditions[] = JHTML::_('select.option', 'OR' );
		$dd = str_replace("\n", "", JHTML::_('select.genericlist',  $aConditions, $name, "class=\"inputbox\"  size=\"1\" ", 'value', 'text', '' ));
		if ($addSlashes ){
			$dd = addslashes( $dd );
		}
		return $dd;
	}

	/**
	 *used in advanced search
	 *@param bol add slashes to reutrn data
	 *@param string name of the drop down
	 *@param int mode - states what values get put into drop down
	 */

	function getFilterConditionDd( $addSlashes = true, $name = 'conditions', $mode = 1 ){
		$aConditions = array( );
		switch ($mode){
			case 1:
				/* used for search filter */
				$aConditions[] = JHTML::_('select.option', '<>', 'NOT EQUALS' );
				$aConditions[] = JHTML::_('select.option', '=', 'EQUALS' );
				$aConditions[] = JHTML::_('select.option', 'like', 'BEGINS WITH' );
				$aConditions[] = JHTML::_('select.option', 'like', 'CONTAINS' );
				$aConditions[] = JHTML::_('select.option', 'like', 'ENDS WITH' );
				$aConditions[] = JHTML::_('select.option', '>', 'GREATER THAN' );
				$aConditions[] = JHTML::_('select.option', '<', 'LESS THAN' );
				break;
			case 2:
				/* used for prefilter */
				$aConditions[] = JHTML::_('select.option', 'equals', 'EQUALS' );
				$aConditions[] = JHTML::_('select.option', 'notequals', 'NOT EQUAL TO' );
				$aConditions[] = JHTML::_('select.option', 'begins', 'BEGINS WITH' );
				$aConditions[] = JHTML::_('select.option', 'contains', 'CONTAINS' );
				$aConditions[] = JHTML::_('select.option', 'ends', 'ENDS WITH' );
				$aConditions[] = JHTML::_('select.option', '>', 'GREATER THAN' );
				$aConditions[] = JHTML::_('select.option', '<', 'LESS THAN' );
				$aConditions[] = JHTML::_('select.option', 'IS NULL', 'IS NULL' );
				break;
		}
		$dd = str_replace("\n", "", JHTML::_('select.genericlist',  $aConditions, $name, "class=\"inputbox\"  size=\"1\" ", 'value', 'text', '' ));
		if ($addSlashes ) {
			$dd = addslashes( $dd );
		}
		return $dd;
	}

	/**
	 * create the RSS href link to go in the table template
	 * @return string RSS link
	 */

	function getRSSFeedLink( )
	{
		global $Itemid;
		$link = '';
		if ($this->_params->get('rss') == '1' ) {
			$link = 'index.php?option=com_fabrik&view=table&format=feed&tableid=' . $this->_id . '&Itemid=' . $Itemid . '&type=rss';
			if (!$this->_admin) {
				$link = JRoute::_( $link );
			}
		}
		return $link;
	}

	/**
	 * iterates through string to replace every
	 * {placeholder} with row data
	 * (added by hugh, does the same thing as parseMessageForPlaceHolder in parent
	 * class, but for rows instead of forms)
	 * @param string text to parse
	 */
	 
	function parseMessageForRowHolder( $msg, $row ){
		$this->_aRow = $row;
		$msg = FabrikWorker::_replaceWithUserData( $msg );
		$msg = FabrikWorker::_replaceWithGlobals( $msg );
		$msg = preg_replace( "/{}/", "", $msg ); 
		/* replace {element name} with form data */
		$msg = preg_replace_callback( "/{[^}]+}/i", array($this,'_replaceWithRowData'), $msg ); 
		return $msg;
	}

	/**
	 * PRVIATE:
	 * called from parseMessageForRowHolder to iterate through string to replace
	 * {placeholder} with row data
	 * @param string placeholder e.g. {placeholder}
	 * @param array row
	 * @return string posted data that corresponds with placeholder
	 */
	 
	function _replaceWithRowData( $matches ){
		$match = $matches[0];
		/* strip the {} */
		$match = substr( $match, 1, strlen($match) - 2 ); 

		$match = strtolower( $match );
		$match = str_replace('.','___',$match);
		// $$$ hugh - allow use of {$rowpk} or {rowpk} to mean the rowid of the rwo within a table
		if ($match == 'rowpk' or $match == '$rowpk')
		{
			$match = $this->_table->db_primary_key;
			$match = preg_replace('#^(\w+\.)#','',$match);
		}
		$match = preg_replace( "/ /", "_", $match );
		return($this->_aRow[$match]);
	}
	
	/**
	 * get the link to view the records details
	 * @param int record id
	 * @param int record cursor
	 */

	function viewDetailsLink( $id, $cursor = 0 )
	{
		global $Itemid;
		$link = '';
		if($this->canViewDetails()){
			//TODO: test this in admin table & front end
			$table =& $this->getTable();
			$action = $this->_admin ? 'task' : 'view';
			$link = 'index.php?option=com_fabrik&c=form&'.$action.'=details&tableid=' . $this->_id . '&fabrik=' . $table->form_id . '&rowid=' . $id . '&Itemid=' . $Itemid;
			if (!$this->_admin) {
				$link = JRoute::_( $link );
			}
			$link = "<a href=\"$link\">" . JText::_('View') . "</a>";
		}
		return $link;
	}


	/**
	 * make the drop slq statement for the table
	 * @return string drop table sql
	 */

	function getDropTableSQL()
	{
		$genTable 	= $this->getGenericTableName( );
		$sql = "DROP TABLE IF EXISTS `$genTable`;";
		return $sql;
	}

	function getGenericTableName()
	{
		global $mainframe;
		$table = $this->getTable();
		return str_replace( $mainframe->getCfg('dbprefix'), '#__', $table->db_table_name );
	}

	/**
	 * make the create sql statement for the table
	 * @return string sql to drop & or create table
	 */

	function getCreateTableSQL( )
	{
		$table 	= $this->getGenericTableName( );
		$fields 	=  $this->getDBFields( );
		$primaryKey = "";
		$sql 		= "";
		FabrikString::safeColName( $table );
		if (is_array( $fields )) {
			$sql .= "CREATE table " .  $table ." (\n";
			foreach ( $fields as $field ) {
				FabrikString::safeColName( $field->Field );
				if ($field->Key == 'PRI'){
					$primaryKey = "PRIMARY KEY ($field->Field)";
				}

				$sql .=	"$field->Field ";
					
				if ($field->Key == 'PRI'){
					$sql .= ' INT(6) ';
				} else {
					$sql .= ' ' . $field->Type . ' ';
				}
				if ($field->Null == '' ) {
					$sql .= " NOT NULL ";
				}
				if ($field->Default != '' && $field->Key != 'PRI' ) {
					if($field->Default == 'CURRENT_TIMESTAMP'){
						$sql .= "DEFAULT $field->Default";
					} else {
						$sql .= "DEFAULT '$field->Default'";
					}
				}
				if ($field->Key == 'PRI') {
					$sql .= " AUTO_INCREMENT ";
				}

				$sql .= $field->Extra . ",\n";
			}
			if ($primaryKey == '') {
				$sql = rtrim($sql,",\n" );
			}
			$sql .= $primaryKey . ");";
		}
		return $sql;
	}

	/**
	 * make the create sql statement for inserting the table data
	 * used in package export
	 * @param object exporter
	 * @return string sql to drop & or create table
	 */

	function getInsertRowsSQL( $oExporter )
	{
		@set_time_limit(300);
		$table =& $this->getTable();
		$memoryLimit = ini_get( 'memory_limit' );
		$db 		=& $this->getDb();
		//dont load in all the table data as on large tables this gives a memory error
		//in fact this wasnt the problem, but rather the $sql var becomes too large to hold in memory
		//going to try saving to a file on the server and then compressing that and sending it as a header for download

		$db->setQuery( "SELECT $table->db_primary_key FROM `$table->db_table_name`" );
		$keys = $db->loadResultArray( );
		$sql = "";
		$dump_buffer_len = 0;
		if (is_array( $keys )) {
			foreach ($keys as $id) {
				$db->setQuery( "SELECT * FROM `$table->db_table_name` WHERE $table->db_primary_key = $id" );
				$row = $db->loadObject();
				$fmtsql = "\t<query>INSERT INTO $table->db_table_name ( %s ) VALUES ( %s )</query>";
				$values = array();
				$fields = array();
				foreach ( $row as $k => $v) {
					$fields[] = $db->NameQuote( $k );
					$values[] = $db->Quote( $v );
				}
				$sql .= sprintf( $fmtsql, implode( ",", $fields ) ,  implode( ",", $values ) );
				$sql .= "\n";

				$dump_buffer_len += strlen( $sql );
				if ($dump_buffer_len  > $memoryLimit) {
					$oExporter->writeExportBuffer( $sql );
					$sql = "";
					$dump_buffer_len = 0;
				}
				unset( $values );
				unset( $fmtsql );
			}
		}
		$oExporter->writeExportBuffer( $sql );
	}

	/**
	 * records data from a fabrik RSS feed into the table
	 * feeds need to be in <dl> format
	 * @param string html containing <dl> list
	 * @return string out come message can be'saved','error saving',return 'duplicate', 'error'
	 */

	function recordFromRSSFeed( $html )
	{
		$table =& $this->getTable();
		$db =& JFactory::getDBO();
		require_once(JPATH_SITE . '/includes/domit/xml_domit_lite_include.php');
		//strip cdata text from html
		$html = str_replace( array(']]>', '<![CDATA['), '', $html );

		$xmlDoc = new DOMIT_Lite_Document();
		$ok = $xmlDoc->parseXML($html);
		$aData = array('test');
		if ($ok ){
			$key = '';
			$val = '';
			$debug = '';
			$aPseudoKeys = array();
			$isPseudoKey = false;
			$numDefinitionLists = count($xmlDoc->documentElement->childNodes);

			for ( $i = 0; $i < $numDefinitionLists; $i++ ) {
				$currentChannel =& $xmlDoc->documentElement->childNodes[$i];

				if (($i % 2) == 0){ // even so its the col heading
					$label = $currentChannel->firstChild->nodeValue;
					$key = $currentChannel->getAttribute("value");
					$isPseudoKey = $currentChannel->getAttribute("key");

				} else {
					$val = $currentChannel->firstChild->nodeValue;

					if ($key != $table->db_primary_key && $key != '') {
						$aData[$key] = $val;
					}
					if ($isPseudoKey == '1' ) {
						$aPseudoKeys[] = "$key = '$val'";
					}
				}
			}
			//test if record already exists?
			$res = 0;
			if (count( $aPseudoKeys ) > 0) {
				$sql = "SELECT count(*) FROM $table->db_table_name WHERE " . implode( ' AND ', $aPseudoKeys );
				$db->setQuery( $sql );
				$res = $db->loadResult( );
			}
			if ($res == 0) {
				if ($this->storeRow( $aData, 0 ) ) {
					return 'saved';
				} else {
					return 'error saving';
				}
			} else {
				return 'duplicate';
			}
		}
		return 'error';
	}

	/**
	 * ajax get record specified by row id
	 */

	function xRecord($id)
	{
		$cursor = JRequest::getInt( 'cursor', 1 );
		$this->getConnection( );
		$this->_outPutFormat = 'json';
		//$pageNav = new fabrikPageNav( 1, 0, 1 );
		$this->_pageNav		=& $this->_getPagination( 1, 0, 1 );
		$data = $this->getData( );
		return FastJSON::encode($data);
	}

	/**
	 * ajax get next record
	 * @return string json object representing record/row
	 */

	function nextRecord()
	{
		$cursor = JRequest::getInt( 'cursor', 1 );
		$this->getConnection( );
		$this->_outPutFormat = 'json';
		$this->_pageNav		=& $this->_getPagination( 1, $cursor, 1 );
		$data = $this->getData( );
		echo FastJSON::encode($data);
	}

	/**
	 * ajax get previous record
	 * @return string json object representing record/row
	 */

	function previousRecord()
	{
		$cursor = JRequest::getInt( 'cursor', 1 );
		$this->getConnection( );
		$this->_outPutFormat = 'json';
		$this->_pageNav		=& $this->_getPagination( 1, $cursor-2, 1 );
		$data = $this->getData( );
		return FastJSON::encode( $data );
	}

	/**
	 * ajax get first record
	 * @return string json object representing record/row
	 */

	function firstRecord()
	{
		$cursor = JRequest::getInt( 'cursor', 1 );
		$this->getConnection( );
		$this->_outPutFormat = 'json';
		$this->_pageNav		=& $this->_getPagination( 1, 0, 1 );
		$data = $this->getData( );
		return FastJSON::encode( $data );
	}

	/**
	 * ajax get last record
	 * @return string json object representing record/row
	 */

	function lastRecord()
	{
		$total = JRequest::getInt( 'total', 0 );
		$this->getConnection( );
		$this->_outPutFormat = 'json';
		$this->_pageNav		=& $this->_getPagination( 1, $total-1, 1 );
		$data = $this->getData( );
		return FastJSON::encode( $data );
	}


	/**
	 *  get a single column of data from the table, test for element filters
	 * @param string column to get
	 * @return array values for the column
	 */

	function getColumnData( $col )
	{
		$table =& $this->getTable();
		$db =& $this->getDb();
		FabrikString::safeColName( $col );
		$tablename =  $table->db_table_name;
		FabrikString::safeColName( $tablename );
		$query  	= "SELECT DISTINCT($col) FROM " . $tablename . ' ' . $this->_buildQueryJoin();
		$query 	.= $this->_buildQueryWhere( false );
		$db->setQuery( $query );
		$res  	= $db->loadResultArray( );
		if ($db->getErrorNum()) {
			JError::raiseError( 500, $db->getErrorMsg() );
		}
		return $res;
	}


	function importCSV( )
	{
		$db 				=& JFactory::getDBO();
		$oImport 		= new FabrikModelImportCsv();
		$formModel 	=& $this->getForm();
		$table 			=& $this->getTable();
		$oImport->checkUpload();
		$db->setQuery( "SELECT plugin AS value, name AS text FROM #__fabrik_plugins" );
		$elementTypes = $db->loadObjectList();
		$_SESSION['fabrik']['csvImportData'] 	 = $oImport->data;
		$_SESSION['fabrik']['csvImportHeadings'] = $oImport->headings;
		$fabrik_table = 0;
		$pKey = '';

		$table = $table->label;
		$this->getFormGroupElementData( false, false );
		$lists['matchedHeadings'] = array();
		$lists['newHeadings']	 = array();
		$pKey = $oTable->db_primary_key;

		//
		$pluginManager =& JModel::getInstance( 'Pluginmanager', 'FabrikModel' );
		$pluginManager->loadPlugInGroup( 'table' );
		$aUsedElements = array();

		foreach ( $oImport->headings as $heading ) {
			foreach ( $formModel->_groups as $groupModel ) {
				$found = false;
				foreach ($groupModel->_aElements as $elementModel) {
					$element =& $elementModel->getElement();
					$fullName = $elementModel->getFullName( true, true, false );
					if (strtolower( $heading ) == strtolower( $element->name ) || strtolower( $heading ) == $fullName) {
						/** heading found in table */
						$lists['matchedHeadings'][] = strtolower( $heading );
						$aUsedElements[strtolower( $heading )] = $elementModel;
						$found = true;
					}
				}
				if (!$found) {
					$lists['newHeadings'][] = $heading;
				}
			}
		}

		$intKey= 0;
		foreach ( $aUsedElements as $elementModel ) {
			$oImport->data = $elementModel->prepareCSVData( $oImport->data, $intKey );
			$intKey ++;
		}

		if (!empty( $lists['newHeading'] )) {
			return false;
		}
		$dropData	= JRequest::getInt( 'drop_data', 0, 'post' );
		$overWrite	= JRequest::getInt( 'overwrite', 0, 'post' );
		if ($dropData) {
			$this->dropData();
		}
		$key = str_replace( ".", "___", $table->db_primary_key );
		$key2 = str_replace( $table->db_table_name . "___", "", $key );
			
		//get a list of exisitng primary key vals
		$db =& $this->getDb();
		$db->setQuery( "SELECT $table->db_primary_key FROM $table->db_table_name" );
		$aExistingKeys = $db->loadResultArray();
		foreach ($oImport->data as $data) {
			$aRow = array();
			if ($overWrite) {
				$ch = count( $lists['matchedHeadings'] );
				for ($i=0; $i < $ch; $i++) {
					$tmpKey = $lists['matchedHeadings'][$i];
					if ($tmpKey != $key && $tmpKey != $key2 ) {
						$pkVal = $data[$i];
					}
					$aRow[$tmpKey] = $data[$i];
				}
				$aRow = $this->removeTableNameFromSaveData( $aRow );
				if (in_array( $pkVal, $aExistingKeys )) {
					$this->storeRow( $aRow, $pkVal );
				} else {
					$this->storeRow( $aRow, 0 );
				}
			} else {
				for ($i=0;$i<count($lists['matchedHeadings']);$i++) {
					$tmpKey = $lists['matchedHeadings'][$i];
					if ($tmpKey != $key && $tmpKey != $key2 ) {
						$aRow[$tmpKey] = $data[$i];
					}
				}
				$aRow = $this->removeTableNameFromSaveData( $aRow );
				$this->storeRow( $aRow, 0 );
			}
		}
		return true;
	}

}
?>