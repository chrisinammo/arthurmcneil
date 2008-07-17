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

class TableVisualization extends JTable
{
 	/** @var int primary key **/
 	var $id = null;
 	
 	/** @var int plugin id */
	var $plugin = null;
	
 	/** @var string **/
 	var $label = null;
 	
 	/** @var string **/
	var $intro_text = null;
 	
 	/** @var date creation date **/
 	var $created = null;
 	
 	/** @var date id of user who created the Visualization **/
 	var $created_by = null;
 	
 	/** @var string username of user who created the Visualization **/
 	var $created_by_alias = null;
 	
 	/** @var datetime last modified **/
 	var $modified = null;
 	
 	/** @var int user id who last modified **/
 	var $modified_by = null;
 	
 	/** @var int user id who has Visualization checked out **/
 	var $checked_out = null;
 	
 	/** @var datetime last checkout **/
 	var $checked_out_time = null;
 	
 	/** @var datetime start publishing **/
 	var $publish_up = null;
 	
 	/** @var datetime stop publishing **/
 	var $publish_down = null;
 	
 	/** @var bol published **/
 	var $state = null;
 	
 	/** @var text parameters **/
 	var $attribs = null;

 	/*
 	 * Constructor
 	 */

	function __construct( &$_db )
	{
		parent::__construct( '#__fabrik_visualizations', 'id', $_db );
	}

}
?>