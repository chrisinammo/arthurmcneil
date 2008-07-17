<?php
/**
 * Events Component for Joomla 1.0.x
 *
 * @version     $Id: adminutils.php 845 2007-07-12 07:07:27Z geraint $
 * @package     Events
 * @copyright   Copyright (C) 2006 JEvents Project Group
 * @licence     http://www.gnu.org/copyleft/gpl.html
 * @link        http://joomlacode.org/gf/project/jevents
 */
defined( '_VALID_MOS' ) or die( 'Restricted access' );

/*
 loads all required classes and file to support Events Component
*/

global $mainframe;

// first load config class
require_once(mosMainFrame::getBasePath('admin') . 'components/com_events/lib/config.php');

// common helper class
require_once(mosMainFrame::getBasePath() . 'components/com_events/libraries/helper.php');

// common function and classes
require_once(mosMainFrame::getBasePath() . 'components/com_events/libraries/commonfunctions.php');

global $_VERSION;
if (floatval($_VERSION->getShortVersion())>=1.5){
	jimport( 'joomla.application.helper' );
	require_once( JApplicationHelper::getPath( 'admin_html'  ) );
	require_once( JApplicationHelper::getPath( 'class' ) );
}
else {
	require_once( $mainframe->getPath( 'admin_html' ) );
	require_once( $mainframe->getPath( 'class' ) );
}

// load version class
require_once(mosMainFrame::getBasePath('admin') . 'components/com_events/lib/version.php');

// function and classes
//require_once(mosMainFrame::getBasePath() . 'components/com_events/libraries/??.php');

?>