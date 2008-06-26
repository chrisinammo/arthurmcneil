<?php
/**
 * Events Component for Joomla 1.5.x
 *
 * @version     $Id: modfunctions.php 911 2007-12-21 11:14:36Z geraint $
 * @package     Events
 * @copyright   Copyright (C) 2006-2007 JEvents Project Group
 * @licence     http://www.gnu.org/copyleft/gpl.html
 * @link        http://joomlacode.org/gf/project/jevents
 */

// functions used by the modules

defined( '_JEXEC' ) or die( 'Restricted access' );

function findAppropriateMenuID (&$catidsOut, &$modcatids, &$catidList, $modparams){
	// Itemid, search for menuid with lowest access rights
	$user =& JFactory::getUser();
	$db	=& JFactory::getDBO();

	static $instance		= null;
	static $instances_byid	= array();

	if (isset($modparams->target_itemid) && $modparams->target_itemid != '' && intval($modparams->target_itemid)>0){
		$id = intval($modparams->target_itemid);

		// query database only once
		if (!isset($instances_byid[$id])) {
			$query = "SELECT id, params"
			. "\n FROM #__menu WHERE"
			. "\n id = $id"
			. "\n AND published = 1"
			. "\n AND access <= $user->gid"
			. "\n ORDER BY access ASC";

			$db->setQuery($query);
			$instances_byid[$id] = $db->loadObjectList();
		}

		// use result by reference
		$rows = & $instances_byid[$id];
	}
	else {
		// query database only once
		if (!$instance) {
			$cfg = & EventsConfig::getInstance();
			$jev_component_name  = $cfg->get("com_componentname");
			
			$query = "SELECT id, params"
			. "\n FROM #__menu WHERE"
			. "\n link LIKE 'index.php?option=$jev_component_name%'"
			. "\n AND published = 1"
			. "\n AND access <= $user->gid"
			. "\n ORDER BY access ASC";

			$db->setQuery($query);
			$instance = $db->loadObjectList();

		}
		// use result by reference
		$rows = & $instance;
	}

	// make sure we have a valid value otherwise use current Itemid
	if (count($rows)>0)	$myItemid = intval( $rows[0]->id );
	else {
		$Itemid = EventsHelper::getItemid();
		$myItemid = $Itemid;
	}

	$catidsIn		= JRequest::getVar(	'catids', 		'NONE' ) ;
	if ($catidsIn == "NONE") {

		//**************************************************
		//Finds the first enclosing setof catids from menu item if it exists !
		//
		// First of all get the module paramaters
		$c=0;
		$modcatids = array();
		$catidList = "";
		for ($c=0;$c<999;$c++){
			$nextCID="catid$c";
			//  stop looking for more catids when you reach the last one!
			if (!isset($modparams->$nextCID)) break;
			if ($modparams->$nextCID>0 && !in_array($modparams->$nextCID,$modcatids)){
				$modcatids[]=$modparams->$nextCID;
				$catidList .= (strlen($catidList)>0?",":"").$modparams->$nextCID;
			}
		}
	}
	else {
		// else use input catids from REQUEST
		$modcatids = explode( '|', $catidsIn );
		$catidList=EventsHelper::forceIntegerArray($modcatids,true);	
	}
	$catidsOut = str_replace(",","|",$catidList);

	// now find an appropriate enclosing set and associated menu item
	foreach ($rows as $testparms) {
		$test = new JParameter( $testparms->params);
		$c=0;
		$catids = array();
		while ($nextCatId = $test->get( "catid$c", null )){
			if (!in_array($nextCatId,$catids)){
				$catids[]=$nextCatId;
			}
			$c++;
		}

		// Now check if its an enclosing set of catids
		if (count($catids)==0) {
		$Itemid = EventsHelper::getItemid();
			$myItemid = intval($testparms->id);
			break;
		}
		else {
			// if  we have no modcatids then the enclosing set MUST be all categories and catids must therefore also be empty!
			if (count($modcatids)>0){
				$enclosed = true;
				foreach ($modcatids as $cid){
					if (!in_array($cid,$catids)) {
						$enclosed = false;
					}
				}
				if ($enclosed) {
					$myItemid = intval($testparms->id);
					break;
				}
			}

		}
	}

	//*******************************************************
	return $myItemid;
}
