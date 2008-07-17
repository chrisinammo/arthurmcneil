<?php
/**
* Plugin element to render fields
* @package fabrikar
* @author Rob Clayburn
* @copyright (C) Rob Clayburn
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();


class FabrikModelFabrikUsername  extends FabrikModelElement {

	var $_pluginName = 'username';
	
	/**
	* Constructor
	*/

	function __construct()
	{
		parent::__construct();
	}
	
	/**
	 * draws the form element
	 * @param int repeat group counter
	 * @return string returns element html
	 */
		
	function render( $data, $repeatCounter = 0 )
	{
		$elementHTMLName = $this->getHTMLName();
		$user  					=& JFactory::getUser();
		$element 				=& $this->getElement();
		$str = '';
		$params =& $this->getParams();
		$type 	= $params->get( 'my_data', 'username' );
		$value 	= $user->get( $type ); 
		if ($this->_editable) {
			$hidden = ($element->hidden) ? " type=\"hidden\"" : "";
			$str = "<input class='fabrikinput' $hidden name=\"$elementHTMLName\" value=\"$value\" id=\"" . $this->getHTMLId() . "\" />\n";
		}			
		return $str;
	}

	/**
	 * defines the type of database table field that is created to store the element's data
	 * @return string db field description
	 */
	
	function getFieldDescription()
	{
		return "VARCHAR (255)";
	}
	
	/**
	 * render admin settings
	 */

	function renderAdminSettings( )
	{
		$params =& $this->getParams();
		$pluginParams =& $this->getPluginParams();
		$hiddenChk = ($this->hidden == '1') ? ' checked="checked"' : '';
		?>
		<div id="page-<?php echo $this->_name;?>" class="elementSettings" style="display:none">
		<?php 
		echo $pluginParams->render( 'details' );
		echo $pluginParams->render( 'params', 'extra');?>
		</div><?php
	}
}	
?>