<?php
/**
* YOOcarousel Joomla! Module
*
* @author    yootheme.com
* @copyright Copyright (C) 2007 YOOtheme Ltd. & Co. KG. All rights reserved.
* @license	 GNU/GPL
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

global $mainframe;

// count instances
if (!isset($GLOBALS['yoo_carousels'])) {
	$GLOBALS['yoo_carousels'] = 1;
} else {
	$GLOBALS['yoo_carousels']++;
}

// include the syndicate functions only once
require_once (dirname(__FILE__).DS.'helper.php');

// disable edit ability icon
$access = new stdClass();
$access->canEdit	= 0;
$access->canEditOwn = 0;
$access->canPublish = 0;

$list = modYOOcarouselHelper::getList($params, $access);

// check if any results returned
$items = count($list);
if (!$items) {
	return;
}

// init vars
$style                 = $params->get('style', 'default');
$module_width          = $params->get('module_width', '400');
$module_height         = $params->get('module_height', '200');
$slide_interval        = $params->get('slide_interval', '3000');
$transition_effect     = $params->get('transition_effect', 'scroll');
$transition_duration   = $params->get('transition_duration', '700');
$control_panel         = $params->get('control_panel', 'top');
$rotate_action         = $params->get('rotate_action', 'click');
$rotate_duration       = $params->get('rotate_duration', '100');
$rotate_effect         = $params->get('rotate_effect', 'scroll');
$buttons               = $params->get('buttons', '1');
$autoplay              = $params->get('autoplay', 'on');
$module_base           = JURI::base() . 'modules/mod_yoo_carousel/';

// css parameters
$carousel_id           = 'yoo-carousel-' . $GLOBALS['yoo_carousels'];

switch ($style) {
	case "basic":
		$tab_height    = 30;
		$control_panel = ($control_panel == "top" || $control_panel == "bottom") ? $control_panel : "top";
   		break;
	case "slideshow":
		$tab_height    = 0;
		$control_panel = "none";
   		break;
	case "list":
		$tab_width     = 240;
		$control_panel = "left";
   		break;
	case "basiclist":
		$tab_width     = 190;
		$control_panel = "left";
   		break;
	default:
		$tab_height    = 40;
		$control_panel = "top";
}

if ($style == "list" || $style == "basiclist") {
	$panel_width             = $module_width - $tab_width;
	$panel_width             = ($style ==  "basiclist") ? $panel_width - 4 : $panel_width; /* only for basiclist styling */
	$panel_height            = ($style ==  "list") ? $module_height - 40 : $module_height - 4;
	$css_tab_width           = 'width: ' . $tab_width . 'px;';
	$css_module_width        = 'width: ' . $module_width . 'px;';
	$css_module_height       = 'height: ' . $module_height . 'px;';
	$css_panel_width         = 'width: ' . $panel_width . 'px;';
	$css_panel_height        = 'height: ' . $panel_height . 'px;';
	$css_total_panel_width   = 'width: ' . ($panel_width * $items + 3) . 'px;';
} else {
	$button_width            = ($style ==  "default") ? 50 : 0; /* only for default styling */
	$panel_width             = ($buttons) ? $module_width - (2 * $button_width) : $module_width;
	$panel_width             = ($style ==  "basic") ? $panel_width - 4 : $panel_width; /* only for basic styling */
	$panel_height            = ($control_panel != "none") ? $module_height - $tab_height : $module_height;
	$panel_height            = ($style ==  "basic") ? $panel_height - 2 : $panel_height; /* only for basic styling */
	$css_module_width        = 'width: ' . $module_width . 'px;';
	$css_module_height       = 'height: ' . $module_height . 'px;';
	$css_total_module_width  = 'width: ' . ($module_width * $items + 3) . 'px;';
	$css_panel_width         = 'width: ' . $panel_width . 'px;';
	$css_panel_height        = 'height: ' . $panel_height . 'px;';
	$css_total_panel_width   = 'width: ' . ($panel_width * $items + 3) . 'px;';
}

// js parameters
$javascript = "new YOOcarousel('" . $carousel_id . "', { transitionEffect: '" . $transition_effect . "', transitionDuration: " . $transition_duration . ", rotateAction: '" . $rotate_action . "', rotateActionDuration: " . $rotate_duration . ", rotateActionEffect: '" . $rotate_effect . "', slideInterval: " . $slide_interval . ", autoplay: '" . $autoplay . "' });";

switch ($style) {
	case "basic":
		require(JModuleHelper::getLayoutPath('mod_yoo_carousel', 'basic'));
   		break;
	case "slideshow":
		require(JModuleHelper::getLayoutPath('mod_yoo_carousel', 'slideshow'));
   		break;
	case "list":
		require(JModuleHelper::getLayoutPath('mod_yoo_carousel', 'list'));
   		break;
	case "basiclist":
		require(JModuleHelper::getLayoutPath('mod_yoo_carousel', 'basiclist'));
   		break;
	default:
		require(JModuleHelper::getLayoutPath('mod_yoo_carousel', 'default'));
}

$document =& JFactory::getDocument();
$document->addStyleSheet($module_base . 'mod_yoo_carousel.css.php');
$document->addScript($module_base . 'mod_yoo_carousel.js');
echo "<script type=\"text/javascript\">\n// <!--\n$javascript\n// -->\n</script>\n";
