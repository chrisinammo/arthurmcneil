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

class FabrikModelGroup extends JModel{

	/** @var object parameters */
	var $_params = null;
	
	/** @var array group elements */
	var $_aElements = null;
	
	/** @var int id of group to load */
	var $_id = null;
	
	/** @var object group table */
	var $_group = null;
	
	/** @var object form model */
	var $_form 		= null;
	
	/** @var object table model */
	var $_table 		= null;
	
	
	
	/**
	* @param database A database connector object
	*/ 	
		
	function __construct()
	{
		parent::__construct();
	}
	
	/**
	 * Method to set the group id
	 *
	 * @access	public
	 * @param	int	group ID number
	 */

	function setId($id)
	{
		// Set new group ID 
		$this->_id		= $id;
	}
	
	function &getGroup()
	{
		JTable::addIncludePath(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_fabrik'.DS.'tables');
		$this->_group = JTable::getInstance('group', 'Table');
		$this->_group->load( $this->_id );
		return $this->_group;
	}
	
	/**
	 * set the context in which the element occurs 
	 *
	 * @param object form model
	 * @param object table model
	 */

	function setContext( &$formModel, &$tableModel )
	{
		$this->_form 		=& $formModel;
		$this->_table 	=& $tableModel;	
	}

	/**
	 * 
	 */
	 
	function getFormsIamIn( ){
		$db =& JFactory::getDBO();
		$sql = "SELECT form_id FROM #__fabrik_formgroup WHERE group_id = '$this->_id'";
		$db->setQuery( $sql );
		return $db->loadResultArray( );
	} 	
	
	/**
	 * returns array of elements in the group
	 * @param int form id for elements
	 * @param bol if true only those elements marked as 'show_in_table_view' are returned
	 * @param bol if true only those elements that are published are returned
	 * @return array element objects
	 */
	 
	function getMyElements( $formId, $tableViewOnly = false, $excludeUnpublished = true )
	{
		//@TODO: cache one first load and return that if this func is called again
		$db =& JFactory::getDBO();
		$pluginManager =& JModel::getInstance('PluginManager', 'FabrikModel');
		$sql = "SELECT id, plugin FROM  #__fabrik_elements
		WHERE group_id = '$this->_id' " ;
		if ($excludeUnpublished) {
			$sql .= " AND #__fabrik_elements.state = '1' ";
		}
		if ($tableViewOnly) {
			$sql .= " AND show_in_table_summary = '1' ";
		}
		$sql .= "ORDER BY ordering";
		$db->setQuery( $sql );
		$aElementIds = $db->loadObjectList();
		$aElObjs = array( );
		foreach ($aElementIds as $row ) {
			//cant do =& here in php4 :(
			$elementModel = $pluginManager->loadPlugIn( $row->plugin, 'element' );
			if (!is_object( $elementModel )) {
				return JError::raiseError( 400, $row->plugin. ' not loaded in group.php' );
			}
			$elementModel->setId( $row->id );
			//	@TODO: in php 4.4.7 the context is set ok here - but in the filters the table object doesnt contain a database object - so one is recreated 
			$elementModel->setContext( $this, $this->_form, $this->_table );
			$elementModel->getElement();
			$elementModel->_formId = $formId;
			$elementModel->loadValidations( );
			$aElObjs[ $elementModel->_id ] = $elementModel;
			$elementModel = null;
		}
		
		$this->_aElements = $aElObjs;
		return $this->_aElements;
	}	

	/**
	 * get the element name of the key element in a database join element 
	 * used for getting the correct name to order element joins in the table view
	 */
	
	function getElementsJoinKeyFullName( $elementModel, $oForm, $includeJoinString = true, $useStep = true){
		$defaultVal = '';
		$element =& $elementModel->getElement();
		if($useStep ){
			$thisStep = $oForm->_joinTableElementStep;
		}else{
			$thisStep = '.';
		}
		if( $this->is_join ){
			$joinModel =& JModel::getInstance( 'Join', 'FabrikModel' );
			$join = $joinModel->loadFromGroupId( $this->_id );
			if( $includeJoinString ){
				$fullName = 'join[' . $join->id . '][' . $join->table_join . $thisStep . $element->name . ']';
			}else{
				$fullName =  $join->table_join . $thisStep . $element->name ;
			}	
		} else{
			$tableName = $elementModel->_params->get('join_db_name', '');
			$fullName = $tableName . $thisStep . $element->name;
		}
		
		if( $this->canRepeat() == 1 ){
			$fullName .=  "[]";
		}				
		return $fullName;		
	}
	
	function canRepeat(){
		$this->getParams();
		return $this->_params->get( 'repeat_group_button' );		
	}
	
	function isJoin(){
		$group =& $this->getGroup();
		return $group->is_join;
	}
	
	function &loadParams(){
		$this->_params =  new fabrikParams( $this->_group->attribs );
		return $this->_params;
	}
	
	function &getParams()
	{
		if (!$this->_params) {
			$this->_params = $this->loadParams();
		}
		return $this->_params;
	}
	
	/**
	 * creates a html dropdown off all groups
	 * @param int selected group id
	 * @return string group list
	 */
	 
	function makeDropDown( $selectedId = 0, $defaultlabel = '' )
	{
		if ($defaultlabel == '') {
			$defaultlabel = JText::_( 'Please select' );
		}
		$db =& JFactory::getDBO();
		$sql = "SELECT id AS value, name AS text FROM #__fabrik_groups ORDER BY name";
		$db->setQuery( $sql );
		$aTmp[] = JHTML::_('select.option', "-1", $defaultlabel );
		$groups = $db->loadObjectList( );
		$groups = array_merge( $aTmp, $groups );
		$list = JHTML::_('select.genericlist',  $groups, 'filter_groupId', 'class="inputbox"  onchange="document.adminForm.submit( );"', 'value', 'text', $selectedId );
	 	return $list;
	}
	
}

?>