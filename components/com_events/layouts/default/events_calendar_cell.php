<?php
/**
 * Events Component for Joomla 1.5.x
 *
 * @version     $Id: events_calendar_cell.php 978 2008-02-16 15:29:27Z tstahl $
 * @package     Events
 * @copyright   Copyright (C) 2006-2007 JEvents Project Group
 * @copyright   Copyright (C) 2003 Eric Lamette
 * @licence     http://www.gnu.org/copyleft/gpl.html
 * @link        http://joomlacode.org/gf/project/jevents
 */

defined('_JEXEC') or die( 'Direct Access to this location is not allowed.' );

class EventCalendarCell_default {
	var $_datamodel = null;
	
	function EventCalendarCell_default($event, $datamodel){
		$cfg = & EventsConfig::getInstance();
		$this->event = $event;
		$this->_datamodel = $datamodel;

		$this->start_publish  = $this->event->getUnixStartDate();
		$this->stop_publish  = $this->event->getUnixEndDate();
		$this->title          = $this->event->title();

		// On mouse over date formats
		// Note that the date formats for the events can be easily changed by modifying the sprintf formatting
		// string below.  These are used for the default overlay window.  As well, the strftime() function could
		// also be used instead to provide more powerful date formatting which supports locales if php function
		// set_locale() is being used.

		$this->start_date	= mosEventsHTML::getDateFormat( $this->event->yup(), $this->event->mup(), $this->event->dup(), 0 );
		$this->start_time = ( $cfg->get('com_calUseStdTime') == '1' ) ? date("g:ia",$this->event->getUnixStartTime()) : sprintf( '%02d:%02d', $this->event->hup(),$this->event->minup());

		$this->stop_date	= mosEventsHTML::getDateFormat(  $this->event->ydn(), $this->event->mdn(), $this->event->ddn(), 0 );
		$this->stop_time	= ( $cfg->get('com_calUseStdTime') == '1' ) ? date("g:ia",$this->event->getUnixEndTime()) : sprintf( '%02d:%02d', $this->event->hdn(),$this->event->mindn());
	}

	function xxcalendarCell_popupOLD($cellDate){
		$cfg = & EventsConfig::getInstance();

		$publish_inform_title 	= addslashes( htmlspecialchars( $this->title ));
		$publish_inform_overlay	= '';
		$cellString="";
		// The one overlay popup window defined for multi-day events.  Any number of different overlay windows
		// can be defined here and used according to the event's repeat type, length, whatever.  Note that the
		// definition of the overlib function call arguments is ( html_window_contents, extra optional paramenters ... )
		// 'extra parameters' includes things like window positioning, display delays, window caption, etc.
		// Documentation on the javascript overlib library can be found at: http://www.bosrup.com/web/overlib/
		// or here for additional plugins (like shadow): http://overlib.boughner.us/ [mic]

		// check this speeds up that thing [mic]		// TODO if $publish_inform_title  is blank we get problems
		if( $publish_inform_title ){
			$tmp_time_info = '';
			if( $this->stop_publish == $this->start_publish ){
				if($this->start_time != $this->stop_time){
					$tmp_time_info = '<br />' . $this->start_time . ' - ' . $this->stop_time;
				}
				$publish_inform_overlay = ' onmouseover="return overlib(\'<table border=&quot;0&quot; height=&quot;100%&quot;>'
				. '<tr><td nowrap=&quot;nowrap&quot;>' . addcslashes( $this->start_date, '\'' )
				. $tmp_time_info
				;
			} else {
				if($this->start_time != $this->stop_time){
					$tmp_time_info = '<br /><b>' . _CAL_LANG_TIME . ':&nbsp;</b>' . $this->start_time . '&nbsp;-&nbsp;' . $this->stop_time;
				}
				$publish_inform_overlay = ' onmouseover="return overlib(\'<table border=&quot;0&quot; width=&quot;100%&quot; height=&quot;100%&quot;>'
				. '<tr><td><b>' . _CAL_LANG_FROM . ':&nbsp;</b>' . addcslashes( $this->start_date, '\'' ) . '&nbsp;'
				. '<br /><b>' . _CAL_LANG_TO . ':&nbsp;</b>' . addcslashes( $this->stop_date, '\'' )
				. $tmp_time_info
				;
			}
		}

		// Event Repeat Type Qualifier and Day Within Event Quailfiers:
		// the if statements below basically will print different information for the event
		// depending upon whether it is the start/stop day, repeat events type, or some date in between the
		// start and the stop dates of a multi-day event.  This behavior can be modified at will here.
		// Currently, an overlay window will only display on a mouseover if the event is a multi-day
		// event (ie. every day repeat type) AND the month cell is a day WITHIN the event day range BUT NOT
		// the start and stop days.  The overlay window displays the start and stop publish dates.  Different
		// overlay windows can be displayed for the different states below by simply defining a new overlay
		// window definition variable similar to the $publish_inform_overlay variable above and using it in the
		// statements below.  Another possibility here is to control the max. length of any string used within the
		// month cell to avoid calendar formatting issues.  Any string that exceeds this will get an overlay window
		// in order to display the full length/width of the month cell.

		// Note that we want multi-day events to display a titlelink for the first day only, but a popup for every day
		// Fix this.

		if ($this->event->alldayevent()){
			// just print the title
			$cellString = $publish_inform_overlay
			. '<br /><small><em>' . _CAL_LANG_FIRST_SINGLE_DAY_EVENT . '</em></small>';
		}
		else if(( $cellDate == $this->stop_publish ) && ( $this->stop_publish == $this->start_publish )) {
			// single day event
			// just print the title
			$cellString = $publish_inform_overlay
			. '<br /><small><em>' . _CAL_LANG_FIRST_SINGLE_DAY_EVENT . '</em></small>';
		}elseif( $cellDate == $this->start_publish ){
			// first day of a multi-day event
			// just print the title
			$cellString = $publish_inform_overlay
			. '<br /><small><em>' . _CAL_LANG_FIRST_DAY_OF_MULTIEVENT . '</em></small>';
		}elseif( $cellDate == $this->stop_publish ){
			// last day of a multi-day event
			// enable an overlib popup
			$cellString = $publish_inform_overlay
			. '<br /><small><em>' . _CAL_LANG_LAST_DAY_OF_MULTIEVENT . '</em></small>';
		}elseif(( $cellDate < $this->stop_publish ) && ( $cellDate > $this->start_publish ) ) {
			// middle day of a multi-day event
			// enable the display of an overlib popup describing publish date
			$cellString = $publish_inform_overlay
			. '<br /><small><em>' . _CAL_LANG_MULTIDAY_EVENT . '</em></small>';
		}else{
			// this should never happen, but is here just in case...
			$cellString =  $publish_inform_overlay.'<br /><small><div style=&quot;background-color:yellow;color:black;font-weight:bold&quot;>Problems - check event!</div></small>';
			$title_event_link = "<div style='color:black!important;background-color:yellow!important;font-weight:bold'>Problems - check event!</div>";
			$cellStart   = '';
			$cellStyle   = '';
			$cellEnd     = '';
		}

		/**
 * defining the design of the tooltip
 * AUTOSTATUSCAP 	displays title in browsers statusbar (only IE)
 * if no vlaus are defined, the overlib standard values are used
 * TT backgrund	bool
 * TT posX		string	left, center, right (right = standard)
 * TT posY		string	above, below (below = standard)
 * shadow		bool
 * shadox posX	bool (standard = right)
 * shadow posY	bool (standard = below)
 * FGCOLOR		string	set here fix (could be also defined in config - later)
 * CAPCOLOR		string	set here fix (could be also defined in config - later)
 **/

		// set standard values
		$ttBGround 		= '';
		$ttXPos 		= '';
		$ttYPos 		= '';
		$ttShadow 		= '';
		$ttShadowColor  = '';
		$ttShadowX      = '';
		$ttShadowY      = '';

		// TT background
		if( $cfg->get('com_calTTBackground') == '1' ){
			$ttBGround = ' BGCOLOR, \'' . $this->event->bgcolor() . '\',';
			$ttFGround = ' CAPCOLOR, \'' . $this->event->fgcolor() . '\',';
		}
		else $ttFGround = ' CAPCOLOR, \'#000000\',';

		// TT xpos
		if( $cfg->get('com_calTTPosX') == 'CENTER' ){
			$ttXPos = ' CENTER,';
		}elseif( $cfg->get('com_calTTPosX') == 'LEFT' ){
			$ttXPos = ' LEFT,';
		}

		// TT ypos
		if( $cfg->get('com_calTTPosY') == 'ABOVE' ){
			$ttYPos = ' ABOVE,';
		}

		/* TT shadow in inside the positions
		* shadowX is fixec with 15px (above)
		* shadowY is fixed with -10px (right)
		* we also define here the shadow color (fix value - can overridden by the config later)
		*/
		if( $cfg->get('com_calTTShadow') == '1' ){
			$ttShadow 		= ' SHADOW,';
			$ttShadowColor 	= ' SHADOWCOLOR, \'#999999\',';

			if( $cfg->get('com_calTTShadowX') == '1' ){
				$ttShadowX = ' SHADOWX, -4,';
			}

			if( $cfg->get('com_calTTShadowY') == '1' ){
				$ttShadowY = ' SHADOWY, -4,';
			}
		}

		$cellString .= '<hr />'
		// Watch out for mambots !!
		//. $this->event->content // [maybe later mic]
		//. '<hr />' // [maybe later mic]
		. '<small>' . str_replace("'", "\'", _CAL_LANG_CLICK_TO_OPEN_EVENT) . '</small>'
		. '</td></tr></table>\''
		. ', CAPTION, \'' . $publish_inform_title . '\',' . $ttYPos . $ttXPos
		. ' FGCOLOR, \'#FFFFE2\',' . $ttBGround. $ttFGround
		. $ttShadow . $ttShadowY . $ttShadowX . $ttShadowColor . ' AUTOSTATUSCAP);" onmouseout="return nd();"'
		;
		return $cellString;
	}

	function calendarCell_popup($cellDate){
		$cfg = & EventsConfig::getInstance();

		$publish_inform_title 	= htmlspecialchars( $this->title );
		$publish_inform_overlay	= '';
		$cellString="";
		// The one overlay popup window defined for multi-day events.  Any number of different overlay windows
		// can be defined here and used according to the event's repeat type, length, whatever.  Note that the
		// definition of the overlib function call arguments is ( html_window_contents, extra optional paramenters ... )
		// 'extra parameters' includes things like window positioning, display delays, window caption, etc.
		// Documentation on the javascript overlib library can be found at: http://www.bosrup.com/web/overlib/
		// or here for additional plugins (like shadow): http://overlib.boughner.us/ [mic]

		// check this speeds up that thing [mic]		// TODO if $publish_inform_title  is blank we get problems
		if( $publish_inform_title ){
			$tmp_time_info = '';
			if( $this->stop_publish == $this->start_publish ){
				if($this->start_time != $this->stop_time && !$this->event->alldayevent()){
					$tmp_time_info = '<br />' . $this->start_time . ' - ' . $this->stop_time;
				}
				
				$publish_inform_overlay = '<table style="border:0px;height:100%">'
				. '<tr><td nowrap=&quot;nowrap&quot;>' . $this->start_date
				. $tmp_time_info
				;
			} else {
				if($this->start_time != $this->stop_time && !$this->event->alldayevent()){
					$tmp_time_info = '<br /><b>' . _CAL_LANG_TIME . ':&nbsp;</b>' . $this->start_time . '&nbsp;-&nbsp;' . $this->stop_time;
				}
				$publish_inform_overlay = '<table style="border:0px;width:100%;height:100%">'
				. '<tr><td><b>' . _CAL_LANG_FROM . ':&nbsp;</b>' . $this->start_date . '&nbsp;'
				. '<br /><b>' . _CAL_LANG_TO . ':&nbsp;</b>' . $this->stop_date
				. $tmp_time_info
				;
			}
		}

		// Event Repeat Type Qualifier and Day Within Event Quailfiers:
		// the if statements below basically will print different information for the event
		// depending upon whether it is the start/stop day, repeat events type, or some date in between the
		// start and the stop dates of a multi-day event.  This behavior can be modified at will here.
		// Currently, an overlay window will only display on a mouseover if the event is a multi-day
		// event (ie. every day repeat type) AND the month cell is a day WITHIN the event day range BUT NOT
		// the start and stop days.  The overlay window displays the start and stop publish dates.  Different
		// overlay windows can be displayed for the different states below by simply defining a new overlay
		// window definition variable similar to the $publish_inform_overlay variable above and using it in the
		// statements below.  Another possibility here is to control the max. length of any string used within the
		// month cell to avoid calendar formatting issues.  Any string that exceeds this will get an overlay window
		// in order to display the full length/width of the month cell.

		// Note that we want multi-day events to display a titlelink for the first day only, but a popup for every day
		// Fix this.

		if ($this->event->alldayevent()){
			// just print the title
			$cellString = $publish_inform_overlay
			. '<br /><small><em>' . _CAL_LANG_FIRST_SINGLE_DAY_EVENT . '</em></small>';
		}
		else if(( $cellDate == $this->stop_publish ) && ( $this->stop_publish == $this->start_publish )) {
			// single day event
			// just print the title
			$cellString = $publish_inform_overlay
			. '<br /><small><em>' . _CAL_LANG_FIRST_SINGLE_DAY_EVENT . '</em></small>';
		}elseif( $cellDate == $this->start_publish ){
			// first day of a multi-day event
			// just print the title
			$cellString = $publish_inform_overlay
			. '<br /><small><em>' . _CAL_LANG_FIRST_DAY_OF_MULTIEVENT . '</em></small>';
		}elseif( $cellDate == $this->stop_publish ){
			// last day of a multi-day event
			// enable an overlib popup
			$cellString = $publish_inform_overlay
			. '<br /><small><em>' . _CAL_LANG_LAST_DAY_OF_MULTIEVENT . '</em></small>';
		}elseif(( $cellDate < $this->stop_publish ) && ( $cellDate > $this->start_publish ) ) {
			// middle day of a multi-day event
			// enable the display of an overlib popup describing publish date
			$cellString = $publish_inform_overlay
			. '<br /><small><em>' . _CAL_LANG_MULTIDAY_EVENT . '</em></small>';
		}else{
			// this should never happen, but is here just in case...
			$cellString =  $publish_inform_overlay.'<br /><small><div style="background-color:yellow;color:black;font-weight:bold">Problems - check event!</div></small>';
			$title_event_link = "<div style='color:black!important;background-color:yellow!important;font-weight:bold'>Problems - check event!</div>";
			$cellStart   = '';
			$cellStyle   = '';
			$cellEnd     = '';
		}

		/**
 * defining the design of the tooltip
 * AUTOSTATUSCAP 	displays title in browsers statusbar (only IE)
 * if no vlaus are defined, the overlib standard values are used
 * TT backgrund	bool
 * TT posX		string	left, center, right (right = standard)
 * TT posY		string	above, below (below = standard)
 * shadow		bool
 * shadox posX	bool (standard = right)
 * shadow posY	bool (standard = below)
 * FGCOLOR		string	set here fix (could be also defined in config - later)
 * CAPCOLOR		string	set here fix (could be also defined in config - later)
 **/

		// set standard values
		$ttBGround 		= '';
		$ttXPos 		= '';
		$ttYPos 		= '';
		$ttShadow 		= '';
		$ttShadowColor  = '';
		$ttShadowX      = '';
		$ttShadowY      = '';

		// TT background
		if( $cfg->get('com_calTTBackground') == '1' ){
			$ttBGround = ' BGCOLOR, \'' . $this->event->bgcolor() . '\',';
			$ttFGround = ' CAPCOLOR, \'' . $this->event->fgcolor() . '\',';
		}
		else $ttFGround = ' CAPCOLOR, \'#000000\',';

		// TT xpos
		if( $cfg->get('com_calTTPosX') == 'CENTER' ){
			$ttXPos = ' CENTER,';
		}elseif( $cfg->get('com_calTTPosX') == 'LEFT' ){
			$ttXPos = ' LEFT,';
		}

		// TT ypos
		if( $cfg->get('com_calTTPosY') == 'ABOVE' ){
			$ttYPos = ' ABOVE,';
		}

		/* TT shadow in inside the positions
		* shadowX is fixec with 15px (above)
		* shadowY is fixed with -10px (right)
		* we also define here the shadow color (fix value - can overridden by the config later)
		*/
		if( $cfg->get('com_calTTShadow') == '1' ){
			$ttShadow 		= ' SHADOW,';
			$ttShadowColor 	= ' SHADOWCOLOR, \'#999999\',';

			if( $cfg->get('com_calTTShadowX') == '1' ){
				$ttShadowX = ' SHADOWX, -4,';
			}

			if( $cfg->get('com_calTTShadowY') == '1' ){
				$ttShadowY = ' SHADOWY, -4,';
			}
		}

		$cellString .= '<hr />'
		// Watch out for mambots !!
		//. $this->event->content // [maybe later mic]
		//. '<hr />' // [maybe later mic]
		. '<small>' . _CAL_LANG_CLICK_TO_OPEN_EVENT . '</small>'
		. '</td></tr></table>';

		// harden the string for overlib
		$cellString =  '\'' . addcslashes($cellString, '\'') . '\'';

		// add more overlib parameters
		$cellString .= ', CAPTION, \'' . addcslashes($publish_inform_title, '\'') . '\',' . $ttYPos . $ttXPos
		. ' FGCOLOR, \'#FFFFE2\',' . $ttBGround. $ttFGround
		. $ttShadow . $ttShadowY . $ttShadowX . $ttShadowColor . ' AUTOSTATUSCAP';

		$cellString = ' onmouseover="return overlib('.htmlspecialchars($cellString).')"';
		$cellString .=' onmouseout="return nd();"';
		return $cellString;
	}

	function calendarCell(&$currentDay,$year,$month,$i){
		// pass $data by reference in order to update countdisplay

		global $mainframe;
		$Itemid	= EventsHelper::getItemid();
		$cfg = & EventsConfig::getInstance();
		$option = $cfg->get("com_componentname");

		$event_day      = $this->event->dup();
		$event_month    = $this->event->mup();

		$id             = $this->event->id();


		// this file controls the events component month calendar display cell output.  It is separated from the
		// showCalendar function in the events.php file to allow users to customize this portion of the code easier.
		// The event information to be displayed within a month day on the calendar can be modified, as well as any
		// overlay window information printed with a javascript mouseover event.  Each event prints as a separate table
		// row with a single column, within the month table's cell.

		// define start and end
		$cellStart	= '<div';
		$cellStyle	= 'padding:0;';
		$cellEnd		= '</div>' . "\n";

		// add the event color as the column background color
		$cellStyle .= ' background-color:' . $this->event->bgcolor() . ';color:'.$this->event->fgcolor() . ';' ;

		// MSIE ignores "inherit" color for links - stupid Microsoft!!!
		$linkStyle = 'style="color:'.$this->event->fgcolor() . ';"';

		// The title is printed as a link to the event's detail page
		$link = $this->event->viewDetailLink($year,$month,$currentDay['d0'],false);
		$link = JRoute::_($link.$this->_datamodel->getItemidLink().$this->_datamodel->getCatidsOutLink());

		// [mic] if title is too long, cut 'em for display
		$tmpTitle = $this->title;
		if( strlen( $this->title ) >= $cfg->get('com_calCutTitle')){
			$tmpTitle = substr( $this->title, 0, $cfg->get('com_calCutTitle') ) . ' ...';
		}

		// [new mic] if amount of displaing events greater than defined, show only a scmall coloured icon
		// instead of full text - the image could also be "recurring dependig", which means
		// for each kind of event (one day, multi day, last day) another icon
		// in this case the dfinition must moved down to be more flexible!

		// [tstahl] add a graphic symbol for all day events?
		$tmp_start_time = ($this->start_time == $this->stop_time || $this->event->alldayevent()) ? '' : $this->start_time;

		if( $currentDay['countDisplay'] < $cfg->get('com_calMaxDisplay')){
			$title_event_link = '<a class="cal_titlelink" href="' . $link . '" '.$linkStyle.'>'
			. ( $cfg->get('com_calDisplayStarttime') ? $tmp_start_time : '' ) . ' ' . $tmpTitle . '</a>' . "\n";
			$cellStyle .= ' width:100%;';	
		}else{
			$eventIMG	= '<img align="left" style="border:1px solid white;" src="' . JURI::root()
			. '/components/'.$option.'/images/event.png" height="12" width="8" alt=""' . ' />';

			$title_event_link = '<a class="cal_titlelink" href="' . $link . '">' . $eventIMG . '</a>' . "\n";
			$cellStyle .= ' float:left;width:10px;';
		}

		$cellString	= '';

		if( $cfg->get("com_enableToolTip",1)) {
			$cellString .= $this->calendarCell_popup($currentDay["cellDate"]);
		}

		// return the whole thing
		return $cellStart . ' style="' . $cellStyle . '" ' . $cellString . ">\n" . $title_event_link . $cellEnd;
	}
}

?>
