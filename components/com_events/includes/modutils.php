<?php
/**
 * Events Component for Joomla 1.5.x
 *
 * @version     $Id: modutils.php 942 2008-02-04 19:37:07Z tstahl $
 * @package     Events
 * @copyright   Copyright (C) 2006-2007 JEvents Project Group
 * @licence     http://www.gnu.org/copyleft/gpl.html
 * @link        http://joomlacode.org/gf/project/jevents
 */

/*
 loads all required classes and file to support Events Modules
*/
defined( '_JEXEC' ) or die( 'Restricted access' );

global $mainframe;

// first load config class
require_once(JPATH_ADMINISTRATOR . "/components/com_events/lib/config.php");

$cfg = & EventsConfig::getInstance();
$jev_component_name  = $cfg->get("com_componentname");

include_once(JPATH_SITE."/components/$jev_component_name/events.class.php");

// common helper class
require_once(JPATH_SITE . "/components/$jev_component_name/libraries/helper.php");

// data model functions
require_once(JPATH_SITE . "/components/$jev_component_name/libraries/datamodel.php");

// common function and classes
require_once(JPATH_SITE . "/components/$jev_component_name/libraries/commonfunctions.php");
require_once(JPATH_SITE . "/components/$jev_component_name/libraries/commonqueries.php");

// function and classes
require_once(JPATH_SITE . "/components/$jev_component_name/libraries/modfunctions.php");

// viewer helper
require_once(JPATH_SITE . "/components/$jev_component_name/libraries/eventViewer.php");

?>
