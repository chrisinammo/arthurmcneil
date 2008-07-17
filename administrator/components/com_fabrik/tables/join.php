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
class TableJoin extends JTable
{
	/** @var int primary key */
	var $id = null;
	
	/** @var int fabrik table id the join belongs to 
	 * nb: EITHER  table_id OR element_id IS USED BASED ON WHETHER THIS IS A TABLE JOIN
	 * OR AN ADVANCED ELEMENT JOIN*/
	var $table_id = null;
	
	/** @var int element id the join belongs to */
	var $element_id = null;
	
	/** @var string table to join from (draw from list of tables join to tables and tables own name)*/
	var $join_from_table = null;
	
	/** @var string table to join to */
	var $table_join = null;
	
	/** @var string table column to use for join */
	var $table_key = null;
	
	/** @var string join table column to use in join */
	var $table_join_key = null;
	
	/** @var string join type */
	var $join_type = null; 
	
	/** @var int group id that the join elements are stored under */
	var $group_id = null;

 	/*
 	 * 
 	 */

	function __construct( &$_db )
	{
		parent::__construct( '#__fabrik_joins', 'id', $_db );
	}

}
?>
