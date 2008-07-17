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
//these requires are needed for when the dd is trying to update itself via a package call
require_once( COM_FABRIK_FRONTEND.DS.'helpers'.DS.'json.php' );
require_once( COM_FABRIK_FRONTEND.DS.'helpers'.DS.'parent.php' );

class FabrikModelFabrikDatabasejoin  extends FabrikModelElement {

	var $_pluginName = 'databasejoin';
	
	var $xmlPath = null;

	var $_aVals = array();
	
	/** @var object connection */
	var $_cn = null;

	var $_joinDb = null;

	/** @var created in getJoin **/
	var $_join = null;
	
	/** @var string for simple join query*/
	var $_sql = null;
	
	/** @var array option values **/
	var $_optionVals = null;
	
	/**
	* Constructor
	*/

	function __construct()
	{
		parent::__construct();
	}

	/**
	 * can be overwritten in the plugin class - see database join element for example
	 * testing to see that if the aFields are passed by reference do they update the table object?
	 *
	 */

	function getAsField_html( &$aFields, &$aAsFields, $table )
	{
		$db =& JFactory::getDBO();
		$tableModel =& $this->_table;
		
		$element =& $this->getElement();
		$tableRow = $tableModel->getTable();
		foreach($tableModel->_aJoins as $tmpjoin){
			if($tmpjoin->element_id == $element->id){
				$join =& $tmpjoin;
				break;
			}
		}
		$connection = $tableModel->getConnection();
		$params = $this->getParams();
		//make sure same connection as this table and that its not an advanced join
		$fullElName = $table . "___" . $element->name;
		if ($params->get( 'join_conn_id' ) == $connection->_id && $params->get( 'joinType' ) != 'advanced') {
			
			$join_val_column 	= $params->get( 'join_val_column' );
			
			$joinTableName  	=  $join->table_join_alias;
			
			$tables = $this->getLinkedFabrikTables();
			$p 			= &new fabrikParams( $join->attribs );
			$label 	= $p->get('join-label');

			//	store unjoined values as well (used in non-join group table views)
			//this wasnt working for test case:
			//events -> (db join) event_artists -> el join (artist)
			//$aFields[]				= "`$tableRow->db_table_name`.`$element->name` AS `$fullElName" . "_raw`" ;
			
			$aFields[]				= "`$join->keytable`.`$element->name` AS `$fullElName" . "_raw`" ;
			
			$aAsFields[]			= "`$fullElName". "_raw`";
			
			$aFields[] 				= "`$joinTableName`.`$label` AS `$fullElName`" ;
			$aAsFields[] 			= "`$fullElName`";
			

		} else {
			
			$aFields[] 		= "`$table`.`$element->name` AS `$fullElName`" ;
			$aAsFields[] 	= "`$fullElName`";
			
			//TODO: get _raw data for advanced joins as well
		}
	}

	/**
	 * get as field for csv export
	 * can be overwritten in the plugin class - see database join element for example
	 * testing to see that if the aFields are passed by reference do they update the table object?
	 */

	function getAsField_csv( &$aFields, &$aAsFields, $table )
	{
		$element =& $this->getElement();
		// Don't show Distinct records if joined records are shown in table view
		$params 		= $this->getParams();
		$fullElName 	= $table . "___" . $element->name;
		$aFields[] 		= "`$table`.`$element->name` AS `$fullElName`" ;
		$aAsFields[] 	= $fullElName;
	}

	//TODO: test advanced joins

	/**
	 * shows the data formatted for the table view
	 * @param string data
	 * @param object all the data in the tables current row
	 * @return string formatted value
	 */

/*	function renderTableData( $data, $oAllRowsData )
	{
		return $data;
		return;
		//TODO: advance join code id resource intensive - the sql should be called once and looked up
		$db =& JFactory::getDBO();
		$params =& $this->getParams();
		$groupModel =& $this->_group;
		$tableModel =& $this->_table;
		$table =& $tableModel->getTable();
		
		$element =& $this->getElement();
		$this->_joinDb = $this->getDb();
		
		if ( $this->_joinDb ) {
			if( $params->get( 'joinType' ) == 'advanced' ) {
				$aAvJoins 	= $this->getAdvancedJoinsObjs( );
				$val 		= stripslashes( $params->get( 'advJoin_concat' ) );
				$table 		= $aAvJoins[0]->join_from_table;
				$key 		= $aAvJoins[0]->table_join_key;
				$key 		= $params->get('advJoin_key', $table.'.'.$element->name );
				$table 		= $params->get('advJoin_startTable', $table);
				$sql 		= "SELECT $key AS value, CONCAT($val) AS text FROM $table ";
				$aUsedJoins = array();
				foreach( $aAvJoins as $oJoin ){
					$tmpSql = "\n " . strtoupper($oJoin->join_type) . " JOIN $oJoin->table_join  ON $oJoin->join_from_table.$oJoin->table_key = $oJoin->table_join.$oJoin->table_join_key";
					if( !in_array($tmpSql, $aUsedJoins ) ){
						$sql .= $tmpSql;
						$aUsedJoins[] = $tmpSql;
					}
				}

				if( !strstr( $col, '.' ) ){
					$col = $table . '.' . $col;
				}

				$newCol = $table->db_table_name . '.' . $element->name;
				$col 	= $table->db_table_name . '.' . $element->name;
				if(array_key_exists($col, $oAllRowsData)){
					if( !in_array($oAllRowsData->$col, $this->_aVals ) ){
						if( isset( $oAllRowsData->$col ) ){
							$this->_aVals[] = $oAllRowsData->$col;
						}else{
							// we should also check if the origonal table/key has records
							if( !in_array($oAllRowsData->$newCol, $aVals ) ){
								// if the advanced key contains nothing relating to this table then try this 
								$this->_aVals[] = $oAllRowsData->$newCol;
							}
						}
					}
				}else{
					echo "Could not create advanced database join!<br />";
				}
			}else{
				if ($groupModel->canRepeat()) {
					$col = $this->getFullName(false, true, false);
					$rawcol = $col . "_raw";
					if (array_key_exists( $rawcol, $oAllRowsData )) {
						$col = $rawcol;
					}
					$rawData = $oAllRowsData->$col;
					$rawData = explode($this->_groupSplitter, $rawData);
					$sData= '';
					foreach ($rawData as $d) {
						$sData .= "'$d',";
					}
					$sData  = rtrim ($sData, ",") ;
					$join_db_name 		= $params->get('join_db_name', '');
					$join_key_column 	= $params->get('join_key_column', '');
					$join_val_column  	= $params->get('join_val_column', '');
					$sql = "SELECT `$join_val_column` FROM $join_db_name WHERE `$join_key_column` in ($sData)";
					$this->_joinDb->setQuery($sql);
					$data = implode(',', $this->_joinDb->loadResultArray());
				}
				
				
				return $data;
			}
		} else {
			return "- could not connect to database -";
		}

		return $data;
	}
*/
	
	/**
	 *@param string join from table name
	 * @return object join table 
	 */
	
	function getJoin( $table )
	{
		if (!is_null( $this->_join )) {
			return $this->_join;
		}
		$join 					=& JTable::getInstance( 'Join', 'Table' );
		$groupModel 	=& $this->_group;
		$element =& $this->getElement();
		if ($groupModel->isJoin()) {
			
			$group =& $groupModel->getGroup();
			$groupJoin = JModel::getInstance( 'Join', 'FabrikModel' );
		
			$j = $groupJoin->loadFromGroupId($group->id);
			
			$table = $j->join_from_table;
			$join->join_from_table = $j->table_join;
		} else {
			$join->join_from_table = $table;
		}
		
		$params =& $this->getParams();
		
		$join->join_type 		= 'LEFT';
		//TODO: these are in the params object now
		$join->_name 					= $element->name;
		$join->table_join 			= $params->get( 'join_db_name' );
		$join->table_join_key 	= $params->get( 'join_key_column' );
		$join->table_key 			= $element->name;
		$this->_join = $join;
		return $join;
	}		

	 
	 /**
	  * load this elements joins
	  */
	 
	function getJoins( )
	{
		$db =& JFactory::getDBO();
		if (!isset( $this->_aJoins )) {
			$sql = "SELECT * FROM #__fabrik_joins WHERE element_id = '$this->_id' ORDER BY id";
			$db->setQuery( $sql );
			$this->_aJoins = $db->LoadObjectList( );
		}
		return $this->_aJoins;
	}
	
	function mergeTableData( &$oAllRowsData, &$tableModel )
	{
		$db =& JFactory::getDBO();
		$params =& $this->getParams();
		$element =& $this->getElement();
		$table =& $tableModel->getTable();
		if ($params->get( 'joinType' ) != 'advanced') {
			return;
		}
		$aAvJoins 	= $this->getAdvancedJoinsObjs( );
		$val 		= stripslashes( $params->get( 'advJoin_concat' ) );
		$table 		= $aAvJoins[0]->join_from_table;
		$key 		= $aAvJoins[0]->table_join_key;
		$key 		= $params->get('advJoin_key', $table.'.'.$element->name );
		$table 		= $params->get('advJoin_startTable', $table);
		$sql 		= "SELECT $key AS value, CONCAT($val) AS text FROM $table ";
		$aUsedJoins = array();
		foreach( $aAvJoins as $oJoin ){
			$tmpSql = "\n " . strtoupper($oJoin->join_type) . " JOIN $oJoin->table_join  ON $oJoin->join_from_table.$oJoin->table_key = $oJoin->table_join.$oJoin->table_join_key";
			if( !in_array($tmpSql, $aUsedJoins ) ){
				$sql .= $tmpSql;
				$aUsedJoins[] = $tmpSql;
			}
		}

		$newCol = $table->db_table_name . '.' . $element->name;
		$col = $table->db_table_name . '.' . $element->name;
		$sVals	= implode( '\', \'', $this->_aVals );
		$sql .= " WHERE $key IN ( '$sVals' )";
		if( count($this->_aVals) > 0 ){
			$this->_joinDb->setQuery( $sql );
			$oNewJoinStuff = $this->_joinDb->loadObjectList( 'value' );
			if( is_array( $oNewJoinStuff ) ){
				for ( $i=0; $i<count( $oAllRowsData ); $i++ ){
					if( array_key_exists( $col, $oAllRowsData[$i] ) ){
						$testKey = $oAllRowsData[$i]->$col;
						if( array_key_exists( $testKey, $oNewJoinStuff ) ){
							$oAllRowsData[$i]->$col =  $oNewJoinStuff[$testKey]->text;
						}
					}
					if( array_key_exists( $newCol, $oAllRowsData[$i] ) ){
						if( isset( $oAllRowsData[$i]->$newCol ) ){
							$altTestKey = $oAllRowsData[$i]->$newCol;
							if(array_key_exists( $altTestKey, $oNewJoinStuff ) ){
								$oAllRowsData[$i]->$newCol = $oNewJoinStuff[$altTestKey]->text;
							}
						}
					}
				}
			}
		}
		if ( $this->_joinDb->getErrorMsg() != '' ){
			echo "<br>db error for $sql <br /><br />";
		}
	}

	function getJoinsToThisKey( &$table )
	{
		$db =& JFactory::getDBO();
		$sql = "SELECT *, t.label AS tablelabel FROM #__fabrik_elements AS el " .
		"LEFT JOIN #__fabrik_formgroup AS fg
				ON fg.group_id = el.group_id 
				LEFT JOIN #__fabrik_forms AS f 
				ON f.id = fg.form_id 
				LEFT JOIN #__fabrik_tables AS t 
				ON t.form_id = f.id " .
		"WHERE " .
		" plugin = 'fabrikdatabasejoin' AND" .
		" join_db_name = '" . $table->db_table_name . "' " .
		"AND join_conn_id = '" . $table->connection_id . "' ";

		$db->setQuery( $sql );
		return $db->loadObjectList( );
	}
	/**
	 * get array of option values 
	 *
	 * @param unknown_type $data
	 * @return unknown
	 */

	function _getOptionVals( $data = array())
	{
		if (isset($this->_optionVals)) {
			return $this->_optionVals;
		}
		$db =& $this->getDb();
		$sql = $this->_buildQuery( $data );
		$db->setQuery( $sql );
		if (JRequest::getVar( 'fabrikdebug' )) {
			echo "<pre>".$db->getQuery( ) . "</pre>";
		}
		if ($db->getErrorNum()) {
			JError::raiseError( 500, $db->getErrorMsg() );
		}
		$this->_optionVals = $db->loadObjectList( );
		return $this->_optionVals;
	}
	
	/**
	 * get a list of the HTML options used in the database join drop down / radio buttons
	 * @param object data from current record (when editing form?)
	 * @return array option objects
	 */

	function _getOptions( $data = array() )
	{
		$element 		=& $this->getElement();
		$params 		=& $this->getParams();
		$showBoth 		= $params->get( 'show_both_with_radio_dbjoin', '0' );
		$this->_joinDb =& $this->getDb();
		$col	= $element->name;
		$tmp = array( );
		
		$aDdObjs =& $this->_getOptionVals( $data );
		$table 	 = $this->_form->_table->_table->db_table_name;
		
		//TODO: test this - looks real messy!

		if ($params->get( 'joinType' ) == 'advanced') {
			$col 	 = $this->getFullName( false );
			/* go through and check distict text only - not sure if this is wise*/

			$aExistingText = array();
			for( $i=count( $aDdObjs )-1; $i>=0; $i-- ){
				$oDd = $aDdObjs[$i];
				if( !in_array( $oDd->text, $aExistingText ) ){
					$aExistingText[] = $oDd->text;
				} else {
					unset( $aDdObjs[$i] );
				}
			}
			/* merge advanced join data into the elementdata array (used to get default values for advanced drop down elements)*/
			$aAvJoins = $this->getAdvancedJoinsObjs( );
			$dbcol 	= $params->get('advJoin_key', $table.'.'.$element->name );
			$table	= $params->get('advJoin_startTable', $aAvJoins[0]->join_from_table);
			$sql 	= "SELECT $dbcol AS value FROM $table ";
			$aUsedJoins = array();
			foreach ($aAvJoins as $oJoin) {
				$tmpSql = "\n $oJoin->join_type JOIN $oJoin->table_join ON $oJoin->join_from_table.$oJoin->table_key = $oJoin->table_join.$oJoin->table_join_key";
				if (!in_array( $tmpSql, $aUsedJoins )) {
					$sql .= $tmpSql;
					$aUsedJoins[] = $tmpSql;
				}
			}
			$tmpKey =  $this->getFullName( );
			if (array_key_exists( $tmpKey, $data )) {
				$sql .= " WHERE $dbcol = '$data[$tmpKey]'";
			}
			$this->_joinDb->setQuery( $sql );

			$elementData[$col] = $this->_joinDb->loadResult();
			if ($this->_joinDb->getErrorMsg() != '') {
				JError::raiseError( 500, $this->_joinDb->getError() );
			}
		}
		$tmp = array_merge( $tmp, $aDdObjs );
		$displayType 	= $params->get( 'database_join_display_type', 'dropdown' );
		if ($displayType == "dropdown") {
			array_unshift( $tmp, JHTML::_('select.option', $params->get('database_join_noselectionvalue') , JText::_('Please select') ) );
		} else {
			if ($showBoth) {
				$tmp[] = JHTML::_('select.option', '' , JText::_( 'both' ) );
			}
		}
		/*convert text to html encoded text*/
		//for( $c = 0;$c<count( $tmp );$c++ ){
			//$tmp[$c]->text = htmlspecialchars( $tmp[$c]->text );
		//}
		return $tmp;
	}
	
	/**
	 * create the sql query used to get the join data
	 * @param array
	 * @return string
	 */
	
	function _buildQuery( $data = array() )
	{
		if( isset($this->_sql)){
			return $this->_sql;
		}
		$params =& $this->getParams();
		$element =& $this->getElement();
		
		$where			= $params->get( 'database_join_where_sql', '' );
		$w = new FabrikWorker(); 
		if (is_array( $data )) {
			$where 			= $w->parseMessageForPlaceHolder( $where, $data );
		} else {
			$where 			= $w->parseMessageForPlaceHolder($where);
		}
		
		if ($params->get( 'joinType' ) == 'advanced') {
			$aAvJoins = $this->getAdvancedJoinsObjs( );
			$val 			= stripslashes( $params->get( 'advJoin_concat' ) );
			$table 		= $aAvJoins[0]->join_from_table;
			$key 			= $aAvJoins[0]->table_join_key;

			$key 			= $params->get('advJoin_key', $table.'.'.$element->name );
			$table 		= $params->get('advJoin_startTable', $table);
			$sql 			= "SELECT DISTINCT($key) AS value, CONCAT($val) AS text FROM `$table` ";
 			$sql .= " " . $tableModel->_buildQueryJoin() . " ";
			//foreach ($aAvJoins as $oJoin) {
			//	$sql .= "\n $oJoin->join_type JOIN $oJoin->table_join ON $oJoin->join_from_table.$oJoin->table_key = $oJoin->table_join.$oJoin->table_join_key ";
			//}
			$this->_sql .= $where;
		} else {
			$table 	= $params->get( 'join_db_name' );
			$key		= $params->get( 'join_key_column' );
			$val		= $params->get( 'join_val_column' );
			$orderby = 'text';
			$tables =& $this->getLinkedFabrikTables();
			$tableModel =& JModel::getInstance( 'Table', 'FabrikModel' );
			foreach ($tables as $tid) {
				$tableModel->setId( $tid );
				$tableModel->getTable();
				$formModel =& $tableModel->getForm();
				$formModel->getGroupsHiarachy();
				
				$orderby = $val;
				//see if any of the tables elements match the db joins val/text 
				foreach ($formModel->_groups as $groupModel) {
					foreach ($groupModel->_aElements as $elementModel) {
						$element =& $elementModel->_element; 
						if ($element->name == $val) {
							$val = $elementModel->modifyJoinQuery( $val );
						}
					}
				}
			}
			$this->_sql = "SELECT DISTINCT($key) AS value, $val AS text FROM `$table` $where ORDER BY $orderby ASC ";
		}
		return $this->_sql;
	}
	
	function &getLinkedFabrikTables( )
	{
		//get any fabrik tables that link to the join table
		if (!isset( $this->_linkedFabrikTables )) {
			$db		=& JFactory::getDBO();
			$params =& $this->getParams();
			$table 	= $params->get('join_db_name');
			$db->setQuery( "SELECT * FROM #__fabrik_tables WHERE db_table_name = '$table'" );
			$this->_linkedFabrikTables = $db->loadResultArray();
		}
		return $this->_linkedFabrikTables;
	}
	
	/**
	 * get the database object
	 *
	 * @return object database
	 */

	function &getDb()
	{
		$cn =& $this->getConnection();
		if (!$this->_joinDb) {
			$this->_joinDb =& $cn->getDb( );
		}
		return $this->_joinDb;
	}
	
	/**
	 * get connection 
	 *
	 * @return object connection
	 */

	function &getConnection()
	{
		if (is_null( $this->_cn )) {
			$this->_loadConnection();
		}
		return $this->_cn;
	}
	
	/**
	 * @access private
	 * load connection object
	 */

	function &_loadConnection()
	{
		$params 		=& $this->getParams();
		$id 				= $params->get('join_conn_id');
		$this->_cn =& JModel::getInstance( 'Connection', 'FabrikModel' );
		$this->_cn->setId( $id );
		return $this->_cn->getConnection();
	}
	
	/**
	 * draws the form element
	 * @param array data to preopulate element with
	 * @param int repeat group counter
	 * @return string returns field element 
	 */

	function render( $data, $repeatCounter = 0 )
	{
		$params 			=& $this->getParams();
		$formModel		=& $this->_form; 
		$groupModel 	=& $this->_group;
		$element =& $this->getElement();
		$aGroupRepeats[$element->group_id] = $groupModel->canRepeat();

		$displayType 	= $params->get( 'database_join_display_type', 'dropdown' );

		$db =& $this->getDb();
		if (!$db) {
			JError::raiseWarning( JText::sprintf('Could not make join to %s', $element->name));
			return '';
		}
		if (isset( $formModel->_aJoinGroupIds[$groupModel->_id] )) {
			$joinId 		= $formModel->_aJoinGroupIds[$groupModel->_id];
			$joinGroupId 	= $groupModel->_id;
		} else {
			$joinId 		= '';
			$joinGroupId 	= '';
		}
		
		$tmp = $this->_getOptions( $data );
		
		/*get the default value */
		$w = new FabrikWorker(); 
		
		$default = $element->default;
		$default 		= $w->parseMessageForPlaceHolder( $default );
		$thisElName	 	= $this->getFullName( );
		$id = $this->getHTMLId();

		if ($this->canView( )) {
			/*if user can access the drop down*/
			if ($displayType == "dropdown") {
				$dropdown = JHTML::_('select.genericlist',  $tmp, $thisElName, 'class="fabrikinput inputbox" size="1" id="' . $id . '"', 'value', 'text', $default );
			} else {
				$dropdown =  FabrikHelperHTML::radioList( $tmp, $thisElName, 'class="fabrikinput inputbox" size="1" id="' . $id . '"', $default, 'value', 'text' );
			}
		} else {
			/* make a hidden field instead*/
			$dropdown = "<input type='hidden' class='fabrikinput' name='$col' id='$id' value='$default' />";
		}


		//get the default label for the drop down (use in read only templates)
		$defaultLabel = '';
		foreach ($tmp as $obj) {
			if($obj->value == $default){
				$defaultLabel = $obj->text;
			}
		}

		if ($params->get( 'fabrikdatabasejoin_frontend_add' )) {
			$dropdown .= "<input type='button' class='button' id='" . $id . "_add' value='" . JText::_('add') . "' />";
		}
		if (!$this->_editable) {
			return $defaultLabel;
		}
		return $dropdown;
	}

	/**
	 * get the default value for the database join element
	 *
	 * @param array $data
	 * @param bol $editable
	 * @param int $repeatCounter
	 * @return string default value
	 */

	function getDefaultValue( $data, $editable = true, $repeatCounter = 0 )
	{
		$element =& $this->getElement();
		$defaultVal = $element->default;
		
		if ($element->eval == "1") {
			$defaultVal = eval( $defaultVal );
		}
		$groupModel =& $this->_group;
		$formModel =& $this->_form;
		$group =& $groupModel->getGroup();
		$tableName = $formModel->getTableName();
		if ($group->is_join) {
			$fullName = $this->getFullName( false, true, false );
			$fullName = $fullName . "_raw";
			
			if (isset( $data[$fullName ] )) {
				$defaultVal = $data[$fullName];
				
				if (is_string($defaultVal )) {
					$defaultVal = explode( $this->_groupSplitter, $defaultVal );
				}
				
				if (is_array( $defaultVal ) && array_key_exists( $repeatCounter, $defaultVal )) {
					$defaultVal = $defaultVal[$repeatCounter];
				}
			}
		} else {
			
			
			$fullName = $tableName . $formModel->_joinTableElementStep . $element->name . "_raw";
			if ($groupModel->canRepeat()) {
				//repeat group that isnt a join group
				$aData = explode($this->_groupSplitter, $data[ $fullName ]);
				if (array_key_exists( $groupModel->_subCounter, $aData )) {
					$defaultVal = $aData[$groupModel->_subCounter];
				}
			} else {
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
				}
			}
		}
	
		/** check if its an advanced database join  & that we want to show the value rather than the id*/

		if (!$this->_editable) {
			$params =& $this->getParams();
			if ($params->get( 'joinType' ) == 'advanced') {
				$defaultVal = $this->getDatabaseDropdownDefaultValue($defaultVal);
			}
		}
		/** ensure that the data is a string **/

		if (is_array( $defaultVal )) {
			$defaultVal = implode( ',', $defaultVal );
		}
		$element->default = $defaultVal;
		return $defaultVal;
	}

	/**
	 * OPTIONAL FUNCTION
	 * code to create lists that are later used in the renderAdminSettings function
	 * @param array list of default values
	 * @param object element to apply lists to
	 */

	function _getAdminLists( &$lists )
	{
		$db 			=& JFactory::getDBO();
		$params 	=& $this->getParams();
		$oConn 		= JModel::getInstance( 'Connection', 'FabrikModel' );
		$realCnns 	= $oConn->getConnections( );
		$lists['connectionTables'] = $oConn->getConnectionTables( $realCnns );
		$tableNames = $lists['connectionTables'][$params->get('join_conn_id', -1)];
		$lists['tablename'] = JHTML::_('select.genericlist', $tableNames, 'params[join_db_name]', 'class="inputbox" size="1"', 'value', 'text', $params->get('join_db_name', ''), 'join_db_name' );
		if ( $params->get('join_db_name', '') == "" ) {
			$tableNames[] = JHTML::_('select.option', '-1', JText::_( 'Select a connection first ....' ) );
		}

		//forms for potential add record pop up form
		$db->setQuery( "SELECT id AS value, label AS text FROM #__fabrik_forms WHERE state = '1' ORDER BY text" );
		$forms = $db->loadObjectList();
		$popupformid =  $params->get('fabrikdatabasejoin_popupform');
		$lists['popupform'] = JHTML::_('select.genericlist', $forms, 'params[fabrikdatabasejoin_popupform]', 'class="inputbox" size="1" ', 'value', 'text', $popupformid );
	}

	/**
	 * REQUIRED FUNCTION
	 * defines the type of database table field that is created to store the element's data
	 */

	function getFieldDescription()
	{
		return "VARCHAR (255)";
	}

	/**
	 * REQUIRED FUNCTION
	 *
	 * @param array $lists
	 */

	function renderAdminSettings( &$lists )
	{
		$params =& $this->getParams();
		$pluginParams =& $this->getPluginParams();
		$this->_getAdminLists( $lists );
		$element =& $this->getElement();
		$checked = $pluginParams->get( 'checked' );
		$checked = ( $checked == '1') ? ' checked="checked"' : '';
		?>
<script language="javascript" type="text/javascript">
			var connectiontables = new Array;
			<?php
			$i = 0;
			if (is_array( $lists['connectionTables'] )) {
				foreach ($lists['connectionTables'] as $k => $items) {
					foreach ($items as $v) {
						echo "connectiontables[".$i ++."] = new Array( '$k','".addslashes($v->value)."','".addslashes($v->text)."' );\n\t\t";
					}
				}
			}?> 
		</script>
<div id="page-<?php echo $this->_name;?>" class="elementSettings" style="display:none">
		<?php 
		echo $pluginParams->render( 'details' ); 
		echo $pluginParams->render( 'params', 'intro' );
		$display = '';
		if ($pluginParams->get( 'joinType', 'simple' ) != 'simple') {
			$display = "display:none;";
		}?>
<div id="simpleJoinDiv" style="<?php echo $display;?>">
<?php echo $pluginParams->render( 'params', 'simple' );?>
<table cellpadding="5" cellspacing="0" border="0" width="100%" class="adminform">
	<tr>
		<td><?php echo JText::_( 'Table' ); ?></td>
		<td><?php echo $lists['tablename']; ?></td>
	</tr>
	<tr>
		<td><?php echo JText::_( 'Key' ); ?></td>
		<td id="addJoinKey">
			<input class="inputbox" type="text" name="params[join_key_column]" size="75"
			value="<?php echo $pluginParams->get( 'join_key_column' ); ?>" />
		</td>
	</tr>
	<tr>
		<td><?php echo JText::_( 'Label' ); ?></td>
		<td id="addJoinVal">
			<input class="inputbox" type="text" name="params[join_val_column]" size="75"
			value="<?php echo $pluginParams->get( 'join_val_column' ); ?>" />
		</td>
	</tr>
	<tr>
		<td><?php echo JText::_( 'Default' ); ?></td>
		<td>
		<textarea onblur="setAll(this.value, 'default');" rows="8"
			cols="72" name="default" class="inputbox"><?php echo $element->default; ?></textarea>
		</td>
	</tr>
</table>
</div>
		<?php
		$display = '';
		if( $pluginParams->get( 'joinType', 'simple' ) == 'simple' ){
			$display = "display:none;";
		}?>
<div id="advancedJoinDiv" style="<?php echo $display;?>">
<table>
	<tr>
		<td><?php echo JText::_( 'Concat statement');?>:</td>
		<td><input name="params[advJoin_concat]"
			value="<?php echo stripslashes( $pluginParams->get( 'advJoin_concat' ) );?>"
			size="70" /></td>
	</tr>
	<tr>
		<td><?php echo JText::_( 'Key to use in drop down (leave blank to default to this element)' ); ?></td>
		<td><input name="params[advJoin_key]"
			value="<?php echo stripslashes( $pluginParams->get( 'advJoin_key' ) );?>"
			size="70" /></td>
	</tr>
	<tr>
		<td><?php echo JText::_( 'Table to select from (leave blank to default to this element\'s
		table)'); ?></td>
		<td>
			<input id="params-advJoin_startTable" name="params[advJoin_startTable]"
			value="<?php echo stripslashes( $pluginParams->get( 'advJoin_startTable' ) );?>"
			size="70" /></td>
	</tr>
	<tr>
		<td colspan="2"><a href='#' id="addAdvJoin"><?php echo JText::_( 'Add Join' );?></a>
		</td>
	</tr>
</table>

</div>
	<?php
	echo $pluginParams->render( 'params', 'xtra' );
	echo $pluginParams->render( 'params', 'frontend' );
	?>
	<table>
	<tr>
		<td><?php echo JText::_('FABRIKDATABASEJOIN_PPOPUPFORM');?></td>
		<td><?php echo $lists['popupform'] ;?></td>
	</tr>
</table>

<script language="javascript" type="text/javascript">
			<?php 
			$joinCnnId = $pluginParams->get( 'join_conn_id' );
?>
			/*
<![CDATA[ */
			var elementJoin = new Class( {
		initialize: function( defaultType ) {
			this.showSimpleJoin = 'paramsjoinTypesimple';
			this.showAdvancedJoin = 'paramsjoinTypeadvanced';
			this.simpleJoinDiv = 'simpleJoinDiv',
			this.advancedJoinDiv = 'advancedJoinDiv';
			this.addNewJoin = 'addAdvJoin';
			this.joins = new Array();
			this.tables = new Array();
			this.joinCounter = 0;
			this.showSimpleJoinClick 		= this.showSimpleJoinClick.bindAsEventListener(this);
			this.showAdvancedJoinClick 		= this.showAdvancedJoinClick.bindAsEventListener(this);
			this.addNewJoinClick			= this.addNewJoinClick.bindAsEventListener(this);
			this.checkAddTableClick			= this.checkAddTable.bindAsEventListener(this);
			$(this.showSimpleJoin).addEvent('focus', this.showSimpleJoinClick );
			$(this.showAdvancedJoin).addEvent('focus', this.showAdvancedJoinClick );
			$(this.addNewJoin).addEvent('click', this.addNewJoinClick );
			if(defaultType === 'simple' ){
				$(this.showSimpleJoin).checked = "checked";
			}else{ 
				$(this.showAdvancedJoin).checked = "checked";
			}
			$('params-advJoin_startTable').addEvent( 'blur', this.checkAddTableClick );
		},
		
		addTable: function(table){
			this.tables.push(table);
		},
	
		checkAddTable: function(e){
			 var event = new Event(e);
			 var el = event.target;
			 found = false;
			
			var existingTable = this.tables.some(function(table, index){
			 return el.value > table;
			});

			if(existingTable){
				/* correct table now test for it in from join dd */
				var dds = $A(document.getElementsByTagName('SELECT'));
				
				var join_from_tabl_dds = dds.filter(function(dd, index){
				if(dd.name == 'join_from_table[]'){
					return dd;
				}
				});
				var opts = $A(join_from_tabl_dds[0]);
				var optExists = opts.some(function(opt, index){
				 	return (opt.value == el.value)
				});
				if(!optExists){
					join_from_tabl_dds.each( function (dd){
						var e = new Element('option', {'value':el.value}).appendText(el.value);
						e.injectTop(dd);
					});
				}
			}else{
				alert('no table exists with this name!');
			}
		},
		
		showSimpleJoinClick: function(e){
			var event = new Event(e);
			$(this.simpleJoinDiv).setStyle('display', 'block');
			$(this.advancedJoinDiv).setStyle('display', 'none');
			event.stop()
		},
		
		showAdvancedJoinClick: function(e){
			var event = new Event(e);
			$(this.simpleJoinDiv).setStyle('display', 'none');
			$(this.advancedJoinDiv).setStyle('display', 'block');
			event.stop()
		},
		
		buildJoins: function (){
         	<?php
			if( array_key_exists( 'joins', $lists ) ){
				 for ($i = 0; $i < count($lists['joins']); $i ++) {
					$j = $lists['joins'][$i];
					?>
					this.addJoin(<?php echo "'" . $j->group_id . "','" . $j->id . "','" . str_replace("\n", "", $j->join_type) . "','" . 
					str_replace("\n", "", $j->table_join) . "','" . $j->table_key . "','" . $j->table_join_key  . "','" . 
					str_replace("\n", "", $j->join_from_table) . "'"; ?>);												 
				<?php } 
				
			}?>  
		},
		
		addNewJoinClick: function (e){
			this.addJoin();
			var event = new Event(e);
			event.stop()
			return false;
		},
		    
		addJoin: function (groupId, joinId, joinTypeDd, joinTableDd, thisKey, joinKey, joinFromTable){
			var defaultJoinTypeDd = '<?php echo str_replace("\n", "", $lists['jointypes']);?>';
			var defaultTableDd = '<?php echo str_replace("\n", "", $lists['defaultJoinTables']);?>';
			var defaultJoinTableFrom = '<?php echo str_replace("\n", "", $lists['defaultJoinTableFrom']);?>';
			joinId = joinId ? joinId : '';
      thisKey = thisKey ? thisKey : '';
      joinKey = joinKey ? joinKey : '';
      joinTypeDd = joinTypeDd ? joinTypeDd : defaultJoinTypeDd;
      joinFromTable = joinFromTable ? joinFromTable : defaultJoinTableFrom;
      joinTableDd = joinTableDd ? joinTableDd : defaultTableDd;
      groupId = groupId ? groupId : '';
			
			var sContent = 
				'<table class="adminform" id="avJoinTbl_' + this.joinCounter + '">'
				+ '<tr>'
				+ '<td><?php echo JText::_('FBK_JOIN_TYPE'); ?>'
				+ '<input type="hidden" name="join_id[]" value="' + joinId + '" />' 
				+'</td>' 
				+'<td>'
				+ joinTypeDd 
				+'</td><tr>'
				+ '<tr>'
				+ '<td><?php echo JText::_('FBK_JOIN_FROM_TABLE'); ?>'
				+'</td>' 
				+'<td>'
				+ joinFromTable 
				+'</td><tr>'					
				+ '<tr>'
				+ '<td><?php echo JText::_('FBK_JOIN_TO_TABLE'); ?></td>' 
				+'<td>'
				+ joinTableDd 
				+'</td><tr>'					
				+ '<tr><td><?php echo JText::_( 'FBK_JOIN_THIS_TABLES_ID_COLUMN' ); ?></td>' 
				+'<td id="joinThisTableId">'
				+ '<input type="text" name="table_key[]" value="' + thisKey + '" class="inputbox" size="30" />'
				+' </td>'
				+'</tr>'
				+ '<tr><td><?php echo JText::_('FBK_JOIN_JOIN_TABLES_ID_COLUMN'); ?></td>' 
				+'	<td  id="joinJoinTableId">'
				+ '<input type="text" name="table_join_key[]" value="' + joinKey + '" class="inputbox" size="30" />'
				+' </td>'
				+'</tr>'					
				+'<tr>'
				+	'<td colspan="2"><a href="#" id="deletAvJoin_' + this.joinCounter + '"><?php echo JText::_('Delete'); ?></a></td>'
				+ '</tr>'					
				+'</table>';					          	

			var oNewBody = $('advancedJoinDiv');
			var oNew = document.createElement('div');
			oNew.innerHTML = sContent;
			
			oNewBody.appendChild(oNew.firstChild , oNewBody.childNodes[0]);
			$('deletAvJoin_' + this.joinCounter).addEvent( 'click', this.deleteJoin );
			this.joinCounter++;
		},
		
		deleteJoin: function( e ){
			var event = new Event(e);
			element = event.target;
			var id = element.id.replace('deletAvJoin_', '');
			var oNode = $('avJoinTbl_' + id);
       		oNode.parentNode.removeChild(oNode);
       		event.stop();
		}
	});
		
		var adElJoin = new elementJoin('<?php echo $pluginParams->get( 'joinType', 'simple' ) ;?>');
		adElJoin.buildJoins();
		<?php
		
		//this bit is not working due to oconn not being available
		$joinCnnId = $pluginParams->get( 'join_conn_id', '-1' );
		
		if ( is_array( $lists['connectionTables'] ) ) {
			if ( array_key_exists( $joinCnnId, $lists['connectionTables'] ) ) {
				foreach ($lists['connectionTables'][$joinCnnId] as $obj) {
					echo "adElJoin.addTable('" . $obj->value . "');";	
				}
			}
		}
		?>
						
		$('join_db_name').addEvent( 'change', function(e){
			var cid = $('paramsjoin_conn_id').getValue();
			var table = $('join_db_name').getValue();
			var url = '<?php echo COM_FABRIK_LIVESITE;?>index.php?option=com_fabrik&format=raw&task=elementPluginAjax&plugin=fabrikdatabasejoin&method=ajax_loadTableFields&element_id=' + <?php echo $this->_id;?> + '&cid=' + cid + '&table=' + table;
			var myAjax = new Ajax(url, { method:'post', 
				onComplete: function(r){
					eval( r );
				}}).request();
		});
		
		
		/* ]]>
*/
			</script></div>
			<?php 
}


/**
 * used to format the data when shown in the form's email
 * @param string data
 * @return string formatted value
 */

	function getEmailValue( $data )
	{
		$val = $this->renderTableData( $data, new stdClass() );
		return $val ;
	}


	 /**
	  * Get the table filter for the element
	  * @return string filter html
	  */
	 
	 function getFilter( )
	 {
	 	
		$params 			=& $this->getParams();
		$element 			=& $this->getElement();
		
		$tableModel 	=& $this->_table;
		$table 				=& $tableModel->getTable();
		$origTable 		= $table->db_table_name;
	 	$fabrikDb 		=& $tableModel->getDb();
		$js 					= "";
		
		//$elName 			= $this->getFullName( true, true, false );
		$elName 				= $this->getFilterFullName( true, true, false );
		$elName2 			= $this->getFullName( false, false, false );
		$ids 					= $tableModel->getColumnData( $elName2 );
		$elLabel			= $element->label;
		$elExactMatch 	= $element->filter_exact_match;
		$v 				= $elName . "[value]";
		$t 				= $elName . "[type]";
		$e 				= $elName . "[match]";
		$jt 			= $elName . "[join_db_name]";
		$jk 			= $elName . "[join_key_column]";
		$jv 			= $elName . "[join_val_column]";
		$origDate 		= $elName . "[filterVal]";
		$fullword 		= $elName . "[full_words_only]";
		$return			= '';
	
		$elName2 		= $this->getFilterFullName( false, true, false );
		$default 		= $this->getDefaultFilterVal( $origTable, $elName2, $tableModel->_aFilter );
		$aThisFilter = array();

	/*
	 * list of all tables that have been joined to -
	 * if duplicated then we need to join using a table alias
	 */
	if ( $params->get( 'joinType' ) == 'advanced' ) {
		$aAvJoins = $this->getAdvancedJoinsObjs( );
		$val 			= stripslashes( $params->get( 'advJoin_concat' ) );
		$table 		= $aAvJoins[0]->join_from_table;
		$key 			= $aAvJoins[0]->table_join_key;
			
		/*********** test ***/

		$val 		= stripslashes( $params->get( 'advJoin_concat' ) );
		$key 		= $params->get('advJoin_key', $table.'.'.$element->name );
		$joinTable	= $params->get('advJoin_startTable', $table);
		/******end *******/
		/**  testing to see if we can filter from an element not in the main table  */
			
		if ($joinTable != '') {
			$v = $joinTable . '___' . $element->name . "[value]";
			$t = $joinTable . '___' . $element->name . "[type]";
			$e = $joinTable . '___' . $element->name . "[match]";
			$fullword = $elName . "[full_words_only]";
		}
		/*
		 * end test
		 */

		$sql = "SELECT DISTINCT($key) AS elVal, CONCAT($val) AS elText \n FROM  $joinTable \n";
		//foreach ($aAvJoins as $oJoin) {
		//	$joinTableName = $tableModel->_loadJoinOnce( $oJoin );
		//}
		$whereKey = $key;
	} else {
		$joinTable 	= $params->get( 'join_db_name' );
		$joinKey	= $params->get( 'join_key_column' );
		$joinVal	= $params->get( 'join_val_column' );
		$sql = "SELECT DISTINCT( $joinTable.$joinVal ) AS elText, $joinTable.$joinKey AS elVal \n FROM $joinTable \n " ;
		$sql .= "WHERE $joinTable.$joinKey IN ('" . implode( "','", $ids ) . "')";
	}
	switch ($element->filter_type) {

		case "dropdown":
			$fabrikDb->setQuery( $sql );
			$oDistinctData = $fabrikDb->loadObjectList( );
			echo $fabrikDb->getErrorMsg( );
			$obj = new stdClass;
			$obj->elVal  = "";
			$obj->elText = JText::_( 'Please select' );
			$aThisFilter[] = $obj;
			if (is_array( $oDistinctData )) {
				$aThisFilter = array_merge( $aThisFilter, $oDistinctData );
			}
	
			$return = JHTML::_('select.genericlist', $aThisFilter , $v, 'class="inputbox fabrik_filter" size="1" ' , "elVal", 'elText', $default );
			break;

		case "field":
			$return = "<input type='text' class='inputbox fabrik_filter' name='$v' value='$default'   />";
			$return .= "\n<input type='hidden' name='$jt' value='" . $params->get( 'join_db_name' ) . "'/>";
			$return .= "\n<input type='hidden' name='$jk' value='" . $params->get( 'join_key_column' ) . "'/>";
			$return .= "\n<input type='hidden' name='$jv' value='" . $params->get( 'join_val_column' ) . "'/>";
			break;

		}
		$return .= "\n<input type='hidden' name='$t' value='$element->filter_type' />\n";
		$return .= "\n<input type='hidden' name='$e' value='$elExactMatch' />\n";
		$return .= "\n<input type='hidden' name='$fullword' value='" . $params->get('full_words_only', '0') . "' />\n";
		return $return;
	}
	
	/**
	 * used for the name of the filter fields
	 * Over written here as we need to get the label field for field searches
	 *
	 * @param bol $includeJoinString
	 * @param bol $useStep
	 * @param bol $incRepeatGroup
	 * @return string element filter name
	 */
	
	function getFilterFullName( $includeJoinString = true, $useStep = true, $incRepeatGroup = true )
	{
		$element =& $this->getElement();
		$params =& $this->getParams();
		$join_db_name = $params->get('join_db_name');
		foreach ($this->_table->_aJoins as $join) {
			if($join->element_id == $element->id){
				$join_db_name = $join->table_join_alias;
			}
		}
		if ($element->filter_type == 'field') {
			return  $join_db_name . '___' . $params->get('join_val_column') ;
		}else{
			return $this->getFullName( false, true, false );
		}
	}

	/**
 	 * get the default value for the table filter
 	 * @param string tablename
 	 * @param string element name
 	 * @param array exisiting table filter data
 	 */

	 function getDefaultFilterVal( $origTable, $elName,  $aFilter = null )
	 {
	 	$data = JRequest::get('request');
	 	$groupModel =& $this->_group;
	 	$group =& $groupModel->_group;
	 	$params =& $this->getParams();
	 	$element =& $this->getElement();
	 	
	 	if ($group->is_join) {
			if (array_key_exists( 'join', $data ) && array_key_exists( $group->join_id, $data['join'] )) {
	 			$data = $data['join'][$group->join_id];
			}
		}

	 	$default 		= "";
	 	if (array_key_exists( $elName, $data )) {
	 		if (is_array( $data[$elName] )) {
		 		$default = $data[$elName]['value'];
	 		}
	 	}
	 	if ($default == '') {
	 		if (isset( $aFilter )) {
		 		if (isset($aFilter[$elName] )) {
		 			if (is_array( $aFilter[$elName] )) {
			 			if (array_key_exists( 'filterVal', $aFilter[$elName] )) {
			 				$default = $aFilter[$elName]['filterVal'];
			 			} else {
			 				$default = $aFilter[$elName]['value'];
			 			}
		 			} else {
		 				print_r($aFilter[$elName]);	
		 			}
		 		} else {
		 			$k = $params->get('join_db_name'). "." . $params->get('join_val_column');
		 			if (@isset($aFilter[$key] )) {
		 				$default = $aFilter[$k]['filterVal'];;
		 			} else {
		 				$testKey = '';
		 				if ($params->get( 'joinType' ) == 'advanced') {
		 					$default = $this->getDefaultAdvancedFilterVal( $aFilter );
		 				}
		 			}
		 		}
	 		}
	 	}
	 	return $default;
	 }

	 /**
	  * Get the sql for filtering the table data and the array of filter settings
	  * @param array posted data for the element
	  * @param array filters
	  * @param string db col key name e.g. table.elname
	  * @param string form key name e.g. table___elname
	  * @return array filter
	  */

	function getFilterConditionSQL( $val, $aFilter, $dbKey, $key )
	{
	 	$cond ='';
	 	$element			=& $this->getElement();
	 	 
	 	/* if posted data comes from a module we want to strip out its table name
		 and replace it with current table name
		 not sure how to deal with this for joins ? */

	 	//TODO: this is a cadidate for caching
		$fromModule 			= JRequest::getBool( 'fabrik_frommodule', 0 );
	 	$params 					=& $this->getParams();
		$filterType 			= isset( $val['type']) ? $val['type'] : 'dropdown';
	 	$filterVal 				= isset( $val['value'] )? $val['value'] : '';
	 	$filterExactMatch = isset( $val['match'] )? $val['match'] : '';
	 	$fullWordsOnly 		= isset( $val['full_words_only'] )? $val['full_words_only'] : '1';
	 	$joinDbName 			= isset( $val['join_db_name']) ? $val['join_db_name'] : '';
	 	$joinKey 					= isset( $val['join_key_column']) ? $val['join_key_column'] : '';
	 	$joinVal 					= isset( $val['join_val_column']) ? $val['join_val_column'] : '';
	 	if ($filterVal == "" ) {
	 		return;
	 	}
		switch ($element->filter_type) {
			case 'dropdown':
				$filterVal = urldecode( $filterVal );
				if ($fromModule) {
					$aKeyParts = explode( '.', $key);
					$key = $this->db_table_name . '.' . $aKeyParts[1];
				}
				if (!is_array( $filterVal )) {
					if ( $filterExactMatch == '0' ){
						$cond = " $dbKey LIKE '%$filterVal%' ";
					} else {
						$cond = " $dbKey = '$filterVal' ";
					}
				} else {
					$cond = "( ";
					foreach ($filterVal as $fval) {
						if (trim( $fval ) != '') {
							if ( $filterExactMatch == '0' ){
								$cond .= " $dbKey LIKE '%$fval%' OR ";
							} else {
								if (trim( $fval ) == '_null_') {
									$cond .= " $dbKey IS NULL OR ";
								} else {
									$cond .= " $dbKey = '$fval' OR ";
								}
							}	
						}
					}
					$cond = substr( $cond, 0, strlen( $cond )-3 );
					$cond .= " ) ";	
				}
				
				if (array_key_exists( $key, $aFilter )) {
					$aFilter[$key][] = $aFilter[$key];
					$aFilter[$key][] = array('type'=>'dropdown', 'value'=>$filterVal , 'filterVal'=>$filterVal, 'sqlCond' =>$cond );
				} else {
					$aFilter[$key] = array('type'=>'dropdown', 'value'=>$filterVal , 'filterVal'=>$filterVal, 'sqlCond' =>$cond );
				}
				break;
			case "":
			case "field":
				//rob - its passed in correctly from the table model when viewing a form (think filter in url)	
				//$dbKey = $params->get( 'join_db_name' ) . '.' . $params->get( 'join_val_column' );
				//$dbKey = FabrikWorker::getDbSafeName( $dbKey );
				$filterVal = urldecode( $filterVal );
				$filterCondSQL = '';
				if ( $joinDbName != '' ) {
					$filterCondSQL .= " LEFT JOIN $joinDbName ON $joinDbName.$joinKey = $dbKey ";
				}
				/* full_words_only
				 all search for multiple fragments of text*/
				$aFilterVals = explode( "+", $filterVal );
				if( $fullWordsOnly == '1' ){
					$cond = " $dbKey REGEXP  \"[[:<:]]" . $filterVal . "[[:>:]]\"";
				} else {
					$cond = " $dbKey LIKE '%$filterVal%'";
				}
				$aFilter[$key] = array('type'=>'field',
				'value'=>$filterVal,
				'filterVal'=>$filterVal,
				'full_words_only'=>$fullWordsOnly,
				'join_db_name' => $joinDbName,
				'join_db_key' => $joinKey,
				'join_val_column' => $joinVal,
				'prewritten_join' => $filterCondSQL,
				'sqlCond' =>$cond
				);				
				break;
			case "search":
				if( $joinDbName != '' ){
					$filterCondSQL .= " LEFT JOIN $joinDbName ON $joinDbName.$joinKey = " . $this->db_table_name . "." . $this->db_primary_key . " ";
				}
				$filterVal = urldecode($filterVal);
				$cond2 = $key . " " . str_replace( '\"', '"', $filterVal );
				$cond = $cond2;
				$aFilter[$key] = array('type'=>'search', 
											   'value'=>$cond2, 
												'filterVal'=>$filterVal, 
												'full_words_only'=>$fullWordsOnly,
												'join_db_name' => $joinDbName,
												'join_db_key' => $joinKey
												, 'sqlCond' =>$cond 
												);	
				break;
				
			case "range":
				if ($filterVal[0] != '' & $filterVal[1] != '') {
					$cond = " $dbKey BETWEEN '" . $filterVal[0] . "' AND '" . $filterVal[1] . "'";
					$aFilter[$key] = array('type'=>'range', 
				   'value'=>$filterVal, 
					'filterVal'=>$filterVal, 
					'full_words_only'=>$fullWordsOnly,
					'join_db_name' => $joinDbName,
					'join_db_key' => $joinKey
					, 'sqlCond' =>$cond 
					);
				} else {
					return ;
				}	
				break;
		}
	 if ( array_key_exists( $key, $aFilter ) ) {
			return $aFilter[$key];
		} else {
			return '';
		}
	}
	
	/**
	 * Examples of where this would be overwritten include drop downs whos "please select" value might be "-1"
	 * @param string data posted from form to check
	 * @return bol if data is considered empty then returns true
	 */
	
	function dataConsideredEmpty( $data )
	{
		if ($data == '' || $data == '-1') {
			return true;
		}
		return false;
	}
	
	/**
	 * formats the posted data for insertion into the database
	 * @param mixed thie elements posted form data
	 * @param array posted form data
	 */
	
	function storeDatabaseFormat( $val, $data )
	{
		return $val;
	}
	
	function formJavascriptClass()
	{
		FabrikHelperHTML::script( 'javascript.js', 'components/com_fabrik/plugins/element/fabrikdatabasejoin/', true );
	}
	
	function elementJavascript( )
	{
		$params =& $this->getParams();
		$element =& $this->getElement();
		$opts = $this->_getOptionVals();
		$data = new StdClass();
		foreach ($opts as $k=>$v) {
			$data->{$v->value} = $v->text;
		}
		$id = $this->getHTMLId();
		$arSelected = $element->default;
		$arVals = explode( "|", $element->sub_values );
		$arTxt 	= explode( "|", $element->sub_labels );
		if (is_string( $arSelected )) {
			$arSelected = array($arSelected);
		}

		$table 	= $params->get( 'join_db_name' );
		
		
		$opts =& $this->getElementJSOptions();
		$opts->liveSite = JURI::root();
		$opts->id 		= $this->_id;
		$opts->key 		= $table . "___" . $params->get( 'join_key_column' );
		$opts->label 	= $table . "___" . $params->get( 'join_val_column' );
		$opts->formid = $this->_formId;
		$opts->defaultVal = $arSelected;//$default;
		$opts->popupform = $params->get( 'fabrikdatabasejoin_popupform' );
		$opts->data 			= $data;
		$opts = FastJSON::encode($opts);
		return "new fbDatabasejoin('$id', $opts)" ;
	}

	/**
	 * gets the options for the drop down - used in package when forms update
	 *
	 */
	
	function ajax_getOptions()
	{
		//needed for ajax update
		$formModel =& JModel::getInstance( 'Form', 'FabrikModel' );
		$formModel->setid( $this->_formId );
		$form =& $formModel->getForm();
		$formModel->getTableModel();
		$this->_form =& $formModel;
		//end
		echo FastJSON::encode( $this->_getOptions( ) );
	}
	
	/**
	 * called when the element is saved
	 */
	
	function onSave()
	{
		$params	= JRequest::getVar( 'params', array(), 'post', 'array');
		$details	= JRequest::getVar( 'details', array(), 'post', 'array');
		$element =& $this->getElement();
		//load join based on this element id
		$join =& JTable::getInstance( 'Join', 'Table' );
		$origKey = $join->_tbl_key;
		$join->_tbl_key = "element_id";
		$join->load( $this->_id );
		$join->_tbl_key = $origKey;
		$join->table_join = $params['join_db_name'];
		$join->join_type = 'left';
		$join->group_id = $details['group_id'];
		$join->table_key = $element->name;
		//$join->table_key = $params['join_val_column'];
		$join->table_join_key = $params['join_key_column'];
		$join->join_from_table = '';
		$join->attribs = "join-label=" . $params['join_val_column'] . "\n";
		$join->store();
	}

	/**
	 * called before the element is saved
	 *
	 */
	
	function beforeSave()
	{
		$element =& $this->getElement();
		$maskbits = 4;
		$post	= JRequest::get( 'post', $maskbits );
		if ($post['details']['plugin'] != 'fabrikdatabasejoin') {
			$db =& JFactory::getDBO();
			$db->setQuery("DELETE FROM #__fabrik_joins WHERE element_id =" . $post['id']);
			$db->query();
		}
	}
}
?>