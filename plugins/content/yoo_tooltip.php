<?php
/**
* YOOtooltip Joomla! Plugin
*
* @author    yootheme.com
* @copyright Copyright (C) 2007 YOOtheme Ltd. & Co. KG. All rights reserved.
* @license	 GNU/GPL
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

$mainframe->registerEvent( 'onPrepareContent', 'plgContentYOOtooltip' );

/**
* Plugin that creates tooltips within content
*/
function plgContentYOOtooltip( &$row, &$params, $page=0 ) {
	$db =& JFactory::getDBO();
	// simple performance check to determine whether bot should process further
	if (JString::strpos($row->text, 'yootooltip') === false) {
		return true;
	}

	// Get plugin info
	$plugin =& JPluginHelper::getPlugin('content', 'yoo_tooltip');

 	// expression to search for
	$regex = "#{yootooltip\s*(.*?)}(.*?){/yootooltip}#s";

 	$pluginParams = new JParameter( $plugin->params );

	// check whether plugin has been unpublished
	if ( !$pluginParams->get( 'enabled', 1 ) ) {
		$row->text = preg_replace($regex, '', $row->text);
		return true;
	}

	// add javascript and css
	$document =& JFactory::getDocument();
	$document->addScript(JURI::base() . 'plugins/content/yoo_tooltip/yoo_tooltip.js');
	$document->addStyleSheet(JURI::base() . 'plugins/content/yoo_tooltip/yoo_tooltip.css.php');

	// perform the replacement
	preg_match_all($regex, $row->text, $matches);
 	$count = count($matches[0]);
 	if ($count) {
 		plgContentYOOtooltipReplace($row, $matches, $count, $regex, $pluginParams);
	}
}

function plgContentYOOtooltipReplace(&$row, &$matches, $count, $regex, $params) {
 	$style = $params->get('style', 'default');
	
	for ($i = 0; $i < $count; $i++) {
		$replace      = '';
		$param_line   = $matches[1][$i];
		$tooltip_text = $matches[2][$i];
		$mode         = plgContentYOOtooltipGetParam($param_line, 'mode', $params->get('mode', 'cursor'));
		$display      = plgContentYOOtooltipGetParam($param_line, 'display', 'inline');
		$title        = plgContentYOOtooltipGetParam($param_line, 'title', 'Tooltip');
		$width        = plgContentYOOtooltipGetParam($param_line, 'width', $params->get('width', 300));
		$sticky       = plgContentYOOtooltipGetParam($param_line, 'sticky', $params->get('sticky', 0));

		if ($tooltip_text != '') {
			// count tooltips
			!isset($GLOBALS['yoo_tooltips']) ? $GLOBALS['yoo_tooltips'] = 1 : $GLOBALS['yoo_tooltips']++;
			// create tooltip
			$id       = 'yoo-tooltip-' . $GLOBALS['yoo_tooltips'];
			$replace  = '<div id="' . $id . '" class="yoo-tooltip-toggler">' . plgContentYOOtooltipStripText($title) . '</div>';
			$replace .= "<script type=\"text/javascript\">new YOOtooltip('". $id ."', '" . plgContentYOOtooltipStripText($tooltip_text) . "', { mode: '" . $mode . "', display: '" . $display . "', width: " . $width . ", style: '" . $style . "', sticky: " . $sticky . " });</script>";
		}

		$row->text = str_replace($matches[0][$i], $replace, $row->text);
 	}
}

function plgContentYOOtooltipGetParam($param_line, $attribute, $default = null) {
    $matches = array();
    preg_match_all('/(\w+)(\s*=\s*\[.*?\])/s', $param_line, $matches);

    for ($i = 0; $i < count($matches[1]); $i++) {
		if (strtolower($matches[1][$i]) == strtolower($attribute)) {
        	$result = ltrim($matches[2][$i], " \n\r\t=");
			$result = trim($result, '[]');        
        	return $result;
      	}
    }
	
    return $default;
}

function plgContentYOOtooltipStripText($text) {
	$text = str_replace(array("\r\n", "\n", "\r", "\t"), "", $text);
	$text = addcslashes($text, "'");
	return $text;
}