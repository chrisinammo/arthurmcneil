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


class FabrikModelFabrikInternalid  extends FabrikModelElement {

	var $_pluginName = 'inernalid';
	
	/**
	* Constructor
	*/

	function __construct()
	{
		parent::__construct();
	}
	
	/**
	 * draws the form element
	 * @param int repeat group counter
	 * @return string returns element html
	 */
		
	function render( $data, $repeatCounter = 0 )
	{
		$elementHTMLName 	= $this->getHTMLName();
		$params 					=& $this->getParams();
		$element 					=& $this->getElement();
		$value 						= $element->default;
		$type = "hidden";
		if( isset($this->_elementError) && $this->_elementError != '' ){
			$type .= " elementErrorHighlight";
		}
		if( !$this->_editable ){
			return "<!--" . stripslashes($value) . "-->";
		}
		/* no need to eval here as its done before hand i think ! */
		if ( $element->eval == "1" and !isset ( $data[$elementHTMLName] ) ) {
			$str = "<input class=\"inputbox $type\" type=\"$type\" name=\"$elementHTMLName\" id=\"" . $this->getHTMLId() . "\" $sizeInfo value=\"$value\" />\n";
		} else {
			$value = stripslashes($value);
			$str = "<input class=\"inputbox $type\" type=\"$type\" name=\"$elementHTMLName\" id=\"" . $this->getHTMLId() . "\" value=\"$value\" />\n";
		}
		return $str;
	}
	
	/**
	 * defines the type of database table field that is created to store the element's data
	 */

	function getFieldDescription()
	{
		return "int(6) not null auto_increment";
	}
	
	/**
	 * render admin settings
	 */

	function renderAdminSettings( )
	{
		?>
		<div id="page-<?php echo $this->_name;?>" class="elementSettings" style="display:none">		
		<?php echo JText::_( 'No extra options available' );?>	
		</div><?php
	}
	
	/**
	 * return tehe javascript to create an instance of the class defined in formJavascriptClass
	 * @return string javascript to create instance. Instance name must be 'el'
	 */
	
	function elementJavascript( )
	{
		$id = $this->getHTMLId( );
		$opts =& $this->getElementJSOptions();
		$opts = FastJSON::encode($opts);
		return "new fbInternalId('$id', $opts)" ;
	}
	
	
	/**
	 * load the javascript class that manages interaction with the form element
	 * should only be called once
	 * @return string javascript class file
	 */
	
	function formJavascriptClass()
	{
		FabrikHelperHTML::script( 'javascript.js', 'components/com_fabrik/plugins/element/fabrikinternalid/', false );
	}	
}	
?>