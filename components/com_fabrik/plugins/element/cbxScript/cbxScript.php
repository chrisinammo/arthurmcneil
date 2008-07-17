<?php
/**
* @package Joomla
* @subpackage Fabrik
* @copyright Copyright (C) 2005 Rob Clayburn. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();


class FabrikModelcbxScript extends FabrikModelElement {

	var $_pluginName = 'cbxscript';
	/**
	* Constructor
	*/

	function __construct()
	{
		parent::__construct();
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
		$elementHTMLName = $this->getHTMLName();
		$element = $this->getElement();
		if($element->hidden == '1'){
			echo $this->getHiddenField( $elementHTMLName, $data[$elementHTMLName], $this->_elementHTMLId );
			return;
		}
		$value 			= $this->default;
		if( !$this->_editable ){
			return $value;
		}
		$params 		= $this->getParams();
		$use_wysiwyg 	= $params->get('use_wysiwyg');
		$cols 			= $element->width;
		$rows 			= $element->height;
		$errorCSS  = '';
		if( isset($this->_elementError) && $this->_elementError != '' ){
			$errorCSS = " elementErrorHighlight";
		}
		$str = "";
		$elementHTMLName = str_replace( '.', '___', $elementHTMLName );
		$str .= FabrikHelperHTML::getEditorArea( $elementHTMLName, $value, $elementHTMLName, '100%', '200', $cols, $rows );
		return $str;
	}
	
	function getFieldDescription(){
		return "TEXT";
	}
	
	function renderAdminSettings( )
	{
		$params = $this->getParams();
		$checked = ($this->eval == '1') ? ' checked="checked"' : "";
		 ?>
		<div id="page-<?php echo $this->_name;?>" class="elementSettings" style="display:none">
		<table class="admintable">
		<?php FabrikHelperAdminHTML::widthField( $this );?>
	<tr>
		<td><?php echo  JText::_( 'Height' );?></td>
		<td><input class="inputbox" type="text" name="height" size="6"
			value="<?php echo $this->height; ?>" /></td>
	</tr>
	</table>
	<?php echo $params->render();?>
	<table>
	<tr>
		<td><?php echo JText::_( 'Default' );?></td>
		<td>
			<textarea onblur="setAll(this.value, 'default');" rows="8" cols="50" name="default" class="inputbox"><?php echo $this->default; ?></textarea>
		</td>
	</tr>
	<tr>
		<td>
			<label for="eval"><?php echo JText::_( 'Eval' )?>:</label>
		</td>
		<td>
			<input type="checkbox" onclick="setAllCheckBoxes('eval', this.checked)" name="eval" id="eval" value="1" <?php echo $checked;?> />
		</td>
	</tr>
</table>		
		</div><?php
	}
	
	/**
	 * return tehe javascript to create an instance of the class defined in formJavascriptClass
	 * @return string javascript to create instance. Instance name must be 'el'
	 */
	
	function elementJavascript()
	{
		$id = $this->getHTMLId();
		$opts =& $this->getElementJSOptions();
		$opts = FastJSON::encode($opts);
		//return "\nif($('$id')){\n" .
		//"var el = new fbCBXScript('$id', $opts);\n" .
		//"}\n";
		return "new fbCBXScript('$id', $opts)" ;
	}
	
	/**
	 * load the javascript class that manages interaction with the form element
	 * should only be called once
	 * @return string javascript class file
	 */
	
	function formJavascriptClass()
	{
		FabrikHelperHTML::script( 'javascript.js', 'components/com_fabrik/plugins/element/cbxScript/', false );
	}
}	
?>