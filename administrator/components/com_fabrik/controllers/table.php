<?php
/**
* @version 
* @package Joomla
* @subpackage Fabrik
* @copyright Copyright (C) 2005 Rob Clayburn. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/

/**
 * @package		Joomla
 * @subpackage	Fabrik
 * @license		GNU/GPL, see LICENSE.php
 */

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.controller' );
jimport( 'joomla.application.component.model' );

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

class FabrikControllerTable extends JController
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
    $this->registerTask( 'menuLinkTable', 'save' );
    $this->registerTask( 'unpublish',	'publish' );
    $this->registerTask( 'go2menu', 'save' );
    $this->registerTask( 'go2menuitem', 'save' );
  }

  /**
   * delete table rows
   */
  function delete()
  {
    $model =& JModel::getInstance('Table', 'FabrikModel');
    $model->setId( JRequest::getVar( 'tableid' ) );
    $model->getTable();

    if ($model->deleteTableRows( JRequest::getVar( 'ids' ))){
      $msg = JText::_('records deleted');
    }else{
      $msg = '';
    }
    $link = "index.php?option=com_fabrik&c=table&task=viewTable&cid[]=".$model->_id;
    $this->setRedirect( $link, $msg );
  }

  /**
   *
   */

  function viewTable()
  {
    $document =& JFactory::getDocument();
    $cid	= JRequest::getVar( 'cid', array(0), 'method', 'array' );
    if(is_array($cid)){$cid = $cid[0];}

    $model =& JModel::getInstance( 'Table', 'FabrikModel' );
    $model->setId( JRequest::getInt( 'tableid', $cid, 'post') );
    $model->getTable();
    $model->setAdmin( true );
    JRequest::setVar( 'view', 'Table' );

    $viewType	= $document->getType();
    $viewName	= JRequest::getCmd( 'view', $this->_name );
    $viewLayout	= JRequest::getCmd( 'layout', 'default' );

    $view = & $this->getView( $viewName, $viewType, '', array( 'base_path'=>$this->_basePath));

    $view->setModel( $model, true );
    $view->_admin = true;

    // Set the layout
    $view->setLayout( $viewLayout );

    //include admin top bar
    //JToolBarHelper::cancel( ); //doesnt work as no adminForm

    //todo check for cached version

    $view->display();
  }

  /**
   * Edit a table
   */

  function edit()
  {
    global $mainframe;
    $user	=& JFactory::getUser();
    $db 	=& JFactory::getDBO();
    $row 	=& JTable::getInstance('table', 'Table');
    $acl 	=& JFactory::getACL();
    $config =& JFactory::getConfig();

    if ($this->_task == 'edit') {
      $cid	= JRequest::getVar('cid', array(0), 'method', 'array');
      $cid	= array((int) $cid[0]);
    } else {
      $cid	= array( 0 );
    }

    $connectionTables = array( );
    //  this only appears if you are automatically creating the table from an existing form - which has no table associated with it
    $fabrikid 	= JRequest::getVar( 'fabrikid', '', 'get' );
    $row->load( $cid[0] );
    $params = new fabrikParams( $row->attribs, JPATH_COMPONENT.DS.'model'.DS.'table.xml');
    $lists['tablejoin'] = "";
    $lists['defaultJoinTables'] = '[]';
    $lists['linkedtables']  = array();
    $formModel 	=& JModel::getInstance( 'Form', 'FabrikModel' );
    $connModel 	=& JModel::getInstance( 'Connection', 'FabrikModel' );
    $model =& JModel::getInstance( 'Table', 'FabrikModel' );
    $model->setId( $cid[0] );
    $model->_table = $row;
    $aJoinObjs = array( );
    if ($this->_task != 'edit') {
      $row->publish_up = date( 'Y-m-d', time() + $config->getValue('offset') * 60 * 60 );
      $row->template = 'default';
      $realCnns 				= $connModel->getConnections( );
      $javascript 			= "onchange=\"changeDynaList( 'db_table_name', connectiontables, document.adminForm.connection_id.options[document.adminForm.connection_id.selectedIndex].value, 0, 0);\"";
      $lists['connections'] 	= $connModel->getConnectionsDd( $realCnns, $javascript , 'connection_id', '');
      $connectionTables 		= $connModel->getConnectionTables( $realCnns );
      $javascript 	= '';
      $lists['tablename'] = 	'<select name="db_table_name" id="tablename" class="inputbox" size="1" >'.
									'<option value="" selected="selected">' . JText::_( 'Choose a connection first' ) .'</option>'.
									'</select>';

      $lists['order_by'] 				= JText::_( 'Available after table saved' );
      $lists['group_by'] 				= JText::_( 'Available after table saved' );
      $lists['filter-fields'] 	= JText::_( 'Available after table saved' );
      $lists['db_primary_key'] 	= JText::_( 'Available after table saved' );

    } else {
      //if record already exists then you can't change the form or table it points to
      // fail if checked out not by 'me'
      if ($row->checked_out && $row->checked_out != $user->get( 'id' )) {
        $mainframe->redirect( 'index.php?option=com_fabrik', 'The connection '. $row->description .' is currently being edited by another administrator' );
      }
      $row->checkout( $user->get( 'id' ) );

      if ($row->connection_id != "-1") {
        $sql = "SELECT description FROM #__fabrik_connections WHERE id = '$row->connection_id'";
        $db->setQuery( $sql );
        $lists['connections'] = $db->loadResult();
        $lists['tablename'] = "<input type='hidden' name='db_table_name' value='$row->db_table_name' />$row->db_table_name";
      } else {
        $lists['connections'] = "no database";
        $lists['tablename'] = "no table";
      }
      	
      $lists['connections'] .= "<input type=\"hidden\" value=\"$row->connection_id\" id=\"connection_id\" name=\"connection_id\" />";
      $formModel->setId( $row->form_id );
      $formTable = $formModel->getForm( );
      $formModel->getGroupsHiarachy( false, false );
      //table join info
      $sql = "SELECT * FROM #__fabrik_joins WHERE table_id = '$row->id'";
      $db->setQuery( $sql );
      $aJoinObjs = $db->loadObjectList( );
      $lists['joins'] 		 = &$aJoinObjs;
      $lists['order_by'] 		 = $formModel->getElementList( 'order_by', $row->order_by, false, false, true, $aJoinObjs, $row->db_table_name, true );
      $lists['group_by'] 		 = $formModel->getElementList( 'group_by', $row->group_by, false, false, true, $aJoinObjs, $row->db_table_name, true );
      	
      //needs to be table.element format for where statement to work
      $formModel->_addDbQuote = true;
      $lists['filter-fields']  = $formModel->getElementList( 'params[filter-fields][]', '', false, false, true, $aJoinObjs, $row->db_table_name, false );
      $formModel->_addDbQuote = false;
      $els = $formModel->getElementOptions( true, true, true, $aJoinObjs, $row->db_table_name, true );
      $str = "[";
      foreach ($els as $el) {
        $str .= "['$el->value', '$el->text'],";
      }
      $formModel->_addDbQuote = true;
      $lists['db_primary_key'] = $formModel->getElementList( 'db_primary_key', $row->db_primary_key, false, false, true, $aJoinObjs, $row->db_table_name );
      $formModel->_addDbQuote = false;
      	
      //but you can now add table joins
      $connModel->setId( $row->connection_id );
      $connModel->getConnection( $row->connection_id );
      ///load in current connection
      $joinFromTables[] 		= JHTML::_('select.option', '', '-' );
      $joinFromTables[] 		= JHTML::_('select.option', $row->db_table_name, $row->db_table_name );
      $javascript 			= "";
      $lists['defaultjoin'] 	= $connModel->getTableDdForThisConnection( $javascript, 'table_join[]', '', 'inputbox table_key');
      $lists['tablejoin'] 	= $connModel->getTableDdForThisConnection( $javascript, 'table_join[]', '', 'inputbox table_join_key');

      //make a drop down validation type for each validation
      $aActiveJoinTypes = array( );
      	
      if (is_array( $aJoinObjs )) {
        for ($ff = 0; $ff < count( $aJoinObjs ); $ff++) {
          $oJoin = $aJoinObjs[$ff];
          $fields = array();
          $aFields = $model->getDBFields( $oJoin->join_from_table );
          foreach ($aFields as $o) {
          	if (is_array( $o )) {
          		foreach($o as $f) {
          			$fields[] = $f->Field;	
          		}
          	} else {
            	$fields[] = $o->Field;
          	}
          }
          $aJoinObjs[$ff]->joinFormFields = $fields;
          $aFields = $model->getDBFields( $oJoin->table_join );
          $fields = array();
        	foreach ($aFields as $o) {
          	if (is_array( $o )) {
          		foreach ($o as $f) {
          			$fields[] = $f->Field;	
          		}
          	} else {
            	$fields[] = $o->Field;
          	}
          }
          
          $aJoinObjs[$ff]->joinToFields = $fields;
        }
        $lists['defaultJoinTables'] 	= FastJSON::encode( $connModel->getThisTables( true ) );
      }
    }

    if ($row->id != '') {
      //only existing tables can have a menu linked to them
      $and = "\n AND link LIKE '%index.php?option=com_fabrik%' AND link LIKE '%view=table%'";
      $and .= " AND params LIKE '%tableid=".$row->id."'";
      $menus = FabrikHelperMenu::Links2Menu( 'component', $and );
    } else {
      $menus = null;
    }
    $gtree = $acl->get_group_children_tree( null, 'USERS', false );
    $optAll = array( JHTML::_('select.option', '0', ' - Everyone'), JHTML::_('select.option', "26", 'Nobody' ) );
    $gtree2 = array_merge( $gtree, $optAll );

    $lists['filter-access'] 	= JHTML::_( 'select.genericlist',  $gtree2, 'params[filter-access][]', 'class="inputbox" size="6"', 'value', 'text', (intval( $row->access ) == 0)? 29: intval( $row->access ) );
    $lists['menuselect'] 		 	= FabrikHelperMenu::MenuSelect( );
    $lists['tableTemplates'] 	= FabrikHelperAdminHTML::templateList( 'table', $row->template );
    
    // make the filter action drop down
    $filterActions[] 			 	= JHTML::_( 'select.option', 'onchange', JText::_( 'On change' ) );
    $filterActions[] 			 	= JHTML::_( 'select.option', 'submitform', JText::_( 'Submit form' ) );
    $lists['filter_action'] = JHTML::_( 'select.genericlist',  $filterActions, 'filter_action', 'class="inputbox" size="1" ', 'value', 'text', $row->filter_action );
    //make the order direction drop down
    $orderDir[] 				 		= JHTML::_( 'select.option', 'ASC', JText::_( 'Ascending' ) );
    $orderDir[] 				 		= JHTML::_( 'select.option', 'DESC', JText::_( 'Descending' ) );
    $lists['order_dir'] 		= JHTML::_( 'select.genericlist',  $orderDir, 'order_dir', 'class="inputbox" size="1" ', 'value', 'text', $row->order_dir );

    //find tables that link to this table
    $linkedTables = $model->getJoinsToThisKey( );

    $aExisitngLinkedTables = $params->get('linkedtable', '', '_default', 'array');
    $aExisitngLinkedForms = $params->get('linkedform', '', '_default', 'array');

    $aExistingTableHeaders = $params->get( 'linkedtableheader', '', '_default', 'array' );
    $aExistingFormHeaders = $params->get( 'linkedformheader', '', '_default', 'array' );

    $linkedform_linktype 	= $params->get('linkedform_linktype', '', '_default', 'array');
    $linkedtable_linktype = $params->get('linkedtable_linktype', '', '_default', 'array');

    $lists['linkedtables']  = array();

    $f = 0;
    //if (empty( $aExisitngLinkedTables ) ){
    foreach ($linkedTables as $linkedTable) {
			if (!array_key_exists( $f, $aExisitngLinkedTables)) {
				$aExisitngLinkedTables[$f] = '0';
			}
			
    	if (!array_key_exists( $f, $linkedtable_linktype)) {
				$linkedtable_linktype[$f] = '0';
			}
			
    	if (!array_key_exists( $f, $aExisitngLinkedForms)) {
				$aExisitngLinkedForms[$f] = '0';
			}
			
    	if (!array_key_exists( $f, $linkedform_linktype)) {
				$linkedform_linktype[$f] = '0';
			}

    	$yeschecked = ( in_array( $linkedTable->db_table_name, $aExisitngLinkedTables ) || $aExisitngLinkedTables[$f] != '0' ) ? 'checked="checked"' : $checked = '';
      $nochecked = ( $yeschecked == '' ) ? 'checked="checked"' : $checked = '';
      	
      $el =  '<label><input name="params[linkedtable][' . $linkedTable->db_table_name . ']" value="0" ' .$nochecked . ' type="radio">' . JText::_( 'No' ) . '</label>';
      $el.=  '<label><input name="params[linkedtable][' . $linkedTable->db_table_name . ']" value="' . $linkedTable->db_table_name .'" ' .$yeschecked . ' type="radio">' . JText::_( 'Yes' ) . '</label>';

      $yeschecked = ( in_array( $linkedTable->db_table_name, $linkedtable_linktype ) || $linkedtable_linktype[$f] != '0')? 'checked="checked"': $checked = '';
      $nochecked = ( $yeschecked == '' ) ? 'checked="checked"' : $checked = '';
      	
      $linkType1 =  '<label><input name="params[linkedtable_linktype][' . $linkedTable->db_table_name . ']" value="0" ' .$nochecked . ' type="radio">' . JText::_( 'No' ) . '</label>';
      $linkType1.=  '<label><input name="params[linkedtable_linktype][' . $linkedTable->db_table_name . ']" value="' . $linkedTable->db_table_name .'" ' .$yeschecked . ' type="radio">' . JText::_( 'Yes' ) . '</label>';

      $yeschecked = ( in_array( $linkedTable->db_table_name, $aExisitngLinkedForms ) || $aExisitngLinkedForms[$f] != '0')? 'checked="checked"': $checked = '';
      $nochecked = ( $yeschecked == '' ) ? 'checked="checked"' : $checked = '';
      	
      $el2 =  '<label><input name="params[linkedform][' . $linkedTable->db_table_name . ']" value="0" ' .$nochecked . ' type="radio">' . JText::_( 'No' ) . '</label>';
      $el2.=  '<label><input name="params[linkedform][' . $linkedTable->db_table_name . ']" value="' . $linkedTable->db_table_name .'" ' .$yeschecked . ' type="radio">' . JText::_( 'Yes' ) . '</label>';
      	
      $yeschecked = ( in_array( $linkedTable->db_table_name, $linkedform_linktype ) || $linkedform_linktype[$f] != '0')? 'checked="checked"': $checked = '';
      $nochecked = ( $yeschecked == '' ) ? 'checked="checked"' : $checked = '';
      	
      $linkType2 =  '<label><input name="params[linkedform_linktype][' . $linkedTable->db_table_name . ']" value="0" ' .$nochecked . ' type="radio">' . JText::_( 'No' ) . '</label>';
      $linkType2.=  '<label><input name="params[linkedform_linktype][' . $linkedTable->db_table_name . ']" value="' . $linkedTable->db_table_name .'" ' .$yeschecked . ' type="radio">' . JText::_( 'Yes' ) . '</label>';
      	
      $tableHeader = '<input name="params[linkedtableheader][' . $linkedTable->db_table_name . ']" value="' . @$aExistingTableHeaders[$f] .'" >';
      $formHeader = '<input name="params[linkedformheader][' . $linkedTable->db_table_name . ']" value="' . @$aExistingFormHeaders[$f] .'" >';

      $lists['linkedtables'][] = array( str_replace( array( "\n", "\r", "<br>", "</br>") , '', $linkedTable->label ),
      str_replace( array( "\n", "\r", "<br>", "</br>") , '', $linkedTable->tablelabel ),
      $el, $tableHeader, $linkType1, $el2, $formHeader, $linkType2 );
      $f ++;
    }
    	
    //plugin
    $pluginManager = JModel::getInstance( 'Pluginmanager', 'FabrikModel' );
    $pluginManager->getPlugInGroup( 'table' );
    require_once( JPATH_COMPONENT.DS.'views'.DS.'table.php');

    // Create the form
    $form = new JParameter('', JPATH_COMPONENT.DS.'models'.DS.'table.xml');
    $form->bind($row);
    $form->set('created', JHTML::_('date', $row->created, '%Y-%m-%d %H:%M:%S'));
    $form->set('publish_up', JHTML::_('date', $row->publish_up, '%Y-%m-%d %H:%M:%S'));
 
	  if ($cid[0] == 0 || $form->get('publish_down') == '' || $form->get('publish_down') ==  $db->getNullDate()) {
			$form->set('publish_down', JText::_('Never'));
		} else {
			$form->set('publish_down', JHTML::_('date', $row->publish_down, '%Y-%m-%d %H:%M:%S'));
		}
		
    $form->loadINI($row->attribs);

    FabrikViewTable::edit( $row, $lists, $connectionTables, $menus, $fabrikid, $params, $pluginManager, $model, $form );
  }

  /**
   * Save a table
   */

  function save()
  {
    // Check for request forgeries
    JRequest::checkToken() or die( 'Invalid Token' );

    $db =& JFactory::getDBO();

    $model =& JModel::getInstance( 'table', 'FabrikModel' );
    $ok = $model->save();
    $row =& $model->getTable();
    $task = JRequest::getCmd( 'task' );

    switch ($task)
    {
      case 'apply':
        $link = 'index.php?option=com_fabrik&c=table&task=edit&cid[]='. $row->id ;
        break;

      case 'save':
      default:
        $link = 'index.php?option=com_fabrik&c=table';
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

      case 'menuLinkTable':
        FabrikHelperMenu::menuLink( 'table', 'tableid='.$row->id );
        $msg = JText::_('Menu link created' );
        $link = "index.php?option=com_fabrik&c=table&task=edit&cid[]=".$row->id;
        break;
    }
    $this->setRedirect( $link, JText::_( 'Table Saved' ) );
  }

  /**
   * un/Publish a table
   */

  function publish()
  {
    // Check for request forgeries
    JRequest::checkToken() or die( 'Invalid Token' );

    $this->setRedirect( 'index.php?option=com_fabrik&c=table' );

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

    $query = 'UPDATE #__fabrik_tables'
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
   *
   */

  function showlinkedelements(){
    $cid	= JRequest::getVar('cid', array(0), 'method', 'array');
    $row 	=& JTable::getInstance('table', 'Table');
    $row->load($cid[0]);
    $formId = $row->form_id;
    $formModel = JModel::getInstance('Form', 'FabrikModel');
    $formModel->setId( $formId );
    $form =& $formModel->getForm();
    $formGroupEls = $formModel->getFormGroups( false, false );
    require_once(JPATH_COMPONENT.DS.'views'.DS.'table.php');
    FabrikViewTable::showTableDetail( $form, $formGroupEls );
  }


  /**
   * Display the list of tables
   */

  function display()
  {
    global $mainframe;
    $db =& JFactory::getDBO();
    $user =& JFactory::getUser();
    $newFilterTable 	= JRequest::getVar( 'filter_table' );

    $context					= 'com_fabrik.table.list.';
    $filter_order			= $mainframe->getUserStateFromRequest( $context.'filter_order',		'filter_order',		't.label',	'cmd' );
    $filter_order_Dir	= $mainframe->getUserStateFromRequest( $context.'filter_order_Dir',	'filter_order_Dir',	'',			'word' );
    $limit						= $mainframe->getUserStateFromRequest( $context.'limit', 'limit', $mainframe->getCfg('list_limit'), 'int' );
    $limitstart 			= $mainframe->getUserStateFromRequest( $context.'limitstart', 'limitstart', 0, 'int' );
    $filter_table 		= $mainframe->getUserStateFromRequest( $context."filter_table", 'filter_table', '' );
    $selPackage   		= $mainframe->getUserStateFromRequest(  $context."package", 'packages', '' );

    // table ordering
    $lists['order_Dir']	= $filter_order_Dir;
    $lists['order']			= $filter_order;

    $where = array();
    if ($selPackage != '') {
      $db->setQuery( "SELECT tables FROM #__fabrik_packages WHERE id = '$selPackage'");
      $tables = $db->loadResult();
      echo $db->getErrorMsg();
      if ($tables != '' ) {
        $where[] = " #__fabrik_tables.id IN (" .  $tables . ") ";
      } else {
        $where[] = " #__fabrik_tables.id IN (0) ";
      }
    }

    if ($filter_table != '') {
      $where[] = " label like '%$filter_table%' ";
    }
    
    if ($user->gid <= 24) {
    	$where[] = " private = '0'";
    }
    $where		= count( $where ) ? ' WHERE ' . implode( ' AND ', $where ) : '';
    $orderby	= ' ORDER BY '. $filter_order .' '. $filter_order_Dir;

    // get the total number of records
    $db->setQuery( "SELECT count(*) FROM #__fabrik_tables $where" );
    $total = $db->loadResult();
    echo $db->getErrorMsg();

    jimport('joomla.html.pagination');
    $pageNav = new JPagination( $total, $limitstart, $limit );

    $sql = "SELECT *, u.name AS editor, t.id AS id FROM #__fabrik_tables AS t" .
			"\n LEFT JOIN #__users AS u ON t.checked_out = u.id " .
			" $where $orderby";
    $db->setQuery( $sql, $pageNav->limitstart, $pageNav->limit );

    $rows = $db->loadObjectList( );
    //echo $db->getErrorMsg();
    $lists['filter_table'] =  '<input type="text" value="' . $filter_table . '" name="filter_table" onblur="document.adminForm.submit( );" />';

    //get list of packages
    $db->setQuery( "SELECT id AS value, label AS text FROM #__fabrik_packages" );
    $packages =  array_merge( array(JHTML::_('select.option', '', '- ' . JText::_( 'Select Package') . ' -' )), $db->loadObjectList( ));
    $lists['packages'] = JHTML::_('select.genericlist',  $packages, 'packages', 'class="inputbox" onchange="document.adminForm.submit( );"','value','text',  $selPackage );

    require_once(JPATH_COMPONENT.DS.'views'.DS.'table.php');
    FabrikViewTable::show( $rows, $pageNav, $lists );
  }

  /**
   * copy a connection
   * @param int connection id
   */

  function copy( )
  {

    // Check for request forgeries
    JRequest::checkToken() or die( 'Invalid Token' );
    $this->setRedirect( 'index.php?option=com_fabrik&c=table' );

    $cid		= JRequest::getVar( 'cid', null, 'post', 'array' );
    $db			=& JFactory::getDBO();
    $rule		=& JTable::getInstance('table', 'Table');
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
   * delete table
   */

  function remove( )
  {
    require_once( JPATH_COMPONENT.DS.'views'.DS.'table.php' );
    FabrikViewTable::askDeleteTableMethod( );
  }

  /**
   *
   *
   */

  function doRemove()
  {
    // Check for request forgeries
    JRequest::checkToken() or die( 'Invalid Token' );
    $deleteMethod = JRequest::getInt( 'deleteMethod', 0 );

    // Initialize variables
    $db		=& JFactory::getDBO();
    $cid	= JRequest::getVar( 'cid', array(), 'post', 'array' );
    $n		= count( $cid );
    JArrayHelper::toInteger( $cid );

    if ($deleteMethod == 1) {
      $model =& JModel::getInstance( 'Table', 'FabrikModel' );
       
      foreach ($cid as $id) {
        $model->setId( $id );
       	$model->_table = null;
        $table = $model->getTable();
				$model->_oForm  = null;
        $formModel =& $model->getForm();
        $formModel->getGroupsHiarachy( false, false );
        foreach ($formModel->_groups as $groupModel) {
          foreach ($groupModel->_aElements as $elementModel) {
            $db->setQuery( "DELETE FROM #__fabrik_elements WHERE id = '$elementModel->_id'");
            $db->query();
            
            $db->setQuery( "DELETE FROM #__fabrik_validations WHERE element_id = ''$elementModel->_id'");
            $db->query();
            
            $db->setQuery( "DELETE FROM #__fabrik_jsactions WHERE element_id = ''$elementModel->_id'");
            $db->query();
          }
          $db->setQuery( "DELETE FROM #__fabrik_groups WHERE id = '$groupModel->_id'");
          $db->query();
        }
        $db->setQuery( "DELETE FROM #__fabrik_forms WHERE id = '$formModel->_id'");
        $db->query();

        $db->setQuery( "DELETE FROM #__fabrik_formgroup WHERE form_id = '$formModel->_id'");
        $db->query();
      }
    }
    if ($n)
    {
      $query = 'DELETE FROM #__fabrik_tables'
      . ' WHERE id = ' . implode( ' OR id = ', $cid )
      ;
      $db->setQuery( $query );
      if (!$db->query()) {
        JError::raiseWarning( 500, $db->getError() );
      }
    }
    $this->setMessage( JText::sprintf( 'Items removed', $n ) );
		$this->setRedirect( 'index.php?option=com_fabrik&c=table' );
  }

  /**
   * ajax load drop down of all columns in a given table
   */

  function ajax_loadTableDropDown()
  {
    $db =& JFactory::getDBO();
    $conn = JRequest::getInt( 'conn', 1 );
    $oCnn = JModel::getInstance( 'Connection', 'FabrikModel' );
    $oCnn->setId( $conn );
    $oCnn->getConnection();
    $db = $oCnn->getDb();
    $table 	= JRequest::getVar( 'table', '' );
    $name 	= JRequest::getVar( 'name', 'table_key[]' );
    $sql 	= "DESCRIBE `$table`";
    $db->setQuery( $sql );
    $aFields = $db->loadObjectList( );
    $fieldNames = array( );
    if (is_array( $aFields )) {
      foreach ($aFields as $oField) {
        $fieldNames[] = JHTML::_('select.option', $oField->Field );
      }
    }
    $fieldDropDown = JHTML::_('select.genericlist',  $fieldNames, $name, "class=\"inputbox\"  size=\"1\" ", 'value', 'text', '' );
    echo $fieldDropDown;
  }

  /**
   * ajax load drop down of all tables in a connection
   */

  function ajax_loadTableListDropDown()
  {
    $db =& JFactory::getDBO();
    $conn = JRequest::getInt( 'conn', 1 );
    $oCnn = JModel::getInstance( 'Connection', 'FabrikModel' );
    $class = "inputbox " . JRequest::getVar( 'class', '');
    $oCnn->setId( $conn );
    $oCnn->getConnection();
    $name = JRequest::getVar( 'name', 'table_join' );
    $tableDropDown = $oCnn->getTableDdForThisConnection( '', $name,  '', $class );
    echo $tableDropDown;
  }


  function createImportedScript()
  {
    $db =& JFactory::getDBO();;
    $db->setQuery( "SELECT MAX(script_version) FROM #__cbx_script");
    $nextScriptVersion = $db->loadResult()  + 1;
    $db->setQuery( "INSERT INTO #__cbx_script (`date_created`, `script_version`) VALUES (NOW(), '$nextScriptVersion') ");
    $db->query();
    $scriptId = $db->insertid();

    //get existing characters
    $db->setQuery( "SELECT full_name FROM #__cbx_character" );
    $existingCharacters = $db->loadResultArray();

    $post	= JRequest::get( 'post' );

    foreach ($post['character'] as $c) {
      if (!in_array( $c, $existingCharacters )) {
        $db->setQuery("INSERT INTO #__cbx_character (`full_name`) VALUES ('$c')");
        $db->query();
      }
    }

    $sequences = $post['sequence'];
    $prefix = $post['prefix'];
    $aSequenceIds = array();
    for ($i=0;$i<count($sequences);$i++) {
      $s = $sequences[$i];
      $p = $prefix[$i];
      $db->setQuery("INSERT INTO #__cbx_sequence (`name`, `script_id`, `prefix`) VALUES ('$s', '$scriptId', '$p')");
      $db->query();
      $aSequenceIds[$s] = $db->insertid();
    }

    $scenes = $post['scence'];
    $sequnce_ids = $post['sequence_id'];
    for ($i=0;$i<count($scenes);$i++) {
      $scene = $scenes[$i];
      $sequnce_id = $sequnce_ids[$i];
      $interior = (strstr($scene, 'INT.')) ? 1 : 0;
      $scene = FabrikString::ltrimword($scene, 'INT.');
      $scene = FabrikString::ltrimword($scene, 'EXT.');
      $seq_id = $aSequenceIds[$sequnce_id];
      $db->setQuery("INSERT INTO #__cbx_scene (`scene_number`, `sequence_id`, `scene_name`, `interior`) VALUES ('$i', '$seq_id', '$scene', '$interior')");
      $db->query();
      $sceneId = $db->insertid();
      //create a shot for each scene
      $db->setQuery("INSERT INTO #__cbx_shot (`interior`, `shot_label`, `shot_description`, `scene_id`)".
							"VALUES ('$interior', 'placeholder for scene $sceneId', '$scene', '$sceneId')");
      $db->query();

    }
    echo "<h1>Script Imported!</h1>";


  }
}
?>