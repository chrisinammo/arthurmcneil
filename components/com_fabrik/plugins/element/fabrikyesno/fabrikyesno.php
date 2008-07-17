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


class FabrikModelFabrikYesNo  extends FabrikModelElement {

	var $_pluginName = 'yesno';
	
	/**
	* Constructor
	*/

	function __construct()
	{
		$this->hasSubElements = true;
		parent::__construct();
	}
	
	/**
	 * formats the posted data for insertion into the database
	 * @param mixed thie elements posted form data  
	 * @param array posted form data
	 */
	
	function storeDatabaseFormat( $val, $data )
	{
		return $val[0];
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
		//check if the data is in csv format, if so then the element is a multi drop down
		if ($data == '1') {
			return "<img src='components/com_fabrik/plugins/element/fabrikyesno/images/1.png' alt='" . JText::_('Yes') . "' />"  ;	
		} else {
			return "<img src='components/com_fabrik/plugins/element/fabrikyesno/images/0.png' alt='" . JText::_('No') . "' />" ;			
		}
	}

	/**
	 * shows the data formatted for the table view with format = pdf
	 * note pdf lib doesnt support transparent pngs hence this func
	 * @param string data
	 * @param object all the data in the tables current row
	 * @return string formatted value
	 */
	
	function renderTableData_pdf( $data, $oAllRowsData )
	{
	if ($data == '1') {
			return "<img src='components/com_fabrik/plugins/element/fabrikyesno/images/1_8bit.png' alt='" . JText::_('Yes') . "' />"  ;	
		} else {
			return "<img src='components/com_fabrik/plugins/element/fabrikyesno/images/0_8bit.png' alt='" . JText::_('No') . "' />" ;			
		}
	}
	
	/**
	 * shows the data formatted for CSV export
	 * @param string data
	 * @param object all the data in the tables current row
	 * @return string formatted value
	 */

	function renderTableData_csv( $data, $oAllRowsData )
	{
	if ($data == '1') {
			return  JText::_( 'Yes' );	
		} else {
			return  JText::_( 'No' );			
		}
	}
	
	/**
	 * draws the form element
	 * @param int repeat group counter
	 * @return string returns element html
	 */
		
	function render( $data, $repeatCounter = 0 )
	{
		$elementHTMLName = $this->getHTMLName();
		$params 				=& $this->getParams();
		$element =& $this->getElement();
		$str = '';
		$arSelected = split("\|", $params->get('chk_initial_selection', ''));
		if (empty( $element->default )){
			$element->default = $params->get( 'yesno_default' );
		}
		
		$aRoValues = array();
		$elementHTMLName = str_replace( '.', '___', $elementHTMLName);
		$arVals = array( 0, 1 );
		$arTxt 	= array( JText::_('no'), JText::_('yes'));
		
		for ($ii = 0; $ii < count($arVals); $ii ++) {
			$thisId = $this->getHTMLId() . "_" . $ii;
			if ($element->default ==  $arVals[$ii]) {	
				$aRoValues[] = $arTxt[$ii];	
				if ($params->get( 'element_before_label' )  == '1') { 
					$str .= "<input type=\"radio\" class=\"fabrikinput checkbox\" name=\"$elementHTMLName"."[]"."\" value=\"$arVals[$ii]\" id=\"$thisId\" checked=\"checked\" />\n<label for='$thisId'>$arTxt[$ii]</label>\n";
				} else {
					$str .= "<label for='$thisId'>$arTxt[$ii]</label>\n<input type=\"radio\" class=\"fabrikinput checkbox\" name=\"$elementHTMLName"."[]"."\" value=\"$arVals[$ii]\" id=\"$thisId\" checked=\"checked\" />\n";
				}
			} else {
				if ($params->get( 'element_before_label' )  == '1') {
					$str .= "<input type=\"radio\" class=\"fabrikinput checkbox\" name=\"$elementHTMLName"."[]"."\"  value=\"$arVals[$ii]\" id=\"$thisId\" />\n<label for='$thisId'>$arTxt[$ii]</label>\n";
				} else {
					$str .= "<label for='$thisId'>$arTxt[$ii]</label>\n<input type=\"radio\" class=\"fabrikinput checkbox\" name=\"$elementHTMLName"."[]"."\" value=\"$arVals[$ii]\" id=\"$thisId\" />\n";
				}
			}
		}
		if ( !$this->_editable ) {
			return implode( ', ', $aRoValues );
		}
		return $str;
	}
	
	/**
	 * defines the type of database table field that is created to store the element's data
	 */
	function getFieldDescription()
	{
		return "TINYINT(1)";
	}
	
	/**
 	* return the javascript to create an instance of the class defined in formJavascriptClass
	 * @return string javascript to create instance. Instance name must be 'el'
	 */
	
	function elementJavascript( )
	{
	}	
	
	/**
	 * load the javascript class that manages interaction with the form element
	 * should only be called once
	 * @return string javascript class file
	 */

	function formJavascriptClass( )
	{
	}	
	
	/**
	 * render admin settings
	 */

	function renderAdminSettings( )
	{
		$pluginParams =& $this->getPluginParams();
		?>
		<div id="page-<?php echo $this->_name;?>" class="elementSettings" style="display:none">
		<?php echo $pluginParams->render();?>	
		</div><?php
	}
	
	 /**
	  * can be overwritten by plugin class
	  * Get the table filter for the element
	  * @return string filter html
	  */
	 
	 function getFilter( )
	 {
		global $mainframe;
		$tableModel  	= $this->_table;
		$table =& $tableModel->getTable();
		$element			=& $this->getElement();
		$params 			=& $this->getParams( );
		$elName 			= $this->getFullName( false, true, false );
		$v 						= $elName . "[value]";
		$t 						= $elName . "[type]";
		$e 						= $elName . "[match]";
		$fullword 		= $elName . "[full_words_only]";
		$elExactMatch 	= $element->filter_exact_match;
		$origTable 		= $table->db_table_name;
		$requestName 	= $elName;
		$default =  $this->getDefaultFilterVal( $origTable, $elName, $tableModel->_aFilter );

		$arr = array(
			JHTML::_('select.option',  '', JText::_( 'Please select' ) ),
			JHTML::_('select.option',  '0', JText::_( 'no' ) ),
			JHTML::_('select.option',  '1', JText::_( 'yes' ) )
		);
		$return 	 = JHTML::_('select.genericlist',  $arr , $v, 'class="inputbox fabrik_filter" size="1" ' , "value", 'text', $default );
		$return .= "\n<input type='hidden' name='$t' value='$element->filter_type' />\n";
		$return .= "\n<input type='hidden' name='$e' value='$elExactMatch' />\n";
		$return .= "\n<input type='hidden' name='$fullword' value='" . $params->get('full_words_only', '0') . "' />\n";	 
		return $return;
	 }
	
}	
?>