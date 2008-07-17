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


class FabrikModelFabrikUser extends FabrikModelElement {

	var $_pluginName = 'user';
	
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
		
	
		//are we editing an record
		$rowid = JRequest::getVar( 'rowid');
		if ($rowid != '' && !$params->get( 'update_on_edit' )) {
			//existing record  and you shouldnt update on edit
			$value = $element->default; 
		} else {
				$value 	= $user->get($type);
		}
		if ($this->_editable) {
			$hidden = ($element->hidden) ? " type=\"hidden\"" : "";
			$str = "<input class='fabrikinput inputbox' $hidden name=\"$elementHTMLName\" value=\"$value\" id=\"" . $this->getHTMLId() . "\" />\n";
		} else {
			$str = $value;
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
		$element =& $this->getElement();
		?>
		<div id="page-<?php echo $this->_name;?>" class="elementSettings" style="display:none">
		<?php 
		echo $pluginParams->render( 'details' );
		echo $pluginParams->render( 'params', 'extra');?>
		</div><?php
	}
}	
?>