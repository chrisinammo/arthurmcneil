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

This program is free software; you can redistribute it and/or modify 
it under the terms of the GNU General Public License as published by 
the Free Software Foundation; either version 2 of the License, or 
(at your option) any later version.

This header must not be removed. Additional contributions/changes
may be added to this header as long as no information is deleted.
**********************************************

$File: toolbar.jcalpro.php $

Revision date: 02/20/2007

**********************************************
Get the latest version of JCal Pro at:
http://dev.anything-digital.com//
**********************************************
*/

/** ensure this file is being included by a parent file */
defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );

require_once( $mainframe->getPath( 'toolbar_html' ) );

$element = JRequest::getVar( 'element', '', $_REQUEST );
$section = JRequest::getVar( 'section', '', $_REQUEST );

switch ( $section ) 
{
	case "events" : 
	{
		switch ( $task ) 
		{
			case "edit":
			case "editA":
				TOOLBAR_extcalendar::EDIT_EVENTS_MENU ();
			break;

			case "new":
				TOOLBAR_extcalendar::EDIT_EVENTS_MENU ();
			break;

			case "show" :
			default :
				TOOLBAR_extcalendar::EVENTS_MENU ();
		} 
	} 
  break;
}

switch ($task) {
	case 'themes':
	case 'showthemes':
	case 'cancelaccess':	
		TOOLBAR_extcalendar::_THEMES();
	break;
	
	case 'newtheme':
	case 'edittheme':
	case 'editthemeA':
		TOOLBAR_extcalendar::_EDIT_THEMES();
	break;
	
	case 'canceledit':
		TOOLBAR_extcalendar::_THEMES();
	break;
	
	case 'install':
		TOOLBAR_extcalendar::_INSTALL( $element );
	break;
	

	case 'newCategory':
		TOOLBAR_extcalendarCategories::_EDITCATEGORY();
		break;

	case 'editCategory':
		TOOLBAR_extcalendarCategories::_EDITCATEGORY();
		break;

	case 'saveCategory':
		TOOLBAR_extcalendarCategories::_DEFAULTCATEGORIES();
		break;

	case 'showCategories':
	case 'cancelEditCategory':
		TOOLBAR_extcalendarCategories::_DEFAULTCATEGORIES();
		break;

	case 'editSettings':
		TOOLBAR_extcalendar::_EDIT();
		break;

	case 'saveSettings':
		TOOLBAR_extcalendar::_DEFAULT();
		break;
		
	case 'import':
		TOOLBAR_extcalendar::_IMPORT();
	break;
	
	case 'about':
		TOOLBAR_extcalendar::_ABOUT();
	break;
	
	case 'documentation':
		TOOLBAR_extcalendar::_DOCUMENTATION();
	break;
	}
	

?>