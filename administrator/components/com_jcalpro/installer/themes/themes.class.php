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

This file is based on mambot.class.php v393 (2005-10-08) by akede.

This program is free software; you can redistribute it and/or modify 
it under the terms of the GNU General Public License as published by 
the Free Software Foundation; either version 2 of the License, or 
(at your option) any later version.

This header must not be removed. Additional contributions/changes
may be added to this header as long as no information is deleted.
**********************************************

$File: themes.class.php $

Revision date: 02/20/2007

**********************************************
Get the latest version of JCal Pro at:
http://dev.anything-digital.com//
**********************************************
*/

/** ensure this file is being included by a parent file */
defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );

/**
* Module installer
* @package Joomla
* @subpackage Installer
*/
class EXTCALThemeInstaller extends mosInstaller {
	/**
	* Custom install method
	* @param boolean True if installing from directory
	*/
	function install( $p_fromdir = null ) {
		global $mosConfig_absolute_path, $database;

		if (!$this->preInstallCheck( $p_fromdir, 'jcalprotheme' )) {
			return false;
		}

		$xmlDoc 	= $this->xmlDoc();
		$mosinstall =& $xmlDoc->documentElement;

		// Set some vars
		$e = &$mosinstall->getElementsByPath( 'name', 1 );
		$this->elementName( $e->getText() );

		$folder = $mosinstall->getAttribute( 'theme' );
		$this->elementDir( mosPathName( $mosConfig_absolute_path . '/components/com_jcalpro/themes/' . $folder ) );

		if(!file_exists($this->elementDir()) && !mosMakePath($this->elementDir())) {
			$this->setError( 1, 'Failed to create directory "' . $this->elementDir() . '"' );
			return false;
		}

		if ($this->parseFiles( 'files', 'theme', 'No file is marked as theme file' ) === false) {
			return false;
		}

		// Insert mambot in DB
		$query = "SELECT id"
		. "\n FROM #__jcalpro_themes"
		. "\n WHERE theme = '" . $this->elementName() . "'"
		;
		$database->setQuery( $query );
		if (!$database->query()) {
			$this->setError( 1, 'SQL error: ' . $database->stderr( true ) );
			return false;
		}

		$id = $database->loadResult();
			
		if (!$id) {
			$row = new extcalthemes( $database );

			$row->name 		= $this->elementName();
			$row->theme 	= $folder;

			$element = &$mosinstall->getElementsByPath( 'icon', 1 );
			$row->icon = $element ? $element->getText() : '';

			$element = &$mosinstall->getElementsByPath( 'layout_icon', 1 );

			$row->type = 'theme';
			$row->published = 0;
			$row->editable = 1;

			$element = &$mosinstall->getElementsByPath( 'elements', 1 );
			$row->elements = $element ? $element->getText() : '';

			$row->iscore = 0;

			if (!$row->store()) {
				$this->setError( 1, 'SQL error: ' . $row->getError() );
				return false;
			}
		} else {
			$this->setError( 1, 'Theme "' . $this->elementName() . '" already exists!' );
			return false;
		}
		if ($e = &$mosinstall->getElementsByPath( 'description', 1 )) {
			$this->setError( 0, $this->elementName() . '<p>' . $e->getText() . '</p>' );
		}

		return $this->copySetupFile('front');
	}
	/**
	* Custom install method
	* @param int The id of the module
	* @param string The URL option
	* @param int The client id
	*/
	function uninstall( $id, $option, $client=0 ) {
		global $database, $mosConfig_absolute_path;

		$id = intval( $id );
		$query = "SELECT name, theme, iscore"
		. "\n FROM #__jcalpro_themes"
		. "\n WHERE id = $id"
		;
		$database->setQuery( $query );

		$row = null;
		$database->loadObject( $row );
		if ($database->getErrorNum()) {
			HTML_installer::showInstallMessage( $database->stderr(), 'Uninstall -  error',
			$this->returnTo( $option, 'install&element=themes', $client ) );
			exit();
		}
		if ($row == null) {
			HTML_installer::showInstallMessage( 'Invalid object id', 'Uninstall -  error',
			$this->returnTo( $option, 'install&element=themes', $client ) );
			exit();
		}

		if (trim( $row->theme ) == '') {
			HTML_installer::showInstallMessage( 'Folder field empty, cannot remove files', 'Uninstall -  error',
			$this->returnTo( $option, 'install&element=themes', $client ) );
			exit();
		}

		$basepath 	= $mosConfig_absolute_path . '/components/com_jcalpro/themes/' . $row->theme . '/';
		$xmlfile 	= $basepath . $row->theme . '.xml';

		// see if there is an xml install file, must be same name as element
		if (file_exists( $xmlfile )) {
			$this->i_xmldoc = new DOMIT_Lite_Document();
			$this->i_xmldoc->resolveErrors( true );

			if ($this->i_xmldoc->loadXML( $xmlfile, false, true )) {
				$mosinstall =& $this->i_xmldoc->documentElement;
				// get the files element
				$files_element =& $mosinstall->getElementsByPath( 'files', 1 );
				if (!is_null( $files_element )) {
					$files = $files_element->childNodes;
					foreach ($files as $file) {
						// delete the files
						$filename = $file->getText();
						if (file_exists( $basepath . $filename )) {
							$parts = pathinfo( $filename );
							$subpath = $parts['dirname'];
							if ($subpath != '' && $subpath != '.' && $subpath != '..') {
								echo '<br />Deleting: '. $basepath . $subpath;
								$result = deldir(mosPathName( $basepath . $subpath . '/' ));
							} else {
								echo '<br />Deleting: '. $basepath . $filename;
								$result = unlink( mosPathName ($basepath . $filename, false));
							}
							echo intval( $result );
						}
					}

					// remove XML file from front
					echo "Deleting XML File: $xmlfile";
					@unlink(  mosPathName ($xmlfile, false ) );

					// define folders that should not be removed
					$sysFolders = array(
						'content',
						'search'
					);
					if (!in_array( $row->folder, $sysFolders )) {
						// delete the non-system folders if empty
						if (count( mosReadDirectory( $basepath ) ) < 1) {
							deldir( $basepath );
						}
					}
				}
			}
		}

		if ($row->iscore) {
			HTML_installer::showInstallMessage( $row->name .' is a core element, and cannot be uninstalled.<br />You need to unpublish it if you don\'t want to use it',
			'Uninstall -  error', $this->returnTo( $option, 'install&element=themes', $client ) );
			exit();
		}

		$query = "DELETE FROM #__jcalpro_themes"
		. "\n WHERE id = $id"
		;
		$database->setQuery( $query );
		if (!$database->query()) {
			$msg = $database->stderr;
			die( $msg );
		}
		return true;
	}
}
?>
