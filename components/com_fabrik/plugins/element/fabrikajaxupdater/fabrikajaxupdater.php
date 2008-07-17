<?php
/**
* @package Joomla
* @subpackage Fabrik
* @copyright Copyright (C) 2005 Rob Clayburn. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();


class FabrikModelFabrikajaxupdater  extends FabrikModelElement {

	var $_pluginName = 'ajaxupdater';
	
	/**
	* Constructor
	*/

	function __construct()
	{
		parent::__construct();
	}

		/**
	 * shows the data formatted for the table view
	 * @param string data
	 * @param object all the data in the tables current row
	 * @return string formatted value
	 */

	function renderTableData( $data, $oAllRowsData ){
		$data = explode("|", trim($data, "|"));
		$connectionModel = JModel::getInstance('Connection', 'FabrikModel');
		$connectionModel->setId( $params->get('cascading_join_conn_id', -1) );
		$connection = $connectionModel->getConnection();
		$thisDb = new database( $connection->host, $connection->user, $connection->password, $connection->database, "" );
		
		$value1 = $params->get('cascading_dropdown1_value', '');
		$label1 = $params->get('cascading_dropdown1_label', '');
		$table1 = $params->get('cascading_tables1', '');
		
		$sql = "SELECT `$label1` FROM $table1 WHERE `$value1` = '" . $data[0] . "'";
		$thisDb->setQuery($sql);
		$strData = $thisDb->loadResult() ;
		return parent::renderTableData( $strData, $oAllRowsData );
	}

	/**
	 * determines if the element can contain data used in sending receipts, e.g. fabrikfield returns true
	 */

	function isReceiptElement(){
		return true;
	}
	
	/**
	 * formats the posted data for insertion into the database
	 * @param mixed thie elements posted form data
	 * @param array posted form data
	 * @param string array's key
	 */

	function storeDatabaseFormat($val, $data, $key)
	{
		return $val;
	}

	/**
	 * draws the form element
	 * @param int repeat group counter
	 * @return string returns element html
	 */
		
	function render( $data, $repeatCounter = 0 ) {
		$elementHTMLName = $this->getHTMLName();
		$db =& JFactory::getDBO();;
		$childValue = '';
		$parentValue = '';
		if(array_key_exists($elementHTMLName, $data)){
			$value = trim($data[$elementHTMLName], '|');
			$aVals = explode('|', $value);
			$parentValue = $aVals[0];
			if(count($aVals) >= 2){
				$childValue = $aVals[1];
			}
		}
		
		$params 	= $this->getParams();
		$oConn = new fabrikConnection($db);
		$oConn->load($params->get('cascading_join_conn_id', -1));
		$thisDb = new database( $oConn->host, $oConn->user, $oConn->password, $oConn->database, "" );
		
		$value1 = $params->get('cascading_dropdown1_value', '');
		$label1 = $params->get('cascading_dropdown1_label', '');
		$table1 = $params->get('cascading_tables1', '');
		$sql = "SELECT $value1 AS value, $label1 AS text FROM $table1";
		$thisDb->setQuery($sql);
		$res = $thisDb->loadObjectList();

		$value2 = $params->get('cascading_dropdown2_value', '');
		$label2 = $params->get('cascading_dropdown2_label', '');
		$table2 = $params->get('cascading_tables2', '');
		$cascading_connector = $params->get('cascading_connector', '');
		$sql = "SELECT $value2 AS value, $label2 AS text FROM $table2";
		if($childValue != ''){
			$sql .= " WHERE `$cascading_connector` = '$childValue'";
		}
		$thisDb->setQuery($sql);
		$res2 = $thisDb->loadObjectList();

		$elementHTMLName = str_replace( '.', '___', $elementHTMLName);

		$className = 'inputbox';
		if( isset($this->_elementError) && $this->_elementError != '' ){
			$className .= " elementErrorHighlight";
		}

		$parentDd = JHTML::_('select.genericlist', $res, $elementHTMLName, 'class="' . $className . '" size="1" id="' . $this->getHTMLId()  . '" ', 'value', 'text', $parentValue );
		//$parentDd .= JHTML::_('select.genericlist',  $res2, $elementHTMLName. '_child" ', 'class="' . $className . '" size="1" id="' . $elementHTMLId  . '_child" ', 'value', 'text', $childValue );
		return ($parentDd);
	}

	/**
	 * return the javascript to create an instance of the class defined in formJavascriptClass
	 * @param object element
	 * @return string javascript to create instance. Instance name must be 'el'
	 */

	function elementJavascript(){
		$this->getParams();
		$cascading_join_conn_id 	= $params->get('cascading_join_conn_id', '');
		$cascading_tables1 			= $params->get('cascading_tables1', '');
		$cascading_dropdown1_value 	= $params->get('cascading_dropdown1_value', '');
		$cascading_connector 		= $params->get('cascading_connector', '');
		$cascading_dropdown1_label 	= $params->get('cascading_dropdown1_label', '');
		$cascading_tables2 			= $params->get('cascading_tables2', '');
		$cascading_dropdown2_value 	= $params->get('cascading_dropdown2_value', '');
		$cascading_dropdown2_label 	= $params->get('cascading_dropdown2_label', '');
		$id = $this->getHTMLId();
		$opts =& $this->getElementJSOptions();
		$opts = FastJSON::encode($opts);
		//return "if($('$id')){\n" .
		//"var el = new fbAjaxUpdater('$id', $opts);\n" .
		//"el.setElementId('$this->id');
		//}\n";
		return "new fbAjaxUpdater('$id', $opts)";
	}

	/**
	 * load the javascript class that manages interaction with the form element
	 * should only be called once
	 * @return string javascript class file
	 */

	function formJavascriptClass()
	{
		$params = $this->getParams();
		return "<script type='text/javascript'>
		fbAjaxUpdater = Class.create();
	fbAjaxUpdater.prototype = Object.extend(new fbElement(), {
		initialize: function(element, options) {
			this.setOptions(element, options);
			$(element).addEvent( 'change', function(e){
				var id = \$F(Event.element(e));
				new Ajax.Request( 'index2.php', {
				parameters :{
					'option':'com_fabrik',
					'format':'raw',
					'task':'elementPluginAjax',
					'plugin':'fabrikAjaxUpdater',
					'method':'do_ajax',
					'id':id,
					'element_id':this.elementId
				},
				onFailure:function(t){
					alert('failed');
				}
				,
				onSuccess:"
				. str_replace("<br />", "\n", $params->get('ajax_javascriptcode', 'function(t){}')) .
				"
			});			
		}.bind(this));
	},
	setElementId: function(i){
		this.elementId = i;
	}
});
</script>";
		
	}

	/**
	 * front end ajax call to update child drop down
	 */

	function do_ajax(){
		$params = $this->getParams();
		$code =  str_replace("<br />", "\n", $params->get('ajax_phpcode', ''));
		eval( $code );
	}

	/**
	 * defines the type of database table field that is created to store the element's data
	 */
	function getFieldDescription(){
		return "VARCHAR (255)";
	}

	/**
	 * OPTIONAL FUNCTION
	 * code to create lists that are later used in the renderAdminSettings function
	 * @param array list of default values
	 * @param object element to apply lists to
	 */

	function getAdminLists( &$lists )
	{
		$connectionModel 			=& JModel::getInstance('Connection', 'FabrikModel');
		$connectionId 	= $params->get('cascading_join_conn_id', -1);
		$connectionModel->setId($connectionId);
		$connection =& $connectionModel->getConnection();
		$realCnns 	= $connectionModel->getConnections( );
		$lists['connectionTables'] = $connectionModel->getConnectionTables( $realCnns );
		$tableNames = $lists['connectionTables'][$connectionId];
		$lists['connections'] = $oConn->getConnectionsDd( $realCnns, '', 'params[cascading_join_conn_id]', $connectionId, 'params[cascading_join_conn_id]' );

		$tableModel =& JModel::getInstance('Table', 'FabrikModel');


		if ( $params->get('join_db_name', '') == "" ) {
			$tableNames[] = JHTML::_('select.option', '-1', JText::_('Please select a connection') );
		}
		$table1 = $params->get('cascading_tables1', '');
		$table2 = $params->get('cascading_tables2', '');

		if($table1 != ''){
			$lists['first_table'] = JHTML::_('select.genericlist',  $tableNames, 'params[cascading_tables1]', 'id="params[cascading_tables1]" class="inputbox" size="1" ', 'value', 'text', $table1);
		}else{
			$lists['first_table']= '';
		}
		if($table2 != ''){
			$lists['second_table'] = JHTML::_('select.genericlist',  $tableNames, 'params[cascading_tables2]', 'id="params[cascading_tables2]" class="inputbox" size="1" ', 'value', 'text', $table2);
		}else{
			$lists['second_table']= '';
		}
		
		$lists['connector']= '';
		$lists['first_value']= '';
		$lists['first_label']= '';
		$lists['second_value']= '';
		$lists['second_label']= '';
		
		if($connectionId != -1){
			$joinDb = $connectionModel->getDb();
			$sql = "DESCRIBE $table1";
			$joinDb->setQuery( $sql );
			$aRes = $joinDb->loadObjectList( );
			$fieldOptions = array();
			foreach( $aRes as $oRes ){
				$fieldOptions[] = JHTML::_('select.option', $oRes->Field, $oRes->Field );
			}
			if($params->get('cascading_dropdown1_value', '') != ''){
				$lists['first_value'] =  JHTML::_('select.genericlist',  $fieldOptions, 'params[cascading_dropdown1_value]', 'class="inputbox" id="params[cascading_dropdown1_value]" ', 'value', 'text', $params->get('cascading_dropdown1_value', '') );
			}
			if($params->get('cascading_dropdown1_label', '') != ''){
			 	$lists['first_label'] =  JHTML::_('select.genericlist',  $fieldOptions, 'params[cascading_dropdown1_label]', 'class="inputbox" id="params[cascading_dropdown1_label]" ', 'value', 'text', $params->get('cascading_dropdown1_label', '') );
			}
			
			$sql = "DESCRIBE $table2	";
			$joinDb->setQuery( $sql );
			$aRes = $joinDb->loadObjectList( );
			$fieldOptions = array();
			foreach( $aRes as $oRes ){
				$fieldOptions[] = JHTML::_('select.option', $oRes->Field, $oRes->Field );
			}
			
			if($params->get('cascading_dropdown1_value', '') != ''){
			 	$lists['second_value'] =  JHTML::_('select.genericlist',  $fieldOptions, 'params[cascading_dropdown2_value]', 'class="inputbox" id="params[cascading_dropdown2_value]" ', 'value', 'text', $params->get('cascading_dropdown2_value', '') );
			}
			if($params->get('cascading_dropdown1_label', '') != ''){
			 	$lists['second_label'] =  JHTML::_('select.genericlist',  $fieldOptions, 'params[cascading_dropdown2_label]', 'class="inputbox" id="params[cascading_dropdown2_label]" ', 'value', 'text', $params->get('cascading_dropdown2_label', '') );
			}
			if($params->get('cascading_connector', '') != ''){
			 	$lists['connector'] =  JHTML::_('select.genericlist',  $fieldOptions, 'params[cascading_connector]', 'class="inputbox" id="params[cascading_connector]" ', 'value', 'text', $params->get('cascading_connector', '') );
			}
		}
	}
	
	function ajax_loadTables( ){
		$db =& JFactory::getDBO();
		$cnnId = JRequest::getInt( 'cid', 1 );
		$oConn = new fabrikConnection( $db );
		$oConn->load( $cnnId );
		$dd =  $oConn->getTableDdForThisConnection( '', 'params[cascading_tables1]');
		$dd = str_replace(array("\n", "\r", "\n\r"), '', $dd);
		echo "$('cascading_dropdown_table1').innerHTML = '$dd';";
		$dd =  $oConn->getTableDdForThisConnection( '', 'params[cascading_tables2]');
		$dd = str_replace(array("\n", "\r", "\n\r"), '', $dd);
		echo "$('cascading_dropdown_table2').innerHTML = '$dd';";
		echo "cascade.watchTable1();";
		echo "cascade.watchTable2();";
	}

	function ajax_loadTableFields( ){
		$cnnId 		= JRequest::getInt( 'cid', 1 );
		$tbl 		= JRequest::getVar( 'table' );
		$target0 	= JRequest::getVar( 'target0' );
		$target1 	= JRequest::getVar( 'target1' );
		$child 		= JRequest::getBool( 'child', 0 );
		$tableModel =& JModel::getInstance('Table', 'FabrikModel');
		$fieldDropDown 		= $tableModel->getFieldsDropDown( $cnnId, $tbl, '-', false, 'params[' .$target0 . ']' );
		$fieldDropDown = str_replace(array("\n", "\r", "\n\r"), '', $fieldDropDown);
		echo "$('$target0').innerHTML = '$fieldDropDown';";
		$fieldDropDown 		= $tableModel->getFieldsDropDown( $cnnId, $tbl, '-', false, 'params[' .$target1 . ']' );
		$fieldDropDown = str_replace(array("\n", "\r", "\n\r"), '', $fieldDropDown);
		echo "$('$target1').innerHTML = '$fieldDropDown';";
		if($child){
			$fieldDropDown 		= $tableModel->getFieldsDropDown( $cnnId, $tbl, '-', false, 'params[cascading_connector]' );
			$fieldDropDown = str_replace(array("\n", "\r", "\n\r"), '', $fieldDropDown);
			echo "$('cascading_connector').innerHTML = '$fieldDropDown';";
		}
	}

	/**
	 * render the element admin settings
	 * @param object array lists
	 */
	function renderAdminSettings( $lists )
	{
		$params =& $this->getParams();
		$pluginParams =& $this->getPluginParams();
		$this->loadLanguage( $this->_name );
		$lists = $this->getAdminLists( $lists );?>

	<div id="page-<?php echo $this->_name;?>" class="elementSettings" style="display:none">
	<table class="admintable">
		<tr>
			<th colspan="2"><?php echo JText::_('this drop down');?></th>
		</tr>
			<tr>
			<td><?php echo JText::_('Connection');?></td>
			<td><?php echo $lists['connections'];?></td>
		</tr>
		<tr>
			<td><label for=""> <?php JText::_( 'Table' ); ?> </label></td>
			<td id="cascading_dropdown_table1"><?php echo $lists['first_table'];?></td>
		</tr>
		<tr>
			<td><label for=""> <?php echo JText::_( 'Value' ); ?> </label></td>
			<td><span id="cascading_dropdown1_value"><?php echo $lists['first_value'];?></span>
			</td>
		</tr>
		<tr>
			<td><label for=""> <?php echo JText::_( 'Label' ); ?> </label></td>
			<td id="cascading_dropdown1_label"><?php echo $lists['first_label'];?></td>
		</tr>
		<tr>
			<th colspan="2"><?php echo JText::_( 'Code' );?></th>
		</tr>
</table>
<?php 
		echo $pluginParams->render();
		?> 
</div>
<script language="javascript" type="text/javascript">
	
cascade = Class.create();

cascade.prototype = {
		initialize: function() {
		
			$('params[cascading_join_conn_id]').addEvent( 'change', function(e){
					var cid = $F($('params[cascading_join_conn_id]'));
					var table = $F(Event.findElement(e, 'select'));
					new Ajax.Request('index2.php?option=com_fabrik&format=raw&task=elementPluginAjax&plugin=fabrikAjaxUpdater&method=ajax_loadTables&cid=' + cid , {
							onSuccess: function(transport) {
								eval(transport.responseText);
							}
					});				
				});
				
		},
		
		watchTable1: function(){
			$('params[cascading_tables1]').addEvent( 'change', function(e){
					var cid = $F($('params[cascading_join_conn_id]'));
					var table = $F(Event.findElement(e, 'select'));
					new Ajax.Request('index2.php?option=com_fabrik&format=raw&task=elementPluginAjax&plugin=fabrikAjaxUpdater&method=ajax_loadTableFields&cid=' + cid + '&table=' + table + '&target0=cascading_dropdown1_value&target1=cascading_dropdown1_label', {
							onSuccess: function(transport) {
								eval(transport.responseText);
							}
					});				
				});
		},
		
		watchTable2: function(){
			Event.observe('params[cascading_tables2]', 'change', function(e){
					var cid = $F($('params[cascading_join_conn_id]'));
					var table = $F(Event.findElement(e, 'select'));
					new Ajax.Request('index2.php?option=com_fabrik&format=raw&task=elementPluginAjax&plugin=fabrikAjaxUpdater&method=ajax_loadTableFields&cid=' + cid + '&table=' + table + '&target0=cascading_dropdown2_value&target1=cascading_dropdown2_label&child=1', {
							onSuccess: function(transport) {
								eval(transport.responseText);
							}
					});				
				});
		}		
}
	
cascade = new cascade();			
		
	</script>
		<?php
}

/**
 * can be overwritten by plugin class
 * Get the table filter for the element
 * @return string filter html
 */

function getFilter( ){
	$params = $this->getParams();
	$element 			=& $this->getElement();
	$tableModel =& $this->_table;
	$table =& $tableModel->getTable();
	$origTable 		= $table->db_table_name;
	$fabrikDb 		= $tableModel->getDb();
	$js 			= "";
	$elName 		= $element->name;
	$elLabel		= $element->label;
	$elExactMatch 	= $element->filter_exact_match;
	$v 				= $elName . "[value]";
	$v2 			= $elName . "[value2]";
	$t 				= $elName . "[type]";
	$e 				= $elName . "[match]";
	$jt 			= $elName . "[join_db_name]";
	$jk 			= $elName . "[join_key_column]";
	$jv 			= $elName . "[join_val_column]";
	$origDate 		= $elName . "[filterVal]";
	$fullword 		= $elName . "[full_words_only]";
	$default = $this->getDefaultFilterVal( $origTable, $elName );
	if( !strstr( $elName, '.' ) ){
		$elName = $origTable.'.'.$elName;
	}

	$aThisFilter = array();

	//filter the drop downs lists if the table_view_own_details option is on
	//other wise the lists contain data the user should not be able to see
	$where2 = $tableModel->_buildQueryWhere();

	$where = "\n WHERE TRIM($elName) <> '' $where2 GROUP BY elText ASC";

	/* check if the elements group id is on of the table join groups if it is then we swap over the table name*/
	$fromTable = $origTable;
	$joinStr = '';
	foreach( $tableModel->_aJoins as $aJoin){
		/** not sure why the group id key wasnt found - but put here to remove error **/
		if(array_key_exists('group_id', $aJoin)){

			if ($aJoin->group_id == $element->group_id && $aJoin->element_id == 0) {
				$fromTable = $aJoin->table_join;
				$joinStr = " LEFT JOIN $fromTable ON " . $aJoin->table_join . "." . $aJoin->table_join_key . " = " . $aJoin->join_from_table . "." . $aJoin->table_key;
				$elName = str_replace( $origTable . '.', $fromTable . '.', $elName);
				$where = "\n WHERE TRIM($elName) <> '' $where2 GROUP BY elText ASC";
				$v = $fromTable . '___' . $this->name . "[value]";
				$t = $fromTable . '___' . $this->name . "[type]";
				$e = $fromTable . '___' . $this->name . "[match]";
				$fullword = $elName . "[full_words_only]";
			}
		}
	}
	/* elname should be in format table.key */
	$sql = "SELECT DISTINCT( $elName ) AS elText, $elName AS elVal FROM $origTable $joinStr\n";

	if( !strstr( $elName, '.' ) ){
		$elName = $table.'.'.$elName;
	}
	$sql .= $where;

	switch ( $this->filter_type ){
		case "dropdown":
			
			$value1 = $params->get('cascading_dropdown1_value', '');
			$label1 = $params->get('cascading_dropdown1_label', '');
			$table1 = $params->get('cascading_tables1', '');
	
			$sql = "SELECT DISTINCT($label1) AS elText, $value1 AS elVal FROM $table1 $joinStr";
			$fabrikDb->setQuery( $sql );
			$oDistinctData = $fabrikDb->loadObjectList( );
			echo $fabrikDb->getErrorMsg( );
			$obj = new stdClass;
			$obj->elVal  = "";
			$obj->elText = _PLEASE_SELECT;
			$aThisFilter[] = $obj;
			if(is_array($oDistinctData)){
				$aThisFilter = array_merge( $aThisFilter, $oDistinctData );
			}
			$return 	 = JHTML::_('select.genericlist', $aThisFilter , $v , 'class="inputbox fabrik_filter" size="1" ' , "elVal", 'elText', $default);
			break;

		case "field":
			$return = "<input type='field' class='inputbox fabrik_filter'' name='$v' value='$default'  />";
			break;
	}
	$return .= "\n<input type='hidden' name='$t' value='$this->filter_type' />\n";
	$return .= "\n<input type='hidden' name='$e' value='$elExactMatch' />\n";
	$return .= "\n<input type='hidden' name='$fullword' value='" . $params->get('full_words_only', '0') . "' />\n";
	return $return;
}

/**
 * can be overwritten by plugin class
 * Get the sql for filtering the table data and the array of filter settings
 * @param array posted data for the element
 * @param array filters
 * @return array (string filter sql, array filters)
 */

function getFilterConditionSQL($val, $aFilter, $key){
	$cond ='';
	$key = FabrikWorker::getDbSafeName( $key );
	/* if posted data comes from a module we want to strip out its table name
	 and replace it with current table name
	 not sure how to deal with this for joins ? */
	$fromModule 		 = JRequest::getBool( 'fabrik_frommodule', 0 );
	 
	isset( $val['type']) ? $filterType = $val['type'] : $filterType='dropdown';
	isset( $val['value'] )? $filterVal = $val['value'] : $filterVal = '';
	isset( $val['value2'] )? $filterVal2 = $val['value2'] : $filterVal2 = '';
	isset( $val['match'] )? $filterExactMatch = $val['match'] : $filterExactMatch = '';
	isset( $val['full_words_only'] )? $fullWordsOnly = $val['full_words_only'] : $fullWordsOnly = '1';
	isset( $val['join_db_name']) ? $joinDbName = $val['join_db_name'] : $joinDbName ='';
	isset( $val['join_key_column']) ? $joinKey = $val['join_key_column'] : $joinKey ='';
	isset( $val['join_val_column']) ? $joinVal = $val['join_val_column'] : $joinVal ='';
	$filterVal = urldecode($filterVal);
	
	if($filterVal != "" ){

		switch( $filterType ){
			case 'dropdown';
			if( $fromModule ){
				$aKeyParts = explode( '.', $key);
				$key = $this->db_table_name . '.' . $aKeyParts[1];
			}
				
			if(!is_array($filterVal)){
				if ( $filterExactMatch == '0' ){
					$cond = " ($key LIKE '|%$filterVal%|' AND $key LIKE '|%$filterVal2%|') ";
				} else {
					$cond = " ($key = '|$filterVal|' AND $key = '|$filterVal2|') ";
				}
			}else{
				$cond = "( ";
				foreach($filterVal as $fval){
					if(trim($fval) != ''){
						if ( $filterExactMatch == '0' ){
							$cond .= " $key LIKE '%$fval%' OR ";
						} else {
							if(trim( $fval ) == '_null_'){
								$cond .= " $key IS NULL OR ";
							} else {
								$cond .= " $key = '$fval' OR ";
							}
						}
					}
				}
				$cond = substr($cond, 0, strlen($cond)-3);
				$cond .= " ) ";
			}
				
			if(array_key_exists($key, $aFilter)){
				$aFilter[$key][] = $aFilter[$key];
				$aFilter[$key][] = array('type'=>'dropdown', 'value'=>$filterVal , 'filterVal'=>$filterVal, 'sqlCond' =>$cond );
			}else{
				$aFilter[$key] = array('type'=>'dropdown', 'value'=>$filterVal , 'filterVal'=>$filterVal, 'sqlCond' =>$cond );
			}
			break;
			case "":
			case "field":
					
					if( $joinDbName != '' ){
						if( strstr( $key, '.' ) ){
							$filterCondSQL .= " LEFT JOIN $joinDbName ON $joinDbName.$joinKey = " . $key . " ";
						} else {
							$filterCondSQL .= " LEFT JOIN $joinDbName ON $joinDbName.$joinKey = " . $this->db_table_name . "." . $key . " ";
						}
						$key = $joinDbName . "." . $joinVal;
					}else{
						
					}
					/* full_words_only 
					all search for multiple fragments of text*/
					$aFilterVals = explode("+", $filterVal); 
					if( $fullWordsOnly == '1'){
						$cond = " $key REGEXP \"[[:<:]]" . $filterVal . "[[:>:]]\"";
					} else {
						$cond = " $key LIKE '%";
						foreach( $aFilterVals as $filt ){
							$cond .="$filt%";
						} 
						$cond .="'";
					}
					$aFilter[$key] = array('type'=>'field', 
												   'value'=>$cond, 
													'filterVal'=>$filterVal, 
													'full_words_only'=>$fullWordsOnly,
													'join_db_name' => $joinDbName,
													'join_db_key' => $joinKey,
													'join_val_column' => $joinVal,
													'prewritten_join' => $filterCondSQL,
													'sqlCond' =>$cond 
													);				
					/*
					 * above was   but changed to $joinVal to test? did work -
					 * put back to $joinKey
					 */

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
			}
	 	}
		return $aFilter[$key];
	}
}	
?>