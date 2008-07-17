<?php
/**
 * Events Component for Joomla 1.0.x
 *
 * @version     $Id: config.php 996 2008-03-16 16:09:41Z tstahl $
 * @package     Events
 * @copyright   Copyright (C) 2006-2008 JEvents Project Group
 * @licence     http://www.gnu.org/copyleft/gpl.html
 * @link        http://joomlacode.org/gf/project/jevents
 */

// no direct access
defined('_VALID_MOS') or defined('_JEXEC') or die( 'No Direct Access' );

if (!class_exists('mosParameters')){
	class mosParameters extends JParameter  {

	}
}
/**
 * Handler of the components configuration parameter
 * configuration parameters are stored in a INI style file
 *
 * The INI file is loaded into a Parameter object
 * 
 * @author     Thomas Stahl
 * @since      1.4
 */
class EventsConfig extends mosParameters
{

	/** @var string			full path name of current inifile */
	var $_inifile_path			= null;

	// Joomla 1.5
	var $_defaultNameSpace 		= "parameter";

	/**
	 * Constructor
	 *
	 */
	function EventsConfig() {

		//$this->_inifile_path = JPATH_ADMINISTRATOR.DS.'components'.DS.'com_jevents'.DS.$this->_inifile;
		$this->_params = new stdClass();
	}


	/**
	 * get path name of the default INI file
	 *
	 * @static
	 * @access private
	 * @since 1.4
	 */
	function _getDefaultINIfilePath() {

		return dirname(dirname(__FILE__)) . '/' . 'events_config.ini.php';
	}

	/**
	 * Load a INI file into the registry
	 *
	 * @access private
	 * @since 1.4
	 */
	function _loadEventsINI($inifile='') {

		if (!$inifile) {
			$inifile = EventsConfig::_getDefaultINIfilePath();
		}
		//$this->loadFile($this->_inifile_path);
		if (file_exists($inifile)) {
			// Joomla 1.5 compatability
			global $_VERSION;
			if (floatval($_VERSION->getShortVersion())>=1.5){
				$this->loadINI( @file_get_contents($inifile) );
			}
			else {
				$this->mosParameters( @file_get_contents($inifile) );
			}
		}


		$this->_inifile_path = $inifile;
	}

	/**
         * Another Joomla 1.5 together 1.0.x workaround
         *
         * @param unknown_type $key
         * @param unknown_type $default
         */
	function get($key, $default = ''){
		// Joomla 1.5 compatability
		global $_VERSION;
		if (floatval($_VERSION->getShortVersion())>=1.5){
			return parent::get($key,$default,$this->_defaultNameSpace);
		}
		else {
			return parent::get($key,$default);
		}
	}

	/**
         * Another Joomla 1.5 together 1.0.x workaround
         *
         * @param unknown_type $key
         * @param unknown_type $default
         */
	function set($key, $default = ''){
		// Joomla 1.5 compatability
		global $_VERSION;
		if (floatval($_VERSION->getShortVersion())>=1.5){
			return parent::set($key,$default,$this->_defaultNameSpace);
		}
		else {
			return parent::set($key,$default);
		}
	}

	/**
	 * Save a  registry into INI file 
	 *
	 * @access public
	 * @since 1.4
	 */
	function saveEventsINI($inifile='') {

		if (!$inifile) {
			$inifile = ($this->_inifile_path) ? $this->_inifile_path : EventsConfig::_getDefaultINIfilePath();
		}
		$writable = false;
		$errmsg   = null;
		$oldperm  = null;

		$errmsg  =  _CAL_LANG_MSG_WARNING . ' ' . _CAL_LANG_MSG_CHMOD_CONFIG . '(' . $inifile . ')';

		if (is_file($inifile)) {
			$oldperm = fileperms ( $inifile );
			@chmod ($inifile, 0766);
			$writable = is_writable($inifile);
		}

		if ($writable == false) {
			return $errmsg;
		}

		$f = fopen($inifile, 'wb');
		fwrite($f, '<?php die( \'Restricted access\' ); ?>'."\n;\n");
		fwrite($f, '; created by EventsConfig at '. date('r')."\n");
		fwrite($f, '; Please do not edit'."\n;\n");

		$configArray = $this->toArray();
		foreach ($configArray as $key => $value) {
			fwrite($f, $key . '=' . preg_replace('/(\r)*\n/', '\n', $value) . "\n");
		}

		fclose($f);
		if ($oldperm) {
			@chmod ($inifile, $oldperm);
		}
		return true;
	}

	/**
	 * Returns a reference to a global EventsConfig object, only creating it
	 * if it doesn't already exist.
	 *
	 * @static
	 * @access public
	 * @return object  			The EventsConfig object.
	 * @since 1.4
	 */
	function &getInstance($inifile='') {

		static $instances;

		if (!$instances) {
			$instances = array();
		}

		if (!$inifile) {
			$inifile = EventsConfig::_getDefaultINIfilePath();
		}

		if (!array_key_exists($inifile,$instances)) {
			$instances[$inifile] = new EventsConfig();
			$instances[$inifile]->_loadEventsINI($inifile);
		}
		return $instances[$inifile];
	}

	/**
	 * Joomla 1.5 had a bad definition of mosParameters->toObject and toArray as of 30 Nov 2006
	 * This is a work around this problem adapted from JParameter
	 */	
	function toArray()
	{
		global $_VERSION;
		if (floatval($_VERSION->getShortVersion())>=1.5){
			$namespace = $this->_defaultNameSpace;

			// Get the namespace
			$ns = & $this->_registry[$namespace]['data'];

			$array = array();
			foreach (get_object_vars( $ns ) as $k => $v) {
				$array[$k] = $v;
			}

			return $array;
		}
		else {
			return parent::toArray();
		}
	}

}

