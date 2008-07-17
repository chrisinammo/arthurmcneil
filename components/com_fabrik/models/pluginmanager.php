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

class FabrikModelPluginmanager extends JModel{
	
	/** @var array plugins */
	var $_plugIns = array();
	var $_loading = null;
	var $_group = null;
	var $_errs = array();
	var $_runPlugins = 0;
	
	/**
	 * constructor
	 */

	function __construct()
	{
		parent::__construct();
	}
	
	
	/**
	 * get a html drop down list of the elment types with this objs element type selected as default
	 * @param string default selected option
	 * @param string html name for drop down
	 * @param string extra info for drop down
	 * @return string html element type list
	 */  
	
	function getElementTypeDd( $default, $name='plugin', $extra='class="inputbox elementtype"  size="1"', $defaultlabel='' )
	{
		if ($defaultlabel == '') {
			$defaultlabel = JText::_( 'Please select' );
		}
		$a = array( JHTML::_('select.option', '', $defaultlabel ) );
		$elementstypes = $this->_getList();
		$elementstypes = array_merge( $a, $elementstypes );
		$l = JHTML::_('select.genericlist',  $elementstypes, $name, $extra , 'value', 'text', $default );
		return $l;
	}
	
	function canUse()
	{
		return true;
	}

	/**
	 * get an unordered list of plugins
	 * @param string plugin group
	 * @param string ul id
	 */
	
	function getList( $group, $id )
	{
		$str = "<ul id='$id'>";
		$elementstypes = $this->_getList();
		foreach ($elementstypes as $plugin) {
			$str .= "<li>" . $plugin->text . "</li>";
		}
		$str .= "</ul>";
		return $str;
	}
	
	function _getList()
	{
		$db =& JFactory::getDBO();
		$db->setQuery( "SELECT name AS value, label AS text FROM #__fabrik_plugins WHERE type='$this->_group' AND state ='1' ORDER BY text" );
		$elementstypes = $db->loadObjectList( );
		return $elementstypes;
	}
	
	/**
	 * get a certain group of plugins
	 * @param string plugin group to load
	 * @return array plugins
	 */
	function &getPlugInGroup( $group )
	{
		if (array_key_exists( $group, $this->_plugIns ))
		{
			return $this->_plugIns[$group];
		} else {
			return $this->loadPlugInGroup( $group );
		}
	}
	
	/**
	 * add to the document head all element js files
	 * used in calendar to ensure all element js files are loaded from unserialized form
	 */

	function loadJS()
		{
		$document =& JFactory::getDocument();
		$files = JFolder::files( JPATH_SITE . '/components/com_fabrik/plugins/element',  '.js$', true, true  );
		foreach ($files as $f) {
			$f = COM_FABRIK_LIVESITE . "/" . str_replace("\\", "/", str_replace( JPATH_SITE, '', $f));
			$document->addScript( $f );
		}
	}
	
	/**
	 *@param string plugin type - element/form/table supported
	 */

	function &loadPlugInGroup( $group )
	{
		$db =& JFactory::getDBO();
		$this->_plugIns[$group] = array();
		$this->_group = $group;
		$db->setQuery( "SELECT * FROM #__fabrik_plugins WHERE type = '$group'" );
		$plugIns = $db->loadObjectList();
		
		$n = count( $plugIns );
		for ($i = 0; $i < $n; $i++) {			
			$plugIn = $plugIns[$i];
			$this->_loadPlugin( $group, $plugIn );
		}
	
		return $this->_plugIns[$group];
	}

	/**
	 * @param string plugin name e.g. fabrikfield
	 * @param string plugin type element/ form or table
	 */

	function getPlugIn( $className, $group )
	{
		if (array_key_exists( $group, $this->_plugIns ) && array_key_exists( $className, $this->_plugIns[$group] )) {
			return $this->_plugIns[$group][$className];
		} else {
			return $this->loadPlugIn($className, $group);
		}
	}
	
	/**
	 * @param string plugin name e.g. fabrikfield
	 * @param string plugin type element/ form or table
	 */
	
	function &loadPlugIn( $className, $group )
	{
		$db =& JFactory::getDBO();
		$db->setQuery( "SELECT * FROM #__fabrik_plugins WHERE type = '$group' AND name = '$className'" );
		$plugIn = $db->loadObject();
		if (!$this->_loadPlugin( $group, $plugIn )) {
			return JError::raiseError( 500, JText::sprintf("Did not find %s plugin, please check that it is installed", $className));
		}
		return $this->_plugIns[$group][$className];
	}
	
	/**
	 * @param string name of plugin group to load
	 * @param array list of default element lists
	 * @param array list of default and plugin element lists
	 */
	
	function loadLists( $group, $lists, &$elementModel )
	{
		if (empty( $this->_plugIns )) {
			$this->loadPlugInGroup( $group );
		}
		foreach ($this->_plugIns[$group] as $plugIn) {
			if (method_exists( $plugIn->object, 'getAdminLists' ))
			{
				$lists = $plugIn->object->getAdminLists( $lists, $elementModel, $plugIn->params );
			}
		}
		return $lists;
	}
	
	/**
	 * @param string group name (currently only 'element' is supported)
	 * @param object database row of plugin info
	 * @return bol true if loaded ok
	 */
	
	function _loadPlugin( $group, &$row )
	{
		if(!is_object($row)){
			return false;
		}
		$folder     = $row->type;
		$element    = $row->name;
		$published  = $row->state;
		$params     = $row->params;
		$p 					= JPATH_SITE .DS.'components'.DS.'com_fabrik'.DS.'plugins'.DS. $folder . DS . $element .DS;
		$path 			= $p . $element . '.php';
		$xmlPath 		= $p . $element . '.xml';
		$lang				= $p . "language";
		JModel::getInstance( 'Element', 'FabrikModel' );
		JModel::getInstance( 'Plugin', 'FabrikModel' );
		JModel::getInstance( 'Visualization', 'FabrikModel' );
		
		if (!file_exists( $path )) {
			return JError::raiseWarning( E_NOTICE, "cant load $folder:$element - missng files $path" );
		}
		if (!file_exists( $xmlPath )) {
			return JError::raiseWarning( E_NOTICE, "cant load $folder:$element - missng files $xmlPath" );
		}
		$cPaths = JModel::addIncludePath( $p );
		
		$this->_loading = count( $this->_plugIns );
		JModel::addIncludePath( COM_FABRIK_BASE.DS.'components'.DS.'com_fabrik'.DS.'plugins'.DS.$group.DS.$element );
		$plugIn = & JModel::getInstance( $element, 'FabrikModel' );

		if (JError::isError( $plugIn )) {
			JError::handleMessage( $plugIn );
		}
	
		$plugIn->_pluginLabel = $row->label;
		$plugIn->_xmlPath = $xmlPath;
		$this->_plugIns[$group][$element] 	= $plugIn;
		$plugIn->_loading = null;
		// Load common language files
		$lang =& JFactory::getLanguage();
		$name = 'com_fabrik.plg.'. $group . '.'.$element;
		$lang->load($name);
		return true;
	}
	
	/**
	 * run form & element plugins - yeah!
	 * @param string method to check and call - corresponds to stage of form processing
	 * @param object model calling the plugin form/table
	 * @param string plugin type to call form/table
	 * @return bol false if error found and processed, otherwise true
	 */

	function runPlugins( $method, &$oRequest, $type = 'form' )
	{
		$params =& $oRequest->getParams();
		$this->getPlugInGroup( $type );
		$return = true;
		$usedPlugins 	= $params->get('plugin', "", "_default", "array");
		$usedLocations 	= $params->get('plugin_locations', "", "_default",  "array");
		$usedEvents 	= $params->get('plugin_events', "", "_default",  "array");
		
		
		if ($type != 'table') {
			if (isset( $oRequest->_groups )) {
				foreach ($oRequest->_groups as $groupModel) {
					foreach ($groupModel->_aElements as $elementModel ) {
						if (method_exists( $elementModel, $method)) {
							$elementModel->$method( $oRequest );
						}
					}
				}
			}
		}
		$c = 0;
		$runPlugins = 0;
		foreach ($usedPlugins as $usedPlugin) {
			if ($usedPlugin != '' ) {
				$oPlugin = $this->_plugIns[$type][$usedPlugin];
				//testing this if statement as onLoad was being called on form email plugin when no method availbale
				if (method_exists( $oPlugin, $method )) {
					$modelTable = $oRequest->getTable();
					$pluginParams = new fabrikParams( $modelTable->attribs, $oPlugin->_xmlPath, 'fabrikplugin' );
					
					//$p =& $pluginParams->getParams();
					$p =& $pluginParams->getParams('params', '_default','array', $c);
					$tmpAttribs = '';
					//build a temp attributes string to pass to the parameters object
					foreach ($p as $e) {
						$name = $e[5];
						$pluginElOpts = $params->get($name, "", "_default", "array");
						$val = (array_key_exists( $runPlugins, $pluginElOpts )) ? $pluginElOpts[$runPlugins] : '';
						$tmpAttribs .= $name . "=" . $val . "\n";
					}
					//redo the parmas with the exploded data
					$pluginParams = new fabrikParams( $tmpAttribs, $oPlugin->_xmlPath, 'fabrikplugin');
					//for table
					if (!array_key_exists( $c, $usedLocations )) {
						$usedLocations[$c] = '';
					}
					if (!array_key_exists( $c, $usedEvents )) {
						$usedEvents[$c] = ''; 
					}
					//end
					if ($oPlugin->canUse( $oRequest, $usedLocations[$c], $usedEvents[$c]) &&  method_exists( $oPlugin, $method )) {
						$ok = $oPlugin->$method( $pluginParams, $oRequest );
						if ($ok === false) {
							$this->_errs[] = $oPlugin->_err;
						} else {
							$thisreturn = $oPlugin->customProcessResult( $method );
							if (!$thisreturn && $return) {
								$return = false;
							}
						}
						$runPlugins ++;
					}
				}
				$c ++;
			}
		}
		$this->_runPlugins = $runPlugins;
		return $return;
	}
}
?>