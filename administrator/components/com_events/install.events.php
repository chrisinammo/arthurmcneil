<?php
/**
 * Events Component for Joomla 1.5.x
 *
 * @version     $Id: install.events.php 958 2008-02-16 10:54:19Z geraint $
 * @package     Events
 * @copyright   Copyright (C) 2006-2007 JEvents Project Group
 * @copyright   Copyright (C) 2000 - 2003 Eric Lamette, Dave McDonnell
 * @licence     http://www.gnu.org/copyleft/gpl.html
 * @link        http://joomlacode.org/gf/project/jevents
 */

/*
* This script use parts of a commercial script by mic [http://www.mgfi.info]
* If you want to use it, be so kind and respect the authors right and ask for permission
**/

defined( '_JEXEC' ) or die( 'Restricted access' );

function com_install() {
	global $mainframe;
	$db	=& JFactory::getDBO();
	$lang =& JFactory::getLanguage();
	$langname = $lang->getBackwardLang();

	// TODO check what value global option variable has at this stage
	$option = "com_events";
	
	$queri		= array();
	$errors 	= array();
	$dataSum	= '';
	$cleaned 	= '';

	// get proper language
	$pathLang 	= JPATH_ADMINISTRATOR . '/components/'.$option.'/language/admin_';
	// tries to get adminlang (if defined - see MGFi www.mgfi.info for more info)

    if( file_exists( $pathLang . $langname . '.php' )) {
    	include( $pathLang . $langname . '.php' );
    } else {
    	include( $pathLang . 'english.php' );
    }

	// Do the clean up if installed on a previous installation
	$query = "SELECT count(id) as count, max(id) as lastInstalled"
	. "\n FROM #__components"
	. "\n WHERE link='option=".$option."'"
	;
    $db->setQuery( $query );
    $reginfo = $db->loadObjectList();
    $lastInstalled = $reginfo[0]->lastInstalled;

    // Check if there are more registered instances of the Events component
    if( $reginfo[0]->count <> '1' ) {
        // Get duplicates
        $query = "SELECT *"
        . "\n FROM #__components"
        . "\n WHERE link='option=".$option."'"
        . "\n AND id!='$lastInstalled'"
        . "\n AND admin_menu_link LIKE 'option=".$option."'"
        ;
        $db->setQuery( $query);
        $toberemoved = $db->loadObjectList();

        foreach( $toberemoved as $remid ){
            // Delete duplicate entries
            $query = "DELETE FROM #__components"
            . "\n WHERE id='$remid->id'"
            . "\n OR parent='$remid->id'"
            ;
            $db->setQuery( $query );
            $db->query();

            $cleaned++;
            $dataSum++;
        }
    }
/*
	// set correct language entries for menus
		// main entry
	$queri[] = "UPDATE #__components SET name = '" . _CAL_LANG_INSTAL_MAIN . "' WHERE link = 'option=".$option."'";
	$queri[] = "UPDATE #__components SET admin_menu_alt = '" . _CAL_LANG_INSTAL_MAIN . "' WHERE link = 'option=".$option."'";
		// archiv
	$queri[] = "UPDATE #__components SET name = '" . _CAL_LANG_INSTAL_ARCHIVE . "' WHERE admin_menu_link = 'option=".$option."&task=viewarchiv'";
	$queri[] = "UPDATE #__components SET admin_menu_alt = '" . _CAL_LANG_INSTAL_ARCHIVE . "' WHERE link = 'option=".$option."&task=viewarchiv'";
		// manage events
	$queri[] = "UPDATE #__components SET name = '" . _CAL_LANG_INSTAL_MANAGE . "' WHERE link = '' AND admin_menu_link = 'option=".$option."'";
	$queri[] = "UPDATE #__components SET admin_menu_alt = '" . _CAL_LANG_INSTAL_MANAGE . "' WHERE link = '' AND admin_menu_link = 'option=".$option."'";
		// categories
	$queri[] = "UPDATE #__components SET name = '" . _CAL_LANG_INSTAL_CATS . "' WHERE admin_menu_link = 'option=".$option."&task=categories'";
	$queri[] = "UPDATE #__components SET admin_menu_alt = '" . _CAL_LANG_INSTAL_CATS . "' WHERE admin_menu_link = 'option=".$option."&task=categories'";
		// config
	$queri[] = "UPDATE #__components SET name = '" . _CAL_LANG_INSTAL_CONFIG . "' WHERE admin_menu_link = 'option=".$option."&task=conf'";
	$queri[] = "UPDATE #__components SET admin_menu_alt = '" . _CAL_LANG_INSTAL_CONFIG . "' WHERE admin_menu_link = 'option=".$option."&task=conf'";

	foreach( $queri AS $query ){
        $db->setQuery( $query );
        if( !$db->query() ) {
            $errors[] = array( $db->getErrorMsg(), $query );
        }else{
            $dataSum++;
        }
    }

    // update images
    $eventsIMG 		= '../administrator/components/'.$option.'/images/events_ico.png';

    $queri[] = "UPDATE #__components SET admin_menu_img='" . $eventsIMG . "' WHERE admin_menu_link = 'option=".$option."'";
    $queri[] = "UPDATE #__components SET admin_menu_img='js/ThemeOffice/trash.png' WHERE admin_menu_link = 'option=".$option."&task=viewarchive'";
	$queri[] = "UPDATE #__components SET admin_menu_img='js/ThemeOffice/categories.png' WHERE admin_menu_link = 'option=".$option."&task=categories'";
	$queri[] = "UPDATE #__components SET admin_menu_img='js/ThemeOffice/config.png' WHERE admin_menu_link = 'option=".$option."&task=conf'";

	foreach( $queri AS $query ){
        $db->setQuery( $query );
        if( !$db->query() ) {
            $errors[] = array( $db->getErrorMsg(), $query );
        }else{
            $dataSum++;
        }
    }
*/
?>
    <div>
        <?php
        if( $errors ){
            echo '<strong style="color:red;">' . _CAL_LANG_INSTAL_ERROR . '</strong>';
            echo '<ul>';
            foreach( $errors AS $error ){
                echo '<li>' . $error[0] . '</li>';
            }
            echo '</ul>';
        }else{
            echo '<strong style="color:green;">' . $dataSum . ' ' . _CAL_LANG_INSTALL_DB_ENTRIES . '</strong>';
        }

        if( $cleaned ){
        	echo '<strong style="color:green;">' . $cleaned . ' ' . _CAL_LANG_INSTALL_PREV_INST . '</strong>';
        } ?>
    </div>

    <div style="text-align:left; float:left;">
    	<?php
    	$path = JPATH_ADMINISTRATOR . '/components/'.$option.'/help/README_';
		$lang = strtok($mainframe->getCfg('locale'), '_');
    	if( file_exists( $path . $lang . '.php' )){
    		include( $path . $lang . '.php' );
    	}else{
    		include( $path . 'en.php' );
    	} ?>
    </div>
    <?php
}
?>
