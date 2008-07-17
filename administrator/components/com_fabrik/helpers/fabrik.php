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
 * Fabrik Component Helper
 *
 * @static
 * @package		Joomla
 * @subpackage	Fabrik
 * @since 1.5
 */
class FabrikHelperFabrik
{
	
	/**
	 * prepare the publish down date for saving
	 * @param string publish down date
	 */

	function publishDown( &$publish_down ){
		$db =& JFactory::getDBO();
		$nullDate	= $db->getNullDate();
		$config =& JFactory::getConfig();
		$tzoffset = $config->getValue( 'config.offset' );
		// Handle never unpublish date
		if (trim($publish_down) == JText::_('Never') || trim( $publish_down ) == '')
		{
			$publish_down = $nullDate;
		}
		else
		{
			if (strlen(trim( $publish_down )) <= 10) {
				$publish_down .= ' 00:00:00';
			}
			$date =& JFactory::getDate( $publish_down, $tzoffset );
			$publish_down = $date->toMySQL();
		}
	//	return $publish_down;
	}
}
?>