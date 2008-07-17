<?php
/**
* Send a receipt
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

class FabrikModelFabrikReceipt extends FabrikModelFormPlugin {
 	
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
 		$return = '<div class="page-' . $elementId . ' elementSettings" style="' . $display . '">'.  
		$params->render('params', '_default', false, $c) .
 		'</div>
 		';
 		$return = str_replace( "\r", "", $return );
		return addslashes( str_replace( "\n", "", $return ) );
 	}

 	/**
 	 * inject custom html into the bottom of the form
 	 *
 	 * @return string html
 	 */
 	
 	function getBottomContent()
 	{
 		$params =& $this->getParams();
 		if($params->get('ask-receipt')){
 			return "
			<label><input type=\"checkbox\" name=\"fabrik_email_copy\" class=\"contact_email_copy\" value=\"1\"  />
			 ".JText::_('Email me a copy') . "</label>";
 		}
 	}
 	
 	/**
 	 * process the plugin, called when form is submitted
 	 *
 	 * @param object $params
 	 * @param object form
 	 */
 	
 	function onAfterProcess( $params, &$formModel )
	{
		if ($params->get( 'ask-receipt' )) {
			$post = JRequest::get( 'post' );
			if (!array_key_exists( 'fabrik_email_copy', $post )) {
				return ;
			}
		}
		$config =& JFactory::getConfig();
		$w = new FabrikWorker(); 
		$message = $w->parseMessageForPlaceHolder( $params->get('receipt_message') );
		$form =& $formModel->getForm();
		
		$aData 		= $formModel->_formData;
		$to = $w->parseMessageForPlaceHolder( $params->get('receipt_to'), $aData );
		$receipt_email = $params->get('receipt_to');
		if (!$form->record_in_database) {
			foreach( $aData as $key=>$val ){
				$aBits = explode('___', $key);
				$newKey = array_pop($aBits);
				if( $newKey == $receipt_email ){
					$email = $val;
				}
			}
		}
		
		$subject =  html_entity_decode( $params->get( 'receipt_subject', '' ) );
		$subject = $w->parseMessageForPlaceHolder( $subject );
		$from 		= $config->getValue( 'mailfrom' );
		$fromname = $config->getValue( 'fromname' );
		JUTility::sendMail( $from, $fromname, $to, $subject, $message, true );
	}
}
?>