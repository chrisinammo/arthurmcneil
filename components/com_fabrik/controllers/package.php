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

/**
 * Contact Component Controller
 *
 * @static
 * @package		Joomla
 * @subpackage	Contact
 * @since 1.5
 */
class FabrikControllerPackage extends JController
{
	/**
	 * Display the view
	 */
	function display()
	{
		$document =& JFactory::getDocument();

		$viewName	= JRequest::getVar( 'view', 'form', 'default', 'cmd' );
		
		if ($viewName == 'details') {
			$viewName = 'form';
		}
		
		$viewType	= $document->getType();

		// Set the default view name from the Request
		$view = &$this->getView( $viewName, $viewType );
		
		//if the view is a package create and assign the table and form views
		$tableView = &$this->getView( 'Table', $viewType );
		$tableModel =& $this->getModel( 'Table' );
		$tableView->setModel( $tableModel, true );
		$view->_tableView =& $tableView;
		
		$view->_formView = &$this->getView( 'Form', $viewType );
		$formModel =& $this->getModel( 'Form' );
		$view->_formView->setModel( $formModel, true );
		
		// Push a model into the view
		$model	= &$this->getModel( $viewName );
		//$model->_inPackage = JRequest::getBool( '_inPackage', true );

		if (!JError::isError( $model )) {
			$model->setAdmin( false );
			$view->setModel( $model, true );
		}
		// Display the view
		$view->assign( 'error', $this->getError() );
		$view->display();
	}
}
?>