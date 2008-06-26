<?php
/**
 * Events Component for Joomla 1.5.x
 *
 * @version     $Id: commonqueries.php 980 2008-02-17 09:20:09Z tstahl $
 * @package     Events
 * @copyright   Copyright (C) 2006-2007 JEvents Project Group
 * @copyright   Copyright (C) 2000 - 2003 Eric Lamette, Dave McDonnelle
 * @licence     http://www.gnu.org/copyleft/gpl.html
 * @link        http://joomlacode.org/gf/project/jevents
 */

defined( '_JEXEC' ) or die( 'Restricted access' );

// load language constants
EventsHelper::loadLanguage('front');

function sortEvents( $a, $b ){

	list( $adate, $atime ) = split( ' ', $a->publish_up );
	list( $bdate, $btime ) = split( ' ', $b->publish_up );
	return strcmp( $atime, $btime );
}

class JEventsDBModel {
	var $cfg = null;
	var $datamodel = null;
	var $legacyEvents = null;

	function JEventsDBModel(&$datamodel){
		$this->cfg = & EventsConfig::getInstance();
		$this->legacyEvents = $this->cfg->get('com_legacyEvents',1);

		$this->datamodel =& $datamodel;

		$cfg = & EventsConfig::getInstance();
		$jev_component_name  = $cfg->get("com_componentname");
		$this->_cache =& jeventsCache::getCache( $jev_component_name );	
		
	}

	function accessibleCategoryList($gid=null, $catids=null, $catidList=null) {

		$db	=& JFactory::getDBO();
		if (is_null($gid)) {
			$gid = $this->datamodel->gid;
		}
		if (is_null($catids)) {
			$catids = $this->datamodel->catids;
		}
		if (is_null($catidList)) {
			$catidList = $this->datamodel->catidList;
		}

		$cfg = & EventsConfig::getInstance();
		$compname = $cfg->get("com_componentname");

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
			. "\n AND b.section = '".$compname."'"
			. "\n " . $where;
			;
			$db->setQuery($query);
			$catlist =  $db->loadResultArray();

			$instances[$index] = implode(',', array_merge(array(-1), $catlist));
		}
		return $instances[$index];
	}

	function listEvents( $startdate, $enddate, $order=""){
		if (!$this->legacyEvents) {
			return array();
		}
		$user =& JFactory::getUser();
		$db	=& JFactory::getDBO();
		$lang =& JFactory::getLanguage();
		$langname = $lang->getBackwardLang();

		if( !$order ){
			$order = 'publish_up';
		}

		$query = "SELECT ev.*"
		. "\n , YEAR(publish_up  ) as yup, MONTH(publish_up  ) as mup, DAYOFMONTH(publish_up  ) as dup"
		. "\n , YEAR(publish_down) as ydn, MONTH(publish_down) as mdn, DAYOFMONTH(publish_down) as ddn"
		. "\n , HOUR(publish_up  ) as hup, MINUTE(publish_up  ) as minup, SECOND(publish_up  ) as sup"
		. "\n , HOUR(publish_down) as hdn, MINUTE(publish_down) as mindn, SECOND(publish_down) as sdn"
		. "\n FROM #__events as ev"

		. "\n WHERE ev.catid IN(".$this->accessibleCategoryList().")"

		. "\n AND ev.access <= ".$user->gid
		. "\n AND ((publish_up >= '$startdate 00:00:00' AND publish_up <= '$enddate 23:59:59')"
		. "\n OR (publish_down >= '$startdate 00:00:00' AND publish_down <= '$enddate 23:59:59')"
		. "\n OR (publish_up <= '$startdate 00:00:00' AND publish_down >= '$enddate 23:59:59')"
		. "\n OR (publish_up >= '$startdate 00:00:00' AND publish_down <= '$enddate 23:59:59')"
		. "\n )"
		. "\n AND ev.state = '1'"
		. "\n ORDER BY $order ASC"
		;
		//return $this->_cache->call('_jevqm->_cachedlistEvents', $query, $langname );
		//return $this->_cache->call(array(&$this,'_cachedlistEvents'), $query, $langname );
		return $this->_cache->call('JEventsDBModel::_cachedlistEvents', $query, $langname );
	}

	function _cachedlistEvents($query){
		$db	=& JFactory::getDBO();
		$db->setQuery( $query );
		$rows = $db->loadObjectList();
		$rowcount = count($rows);
		if ($rowcount>0) {
			usort( $rows, 'sortEvents' );
		}

		for( $i = 0; $i < $rowcount; $i++ ){
			$rows[$i] = new jEventCal($rows[$i]);
		}
		return $rows;
	}
	
	function listIcalEvents($startdate,$enddate, $order=""){
		$user =& JFactory::getUser();
		$db	=& JFactory::getDBO();
		$lang =& JFactory::getLanguage();
		$langname = $lang->getBackwardLang();

		if (strpos($startdate,"-")===false) {
			$startdate = strftime('%Y-%m-%d 00:00:00',$startdate);
			$enddate = strftime('%Y-%m-%d 23:59:59',$enddate);
		}

		// process the new plugins
		// get extra data and conditionality from plugins
		$extrafields = "";  // must have comma prefix
		$extratables = "";  // must have comma prefix
		$extrawhere ="";
		$extrajoin = "";
		$dispatcher	=& JDispatcher::getInstance();
		JPluginHelper::importPlugin('jevents');
		$dispatcher->trigger('onListIcalEvents', array (& $extrafields, & $extratables, & $extrawhere, & $extrajoin));		
		
		// This version picks the details from the details table
		$query = "SELECT ev.*, rpt.*, rr.*, det.* $extrafields"
		. "\n , YEAR(rpt.startrepeat) as yup, MONTH(rpt.startrepeat ) as mup, DAYOFMONTH(rpt.startrepeat ) as dup"
		. "\n , YEAR(rpt.endrepeat  ) as ydn, MONTH(rpt.endrepeat   ) as mdn, DAYOFMONTH(rpt.endrepeat   ) as ddn"
		. "\n , HOUR(rpt.startrepeat) as hup, MINUTE(rpt.startrepeat ) as minup, SECOND(rpt.startrepeat ) as sup"
		. "\n , HOUR(rpt.endrepeat  ) as hdn, MINUTE(rpt.endrepeat   ) as mindn, SECOND(rpt.endrepeat   ) as sdn"
		. "\n FROM (#__jevents_vevent as ev, #__jevents_icsfile as icsf $extratables)"
		. "\n LEFT JOIN #__jevents_repetition as rpt ON rpt.eventid = ev.ev_id"
		. "\n LEFT JOIN #__jevents_vevdetail as det ON det.evdet_id = rpt.eventdetail_id"
		. "\n LEFT JOIN #__jevents_rrule as rr ON rr.eventid = ev.ev_id"
		. $extrajoin 
		. "\n WHERE ev.catid IN(".$this->accessibleCategoryList().")"
		. $extrawhere 
		. "\n AND ev.access <= ".$user->gid
		. "\n AND ev.state=1"
		. "\n AND icsf.ics_id=ev.icsid AND icsf.state=1 AND icsf.access <= ".$user->gid
		. "\n AND ((rpt.startrepeat >= '$startdate%' AND rpt.startrepeat <= '$enddate%')"
		. "\n OR (rpt.endrepeat >= '$startdate%' AND rpt.endrepeat <= '$enddate%')"
		. "\n OR (rpt.startrepeat >= '$startdate%' AND rpt.endrepeat <= '$enddate%')"
		. "\n OR (rpt.startrepeat <= '$startdate%' AND rpt.endrepeat >= '$enddate%'))";

		//return $this->_cache->call('_jevqm->_cachedlistIcalEvents', $query, $langname );
		//return $this->_cache->call(array(&$this,'cachedlistIcalEvents'), $query, $langname );
		return $this->_cache->call('JEventsDBModel::_cachedlistIcalEvents', $query, $langname );
	}

	function _cachedlistIcalEvents($query){
		$db	=& JFactory::getDBO();
		$db->setQuery( $query );
		//echo $db->explain();
		$icalrows = $db->loadObjectList();

		$icalcount = count($icalrows);
		for( $i = 0; $i < $icalcount ; $i++ ){
			// convert rows to jIcalEvents
			$icalrows[$i] = new jIcalEventRepeat($icalrows[$i]);
		}
		return $icalrows;		
	}
	
	function listEventsByDateNEW( $select_date ){
		return $this->listEvents($select_date." 00:00:00",$select_date." 23:59:59");
	}

	function listIcalEventsByDay($targetdate){
		// targetdate is midnight at start of day - but just in case
		list ($y,$m,$d) =	explode(":",strftime( '%Y:%m:%d',$targetdate));
		$startdate 	= mktime( 0, 0, 0, $m, $d, $y );
		$enddate 	= mktime( 23, 59, 59, $m, $d, $y );
		return $this->listIcalEvents($startdate,$enddate);
	}

	function listEventsByWeekNEW( $weekstart, $weekend){
		return $this->listEvents($weekstart, $weekend);
	}

	function listIcalEventsByWeek( $weekstart, $weekend){
		return $this->listIcalEvents( $weekstart, $weekend);
	}

	function listEventsByMonthNew( $year, $month, $order){
		$db	=& JFactory::getDBO();

		$month = str_pad($month, 2, '0', STR_PAD_LEFT);
		$select_date 		= $year.'-'.$month.'-01 00:00:00';
		$select_date_fin 	= $year.'-'.$month.'-'.date('t',mktime(0,0,0,($month+1),0,$year)).' 23:59:59';

		return $this->listEvents($select_date,$select_date_fin,$order);
	}

	function listIcalEventsByMonth( $year, $month){
		$startdate 	= mktime( 0, 0, 0,  $month,  1, $year );
		$enddate 	= mktime( 23, 59, 59,  $month, date( 't', $startdate), $year );
		return $this->listIcalEvents($startdate,$enddate,"");
	}

	function listEventsByYearNEW( $year, $limitstart=0, $limit=0 ) {
		$user =& JFactory::getUser();
		$db	=& JFactory::getDBO();

		if ($limit>0){
			$rows_per_page = $limit;

			if( empty( $limitstart ) || !$limitstart ){
				$limitstart = 0;
			}

			$limit = "LIMIT $limitstart, $rows_per_page";
		}
		else $limit="";

		$query = "SELECT *"
		. "\n , YEAR(publish_up  ) as yup, MONTH(publish_up  ) as mup, DAYOFMONTH(publish_up  ) as dup"
		. "\n , YEAR(publish_down) as ydn, MONTH(publish_down) as mdn, DAYOFMONTH(publish_down) as ddn"
		. "\n , HOUR(publish_up  ) as hup, MINUTE(publish_up  ) as minup, SECOND(publish_up  ) as sup"
		. "\n , HOUR(publish_down) as hdn, MINUTE(publish_down) as mindn, SECOND(publish_down) as sdn"
		. "\n FROM #__events"
		. "\n WHERE #__events.catid IN(".$this->accessibleCategoryList().")"
		. "\n AND #__events.access <= ".$user->gid
		. "\n AND publish_up LIKE '$year%'"
		. "\n AND (publish_down >= '$year%' OR publish_down = '0000-00-00 00:00:00')"
		. "\n AND #__events.state = '1'"
		. "\n ORDER BY publish_up ASC $limit"
		;
		$db->setQuery( $query );
		$rows = $db->loadObjectList();
		$rowcount = count( $rows );
		usort( $rows, 'sortEvents' );

		for( $i = 0; $i < $rowcount; $i++ ){
			// convert rows to jevents
			$rows[$i] = new jEventCal($rows[$i]);
		}

		return $rows;
	}

	function listIcalEventsByYear( $year) {
		$startdate 	= mktime( 0, 0, 0, 1, 1, $year );
		$enddate 	= mktime( 23, 59, 59, 12, 31, $year );
		return $this->listIcalEvents($startdate,$enddate);
	}


	function listEventsById( $agid, $includeUnpublished=0, $jevtype="unspecified" ) {
		$access =& EventsHelper::getJEV_Access();
		$user =& JFactory::getUser();
		$db	=& JFactory::getDBO();

		// process the new plugins
		// get extra data and conditionality from plugins
		$extrafields = "";  // must have comma prefix
		$extratables = "";  // must have comma prefix
		$extrawhere ="";
		$extrajoin = "";
		$dispatcher	=& JDispatcher::getInstance();
		JPluginHelper::importPlugin('jevents');
		$dispatcher->trigger('onListEventsById', array (& $extrafields, & $extratables, & $extrawhere, & $extrajoin));		

		if ($jevtype=="jevent"){
			if( $access->canPublish() && $includeUnpublished ){
				$query = "SELECT *"
				. "\n FROM #__events"
				. "\n WHERE #__events.catid IN(".$this->accessibleCategoryList().")"
				. "\n AND #__events.access <= ".$user->gid
				. "\n AND #__events.id = '$agid'"
				;
			}else{
				$query = "SELECT *"
				. "\n FROM #__events"
				. "\n WHERE #__events.catid IN(".$this->accessibleCategoryList().")"
				. "\n AND #__events.access <= ".$user->gid
				. "\n AND #__events.id = '$agid'"
				. "\n AND #__events.state = '1'"
				;
			}
		}
		else if ($jevtype=="icaldb"){
			$query = "SELECT ev.*, rpt.*, rr.*, det.* $extrafields"
			. "\n , YEAR(rpt.startrepeat) as yup, MONTH(rpt.startrepeat ) as mup, DAYOFMONTH(rpt.startrepeat ) as dup"
			. "\n , YEAR(rpt.endrepeat  ) as ydn, MONTH(rpt.endrepeat   ) as mdn, DAYOFMONTH(rpt.endrepeat   ) as ddn"
			. "\n , HOUR(rpt.startrepeat) as hup, MINUTE(rpt.startrepeat ) as minup, SECOND(rpt.startrepeat ) as sup"
			. "\n , HOUR(rpt.endrepeat  ) as hdn, MINUTE(rpt.endrepeat   ) as mindn, SECOND(rpt.endrepeat   ) as sdn"
			. "\n FROM (#__jevents_vevent as ev $extratables)"
			. "\n LEFT JOIN #__jevents_repetition as rpt ON rpt.eventid = ev.ev_id"
			. "\n LEFT JOIN #__jevents_vevdetail as det ON det.evdet_id = rpt.eventdetail_id"
			. "\n LEFT JOIN #__jevents_rrule as rr ON rr.eventid = ev.ev_id"
			. $extrajoin
			. "\n WHERE ev.catid IN(".$this->accessibleCategoryList().")"
			. $extrawhere
			. "\n AND rpt.rp_id = '$agid'";
		}
		else {
			die("invalid jevtype in listEventsById - more changes needed");
		}

		$db->setQuery( $query );
		$rows = $db->loadObjectList();

		// iCal agid uses GUID or UUID as identifier
		if( $rows ){
			if (strtolower($jevtype)=="icaldb"){
				$row = new jIcalEventRepeat($rows[0]);
			}
			else if (strtolower($jevtype)=="jevent"){
				$row = new jEventCal($rows[0]);
			}
		}else{
			$row=null;
		}

		return $row;
	}


	function listEventsByCreator( $creator_id, $limitstart, $limit ){
		if (!$this->legacyEvents) {
			return array();
		}
		$access =& EventsHelper::getJEV_Access();
		$user =& JFactory::getUser();
		$db	=& JFactory::getDBO();

		$cfg = & EventsConfig::getInstance();

		$rows_per_page = $limit;

		if( empty( $limitstart) || !$limitstart ){
			$limitstart = 0;
		}

		$limit = "LIMIT $limitstart, $rows_per_page";

		$where = '';

		if( $creator_id <> 'ADMIN' ){
			$where = " AND created_by = '$creator_id' ";

		}
		// Show unpublished events too for publishers and above listing events created by others too!

		$frontendPublish = intval($cfg->get('com_frontendPublish', 0)) > 0;

		if( $access->canPublish() && $frontendPublish ){
			$query = "SELECT *"
			. "\n , YEAR(publish_up  ) as yup, MONTH(publish_up  ) as mup, DAYOFMONTH(publish_up  ) as dup"
			. "\n , YEAR(publish_down) as ydn, MONTH(publish_down) as mdn, DAYOFMONTH(publish_down) as ddn"
			. "\n , HOUR(publish_up  ) as hup, MINUTE(publish_up  ) as minup, SECOND(publish_up  ) as sup"
			. "\n , HOUR(publish_down) as hdn, MINUTE(publish_down) as mindn, SECOND(publish_down) as sdn"
			. "\n FROM #__events"
			. "\n WHERE #__events.catid IN(".$this->accessibleCategoryList().")"
			. "\n AND #__events.access <= ".$user->gid
			. "\n ORDER BY publish_up ASC $limit"
			;
		}else{
			$query = "SELECT *"
			. "\n , YEAR(publish_up  ) as yup, MONTH(publish_up  ) as mup, DAYOFMONTH(publish_up  ) as dup"
			. "\n , YEAR(publish_down) as ydn, MONTH(publish_down) as mdn, DAYOFMONTH(publish_down) as ddn"
			. "\n , HOUR(publish_up  ) as hup, MINUTE(publish_up  ) as minup, SECOND(publish_up  ) as sup"
			. "\n , HOUR(publish_down) as hdn, MINUTE(publish_down) as mindn, SECOND(publish_down) as sdn"
			. "\n FROM #__events"
			. "\n WHERE #__events.catid IN(".$this->accessibleCategoryList().")"
			. "\n AND #__events.access <= ".$user->gid." $where"
			. "\n AND #__events.state='1'"
			. "\n ORDER BY publish_up ASC $limit"
			;
		}
		$db->setQuery( $query );
		$rows = $db->loadObjectList();
		$num_events = count( $rows );

		for( $i = 0; $i < $num_events; $i++ ){
			// convert rows to jevents
			$rows[$i] = new jEventCal($rows[$i]);
		}

		return $rows;
	}

	function listIcalEventsByCreator ( $creator_id, $limitstart, $limit ){
		$access =& EventsHelper::getJEV_Access();
		$user =& JFactory::getUser();
		$db	=& JFactory::getDBO();

		$cfg = & EventsConfig::getInstance();

		$rows_per_page = $limit;

		if( empty( $limitstart) || !$limitstart ){
			$limitstart = 0;
		}

		$limit = "LIMIT $limitstart, $rows_per_page";

		$where = '';

		if( $creator_id <> 'ADMIN' ){
			$where = " AND created_by = '$creator_id' ";
		}

		$frontendPublish = intval($cfg->get('com_frontendPublish', 0)) > 0;

		if( $access->canPublish() && $frontendPublish ){
			$query = "SELECT ev.*, rr.*, det.*"
			. "\n , YEAR(dtstart) as yup, MONTH(dtstart ) as mup, DAYOFMONTH(dtstart ) as dup"
			. "\n , YEAR(dtend  ) as ydn, MONTH(dtend   ) as mdn, DAYOFMONTH(dtend   ) as ddn"
			. "\n , HOUR(dtstart) as hup, MINUTE(dtstart) as minup, SECOND(dtstart   ) as sup"
			. "\n , HOUR(dtend  ) as hdn, MINUTE(dtend  ) as mindn, SECOND(dtend     ) as sdn"
			. "\n FROM (#__jevents_vevent as ev, #__jevents_icsfile as icsf)"
			. "\n LEFT JOIN #__jevents_rrule as rr ON rr.eventid = ev.ev_id"
			. "\n LEFT JOIN #__jevents_vevdetail as det ON det.evdet_id = ev.detail_id"
			. "\n WHERE ev.catid IN(".$this->accessibleCategoryList().")"
			. "\n AND ev.created_by = ".$user->id
			. "\n AND icsf.ics_id=ev.icsid AND icsf.state=1";
		}
		else {
			$query = "SELECT ev.*, rr.*, det.*"
			. "\n , YEAR(dtstart) as yup, MONTH(dtstart ) as mup, DAYOFMONTH(dtstart ) as dup"
			. "\n , YEAR(dtend  ) as ydn, MONTH(dtend   ) as mdn, DAYOFMONTH(dtend   ) as ddn"
			. "\n , HOUR(dtstart) as hup, MINUTE(dtstart) as minup, SECOND(dtstart   ) as sup"
			. "\n , HOUR(dtend  ) as hdn, MINUTE(dtend  ) as mindn, SECOND(dtend     ) as sdn"
			. "\n FROM (#__jevents_vevent as ev, #__jevents_icsfile as icsf) "
			. "\n LEFT JOIN #__jevents_rrule as rr ON rr.eventid = ev.ev_id"
			. "\n LEFT JOIN #__jevents_vevdetail as det ON det.evdet_id = ev.detail_id"
			. "\n WHERE ev.catid IN(".$this->accessibleCategoryList().")"
			. "\n AND ev.created_by = ".$user->id
			. "\n AND ev.state=1"
			. "\n AND icsf.ics_id=ev.icsid AND icsf.state=1";
		}
		$db->setQuery( $query );
		$icalrows = $db->loadObjectList();
		$icalcount = count($icalrows);
		for( $i = 0; $i < $icalcount ; $i++ ){
			// convert rows to jIcalEvents
			$icalrows[$i] = new jIcalEventDB($icalrows[$i]);
		}
		return $icalrows;
	}

	function listIcalEventRepeatsByCreator ( $creator_id, $limitstart, $limit ){
		$access =& EventsHelper::getJEV_Access();
		$user =& JFactory::getUser();
		$db	=& JFactory::getDBO();

		$cfg = & EventsConfig::getInstance();

		$rows_per_page = $limit;

		if( empty( $limitstart) || !$limitstart ){
			$limitstart = 0;
		}

		$limit = "LIMIT $limitstart, $rows_per_page";

		$where = '';

		if( $creator_id <> 'ADMIN' ){
			$where = " AND created_by = '$creator_id' ";
		}

		$frontendPublish = intval($cfg->get('com_frontendPublish', 0)) > 0;

		if( $access->canPublish() && $frontendPublish ){
			// TODO fine a single query way of doing this !!!
			$query = "SELECT MIN(rpt.rp_id) as rp_id"
			. "\n FROM (#__jevents_vevent as ev, #__jevents_icsfile as icsf,#__jevents_repetition as rpt) "
			. "\n LEFT JOIN #__jevents_rrule as rr ON rr.eventid = ev.ev_id"
			. "\n WHERE ev.catid IN(".$this->accessibleCategoryList().")"
			. "\n AND rpt.eventid = ev.ev_id"
			//		. "\n AND ev.created_by = ".$user->id
			. "\n AND icsf.ics_id=ev.icsid AND icsf.state=1"
			. "\n GROUP BY ev.ev_id";

			$db->setQuery( $query );
			$rplist =  $db->loadResultArray();

			$rplist = implode(',', array_merge(array(-1), $rplist));

			$query = "SELECT ev.*, rpt.*, rr.*, det.*"
			. "\n , YEAR(rpt.startrepeat) as yup, MONTH(rpt.startrepeat ) as mup, DAYOFMONTH(rpt.startrepeat ) as dup"
			. "\n , YEAR(rpt.endrepeat  ) as ydn, MONTH(rpt.endrepeat   ) as mdn, DAYOFMONTH(rpt.endrepeat   ) as ddn"
			. "\n , HOUR(rpt.startrepeat) as hup, MINUTE(rpt.startrepeat ) as minup, SECOND(rpt.startrepeat ) as sup"
			. "\n , HOUR(rpt.endrepeat  ) as hdn, MINUTE(rpt.endrepeat   ) as mindn, SECOND(rpt.endrepeat   ) as sdn"
			. "\n FROM (#__jevents_vevent as ev, #__jevents_icsfile as icsf,#__jevents_repetition as rpt) "
			. "\n LEFT JOIN #__jevents_rrule as rr ON rr.eventid = ev.ev_id"
			. "\n LEFT JOIN #__jevents_vevdetail as det ON det.evdet_id = rpt.eventdetail_id"
			. "\n WHERE ev.catid IN(".$this->accessibleCategoryList().")"
			. "\n AND rpt.eventid = ev.ev_id"
			. "\n AND rpt.rp_id IN($rplist)"
			//	. "\n AND ev.created_by = ".$user->id
			. "\n AND icsf.ics_id=ev.icsid AND icsf.state=1";
		}
		else {
			// TODO fine a single query way of doing this !!!
			$query = "SELECT MIN(rpt.rp_id) as rp_id"
			. "\n FROM (#__jevents_vevent as ev, #__jevents_icsfile as icsf,#__jevents_repetition as rpt)"
			. "\n LEFT JOIN #__jevents_rrule as rr ON rr.eventid = ev.ev_id"
			. "\n WHERE ev.catid IN(".$this->accessibleCategoryList().")"
			. "\n AND rpt.eventid = ev.ev_id"
			. "\n AND ev.state=1"
			. "\n AND ev.created_by = ".$user->id
			. "\n AND icsf.ics_id=ev.icsid AND icsf.state=1"
			. "\n GROUP BY ev.ev_id";

			$db->setQuery( $query );
			$rplist =  $db->loadResultArray();

			$rplist = implode(',', array_merge(array(-1), $rplist));

			$query = "SELECT ev.*, rpt.*, rr.*, det.*"
			. "\n , YEAR(rpt.startrepeat) as yup, MONTH(rpt.startrepeat ) as mup, DAYOFMONTH(rpt.startrepeat ) as dup"
			. "\n , YEAR(rpt.endrepeat  ) as ydn, MONTH(rpt.endrepeat   ) as mdn, DAYOFMONTH(rpt.endrepeat   ) as ddn"
			. "\n , HOUR(rpt.startrepeat) as hup, MINUTE(rpt.startrepeat ) as minup, SECOND(rpt.startrepeat ) as sup"
			. "\n , HOUR(rpt.endrepeat  ) as hdn, MINUTE(rpt.endrepeat   ) as mindn, SECOND(rpt.endrepeat   ) as sdn"
			. "\n FROM (#__jevents_vevent as ev, #__jevents_icsfile as icsf,#__jevents_repetition as rpt) "
			. "\n LEFT JOIN #__jevents_rrule as rr ON rr.eventid = ev.ev_id"
			. "\n LEFT JOIN #__jevents_vevdetail as det ON det.evdet_id = rpt.eventdetail_id"
			. "\n WHERE ev.catid IN(".$this->accessibleCategoryList().")"
			. "\n AND rpt.eventid = ev.ev_id"
			. "\n AND rpt.rp_id IN($rplist)"
			. "\n AND ev.created_by = ".$user->id
			. "\n AND ev.state=1"
			. "\n AND icsf.ics_id=ev.icsid AND icsf.state=1";
		}
		$db->setQuery( $query );
		$icalrows = $db->loadObjectList();
		$icalcount = count($icalrows);
		for( $i = 0; $i < $icalcount ; $i++ ){
			// convert rows to jIcalEvents
			$icalrows[$i] = new jIcalEventDB($icalrows[$i]);
		}
		return $icalrows;
	}

	function listEventsByCat( $catid, $limitstart, $limit ){
		$user =& JFactory::getUser();
		$db	=& JFactory::getDBO();

		$rows_per_page = $limit;
		if( empty( $limitstart ) || !$limitstart ){
			$limitstart = 0;
		}

		$limit = "LIMIT $limitstart, $rows_per_page";

		if( $catid ){

			$query = "SELECT #__events.*"
			. "\n , YEAR(publish_up  ) as yup, MONTH(publish_up  ) as mup, DAYOFMONTH(publish_up  ) as dup"
			. "\n , YEAR(publish_down) as ydn, MONTH(publish_down) as mdn, DAYOFMONTH(publish_down) as ddn"
			. "\n , HOUR(publish_up  ) as hup, MINUTE(publish_up  ) as minup, SECOND(publish_up  ) as sup"
			. "\n , HOUR(publish_down) as hdn, MINUTE(publish_down) as mindn, SECOND(publish_down) as sdn"
			. "\n FROM #__events"
			. "\n WHERE #__events.catid IN($catid)"
			. "\n AND #__events.access <= ".$user->gid
			. "\n AND #__events.state = '1'"
			. "\n ORDER BY publish_up ASC $limit"
			;
		} else {
			$query = "SELECT #__events.*"
			. "\n , YEAR(publish_up  ) as yup, MONTH(publish_up  ) as mup, DAYOFMONTH(publish_up  ) as dup"
			. "\n , YEAR(publish_down) as ydn, MONTH(publish_down) as mdn, DAYOFMONTH(publish_down) as ddn"
			. "\n , HOUR(publish_up  ) as hup, MINUTE(publish_up  ) as minup, SECOND(publish_up  ) as sup"
			. "\n , HOUR(publish_down) as hdn, MINUTE(publish_down) as mindn, SECOND(publish_down) as sdn"
			. "\n FROM #__events"
			. "\n WHERE #__events.catid IN(".$this->accessibleCategoryList().")"
			. "\n AND #__events.access <= ".$user->gid
			. "\n AND #__events.state = '1'"
			. "\n ORDER BY publish_up ASC $limit"

			;
		}

		$db->setQuery( $query );
		$rows = $db->loadObjectList();
		$num_events = count( $rows );

		for( $i = 0; $i < $num_events; $i++ ){
			// convert rows to jevents
			$rows[$i] = new jEventCal($rows[$i]);
		}

		return $rows;
	}

	function listIcalEventsByCat ($catid, $showrepeats = false) {
		$db	=& JFactory::getDBO();

		if ($showrepeats){
			$query = "SELECT ev.*, rpt.*, rr.*, det.*"
			. "\n , YEAR(rpt.startrepeat) as yup, MONTH(rpt.startrepeat ) as mup, DAYOFMONTH(rpt.startrepeat ) as dup"
			. "\n , YEAR(rpt.endrepeat  ) as ydn, MONTH(rpt.endrepeat   ) as mdn, DAYOFMONTH(rpt.endrepeat   ) as ddn"
			. "\n , HOUR(rpt.startrepeat) as hup, MINUTE(rpt.startrepeat ) as minup, SECOND(rpt.startrepeat ) as sup"
			. "\n , HOUR(rpt.endrepeat  ) as hdn, MINUTE(rpt.endrepeat   ) as mindn, SECOND(rpt.endrepeat   ) as sdn"
			. "\n FROM (#__jevents_vevent as ev, #__jevents_icsfile as icsf)"
			. "\n LEFT JOIN #__jevents_repetition as rpt ON rpt.eventid = ev.ev_id"
			. "\n LEFT JOIN #__jevents_vevdetail as det ON det.evdet_id = rpt.eventdetail_id"
			. "\n WHERE ev.catid IN(".$this->accessibleCategoryList().")"
			. "\n AND ev.catid = $catid"
			. "\n AND ev.state=1"
			. "\n AND icsf.ics_id=ev.icsid AND icsf.state=1";
		}
		else {
			// TODO fine a single query way of doing this !!!
			$query = "SELECT MIN(rpt.rp_id) as rp_id"
			. "\n FROM (#__jevents_vevent as ev, #__jevents_icsfile as icsf,#__jevents_repetition as rpt) "
			. "\n LEFT JOIN #__jevents_rrule as rr ON rr.eventid = ev.ev_id"
			. "\n WHERE ev.catid IN(".$this->accessibleCategoryList().")"
			. "\n AND rpt.eventid = ev.ev_id"
			. "\n AND ev.catid = $catid"
			. "\n AND ev.state=1"
			. "\n AND icsf.ics_id=ev.icsid AND icsf.state=1"
			. "\n GROUP BY ev.ev_id";

			$db->setQuery( $query );
			$rplist =  $db->loadResultArray();

			$rplist = implode(',', array_merge(array(-1), $rplist));

			$query = "SELECT ev.*, rpt.*, rr.*, det.*"
			. "\n , YEAR(rpt.startrepeat) as yup, MONTH(rpt.startrepeat ) as mup, DAYOFMONTH(rpt.startrepeat ) as dup"
			. "\n , YEAR(rpt.endrepeat  ) as ydn, MONTH(rpt.endrepeat   ) as mdn, DAYOFMONTH(rpt.endrepeat   ) as ddn"
			. "\n , HOUR(rpt.startrepeat) as hup, MINUTE(rpt.startrepeat ) as minup, SECOND(rpt.startrepeat ) as sup"
			. "\n , HOUR(rpt.endrepeat  ) as hdn, MINUTE(rpt.endrepeat   ) as mindn, SECOND(rpt.endrepeat   ) as sdn"
			. "\n FROM (#__jevents_vevent as ev, #__jevents_icsfile as icsf,#__jevents_repetition as rpt) "
			. "\n LEFT JOIN #__jevents_rrule as rr ON rr.eventid = ev.ev_id"
			. "\n LEFT JOIN #__jevents_vevdetail as det ON det.evdet_id = rpt.eventdetail_id"
			. "\n WHERE ev.catid IN(".$this->accessibleCategoryList().")"
			. "\n AND rpt.eventid = ev.ev_id"
			. "\n AND rpt.rp_id IN($rplist)"
			. "\n AND ev.catid = $catid"
			. "\n AND ev.state=1"
			. "\n AND icsf.ics_id=ev.icsid AND icsf.state=1";

		}
		$db->setQuery( $query );
		$icalrows = $db->loadObjectList();
		$icalcount = count($icalrows);
		for( $i = 0; $i < $icalcount ; $i++ ){
			// convert rows to jIcalEvents
			$icalrows[$i] = new jIcalEventRepeat($icalrows[$i]);
		}
		return $icalrows;

	}

	function listEventsByKeyword( $keyword, $order, $limit, $limitstart, $useRegX=false ){
		$user =& JFactory::getUser();
		$db	=& JFactory::getDBO();

		$rows_per_page = $limit;
		if( empty( $limitstart ) || !$limitstart ){
			$limitstart = 0;
		}

		$limit = "LIMIT $limitstart, $rows_per_page";

		// dmcd May 7/04, added a FULLTEXT index if not present to events db table for better search
		// Note this is really temporary.  Need to add this to the db schema for events table

		if( !$useRegX ){
			$query = "SHOW INDEX"
			. "\n FROM #__events"
			;
			$db->setQuery( $query );
			$index = $db->loadObjectList('Key_name');

			if( !array_key_exists( 'searchIdx', $index ) || $index['searchIdx']->Index_type != 'FULLTEXT' ){
				// dmcd go add the required index now
				$query = "ALTER TABLE #__events"
				. "\n ADD FULLTEXT searchIdx (title, content)"
				;
				$db->setQuery( $query );
				$db->query();
			}
		}

		//$limit = "LIMIT $from, $rows_per_page";
		$limit = "LIMIT $limitstart, $rows_per_page";

		if( !$order ){
			$order = 'publish_up';
		}

		$order 	= preg_replace( "/[\t ]+/", '', $order );
		$orders = explode( ",", $order );

		// this function adds #__events. to the beginning of each ordering field
		function app_db( $strng ){
			return '#__events.' . $strng;
		}

		$order = implode( ',', array_map( 'app_db', $orders ));

		if (!$this->legacyEvents) {
			$rows = array();
		}
		else {
			$query = "SELECT *"
			. "\n , YEAR(publish_up  ) as yup, MONTH(publish_up  ) as mup, DAYOFMONTH(publish_up  ) as dup"
			. "\n , YEAR(publish_down) as ydn, MONTH(publish_down) as mdn, DAYOFMONTH(publish_down) as ddn"
			. "\n , HOUR(publish_up  ) as hup, MINUTE(publish_up  ) as minup, SECOND(publish_up  ) as sup"
			. "\n , HOUR(publish_down) as hdn, MINUTE(publish_down) as mindn, SECOND(publish_down) as sdn"
			. "\n FROM #__events"
			. "\n WHERE #__events.catid IN(".$this->accessibleCategoryList().")"
			. "\n AND #__events.access <= ".$user->gid
			. "\n AND\n"
			;

			$query .= ( $useRegX ) ? "(#__events.title RLIKE '$keyword' OR #__events.content RLIKE '$keyword')\n" :
			"MATCH (#__events.title, #__events.content) AGAINST ('$keyword' IN BOOLEAN MODE)\n";
			$query .= "AND #__events.state = '1'"
			. "\n ORDER BY $order ASC $limit"
			;

			$db->setQuery( $query );
			$rows = $db->loadObjectList();
		}
		$num_events = count( $rows );

		for( $i = 0; $i < $num_events; $i++ ){
			// convert rows to jevents
			$rows[$i] = new jEventCal($rows[$i]);
		}

		// Now Search Icals
		$query = "SELECT ev.*, rpt.*, det.*"
		. "\n , YEAR(rpt.startrepeat) as yup, MONTH(rpt.startrepeat ) as mup, DAYOFMONTH(rpt.startrepeat ) as dup"
		. "\n , YEAR(rpt.endrepeat  ) as ydn, MONTH(rpt.endrepeat   ) as mdn, DAYOFMONTH(rpt.endrepeat   ) as ddn"
		. "\n , HOUR(rpt.startrepeat) as hup, MINUTE(rpt.startrepeat ) as minup, SECOND(rpt.startrepeat ) as sup"
		. "\n , HOUR(rpt.endrepeat  ) as hdn, MINUTE(rpt.endrepeat   ) as mindn, SECOND(rpt.endrepeat   ) as sdn"
		. "\n FROM (#__jevents_vevent as ev, #__jevents_icsfile as icsf)"
		. "\n LEFT JOIN #__jevents_repetition as rpt ON rpt.eventid = ev.ev_id"
		. "\n LEFT JOIN #__jevents_vevdetail as det ON det.evdet_id = rpt.eventdetail_id"
		. "\n WHERE ev.catid IN(".$this->accessibleCategoryList().")"
		. "\n AND icsf.ics_id=ev.icsid AND icsf.state=1 AND icsf.access <= ".$user->gid
		. "\n AND\n"
		;

		$query .= ( $useRegX ) ? "(det.summary RLIKE '$keyword' OR det.description RLIKE '$keyword')\n" :
		"MATCH (det.summary, det.description) AGAINST ('$keyword' IN BOOLEAN MODE)\n";
		$query .= "AND ev.state = '1'"
		;
		$query .= " \n GROUP BY det.evdet_id";

		$db->setQuery( $query );
		$icalrows = $db->loadObjectList();
		$num_events = count( $icalrows );

		for( $i = 0; $i < $num_events; $i++ ){
			// convert rows to jevents
			$icalrows[$i] = new jIcalEventRepeat($icalrows[$i]);
		}

		$rows = array_merge($rows,$icalrows);

		return $rows;
	}


}



?>
