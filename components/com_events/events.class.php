<?php
/**
 * Events Component for Joomla 1.5.x
 *
 * @version     $Id: events.class.php 961 2008-02-16 10:57:30Z geraint $
 * @package     Events
 * @copyright   Copyright (C) 2006-2007 JEvents Project Group
 * @copyright   Copyright (C) 2000 - 2003 Eric Lamette, Dave McDonnell
 * @licence     http://www.gnu.org/copyleft/gpl.html
 * @link        http://joomlacode.org/gf/project/jevents
 */

// Thanks to Andrew Eddie for his mosEventDate Class

defined( '_JEXEC' ) or die( 'Restricted access' );

class jeventsCache  {

	/**
	* @return object A function cache object
	*/
	function &getCache(  $group='com_events'  ) {

		$cache =& JFactory::getCache($group);
		return $cache;
	}
}

class mosEvents extends JTable {
	var $id 				= null;
	var $sid 				= null;
	var $catid 				= null;
	var $title 				= null;
	var $content 			= null;
	var $contact_info 		= null;
	var $adresse_info 		= null;
	var $extra_info 		= null;
	var $color_bar 			= null;
	var $useCatColor 		= null;
	var $state 				= null;
	var $mask 				= null;
	var $created 			= null;
	var $created_by 		= null;
	var $created_by_alias 	= null;
	var $modified 			= null;
	var $modified_by 		= null;
	var $checked_out 		= null;
	var $checked_out_time 	= null;
	var $publish_up 		= null;
	var $publish_down 		= null;
	var $images 			= null;
	var $reccurtype 		= null;
	var $reccurday 			= null;
	var $reccurweekdays 	= null;
	var $reccurweeks 		= null;
	var $approved 			= null;
	var $ordering 			= null;
	var $archived 			= null;
	var $access 			= null;
	var $hits 				= null;

	function mosEvents( &$db ) {
		parent::__construct( '#__events', 'id', $db );
	}

	// security check
	function bind( $array ) {
		$array['id'] = isset($array['id']) ? intval($array['id']) : 0;
		$res = parent::bind($array);
		// bind can mess up slashes so overwrite description here!
		//$this->content=JRequest::getVar('content', '', 'post', 'string', JREQUEST_ALLOWRAW);
		// don't overwrite here, it breaks reading Events [tstahl, Feb 2008]
		return $res;
	}

	function check() {
		// check for valid name
		if (trim( $this->title ) == '') {
			$this->_error = "Your Events must contain a title.";
			return false;
		}
		return true;
	}

	function hit( $oid=null ) {
		$k = $this->_tbl_key;
		if ($oid !== null) {
			$this->$k = intval( $oid );
		}
		$this->_db->setQuery( "UPDATE #__events SET hits=(hits+1) WHERE id=$this->id" );
		$this->_db->query();
	}
}

class jEventCal {
	var $data;
	var $_unixstartdate = null;
	var $_unixenddate = null;
	var $_location = "";
	var $_contact = "";
	var $_extra_info = "";

	// default values
	var $_catid=0;

	function jEventCal($inRow) {
		//$this->data = $inRow;
		$array= get_object_vars($inRow);
		foreach ($array as $key=>$val) {
			$key = "_".$key;
			$this->$key = $val;
		}
		if (!isset($this->_alldayevent)) {
			$this->_alldayevent = 0;
		}
	}

	/**
	 * Is this type of event editable?
	 *
	 * @return boolean
	 */
	function isEditable(){
		return true;
	}

	function editTask(){
		return "edit";
	}

	function deleteTask(){
		return "delete";
	}

	function startDate(){
		if (!isset($this->_startdate)){
			$this->_startdate=strftime("%Y-%m-%d",$this->getUnixStartDate());
		}
		return $this->_startdate;
		//return $this->_publish_up;
	}

	function endDate(){
		if (!isset($this->_enddate)){
			$this->_enddate=strftime("%Y-%m-%d",$this->getUnixEndDate());
		}
		return $this->_enddate;
		//return $this->_publish_down;
	}

	function hasExtraInfo() {
		return !empty( $this->_extra_info );
	}

	function hasLocation() {
		return !empty( $this->_adresse_info );
	}

	function hasContactInfo() {
		return !empty( $this->_contact_info );

	}

	// workaround for php 4 - much easier in php 5!!!
	function getOrSet($field, $val=""){
		$field = "_".$field;
		if (strlen($val)==0) return $this->$field;
		else $this->$field=$val;
	}
	function get($field){
		$field = "_".$field;
		if (isset($this->$field)) return $this->$field;
		else return false;
	}
	function set($field, $val=""){
		$field = "_".$field;
		$this->$field=$val;
	}

	function id() { return $this->_id; }
	function title() { return $this->_title!=""?$this->_title:""; }
	function useCatColor() { return $this->_useCatColor; }
	function color_bar() { return $this->_color_bar; }
	function catid() { return $this->_catid; }
	function created_by() { return $this->_created_by; }
	function hits() { return $this->_hits; }
	function state() { return $this->_state; }
	function alldayevent() { return $this->_alldayevent; }

	function modifylink($val="") {
		return $this->getOrSet(__FUNCTION__,$val);
	}

	function content($val="") {
		return $this->getOrSet(__FUNCTION__,$val);
	}

	function access($val="") {
		return $this->getOrSet(__FUNCTION__,$val);
	}

	function location($val="") {
		return $this->getOrSet("adresse_info",$val);
	}
	function contact_info($val="") {
		return $this->getOrSet(__FUNCTION__,$val);
	}

	function extra_info($val="") {
		return $this->getOrSet(__FUNCTION__,$val);
	}

	function yup() { return $this->_yup; }
	function mup() { return $this->_mup; }
	function dup() { return $this->_dup; }
	function hup() { return $this->_hup; }
	function minup() { return $this->_minup; }
	function sup() { return $this->_sup; }

	function ydn() { return $this->_ydn; }
	function mdn() { return $this->_mdn; }
	function ddn() { return $this->_ddn; }
	function hdn() { return $this->_hdn; }
	function mindn() { return $this->_mindn; }
	function sdn() { return $this->_sdn; }


	function publish_up() {return$this->_publish_up;}
	function publish_down() {return$this->_publish_down;}

	function reccurtype() {	return $this->_reccurtype;	}
	function reccurday() {	return $this->_reccurday;	}
	function reccurweeks() {return $this->_reccurweeks;	}
	function reccurweekdays() {return $this->_reccurweekdays;	}

	function getUnixStartDate() {
		if (!isset($this->_unixstartdate)){
			$this->_unixstartdate=mktime( 0, 0, 0, $this->mup(), $this->dup(), $this->yup() );
		}
		return $this->_unixstartdate;
	}

	function getUnixEndDate() {
		if (!isset($this->_unixenddate)){
			$this->_unixenddate=mktime( 0, 0, 0, $this->mdn(), $this->ddn(), $this->ydn() );
		}
		return $this->_unixenddate;
	}

	function getUnixStartTime() {
		if (!isset($this->_unixstartime)){
			$this->_unixstarttime=mktime( $this->hup(),$this->minup(), $this->sup(), $this->mup(), $this->dup(), $this->yup() );
		}
		return $this->_unixstarttime;
	}

	function getUnixEndTime() {
		if (!isset($this->_unixendtime)){
			$this->_unixendtime=mktime( $this->hdn(),$this->mindn(), $this->sdn(), $this->mdn(), $this->ddn(), $this->ydn() );
		}
		return $this->_unixendtime;
	}

	function contactLink($val=""){
		if (strlen($val)==0) {
			if (!isset($this->_contactLink)) $this->_contactLink = mosEventsHTML::getUserMailtoLink( $this->id(), $this->created_by());
			return $this->_contactLink;
		}
		else $this->_contactLink=$val;
	}

	function catname($val=""){
		if (strlen($val)==0) {
			if (!isset($this->_catname)) $this->_catname = $this->getCategoryName();
			return $this->_catname;
		}
		else $this->_catname=$val;
	}

	function bgcolor($val=""){
		if (strlen($val)==0) {
			if (!isset($this->_bgcolor)) $this->_bgcolor = setColor($this);
			return $this->_bgcolor;
		}
		else $this->_bgcolor=$val;
	}

	function fgcolor($val=""){
		if (strlen($val)==0) {
			if (!isset($this->_fgcolor)) $this->_fgcolor = mapColor($this->bgcolor());
			return $this->_fgcolor;
		}
		else $this->_fgcolor=$val;
	}

	function getCategoryName( ){
		$db	=& JFactory::getDBO();

		static $arr_catids;

		$catid = intval($this->catid());

		if (!$arr_catids) {
			$arr_catids = array();
		}
		if (!isset($arr_catids[$catid])) {
			$catsql = "SELECT id, name"
			. "\n FROM #__categories"
			. "\n WHERE id='$catid'"
			;
			$db->setQuery($catsql);

			if( $categories = $db->loadObjectList() ) {
				$arr_catids[$catid] = $categories[0]->name;
			} else {
				$arr_catids[$catid] ='';
			}
		}
		return $arr_catids[$catid];
	}

	function checkRepeatMonth($cellDate, $year,$month){
		// SHOULD REALLY INDEX ON month/year incase more than one being displayed!


		// builds and returns array
		if (!isset($this->eventDaysMonth)){
			$this->eventDaysMonth = array();

			if(is_null($year) || is_null( $month)) {
				return false;
			}

			$monthStartDate = mktime( 0,0,0, $month, 1, $year );
			$daysInMonth = intval(date("t",$monthStartDate ));
			$monthEndDate = mktime( 0,0,0, $month, $daysInMonth , $year );
			$monthEndSecond = mktime( 23,59,59, $month, $daysInMonth , $year );

			$this->eventDaysMonth =  $this->getRepeatArray($monthStartDate, $monthEndDate, $monthEndSecond);
		}
		return (array_key_exists($cellDate,$this->eventDaysMonth));
	}

	function checkRepeatWeek($this_currentdate,$week_start,$week_end)  {

		// SHOULD REALLY INDEX ON weekstart
		// builds and returns array
		if (!isset($this->eventDaysWeek)){
			$this->eventDaysWeek = array();

			if(is_null($week_start) || is_null( $week_end)) {
				return false;
			}

			list($y,$m,$d) = explode(":",strftime("%Y:%m:%d",$week_end));
			$weekEndSecond = mktime( 23,59,59, $m, $d , $y);

			$this->eventDaysWeek =  $this->getRepeatArray($week_start, $week_end, $weekEndSecond);
		}
		return (array_key_exists($this_currentdate,$this->eventDaysWeek));
	}

	function checkRepeatDay($this_currentdate){

		list($y,$m,$d) = explode(":",strftime("%Y:%m:%d",$this_currentdate));
		$dayEndSecond = mktime( 23,59,59, $m, $d , $y);

		$this->eventDaysDay =  $this->getRepeatArray($this_currentdate, $this_currentdate, $dayEndSecond);
		return (array_key_exists($this_currentdate,$this->eventDaysDay));
		/*
		* do net keep result set, next call is for different day
		if (!isset($this->eventDaysDay)){
		$this->eventDaysDay = array();

		if(is_null($this_currentdate)) {
		return false;
		}

		list($y,$m,$d) = explode(":",strftime("%Y:%m:%d",$this_currentdate));
		$dayEndSecond = mktime( 23,59,59, $m, $d , $y);

		$this->eventDaysDay =  $this->getRepeatArray($this_currentdate, $this_currentdate, $dayEndSecond);
		}
		return (array_key_exists($this_currentdate,$this->eventDaysDay));
		*/
	}

	function getRepeatArray( $startPeriod, $endPeriod, $periodEndSecond) {

		// NEED TO CHECK MONTH and week overlapping month end
		// builds and returns array
		$eventDays = array();

		// double check the SQL has given us valid events
		$event_start_date = mktime( 0,0,0,  $this->_mup, $this->_dup, $this->_yup );
		$event_end_date = mktime( 0,0,0,  $this->_mdn, $this->_ddn, $this->_ydn );
		if ($event_end_date<$startPeriod || $event_start_date>$periodEndSecond) return  $eventDays;

		$daysInMonth = intval(date("t",$startPeriod ));
		list($periodStartDay, $month, $year) = explode(":",date("d:m:Y",$startPeriod));

		$repeatingEvent = false;
		if ($this->_reccurtype!=0 || $this->_reccurday!="" || $this->_reccurweekdays!="" || $this->_reccurweeks!=""){
			$repeatingEvent = true;
		}

		// treat midnight as a special case
		$endsMidnight = false;
		if ($this->_hdn==0 && $this->_mindn==0 && $this->_sdn==0 ){
			$endsMidnight = true;
		}

		$multiDayEvent = false;
		if ($this->_dup!=$this->_ddn || $this->_mup!=$this->_mdn || $this->_yup!=$this->_ydn  ) {	// should test month/year too!
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

		//echo "row->reccurtype = $this->_reccurtype $this->_id<br/><br/>CHECK IT OUT - type 2 needs more work!!!<br/><hr/>";

		switch( $this->_reccurtype) {
			case 0: // All days
			$this->viewable = true;
			return $this->viewable;
			break;

			case 1: // By week - 1* by week
			case 2: // By week - n* by week

			// This is multi-days per week
			if ($this->_reccurweekdays != ""){
				$reccurweekdays	= explode( '|', $this->_reccurweekdays );
				$countdays		= count( $reccurweekdays );
			}
			// This is once a week
			else if ($this->_reccurday!="") {
				$reccurweekdays   = array();
				$tmp_weekday      = intval($this->_reccurday);
				if ($tmp_weekday == -1) {
					$tmp_weekday = intval(date( 'w', $event_start_date));
				}
				$reccurweekdays[] = $tmp_weekday;
				$countdays		  = count( $reccurweekdays );
			}
			else {
				echo "Should not really be here <br/>";
			}

			if (strpos($this->_reccurweeks,"pair")===false) {
				$repeatweeks	= explode( '|', $this->_reccurweeks );
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
						if ($nextDate>=$event_start_date && $nextDate<=$event_end_date)	$eventDays[$nextDate]=true;
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
					if ($this->_reccurweeks=="pair"){
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
					else if ($this->_reccurweeks=="impair"){
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
			if( $this->_reccurday ==-1 ) { //by day number

				list($event_start_day, $event_start_month, $event_start_year) = explode(":",date("d:m:Y",$event_start_date));
				$nextDate = mktime(0,0,0,$month, $event_start_day, $year);
				if ($nextDate >= $event_start_date && $nextDate<=$event_end_date) $eventDays[$nextDate]=true;
			}
			else { //by day name following the day number

				list($event_start_day, $event_start_month, $event_start_year) = explode(":",date("d:m:Y",$event_start_date));
				$equiv_day_of_month = mktime( 0, 0, 0, $month, $event_start_day, $year);
				$weekday_of_equivalent = date( 'w', $equiv_day_of_month);
				$temp = $event_start_day + (7+$this->_reccurday - $weekday_of_equivalent)%7;

				$nextDate = mktime( 0, 0, 0, $month, $temp, $year);
				if ($nextDate >= $event_start_date && $nextDate<=$event_end_date) $eventDays[$nextDate]=true;
			}
			return $eventDays;
			break;

			case 4: // By month - end of the month
			// get month end
			list($lastday, $month, $year) = explode(":",date("t:m:Y",$endPeriod));
			$monthEnd = mktime(0,0,0,$month,$lastday,$year);
			if ($monthEnd >= $event_start_date && $monthEnd<=$event_end_date) $eventDays[$monthEnd]=true;
			return $eventDays;

			break;

			case 5: // By year - 1* by year
			list($event_start_day, $event_start_month, $event_start_year) = explode(":",date("d:m:Y",$event_start_date));
			if ($month == $event_start_month){
				if( $this->_reccurday ==-1 ) { //by day number

					$nextDate = mktime(0,0,0,$month, $event_start_day, $year);
					if ($nextDate >= $event_start_date && $nextDate<=$event_end_date) $eventDays[$nextDate]=true;
				}
				else { //by day name following the day number

					list($event_start_day, $event_start_month, $event_start_year) = explode(":",date("d:m:Y",$event_start_date));
					$equiv_day_of_month = mktime( 0, 0, 0, $month, $event_start_day, $year);
					$weekday_of_equivalent = date( 'w', $equiv_day_of_month);
					$temp = $event_start_day + (7+$this->_reccurday - $weekday_of_equivalent)%7;

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

	function vCalExportLink($sef=false, $singlerecurrence=false){
		$cfg = & EventsConfig::getInstance();
		$jev_component_name  = $cfg->get("com_componentname");
		$Itemid	= EventsHelper::getItemid();
		$link = "index2.php?option=$jev_component_name&task=vCalendar&agid=".$this->id()
		. "&Itemid=".$Itemid
		. "&class=".get_class($this)
		// after testing set showBR = 0
		. "&showBR=1";
		if ($singlerecurrence){
			$link .= "&sr=1";
		}
		else {
			$link .= "&sr=0";
		}
		$link = $sef?JRoute::_( $link  ):$link;
		return $link;
	}

	function editLink($sef=false) {
$cfg = & EventsConfig::getInstance();
$jev_component_name  = $cfg->get("com_componentname");
		$Itemid	= EventsHelper::getItemid();
		$link = "index.php?option=$jev_component_name&task=".$this->editTask().'&agid='. $this->id().'&Itemid='.$Itemid ;
		$link = $sef?JRoute::_( $link  ):$link;
		return $link;
	}

	function editRepeatLink($sef=false) {
		// only applicable for jivalevents at present
		return "";
	}

	function deleteLink($sef=false) {
$cfg = & EventsConfig::getInstance();
$jev_component_name  = $cfg->get("com_componentname");
		$Itemid	= EventsHelper::getItemid();
		$link = "index.php?option=$jev_component_name&task=".$this->deleteTask().'&agid='. $this->id().'&Itemid='.$Itemid;
		$link = $sef?JRoute::_( $link  ):$link;
		return $link;
	}

	function deleteRepeatLink($sef=false) {
		// only applicable for jivalevents at present
		return "";
	}

	function viewDetailLink($year,$month,$day, $sef=true){
$cfg = & EventsConfig::getInstance();
$jev_component_name  = $cfg->get("com_componentname");

		$link = "index.php?option=$jev_component_name&task=view_detail&agid=".$this->id()."&jevtype=jevent"
		."&year=$year&month=$month&day=$day" ;
		$link = $sef?JRoute::_( $link  ):$link;
		return $link;

	}

	function canUserEdit(){
		$is_event_editor = EventsHelper::isEventEditor();
		$user =& JFactory::getUser();
		return ($is_event_editor && $this->isEditable() && ( $this->created_by() == $user->id || strtolower($user->usertype ) == 'super administrator' || strtolower($user->usertype ) == 'administrator'));
	}

	function repeatSummary(){

		$cfg = & EventsConfig::getInstance();

		if (defined("_CAL_LANG_REPEAT_GRAMMAR")){
			$grammar = _CAL_LANG_REPEAT_GRAMMAR;
		}
		else $grammar=1; // i.e. follow english word order by default

		// if starttime and end time the same then show no times!
		if( $this->start_date == $this->stop_date ){
			if (($this->start_time != $this->stop_time) && !($this->alldayevent())){
				echo $this->start_date . ',&nbsp;' . $this->start_time
				. '&nbsp;-&nbsp;' . $this->stop_time;
			} else {
				echo $this->start_date;
			}
		} else {
			// recurring events should have time related to recurrance not range of dates
			if ($this->start_time != $this->stop_time && !($this->reccurtype() > 0)) {
				echo _CAL_LANG_FROM . '&nbsp;' . $this->start_date . '&nbsp;-&nbsp; '
				. $this->start_time . '<br />'
				. _CAL_LANG_TO . '&nbsp;' . $this->stop_date . '&nbsp;-&nbsp;'
				. $this->stop_time . '<br/>';
			} else {
				echo _CAL_LANG_FROM . '&nbsp;' . $this->start_date . '<br />'
				. _CAL_LANG_TO . '&nbsp;' . $this->stop_date . '<br/>';
			}
		}

		if( $this->reccurtype() > 0 ){
			switch( $this->reccurtype() ){
				case '1': $reccur = _CAL_LANG_REP_WEEK;     break;
				case '2': $reccur = _CAL_LANG_REP_WEEK;     break;
				case '3': $reccur = _CAL_LANG_REP_MONTH;    break;
				case '4': $reccur = _CAL_LANG_REP_MONTH;    break;
				case '5': $reccur = _CAL_LANG_REP_YEAR;     break;
			}

			if( $this->reccurday() >= 0 || ($this->reccurtype()==1 || $this->reccurtype()==2)){
				$timeString = "";
				if ($this->start_time != $this->stop_time) {
					$timeString = $this->start_time."&nbsp;-&nbsp;".$this->stop_time."&nbsp;";
				}
				echo $timeString;

				if (intval($this->reccurday())<0){
					$event_start_date = strtotime($this->startDate()) ;
					$reccurday = intval(date( 'w',$event_start_date));
				}
				else $reccurday =$this->reccurday();
				if( $this->reccurtype() == 1 ){
					$dayname = mosEventsHTML::getLongDayName( $reccurday );
					echo $dayname . '&nbsp;' . _CAL_LANG_EACHOF . '&nbsp;' . $reccur;
				}else if($this->reccurtype() == 2 ){
					$each =  _CAL_LANG_EACH . '&nbsp;';
					if ($grammar==1){
						$each = strtolower($each);
					}
					$daystring="";
					if (strlen($this->reccurweeks())==0){
						$days = explode("|",$this->reccurweekdays());
						for ($d=0;$d<count($days);$d++){
							$daystring .= mosEventsHTML::getLongDayName( $days[$d] );
							$daystring .= ($d==0?",":"")."&nbsp;";
						}
						$weekstring="";
					}
					else {
						$days = explode("|",$this->reccurweekdays());
						for ($d=0;$d<count($days);$d++){
							$daystring .= mosEventsHTML::getLongDayName( $days[$d] );
							$daystring .= ($d==0?",":"")."&nbsp;";
						}
						$weekstring = $this->reccurweeks() == 'pair' ? _CAL_LANG_REP_WEEKPAIR : ( $this->reccurweeks() == 'impair' ? _CAL_LANG_REP_WEEKIMPAIR : "" );
						if ($weekstring==""){
							switch ($grammar){
								case 1:
									$weekstring = "- "._CAL_LANG_REP_WEEK." ";
									$weekstring .= str_replace("|",", ",$this->reccurweeks())." ";
									$weekstring .= strtolower(_CAL_LANG_EACHMONTH);
									break;
								default:
									$weekstring = str_replace("|",", ",$this->reccurweeks())." ";
									$weekstring .= $reccur;
									$weekstring .= _CAL_LANG_EACHMONTH;
									break;
							}
						}
					}
					$firstword=true;
					switch ($grammar){
						case 1:
							echo $daystring.$weekstring;
							break;
						default:
							echo $each.$daystring.$weekstring;
							break;
					}
				} else {
					echo _CAL_LANG_EACH . '&nbsp;' . $reccur;
				}

			} else {
				echo _CAL_LANG_EACH . '&nbsp;' . $reccur;
			}
		} else {
			if( $this->start_date != $this->stop_date ){
				echo _CAL_LANG_ALLDAYS;
			}
		}


	}

}
/*
// This class is now redundant since we store the repititions in the DB
// Kepp the code during development just in case!
class jIcalEvent extends jEvent {
var $vevent;
function jIcalEvent($vevent) {
$this->vevent = $vevent;
$this->data = new stdClass();
$this->_access=0;
$this->_content= $vevent->data["SUMMARY"];
$this->_title= $this->_content;
$this->_location= $vevent->data["SUMMARY"];
$this->_publish_up = strftime( '%Y-%m-%d %H:%M:%S',$vevent->data["DTSTART"]);

$this->_reccurtype = $vevent->reccurtype;
$this->_reccurday = $vevent->reccurday;
$this->_reccurweekdays = $vevent->reccurweekdays;
$this->_reccurweeks = $vevent->reccurweeks;
$this->_alldayevent = $vevent->alldayevent;

$this->_useCatColor=0;
$this->_color_bar="#ffffff";
list ($this->_yup,$this->_mup,$this->_dup,$this->_hup,$this->_minup,$this->_sup) =
explode(":",strftime( '%Y:%m:%d:%H:%M:%S',$vevent->data["DTSTART"]));

list ($this->_ydn,$this->_mdn,$this->_ddn,$this->_hdn,$this->_mindn,$this->_sdn) =
explode(":",strftime( '%Y:%m:%d:%H:%M:%S',$vevent->data["DTEND"]));
$this->_publish_down = $vevent->publish_down;

$this->_id = $vevent->data['UID'];
$this->_created_by=0;
$this->_adresse_info="";
$this->_contact_info="";
$this->_extra_info=0;
$this->_hits=0;

$this->_catid=-1;
$this->_catname="ICS FILE";
$this->_contactlink="n/a";
}

function isEditable(){
return false;
}

function getCategoryName( ){
return "holiday file";
}

function checkRepeatMonth($cellDate, $year, $month){
// builds and returns array
if (!isset($this->eventDaysMonth)){
$this->eventDaysMonth = array();
}
// APALLING!!
// This is where the repetition stuff goes!
//if (!isset($this->vevent->freq)){
if ($this->vevent->eventOnDate($cellDate)) $this->eventDaysMonth[$cellDate]=true;
//}

return (array_key_exists($cellDate,$this->eventDaysMonth));
}

function checkRepeatWeek($this_currentdate,$week_start,$week_end) {
// APALLING!!
// This is where the repetition stuff goes!
if (!isset($this->vevent->freq)){
// Add one second to avoid midnight twice!
if ($this->vevent->eventOnDate($this_currentdate+1)) return true;
}
return false;
}

// Dont report hists for a ICS entry
function reportHits(){	}

function viewDetailLink($year,$month,$day, $sef=true){
echo "Need to write  viewDetailLink 1<br/>";
return parent::viewDetailLink($year,$month,$day,$sef);
}

function repeatSummary() {
$result = "<span style='font-weight:bold;color:black;background-color:yellow'>I need a specialised repeat event info handler for ICal events!</span><br/>";
$result .= parent::repeatSummary();
return $result;
}


}
*/

/**
 * Utility class that holds an instanceof an iCalICSFile and its associated collection
 * of iCalEvent
 *
 */
class jIcal {
	var $icalFile;
	var $icalEvents;

	function iCal(){
		$this->icalEvents=array();
	}
}


class jIcalEventDB extends jEventCal {
	//var $vevent;
	var $_icsid=0;

	function jIcalEventDB($vevent) {
		$cfg = & EventsConfig::getInstance();
		$compname = $cfg->get("com_componentname");
		// TODO - what is vevent is actually stdClass already
		$this->data = new stdClass();
		$array= get_object_vars($vevent);
		foreach ($array as $key=>$val) {
			if (strpos($key,"_")!==0  && $key!="_db"){
				$key = "_".$key;
				$this->$key = $val;
			}
		}
		// Mysql reserved word workaround
		$this->_interval = isset($vevent->rinterval)?$vevent->rinterval:0;
		//global $mainframe;
		//include_once(JPATH_SITE."/components/$compname/libraries/iCalImport.php");
		//$this->vevent = iCalEvent::iCalEventFromDB($array);

		$this->_access=0;
		$this->_content= $vevent->description;
		$this->_title= $vevent->summary;
		//TODO move start repeat to descendent class where it belongs
		if (isset($this->_startrepeat)) {
			$this->_publish_up = $this->_startrepeat;
		}
		else {
			$this->_publish_up = strftime( '%Y-%m-%d %H:%M:%S',$this->_dtstart);
		}

		$this->_reccurtype = 0;
		$this->_reccurday = "";
		$this->_reccurweekdays = "";
		$this->_reccurweeks = "";
		$this->_alldayevent = 0;
		list($hs,$ms,$ss) = explode(":",strftime( '%H:%M:%S',$this->_dtstart));
		list($he,$me,$se) = explode(":",strftime( '%H:%M:%S',$this->_dtend));
		if (($hs+$ms+$ss)==0 && ($he==23 && $me==59 && $se==59)) {
			$this->_alldayevent = 1;
		}
		// catch legacy events with mixed database structure
		else if (($hs+$ms+$ss)==0 && ($he+$me+$se)==0) {
			if (isset($this->_endrepeat)){
				$temp = strtotime($this->_endrepeat);
				if ($temp==$this->_dtend){
					$this->_endrepeat=strftime( '%Y-%m-%d %H:%M:%S',$temp-1);
				}
				$this->_dtend-=1;
			}
			$this->_alldayevent = 1;
		}
		// TODO Make this an option in the config
		$this->_useCatColor=1;
		$this->_color_bar="#ffffff";

		if (isset($this->_endrepeat)){
			$this->_publish_down = $this->_endrepeat;
		}
		else {
			$this->_publish_down = strftime( '%Y-%m-%d %H:%M:%S',$this->_dtend);
		}

		$user =& JFactory::getUser();
		if (!isset($this->_created_by)) $this->_created_by=$user->id;
		$this->_hits=0;

		list($this->_yup,$this->_mup,$this->_dup) = explode("-",$this->_publish_up);
		list($this->_dup,$temp) = explode(" ",$this->_dup);
		list($this->_ydn,$this->_mdn,$this->_ddn) = explode("-",$this->_publish_down);
		list($this->_ddn,$temp) = explode(" ",$this->_ddn);

		// initially unpublished
		if (!isset($this->_state)) $this->_state=0;

		$this->_contactlink="n/a";
	}

	function hasLocation() {
		return !empty( $this->_location );
	}

	function location($val="") {
		return $this->getOrSet(__FUNCTION__,$val);
	}

	function hasContactInfo() {
		return !empty( $this->_contact);

	}

	function contact_info($val="") {
		return $this->getOrSet("contact",$val);
	}


	function dtstart($val=""){
		if (strlen($val)==0) return $this->_dtstart;
		else {
			$this->_dtstart=$val;
			$this->_publish_up = strftime( '%Y-%m-%d %H:%M:%S',$this->_dtstart);
		}
	}

	function interval($val="") {
		if (strlen($val)==0) {
			if (!isset($this->_interval) || $this->_interval=="" || $this->_interval==0) return 1;
			else return $this->_interval;
		}
		else {
			$this->_until=$val;
		}
	}

	function count($val="") {
		if (strlen($val)==0) {
			if (!isset($this->_count) || $this->_count=="" || $this->_count==0) return 1;
			else return $this->_count;
		}
		else {
			$this->_until=$val;
		}
	}

	function rawuntil(){
		if (!isset($this->_until) || $this->_until=="" || $this->_until==0) return "";
		return $this->_until;
	}

	function until($val="") {
		if (strlen($val)==0) {
			if (!isset($this->_until) || $this->_until=="" || $this->_until==0) return $this->_dtstart;
			return $this->_until;
		}
		else {
			$this->_until=$val;
		}
	}

	function freq($val="") {
		return $this->getOrSet(__FUNCTION__,$val);
	}

	function icsid($val=""){
		return $this->getOrSet(__FUNCTION__,$val);
	}
	function dtend($val=""){
		if (strlen($val)==0) return $this->_dtend;
		else {
			$this->_dtend=$val;
			$this->_publish_down = strftime( '%Y-%m-%d %H:%M:%S',$this->_dtend);
		}
	}

	function starttime($val=""){
		if (strlen($val)==0) return strftime( '%H:%M',$this->_dtstart);
		else {
			$this->_dtstart = strtotime($val,$this->_dtstart);
		}
	}

	function endtime($val=""){
		if (strlen($val)==0) return strftime( '%H:%M',$this->_dtend);
		else {
			$this->_dtend = strtotime($val,$this->_dtend);
		}
	}

	function byyearday($raw=false){
		if ($raw) return $this->_byyearday;
		// TODO consider relaxing assumption that always + or - and not a mixture
		if (isset($this->_byyearday) && $this->_byyearday!="") {
			$temp = $this->_byyearday;
			$temp = str_replace("+","",$temp);
			$temp = str_replace("-","",$temp);
			return $temp;
		}
		else return $this->startYearDay();
	}

	function byday($raw=false){
		if ($raw) return $this->_byday;
		// TODO consider relaxing assumption that always + or - and not a mixture
		if (isset($this->_byday) && $this->_byday!="") {
			$temp = $this->_byday;
			$temp = str_replace("+","",$temp);
			$temp = str_replace("-","",$temp);
			return $temp;
		}
		else return "";
	}

	function startYearDay() {
		return strftime("%j",$this->_dtstart);
	}

	function byweekno($raw=false){
		if ($raw) return $this->_byweekno;
		if (isset($this->_byweekno) && $this->_byweekno!="") return $this->_byweekno;
		else return $this->startWeekNo();
	}

	function getByDay_weeks(){
		if (isset($this->_byday) && $this->_byday!="") {
			$days = explode(",",$this->_byday);
			if (count($days)==0) return $this->startWeekDay();
			$weeknums = array();
			foreach ($days as $day) {
				preg_match("/(\+|-?)(\d?)(.+)/",$day,$details);
				if (count($details)!=4) {
					echo "<br/><br/><b>PROBLEMS with $day</b><br/><br/>";
					return  $this->startWeekDay();
				}
				else {
					list($temp,$plusminus,$weeknumber,$dayname) = $details;
					if (!in_array($weeknumber,$weeknums)){
						$weeknums[]=$weeknumber;
					}
				}
			}
			// need to return as a string because of using old function later!!
			return implode("|",$weeknums);
		}
		return $this->startWeekNo();
	}

	function startWeekNo() {

		$cfg = & EventsConfig::getInstance();
		$fmt = ($cfg->get("com_starday")==0)?"%U":"%W";
		return strftime($fmt,$this->_dtstart);
	}

	function startWeekOfMonth() {
		$md = $this->startMonthDay();
		return ceil($md/7);
	}

	function bymonthday($raw=false) {
		if ($raw) return $this->_bymonthday;
		// TODO consider relaxing assumption that always + or - and not a mixture
		if (isset($this->_bymonthday) && $this->_bymonthday!=""){
			$temp = $this->_bymonthday;
			$temp = str_replace("+","",$temp);
			$temp = str_replace("-","",$temp);
			return $temp;
		}
		else return $this->startMonthDay();
	}

	function startMonthDay() {
		return intval(strftime("%d",$this->_dtstart));
	}

	function bymonth($raw=false){
		if ($raw) return $this->_bymonth;
		if (isset($this->_bymonth) && $this->_bymonth!="") return $this->_bymonth;
		else return $this->startMonth();
	}

	function startMonth() {
		return intval(strftime("%m",$this->_dtstart));
	}


	function getByDirectionChecked($direction = "byday"){
		if ($this->getByDirection($direction)){
			return "";
		}
		else {
			return "checked";
		}
	}

	/**
	 * Returns true if from start of period otheriwse false if counting back
	 */
	function getByDirection($direction = "byday"){
		$direction = "_".$direction;
		if (isset($this->$direction) && $this->$direction!="") {
			$parts = explode(",",$this->$direction);
			if (count($parts)==0) return true;
			foreach ($parts as $part) {
				preg_match("/(\+|-?)(\d?)(.+)/",$part,$details);
				if (count($details)!=4) {
					return true;
				}
				else {
					list($temp,$plusminus,$number,$name) = $details;
					if ($plusminus=="-") {
						return false;
					}
					else {
						return true;
					}
				}
			}
			// just in case
			return true;
		}
		else {
			return true;
		}
	}

	function getByDay_days(){
		static $weekdayMap=array("SU"=>0,"MO"=>1,"TU"=>2,"WE"=>3,"TH"=>4,"FR"=>5,"SA"=>6);
		if (isset($this->_byday) && $this->_byday!="") {
			$days = explode(",",$this->_byday);
			if (count($days)==0) return $this->startWeekDay();
			$weekdays = array();
			foreach ($days as $day) {
				preg_match("/(\+|-?)(\d?)(.+)/",$day,$details);
				if (count($details)!=4) {
					echo "<br/><br/><b>PROBLEMS with $day</b><br/><br/>";
					return  $this->startWeekDay();
				}
				else {
					list($temp,$plusminus,$weeknumber,$dayname) = $details;
					if (!in_array($weekdayMap[$dayname],$weekdays)){
						$weekdays[]=$weekdayMap[$dayname];
					}
				}
			}
			// need to return as a string because of using old function later!!
			return implode("|",$weekdays);
		}
		else return $this->startWeekDay();
	}

	function startWeekDay() {
		return intval(strftime("%w",$this->_dtstart));
	}

	function isEditable(){
		return true;
	}

	function editTask(){
		return "editIcalEvent";
	}

	function deleteTask(){
		return "deleteIcalEvent";
	}

	function id() {
		if (!isset($this->_ev_id)) return 0;
		return $this->_ev_id;
	}
	// Note for and icaldb event a single repetition represents the single event

	function getCategoryName( ){
		return parent::getCategoryName()." (ICS FILE)";
		//return "holiday file";
	}

	// Dont report hists for a ICS entry
	function reportHits(){	}

	/**
	 * export in ICAL format
	 *
	 */
	function export(){

	}

	function repeatSummary(){
		$sum = "";
		$cfg = & EventsConfig::getInstance();

		if (defined("_CAL_LANG_REPEAT_GRAMMAR")){
			$grammar = _CAL_LANG_REPEAT_GRAMMAR;
		}
		else $grammar=1; // i.e. follow english word order by default

		// if starttime and end time the same then show no times!
		if( $this->start_date == $this->stop_date ){
			if (($this->start_time != $this->stop_time) && !($this->alldayevent())){
				$sum.= $this->start_date . ',&nbsp;' . $this->start_time
				. '&nbsp;-&nbsp;' . $this->stop_time . '<br/>';
			} else {
				$sum.= $this->start_date . '<br/>';
			}
		} else {
			// recurring events should have time related to recurrance not range of dates
			if ($this->start_time != $this->stop_time && !($this->reccurtype() > 0)) {
				$sum.= _CAL_LANG_FROM . '&nbsp;' . $this->start_date . '&nbsp;-&nbsp; '
				. $this->start_time . '<br />'
				. _CAL_LANG_TO . '&nbsp;' . $this->stop_date . '&nbsp;-&nbsp;'
				. $this->stop_time . '<br/>';
			} else {
				$sum.= _CAL_LANG_FROM . '&nbsp;' . $this->start_date . '<br />'
				. _CAL_LANG_TO . '&nbsp;' . $this->stop_date . '<br/>';
			}
		}
		if ($this->_freq=="none"){
			return;
		}
		if ($this->_interval>0){
			if ($this->_interval==1){
				switch ($this->_freq){
					case 'DAILY': $reccur = _CAL_LANG_ALLDAYS;     break;
					case 'WEEKLY': $reccur = _CAL_LANG_EACHWEEK;    break;
					case 'MONTHLY': $reccur = _CAL_LANG_EACHMONTH;  break;
					case 'YEARLY': $reccur = _CAL_LANG_EACHYEAR;    break;
				}
			}
			else {
				switch ($this->_freq){
					case 'DAILY': $reccur = _CAL_LANG_EVERY_N_DAYS;     break;
					case 'WEEKLY': $reccur = _CAL_LANG_EVERY_N_WEEKS;    break;
					case 'MONTHLY': $reccur = _CAL_LANG_EVERY_N_MONTHS;  break;
					case 'YEARLY': $reccur = _CAL_LANG_EVERY_N_YEARS;    break;
				}
				$reccur = sprintf($reccur,$this->_interval);
			}
			if ($this->_count==99999){
				list ($y,$m,$d) = explode(":",strftime("%Y:%m:%d",$this->until()));
				$extra = _CAL_LANG_UNTIL."&nbsp;".mosEventsHTML::getDateFormat($y,$m,$d,1);
			}
			else {
				$extra = sprintf(_CAL_LANG_COUNTREPEATS, $this->_count);
			}
			$sum.= $reccur."&nbsp;".$extra;
		}
		return $sum;
	}
}

class jIcalEventRepeat extends jIcalEventDB{

	function id() {
		if (!isset($this->_rp_id)) return parent::id();
		return $this->_rp_id;
	}

	function rp_id() {
		return $this->_rp_id;
	}

	function checkRepeatMonth($cellDate, $year, $month){
		// builds and returns array
		if (!isset($this->eventDaysMonth)){
			$this->eventDaysMonth = array();
		}

		if (!array_key_exists($cellDate,$this->eventDaysMonth)){
			//if ($this->vevent->eventOnDate($cellDate)) {
			if ($this->eventOnDate($cellDate)) {
				$this->eventDaysMonth[$cellDate]=true;
			}
			else {
				$this->eventDaysMonth[$cellDate]=false;
			}
		}

		return $this->eventDaysMonth[$cellDate];
	}

	function eventOnDate($testDate){
		if (!isset($this->_startday)){
			$this->_startday = mktime(0,0,0,$this->mup(),$this->dup(),$this->yup());
			$this->_endday = mktime(0,0,0,$this->mdn(),$this->ddn(),$this->ydn());
		}
		/*
		// Note class type takes care of repeat behaviour
		if (!isset($this->vevent->rrule)){
		if ($this->_start<=$testDate && $this->_end>=$testDate){
		return true;
		}
		else return false;
		}
		else {
		if (isset($this->vevent->rrule)) {
		return $this->vevent->rrule->checkDate($testDate, $this->_start,$this->_end);
		}
		}
		return false;
		*/
		if ($this->_startday<=$testDate && $this->_endday>=$testDate){
			return true;
		}
		else return false;
	}

	function isEditable(){
		return true;
	}

	function hasrepetition(){
		if (isset($this->_rr_id)  && $this->_rr_id>0 ) return true;
		else return false;
	}

	function editTask(){
		// TODO add methods for editing specific repeats
		return "editIcalRepeat";
	}

	function editLink($sef=false) {
$cfg = & EventsConfig::getInstance();
$jev_component_name  = $cfg->get("com_componentname");
		$Itemid	= EventsHelper::getItemid();
		$link =  "index.php?option=$jev_component_name&task=".parent::editTask().'&id='. parent::id().'&Itemid='.$Itemid ;
		$link = $sef?JRoute::_( $link  ):$link;
		return $link;
	}

	function editRepeatLink($sef=false) {
$cfg = & EventsConfig::getInstance();
$jev_component_name  = $cfg->get("com_componentname");
		$Itemid	= EventsHelper::getItemid();
		$link =  "index.php?option=$jev_component_name&task=".$this->editTask().'&agid='. $this->id().'&Itemid='.$Itemid ;
		$link = $sef?JRoute::_( $link  ):$link;
		return $link;
	}

	function deleteLink($sef=false) {
$cfg = & EventsConfig::getInstance();
$jev_component_name  = $cfg->get("com_componentname");
		$Itemid	= EventsHelper::getItemid();
		$link =  "index.php?option=$jev_component_name&task=".parent::deleteTask().'&id='. parent::id().'&Itemid='.$Itemid ;
		$link = $sef?JRoute::_( $link  ):$link;
		return $link;
	}

	function deleteRepeatLink($sef=false ){
$cfg = & EventsConfig::getInstance();
$jev_component_name  = $cfg->get("com_componentname");
		$Itemid	= EventsHelper::getItemid();
		$link ="index.php?option=$jev_component_name&task=".$this->deleteTask().'&id='. $this->id().'&Itemid='.$Itemid ;
		$link = $sef?JRoute::_( $link  ):$link;
		return $link;
	}


	function viewDetailLink($year,$month,$day,$sef=true){
$cfg = & EventsConfig::getInstance();
$jev_component_name  = $cfg->get("com_componentname");

		$link = "index.php?option=$jev_component_name&task=view_detail&agid=".$this->rp_id()."&jevtype=icaldb"
		."&year=$year&month=$month&day=$day";
		$link = $sef?JRoute::_( $link  ):$link;
		return $link;

	}

	function deleteTask(){
		return "deleteIcalRepeat";
	}

	function checkRepeatWeek($this_currentdate,$week_start,$week_end) {
		//TODO fix this
		//if ($this->vevent->eventOnDate($this_currentdate)) return true;
		if ($this->eventOnDate($this_currentdate)) return true;
		return false;
	}

	function checkRepeatDay($this_currentdate){
		//if ($this->vevent->eventOnDate($this_currentdate)) return true;
		if ($this->eventOnDate($this_currentdate)) return true;
		return false;
	}

	function repeatSummary() {
		$result = parent::repeatSummary();
		if ($this->_eventdetail_id!=$this->_detail_id){
			$result .= "<div class='ev_repeatexception'>"._CAL_LANG_REPEATEXCEPTION."</div>";
		}
		//$result .= "<div style='font-weight:bold;color:black;background-color:yellow'>Repeat Summary needs more work still!</div>";
		return $result;
	}

}

class mosEventDate {
	var $year	= null;
	var $month	= null;
	var $day	= null;
	var $hour	= null;
	var $minute	= null;
	var $second	= null;
	var $dim	= null;

	function mosEventDate( $datetime='' ) {
		if ($datetime!="" && $time = strtotime($datetime)){
			$this->date = $time;
			$parts = explode(":",date("Y:m:j:G:i:s:t",$this->date));

			$this->year   = intval($parts[0]);
			$this->month  = intval($parts[1]);
			$this->day    = intval($parts[2]);
			$this->hour   = intval($parts[3]);
			$this->minute = intval($parts[4]);
			$this->second = intval($parts[5]);
			$this->dim    = intval($parts[6]);
		}
		else {
			$this->date = time();
			$parts = explode(":",date("Y:m:j:G:i:s:t",$this->date ));

			$this->year   = intval($parts[0]);
			$this->month  = intval($parts[1]);
			$this->day    = intval($parts[2]);
			$this->hour   = 0;
			$this->minute = 0;
			$this->second = 0;
			$this->dim    = intval($parts[6]);

		}
	}

	function setDate( $year=0, $month=0, $day=0 ) {
		$this->date = mktime(0,0,0,$month,$day,$year);
		$parts = explode(":",date("Y:m:j:G:i:s:t",$this->date));

		$this->year   = intval($parts[0]);
		$this->month  = intval($parts[1]);
		$this->day    = intval($parts[2]);
		$this->hour   = intval($parts[3]);
		$this->minute = intval($parts[4]);
		$this->second = intval($parts[5]);
		$this->dim    = intval($parts[6]);
	}

	function getYear( $asString=false ) {
		return $asString ? sprintf( '%04d', $this->year ) : $this->year;
	}

	function getMonth( $asString=false ) {
		return $asString ? sprintf( '%02d', $this->month ) : $this->month;
	}

	function getDay( $asString=false ) {
		return $asString ? sprintf( '%02d', $this->day ) : $this->day;
	}

	function get12hrTime( ){
		return date("g:ia",$this->date);
	}

	function get24hrTime( ){
		return sprintf( '%02d:%02d', $this->hour, $this->minute);
	}

	function toDateURL() {
		return( 'year=' . $this->getYear( 1 )
		. '&month=' . $this->getMonth( 1 )
		. '&day=' . $this->getDay( 1 )
		);
	}

	/**
    * Utility function for calculating the days in the month
    *
    * If no parameters are supplied then it uses the current date
    * if 'this' object does not exist
    * @param int The month
    * @param int The year
    */
	function daysInMonth( $month=0, $year=0 ) {
		$month	= intval( $month );
		$year	= intval( $year );

		if ( !$month ){
			if( isset( $this )) {
				$month = $this->month;
			} else {
				$month = date( 'm' );
			}
		}

		if( !$year ){
			if( isset( $this )) {
				$year = $this->year;
			}else{
				$year = date( 'Y' );
			}
		}
		;
		return intval(date("t",mktime(0,0,0,$month,1,$year)));
	}

	/**
    * Adds (+/-) a number of months to the current date.
    * @param int Positive or negative number of months
    */
	function addMonths( $n=0 ) {
		// correct for months where number of days is shorter than source month)
		$dim = intval(date("t",mktime(0,0,0,$this->month+$n,1,$this->year)));
		$this->date = mktime($this->hour,$this->minute,$this->second,$this->month+$n,min($this->day,$dim),$this->year);
		$parts = explode(":",date("Y:m:j:G:i:s:t",$this->date));

		$this->year   = intval($parts[0]);
		$this->month  = intval($parts[1]);
		$this->day    = intval($parts[2]);
		$this->dim    = intval($parts[6]);

	}

	function addDays( $n=0 ) {
		$this->date = mktime($this->hour,$this->minute,$this->second,$this->month,$this->day+$n,$this->year);
		$parts = explode(":",date("Y:m:j:G:i:s:t",$this->date));

		$this->year   = intval($parts[0]);
		$this->month  = intval($parts[1]);
		$this->day    = intval($parts[2]);
		$this->dim    = intval($parts[6]);
	}

	//function toDays( $day=0, $month=0, $year=0)  is no longer needed

	// function fromDays( $days )  is no longer needed
} // end class

class mosEventsHTML{

	function buildRadioOption( $arr, $tag_name, $tag_attribs, $key, $text, $selected ) {
		$html = ''; //"\n<div name=\"$tag_name\" $tag_attribs>";

		for( $i=0, $n=count( $arr ); $i < $n; $i++ ) {
			$k = $arr[$i]->$key;
			$t = $arr[$i]->$text;

			$sel = '';

			if( is_array( $selected )) {
				foreach( $selected as $obj ) {
					$k2 = $obj->$key;
					if( $k == $k2 ) {
						$sel = ' checked="checked"';
						break;
					}
				}
			}else{
				$sel = ( $k == $selected ? ' checked="checked"' : '' );
			}

			$html .= "\n\t"
			. '<input name="' . $tag_name . '" type="radio" value="' . $k . '" id="' .  $tag_name . $k . '"'
			. $sel . ' '
			. $tag_attribs
			. ' />' . "\n"
			. '<label for="' . $tag_name . $k . '">'
			. $t
			. '</label>'
			. "\n"
			;
		}
		//$html .= "\n</select>\n";
		return $html;
	}

	function buildReccurDaySelect( $reccurday, $tag_name, $args ) {
		$day_name = array( '<span class="sunday">' . _CAL_LANG_SUNDAYSHORT . '</span>',
		_CAL_LANG_MONDAYSHORT,
		_CAL_LANG_TUESDAYSHORT,
		_CAL_LANG_WEDNESDAYSHORT,
		_CAL_LANG_THURSDAYSHORT,
		_CAL_LANG_FRIDAYSHORT,
		'<span class="saturday">' . _CAL_LANG_SATURDAYSHORT. '</span>');
		$daynamelist[] = JHTML::_('select.option', '-1', '&nbsp;' . _CAL_LANG_BYDAYNUMBER . '<br />' );

		for( $a=0; $a<7; $a++ ){
			$name_of_day	= '&nbsp;' . $day_name[$a]; //getLongDayName($a);
			$daynamelist[]	= JHTML::_('select.option', $a, $name_of_day );
		}

		$tosend = mosEventsHTML::buildRadioOption( $daynamelist, $tag_name, $args, 'value', 'text', $reccurday );
		echo $tosend;
	}

	function buildMonthSelect( $month, $args ){
		for( $a=1; $a<13; $a++ ){
			$mnh = $a;
			if( $mnh <= '9' & ereg( "(^[0-9]{1})", $mnh )) {
				$mnh = '0' . $mnh;
			}
			$name_of_month = EventsHelper::getMonthName($mnh);
			$monthslist[] = JHTML::_('select.option', $mnh, $name_of_month );
		}

		$tosend = JHTML::_('select.genericlist', $monthslist, 'month', $args, 'value', 'text', $month );
		echo $tosend;
	}

	function buildDaySelect( $year, $month, $day, $args ){
		$nbdays = date( 'd', mktime( 0, 0, 0, ( $month + 1 ), 0, $year ));

		for( $a=1; $a<=$nbdays; $a++ ) { //32
			$dys = $a;
			if( $dys <= '9' & ereg( "(^[1-9]{1})", $dys )) {
				$dys = '0' . $dys;
			}
			$dayslist[] = JHTML::_('select.option', $dys, $dys );
		}

		$tosend = JHTML::_('select.genericlist', $dayslist, 'day', $args, 'value', 'text', $day );
		echo $tosend;
	}

	function buildYearSelect( $year, $args ){
		$y = date( 'Y' );

		if( $year < $y-2 ){
			$yearslist[] = JHTML::_('select.option', $year, $year );
		}

		for( $i = $y-2; $i <= $y+5; $i++ ){
			$yearslist[] = JHTML::_('select.option', $i, $i );
		}

		if( $year > $y+5 ){
			$yearslist[] = JHTML::_('select.option', $year, $year );
		}

		$tosend = JHTML::_('select.genericlist', $yearslist, 'year', $args, 'value', 'text', $year );
		echo $tosend;
	}

	function buildViewSelect( $viewtype, $args ) {

		$cfg = & EventsConfig::getInstance();

		$viewlist[] = JHTML::_('select.option', 'view_day', 		_CAL_LANG_VIEWBYDAY );
		$viewlist[] = JHTML::_('select.option', 'view_week', 	_CAL_LANG_VIEWBYWEEK );
		$viewlist[] = JHTML::_('select.option', 'view_month', 	_CAL_LANG_VIEWBYMONTH );
		$viewlist[] = JHTML::_('select.option', 'view_year', 	_CAL_LANG_VIEWBYYEAR );

		if ($cfg->get('com_hideshowbycats', 0) == '0') {
			$viewlist[] = JHTML::_('select.option', 'view_cat', _CAL_LANG_VIEWBYCAT );
		}

		$viewlist[] = JHTML::_('select.option', 'view_search', 	_SEARCH_TITLE );

		$tosend = JHTML::_('select.genericlist', $viewlist, 'task', $args, 'value', 'text', $viewtype );
		echo $tosend;
	}

	function buildHourSelect( $start, $end, $inc, $tag_name, $tag_attribs, $selected, $format='' ) {

		$cfg = & EventsConfig::getInstance();

		$start	= intval( $start );
		$end 	= intval( $end );
		$inc 	= intval( $inc );
		$arr 	= array();
		$tmpi 	= '';

		for( $i = $start; $i <= $end; $i += $inc ) {
			if( $cfg->get('com_dateformat') == '1' ) { // US time
				if ($i > 11) {
					$tmpi = ($i-12) . ' pm';
				} else {
					$tmpi = $i . ' am';
				}
			}else{
				$tmpi = $format ? sprintf( $format, $i ) : $i;
			}

			$fi 	= $format ? sprintf( $format, $i ) : $i;
			$arr[] 	= JHTML::_('select.option', $fi, $tmpi );
		}

		return JHTML::_('select.genericlist', $arr, $tag_name, $tag_attribs, 'value', 'text', $selected );
	}


	function buildCategorySelect( $catid, $args ){
$cfg = & EventsConfig::getInstance();
$jev_component_name  = $cfg->get("com_componentname");
		$user =& JFactory::getUser();
		$db	=& JFactory::getDBO();
		global $catidList;

		$catsql = "SELECT id, name"
		. "\n FROM #__categories"
		. "\n WHERE section='$jev_component_name'"
		. "\n AND access<='".$user->gid."'"
		. "\n AND published='1'";

		if (strlen( $catidList) > 0 ) {
			$catsql .=" AND id IN ($catidList)";
		}
		$catsql .=" ORDER BY ordering";

		$categories[] = JHTML::_('select.option', '0', _CAL_LANG_EVENT_CHOOSE_CATEG, 'id', 'name' );
		$db->setQuery($catsql);

		$categories = array_merge( $categories, $db->loadObjectList() );
		$clist = JHTML::_('select.genericlist', $categories, 'catid', $args, 'id', 'name', $catid );

		echo $clist;
	}

	function buildWeekDaysCheck( $reccurweekdays, $args, $name="reccurweekdays" ){
		$day_name = array( '<span class="sunday">' . _CAL_LANG_SUNDAYSHORT . '</span>',
		_CAL_LANG_MONDAYSHORT,
		_CAL_LANG_TUESDAYSHORT,
		_CAL_LANG_WEDNESDAYSHORT,
		_CAL_LANG_THURSDAYSHORT,
		_CAL_LANG_FRIDAYSHORT,
		'<span class="saturday">' . _CAL_LANG_SATURDAYSHORT. '</span>');
		$tosend = '';

		if( $reccurweekdays == '' ){
			$split 		= array();
			$countsplit = 0;
		}else{
			$split 		= explode( '|', $reccurweekdays );
			$countsplit = count( $split );
		}

		for( $a=0; $a<7; $a++ ){
			$checked = '';
			for( $x = 0; $x < $countsplit; $x++ ){
				if( $split[$x] == $a ){
					$checked = ' checked="checked"';
				}
			}
			$tosend .= '<input type="checkbox" id="cb_wd' . $a . '" name="'.$name.'[]" value="'
			. $a . '" ' . $args . $checked . ' />&nbsp;' . "\n"
			. '<label for="cb_wd' . $a . '">'
			. $day_name[$a] . '</label>' . "\n"
			;
		}
		echo $tosend;
	}

	function buildWeeksCheck( $reccurweeks, $args , $name="reccurweeks"){
		$week_name = array( '',
		_CAL_LANG_REP_WEEK . ' 1 ',
		_CAL_LANG_REP_WEEK . ' 2 ',
		_CAL_LANG_REP_WEEK . ' 3 ',
		_CAL_LANG_REP_WEEK . ' 4 ',
		_CAL_LANG_REP_WEEK . ' 5 '
		);
		$tosend		= '';
		$checked	= '';

		if( $reccurweeks == '' ){
			$split		= array();
			$countsplit = 0;
		}else{
			$split		= explode( '|', $reccurweeks );
			$countsplit = count( $split );
		}

		for( $a=1; $a<6; $a++ ){
			$checked = '';
			if( $reccurweeks == '' ){
				$checked = ' checked="checked"';
			}

			for ($x = 0; $x < $countsplit; $x++) {
				if ($split[$x] == $a) {
					$checked = ' checked="checked"';
				}
			}

			$tosend .= '<input type="checkbox" id="cb_wn' . $a . '" name="'.$name.'[]" value="'
			. $a . '" ' . $args . $checked . ' />&nbsp;' . "\n"
			. '<label for="cb_wn' . $a . '">'
			. $week_name[$a] . '</label>' . "\n"
			;
		}
		echo $tosend;
	}

	function getUserMailtoLink( $agid, $userid ){

		$db	=& JFactory::getDBO();

		static $arr_userids;
		static $arr_agids;

		$cfg = & EventsConfig::getInstance();

		if (!$arr_userids) {
			$arr_userids = array();
		}
		if (!$arr_agids) {
			$arr_agids = array();
		}


		$agenda_viewmail = $cfg->get('com_mailview');

		if( $userid ){
			if (!isset($arr_userids[$userid])) {
				$querym = "SELECT username, email"
				. "\n FROM #__users"
				. "\n WHERE id='$userid'"
				;
				$db->setQuery($querym);
				$userdets = $db->loadObjectList();

				$userdet = $userdets[0];

				if( $userdet ){
					if( ( $userdet->email ) && ( $agenda_viewmail == '1' )){
						//$contactlink = '<a href="mailto:' . $userdet->email
						//. '" title="' . _CAL_LANG_EMAIL_TO_AUTHOR . '">'
						//. $userdet->username . '</a>';
						$contactlink = JHTML::_('email.cloak',$userdet->email, 1, $userdet->username, 0);
					}else{
						$contactlink = $userdet->username;
					}
				}
				$arr_userids[$userid] = $contactlink;
			}
			return $arr_userids[$userid];
		}else{
			if (!isset($arr_agids[$agid])) {
				$querym = "SELECT created_by_alias"
				. "\n FROM #__events"
				. "\n WHERE id='$agid'"
				;
				$db->setQuery($querym);
				$userdet = $db->loadResult();

				if( $userdet ){
					$contactlink = $userdet;
				}else{
					$contactlink = _CAL_LANG_ANONYME;
				}
				$arr_agids[$agid] = $contactlink;
			}
			return $arr_agids[$agid];
		}

		return '?';
	}

	/**
	 * returns name of the day longversion
	 * @param	daynb		int		# of day
	 * @param	colored		bool	color sunday	[ new mic, because inside tooltips a color forces an error! ]
	 **/
	function getLongDayName( $daynb, $colored = false ){

		if( $daynb == '0' && $colored === true){
			$dayname = '<span class="sunday">' . EventsHelper::getLongDayName($daynb) . '</span>';
		}
		else if( $daynb == '6' && $colored === true){
			$dayname = '<span class="saturday">' . EventsHelper::getLongDayName($daynb) . '</span>';
		}
		else {
			$dayname = EventsHelper::getLongDayName($daynb);
		}
		return $dayname;
	}

	function getColorBar( $event_id=null, $newcolor ){
		$db	=& JFactory::getDBO();

		$cfg = & EventsConfig::getInstance();

		if( $event_id != null ){
			$query = "SELECT color_bar"
			. "\n FROM #__events"
			. "\n WHERE id = '$event_id'"
			;
			$db->setQuery( $query );
			$rows = $db->loadResultList();

			$row = $rows[0];

			if( $newcolor ){
				if( $newcolor <> $row->color_bar ){
					$query = "UPDATE #__events"
					. "\n SET color_bar = '$newcolor'"
					. "\n WHERE id = '$event_id'"
					;
					$db->setQuery( $query );

					return $newcolor;
				}
			}else{
				return $row->color_bar;
			}
		}else{
			// dmcd May 20/04  check the new config parameter to see what the default
			// color should be
			switch( $cfg->get('com_defColor')){
				case 'none':
					return '';

				case 'category':
					// fetch the category color for this event?
					// Note this won't work for a new event since
					// the user can change the category on-the-fly
					// in the event entry form.  We need to dump a
					// javascript array of all the category colors
					// into the event form so the color can track the
					// chosen category.
					return '';

				case 'random':
				default:
					$event_id = rand( 1, 50 );
					// BAR COLOR GENERATION
					//$start_publish = mktime (0, 0, 0, date("m"),date("d"),date("Y"));

					//$colorgenerate = intval(($start_publish/$event_id));
					//$bg1color = substr($colorgenerate, 5, 1);
					//$bg2color = substr($colorgenerate, 3, 1);
					//$bg3color = substr($colorgenerate, 7, 1);
					$bg1color = rand( 0, 9 );
					$bg2color = rand( 0, 9 );
					$bg3color = rand( 0, 9 );
					$newcolorgen = '#' . $bg1color . 'F' . $bg2color . 'F' . $bg3color . 'F';

					return $newcolorgen;
			}
		}
	}

	/************** Date format ******************
	*       case "0":
	*            // Fr style : Monday 23 Juillet 2003
	*            // Us style : Monday, Juillet 23 2003
	*       case "1":
	*            // Fr style : 23 Juillet 2003
	*            // Us style : Juillet 23, 2003
	*       case "2":
	*    	 // Fr style : 23 Juillet
	*            // Us style : Juillet, 23
	*       case "3":
	*    	 // Fr style : Juillet 2003
	*            // Us style : Juillet 2003
	*       case "4":
	*            // Fr style : 23/07/2003
	*            // Us style : 07/23/2003
	*       case "5":
	*            // Fr style : 23/07
	*            // Us style : 07/23
	*       case "6":
	*            // Fr style : 07/2003
	*            // Us style : 07/2003
	********************************************/
	function getDateFormat( $year, $month, $day, $type ){
		if( empty( $year )){
			$year = 0;
		}

		if( empty( $month )){
			$month = 0;
		}

		if( empty( $day )){
			$day = 1;
		}

		static $format_type;
		if (!isset($format_type)) {
			$cfg = & EventsConfig::getInstance();
			$format_type	= $cfg->get('com_dateformat');
		}
		$datestp		= ( mktime( 0, 0, 0, $month, $day, $year ));

		switch( $type ){
			case '0':
				if( $format_type == 0 ){
					return strftime("%A, %d %B %Y",$datestp);
					// Fr style : Monday 03 Juillet 2003
				}elseif( $format_type == 1 ){
					return strftime("%A, %B %d %Y",$datestp);
					// Us style : Monday, July 03 2003
				}else{
					//return strftime("%A, %e. %B %Y",$datestp);
					// %e not supported by windows
					return sprintf(strftime("%A, %%s. %B %Y",$datestp), intval(strftime('%d', $datestp)));
					// De style : Montag, 3. Juli 2003
				}
				break;

			case '1':
				if( $format_type == 0 ){
					return strftime("%d %B %Y",$datestp);
					// Fr style : 23 Juillet 2003
				}elseif( $format_type == 1 ){
					return strftime("%B %d %Y",$datestp);
					// Us style : July 23, 2003
				}else{
					return strftime("%d. %B %Y",$datestp);
					// De style : 23. Juli 2003
				}
				break;

			case '2':
				if( $format_type == 0 ){
					return strftime("%d %B",$datestp);
					// Fr style : 23 Juillet
				}elseif( $format_type == 1 ){
					return strftime("%B %d",$datestp);
					// Us style : Juillet 23
				}else{
					return strftime("%d. %B",$datestp);
					// De style : 23. Juli
				}
				break;

			case '3':
				if( $format_type == 0 ){
					return strftime("%B %Y",$datestp);
					// Fr style : Juillet 2003
				}elseif( $format_type == 1 ){
					return strftime("%B %Y",$datestp);
					// Us style : Juillet 2003
				}else{
					return strftime("%B %Y",$datestp);
					// De style : Juli 2003
				}
				break;

			case '4':
				if( $format_type == 0 ){
					return strftime("%d/%B/%Y",$datestp);
					// Fr style : 23/07/2003
				}elseif( $format_type == 1){
					return strftime("%B/%d/%Y",$datestp);
					// Us style : 07/23/2003
				}else{
					return strftime("%d.%B.%Y",$datestp);
					// De style : 23.07.2003
				}
				break;

			case '5':
				if( $format_type == 0 ){
					return strftime("%d/%m",$datestp);
					// Fr style : 23/07
				}elseif( $format_type == 1 ){
					return strftime("%m/%d",$datestp);
					// Us style : 07/23
				}else{
					return strftime("%d.%m.",$datestp);
					// De style : 23.07.
				}
				break;

			case '6':
				if( $format_type == 0 ){
					return strftime("%m/%Y",$datestp);
					// Fr style : 07/2003
				}elseif( $format_type == 1 ){
					return strftime("%m/%Y",$datestp);
					// Us style : 07/2003
				}else{
					return strftime("%m/%Y",$datestp);
					// De style : 07/2003
				}
				break;

			case '7':
				if( $format_type == 0 ){
					return strftime("%A, %d",$datestp);
					// Fr style : Monday 23
				}elseif( $format_type == 1 ){
					return strftime("%A, %d",$datestp);
					// Us style : Monday, 23
				}else{
					return strftime("%A, %d.",$datestp);
					// De style : Montag, 23.
				}
				break;

			default:
				break;
		}
		return $newdate;
	}

	/**
	* Convert special characters to html entities
	* Required for edit fields containing html code
	*
	* @static
	* @param $html	string	html text
	* @return		string	html string
	*/
	function special ( $html='' ) {

		return htmlspecialchars( $html, ENT_QUOTES, 'UTF-8');
	}
}
?>
