<?php 
/*
 * @package Joomla 1.5
 * @copyright Copyright (C) 2005 Open Source Matters. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 *
 * @component AlphaContent
 * @copyright Copyright (C) 2008 Bernard Gilly
 * @license : DonationWare
 * @Website : http://www.alphaplug.com
 */
defined('_JEXEC') or die('Restricted access');

function com_uninstall() {
	global $mainframe;
	
	$db	=& JFactory::getDBO(); 
	
	// uninstall plugin
	$query = "DELETE FROM #__plugins WHERE element LIKE 'alphacontent'";
	$db->setQuery( $query );
	$db->query();
	
	@unlink( JPATH_PLUGINS.DS.'content'.DS.'alphacontent.php' );
	@unlink( JPATH_PLUGINS.DS.'content'.DS.'alphacontent.xml' );	
	
	return true;
}

?>