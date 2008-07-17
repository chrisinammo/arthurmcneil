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
class TableFormsession extends JTable
{
	/** @var int Primary key */
	var $id = null;
	var $hash = null;
	var $user_id = null;
	var $form_id = null;
	var $row_id = null;
	var $last_page = null;
	var $referring_url  = null;
	var $data  = null;
	var $time_date  = null; 

 	/*
 	 * 
 	 */

	function __construct( &$_db )
	{
		parent::__construct( '#__fabrik_form_sessions', 'id', $_db );
	}

}
?>
