<?php
/*
 * @package Joomla 1.5
 * @copyright Copyright (C) 2005 Open Source Matters. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 *
 * @component AlphaContent
 * @copyright Copyright (C) 2008 Bernard Gilly
 * @license : DonationWare
 * @Website : http://www.alphaplug.com
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport( 'joomla.application.component.controller' );

/**
 * @package AlphaContent
 */
class configurationController extends JController
{
	/**
	 * Custom Constructor
	 */
 	function __construct()	{
		parent::__construct( );
	}	

	
	/**
	* Show/Edit Configuration
	*/
	function edit() {

		$model = $this->getModel('alphacontent');
		$view  = $this->getView ( 'alphacontent','html');
		$model->_set_configuration ();

		$view->assignRef('alphacontent_configuration', $model->_configuration);

		$view->edit();
	}

	/**
	* Save the configuration file
	*/
	function save() {		
		// get the model
		$model = $this->getModel('alphacontent');
		if ( $model->_save_configuration() ) {
			$this->setRedirect('index.php?option=com_alphacontent', JTEXT::_('AC_CONFIGURATION_SAVED'));
		} else {
			$this->setRedirect('index.php?option=com_alphacontent', JTEXT::_('AC_CONFIGURATION_ERROR'));
		}
	}

}

?>