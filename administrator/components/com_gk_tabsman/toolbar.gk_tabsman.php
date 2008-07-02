<?php
/**

*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

require_once( JApplicationHelper::getPath( 'toolbar_html' ) );

$client	=& JApplicationHelper::getClientInfo(JRequest::getVar('client', '0', '', 'int'));

switch ($task)
{
	case 'add_group' :
		TabsToolbar::addTabsGroup();
		break;

	case 'add_tab' :
		TabsToolbar::addTab();
		break;
	
	case 'edit_group' :
		TabsToolbar::editTabsGroup();
		break;

	case 'edit_tab' :
		TabsToolbar::editTab();
		break;

	case 'view_group':	
		TabsToolbar::viewTabsGroup();
		break;
		
	case 'view_help':	
		TabsToolbar::viewHelp();
		break;	
		
	default :
		TabsToolbar::viewTabsGroups();
		break;
}

?>