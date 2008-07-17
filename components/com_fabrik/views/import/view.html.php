<?php
/**
* @package Joomla
* @subpackage Fabrik
* @copyright Copyright (C) 2005 Rob Clayburn. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

jimport('joomla.application.component.view');

class fabrikViewImport extends JView
{
	
	function display( $tpl = null )
	{
		if ($this->getLayout() == 'form') {
			$this->_displayForm( $tpl );
			return;
		}
		$this->tableid = JRequest::getVar( 'tableid', 0 );
		$tableModel =& JModel::getInstance( 'Table', 'FabrikModel' );
		$tableModel->setId( $this->tableid );
		$this->table = $tableModel->getTable();
		parent::display();
	}
	

}
?>