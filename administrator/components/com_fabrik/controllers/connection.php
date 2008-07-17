<?php
/**
* @version 
* @package Joomla
* @subpackage Fabrik
* @copyright Copyright (C) 2005 Rob Clayburn. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.controller' );
jimport( 'joomla.application.component.model' );
//jimport( 'joomla.application.component.helper' );
JModel::addIncludePath( COM_FABRIK_FRONTEND.DS.'models' );

require_once( COM_FABRIK_FRONTEND.DS.'helpers'.DS.'params.php' );

/**
 * @package		Joomla
 * @subpackage	Fabrik
 */

class FabrikControllerConnection extends JController
{

	/**
	 * Constructor
	 */
	function __construct( $config = array() )
	{
		parent::__construct( $config );
		// Register Extra tasks
		$this->registerTask( 'add', 'edit' );
		$this->registerTask( 'unpublish',	'publish' );
	}
	
	/**
	 * trys to connection to the database
	 * @return string connection message
	 */
	 
	function test( )
	{
		JRequest::checkToken() or die( 'Invalid Token' );
		$db =& JFactory::getDBO();
		$cid	= JRequest::getVar( 'cid', array(0), 'method', 'array' );
		$cid	= array((int) $cid[0]);
		$model = JModel::getInstance( 'Connection', 'FabrikModel' );
		$link = 'index.php?option=com_fabrik&c=connection&view=display';
		
		//$row = $model->
		foreach ($cid as $id) {
			$model->setId( $id ); 
			if ($model->testConnection() == false) {
				JError::raiseWarning( 500,  JText::_( 'Unable to conenct' ) );
				$this->setRedirect( $link );
				return;
			}
		}
		$this->setRedirect( $link, JText::_( 'Connection successful' ) );
	}

	/**
	 * set the default connection
	 */
	
	function setdefault()
	{
		JRequest::checkToken() or die( 'Invalid Token' );
		$db =& JFactory::getDBO();
		$cid	= JRequest::getVar( 'cid', 0, 'method', 'array' );
		$cid	= ((int) $cid[0]);
		$model = JModel::getInstance( 'Connection', 'FabrikModel' );
		$link = 'index.php?option=com_fabrik&c=connection&view=display';
		$model->setDefault( $cid );
		$this->setRedirect( $link, JText::_( 'Default connection updated' ) );	
	}
	
	/**
	 * cancel editing a connection
	 */
	
	function cancel()
	{
		// Check for request forgeries
		JRequest::checkToken() or die( 'Invalid Token' );
		$this->setRedirect( 'index.php?option=com_fabrik&c=connection' );
		// Initialize variables
		$db		=& JFactory::getDBO();
		$post	= JRequest::get( 'post' );
		$row	=& JTable::getInstance('connection', 'Table');
		$row->bind( $post );
		$row->checkin();
	}
	
	
	/**
	 * Edit a connection
	 */

	function edit()
	{
		
		$user =& JFactory::getUser();
		$db =& JFactory::getDBO();
		$row =& JTable::getInstance('connection', 'Table');
		if ($this->_task == 'edit') {
			$cid	= JRequest::getVar('cid', array(0), 'method', 'array');
			$cid	= array((int) $cid[0]);
		} else {
			$cid	= array( 0 );
		}
		$row->load( $cid[0] );
		// fail if checked out not by 'me'
		if ($row->checked_out && $row->checked_out != $user->get( 'id' )) {
			$this->setRedirect( 'index.php?option=com_fabrik&c=connection' );
			return JError::raiseWarning( 500, 'The connection '. $row->description .' is currently being edited by another administrator' );
		}
		if ($cid) {
			$row->checkout( $user->get( 'id' ) );
		}
		require_once( JPATH_COMPONENT.DS.'views'.DS.'connection.php' );
		FabrikViewConenction::edit( $row );
	}
	
	/**
	 * Save a connection
	 */

	function save()
	{
		// Check for request forgeries
		JRequest::checkToken() or die( 'Invalid Token' );
		$db =& JFactory::getDBO();
		$row =& JTable::getInstance( 'connection', 'Table' );
		if (JRequest::getVar( 'passwordConf', '', 'post' ) !=  JRequest::getVar( 'password', '', 'post' )) {
			return JError::raiseWarning( 500, JText::_('FBK_PASSWORDS_DO_NOT_MATCH' ) ); 
		}
		
		$post	= JRequest::get( 'post' );
		
		if (JRequest::getVar('id', '', 'post' ) != '0') { 
			/* if we're editing an existing connection and no new password has been added we want to delete the post password data*/
			if (JRequest::getVar('password', '', 'post' ) == '') {
				unset( $post['password'] );
			}
		}
		if (!$row->bind( $post )) {
			return JError::raiseWarning( 500, $row->getError() );
		} 
	
		if (!$row->store( )) {
			return JError::raiseWarning( 500, $row->getError() );
		}
		$row->checkin( );
		$task = JRequest::getCmd( 'task' );
		switch ($task)
		{
			case 'apply':
				$link = 'index.php?option=com_fabrik&c=connection&task=edit&cid[]='. $row->id ;
				break;

			case 'save':
			default:
				$link = 'index.php?option=com_fabrik&c=connection&view=display';
				break;
		}
		$this->setRedirect( $link, JText::_( 'Connection Saved' ) );
	}
	
	/**
	 * Publish a connection
	 */

	function publish()
	{
		// Check for request forgeries
		JRequest::checkToken() or die( 'Invalid Token' );
		
		$this->setRedirect( 'index.php?option=com_fabrik&c=connection' );

		// Initialize variables
		$db			=& JFactory::getDBO();
		$user		=& JFactory::getUser();
		$cid		= JRequest::getVar( 'cid', array(), 'post', 'array' );
		$task		= JRequest::getCmd( 'task' );
		$publish	= ($task == 'publish');
		$n			= count( $cid );

		if (empty( $cid )) {
			return JError::raiseWarning( 500, JText::_( 'No items selected' ) );
		}

		JArrayHelper::toInteger( $cid );
		$cids = implode( ',', $cid );

		$query = 'UPDATE #__fabrik_connections'
		. ' SET state = ' . (int) $publish
		. ' WHERE id IN ( '. $cids.'  )'
		. ' AND ( checked_out = 0 OR ( checked_out = ' .(int) $user->get('id'). ' ) )'
		;
		$db->setQuery( $query );
		if (!$db->query()) {
			return JError::raiseWarning( 500, $row->getError() );
		}
		$this->setMessage( JText::sprintf( $publish ? 'Items published' : 'Items unpublished', $n ) );
	}

	/**
	 * Display the list of connections
	 */

	function display()
	{
		global $mainframe;
		$db =& JFactory::getDBO();
		// get the total number of records
		$db->setQuery( "SELECT count(*) FROM #__fabrik_connections" );
		$total = $db->loadResult();
		$context			= 'com_fabrik.connection.list.';
		$limit						= $mainframe->getUserStateFromRequest( $context.'limit', 'limit', $mainframe->getCfg('list_limit'), 'int' );
		$limitstart 			= $mainframe->getUserStateFromRequest( $context.'limitstart', 'limitstart', 0, 'int' );
		$sql = "SELECT *, u.name AS editor, #__fabrik_connections.id AS id FROM #__fabrik_connections " .
				"\n LEFT JOIN #__users AS u ON #__fabrik_connections.checked_out = u.id";
		$db->setQuery( $sql, $limitstart, $limit );
		jimport( 'joomla.html.pagination' );
		$pageNav = new JPagination( $total, $limitstart, $limit );
		$rows = $db->loadObjectList( );
		require_once( JPATH_COMPONENT.DS.'views'.DS.'connection.php' );
		FabrikViewConenction::show( $rows, $pageNav );
	}
	
	/**
	 * copy a connection
	 * @param int connection id
	 */
	 
	function copy( ){
		// Check for request forgeries
		JRequest::checkToken() or die( 'Invalid Token' );
		$this->setRedirect( 'index.php?option=com_fabrik&c=connection' );
		$cid		= JRequest::getVar( 'cid', null, 'post', 'array' );
		$db			=& JFactory::getDBO();
		$connection	=& JTable::getInstance( 'connection', 'Table' );
		$user		= &JFactory::getUser();
		$n			= count( $cid );

		if ($n > 0)
		{
			foreach ($cid as $id)
			{
				if ($connection->load( (int)$id ))
				{
					$connection->id				= 0;
					$connection->description	= 'Copy of ' . $connection->description;
					$connection->default			= 0;

					if (!$connection->store()) {
						return JError::raiseWarning( $connection->getError() );
					}
				}
				else {
					return JError::raiseWarning( 500, $connection->getError() );
				}
			}
		}
		else {
			return JError::raiseWarning( 500, JText::_( 'No items selected' ) );
		}
		$this->setMessage( JText::sprintf( 'Items copied', $n ) );
	}
	
	
	/**
	 * delete connection
	 */
	 
	function remove( )
	{
		// Check for request forgeries
		JRequest::checkToken() or die( 'Invalid Token' );
		$this->setRedirect( 'index.php?option=com_fabrik&c=connection' );
		// Initialize variables
		$db		=& JFactory::getDBO();
		$cid	= JRequest::getVar( 'cid', array(), 'post', 'array' );
		$n		= count( $cid );
		JArrayHelper::toInteger( $cid );
		if (in_array( 1, $cid )) {
			return JError::raiseWarning( 500, JText::_('FBK_CAN_NOT_DELETE_FIRST_CONNECTION') );
		}
		if ($n)
		{
			$query = 'DELETE FROM #__fabrik_connections'
			. ' WHERE id = ' . implode( ' OR id = ', $cid )
			;
			$db->setQuery( $query );
			if (!$db->query()) {
				JError::raiseWarning( 500, $db->getError() );
			}
		}

		$this->setMessage( JText::sprintf( 'Items removed', $n ) );
	}
}
?>