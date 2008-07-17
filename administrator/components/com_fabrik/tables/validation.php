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
class TableValidation extends JTable
{
	
	/** @var int Primary key */
	var $id = null;

	/** @var int The element id that the rule applies to - foreign keyed with table jos_fabrik_elements*/
	var $element_id = null;
	
	/** @var string The validation plugin name */
	var $validation_plugin = null;
	
	/** @var string The message to display in the form if this rule is not met */
	var $message = null;

   /** @var bol client (true) or server(false) side valitaion */
   var $clent_side_validation = 0;
   
   /** @var string  */
	var $attribs = null;
   
   /** @var int user who has validation checked out */
   var $checked_out = null;
   
   /** @var datetime validation was checked out */
   var $checked_out_time = null;
	

 	/**
 	 * 
 	 */

	function __construct( &$_db )
	{
		parent::__construct( '#__fabrik_validations', 'id', $_db );
	}
	
	/**
	* overloaded check function 
	*/

	function check() {
		return true;
	}

}
?>
