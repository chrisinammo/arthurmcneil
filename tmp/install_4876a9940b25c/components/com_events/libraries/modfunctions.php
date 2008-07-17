<?php
/**
 * Events Component for Joomla 1.0.x
 *
 * @version     $Id: modfunctions.php 837 2007-07-11 18:01:55Z tstahl $
 * @package     Events
 * @copyright   Copyright (C) 2006-2007 JEvents Project Group
 * @licence     http://www.gnu.org/copyleft/gpl.html
 * @link        http://joomlacode.org/gf/project/jevents
 */

// no direct access
defined( '_VALID_MOS' ) or die( 'Restricted access' );

// functions used by the modules


function findAppropriateMenuID (&$catidsOut, &$modcatids, &$catidList, $modparams){
	// Itemid, search for menuid with lowest access rights
	global $my, $database;

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
				. "\n AND access <= $my->gid"
				. "\n ORDER BY access ASC";
	
			$database->setQuery($query);
			$instances_byid[$id] = $database->loadObjectList();
		}

		// use result by reference
		$rows = & $instances_byid[$id];
	}
	else {
		// query database only once
		if (!$instance) {
			$query = "SELECT id, params"
			. "\n FROM #__menu WHERE"
			. "\n link = 'index.php?option=com_events'"
			. "\n AND published = 1"
			. "\n AND access <= $my->gid"
			. "\n ORDER BY access ASC";

			$database->setQuery($query);
			$instance = $database->loadObjectList();

		}

		// use result by reference
		$rows = & $instance;
	}

	// make sure we have a valid value otherwise use current Itemid
	if (count($rows)>0)	$myItemid = intval( $rows[0]->id );
	else {
		global $Itemid;
		$myItemid = $Itemid;
	}

	//**************************************************
	// New test version with catids finds the first enclosing set if it exists !
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
	$catidsOut = str_replace(",","|",$catidList);

/* use same result from query above [tstahl]
	$query = "SELECT id, params"
	. "\n FROM #__menu WHERE"
	. "\n link = 'index.php?option=com_events'"
	. "\n AND published = 1"
	. "\n AND access <= $my->gid"
	. "\n ORDER BY access ASC";
	$database->setQuery($query);
	$idParams = $database->loadObjectList("");
*/
	foreach ($rows as $testparms) {
		$test = new mosParameters( $testparms->params);
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
			global $myItemid;
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
