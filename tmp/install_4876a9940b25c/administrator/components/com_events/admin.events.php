<?php
/**
 * Events Component for Joomla 1.0.x
 *
 * @version     $Id: admin.events.php 945 2008-02-06 16:46:15Z tstahl $
 * @package     Events
 * @copyright   Copyright (C) 2006 JEvents Project Group
 * @copyright   Copyright (C) 2000 - 2003 Eric Lamette, Dave McDonnell
 * @licence     http://www.gnu.org/copyleft/gpl.html
 * @link        http://joomlacode.org/gf/project/jevents
 */

defined( '_VALID_MOS' ) or die( 'No Direct Access' );

// dmcd May 7/04 fix for accessing registered categories in backend
global $gid;
$gid = $my->gid;

//require_once("includes/auth.php");
// require_once( $mosConfig_absolute_path . '/components/' . $option . '/events.class.php' ); // old [mic]

// setup for all required function and classes
require_once(mosMainFrame::getBasePath() . 'components/com_events/includes/adminutils.php');

$cfg = & EventsConfig::getInstance();
global $act;
$act	= mosGetParam( $_REQUEST,		'act', 		"" );
$cid	= mosGetParam( $_REQUEST,		'cid', 		array(0) );
$option = mosGetParam( $_REQUEST, 	'option', 	'com_events' );
//$sectionid = mosGetParam( $_REQUEST, 'sectionid', 0 );

// load frontend language constants
EventsHelper::loadLanguage('front');

// load backend language constants
EventsHelper::loadLanguage('admin');


// dmcd May 20/04, new files to handle event categories due to further
// customization beyond MOS core.  Therefore I have split up the file
// to include only the necessary code.
$pathCom = $mosConfig_absolute_path  . '/administrator/components/com_events/';
if( $act == 'categories' ){
	require_once( $pathCom . 'admin.events.categories.php' );
}else{
	require_once( $pathCom . 'admin.events.main.php' );
}
?>


