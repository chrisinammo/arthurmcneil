<?php
/**
 * Events Component for Joomla 1.0.x
 *
 * @version     $Id: modutils.php 845 2007-07-12 07:07:27Z geraint $
 * @package     Events
 * @copyright   Copyright (C) 2006 JEvents Project Group
 * @licence     http://www.gnu.org/copyleft/gpl.html
 * @link        http://joomlacode.org/gf/project/jevents
 */
defined( '_VALID_MOS' ) or die( 'Restricted access' );

/*
 loads all required classes and file to support Events Modules
*/

global $mainframe;

// first load config class
require_once(mosMainFrame::getBasePath('admin') . 'components/com_events/lib/config.php');

// common helper class
require_once(mosMainFrame::getBasePath() . 'components/com_events/libraries/helper.php');

// common function and classes
require_once(mosMainFrame::getBasePath() . 'components/com_events/libraries/commonfunctions.php');

// function and classes
require_once(mosMainFrame::getBasePath() . 'components/com_events/libraries/modfunctions.php');

?>