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


class FabrikModelFabrikLink  extends FabrikModelElement {

	var $_pluginName = 'link';
	
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

	function renderTableData( $data, $oAllRowsData )
	{
		$str = '';
		if (strstr( $data, $this->_groupSplitter )) {
			$data = explode($this->_groupSplitter, $data);
			foreach ($data as $d) {
				$str .= $this->_renderTableData( $d, $oAllRowsData );			
			}
		} else {
			$str .= $this->_renderTableData( $data, $oAllRowsData );
		}
		return $str;
	}
	
	function _renderTableData( $data, $oAllRowsData )
	{
		$data = explode( "|", $data );
		$tableModel =& $this->_table;
		$params =& $this->getParams();
		if ( is_array( $data ) ){
			if ( count( $data ) == 1 ){ $data[1] = $data[0];}
			if(empty($data[1]) && empty($data[0])){
				return '';
			}
			if( $tableModel->_outPutFormat != 'rss' ){
				$link = "<a href='" . $data[1] . "' target='" . $params->get('link_target', '') . "'>" . $data[0] . "</a>";
			} else {
				$link = $data[1];
			}
			return $link;
		}
		return $data;
	}

	/**
	 * draws the form element
	 * @param int repeat group counter
	 * @return string returns element html
	 */
		
	function render( $data, $repeatCounter = 0 ) {
		$elementHTMLName 	= $this->getHTMLName();
		$params 					=& $this->getParams();
		$element 					=& $this->getElement();
		$size 		= $element->width;
		$maxlength 	= $params->get('maxlength');
		if ($maxlength == "0" or $maxlength == "") {
			$maxlength = $size;
		}
		$value 		= $element->default;
		if(array_key_exists($elementHTMLName, $data)){
			$value = $data[$elementHTMLName];
		}
		$sizeInfo 	=  " size=\"$size\" maxlength=\"$maxlength\"";
		if($value == ""){
			$value = array('label'=>'', 'link'=>'');
		}else{
			if(!is_array($value)){
				$tmpvalue = explode("|", $value);
				$value = array();
				$value['label']=$tmpvalue[0];
				if(count($tmpvalue) > 1){
					$value['link']=$tmpvalue[1];
				}else{
					$value['link']=$tmpvalue[0];
				}
			}
		}	
		if( count( $value ) == 0 ){
			$value = array('label'=>'', 'link'=>'');
		}
		if( !$this->_editable ){
			return "<a href='" . $value['link']. "'>"  . $value['label'] . "</a>";
		}
		$errorCSS  = '';
		if( isset($this->_elementError) && $this->_elementError != '' ){
			$errorCSS = " elementErrorHighlight";
		}
		$str ="<div class='fabirkElementContainer'>";
		$str .= JText::_('Label') . ":<br />";
		$str .= "<input  class=\"fabrikinput inputbox$errorCSS\" name=\"$elementHTMLName" . "[label]\" $sizeInfo id=\"" . $this->getHTMLId() ."\" value=\"" . $value['label'] . "\" />\n";
		$str .= "<br />" . JText::_('URL') . ":<br />";
		$str .= "<input class=\"fabrikinput inputbox$errorCSS\" name=\"$elementHTMLName" . "[link]\" $sizeInfo id=\"" . $this->getHTMLId() . "_link\" value=\"" . $value['link'] . "\" />\n";
		$str .="</div>";
		return $str;
	}
	
	function getFieldDescription(){
		return "TEXT";
	}
	
	function renderAdminSettings( )
	{
		$params =& $this->getParams();
		$pluginParams =& $this->getPluginParams();
		?>
		<div id="page-<?php echo $this->_name;?>" class="elementSettings" style="display:none">
			<?php 
			echo $pluginParams->render( 'details' );
			echo $pluginParams->render( 'params', 'extra' ); 
			?>
		</div><?php
	}
	
	/**
	 *  can be overwritten ita when shown in the form's email
	 * @param string data
	 * @return string formatted value
	 */

	function getEmailValue( $data ){
		if ( is_array( $data ) ){
			$val = "<a href='" . $data['link'] . "' >" . $data['label'] . "</a>";
		}
		return $val;			
	}
	
	/**
	 *  manupulates posted form data for insertion into database
	 * @param mixed thie elements posted form data  
	 * @param array posted form data
	 */
		
	function storeDatabaseFormat($val, $data){
		if(is_array($val)){
			$val = implode('|', $val);
		}
		return $val;
	}
	
	/**
	 * load the javascript class that manages interaction with the form element
	 * should only be called once
	 * @return string javascript class file
	 */

	function formJavascriptClass( ){
		FabrikHelperHTML::script( 'javascript.js', 'components/com_fabrik/plugins/element/fabriklink/', true );
	}
	
	/**
 	* return the javascript to create an instance of the class defined in formJavascriptClass
	 * @return string javascript to create instance. Instance name must be 'el'
	 */
	
	function elementJavascript( )
	{
		$id = $this->getHTMLId();
		$opts =& $this->getElementJSOptions();
		$opts = FastJSON::encode($opts);
		return "new fbLink('$id', $opts)" ;
	}	
}	
?>