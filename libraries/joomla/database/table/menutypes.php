<?php
/**
 * @version		$Id: menutypes.php 9764 2007-12-30 07:48:11Z ircmaxell $
 * @package		Joomla.Framework
 * @subpackage	Table
 * @copyright	Copyright (C) 2005 - 2008 Open Source Matters. All rights reserved.
 * @license		GNU/GPL, see LICENSE.php
 * Joomla! is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See COPYRIGHT.php for copyright notices and details.
 */

// Check to ensure this file is within the rest of the framework
defined('JPATH_BASE') or die();

/**
 * Menu Types table
 *
 * @package 	Joomla.Framework
 * @subpackage	Table
 * @since		1.5
 */
class JTableMenuTypes extends JTable
{
	/** @var int Primary key */
	var $id					= null;
	/** @var string */
	var $menutype			= null;
	/** @var string */
	var $title				= null;
	/** @var string */
	var $description		= null;

	/**
	 * Constructor
	 *
	 * @access protected
	 * @param database A database connector object
	 */
	function __construct( &$db )
	{
		parent::__construct( '#__menu_types', 'id', $db );
	}

	/**
	 * @return boolean
	 */
	function check()
	{
		if (strstr( $this->menutype, '\'' ))
		{
			$this->setError(JText::_( 'The menu name cannot contain a \'', true ));
			return false;
		}

		// correct spurious data
		if (trim( $this->title) == '') {
			$this->title = $this->menutype;
		}

		$db		=& JFactory::getDBO();

		// check for unique menutype for new menu copy
		$query = 'SELECT menutype' .
				' FROM #__menu_types';
		if ($this->id) {
			$query .= ' WHERE id != '.(int) $this->id;
		}

		$db->setQuery( $query );
		$menus = $db->loadResultArray();

		foreach ($menus as $menutype)
		{
			if ($menutype == $this->menutype)
			{
				$this->setError( "Cannot save: Duplicate menu type '$this->menutype'" );
				return false;
			}
		}

		return true;
	}
}