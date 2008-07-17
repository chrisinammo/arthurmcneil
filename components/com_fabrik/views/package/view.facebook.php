<?php
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

jimport('joomla.application.component.view');

class fabrikViewPackage extends JView
{
	
	var $_template 	= null;
	var $_errors 	= null;
	var $_data 		= null;
	var $_rowId 	= null;
	var $_params 	= null;
	
	function fabrikViewPackage( &$oPackage )
	{
		$this->_oPackage = $oPackage;
	}
	
	
	function display()
	{
		global $_MAMBOTS;
		$tpl = "components/com_fabrik/views/package/tmpl/" . $tpl ."/template.php";

		// start capturing output into a buffer
		ob_start();
		// include the requested template filename in the local scope
		// (this will execute the view logic).

		require( $tpl );

		// done with the requested template; get the buffer and
		// clear it.
		$this->_output = ob_get_contents();
		ob_end_clean();
		return $this->_output;
	}

	
	function _includeTemplateCSSFile( $formTemplate ){
			
		$config		=& JFactory::getConfig();
		$document =& JFactory::getDocument();
		$ab_css_file = JPATH_SITE."/components/com_fabrik/views/form/tmpl/$formTemplate/template.css";
		$live_css_file = JURI::base()  . "/components/com_fabrik/views/form/tmpl/$formTemplate/template.css";
		if ( file_exists( $ab_css_file ) ) {
			$document->addStyleSheet($live_css_file);
		}
	}


}
?>