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
 * static class to provide access to output modifier functions
 */
class fabrikModifier {
	
	function truncate( $text, $opts = array() ){
		$orig = $text;
		$text = strip_tags( $text);
		$wordCount = array_key_exists('wordcount', $opts) ? $opts['wordcount'] : 10;
		$showTip = array_key_exists('tip', $opts) ? $opts['tip'] : true;
		$title = array_key_exists('title', $opts) ? $opts['title'] : "tip";
		$text = explode(" ", $text);
		$text = array_slice( $text, 0, $wordCount);
		$text = implode( " ", $text ) . " ...";
		if ($showTip) {
			JHTML::_('behavior.tooltip');
			$text = "<span class='hasTip' title='$title::$orig'>$text</span>";
		}
		return $text;
	}
	
}
?>