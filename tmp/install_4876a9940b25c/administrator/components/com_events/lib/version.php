<?php
/**
 * Events Component for Joomla 1.0.x
 *
 * @version     $Id: version.php 1111 2008-06-23 18:25:06Z tstahl $
 * @package     Events
 * @copyright   Copyright (C) 2006-2007 JEvents Project Group
 * @licence     http://www.gnu.org/copyleft/gpl.html
 * @link        http://joomlacode.org/gf/project/jevents
 */

 // no direct access
defined( '_VALID_MOS' ) or die( 'No Direct Access' );

//class JEvents_Version extends JObject {
class EventsVersion {
	/** @var string Product */
	var $PRODUCT 	= 'JEvents';
	/** @var int Main Release Level */
	var $RELEASE 	= '1';
	/** @var int Sub Release Level */
	var $DEV_LEVEL 	= '4';
	/** @var string Patch Level */
	var $PATCH_LEVEL = '3';
	/** @var string Development Status */
	var $DEV_STATUS = 'RC2';
	/** @var string Copyright Text */
	var $COPYRIGHT 	= 'Copyright &copy; 2006-2008';
	/** @var string Copyright Text */
	var $COPYRIGHTBY 	= 'JEvents Project Group';
	/** @var string LINK */
	var $LINK 		= 'http://joomlacode.org/gf/project/jevents';

	function &getInstance() {

		static $instance;

		if ($instance == null) {
			$instance = new EventsVersion();
		}
		return $instance;
	}

	/**
	 * access instance properties
	 * @var    string		property name
	 * @return mixed		property content
	 */
	function get($property) {
		if(isset($this->$property)) {
			return $this->$property;
		}
		return null;
	}

	/**
	 * Returns a reference to a global EventsVersion object, only creating it
	 * if it doesn't already exist.
	 *
	 * @static
	 * @access public
	 * @return object  			The EventsVersion object.
	 */

	/**
	 * @return string URL
	 */
	function getUrl() {
		return $this->LINK;
	}
	/**
	 * @return string short Copyright
	 */
	function getShortCopyright() {
		return $this->COPYRIGHT;
	}
	/**
	 * @return string long Copyright
	 */
	function getLongCopyright() {
		return $this->COPYRIGHT . ' ' . $this->COPYRIGHTBY;
	}
	/**
	 * @return string Long format version
	 */
	function getLongVersion() {
		return $this->PRODUCT .' '. $this->getShortVersion();
	}

	/**
	 * @return string Short version format
	 */
	function getShortVersion() {
		return 'v' . $this->RELEASE . '.' . $this->DEV_LEVEL . '.' . $this->PATCH_LEVEL . ' ' . $this->DEV_STATUS;
	}

}
?>
