<?php

/**
* @package Joomla
* @subpackage Fabrik
* @copyright Copyright (C) 2005 Rob Clayburn. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

jimport('joomla.application.component.model');


class FabrikModelFormsession extends JModel {
 	
 	/**
	 * constructor
	 */

	var $userid = null;
	
	var $hash = null;
	
	var $formid = null;
	
	var $rowid = null;
	
	/** @var string status message */
	var $status = null;
	
	function __construct()
	{
		parent::__construct();
	}


	function savePage()
	{
		$data 	= serialize($_POST);
		$hash 	= $this->getHash();
		$userid = $this->getUserId();
		$user 		=& JFactory::getUser();
		$row 			= $this->load();
	 	$row->hash = $hash;
	 	$row->user_id = $user->get('id');
	 	$row->form_id = $this->getFormId();
	 	$row->row_id = $this->getRowId();
	 	$row->last_page = JRequest::getVar('page');
	 	$row->referring_url  = $_SERVER['HTTP_REFERER'] ;
	 	$row->data  = $data;
	 	$this->setCookie( $row );
	 	if ($row->user_id != 0) {
		 	if (!$row->store( )) {
				echo $row->getError();
			}
	 	}
	}
	
	function setCookie( &$row )
	{
			jimport('joomla.utilities.simplecrypt');
			jimport('joomla.utilities.utility');
			$hash = $this->getHash();
			//Create the encryption key, apply extra hardening using the user agent string
			$key = JUtility::getHash(@$_SERVER['HTTP_USER_AGENT']);
			$crypt = new JSimpleCrypt($key);
			
			$rcookie = $crypt->encrypt(serialize($row));
			$lifetime = time() + 365*24*60*60;
			setcookie( $hash, $rcookie, $lifetime, '/' );
	}
	
	function removeCookie()
	{
		$hash = $this->getHash();
		$lifetime = time() -1800;
		setcookie( $hash, false, time() - 86400, '/' );
	}

	/**
	 * load in the saved session
	 *
	 * @return object session table row
	 */
	
	function load()
	{
		$row 		=& $this->getTable();
		$hash 	= $this->getHash();
		$row->_tbl_key = 'hash';
		$row->load( $hash );
		$row->_tbl_key = 'id';
		if(is_null($row->id)){
			//no db session see if there is a cookie we can load 
			jimport('joomla.utilities.simplecrypt');
			jimport('joomla.utilities.utility');
			$key = JUtility::getHash(@$_SERVER['HTTP_USER_AGENT']);
			$crypt = new JSimpleCrypt($key);
			if (array_key_exists( $hash, $_COOKIE )) {
				$this->status = JText::_('Loading from cookie');
				$row = unserialize($crypt->decrypt($_COOKIE[$hash]));
			}
		} else {
			$this->status = JText::_('Loading from database');
		}
		$this->last_page = $row->last_page;
		return $row;
	}
	
	/**
	 * remove the saved session 
	 *
	 */
	function remove()
	{
		$row 		=& $this->getTable();
		$hash 	= $this->getHash();
		$row->_tbl_key = 'hash';
		$k = $row->_tbl_key;
		$row->$k = $hash;
		$query = 'DELETE FROM '.$row->_db->nameQuote( $row->_tbl ).
				' WHERE '.$row->_tbl_key.' = '. $row->_db->Quote($hash);
		$row->_db->setQuery( $query );
		$row->_tbl_key = 'id';
		$this->removeCookie();
		if ($row->_db->query())
		{
			return true;
		}
		else
		{
			$row->setError($row->_db->getErrorMsg());
			return false;
		}
	}

	/**
	 * get the hash identifier
	 *
	 * @return string hash
	 */
	
	function getHash()
	{
		$userid = $this->getUserId();
		if (is_null( $this->hash )) {
			$this->hash = $userid.":".$this->getFormId().":".$this->getRowId();
		}
		return $this->hash;
	}
	
	function getUserId()
	{
		$user 		=& JFactory::getUser();
		return $user->get('id');
		/*$session 	=& JFactory::getSession();
		if (is_null( $this->userid )) {
			$this->userid = ($user->get('id') != 0) ? $user->get('id') : $session->getToken() ;
		}
		return $this->userid;*/
	}
	
	function setFormId( $id )
	{
		$this->formid = $id;
	}
	
	function setRowId( $id )
	{
		$this->rowid = $id;
	}
	
	/**
	 * gets the row id - if not set uses request 'rowid' var
	 *
	 * @return unknown
	 */
	
	function getRowId()
	{
		if (is_null( $this->rowid )) {
			$this->rowid = JRequest::getVar('rowid');
		}
		return $this->rowid;
	}
	
	/**
	 * gets the row id - if not set uses request 'rowid' var
	 *
	 * @return unknown
	 */
	
	function getFormId()
	{
		if (is_null( $this->formid )) {
			$this->formid = JRequest::getVar('fabrik');
		}
		return $this->formid;
	}
 }
?>