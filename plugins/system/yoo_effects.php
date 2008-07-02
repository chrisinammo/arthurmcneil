<?php
/**
* YOOeffects Joomla! Plugin
*
* @author    yootheme.com
* @copyright Copyright (C) 2007 YOOtheme Ltd. & Co. KG. All rights reserved.
* @license	 GNU/GPL
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

$mainframe->registerEvent( 'onAfterDispatch', 'plgSystemYOOeffects' );

/**
* Plugin that adds various effects like lightbox, reflection, spotlight 
*/
function plgSystemYOOeffects() {

	$app =& JFactory::getApplication();

	// check if site is active
	if($app->getName() != 'site') {
		return true;
	}
	
	// get plugin info
	$plugin =& JPluginHelper::getPlugin('system', 'yoo_effects');
 	$params = new JParameter($plugin->params);

	// check whether plugin has been unpublished
	if (!$params->get('enabled', 1)) {
		return true;
	}

	$lightbox    = $params->get('lightbox', 1);
	$reflection  = $params->get('reflection', 1);
	$spotlight   = $params->get('spotlight', 1);
	$gzip        = $params->get('gzip', 1);
	$plugin_base = JURI::base() . 'plugins/system/yoo_effects/';
	$javascript  = '';

	if ($lightbox) $javascript .= '<script type="text/javascript">var YOOeffects = { url: \'' . $plugin_base . 'lightbox/\' };</script>' . "\n";
	
	if ($gzip) {
		if ($lightbox || $reflection || $spotlight) {
			$javascript .= '<script type="text/javascript" src="' . $plugin_base . 'yoo_effects.js.php?lb=' . $lightbox . '&amp;re=' . $reflection . '&amp;sl=' . $spotlight . '"></script>' . "\n";	}
	} else {
		if ($lightbox) $javascript .= '<script type="text/javascript" src="' . $plugin_base . 'lightbox/shadowbox_packed.js"></script>' . "\n";
		if ($reflection) $javascript .= '<script type="text/javascript" src="' . $plugin_base . 'reflection/reflection_packed.js"></script>' . "\n";
		if ($spotlight) $javascript .= '<script type="text/javascript" src="' . $plugin_base . 'spotlight/spotlight_packed.js"></script>' . "\n";
	}

	// add javascript and css
	$document =& JFactory::getDocument();
	if ($javascript) $document->addCustomTag($javascript);
	if ($lightbox) $document->addStyleSheet($plugin_base . 'lightbox/shadowbox.css');	
}