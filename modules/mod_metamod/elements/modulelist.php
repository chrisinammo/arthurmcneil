<?php
/**
* @version		1.5d
* @copyright	Copyright (C) 2007-2008 Stephen Brandon
* @license		GNU/GPL
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

class JElementModulelist extends JElement
{
	/**
	 * Element name
	 *
	 * @access	protected
	 * @var		string
	 */
	var	$_name = 'Modulelist';

	function fetchElement($name, $value, &$node, $control_name)
	{
		$db = &JFactory::getDBO();
		
		$query = "SELECT id, title, module, position"
		. "\n FROM #__modules"
		. "\n WHERE published = 1"
		. "\n AND client_id != 1"
		. "\n ORDER BY title"
		;
		
		$db->setQuery( $query );
		$options = $db->loadObjectList( );

		$r = '<style>
			table.modulelist td,
			table.modulelist th {padding:0.1em 0.5em; margin:0.1em; height:auto;}
			table.modulelist td.modid {text-align:right;}
			table.modulelist th.modid {text-align:right;}
			</style>
		<table class="modulelist" cellpadding="0" cellspacing="0" border="0">
		<tr><th>name</th><th class="modid">id</th><th>type</th><th>position (ignored)</th></tr>';
		foreach ($options as $o) {
			$r .= "<tr>\n";
			$r .= "<td>".$o->title.'</td><td class="modid"><b>'.$o->id.'</b></td><td>'.$o->module.'</td><td>'.$o->position.'</td>';
			$r .= "</tr>\n";
		}
		$r .= "</table>";
		return $r;
	}
}