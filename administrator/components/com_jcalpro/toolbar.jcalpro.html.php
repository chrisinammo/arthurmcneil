<?php
/*
**********************************************
JCal Pro v1.5.3
Copyright (c) 2006-2007 Anything-Digital.com
**********************************************
JCal Pro is a fork of the existing Extcalendar component for Joomla!
(com_extcal_0_9_2_RC4.zip from mamboguru.com). 
Extcal (http://sourceforge.net/projects/extcal) was renamed 
and adapted to become a Mambo/Joomla! component by 
Matthew Friedman, and further modified by David McKinnis
(mamboguru.com) to repair some security holes. 

This file is based on toolbar.extcalendar.html.php v1.9 (2005/02/16) by stingrey.

This program is free software; you can redistribute it and/or modify 
it under the terms of the GNU General Public License as published by 
the Free Software Foundation; either version 2 of the License, or 
(at your option) any later version.

This header must not be removed. Additional contributions/changes
may be added to this header as long as no information is deleted.
**********************************************

$File: toolbar.jcalpro.html.php $

Revision date: 02/20/2007

**********************************************
Get the latest version of JCal Pro at:
http://dev.anything-digital.com//
**********************************************
*/

/** ensure this file is being included by a parent file */
defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );

/**
* @package Mambo
* @subpackage Extcalendar
*/
class TOOLBAR_extcalendar {
	/**
	* Draws the menu for to Edit settings
	*/
	    function _THEMES() {
    		//JToolBarHelper::title( 'Themes Menu', 'generic.png' );
            JToolBarHelper::title( 'Themes Menu', 'generic.png' );
    		//JToolBarHelper::makeDefault();
            JToolBarHelper::makeDefault();
			////JToolBarHelper::spacer();
    		//JToolBarHelper::custom('installtheme', 'upload.png', 'upload_f2.png', 'Install',false);
            JToolBarHelper::custom('installtheme', 'upload.png', 'upload_f2.png', 'Install',false);
    		////JToolBarHelper::spacer();
    		//JToolBarHelper::custom('cancel', 'cancel.png', 'cancel_f2.png', 'Cancel', false);
            JToolBarHelper::custom('cancel', 'cancel.png', 'cancel_f2.png', 'Cancel', false);
    		////JToolBarHelper::endTable();
        }
        function _EDIT_THEMES() {
    		global $id;

    		JToolBarHelper::title( 'Themes Menu', 'generic.png' );
    		JToolBarHelper::custom('savetheme', 'save.png', 'save_f2.png', 'Save', false);
    		//JToolBarHelper::spacer();
    		if ( $id ) {
    			// for existing content items the button is renamed `close`
    			JToolBarHelper::custom('canceledit', 'cancel.png', 'cancel_f2.png', 'Close', false);
    		} else {
         	JToolBarHelper::custom('canceledit', 'cancel.png', 'cancel_f2.png', 'Cancel', false);
    		}
    		//JToolBarHelper::spacer();
    		JToolBarHelper::help( 'screen.mambots.edit' );
    		//JToolBarHelper::endTable();
    	}
  function _INSTALL( $element )
  {    		
		if( $element == 'themes' )
		{            	
    	JToolBarHelper::title( 'Themes Menu', 'generic.png' );
    	//JToolBarHelper::custom('showthemes', 'new.png', 'new_f2.png', 'Themes', false);
    	////JToolBarHelper::spacer();
    	JToolBarHelper::custom('removetheme', 'delete.png', 'delete_f2.png', 'Uninstall', false);
    	//JToolBarHelper::spacer();
    	JToolBarHelper::custom('cancel', 'cancel.png', 'cancel_f2.png', 'Cancel', false);
    	//JToolBarHelper::endTable();
		}
  }
	
	function _EDIT() {
		//JToolBarHelper::title( 'Themes Menu', 'generic.png' );
        JToolBarHelper::title('Edit Config', 'generic.png');
		////JToolBarHelper::spacer();
		//JToolBarHelper::save('saveSettings');
        JToolBarHelper::save('saveSettings');
		////JToolBarHelper::spacer();
		//JToolBarHelper::cancel('cancelEditSettings');
        JToolBarHelper::cancel('canceleditSettings');
		////JToolBarHelper::spacer();
		////JToolBarHelper::endTable();
	}
	function _DEFAULT() {
		JToolBarHelper::title( 'Themes Menu', 'generic.png' );
		if (is_callable(array('mosMenuBar', 'editListX'))) {
            JToolBarHelper::editListX('editSettings','Settings');
        } else { 
			JToolBarHelper::editList('editSettings','Settings');
		}
		JToolBarHelper::custom('showthemes', 'new.png', 'new_f2.png', 'Themes', false);
    //JToolBarHelper::spacer();
		
		JToolBarHelper::custom('categories','move.png','move_f2.png','Categories',false);
		//JToolBarHelper::endTable();
	}
	
	function _DOCUMENTATION() {
		JToolBarHelper::title( 'Themes Menu', 'generic.png' );
		//JToolBarHelper::spacer();
		JToolBarHelper::cancel();
		//JToolBarHelper::endTable();
	}
	
	function _ABOUT() {
		JToolBarHelper::title( 'Themes Menu', 'generic.png' );
		//JToolBarHelper::spacer();
		JToolBarHelper::cancel();
		//JToolBarHelper::endTable();
	}
	
	function _IMPORT() {
		JToolBarHelper::title( 'Themes Menu', 'generic.png' );
		//JToolBarHelper::spacer();
		JToolBarHelper::cancel();
		//JToolBarHelper::endTable();
	}
	
	/* Events toolbars */	
	function EDIT_EVENTS_MENU ( )
  {
		JToolBarHelper::title( 'Event Menu', 'generic.png' );
		JToolBarHelper::save();
		JToolBarHelper::cancel();
		//JToolBarHelper::spacer();
		//JToolBarHelper::endTable();
	} 

	function EVENTS_MENU ( )
	{
		JToolBarHelper::title( 'Manage Events Menu', 'generic.png' );
		JToolBarHelper::publishList();
		JToolBarHelper::unpublishList();
		JToolBarHelper::addNew('new', 'Add');
		JToolBarHelper::editList();
		JToolBarHelper::deleteList();
		JToolBarHelper::cancel('cancelToMain', 'Cancel');
		//JToolBarHelper::endTable();	
	}	
}

/**
* @package Mambo
* @subpackage Extcalendar
*/
class TOOLBAR_extcalendarCategories {
	/**
	* Draws the menu for to Edit a category
	*/
	function _EDITCATEGORY() {
		JToolBarHelper::title( 'Category Menu', 'generic.png' );
		//JToolBarHelper::spacer();
		JToolBarHelper::save('saveCategory');
		//JToolBarHelper::spacer();
		JToolBarHelper::cancel('cancelEditCategory');
		//JToolBarHelper::spacer();
		//JToolBarHelper::endTable();
	}
	function _DEFAULTCATEGORIES() {
        JToolBarHelper::title( 'Categories Menu', 'generic.png' );
		//JToolBarHelper::title( 'Themes Menu', 'generic.png' );
		/*if (is_callable(array('mosMenuBar', 'addNewX'))) {
			JToolBarHelper::addNewX('newCategory');
        } else { 
			JToolBarHelper::addNewX('newCategory');
		}*/
        JToolBarHelper::addNewX('newCategory');
		//JToolBarHelper::publishList();
        JToolBarHelper::publishList();
		//JToolBarHelper::unpublishList();
        JToolBarHelper::unpublishList();
		/*if (is_callable(array('mosMenuBar', 'editListX'))) {
			JToolBarHelper::editListX('editCategory');
        } else { 
			JToolBarHelper::editList('editCategory');
		}*/
        JToolBarHelper::editListX('editCategory');
		//JToolBarHelper::deleteList('','deleteCategories');
        JToolBarHelper::deleteList('','deleteCategories');
		////JToolBarHelper::spacer();
        //JToolBarHelper::custom('cancel', 'cancel.png', 'cancel_f2.png', 'Cancel', false);
        JToolBarHelper::custom('cancel', 'cancel.png', 'cancel_f2.png', 'Cancel', false);
		////JToolBarHelper::endTable();
	}
}

?>