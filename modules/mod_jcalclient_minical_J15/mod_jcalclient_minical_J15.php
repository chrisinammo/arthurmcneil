<?php 
/*
**********************************************
JCal Client v1.6.x
Copyright (c) 2006-2007 Anything-Digital.com
**********************************************
JCal Client is a fork of the existing Extcalendar component for Joomla! and Mambo.
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

* Minical Module
*
* Revision date: 2-Nov-2007
*
* Module for displaying a monthly minicalender in connection with the JCal Pro
* component, The component must be installed before this module will work. 
* There are some options for this module, which can be set in the 
* "Parameters" section of the module in Administration.
*

**********************************************
Get the latest version of JCal Pro at:
http://dev.anything-digital.com//
**********************************************
*/

/** ensure this file is being included by a parent file */
defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );
if ( !defined('USER_IS_ADMIN') ) define('USER_IS_ADMIN',((($my->usertype == 'Administrator') || ($my->usertype == 'Super Administrator')) ? true : false));
if ( !defined('USER_IS_LOGGED_IN') ) define('USER_IS_LOGGED_IN',!($my->usertype == ''));

global $CONFIG_EXT, $zone_stamp, $today, $template_mini_cal_view, $ME, $THEME_DIR, $lang_mini_cal, $lang_system, $info_data, $picture, $lang_info;
global $lang_general, $lang_date_format, $event_icons, $todayclr, $cat_id, $cats_limit, $extcal_code_insert; 
$jconfig = &JFactory::getConfig();
$mosConfig_locale = $jconfig->getValue('config.language');
$legacy_lang = &JFactory::getLanguage();
$mosConfig_lang = $legacy_lang->getBackwardLang();
$mosConfig_live_site = JURI::root();

$database = &JFactory::getDBO();

$option = "com_jcalpro";
require_once( JPATH_BASE . DS . "components" . DS . "com_jcalpro" . DS . "config.inc.php" );

#------------------------START necessary stuff from config.inc.php

if (!defined('EXTCALENDAR_CONFIG_SET')) {

	define('EXTCALENDAR_CONFIG_SET', true);

	// Initialise the $CONFIG_EXT array and some other variables
	$CONFIG_EXT = array();
	
	// DB TABLE NAMES PREFIX
	$CONFIG_EXT['TABLE_PREFIX'] =  "#__jcalpro_";
	
	// Database definitions
	$CONFIG_EXT['TABLE_CALENDARS'] = $CONFIG_EXT['TABLE_PREFIX'] . "calendars";
	$CONFIG_EXT['TABLE_CATEGORIES'] = $CONFIG_EXT['TABLE_PREFIX'] . "categories";
	$CONFIG_EXT['TABLE_GROUPS'] = $CONFIG_EXT['TABLE_PREFIX'] . "groups";
	$CONFIG_EXT['TABLE_USERS'] = $CONFIG_EXT['TABLE_PREFIX'] . "users";
	$CONFIG_EXT['TABLE_EVENTS'] = $CONFIG_EXT['TABLE_PREFIX'] . "events";
	$CONFIG_EXT['TABLE_CONFIG'] = $CONFIG_EXT['TABLE_PREFIX'] . "config";
	$CONFIG_EXT['TABLE_TEMPLATES'] = $CONFIG_EXT['TABLE_PREFIX'] . "templates";
	$CONFIG_EXT['TABLE_PLUGINS'] = $CONFIG_EXT['TABLE_PREFIX'] . "plugins";

	// FS configuration
	$CONFIG_EXT['FS_PATH'] = $mosConfig_absolute_path . "/components/com_jcalpro/";        // Your file system path
	$CONFIG_EXT['calendar_url'] = $mosConfig_live_site . "components/com_jcalpro/";        // Your calendar web url
	$CONFIG_EXT['calendar_calling_page'] = "index.php?option=com_jcalpro";  // Your calendar web url
	
	require_once $CONFIG_EXT['FS_PATH']."include/dblib.php";
	require_once $CONFIG_EXT['FS_PATH']."lib/event.inc.php";
	
	// Retrieve DB stored configuration
	$results = extcal_db_query("SELECT * FROM {$CONFIG_EXT['TABLE_CONFIG']}");
	while ($row = extcal_db_fetch_array($results)) {
		$CONFIG_EXT[$row['name']] = $row['value'];
	} // while
	extcal_db_free_result($results);
	
}

// Retrieve the calendar id from the name given as module parameter
$calname = $params->get('calendar', '');
$calid = 0;
if(!empty($calname)) {
  $query = "SELECT cal_id FROM ".$CONFIG_EXT['TABLE_CALENDARS']." WHERE cal_name='$calname'";
  $database->setQuery( $query );
  $rows = $database->loadObjectList();
  $calid = $rows[0]->cal_id;
}

/* Event categories to display */
$cat_id = $params->get('categories', '');
$cats_limit = $params->get('limit_categories', '');

/* new in 1.5.0.2 */
$use_specific_itemid = intval($params->get('use_specific_itemid'));
if ($use_specific_itemid)
{
	$specific_itemid_mini = trim($params->get('specific_itemid_mini'));
	if ($specific_itemid_mini == "")
	{
		$database->setQuery("SELECT MAX(id) FROM #__menu WHERE link LIKE '%index.php?option=com_jcalpro%' AND published <> '-2' AND componentid > 0");
		$specific_itemid_mini = $database->loadResult();
	}
	$CONFIG_EXT['calendar_calling_page'] = "index.php?option=com_jcalpro&Itemid=";
	$CONFIG_EXT['calendar_calling_page'] .= $specific_itemid_mini ? $specific_itemid_mini : $Itemid;  // Your calendar web url
}
/* end of block new in 1.5.0.2 */

// Set the path and name and querystring of the current page, to make "$ME",
// which the minicalendar uses to create its hyperlinks for clicking on events
// and on the Next/Last month navigational arrows. Remove the "date" querystring
// variable, however; we'll usually be replacing it.
//$pathArray = explode('/', $_SERVER['PHP_SELF']);
//array_shift( $pathArray );
$pathArray = 'index.php';
$query_string = array();
foreach($_GET as $key => $value) {
  if ($key != 'date') $query_string[] = $key.'='.$value;
}
if (sizeof($query_string) > 0) $query_string = '?'.implode('&',$query_string).'&';
else $query_string = '?';
//$ME = htmlentities($pathArray[(count($pathArray))-1].$query_string);
$ME = htmlentities($pathArray.$query_string);
$CONFIG_EXT['LANGUAGES_DIR'] = $CONFIG_EXT['FS_PATH']."languages/";
$CONFIG_EXT['MINI_PICS_DIR'] = $CONFIG_EXT['FS_PATH']."images/minipics/";
$CONFIG_EXT['MINI_PICS_URL'] = $CONFIG_EXT['calendar_url']."images/minipics/";

// Set error logging level
if ($CONFIG_EXT['debug_mode']) {
    error_reporting (E_ALL);
		$DB_DEBUG = true;
} else {
    error_reporting (E_ALL ^ E_NOTICE);
		$DB_DEBUG = false;
} 

if( !function_exists('minical_theme_mini_cal_view') )
{
  function minical_theme_mini_cal_view($date, &$results, &$info_data)
  {
  	global $template_mini_cal_view, $THEME_DIR, $ME, $lang_mini_cal, $cat_id, $cats_limit;
    global $CONFIG_EXT, $today, $lang_date_format, $lang_general, $event_icons, $extcal_code_insert;
    global $todayclr, $weekdayclr, $sundayclr;
	global $sundayclrHl, $weekdayclrHl, $todayclrHl; 

	$template_mini_cal_view1 = $template_mini_cal_view;
	// replace global variables
	$template_mini_cal_view1 = str_replace('{THEME_DIR}', $THEME_DIR,$template_mini_cal_view1);
	$template_mini_cal_view1 = str_replace('{TARGET}', $info_data['target'],$template_mini_cal_view1);


	$header_row = minical_template_extract_block($template_mini_cal_view1, 'header_row');
	$navigation_row = minical_template_extract_block($template_mini_cal_view1, 'navigation_row');
	$picture_row = minical_template_extract_block($template_mini_cal_view1, 'picture_row');
	$footer_row = minical_template_extract_block($template_mini_cal_view1, 'footer_row');

	$weekday_header_row = minical_template_extract_block($template_mini_cal_view1, 'weekday_header_row');
	$weekday_cell_row = minical_template_extract_block($template_mini_cal_view1, 'weekday_cell_row');
	$weekday_footer_row = minical_template_extract_block($template_mini_cal_view1, 'weekday_footer_row');

	$day_cell_header_row = minical_template_extract_block($template_mini_cal_view1, 'day_cell_header_row');
	$weeknumber_cell_row = minical_template_extract_block($template_mini_cal_view1, 'weeknumber_cell_row');
	$day_cell_row = minical_template_extract_block($template_mini_cal_view1, 'day_cell_row');
	$other_month_cell_row = minical_template_extract_block($template_mini_cal_view1, 'other_month_cell_row');
	$day_cell_footer_row = minical_template_extract_block($template_mini_cal_view1, 'day_cell_footer_row');
	$inline_style_row = minical_template_extract_block($template_mini_cal_view1, 'inline_style_row');

    if($info_data['day_link']) minical_template_extract_block($day_cell_row, 'static_row');
    else minical_template_extract_block($day_cell_row, 'linkable_row');
    
    //  make the days of week, consisting of seven days
    $firstday = date ("w", mktime(0,0,0,$date['month'],1,$date['year']));
    if ($CONFIG_EXT['day_start']) $firstday-=1;
    //if (!$firstday && $CONFIG_EXT['day_start']) $firstday = 7; 
		$firstday = ($firstday < 0)? $firstday + 7: $firstday%7;

    // number of days in asked month
    $nr = date("t",mktime(0,0,0,$date['month'],1,$date['year']));

		$today_date = ucwords(strftime($lang_date_format['full_date'], mktime(0,0,0,$today['month'],$today['day'],$today['year'])));
    //starttable('99%', $lang_monthly_event_view['section_title'], $CONFIG_EXT['cal_view_show_week']?8:7, '', $today_date);
		echo $header_row;
		$params = array(
			'{PREVIOUS_MONTH}' => ucwords(strftime($lang_date_format['month_year'], mktime(0,0,0,$date['month']-1,1,$date['year']))),
			'{PREVIOUS_MONTH_URL}' => $info_data['previous_month_url'],
			'{CURRENT_MONTH}' => ucwords(strftime($lang_date_format['month_year'], mktime(0,0,0,$date['month'],1,$date['year']))),
			'{NEXT_MONTH}' => ucwords(strftime($lang_date_format['month_year'], mktime(0,0,0,$date['month']+1,1,$date['year']))),
			'{NEXT_MONTH_URL}' => $info_data['next_month_url'],
		);
		if(!$CONFIG_EXT['cal_view_show_week']) minical_template_extract_block($weekday_header_row, 'weeknumber_header_row');
		if(!$info_data['show_past_months']) minical_template_extract_block($navigation_row, 'previous_month_link_row'); 
		else minical_template_extract_block($navigation_row, 'no_previous_month_link_row'); 
		if($info_data['navigation_controls']) minical_template_extract_block($navigation_row, 'without_navigation_row');
		else minical_template_extract_block($navigation_row, 'with_navigation_row');
		echo minical_template_eval($navigation_row, $params);

		if(isset($info_data['picture_info'])) {
			$params = array(
				'{PICTURE_URL}' => $CONFIG_EXT['MINI_PICS_URL'].$info_data['picture_info']['picture_url'],
				'{PICTURE_MESSAGE}' => $info_data['picture_info']['picture_message'],
				'{STATUS_MESSAGE}' => ucwords(strftime($lang_date_format['month_year'], mktime(0,0,0,$date['month'],1,$date['year']))),
				'{MINI_PICTURE_LINK}' => $CONFIG_EXT['calendar_calling_page']
			);
			
			echo minical_template_eval($picture_row, $params);
		}
		
		//echo $weekdays_row;
		
    // print weekday labels
		echo $weekday_header_row;
    for ($i=0;$i<count($info_data['weekdays']);$i++)
    {
			$params = array(
				'{WEEK_DAY}' => $info_data['weekdays'][$i]['name'],
				'{CSS_CLASS}' => $info_data['weekdays'][$i]['class']
			);
			echo minical_template_eval($weekday_cell_row, $params);
		}
		echo $weekday_footer_row;

   
    // print day cells
    for ($i=1-$firstday;$i<=count($results);$i+=7)
    {
			echo $day_cell_header_row;
			if($CONFIG_EXT['cal_view_show_week']) {
				$weeknumber_cell_row1 = $weeknumber_cell_row;
				$weeknumber = $results[$i<1?1:$i]['week_number'];
				$week_stamp = mktime(0,0,0,$date['month'],$i + 6,$date['year']);
				$url_week_date = date("Y-m-d", $week_stamp);
				if( !empty($cat_id) && $cats_limit ) $url_week_date .= "&amp;cat_id=".$cat_id;
				$params = array(
					'{URL_WEEK_VIEW}' => JRoute::_( $CONFIG_EXT['calendar_calling_page']."&amp;extmode=week&amp;date=".$url_week_date ),
					'{WEEK_NUMBER}' => sprintf($lang_mini_cal['selected_week'],$weeknumber)
				);
				echo minical_template_eval( $weeknumber_cell_row1, $params);
			}
	    for ($row=0;$row<7;$row++)
	    {
				$day_stamp = mktime(0,0,0,$date['month'],$i + $row,$date['year']);
				if($i+$row<1 || $i+$row> $nr) {
					$date_string = "";
					echo str_replace('{CELL_CONTENT}', $date_string,$other_month_cell_row);
				} else {
					$url_target_date = $results[($i + $row)]['date_link'];
		      $events = $results[($i + $row)]['num_events'];
		      $num_events =  $info_data['day_link']?(int)$events:0;
			  $date_string = ucwords(strftime($lang_date_format['day_month_year'], $day_stamp));
		      if ($day_stamp == mktime(0,0,0,$today['month'],$today['day'],$today['year'])) {
		      	// higlight today's day
		      	$css_class = "extcal_todaycell";
				$link_class = $num_events?"extcal_busylink":"extcal_daylink";
		      	$hlColor = $todayclrHl; 
		      	$regColor = $todayclr; 
		      } elseif (!(int)date('w', $day_stamp)) {
		      	// use sunday colors
		      	$css_class = "extcal_sundaycell";
				$link_class = $num_events?"extcal_busylink":"extcal_sundaylink";
		      	$hlColor = $sundayclrHl; 
		      	$regColor = $sundayclr; 
		      } else  { 
		      	// use regular day colors
		      	$css_class = "extcal_daycell";
				$link_class = $num_events?"extcal_busylink":"extcal_daylink";
		      	$hlColor = $weekdayclrHl; 
		      	$regColor = $weekdayclr; 
		      }


					$params = array(
						'{DAY}' => $i + $row,
						'{URL_TARGET_DATE}' => $url_target_date,
						'{DAY_CLASS}' => $css_class,
						'{DAY_LINK_CLASS}' => $link_class,
						'{CELL_CONTENT}' => sprintf($lang_mini_cal['num_events'],$num_events),
						'{BG_COLOR}' => $regColor,
						'{HOVER_BG_COLOR}' => $hlColor,
						'{DATE_STRING}' => $date_string
					);

					if( !$num_events ) $params['{CELL_CONTENT}'] = '';					
					echo minical_template_eval($day_cell_row, $params);
				}
			}
			echo $day_cell_footer_row;
		}
		if(!$CONFIG_EXT['add_event_view'] || !has_priv('add') || !$CONFIG_EXT['show_minical_add_event_button']) minical_template_extract_block($footer_row, 'add_event_row');
		$params = array(
			'{ADD_EVENT_URL}' => JRoute::_( $CONFIG_EXT['calendar_calling_page'] . "&amp;extmode=event&amp;event_mode=add" ),
			'{ADD_EVENT_TITLE}' => $lang_mini_cal['post_event']
		);
		echo minical_template_eval($footer_row, $params);
		if(!$extcal_code_insert) {
			//$extcal_code_insert = 1;
			echo $inline_style_row;
		}
  }
}

##-------------------functions used:

if( !function_exists('minical_extcal_get_picture_file') )
{
  function minical_extcal_get_picture_file($file) {
	global $CONFIG_EXT;
	if($file) {
		if(file_exists($CONFIG_EXT['MINI_PICS_DIR'].$file.".jpg")) $file = $file.".jpg";
		elseif(file_exists($CONFIG_EXT['MINI_PICS_DIR'].$file.".gif")) $file = $file.".jpg";
		else $file = $CONFIG_EXT['mini_cal_def_picture'];
	} else $file = $CONFIG_EXT['mini_cal_def_picture'];
	return $file;
  }
}

if( !function_exists('minical_extcal_dir_list') )
{
  function minical_extcal_dir_list($dirname)
  {	
	$handle=opendir($dirname);
	while ($file = readdir($handle))
	{
   		if($file=='.'||$file=='..'||is_dir($dirname.$file)) continue;
   		$result_array[]=$file;
 	}
 	closedir($handle);
 	return $result_array;
  }
}

if( !function_exists('minical_template_extract_block') )
{
  function minical_template_extract_block(&$template, $block_name, $subst='')
  {
        if(!$template) return;
        $pattern = "#(<!-- BEGIN $block_name -->)(.*?)(<!-- END $block_name -->)#s";
        if ( !preg_match($pattern, $template, $matches)){
                die ('<b>Template error<b><br />Failed to find block \''.$block_name.'\' in :<br /><pre>'.htmlspecialchars($template).'</pre>');
        }
        $template = str_replace($matches[1].$matches[2].$matches[3], $subst, $template);
        return $matches[2];
  }
}

// Eval a template (substitute vars with values)
if( !function_exists('minical_template_eval') )
{
  function minical_template_eval(&$template, &$vars)
  {
        return strtr($template, $vars);
  }
}

if( !function_exists('minical_extcal_get_local_time') )
{
  function minical_extcal_get_local_time ($target_timezone = '') {
	global $CONFIG_EXT;
    $database = &JFactory::getDBO();
	if(!$target_timezone) $target_timezone = $CONFIG_EXT['timezone'];
	$zonedate = mktime(gmdate('G'), gmdate('i'), gmdate('s'), gmdate('n'),
	gmdate('j'), gmdate('Y'), 0) + ($target_timezone * 3600);

	return $zonedate;
  }
}

if( !function_exists('minical_sub_string') )
{
  function minical_sub_string($string,$max,$suffix) {
	// returns a substring that may be encoded in utf-8 or other character encodings. 
	// and adds a suffix in case the substring is smaller than the original string 
	global $CONFIG_EXT;
    $database = &JFactory::getDBO();
	if($CONFIG_EXT['charset'] == "utf-8") {
		if(preg_match('/(.{1,'.$max.'})/u', $string, $matches)) $new_string = $matches[0];
		else $new_string = $string; // this state occurs if the string contains chars with mixed encodings
	} else {
		$new_string = substr($string,0,$max);
	}
	$new_string = strlen($new_string)==strlen($string)?$new_string:$new_string.$suffix;
	return $new_string;
  }
}

// Get the week number in ISO 8601:1988 format
if( !function_exists('minical_get_week_number') )
{
  function minical_get_week_number($day, $month, $year) {
  global $CONFIG_EXT;
  $database = &JFactory::getDBO();
  if($CONFIG_EXT['day_start']) $week = strftime("%W", mktime(0, 0, 0, $month, $day, $year));
  else $week = strftime("%U", mktime(0, 0, 0, $month, $day, $year));
  $yearBeginWeekDay = strftime("%w", mktime(0, 0, 0, 1, 1, $year));
  $yearEndWeekDay  = strftime("%w", mktime(0, 0, 0, 12, 31, $year)); 
  // make the checks for the year beginning
  if($yearBeginWeekDay > 0 && $yearBeginWeekDay < 5) {
   // First week of the year begins during Monday-Thursday.
   // Currently first week is 0, so all weeks should be incremented by one
   $week++;
  } else if($week == 0) {
   // First week of the year begins during Friday-Sunday.
   // First week should be 53, and other weeks should remain as they are
   $week = 53;
  }
  // make the checks for the year end, these only apply to the weak 53
  if($week == 53 && $yearEndWeekDay > 0 && $yearEndWeekDay < 5) {
   // Currently the last week of the year is week 53.
   // Last week of the year begins during Friday-Sunday
   // Last week should be week 1
   $week = 1;
  }
  // return the correct ISO 8601:1988 week
  return $week;
  }
}

if( !function_exists('minical_get_events') )
{
  function minical_get_events($date_stamp, $calid = 0, $include_recurrent = false, $show_overlapping_recurrences = false) {
	// return events that occur at a specific date
  	global $CONFIG_EXT, $cat_id, $cats_limit;
    $database = &JFactory::getDBO();
	
	if(empty($date_stamp)) return false;
	
	$cat_filter = "";
	// generate the sql query for a specific date
	$day_pattern = date("Ymd", $date_stamp); // day pattern: 20041231 for 'December 31, 2004'
	$event_condition = '';

	switch($CONFIG_EXT['multi_day_events']) {
  		case "bounds":
			$event_condition = "(DATE_FORMAT(e.start_date,'%Y%m%d') = $day_pattern OR DATE_FORMAT(e.end_date,'%Y%m%d') = $day_pattern)";
  			break;
  		case "start":
			$event_condition = "(DATE_FORMAT(e.start_date,'%Y%m%d') = $day_pattern)";
  			break;
  		case "all":
		default:  		
			$event_condition = "( ( DATE_FORMAT(e.start_date,'%Y%m%d') <= $day_pattern AND DATE_FORMAT(e.end_date,'%Y%m%d') >= $day_pattern )";
			// Added this to account for "all day" events, which are marked with a weird end_date value:
			$event_condition .=  " OR ( DATE_FORMAT(e.start_date,'%Y%m%d') = $day_pattern ) )";
  			break;
	}
  
	$query = "SELECT e.extid, e.cat, start_date, end_date from " . $CONFIG_EXT['TABLE_EVENTS'] . " AS e LEFT JOIN " . $CONFIG_EXT['TABLE_CATEGORIES'] . " AS c ON e.cat=c.cat_id ";
	$query .= "WHERE ".$event_condition." AND c.published = '1' AND e.published = '1' AND approved = '1' AND recur_type = ''";
	if( !empty($cat_id) && $cats_limit ) $query .= "AND e.cat IN (".$cat_id.") "; 
	if($calid != 0) $query .= "AND e.calendar = $calid ";

	$query .= "ORDER BY start_date,title ASC";

	$result = extcal_db_query($query);

	$events = array();
  
	while ($row = extcal_db_fetch_row($result)) {
  		if ( has_priv ( 'category' . $row[1] ) )
  		{
  			$events[] = array($row[0],strtotime($row[2]),strtotime($row[3]));
  		}
  	}
	
	if($include_recurrent) {
	  // calculate recurrent events
	  if(!empty($cat_id) && $cats_limit ) $cat_filter .= "AND e.cat IN (".$cat_id.")"; 
	  $query = "SELECT e.extid, e.cat, recur_type, recur_val, recur_ord, recur_until, start_date, end_date, recur_end_type, recur_count from " . $CONFIG_EXT['TABLE_EVENTS'] . " AS e LEFT JOIN " . $CONFIG_EXT['TABLE_CATEGORIES'] . " AS c ON e.cat=c.cat_id ";
	  $query .= "WHERE (DATE_FORMAT(e.start_date,'%Y%m%d') <= $day_pattern) AND c.published = '1' AND e.published = '1' AND e.published = '1' AND approved = '1' AND recur_type <> '' $cat_filter ";
	  if($calid != 0) $query .= "AND e.calendar = $calid ";
	  $query .= "ORDER BY start_date,title ASC";
	  $result1 = extcal_db_query($query);
	  $recur_events = array();

	  while ($row = extcal_db_fetch_array($result1))
	  {
	  	if ( has_priv ( 'category' . $row['cat'] ) )
	  	{		
		  	$event = new ExtCal_Event();
			//$event->loadEvent($row[0]);
		  	$event->recType = $row['recur_type']; // pass recur_type to event object
			$event->recInterval = (int)$row['recur_val']; // pass recur_interval to event object
			$event->recOrdinal  = (int)$row['recur_ord']; // pass recur_ord to event object
			$event->recEndDate = strtotime($row['recur_until']." 00:00:00")-strtotime("0000-00-00 00:00:00")?strtotime($row['recur_until']." 23:59:59"):false; // pass recur_until to event object
		  	$event->setStartDate(strtotime($row['start_date'])); // convert start_date to timestamp and pass it to event object
			// Fix to make sure that recurring events with no end date specified are still counted:
			if ( ($row['end_date'] == '0000-00-00 00:00:00') || ($row['end_date'] == '0000-00-00 00:00:01') ) $row['end_date'] = $row['start_date'];
			$event->setEndDate(strtotime($row['end_date'])); // convert end_date to timestamp and pass it to event object
			$event->recEndType = (int)$row['recur_end_type']; 
			$event->recEndCount = (int)$row['recur_count'];

			// MF - if event is recurrent on this date, add it here:
			if ( $event->isRecurrentOn($date_stamp) ) {
				$exclude_date = date("Y-m-d", $date_stamp);
				$query = "SELECT extid, eventid, published, approved, start_date FROM " . $CONFIG_EXT['TABLE_EXCLUSIONS'] . " ";
		  		$query .= "WHERE eventid = '".$row['extid']."' AND published = '1' AND approved = '1' AND start_date = '".$exclude_date."'";
		  		$excresult = extcal_db_query($query);

				if( extcal_db_num_rows($excresult) == 0 ) {
					// MF - added the last two elements so we capture the extra "recurStartDay" and "recurEndDay" that I added to the event class:
					if ( $show_overlapping_recurrences ) {
						foreach ( $event->recurrencesOnThisDate as $thisRecurrence ) {
					  		$recur_events[] = array($row['extid'],$thisRecurrence['exact_recurrence_start'],$thisRecurrence['exact_recurrence_end'],$thisRecurrence['recurrence_start_day'],$thisRecurrence['recurrence_end_day']);
						}
					} else {
						// MF - If overlapping recurrences are off, add only the LAST recurrence of the event. This way
						// events which recur STARTING today are listed on the calendar as starting today instead of as
						// being continued from a prior day.
						$thisRecurrence = $event->recurrencesOnThisDate[count($event->recurrencesOnThisDate)-1];
				  		$recur_events[] = array($row['extid'],$thisRecurrence['exact_recurrence_start'],$thisRecurrence['exact_recurrence_end'],$thisRecurrence['recurrence_start_day'],$thisRecurrence['recurrence_end_day']);
					}
				}
			}	  	
	  	}
	}

		$events = array_merge($events,$recur_events);
	}
	return is_array($events)?$events:false;
  }
}

if( !function_exists('minical_has_priv') )
{
  function minical_has_priv($priv) {
    global $CONFIG_EXT, $lang_system, $lang_general;
    $database = &JFactory::getDBO();
    $my = &JFactory::getUser();
/* returns true if the user has the privilege $priv */
// Revised to use new USER_IS_ADMIN global constant, which was set in config.inc.php
// using Mambo's usertype value. Does NOT have fancy code to allow "XXX type and up"
// to access page--just checks to see if you ARE that type or an Admin, and then lets
// you through. With one exception: if the privilege is set to "Registered" then anybody
// who's logged in gets through.

	if ($priv == "Anyone") { return true; }
	else if (($priv == "Registered") && USER_IS_LOGGED_IN) { return true; }
	else if (USER_IS_ADMIN || ($my->usertype == $priv)) { return true; }
	else { return false; }
  }
}

$database->setQuery( "SELECT name FROM #__jcalpro_themes WHERE published= '1'" );
$themeName = $database->loadResult();

// Check for template name passed as URL param
$jcal_change_theme = JRequest::getVar('jcal_change_theme', '');
if( !empty($jcal_change_theme) ) $themeName = $jcal_change_theme;

$CONFIG_EXT['theme'] = $themeName;

if (!file_exists($CONFIG_EXT['FS_PATH']."themes/{$CONFIG_EXT['theme']}/theme.php")) $CONFIG_EXT['theme'] = 'default';
$THEME_DIR = $CONFIG_EXT['calendar_url']."themes/{$CONFIG_EXT['theme']}";

$locale_was_set = false;
$CONFIG_EXT['lang'] = $mosConfig_lang;
if (!file_exists($CONFIG_EXT['LANGUAGES_DIR']."{$CONFIG_EXT['lang']}/index.php")) $CONFIG_EXT['lang'] = 'english';
include $CONFIG_EXT['LANGUAGES_DIR']."{$CONFIG_EXT['lang']}/index.php";
if (!isset($zone_stamp)) {
  if ( isset($lang_info['locale']) && is_array($lang_info['locale']) ) {
	// Localizing time
	foreach( $lang_info['locale'] as $temp_lang_code ) {
		$locale_was_set = setlocale (LC_TIME,$temp_lang_code);
	}
  }
	$zone_stamp = minical_extcal_get_local_time();
}

if (!isset($today)) {
	$today = ucwords(strftime ($lang_date_format['full_date'], $zone_stamp));
	// e.g. Wednesday, June 05, 2002
	
	// Initialize time variables with today's date
	$m = (int)date("n", minical_extcal_get_local_time()); // Numeric representation of a month, without leading zeros
	$y = (int)date("Y", minical_extcal_get_local_time()); 
	$d = (int)date("j", minical_extcal_get_local_time()); // Day of the month without leading zeros
	
	$today = array(
		'day' => $d,
		'month' => $m,
		'year' => $y
	);
}

if (!isset($date)) {
	// initialise the date variable 
	if(isset($_POST['date'])) {
		list($year, $month, $day) = split('[:/.-]', $_POST['date']); // split at a slash, dot, or hyphen.
		$date = array(
			'day' => (int)$day,
			'month' => (int)$month,
			'year' => (int)$year
		);
	} elseif(isset($_GET['date'])) {
		list($year, $month, $day) = split('[:/.-]', $_GET['date']); // split at a slash, dot, or hyphen.
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
}
$day = $date['day'];
$month = $date['month'];
$year = $date['year'];

// If this module is configured to display previous month or next month,
// adjust the month and year variables
$month_offset = intval($params->def('month_to_display',0));
$month += $month_offset;
if( $month == 0 ) { $month = 12; --$year; }
if( $month > 12 ) { $month = 1; ++$year; }

#------------------------END necessary stuff from config.inc.php

##-------------------Gather parameters from the module administration section:

$info_data['navigation_controls'] = intval($params->def('navigation_controls',1));
$CONFIG_EXT['show_minical_add_event_button'] = intval($params->def('show_minical_add_event_button',1));
$target = trim($params->get('target'));
if( $target == "" ) { $target = "_self"; }
$info_data['target'] = $target;
$CONFIG_EXT['mini_cal_def_picture'] = htmlspecialchars(trim($params->def('mini_cal_def_picture','def_pic.gif')));
$picture = intval($params->def('picture','0'));

##-------------------HTML template:

// HTML template to display a monthly calendar view
$template_mini_cal_view = <<<EOT
<!-- BEGIN inline_style_row -->

<STYLE TYPE="text/css" MEDIA="screen, projection">
<!--
  @import url('{THEME_DIR}/style.css');
-->
</STYLE>

<script type="text/javascript">
	function extcal_showOnBar(Str)
	{
		window.status=Str;
		return true;
	}
</script>
<!-- END inline_style_row -->
<!-- BEGIN header_row -->
<div id="extcal_minical">
	<table class="extcal_minical" align="center" border="0" cellspacing="1" cellpadding="0">
		<tr>
			<td>
<!-- END header_row -->
<!-- BEGIN navigation_row -->
			<table border="0" cellspacing="0" cellpadding="2" width="100%" class="extcal_navbar">
				<tr>
<!-- BEGIN with_navigation_row -->
<!-- BEGIN no_previous_month_link_row -->
					<td align="center" height="18" valign="middle"><img src="{THEME_DIR}/images/mini_arrowleft_inactive.gif" border="0" alt="" title="" /></td>
<!-- END no_previous_month_link_row -->
<!-- BEGIN previous_month_link_row -->
					<td align="center" height="18" valign="middle"
						onmouseover="extcal_showOnBar('{PREVIOUS_MONTH}');return true;" 
						onmouseout="extcal_showOnBar('');return true;">
						<a href="{PREVIOUS_MONTH_URL}"><img src="{THEME_DIR}/images/mini_arrowleft.gif" border="0" alt="{PREVIOUS_MONTH}" title="{PREVIOUS_MONTH}" /></a></td>
<!-- END previous_month_link_row -->
					<td align="center" height="18" valign="middle" width="98%" class='extcal_month_label' nowrap="nowrap">{CURRENT_MONTH}</td>
					<td align="center" height="18" valign="middle"
						onmouseover="extcal_showOnBar('{NEXT_MONTH}');return true;" 
						onmouseout="extcal_showOnBar('');return true;">
					  <a href="{NEXT_MONTH_URL}"><img src="{THEME_DIR}/images/mini_arrowright.gif" border="0" alt="{NEXT_MONTH}" title="{NEXT_MONTH}" /></a></td>
<!-- END with_navigation_row -->
<!-- BEGIN without_navigation_row -->
					<td colspan="3" align="center" height="18" valign="middle" width="98%" class='extcal_month_label' nowrap="nowrap">{CURRENT_MONTH}</td>
<!-- END without_navigation_row -->
				</tr>
			</table>
<!-- END navigation_row -->

<!-- BEGIN picture_row -->
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
			  <tr>
			    <td class="extcal_picture">
						<a href='{MINI_PICTURE_LINK}' 
							onmouseover="extcal_showOnBar('{STATUS_MESSAGE}');return true;" 
							onmouseout="extcal_showOnBar('');return true;">
					<img src='{PICTURE_URL}' width='135' alt='{PICTURE_MESSAGE}' border='0' /></a></td>
			  </tr>
			</table>
<!-- END picture_row -->

<!-- BEGIN weekday_header_row -->
	<table align="center" border="0" cellspacing="0" cellpadding="0" width="135"  class="extcal_weekdays">
		<tr>
<!-- BEGIN weeknumber_header_row -->
			<td></td>
<!-- END weeknumber_header_row -->
<!-- END weekday_header_row -->
<!-- BEGIN weekday_cell_row -->
			<td height='24' class="{CSS_CLASS}" valign="top" align="center">
				{WEEK_DAY}
			</td>
<!-- END weekday_cell_row -->
<!-- BEGIN weekday_footer_row -->
		</tr>
<!-- END weekday_footer_row -->

<!-- BEGIN day_cell_info_row -->
<!-- BEGIN day_cell_header_row -->
		<tr>
<!-- END day_cell_header_row -->
<!-- BEGIN weeknumber_cell_row -->
		<td class='extcal_weekcell' align='center'
				onmouseover="extcal_showOnBar('{WEEK_NUMBER}');return true;" 
				onmouseout="extcal_showOnBar('');return true;">
			<a href="{URL_WEEK_VIEW}" target="{TARGET}"><img src="{THEME_DIR}/images/icon-mini-week.gif" width="5" height="20" border="0" alt="{WEEK_NUMBER}" /></a></td>
<!-- END weeknumber_cell_row -->
<!-- BEGIN other_month_cell_row -->
		<td height='15' class='extcal_othermonth' align='center' valign='middle'>{CELL_CONTENT}</td>
<!-- END other_month_cell_row -->
<!-- BEGIN day_cell_row -->
		<td height='15' class='{DAY_CLASS}' align='center' valign='top' onmouseover="extcal_showOnBar('{DATE_STRING}');return true;" onmouseout="extcal_showOnBar('');return true;">
<!-- BEGIN linkable_row -->
			<a href="{URL_TARGET_DATE}" title="{CELL_CONTENT}" class="{DAY_LINK_CLASS}" target="{TARGET}">{DAY}</a>
<!-- END linkable_row -->
<!-- BEGIN static_row -->
			<span title="{CELL_CONTENT}" class="{DAY_CLASS}">{DAY}</span>
<!-- END static_row -->
		</td>
<!-- END day_cell_row -->

<!-- BEGIN day_cell_footer_row -->
		</tr>
<!-- END day_cell_footer_row -->
<!-- END day_cell_info_row -->
<!-- BEGIN footer_row -->
			</table>
	  </td>
  </tr>
</table>
<!-- BEGIN add_event_row -->
<table width="139" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr>
		<td align="center" nowrap="nowrap" class="extcal_navbar">
			<a href="{ADD_EVENT_URL}"
				onmouseover="extcal_showOnBar('{ADD_EVENT_TITLE}');return true;" 
				onmouseout="extcal_showOnBar('');return true;" style="display:block;" class="extcal_tiny_add_event_link"><img src="{THEME_DIR}/images/addsign_a.gif" style="vertical-align: text-bottom" alt="{ADD_EVENT_TITLE}" border="0" vspace="2" /> {ADD_EVENT_TITLE}</a>
		</td>
	</tr>
</table>
<!-- END add_event_row -->
</div>
<!-- END footer_row -->
EOT;

ob_start();
	
// check if "show past events" is enabled, else force the date to today's date
if(mktime(0,0,0,$month,$day,$year) < mktime(0,0,0,$today['month'],1,$today['year']) && !$CONFIG_EXT['archive']) {
	$info_data['day_link'] = false;
} else $info_data['day_link'] = true;

// insert date into an array an pass it to the mini calendar theme function
$target_date = array(
	'day' => $day,
	'month' => $month,
	'year' => $year
);

$pic_message = ucwords(strftime ($lang_date_format['full_date'], minical_extcal_get_local_time()))."\n";

switch($picture) {
	case '0': // Picture not displayed
	case 'none':
		$z = '';
		break;
	case '1': // Default Picture
		$z = $CONFIG_EXT['mini_cal_def_picture'];
		$pic_message .= $lang_mini_cal['def_pic'];
		break;
	case '2': // Daily Picture
	case 'daily':
		$z = (int)date("z",minical_extcal_get_local_time()); // 0 through 366
		$pic_message .= sprintf($lang_mini_cal['daily_pic'],$z);
		$z = minical_extcal_get_picture_file($z);
		break;
	case '3': // Weekly Picture
	case 'weekly':
		//$z = (int)date("W",minical_extcal_get_local_time()); // 0 through 53
		$z = (int) minical_get_week_number($today['day'], $today['month'], $today['year']); // 1 through 53
		$pic_message .= sprintf($lang_mini_cal['weekly_pic'],$z);
		$z = minical_extcal_get_picture_file($z);
		break;
	case '4': // Random Picture
	case 'random':
		$pictures = minical_extcal_dir_list($CONFIG_EXT['MINI_PICS_DIR']);
		srand((float)microtime() * 1000000);
		shuffle($pictures);
		$z = $pictures[0];
		$pic_message .= sprintf($lang_mini_cal['rand_pic'],$z);
		break;
	default: // Default Picture by default
		$z = $CONFIG_EXT['mini_cal_def_picture'];
		$pic_message .= $lang_mini_cal['def_pic'];
}
if(!empty($z)) $info_data['picture_info'] = array('picture_message' => $pic_message, 'picture_url' => $z); 
// number of days in selected month
$nr = date("t",mktime(0,0,0,$month,1,$year));

$previous_month_date = date("Y-m-d", mktime(0,0,0,$month-1-$month_offset,1,$year));
$next_month_date = date("Y-m-d", mktime(0,0,0,$month+1-$month_offset,1,$year));

$info_data['previous_month_url'] = JRoute::_( $ME."date=".$previous_month_date );
$info_data['next_month_url'] = JRoute::_( $ME."date=".$next_month_date );
$info_data['current_month_url'] = substr($ME,0,-1);

$info_data['current_month_color'] = ($month == $today['month'] && $year == $today['year'])?"background-color: ".$todayclr:"";

if ($CONFIG_EXT['archive'] || ($month != date("n") || $year != date("Y")))
	$info_data['show_past_months'] = true;
else $info_data['show_past_months'] = false;

// get the weekdays
for ($i=0;$i<=6;$i++)
{
	$array_index = $CONFIG_EXT['day_start']?($i+1)%7:$i;
	if ($array_index) $css_class = "extcal_weekdays"; // weekdays
	else $css_class = "extcal_weekdays"; // sunday
	$info_data['weekdays'][$i]['name'] = minical_sub_string($lang_date_format['day_of_week'][$array_index],2,'');
	$info_data['weekdays'][$i]['class'] = $css_class;
}

$event_stack = array();

// 'existing' days in month
for ($i=1;$i<=$nr;$i++)
{
	$date_stamp = mktime(0,0,0,$month,$i,$year);
	// generate the url for each day cell
	$url_target_date = date("Y-m-d", $date_stamp);
	$event_stack[$i]['date_link'] = $info_data['day_link']?JRoute::_($CONFIG_EXT['calendar_calling_page']."&amp;extmode=day&amp;date=".$url_target_date):'';
	if( !empty($cat_id) && $cats_limit ) $event_stack[$i]['date_link'] .= "&amp;cat_id=".$cat_id;
	// count the number of events occurring in a given date
	$events = minical_get_events($date_stamp,$calid,$CONFIG_EXT['show_recurrent_events'],$CONFIG_EXT['show_overlapping_recurrences_dailyview']);
	//$events = sort_events($events, $event_stack, $date_stamp);
	$event_stack[$i]['num_events'] = count($events);
	//$event_stack[$i]['events'] = $events;
	$event_stack[$i]['week_number'] = (int) minical_get_week_number($i, $month, $year);

}

minical_theme_mini_cal_view($target_date, $event_stack, $info_data);

$output = ob_get_contents(); // read buffer
ob_end_flush(); 


##-------------------Set the locale for date/time functions back to the one already set by Mambo:
if ( $locale_was_set ) setlocale(LC_TIME,$mosConfig_locale);

##-------------------------------HTML rendering of the mini-cal:

?>