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

Portions of this install file were inspired by code from 
Events Calendar by Eric Lamette and Dave McDonnell.

This program is free software; you can redistribute it and/or modify 
it under the terms of the GNU General Public License as published by 
the Free Software Foundation; either version 2 of the License, or 
(at your option) any later version.

This header must not be removed. Additional contributions/changes
may be added to this header as long as no information is deleted.
**********************************************

$File: install.jcalpro.php - Install file$

Revision date: 02/20/2007

**********************************************
Get the latest version of JCal Pro at:
http://dev.anything-digital.com//
**********************************************
*/

/** ensure this file is being included by a parent file */
defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );

function com_install() {
//global $mosConfig_absolute_path, $mosConfig_mailfrom, $mosConfig_db, $mosConfig_dbprefix;

$database = & JFactory::getDBO();

$registry =& JFactory::getConfig();
foreach (get_object_vars($registry->toObject()) as $k => $v)
{
    $varname = 'mosConfig_'.$k;
    $$varname = $v;
}


$database->setQuery( "SELECT id FROM #__components WHERE name= 'JCal Pro'" );
$id = $database->loadResult();

$database->setQuery( "UPDATE #__components SET admin_menu_img = '../components/com_jcalpro/images/calendar_icon_16x16.png' WHERE id = '$id'" );
$database->query();
//add new admin menu images
$database->setQuery( "UPDATE #__components SET admin_menu_img = 'js/ThemeOffice/config.png' WHERE parent='$id' AND name = 'Edit Settings'");
$database->query();
$database->setQuery( "UPDATE #__components SET admin_menu_img = 'js/ThemeOffice/categories.png' WHERE parent='$id' AND name = 'Manage Event Categories'");
$database->query();
$database->setQuery( "UPDATE #__components SET admin_menu_img = 'js/ThemeOffice/template.png' WHERE parent='$id' AND name = 'Manage Themes'");
$database->query();
$database->setQuery( "UPDATE #__components SET admin_menu_img = 'js/ThemeOffice/install.png' WHERE parent='$id' AND name = 'Install Themes'");
$database->query();
$database->setQuery( "UPDATE #__components SET admin_menu_img = 'js/ThemeOffice/backup.png' WHERE parent='$id' AND name = 'Import'");
$database->query();
$database->setQuery( "UPDATE #__components SET admin_menu_img = 'js/ThemeOffice/credits.png' WHERE parent='$id' AND name = 'About'");
$database->query();
$database->setQuery( "UPDATE #__components SET admin_menu_img = 'js/ThemeOffice/help.png' WHERE parent='$id' AND name = 'Documentation'");
$database->query();

//add new admin menu links

$database->setQuery( "UPDATE #__components SET admin_menu_link = 'option=com_jcalpro&task=install&element=themes' WHERE parent='$id' AND name = 'Install Themes'");
$database->query();

$database->setQuery( "UPDATE #__components SET admin_menu_link = 'option=com_jcalpro&section=events' WHERE parent='$id' AND name = 'Manage Events'");
$database->query();

// Do the clean up if installed on a previous installation

$database->setQuery("SELECT count(id) as count, max(id) as lastInstalled FROM #__components WHERE name='ExtCal Calendar'");
$reginfo = $database->loadObjectList();
$lastInstalled = $reginfo[0]->lastInstalled;

// Check if there are more registered instances of the ExtCal Calendar component
if ($reginfo[0]->count <> "1") {
	// Get duplicates
	$sql="SELECT * FROM #__components WHERE name='ExtCal Calendar' AND id!='$lastInstalled' AND admin_menu_link LIKE 'option=com_jcalpro'";
	$database->setQuery($sql);
	$toberemoved = $database->loadObjectList();
	foreach ($toberemoved as $remid){
		// Delete duplicate entries
		$database->setQuery("DELETE FROM #__components WHERE id='$remid->id' or parent='$remid->id'");
		$database->query();
	}
}

$sql="UPDATE #__jcalpro_config SET value = '$mosConfig_mailfrom' WHERE name='calendar_admin_email'";
$database->setQuery($sql);
$database->query();


// Add level field to categories table

$updateInstallation1dot5 = FALSE;

$fields = mysql_list_fields ( $mosConfig_db, $mosConfig_dbprefix ."jcalpro_categories" );
$columns = mysql_num_fields ( $fields );

$field_array = array ( );
for ( $i = 0; $i < $columns; $i++ ) 
{ 
	$field_array[] = mysql_field_name ( $fields, $i ); 
}

if ( !in_array ( 'level', $field_array ) )
{
	$query = 'ALTER TABLE ' . $mosConfig_dbprefix . 'jcalpro_categories ADD level varchar(255) AFTER options';
	
	$database->setQuery ( $query );
	$database->query ( );
	
	$updateInstallation1dot5 = TRUE;
}

// Add published, checked_out, checked_out_time field to events table

$fields = mysql_list_fields ( $mosConfig_db, $mosConfig_dbprefix ."jcalpro_events" );
$columns = mysql_num_fields ( $fields );

$field_array = array ( );

for ( $i = 0; $i < $columns; $i++ ) 
{ 
	$field_array[] = mysql_field_name ( $fields, $i ); 
}

if ( !in_array ( 'published', $field_array ) )
{
	$query = 'ALTER TABLE ' . $mosConfig_dbprefix . 'jcalpro_events ADD published tinyint(1)';
	
	$database->setQuery ( $query );
	$database->query ( );
	
	$updateInstallation1dot5 = TRUE;
}

if ( !in_array ( 'checked_out', $field_array ) )
{
	$query = 'ALTER TABLE ' . $mosConfig_dbprefix . 'jcalpro_events ADD checked_out int(11) UNSIGNED';
	
	$database->setQuery ( $query );
	$database->query ( );
	
	$updateInstallation1dot5 = TRUE;
}

if ( !in_array ( 'recur_ord', $field_array ) )
{
    $query = 'ALTER TABLE ' . $mosConfig_dbprefix . 'jcalpro_events ADD recur_ord tinyint(4) DEFAULT 0';
    
    $database->setQuery ( $query );
    $database->query ( );
    
    $updateInstallation1dot5 = TRUE;
}

if ( !in_array ( 'checked_out_time', $field_array ) )
{
	$query = 'ALTER TABLE ' . $mosConfig_dbprefix . 'jcalpro_events ADD checked_out_time datetime';
	
	$database->setQuery ( $query );
	$database->query ( );
	
	$updateInstallation1dot5 = TRUE;
}

if ( $updateInstallation1dot5 == TRUE )
{
	// Set all offers to published after fresh installation
	
	$query = "
		UPDATE 
			#__jcalpro_events
		SET
			published = 1
	";
	
	$database->setQuery ( $query );
	$database->query ( );
}

// Insert sample data, cannot be done in xml file due the ALTER TABLE
$query = "INSERT IGNORE INTO #__jcalpro_categories VALUES (1,0,'General', 'This is the default category', '#000000','#EEF0F0', 2, 'Public Frontend', 1, 0, '0000-00-00 00:00:00')";
	
$database->setQuery ( $query );
$database->query ( );

if (is_dir("../components/com_jcalpro/upload")) chmod("../components/com_jcalpro/upload",0777);
if (is_dir("../components/com_jcalpro/images/minipics")) chmod("../components/com_jcalpro/images/minipics",0777);

// Well done
    echo "Installed Successfully";
    echo "<div align='left'>";
    include ("../components/com_jcalpro/index.html");
    echo "</div>";
}

?>
