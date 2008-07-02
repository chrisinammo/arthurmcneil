<?php
/**
* Alternative flexible Login-Module 1.0b
* $Id: mod_signallogin.php 100 2008-02-17 14:36:00 chris $
*
* @version 1.0 Beta
* @copyright (C) 2008 Chris Schafflinger
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

// Include the syndicate functions only once
require_once (dirname(__FILE__).DS.'helper.php');

$params->def('greeting', 1);

$type 	= modSignalLoginHelper::getType();
$return	= modSignalLoginHelper::getReturnURL($params, $type);

$user =& JFactory::getUser();

require(JModuleHelper::getLayoutPath('mod_signallogin'));