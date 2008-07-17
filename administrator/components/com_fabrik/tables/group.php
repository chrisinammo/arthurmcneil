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
class TableGroup extends JTable
{
	/** @var int Primary key */
	var $id = null;
	
	/** @var string group name */
	var $name = null;
	
	/** @var string group css */
	var $css = null;
	
	/** @var string group title */
	var $label = null;
	
	/** @var date created **/
   var $created = null;
   
   /** @var int id of creator */
   var $created_by = null;
   
   /** @var string creator alias */
   var $created_by_alias = null;
   
   /** @var date modified */
   var $modified = null;
   
   /** @var int id of modifier */
   var $modified_by = null;
   
   /** @var int checked out */
   var $checked_out = null;
   
   /** @var date checked out */
   var $checked_out_time = null;
   
   /** @var bol is a join */
   var $is_join = 0;
   
   /** @var int group state */
   var $state = 1;
   
   /** $var string group attribs */
	var $attribs = null;

	/** testing new load func **/
	var $join_id  = null;
	
 	/*
 	 * 
 	 */

	function __construct( &$_db )
	{
		parent::__construct( '#__fabrik_groups', 'id', $_db );
	}


	/**
	 * overloaded check function
	 */
	 
	function check( ) {
		if ( trim( $this->name ) == '' ) {
			$this->_error = JText::_( "Your Group must contain a name." );
			return false;
		}
		return true;
	}
	
	function load(  $oid=null ){

		$k = $this->_tbl_key;

		if ($oid !== null) {
			$this->$k = $oid;
		}

		$oid = $this->$k;

		if ($oid === null) {
			return false;
		}
		$this->reset();

		$db =& $this->getDBO();

			$query = "SELECT #__fabrik_groups.*, #__fabrik_joins.id AS join_id "
		. "\n FROM $this->_tbl"
		. "\n LEFT JOIN #__fabrik_joins ON #__fabrik_groups.id = #__fabrik_joins.group_id"
		. "\n WHERE #__fabrik_groups.$this->_tbl_key = " . $this->_db->Quote( $oid );
		
		$db->setQuery( $query );

		if ($result = $db->loadAssoc( )) {
			return $this->bind($result);
		}
		else
		{
			$this->setError( $db->getErrorMsg() );
			return false;
		}
	}
	
}
?>
