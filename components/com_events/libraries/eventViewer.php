<?php
/**
 * Events Component for Joomla 1.5.x
 *
 * @version     $Id: eventViewer.php 963 2008-02-16 10:59:26Z geraint $
 * @package     Events
 * @copyright   Copyright (C) 2006-2007 JEvents Project Group
 * @licence     http://www.gnu.org/copyleft/gpl.html
 * @link        http://joomlacode.org/gf/project/jevents
 */

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

/**
 * Handler of the events viewer - will also manage appropriate config is loaded etc.
 * 
 * @author     Geraint Edwards
 * @since      1.5
 */
class EventsViewer
{
	var $className="";
	var $viewName="";
	
	function EventsViewer() {
		
	}
	
	/**
	 * Constructor
	 *
	 */
	 function populateEventsViewer($type) {
	 	// include the appropraite VIEW - this should be based on config and/or URL?
	 	// config should also allow difference views for different mode/components etc.
		$cfg = & EventsConfig::getInstance();

		$jEventsView = getJEventsViewName();
			 	 		 		 	
	 	// I can't use global $option since this could be a module calling this function with a different option value!
		$option = $cfg->get("com_componentname","com_events");

		// create an array to hold directory list
	 	static $views;
	 	if (!isset($views)){
	 		$views = array();
		 	$handler = opendir(JPATH_SITE . '/components/' . $option .'/layouts/');
		 	while ($file = readdir($handler)) {
	 			if ($file != '.' && $file != '..' && $file != '.svn')	$views[] = $file;
	 		}
		 	closedir($handler);
	 	}

	 	// do a proper test based of directory names
	 	if (!in_array($jEventsView,$views)) {
	 		die ("invalid view in eventViewer.php ($jEventsView)");
	 	}
	 	
	 	if ($type=="front") {
	 		include_once(JPATH_SITE . '/components/' . $option .'/layouts/'.$jEventsView. '/eventsView.php' );
	 	}
	 	else if ($type=="mod_cal"){
			include_once(JPATH_SITE . '/components/'.$option.'/layouts/'.$jEventsView. '/modView.php' );
	 	}
	 	else if ($type=="mod_latest"){
			include_once(JPATH_SITE . '/components/'.$option.'/layouts/'.$jEventsView. '/modView.php' );
	 	}
	 	else if ($type=="mod_legend"){
			include_once(JPATH_SITE . '/components/'.$option.'/layouts/'.$jEventsView. '/modView.php' );
	 	}
	 	//$this->className = $JEventsViewClass;
	 	$this->viewName = $jEventsView ;
	}
	
	function viewClassName($type) {
		$ev = 	EventsViewer::getInstance($type);
		return $ev->className;
	}

	function setViewClassName($type, $classname) {
		$ev =& 	EventsViewer::getInstance($type);
		$ev->className=$classname;
	}
	
	function viewName($type) {
		$ev = 	EventsViewer::getInstance($type);
		return $ev->viewName;
	}

	/**
	 * Returns a reference to a global EventsViewer object, only creating it
	 * if it doesn't already exist.
	 *
	 * @static
	 * @access public
	 * @return object  			The EventsViewer object.
	 * @since 1.5
	 */
	function &getInstance($type) {
	
		static $instances;

		if (!$instances) {
			$instances = array();
		}

		if (!$type) return null;

		if (!array_key_exists($type,$instances)) {
			$instances[$type] = new EventsViewer();
			$instances[$type]->populateEventsViewer($type);
		}
		return $instances[$type];
	}
}
