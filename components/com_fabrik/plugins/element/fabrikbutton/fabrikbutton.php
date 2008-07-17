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


class FabrikModelFabrikButton  extends FabrikModelElement {

	var $_pluginName = 'button';
	
	/**
	* Constructor
	*/

	function __construct()
	{
		parent::__construct();
	}
	
	/**
	 * draws a field element
	 * @param int repeat group counter
	 * @return string returns element html
	 */
		
	function render( $data, $repeatCounter = 0 )
	{
		$elementHTMLName = $this->getHTMLName();
		$element =& $this->getElement();
		if(!$this->_editable){ return; }
		//testing without rel=[] option
		$str = "<input type='button' class='fabrikinput button' id='" . $this->getHTMLId() ."' name='$elementHTMLName' value='$element->label' />";
		return $str;
	}
	
	/**
	 * defines the type of database table field that is created to store the element's data
	 * @return string database field description
	 */

	function getFieldDescription(){
		return "VARCHAR (255)";
	}
	
	function renderAdminSettings( )
	{
		?>
		<div id="page-<?php echo $this->_name;?>" class="elementSettings" style="display:none">		
		<?php echo JText::_( 'No extra options available' );?>	
		</div><?php
	}
	
	function getLabel()
	{
		return '';
	}
	
	function elementJavascript()
	{
		$id = $this->getHTMLId();
		$opts =& $this->getElementJSOptions();
		$opts = FastJSON::encode($opts);
		return "new fbButton('$id', $opts)" ;
		return $str;
	}
	
		/**
	 * load the javascript class that manages interaction with the form element
	 * should only be called once
	 * @return string javascript class file
	 */
	
	function formJavascriptClass()
	{
		FabrikHelperHTML::script( 'javascript.js', 'components/com_fabrik/plugins/element/fabrikbutton/', false );
	}	
}	
?>