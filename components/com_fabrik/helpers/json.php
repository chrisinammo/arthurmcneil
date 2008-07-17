<?php
/**
* @package Joomla
* @subpackage Fabrik
* @copyright Copyright (C) 2005 Rob Clayburn. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

//echo phpversion();
if (version_compare( phpversion(), '5.2' ) < 0) {
	require_once(COM_FABRIK_FRONTEND.DS.'helpers'.DS.'json4.php');
} else {
	require_once(COM_FABRIK_FRONTEND.DS.'helpers'.DS.'json52.php');
}
require_once(COM_FABRIK_FRONTEND.DS.'helpers'.DS.'pear-json.php');
?>