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


class FabrikModelFabrikPassword  extends FabrikModelElement {

	var $_pluginName = 'password';
	
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
		
	function storeDatabaseFormat($val, $data){
		$val = md5(trim($val));
		return $val;
	}
	
	/**
	 * determines if the element can contain data used in sending receipts, e.g. fabrikfield returns true
	 */
	
	function isReceiptElement(){
		return true;
	}
	
		/**
	 * draws the form element
	 * @param int repeat group counter
	 * @return string returns element html
	 */
		
	function render( $data, $repeatCounter = 0 )
	{
		$elementHTMLName = $this->getHTMLName();
		$params 				=& $this->getParams();
		$element 				=& $this->getElement();
		$size 					= $element->width;
		$maxlength  = $params->get('maxlength');
		if ($maxlength == "0" or $maxlength == "") {
			$maxlength = $size;
		}
		$value = $this->default;
		$type = "password";
		if ( isset($this->_elementError) && $this->_elementError != '') {
			$type .= " elementErrorHighlight";
		}
		if ( $element->hidden == '1' ) {
			$type = "hidden";
		}
		$sizeInfo =  " size=\"$size\" maxlength=\"$maxlength\"";
		if(!$this->_editable) {
			if ($element->hidden == '1') {
				return "<!--" . stripslashes($value) . "-->";
			} else {
				return stripslashes($value);
			}
		}
		$elementHTMLName = str_replace( '.', '___', $elementHTMLName);
		$value = stripslashes($value);
		$str = "<input class=\"fabrikinput inputbox $type\" type=\"$type\" name=\"$elementHTMLName\" $sizeInfo id=\"" . $this->getHTMLId() . "\" value=\"$value\" />\n";
		$str .= "<div id=\"fb_el_$elementHTMLName" . "_check\" class=\"fabrikLabel\">" . JText::_( 'Confirm Password' ). "</div><br /><input class=\"inputbox $type\" type=\"$type\" name=\"$elementHTMLName" . "_check\" $sizeInfo id=\"" . $this->getHTMLId() . "_check\" value=\"$value\" />\n";
		return $str;
	}
	
	/**
	 * validate the passwords
	 * @param string elements data
	 * @return bol true if passes / false if falise validation
	 */

	function validate( $data )
	{
		$post	= JRequest::get( 'post' );
		$elName = $this->getFullName( true, true, false );
		$nameCheck = $key . "_check";
		if( $post[$nameCheck] != $data ){
			$this->_validationErr = JText::_( 'Password confirmation does not match' );
			return false;
		}else{
			return true;
		}
	}
	
	/**
	 * return tehe javascript to create an instance of the class defined in formJavascriptClass
	 * @param object element
	 * @return string javascript to create instance. Instance name must be 'el'
	 */
	
	function elementJavascript()
	{
		$id = $this->getHTMLId();
		$opts =& $this->getElementJSOptions();
		$opts = FastJSON::encode($opts);
		return "new fbPassword('$id', $opts)" ;
	}
	
		/**
	 * load the javascript class that manages interaction with the form element
	 * should only be called once
	 * @return string javascript class file
	 */
	
	function formJavascriptClass()
	{
		FabrikHelperHTML::script( 'javascript.js', 'components/com_fabrik/plugins/element/fabrikpassword/', false );	
	}
	
	/**
	 * defines the type of database table field that is created to store the element's data
	 */
	function getFieldDescription()
	{
		$objtype = "VARCHAR (255)";
		return $objtype;
	}
	
	/**
	 * render the element admin settings
	 * @param object element
	 */

	function renderAdminSettings( )
	{
		$params =& $this->getParams();
		$pluginParams =& $this->getPluginParams();
		$hiddenChk = ($this->hidden == '1') ? ' checked="checked"' : '';
		$evalChk = ($this->eval == '1') ? ' checked="checked"' : '';
		?>
		<div id="page-<?php echo $this->_name;?>" class="elementSettings" style="display:none">
		<table class="admintable"> 
			<?php
			FabrikHelperAdminHTML::widthField( $this );
			?>
			<tr> 
				<td><?php echo JText::_( 'Default' );?></td>
				<td>
					<textarea  onblur="setAll(this.value, 'default');" rows="8" cols="72" name="default" class="inputbox"><?php echo $this->default; ?></textarea>
				</td>
			</tr> 
			<tr> 
				<td>
					<label for="hidden">
						<?php echo JText::_( 'Hidden' ); ?>
					</label>
				</td>
				<td><input  onchange="setAllCheckBoxes('hidden', this.checked);"  type="checkbox" name="hidden" id="hidden" value="1" <?php echo $hiddenChk; ?> /></td>
			</tr> 
			<tr> 
				<td>
					<label for="eval">
						<?php echo JText::_( 'Eval' ); ?>
					</label>
				</td>
				<td><input type="checkbox"  onclick="setAllCheckBoxes('eval', this.checked)"  name="eval" id="eval" value="1" <?php echo $evalChk; ?> /></td>
			</tr>
		</table>
		<?php 
			echo $pluginParams->render( );
			?>
	</div><?php
	}
}	
?>