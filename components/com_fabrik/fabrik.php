<?php
/**
* @package Joomla
* @subpackage Fabrik
* @copyright Copyright (C) 2005 Rob Clayburn. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport( 'joomla.application.component.helper' );

define( "COM_FABRIK_BASE",  JPATH_BASE );
define( "COM_FABRIK_FRONTEND",  JPATH_BASE.DS.'components'.DS.'com_fabrik' );
define( "COM_FABRIK_LIVESITE",  JURI::base() );

/** php 4.? compat */ 
if ( !function_exists('htmlspecialchars_decode') )
{
	function htmlspecialchars_decode($text)
    {
        return strtr($text, array_flip(get_html_translation_table(HTML_SPECIALCHARS)));
    }
    
		if(! function_exists('str_split'))
    {
        function str_split($text, $split = 1)
        {
            $array = array();
            for ($i = 0; $i < strlen($text);)
            {
                $array[] = substr($text, $i, $split);
                $i += $split;
            }
            return $array;
        }
    }
}

require_once( JPATH_COMPONENT.DS.'controller.php' );
require_once( JPATH_COMPONENT.DS.'models'.DS.'parent.php' );

JModel::addIncludePath( COM_FABRIK_BASE.DS.'components'.DS.'com_fabrik'.DS.'models' );

// map controller to view - load if exists

if($controller = JRequest::getWord('view')) {
	
	$path = JPATH_COMPONENT.DS.'controllers'.DS.$controller.'.php';
	if (file_exists($path)) {
		require_once $path;
	} else {
		$controller = '';
	}
}


// Create the controller
$classname	= 'FabrikController'.ucfirst($controller);
$controller = new $classname( );

// Perform the Request task

$controller->execute( JRequest::getVar( 'task', null, 'default', 'cmd' ) );

// Redirect if set by the controller
$controller->redirect();

?>