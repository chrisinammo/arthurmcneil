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
 * Renders a repeating drop down list of tables
 *
 * @author 		Rob Clayburn 
 * @package 	Joomla
 * @subpackage		Fabrik
 * @since		1.5
 */

class JElementFabriktables extends JElement
{
	/**
	* Element name
	*
	* @access	protected
	* @var		string
	*/
	var	$_name = 'Fabriktables';
	
	var $_array_counter = null;
	
	function fetchElement( $name, $value, &$node, $control_name )
	{
		JHTML::script( 'fabriktables.js', 'administrator/components/com_fabrik/elements/', true );
		$connectionDd = $node->attributes( 'observe', '' );
		$db			= & JFactory::getDBO();
		$document =& JFactory::getDocument();
		$repeat = false;
		if(isset($this->_parent->_group)){
			$group = $this->_parent->_group;
			//echo "<pre>";
			//$repeat = $this->_parent->_xml[$group]->_attributes['repeat'];
			$repeat = $this->_parent->_xml[$group]->attributes('repeat');
		}
		if (strstr( $name, "[]" )) {
			$name = trim($name, "[]");
			$fullname = $control_name.'['.$name."][]";
		} else {
			$fullname = $control_name.'['.$name.']';
		}
		$script = '';
		if ($connectionDd == '') {
			//we are not monitoring a connection drop down so load in all tables
			$query = "SELECT id AS value, label AS `$name` FROM #__fabrik_tables order by value DESC";
			$db->setQuery( $query );
			$rows = $db->loadObjectList();
		} else {
			$rows = array( JHTML::_('select.option', '', JText::_( 'Select a connection first'), 'value', $name));	
		}

		$id = (is_null( $this->_array_counter )) ?  $control_name.$name :  $control_name.$name . '-' . $this->_array_counter;
		
		if ($connectionDd != '') {
			$script .= "window.addEvent('domready', function(){\n";
			$script .= "tableElements = \$H();\n";
			$script .= 	"tableElements.set('$id', new fabriktablesElement( '$id', {
				'livesite':'".COM_FABRIK_LIVESITE."',
				'conn':'params" .$connectionDd . "',
				'value':'$value',
				'repeat':'$repeat'
			}));\n";
			$script .="});\n";
		}
	
		if ($script != '') {
			$document->addScriptDeclaration($script);
		}
		
		$str = '';
		$str = JHTML::_('select.genericlist',  $rows, $fullname, 'class="repeattable inputbox"', 'value', $name, $value, $id ); 
		return $str;
	}

}