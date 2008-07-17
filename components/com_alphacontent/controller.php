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

jimport('joomla.application.component.controller');

/**
 * @package AlphaContent
 */
class alphacontentController extends JController
{
	var $options = null;

	/**
	 * Custom Constructor
	 */
 	function __construct()	{
		parent::__construct( );
	}	
	
	function showdirectory() {
	
		global $options;
	
		$options['letter']		= JRequest::getVar ( 'letter', '', 'default', 'string'	 );
		$options['section']  	= JRequest::getVar ( 'section', '', 'default', 'string'	 );
		$options['category']	= JRequest::getVar ( 'category', '', 'default', 'int' 	 );
		$options['ordering']	= JRequest::getVar ( 'ordering', '', 'default', 'int' 	 );
		$options['search']		= JRequest::getVar ( 'search', '', 'POST', 'string'   	 );
		$options['search']		= JString::strtolower( $options['search']                );
		$options['searchfield']	= JRequest::getVar ( 'searchfield', '', 'POST', 'string' );
		$options['tag']			= JRequest::getVar ( 'tag', '', 'GET', 'string'          );
		$options['total']		= 0;
	
		$model        = &$this->getModel ( 'alphacontent' );
		$modelListing = &$this->getModel ( 'listing' );
		$view         = $this->getView  ( 'alphacontent','html' );
		
		// load params
		$params = $model->_setDirectoryParams();
		
		$options['limitstart'] = JRequest::getVar ( 'limitstart', 0, 'default', 'int' );
		$options['limit']      = JRequest::getVar ( 'limit', $params->get('list_resultperpage'), 'default', 'int'  );

		// load Directory structure
		$_directory = $model->_load_alphacontent ( $options, $params );		
		
		// load alphabetical bar
		$_alphabetical_bar = $model->_load_alphabetical_bar ( $params );		
		
		// Assign vars to tmpl
		$view->assign('directory', $_directory[0] );
		$view->assign('params', $params );
		$view->assign('currentselection', $_directory[1] );
		$view->assign('alphabeticalbar', $_alphabetical_bar );
		
		// load listing if exist
		$_listing = $modelListing->_load_listing ( $options, $params );
		$view->assign('listing', $_listing );
		
		// Display
		$view->_display();		
	}
	
	function viewmap() {		
		global $mainframe;
	
		$model        = &$this->getModel ( 'alphacontent' );
		$view         = $this->getView  ( 'alphacontent','html' );
		// load params
		$params = $model->_setDirectoryParams();
		$view->_viewmap( $params );
	}
	
	function showRSS() {
		global $mainframe;

		$options['s']  	= JRequest::getVar ( 's', '', 'default', 'int'	 );
		$options['c']	= JRequest::getVar ( 'c', '', 'default', 'int' 	 );
		$options['m']	= JRequest::getVar ( 'm', '', 'default', 'int' 	 );
		
		$model        = &$this->getModel ( 'alphacontent' );
		$modelListing = &$this->getModel ( 'listing' );
		
		$view         = $this->getView  ( 'alphacontent','html' );
		// load params
		$params = $model->_setDirectoryParams();
		$rows = $modelListing->_getRSS( $options, $params );
		
		$view->assign('rows', $rows );
		$view->assign('menuid', $options['m'] );
		
		$view->_showrss();
	}
}
?>