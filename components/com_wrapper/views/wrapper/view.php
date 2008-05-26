<?php
/**
* @version		$Id: view.php 10094 2008-03-02 04:35:10Z instance $
* @package		Joomla
* @subpackage	Wrapper
* @copyright	Copyright (C) 2005 - 2008 Open Source Matters. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* Joomla! is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/

// Check to ensure this file is included in Joomla!
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view');

/**
* @package		Joomla
* @subpackage	Wrapper
*/
class WrapperViewWrapper extends JView
{
	function display( $tpl = null )
	{
		// auto height control
		if ( $this->params->def( 'height_auto' ) ) {
			$this->wrapper->load = 'onload="iFrameHeight()"';
		} else {
			$this->wrapper->load = '';
		}

		parent::display($tpl);
	}
}
?>