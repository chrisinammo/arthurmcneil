<?php
/**
 * Events Component for Joomla 1.5.x
 *
 * @version     $Id: commonfunctions.php 972 2008-02-16 12:55:12Z geraint $
 * @package     Events
 * @copyright   Copyright (C) 2006-2007 JEvents Project Group
 * @licence     http://www.gnu.org/copyleft/gpl.html
 * @link        http://joomlacode.org/gf/project/jevents
 */

// functions common to component and modules
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

// Joomla 1.5
// tasker/controller
jimport('joomla.application.component.controller');

function & setupContentDispatcher(){
	$dispatcher	=& JDispatcher::getInstance();
	JPluginHelper::importPlugin('content');
	return $dispatcher;
}

function & setupJEventsDispatcher(){
	$dispatcher	=& JDispatcher::getInstance();
	JPluginHelper::importPlugin('events');
	return $dispatcher;
}

function getJEventsViewName(){

	static $jEventsView;

	$cfg = & EventsConfig::getInstance();
	$compname = $cfg->get("com_componentname","com_events");

	if (!isset($jEventsView)){
		// priority of view setting is url, cookie, config, 
		$jEventsView = $cfg->get('com_calViewName',"default");
		$jEventsView = JRequest::getString("jevents_view",$jEventsView,"cookie");
		$jEventsView = JRequest::getString("jEV",$jEventsView);
		// security check
		if (!in_array($jEventsView, getJEventsViewList() )){
			$jEventsView = "default";
		}
	}
	return $jEventsView ;
}

function getJEventsViewList(){

	static $jEventsViews;

	$cfg = & EventsConfig::getInstance();
	$compname = $cfg->get("com_componentname","com_events");

	if (!isset($jEventsViews)){
		$jEventsViews = array();
		$handler = opendir(JPATH_SITE . "/components/$compname/layouts/");
		while ($file = readdir($handler)) {
			if ($file != '.' && $file != '..' && $file != '.svn'&& $file != 'index.html')	$jEventsViews[] = $file;
		}
	}
	return $jEventsViews ;
}

/**
 * get all events_categories to use category color
 * @return  object
 */
function getCategoryData(){

	static $cats;
	if (!isset($cats)){
		$db	=& JFactory::getDBO();

		$sql = "SELECT c.*, e.color FROM #__events_categories AS e, #__categories as c WHERE c.id=e.id";
		$db->setQuery( $sql);
		$cats = $db->loadObjectList('id');
	}
	return $cats;
}

function setColor($row){

	$cfg = & EventsConfig::getInstance();
	
	static $catData;
	if (!isset($catData))   $catData = getCategoryData();

	if (is_object($row) && strtolower(get_class($row))!="stdclass"){
		if( $cfg->get('com_calForceCatColorEventForm') == '2' ){
			$color = ($row->catid() > 0 ) ? $catData[$row->catid()]->color : '#333333';
		}
		else $color = $row->useCatColor() ? ( $row->catid() > 0 ) ? $catData[$row->catid()]->color : '#333333' : $row->color_bar();

	}
	else {
		if( $cfg->get('com_calForceCatColorEventForm') == '2' ){
			$color = ($row->catid > 0 ) ? $catData[$row->catid]->color : '#333333';
		}
		else $color = $row->useCatColor ? ( $row->catid > 0 ) ? $catData[$row->catid]->color : '#333333' : $row->color_bar;

	}
	
	//$color = $row->useCatColor ? ( $row->catid > 0 ) ? $catData[$row->catid]->color : '#333333' : $row->color_bar;
	return $color;
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
	return $row->getRepeatArray( $startPeriod, $endPeriod, $periodEndSecond);
}

/**
 * Cloaks html link whith javascript
 *
 * @param string $url		The cloaking URL
 * @param string $text		The link text
 * @param array $attribs	additional attributes
 * @return string HTML
*/
function jEventsLinkCloaking($url='', $text='', $attribs=array()) {

	static $linkCloaking;

	if (!isset($linkCloaking)) {
		$cfg = & EventsConfig::getInstance();
		$linkCloaking = $cfg->get('com_linkcloaking', 0);
	}

	if (!is_array($attribs)) {
		$attribs = array();
	}
	if ($linkCloaking) {
		$cloakattribs = array('onclick'=>'"window.location.href=\''. JRoute::_($url).'\';return false;"');
		return jEventsDoLink("", $text, array_merge($cloakattribs, $attribs));
	} else {
		return jEventsDoLink( JRoute::_($url), "$text", $attribs);
	}
}

function jEventsDoLink($url="",$alt="alt",$attr=array()){
	if (strlen($url)==0) $url="javascript:void(0)";
	$link = "<a href='".$url."' ";
	if (count($attr)>0) {
		foreach ($attr as $key=>$val){
			$link .= " $key=$val";
		}
	}
	$link .= ">$alt</a>";
	return $link;
}


?>
