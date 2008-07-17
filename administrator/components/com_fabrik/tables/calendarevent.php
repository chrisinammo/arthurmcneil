<?php
/**
* @package Joomla
* @subpackage Fabrik
* @copyright Copyright (C) 2005 Rob Clayburn. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/


// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

/**
 * @package		Joomla
 * @subpackage	Fabrik
 */

class TableCalendarevent extends JTable
	{
	var $id = null;
  var $visualization_id = null;
  var $label = null;
	var $location = null;
	var $start_date = null;
	var $end_date = null;
	var $event_type= null;
	var $all_day = null;
	var $repeat = null;
	var $repeat_occurs = null;
	var $repeate_every = null;
	var $repeat_until = null;
	var $repeat_occurances = null;
	var $repeat_until_date = null;
	var $event_category = null;
	var $access = null;
	var $created_by = null;
	var $created_by_alias = null;
	var $description = null;
	var $priority = null;
	var $status = null;
	var $url = null;
	
 	function fabrikCalendarevent( &$db ) {
		$this->mosDBTable( '#__fabrik_calendar_events', 'id', $db );
	}
   
}
?>