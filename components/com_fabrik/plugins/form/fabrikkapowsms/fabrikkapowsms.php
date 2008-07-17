<?php
/**
* Send an SMS via the Kapow gateway
* @package Joomla
* @subpackage Fabrik
* @author Rob Clayburn
* @copyright (C) Rob Clayburn
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

//require the abstract plugin class
require_once( COM_FABRIK_FRONTEND.DS.'models'.DS.'plugin-form.php' );

class fabrikKapowSMS extends FabrikModelFormPlugin {
 	
	var $_url = 'http://www.kapow.co.uk/scripts/sendsms.php?username=%s&password=%s&mobile=%s&sms=%s';
 	
	var $_counter = null;
	
	/**
	* Constructor
	*/

	function __construct()
	{
		parent::__construct();
	}
	
	/**
	 * show a new for entering the form actions options 
	 */
 	
 	function renderAdminSettings( $elementId, &$row, &$params, $lists, $c )
 	{
 		$params->_counter_override = $this->_counter;
 		$display =  ($this->_adminVisible) ? "display:block" : "display:none";
 		$return = '<div class="page-' . $elementId . ' elementSettings" style="' . $display . '">
 		' . $params->render('params', '_default', false, $c) . 
 		'</div>
 		';
 		$return = str_replace("\r", "", $return);
		return  addslashes(str_replace("\n", "", $return));
 	}
 	
 	/**
 	 * process the plugin, called when form is submitted
 	 *
 	 * @param object $params
 	 * @param object form
 	 */

 	function process( $params, &$oForm )
 	{
		global $mosConfig_mailfrom;
		$this->_oForm = $oForm;	
		$message = $this->_getMessage();
		$aData 		= $oForm->_formData;
		$kapow_username = $params->get('kapow_username');
		$kapow_password = $params->get('kapow_password');
		$kapow_mobile	= $params->get('kapow_mobile');
		$this->_url = sprintf( $this->_url, $kapow_username, $kapow_password, $kapow_mobile, $message );
		$this->_doRequest( 'GET', $this->_url, '' );
		
	}
	
	function _doRequest($method, $url, $vars)
	{
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_HEADER, 1);
	    curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
	    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
	    curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');
	    if ($method == 'POST') {
	        curl_setopt($ch, CURLOPT_POST, 1);
	        curl_setopt($ch, CURLOPT_POSTFIELDS, $vars);
	    }
	    $data = curl_exec($ch);
	    curl_close($ch);
	    if ($data) {
	        if ($this->callback)
	        {
	            $callback = $this->callback;
	            $this->callback = false;
	            return call_user_func($callback, $data);
	        } else {
	            return $data;
	        }
	    } else {
	        return curl_error($ch);
	     }
	}

	/**
	 * default email handling routine, called if no email template specified
	 * @return string email message
	 */

	function _getMessage( )
	{
		$config =& JFactory::getConfig();
		$data = $this->_oForm->_formData;
		$arDontEmailThesKeys = array();
		/*remove raw file upload data from the email*/
		foreach ($_FILES as $key => $file) {
			$arDontEmailThesKeys[] = $key;
		}
		$message = "";
		$pluginManager =& JModel::getInstance( 'Pluginmanager', 'FabrikModel' );
		foreach ($this->_oForm->_groups as $groupModel) {
			foreach ($groupModel->_aElements as $elementModel) {
				$element =& $elementModel->getElement();
				$element->label = strip_tags( $element->label );
				if (!array_key_exists( $element->name, $data )) {
					$elName = $element->getFullName( );
				} else {
					$elName =  $element->name;
				}
				$key = $elName;
				if (!in_array( $key, $arDontEmailThesKeys )) {
					if (array_key_exists( $elName, $data )) {
						$val = stripslashes( $data[$elName] );
						$params =& $elementModel->getParams();
						if (method_exists( $elementModel, 'getEmailValue' )) {
							$val = $elementModel->getEmailValue( $val );
						} else {
							if (is_array( $val )) {
								$val = implode("\n", $val);
							}
						}
						$val = rtrim($val, "<br />");
						$message .= $element->label . ": " . $val . "\r\n";
					}
				}
			}
		}
		$message = JText::_('Email from') . $config->getValue( 'sitename' ) . "\r \n \r \nMessage:\r \n" . stripslashes($message);
		return $message;
	}
	

}
?>