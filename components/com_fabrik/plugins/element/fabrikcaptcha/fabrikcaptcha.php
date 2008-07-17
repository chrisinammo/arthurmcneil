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


class FabrikModelFabrikcaptcha extends FabrikModelElement {

	var $_font = 'monofont.ttf';
	
	var $_pluginName = 'captcha';
	/**
	* Constructor
	*/

	function __construct()
	{
		parent::__construct();
	}
	
	/**
	 * can be overwritten in plugin class
	 * determines if the element can contain data used in sending receipts, e.g. fabrikfield returns true
	 */
	
	function isReceiptElement()
	{
		return true;
	}
	
	function _generateCode( $characters )
	{
		/* list all possible characters, similar looking characters and vowels have been removed */
		$possible = '23456789bcdfghjkmnpqrstvwxyz';
		$code = '';
		$i = 0;
		while ($i < $characters) {
			$code .= substr($possible, mt_rand(0, strlen($possible)-1), 1);
			$i++;
		}
		return $code;
   }
    
   /**
    * draws the form element
	 * @param int repeat group counter
	 * @return string returns element html
	 */
		
	function render( $data, $repeatCounter = 0 ) {
		$elementHTMLName = $this->getHTMLName();
		$element = $this->getElement();
		$params 	= $this->getParams();
		$size 		= $element->width;
		
		$height = $params->get('captcha-height', 40);
		$width = $params->get('captcha-width', 40);
		$characters = $params->get('captcha-chars', 6);
		
		$code = $this->_generateCode($characters);
	
     /* font size will be 75% of the image height */
     $font_size = $height * 0.75;
     $image = @imagecreate($width, $height) or die('Cannot initialize new GD image stream');
     /* set the colours */
     $background_color = imagecolorallocate($image, 255, 255, 255);
     $text_color = imagecolorallocate($image, 20, 40, 100);
     $noise_color = imagecolorallocate($image, 100, 120, 180);
     /* generate random dots in background */
     for ($i=0; $i<($width*$height)/3; $i++) {
     	imagefilledellipse($image, mt_rand(0,$width), mt_rand(0,$height), 1, 1, $noise_color);
     }
     /* generate random lines in background */
     for ($i=0; $i<($width*$height)/150; $i++) {
        imageline($image, mt_rand(0,$width), mt_rand(0,$height), mt_rand(0,$width), mt_rand(0,$height), $noise_color);
     }
     /* create textbox and add text */
     $fontPath = JPATH_SITE . '/components/com_fabrik/plugins/element/fabrikcaptcha/' . $this->_font;

     $textbox = imagettfbbox($font_size, 0, $fontPath, $code) or die('Error in imagettfbbox function ' . $fontPath);
     $x = ($width - $textbox[4])/2;
     $y = ($height - $textbox[5])/2;
     imagettftext($image, $font_size, 0, $x, $y, $text_color, $fontPath , $code) or die('Error in imagettftext function');
     imagejpeg($image, JPATH_SITE . '/components/com_fabrik/plugins/element/fabrikcaptcha/image.jpg');
     imagedestroy($image);
     $_SESSION['security_code'] = $code;
	
     $str = "<img src='" .COM_FABRIK_LIVESITE . "/components/com_fabrik/plugins/element/fabrikcaptcha/image.jpg' alt='security image' />";
	  $str .= "<br />";	

	  $maxlength  = $params->get('maxlength');
		if ($maxlength == "0" or $maxlength == "") {
			$maxlength = $size;
		}
	
		$value = $element->default;
		$type = ( $params->get('password') == "1" ) ? "password" : "text";
		if (isset( $this->_elementError ) && $this->_elementError != '' ) {
			$type .= " elementErrorHighlight";
		}
		if ($element->hidden == '1') {
			$type = "hidden";
		}
		$sizeInfo =  " size=\"$size\" maxlength=\"$maxlength\"";
		if (!$this->_editable) {
			if ($element->hidden == '1') {
				return "<!--" . stripslashes($value) . "-->";
			} else {
				return stripslashes($value);
			}
		}
		/* no need to eval here as its done before hand i think ! */
		if ($element->eval == "1" and !isset ( $data[$elementHTMLName] )) {
			$str .= "<input class=\"inputbox $type\" type=\"$type\" name=\"$elementHTMLName\" id=\"" . $this->getHTMLId() . "\" $sizeInfo value=\"\" />\n";
		} else {
			$value = stripslashes($value);
			$str .= "<input class=\"inputbox $type\" type=\"$type\" name=\"$elementHTMLName\" $sizeInfo id=\"" . $this->getHTMLId() . "\" value=\"\" />\n";
		}
		return $str;
	}
	
/**
	 * can be overwritten in adddon class 
	 * 
	 * checks the posted form data against elements INTERNAL validataion rule - e.g. file upload size / type
	 * @param string elements data
	 * @return bol true if passes / false if falise validation
	 */

	function validate( $data )
	{
		$this->getParams();
		$this->loadLanguage();
		$elName = $this->getFullName(  true, true, false );
		if ( $_SESSION['security_code'] != $data ) {
			return false; ;
		}
		return true;
	}
	
	/**
	 * @return string error message raised from failed validation
	 */

	function getValidationErr()
	{
		return JText::_( 'CAPTCHA Failed' );
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
		return "new fbCaptcha('$id', $opts)";
	}
	
	/**
	 * load the javascript class that manages interaction with the form element
	 * should only be called once
	 * @return string javascript class file
	 */
	
	function formJavascriptClass()
	{
		FabrikHelperHTML::script( 'javascript.js', 'components/com_fabrik/plugins/element/fabrikcaptcha/', true );
	}
	
	/**
	 * defines the type of database table field that is created to store the element's data
	 */
	function getFieldDescription()
	{
		return "VARCHAR (255)";
	}
	
	/**
	 * render the element admin settings
	 */

	function renderAdminSettings( )
	{
		$params =& $this->getParams();
		$pluginParams =& $this->getPluginParams();
		?>
		<div id="page-<?php echo $this->_name;?>" class="elementSettings" style="display:none">
			<?php 
			echo $pluginParams->render();
			?>
	</div><?php
	}
	
	/**
	 * used to format the data when shown in the form's email
	 * @param string data
	 * @return string formatted value
	 */
	
	function getEmailValue( $val )
	{	
		return "";
	}
}	
?>