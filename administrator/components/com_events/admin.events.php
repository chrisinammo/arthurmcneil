<?php
/**
 * Events Component for Joomla 1.5.x
 *
 * @version     $Id: admin.events.php 912 2007-12-21 11:19:31Z geraint $
 * @package     Events
 * @copyright   Copyright (C) 2006-2007 JEvents Project Group
 * @copyright   Copyright (C) 2000 - 2003 Eric Lamette, Dave McDonnell
 * @licence     http://www.gnu.org/copyleft/gpl.html
 * @link        http://joomlacode.org/gf/project/jevents
 */

defined( '_JEXEC' ) or die( 'Restricted access' );

// dmcd May 7/04 fix for accessing registered categories in backend
$user	=& JFactory::getUser();

$gid = $user->gid;

// setup for all required function and classes
require_once(JPATH_SITE . "/components/com_events/includes/adminutils.php");

$cfg = & EventsConfig::getInstance();
$jev_component_name  = $cfg->get("com_componentname", "com_events");
$option = $jev_component_name;

// load frontend language constants
EventsHelper::loadLanguage('front');

// load backend language constants
EventsHelper::loadLanguage('admin');

// Joomla 1.5
$option = JRequest::getVar( 'option', 'com_events' );

$pathCom = JPATH_ADMINISTRATOR  . "/components/$option/";

include_once( $pathCom . 'admin.events.main.php' );

// include and create controller
include_once( dirname(__FILE__).'/admin.controller.php');
global $jevAdminController;
$jevAdminController = new JEventsAdminController();

// Register Extra tasks as part of setup
$jevAdminController->setupController();

// Perform the Request task
// backwards compatability fix - should never arise
$act	= JRequest::getVar( 'act', 	"" );
if ($task=="" && $act!="") $task=$act;
$GLOBALS["task"]=$task;

$jevAdminController->execute( $task);
$jevAdminController->redirect();




