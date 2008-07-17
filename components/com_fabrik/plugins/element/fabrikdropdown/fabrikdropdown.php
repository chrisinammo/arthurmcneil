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


class FabrikModelFabrikDropdown  extends FabrikModelElement {

	var $_pluginName = 'dropdown';

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

	function renderTableData( $data, $oAllRowsData )
	{
		$params =& $this->getParams();
		$element =& $this->getElement();
		$values = explode( "|", $element->sub_values );
		$labels 	= explode( "|", $element->sub_labels );

		//check if the data is in csv format, if so then the element is a multi drop down
		if (strstr( $data, $this->_groupSplitter2 ) && $params->get( 'multiple', 0 ) == 1) {
			$aData = explode( $this->_groupSplitter2, $data );
			$sLabels = '';
			foreach ($aData as $tmpVal) {
				if ($params->get('icon_folder') != -1 && $params->get('icon_folder') != '') {
					$sLabels .= $this->_replaceWithIcons($tmpVal). "<br />";
				}else{
					$key = array_search( $tmpVal, $values );
					$sLabels.= $labels[$key]. "<br />";
				}
			}
			return FabrikString::rtrimword( $sLabels, "<br />" );
		} else {
			if ($params->get('icon_folder') != -1 && $params->get('icon_folder') != '') {
				return $this->_replaceWithIcons($data). "<br />";
			}else{
				$key = array_search( $data, $values );
				return $labels[$key];
			}
				
		}
		return parent::renderTableData( $data, $oAllRowsData );
	}

	/**
	 * formats the posted data for insertion into the database
	 * @param mixed thie elements posted form data
	 * @param array posted form data
	 */

	function storeDatabaseFormat( $val, $data )
	{
		$return = '';
		if (is_array( $val )) {
			foreach ($val as $key=>$v) {
				if(is_array($v)){
					// in repeat group
					foreach ($v as $v2) {
						$return .= implode( $this->_groupSplitter2, $v );
					}
					$return .= $this->_groupSplitter;
				} else {
					//not in repeat group
					$return .= $v .$this->_groupSplitter2;
				}
			}
			$val = implode( $this->_groupSplitter, $val );
		} else {
			$return = $val;
		}
		$return = FabrikString::rtrimword($return, $this->_groupSplitter);
		$return = FabrikString::rtrimword($return, $this->_groupSplitter2);
		return $return;
	}

	/**
	 * draws the form element
	 * @param int repeat group counter
	 * @return string returns element html
	 */

	function render( $data, $repeatCounter = 0 )
	{
		$elementHTMLName = $this->getHTMLId();
		$element =& $this->getElement();
		$params =& $this->getParams();
		$allowAdd 	= $params->get( 'allow_frontend_addtodropdown', false );
		$arVals = explode( "|", $element->sub_values );
		$arTxt 	= explode( "|", $element->sub_labels );

		$arSelected = explode( "|", $element->sub_intial_selection );
		$multiple 	= $params->get( 'multiple', 0 );
		$attribs = '';
		//default has been calculated to show record data if it exists
		$aInitialValues = $element->default;

		if (!is_array( $aInitialValues )) {
			//always ensure initial vals are in an array
			$aInitialValues = array( $aInitialValues );
		}

		$errorCSS  = (isset( $this->_elementError ) &&  $this->_elementError != '') ?  " elementErrorHighlight" : '';
		$attribs .= 'class="inputbox'.$errorCSS."\"";

		if ($multiple == "1") {
			$elementHTMLName .= "[]"; //add this in to allow for multiple selections //
			$attribs .= " multiple=\"multiple\" ";
		}
		$i = 0;
		$aRoValues = array();
		$opts = array();
		foreach ($arVals as $tmpval) {
			$tmptxt = addslashes(htmlspecialchars($arTxt[$i]));
			$opts[] = JHTML::_('select.option', $tmpval, $tmptxt );
			if (in_array( $tmpval, $aInitialValues )) {
				$aRoValues[] = $tmptxt;
			}
			$i ++;
		}
		$str = JHTML::_('select.genericlist', $opts, $elementHTMLName, $attribs, 'value', 'text', $aInitialValues, $this->_elementHTMLId );
		if (!$this->_editable) {
			return implode(', ', $aRoValues);
		}
		if ($params->get( 'allow_frontend_addtodropdown', false )) {
			$onlylabel = $params->get('dd-allowadd-onlylabel');
			$str .= $this->getAddOptionFields( $onlylabel );
		}
		return $str;
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
		if ($params->get('dd-savenewadditions')) {
			$added = stripslashes($data[$element->name . '_additions']);
   		$json = new Services_JSON();
			$added = $json->decode($added);
			$arVals = explode( "|", $element->sub_values );
			$arTxt 	= explode( "|", $element->sub_labels );
			$data = explode($this->_groupSplitter2, $data[$element->name]);
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
	

	/**
	 * load the javascript class that manages interaction with the form element
	 * should only be called once
	 * @return string javascript class file
	 */

	function formJavascriptClass()
	{
		FabrikHelperHTML::script( 'javascript.js', 'components/com_fabrik/plugins/element/fabrikdropdown/', false );
	}

	/**
	 * return tehe javascript to create an instance of the class defined in formJavascriptClass
	 * @return string javascript to create instance. Instance name must be 'el'
	 */

	function elementJavascript( )
	{
		$id = $this->getHTMLId( );
		$element =& $this->getElement();
		$arSelected = $element->default;
		if (!is_array( $arSelected )) {
			$arSelected = array($arSelected);
		}
		$arVals = explode( "|", $element->sub_values );
		$arTxt 	= explode( "|", $element->sub_labels );
		$params =& $this->getParams();

		$opts =& $this->getElementJSOptions();
		$opts->allowadd 	= $params->get( 'allow_frontend_addtodropdown', false ) ? true : false;
		$opts->defaultVal = $arSelected;
		$opts->data 			= array_combine( $arVals, $arTxt ) ;
		$opts->splitter 	= $this->_groupSplitter2;
		$opts = FastJSON::encode($opts);
		return "new fbDropdown('$id', $opts)" ;
	}

	/**
	 * determines the value for the element in the form view
	 * @param array data
	 * @param bol editable element default = true
	 * @param int when repeating joinded groups we need to know what part of the array to access
	 */

	function getDefaultValue( $data, $editable = true, $repeatCounter = 0 )
	{
		$groupModel =& $this->_group;
		$formModel 	=& $this->_form;
		$element 		=& $this->getElement();
		$tableModel =& $this->_table;
		$defaultVal = explode( "|", $element->sub_intial_selection );
		$table =& $tableModel->getTable();
			

		if ($groupModel->canRepeat( ) == '1') {
			$fullName = $table->db_table_name . $formModel->_joinTableElementStep . $element->name;
			if (isset( $data[$fullName ] )) {
				$defaultVal = $data[$fullName];
				$defaultVal = explode( $this->_groupSplitter, $defaultVal );
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

	/**
	 * get the field description
	 * @return string field description e.g. varchar(255)
	 */

	function getFieldDescription()
	{
		return "VARCHAR (255)";
	}

	/**
	 * render the admin settings
	 */

	function renderAdminSettings( )
	{
		$pluginParams =& $this->getPluginParams();
		$params =& $this->getParams();
		$element =& $this->getElement();
		FabrikHelperHTML::script( 'admin.js', 'components/com_fabrik/plugins/element/fabrikdropdown/', true );
		?>
<div id="page-<?php echo $this->_name;?>" class="elementSettings"
	style="display: none"><?php
	FabrikHelperAdminHTML::subElementFields( $element );
	echo $pluginParams->render();
	?>
<fieldset><legend><?php echo JText::_('Sub elements');?></legend> <a
	href="#" id="addDropDown" style="text-align: right"><?php echo JText::_( 'Add' ); ?></a>
<div id="drd_subElementBody"></div>
</fieldset>
</div>
<input
	type="hidden" name="params[drd_initial_selection]" value=""
	id="params_drd_initial_selection" />
	<?php
}

function getAdminJS()
{
	$element =& $this->getElement();
	$script = "\tvar fabrikdropdown = new fabrikAdminDropdown();\n".
		"\tpluginControllers.push({element:'fabrikdropdown', controller: fabrikdropdown});\n";
	$sub_values 	= explode( "|", $element->sub_values );
	$sub_texts 	= explode( "|", $element->sub_labels );
	$sub_intial_selections = explode( "|", $element->sub_intial_selection );
	for ($ii = 0; $ii < count($sub_values) && $ii < count($sub_texts); $ii ++) {
		if (is_array( $sub_intial_selections ) and in_array( $sub_values[$ii], $sub_intial_selections )) {
			$bits[] = "['".addslashes($sub_values[$ii])."', '".addslashes($sub_texts[$ii])."', 'checked']";
		} else {
			$bits[] = "['".addslashes($sub_values[$ii])."', '".addslashes($sub_texts[$ii])."', '']";
		}
	}
	$script .= "\tfabrikdropdown.addSubElements([";
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
	$sLabels = '';
	if (is_string( $data )) {
		$data = array($data);
	}
	foreach ($data as $tmpVal) {
		$key = array_search( $tmpVal, $values );
		$sLabels.= $labels[$key]. "\n";
	}
	$val =  rtrim( $sLabels, "\n" );
	return $val;
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
}
?>