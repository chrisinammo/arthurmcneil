<?php
/**
 * Events Component for Joomla 1.5.x
 *
 * @version     $Id: modView.php 965 2008-02-16 11:01:09Z geraint $
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

include_once(JPATH_SITE."/components/$compname/layouts/alternative/modView.php");

/** ensure that class and functions are declared only once */
if (!class_exists("JEventsLegend_geraint")) {
	EventsViewer::setViewClassName("mod_legend","JEventsLegend_geraint");

	class JEventsLegend_geraint extends JEventsLegend_alternative {

		function getViewName(){
			// switch when active!
			//return "geraint";	
			return parent::getViewName();
		}
	}
}

/** ensure that class and functions are declared only once */
if (!class_exists("JEventsCal_geraint")) {
	
	EventsViewer::setViewClassName("mod_cal","JEventsCal_geraint");
	/**
	* instance of a mini calendar
	*/
	class JEventsCal_geraint extends  JEventsCal {

		function getViewName(){
			// switch when active!
			return "geraint";	
			//return parent::getViewName();
		}
		
	} // class JEventsCal
} // (!class_exists("JEventsCal")

if (!class_exists("JEventsLatest_geraint")) {

	EventsViewer::setViewClassName("mod_latest","JEventsLatest_geraint");

	class JEventsLatest_geraint  extends JEventsLatest_alternative {
			
		function getViewName(){
			// switch when active!
			//return "geraint";	
		}
	
	} // end of class
} // !defined( 'JEVENTS_LATEST_MODULE')


?>
