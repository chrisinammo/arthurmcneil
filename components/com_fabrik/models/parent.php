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

class FabrikModel extends JModel 
{ //was mosDBTable
	
	/** @var bol in admin (true) or front end (false)*/
	var $_admin = false;

	/** @var string The null/zero date string */
	var $_nullDate		= '0000-00-00 00:00:00';
		
	/** @var object */
	var $_pluginManger = null;
	
	/** @var bol is the object inside a package? */
	//DEPRECAITED - ALWAYS IN A PACKAGE
	//var $_inPackage  = false;
	
	/**
	 * requires that the child object has the corrent 'mambo' fields for
	 * publsihing - ie state, publish_up, publish_down.
	 * @return bol can show the published item or not
	 */
	 
	function canPublish()
	{
		$config		=& JFactory::getConfig();
		if ($this->_admin) {
			return true;
		}
		$now = date( 'Y-m-d H:i:s', time() + $config->getValue('offset') * 60 * 60 );
		/* set the publish down date into the future */
		if (trim($this->publish_down) == '0000-00-00 00:00:00') { $this->publish_down = $now + 30;}
		/* set the publish up date into the past */ 
		if (trim($this->publish_up) == '0000-00-00 00:00:00') { $this->publish_up = $now - 30;} 
		if ($this->state == '1' and $now >=$this->publish_up and $now <= $this->publish_down) {
			return true;
		} else {
			return false;
		}
	}

	/**  
	 * sets the instances admin state
	 * @param bol admin state
	 */
	 
	function setAdmin( $bol )
	{
		$this->_admin = $bol;
	}
	
	/**
	 * tests to see if the object contains this variable, and if it does sets
	 * the value of it
	 * @param string variable name
	 * @param string variable new value
	 * @return bol true if found and set
	 */
	 
	 function setVar( $varName, $varVal )
	 {
	 	if (isset( $this->$varName )) {
	 		$this->$varName = $varVal;
	 		return true;
	 	} else {
	 		return false;
	 	}
	 }
	 
	/**
	 * publish unpublish stuff
	 * @param array/int ids to publish
	 * @param bol publish = true, unpublish = false
	 */
	 
	function publish( $id, $state )
	{
		$db =& JFactory::getDBO();
		if (is_array( $id )) {
			foreach ($id as $i) {
				$sql = "UPDATE `$this->_tbl` SET state = '$state' WHERE $this->_tbl_key = '$i'";
				$db->setQuery( $sql );
				$db->query();
			}
		} else {
			$sql = "UPDATE `$this->_tbl` SET state = '$state' WHERE $this->_tbl_key = '$id'";
			$db->setQuery( $sql );
			$db->query( );			
		}
	}
	
	function tableExists( $table )
	{
		$db =& JFactory::getDBO();
		$sql = "SHOW TABLES";
		$db->setQuery($sql);
		$rows = $db->loadAssocList();
		if (in_array( $table, $rows )) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * gets the primary key for a given table
	 * @param string table name
	 * @return string tables primary key field name
	 */
	 
	function getPrimaryKey( $table )
	{
		$db =& JFactory::getDBO();
		$db->setQuery( "DESCRIBE $table" );
		$fields = $db->loadObjectList( );
		if (is_array( $fields )) {
			foreach ($fields as $field) {
				if ($field->Key == 'PRI') {
					return $field->Field;
				}
			}
		}
		return '';
	}
	

	function replace_num_entity($ord)
	{
		$ord = $ord[1];
		if (preg_match('/^x([0-9a-f]+)$/i', $ord, $match )) {
			$ord = hexdec($match[1]);
		} else {
			$ord = intval($ord);
       }
       $no_bytes = 0;
       $byte = array();
       if ($ord < 128) {
           return chr($ord);
       }
       elseif ($ord < 2048)
       {
           $no_bytes = 2;
       }
       elseif ($ord < 65536)
       {
           $no_bytes = 3;
       }
       elseif ($ord < 1114112)
       {
           $no_bytes = 4;
       }
       else
       {
           return;
       }

       switch($no_bytes)
       {
           case 2:
           {
               $prefix = array(31, 192);
               break;
           }
           case 3:
           {
           	$prefix = array(15, 224);
           	break;
           }
           case 4:
           {
           	$prefix = array(7, 240);
           }
       }
       for ($i = 0; $i < $no_bytes; $i++) {
           $byte[$no_bytes - $i - 1] = (($ord & (63 * pow(2, 6 * $i))) / pow(2, 6 * $i)) & 63 | 128;
       }
       $byte[0] = ($byte[0] & $prefix[0]) | $prefix[1];
       $ret = '';
       for ($i = 0; $i < $no_bytes; $i++) {
           $ret .= chr($byte[$i]);
       }
       return $ret;
   }
    

	 
   /**
    * required for compatibility with mambo 4.5.4
    */
    
	function reset( $value=null )
	{
		$keys = $this->getPublicProperties();
		foreach ($keys as $k) {
			$this->$k = $value;
		}
	}

  	/**
  	 * Returns an array of public properties
  	 * @return array
  	 */
	function getPublicProperties()
	{
  	static $cache = null;
  	if (is_null( $cache )) {
  		$cache = array();
  		foreach (get_class_vars( get_class( $this ) ) as $key=>$val) {
  			if (substr( $key, 0, 1 ) != '_') {
  				$cache[] = $key;
  			}
  		}
  	}
  	return $cache;
  }
}
?>