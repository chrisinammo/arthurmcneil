<?php
/**
 * Events Component for Joomla 1.0.x
 *
 * @version     $Id: helper.php 991 2008-03-10 19:55:48Z tstahl $
 * @package     Events
 * @copyright   Copyright (C) 2006-2007 JEvents Project Group
 * @licence     http://www.gnu.org/copyleft/gpl.html
 * @link        http://joomlacode.org/gf/project/jevents
 */

// no direct access
defined( '_VALID_MOS' ) or die( 'Restricted access' );

/**
 * Helper class with common functions for the component and modules
 * 
 * @author     Thomas Stahl
 * @since      1.4
 */
class EventsHelper {

	/**
	 * load language file
	 *
	 * @static
	 * @access public
	 * @since 1.4
	 */
	function loadLanguage($type='default', $lang='') {
	
	// to be enhanced in future : load by $type (com, modcal, modlatest) [tstahl]

		global $mainframe;
		
		static $isloaded = array();

		$typemap	= array(
						'default'	=> 'front',
						'front'		=> 'front',
						'admin'		=> 'admin',
						'modcal'	=> 'front',
						'modlatest'	=> 'front'
						);
		$type = (isset($typemap[$type])) ? $typemap[$type] : $typemap['default'];

		// load language defines only once
		if (isset($isloaded[$type])) {
			return;
		}

		$cfg = EventsConfig::getInstance();

		$utf8 = false;
		// Joomla 1.5
		global $_VERSION;
		if (floatval($_VERSION->getShortVersion())>=1.5){
			$utf8 = true;
		} elseif ( strpos( strtolower( _ISO ), 'utf' ) !== false ) {
				// utf-8 page in Joomla 1.0.x
				$utf8 = true;
		}

		$isloaded[$type] = true;

		switch ($type) {
			case 'front':
				// CHECK LANGUAGE
				$pathLang = mosMainFrame::getBasePath() . 'components/com_events/language/';
				
				if( $utf8 ) {
					// extra utf-8 language files have precedence
					if ( file_exists( $pathLang . mosMainFrame::getCfg('lang') . '-utf8.php' )){
						include_once( $pathLang . mosMainFrame::getCfg('lang') . '-utf8.php' );
					} elseif ( file_exists( $pathLang . mosMainFrame::getCfg('lang') . '.php' )) {
						include_once      ( $pathLang . mosMainFrame::getCfg('lang') . '.php' );
					} elseif ( file_exists( $pathLang . mosMainFrame::getCfg('lang') . 'f-utf8.php' )) {
						include_once      ( $pathLang . mosMainFrame::getCfg('lang') . 'f-utf8.php' );
					} elseif ( file_exists( $pathLang . mosMainFrame::getCfg('lang') . 'f.php' )) {
						include_once      ( $pathLang . mosMainFrame::getCfg('lang') . 'f.php' );
					} else {
						include_once( $pathLang . 'english.php');
					}
				} elseif ( file_exists( $pathLang . mosMainFrame::getCfg('lang') . '.php' )) {
					include_once      ( $pathLang . mosMainFrame::getCfg('lang') . '.php' );
				} elseif ( file_exists( $pathLang . mosMainFrame::getCfg('lang') . 'f.php' )) {
					include_once      ( $pathLang . mosMainFrame::getCfg('lang') . 'f.php' );
				} else {
					include_once      ( $pathLang . 'english.php');
				}
		
				//DEFINE('_CAL_LANG_EVENT_FORM_HELP_ADMIN', _CAL_LANG_FORM_HELP_COLOR . _CAL_LANG_FORM_HELP ._CAL_LANG_FORM_HELP_EXTENDED);
		
				$com_events_form_help = null;
		
				if($cfg->get('com_calForceCatColorEventForm', 0) == 0)
					$com_events_form_help =  _CAL_LANG_FORM_HELP_COLOR;
		
				$com_events_form_help .= _CAL_LANG_FORM_HELP;
		
				if($cfg->get('com_calSimpleEventForm', 0) ==0)
					$com_events_form_help .= _CAL_LANG_FORM_HELP_EXTENDED;
		
				DEFINE('_CAL_LANG_EVENT_FORM_HELP', $com_events_form_help);
		
				// backend code used to edit events 
				DEFINE('_CAL_LANG_EVENT_FORM_HELP_ADMIN', $com_events_form_help);
				
				break;

			case 'admin':
				// call for correct language [new routine by mic - checks also admin.langs]
				$pathLangAdmin 	= mosMainFrame::getBasePath('admin') . 'components/com_events/language/admin_';
				$tmp_lng 		= mosMainFrame::getCfg('lang');
			
				for ($i=0; $i<1; $i++) {
					if (!empty( $GLOBALS['mosConfig_alang'] )) {
						$incfile = $pathLangAdmin . $GLOBALS['mosConfig_alang'] . '-utf8.php';
						if ($utf8 && file_exists($incfile)) break;
						$incfile = $pathLangAdmin . $GLOBALS['mosConfig_alang'] . '.php';
						if (file_exists($incfile)) break;
					}

					$incfile = $pathLangAdmin . $tmp_lng . '-utf8.php';
					if ($utf8 && file_exists($incfile)) break;
					$incfile = $pathLangAdmin . $tmp_lng . '.php';
					if ( file_exists($incfile)) break;

					// fallback to default language
					$incfile = $pathLangAdmin . 'english.php';
					break;
				}
				include_once($incfile);
				break;
			default:
				break;
		} // switch
	}

	/**
	 * load language file
	 *
	 * @static
	 * @access public
	 * @param	string	$month		numeric month
	 * @return	string				localised long month name
	 */
	function getMonthName( $month='12' ){
		$monthname = '';

		// can it be replaced by strftime() ? [tstahl]

		switch( intval($month) ){
			case  1:	$monthname = _CAL_LANG_JANUARY;		break;
			case  2:	$monthname = _CAL_LANG_FEBRUARY;	break;
			case  3:	$monthname = _CAL_LANG_MARCH;		break;
			case  4:	$monthname = _CAL_LANG_APRIL;		break;
			case  5:	$monthname = _CAL_LANG_MAY;			break;
			case  6:	$monthname = _CAL_LANG_JUNE;		break;
			case  7:	$monthname = _CAL_LANG_JULY;		break;
			case  8:	$monthname = _CAL_LANG_AUGUST;		break;
			case  9:	$monthname = _CAL_LANG_SEPTEMBER;	break;
			case 10:	$monthname = _CAL_LANG_OCTOBER;		break;
			case 11:	$monthname = _CAL_LANG_NOVEMBER;	break;
			case 12:
			default:	$monthname = _CAL_LANG_DECEMBER;	break;
		}
		return $monthname;
	}

    /**
	 * returns name of the day longversion
	 * @param	int		daynb	# of day
	 * @return	string			localised long day name
	 **/
    function getLongDayName( $daynb=0){
        $dayname = '';

		// can it be replaced by strftime() ? [tstahl]

		switch (intval($daynb)) {
			case 0:		$dayname = _CAL_LANG_SUNDAY;		break;
			case 1:		$dayname = _CAL_LANG_MONDAY;		break;
			case 2:		$dayname = _CAL_LANG_TUESDAY;		break;
			case 3:		$dayname = _CAL_LANG_WEDNESDAY;		break;
			case 4:		$dayname = _CAL_LANG_THURSDAY;		break;
			case 5:		$dayname = _CAL_LANG_FRIDAY;		break;
			case 6:		$dayname = _CAL_LANG_SATURDAY;		break;
			default:	$dayname = ''				;		break;
		}

        return $dayname;
    }

}
