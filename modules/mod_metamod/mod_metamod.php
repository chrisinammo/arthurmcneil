<?php
/**
* @version		1.5d
* @copyright	Copyright (C) 2007-2008 Stephen Brandon
* @license		GNU/GPL
*/
 
// no direct access
defined('_JEXEC') or die('Restricted access');

// Include the syndicate functions only once
require_once (dirname(__FILE__).DS.'helper.php');

$moduleIds = modMetaModHelper::moduleIds($params);
echo modMetaModHelper::displayModules($moduleIds,$params);

?>
