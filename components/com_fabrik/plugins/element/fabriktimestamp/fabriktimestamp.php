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


class FabrikModelFabrikTimeStamp extends FabrikModelElement {

	var $_pluginName = 'timestamp';
	
	/**
	* Constructor
	*/

	function __construct()
	{
		parent::__construct();
	}

	
	/**
	 * draws a field element
	 * @param int repeat group counter
	 * @return string returns element html
	 */
		
	function render( $data, $repeatCounter = 0 )
	{
		return '';
	}
	
	/**
	 * defines the type of database table field that is created to store the element's data
	 * @return string db field description
	 */

	function getFieldDescription()
	{
		return "TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP";
	}
	
	/**
	 * renders admin settings
	 */

	function renderAdminSettings( )
	{
		?>
		<div id="page-<?php echo $this->_name;?>" class="elementSettings" style="display:none">		
		<?php echo JText::_( 'No extra options available' );?>	
		</div><?php
	}
}	
?>