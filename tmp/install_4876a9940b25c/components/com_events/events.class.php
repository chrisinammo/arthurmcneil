<?php
/**
 * Events Component for Joomla 1.0.x
 *
 * @version     $Id: events.class.php 897 2007-11-17 15:32:11Z tstahl $
 * @package     Events
 * @copyright   Copyright (C) 2006 JEvents Project Group
 * @copyright   Copyright (C) 2000 - 2003 Eric Lamette, Dave McDonnell
 * @licence     http://www.gnu.org/copyleft/gpl.html
 * @link        http://joomlacode.org/gf/project/jevents
 */

// Thanks to Andrew Eddie for his mosEventDate Class

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

class mosEvents extends mosDBTable {
        var $id 				= null;
        var $sid 				= null;
        var $catid 				= null;
        var $title 				= null;
        var $content 			= null;
        var $contact_info 		= null;
        var $adresse_info 		= null;
        var $extra_info 		= null;
        var $color_bar 			= null;
        var $useCatColor 		= null;
        var $state 				= null;
        var $mask 				= null;
        var $created 			= null;
        var $created_by 		= null;
        var $created_by_alias 	= null;
        var $modified 			= null;
        var $modified_by 		= null;
        var $checked_out 		= null;
        var $checked_out_time 	= null;
        var $publish_up 		= null;
        var $publish_down 		= null;
        var $images 			= null;
        var $reccurtype 		= null;
        var $reccurday 			= null;
        var $reccurweekdays 	= null;
        var $reccurweeks 		= null;
        var $approved 			= null;
        var $ordering 			= null;
        var $archived 			= null;
        var $access 			= null;
        var $hits 				= null;

    function mosEvents( &$db ) {
        $this->mosDBTable( '#__events', 'id', $db );
    }

    // security check
    function bind( $array ) {
		$array['id'] = isset($array['id']) ? intval($array['id']) : 0;
		return 	mosBindArrayToObject($array, $this);

    }
    
    function check() {
        // check for valid name
        if (trim( $this->title ) == '') {
            $this->_error = "Your Events must contain a title.";
            return false;
        }
        return true;
    }

    function hit( $oid=null ) {
        $k = $this->_tbl_key;
        if ($oid !== null) {
            $this->$k = intval( $oid );
        }
        $this->_db->setQuery( "UPDATE #__events SET hits=(hits+1) WHERE id=$this->id" );
        $this->_db->query();
    }
}

class mosEventDate {
        var $year	= null;
        var $month	= null;
        var $day	= null;
        var $hour	= null;
        var $minute	= null;
        var $second	= null;
        var $dim	= null;

    function mosEventDate( $datetime='' ) {
    	if ($datetime!="" && $time = strtotime($datetime)){
    		$this->date = $time;
            $parts = explode(":",date("Y:m:j:G:i:s:t",$this->date));
            
            $this->year   = intval($parts[0]);
            $this->month  = intval($parts[1]);
            $this->day    = intval($parts[2]);
            $this->hour   = intval($parts[3]);
            $this->minute = intval($parts[4]);
            $this->second = intval($parts[5]);
            $this->dim    = intval($parts[6]);
    	}
    	else {
    		$this->date = time();
            $parts = explode(":",date("Y:m:j:G:i:s:t",$this->date ));
            
            $this->year   = intval($parts[0]);
            $this->month  = intval($parts[1]);
            $this->day    = intval($parts[2]);
            $this->hour   = 0;
            $this->minute = 0;
            $this->second = 0;
            $this->dim    = intval($parts[6]);
    		
    	}
    }

    function setDate( $year=0, $month=0, $day=0 ) {
    	$this->date = mktime(0,0,0,$month,$day,$year);
    	$parts = explode(":",date("Y:m:j:G:i:s:t",$this->date));

    	$this->year   = intval($parts[0]);
    	$this->month  = intval($parts[1]);
    	$this->day    = intval($parts[2]);
    	$this->hour   = intval($parts[3]);
    	$this->minute = intval($parts[4]);
    	$this->second = intval($parts[5]);
    	$this->dim    = intval($parts[6]);
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
    	return date("g:ia",$this->date);
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
		;
    	return intval(date("t",mktime(0,0,0,$month,1,$year)));
    }

	/**
    * Adds (+/-) a number of months to the current date.
    * @param int Positive or negative number of months
    */
    function addMonths( $n=0 ) {
    	// correct for months where number of days is shorter than source month)
    	$dim = intval(date("t",mktime(0,0,0,$this->month+$n,1,$this->year)));
    	$this->date = mktime($this->hour,$this->minute,$this->second,$this->month+$n,min($this->day,$dim),$this->year);	
    	$parts = explode(":",date("Y:m:j:G:i:s:t",$this->date));

    	$this->year   = intval($parts[0]);
    	$this->month  = intval($parts[1]);
    	$this->day    = intval($parts[2]);
    	$this->dim    = intval($parts[6]);

    }

    function addDays( $n=0 ) {
    	$this->date = mktime($this->hour,$this->minute,$this->second,$this->month,$this->day+$n,$this->year);	
    	$parts = explode(":",date("Y:m:j:G:i:s:t",$this->date));

    	$this->year   = intval($parts[0]);
    	$this->month  = intval($parts[1]);
    	$this->day    = intval($parts[2]);
    	$this->dim    = intval($parts[6]);
    }

    //function toDays( $day=0, $month=0, $year=0)  is no longer needed

    // function fromDays( $days )  is no longer needed
} // end class

class mosEventsHTML{

    function buildRadioOption( $arr, $tag_name, $tag_attribs, $key, $text, $selected ) {
        $html = ''; //"\n<div name=\"$tag_name\" $tag_attribs>";

        for( $i=0, $n=count( $arr ); $i < $n; $i++ ) {
            $k = $arr[$i]->$key;
            $t = $arr[$i]->$text;

            $sel = '';

            if( is_array( $selected )) {
                foreach( $selected as $obj ) {
                    $k2 = $obj->$key;
                    if( $k == $k2 ) {
                        $sel = ' checked="checked"';
                        break;
                    }
                }
            }else{
            	$sel = ( $k == $selected ? ' checked="checked"' : '' );
            }

            $html .= "\n\t"
            . '<input name="' . $tag_name . '" type="radio" value="' . $k . '" id="' .  $tag_name . $k . '"'
            . $sel . ' '
            . $tag_attribs
            . ' />' . "\n"
            . '<label for="' . $tag_name . $k . '">'
            . $t
            . '</label>'
            . "\n"
            ;
        }
        //$html .= "\n</select>\n";
        return $html;
    }

    function buildReccurDaySelect( $reccurday, $tag_name, $args ) {
        $day_name = array( '<span class="sunday">' . _CAL_LANG_SUNDAYSHORT . '</span>',
                           _CAL_LANG_MONDAYSHORT,
                           _CAL_LANG_TUESDAYSHORT,
                           _CAL_LANG_WEDNESDAYSHORT,
                           _CAL_LANG_THURSDAYSHORT,
                           _CAL_LANG_FRIDAYSHORT,
                          '<span class="saturday">' . _CAL_LANG_SATURDAYSHORT. '</span>');
        $daynamelist[] = mosHTML::makeOption( '-1', '&nbsp;' . _CAL_LANG_BYDAYNUMBER . '<br />' );

        for( $a=0; $a<7; $a++ ){
            $name_of_day	= '&nbsp;' . $day_name[$a]; //getLongDayName($a);
  	    	$daynamelist[]	= mosHTML::makeOption( $a, $name_of_day );
        }

        $tosend = mosEventsHTML::buildRadioOption( $daynamelist, $tag_name, $args, 'value', 'text', $reccurday );
        //mosHTML::selectList
        echo $tosend;
    }

    function buildMonthSelect( $month, $args ){
        for( $a=1; $a<13; $a++ ){
    	    $mnh = $a;
            if( $mnh <= '9' & ereg( "(^[0-9]{1})", $mnh )) {
  	        	$mnh = '0' . $mnh;
  	    	}
            $name_of_month = EventsHelper::getMonthName($mnh);
  	    	$monthslist[] = mosHTML::makeOption( $mnh, $name_of_month );
        }

        $tosend = mosHTML::selectList( $monthslist, 'month', $args, 'value', 'text', $month );
        echo $tosend;
    }

    function buildDaySelect( $year, $month, $day, $args ){
        $nbdays = date( 'd', mktime( 0, 0, 0, ( $month + 1 ), 0, $year ));

        for( $a=1; $a<=$nbdays; $a++ ) { //32
            $dys = $a;
            if( $dys <= '9' & ereg( "(^[1-9]{1})", $dys )) {
                $dys = '0' . $dys;
  	    	}
  	    	$dayslist[] = mosHTML::makeOption( $dys, $dys );
        }

        $tosend = mosHTML::selectList( $dayslist, 'day', $args, 'value', 'text', $day );
        echo $tosend;
    }

    function buildYearSelect( $year, $args ){
        $y = date( 'Y' );

        if( $year < $y-2 ){
            $yearslist[] = mosHTML::makeOption( $year, $year );
        }

        for( $i = $y-2; $i <= $y+5; $i++ ){
            $yearslist[] = mosHTML::makeOption( $i, $i );
        }

        if( $year > $y+5 ){
            $yearslist[] = mosHTML::makeOption( $year, $year );
        }

        $tosend = mosHTML::selectList( $yearslist, 'year', $args, 'value', 'text', $year );
        echo $tosend;
    }

	function buildViewSelect( $viewtype, $args ) {

		$cfg = & EventsConfig::getInstance();

		$viewlist[] = mosHTML::makeOption( 'view_day', 		_CAL_LANG_VIEWBYDAY );
		$viewlist[] = mosHTML::makeOption( 'view_week', 	_CAL_LANG_VIEWBYWEEK );
		$viewlist[] = mosHTML::makeOption( 'view_month', 	_CAL_LANG_VIEWBYMONTH );
		$viewlist[] = mosHTML::makeOption( 'view_year', 	_CAL_LANG_VIEWBYYEAR );

		if ($cfg->get('com_hideshowbycats', 0) == '0') {
			$viewlist[] = mosHTML::makeOption( 'view_cat', _CAL_LANG_VIEWBYCAT );
		}
	
		$viewlist[] = mosHTML::makeOption( 'view_search', 	_CAL_LANG_SEARCH_TITLE );
	
		$tosend = mosHTML::selectList( $viewlist, 'task', $args, 'value', 'text', $viewtype );
		echo $tosend;
	}

    function buildHourSelect( $start, $end, $inc, $tag_name, $tag_attribs, $selected, $format='' ) {

		$cfg = & EventsConfig::getInstance();

	    $start	= intval( $start );
        $end 	= intval( $end );
        $inc 	= intval( $inc );
        $arr 	= array();
        $tmpi 	= '';

        for( $i = $start; $i <= $end; $i += $inc ) {
            if( $cfg->get('com_dateformat') == '1' ) { // US time
                if ($i > 11) {
                    $tmpi = ($i-12) . ' pm';
                } else {
                    $tmpi = $i . ' am';
                }
            }else{
                $tmpi = $format ? sprintf( $format, $i ) : $i;
            }

            $fi 	= $format ? sprintf( $format, $i ) : $i;
            $arr[] 	= mosHTML::makeOption( $fi, $tmpi );
        }

        return mosHTML::selectList( $arr, $tag_name, $tag_attribs, 'value', 'text', $selected );
    }
    /*
function buildHourSelect($hours, $args, $startofend) {
   for($a=0; $a<24; $a++) {
        $hrs = $a;
        if ($hrs<="9"&ereg("(^[0-9]{1})",$hrs)) {
  	    $hrs="0".$hrs;
  	}
  	$hourslist[] = mosHTML::makeOption( $hrs, $hrs );
    }
    $tosend = mosHTML::selectList( $hourslist, 'hours_'.$startofend, $args, 'value', 'text', $hours );
    echo $tosend;
}

function buildMinuteSelect($minutes, $args, $startofend) {
    for($qrtm=0; $qrtm<60; $qrtm=$qrtm+15) {
        if ($qrtm<="9"&ereg("(^[0-9]{1})",$qrtm)) {
  	    $qrtm="0".$qrtm;
  	}
  	$minuteslist[] = mosHTML::makeOption( $qrtm, $qrtm );
    }
    $tosend = mosHTML::selectList( $minuteslist, 'minutes_'.$startofend, $args, 'value', 'text', $minutes );
    echo $tosend;
}
*/

    function buildCategorySelect( $catid, $args ){
        global $database, $gid, $option;

		global $catidList;

        $catsql = "SELECT id as value, name as text"
        . "\n FROM #__categories"
	    . "\n WHERE section='$option'"
	    . "\n AND access<='$gid'"
	    . "\n AND published='1'";

		if (strlen( $catidList) > 0 ) {
			$catsql .=" AND id IN ($catidList)";
		}
		$catsql .=" ORDER BY ordering";

        $categories[] = mosHTML::makeOption( '0', _CAL_LANG_EVENT_CHOOSE_CATEG, 'value', 'text');
        $database->setQuery($catsql);

        $categories = array_merge( $categories, $database->loadObjectList() );

        $clist = mosHTML::selectList( $categories, 'catid', $args, 'value', 'text', $catid );

        echo $clist;
    }

    function buildWeekDaysCheck( $reccurweekdays, $args ){
        $day_name = array( '<span class="sunday">' . _CAL_LANG_SUNDAYSHORT . '</span>',
                           _CAL_LANG_MONDAYSHORT,
                           _CAL_LANG_TUESDAYSHORT,
                           _CAL_LANG_WEDNESDAYSHORT,
                           _CAL_LANG_THURSDAYSHORT,
                           _CAL_LANG_FRIDAYSHORT,
                          '<span class="saturday">' . _CAL_LANG_SATURDAYSHORT. '</span>');
        $tosend = '';

        if( $reccurweekdays == '' ){
            $split 		= array();
            $countsplit = 0;
        }else{
            $split 		= explode( '|', $reccurweekdays );
            $countsplit = count( $split );
        }

        for( $a=0; $a<7; $a++ ){
            $checked = '';
            for( $x = 0; $x < $countsplit; $x++ ){
	        	if( $split[$x] == $a ){
	            	$checked = ' checked="checked"';
	         	}
            }
            $tosend .= '<input type="checkbox" id="cb_wd' . $a . '" name="reccurweekdays[]" value="'
            . $a . '" ' . $args . $checked . ' />&nbsp;' . "\n"
            . '<label for="cb_wd' . $a . '">'
            . $day_name[$a] . '</label>' . "\n"
            ;
        }
        echo $tosend;
    }

    function buildWeeksCheck( $reccurweeks, $args ){
        $week_name = array( '',
                           _CAL_LANG_REP_WEEK . ' 1 ',
                           _CAL_LANG_REP_WEEK . ' 2 ',
                           _CAL_LANG_REP_WEEK . ' 3 ',
                           _CAL_LANG_REP_WEEK . ' 4 ',
                           _CAL_LANG_REP_WEEK . ' 5 '
                           );
        $tosend		= '';
        $checked	= '';

        if( $reccurweeks == '' ){
            $split		= array();
            $countsplit = 0;
        }else{
            $split		= explode( '|', $reccurweeks );
            $countsplit = count( $split );
        }

        for( $a=1; $a<6; $a++ ){
            $checked = '';
            if( $reccurweeks == '' ){
            	$checked = ' checked="checked"';
            }

            for ($x = 0; $x < $countsplit; $x++) {
	        	if ($split[$x] == $a) {
		    		$checked = ' checked="checked"';
	         	}
            }

            $tosend .= '<input type="checkbox" id="cb_wn' . $a . '" name="reccurweeks[]" value="'
            . $a . '" ' . $args . $checked . ' />&nbsp;' . "\n"
            . '<label for="cb_wn' . $a . '">'
            . $week_name[$a] . '</label>' . "\n"
            ;
        }
        echo $tosend;
    }

	function getCategoryName( $catid ){
		global $database, $gid, $option;

		static $arr_catids;

		$catid = intval($catid);

		if (!$arr_catids) {
			$arr_catids = array();
		}
		if (!isset($arr_catids[$catid])) {
			$catsql = "SELECT id, name"
			. "\n FROM #__categories"
			. "\n WHERE id='$catid'"
			;
			$database->setQuery($catsql);
		
			if( $categories = $database->loadObjectList() ) {
				$arr_catids[$catid] = $categories[0]->name;
			} else {
				$arr_catids[$catid] ='';
			}
		}
		return $arr_catids[$catid];
	}

	function getUserMailtoLink( $agid, $userid ){

		global $database;

		static $arr_userids;
		static $arr_agids;

		$cfg = & EventsConfig::getInstance();

		if (!$arr_userids) {
			$arr_userids = array();
		}
		if (!$arr_agids) {
			$arr_agids = array();
		}


		$agenda_viewmail = $cfg->get('com_mailview');

		if( $userid ){
			if (!isset($arr_userids[$userid])) {
				$querym = "SELECT username, email"
				. "\n FROM #__users"
				. "\n WHERE id='$userid'"
				;
				$database->setQuery($querym);
				$userdets = $database->loadObjectList();
	
				$userdet = $userdets[0];
	
				if( $userdet ){
					if( ( $userdet->email ) && ( $agenda_viewmail == '1' )){
							//$contactlink = '<a href="mailto:' . $userdet->email
							//. '" title="' . _CAL_LANG_EMAIL_TO_AUTHOR . '">'
							//. $userdet->username . '</a>';
						$contactlink = mosHTML::emailCloaking($userdet->email, 1, $userdet->username, 0);
					}else{
						$contactlink = $userdet->username;
					}
				}
				$arr_userids[$userid] = $contactlink;
			}
			return $arr_userids[$userid];
        }else{
			if (!isset($arr_agids[$agid])) {
				$querym = "SELECT created_by_alias"
				. "\n FROM #__events"
				. "\n WHERE id='$agid'"
				;
				$database->setQuery($querym);
				$userdet = $database->loadResult();
	
				if( $userdet ){
					$contactlink = $userdet;
				}else{
					$contactlink = _CAL_LANG_ANONYME;
				}
				$arr_agids[$agid] = $contactlink;
			}
			return $arr_agids[$agid];
		}

		return '?';
	}

    /**
	 * returns name of the day longversion
	 * @param	daynb		int		# of day
	 * @param	colored		bool	color sunday	[ new mic, because inside tooltips a color forces an error! ]
	 **/
	function getLongDayName( $daynb, $colored = false ){
	
		if( $daynb == '0' && $colored === true){
			$dayname = '<span class="sunday">' . EventsHelper::getLongDayName($daynb) . '</span>';
		} 
		else if( $daynb == '6' && $colored === true){
			$dayname = '<span class="saturday">' . EventsHelper::getLongDayName($daynb) . '</span>';
		} 
		else {
			$dayname = EventsHelper::getLongDayName($daynb);
		}
	
		return $dayname;
    }

    function getColorBar( $event_id=null, $newcolor ){
        global $database;

		$cfg = & EventsConfig::getInstance();

        if( $event_id != null ){
            $query = "SELECT color_bar"
            . "\n FROM #__events"
            . "\n WHERE id = '$event_id'"
            ;
            $database->setQuery( $query );
            $rows = $database->loadResultList();

            $row = $rows[0];

            if( $newcolor ){
    	        if( $newcolor <> $row->color_bar ){
        	        $query = "UPDATE #__events"
        	        . "\n SET color_bar = '$newcolor'"
        	        . "\n WHERE id = '$event_id'"
        	        ;
        	        $database->setQuery( $query );

        	        return $newcolor;
    	        }
            }else{
                return $row->color_bar;
            }
        }else{
            // dmcd May 20/04  check the new config parameter to see what the default
			// color should be
			switch( $cfg->get('com_defColor')){
				case 'none':
					return '';

				case 'category':
					// fetch the category color for this event?
					// Note this won't work for a new event since
					// the user can change the category on-the-fly
					// in the event entry form.  We need to dump a
					// javascript array of all the category colors
					// into the event form so the color can track the
					// chosen category.
					return '';

				case 'random':
				default:
					$event_id = rand( 1, 50 );
    	    		// BAR COLOR GENERATION
    	    		//$start_publish = mktime (0, 0, 0, date("m"),date("d"),date("Y"));

            		//$colorgenerate = intval(($start_publish/$event_id));
            		//$bg1color = substr($colorgenerate, 5, 1);
            		//$bg2color = substr($colorgenerate, 3, 1);
            		//$bg3color = substr($colorgenerate, 7, 1);
            		$bg1color = rand( 0, 9 );
            		$bg2color = rand( 0, 9 );
            		$bg3color = rand( 0, 9 );
            		$newcolorgen = '#' . $bg1color . 'F' . $bg2color . 'F' . $bg3color . 'F';

            		return $newcolorgen;
            }
        }
    }

    /************** Date format ******************
    *       case "0":
    *            // Fr style : Monday 23 Juillet 2003
    *            // Us style : Monday, Juillet 23 2003
    *       case "1":
    *            // Fr style : 23 Juillet 2003
    *            // Us style : Juillet 23, 2003
    *       case "2":
    *    	 // Fr style : 23 Juillet
    *            // Us style : Juillet, 23
    *       case "3":
    *    	 // Fr style : Juillet 2003
    *            // Us style : Juillet 2003
    *       case "4":
    *            // Fr style : 23/07/2003
    *            // Us style : 07/23/2003
    *       case "5":
    *            // Fr style : 23/07
    *            // Us style : 07/23
    *       case "6":
    *            // Fr style : 07/2003
    *            // Us style : 07/2003
    ********************************************/
    function getDateFormat( $year, $month, $day, $type ){

		$cfg = & EventsConfig::getInstance();

        if( empty( $year )){
        	$year = 0;
        }

        if( empty( $month )){
        	$month = 0;
        }

        if( empty( $day )){
        	$day = 1;
        }

        $format_type	= $cfg->get('com_dateformat');
        $datestp		= ( mktime( 0, 0, 0, $month, $day, $year ));

        switch( $type ){
            case '0':
                if( $format_type == 0 ){
                	return strftime("%A, %d %B %Y",$datestp);
                    // Fr style : Monday 03 Juillet 2003
                }elseif( $format_type == 1 ){
                	return strftime("%A, %B %d %Y",$datestp);
                    // Us style : Monday, July 03 2003
                }else{
                	//return strftime("%A, %e. %B %Y",$datestp);
					// %e not supported by windows
					return sprintf(strftime("%A, %%s. %B %Y",$datestp), intval(strftime('%d', $datestp)));
                    // De style : Montag, 3. Juli 2003
                }
                break;

    	    case '1':
                if( $format_type == 0 ){
                	return strftime("%d %B %Y",$datestp);
                    // Fr style : 23 Juillet 2003
                }elseif( $format_type == 1 ){
                	return strftime("%B %d %Y",$datestp);
                    // Us style : July 23, 2003
                }else{
                	return strftime("%d. %B %Y",$datestp);
                    // De style : 23. Juli 2003
                }
            	break;

            case '2':
                if( $format_type == 0 ){
                	return strftime("%d %B",$datestp);
                    // Fr style : 23 Juillet
                }elseif( $format_type == 1 ){
                	return strftime("%B %d",$datestp);
                    // Us style : Juillet 23
                }else{
                	return strftime("%d. %B",$datestp);
                    // De style : 23. Juli
                }
                break;

            case '3':
                if( $format_type == 0 ){
                	return strftime("%B %Y",$datestp);
                    // Fr style : Juillet 2003
                }elseif( $format_type == 1 ){
                	return strftime("%B %Y",$datestp);
                    // Us style : Juillet 2003
                }else{
                	return strftime("%B %Y",$datestp);
                    // De style : Juli 2003
                }
                break;

    	    case '4':
                if( $format_type == 0 ){
                	return strftime("%d/%B/%Y",$datestp);
                    // Fr style : 23/07/2003
                }elseif( $format_type == 1){
                	return strftime("%B/%d/%Y",$datestp);
                    // Us style : 07/23/2003
                }else{
                	return strftime("%d.%B.%Y",$datestp);
                    // De style : 23.07.2003
                }
                break;

            case '5':
                if( $format_type == 0 ){
                	return strftime("%d/%m",$datestp);
                    // Fr style : 23/07
                }elseif( $format_type == 1 ){
                	return strftime("%m/%d",$datestp);
                    // Us style : 07/23
                }else{
                	return strftime("%d.%m.",$datestp);
                    // De style : 23.07.
                }
                break;

            case '6':
                if( $format_type == 0 ){
                	return strftime("%m/%Y",$datestp);
                    // Fr style : 07/2003
                }elseif( $format_type == 1 ){
                	return strftime("%m/%Y",$datestp);
                    // Us style : 07/2003
                }else{
                	return strftime("%m/%Y",$datestp);
                    // De style : 07/2003
                }
            break;

			case '7':
                if( $format_type == 0 ){
                	return strftime("%A, %d",$datestp);
                    // Fr style : Monday 23
                }elseif( $format_type == 1 ){
                	return strftime("%A, %d",$datestp);
                    // Us style : Monday, 23
                }else{
                	return strftime("%A, %d.",$datestp);
                    // De style : Montag, 23.
                }
                break;

            default:
            break;
        }
        return $newdate;
    }
}





?>