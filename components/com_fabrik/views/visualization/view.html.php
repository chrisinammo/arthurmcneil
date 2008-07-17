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

class FabrikViewVisualization extends JView{
	
	function display( $tmpl = 'default' )
	{
		FabrikHelperHTML::packageJS();
		$model =& $this->getModel();
		$usersConfig = &JComponentHelper::getParams( 'com_fabrik' );
		$model->setId( JRequest::getVar('id', $usersConfig->get( 'visualizationid', JRequest::getInt('visualizationid', 0) ) ));
		$visualization =& $model->getVisualization();
		$pluginParams =& $model->getPluginParams();
		
		$pluginManager =& JModel::getInstance( 'Pluginmanager', 'FabrikModel' );
		$plugin =& $pluginManager->getPlugIn( $visualization->plugin, 'visualization' );
		$plugin->_row = $visualization;
		if ($visualization->state == 0) {
			return JError::raiseWarning( 500, JText::_( 'Sorry this visualization is unpublished' ));
		}
		
		//plugin is basically a model
		
		
		$pluginTask = JRequest::getVar( 'plugintask', 'render', 'request' );
		$plugin->_params = $pluginParams;
		$tmpl = $plugin->_params->get('calendar_layout', $tmpl);
		$plugin->$pluginTask( $this );
		$this->plugin =& $plugin;
		$viewName = $this->getName();
		$this->_setPath( 'template', $this->_basePath.DS.'plugins'.DS.$this->_name.DS.$plugin->_name.DS.'tmpl'.DS.$tmpl );
		
		$ab_css_file = JPATH_SITE."/components/com_fabrik/plugins/".$viewName."/" . $plugin->_name . "/tmpl/$tmpl/template.css";
		if (file_exists( $ab_css_file ))
		{
			JHTML::stylesheet( 'template.css', 'components/com_fabrik/plugins/'.$viewName.'/'. $plugin->_name .'/tmpl/'.$tmpl.'/', true );
		}
		
		parent::display();
	}
}
?>