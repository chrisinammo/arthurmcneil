<?php
/*
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

class TabsToolbar
{
	function addTabsGroup(){
		JToolBarHelper::title( JText::_( 'Tabs Manager - add Tabs group' ));
		JToolBarHelper::back();
		JToolBarHelper::save( 'save_group' );
		JToolBarHelper::cancel( 'cancel', 'Close' );
	}

	function addTab(){
		JToolBarHelper::title( JText::_( 'Tabs Manager - add Tab' ));
		JToolBarHelper::back();
		JToolBarHelper::save('save_tab');
		JToolBarHelper::cancel( 'cancel', 'Close' );
	}
	
	function editTabsGroup(){
		JToolBarHelper::title( JText::_( 'Tabs Manager - edit Tabs group' ));
		JToolBarHelper::back();
		JToolBarHelper::save('apply_group');
		JToolBarHelper::cancel( 'cancel', 'Close' );
	}
	
	function editTab(){
		JToolBarHelper::title( JText::_( 'Tabs Manager - edit Tab' ));
		JToolBarHelper::back();
		JToolBarHelper::save('apply_tab');
		JToolBarHelper::cancel( 'cancel', 'Close' );
	}
	
	function viewTabsGroup(){
		JToolBarHelper::title( JText::_( 'Tabs Manager - view group' ));
		JToolBarHelper::editListX( 'edit_tab', 'Edit tab');
		JToolBarHelper::custom( 'view_groups', 'preview.png', 'preview_f2.png', 'View all groups', false, false );
		JToolBarHelper::addNew( 'add_tab', 'Add tab');
		JToolBarHelper::deleteList( 'Do you really want to remove this tab ?', 'remove_tab');
		JToolBarHelper::custom( 'view_help', 'help.png', 'help_f2.png', 'Help & Info', false, false );
	}
	
	function viewHelp(){
		JToolBarHelper::title( JText::_( 'Tabs Manager - Help & Info' ));
		JToolBarHelper::back();
	}
	
	function viewTabsGroups(){
		JToolBarHelper::title( JText::_( 'Tabs Manager' ));
		JToolBarHelper::custom( 'view_group', 'apply.png', 'apply_f2.png', 'View group', true );
		JToolBarHelper::addNew( 'add_group', 'Add group');
		JToolBarHelper::deleteListX( 'Do you really want to remove this group ?', 'remove_group');
		JToolBarHelper::editListX( 'edit_group', 'Edit group');
		JToolBarHelper::custom( 'view_help', 'help.png', 'help_f2.png', 'Help & Info', false, false );
	}
}