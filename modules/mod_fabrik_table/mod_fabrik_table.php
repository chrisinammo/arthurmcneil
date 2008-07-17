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
require_once('components/com_fabrik/views/table/view.html.php');
require_once('components/com_fabrik/models/parent.php');
JModel::addIncludePath( COM_FABRIK_BASE.DS.'components'.DS.'com_fabrik'.DS.'models' );

$tableId				= intval( $params->get( 'table_id', 1 ) );
$moduleclass_sfx 	= $params->get( 'moduleclass_sfx', '' );

$document =& JFactory::getDocument();
$viewName = 'table';
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
$view->setId( $tableId );
echo $view->display();
?>