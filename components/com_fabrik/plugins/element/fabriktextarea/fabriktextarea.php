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


class FabrikModelFabrikTextarea extends FabrikModelElement {

	var $_pluginName = 'textarea';

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
		$data = parent::renderTableData($data, $oAllRowsData );
		return stripslashes( $data );
	}

	/**
	 * state if the element uses a wysiwyg editor
	 */

	function useEditor()
	{
		$params =& $this->getParams();
		$element =& $this->getElement();
		if ($params->get( 'use_wysiwyg', 0 )) {
			return preg_replace("/[^A-Za-z0-9]/", "_", $element->name);
		} else {
			return false;
		}
	}

	/**
	 * determines if the element can contain data used in sending receipts, e.g. fabrikfield returns true
	 */

	function isReceiptElement()
	{
		return true;
	}

	/**
	 * draws the form element
	 * @param int repeat group counter
	 * @return string returns element html
	 */

	function render( $data, $repeatCounter = 0 )
	{
		$elementHTMLName 	= $this->getHTMLName();
		$id 							= $this->getHTMLId();
		$element 					=& $this->getElement();
		if($element->hidden == '1'){
			echo $this->getHiddenField( $elementHTMLName, $data[$elementHTMLName], $this->_elementHTMLId );
			return;
		}
		$params 		=& $this->getParams();
		$cols 			= $element->width;
		$rows 			= $element->height;
		$value 			= stripslashes($element->default); // stripslashes added for smart.35thparallel.com.au
		$errorCSS  = '';
		if (isset( $this->_elementError ) && $this->_elementError != '') {
			$errorCSS = " elementErrorHighlight";
		}
		$str ="<div class='fabirkElementContainer'>";
		$elementHTMLName = str_replace(  '.', '___', $elementHTMLName );
		if ($params->get( 'use_wysiwyg' )) {
			$str .= FabrikHelperHTML::getEditorArea( $elementHTMLName, $value, $elementHTMLName, '100%', '200', $cols, $rows );
		} else {
			$str .= "<textarea class=\"fabrikinput inputbox$errorCSS\" name=\"$elementHTMLName\" id=\"". $this->getHTMLId(). "\" cols=\"$cols\" rows=\"$rows\">".$value."</textarea>\n";
		}
		if ($params->get( 'textarea-showmax' )) {
			$charsLeft = $params->get('textarea-maxlength') - strlen($value);
			$str .= "<div class='fabrik_characters_left'><span id='".$this->getHTMLId() . "_counter'>" . $charsLeft . "</span> " . JText::_( 'Characters left') . "</div>";
		}
		if (!$this->_editable) {
			return $value;
		}
		$str .="</div";
		return $str;
	}

	/**
	 * get db field description
	 * @return string db field description
	 */

	function getFieldDescription()
	{
		return "TEXT";
	}


	/**
	 * return tehe javascript to create an instance of the class defined in formJavascriptClass
	 * @return string javascript to create instance. Instance name must be 'el'
	 */

	function elementJavascript()
	{
		$id = $this->getHTMLId();
		$params =& $this->getParams();
		$opts =& $this->getElementJSOptions();
		$opts->max = $params->get('textarea-maxlength');
		$opts->wysiwyg = $params->get('use_wysiwyg') ? true: false;
		$opts = FastJSON::encode($opts);
		return "new fbTextarea('$id', $opts)"; 
	}

	/**
	 * load the javascript class that manages interaction with the form element
	 * should only be called once
	 * @return string javascript class file
	 */

	function formJavascriptClass()
	{
		FabrikHelperHTML::script( 'javascript.js', 'components/com_fabrik/plugins/element/fabriktextarea/', false );
	}
}
?>