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

This file is based on admin.installer.php v328 (2005-10-02) by Jinx.

This program is free software; you can redistribute it and/or modify 
it under the terms of the GNU General Public License as published by 
the Free Software Foundation; either version 2 of the License, or 
(at your option) any later version.

This header must not be removed. Additional contributions/changes
may be added to this header as long as no information is deleted.
**********************************************

$File: installer.php - Install file$

Revision date: 02/20/2007

**********************************************
Get the latest version of JCal Pro at:
http://dev.anything-digital.com//
**********************************************
*/

/** ensure this file is being included by a parent file */
defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );

$registry = & JFactory::getConfig();

// XML library
require_once( JPATH_SITE.DS.'includes'.DS.'domit'.DS.'xml_domit_lite_include.php' );
require_once( JPATH_COMPONENT_ADMINISTRATOR.DS.'installer'.DS.'installer.html.php' );
require_once( JPATH_COMPONENT_ADMINISTRATOR.DS.'installer'.DS.'installer.class.php' );

function extcalInstaller( $option, $client, $opt )
{
    //global JPATH_ROOT;
    
    //$element = mosGetParam( $_REQUEST, 'element', '' );
    $element = JRequest::getVar('element','');
    
    $path = JPATH_COMPONENT_ADMINISTRATOR.DS."installer".DS.$element.DS.$element.".php";

    // map the element to the required derived class
    $classMap = array(
    	'themes' => 'EXTCALThemeInstaller',
    	'language' 	=> 'EXTCALLanguageInstaller'
    );

    if (array_key_exists ( $element, $classMap )) {
    	require_once( JPATH_COMPONENT_ADMINISTRATOR.DS."installer".DS.$element.DS.$element.".class.php" );

    	switch ( $opt ) {

    		case 'uploadfile':
    			uploadPackage( $classMap[$element], $option, $element, $client );
    			break;

    		case 'installfromdir':
    			installFromDirectory( $classMap[$element], $option, $element, $client );
    			break;

    		case 'remove':
    			removeElement( $classMap[$element], $option, $element, $client );
    			break;

    		case 'show':
    			$path = JPATH_COMPONENT_ADMINISTRATOR.DS."installer".DS.$element.DS.$element.".php";

    			if (file_exists( $path )) {
    				require $path;
    			} else {
    				echo "Installer not found for element [$element]";
    			}
    			break;
    	}
    } else {
    	echo "Installer not available for element [$element]";
    }
}

/**
* @param string The class name for the installer
* @param string The URL option
* @param string The element name
*/
function uploadPackage( $installerClass, $option, $element, $client ) {
	$installer = new $installerClass();

	// Check if file uploads are enabled
	if (!(bool)ini_get('file_uploads')) {
		HTML_installer::showInstallMessage( "The installer can't continue before file uploads are enabled. Please use the install from directory method.",
			'Installer - Error', $installer->returnTo( $option, '&task=install&element='.$element, $client ) );
		exit();
	}

	// Check that the zlib is available
	if(!extension_loaded('zlib')) {
		HTML_installer::showInstallMessage( "The installer can't continue before zlib is installed",
			'Installer - Error', $installer->returnTo( $option, '&task=install&element='.$element, $client ) );
		exit();
	}

	//$userfile = JRequest::getVar( $_FILES, 'userfile', null );
    $userfile = JRequest::getVar( 'userfile',null,'files','array' );

	if (!$userfile) {
		HTML_installer::showInstallMessage( 'No file selected', 'Upload new module - error',
			$installer->returnTo( $option, '&task=install&element='.$element, $client ));
		exit();
	}

	$userfile_name = $userfile['name'];

	$msg = '';
	$resultdir = uploadFile( $userfile['tmp_name'], $userfile['name'], $msg );

	if ($resultdir !== false) {
		if (!$installer->upload( $userfile['name'] )) {
			HTML_installer::showInstallMessage( $installer->getError(), 'Upload '.$element.' - Upload Failed',
				$installer->returnTo( $option, '&task=install&element='.$element, $client ) );
		}
		$ret = $installer->install();

		HTML_installer::showInstallMessage( $installer->getError(), 'Upload '.$element.' - '.($ret ? 'Success' : 'Failed'),
			$installer->returnTo( $option, '&task=install&element='.$element, $client ) );
		cleanupInstall( $userfile['name'], $installer->unpackDir() );
	} else {
		HTML_installer::showInstallMessage( $msg, 'Upload '.$element.' -  Upload Error',
			$installer->returnTo( $option, '&task=install&element='.$element, $client ) );
	}
}

/**
* Install a template from a directory
* @param string The URL option
*/
function installFromDirectory( $installerClass, $option, $element, $client ) {
	//$userfile = mosGetParam( $_REQUEST, 'userfile', '' );
    $userfile = JRequest::getVar('userfile','');

	if (!$userfile) {
		$mainframe->redirect( "index2.php?option=$option&element=module", "Please select a directory" );
	}

	$installer = new $installerClass();

	//$path = mosPathName( $userfile );
    $path = dirname( $userfile );
    
	if (!is_dir( $path )) {
		$path = dirname( $path );
	}

	$ret = $installer->install( $path );
	HTML_installer::showInstallMessage( $installer->getError(), 'Upload new '.$element.' - '.($ret ? 'Success' : 'Error'), $installer->returnTo( $option, '&task=install&element='.$element, $client ) );
}
/**
*
* @param
*/
function removeElement( $installerClass, $option, $element, $client ) {
	//$cid = mosGetParam( $_REQUEST, 'cid', array(0) );
    $cid = JRequest::getVar( 'cid', array(0) );
	if (!is_array( $cid )) {
		$cid = array(0);
	}

	$installer 	= new $installerClass();
	$result 	= false;
	if ($cid[0]) {
		$result = $installer->uninstall( $cid[0], $option, $client );
	}

	$msg = $installer->getError();

	$mainframe->redirect( $installer->returnTo( $option, '&task=install&element='.$element, $client ), $result ? 'Success ' . $msg : 'Failed ' . $msg );
}
/**
* @param string The name of the php (temporary) uploaded file
* @param string The name of the file to put in the temp directory
* @param string The message to return
*/
function uploadFile( $filename, $userfile_name, &$msg ) {
	//global JPATH_ROOT;
	//$baseDir = mosPathName( JPATH_ROOT . '/media' );
    $baseDir = JPATH_BASE . DS . 'media';

	if (file_exists( $baseDir )) {
		if (is_writable( $baseDir )) {
			if (move_uploaded_file( $filename, $baseDir . $userfile_name )) {
				if (JPath::setPermissions( $baseDir . $userfile_name )) {
					return true;
				} else {
					$msg = 'Failed to change the permissions of the uploaded file.';
				}
			} else {
				$msg = 'Failed to move uploaded file to <code>/media</code> directory.';
			}
		} else {
			$msg = 'Upload failed as <code>/media</code> directory is not writable.';
		}
	} else {
		$msg = 'Upload failed as <code>/media</code> directory does not exist.';
	}
	return false;
}
?>