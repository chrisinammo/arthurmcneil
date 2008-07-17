<?php

/**
* @package Joomla
* @subpackage Fabrik
* @copyright Copyright (C) 2005 Rob Clayburn. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

jimport( 'joomla.application.component.model' );

class FabrikModelPlugin extends FabrikModel
{

 	/** @var bol determines if the admin settings are visible or hidden when rendered */
 	var $_adminVisible = false;
 	
 	/** @var string path to xml file **/
 	var $_xmlPath = null;
 	
 	/** @var object params **/
	var $_params  = null;
	
	/** @var string error **/
	var $_err = null;
	
	var $_id = null;
	/**
	 * constructor
	 */

	function __construct()
	{
		parent::__construct();
	}
	
	function setId($id)
	{
		$this->_id = $id;
	}
	
	/**  
	 * sets the instances admin state
	 * @param bol admin state
	 */

	function setAdmin( $admin )
	{
		$this->_admin = $admin;
	}
	
 	/**
 	 * write out the admin form for customising the plugin
 	 *
 	 * @param object $row
 	 */

 	function renderAdminSettings( )
 	{
 		/* can be overwritten by action plugin */
		$params =& $this->getParams();
?>
		<div id="page-<?php echo $this->_name;?>" class="pluginSettings" style="display:none">
			<table>
			<?php echo $params->render();?>
			</table>
		</div><?php
 	}
 	
 	/**
 	 * load params
 	 */

 	function &getParams()
 	{
 		if (is_null( $this->_params )) {
 			return $this->_loadParams();
 		}else{
 			return $this->_params;
 		}
 	}
 	
 	function &_loadParams()
		{
 		if (!isset( $this->_params )) {
 			$this->_params = &new fabrikParams( $this->attribs, $this->_xmlPath, 'component' );
		}
		return $this->_params;
 	}
 	
 	/**
 	 * determine if we use the plugin or not
 	 * both location and event criteria have to be match 
 	 * @param object calling the plugin table/form
 	 * @param string location to trigger plugin on
 	 * @param string event to trigger plugin on
 	 * @return bol true if we should run the plugin otherwise false
 	 */

 	function canUse( &$oRequest, $location, $event )
	{
 		$ok = false;
 		switch($location){
 			case 'front':
 				if(!$oRequest->_admin){
 					$ok = true;
 				}
 				break;
 			case 'back':
 				if($oRequest->_admin){
 					$ok = true;
 				}
 				break;
 			case 'both':
 				$ok = true;
 				break;
 		}
 		if($ok){
	 		switch( $event ){
	 			case 'new':
	 				if( $oRequest->_rowId != 0 ){
	 					$ok = false;
	 				}
	 				break;
	 			case 'edit':
	 				if( $oRequest->_rowId == 0 ){
	 					$ok = false;
	 				}
	 				break;
	 		}
 		}
 		return $ok;
 	}
 	
 	/**
 	 * ajax function to return a string of table drop down options
 	 * based on cid variable in query string
 	 *
 	 */
 	function ajax_tables()
 	{
 		$db =& JFactory::getDBO();
 		$cid = JRequest::getVar( 'cid', -1 );
 		$sql = "SELECT id, label FROM #__fabrik_tables WHERE connection_id = '$cid'";
 		$db->setQuery( $sql );
 		$rows = $db->loadObjectList();
 		$str = '[';
 		foreach ($rows as $row) {
			$str .= "{'value':'$row->id', 'label':'$row->label'},";
 		}
 		$str = rtrim($str, ",") . "]";
 		echo $str;
 	}
 	
 	function ajax_fields()
 	{
 		$tid = JRequest::getVar( 't' );
 		$keyType = JRequest::getVar('k', 1);
 		//1 = $element->id;
		//2 = tablename___elementname
 		$model =& JModel::getInstance( 'Table', 'FabrikModel' );
 		$model->setId( $tid );
 		$table =& $model->getTable();
		$groups = $model->getFormGroupElementData( true, true );
		$str = '[';
		foreach($groups as $g=>$val){
			$elements = $groups[$g]->_aElements;
			foreach($elements as $e => $eVal){
				$elementModel = $elements[$e];
				$element =& $elementModel->getElement();
				if ($keyType == 1) {
					$v = $element->id;
				}else{
					$v = $table->db_table_name . "___" . $element->name;
				}
				$str .= "{'value':'$v', 'label':'$element->label'},";
			}
		}
		$str = rtrim($str, ",") . "]";
 		echo $str;
 	}
}	
?>