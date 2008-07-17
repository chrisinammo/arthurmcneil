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
require_once(COM_FABRIK_FRONTEND.DS.'helpers'.DS.'params.php');
require_once(COM_FABRIK_BASE.DS.'administrator'.DS.'components'.DS.'com_fabrik'.DS.'helpers'.DS.'menu.php');
require_once(COM_FABRIK_BASE.DS.'administrator'.DS.'components'.DS.'com_fabrik'.DS.'helpers'.DS.'adminhtml.php');

JModel::addIncludePath(COM_FABRIK_FRONTEND.DS.'models');

/**
 * @package		Joomla
 * @subpackage	Fabrik
 */

class FabrikControllerPackage extends JController
{

	/**
	 * Constructor
	 */
	function __construct( $config = array() )
	{
		parent::__construct( $config );
		// Register Extra tasks
		$this->registerTask( 'add',			'edit' );
		$this->registerTask( 'apply',		'save' );
		$this->registerTask( 'unpublish',	'publish' );
		$this->registerTask( 'menulinkPackage', 'save' );
		$this->registerTask( 'go2menu', 'save' );
		$this->registerTask( 'go2menuitem', 'save' );
	}
	
	/**
	 * Export the package
	 */
	
	function startExport()
	{
		$cid	= JRequest::getVar('cid', array(0), 'method', 'array');
		$cid	= array((int) $cid[0]);
		$packages = array();
		foreach  ($cid as $id) {
			$model =& JModel::getInstance( 'Package', 'FabrikModel' );
			$model->setId( $id );
			$packages[] = $model->getPackage();
		}
		require_once(JPATH_COMPONENT.DS.'views'.DS.'package.php');
		FabrikViewPackage::exportSettings( $packages );
	}
	
	function export()
	{
		$model =& JModel::getInstance( 'Export', 'FabrikModel' );
		$cid = JRequest::getVar( 'cid' );
		$model->load( $cid[0] );
		$model->export();
	}
	/**
	 * Edit a connection
	 */

	function edit()
	{
		$user	= &JFactory::getUser();
		$db 	=& JFactory::getDBO();
		$row 	=& JTable::getInstance('package', 'Table');
		if ($this->_task == 'edit') {
			$cid	= JRequest::getVar('cid', array(0), 'method', 'array');
			$cid	= array((int) $cid[0]);
		} else {
			$cid	= array( 0 );
		}

		$row->load( $cid[0] );
			
		if ($cid) {
			$row->checkout( $user->get( 'id' ) );
		}
		
		$db->setQuery( "SELECT id AS value, label AS text FROM #__fabrik_tables" ); 
		$tables = $db->loadObjectList( );
		$tables = array_merge( array(JHTML::_('select.option', '', '-' )), $tables);
		
		$model = JModel::getInstance( 'Package', 'FabrikModel' );
		$model->setId( $cid[0] );
		$model->getPackage();
		$selectTables = $model->loadTables( );
		$aSelTables = array();
		if (!empty( $selectTables )) {
			foreach ($selectTables as $selTable) {
				$aSelTables[] = JHTML::_('select.genericlist',  $tables, 'tables[]', 'class="inputbox"','value','text', $selTable->id, "table_" . $selTable->id );
			}
		} else {
			$aSelTables[] = JHTML::_('select.genericlist',  $tables, 'tables[]', 'class="inputbox"','value','text', '' );
		}
		if ($this->_task == 'edit') {
			$and = "\n AND link LIKE 'index.php?option=com_fabrik&act=package&id=".$model->_id."'";
			$and2 = "\n AND link = 'index.php?option=com_fabrik&view=package' and params like '%packageid=".$model->_id."%'";
			//$menus2 = FabrikHelperMenu::Links2Menu( 'url', $and );
			$menus = FabrikHelperMenu::Links2Menu( 'component', $and2 );
			//$menus = array_merge( $menus , $menus2 );
		} else {
			$menus = array();
		}
	
    $lists['template'] 		= FabrikHelperAdminHTML::templateList( 'package', $row->template );
		$lists['menuselect'] 	= FabrikHelperMenu::MenuSelect();
		require_once(JPATH_COMPONENT.DS.'views'.DS.'package.php');
		FabrikViewPackage::edit( $row, $aSelTables, $lists, $menus );
	}
	
	/**
	 * Save a connection
	 */

	function save()
	{
		// Check for request forgeries
		JRequest::checkToken() or die( 'Invalid Token' );
		
		jimport('joomla.utilities.date');
		$now = new JDate();
		$now = $now->toUnix();
		$db =& JFactory::getDBO();
		$user	  = &JFactory::getUser();
		$row =& JTable::getInstance('package', 'Table');
	
	
		$post	= JRequest::get( 'post' );
		if (!$row->bind( $post )) {
			return JError::raiseWarning( 500, $row->getError() );
		} 
	
		// save params
		$params =& new fabrikParams($row->attribs, JPATH_COMPONENT.DS.'xml'.DS.'package.xml');
		$row->attribs = $params->updateAttribsFromParams( JRequest::getVar( 'params', array(), 'post', 'array' ) );
		
		$row->tables = implode( ",", JRequest::getVar( 'tables', array(), 'post') );
		if ($row->id == 0) {
			$row->created = $now;
		} else {
			$row->modified = $now;
			$row->modified_by = $user->get( 'id' );
		}
		
		if (!$row->store( )) {
			return JError::raiseWarning( 500, $row->getError() );
		} 
		$row->checkin( );
		
		$task = JRequest::getCmd( 'task' );
		$msg = JText::_( 'Package Saved' );
		
		switch ($task)
		{
			case 'apply':
				$link = 'index.php?option=com_fabrik&c=package&task=edit&cid[]='. $row->id ;
				break;
				
			case 'menulinkPackage':
				JRequest::setVar( 'cid', null);
				FabrikHelperMenu::menuLink( 'package', 'packageid='.$row->id );
				$msg = JText::_( 'Menu link created' );
				$link = "index.php?option=com_fabrik&c=package&task=edit&cid[]=".$row->id;
				break;
			case 'go2menu':
				$menu		= JRequest::getvar( 'menu', 'mainmenu' );
				$link = "index.php?option=com_menus&task=view&menutype=$menu";
				break;
			case 'go2menuitem':
				$menu		= JRequest::getvar( 'menu', 'mainmenu' );
				$menuid = JRequest::getvar( 'menuid', 0 );
				$link = "index.php?option=com_menus&menutype=".$menu."&task=edit&cid[]=".$menuid;
				break;
			case 'save':
			default:
				$link = 'index.php?option=com_fabrik&c=package';
				break;
		}
		$this->setRedirect( $link, $msg );
		

	}
	
	/**
	 * Publish a connection
	 */

	function publish()
	{
		// Check for request forgeries
		JRequest::checkToken() or die( 'Invalid Token' );
	}

	/**
	 * Display the list of packages
	 */

	function display()
	{
		global $mainframe;
		$db =& JFactory::getDBO();
		// get the total number of records
		$db->setQuery( "SELECT count(*) FROM #__fabrik_packages" );
		$total = $db->loadResult();
		$context		= 'com_fabrik.package.list.';
		$limit			= $mainframe->getUserStateFromRequest( $context.'limit', 'limit', $mainframe->getCfg('list_limit'), 'int' );
		$limitstart = $mainframe->getUserStateFromRequest( $context.'limitstart', 'limitstart', 0, 'int' );
		$sql = "SELECT * FROM #__fabrik_packages";
		$db->setQuery( $sql, $limitstart, $limit );
		jimport('joomla.html.pagination');
		$pageNav =& new JPagination( $total, $limitstart, $limit );
		$rows = $db->loadObjectList( );
		require_once(JPATH_COMPONENT.DS.'views'.DS.'package.php');
		FabrikViewPackage::show( $rows, $pageNav );
	}
	
	/**
	 * copy a package
	 * @param int package id
	 */
	 
	function copy( )
	{
		// Check for request forgeries
		JRequest::checkToken() or die( 'Invalid Token' );
		
		$this->setRedirect( 'index.php?option=com_fabrik&c=package' );

		$cid		= JRequest::getVar( 'cid', null, 'post', 'array' );
		$db			=& JFactory::getDBO();
		$rule		=& JTable::getInstance('package', 'Table');
		$user		= &JFactory::getUser();
		$n			= count( $cid );

		if ($n > 0)
		{
			foreach ($cid as $id)
			{
				if ($rule->load( (int)$id ))
				{
					$rule->id				= 0;
					if (!$rule->store()) {
						return JError::raiseWarning( $rule->getError() );
					}
				}
				else {
					return JError::raiseWarning( 500, $rule->getError() );
				}
			}
		}
		
		else {
			return JError::raiseWarning( 500, JText::_( 'No items selected' ) );
		}
		$this->setMessage( JText::sprintf( 'Items copied', $n ) );
	}
	
	/**
	 * delete package
	 */
	 
	function remove( )
	{
		// Check for request forgeries
		JRequest::checkToken() or die( 'Invalid Token' );
		
		$this->setRedirect( 'index.php?option=com_fabrik&c=package' );

		// Initialize variables
		$db		=& JFactory::getDBO();
		$cid	= JRequest::getVar( 'cid', array(), 'post', 'array' );
		$n		= count( $cid );
		JArrayHelper::toInteger( $cid );
		
		if ($n)
		{
			$query = 'DELETE FROM #__fabrik_packages'
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