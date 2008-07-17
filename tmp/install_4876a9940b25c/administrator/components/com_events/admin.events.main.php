<?php
/**
 * Events Component for Joomla 1.0.x
 *
 * @version     $Id: admin.events.main.php 1102 2008-05-22 06:11:59Z tstahl $
 * @package     Events
 * @copyright   Copyright (C) 2006 JEvents Project Group
 * @copyright   Copyright (C) 2000 - 2003 Eric Lamette, Dave McDonnell
 * @licence     http://www.gnu.org/copyleft/gpl.html
 * @link        http://joomlacode.org/gf/project/jevents
 */

defined( '_VALID_MOS' ) or die( 'No Direct Access' );

switch( $act ) {
	case 'conf':
        $filename =  mosMainFrame::getBasePath() . '/components/com_events/events_css.css' ;

      	if( $fp = fopen( $filename, 'rb' )) {
		    $config_style = fread( $fp, filesize( $filename ) );
            $config_style = htmlspecialchars( $config_style );
            fclose( $fp );
	   	} else {
	   		$msg = sprintf( _CAL_LANG_MSG_OP_FAILED, $filename );
	   		mosRedirect( 'index2.php?option=' . $option, $msg );
	   	}

        HTML_events_admin::showConfig( $option, $config_style);
        break;

	case 'missingconf':
    	$config_style = '';
        missConfig();

        $filename		= mosMainFrame::getBasePath() . '/components/com_events/events_css.css' ;
        $fp				= fopen( $filename, 'rb' );
		$config_style	= fread( $fp, filesize( $filename ) );
        $config_style	= htmlspecialchars( $config_style );
        fclose( $fp );

		HTML_events_admin::showConfig( $option, $config_style);
        break;

	case 'missingcss':
		$config_style = '';
        missCss();

       	$filename		= mosMainFrame::getBasePath() . '/components/com_events/events_css.css' ;
       	$fp				= fopen( $filename, 'rb' );
	    $config_style	= fread( $fp, filesize( $filename ) );
        $config_style	= htmlspecialchars( $config_style );
        fclose( $fp );

	   	HTML_events_admin::showConfig( $option,
            $config_style
        );
        break;

	default:
	switch( $task ){
		case 'checklocale':
			include_once(dirname(__FILE__)."/lib/checklocale.php");
			checkLocale();
			break;
					
		case 'saveconfig':
        	saveConfig ($option);
            break;

        case 'cancelconfig':
        	mosRedirect( 'index2.php?option=' . $option, '');
        	break;

		case 'new':
			editEvents( $option, 0 );
			break;

		case 'edit':
			editEvents( $option, $cid[0] );
			break;

		case 'save':
			saveEvents( $option );
			break;

		case 'remove':
			removeEvents( $cid, $option );
			break;

		case 'publish':
			changeEvents( $id, $cid, 1, $option );
			break;

		case 'unpublish':
			changeEvents( $id, $cid, 0, $option );
			break;

		// new mic
		case 'archive':
			changeEvents( $id, $cid, -1, $option );
			break;

		// new mic
		case 'unarchive':
			changeEvents( $id, $cid, 0, $option );
			break;

		// new mic
		case 'viewarchiv':
			viewEvents( $option, true );
			break;

        case 'approve':
			break;

		case 'cancel':
			cancelEvents( $option );
			break;

		default:
			viewEvents( $option );
			break;
	}

	// CHECK CONFIG
	if( $cfg->get("com_adminmail",'your@example.com') == 'your@example.com' ){
		$msg = _CAL_LANG_MSG_CHANGE_EMAIL;
		mosRedirect( 'index2.php?option=' . $option . '&act=conf', $msg );
	}
     break;
}

/**
 * get all events_categories to use category color
 * @return  object
 */
function getCategoryData(){

	global $database;
	
	$database->setQuery( "SELECT  c.* FROM #__events_categories AS c");
	$cats = $database->loadObjectList('id');

	return $cats;
}
/**
* Compiles a list of installed or defined modules
* @param database A database connector object
*/
function viewEvents( $option, $archive = false ) {
	global $database, $mainframe;
	global $mosConfig_debug,$mosConfig_offset;
	
    $now		= strftime( '%Y-%m-%d %H:%M:%S', jevNow(true));

	$catid		= intval( $mainframe->getUserStateFromRequest( "catid{$option}", 'catid', 0 ));
	$limit		= intval( $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', 10 ));
	$limitstart = intval( $mainframe->getUserStateFromRequest( "view{$option}limitstart", 'limitstart', 0 ));
	$search		= $mainframe->getUserStateFromRequest( "search{$option}", 'search', '' );
	$search		= $database->getEscaped( trim( strtolower( $search ) ) );
	$hideOldEvents = intval( $mainframe->getUserStateFromRequest( 'oldev','oldev', 1));
	$where		= array();

	if( $catid > 0 ){
		$where[] = "a.catid='$catid'";
	}
	if( $search ){
		$where[] = "LOWER(a.title) LIKE '%$search%'";
	}

	if ($hideOldEvents>0){		
		$where[] = "a.publish_down >= '".$now."'";
	}

	// no archieved items [ new mic ]
	if( !$archive ){
		$where[] = "a.state != '-1'";
	}else{
		$where[] = "a.state = '-1'";
	}

	// get the total number of records
	$query = "SELECT count(*)"
	. "\n FROM #__events AS a"
	. ( count( $where ) ? "\n WHERE " . implode( ' AND ', $where ) : '' )
	;
	$database->setQuery( $query);
	$total = $database->loadResult();
	echo $database->getErrorMsg();

	if( $limit > $total ) {
		$limitstart = 0;
	}

	$where[] = "a.catid=cc.id";

	$query = "SELECT a.*, cc.name AS category, u.name AS editor, g.name AS groupname"
	. "\n FROM ( #__events AS a, #__categories AS cc )"
	. "\n LEFT JOIN #__users AS u ON u.id = a.checked_out"
	. "\n LEFT JOIN #__groups AS g ON g.id = a.access"
	. ( count( $where ) ? "\n WHERE " . implode( ' AND ', $where ) : '' )
	. "\n ORDER BY a.catid"
	//. "\nAND a.state ASC"
	. "\n LIMIT $limitstart, $limit"
	;
	$database->setQuery( $query );
	$rows = $database->loadObjectList();

	if( $mosConfig_debug ){
        echo '[DEBUG]<br />';
        echo 'query:';
        echo '<pre>';
        echo $query;
        echo '-----------<br />';
        echo 'option "' . $option . '"<br />';
        echo 'archive "' . $archive . '"<br />';
        echo '</pre>';
        //die( 'userbreak - mic ' );
    }

    if ($database->getErrorNum()) {
	    echo $database->stderr();
	    return false;
	}

	// get list of categories
	$categories[] = mosHTML::makeOption( '0', _CAL_LANG_EVENT_CHOOSE_CATEG );
	$categories[] = mosHTML::makeOption( '-1', '- '._CAL_LANG_EVENT_ALLCAT );

	$query = "SELECT id AS value, title AS text"
	. "\n FROM #__categories"
	. "\n WHERE section='$option'"
	. "\n ORDER BY ordering"
	;
	$database->setQuery( $query );

	$categories = array_merge( $categories, $database->loadObjectList() );

	$clist = mosHTML::selectList( $categories, 'catid', 'class="inputbox" size="1" onchange="document.adminForm.submit();"', 'value', 'text', $catid );

	/*$section = new mosSection( $database );
	$section->load( $sectionid );
	*/
	include_once( mosMainFrame::getBasePath() .'/administrator/includes/pageNavigation.php' );
	$pageNav = new mosPageNav( $total, $limitstart, $limit  );

	$catData = getCategoryData();
	HTML_events_admin::showEvents( $rows, $clist, $search, $pageNav, $option, $hideOldEvents, $catData);
}

/**
* Compiles information to add or edit the record
* @param database A database connector object
* @param integer The unique id of the record to edit (0 if new)
* @param integer The id of the content section
*/
function editEvents( $option, $eventid ) {
	global $database, $my;
	global $mosConfig_absolute_path, $mosConfig_live_site, $mosConfig_offset;

	$row = new mosEvents( $database );
	// load the row from the db table
	$row->load( $eventid );

	$lists	= array();

	// get list of categories
	$query = "SELECT id AS value, name AS text"
	. "\n FROM #__categories"
	. "\n WHERE section='$option'"
	. "\n ORDER BY ordering"
	;
	$database->setQuery( $query );
	//$categories = array_merge( $categories, $database->loadObjectList() );
    $categories = $database->loadObjectList();

	if( count( $categories ) < 1) {
		$msg = _CAL_LANG_MSG_ADD_CAT_BEFORE;
		mosRedirect( 'index2.php?option='.$option.'&act=categories', $msg );
	}

	// fail if checked out not by 'me'
	if ($row->checked_out && $row->checked_out <> $my->id) {
		$msg = sprintf( _CAL_LANG_MSG_CAT_IS_EDITED, $row->title );
		mosRedirect( 'index2.php?option=' . $option, $msg );
	}

	if( $eventid ){
	    $mode = 'modify';
	    $row->checkout( $my->id );

		if( trim( $row->images )) {
			$row->images = explode( "\n", $row->images );
		} else {
			$row->images = array();
		}

		if( trim( $row->publish_down ) == '0000-00-00 00:00:00' ) {
			$row->publish_down = _CAL_LANG_NEVER;
		}

        $event_up				= new mosEventDate( $row->publish_up );
	    $start_publish			= sprintf( '%4d-%02d-%02d', $event_up->year, $event_up->month, $event_up->day );
	    $start_time				= $event_up->hour . ':' . $event_up->minute;

	    $event_down				= new mosEventDate( $row->publish_down );
	    $stop_publish			= sprintf( '%4d-%02d-%02d', $event_down->year, $event_down->month, $event_down->day );
	    $end_time				= $event_down->hour . ':' . $event_down->minute;

	    $row->reccurday_month	= 99;
        $row->reccurday_week	= 99;
        $row->reccurday_year	= 99;

        if( $row->reccurday <> '' ){
        	if( $row->reccurtype == 1 ) {
                $row->reccurday_week = $row->reccurday;
            }elseif( $row->reccurtype == 3) {
                $row->reccurday_month = $row->reccurday;
            }elseif( $row->reccurtype == 5 ) {
                $row->reccurday_year = $row->reccurday;
            }
        }
	} else {
		$mode = 'new';

        $row->state				= 0;
		$row->images			= array();
        $start_publish			= strftime( '%Y-%m-%d', jevNow(true) );
        $stop_publish			= strftime( '%Y-%m-%d', jevNow(true) );
        $start_time				= '08:00';
        $end_time				= '17:00';
		$row->color_bar 		= mosEventsHTML::getColorBar( null, '' );

		$row->reccurday_month	= -1;
        $row->reccurday_week	= -1;
        $row->reccurday_year	= -1;
	}

	// get list of images
	$imgFiles					= mosReadDirectory( $mosConfig_absolute_path . '/images/stories' );
	$images 					= array();
	$folders 					= array();
	$folders[] 					= mosHTML::makeOption( '/' );

	foreach ( $imgFiles as $file) {
		if( is_dir( $mosConfig_absolute_path . '/images/stories/' . $file )) {
			$folders[]	= mosHTML::makeOption( '/' . $file );
			$folder		= mosReadDirectory( $mosConfig_absolute_path . '/images/stories/' . $file );

			foreach( $folder as $file2 ){
				if( eregi( 'bmp|gif|jpg|png', $file2 )
						&& is_file( $mosConfig_absolute_path . '/images/stories/' . $file . '/' . $file2 )) {
					$images["/$file"][] = mosHTML::makeOption( $file . '/' . $file2 );
				}
			}

		}elseif( eregi( 'bmp|gif|jpg|png', $file )
				&& is_file( $mosConfig_absolute_path . '/images/stories/' . $file )) {
			$images['/'][] = mosHTML::makeOption( $file );
		}
	}

	$lists['ilist'] = mosHTML::selectList( $images['/'], 'imagefiles',
	"class=\"inputbox\" size=\"10\" multiple=\"multiple\""
	. " onchange=\"previewImage('imagefiles','view_imagefiles','$mosConfig_live_site/images/stories/')\"",
	'value', 'text', null );

	$lists['folderlist'] = mosHTML::selectList( $folders, 'folders', 'class="inputbox" size="1" '
	. 'onchange="changeDynaList(\'imagefiles\', folderimages, document.adminForm.folders.options[document.adminForm.folders.selectedIndex].value, 0, 0)"',
	'value', 'text', '/' );

	// make the list of saved images
	$images2 = array();
	foreach ($row->images as $file) {
		$temp = explode( '|', $file );
		$images2[] = mosHTML::makeOption( $file, $temp[0] );
	}

	$lists['i2list'] = mosHTML::selectList( $images2, 'imagelist', 'class="inputbox" size="10"'
	. " onchange=\"showImageProps('$mosConfig_live_site/images/stories/')\"",
	'value', 'text', null );

	// make the select list for the image positions
	$pos[] = mosHTML::makeOption( 'left',	_CAL_LANG_LEFT );
	$pos[] = mosHTML::makeOption( 'center',	_CAL_LANG_CENTER );
	$pos[] = mosHTML::makeOption( 'right',	_CAL_LANG_RIGHT );

	// build the html select list
	$lists['poslist'] = mosHTML::selectList( $pos, '_align', 'class="inputbox" size="3"',
	'value', 'text', null );

	// get list of groups
	$query = "SELECT id AS value, name AS text"
	. "\n FROM #__groups"
	. "\n ORDER BY id"
	;
	$database->setQuery( $query );
	$groups = $database->loadObjectList();

	// build the html select list
	$glist = mosHTML::selectList( $groups, 'access', 'class="inputbox" size="1"',
	'value', 'text', intval( $row->access ) );

	$creator	= '';
	$modifier	= '';
	if( $eventid ) {
		$query = "SELECT name"
		. "\n FROM #__users"
		. "\n WHERE id=$row->created_by"
		;
	    $database->setQuery( $query );
	    $creator = $database->loadResult();

		$query = "SELECT name"
		. "\n FROM #__users"
		. "\n WHERE id=$row->modified_by"
		;
	    $database->setQuery( $query );
	    $modifier = $database->loadResult();
	}


	// dmcd May 20/04  fetch the new category colors from the '#__events_category' db table
	$query = "SELECT *"
	. "\n FROM #__events_categories"
	;
	$database->setQuery( $query );

	$catColors = $database->loadObjectList('id');

	$section = 0; // NO YET IMPLEMENTED

	HTML_events_admin::editEvents( $row,  $start_publish, $stop_publish, $start_time, $end_time, $section,
		$glist, $images, $creator, $modifier, $option, $mode, $catColors, $lists
	);
}

/**
* Saves the content item an edit form submit
* @param database A database connector object
*/
function saveEvents( $option ) {
	global $mosConfig_offset, $my, $database;
	// clear content caches since too  we need the modules to be cleaned out too!
	mosCache::cleanCache( 'com_events' );
	mosCache::cleanCache( 'com_content' );

	$cfg = & EventsConfig::getInstance();

    $start_time			= mosGetParam( $_POST, 			'start_time', 		'08:00' );
	$start_pm			= intval( mosGetParam( $_POST, 	'start_pm', 		'0' ) );
    $end_time			= mosGetParam( $_POST, 			'end_time', 		'17:00' );
	$end_pm				= intval( mosGetParam( $_POST, 	'end_pm', 			'0' ) );

	$reccurweekdays		= mosGetParam( $_POST, 			'reccurweekdays', 	'' );
	$reccurweeks		= mosGetParam( $_POST, 			'reccurweeks', 		'' );
	$reccurday_week		= mosGetParam( $_POST, 			'reccurday_week', 	'' );
	$reccurday_month	= mosGetParam( $_POST, 			'reccurday_month', 	'' );
    $reccurday_year		= mosGetParam( $_POST, 			'reccurday_year', 	'' );

    $now				= strftime( '%Y-%m-%d %H:%M:%S', jevNow(true));

	$row = new mosEvents( $database );
	if( !$row->bind( $_POST )) {
		echo '<script> alert(\'' . $row->getError() . '\'); window.history.go(-1); </script>' . "\n";
		exit();
	}

	if( is_null( $row->useCatColor )){
		$row->useCatColor = 0;
	}

	if( $row->id ){
		$row->modified = $now;
		   //date( "Y-m-d H:i:s" );
		if( $my->id ){
			$row->modified_by = $my->id;
		}
	}else{
		$row->created = $now;
		   //date( "Y-m-d H:i:s" );
		if( $my->id ){
			$row->created_by = $my->id;
		}
	}

    if( $row->catid ){
	    $row->catid = intval( $row->catid );
	}


	list( $start_hrs, $start_mins )	= explode( ':', $start_time );
	$start_hrs 		= intval($start_hrs);
	$start_mins		= intval($start_mins);

	list( $end_hrs, $end_mins )	= explode( ':', $end_time );
	$end_hrs 		= intval($end_hrs);
	$end_mins		= intval($end_mins);

	// reformat the time into 24hr format if necessary
	if( $cfg->get('com_calUseStdTime', 1) ) {

		if ($start_hrs > 12) $start_hrs = 0;
		if ($start_mins > 59) $start_mins = 0;
		if( $start_hrs != 12 && $start_pm ){
			$start_hrs += 12;
		} elseif( $start_hrs == 12 && !$start_pm ){
			$start_hrs = 0;
		}
		
		if ($end_hrs > 12) $end_hrs = 0;
		if ($end_mins > 59) $end_mins = 0;
		if( $end_hrs!= 12 && $end_pm ){
			$end_hrs += 12;
		} elseif( $end_hrs == 12 && !$end_pm ){
			$end_hrs = 0;
		}
		
	} else {
		if ($start_hrs > 23)	$start_hrs = 0;
		if ($end_hrs > 23)		$end_hrs = 0;
		if ($start_mins > 59)	$start_mins = 0;
		if ($end_mins > 59)		$end_mins = 0;
	}
	$start_time	= sprintf('%02d', $start_hrs) . ':' . sprintf('%02d', $start_mins);
	$end_time	= sprintf('%02d', $end_hrs)   . ':' . sprintf('%02d', $end_mins);

	if( $row->publish_up ){
		$publishtime		= $row->publish_up . ' ' . $start_time . ':00';
	    $row->publish_up 	= strftime( '%Y-%m-%d %H:%M:%S', strtotime( $publishtime ));
	}else{
		$row->publish_up 	= strftime( '%Y-%m-%d 00:00:00', jevNow(true));
	       //date( "Y-m-d 00:00:00" );
	}

	if( $row->publish_down ){
		$publishtime 		= $row->publish_down . ' ' . $end_time . ':00';
	    $row->publish_down 	= strftime( '%Y-%m-%d %H:%M:%S', strtotime( $publishtime ));
	} else {
	  	$row->publish_down 	= strftime( '%Y-%m-%d 23:59:59', jevNow(true));
	         //date( "Y-m-d 23:59:59" );
	}

    if( $row->publish_up <> $row->publish_down ){
	    $row->reccurtype = intval( $row->reccurtype );
	}else{
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
	if( $reccurweekdays == '' ) {
	    $weekdays = '';
	}else{
	    $weekdays = implode( '|', $reccurweekdays );
	}

    $row->reccurweekdays = $weekdays;

	// Reccur viewable weeks
	if( $reccurweeks == '' ){
	    $weekweeks = '';
	}else{
	    $weekweeks = implode( '|', $reccurweeks );
	}

	$row->reccurweeks = $weekweeks;

    // MLr: commenting out fixes bug #2959 ($access not defined - only in front end code
    /*
        // Always unpublish if no Publisher otherwise publish automatically
        if (!$access->canPublish) {
            $row->state = 0;
        } else {
            $row->state = 1;
        }
    */

	// dmcd - nov 16/04  if this is a new event, publish it, otherwise retain its state
    if( !$row->id ){
    	$row->state = 1;
    }

	$row->mask = 0;

	if( !$row->check() ) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}

	if (!$row->store()) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}

	$row->checkin();
	$row->updateOrder( "catid='$row->catid' AND state >= 0" );

	// Update Category Count
	$query = "UPDATE #__categories"
	. "\n SET count=count+1"
	. "\n WHERE id = $row->catid"
	;
	$database->setQuery( $query );
	if (!$database->query()) {
		echo "<script> alert('".$database->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}

	$return2cat = intval( mosGetParam( $_POST, 'return2cat', 0 ) );

	mosRedirect( 'index2.php?option=' . $option . '&catid=' . $return2cat );
}

/**
* Changes the state of one or more content pages
* @param string The name of the category section
* @param integer A unique category id (passed from an edit form)
* @param array An array of unique category id numbers
* @param integer 0 if unpublishing, 1 if publishing
* @param string The name of the current user
*/
function changeEvents( $id=null, $cid=null, $state=0, $option ) {
	global $database, $my, $catid;
	// clear content caches since too  we need the modules to be cleaned out too!
	mosCache::cleanCache( 'com_events' );
	mosCache::cleanCache( 'com_content' );

	if (!is_array( $cid )) {
		$cid = array();
	}
	if ($id) {
		$cid[] = $id;
	}

	if (count( $cid ) < 1) {
		$action = $publish == 1 ? _CAL_LANG_PUBLISH : ( $publish == -1 ? _CAL_LANG_TO_ARCHIVE : _CAL_LANG_UNPUBLISH );
		echo "<script> alert('" . html_entity_decode( sprintf( _CAL_LANG_MSG_SEL_TO_ACTION, $action ))
		. "'); window.history.go(-1);</script>\n";
		exit;
	}

	$cids = implode( ',', $cid );

    $query = "UPDATE #__events"
    . "\n SET state='$state'"
	. "\n WHERE id IN ($cids)"
	. "\n AND (checked_out=0 OR (checked_out='$my->id'))"
	;
    $database->setQuery( $query );
	if (!$database->query()) {
		echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
		exit();
	}

	if (count( $cid ) == 1) {
		$row = new mosEvents( $database );
		$row->checkin( $cid[0] );
	}

	mosRedirect( 'index2.php?option=' . $option . '&catid=' . $catid );
}

function removeEvents( $cid, $option ) {
	global $database;
	// clear content caches since too  we need the modules to be cleaned out too!
	mosCache::cleanCache( 'com_events' );
	mosCache::cleanCache( 'com_content' );

	if (!is_array( $cid ) || count( $cid ) < 1) {
		echo "<script>alert('" . html_entity_decode( _CAL_LANG_MSG_SEL_TO_DELETE )
		. "');window.history.go(-1);</script>\n";
		exit;
	}

	if (count( $cid )) {
		$cids = implode( ',', $cid );
		//Get Category ID prior to removing content, in order to update counts
		$query = "SELECT catid"
		. "\n FROM #__events"
		. "\n WHERE id IN ($cids)"
		;
		$database->setQuery( $query );
		$catid = $database->loadResult();

		$query = "DELETE FROM #__events"
		. "\n WHERE id IN ($cids)"
		;
		$database->setQuery( $query );
		if (!$database->query()) {
			echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
		}
	}

	// Update Category Count
	$query = "UPDATE #__categories"
	. "\n SET count=count-1"
	. "\n WHERE id = $catid"
	;
	$database->setQuery( $query	);
	if (!$database->query()) {
		echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
		exit();
	}

	mosRedirect( 'index2.php?option=' . $option );
}

/**
* Cancels an edit operation
* @param database A database connector object
*/
function cancelEvents( $option ){
	global $database;

	$row = new mosEvents( $database );
	$row->bind( $_POST );
	$row->checkin();
	$return2cat = intval( mosGetParam( $_POST, 'return2cat', 0 ) );

	mosRedirect( 'index2.php?option=' . $option . '&catid=' . $return2cat );
}

//////////////////////////////////////// CONFIG /////////////////////////////////////
function saveConfig ( $option ) {
	global $mosConfig_absolute_path, $my;

	//Options
	$csstxt = mosGetParam( $_POST, 'conf_style', '',  _MOS_ALLOWHTML|_MOS_NOTRIM|_MOS_ALLOWRAW);
	$csstxt = mosStripslashes($csstxt);

	// put all params to new EventsConfig object
	$new_config = & new EventsConfig;

	$new_config->set('com_adminmail',				trim(  strtolower( mosGetParam( $_POST,	'conf_adminmail','' ))));
	$new_config->set('com_starday',					intval(mosGetParam( $_POST, 'conf_starday', 0  )));
	$new_config->set('com_adminlevel',				intval(mosGetParam( $_POST, 'conf_adminlevel', 0 )));
	$new_config->set('com_mailview',				trim(  mosGetParam( $_POST, 'conf_mailview', '1' )));
	$new_config->set('com_frontendPublish',			trim(  mosGetParam( $_POST, 'conf_frontendPublish', '1' )));
	$new_config->set('com_byview',					trim(  mosGetParam( $_POST, 'conf_byview', '1' )));
	$new_config->set('com_hitsview',				trim(  mosGetParam( $_POST, 'conf_hitsview', '1' )));
	$new_config->set('com_repeatview',				trim(  mosGetParam( $_POST, 'conf_repeatview', '1' )));
	$new_config->set('com_showrepeats',				trim(  mosGetParam( $_POST, 'conf_showrepeats', '1')));
	$new_config->set('com_hideshowbycats',			trim(  mosGetParam( $_POST, 'conf_hideshowbycats', '1')));
	$new_config->set('com_copyright',				trim(  mosGetParam( $_POST, 'conf_copyright', '1')));
	$new_config->set('com_dateformat',				intval(mosGetParam( $_POST, 'conf_dateformat', 1 )));
	$new_config->set('com_calUseIconic',			intval(mosGetParam( $_POST, 'conf_calUseIconic', 1 )));
	$new_config->set('com_navbarcolor',				trim(  mosGetParam( $_POST, 'conf_navbarcolor', 'green' )));
	$new_config->set('com_startview',				trim(  mosGetParam( $_POST, 'conf_startview', 'view_month' )));
	$new_config->set('com_defColor',				trim(  mosGetParam( $_POST, 'conf_defColor', 'category' )));
	$new_config->set('com_calSimpleEventForm',		trim(  mosGetParam( $_POST, 'conf_calSimpleEventForm', '0')));
	$new_config->set('com_calForceCatColorEventForm',trim(  mosGetParam( $_POST, 'conf_calForceCatColorEventForm', '0')));
	$new_config->set('com_calEventListRowsPpg',		intval(mosGetParam( $_POST, 'conf_calEventListRowsPpg', 10 )));
	$new_config->set('com_calUseStdTime',			trim(  mosGetParam( $_POST, 'conf_calUseStdTime', '1' )));
	$new_config->set('com_calCutTitle',				intval(mosGetParam( $_POST, 'conf_calCutTitle', 15 )));
	$new_config->set('com_calMaxDisplay',			intval(mosGetParam( $_POST, 'conf_calMaxDisplay', 15 )));
	$new_config->set('com_calDisplayStarttime',		intval(mosGetParam( $_POST, 'conf_calDisplayStarttime', 1 )));

	// tooltips
	$new_config->set('com_calTTBackground',			intval(mosGetParam( $_POST, 'conf_calTTBackground', 1 )));
	$new_config->set('com_calTTPosX',				trim(  mosGetParam( $_POST, 'conf_calTTPosX', 'LEFT' )));
	$new_config->set('com_calTTPosY',				trim(  mosGetParam( $_POST, 'conf_calTTPosY', 'BELOW' )));
	$new_config->set('com_calTTShadow',				intval(mosGetParam( $_POST, 'conf_calTTShadow', 0 )));
	$new_config->set('com_calTTShadowX',			intval(mosGetParam( $_POST, 'conf_calTTShadowX', 0 )));
	$new_config->set('com_calTTShadowY',			intval(mosGetParam( $_POST, 'conf_calTTShadowY', 0 )));

	// mod_cal 
	$new_config->set('modcal_DispLastMonth',		trim(  mosGetParam( $_POST, 'conf_modCalDispLastMonth', 'NO' )));
	$new_config->set('modcal_DispLastMonthDays',	intval(mosGetParam( $_POST, 'conf_modCalDispLastMonthDays', 0 )));
	$new_config->set('modcal_DispNextMonth',		trim(  mosGetParam( $_POST, 'conf_modCalDispNextMonth', 'NO' )));
	$new_config->set('modcal_DispNextMonthDays',	intval(mosGetParam( $_POST, 'conf_modCalDispNextMonthDays', 0 )));

	// mod_latest
	$new_config->set('modlatest_MaxEvents',			min(150, abs(intval(mosGetParam( $_POST, 'conf_modLatestMaxEvents', 5 )))));
	$new_config->set('modlatest_Mode',				intval(mosGetParam( $_POST, 'conf_modLatestMode', 0 )));
	$new_config->set('modlatest_Days',				intval(mosGetParam( $_POST, 'conf_modLatestDays', 20 )));
	$new_config->set('modlatest_DispLinks',			trim(  mosGetParam( $_POST, 'conf_modLatestDispLinks', '1' )));
	$new_config->set('modlatest_NoRepeat',			trim(  mosGetParam( $_POST, 'conf_modLatestNoRepeat', '0' )));
	$new_config->set('modlatest_DispYear',			trim(  mosGetParam( $_POST, 'conf_modLatestDispYear', '0' )));
	$new_config->set('modlatest_DisDateStyle',		trim(  mosGetParam( $_POST, 'conf_modLatestDisDateStyle', '0' )));
	$new_config->set('modlatest_DisTitleStyle',		trim(  mosGetParam( $_POST, 'conf_modLatestDisTitleStyle', '0' )));
	$new_config->set('modlatest_LinkCloaking',		trim(  mosGetParam( $_POST, 'conf_modLatestLinkCloaking', '0' )));
	$new_config->set('modlatest_CustFmtStr',		trim(  mosGetParam( $_POST, 'conf_modLatestCustFmtStr', '', _MOS_ALLOWRAW)));


    //$configfile	= $mosConfig_absolute_path . '/administrator/components/' . $option . '/events_config.php';
	//$configfile = $mosConfig_absolute_path . '/administrator/components/' . $option . '/events_config.ini.php';
    $cssfile 	= $mosConfig_absolute_path . '/components/' . $option . '/events_css.css';

    clearstatcache();

    // get perms for restoring
    //$oldPermsConfig	= fileperms ( $configfile );
    $oldPermsCss	= fileperms ( $cssfile );
    @chmod( $cssfile, 0777 );
    //@chmod( $configfile, 0777 );

    $csspermission		= is_writable( $cssfile );
    //$configpermission	= is_writable( $configfile );

/*
    if( !$configpermission ) {
     	// $mosmsg = "Config File Not writeable";
     	mosRedirect( 'index2.php?option=' . $option . '&act=missingconf' );
    	break;
    }
*/

    if( !$csspermission ) {
    	// $mosmsg = "Config File Not writeable";
    	mosRedirect( 'index2.php?option=' . $option . '&act=missingcss' );
    	break;
	}


    // Css save
    if( $fp = @fopen( $cssfile, 'wb+' )) {
    	@fputs( $fp, $csstxt, strlen( $csstxt ));
    	@fclose( $fp );
    }

	// save config params
	$confmsg = $new_config->saveEventsINI();
	if (is_string($confmsg)) {
		mosRedirect("index2.php?option=$option&act=conf", $confmsg);
	}

    // restore perms
    @chmod( $cssfile, $oldPermsCss );
    //@chmod( $configfile, $oldPermsConfig);



	$mosmsg = _CAL_LANG_MSG_CONFIG_SAVED;
	mosRedirect( 'index2.php?option=' . $option . '&act=conf', $mosmsg );
}

function missConfig() {
	echo '<center><h2 style="color:red;">' . _CAL_LANG_MSG_WARNING . '</h2><br />';
    echo '<h3>' . _CAL_LANG_MSG_CHMOD_CONFIG . '</h3><br />';
    return;
}

function missCss() {
	echo '<center><h2 style="color:red;">' . _CAL_LANG_MSG_WARNING . '</h2><br />';
	echo '<h3>' . _CAL_LANG_MSG_CHMOD_CSS . '</h3><br />';
}

function defaultConfig() { ?>
	<script type="text/javascript">
		/* <![CDATA[ */

		function defaultConfig_com() {
			document.adminForm.conf_adminmail.value = "your@example.com";
			document.adminForm.conf_starday.value = 0;
			document.adminForm.conf_adminlevel.value = 1;
			document.adminForm.conf_mailview[1].checked = true;
			document.adminForm.conf_frontendPublish.value = 6;
			document.adminForm.conf_byview[1].checked = true;
			document.adminForm.conf_hitsview[1].checked = 1;
			document.adminForm.conf_repeatview[1].checked = true;
			document.adminForm.conf_showrepeats[1].checked = true;
			document.adminForm.conf_hideshowbycats[0].checked = true;
			document.adminForm.conf_dateformat.value = 1;
			document.adminForm.conf_copyright[1].checked = true;
			document.adminForm.conf_calUseIconic[1].checked = true;
			document.adminForm.conf_navbarcolor.value = "green";
			document.adminForm.conf_startview.value = "view_month";
			document.adminForm.conf_defColor[2].checked = true;
			document.adminForm.conf_calSimpleEventForm[0].checked = true;
			document.adminForm.conf_calForceCatColorEventForm.value = 0;
			document.adminForm.conf_calEventListRowsPpg.value = 15;
			document.adminForm.conf_calUseStdTime[1].checked = true;
			document.adminForm.conf_calCutTitle.value = "20";
			document.adminForm.conf_calMaxDisplay.value = "5";
			document.adminForm.conf_calDisplayStarttime[1].checked = true;
		}
		
		function defaultConfig_cal() {
			document.adminForm.conf_modCalDispLastMonth.value =  "NO";
			document.adminForm.conf_modCalDispLastMonthDays.value = "0";
			document.adminForm.conf_modCalDispNextMonth.value =  "NO";
			document.adminForm.conf_modCalDispNextMonthDays.value = "0";

		}
		function defaultConfig_latest() {
			document.adminForm.conf_modLatestMaxEvents.value = 5;
			document.adminForm.conf_modLatestMode.value = 0;
			document.adminForm.conf_modLatestDays.value = 20;
			document.adminForm.conf_modLatestNoRepeat[0].checked =  true;
			document.adminForm.conf_modLatestDispLinks[1].checked =  true;
			document.adminForm.conf_modLatestDispYear[0].checked =  true;
			document.adminForm.conf_modLatestCustFmtStr.value = "${eventDate}[!a: - ${endDate(%I:%M%p)}]<br />${title}";
			document.adminForm.conf_modLatestDisDateStyle[0].checked =  true;
			document.adminForm.conf_modLatestDisTitleStyle[0].checked = true;
			document.adminForm.conf_modLatestLinkCloaking[0].checked = true;
		}
		function defaultConfig_css() {
			var style = (""
<?php
				// load this from a file - its far easier to manage
			set_magic_quotes_runtime(0);
			$style = @file(dirname(__FILE__)."/default.css",true);
			foreach ($style as $linenum => $line) {
				$line = str_replace('"',"'",$line);
				if (strlen($line)>0) echo '+"\n"+"'.trim($line,"\n\r").'"';
				echo "\n";
			}
?>
			+"");
			document.adminForm.conf_style.value = style;
		}
		function defaultConfig_tooltip() {
			document.adminForm.conf_calTTBackground[1].checked = true;
			document.adminForm.conf_calTTPosX[2].checked = true;
			document.adminForm.conf_calTTPosY[1].checked = true;
			document.adminForm.conf_calTTShadow[1].checked = true;
			document.adminForm.conf_calTTShadowX[0].checked = true;
			document.adminForm.conf_calTTShadowY[0].checked = true;
		}
		
		function defaultConfig_all() {
			defaultConfig_com();
			defaultConfig_cal();
			defaultConfig_latest();
			defaultConfig_css();
			defaultConfig_tooltip();
		 }
		/* ]]> */
	</script>
	<?php
}
?>