<?php
/**
 * Legacy Mode compatibility
 * @version		$Id: database.mysqli.php 7692 2007-06-08 20:41:29Z tcp $
 * @package		Joomla.Legacy
 * @deprecated	As of version 1.5
 */

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.database.database' );
jimport( 'joomla.database.database.mysqli' );
/**
 * @package		Joomla
 * @deprecated As of version 1.5
 */
class database extends JDatabase {
	function __construct ($host='localhost', $user, $pass, $db='', $table_prefix='', $offline = true) {
		parent::__construct( 'mysqli', $host, $user, $pass, $db, $table_prefix );
	}
}
?>