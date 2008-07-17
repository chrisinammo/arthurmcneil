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
class TableValidationrule extends JTable
{
	
	/** @var int Primary key */
	var $id=null;

	/** @var string The label of the type of rule*/
	var $validation_rule_label = null;

	/** @var string The regular expression of the rule */
	var $validation_rule_expression = null;
	
   /** @var int user who has validation checked out */
   var $checked_out = null;
   
   /** @var datetime validation was checked out */
   var $checked_out_time = null;
   
   /** @var string attributes */
   var $attribs = null;
	

 	/**
 	 * 
 	 */

	function __construct( &$_db )
	{
		parent::__construct( '#__fabrik_validation_rules', 'id', $_db );
	}
	
	/**
	* overloaded check function 
	*/

	function check() {
		return true;
	}

}
?>
