<?php
/**
* @package Joomla
* @subpackage Fabrik
* @copyright Copyright (C) 2005 Rob Clayburn. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/


// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

/**
 * Renders a list of elements found in the current group
 *
 * @package 	Joomla
 * @subpackage	Articles
 * @since		1.5
 */
class JElementSpecificordering extends JElement
{
	/**
	 * Element name
	 * @access	protected
	 * @var		string
	 */
	var	$_name = 'Specificordering';

	function fetchElement($name, $value, &$node, $control_name)
	{
		//ONLY WORKS INSIDE ELEMENT :( 
		$group_id = $this->_parent->get( 'group_id' );
			$query = "SELECT ordering AS value, name AS text".
			"\n FROM #__fabrik_elements ".
			"\n WHERE group_id = '$group_id'".
			"\n AND state >= 0"."\n ORDER BY ordering";
			
			$id = $this->_parent->get( 'id' );
		$db =& JFactory::getDBO();
		$neworder = 0;
		if ( $id ) {
			$order = JHTML::_('list.genericordering',  $query );
			$ordering = JHTML::_('select.genericlist',   $order, $control_name.'['.$name.']', 'class="inputbox" size="1"', 'value', 'text', ( $value ) );
		} else {
			if ( $neworder ) {
				$text = JText::_( 'descNewItemsFirst' );
			} else {
				$text = JText::_( 'descNewItemsLast' );
			}
			$ordering = '<input type="hidden" name="' . $control_name.'['.$name.']' . '" value="'. $value .'" />'. $text;
		}
		return $ordering;
	}
}