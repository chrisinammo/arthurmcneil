<?php
/**
 * Events Component for Joomla 1.5.x
 *
 * @version     $Id: events_calendar_cell.php 965 2008-02-16 11:01:09Z geraint $
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

include_once(JPATH_SITE."/components/$compname/layouts/alternative/events_calendar_cell.php");

class EventCalendarCell_geraint extends EventCalendarCell_alternative {
	
}
?>
