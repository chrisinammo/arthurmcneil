<?php
/**
 * Events Component for Joomla 1.5.x
 *
 * @version     $Id: admin.controller.php 986 2008-02-21 22:22:38Z tstahl $
 * @package     Events
 * @copyright   Copyright (C) 2006-2007 JEvents Project Group
 * @copyright   Copyright (C) 2000 - 2003 Eric Lamette, Dave McDonnelle
 * @licence     http://www.gnu.org/copyleft/gpl.html
 * @link        http://joomlacode.org/gf/project/jevents
 */

defined( '_JEXEC' ) or die( 'Restricted access' );
error_reporting(E_ALL);
/**
 * JEvents Component Controller
 *
 */
class JEventsAdminController extends JController {
	var $_cache;
	var $_categoryController;
	var $html;

	// this is a pseudo constructor - I leave the constructor alone!
	function setupController(){
		$cfg = & EventsConfig::getInstance();
		// Before anything CHECK CONFIG
		global $task, $mainframe;
		$cfg = & EventsConfig::getInstance();
		$option = $cfg->get("com_componentname", "com_events");

		// sendAdminMail() drops mail of empty adminmail and example.com domain
		//if( $cfg->get("com_adminmail",'your@example.com') == 'your@example.com' && $task!="conf" && $task!="saveconfig"){
		//	$msg = _CAL_LANG_MSG_CHANGE_EMAIL;
		//	$mainframe->redirect( 'index2.php?option=' . $option . '&task=conf', $msg ,'error');
		//}

		$config	=& JFactory::getConfig();
		$this->_debug = $config->getValue('config.debug',0);

		$this->live_site = $mainframe->getSiteURL();

		include_once(dirname(__FILE__)."/lib/categories/categoryController.php");
		$this->_categoryController = new CategoryController();

		$this->registerDefaultTask('cpanel');

		$this->registerTask("conf","editConfig");
		$this->registerTask("add","newEvent");
		$this->registerTask("clone","cloneedit");

		$this->registerTask("iCalsubs","manageICalSubscriptions");
		$this->registerTask("saveics","importICal");
		$this->registerTask("reloadICS","importICal");
		$this->registerTask("publishICS","toggleICSPublish");
		$this->registerTask("unpublishICS","toggleICSPublish");
		// TODO do I need these 2 ??
		$this->registerTask("newIcalCalendar","editICSitem");
		$this->registerTask("editics","editICSitem");
		// TODO rationalise these names!!!
		$this->registerTask("createNewIcalCal","newIcalCalendar");

		// ICAL Event tasks
		$this->registerTask("iCalevents","manageICalEvents");
		$this->registerTask("publishIcal","toggleICalEventPublish");
		$this->registerTask("unpublishIcal","toggleICalEventPublish");
		$this->registerTask("newIcalEvent","editICalItem");
		$this->registerTask("editIcalEvent","editICalItem");
		$this->registerTask("editical","editICalItem");
		$this->registerTask("saveIcalEvent","saveIcalEvent");
		$this->registerTask("saveical","saveIcalEvent");

		// load language constants
		EventsHelper::loadLanguage('front');
		EventsHelper::loadLanguage('admin');

		if (strpos(_CAL_LEGEND_ALL_CATEGORIES,"XXXX")!==false){
			echo "<div id='misstrans' style='position:absolute;top:10px;left:10px;width:200px;padding:10px;border:solid 1px black;background-color:yellow;color:black;font-weight:bold'><div style='cursor:pointer;border:solid 1px black;float:right;margin:-7px -7px 4px 5px;padding:2px;' onclick='document.getElementById(\"misstrans\").style.display=\"none\";'>Hide X</div>The Translation of the JEvents Component in this language is incomplete - please consider completing the translation and contributing it to the project</div>";
		}

		$this->html  = & HTML_events_admin::getInstance();
	}

	function checkLocale(){
		include_once(dirname(__FILE__)."/lib/checklocale.php");
		checkLocale();
	}

	function  cpanel() {
		$panelStates = array();
		// I can check the status of various bots and modules here!
		foreach (testJEventModBot("plg","eventsearch","Search plugin") as $value) {
			array_push($panelStates, $value);
		};
		foreach (testJEventModBot("plg","eventreport", "Event Report plugin") as $value) {
			array_push($panelStates, $value);
		};
		foreach (testJEventModBot("mod","events_cal","Events Calendar module") as $value) {
			array_push($panelStates, $value);
		};
		foreach (testJEventModBot("mod","events_latest","Latest Events module") as $value) {
			array_push($panelStates, $value);
		};
		foreach (testJEventModBot("mod","events_legend", "Events Legend module") as $value) {
			array_push($panelStates, $value);
		};
		$this->html->showCPanel( $panelStates );
	}

	// CONFIG TASKS
	function editConfig() {
		$cfg = & EventsConfig::getInstance();
		$option = $cfg->get("com_componentname", "com_events");
		$this->html->showConfig( $option);
	}

	function saveconfig(){
		$cfg = & EventsConfig::getInstance();
		$option = $cfg->get("com_componentname", "com_events");
		$this->_saveConfig ($option);
	}

	function cancelconfig(){
		$cfg = & EventsConfig::getInstance();
		$option = $cfg->get("com_componentname", "com_events");
		global $mainframe;
		$mainframe->redirect( 'index2.php?option=' . $option, '');
	}


	function missingconf(){
		$cfg = & EventsConfig::getInstance();
		$option = $cfg->get("com_componentname", "com_events");
		$this->html->showConfig( $option);
	}

	function missingcss(){
		$cfg = & EventsConfig::getInstance();
		$option = $cfg->get("com_componentname", "com_events");
		missCss();

		$filename		= stripslashes( JPATH_SITE . "/components/$option/events_css.css" );
		$fp				= fopen( $filename, 'rb' );
		$config_style	= fread( $fp, filesize( $filename ) );
		$config_style	= htmlspecialchars( $config_style );
		fclose( $fp );

		$this->html->showConfig( $option);
	}

	function viewEvents(){
		$this->_checkValidCategories();
		$cfg = & EventsConfig::getInstance();
		$option = $cfg->get("com_componentname", "com_events");
		$this->_viewEvents( $option,false);
	}

	function viewarchiv() {
		$this->_checkValidCategories();
		$cfg = & EventsConfig::getInstance();
		$option = $cfg->get("com_componentname", "com_events");
		$this->_viewEvents( $option, true );
	}

	function publish(){
		$id	= intval( JRequest::getVar('id',0 ) );
		$cid	= JRequest::getVar(	'cid',	array(0) );
		EventsHelper::forceIntegerArray($cid);
		$cfg = & EventsConfig::getInstance();
		$option = $cfg->get("com_componentname", "com_events");
		$this->_changeEvents( $id, $cid, 1, $option );
	}

	function unpublish(){
		$id	= intval( JRequest::getVar('id',0 ) );
		$cid	= JRequest::getVar(	'cid',	array(0) );
		EventsHelper::forceIntegerArray($cid);
		$cfg = & EventsConfig::getInstance();
		$option = $cfg->get("com_componentname", "com_events");
		$this->_changeEvents( $id, $cid, 0, $option );
	}

	function newEvent(){
		$cfg = & EventsConfig::getInstance();
		$option = $cfg->get("com_componentname", "com_events");
		$this->_editEvents( $option, 0 );
	}

	function edit(){
		$cfg = & EventsConfig::getInstance();
		$option = $cfg->get("com_componentname", "com_events");
		$cid	= JRequest::getVar(	'cid',	array(0) );
		EventsHelper::forceIntegerArray($cid);
		$this->_editEvents( $option, $cid[0] );
	}

	function cancel(){
		$cfg = & EventsConfig::getInstance();
		$option = $cfg->get("com_componentname", "com_events");
		$this->_cancelEvents( $option );
	}

	function save(){
		$cfg = & EventsConfig::getInstance();
		$option = $cfg->get("com_componentname", "com_events");
		$this->_saveEvents( $option );
	}

	function remove(){
		$cfg = & EventsConfig::getInstance();
		$option = $cfg->get("com_componentname", "com_events");

		$cid	= JRequest::getVar(	'cid',	array(0) );
		EventsHelper::forceIntegerArray($cid);
		$this->_removeEvents( $cid, $option );
	}

	function archive(){
		$id	= intval( JRequest::getVar('id',0 ) );
		$cid	= JRequest::getVar(	'cid',	array(0) );
		EventsHelper::forceIntegerArray($cid);
		$cfg = & EventsConfig::getInstance();
		$option = $cfg->get("com_componentname", "com_events");
		$this->_changeEvents( $id, $cid, -1, $option );
	}

	function unarchive(){
		$id	= intval( JRequest::getVar('id',0 ) );
		$cid	= JRequest::getVar(	'cid',	array(0) );
		EventsHelper::forceIntegerArray($cid);
		$cfg = & EventsConfig::getInstance();
		$option = $cfg->get("com_componentname", "com_events");
		$this->_changeEvents( $id, $cid, 0, $option );
	}

	function cloneedit(){
		global $task;
		$cid	= JRequest::getVar(	'cid',	array(0) );
		EventsHelper::forceIntegerArray($cid);
		$cfg = & EventsConfig::getInstance();
		$option = $cfg->get("com_componentname", "com_events");
		$this->_cloneEvents( $option, $cid[0], $task );
	}

	function exportToIcal(){
		$catid = intval( JRequest::getVar( 'catid',0));
		$filename =  JRequest::getVar( 'icsFilename','' );

		if ($catid>0 && strlen($filename)!=0) {
			$cfg = & EventsConfig::getInstance();
			$option = $cfg->get("com_componentname", "com_events");
			$db	=& JFactory::getDBO();
			include_once(JPATH_SITE."/components/$option/libraries/vCal.class.php");
			$query = "SELECT ev.*, cc.name AS category, "
			."\n UNIX_TIMESTAMP(ev.publish_up) AS dtstart ,"
			."\n UNIX_TIMESTAMP(ev.publish_down) AS dtend "
			."\n FROM  #__events AS ev, #__categories AS cc "
			."\n WHERE ev.catid = cc.id";
			$db->setQuery( $query );
			$detevents = $db->loadObjectList();

			$showBR = intval( JRequest::getVar( 'showBR', '1'));
			$cal = new vCal($filename);

			foreach ($detevents as $event) {
				$cal->addEvent($event);
			}

			$output = $cal->getVCal();
			if ($showBR){
				echo $output;
			}
			else {
				if ( $output <> "" ) {
					// dump anything in the buffer
					@ob_end_clean();
					ob_start();

					header('Content-Type: text/x-vCalendar');
					/**
			 * This should be based on paramaters
			 */
					header('Expires: Fri, 29 Sep 2006 13:25:13 GMT');
					$useragent 	=  JRequest::getVar(  'HTTP_USER_AGENT', '',"SERVER" );
					if (strpos(strtolower($useragent),"msie")!==false){
						header('Content-Disposition: inline; filename="' . $filename. '"');
						//header('Cache-Control: must-revalidate, post-check=0,pre-check=0');
						header('Pragma: public');
					} else {
						header('Content-Disposition: attachment; filename="'. $filename . '"');
						header('Pragma: no-cache');
					}
					echo $output;
					ob_end_flush();
					ob_start();
				}
				// do no more
				exit;
			}

		}

		$this->html->exportToIcal();
	}

	function convertToIcalBatch(){
		$cfg = & EventsConfig::getInstance();
		$option = $cfg->get("com_componentname", "com_events");
		$db	=& JFactory::getDBO();
		include_once(JPATH_SITE."/components/$option/libraries/vCal.class.php");

		/**
		 * find the categories first
		 */		
		$query = "SELECT * FROM #__categories AS cc WHERE section='com_events'";
		$db->setQuery( $query );
		$cats = $db->loadObjectList();
		foreach ($cats as $cat) {
			$query = "SELECT ev.*, cc.name AS category, "
			."\n UNIX_TIMESTAMP(ev.publish_up) AS dtstart ,"
			."\n UNIX_TIMESTAMP(ev.publish_down) AS dtend "
			."\n FROM  #__events AS ev, #__categories AS cc "
			."\n WHERE ev.catid = cc.id"
			."\n AND cc.id = $cat->id";
			$db->setQuery( $query );
			$detevents = $db->loadObjectList();

			$showBR = intval( JRequest::getVar( 'showBR', '0'));
			$cal = new vCal("");

			if (count($detevents)>0){
				foreach ($detevents as $event) {
					$cal->addEvent($event);
				}

				$output = $cal->getVCal();
				if ($showBR){
					echo "Processing cat $cat->title<br/>";
					echo $output;
					echo "<hr/>";
				}

				include_once(JPATH_SITE."/components/$option/libraries/iCalImport.php");
				$catid = $cat->id;
				$access = $cat->access;
				$state = $cat->published;
				$icsid = 0; // new
				$icsLabel = "$cat->title (imp)";
				$icsFile = iCalICSFile::newICSFileFromString($output,$icsid,$catid,$access,$state,$icsLabel);
				$icsFileid = $icsFile->store();

			}
		}
		global $mainframe;
		$mainframe->redirect( 'index2.php?option=' . $option. '&task=cpanel',"Events Migrated");
	}


	/**
	 * ICAL ICS File/Calendar FUNCTIONS
	 */
	function _setIcalManagement(){
		if (!isset($this->_icalManagement)){
			include_once(dirname(__FILE__)."/lib/icalManagement.php");
			$this->_icalManagement = new IcalManagement();
		}
	}

	function manageICalSubscriptions(){
		$this->_checkValidCategories();
		$this->_setIcalManagement();
		$this->_icalManagement->manageICalSubscriptions();
	}

	/**
 	* create new ICAL from scratch
 	*/
	function newIcalCalendar(){
		$this->_setIcalManagement();
		$this->_icalManagement->newIcalCalendar();
	}

	/**
	 * Imports Ical file to database 
	 * 
 	*/
	function importICal() {
		$this->_setIcalManagement();
		$this->_icalManagement->importICal();
	}

	function toggleICSPublish(){
		$this->_setIcalManagement();
		$this->_icalManagement->toggleICSPublish();
	}

	function editICSitem(){
		$this->_setIcalManagement();
		$this->_icalManagement->editICSitem();
	}


	function deleteics(){
		$this->_setIcalManagement();
		$this->_icalManagement->deleteics();
	}


	/**
	 * Ical Event Functions
	 */

	function manageICalEvents(){
		$this->_checkValidCategories();
		$this->_setIcalManagement();
		$this->_icalManagement->manageICalEvents();
	}

	function editICalItem(){
		$this->_setIcalManagement();
		$this->_icalManagement->editICalItem();
	}

	function deleteicalEvent() {
		$this->_setIcalManagement();
		$this->_icalManagement->deleteicalEvent();
	}

	function saveIcalEvent() {
		$this->_setIcalManagement();
		$this->_icalManagement->saveIcalEvent();
	}

	function refreshical() {
		// TODO write this
		echo "Hello refresh";
	}

	function toggleICalEventPublish(){
		$this->_setIcalManagement();
		$this->_icalManagement->toggleICalEventPublish();
	}


	function icalrepeats(){
		$cid	= JRequest::getVar(	'cid',	array(0) );
		EventsHelper::forceIntegerArray($cid);
		$this->_setIcalManagement();
		$this->_icalManagement->showICalEventRepeats($cid,false);
	}

	function editIcalRepeat(){
		$cid	= JRequest::getVar(	'cid',	array(0) );
		EventsHelper::forceIntegerArray($cid);
		$this->_setIcalManagement();
		$this->_icalManagement->editICalRepeat($cid);
	}

	function deleteIcalRepeat(){
		$cid	= JRequest::getVar(	'cid',	array(0) );
		EventsHelper::forceIntegerArray($cid);
		$this->_setIcalManagement();
		$this->_icalManagement->deleteICalRepeat($cid);
	}

	function saveIcalRepeat(){
		$this->_setIcalManagement();
		$this->_icalManagement->saveICalRepeat();
	}


	/**
	 * Manage categories - show list
	 *
	 */
	function categories(){
		$this->_categoryController->categories();
	}

	/**
	 * Category Editing code
	 *
	 */
	function editCategory(){
		$cid	= JRequest::getVar(	'cid',	array(0) );
		EventsHelper::forceIntegerArray($cid);
		$this->_categoryController->editCategory($cid);
	}

	/**
	 * Category Saving code
	 *
	 */
	function saveCategory(){
		$cid	= JRequest::getVar(	'cid',	array(0) );
		EventsHelper::forceIntegerArray($cid);
		$this->_categoryController->saveCategory($cid);
	}

	/**
	 * Category Ordering code
	 *
	 */
	function saveCategoryOrder(){
		$cid	= JRequest::getVar(	'cid',	array(0) );
		EventsHelper::forceIntegerArray($cid);
		$this->_categoryController->saveCategoryOrder($cid);
	}

	/**
	 * Category Deletion code
	 *
	 */	
	function deleteCategory(){
		$cid	= JRequest::getVar(	'cid',	array(0) );
		EventsHelper::forceIntegerArray($cid);
		$this->_categoryController->deleteCategory($cid);
	}

	function publishCategory(){
		$cid	= JRequest::getVar(	'cid',	array(0) );
		EventsHelper::forceIntegerArray($cid);
		$this->_categoryController->toggleCatPublish($cid,1);
	}

	function unpublishCategory(){
		$cid	= JRequest::getVar(	'cid',	array(0) );
		EventsHelper::forceIntegerArray($cid);
		$this->_categoryController->toggleCatPublish($cid,0);
	}




	// PRIVATE FUNCTIONS CALLED INDIRECTLY
	//////////////////////////////////////// CONFIG /////////////////////////////////////
	function _saveConfig ( $option ) {
		$user =& JFactory::getUser();

		//Options
		$csstxt =  JRequest::getVar(  'conf_style', '');
		$csstxt = stripslashes($csstxt);

		// put all params to new EventsConfig object
		$new_config = & new EventsConfig();

		$new_config->set('com_componentname',trim(strtolower(  JRequest::getVar( 'conf_componentname','com_events'))));
		$new_config->set('com_adminmail',				trim(  strtolower( JRequest::getVar( 'conf_adminmail','' ))));
		$new_config->set('com_starday',					intval( JRequest::getVar('conf_starday', 0  )));
		$new_config->set('com_adminlevel',				intval( JRequest::getVar('conf_adminlevel', 0 )));
		$new_config->set('com_mailview',				trim(  JRequest::getVar('conf_mailview', '1' )));
		$new_config->set('com_frontendPublish',			trim(  JRequest::getVar( 'conf_frontendPublish', '1' )));
		$new_config->set('com_byview',					trim(  JRequest::getVar( 'conf_byview', '1' )));
		$new_config->set('com_earliestyear',			intval(JRequest::getVar( 'conf_earliestyear', 1995 )));
		$new_config->set('com_latestyear',				intval(JRequest::getVar( 'conf_latestyear', 1995 )));
		$new_config->set('com_hitsview',				trim(  JRequest::getVar( 'conf_hitsview', '1' )));
		$new_config->set('com_repeatview',				trim(  JRequest::getVar( 'conf_repeatview', '1' )));
		$new_config->set('com_showrepeats',				trim(  JRequest::getVar( 'conf_showrepeats', '1')));
		$new_config->set('com_linkcloaking',			trim(  JRequest::getVar( 'conf_linkcloaking', '0')));
		$new_config->set('com_hideshowbycats',			trim(  JRequest::getVar( 'conf_hideshowbycats', '1')));
		$new_config->set('com_copyright',				trim(  JRequest::getVar( 'conf_copyright', '1')));
		$new_config->set('com_dateformat',				intval(JRequest::getVar( 'conf_dateformat', 1 )));
		$new_config->set('com_calUseIconic',			intval(JRequest::getVar( 'conf_calUseIconic', 1 )));
		$new_config->set('com_navbarcolor',				trim(  JRequest::getVar( 'conf_navbarcolor', 'green' )));
		$new_config->set('com_startview',				trim(  JRequest::getVar( 'conf_startview', 'view_month' )));
		$new_config->set('com_defColor',				trim(  JRequest::getVar( 'conf_defColor', 'category' )));
		$new_config->set('com_calSimpleEventForm',		trim(  JRequest::getVar( 'conf_calSimpleEventForm', '0')));
		$new_config->set('com_calForceCatColorEventForm',trim(  JRequest::getVar( 'conf_calForceCatColorEventForm', '0')));
		$new_config->set('com_blockRobots',				intval( JRequest::getVar( 'conf_blockRobots',1)));
		$new_config->set('com_legacyEvents',			intval( JRequest::getVar( 'conf_legacyEvents',1)));
		$new_config->set('com_calEventListRowsPpg',		intval(JRequest::getVar( 'conf_calEventListRowsPpg', 10 )));
		$new_config->set('com_calUseStdTime',			trim(  JRequest::getVar( 'conf_calUseStdTime', '1' )));
		$new_config->set('com_calCutTitle',				intval(JRequest::getVar( 'conf_calCutTitle', 15 )));
		$new_config->set('com_calMaxDisplay',			intval(JRequest::getVar( 'conf_calMaxDisplay', 15 )));
		$new_config->set('com_calDisplayStarttime',		intval(JRequest::getVar( 'conf_calDisplayStarttime', 1 )));
		$new_config->set('com_calViewName',				trim(JRequest::getVar( 'conf_calViewName', "default" )));

		// tooltips
		$new_config->set('com_enableToolTip',			intval(JRequest::getVar( 'conf_enableToolTip', 1 )));
		$new_config->set('com_calTTBackground',			intval(JRequest::getVar( 'conf_calTTBackground', 1 )));
		$new_config->set('com_calTTPosX',				trim(  JRequest::getVar( 'conf_calTTPosX', 'LEFT' )));
		$new_config->set('com_calTTPosY',				trim(  JRequest::getVar( 'conf_calTTPosY', 'BELOW' )));
		$new_config->set('com_calTTShadow',				intval(JRequest::getVar( 'conf_calTTShadow', 0 )));
		$new_config->set('com_calTTShadowX',			intval(JRequest::getVar( 'conf_calTTShadowX', 0 )));
		$new_config->set('com_calTTShadowY',			intval(JRequest::getVar( 'conf_calTTShadowY', 0 )));

		// rss
		$new_config->set('com_rss_cache',				intval(JRequest::getVar( 'conf_rss_cache', 1 )));
		$new_config->set('com_rss_cache_time',			intval(JRequest::getVar( 'conf_rss_cache_time', 3600 )));
		$new_config->set('com_rss_count',				intval(JRequest::getVar( 'conf_rss_count', 5 )));
		$new_config->set('com_rss_title',				trim(  JRequest::getVar( 'conf_rss_title', "Powered by JEvents!" )));
		$new_config->set('com_rss_description',			trim(  JRequest::getVar( 'conf_rss_description', "JEvents Syndication for Joomla" )));
		$new_config->set('com_rss_limit_text',			intval(JRequest::getVar( 'conf_rss_limit_text', 0 )));
		$new_config->set('com_rss_text_length',			intval(JRequest::getVar( 'conf_rss_text_length', 20)));
		// mod_cal
		$new_config->set('modcal_DispLastMonth',		trim(  JRequest::getVar( 'conf_modCalDispLastMonth', 'NO' )));
		$new_config->set('modcal_DispLastMonthDays',	intval(JRequest::getVar( 'conf_modCalDispLastMonthDays', 0 )));
		$new_config->set('modcal_DispNextMonth',		trim(  JRequest::getVar( 'conf_modCalDispNextMonth', 'NO' )));
		$new_config->set('modcal_DispNextMonthDays',	intval(JRequest::getVar( 'conf_modCalDispNextMonthDays', 0 )));
		$new_config->set('modcal_LinkCloaking',			trim(  JRequest::getVar( 'conf_modCalLinkCloaking', '0' )));

		// mod_latest
		$new_config->set('modlatest_MaxEvents',			min(150, abs(intval(JRequest::getVar( 'conf_modLatestMaxEvents', 5 )))));
		$new_config->set('modlatest_Mode',				intval(JRequest::getVar( 'conf_modLatestMode', 0 )));
		$new_config->set('modlatest_Days',				intval(JRequest::getVar( 'conf_modLatestDays', 20 )));
		$new_config->set('modlatest_DispLinks',			trim(  JRequest::getVar( 'conf_modLatestDispLinks', '1' )));
		$new_config->set('modlatest_NoRepeat',			trim(  JRequest::getVar( 'conf_modLatestNoRepeat', '0' )));
		$new_config->set('modlatest_DispYear',			trim(  JRequest::getVar( 'conf_modLatestDispYear', '0' )));
		$new_config->set('modlatest_DisDateStyle',		trim(  JRequest::getVar( 'conf_modLatestDisDateStyle', '0' )));
		$new_config->set('modlatest_DisTitleStyle',		trim(  JRequest::getVar( 'conf_modLatestDisTitleStyle', '0' )));
		$new_config->set('modlatest_LinkToCal',			trim(  JRequest::getVar( 'conf_modLatestLinkToCal', '0' )));
		$new_config->set('modlatest_LinkCloaking',		trim(  JRequest::getVar( 'conf_modLatestLinkCloaking', '0' )));
		$new_config->set('modlatest_CustFmtStr',		ereg_replace("\r*\n", '<br />', JRequest::getVar( 'conf_modLatestCustFmtStr', '', 'default', 'string', JREQUEST_ALLOWRAW)));
		$new_config->set('modlatest_RSS',				intval(JRequest::getVar( 'conf_modLatestRSS', 0 )));


		//$configfile = JPATH_BASE . '/administrator/components/' . $option . '/events_config.ini.php';
		//$oldPermsConfig	= fileperms ( $configfile );
		//clearstatcache();

		// save config params
		$confmsg = $new_config->saveEventsINI();
		if (is_string($confmsg)) {
			global $mainframe;
			$mainframe->redirect("index2.php?option=$option&task=conf", $confmsg);
		}

		// restore perms
		//@chmod( $configfile, $oldPermsConfig);

		$mosmsg = _CAL_LANG_MSG_CONFIG_SAVED;
		global $mainframe;
		$mainframe->redirect( 'index2.php?option=' . $option . '&task=conf', $mosmsg );
	}


	function _viewEvents( $option, $archive = false ) {
		global  $mainframe;
		$db	=& JFactory::getDBO();

		$catid		= intval( $mainframe->getUserStateFromRequest( "catid{$option}", 'catid', 0 ));
		$limit		= intval( $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', 10 ));
		$limitstart = intval( $mainframe->getUserStateFromRequest( "view{$option}limitstart", 'limitstart', 0 ));
		$search		= $mainframe->getUserStateFromRequest( "search{$option}", 'search', '' );
		$search		= $db->getEscaped( trim( strtolower( $search ) ) );
		$hideOldEvents = intval( $mainframe->getUserStateFromRequest( 'oldev', 'oldev',1));
		$where		= array();

		if( $catid > 0 ){
			$where[] = "a.catid='$catid'";
		}
		if( $search ){
			$where[] = "LOWER(a.title) LIKE '%$search%'";
		}

		if ($hideOldEvents>0){
			jimport("joomla.utilities.date");
			$now = new JDate("now");
			$where[] = "a.publish_down >= '".$now->toMySQL()."'";
		}

		// no archieved items [ new mic ]
		if( !$archive ){
			$where[] = "a.state != '-1'";
		}else{
			$where[] = "a.state = '-1'";
		}

		// get the total number of records
		$query = "SELECT count(*)"
		. "\n FROM #__events AS a"
		. ( count( $where ) ? "\n WHERE " . implode( ' AND ', $where ) : '' )
		;
		$db->setQuery( $query);
		$total = $db->loadResult();
		echo $db->getErrorMsg();

		if( $limit > $total ) {
			$limitstart = 0;
		}

		$where[] = "a.catid=cc.id";

		$query = "SELECT a.*, cc.name AS category, u.name AS editor, g.name AS groupname"
		. "\n FROM ( #__events AS a, #__categories AS cc )"
		. "\n LEFT JOIN #__users AS u ON u.id = a.checked_out"
		. "\n LEFT JOIN #__groups AS g ON g.id = a.access"
		. ( count( $where ) ? "\n WHERE " . implode( ' AND ', $where ) : '' )
		. "\n ORDER BY a.catid"
		//. "\nAND a.state ASC"
		. "\n LIMIT $limitstart, $limit"
		;
		$db->setQuery( $query );
		$rows = $db->loadObjectList();

		if( $this->_debug ){
			echo '[DEBUG]<br />';
			echo 'query:';
			echo '<pre>';
			echo $query;
			echo '-----------<br />';
			echo 'option "' . $option . '"<br />';
			echo 'archive "' . $archive . '"<br />';
			echo '</pre>';
			//die( 'userbreak - mic ' );
		}

		if ($db->getErrorNum()) {
			echo $db->stderr();
			return false;
		}

		// get list of categories
		$categories[] = JHTML::_('select.option', '0', _CAL_LANG_EVENT_CHOOSE_CATEG );
		$categories[] = JHTML::_('select.option', '-1', '- '._CAL_LANG_EVENT_ALLCAT );

		$query = "SELECT id AS value, title AS text"
		. "\n FROM #__categories"
		. "\n WHERE section='$option'"
		. "\n ORDER BY ordering"
		;
		$db->setQuery( $query );

		$categories = array_merge( $categories, $db->loadObjectList() );

		$clist = JHTML::_('select.genericlist', $categories, 'catid', 'class="inputbox" size="1" onchange="submitbutton(\'viewEvents\');"', 'value', 'text', $catid );

		/*$section = new mosSection( $db );
		$section->load( $sectionid );
		*/
		include_once( 'includes/pageNavigation.php' );
		$pageNav = new JPagination( $total, $limitstart, $limit  );

		$catData = getCategoryData();
		$this->html->showEvents( $rows, $clist, $search, $pageNav, $option, $hideOldEvents, $catData);
	}

	/**
	 * 
	 * Changes the state of one or more content pages
	* @param string The name of the category section
	* @param integer A unique category id (passed from an edit form)
	* @param array An array of unique category id numbers
	* @param integer 0 if unpublishing, 1 if publishing
	* @param string The name of the current user
	*/
	function _changeEvents( $id=null, $cid=null, $state=0, $option ) {
		global   $catid;
		$db	=& JFactory::getDBO();
		$user =& JFactory::getUser();

		if (!is_array( $cid )) {
			$cid = array();
		}
		if ($id) {
			$cid[] = $id;
		}

		if (count( $cid ) < 1) {
			$action = $state == 1 ? _CAL_LANG_PUBLISH : ( $state == -1 ? _CAL_LANG_TO_ARCHIVE : _CAL_LANG_UNPUBLISH );
			echo "<script> alert('" . html_entity_decode( sprintf( _CAL_LANG_MSG_SEL_TO_ACTION, $action ))
			. "'); window.history.go(-1);</script>\n";
			exit;
		}

		$cids = implode( ',', $cid );

		$query = "UPDATE #__events"
		. "\n SET state='$state'"
		. "\n WHERE id IN ($cids)"
		. "\n AND (checked_out=0 OR (checked_out='$user->id'))"
		;
		$db->setQuery( $query );
		if (!$db->query()) {
			echo "<script> alert('".$db->getErrorMsg()."'); window.history.go(-1); </script>\n";
			exit();
		}

		if (count( $cid ) == 1) {
			$row = new mosEvents( $db );
			$row->checkin( $cid[0] );
		}

		global $mainframe;
		$mainframe->redirect( "index2.php?option=$option&catid=$catid&task=viewEvents" );
	}

	function _editEvents( $option, $eventid ) {
		jimport("joomla.utilities.date");
		$db	=& JFactory::getDBO();
		$user =& JFactory::getUser();

		$row = new mosEvents( $db );
		// load the row from the db table
		$row->load( $eventid );

		$lists	= array();

		// get list of categories
		$query = "SELECT id AS value, name AS text"
		. "\n FROM #__categories"
		. "\n WHERE section='$option'"
		. "\n ORDER BY ordering"
		;
		$db->setQuery( $query );
		//$categories = array_merge( $categories, $db->loadObjectList() );
		$categories = $db->loadObjectList();

		if( count( $categories ) < 1) {
			$msg = _CAL_LANG_MSG_ADD_CAT_BEFORE;
			global $mainframe;
			$mainframe->redirect( 'index2.php?option='.$option.'&task=categories', $msg );
		}

		// fail if checked out not by 'me'
		if ($row->checked_out && $row->checked_out <> $user->id) {
			$msg = sprintf( _CAL_LANG_MSG_CAT_IS_EDITED, $row->title );
			global $mainframe;
			$mainframe->redirect( 'index2.php?option=' . $option, $msg );
		}

		if( $eventid ){
			$mode = 'modify';
			$row->checkout( $user->id );

			if( trim( $row->images )) {
				$row->images = explode( "\n", $row->images );
			} else {
				$row->images = array();
			}

			if( trim( $row->publish_down ) == '0000-00-00 00:00:00' ) {
				$row->publish_down = _CAL_LANG_NEVER;
			}

			$event_up				= new mosEventDate( $row->publish_up );
			$start_publish			= sprintf( '%4d-%02d-%02d', $event_up->year, $event_up->month, $event_up->day );
			$start_time				= $event_up->hour . ':' . $event_up->minute;

			$event_down				= new mosEventDate( $row->publish_down );
			$stop_publish			= sprintf( '%4d-%02d-%02d', $event_down->year, $event_down->month, $event_down->day );
			$end_time				= $event_down->hour . ':' . $event_down->minute;

			$row->reccurday_month	= 99;
			$row->reccurday_week	= 99;
			$row->reccurday_year	= 99;

			if( $row->reccurday <> '' ){
				if( $row->reccurtype == 1 ) {
					$row->reccurday_week = $row->reccurday;
				}elseif( $row->reccurtype == 3) {
					$row->reccurday_month = $row->reccurday;
				}elseif( $row->reccurtype == 5 ) {
					$row->reccurday_year = $row->reccurday;
				}
			}
		} else {
			$mode = 'new';

			$row->state				= 0;
			$row->images			= array();
			$start = new JDate();
			$start_publish			= $start->toFormat('%Y-%m-%d');
			$stop_publish			= $start->toFormat('%Y-%m-%d');
			$start_time				= '08:00';
			$end_time				= '17:00';
			$row->color_bar 		= mosEventsHTML::getColorBar( null, '' );

			$row->reccurday_month	= -1;
			$row->reccurday_week	= -1;
			$row->reccurday_year	= -1;
		}

		// get list of images
		$imgFiles					= array();
		$imgPath					= JPATH_SITE . '/images/stories/';
		if (is_dir($imgPath)) {
			$imgFiles	= JFolder::files( $imgPath );
		}

		// get list of groups
		$query = "SELECT id AS value, name AS text"
		. "\n FROM #__groups"
		. "\n ORDER BY id"
		;
		$db->setQuery( $query );
		$groups = $db->loadObjectList();

		// build the html select list
		$glist = JHTML::_('select.genericlist', $groups, 'access', 'class="inputbox" size="1"',
		'value', 'text', intval( $row->access ) );

		$creator	= '';
		$modifier	= '';
		if( $eventid ) {
			$query = "SELECT name"
			. "\n FROM #__users"
			. "\n WHERE id=$row->created_by"
			;
			$db->setQuery( $query );
			$creator = $db->loadResult();

			$query = "SELECT name"
			. "\n FROM #__users"
			. "\n WHERE id=$row->modified_by"
			;
			$db->setQuery( $query );
			$modifier = $db->loadResult();
		}


		// dmcd May 20/04  fetch the new category colors from the '#__events_category' db table
		$query = "SELECT *"
		. "\n FROM #__events_categories"
		;
		$db->setQuery( $query );

		$catColors = $db->loadObjectList('id');

		$section = 0; // NO YET IMPLEMENTED

		$this->html->editEvents( $row,  $start_publish, $stop_publish, $start_time, $end_time, $section,
		$glist, $creator, $modifier, $option, $mode, $catColors, $lists
		);
	}


	/**
	* Cancels an edit operation
	* @param database A database connector object
	*/
	function _cancelEvents( $option ){
		$db	=& JFactory::getDBO();

		$row = new mosEvents( $db );
		$row->bind( $_POST );
		$row->checkin();
		$return2cat = intval( JRequest::getVar( 'return2cat', 0 ) );

		global $mainframe;
		$mainframe->redirect( 'index2.php?option=' . $option . '&task=viewEvents&catid=' . $return2cat );
	}


	/**
	* Saves the content item an edit form submit
	* @param database A database connector object
	*/
	function _saveEvents( $option ) {
		$db	=& JFactory::getDBO();
		$user =& JFactory::getUser();
		$cfg = & EventsConfig::getInstance();

		jimport("joomla.utilities.date");
		$start_time			= JRequest::getVar( 			'start_time', 		'08:00' );
		$start_pm			= intval( JRequest::getVar( 	'start_pm', 		'0' ) );
		$end_time			= JRequest::getVar( 			'end_time', 		'17:00' );
		$end_pm				= intval( JRequest::getVar( 	'end_pm', 			'0' ) );

		$reccurweekdays		= JRequest::getVar( 			'reccurweekdays', 	'' );
		$reccurweeks		= JRequest::getVar( 			'reccurweeks', 		'' );
		$reccurday_week		= JRequest::getVar( 			'reccurday_week', 	'' );
		$reccurday_month	= JRequest::getVar( 			'reccurday_month', 	'' );
		$reccurday_year		= JRequest::getVar( 			'reccurday_year', 	'' );

		$time = new JDate();
		$now				= $time->toMySQL();

		$row = new mosEvents( $db );

		// JREQUEST_ALLOWHTML requires at least Joomla 1.5 svn9979 (past 1.5 stable)
		$event_post = JRequest::get('post', JREQUEST_ALLOWHTML);
		$event_post['adresse_info'] = & $event_post['location'];

		if( !$row->bind($event_post)) {
			echo '<script> alert(\'' . $row->getError() . '\'); window.history.go(-1); </script>' . "\n";
			exit();
		}

		if( is_null( $row->useCatColor )){
			$row->useCatColor = 0;
		}

		if( $row->id ){
			$row->modified = $now;
			//date( "Y-m-d H:i:s" );
			if( $user->id ){
				$row->modified_by = $user->id;
			}
		}else{
			$row->created = $now;
			//date( "Y-m-d H:i:s" );
			if( $user->id ){
				$row->created_by = $user->id;
			}
		}

		if( $row->catid ){
			$row->catid = intval( $row->catid );
		}


		list( $start_hrs, $start_mins )	= explode( ':', $start_time );
		$start_hrs 		= intval($start_hrs);
		$start_mins		= intval($start_mins);

		list( $end_hrs, $end_mins )	= explode( ':', $end_time );
		$end_hrs 		= intval($end_hrs);
		$end_mins		= intval($end_mins);

		// reformat the time into 24hr format if necessary
		if( $cfg->get('com_calUseStdTime', 1) ) {

			if ($start_hrs > 12) $start_hrs = 0;
			if ($start_mins > 59) $start_mins = 0;
			if( $start_hrs != 12 && $start_pm ){
				$start_hrs += 12;
			} elseif( $start_hrs == 12 && !$start_pm ){
				$start_hrs = 0;
			}

			if ($end_hrs > 12) $end_hrs = 0;
			if ($end_mins > 59) $end_mins = 0;
			if( $end_hrs!= 12 && $end_pm ){
				$end_hrs += 12;
			} elseif( $end_hrs == 12 && !$end_pm ){
				$end_hrs = 0;
			}

		} else {
			if ($start_hrs > 23)	$start_hrs = 0;
			if ($end_hrs > 23)		$end_hrs = 0;
			if ($start_mins > 59)	$start_mins = 0;
			if ($end_mins > 59)		$end_mins = 0;
		}
		$start_time	= sprintf('%02d', $start_hrs) . ':' . sprintf('%02d', $start_mins);
		$end_time	= sprintf('%02d', $end_hrs)   . ':' . sprintf('%02d', $end_mins);

		if( $row->publish_up ){
			$publishtime		= $row->publish_up . ' ' . $start_time . ':00';
			$row->publish_up 	= strftime( '%Y-%m-%d %H:%M:%S', strtotime( $publishtime ));
		}else{
			$time = new JDate();
			$row->publish_up 	= $time->toFormat( '%Y-%m-%d 00:00:00');
			//date( "Y-m-d 00:00:00" );
		}

		if( $row->publish_down ){
			$publishtime 		= $row->publish_down . ' ' . $end_time . ':00';
			$row->publish_down 	= strftime( '%Y-%m-%d %H:%M:%S', strtotime( $publishtime ));
		} else {
			$time = new JDate();
			$row->publish_down 	= $time->toFormat( '%Y-%m-%d 23:59:59');
			//date( "Y-m-d 23:59:59" );
		}

		if( $row->publish_up <> $row->publish_down ){
			$row->reccurtype = intval( $row->reccurtype );
		}else{
			$row->reccurtype = 0;
		}

		if( $row->reccurtype == 0 ){
			$row->reccurday = '';
		}elseif( $row->reccurtype == 1 ){
			$row->reccurday =  $reccurday_week;
		}elseif( $row->reccurtype == 2 ){
			$row->reccurday = '';
		}elseif( $row->reccurtype == 3 ){
			$row->reccurday = $reccurday_month;
		}elseif( $row->reccurtype == 4 ){
			$row->reccurday = '';
		}elseif( $row->reccurtype == 5 ){
			$row->reccurday = $reccurday_year;
		}

		// Reccur week days
		if( $reccurweekdays == '' ) {
			$weekdays = '';
		}else{
			$weekdays = implode( '|', $reccurweekdays );
		}

		$row->reccurweekdays = $weekdays;

		// Reccur viewable weeks
		if( $reccurweeks == '' ){
			$weekweeks = '';
		}else{
			$weekweeks = implode( '|', $reccurweeks );
		}

		$row->reccurweeks = $weekweeks;

		// MLr: commenting out fixes bug #2959 ($access not defined - only in front end code
		/*
		// Always unpublish if no Publisher otherwise publish automatically
		if (!$access->canPublish) {
		$row->state = 0;
		} else {
		$row->state = 1;
		}
		*/

		// dmcd - nov 16/04  if this is a new event, publish it, otherwise retain its state
		if( !$row->id ){
			$row->state = 1;
		}

		$row->mask = 0;

		if( !$row->check() ) {
			echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
			exit();
		}

		if (!$row->store()) {
			echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
			exit();
		}

		$row->checkin();
		$row->reorder( "catid='$row->catid' AND state >= 0" );

		// Update Category Count
		$query = "UPDATE #__categories"
		. "\n SET count=count+1"
		. "\n WHERE id = $row->catid"
		;
		$db->setQuery( $query );
		if (!$db->query()) {
			echo "<script> alert('".$db->getError()."'); window.history.go(-1); </script>\n";
			exit();
		}

		$return2cat = intval( JRequest::getVar( 'return2cat', 0 ) );

		global $mainframe;
		$mainframe->redirect( 'index2.php?option=' . $option . '&task=viewEvents&catid=' . $return2cat );
	}

	function _removeEvents( $cid, $option ) {
		$db	=& JFactory::getDBO();

		if (!is_array( $cid ) || count( $cid ) < 1) {
			echo "<script>alert('" . html_entity_decode( _CAL_LANG_MSG_SEL_TO_DELETE )
			. "');window.history.go(-1);</script>\n";
			exit;
		}

		if (count( $cid )) {
			$cids = implode( ',', $cid );
			//Get Category ID prior to removing content, in order to update counts
			$query = "SELECT catid"
			. "\n FROM #__events"
			. "\n WHERE id IN ($cids)"
			;
			$db->setQuery( $query );
			$catid = $db->loadResult();

			$query = "DELETE FROM #__events"
			. "\n WHERE id IN ($cids)"
			;
			$db->setQuery( $query );
			if (!$db->query()) {
				echo "<script> alert('".$db->getErrorMsg()."'); window.history.go(-1); </script>\n";
			}
		}

		// Update Category Count
		$query = "UPDATE #__categories"
		. "\n SET count=count-1"
		. "\n WHERE id = $catid"
		;
		$db->setQuery( $query	);
		if (!$db->query()) {
			echo "<script> alert('".$db->getErrorMsg()."'); window.history.go(-1); </script>\n";
			exit();
		}

		global $mainframe;
		$mainframe->redirect( 'index2.php?option=' . $option );
	}


	/**
	* Clones a specified event.
	* @param integer The unique id of the record to clone
	* @param integer The id of the content section
	*/
	function _cloneEvents( $option, $eventid, $task) {
		$db	=& JFactory::getDBO();
		$user =& JFactory::getUser();

		$row = new mosEvents( $db );
		// load the row from the db table
		$row->load( $eventid );

		// fail if checked out not by 'me'
		if ($row->checked_out && $row->checked_out <> $user->id) {
			global $mainframe;
			$mainframe->redirect( "index2.php?option=$option",
			"The module $row->title is currently being edited by another administrator" );
		}

		// check out the event
		$row->checkout( $user->id );

		// clone the event
		$db->setQuery( "insert into #__events (sid,catid,title,content,adresse_info,contact_info,extra_info,color_bar,useCatColor,state,mask,created,created_by,created_by_alias,modified,modified_by,checked_out,checked_out_time,publish_up,publish_down,images,reccurtype,reccurday,reccurweekdays,reccurweeks,approved,ordering,archived,access,hits) "
		. "select sid,catid,title,content,adresse_info,contact_info,extra_info,color_bar,useCatColor,0,mask,created,created_by,created_by_alias,modified,modified_by,0,'0000-00-00 00:00:00',publish_up,publish_down,images,reccurtype,reccurday,reccurweekdays,reccurweeks,approved,ordering,archived,access,hits from #__events where id=$eventid" );
		$db->query();
		$newid = $db->insertid();

		// check in the event
		$row->checkin();

		if ($task=="cloneedit") {
			// redirect to edit new item
			global $mainframe;
			$mainframe->redirect("index2.php?option=$option&task=edit&cid[0]=$newid");
		}else {
			// show the list again
			viewEvents( $option );
		}
	}

	function _checkValidCategories(){
		$cfg = & EventsConfig::getInstance();
		$jev_component_name = $cfg->get("com_componentname");
		$db	=& JFactory::getDBO();
		$query = "SELECT id AS value, title AS text"
		. "\n FROM #__categories"
		. "\n WHERE section='$jev_component_name'"
		. "\n ORDER BY ordering"
		;
		$db->setQuery( $query );

		$categories = $db->loadObjectList();
		if (count($categories)<=0){
			global $mainframe;
			$mainframe->redirect("index2.php?option=$jev_component_name&task=categories","You must first create at least one category");
		}

	}

	/****************************************/
	/**
	 * Utility functiond during development and migration 
	 * TODO CHECK WHICH OF THESE MUST BE REMOVED BEFORE RELEASE!!!
	 */
	function dropIcalTables(){
		$user =& JFactory::getUser();

		if (strtolower($user->usertype)!="super administrator"){
			echo "sorry mate</br>";
		}
		$cfg = & EventsConfig::getInstance();
		$option = $cfg->get("com_componentname", "com_events");
		$db	=& JFactory::getDBO();
		$sql="DROP TABLE #__jevents_icsfile";
		$db->setQuery($sql);
		$db->query();

		$sql="DROP TABLE #__jevents_rrule";
		$db->setQuery($sql);
		$db->query();

		$sql="DROP TABLE #__jevents_vevdetail";
		$db->setQuery($sql);
		$db->query();

		$sql="DROP TABLE #__jevents_vevent";
		$db->setQuery($sql);
		$db->query();

		$sql="DROP TABLE #__jevents_repetition";
		$db->setQuery($sql);
		$db->query();
		global $mainframe;
		$mainframe->redirect( "index2.php?option=$option&task=cpanel", "Tables dropped" );

	}

	function migrate(){
		$cfg = & EventsConfig::getInstance();
		$option = $cfg->get("com_componentname", "com_events");
		require_once(dirname(__FILE__)."/lib/migration.php");

		JEvents_Migration::jevents_checkDatabase();
		JEvents_Migration::convertAdminMenu();

		//global $mainframe;
		//$mainframe->redirect( "index2.php?option=$option&task=cpanel", "Menu Migrated" );

	}


	function convertExtCal() {
		$cfg = & EventsConfig::getInstance();
		$option = $cfg->get("com_componentname", "com_events");
		global $mainframe;
		$mainframe->redirect( "index2.php?option=$option&task=cpanel", "Not yet fully implemented" );
		require_once(dirname(__FILE__)."/lib/migration.php");
		// Make sure general setup has been migrated first
		//$this->migrate();

		JEvents_Migration::convertExtCalData();

	}
}

?>
