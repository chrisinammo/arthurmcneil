<?php
/**
 * Events Component for Joomla 1.0.x
 *
 * @version     $Id: toolbar.events.php 1072 2008-05-01 17:08:57Z tstahl $
 * @package     Events
 * @copyright   Copyright (C) 2006-2008 JEvents Project Group
 * @copyright   Copyright (C) 2000 - 2003 Eric Lamette, Dave McDonnell
 * @licence     http://www.gnu.org/copyleft/gpl.html
 * @link        http://joomlacode.org/gf/project/jevents
 */

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

require_once( $mainframe->getPath( 'toolbar_html' ) );
require_once( $mainframe->getPath( 'toolbar_default' ) );
global $act;
switch ( $act ) {
    case 'conf':
    case 'missingconf':
    case 'missingcss':
        menuEvents::CONF_MENU();
        break;

    default:
        switch( $task ) {
            case 'new':
                menuEvents::NEW_MENU();
                break;

            case 'edit':
                menuEvents::EDIT_MENU();
                break;
            
            case 'viewarchiv':
                menuEvents::VIEWARCHIV_MENU();
                break;

            default:
				if ($act == 'categories') {
					menuEvents::CATEGORIES_MENU();
				} else {
                	menuEvents::DEFAULT_MENU();
				}
                break;
    }
}
?>
