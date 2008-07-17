<?php
/**
* @package Joomla
* @subpackage Fabrik
* @copyright Copyright (C) 2005 Rob Clayburn. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

jimport('joomla.application.component.model');
/**
 * @package fabrik
 * @Copyright (C) Rob Clayburn
 * @version $Revision: 1.3 $
 */
 
require_once( JPATH_SITE.DS.'components'.DS.'com_fabrik'.DS.'models'.DS.'plugin.php' );

class FabrikModelValidationRule extends FabrikModelPlugin
{

	var $_pluginParams = null;
	
	var $_rule = null;
	/**
	 * constructor
	 */

	function __construct()
	{
		parent::__construct();
	}
	
	/**
	 * validate the elements data against the rule
	 * @param string data to check
	 * @param object element
	 * @return bol true if validation passes, false if fails
	 */
	
	function validate( $data, &$element )
	{
		return true;
	}

	/**
	 * looks at the validation condition & evaulates it
	 * if evaulation is true then the validation rule is applied
	 *@return bol apply validation
	 */
	
	function shouldValidate( $data )
	{
		$params =& $this->getParams();
		$post	= JRequest::get( 'post' );
		$condition = trim( $params->get( 'validation_condition' ) );
		if ($condition == '') {
			return true;
		}
		$w = new FabrikWorker();
		$condition = trim( $w->parseMessageForPlaceHolder( $condition ) );
		if (substr( strtolower( $condition ), 0, 6 ) !== 'return') {
			$condition = "return $condition";
		}
		$res = @eval( $condition );
		if (is_null( $res )) {
			return true;
		}
		return $res;
	}
	
	function renderAdminSettings()
	{
		$pluginParams =& $this->getPluginParams();
		//$this->loadLanguage( $this->_pluginName );
		$return = '<div id="page-'.$this->_pluginName.'" class="validationSettings" style="display:none">'.	
			 $pluginParams->render( 'details', '_default', false ).
		'</div>';
		$return = str_replace("\r", "", $return);
		return  addslashes(str_replace("\n", "", $return));
		
	}
	
 	function getPluginParams()
	{
		if (!isset( $this->_pluginParams )) {
			$cache = & JFactory::getCache();
			//$this->_pluginParams = $cache->call( array( &$this, '_loadPluginParams') );
			$this->_pluginParams = $this->_loadPluginParams();
		}
		return $this->_pluginParams;
	}
	
	function _loadPluginParams()
	{
		if (isset( $this->_xmlPath )) {
			$rule =& $this->getValidationRule();
			$pluginParams = &new fabrikParams( $rule->attribs, $this->_xmlPath, 'fabrikplugin' );
			$pluginParams->bind( $rule );
			return $pluginParams;
		}
		return false;
	}
	
	function &getValidationRule()
	{
		if (!$this->_rule) {
			JTable::addIncludePath( JPATH_ADMINISTRATOR.DS.'components'.DS.'com_fabrik'.DS.'tables' );
			$row = JTable::getInstance( 'Validationrule', 'Table' );
			$row->load( $this->_id );
			$this->_rule = $row;
		}
		return $this->_rule;
	}

}
?>
