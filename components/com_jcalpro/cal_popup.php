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

$File: cal_popup.php - Calendar popup$

Revision date: 02/20/2007

**********************************************
Get the latest version of JCal Pro at:
http://dev.anything-digital.com//
**********************************************
*/

/** Set flag that this is a parent file */
define( '_JEXEC', 1 );

// checks for configuration file, if none found loads installation page
if ( !file_exists( '../../configuration.php' ) || filesize( '../../configuration.php' ) < 10 ) {
	header( 'Location: installation/index.php' );
	exit();
}

include_once( '../../globals.php' );
require_once( '../../configuration.php' );

// Now we have to set the PHP include path because the sef.php Search-Engine-Friendly class includes
// the "configuration.php" file and if Search-Engine-Friendly URLs are turned on in Administration
// the include it won't be found unless we do this.
$thisWebServer = strtolower($_SERVER['SERVER_SOFTWARE']);
if ( ( strpos($thisWebServer,'nix') !== FALSE ) || ( strpos($thisWebServer,'nux') !== FALSE ) || ( strpos($thisWebServer,'apache') !== FALSE ) ) {
	// UNIX/Linux servers use a colon (according to the manual, anyway)
	ini_set('include_path','.:'.$mosConfig_absolute_path);
} else {
	// Windows servers use a semicolon
	ini_set('include_path','.;'.$mosConfig_absolute_path);
}

// displays offline page
if ( $mosConfig_offline == 1 ){
	include( '../../offline.php' );
	exit();
}

require_once( '../../includes/mambo.php' );
if (file_exists( '../../components/com_sef/sef.php' )) {
	require_once( '../../components/com_sef/sef.php' );
} else {
	require_once( '../../includes/sef.php' );
}
require_once( '../../includes/frontend.php' );

/*
Installation sub folder check, removed for work with CVS*/
if (file_exists( '../../installation/index.php' )) {
	include ('../../offline.php');
	exit();
}
/**/
/** retrieve some expected url (or form) arguments */
$option = "com_jcalpro";
$database = new database( $mosConfig_host, $mosConfig_user, $mosConfig_password, $mosConfig_db, $mosConfig_dbprefix );
$database->debug( $mosConfig_debug );
$acl = new gacl_api();

/** mainframe is an API workhorse, lots of 'core' interaction routines */
$mainframe = new mosMainFrame( $database, $option, '../../' );
$mainframe->initSession();

// loads english language file by default
if ( $mosConfig_lang == '' ) {
	$mosConfig_lang = 'english';
}
include_once ( '../../language/'.$mosConfig_lang.'.php' );

// frontend login & logout controls
$return = mosGetParam( $_REQUEST, 'return', NULL );
$message = mosGetParam( $_POST, 'message', 0 );

/** get the information about the current user from the sessions table */
$my = $mainframe->getUser();

/** detect first visit */
$mainframe->detect();

$gid = intval( $my->gid );

/** @global A places to store information from processing of the component */
$_MOS_OPTION = array();

// precapture the output of the component
require_once( $mosConfig_absolute_path . '/editor/editor.php' );

ob_start();

/*  if ($path = $mainframe->getPath( 'front' )) {
	$task = mosGetParam( $_REQUEST, 'task', '' );
	$ret = mosMenuCheck( $Itemid, $option, $task, $gid );
	if ($ret) {
		require_once( $path );
	} else {
		mosNotAuth();
	}
} else {
	echo _NOT_EXIST;
}  */

####################################PAGE CONTENT:

require_once( $mosConfig_absolute_path."/components/com_jcalpro/config.inc.php" );
$extid = $_GET['extid'];

$approved = has_priv('approve')?"":"AND approved = '1'";

	$event = new ExtCal_Event();
  if (!$event->loadEvent($extid)) { 
		$sef_href = JRoute::_( $CONFIG_EXT['calendar_calling_page'] );
		theme_redirect_dialog($lang_system['system_caption'], $lang_system['non_exist_event'], $lang_general['back'], $sef_href);
  } else 
  {
		// additional field processing
		$event->title = format_text($event->title,false,$CONFIG_EXT['capitalize_event_titles']);
		$event->description = process_content(format_text($event->description,true,false));

		popup_pageheader($row['title']);
		theme_view_event($event,true);
	}
 	
 	if(isset($_GET['print'])) { ?>

<script language="JavaScript" type="text/JavaScript">
<!--
	printDocument();
//-->
</script>

<?php
	}
	popup_pagefooter();
	
####################################:PAGE CONTENT

$_MOS_OPTION['buffer'] = ob_get_contents();
ob_end_clean();

initGzip();

header( 'Expires: Mon, 26 Jul 1997 05:00:00 GMT' );
header( 'Last-Modified: ' . gmdate( 'D, d M Y H:i:s' ) . ' GMT' );
header( 'Cache-Control: no-store, no-cache, must-revalidate' );
header( 'Cache-Control: post-check=0, pre-check=0', false );
header( 'Pragma: no-cache' );

echo $_MOS_OPTION['buffer'];

// displays queries performed for page
if ($mosConfig_debug) {
	echo $database->_ticker . ' queries executed';
	echo '<pre>';
 	foreach ($database->_log as $k=>$sql) {
 	    echo $k+1 . "\n" . $sql . '<hr />';
	}
}

doGzip();

#############################################
// Imported stuff from Mambo index.php
#############################################


?>