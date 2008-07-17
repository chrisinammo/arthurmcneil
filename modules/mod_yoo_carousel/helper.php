<?php
/**
* YOOcarousel Joomla! Module
*
* @version   1.5.3
* @author    yootheme.com
* @copyright Copyright (C) 2007 YOOtheme Ltd. & Co. KG. All rights reserved.
* @license	 GNU/GPL
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

require_once (JPATH_SITE . '/components/com_content/helpers/route.php');

class modYOOcarouselHelper
{
	function renderItem(&$item, &$params, &$access)
	{
		global $mainframe;

		$user 	=& JFactory::getUser();

		$item->text 	= $item->introtext;
		$item->groups 	= '';
		$item->readmore = (trim($item->fulltext) != '');
		$item->metadesc = '';
		$item->metakey 	= '';
		$item->access 	= '';
		$item->created 	= '';
		$item->modified = '';

		if ($params->get('readmore'))
		{
			// Check to see if the user has access to view the full article
			if ($item->access <= $user->get('aid', 0)) {
				$linkOn = JRoute::_(ContentHelperRoute::getArticleRoute($item->slug, $item->catslug, $item->sectionid));
			} else {
				$linkOn = JRoute::_('index.php?option=com_user&task=register');
			}
			$item->linkOn = $linkOn;
		}

		require(JModuleHelper::getLayoutPath('mod_yoo_carousel', '_item'));
	}

	function getList(&$params, &$access)
	{
		global $mainframe;

		$db 	=& JFactory::getDBO();
		$user 	=& JFactory::getUser();
		$aid	= $user->get('aid', 0);

		$catid 	   = (int) $params->get('catid', 0);
		$items 	   = (int) $params->get('items', 0);
		$order 	   = $params->get('order', 'o_asc');

		$contentConfig	= &JComponentHelper::getParams( 'com_content' );
		$noauth			= !$contentConfig->get('shownoauth');

		$nullDate = $db->getNullDate();
		jimport('joomla.utilities.date');
		$date = new JDate();
		$now = $date->toMySQL();

		// Ordering
		switch ($order) {
			case 'm_dsc':
				$ordering = 'a.modified DESC, a.created DESC';
				break;
			case 'h_dsc':
				$ordering = 'a.hits DESC, a.created DESC';
				break;				
			case 'c_dsc':
				$ordering = 'a.created DESC';
				break;
			case 'o_asc':
			default:
				$ordering = 'a.ordering';
				break;
		}

		// Query to determine article count
		$query = 'SELECT a.*,' .
			' CASE WHEN CHAR_LENGTH(a.alias) THEN CONCAT_WS(":", a.id, a.alias) ELSE a.id END as slug,'.
			' CASE WHEN CHAR_LENGTH(cc.name) THEN CONCAT_WS(":", cc.id, cc.name) ELSE cc.id END as catslug'.
			' FROM #__content AS a' .
			' INNER JOIN #__categories AS cc ON cc.id = a.catid' .
			' INNER JOIN #__sections AS s ON s.id = a.sectionid' .
			' WHERE a.state = 1 ' .
			($noauth ? ' AND a.access <= ' .(int) $aid. ' AND cc.access <= ' .(int) $aid. ' AND s.access <= ' .(int) $aid : '').
			' AND (a.publish_up = "'.$nullDate.'" OR a.publish_up <= "'.$now.'" ) ' .
			' AND (a.publish_down = "'.$nullDate.'" OR a.publish_down >= "'.$now.'" )' .
			' AND cc.id = '. $catid .
			' AND cc.section = s.id' .
			' AND cc.published = 1' .
			' AND s.published = 1' .
			' ORDER BY ' . $ordering;
		$db->setQuery($query);
		$rows = $db->loadObjectList();
		if ($order == 'rnd') shuffle($rows);

		return array_slice($rows, 0, $items);
	}
}
