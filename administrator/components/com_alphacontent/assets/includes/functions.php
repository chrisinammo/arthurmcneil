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

// no direct access
defined('_JEXEC') or die('Restricted access');

function ac_Jimport ( $lib_path ) {
	$path  = JPATH_ROOT . DS . 'libraries' . DS . str_replace( '.', DS, $lib_path ) . '.php';
	include_once ( $path );
}
?>