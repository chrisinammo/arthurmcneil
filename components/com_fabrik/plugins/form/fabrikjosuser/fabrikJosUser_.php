<?php

/**
* Create a Joomla user from the forms data
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

class FabrikModelfabrikJosUser extends FabrikModelFormPlugin {
 	
	/**
	* Constructor
	*/
var $_counter = null;

	function __construct()
	{
		parent::__construct();
	}
	
	/**
	 * show a new for entering the form actions options 
	 */
 	
 	function renderAdminSettings( $elementId, &$row, &$params, $lists, $c ){
 		$params->_counter_override = $this->_counter;
 		$display =  ($this->_adminVisible) ? "display:block" : "display:none";
 		$return = '<div class="page-' . $elementId . ' elementSettings" style="' . $display . '">
 		'. $params->render('params', '_default', false, $c)
 		.'</div>
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

 	function onBeforeStore( $params, &$oForm ){
		$db =& JFactory::getDBO();
		
 		$aData 		= $oForm->_formData;
 		$key = $params->get('josuser_fieldid');
 		$data = array();
 		foreach($oForm->_formData as $key => $val){
 			$key = array_pop(explode("___" , $key ));
 			$data[$key] = $val;
 		}
 		
 		$user = new JTableUser( $db );
 		
 		$user->bind( $data );
 		$user->password = md5(trim($user->password));
 		$isVendor 		= $params->get('josuser_make_vm_vendor', 0);
 		$isVMShopper 	= $params->get('josuser_make_vm_shopper', 0);
 		$makeCBProfile 	= $params->get('josuser_make_cb_profile', 1);
 		if( $isVendor ){
 			$user->gid = 19;
 		} else {
 			$user->gid = 18;
 		}
		if(!$user->check()){
			$this->_err = $user->_error;
 			return false;
		}
 		$ok = $user->store();

 		if($isVMShopper){
	 		$db->setQuery( "insert into #__vm_shopper_vendor_xref (`user_id`,	`vendor_id`, `shopper_group_id`) values ('$oUser->id','1','5')");
	 		$db->query();
	 		
	 		$db->setQuery("insert into #__vm_auth_user_vendor (`user_id, `vendor_id`) values ('$oUser->id','1')");
	 		$db->query();
	 		
	 		$company 			= JRequest::getVar( 'jos_users___vendor_name', '', 'post' );
			$contact_last_name 	= JRequest::getVar( 'jos_users___contact_last_name', '', 'post' );
			$contact_first_name = JRequest::getVar( 'jos_users___contact_first_name', '', 'post' );
			$contact_title 		= JRequest::getVar( 'jos_users___contact_title', '', 'post' );
			$contact_phone_1 	= JRequest::getVar( 'jos_users___contact_phone_1', '', 'post' );
			$contact_phone_2 	= JRequest::getVar( 'jos_users___contact_phone_2', '', 'post' );
			$contact_email	 	= JRequest::getVar( 'jos_users___email', '', 'post' );
			$vendor_phone 		= $contact_phone_1;
			$vendor_address_1 	= JRequest::getVar( 'jos_users___vendor_address_1', '', 'post' );
			$vendor_address_2 	= JRequest::getVar( 'jos_users___vendor_address_2', '', 'post' );
			$vendor_city 		= JRequest::getVar( 'jos_users___vendor_city', '', 'post' );
			$vendor_state 		= JRequest::getVar( 'jos_users___vendor_state', '', 'post' );
			$vendor_country 	= JRequest::getVar( 'GBR', '', 'post' ); 
			$vendor_zip 		= JRequest::getVar( 'jos_users___vendor_zip', '', 'post' );
			$jos_users___email 	= JRequest::getVar( 'jos_users___email', '', 'post' );
			
	 		$hash_secret = "VirtueMartIsCool";
	 		
	 		$q = "INSERT INTO #__vm_user_info (user_info_id, user_id,address_type,address_type_name,";
			$q .= "company,title,last_name,first_name,";
			$q .= "phone_1,phone_2,address_1,";
			$q .= "address_2,city,state,country,zip, user_email) VALUES ('";
			$q .= md5( uniqid( $hash_secret ))."', '$oUser->id', 'BT', '-default-', ";
			$q .= "'$company', '$contact_title', '$contact_last_name', '$contact_first_name', ";
			$q .= "'$contact_phone_1', '$contact_phone_2', '$vendor_address_1', '$vendor_address_2', '$vendor_city', '$vendor_state', '$vendor_country', '$vendor_zip',
			'$jos_users___email')";
			$db->setQuery($q);
			$db->query();
 		}
 		
 		if(!$ok){
 			$this->_err = $user->_error;
 			
 		}else{
 			$this->sendEmail( $user );
 			if( $isVendor ){
 				$this->createVendor($user);
 			}
 		}
 		if( $makeCBProfile ){
 			$this->createCombuilderProfile($user);
 			}
		return true;
	}
	
	function sendEmail( $oUser ){
		$config =& JFactory::getConfig();
		// check if Global Config `mailfrom` and `fromname` values exist
		if ($config->getValue( 'mailfrom' ) != '' && $config->getValue('fromname' ) != '') {
			$adminName2 	= $config->getValue( 'mailfrom' );
			$adminEmail2 	= $config->getValue('fromname' );
		} else {
		// use email address and name of first superadmin for use in email sent to user
			$query = "SELECT name, email"
			. "\n FROM #__users"
			. "\n WHERE LOWER( usertype ) = 'superadministrator'"
			. "\n OR LOWER( usertype ) = 'super administrator'"
			;
			$db->setQuery( $query );
			$rows = $db->loadObjectList();
			$row2 			= $rows[0];
	
			$adminName2 	= $row2->name;
			$adminEmail2 	= $row2->email;
		}
	
		// Send email to user
		mosMail($adminEmail2, $adminName2, $email, $subject, $message);
	
		// Send notification to all administrators
		$subject2 = sprintf ( _SEND_SUB, $name, $config->getValue( 'sitename' ) );
		$message2 = sprintf ( _ASEND_MSG, $adminName2, $config->getValue( 'sitename' ) , $oUser->name, $oUser->email, $oUser->username );
		$subject2 = html_entity_decode( $subject2, ENT_QUOTES );
		$message2 = html_entity_decode( $message2, ENT_QUOTES );
	
		// get email addresses of all admins and superadmins set to recieve system emails
		$query = "SELECT email, sendEmail"
		. "\n FROM #__users"
		. "\n WHERE ( gid = 24 OR gid = 25 )"
		. "\n AND sendEmail = 1"
		. "\n AND block = 0"
		;
		$db->setQuery( $query );
		$admins = $db->loadObjectList();
	
		foreach ( $admins as $admin ) {
			// send email to admin & super admin set to recieve system emails
			mosMail($adminEmail2, $adminName2, $admin->email, $subject2, $message2);
		}
	}
	
	function createVendor(&$oUser){
		$db =& JFactory::getDBO();;
		$vendor_name 		= JRequest::getVar( 'jos_users___vendor_name', '', 'post' );
		$contact_last_name 	= JRequest::getVar( 'jos_users___contact_last_name', '', 'post' );
		$contact_first_name = JRequest::getVar( 'jos_users___contact_first_name', '', 'post' );
		$contact_title 		= JRequest::getVar( 'jos_users___contact_title', '', 'post' );
		$contact_phone_1 	= JRequest::getVar( 'jos_users___contact_phone_1', '', 'post' );
		$contact_phone_2 	= JRequest::getVar( 'jos_users___contact_phone_2', '', 'post' );
		$contact_email 		= JRequest::getVar( 'jos_users___email', '', 'post' );
		$vendor_phone 		= $contact_phone_1;
		$vendor_address_1 	= JRequest::getVar( 'jos_users___vendor_address_1', '', 'post' );
		$vendor_address_2 	= JRequest::getVar( 'jos_users___vendor_address_2', '', 'post' );
		$vendor_city 		= JRequest::getVar( 'jos_users___vendor_city', '', 'post' );
		$vendor_state 		= JRequest::getVar( 'jos_users___vendor_state', '', 'post' );
		$vendor_country 	= JRequest::getVar( 'GBR', '', 'post' ); 
		$vendor_zip 		= JRequest::getVar( 'jos_users___vendor_zip', '', 'post' );
		$vendor_store_name 	= JRequest::getVar( 'jos_users___vendor_name', '', 'post' );
		$vendor_category_id = 6;
		$vendor_currency 	= 'GBP';
		$vendor_url 		= JRequest::getVar( 'jos_users___vendor_url', '', 'post' );
		$vendor_company_reg_num = JRequest::getVar( 'jos_users___vendor_company_reg_num', '', 'post' );
		$vendor_min_pov 	= 0;
		$user_id 			= $oUser->id;
		$vendor_vat_id  	= JRequest::getVar( 'jos_users___vendor_vat_id', '', 'post' );
		
		$sql = "INSERT INTO #__vm_vendor (`vendor_name`, `contact_last_name`, `contact_first_name`, 
		`contact_title`, `contact_phone_1`, `contact_phone_2`, `contact_email`, `vendor_phone`, 
		`vendor_address_1`, `vendor_address_2`, `vendor_city`, `vendor_state`, `vendor_country`, 
		`vendor_zip`, `vendor_store_name`,  `vendor_category_id`,  `vendor_currency`, `vendor_url`, 
		`vendor_min_pov`, `user_id`, `vendor_vat_id`, `vendor_company_reg_num`)
		VALUES ('$vendor_name', '$contact_last_name', '$contact_first_name', 
		'$contact_title', '$contact_phone_1', '$contact_phone_2', '$contact_email', '$vendor_phone', 
		'$vendor_address_1', '$vendor_address_2', '$vendor_city', '$vendor_state', '$vendor_country', 
		'$vendor_zip', '$vendor_store_name',  '$vendor_category_id',  '$vendor_currency', '$vendor_url', 
		'$vendor_min_pov', '$user_id', '$vendor_vat_id', '$vendor_company_reg_num')";
		$db->setQuery($sql);
		$db->query();
	}
	
	function createCombuilderProfile(&$oUser){
		$db =& JFactory::getDBO();;
		$contact_first_name =  JRequest::getVar( 'jos_users___contact_first_name', '', 'post' );
		$contact_last_name 	= JRequest::getVar( 'jos_users___contact_last_name', '', 'post' );
		$sql = "INSERT INTO #__comprofiler (`id`, `user_id`, `firstname`, `lastname`, `approved`, `confirmed`, `acceptedterms`)
		VALUES ('$oUser->id', '$oUser->id', '$contact_first_name', '$contact_last_name', 
		'1', '1', '1')";
		$db->setQuery($sql);
		$db->query();
	}

}
?>