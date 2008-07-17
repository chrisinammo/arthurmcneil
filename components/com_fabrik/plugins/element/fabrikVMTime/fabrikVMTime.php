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


class FabrikModelFabrikVMTime  extends FabrikModelElement {

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
		$str = '';
		if (strstr( $data, $this->_groupSplitter )) {
			$data = explode($this->_groupSplitter, $data);
			foreach($data as $d){
				$str .= $this->_renderTableData( $d, $oAllRowsData );			
			}
		}else{
			$str .= $this->_renderTableData( $data, $oAllRowsData );
		}
		return $str;
	}

	function _renderTableData( $data, $oAllRowsData )
	{
		return date('D d M Y', $data);
	}
	
	/**
	 * determines if the element can contain data used in sending receipts, e.g. fabrikfield returns true
	 */
	
	function isReceiptElement(){
		return true;
	}
	
		/**
	 * draws the form element
	 * @param int repeat group counter
	 * @return string returns element html
	 */
		
	function render( $data, $repeatCounter = 0 ) {
		$elementHTMLName = $this->getHTMLId();
		$groupModel = $this->_group;
		$params 	= $this->getParams();
		$element = $this->getElement();
		$size 		= $element->width;
		$maxlength  = $params->get('maxlength');
		if ($maxlength == "0" or $maxlength == "") {
			$maxlength = $size;
		}
	
		$value = $this->default;
		if ( $params->get('password') == "1" ) {
			$type = "password";
		} else {
			$type = "text";
		}
		if( isset($this->_elementError) && $this->_elementError != '' ){
			$type .= " elementErrorHighlight";
		}
		if ( $element->hidden == '1' ) {
			$type = "hidden";
		}
		$sizeInfo =  " size=\"$size\" maxlength=\"$maxlength\"";
		$value =  date('Y-m-d', $value);
		if( !$this->_editable ){
			if( $element->hidden == '1' ) {
				return "<!--" . stripslashes($value) . "-->";
			} else {
				return stripslashes($value);
			}
		}
		$elementHTMLName = str_replace( '.', '___', $elementHTMLName);
		
		/* no need to eval here as its done before hand i think ! */
		if ( $this->eval == "1" and !isset ( $data[$elementHTMLName] ) ) {
			$str = "<input class=\"fabrikinput inputbox $type\" type=\"$type\" name=\"$elementHTMLName\" id=\"$this->_elementHTMLId\" $sizeInfo value=\"$value\" />\n";
		} else {
			$value = stripslashes($value);
			$str = "<input class=\"fabrikinput inputbox $type\" type=\"$type\" name=\"$elementHTMLName\" $sizeInfo id=\"$this->_elementHTMLId\" value=\"$value\" />\n";
		}
		return $str;
	}
	
	/**
	 * return tehe javascript to create an instance of the class defined in formJavascriptClass
	 * @param object element
	 * @return string javascript to create instance. Instance name must be 'el'
	 */
	
	function elementJavascript(){
		$id = $this->getHTMLId();
		$opts =& $this->getElementJSOptions();
		$opts = FastJSON::encode($opts);
		return "new fbField('$id', $opts)";
	}
	
		/**
	 * load the javascript class that manages interaction with the form element
	 * should only be called once
	 * @return string javascript class file
	 */
	
	function formJavascriptClass()
	{
		FabrikHelperHTML::script( 'javascript.js', 'components/com_fabrik/plugins/element/fabrikVMTime/', false );
	}
	
	/**
	 * defines the type of database table field that is created to store the element's data
	 */
	function getFieldDescription(){
		$p = $this->getParams();
		if ($p->get('text_format') == 'text') {
			$objtype = "VARCHAR (255)";
		} else {
			$objtype = "int(10)";
		}
		return $objtype;
	}
	
	/**
	 * render the element admin settings
	 */

	function renderAdminSettings( )
	{
		$params =& $this->getParams();
		$hiddenChk = ($this->hidden == '1') ? ' checked="checked"' : '';
		$evalChk = ($this->eval == '1') ? ' checked="checked"' : '';
		$pluginParams =& $this->getPluginParams();
		?>
		<div id="page-<?php echo $this->_name;?>" class="elementSettings" style="display:none">
		<table class="admintable"> 
			<?php
			FabrikHelperAdminHTML::widthField( $this );
			?>
			<tr> 
				<td><?php echo JText::_( 'Default' );?></td>
				<td>
					<textarea  onblur="setAll(this.value, 'default');" rows="8" cols="50" name="default" class="inputbox"><?php echo $this->default; ?></textarea>
				</td>
			</tr> 
			<tr> 
				<td>
					<label for="hidden">
						<?php echo JText::_( 'Hidden' ); ?>
					</label>
				</td>
				<td><input  onchange="setAllCheckBoxes('hidden', this.checked);"  type="checkbox" name="hidden" id="hidden" value="1" <?php echo $hiddenChk; ?> /></td>
			</tr> 
			<tr> 
				<td>
					<label for="eval">
						<?php echo JText::_( 'Eval' ); ?>
					</label>
				</td>
				<td><input type="checkbox" onclick="setAllCheckBoxes('eval', this.checked)" name="eval" id="eval" value="1" <?php echo $evalChk; ?> /></td>
			</tr>
		</table>
		<?php echo $pluginParams->render('params');?>
	</div><?php
	}
	
	 /**
	  * can be overwritten by plugin class
	  * Get the table filter for the element
	  * @param string origional table name
	  * @param object table
	  * @param object database
	  * @param object group
	  * @return string filter html
	  */
	 
	function getFilter( &$oTable, &$oGroup )
	{
	 	$origTable 		= $oTable->db_table_name;
	 	$fabrikDb 		= $oTable->_oConnDB;
	 	$element =& $this->getElement();
	 	$params =& $this->getParams();
		$js 			= ""; 
		$elName 		= rtrim($this->getFullName( true, true), "[]");
		$dbElName		= rtrim($this->getFullName( true, false), "[]");
		
		$elLabel		= $element->label;
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
		$default = $this->getDefaultFilterVal( $origTable, $elName, $oTable->_aFilter);
		
		$aThisFilter = array();
	
		//filter the drop downs lists if the table_view_own_details option is on
		//other wise the lists contain data the user should not be able to see
		// note, this should now use the prefilter data to filter the list

		
		$where2 = $oTable->_buildQueryWhere();
		
		$where = "\n WHERE TRIM($dbElName) <> '' $where2 GROUP BY elText ASC";

		/* check if the elements group id is on of the table join groups if it is then we swap over the table name*/
		$fromTable = $origTable;
		$joinStr = '';
		foreach( $oTable->_aJoins as $aJoin){
		/** not sure why the group id key wasnt found - but put here to remove error **/
			if(array_key_exists('group_id', $aJoin)){
			
				if ($aJoin->group_id == $element->group_id && $aJoin->element_id == 0) {
					$fromTable = $aJoin->table_join;
					$joinStr = " LEFT JOIN $fromTable ON " . $aJoin->table_join . "." . $aJoin->table_join_key . " = " . $aJoin->join_from_table . "." . $aJoin->table_key;
					$elName = str_replace( $origTable . '.', $fromTable . '.', $elName);
					$where = "\n WHERE TRIM($dbElName) <> '' $where2 GROUP BY elText ASC";
					$v = $fromTable . '___' . $this->name . "[value]";
					$t = $fromTable . '___' . $this->name . "[type]";
					$e = $fromTable . '___' . $this->name . "[match]";
					$fullword = $elName . "[full_words_only]";
				}
			}
		}		
		/* elname should be in format table.key */
		$sql = "SELECT DISTINCT( $dbElName ) AS elText, $dbElName AS elVal FROM $origTable $joinStr\n";
		$sql .= $where;

		$requestName 		= $elName . "___filter";
		if(array_key_exists($elName, $_REQUEST)){
			if(is_array($_REQUEST[$elName]) && array_key_exists('value', $_REQUEST[$elName] )){
				$_REQUEST[$requestName] = $_REQUEST[$elName]['value'];
			}
		}
		
		$userStateName 		= trim($elName) . "{com_fabrik}{table}{" . $oTable->id . "}";
		$default 			= mosSession::setFromRequest( $userStateName, $requestName, $default );
		switch ( $this->filter_type ){
			case "range":
				$return .= ' between:
				<input type="hidden" value="range" name="' .$elName. '[type]"/>
				<input class="text_area fabrik_filter" name="' .$elName. '[value][]" id="' .$elName. '1" size="7" maxlength="19" value="' . $_REQUEST[$elName]['value'][0] . '" type="text">
				<input name="reset" class="button" onclick="return showCalendar(\'' .$elName. '1\', \'y-mm-dd\');" value="..." type="reset">
				and
				<input class="text_area fabrik_filter" name="' .$elName. '[value][]" id="' .$elName. '2" size="7" maxlength="19" value="' . $_REQUEST[$elName]['value'][1] . '" type="text">
				<input name="reset" class="button" onclick="return showCalendar(\'' .$elName. '2\', \'y-mm-dd\');" value="..." type="reset">';
				break;				
			case "dropdown":
				$fabrikDb->setQuery( $sql );
				$oDistinctData = $fabrikDb->loadObjectList( );
				echo $fabrikDb->getErrorMsg( );
				$obj = new stdClass;
				$obj->elVal  = "";
				$obj->elText = JText::_( 'Please select' );
				$aThisFilter[] = $obj;
				if (is_array($oDistinctData)) {
					$aThisFilter = array_merge( $aThisFilter, $oDistinctData );
				}
				$return 	 = JHTML::_('select.genericlist', $aThisFilter , $v, 'class="inputbox fabrik_filter" size="1" ' , "elVal", 'elText', $default);
				break;
				
			case "field":
				
				if (get_magic_quotes_gpc()) {
					$default			= stripslashes( $default );
				}
				$default = htmlspecialchars( $default );
				$return = "<input type='text' name='$v' value=\"$default\" class='inputbox fabrik_filter'  />";	
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
	  * @param string db col key name e.g. table.elname
	  * @param string form key name e.g. table___elname
	  * @return array filters
	  */

	 function getFilterConditionSQL( $val, $aFilter, $dbKey, $key )
	{
	 	$cond ='';
	 	/* if posted data comes from a module we want to strip out its table name
		 and replace it with current table name
		 not sure how to deal with this for joins ? */
		$fromModule 		 =  JRequest::getBool( 'fabrik_frommodule', 0 );
	 	
		isset( $val['type']) ? $filterType = $val['type'] : $filterType='dropdown';
	 	isset( $val['value'] )? $filterVal = $val['value'] : $filterVal = '';
	 	isset( $val['match'] )? $filterExactMatch = $val['match'] : $filterExactMatch = '';
	 	isset( $val['full_words_only'] )? $fullWordsOnly = $val['full_words_only'] : $fullWordsOnly = '1';
	 	isset( $val['join_db_name']) ? $joinDbName = $val['join_db_name'] : $joinDbName ='';
	 	isset( $val['join_key_column']) ? $joinKey = $val['join_key_column'] : $joinKey ='';
	 	isset( $val['join_val_column']) ? $joinVal = $val['join_val_column'] : $joinVal ='';
	 	//$filterVal = urldecode($filterVal);
	 	if( is_array($filterVal) || $filterVal != "" ){
	 		
			switch( $filterType ){
				case "range":
					if($filterVal[0] != '' & $filterVal[1] != ''){
						$cond = " $dbKey BETWEEN " . strtotime($filterVal[0]) . " AND " . strtotime($filterVal[1]);
						$aFilter[$key] = array('type'=>'range', 
													   'value'=>$filterVal, 
														'filterVal'=>$filterVal, 
														'full_words_only'=>$fullWordsOnly,
														'join_db_name' => $joinDbName,
														'join_db_key' => $joinKey
														, 'sqlCond' =>$cond 
														);
					}else{
						return ;
					}	
					break;
				case 'dropdown';
					if( $fromModule ){ 
						$aKeyParts = explode( '.', $key);
						$key = $this->db_table_name . '.' . $aKeyParts[1];
					}
					
					if(!is_array($filterVal)){
						if ( $filterExactMatch == '0' ){
							$cond = " $dbKey LIKE '%$filterVal%' ";
						} else {
							$cond = " $dbKey = '$filterVal' ";
						}
					}else{
						$cond = "( ";
						foreach($filterVal as $fval){
							if(trim($fval) != ''){
								if ( $filterExactMatch == '0' ){
									$cond .= " $dbKey LIKE '%$fval%' OR ";
								} else {
									if(trim( $fval ) == '_null_'){
										$cond .= " $dbKey IS NULL OR ";
									} else {
										$cond .= " $dbKey = '$fval' OR ";
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
					$filterCondSQL = '';
					if( $joinDbName != '' ){
						$filterCondSQL .= " LEFT JOIN $joinDbName ON $joinDbName.$joinKey = $dbKey ";
					}
					/* full_words_only
					 all search for multiple fragments of text*/
					$aFilterVals = explode( "+", $filterVal );
					if( $fullWordsOnly == '1' ){
						$cond = " $dbKey REGEXP \"[[:<:]]" . $filterVal . "[[:>:]]\"";
					} else {
						/*$cond = " $dbKey LIKE '%";
						 foreach( $aFilterVals as $filt ){
						$cond .="$filt%";
						}
						$cond .="'";*/
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