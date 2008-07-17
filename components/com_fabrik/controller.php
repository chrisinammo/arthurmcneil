<?php

/**
* @package Joomla
* @subpackage Fabrik
* @copyright Copyright (C) 2005 Rob Clayburn. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

jimport( 'joomla.application.component.controller' );

require_once(COM_FABRIK_FRONTEND.DS.'helpers'.DS.'params.php');
require_once(COM_FABRIK_FRONTEND.DS.'helpers'.DS.'string.php');
require_once( COM_FABRIK_FRONTEND.DS.'helpers'.DS.'html.php' );

/**
 * Contact Component Controller
 *
 * @static
 * @package		Joomla
 * @subpackage	Contact
 * @since 1.5
 */
class FabrikController extends JController
{
	/**
	 * Display the view
	 */
	function display()
	{
		//menu links use fabriklayout parameters rather than layout
		$flayout = JRequest::getVar( 'fabriklayout' );
		if ($flayout != '') {
			JRequest::setVar( 'layout', $flayout );
		}
		
		$document =& JFactory::getDocument();
		$viewName	= JRequest::getVar( 'view', 'form', 'default', 'cmd' );
		if ($viewName == 'details') {
			$viewName = 'form';
		}
		
		$viewType	= $document->getType();

		// Set the default view name from the Request
		$view = &$this->getView( $viewName, $viewType );
		
		// Push a model into the view
		$model	= &$this->getModel( $viewName );
		$model->_postMethod = JRequest::getVar( '_postMethod', 'post' );
		if (!JError::isError( $model )) {
			$model->setAdmin( false );
			$view->setModel( $model, true );
		}

		// Display the view
		$view->assign( 'error', $this->getError() );
		$view->display();
	}
	
	/**
	 * save a form's page to the session table
	 */
	function savepage()
	{
		//$viewName	= JRequest::getVar('view', 'form', 'default', 'cmd');
		$model		=& $this->getModel( 'Formsession' );
		$model->savePage();
		exit;
	}
	/**
	 * process the form
	 */

	function processForm()
	{
		
		global $mainframe;
		@set_time_limit(300);
		$document =& JFactory::getDocument();
		$viewName	= JRequest::getVar('view', 'form', 'default', 'cmd');
		$viewType	= $document->getType();
		$view = &$this->getView( $viewName, $viewType );
		$model	= &$this->getModel( $viewName );
		
		if (!JError::isError( $model )) {
			$view->setModel( $model, true );
		}
		$model->_postMethod = JRequest::getVar( '_postMethod', 'post' );
		$model->setId( JRequest::getInt( 'form_id', 0 ) );
		
		
		$model->getForm();
		$model->_rowId = JRequest::getVar( 'rowid', '' );
		$model->setAdmin( false );
		// Check for request forgeries
		JRequest::checkToken() or die( 'Invalid Token' );
		if (JRequest::getVar('fabrik_ignorevalidation', 0) != 1){ //put in when saving page of form
			if ( !$model->validate( )) {
				$view->display();
				return;
			}
		}
		
		$defaultAction = $model->process( );
		//one of the plugins returned false stopping the default redirect 
		// action from taking place
		//echo JRequest::getVar( 'format' );exit;
		if (!$defaultAction) {
			return;
		}
		$tableModel				=& $model->getTableModel();
		$tableModel->_table = null;
	
		
		if (JRequest::getVar( 'format' ) == 'raw') {
			JRequest::setVar( 'view', 'table' );
			$this->display();
			return;
		} else {
			
			if ($this->_admin) {
				if ($return == 1) {
					$page = "index.php?option=com_fabrik&task=showForm&cid=$cid&tableid=".$model->_table->id."&rowid=";
				} else {
					$page = "index.php?option=com_fabrik&c=table&task=viewTable&cid[]=".$model->_table->id;
				}
				$mainframe->redirect( $page, JText::_('Record added') );			
			} else {
				$ref = JRequest::getVar( 'fabrik_referrer', "index.php", 'post' );
				global $Itemid;
				if ($ref == '') {
					$ref = "index.php?option=com_fabrik&Itemid=$Itemid";
				}
				$mainframe->redirect( JRoute::_($ref), JText::_( 'record added/updated' ) );
				
				//@TODO: move the facebook redirect into a form processor plugin
				/*if (JRequest::getVar( 'format' ) == 'facebook') {
					require_once  'components/com_fabrik/libs/facebook-client/facebook.php';
					$appapikey = 'xxxxxx';
					$appsecret = 'xxxxxx';
					$facebook = new Facebook( $appapikey, $appsecret );
					$facebook->redirect($ref);
				} else {
					$mainframe->redirect( JRoute::_($ref), JText::_( 'record added/updated' ) );
				}*/
			}
		}
	}
	
	function doempty()
	{
		$model	= &$this->getModel( 'table' );
		$model->truncate();
		$this->display();
	}

	/**
	 * import data into table model
	 */

	function doimport()
	{
		$viewName	= JRequest::getVar('view', 'form', 'default', 'cmd');
		$model	= &$this->getModel( $viewName );
		$tableModel				=& $this->getModel( 'Table');
		$tableModel->importCSV();
	}
	
	/**
	 * delete row from table
	 */

	function delete()
	{
		// Check for request forgeries
		JRequest::checkToken() or die( 'Invalid Token' );
		global $mainframe;
		$model =& JModel::getInstance( 'Table', 'FabrikModel' );
		$ids = JRequest::getVar('ids', array(), 'request', 'array');
		$model->deleteTableRows( $ids );
		//$_inPackage =  JRequest::getBool('_inPackage', false);
		if ( JRequest::getVar('format') == 'raw') {
			JRequest::setVar( 'view', 'table' );
			$this->display();
		} else {
			
			//@TODO: test this
			$ref = JRequest::getVar( 'fabrik_referrer', "index.php", 'post' );
			$mainframe->redirect( $ref, JText::_( 'Records deleted' ) );
		}
	}
	
	/**
	 * ajax action called from element
	 */

	function elementPluginAjax()
	{
		$formid = JRequest::getInt( 'formid', 0 );
		$plugin = JRequest::getVar( 'plugin', '' );
		$method = JRequest::getVar( 'method', '' );
		$id = JRequest::getInt( 'element_id', 0 );
		$group = JRequest::getVar( 'g', 'element' );
		$pluginManager =& JModel::getInstance( 'Pluginmanager', 'FabrikModel' );
		$model =& $pluginManager->loadPlugIn( $plugin, $group );
		$model->setId( $id );
		//$element =& $model->getElement(); //can now be a vis as well - so put getElement inside element plugin methods
		$model->_formId = $formid;
		if (method_exists( $model, $method )) {
			$model->$method();
		} else {
			echo "alert('method doesnt exist');\n";
		}
	}
	
	/**
	 * validate via ajax
	 *
	 */
	
	function ajax_validate()
	{
		$elementName = JRequest::getVar( 'element_name' );
		$model	= &$this->getModel( 'form' );
		$model->setId( JRequest::getInt( 'form_id', 0 ) );
		$model->getForm();
		$model->_rowId = JRequest::getVar( 'rowid', '' );
		$model->validate();
		if (array_key_exists( $elementName, $model->_arErrors )) {
			echo FastJSON::encode($model->_arErrors[$elementName]);
		} else {
			//validating entire group when navigating form pages 
			echo FastJSON::encode($model->_arErrors);
			//echo "[]";
		}
	}
	
	function xmlTest()
	{
		$rs="http://www.intrade.com/jsp/XML/MarketData/ContractBookXML.jsp?";
		$qs="";
		$parray=array('id'=>"483466",'conID'=> "483466",'timestamp'=>0);
		foreach($parray as $par=>$value){ 
		$qs=$qs."$par=".urlencode($value)."&";}
		$uri="$rs?$qs";
		
		
		
		$cobj=curl_init($uri);
		curl_setopt($cobj,CURLOPT_RETURNTRANSFER,1);
		$xml=curl_exec($cobj);
		curl_close($cobj);
		echo $xml;
		
		$xmlDoc = & JFactory::getXMLParser();
		$xmlDoc->resolveErrors(true);
		$xmlDoc->parseXML($xml);
	}
}
?>