<?php
/*
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

/*
 * Make sure the user is authorized to view this page
 */
$user = & JFactory::getUser();

// Set the table directory
JTable::addIncludePath(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_gk_tabsman'.DS.'tables');

// Import file dependencies
require_once (JPATH_COMPONENT.DS.'controller.php');

$task = JRequest::getCmd('task');

switch ($task){

	case 'add_group' :
		TabsController::addTabsGroup();
		break;
	
	case 'edit_group' :
		TabsController::editTabsGroup();
		break;
		
	case 'remove_group' :
		TabsController::removeTabsGroup();
		break;	

	case 'save_group'  :
	case 'apply_group' :
		TabsController::saveTabsGroup();
		break;

	case 'add_tab' :
		TabsController::addTab();
		break;
	
	case 'edit_tab' :
		TabsController::editTab();
		break;
		
	case 'remove_tab' :
		TabsController::removeTab();
		break;	

	case 'save_tab'  :
	case 'apply_tab' :
		TabsController::saveTab();
		break;

	case 'cancel' :
		TabsController::cancelTabs();
		break;

	case 'saveorder' :
		TabsController::savePositions();
		break;

	case 'view_group':	
		TabsController::viewTabsGroup();
		break;
		
	case 'view_help':	
		TabsController::viewHelp();
		break;	
		
	default :
		TabsController::viewTabsGroups();
		break;
}

?>