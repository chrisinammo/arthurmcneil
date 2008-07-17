<?php
/**
 * Events Component for Joomla 1.5.x
 *
 * @version     $Id: toolbar.events.php 909 2007-11-24 10:52:36Z geraint $
 * @package     Events
 * @copyright   Copyright (C) 2006-2007 JEvents Project Group
 * @copyright   Copyright (C) 2000 - 2003 Eric Lamette, Dave McDonnell
 * @licence     http://www.gnu.org/copyleft/gpl.html
 * @link        http://joomlacode.org/gf/project/jevents
 */

defined( '_JEXEC' ) or die( 'Restricted access' );

require_once( $mainframe->getPath( 'toolbar_html' ) );
require_once( $mainframe->getPath( 'toolbar_default' ) );

switch( $task ) {
	case 'conf':
	case 'missingconf':
	case 'missingcss':
		menuEvents::CONF_MENU();
		break;
	case 'cpanel':
		menuEvents::CPANEL_MENU();
		break;

	case 'refreshical':
	case 'iCalsubs':
		menuEvents::ICS_MENU();
		break;

	case 'saveical':
	case 'iCalevents':
		menuEvents::ICAL_MENU();
		break;

	case 'icalrepeats':
		menuEvents::ICAL_REPEATS_MENU();
		break;
		
	case 'editIcalRepeat':
		menuEvents::EDIT_VEVENT_REPEAT_MENU();
		break;
			
	case 'newIcalCalendar':
	case 'newics':
	case 'editics':
		menuEvents::EDITICS_MENU();
		break;

	case 'newical':
	case 'editical':
		menuEvents::EDITICAL_MENU();
		break;

	case 'add':
		menuEvents::NEW_MENU();
		break;

	case 'newIcalEvent':
	case 'editIcalEvent':
	case 'editical':
		menuEvents::EDIT_VEVENT_MENU();
		break;

	case 'edit':
		menuEvents::EDIT_MENU();
		break;

	case 'viewarchiv':
		menuEvents::VIEWARCHIV_MENU();
		break;

	case 'exportToIcal':
	case 'convertExtCal':
	case 'migrate':
	case 'checkLocale':
		menuEvents::MINIMAL_MENU();
		break;

	case 'categories':
	case 'saveCategory':
	case 'deleteCategory':
		menuEvents::CATEGORIES_MENU();
		break;
	
	case 'editCategory':
		menuEvents::EDIT_CATEGORY_MENU();
		break;
		
		
	default:
		menuEvents::DEFAULT_MENU();
		break;
}
?>
