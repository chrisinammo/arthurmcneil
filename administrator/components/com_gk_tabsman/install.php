<?php

/**
*
*
*	Copyright by Gavick.com (c) 2008. All rights reserved.
*
*
**/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

function BackToInstall($e){echo '<script> alert("'.$e.'");window.history.go(-1);</script>';exit();}

function com_install() {
	$database = & JFactory::getDBO();
	
	echo "<h2>Tabs Manager GK1</h2>";
	
	$database->setQuery( 'UPDATE #__components SET admin_menu_img = "../administrator/components/com_gk_tabsman/com_icon.png" WHERE name = "Gavick Tabs Manager" AND `option` = "com_gk_tabsman"');
	if (!$database->query()) BackToInstall($database->getErrorMsg());
	
	echo "<h3></h3>";
	
	$database->setQuery( 'UPDATE #__components SET link = "option=com_gk_tabsman" WHERE name = "Gavick Tabs Manager" AND `option` = "com_gk_tabsman"');
	if (!$database->query()) BackToInstall($database->getErrorMsg());
	
	echo '<h1>The Gavick Tabs Manager Component by <a href="http://gavick.com">Gavick.com</a> has installed successfully!</h1>'; 
}
?>