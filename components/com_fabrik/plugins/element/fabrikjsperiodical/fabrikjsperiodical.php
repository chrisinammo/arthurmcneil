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


class FabrikModelfabrikJSPeriodical  extends FabrikModelElement {
	
	var $_pluginName = 'jsperiodical';
	
/**
	* Constructor
	*/

	function __construct()
	{
		parent::__construct();
	}
	
		/**
	 * shows the data formatted for the table view
	 * @param string data
	 * @param object all the data in the tables current row
	 * @return string formatted value
	 */

	function renderTableData( $data, $oAllRowsData ){
		$params =& $this->getParams();
		$format = $params->get('text_format_string');
		if ($format  != '') {
			 $str = sprintf($format, $data);
			 $data = eval($str);
		}
		return parent::renderTableData( $data, $oAllRowsData );
	}
	
	/**
	 * determines if the element can contain data used in sending receipts, e.g. fabrikfield returns true
	 */
	
	function isReceiptElement(){
		return true;
	}
	
		/**
	 * draws the form element
	 * @param array data to preopulate element with
	 * @param int repeat group counter
	 * @return string returns element html
	 */
		
	function render( $data, $repeatCounter = 0 ) {
		$elementHTMLName = $this->getHTMLName();
		$params 					=& $this->getParams();
		$element 					=& $this->getElement();
		$size 		= $element->width;
		$maxlength  = $params->get('maxlength');
		if ($maxlength == "0" or $maxlength == "") {
			$maxlength = $size;
		}
	
		$value = $element->default;
		$type = ( $params->get('password') == "1" ) ?"password" : "text";
		if( isset($this->_elementError) && $this->_elementError != '' ){
			$type .= " elementErrorHighlight";
		}
		if ( $element->hidden == '1' ) {
			$type = "hidden";
		}
		$sizeInfo =  " size=\"$size\" maxlength=\"$maxlength\"";
		if( !$this->_editable ){
			$format = $params->get('text_format_string');
			if ($format  != '') {
				 $value =  eval(sprintf($format,$value));
			}
			if( $element->hidden == '1' ) {
				return "<!--" . $value . "-->";
			} else {
				return $value;
			}
		}
		
		/* no need to eval here as its done before hand i think ! */
		if ($element->eval == "1" and !isset ( $data[$elementHTMLName] )) {
			$str = "<input class=\"fabrikinput inputbox $type\" type=\"$type\" name=\"$elementHTMLName\" id=\"". $this->getHTMLId() . "\" $sizeInfo value=\"$value\" />\n";
		} else {
			$str = "<input class=\"fabrikinput inputbox $type\" type=\"$type\" name=\"$elementHTMLName\" $sizeInfo id=\"". $this->getHTMLId() . "\" value=\"$value\" />\n";
		}
		return $str;
	}
	
	/**
	 * return tehe javascript to create an instance of the class defined in formJavascriptClass
	 * @return string javascript to create instance. Instance name must be 'el'
	 */
	
	function elementJavascript()
	{
		$id = $this->getHTMLId();
		$opts =& $this->getElementJSOptions();
		$opts = FastJSON::encode($opts);
		return "new fbJSPeriodical('$id', $opts)" ;
	}
	
	/**
	 * load the javascript class that manages interaction with the form element
	 * should only be called once
	 * @return string javascript class file
	 */
	
	function formJavascriptClass(){
		$params =& $this->getParams();
		return "
		fbJSPeriodical = fbElement.extend({
			initialize: function(element, options) {
				this.plugin = 'fabrikPeriodical';
				this.strElement = element;
				this.setOptions(element, options);

				var periodical;
				 
				var fx = function() {
					". $params->get('jsperiod_code') . "
				}.bind(this);
 
				window.addEvent('domready', function() {
					fx();
					periodical = fx.periodical(" . $params->get('jsperiod_period') . ", this);
				});
			}
		});
		";
	}
	
	/**
	 * defines the type of database table field that is created to store the element's data
	 */
	function getFieldDescription()
	{
		$p = $this->getParams();
		switch ( $p->get('text_format') ) {
			case 'text':
			default:
				$objtype = "VARCHAR (255)";
				break;
			case 'integer':
				$objtype = "INT(" . $p->get('integer_length', 10) . ")";
				break;
			case 'decimal':
				$objtype = "DECIMAL(" . $p->get('integer_length', 10) . "," . $p->get('decimal_length', 2) . ")";
				break;			
		}
		return $objtype;
	}
	
	/**
	 * render the element admin settings
	 */

	function renderAdminSettings( )
	{
		$pluginParams =& $this->getPluginParams();
		?>
		<div id="page-<?php echo $this->_name;?>" class="elementSettings" style="display:none">
			<?php 
			echo $pluginParams->render();
			?>
	</div><?php
	}

}
?>