<?php
/**
 * Category Management Library for JEvents Component
 *
 * @version     $Id: categoryController.php 952 2008-02-13 20:24:42Z tstahl $
 * @package     Events
 * @copyright   Copyright (C) 2006-2007 JEvents Project Group
 * @copyright   Copyright (C) 2000 - 2003 Eric Lamette, Dave McDonnell
 * @licence     http://www.gnu.org/copyleft/gpl.html
 * @link        http://joomlacode.org/gf/project/jevents
 */

defined( '_JEXEC' ) or die( 'Restricted access' );

include_once(dirname(__FILE__)."/categoryClass.php");
include_once(dirname(__FILE__)."/categoryHTML.php");

class CategoryController {

	var $component = null;
	var $categoryTable = null;
	var $categoryClassname = null;
	var	$categoryExtrasTable = null;
	var	$categoryExtrasClassname = null;

	/**
	 * constructor
	 */
	function CategoryController(){
		$cfg = & EventsConfig::getInstance();
		$jev_component_name  = $cfg->get("com_componentname", "com_events");
		$this->component = 	$jev_component_name;
		$this->categoryTable = "#__categories";
		$this->categoryClassname = "JEventsCategory";
		$this->categoryExtrasTable = "#__events_categories";
		$this->categoryExtrasClassname = "JEventsCategoryExtras";
	}

	/**
	 * Category Management code
	 *
	 * Author: Geraint Edwards
	 */
	/**
	 * Manage categories - show lists
	 *
	 */
	function categories(){
		global  $mainframe;
		$cfg = & EventsConfig::getInstance();
		$jev_component_name  = $cfg->get("com_componentname", "com_events");
		$db	=& JFactory::getDBO();
		$user =& JFactory::getUser();

		if (strtolower($user->usertype)!="super administrator"){
			global $mainframe;
			$mainframe->redirect( "index2.php?option=$this->component&task=cpanel", "Not Authorised - must be super admin" );
		}

		$limit		= intval( $mainframe->getUserStateFromRequest( "cat_listlimit", 'limit', 10 ));
		$limitstart = intval( $mainframe->getUserStateFromRequest( "cat_{$this->component}limitstart", 'limitstart', 0 ));

		// get the total number of records
		$query = "SELECT count(*) FROM $this->categoryTable"
		. "\n WHERE section='$jev_component_name'"	;
		$db->setQuery( $query);
		$total = $db->loadResult();
		echo $db->getErrorMsg();
		if( $limit > $total ) {
			$limitstart = 0;
		}

		$db	=& JFactory::getDBO();

		$sql = "SELECT c.* , e.color, g.name AS _groupname FROM $this->categoryTable as c"
		. "\n LEFT JOIN #__groups AS g ON g.id = c.access"
		. "\n LEFT JOIN $this->categoryExtrasTable as e ON e.id = c.id"
		. "\n WHERE section='$jev_component_name'"
		. "\n ORDER BY ordering ";
		if ($limit>0){
			$sql .= "\n LIMIT $limitstart, $limit";
		}

		$db->setQuery($sql);
		$rows = $db->loadObjectList();
		$cats = array();
		foreach ($rows as $row) {
			$cat = new $this->categoryClassname($db,$this->categoryTable);
			$cat->bind(get_object_vars($row));
			// extra field
			$cat->_groupname = $row->_groupname;
			$cats[$cat->id]=$cat;
		}


		include_once( 'includes/pageNavigation.php' );
		$pageNav = new JPagination( $total, $limitstart, $limit  );

		HTML_events_admin::showCategories($cats, $pageNav, $this->component);
	}

	/**
	 * Category Editing code
	 *
	 * Author: Geraint Edwards
	 * Copyright: 2007 Geraint Edwards
	 * 
	 */
	function editCategory($cid){
$cfg = & EventsConfig::getInstance();
$jev_component_name  = $cfg->get("com_componentname", "com_events");
		$user =& JFactory::getUser();

		if (strtolower($user->usertype)!="super administrator"){
			global $mainframe;
			$mainframe->redirect( "index2.php?option=$this->component&task=categories", "Not Authorised - must be super admin" );
		}

		$db	=& JFactory::getDBO();

		if (count($cid)<=0){
			global $mainframe;
			$mainframe->redirect( "index2.php?option=$this->component&task=categories", "Invalid Category Selection" );
		}
		else {
			$cid=$cid[0];
		}
		$cat = new $this->categoryClassname($db,$this->categoryTable);
		$cat->load($cid);

		// get categories for parent info
		$sql = "SELECT c.*, e.color  FROM $this->categoryTable as c "
		."\n LEFT JOIN $this->categoryExtrasTable as e ON c.id=e.id"
		."\n WHERE section='$jev_component_name' AND c.id<>$cid"
		."\n ORDER BY ordering"
		;
		$db->setQuery($sql);
		$rows = $db->loadObjectList();
		$cats = array();
		// empty row
		$emptycat = new $this->categoryClassname($db,$this->categoryTable);
		$emptycat->title=_CAL_CATEGORY_PARENT_NONE;
		$cats[0]=$emptycat;

		foreach ($rows as $row) {
			$tempcat = new $this->categoryClassname($db,$this->categoryTable);
			$tempcat->bind(get_object_vars($row));
			$cats[]=$tempcat;

		}
		$plist = JHTML::_('select.genericlist', $cats, 'parent_id', 'class="inputbox" size="1"',"id","title",$cat->parent_id);

		// get list of groups
		$query = "SELECT id AS value, name AS text"
		. "\n FROM #__groups"
		. "\n ORDER BY id"
		;
		$db->setQuery( $query );
		$groups = $db->loadObjectList();

		// build the html select list
		$glist = JHTML::_('select.genericlist', $groups, 'access', 'class="inputbox" size="1"',
		'value', 'text', intval( $cat->access ) );

		HTML_events_admin::editCategory($cat,$plist,$glist);
	}

	/**
	 * Category Saving code
	 *
	 * Author: Geraint Edwards
	 * Copyright: 2007 Geraint Edwards
	 * 
	 */
	function saveCategory($cid){
$cfg = & EventsConfig::getInstance();
$jev_component_name  = $cfg->get("com_componentname", "com_events");
		$db	=& JFactory::getDBO();
		$user =& JFactory::getUser();

		if (strtolower($user->usertype)!="super administrator"){
			global $mainframe;
			$mainframe->redirect( "index2.php?option=$this->component&task=cpanel", "Not Authorised - must be super admin" );
		}

		$cat = new $this->categoryClassname($db,$this->categoryTable);
				
		if (!$cat->bind( JRequest::get('request', JREQUEST_ALLOWHTML))) {
			echo "<script> alert('".$cat->getError()."'); window.history.go(-1); </script>\n";
			exit();
		}
		
		if (!$cat->check()) {
			echo "<script> alert('".$cat->getError()."'); window.history.go(-1); </script>\n";
			exit();
		}

		if (!$cat->store()) {
			echo "<script> alert('".$cat->getError()."'); window.history.go(-1); </script>\n";
			exit();
		}
		$cat->checkin();
		$cat->reorder( "section='$cat->section'" );

		global $mainframe;
		$mainframe->redirect( "index2.php?option=$this->component&task=categories", _CAL_LANG_ADMIN_CATSUPDATED);

	}

	/**
	 * Category Ordering code
	 *
	 * Author: Geraint Edwards
	 * Copyright: 2007 Geraint Edwards
	 * 
	 */
	function saveCategoryOrder($cid){
		$user =& JFactory::getUser();
		if (strtolower($user->usertype)!="super administrator"){
			global $mainframe;
			$mainframe->redirect( "index2.php?option=$this->component&task=cpanel", "Not Authorised - must be super admin" );
		}
		$db	=& JFactory::getDBO();
		$order	= JRequest::getVar(		'order', 		array(0) );
		if (count($order)!=count($cid)){
			global $mainframe;
			$mainframe->redirect( "index2.php?option=$this->component&task=cpanel", "Category order problems" );
		}
		for ($k=0;$k<count($cid);$k++){
			$cat = new $this->categoryClassname($db,$this->categoryTable);
			$cat->load($cid[$k]);
			$cat->ordering = $order[$k];
			$cat->store();
		}
		global $mainframe;
		$mainframe->redirect( "index2.php?option=$this->component&task=categories", _CAL_LANG_ADMIN_CATSUPDATED);
	}

	/**
	 * Category Deletion code
	 *
	 * Author: Geraint Edwards
	 * Copyright: 2007 Geraint Edwards
	 * 
	 */	
	function deleteCategory($cid){
		$user =& JFactory::getUser();
		if (strtolower($user->usertype)!="super administrator"){
			global $mainframe;
			$mainframe->redirect( "index2.php?option=$this->component&task=cpanel", "Not Authorised - must be super admin" );
		}

		// REMEMBER TO CLEAN OUT THE MAPPING TOO!!
		$db	=& JFactory::getDBO();

		$catids = EventsHelper::forceIntegerArray($cid,true);
		if (strlen($catids)==""){
			global $mainframe;
			$mainframe->redirect( "index2.php?option=$this->component&task=cpanel", "Bad categories" );
		}

		$query = "DELETE FROM $this->categoryExtrasTable WHERE id in ($catids)";
		$db->setQuery( $query );
		$db->query();

		$query = "DELETE FROM $this->categoryTable WHERE id in ($catids)";
		$db->setQuery( $query );
		$db->query();

		global $mainframe;
		$mainframe->redirect( "index2.php?option=$this->component&task=categories", "Category(s) deleted" );
	}


	function toggleCatPublish($cid,$newstate){
		$user =& JFactory::getUser();
		if (strtolower($user->usertype)!="super administrator"){
			global $mainframe;
			$mainframe->redirect( "index2.php?option=$this->component&task=cpanel", "Not Authorised - must be super admin" );
		}
		$db	=& JFactory::getDBO();

		foreach ($cid as $kid) {
			if ($kid>0){
				$cat = new $this->categoryClassname($db,$this->categoryTable);
				$cat->load($kid);
				$cat->published = $newstate;
				$cat->store();
			}
		}
		global $mainframe;
		$mainframe->redirect( "index2.php?option=$this->component&task=categories", _CAL_LANG_ADMIN_CATSUPDATED);

	}

}
?>
