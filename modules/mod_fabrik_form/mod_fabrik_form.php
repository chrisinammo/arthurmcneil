<?php
/**
* @version 
* @package Joomla
* @subpackage Fabrik
* @copyright Copyright (C) 2005 Rob Clayburn. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
if (!defined('COM_FABRIK_BASE')) {
	define( "COM_FABRIK_BASE",  JPATH_BASE );
	define( "COM_FABRIK_FRONTEND",  JPATH_BASE.DS.'components'.DS.'com_fabrik' );
	define( "COM_FABRIK_LIVESITE",  JURI::base() );
}
require_once('components/com_fabrik/controller.php');
require_once('components/com_fabrik/views/form/view.html.php');
require_once('components/com_fabrik/models/parent.php');
JTable::addIncludePath( JPATH_ADMINISTRATOR.DS.'components'.DS.'com_fabrik'.DS.'tables' );
JModel::addIncludePath( COM_FABRIK_BASE.DS.'components'.DS.'com_fabrik'.DS.'models' );

$formId				= intval( $params->get( 'form_id', 1 ) );
$rowid				= intval( $params->get( 'row_id', 0 ) );
$usersConfig 	=& JComponentHelper::getParams( 'com_fabrik' );
$usersConfig->set( 'rowid', $rowid );

$moduleclass_sfx 	= $params->get( 'moduleclass_sfx', '' );

$document =& JFactory::getDocument();
$viewName = 'form';
$viewType	= $document->getType();
$controller = new FabrikController();

// Set the default view name from the Request
$view = &$controller->getView( $viewName, $viewType );

// Push a model into the view
$model	= &$controller->getModel( $viewName );
$model->_postMethod = 'ajax';
if (!JError::isError( $model )) {
	$model->setAdmin( false );
	$view->setModel( $model, true );
}

// Display the view
$view->assign( 'error', $controller->getError() );
$view->setId( $formId );
echo $view->display();
?>