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
require_once( COM_FABRIK_FRONTEND.DS.'helpers'.DS.'html.php' );
require_once( COM_FABRIK_FRONTEND.DS.'helpers'.DS.'parent.php' );
require_once( COM_FABRIK_BASE.DS.'administrator'.DS.'components'.DS.'com_fabrik'.DS.'helpers'.DS.'adminhtml.php' );

/**
 * @package		Joomla
 * @subpackage	Fabrik
 */

class FabrikControllerElement extends JController
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
		$this->registerTask( 'removeFromTableview', 'addToTable' );
		$this->registerTask( 'addToTableView', 'addToTable' );
		$this->registerTask( 'orderDownElement', 'reorder' );
		$this->registerTask( 'orderUpElement', 'reorder' );
	}
	
	function reorder()
	{
		
		// Check for request forgeries
		JRequest::checkToken() or die( 'Invalid Token' );
		
		$this->setRedirect( 'index.php?option=com_fabrik&c=element' );
		
		$task		= JRequest::getCmd( 'task' );
		
		$direction 	= ($task == 'orderUpElement') ? -1 : 1;
		
		// Initialize variables
		$db		= & JFactory::getDBO();
		$cid	= JRequest::getVar( 'cid', array(), 'post', 'array' );
		if (isset( $cid[0] ))
		{
			$row = & JTable::getInstance('element', 'Table');
			$row->load( (int) $cid[0] );
			$where = " group_id = '" . $row->group_id . "'";
			$row->move($direction, $where );

		}
		$this->setMessage( JText::_( 'Items reordered' ) );
	}
	
	/**
	 * used when top save order button pressed
	 *
	 * @return unknown
	 */
	function saveOrder()
	{
		
		global $mainframe;

		// Check for request forgeries
		JRequest::checkToken() or die( 'Invalid Token' );

		// Initialize variables
		$db			= & JFactory::getDBO();

		$cid			= JRequest::getVar( 'cid', array(0), 'post', 'array' );
		$order		= JRequest::getVar( 'order', array (0), 'post', 'array' );
		$redirect	= JRequest::getVar( 'redirect', 0, 'post', 'int' );
		$rettask	= JRequest::getVar( 'returntask', '', 'post', 'cmd' );
		$total		= count($cid);
		$conditions	= array ();

		JArrayHelper::toInteger($cid, array(0));
		JArrayHelper::toInteger($order, array(0));

		// Instantiate an article table object
		$row = & JTable::getInstance('element', 'Table');

		// Update the ordering for items in the cid array
		for ($i = 0; $i < $total; $i ++)
		{
			$row->load( (int) $cid[$i] );
			if ($row->ordering != $order[$i]) {
				$row->ordering = $order[$i];
				if (!$row->store()) {
					JError::raiseError( 500, $db->getErrorMsg() );
					return false;
				}
				// remember to updateOrder this group
				$condition = 'group_id = '.(int) $row->group_id;
				$found = false;
				foreach ($conditions as $cond)
					if ($cond[1] == $condition) {
						$found = true;
						break;
					}
				if (!$found)
					$conditions[] = array ($row->id, $condition);
			}
		}

		// execute updateOrder for each group
		foreach ($conditions as $cond)
		{
			$row->load($cond[0]);
			$row->reorder($cond[1]);
		}

		$cache = & JFactory::getCache('com_fabrik');
		$cache->clean();

		$msg = JText::_('New ordering saved');

		$mainframe->redirect('index.php?option=com_fabrik&c=element', $msg);

	}
	
	/**
	 * add/remove from table view
	 * @param mixed array/int elements to add/remove to table
	 * @param bol add = true/remove = false; 
	 */
	
	function addToTable( )
	{
		
		// Check for request forgeries
		JRequest::checkToken() or die( 'Invalid Token' );
		
		$this->setRedirect( 'index.php?option=com_fabrik&c=element' );

		// Initialize variables
		$db			=& JFactory::getDBO();
		$user		=& JFactory::getUser();
		$cid		= JRequest::getVar( 'cid', array(), 'post', 'array' );
		$task		= JRequest::getCmd( 'task' );
		$publish	= ($task == 'addToTableView');
		$n			= count( $cid );

		if (empty( $cid )) {
			return JError::raiseWarning( 500, JText::_( 'No items selected' ) );
		}

		JArrayHelper::toInteger( $cid );
		$cids = implode( ',', $cid );

		$query = 'UPDATE #__fabrik_elements'
		. ' SET show_in_table_summary = ' . (int) $publish
		. ' WHERE id IN ( '. $cids.'  )'
		. ' AND ( checked_out = 0 OR ( checked_out = ' .(int) $user->get('id'). ' ) )'
		;
		$db->setQuery( $query );
		if (!$db->query()) {
			return JError::raiseWarning( 500, $row->getError() );
		}
		$this->setMessage( JText::sprintf( $publish ? 'Items added to table view' : 'Items removed from table view', $n ) );
	}

	
	/**
	 * Edit an element
	 */

	function edit()
	{
		global $mainframe;
		$user		=& JFactory::getUser();
		$db 		=& JFactory::getDBO();
		$acl 		=& JFactory::getACL();
		$model	=& JModel::getInstance( 'element', 'FabrikModel' );
		if ($this->_task == 'edit') {
			$cid	= JRequest::getVar( 'cid', array(0), 'method', 'array' );
			$cid	= array((int) $cid[0]);
		} else {
			$cid	= array( 0 );
		}
		$model->setId( $cid[0] );
		$row =& $model->getElement();
			
		if ($cid) {
			$row->checkout( $user->get( 'id' ) );
		}
		
		// get params definitions
		$params =& $model->getParams();
		require_once( JPATH_COMPONENT.DS.'views'.DS.'element.php' );
		
		$pluginManager =& JModel::getInstance( 'Pluginmanager', 'FabrikModel' );

		$db->setQuery( "SELECT count(*) FROM #__fabrik_groups" );
		$total 			= $db->loadResult( );
		if ($total == 0) {
			$mainframe->redirect( "index.php?option=com_fabrik&c=group&task=new", JText::_('Please create a group before creating an element' ) );
		} else {
			$lists = $model->getAdvancedJoins( $params, $pluginManager );
			
			if ($cid == '0') { 
				// set the publsih default to 1
				$row->state = '1';
			}
			
			$oConn =& JModel::getInstance( 'Connection', 'FabrikModel' );
			$oConn->loadDefaultConnection( );
			$javascript = "";
			
			$oValidations = $model->getValidations();
			$oValidationRules = $pluginManager->getPlugInGroup( 'validationrule' );	

			$aValidations = array( );
			if (is_array( $oValidations )) {
				foreach ($oValidations as $oVal) {
					$validationParams 	=& new fabrikParams( $oVal->attribs, JPATH_SITE .'/administrator/components/com_fabrik/xml/validation.xml', 'component');
					$validationrulelist = JHTML::_('select.genericlist',  $oValidationRules, 'validation_plugin[]', "class=\"inputbox\"  size=\"1\" ", '_pluginName', '_pluginLabel', $oVal->validation_plugin );
					$aValidations[] 		= array( $oVal->message, $validationrulelist, $validationParams->get( 'validation_condition' ), $oVal->id );
				}
			}
			
			$lists['validations'] 			= $aValidations;
			$validationrulelist 				= JHTML::_('select.genericlist', $oValidationRules, 'validation_plugin[]', "class=\"inputbox\"  size=\"1\" ", '_pluginName', '_pluginLabel', '' );
			$lists['validationrulelist'] = $validationrulelist;
			
			$pluginManager->loadPlugInGroup( 'element' );	
			
			$defaultJSActions = $model->getJSDefaultActions( );
			$lists['jsDefaultActions'] 	= $model->getJSEventTypesDd( $defaultJSActions );
			$lists['jsActions'] 		= $model->getJSActionsDd( $defaultJSActions );
			
			// get the available element types
			
			$no_html	=  JRequest::getBool( 'no_html', 0 );
			
			// Create the form
			$form = new JParameter( '', JPATH_COMPONENT.DS.'models'.DS.'element.xml' );
			$form->bind( $row );
			$form->loadINI( $row->attribs );
			
			if ( $row->parent_id != '') {
				$sql = "select * from #__fabrik_elements where id = '$row->parent_id'";
				$db->setQuery( $sql );
				$parent = $db->loadObject();
				$lists['parent'] = $parent;
			} else {
				$lists['parent'] = null;
			}
			if ($no_html != 1) {
				FabrikViewElement::edit( $row, $pluginManager, $lists, $params, $form );
			}
		}
	}
	
	/**
	 * when you go from a child to parent element, check in child before redirect
	 */

	function parentredirect()
	{
		$id 					= JRequest::getInt( 'id', 0, 'post' );
		$pluginManager	=& JModel::getInstance( 'Pluginmanager', 'FabrikModel' );
		$className 			= JRequest::getVar( 'plugin', 'fabrikfield', 'post' );
		$elementModel 	= $pluginManager->loadPlugIn( $className, 'element' );
		$elementModel->setId( $id );
		$row =& $elementModel->getElement();
		$row->checkin( );
		$to = JRequest::getInt('redirectto');
		$this->_task = 'edit';
		JRequest::setVar('cid', array($to));
		$this->edit();
	}
	
	/**
	 * Save a connection
	 */

	function save()
	{
		// Check for request forgeries
		JRequest::checkToken() or die( 'Invalid Token' );
		jimport('joomla.utilities.date');
		$user	  				= &JFactory::getUser();
		$db 						=& JFactory::getDBO();
		$pluginManager	=& JModel::getInstance( 'Pluginmanager', 'FabrikModel' );
		
		$name = JRequest::getVar( 'name', '', 'post', 'CMD' );
		if (FabrikWorker::isReserved( $name )) {
			return JError::raiseWarning( 500, JText::_( 'Sorry this element name is resevered for use by Fabrik') );
		}
		JRequest::setVar( 'name', strtolower($name) );
		
		$details	= JRequest::getVar( 'details', array(), 'post', 'array');
		$className 			= $details['plugin'];
		
		
		$elementModel 	= $pluginManager->loadPlugIn( $className, 'element' );
		$id 					= JRequest::getInt( 'id', 0, 'post' );
		$elementModel->setId( $id );
		$row =& $elementModel->getElement();
		
		$origGroupId = $row->group_id;

		// $$$ hugh - added maskbits value, otherwise HTML is stripped.
		// we may want to be intelligent about how we set this, but for now
		// just use mask of 4, which allows "safe" HTML.
		$maskbits = 4;
		$post	= JRequest::get( 'post', $maskbits );
		$ar 	= array( 'state', 'use_in_page_title', 'show_in_table_summary', 'link_to_detail', 'can_order', 'filter_exact_match' );
		foreach ($ar as $a) {
			if (!array_key_exists( $a, $post )) {
				$post[$a] = 0;
			}
		}
		
		// $$$ rob - test for change in element type 
		//(eg if changing from db join to field we need to remove the join 
		//entry from the #__fabrik_joins table 
		$origElementModel =& JModel::getInstance( 'Element', 'FabrikModel' );
		$origElementModel->setId( $id );
		$origEl =& $origElementModel->getElement();
		$origElementPluginModel 	=& $pluginManager->loadPlugIn( $origEl->plugin, 'element' );
		$origElementPluginModel->beforeSave();
		
		if ( !$row->bind( $post ) ) {
			return JError::raiseWarning( 500, $row->getError() );
		}
		//unlink linked elements
		if (JRequest::getVar('unlink') == 'on') {
			$row->parent_id = 0;			
		}
		//merge details params into element table fields
		
		if (!array_key_exists( 'eval', $details )) {
			$details['eval'] = 0;
		}
		if (!array_key_exists( 'hidden', $details )) {
			$details['hidden'] = 0;
		}
		$row->bind( $details );
		$datenow = new JDate();
		if ($row->id != 0) {
			$row->modified 		= $datenow->toFormat();
			$row->modified_by = $user->get('id');
		} else {
			$row->created 		= $datenow->toFormat();
			$row->created_by = $user->get('id');
			$row->created_by_alias = $user->get('username');
		}
		// 	save params
		$params = $elementModel->getParams();
		$row->attribs = $params->updateAttribsFromParams( JRequest::getVar( 'params', array(), 'post', 'array' ) );
		
		$cond = 'group_id = '.(int) $row->group_id;
		
		if ($row->id == 0) {
			$row->ordering = $row->getNextOrder( $cond );
		}
		
		if (!$row->store( )) {
			return JError::raiseWarning( 500, $row->getError() );
		} 
		$row->checkin( );
		
		$row->reorder( $cond );
		$elementModel->setId( $row->id );
		$origName 	=  JRequest::getVar( 'name_orig', '', 'post', 'cmd' );
		$new = ( $id == '0' || $origGroupId != $row->group_id ) ? true: false;
		$elementModel->addElementToDatabaseTable( $new, $origName );
		$elementModel->updateValidations( );
		$elementModel->updateJavascript( );
		$elementModel->onSave();
		
		//update child elements
		$db->setQuery("SELECT	id FROM #__fabrik_elements WHERE parent_id = $row->id");
		$childids = $db->loadResultArray();
		$ignore = array( '_tbl', '_tbl_key', '_db', 'id', 'group_id', 'created', 'created_by', 'parent_id', 'ordering'  );
		foreach ($childids as $id) {
			$table =& JTable::getInstance('element','Table');
			$table->load($id);
			foreach ($row as $key=>$val) {
				if (!in_array( $key, $ignore )) {
					$table->$key = $val; 
				}
			}
			if (!$table->store( )) {
				return JError::raiseWarning( 500, $table->getError() );
			} 
		
		}
		$task = JRequest::getCmd( 'task' );
	
		switch ($task)
		{
			case 'apply':
				$link = 'index.php?option=com_fabrik&c=element&task=edit&cid[]='. $row->id ;
				break;

			case 'save':
			default:
				$link = 'index.php?option=com_fabrik&c=element';
				break;
		}
		$this->setRedirect( $link, JText::_( 'Element Saved' ) );
	}
	
	/**
	 * Publish a element
	 */

	function publish()
	{
		// Check for request forgeries
		JRequest::checkToken() or die( 'Invalid Token' );
		
		$this->setRedirect( 'index.php?option=com_fabrik&c=element' );

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

		$query = 'UPDATE #__fabrik_elements'
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
	 * Display the list of elements
	 */

	function display()
	{
		global $mainframe;
		$db =& JFactory::getDBO();
		$context					= 'com_fabrik.element.list.';
		$filter_order			= $mainframe->getUserStateFromRequest( $context.'filter_order',		'filter_order',	'ordering',	'cmd' );
		$filter_order_Dir	= $mainframe->getUserStateFromRequest( $context.'filter_order_Dir',	'filter_order_Dir',	'',			'word' );
		$limit						= $mainframe->getUserStateFromRequest( $context.'limit', 'limit', $mainframe->getCfg('list_limit'), 'int' );
		$limitstart 			= $mainframe->getUserStateFromRequest( $context.'limitstart', 'limitstart', 0, 'int' );
		
		$filter_elementTypeId	= $mainframe->getUserStateFromRequest( $context."filter_elementTypeId", 'filter_elementTypeId', '' );
		$filter_groupId 		= $mainframe->getUserStateFromRequest( $context."filter_groupId", 'filter_groupId', 0 );
		$search 						= $mainframe->getUserStateFromRequest( $context."filter_elementName", 'filter_elementName', '' );
		$filter_showInTable	= $mainframe->getUserStateFromRequest( $context."filter_showInTable", 'filter_showInTable', '' );
		$filter_published 	= $mainframe->getUserStateFromRequest( $context."filter_published", 'filter_published', '' );
		
		$lists = array ( );
		$where = array();
		
		// table ordering
		$lists['order_Dir']	= $filter_order_Dir;
		$lists['order']		= $filter_order;
		
		
		// used by filter
		if ($filter_elementTypeId != '') {
			$where[] = " e.plugin = '$filter_elementTypeId' ";
		}
		//used by filter
		if ($filter_groupId >= 1) {
			$where[] = " e.group_id = '$filter_groupId' ";
		}
		// filter the element names
		if ($search != '') {
			$where[] = " e.name LIKE '%$search%' OR e.label LIKE '%$search%'";
		}
		// filter if its shown in table
		if ($filter_showInTable != '') {
			$where[] = " e.show_in_table_summary  = '$filter_showInTable'";
		}
	
		// filter if its published
		if ($filter_published != '') {
			$where[] = " e.state  = '$filter_published'";
		}
		$where		= count( $where ) ? ' WHERE ' . implode( ' AND ', $where ) : '';
		$orderby	= ' ORDER BY '. $filter_order .' '. $filter_order_Dir .', g.id,  e.ordering';
		
		// get the total number of records
		$db->setQuery( "SELECT COUNT(*) FROM #__fabrik_elements AS e ". $where );
		$total = $db->loadResult();
		echo $db->getErrorMsg();

		jimport('joomla.html.pagination');
		$pageNav 			= new JPagination( $total, $limitstart, $limit );
		
		$sql = "SELECT *,u.name AS editor, e.id AS id, " .
			"\n e.checked_out AS checked_out, #__fabrik_plugins.label AS pluginlabel,	 " .
			"\n e.checked_out_time AS checked_out_time, " .
			"\n e.state as state, g.name AS group_name, " .
			"\n e.name AS name, e.label AS label " .
			"\n FROM #__fabrik_elements AS e  " .
			"\n LEFT JOIN #__fabrik_groups AS g " .
			"\n ON e.group_id = g.id " .
			"\n LEFT JOIN #__fabrik_plugins  " .
			"\n ON e.plugin = #__fabrik_plugins.name " .
			"\n LEFT JOIN #__users AS u ON e.checked_out = u.id ".
			"\n $where $orderby ";

		$db->setQuery( $sql, $pageNav->limitstart, $pageNav->limit );
		$rows 				= $db->loadObjectList( );

		//element types
		$pluginManager	 	=& JModel::getInstance( 'Pluginmanager', 'FabrikModel' );
		$pluginManager->_group = 'element';
		$lists['elementId'] = $pluginManager->getElementTypeDd( $filter_elementTypeId, 'filter_elementTypeId', 'class="inputbox"  onchange="document.adminForm.submit( );"', '- ' . JText::_( 'Element type' ) . ' -' );
		
		//groups into a drop down list
		$groupModel 			= JModel::getInstance( 'Group', 'FabrikModel' );
		$lists['groupId'] 	= $groupModel->makeDropDown( $filter_groupId,  '- ' . JText::_( 'Group' ) . ' -' );
		
		$yesNoList 			= FabrikHelperHTML::yesNoOptions( '', '- ' . JText::_( 'Show in table' ) . ' -');
		$lists['filter_showInTable'] = JHTML::_( 'select.genericlist',  $yesNoList, 'filter_showInTable', 'class="inputbox"  onchange="document.adminForm.submit( );"', 'value', 'text', $filter_showInTable );

		//filter on published list
		$yesNoList 			= FabrikHelperHTML::yesNoOptions( '', '- ' . JText::_( 'Published' ) . ' -' );
		$lists['filter_published'] = JHTML::_( 'select.genericlist', $yesNoList, 'filter_published', 'class="inputbox"  onchange="document.adminForm.submit( );"', 'value', 'text', $filter_published );
		$lists['search'] = $search;
		
		require_once( JPATH_COMPONENT.DS.'views'.DS.'element.php' );
		FabrikViewElement::show( $rows, $pageNav, $lists );
	}
	
	/**
	 * copy a connection
	 * @param int connection id
	 */
	 
	function copy( )
	{
		// Check for request forgeries
		JRequest::checkToken() or die( 'Invalid Token' );
		
		$this->setRedirect( 'index.php?option=com_fabrik&c=element' );

		$cid		= JRequest::getVar( 'cid', null, 'post', 'array' );
		$db			=& JFactory::getDBO();
		$rule		=& JTable::getInstance('element', 'Table');
		$user		= &JFactory::getUser();
		$n			= count( $cid );

		if ($n > 0)
		{
			foreach ($cid as $id)
			{
				if ($rule->load( (int)$id ))
				{
					$rule->id				= 0;
					$rule->name	= 'Copy of ' . $rule->name;
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
	 * delete element
	 */
	 
	function remove( )
		{
		// Check for request forgeries
		JRequest::checkToken() or die( 'Invalid Token' );
		
		$this->setRedirect( 'index.php?option=com_fabrik&c=element' );

		// Initialize variables
		$db		=& JFactory::getDBO();
		$cid	= JRequest::getVar( 'cid', array(), 'post', 'array' );
		$n		= count( $cid );
		JArrayHelper::toInteger( $cid );
		if ($n)
		{
			$query = 'DELETE FROM #__fabrik_elements'
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