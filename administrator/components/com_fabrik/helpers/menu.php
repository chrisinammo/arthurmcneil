<?php

/**
* @package Joomla
* @subpackage Fabrik
* @copyright Copyright (C) 2005 Rob Clayburn. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/


// no direct access
defined('_JEXEC') or die('Restricted access');

/**
 * Fabrik Component Menu Helper
 *
 * @static
 * @package		Joomla
 * @subpackage	Fanrik
 * @since 1.5
 */

class FabrikHelperMenu
{
	function Links2Menu( $type, $and )
	{
		$db =& JFactory::getDBO();

		$query = 'SELECT * '
		. ' FROM #__menu '
		. ' WHERE type = '.$db->Quote($type)
		. ' AND published = 1'
		. $and
		;
		$db->setQuery( $query );
		$menus = $db->loadObjectList();
		return $menus;
	}
	
	/**
 	 * Legacy function, deprecated
 	 *
 	 * @deprecated	As of version 1.5
 	*/

	function MenuSelect( $name='menuselect', $javascript=NULL )
	{
		$db =& JFactory::getDBO();

		$query = 'SELECT params'
		. ' FROM #__modules'
		. ' WHERE module = "mod_mainmenu"'
		;
		$db->setQuery( $query );
		$menus = $db->loadObjectList();
		$total = count( $menus );
		$menuselect = array();
		$usedmenus = array();
		for( $i = 0; $i < $total; $i++ )
		{
			$registry = new JRegistry();
			$registry->loadINI($menus[$i]->params);
			$params = $registry->toObject( );
			if (!in_array( $params->menutype, $usedmenus )) {
				$menuselect[$i]->value 	= $params->menutype;
				$menuselect[$i]->text 	= $params->menutype;
				$usedmenus[] = $params->menutype;
			}
		}
		// sort array of objects
		JArrayHelper::sortObjects( $menuselect, 'text', 1 );

		$menus = JHTML::_('select.genericlist',   $menuselect, $name, 'class="inputbox" size="10" '. $javascript, 'value', 'text' );

		return $menus;
	}
	
	/**
	 * Link the object item to a menu
	  * @param string fabrik action
	  * @param string fabrik data to passwith action
	 */

	function menuLink( $view = 'table', $linkData = 'tableid=0') {
		$db =& JFactory::getDBO();
		$menu = JRequest::getVar( 'menuselect', '', 'post' );
		$link = JRequest::getVar( 'link_name', '', 'post' );
		$alias = JRequest::getVar( 'alias', $link, 'post' );
		JModel::addIncludePath(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_menus'.DS.'models');
		$model =& JModel::getInstance('Item', 'MenusModel');
		$row =& $model->getItem();
		$row->menutype = $menu;
		$row->name = $link;
		$row->alias = $alias;
		/* was url but this doesnt work with dyamic template swapping on link */
		$row->type = 'component'; 
		
		$row->published = 1;
		$row->link = "index.php?option=com_fabrik&view=$view";
		$sql = "SELECT id FROM #__components WHERE `option` = 'com_fabrik' AND link <> '' AND link IS NOT NULL";
		$db->setQuery( $sql );
		$componentId = $db->loadResult();
		$row->componentid = $componentId;
		$row->params = $linkData;
		$row->ordering = 9999;
		if (!$row->store()) {
			JError::raiseWarning( 500, $row->getError());
			return false;
		}
		$row->checkin();
		$row->reorder("menutype='$row->menutype' ");
		return true;
	}	
}
?>