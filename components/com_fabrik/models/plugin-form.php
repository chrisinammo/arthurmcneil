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

require_once( COM_FABRIK_FRONTEND.DS.'models'.DS.'plugin.php' );

class FabrikModelFormPlugin extends FabrikModelPlugin
{

	/**
	 * run right at the beginning of the form processing
	 *
	 * @return bol
	 */
	
	function onBeforeProcess()
	{
	 	return true;
	}

	/**
	 * run if form validation fails
	 *
	 * @return bol
	 */
	
	function onError()
	{
	 	
	}

	/**
	 * run before table calculations are applied
	 *
	 * @return bol
	 */
	
	function onBeforeCalculations()
	{
	 	return true;
	}
	
		/**
	 * run right at the end of the form processing
	 * form needs to be set to record in database for this to hook to be called
	 *
	 * @return bol
	 */
	 
	function onAfterProcess()
	{
		return true;
	}
	
	/**
	 * alter the returned plugin manager's result
	 *
	 * @param string $method
	 * @return bol
	 */
	
	function customProcessResult( $method )
	{
		return true;
	}
	 
	/**
	 * get any html that needs to be written into the bottom of the form
	 *
	 * @return string html
	 */
	
 	function getBottomContent()
 	{
 		return "";
 	}
 	
	/**
	 * get any html that needs to be written into the top of the form
	 *
	 * @return string html
	 */
 	
 	function getTopContent()
 	{
 		return "";
 	}
 	
}	
?>