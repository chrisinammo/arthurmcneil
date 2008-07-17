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
class TableFormGroup extends JTable
{
	/** @var int Primary key */
	var $id = null;
	
	/** @var int */
	var $form_id = null;

	/** @var int */
	var $group_id = null;

	/** @var int Order to display group in form*/
	var $ordering = null;

 	/*
 	 * 
 	 */

	function __construct( &$_db )
	{
		parent::__construct( '#__fabrik_formgroup', 'id', $_db );
	}

	/**
	 *  overloaded check function
	 */

	function check() {
		return true;
	}
}
?>
