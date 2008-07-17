<?php 
/*
**********************************************
JCal Pro v1.5.3
Copyright (c) 2006-2007 Anything-Digital.com
**********************************************
JCal Pro is a fork of the existing Extcalendar component for Joomla!
(com_extcal_0_9_2_RC4.zip from mamboguru.com). 
Extcal (http://sourceforge.net/projects/extcal) was renamed 
and adapted to become a Mambo/Joomla! component by 
Matthew Friedman, and further modified by David McKinnis
(mamboguru.com) to repair some security holes. 

This program is free software; you can redistribute it and/or modify 
it under the terms of the GNU General Public License as published by 
the Free Software Foundation; either version 2 of the License, or 
(at your option) any later version.

This header must not be removed. Additional contributions/changes
may be added to this header as long as no information is deleted.
**********************************************

$File: config.inc.php - Config options$

Revision date: 03/07/2007

**********************************************
Get the latest version of JCal Pro at:
http://dev.anything-digital.com//
**********************************************
*/

/** ensure this file is being included by a parent file */
defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );

global $mainframe, $Itemid, $session, $CONFIG_EXT, $THEME_DIR, $REFERER, $ME;
global $template_header, $template_footer, $meta_content, $lang_general, $show_main_menu;
global $lang_event_admin_data, $event_mode, $lang_info, $lang_system, $upgrade_detected, $lang_generalm;
global $lang_monthly_event_view, $lang_date_format, $event_icons, $template_monthly_view, $todayclr, $cat_id;
global $lang_event_search_data, $sundayclr, $weekdayclr, $todayclrHl, $weekdayclrHl, $sundayclrHl;
global $template_main_menu, $lang_main_menu, $template_add_event_form, $errors, $today, $lang_daily_event_view;
global $lang_weekly_event_view, $lang_flat_event_view, $template_search_results, $lang_event_search_data;
global $template_search_form, $template_cat_form, $template_caption_dialog, $template_event_view, $lang_event_view, $lang_add_event_view, $extmode;
global $zone_stamp, $template_mini_cal_view, $lang_mini_cal, $info_data, $picture, $cats_limit, $extcal_code_insert;
global $lang_cats_view, $template_cats_list, $lang_cat_events_view, $next_recurrence_stamp, $Itemid_Querystring, $template_cat_events_list;
global $template_error_string;

$database = &JFactory::getDBO();
$my = &JFactory::getUser();
$registry = &JFactory::getConfig();

if ( !defined('USER_IS_ADMIN') ) define('USER_IS_ADMIN',((($my->usertype == 'Administrator') || ($my->usertype == 'Super Administrator')) ? true : false));
if ( !defined('USER_IS_LOGGED_IN') ) define('USER_IS_LOGGED_IN',!($my->usertype == ''));

// Set initial debug level
error_reporting (E_ALL ^ E_NOTICE);
$DB_DEBUG = true;

// define application constants
define('CONFIG_FILE_INCLUDED', true);

define('EXTCALENDAR_CONFIG_SET', true);

define('CALENDAR_NAME', 'ExtCalendar');
define('CALENDAR_VERSION', '1.5');

define('TEMPLATE_FILE', 'template.html');

// Start buffering
ob_start();

// unescape special characters if enabled by default.
if (get_magic_quotes_gpc()) {
	function stripslashes_deep($value)
	{
		$char_array = array('"' => '&quot;', '<' => '&lt;', '>' => '&gt;');

		$value = is_array($value) ?array_map('stripslashes_deep', $value) : strtr(stripslashes($value), $char_array);
		return $value;
	}
	$_POST = array_map('stripslashes_deep', $_POST);
	$_GET = array_map('stripslashes_deep', $_GET);

}


$temp_path = get_fspath(isset($_SERVER['PATH_TRANSLATED'])?$_SERVER['PATH_TRANSLATED']:$_SERVER['SCRIPT_FILENAME']);

// Initialise the $CONFIG_EXT array and some other variables
$CONFIG_EXT = array();

// DB TABLE NAMES PREFIX
$CONFIG_EXT['TABLE_PREFIX'] =  "#__jcalpro_";

// FS configuration
$CONFIG_EXT['FS_PATH'] = JPATH_BASE . "/components/com_jcalpro/";        // Your file system path
$CONFIG_EXT['calendar_url'] = JURI::root() . "components/com_jcalpro/";        // Your calendar web url

if (isset($Itemid) && ($Itemid != 0)) { $CONFIG_EXT['Itemid'] = intval($Itemid); }
else {
  $CONFIG_EXT['Itemid'] = JRequest::getVar( 'Itemid', false, $_REQUEST );
  if (!$CONFIG_EXT['Itemid']) {
    $database->setQuery("SELECT MAX(id) FROM #__menu WHERE link LIKE '%index.php?option=$com_jcalpro%' AND published <> '-2'");
	$CONFIG_EXT['Itemid'] = $database->loadResult();
  }
}
$Itemid_Querystring = $CONFIG_EXT['Itemid'] ? '&Itemid='.$CONFIG_EXT['Itemid'] : '';
$CONFIG_EXT['calendar_calling_page'] = "index.php?option=" . $option . $Itemid_Querystring;

require_once $CONFIG_EXT['FS_PATH']."include/functions.inc.php";
require_once $CONFIG_EXT['FS_PATH']."include/dblib.php";
require_once $CONFIG_EXT['FS_PATH']."lib/event.inc.php";

$REFERER = get_referer();

// File system paths
$CONFIG_EXT['UPLOAD_DIR'] = $CONFIG_EXT['FS_PATH']."upload/";
$CONFIG_EXT['UPLOAD_DIR_URL'] = $CONFIG_EXT['calendar_url']."upload/";
$CONFIG_EXT['MINI_PICS_DIR'] = $CONFIG_EXT['FS_PATH']."images/minipics/";
$CONFIG_EXT['MINI_PICS_URL'] = $CONFIG_EXT['calendar_url']."images/minipics/";
$CONFIG_EXT['LIB_DIR'] = $CONFIG_EXT['FS_PATH']."lib/";
$CONFIG_EXT['PLUGINS_DIR'] = $CONFIG_EXT['FS_PATH']."plugins/";
$CONFIG_EXT['LANGUAGES_DIR'] = $CONFIG_EXT['FS_PATH']."languages/";
$CONFIG_EXT['THEMES_DIR'] = $CONFIG_EXT['FS_PATH']."themes/";

// Database definitions
$CONFIG_EXT['TABLE_CATEGORIES'] = $CONFIG_EXT['TABLE_PREFIX'] . "categories";
$CONFIG_EXT['TABLE_GROUPS'] = $CONFIG_EXT['TABLE_PREFIX'] . "groups";
$CONFIG_EXT['TABLE_USERS'] = $CONFIG_EXT['TABLE_PREFIX'] . "users";
$CONFIG_EXT['TABLE_EVENTS'] = $CONFIG_EXT['TABLE_PREFIX'] . "events";
$CONFIG_EXT['TABLE_EXCLUSIONS'] = $CONFIG_EXT['TABLE_PREFIX'] . "exclusions";
$CONFIG_EXT['TABLE_CONFIG'] = $CONFIG_EXT['TABLE_PREFIX'] . "config";
$CONFIG_EXT['TABLE_TEMPLATES'] = $CONFIG_EXT['TABLE_PREFIX'] . "templates";
$CONFIG_EXT['TABLE_PLUGINS'] = $CONFIG_EXT['TABLE_PREFIX'] . "plugins";

// Retrieve DB stored configuration
$results = extcal_db_query("SELECT * FROM {$CONFIG_EXT['TABLE_CONFIG']}");
while ($row = extcal_db_fetch_array($results)) {
    $CONFIG_EXT[$row['name']] = $row['value'];
} // while
extcal_db_free_result($results);

// Other $CONFIG_EXT vars
$CONFIG_EXT['app_name'] = $CONFIG_EXT['calendar_name']; // The Mambo sitename where your calendar lives
// get current version info

if(!isset($CONFIG_EXT['release_version'])) {
	//$CONFIG_EXT['release_name'] = '1.0';
	//$CONFIG_EXT['release_version'] = "1.0";
	//$CONFIG_EXT['release_type'] = '';
}

if(!isset($CONFIG_EXT['calendar_status'])) $CONFIG_EXT['calendar_status'] = 1;

// Set error logging level
if ($CONFIG_EXT['debug_mode']) {
	error_reporting (E_ALL);
	$DB_DEBUG = true;
}

$database->setQuery( "SELECT name FROM #__jcalpro_themes WHERE published= '1'" );
$themeName = $database->loadResult();

$CONFIG_EXT['theme'] = $themeName;

if (!file_exists($CONFIG_EXT['FS_PATH']."themes/{$CONFIG_EXT['theme']}/theme.php")) $CONFIG_EXT['theme'] = 'default';

$jcalcssurl = $CONFIG_EXT['calendar_url']."themes/{$CONFIG_EXT['theme']}/style.css";

$jcalcssfile = $CONFIG_EXT['FS_PATH']."themes/{$CONFIG_EXT['theme']}/style.css";

if (file_exists($jcalcssfile)) $mainframe->addCustomHeadTag("<link href='{$jcalcssurl}' rel='stylesheet' type='text/css' />");



require_once $CONFIG_EXT['FS_PATH']."themes/{$CONFIG_EXT['theme']}/theme.php";
$THEME_DIR = $CONFIG_EXT['calendar_url']."themes/{$CONFIG_EXT['theme']}";

//$CONFIG_EXT['lang'] = $mainframe->getCfg('lang');
$legacy_lang = &JFactory::getLanguage();
$CONFIG_EXT['lang'] = $legacy_lang->getBackwardLang();
if (!file_exists($CONFIG_EXT['LANGUAGES_DIR']."{$CONFIG_EXT['lang']}/index.php")) $CONFIG_EXT['lang'] = 'english';
require_once $CONFIG_EXT['LANGUAGES_DIR']."{$CONFIG_EXT['lang']}/index.php";

// Localizing time
setlocale(LC_ALL,$lang_info['locale']);
$zone_stamp = extcal_get_local_time();
$today = ucwords(strftime ($lang_date_format['full_date'], $zone_stamp));
// e.g. Wednesday, June 05, 2002

// load main template
load_template();

// some settings of vars
$extmode = JRequest::getVar( 'extmode', '', $_REQUEST );
$event_mode = JRequest::getVar( 'event_mode', '', $_REQUEST );
$extid = JRequest::getVar( 'extid', '', $_REQUEST );
if ($extid != '') {
	$extid = intval($extid);
}

$event_id = JRequest::getVar( 'event_id', $extid, $_REQUEST );
$cat_id = JRequest::getVar( 'cat_id', '', $_REQUEST);
if ($cat_id != '') {
	$cat_id = intval($cat_id);
}
$extcal_search = $database->getEscaped(JRequest::getVar( 'extcal_search', '', $_POST));

// Initialize time variables with today's date
$m = (int)date("n", extcal_get_local_time()); // Numeric representation of a month, without leading zeros
$y = (int)date("Y", extcal_get_local_time()); 
$d = (int)date("j", extcal_get_local_time()); // Day of the month without leading zeros

$today = array(
	'day' => $d,
	'month' => $m,
	'year' => $y
);
// initialise the date variable 
if(isset($_REQUEST['date'])) {
	list($year, $month, $day) = split('[:-]', $_REQUEST['date']); // split at a slash, dot, or hyphen.
	$date = array(
		'day' => (int)$day,
		'month' => (int)$month,
		'year' => (int)$year
	);
} else {
	$date = array(
		'day' => (int)$today['day'],
		'month' => (int)$today['month'],
		'year' => (int)$today['year']
	);
} 

/* Set rights */

/*$acl->_mos_add_acl( 'content', 'add', 'users', $CONFIG_EXT['who_can_add_events'], 'calendar', 'all' );
$acl->_mos_add_acl( 'content', 'edit', 'users', $CONFIG_EXT['who_can_edit_events'], 'calendar', 'all' );
$acl->_mos_add_acl( 'content', 'delete', 'users', $CONFIG_EXT['who_can_delete_events'], 'calendar', 'all' );
$acl->_mos_add_acl( 'content', 'approve', 'users', $CONFIG_EXT['who_can_approve_events'], 'calendar', 'all' );
*/

/* Right for add */

/*$addChilds = ( $acl->get_group_children_tree( '', $CONFIG_EXT['who_can_add_events'], false ) );

if ( $CONFIG_EXT['who_can_add_events'] == 'registered' OR $CONFIG_EXT['who_can_add_events'] == 'author' OR $CONFIG_EXT['who_can_add_events'] == 'editor' OR $CONFIG_EXT['who_can_add_events'] == 'publisher' )
{
	$addChilds = array_merge ( $addChilds, $acl->get_group_children_tree ( '', 'public backend', false ) );
}

foreach ( $addChilds AS $addChildsKey => $addChildsValue )
{
	$addChilds[$addChildsKey]->text = str_replace ( "&nbsp;", "", $addChilds[$addChildsKey]->text );
	$addChilds[$addChildsKey]->text = str_replace ( "-", "", $addChilds[$addChildsKey]->text );
	$addChilds[$addChildsKey]->text = str_replace ( ".", "", $addChilds[$addChildsKey]->text );
	
	$addChilds[$addChildsKey]->text =	strtolower ( $addChilds[$addChildsKey]->text );

	$acl->_mos_add_acl( 'content', 'add', 'users', $addChilds[$addChildsKey]->text, 'calendar', 'all' );
}
/*

/* Right for edit */

/*$editChilds = ( $acl->get_group_children_tree( '', $CONFIG_EXT['who_can_edit_events'], false ) );

if ( $CONFIG_EXT['who_can_edit_events'] == 'registered' OR $CONFIG_EXT['who_can_edit_events'] == 'author' OR $CONFIG_EXT['who_can_edit_events'] == 'editor' OR $CONFIG_EXT['who_can_edit_events'] == 'publisher' )
{
	$editChilds = array_merge ( $editChilds, $acl->get_group_children_tree ( '', 'public backend', false ) );
}

foreach ( $editChilds AS $editChildsKey => $editChildsValue )
{
	$editChilds[$editChildsKey]->text = str_replace ( "&nbsp;", "", $editChilds[$editChildsKey]->text );
	$editChilds[$editChildsKey]->text = str_replace ( "-", "", $editChilds[$editChildsKey]->text );
	$editChilds[$editChildsKey]->text = str_replace ( ".", "", $editChilds[$editChildsKey]->text );
	
	$editChilds[$editChildsKey]->text =	strtolower ( $editChilds[$editChildsKey]->text );

	$acl->_mos_add_acl( 'content', 'edit', 'users', $editChilds[$editChildsKey]->text, 'calendar', 'all' );
}
*/

/* Right for delete */

/*$deleteChilds = ( $acl->get_group_children_tree( '', $CONFIG_EXT['who_can_delete_events'], false ) );

if ( $CONFIG_EXT['who_can_delete_events'] == 'registered' OR $CONFIG_EXT['who_can_delete_events'] == 'author' OR $CONFIG_EXT['who_can_delete_events'] == 'editor' OR $CONFIG_EXT['who_can_delete_events'] == 'publisher' )
{
	$deleteChilds = array_merge ( $deleteChilds, $acl->get_group_children_tree ( '', 'public backend', false ) );
}

foreach ( $deleteChilds AS $deleteChildsKey => $deleteChildsValue )
{
	$deleteChilds[$deleteChildsKey]->text = str_replace ( "&nbsp;", "", $deleteChilds[$deleteChildsKey]->text );
	$deleteChilds[$deleteChildsKey]->text = str_replace ( "-", "", $deleteChilds[$deleteChildsKey]->text );
	$deleteChilds[$deleteChildsKey]->text = str_replace ( ".", "", $deleteChilds[$deleteChildsKey]->text );
	
	$deleteChilds[$deleteChildsKey]->text =	strtolower ( $deleteChilds[$deleteChildsKey]->text );

	$acl->_mos_add_acl( 'content', 'delete', 'users', $deleteChilds[$deleteChildsKey]->text, 'calendar', 'all' );
}
*/

/* Right for approve */

/*$approveChilds = ( $acl->get_group_children_tree( '', $CONFIG_EXT['who_can_approve_events'], false ) );

if ( $CONFIG_EXT['who_can_approve_events'] == 'registered' OR $CONFIG_EXT['who_can_approve_events'] == 'author' OR $CONFIG_EXT['who_can_approve_events'] == 'editor' OR $CONFIG_EXT['who_can_approve_events'] == 'publisher' )
{
	$approveChilds = array_merge ( $approveChilds, $acl->get_group_children_tree ( '', 'public backend', false ) );
}

foreach ( $approveChilds AS $approveChildsKey => $approveChildsValue )
{
	$approveChilds[$approveChildsKey]->text = str_replace ( "&nbsp;", "", $approveChilds[$approveChildsKey]->text );
	$approveChilds[$approveChildsKey]->text = str_replace ( "-", "", $approveChilds[$approveChildsKey]->text );
	$approveChilds[$approveChildsKey]->text = str_replace ( ".", "", $approveChilds[$approveChildsKey]->text );
	
	$approveChilds[$approveChildsKey]->text =	strtolower ( $approveChilds[$approveChildsKey]->text );

	$acl->_mos_add_acl( 'content', 'approve', 'users', $approveChilds[$approveChildsKey]->text, 'calendar', 'all' );
}
*/

function setRights ( $action, $section, $usergroup )
{
    
    $my = & JFactory::getUser();
    $acl = & JFactory::getACL();
	
	if ( trim ( $usergroup ) == "" )
	{
		$usergroup = 'public frontend';
	}
	
	$acl->_mos_add_acl( 'content', $action, 'users', $usergroup, $section, 'all' );
		
	//$childs = ( $acl->get_group_children_tree( '', $usergroup, false ) );
    $childs = $acl->get_group_children_tree( '', $usergroup, true, true );
		
	if ( $usergroup == 'public frontend' OR $usergroup == 'registered' OR $usergroup == 'author' OR $usergroup == 'editor' OR $usergroup == 'publisher' )
	{	
		//$childs = array_merge ( $childs, $acl->get_group_children_tree ( '', 'public backend', false ) );
        $childs = array_merge ( $childs, $acl->get_group_children_tree ( '', 'public backend', true, true ) );
	}
		
	foreach ( $childs AS $childsKey => $childsValue )
	{	
		$childs[$childsKey]->text = str_replace ( "&nbsp;", "", $childs[$childsKey]->text );
		$childs[$childsKey]->text = str_replace ( "-", "", $childs[$childsKey]->text );
		$childs[$childsKey]->text = str_replace ( ".", "", $childs[$childsKey]->text );
		
		$childs[$childsKey]->text =	strtolower ( $childs[$childsKey]->text );
		
		$acl->_mos_add_acl( 'content', $action, 'users', $childs[$childsKey]->text, $section, 'all' );
	}
}

setRights ( 'add', 'calendar', $CONFIG_EXT['who_can_add_events'] );
setRights ( 'edit', 'calendar', $CONFIG_EXT['who_can_edit_events'] );
setRights ( 'delete', 'calendar', $CONFIG_EXT['who_can_delete_events'] );
setRights ( 'approve', 'calendar', $CONFIG_EXT['who_can_approve_events'] );

$query = "
  SELECT
  	cat_id, level
  FROM
  	#__jcalpro_categories
";  
  
$database->setQuery( $query );
$allCategories = $database->loadObjectList();

foreach ( $allCategories AS $allCategory )
{
	setRights ( 'category' . $allCategory->cat_id, 'calendar', $allCategory->level );
}

function get_fspath($fs_path) {
// function to format the fs path correctly (paths end with a trail "/")
	$fs_path=preg_split("/[\/\\\]/", dirname($fs_path));

	// just in case $fs_path equals "//"
	$fs_path = ereg_replace("//","/",join('/',$fs_path)."/");
	return $fs_path;
}

define('EXTCAL_TEXT_ALL_DAY',$lang_add_event_view['all_day_label']);

?>
