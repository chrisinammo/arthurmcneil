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
class TablePackage extends JTable
{
	
	/** @var int Primary key */
	var $id = null;
	
	/** @var string the descriptive name from the plugin */
	var $label = null;
	
	/** @var the state of the plugin */
	var $state = null;
	
	/** @var string parameters **/
	var $attribs = null;
	
	/** @var id int of user who has checked out the plugin */
	var $checked_out = null;

	/** @var date checkde out **/
	var $checked_out_time = null;
	
	/** @var string csv of table ids */
	var $tables = null;
	
	/** @var datetime date creatored */
	var $created = null;
	
	/** @var datetime date modified */
	var $modified = null;
	
	/** @var int id user last modified */
	var $modified_by = null;
	
	/** @var string template */
	var $template = null;
	
	/**

 	/*
 	 * 
 	 */

	function __construct( &$_db )
	{
		parent::__construct( '#__fabrik_packages', 'id', $_db );
	}

}
?>
