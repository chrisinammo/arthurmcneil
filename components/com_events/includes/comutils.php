<?php
/**
 * Events Component for Joomla 1.5.x
 *
 * @version     $Id: comutils.php 962 2008-02-16 10:58:03Z geraint $
 * @package     Events
 * @copyright   Copyright (C) 2006-2007 JEvents Project Group
 * @licence     http://www.gnu.org/copyleft/gpl.html
 * @link        http://joomlacode.org/gf/project/jevents
 */

/*
 loads all required classes and file to support Events Component (Frontend)
*/
defined( '_JEXEC' ) or die( 'Restricted access' );

global $mainframe, $option; // $option must be global to avoid circular definition

// first load config class
require_once(JPATH_ADMINISTRATOR . "/components/$option/lib/config.php");

$cfg = & EventsConfig::getInstance();
$jev_component_name  = $cfg->get("com_componentname");

// common helper class
require_once(JPATH_SITE . "/components/$jev_component_name/libraries/helper.php");

// data model functions
require_once(JPATH_SITE . "/components/$jev_component_name/libraries/datamodel.php");

// common function and classes
require_once(JPATH_SITE . "/components/$jev_component_name/libraries/commonfunctions.php");

// SOMES INCLUDES
require_once( $mainframe->getPath( "front_html" ) );
require_once( $mainframe->getPath( "class" ) );

// load version class
require_once(JPATH_ADMINISTRATOR . "/components/$jev_component_name/lib/version.php");

// viewer helper
require_once(JPATH_SITE . "/components/$jev_component_name/libraries/eventViewer.php");

// function and classes
//require_once(JPATH_SITE . "/components/$jev_component_name/libraries/??.php");
?>
