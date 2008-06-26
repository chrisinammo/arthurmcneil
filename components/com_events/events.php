<?php
/**
 * Events Component for Joomla 1.5.x
 *
 * @version     $Id: events.php 911 2007-12-21 11:14:36Z geraint $
 * @package     Events
 * @copyright   Copyright (C) 2006-2007 JEvents Project Group
 * @copyright   Copyright (C) 2000 - 2003 Eric Lamette, Dave McDonnelle
 * @licence     http://www.gnu.org/copyleft/gpl.html
 * @link        http://joomlacode.org/gf/project/jevents
 */

defined( '_JEXEC' ) or die( 'Restricted access' );

include_once( dirname(__FILE__)."/old/events.old.php" );

/**
 *  TODO
 * 1 make sure view switching and cache code is compatible
 */

/*************************************************
* CORE
**************************************************/

global $mainframe;

// setup for all required function and classes
require_once( dirname(__FILE__).'/includes/comutils.php');

$cfg = & EventsConfig::getInstance();
$option = $cfg->get("com_componentname");

include_once( dirname(__FILE__)."/libraries/commonqueries.php");

$cfg = & EventsConfig::getInstance();


// SOMES GLOBAL VARIABLES


// Joomla 1.5


// Dynamic Page Title

$menu		= $mainframe->get( 'menu' );
// Joomla 1.5
if (!isset($menu) && class_exists("JMenu"))	{
	$menu2	=& JSite::getMenu();
	//$menu2	=& JMenu::getInstance();
	$menu    = $menu2->getActive();
	if ($menu){
		// $menu is not set for RSS feeds etc.
		$params	=& $menu2->getParams($menu->id);
	}
}

if ($menu){
	$mainframe->setPageTitle( $menu->name );
}



// include and create controller
include_once( dirname(__FILE__).'/controller.php');

$jevController = new JEventsController();

// Register Extra tasks as part of setup
$jevController->setupController();

// Perform the Request task
$task 	= JRequest::getVar(	'task',	$cfg->get('com_startview'));
$jevController->execute( $task);
$jevController->redirect();
