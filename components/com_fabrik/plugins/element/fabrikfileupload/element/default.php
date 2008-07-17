<?php
/**
* Plugin element to render fields
* @package fabrikar
* @author Rob Clayburn
* @copyright (C) Rob Clayburn
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

require_once( COM_FABRIK_FRONTEND .DS."plugins".DS."element".DS."fabrikfileupload".DS."models".DS."file.php");

$render =& new fileRender();
?>