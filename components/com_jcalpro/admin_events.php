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

$File: admin_events.php - Events adminstration$

Revision date: 03/04/2007

**********************************************
Get the latest version of JCal Pro at:
http://dev.anything-digital.com//
**********************************************
*/

/** ensure this file is being included by a parent file */
defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );

global $today, $lang_add_event_view, $extmode, $errors, $lang_settings_data;

if (!defined('ADMIN_EVENTS_PHP')) {
  define('ADMIN_EVENTS_PHP', true);
  include $CONFIG_EXT['LANGUAGES_DIR']."{$CONFIG_EXT['lang']}/index.php";
  }

if(!empty($event_mode)) {

	switch($event_mode) {
		case 'add':
			if (require_priv('add')) {
				$event_mode = 'view';
				pageheader($lang_event_admin_data['add_event'] . " :: " . $lang_event_admin_data['section_title']);
				print_admin_add_event_form($date);
			}
			break;

		case 'edit':
			if(!empty($extid) && require_priv('edit')) {
				$event_mode = 'view';
				pageheader($lang_event_admin_data['edit_event'] . " :: " . $lang_event_admin_data['section_title']);
				print_edit_event_form($extid);
			} else if (has_priv('Administrator')) {
				pageheader($lang_event_admin_data['section_title']);
				print_event_list();
			}
		    break;

		case 'view' :
			if(!empty($extid) && require_priv('add'))  {
				pageheader($lang_event_admin_data['view_event'] . " :: " . $lang_event_admin_data['section_title']);
				print_event($extid);
			} else if (has_priv('approve')) {
				pageheader($lang_event_admin_data['section_title']);
				print_event_list();
			}
			break;

		case 'del' :
			if( !empty($extid) && require_priv('delete') ) {
				$event_mode = 'view';
				pageheader($lang_event_admin_data['delete_event'] . " :: " . $lang_event_admin_data['section_title']);
				delete_event($extid);
			} else if (has_priv('Administrator')) {
				pageheader($lang_event_admin_data['section_title']);
				print_event_list();
			}
			break;

		case 'apr' :
			if(!empty($extid) && require_priv('approve')) {
				$event_mode = 'view';
				pageheader($lang_event_admin_data['approve_event'] . " :: " . $lang_event_admin_data['section_title']);
				approve_event($extid);
			} else if (has_priv('Administrator')) {
				pageheader($lang_event_admin_data['section_title']);
				print_event_list();
			}
			break;
/* 	
		case 'update' :
		    require_priv($CONFIG_EXT['who_can_edit_events']);
		    if ( has_priv('Administrator') ) $event_mode = 'view'; // DEBUG: JUST GETTING STARTED ON THIS STUFF DON'T USE
			else { $extmode = 'view'; } // DEBUG: JUST GETTING STARTED ON THIS STUFF DON'T USE
			pageheader($lang_event_admin_data['update_event'] . " :: " . $lang_event_admin_data['section_title']);
			update_event($_POST);
			//print_event_list();
			break; */

		default:
			if (require_priv('add')) {
				$event_mode = 'view';
				pageheader($lang_event_admin_data['section_title']);
				print_event_list();
			}
			else $event_mode = '';
			break;
	}

  
} else {
    if (require_priv('add')) {
	  pageheader($lang_event_admin_data['section_title']);
	  print_event_list();
	}
}

// Functions

function print_admin_add_event_form($date = '') {
	// function to display events under a specific category
	global $CONFIG_EXT, $today, $lang_add_event_view, $lang_system; 
	global $lang_general, $extmode, $errors, $lang_settings_data;
    $database = &JFactory::getDBO();
	
	if (($CONFIG_EXT['add_event_view'] || has_priv('add')) && require_priv('add')) // enabled or not ?
  {
  	$successful = false;
	  $form = &$_POST;
		
		// Check date. if no date is passed as argument, then we pick today
    if (empty($date))
    {
      $day = $today['day'];
      $month = $today['month'];
      $year = $today['year'];
		}
    else
    {
    	$day = $date['day'];
    	$month = $date['month'];
    	$year = $date['year'];
    }

		// check if "show past events" is enabled, else force the date to today's date
		if(mktime(0,0,0,$month,$day,$year) < mktime(0,0,0,$today['month'],1,$today['year']) && !$CONFIG_EXT['archive']) {
      $day = $today['day'];
      $month = $today['month'];
      $year = $today['year'];
		}

		$day = isset($form['day'])?$form['day']:$day;
		$month = isset($form['month'])?$form['month']:$month;
		$year = isset($form['year'])?$form['year']:$year;

		if (isset($form['title'])) $title = addslashes($form['title']); else $title = '';
		if (isset($form['description'])) $description = addslashes($form['description']); else $description = '';
		if (isset($form['contact'])) $contact = addslashes($form['contact']); else $contact = '';
		if (isset($form['email'])) $email = addslashes($form['email']); else $email = '';
		if (isset($form['url'])) $url = addslashes($form['url']); else $url = '';
		if (intval($form['cat'])>0) $cat = $form['cat']; else $cat = '';

		// Clean description
		
		if ( !$CONFIG_EXT['addevent_allow_html'] )
		{
			$description = strip_tags ( $description );
			$description = preg_replace("'<script[^>]*?>.*?</script>'si", "", $description);
			$description = preg_replace("'<head[^>]*?>.*?</head>'si", "", $description);
			$description = preg_replace("'<body[^>]*?>.*?</body>'si", "", $description);
			$description = str_replace('&','&amp;',$description);
			$description = html_entity_decode($description);
		}
		
		function unhtmlentities($string)
		{
		   // replace numeric entities
		   $string = preg_replace('~&#x([0-9a-f]+);~ei', 'chr(hexdec("\\1"))', $string);
		   $string = preg_replace('~&#([0-9]+);~e', 'chr(\\1)', $string);
		   // replace literal entities
		   $trans_tbl = get_html_translation_table(HTML_ENTITIES);
		   $trans_tbl = array_flip($trans_tbl);
		   return strtr($string, $trans_tbl);
		}
		
		//$description = unhtmlentities($description);
		$description = addslashes(unhtmlentities($description));
		
		if(count($_POST)) {
		// Process user submission

			// Form Validation	
			$errors = '';
			if (empty($title)) $errors .=  theme_error_string($lang_add_event_view['no_title']);
			if (empty($cat)) $errors .= theme_error_string($lang_add_event_view['no_cat']);
			if (empty($day) || empty($month) || empty($year) || !checkdate($month,$day,$year)) $errors .= theme_error_string($lang_add_event_view['date_invalid']);

			if ($form['duration_type'] == '1') {
				$form['end_days'] = empty($form['end_days'])?'0':$form['end_days'];
				$form['end_hours'] = empty($form['end_hours'])?'0':$form['end_hours'];
				$form['end_minutes'] = empty($form['end_minutes'])?'0':$form['end_minutes'];
				if (!is_numeric($form['end_days'])) { $errors .= theme_error_string($lang_add_event_view['end_days_invalid']); }
				if (!is_numeric($form['end_hours'])) { $errors .= theme_error_string($lang_add_event_view['end_hours_invalid']); }
				if (!is_numeric($form['end_minutes'])) { $errors .= theme_error_string($lang_add_event_view['end_minutes_invalid']); }
			}

			// check recurrence information
			switch((int)$form['recur_type_select']) {
				case 1:
					if (!is_numeric($form['recur_val_1']) || (int)$form['recur_val_1'] < 1) { $errors .= theme_error_string($lang_add_event_view['recur_val_1_invalid']); }
					break;
				case 0:
				default:
			}
			switch((int)$form['recur_end_type']) {
				case 0:
					break;
				case 1:
					if (!is_numeric($form['recur_end_count']) || (int)$form['recur_end_count'] < 1) { $errors .= theme_error_string($lang_add_event_view['recur_end_count_invalid']); }
					break;
				case 2:
					if (mktime(0,0,0,$month,$day,$year) > mktime(0,0,0,$form['recur_until_month'],$form['recur_until_day'],$form['recur_until_year'])) { $errors .= theme_error_string($lang_add_event_view['recur_end_until_invalid']); }
					break;
				default:
					
			}

			if(!$errors) {

				$url = str_replace("http://","",$url);
				
				if ( has_priv ( "add" ) )
				{
					 $approve = ( isset ( $form['autoapprove'] ) ) ? 1 : 0;
				}
				//else {
					// determine if the specified category requires the event to be approved
					//$query = "SELECT options FROM " . $CONFIG_EXT['TABLE_CATEGORIES'] . " WHERE cat_id = $cat";
					//$result = extcal_db_query($query);
					//$options = extcal_db_fetch_array($result);
					//$approve = $options['options'] & 1;
					//extcal_db_free_result($result);
				//}
				
				if($CONFIG_EXT['time_format_24hours']) $start_time_hour = $form['start_time_hour']; // 24 hours mode
				else $start_time_hour = extcal_12to24hour($form['start_time_hour'], $form['start_time_ampm']); // 12 hours mode
				$start_date = date("Y-m-d H:i:s", mktime($start_time_hour, $form['start_time_minute'], 0, $month, $day, $year));					

// Here is where we deal with what kind of duration to use. If a duration is specified, we calculate the end_date to enter into the database.
// If not, we enter a special end_date instead.

				if ($form['duration_type'] == '1') { // This is a normal event, with a SPECIFIED duration
					if($form['end_days'] > 0 && !$form['end_hours'] && !$form['end_minutes']) {
						$form['end_days']--; // to make sure not to jump to the next day, we push the time to 23:59:59
						$total_hours = 23;
						$total_minutes = 59;
						$total_seconds = 59;
					} else {
						$total_hours = $start_time_hour + $form['end_hours'];
						$total_minutes = $form['start_time_minute'] + $form['end_minutes'];
						$total_seconds = 0;
					}
					$end_date = date("Y-m-d H:i:s", mktime( $total_hours, $total_minutes, $total_seconds, $month, $day + $form['end_days'], $year));						
				} else if ($form['duration_type'] == '2') { // This is an event where "No end date" was checked instead
					$end_date = '0000-00-00 00:00:01';
				} else { // This is an event where "No end date" was checked instead
					$end_date = '0000-00-00 00:00:00';
				}

				// Set recurrence information
				switch((int)$form['recur_type_select']) {
					case 1:
						$recur_type = $form['recur_type_1'];
						$recur_val = $form['recur_val_1'];
						break;
					case 0:
					default:
						$recur_type = '';
						$recur_val = 0;
						break;
				}
				$recur_end_type = $form['recur_end_type'];
				$recur_count = $form['recur_end_count'];
				
				// Determine the recur_until value by doing actual calculation if necessary. If the recur type
				// is "recur x number of times" then we calculate the end date.
				if ( $recur_end_type == 0 || $recur_type == '' ) $recur_until = substr($start_date,0,10);
				else if ( $recur_end_type == 2 ) $recur_until = date("Y-m-d", mktime(0, 0, 0, $form['recur_until_month'], $form['recur_until_day'], $form['recur_until_year']));
				else {
					switch ( $recur_type ) {
						case "day":
								$enddatestamp = mktime(0,0,0,$month,$day+($recur_val*$recur_count),$year);
								break;
						case "week":
								$enddatestamp = mktime(0,0,0,$month,$day+($recur_val*$recur_count*7),$year);
								break;
						case "month":
								$enddatestamp = mktime(0,0,0,$month+($recur_val*$recur_count),$day,$year);
								break;
						case "year":
								$enddatestamp = mktime(0,0,0,$month,$day,$year+($recur_val*$recur_count));
								break;
						default:
								break;
					}
					$recur_until = date("Y-m-d", $enddatestamp);
				}

				//$picture = 'deprecated%20remove%20it%20sooner%20or%20later';

				$query = "
				INSERT INTO ".$CONFIG_EXT['TABLE_EVENTS']." (
					title, description, contact, url, email, picture, cat, day, month, year, start_date, end_date, approved, recur_type, recur_val, recur_end_type, recur_count, recur_until, published
				) VALUES (
					'$title','$description','$contact','$url','$email','$picture','$cat','$day','$month','$year','$start_date','$end_date','$approve','$recur_type','$recur_val','$recur_end_type','$recur_count','$recur_until', '1'
				)";
				extcal_db_query($query);
				
				if (!$approve && !has_priv("approve"))
				{
					if ($CONFIG_EXT['new_post_notification'])
					{
						// send email notification
						$duration_array = datestoduration ($start_date,$end_date);
						$days_string = $duration_array['days']?$duration_array['days']." ".$lang_general['day']. " ":'';
						$days_string = $duration_array['days']>1?$duration_array['days']." ".$lang_general['days']. " ":$days_string;
						$hours_string = $duration_array['hours']?$duration_array['hours']." ".$lang_general['hour']. " ":'';
						$hours_string = $duration_array['hours']>1?$duration_array['hours']." ".$lang_general['hours']. " ":$hours_string;
						$minutes_string = $duration_array['minutes']?$duration_array['minutes']." ".$lang_general['minute']:'';
						$minutes_string = $duration_array['minutes']>1?$duration_array['minutes']." ".$lang_general['minutes']:$minutes_string;
					
						// create an instance of the mail class
						$mail = new extcalMailer;
						
						// Now you only need to add the necessary stuff
						$mail->AddAddress($CONFIG_EXT['calendar_admin_email'], " ");
						$mail->Subject = sprintf($lang_system['new_event_subject'], $CONFIG_EXT['app_name']);

				$sef_href = JRoute::_( $CONFIG_EXT['calendar_calling_page'].'&extmode=event&event_mode=view&extid=' . extcal_db_insert_id() );
		        $event_link = $sef_href;
		        $template_vars = array(
							'{CALENDAR_NAME}' => $CONFIG_EXT['app_name'],
							'{TITLE}' => $title,
							'{DATE}' => $start_date,
							'{DURATION}' => $days_string.$hours_string.$minutes_string,
							'{LINK}' => $event_link
						);

						$mail->Body  = strtr($lang_system['event_notification_body'], $template_vars);

						if(!$mail->Send() && $CONFIG_EXT['debug_mode'])
						{
							// An error occurred while trying to send the email
							$sef_href = JRoute::_( $CONFIG_EXT['calendar_calling_page'] );
							theme_redirect_dialog($lang_system['system_caption'], $lang_system['event_notification_failed'], $lang_general['back'], $sef_href);
							pagefooter();
							exit;
						}
					}
				}
				// Successfull message
				$sef_href = JRoute::_( $CONFIG_EXT['calendar_calling_page'] );
				if($approve) theme_redirect_dialog($lang_add_event_view['section_title'], $lang_add_event_view['submit_event_approved'], $lang_general['continue'], $sef_href);
				else theme_redirect_dialog($lang_add_event_view['section_title'], $lang_add_event_view['submit_event_pending'], $lang_general['continue'], $sef_href);
				// to remember not to display the form again
				$successful = true;
			} 
		} else {
			// No HTTP post or get requests found. THESE ARE THE DEFAULT VALUES FOR ADDING NEW EVENTS:
			$form['autoapprove'] = true;
			$form['end_days'] = '1';
			$form['end_hours'] = '0';
			$form['end_minutes'] = '0';
			$form['start_time_hour'] = '8';
			$form['start_time_minute'] = '0';
			$form['start_time_ampm'] = 'am';
			$form['day'] = $day;
			$form['month'] = $month;
			$form['year'] = $year;
			// initial values for recurrence
			$form['recur_type_select'] = '0';
			$form['recur_type_1'] = 'day';
			$form['recur_val_1'] = '1';
			$form['recur_end_type'] = '0';
			$form['recur_end_count'] = '1';
			$form['recur_until_day'] = $day;
			$form['recur_until_month'] = $month;
			$form['recur_until_year'] = $year;
			$form['duration_type'] = '1';
		}
		
		// Render the form
    if(!$successful) {
			$sef_href = JRoute::_( $CONFIG_EXT['calendar_calling_page'].'&extmode=event&event_mode=add' );
			display_event_form($sef_href,'event',$form,'add');
		}
  } else if (require_priv('add')) {
    $sef_href = JRoute::_( $CONFIG_EXT['calendar_calling_page'] );
    theme_redirect_dialog($lang_add_event_view['section_title'], $lang_system['section_disabled'], $lang_general['back'], $sef_href);
  }
}

function print_edit_event_form($eventid) {
/* print a blank owner form so we can add a new owner */

	global $CONFIG_EXT, $database, $my, $zone_stamp, $errors, $lang_event_admin_data, $lang_general, $lang_add_event_view, $lang_system, $lang_settings_data;

			if(count($_POST)) $form = $_POST;
			else {
				$query = "
				SELECT * FROM ".$CONFIG_EXT['TABLE_EVENTS']."
				WHERE extid= $eventid";
				$result = extcal_db_query($query);
				$form = extcal_db_fetch_array($result);
				$form['origpicture'] = $form['picture'];
				
				$form['autoapprove'] = 1;
				
				if($CONFIG_EXT['time_format_24hours']) {
					$form['start_time_hour'] = date("G", strtotime($form['start_date']));
					$form['start_time_ampm'] = '';
				} else {
					$form['start_time_hour'] = date("g",strtotime($form['start_date']));
					$form['start_time_ampm'] = date("a",strtotime($form['start_date']));
				}
				$form['start_time_minute'] = date("i", strtotime($form['start_date']));
				$form['day'] = date("d",strtotime($form['start_date']));
				$form['month'] = date("m",strtotime($form['start_date']));
				$form['year'] = date("Y",strtotime($form['start_date']));
				
				if ( ($form['end_date'] == '0000-00-00 00:00:00') || ($form['end_date'] == '0000-00-00 00:00:01') ) { // This is an event with NO duration specified. Zero the duration fields.
					$form['duration_type'] = (intval(substr(-1,1)))?2:0; // This sets which radio button ('duration_type') to check by reading the last digit of the end_date
					$form['end_days'] = '0';
					$form['end_hours'] = '0';
					$form['end_minutes'] = '0';
				} else {
					$duration_array = datestoduration ($form['start_date'],$form['end_date']);

					$form['end_days'] = $duration_array['days'];
					$form['end_hours'] = $duration_array['hours'];
					$form['end_minutes'] = $duration_array['minutes'];
					$form['duration_type'] = 1;
				}
				
				// Additional Reccurrence info processing
				$form['recur_end_count'] = $form['recur_count'];

				switch($form['recur_type']) {
					case 'day':
					case 'week':
					case 'month':
					case 'year':
						$form['recur_type_select'] = '1';
						$form['recur_type_1'] = $form['recur_type'];
						$form['recur_val_1'] = $form['recur_val'];
						break;
					case '':
					default:
						$form['recur_type_select'] = '0';
						$form['recur_type_1'] = $form['recur_type'];
						$form['recur_val_1'] = $form['recur_val'];
						break;
				}
				$recur_until_stamp = strtotime($form['recur_until']." 00:00:00");
				$form['recur_until_day'] = date("d", $recur_until_stamp);
				$form['recur_until_month'] = date("m", $recur_until_stamp);
				$form['recur_until_year'] = date("Y", $recur_until_stamp);

			}
			$successful = false;
			
			$day = $form['day'];
			$month = $form['month'];
			$year = $form['year'];

			if (isset($form['title'])) $title = addslashes($form['title']); else $title = '';
			if (isset($form['description'])) $description = addslashes($form['description']); else $description = '';
			if (isset($form['contact'])) $contact = addslashes($form['contact']); else $contact = '';
			if (isset($form['email'])) $email = addslashes($form['email']); else $email = '';
			if (isset($form['url'])) $url = addslashes($form['url']); else $url = '';
			if (isset($form['cat'])) $cat = $form['cat']; else $cat = '';

			if(count($_POST)) {
				// Process user submission
				// Form Validation
				$errors = '';
				$dateok = true;
				if (empty($title)) $errors .=  theme_error_string($lang_event_admin_data['no_event_name']);
				if (empty($cat)) $errors .= theme_error_string($lang_event_admin_data['no_cat']);
				if (empty($day) || empty($month) || empty($year) || !checkdate($month,$day,$year)) $errors .= theme_error_string($lang_event_admin_data['non_valid_date']);

				if ($form['duration_type'] == '1') {
					$form['end_days'] = empty($form['end_days'])?'0':$form['end_days'];
					$form['end_hours'] = empty($form['end_hours'])?'0':$form['end_hours'];
					$form['end_minutes'] = empty($form['end_minutes'])?'0':$form['end_minutes'];
					if (!is_numeric($form['end_days'])) { $errors .= theme_error_string($lang_add_event_view['end_days_invalid']); }
					if (!is_numeric($form['end_hours'])) { $errors .= theme_error_string($lang_add_event_view['end_hours_invalid']); }
					if (!is_numeric($form['end_minutes'])) { $errors .= theme_error_string($lang_add_event_view['end_minutes_invalid']); }
				}

				// check recurrence information
				switch((int)$form['recur_type_select']) {
					case 1:
						if (!is_numeric($form['recur_val_1']) || (int)$form['recur_val_1'] < 1) $errors .= theme_error_string($lang_event_admin_data['recur_val_1_invalid']);
						break;
					case 0:
					default:
				}
				switch((int)$form['recur_end_type']) {
					case 0:
						break;
					case 1:
						if (!is_numeric($form['recur_end_count']) || (int)$form['recur_end_count'] < 1) $errors .= theme_error_string($lang_event_admin_data['recur_end_count_invalid']);
						break;
					case 2:
						if (mktime(0,0,0,$month,$day,$year) > mktime(0,0,0,$form['recur_until_month'],$form['recur_until_day'],$form['recur_until_year'])) $errors .= theme_error_string($lang_event_admin_data['recur_end_until_invalid']);
						break;
					default:
						
				}

				$valid_pic = false;
				// may someone upload picture or not ?
				
				/*
				if ($CONFIG_EXT['addevent_allow_picture'])
				{
					if (is_uploaded_file($_FILES['picture']['tmp_name']))
					{
						// check for size of picture
						$size = $_FILES['picture']['size'];
						// check for extension ! 
						$name = $_FILES['picture']['name'];
						$ext = explode(".",$name);
						$ext = array_reverse($ext);
						$ext = $ext[0];
						$valid_pic = false;
						$extensions = explode('/', $CONFIG_EXT['allowed_file_extensions']);
						for ($i=0;$i<count($extensions);$i++)
						{
							if(preg_match("/".$extensions[$i]."$/i",$ext))
							{
								$valid_pic = true;
							}
						}

		        // Get picture information
		        $dimensions  = getimagesize($_FILES['picture']['tmp_name']); 
						$filesize = $CONFIG_EXT['max_upl_size'];

						if ($size > $filesize)
						{
							$errors .= theme_error_string(sprintf($lang_event_admin_data['file_too_large'],$CONFIG_EXT['max_upl_size'] / 1000)); 
	            @unlink($_FILES['picture']['tmp_name']);
						}
						elseif (!$valid_pic)
						{
							$errors .= theme_error_string(sprintf($lang_event_admin_data['non_valid_extension'],str_replace('/',' ',$CONFIG_EXT['allowed_file_extensions']))); 
	            @unlink($_FILES['picture']['tmp_name']);
						}
						elseif (max($dimensions[0], $dimensions[1]) > $CONFIG_EXT['max_upl_dim']) {
			        // Picture dimensions (in pixels) must be is lower than the maximum allowed
							$errors .= theme_error_string(sprintf($lang_event_admin_data['non_valid_dimensions'],$CONFIG_EXT['max_upl_dim'])); 
	            @unlink($_FILES['picture']['tmp_name']);
	          }
					}
					else $picture = '';
				} 
				else $picture = '';
				*/
				
				$picture = 'deprecated%20remove%20it%20sooner%20or%20later';
				
			if(!$errors) {
				$temp_id = '';
				
					if(isset($form['origpicture']) && (isset($form['delpicture']) || $valid) ) {
						@unlink($CONFIG_EXT['UPLOAD_DIR'].$form['origpicture']);
					} else $picture = isset($form['origpicture'])?$form['origpicture']:"";
				
				if($valid_pic)
				{
					$temp_id = substr(md5(time()),0,4);
					$picture = "$temp_id"."_".$_FILES['picture']['name'];
					$picture = str_replace(" ","",$picture);
          // Move uploaded picture from the temporary folder
		    @chmod(substr($CONFIG_EXT['UPLOAD_DIR'],0,-1), 0777);
	        if(@move_uploaded_file($_FILES['picture']['tmp_name'], $CONFIG_EXT['UPLOAD_DIR'].$picture)) {
	        // Change file permission
			        @chmod($CONFIG_EXT['UPLOAD_DIR'].$picture, octdec($CONFIG_EXT['picture_chmod']));
					} else {
					$errors .= theme_error_string($lang_add_event_view['move_image_failed'] . '<br>'.$_FILES['picture']['tmp_name'].'<br>'. $CONFIG_EXT['UPLOAD_DIR'].$picture); 
					}	         
					
				}
			}

				if(!$errors) {

					$url = str_replace("http://","",$url);
					
					if ( has_priv ( "edit" ) )
					{
						$approve = ( isset ( $form['autoapprove'] ) ) ? 1 : 0;
					}

					if($CONFIG_EXT['time_format_24hours']) $start_time_hour = $form['start_time_hour']; // 24 hours mode
					else $start_time_hour = extcal_12to24hour($form['start_time_hour'], $form['start_time_ampm']); // 12 hours mode
					$start_date = date("Y-m-d H:i:s", mktime($start_time_hour, $form['start_time_minute'], 0, $month, $day, $year));

// Here is where we deal with what kind of duration to use. If a duration is specified, we calculate the end_date to enter into the database.
// If not, we enter a special end_date instead.

					if ( $form['duration_type'] == '1' ) { // This is a normal event, with a SPECIFIED duration
						if($form['end_days'] > 0 && !$form['end_hours'] && !$form['end_minutes']) {
							$form['end_days']--; // to make sure not to jump to the next day, we push the time to 23:59:59
							$total_hours = 23;
							$total_minutes = 59;
							$total_seconds = 59;
						} else {
							$total_hours = $start_time_hour + $form['end_hours'];
							$total_minutes = $form['start_time_minute'] + $form['end_minutes'];
							$total_seconds = 0;
						}
						$end_date = date("Y-m-d H:i:s", mktime( $total_hours, $total_minutes, $total_seconds, $month, $day + $form['end_days'], $year));						
					} else if ( $form['duration_type'] == '2' ) { // This is an event where "No end date" was checked instead
						$end_date = '0000-00-00 00:00:01';
					} else { // This is an event where "No end date" was checked instead
						$end_date = '0000-00-00 00:00:00';
					}

					// Set recurrence information
					switch((int)$form['recur_type_select']) {
						case 1:
							$recur_type = $form['recur_type_1'];
							$recur_val = $form['recur_val_1'];
							break;
						case 0:
						default:
							$recur_type = '';
							$recur_val = 0;
							break;
					}
					$recur_end_type = $form['recur_end_type'];
					$recur_count = $form['recur_end_count'];

					// Determine the recur_until value by doing actual calculation if necessary. If the recur type
					// is "recur x number of times" then we calculate the end date.
					if ( $recur_end_type == 0 || $recur_type == '' ) $recur_until = substr($start_date,0,10);
					else if ( $recur_end_type == 2 ) $recur_until = date("Y-m-d", mktime(0, 0, 0, $form['recur_until_month'], $form['recur_until_day'], $form['recur_until_year']));
					else {
						switch ( $recur_type ) {
							case "day":
									$enddatestamp = mktime(0,0,0,$month,$day+($recur_val*$recur_count),$year);
									break;
							case "week":
									$enddatestamp = mktime(0,0,0,$month,$day+($recur_val*$recur_count*7),$year);
									break;
							case "month":
									$enddatestamp = mktime(0,0,0,$month+($recur_val*$recur_count),$day,$year);
									break;
							case "year":
									$enddatestamp = mktime(0,0,0,$month,$day,$year+($recur_val*$recur_count));
									break;
							default:
									break;
						}
						$recur_until = date("Y-m-d", $enddatestamp);
					}

					$query = "
					UPDATE ".$CONFIG_EXT['TABLE_EVENTS']." SET 
						title = '$title',
						description = '$description',
						contact = '$contact',
						url = '$url',
						email = '$email',
						picture = '$picture',
						cat = '$cat',
						day = '$day',
						month = '$month',
						year = '$year',
						approved = '$approve',
						start_date = '$start_date',
						end_date = '$end_date',
						recur_type = '$recur_type',
						recur_val = '$recur_val',
						recur_end_type = '$recur_end_type',
						recur_count = '$recur_count',
						recur_until = '$recur_until',
						published = '1'
					WHERE extid= '{$form['extid']}'";
					extcal_db_query($query);
					
				if (!$approve && !has_priv("Administrator"))
				{
					if ($CONFIG_EXT['new_post_notification'])
					{
						// send email notification
						$duration_array = datestoduration ($start_date,$end_date);
						$days_string = $duration_array['days']?$duration_array['days']." ".$lang_general['day']. " ":'';
						$days_string = $duration_array['days']>1?$duration_array['days']." ".$lang_general['days']. " ":$days_string;
						$hours_string = $duration_array['hours']?$duration_array['hours']." ".$lang_general['hour']. " ":'';
						$hours_string = $duration_array['hours']>1?$duration_array['hours']." ".$lang_general['hours']. " ":$hours_string;
						$minutes_string = $duration_array['minutes']?$duration_array['minutes']." ".$lang_general['minute']:'';
						$minutes_string = $duration_array['minutes']>1?$duration_array['minutes']." ".$lang_general['minutes']:$minutes_string;
					
						// create an instance of the mail class
						$mail = new extcalMailer;
						
						// Now you only need to add the necessary stuff
						$mail->AddAddress($CONFIG_EXT['calendar_admin_email'], " ");
						$mail->Subject = sprintf($lang_system['new_event_subject'], $CONFIG_EXT['app_name']);

				$sef_href = JRoute::_( $CONFIG_EXT['calendar_calling_page'].'&extmode=event&event_mode=view&extid=' . extcal_db_insert_id() );
		        $event_link = $sef_href;
		        $template_vars = array(
							'{CALENDAR_NAME}' => $CONFIG_EXT['app_name'],
							'{TITLE}' => $title,
							'{DATE}' => $start_date,
							'{DURATION}' => $days_string.$hours_string.$minutes_string,
							'{LINK}' => $event_link
						);

						$mail->Body  = strtr($lang_system['event_notification_body'], $template_vars);

						if(!$mail->Send() && $CONFIG_EXT['debug_mode'])
						{
							// An error occurred while trying to send the email
							$sef_href = JRoute::_( $CONFIG_EXT['calendar_calling_page'] );
							theme_redirect_dialog($lang_system['system_caption'], $lang_system['event_notification_failed'], $lang_general['back'], $sef_href);
							pagefooter();
							exit;
						}
					}
				}

					// Successfull message
					$buttonURL = has_priv('Administrator') ? JRoute::_( $CONFIG_EXT['calendar_calling_page'].'&extmode=event&event_mode=view' ) : JRoute::_( $CONFIG_EXT['calendar_calling_page'] );
					if ( $approve ) theme_redirect_dialog($lang_event_admin_data['edit_event'], $lang_event_admin_data['edit_event_success'], $lang_general['continue'], $buttonURL);
					else theme_redirect_dialog($lang_event_admin_data['edit_event'], $lang_add_event_view['submit_event_pending'], $lang_general['continue'], $buttonURL);
					// to remember not to display the form again
					$successful = true;
				} 
			}
						
			// Render the form
      if(!$successful) {
	  			$sef_href = JRoute::_( $CONFIG_EXT['calendar_calling_page'].'&event_mode=edit' );
				display_event_form($sef_href,'event',$form,'edit');
			}

	
}

function approve_event($eventid) {
/* delete the owner who's identified as $ownerid */

	global $CONFIG_EXT, $database, $lang_event_admin_data, $lang_general;
	$qid = extcal_db_query("UPDATE ".$CONFIG_EXT['TABLE_EVENTS']." SET approved = 1 WHERE extid= '$eventid'");
	$sef_href = JRoute::_( $CONFIG_EXT['calendar_calling_page'].'&extmode=event&event_mode=view' );
	if(!extcal_db_affected_rows()) theme_redirect_dialog($lang_event_admin_data['approve_event'], $lang_event_admin_data['approve_event_failed'], $lang_general['back'], $sef_href);
	else theme_redirect_dialog($lang_event_admin_data['approve_event'], $lang_event_admin_data['approve_event_success'],  $lang_general['continue'], $sef_href);

}

function delete_event($eventid) {
/* delete the owner who's identified as $ownerid */

	global $CONFIG_EXT, $database, $lang_event_admin_data, $lang_general;
	$qid = extcal_db_query("DELETE FROM ".$CONFIG_EXT['TABLE_EVENTS']." WHERE extid= '$eventid'");
	$buttonURL = has_priv('Administrator') ? JRoute::_( $CONFIG_EXT['calendar_calling_page'].'&extmode=event&event_mode=view' ) : JRoute::_( $CONFIG_EXT['calendar_calling_page'] );
	if(!extcal_db_affected_rows()) theme_redirect_dialog($lang_event_admin_data['delete_event'], $lang_event_admin_data['delete_event_failed'], $lang_general['back'], $buttonURL);
	else theme_redirect_dialog($lang_event_admin_data['delete_event'], $lang_event_admin_data['delete_event_success'], $lang_general['continue'], $buttonURL);

}

function print_event_list() {

	global $CONFIG_EXT, $database, $my, $zone_stamp, $lang_event_admin_data, $lang_system, $lang_date_format;

	$filter = isset($_GET['eventfilter'])?$_GET['eventfilter']:1;
	$query = "SELECT extid,title,e.description,url,e.picture,approved,cat,cat_name,day,month,year,color,start_date, end_date,recur_type,recur_val,recur_until FROM ".$CONFIG_EXT['TABLE_EVENTS']." AS e LEFT JOIN ".$CONFIG_EXT['TABLE_CATEGORIES']." AS c ON e.cat=c.cat_id ";
	$today = gmdate("Ymd",$zone_stamp);
	switch((int)$filter) {
		case 0:
			$section_title = $lang_event_admin_data['section_title'];
			break;
		case 1:
			$query .= "WHERE approved = 0 ";
			$section_title = $lang_event_admin_data['events_to_approve'];
			break;
		case 2:
			$query .= "WHERE (DATE_FORMAT(e.start_date,'%Y%m%d') >= $today) ";
			$section_title = $lang_event_admin_data['upcoming_events'];
			break;
		case 3:
			$query .= "WHERE (DATE_FORMAT(e.end_date,'%Y%m%d') < $today) ";
			$section_title = $lang_event_admin_data['past_events'];
			break;
		default:
			$section_title = $lang_event_admin_data['section_title'];
			break;
	}
		
	$query .= "ORDER BY year ASC, month ASC, day ASC";
	$result = extcal_db_query($query);
	$rows = extcal_db_num_rows($result);
	
	$num_rows = $rows;

	$count = 0;
	while ($row = extcal_db_fetch_object($result))
	{
		$event_results[$count]['event_id'] = $row->extid;
		$event_results[$count]['event_title'] = format_text($row->title,false,$CONFIG_EXT['capitalize_event_titles']);

		$sef_href = JRoute::_( $CONFIG_EXT['calendar_calling_page']."&extmode=event&event_mode=view&extid=".$row->extid );
		$event_results[$count]['event_link'] = $sef_href;

		$description = format_text($row->description,true,false);

		$event_results[$count]['event_desc'] = $description;
		
		$event_results[$count]['event_status'] = (int)$row->approved;
		$event_results[$count]['event_picture'] = empty($row->picture)?false:true;
		$event_results[$count]['event_recur_type'] = empty($row->recur_type)?false:true;

		$event_results[$count]['cat_id'] = $row->cat;
		$event_results[$count]['cat_name'] = $row->cat_name;
		$event_results[$count]['color'] = $row->color;
		$event_results[$count]['date'] = strftime ($lang_date_format['day_month_year'], mktime(12,0,0,$row->month,$row->day,$row->year));
		$count++;
	}

	theme_admin_events($event_results, $num_rows, $section_title, $filter);

	extcal_db_free_result($result);  

}

function print_event($extid) {

	global $CONFIG_EXT, $database, $lang_event_admin_data, $lang_general, $lang_system;

	
  $query = "SELECT e.*,cat_name, color, c.description AS cat_desc  FROM ".$CONFIG_EXT['TABLE_EVENTS']." AS e ";
  $query .= "LEFT JOIN ".$CONFIG_EXT['TABLE_CATEGORIES']." AS c ON e.cat=c.cat_id WHERE extid='$extid'";
  $results = extcal_db_query($query);
	$rows = extcal_db_num_rows($results);

  if (!$rows) { 
		$sef_href = JRoute::_( $CONFIG_EXT['calendar_calling_page'] );
		theme_redirect_dialog($lang_system['system_caption'], $lang_system['non_exist_event'], $lang_general['back'], $sef_href);
  } else 
  {
    $row = extcal_db_fetch_array($results);
		// additional field processing
		$row['title'] = format_text($row['title'],false,$CONFIG_EXT['capitalize_event_titles']);
		$row['description'] = process_content(format_text($row['description'],true,false));
		$row['link'] = eregi("/^(http[s]?:\/\/)",$row['url'])?$row['url']:"http://".$row['url'];

		theme_admin_view_event($row);
 	}
	extcal_db_free_result($results);  

}
?>
