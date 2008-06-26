<?php
/**
 * Events Component for Joomla 1.5.x
 *
 * @version     $Id: adminqueries.php 913 2008-01-02 14:51:28Z geraint $
 * @package     Events
 * @copyright   Copyright (C) 2006-2007 JEvents Project Group
 * @copyright   Copyright (C) 2000 - 2003 Eric Lamette, Dave McDonnelle
 * @licence     http://www.gnu.org/copyleft/gpl.html
 * @link        http://joomlacode.org/gf/project/jevents
 */

defined( '_JEXEC' ) or die( 'Restricted access' );

// load language constants
EventsHelper::loadLanguage('admin');

$cfg = & EventsConfig::getInstance();
$jev_component_name  = $cfg->get("com_componentname", "com_events");
include_once(JPATH_SITE."/components/$jev_component_name/libraries/commonqueries.php");

class JEventsAdminDBModel extends JEventsDBModel {

	/**
 * gets raw vevent (not a rpt) usually for editing purposes
 * 
 *
 * @param int $agid vevent id
 * @return stdClass details of vevent selected
 */
	function getVEventById( $agid) {
		global  $gid;
		$db	=& JFactory::getDBO();
		$user =& JFactory::getUser();
		$query = "SELECT ev.*,rr.*, det.*"
		. "\n FROM #__jevents_vevent as ev"
		. "\n LEFT JOIN #__jevents_vevdetail as det ON det.evdet_id = ev.detail_id"
		. "\n LEFT JOIN #__jevents_rrule as rr ON rr.eventid = ev.ev_id"
		. "\n WHERE ev.catid IN(".$this->accessibleCategoryList().")"
		. "\n AND ev.ev_id = '$agid'"
		. "\n AND ev.access <= ".$user->gid;

		$db->setQuery( $query );

		$rows = $db->loadObjectList();
		if (count($rows)>0) return $rows[0];
		else return null;
	}

	function getVEventRepeatById( $rp_id) {
		global  $gid;
		$db	=& JFactory::getDBO();
		$user =& JFactory::getUser();
		$query = "SELECT ev.*, rpt.*, rr.*, det.*"
		. "\n , YEAR(rpt.startrepeat) as yup, MONTH(rpt.startrepeat ) as mup, DAYOFMONTH(rpt.startrepeat ) as dup"
		. "\n , YEAR(rpt.endrepeat  ) as ydn, MONTH(rpt.endrepeat   ) as mdn, DAYOFMONTH(rpt.endrepeat   ) as ddn"
		. "\n , HOUR(rpt.startrepeat) as hup, MINUTE(rpt.startrepeat ) as minup, SECOND(rpt.startrepeat ) as sup"
		. "\n , HOUR(rpt.endrepeat  ) as hdn, MINUTE(rpt.endrepeat   ) as mindn, SECOND(rpt.endrepeat   ) as sdn"
		. "\n FROM #__jevents_vevent as ev, #__jevents_icsfile as icsf"
		. "\n LEFT JOIN #__jevents_repetition as rpt ON rpt.eventid = ev.ev_id"
		. "\n LEFT JOIN #__jevents_vevdetail as det ON det.evdet_id = rpt.eventdetail_id"
		. "\n LEFT JOIN #__jevents_rrule as rr ON rr.eventid = ev.ev_id"
		. "\n WHERE ev.catid IN(".$this->accessibleCategoryList().")"
		. "\n AND rpt.rp_id = '$rp_id'"
		. "\n AND ev.access <= ".$user->gid;

		$db->setQuery( $query );

		$rows = $db->loadObjectList();
		if (count($rows>0)) return $rows[0];
		else return null;

	}

	/**
 * get all the native JEvents Icals (i.e. not imported from URL or FILE)
 *
 * @return unknown
 */

	// TODO add more access control e.g. canpublish caneditown etc.

	function getNativeIcalendars() {
		global  $gid;
		$db	=& JFactory::getDBO();
		$user =& JFactory::getUser();
		$query = "SELECT *"
		. "\n FROM #__jevents_icsfile as ical"
		. "\n WHERE ical.catid IN(".$this->accessibleCategoryList().")"
		. "\n AND ical.icaltype = '2'"
		. "\n AND ical.access <= ".$user->gid;

		$db->setQuery( $query );
		$rows = $db->loadObjectList("ics_id");

		return $rows;
	}

	function getIcalByIcsid($icsid) {
		global  $gid;
		$db	=& JFactory::getDBO();
		$user =& JFactory::getUser();
		$query = "SELECT *"
		. "\n FROM #__jevents_icsfile as ical"
		. "\n WHERE ical.catid IN(".$this->accessibleCategoryList().")"
		. "\n AND ical.ics_id = $icsid"
		. "\n AND ical.access <= ".$user->gid;

		$db->setQuery( $query );
		$row = $db->loadObject();

		return $row;
	}

	
}