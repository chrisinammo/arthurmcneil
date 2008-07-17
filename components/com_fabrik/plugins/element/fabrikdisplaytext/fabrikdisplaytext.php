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


class FabrikModelFabrikDisplaytext  extends FabrikModelElement {

	var $_pluginName = 'displaytext';
	
	/**
	* Constructor
	*/

	function __construct()
	{
		parent::__construct();
	}

	function setIsRecordedInDatabase(){
		$this->_recordInDatabase = false;
	}
	
	/**
	 * write out the label for the form element
	 * @param object form
	 * @param bol encase label in <label> tag
	 * @param string id of element related to the label
	 */
	
	function getLabel()
	{
		return "";
	}
	
	/**
	 * draws the form element
	 * @param int repeat group counter
	 * @return string returns element html
	 */
		
	function render( $data, $repeatCounter = 0 ) {
		$element =& $this->getElement();
	  if ($element->eval) {
			//strip html tags
			$element->label = preg_replace(  '/<[^>]+>/i', '', $element->label );
			//change htmlencoded chars back
			$element->label = htmlspecialchars_decode( $element->label );
			return eval( $element->label );
		} else {
			return $element->label;
		}
	}
	
	function getFieldDescription(){
		return "TEXT";
	}
	
	function renderAdminSettings( )
	{
		$pluginParams =& $this->getPluginParams();
		?>
		<div id="page-<?php echo $this->_name;?>" class="elementSettings" style="display:none">
		<?php echo $pluginParams->render( 'details' );?>	
		</div><?php
	}
}	
?>