<?php
/**
* @package Joomla
* @subpackage Fabrik
* @copyright Copyright (C) 2005 Rob Clayburn. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

jimport('joomla.application.component.model');

class FabrikModelJoin extends JModel{

	/**
	 * constructor
	 */

	/** @var object join table */
	var $_join = null;
	
	/** @var int id of join to load */
	var $_id = null;
	

	function __construct()
	{
		parent::__construct();
	}
	
	function setId($id)
	{
		$this->_id = $id;
	}
	
	function getJoin()
	{
		$j = &JTable::getInstance( 'join', 'Table' );
		$j->load( $this->_id );
		$this->_join = $j;
		return $this->_join;	
	}
	
	/**
	 * load join based on group id
	 * @param int group id
	 * @param int table id
	 */
	
	function loadFromGroupId( $groupId, $tableId = '' )
	{
		$db =& JFactory::getDBO();
    $where2 =( $tableId ) ?  " AND table_id = '$tableId'" : '';
		$sql = "SELECT * FROM #__fabrik_joins WHERE group_id = '$groupId'" . $where2;
		$db->setQuery( $sql );
		$this->_join = $db->loadObject( $this );
		return $this->_join;
	}
	
	/**
	 * deletes the loaded join and then 
	 * removes all elements, groups & form group record
	 * @param int the group id that the join is linked to 
	 */
	 
	function deleteAll( $groupId )
	{
		$db =& JFactory::getDBO();
		$db->setQuery( "DELETE FROM #__fabrik_elements WHERE group_id = '$groupId'" );
		if (!$db->query( )) {
			return JError::raiseError( 500, $db->getErrorMsg( ));
		}
		
		$db->setQuery( "DELETE FROM #__fabrik_groups WHERE id = '$groupId'" );
		if (!$db->query( )) {
			return JError::raiseError( 500, $db->getErrorMsg( ));
		}
	
		/* delete all form group records */
		$db->setQuery( "DELETE FROM #__fabrik_formgroup WHERE group_id = '$groupId'" );
		if (!$db->query( )) {
			return JError::raiseError( 500, $db->getErrorMsg( ));
		}
		$this->_join->delete( );
	}
	
	/**
	 * saves the table join data
	 * @param array data to save
	 */
	 
	function save( $source )
	{
		if (!$this->bind( $source )) {
			return false;
		}
		if (!$this->check()) {
			return false;
		}
		if (!$this->store()) {
			return false;
		}

		$this->_error = '';
		return true;
	}	
	
}
?>