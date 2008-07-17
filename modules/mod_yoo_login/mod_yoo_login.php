<?php
/**
* YOOlogin Joomla! Module
*
* @author    yootheme.com
* @copyright Copyright (C) 2007 YOOtheme Ltd. & Co. KG. All rights reserved.
* @license	 GNU/GPL
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

// count instances
if (!isset($GLOBALS['yoo_logins'])) {
	$GLOBALS['yoo_logins'] = 1;
} else {
	$GLOBALS['yoo_logins']++;
}

// Include the syndicate functions only once
require_once (dirname(__FILE__).DS.'helper.php');

$params->def('greeting', 1);

$type 	= modYOOloginHelper::getType();
$return	= modYOOloginHelper::getReturnURL($params, $type);

$user =& JFactory::getUser();

// init vars
$style                 = $params->get('style', 'default');
$pretext               = $params->get('pretext', '');
$posttext              = $params->get('posttext', '');
$text_mode             = $params->get('text_mode', 'input');
$login_button          = $params->get('login_button', 'icon');
$logout_button         = $params->get('logout_button', 'text');
$auto_remember         = $params->get('auto_remember', '1');
$lost_password         = $params->get('lost_password', '1');
$lost_username         = $params->get('lost_username', '1');
$registration          = $params->get('registration', '1');

// css parameters
$yoologin_id           = $GLOBALS['yoo_logins'];

$module_base           = JURI::base() . 'modules/mod_yoo_login/';

if ($style == 'quick') {
	require(JModuleHelper::getLayoutPath('mod_yoo_login', 'quick'));
} else {
	require(JModuleHelper::getLayoutPath('mod_yoo_login', 'default'));
}

$document =& JFactory::getDocument();
$document->addStyleSheet($module_base . 'mod_yoo_login.css.php');