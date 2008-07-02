<?php
/**
* @version	$Id: mod_slick_rss.php 9764 2008-03-22 17:32:11Z davidwhthomas $
* @package	Joomla 1.5
* @copyright	Copyright (C) 2008 David W.H Thomas. All rights reserved.
* @license	GNU/GPL
* Parse and display XML news feeds with mootools DHTML tooltip
*/
// no direct access
defined('_JEXEC') or die('Restricted access');
// Include the helper functions only once
require_once (dirname(__FILE__).DS.'helper.php');
// Get data from helper class
$slick_rss = modSlickRSSHelper::getFeed($params);
// Run default template script for output
require(JModuleHelper::getLayoutPath('mod_slick_rss'));