<?php

/**
* Redirect the user when the form is submitted
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
require_once( COM_FABRIK_FRONTEND.DS.'helpers'.DS.'parent.php' );

class FabrikModelFabrikRedirect extends FabrikModelFormPlugin {
 	
	/**
	* Constructor
	*/
	
	var $_result = true;
	
	var $_counter = null;

	function __construct()
	{
		parent::__construct();
	}
	
	/**
	 * show a new for entering the form actions options 
	 */
 	
 	function renderAdminSettings( $elementId, &$row, &$params, $lists, $c = null )
 	{
 		$params->_counter_override = $this->_counter;
 		$display =  ($this->_adminVisible) ? "display:block" : "display:none";
 		$return = '<div class="page-' . $elementId . ' elementSettings" style="' . $display . '">';
 		$return .= $params->render('params', '_default', false, $c);
 		$return .= '</div>';
 		$return = str_replace( "\r", "", $return );
		return  addslashes( str_replace( "\n", "", $return ) );
 	}
 	
 	
 	function _processParams( $params, &$formModel )
	{
		if (!isset( $this->_params )) {
			$params = $formModel->getParams();
	 		$this->_params = new stdClass();
			$jumpPage = $params->get('jump_page', '', '_default', 'array');
			$jumpPage = @$jumpPage[0];
			$thanksMessage= $params->get('thanks_message', '', '_default', 'array');
			$thanksMessage = @$thanksMessage[0];
			$append_jump_url = $params->get('append_jump_url', '', '_default', 'array');
			$append_jump_url = @$append_jump_url[0];
			$save_full_elname_in_session = $params->get('save_full_elname_in_session', '', '_default', 'array');
			$save_full_elname_in_session = @$save_full_elname_in_session[0];
			$save_in_session = $params->get('save_insession', '', '_default', 'array');
			$save_in_session = @$save_in_session[0];
	 		$this->_params->append_jump_url = $append_jump_url;
	 		$w = new FabrikWorker(); 
	 		$this->_params->jumpPage = $w->parseMessageForPlaceHolder( $jumpPage, $formModel->_formData );
	 		$this->_params->thanksMessage = $w->parseMessageForPlaceHolder( $thanksMessage );
	 		$this->_params->save_full_elname_in_session = $save_full_elname_in_session;
	 		$this->_params->save_in_session = $save_in_session;
		}
 	}
 	
 	/**
 	 * process the plugin, called afer form is submitted
 	 *
 	 * @param object $params
 	 * @param object form
 	 */

 	function onAfterProcess( $params, &$formModel )
	{
 		global $mainframe;
 		$w =& new FabrikWorker(); 
 		$this->_processParams( $params, $formModel );
 		$form = $formModel->getForm();
 		if ($this->_params->jumpPage != '') {
			$this->_params->jumpPage = $this->_buildJumpPage ( $formModel );
			if (JRequest::getVar('fabrik_postMethod', '') != 'ajax') {
				//dont redirect if form is in part of a package 
				$mainframe->redirect( $this->_params->jumpPage );
			}
		} else {
			$message = $w->parseMessageForPlaceHolder( $params->get('thanks_message') );
			//stop joomla redirecting
			$this->_result = false;
			$this->displayThanks( $form->label, $message );
		}
		return true;
	}
	
	/**
	 * once the form has been sucessfully completed, and if no jump page is
	 * specified then show the thanks message
	 * @param string thanks message title
	 * @param string thanks message string
	 */
	 
	function displayThanks( $title, $message )
	{
		require_once( JPATH_SITE . "/includes/HTML_toolbar.php" );
		?>
		<div class="componentheading"><?php echo $title ?></div>
		<p><?php echo $message ?></p>
		<?php
	}
	
	/**
	 * alter the returned plugin manager's result
	 *
	 * @param string $method
	 * @return bol
	 */
	
	
	function customProcessResult( $method )
	{
		if( $method != 'onAfterProcess') {
			return true;
		}
		if (JRequest::getVar('fabrik_postMethod', '') != 'ajax') {
			//return false to stop the default redirect occuring
			return false;
		} else {
			return true;
		}
	}
													
	/**
	 * takes the forms data and merges it with the jump page
	 * @param object form
	 * @return new jump page
	 */

	function _buildJumpPage( &$formModel )
	{
		global $Itemid;
		$jumpPage = $this->_params->jumpPage;
		
		$reserved = array( 'format','view','layout' );
		$queryvars = array();
		$useFullName  = $this->_params->save_full_elname_in_session;
		if ($this->_params->append_jump_url == '1') {
			foreach ($formModel->_formData as $key=>$val) {
				if (in_array( $key, $reserved )) {
					continue;
				}
				if (!strstr( $jumpPage, "$key=" )) {
					if ($val != '') {
						if ($val != '-1') {
							if (!$useFullName) {
								$bits = explode( $formModel->_joinTableElementStep, $key );
								$key = array_pop( $bits );
							}
							if (is_array( $val )) {
								foreach ($val as $subval) {
									/* used if we want to pass data out of joomla/fabrik to another site */
									$queryvars[] = $key . "[]=$subval";
									$queryvars[] = $key . "[value][]=$subval";
								}
							} else {
								/* used if we want to pass data out of joomla/fabrik to another site */
								$queryvars[] = $key . "=$val";
								$queryvars[] = $key . "[value]=$val";
							}
						}
					}
				}
			}
		}
		$fromModule 		 = JRequest::getBool( 'fabrik_frommodule', 0 );
		if ($fromModule == '1') {
			$queryvars[] =  "frommodule=1";
		}
		if (array_key_exists( 'fabrik', $_SESSION )) {
			if (array_key_exists( $formModel->_id,  $_SESSION["fabrik"] )) {
				unset( $_SESSION["fabrik"][$formModel->_id] );
			}
		}	
		if ($this->_params->save_in_session == '1') {
			foreach ($formModel->_formData as $key => $value) {
				if ($formModel->hasElement( $key )) {
					if (!$useFullName) {
						$bits = explode( $formModel->_joinTableElementStep, $key );
						$key = array_pop( $bits );
					}
					$value = urlencode( stripslashes( $value ) );
					$_SESSION["fabrik"][$formModel->_id]["$key"] = array('type'=>'', 'value'=>$value, 'match'=>false);
				}
			}
			$_SESSION["fabrik"]['fromForm'] = $formModel->_id;
		}
		if ( (!strstr( $jumpPage, COM_FABRIK_LIVESITE ) && strstr($jumpPage, 'http')) || empty($queryvars) ){
			return $jumpPage;
		}
		if (!strstr( $jumpPage, "?" ) ) {
			$jumpPage .= "?";
		}
		if (!strstr( $jumpPage, "&Itemid=" )) {
			/* if the jump url contains an item id we shouldnt add the forms item id to it*/
			$queryvars[] = "&Itemid=$Itemid";
		}
		$jumpPage .= implode('&', $queryvars);
		return $jumpPage;
	}

}
?>