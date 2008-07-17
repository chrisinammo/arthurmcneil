<?php
/**
* @package Joomla
* @subpackage Fabrik
* @copyright Copyright (C) 2005 Rob Clayburn. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

/**
 * compat with php < 5.1
 */
if ( !function_exists('htmlspecialchars_decode') )
{
    function htmlspecialchars_decode($text)
    {
        return strtr($text, array_flip(get_html_translation_table(HTML_SPECIALCHARS)));
    }
}

/*
 * generic tools that all models use
 * This code used to be in models/parent.php
 */

class FabrikWorker {

	
	function isReserved( $str )
	{
		$_reservedWords = array("fabrik_frommodule", "act","task", "view", "layout", "option", "form_id", "submit", "ul_max_file_size", "ul_file_types", "ul_directory", "tableid", 'rowid', 'itemid', 'fabrik', 'adddropdownvalue', 'adddropdownlabel', 'ul_end_dir');
		if(in_array( strtolower( $str ), $_reservedWords)) {
			return true;
		}
		return false;
	}
	
	/**
	 * takes a field name and quotes it 
	 * - e.g. 
	 * "table.element" becomes "`table`.`element`
	 * "element" becomes `element`
	 * "table___element" becomes "`table___element`"
	 * 
	 * @param string
	 * @return string  
	 */

	function getDbSafeName( $str )
	{
		if( strstr( $str, '`' )) {
			return $str;
		}
		if (strstr( $str, '.' )) {
			$safeKey = explode('.', $str);
			$safeKey = "`" . $safeKey[0] . "`.`" . $safeKey[1] . "`";
		} else {
			$safeKey = "`$str`";
		}
		return $safeKey;
	}
	
		/**
	 * takes a quoted db field name and returns fabrik safe name 
	 * - e.g. 
	 * "`table`.`element`" becomes "table___element"
	 * 
	 * @param string
	 * @return string  
	 */
	
	function getFabrikSafeName( $str )
	{
		if (strstr( $str, '.' )) {
			$str = explode('.', $str);
			$str = $str[0] . "___" . $str[1];
		}
		$str = str_replace("`", "", $str);
		return $str;
	}
		
	/**
	 * iterates through string to replace every
	 * {placeholder} with posted data
	 * @param string text to parse
	 * @param array data to search for placeholders (default $_POST)
	 */
	 
	function parseMessageForPlaceHolder( $msg, $searchData = null )
	{
		if ($msg == '') {
			return $msg;
		}
		$post	= JRequest::get( 'post' );
		$this->_searchData =(is_null( $searchData ) ) ?  $post :  array_merge( $searchData, $post );
		$msg = FabrikWorker::_replaceWithUserData( $msg );
		$msg = FabrikWorker::_replaceWithGlobals( $msg );
		$msg = preg_replace( "/{}/", "", $msg ); 
		/* replace {element name} with form data */
		$msg = preg_replace_callback( "/{[^}]+}/i", array( $this, '_replaceWithFormData'), $msg );
		return $msg;
	}
	
 	function getACLGroups( $val, $cond = '>=' )
 	{
	 	$db =& JFactory::getDBO();
	 	$sql = "SELECT name FROM #__core_acl_aro_groups WHERE id $cond '$val' AND id < 28";
	 	$db->setQuery( $sql );
	 	$res = $db->loadResultArray();
		return $res;
	 }
	
	function setACL( $action, $task, $coponent, $userGroup, $a=null, $b=null, $c=null )
	{
		$acl =& JFactory::getACL();
		$acl->addACL( $action, $task, $coponent, $userGroup, $a, $b, $c );
	}
	
	
	/**
	 * PRIVATE:
	 * called from parseMessageForPlaceHolder to iterate through string to replace
	 * {placeholder} with user ($my) data
	 * @param string message to parse
	 * @return string parsed message
	 */
	
	function _replaceWithUserData( $msg )
	{
		$user  = &JFactory::getUser();
		if (is_object( $user )) {
			foreach ($user as $key=>$val) {
				if (substr( $key, 0, 1 ) != '_') {
					if (!is_object( $val )) {
						$msg = str_replace( '{$my->' . $key . '}', $val, $msg );
						$msg = str_replace( '{$my-&gt;' . $key . '}', $val, $msg );
					}
				}
			}
		}
		return $msg;		
	}
	

	/**
	 * PRIVATE:
	 * called from parseMessageForPlaceHolder to iterate through string to replace
	 * {placeholder} with global data
	 * @param string message to parse
	 * @return string parsed message
	 */
	
	function _replaceWithGlobals( $msg )
	{
		global $Itemid;
		$config		=& JFactory::getConfig();
		$msg = str_replace( '{$mosConfig_absolute_path}', JPATH_SITE, $msg );
		$msg = str_replace( '{$mosConfig_live_site}', JURI::base(), $msg );
		$msg = str_replace( '{$mosConfig_offset}', $config->getValue( 'offset' ), $msg );
		$msg = str_replace( '{$Itemid}', $Itemid, $msg );
		$msg = str_replace( '{$mosConfig_sitename}', $config->getValue( 'sitename' ), $msg );
		$msg = str_replace( '{$mosConfig_mailfrom}',$config->getValue( 'mailfrom' ), $msg );
		return $msg;		
	}
	
	/**
	 * PRVIATE:
	 * called from parseMessageForPlaceHolder to iterate through string to replace
	 * {placeholder} with posted data
	 * @param string placeholder e.g. {placeholder}
	 * @return string posted data that corresponds with placeholder
	 */
	 
	function _replaceWithFormData( $matches )
	{
		$match = $matches[0];
		/* strip the {} */
		$match = substr( $match, 1, strlen($match) - 2 ); 
		$match = strtolower( $match ); 
		$match = preg_replace( "/ /", "_", $match ); 
		if ( !strstr( $match, "." ) ) {
			 /* for some reason array_key_exists wasnt working for nested arrays?? */
			$aKeys = array_keys( $this->_searchData );
			/* remove the table prefix from the post key */
			$aPrefixFields = array();
			for ($i=0; $i<count( $aKeys ); $i++) {
				$aKeyParts = explode( '___', $aKeys[$i]);
				
				if (count( $aKeyParts ) == 2) {
					$tablePrefix = array_shift($aKeyParts);
					$field = array_pop($aKeyParts);
					$aPrefixFields[$field] = $tablePrefix;
				}
			}
			if (array_key_exists( $match, $aPrefixFields )) {
				$match =  $aPrefixFields[$match] . '___' . $match;
			}

			//test to see if the made match is in the post key arrays

			if( in_array( $match, $aKeys ) ) {	
				 /* get the post data */
			    $match = $this->_searchData[ $match ];
			    if( is_array( $match ) ){
			    	$match = implode( ',', $match);
			    }
			} else {
				$match = "";
			}
		} else {
			/* could be looking for URL field type eg for $_POST[url][link] the match text will be url.link */
			$aMatch = explode( ".", $match );
			$aPost = $this->_searchData;
			foreach ($aMatch as $sPossibleArrayKey) {
				if (is_array( $aPost )) {
					if (!isset( $aPost[$sPossibleArrayKey] )) {
						$match = "";
						return $match;
					} else {
						$aPost = $aPost[$sPossibleArrayKey];
					}
				}
			}
			$match = $aPost;
			return $match;
		}
		return $match;
	}
}
?>