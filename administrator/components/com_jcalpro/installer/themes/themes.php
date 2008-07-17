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

This file is based on mambot.php v328 (2005-10-02) by Jinx.

This program is free software; you can redistribute it and/or modify 
it under the terms of the GNU General Public License as published by 
the Free Software Foundation; either version 2 of the License, or 
(at your option) any later version.

This header must not be removed. Additional contributions/changes
may be added to this header as long as no information is deleted.
**********************************************

$File: themes.php $

Revision date: 02/20/2007

**********************************************
Get the latest version of JCal Pro at:
http://dev.anything-digital.com//
**********************************************
*/

/** ensure this file is being included by a parent file */
defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );

require_once( JPATH_COMPONENT_ADMINISTRATOR. DS . 'installer' . DS . 'themes' . DS . 'themes.html.php' );
jimport('joomla.filesystem.path');

$mosConfig_absolute_path = JPATH_BASE;
$database = &JFactory::getDBO();

//$database->setQuery( "SELECT lang FROM #__jcalpro_langs WHERE published= '1'" );
//$lang = $database->loadResult();
//require_once( $mosConfig_absolute_path."/administrator/components/com_jcalpro/language/".$lang.".php" );

HTML_installer::showInstallForm( _EXTCAL_THEMES_INSTALL_HEADING, $option, 'themes', '', dirname(__FILE__) );
?>
<table class="content">
<?php
writableCell( 'components/com_jcalpro/themes' );
?>
</table>
<?php
showInstalledThemes( $option );

function showInstalledThemes( $_option ) {
	$mosConfig_absolute_path = JPATH_BASE;
    $database = &JFactory::getDBO();

	$query = "SELECT id, name, theme, client_id"
	. "\n FROM #__jcalpro_themes"
	. "\n WHERE iscore = 0 AND type = 'theme'"
	. "\n ORDER BY theme, name"
	;
	
	$database->setQuery( $query );
	$rows = $database->loadObjectList();

	// path to themes directory
	$mambotBaseDir	= JPATH::clean( JPATH::clean( $mosConfig_absolute_path ) . "components" . DS . "com_jcalpro" . DS . "themes" );
    $xmlfile = '';
	$id = 0;
	$n = count( $rows );
	for ($i = 0; $i < $n; $i++) {
		$row =& $rows[$i];
		// xml file for module
		$xmlfile = $mambotBaseDir. "/" .$row->theme . '/' . $row->theme .".xml";

		if (file_exists( $xmlfile )) {
			$xmlDoc = new DOMIT_Lite_Document();
			$xmlDoc->resolveErrors( true );
			if (!$xmlDoc->loadXML( $xmlfile, false, true )) {
				continue;
			}

			$root = &$xmlDoc->documentElement;

			if ($root->getTagName() != 'mosinstall') {
				continue;
			}
			if ($root->getAttribute( "type" ) != "jcalprotheme") {
				continue;
			}

			$element 			= &$root->getElementsByPath('creationDate', 1);
			$row->creationdate 	= $element ? $element->getText() : '';

			$element 			= &$root->getElementsByPath('author', 1);
			$row->author 		= $element ? $element->getText() : '';

			$element 			= &$root->getElementsByPath('copyright', 1);
			$row->copyright 	= $element ? $element->getText() : '';

			$element 			= &$root->getElementsByPath('authorEmail', 1);
			$row->authorEmail 	= $element ? $element->getText() : '';

			$element 			= &$root->getElementsByPath('authorUrl', 1);
			$row->authorUrl 	= $element ? $element->getText() : '';

			$element 			= &$root->getElementsByPath('version', 1);
			$row->version 		= $element ? $element->getText() : '';

		}
  }

	HTML_themes::showInstalledThemes($rows, $_option, $id, $xmlfile );
}
?>
