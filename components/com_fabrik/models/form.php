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
require_once(COM_FABRIK_FRONTEND.DS.'helpers'.DS.'parent.php');

class FabrikModelForm extends JModel
{

	/* not used in database (need to be prefixed with "_")*/
	/** @var array form's group elements*/
	var $_elements = null;

	/** @var array group objects (their element objects contained within)*/
	var $_groups = null;

	/** @var object table model assocated with form*/
	var $_table = null;

	/** @var array of group ids that are actually tablejoins [groupid->joinid]*/
	var $_aJoinGroupIds = array();

	/** @var bol true if editable if 0 then show view only verion of form */
	var $_editable = 1;

	/** @var string encoding type */
	var $_enctype = "application/x-www-form-urlencoded";

	/** @var string html name of form */
	var $_formName = null;

	/** @var string the path to the form - can probably update this to point to SSL page */
	var $_rootPath = null;

	/** @var string the javascript to run on sumbission of the form */
	var	$_js = null;

	/** @var array validation rule classes */
	var $_validationRuleClasses = null;

	/** @var array specific group sets based on whether they contain elements not in table view or unpublished*/
	var $_specGroups = array();

	/**@var bol is the form running as a module(true)*/
	var $_isModule = false;

	/**@var bol is the form running as a mambot(true)*/
	var $_isMambot = false;

	/** @var array */
	var $_foreignKeyDropDowns = null;

	/** @var string */
	var $_err = '';

	/** @var array of join objects for the form */
	var $_aJoinObjs = array();

	var $_joinTableElementStep = '___';

	/** @var array of join default data */
	var $_joinDefaultData = array();

	/** @var object parameters */
	var $_params = null;

	/** @var string form groups */
	var $_formGroupStr = null;

	/** @var aray form group idds */
	var $_formGroupIds = null;

	/** @var bol form is admin */
	var $_admin = false;

	/** @var int row id to submit */
	var $_rowId = null;

	/** @var string method to use when submitting form data // post or ajax*/
	var $_postMethod = 'post';

	/** @var bol is the form inside  a package */
	//DEPRECIATED - should always be inside package - even if single form
	//var $_inPackage = 0;

	/** @var int id */
	var $_id = null;

	/**@var int connection id */
	var $_connection_id = null;

	/** @var string database name */
	var $_database_name = null;

	/** @var object form **/
	var $_form = null;

	/** @var object last current element found in hasElement()*/
	var $_currentElement = null;

	/** @var bol if true encase table and elemetn names with "`" when getting elemenet list */
	var $_addDbQuote = false;

	var $_formData = array();

	/** @var array form errors */
	var $_arErrors = array();

	/** @var object uploader helper */
	var $_oUploader = null;
	
	/** @var array pages (array containing group ids for each page in the form **/
	var $pages = null;

	/** @var object session model deals with storing incomplete pages **/
	var $sessionModel = null;
	
	/**
	 * Constructor
	 *
	 * @since 1.5
	 */

	function __construct()
	{
		parent::__construct();
		$usersConfig = &JComponentHelper::getParams( 'com_fabrik' );
		$id = JRequest::getInt( 'fabrik', $usersConfig->get( 'fabrik' ) );
		$this->setId( $id );
	}

	/**
	 * Method to set the form id
	 *
	 * @access	public
	 * @param	int	table ID number
	 */

	function setId( $id )
	{
		// Set new form ID
		$this->_id		= $id;
	}

	/**
	 * get form table (alias to getTable())
	 *
	 * @return object form table
	 */

	//function &getForm()
	function &getForm()
	{
		//tset comment out /
		return $this->getTable();
	}

	/**
	 * checks if the params object has been created and if not creates and returns it
	 * @return object params
	 */

	function &getParams()
	{
		if (!isset( $this->_params )) {
			$this->_params = &new fabrikParams( $this->_form->attribs, JPATH_SITE . '/administrator/components/com_fabrik/xml/form.xml', 'component' );
		}
		return $this->_params;
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
	 * makes sure that the form is not viewable based on the table's access settings
	 * @return int 0 = no access, 1 = view only , 2 = full form view, 3 = add record only
	 */

	function checkAccessFromTableSettings(  )
	{
		$form =& $this->getForm();
		if ($form->record_in_database == 0) {
			return 2;
		}
		$tableModel =& $this->getTableModel();
		if (!is_object( $tableModel )) {
			return 2;
		}
		$ret = 0;
		if ($tableModel->canViewDetails()) {
			$ret = 1;
		}
		/* new form can we add?*/
		if ($this->_rowId == 0) {
			/*if they can edit can they also add?*/
			if ($tableModel->canAdd() ) {
				$ret = 3;
			}
		} else {
			/*editing from - can we edit?*/
			if ($tableModel->canEdit()) {
				$ret = 2;
			}
		}
		return $ret;
	}

	/**
	 * add in custom js and css files to the form
	 */

	function addCustomFiles()
	{
		$document =& JFactory::getDocument();
		/* check for a custom javascript file and include it if it exists */
		$aJsPath =JPATH_SITE . "/components/com_fabrik/js/" . $this->_id . ".js";
		if (file_exists( $aJsPath )) {
			FabrikHelperHTML::script( $this->_id . ".js", 'components/com_fabrik/js/', false );
		}
		/* check for a custom css file and include it if it exists*/
		$aCssPath =JPATH_SITE . "/components/com_fabrik/css/" . $this->_id . ".css";
		if (file_exists( $aCssPath )) {
			$live_css_file =COM_FABRIK_LIVESITE . "/components/com_fabrik/css/" . $this->_id . ".css";
			$document->addStyleSheet( $live_css_file );
		}
	}

	/**
	 * set the page title for form
	 */

	function getPageTitle( )
	{
		$form =& $this->getForm();
		$title = "";
		foreach ($this->_groups as $groupModel) {
			foreach ($groupModel->_aElements as $elementModel) {
				$element =& $elementModel->getElement();
				if ($element->use_in_page_title == '1') {
					$s = $elementModel->getDefaultValue( $this->_data ) . " ";
					$title .= $s;
				}
			}
		}
		if ($title != '') {
			$title =  " - " . $title;
		}
		return $form->label . $title;
	}

	/**
	 * compares the forms table with its groups to see if any of the groups are in fact table joins
	 * @param array tables joins
	 * @return array array(group_id =>join_id)
	 */

	function getJoinGroupIds($joins)
	{
		$arJoinGroupIds = array();
		foreach ($this->_groups as $groupModel) {
			foreach ($joins as $join) {
				if ($join->element_id == 0 && $groupModel->_id == $join->group_id) {
					$arJoinGroupIds[$groupModel->_id] = $join->id;
				}
			}
		}
		$this->_aJoinGroupIds = $arJoinGroupIds;
		return $arJoinGroupIds;
	}

	/**
	 * gets the javascript actions the forms elements
	 * @return array of javascript actions
	 */

	function getJsActions( )
	{
		$db =& JFactory::getDBO();
		$aJsActions = array( );
		$aElIds = array( );
		foreach ($this->_groups as $groupModel) {
			foreach ($groupModel->_aElements as $elementModel) {
				$aJsActions[$elementModel->_id] = array();
				$aElIds[] = $elementModel->_id;
			}
		}
		$sql = 'SELECT * FROM #__fabrik_jsactions WHERE element_id IN (' . implode(',', $aElIds) . ')';
		$db->setQuery( $sql );
		$res = $db->loadObjectList( );
		if (is_array( $res )) {
			foreach ($res as $r) {
				$aJsActions[$r->element_id][] = $r;
			}
		}
		return $aJsActions;
	}

	/**
	 * javascript code:
	 * main ofabrik object
	 * objects created for each element - will be expanded to ensure
	 * specific functionality per element
	 * @param string javascript of all js actions attached to elements
	 * @param string js event load/domready
	 */

	function getFormManagementJS( $actions, $when = 'load' )
	{
		$document =& JFactory::getDocument();
		$this->jsActions = '';
		$str = '';
		if (!defined( '_JOS_FABRIK_FORMJS_INCLUDED' )) {
			define( '_JOS_FABRIK_FORMJS_INCLUDED', 1 );
			FabrikHelperHTML::script( 'mootools-ext.js', 'components/com_fabrik/libs/', true );
			FabrikHelperHTML::script( 'slimbox.js', 'components/com_fabrik/libs/', true );
			FabrikHelperHTML::script( 'form.js', 'components/com_fabrik/views/form/', true );
			FabrikHelperHTML::script( 'element.js', 'components/com_fabrik/views/form/', true );
		}
		$pluginManager =& JModel::getInstance( 'Pluginmanager', 'FabrikModel' );
		$aLoadedElementPlugins = array();
		//load in once the element js class files
		foreach ($this->_groups as $groupModel) {
			foreach ($groupModel->_aElements as $elementModel) {
				$element =& $elementModel->getElement();
				if (!in_array( $element->plugin, $aLoadedElementPlugins )) {
					$aLoadedElementPlugins[] = $element->plugin;
					$str .= $elementModel->formJavascriptClass( ) ;
				}
			}
		}
		$document->addScriptDeclaration( $str );
		return $str;
	}

	/**
	 * depreciated use getformamangementjs instead
	 * get the javascript for the form (located after form written)
	 * @return string javascript
	 */

	/*function getBottomFormManagementJS( $data ){

	}*/

	/** get the ids of all the groups in the form
	 * @return array of group ids
	 */

	function getFormGroupIds(  )
	{
		if (!isset( $this->_formGroupIds )) {
			$this->_loadGroupIds();
		}
		return $this->_formGroupIds;
	}
	
	/**
	 * force load in the group ids
	 * separate from getFormGroupIds as you need to force load these
	 * when saving the table
	 */

	function _loadGroupIds()
	{
		$db =& JFactory::getDBO();
		$sql = "SELECT #__fabrik_formgroup.group_id AS group_id FROM #__fabrik_formgroup".
		"\n WHERE #__fabrik_formgroup.form_id = '$this->_id' ORDER BY ordering" ;
		$db->setQuery( $sql );
		$form =& $this->getForm();
		$groups = $db->loadResultArray( );
		if($form->record_in_database) {
			$tableModel = $this->getTableModel();
			if (is_object( $tableModel ) && $tableModel->_id != '') {
				$db->setQuery( "SELECT group_id FROM #__fabrik_joins WHERE table_id = '$tableModel->_id'" );
				$joinGroups = $db->loadResultArray();
				$groups = array_merge( $groups, $joinGroups );
			}
		}
		$this->_formGroupIds = $groups;
	}

	/**
	 * gets each element in the form along with its group info
	 * @param boolean are we using a table view
	 * @param bol included unpublished elements in the result
	 * @return array element objects
	 */

	function getFormGroups( $tableView = false, $excludeUnpublished = true )
	{
		$db =& JFactory::getDBO();
		$sql = "SELECT *, #__fabrik_groups.attribs AS gattribs, #__fabrik_elements.id as element_id
		, #__fabrik_groups.name as group_name  FROM #__fabrik_formgroup
		LEFT JOIN #__fabrik_groups
		ON #__fabrik_formgroup.group_id = #__fabrik_groups.id
		LEFT JOIN #__fabrik_elements
		ON #__fabrik_groups.id = #__fabrik_elements.group_id
		WHERE #__fabrik_formgroup.form_id = '$this->_id' " ;
		if ($excludeUnpublished) {
			$sql .= " AND #__fabrik_elements.state = '1' ";
		}
		if ($tableView ){
			$sql .= " and show_in_table_summary = '1' ";
		}
		$sql .= "ORDER BY #__fabrik_formgroup.ordering, #__fabrik_formgroup.group_id, #__fabrik_elements.ordering";
		$db->setQuery( $sql );
		$groups = $db->loadObjectList( );
		echo $db->getErrorMsg( );
		$this->_elements = $groups;
		return $groups;
	}

	/**
	 * similar to getFormGroups() except that this returns a data structure of
	 * form
	 * --->group
	 * -------->element
	 * -------->element
	 * --->group
	 * if run before then existing data returned
	 * @param boolean show elements only in table view default = false
	 * @param bol exclude unpublished elements in the result default = true
	 * @return array element objects
	 */

	function &getGroupsHiarachy( $tableView = false, $excludeUnpublished = true )
	{
		$key = $tableView ?  '1' : '0';
		$key .= $excludeUnpublished ?  '1' : '0';
		if (is_array( $this->_specGroups ) && array_key_exists( $key, $this->_specGroups )) {
			return $this->_specGroups[$key];
		} else {
			$aGroupIds = $this->getFormGroupIds( );
			$aGroupObjs = array( );
			foreach ($aGroupIds as $groupId) {
				if ($groupId != '0') {
					$groupModel =& JModel::getInstance( 'Group', 'FabrikModel' );
					$groupModel->setId( $groupId );
					$tableModel =& $this->getTableModel();
					$groupModel->setContext( $this, $tableModel );
					$groupModel->getGroup();
					$groupModel->getMyElements( $this->_id, $tableView, $excludeUnpublished );
					$aGroupObjs[$groupId] = $groupModel;
				}
			}
			$this->_groups = $aGroupObjs;
			$this->_specGroups[$key] = $aGroupObjs;
			return $aGroupObjs;
		}
	}

	/**
	 * this checks to see if the form has a file upload element
	 * and returns the correct
	 * encoding type for the form
	 * @param int form id
	 * @param object forms elements
	 * @return string form encoding type
	 */

	function getFormEncType( ){
		foreach( $this->_groups as $groupModel ){
			foreach( $groupModel->_aElements as $elementModel ){
				if ( $elementModel->_is_upload == '1' ) {
					return "multipart/form-data";
				}
			}
		}
		return "application/x-www-form-urlencoded";
	}

	/**
	 * run a method on all the element plugins in the form
	 *
	 * @param string method to call
	 * @param array posted form data
	 */
	function runElementPlugins( $method, $data )
	{
		foreach($this->_groups as $groupModel){
			foreach($groupModel->_aElements as $elementModel) {
				$params =& $elementModel->getParams();
				if(method_exists($elementModel, $method)){
					$elementModel->$method( $params, $data );
				}
			}
		}
	}
	
	/**
	 * get the plugin manager
	 *
	 * @return object plugin manager
	 */
	
	function getPluginManager()
	{
		if (!isset($this->_pluginManager)) {
			$this->_pluginManager =& JModel::getInstance( 'Pluginmanager', 'FabrikModel' );
		}
		return $this->_pluginManager;
	}
	
	/**
	 * processes the form data and decides what action to take
	 */

	function process( )
	{
		global $mainframe;
		@set_time_limit(300);
		require_once( COM_FABRIK_FRONTEND.DS.'helpers'.DS.'uploader.php' );
		$db =& JFactory::getDBO();
		$tableModel			=& $this->getTableModel();
		$table					=& $tableModel->getTable();
		$form						=& $this->getForm();
		$pluginManager 	=& $this->getPluginManager();
		$params 				=& $this->getParams();
		
		$sessionModel =& JModel::getInstance( 'Formsession', 'FabrikModel');
		$sessionModel->setFormId( $this->_id );
		$sessionModel->setRowId( $this->_rowId );
		$this->getGroupsHiarachy( false );

		if (!$pluginManager->runPlugins( 'onBeforeProcess', $this )) {
			return;
		}

		$oUploader 				=& $this->getUploader();
		if ($oUploader->check( )) {
			$oUploader->upload( );
			if ($oUploader->moveError) {
				return false;
			}
		}

		/*
		 * this will strip the html from the form data
		 * see here - http://forum.joomla.org/index.php/topic,259690.msg1182219.html#msg1182219
		 * still not working in J1.5.2 :(
		 */

	//	$aData =  JRequest::get( 'post', JREQUEST_ALLOWHTML );

		$filter	= JFilterInput::getInstance(null, null, 1, 1);
		foreach ($_POST as $key=>$val) {
			$val = JRequest::getVar( $key, '', 'post', 'string', JREQUEST_ALLOWRAW ); // JREQUEST_ALLOWHTML doesnt work wth!
			$aData[$key] = $val;
			if (is_string( $aData[$key] )) {
				$aData[$key] = (string) $filter->_remove($filter->_decode((string) $aData[$key]));
			} else {

				foreach ($aData[$key] as $k2 => $val2)
				{
						// filter element for XSS and other 'bad' code etc.
					if (is_string( $val2 )) {
						$aData[$key][$k2] = $filter->_remove( $filter->_decode( $val2 ) );
					}
				}
			}
		}

		$this->_formData 	= $aData;
		
		if (!$pluginManager->runPlugins( 'onBeforeStore', $this )) {
			return;
		}
		if ($form->record_in_database == '1') {
			// COPY function should create new records
			if (array_key_exists( 'Copy', $this->_formData )) {
				$this->_rowId = '';
				$k = str_replace('`', '', str_replace('.', '___', $table->db_primary_key));
				$origid = $this->_formData[$k];
				$this->_formData[$k] = '';
				$this->_formData['rowid'] = '';
			}
			/* get an array of the joins to process
			 note this was processJoin() but now preProcessJoin() does the same except no longer stores the results - do this after the main form data has been saved and u have an id to use
			 for the foreign key value*/
			$aPreProcessedJoins = $tableModel->preProcessJoin( $this->_formData, $this->_rowId, $this->_joinTableElementStep );
			if ($tableModel->databaseTableExists( )) {
				$tableModel->ammendTable( $this );
			}

			$this->_formData 	= $tableModel->removeTableNameFromSaveData( $this->_formData, $split='___' );
			
			$insertId 		 		= $this->submitToDatabase( $this->_rowId );
			
			//set the redirect page to the form's url if making a copy and set the id
			//to the new insertid
			if (array_key_exists( 'Copy', $this->_formData )) {
				$u = str_replace( "rowid=$origid", "rowid=$insertId", $_SERVER['HTTP_REFERER'] );
				JRequest::setVar( 'fabrik_referrer', $u );
			}
			$tmpKey 		 			= str_replace( ".", "___", $table->db_primary_key );
			$tmpKey = str_replace("`", "", $tmpKey);
			$this->_formData[$tmpKey] 	= $insertId;
			$this->_formData[$tableModel->_shortKey( null, true)] = $insertId;
			$_REQUEST[$tmpKey] 	= $insertId;
			$_POST[$tmpKey] 	= $insertId;

			//save join data

			$this->_formData = $this->_removeIgnoredData( $this->_formData );
			if (array_key_exists( 'join', $this->_formData )) {
			
				foreach ($aPreProcessedJoins as $aPreProcessedJoin) {
					$oJoin = $aPreProcessedJoin['join'];
					/** NEW **/
					if (array_key_exists( 'Copy', $this->_formData )) {
						$this->_rowId = '';
						$this->_formData['join'][$oJoin->id][$oJoin->table_join.'___'.$oJoin->table_key] = '';
						$this->_formData['rowid'] = '';
					}

					/** NEW **/

					$data = $this->_formData['join'][$oJoin->id];

					//$$$rob moved till just before join table data saved
					//$data = $oTable->removeTableNameFromSaveData( $data, $split='___' );
					
					if (array_key_exists( $oJoin->table_join . '___' . $oJoin->table_join_key, $data )){
						$joinGroup = $this->_groups[$oJoin->group_id];

						//find the primary key for the join table
						$table->db_table_name 	= $oJoin->table_join;
						$fields 				= $tableModel->getDBFields( $table->db_table_name );
						$aKey 					= $tableModel->getPrimaryKeyAndExtra();
						$table->db_primary_key = $aKey['colname'];
						$joinDb 				=& $tableModel->getDb( );


						//$$$rob get the join tables ful primary key
						$joinDb->setQuery( "DESCRIBE $oJoin->table_join" );
						$oJoinPk = $oJoin->table_join . "___";
						$cols = $joinDb->loadObjectList( );
						foreach ($cols as $col) {
							if ($col->Key == "PRI") {
								$oJoinPk .= $col->Field;
							}
						}
						$fullforeginKey = $oJoin->table_join . '___' . $oJoin->table_join_key;

						if ($joinGroup->canRepeat()) {
							//find out how many repeated groups were entered
							// might make more sense to store this value in a hidden field rather than guess it from the data?
							
							$repeatedGroupCount = 0;
							foreach ($joinGroup->_aElements as $elementModel) {
								$element = $elementModel->getElement();
								$n = $elementModel->getFullName(false, true, false);
								if( count($data[$n]) >= $repeatedGroupCount)
								{
									$repeatedGroupCount = count($data[$n]);
								}
							}
							$aUpdatedRecordIds = array();
							for ($c = 0; $c<$repeatedGroupCount; $c++) {
								//get the data for each group and record it seperately
								$repData = array();
								foreach ($joinGroup->_aElements as $elementModel) {
									$element = $elementModel->getElement();
									$n = $elementModel->getFullName(false, true, false);
									$v = (is_array($data[$n]) && array_key_exists($c, $data[$n])) ? $data[$n][$c] : '';  
									$repData[$element->name] = $v;
								}
								$repData[$oJoin->table_join_key] = $insertId;
								
								//find the primary key for the join table
								$table->db_table_name 	= $oJoin->table_join;
								$fields 				= $tableModel->getDBFields( $table->db_table_name );
								$aKey 					= $tableModel->getPrimaryKeyAndExtra();
								$table->db_primary_key = $aKey['colname'];
								$joinCnn 				=& $tableModel->getConnection( );
								$joinDb  				=& $joinCnn->getDb( );
								$joinRowId 				= $repData[$table->db_primary_key];
								
								$aDeleteRecordId 		= $repData[$oJoin->table_join_key];
								
								$tableModel->storeRow( $repData, $joinRowId, true );
								if ($joinRowId == '') {
									$joinRowId = $tableModel->_lastInsertId;
								}
								$aUpdatedRecordIds[] 	= $joinRowId;
							}
							
							//remove any joins that have been deleted with the groups "delete" button
							if (!$data) {
								$sql = "DELETE  FROM `$oJoin->table_join`  "
								. "\nWHERE ($oJoin->table_join_key = $aDeleteRecordId)";
							} else {
								$sql = "DELETE  FROM `$oJoin->table_join`  "
								. "\nWHERE !($table->db_primary_key IN (" . implode( ',', $aUpdatedRecordIds ) . ")) AND ($oJoin->table_join_key = $aDeleteRecordId)";
							}
							$joinDb->setQuery( $sql );
							$joinDb->query();
							echo $joinDb->getErrorMsg();
						} else {

							// $$$rob test if the joined to table's key (as part of the join) is the same as its primary key
							// if it is then we dont want to overwrite the foreginkey as we will in fact be overwriting the pk

							if ($fullforeginKey != $oJoinPk) {
								$data[$fullforeginKey] = $insertId;
							}
							if ($table->db_primary_key == '') {
								return JError::raiseWarning( 500, JText::_( "Please ensure you have selected a primary key for your table, Fabrik can not process this join until you have done so" ));
							}
							$joinRowId 				= $data[$table->db_primary_key];

							$data = $tableModel->removeTableNameFromSaveData( $data, $split='___' );
							//try to catch an pk val when the db_primary_key is in the short format	
							if(is_null($joinRowId)){
								$joinRowId 				= $data[$table->db_primary_key];
							}
							$tableModel->storeRow( $data, $joinRowId, true );

							//$$$rob if the fk was the same as the pk then go back to the main table and
							// update its fk to match the
							// pk of the inserted table

							if ($fullforeginKey == $oJoinPk) {
								$pkVal = $tableModel->_lastInsertId;
								$fk = $oJoin->table_key;
								$this->_data[$fk] = $pkVal;
								// $$$ hugh - I think this needs to be $insertId, not $rowId, otherwise
								// if it's new row (so $rowId was null) we insert a duplicate row in
								// the main table?
								// NOTE TO SELF - test on row edit as well as new row!!
								//$insertId 		= $this->submitToDatabase( $rowId );
								$insertId 		= $this->submitToDatabase( $insertId );
							}
						}
					}
				}
			}
			//testing for saving pages/
			JRequest::setVar( 'rowid', $insertId );

			if (!$pluginManager->runPlugins( 'onBeforeCalculations', $this )) {
				return;
			}
			
			$this->_table->doCalculations();
			
		}
		if (!$pluginManager->runPlugins( 'onAfterProcess', $this )) {
			//returning false here stops the default redirect occuring
			return false;
		}
		
		$sessionModel->remove();
		return true;
	}

	/**
	 *
	 */

	function _removeIgnoredData( $data )
	{
		foreach ($this->_groups as $groupModel) {
			$groupTable = $groupModel->getGroup();
			foreach ($groupModel->_aElements as $elementModel) {
				$element =& $elementModel->getElement();
				$element->label = strip_tags( $element->label );
				$params =& $elementModel->getParams();

				//check if the data gets inserted on update
				$v = $elementModel->getValue( $data );
				if ($elementModel->ignoreOnUpdate( $v )) { //currently only field password elements return true
					$fullName = $elementModel->getFullName( false, true, true );
					unset($data['join'][$groupTable->join_id][$fullName]);
				}
			}
		}
		return $data;
	}

	/**
	 * saves the form data to the database
	 * @param int rowid - if 0 then insert a new row - otherwise update this row id
	 * @return mixed insert id (or rowid if updating existing row) if ok , else string error message
	 */

	function submitToDatabase( $rowId = '0' )
	{
		$db =& JFactory::getDBO();
		$this->getGroupsHiarachy();
		$pluginManager =& JModel::getInstance( 'Pluginmanager', 'FabrikModel' );
		/*check if there is table data that is not posted by the form (ie if no checkboxes were selected)*/
		foreach ($this->_groups as $groupModel) {
			$group = $groupModel->getGroup();
			foreach ($groupModel->_aElements as $elementModel) {
				$element = $elementModel->getElement();
				$element->label = strip_tags( $element->label );
				$params = $elementModel->getParams();
				$this->_formData = $elementModel->getEmptyDataValue( $params, $this->_formData );
				//check if the data gets inserted on update
				$v = $elementModel->getValue( $this->_formData );
				if ($elementModel->ignoreOnUpdate( $v )) { //currently only field password elements return true
					$fullName = $elementModel->getFullName( false, true, true );
					unset($this->_formData['join'][$group->join_id][$fullName]);
				}
				$plugin =& $pluginManager->getPlugIn( $element->plugin, 'element' );
				$plugin->_element =& $element;
				$plugin->onStoreRow( $this->_formData );
			}
		}
		$tableModel = $this->getTableModel();
		$tableModel->_oForm =& $this;
		$tableModel->storeRow( $this->_formData, $rowId );
		if ($rowId == 0) {
			return $tableModel->_lastInsertId;
		} else {
			return $rowId;
		}
	}

	/**
	 * get the form's table model
	 * (was getTable but that clashed with J1.5 func)
	 *
	 * @return object fabrik table model
	 */

	function &getTableModel()
	{
		if (is_null( $this->_table )) {
			$this->_table =& JModel::getInstance( 'Table', 'FabrikModel');
			$this->_table->loadFromFormId( $this->_id );
			$this->_table->_oForm =& $this;
		}
		return $this->_table;
	}

	/**
	 * get the class names for each of the validation rules
	 * @return array (validaionruleid => classname )
	 */

	function loadValidationRuleClasses( )
	{
		if (is_null( $this->_validationRuleClasses )) {
			$pluginManager	 	=& JModel::getInstance( 'Pluginmanager', 'FabrikModel' );
			$oValidationRules =& $pluginManager->getPlugInGroup( 'validationrule' );
			$classes = array();
			foreach ($oValidationRules as $rule) {
				$classes[$rule->_pluginName] = $rule->_className;
			}
			$this->_validationRuleClasses = $classes;
		}
		return $this->_validationRuleClasses;
	}

	/**
	 * validate the form before processing it
	 * called from controller
	 *@param array post data (default null which is then set to JRequest::get('post')
	 * @return bol true if validation passed / otherwise false
	 */

	function validate( $post = null )
	{
		require_once( COM_FABRIK_FRONTEND.DS.'helpers'.DS.'uploader.php' );
		$pluginManager 		=& JModel::getInstance( 'Pluginmanager', 'FabrikModel' );
		$oValidationRules =& $pluginManager->getPlugInGroup( 'validationrule' );
		$db 	=& JFactory::getDBO();
		if (is_null( $post )) {
			$post	= JRequest::get( 'post' );
		}
		$arErrors = array();
		$this->getGroupsHiarachy( );
		foreach ($this->_groups as $groupModel) {
			foreach ($groupModel->_aElements as $elementModel) {
				$element =& $elementModel->getElement();
				
				$sql = "SELECT *, v.attribs AS validation_attribs FROM #__fabrik_validations v".
				"\n LEFT JOIN #__fabrik_plugins p ON v.validation_plugin = p.name ".
				"\n WHERE v.element_id = '$element->id'";
				$db->setQuery( $sql );
				$validation_rules = $db->loadObjectList( );
				$elName = $elementModel->getFullName( true, true, false );
				$form_data = $elementModel->getValue( $post );
				//	repeat group validations
				//if (!$groupModel->canRepeat()) {
					$form_data = array($form_data);
				//}
				for ($c=0; $c<count( $form_data ); $c++) {
					//internal element plugin validations
					if (is_array( $form_data )) {
						if (!$elementModel->validate( @$form_data[$c] )) {
							$this->_arErrors[$elName][$c][] = $elementModel->getValidationErr();
						}
					}
					//validations plugins attached to elemenets
					foreach ($validation_rules as $validation_rule) {
						$plugin = $pluginManager->getPlugIn( $validation_rule->validation_plugin, 'validationrule' );
						$plugin->attribs = $validation_rule->attribs;
						if ($plugin->shouldValidate( $form_data )) {
							if (!$plugin->validate( $form_data[$c], $elementModel )) {
								$this->_arErrors[$elName][$c][] = $validation_rule->message;
							}
						}
					}
				}
			}
		}
		if (!empty( $this->_arErrors )) {
			$pluginManager 	=& $this->getPluginManager();
			$pluginManager->runPlugins( 'onError', $this );
		}
		return (empty( $this->_arErrors )) ? true : false;
	}

	/**
	 * get an instance of the uploader object
	 *
	 * @return object uploader
	 */

	function &getUploader()
	{
		if (is_null( $this->_oUploader )) {
			$this->_oUploader = new uploader( $this );
		}
		return  $this->_oUploader;
	}

	/**
	 * get the forms table name
	 *
	 * @return string table name
	 */

	function getTableName()
	{
		$this->getTableModel( );
		return $this->_table->_table->db_table_name;
	}

	/**
	 * get the form row
	 *
	 * @return object form row
	 */

	function &getTable()
	{
		if (is_null( $this->_form )) {
			$this->_form = parent::getTable();
			$this->_form->load( $this->_id );
		}
		return $this->_form;
	}

	/**
	 * overloaded check function
	 */

	function check()
	{
		/* check for valid name*/
		if ( trim( $this->label ) == '' ) {
			$err = JText::_('Your Form must contain a title!');
		}
		if ( isset( $err ) ) {
			$this->_error = $err;
			return false;
		}
		return true;
	}

	/**
	 * when saving a table that links to a database for the first time we
	 * need to link together the created form and the created group
	 * @param int group id
	 */

	function createFormGroup( $groupId ) {
		/*load in existing groups*/
		$str = $this->_getFromGroupsStr() . ",$groupId";
		$this->_setGroupString( $str );
		$this->saveFormGroups( );
	}

	function _getFromGroupsStr(){
		if( is_null( $this->_formGroupStr ) ){
			$this->_formGroupStr = $this->_loadFromGroupsStr();
		}
		return $this->_formGroupStr;
	}

	function _loadFromGroupsStr(){
		$db =& JFactory::getDBO();
		$sql = "SELECT group_id FROM #__fabrik_formgroup WHERE form_id = '$this->_id'";
		$db->setQuery( $sql );
		$aFormGroups = $db->loadResultArray( );

		//check if table has joins - they should be already in aFormGoups but better to be safe
		$aJoinGroupIds = array();
		$tableModel =& $this->getTableModel();
		if(is_object($tableModel)){
			$joins = $this->_table->getJoins();
			foreach($joins as $join){
				$aJoinGroupIds[]  = $join->group_id;
			}
		}
		$merged = array_merge($aJoinGroupIds, $aFormGroups);
		// do double flip for merging values in an array
		$merged = array_flip($merged);
		$merged = array_flip($merged);

		$sFromGroups = implode( ',', $merged );
		return $sFromGroups;
	}

	function _setGroupString( $str ){
		$this->_formGroupStr = $str;
	}

	/**
	 * sets the variable of each of the form's group's elements to the value
	 * specified
	 * @param string variable name
	 * @param string variable value
	 * @return bol false if update error occurs
	 */

	function setElementVars( $varName, $varVal ){
		$db =& JFactory::getDBO();
		if( $this->_elements == null ){
			$this->getFormGroups( );
		}
		foreach( $this->_elements as $el ) {
			$element =& JTable::getInstance( 'Element', 'Table' );
			$element->load( $el->id );
			if( !$element->setVar( $varName, $varVal ) ){
				return false;
			}
			$element->store( );
		}
		return true;
	}

	/**
	 * check if the given email address is correctly formatted
	 * @param string email address to check
	 * @return bol ok / not ok
	 */
	function check_email_address( $email ){

	}

	/**
	 * check if string is alpha numeric
	 * @param string data to check
	 * @return bol ok or not
	 */

	/*function isAlphaNumeric( $data ){
		if ( ereg('[^A-Za-z0-9]', $data ) ) {
		return false;
		} else {
		return true;
		}
		}*/

	/**
	 * determines if the form can be published
	 * @return bol true if publish dates are ok
	 */

	function canPublish( )
	{
		global $mainframe;
		$db =& JFactory::getDBO();
		$form =& $this->getForm();
		if (method_exists( $db, 'getNullDate' )) {
			$nullDate = $db->getNullDate( );
		} else {
			$nullDate = $this->getNullDate( );
		}
		$publishup =& JFactory::getDate($form->publish_up, $mainframe->getCfg('offset'));
		$publishup = $publishup->toUnix();
		
		$publishdown =& JFactory::getDate($form->publish_down, $mainframe->getCfg('offset'));
		$publishdown = $publishdown->toUnix();
		
		$jnow		=& JFactory::getDate();
		$now		= $jnow->toUnix();
		if ($form->state == '1') {
			if ($now >= $publishup || $form->publish_up == '' || $form->publish_up == $nullDate) {
				if ($now <= $publishdown || $form->publish_down == '' || $form->publish_down == $nullDate) {
					return true;
				}
			}
		}
		return false;
	}

	/**
	 * creates a html dropdown off all forms
	 * @param int selected group id
	 * @param string default label
	 * @return string group list
	 */

	function makeDropDown( $selectedId = 0, $defaultlabel = '' )
	{
		if ($defaultlabel == '') {
			$defaultlabel = JText::_( 'Please select' ) ;
		}
		$db =& JFactory::getDBO();
		$db->setQuery( "SELECT id AS value, label AS text FROM #__fabrik_forms ORDER BY label" );
		$aTmp[] = JHTML::_('select.option', "-1", $defaultlabel );
		$forms = $db->loadObjectList( );
		$forms = array_merge( $aTmp, $forms );
		$list = JHTML::_('select.genericlist', $forms, 'filter_formId', 'class="inputbox"  onchange="document.adminForm.submit( );"', 'value', 'text', $selectedId );
		return $list;
	}

	/**
	 * create a drop down list of all the elements in the form
	 * @param string drop down name
	 * @param string current value
	 * @param bol add elements that are not show in the table view
	 * @param bol add elements that are unpublished
	 * @param add the table name to the option's element name
	 * @param array joins for the table
	 * @param string table database name
	 * @param bol concat table name and el name with "___" (true) or "." (false)
	 * @return string html list
	 */

	function getElementList( $name = 'order_by', $default = '', $showNotInTable = true, $excludeUnpublished = false, $showTableName = false, $aJoinObjs=array( ), $tableName = '', $useStep = false )
	{
		$aEls = array( );
		$aEls = $this->getElementOptions( $showNotInTable, $excludeUnpublished, $showTableName, $aJoinObjs, $tableName, $useStep );
		$aEls[] = JHTML::_('select.option', '', '-' );
		asort($aEls);
		return JHTML::_('select.genericlist',  $aEls, $name, 'class="inputbox" size="1" ', 'value', 'text', $default );
	}

	function getElementIDList( $name, $default )
	{
		$aEls = array( );
		foreach ($this->_groups as $groupModel) {
			foreach ($groupModel->_aElements as $elementModel) {
				$element =& $elementModel->getElement();
				$aEls[] = JHTML::_( 'select.option', $element->id, $element->label );
			}
		}
		return JHTML::_( 'select.genericlist',  $aEls, $name, 'class="inputbox" size="1" ', 'value', 'text', $default );
	}
	
	function getElementIds()
	{
		$aEls = array( );
		foreach ($this->_groups as $groupModel) {
			foreach ($groupModel->_aElements as $elementModel) {
				$element =& $elementModel->getElement();
				$aEls[] = $element->id;
			}
		}
		return $aEls;
	}

	/**
	 * creates options array to be then used by getElementList to create a drop down of elements in the form
	 * sperated as elements need to collate this options from muliple forms
	 * @param bol add elements that are not show in the table view
	 * @param bol add elements that are unpublished
	 * @param add the table name to the option's element name
	 * @param array joins for the table
	 * @param string table database name
	 * @param bol concat table name and el name with "___" (true) or "." (false)
	 * @param string name of key to use (default "name")
	 * @return array html options
	 */

	function getElementOptions( $showNotInTable = true, $excludeUnpublished = false, $showTableName = false, $aJoinObjs=array( ), $tableName = '', $useStep = false, $key = 'name' )
	{
		$aGroupEls = $this->getGroupsHiarachy( $showNotInTable, $excludeUnpublished );

		$aEls = array( );
		$step =( $useStep ) ? "___" : ".";
		//$step = "___";
		foreach( $aGroupEls as $group ){
			foreach( $group->_aElements as $elementModel ){
				$el = $elementModel->getElement();
				$val = $el->$key;
				$label = $el->label;
				if( $group->_group->is_join && is_array( $aJoinObjs ) ){
					foreach( $aJoinObjs as $oJoin ){
						if( $oJoin->group_id == $group->_id ){
							if( $key != "id" ){

								$val = ($this->_addDbQuote) ?  "`$oJoin->table_join`" . $step . "`$val`" : $oJoin->table_join . $step . $val;
							}
							$label = ($this->_addDbQuote) ? "`$oJoin->table_join`" . $step . "`$label`" : $oJoin->table_join . $step . $label;
						}
					}
				}else{
					if($tableName != '' && $key != "id" ){
						$val = ($this->_addDbQuote) ? "`$tableName`" . $step . "`$val`" : $tableName . $step . $val;
					}
				}
				$aEls[] = JHTML::_('select.option', $val, $label );
			}
		}
		asort($aEls);
		return $aEls;
	}

	/**
	 * collates data to write out the form
	 * @param bol if in Joomla administration site
	 * @return mixed . Object template if rendered as mambot otherwise empty
	 */

	function render( $admin = false )
	{
		@set_time_limit(300);
		$user 				=& JFactory::getUser();
		$usersConfig 	=& JComponentHelper::getParams( 'com_fabrik' );
		$this->_rowId = JRequest::getInt( 'rowid', $usersConfig->get('rowid') );
		if ($this->_rowId == '-1') {
			$this->_rowId = $user->get('id');
		}
		$this->getForm();
		$this->_data = array();
		$this->setAdmin( $admin );

		$pluginManager =& JModel::getInstance( 'Pluginmanager', 'FabrikModel' );

		if (!$pluginManager->runPlugins( 'onLoad', $this )) {
			return;
		}
		$aJoinFields 	= array();
		$aGroups 			= null;
		$form 				=& $this->getForm();

		if (!$form->record_in_database) {
			$formDefaultData = JRequest::get( 'request' );
			$aGroups			=& $this->getGroupsHiarachy( );
		}else{
			$tableModel 	=& $this->getTableModel( );
			$fabrikDb   	=& $tableModel->getDb( );
			$aGroups			=& $this->getGroupsHiarachy( );
			$table 				=& $tableModel->getTable();
			if (!$fabrikDb) {
				return JError::raiseWarning( JText::_( "could not connect to database" ));
			}

			$this->_aJoinObjs 	=& $tableModel->getJoins();

			if (!empty( $this->_arErrors )) {
				//form has failed validation, so get the form data from the request array
				$elementData = array( JArrayHelper::toObject(JRequest::get( 'request' )) );
			} else {
				
				//test if its a resumed paged form
				$pagegroups = $this->getPageSaveGroups();
				if (!empty( $pagegroups )) {
					$srow = $this->getSessionData();
					$elementData = array(JArrayHelper::toObject(unserialize($srow->data)));
				} else {
					//otherwise lets get the table record
					$sql = $this->_buildQuery();
					$fabrikDb->setQuery( $sql );
					if (JRequest::getBool( 'fabrikdebug', 0, 'get' ) == 1) {
						echo $fabrikDb->getQuery();
					}
					$elementData = $fabrikDb->loadObjectList( );
					echo $fabrikDb->getErrorMsg();
					// if empty data return and trying to edit a record then show error
					if (empty( $elementData ) && $this->_rowId != '') {
						return JError::raiseNotice( 500, JText::sprintf( 'We were unable to find the record (id = %s) in the database', $this->_rowId ) );
					}
				}
			}
			
			/**
			* take a copy of the join data and store. Note this can be more than one
			* result set in which case the joined group should be duplicated on 
			* presenting the form
			* and fille with the correct data
			*/
			
			$this->_joinDefaultData = array();
			if ($this->_rowId != '' && is_array( $this->_aJoinObjs )) {
				foreach ($elementData as $row) {
					foreach ($row as $key=>$val) {
						foreach ($this->_aJoinObjs as $oJoin) {
							if(strstr($key, $oJoin->table_join . '___')) {
								if (!array_key_exists( $oJoin->id, $this->_joinDefaultData )) {
									$this->_joinDefaultData[$oJoin->id][$key] = array($val);
								 }else {
									if (count( $this->_joinDefaultData ) > 0) {
										if (!array_key_exists( $key, $this->_joinDefaultData[$oJoin->id] )) {
											$this->_joinDefaultData[$oJoin->id][$key][] = $val;
										} else if(!in_array($val, $this->_joinDefaultData[$oJoin->id][$key] )) {
											$this->_joinDefaultData[$oJoin->id][$key][] = $val;
										}
									}
								 }
							}
						}
					}
				}
			}
		
			//set the main part of the form's default data
			if ($this->_rowId != '') {
				$formDefaultData = JArrayHelper::fromObject( $elementData[0] );
			} else {
				//could be a view
				if ($tableModel->isView()) {
					//@TODO test for new records from views
					$formDefaultData = JArrayHelper::fromObject( $elementData[0] );
				} else {
					if (count( $this->getPageSaveGroups() > 0) && is_object($elementData[0])) {
						$formDefaultData = JArrayHelper::fromObject( $elementData[0] );
					}else{
						$formDefaultData = JRequest::get( 'request' );
					}
				}
			}
			if (JRequest::getBool( 'fabrikdebug', 0, 'get' ) == 1) {
				echo "<pre>default data = ";print_r($formDefaultData);echo "</pre>";
			}
			$this->_table =& $tableModel;
		}
		$this->_data = $formDefaultData;
	}

	function getSessionData()
	{
		
		$this->sessionModel =& JModel::getInstance( 'Formsession', 'FabrikModel'); 
		$this->sessionModel->setFormId( $this->_id );
		$this->sessionModel->setRowId( $this->_rowId );
		$srow =& $this->sessionModel->load();
		return $srow;
	}
	
	/**
	 * @access private
	 * create the sql query to get the rows data for insertion into the form
	 */

	function _buildQuery()
	{
		$tableModel 	=& $this->getTableModel( );
		$form					=& $this->getForm();
		$fabrikDb   	=& $tableModel->getDb( );
		$table 				=& $tableModel->getTable();
		$aGroups			=& $this->getGroupsHiarachy( );
		$params				=& $this->getParams();
		$tableModel->_onlyTableData = false;
		$_aAsFields 		= $tableModel->_getAsFields( );
		
		/*$cache =& JFactory::getCache( 'com_fabrik' );
		$tableModel->_oForm =& $this;
		if(!$this->_admin){
			$_aAsFields = $cache->call( array( &$tableModel, '_getAsFields' ), $aJoinObjs );
		}else{
			$_aAsFields 		= $this->_getAsFields( $aJoinObjs );	
		}*/
		/*rather than do select *
		 we have to manually try to make a list of elements (table.ele) as otherwise
		 duplicate element names overwrite data !*/
		if ($form->record_in_database) {
			$sql = $tableModel->_buildQuerySelect();
			$sql .= $tableModel->_buildQueryJoin();
		} else {
			/*$sql = "SELECT ";
			$aUsedTables = array( $table->db_table_name );
			if (is_array( $this->_aJoinObjs )) {
				foreach ( $this->_aJoinObjs as $join ) {
					$aUsedTables[$join->group_id] = array($join->table_join, $join->id);
				}
			}
			foreach ($aGroups as $groupModel) {
				$group =& $groupModel->getGroup();
				foreach ($groupModel->_aElements as $elementModel) {
					$element =& $elementModel->getElement();
					if (!$elementModel->recordInDatabase( )) {
						continue;
					}
					if ($group->is_join) {
						$posTable 	= $aUsedTables[$element->group_id][0];
						$joinId 	= $aUsedTables[$element->group_id][1];
						$elName 	= $posTable . '.' . $element->name;
						$tmpName 	= $posTable . $this->_joinTableElementStep . $element->name;
						//$elAsName 	=  'join[' . $joinId . ']' . $tmpName;
						$elAsName 	=  'join' .$this->_joinTableElementStep . $joinId . $this->_joinTableElementStep . $tmpName;
						$sql .= $elName . ' AS `' . $elAsName .'`,';
					} else {
						$possibleTables = $elementModel->getElementsGroupTables();
						foreach ($possibleTables as $posTable) {
							if (in_array( $posTable->db_table_name, $aUsedTables)) {
								$sql .= "`$posTable->db_table_name`" . '.`' . $element->name .'`';
								$sql .= ' AS `' . $posTable->db_table_name . $this->_joinTableElementStep . $element->name . '`,';
							}
						}
					}
				}
			}
			$sql = substr( $sql, 0, strlen($sql)-1 );
			$sql .= " FROM `$table->db_table_name` ";
	
			if (is_array( $this->_aJoinObjs )) {
				foreach ($this->_aJoinObjs as $oJoin) {
					$sql .= " $oJoin->join_type JOIN $oJoin->table_join " .
					"ON $oJoin->table_join.$oJoin->table_join_key = " .
					"$oJoin->join_from_table.$oJoin->table_key \n";
					$sql2 = "DESCRIBE $oJoin->table_join" ;
					$fabrikDb->setQuery( $sql2 );
					$aJoinFields[$oJoin->id] = $fabrikDb->loadResultArray();
				}
			}*/
		}
		$random = JRequest::getVar( 'random' );
		$usekey = JRequest::getVar( 'usekey' );
		if ($usekey != '') {
			$usekey = $table->db_table_name.'.'.$usekey;
			FabrikString::safeColName( $usekey );
		}
	
		$viewpk = JRequest::getVar('view_primary_key');
		if (!$random && $this->_rowId != '') {
			$sql .= " WHERE ";
			$sql .=  ($usekey != '') ? " $usekey = '$this->_rowId' " : " $table->db_primary_key = '$this->_rowId' ";
		} else {
			
			if ($viewpk != '') {
				$sql .= " WHERE $viewpk ";
			} else if ($random) {
				$sql .= " ORDER BY RAND() LIMIT 1 ";
			}
		}
		// get prefilter conditions from table and apply them to the record
		$where = $this->_table->_buildQueryWhere( true );
		if ($this->_rowId != '') {
			$where = str_replace( 'WHERE', 'AND', $where );
		}
		
		//set rowId to -2 to indicate random record
		if ($random) {
			$this->_rowId = -2;
		}
		$sql .= $where;
		return $sql;
	}

	/**
	 * After having saved the form we
	 * 1) Create a new group if none selected in edit form list
	 * 2) Delete all old form_group records
	 * 3) Recreate the form group records
	 * 4) Make a table view if needed
	 * @return bol true if you should display the form list, false if you're
	 * redirected elsewhere
	 */

	function saveFormGroups( )
	{
		$db =& JFactory::getDBO();
		$current_groups_str = JRequest::getVar( 'current_groups_str', $this->_getFromGroupsStr( ), 'post' );
		$record_in_database = JRequest::getInt( 'record_in_database', $this->_form->record_in_database, 'post' );
		$createGroup 				= JRequest::getInt( '_createGroup', 0, 'post' );
		$form =& $this->getForm();
		if ($createGroup) {
			$group = JTable::getInstance( 'Group', 'Table' );
			$group->name = $form->label;
			$group->state = 1;
			$group->store();
			$current_groups_str .= "," . $db->insertid() ;
		}

		$db->setQuery( "DELETE FROM #__fabrik_formgroup WHERE form_id = '" . $this->_id . "'");
		// delete the old form groups
		if (!$db->query( )) {
			JError::raiseError( 500, $db->stderr());
		}
		
		$this->_makeFormGroups( $current_groups_str );

		if ($record_in_database == '1') {
			$tableModel =& $this->getTableModel();
			$dbTableName = ( $tableModel->_table->db_table_name == '') ? JRequest::getVar( '_database_name', '', 'post' ) : $tableModel->_table->db_table_name;
			$cnn =& $tableModel->getConnection();
			$cnnId = JRequest::getVar( '_connection_id', $cnn->_id, 'post' );
			$table =& $tableModel->_table;
			
			$defaultDb =& $tableModel->getDb();
		
			if (!$tableModel->databaseTableExists( $dbTableName, $defaultDb )) {
				//need to pass the correct database obj here
				$tableModel->createDBTable( $this, $dbTableName, $defaultDb );

				$connection =& $tableModel->getConnection();
		
				//NEW 2.0 create table view
				//enusre _tbl_key is set to 'id'
				$table->_tbl_key = 'id';
				$table->id = null;
				$table->label 				= $form->label;
				$table->form_id 			= $form->id;
				$table->connection_id 	= $connection->_id;
				$table->db_table_name	= $dbTableName;
				$table->db_primary_key = '`'.$dbTableName . '`.`fabrik_internal_id`';
				$table->auto_inc 			= 1;
				$table->state 				= $form->state;
				$table->created				= $form->created;
				$table->created_by		= $form->created_by;
				$table->attribs = $tableModel->getDefaultAttribs();
				$res = $table->store();
				if ($res) {
					$tableModel->createCacheQuery();
				} else {
					$fabrikDatabase =& $tableModel->getDb();
					if ($dbTableName == '') {
						$dbTableName = JRequest::getVar( 'db_table_name', '', 'post' );
						if ($dbTableName == '') {
							$table->load( JRequest::getInt( 'id', '', 'post' ) );
							$dbTableName = $table->db_table_name;
						}
					}
					$tableModel = $this->getTableModel();
					$tableModel->ammendTable( $this, $dbTableName, $fabrikDatabase );
				}
			}
		}
	}
	
	function _makeFormGroups( $current_groups_str )
	{
		$db =& JFactory::getDBO();
		$orderid = 1;
		$current_groups = explode( ",", $current_groups_str );
		foreach ($current_groups as $group_id) {
			if ($group_id != '') {
				$sql = "INSERT INTO #__fabrik_formgroup (form_id, group_id, ordering) VALUES ('" . $this->_id . "','$group_id','$orderid')";
				$db->setQuery( $sql );
				if (!$db->query( )) {
					JError::raiseError( 500, $db->stderr());
				}
				$orderid ++;
			}
		}
	}

	/**
	 * attempts to determine if the form contains the element
	 * @param string element name to search for
	 * @return bol true if found, false if not found
	 */

	function hasElement( $searchName )
	{
		$this->getGroupsHiarachy( false );
		foreach ($this->_groups as $groupModel) {
			foreach($groupModel->_aElements as $elementModel ){
				$element =& $elementModel->getElement();
				if ($searchName == $element->name) {
					$this->_currentElement = $elementModel;
					return true;
				}
				if ($searchName == $elementModel->getFullName( true, true, false)) {
					$this->_currentElement = $elementModel;
					return true;
				}
				if ($searchName == $elementModel->getFullName( false, true, false)) {
					$this->_currentElement = $elementModel;
					return true;
				}
				if ($searchName == $elementModel->getFullName( true, false, false)) {
					$this->_currentElement = $elementModel;
					return true;
				}
				if ($searchName == $elementModel->getFullName( false, false, false)) {
					$this->_currentElement = $elementModel;
					return true;
				}
			}
		}
		return false;
	}

	function setTableModel( &$tableModel )
	{
		$this->_table = $tableModel;
	}
	
	/**
	 * is the page a multipage form?
	 * @return bol true/false
	 *
	 */
	
	function isMultiPage()
	{
		$this->getGroupsHiarachy( false );
		foreach ($this->_groups as $groupModel) {
			$params =& $groupModel->getParams();
			if ($params->get( 'split_page' )) {
				return true;
			}
		}
		return false;
	}
	
	/**
	 * get an array of pages, with their containing group ids
	 *
	 * @return array
	 */
	
	function getPages()
	{
		if (!is_null( $this->pages )) {
			return $this->pages;
		}
		$this->pages = array();
		$pageCounter = 0;
		$this->getGroupsHiarachy( false );
		foreach ($this->_groups as $groupModel) {
			$params =& $groupModel->getParams();
			if ($params->get( 'split_page' )) {
				$pageCounter ++;
			}
			$this->pages[$pageCounter][] = $groupModel->_id;
		}
		return $this->pages;
	}
	
	function getPageSaveGroups()
	{
		$a = array();
		$this->getGroupsHiarachy( false );
		foreach ($this->_groups as $groupModel) {
			$params =& $groupModel->getParams();
			if ($params->get( 'split_page_save' )) {
				$a[] = $groupModel->_id;
			}
		}
		return $a;
	}
}

?>