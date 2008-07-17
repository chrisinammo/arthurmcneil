<?php

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

jimport('joomla.application.component.model');
jimport('joomla.installer.installer' );
jimport('joomla.installer.helper');


class FabrikModelPluginInstaller extends JModel{
	
	function __contruct()
	{
		parent::__construct();
	}
	
	/**
	 * unistall plugin
	 */

	function uninstall()
	{
		require_once(  dirname(__FILE__) .DS."adapter".DS."fabrikplugin.php" );
		$installer =& JInstaller::getInstance();
		$adaptor = new JInstallerFabrikPlugin( $installer );
		$installer->setAdapter( "fabrikplugin", $adaptor );
		//get the plugin type
		$cid = JRequest::getVar( 'eid' );
		if (is_array( $cid )) {
			$eid = $eid[0];
		}
		return $installer->uninstall( "fabrikplugin", $cid );
	}
	
	/**
	 * install plugin
	 */

	function install(){
		require_once(  dirname(__FILE__) .DS."adapter".DS."fabrikplugin.php" );
		
		$package = $this->_getPackageFromUpload();
		// Was the package unpacked?
		if (!$package) {
			$this->setState('message', JText::_('Unable to find install package'));
			return false;
		}
		$installer =& JInstaller::getInstance();
		//$installer->rob = 'clayburn';
		$this->setState( 'action', 'install' );
		$adaptor =& new JInstallerFabrikPlugin( $installer );
		
		//test fro php 4.x??? seems to work
		$adaptor->parent->setPath('source', $package['dir']);
		//end test

		$installer->setAdapter( "fabrikplugin", $adaptor );
		
		// 	Install the package
		if (!$installer->install($package['dir'])) {
			// There was an error installing the package
			$msg = JText::sprintf('INSTALLEXT', JText::_($package['type']), JText::_('Error'));
			$result = false;
		} else {
			// Package installed sucessfully
			$msg = JText::sprintf('INSTALLEXT', JText::_($package['type']), JText::_('Success'));
			$result = true;
		}
		
		// Cleanup the install files
		if (!is_file($package['packagefile'])) {
			$config =& JFactory::getConfig();
			$package['packagefile'] = $config->getValue('config.tmp_path').DS.$package['packagefile'];
		}
		JInstallerHelper::cleanupInstall($package['packagefile'], $package['extractdir']);
		return $result;		
	}
	
	function _getPackageFromUpload()
	{
		// Get the uploaded file information
		$userfile = JRequest::getVar('userfile', '', 'files', 'array' );

		// Make sure that file uploads are enabled in php
		if (!(bool) ini_get('file_uploads')) {
			JError::raiseWarning('SOME_ERROR_CODE', JText::_('WARNINSTALLFILE'));
			return false;
		}

		// Make sure that zlib is loaded so that the package can be unpacked
		if (!extension_loaded('zlib')) {
			JError::raiseWarning('SOME_ERROR_CODE', JText::_('WARNINSTALLZLIB'));
			return false;
		}

		// If there is no uploaded file, we have a problem...
		if (!is_array($userfile) || $userfile['size'] < 1) {
			JError::raiseWarning('SOME_ERROR_CODE', JText::_('No file selected'));
			return false;
		}

		// Build the appropriate paths
		$config =& JFactory::getConfig();
		$tmp_dest 	= $config->getValue('config.tmp_path').DS.$userfile['name'];
		$tmp_src	= $userfile['tmp_name'];

		// Move uploaded file
		jimport('joomla.filesystem.file');

		$uploaded = JFile::upload($tmp_src, $tmp_dest);

		// Unpack the downloaded package file
		$package = JInstallerHelper::unpack($tmp_dest);

		return $package;
	}
}

?>