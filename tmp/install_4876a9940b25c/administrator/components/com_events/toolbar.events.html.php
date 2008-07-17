<?php
/**
 * Events Component for Joomla 1.0.x
 *
 * @version     $Id: toolbar.events.html.php 1102 2008-05-22 06:11:59Z tstahl $
 * @package     Events
 * @copyright   Copyright (C) 2006-2008 JEvents Project Group
 * @copyright   Copyright (C) 2000 - 2003 Eric Lamette, Dave McDonnell
 * @licence     http://www.gnu.org/copyleft/gpl.html
 * @link        http://joomlacode.org/gf/project/jevents
 */

defined( '_VALID_MOS' ) or die( 'No Direct Access' );

Class menuEvents {
	function CONF_MENU() {
		mosMenuBar::startTable();
		mosMenuBar::spacer();
		mosMenuBar::save( 'saveconfig' );
		mosMenuBar::cancel( 'cancelconfig' );
		mosMenuBar::spacer();
		mosMenuBar::endTable();
	}

	function NEW_MENU() {
		mosMenuBar::startTable();
		
		// TODO use preview together with apply button
		//mosMenuBar::preview( 'contentwindow' );
		mosMenuBar::save();
		//mosMenuBar::media_manager();
		mosMenuBar::cancel();
		mosMenuBar::spacer();
		mosMenuBar::endTable();
	}

	function EDIT_MENU() {
		mosMenuBar::startTable();
		
		// TODO use preview together with apply button
		//mosMenuBar::preview( 'contentwindow' );
		mosMenuBar::save();
		//mosMenuBar::media_manager();
		mosMenuBar::cancel();
		if (file_exists(dirname(__FILE__).'/help/screen.jevent.edit_new_' . _CAL_LANG_LNG . '.html')) {
			mosMenuBar::help( 'screen.jevent.edit_new_' . _CAL_LANG_LNG . '.html', true );
		}
		mosMenuBar::spacer();
		mosMenuBar::endTable();
	}

	function VIEWARCHIV_MENU() {
		mosMenuBar::startTable();
		mosMenuBar::editList();
		mosMenuBar::deleteList();
		mosMenuBar::unarchiveList();
		mosMenuBar::endTable();
	}

	function CATEGORIES_MENU() {
		mosMenuBar::startTable();
		mosMenuBar::publishList();
		mosMenuBar::unpublishList();
		mosMenuBar::addNew();
		mosMenuBar::editList();
		mosMenuBar::deleteList();
		mosMenuBar::spacer();
		mosMenuBar::endTable();
	}
	function DEFAULT_MENU() {
		mosMenuBar::startTable();
		mosMenuBar::publishList();
		mosMenuBar::unpublishList();
		mosMenuBar::addNew();
		mosMenuBar::editList();
		mosMenuBar::deleteList();
		mosMenuBar::archiveList();
		mosMenuBar::spacer();
		mosMenuBar::endTable();
	}
}
?>
