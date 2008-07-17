<?php
/**
 * Events Component for Joomla 1.5.x
 *
 * @version     $Id: config.php 903 2007-11-18 12:19:25Z tstahl $
 * @package     Events
 * @copyright   Copyright (C) 2006-2007 JEvents Project Group
 * @licence     http://www.gnu.org/copyleft/gpl.html
 * @link        http://joomlacode.org/gf/project/jevents
 */

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

/**
 * Handler of the components configuration parameter
 * configuration parameters are stored in a INI style file
 *
 * The INI file is loaded into a Parameter object
 * 
 * @author     Thomas Stahl
 * @since      1.4
 */
class EventsConfig extends JParameter
{

	/** @var string			full path name of current inifile */
	var $_inifile_path			= null;

	/**
	 * Constructor
	 *
	 */
	function __construct($data='') {

		parent::__construct($data);
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
		fwrite($f, '<php die( \'Restricted access\' ); ?>'."\n;\n");
		fwrite($f, '; created by EventsConfig at '. date('r')."\n");
		fwrite($f, '; Please do not edit'."\n;\n");

		foreach ($this->toArray() as $key => $value) {
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
			$instances[$inifile] = new EventsConfig(@file_get_contents($inifile));
			$instances[$inifile]->_inifile_path = $inifile;
		}
		return $instances[$inifile];
	}

}

