<?php
/**
 * Events Component for Joomla 1.0.x
 *
 * @version     $Id: events.php 1109 2008-06-19 14:19:28Z tstahl $
 * @package     Events
 * @copyright   Copyright (C) 2006 JEvents Project Group
 * @copyright   Copyright (C) 2000 - 2003 Eric Lamette, Dave McDonnelle
 * @licence     http://www.gnu.org/copyleft/gpl.html
 * @link        http://joomlacode.org/gf/project/jevents
 */

defined( '_VALID_MOS' ) or defined('_JEXEC') or die( 'No Direct Access' );

include_once( dirname(__FILE__)."/events.old.php" );


/*************************************************
* CORE
**************************************************/

// setup for all required function and classes
require_once(mosMainFrame::getBasePath() . 'components/com_events/includes/comutils.php');

// load language constants
EventsHelper::loadLanguage('front');

if (strpos(_CAL_LEGEND_ALL_CATEGORIES,"XXXX")!==false){
	echo "<div id='misstrans' style='position:absolute;top:10px;left:10px;width:200px;padding:10px;border:solid 1px black;background-color:yellow;color:black;font-weight:bold'><div style='cursor:pointer;border:solid 1px black;float:right;margin:-7px -7px 4px 5px;padding:2px;' onclick='document.getElementById(\"misstrans\").style.display=\"none\";'>Hide X</div>The Translation of the JEvents Component in this language is incomplete - please consider completing the translation and contributing it to the project</div>";
}
$cfg = & EventsConfig::getInstance();
/*
// get configuration parameters
$cfgclass = $mosConfig_absolute_path . '/administrator/components/com_events/lib/config.php';
require_once($cfgclass);
$cfg = & EventsConfig::getInstance();

// CHECK LANGUAGE
if( !defined( '_CAL_LANG_INCLUDED' )) {
$pathLang = $mosConfig_absolute_path . '/components/com_events/language/';
if( file_exists( $pathLang . $mosConfig_lang . '.php' )){
include_once( $pathLang . $mosConfig_lang . '.php' );
} else {
include_once( $pathLang . 'english.php');
}
}
*/

// SOMES VARIABLES
global $agid, $mainframe, $catidsIn, $catids, $catidList, $catidsOut, $pop;
$option			= mosGetParam( $_REQUEST, 			'option', 		'com_events' );
$task 			= mosGetParam( $_REQUEST, 			'task', 		$cfg->get('com_startview'));
$mode 			= mosGetParam( $_REQUEST, 			'mode', 		'com_events' );
$limit 			= intval( mosGetParam( $_REQUEST, 	'limit', 		'' ) );
$limitstart 	= intval( mosGetParam( $_REQUEST, 	'limitstart', 	0 ) );
$offset 		= intval( mosGetParam( $_REQUEST, 	'offset', 		0 ) );
$id 			= intval( mosGetParam( $_REQUEST, 	'id', 		0 ) );
$agid 			= intval( mosGetParam( $_REQUEST, 	'agid', 		0 ) );
$keyword 		= $database->getEscaped(mosGetParam( $_REQUEST, 'keyword', '' ));
$goodexit 		= mosGetParam( $_REQUEST, 			'goodexit', 	0 );
$Itemid			= intval( mosGetParam( $_REQUEST, 	'Itemid', 		0 ));
$pop 			= mosGetParam( $_REQUEST, 			'pop', 			0 );
$catid			= intval( mosGetParam( $_REQUEST,	'catid', 		0 ));
$catidsIn		=urldecode( mosGetParam( $_REQUEST, 	'catids', 		'NONE' ) );

// Joomla 1.5
global $_VERSION;
if (floatval($_VERSION->getShortVersion())>=1.5){
	JPluginHelper::importPlugin( 'content' );
	$GLOBALS["jev_dispatcher"] = & JDispatcher::getInstance();
	// Get the parameters of the active menu item
	$menus	= &JSite::getMenu();
	$menu	= $menus->getActive();
}
else {
	global $_MAMBOTS;
	$_MAMBOTS->loadBotGroup( 'content' );
	$GLOBALS["jev_dispatcher"] =& $_MAMBOTS;
	$menu	= $mainframe->get( 'menu' );
}

// if no catids from GET or POST default to the menu values
// Note that module links must pass a non default value
$catids = array();
if ($catidsIn == "NONE") {
	// Parameters
	// Joomla 1.5 compatability
	if (isset($menu)) $params = new mosParameters( $menu->params );
	else $params =& new mosParameters(null);
	$catidList	= "";

	for ($c=0; $c < 999; $c++) {
		$nextCID = "catid$c";
		//  stop looking for more catids when you reach the last one!
		if (!$nextCatId = $params->get( $nextCID, null)) {
			break;
		}
		if ( !in_array( $nextCatId, $catids )){
			$catids[]	= $nextCatId;
			$catidList	.= ( strlen( $catidList )>0 ? ',' : '' ) . $nextCatId;
		}
	}
	$catidsOut = str_replace( ',', '|', $catidList );
}
else {
	$catids = explode( '|', $catidsIn );
	// paranoid hardening!
	$catidList = '';
	for ($i=0; $i < count($catids); $i++) {
		$catids[$i] = intval($catids[$i]);
		$catidList	.= (strlen($catidList) > 0 ? ',' : '') . $catids[$i];
	}
	$catidsOut = str_replace(',', '|', $catidList);
}

// SET LOCAL
$year	= intval( mosGetParam( $_REQUEST, 'year',	strftime( '%Y', jevNow(true)) ));
$month	= intval( mosGetParam( $_REQUEST, 'month',	strftime( '%m', jevNow(true)) ));
$day	= intval( mosGetParam( $_REQUEST, 'day',	strftime( '%d', jevNow(true)) ));

if( $day <= '9' & ereg( "(^[1-9]{1})", $day )) {
	$day = '0' . $day;
}
if( $month <= '9' & ereg( "(^[1-9]{1})", $month )) {
	$month = '0' . $month;
}

/* moved to comutils.php [tstahl]
// SOMES INCLUDES
require_once( $mainframe->getPath( 'front_html' ) );
if( !class_exists( 'mosEvents' )) {
require_once( $mainframe->getPath( 'class' ) );
}
*/

// paging must be implemented
//require_once( "includes/pageNavigation.php" );

// PREVENT Itemid MISSING
if( !isset($Itemid) || empty( $Itemid )){
	$query = "SELECT id"
	. "\n FROM #__menu"
	. "\n WHERE link = 'index.php?option=$option'"
	;
	$database->setQuery( $query );

	// This  should ideally to a test on catids and find nice enclosing menu item!

	$_REQUEST['Itemid'] = $database->loadResult();
}
$Itemid = intval( mosgetParam( $_REQUEST, 'Itemid') );



// CHECK ACCESS
global $agid, $gid,$is_event_editor,$access; // Joomla1.5
$gid				= intval( $my->gid );
$username			= $my->username;
$is_event_editor 	= 0;

// override standard MOS ACLs with Events Config settings
if (( $cfg->get('com_adminlevel') == 0 ) && ( strtolower( $my->usertype ) == 'registered')) {
	$is_event_editor = 1;
} elseif ( $cfg->get('com_adminlevel') == 2) {
	$is_event_editor = 1;
} else {
	$is_event_editor = ( strtolower( $my->usertype ) == 'author' || strtolower( $my->usertype ) == 'publisher'
	|| strtolower( $my->usertype ) == 'editor' || strtolower( $my->usertype ) == 'manager' || strtolower( $my->usertype ) == 'administrator'
	|| strtolower( $my->usertype ) == 'super administrator' );
}
// Dynamic Page Title
// Joomla1.5
if (isset($menu->name) && isset($mainframe)) $mainframe->SetPageTitle( $menu->name );


// Editor usertype check
$access = new stdClass();
global $acl;
$access->canEdit	= $acl->acl_check( 'action', 'edit', 'users', $my->usertype, 'content', 'all' );
$access->canEditOwn = $acl->acl_check( 'action', 'edit', 'users', $my->usertype, 'content', 'own' );
$access->canPublish = $acl->acl_check( 'action', 'publish', 'users', $my->usertype, 'content', 'all' );

// cache
$now = date( 'Y-m-d H:i', jevNow(true) );
// cache activation
$cache =& mosCache::getCache( 'com_events' );

////////////////////////////////////////////////////////////////////
//  FONCTIONS
////////////////////////////////////////////////////////////////////

function hasAdvancedRowPermissions($row,$my){
	if( strtolower( $my->usertype ) == 'editor' ||
	strtolower( $my->usertype ) == 'publisher' ||
	strtolower( $my->usertype ) == 'manager' ||
	strtolower( $my->usertype ) == 'administrator' ||
	strtolower( $my->usertype ) == 'super administrator') {

		return true;
	} else
	if( $row->created_by == $my->id ){
		return true;
	}
	return false;
}



function sendAdminMail( $adminName, $adminEmail, $subject='', $title='', $content='', $author='', $live_site, $modifylink ) {

	if (!$adminEmail) return;

	$htmlmail = true;
	$lf = ($htmlmail === true) ? '<br />' : '\r\n';

	$content  = 'Title: ' . $title . $lf.$lf . $content;
	$content .= $lf.$lf. sprintf( _CAL_LANG_MAIL_TO_ADMIN, $live_site, $author );
	$content .= $lf . 'Edit : ' . $modifylink;

	// mail function
	//mosMail( $mosConfig_mailfrom, $mosConfig_fromname, $email, $subject, $msg );
	mosMail( $adminEmail, $adminName, $adminEmail, $subject, $content, $htmlmail );
}

function publishEvent($id) {
	global $database, $access;
	if($access->canPublish ){
		$id = intval($id);

		$query = "UPDATE #__events"
		. "\n SET state = 1"
		. "\n WHERE id = $id"
		;
		$database->setQuery( $query );
		$database->query();
	}
}

function saveEvent( $db ) {
	global $mosConfig_offset, $access, $my, $is_event_editor, $Itemid, $option;

	$cfg = & EventsConfig::getInstance();

	$start_time			= mosGetParam( $_POST, 			'start_time', 		'08:00' );
	$start_pm			= intval( mosGetParam( $_POST, 	'start_pm', 		'0' ) );
	$end_time			= mosGetParam( $_POST, 			'end_time', 		'17:00' );
	$end_pm				= intval( mosGetParam( $_POST, 	'end_pm', 			'0' ) );

	$reccurweekdays 	= mosGetParam( $_POST, 			'reccurweekdays', 	'' );
	$reccurweeks 		= mosGetParam( $_POST, 			'reccurweeks', 		'' );
	$reccurday_week 	= mosGetParam( $_POST, 			'reccurday_week', 	'' );
	$reccurday_month 	= mosGetParam( $_POST, 			'reccurday_month', 	'' );
	$reccurday_year 	= mosGetParam( $_POST, 			'reccurday_year', 	'' );

	$now = strftime( '%Y-%m-%d %H:%M:%S', jevNow(true));

	$row = new mosEvents( $db );
	if (!$row->bind( $_POST )) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}

	if( is_null( $row->useCatColor )){
		$row->useCatColor = 0;
	}

	if( $row->id ){
		$row->modified = $now;
		if( $my->id ){
			$row->modified_by = $my->id;
		}
	} else {
		$row->created = $now;
		if( $my->id ){
			$row->created_by = $my->id;
		}
	}

	if( $row->catid ){
		$row->catid = intval( $row->catid );
	}

	$row->title = htmlspecialchars( $row->title );

	// Clean content
	$row->content 		= preg_replace( "'<script[^>]*?>.*?</script>'si",	'',			$row->content );
	$row->content 		= preg_replace( "'<head[^>]*?>.*?</head>'si",		'', 		$row->content );
	$row->content 		= preg_replace( "'<body[^>]*?>.*?</body>'si",		'', 		$row->content );
	//$row->content 		= str_replace( '&',								'&amp;',		$row->content );
	$row->content 		= html_entity_decode( $row->content );

	// Clean adress
	$row->adresse_info 	= preg_replace( "'<script[^>]*?>.*?</script>'si", 	'',			$row->adresse_info );
	$row->adresse_info 	= preg_replace( "'<head[^>]*?>.*?</head>'si", 		'',			$row->adresse_info );
	$row->adresse_info 	= preg_replace( "'<body[^>]*?>.*?</body>'si", 		'',			$row->adresse_info );
	//$row->adresse_info 	= str_replace( '&',									'&amp;',	$row->adresse_info );
	$row->adresse_info 	= strip_tags( $row->adresse_info );
	$row->adresse_info 	= htmlspecialchars( $row->adresse_info, ENT_QUOTES );

	// Clean contact
	$row->contact_info 	= preg_replace( "'<script[^>]*?>.*?</script>'si", 	'', 		$row->contact_info );
	$row->contact_info 	= preg_replace( "'<head[^>]*?>.*?</head>'si", 		'', 		$row->contact_info );
	$row->contact_info 	= preg_replace( "'<body[^>]*?>.*?</body>'si", 		'', 		$row->contact_info );
	//$row->contact_info 	= str_replace( '&',									'&amp;',	$row->contact_info );
	$row->contact_info 	= strip_tags( $row->contact_info );
	$row->contact_info 	= htmlspecialchars( $row->contact_info, ENT_QUOTES );

	// Clean extra
	$row->extra_info 	= preg_replace( "'<script[^>]*?>.*?</script>'si", 	'',			$row->extra_info );
	$row->extra_info 	= preg_replace( "'<head[^>]*?>.*?</head>'si", 		'',			$row->extra_info );
	$row->extra_info 	= preg_replace( "'<body[^>]*?>.*?</body>'si", 		'', 		$row->extra_info );
	//$row->extra_info 	= str_replace( '&',									'&amp;',	$row->extra_info );
	$row->extra_info 	= strip_tags( $row->extra_info );
	$row->extra_info 	= htmlspecialchars( $row->extra_info, ENT_QUOTES );

	$row->created_by_alias = htmlspecialchars( $row->created_by_alias );


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
		$row->publish_up = strftime( "%Y-%m-%d 00:00:00", jevNow(true));
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
	// dmcd nov 16/04 if this is a modified event rather than a new one,
	// reflect whatever change the user has made to the publish state?
	$mapping = array(
	'registered'=>1,
	'author' 	=>2,
	'editor'	=>3,
	'publisher'	=>4,
	'manager'	=>5,
	'administrator'=>6,
	'super administrator'=>7);
	$frontendPublish = $cfg->get('com_frontendPublish');
	if ($frontendPublish==0) $frontendPublish=7; // to protect old config files
	if(array_key_exists( strtolower( $my->usertype ),$mapping)){
		$frontendPublish = ($frontendPublish <= $mapping[strtolower( $my->usertype )]);
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

	//$returnlink = 'index.php?option=' . $option . '&amp;Itemid=' . $Itemid;

	return $row;
}

function removeEvent( $agid ) {
	global $database, $option, $Itemid;

	$cfg = & EventsConfig::getInstance();

	//Get Category ID prior to removing event, in order to update counts
	$query = "SELECT catid"
	. "\n FROM #__events"
	. "\n WHERE id = '$agid'"
	;
	$database->setQuery( $query );
	$catid = $database->loadResult();

	$query = "DELETE FROM #__events"
	. "\n WHERE id = '$agid'"
	;
	$database->setQuery( $query );
	if( !$database->query() ){
		echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
	}

	// Update Category Count
	$query = "UPDATE #__categories"
	. "\n SET count = count-1"
	. "\n WHERE id = '$catid'"
	;
	$database->setQuery( $query );
	if( !$database->query() ){
		echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
		exit();
	}

	$returnlink = sefRelToAbs( 'index.php?option=' . $option . '&amp;Itemid=' . $Itemid );
	jevRedirect( $returnlink, html_entity_decode( _CAL_LANG_ACT_DELETED ));
}

function listEventsById( $agid, $includeUnpublished=0 ) {
	global $database, $gid, $access;
	// dmcd May 7/04 added category access condition
	//$sql = "SELECT * FROM #__events WHERE id = '$agid' AND state = '1'";
	/*
	$sql = "SELECT #__events.* FROM #__categories AS b, #__events
	WHERE #__events.catid = b.id AND b.access <= $gid AND #__events.access <= $gid AND
	#__events.id = '$agid' AND #__events.state = '1'";

	$database->setQuery($sql);
	*/
	if( $access->canPublish && $includeUnpublished ){
		$query = "SELECT *"
		. "\n FROM #__events"
		. "\n WHERE #__events.catid IN(".accessibleCategoryList().")"
		. "\n AND #__events.access <= $gid"
		. "\n AND #__events.id = '$agid'"
		;
	}else{
		$query = "SELECT *"
		. "\n FROM #__events"
		. "\n WHERE #__events.catid IN(".accessibleCategoryList().")"
		. "\n AND #__events.access <= $gid"
		. "\n AND #__events.id = '$agid'"
		. "\n AND #__events.state = '1'"
		;
	}
	$database->setQuery( $query );

	$detevent = $database->loadObjectList();
	return $detevent;
}

function listEventsByDateNEW( $select_date ){
	global $database, $gid;

	$query = "SELECT #__events.*"
	. "\n , YEAR(publish_up  ) as yup, MONTH(publish_up  ) as mup, DAYOFMONTH(publish_up  ) as dup"
	. "\n , YEAR(publish_down) as ydn, MONTH(publish_down) as mdn, DAYOFMONTH(publish_down) as ddn"
	. "\n , HOUR(publish_up  ) as hup, MINUTE(publish_up  ) as minup, SECOND(publish_up  ) as sup"
	. "\n , HOUR(publish_down) as hdn, MINUTE(publish_down) as mindn, SECOND(publish_down) as sdn"
	. "\n FROM #__events"
	. "\n WHERE #__events.catid IN(".accessibleCategoryList().")"
	. "\n AND #__events.access <= $gid"
	. "\n AND ((publish_up >= '$select_date 00:00:00' AND publish_up <= '$select_date 23:59:59')"
	. "\n OR (publish_down >= '$select_date 00:00:00' AND publish_down <= '$select_date 23:59:59')"
	. "\n OR (publish_up <= '$select_date 00:00:00' AND publish_down >= '$select_date 23:59:59')"
	. "\n OR (publish_up >= '$select_date 00:00:00' AND publish_down <= '$select_date 23:59:59')"  // added RC3
	. "\n )"
	. "\n AND #__events.state = '1'"
	. "\n ORDER BY publish_up ASC"
	;

	$database->setQuery( $query );
	$detevent = $database->loadObjectList();

	return $detevent;
}

function listEventsByWeekNEW( $weekstart, $weekend){
	global $database, $gid;

	$query = "SELECT #__events.*"
	. "\n , YEAR(publish_up  ) as yup, MONTH(publish_up  ) as mup, DAYOFMONTH(publish_up  ) as dup"
	. "\n , YEAR(publish_down) as ydn, MONTH(publish_down) as mdn, DAYOFMONTH(publish_down) as ddn"
	. "\n , HOUR(publish_up  ) as hup, MINUTE(publish_up  ) as minup, SECOND(publish_up  ) as sup"
	. "\n , HOUR(publish_down) as hdn, MINUTE(publish_down) as mindn, SECOND(publish_down) as sdn"
	. "\n FROM #__events"
	. "\n WHERE #__events.catid IN(".accessibleCategoryList().")"
	. "\n AND #__events.access <= $gid"
	. "\n AND ((publish_up >= '$weekstart 00:00:00' AND publish_up <= '$weekend 23:59:59')"
	. "\n OR (publish_down >= '$weekstart 00:00:00' AND publish_down <= '$weekend 23:59:59')"
	. "\n OR (publish_up <= '$weekstart 00:00:00' AND publish_down >= '$weekend 23:59:59')"
	. "\n OR (publish_up >= '$weekstart 00:00:00' AND publish_down <= '$weekend 23:59:59')"
	. "\n )"
	. "\n AND #__events.state = '1'"
	. "\n ORDER BY publish_up ASC"
	;

	$database->setQuery( $query );
	$detevent = $database->loadObjectList();

	return $detevent;
}

function listEventsByMonthNew( $year, $month, $order ){
	global $database, $gid;

	$cfg = & EventsConfig::getInstance();

	$select_date 		= $year . '-' . $month . '-01 00:00:00';
	$select_date_fin 	= $year . '-' . $month . '-' . date( 't', mktime( 0, 0, 0, ( $month + 1 ), 0, $year ))
	. ' 23:59:59';

	if( !$order ){
		$order = 'publish_up';
	}
	//echo "<b>STILL EXPERMIENTING</b><br/>";

	$query = "SELECT #__events.*"
	. "\n , YEAR(publish_up  ) as yup, MONTH(publish_up  ) as mup, DAYOFMONTH(publish_up  ) as dup"
	. "\n , YEAR(publish_down) as ydn, MONTH(publish_down) as mdn, DAYOFMONTH(publish_down) as ddn"
	. "\n , HOUR(publish_up  ) as hup, MINUTE(publish_up  ) as minup, SECOND(publish_up  ) as sup"
	. "\n , HOUR(publish_down) as hdn, MINUTE(publish_down) as mindn, SECOND(publish_down) as sdn"
	. "\n FROM #__events"
	. "\n WHERE #__events.catid IN(".accessibleCategoryList().")"
	. "\n AND #__events.access <= $gid"
	. "\n AND (((publish_up >= '$select_date%' AND publish_up <= '$select_date_fin%')"
	. "\n OR (publish_down >= '$select_date%' AND publish_down <= '$select_date_fin%')"
	. "\n OR (publish_up >= '$select_date%' AND publish_down <= '$select_date_fin%')"
	. "\n OR (publish_up <= '$select_date%' AND publish_down >= '$select_date_fin%')"
	. "\n )"
	. "\n AND #__events.state = '1')"
	. "\n ORDER BY $order ASC" //publish_up ASC, reccurtype ASC
	;
	$database->setQuery( $query );
	$detevent = $database->loadObjectList();

	return $detevent;
}

// listEventsByWeek NOT USED
/*
function listEventsByWeek ($year,$month,$day,$offset) {
global $database;

$rows_per_page=20;
if (empty($offset) || !$offset) $offset=1;
$from = ($offset-1) * $rows_per_page;

$limit = "LIMIT $from, $rows_per_page";

$startday = _CAL_CONF_STARDAY;
$numday=((date("w",mktime(0,0,0,$month,$day,$year))-$startday)%7);
if ($numday == -1){
$numday = 6;
}
$week_start = mktime (0, 0, 0, $month, ($day - $numday), $year );
$week_end = $week_start + ( 3600 * 24 * 6 );
$startdate = date ( "Y-m-d 00:00:00", $week_start );
$enddate = date ( "Y-m-d 23:59:59", $week_end );

$sql = "SELECT * FROM #__events
WHERE ((publish_up >= '$startdate%' AND publish_up <= '$enddate%')
OR (publish_down >= '$startdate%' AND publish_down <= '$enddate%')
OR (publish_up >= '$startdate%' AND publish_down <= '$enddate%')
OR (publish_down >= '$enddate%' AND publish_up <= '$startdate%'))
AND state = '1' ORDER BY publish_up ASC $limit";

$database->setQuery($sql);
$detevent = $database->loadObjectList();
return $detevent;
}
*/

function listEventsByYearNEW( $year, $limitstart, $limit ) {
	global $database, $gid;

	$rows_per_page = $limit;

	if( empty( $limitstart ) || !$limitstart ){
		$limitstart = 0;
	}

	$limit = "LIMIT $limitstart, $rows_per_page";

	$query = "SELECT *"
	. "\n , YEAR(publish_up  ) as yup, MONTH(publish_up  ) as mup, DAYOFMONTH(publish_up  ) as dup"
	. "\n , YEAR(publish_down) as ydn, MONTH(publish_down) as mdn, DAYOFMONTH(publish_down) as ddn"
	. "\n , HOUR(publish_up  ) as hup, MINUTE(publish_up  ) as minup, SECOND(publish_up  ) as sup"
	. "\n , HOUR(publish_down) as hdn, MINUTE(publish_down) as mindn, SECOND(publish_down) as sdn"
	. "\n FROM #__events"
	. "\n WHERE #__events.catid IN(".accessibleCategoryList().")"
	. "\n AND #__events.access <= $gid"
	. "\n AND publish_up LIKE '$year%'"
	. "\n AND (publish_down >= '$year%' OR publish_down = '0000-00-00 00:00:00')"
	. "\n AND #__events.state = '1'"
	. "\n ORDER BY publish_up ASC $limit"
	;
	$database->setQuery( $query );
	$detevent = $database->loadObjectList();

	return $detevent;
}

function listEventsByCreator( $creator_id, $limitstart, $limit ){
	global $database, $gid, $access;

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
	// dmcd May 7/04 added category access condition
	/*
	$sql = "SELECT #__events.* FROM #__categories AS b, #__events
	WHERE #__events.catid = b.id AND b.access <= $gid AND #__events.access <= $gid AND
	$where #__events.state='1' ORDER BY publish_up ASC $limit";
	*/
	// Show unpublished events too for publishers and above listing events created by others too!

	$frontendPublish = $cfg->get('com_frontendPublish', 0) > 0;

	if( $access->canPublish && $frontendPublish ){
		$query = "SELECT *"
		. "\n FROM #__events"
		. "\n WHERE #__events.catid IN(".accessibleCategoryList().")"
		. "\n AND #__events.access <= $gid"
		. "\n ORDER BY publish_up ASC $limit"
		;
	}else{
		$query = "SELECT *"
		. "\n FROM #__events"
		. "\n WHERE #__events.catid IN(".accessibleCategoryList().")"
		. "\n AND #__events.access <= $gid $where"
		. "\n AND #__events.state='1'"
		. "\n ORDER BY publish_up ASC $limit"
		;
	}
	$database->setQuery( $query );
	$detevent = $database->loadObjectList();

	return $detevent;
}

function listEventsByCat( $catid, $limitstart, $limit ){
	global $database, $gid, $option;

	$rows_per_page = $limit;
	if( empty( $limitstart ) || !$limitstart ){
		$limitstart = 0;
	}

	$limit = "LIMIT $limitstart, $rows_per_page";

	// dmcd May 7/04  not sure if this is correct, need to look at function caller to see
	if( $catid ){
		/*
		$sql = "SELECT * FROM #__categories AS b,#__events
		WHERE #__events.catid = '$catid' AND #__events.catid = b.id AND b.access <= $gid AND
		#__events.access <= $gid AND #__events.state = '1' ORDER BY #__events.publish_up ASC $limit";
		*/
		/* GWE change to allow mambelfish to work!*/

		$query = "SELECT #__events.*"
		. "\n FROM #__events"
		. "\n WHERE #__events.catid IN($catid)"
		. "\n AND #__events.catid IN(".accessibleCategoryList().")"
		. "\n AND #__events.access <= $gid"
		. "\n AND #__events.state = '1'"
		. "\n ORDER BY publish_up ASC $limit"
		;
	} else {
		/*
		$sql = "SELECT #__events.* FROM #__categories AS b, #__events
		WHERE #__events.catid = b.id AND b.access <= $gid AND #__events.access <= $gid AND
		b.section='$option' AND b.published='1' AND #__events.state = '1' ORDER BY #__events.publish_up ASC $limit";
		*/
		/* GWE change to allow mambelfish to work!*/

		$query = "SELECT #__events.*"
		. "\n FROM #__events"
		. "\n WHERE #__events.catid IN(".accessibleCategoryList().")"
		. "\n AND #__events.access <= $gid"
		. "\n AND #__events.state = '1'"
		. "\n ORDER BY publish_up ASC $limit"
		;
	}

	$database->setQuery( $query );
	$detevent = $database->loadObjectList();

	return $detevent;
}

function listEventsByKeyword( $keyword, $order, $limit, $limitstart, $useRegX=false ){
	global $database, $gid;

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
		$database->setQuery( $query );
		$index = $database->loadObjectList('Key_name');

		if( !array_key_exists( 'searchIdx', $index ) || $index['searchIdx']->Index_type != 'FULLTEXT' ){
			// dmcd go add the required index now
			$query = "ALTER TABLE #__events"
			. "\n ADD FULLTEXT searchIdx (title, content)"
			;
			$database->setQuery( $query );
			$database->query();
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

	// dmcd May 7/04 added category access condition
	// $sql = "SELECT * FROM #__events"
	// WHERE (title LIKE '$keyword' OR content LIKE '$keyword') AND state = '1' ORDER BY $order ASC $limit";

	$query = "SELECT #__events.*"
	. "\n FROM #__categories AS b, #__events"
	. "\n WHERE #__events.catid = b.id"
	. "\n AND b.access <= $gid"
	. "\n AND #__events.access <= $gid"
	. "\n AND\n"
	;

	$query .= ( $useRegX ) ? "(#__events.title RLIKE '$keyword' OR #__events.content RLIKE '$keyword')\n" :
	"MATCH (#__events.title, #__events.content) AGAINST ('$keyword' IN BOOLEAN MODE)\n";
	$query .= "AND #__events.state = '1'"
	. "\n ORDER BY $order ASC $limit"
	;

	$database->setQuery( $query );
	$detevent = $database->loadObjectList();

	return $detevent;
}

function showNavTableBar( $year, $month, $day, $option, $task, $Itemid ){
	// this, previous and next date handling
	global $mosConfig_offset;

	$cfg = & EventsConfig::getInstance();

	$datetime = strftime( '%Y-%m-%d %H:%M:%S', jevNow(true));
	ereg( "([0-9]{4})-([0-9]{2})-([0-9]{2})[ ]([0-9]{2}):([0-9]{2}):([0-9]{2})", $datetime, $regs );

	$this_date = new mosEventDate();
	$this_date->setDate( $year, $month, $day );

	$today_date = clone($this_date);
	$today_date->setDate( $regs[1], $regs[2], $regs[3] );

	$prev_year = clone($this_date);
	$prev_year->addMonths( -12 );
	$next_year = clone($this_date);
	$next_year->addMonths( +12 );

	$prev_month = clone($this_date);
	$prev_month->addMonths( -1 );
	$next_month = clone($this_date);
	$next_month->addMonths( +1 );

	$prev_week = clone($this_date);
	$prev_week->addDays( -7 );
	$next_week = clone($this_date);
	$next_week->addDays( +7 );

	$prev_day = clone($this_date);
	$prev_day->addDays( -1 );
	$next_day = clone($this_date);
	$next_day->addDays( +1 );

	switch( $task ){
		case 'view_year':
			$dates['prev2'] = $prev_year;
			$dates['prev1'] = $prev_year;
			$dates['next1'] = $next_year;
			$dates['next2'] = $next_year;

			$alts['prev2'] = _CAL_LANG_PREVIOUSYEAR;
			$alts['prev1'] = _CAL_LANG_PREVIOUSYEAR;
			$alts['next1'] = _CAL_LANG_NEXTYEAR;
			$alts['next2'] = _CAL_LANG_NEXTYEAR;

			// Show
			if($cfg->get('com_calUseIconic', 1) == 1) HTML_events::viewNavTableBarIconic( $today_date, $this_date, $dates, $alts, $option, $task, $Itemid );
			else  HTML_events::viewNavTableBar( $today_date, $this_date, $dates, $alts, $option, $task, $Itemid );
			break;

		case 'view_last':
		case 'view_month':
			$dates['prev2'] = $prev_year;
			$dates['prev1'] = $prev_month;
			$dates['next1'] = $next_month;
			$dates['next2'] = $next_year;

			$alts['prev2'] = _CAL_LANG_PREVIOUSYEAR;
			$alts['prev1'] = _CAL_LANG_PREVIOUSMONTH;
			$alts['next1'] = _CAL_LANG_NEXTMONTH;
			$alts['next2'] = _CAL_LANG_NEXTYEAR;

			// Show
			if($cfg->get('com_calUseIconic', 1) == 1) HTML_events::viewNavTableBarIconic( $today_date, $this_date, $dates, $alts, $option, $task, $Itemid );
			else  HTML_events::viewNavTableBar( $today_date, $this_date, $dates, $alts, $option, $task, $Itemid );
			break;

		case 'view_week':
			$dates['prev2'] = $prev_month;
			$dates['prev1'] = $prev_week;
			$dates['next1'] = $next_week;
			$dates['next2'] = $next_month;

			$alts['prev2'] = _CAL_LANG_PREVIOUSMONTH;
			$alts['prev1'] = _CAL_LANG_PREVIOUSWEEK;
			$alts['next1'] = _CAL_LANG_NEXTWEEK;
			$alts['next2'] = _CAL_LANG_NEXTMONTH;

			// Show
			if($cfg->get('com_calUseIconic', 1) == 1) HTML_events::viewNavTableBarIconic( $today_date, $this_date, $dates, $alts, $option, $task, $Itemid );
			else HTML_events::viewNavTableBar( $today_date, $this_date, $dates, $alts, $option, $task, $Itemid );
			break;

		case 'view_day':
		default:
			$dates['prev2'] = $prev_month;
			$dates['prev1'] = $prev_day;
			$dates['next1'] = $next_day;
			$dates['next2'] = $next_month;

			$alts['prev2'] = _CAL_LANG_PREVIOUSMONTH;
			$alts['prev1'] = _CAL_LANG_PREVIOUSDAY;
			$alts['next1'] = _CAL_LANG_NEXTDAY;
			$alts['next2'] = _CAL_LANG_NEXTMONTH;

			// Show
			if($cfg->get('com_calUseIconic', 1) == 1) HTML_events::viewNavTableBarIconic( $today_date, $this_date, $dates, $alts, $option, "view_day", $Itemid );
			else HTML_events::viewNavTableBar( $today_date, $this_date, $dates, $alts, $option, $task, $Itemid );
			break;
	}
}

// page navigation
function showNavTableText( $year, $total, $limitstart, $limit, $task ){
	global $option, $Itemid, $mainframe;

	if ( ( $total <= $limit ) ) {
		// not visible when they is no 'other' pages to display
	} else {
		// get the total number of records
		$limitstart = $limitstart ? $limitstart : 0;

		require_once( mosMainFrame::getCfg( 'absolute_path' ). '/includes/pageNavigation.php' );
		$pageNav = new mosPageNav( $total, $limitstart, $limit );

		$link = 'index.php?option=' .$option. '&amp;task=' .$task. '&amp;year=' .$year. '&amp;Itemid='. $Itemid;
		//echo '<tr>';
		//echo '<td valign="top" align="center">';
		echo  '<center>';
		echo $pageNav->writePagesLinks( $link );
		echo  '</center><br />';
		//echo '</td>';
		//echo '</tr>';
	}
}

function showEventsByYearNEW( $year, $limit, $limitstart ){
	global $database, $option, $Itemid, $gid, $mosConfig_list_limit;
	global $mainframe;

	$cfg = & EventsConfig::getInstance();

	include_once(mosMainFrame::getBasePath()."/administrator/components/com_events/colorMap.php");

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
	$database->setQuery( $query );
	$counter = $database->loadObjectList();

	$total = count( $counter );

	// MLr: discuss replacing _CAL_CONF_EVENT_LIST_ROWS_PPG with $mosConfig_list_limit
	$limit = $limit ? $limit : $cfg->get('com_calEventListRowsPpg');

	if( $total <= $limit ) {
		$limitstart = 0;
	}

	if ($cfg->get('com_showrepeats') == '1') {
		echo '<fieldset id="ev_fieldset"><legend class="ev_fieldset">' . _CAL_LANG_ARCHIVE . '</legend><br />' . "\n";
		echo '<table align="center" width="90%" cellspacing="0" cellpadding="0" class="ev_table">' . "\n";
		?>
            <tr valign="top">
                <td colspan="2"  align="center" class="cal_td_daysnames">
                   <!-- <div class="cal_daysnames"> -->
                    <?php echo $year ;?>
                    <!-- </div> -->
                </td>
            </tr>
		<?php
		for($month = 1; $month <= 12; $month++) {
			$month = str_pad($month, 2, '0', STR_PAD_LEFT);
			$rows  = listEventsByMonthNEW($year, $month, 'publish_up,catid');
			$num_events = count($rows);
			if ($num_events > 0){
				echo "<tr><td width='50' class='ev_td_left'>".mosEventsHTML::getDateFormat($year,$month,'',3)."</td>\n";
				echo "<td class='ev_td_right'><ul class='ev_ul'>\n ";
				for ($r = 0; $r < count($rows); $r++) {
					$row = $rows[$r];

					// skip repeat type year and not matching month
					if ($row->reccurtype == 5 & $month != $row->mup) continue;

					$contactlink		= mosEventsHTML::getUserMailtoLink($row->id, $row->created_by);
					$catid				= $row->catid;
					$catname			= mosEventsHTML::getCategoryName($row->catid);
					$bgcolor			= setColor($row);
					//$fgcolor			= mapColor($bgcolor);
					$fgcolor			= "inherit";
					//$listyle 			= 'style="background-color:'.$bgcolor.';color:'.$fgcolor.';margin-bottom:1px;"';
					$listyle = 'style="border-color:'.$bgcolor.';"';

					echo "<li class='ev_td_li' $listyle>\n";
					HTML_events::viewEventRow ($row->id,$row->title,'view_detail',$row->yup,$row->mup,$row->dup,$contactlink, $option, $Itemid, $fgcolor,$bgcolor);
					echo "&nbsp;::&nbsp;";
					HTML_events::viewEventCatRow ($catid,$catname,'view_cat',$row->yup,$row->mup,$row->dup,$option,$Itemid, $fgcolor,$bgcolor);
					echo "</li>\n";
				}
				echo '</ul></td></tr>' . "\n";

			}
		}
		echo '</table><br />' . "\n";
		echo '</fieldset><br />' . "\n";
	} else {

		$rows 		= listEventsByYearNEW( $year, $limitstart, $limit );
		$num_events = count( $rows );
		$chdate 	= '';

		echo '<fieldset id="ev_fieldset"><legend class="ev_fieldset">' . _CAL_LANG_ARCHIVE . '</legend><br />' . "\n";
		echo '<table align="center" width="90%" cellspacing="0" cellpadding="5" class="ev_table">' . "\n";

		if( $num_events > 0 ){
			for( $r = 0; $r < count( $rows ); $r++ ) {
				$row = $rows[$r];

				$event_month_year 	= $row->mup . $row->yup;
				$contactlink 		= mosEventsHTML::getUserMailtoLink( $row->id, $row->created_by );
				$catid 				= $row->catid;
				$catname 			= mosEventsHTML::getCategoryName( $row->catid );
				$bgcolor			= setColor($row);
				//$fgcolor			= mapColor($bgcolor);
				$fgcolor			= "inherit";
				//$listyle 			= 'style="background-color:'.$bgcolor.';color:'.$fgcolor.';margin-bottom:1px;"';
				$listyle = 'style="border-color:'.$bgcolor.';"';
				if(( $event_month_year <> $chdate ) && $chdate <> '' ){
					echo '</ul></td></tr>' . "\n";
				}

				if( $event_month_year <> $chdate ){
					echo '<tr><td width="50" class="ev_td_left">'
					. mosEventsHTML::getDateFormat( $row->yup, $row->mup, '', 3 ) . '</td>' . "\n";
					echo '<td class="ev_td_right"><ul class="ev_ul">' . "\n ";
				}

				echo "<li class='ev_td_li' $listyle>\n";
				HTML_events::viewEventRow( $row->id, $row->title, 'view_detail', $row->yup, $row->mup, $row->dup, $contactlink, $option, $Itemid, $fgcolor,$bgcolor);

				echo '&nbsp;::&nbsp;';
				HTML_events::viewEventCatRow( $catid, $catname, 'view_cat', $row->yup, $row->mup, $row->dup, $option, $Itemid, $fgcolor,$bgcolor);
				echo "</li>\n";
				$chdate = $event_month_year;
			}
			echo "</ul></td>\n";
		} else {
			echo '<tr>';
			echo '<td align="left" valign="top" class="ev_td_right">' . "\n";
			echo _CAL_LANG_NO_EVENTFOR . '&nbsp;<b>' . $year . '</b></td>';
		}
		echo '</tr></table><br />' . "\n";
		echo '</fieldset><br />' . "\n";
	}
	showNavTableText( $year, $total, $limitstart, $limit, 'view_year' );
}

function showEventsById( $agid, $year, $month, $day ){
	global $database, $option, $Itemid,$mainframe,$pop;

	$cfg = & EventsConfig::getInstance();

	// MLr: check if called from detail navigation. if yes, only showEventsByDate make sense
	if( 0 == $agid ) {
		showEventsByDate ($year,$month,$day);
	} else {
		$rows = listEventsById ($agid, 1);  // include unpublished events for publishers and above

		if( $rows ){
			$row = $rows[0];
		}else{
			$row=null;
		}

		$num_row = count($row);

		if( $num_row ){
			$params =& new mosParameters(null);
			$contactlink = mosEventsHTML::getUserMailtoLink( $row->id, $row->created_by );

			$event_up = new mosEventDate( $row->publish_up );
			$row->start_date = mosEventsHTML::getDateFormat( $event_up->year, $event_up->month, $event_up->day, 0 );
			$row->start_time = ( $cfg->get('com_calUseStdTime')== '1' ) ? $event_up->get12hrTime() : $event_up->get24hrTime();


			$event_down = new mosEventDate( $row->publish_down );
			$row->stop_date = mosEventsHTML::getDateFormat( $event_down->year, $event_down->month, $event_down->day, 0 );
			$row->stop_time = ( $cfg->get('com_calUseStdTime') == '1' ) ? $event_down->get12hrTime() : $event_down->get24hrTime();

			// jul 8th/04  dmcd - kludge for overnite events, advance the displayed stop_date by 1 day
			// when an overniter is detected
			if( $row->stop_time < $row->start_time )
			$event_down->addDays(1);


			// Parse http and  wrap in <a> tag
			// trigger content mambot/plugin

			global $jev_dispatcher;

			$pattern = '[a-zA-Z0-9&?_.=%\-]';
			// Adresse
			$row->adresse_info = preg_replace('#(http://)('.$pattern.'*)#i', '<a href="\\1\\2">\\1\\2</a>', $row->adresse_info);
			$obj = new stdClass();
			$obj->text = $row->adresse_info;
			$jev_dispatcher->trigger( 'onPrepareContent', array( &$obj, &$params, null ), true);
			$row->adresse_info = $obj->text;

			//Contact 
			$row->contact_info = preg_replace('#(http://)('.$pattern.'*)#i', '<a href="\\1\\2">\\1\\2</a>', $row->contact_info);
			$obj->text = new stdClass();
			$obj->text = $row->contact_info;
			$jev_dispatcher->trigger( 'onPrepareContent', array( &$obj, &$params, null ), true );
			$row->contact_info=$obj->text;

			//Extra
			$row->extra_info = preg_replace('#(http://)('.$pattern.'*)#i', '<a href="\\1\\2">\\1\\2</a>', $row->extra_info);
			$obj->text = new stdClass();
			$obj->text = $row->extra_info;
			$jev_dispatcher->trigger( 'onPrepareContent', array( &$obj, &$params, null ), true );
			$row->extra_info=$obj->text;

			$mask = mosMainFrame::getCfg( 'hideAuthor' ) ? MASK_HIDEAUTHOR : 0;
			$mask |= mosMainFrame::getCfg( 'hideCreateDate' ) ? MASK_HIDECREATEDATE : 0;
			$mask |= mosMainFrame::getCfg( 'hideModifyDate' ) ? MASK_HIDEMODIFYDATE : 0;

			$mask |= mosMainFrame::getCfg( 'hidePdf' ) ? MASK_HIDEPDF : 0;
			$mask |= mosMainFrame::getCfg( 'hidePrint' ) ? MASK_HIDEPRINT : 0;
			$mask |= mosMainFrame::getCfg( 'hideEmail' ) ? MASK_HIDEEMAIL : 0;

			//$mask |= mosMainFrame::getCfg( 'vote' ) ? MASK_VOTES : 0;
			$mask |= mosMainFrame::getCfg( 'vote' ) ? (MASK_VOTES|MASK_VOTEFORM) : 0;
			$mask |= $pop ? MASK_POPUP | MASK_IMAGES | MASK_BACKTOLIST : 0;

			// Dynamic Page Title
			// Joomla1.5
			global $mainframe;
			if (isset($mainframe)) $mainframe->SetPageTitle( $row->title );

			HTML_events::viewEventDetail($row, $contactlink, $mask, $params);

			$query = "UPDATE #__events"
			. "\n SET hits=(hits+1)"
			. "\n WHERE id='$row->id'"
			;
			$database->setQuery( $query );
			if( !$database->query() ) {
				echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
				exit();
			}
		}
	}
}

function showEventsByDateNEW( $year, $month, $day ){
	global $database, $option, $Itemid, $catid;
	global $mainframe;

	$cfg = & EventsConfig::getInstance();

	include_once(mosMainFrame::getBasePath()."/administrator/components/com_events/colorMap.php");

	$select_date		= sprintf( '%4d-%02d-%02d', $year, $month, $day );
	$rows				= listEventsByDateNEW( $select_date );
	$target_date = mktime(0,0,0,$month,$day,$year);

	usort( $rows, 'sortEvents' );

	$num_events			= count( $rows );
	$chhours 			= '';
	$printcount 		= 0;
	$new_rows_events 	= array();

	if( $num_events > 0 ){

		$repeatArray = array();
		for( $i = 0; $i < $num_events; $i++ ){
			// build array of dates for each event
			$repeatArray[$i] = mosEventRepeatArrayDay( $rows[$i], $year, $month, $day);
		}

		for( $r = 0; $r < $num_events; $r++ ){
			$row = $rows[$r];

			$event_up = new mosEventDate( $row->publish_up );
			$event_up->day		= sprintf( '%02d',	$event_up->day );
			$event_up->month 	= sprintf( '%02d',	$event_up->month );
			$event_up->year 	= sprintf( '%4d',	$event_up->year );

			$start_time 		= ( $cfg->get('com_calUseStdTime') == '1' ) ? $event_up->get12hrTime() : $event_up->get24hrTime();

			// if start and end times are the same show no start time
			$event_down	= new mosEventDate( $row->publish_down );
			$end_time	= ($cfg->get('com_calUseStdTime') == "1") ? $event_down->get12hrTime() : $event_down->get24hrTime();

			if ($start_time == $end_time) {
				$start_time = " ";
			}

			$new_contactlink	= mosEventsHTML::getUserMailtoLink( $row->id, $row->created_by );
			$new_catname		= mosEventsHTML::getCategoryName( $row->catid );

			$checkprint = new stdClass();
			$checkprint->viewable = false;
			if (array_key_exists($target_date,$repeatArray[$r]))  $checkprint->viewable = true ;

			if( $checkprint->viewable == true ){
				$new_rows_events[] = array($start_time,
				$row->id,
				$row->title,
				$event_up->year,
				$event_up->month,
				$event_up->day,
				$new_contactlink,
				$row->catid,
				$new_catname,
				$row->color_bar,
				$row->useCatColor,
				$row);
				$printcount++;
			}
		}
	}

	//////////////////////////////////// AFFICHAGE DU TABLEAU
	echo '<fieldset><legend class="ev_fieldset">' . _CAL_LANG_EVENTSFORTHE .'</legend><br />' . "\n";

	echo '<table align="center" width="90%" cellspacing="0" cellpadding="5" class="ev_table">' . "\n";
    ?>
            <tr valign="top">
                <td colspan="2"  align="center" class="cal_td_daysnames">
                   <!-- <div class="cal_daysnames"> -->
                    <?php echo mosEventsHTML::getDateFormat( $year, $month, $day, 0) ;?>
                    <!-- </div> -->
                </td>
            </tr>
	<?php

	if( $new_rows_events ) {
		$num_newevents = count( $new_rows_events );
	} else {
		$num_newevents = 0;
	}

	if( $num_newevents > 0 ){

		//sort ($new_rows_events); // Commenting out fixes bug #2606
		for( $t = 0; $t < $num_newevents; $t++ ){
			list( $start_time,
			$id,
			$title,
			$event_year,
			$event_month,
			$event_day,
			$contactlink,
			$catid,
			$catname,
			$color_bar,
			$useCatColor,
			$row ) =  $new_rows_events[$t];

			if(( $start_time <> $chhours ) && $chhours <> '' ){
				echo '</ul></td>' . "\n";
			}

			if( $start_time <> $chhours ){
				echo '<tr><td align="center" valign="top" width="50" class="ev_td_left">' . $start_time . '</td>' . "\n";
				echo '<td class="ev_td_right"><ul class="ev_ul">' . "\n";
			}

			$bgcolor			= setColor($row);
			//$fgcolor			= mapColor($bgcolor);
			$fgcolor			= "inherit";
			//$listyle 			= 'style="background-color:'.$bgcolor.';color:'.$fgcolor.';margin-bottom:1px;"';
			$listyle = 'style="border-color:'.$bgcolor.';"';
			echo "<li class='ev_td_li' $listyle>\n";
			HTML_events::viewEventRow ( $id, $title, 'view_detail', $event_year, $event_month, $event_day, $contactlink, $option, $Itemid,$fgcolor);

			echo '&nbsp;::&nbsp;';

			HTML_events::viewEventCatRow( $catid, $catname, 'view_cat', $year, $month, $day, $option, $Itemid,$fgcolor,$bgcolor);
			echo "</li>\n";

			$chhours = $start_time;
		}
		echo "</ul></td></tr>\n";
	} else {
		echo '<tr>';
		echo '<td align="left" valign="top" class="ev_td_right">' . "\n";
		echo _CAL_LANG_NO_EVENTFORTHE . '&nbsp;<b>' . mosEventsHTML::getDateFormat( $year, $month, $day, 0 ) . '</b>';
		echo "</td></tr>";
	} // end if

	echo '</table><br />' . "\n";
	echo '</fieldset><br /><br />' . "\n";
	//  showNavTableText(10, 10, $num_events, $offset, '');
}


function showEventsByMonthNEW( $year, $month ){
	global $database, $option, $Itemid, $mosConfig_offset, $catid,$mainframe;

	$cfg = & EventsConfig::getInstance();
	include_once(mosMainFrame::getBasePath()."/administrator/components/com_events/colorMap.php");

	$rows 		= listEventsByMonthNew( $year, $month, 'publish_up,catid' );
	$num_events = count( $rows );
	$chdate 	= '';
	$chcat 		= '';

	$rowcount = count( $rows );

	usort( $rows, 'sortEvents' );

	$repeatArray = array();
	for( $i = 0; $i < $rowcount; $i++ ){
		// build array of dates for each event
		//$repeatArray[$i] = mosEventRepeatArray( $rows[$i], $year, $month );
		$repeatArray[$i] = mosEventRepeatArrayMonth( $rows[$i], $year, $month );
	}

	echo '<fieldset><legend class="ev_fieldset">' . _CAL_LANG_EVENTSFOR . '</legend><br />' . "\n";
	echo '<table align="center" width="90%" cellspacing="0" cellpadding="5" class="ev_table">' . "\n";
	?>
	<tr valign="top">
		<td colspan="2"  align="center" class="cal_td_daysnames">
			<?php echo mosEventsHTML::getDateFormat( $year, $month, '', 3 );?>
		</td>
	</tr>
	<?php

	if( $num_events > 0 ){

		for( $d = 1; $d <= date( 't', mktime( 0, 0, 0,( $month + 1 ), 0, $year )); $d++ ){

			$cellDate = mktime (0, 0, 0, $month, $d, $year);

			if( $rowcount > 0 ){
				$dayHasEvent = false;

				for( $i = 0; $i < $rowcount && !$dayHasEvent; $i++ ){
					if (array_key_exists($cellDate,$repeatArray[$i])) $dayHasEvent=true;
				}

				if ($dayHasEvent){
					echo '<tr>';
					echo '<td align="center" valign="top" class="ev_td_left">';
					echo mosEventsHTML::getDateFormat( $year, $month, $d, 7 );
					echo '</td>' . "\n";
					echo '<td align="left" valign="top" class="ev_td_right"><ul class="ev_ul">' . "\n";

					for( $i = 0; $i < $rowcount; $i++ ){
						$row = $rows[$i];
						if (array_key_exists($cellDate,$repeatArray[$i])){
							$event_up = new mosEventDate( $row->publish_up );
							$contactlink 		= mosEventsHTML::getUserMailtoLink( $row->id, $row->created_by );
							$catname			= mosEventsHTML::getCategoryName( $row->catid );
							$bgcolor			= setColor($row);
							//$fgcolor			= mapColor($bgcolor);
							$fgcolor			= "inherit";
							//$listyle 			= 'style="background-color:'.$bgcolor.';color:'.$fgcolor.';margin-bottom:1px;"';
							$listyle = 'style="border-color:'.$bgcolor.';"';
							echo "<li class='ev_td_li' $listyle>\n";
							HTML_events::viewEventRow ( $row->id, $row->title, 'view_detail', $event_up->year, $event_up->month, $event_up->day, $contactlink, $option, $Itemid,$fgcolor ,$bgcolor);

							echo '&nbsp;::&nbsp;';

							HTML_events::viewEventCatRow ( $row->catid, $catname, 'view_cat', $event_up->year, $event_up->month, $event_up->day, $option, $Itemid,$fgcolor ,$bgcolor);
							echo "</li>\n";
						}
					}
					echo '</ul></td></tr>' . "\n";
				}
			}
		}
	}
	echo '</table><br />' . "\n";
	echo '</fieldset><br /><br />' . "\n";
}

function showEventsByWeekNEW( $year, $month, $day ){
	global $mosConfig_offset, $database, $option, $Itemid;
	global $mainframe;

	global $catidsOut;
	$cat = "";
	if ($catidsOut != 0){
		$cat = '&amp;catids='.$catidsOut;
	}

	$cfg = & EventsConfig::getInstance();

	include_once(mosMainFrame::getBasePath()."/administrator/components/com_events/colorMap.php");

	// Other methode to investigate
	//$rows = listEventsByWeek ($year,$month,$day,$offset);
	//$max_events = count($rows);

	$startday 	= $cfg->get('com_starday', 0);
	$numday		= (( date( 'w', mktime( 0, 0, 0, $month, $day, $year )) - $startday ) %7 );

	if( $numday == -1 ){
		$numday = 6;
	}

	$week_start = mktime( 0, 0, 0, $month, ( $day - $numday ), $year );
	$week_end = mktime( 0, 0, 0, $month, ( $day - $numday )+6, $year ); // + 6 for inclusinve week

	$this_date = new mosEventDate();
	$this_date->setDate( strftime( '%Y', $week_start ), strftime( '%m', $week_start ), strftime( '%d', $week_start ));
	//$this_date->setDate( date ( "Y", $week_start ),date ( "m", $week_start ),date ( "d", $week_start ));
	$this_enddate = clone( $this_date );
	$this_enddate->addDays( +6 );

	$rows = listEventsByWeekNEW(strftime("%Y-%m-%d",$week_start),strftime("%Y-%m-%d",$week_end));

	$rowcount = count($rows);

	usort( $rows, 'sortEvents' );

	$repeatArray = array();
	for( $i = 0; $i < $rowcount; $i++ ){
		// build array of dates for each event
		$repeatArray[$i] = mosEventRepeatArrayWeek( $rows[$i], $week_start, $week_end);
	}

	$startdate	= mosEventsHTML::getDateFormat( $this_date->year, $this_date->month, $this_date->day, 1 );
	$enddate	= mosEventsHTML::getDateFormat( $this_enddate->year, $this_enddate->month, $this_enddate->day ,1 );

	echo '<fieldset><legend class="ev_fieldset">' . _CAL_LANG_EVENTSFOR . '&nbsp;' . _CAL_LANG_WEEK
	. ' : </legend><br />' . "\n";
	echo '<table align="center" width="90%" cellspacing="0" cellpadding="5" class="ev_table">' . "\n";
    ?>
            <tr valign="top">
                <td colspan="2"  align="center" class="cal_td_daysnames">
                   <!-- <div class="cal_daysnames"> -->
                    <?php echo  $startdate . ' - ' . $enddate ;?>
                    <!-- </div> -->
                </td>
            </tr>
	<?php

	$this_currentdate = clone( $this_date );

	for( $d = 0; $d < 7; $d++ ){
		if( $d > 0 ){
			$this_currentdate->addDays( +1 );
		}
		$week_day	= sprintf( '%02d', $this_currentdate->day );
		$week_month = sprintf( '%02d', $this_currentdate->month );
		$week_year 	= sprintf( '%4d', $this_currentdate->year );

		$link = sefRelToAbs( 'index.php?option=' . $option . '&amp;task=view_day&amp;year=' . $week_year
		. '&amp;month=' . $week_month . '&amp;day=' . $week_day . '&amp;Itemid=' . $Itemid . $cat);
		$day_link = '<a class="ev_link_weekday" href="' . $link . '" title="' . _CAL_LANG_CLICK_TOSWITCH_DAY . '">'
		. mosEventsHTML::getDateFormat( $week_year, $week_month, $week_day, 2 ) . '</a>' . "\n";

		//if($week_month==date("m")&$week_year==date("Y")&$week_day==date("d")) {

		if( $week_month == strftime( '%m', jevNow(true) )
		&& $week_year == strftime( '%Y', jevNow(true) )
		&& $week_day == strftime( '%d', jevNow(true) )
		) {
			$bg = 'class="ev_td_today"';
		}else{
			$bg = 'class="ev_td_left"';
		}

		echo '<tr><td align="center" valign="top" width="50" ' . $bg . '>' . $day_link . '</td>' . "\n";
		echo '<td class="ev_td_right">' . "\n";

		$select_date	= sprintf( '%4d-%02d-%02d', $week_year, $week_month, $week_day );
		//$rows			= listEventsByDateNEW( $select_date );
		$num_events		= count( $rows );
		$countprint		= 0;

		for( $r = 0; $r < $num_events; $r++ ){
			$row = $rows[$r];

			$event_up = new mosEventDate( $row->publish_up );
			$event_up->day		= sprintf( '%02d', $event_up->day );
			$event_up->month	= sprintf( '%02d', $event_up->month );
			$event_up->year		= sprintf( '%4d', $event_up->year );

			$contactlink 		= mosEventsHTML::getUserMailtoLink( $row->id, $row->created_by );
			$catname			= mosEventsHTML::getCategoryName( $row->catid );
			$bgcolor			= setColor($row);
			//$fgcolor			= mapColor($bgcolor);
			$fgcolor			= "inherit";
			//$listyle 			= 'style="background-color:'.$bgcolor.';color:'.$fgcolor.';margin-bottom:1px;"';
			$listyle = 'style="border-color:'.$bgcolor.';"';
			$checkprint = new stdClass();
			$checkprint->viewable = false;
			$target_date = mktime(0,0,0,$week_month,$week_day,$week_year);
			if (array_key_exists($target_date,$repeatArray[$r]))  $checkprint->viewable = true ;

			if( $checkprint->viewable == true ){

				// xhtml says I shouldn't open  <ul> that is empty! So only open it if I have something!!
				if ($countprint==0) echo "<ul class='ev_ul'>\n";
				echo "<li class='ev_td_li' $listyle>\n";
				HTML_events::viewEventRow ( $row->id, $row->title, 'view_detail', $event_up->year, $event_up->month, $event_up->day, $contactlink, $option, $Itemid,$fgcolor ,$bgcolor);

				echo '&nbsp;::&nbsp;';

				HTML_events::viewEventCatRow ( $row->catid, $catname, 'view_cat', $event_up->year, $event_up->month, $event_up->day, $option, $Itemid,$fgcolor ,$bgcolor);
				echo "</li>\n";

				$countprint++;
			}
		}
		if ($countprint>0) echo "</ul>\n";
		else echo "&nbsp";
		echo '</td></tr>' . "\n";
	} // end for days

	echo '</table><br />' . "\n";
	echo '</fieldset><br /><br />' . "\n";
	//showNavTableText(20, 20, $max_events, $offset, 'view_week');
}

function showEventsByCat( $catid, $limit, $limitstart ){
	global $database, $option, $Itemid, $gid;

	$cfg = & EventsConfig::getInstance();

	if( !$catid ){
		// no category selected
		// $sql = "SELECT * FROM #__categories as b, #__events WHERE #__events.catid = b.id AND b.access <= $gid"
		// AND #__events.access <= $gid AND #__events.state = '1'";
		/* GWE change to allow mambelfish to work!*/
		$query = "SELECT *"
		. "\n FROM #__events"
		. "\n WHERE #__events.catid IN(".accessibleCategoryList().")"
		. "\n AND #__events.access <= $gid"
		. "\n AND #__events.state = '1'"
		;
	}else {
		// category selected
		//$sql = "SELECT * FROM #__categories as b, #__events WHERE #__events.catid = b.id"
		// AND #__events.catid = '$catid' AND b.access <= $gid AND #__events.access <= $gid AND #__events.state = '1'";
		/* GWE change to allow mambelfish to work!*/
		$query = "SELECT *"
		. "\n FROM #__events"
		. "\n WHERE #__events.catid IN(".accessibleCategoryList().")"
		. "\n AND #__events.catid = '$catid'"
		. "\n AND #__events.access <= $gid"
		. "\n AND #__events.state = '1'"
		;
	}

	$database->setQuery( $query );
	//$max_events = $database->loadResult();
	$counter	= $database->loadObjectList();

	$total		= count( $counter );

	// MLr: discuss replacing _CAL_CONF_EVENT_LIST_ROWS_PPG with $mosConfig_list_limit
	$limit = $limit ? $limit : $cfg->get('com_calEventListRowsPpg');

	if ( $total <= $limit ) {
		$limitstart = 0;
	}

	$rows 		= listEventsByCat( $catid, $limitstart, $limit );
	$catname 	= mosEventsHTML::getCategoryName( $catid );
	$num_events = count( $rows );
	$chdate 	= '';

	if( $catid == 0 ) {
		$catname = _CAL_LANG_EVENT_CHOOSE_CATEG;
	}

	echo '<fieldset><legend class="ev_fieldset">' . $catname . '</legend><br />' . "\n";
	echo '<table align="center" width="90%" cellspacing="0" cellpadding="5" class="ev_table">' . "\n";
	if( $num_events > 0 ){
		for( $r = 0; $r < $num_events; $r++ ){
			$row = $rows[$r];

			$event_up = new mosEventDate( $row->publish_up );
			$event_up->day			= sprintf( '%02d', $event_up->day );
			$event_up->month		= sprintf( '%02d', $event_up->month );
			$event_up->year			= sprintf( '%4d', $event_up->year );
			$event_day_month_year 	= $event_up->day . $event_up->month . $event_up->year;

			$contactlink 			= mosEventsHTML::getUserMailtoLink( $row->id, $row->created_by );

			if(( $event_day_month_year <> $chdate ) && $chdate <> '' ){
				echo '</ul></td></tr>' . "\n";
			}

			if( $event_day_month_year <> $chdate ){
				echo '<tr><td align="center" valign="top" width="50" class="ev_td_left">'
				. mosEventsHTML::getDateFormat( $event_up->year, $event_up->month, $event_up->day, 1 ) . '</td>' . "\n";
				echo '<td align="left" valign="top" class="ev_td_right"><ul class="ev_ul">' . "\n";
			}

			$bgcolor = setColor($row);
			$listyle = 'style="border-color:'.$bgcolor.';"';

			echo "<li class='ev_td_li' $listyle>\n";
			HTML_events::viewEventRow ( $row->id, $row->title, 'view_detail', $event_up->year, $event_up->month, $event_up->day, $contactlink, $option, $Itemid, "#222222" );
			echo "</li>\n";

			$chdate = $event_day_month_year;
		}
		echo "</ul></td>\n";
	} else {
		echo '<tr>';
		echo '<td align="left" valign="top" class="ev_td_right">' . "\n";

		if( $catid==0 ){
			echo _CAL_LANG_EVENT_CHOOSE_CATEG . '</td>';
		} else {
			echo _CAL_LANG_NO_EVENTFOR . '&nbsp;<b>' . $catname . '</b></td>';
		}
	}

	echo '</tr></table><br />' . "\n";
	echo '</fieldset><br /><br />' . "\n";

	global $year;
	showNavTableText( $year, $total, $limitstart, $limit, 'view_cat&catid=' . $catid );
}

function showEventsByKeyword( $keyword, $limit, $limitstart, $useRegX=false ) {
	global $database, $option, $Itemid, $mosConfig_offset, $gid;
	global $mainframe;

	$cfg = & EventsConfig::getInstance();

	include_once(mosMainFrame::getBasePath()."/administrator/components/com_events/colorMap.php");

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

		$database->setQuery( $query );
		$counter	= $database->loadObjectList();

		$total		= count( $counter );

		// MLr: discuss replacing _CAL_CONF_EVENT_LIST_ROWS_PPG with $mosConfig_list_limit
		$limit = $limit ? $limit : $cfg->get('com_calEventListRowsPpg');

		if ( $total <= $limit ) {
			$limitstart = 0;
		}

		$rows 		= listEventsByKeyword( $keyword, 'publish_up,catid', $limit, $limitstart, $useRegX );
		$num_events = count( $rows );

	}

	$chdate	= '';
	$chcat	= '';
	echo '<fieldset><legend class="ev_fieldset">' . _CAL_LANG_SEARCHRESULTS. '&nbsp;:&nbsp;</legend><br />'
	. "\n";
	echo '<table align="center" width="90%" cellspacing="0" cellpadding="5" class="ev_table">' . "\n";
	?>
           <tr valign="top">
               <td colspan="2"  align="center" class="cal_td_daysnames">
                   <!-- <div class="cal_daysnames"> -->
                    <?php echo $keyword  ;?>
                    <!-- </div> -->
                </td>
            </tr>
	<?php
	//echo "<tr>";
	//echo "<td align='left' valign='top' class='ev_td_left'>\n";

	if( $num_events > 0 ){
		for( $r = 0; $r < $num_events; $r++ ){
			$row = $rows[$r];

			$event_up = new mosEventDate( $row->publish_up );
			$event_up->day			= sprintf( '%02d', $event_up->day);
			$event_up->month		= sprintf( '%02d', $event_up->month);
			$event_up->year			= sprintf( '%4d', $event_up->year);
			$event_day_month_year 	= $event_up->day . $event_up->month . $event_up->year;

			$catname				= mosEventsHTML::getCategoryName( $row->catid );
			$contactlink			= mosEventsHTML::getUserMailtoLink( $row->id, $row->created_by );

			if(( $event_day_month_year <> $chdate ) && $chdate <> '' ){
				echo '</td></tr></table></td>' . "\n";
			}

			if( $event_day_month_year <> $chdate ){
				echo '<tr>';

				if( $event_up->month == strftime( '%m', jevNow(true) )
				&& $event_up->year == strftime( '%Y', jevNow(true) )
				&& $event_up->day == strftime( '%d', jevNow(true) )
				){
					$bg = 'class="cal_td_today"';
				}else{
					$bg = 'class="ev_td_left"';
				}

				echo '<td align="center" valign="top" width="50" ' . $bg . '>';
				echo mosEventsHTML::getDateFormat( $event_up->year, $event_up->month, $event_up->day, 1 );
				echo '</td>' . "\n";
				echo '<td align="left" valign="top" class="ev_td_right">' . "\n";
				echo '<table align="center" width="100%" cellspacing="0" cellpadding="0">';
				echo '<tr><td align="center" valign="top" width="80">'; // class='ev_td_left'>";
				$chcat = '';
			}

			if(( $row->catid <> $chcat ) && $chcat <> '' ){
				echo '</td></tr>' . "\n";
			}

			$bgcolor = setColor($row);
			//$fgcolor = mapColor($bgcolor);
			$fgcolor   = "inherit";

			$tdstyle = 'style="background-color:'.$bgcolor.';color:'.$fgcolor.';margin-bottom:1px;"';

			if( $row->catid <> $chcat ){

				echo '<tr><td align="center" valign="top" width="80" '.$tdstyle.'>';// class='ev_td_left'>\n";
				echo '<b>';
				HTML_events::viewEventCatRow ( $row->catid, $catname, 'view_cat', $event_up->year, $event_up->month, $event_up->day, $option, $Itemid ,$fgcolor,$bgcolor);
				echo '</b></td>' . "\n";
				echo '<td align="left" valign="top"  '.$tdstyle.'>'; // class='ev_td_right'>\n";
			}

			if( $row->reccurtype == 5 ){ //each year
				if( $month == $event_up->month ){
					HTML_events::viewEventRow ( $row->id, $row->title, 'view_detail', $event_up->year, $event_up->month, $event_up->day, $contactlink, $option, $Itemid ,$fgcolor, $bgcolor);
				} else {
					echo '&nbsp;';
				}
			} else {
				HTML_events::viewEventRow ( $row->id, $row->title, 'view_detail', $event_up->year, $event_up->month, $event_up->day, $contactlink, $option, $Itemid ,$fgcolor,$bgcolor);
			}

			$chcat	= $row->catid;
			$chdate = $event_day_month_year;
		}
		echo '</td></tr></table>' . "\n";
	} else {
		//echo "<tr>";
		//echo "<td align='left' valign='top' class='ev_td_right'>\n";
		// new by mic
		if( $searchisValid ){
			echo _CAL_LANG_NO_EVENTFOR . '&nbsp;<b>' . $keyword . '</b>';
		}else{
			echo '<b>' . $keyword . '</b>';
			$keyword = '';
		}
	}

	echo '</td></tr></table><br />' . "\n";
	echo '</fieldset><br /><br />' . "\n";

	global $year;

	showNavTableText( $year, $total, $limitstart, $limit, 'search&keyword=' . $keyword);
}

function showEventsForAdmin( $creator_id, $limit, $limitstart ) {
	global $database, $option, $Itemid, $is_event_editor, $my, $gid, $access;

	$cfg = & EventsConfig::getInstance();

	$where = '';
	if( $creator_id <> 'ADMIN' ){
		//$where = "created_by = '$creator_id' AND";
		$where = "AND created_by = '$creator_id'";
	}

	//$sql = "SELECT count(id) as count FROM #__events WHERE created_by='$creator_id' AND state='1'";
	/*
	$sql = "SELECT #__events.* FROM #__categories AS b, #__events
	WHERE #__events.catid = b.id AND b.access <= $gid AND #__events.access <= $gid AND
	$where #__events.state='1'";
	*/

	$frontendPublish = $cfg->get('com_frontendPublish', 0) > 0;

	if( $access->canPublish && $frontendPublish ) {
		$sql = "SELECT * FROM #__events"
		. "\n WHERE #__events.catid IN(".accessibleCategoryList().")"
		. "\n AND #__events.access <= $gid";
	} else {
		$sql = "SELECT * FROM #__events"
		. "\n WHERE #__events.catid IN(".accessibleCategoryList().")"
		. "\n AND #__events.access <= $gid $where"
		. "\n AND #__events.state='1'";
	}

	$database->setQuery( $sql );
	//$max_events = $database->loadResult();
	$counter = $database->loadObjectList();

	$total = count( $counter );

	// MLr: discuss replacing _CAL_CONF_EVENT_LIST_ROWS_PPG with $mosConfig_list_limit
	$limit = $limit ? $limit : $cfg->get('com_calEventListRowsPpg');

	if ( $total <= $limit ) {
		$limitstart = 0;
	}

	$rows		= listEventsByCreator ($creator_id, $limitstart, $limit);
	$num_events = count( $rows );
	$chdate 	= '';

	echo '<fieldset><legend class="ev_fieldset">' . _CAL_LANG_ADMINPANEL . '</legend><br />' . "\n";
	echo '<table align="center" width="90%" cellspacing="0" cellpadding="5" class="ev_table">' . "\n";

	if( $num_events > 0 ){
		for( $r = 0; $r < $num_events; $r++ ) {
			$row = $rows[$r];

			$event_up			= new mosEventDate( $row->publish_up );
			$event_up->day		= sprintf( '%02d',	$event_up->day);
			$event_up->month 	= sprintf( '%02d',	$event_up->month);
			$event_up->year 	= sprintf( '%4d',	$event_up->year);
			$event_month_year 	= $event_up->month . $event_up->year;
			$contactlink 		= mosEventsHTML::getUserMailtoLink( $row->id, $row->created_by );

			if( $is_event_editor ){
				$link_day	= sprintf( '%02d', $event_up->day );
				$link_month = sprintf( '%02d', $event_up->month );
				$link_year	= sprintf( '%4d', $event_up->year );

				$deletelink = '<a href="' . sefRelToAbs( 'index.php?option=' . $option . '&amp;task=delete&amp;agid='
				. $row->id . '&amp;year=' . $link_year . '&amp;month=' . $link_month . '&amp;day=' . $link_day
				. '&amp;Itemid=' . $Itemid ) . '" title="'. _CAL_LANG_DELETE . '"><b>' . _CAL_LANG_DELETE . '</b></a>'
				. "\n";

				$modifylink = '<a href="' . sefRelToAbs( 'index.php?option=' . $option . '&amp;task=edit&amp;agid='
				. $row->id . '&amp;year=' . $link_year . '&amp;month=' . $link_month . '&amp;day=' . $link_day
				. '&amp;Itemid=' . $Itemid ) . '" title="' . _CAL_LANG_MODIFY . '"><b>' . _CAL_LANG_MODIFY . '</b></a>'
				. "\n";
			}

			if( $event_month_year <> $chdate && $chdate <> ""){
				echo '</ul></td></tr>' . "\n";
			}
			if( $event_month_year <> $chdate ){
				echo '<tr><td align="center" valign="top" width="50" class="ev_td_left">'. "\n"
				. mosEventsHTML::getDateFormat( $event_up->year, $event_up->month, '', 3 ) .'</td>' . "\n";
				echo '<td class="ev_td_right"><ul class="ev_ul">' . "\n";
			}

			HTML_events::viewEventRowAdmin ( $row, 'view_detail', $event_up->year, $event_up->month, $event_up->day, $deletelink, $modifylink, $contactlink, $option, $Itemid, $row->state );
			$chdate = $event_month_year;
		}
		echo '</ul></td>' . "\n";
	} else {
		echo '<tr>' . "\n";
		echo '<td align="left" valign="top" class="ev_td_right">' . "\n";
		echo _CAL_LANG_NO_EVENTS;
	}
	echo '</tr></table><br />' . "\n";
	echo '</fieldset><br /><br />' . "\n";

	global $year;
	showNavTableText( $year, $total, $limitstart, $limit, 'admin' );
}

function sortEvents( $a, $b ){

	list( $adate, $atime ) = split( ' ', $a->publish_up );
	list( $bdate, $btime ) = split( ' ', $b->publish_up );
	return strcmp( $atime, $btime );
}

function getCategoryData(){
	global $database;
	$database->setQuery( "SELECT  c.* FROM #__events_categories AS c");
	$cats = $database->loadObjectList('id');
	return $cats;
}

/*
* Loads all necessary files for JS Overlib tooltips
*/
function jevloadOverlib() {
	global  $mosConfig_live_site, $mainframe;
	static $loadOverlib=false;
	if ( !$loadOverlib) {
		// check if this function is already loaded
			?>
			<script language="javascript" type="text/javascript" src="<?php echo $mosConfig_live_site;?>/includes/js/overlib_mini.js"></script>
			<script language="javascript" type="text/javascript" src="<?php echo $mosConfig_live_site;?>/includes/js/overlib_hideform_mini.js"></script>
			<?php
			// change state so it isnt loaded a second time
			$mainframe->set( 'loadOverlib', true );
			$loadOverlib=true;
	}
}

function showCalendarNEW( $rows, $year, $month, $day ){
	global $mosConfig_offset, $database, $option, $Itemid;
	global $mosConfig_absolute_path;
	global $mosConfig_live_site;

	$cfg = & EventsConfig::getInstance();

	$rowcount = count( $rows );

	usort( $rows, 'sortEvents' );

	$repeatArray = array();
	for( $i = 0; $i < $rowcount; $i++ ){
		// build array of dates for each event
		//$repeatArray[$i] = mosEventRepeatArray( $rows[$i], $year, $month );
		$repeatArray[$i] = mosEventRepeatArrayMonth( $rows[$i], $year, $month );
	}

	$thisday	= $year . '-' . $month . '-' . $day;
	$day_name	= array( _CAL_LANG_SUNDAYSHORT,
	_CAL_LANG_MONDAYSHORT,
	_CAL_LANG_TUESDAYSHORT,
	_CAL_LANG_WEDNESDAYSHORT,
	_CAL_LANG_THURSDAYSHORT,
	_CAL_LANG_FRIDAYSHORT,
	_CAL_LANG_SATURDAYSHORT );
	// $y=date("Y");
	$month_name = EventsHelper::getMonthName( $month );
	if( $month <= '9' & ereg( "(^[1-9]{1})", $month )) {
		$month = '0' . $month;
	}

	jevloadOverlib();

	//if( _CAL_CONF_TT_SHADOW == 1 ){ // disbled only for test [mic]
	if( !defined( '_LOAD_OVERLIB_SHADOW' )){
            define( '_LOAD_OVERLIB_SHADOW', 1 ); ?>
            <script type="text/javascript" src="<?php echo $mosConfig_live_site; ?>/components/com_events/js/overlib_shadow.js"></script>
            <?php
	}
	//}
	$fieldsetText = "";
	$yearNow = date("Y", jevNow(true));
	$monthNow = date("m", jevNow(true));
	$dayNow = intval(date("d", jevNow(true)));
	if ($year==$yearNow && $month==$monthNow && $day==$dayNow){
		$fieldsetText = mosEventsHTML::getDateFormat( $year, $month, $day, 1 );
	}
	else $fieldsetText = mosEventsHTML::getDateFormat( $year, $month, "", 3 );
    ?>

	<fieldset>
    	<legend class="ev_fieldset"><?php echo $fieldsetText; ?></legend>
        <br />
        <table width="95%" align="center" border="0" cellspacing="1" cellpadding="0" class="cal_table">
            <tr valign="top">
                <?php
                $startday = $cfg->get('com_starday');
                if(( !$startday ) || ( $startday > 1 )){
                	$startday = 0;
                }
                for( $i = 0; $i < 7; $i++ ) { ?>
                    <td width="14%" align="center" class="cal_td_daysnames">
                        <!-- <div class="cal_daysnames"> -->
                        <?php echo mosEventsHTML::getLongDayName(($i+$startday)%7, true );?>
                        <!-- </div> -->
                    </td>
                    <?php
                } ?>
            </tr>
			<tr valign="top" style="height:80px;">
                <?php
                //Start days
                // Comment out the following if you experience bug #4475
                $start = (( date( 'w', mktime( 0, 0, 0, $month, 1, $year )) - $startday + 7 ) % 7 );
                for( $a = $start; $a > 0; $a-- ){
                	// Remove comment if you get problems with wrong month displays(bug #4475)
                	// $start=((date("w",mktime(0,0,0,$month,1,$year))-$startday+6)%7);
                	// for($a=$start;$a>=0 && $a<6;$a--) {
                    $d = date( 't', mktime( 0, 0, 0, $month, 0, $year )) - $a + 1; ?>
                    <td width="14%" class="cal_td_daysoutofmonth" valign="top">
                        <?php echo $d; ?>
                    </td>
                    <?php
                }

                //Current month
                for( $d = 1; $d <= date( 't', mktime( 0, 0, 0,( $month + 1 ), 0, $year )); $d++ ){
                	//  if($month==date("m")&$year==date("Y")&$d==date("d")) {
                	if( $month == strftime( '%m', jevNow(true))
                	&& $year == strftime( '%Y', jevNow(true))
                	&& $d == strftime( '%d', jevNow(true))) {
                		$bg = 'class="cal_td_today"';
                	}else{
                		$bg = 'class="cal_td_daysnoevents"';
                	}

                	if( $d <= '9' & ereg( '(^[1-9]{1})', $d )) {
                		$do = '0' . $d;
                	} else {
                		$do = $d;
                	}

                	$link = sefRelToAbs( 'index.php?option=' . $option . '&amp;task=view_day&amp;year='
                    . $year . '&amp;month=' . $month . '&amp;day=' . $do . '&amp;Itemid=' . $Itemid ); ?>
					<?php // stating the height here is needed for konqueror and safari ?>
                    <td <?php echo $bg;?> width="14%" valign="top" style="height:80px;">
                    	<a class="cal_daylink" href="<?php echo $link; ?>" title="<?php echo _CAL_LANG_CLICK_TOSWITCH_DAY; ?>"><?php echo $d; ?></a>
                        <?php
                        //PRESENTATION CONSTRUCTION
                        // remarks w [test mic] are new vars prepared for later
                        $cellDate		= mktime (0, 0, 0, $month, $d, $year);
                        $countDisplay	= ''; // test mic

                        if( $rowcount > 0 ){
                        	//echo '<table width="100%" cellpadding="0" cellspacing="0" border="0">'; // org mic
                        	for( $i = 0; $i < $rowcount; $i++ ){
                        		// checks if event should be displayed
                        		$checkprint = new stdClass();
                        		$checkprint->viewable = false;
                        		if (array_key_exists($cellDate,$repeatArray[$i]))  $checkprint->viewable = true ;

                        		// checking here speeds up [mic]
                        		if( $checkprint->viewable == true ){
                        			$countDisplay++;

                        			// Event publication infomations
                        			$event_up   = new mosEventDate( $rows[$i]->publish_up );
                        			// $showEventUp[] = $event_up; // test mic
                        			$event_down = new mosEventDate( $rows[$i]->publish_down );
                        			// $showEventDown[] = $event_down; // test mic
                        			// Event repeat variable initiate
                        			$repeat_event_type =  $rows[$i]->reccurtype;
                        			// $showRepeatEventType[] = $repeat_event_type; // test mic

                        			// BAR COLOR GENERATION
                        			$bgeventcolor = setColor($rows[$i]);
                        			// $showBGEventColor[] = $bgeventcolor; // test mic

                        			$start_publish  = mktime( 0, 0, 0, $rows[$i]->mup, $rows[$i]->dup, $rows[$i]->yup );
                        			$stop_publish   = mktime( 0, 0, 0, $rows[$i]->mdn, $rows[$i]->ddn, $rows[$i]->ydn );
                        			$event_day      = $rows[$i]->dup;
                        			$event_month    = $rows[$i]->mup;

                        			$title          = $rows[$i]->title;
                        			// $showTitle[] = $title; // test mic
                        			// $content     = $content_Array[$i]; // new mic - not used now
                        			$id             = $rows[$i]->id;
                        			// $showID[] = $id; // test mic

                        			// moved into events_calender_cell.php [mic]
                        			//$colStart       = '<tr valign="top"><td width="5" style="height:12;" ';
                        			//$colEnd         = '</td></tr><tr><td style="height:1px;"></td></tr>' . "\n";

                        			echo '<div style="width:100%; border:0;">' . "\n";
                        			require( $mosConfig_absolute_path . '/components/' . $option . '/events_calendar_cell.php' );
                        			echo '</div>' . "\n";
                        		}
                        	}
                        	// print all events for this date?  Not going to be pretty for a large # of events!!
                        	//  Need to work on this to make it scale better? [ >> done mic ;) ]
                        	//echo '</table>' . "\n";
                        } ?>
                    </td>
                    <?php
                    // Note that if we are on the last day of the month and last day of week then we won't have
                    // any out of month days so don't start a new row!
                    if((( date( 'w', mktime( 0, 0, 0, $month, $d, $year )) - $startday + 1 ) % 7 ) == 0
                    	 && $d!=date( 't', mktime( 0, 0, 0, $month, $d, $year ))){ ?>
                        <!-- </div> -->
                        </tr>
                        <tr valign="top" style="height:80px;">
                        <?php
                    	 }
                }

                $da		= $d + 1;
                //dmcd may 7/04, fix for bug where end days are not always printed depending upon how month ends
                //if(((date("w",mktime(0,0,0,$month+1,1,$year))-$startday)%7)<>1) {

                $days 	= ( 7 - date( 'w', mktime( 0, 0, 0, $month + 1, 1, $year )) + $startday ) %7;
                $d		= 1;

                for( $d = 1; $d <= $days; $d++ ) {
                	// while(((date("w",mktime(0,0,0,($month+1),$d,$year))-$startday+1)%7)<>1) {
                    ?>
                    <td class="cal_td_daysoutofmonth" width="14%" valign="top">
                        <?php echo $d; ?>
                    </td>
                    <?php
                    // $d++;
                    // }
                } ?>
            </tr>
        </table>
        <br />
    </fieldset>
    <?php
}

function oldMsg(){
	echo "<div style='position:absolute;font-weight:bold;color:red;background-color:yellow;margin-top:-20px;'>old version for testing</div>";
}

function viewYear( $Itemid, $year, $month, $day, $option, $task ,$limit, $limitstart ){
	//echo $cssHTML;
	HTML_events::eventsHeader( $Itemid, $year, $month, $day, $task );
	showNavTableBar( $year, $month, $day, $option, $task, $Itemid );
	$newVersion = intval(mosGetParam($_REQUEST,"nv","1"));
	if ($newVersion){
		showEventsByYearNEW( $year, $limit, $limitstart );
	}
	else{
		oldMsg();
		showEventsByYear( $year, $limit, $limitstart );
	}
	HTML_events::viewNavAdminPanel( $year, $month, $day, $option, $Itemid );
	HTML_events::eventsFooter( $Itemid, $year, $month, $day, $task);
}

function viewMonth( $Itemid, $year, $month, $day, $option, $task ){
	HTML_events::eventsHeader( $Itemid, $year, $month, $day, $task );
	showNavTableBar( $year, $month, $day, $option, $task, $Itemid );
	$newVersion = intval(mosGetParam($_REQUEST,"nv","1"));
	if ($newVersion){
		$rows = listEventsByMonthNEW( $year, $month, 'reccurtype ASC,publish_up' );
		showCalendarNEW( $rows, $year, $month, $day );
	}
	else {
		oldMsg();
		$rows = listEventsByMonth( $year, $month, 'reccurtype ASC,publish_up' );
		showCalendar( $rows, $year, $month, $day );
	}
    HTML_events::viewNavAdminPanel( $year, $month, $day, $option, $Itemid );
	HTML_events::eventsFooter( $Itemid, $year, $month, $day, $task);
}

function view_week( $Itemid, $year, $month, $day, $option, $task ){
	HTML_events::eventsHeader( $Itemid, $year, $month, $day, $task );
	showNavTableBar($year, $month, $day, $option, $task, $Itemid );
	$newVersion = intval(mosGetParam($_REQUEST,"nv","1"));
	if ($newVersion){
		showEventsByWeekNEW( $year, $month, $day );
	}
	else {
		oldMsg();
		showEventsByWeek( $year, $month, $day );
	}
    HTML_events::viewNavAdminPanel( $year, $month, $day, $option, $Itemid );
	HTML_events::eventsFooter( $Itemid, $year, $month, $day, $task);
}

function view_day( $Itemid, $year, $month, $day, $option, $task ){
	HTML_events::eventsHeader( $Itemid, $year, $month, $day, $task );
	showNavTableBar( $year, $month, $day, $option, $task, $Itemid );
	$newVersion = intval(mosGetParam($_REQUEST,"nv","1"));
	if ($newVersion){
		showEventsByDateNEW( $year, $month, $day );
	}
	else {
		oldMsg();
		showEventsByDate( $year, $month, $day );
	}
	HTML_events::viewNavAdminPanel( $year, $month, $day, $option, $Itemid );
	HTML_events::eventsFooter( $Itemid, $year, $month, $day, $task);
}

function view_last( $Itemid, $year, $month, $day, $option, $task ){
	HTML_events::eventsHeader( $Itemid, $year, $month, $day, $task );
	showNavTableBar( $year, $month, $day, $option, $task, $Itemid );
	$newVersion = intval(mosGetParam($_REQUEST,"nv","1"));
	if ($newVersion){
		showEventsByMonthNEW( $year, $month );
	}
	else {
		oldMsg();
		showEventsByMonth( $year, $month );
	}
	HTML_events::viewNavAdminPanel( $year, $month, $day, $option, $Itemid );
	HTML_events::eventsFooter( $Itemid, $year, $month, $day, $task);
}

function view_detail( $Itemid, $year, $month, $day, $option, $task, $pop, $agid ){
	HTML_events::eventsHeader( $Itemid, $year, $month, $day, $task );
	// dmcd oct 4/04  don't show navbar stuff for events detail popup
	if( !$pop ){
		showNavTableBar( $year, $month, $day, $option, $task, $Itemid );
	}
	showEventsById( $agid, $year, $month, $day );
	if( !$pop ){
		HTML_events::viewNavAdminPanel( $year, $month, $day, $option, $Itemid );
	}
	HTML_events::eventsFooter( $Itemid, $year, $month, $day, $task);
}

function view_cat( $Itemid, $year, $month, $day, $option, $task, $catid, $limit, $limitstart ){
	HTML_events::eventsHeader( $Itemid, $year, $month, $day, $task );
	showNavTableBar( $year, $month, $day, $option, $task, $Itemid );
	HTML_events::viewNavCatText( $catid, $option, 'view_cat', $Itemid );
	showEventsByCat( $catid, $limit, $limitstart );
    HTML_events::viewNavAdminPanel( $year, $month, $day, $option, $Itemid );
	HTML_events::eventsFooter( $Itemid, $year, $month, $day, $task);
}

/////////////////////////////////////// CHOOSE SECTION //////////////////////////////////////////

// if (!isset($task) || empty($task)) {$task = _CAL_CONF_STARTVIEW;}

// dmcd Aug 6/04.  Check the Events Table to see if the new useCatColor field is in
// If not dynamically insert it now
/* redundant for upgraded calendars!
$query = "SELECT useCatColor"
. "\n FROM #__events"
;
$database->setQuery( $query );

if( !$database->query() ){
// dmcd go add the NEW FIELD NOW
$query = "ALTER TABLE #__events"
. "\n ADD useCatColor TINYINT(1) NOT NULL DEFAULT '0'"
. "\n AFTER color_bar"
;
$database->setQuery( $query );
if( !$database->query() ){
echo "<script> alert('DV alter table error:\n" . $database->errorMsg . "'); window.history.go(-1); </script>\n";
}
}
*/
// dmcd May 29/04  create the new events_categories db table here to hold the color field.
// eventually we will delete this code for the newer version since it will be created by the xml install file.
// This at least allows an easier upgrade for people with minimal performance issues
// dmcd Sep 14/04  new mos does not like DB errors.  It will flag a php 'NOTICE' message to user by default if
// enabled.  Now instead, test for presence of the events_categories table in the DB instead

//xdebug_break();
/* redundant for upgraded calendars!
$database->setQuery( 'SHOW TABLES' );
$tables = $database->loadResultArray();

if( $tables && array_search( $database->_table_prefix . 'events_categories', $tables ) === false ){
// ok need to create new table
$query = "CREATE TABLE IF NOT EXISTS #__events_categories "
. "\n (id INT(12) NOT NULL DEFAULT 0 PRIMARY KEY, color VARCHAR(8) NOT NULL DEFAULT '')"
;
$database->setQuery( $query );
$database->query();

// create table entries for any existing event categories
$query = "SELECT id"
. "\n FROM #__categories"
. "\n WHERE section='$option'"
. "\n ORDER BY ordering"
;
$database->setQuery( $query );
$cats = $database->loadObjectList();

foreach( $cats AS $cat ){
$query = "INSERT INTO #__events_categories"
. "\n VALUES (".$cat->id.", '')"
;
$database->setQuery( $query );
$database->query();
}
}
*/
$cssHTML = '<link href="' . $mosConfig_live_site . '/components/com_events/events_css.css" rel="stylesheet" type="text/css" />' . "\n";
if (isset($mainframe)) $mainframe->addCustomHeadTag( $cssHTML );
else mosMainFrame::addCustomHeadTag( $cssHTML );

if ($task== 'save') {
	$mode ="write";
	$id = intval( mosGetParam( $_REQUEST, 	'id', 		0 ) );
	if ($id==0) $task="add";
	else $task="edit";
}

if ($task=="edit"){
	if ($agid==0){
		$task="add";
	}
}

switch( $task ){
	case 'add':
		// clear content caches since too  we need the modules to be cleaned out too!
		mosCache::cleanCache( 'com_events' );
		mosCache::cleanCache( 'com_content' );
		if( $is_event_editor ){
			if( $mode == 'write' ){
				if( $goodexit == 1 ){

					// Captch code for anon and registered users
					/*
					global $my;
					if ($my->gid<2){
					if (file_exists($mosConfig_absolute_path.'/administrator/components/com_securityimages/server.php')) {
					include_once($mosConfig_absolute_path.'/administrator/components/com_securityimages/server.php');
					$security_refid  = trim( mosGetParam( $_POST, 'security_refid', '' ) );
					$security_try 	 = trim( mosGetParam( $_POST, 'security_try', '' ) );

					$checkSecurity = checkSecurityImage($security_refid, $security_try);
					if (!$checkSecurity){
					$returnlink = sefRelToAbs( 'index.php?option=' . $option , '&amp;Itemid=' . $Itemid );
					jevRedirect( $returnlink, "You did not enter the correct string!");

					}
					}
					}
					*/
					$adminEmail	= $cfg->get('com_adminmail');
					$event = saveEvent( $database );
					if (isset($event)){
						$agid=($event->id>0)?"&amp;agid=".$event->id:"";
						if ($event->created_by_alias!="") $created_by=$event->created_by_alias;
						else $created_by = $my->name;
					}
					$subject	= _CAL_LANG_MAIL_ADDED . ' ' . $mosConfig_sitename;
					$subject	= ($event->state == '1') ? '[Info] ' . $subject : '[Approval] ' . $subject;

					global $Itemid;
					$modifylink = '<a href="' . sefRelToAbs( 'index.php?option=' . $option . '&amp;task=edit'.$agid.'&amp;Itemid=' . $Itemid ) . '"><b>' . _CAL_LANG_MODIFY . '</b></a>' . "\n";

					if ($created_by==null) $created_by="Anonymous";
					sendAdminMail( $mosConfig_sitename, $adminEmail, $subject, $event->title, $event->content, $created_by, $mosConfig_live_site, $modifylink );

					$returnlink = sefRelToAbs( 'index.php?option=' . $option . '&amp;Itemid=' . $Itemid );
					// but there is a problem in Joomla 1.5 with &amp; so remove it by hand (really STUPID!!!)
					$returnlink = str_replace("&amp;","&",$returnlink);
					if( $event->state == '1' ){
						jevRedirect( $returnlink, html_entity_decode( _CAL_LANG_ACT_MODIFIED ));
					} else {
						jevRedirect( $returnlink, html_entity_decode( _CAL_LANG_ACT_ADDED ));
					}

					//$returnlink = "index.php?option=$option&Itemid=$Itemid";
					//jevRedirect("$returnlink", _CAL_LANG_ACT_ADDED);
				}
			} else {
				if( $year && $month && $day ){
					$start_publish	= $year . '-' . $month . '-' . $day;
					$stop_publish	= $year . '-' . $month . '-' . $day;
				} else {
					$start_publish = strftime( '%Y-%m-%d', jevNow(true));
					$stop_publish	= strftime( '%Y-%m-%d', jevNow(true));
				}

				$row = new mosEvents( $database );
				// if user hits refresh, try to maintain event form state
				$row->bind( $_POST );
				$row->color_bar			= mosEventsHTML::getColorBar( null, '' );
				$start_time				= '08:00';
				$end_time 				= '17:00';
				$row->reccurday_month 	= -1;
				$row->reccurday_week 	= -1;
				$row->reccurday_year 	= -1;
				$row->created_by_alias 	= $my->username;
				$row->reccurtype 		= 0;

				$lists 					= '';

				// dmcd May 20/04  fetch the new category colors from the '#__events_category' db table
				$query = "SELECT *"
				. "\n FROM #__events_categories"
				;
				$database->setQuery( $query );
				$catColors = $database->loadObjectList( 'id' );

				HTML_events::viewFormEvent( $row, $start_publish, $stop_publish, $start_time, $end_time, $lists, $Itemid, $option, $task, 'new', $catColors, $agid );
			}
		} else {
			$returnlink = sefRelToAbs( 'index.php?option=' . $option . '&amp;Itemid=' . $Itemid );

			jevRedirect( $returnlink, html_entity_decode( _CAL_LANG_NOPERMISSION ));
		}
		break;

	case 'delete':
		// clear content caches since too  we need the modules to be cleaned out too!
		mosCache::cleanCache( 'com_events' );
		mosCache::cleanCache( 'com_content' );
		if( $is_event_editor && !( strtolower( $my->usertype ) == '' )){
			if( $agid ){
				$rows	= listEventsById( $agid, 1 );  // include unpublished events for publishers and above
				$row	= $rows[0];
				// Have to check this condition
				if (hasAdvancedRowPermissions($row,$my)) {
					removeEvent( $agid );
				}
				else {
					echo $my->usertype;
					$returnlink = sefRelToAbs( 'index.php?option=' . $option . '&amp;Itemid=' . $Itemid );
					jevRedirect( $returnlink, html_entity_decode( _CAL_LANG_NOPERMISSION ));
				}
			}
		} else {
			$returnlink = sefRelToAbs( 'index.php?option=' . $option . '&amp;Itemid=' . $Itemid );
			jevRedirect( $returnlink, html_entity_decode( _CAL_LANG_NOPERMISSION ));
		}
		break;

	case 'publish' :
		// clear content caches since too  we need the modules to be cleaned out too!
		mosCache::cleanCache( 'com_events' );
		mosCache::cleanCache( 'com_content' );
		if( $is_event_editor && !( strtolower( $my->usertype ) == '' )){
			$rows	= listEventsById( $id, 1 );  // include unpublished events for publishers and above
			$row	= $rows[0];

			if( strtolower( $my->usertype ) == 'user' || strtolower( $my->usertype ) == '' ){
				if( $row->creator_id != $my->id ){
					$returnlink = sefRelToAbs( 'index.php?option=' . $option , '&amp;Itemid=' . $Itemid );
					jevRedirect( $returnlink, html_entity_decode( _CAL_LANG_NOPERMISSION ));
				}
			}

			if( $goodexit == 1 ){
				$event = publishEvent($row->id);
				$returnlink = sefRelToAbs( 'index.php?option=' . $option . '&amp;Itemid=' . $Itemid );
				jevRedirect( $returnlink, html_entity_decode( _CAL_LANG_ACT_PUBLISHED));
			}
		} else {
			$returnlink = sefRelToAbs( 'index.php?option=' . $option . '&amp;Itemid=' . $Itemid );
			jevRedirect( $returnlink, html_entity_decode( _CAL_LANG_NOPERMISSION ));
		}
		break;

	case 'edit':
		// clear content caches since too  we need the modules to be cleaned out too!
		mosCache::cleanCache( 'com_events' );
		mosCache::cleanCache( 'com_content' );
		if( $is_event_editor && !( strtolower( $my->usertype ) == '' )){
			$rows	= listEventsById( $agid, 1 );  // include unpublished events for publishers and above
			$row	= $rows[0];

			if( strtolower( $my->usertype ) == 'user' || strtolower( $my->usertype ) == '' ){
				if( $row->creator_id != $my->id ){
					$returnlink = sefRelToAbs( 'index.php?option=' . $option , '&amp;Itemid=' . $Itemid );
					jevRedirect( $returnlink, html_entity_decode( _CAL_LANG_NOPERMISSION ));
				}
			}

			if( !hasAdvancedRowPermissions($row,$my)){
				$returnlink = sefRelToAbs( 'index.php?option=' . $option , '&amp;Itemid=' . $Itemid );
				jevRedirect( $returnlink,  _CAL_LANG_NOPERMISSION );
			}

			if( $mode == 'write'){
				if( $goodexit == 1 ){
					$adminEmail	= $cfg->get('com_adminmail');

					$event = saveEvent( $database );
					if (isset($event)){
						$agid=($event->id>0)?"&amp;agid=".$event->id:"";
						if ($event->created_by_alias!="") $created_by=$event->created_by_alias;
						else $created_by = $my->name;
					}
					$subject	= _CAL_LANG_MAIL_MODIFIED . ' ' . $mosConfig_sitename;
					$subject	= ($event->state == '1') ? '[Info] ' . $subject : '[Approval] ' . $subject;

					global $Itemid;
					$modifylink = '<a href="' . sefRelToAbs( 'index.php?option=' . $option . '&amp;task=edit'.$agid.'&amp;Itemid=' . $Itemid ) . '"><b>' . _CAL_LANG_MODIFY . '</b></a>' . "\n";

					sendAdminMail( $mosConfig_sitename, $adminEmail, $subject, $event->title, $event->content, $created_by, $mosConfig_live_site, $modifylink );

					$returnlink = sefRelToAbs( 'index.php?option=' . $option . '&amp;Itemid=' . $Itemid );
					if( $event->state == '1' ){
						jevRedirect( $returnlink, html_entity_decode( _CAL_LANG_ACT_MODIFIED ));
					} else {
						jevRedirect( $returnlink, html_entity_decode( _CAL_LANG_ACT_ADDED ));
					}

				}
			} else {
				if( $agid ){
					$rows			= listEventsById( $agid, 1 ); // include unpublished events for publishers and above
					$row			= $rows[0];
					$event_up 		= new mosEventDate( $row->publish_up );
					$start_publish 	= sprintf( '%4d-%02d-%02d', $event_up->year, $event_up->month, $event_up->day );
					$start_time 	= $event_up->hour . ':' . $event_up->minute;

					$event_down 	= new mosEventDate( $row->publish_down );
					$stop_publish 	= sprintf( '%4d-%02d-%02d', $event_down->year, $event_down->month, $event_down->day );
					$end_time 		= $event_down->hour . ':' . $event_down->minute;

					$row->reccurday_month	= 99;
					$row->reccurday_week	= 99;
					$row->reccurday_year	= 99;

					if( $row->reccurday <> '' ){
						if( $row->reccurtype == 1 ){
							$row->reccurday_week = $row->reccurday;
						}elseif( $row->reccurtype == 3 ){
							$row->reccurday_month = $row->reccurday;
						}elseif( $row->reccurtype == 5 ){
							$row->reccurday_year = $row->reccurday;
						}
					}

					$lists['state'] = mosHTML::yesnoSelectList( 'state', 'size="1" class="inputbox"', $row->state );

					// dmcd May 20/04  fetch the new category colors from the '#__events_category' db table
					$query = "SELECT *"
					. "\n FROM #__events_categories"
					;
					$database->setQuery( $query );
					$catColors = $database->loadObjectList( 'id' );

					HTML_events::viewFormEvent( $row, $start_publish, $stop_publish, $start_time, $end_time, $lists, $Itemid, $option, $task, 'edit', $catColors, $agid );
				}
			}
		} else {
			$returnlink = sefRelToAbs( 'index.php?option=' . $option . '&amp;Itemid=' . $Itemid );
			jevRedirect( $returnlink, html_entity_decode( _CAL_LANG_NOPERMISSION ));
		}
		break;

	case 'cancel':
		// clear content caches since too  we need the modules to be cleaned out too!
		mosCache::cleanCache( 'com_events' );
		mosCache::cleanCache( 'com_content' );
		$row = new mosEvents( $database );
		$row->bind( $_POST );

		if( $access->canEdit || ( $access->canEditOwn && $row->created_by == $my->id )) {
			$row->checkin();
		}
		jevRedirect( sefRelToAbs( 'index.php?option=' . $option . '&amp;Itemid=' . $Itemid ));
		break;

	case 'view_year':
		$cache->call( 'viewYear', $Itemid, $year, $month, $day, $option, $task, $limit, $limitstart, $catids, $mosConfig_lang,$my->usertype );
		break;

	case 'view_month':
		$cache->call( 'viewMonth', $Itemid, $year, $month, $day, $option, $task, $catids, $mosConfig_lang,$my->usertype  );
		break;

	case 'view_week':
		$cache->call( 'view_week', $Itemid, $year, $month, $day, $option, $task, $catids, $mosConfig_lang ,$my->usertype );
		break;

	case 'view_day':
		$cache->call( 'view_day', $Itemid, $year, $month, $day, $option, $task, $catids, $mosConfig_lang ,$my->usertype );
		break;

	case 'view_last':
		$cache->call( 'view_last', $Itemid, $year, $month, $day, $option, $task, $catids, $mosConfig_lang ,$my->usertype );
		break;

	case 'view_detail':
		$cache->call( 'view_detail', $Itemid, $year, $month, $day, $option, $task, $pop, $agid, $mosConfig_lang ,$my->usertype );
		break;

	case 'view_cat':
		$cache->call( 'view_cat', $Itemid, $year, $month, $day, $option, $task, $catid, $limit, $limitstart, $mosConfig_lang ,$my->usertype );
		break;

	case 'view_search':
		HTML_events::eventsHeader( $Itemid, $year, $month, $day, $task );
		showNavTableBar( $year, $month, $day, $option, $task, $Itemid );
		HTML_events::viewSearchForm( '', $option, $task, $Itemid );
		HTML_events::viewNavAdminPanel( $year, $month, $day, $option, $Itemid );
		HTML_events::eventsFooter( $Itemid, $year, $month, $day, $task);
		break;

	case 'search':
		HTML_events::eventsHeader( $Itemid, $year, $month, $day, $task );
		showNavTableBar( $year, $month, $day, $option, $task, $Itemid );
		showEventsByKeyword( $keyword, $limit, $limitstart, true );
		HTML_events::viewNavAdminPanel( $year, $month, $day, $option, $Itemid );
		HTML_events::eventsFooter( $Itemid, $year, $month, $day, $task);
		break;

	case 'admin':
		if( $is_event_editor ){
			if( strtolower( $my->usertype ) == 'administrator' || strtolower( $my->usertype ) == 'super administrator' ) {
				$creator_id = 'ADMIN';
			}else{
				$creator_id = $my->id;
			}
			HTML_events::eventsHeader( $Itemid, $year, $month, $day, $task );
			showNavTableBar( $year, $month, $day, $option, $task, $Itemid );
			if (!( strtolower( $my->usertype ) == '')) showEventsForAdmin( $creator_id, $limit, $limitstart );
			HTML_events::viewNavAdminPanel( $year, $month, $day, $option, $Itemid );
			HTML_events::eventsFooter( $Itemid, $year, $month, $day, $task);
		}else{
			$returnlink = sefRelToAbs( 'index.php?option=' . $option . '&amp;Itemid=' . $Itemid );
			jevRedirect( $returnlink, html_entity_decode( _CAL_LANG_NOPERMISSION ));
		}
		break;

	default:
		break;
}
?>
