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
class TablePlugin extends JTable
{
	
	/** @var int Primary key */
	var $id = null;

	/** @var string The name used to identify the plugin*/
	var $name  = null; 	 
	
	/** @var string the descriptive name from the plugin */
	var $label = null;

	/** @var string the type of plugin  */
	var $type = null;

	/** @var the state of the plugin */
	var $state = null;

	/** @var bol is the plugin core */
	var $iscore = null;

	/** @var id int of user who has checked out the plugin */
	var $checked_out = null;

	/** @var date checkde out **/
	var $checked_out_time = null;
	
	/** @var string parameters **/
	var $params = null;

 	/*
 	 * 
 	 */

	function __construct( &$_db )
	{
		parent::__construct( '#__fabrik_plugins', 'id', $_db );
	}

}
?>
