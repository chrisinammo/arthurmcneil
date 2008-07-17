<?php

// no direct access
defined( '_VALID_MOS' ) or die( 'Restricted access' );

class mosEventDateOLD {
        var $year	= null;
        var $month	= null;
        var $day	= null;
        var $hour	= null;
        var $minute	= null;
        var $second	= null;

    function mosEventDate( $datetime='' ) {
        if (ereg("([0-9]{4})-([0-9]{2})-([0-9]{2})[ ]([0-9]{2}):([0-9]{2}):([0-9]{2})",$datetime,$regs)) {
            $this->setDate( $regs[1], $regs[2], $regs[3] );
            $this->hour   = intval( $regs[4] );
            $this->minute = intval( $regs[5] );
            $this->second = intval( $regs[6] );

            $this->month = max( 1, $this->month );
            $this->month = min( 12, $this->month );

            $this->day = max( 1, $this->day );
            $this->day = min( $this->daysInMonth(), $this->day );
		} else {
            //$now = date( "Y-m-d H:i:s", time()+$mosConfig_offset*60*60 );
            $this->setDate( date( 'Y' ), date( 'm' ), date( 'd' ) );
            $this->hour   = 0;
            $this->minute = 0;
            $this->second = 0;
        }
    }

    function setDate( $year=0, $month=0, $day=0 ) {
        $this->year		= intval( $year );
        $this->month	= intval( $month );
        $this->day		= intval( $day );

        $this->month	= max( 1, $this->month );
        $this->month	= min( 12, $this->month );

        $this->day		= max( 1, $this->day );
        $this->day		= min( $this->daysInMonth(), $this->day );
        }

    function getYear( $asString=false ) {
		return $asString ? sprintf( '%04d', $this->year ) : $this->year;
    }

    function getMonth( $asString=false ) {
		return $asString ? sprintf( '%02d', $this->month ) : $this->month;
    }

    function getDay( $asString=false ) {
		return $asString ? sprintf( '%02d', $this->day ) : $this->day;
    }

    function get12hrTime( ){
    	$hour = $this->hour;

		if( $hour > 12 ){
			$hour -= 12;
		}elseif( $hour == 0 ){
			$hour = 12;
		}

		$time = sprintf( '%d:%02d', $hour, $this->minute );
		return( $this->hour >= 12 ) ? $time . 'pm' : $time . 'am';
    }

    function get24hrTime( ){
		return sprintf( '%02d:%02d', $this->hour, $this->minute);
    }

    function toDateURL() {
		return( 'year=' . $this->getYear( 1 )
		. '&amp;month=' . $this->getMonth( 1 )
		. '&amp;day=' . $this->getDay( 1 )
		);
    }

    /**
    * Utility function for calculating the days in the month
    *
    * If no parameters are supplied then it uses the current date
    * if 'this' object does not exist
    * @param int The month
    * @param int The year
    */
    function daysInMonth( $month=0, $year=0 ) {
        $month	= intval( $month );
        $year	= intval( $year );

        if ( !$month ){
            if( isset( $this )) {
                $month = $this->month;
            } else {
                $month = date( 'm' );
            }
        }

        if( !$year ){
            if( isset( $this )) {
                $year = $this->year;
            }else{
                $year = date( 'Y' );
            }
        }
        if( $month == 2 ){
            if(( $year % 4 == 0 && $year % 100 != 0 ) || $year % 400 == 0 ) {
                return 29;
            }
            return 28;
        }elseif( $month == 4 || $month == 6 || $month == 9 || $month == 11 ) {
            return 30;
        }
        return 31;
    }

	/**
    * Adds (+/-) a number of months to the current date.
    * @param int Positive or negative number of months
    * @author Andrew Eddie <eddieajau@users.sourceforge.net>
    */
    function addMonths( $n=0 ) {
        $an		= abs( $n );
        $years	= floor( $an / 12 );
        $months = $an % 12;

        if( $n < 0 ) {
            $this->year -= $years;
            $this->month -= $months;
            if( $this->month < 1 ) {
                $this->year--;
            $this->month = 12 - $this->month;
            }
        } else {
            $this->year += $years;
            $this->month += $months;
            if( $this->month > 12 ) {
                $this->year++;
                $this->month -= 12;
            }
        }
    }

    function addDays( $n=0 ) {
        $days = $this->toDays();
		$this->fromDays( $days + $n );
    }

    /**
    * Converts a date to number of days since a
    * distant unspecified epoch.
    *
    * !!Based on PEAR library function!!
    * @param string year in format CCYY
    * @param string month in format MM
    * @param string day in format DD
    * @return integer number of days
    */
    function toDays( $day=0, $month=0, $year=0) {
        if (!$day) {
            if (isset( $this )) {
                $day = $this->day;
            } else {
                $day = date( 'd' );
            }
        }
        if (!$month) {
            if (isset( $this )) {
                $month = $this->month;
            } else {
                $month = date( 'm' );
            }
        }
        if (!$year) {
            if (isset( $this )) {
                $year = $this->year;
            } else {
                $year = date( 'Y' );
            }
        }

		$century	= floor( $year / 100 );
        $year		= $year % 100;

        if( $month > 2 ) {
            $month -= 3;
        } else {
            $month += 9;
            if( $year ) {
                $year--;
            } else {
                $year = 99;
                $century --;
            }
        }

        return ( floor( (146097 * $century) / 4 ) +
            floor( (1461 * $year) / 4 ) +
            floor( (153 * $month + 2) / 5 ) +
            $day + 1721119)
        ;
    }

    /**
    * Converts number of days to a distant unspecified epoch.
    *
    * !!Based on PEAR library function!!
    * @param int number of days
    * @param string format for returned date
    */
    function fromDays( $days ) {
        $days		-=	1721119;
        $century	=	floor( ( 4 * $days - 1) /  146097 );
        $days		=	floor( 4 * $days - 1 - 146097 * $century );
        $day		=	floor( $days /  4 );

        $year		=	floor( ( 4 * $day +  3) /  1461 );
        $day		=	floor( 4 * $day +  3 -  1461 * $year );
        $day		=	floor( ($day +  4) /  4 );

        $month		=	floor( ( 5 * $day -  3) /  153 );
        $day		=	floor( 5 * $day -  3 -  153 * $month );
        $day		=	floor( ($day +  5) /  5 );

        if( $month < 10 ) {
            $month +=3;
        } else {
            $month -=9;
            if ($year++ == 99) {
                $year = 0;
                $century++;
            }
        }

	    $this->day = $day;
        $this->month = $month;
        $this->year = $century*100 + $year;
    } // end func daysToDate
} // end class


function xxxmosEventRepeatArray( $row=null, $year=null, $month=null, $day=null) {
	// builds and returns array
	$eventDays = array();

	if( is_null( $row ) || is_null($year) || is_null( $month)) return $eventDays;
	if ($day!=null) {
		echo "hello";
	}

	$monthStartDate = mktime( 0,0,0, $month, 1, $year );
	$daysInMonth = intval(date("t",$monthStartDate ));
	$monthEndDate = mktime( 0,0,0, $month, $daysInMonth , $year );
	$monthEndSecond = mktime( 23,59,59, $month, $daysInMonth , $year );

	// double check the SQL has given us valid events
	$event_start_date = mktime( 0,0,0,  $row->mup, $row->dup, $row->yup );
	$event_end_date = mktime( 0,0,0,  $row->mdn, $row->ddn, $row->ydn );
	if ($event_end_date<$monthStartDate || $event_start_date>$monthEndSecond) return  $eventDays;

	$repeatingEvent = false;
	if ($row->reccurtype!=0 || $row->reccurday!="" || $row->reccurweekdays!="" || $row->reccurweeks!=""){
		$repeatingEvent = true;
	}

	$multiDayEvent = false;
	if ($row->dup!=$row->ddn) {
		$multiDayEvent = true;
	}


	if (!$repeatingEvent) {
		if (!$multiDayEvent) {
			// single day so populate the array and get on with things!
			$eventDays[$event_start_date]=true;
			return $eventDays;
		}
		else {
			// otherwise a multiday event

			// Find the first and last relevant days
			if ($monthStartDate>$event_start_date) $firstDay = 1;
			else $firstDay = intval(date("j",$event_start_date));

			if ($event_end_date>$monthEndDate) $lastDay = $daysInMonth;
			else $lastDay = intval(date("j",$event_end_date));

			for ($d=$firstDay;$d<=$lastDay;$d++) {
				$eventDate = mktime( 0,0,0, $month , $d, $year);
				$eventDays[$eventDate]=true;
			}
			return $eventDays;
		}
	}

	// All I'm left with are the repeated events
	/*
	for ($d=1;$d<=$daysInMonth;$d++){
	$date = mktime( 0,0,0, $month, $d, $year );
	$mER = new mosEventRepeat($row,$year,$month,$d);
	if ($mER->viewable) $eventDays[$date]=true;
	}
	return $eventDays;
	*/

	//echo "row->reccurtype = $row->reccurtype $row->id<br/><br/>CHECK IT OUT - type 2 needs more work!!!<br/><hr/>";

	switch( $row->reccurtype) {
		case 0: // All days
		$this->viewable = true;
		return $this->viewable;
		break;

		case 1: // By week - 1* by week
		case 2: // By week - n* by week

		// This is multi-days per week
		if ($row->reccurweekdays != ""){
			$reccurweekdays	= explode( '|', $row->reccurweekdays );
			$countdays		= count( $reccurweekdays );
		}
		// This is once a week
		else if ($row->reccurday!="") {
			$reccurweekdays   = array();
			$reccurweekdays[] = intval($row->reccurday);
			$countdays		  = count( $reccurweekdays );
		}
		else {
			echo "Should not really be here <br/>";
		}

		if (strpos($row->reccurweeks,"pair")===false) {
			$repeatweeks	= explode( '|', $row->reccurweeks );
		}
		else $repeatweeks = array();

		for ($i=0;$i<count($reccurweekdays);$i++){
			// This is first, second week etc of the months
			if (count($repeatweeks)>0){
				$daynum_of_first_in_month = intval(date( 'w', mktime( 0, 0, 0, $month, 1, $year )));
				$adjustment = 1 + (7+$reccurweekdays[$i]-$daynum_of_first_in_month)%7;
				// Now find repeat weeks for the month
				foreach ($repeatweeks as $weeknum) {
					// first $reccurweekdays[$i] in the month is therefore
					$next_recurweekday = ($adjustment + ($weeknum-1)*7);
					$nextDate = mktime( 0, 0, 0, $month, $next_recurweekday, $year );
					if ($nextDate>=$event_start_date && $nextDate<=$event_end_date)    $eventDays[$nextDate]=true;
				}
			}
			else {
				// find corrected start date
				$weekday_of_startdate = date( 'w', $event_start_date);
				$true_start_date_for_sequence = (6+$reccurweekdays[$i]-$weekday_of_startdate)%7; //???

				list($event_start_day, $event_start_month, $event_start_year) = explode(":",date("d:m:Y",$event_start_date));

				$temp = $event_start_day + $reccurweekdays[$i] - $weekday_of_startdate;

				$sequence_start_date = mktime( 0, 0, 0, $event_start_month, $temp, $event_start_year);
				//echo "event start data : ".date("d:m:Y",$event_start_date)."<br/>";
				//echo "adj sequence_start_date: ".date("d:m:Y",$sequence_start_date)."<br/>";
				//echo "month start data : ".date("d:m:Y",$monthStartDate)."<br/>";
				if ($row->reccurweeks=="pair"){
					// every 2 weeks
					// first of month day difference
					// 60*60*24 = 86400
					// 86400*14 = 1209600
					$delta = (1209600+$sequence_start_date-$monthStartDate )%1209600;
					$deltadays = $delta/86400;

					for ($weeks=0;$weeks<6;$weeks++){
						$nextDate = mktime(0,0,0,$month, $weekday_of_startdate + $deltadays+ (14*$weeks), $year);
						if ($nextDate<=$monthEndDate) $eventDays[$nextDate]=true;
						else break;
					}

				}
				else if ($row->reccurweeks=="impair"){
					// every 3 weeks
					// every 2 weeks
					// first of month day difference
					// 60*60*24 = 86400
					// 86400*21 = 1814400
					$delta = (1814400+$sequence_start_date-$monthStartDate )%1814400;
					$deltadays = $delta/86400;

					for ($weeks=0;$weeks<6;$weeks++){
						$nextDate = mktime(0,0,0,$month, $weekday_of_startdate + $deltadays+ (21*$weeks), $year);
						if ($nextDate<=$monthEndDate) $eventDays[$nextDate]=true;
						else break;
					}

				}
			}

		}
		return $eventDays;

		break;

		case 3: // By month - 1* by month
		if( $row->reccurday ==-1 ) { //by day number

			list($event_start_day, $event_start_month, $event_start_year) = explode(":",date("d:m:Y",$event_start_date));
			$nextDate = mktime(0,0,0,$month, $event_start_day, $year);
			$eventDays[$nextDate]=true;
		}
		else { //by day name following the day number

			list($event_start_day, $event_start_month, $event_start_year) = explode(":",date("d:m:Y",$event_start_date));
			$equiv_day_of_month = mktime( 0, 0, 0, $month, $event_start_day, $year);
			$weekday_of_equivalent = date( 'w', $equiv_day_of_month);
			$temp = $event_start_day + $row->reccurday - $weekday_of_equivalent;

			$nextDate = mktime( 0, 0, 0, $month, $temp, $year);
			$eventDays[$nextDate]=true;
		}
		return $eventDays;
		break;

		case 4: // By month - end of the month
		$eventDays[$monthEndDate ]=true;
		return $eventDays;

		break;

		case 5: // By year - 1* by year
		list($event_start_day, $event_start_month, $event_start_year) = explode(":",date("d:m:Y",$event_start_date));
		if ($month == $event_start_month){
			if( $row->reccurday ==-1 ) { //by day number

				$nextDate = mktime(0,0,0,$month, $event_start_day, $year);
				$eventDays[$nextDate]=true;
			}
			else { //by day name following the day number

				list($event_start_day, $event_start_month, $event_start_year) = explode(":",date("d:m:Y",$event_start_date));
				$equiv_day_of_month = mktime( 0, 0, 0, $month, $event_start_day, $year);
				$weekday_of_equivalent = date( 'w', $equiv_day_of_month);
				$temp = $event_start_day + $row->reccurday - $weekday_of_equivalent;

				$nextDate = mktime( 0, 0, 0, $month, $temp, $year);
				$eventDays[$nextDate]=true;
			}
		}
		return $eventDays;
		break;

		default:
			return $eventDays;
			break;
	}

}


// class mosEventRepeat should be in the attic

class mosEventRepeat {
	var $row		= null;
	var $year		= null;
	var $month		= null;
	var $day		= null;
	var $viewable	= null;
	//function added by Christopher L. Coker (chris.coker@alumni.clemson.edu) 14-MAR-05 to fix bug with recurring events
	function dayInterval( $date1, $date2 ) {
		$day_interval = 0;
		//if(date("L", $date1)) $day_interval += 1;

		$year = date( 'Y', $date1);

		for( $i = 0; $year < date( 'Y', $date2 ); ) {
  			$year = date( 'Y', mktime( 0, 0, 0, 1, 1, date( 'Y', $date1 ) + ++$i ) );
 	 		$day_interval += 365;

			if( date( 'L', mktime( 0, 0, 0, 1, 1, $year-1 ))){
				$day_interval += 1;
			}
		}
    	return $day_interval;
	}

	function trivialEvent(){
		// just a counting function for the profiler!

	}

	function mosEventRepeat( $row=null, $year=null, $month=null, $day=null ) {
		$cfg = & EventsConfig::getInstance();
    	if( is_null( $row )){
    		return false;
    	}

    	$repeatingEvent = false;
    	if ($row->reccurtype==true || $row->reccurday!="" || $row->reccurweekdays!="" || $row->reccurweeks!=""){
    		$repeatingEvent = true;
    	}
    	
    	$multiDayEvent = false;
	if (isset($row->yup )){
    	if ($row->dup!=$row->ddn) {
    		$multiDayEvent = true;
    	}
	}	
if (isset($row->yup )){
		if (!$repeatingEvent) {
			$this->trivialEvent();
			$test_date = mktime( 0,0,0, $month, $day, $year );
			$start_date = mktime( 0,0,0,  $row->mup, $row->dup, $row->yup );
			if ($test_date < $start_date){
                $this->viewable = false;
                return $this->viewable;
			}
			$end_date = mktime( 0,0,0,  $row->mdn, $row->ddn, $row->ydn );
			if ($test_date > $end_date) {
                $this->viewable =false;
                return $this->viewable;
			}
            $this->viewable = true;
            return $this->viewable;
		}
}
		
		$select_date	= sprintf( '%4d-%02d-%02d', $year, $month, $day );
        $numero_du_jour = date( 'w', mktime( 0,0,0, $month, $day, $year ));
        if( $numero_du_jour == 0 ){
			//	asdbg_break();
		}

if (isset($row->yup)){
        $start_publish			= sprintf( '%4d-%02d-%02d', $row->yup, $row->mup, $row->dup);
        $stop_publish			= sprintf( '%4d-%02d-%02d', $row->ydn, $row->mdn, $row->ddn );

        
        $start_hours			= $row->hup;
        $start_minutes			= $row->minup;
        $event_day				= $row->dup;
        $event_month			= $row->mup;
        $event_year				= $row->yup;

        $end_hours				= $row->hup;
        $end_minutes			= $row->minup;
}
else {
		$event_up				= new mosEventDate( $row->publish_up );
        $start_publish			= sprintf( '%4d-%02d-%02d', $event_up->year, $event_up->month, $event_up->day );
        $start_hours			= $event_up->hour;
        $start_minutes			= $event_up->minute;
        $event_day				= $event_up->day;
        $event_month			= $event_up->month;
        $event_year				= $event_up->year;

        $event_down				= new mosEventDate( $row->publish_down );
        $stop_publish			= sprintf( '%4d-%02d-%02d', $event_down->year, $event_down->month, $event_down->day );
        $end_hours				= $event_down->hour;
        $end_minutes			= $event_down->minute;
	
}


		$end_of_month	= date( 't', mktime( 0, 0, 0, ( $month + 1 ), 0, $year ));


        $repeat_event_type		= $row->reccurtype;
        $repeat_event_day		= $row->reccurday;
        $repeat_event_weekdays	= $row->reccurweekdays;
        $repeat_event_weeks		= $row->reccurweeks;

        $this->viewable			= false;
        $is_the_event_period	= false;
        $is_the_event_day		= false;
        $is_the_event_daynumber = false;
        $is_the_event_dayname	= false;

        // Week begin day and finish day
        $startday				= $cfg->get("com_startday");
        $numday					= (( date( 'w', mktime( 0, 0, 0, $month, $day, $year )) -$startday ) %7 );

        if( $numday == -1 ){
           $numday = 6;
        }


if (isset($row->yup)){
        $week_start				= mktime ( 0, 0, 0, $month, ( $day - $numday ), $year );

        $start_weekday			= intval(date("j",$week_start));
        $end_weekday			= intval(date("j", mktime ( 0, 0, 0, $month, ( $day - $numday +6 ), $year )));
}
else {
        $week_start				= mktime ( 0, 0, 0, $month, ( $day - $numday ), $year );

        $this_week_date			= new mosEventDate();
        $this_week_date->setDate( date ( 'Y', $week_start ),date ( 'm', $week_start ),date ( 'd', $week_start ));	

        // THIS NEEDS CLONE FOR PHP 5!!!
        $this_week_end_date		= clone ($this_week_date);
        $this_week_end_date->addDays( +6 );

        $start_weekday 			= $this_week_date->day;
        $end_weekday			= $this_week_end_date->day;
}
         /* Weeks check process */
         $is_week_1				= false;
         $is_week_2 			= false;
         $is_week_3 			= false;
         $is_week_4 			= false;
         $is_week_5 			= false;

         // dmcd oct 4th.  This is really screwed up and non-intuitive.  Changing the 'week of the month'
         // to reflect the true week of the month according to the defined start day of a week.  The first
         // week of a month may be a partial week, as well as the last week. If someone schedules an event
         // to happen the 'first Saturday of every month', then that should be relfected properly here.

         // By 7 to 7 periode
         if( ( intval( $day ) <= 7 ) ) {
          	$is_week_1 = true;
         }elseif( (intval( $day ) > 7 ) && ( intval( $day ) <= 14 ) ) {
         	$is_week_2 = true;
         }elseif( ( intval( $day ) > 14 ) && ( intval( $day ) <= 21 ) ) {
             $is_week_3 = true;
         }elseif( ( intval( $day ) > 21 ) && ( intval( $day ) <= 28 ) ) {
         	$is_week_4 = true;
         }elseif( ( intval( $day ) >= 28 ) ) {
         	$is_week_5 = true;
         }

         /*
          // By week
          if ( (intval($day) <= 7) ) {
             $is_week_1 = true;
          } elseif ( (intval($end_weekday) > 7) && (intval($end_weekday) <= 14) ) {
             $is_week_2 = true;
          } elseif ( (intval($end_weekday) > 14) && (intval($end_weekday) <= 21) ) {
             $is_week_3 = true;
          } elseif ( (intval($end_weekday) > 21) && (intval($end_weekday) <= 28) ) {
             $is_week_4 = true;
          } elseif ( (intval($end_weekday) >= 28) ) {
             $is_week_5 = true;
          }
          */

        // Check event time parametres
        if(( $select_date <= $stop_publish ) && ( $select_date >= $start_publish )) {
            $is_the_event_period = true;
        }

        if( $event_day == $day ){
            $is_the_event_day = true;
        }

        if( $numero_du_jour == $repeat_event_day ) {
            $is_the_event_dayname = true;
        }

        $viewable_day = 0;

        if( $repeat_event_weekdays <> '' ) {
            $reccurweekdays	= explode( '|', $repeat_event_weekdays );
	    	$countdays		= count( $reccurweekdays );

	    	for( $x=0; $x < $countdays; $x++ ){
                if( $reccurweekdays[$x] == $numero_du_jour ) {
                	$viewable_day = 1;
                }
            }
        }

        // Check event weeks parametres
        $pair_weeks		= 0;
        $impair_weeks	= 0;
        $viewable_week	= 0;

        if( $repeat_event_weeks <> '' ) {
            $reccurweeks	= explode( '|', $repeat_event_weeks );
            $countweeks		= count( $reccurweeks );

            for( $x=0; $x < $countweeks; $x++ ){
            	if( $reccurweeks[$x] == 'pair' ) {
                    $pair_weeks = 1;
                }elseif( $reccurweeks[$x] == 'impair' ) {
                    $impair_weeks = 1;
                }

                if(( $reccurweeks[$x] == 1 ) && ( $is_week_1 )) {
                    $viewable_week = 1;
                }elseif(( $reccurweeks[$x] == 2 ) && ( $is_week_2 )) {
                    $viewable_week = 1;
                }elseif(( $reccurweeks[$x] == 3 ) && ( $is_week_3 )) {
                    $viewable_week = 1;
                }elseif(( $reccurweeks[$x] == 4 ) && ( $is_week_4 )) {
                    $viewable_week = 1;
                }elseif(( $reccurweeks[$x] == 5 ) && ( $is_week_5 )) {
                    $viewable_week = 1;
                }
            }
        } else {
            $viewable_week = 1;
        }

        // Check repeat
        if( $is_the_event_period ){
            switch( $repeat_event_type ) {
                case 0: // All days
                    $this->viewable = true;
                    return $this->viewable;
                break;

                case 1: // By week - 1* by week
				    //added by Christopher L. Coker (chris.coker@alumni.clemson.edu) 14-MAR-05 to fix bug with recurring events
					if( $repeat_event_day == -1 ) {
						$temp = $event_day;
					} else {
						$temp = $event_day + $repeat_event_day-date( 'w', mktime( 0, 0, 0, $event_month, $event_day, $event_year ));
						if( $temp < $event_day ){
							$temp += 7;
						}
					}

					$event_start_date	= mktime( 0, 0, 0, $event_month, $temp, $event_year );
					$cell_date			= mktime( 0, 0, 0, $month, $day, $year );

					if(( $pair_weeks && is_integer(( date( 'z', $cell_date ) + $this->dayInterval( $event_start_date, $cell_date) - date( 'z', $event_start_date )) / 14 ))
					   || ( $impair_weeks && is_integer(( date( 'z', $cell_date) + $this->dayInterval( $event_start_date, $cell_date ) - date( 'z', $event_start_date )) / 21 ))
					   || ( $viewable_week )) {
						if( $repeat_event_day >= 0 ) {
							if( $is_the_event_dayname ) {
	                        	$this->viewable = true;
	                    	}
						}else{
							if (date( 'w', mktime( 0, 0, 0, $event_month, $event_day, $event_year )) ==
								date( 'w', mktime( 0, 0, 0, $month, $day, $year ))) {
								$this->viewable = true;
							}
						}
					}

					return $this->viewable;
					//end bug fix by Chris Coker

                    /*original code
					if (  ($pair_weeks && is_integer($day/2))
                       	  || ($impair_weeks && !is_integer($day/2))
                          || ($viewable_week) // && ($numero_du_jour <= 6))
                       ) {
	                	if ($repeat_event_day ==-1 ) { //by day number
                    		if ($is_the_event_day
                         		|| (($select_date >= $start_publish) && is_integer(($day - $event_day)/7))) {
                                	$this->viewable = true;
	                    	}
                    	 } elseif ($repeat_event_day >=0 ) { //by day name
	                 		if ($is_the_event_dayname) {
	                        	$this->viewable = true;
	                    	}
	                 	}
	            	}
                    return $this->viewable;
					end original code*/
                break;

    	        case 2: // By week - n* by week
					//added by Christopher L. Coker (chris.coker@alumni.clemson.edu) 15-MAR-05 to fix bug with recurring events
					$temp = $event_day + $reccurweekdays[0] - date( 'w', mktime( 0, 0, 0, $event_month, $event_day, $event_year ));

					/* ########### what for is this loop ?? [mic] */
					foreach( $reccurweekdays as $week_day ) {
						if( date( 'w', mktime( 0, 0, 0, $month, $day, $year )) == $week_day) {

						}
					}

					$event_start_date	= mktime( 0, 0, 0, $event_month, $temp, $event_year );
					$cell_date			= mktime( 0, 0, 0, $month, $day, $year );


					if( ( $pair_weeks && fmod( date( 'z', $cell_date ) + $this->dayInterval( $event_start_date, $cell_date ) - date( 'z', $event_start_date), 14) < 7)
						|| ( $impair_weeks && fmod( date( 'z', $cell_date ) + $this->dayInterval( $event_start_date, $cell_date ) - date( 'z', $event_start_date ), 21) < 7)
						|| ( $viewable_week )) {
						if( $repeat_event_weekdays <> '' ) { //by day select
	                    	if( $viewable_day ) {
	                        	$this->viewable = true;
	                    	}
	                	}
					}
					if( fmod( date( 'z', $cell_date ) + $this->dayInterval( $event_start_date, $cell_date ) - date( 'z', $event_start_date ), 7 ) < 0 ) {
						$this->viewable = false;
					}

					return $this->viewable;
					//end bug fix by Chris Coker


                    /*original code*/
					/*if (($pair_weeks && is_integer($day/2))
                          || ($impair_weeks && !is_integer($day/2))
                          || ($viewable_week) || ($occurs) // && ($numero_du_jour <= 6)))
						 ) {
                    	if ($repeat_event_weekdays <> "") { //by day select
	                    	if ($viewable_day) {
	                        	$this->viewable = true;
	                    	}
	                	}
                    }
                    return $this->viewable;*/
					/*end original code*/
                break;

    	        case 3: // By month - 1* by month
                    if( $repeat_event_day ==-1 ) { //by day number
						if( $is_the_event_day ) {
							$this->viewable = true;
						}
					} elseif ( $repeat_event_day >=0 ) { //by day name
						if ( $is_the_event_dayname
							&& ( $day >= $event_day ) && ( $day <= $event_day + 6 )) { 
							$this->viewable = true;
						}
					}
                    return $this->viewable;
                break;

                case 4: // By month - end of the month
                    if( $day == $end_of_month ) {
	                $this->viewable = true;
	            }
                    return $this->viewable;
                break;

                case 5: // By year - 1* by year
                    if( $repeat_event_day ==-1 ) { //by day number
	                	if( $is_the_event_day && ( $month == $event_month )) {
	                    	$this->viewable = true;
	               	 	}
	            	}elseif( $repeat_event_day >=0 ) { //by day name
	                	if( $is_the_event_dayname
	                      && (( $day >= $event_day ) && ( $day <= $event_day + 6 ))
	                      && ( $month == $event_month )) {
	                    	$this->viewable = true;
	                	}
	            	}
                    return $this->viewable;
                break;

                default:
                    return $this->viewable;
                break;
            }
        } else {
            return $this->viewable;
        } // end if
    }
}

?>