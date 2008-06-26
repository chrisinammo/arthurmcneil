<?php
/**
 * Events Component for Joomla 1.5.x
 *
 * @version     $Id: controller.php 961 2008-02-16 10:57:30Z geraint $
 * @package     Events
 * @copyright   Copyright (C) 2006-2007 JEvents Project Group
 * @copyright   Copyright (C) 2000 - 2003 Eric Lamette, Dave McDonnelle
 * @licence     http://www.gnu.org/copyleft/gpl.html
 * @link        http://joomlacode.org/gf/project/jevents
 */

defined( '_JEXEC' ) or die( 'Restricted access' );

/**
 * JEvents Component Controller
 *
 */
class JEventsController extends JController {
	var $_cache;

	// this is a pseudo constructor - I leave the constructor alone!
	function setupController(){
		$cfg = & EventsConfig::getInstance();
		$option = $cfg->get("com_componentname");
		$cfg = & EventsConfig::getInstance();
		$this->registerDefaultTask($cfg->get('com_startview'));

		$this->registerTask("view_week","view_week");
		$this->registerTask("view_month","view_month");

		// load language constants
		EventsHelper::loadLanguage('front');

		if (strpos(_CAL_LEGEND_ALL_CATEGORIES,"XXXX")!==false){
			echo "<div id='misstrans' style='position:absolute;top:10px;left:10px;width:200px;padding:10px;border:solid 1px black;background-color:yellow;color:black;font-weight:bold'><div style='cursor:pointer;border:solid 1px black;float:right;margin:-7px -7px 4px 5px;padding:2px;' onclick='document.getElementById(\"misstrans\").style.display=\"none\";'>Hide X</div>The Translation of the JEvents Component in this language is incomplete - please consider completing the translation and contributing it to the project</div>";
		}

		global $mainframe;
		// include the appropraite VIEW - this should be based on config and/or URL?
		$jEventsView = EventsViewer::viewName("front");
		$cssHTML = '<link href="' . JURI::root() . 'components/' . $option .'/layouts/'.$jEventsView. '/events_css.css" rel="stylesheet" type="text/css" />' . "\n";
		$mainframe->addCustomHeadTag( $cssHTML );

		// Should make RSS configurable
		$rssLink = JRoute::_("index.php?option=".$option."&task=rss&feed=RSS2.0&no_html=1");
		$rss = '<link href="' .$rssLink .'"  rel="alternate"  type="application/rss+xml" title="CONFIG THIS" />'. "\n";
		$mainframe->addCustomHeadTag( $rss );


		$this->_cache =& jeventsCache::getCache( $option );
	}

	function & getCache(){
		return $this->_cache;
	}

	function view_day(){
		$task=$this->_task;

		$cfg = & EventsConfig::getInstance();
		$option = $cfg->get("com_componentname");
		list($year,$month,$day) = EventsHelper::getYMD();
		$Itemid	= EventsHelper::getItemid();
		//$this->_cache->call( 'jevController->viewdayUncached', $Itemid, $year, $month, $day, $option, $task );
		$this->_cache->call( 'JEventsController::_viewdayUncached', $Itemid, $year, $month, $day, $option, $task );
	}

	function _viewdayUncached( $Itemid, $year, $month, $day, $option, $task ){
		$JEventsViewClass = EventsViewer::viewClassName("front");
		$htmlevents = new $JEventsViewClass();
		$htmlevents->view_day( $Itemid, $year, $month, $day, $option, $task );
	}

	function view_week(){
		$task=$this->_task;
		$cfg = & EventsConfig::getInstance();
		$option = $cfg->get("com_componentname");
		list($year,$month,$day) = EventsHelper::getYMD();
		$Itemid	= EventsHelper::getItemid();
		//$this->_cache->call( 'jevController->viewweekUncached', $Itemid, $year, $month, $day, $option, $task );
		$this->_cache->call( 'JEventsController::_viewweekUncached', $Itemid, $year, $month, $day, $option, $task );
	}

	function _viewweekUncached( $Itemid, $year, $month, $day, $option, $task ){
		$JEventsViewClass = EventsViewer::viewClassName("front");
		$htmlevents = new $JEventsViewClass();
		$htmlevents->view_week($Itemid, $year, $month, $day, $option, $task );
	}

	function view_month(){
		$task=$this->_task;
		$cfg = & EventsConfig::getInstance();
		$option = $cfg->get("com_componentname");
		list($year,$month,$day) = EventsHelper::getYMD();
		$Itemid	= EventsHelper::getItemid();
		//$this->_cache->call('jevController->viewMonthUncached', $Itemid, $year, $month, $day, $option, $task);
		$this->_cache->call( 'JEventsController::_viewMonthUncached', $Itemid, $year, $month, $day, $option, $task);

	}

	function _viewMonthUncached( $Itemid, $year, $month, $day, $option, $task ){
		$JEventsViewClass = EventsViewer::viewClassName("front");
		$htmlevents = new $JEventsViewClass();
		$htmlevents->viewMonth($Itemid, $year, $month, $day, $option, $task );
	}

	function view_last(){
		$task=$this->_task;
		$cfg = & EventsConfig::getInstance();
		$option = $cfg->get("com_componentname");
		list($year,$month,$day) = EventsHelper::getYMD();
		$Itemid	= EventsHelper::getItemid();

		//$this->_cache->call( 'jevController->viewlastUncached', $Itemid, $year, $month, $day, $option, $task);
		$this->_cache->call( 'JEventsController::_viewlastUncached', $Itemid, $year, $month, $day, $option, $task);
	}

	function _viewlastUncached( $Itemid, $year, $month, $day, $option, $task ){
		$JEventsViewClass = EventsViewer::viewClassName("front");
		$htmlevents = new $JEventsViewClass();
		$htmlevents->view_last( $Itemid, $year, $month, $day, $option, $task );
	}

	function view_year() {
		$task=$this->_task;
		$cfg = & EventsConfig::getInstance();
		$option = $cfg->get("com_componentname");
		$limitstart = intval( JRequest::getVar( 	'limitstart', 	0 ) );
		$limit 	= intval( JRequest::getVar( 	'limit', 		'' ) );
		list($year,$month,$day) = EventsHelper::getYMD();
		$Itemid	= EventsHelper::getItemid();

		//$this->_cache->call( 'jevController->viewyearUncached', $Itemid, $year, $month, $day, $option, $task, $limit, $limitstart);
		$this->_cache->call( 'JEventsController::_viewyearUncached', $Itemid, $year, $month, $day, $option, $task, $limit, $limitstart);
	}

	function _viewyearUncached( $Itemid, $year, $month, $day, $option, $task ,$limit, $limitstart ){
		$JEventsViewClass = EventsViewer::viewClassName("front");
		$htmlevents = new $JEventsViewClass();
		$htmlevents->viewYear( $Itemid, $year, $month, $day, $option, $task ,$limit, $limitstart );
	}


	function view_detail(){
		$agid = EventsHelper::getAGID();
		$jevtype = JRequest::getVar('jevtype',"jevent" );
		$task=$this->_task;
		$cfg = & EventsConfig::getInstance();
		$option = $cfg->get("com_componentname");
		$pop = intval(JRequest::getVar( 'pop', 0 ));
		list($year,$month,$day) = EventsHelper::getYMD();
		$Itemid	= EventsHelper::getItemid();

		//$this->_cache->call( 'jevController->viewdetailUncached', $Itemid, $year, $month, $day, $option, $task, $pop, $agid, $jevtype );
		$this->_cache->call( 'JEventsController::_viewdetailUncached', $Itemid, $year, $month, $day, $option, $task, $pop, $agid, $jevtype );
	}

	function _viewdetailUncached($Itemid, $year, $month, $day, $option, $task, $pop, $agid, $jevtype ){
		$JEventsViewClass = EventsViewer::viewClassName("front");
		$htmlevents = new $JEventsViewClass();
		$htmlevents->view_detail( $Itemid, $year, $month, $day, $option, $task, $pop, $agid, $jevtype );
	}

	function view_cat(){
		$task=$this->_task;
		$cfg = & EventsConfig::getInstance();
		$option = $cfg->get("com_componentname");
		$catid	= intval( JRequest::getVar(	'catid', 0 ));
		$limitstart = intval( JRequest::getVar( 	'limitstart', 	0 ) );
		$limit 	= intval( JRequest::getVar( 	'limit', 		'' ) );
		list($year,$month,$day) = EventsHelper::getYMD();
		$Itemid	= EventsHelper::getItemid();

		//$this->_cache->call( 'jevController->viewcatUncached', $Itemid, $year, $month, $day, $option, $task, $catid, $limit, $limitstart );
		$this->_cache->call( 'JEventsController::_viewcatUncached', $Itemid, $year, $month, $day, $option, $task, $catid, $limit, $limitstart );
	}

	function _viewcatUncached( $Itemid, $year, $month, $day, $option, $task, $catid, $limit, $limitstart ){
		$JEventsViewClass = EventsViewer::viewClassName("front");
		$htmlevents = new $JEventsViewClass();
		$htmlevents->view_cat( $Itemid, $year, $month, $day, $option, $task, $catid, $limit, $limitstart );
	}

	function view_search(){
		$task=$this->_task;
		$cfg = & EventsConfig::getInstance();
		$option = $cfg->get("com_componentname");
		list($year,$month,$day) = EventsHelper::getYMD();
		$Itemid	= EventsHelper::getItemid();

		$JEventsViewClass = EventsViewer::viewClassName("front");
		$htmlevents = new $JEventsViewClass();
		$htmlevents->view_search($Itemid, $year, $month, $day, $option, $task );
	}

	function mod_cal(){

		$modid = intval((JRequest::getVar('modid', 0)));
		if ($modid<=0){
			echo "<script>alert('bad mod id');</script>";
			return;
		}
		$cfg = & EventsConfig::getInstance();
		$jev_component_name  = $cfg->get("com_componentname");
		$file = JPATH_SITE . "/components/$jev_component_name/includes/modutils.php";
		if (file_exists($file) ) {
			include_once($file);
		}
		// load language constants
		EventsHelper::loadLanguage('modcal');

		list($year,$month,$day) = EventsHelper::getYMD();

		$user =& JFactory::getUser();
		$query = "SELECT id, params"
		. "\n FROM #__modules AS m"
		. "\n WHERE m.published = 1"
		. "\n AND m.id = ". $modid
		. "\n AND m.access <= ". (int) $user->gid
		. "\n AND m.client_id != 1";
		$db	=& JFactory::getDBO();
		$db->setQuery( $query );
		$modules = $db->loadObjectList();
		if (count($modules)<=0){
			if (!$modid<=0){
				echo "<script>alert('bad mod id');</script>";
				return;
			}
		}
		$params = new JParameter( $modules[0]->params );

		// include the appropraite VIEW - this should be based on config and/or URL?
		$JEventsModCalClass = EventsViewer::viewClassName("mod_cal");
		$jeventCalObject = & new $JEventsModCalClass($params);
		?>
		<script language="javascript">
		function doit(){
			var sillydiv=document.getElementById('silly');
			parent.navLoaded(sillydiv,<?php echo $modid;?>);
		}
		window.onload=doit;
		</script>
		<?php
		echo "<div id='silly'>";
		echo $jeventCalObject->getAjaxCal($modid,$month,$year);
		echo "</div>";
	}

	function search(){
		$task=$this->_task;
		$cfg = & EventsConfig::getInstance();
		$option = $cfg->get("com_componentname");
		$db	= & JFactory::getDBO();
		$keyword = $db->getEscaped(JRequest::getVar( 'keyword', '' ));
		$limitstart = intval( JRequest::getVar( 	'limitstart', 	0 ) );
		$limit 	= intval( JRequest::getVar( 	'limit', 		'' ) );
		list($year,$month,$day) = EventsHelper::getYMD();
		$Itemid	= EventsHelper::getItemid();

		$JEventsViewClass = EventsViewer::viewClassName("front");
		$htmlevents = new $JEventsViewClass();
		$htmlevents->searchResults($Itemid, $year, $month, $day, $option, $task,$keyword, $limit, $limitstart   );
	}

	function vCalendar(){
		$agid = EventsHelper::getAGID();
		$cfg = & EventsConfig::getInstance();
		$option = $cfg->get("com_componentname");
		$user =& JFactory::getUser();
		$db	=& JFactory::getDBO();
		// No use for ical events!
		$classname = strtolower((JRequest::getVar('class', 'jeventcal')));

		if ($classname!="jeventcal"){
			// single recurrence flag?
			$sr = intval((JRequest::getVar('sr', '0')));
			$Itemid	= EventsHelper::getItemid();
			global $mainframe;
			$mainframe->redirect(JRoute::_("index.php?option=$option&task=view_detail&agid=$agid&jevtype=icaldb&Itemid=$Itemid", false), "Sorry - I know its ironic but I can&apos;t yet export ICal events!");
		}
		include_once(dirname(__FILE__)."/libraries/vCal.class.php");

		$sql = "SELECT
				UNIX_TIMESTAMP(ev.publish_up) AS dtstart , 
				UNIX_TIMESTAMP(ev.publish_down) AS dtend, 
				ev.*, 
				b.name AS category FROM #__categories AS b, #__events AS ev
                WHERE ev.catid = b.id AND b.access <= $user->gid AND
                ev.access <= $user->gid AND ev.state = '1'";
		if ($agid > 0) {
			$sql .= " AND ev.id = '$agid' ";
		}

		$db->setQuery($sql);
		$detevents = $db->loadObjectList();

		$filename = "CalendarEvent_" . date('d-M-Y'). '.ics';
		$showBR = intval(JRequest::getVar('showBR', '1'));
		$cal = new vCal($filename);

		foreach ($detevents as $event) {
			$cal->addEvent($event);
		}

		$output = $cal->getVCal();
		if ($showBR){
			echo $output;
		}
		else {
			if ( $output <> "" ) {
				// dump anything in the buffer
				@ob_end_clean();
				ob_start();

				header('Content-Type: text/x-vCalendar');
				/**
			 * This should be based on paramaters
			 */
				header('Expires: Fri, 29 Sep 2006 13:25:13 GMT');
				$useragent 	= JArrayHelper::getValue(  $_SERVER, 'HTTP_USER_AGENT', '' );
				if (strpos(strtolower($useragent),"msie")!==false){
					header('Content-Disposition: inline; filename="' . $filename. '"');
					//header('Cache-Control: must-revalidate, post-check=0,pre-check=0');
					header('Pragma: public');
				} else {
					header('Content-Disposition: attachment; filename="'. $filename . '"');
					header('Pragma: no-cache');
				}
				echo $output;
				ob_end_flush();
				ob_start();
			}
			// do no more
			exit;
		}
	}

	function rss() {
		include_once( dirname(__FILE__)."/libraries/eventsrss.php");
		feedOpenEvents(true);
	}

	// ICal based admin and editing methods
	function editIcalEvent() {
		$agid = EventsHelper::getAGID();
		$id	= intval( JRequest::getVar('id',0 ) );
		$cfg = & EventsConfig::getInstance();
		$option = $cfg->get("com_componentname");
		$is_event_editor = EventsHelper::isEventEditor();
		$Itemid	= EventsHelper::getItemid();

		global $mainframe;
		// force event type
		$jevtype = "icaldb";
		$user =& JFactory::getUser();
		if( $is_event_editor && !( strtolower( $user->usertype ) == '' )){
			include_once( dirname(__FILE__)."/libraries/frontendAdministration.php");
			// TODO check the appropriate ID for this
			if ($id==0 && $agid!=0){
				$id=$agid;
			}
			editIcalEvent($id);
		} else {
			$returnlink = JRoute::_( 'index.php?option=' . $option . '&Itemid=' . $Itemid  . '&task=admin', false);
			global $mainframe;
			$mainframe->redirect( $returnlink, html_entity_decode( _CAL_LANG_NOPERMISSION ));
		}
	}

	function saveIcalEvent(){
		$jevtype = JRequest::getVar('jevtype',"jevent" );
		$cfg = & EventsConfig::getInstance();
		$option = $cfg->get("com_componentname");
		$is_event_editor = EventsHelper::isEventEditor();
		$Itemid	= EventsHelper::getItemid();

		global $mainframe;
		$user =& JFactory::getUser();
		if( $is_event_editor && !( strtolower( $user->usertype ) == '' )){
			include_once( dirname(__FILE__)."/libraries/frontendAdministration.php");
			saveIcalEvent();
		} else {
			$returnlink = JRoute::_( 'index.php?option=' . $option . '&Itemid=' . $Itemid  . '&task=admin', false);
			global $mainframe;
			$mainframe->redirect( $returnlink, html_entity_decode( _CAL_LANG_NOPERMISSION ));
		}
	}

	function editIcalRepeat() {
		$agid = EventsHelper::getAGID();
		$cfg = & EventsConfig::getInstance();
		$option = $cfg->get("com_componentname");
		$is_event_editor = EventsHelper::isEventEditor();
		$Itemid	= EventsHelper::getItemid();

		global $mainframe;
		// force event type
		$jevtype = "icaldb";
		$user =& JFactory::getUser();
		if( $is_event_editor && !( strtolower( $user->usertype ) == '' )){
			include_once( dirname(__FILE__)."/libraries/frontendAdministration.php");
			editIcalEventRepeat($agid);
		} else {
			$returnlink = JRoute::_( 'index.php?option=' . $option . '&Itemid=' . $Itemid  . '&task=admin', false);
			global $mainframe;
			$mainframe->redirect( $returnlink, html_entity_decode( _CAL_LANG_NOPERMISSION ));
		}
	}

	function saveIcalRepeat(){
		$jevtype = JRequest::getVar('jevtype',"jevent" );
		$cfg = & EventsConfig::getInstance();
		$option = $cfg->get("com_componentname");
		$is_event_editor = EventsHelper::isEventEditor();
		$Itemid	= EventsHelper::getItemid();

		global $mainframe;
		$user =& JFactory::getUser();
		if( $is_event_editor && !( strtolower( $user->usertype ) == '' )){
			include_once( dirname(__FILE__)."/libraries/frontendAdministration.php");
			saveIcalRepeat();
		} else {
			$returnlink = JRoute::_( 'index.php?option=' . $option . '&Itemid=' . $Itemid  . '&task=admin', false);
			global $mainframe;
			$mainframe->redirect( $returnlink, html_entity_decode( _CAL_LANG_NOPERMISSION ));
		}
	}

	function publishIcal(){
		//TODO write poublishICAL
		echo "Not yet implemented<br/>";
	}

	// Admin and editing methods
	function admin(){
		$task=$this->_task;
		$cfg = & EventsConfig::getInstance();
		$option = $cfg->get("com_componentname");
		$limitstart = intval( JRequest::getVar( 	'limitstart', 	0 ) );
		$limit 	= intval( JRequest::getVar( 	'limit', 		'' ) );
		$is_event_editor = EventsHelper::isEventEditor();
		list($year,$month,$day) = EventsHelper::getYMD();
		$Itemid	= EventsHelper::getItemid();

		$user =& JFactory::getUser();
		if( $is_event_editor ){
			include_once( dirname(__FILE__)."/libraries/frontendAdministration.php");
			if( strtolower( $user->usertype ) == 'administrator' || strtolower( $user->usertype ) == 'super administrator' ) {
				$creator_id = 'ADMIN';
			}else{
				$creator_id = $user->id;
			}
			$JEventsViewClass = EventsViewer::viewClassName("front");
			$htmlevents = new $JEventsViewClass();
			$htmlevents->adminEvents($Itemid, $year, $month, $day, $option, $task,$creator_id, $limit, $limitstart   );
		}else{
			$returnlink = JRoute::_( 'index.php?option=' . $option . '&Itemid=' . $Itemid, false );
			global $mainframe;
			$mainframe->redirect( $returnlink, html_entity_decode( _CAL_LANG_NOPERMISSION ));
		}
	}


	function publish(){
		$id	= intval( JRequest::getVar('id',0 ) );
		$jevtype = JRequest::getVar('jevtype',"jevent" );
		$cfg = & EventsConfig::getInstance();
		$option = $cfg->get("com_componentname");
		$goodexit 		= JRequest::getVar( 			'goodexit', 	0 );
		$is_event_editor = EventsHelper::isEventEditor();
		$Itemid	= EventsHelper::getItemid();

		$user =& JFactory::getUser();
		$cache =& JFactory::getCache($option);
		$cache->clean($option);
		if( $is_event_editor && !( strtolower( $user->usertype ) == '' )){
			include_once( dirname(__FILE__)."/libraries/frontendAdministration.php");
			$row	= listEventsById( $id, 1,$jevtype );  // include unpublished events for publishers and above
			// TODO convert this code to support the object
			$row=$row->data; // ARGH - just for now

			if( strtolower( $user->usertype ) == 'user' || strtolower( $user->usertype ) == '' ){
				if( $row->creator_id != $user->id ){
					$returnlink = JRoute::_( 'index.php?option=' . $option , '&Itemid=' . $Itemid, false );
					global $mainframe;
					$mainframe->redirect( $returnlink, html_entity_decode( _CAL_LANG_NOPERMISSION ));
				}
			}

			if( $goodexit == 1 ){
				publishEvent($row->id);
				$returnlink = JRoute::_( 'index.php?option=' . $option . '&Itemid=' . $Itemid, false );
				global $mainframe;
				$mainframe->redirect( $returnlink, html_entity_decode( _CAL_LANG_ACT_PUBLISHED));
			}
		} else {
			$returnlink = JRoute::_( 'index.php?option=' . $option . '&Itemid=' . $Itemid, false );
			global $mainframe;
			$mainframe->redirect( $returnlink, html_entity_decode( _CAL_LANG_NOPERMISSION ));
		}
	}


	function save(){
		$id	= intval( JRequest::getVar('id',0 ) );
		$jevtype = JRequest::getVar('jevtype',"jevent" );
		$cfg = & EventsConfig::getInstance();
		$option = $cfg->get("com_componentname");
		$is_event_editor = EventsHelper::isEventEditor();
		$Itemid	= EventsHelper::getItemid();

		$user =& JFactory::getUser();
		if( $is_event_editor && !( strtolower( $user->usertype ) == '' )){
			include_once( dirname(__FILE__)."/libraries/frontendAdministration.php");
			$mode ="write";
			if ($id==0) {
				addEvent($mode);
			}
			else {
				editEvent($mode);
			}
		} else {
			$returnlink = JRoute::_( 'index.php?option=' . $option . '&Itemid=' . $Itemid  . '&task=admin', false);
			global $mainframe;
			$mainframe->redirect( $returnlink, html_entity_decode( _CAL_LANG_NOPERMISSION ));
		}
	}

	function delete(){
		$jevtype = JRequest::getVar('jevtype',"jevent" );
		$cfg = & EventsConfig::getInstance();
		$option = $cfg->get("com_componentname");
		$is_event_editor = EventsHelper::isEventEditor();
		$Itemid	= EventsHelper::getItemid();
		$cache =& JFactory::getCache($option);
		$cache->clean($option);
		$user =& JFactory::getUser();
		if( $is_event_editor && !( strtolower( $user->usertype ) == '' )){
			include_once( dirname(__FILE__)."/libraries/frontendAdministration.php");
			deleteEvent();
		} else {
			$returnlink = JRoute::_( 'index.php?option=' . $option . '&Itemid=' . $Itemid  . '&task=admin', false);
			global $mainframe;
			$mainframe->redirect( $returnlink, html_entity_decode( _CAL_LANG_NOPERMISSION ));
		}
	}

	function deleteIcalEvent(){
		//TODO write deleteICAL
		echo "Not yet implemented<br/>";

	}

	function deleteIcalRepeat(){
		//TODO write deleteICAL
		echo "Not yet implemented<br/>";

	}

	function add(){
		$cfg = & EventsConfig::getInstance();
		$option = $cfg->get("com_componentname");
		$is_event_editor = EventsHelper::isEventEditor();
		$Itemid	= EventsHelper::getItemid();
		$cache =& JFactory::getCache($option);
		$cache->clean($option);
		if( $is_event_editor ){
			include_once( dirname(__FILE__)."/libraries/frontendAdministration.php");
			$mode ="edit";
			addEvent($mode);
		} else {
			$returnlink = JRoute::_( 'index.php?option=' . $option . '&Itemid=' . $Itemid, false );

			global $mainframe;
			$mainframe->redirect( $returnlink, html_entity_decode( _CAL_LANG_NOPERMISSION ));
		}

	}

	function edit(){
		$cfg = & EventsConfig::getInstance();
		$option = $cfg->get("com_componentname");
		$is_event_editor = EventsHelper::isEventEditor();
		$Itemid	= EventsHelper::getItemid();
		$cache =& JFactory::getCache($option);
		$cache->clean($option);
		$user =& JFactory::getUser();
		if( $is_event_editor && !( strtolower( $user->usertype ) == '' )){
			include_once( dirname(__FILE__)."/libraries/frontendAdministration.php");
			$mode = "edit";
			editEvent($mode);
		} else {
			$returnlink = JRoute::_( 'index.php?option=' . $option . '&Itemid=' . $Itemid, false );
			global $mainframe;
			$mainframe->redirect( $returnlink, html_entity_decode( _CAL_LANG_NOPERMISSION ));
		}
	}


	function cancel(){
		$cfg = & EventsConfig::getInstance();
		$option = $cfg->get("com_componentname");
		$Itemid	= EventsHelper::getItemid();

		$db	=& JFactory::getDBO();
		$user =& JFactory::getUser();
		$row = new mosEvents( $db );
		$row->bind( $_POST );

		$access =& EventsHelper::getJEV_Access();
		if( $access->canEdit() || ( $access->canEditOwn() && $row->created_by == $user->id )) {
			$row->checkin();
		}
		global $mainframe;
		$mainframe->redirect( JRoute::_( 'index.php?option=' . $option . '&Itemid=' . $Itemid, false ));
	}

}
