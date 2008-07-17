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


class FabrikModelFabrikColourPicker  extends FabrikModelElement {

	var $_pluginName = 'colourpicker';
	
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
		if (strstr( $data, $this->_groupSplitter )) {
			$data = explode($this->_gropSplitter, $data);
			$str = '';
			foreach($data as $d){
				$str .= "<div style='width:15px;height:15px;background-color:$d'></div>";
			}
			return $str;
		}
		return "<div style='width:15px;height:15px;background-color:$data'></div>";
	}
	
	/**
	 * formats the posted data for insertion into the database
	 * @param mixed thie elements posted form data
	 * @param array posted form data
	 */

	function storeDatabaseFormat($val, $data)
	{
		return "$val";
	}
	
	/**
	 * load the javascript class that manages interaction with the form element
	 * should only be called once
	 * @return string javascript class file
	 */

	function formJavascriptClass()
	{
		FabrikHelperHTML::script( 'colour-picker.js', 'components/com_fabrik/plugins/element/fabrikcolourpicker/', true );
	}
	
	/**
	 * return tehe javascript to create an instance of the class defined in formJavascriptClass
	 * @param string full name of element
	 * @param array form data
	 * @return string javascript to create instance. Instance name must be 'el'
	 */

	function elementJavascript()
	{
		$params = $this->getParams();
		$element =& $this->getElement();
		$id = $this->getHTMLId();
		$vars = FabrikString::ltrimword( $element->default, "rgb(" );
		$vars = explode( ",", rtrim( $vars, ')' ) );
		$str = '';
		$id2 = $id . "_control";
		$id3 = $id . "_output";
		$vars = array_pad( $vars, 3, 0 );
		$opts =& $this->getElementJSOptions();
		$opts->liveSite = JURI::root();
		$opts->hiddenField = $id;
		$opts->red = (int)$vars[0];
		$opts->green = (int)$vars[1];
		$opts->blue = (int)$vars[2];
		$opts = FastJSON::encode($opts);
		return "new ColourPicker('$id2', [['$id3', 'backgroundColor']], $opts })" ;
	}
	
	/**
	 * draws the form element
	 * @param int repeat group counter
	 * @return string returns element html
	 */
		
	function render( $data, $repeatCounter = 0 ) 
	{
		$elementHTMLName = $this->getHTMLName();
		$id = $this->getHTMLId();
		$trackImage  = JURI::base() . '/components/com_fabrik/addons/element/fabrikcolourpicker/images/track.gif';
		$handleImage = JURI::base() . '/components/com_fabrik/addons/element/fabrikcolourpicker/images/handle.gif';
		$str = '<input type="hidden" name="' .$elementHTMLName . '" id="'.$id.'" /><div id="' . $id . '_output"  style="float:left;width:20px;height:20px;border:1px solid #333333;"  onclick="$(\'' . $id . '_control\').toggle();" style="background-color:#663300"></div>';
		$str .= '<div class="colourPickerBackground" id="' . $id . '_control" style="float:left;cursor:move;background-color:#EEEEEE;border:1px solid #333333;width:380px;padding:15px 5px 5px 5px;"></div>';
		return $str;
	}

	/**
	 * defines the type of database table field that is created to store the element's data
	 */
	function getFieldDescription()
	{
		return "VARCHAR (30)";
	}
	
	function renderAdminSettings( )
	{
		?>
		<div id="page-<?php echo $this->_name;?>" class="elementSettings" style="display:none">
		<?php echo JText::_( 'No extra options available' );?>	
		</div><?php
	}

}	
?>