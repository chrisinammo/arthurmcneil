<?php
/**
 * Events Component for Joomla 1.0.x
 *
 * @version     $Id: events.old.php 845 2007-07-12 07:07:27Z geraint $
 * @package     Events
 * @copyright   Copyright (C) 2006 JEvents Project Group
 * @licence     http://www.gnu.org/copyleft/gpl.html
 * @link        http://joomlacode.org/gf/project/jevents
 */
defined( '_VALID_MOS' ) or die( 'Restricted access' );

include_once(dirname(__FILE__)."/events.class.old.php");

function listEventsByDate( $select_date ){
    global $database, $gid;

    // dmcd May 7/04 added category access condition
    /*    $sql = "SELECT * FROM #__events"
            . "\nWHERE ("
            . "\n   (publish_up >= '$select_date 00:00:00' AND publish_up <= '$select_date 23:59:59')"
            . "\n   OR (publish_down >= '$select_date 00:00:00' AND publish_down <= '$select_date 23:59:59')"
            . "\n   OR (publish_up <= '$select_date 00:00:00' AND publish_down >= '$select_date 23:59:59')"
            . "\n   OR (publish_up >= '$select_date 00:00:00' AND publish_down <= '$select_date 23:59:59')" // added RC3
            . "\n )"
            . "\nAND state = '1' ORDER BY publish_up ASC";
    */
    /*
        $sql = "SELECT #__events.* FROM #__categories AS b, #__events"
                    . "\n WHERE #__events.catid = b.id AND b.access <= $gid AND #__events.access <= $gid AND"
            . "\n   ((publish_up >= '$select_date 00:00:00' AND publish_up <= '$select_date 23:59:59')"
            . "\n   OR (publish_down >= '$select_date 00:00:00' AND publish_down <= '$select_date 23:59:59')"
            . "\n   OR (publish_up <= '$select_date 00:00:00' AND publish_down >= '$select_date 23:59:59')"
            . "\n   OR (publish_up >= '$select_date 00:00:00' AND publish_down <= '$select_date 23:59:59')" // added RC3
            . "\n )"
            . "\nAND #__events.state = '1' ORDER BY publish_up ASC";
    /*
    /* GWE change to allow mambelfish to work!*/

    $query = "SELECT #__events.*"
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

function listEventsByMonth( $year, $month, $order ){
    global $database, $gid;

    $select_date 		= $year . '-' . $month . '-01 00:00:00';
    $select_date_fin 	= $year . '-' . $month . '-' . date( 't', mktime( 0, 0, 0, ( $month + 1 ), 0, $year ))
    . ' 23:59:59';

    if( !$order ){
    	$order = 'publish_up';
    }
    // dmcd May 7/04 added category access condition
    /*
        $sql = "SELECT #__events.* FROM #__categories AS b, #__events
                WHERE #__events.catid = b.id AND b.access <= $gid AND #__events.access <= $gid AND
               (((publish_up >= '$select_date%' AND publish_up <= '$select_date_fin%')
                OR (publish_down >= '$select_date%' AND publish_down <= '$select_date_fin%')
                OR (publish_up >= '$select_date%' AND publish_down <= '$select_date_fin%')
                OR (publish_up <= '$select_date%' AND publish_down >= '$select_date_fin%'))
                AND #__events.state = '1') ORDER BY $order ASC"; //publish_up ASC, reccurtype ASC
    */
    /* GWE change to allow mambelfish to work!*/

    $query = "SELECT #__events.*"
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

    $startday = $cfg->get("com_startday");
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

function listEventsByYear( $year, $limitstart, $limit ) {
    global $database, $gid;

    $rows_per_page = $limit;

    if( empty( $limitstart ) || !$limitstart ){
    	$limitstart = 0;
    }

    $limit = "LIMIT $limitstart, $rows_per_page";

    // dmcd May 7/04 added category access condition
    /*
        $sql = "SELECT * FROM #__categories AS b, #__events
                WHERE #__events.catid = b.id AND b.access <= $gid AND #__events.access <= $gid AND
                publish_up LIKE '$year%' AND (publish_down >= '$year%' OR publish_down = '0000-00-00 00:00:00')
                AND #__events.state = '1' ORDER BY publish_up ASC $limit";
    */
    /* GWE change to allow mambelfish to work!*/

	$query = "SELECT *"
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

function showEventsByYear( $year, $limit, $limitstart ){
    global $database, $option, $Itemid, $gid, $mosConfig_list_limit;
    global $mainframe,$cfg;
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
    $limit = $limit ? $limit : $cfg->get("com_calEventListRowsPpg");

    if( $total <= $limit ) {
		$limitstart = 0;
	}

	if ($cfg->get("com_showrepeats")) {
		echo '<fieldset id="ev_fieldset"><legend class="ev_fieldset">' . _CAL_LANG_ARCHIVE . '</legend><br />' . "\n";
		echo '<table align="center" width="90%" cellspacing="0" cellpadding="0" class="ev_table">' . "\n";
		?>
            <tr valign="top">
                <td colspan=2  align="center" class="cal_td_daysnames">
                   <!-- <div class="cal_daysnames"> -->
                    <?php echo $year ;?>
                    <!-- </div> -->
                </td>
            </tr>
		<?php
		for($month = 1; $month <= 12; $month++) {
			$month = str_pad($month, 2, '0', STR_PAD_LEFT);
			$rows  = listEventsByMonth($year, $month, 'publish_up,catid');
			$num_events = count($rows);
			if ($num_events > 0){
				echo "<tr><td width='50' class='ev_td_left'>".mosEventsHTML::getDateFormat($year,$month,'',3)."</td>\n";
				echo "<td class='ev_td_right'><ul class='ev_ul'>\n ";
				for ($r = 0; $r < count($rows); $r++) {
					$row = $rows[$r];

					$event_up			= new mosEventDate( $row->publish_up );
					$event_up->day		= sprintf( '%02d',	$event_up->day);
					$event_up->month	= sprintf( '%02d',	$event_up->month);
					$event_up->year		= sprintf( '%4d',	$event_up->year);
					$event_month_year	= $event_up->month .$event_up->year;
					$contactlink		= mosEventsHTML::getUserMailtoLink($row->id, $row->created_by);
					$catid				= $row->catid;
					$catname			= mosEventsHTML::getCategoryName($row->catid);
					$bgcolor			= setColor($row);
					$fgcolor			= mapColor($bgcolor);
					$listyle 			= 'style="background-color:'.$bgcolor.';color:'.$fgcolor.';margin-bottom:1px;"';
					
					echo "<li class='ev_td_li' $listyle>\n";
					HTML_events::viewEventRow ($row->id,$row->title,'view_detail',$event_up->year,$event_up->month,$event_up->day,$contactlink, $option, $Itemid, $fgcolor);
					echo "&nbsp;::&nbsp;";
					HTML_events::viewEventCatRow ($catid,$catname,'view_cat',$event_up->year,$event_up->month,$event_up->day,$option,$Itemid, $fgcolor);
					echo "</li>\n";					
				}
				echo '</ul></td></tr>' . "\n";

			}
		}
		echo '</table><br />' . "\n";
		echo '</fieldset><br />' . "\n";
	} else {

		$rows 		= listEventsByYear( $year, $limitstart, $limit );
		$num_events = count( $rows );
		$chdate 	= '';

		echo '<fieldset id="ev_fieldset"><legend class="ev_fieldset">' . _CAL_LANG_ARCHIVE . '</legend><br />' . "\n";
		echo '<table align="center" width="90%" cellspacing="0" cellpadding="5" class="ev_table">' . "\n";

		if( $num_events > 0 ){
			for( $r = 0; $r < count( $rows ); $r++ ) {
				$row = $rows[$r];
		
				$event_up = new mosEventDate( $row->publish_up );
				$event_up->day 		= sprintf( '%02d',	$event_up->day );
				$event_up->month 	= sprintf( '%02d',	$event_up->month );
				$event_up->year 	= sprintf( '%4d',	$event_up->year );
				$event_month_year 	= $event_up->month . $event_up->year;
				$contactlink 		= mosEventsHTML::getUserMailtoLink( $row->id, $row->created_by );
				$catid 				= $row->catid;
				$catname 			= mosEventsHTML::getCategoryName( $row->catid );
				$bgcolor			= setColor($row);
				$fgcolor			= mapColor($bgcolor);
				$listyle 			= 'style="background-color:'.$bgcolor.';color:'.$fgcolor.';margin-bottom:1px;"';
							
				if(( $event_month_year <> $chdate ) && $chdate <> '' ){
					echo '</td></tr>' . "\n";
				}
		
				if( $event_month_year <> $chdate ){
					echo '<tr><td width="50" class="ev_td_left">'
					. mosEventsHTML::getDateFormat( $event_up->year, $event_up->month, '', 3 ) . '</td>' . "\n";
					echo '<td class="ev_td_right"><ul class="ev_ul">' . "\n ";
				}

				echo "<li class='ev_td_li' $listyle>\n";
				HTML_events::viewEventRow( $row->id, $row->title, 'view_detail', $event_up->year, $event_up->month, $event_up->day, $contactlink, $option, $Itemid);
		
				echo '&nbsp;::&nbsp;';
				HTML_events::viewEventCatRow( $catid, $catname, 'view_cat', $event_up->year, $event_up->month, $event_up->day, $option, $Itemid);
				echo "</li>\n";		
				$chdate = $event_month_year;
				if( $event_month_year <> $chdate ){
					echo '</ul></td></tr>' . "\n ";
				}
			}
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

function showEventsByDate( $year, $month, $day ){
    global $database, $option, $Itemid, $catid;
    global $mainframe;
    include_once(mosMainFrame::getBasePath()."/administrator/components/com_events/colorMap.php");

    $select_date		= sprintf( '%4d-%02d-%02d', $year, $month, $day );
    $rows				= listEventsByDate( $select_date );

    usort( $rows, 'sortEvents' );

    $num_events			= count( $rows );
    $chhours 			= '';
    $printcount 		= 0;
    $new_rows_events 	= array();

    if( $num_events > 0 ){
        for( $r = 0; $r < $num_events; $r++ ){
        	$row = $rows[$r];

	    	$event_up = new mosEventDate( $row->publish_up );
	    	$event_up->day		= sprintf( '%02d',	$event_up->day );
            $event_up->month 	= sprintf( '%02d',	$event_up->month );
            $event_up->year 	= sprintf( '%4d',	$event_up->year );

	    	$start_time 		= ( defined( '_CAL_USE_STD_TIME' ) && _CAL_USE_STD_TIME == 'YES' ) ? $event_up->get12hrTime() : $event_up->get24hrTime();

			// if start and end times are the same show no start time
			$event_down	= new mosEventDate( $row->publish_down );
			$end_time	= (defined("_CAL_USE_STD_TIME") && _CAL_USE_STD_TIME == "YES") ? $event_down->get12hrTime() : $event_down->get24hrTime();

			if ($start_time == $end_time) {
				$start_time = "      ";
			}

	    	$new_contactlink	= mosEventsHTML::getUserMailtoLink( $row->id, $row->created_by );
	    	$new_catname		= mosEventsHTML::getCategoryName( $row->catid );

	    	$checkprint = new mosEventRepeat( $row, $year, $month, $day );

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
	                                   $row->useCatColor);
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
                $useCatColor ) =  $new_rows_events[$t];

            if(( $start_time <> $chhours ) && $chhours <> '' ){
                echo '</ul></td>' . "\n";
            }

            if( $start_time <> $chhours ){
                echo '<tr><td align="center" valign="top" width="50" class="ev_td_left">' . $start_time . '</td>' . "\n";
                echo '<td class="ev_td_right"><ul class="ev_ul">' . "\n";
            }
			
			$bgcolor			= setColor($rows[$t]);
			$fgcolor			= mapColor($bgcolor);
			$listyle 			= 'style="background-color:'.$bgcolor.';color:'.$fgcolor.';margin-bottom:1px;"';
			
            echo "<li class='ev_td_li' $listyle>\n";
            HTML_events::viewEventRow ( $id, $title, 'view_detail', $event_year, $event_month, $event_day, $contactlink, $option, $Itemid,$fgcolor);

            echo '&nbsp;::&nbsp;';

            HTML_events::viewEventCatRow( $catid, $catname, 'view_cat', $year, $month, $day, $option, $Itemid,$fgcolor);
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

function showEventsByWeek( $year, $month, $day ){
    global $mosConfig_offset, $database, $option, $Itemid;
    global $mainframe, $cfg;
    include_once(mosMainFrame::getBasePath()."/administrator/components/com_events/colorMap.php");

    // Other methode to investigate
    //$rows = listEventsByWeek ($year,$month,$day,$offset);
    //$max_events = count($rows);

    $startday 	= $cfg->get("com_startday");
    $numday		= (( date( 'w', mktime( 0, 0, 0, $month, $day, $year )) - $startday ) %7 );

    if( $numday == -1 ){
       $numday = 6;
    }

    $week_start = mktime( 0, 0, 0, $month, ( $day - $numday ), $year );

    $this_date = new mosEventDate();
    $this_date->setDate( strftime( '%Y', $week_start ), strftime( '%m', $week_start ), strftime( '%d', $week_start ));
    //$this_date->setDate( date ( "Y", $week_start ),date ( "m", $week_start ),date ( "d", $week_start ));
    $this_enddate = clone( $this_date );
    $this_enddate->addDays( +6 );

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
		. '&amp;month=' . $week_month . '&amp;day=' . $week_day . '&amp;Itemid=' . $Itemid );
        $day_link = '<a class="ev_link_weekday" href="' . $link . '" title="' . _CAL_LANG_CLICK_TOSWITCH_DAY . '">'
        . mosEventsHTML::getDateFormat( $week_year, $week_month, $week_day, 2 ) . '</a>' . "\n";

        //if($week_month==date("m")&$week_year==date("Y")&$week_day==date("d")) {

        if( $week_month == strftime( '%m', time() + ( $mosConfig_offset * 60 * 60 ) )
            && $week_year == strftime( '%Y', time() + ( $mosConfig_offset * 60 * 60 ) )
            && $week_day == strftime( '%d', time() + ( $mosConfig_offset * 60 * 60 ) )
            ) {
            $bg = 'class="ev_td_today"';
        }else{
        	$bg = 'class="ev_td_left"';
        }

        echo '<tr><td align="center" valign="top" width="50" ' . $bg . '>' . $day_link . '</td>' . "\n";
        echo '<td class="ev_td_right">' . "\n";

    	$select_date	= sprintf( '%4d-%02d-%02d', $week_year, $week_month, $week_day );
        $rows			= listEventsByDate( $select_date );
        $num_events		= count( $rows );
        $countprint		= 0;

    	if( $num_events > 0 ){
        	echo '<ul class="ev_ul">';
            for( $r = 0; $r < $num_events; $r++ ){
                $row = $rows[$r];

                $event_up = new mosEventDate( $row->publish_up );
	        	$event_up->day		= sprintf( '%02d', $event_up->day );
                $event_up->month	= sprintf( '%02d', $event_up->month );
                $event_up->year		= sprintf( '%4d', $event_up->year );

                $contactlink 		= mosEventsHTML::getUserMailtoLink( $row->id, $row->created_by );
                $catname			= mosEventsHTML::getCategoryName( $row->catid );
                $bgcolor			= setColor($row);
				$fgcolor			= mapColor($bgcolor);
				$listyle 			= 'style="background-color:'.$bgcolor.';color:'.$fgcolor.';margin-bottom:1px;"';

				$checkprint = new mosEventRepeat( $row, $week_year, $week_month, $week_day );
				if( $checkprint->viewable == true ){
					echo "<li class='ev_td_li' $listyle>\n";
                    HTML_events::viewEventRow ( $row->id, $row->title, 'view_detail', $event_up->year, $event_up->month, $event_up->day, $contactlink, $option, $Itemid,$fgcolor );

                    echo '&nbsp;::&nbsp;';

                    HTML_events::viewEventCatRow ( $row->catid, $catname, 'view_cat', $event_up->year, $event_up->month, $event_up->day, $option, $Itemid,$fgcolor );
					echo "</li>\n";					
                    
                    $countprint++;
                }
            }
            if( $countprint == 0 ){
                echo '&nbsp;';
            }
            echo '</ul></td></tr>' . "\n";
        } else {
			// dmcd Aug 6/04  commented this anoying message out
			//echo _CAL_LANG_NO_EVENTFORTHE."&nbsp;<b>".mosEventsHTML::getDateFormat($week_year,$week_month,$week_day ,4)."</b>\n";
            echo '&nbsp;</td></tr>' . "\n";
			//echo '</tr>' . "\n";
        }
    } // end for days

    echo '</table><br />' . "\n";
    echo '</fieldset><br /><br />' . "\n";
    //showNavTableText(20, 20, $max_events, $offset, 'view_week');
}

function showCalendar( $rows, $year, $month, $day ){
    global $mosConfig_offset, $database, $option, $Itemid;
    global $mosConfig_absolute_path;
    global $mosConfig_live_site;
    global $cfg;

	$cellcount = count( $rows );
    usort( $rows, 'sortEvents' );

    while( list( $key, $value ) = each( $rows )) {
                $id_Array[]				= $value->id;
                $title_Array[] 			= $value->title;
                // $content_Array[]		= $value->content; // new mic
                $color_Array[] 			= $value->color_bar;
                $publish_up_Array[] 	= $value->publish_up;
                $publish_down_Array[] 	= $value->publish_down;
                $reccurtype_Array[] 	= $value->reccurtype;
                $reccurday_Array[] 		= $value->reccurday;
                $reccurweekdays_Array[] = $value->reccurweekdays;
    }

    $thisday	= $year . '-' . $month . '-' . $day;
    $day_name	= array( _CAL_LANG_SUNDAYSHORT, _CAL_LANG_MONDAYSHORT, _CAL_LANG_TUESDAYSHORT, _CAL_LANG_WEDNESDAYSHORT, _CAL_LANG_THURSDAYSHORT, _CAL_LANG_FRIDAYSHORT, _CAL_LANG_SATURDAYSHORT );
    // $y=date("Y");
    $month_name = EventsHelper::getMonthName( $month );
    if( $month <= '9' & ereg( "(^[1-9]{1})", $month )) {
        $month = '0' . $month;
    }

	mosCommonHTML::loadOverlib();

	//if( _CAL_CONF_TT_SHADOW == 1 ){ // disbled only for test [mic]
        if( !defined( '_LOAD_OVERLIB_SHADOW' )){
            define( '_LOAD_OVERLIB_SHADOW', 1 ); ?>
            <script type="text/javascript" src="<?php echo $mosConfig_live_site; ?>/components/com_events/js/overlib_shadow.js"></script>
            <?php
        }
    //}
    $fieldsetText = "";
	$yearNow = date("Y", time());
	$monthNow = date("m", time());
	$dayNow = intval(date("d", time()));
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
                $startday = $cfg->get("com_startday");
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
                    if( $month == strftime( '%m', time() + ( $mosConfig_offset * 60 * 60 ))
                    && $year == strftime( '%Y', time() + ( $mosConfig_offset * 60 * 60 ))
                    && $d == strftime( '%d', time() + ( $mosConfig_offset * 60 * 60 ))) {
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

                    <td <?php echo $bg;?> width="14%" valign="top">
                    	<a class="cal_daylink" href="<?php echo $link; ?>" title="<?php echo _CAL_LANG_CLICK_TOSWITCH_DAY; ?>"><?php echo $d; ?></a>
                        <?php
                        //PRESENTATION CONSTRUCTION
                        // remarks w [test mic] are new vars prepared for later
                        $cellDate		= mktime (0, 0, 0, $month, $d, $year);
                        $countDisplay	= ''; // test mic

                        if( $cellcount > 0 ){
                            //echo '<table width="100%" cellpadding="0" cellspacing="0" border="0">'; // org mic
                            for( $i = 0; $i < $cellcount; $i++ ){
                            	// checks if event should be displayed
                            	$checkprint = new mosEventRepeat( $rows[$i], $year, $month, $do );

                                // checking here speeds up [mic]
								if( $checkprint->viewable == true ){
									$countDisplay++;

                                    // Event publication infomations
                                    $event_up   = new mosEventDate( $publish_up_Array[$i] );
                                        // $showEventUp[] = $event_up; // test mic
                                    $event_down = new mosEventDate( $publish_down_Array[$i] );
                                        // $showEventDown[] = $event_down; // test mic
                                    // Event repeat variable initiate
                                    $repeat_event_type =  $reccurtype_Array[$i];
                                        // $showRepeatEventType[] = $repeat_event_type; // test mic

                                    // BAR COLOR GENERATION
                                    $bgeventcolor = setColor($rows[$i]);
	                                // $showBGEventColor[] = $bgeventcolor; // test mic

                                    $start_publish  = mktime( 0, 0, 0, $event_up->month, $event_up->day, $event_up->year );
                                        // $showstart_publish[] = $start_publish; // test mic
                                    $stop_publish   = mktime( 0, 0, 0, $event_down->month, $event_down->day, $event_down->year );
                                        // $showStopPublish[] = $stop_publish; // test mic
                                    $event_day      = $event_up->day;
                                        // $showEventDay[] = $event_day; // test mic
                                    $event_month    = $event_up->month;
                                        // $showEventMonth[] = $event_month; // test mic

                                    /*
                                    // mic: moved up for checking earlier
                                    $checkprint     = new mosEventRepeat( $rows[$i], $year, $month, $do );
                                    */

                                    $title          = $title_Array[$i];
                                        // $showTitle[] = $title; // test mic
                                    // $content     = $content_Array[$i]; // new mic - not used now
                                    $id             = $id_Array[$i];
                                        // $showID[] = $id; // test mic

									// moved into events_calender_cell.php [mic]
                                    //$colStart       = '<tr valign="top"><td width="5" style="height:12;" ';
                                    //$colEnd         = '</td></tr><tr><td style="height:1px;"></td></tr>' . "\n";

                                    echo '<div style="width:100%; border:0;">' . "\n";
                                    require( $mosConfig_absolute_path . '/components/' . $option
                                    . '/events_calendar_cell.php' );
                                    echo '</div>' . "\n";
								}
                            }
                            // print all events for this date?  Not going to be pretty for a large # of events!!
                            //  Need to work on this to make it scale better? [ >> done mic ;) ]
                            //echo '</table>' . "\n";
                        } ?>
                    </td>
                    <?php
                    if((( date( 'w', mktime( 0, 0, 0, $month, $d, $year )) - $startday + 1 ) % 7 ) == 0 ){ ?>
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
            <!--<tr>
                <td colspan="7"></td>
            </tr>//-->
        </table>
        <br />
    </fieldset>
    <?php
}

function showEventsByMonth( $year, $month ){
    global $database, $option, $Itemid, $mosConfig_offset, $catid;

    $rows 		= listEventsByMonth( $year, $month, 'publish_up,catid' );
    $num_events = count( $rows );
    $chdate 	= '';
    $chcat 		= '';

    echo '<fieldset><legend class="ev_fieldset">' . _CAL_LANG_EVENTSFOR . '&nbsp;'
    . mosEventsHTML::getDateFormat( $year, $month, '', 3 ) . '</legend><br />' . "\n";
    echo '<table align="center" width="90%" cellspacing="0" cellpadding="5" class="ev_table">' . "\n";

    if( $num_events > 0 ){
        for( $r = 0; $r < $num_events; $r++ ) {
			$row = &$rows[$r];

			$event_up = new mosEventDate( $row->publish_up );
			$event_up->day			= sprintf( '%02d', $event_up->day );
			$event_up->month 		= sprintf( '%02d', $event_up->month );
			$event_up->year 		= sprintf( '%4d', $event_up->year );
			$event_day_month_year 	= $event_up->day . $event_up->month . $event_up->year;
			$event_day_month 		= $event_up->day . $event_up->month;

			$catname 				= mosEventsHTML::getCategoryName( $row->catid );
			$contactlink 			= mosEventsHTML::getUserMailtoLink( $row->id, $row->created_by );

			// skip rows with no current events
			if( $row->reccurtype == 5 & $month != $event_day_month ){
				continue;
			}

            if(( $event_day_month_year <> $chdate ) && $chdate <> '' ){
                echo '</td></tr></table></td>' . "\n";
            }

            if( $event_day_month_year <> $chdate ){
                echo '<tr>';
                if( $event_up->month == strftime( '%m', time() + ( $mosConfig_offset*60*60 ) )
                  && $event_up->year == strftime( '%Y', time() + ( $mosConfig_offset*60*60 ) )
                  && $event_up->day == strftime( '%d', time() + ( $mosConfig_offset*60*60 ) )
                  ) {
                    $bg = ' class="ev_td_today"';
				} else {
					$bg = ' class="ev_td_left"'; //ev_td_left
                }

                echo '<td align="center" valign="top" width="50"' . $bg . '>';
                echo mosEventsHTML::getDateFormat( $event_up->year, $event_up->month, $event_up->day, 4 );
                echo '</td>' . "\n";
                echo '<td align="left" valign="top" class="ev_td_right">' . "\n";
                echo '<table align="center" width="100%" cellspacing="0" cellpadding="0">';
                echo '<tr><td align="center" valign="top" width="80">'; // class='ev_td_left'>";
                $chcat = '';
            }

            if(( $row->catid <> $chcat ) && $chcat <> '' ){
                echo '</td></tr>' . "\n";
            }
            if( $row->catid <> $chcat ){
                echo '<tr><td align="left" valign="top" width="80">'; // class='ev_td_left'
                echo '<b>';

                HTML_events::viewEventCatRow ( $row->catid, $catname, 'view_cat', $event_up->year, $event_up->month, $event_up->day, $option, $Itemid );

                echo '</b>&nbsp;::&nbsp;</td>' . "\n";
				echo '<td align="left" valign="top"><ul class="ev_ul">' . "\n"; // class='ev_td_right'>\n";
            }

            if( $row->reccurtype == 5 ){ //each year
                if( $month == $event_day_month ){
                    HTML_events::viewEventRow ( $row->id, $row->title, 'view_detail', $event_up->year, $event_up->month, $event_up->day, $contactlink, $option, $Itemid );
                } else {
                    echo '&nbsp;';
                }
            } else {
            	HTML_events::viewEventRow ( $row->id, $row->title, 'view_detail', $event_up->year, $event_up->month, $event_up->day, $contactlink, $option, $Itemid );
            }

            $chcat	= $row->catid;
            $chdate = $event_day_month_year;
        }
        echo '</ul></td></tr></table>' . "\n";
    } else {
    	//echo "<tr>";
        //echo "<td align='left' valign='top' class='ev_td_right'>\n";
        echo _CAL_LANG_NO_EVENTFOR . '&nbsp;<b>' . mosEventsHTML::getDateFormat( $year, $month, '', 3 ) . '</b>';
    } // end if

      echo '</td></tr></table><br />' . "\n";
      echo '</fieldset><br /><br />' . "\n";
      //showNavTableText(10, 10, $num_events, 1, $option, 'view_year', $Itemid);
}



?>