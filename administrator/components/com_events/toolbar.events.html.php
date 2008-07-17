<?php
/**
 * Events Component for Joomla 1.5.x
 *
 * @version     $Id: toolbar.events.html.php 949 2008-02-09 14:48:57Z tstahl $
 * @package     Events
 * @copyright   Copyright (C) 2006-2007 JEvents Project Group
 * @copyright   Copyright (C) 2000 - 2003 Eric Lamette, Dave McDonnell
 * @licence     http://www.gnu.org/copyleft/gpl.html
 * @link        http://joomlacode.org/gf/project/jevents
 */

defined( '_JEXEC' ) or die( 'Restricted access' );

Class menuEvents {
	function title($text=""){
		JToolBarHelper::title( JText::_( $text ), 'jevents.png' );
	}
	
	function CONF_MENU() {
		
		menuEvents::title('Configuration' );
		JToolBarHelper::spacer();
		JToolBarHelper::save( 'saveconfig' );
		JToolBarHelper::cancel( 'cancelconfig' );
		JToolBarHelper::spacer();
		JToolBarHelper::custom( 'cpanel', 'default.png', 'default.png', _CAL_LANG_ADMIN_CPANEL, false );
		
	}

	function MINIMAL_MENU(){
		menuEvents::title('' );		
		JToolBarHelper::custom( 'cpanel', 'default.png', 'default.png', _CAL_LANG_ADMIN_CPANEL, false );
						
	}
	
	function CPANEL_MENU(){
		menuEvents::title('Control Panel' );
		JToolBarHelper::spacer();
				
	}
	
	function NEW_MENU() {
		menuEvents::title('New Event' );
		JToolBarHelper::save();
		JToolBarHelper::cancel("viewEvents");
		JToolBarHelper::spacer();
		
	}

	function EDIT_MENU() {
		menuEvents::title('Edit Event' );
		JToolBarHelper::save();
		JToolBarHelper::cancel("cancel");
		if (file_exists(dirname(__FILE__).'/help/screen.jevent.edit_new_' . _CAL_LANG_LNG . '.html')) {
			JToolBarHelper::help( 'screen.jevent.edit_new_' . _CAL_LANG_LNG . '.html', true );
		}
		JToolBarHelper::spacer();
		
	}

	function EDIT_VEVENT_MENU() {
		menuEvents::title('Edit Ical Event' );
		JToolBarHelper::save('saveIcalEvent');
		JToolBarHelper::cancel("iCalevents");
		if (file_exists(dirname(__FILE__).'/help/screen.jevent.edit_new_' . _CAL_LANG_LNG . '.html')) {
			JToolBarHelper::help( 'screen.jevent.edit_new_' . _CAL_LANG_LNG . '.html', true );
		}
		JToolBarHelper::spacer();
		
	}

	function EDIT_VEVENT_REPEAT_MENU() {
		menuEvents::title('Edit Ical Event Repeat' );
		JToolBarHelper::save('saveIcalRepeat');
		JToolBarHelper::cancel("icalrepeats");
		if (file_exists(dirname(__FILE__).'/help/screen.jevent.edit_new_' . _CAL_LANG_LNG . '.html')) {
			JToolBarHelper::help( 'screen.jevent.edit_new_' . _CAL_LANG_LNG . '.html', true );
		}
		JToolBarHelper::spacer();
		
	}

	function VIEWARCHIV_MENU() {
		menuEvents::title('view Archive' );
		JToolBarHelper::editList();
		JToolBarHelper::deleteList();
		JToolBarHelper::unarchiveList();
		JToolBarHelper::custom( 'cpanel', 'default.png', 'default.png',_CAL_LANG_ADMIN_CPANEL, false );
		
	}
	
	function ICAL_MENU(){
		menuEvents::title('Manage Ical Events' );

		JToolBarHelper::custom( 'icalrepeats', 'copy.png', 'copy.png', "Repeats", false );
		JToolBarHelper::publishList('publishical');
		JToolBarHelper::unpublishList('unpublishical');
		JToolBarHelper::addNew('newIcalEvent');
		JToolBarHelper::editList('editIcalEvent');
		JToolBarHelper::deleteList('delete','deleteicalEvent');
		JToolBarHelper::spacer();
		JToolBarHelper::custom( 'cpanel', 'default.png', 'default.png', _CAL_LANG_ADMIN_CPANEL, false );
				
	}

	function ICAL_REPEATS_MENU(){
		menuEvents::title('Ical Event Repeats' );
		JToolBarHelper::editList('editIcalRepeat');
		JToolBarHelper::deleteList('delete','deleteicalRepeat');
		JToolBarHelper::spacer();
		JToolBarHelper::custom( 'cpanel', 'default.png', 'default.png', _CAL_LANG_ADMIN_CPANEL, false );
						
	}
	
	function ICS_MENU(){
		menuEvents::title('ICal Subscriptions' );
		
		JToolBarHelper::custom( 'refreshical', 'refresh.png', 'refresh.png', _CAL_LANG_ADMIN_REFRESH, true );
		JToolBarHelper::publishList('publishics');
		JToolBarHelper::unpublishList('unpublishics');
		JToolBarHelper::addNew('newIcalCalendar');
		JToolBarHelper::editList('editics');
		JToolBarHelper::deleteList('\nThis will delete all associated events too','deleteics');
		JToolBarHelper::spacer();
		JToolBarHelper::custom( 'cpanel', 'default.png', 'default.png', _CAL_LANG_ADMIN_CPANEL, false );
				
	}

    function EDITICS_MENU() {
		menuEvents::title('Edit Ical Subscription' );
		JToolBarHelper::save('saveics');
		JToolBarHelper::cancel('iCalsubs');
		JToolBarHelper::spacer();
		    	
    }
    
	function EDITICAL_MENU() {
		menuEvents::title('Edit Ical Calendar' );
		JToolBarHelper::save('saveical');
		JToolBarHelper::cancel('iCalevents');
		JToolBarHelper::spacer();
		
	}

	function CATEGORIES_MENU() {
		menuEvents::title('Categories' );
		JToolBarHelper::publishList('publishCategory');
		JToolBarHelper::unpublishList('unpublishCategory');
		JToolBarHelper::addNew('editCategory');
		JToolBarHelper::editList('editCategory');
		JToolBarHelper::deleteList('','deleteCategory');
		JToolBarHelper::spacer();
		JToolBarHelper::custom( 'cpanel', 'default.png', 'default.png', _CAL_LANG_ADMIN_CPANEL, false );
		
	}

	function EDIT_CATEGORY_MENU(){
		menuEvents::title('Edit Category' );
		JToolBarHelper::save("saveCategory");
		JToolBarHelper::cancel("categories");
		JToolBarHelper::spacer();
				
	}
	

	
	function DEFAULT_MENU() {
		menuEvents::title('Events' );
		JToolBarHelper::publishList();
		JToolBarHelper::unpublishList();
		JToolBarHelper::addNew();
		JToolBarHelper::editList();
		JToolBarHelper::custom( 'clone', 'copy.png', 'copy.png', _CAL_LANG_ADMIN_COPY, true );
		JToolBarHelper::custom( 'cloneedit', 'copy.png', 'copy.png', _CAL_LANG_ADMIN_COPYEDIT, true );
		JToolBarHelper::deleteList();
		JToolBarHelper::archiveList();
		JToolBarHelper::spacer();
		JToolBarHelper::custom( 'cpanel', 'default.png', 'default.png', _CAL_LANG_ADMIN_CPANEL, false );
		
	}
}
?>
