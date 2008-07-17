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
 * Renders a list of elements found in a fabrik table
 *
 * @package 	Joomla
 * @subpackage	Articles
 * @since		1.5
 */
class JElementPluginlist extends JElement
{
	/**
	 * Element name
	 * @access	protected
	 * @var		string
	 */
	
	var	$_name = 'Pluginlist';

	function fetchElement($name, $value, &$node, $control_name)
	{
		$a = array( JHTML::_('select.option', '', JText::_( 'Please select' ) ) );
		$db =& JFactory::getDBO();
		$group = $node->attributes('plugin');
		$db->setQuery( "SELECT name AS value, label AS text FROM #__fabrik_plugins WHERE type='$group' AND state ='1' ORDER BY text" );
		$elementstypes = $db->loadObjectList( );
		$elementstypes = array_merge( $a, $elementstypes );
		return JHTML::_('select.genericlist',  $elementstypes, $control_name.'['.$name.']', 'class="inputbox elementtype"  size="1"' , 'value', 'text', $value );
	}
}