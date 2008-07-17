<?php
/**
* @package Joomla
* @subpackage Fabrik
* @copyright Copyright (C) 2005 Rob Clayburn. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/


// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

/**
 * Renders a list of elements found in a fabrik table
 *
 * @package 	Joomla
 * @subpackage	Articles
 * @since		1.5
 */
class JElementTablefields extends JElement
{
	/**
	 * Element name
	 * @access	protected
	 * @var		string
	 */
	var	$_name = 'Tablefields';

	function fetchElement($name, $value, &$node, $control_name)
	{
		$db =& JFactory::getDBO();
		$tableName = $this->_parent->get('db_table_name');
		$controller = JRequest::getVar('c');
		
		$id = $this->_parent->get('id');
		
		switch($controller)
		{ 
			case 'element':
			
				$oGroup = & JModel::getInstance( 'Group', 'FabrikModel' );
				// $$$ hugh - I think this should be group_id?  working on ticket #60
				//$oGroup->setId( $row->id );
				$oGroup->setId( $this->_parent->get('group_id') );
				$aFormIds 	= $oGroup->getFormsIamIn( );
				$oForm 	 	=& JModel::getInstance( 'Form', 'FabrikModel' );
				$aEls 		= array();
				foreach ( $aFormIds as $formId ) {
					$oForm->setId( $formId );
					$tableModel = JModel::getInstance( 'Table', 'FabrikModel' ); 
					$tableModel->loadFromFormId( $oForm->_id );
					
					
					$aJoins = $tableModel->getJoins( );
					$aEls 	= array_merge( $aEls, $oForm->getElementOptions( true, false, true, $aJoins, $tableModel->_table->db_table_name ) );
				}
				asort($aEls);
				break;
			case 'table':
				$tableModel =& JModel::getInstance( 'Table', 'FabrikModel' );
				$tableModel->setId( $id );
				$formModel = $tableModel->getForm();
				$aJoinObjs 	= $tableModel->getJoins( );
				$showTableName = true;
				$useStep = true;
				$aEls = $formModel->getElementOptions( true, true, $showTableName, $aJoinObjs, $tableName, $useStep );
				break;
			default:
				return JText::_( 'the Tablefields xml element is only supported by fabrik\'s table and element objects');
				break;
		}
		
		
		$aEls[] = JHTML::_('select.option', '', '-' );
		asort($aEls);
		return JHTML::_('select.genericlist',  $aEls, $control_name.'['.$name.']', 'class="inputbox" size="1" ', 'value', 'text', $value );
	}
}