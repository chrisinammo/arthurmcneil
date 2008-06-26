<?php
/**
 * Events Component for Joomla 1.5.x
 *
 * @version     $Id: helper.php 911 2007-12-21 11:14:36Z geraint $
 * @package     Events
 * @copyright   Copyright (C) 2006-2007 JEvents Project Group
 * @licence     http://www.gnu.org/copyleft/gpl.html
 * @link        http://joomlacode.org/gf/project/jevents
 */
defined( '_JEXEC' ) or die( 'Restricted access' );

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
		$cfg = & EventsConfig::getInstance();
		$lang =& JFactory::getLanguage();
		$langname = $lang->getBackwardLang();

		$option = $cfg->get("com_componentname","com_events");

		include_once(JPATH_SITE."/components/$option/language/newfor15.php");

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
		$isloaded[$type] = true;

		switch ($type) {
			case 'front':
				// CHECK LANGUAGE
				$pathLang = JPATH_SITE . '/components/'.$option.'/language/';

				if( file_exists( $pathLang . $langname . '.php' )){
					include_once( $pathLang . $langname  . '.php' );
				} elseif ( file_exists( $pathLang . $langname . 'f.php' )) {
					include_once ( $pathLang . $langname . 'f.php' );
				} else {
					include_once( $pathLang . 'english.php');
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
				$pathLangAdmin 	= JPATH_ADMINISTRATOR. '/components/'.$option.'/language/admin_';

				if( file_exists( $pathLangAdmin . $langname . '.php' )){
					include_once( $pathLangAdmin . $langname . '.php' );
				}else{
					if( file_exists( $pathLangAdmin . 'english.php' )){
						$tmp_lng = 'english.php';
					}else{
						$tmp_lng = 'german.php';
					}
					include_once( $pathLangAdmin . $tmp_lng );
				}
				break;
			default:
				break;
		} // switch
	}

	/**
	 * load iCal instance for filename
	 *
	 * @static
	 * @access public
	 * @since 1.5
	 */
	function & iCalInstance($filename, $rawtext="")
	{
		static $instances = array();
		if (is_array($filename)){
			echo "problem";
		}
		$index = md5($filename.$rawtext);
		if (array_key_exists($index,$instances)) {
			return $instances[$index];
		}
		else {
			$instances[$index] = new iCalImport($filename, $rawtext);
			return $instances[$index];
		}
	}

	/**
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

	/**
     * Function that overwrites meta-tags in mainframe!!
     *
     * @param string $name - metatag name
     * @param string $content - metatag value
     */
	function checkRobotsMetaTag( $name="robots", $content="no-index, no-follow" ) {

		// force robots metatag
		$cfg = & EventsConfig::getInstance();
		if ($cfg->get('com_blockRobots', 0) == 1) {
			$document =& JFactory::getDocument();
			$document->setMetaData( $name, $content );
		}

		/*
		// This code won't work in Joomla 1.0.x since the meta array is written after this call by mosShowHead
		global $mainframe;
		$name = trim( htmlspecialchars( $name ) );
		$n = count( $mainframe->_head['meta'] );
		for ($i = 0; $i < $n; $i++) {
		if ($mainframe->_head['meta'][$i][0] == $name) {
		$content = trim( htmlspecialchars( $content ) );
		$mainframe->_head['meta'][$i][1] = $content;
		return;
		}
		}
		$mainframe->addMetaTag( $name, $content );
		*/
	}

	function forceIntegerArray(&$cid,$asString=true) {
		for($c=0;$c<count($cid);$c++) {
			$cid[$c] = intval($cid[$c]);
		}
		if($asString){
			$id_string = implode(",",$cid);
			return $id_string;
		}
		else {
			return "";
		}
	}

	/*
	* Loads all necessary files for JS Overlib tooltips
	*/
	function loadOverlib() {
		global  $mainframe;

		if ( !$mainframe->get( 'loadOverlib' ) ) {
			// check if this function is already loaded
			?>
			<script language="javascript" type="text/javascript" src="<?php echo JURI::root();?>/includes/js/overlib_mini.js"></script>
			<script language="javascript" type="text/javascript" src="<?php echo JURI::root();?>/includes/js/overlib_hideform_mini.js"></script>
			<?php
			// change state so it isnt loaded a second time
			$mainframe->set( 'loadOverlib', true );
		}
	}

	function getItemid(){
		static $Itemid;
		if (!isset($Itemid)){
			$Itemid	= intval( JRequest::getVar('Itemid', 		0 ));
			// PREVENT Itemid MISSING
			$cfg = & EventsConfig::getInstance();
			$option = $cfg->get("com_componentname");
			if( !isset($Itemid) || empty( $Itemid )){
				$query = "SELECT id"
				. "\n FROM #__menu"
				. "\n WHERE link = 'index.php?option=$option'"
				;
				$db	= & JFactory::getDBO();
				$db->setQuery( $query );

				// This  should ideally to a test on catids and find nice enclosing menu item!

				$db	= & JFactory::getDBO();
				$_REQUEST['Itemid'] = $db->loadResult();
			}
		}
		return $Itemid;
	}

	function getYMD(){
		static $data;
		if (!isset($data)){
			global $mainframe;
			$year		= intval( JRequest::getVar( 'year',	strftime( '%Y', time() + ( $mainframe->getCfg('offset')*60*60 )) ));
			$month	= intval( JRequest::getVar( 'month',	strftime( '%m', time() + ( $mainframe->getCfg('offset')*60*60 )) ));
			$day		= intval( JRequest::getVar( 'day',	strftime( '%d', time() + ( $mainframe->getCfg('offset')*60*60 )) ));
			if( $day <= '9' & ereg( "(^[1-9]{1})", $day )) {
				$day = '0' . $day;
			}
			if( $month <= '9' & ereg( "(^[1-9]{1})", $month )) {
				$month = '0' . $month;
			}
			$data = array();
			$data[]=$year;
			$data[]=$month;
			$data[]=$day;
		}
		return $data;
	}

	function & getJEV_Access(){
		static $instance;
		if (!isset($instance)){
			$instance = new JEV_Access();
		}
		return $instance;
	}

	function isEventEditor(){
		static  $is_event_editor;
		if (!isset($is_event_editor)){
			$is_event_editor 	= 0;

			// override standard MOS ACLs with Events Config settings
			$cfg = & EventsConfig::getInstance();
			$user =& JFactory::getUser();
			if (( $cfg->get('com_adminlevel') == 0 ) && ( strtolower( $user->usertype ) == 'registered')) {
				$is_event_editor = 1;
			} elseif ( $cfg->get('com_adminlevel') == 2) {
				$is_event_editor = 1;
			} else {
				$is_event_editor = ( strtolower( $user->usertype ) == 'author' || strtolower( $user->usertype ) == 'publisher'
				|| strtolower( $user->usertype ) == 'editor' || strtolower( $user->usertype ) == 'manager' || strtolower( $user->usertype ) == 'administrator'
				|| strtolower( $user->usertype ) == 'super administrator' );
			}
		}
		return $is_event_editor;
	}

	function getAGID(){
		static $agid;
		if (!isset($agid)){
			$id	= intval( JRequest::getVar('id',0 ) );
			$jevtype		= JRequest::getVar( 	'jevtype', 		"jevent" );
			$agid 			= JRequest::getVar( 	'agid', 		"0" );
			$agid 			= ($jevtype=="jevent")?intval($agid):$agid;
			if ($agid == 0 && $id!=0) $agid = $id;

			// if returning from admin edit interface
			$ev_id = intval( JRequest::getVar( 	'ev_id', 		0 ) );
			if ($jevtype == "icaldb" && $ev_id>0){
				$agid = $ev_id;
			}
			$agid = intval($agid);
		}
		return $agid;

	}
}


class JEV_Access {
	var $access;

	function JEV_Access(){
		// Editor usertype check
		global $acl;
		$user =& JFactory::getUser();

		$this->access = new stdClass();
		$acl =& JFactory::getACL();
		$this->access->canEdit	= $acl->acl_check( 'action', 'edit', 'users', $user->usertype, 'content', 'all' );
		$this->access->canEditOwn = $acl->acl_check( 'action', 'edit', 'users', $user->usertype, 'content', 'own' );
		$this->access->canPublish = $acl->acl_check( 'action', 'publish', 'users', $user->usertype, 'content', 'all' );
	}

	function canEdit(){

	}

	function canEditOwn(){

	}

	function canPublish(){

	}

}
