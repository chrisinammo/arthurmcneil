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

class JElementRepeatTables extends JElement
{
	/**
	* Element name
	*
	* @access	protected
	* @var		string
	*/
	var	$_name = 'RepeatTables';

	function fetchElement($name, $value, &$node, $control_name)
	{
		$db			= & JFactory::getDBO();
		$document =& JFactory::getDocument();
		$query = "SELECT id AS value, label AS `$name` FROM #__fabrik_tables order by value DESC";
		$db->setQuery($query);
		$newname = trim($name, "[]");
		$list =  JHTML::_('select.genericlist',  $db->loadObjectList(), ''.$control_name.'['.$newname.'][]', 'class="repeattable inputbox"', 'value', $name, $value, $control_name.$name);
		$list = "<div id='" . $control_name.$name . "_container'>" . $list . "</div>";
		if( $this->_array_counter == 0){
			$link = "<a id='$newname" . "_link' onclick='return duplicateRepeatTable(this);' href='#'>" . JText::_('Add') . "</a><br />";
			$list = $link . $list;
			$script = "
	function duplicateRepeatTable(a){
		var id = a.id.replace('_link', '');
		var container =  $('". $control_name.$name."_container');
		var dd  = container.getElement('select');
		var html = new Element('div').adopt([
			dd.clone(),
			new Element('a', {'href':'#','class':'removeButton', 'onclick':'return removeRepeatTableRow(this)'}).appendText('[-]')
		]);
		html.injectInside(container);
		return false;
	}
	
	function removeRepeatTableRow(a){
		a.getParent().remove();
		return false;
	}
	";
		
			$document->addScriptDeclaration($script);
		}
		if( $this->_array_counter != 0){
			$list .= "<a href='#' class='removeButton' onclick='return removeRepeatTableRow(this)'>[-]</a>";	
		}
		return $list ;
	}
}