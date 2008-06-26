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

global $mainframe;
$cfg = & EventsConfig::getInstance();
$compname = $cfg->get("com_componentname");

include_once(JPATH_SITE."/components/$compname/layouts/default/events_calendar_cell.php");

class EventCalendarCell_alternative extends EventCalendarCell_default  {

	function calendarCell(&$currentDay,$year,$month,$i){
		// pass $data by reference in order to update countdisplay
		global $mainframe;
$cfg = & EventsConfig::getInstance();
$option = $cfg->get("com_componentname");
		$Itemid	= EventsHelper::getItemid();

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

		$linkStyle = "";

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
			$title_event_link = "\n".'<a class="cal_titlelink" href="' . $link . '" '.$linkStyle.'>'
			. ( $cfg->get('com_calDisplayStarttime') ? $tmp_start_time : '' ) . ' ' . $tmpTitle . '</a>' . "\n";
			$cellStyle .= "border-left:8px solid ".$this->event->bgcolor().";padding-left:2px;";
		}else{
			$eventIMG	= '<img align="left" src="' . JURI::root()
			. '/components/'.$option.'/images/event.png" alt="" style="height:12px;width:8px;border:1px solid white;background-color:'. $this->event->bgcolor().'" />';

			$title_event_link = "\n".'<a class="cal_titlelink" href="' . $link . '">' . $eventIMG . '</a>' . "\n";
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
