<?php
/**
* @package Joomla
* @subpackage Fabrik
* @copyright Copyright (C) 2005 Rob Clayburn. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/

// Check to ensure this file is within the rest of the framework
defined('JPATH_BASE') or die();

/**
 * Renders a fabrik element drop down
 *
 * @author 		rob clayburn
 * @package 	fabrikar
 * @subpackage		Parameter
 * @since		1.5
 */

class JElementElement extends JElement
{
	/**
	* Element name
	*
	* @access	protected
	* @var		string
	*/
	var	$_name = 'Element';

	function fetchElement( $name, $value, &$node, $control_name )
	{
		JHTML::script( 'element.js', 'administrator/components/com_fabrik/elements/', true );
		$document =& JFactory::getDocument();
		$conn = $node->attributes( 'connection' );
		$table = $node->attributes( 'table' );
		$group = $this->_parent->_group;
		//$repeat = $this->_parent->_xml[$group]->_attributes['repeat'];
		$repeat = $this->_parent->_xml[$group]->attributes('repeat');
		$cnns = array( JHTML::_('select.option', '-1', JText::_( 'Please select' )) );
		
		if (strstr( $name, "[]" )) {
			$name = trim($name, "[]");
			$fullname = $control_name.'['.$name."][]";
		} else {
			$fullname = $control_name.'['.$name.']';
		}

		$script = "window.addEvent('domready', function(){\n";
		
		if ($repeat) {
			$script .= "var table = 'params" . $table . "-" .$this->_array_counter . "';\n";
		} else{
			$script .= "var table = 'params" . $table . "';\n";
		}
		$id = (is_null( $this->_array_counter )) ?  $control_name.$name :  $control_name.$name . '-' . $this->_array_counter;
		$script .= 	"new fabrikelementElement( '$id', {
			'livesite':'".COM_FABRIK_LIVESITE."',
			'conn':'params" .$conn . "',
			'table':table,
			'value':'$value'
		});\n";
		$script .="});\n";
		$document->addScriptDeclaration($script);
		return JHTML::_('select.genericlist', $cnns , $fullname, 'class="inputbox"', 'value', 'text', $value, $id);
	}
}
?>