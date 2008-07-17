<?php
/**
* @package Joomla
* @subpackage Fabrik
* @copyright Copyright (C) 2005 Rob Clayburn. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();


class FabrikModelfabrikAccess  extends FabrikModelElement {

	var $_pluginName = 'access';
	
	/**
	* Constructor
	*/

	function __construct()
	{
		parent::__construct();
	}
	
	/**
	 * formats the posted data for insertion into the database
	 * @param mixed thie elements posted form data  
	 * @param array posted form data
	 */
	
	function storeDatabaseFormat( $val, $data )
	{
		return $val[0];
	}
	
	/**
	 * draws the form element
	 * @param int repeat group counter
	 * @return string returns element html
	 */
		
	function render( $data, $repeatCounter = 0 )
	{
		$elementHTMLName = $this->getHTMLName();
		$acl =& JFactory::getACL();
		$arSelected = array('');
		if (isset( $data[$elementHTMLName] )) {
			if (!is_array( $data[$elementHTMLName][$repeatCounter] )) {
				$arSelected = explode( ',', $data[$elementHTMLName][$repeatCounter] );
			} else {
				$arSelected = $data[$elementHTMLName][$repeatCounter];
			}
		}
		$gtree = $acl->get_group_children_tree( null, 'USERS', false );
		$optAll = array(JHTML::_('select.option', '30', ' - Everyone'), JHTML::_('select.option', "26", 'Nobody' ));
		$gtree2 = array_merge( $gtree, $optAll );
		return JHTML::_('select.genericlist',  $gtree2, $elementHTMLName, 'class="inputbox" size="6"', 'value', 'text', $arSelected[0]   );
	}
	
	/**
	 * defines the type of database table field that is created to store the element's data
	 */
	function getFieldDescription()
	{
		return "INT(3)";
	}
	
	/**
 	* return the javascript to create an instance of the class defined in formJavascriptClass
	 * @return string javascript to create instance. Instance name must be 'el'
	 */
	
	function elementJavascript( )
	{
	}	
	
	/**
	 * load the javascript class that manages interaction with the form element
	 * should only be called once
	 * @return string javascript class file
	 */

	function formJavascriptClass( )
	{
	}	
	
	function renderAdminSettings( )
	{
		?>
		<div id="page-<?php echo $this->_name;?>" class="elementSettings" style="display:none">
		<?php echo JText::_( 'No extra options available' );?>	
		</div><?php
	}
	
}	
?>