<?php
/**
 * Events Component for Joomla 1.5.x
 *
 * @version     $Id: datamodel.php 963 2008-02-16 10:59:26Z geraint $
 * @package     Events
 * @copyright   Copyright (C) 2006-2007 JEvents Project Group
 * @licence     http://www.gnu.org/copyleft/gpl.html
 * @link        http://joomlacode.org/gf/project/jevents
 */

// functions common to component and modules
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

class JEventsDataModel {
	var $myItemid = null;
	var $catidsOut = "";
	var $catids = null;
	var $catidList = null;

	var $gid = null;

	var $queryModel;

	function  JEventsDataModel($dbmodel=null){
		$cfg = & EventsConfig::getInstance();
		$jev_component_name  = $cfg->get("com_componentname");
		$user =& JFactory::getUser();
		$this->gid = intval( $user->gid);

		if (is_null($dbmodel)){
			$this->queryModel = new JEventsDBModel($this);
		}
		else {
			include_once(JPATH_ADMINISTRATOR."/components/$jev_component_name/lib/adminqueries.php");
			$this->queryModel = new $dbmodel($this);
		}
		$cfg = & EventsConfig::getInstance();
		$jev_component_name  = $cfg->get("com_componentname");
		$this->_cache =& jeventsCache::getCache( $jev_component_name );

	}

	function setupModuleCatids($modparams){
		$this->myItemid = findAppropriateMenuID ($this->catidsOut, $this->catids, $this->catidList, $modparams->toObject());
		return $this->myItemid;
	}

	function setupComponentCatids(){
		// if no catids from GET or POST default to the menu values
		// Note that module links must pass a non default value
		global $mainframe;
		$Itemid = EventsHelper::getItemid();
		$this->myItemid = $Itemid;
		$menu		= $mainframe->get( 'menu' );
		// Joomla 1.5
		if (!isset($menu) && class_exists("JMenu"))	{
			$menu2	=& JSite::getMenu();
			//$menu2	=& JMenu::getInstance();
			$menu    = $menu2->getActive();
			$params	=& $menu2->getParams($menu->id);
		}

		$catidsIn		= JRequest::getVar(	'catids', 		'NONE' ) ;
		$this->catids = array();
		if ($catidsIn == "NONE") {
			// Parameters
			$params		= new JParameter( $menu->params );
			$this->catidList	= "";

			for ($c=0; $c < 999; $c++) {
				$nextCID = "catid$c";
				//  stop looking for more catids when you reach the last one!
				if (!$nextCatId = $params->get( $nextCID, null)) {
					break;
				}
				if ( !in_array( $nextCatId, $this->catids )){
					$this->catids[]	= $nextCatId;
					$this->catidList	.= ( strlen( $this->catidList )>0 ? ',' : '' ) . $nextCatId;
				}
			}
			$this->catidsOut = str_replace( ',', '|', $this->catidList );
		}
		else {
			$this->catids = explode( '|', $catidsIn );
			// hardening!
			$this->catidList = EventsHelper::forceIntegerArray($this->catids,true);
			$this->catidsOut = str_replace(',', '|', $this->catidList);
		}

		// some functions e.g. JEventCal::viewDetailLink don't have access to a datamodel so set a global value
		// as a backup
		global $catidsOut;
		$catidsOut = $this->catidsOut;
	}

	/**
	 * Gets appropriate Itemid part of URL 
	 *
	 * @return string
	 */
	function getItemidLink($withAmp=true){
		if (!is_null($this->myItemid)){
			return ($withAmp?"&":"")."Itemid=".$this->myItemid;
		}
		else return "";
	}

	/**
	 * Gets appropriate category restriction part of URL 
	 * 
	 * @return string
	 */
	function getCatidsOutLink($withAmp=true){
		$ret = "";
		if ($this->catidsOut!=""){
			$ret .= ($withAmp?"&":"")."catids=".$this->catidsOut;
		}
		return $ret;
	}

	/**
	 * Gets calendar data for use in main calendar and module
	 *
	 * @param int $year
	 * @param int $month
	 * @param int $day
	 * @param boolean $short - use true for module which only requires knowledge of if dat has an event
	 * @return array - calendar data array
	 */
	function getCalendarData( $year, $month, $day , $short=false){
		global $mainframe;
$cfg = & EventsConfig::getInstance();
$jev_component_name  = $cfg->get("com_componentname");

		$data = array();
		$data['year']=$year;
		$data['month']=$month;

		$db	=& JFactory::getDBO();

		if (!isset($this->myItemid) || is_null($this->myItemid)) {
			$Itemid = EventsHelper::getItemid();
			$this->myItemid = $Itemid;
		}

		include_once(JPATH_ADMINISTRATOR."/components/$jev_component_name/lib/colorMap.php");

		$cfg = & EventsConfig::getInstance();

		$rows = $this->queryModel->listEventsByMonthNEW( $year, $month, 'reccurtype ASC,publish_up');
		$icalrows = $this->queryModel->listIcalEventsByMonth( $year, $month);

		if (strlen($this->catidsOut)>0) {
			$cat = "&catids=$this->catidsOut";
		} else {
			$cat="";
		}

		// handy for developement in case I comment out part of the above
		if (!isset($rows)) $rows = array();
		if (!isset($icalrows)) $icalrows = array();

		$rows = array_merge($icalrows,$rows);
		$rowcount = count( $rows );

		if( $month <= '9' & ereg( "(^[1-9]{1})", $month )) {
			$month = '0' . $month;
		}

		$fieldsetText = "";
		$yearNow = date("Y");
		$monthNow = date("m");
		$dayNow = intval(date("d"));
		if (!$short){
			if ($year==$yearNow && $month==$monthNow && $day==$dayNow){
				$fieldsetText = mosEventsHTML::getDateFormat( $year, $month, $day, 1 );
			}
			else $fieldsetText = mosEventsHTML::getDateFormat( $year, $month, "", 3 );
			$data["fieldsetText"]=$fieldsetText;
		}
		$startday = $cfg->get('com_starday');
		if(( !$startday ) || ( $startday > 1 )){
			$startday = 0;
		}
		$data['startday']=$startday;
		if (!$short){
			$data["daynames"]=array();
			for( $i = 0; $i < 7; $i++ ) {
				$data["daynames"][$i]=mosEventsHTML::getLongDayName(($i+$startday)%7, true );
			}
		}

		$data["dates"]=array();
		//Start days
		$start = (( date( 'w', mktime( 0, 0, 0, $month, 1, $year )) - $startday + 7 ) % 7 );
		$base = date( 't', mktime( 0, 0, 0, $month, 0, $year ));
		$dayCount=0;
		$priorMonth = $month-1;
		$priorYear = $year;
		if ($priorMonth<=0) {
			$priorMonth+=12;
			$priorYear-=1;
		}
		for( $a = $start; $a > 0; $a-- ){
			$d =  $base - $a + 1;

			$data["dates"][$dayCount]=array();
			$data["dates"][$dayCount]["monthType"]="prior";
			$data["dates"][$dayCount]["month"]=$priorMonth;
			$data["dates"][$dayCount]["year"]=$priorYear;
			$data["dates"][$dayCount]['countDisplay']=0;
			if( $d <= '9' & ereg( '(^[1-9]{1})', $d )) {
				$do = '0' . $d;
			} else {
				$do = $d;
			}
			$data["dates"][$dayCount]['d']=$d;
			$data["dates"][$dayCount]['d0']=$do;

			if ($short){
				$data["dates"][$dayCount]["events"]=false;
			}
			else {
				$data["dates"][$dayCount]["events"]=array();
			}

			$cellDate		= mktime (0, 0, 0, $priorMonth, $d, $priorYear);
			$data["dates"][$dayCount]['cellDate']=$cellDate;

			$data["dates"][$dayCount]["today"]=false;

			$link = JRoute::_( 'index.php?option=' . $jev_component_name . '&task=view_day&year='
			. $priorYear . '&month=' . $priorMonth . '&day=' . $do .$cat. '&Itemid=' . $this->myItemid );

			$data["dates"][$dayCount]["link"]=$link;
			$dayCount++;
		}
		sort($data["dates"]);

		//Current month
		$end = date( 't', mktime( 0, 0, 0,( $month + 1 ), 0, $year ));
		for( $d = 1; $d <= $end; $d++ ){
			$data["dates"][$dayCount]=array();
			// utility field used to keep track of events displayed in a day!
			$data["dates"][$dayCount]['countDisplay']=0;
			$data["dates"][$dayCount]["monthType"]="current";
			$data["dates"][$dayCount]["month"]=$month;
			$data["dates"][$dayCount]["year"]=$year;

			if ($short){
				$data["dates"][$dayCount]["events"]=false;
			}
			else {
				$data["dates"][$dayCount]["events"]=array();
			}
			$now_adjusted = time() + ( $mainframe->getCfg('offset') * 60 * 60 );
			if( $month == strftime( '%m', $now_adjusted)
			&& $year == strftime( '%Y', $now_adjusted)
			&& $d == strftime( '%d', $now_adjusted)) {
				$data["dates"][$dayCount]["today"]=true;
			}else{
				$data["dates"][$dayCount]["today"]=false;
			}

			if( $d <= '9' & ereg( '(^[1-9]{1})', $d )) {
				$do = '0' . $d;
			} else {
				$do = $d;
			}

			$data["dates"][$dayCount]['d']=$d;
			$data["dates"][$dayCount]['d0']=$do;

			$link = JRoute::_( 'index.php?option=' . $jev_component_name . '&task=view_day&year='
			. $year . '&month=' . $month . '&day=' . $do .$cat. '&Itemid=' . $this->myItemid );
			$data["dates"][$dayCount]["link"]=$link;

			$cellDate		= mktime (0, 0, 0, $month, $d, $year);
			$data["dates"][$dayCount]['cellDate']=$cellDate;

			if( $rowcount > 0 ){
				foreach ($rows as $row) {

					if ($row->checkRepeatMonth($cellDate,$year,$month))  {

						if ($short){
							$data["dates"][$dayCount]['events']=true;
							break;
						}
						else {
							$i=count($data["dates"][$dayCount]['events']);
							$data["dates"][$dayCount]['events'][$i] = $row;
						}
					}
				}
			}

			$dayCount++;
		}

		$days 	= ( 7 - date( 'w', mktime( 0, 0, 0, $month + 1, 1, $year )) + $startday ) %7;
		$d		= 1;

		$followMonth = $month-1;
		$followYear = $year;
		if ($followMonth>12) {
			$followMonth-=12;
			$followYear+=1;
		}
		$data["followingMonth"]=array();
		for( $d = 1; $d <= $days; $d++ ) {

			$data["dates"][$dayCount]=array();
			$data["dates"][$dayCount]["monthType"]="following";
			$data["dates"][$dayCount]["month"]=$followMonth;
			$data["dates"][$dayCount]["year"]=$followYear;
			$data["dates"][$dayCount]['countDisplay']=0;
			if( $d <= '9' & ereg( '(^[1-9]{1})', $d )) {
				$do = '0' . $d;
			} else {
				$do = $d;
			}

			$data["dates"][$dayCount]['d']=$d;
			$data["dates"][$dayCount]['d0']=$do;

			if ($short){
				$data["dates"][$dayCount]["events"]=false;
			}
			else {
				$data["dates"][$dayCount]["events"]=array();
			}

			$cellDate		= mktime (0, 0, 0, $followYear, $d, $followMonth);
			$data["dates"][$dayCount]['cellDate']=$cellDate;

			$data["dates"][$dayCount]["today"]=false;

			$link = JRoute::_( 'index.php?option=' . $jev_component_name . '&task=view_day&year='
			. $followYear . '&month=' . $followMonth . '&day=' . $do .$cat. '&Itemid=' . $this->myItemid );

			$data["dates"][$dayCount]["link"]=$link;
			$dayCount++;
		}

		// Week data and links
		$data["weeks"]=array();
		for ($w=0;$w<6 && $w*7<count($data["dates"]);$w++){
			$date = $data["dates"][$w*7]['cellDate'];
			$day = $data["dates"][$w*7]["d"];
			$month = $data["dates"][$w*7]["month"];
			$year = $data["dates"][$w*7]["year"];
			$week = intval(strftime("%W",$date));
			$link = JRoute::_( 'index.php?option=' . $jev_component_name . '&task=view_week&year='
			. $year . '&month=' . $month . '&day=' . $day .$cat. '&Itemid=' . $this->myItemid );
			$data["weeks"][$week]=$link;
		}

		return $data;
	}

	/**
	 * Gets calendar data for use in main calendar and module
	 *
	 * @param int $year
	 * @param int $month
	 * @param int $day
	 * @param boolean $short - use true for module which only requires knowledge of if dat has an event
	 * @return array - calendar data array
	 */
	function getCalendarDataOLD( $year, $month, $day , $short=false){

		global $mainframe;
$cfg = & EventsConfig::getInstance();
$jev_component_name  = $cfg->get("com_componentname");
		$data = array();
		$data['year']=$year;
		$data['month']=$month;

		$db	=& JFactory::getDBO();

		if (!isset($this->myItemid) || is_null($this->myItemid)) {
			$Itemid = EventsHelper::getItemid();
			$this->myItemid = $Itemid;
		}

		include_once(JPATH_ADMINISTRATOR."/components/$jev_component_name/lib/colorMap.php");

		$cfg = & EventsConfig::getInstance();

		$rows = $this->queryModel->listEventsByMonthNEW( $year, $month, 'reccurtype ASC,publish_up');
		$icalrows = $this->queryModel->listIcalEventsByMonth( $year, $month);

		if (strlen($this->catidsOut)>0) {
			$cat = "&catids=$this->catidsOut";
		} else {
			$cat="";
		}

		// handy for developement in case I comment out part of the above
		if (!isset($rows)) $rows = array();
		if (!isset($icalrows)) $icalrows = array();

		$rows = array_merge($icalrows,$rows);
		$rowcount = count( $rows );

		if( $month <= '9' & ereg( "(^[1-9]{1})", $month )) {
			$month = '0' . $month;
		}

		$fieldsetText = "";
		$yearNow = date("Y");
		$monthNow = date("m");
		$dayNow = intval(date("d"));
		if (!$short){
			if ($year==$yearNow && $month==$monthNow && $day==$dayNow){
				$fieldsetText = mosEventsHTML::getDateFormat( $year, $month, $day, 1 );
			}
			else $fieldsetText = mosEventsHTML::getDateFormat( $year, $month, "", 3 );
			$data["fieldsetText"]=$fieldsetText;
		}
		$startday = $cfg->get('com_starday');
		if(( !$startday ) || ( $startday > 1 )){
			$startday = 0;
		}
		$data['startday']=$startday;
		if (!$short){
			$data["daynames"]=array();
			for( $i = 0; $i < 7; $i++ ) {
				$data["daynames"][$i]=mosEventsHTML::getLongDayName(($i+$startday)%7, true );
			}
		}
		$data["priorMonth"]=array();
		//Start days
		$start = (( date( 'w', mktime( 0, 0, 0, $month, 1, $year )) - $startday + 7 ) % 7 );
		$base = date( 't', mktime( 0, 0, 0, $month, 0, $year ));
		for( $a = $start; $a > 0; $a-- ){
			$d =  $base - $a + 1;
			$data["priorMonth"][$a-1]=$d;
		}
		sort($data["priorMonth"]);
		//Current month
		$data["currentMonth"]=array();
		$end = date( 't', mktime( 0, 0, 0,( $month + 1 ), 0, $year ));
		for( $d = 1; $d <= $end; $d++ ){
			$data["currentMonth"][$d]=array();
			// utility field used to keep track of events displayed in a day!
			$data["currentMonth"][$d]['countDisplay']=0;

			if ($short){
				$data["currentMonth"][$d]["events"]=false;
			}
			else {
				$data["currentMonth"][$d]["events"]=array();
			}
			$now_adjusted = time() + ( $mainframe->getCfg('offset') * 60 * 60 );
			if( $month == strftime( '%m', $now_adjusted)
			&& $year == strftime( '%Y', $now_adjusted)
			&& $d == strftime( '%d', $now_adjusted)) {
				$data["currentMonth"][$d]["bg"] = 'class="cal_td_today"';
			}else{
				$data["currentMonth"][$d]["bg"] = 'class="cal_td_daysnoevents"';
			}

			if( $d <= '9' & ereg( '(^[1-9]{1})', $d )) {
				$do = '0' . $d;
			} else {
				$do = $d;
			}

			$data["currentMonth"][$d]['d']=$d;
			$data["currentMonth"][$d]['d0']=$do;

			$link = JRoute::_( 'index.php?option=' . $jev_component_name . '&task=view_day&year='
			. $year . '&month=' . $month . '&day=' . $do .$cat. '&Itemid=' . $this->myItemid );
			$data["currentMonth"][$d]["link"]=$link;

			$cellDate		= mktime (0, 0, 0, $month, $d, $year);
			$data["currentMonth"][$d]['cellDate']=$cellDate;

			if( $rowcount > 0 ){
				foreach ($rows as $row) {

					if ($row->checkRepeatMonth($cellDate,$year,$month))  {

						if ($short){
							$data["currentMonth"][$d]["events"]=true;
							break;
						}
						else {
							$i=count($data["currentMonth"][$d]["events"]);
							$data["currentMonth"][$d]["events"][$i] = $row;
						}

					}
				}
			}

			// check if last day of displayed week that has more days left in month

			if((( date('w',$cellDate) - $startday + 1 ) % 7 ) == 0	&& $d!=date('t',$cellDate)){
				$data["currentMonth"][$d]["endCurrentMonthWeek"]=true;
			}
			else $data["currentMonth"][$d]["endCurrentMonthWeek"]=false;




		}

		$days 	= ( 7 - date( 'w', mktime( 0, 0, 0, $month + 1, 1, $year )) + $startday ) %7;
		$d		= 1;

		$data["followingMonth"]=array();
		for( $d = 1; $d <= $days; $d++ ) {
			$data["followingMonth"][$d]=$d;
		}

		// Week data and links
		$data["weeks"]=array();
		for ($w=0;$w<6;$w++){
			$week = intval(strftime("%W",mktime(0,0,0,$month,1+7*$w,$year)));
			$link = JRoute::_( 'index.php?option=' . $jev_component_name . '&task=view_week&year='
			. $year . '&month=' . $month . '&day=' . (1+7*$w) .$cat. '&Itemid=' . $this->myItemid );
			$data["weeks"][$week]=$link;
		}

		return $data;
	}

	function getYearData($year, $limit, $limitstart )
	{
		global $mainframe;
$cfg = & EventsConfig::getInstance();
$jev_component_name  = $cfg->get("com_componentname");
		$user =& JFactory::getUser();
		$gid = intval( $user->gid );

		$data = array();
		$data ["year"]=$year;

		$db	=& JFactory::getDBO();

		$cfg = & EventsConfig::getInstance();

		include_once(JPATH_ADMINISTRATOR."/components/$jev_component_name/lib/colorMap.php");

		// Note limit = -1 means ignore the limit
		$data ["limit"] = $limit!=0 ? $limit : $cfg->get('com_calEventListRowsPpg');

		if ($data ["limit"]>0){
			$query = "SELECT *"
			. "\n FROM #__categories as b, #__events"
			. "\n WHERE #__events.catid = b.id"
			. "\n AND b.access <= $gid"
			. "\n AND #__events.access <= $gid"
			. "\n AND publish_up"
			. "\n LIKE '$year%'"
			. "\n AND (publish_down >= '$year%' OR publish_down = '0000-00-00 00:00:00')"
			. "\n AND #__events.state = '1'"
			;
			$db->setQuery( $query );
			$counter = $db->loadObjectList();

			$data["total"] = count( $counter );

			if( $data["total"] <= $data ["limit"] ) {
				$limitstart = 0;
			}
			$data ["limitstart"]=$limitstart;
		}
		else {
			$data["total"]=0;
			$data ["limitstart"]=0;
		}

		$data["months"]=array();
		if ($cfg->get('com_showrepeats') == '1') {
			for($month = 1; $month <= 12; $month++) {
				$data["months"][$month] = array();
				//$month = str_pad($month, 2, '0', STR_PAD_LEFT);
				$data["months"][$month]["rows"] = array();
				$rows = $this->queryModel->listEventsByMonthNEW($year, $month, 'publish_up,catid');
				$icalrows = $this->queryModel->listIcalEventsByMonth( $year, $month);

				$rows = array_merge($icalrows,$rows);
				$num_events = count( $rows );

				for ($r = 0; $r < $num_events ; $r++) {
					$row =& $rows[$r];

					// skip repeat type year and not matching month
					if ($row->reccurtype() == 5 && $month != $row->mup()) continue;

					$data["months"][$month]["rows"][$r] = $row;
				}
			}
		} else {

			$rows = $this->queryModel->listEventsByYearNEW( $year, $data ["limitstart"], $data ["limit"] );
			$icalrows = $this->queryModel->listIcalEventsByYear( $year);

			$rows = array_merge($icalrows,$rows);
			$num_events = count( $rows );

			for($month = 1; $month <= 12; $month++) {
				$data["months"][$month] = array();
				$data["months"][$month]["rows"] = array();
				for( $r = 0; $r < $num_events; $r++ ) {
					$row =& $rows[$r];
					if ($month == $row->mup()){
						$count = count($data["months"][$month]["rows"]);
						$data["months"][$month]["rows"][$count] = $row;
					}
				}
			}
		}

		//global $mainframe;
		//include_once(JPATH_BASE."/components/$jev_component_name/libraries/iCalImport.php");
		//iCalHelper::getHolidayDataForYear($data, "USHolidays.ics");

		return $data;
	}

	/**
	 * gets structured week data
	 *
	 * @param int $year
	 * @param int $month
	 * @param int $day
	 * @param boolean $detailedDay when true gives hour by hour data for the day $day
	 * @return unknown
	 */
	function getWeekData($year, $month, $day, $detailedDay=false) {

		global $mainframe;
$cfg = & EventsConfig::getInstance();
$jev_component_name  = $cfg->get("com_componentname");
		$Itemid = EventsHelper::getItemid();
		$db	=& JFactory::getDBO();

		$cat = "";
		if ($this->catidsOut != 0){
			$cat = '&catids='.$this->catidsOut;
		}

		$cfg = & EventsConfig::getInstance();

		include_once(JPATH_ADMINISTRATOR."/components/$jev_component_name/lib/colorMap.php");

		$data = array();
		$indate = mktime( 0, 0, 0, $month, $day, $year) ;
		$startday 	= $cfg->get('com_starday', 0);
		$numday		= (( date( 'w', $indate) - $startday + 7) %7 );

		$week_start = mktime( 0, 0, 0, $month, ( $day - $numday ), $year );
		$week_end = mktime( 0, 0, 0, $month, ( $day - $numday )+6, $year ); // + 6 for inclusinve week

		$rows = $this->queryModel->listEventsByWeekNEW(strftime("%Y-%m-%d",$week_start),strftime("%Y-%m-%d",$week_end));

		$icalrows = $this->queryModel->listIcalEventsByWeek( $week_start, $week_end);

		$rows = array_merge($icalrows,$rows);
		$rowcount = count( $rows );

		$data['startdate']	= mosEventsHTML::getDateFormat( strftime("%Y",$week_start), strftime("%m",$week_start), strftime("%d",$week_start), 1 );
		$data['enddate']	= mosEventsHTML::getDateFormat( strftime("%Y",$week_end), strftime("%m",$week_end), strftime("%d",$week_end), 1 );

		$data['days'] = array();

		for( $d = 0; $d < 7; $d++ ){
			$data['days'][$d] = array();
			$data['days'][$d]['rows'] = array();

			$this_currentdate = mktime( 0, 0, 0, $month, ( $day - $numday + $d ), $year );

			$data['days'][$d]['week_day'] = strftime("%d",$this_currentdate);
			$data['days'][$d]['week_month'] = strftime("%m",$this_currentdate);
			$data['days'][$d]['week_year'] = strftime("%Y",$this_currentdate);

			// This is really view specific - remove it later
			$data['days'][$d]['link']= JRoute::_( 'index.php?option='.$jev_component_name.'&task=view_day&year='.$data['days'][$d]['week_year'].'&month='.$data['days'][$d]['week_month'].'&day='.$data['days'][$d]['week_day'].'&Itemid='.$Itemid . $cat);

			$now_adjusted = time() + ( $mainframe->getCfg('offset') * 60 * 60 );
			if( strftime('%Y-%m-%d',$this_currentdate) == strftime('%Y-%m-%d', $now_adjusted ))
			{
				$data['days'][$d]['today']=true;
				$data['days']['today']=$d;
			}
			else
			{
				$data['days'][$d]['today']=false;
			}

			if ($detailedDay && ($this_currentdate==$indate)){
				$this->_populateHourData($data, $rows, $indate);
			}

			$num_events		= count( $rows );
			$countprint		= 0;

			for( $r = 0; $r < $num_events; $r++ ){
				$row = $rows[$r];
				if ($row->checkRepeatWeek($this_currentdate,$week_start,$week_end))  {

					$count = count($data['days'][$d]['rows']);
					$data['days'][$d]['rows'][$count] = $row;
				}
			}
		}

		return $data;
	}

	function _populateHourData(&$data, $rows, $target_date){
		$num_events			= count( $rows );

		$data['hours']=array();
		$data['hours']['timeless']=array();
		$data['hours']['timeless']['events']=array();

		// Timeless events
		for( $r = 0; $r < $num_events; $r++ ){
			$row =& $rows[$r];
			if ($row->checkRepeatDay($target_date))  {

				if ($row->alldayevent() || ($row->hup()==$row->hdn() && $row->minup()==$row->mindn() && $row->sup()==$row->sdn())){
					$count = count($data['hours']['timeless']['events']);
					$data['hours']['timeless']['events'][$count]=$row;
				}
			}
		}

		for ($h=0;$h<24;$h++){
			$data['hours'][$h]=array();
			$data['hours'][$h]['hour_start'] = $target_date+($h*3600);
			$data['hours'][$h]['hour_end'] = $target_date+59+(59*60)+($h*3600);
			$data['hours'][$h]['events'] = array();

			for( $r = 0; $r < $num_events; $r++ ){
				$row =& $rows[$r];
				if ($row->checkRepeatDay($target_date))  {
					if ($row->alldayevent() || ($row->hup()==$row->hdn() && $row->minup()==$row->mindn() && $row->sup()==$row->sdn())){
						// Ignore timeless events
					}
					else if ($row->hup()==$h && $row->minup()<=59 && $row->sup()<=59){

						$count = count($data['hours'][$h]['events']);
						$data['hours'][$h]['events'][$count]=$row;
					}

				}
			}
		}

	}

	function getDayData($year, $month, $day) {
		global $mainframe;
$cfg = & EventsConfig::getInstance();
$jev_component_name  = $cfg->get("com_componentname");
		$cfg = & EventsConfig::getInstance();

		include_once(JPATH_ADMINISTRATOR."/components/$jev_component_name/lib/colorMap.php");

		$data = array();

		$target_date = mktime(0,0,0,$month,$day,$year);
		$rows	= $this->queryModel->listEventsByDateNEW( strftime("%Y-%m-%d",$target_date ));
		$icalrows = $this->queryModel->listIcalEventsByDay($target_date);

		$rows = array_merge($icalrows,$rows);

		$this->_populateHourData($data, $rows, $target_date);

		return $data;
	}

	function getEventData( $agid, $jevtype, $year, $month, $day ) {
		$data = array();

		global  $mainframe;
$cfg = & EventsConfig::getInstance();
$jev_component_name  = $cfg->get("com_componentname");
		$pop = intval(JRequest::getVar( 'pop', 0 ));
		$Itemid = EventsHelper::getItemid();
		$db	=& JFactory::getDBO();

		$cfg = & EventsConfig::getInstance();

		$row = $this->queryModel->listEventsById ($agid, 1, $jevtype);  // include unpublished events for publishers and above

		$num_row = count($row);

		if( $num_row ){

			// process the new plugins
			$dispatcher	=& JDispatcher::getInstance();
			JPluginHelper::importPlugin('jevents');
			$dispatcher->trigger('onGetEventData', array (& $row));

			$params =& new JParameter(null);
			$row->contactlink = mosEventsHTML::getUserMailtoLink( $row->id(), $row->created_by() );

			$event_up = new mosEventDate( $row->publish_up() );
			$row->start_date = mosEventsHTML::getDateFormat( $event_up->year, $event_up->month, $event_up->day, 0 );
			$row->start_time = ( $cfg->get('com_calUseStdTime')== '1' ) ? $event_up->get12hrTime() : $event_up->get24hrTime();


			$event_down = new mosEventDate( $row->publish_down() );
			$row->stop_date = mosEventsHTML::getDateFormat( $event_down->year, $event_down->month, $event_down->day, 0 );
			$row->stop_time = ( $cfg->get('com_calUseStdTime') == '1' ) ? $event_down->get12hrTime() : $event_down->get24hrTime();

			// jul 8th/04  dmcd - kludge for overnite events, advance the displayed stop_date by 1 day
			// when an overniter is detected
			if( $row->stop_time < $row->start_time )
			$event_down->addDays(1);

			// *******************
			// ** This cloaking should be done by mambot/Joomla function
			// *******************

			// Parse http and  wrap in <a> tag
			// trigger content plugin

			$pattern = '[a-zA-Z0-9&?_.=%\-]';

			// Adresse
			$row->location(preg_replace('#(http://)('.$pattern.'*)#i', '<a href="\\1\\2">\\1\\2</a>', $row->location()));
			$tmprow = new stdClass();
			$tmprow->text = $row->location();
			$dispatcher =& setupContentDispatcher();
			$dispatcher->trigger( 'onPrepareContent', array( &$tmprow, &$params, 0 ));
			$row->location($tmprow->text);

			//Contact
			$row->contact_info(preg_replace('#(http://)('.$pattern.'*)#i', '<a href="\\1\\2">\\1\\2</a>', $row->contact_info()));
			$tmprow = new stdClass();
			$tmprow->text = $row->contact_info();
			$dispatcher =& setupContentDispatcher();
			$dispatcher->trigger( 'onPrepareContent', array( &$tmprow, &$params, 0 ));
			$row->contact_info($tmprow->text);

			//Extra
			$row->extra_info(preg_replace('#(http://)('.$pattern.'*)#i', '<a href="\\1\\2">\\1\\2</a>', $row->extra_info()));
			$tmprow = new stdClass();
			$tmprow->text = $row->extra_info();
			$dispatcher =& setupContentDispatcher();
			$dispatcher->trigger( 'onPrepareContent', array( &$tmprow, &$params, 0 ));
			$row->extra_info($tmprow->text);

			$mask = $mainframe->getCfg( 'hideAuthor' ) ? MASK_HIDEAUTHOR : 0;
			$mask |= $mainframe->getCfg( 'hideCreateDate' ) ? MASK_HIDECREATEDATE : 0;
			$mask |= $mainframe->getCfg( 'hideModifyDate' ) ? MASK_HIDEMODIFYDATE : 0;

			$mask |= $mainframe->getCfg( 'hidePdf' ) ? MASK_HIDEPDF : 0;
			$mask |= $mainframe->getCfg( 'hidePrint' ) ? MASK_HIDEPRINT : 0;
			$mask |= $mainframe->getCfg( 'hideEmail' ) ? MASK_HIDEEMAIL : 0;

			//$mask |= $mainframe->getCfg( 'vote' ) ? MASK_VOTES : 0;
			$mask |= $mainframe->getCfg( 'vote' ) ? (MASK_VOTES|MASK_VOTEFORM) : 0;
			$mask |= $pop ? MASK_POPUP | MASK_IMAGES | MASK_BACKTOLIST : 0;

			// Do main mambot processing here
			// process bots
			//$row->text      = $row->content;
			$params->set("image",1);
			$row->text = $row->content();
			$dispatcher =& setupContentDispatcher();
			$dispatcher->trigger( 'onPrepareContent', array( &$row, &$params, 0 ));
			$row->content( $row->text );

			$data['row']=$row;
			$data['mask']=$mask;

			// Should this happen here?
			$query = "UPDATE #__events"
			. "\n SET hits=(hits+1)"
			. "\n WHERE id='".$row->id()."'"
			;
			$db->setQuery( $query );
			if( !$db->query() ) {
				echo "<script> alert('".$db->getErrorMsg()."'); window.history.go(-1); </script>\n";
				exit();
			}
			return $data;

		}
		else return null;
	}

	function accessibleCategoryList($gid=null, $catids=null, $catidList=null){
		return $this->queryModel->accessibleCategoryList($gid, $catids, $catidList);
	}

	function getCatData( $catid, $limit, $limitstart){
		$data = array();

		global   $mainframe;
$cfg = & EventsConfig::getInstance();
$jev_component_name  = $cfg->get("com_componentname");
		$user =& JFactory::getUser();
		$gid = intval( $user->gid );
		$Itemid = EventsHelper::getItemid();
		$db	=& JFactory::getDBO();
		include_once(JPATH_ADMINISTRATOR."/components/$jev_component_name/lib/colorMap.php");

		$cfg = & EventsConfig::getInstance();

		if( !$catid ){
			// no category selected
			$query = "SELECT *"
			. "\n FROM #__events"
			. "\n WHERE #__events.catid IN(".$this->accessibleCategoryList().")"
			. "\n AND #__events.access <= $gid"
			. "\n AND #__events.state = '1'"
			;
		}else {
			// category selected
			$query = "SELECT *"
			. "\n FROM #__events"
			. "\n WHERE #__events.catid IN(".$this->accessibleCategoryList().")"
			. "\n AND #__events.catid = '$catid'"
			. "\n AND #__events.access <= $gid"
			. "\n AND #__events.state = '1'"
			;
		}

		$db->setQuery( $query );
		$counter	= $db->loadObjectList();

		$data ['total'] = count( $counter );
		$limit = $limit ? $limit : $cfg->get('com_calEventListRowsPpg');

		if ( $data ['total']  <= $limit ) {
			$limitstart = 0;
		}
		$data['limit']=$limit;
		$data['limitstart']=$limitstart;

		$rows 		= $this->queryModel->listEventsByCat( $catid, $limitstart, $limit );

		$showRepeats = false;
		$icalrows = $this->queryModel->listIcalEventsByCat( $catid,$showRepeats );

		$rows = array_merge($icalrows,$rows);
		$num_events = count( $rows );

		if( $num_events > 0 ){
			$catname = $rows[0]->getCategoryName();
		}
		else if( $catid == 0 ) {
			$catname = _CAL_LANG_EVENT_CHOOSE_CATEG;
		}
		else {
			$catname = _CAL_LANG_EVENT_CHOOSE_CATEG;
		}
		$data['catname']=$catname;
		$data['catid']=$catid;


		if( $num_events > 0 ){
			for( $r = 0; $r < $num_events; $r++ ){
				$row =& $rows[$r];

				$row->catname($catname); // for completeness of dataset
			}
		}
		$data['rows']=$rows;

		return $data;
	}

	function getKeywordData($keyword, $limit, $limitstart, $useRegX=false)
	{
		$data = array();

		global  $mainframe;
$cfg = & EventsConfig::getInstance();
$jev_component_name  = $cfg->get("com_componentname");
		$user =& JFactory::getUser();
		$gid = intval( $user->gid );
		$Itemid = EventsHelper::getItemid();
		$db	=& JFactory::getDBO();

		$cfg = & EventsConfig::getInstance();

		include_once(JPATH_ADMINISTRATOR."/components/$jev_component_name/lib/colorMap.php");

		$keyword		= preg_replace( "/[[:space:]]+/", ' +', $keyword );
		$keyword		= trim( $keyword );
		$keyword		= preg_replace( "/\++/", '+', $keyword );
		$keywordcheck	= preg_replace( "/ |\+/", '', $keyword );
		$searchisValid	= false; // new [mic]
		$total			= 0;

		if( empty( $keyword ) || strlen( $keywordcheck ) < 3 || $keyword == '%%' || $keywordcheck == '' ) {
			$keyword 	= _CAL_LANG_KEYWORD_NOT_VALID;
			$num_events = 0;
		} else {
			$searchisValid = true; // new mic

			$query = "SELECT #__events.*"
			. "\n FROM #__categories AS b, #__events"
			. "\n WHERE #__events.catid = b.id"
			. "\n AND b.access <= $gid"
			. "\n AND #__events.access <= $gid"
			. "\n AND\n"
			;
			$query .= $useRegX ? "(#__events.title RLIKE '$keyword' OR #__events.content RLIKE '$keyword')\n" :
			"MATCH (#__events.title, #__events.content) AGAINST ('$keyword' IN BOOLEAN MODE)\n";
			$query .= "AND #__events.state = '1'";

			$db->setQuery( $query );
			$counter	= $db->loadObjectList();

			$data['total'] = count( $counter );

			// MLr: discuss replacing _CAL_CONF_EVENT_LIST_ROWS_PPG with $mainframe->getCfg('list_limit')
			$limit = $limit ? $limit : $cfg->get('com_calEventListRowsPpg');

			if ( $data['total'] <= $limit ) {
				$limitstart = 0;
			}
			$data['limit']=$limit;
			$data['limitstart']=$limitstart;

			$rows 		= $this->queryModel->listEventsByKeyword( $keyword, 'publish_up,catid', $limit, $limitstart, $useRegX );
			$num_events = count( $rows );
			$data['num_events']=$num_events;
		}

		$chdate	= '';
		$chcat	= '';

		if( $num_events > 0 ){
			for( $r = 0; $r < $num_events; $r++ ){
				$row =& $rows[$r];

				$row->catname		= $row->getCategoryName( );
				$row->contactlink	= mosEventsHTML::getUserMailtoLink( $row->id(), $row->created_by() );
				$row->bgcolor		= setColor($row);
				$row->fgcolor		= mapColor($row->bgcolor);

				$now_adjusted = time() + ( $mainframe->getCfg('offset') * 60 * 60 );
				if( $row->mup() == strftime( '%m', $now_adjusted)	&&
				$row->yup() == strftime( '%Y', $now_adjusted )&&
				$row->dup() == strftime( '%d', $now_adjusted))
				{
					$row->today=true;
				}
				else
				{
					$row->today=false;
				}
			}
		}

		$data['rows']=$rows;

		return $data;
	}

	function getDataForAdmin( $creator_id, $limit, $limitstart ){

		$data= array();
$cfg = & EventsConfig::getInstance();
$jev_component_name  = $cfg->get("com_componentname");
		$is_event_editor = EventsHelper::isEventEditor();
		$user =& JFactory::getUser();
		$gid = intval( $user->gid );
		$Itemid = EventsHelper::getItemid();
		$user =& JFactory::getUser();

		$db	=& JFactory::getDBO();
		global $mainframe;

		$cfg = & EventsConfig::getInstance();

		include_once(JPATH_ADMINISTRATOR."/components/$jev_component_name/lib/colorMap.php");

		$where = '';
		if( $creator_id <> 'ADMIN' ){
			$where = "AND created_by = '$creator_id'";
		}

		$frontendPublish = intval($cfg->get('com_frontendPublish', 0)) > 0;

		$access =& EventsHelper::getJEV_Access();
		if( $access->canPublish() && $frontendPublish ) {
			$sql = "SELECT count(id) FROM #__events"
			. "\n WHERE #__events.catid IN(".$this->accessibleCategoryList().")"
			. "\n AND #__events.access <= $gid";
		} else {
			$sql = "SELECT count(id) FROM #__events"
			. "\n WHERE #__events.catid IN(".$this->accessibleCategoryList().")"
			. "\n AND #__events.access <= $gid $where"
			. "\n AND #__events.state='1'";
		}

		$db->setQuery( $sql );
		$total = $db->loadResult();

		$data['total']=$total;

		$limit = $limit ? $limit : $cfg->get('com_calEventListRowsPpg');

		if ( $total <= $limit ) {
			$limitstart = 0;
		}
		$data['limit']=$limit;
		$data['limitstart']=$limitstart;

		$rows		= $this->queryModel->listEventsByCreator ($creator_id, $limitstart, $limit);
		// Note that these are the vevents not the repeats
		$icalrows = $this->queryModel->listIcalEventsByCreator ($creator_id, $limitstart, $limit);
		$rows = array_merge($rows,$icalrows);

		$adminView = true;
		$num_events = count( $rows );

		if( $num_events > 0 ){
			for( $r = 0; $r < $num_events; $r++ ) {
				$row =& $rows[$r];

				$row->catname($row->getCategoryName());
				$row->contactlink( mosEventsHTML::getUserMailtoLink( $row->id(), $row->created_by()));
				$row->bgcolor		= setColor($row);
				$row->fgcolor		= mapColor($row->bgcolor);

				if( $is_event_editor ){
					$link_day	= $row->dup();
					$link_month = $row->mup();
					$link_year	= $row->yup();

					$row->deletelink(JRoute::_( 'index.php?option=' . $jev_component_name . '&task='.$row->deleteTask($adminView).'&agid='
					. $row->id() . '&year=' . $link_year . '&month=' . $link_month . '&day=' . $link_day
					. '&Itemid=' . $Itemid ));


					$row->modifylink(JRoute::_( 'index.php?option=' . $jev_component_name . '&task='.$row->editTask($adminView).'&agid='
					. $row->id() . '&year=' . $link_year . '&month=' . $link_month . '&day=' . $link_day
					. '&Itemid=' . $Itemid ));
				}
				else {
					$row->deletelink("");
					$row->modifylink("");
				}


			}
		}

		$data['rows']=$rows;
		return $data;
	}


	function getAdjacentMonth($data, $direction=1)
	{
		$cfg = & EventsConfig::getInstance();
		$option = $cfg->get("com_componentname");
		$monthResult = array();
		$d1 = mktime(0,0,0,intval($data['month'])+$direction,1,$data['year']);
		$monthResult['day1'] = $d1;
		$monthResult['lastday'] = date("t",$d1);
		$year = strftime("%Y",$d1);
		$monthResult['year'] = $year;
		$month = strftime("%m",$d1);
		$monthResult['month'] = $month;
		$monthResult['name'] = strftime("%B",$d1);
		$task = JRequest::getVar(	'task',	"view_month");
		if (!isset($task)) $action="view_month";
		else $action = $task;
		$Itemid = EventsHelper::getItemid();
		if (isset($Itemid)) $item= "&Itemid=$Itemid";
		else $item=0;
		$monthResult['link'] = JRoute::_("index.php?option=$option&task=$action$item&year=$year&month=$month");
		return $monthResult;
	}

	function getPrecedingMonth($data)
	{
		return 	$this->getAdjacentMonth($data,-1);
	}
	function getFollowingMonth($data)
	{
		return 	$this->getAdjacentMonth($data,+1);
	}
}
?>
