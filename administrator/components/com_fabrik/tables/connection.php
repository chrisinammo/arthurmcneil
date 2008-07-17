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

class TableConnection extends JTable
{
	/** @var int primary key */
 	var $id = null;
 	
 	/** @var string the ip address or url of the databases host */
 	var $host = null;
 	
 	/** @var string the user name to connect to the database with */
 	var $user = null;
 	
 	/** @var string the users password */
 	var $password = null;
 	
 	/** @var string the name of the database to connect to */
 	var $database = null;
 	
 	/** @var string a description of the connection */
 	var $description = null;
 	
 	/** @var bol published state of element */
 	var $state = 0;
 	
 	/** @var int user id who has checked out connection */
 	var $checked_out  	= null;
 	
 	/** @var date time that connection was checked out */
 	var $checked_out_time  	 = null;
 	
 	/** @var bol is this the default connection - used for advanced element joins */
 	var $default = null;

 	/*
 	 * Constructor
 	 */

	function __construct( &$_db )
	{
		parent::__construct( '#__fabrik_connections', 'id', $_db );
	}

}
?>
