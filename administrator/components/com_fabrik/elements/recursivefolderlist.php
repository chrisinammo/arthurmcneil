<?php
/**
* @package Joomla
* @subpackage Fabrik
* @copyright Copyright (C) 2005 Rob Clayburn. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/

// Check to ensure this file is within the rest of the framework
defined('JPATH_BASE') or die();

/**
 * Renders a filelist element
 *
 * @author 		Andrew Eddie
 * @package 	Joomla.Framework
 * @subpackage		Parameter
 * @since		1.5
 */

class JElementRecursivefolderlist extends JElement
{
	/**
	* Element name
	*
	* @access	protected
	* @var		string
	*/
	var	$_name = 'Recursivefolderlist';

	function fetchElement($name, $value, &$node, $control_name)
	{
		jimport( 'joomla.filesystem.folder' );
		// path to images directory
		$path		= JPATH_ROOT.DS.$node->attributes('directory');
		$filter		= $node->attributes('filter');
		$exclude	= $node->attributes('exclude');
		$recursive	= ( $node->attributes('recursive') == 1 ) ? true : false;
		$folders	= JFolder::folders($path, $filter, $recursive);
		$folders = $this->recursive_listdir( $path , $node );
		$options = array ();
		foreach ($folders as $key=>$folder)
		{
			if ($exclude)
			{
				if (preg_match( chr( 1 ) . $exclude . chr( 1 ), $folder )) {
					continue;
				}
			}
			$options[] = JHTML::_('select.option', $key, $folder);
		}

		if (!$node->attributes('hide_none')) {
			array_unshift($options, JHTML::_('select.option', '-1', '- '.JText::_('Do not use').' -'));
		}

		if (!$node->attributes('hide_default')) {
			array_unshift($options, JHTML::_('select.option', '', '- '.JText::_('Use default').' -'));
		}

		return JHTML::_('select.genericlist',  $options, ''.$control_name.'['.$name.']', 'class="inputbox"', 'value', 'text', $value, "param$name");
	}
	
	/**
	* a recursive method to return a list of all folders from a given parent directory
	* @param string parent directory
	* @return array child directories of parent directory
	*/
	
	function recursive_listdir( $base, &$node ) {
		static $filelist = array( );
		static $dirlist = array( );
		if ( is_dir( $base ) ) {
			$dh = opendir( $base );
			if ( $dh != false ) {
				while ( false !== ( $dir = readdir( $dh ) ) ) {
					if ( is_dir( $base."/".$dir ) && $dir !== '.' && $dir !== '..' && strtolower( $dir ) !== 'cvs' ) {
						$subbase = $base."/".$dir;
						$key = ltrim(str_replace(JPATH_ROOT, '', $subbase), "\\");
						$dirlist[$key] = str_replace($node->attributes('directory'), '', $key);
						$subdirlist = $this->recursive_listdir( $subbase, $node );
					}
				}
				closedir( $dh );
			}
		}
		return $dirlist;
	}
}