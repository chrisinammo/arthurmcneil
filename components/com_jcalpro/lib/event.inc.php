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

$File: events.inc.php - Global event code$

Revision date: 03/03/2007

**********************************************
Get the latest version of JCal Pro at:
http://dev.anything-digital.com//
**********************************************
*/

/** ensure this file is being included by a parent file */
defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );

class ExtCal_Event {
    // Set default variables for all new objects

		// Info related variables
    var $title = "";
    var $description = "";
    var $contact = "";
    var $url = "";
    var $link = "";
    var $email = "";
    var $picture = "";
    var $color = "#000000"; // black color by default
    var $catName = "";
    var $catDesc = "";
		
		// Date related variables
    var $startDate = NULL;
    var $endDate = NULL;

	var $startDay = 0;
	var $startMonth = 0;
	var $startYear = 0;

	var $endDay = 0;
	var $endMonth = 0;
	var $endYear = 0;

    var $recurStartDate = NULL; // virtual start and end dates used for recurrent events
    var $recurEndDate = NULL;

	// Other info variables
	var $extid = 0;
	var $catId = 0;
    var $status   = false;  // true means approved or active event                
    var $recType = NULL; // Recurrence type: daily, weekly, monthly, yearly or (null for non recurrent events)
	var $recInterval = 0; // Period of recurrence
	var $recEndDate = 0; // recurrence limit
    var $recEndType = 0; // recurrence end type: 0. repeat indefinitely, 1. repeat a number of occurrences, 2. repeat until date ($recEndDate)
    var $recEndCount = NULL; // number of occurrences for a recurrent event. Used in conjunction with $recEndType = 1
	
		function Event() {
      // defining the constructor
	    //global $CONFIG_EXT;
	    
	    //if($eventId) $this->getEvent($eventId);
		}
		
		function isActive() {
			return $this->$this->status;
		}

		function loadEvent($eventId,$date_stamp=false) {
	    // function that retrieves and set event info
	    global $CONFIG_EXT, $CFG, $params, $mainframe;
        $database = &JFactory::getDBO();
        
	    $query = "SELECT e.*,cat_name, color, c.description AS cat_desc  FROM ".$CONFIG_EXT['TABLE_EVENTS']." AS e ";
	    $query .= "LEFT JOIN ".$CONFIG_EXT['TABLE_CATEGORIES']." AS c ON e.cat=c.cat_id WHERE extid='".$eventId."'";
	    $results = extcal_db_query($query);
						
			$rows = extcal_db_num_rows($results);
			
	    if (!$rows) { 
	    	return false;
	    } else 
	    {
		    $row = extcal_db_fetch_array($results);
				// additional field processing


				// Store info related variables
		    $this->title = $row['title'];
		    $this->description = $row['description'];
		    $this->contact = $row['contact'];
		    if($row['url']) $this->url = eregi("/^(http[s]?:\/\/)",$row['url'])?$row['url']:"http://".$row['url'];
		    else $this->url = "";
		    $this->link = $this->url;
            
            /*$pluginhandler =& mosMambotHandler::getInstance();
            $pluginhandler->loadBotGroup('content');
            $pluginhandler->trigger('onPrepareContent', array( 1, &$temp, &$params, 0));*/

				//$_MAMBOTS->loadBotGroup( 'content' );
                //$pluginhandler =& mosMambotHandler::getInstance();
                //$pluginhandler->loadBotGroup('content');
                JPluginHelper::importPlugin('content');
                
				$temp = new stdClass(); 
				$temp->text = $row['email'];
                //$result = $_MAMBOTS->trigger( 'onPrepareContent' , array( 1, &$temp, &$params, 0));
                //$result = $pluginhandler->trigger('onPrepareContent', array( 1, &$temp, &$params, 0));
                $result = $mainframe->triggerEvent('onPrepareContent', array( 1, &$temp, &$params, 0));
				

		    $this->email = $temp->text;
		    
		    $this->picture = $row['picture'];
    		$this->color = $row['color'];
    		$this->catName = $row['cat_name'];
    		$this->catDesc = $row['cat_desc'];
				
			// Store date related variables
			$this->start_date = $row['start_date'];
			$this->end_date = $row['end_date'];
			$this->recur_type = $row['recur_type'];
			$this->recur_val = $row['recur_val'];
			$this->recur_end_type = $row['recur_end_type'];
			$this->recur_count = $row['recur_count'];
			$this->recur_until = $row['recur_until'];

			$this->startDate = strtotime($row['start_date']);
			if($row['start_date'] > $row['end_date']) {
				$this->endDate = $this->startDate;
			} else {
				$this->endDate = strtotime($row['end_date']);
			}

			$this->startDay = (int)date("d", $this->startDate);
			$this->startMonth = (int)date("m", $this->startDate);
			$this->startYear = (int)date("Y", $this->startDate);
			$this->startHour = (int)date("H", $this->startDate);
			$this->startMinute = (int)date("i", $this->startDate);

			$this->endDay = (int)date("d", $this->endDate);
			$this->endMonth = (int)date("m", $this->endDate);
			$this->endYear = (int)date("Y", $this->endDate);
			$this->endHour = (int)date("H", $this->endDate);
			$this->endMinute = (int)date("i", $this->endDate);

			// Store other info variables
			$this->extid = $eventId;
			$this->catId = (int)$row['cat'];
			$this->status = $row['approved']?true:false;
			$this->published = $row['published']?true:false;
			$this->recType = $row['recur_type'];
			$this->recInterval = (int)$row['recur_val'];
			$this->recEndDate = strtotime($row['recur_until']);
			//$this->recWeekDays = $row['rec_weekdays'];
			$this->recEndType = (int)$row['recur_end_type'];
			$this->recEndCount = (int)$row['recur_count'];

			if ($date_stamp && $this->isRecurrentOn($date_stamp)) {
					$this->startDate = $this->recurStartDate;
					$this->endDate = $this->recurEndDate;
			}
		}
		extcal_db_free_result($results);  
		return true;
		}	

		function getDuration() {
		//function datestoduration ($periods = null) {
			$periods = null;
			$seconds = $this->endDate - $this->startDate;

		  // Force the seconds to be numeric        
		  $seconds = (int)$seconds;                
		  // Define our periods        
		  if (!is_array($periods)) {            
		  	$periods = array (                    
		  	//'years'     => 31556926,                    
		  	//'months'    => 2629743,                    
		  	//'weeks'     => 604800,                    
		  	'days'      => 86400,                    
		  	'hours'     => 3600,                    
		  	'minutes'   => 60,                    
		  	//'seconds'   => 1                    
		  	);        
		  }        

		  // Loop through        
		  foreach ($periods as $period => $value) {            
		  	$count = floor($seconds / $value);            
		  	$values[$period] = $count;            
		  	if ($count == 0) {                
		  		continue;            
		  	}            
		  	$seconds = $seconds % $value;        
		  }        
		  // Return array        
		  if (empty($values)) {            
		  	$values = null;        
		  }
		  
		// fix the all day value
			if(date("G:i",$this->endDate) == "23:59") { 
				$values['days']++;
				$values['hours'] = 0;
				$values['minutes'] = 0;
			} 
			
		  return $values;    
		}
		
		function isRecurrent() {
			return empty($this->recType)?false:true;
		}
		
		function setStartDate($start_date) {
			
			$this->startDate = $start_date;
			$this->startDay = (int)date("d", $this->startDate);
			$this->startMonth = (int)date("m", $this->startDate);
			$this->startYear = (int)date("Y", $this->startDate);
		}

		function setEndDate($end_date) {
			$this->endDate = $end_date;
			$this->endDay = (int)date("d", $this->endDate);
			$this->endMonth = (int)date("m", $this->endDate);
			$this->endYear = (int)date("Y", $this->endDate);
		}

		function isRecurrentOn($target_stamp) {
			global $CONFIG_EXT;
			if(!$this->isRecurrent()) return false;
			$day = $this->startDay;
			$month = $this->startMonth;
			$year = $this->startYear;
			$hour = (int)date("G", $this->startDate);
			$minute = (int)date("i", $this->startDate);
			$current_stamp = mktime(0,0,0,$month,$day,$year); // reproduce the start date without time info
			$duration = mktime(0,0,0,$this->endMonth,$this->endDay,$this->endYear) - mktime(0,0,0,$this->startMonth,$this->startDay,$this->startYear);
			$exact_duration = $this->endDate - $this->startDate;
			
			// Now we find the number of DAYS the duration is. This can change depending on start time, you see, because an event that lasts 3 hours
			// but starts at 11 pm has a duration of 2, if you're just counting in days.
			$difference_in_days = mktime(0,0,0,($this->endMonth - $this->startMonth) + 1,($this->endDay - $this->startDay) + 1,($this->endYear - $this->startYear) + 1980);
			$duration_in_days = ( $difference_in_days - mktime(0,0,0,1,1,1980) ) / 86400;

			if($this->recEndType == 2 && ($this->recEndDate + $duration < $target_stamp)) return false;

			// $this->$recur_nextStartStamp is false by default. But if isRecurrentOn() has run before
			// on this event and has calculated that overlapping recurrences exist, the property will
			// hold the timestamp of what it has calculated to be the start DAY (no time values) of the
			// next recurrence.
			//if ($this->$recur_nextStartStamp) $target_stamp = $recur_nextStartStamp;
			
			if ( isset ( $recur_nextStartStamp ) )
			{
				if ($recur_nextStartStamp) $target_stamp = $recur_nextStartStamp;
			}
			
			$target_day = (int)date("d", $target_stamp);
			$target_month = (int)date("m", $target_stamp);
			$target_year = (int)date("Y", $target_stamp);
			$target_stamp = mktime(0,0,0,$target_month,$target_day,$target_year); // reformat the target date without time info
			$recur_count = 1;
			
			// At this point, The target stamp is the day we're checking whether the event falls on.
			// The current stamp is the original start date of the event.
			
			$this->recurrencesOnThisDate = array();  // We're gonna store all recurrences of this event on this day.

			$first_time_through = true;

			while( $this->recInterval && ( ($this->recEndType != 1 && $current_stamp <= $target_stamp) || ($this->recEndType == 1 && $recur_count <= $this->recEndCount && $current_stamp <= $target_stamp) ) ) {
			  // Then the current stamp is updated as the date is incremented by the recur interval until it comes up to the target date.
			    $incrementBy = ( $first_time_through ) ? 0 : $this->recInterval;
				switch($this->recType) {
					case "day":
							$current_stamp = mktime(0,0,0,$month,$day+$incrementBy,$year);
							$exact_current_stamp = mktime($hour,$minute,0,$month,$day+=$incrementBy,$year);
							break;
					case "week":
							$current_stamp = mktime(0,0,0,$month,$day+($incrementBy*7),$year);
							$exact_current_stamp = mktime($hour,$minute,0,$month,$day+=($incrementBy*7),$year);
							break;
					case "month":
							$current_stamp = mktime(0,0,0,$month+$incrementBy,$day,$year);
							$exact_current_stamp = mktime($hour,$minute,0,$month+=$incrementBy,$day,$year);
							break;
					case "year":
							$current_stamp = mktime(0,0,0,$month,$day,$year+$incrementBy);
							$exact_current_stamp = mktime($hour,$minute,0,$month,$day,$year+=$incrementBy);
							break;
					default:
				}
				$first_time_through = false;
/* 
 				if ( ($this->recType == 'day') && ($this->recInterval == '1') ) {
					$current_stamp = mktime(0,0,0,$month,$day+$this->recInterval,$year);
					$exact_current_stamp = mktime($hour,$minute,0,$month,$day+=$this->recInterval,$year);
				}
 */ 
				$condition_all = $current_stamp <= $target_stamp && ($current_stamp + $duration) >= $target_stamp;
				$condition_bounds = ($current_stamp == $target_stamp || ($current_stamp + $duration) == $target_stamp);
				$condition_start = $current_stamp == $target_stamp;
				
				if((($condition_all && $CONFIG_EXT['multi_day_events']=="all") || ($condition_bounds && $CONFIG_EXT['multi_day_events']=="bounds") || ($condition_start && $CONFIG_EXT['multi_day_events']=="start")) && ($this->recEndType != 2 || $this->recEndDate >= $current_stamp)) {
					$this->recurrencesOnThisDate[] = array(
						'recurrence_start_day' => $current_stamp, // Timestamp with just the date
						'exact_recurrence_start' => $exact_current_stamp, // Exact timestamp of start, date AND time
						'recurrence_end_day' => $current_stamp + $duration, // Timestamp with just the date
						'exact_recurrence_end' => $exact_current_stamp + $exact_duration  // Exact timestamp of end, date AND time
						 );
				}
				if(count($this->recurrencesOnThisDate)) {
					$finalRecurrence = $this->recurrencesOnThisDate[count($this->recurrencesOnThisDate)-1];
					$this->recurStartDay = $finalRecurrence['recurrence_start_day']; // Timestamp with just the date
					$this->recurStartDate = $finalRecurrence['exact_recurrence_start']; // Exact timestamp of start, date AND time
					$this->recurEndDay = $finalRecurrence['recurrence_end_day']; // Timestamp with just the date
					$this->recurEndDate = $finalRecurrence['exact_recurrence_end'];  // Exact timestamp of end, date AND time
				}
				if ( $CONFIG_EXT['show_recurrent_events'] == 2 ) break; // If the setting is to show First Only of recurring events, we break the loop so only the first occurrence is added.
				$recur_count++;
			}
			
			return (count($this->recurrencesOnThisDate)) ? true : false;
			
		}

		function get_icon($day_stamp,$start_stamp,$end_stamp) {

			$startbound = date('Ymd',$day_stamp) - date('Ymd',$start_stamp); // 0 means event starts same day
			$endbound = date('Ymd',$end_stamp) - date('Ymd',$day_stamp); // 0 means event ends same day
			//echo "STR:".date('Ymd',$start_stamp) . " STO:".date('Ymd',$end_stamp). " DAY:".date('Ymd',$day_stamp)."<br>";

			$image = "icon-event-onedate.gif"; // default event icon
			if(!$startbound && !$endbound) $image = "icon-event-onedate.gif";
			elseif(!$startbound && $endbound>0) $image = "icon-event-startdate.gif";
			elseif($startbound>0 && !$endbound) $image = "icon-event-enddate.gif";
			elseif($startbound>0 && $endbound>0) $image = "icon-event-middate.gif";
			//else return false;

			return $image;

		}

		function get_style($day_stamp,$start_stamp,$end_stamp) {

			$startbound = date('Ymd',$day_stamp) - date('Ymd',$start_stamp); // 0 means event starts same day
			$endbound = date('Ymd',$end_stamp) - date('Ymd',$day_stamp); // 0 means event ends same day

			$class = "eventfull"; // default event class
			if(!$startbound && !$endbound) $class = "eventfull";
			elseif(!$startbound && $endbound>0) $class = "eventstart";
			elseif($startbound>0 && !$endbound) $class = "eventend";
			elseif($startbound>0 && $endbound>0) $class = "eventmiddle";
			//else return false;
			
			return $class;
		
		}

}

?>