<?php
/**
* @package Joomla
* @subpackage Fabrik
* @copyright Copyright (C) 2005 Rob Clayburn. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/


defined( '_JEXEC' ) or die( 'Restricted access' );

// Set the table directory
JTable::addIncludePath( JPATH_ADMINISTRATOR.DS.'components'.DS.'com_fabrik'.DS.'tables' );

$controllerName = JRequest::getCmd( 'c', 'home' );

define( "COM_FABRIK_BASE", str_replace(DS.'administrator', '', JPATH_BASE) );
define( "COM_FABRIK_FRONTEND", str_replace( DS.'administrator', '', JPATH_BASE).DS.'components'.DS.'com_fabrik' );
define( "COM_FABRIK_LIVESITE", str_replace( 'administrator', '', JURI::base() ) );
//add the helpers directory

require_once(COM_FABRIK_FRONTEND.DS.'helpers'.DS.'params.php');
require_once(COM_FABRIK_FRONTEND.DS.'helpers'.DS.'string.php');
require_once( COM_FABRIK_FRONTEND.DS.'helpers'.DS.'html.php' );


/** php 4.? compat */ 
if ( !function_exists('htmlspecialchars_decode') )
{
	function htmlspecialchars_decode($text)
    {
        return strtr($text, array_flip(get_html_translation_table(HTML_SPECIALCHARS)));
    }
}


$task = JRequest::getCmd('task');

require_once( JPATH_COMPONENT.DS.'controllers'.DS.$controllerName.'.php' );
require_once( COM_FABRIK_FRONTEND.DS.'models'.DS.'parent.php' );

$config = array();
if ($controllerName == 'table' || $controllerName == 'form') {
	$config['view_path'] =  COM_FABRIK_FRONTEND . DS . 'views' ;
}

$controllerName = 'FabrikController'.$controllerName;

// Create the controller
$controller = new $controllerName( $config );

// Perform the Request task
$controller->execute( JRequest::getCmd('task') );

// Redirect if set by the controller
$controller->redirect();

?>