<?php
/**
 * Keywords Library for Joomla 1.0.x
 *
 * @version     $Id: categoryClass.php 912 2007-12-21 11:19:31Z geraint $
 * @package     Events
 * @copyright   Copyright (C) 2007 Geraint Edwards
 * @licence     http://www.gnu.org/copyleft/gpl.html
 */

defined( '_JEXEC' ) or die( 'Restricted access' );

include_once(JPATH_LIBRARIES.DS.'joomla'.DS.'database'.DS.'table'.DS.'category.php');
class JEventsCategory extends JTableCategory {

	var $_catextra			= null;
	// catid is a temporary field to ensure no duplicate mappings are created.
	// this can be removed from database and application after full migration
	var $catid 			= null;

	// security check
	function bind( $array ) {
		$cfg = & EventsConfig::getInstance();
		$jev_component_name  = $cfg->get("com_componentname", "com_events");
		$array['id'] = isset($array['id']) ? intval($array['id']) : 0;
		parent::bind($array);
		if (!isset($this->_catextra)){
			$this->_catextra = new CatExtra($this->_db);
		}
		$this->_catextra->color = array_key_exists("color",$array)?$array['color']:"#000000";
		if(!preg_match("/^#[0-9a-f]+$/i", $this->_catextra->color)) $this->_catextra->color= "#000000";
		unset($this->color);

		// Fill in the gaps
		$this->name=$this->title;
		$this->section=$jev_component_name;
		$this->image_position="left";
		
		
		
		return true;		
	}

	function load($oid=null){
		parent::load($oid);
		if (!isset($this->_catextra)){
			$this->_catextra = new CatExtra($this->_db);
		}
		if ($this->id>0){
			$this->_catextra->load($this->id);
		}
	}

	function store(){
		parent::store();
		if (isset($this->_catextra)){
			$this->_catextra->id = $this->id;
			$this->_catextra->store();			
		}
		return true;
	}
	
	function getColor(){
		if (isset($this->_catextra)){
			return $this->_catextra->color;
		}		
		else return "#000000";
	}

}

class CatExtra extends JTable {
	var $id 			= null;
	var $color			= null;

	/**
	 * consturcotr
	 *
	 * @param string $db database reference
	 * @param string $tablename (including #__)
	 * @return gKwdMap
	 */
	function CatExtra( &$db ) {
		parent::__construct( '#__events_categories', "id", $db );
	}

	function store(){
		$this->_db->setQuery( "REPLACE #__events_categories SET id='$this->id', color='$this->color'" );
		$this->_db->query();
	}

}


?>
