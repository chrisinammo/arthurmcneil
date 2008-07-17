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
 * Renders a list of groups
 *
 * @author 		Rob Clayburn 
 * @package 	Joomla
 * @subpackage		Fabrik
 * @since		1.5
 */

class JElementGroupList extends JElement
{
	/**
	* Element name
	*
	* @access	protected
	* @var		string
	*/
	var	$_name = 'Grouplist';
	
	
	function fetchElement( $name, $value, &$node, $control_name )
	{
		global $mainframe;
		if ($value == '') {
			$value 		= $mainframe->getUserStateFromRequest( 'com_fabrik.element.list.filter_groupId', 'filter_groupId', $value );
		}
		$db			= & JFactory::getDBO();
		$db->setQuery( "SELECT id AS value, name AS `group_id` FROM #__fabrik_groups ORDER BY name" );
		$select =  JHTML::_('select.option','', JText::_( 'Please select' ), 'value', 'group_id');
		$rows = array_merge(array($select), $db->loadObjectList());
		return JHTML::_('select.genericlist',  $rows, $control_name.'['.$name.']', 'class="inputbox"  size="1"' , 'value', 'group_id', $value ); 
	}

}