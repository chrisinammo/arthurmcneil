<?php
/**
* Form email plugin
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

class FabrikModelfabrikEmail extends FabrikModelFormPlugin {
	
	/**
	 * @var array of files to attach to email
	 */
	var $_counter = null;
	
	var $_aAttachments = array();
 	
	/**
	* Constructor
	*/

	function __construct()
	{
		parent::__construct();
	}

	/**
	 * show a form for entering the form actions options 
	 */

	function renderAdminSettings( $elementId, &$row, &$params, $lists, $c )
	{
 		$params->_counter_override = $this->_counter;
 		$display =  ($this->_adminVisible) ? "display:block" : "display:none";
 		$return = '<div class="page-' . $elementId . ' elementSettings" style="' . $display . '">'
 		. $params->render('params', '_default', false, $c);
		$return .= '</div>';
 		$return = str_replace( "\r", "", $return );
 		return addslashes( str_replace( "\n", "", $return ) );
 	}
 	
 	/**
 	 * process the plugin, called when form is submitted
 	 *
 	 * @param object $params
 	 * @param object form
 	 * @returns true if you should show the thanks page, false if you should
	 * show the jump page
 	 */

 	function onAfterProcess( $params, &$formModel )
 	{
		$user  = &JFactory::getUser();
		$config =& JFactory::getConfig();
		global $mosConfig_lang;
		$this->formModel =& $formModel;
		$formParams = $formModel->getParams();
		$path = JPATH_SITE .'/administrator/components/com_fabrik/language/'.$mosConfig_lang.'.php';
		if (JFile::exists( $path )) {
			include_once( $path );
		} else {
			$path = JPATH_SITE .'/administrator/components/com_fabrik/language/english.php';
			if (JFile::exists( $path )) {
				include_once( $path );
			}
		}

		$emailTemplate = JPath::clean(JPATH_SITE . DS.'components'.DS.'com_fabrik'.DS.'plugins'.DS.'form'.DS.'fabrikemail'.DS.'tmpl'.DS . $params->get('email_template', ''));
		if (JFile::exists( $emailTemplate )) {
			$htmlEmail 	= 1;
			if (JFile::getExt($emailTemplate) == 'php') {
				 $message = $this->_getPHPTemplateEmail( $emailTemplate );
			} else {
				$message = $this->_getTemplateEmail( $emailTemplate );
			}
		}else{
			$htmlEmail 	= 0;
			$message = $this->_getTextEmail( );
		}
		$htmlEmail 	= 0;
		$cc 		= null;
		$bcc 		= null;
		$w = new FabrikWorker();
		$email_to 	= $w->parseMessageForPlaceholder( $params->get( 'email_to' ) );
		$email_from = $w->parseMessageForPlaceholder( $params->get( 'email_from' ) );
		$subject	= $params->get('email_subject');
		if ( $subject == "" ) {
			$subject = $config->getValue( 'sitename' ) . " :: Email";
		}
		$subject = $w->parseMessageForPlaceholder( $subject );
		$subject = preg_replace_callback( '/&#([0-9a-fx]+);/mi', array( $this, 'replace_num_entity' ), $subject );
		/* Send email*/
		$emails = explode( ',', $email_to );
		foreach ($emails as $email) {
			!JUTility::sendMail( $email_from, $email_from, $email, $subject, $message, $htmlEmail, $cc, $bcc, $this->_aAttachments );
		}
	}
	
	/**
	 * use a php template for advanced email templates, partularly for forms with repeat group data
	 *
	 * @param bol if file uploads have been found
	 * @param string path to template
	 * @return string email message
	 */

	function _getPHPTemplateEmail( $tmpl )
	{
		// start capturing output into a buffer
		ob_start();
		require_once( $tmpl );
		$message = ob_get_contents();
		ob_end_clean();
		return  $message;
	}
	
	/**
	 * template email handling routine, called if email template specified
	 * @param string path to template
	 * @return string email message
	 */
	
	function _getTemplateEmail( $emailTemplate )
	{
		$data 		= $this->formModel->_formData;
		$message 	= file_get_contents($emailTemplate);
		/*remove raw file upload data from the email*/
		$arDontEmailThesKeys = array();
		foreach ($_FILES as $key => $file) {
			$arDontEmailThesKeys[] = $key;
		}

		//$$$ rob if not recording in db then we can add in short key version of posted data
		// eg jos_fabrik_data_formid___full_name becomes full_name - this allow people to use {ful_name}
		// in email template
		$form =&  $this->formModel->getForm();
		if (!$form->record_in_database ) {
			foreach ($data as $key => $val) {
				if (strstr( $key, '___' )) {
					$key = explode('___', $key);
					$key = array_pop($key);
					$data[$key] = $val;
				}
			}
		} 
		
		$pluginManager =& JModel::getInstance( 'Pluginmanager', 'FabrikModel' );
		foreach ($this->formModel->_groups as $groupModel) {
			foreach ($groupModel->_aElements as $elementModel) {
				$element =& $elementModel->getElement();
				$element->label = strip_tags( $element->label );
				if (!array_key_exists( $element->name, $data )) {
					$elName = $elementModel->getFullName( );
				} else {
					$elName =  $element->name;
				}
				$key = $elName;
				if (!in_array( $key, $arDontEmailThesKeys )) {
					if (array_key_exists( $elName, $data )) {
						$val = stripslashes( $data[$elName] );
						$params =& $elementModel->getParams();
						$line = $element->label . ' : ' . $elementModel->getEmailValue( $val ) . "\n";
						if (method_exists( $elementModel, 'addEmailAttachement' )) {
							$this->_aAttachments[] = $elementModel->addEmailAttachement( $val );
						}
						$message .= $line;
					}
				}
			}
		}
		return $message;
	}
	
	/**
	 * default email handling routine, called if no email template specified
	 * @return string email message
	 */

	function _getTextEmail( )
	{
		$data = $this->formModel->_formData;
		$config =& JFactory::getConfig();
		$arDontEmailThesKeys = array();
		/*remove raw file upload data from the email*/
		foreach ($_FILES as $key => $file) {
			$arDontEmailThesKeys[] = $key;
		}
		$message = "";
		$pluginManager =& JModel::getInstance( 'Pluginmanager', 'FabrikModel' );
		foreach ($this->formModel->_groups as $oGroup) {
			foreach( $oGroup->_aElements as $elementModel ) {
				$element = $elementModel->getElement();
				$element->label = strip_tags($element->label);
				if (!array_key_exists($element->name, $data)) {
					$elName = $elementModel->getFullName( );
				} else {
					$elName =  $element->name;
				}
				$key = $elName;
				if (!in_array( $key, $arDontEmailThesKeys )) {
					if (array_key_exists( $elName, $data )) {
						$params = $elementModel->getParams();
						if (method_exists( $elementModel, 'getEmailValue' )) {
							$val = $elementModel->getEmailValue( $data[$elName] );
						} else {
							if (is_array( $val )) {
								$val = implode("\n", $val);
							}
						}
						$val = rtrim($val, "<br />");
						$val = stripslashes( $val );
						if (method_exists( $elementModel, 'addEmailAttachement' )) {
							$this->_aAttachments[] = $elementModel->addEmailAttachement( $val );
						}
						$message .= $element->label . ": " . $val . "\r\n";
					}
				}
			}
		}
		$message = JText::_('Email from') . ' ' . $config->getValue( 'sitename' ) . "\r \n \r \nMessage:\r \n" . stripslashes($message);
		return $message;
	}
}
?>