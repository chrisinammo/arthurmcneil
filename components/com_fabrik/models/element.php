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
jimport('joomla.filesystem.file');

class FabrikModelElement extends JModel {
	
	/** @var int element id */
	var $_id = null;
	
	/** @var string js to run on element - DEPRECIATED */
	var $_js = null;
	
	/** @var array javascript actions to attach to element */
	var $_jsActions = null; 
	
	/** @var object params */
	var $_params = null;
	
	/** @var array validation objects associated with the element */
	var $_aValidations = null;
	 
	/** @var array advanced joins */
	var $_advancedJoins = null;
	
	/** @var bol */
	var $_editable = null;
	
	/** @var bol */
	var $_is_upload = 0;
	
	/** @var bol */
	var $_recordInDatabase = 1;
	
	/** @var object to contain access rights **/
	var $_access = null;
	
	/** @var string seperator used in repeat groups */
	var $_groupSplitter = "//..*..//";
	
	/** @var string seperator used to split sub element data */
	var $_groupSplitter2 = "|-|";
	
	/**@var string validation error **/
	var $_validationErr = null;
	
	/** @var array stores possible element names to avoid repeat db queries **/
	var $_aFullNames = array();

	/** @var object group model*/
	var $_group = null;
	
	/** @var object form model*/
	var $_form = null;
	
	/** @var object table model*/
	var $_table = null;
	
	/** @var object JTable element object */
	var $_element = null;
	
	/** @var bol does the element have a label */
	var $hasLabel = true;
	
	/** @var bol does the element contain sub elements e.g checkboxes radiobuttons */
	var $hasSubElements = false;
	
	var $_imageExtensions = array('jpg', 'jpeg', 'gif', 'bmp', 'png');
	
	/**
	* Constructor
	*/

	function __construct()
	{
		parent::__construct();
		$this->_is_upload = false;
		$this->_access = new stdClass();
	}
	
	/**
	 * Method to set the element id
	 *
	 * @access	public
	 * @param	int	element ID number
	 */
	function setId($id )
	{
		// Set new element ID 
		$this->_id		= $id;
	}
	
	function &getElement()
	{
		if (!$this->_element) {
			JTable::addIncludePath( JPATH_ADMINISTRATOR.DS.'components'.DS.'com_fabrik'.DS.'tables' );
			$row = JTable::getInstance( 'element', 'Table' );
			$row->load( $this->_id );
			$this->_element =& $row;
		}
		return $this->_element;
	}
	
	/**
	 * set the context in which the element occurs 
	 *
	 * @param object group table
	 * @param object form model
	 * @param object table model
	 */

	function setContext( $groupModel, $formModel, &$tableModel )
	{
		//dont assign these with &= as they already are when passed into the func
		$this->_group 	=& $groupModel;
		$this->_form 	=& $formModel;
		$this->_table 	=& $tableModel;	
	}
	
	/**
	 * shows the RAW table data - can be overwritten in plugin class 
	 * @param string data
	 * @param object all the data in the tables current row
	 * @return string formatted value
	 */

	function renderRawTableData( $data, $oAllRowsData )
	{
		return $data;
	}
	
	
	/**
	 * replace labels shown in table view with icons (if found)
	 * @param string data
	 * @return string data
	 */
	
	function _replaceWithIcons( $data )
	{
		if($data == ''){
			return $data;
		}
		$params =&$this->getParams();
		$folder = $params->get('icon_folder');
		foreach ($this->_imageExtensions as $ex) {
			$f = JPath::clean($folder . DS . $data . '.' . $ex);
			if (JFile::exists( COM_FABRIK_BASE.DS.$f )) {
				$f = str_replace(DS, "/", $f);
				return  "<img src='$f' alt='$data' />";
			}
		}
		return $data;
	}
	
	/**
	 * can be overwritten in the plugin class - see database join element for example
	 * @param array 
	 * @param array
	 * @param string table name
	 */

	function getAsField_html( &$aFields, &$aAsFields, $dbtable )
	{
		$tableModel =& $this->_table;
		$table 		=& $tableModel->getTable();
		$fullElName = "`$dbtable" . "___" . $this->_element->name . "`";
		$str 				= "`$dbtable`.". "`".$this->_element->name."` AS $fullElName" ;
		if ($table->db_primary_key == $fullElName) {
			array_unshift( $aFields, $fullElName );
			array_unshift( $aAsFields, $fullElName );
		} else {
			$aFields[] 	= $str;
			$aAsFields[] =  $fullElName;
		}
	}
	
	/**
	 * check user can view the read only element & view in table view
	 * @return bol can view or not
	 */

	function canView( )
	{
	 	$acl =& JFactory::getACL();
	 	$user	  = &JFactory::getUser();	
	 	$params =& $this->getParams();
	 	$a = $params->get( 'view_access', '' );
	 	if ($a == '29' || $a=='' || $a=='0') {
	 		$this->_access->view =  true;
	 	} else {
		 	if (!is_object( $this->_access ) || !array_key_exists( 'view', $this->_access )) {
			 	$groupNames =& FabrikWorker::getACLGroups( $a );
			 	foreach ($groupNames as $name) {
			 		FabrikWorker::setACL( 'action', 'viewElement' . $this->name, 'fabrik', $name, 'components', null );
			 	}
		 		if ($acl->acl_check( 'action', 'viewElement' . $this->name, 'fabrik', $user->get('usertype'), 'components', null )) {
					$this->_access->view =  true;
				} else {
					$this->_access->view = false;
				}
		 	}
	 	}
	 	return $this->_access->view;
	}

	/**
	 * check user can view the active element
	 * @return bol can view or not
	 */
	 
	 function canUse( )
	 {
	 	$acl	=& JFactory::getACL();
	 	$user	= &JFactory::getUser();
	 	$a = $this->_element->access;
	 	$element =& $this->getElement();
	 	if ($a == '29' || $a=='' || $a=='0') {
	 		$this->_access->use =  true;
	 	} else {
	 		if (!is_object($this->_access) || !array_key_exists( 'use', $this->_access )) {
		 		$groupNames =& FabrikWorker::getACLGroups( $a );
			 	foreach ($groupNames as $name) {
					FabrikWorker::setACL( 'action', 'useElement' . $element->name, 'fabrik', $name, 'components', null );
			 	}
		 		if ($acl->acl_check( 'action', 'useElement' . $element->name, 'fabrik', $user->get('usertype'), 'components', null )) {
					$this->_access->use =  true;
				} else {
					$this->_access->use = false;
				}
		 	}
	 	}
	 	return $this->_access->use;
	 }
	 
	 /**
	  * Defines if the user can use the filter related to the element
	  *
	  * @return bol true if you can use
	  */

	 function canUseFilter()
	 {
		$acl	=& JFactory::getACL();
		$user	=& JFactory::getUser();
	 	$params =& $this->getParams();
	 	$element =& $this->getElement();
	 	$a = $params->get( 'filter_access', '' );
	 	if ($a == '29' || $a=='' || $a=='0') {
	 		$this->_access->filter =  true;
	 	} else {
		 	if (!is_object($this->_access) || !array_key_exists( 'filter', $this->_access )) {
		 		$groupNames =& FabrikWorker::getACLGroups( $a );
			 	foreach ($groupNames as $name) {
			 		FabrikWorker::setACL( 'action', 'filterElement' . $element->name, 'fabrik', $name, 'components', null );
			 	}
		 		if ($acl->acl_check( 'action', 'filterElement' . $element->name, 'fabrik', $user->get('usertype'), 'components', null )) {
					$this->_access->filter =  true;
				} else {
					$this->_access->filter = false;
				}
		 	}
	 	}
	 	return $this->_access->filter;
	 }

	 /* overwritten in add on classes */

	 function setIsRecordedInDatabase()
	 {
			return true;
	 }
	 
	 /** overwrite in plugin **/

	 function validate()
	 {
	 	return true;
	 }

	 
	/** overwrite in plugin 
	* @param array data
	* @param object table model
	*/

	 function mergeTableData( &$data, &$tableModel )
	 {

	 }
	 
	
	function getValidationErr()
	{
		return $this->_validationErr;
	}

	 /**
	  * load in a plgins language file
	  * @param string plugin name
	  */

	 function loadLanguage( $pluginName = null )
	 {
	 	global $mosConfig_lang;
	 	$element =& $this->getElement();
	 	//in admin u need to be able to redefine (with the passed in var) which element type langugae file to include
	 	if (!$pluginName) {
	 		$pluginName = $element->plugin;
	 	}
	 	$absPath = JPATH_SITE . "/components/com_fabrik/plugins/element/" . $pluginName . "/language/";
	 	if (file_exists( $absPath.$mosConfig_lang.'.php' )) {
			require_once $absPath.$mosConfig_lang.'.php';
		} else {
			if (file_exists( $absPath.'english.php')) {
				require_once $absPath.'english.php';
			}
		}	
	}
	
	/**
	 * can be overwritten by plugin class
	 * 
	 * Examples of where this would be overwritten include drop downs whos "please select" value might be "-1"
	 * @param string data posted from form to check
	 * @return bol if data is considered empty then returns true
	 */
	
	function dataConsideredEmpty( $data )
	{
		if ($data == '') {
			return true;
		}
		return false;
	}

	/**
	 *  can be overwritten in add on classes
	 * @param mixed thie elements posted form data  
	 * @param array posted form data
	 */
		
	function storeDatabaseFormat( $val, $data )
	{
		if (is_array( $val )) {
			$val = implode( $this->_groupSplitter, $val );
		}
		return $val;
	}

	/**
	 * can be overwritten in add on classes
	 * @param array data
	 * @param string table column heading
	 * @return array data
	 */

	function prepareCSVData( $data, $key )
	{
		return $data;
	}
	
	/**
	 * can be overwritten in plugin class
	 * determines if the data in the form element is used when updating a record
	 * @param mixed element forrm data
	 * @return bol - true if ignored on update, default = false
	 */
	
	function ignoreOnUpdate( $val = null )
	{
		$params =& $this->getParams();
		if ($params->get( 'password', 0 )) {
			return true;
		} else {
			return false;
		}
	}
	
	/**
	 * can be overwritten in plugin class
	 * determines if the element can contain data used in sending receipts, e.g. fabrikfield returns true
	 */
	
	function isReceiptElement()
	{
		return false;
	}
	
	/**
	 * can be overwritten in adddon class
	 * 
	 * checks the posted form data against elements INTERNAL validataion rule - e.g. file upload size / type
	 * @param array existing errors
	 * @param object group model
	 * @param object form model
	 * @param array posted data
	 * @return array updated errors
	 */
	
	function validateData( $aErrors, &$groupModel, &$formModel, $data )
	{
		return $aErrors;
	}
	
	/**
	 * can be overwritten by plugin class
	 * determines the value for the element in the form view
	 * @param array data
	 * @param bol editable element default = true
	 * @param int when repeating joinded groups we need to know what part of the array to access
	 */

	//@TODO: whats the diff between this and getValue() ?????

	function getDefaultValue( $data, $editable = true, $repeatCounter = 0 )
	{
		$groupModel =& $this->_group;
		$formModel 	=& $this->_form;
		$element	=& $this->getElement();
		$tableModel =& $this->_table;
		$defaultVal =& $this->_element->default;
		$table 		=& $tableModel->getTable();
		
		if ($element->eval == "1") {
			$defaultVal = @eval( stripslashes( $defaultVal ) );
		}
		if ( $groupModel->canRepeat( ) == '1' ) {
			$fullName = $table->db_table_name . $formModel->_joinTableElementStep . $element->name;
			if (isset( $data[$fullName ] )) {
				$defaultVal = $data[$fullName];
				if (is_string($defaultVal)) {
					$defaultVal = explode( $this->_groupSplitter, $defaultVal );
				}
				if (is_array( $defaultVal ) && array_key_exists( $repeatCounter, $defaultVal )) {
					$defaultVal = $defaultVal[$repeatCounter];
					if (is_array( $defaultVal )) {
						$defaultVal = implode( ',', $defaultVal );
					}
					$element->default = $defaultVal;
					return $defaultVal;		
				}
			}
		}
		if ($groupModel->isJoin()) {
			$fullName = $this->getFullName(false, true, false);
			if (isset( $data[$fullName] )) {
				$defaultVal = $data[$fullName];
				if (is_array( $defaultVal ) && array_key_exists( $repeatCounter, $defaultVal )) {
					$defaultVal = $defaultVal[$repeatCounter];	
				}
			}	
		} else {
			$fullName = $table->db_table_name . $formModel->_joinTableElementStep . $element->name;
			if (isset( $data[ $fullName ] )) {
				/* drop down  */
				if (is_array( $data[ $fullName ] )) {
					if (isset( $data[ $fullName ]['value'] )) { 
						/* if not its a file upload el */
						$defaultVal = $data[ $fullName ]['value'];
					} 
				} else {
					$defaultVal = $data[$fullName];
				} 
			}
		}
		/** ensure that the data is a string **/
		if (is_array( $defaultVal )) {
			$defaultVal = implode( ',', $defaultVal );
		}
		
		$element->default = $defaultVal;
		return $defaultVal;		
	}
	
	/**
	 * can be overwritten by plugin class
	 * determines the value for the element in the form view
	 * @param array data
	 * @param int when repeating joinded groups we need to know what part of the array to access
	 */

	function getValue( $data, $repeatCounter = 0 )
	{
		$groupModel =& $this->_group;
		$formModel 	=& $this->_form;
		$tableModel =& $this->_table;
		$table 			=& $tableModel->getTable();
		$db		=& JFactory::getDBO();
		$element =& $this->getElement();
		$defaultVal = '';
		if ($groupModel->canRepeat()) {
			
			$fullName = $table->db_table_name . $formModel->_joinTableElementStep . $element->name;
			if (isset( $data[$fullName ] )) {
				$defaultVal = $data[$fullName];
				if( is_array( $defaultVal ) && array_key_exists( $repeatCounter, $defaultVal )) {
					$defaultVal = $defaultVal[$repeatCounter];
					if (is_array( $defaultVal )) {
						$defaultVal = implode( ',', $defaultVal );
					}
					return $defaultVal;
				}
			}
		}
		$group =& $groupModel->getGroup();
		//@TODO: load the join once into the group rather than reloading each time
		if ($group->is_join) {
			$joinModel =& JModel::getInstance( 'Join', 'FabrikModel' );
			$join =  $joinModel->loadFromGroupId( $groupModel->_id, $formModel->_table->_id );
			$fullName = $join->table_join . $formModel->_joinTableElementStep . $element->name;
			if (isset( $data[$fullName ] )) {
				$defaultVal = $data[$fullName];
				if (is_array( $defaultVal ) && array_key_exists( $repeatCounter, $defaultVal )) {
					$defaultVal = $defaultVal[$repeatCounter];
				}
			} else {
				if (array_key_exists( $fullName, $data['join'][$group->join_id] )) {
					return $data['join'][$group->join_id][$fullName];
				}
			}
		} else {
			$fullName = $table->db_table_name . $formModel->_joinTableElementStep . $element->name;
			if (isset( $data[ $fullName ] )) {
				/* drop down  */
				if (is_array( $data[ $fullName ] )) { 
					if (isset( $data[ $fullName ]['value'] )) { 
						/* if not its a file upload el */
						$defaultVal = $data[ $fullName ]['value'];
					}else{
						$defaultVal = implode(",", $data[$fullName]);//radio buttons?
					}
				} else {
					$defaultVal = $data[$fullName];
				}
			}
		}
		/** ensure that the data is a string **/
		if (is_array( $defaultVal )) {
			$defaultVal = implode( ',', $defaultVal );
		}
		return $defaultVal;
	}
	
	/**
	 * is the element hidden or not - if not set then return false
	 *
	 * @return bol
	 */
	
	function isHidden()
	{
		$element =& $this->getElement();
		if ($element->hidden == true) {
			return true;
		}
		return false;
	}
	
	/**
	 * can be overwritten in the plugin class
	 * @param object form
	 */
	
	function getLabel( )
	{
		$bLabel = $this->get('hasLabel');
		
		global $mosConfig_lang, $mosConfig_mbf_content, $Itemid;
		$element =& $this->getElement();
		$elementHTMLId = $this->getHTMLId();
		if ($element->hidden) {
			return '';
		}
		$task = JRequest::getVar( 'task', '', 'default' );
		$view = JRequest::getVar( 'view', '', 'form');
		if ($view == 'form' && ! ( $this->canUse() || $this->canView() )) {
			return '';
		}
		$params =& $this->getParams();
		$elementid = "fb_el_" . $elementHTMLId;
		$this->_form->loadValidationRuleClasses();
		$str = '';
		if ($this->canView( )) {
			$str .= "<div class=\"fabrikLabel";
			if (isset( $this->_aValidations ) &&  count( $this->_aValidations ) > 0) {
				foreach ($this->_aValidations as $oValidation) {
					$vid = $oValidation->validation_plugin;
					if (array_key_exists( $vid, $this->_form->_validationRuleClasses )) {
						if ($this->_form->_validationRuleClasses[$vid] != '') {
							$str .= " " . $this->_form->_validationRuleClasses[$vid];
						}
					}
				}
			}
			
			$str .= "\" id=\"$elementid" . "_text\">";
			if ($bLabel) {
				$str .= "<label for=\"$elementHTMLId\">";
			}
			$label = $element->label;
			//posssible solution to mamblefish traslation bug????:
			 if (class_exists( 'JoomFish' )) {
   				$label = JoomFish::translate( $this, 'fabrik_elements', $mosConfig_lang );
			 }
			$rollOver = JText::_($params->get( 'hover_text_title' ), true) . "::" . JText::_( $params->get( 'rollover' ), true);
			$rollOver = htmlspecialchars(get_magic_quotes_gpc() ? stripslashes($rollOver) : $rollOver,ENT_QUOTES);
			if ($rollOver != '::') {
				$str .= "<span class='hasTip' title='$rollOver'>$label</span>";
			} else {
				$str .= $label;
			}
			if ($bLabel) {
				$str .= "</label>";
			}
			$str .= "</div>\n";
		}
		return $str;		
	}
	
		/**
	 * used for the name of the filter fields
	 * For element this is an alias of getFullName()
	 * Overridden currently only in databasejoin class
	 *
	 * @param bol $includeJoinString
	 * @param bol $useStep
	 * @param bol $incRepeatGroup
	 * @return string element filter name
	 */
	
	function getFilterFullName( $includeJoinString = true, $useStep = true, $incRepeatGroup = true )
	{
		return $this->getFullName( false, true, false );
	}
	
	/**
	 * refractored from group class - can be overwritten by plugins
	 * If already run then stored value returned
	 * @param bol add join[joinid][] to element name (default true)
	 * @param bol concat name with form's step element (true) or with '.' (false) default true 
	 * (TEST: now this is no longer used and always returns ___ 
	 * @param bol include "[]" at the end of the name (used for repeat group elements) default true
	 */
	
	function getFullName( $includeJoinString = true, $useStep = true, $incRepeatGroup = true )
	{
		$db			=& JFactory::getDBO();
		$groupModel =& $this->_group;
		$formModel 	=& $this->_form; 
		$tableModel =& $this->_table;
		$element 	=& $this->getElement();
		
		$key = $element->name . $groupModel->_id . "_" . $formModel->_id . "_" .$includeJoinString . "_" . $useStep . "_" . $incRepeatGroup;
		if (isset( $this->_aFullNames[$key] )) {
			return $this->_aFullNames[$key];
		}
		
		$defaultVal = '';
		$thisStep = ($useStep) ? $formModel->_joinTableElementStep : '.';
		$group =& $groupModel->getGroup();
		if ($group->is_join) {
			$joinModel =& JModel::getInstance( 'Join', 'FabrikModel' );
			$join =& $joinModel->loadFromGroupId( $group->id );
			if ($includeJoinString) {
				$fullName = 'join[' . $join->id . '][' . $join->table_join . $thisStep . $element->name . ']';
			} else {
				$fullName =  $join->table_join . $thisStep . $element->name ;
			}	
		} else {
			$table =& $tableModel->getTable();
			$fullName = $table->db_table_name . $thisStep . $element->name;
		}
		if ($groupModel->canRepeat() == 1 && $incRepeatGroup) {
			$fullName .=  "[]";
		}

		$this->_aFullNames[$key] = $fullName;
		return $fullName;		
	}

	
	/**
	 *  - can be overwritten by plugins
	 * @param bol add join[joinid][] to element name (default true)
	 * @param bol concat name with form's step element (true) or with '.' (false) default true
	 * 
	 */
	
	function getOrderbyFullName( $includeJoinString = true, $useStep = true )
	{
		return $this->getFullName( $includeJoinString , $useStep );
	}
	
	/**
	 * helper function to draw hidden field, used by any plugin that requires to draw a hidden field
	 * @param string hidden field name
	 * @param string hidden field value
	 * @param string hidden field id
	 * @return string hidden field
	 */

	function getHiddenField( $elementHTMLName, $value, $elementHTMLId='' )
	{
		$id = '';
		if ($elementHTMLId != '') {
			$id = "id=\"$elementHTMLId\"";
		}
		$str = "<input type=\"hidden\" name=\"$elementHTMLName\"  $id value=\"$value\" />\n";
		return $str;
	}
	
	function check() 
	{
		return true;
	}
	
	function copyRow( $id, $copytxt = 'Copy of ', $groupid = null  )
	{
		$rule		=& JTable::getInstance( 'element', 'Table' );

		
		if ($rule->load( (int)$id ))
		{
			$rule->id				= 0;
			$rule->label	= $copytxt . $rule->label;
			if (!is_null( $groupid )) {
				$rule->group_id = $groupid;
			}
			$rule->created = JHTML::_( 'date', $row->created, '%Y-%m-%d %H:%M:%S' );
			$rule->attribs = $rule->attribs . "\nparent_linked=1";
			$rule->parent_id = $id;
			if (!$rule->store()) {
				return JError::raiseWarning( $rule->getError() );
			}
		}
		else {
			return JError::raiseWarning( 500, $rule->getError() );
		}
	}

	/**
	 * draws out the html form element - overwritten in plugin 
	 */

	function render()
	{
		return $this->getElementHTML();
	}
	
	/**
	 * get the id used in the html element
	 *
	 * @return string 
	 */
	
	function getHTMLId( )
	{
		$groupModel =& $this->_group;
		$formModel =& $this->_form;
		$table =& $this->_table->getTable();
		if (!isset( $this->_elementHTMLId )) {
			$includeJoinString = true;
			$groupTable =& $groupModel->getGroup();
			$element =& $this->getElement();
			$defaultVal = '';
			if ($groupTable->is_join) {
				$joinModel =& JModel::getInstance( 'Join', 'FabrikModel' );
				$joinTable =& $joinModel->loadFromGroupId( $groupTable->id, $table->id );
				if ($includeJoinString) {
					$fullName = 'join___' . $joinTable->id . '___' . $joinTable->table_join . '___' . $element->name ;
				} else {
					$fullName =  $joinTable->table_join . '___' . $element->name ;
				}	
			} else {
				$fullName = $table->db_table_name . '___' . $element->name;
			}
			//@TODO: check this - repeated elements do need to have something applied to thier
			// id based on their order in the repeated groups

			//INVALID XHTML 
			//if ($groupModel->canRepeat() == 1) {
			//	$fullName .=  "[]";
			//}				
			$this->_elementHTMLId =  $fullName;
		}
		return $this->_elementHTMLId;
	}
	
	/**
	 * get the element html name
	 *
	 * @return string
	 */
	
	function getHTMLName( $repeatCounter = 0 )
	{
		$groupModel =& $this->_group;
		$formModel =& $this->_form;
		$table =& $this->_table->getTable();
		//if (!isset( $this->_elementHTMLName )) {
			$includeJoinString = true;
			$group =& $groupModel->getGroup();
			$element =& $this->getElement();
			$defaultVal = '';
			if ($group->is_join) {
				$joinModel =& JModel::getInstance( 'Join', 'FabrikModel' );
				$joinTable =& $joinModel->loadFromGroupId( $group->id, $table->id );
				if ($includeJoinString) {
					$fullName = 'join[' . $joinTable->id . '][' . $joinTable->table_join . '___' . $element->name . ']' ;
				} else {
					$fullName =  $joinTable->table_join . '___' . $element->name ;
				}	
			} else {
				$fullName = $table->db_table_name . '___' . $element->name;
				if ($groupModel->canRepeat()) {
					if ($this->hasSubElements) {
						$fullName .= "[$repeatCounter]";
					}else{
						$fullName .= "[]";
					}
				}
			}
			
			//new testing ?
			if ($this->hasSubElements) {
				$fullName .= "[]";
			}
		
			//@TODO: check this - repeated elements do need to have something applied to thier
			// id based on their order in the repeated groups
			
			$this->_elementHTMLName =  $fullName;
		//}
		return $this->_elementHTMLName;
	}
	
	/**
	 * overwirte the standard load function to load in validations and js
	 */
	
/**
	*	binds an array/hash to this object
	*	@param int $oid optional argument, if not specifed then the value of current key is used
	*	@return any result from the database operation
	*/
	
	function load( $oid=null ) {
		$k = $this->_tbl_key;
		
		if ($oid !== null) {
			$this->$k = $oid;
		}
		$oid = $this->$k;
		if ($oid === null) {
			return false;
		}
		$class_vars = get_class_vars(get_class($this));
		foreach ($class_vars as $name => $value) {
			if (($name != $k) and ($name != "_db") and ($name != "_tbl") and ($name != "_tbl_key")) {
				$this->$name = $value;
			}
		}
		$this->reset();
		
		$query = "SELECT #__fabrik_elements.*, "
		. "\n CONCAT( action , ' = \"' ,  code , '\"') AS js"
		. "\n FROM $this->_tbl"
		. "\n LEFT JOIN #__fabrik_jsactions ON"
		. "\n $this->_tbl.id"
  		. "\n = #__fabrik_jsactions.element_id"
 		. "\n WHERE $this->_tbl.$this->_tbl_key = '$oid'";
 		
		$this->_db->setQuery( $query );
		return $this->_db->loadObject( $this );
	}
	
	/**
	 * SHOULD USE THIS RATHER THAN loadParams() as nomicalture is more appropriiate
	 * also loads _pluginParams for good measure
	 * @return object default element params
	 */

	function &getParams()
	{
		if (!isset( $this->_params )) {
			$this->_params =& $this->_loadParams();
			$this->getPluginParams();
		}
		return $this->_params;
	}

	/**
	 * get specific plugin params (lazy loading)
	 *
	 * @return object plugin parameters
	 */

	function &getPluginParams()
	{
		if (!isset( $this->_pluginParams )) {
			$this->_pluginParams = $this->_loadPluginParams();
		}
		return $this->_pluginParams;
	}
	
	/**
	 * load element params
	 * @access private - public call = loadParams()
	 *
	 * @return object element parameters
	 */

	function &_loadParams()
	{
		$element =& $this->getElement();
		$p = &new fabrikParams( $this->_element->attribs, JPATH_SITE . '/administrator/components/com_fabrik/xml/element.xml' , 'component' );
		return $p; 
	}
	
	function _loadPluginParams()
	{
		if (isset( $this->_xmlPath )) {
			$element =& $this->getElement();
			$pluginParams = &new fabrikParams( $element->attribs, $this->_xmlPath, 'fabrikplugin' );
			$pluginParams->bind( $element );
			return $pluginParams;
		}
		return false;
	}

	/**
	 * loads in elements validation objects
	 * @return array validation objects
	 */

	function loadValidations( )
	{
	 	$db =& JFactory::getDBO();
	 	$query = "SELECT id FROM #__fabrik_validations WHERE element_id = '$this->_id'";
	 	$db->setQuery( $query );
	 	$aIds = $db->loadResultArray( );
	 	$aValidations = array();
	 	foreach ($aIds as $id) {
 			$oValidation =& JTable::getInstance( 'Validation', 'Table' );
 			$oValidation->load( $id );
 			$aValidations[] = $oValidation; 
	 	}
	 	$this->_aValidations = $aValidations;
	 	return $aValidations;
	 }
	 
	 /**
	  * 
	  */
	 
	function getValidations()
	{
		if (is_null( $this->_aValidations )) {
			$this->loadValidations();
		}
		return $this->_aValidations;
	}
	
	 /**
	  * 
	  */
	 
	function getJSEventTypesDd( $jsActions )
	{
		return JHTML::_('select.genericlist',  $jsActions, 'js_action[]', 'class=\"inputbox\" size=\"1\"', 'value', 'text', '');	 	
	}
	 
	 /**
	  * @return array available javascript events
	  */
	 
	function getJSDefaultActions()
	{
	 	$jsActions = array( );
	 	$jsActions[] = JHTML::_('select.option', "onfocus" );
		$jsActions[] = JHTML::_('select.option', "blur" );
		$jsActions[] = JHTML::_('select.option', "abort" );
		$jsActions[] = JHTML::_('select.option', "click" );
		$jsActions[] = JHTML::_('select.option', "change" );
		$jsActions[] = JHTML::_('select.option', "dblclick" );
		$jsActions[] = JHTML::_('select.option', "keydown" );
		$jsActions[] = JHTML::_('select.option', "keypress" );
		$jsActions[] = JHTML::_('select.option', "keyup" );
		$jsActions[] = JHTML::_('select.option', "mouseup" );
		$jsActions[] = JHTML::_('select.option', "mousedown" );
		$jsActions[] = JHTML::_('select.option', "mouseover" );
		$jsActions[] = JHTML::_('select.option', "select" );
		$jsActions[] = JHTML::_('select.option', "load" );
		$jsActions[] = JHTML::_('select.option', "unload" );
		return $jsActions; 	
	}
	 
	 /**
	  * make a data array to create current js action html elements
	  */
	 
	function getJSActionsDd( $defaultList )
	{
		$aJsActionObjs = $this->getJSActions();
		$aJsActions = array( );
		if (is_array( $aJsActionObjs )) {
			foreach ($aJsActionObjs as $oJsAction) {
				$jsActionList = JHTML::_('select.genericlist',  $defaultList, 'js_action[]', "class=\"inputbox\"  size=\"1\" ", 'value', 'text', $oJsAction->action );
				$aJsActions[] = array( $jsActionList, $oJsAction->code );
			}
		}
	 	return $aJsActions;
	}
	 
	/**
	 * get javasscript actions
	 *
	 * @return array js actions
	 */
	function getJSActions()
	{
	 	if (!isset( $this->_jsActions )) {
	 		$sql = "SELECT * FROM #__fabrik_jsactions WHERE element_id = '$this->_id'";
			$this->_db->setQuery( $sql );
			$this->_jsActions = $this->_db->loadObjectList( );
	 	}
	 	return $this->_jsActions;
	 }

	 /**
	  *create the js code to observe the elements js actions
	  * @param array all javascript events for the form key'd on element id
	  * @return string js events
	  */

	 function getFormattedJSActions( $allJsActions )
	 {
	 	$jsStr = '';
	 	$element =& $this->getElement();
	 	if (array_key_exists( $this->_id, $allJsActions )) {
	 		$elId = $this->getHTMLId();
	 		foreach ($allJsActions[$this->_id] as $jsAct) {
				$js = addSlashes( $jsAct->code );
				$js = str_replace(array("\n", "\r"), "", $js);
				$jsStr .= "ofabrik.dispatchEvent( '$element->plugin', '$elId', '$jsAct->action', '$js');\n";
	 		}
	 	}
	 	return $jsStr;
	 }

	 /**
	  * presumes that the group is in a form (NOT a table joins group)
	  * if its a table join group then use getElementsJoinTables();
	  * @return array tables that the element is in
	  */

	 function getElementsGroupTables( )
	 {
	 	$db =& JFactory::getDBO();
	 	$aTableNames = array( );
	 	$sql = "SELECT form_id FROM #__fabrik_formgroup WHERE group_id = '". $this->_element->group_id ."'";
	 	$db->setQuery( $sql );
	 	echo $db->getErrorMsg( );
	 	$aForms = $db->loadResultArray( );
	 	foreach ($aForms as $formId) {
	 		$sql = "SELECT * FROM #__fabrik_tables WHERE form_id = '$formId'";
	 		$db->setQuery( $sql );
	 		$aTables = $db->loadObjectList( );
	 		$aTableNames = array_merge( $aTableNames, $aTables );
	 	}
	 	return $aTableNames;
	 }
	 
	 /**
	  * presumes that the group is in a form (NOT a table joins group)
	  * if its a table join group then use getElementsJoinTables();
	  * @param string distinct fields to load from
	  * @return array table objects that the element is in
	  */

	 function myTables( $distinct = '' )
	 {
	 	$db =& JFactory::getDBO();
	 	$aTableNames = array( );
	 	$element = $this->getElement();
	 	$sql = "SELECT form_id FROM #__fabrik_formgroup WHERE group_id = '$element->group_id'";
	 	$db->setQuery( $sql );
	 	$aForms = $db->loadResultArray( );
	 	foreach ($aForms as $formId) {
	 		if ($distinct != '') {
	 			$sql = "select id, count($distinct) FROM #__fabrik_tables ".
				"WHERE form_id = '$formId' ".
				"GROUP BY $distinct HAVING count($distinct)>=1 ";
	 		} else {
	 			$sql = "SELECT id FROM #__fabrik_tables WHERE form_id = '$formId'";
	 		}
	 		$db->setQuery( $sql );
	 		$aTables = $db->loadObjectList( );
	 		foreach ($aTables as $o) {
	 			$model =& JModel::getInstance( 'Table', 'FabrikModel' );
	 			$model->setId( $o->id );
	 			$model->getTable();
	 			$aTableNames[] = $model;
	 		}
	 	}
	 	return $aTableNames;
	 }

	 /**
	  * presumes that the group is NOT in a form (IE in a table joins group)
	  * if its a in a form then use getElementsGroupTables();
	  * @return array tables that the element is in
	  */
	  
	 function getElementsJoinTables()
	 {
	 	$db =& JFactory::getDBO();
	 	$sql = "SELECT table_join FROM #__fabrik_joins WHERE element_id = '$this->_id'";
	 	$db->setQuery( $sql );
	 	return $db->loadResultArray( );
	 }

	 /**
	  *
	  */

	 function getAdvancedJoinsObjs()
	 {
	 	if (is_null( $this->_advancedJoins )) {
	 		return $this->_loadAdvancedJoinsObjs();
	 	} else {
	 		return $this->_advancedJoins;
	 	}
	 }
	 
	 function _loadAdvancedJoinsObjs()
	 {
	 	$db =& JFactory::getDBO();
	 	$sql = "SELECT * FROM #__fabrik_joins WHERE element_id = '$this->_id' AND element_id != '0' ORDER BY id";
	 	$db->setQuery( $sql );
	 	$this->_advancedJoins = $db->loadObjectList( );
	 	return $this->_advancedJoins;
	 }

	 /**
	  * used to get the default value for table filters when they are advanced element joins
	  * @param array posted filter information
	  * @return dafault value for filter
	  */
	  
	 function getDefaultAdvancedFilterVal( $aFilter )
	 {
	 	$this->getAdvancedJoinsObjs();
 		foreach ($this->_advancedJoins as $oJoin) {
 			$testKey = $oJoin->join_from_table . "." . $oJoin->table_join_key;
 			if (isset( $aFilter[$testKey] )) {
				return $aFilter[$testKey]['filterVal'];
 			}
 		}
	 	return '';
	 }

 	/**
 	 * get the default value for the table filter
 	 * @param string tablename
 	 * @param string element name
 	 * @param array exisiting table filter data
 	 */

	 function getDefaultFilterVal( $origTable, $elName,  $aFilter = null )
	 {
	 	$data = JRequest::get('request');
	 	$groupModel =& $this->_group;
	 	$group =& $groupModel->_group;
	 	$params =& $this->getParams();
	 	$element =& $this->getElement();
	 	if ($group->is_join) {
			if (array_key_exists( 'join', $data ) && array_key_exists( $group->join_id, $data['join'] )) {
	 			$data = $data['join'][$group->join_id];
			}
		}
	 	$default 		= "";
	 	if (array_key_exists( $elName, $data )) {
	 		if (is_array( $data[$elName])) {
		 		$default = @$data[$elName]['value'];
	 		}
	 	}
	 	if ($default == '') {
	 		if (isset( $aFilter )) {
		 		if (isset($aFilter[$elName] )) {
		 			if (is_array( $aFilter[$elName] )) {
			 			if (array_key_exists( 'filterVal', $aFilter[$elName] )) {
			 				$default = $aFilter[$elName]['filterVal'];
			 			} else {
			 				$default = $aFilter[$elName]['value'];
			 			}
		 			} else {
		 				print_r($aFilter[$elName]);	
		 			}
		 		} else {
		 			$k = $params->get('join_db_name'). "." . $params->get('join_val_column');
		 			if (@isset($aFilter[$key] )) {
		 				$default = $aFilter[$k]['filterVal'];;
		 			}
		 		}
	 		}
	 	}
	 	return $default;
	 }
	 
	 /**
	  * if the search value isnt what is stored in the database, but rather what the user
	  * sees then switch from the search string to the db value here
	  * overwritten in things like checkbox and radio plugins
	  * @param string $filterVal
	  * @return string
	  */
	 
	 function prepareFilterVal( $filterVal )
	 {
	 	return $filterVal;
	 }

 /**
  * can be overwritten by plugin class
  * Get the sql for filtering the table data and the array of filter settings
  * @param array posted data for the element
  * @param array filters
  * @param string db col key name e.g. table.elname
  * @param string form key name e.g. table___elname
  * @return array filter
  */

	function getFilterConditionSQL( $val, $aFilter, $dbKey, $key )
	{
	 	$cond ='';
	 	/* if posted data comes from a module we want to strip out its table name
		 and replace it with current table name
		 not sure how to deal with this for joins ? */

	 	//TODO: this is a cadidate for caching
		$fromModule 		 = JRequest::getBool( 'fabrik_frommodule', 0 );
	 	
		$filterType =  isset( $val['type']) ? $val['type'] : 'dropdown';
	 	$filterVal = isset( $val['value'] )? $val['value'] : '';
	 	
	 	$filterVal = $this->prepareFilterVal( $filterVal );
	 	
	 	$filterExactMatch = isset( $val['match'] )? $val['match'] : '';
	 	$fullWordsOnly = isset( $val['full_words_only'] )? $val['full_words_only'] : '1';
	 	$joinDbName = isset( $val['join_db_name']) ? $val['join_db_name'] : '';
	 	$joinKey = isset( $val['join_key_column']) ? $val['join_key_column'] : '';
		$joinVal = isset( $val['join_val_column']) ? $val['join_val_column'] : '';
	 	
	 	if ($filterVal == "" ) {
	 		return;
	 	}
		switch ($filterType)
			{
			case 'dropdown';
				$filterVal = urldecode($filterVal);
				if ($fromModule) {
					$aKeyParts = explode( '.', $key);
					$key = $this->db_table_name . '.' . $aKeyParts[1];
				}
				if (!is_array( $filterVal )) {
					if ( $filterExactMatch == '0' ){
						$cond = " $dbKey LIKE '%$filterVal%' ";
					} else {
						$cond = " $dbKey = '$filterVal' ";
					}
				} else {
					$cond = "( ";
					foreach ($filterVal as $fval) {
						if (trim( $fval ) != '') {
							if ($filterExactMatch == '0') {
								$cond .= " $dbKey LIKE '%$fval%' OR ";
							} else {
								if (trim( $fval ) == '_null_') {
									$cond .= " $dbKey IS NULL OR ";
								} else {
									$cond .= " $dbKey = '$fval' OR ";
								}
							}
						}
					}
					$cond = substr( $cond, 0, strlen($cond)-3 );
					$cond .= " ) ";	
				}
				
				if (array_key_exists( $key, $aFilter )) {
					$aFilter[$key][] = $aFilter[$key];
					$aFilter[$key][] = array('type'=>'dropdown', 'value'=>$filterVal , 'filterVal'=>$filterVal, 'sqlCond' =>$cond );
				} else {
					$aFilter[$key] = array('type'=>'dropdown', 'value'=>$filterVal , 'filterVal'=>$filterVal, 'sqlCond' =>$cond );
				}
				break;
			case "":
			case "field":
				$filterVal = urldecode( $filterVal );
				$filterCondSQL = '';
				if ($joinDbName != '') {
					$filterCondSQL .= " LEFT JOIN $joinDbName ON `$joinDbName`.`$joinKey` = $dbKey ";
				}
				/* full_words_only
				 all search for multiple fragments of text*/
				$aFilterVals = explode( "+", $filterVal );
				if ($fullWordsOnly == '1') {
					$cond = " $dbKey REGEXP \"[[:<:]]" . $filterVal . "[[:>:]]\"";
				} else {
					$cond = " $dbKey LIKE '%$filterVal%'";
				}
				$aFilter[$key] = array('type'=>'field',
				'value'=>$filterVal,
				'filterVal'=>$filterVal,
				'full_words_only'=>$fullWordsOnly,
				'join_db_name' => $joinDbName,
				'join_db_key' => $joinKey,
				'join_val_column' => $joinVal,
				'prewritten_join' => $filterCondSQL,
				'sqlCond' =>$cond
				);				
				break;
			case "search":
				if ($joinDbName != '') {
					$filterCondSQL .= " LEFT JOIN $joinDbName ON $joinDbName.$joinKey = " . $this->db_table_name . "." . $this->db_primary_key . " ";
				}
				$filterVal = urldecode($filterVal);
				$cond2 = $key . " " . str_replace( '\"', '"', $filterVal );
				$cond = $cond2;
				$aFilter[$key] = array('type'=>'search', 
											   'value'=>$cond2, 
												'filterVal'=>$filterVal, 
												'full_words_only'=>$fullWordsOnly,
												'join_db_name' => $joinDbName,
												'join_db_key' => $joinKey
												, 'sqlCond' =>$cond 
												);	
				break;
				
			case "range":
				if ($filterVal[0] != '' & $filterVal[1] != '') {
					$cond = " $dbKey BETWEEN '" . $filterVal[0] . "' AND '" . $filterVal[1] . "'";
					$aFilter[$key] = array('type'=>'range', 
				   'value'=>$filterVal, 
					'filterVal'=>$filterVal, 
					'full_words_only'=>$fullWordsOnly,
					'join_db_name' => $joinDbName,
					'join_db_key' => $joinKey
					, 'sqlCond' =>$cond 
					);
				} else {
					return ;
				}	
				break;
		}
	 if (array_key_exists( $key, $aFilter )) {
			return $aFilter[$key];
		} else {
			return '';
		}
	}
	 
	 /**
	  * can be overwritten by plugin class
	  * Get the table filter for the element
	  * @param object group model
	  * @return string filter html
	  */
	 
	function getFilter( )
	{
		global $mainframe;
	 	$tableModel  	=& $this->_table;
	 	$groupModel		=& $this->_group;
	 	$table				=& $tableModel->getTable();
	 	$element			=& $this->getElement();
	 	$origTable 		= $table->db_table_name;
	 	$fabrikDb 		=& $tableModel->getDb();
	 	$params			=& $this->getParams( );
	 	$formModel		=& $tableModel->getForm();
		$js 					= "";
		$elName 		= $this->getFullName( false, true, false );
		$dbElName		= $this->getFullName( false, false, false );
		$elName2 		= $this->getFullName( false, false, false );
		$ids 				= $tableModel->getColumnData( $elName2 );
		//for ids that are text with apostrophes in
	 	for ($x=0;$x<count( $ids );$x++) {
			$ids[$x] = addSlashes( $ids[$x] );	
		}
		$elLabel				= $element->label;
		$elExactMatch 	= $element->filter_exact_match;
		$v 				= $elName . "[value]";
		$t 				= $elName . "[type]";
		$e 				= $elName . "[match]";
		$jt 			= $elName . "[join_db_name]";
		$jk 			= $elName . "[join_key_column]";
		$jv 			= $elName . "[join_val_column]";
		$origDate 		= $elName . "[filterVal]";
		$fullword 		= $elName . "[full_words_only]";
		//corect default got
		$default = $this->getDefaultFilterVal( $origTable, $elName, $tableModel->_aFilter );
		
		$aThisFilter = array();
	
		//filter the drop downs lists if the table_view_own_details option is on
		//other wise the lists contain data the user should not be able to see
		// note, this should now use the prefilter data to filter the list

		/* check if the elements group id is on of the table join groups if it is then we swap over the table name*/
		$fromTable = $origTable;
		$joinStr = $tableModel->_buildQueryJoin();
		
		foreach ($tableModel->_aJoins as $aJoin) {
		/** not sure why the group id key wasnt found - but put here to remove error **/
			if (array_key_exists( 'group_id', $aJoin )) {
			
				if ($aJoin->group_id == $element->group_id && $aJoin->element_id == 0) {
					$fromTable = $aJoin->table_join;
					//echo ' ' . $fromTable;
					$elName = str_replace( $origTable . '.', $fromTable . '.', $elName);
					$v = $fromTable . '___' . $element->name . "[value]";
					$t = $fromTable . '___' . $element->name . "[type]";
					$e = $fromTable . '___' . $element->name . "[match]";
					$fullword = $elName . "[full_words_only]";
				}
			}
		}
		/* elname should be in format table.key add quotes:*/
		$dbElName = explode( ".", $dbElName );
		$dbElName = "`" . $dbElName[0] . "`.`" . $dbElName[1] . "`";
		
		$sql = "SELECT DISTINCT( $dbElName ) AS elText, $dbElName AS elVal FROM `$origTable` $joinStr\n";
		$sql .= "WHERE $dbElName IN ('" . implode( "','", $ids ) . "')"
			. "\n AND TRIM($dbElName) <> '' GROUP BY elText ASC";
		
		$context = "com_fabrik.table." . $tableModel->_id . ".filter." . trim($elName);
		$default = $mainframe->getUserStateFromRequest( $context, trim($elName), $default );
		
		
		$jsfilter = "";
		switch ( $element->filter_type )
		{
			case "range":
				$fabrikDb->setQuery( $sql );
				$oDistinctData = $fabrikDb->loadObjectList( );
				$obj = new stdClass;
				$obj->elVal  = "";
				$obj->elText = JText::_( 'Please select' );
				$aThisFilter[] = $obj;
				if (is_array( $oDistinctData )) {
					$aThisFilter = array_merge( $aThisFilter, $oDistinctData );
				}
	
				$attribs = 'class="inputbox fabrik_filter" size="1" ';
				$default1 = (is_array($default)) ? $default['value'][0] : '';
				$return 	 = JHTML::_('select.genericlist', $aThisFilter , $v.'[]', $attribs, "elVal", 'elText', $default1, $element->name . "_filter_range_0" );
				$default1 = (is_array($default)) ? $default['value'][1] : '';
				$return 	 .= JHTML::_('select.genericlist', $aThisFilter , $v.'[]', $attribs, "elVal", 'elText', $default1 , $element->name . "_filter_range_1");
				break;				
			case "dropdown":
				$fabrikDb->setQuery( $sql );
				$oDistinctData = $fabrikDb->loadObjectList( );
				$obj = new stdClass;
				$obj->elVal  = "";
				$obj->elText = JText::_( 'Please select' );
				$aThisFilter[] = $obj;
				if (is_array( $oDistinctData )) {
					$aThisFilter = array_merge( $aThisFilter, $oDistinctData );
				}
				$return 	 = JHTML::_('select.genericlist',  $aThisFilter , $v, 'class="inputbox fabrik_filter" size="1" ' . $jsfilter , "elVal", 'elText', $default );
				break;
				
			case "field":
				
				$default = ( is_array( $default ) && array_key_exists( 'value', $default) ) ? $default['value'] : '';
				if (get_magic_quotes_gpc()) {
					$default			= stripslashes( $default );
				}
				$default = htmlspecialchars( $default );
				$return = "<input type='text' name='$v' class=\"inputbox fabrik_filter\" value=\"$default\" $jsfilter  />";	
				break;
				//moved to table options
			/*case "search":
				*/
			}
		$return .= "\n<input type='hidden' name='$t' value='$element->filter_type' />\n";
		$return .= "\n<input type='hidden' name='$e' value='$elExactMatch' />\n";
		$return .= "\n<input type='hidden' name='$fullword' value='" . $params->get('full_words_only', '0') . "' />\n";	 
		return $return;
	}
	 
	 /**
	  * @param object element params
	  */
	  
	 function getAdvancedJoins( $params, &$pluginManager )
	 {
	 	$db =& JFactory::getDBO();
	 	$aJoinObjs = $this->getAdvancedJoinsObjs( );
		$lists = array( );
		$joinTypeDd = FabrikHelperHTML::joinTypeList( );
		$lists['jointypes'] = $joinTypeDd;
		$lists['tablejoin'] = "";
		$lists['defaultJoinTables'] = '';
		$lists['defaultJoinTableFrom'] = '';
		$joinFromTables = array();
		$javascript = '';
		
		$startTable = $params->get( 'advJoin_startTable', '' );
		if( $startTable != '' ){
			$joinFromTables[] = JHTML::_('select.option', $startTable, $startTable );
		}
		$myTables = $this->getElementsGroupTables( );
	 	foreach( $myTables as $table ){
	 		$joinFromTables[] = JHTML::_('select.option', $table->db_table_name, $table->db_table_name );
	 	}
	 	if( is_null(  $this->_element->plugin ) ){
	 		$this->_element->plugin = "fabrikfield";
	 	}
	 	$basePlugIn =& $pluginManager->_plugIns['element'][$this->_element->plugin];
		$oConn = &JModel::getInstance('Connection', 'FabrikModel');
		$params = @new fabrikParams( $this->_element->attribs, $basePlugIn->_xmlPath, 'plugin' );
		$joinConnId =  $params->get( 'join_conn_id', -1 ) ;
		if( is_null( $joinConnId ) ||$joinConnId == -1 ){
			$oConn->loadDefaultConnection( );
		} else {
			$oConn->getConnection( $joinConnId );
		}
		
		if ( is_array( $aJoinObjs ) ){
			for( $ff = 0;$ff < count( $aJoinObjs ); $ff++ ){
				$oJoin = $aJoinObjs[$ff];
				$joinFromTables[] = JHTML::_('select.option', $oJoin->table_join, $oJoin->table_join );
		
				$aJoinObjs[$ff]->join_type = $joinTypeDd;
				$tableDd = $oConn->getTableDdForThisConnection( $javascript, 'table_join[]', $oJoin->table_join );
				$aJoinObjs[$ff]->table_join = $tableDd;
			}
			
			for( $ff = 0;$ff<count( $aJoinObjs );$ff++ ){
				$aJoinObjs[$ff]->join_from_table = JHTML::_('select.genericlist',  $joinFromTables, 'join_from_table[]', 'class="inputbox" size="1" ', 'value', 'text',$aJoinObjs[$ff]->join_from_table ); 
			}
			$lists['joins'] = $aJoinObjs;
			$lists['defaultJoinTables'] = $oConn->getTableDdForThisConnection( $javascript, 'table_join[]', '');
			$lists['defaultJoinTableFrom'] = JHTML::_('select.genericlist',  $joinFromTables, 'join_from_table[]', ' class="inputbox" size="1" ', 'value', 'text','' );
		}
		return $lists;	
	 }

	
	/**
	 * delete old javascript actions for the element
	 * & add new javascript actions
	 */
	 
	function updateJavascript( )
	{
		$db =& JFactory::getDBO();
		$db->setQuery( "DELETE FROM #__fabrik_jsactions WHERE element_id = '$this->_id'" );
		$db->query( );
		$post	= JRequest::get( 'post' );
		if (isset( $post['js_action'] )) {
			if (is_array( $post['js_action'] )) {
				for ($c = 0; $c < count( $post['js_action'] ); $c ++) {
					$jsAction = $post['js_action'][$c];
					if ($jsAction != '') {
						$code = $post['js_code'][$c];
						$code = str_replace( "}", "}\n", $code );
						$code = str_replace( '"', "'", $code );
						$sql = 'INSERT INTO #__fabrik_jsactions (element_id, action, code) VALUES ("'.$this->_id.'", "'.$jsAction.'", "'.$code.'")';
						$db->setQuery( $sql );
						$db->query( );
					}
				}
			}
		}
	}
	
	/**
	 * update elements validations when saving the element
	 */
	 
	function updateValidations( )
	{
		$db =& JFactory::getDBO();
		//get ids of all old validations
		$db->setQuery( "SELECT id FROM #__fabrik_validations WHERE element_id = '$this->_id'");
		$aOldIds 		= $db->loadResultArray();
		$ids				= JRequest::getVar( 'validation_id', '', 'post' );
		$vids 			= JRequest::getVar( 'validation_plugin', array(), 'post' );
		$errMsgs	 	= JRequest::getVar( 'message', '', 'post' );
		$params 		= JRequest::getVar( 'validation_param', '', 'post' );
		for ($c = 0; $c < count( $vids ); $c ++) {
			$valId = $vids[$c];
			if (in_array( $ids[$c], $aOldIds )) {
				$aOldIds = array_diff( $aOldIds, array( $ids[$c] ) );
			}
			if ($valId != '') {
   				$validation =& JTable::getInstance('Validation', 'Table');
   				$validation->load( $ids[$c] );
   				$validation->element_id = $this->_id;
   				$validation->validation_plugin = $valId;
   				$validation->message = $errMsgs[$c];
			   	if (is_array( $params )) {
			   		$txt = array ();
			   		foreach ($params as $k => $v) {
			   			$v 		= stripslashes($v[$c]);
			   			$v 		= str_replace( "\n", '<br />', $v );
			   			$txt[] = "$k=$v";
			   		}
			   		$validation->attribs = implode( "\n", $txt );
			   	}
				$validation->store();
			}
		}
	
		//delete the removed validations
		if (!empty( $aOldIds )) {
			$db->setQuery( "DELETE FROM #__fabrik_validations WHERE id IN ('" . implode( "','", $aOldIds) . "')");
			$db->query( );
		}
	 }
										
	/**
	 * when adding a new element this will ensure its added to all tables that the
	 * elements group is associated with
	 * @param bol if the field is to be added (true) or altered (false) 
	 * @param string original column name leave null to ignore
	 */
	
	function addElementToDatabaseTable( $new, $origColName = null )
	{
		$db =& JFactory::getDBO();
		$user	  = &JFactory::getUser();
		// don't bother if the element has no name as it will cause an sql error'
		if ($this->_element->name == '') {
			return;
		}
		
		$groupModel =& JModel::getInstance( 'Group', 'FabrikModel' );
		$groupModel->setId( $this->_element->group_id );
		$groupTable 	=& $groupModel->getGroup();
		
		$formTable 	=& JTable::getInstance( 'Form', 'Table' ); 
		$tableModel	=& JModel::getInstance( 'Table', 'FabrikModel' ); 
		$afFormIds 	= $groupModel->getFormsIamIn( );
		if ($groupTable->is_join == '1') {
			$joinModel =& JModel::getInstance( 'Join', 'FabrikModel' );
			$joinTable =& $joinModel->loadFromGroupId( $this->_element->group_id );
			$tableModel->setId( $joinTable->table_id );
			$t = $tableModel->getTable();
			$tableModel->alterStructure( $this, $new, $origColName );
		} else {
			if (is_array( $afFormIds )) {
				foreach ($afFormIds as $formId) {
					$formTable->load( $formId );
					if ($formTable->record_in_database) {
						$tableTable =& $tableModel->loadFromFormId( $formId );
						$tableModel->alterStructure( $this, $new, $origColName );
						//$oTable->createCacheQuery(); //done inside alterStrucutre
					}
				}
			}
		}
	}
	 
	
	function onSave()
	{
		//overridden in element plugin if needed
	}
	
	/**
	 * DEPRECIATED??
	* a recursive method to return a list of all folders from a given parent directory
	* @param string parent directory
	* @return array child directories of parent directory
	*/
	
	function recursive_listdir( $base ) {
		static $filelist = array( );
		static $dirlist = array( );
		if ( is_dir( $base ) ) {
			$dh = opendir( $base );
			if ( $dh != false ) {
				while ( false !== ( $dir = readdir( $dh ) ) ) {
					if ( is_dir( $base."/".$dir ) && $dir !== '.' && $dir !== '..' && strtolower( $dir ) !== 'cvs' ) {
						$subbase = $base."/".$dir;
						$dirlist[] = $subbase;
						$subdirlist = $this->recursive_listdir( $subbase );
					}
				}
				closedir( $dh );
			}
		}
		return $dirlist;
	}
	
	/**
	 * states if the elemnt contains data which is recorded in the database
	 * some elements (eg buttons) dont
	 * @param array posted data
	 */

	function recordInDatabase( $data = null )
	{
		return $this->_recordInDatabase;
	}
	
	/**
	* Internal function to recursive scan directories
	* @param string Path to scan
	* @param string root path of this folder
	* @param array  Value array of all existing folders
	* @param array  Value array of all existing images
	* @param bol make options out for the results
	*/
	function readImages( $imagePath, $folderPath, &$folders, &$images, $aFolderFilter, $makeOptions = true ) {
		$imgFiles = $this->fabrikReadDirectory( $imagePath, '.', false, false, $aFolderFilter );
		foreach( $imgFiles as $file ) {
			$ff_ 	= $folderPath . $file .'/';
			$ff 	= $folderPath . $file;
			$i_f 	= $imagePath .'/'. $file;
			if ( is_dir( $i_f ) && $file != 'CVS' && $file != '.svn' ) {
				if( !in_array( $file, $aFolderFilter ) ){
					$folders[] = JHTML::_('select.option', $ff_ );
					$this->readImages( $i_f, $ff_, $folders, $images, $aFolderFilter );
				}
			} else if ( eregi( "bmp|gif|jpg|png", $file ) && is_file( $i_f ) ) {
				// leading / we don't need
				$imageFile = substr( $ff, 1 );
				if($makeOptions){
					$images[$folderPath][] = JHTML::_('select.option', $imageFile, $file );
				}else{
					$images[$folderPath][] = $file;
				}
			}
		}
	}	

	
	/**
	* Utility function to read the files in a directory
	* @param string The file system path
	* @param string A filter for the names
	* @param boolean Recurse search into sub-directories
	* @param boolean True if to prepend the full path to the file name
	*/
	
	function fabrikReadDirectory( $path, $filter='.', $recurse=false, $fullpath=false, $aFolderFilter=array(), $foldersOnly = false ) {
		$arr = array();
		if (!@is_dir( $path )) {
			return $arr;
		}
		$handle = opendir( $path );
		while( $file = readdir( $handle ) ){
			
		  $dir = JPath::clean( $path.'/'.$file );
			$isDir = is_dir( $dir );
			if( ( $file != "." ) && ( $file != ".." ) ){
				
			  if( preg_match( "/$filter/", $file ) ){
					
			    if( ( $isDir && $foldersOnly ) || !$foldersOnly ){
			      if( $fullpath ){
							$arr[] = trim( JPath::clean( $path.'/'.$file ) );
						} else {
							$arr[] = trim( $file );
						}
					}
				}
				$goDown = true;
				if( $recurse && $isDir ){
					foreach( $aFolderFilter as $sFolderFilter ){
						if( strstr( $dir, $sFolderFilter ) ){
							$goDown = false;
						}
					}
					
					if( $goDown ){
						$arr2 = $this->fabrikReadDirectory( $dir, $filter, $recurse, $fullpath,$aFolderFilter, $foldersOnly );
						$arrDiff = array_diff( $arr, $arr2 );
						$arr = array_merge( $arrDiff );
					}
				}
			}
		}
		closedir( $handle );
		asort( $arr );
		return $arr;
	}
	
	function getDatabaseDropdownDefaultValue( $defaultVal )
	{
		$params 			=& $this->getParams();
		$connectionModel =& JModel::getInstance('Connection', 'FabrikModel');
		$connectionModel->setId( $params->get('join_conn_id', -1) );
		$connection =& $connectionModel->getConnection();
		$joinDb =& $connectionModel->getDb();
		
			
		if ($params->get( 'joinType' ) == 'advanced') {
			$col	= $this->name;
			$aVals 	= array();
			$aAvJoins = $this->getAdvancedJoinsObjs( );
			$val = stripslashes( $params->get( 'advJoin_concat' ) );
			$table = $aAvJoins[0]->join_from_table;
			$key = $aAvJoins[0]->table_join_key;

			$key = $params->get( 'advJoin_key', $table.'.'.$this->name );	
			$table = $params->get( 'advJoin_startTable', $table );				  					
				
			$sql = "SELECT CONCAT($val) AS text FROM $table";
			$aUsedJoins = array();
			foreach ($aAvJoins as $oJoin) {
				$tmpSql = "\n $oJoin->join_type JOIN $oJoin->table_join ON $oJoin->join_from_table.$oJoin->table_key = $oJoin->table_join.$oJoin->table_join_key";
				if (!in_array( $tmpSql, $aUsedJoins )) {
					$sql .= $tmpSql;
					$aUsedJoins[] = $tmpSql;
				}
			}
			$sql .= " WHERE $key = '$defaultVal'";
			$joinDb->setQuery( $sql );
			$defaultVal = $joinDb->loadResult( );
		} else {
			$dbname = $params->get( 'join_db_name' );
			$keycol = $params->get( 'join_key_column' );
			$joincol = $params->get( 'join_val_column' );
			$sql = "SELECT $joincol FROM $dbname WHERE $keycol = '$defaultVal'";
			$joinDb->setQuery( $sql );
			$defaultVal = $joinDb->loadResult();
		}
		return $defaultVal;
	}
	
	/**
	 * calculation: sum
	 * can be overridden in element class
	 * @param object table model
	 * @return array 
	 */

	function sum( &$tableModel ){
		$db =& JFactory::getDBO();
		$joinSQL 	= $tableModel->_buildQueryJoin();
		$whereSQL 	= $tableModel->_buildQueryWhere();
		$params 	= $this->_params;
		$table =& $tableModel->getTable();
		$element =& $this->getElement();
		$splitSum	= $params->get( 'sum_split', '' );
		$sql = "SELECT SUM($element->name) AS value, 'calc' AS label FROM `$table->db_table_name` $joinSQL $whereSQL";
		$db->setQuery($sql);
		$results =  $db->loadObjectList('label');
		
		if ($splitSum != '') {
			$sql = "SELECT SUM($element->name) AS value, $splitSum AS label FROM `$table->db_table_name` $joinSQL $whereSQL GROUP BY $splitSum ";
			$db->setQuery($sql);
			$results2 =  $db->loadObjectList('label');
			echo $db->getErrorMsg();
			foreach ($results2 as $key => $val) {
				$results[$key] = $val;
			}
		}
		$res = '';
		foreach ($results as $o) {
			$res .= ($o->label == 'calc') ?  $o->value . "<br />" : $o->label . ': ' . $o->value . "<br />";
		}
		return array( $res, $results );		
	}

	/**
	 * calculation: avarage
	 * can be overridden in element class
	 * @param object table model
	 * @return string result 
	 */

	function avg( &$tableModel ){
		$db =& JFactory::getDBO();
		$joinSQL 		= $tableModel->_buildQueryJoin();
		$whereSQL 		= $tableModel->_buildQueryWhere();
		$params 		= $this->_params;
		$splitAvg		= $params->get( 'avg_split', '' );
		$table =& $tableModel->getTable();
		$element =& $this->getElement();
		$sql = "SELECT AVG($element->name) AS value, 'calc' AS label FROM `$table->db_table_name` $joinSQL $whereSQL" ;
		$db->setQuery($sql);
		$results =  $db->loadObjectList('label');
		
		if ($splitAvg != '') {
			$sql = "SELECT AVG($element->name) AS value, $splitAvg AS label FROM `$table->db_table_name` $joinSQL $whereSQL GROUP BY $splitAvg " ;
			$db->setQuery($sql);
			$results2 =  $db->loadObjectList('label');
			foreach ($results2 as $key => $val) {
				$results[$key] = $val;
			}
		}
		$res = '';
		foreach ($results as $o) {
			$res .= ($o->label == 'calc') ?  $o->value . "<br />" : $o->label . ': ' . $o->value . "<br />";
		}
		return array( $res, $results );	
	}

	/**
	 * calculation: median
	 * can be overridden in element class
	 * @param object table model
	 * @return string result 
	 */

	function median( &$tableModel ){
		$db =& JFactory::getDBO();
		$table =& $tableModel->getTable();
		$element =& $this->getElement();
		$joinSQL 		= $tableModel->_buildQueryJoin();
		$whereSQL 		= $tableModel->_buildQueryWhere();
		$params 		= $this->_params;
		$sql = "SELECT $table->name FROM `$table->db_table_name` $joinSQL $whereSQL";
		$db->setQuery($sql);	
		return $db->loadResultArray();
	}
	
	/**
	 * calculation: count
	 * can be overridden in element class
	 * @param object table model
	 * @return string result 
	 */
	
		
	function count( &$tableModel ){
		$db =& JFactory::getDBO();
		$table =& $tableModel->getTable();
		$element =& $this->getElement();
		$joinSQL 		= $tableModel->_buildQueryJoin();
		$whereSQL 		= $tableModel->_buildQueryWhere();
		
		$params 		= $this->_params;
		$splitCount 	= $params->get( 'count_split', '' );
		$sql = "SELECT COUNT($element->name) AS value, 'calc' AS label FROM `" . $table->db_table_name . "` $joinSQL " . $params->get('count_condition', '') . " $whereSQL";
		$db->setQuery( $sql );
		$results =  $db->loadObjectList();
		
		if ($splitCount != '') {
			$where = $params->get('count_condition', '');
			if($where != ''){
				$whereSQL = str_replace( "WHERE", "", $whereSQL);
			}
			$where .= " $whereSQL";
			$sql = "SELECT COUNT($element->name) AS value, $splitCount AS label FROM `".$table->db_table_name."` $joinSQL $where GROUP BY $splitCount ";
			$db->setQuery($sql);
			$results2 =  $db->loadObjectList('label');
			foreach ($results2 as $key => $val) {
				$results[$key] = $val;
			}
		}
		
		$res = '';
		foreach ($results as $o) {
			$o->label = ($o->label == 'calc') ?  JText::_( 'Empty' ) : $o->label; 
			$res .= $o->label . ': ' . $o->value . "<br />";
		}
		return array($res, $results);
	}
	
	/**
	 * overwritten in plugin classes
	 *
	 */
	function elementJavascript()
	{
	}
	
	/**
	 * create a class for the elements default javascript options
	 *	@return object options
	 */
	
	function getElementJSOptions()
	{
		$element =& $this->getElement();
		$opts = new stdClass();
		$opts->splitter = $this->_groupSplitter2;	
		$opts->editable = $this->_editable;
		$opts->defaultVal = $element->default;
		return $opts;
	}
	
	/**
	 * overwritten in plugin classes
	 * @return bol use wysiwyg editor
	 */
	function useEditor(){
		return false;
	}
	
	/**
	 * overwritten in plugin classes
	 * processes uploaded data
	 */
	function processUpload()
	{
	}
	
	/**
	 * overwritten in plugin classes
	 * get the class to manage the form element
	 */

	function formJavascriptClass()
	{
	}
	
	/**
	 * overwritten in plugin classes
	 * eg if changing from db join to field we need to remove the join 
		entry from the #__fabrik_joins table 
	 *
	 */
	function beforeSave()
	{
	}
	
	/**
	 * OPTIONAL
	 * If your element risks not to post anything in the form (e.g. check boxes with none checked)
	 * the this function will insert a default value into the database
	 * @param object params
	 * @param array form data
	 * @return array form data
	 */
	
	function getEmptyDataValue($params, $data)
	{
		return $data;	
	}
	
	function getEmailValue( $val )
	{
		return $val;
	}
	
	function isUpload()
	{
		return $this->_is_upload;
	}
	
	/**
	 * can be overwritten in plugin class
	 * If a database join element's value field points to the same db field as this element
	 * then this element can, within modifyJoinQuery, update the query.
	 * E.g. if the database join element points to a file upload element then you can replace
	 * the file path that is the standard $val with the html to create the image
	 *
	 * @param string $val
	 * @param string view form or table
	 * @return string modified val
	 */

	function modifyJoinQuery( $val, $view='form' )
	{
		return $val;
	}
	
	function ajax_loadTableFields( )
	{
		$tableModel =& JModel::getInstance( 'Table', 'FabrikModel' );
		$this->_cnnId 	= JRequest::getInt( 'cid', 0 );
		$tbl 			= "`" . JRequest::getVar( 'table' ) . "`";
		$fieldDropDown 		= $tableModel->getFieldsDropDown( $this->_cnnId, $tbl, '-', false, 'params[join_val_column]' );
		$fieldDropDown2 	= $tableModel->getFieldsDropDown( $this->_cnnId, $tbl, '-', false, 'params[join_key_column]' );
		echo "$('addJoinVal').innerHTML = '$fieldDropDown';";
		echo "$('addJoinKey').innerHTML = '$fieldDropDown2';";
	}
	
	/**
	 * CAN BE OVERWRITTEN IN PLUGIN CLASS
	 * create sql join string to append to table query
	 * @return string join statement 
	 */
	
	function getJoin( $tableName )
	{
		return null;
	}
	
	/**
	 * render the element admin settings
	 * @param object element
	 */

	function renderAdminSettings( )
	{
		$params =& $this->getParams();
		$pluginParams =& $this->getPluginParams();
		$element =& $this->getElement();
		?>
		<div id="page-<?php echo $this->_name;?>" class="elementSettings" style="display:none">
		<?php 
		echo $pluginParams->render( 'details' );
		echo $pluginParams->render( 'params', 'extra' );
		?>
	</div><?php
	}
	
	/**
	 * CAN BE OVERWRITTEN IN PLUGIN CLASS
	 * get js code to insert in edit element page - dont encase in domready code
	 * 
	 */
	
	function getAdminJS()
	{
		
	}
	
	/**
	 * CAN BE OVERWRITTEN IN PLUGIN CLASS
	 * trigger called when a row is deleted, can be used to delete images previously uploaded
	 */

	function onDeleteRows()
	{
		
	}
	
	/**
	 * CAN BE OVERWRITTEN IN PLUGIN CLASS
	 * trigger called when a row is stored
	 * @param array data to store
	 */
	
	function onStoreRow(&$data)
	{
		
	}
	
	/**
	 * CAN BE OVERWRITTEN IN PLUGIN CLASS
	 * 
	 * child classes can then call this function with
	 * return parent::renderTableData($data, $oAllRowsData );
	 * to perform rendering that is applicable to all plugins
	 * 
	 * shows the data formatted for the table view
	 * @param string data
	 * @param object all the data in the tables current row
	 * @return string formatted value
	 */

	function renderTableData( $data, $oAllRowsData )
	{
		$params =& $this->getParams();
		if ($params->get('icon_folder') != -1 && $params->get('icon_folder') != '') {
			return $this->_replaceWithIcons($data);
		}
		return str_replace( $this->_groupSplitter, "<br/>", $data);
	}
	
	function renderTableData_csv( $data, $oAllRowsData )
	{
		return $data;
	}
	
	/**
	 * determines if the element should be shown in the table view
	 *
	 * @param object $tableModel
	 * @return bol 
	 */
	
	function inTableFields( &$tableModel )
	{
		$params =& $this->getParams();
		$element =& $this->getElement();
		$table =& $tableModel->getTable();
		$elFullName = $this->getFullName( true, false, false );
		
		if ($tableModel->_outPutFormat == 'rss') {
			$bAddElement = ( $params->get( 'show_in_rss_feed' ) == '1' );
			/* if its the date ordering col we should add it to the list of allowed elements */
			if ($elFullName == $tableModel->_params->get( 'feed_date', '' )) {
				$bAddElement = true;
			}
		} else {
			$bAddElement = ( $tableModel->_onlyTableData ) ? $element->show_in_table_summary : true;
		}
		if ($table->db_primary_key == $elFullName) {
			$tableModel->_temp_db_key_addded  = true;
		}
		return $bAddElement;
	}
	
	/**
	 * builds some html to allow certain elements to display the option to add in new options
	 * e.g. pciklists, dropdowns radiobuttons
	 *
	 * @param bol if true show one field which is used for both the value and label, otherwise show
	 * separate value and label fields
	 */
	function getAddOptionFields($onlyfield)
	{
		$elementHTMLId_ddVal = $this->_elementHTMLId . "_ddVal";
		$elementHTMLId_ddLabel = $this->_elementHTMLId . "_ddLabel";
		$str = "<br /><div class='addoption'><div>" . JText::_('Add a new option to those above')  .
				"</div><dl>" .
				"<dt>" ;
		if(!$onlyfield){
		$str .= JText::_('value') . "</dt><dd>" .
				"<input class='fabrikinput inputbox text' id='$elementHTMLId_ddVal' name='addPicklistValue' /></dd>" .
				"<dt>" ;
		}
		$str .= 
		JText::_('label') . "</dt>" .
				"<dd><input class='fabrikinput inputbox text' id='$elementHTMLId_ddLabel' name='addPicklistLabel' /></dd>" .
				"</dl>
				<input class='button' type='button' id='" . $this->_elementHTMLId . "_dd_add_entry' value='" . JText::_('Add') . "' / ></div>
";
		$str .=  $this->getHiddenField( $this->_elementHTMLId . "_additions", '', $this->_elementHTMLId . "_additions" );
		return $str;
	}
}
?>