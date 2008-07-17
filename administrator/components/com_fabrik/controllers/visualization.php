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
JModel::addIncludePath( COM_FABRIK_FRONTEND.DS.'models' );

require_once( COM_FABRIK_FRONTEND.DS.'helpers'.DS.'params.php' );
require_once( COM_FABRIK_FRONTEND.DS.'helpers'.DS.'json.php' );
require_once( COM_FABRIK_BASE.DS.'administrator'.DS.'components'.DS.'com_fabrik'.DS.'helpers'.DS.'menu.php' );
require_once( COM_FABRIK_BASE.DS.'administrator'.DS.'components'.DS.'com_fabrik'.DS.'helpers'.DS.'adminhtml.php' );
require_once( COM_FABRIK_BASE.DS.'administrator'.DS.'components'.DS.'com_fabrik'.DS.'helpers'.DS.'fabrik.php' );
JModel::addIncludePath( COM_FABRIK_FRONTEND.DS.'models' );

/**
 * @package		Joomla
 * @subpackage	Fabrik
 */

class FabrikControllerVisualization extends JController
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
		$this->registerTask( 'menulinkVisualization', 'save' );
		$this->registerTask( 'go2menu', 'save' );
		$this->registerTask( 'go2menuitem', 'save' );
	}
	
	/**
	 * Edit a connection
	 */

	function edit()
	{
		$user	  = &JFactory::getUser();
		$db 		=& JFactory::getDBO();
		$row 		=& JTable::getInstance( 'visualization', 'Table' );
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
		
		// get params definitions
		$params = new fabrikParams($row->attribs, JPATH_COMPONENT.DS.'xml'.DS.'visualization.xml');
		require_once(JPATH_COMPONENT.DS.'views'.DS.'visualization.php');

		//build list of visualization plugins
		$pluginManager	 	=& JModel::getInstance( 'Pluginmanager', 'FabrikModel' );
		$pluginManager->loadPlugInGroup( 'visualization' );
		
		$lists['plugins'] = $pluginManager->getElementTypeDd( $row->plugin, 'plugin', 'class="inputbox"' );
		
		//build list of menus
		$lists['menuselect'] = FabrikHelperMenu::MenuSelect( );
		if ($row->id != '') { 
			//only existing tables can have a menu linked to them
			$and = "\n AND link LIKE 'index.php?option=com_fabrik&view=visualization%'";
			$and .= " AND params LIKE '%visualizationid=".$row->id."%'";
			$menus = FabrikHelperMenu::Links2Menu('component', $and );
		} else {
			$menus = null;
		}
		
		//get table and connection drop downs
		$db->setQuery( "SELECT id AS value, label AS text FROM #__fabrik_tables");
		$rows = $db->loadObjectList();
		$default = '';
		$lists['tables'] 	= JHTML::_('select.genericlist', $rows, 'table[]', "class=\"inputbox\"  size=\"1\" ", 'value', 'text', $default );
		
		// Create the form
		$form = new JParameter('', JPATH_COMPONENT.DS.'models'.DS.'visualization.xml');
		$form->bind($row);
		$form->set('created', JHTML::_('date', $row->created, '%Y-%m-%d %H:%M:%S'));
		$form->set('publish_up', JHTML::_('date', $row->publish_up, '%Y-%m-%d %H:%M:%S'));

		if ($cid[0] == 0 || $form->get('publish_down') == '' || $form->get('publish_down') ==  $db->getNullDate()) {
			$form->set('publish_down', JText::_('Never'));
		} else {
			$form->set('publish_down', JHTML::_('date', $row->publish_down, '%Y-%m-%d %H:%M:%S'));
		}
		
		FabrikViewVisualization::edit( $row, $params, $lists, $menus, $pluginManager, $form );
	}
	
	/**
	 * Save a visualization
	 */

	function save()
	{
		// Check for request forgeries
		JRequest::checkToken() or die( 'Invalid Token' );
		$task = JRequest::getCmd( 'task' );
		$pluginManager	=& JModel::getInstance( 'Pluginmanager', 'FabrikModel' );
		$className 			= JRequest::getVar( 'plugin', 'calendar', 'post' );
		$pluginModel 		=& $pluginManager->loadPlugIn( $className, 'visualization' );
		$id 						= JRequest::getInt('id', 0, 'post');
		$pluginModel->setId( $id );
		
		$row =& JTable::getInstance( 'visualization', 'Table' );
		
		$post	= JRequest::get( 'post' );
		
		if ( !$row->bind( $post ) ) {
			return JError::raiseWarning( 500, $row->getError() );
		}
		
		$filter	= new JFilterInput( null, null, 1, 1 );
		$intro_text = JRequest::getVar( 'intro_text', '', 'post', 'string', JREQUEST_ALLOWRAW );
		$row->intro_text =$filter->clean( $intro_text );

		$details	= JRequest::getVar( 'details', array(), 'post', 'array');
		$row->bind($details);
		
		// 	save params
		$pluginModel->attribs =& $row->attribs;
		$params = $pluginModel->getParams();
		$row->attribs = $params->updateAttribsFromParams( JRequest::getVar( 'params', array(), 'post', 'array' ) );
		FabrikHelperFabrik::publishDown( $row->publish_down );
		
		if (!$row->store( )) {
			return JError::raiseWarning( 500, $row->getError() );
		} 
		$row->checkin( );
		
		switch ($task)
		{
			case 'apply':
				$link = 'index.php?option=com_fabrik&c=visualization&task=edit&cid[]='. $row->id ;
				$msg = JText::_( 'Visualization Saved' );
				break;

			case 'save':
			default:
				$link = 'index.php?option=com_fabrik&c=visualization';
				$msg = JText::_( 'Visualization Saved' );
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
				
			case 'menulinkVisualization':
				FabrikHelperMenu::menuLink( 'visualization', 'visualizationid='.$row->id );
				$msg = JText::_('Menu link created' );
				$link = 'index.php?option=com_fabrik&c=visualization&task=edit&cid[]='. $row->id ;
				break;
		}
		$this->setRedirect( $link, $msg );
	}
	
	/**
	 * Publish a visualization
	 */

	function publish()
	{
		// Check for request forgeries
		JRequest::checkToken() or die( 'Invalid Token' );
		
		$this->setRedirect( 'index.php?option=com_fabrik&c=visualization' );

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

		$query = 'UPDATE #__fabrik_visualizations'
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
	 * Display the list of Visualizations
	 */

	function display()
	{
		global $mainframe;
		$db =& JFactory::getDBO();
		$context					= 'com_fabrik.vizualization.list.';
		$filter_plugin	= $mainframe->getUserStateFromRequest( $context."filter_plugin", 'filter_plugin', '' );
		//get active vizulalization plugins
		$pluginManager	 	=& JModel::getInstance('Pluginmanager', 'FabrikModel');
		$pluginManager->_group = 'visualization';
		$pluginManager->loadPlugInGroup( 'visualization' );
		$lists['vizualizations'] = $pluginManager->getElementTypeDd( $filter_plugin, 'filter_plugin', 'class="inputbox"  onchange="document.adminForm.submit( );"', '- ' . JText::_('Select Plugin Type') . ' -' );
		
		// get the total number of records
		$db->setQuery( "SELECT count(*) FROM #__fabrik_visualizations" );
		$total = $db->loadResult();
		echo $db->getErrorMsg();

		$limit		= $mainframe->getUserStateFromRequest( $context.'limit', 'limit', $mainframe->getCfg('list_limit'), 'int' );
		$limitstart = $mainframe->getUserStateFromRequest( $context.'limitstart', 'limitstart', 0, 'int' );
		
		$sql = "SELECT * FROM #__fabrik_visualizations";
		$db->setQuery( $sql, $limitstart, $limit );
		jimport('joomla.html.pagination');
		$pageNav = new JPagination( $total, $limitstart, $limit );
		$rows = $db->loadObjectList( );
		require_once(JPATH_COMPONENT.DS.'views'.DS.'visualization.php');
		FabrikViewVisualization::show( $rows, $pageNav, $lists  );
	}
	
	/**
	 * copy a connection
	 */
	 
	function copy( )
	{
		// Check for request forgeries
		JRequest::checkToken() or die( 'Invalid Token' );
		
		$this->setRedirect( 'index.php?option=com_fabrik&c=visualization' );

		$cid		= JRequest::getVar( 'cid', null, 'post', 'array' );
		$db			=& JFactory::getDBO();
		$rule		=& JTable::getInstance('visualization', 'Table');
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
		}else {
			return JError::raiseWarning( 500, JText::_( 'No items selected' ) );
		}
		$this->setMessage( JText::sprintf( 'Items copied', $n ) );
	}
	
	/**
	 * remove visualization
	 */
	 
	function remove( )
	{
		// Check for request forgeries
		JRequest::checkToken() or die( 'Invalid Token' );
		
		$this->setRedirect( 'index.php?option=com_fabrik&c=visualization' );

		// Initialize variables
		$db		=& JFactory::getDBO();
		$cid	= JRequest::getVar( 'cid', array(), 'post', 'array' );
		$n		= count( $cid );
		JArrayHelper::toInteger( $cid );
		
		if ($n)
		{
			$query = 'DELETE FROM #__fabrik_visualizations'
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