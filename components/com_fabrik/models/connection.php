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

/**
 * 
 * All rights reserved
 * Mambo Open Source is Free Software
 * License: http://www.gnu.org/copyleft/gpl.html
 * 
 * @package fabrik
 * @Copyright (C) Rob Clayburn
 * @version $Revision: 1.8 $
 */
 
 class FabrikModelConnection extends JModel {
 	
 	/** none table vars */
 	/** @var array a list of all the database tables */
 	var $_connectionTables = null;
 	
 	/** @var object table **/
	var $_connection = null;
	
	/** @var array containing db connections */
	var $_dbs = array();
	
	/** @var int connection id */
	var $_id = null;
	
 	/**
	* Constructor
	*/

	function __construct()
	{
		parent::__construct();
	}
	
	/**
	 * Method to set the element id
	 *
	 * @access	public
	 * @param	int	element ID number
	 */

	function setId($id)
	{
		// Set new element ID 
		$this->_id		= $id;
	}
	
	/**
	 * is the conenction table the default connection
	 * @return bol
	 */

	function isDefault()
	{
		return $this->_connection->default;
	}
	
	function setDefault( $id )
	{
		$db =& JFactory::getDBO();
		$db->setQuery("UPDATE #__fabrik_connections SET `default` = 0");
		$db->query();
		$db->setQuery("UPDATE #__fabrik_connections SET `default` = 1 WHERE id = '$id'");
		$db->query();
	}
	
	/**
	 * creates a html dropdown box for the current connection
	 * @param string javascript to add to select box
	 * @param string name of dropdown box
	 * @param string the selected element in the list
	 * @param string class name
	 */
	 
	 function getTableDdForThisConnection( $javascript = '', $name = 'table_join', $selected = '', $class='inputbox' )
	 {
	 	$tableOptions = array( );
	 	$cn = $this->_connection;
		if ($cn->host and $cn->state == '1') {
			if (@ mysql_connect( $cn->host, $cn->user, $cn->password )) {
				//ensure db files are included
				jimport('joomla.database.database');
				$options = array ( 'host' => $cn->host, 'user' => $cn->user, 'password' => $cn->password, 'database' => $cn->database, 'prefix' => '' );
				$fabrikDb = new JDatabaseMySQL( $options );
				$tables = $fabrikDb->getTableList( );
				$tableOptions[] = JHTML::_('select.option', '', '-' );
				foreach ($tables as $table) {
					$tableOptions[] = JHTML::_( 'select.option', $table, $table );
				}
			} else {
				$tableOptions[] = JHTML::_( 'select.option','couldnt connect' );	
			}
		} else {
			$tableOptions[] = JHTML::_( 'select.option','host not set' );
		}
		return JHTML::_('select.genericlist',  $tableOptions, $name, 'class="' . $class . '" size="1" id="' . $name  . '" '.$javascript, 'value', 'text', $selected );
	}
	 
	/**
	 * get a connection table object
	 * 
	 * @return object connection tables
	 */

	function &getConnection()
	{
		if (!is_object( $this->_connection )) {
			if ($this->_id == -1) {
				return $this->loadDefaultConnection();
			} else {
				$row =& JTable::getInstance( 'connection', 'Table' );
				$row->load( $this->_id );
				$this->_connection =& $row;
			}
		}
		return $this->_connection;
	}
 	
	/**
	 * load the connection associated with the table
	 * @return object database object using connection details false if connection error
	 */
	
	function &getDb()
	{
		$cn =& $this->getConnection();
		if (!array_key_exists( $cn->id, $this->_dbs )) {
			$options = array ( 'host' => $cn->host, 'user' => $cn->user, 'password' => $cn->password, 'database' => $cn->database, 'prefix' => '' );
			$this->_dbs[$cn->id] = new JDatabaseMySQL( $options );
		}
		return $this->_dbs[$cn->id];
	}
	
	/**
	 * gets object of connections
	 * @param javascript to run on change
	 */
	 
	 function getConnections(  )
	 {
 		$db		=& JFactory::getDBO();
		$db->setQuery("SELECT *, id AS value, description AS text FROM #__fabrik_connections WHERE state = '1'");
		$realCnns = $db->loadObjectList();
		echo $db->getErrorMsg();
		return $realCnns;
	}

	/**
	 * gets dropdown list of published connections
	 * @param object connections stored in database
	 * @param string javascript to run on change
	 * @param string name of connection drop down
	 * @param int default value
	 * @param string element id
	 */
	 	 
	 function getConnectionsDd( $realCnns, $javascript, $name = 'connection_id', $selected, $id = '', $attribs= 'class="inputbox" size="1" ' )
	 {
	 	if ($id == '') {
			$id = $name;	 
		}
		$cnns[] = JHTML::_('select.option', '-1', JText::_( 'Please select' ) );
		$cnns = array_merge( $cnns, $realCnns );	
		$attribs .= $javascript;
		return JHTML::_('select.genericlist', $cnns, $name, $attribs, 'value', 'text', $selected, $id );
	 }

	 /**
	 * queries all published connections and returns an multidimensional array
	 * of tables and fields for each connection  
	 * WARNING: this is likely to
	 * exceed php script execution time if querying a larger remote database
	 *
	 * @param object all available connections
	 */
	  
	function getConnectionTableFields( $realCnns )
	{
		$connectionTableFields = array (); 
		$connectionTableFields[-1] = array ();
		$connectionTableFields[-1][] = JHTML::_('select.option', '-1', JText::_( 'Please select' ) );
		foreach ($realCnns as $cn) {
			$connectionTableFields[$cn->value] = array ();
			if ($cn->host and $cn->state == '1') {
				if (@ mysql_connect( $cn->host, $cn->user, $cn->password )) {
					$options = array ( 'host' => $cn->host, 'user' => $cn->user, 'password' => $cn->password, 'database' => $cn->database, 'prefix' => '' );
					$fabrikDb = new JDatabaseMySQL( $options );
					//$fabrikDb = new database($cn->host, $cn->user, $cn->password, $cn->database, "", true, true);
					$tables = $fabrikDb->getTableList();
					$fields = $fabrikDb->getTableFields( $tables );
					$connectionTableFields[$cn->value][$key] = $fields;
				} else {
					$connectionTableFields[$cn->value][$key] =  "unable to connection to $cn->text<br />";
				}
			}
		}
		return $connectionTableFields;
	 }
		 
	 /**
	  * queries all published connections and returns an multidimensional array
	  * of tables for each connection
	  * @param object all available connections
	  */

	function getConnectionTables( $realCnns )
	{
	 	$connectionTables = array ();
	 	$connectionTables[-1] = array ();
	 	$connectionTables[-1][] = JHTML::_('select.option', '-1', JText::_( 'Please select' ) );
	 	foreach ($realCnns as $cn) {
	 		$connectionTables[$cn->value] = array ();
	 		if ($cn->host and $cn->state == '1') {
				if (@ mysql_connect($cn->host, $cn->user, $cn->password)) {
					$options = array ( 'host' => $cn->host, 'user' => $cn->user, 'password' => $cn->password, 'database' => $cn->database, 'prefix' => '' );
					$fabrikDb = new JDatabaseMySQL( $options );
					$tables = $fabrikDb->getTableList();
					$connectionTables[$cn->value][] = JHTML::_('select.option', '', '- Please select -');
					if (is_array($tables)) {
						foreach ($tables as $table) {
							$connectionTables[$cn->value][] = JHTML::_('select.option',$table, $table);
						}
					}
				} else {
					$connectionTables[$cn->value][] = JHTML::_('select.option','', "unable to connection to $cn->description");
				}
			}
		}
		return $connectionTables;
	}
	
	/**
	 * get the tables names in the loaded connection
	 * @param blo add an empty record to the beginning of the list
	 * @return array tables
	 */

	function getThisTables( $addBlank = false )
	{
		$cn =& $this->getConnection();
		if ($cn->host and $cn->state == '1') {
			if (@ mysql_connect( $cn->host, $cn->user, $cn->password)) {
				$options = array ( 'host' => $cn->host, 'user' => $cn->user, 'password' => $cn->password, 'database' => $cn->database, 'prefix' => '' );
				$fabrikDb = new JDatabaseMySQL( $options );
					
				//$fabrikDb = new database($this->host, $this->user, $this->password, $this->database, "", true, true);
				$tables =  $fabrikDb->getTableList();
				if ($addBlank) {
					$tables = array_merge( array(""), $tables );
				}
				return $tables;
			} else {
				return array( "unable to connection to $cn->description");
			}
		}
	}
	
	/**
	 * tests if you can connect to the connection
	 * @return bol true if connection made otherwise false
	 */
	 
	function testConnection()
	{
		$cn = $this->getConnection();
		if (@ mysql_connect( $cn->host, $cn->user, $cn->password, true )) {
			if (!mysql_select_db( $cn->database )) {
				return false;
			}	
			return true;			
		} else {
			return false;
		}
	}
	
	/**
	 * load the default connection
	 */
	 
	function loadDefaultConnection()
	{
		$db		=& JFactory::getDBO();
		$row = JTable::getInstance('Connection', 'Table');
		$row->_tbl_key = '`default`';
		$row->load( 1 );
		$row->_tbl_key = 'id';
		$this->_connection = $row;
		return $row;
	 }
}

?>