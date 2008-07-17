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

require_once( COM_FABRIK_FRONTEND.DS.'helpers'.DS.'html.php' );

class FabrikModelFabrikDate  extends FabrikModelElement {

	var $_pluginName = 'date';
	
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
	 * @param string element name
	 * @param object all the data in the tables current row
	 * @return string formatted value
	 */

	function renderTableData( $data, $oAllRowsData )
	{
		$params =& $this->getParams();
		$db =& JFactory::getDBO();
		$aNullDates = array('0000-00-000000-00-00','0000-00-00 00:00:00','0000-00-00', $db->getNullDate() );
		if (in_array( $data, $aNullDates )) {
			return '';
		}
		$format = $params->get( 'date_table_format', 'Y-m-d' );
		if ($params->get( 'date_showtime', 0 )) {
			$format = $format . ' H:i:s';
			if (is_array( $data )) {
				$data = $data[0] . ' ' . $data[1];
			}
		}
		if ($data != '') {
			$data = date( $format, strtotime( $data ));
		}
		return parent::renderTableData( $data, $oAllRowsData );
	}
	
	/**
	 * draws the form element
	 * @param int repeat group counter
	 * @return string returns element html
	 */
		
	function render( $data, $repeatCounter = 0 )
	{
		$elementHTMLName = $this->getHTMLName();
		FabrikHelperHTML::loadCalendar();
		$params 	=& $this->getParams();
		$element 	=& $this->getElement();
		//$value 		= str_ireplace( array( "{today}", "{now}" ), date( 'Y-m-d' ), $element->default );
		$value = preg_replace( array( "/\{now\}/i", "/\{today\}/i"), date( 'Y-m-d' ), $element->default );
		$value2 	= '';
		if ($params->get( 'date_showtime', 0 )) {
			$v = explode( " ", $value );
			$value = $v[0];
			$value2 = (count( $v ) > 1)? $v[1] : 0;
		}
		$format = $params->get( 'date_form_format',  '%Y-%m-%d' );
		if (!$this->_editable) {
			if ($value != '') {
				$value = strftime($format, strtotime($value));
			}
			return( $element->hidden == '1' ) ? "<!-- " . $value . " -->" : $value;
		}

		if ($params->get( 'date_showtime', 0 )) {
			$elementHTMLName = str_replace('[]', '[0]', $elementHTMLName);
			$elementHTMLName .= '[]';
		}
		$errorCSS  = '';
		if ( isset( $this->_elementError ) &&  $this->_elementError != '' ) {
			$errorCSS = " elementErrorHighlight";
		}
	
		$buttonId = $this->_elementHTMLId;
		if (strstr( $buttonId, '[]' )) {
			$buttonId = rtrim( $this->_elementHTMLId, '[]' );
		}
			
		if ($element->hidden) {
			$str = '<input class="fabrikinput inputbox ' . $errorCSS . '" type="hidden" name="'.$elementHTMLName.'" value="'.$value.'" id="'.$this->getHTMLId().'"  />';
		} else {
			if ($value != '') {
				$value = strftime($format, strtotime($value));
			}
			//$str = JHTML::_('calendar', $value, $elementHTMLName, $this->getHTMLId(), $format, array('class'=>'fabrikinput inputbox '.$errorCSS, 'size'=>$element->width,  'maxlength'=>'19'));
			$str = $this->calendar($value, $elementHTMLName, $this->getHTMLId(), $format, array('class'=>'fabrikinput inputbox '.$errorCSS, 'size'=>$element->width,  'maxlength'=>'19'));
		}
		
	if ($params->get( 'date_showtime', 0 )) {
			$newelementHTMLId = $this->_elementHTMLId;
			if (strstr( $this->_elementHTMLId, '[]' )) {
				$newelementHTMLId = rtrim($this->_elementHTMLId, '[]');
			}
			$newelementHTMLId .= "_time";
			$str .= "\n<input class='inputbox' size='6' value='$value2'' name='$elementHTMLName' id='$newelementHTMLId'/>";
			$str .= "\n".'<input type="button"  class="button" value="..." id="' . $buttonId . '_button_time" />';
		}
		return $str;
	}

		/**
	 * Displays a calendar control field
	 *
	 * hacked from behaviour as you need to check if the element exists
	 * it might not as you could be using a custom template
	 * @param	string	The date value
	 * @param	string	The name of the text field
	 * @param	string	The id of the text field
	 * @param	string	The date format
	 * @param	array	Additional html attributes
	 */
	
	function calendar($value, $name, $id, $format = '%Y-%m-%d', $attribs = null)
	{
		JHTML::_('behavior.calendar'); //load the calendar behavior

		if (is_array($attribs)) {
			$attribs = JArrayHelper::toString( $attribs );
		}
		
		$document =& JFactory::getDocument();
		$document->addScriptDeclaration('window.addEvent(\'domready\', function() {
		if($("' . $id . '")){ 
		Calendar.setup({
        inputField     :    "'.$id.'",     // id of the input field
        ifFormat       :    "'.$format.'",      // format of the input field
        button         :    "'.$id.'_img",  // trigger for the calendar (button ID)
        align          :    "Tl",           // alignment (defaults to "Bl")
        singleClick    :    true
    });
	}
	});');

		return '<input type="text" name="'.$name.'" id="'.$id.'" value="'.htmlspecialchars($value, ENT_COMPAT, 'UTF-8').'" '.$attribs.' />'.
				 '<img class="calendar" src="'.JURI::root(true).'/templates/system/images/calendar.png" alt="calendar" id="'.$id.'_img" />';
	}

	/**
	 * load the javascript class that manages interaction with the form element
	 * should only be called once
	 * @return string javascript class file
	 */

	function formJavascriptClass()
	{
		FabrikHelperHTML::script( 'javascript.js', 'components/com_fabrik/plugins/element/fabrikdate/', false );
	}
	
	/**
	 * return tehe javascript to create an instance of the class defined in formJavascriptClass
	 * @return string javascript to create instance. Instance name must be 'el'
	 */
	
	function elementJavascript( )
	{
		$params 	=& $this->getParams();
		$id = $this->getHTMLId( );
		$opts =& $this->getElementJSOptions();
		$opts->showtime = ($params->get( 'date_showtime', 0 )) ? true : false; 
		$opts->timelabel = JText::_('time');
		$opts = FastJSON::encode($opts);
		return "new fbDateTime('$id', $opts)" ;
		//if ( JRequest::getVar( 'format' ) == 'popup' ) {
		//	$str .= "ofabrik.dispatchEvent( 'fbDateTime', '$id', 'load', 'this._getSubElements()');\n";
		//}
	}
	
	function getFieldDescription()
	{
		return "DATETIME";
	}
	
	/**
	 * when importing csv data you can run this function on all the data to format it into the required mysql format
	 *
	 * @param array data
	 * @param string table column heading
	 * @return array data
	 */

	function prepareCSVData($data, $key)
	{
		//go through data and turn any dates into unix timestamps
		for ($j=0; $j<count($data); $j++) {
			for ($i=0; $i<count( $data[$j] ); $i++) {
				if ($i == $key) {
					$data[$j][$i] = str_replace( "/", "-", $data[$j][$i] );
					$data[$j][$i] = date( "Y-m-d H:i:s", $this->strtotime_uk( $data[$j][$i] ) );
				}
			}
		}
		return $data;
	}

	function strtotime_uk( $str )
	{
		$str = preg_replace("/^\s*([0-9]{1,2})[\/\. -]+([0-9]{1,2})[\/\. -]*([0-9]{0,4})/", "\\2/\\1/\\3", $str);
	   $str = trim( $str,'/' );
	   return strtotime( $str );
	}
	
	function getDefaultValue( $data, $editable = true, $repeatCounter = 0 )
	{
		$groupModel =& $this->_group;
		$formModel 	=& $this->_form;
		$element	=& $this->getElement();
		$tableModel =& $this->_table;
		$params =& $this->getParams();
		if ($params->get( 'date_defaulttotoday' )) {
			$defaultVal =& $this->_element->default;
			$date = JFactory::getDate();
			$defaultVal = $date->toMySQL();
		} else {
			$defaultVal =& $this->_element->default;
			if ($element->eval == "1") {
				$defaultVal = @eval( stripslashes( $defaultVal ) );
			}
		}
		$table 		=& $tableModel->getTable();
		if ( $groupModel->canRepeat( ) == '1' ) {
			$fullName = $table->db_table_name . $formModel->_joinTableElementStep . $element->name;
			if (isset( $data[$fullName ] )) {
				$defaultVal = $data[$fullName][0];
				$defaultVal = explode( $this->_groupSplitter, $defaultVal );
				if (is_array( $defaultVal ) && array_key_exists( $repeatCounter, $defaultVal )) {
					$defaultVal = $defaultVal[$repeatCounter];
					if (is_array( $defaultVal )) {
						$defaultVal = implode( ',', $defaultVal );
					}
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
					
					if (isset( $data[ $fullName ][0] )) { 
						/* if not its a file upload el */
						$defaultVal = $data[ $fullName ][0];
					} 
				} else {
					$defaultVal = $data[$fullName];
				} 
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
	 * formats the posted data for insertion into the database
	 * @param mixed thie elements posted form data  
	 * @param array posted form data
	 */
	
	function storeDatabaseFormat( $val, $data )
	{
		$params =& $this->getParams();
		$return = '';
		//TODO: need to figure out what to do when saving dates that are in duplicatable groups, the issue being that the returned string wont be formatted correctly
		// to go inside the datetime field, but changing the datetime field to a string might cause problems with ordering etc
		if (is_array( $val )) {
			if (is_array( $val[0] )) {
				foreach ($val as $val2 ){
					//group by data is here
					if (is_array( $val2 )) {
						$return .= trim(implode(' ', $val2)) . ":00";
					}
					$return .= $this->_groupSplitter;
				}
			} else {
				if (trim( $val[0] ) == '') {
					$return =  "0000-00-00 00:00:00";
				} else {
					$return .= trim(implode(' ', $val)) . ":00";
				}
			}
		} else {
			// $$$ hugh - need to convert back to MySQL from any custom format.
			$return = date( 'Y-m-d H:i:s', strtotime($val));
		}
		return $return;
	}
	
	/**
	 * renders admin settings
	 */

	function renderAdminSettings( )
	{
		$pluginParams =& $this->getPluginParams();
		$this->loadLanguage( $this->_name );
		?>
		<div id="page-<?php echo $this->_name;?>" class="elementSettings" style="display:none">	
			<?php 
			echo $pluginParams->render( 'details' );
			echo $pluginParams->render( 'params', 'extra' );?>
		</div><?php
	}
	
	/**
	 * used to format the data when shown in the form's email
	 * @param string data
	 * @return string formatted value
	 */
	
	function getEmailValue( $data )
	{	
		$val = $this->renderTableData( $data, new stdClass()) ;
		return $val ;
	}
	
	 /**
	  * Get the table filter for the element
	  * @return string filter html
	  */
	 
	function &getFilter( )
	{
		global $mainframe;
	 	$params 		=& $this->getParams();
		$tableModel =& $this->_table;
		$table 			=& $tableModel->getTable();
		$element 		=& $this->getElement();

		$origTable 	= $table->db_table_name;
	 	$fabrikDb 	=& $tableModel->getDb();
	 	$aFilter 		=& $tableModel->getFilterArray();
		$js 				= ""; 
		$elName 		= rtrim( $this->getFullName( true, true), "[]" );
		$dbElName		= rtrim( $this->getFullName( true, false), "[]" );
	
				
		$elName2 		= $this->getFullName( false, false, false );

		$ids 			= $tableModel->getColumnData( $elName2 );
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

						
		$default = $this->getDefaultFilterVal( $origTable, $elName, $tableModel->_aFilter );
		$aThisFilter = array();
		
		$format = $params->get('date_table_format', 'Y-m-d');
		
		//convert format into mysql - basically add % before all key characters
		$aKeyMaps = array('a', 'b', 'c', 'D', 'd', 'e', 'f', 'H', 'h', 'I', 'i', 'j', 'k', 'l', 'M', 'm', 'p', 'r', 'S', 's', 'T', 'U', 'u', 'V', 'v', 'W', 'w', 'X', 'x', 'Y', 'y', 'x');
		$aChars = str_split($format);
		$mySqlFormat = '';
		foreach ($aChars as $c) {
			if ( in_array( $c, $aKeyMaps ) ) {
				$mySqlFormat .= "%$c";
			} else {
				$mySqlFormat .= "$c";
			} 	
		}
		/* check if the elements group id is on of the table join groups if it is then we swap over the table name*/
		$fromTable = $origTable;
		$joinStr = '';
		foreach ( $tableModel->_aJoins as $aJoin ) {
		/** not sure why the group id key wasnt found - but put here to remove error **/
			if ( array_key_exists( 'group_id', $aJoin ) ) {
				if ($aJoin->group_id == $element->group_id && $aJoin->element_id == 0) {
					$fromTable = $aJoin->table_join;
					$joinStr = " LEFT JOIN $fromTable ON " . $aJoin->table_join . "." . $aJoin->table_join_key . " = " . $aJoin->join_from_table . "." . $aJoin->table_key;
					$elName = str_replace( $origTable . '.', $fromTable . '.', $elName);
					//$where = "\n WHERE TRIM($dbElName) <> '' $where2 GROUP BY elText ASC";
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
		
		$sql = "SELECT DISTINCT( DATE_FORMAT($dbElName, '$mySqlFormat') ) AS elText, $dbElName AS elVal FROM `$origTable` $joinStr\n";
		
		$sql .= "WHERE $dbElName IN ('" . implode( "','", $ids ) . "')"
			. "\n AND TRIM($dbElName) <> '' GROUP BY elText ASC";
		$requestName 		= $elName . "___filter";
		if ( array_key_exists( $elName, $_REQUEST ) ) {
			if ( is_array( $_REQUEST[$elName] ) && array_key_exists( 'value', $_REQUEST[$elName] ) ) {
				$_REQUEST[$requestName] = $_REQUEST[$elName]['value'];
			}
		}
		
		$context					= 'com_fabrik.table.' . $table->id . '.filter.' . $requestName;
		$default			= $mainframe->getUserStateFromRequest( $context, $requestName, $default );
		
		switch ( $element->filter_type )
		{
			case "range":
				FabrikHelperHTML::loadCalendar();
				$format = $params->get( 'date_form_format', 'Y-m-d' );
				if (empty( $default )) {
					$default = array('','');
				}
				$return = JText::_(' Between' ) . JHTML::_('calendar',  $default[0], $v.'[]', $this->getHTMLId() . "_filter_range_0", $format, array('class'=>'inputbox fabrik_filter',  'maxlength'=>'19') );
				$return .= "<br />" . JText::_( 'and ') . JHTML::_('calendar',  $default[1], $v.'[]', $this->getHTMLId() . "_filter_range_1", $format, array('class'=>'inputbox fabrik_filter',  'maxlength'=>'19'));
				break;
					
			case "dropdown":
				$fabrikDb->setQuery( $sql );
				$oDistinctData = $fabrikDb->loadObjectList( );
				echo $fabrikDb->getErrorMsg( );
				$obj = new stdClass;
				$obj->elVal  = "";
				$obj->elText = JText::_( 'Please select' );
				$aThisFilter[] = $obj;
				if ( is_array( $oDistinctData ) ) {
					$aThisFilter = array_merge( $aThisFilter, $oDistinctData );
				}
				$return 	 = JHTML::_('select.genericlist',  $aThisFilter , $v, 'class="inputbox fabrik_filter" size="1" ' , "elVal", 'elText', $default, array('class'=>'inputbox fabrik_filter',  'maxlength'=>'19') );
				break;
				
			case "field":
				if (is_array( $default )) {
					$default = array_shift($default);
				}
				if (get_magic_quotes_gpc()) {
					$default			= stripslashes( $default );
				}
				$default = htmlspecialchars( $default );
				$format = $params->get( 'date_form_format', 'Y-m-d' );
				$return = JHTML::_('calendar', $default, $v, $this->getHTMLId() . "_filter_range_0", $format, array('class'=>'inputbox fabrik_filter',  'maxlength'=>'19') );
				break;
	
			}
		$return .= "\n<input type='hidden' name='$t' value='$element->filter_type' />\n";
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
	  * @return array filter
	  */

	function getFilterConditionSQL( $val, $aFilter, $dbKey, $key )
	{
	 	$cond ='';
	 	/* if posted data comes from a module we want to strip out its table name
		 and replace it with current table name
		 not sure how to deal with this for joins ? */
		$params = $this->getParams();
		$fromModule 		 = JRequest::getBool( 'fabrik_frommodule', 0 );
	 	
		$filterType = isset( $val['type']) ? $val['type'] : 'dropdown';
	 	$filterVal =  isset( $val['value'] )? $val['value'] : '';
	 	$filterExactMatch = isset( $val['match'] )? $val['match'] : '';
	 	$fullWordsOnly = isset( $val['full_words_only'] )? $val['full_words_only'] : '1';
	 	$joinDbName =isset( $val['join_db_name']) ?  $val['join_db_name'] : '';
	 	$joinKey =isset( $val['join_key_column']) ?  $val['join_key_column'] : '';
	 	$joinVal =isset( $val['join_val_column']) ?  $val['join_val_column'] : '';
	 	
	 	if ($filterVal == "" ) {
	 		return;
	 	}
		switch( $filterType )
		{
			case 'dropdown';
				$filterVal = urldecode( $filterVal );
				if ( $fromModule ) {
					$aKeyParts = explode( '.', $key);
					$key = $this->db_table_name . '.' . $aKeyParts[1];
				}
				if (!is_array( $filterVal )) {
					if ( $filterExactMatch == '0' ) {
						$cond = " $dbKey LIKE '%$filterVal%' ";
					} else {
						$cond = " $dbKey = '$filterVal' ";
					}
				}else{
					$cond = "( ";
					foreach ($filterVal as $fval) {
						if (trim( $fval ) != '') {
							if ( $filterExactMatch == '0' ) {
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
					$aFilter[$key][] = array( 'type'=>'dropdown', 'value'=>$filterVal , 'filterVal'=>$filterVal, 'sqlCond' =>$cond );
				} else {
					$aFilter[$key] = array( 'type'=>'dropdown', 'value'=>$filterVal , 'filterVal'=>$filterVal, 'sqlCond' =>$cond );
				}
				break;
			case "":
			case "field":
				$filterVal = urldecode( $filterVal );
				$filterCondSQL = '';
				if ( $joinDbName != '' ) {
					$filterCondSQL .= " LEFT JOIN $joinDbName ON $joinDbName.$joinKey = $dbKey ";
				}
				/* full_words_only
				 all search for multiple fragments of text*/
				$aFilterVals = explode( "+", $filterVal );
				if ( $fullWordsOnly == '1' ) {
					$cond = " $dbKey REGEXP \"[[:<:]]" . $filterVal . "[[:>:]]\"";
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
				if ( $joinDbName != '' ) {
					$filterCondSQL .= " LEFT JOIN $joinDbName ON $joinDbName.$joinKey = " . $this->db_table_name . "." . $this->db_primary_key . " ";
				}
				$filterVal = urldecode( $filterVal );
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
					//bit of a hack to get month ranges working
					$format = $params->get( 'date_table_format', 'Y-m-d' );
					if( $format == 'm/Y' ){
						$cond = " unix_timestamp($dbKey) >= " . strtotime($filterVal[0]) . " AND unix_timestamp($dbKey) <= " . strtotime($filterVal[1]);
					} else {
						$cond = " unix_timestamp($dbKey) BETWEEN " . strtotime($filterVal[0]) . " AND " . strtotime($filterVal[1]);
					}
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
		}
	 if ( array_key_exists( $key, $aFilter ) ) {
			return $aFilter[$key];
		}else{
			return '';
		}
	}
	
}	
?>