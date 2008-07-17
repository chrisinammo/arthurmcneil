<?php
/**
* @package Joomla
* @subpackage Fabrik
* @copyright Copyright (C) 2005 Rob Clayburn. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

jimport('joomla.application.component.view');

require_once(COM_FABRIK_FRONTEND.DS.'helpers'.DS.'json.php');

class fabrikViewForm extends JView
{
	
	var $_template 	= null;
	var $_errors 	= null;
	var $_data 		= null;
	var $_rowId 	= null;
	var $_params 	= null;

	var $_id 			= null;
	
	function setId($id)
	{
		$this->_id = $id;
	}
	
	function _getGroupProperties( &$groupModel )
	{
		$group 			= new stdClass(  );
		$model		= &$this->getModel();
		$groupTable 	=& $groupModel->getGroup();
		$groupParams 	=& $groupModel->getParams();
		$group->canRepeat = $groupParams->get( 'repeat_group_button', '0' );
		$addJs 			= str_replace( '"', "'",  $groupParams->get( 'repeat_group_js_add' ) );
		$group->addJs 	= str_replace( array("\n", "\r"), "",  $addJs );
		$delJs 			= str_replace('"', "'",  $groupParams->get( 'repeat_group_js_delete' ) );
		$group->delJs 	= str_replace( array("\n", "\r"), "",  $delJs );
		$showGroup 		= $groupParams->def( 'repeat_group_show_first', '1' );
		if ($showGroup == 0) {
			$groupTable->css .= ";display:none;";
		}
		$rubbish = array ("<br />", "<br>");
		$group->css 	= trim( str_replace( $rubbish, "", $groupTable->css ) );
		$group->id 		= $groupTable->id;
		$group->title 	= $groupTable->label;
		$group->name	= $groupTable->name;
		if ($groupModel->canRepeat() && $model->_editable) {
			$group->delId =   "delGroup_" . $groupTable->id ;
			$group->addId = "addGroup_" . $groupTable->id;
			$group->displaystate = '1';
		} else {
			$group->delId = '';
			$group->addId = '';
			$group->displaystate = '0';
		}
		return $group;
	}
	
	function display()
	{
		$JSONarray = array();
	//print_r($_REQUEST);exit;
		//add in pk
		$JSONarray['rowid'] = JRequest::getInt( 'rowid' );
		$model		= &$this->getModel();
		$model->setId( JRequest::getInt('fabrik'));
		
		$model->render();
		//@TODO group repeasts
		foreach ($model->_groups as $groupModel) {
			$groupTable =& $groupModel->getGroup();
			if ($groupTable->state != 0) {
				$group = $this->_getGroupProperties( $groupModel );
				foreach ($groupModel->_aElements as $elementModel) {
					$id = $elementModel->getHTMLId( );
					$value = $elementModel->getDefaultValue( $model->_data, true, 0 );
					$JSONarray[$id] =$value;
				}
			}
		}
		
		$data = array( 'test'=>'2', "id"=>$model->_id, 'model'=>'table', "errors"=> $model->_arErrors, "data" => $JSONarray, 'post'=>$_REQUEST );
		echo FastJSON::encode( $data );	 
	}
	
}
?>