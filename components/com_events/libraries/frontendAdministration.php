<?php
/**
 * Events Component for Joomla 1.5.x
 *
 * @version     $Id: frontendAdministration.php 986 2008-02-21 22:22:38Z tstahl $
 * @package     Events
 * @copyright   Copyright (C) 2006-2007 JEvents Project Group
 * @copyright   Copyright (C) 2000 - 2003 Eric Lamette, Dave McDonnelle
 * @licence     http://www.gnu.org/copyleft/gpl.html
 * @link        http://joomlacode.org/gf/project/jevents
 */

defined( '_JEXEC' ) or die( 'Restricted access' );


function publishEvent($id) {
	$access =& EventsHelper::getJEV_Access();
	$db	=& JFactory::getDBO();
	if($access->canPublish() ){
		$id = intval($id);

		$query = "UPDATE #__events"
		. "\n SET state = 1"
		. "\n WHERE id = $id"
		;
		$db->setQuery( $query );
		$db->query();
	}
}

function sendAdminMail( $adminName, $adminEmail, $subject='', $title='', $content='', $author='', $live_site, $modifylink ) {

	if (!$adminEmail) return;
	if ((strpos($adminEmail,'@example.com') !== false)) return;

	$htmlmail = true;
	$lf = ($htmlmail === true) ? '<br />' : '\r\n';

	$content  = 'Title: ' . $title . $lf.$lf . $content;
	$content .= $lf.$lf. sprintf( _CAL_LANG_MAIL_TO_ADMIN, $live_site, $author );
	$content .= $lf . 'Edit : ' . $modifylink;

	// mail function
	$mail =& JFactory::getMailer();
	$mail->setSender(array( 0 => $adminEmail, 1 => $adminName ));
    $mail->addRecipient($adminEmail);
	$mail->setSubject($subject);
	$mail->setBody($content);
	$mail->IsHTML(true);
	$mail->send();

}

function addEvent ($mode){
	$cfg = & EventsConfig::getInstance();
	$option = $cfg->get("com_componentname");
	$goodexit 		= JRequest::getVar( 			'goodexit', 	0 );
	$is_event_editor = EventsHelper::isEventEditor();
	global $mainframe;

	$user =& JFactory::getUser();

	$db	=& JFactory::getDBO();
	$agid = EventsHelper::getAGID();
	list($year,$month,$day) = EventsHelper::getYMD();
	$Itemid = EventsHelper::getItemid();
	$cfg = & EventsConfig::getInstance();
	$task 	= JRequest::getVar(	'task',	$cfg->get('com_startview'));
	$cache =& JFactory::getCache($option);
	$cache->clean($option);

	if( $is_event_editor ){
		if( $mode == 'write' ){
			if( $goodexit == 1 ){

				// trigger the onBeforeEventAdd mambot
				$continue = true;
				$dispatcher =& setupJEventsDispatcher();
				$dispatcher->trigger(  'onBeforeEventAdd' , array(&$continue,&$params));

				$adminEmail	= $cfg->get('com_adminmail');
				$event = saveEvent( $db );
				if (isset($event)){
					$agid=($event->id>0)?"&agid=".$event->id:"";
					if ($event->created_by_alias!="") $created_by=$event->created_by_alias;
					else $created_by = $user->name;
				}
				$subject	= _CAL_LANG_MAIL_ADDED . ' ' . $mainframe->getCfg('sitename');
				$subject	= ($event->state == '1') ? '[Info] ' . $subject : '[Approval] ' . $subject;

				$Itemid = EventsHelper::getItemid();
				$uri =& JURI::getInstance();
				$prefix = $uri->toString( array('scheme', 'host', 'port'));
				$modifylink = '<a href="' . $prefix . JRoute::_( 'index.php?option=' . $option . '&task=edit'.$agid.'&Itemid=' . $Itemid ) . '"><b>' . _CAL_LANG_MODIFY . '</b></a>' . "\n";

				if ($created_by==null) $created_by="Anonymous";
				sendAdminMail( $mainframe->getCfg('sitename'), $adminEmail, $subject, $event->title, $event->content, $created_by, JURI::root(), $modifylink );

				$returnlink = JRoute::_( 'index.php?option=' . $option . '&Itemid=' . $Itemid, false );
				if( $event->state == '1' ){
					global $mainframe;
					$mainframe->redirect( $returnlink, html_entity_decode( _CAL_LANG_ACT_MODIFIED ));
				} else {
					global $mainframe;
					$mainframe->redirect( $returnlink, html_entity_decode( _CAL_LANG_ACT_ADDED ));
				}

				//$returnlink = "index.php?option=$option&Itemid=$Itemid";
				//global $mainframe;$mainframe->redirect("$returnlink", _CAL_LANG_ACT_ADDED);
			}
		} else {

			if( $year && $month && $day ){
				$start_publish	= $year . '-' . $month . '-' . $day;
				$stop_publish	= $year . '-' . $month . '-' . $day;
			} else {
				$start_publish = strftime( '%Y-%m-%d', time() + ( $mainframe->getCfg('offset') * 60 * 60 ));
				$stop_publish	= strftime( '%Y-%m-%d', time() + ( $mainframe->getCfg('offset') * 60 * 60 ));
			}

			$row = new mosEvents( $db );
			// if user hits refresh, try to maintain event form state
			$row->bind( JRequest::get('post', JREQUEST_ALLOWHTML));
			$row->color_bar			= mosEventsHTML::getColorBar( null, '' );
			$start_time				= '08:00';
			$end_time 				= '17:00';
			$row->reccurday_month 	= -1;
			$row->reccurday_week 	= -1;
			$row->reccurday_year 	= -1;
			$row->created_by_alias 	= $user->username;
			$row->reccurtype 		= 0;

			$lists 					= '';

			// dmcd May 20/04  fetch the new category colors from the '#__events_category' db table
			$query = "SELECT *"
			. "\n FROM #__events_categories"
			;
			$db->setQuery( $query );
			$catColors = $db->loadObjectList( 'id' );

			// Initialize some variables
			$document = & JFactory::getDocument();
			// load toolbar css
			$document->addStyleSheet( '/administrator/templates/khepri/css/template.css' );
			
			$JEventsViewClass = EventsViewer::viewClassName("front");
			$htmlevents = new $JEventsViewClass();
			$htmlevents->viewFormEvent( $row, $start_publish, $stop_publish, $start_time, $end_time, $lists, $Itemid, $option, $task, 'new', $catColors, $agid );
		}

	}

}

function editEvent($mode) {
	global $mainframe;
	$Itemid	= EventsHelper::getItemid();
	$cfg = & EventsConfig::getInstance();
	$option = $cfg->get("com_componentname");
	$is_event_editor = EventsHelper::isEventEditor();
	$user =& JFactory::getUser();

	$agid = EventsHelper::getAGID();
	$jevtype = JRequest::getVar('jevtype',"jevent" );
	$goodexit 		= JRequest::getVar( 			'goodexit', 	0 );
	$db	=& JFactory::getDBO();
	$cfg = & EventsConfig::getInstance();
	$task 	= JRequest::getVar(	'task',	$cfg->get('com_startview'));
	$datamodel = new JEventsDataModel("JEventsAdminDBModel");
	$row = $datamodel->queryModel->listEventsById( $agid, 1,$jevtype );  // include unpublished events for publishers and above
	// TODO convert this code to support the object

	if( !hasAdvancedRowPermissions($row,$user)){
		$returnlink = JRoute::_( 'index.php?option=' . $option , '&Itemid=' . $Itemid, false );
		$mainframe->redirect( $returnlink,  _CAL_LANG_NOPERMISSION );

	}

	if( $mode == 'write'){
		if( $goodexit == 1 ){
			$adminEmail	= $cfg->get('com_adminmail');

			$event = saveEvent( $db );
			if (isset($event)){
				$agid=($event->id>0)?"&agid=".$event->id:"";
				if ($event->created_by_alias!="") $created_by=$event->created_by_alias;
				else $created_by = $user->name;
			}
			$subject	= _CAL_LANG_MAIL_MODIFIED . ' ' . $mainframe->getCfg('sitename');
			$subject	= ($event->state == '1') ? '[Info] ' . $subject : '[Approval] ' . $subject;

			$Itemid = EventsHelper::getItemid();
			$uri =& JURI::getInstance();
			$prefix = $uri->toString( array('scheme', 'host', 'port'));
			$modifylink = '<a href="' . $prefix . JRoute::_( 'index.php?option=' . $option . '&task=edit'.$agid.'&Itemid=' . $Itemid ) . '"><b>' . _CAL_LANG_MODIFY . '</b></a>' . "\n";

			sendAdminMail( $mainframe->getCfg('sitename'), $adminEmail, $subject, $event->title, $event->content, $created_by, JURI::root(), $modifylink );

			$returnlink = JRoute::_( 'index.php?option=' . $option . '&Itemid=' . $Itemid, false );
			if( $event->state == '1' ){
				global $mainframe;
				$mainframe->redirect( $returnlink, html_entity_decode( _CAL_LANG_ACT_MODIFIED ));
			} else {
				global $mainframe;
				$mainframe->redirect( $returnlink, html_entity_decode( _CAL_LANG_ACT_ADDED ));
			}

		}
	} else {
		// trigger the onBeforeEventEdit mambot
		$dispatcher =& setupJEventsDispatcher();
		$continue = true;
		$dispatcher->trigger(  'onBeforeEventEdit' , array(&$continue,&$params));

		if( $agid ){
			$row			= $datamodel->queryModel->listEventsById( $agid, 1,$jevtype ); // include unpublished events for publishers and above
			$event_up 		= new mosEventDate( $row->publish_up() );
			$start_publish 	= sprintf( '%4d-%02d-%02d', $event_up->year, $event_up->month, $event_up->day );
			$start_time 	= $event_up->hour . ':' . $event_up->minute;

			$event_down 	= new mosEventDate( $row->publish_down() );
			$stop_publish 	= sprintf( '%4d-%02d-%02d', $event_down->year, $event_down->month, $event_down->day );
			$end_time 		= $event_down->hour . ':' . $event_down->minute;

			// TODO make sure this gets into class structure
			// kludge for now
			$row->_reccurday_month	= 99;
			$row->_reccurday_week	= 99;
			$row->_reccurday_year	= 99;

			if( $row->reccurday()<> '' ){
				if( $row->reccurtype() == 1 ){
					$row->_reccurday_week = $row->reccurday();
				}elseif( $row->reccurtype() == 3 ){
					$row->_reccurday_month = $row->reccurday();
				}elseif( $row->reccurtype() == 5 ){
					$row->_reccurday_year = $row->reccurday();
				}
			}

			$lists['state'] = JHTML::_('select.booleanlist', 'state', 'size="1" class="inputbox"', $row->state() );

			// dmcd May 20/04  fetch the new category colors from the '#__events_category' db table
			$query = "SELECT *"
			. "\n FROM #__events_categories"
			;
			$db->setQuery( $query );
			$catColors = $db->loadObjectList( 'id' );

			$JEventsViewClass = EventsViewer::viewClassName("front");
			$htmlevents = new $JEventsViewClass();

			// TODO make admin side class aware too!
			$datarow = new stdClass();
			foreach (get_object_vars($row) as $key=>$val) {
				if (strpos($key,"_")===0){
					$key = substr($key,1);
					$datarow->$key = $val;
				}
			}

			// Initialize some variables
			$document = & JFactory::getDocument();
			// load toolbar css
			$document->addStyleSheet( '/administrator/templates/khepri/css/template.css' );
			
			$htmlevents->viewFormEvent( $datarow, $start_publish, $stop_publish, $start_time, $end_time, $lists, $Itemid, $option, $task, 'edit', $catColors, $agid );
		}
	}

}

function saveEvent(  ) {
	$is_event_editor = EventsHelper::isEventEditor();
	global $mainframe;
	$cfg = & EventsConfig::getInstance();
	$option = $cfg->get("com_componentname");
	$Itemid = EventsHelper::getItemid();
	$user =& JFactory::getUser();

	$db	=& JFactory::getDBO();

	$cfg = & EventsConfig::getInstance();

	$start_time			= JRequest::getVar(		'start_time', 		'08:00' );
	$start_pm			= intval( JRequest::getVar( 	'start_pm', 		'0' ) );
	$end_time			= JRequest::getVar(			'end_time', 		'17:00' );
	$end_pm				= intval( JRequest::getVar( 	'end_pm', 			'0' ) );

	$reccurweekdays 	= JRequest::getVar(			'reccurweekdays', 	'' );
	$reccurweeks 		= JRequest::getVar(			'reccurweeks', 		'' );
	$reccurday_week 	= JRequest::getVar( 			'reccurday_week', 	'' );
	$reccurday_month 	= JRequest::getVar(			'reccurday_month', 	'' );
	$reccurday_year 	= JRequest::getVar( 			'reccurday_year', 	'' );

	$now = strftime( '%Y-%m-%d %H:%M:%S', time() + ( $mainframe->getCfg('offset') * 60 * 60 ));

	$row = new mosEvents( $db );

	// JREQUEST_ALLOWHTML requires at least Joomla 1.5 svn9979 (past 1.5 stable)
	$event_post = JRequest::get('post', JREQUEST_ALLOWHTML);
	$event_post['adresse_info'] = & $event_post['location'];

	if (!$row->bind( $event_post )) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}

	if( is_null( $row->useCatColor )){
		$row->useCatColor = 0;
	}

	if( $row->id ){
		$row->modified = $now;
		if( $user->id ){
			$row->modified_by = $user->id;
		}
	} else {
		$row->created = $now;
		if( $user->id ){
			$row->created_by = $user->id;
		}
	}

	if( $row->catid ){
		$row->catid = intval( $row->catid );
	}


	// reformat the time into 24hr format if necessary
	if( $cfg->get('com_calUseStdTime') == '1' ){
		list( $hrs,$mins) 	= explode( ':', $start_time );
		$hrs 				= intval( $hrs );
		$mins 				= intval( $mins );

		if( $hrs != 12 && $start_pm ){
			$hrs += 12;
		}elseif( $hrs == 12 && !$start_pm ){
			$hrs = 0;
		}

		if( $hrs < 10 ){
			$hrs = '0' . $hrs;
		}

		if( $mins < 10 ){
			$mins = '0' . $mins;
		}

		$start_time			= $hrs . ':' . $mins;

		list( $hrs,$mins )	= explode( ':', $end_time );
		$hrs 				= intval( $hrs );
		$mins 				= intval( $mins );

		if( $hrs != 12 && $end_pm ){
			$hrs += 12;
		}elseif( $hrs == 12 && !$end_pm ){
			$hrs = 0;
		}

		if( $hrs < 10 ){
			$hrs = '0' . $hrs;
		}

		if( $mins < 10 ){
			$mins = '0' . $mins;
		}

		$end_time = $hrs . ':' . $mins;
	}

	if( $row->publish_up ){
		$publishtime 		= $row->publish_up . ' ' . $start_time . ':00';
		$row->publish_up 	= strftime( '%Y-%m-%d %H:%M:%S', strtotime( $publishtime ));
	} else {
		$row->publish_up = strftime( "%Y-%m-%d 00:00:00", time()+($mainframe->getCfg('offset')*60*60));
		//date( "Y-m-d 00:00:00" );
	}

	if ($row->publish_down) {
		$publishtime = $row->publish_down." ".$end_time.":00";
		$row->publish_down = strftime("%Y-%m-%d %H:%M:%S",strtotime($publishtime));
	} else {
		$row->publish_down = $now;
	}

	if( $row->publish_up <> $row->publish_down ){
		$row->reccurtype = intval( $row->reccurtype );
	} else {
		$row->reccurtype = 0;
	}

	if( $row->reccurtype == 0 ){
		$row->reccurday = '';
	}elseif( $row->reccurtype == 1 ){
		$row->reccurday =  $reccurday_week;
	}elseif( $row->reccurtype == 2 ){
		$row->reccurday = '';
	}elseif( $row->reccurtype == 3 ){
		$row->reccurday = $reccurday_month;
	}elseif( $row->reccurtype == 4 ){
		$row->reccurday = '';
	}elseif( $row->reccurtype == 5 ){
		$row->reccurday = $reccurday_year;
	}

	// Reccur week days
	if( $reccurweekdays == '' ){
		$weekdays = '';
	} else {
		$weekdays = implode( '|', $reccurweekdays );
	}

	$row->reccurweekdays = $weekdays;

	// Reccur viewable weeks
	if( $reccurweeks == '' ){
		$weekweeks = '';
	} else {
		$weekweeks = implode( '|', $reccurweeks );
	}

	$row->reccurweeks = $weekweeks;

	// Always unpublish if no Publisher otherwise publish automatically
	$mapping = array(
	'registered'=>1,
	'author' 	=>2,
	'editor'	=>3,
	'publisher'	=>4,
	'manager'	=>5,
	'administrator'=>6,
	'super administrator'=>7);
	$frontendPublish = $cfg->get('com_frontendPublish');
	if(array_key_exists( strtolower( $user->usertype ),$mapping)){
		$frontendPublish = ($frontendPublish <= $mapping[strtolower( $user->usertype )]);
	}
	else {
		$frontendPublish=false;
	}
	if( $row->state == '' ){
		if ($frontendPublish){
			$row->state = 1;
		}else{
			$row->state = 0;
		}
	}

	$row->mask = 0;

	if( !$row->check() ){
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}
	if( !$row->store() ) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}

	$row->checkin();
	// Update Category Count
	$query = "UPDATE #__categories"
	. "\n SET count = count+1"
	. "\n WHERE id = '$row->catid'"
	;
	$db->setQuery( $query );

	//$returnlink = 'index.php?option=' . $option . '&Itemid=' . $Itemid;

	return $row;
}

function removeEvent( $agid ) {
	$cfg = & EventsConfig::getInstance();
	$option = $cfg->get("com_componentname");
	$Itemid = EventsHelper::getItemid();
	$db	=& JFactory::getDBO();

	$cfg = & EventsConfig::getInstance();
	// No use for ical events!
	$agid = intval($agid);
	//Get Category ID prior to removing event, in order to update counts
	$query = "SELECT catid"
	. "\n FROM #__events"
	. "\n WHERE id = '$agid'"
	;
	$db->setQuery( $query );
	$catid = $db->loadResult();

	$query = "DELETE FROM #__events"
	. "\n WHERE id = '$agid'"
	;
	$db->setQuery( $query );
	if( !$db->query() ){
		echo "<script> alert('".$db->getErrorMsg()."'); window.history.go(-1); </script>\n";
	}

	// Update Category Count
	$query = "UPDATE #__categories"
	. "\n SET count = count-1"
	. "\n WHERE id = '$catid'"
	;
	$db->setQuery( $query );
	if( !$db->query() ){
		echo "<script> alert('".$db->getErrorMsg()."'); window.history.go(-1); </script>\n";
		exit();
	}

	$returnlink = JRoute::_( 'index.php?option=' . $option . '&Itemid=' . $Itemid, false );
	global $mainframe;
	$mainframe->redirect( $returnlink, html_entity_decode( _CAL_LANG_ACT_DELETED ));
}

function deleteEvent(){
	$agid = EventsHelper::getAGID();
	$jevtype = JRequest::getVar('jevtype',"jevent" );
	$cfg = & EventsConfig::getInstance();
	$option = $cfg->get("com_componentname");
	$is_event_editor = EventsHelper::isEventEditor();
	$Itemid = EventsHelper::getItemid();
	$user =& JFactory::getUser();

	if( $agid ){
		$datamodel = new JEventsDataModel("JEventsAdminDBModel");
		$row	= $datamodel->queryModel->listEventsById( $agid, 1,$jevtype );  // include unpublished events for publishers and above

		// Have to check this condition
		if( !hasAdvancedRowPermissions($row,$user)){
			$returnlink = JRoute::_( 'index.php?option=' . $option , '&Itemid=' . $Itemid, false );
			global $mainframe;
			$mainframe->redirect( $returnlink,  _CAL_LANG_NOPERMISSION );
		}
		else {
			removeEvent( $agid );
		}
	}
}


// NEW ICAL FUNCTIONS
function editIcalEvent($id=0){
	// TODO make admin side class aware too!
	global $mainframe;
	$cfg = & EventsConfig::getInstance();
	$option = $cfg->get("com_componentname");
	$is_event_editor = EventsHelper::isEventEditor();
	$user =& JFactory::getUser();

	$db	=& JFactory::getDBO();
	$datamodel = new JEventsDataModel("JEventsAdminDBModel");
	$mainframe->set( 'joomlaJavascript', 1 );

	require_once( JPATH_ADMINISTRATOR. '/includes/toolbar.php' );
	$admin_html = $mainframe->getPath( 'admin_html' ) ;
	$admindir = dirname($admin_html);

	// load language constants
	EventsHelper::loadLanguage('admin');

	require_once($admin_html );

	echo '<div align="right" style="height:50px;">';

	//JToolBarHelper::startTable();//mosToolBar::startTable();

	// TODO remove duplicated retrieving of thus information - its here for access control purposes
	include_once(JPATH_ADMINISTRATOR."/components/$option/lib/adminqueries.php");
	include_once(JPATH_SITE."/components/$option/libraries/iCalImport.php");
	if ($id>0){
		$vevent = $datamodel->queryModel->getVEventById( $id);

		$row = new jIcalEventDB($vevent);

		if( !hasAdvancedRowPermissions($row,$user)){
			$returnlink = JRoute::_( 'index.php?option=' . $option , '&Itemid=' . $Itemid, false );
			global $mainframe;
			$mainframe->redirect( $returnlink,  _CAL_LANG_NOPERMISSION );
		}

	}
	else {
		$vevent = new iCalEvent($db);
		$vevent->set("freq","DAILY");
		$vevent->set("description","");
		$vevent->set("summary","");
		$vevent->set("dtstart",mktime(8,0,0));
		$vevent->set("dtend",mktime(15,0,0));
		$row = new jIcalEventDB($vevent);

		if( !$is_event_editor || !$row->isEditable()){
			$returnlink = JRoute::_( 'index.php?option=' . $option , '&Itemid=' . $Itemid, false );
			global $mainframe;
			$mainframe->redirect( $returnlink,  _CAL_LANG_NOPERMISSION );
		}
	}

	$access =& EventsHelper::getJEV_Access();
	if (isset($row) && !is_null($row->id())  && $row->id()>0 && !is_null($row->state()) && $row->state()==0 && $access->canPublish()){
		JToolBarHelper::custom("publishIcal","publish.png","publish_f2.png","",false);
		JToolBarHelper::spacer();
	}
	JToolBarHelper::save('saveIcalEvent');//mosToolBar::save("saveIcalEvent");
	JToolBarHelper::spacer();//mosToolBar::spacer();
	JToolBarHelper::cancel();//mosToolBar::cancel();

	// Initialize some variables
	$document = & JFactory::getDocument();
	// load toolbar css
	$document->addStyleSheet( '/administrator/templates/khepri/css/template.css' );
	$bar = & JToolBar::getInstance('toolbar');
	echo $bar->render();
	//JToolBarHelper::endTable();//mosToolBar::endtable();
	echo '</div>';

	$html_events_admin = & HTML_events_admin::getInstance();
	$html_events_admin->editIcalItem($option,$id);
}

function editIcalEventRepeat($rp_id=0){
	// should never be called with $rp_id=0

	//echo "<div style='background-color:yellow;border:solid 1px black;color:black'>You are editing the reccurence NOT the event</div>";
	if ($rp_id==0) {
		echo "invalid repeat id<br/>";
		return ;
	}

	$db	=& JFactory::getDBO();
	$query = "SELECT eventid as id from #__jevents_repetition where rp_id=$rp_id";
	$db->setQuery($query);
	$ev_id = $db->loadResult();
	if (!isset($ev_id) || $ev_id==0){
		echo "No such repeat id</br>";
		return ;
	}
	global $mainframe;
	$cfg = & EventsConfig::getInstance();
	$option = $cfg->get("com_componentname");
	$is_event_editor = EventsHelper::isEventEditor();
	$user =& JFactory::getUser();

	$db	=& JFactory::getDBO();
	$datamodel = new JEventsDataModel("JEventsAdminDBModel");
	$mainframe->set( 'joomlaJavascript', 1 );

	require_once( JPATH_ADMINISTRATOR. '/includes/toolbar.php' );
	$admin_html = $mainframe->getPath( 'admin_html' ) ;
	$admindir = dirname($admin_html);

	// load language constants
	EventsHelper::loadLanguage('admin');

	require_once($admin_html );

	echo '<div align="right">';

	//mosToolBar::startTable();

	// TODO remove duplicated retrieving of thus information - its here for access control purposes
	include_once(JPATH_ADMINISTRATOR."/components/$option/lib/adminqueries.php");
	include_once(JPATH_SITE."/components/$option/libraries/iCalImport.php");


	$eventRepeat = $datamodel->queryModel->listEventsById($rp_id, true, "icaldb");

	if( !hasAdvancedRowPermissions($eventRepeat,$user)){
		$returnlink = JRoute::_( 'index.php?option=' . $option , '&Itemid=' . $Itemid, false );
		global $mainframe;
		$mainframe->redirect( $returnlink,  _CAL_LANG_NOPERMISSION );
	}

	$access =& EventsHelper::getJEV_Access();
	if (isset($eventRepeat) && !is_null($eventRepeat->id())  && $eventRepeat->id()>0 && !is_null($eventRepeat->state()) && $eventRepeat->state()==0 && $access->canPublish()){
		JToolBarHelper::custom("publishIcal","publish.png","publish_f2.png","",false);
		JToolBarHelper::spacer();
	}
	JToolBarHelper::save('saveIcalRepeat');
	JToolBarHelper::spacer();
	JToolBarHelper::cancel();

	// Initialize some variables
	$document = & JFactory::getDocument();
	// load toolbar css
	$document->addStyleSheet( '/administrator/templates/khepri/css/template.css' );
	$bar = & JToolBar::getInstance('toolbar');
	echo $bar->render();
	//JToolBarHelper::endTable();//mosToolBar::endtable();
	echo '</div>';

	$html_events_admin = & HTML_events_admin::getInstance();
	$html_events_admin->editIcalItem($option,$ev_id,$rp_id);

}

// TODO make this generic - its just a copy of the admin code at present
function saveIcalEvent() {
	$cfg = & EventsConfig::getInstance();
	$option = $cfg->get("com_componentname");
	include_once(JPATH_ADMINISTRATOR."/components/$option/lib/icalManagement.php");
	IcalManagement::saveIcalEvent();

	// TODO when creating generic code keep different redirects that respect Itemid
	$Itemid = EventsHelper::getItemid();
	global $mainframe;
	$mainframe->redirect( 'index.php?option=' . $option . '&Itemid='.$Itemid,"IcalEvent Saved");

}

// TODO make this generic - its just a copy of the admin code at present
function saveIcalRepeat() {
	$cfg = & EventsConfig::getInstance();
	$option = $cfg->get("com_componentname");
	include_once(JPATH_ADMINISTRATOR."/components/$option/lib/icalManagement.php");
	IcalManagement::saveIcalRepeat();

	// TODO when creating generic code keep different redirects that respect Itemid
	$Itemid = EventsHelper::getItemid();
	global $mainframe;
	$mainframe->redirect( 'index.php?option=' . $option . '&Itemid='.$Itemid,"IcalEvent Saved");

}

function hasAdvancedRowPermissions($row,$user){
	if( strtolower( $user->usertype ) == 'editor' ||
	strtolower( $user->usertype ) == 'manager' ||
	strtolower( $user->usertype ) == 'administrator' ||
	strtolower( $user->usertype ) == 'super administrator') {

		return true;
	} else
	if( $row->created_by() == $user->id ){
		return true;
	}
	return false;
}

?>
