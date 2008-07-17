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
class TableForm extends JTable
{
	/** @var int Primary key */
	var $id = null;

	/** @var string The the forms title*/
	var $label = null;

	/** @var bol determines if the form records posted data into a database table */
	var $record_in_database = 0;

	/** @var string */
	var $intro = null;

	/** @var string main error message shown at the top of the form if one of the validation rules is not met*/
	var $error = null;

	var $created = null;

	var $created_by = null;

	var $created_by_alias = null;

	var $modified = null;

	var $modified_by = null;

	var $checked_out = null;

	var $checked_out_time = null;

	/** @var date start publishing */
	var $publish_up = null;
	
	/** @var date end publishing */
	var $publish_down = null;

	/** @var string */
	var $submit_button_label = null;

	/**@var bol publish state of form  */
	var $state = 0;

	/** @var string php template to use when showing form */
	var $form_template   = null;

	/** @var string php template to use when showing view only version of form */
	var $view_only_template = null;

	/** @var string php code to eval after curl object has been created */
	var $curl_code = null;

	/** @car string xml param attributes*/
	var $attribs = null;

 	/*
 	 * 
 	 */

	function __construct( &$_db )
	{
		parent::__construct( '#__fabrik_forms', 'id', $_db );
	}

}
?>
