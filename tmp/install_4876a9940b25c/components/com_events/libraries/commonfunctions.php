<?php
/**
 * Events Component for Joomla 1.0.x
 *
 * @version     $Id: commonfunctions.php 1102 2008-05-22 06:11:59Z tstahl $
 * @package     Events
 * @copyright   Copyright (C) 2006-2007 JEvents Project Group
 * @licence     http://www.gnu.org/copyleft/gpl.html
 * @link        http://joomlacode.org/gf/project/jevents
 */

// no direct access
defined( '_VALID_MOS' ) or die( 'Restricted access' );

// functions common to component and modules

function setColor($row){

	static $catData;

	$cfg = & EventsConfig::getInstance();

	if (!isset($catData))   $catData = getCategoryData();
	
	if( $cfg->get('com_calForceCatColorEventForm') == '2' ){
		$color = ($row->catid > 0 ) ? $catData[$row->catid]->color : '#333333';
	}
	else $color = $row->useCatColor ? ( $row->catid > 0 ) ? $catData[$row->catid]->color : '#333333' : $row->color_bar;

	//$color = $row->useCatColor ? ( $row->catid > 0 ) ? $catData[$row->catid]->color : '#333333' : $row->color_bar;
	return $color;
}

function accessibleCategoryList($gid=null, $catids=null, $catidList=null) {

    global $database;
    if (is_null($gid))       global $gid;
    if (is_null($catids))    global $catids;
    if (is_null($catidList)) global $catidList;

	static $instances;

	if (!$instances) {
		$instances = array();
	}

	// calculate unique index identifier
	$index = $gid . '+' . $catidList;
	$where = null;

	if (!array_key_exists($index,$instances)) {
		if (count($catids)>0) {
			$where = ' AND b.id IN (' . $catidList .')';
		}

		$query = "SELECT id"
		. "\n FROM #__categories AS b"
		. "\n WHERE b.access <= $gid"
		. "\n AND b.section = 'com_events'"
		. "\n AND b.published = 1" . $where;
		;
		$database->setQuery($query);
		$catlist =  $database->loadResultArray();

		$instances[$index] = implode(',', array_merge(array(-1), $catlist));
	}
	return $instances[$index];
}

function mosEventRepeatArrayMonth( $row=null, $year=null, $month=null) {
	// builds and returns array

	if( is_null( $row ) || is_null($year) || is_null( $month)) {
		$eventDays = array();
		return $eventDays;
	}

	$monthStartDate = mktime( 0,0,0, $month, 1, $year );
	$daysInMonth = intval(date("t",$monthStartDate ));
	$monthEndDate = mktime( 0,0,0, $month, $daysInMonth , $year );
	$monthEndSecond = mktime( 23,59,59, $month, $daysInMonth , $year );

	return mosEventRepeatArrayPeriod($row, $monthStartDate, $monthEndDate, $monthEndSecond );
}

function mosEventRepeatArrayDay( $row=null, $year=null, $month=null, $day=null) {
	// builds and returns array
	if( is_null( $row ) || is_null($year) || is_null( $month)|| is_null( $day)) {
		$eventDays = array();
		return $eventDays;
	}

	$dayStartDate = mktime( 0,0,0, $month, $day, $year );
	$dayEndDate = mktime( 0,0,0, $month, $day , $year );
	$dayEndSecond = mktime( 23,59,59, $month, $day , $year );

	// This routine will find all the event dates for the month - could make more efficient later?
	return mosEventRepeatArrayPeriod($row, $dayStartDate, $dayEndDate, $dayEndSecond );
}

function mosEventRepeatArrayWeek( $row=null, $weekStart=null, $weekEnd=null) {
	// builds and returns array
	if( is_null( $row ) || is_null($weekStart) || is_null( $weekEnd)) {
		$eventDays = array();
		return $eventDays;
	}

	list($dayStart, $monthStart, $yearStart) = explode(":",(date("d:m:Y",$weekStart)));
	list($dayEnd, $monthEnd, $yearEnd) = explode(":",(date("d:m:Y",$weekEnd)));
	
	if ($monthStart == $monthEnd) {
		$weekEndSecond = mktime( 23,59,59, $monthEnd, $dayEnd, $yearEnd );
		return mosEventRepeatArrayPeriod($row, $weekStart, $weekEnd, $weekEndSecond );
	}
	else {
		
		// do end of first month to start
		$daysInMonth = intval(date("t",$weekStart ));
		$monthEndDate = mktime( 0,0,0, $monthStart, $daysInMonth , $yearStart);
		$monthEndSecond = mktime( 23,59,59, $monthStart, $daysInMonth , $yearStart );
		$part1 = mosEventRepeatArrayPeriod($row, $weekStart, $monthEndDate, $monthEndSecond );
		
		// then do start of second month
		$part2Start = mktime( 0,0,0, $monthEnd, 1, $yearEnd );
		$weekEndSecond = mktime( 23,59,59, $monthEnd, $dayEnd, $yearEnd );
		$part2 = mosEventRepeatArrayPeriod($row, $part2Start, $weekEnd, $weekEndSecond );
	
/*		
		// This is overkill but the mosEventRepeatArrayPeriod function works most simply
		// if it works with whole months.
		
		// do end of first month to start
		$daysInMonth = intval(date("t",$weekStart ));
		$tempStart = mktime( 0,0,0, $monthStart, 1 , $yearStart);
		$monthEndDate = mktime( 0,0,0, $monthStart, $daysInMonth , $yearStart);
		$monthEndSecond = mktime( 23,59,59, $monthStart, $daysInMonth , $yearStart );
		$part1 = mosEventRepeatArrayPeriod($row, $tempStart, $monthEndDate, $monthEndSecond );
		
		// then do start of second month
		$part2Start = mktime( 0,0,0, $monthEnd, 1, $yearEnd );
		$daysInMonth2 = intval(date("t",$weekEnd ));
		$part2End = mktime( 0,0,0, $monthEnd, $daysInMonth2, $yearEnd );
		$part2EndSecond = mktime( 23,59,59, $monthEnd, $daysInMonth2, $yearEnd );
		$part2 = mosEventRepeatArrayPeriod($row, $part2Start, $part2End, $part2EndSecond);
*/		
		foreach ($part2 as $key=>$val){
			$part1[$key]=$val;
		}
		return $part1;
	}

}

function mosEventRepeatArrayFlex( $row=null, $flexStart=null, $flexEnd=null) {
	// builds and returns array
	if( is_null( $row ) || is_null($flexStart) || is_null( $flexEnd)) {
		$eventDays = array();
		return $eventDays;
	}

	list($dayStart, $monthStart, $yearStart) = explode(":",(date("d:m:Y",$flexStart)));
	list($dayEnd, $monthEnd, $yearEnd) = explode(":",(date("d:m:Y",$flexEnd)));
	
	if ($monthStart == $monthEnd && $yearStart==$yearEnd) {
		$flexEndSecond = mktime( 23,59,59, $monthEnd, $dayEnd, $yearEnd );
		return mosEventRepeatArrayPeriod($row, $flexStart, $flexEnd, $flexEndSecond );
	}
	else {
		$eventDays = array();
		for($y=$yearStart;$y<=$yearEnd;$y++){
			$startMonth = 1;
			if ($y==$yearStart) $startMonth = $monthStart;
			$endMonth = 12;
			if ($y==$yearEnd) $endMonth = $monthEnd;
			for ($m=$startMonth;$m<=$endMonth;$m++){
				$dateStart = mktime(0,0,0,$m,1,$y);
				$daysInMonth = intval(date("t",$dateStart ));
				$dateEnd = mktime(0,0,0,$m,$daysInMonth,$y);
				$dateEndSecond = mktime(23,59,59,$m,$daysInMonth,$y);
				$part = mosEventRepeatArrayPeriod($row, $dateStart, $dateEnd, $dateEndSecond);

				foreach ($part as $key=>$val){
					$eventDays[$key]=$val;
				}
			}			
		}
		return $eventDays;
	}

}

function mosEventRepeatArrayPeriod( $row=null, $startPeriod, $endPeriod, $periodEndSecond) {
	// NEED TO CHECK MONTH and week overlapping month end
	
	// builds and returns array
	$eventDays = array();

	// double check the SQL has given us valid events
	$event_start_date = mktime( 0,0,0,  $row->mup, $row->dup, $row->yup );
	$event_end_date = mktime( 0,0,0,  $row->mdn, $row->ddn, $row->ydn );
	if ($event_end_date<$startPeriod || $event_start_date>$periodEndSecond) return  $eventDays;

	$daysInMonth = intval(date("t",$startPeriod ));
	list($periodStartDay, $month, $year) = explode(":",date("d:m:Y",$startPeriod));

	$repeatingEvent = false;
	if ($row->reccurtype!=0 || $row->reccurday!="" || $row->reccurweekdays!="" || $row->reccurweeks!=""){
		$repeatingEvent = true;
	}

	// treat midnight as a special case
	$endsMidnight = false;
	if ($row->hdn==0 && $row->mindn==0 && $row->sdn==0 ){
		$endsMidnight = true;
	}

	$multiDayEvent = false;	
	if ($row->dup!=$row->ddn || $row->mup!=$row->mdn || $row->yup!=$row->ydn  ) {	// should test month too?
		$multiDayEvent = true;
	}


	if (!$repeatingEvent) {
		if (!$multiDayEvent) {
			// single day so populate the array and get on with things!
			$eventDays[$event_start_date]=true;
			return $eventDays;
		}
		else {
			// otherwise a multiday event

			// Find the first and last relevant days
			if ($startPeriod>$event_start_date) $firstDay = 1;
			else $firstDay = intval(date("j",$event_start_date));

			if ($event_end_date>$endPeriod) $lastDay = $daysInMonth;
			else $lastDay = intval(date("j",$event_end_date));

			for ($d=$firstDay;$d<=$lastDay;$d++) {
				$eventDate = mktime( 0,0,0, $month , $d, $year);
				// treat midnight as a special case - we don't mark following day as having the event
				if ($d==$lastDay && $endsMidnight) continue;
				$eventDays[$eventDate]=true;
			}
			return $eventDays;
		}
	}

	// All I'm left with are the repeated events

	//echo "row->reccurtype = $row->reccurtype $row->id<br/><br/>CHECK IT OUT - type 2 needs more work!!!<br/><hr/>";

	switch( $row->reccurtype) {
		case 0: // All days
		$this->viewable = true;
		return $this->viewable;
		break;

		case 1: // By week - 1* by week
		case 2: // By week - n* by week

		// This is multi-days per week
		if ($row->reccurweekdays != ""){
			$reccurweekdays	= explode( '|', $row->reccurweekdays );
			$countdays		= count( $reccurweekdays );
		}
		// This is once a week
		else if ($row->reccurday!="") {
			$reccurweekdays   = array();
			$tmp_weekday      = intval($row->reccurday);
			if ($tmp_weekday == -1) {
				$tmp_weekday = intval(date( 'w', $event_start_date));
			}
			$reccurweekdays[] = $tmp_weekday;
			$countdays		  = count( $reccurweekdays );
		}
		else {
			echo "Should not really be here <br/>";
		}

		if (strpos($row->reccurweeks,"pair")===false) {
			$repeatweeks	= explode( '|', $row->reccurweeks );
		}
		else $repeatweeks = array();

		for ($i=0;$i<$countdays;$i++){
			// This is first, second week etc of the months
			if (count($repeatweeks)>0){
				$daynum_of_first_in_month = intval(date( 'w', mktime( 0, 0, 0, $month, 1, $year )));
				$adjustment = 1 + (7+$reccurweekdays[$i]-$daynum_of_first_in_month)%7;
				// Now find repeat weeks for the month
				foreach ($repeatweeks as $weeknum) {
					// first $reccurweekdays[$i] in the month is therefore
					$next_recurweekday = ($adjustment + ($weeknum-1)*7);
					$nextDate = mktime( 0, 0, 0, $month, $next_recurweekday, $year );
					if ($nextDate<=$endPeriod) {
						if ($nextDate>=$event_start_date && $nextDate<=$event_end_date)	$eventDays[$nextDate]=true;
					}
				}
			}
			else {
				// find corrected start date
				$weekday_of_startdate = date( 'w', $event_start_date);
				if ($reccurweekdays[$i]>=0){
					$true_start_day_of_week_for_sequence = $reccurweekdays[$i];
				}
				else $true_start_day_of_week_for_sequence = $weekday_of_startdate;

				list($event_start_day, $event_start_month, $event_start_year) = explode(":",date("d:m:Y",$event_start_date));

				$adjustedStartDay = $event_start_day + (7+$true_start_day_of_week_for_sequence - $weekday_of_startdate)%7;

				$sequence_start_date = mktime( 0, 0, 0, $event_start_month, $adjustedStartDay, $event_start_year);
				//echo "event start data : ".date("d:m:Y",$event_start_date)."<br/>";
				//echo "adj sequence_start_date: ".date("d:m:Y",$sequence_start_date)."<br/>";
				//echo "month start data : ".date("d:m:Y",$startPeriod)."<br/>";
				if ($row->reccurweeks=="pair"){
					// every 2 weeks
					// first of month day difference
					// 60*60*24 = 86400
					// 86400*14 = 1209600
					$delta = (1209600+$sequence_start_date-$startPeriod )%1209600;
					$deltadays = round($delta/86400,0);

					for ($weeks=0;$weeks<6;$weeks++){
						$nextDate = mktime(0,0,0,$month, $periodStartDay + $deltadays+ (14*$weeks), $year);
						if ($nextDate<=$endPeriod) {
							if ($nextDate>=$event_start_date && $nextDate<=$event_end_date) $eventDays[$nextDate]=true;
						}
						else break;
					}

				}
				else if ($row->reccurweeks=="impair"){
					// every 3 weeks
					// every 2 weeks
					// first of month day difference
					// 60*60*24 = 86400
					// 86400*21 = 1814400
					$delta = (1814400+$sequence_start_date-$startPeriod )%1814400;
					$deltadays = round($delta/86400,0);

					for ($weeks=0;$weeks<6;$weeks++){
						$nextDate = mktime(0,0,0,$month, $periodStartDay + $deltadays+ (21*$weeks), $year);
						if ($nextDate<=$endPeriod) {
							if ($nextDate>=$event_start_date && $nextDate<=$event_end_date) $eventDays[$nextDate]=true;
						}
						else break;
					}

				}
			}

		}
		return $eventDays;

		break;

		case 3: // By month - 1* by month
		if( $row->reccurday ==-1 ) { //by day number

			list($event_start_day, $event_start_month, $event_start_year) = explode(":",date("d:m:Y",$event_start_date));
			$nextDate = mktime(0,0,0,$month, $event_start_day, $year);
			$eventDays[$nextDate]=true;
		}
		else { //by day name following the day number

			list($event_start_day, $event_start_month, $event_start_year) = explode(":",date("d:m:Y",$event_start_date));
			$equiv_day_of_month = mktime( 0, 0, 0, $month, $event_start_day, $year);
			$weekday_of_equivalent = date( 'w', $equiv_day_of_month);
			$temp = $event_start_day + (7+$row->reccurday - $weekday_of_equivalent)%7;
			
			$nextDate = mktime( 0, 0, 0, $month, $temp, $year);

			if ($nextDate >= $event_start_date && $nextDate<=$event_end_date) $eventDays[$nextDate]=true;
		}
		return $eventDays;
		break;

		case 4: // By month - end of the month
		// get month end 
		list($lastday, $month, $year) = explode(":",date("t:m:Y",$endPeriod));
		$nextDate = mktime(0,0,0,$month,$lastday,$year);
		if ($nextDate >= $event_start_date && $nextDate<=$event_end_date) $eventDays[$nextDate]=true;
		return $eventDays;

		break;

		case 5: // By year - 1* by year
		list($event_start_day, $event_start_month, $event_start_year) = explode(":",date("d:m:Y",$event_start_date));
		if ($month == $event_start_month){
			if( $row->reccurday ==-1 ) { //by day number

				$nextDate = mktime(0,0,0,$month, $event_start_day, $year);
				if ($nextDate >= $event_start_date && $nextDate<=$event_end_date) $eventDays[$nextDate]=true;
			}
			else { //by day name following the day number

				list($event_start_day, $event_start_month, $event_start_year) = explode(":",date("d:m:Y",$event_start_date));
				$equiv_day_of_month = mktime( 0, 0, 0, $month, $event_start_day, $year);
				$weekday_of_equivalent = date( 'w', $equiv_day_of_month);
				$temp = $event_start_day + (7+$row->reccurday - $weekday_of_equivalent)%7;

				$nextDate = mktime( 0, 0, 0, $month, $temp, $year);
				if ($nextDate >= $event_start_date && $nextDate<=$event_end_date) $eventDays[$nextDate]=true;
			}
		}
		return $eventDays;
		break;

		default:
			return $eventDays;
			break;
	}

}

/**
	* Redirect to url used for Joomla 1.5 compatibility
	*
	* @param	$url		Redirection url
	* @param	$message	message to be displayed
	*/
function jevRedirect($url, $message='') {

	mosRedirect( str_replace('&amp;', '&', $url), $message);
	
}

/**
 * Create time stamp from now (local or UTC)
 *
 * @param boolean $local	true=local time; false=UTC time
 * @return int unix date
 */
function jevNow($local=false) {

	static $_nowUTC		= null;
	static $_nowLocal	= null;

	if (!$_nowUTC) {
		global $mosConfig_offset;
		$_nowUTC = strtotime(gmdate("M d Y H:i:s", time()));
		$_nowLocal	= $_nowUTC + ($mosConfig_offset * 3600);
	}
	$date = ($local) ? $_nowLocal : $_nowUTC;
	return $date;
}
