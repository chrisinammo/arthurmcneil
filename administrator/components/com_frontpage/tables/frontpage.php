<?php
/**
* @version		$Id: frontpage.php 9764 2007-12-30 07:48:11Z ircmaxell $
* @package		Joomla
* @subpackage	Content
* @copyright	Copyright (C) 2005 - 2008 Open Source Matters. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* Joomla! is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

/**
* @package		Joomla
* @subpackage	Content
*/
class TableFrontPage extends JTable
{
	/** @var int Primary key */
	var $content_id	= null;
	/** @var int */
	var $ordering	= null;

	/**
	* @param database A database connector object
	*/
	function __construct( &$db ) {
		parent::__construct( '#__content_frontpage', 'content_id', $db );
	}
}