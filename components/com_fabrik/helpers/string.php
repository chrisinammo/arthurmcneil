<?php
/**
* @package Joomla
* @subpackage Fabrik
* @copyright Copyright (C) 2005 Rob Clayburn. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();


class FabrikString extends JString{
	
	/**
	 * UTF-8 aware - replace the first word
	 *
	 * @static
	 * @access public
	 * @param string the string to be trimmed
	 * @param string the word to trim
	 * @return string the trimmed string
	*/
	function ltrimword( $str, $word = FALSE )
	{
		$pos = strpos($str,$word);
		if ($pos === 0) { // true ? then exectue! 
			$str = JString::substr($str, strlen($word));	
		}
		return $str;
	}
	
	
	function rtrimword( &$str, $word = false)
	{
		$l = strlen($word);
		$end = substr($str, -$l);
		if($end === $word){
			return substr($str, 0, strlen($str)-$l);
		}else{
			return $str;
		}
	}
	/**
	 * formats a string to return a safe db col name - eg
	 * table.field is returned as `table`.field`
	 * table is return as table`
	 *
	 * @param mixed $col col name to format 
	 */
	
	function safeColName( &$col )
	{
		if (!strstr( $col, "`" )) {
			if (strstr( $col, "." )) {
				$col = explode(".", $col);
				$col = "`" . $col[0] . "`.`" . $col[1] . "`";
			}	else {
				$col = "`" . $col . "`";		
			}
		}
	}
}
?>