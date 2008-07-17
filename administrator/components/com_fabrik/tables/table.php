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
class TableTable extends JTable
{
	
	/** @var int Primary key */
	var $id=null;
	
	/** @var string The menu title for the Section (a short name)*/
	var $label = null;
	
	/** @var string The text that goes at the start of the table view page*/
	var $introduction = null;
	
	/** @var int The form id that the table references (Foregin Key)*/
	var $form_id = null;

	/** @var int foreign key to connections table */
	var $connection_id = null;
	
	/** @var string if database selected rather than form: this is the database's table name*/
	var $db_table_name = null;
	
	/** @var string name of table's primay key column */
	var $db_primary_key = null;
	
	/** @var bol is the primary key autoincrementing */
	var $auto_inc = 0;
	
	/** @var int published*/
	var $state = 0;
	
	/** @var date date created */
	var $created = null;
	
	/** @var int */
	var $created_by = null;
	
	/** @var string */
	var $created_by_alias = null;
	
	/** @var date date modified */
	var $modified = null;
	
	/** @var int */
	var $modified_by = null;
	
	/** @var int */
	var $checked_out = null;
	
	/** @var date */
	var $checked_out_time = null;
	
	/** @var date */
	var $publish_up = null;
	
	/** @var date */
	var $publish_down = null;
	
	/** @var int the access level the user has to be to view the table*/
	var $access = null;
	
	/** @var int the number of times the table has been viewed*/
	var $hits = null;
	
	/** @var int the default number of rows to show per pages*/
	var $rows_per_page = 10;

	/** @var string table template */
	var $template = 'default';
	
	/** @var string column to order by */
	var $order_by = null;
	
	/** @var string order by direction */
	var $order_dir = null;
	
	/** @var string defines how filters work either onchange or submit button to trigger filter form*/
	var $filter_action = null; 
	
	/** @var string column to do grouping */
	var $group_by = null;
	
	/** @var string attributes */
	var $attribs = null;
	

 	/*
 	 * 
 	 */

	function __construct( &$_db )
	{
		parent::__construct( '#__fabrik_tables', 'id', $_db );
	}

}
?>
