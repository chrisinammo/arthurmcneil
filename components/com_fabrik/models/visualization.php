<?php

/**
* @package Joomla
* @subpackage Fabrik
* @copyright Copyright (C) 2005 Rob Clayburn. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

jimport('joomla.application.component.model');

require_once( JPATH_SITE.DS.'components'.DS.'com_fabrik'.DS.'models'.DS.'plugin.php' );

class FabrikModelVisualization extends FabrikModelPlugin { //JModel


 	var $_pluginParams = null;
 	
 	var $_row = null;
 	
 	/**
	 * constructor
	 */

	function __construct()
	{
		parent::__construct();
	}
	
 	function getPluginParams()
	{
		if (!isset( $this->_pluginParams )) {
			$cache = & JFactory::getCache();
			//$this->_pluginParams = $cache->call( array( &$this, '_loadPluginParams') );
			$this->_pluginParams = $this->_loadPluginParams();
		}
		return $this->_pluginParams;
	}
	
	/**
	 * load visualization plugin  params
	 * @access private - public call = getPluginParams()
	 *
	 * @return object visualization plugin parameters
	 */

	function _loadPluginParams()
	{
		$this->getVisualization();
		$pluginParams = &new fabrikParams( $this->_row->attribs, $this->_xmlPath, 'fabrikplugin' );
		return $pluginParams;
	}
	
	function getVisualization()
	{
		if (is_null( $this->_row )){
			$this->_row =& $this->getTable( 'Visualization' );
			$this->_row->load( $this->_id );
		}
		return $this->_row;
	}
	
 }

 
?>