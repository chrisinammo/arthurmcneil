<?php
/**
 * Events Component for Joomla 1.5.x
 *
 * @version     $Id: adminutils.php 911 2007-12-21 11:14:36Z geraint $
 * @package     Events
 * @copyright   Copyright (C) 2006-2007 JEvents Project Group
 * @licence     http://www.gnu.org/copyleft/gpl.html
 * @link        http://joomlacode.org/gf/project/jevents
 */

/*
 loads all required classes and file to support Events Component
*/
defined( '_JEXEC' ) or die( 'Restricted access' );

global $mainframe;

// first load config class
require_once(JPATH_ADMINISTRATOR. "/components/com_events/lib/config.php");

$cfg = & EventsConfig::getInstance();
$jev_component_name  = $cfg->get("com_componentname");

// common helper class
require_once(JPATH_SITE . "/components/$jev_component_name/libraries/helper.php");

// common function and classes
require_once(JPATH_SITE . "/components/$jev_component_name/libraries/commonfunctions.php");

require_once( $mainframe->getPath( "admin_html" ) );
require_once( $mainframe->getPath( "class" ) );

// load version class
require_once(JPATH_ADMINISTRATOR . "/components/$jev_component_name/lib/version.php");

// function and classes
//require_once(JPATH_SITE . "/components/$option/libraries/??.php");

?>
