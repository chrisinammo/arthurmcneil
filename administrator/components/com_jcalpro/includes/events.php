<?php
/*
**********************************************
JCal Pro v1.5.3
Copyright (c) 2006-2007 Anything-Digital.com
**********************************************
JCal Pro is a fork of the existing Extcalendar component for Joomla!
(com_extcal_0_9_2_RC4.zip from mamboguru.com).
Extcal (http://sourceforge.net/projects/extcal) was renamed
and adapted to become a Mambo/Joomla! component by
Matthew Friedman, and further modified by David McKinnis
(mamboguru.com) to repair some security holes.

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This header must not be removed. Additional contributions/changes
may be added to this header as long as no information is deleted.
**********************************************

$File: events.php - Backend events management

Revision date: 03/07/2007

**********************************************
Get the latest version of JCal Pro at:
http://dev.anything-digital.com//
**********************************************
*/

/** ensure this file is being included by a parent file */
defined('_JEXEC') or die('Direct access to this location is not allowed.');

include_once dirname(__FILE__) . '/events.html.php';

$id	= mosGetParam ( $_REQUEST ,'id', 0 );

if ( $task == 'edit' && $id == 0 )
{
	$id = implode ( ',', $cid );
}

switch ( $task )
{
	case 'new':
		editEvent ( '0', $option, $section );
		break;

	case 'edit':
		editEvent ( $id, $option, $section );
		break;

	case 'editA':
		editEvent ( $id, $option, $section );
		break;

	case 'save':
		saveEvent ( $option, $section );
		break;

	case 'remove':
		removeEvents ( $cid, $option, $section );
		break;

	case 'publish':
		changeEvent ( $cid, 1, $option, $section );
		break;

	case 'unpublish':
		changeEvent ( $cid, 0, $option, $section );
		break;

	case 'notapprove':
		changeEvent ( $cid, 2, $option, $section );
		break;

	case 'approve':
		changeEvent ( $cid, 3, $option, $section );
		break;
		
  case 'cancel':
    cancelEvent ( $option, $section );
		break;

	default:
		showEvents ( $option, $section );
		break;
}

/**
* List the records
* @param string The current GET/POST option
*/
function showEvents ( $option, $section )
{
	global $database, $mainframe, $mosConfig_list_limit;

	$limit 		= $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', $mosConfig_list_limit );
	$limitstart = $mainframe->getUserStateFromRequest( "view{$option}limitstart", 'limitstart', 0 );
	$search 	= $mainframe->getUserStateFromRequest( "search{$option}", 'search', '' );
	$search 	= $database->getEscaped( trim( strtolower( $search ) ) );
	$cat = intval( $mainframe->getUserStateFromRequest( "cat{$option}", 'cat', 0 ) );


	if ( $search )
	{
		$where[] = "#__jcalpro_events.title LIKE '%$search%'";
	}

	if ( $cat > 0 ) {
		$where[] = "cat = $cat";
	}

	if ( isset ( $where ) )
	{
		$where = "\n WHERE ". implode( ' AND ', $where );
	}
	else
	{
		$where = '';
	}

	// get the total number of records
	$database->setQuery( "SELECT COUNT(*) FROM #__jcalpro_events $where" );
	$total = $database->loadResult();

	require_once ( $GLOBALS['mosConfig_absolute_path'] . '/administrator/includes/pageNavigation.php' );
	$pageNav = new mosPageNav ( $total, $limitstart, $limit  );

	// get the subset (based on limits) of required records
	$query = "SELECT #__jcalpro_events.*, #__jcalpro_categories.cat_name as categoryName"
		. "\n FROM #__jcalpro_events"
		. "\n LEFT JOIN #__jcalpro_categories"
		. "\n ON #__jcalpro_events.cat = #__jcalpro_categories.cat_id"
		. $where
		. "\n ORDER BY #__jcalpro_events.title ASC"
		. "\n LIMIT $pageNav->limitstart, $pageNav->limit"
	;

	$database->setQuery( $query );
	$rows = $database->loadObjectList();

	$database->setQuery ( "SELECT * FROM #__jcalpro_categories WHERE published = '1' ORDER BY cat_name" );

	$categoriesList[] 	= mosHTML::makeOption( '0', 'Select Category', 'cat_id', 'cat_name' );
	$categoriesList 	= array_merge ( $categoriesList, $database->loadObjectList ( ) );
	$lists['categories'] 	= mosHTML::selectList ( $categoriesList, 'cat', 'class="inputbox" size="1" onchange="document.adminForm.submit( );"','cat_id', 'cat_name', $cat );

	HTML_events::showEvents( $rows, $pageNav, $search, $option, $section, $lists );
}

/**
* Creates a new or edits and existing user record
* @param int The id of the record, 0 if a new entry
* @param string The current GET/POST option
*/
function editEvent ( $id, $option, $section )
{
	global $database, $my, $acl;
	global $mosConfig_absolute_path;
	global $lang_date_format;
	global $CONFIG_EXT;

	$row = new mosJCalProEvents ( $database );

	// load the row from the db table
	$row->load ( $id );

	if ( $id )
	{
		// do stuff for existing records
		$row->checkout ( $my->id );
	}
	else
	{
		// do stuff for new records
		$row->start_date = date('y-m-d');
		$row->end_date = date('y-m-d');
		$row->published = 1;
		$row->approved = 1;
	}

	$lists = array();

	$dateTime = ( strtotime ( $row->start_date ) );
	$startDateArr = getdate ( $dateTime);

	if( $row->recur_until == "0000-00-00" )
		{
			$recurUntilStamp = strtotime ( $row->start_date );
		}
	else
		{
			$recurUntilStamp = strtotime ( $row->recur_until . " 00:00:00" );
		}

	$recurUntilArr = getdate ( $recurUntilStamp );

	$row->start_time_ampm = date ( "a", strtotime ( $row->start_date ) );

	if ( ( $row->end_date == '0000-00-00 00:00:00') || ( $row->end_date == '0000-00-00 00:00:01' ) )
	{
		$row->durationType = ( intval ( substr ( $row->end_date, -1,1 ) ) ) ? 2 : 0;
		$row->endDays = '0';
		$row->endHours = '0';
		$row->endMinutes = '0';
	}
	else
	{
		$duration_array = datestoduration ( $row->start_date, $row->end_date );

		$row->endDays = $duration_array['days'];
		$row->endHours = $duration_array['hours'];
		$row->endMinutes = $duration_array['minutes'];
		$row->durationType = 1;
	}

	$checked['normal'] = ( ( int ) $row->durationType == 1 ) ? 'checked' : '';
	$checked['allday'] = ( ( int ) $row->durationType == 2 ) ? 'checked' : '';
	$checked['none'] = ( ( int ) $row->durationType == 0 ) ? 'checked' : '';

	switch ( $row->recur_type )
	{
		case 'day':
		case 'week':
		case 'month':
		case 'year':
			$row->recur_type_select = '1';
		break;

		case '':
		default:
			$row->recur_type_select = '0';
		break;
	}

	$checked['recurNone'] = !( ( int ) $row->recur_type_select ) ? 'checked' : '';
	$checked['recurEvery'] = ( ( int ) $row->recur_type_select == 1 ) ? 'checked' : '';

	$checked['recurEndDateNone'] = !( ( int ) $row->recur_end_type ) ? 'checked' : '';
	$checked['recurEndDateCount'] = ( ( int ) $row->recur_end_type == 1 ) ? 'checked' : '';
	$checked['recurEndDateUntil'] = ( ( int ) $row->recur_end_type == 2 ) ? 'checked' : '';


	$lists['published'] = mosHTML::yesnoradioList ( 'published', '', $row->published );
	$lists['approved'] = mosHTML::yesnoradioList ( 'approved', '', $row->approved );

	// Build categories select list
	$database->setQuery ( "SELECT * FROM #__jcalpro_categories WHERE published = '1' ORDER BY cat_name" );

	$categoriesList[] 	= mosHTML::makeOption( '0', 'Select Category', 'cat_id', 'cat_name' );
	$categoriesList 	= array_merge ( $categoriesList, $database->loadObjectList ( ) );
	$lists['categories'] 	= mosHTML::selectList ( $categoriesList, 'cat', 'class="inputbox" size="1"','cat_id', 'cat_name', $row->cat );

	// building day list
	for ( $i = 1; $i <= 31; $i++ )
	{
		$daysList[] = mosHTML::makeOption( $i, $i, 'day_id', 'day_name' );
	}

	$lists['days'] 	= mosHTML::selectList ( $daysList, 'day', 'class="inputbox" size="1"','day_id', 'day_name', $startDateArr['mday'] );

	// building month list
	for ( $i = 1; $i <= 12; $i++ )
	{
		$monthList[] = mosHTML::makeOption( $i, $lang_date_format['months'][$i-1], 'month_id', 'month_name' );
	}

	$lists['months'] 	= mosHTML::selectList ( $monthList, 'month', 'class="inputbox" size="1"','month_id', 'month_name', $startDateArr['mon'] );

	// building year list

	$y = date ( "Y", extcal_get_local_time ( ) ) - 1;

	for ( $i = 1; $i <= 4; $i++ )
	{
		$yearList[] = mosHTML::makeOption( $y, $y, 'year_id', 'year_name' );

		$y++;
	}

	$lists['years'] 	= mosHTML::selectList ( $yearList, 'year', 'class="inputbox" size="1"','year_id', 'year_name', $startDateArr['year'] );

	// building hours list options
	if ( $CONFIG_EXT['time_format_24hours'] )
	{
		$hoursInit = 0;
		$hoursLimit = 23;
	}
	else
	{
		$hoursInit = 1;
		$hoursLimit = 12;
		if( $startDateArr['hours'] > 12 ) { $startDateArr['hours'] -= 12; }
	}

	// building hours list
	for ( $i = $hoursInit; $i <= $hoursLimit; $i++ )
	{
		$hourList[] = mosHTML::makeOption ( sprintf ( "%02d" ,$i ), sprintf ( "%02d", $i ), 'hour_id', 'hour_name' );
	}

	$lists['hours'] 	= mosHTML::selectList ( $hourList, 'hours', 'class="inputbox" size="1"','hour_id', 'hour_name', $startDateArr['hours'] );


	// building minutes list
	for ( $i = 0; $i <= 59; $i++ )
	{
		$minutesList[] = mosHTML::makeOption ( sprintf ( "%02d", $i ), sprintf ( "%02d", $i ), 'minute_id', 'minute_name' );
	}

	$lists['minutes'] 	= mosHTML::selectList ( $minutesList, 'minutes', 'class="inputbox" size="1"','minute_id', 'minute_name', $startDateArr['minutes'] );

	if( !$CONFIG_EXT['time_format_24hours'] )
	{
		$ampmList[] = mosHTML::makeOption ( 'am', 'am', 'ampm_id', 'ampm_name' );
		$ampmList[] = mosHTML::makeOption ( 'pm', 'pm', 'ampm_id', 'ampm_name' );

		$lists['ampm'] = mosHTML::selectList ( $ampmList, 'ampm', 'class="inputbox" size="1"','ampm_id', 'ampm_name', $row->start_time_ampm );
	}
	else
	{
		$lists['ampm'] = '';
	}

	// building recurrence info

	$recurValuesList[] = mosHTML::makeOption ( '', 'Pick Time', 'recur_id', 'recur_name' );
	$recurValuesList[] = mosHTML::makeOption ( 'day', 'Day(s)', 'recur_id', 'recur_name' );
	$recurValuesList[] = mosHTML::makeOption ( 'week', 'Week(s)', 'recur_id', 'recur_name' );
	$recurValuesList[] = mosHTML::makeOption ( 'month', 'Month(s)', 'recur_id', 'recur_name' );
	$recurValuesList[] = mosHTML::makeOption ( 'year', 'Year(s)', 'recur_id', 'recur_name' );

	$lists['recurValues'] = mosHTML::selectList ( $recurValuesList, 'recur_type', 'class="inputbox" size="1"','recur_id', 'recur_name', $row->recur_type );

	// building recuring day list
	for ( $i = 1; $i <= 31; $i++ )
	{
		$recuringDaysList[] = mosHTML::makeOption( $i, $i, 'recuringday_id', 'recuringday_name' );
	}

	$lists['recuringDays'] 	= mosHTML::selectList ( $recuringDaysList, 'recuringDay', 'class="inputbox" size="1"','recuringday_id', 'recuringday_name', $recurUntilArr['mday'] );

	// building recuring month list
	for ( $i = 1; $i <= 12; $i++ )
	{
		$recuringMonthList[] = mosHTML::makeOption( $i, $lang_date_format['months'][$i-1], 'recuringMonth_id', 'recuringMonth_name' );
	}

	$lists['recuringMonths'] 	= mosHTML::selectList ( $recuringMonthList, 'recuringMonth', 'class="inputbox" size="1"','recuringMonth_id', 'recuringMonth_name', $recurUntilArr['mon'] );

	// building recuring year list

	$y = date ( "Y", extcal_get_local_time ( ) ) - 1;

	for ( $i = 1; $i <= 4; $i++ )
	{
		$recuringYearList[] = mosHTML::makeOption( $y, $y, 'recuringYear_id', 'recuringYear_name' );

		$y++;
	}

	$lists['recuringYears'] 	= mosHTML::selectList ( $recuringYearList, 'recuringYear', 'class="inputbox" size="1"','recuringYear_id', 'recuringYear_name', $recurUntilArr['year'] );

	$row->description = html_entity_decode ( $row->description );

	HTML_events::editEvent ( $row, $lists, $checked, $option, $section );
}

/**
* Saves the record from an edit form submit
* @param string The current GET/POST option
*/
function saveEvent ( $option, $section )
{
	global $database, $CONFIG_EXT;

	$row = new mosJCalProEvents( $database );

	if ( $CONFIG_EXT['time_format_24hours'])
	{
		$start_time_hour = $_POST['hours']; // 24 hours mode
	}
	else
	{
		$start_time_hour = extcal_12to24hour ( $_POST['hours'], $_POST['ampm'] ); // 12 hours mode
	}

	$_POST['start_date'] = date ( "Y-m-d H:i:s", mktime ( $start_time_hour, $_POST['minutes'], 0, $_POST['month'], $_POST['day'], $_POST['year'] ) );

	if ( $_POST['duration_type'] == '1' )
	{ // This is a normal event, with a SPECIFIED duration
		if ( $_POST['end_days'] > 0 && !$_POST['end_hours'] && !$_POST['end_minutes'] )
		{
			$_POST['end_days']--; // to make sure not to jump to the next day, we push the time to 23:59:59
			$total_hours = 23;
			$total_minutes = 59;
			$total_seconds = 59;
		}
		else
		{
			$total_hours = $start_time_hour + $_POST['end_hours'];
			$total_minutes = $_POST['minutes'] + $_POST['end_minutes'];
			$total_seconds = 0;
		}
			$_POST['end_date'] = date ( "Y-m-d H:i:s", mktime ( $total_hours, $total_minutes, $total_seconds, $_POST['month'], $_POST['day'] + $_POST['end_days'], $_POST['year'] ) );
		}
		else if ( $_POST['duration_type'] == '2' )
		{ // This is an event where "No end date" was checked instead
			$_POST['end_date'] = '0000-00-00 00:00:01';
		}
		else
		{ // This is an event where "No end date" was checked instead
			$_POST['end_date'] = '0000-00-00 00:00:00';
		}

		if( $_POST['recur_type_select'] == 0 )
			{
				$_POST['recur_type'] = '';
			}
		else
			{
				if ( $_POST['recur_end_type'] == 2 )
					{
						$enddatestamp = mktime ( 0, 0, 0, $_POST['recuringMonth'], $_POST['recuringDay'], $_POST['recuringYear'] );
						$_POST['recur_until'] = $recur_until = date("Y-m-d", $enddatestamp);
					}
			}

		//$_POST['recuringDays']

				/*

					// Set recurrence information
					switch((int)$form['recur_type_select']) {
						case 1:
							$recur_type = $form['recur_type_1'];
							$recur_val = $form['recur_val_1'];
							break;
						case 0:
						default:
							$recur_type = '';
							$recur_val = 0;
							break;
					}
					$recur_end_type = $form['recur_end_type'];
					$recur_count = $form['recur_end_count'];

					// Determine the recur_until value by doing actual calculation if necessary. If the recur type
					// is "recur x number of times" then we calculate the end date.
					if ( $recur_end_type == 0 || $recur_type == '' ) $recur_until = substr($start_date,0,10);
					else if ( $recur_end_type == 2 ) $recur_until = date("Y-m-d", mktime(0, 0, 0, $form['recur_until_month'], $form['recur_until_day'], $form['recur_until_year']));
					else {
						switch ( $recur_type ) {
							case "day":
									$enddatestamp = mktime(0,0,0,$month,$day+($recur_val*$recur_count),$year);
									break;
							case "week":
									$enddatestamp = mktime(0,0,0,$month,$day+($recur_val*$recur_count*7),$year);
									break;
							case "month":
									$enddatestamp = mktime(0,0,0,$month+($recur_val*$recur_count),$day,$year);
									break;
							case "year":
									$enddatestamp = mktime(0,0,0,$month,$day,$year+($recur_val*$recur_count));
									break;
							default:
									break;
						}
						$recur_until = date("Y-m-d", $enddatestamp);
					}
					*/

	if ( !$row->bind ( $_POST ) )
	{
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}

	// save params
	$params = mosGetParam( $_POST, 'params', '' );
	if ( is_array( $params ) )
	{
		$txt = array ( );

		foreach ( $params as $k=>$v)
		{
			$txt[] = "$k=$v";
		}

		$row->params = implode( "\n", $txt );
	}

	// pre-save checks
	if ( !$row->check ( ) )
	{
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit ( );
	}

	// save the changes
	if ( !$row->store ( ) )
	{
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit ( );
	}

	$insertId = $database->insertid ( );

	$row->checkin ( );
	$row->updateOrder ( );

	mosRedirect( "index2.php?option=$option&section=$section" );
}

/**
* Removes records
* @param array An array of id keys to remove
* @param string The current GET/POST option
*/
function removeEvents( &$cid, $option, $section )
{
	global $database;

	if ( count ( $cid ) )
	{
		$cids = implode ( ',', $cid );

		$database->setQuery( "DELETE FROM #__jcalpro_events WHERE extid IN ($cids)" );
		if ( !$database->query ( ) )
		{
			echo "<script> alert('".$database->getErrorMsg ( )."'); window.history.go(-1); </script>\n";
		}
	}

	mosRedirect( "index2.php?option=$option&section=$section" );
}

/**
* Changes the state of one or more content pages
* @param array An array of unique category id numbers
* @param integer 0 if unpublishing, 1 if publishing
* @param string The current option
*/
function changeEvent ( $cid=null, $state=0, $option, $section )
{
	global $database, $my;

    $actions = array( 0=>"unpublish", 1=>"publish", 2=>"notapprove", 3=>"approve" );
    
	if ( count( $cid ) < 1 )
	{
		echo "<script> alert('Select a record to ".$actions[$state]."'); window.history.go(-1);</script>\n";
		exit;
	}

	$cids = implode ( ',', $cid );

	if( $state == 0 || $state == 1 ) {
	    $database->setQuery ( "UPDATE #__jcalpro_events SET published='$state'"
	    . "\nWHERE extid IN ($cids) AND (checked_out=0 OR (checked_out='$my->id'))"
	    );
	}
	if( $state == 2 || $state == 3 ) {
	    $state -= 2;
	    $database->setQuery ( "UPDATE #__jcalpro_events SET approved='$state'"
	    . "\nWHERE extid IN ($cids) AND (checked_out=0 OR (checked_out='$my->id'))"
	    );
	}

	if ( !$database->query ( ) )
	{
		echo "<script> alert('".$database->getErrorMsg ( )."'); window.history.go(-1); </script>\n";
		exit();
	}

	if ( count( $cid ) == 1 )
	{
		$row = new mosJCalProEvents ( $database );
		$row->checkin ( intval ( $cid[0] ) );
	}

	mosRedirect ( "index2.php?option=$option&section=$section" );
}

/** PT
* Cancels editing and checks in the record
*/
function cancelEvent ( $option, $section )
{
	global $database;

	$row = new mosJCalProEvents ( $database );
	$row->bind ( $_POST );
	$row->checkin ( ) ;

	mosRedirect ( "index2.php?option=$option&section=$section" );
}
?>