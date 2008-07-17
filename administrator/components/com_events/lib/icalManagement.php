<?php
/**
 * Events Component for Joomla 1.5.x
 *
 * @version     $Id: icalManagement.php 986 2008-02-21 22:22:38Z tstahl $
 * @package     Events
 * @copyright   Copyright (C) 2006-2007 JEvents Project Group
 * @licence     http://www.gnu.org/copyleft/gpl.html
 * @link        http://joomlacode.org/gf/project/jevents
 */

defined( '_JEXEC' ) or die( 'Restricted access' );
$cfg = & EventsConfig::getInstance();
$jev_component_name  = $cfg->get("com_componentname", "com_events");
include_once(JPATH_ADMINISTRATOR."/components/$jev_component_name/admin.events.html.php");
// load backend language constants in case loaded from frontend admin
EventsHelper::loadLanguage('admin');

/**
 * utility class for manipulation of ICALs and IcalEvents
 *
 */
class IcalManagement {
	var $html_events_admin = null;

	function IcalManagement(){
		$this->html_events_admin = & HTML_events_admin::getInstance();
		$config	=& JFactory::getConfig();
		$this->_debug = $config->getValue('config.debug',0);
	}

	function accessibleCategoryList($gid=null, $catids=null, $catidList=null){
		return $this->html_events_admin->dataModel->accessibleCategoryList($gid, $catids, $catidList);
	}

	/**
	 * ICAL ICS File/Calendar FUNCTIONS
	 */

	function manageICalSubscriptions(){
		echo "Manage Ical Subscriptions<br/>";

		global  $mainframe;
		$cfg = & EventsConfig::getInstance();
		$option = $cfg->get("com_componentname", "com_events");
		$db	=& JFactory::getDBO();

		$catid		= intval( $mainframe->getUserStateFromRequest( "catid{$option}", 'catid', 0 ));
		$limit		= intval( $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', 10 ));
		$limitstart = intval( $mainframe->getUserStateFromRequest( "view{$option}limitstart", 'limitstart', 0 ));
		$search		= $mainframe->getUserStateFromRequest( "search{$option}", 'search', '' );
		$search		= $db->getEscaped( trim( strtolower( $search ) ) );
		$where		= array();

		if( $search ){
			$where[] = "LOWER(a.summary) LIKE '%$search%'";
		}
		if ($catid>0){
			$where[] ="catid = $catid";
		}
		// get the total number of records
		$query = "SELECT count(*)"
		. "\n FROM #__jevents_icsfile AS icsf"
		. ( count( $where ) ? "\n WHERE " . implode( ' AND ', $where ) : '' )
		;
		$db->setQuery( $query);
		$total = $db->loadResult();
		echo $db->getErrorMsg();

		if( $limit > $total ) {
			$limitstart = 0;
		}

		$query = "SELECT icsf.*, g.name AS _groupname"
		. "\n FROM #__jevents_icsfile as icsf "
		. "\n LEFT JOIN #__groups AS g ON g.id = icsf.access"
		. ( count( $where ) ? "\n WHERE " . implode( ' AND ', $where ) : '' )
		//	. "\n WHERE icsf.catid IN(".$this->accessibleCategoryList().")"
		. "\n LIMIT $limitstart, $limit";

		$db->setQuery( $query );
		$rows = $db->loadObjectList();

		$catData = getCategoryData();
		foreach ($rows as $row) {
			if (array_key_exists($row->catid,$catData)){
				$row->category = $catData[$row->catid]->name;
			}
			else {
				$row->category = "?";
			}
		}

		if( $this->_debug ){
			echo '[DEBUG]<br />';
			echo 'query:';
			echo '<pre>';
			echo $query;
			echo '-----------<br />';
			echo 'option "' . $option . '"<br />';
			echo '</pre>';
			//die( 'userbreak - mic ' );
		}

		if ($db->getErrorNum()) {
			echo $db->stderr();
			return false;
		}
		// get list of categories
		$categories= array();
		//$categories[] = JHTML::_('select.option', '0', _CAL_LANG_EVENT_CHOOSE_CATEG );
		$categories[]  = JHTML::_('select.option', '-1', '- '._CAL_LANG_EVENT_ALLCAT );

		$query = "SELECT id AS value, title AS text"
		. "\n FROM #__categories"
		. "\n WHERE section='$option'"
		. "\n ORDER BY ordering"
		;
		$db->setQuery( $query );

		$categories = array_merge( $categories, $db->loadObjectList() );

		$clist = JHTML::_('select.genericlist', $categories, 'catid', 'class="inputbox" size="1" onchange="document.adminForm.submit();"', 'value', 'text', $catid );

		include_once( 'includes/pageNavigation.php' );
		$pageNav = new JPagination( $total, $limitstart, $limit  );

		$this->html_events_admin->showICalSubscriptions( $rows, $search, $pageNav, $option, $clist);
	}

	/**
 	* create new ICAL from scratch
 	*/
	function newIcalCalendar(){
		global $task;
		$cfg = & EventsConfig::getInstance();
		$option = $cfg->get("com_componentname", "com_events");
		$db	=& JFactory::getDBO();

		// include ical files
		global $mainframe;
		include_once(JPATH_SITE."/components/$option/libraries/iCalImport.php");
		$catid = intval(JRequest::getVar('catid',0));
		// Should come from the form or existing item
		$access = 0;
		$state = 1;
		$icsLabel = JRequest::getVar('icsLabel','' );
		if ($catid==0){
			echo "missing category selection<br/>";
			return;
		}
		$icsid = 0;
		$icsFile = iCalICSFile::editICalendar($icsid,$catid,$access,$state,$icsLabel);
		$icsFileid = $icsFile->store();
		global $mainframe;
		$mainframe->redirect( 'index2.php?option=' . $option. '&task=iCalsubs',"ICS FILE Created");
	}

	/**
	 * Imports Ical file to database 
	 * 
 	*/
	function importICal() {
		$cid	= JRequest::getVar(	'cid',	array(0) );
		EventsHelper::forceIntegerArray($cid);
		if (is_array($cid) && count($cid)>0) $cid=$cid[0];
		else $cid=0;
		global $task;
		$cfg = & EventsConfig::getInstance();
		$option = $cfg->get("com_componentname", "com_events");
		$db	=& JFactory::getDBO();

		// include ical files
		global $mainframe;
		include_once(JPATH_SITE."/components/$option/libraries/iCalImport.php");

		$icsid = intval(JRequest::getVar('icsid',0));
		if ($icsid>0 || $cid!=0){
			$icsid = ($icsid>0)?$icsid:$cid;
			$query = "SELECT icsf.* FROM #__jevents_icsfile as icsf WHERE ics_id=$icsid";
			$db->setQuery($query);
			$currentICS = $db->loadObjectList();
			if (count($currentICS)>0){
				$currentICS= $currentICS[0];
			}
			else {
				global $mainframe;
				$mainframe->redirect( 'index2.php?option=' . $option. '&task=iCalsubs',"Invalid Ical Details");
			}

			$catid = intval(JRequest::getVar('catid',$currentICS->catid));
			if ($catid<=0 && $currentICS->catid>0){
				$catid = intval($currentICS->catid);
			}			
			$access = intval(JRequest::getVar('access',$currentICS->access));
			if ($access<0 && $currentICS->access>=0){
				$access = intval($currentICS->access);
			}
			$icsLabel = JRequest::getVar('icsLabel',$currentICS->label );
			if ($icsLabel=="" && strlen($currentICS->icsLabel)>=0){
				$icsLabel = $currentICS->icsLabel;
			}

			// This is a native ical - so we are only updating identifiers etc
			if ($currentICS->icaltype==2){
				$ics = new iCalICSFile($db);
				$ics->load($icsid);
				$ics->catid=$catid;
				$ics->access=$access;
				$ics->label=$icsLabel;
				// TODO update access and state
				$ics->updateDetails();
				global $mainframe;
				$mainframe->redirect( 'index2.php?option=' . $option. '&task=iCalsubs',"fred");
			}

			// Note for refresh of re-import I could clear out the existing values in case one or
			// more events in the file have gone - but this plays havoc with Joomfish !!!

			// TODO trap deleted events and remove them after the reload
			// Should come from the form or existing item
			$state = 1;
			if (strlen($currentICS->srcURL)==0) {
				echo "Can only reload URL based subscriptions";
				return;
			}
			$uploadURL = $currentICS->srcURL;

		}
		else {
			$catid = intval(JRequest::getVar('catid',0));
			// Should come from the form or existing item
			$access = 0;
			$state = 1;
			$uploadURL = JRequest::getVar('uploadURL','' );
			$icsLabel = JRequest::getVar('icsLabel','' );
		}
		if ($catid==0){
			// TODO add validation java script
			echo "missing category selection<br/>";
			return;
		}
		// I need a better check and expiry information etc.
		if (strlen($uploadURL)>0){
			$icsFile = iCalICSFile::newICSFileFromURL($uploadURL,$icsid,$catid,$access,$state,$icsLabel);
		}
		else if (isset($_FILES['upload']) && is_array($_FILES['upload']) ) {
			$file 			= $_FILES['upload'];
			if ($file['size']==0 ){//|| !($file['type']=="text/calendar" || $file['type']=="application/octet-stream")){
				echo "bad upload type<br/>";
				return;
			}
			else {
				$icsFile = iCalICSFile::newICSFileFromFile($file,$icsid,$catid,$access,$state,$icsLabel);
			}
		}

		$icsFileid = $icsFile->store();
		global $mainframe;
		$mainframe->redirect( 'index2.php?option=' . $option. '&task=iCalsubs',"ICS FILE IMPORTED");
	}

	function toggleICSPublish(){
		$cfg = & EventsConfig::getInstance();
		$option = $cfg->get("com_componentname", "com_events");
		global $task;
		$cid	= JRequest::getVar(	'cid',	array(0) );
		EventsHelper::forceIntegerArray($cid);
		$db	=& JFactory::getDBO();
		if ($task=="unpublishICS") $state = 0;
		else $state = 1;
		foreach ($cid as $id) {
			$sql = "UPDATE #__jevents_icsfile SET state=$state where ics_id='".$id."'";
			$db->setQuery($sql);
			$db->query();
		}
		global $mainframe;
		$mainframe->redirect( 'index2.php?option=' . $option. '&task=iCalsubs');
	}

	function editICSitem(){
		$cfg = & EventsConfig::getInstance();
		$option = $cfg->get("com_componentname", "com_events");
		$cid	= JRequest::getVar(	'cid',	array(0) );
		EventsHelper::forceIntegerArray($cid);
		if (is_array($cid) && count($cid)>0) $editItem=$cid[0];
		else $editItem=0;

		$item =new stdClass();
		if ($editItem!=null){
			$db	=& JFactory::getDBO();
			$query = "SELECT * FROM #__jevents_icsfile as ics where ics.ics_id=$editItem";

			$db->setQuery( $query );
			$item = null;
			$item = $db->loadObject();
		}
		$this->html_events_admin->editIcsItem($item);
	}


	function deleteics(){
		$cid	= JRequest::getVar(	'cid',	array(0) );
		EventsHelper::forceIntegerArray($cid);
		$cfg = & EventsConfig::getInstance();
		$option = $cfg->get("com_componentname", "com_events");
		$db	=& JFactory::getDBO();
		$icsids = IcalManagement::_deleteICal($option,$cid);
		$query = "DELETE FROM #__jevents_icsfile WHERE ics_id IN ($icsids)";
		$db->setQuery( $query);
		$db->query();

		global $mainframe;
		$mainframe->redirect( 'index2.php?option=' . $option. '&task=iCalsubs',"ICS FILE AND ASSOCICATED EVENTS DELETED");
	}

	/**
	 * Ical Event Functions
	 */


	function manageICalEvents($showUnpublishedICS = false,$showUnpublishedCategories = false){

		global  $mainframe;
		$cfg = & EventsConfig::getInstance();
		$option = $cfg->get("com_componentname", "com_events");
		$db	=& JFactory::getDBO();

		$icsFile	= intval( $mainframe->getUserStateFromRequest("icsFile","icsFile", 0 ));
		$catid		= intval( $mainframe->getUserStateFromRequest( "catidIcalEvents", 'catid', 0 ));
		$limit		= intval( $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', 10 ));
		$limitstart = intval( $mainframe->getUserStateFromRequest( "view{$option}limitstart", 'limitstart', 0 ));
		$search		= $mainframe->getUserStateFromRequest( "search{$option}", 'search', '' );
		$search		= $db->getEscaped( trim( strtolower( $search ) ) );
		$where		= array();

		if( $search ){
			$where[] = "LOWER(a.summary) LIKE '%$search%'";
		}

		if( $catid > 0 ){
			$where[] = "ev.catid='$catid'";
		}

		if ($icsFile>0) {
			$icsFrom = ", #__jevents_icsfile as icsf ";
			$where[] = "\n icsf.ics_id = ev.icsid";
			$where[] = "\n icsf.ics_id = $icsFile";
			if (!$showUnpublishedICS){
				$where[] = "\n icsf.state=1";
			}
		}
		else {
			if (!$showUnpublishedICS){
				$icsFrom = ", #__jevents_icsfile as icsf ";
				$where[] = "\n icsf.ics_id = ev.icsid";
				$where[] = "\n icsf.state=1";
			}
			else {
				$icsFrom = "";
			}
		}


		// get the total number of records
		$query = "SELECT count(*)"
		. "\n FROM (#__jevents_vevent AS ev $icsFrom)"
		. "\n LEFT JOIN #__jevents_rrule as rr ON rr.eventid = ev.ev_id"
		. ( count( $where ) ? "\n WHERE " . implode( ' AND ', $where ) : '' )
		;
		$db->setQuery( $query);
		$total = $db->loadResult();
		echo $db->getErrorMsg();

		if( $limit > $total ) {
			$limitstart = 0;
		}

		$query = "SELECT ev.*, ev.state as evstate, detail.*, g.name AS _groupname "
		."\n , rr.rr_id, rr.freq,rr.rinterval"//,rr.until,rr.untilraw,rr.count,rr.bysecond,rr.byminute,rr.byhour,rr.byday,rr.bymonthday"
		."\n ,MAX(rpt.endrepeat) as endrepeat"
		."\n ,MIN(rpt.startrepeat) as startrepeat"
		. "\n FROM (#__jevents_vevent as ev $icsFrom)"
		. "\n LEFT JOIN #__jevents_vevdetail as detail ON ev.detail_id=detail.evdet_id"
		. "\n LEFT JOIN #__jevents_rrule as rr ON rr.eventid = ev.ev_id"
		. "\n LEFT JOIN #__jevents_repetition as rpt ON rpt.eventid = ev.ev_id"
		. "\n LEFT JOIN #__groups AS g ON g.id = ev.access"
		. ( count( $where ) ? "\n WHERE " . implode( ' AND ', $where ) : '' )
		//. "\n WHERE ev.catid IN(".$this->accessibleCategoryList().")"
		. "\n GROUP BY rpt.eventid"
		. "\n LIMIT $limitstart, $limit";

		$db->setQuery( $query );
		$rows = $db->loadObjectList();
		foreach ($rows as $key=>$val) {
			// set state variable to the event value not the event detail value
			$rows[$key]->state = $rows[$key]->evstate;
			$groupname = $rows[$key]->_groupname;
			$rows[$key]=new jIcalEventRepeat($rows[$key]);
			$rows[$key]->_groupname = $groupname;
		}
		if( $this->_debug ){
			echo '[DEBUG]<br />';
			echo 'query:';
			echo '<pre>';
			echo $query;
			echo '-----------<br />';
			echo 'option "' . $option . '"<br />';
			echo '</pre>';
			//die( 'userbreak - mic ' );
		}

		if ($db->getErrorNum()) {
			echo $db->stderr();
			return false;
		}

		// get list of categories
		$categories= array();
		//$categories[] = JHTML::_('select.option', '0', _CAL_LANG_EVENT_CHOOSE_CATEG );
		$categories[] =JHTML::_('select.option', '-1', '- '._CAL_LANG_EVENT_ALLCAT );

		$query = "SELECT id AS value, title AS text"
		. "\n FROM #__categories"
		. "\n WHERE section='$option'";
		if (!$showUnpublishedCategories) {
			$query .= "\n AND published=1";
		}
		$query .= "\n ORDER BY ordering"
		;
		$db->setQuery( $query );

		$categories = array_merge( $categories, $db->loadObjectList() );

		$clist = JHTML::_('select.genericlist', $categories, 'catid', 'class="inputbox" size="1" onchange="document.adminForm.submit();"', 'value', 'text', $catid );


		// get list of ics Files
		$icsfiles = array();
		//$icsfiles[] =  JHTML::_('select.option', '0', "Choose ICS FILE" );
		$icsfiles[] = JHTML::_('select.option', '-1', "- ALL ICS FILES");

		$query = "SELECT ics.ics_id as value, ics.label as text FROM #__jevents_icsfile as ics ";
		if (!$showUnpublishedICS){
			$query .= " WHERE ics.state=1";
		}

		$db->setQuery( $query );
		$result = $db->loadObjectList() ;

		$icsfiles = array_merge( $icsfiles, $result);
		$icslist = JHTML::_('select.genericlist', $icsfiles, 'icsFile', 'class="inputbox" size="1" onchange="document.adminForm.submit();"', 'value', 'text', $icsFile );

		/*$section = new mosSection( $db );
		$section->load( $sectionid );
		*/
		include_once( 'includes/pageNavigation.php' );
		$pageNav = new JPagination( $total, $limitstart, $limit  );

		$catData = getCategoryData();
		$this->html_events_admin->showICalEvents( $rows, $search, $pageNav, $option, $clist, $icslist);
	}

	function editICalItem($id=0){
		$cid	= JRequest::getVar(	'cid',	array(0) );
		EventsHelper::forceIntegerArray($cid);
		$cfg = & EventsConfig::getInstance();
		$option = $cfg->get("com_componentname", "com_events");
		if ($id==0){
			if (is_array($cid) && count($cid)>0) $id=$cid[0];
			else $id=0;
		}
		$this->html_events_admin->editIcalItem($option,$id);
	}

	function deleteicalEvent() {
		$cid	= JRequest::getVar(	'cid',	array(0) );
		EventsHelper::forceIntegerArray($cid);
		$cfg = & EventsConfig::getInstance();
		$option = $cfg->get("com_componentname", "com_events");
		//		if (is_array($cid) && count($cid)>0) $delItem=$cid[0];
		//		else $delItem=0;
		$db	=& JFactory::getDBO();
		$ids = IcalManagement::_deleteICalEventById($option,$cid);
		global $mainframe;
		$mainframe->redirect( 'index2.php?option=' . $option. '&task=iCalevents',"ICal Event deleted");
	}

	function saveIcalEvent($array="") {
		if (!is_array($array)){
			//$array=$_REQUEST;
			// JREQUEST_ALLOWHTML requires at least Joomla 1.5 svn9979 (past 1.5 stable)
			$array = JRequest::get('request', JREQUEST_ALLOWHTML);
		}

		$cfg = & EventsConfig::getInstance();
		$option = $cfg->get("com_componentname", "com_events");
		$db	=& JFactory::getDBO();
		$user =& JFactory::getUser();
		static $weekdayMap=array("SU"=>0,"MO"=>1,"TU"=>2,"WE"=>3,"TH"=>4,"FR"=>5,"SA"=>6);
		static $weekdayReverseMap=array("SU","MO","TU","WE","TH","FR","SA");

		$cfg = & EventsConfig::getInstance();

		// TODO do error and hack checks here
		$ev_id = intval(JArrayHelper::getValue( $array,  "ev_id",0));

		$data = array();

		// TODO add UID to edit form
		$data["UID"]				= JArrayHelper::getValue( $array,  "uid",md5(uniqid(rand(),true)));

		$data["X-EXTRAINFO"]	= JArrayHelper::getValue( $array,  "extra_info","");
		$data["LOCATION"]		= JArrayHelper::getValue( $array,  "location","");
		$data["allDayEvent"]	= JArrayHelper::getValue( $array,  "allDayEvent","off");
		$data["CONTACT"]		= JArrayHelper::getValue( $array,  "contact_info","");
		$data["DESCRIPTION"]	= JArrayHelper::getValue( $array,  "content","");
		$data["publish_down"]	= JArrayHelper::getValue( $array,  "publish_down","2006-12-12");
		$data["publish_up"]		= JArrayHelper::getValue( $array,  "publish_up","2006-12-12");
		$interval 				= JArrayHelper::getValue( $array,  "rinterval",1);
		$data["SUMMARY"]		= JArrayHelper::getValue( $array,  "title","");

		$ics_id				= JArrayHelper::getValue( $array,  "ics_id",0);

		if ($data["allDayEvent"]=="on"){
			$start_time="00:00";
		}
		else $start_time			= JArrayHelper::getValue( $array,  "start_time","08:00");
		$publishstart		= $data["publish_up"] . ' ' . $start_time . ':00';
		$data["DTSTART"]	= strtotime( $publishstart );

		if ($data["allDayEvent"]=="on"){
			$end_time="00:00";
		}
		else $end_time 			= JArrayHelper::getValue( $array,  "end_time","15:00");
		$publishend		= $data["publish_down"] . ' ' . $end_time . ':00';

		$data["DTEND"]		= strtotime( $publishend );
		// iCal for whole day uses 00:00:00 on the next day JEvents uses 23:59:59 on the same day
		list ($h,$m,$s) = explode(":",$end_time . ':00');
		if (($h+$m+$s)==0 && $data["allDayEvent"]=="on" && $data["DTEND"]>$data["DTSTART"]) {
			$publishend = strftime('%Y-%m-%d 23:59:59',($data["DTEND"]-86400));
			$data["DTEND"]		= strtotime( $publishend );
		}

		$freq = JArrayHelper::getValue( $array,  "freq","NONE");
		if ($freq!="NONE") {
			$rrule = array();
			$rrule["FREQ"]	= $freq;
			$countuntil		= JArrayHelper::getValue( $array,  "countuntil","count");
			if ($countuntil=="count" ){
				$count 			= intval(JArrayHelper::getValue( $array,  "count",1));
				if ($count<=0) $count=1;
				$rrule["COUNT"] = $count;
			}
			else {
				$until			= JArrayHelper::getValue( $array,  "until",$data["publish_down"]);
				$rrule["UNTIL"] = strtotime($until." 00:00:00");
			}
			$rrule["INTERVAL"] = $interval;
		}

		$whichby			= JArrayHelper::getValue( $array,  "whichby","bd");

		switch ($whichby){
			case "byd":
				$byd_direction		= JArrayHelper::getValue( $array,  "byd_direction","off")=="off"?"+":"-";
				$byyearday 			= JArrayHelper::getValue( $array,  "byyearday","");
				$rrule["BYYEARDAY"] = $byd_direction.$byyearday;
				break;
			case "bm":
				$bm_direction		= JArrayHelper::getValue( $array,  "bm_direction","off")=="off"?"+":"-";
				$bymonth			= JArrayHelper::getValue( $array,  "bymonth","");
				$rrule["BYMONTH"] 	= $bymonth;
				break;
			case "bwn":
				$bwn_direction		= JArrayHelper::getValue( $array,  "bwn_direction","off")=="off"?"+":"-";
				$byweekno			= JArrayHelper::getValue( $array,  "byweekno","");
				$rrule["BYWEEKNO"] 	= $bwn_direction.$byweekno;
				break;
			case "bmd":
				$bmd_direction		= JArrayHelper::getValue( $array,  "bmd_direction","off")=="off"?"+":"-";
				$bymonthday			= JArrayHelper::getValue( $array,  "bymonthday","");
				$rrule["BYMONTHDAY"]= $bmd_direction.$bymonthday;
				break;
			case "bd":
				$bd_direction		= JArrayHelper::getValue( $array,  "bd_direction","off")=="off"?"+":"-";
				$weekdays			= JArrayHelper::getValue( $array,  "weekdays",array());
				$weeknums			= JArrayHelper::getValue( $array,  "weeknums",array());
				$byday		= "";
				if (count($weeknums)==0){
					// special case for weekly repeats which don't specify eeek of a month
					foreach ($weekdays as $wd) {
						if (strlen($byday)>0) $byday.=",";
						$byday .= $weekdayReverseMap[$wd];
					}
				}
				foreach ($weeknums as $week){
					foreach ($weekdays as $wd) {
						if (strlen($byday)>0) $byday.=",";
						$byday .= $bd_direction.$week.$weekdayReverseMap[$wd];
					}
				}
				$rrule["BYDAY"] = $byday;
				break;
		}

		$data["RRULE"]	= $rrule;

		global $mainframe;
		include_once(JPATH_SITE."/components/$option/libraries/iCalImport.php");
		$vevent = iCalEvent::iCalEventFromData($data);
		$vevent->catid = JArrayHelper::getValue( $array,  "catid",0);
		// if catid is empty then use the catid of the ical calendar
		if ($vevent->catid<=0){
			$query = "SELECT catid FROM #__jevents_icsfile WHERE ics_id=$ics_id";
			$db->setQuery( $query);
			$vevent->catid = $db->loadResult();
		}
		$vevent->access = JArrayHelper::getValue( $array,  "access",0);
		$vevent->state =  intval(JArrayHelper::getValue( $array,  "state",0));

		// FRONT END AUTO PUBLISHING CODE
		// Always unpublish if no Publisher otherwise publish automatically
		if (!$mainframe->isAdmin()){
			$mapping = array('registered'=>1,'author'=>2,'editor'=>3,'publisher'=>4,'manager'=>5,'administrator'=>6,'super administrator'=>7);
			$frontendPublish = $cfg->get('com_frontendPublish');
			if(array_key_exists( strtolower( $user->usertype ),$mapping)){
				$frontendPublish = ($frontendPublish <= $mapping[strtolower( $user->usertype )]);
			}
			else {
				$frontendPublish=false;
			}
			if ($frontendPublish){
				$vevent->state = 1;
			}else{
				$vevent->state = 0;
			}
		}


		$vevent->icsid = $ics_id;
		if ($ev_id>0){
			$vevent->ev_id=$ev_id;
		}
		$vevent->store();

		$repetitions = $vevent->getRepetitions(true);
		$vevent->storeRepetitions();

		if ($mainframe->isAdmin()){
			global $mainframe;
			$mainframe->redirect( 'index2.php?option=' . $option . '&task=iCalevents',"IcalEvent Saved");
		}
	}

	function _deleteICal($option,$cid){
		$db	=& JFactory::getDBO();
		$icsids = implode(",",$cid);

		$query = "SELECT ev_id FROM #__jevents_vevent WHERE icsid IN ($icsids)";
		$db->setQuery( $query);
		$veventids = $db->loadResultArray();
		$veventidstring = implode(",",$veventids);

		// TODO the ruccurences should take care of all of these??
		// This would fail if all recurrances have been 'adjusted'
		$query = "SELECT DISTINCT (eventdetail_id) FROM #__jevents_repetition WHERE eventid IN ($veventidstring)";
		$db->setQuery( $query);
		$detailids = $db->loadResultArray();
		$detailidstring = implode(",",$detailids);

		$query = "DELETE FROM #__jevents_rrule WHERE eventid IN ($veventidstring)";
		$db->setQuery( $query);
		$db->query();

		$query = "DELETE FROM #__jevents_repetition WHERE eventid IN ($veventidstring)";
		$db->setQuery( $query);
		$db->query();

		$query = "DELETE FROM #__jevents_vevdetail WHERE evdet_id IN ($detailidstring)";
		$db->setQuery( $query);
		$db->query();

		$query = "DELETE FROM #__jevents_vevent WHERE icsid IN ($icsids)";
		$db->setQuery( $query);
		$db->query();

		return $icsids;
	}


	function _deleteICalEventById($option,$cid){
		$db	=& JFactory::getDBO();
		$veventidstring = implode(",",$cid);

		// TODO the ruccurences should take care of all of these??
		// This would fail if all recurrances have been 'adjusted'
		$query = "SELECT DISTINCT (eventdetail_id) FROM #__jevents_repetition WHERE eventid IN ($veventidstring)";
		$db->setQuery( $query);
		$detailids = $db->loadResultArray();
		$detailidstring = implode(",",$detailids);

		$query = "DELETE FROM #__jevents_rrule WHERE eventid IN ($veventidstring)";
		$db->setQuery( $query);
		$db->query();

		$query = "DELETE FROM #__jevents_repetition WHERE eventid IN ($veventidstring)";
		$db->setQuery( $query);
		$db->query();

		if (strlen($detailidstring)>0){
			$query = "DELETE FROM #__jevents_vevdetail WHERE evdet_id IN ($detailidstring)";
			$db->setQuery( $query);
			$db->query();
		}

		$query = "DELETE FROM #__jevents_vevent WHERE ev_id IN ($veventidstring)";
		$db->setQuery( $query);
		$db->query();

		return $ids;
	}

	function toggleICalEventPublish(){
		global $task;
		$cid	= JRequest::getVar(	'cid',	array(0) );
		EventsHelper::forceIntegerArray($cid);
		$cfg = & EventsConfig::getInstance();
		$option = $cfg->get("com_componentname", "com_events");
		$db	=& JFactory::getDBO();
		if ($task=="unpublishIcal") $state = 0;
		else $state = 1;
		foreach ($cid as $id) {
			$sql = "UPDATE #__jevents_vevent SET state=$state where ev_id='".$id."'";
			$db->setQuery($sql);
			$db->query();
		}
		global $mainframe;
		$mainframe->redirect( 'index2.php?option=' . $option. '&task=iCalevents');
	}

	function showICalEventRepeats($cid=0, $publishedOnly=true) {
		global $mainframe;
		$cfg = & EventsConfig::getInstance();
		$option = $cfg->get("com_componentname", "com_events");
		$db	=& JFactory::getDBO();
		if (is_array($cid) && count($cid)>0) $id=$cid[0];
		else $id=$cid;

		$limit		= intval( $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', 10 ));
		$limitstart = intval( $mainframe->getUserStateFromRequest( "view{$option}limitstart", 'limitstart', 0 ));

		$query = "SELECT count(rpt.rp_id)"
		. "\n FROM (#__jevents_vevent as ev, #__jevents_icsfile as icsf)"
		. "\n LEFT JOIN #__jevents_repetition as rpt ON rpt.eventid = ev.ev_id"
		. "\n LEFT JOIN #__jevents_vevdetail as det ON det.evdet_id = rpt.eventdetail_id"
		. "\n LEFT JOIN #__jevents_rrule as rr ON rr.eventid = ev.ev_id"
		. "\n WHERE ev.catid IN(".$this->accessibleCategoryList().")"
		. "\n AND ev.ev_id=".$id
		. ($publishedOnly?"\n AND ev.state=1":"")
		. "\n AND icsf.ics_id=ev.icsid AND icsf.state=1";
		$db->setQuery( $query);
		$total = $db->loadResult();

		if( $limit > $total ) {
			$limitstart = 0;
		}

		$query = "SELECT ev.*, rpt.*, rr.*, det.*"
		. "\n , YEAR(rpt.startrepeat) as yup, MONTH(rpt.startrepeat ) as mup, DAYOFMONTH(rpt.startrepeat ) as dup"
		. "\n , YEAR(rpt.endrepeat  ) as ydn, MONTH(rpt.endrepeat   ) as mdn, DAYOFMONTH(rpt.endrepeat   ) as ddn"
		. "\n , HOUR(rpt.startrepeat) as hup, MINUTE(rpt.startrepeat ) as minup, SECOND(rpt.startrepeat ) as sup"
		. "\n , HOUR(rpt.endrepeat  ) as hdn, MINUTE(rpt.endrepeat   ) as mindn, SECOND(rpt.endrepeat   ) as sdn"
		. "\n FROM (#__jevents_vevent as ev, #__jevents_icsfile as icsf)"
		. "\n LEFT JOIN #__jevents_repetition as rpt ON rpt.eventid = ev.ev_id"
		. "\n LEFT JOIN #__jevents_vevdetail as det ON det.evdet_id = rpt.eventdetail_id"
		. "\n LEFT JOIN #__jevents_rrule as rr ON rr.eventid = ev.ev_id"
		. "\n WHERE ev.catid IN(".$this->accessibleCategoryList().")"
		. "\n AND ev.ev_id=".$id
		. ($publishedOnly?"\n AND ev.state=1":"")
		. "\n AND icsf.ics_id=ev.icsid AND icsf.state=1"
		. "\n ORDER BY rpt.startrepeat"
		. "\n LIMIT $limitstart, $limit";

		$db->setQuery( $query );
		$icalrows = $db->loadObjectList();
		$icalcount = count($icalrows);
		for( $i = 0; $i < $icalcount ; $i++ ){
			// convert rows to jIcalEvents
			$icalrows[$i] = new jIcalEventRepeat($icalrows[$i]);
		}

		include_once( 'includes/pageNavigation.php' );
		$pageNav = new JPagination( $total, $limitstart, $limit  );

		$this->html_events_admin->showICalRepetitions( $icalrows, $pageNav, $option);

	}

	function editICalRepeat($cid){
		global $mainframe;
		$cfg = & EventsConfig::getInstance();
		$option = $cfg->get("com_componentname", "com_events");
		$db	=& JFactory::getDBO();
		if (is_array($cid) && count($cid)>0) $id=$cid[0];
		else $id=$cid;

		$db	=& JFactory::getDBO();
		$query = "SELECT rpt.eventid"
		. "\n FROM (#__jevents_vevent as ev, #__jevents_icsfile as icsf)"
		. "\n LEFT JOIN #__jevents_repetition as rpt ON rpt.eventid = ev.ev_id"
		. "\n LEFT JOIN #__jevents_vevdetail as det ON det.evdet_id = rpt.eventdetail_id"
		. "\n LEFT JOIN #__jevents_rrule as rr ON rr.eventid = ev.ev_id"
		. "\n WHERE ev.catid IN(".$this->accessibleCategoryList().")"
		. "\n AND rpt.rp_id=".$id
		. "\n AND icsf.ics_id=ev.icsid AND icsf.state=1";
		$db->setQuery( $query);
		$ev_id = $db->loadResult();
		if ($ev_id==0 || $id==0){
			global $mainframe;
			$mainframe->redirect( 'index2.php?option=' . $option. '&task=icalrepeats&cid[]='.$ev_id,"1Cal rpt Deleted");		}
			$this->html_events_admin->editIcalItem($option,$ev_id,$id);
	}


	function deleteICalRepeat($cid){
		// TODO This should deal with arrays to be deleted
		global $mainframe;
		$cfg = & EventsConfig::getInstance();
		$option = $cfg->get("com_componentname", "com_events");

		$db	=& JFactory::getDBO();
		if (is_array($cid) && count($cid)>0) $id=$cid[0];
		else $id=$cid;

		$query = "SELECT eventid, eventdetail_id FROM #__jevents_repetition WHERE rp_id=$id";
		$db->setQuery( $query);
		$data = null;
		$data = $db->loadObject();

		$query = "SELECT detail_id FROM #__jevents_vevent WHERE ev_id=$data->eventid";
		$db->setQuery( $query);
		$eventdetailid = $db->loadResult();


		if ($eventdetailid != $data->eventdetail_id){
			$query = "DELETE FROM #__jevents_vevdetail WHERE evdet_id = ".$data->eventdetail_id;
			$db->setQuery( $query);
			$db->query();
		}

		$query = "DELETE FROM #__jevents_repetition WHERE rp_id=$id";
		$db->setQuery( $query);
		$db->query();

		global $mainframe;
		$mainframe->redirect( 'index2.php?option=' . $option. '&task=icalrepeats&cid[]='.$data->eventid,"ICal rpt Deleted");
	}

	function saveICalRepeat() {
		$cfg = & EventsConfig::getInstance();
		$option = $cfg->get("com_componentname", "com_events");
		$rp_id = intval(JRequest::getVar( "rp_id","0"));
		$cid = JRequest::getVar( "cid",array());
		if (count($cid)>0) $ev_id=intval($cid[0]);
		if ($rp_id==0){
			global $mainframe;
			$mainframe->redirect( 'index2.php?option=' . $option. '&task=icalrepeats&cid[]='.$ev_id,"1Cal rpt NOT SAVED");
		}
		$db	=& JFactory::getDBO();
		include_once(JPATH_SITE."/components/$option/libraries/iCalImport.php");
		$rpt = new iCalRepetition($db);
		$rpt->load($rp_id);

		$query = "SELECT detail_id FROM #__jevents_vevent WHERE ev_id=$rpt->eventid";
		$db->setQuery( $query);
		$eventdetailid = $db->loadResult();

		$data["UID"]				= JRequest::getVar( "uid",md5(uniqid(rand(),true)));

		$data["LOCATION"]		= JRequest::getVar( "adresse_info","");
		$data["allDayEvent"]	= JRequest::getVar( "allDayEvent","off");
		$data["CONTACT"]		= JRequest::getVar( "contact_info","");
		// allow raw HTML (mask =2)
		$data["DESCRIPTION"]	= JRequest::getVar( "content","", 'request',  'html', 2);
		$data["publish_down"]	= JRequest::getVar( "publish_down","2006-12-12");
		$data["publish_up"]		= JRequest::getVar( "publish_up","2006-12-12");
		$interval 				= JRequest::getVar( "rinterval",1);
		$data["SUMMARY"]		= JRequest::getVar( "title","");

		$ics_id				= JRequest::getVar( "ics_id",0);

		if ($data["allDayEvent"]=="on"){
			$start_time="00:00";
		}
		else $start_time			= JRequest::getVar( "start_time","08:00");
		$publishstart		= $data["publish_up"] . ' ' . $start_time . ':00';
		$data["DTSTART"]	= strtotime( $publishstart );

		if ($data["allDayEvent"]=="on"){
			$end_time="23:59";
			$publishend		= $data["publish_down"] . ' ' . $end_time . ':59';
		}
		else {
			$end_time 			= JRequest::getVar( "end_time","15:00");
			$publishend		= $data["publish_down"] . ' ' . $end_time . ':00';
		}

		$data["DTEND"]		= strtotime( $publishend );
		// iCal for whole day uses 00:00:00 on the next day JEvents uses 23:59:59 on the same day
		list ($h,$m,$s) = explode(":",$end_time . ':00');
		if (($h+$m+$s)==0 && $data["allDayEvent"]=="on" && $data["DTEND"]>$data["DTSTART"]) {
			$publishend = strftime('%Y-%m-%d 23:59:59',($data["DTEND"]-86400));
			$data["DTEND"]		= strtotime( $publishend );
		}

		$detail = iCalEventDetail::iCalEventDetailFromData($data);

		// if we already havea unique event detail then edit this one!
		if ($eventdetailid != $rpt->eventdetail_id){
			$detail->evdet_id = $rpt->eventdetail_id;
		}

		$detail->store();

		// populate rpt with data
		//$start = strtotime($data["publish_up"] . ' ' . $start_time . ':00');
		//$end = strtotime($data["publish_down"] . ' ' . $end_time . ':00');
		$start = $data["DTSTART"];
		$end = $data["DTEND"];
		$rpt->startrepeat = strftime('%Y-%m-%d %H:%M:%S',$start);
		$rpt->endrepeat = strftime('%Y-%m-%d %H:%M:%S',$end);

		$rpt->duplicatecheck = md5($rpt->eventid . $start );
		$rpt->eventdetail_id = $detail->evdet_id;
		$rpt->rp_id = $rp_id;
		$rpt->store();

		global $mainframe;
		if ($mainframe->isAdmin()){
			global $mainframe;
			$mainframe->redirect( 'index2.php?option=' . $option. '&task=view_detail&agidcid[]='.$ev_id,"ICal rpt and new details saved");
		}
	}

}
?>
