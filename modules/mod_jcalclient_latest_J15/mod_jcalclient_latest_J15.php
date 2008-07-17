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

* Latest Events Module
*
* Revision date: 2-Nov-2007
*
* Module for displaying upcoming events in connection with the JCal Pro
* component. The component must be installed before this module will work. 
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

global $CONFIG_EXT, $EXTCAL_CONFIG;
$database = &JFactory::getDBO();
$config = &JFactory::getConfig();
$mosConfig_offset = $config->getValue('config.offset');
$mosConfig_live_site = JURI::root();
$legacy_lang = &JFactory::getLanguage();
$mosConfig_lang = $legacy_lang->getBackwardLang();
$mosConfig_locale = $config->getValue('config.language');

$option = "com_jcalpro";
require_once( JPATH_ROOT."/components/com_jcalpro/config.inc.php" );

if( !function_exists('real_clone') )
{
	function real_clone($object) {
	return version_compare(phpversion(), '5.0') < 0 ? $object : clone($object);
	} 
}

##-------------------We'll get the menu Itemid to pass on when clicking a link:

  // I know there's a mainframe method for this (getItemid) but I can't figure the damn thing out. I think it's only for content items.

//$database->setQuery("SELECT MAX(id) FROM #__menu WHERE link LIKE '%index.php?option=com_jcalpro%' AND published = '1' AND componentid > 0");
$database->setQuery("SELECT MAX(id) FROM #__menu WHERE link LIKE '%index.php?option=com_jcalpro%' AND published <> '-2' AND componentid > 0");
$jcal_itemid = intval($params->def('component_itemid',$database->loadResult()));

##-------------------Some little variables we'll use later:

$previouseventmonth = '';
$thiseventmonth = '';
$module_output = '';
$locale_was_set = false;
$rowsUpcoming = array();
$rowsUpcomingRecurrent = array();
$rowsRecent = array();
$rowsRecentRecurrent = array();

##-------------------EXTCAL_CONFIG will contain any important config variables we need:
$EXTCAL_CONFIG = array();
$EXTCAL_CONFIG['now'] = date( 'Y-m-d H:i:s', time() + $mosConfig_offset * 60 * 60 );
$EXTCAL_CONFIG['now_stamp'] = strtotime($EXTCAL_CONFIG['now']);
$EXTCAL_CONFIG['today_stamp'] = strtotime(substr($EXTCAL_CONFIG['now'],0,10));
$EXTCAL_CONFIG['Itemid'] = $jcal_itemid ? $jcal_itemid : $Itemid;

  // There are two important values we need to get from the main ExtCal Settings, which the other module
  // and component load into something called $CONFIG_EXT. If these settings have already been loaded by
  // another module or component, we can save a query. Otherwise we query the settings table here.
if ( isset($CONFIG_EXT['show_recurrent_events']) && isset($CONFIG_EXT['addevent_allow_html']) && isset($CONFIG_EXT['who_can_add_events']) && isset($CONFIG_EXT['show_only_start_times']) ) {
  $EXTCAL_CONFIG['show_recurrent_events'] = $CONFIG_EXT['show_recurrent_events'];
  $EXTCAL_CONFIG['addevent_allow_html'] = $CONFIG_EXT['addevent_allow_html'];
  $EXTCAL_CONFIG['who_can_add_events'] = $CONFIG_EXT['who_can_add_events'];
  $EXTCAL_CONFIG['show_only_start_times'] = $CONFIG_EXT['show_only_start_times'];
  } else {
  $query = "SELECT name, value FROM #__jcalpro_config WHERE name = 'addevent_allow_html' OR name = 'show_recurrent_events' OR name = 'who_can_add_events' OR name = 'show_only_start_times'";
  $database->setQuery($query);
  $rows = $database->loadObjectList();
  foreach ($rows as $row) {
    $EXTCAL_CONFIG[$row->name] = $row->value;
  }
}

##-------------------Gather parameters from the module administration section:

$EXTCAL_CONFIG['display_if_no_events'] = intval($params->def('display_if_no_events',1));
$EXTCAL_CONFIG['number_of_events_to_list_upcoming'] = intval($params->def('number_of_events_to_list_upcoming',5));
$EXTCAL_CONFIG['number_of_events_to_list_recent'] = intval($params->def('number_of_events_to_list_recent',0));
$EXTCAL_CONFIG['title_max_length'] = intval($params->def('title_max_length',256));
$EXTCAL_CONFIG['show_times'] = intval($params->def('show_times',1));
$EXTCAL_CONFIG['show_dates'] = intval($params->def('show_dates',1));
$EXTCAL_CONFIG['show_calendar'] = intval($params->def('show_calendar',1));
$EXTCAL_CONFIG['show_category'] = intval($params->def('show_category',1));
$EXTCAL_CONFIG['show_description'] = intval($params->def('show_description',1));
$EXTCAL_CONFIG['show_contact'] = intval($params->def('show_contact',1));
$EXTCAL_CONFIG['description_max_length'] = intval($params->def('description_max_length',256));

// Retrieve the calendar id from the name given as module parameter
$calname = $params->get('calendar', '');
$calid = '';
if(!empty($calname)) {
  $query = "SELECT cal_id FROM #__jcalpro_calendars WHERE cal_name='$calname'";
  $database->setQuery( $query );
  $rows = $database->loadObjectList();
  $calid = $rows[0]->cal_id;
}

$catid = $params->get('categories', '');
$outputSetting = $params->get('output', '');
$EXTCAL_CONFIG['days_view'] = $params->get('days_view', '');
$EXTCAL_CONFIG['date_format'] = $params->get('date_format', '%B %d, %Y');

$strip_bbcode_from_description = intval($params->def('strip_bbcode_from_description',3));
$EXTCAL_CONFIG['strip_bbcode_from_description'] = ( $strip_bbcode_from_description = 3 ) ? $EXTCAL_CONFIG['addevent_allow_html'] : $strip_bbcode_from_description;
$show_recurrent_events = intval($params->def('show_recurrent_events',3));
$EXTCAL_CONFIG['show_recurrent_events'] = ( $show_recurrent_events == 3 ) ? $EXTCAL_CONFIG['show_recurrent_events'] : $show_recurrent_events;
$EXTCAL_CONFIG['event_separator'] = trim($params->def('event_separator',''));
$EXTCAL_CONFIG['show_month_separators'] = intval($params->def('show_month_separators',0));
$rawMonthSeparatorStyle = htmlspecialchars(trim($params->def('month_separator_style','background-color: none; border-top-color: #777777; border-bottom-color: #777777; border-top-width: 1px; border-bottom-width: 1px; border-top-style: solid; border-bottom-style: solid; font-style: italic; font-weight: bold; margin: 4px; text-align: center')));
$EXTCAL_CONFIG['month_separator_style'] = ( $rawMonthSeparatorStyle == '' ) ? '' : ' style="'.str_replace(array("\r\n","\n"),'',$rawMonthSeparatorStyle).'"';
$EXTCAL_CONFIG['no_upcoming_events_text'] = $params->def('no_upcoming_events_text','There are no upcoming events currently scheduled.');
$EXTCAL_CONFIG['recent_events_text'] = $params->def('recent_events_text','Recent Events');
$rawRecentEventsStyle = htmlspecialchars(trim($params->def('recent_events_style','font-size: 110%; font-weight: bold; background-color: none; border-top-color: #333333; border-bottom-color: #333333; border-top-width: 2px; border-bottom-width: 2px; border-top-style: solid; border-bottom-style: solid; margin: 10px; text-align: center')));
$EXTCAL_CONFIG['recent_events_style'] = ( $rawRecentEventsStyle == '' ) ? '' : ' style="'.str_replace(array("\r\n","\n"),'',$rawRecentEventsStyle).'"';
$EXTCAL_CONFIG['show_full_calendar_link'] = intval($params->def('show_full_calendar_link',1));
$EXTCAL_CONFIG['full_calendar_link_text'] = htmlspecialchars($params->def('full_calendar_link_text','View Full Calendar'));
$EXTCAL_CONFIG['show_add_event_link'] = intval($params->def('show_add_event_link',0));
$EXTCAL_CONFIG['add_event_text'] = htmlspecialchars($params->def('add_event_text','Add New Event'));
$EXTCAL_CONFIG['use_extcal_locale_settings'] = intval($params->def('use_extcal_locale_settings',0));
$EXTCAL_CONFIG['time_format_12_or_24'] = intval($params->def('time_format_12_or_24',1));

######################################################################
#####  CUSTOM FUNCTIONS:
######################################################################

if( !function_exists('latest_has_priv') )
  {
    function latest_has_priv($priv) {
        global $my;
    /* returns true if the user has the privilege $priv */
    // Revised to use new USER_IS_ADMIN global constant, which was set in config.inc.php
    // using Mambo's usertype value. Does NOT have fancy code to allow "XXX type and up"
    // to access page--just checks to see if you ARE that type or an Admin, and then lets
    // you through. With one exception: if the privilege is set to "Registered" then anybody
    // who's logged in gets through.
    
        $priv = strtolower($priv);
        $usertype = strtolower($my->usertype);
    	if (USER_IS_ADMIN) { return true; }
    	if ($priv=="anyone") { return true; }
    	if (($priv=="registered") && USER_IS_LOGGED_IN) { return true; }
    	if ($priv==$usertype) { return true; }
    	switch ($usertype) {
            case "editor":
                if($priv=="author") { return true; }
            case "publisher":
                if($priv=="editor" || $priv == "author" ) { return true; }
            case "manager":
                if($priv=="editor" || $priv == "author" || $priv=="publisher" ) { return true; }
            default:
            	return false;
        }
    }
}

if( !function_exists('mf_shorten_with_ellipsis') )
  {
    function mf_shorten_with_ellipsis($inputstring,$characters) {
      return (strlen($inputstring) >= $characters) ? substr($inputstring,0,($characters-3)) . '...' : $inputstring;
    }
}

if( !function_exists('mf_get_daterange_string') )
  {

    function mf_get_daterange_string($thisEvent) {
    
      global $EXTCAL_CONFIG;
    
      $no_end_specified = ( ($thisEvent->end_date == '0000-00-00 00:00:00') || ($thisEvent->end_date == '0000-00-00 00:00:01') || $EXTCAL_CONFIG['show_only_start_times'] ) ? true : false;
    
      $start_date_array = (split('[- ]',$thisEvent->start_date));
      $end_date_array = (split('[- ]',$thisEvent->end_date));
      $start_time_array = (explode(':',substr($thisEvent->start_date,10,15)));
      $end_time_array = (explode(':',substr($thisEvent->end_date,10,15)));
      // i.e. Fri-January-6-2005:
      $startdate = strftime("%a-%B-%d-%Y-%p", mktime($start_time_array[0], $start_time_array[1], 0, $start_date_array[1], $start_date_array[2], $start_date_array[0]));
      $enddate = strftime("%a-%B-%d-%Y-%p", mktime($end_time_array[0], $end_time_array[1], 0, $end_date_array[1], $end_date_array[2], $end_date_array[0]));
      $startdate = (explode('-',$startdate));
      $enddate = (explode('-',$enddate));
    
      $start_day = ucwords($startdate['0']);
      $start_month = ucwords($startdate['1']);
      $start_daynumber = intval($startdate['2']);
      $start_year = $startdate['3'];
      if ( $thisEvent->end_date == '0000-00-00 00:00:01' ) { // This event is an "All Day" event
        $start_time = EXTCAL_TEXT_ALL_DAY;
      }
      else {
      if ( !$EXTCAL_CONFIG['time_format_12_or_24'] ) { $start_time = date("H:i", mktime($start_time_array[0], $start_time_array[1], 0, 1, 1, 1975)); }
      else { $start_time = date("g:i", mktime($start_time_array[0], $start_time_array[1], 0, 1, 1, 1975)) . (($startdate['4'] == '') ? date(" a", mktime($start_time_array[0], $start_time_array[1], 0, 1, 1, 1975)) : ' '.strtolower($startdate['4'])); }
      }    
    
      $end_day = ucwords($enddate['0']);
      $end_month = ucwords($enddate['1']);
      $end_daynumber = trim($enddate['2']);
      $end_year = $enddate['3'];
      if ( !$EXTCAL_CONFIG['time_format_12_or_24'] ) { $end_time = date("H:i", mktime($end_time_array[0], $end_time_array[1], 0, 1, 1, 1975)); }
      else { $end_time = date("g:i", mktime($end_time_array[0], $end_time_array[1], 0, 1, 1, 1975)) . (($enddate['4'] == '') ?  date(" a", mktime($end_time_array[0], $end_time_array[1], 0, 1, 1, 1975)) : ' '.strtolower($enddate['4']));}
    
      // If months are the same, return January 6-7, 2005. If not, return January 6 - February 7, 2005, if same year.
      if ( (($start_daynumber == $end_daynumber) && ($start_month == $end_month) && ($start_year == $end_year)) || $no_end_specified ) {
        // January 30, 2007 (08:00 - 10:00)
        $returnstring = strftime($EXTCAL_CONFIG['date_format'],mktime($start_time_array[0],$start_time_array[1],0,$start_date_array[1],$start_date_array[2],$start_date_array[0]));
    	$returnstring .= ( $EXTCAL_CONFIG['show_times'] ) ? ' (' . $start_time . ( ($EXTCAL_CONFIG['show_times'] == 3 || $no_end_specified) ? '' : ' - ' . $end_time ) . ')' : '';
      } else {
        $temp_start = strftime($EXTCAL_CONFIG['date_format'],mktime($start_time_array[0],$start_time_array[1],0,$start_date_array[1],$start_date_array[2],$start_date_array[0]));
        $temp_end   = strftime($EXTCAL_CONFIG['date_format'],mktime($end_time_array[0],$end_time_array[1],0,$end_date_array[1],$end_date_array[2],$end_date_array[0]));
        if ( $EXTCAL_CONFIG['show_times'] ) {
          $returnstring = $temp_start . '&nbsp;(' . $start_time . ') - ' . $temp_end . ( ($EXTCAL_CONFIG['show_times'] == 3 || $no_end_specified) ? '' : '&nbsp;(' . $end_time . ')' ) ;
    	} else {
          $returnstring = $temp_start . ' - ' . $temp_end;
    	}
      }
      
      if ( $EXTCAL_CONFIG['days_view'] )
      {
      	$datenow = time ( );
      	
      	$startdate = mktime($start_time_array[0], $start_time_array[1], 0, $start_date_array[1], $start_date_array[2], $start_date_array[0]);
      	
      	$difference = $startdate - $datenow;
     		
     		$days = $difference / 24 / 60 / 60;
      	
      	if ( $days >= 0 )
      	{  	
       		$returnstring = round ( $days ) . ' More Days';
       	}
       	else
       	{
       		$returnstring = round ( $days * -1 ) . ' Days Ago';
       	}
      }
      
      return $returnstring;
    }
}

if( !function_exists('process_extcal_description') )
  {
    function process_extcal_description($data)
    {
    /* Process message data with various conversions to eliminate bbcode and such*/
    
    	global $EXTCAL_CONFIG;
    
        // Is BBCcode allowed in the Extcal settings?
    
    	if (!$EXTCAL_CONFIG['strip_bbcode_from_description'])
    	{
    
    		$data = preg_replace("/\[B\](.*?)\[\/B\]/si", "<strong>\\1</strong>", $data);
    		$data = preg_replace("/\[I\](.*?)\[\/I\]/si", "<em>\\1</em>", $data);
    		$data = preg_replace("/\[U\](.*?)\[\/U\]/si", "<u>\\1</u>", $data);
    
    		$data = preg_replace("/\[LEFT\](.*?)\[\/LEFT\]/si", "<div align='left'>\\1</div>", $data);
    		$data = preg_replace("/\[CENTER\](.*?)\[\/CENTER\]/si", "<div align='center'>\\1</div>", $data);
    		$data = preg_replace("/\[RIGHT\](.*?)\[\/RIGHT\]/si", "<div align='right'>\\1</div>", $data);
    
    		$data = preg_replace("/\[URL\](http:\/\/)?(.*?)\[\/URL\]/si", "<A HREF=\"http://\\2\" target=\"_blank\">\\2</A>", $data);
    		$data = preg_replace("/\[URL=(http:\/\/)?(.*?)\](.*?)\[\/URL\]/si", "<A HREF=\"http://\\2\" target=\"_blank\">\\3</A>", $data);
    		$data = preg_replace("/\[EMAIL\](.*?)\[\/EMAIL\]/si", "<A HREF=\"mailto:\\1\" style=\"color:#446699\">\\1</A>", $data);
    		$data = preg_replace("/\[IMG\](.*?)\[\/IMG\]/si", "<IMG border=0 SRC=\"\\1\">", $data);
    
    		/* adding a space to beginning */
    		$data = " ".$data;
    
    		$data = preg_replace("#([\n ])([a-z]+?)://([^,<> \n\r]+)#i", "\\1<a href=\"\\2://\\3\" target=\"_blank\">\\2://\\3</a>", $data);
    
    		$data = preg_replace("#([\n ])www\.([a-z0-9\-]+)\.([a-z0-9\-.\~]+)((?:/[^,<> \n\r]*)?)#i", "\\1<a href=\"http://www.\\2.\\3\\4\" target=\"_blank\">www.\\2.\\3\\4</a>", $data);
    
    		$data = preg_replace("#([\n ])([a-z0-9\-_.]+?)@([^,<> \n\r]+)#i", "\\1<a href=\"mailto:\\2@\\3\">\\2@\\3</a>", $data);
    
    		/* Remove space */
    		$data = substr($data, 1);
    
    	} else {  // Remove code entirely when "Allow HTML" is disabled in Settings:
    		$data = preg_replace("/\[B\](.*?)\[\/B\]/si", "$1", $data);
    		$data = preg_replace("/\[I\](.*?)\[\/I\]/si", "$1", $data);
    		$data = preg_replace("/\[U\](.*?)\[\/U\]/si", "$1", $data);
    
    		$data = preg_replace("/\[LEFT\](.*?)\[\/LEFT\]/si", "$1", $data);
    		$data = preg_replace("/\[CENTER\](.*?)\[\/CENTER\]/si", "$1", $data);
    		$data = preg_replace("/\[RIGHT\](.*?)\[\/RIGHT\]/si", "$1", $data);
    
    		$data = preg_replace("/\[URL\](http:\/\/)?(.*?)\[\/URL\]/si", "$2", $data);
    		$data = preg_replace("/\[URL=(http:\/\/)?(.*?)\](.*?)\[\/URL\]/si", "$3", $data);
    		$data = preg_replace("/\[EMAIL\](.*?)\[\/EMAIL\]/si", "$1", $data);
    		$data = preg_replace("/\[IMG\](.*?)\[\/IMG\]/si", "$1", $data);
    	}
    	return $data;    
    }
}

if( !function_exists('add_recurrent_dates') )
  {
    function add_recurrent_dates( $thisEvent, $maxDates, &$rowsToAdd, $whichtype ) {
    	global $EXTCAL_CONFIG, $CONFIG_EXT;
    
    	// The idea with this function is to add all recurring events which have recurrences on or after
    	// today, whether they *started* before today or not.
    
    	$recurType = $thisEvent->recur_type;
    	$recurInterval = (int)$thisEvent->recur_val;
    	$recurOrdinal  = (int)$thisEvent->recur_ord;
    	$recurEndDate  = strtotime($thisEvent->recur_until);
    	$recurEndType  = (int)$thisEvent->recur_end_type;
    	$recurEndCount = (int)$thisEvent->recur_count;
    
		// If user has specified a recurrence type (daily/weekly), but the 
		// interval is 0, exit to avoid endless loop
		if( ($recurType!="") && ($recurInterval==0) ) return;
		
    	// If the event only recurs up to a certain date (recur type 1 or 2) and that date has arrived, then forget it.
    	// if ( (($recurEndType == 1) || ($recurEndType == 2))  &&  $recurEndDate < $EXTCAL_CONFIG['today_stamp']  &&  $whichtype == 'upcoming' ) return;
    	if ( ($recurEndType == 2)  &&  $recurEndDate < $EXTCAL_CONFIG['today_stamp']  &&  $whichtype == 'upcoming' ) return;
    
    	$eventNoEndSpecified = ( $thisEvent->end_date == '0000-00-00 00:00:00' ) ? true : false;
    	$eventIsAllDay = ( $thisEvent->end_date == '0000-00-00 00:00:01' ) ? true : false;
    
    	$startDay = (int)date("d", strtotime($thisEvent->start_date));
    	$startMonth = (int)date("m", strtotime($thisEvent->start_date));
    	$startYear = (int)date("Y", strtotime($thisEvent->start_date));
    	$startHour = (int)date("H", strtotime($thisEvent->start_date));
    	$startMinute = (int)date("i", strtotime($thisEvent->start_date));
    
    	$endDay = (int)date("d", strtotime($thisEvent->end_date));
    	$endMonth = (int)date("m", strtotime($thisEvent->end_date));
    	$endYear = (int)date("Y", strtotime($thisEvent->end_date));
    	$endHour = (int)date("H", strtotime($thisEvent->end_date));
    	$endMinute = (int)date("i", strtotime($thisEvent->end_date));
    
    	$duration = mktime($endHour,$endMinute,0,$endMonth,$endDay,$endYear) - mktime($startHour,$startMinute,0,$startMonth,$startDay,$startYear);

    	// Day-based recurrence, increment start date to next occurrence
		// of the specified day
		if( is_numeric($recurType) ) {
    		$startstamp = mktime($startHour,$startMinute,0,$startMonth,$startDay,$startYear);
			$target_day = $recurType;
			while( date("w",$startstamp) != $target_day ) $startstamp += 86400;
			$startDay = date("d",$startstamp);
			$startMonth = date("m",$startstamp);
			$startYear = date("Y",$startstamp);				
		}
		else {
    	$startstamp = mktime($startHour,$startMinute,0,$startMonth,$startDay,$startYear);
		}
		
    	$nextdatestamp = $startstamp;
    	$number_of_recurrences_added = 0;
		$recurrence_count = 0;

		// Process ordinal-based recurrences (1st/2nd Thursday, etc.)
		$first_time_through = true;
		$current_stamp = $startstamp;
		$recur_count = 1;
		while( $recurOrdinal && ( ($recurEndType == 2 && $current_stamp <= $recurEndDate) || ($recurEndType == 1 && $recur_count <= $recurEndCount) ) ) {
			$incrementBy = ( $first_time_through ) ? 0 : 1;
			$startDay += ($incrementBy*7);
			$current_stamp = mktime(0,0,0,$startMonth,$startDay,$startYear);
			$exact_current_stamp = mktime($startHour,$startMinute,0,$startMonth,$startDay,$startYear);
			$ord_count = 0;
			$ord_days = date("j",$current_stamp);
			$ord_month = date("m",$current_stamp);
			$ord_year = date("Y",$current_stamp);
			for( $i=1;$i<=$ord_days;++$i ) {
				$ord_stamp = mktime(0,0,0,$ord_month,$i,$ord_year);
				$exact_ord_stamp = mktime($startHour,$startMinute,0,$ord_month,$i,$ord_year);
				if( date("w",$ord_stamp) == $recurType ) {
					++$ord_count;
					if( ($ord_count == $recurOrdinal) && ($ord_stamp == $current_stamp) ) {
						$exclude_date = date("Y-m-d", $ord_stamp);
						$query = "SELECT extid, eventid, published, approved, start_date FROM " . $CONFIG_EXT['TABLE_EXCLUSIONS'] . " ";
				  		$query .= "WHERE eventid = '".$thisEvent->extid."' AND published = '1' AND approved = '1' AND start_date = '".$exclude_date."'";
				  		$excresult = extcal_db_query($query);
		
						if( extcal_db_num_rows($excresult) == 0 ) {			
							if( ($whichtype == 'upcoming' && $ord_stamp >= $EXTCAL_CONFIG['now_stamp'] ) || ($whichtype == 'recent' && $ord_stamp <= $EXTCAL_CONFIG['now_stamp']) ) {
			    				$thisEvent->start_date = date( 'Y-m-d H:i:s', $ord_stamp );
				    			$thisEvent->end_date = date( 'Y-m-d H:i:s', $ord_stamp + $duration );
								if ( $eventNoEndSpecified ) $thisEvent->end_date = '0000-00-00 00:00:00';
				                if ( $eventIsAllDay ) $thisEvent->end_date = '0000-00-00 00:00:01';
				                $eventcopy = real_clone($thisEvent);
				                $rowsToAdd [] = $eventcopy;
				                $number_of_recurrences_added++;
			    			}
			    			++$recur_count;
						}
						$i = $ord_days + 1;
					}
				}
			$first_time_through = false;
			}
		}
		
		while( !$recurOrdinal && ($number_of_recurrences_added < $maxDates) ) {
			
    		// If enough recurrences have been added already, stop the loop.
    		if ( $whichtype == 'upcoming'  &&  $number_of_recurrences_added >= $maxDates ) break;
    		  // If we've reached the maximum number of recurrences, stop the loop.
    		if ( $recurEndType == 1  &&  $recurrence_count >= $recurEndCount ) break;
    		  // If we've reached the end date for recurrence, stop the loop.
    		if ( $recurEndType == 2  &&  $nextdatestamp > $recurEndDate ) break;
    		  // If we're in Recent Events and have passed today's date, stop the loop.
    		if ( $whichtype == 'recent'  &&  $nextdatestamp >= $EXTCAL_CONFIG['now_stamp'] ) break;
			// If first occurrence only, and one has been displayed, stop the loop
    		if( $EXTCAL_CONFIG['show_recurrent_events'] == 2 && $number_of_recurrences_added ) break;
    		
    		if ( $whichtype == 'upcoming'  &&  $nextdatestamp < $EXTCAL_CONFIG['now_stamp'] ) {
    			$add_this_event = false;
    		} else	{
    			$thisEvent->start_date = date( 'Y-m-d H:i:s', $nextdatestamp );
    			$thisEvent->end_date = date( 'Y-m-d H:i:s', $nextdatestamp + $duration );
    			$add_this_event = true;
    	    }
    
    		if ( $add_this_event ) {
				$exclude_date = date("Y-m-d", $nextdatestamp);
				$query = "SELECT extid, eventid, published, approved, start_date FROM " . $CONFIG_EXT['TABLE_EXCLUSIONS'] . " ";
		  		$query .= "WHERE eventid = '".$thisEvent->extid."' AND published = '1' AND approved = '1' AND start_date = '".$exclude_date."'";
		  		$excresult = extcal_db_query($query);

				if( extcal_db_num_rows($excresult) == 0 ) {

					if ( $eventNoEndSpecified ) $thisEvent->end_date = '0000-00-00 00:00:00';
                	if ( $eventIsAllDay ) $thisEvent->end_date = '0000-00-00 00:00:01';
                	$eventcopy = real_clone($thisEvent);
                	$rowsToAdd [] = $eventcopy;
                	$number_of_recurrences_added++;
				}
    		}
			++$recurrence_count;
    		
    		// Increment the date to the next recurring date.
    		// the mktime() function is smart and adjusts dates properly. For example, if the day number adds up to '33'
    		// and there are only 30 days in the month, it will instead make it the 3rd day of the next month. Very cool.
    		$thisMonth = (int)date( "m", $nextdatestamp );
    		$thisDay = (int)date( "d", $nextdatestamp );
    		$thisYear = (int)date( "Y", $nextdatestamp );
    		switch($thisEvent->recur_type) {
    			case "day":
    				$nextdatestamp = mktime($startHour,$startMinute,0,$thisMonth,$thisDay+=$recurInterval,$thisYear);
    				break;
    			case "week":
				case "0":
				case "1":
				case "2":
				case "3":
				case "4":
				case "5":
				case "6":
    				$nextdatestamp = mktime($startHour,$startMinute,0,$thisMonth,$thisDay+=$recurInterval*7,$thisYear);
    				break;
    			case "month":
    				$nextdatestamp = mktime($startHour,$startMinute,0,$thisMonth+=$recurInterval,$thisDay,$thisYear);
    				break;
    			case "year":
    				$nextdatestamp = mktime($startHour,$startMinute,0,$thisMonth,$thisDay,$thisYear+=$recurInterval);
    				break;
    		}
    	}
    }
}

##-------------------Query all upcoming events:

if( !function_exists('sortUpcomingEvents') )
  {
    function sortUpcomingEvents( $a, $b ) {
        if ( strtotime($a->start_date) == strtotime($b->start_date) ) return 0;
	    return ( strtotime($a->start_date) < strtotime($b->start_date) ) ? -1 : 1;
    }
}

/*$calendarquery = "SELECT e.*,cal_name,cat,cat_name from #__jcalpro_events AS e LEFT JOIN #__jcalpro_categories AS c ON e.cat=c.cat_id LEFT JOIN #__jcalpro_calendars AS cal ON e.calendar=cal.cal_id
WHERE ( ( ( UNIX_TIMESTAMP(e.end_date) >= UNIX_TIMESTAMP('".$EXTCAL_CONFIG['now']."') ) OR ( UNIX_TIMESTAMP(e.start_date) >= UNIX_TIMESTAMP('".$EXTCAL_CONFIG['now']."') ) )
OR ( e.end_date = '0000-00-00 00:00:01' ) )
	  AND c.published = '1' AND e.published = '1' AND approved = '1' AND recur_type = ''"
	  . ( $calid ? " AND calendar='$calid' " : '' )
	  . ( $catid ? " AND ( cat IN ( $catid ) )" : '' ) . "
	   ORDER BY e.start_date,e.title ASC";*/
$calendarquery = "SELECT e.*,cat,cat_name from #__jcalpro_events AS e LEFT JOIN #__jcalpro_categories AS c ON e.cat=c.cat_id 
WHERE ( ( ( UNIX_TIMESTAMP(e.end_date) >= UNIX_TIMESTAMP('".$EXTCAL_CONFIG['now']."') ) OR ( UNIX_TIMESTAMP(e.start_date) >= UNIX_TIMESTAMP('".$EXTCAL_CONFIG['now']."') ) )
OR ( e.end_date = '0000-00-00 00:00:01' ) )
      AND c.published = '1' AND e.published = '1' AND approved = '1' AND recur_type = ''"
      . ( $catid ? " AND ( cat IN ( $catid ) )" : '' ) . "
       ORDER BY e.start_date,e.title ASC";
	   
$database->setQuery( $calendarquery );
$rowsUpcomingGross = $database->loadObjectList();

$reccount = count($rowsUpcomingGross);
$count=0;
while(  ( count($rowsUpcoming) < $EXTCAL_CONFIG['number_of_events_to_list_upcoming'] ) &&
        ( $count < $reccount ) ) {
    $row = $rowsUpcomingGross[$count];
	if ( has_priv ( 'category' . $row->cat ) ) {
	  if ( $row->end_date == '0000-00-00 00:00:01' ) {
	    // If this is an all day event, and it starts today or later, include it here
		if ( strtotime(substr($row->start_date,0,10)) >= strtotime(substr($EXTCAL_CONFIG['now'],0,10)) )  $rowsUpcoming[] = $row;
	  } else {
		$rowsUpcoming[] = $row;
	  }
	}
    ++$count;
  }

if ($EXTCAL_CONFIG['show_recurrent_events']) { // Show each recurrence of an event separately:

  $rowsToAdd = array();
  $recurringquery = "SELECT e.*,cat,cat_name from #__jcalpro_events AS e LEFT JOIN #__jcalpro_categories AS c ON e.cat=c.cat_id 
	 WHERE c.published = '1' AND e.published = '1' AND approved = '1' AND recur_type <> '' "
	  . ( $calid ? " AND calendar='$calid' " : '' )
	  . ( $catid ? "\n AND ( cat IN ( $catid ) )" : '' ) . "
	   ORDER BY e.start_date,e.title ASC";
  $database->setQuery( $recurringquery );
  $rowsUpcomingRecurrent = $database->loadObjectList();
  // For each recurring event, parse all the recurrences and add those that fit our time window to the "$rowsToAdd" array:
  foreach ( (array) $rowsUpcomingRecurrent as $row ) {
  	if ( has_priv ( 'category' . $row->cat ) )
	  {		
   		if ( $row->recur_type != '' ) add_recurrent_dates( $row, $EXTCAL_CONFIG['number_of_events_to_list_upcoming'], $rowsToAdd, 'upcoming' );
  	}
  }
  // Now we merge the arrays of non-recurrent and recurrent events:
  $rowsUpcoming = array_merge($rowsUpcoming,$rowsToAdd);

  // Now we sort the merged array by order of start date:
  usort( $rowsUpcoming, "sortUpcomingEvents" );

  // Now we've (possibly) added to the length of the array, we make sure it doesn't exceed our desired number of events:
  $rowsUpcoming = array_slice( $rowsUpcoming, 0, $EXTCAL_CONFIG['number_of_events_to_list_upcoming'] );

}

##-------------------Query all recent events:
if ($EXTCAL_CONFIG['number_of_events_to_list_recent']) {

  $calendarquery = "SELECT e.*,cal_name,cat,cat_name from #__jcalpro_events AS e LEFT JOIN #__jcalpro_categories AS c ON e.cat=c.cat_id LEFT JOIN #__jcalpro_calendars AS cal ON e.calendar=cal.cal_id
	 WHERE ( 
			( UNIX_TIMESTAMP(e.end_date)   < UNIX_TIMESTAMP('".$EXTCAL_CONFIG['now']."') AND  e.end_date != '0000-00-00 00:00:00' AND e.end_date != '0000-00-00 00:00:01')  OR 
			( UNIX_TIMESTAMP(e.start_date) < UNIX_TIMESTAMP('".$EXTCAL_CONFIG['now']."') AND (e.end_date  = '0000-00-00 00:00:00'  OR e.end_date  = '0000-00-00 00:00:01'))
	       ) 
	  AND c.published = '1' AND e.published = '1' AND approved = '1' AND recur_type = ''"
	  . ( $calid ? "\n AND calendar='$calid' " : '' )
	  . ( $catid ? "\n AND ( cat IN ( $catid ) )" : '' ) . "
	   ORDER BY e.start_date DESC";

  $database->setQuery( $calendarquery );
  $rowsRecentGross = $database->loadObjectList();

  $reccount = count($rowsRecentGross);
  $count = 0;
  while(  ( count($rowsRecent) < $EXTCAL_CONFIG['number_of_events_to_list_recent'] ) &&
          ( $count < $reccount ) ) {
    $row = $rowsRecentGross[$count];
	if ( has_priv ( 'category' . $row->cat ) )
	{	
		if ( $row->end_date == '0000-00-00 00:00:01' ) {
			// If this is an all day event, and it starts today or later, include it here
			if ( strtotime(substr($row->start_date,0,10)) > strtotime(substr($EXTCAL_CONFIG['now'],0,10)) )  $rowsRecent[] = $row;
		} else {
			$rowsRecent[] = $row;
		}
	}
    ++$count;
}

if ( $EXTCAL_CONFIG['show_recurrent_events'] == 3 ) { // Show only first occurrence of recurring events:

  $rowsToAdd = array();
  $recurringquery = "SELECT e.*,cal_name,cat,cat_name from #__jcalpro_events AS e LEFT JOIN #__jcalpro_categories AS c ON e.cat=c.cat_id LEFT JOIN #__jcalpro_calendars AS cal ON e.calendar=cal.cal_id
	 WHERE ( UNIX_TIMESTAMP(e.end_date) < UNIX_TIMESTAMP('".$EXTCAL_CONFIG['now']."') ) AND ( UNIX_TIMESTAMP(e.start_date) < UNIX_TIMESTAMP('".$EXTCAL_CONFIG['now']."') )
	  AND c.published = '1' AND e.published = '1' AND approved = '1' AND recur_type = ''"
	  . ( $calid ? "\n AND calendar='$calid' " : '' )
	  . ( $catid ? "\n AND ( cat IN ( $catid ) )" : '' ) . "
	   ORDER BY e.start_date,e.title ASC";
  $database->setQuery( $recurringquery );
  $rowsRecentRecurrent = $database->loadObjectList();

  // Now we merge the arrays of non-recurrent and recurrent events:
  $rowsRecent = array_merge($rowsRecent,$rowsRecentRecurrent);

  // Now we sort the merged array by order of start date:
  if( !function_exists('sortRecentEvents') ) {
    function sortRecentEvents( $a, $b ) {
        if ( strtotime($a->start_date) == strtotime($b->start_date) ) return 0;
    	return ( strtotime($a->start_date) > strtotime($b->start_date) ) ? -1 : 1;
      }
  }
  usort( $rowsRecent, "sortRecentEvents" );

  // Now we've (possibly) added to the length of the array, we make sure it doesn't exceed our desired number of events:
  $rowsRecent = array_slice( $rowsRecent, 0, $EXTCAL_CONFIG['number_of_events_to_list_recent'] );

} else if ($EXTCAL_CONFIG['show_recurrent_events']) { // Show each recurrence of an event separately:

  $rowsToAdd = array();
  $recurringquery = "SELECT e.*,cal_name,cat,cat_name from #__jcalpro_events AS e LEFT JOIN #__jcalpro_categories AS c ON e.cat=c.cat_id LEFT JOIN #__jcalpro_calendars AS cal ON e.calendar=cal.cal_id
	 WHERE ( UNIX_TIMESTAMP(e.end_date) < UNIX_TIMESTAMP('".$EXTCAL_CONFIG['now']."') )
	  AND c.published = '1' AND e.published = '1' AND approved = '1' AND recur_type != ''"
	  . ( $calid ? "\n AND calendar='$calid' " : '' )
	  . ( $catid ? "\n AND ( cat IN ( $catid ) )" : '' ) . "
	   ORDER BY e.start_date,e.title ASC";

  $database->setQuery( $recurringquery );
  $rowsRecentRecurrent = $database->loadObjectList();

  // For each recurring event, parse all the recurrences and add those that fit our time window to the "$rowsToAdd" array:
  foreach ( (array) $rowsRecentRecurrent as $row ) {
    if ( has_priv ( 'category' . $row->cat ) )
	  {		
    	if ( $row->recur_type != '' ) add_recurrent_dates( $row, 1000, $rowsToAdd, 'recent' );
  	}
  }
  // Now we merge the arrays of non-recurrent and recurrent events:
  $rowsRecent = array_merge($rowsRecent,$rowsToAdd);

  // Now we sort the merged array by order of start date:
  if( !function_exists('sortRecentEvents') ) {
    function sortRecentEvents( $a, $b ) {
        if ( strtotime($a->start_date) == strtotime($b->start_date) ) return 0;
    	return ( strtotime($a->start_date) > strtotime($b->start_date) ) ? -1 : 1;
      }
  }
  usort( $rowsRecent, "sortRecentEvents" );

  // Now we've (possibly) added to the length of the array, we make sure it doesn't exceed our desired number of events:
  $rowsRecent = array_slice( $rowsRecent, 0, $EXTCAL_CONFIG['number_of_events_to_list_recent'] );

}

}


if ( ((count($rowsUpcoming) + count($rowsRecent)) > 0) || $EXTCAL_CONFIG['display_if_no_events'] ) {  // IF: Don't display if there are no events and the parameter is set not to

##-------------------First, set the proper locale if parameter says to:

if ( $EXTCAL_CONFIG['use_extcal_locale_settings'] ) {

	// Mambo already has a locale set in Site Configuration. If the locale code from the ExtCal language files
	// is NOT used, it just sticks with the one already set.

	$extcal_language_path = $mosConfig_absolute_path . "/components/com_jcalpro/languages/";
	if (!file_exists($extcal_language_path."{$mosConfig_lang}/index.php")) $mosConfig_lang = 'english';
	include $extcal_language_path."{$mosConfig_lang}/index.php";
	if ( isset($lang_info['locale']) && is_array($lang_info['locale']) ) {
		foreach( $lang_info['locale'] as $temp_lang_code ) {
			$locale_was_set =  setlocale (LC_TIME,$temp_lang_code);
		}
	}

}

##-------------------Second, define an important constant if not defined already:

if ( !defined('EXTCAL_TEXT_ALL_DAY') ) {

	if ( isset($lang_add_event_view) ) {
		define('EXTCAL_TEXT_ALL_DAY',$lang_add_event_view['all_day_label']);
	} else {
		$extcal_language_path = $mosConfig_absolute_path . "/components/com_jcalpro/languages/";
		if (!file_exists($extcal_language_path."{$mosConfig_lang}/index.php")) $mosConfig_lang = 'english';
		require_once $extcal_language_path."{$mosConfig_lang}/index.php";
		define('EXTCAL_TEXT_ALL_DAY',$lang_add_event_view['all_day_label']);
	}

}

##-------------------Upcoming Events Section:

if ( count($rowsUpcoming) ) {

    $extcounter = 0;
    $module_output_array = array();
    $module_output_array[$extcounter] = "";
    $previouseventmonth = '';
	
    if( $outputSetting == 1 && !$EXTCAL_CONFIG['show_month_separators'] ) { $module_output_array[$extcounter] .= "<ul>"; }

	foreach ( $rowsUpcoming as $thisEvent ) { // For each upcoming event we do:
    
    $thiseventmonth = strftime("%B",strtotime($thisEvent->start_date));
    if ( $EXTCAL_CONFIG['show_month_separators'] ) { // If "Show Month Separators" is enabled in Administration, draw the month name:
      if ($thiseventmonth != $previouseventmonth) {
        // If this is a new month and it's not the first incident, we decrement the counter so that
        // this event is simply added to the the previous array index. Now when we implode a few lines
        // down, it won't add the event separator between the event and the month separator.
        if( $outputSetting == 1 && $previouseventmonth != '' ) { $module_output_array[$extcounter] .= "</ul>"; }
        $module_output_array[$extcounter] .= '<div'.$EXTCAL_CONFIG['month_separator_style'].'>' . ucwords($thiseventmonth) . '</div>';
        if( $outputSetting == 1 ) { $module_output_array[$extcounter] .= "<ul>"; }
        $previouseventmonth = $thiseventmonth;
      }
    }

	$ext_event_link_URL = JRoute::_( 'index.php?option=com_jcalpro&amp;Itemid=' . $EXTCAL_CONFIG['Itemid'] . '&amp;extmode=view&amp;extid='. $thisEvent->extid );
	$ext_full_calendar_URL = JRoute::_( 'index.php?option=com_jcalpro&amp;Itemid=' . $EXTCAL_CONFIG['Itemid'] );
	// Actual output:
	if ( $outputSetting == 1)
	  {
	  	$module_output_array[$extcounter] .= '<li>';
	  }
	else
	  {
	  	$module_output_array[$extcounter] .= '<div class="latest_event">';
	  }
	  
	$module_output_array[$extcounter] .= '<a href="' . $ext_event_link_URL . '">' . mf_shorten_with_ellipsis($thisEvent->title,$EXTCAL_CONFIG['title_max_length']);
	$module_output_array[$extcounter] .= $EXTCAL_CONFIG['show_calendar'] ? ' - ' . $thisEvent->cal_name : '';
	$module_output_array[$extcounter] .= "</a><br />\n";
	if( $EXTCAL_CONFIG['show_dates'] ) {
		$module_output_array[$extcounter] .=  mf_get_daterange_string( $thisEvent );
		$module_output_array[$extcounter] .= "<br />\n";
	}
	$module_output_array[$extcounter] .= $EXTCAL_CONFIG['show_category'] ? '(<em>' . $thisEvent->cat_name . '</em>) ' : '';
	$module_output_array[$extcounter] .= $EXTCAL_CONFIG['show_description'] ? sub_string($thisEvent->description,$EXTCAL_CONFIG['description_max_length'],'...') : '';
    
    $module_output_array[$extcounter] .= $EXTCAL_CONFIG['show_contact'] ? '<br /><small>' .$thisEvent->contact . '</small>' : '';
	  
	if ( $outputSetting == 1)
	  {
	  	$module_output_array[$extcounter] .= "</li>\n";
	  }
	  else
	  {
	  	$module_output_array[$extcounter] .= "</div>\n";
	  }
	  $extcounter++;
	  $module_output_array[$extcounter] = '';
	}

	if ( $outputSetting == 1)
	{
	  $module_output_array[$extcounter] .= "</ul>\n";
	}

    // Get event separator only if output is not a table (<ul>)
    if( $outputSetting != 1 ) { $event_separator = $EXTCAL_CONFIG['event_separator']; }
    else { $event_separator = ""; }

	// We did this in an array so we can implode it and separate the entries with whatever we want.
	$module_output .= implode($event_separator,$module_output_array);
	
} else {

	$module_output .= '<div class="latest_event">'.$EXTCAL_CONFIG['no_upcoming_events_text'].'</div>';
}

##-------------------Recent Events Section (if enabled in the module parameters):

if ( $EXTCAL_CONFIG['number_of_events_to_list_recent'] && (@count($rowsRecent) > 0) ) {

	$module_output .= '<div'.$EXTCAL_CONFIG['recent_events_style'].'>' . $EXTCAL_CONFIG['recent_events_text'] . '</div>';
	$extcounter = 0;
	$module_output_array = array();
    $module_output_array[$extcounter] = "";
    $previouseventmonth = '';
	
    if( $outputSetting == 1 && !$EXTCAL_CONFIG['show_month_separators'] ) { $module_output_array[$extcounter] .= "<ul>"; }

	  foreach ( $rowsRecent as $thisEvent ) { // For each upcoming event we do:

	  if ( $EXTCAL_CONFIG['show_month_separators'] ) { // If "Show Month Separators" is enabled in Administration, draw the month name:
	    $thiseventmonth = strftime("%B",strtotime($thisEvent->start_date));
        if ($thiseventmonth != $previouseventmonth) {
          if( $outputSetting == 1 && $previouseventmonth != '' ) { $module_output_array[$extcounter] .= "</ul>"; }
          $module_output_array[$extcounter] .= '<div'.$EXTCAL_CONFIG['month_separator_style'].'>' . ucwords($thiseventmonth) . '</div>';
          if( $outputSetting == 1 ) { $module_output_array[$extcounter] .= "<ul>"; }
          $previouseventmonth = $thiseventmonth;
        }
	  }

	  $ext_event_link_URL = JRoute::_( 'index.php?option=com_jcalpro&amp;Itemid=' . $EXTCAL_CONFIG['Itemid'] . '&amp;extmode=view&amp;extid='. $thisEvent->extid );
	  // Actual output:
	  if ( $outputSetting == 1)
	    {
	    	$module_output_array[$extcounter] .= '<li>';
	    }
	  else
	    {
	    	$module_output_array[$extcounter] .= '<div class="latest_event">';
	    }
	  $module_output_array[$extcounter] .= '<a href="' . $ext_event_link_URL . '">' . mf_shorten_with_ellipsis($thisEvent->title,$EXTCAL_CONFIG['title_max_length']) . '</a>';
	  $module_output_array[$extcounter] .= '<br />';
	  if( $EXTCAL_CONFIG['show_dates'] ) {
	  	$module_output_array[$extcounter] .=  mf_get_daterange_string($thisEvent);
	  	$module_output_array[$extcounter] .= '<br />';
	  }
	  $module_output_array[$extcounter] .= $EXTCAL_CONFIG['show_category'] ? '(<em>' . $thisEvent->cat_name . '</em>) ' : '';
	  $module_output_array[$extcounter] .= $EXTCAL_CONFIG['show_description'] ? sub_string($thisEvent->description,$EXTCAL_CONFIG['description_max_length'],'...') : '';
      $module_output_array[$extcounter] .= $EXTCAL_CONFIG['show_contact'] ? '<br /><small>' .$thisEvent->contact . '</small>' : '';
	  
      if ( $outputSetting == 1)
	    {
	    	$module_output_array[$extcounter] .= '</li>';
	    }
	  else
	    {
	    	$module_output_array[$extcounter] .= '</div>';
	    }
	  
	  $extcounter++;
	  $module_output_array[$extcounter] = '';
	}

	if ( $outputSetting == 1)
	{
	  $module_output_array[$extcounter] .= '</ul>';
	}

    // Get event separator only if output is not a table (<ul>)
    if( $outputSetting != 1 ) { $event_separator = $EXTCAL_CONFIG['event_separator']; }
    else { $event_separator = ""; }

	// We did this in an array so we can implode it and separate the entries with whatever we want.
	$module_output .= implode($event_separator,$module_output_array);	
}

##-------------------Extra Links to Full Calendar and Add New Event:

if ( $EXTCAL_CONFIG['show_full_calendar_link'] ) {
  $ext_full_calendar_URL = JRoute::_( 'index.php?option=com_jcalpro&Itemid=' . $EXTCAL_CONFIG['Itemid'] );
  $module_output .= '<a href="'.$ext_full_calendar_URL.'">' . $EXTCAL_CONFIG['full_calendar_link_text'] . '</a><br />';
}
if ( $EXTCAL_CONFIG['show_add_event_link'] && latest_has_priv($EXTCAL_CONFIG['who_can_add_events']) ) {
  $ext_add_event_URL = JRoute::_( 'index.php?option=com_jcalpro&amp;Itemid=' . $EXTCAL_CONFIG['Itemid'] . '&amp;extmode=event&amp;event_mode=add' );
  $module_output .= '<a href="'.$ext_add_event_URL.'">' . $EXTCAL_CONFIG['add_event_text'] . '</a><br />';
}

##-------------------Set the locale for date/time functions back to the one already set by Mambo:
if ( $locale_was_set ) setlocale(LC_TIME,$mosConfig_locale);

echo $module_output;

} // ENDIF: Don't display if there are no events and the parameter is set not to

?>