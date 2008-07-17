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

This program is free software; you can redistribute it and/or modify 
it under the terms of the GNU General Public License as published by 
the Free Software Foundation; either version 2 of the License, or 
(at your option) any later version.

This header must not be removed. Additional contributions/changes
may be added to this header as long as no information is deleted.
**********************************************

$File: jcalpro.class.php$

Revision date: 02/20/2007

**********************************************
Get the latest version of JCal Pro at:
http://dev.anything-digital.com//
**********************************************
*/

/** ensure this file is being included by a parent file */
defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );

/**
* @package Mambo
* @subpackage Extcalendar
*/
class mosExtCalendarSettings extends JTable {
	/** @var string */
	var $name				= "";
	/** @var string */
	var $value				= "";
	/** @var int */
	var $checked_out		= 0;
	/** @var date */
	var $checked_out_time	= 0;
	
	function mosExtCalendarSettings( &$_db ) {
		//$this->mosDBTable( '#__jcalpro_config', 'name', $_db );
        parent::__construct('#__jcalpro_config', 'name', $_db);
	}
	
}

class mosExtCalendarCategories extends JTable {
	/** @var int */
	var $cat_id				= null;
	/** @var int */
	var $cat_parent			= 0;
	/** @var string */
	var $cat_name			= "";
	/** @var string */
	var $description		= "";
	/** @var string */
	var $color				= "#000000";
	/** @var string */
	var $bgcolor			= "#EEF0F0";
	
	var $level = "default";
	
	/** @var int */
	var $options			= 0;
	/** @var int */
	var $published			= 0;
	/** @var int */
	var $checked_out		= 0;
	/** @var date */
	var $checked_out_time	= 0;
	
	function mosExtCalendarCategories( &$_db ) {
		//$this->mosDBTable( '#__jcalpro_categories', 'cat_id', $_db );
        parent::__construct( '#__jcalpro_categories', 'cat_id', $_db );
	}
	
	function check() {
		// check for valid category name
		if (trim($this->cat_name == "")) {
			$this->_error = "You must specify a category name.";
			return false;
		}
		
		// check for valid color
		if (trim($this->color == "")) {
			$this->_error = "You must specify a category color.";
			return false;
		}

		return true;
	}
}

class mosJCalProEvents extends JTable
{
	var $extid  = null;
	var $title = null;
	var $description = null;
	var $contact = null;
	var $url = null;
	var $email = null;
	var $picture = null;
	var $cat = null;
	var $day = null;
	var $month = 1;
	var $year = null;
	var $approved	= 1;
	var $start_date	= null;
	var $end_date	= null;
	var $recur_type	= null;
	var $recur_val= null;
	var $recur_end_type	= null;
	var $recur_count= 1;
	var $recur_until= null;
	var $published = 1;
	var $checked_out = null;
	var $checked_out_time	= null;
	
	function mosJCalProEvents ( &$_db ) 
	{
		//global $database;
		
		//$this->mosDBTable ( '#__jcalpro_events', 'extid', $database );
        parent::__construct( '#__jcalpro_events', 'extid', $_db );
        
	}
	
	function check() 
	{
		return true;
	}
}
?>