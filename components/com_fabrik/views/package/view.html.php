<?php

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

jimport('joomla.application.component.view');

class fabrikViewPackage extends JView
{
	
	var $_template 	= null;
	var $_errors 	= null;
	var $_data 		= null;
	var $_rowId 	= null;
	var $_params 	= null;
	
	/** @var object table view */
	var $_tableView = null;
	
	/** @var object form view */
	var $_formView = null;
	
	var $_id;
	
	function fabrikViewPackage( &$oForm )
	{
		$this->_oForm = $oForm;
	}
	
	
	function display( $tpl = null )
	{
		global $_MAMBOTS;
		$config		=& JFactory::getConfig();
		$user 		=& JFactory::getUser();
		$model		= &$this->getModel();
		
		$formModel =& $this->_formView->getModel();
		
		//Get the active menu item
		$usersConfig = &JComponentHelper::getParams( 'com_fabrik' );
	
		$model->setId( $usersConfig->get('packageid', JRequest::getInt('packageid', 0)) );
		$package		=& $model->getPackage();
		
		$model->_lastTask 		= JRequest::getVar( 'task', '' );	
		$model->_senderBlock 	= JRequest::getVar( '_senderBlock', '' );	
		//@TODO: not sure if this is used?
		$model->_lastTaskStatus 	= JRequest::getVar( 'taskstatus', '' );	
	
		/** @var string any data created by the lasttask - e.g. data to create a new table row with */
		$model->_lastTaskData = JRequest::getVar( 'taskData', '' );
		// TODO: query table/forms to find out which blocks are releated to the block that has updated itself
		$model->_updateBlocks = JRequest::getVar( 'fbUpdateBlocks', array() );
	
		$model->loadTables();
		
		$package =& $model->getPackage();
		
		$usedForms = array();
		
		if ($package->tables != '') {
			$tableids = explode( ",", $package->tables );
			foreach ($tableids as $i) {
				//in PHP5 objects are assigned by reference as default - 
				//cloning object doesnt deep clone other oject references either
				//this copy method might be intensive
				
				$tableView = $this->_tableView->copy();
				$tableView->setId($i);
				$tableModel =& $tableView->getModel();
				$tableModel->setId($i);
				$tableModel->_packageId = $this->_id;
				$tableModel->_postMethod = 'ajax';
				$table =& $tableModel->getTable();
				$this->blocks[$table->label] = $tableView;
				
				$table = $tableModel->getTable();
				$formModel =& $tableModel->getForm();
				
				$formModel->editable = 1;
				$formView = $this->_formView->copy();
				$formView->setId( $table->form_id );
				$formModel->_postMethod = 'ajax';
				$formModel->_packageId = $this->_id;
				$usedForms[] = $formModel->_id;
				$formView->setModel($formModel, true);
				$this->blocks['form_' .$formModel->_id] = $formView;
			}
		}
		$model->render();
		
		$this->_basePath = COM_FABRIK_FRONTEND . DS . 'views' ;
		$tmpl = JRequest::getVar( 'layout', 'default' );
		//$this->blocks = $model->_blocks;
		$this->_setPath('template', $this->_basePath.DS.'package'.DS.'tmpl'.DS.$tmpl);
		
		$tmpl = JRequest::getVar( 'layout', $package->template );
		
		$this->_includeCSS( $tmpl );
		$this->_basePath = COM_FABRIK_FRONTEND . DS . 'views' ;
		$this->_setPath( 'template', $this->_basePath.DS.'package'.DS.'tmpl'.DS.$tmpl );
		$liveTmplPath = JURI::root() . '/components/com_fabrik/views/package/tmpl/' . $tmpl . '/' ;
		FabrikHelperHTML::mootools();
		FabrikHelperHTML::script( 'mocha.js', 'components/com_fabrik/libs/', true );
		parent::display( );
	}
		
	/**
	 * include the template.css file
	 * @param string template name
	 */

	function _includeCSS( $tmpl )
	{
		$ab_css_file = COM_FABRIK_FRONTEND.DS."views".DS."package".DS."tmpl".DS.$tmpl.DS."template.css";
		if (file_exists( $ab_css_file ))
		{
			JHTML::stylesheet( 'template.css', 'components/com_fabrik/views/package/tmpl/'.$tmpl.'/', true );
		}
	}	

}
?>