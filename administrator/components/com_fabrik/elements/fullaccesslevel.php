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
class JElementFullaccesslevel extends JElement
{
	/**
	 * Element name
	 * @access	protected
	 * @var		string
	 */
	var	$_name = 'Fullaccesslevel';

	function fetchElement($name, $value, &$node, $control_name)
	{
		$acl 	=& JFactory::getACL();
		$gtree = $acl->get_group_children_tree( null, 'USERS', false );
		$optAll = array(JHTML::_('select.option', '0', ' - Everyone'), JHTML::_('select.option', "26", 'Nobody' ));
		$gtree2 = array_merge( $optAll, $gtree );
		return JHTML::_('select.genericlist',  $gtree2, $control_name.'['.$name.']', 'class="inputbox" size="1"', 'value', 'text', $value   );
	}
}