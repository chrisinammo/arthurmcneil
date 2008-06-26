<?php
/**
 * Events Component for Joomla 1.5.x
 *
 * @version     $Id: events.html.php 986 2008-02-21 22:22:38Z tstahl $
 * @package     Events
 * @copyright   Copyright (C) 2006-2007 JEvents Project Group
 * @copyright   Copyright (C) 2000 - 2003 Eric Lamette, Dave McDonnell
 * @licence     http://www.gnu.org/copyleft/gpl.html
 * @link        http://joomlacode.org/gf/project/jevents
 */

// Thanks to Andrew Eddie for his help

// ################################################################
// MOS Intruder Alerts
defined( '_JEXEC' ) or die( 'Restricted access' );
// ################################################################
$user = & JFactory::getUser();
if( $user->id ){
	// load only if logged in (no need before [mic]
	require_once( JPATH_ADMINISTRATOR. '/includes/toolbar.php' );
}

// option masks
define( 'MASK_BACKTOLIST', 0x0001 );
define( 'MASK_READON',     0x0002 );
define( 'MASK_POPUP',      0x0004 );
define( 'MASK_HIDEPDF',    0x0008 );
define( 'MASK_HIDEPRINT',  0x0010 );
define( 'MASK_HIDEEMAIL',  0x0020 );
define( 'MASK_IMAGES',     0x0040 );
define( 'MASK_VOTES',      0x0080 );
define( 'MASK_VOTEFORM',   0x0100 );

define( 'MASK_HIDEAUTHOR',     0x0200 );
define( 'MASK_HIDECREATEDATE', 0x0400 );
define( 'MASK_HIDEMODIFYDATE', 0x0800 );

define( 'MASK_LINK_TITLES', 0x1000 );

// mos_content.mask masks
define( 'MASK_HIDE_TITLE', 0x0001 );
define( 'MASK_HIDE_INTRO', 0x0002 );

class HTML_events {

	var $datamodel = null;

	function HTML_events() {

		$this->datamodel  =  new JEventsDataModel();
		$this->datamodel->setupComponentCatids();
	}

	function getViewName()
	{
		echo "THERE IS A PROBLEM HERE!!!<br/>";
		return null;
	}

	// redundant function??
	function viewNavTableText( $prev_offset, $page_bar, $next_offset, $max_offset, $option, $task, $Itemid ){
		/*
		global $catidsOut;

		$cfg = & EventsConfig::getInstance();

		$cat = "";
		if ($catidsOut != 0){
		$cat = '&catids='.$catidsOut;
		} ?>

		<table cellpadding="2" cellspacing="0" border="0" width="100%">
		<tr class="nav_bar_cell">
		<td align="center" class="heading" width="100%">
		<?php
		$link = 'index.php?option=' . $option . '&task=' . $task . $cat . '&Itemid=' . $Itemid
		. '&offset=';

		$eventlinkstart = JRoute::_( $link . '1' );?>
		<a href="<?php echo $eventlinkstart;?>" title="<?php echo _CAL_LANG_NAV_TN_FIRST_LIST; ?>">
		<strong>&laquo;&laquo;</strong>
		</a>

		<?php $eventlinkprevoffset=JRoute::_( $link . $prev_offset );?>
		<a href="<?php echo $eventlinkprevoffset;?>" title="<?php echo _CAL_LANG_NAV_TN_PREV_LIST; ?>">
		<strong>&laquo;</strong>
		</a>

		<?php echo $page_bar;?>
		<?php $eventlinknextoffset=JRoute::_( $link . $next_offset );?>
		<a href="<?php echo $eventlinknextoffset;?>" title="<?php echo _CAL_LANG_NAV_TN_NEXT_LIST; ?>">
		<strong>&raquo;</strong>
		</a>

		<?php $eventlinkmaxoffset=JRoute::_( $link . $max_offset );?>
		<a href="<?php echo $eventlinkmaxoffset;?>" title="<?php echo _CAL_LANG_NAV_TN_LAST_LIST; ?>">
		<strong>&raquo;&raquo;</strong>
		</a>
		</td>
		</tr>
		</table>
		<p align="center">
		<a href="javascript:window.history.go(-1);" title="<?php echo _CAL_LANG_BACK; ?>"><?php echo _CAL_LANG_BACK; ?></a>
		</p>
		<?php
		*/
	}

	function viewFormEvent( $row, $start_publish, $stop_publish, $start_time, $end_time, $lists, $Itemid, $option, $task, $mode, $catColors, $agid) {
		// TODO make admin side class aware too!
		global $mainframe;
		$mainframe->set( 'joomlaJavascript', 1 );

		require_once( JPATH_ADMINISTRATOR. '/includes/toolbar.php' );
		$admin_html = $mainframe->getPath( 'admin_html' ) ;
		$admindir = dirname($admin_html);

		// load language constants
		EventsHelper::loadLanguage('admin');

		require_once($admin_html );

		echo '<div align="right">';

		//JToolBarHelper::startTable();

		$access =& EventsHelper::getJEV_Access();
		if (isset($row) && !is_null($row->id) && isset($row->id) && $row->id>0 && isset($row->state) && $row->state==0 && $access->canPublish()){
			JToolBarHelper::custom("publish","publish.png","publish_f2.png","",false);
			JToolBarHelper::spacer();
		}
		JToolBarHelper::save();
		JToolBarHelper::spacer();
		JToolBarHelper::cancel();
		
		$bar = & JToolBar::getInstance('toolbar');
		echo $bar->render();
		echo '</div>';

		if (isset($row) && isset($row->id)) $eventid = $row->id;
		else $eventid=0;

		$user = & JFactory::getUser();
		$db	=& JFactory::getDBO();
		if ($user->usertype=="Manager" || $user->usertype=="Administrator" || $user->usertype=="Super Administrator"){
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
		}

		$creator	= '';
		$modifier	= '';
		if( $eventid ) {
			$query = "SELECT name"
			. "\n FROM #__users"
			. "\n WHERE id=".$row->created_by
			;
			$db->setQuery( $query );
			$creator = $db->loadResult();

			$query = "SELECT name"
			. "\n FROM #__users"
			// TODO add this as a class function
			. "\n WHERE id=".$row->modified_by
			;
			$db->setQuery( $query );
			$modifier = $db->loadResult();
		}

		$hiddenVals = "\n".'<input type="hidden" name="state" value="'.$row->state.'" />'."\n";
		// TODO add this as a class function
		$hiddenVals .= '<input type="hidden" name="created_by_alias" value="'.$row->created_by_alias.'" />';
		$hiddenVals .= '<input type="hidden" name="Itemid" value="'.$Itemid.'" />';
		/*
		// Captch code for anon and registered users
		$user = & JFactory::getUser();
		if ($user->gid<2){
		JToolBarHelper::spacer();
		if (file_exists(JPATH_BASE.'/administrator/components/com_securityimages/client.php')) {
		include_once(JPATH_BASE.'/administrator/components/com_securityimages/client.php');
		$secImg =  insertSecurityImage("security_refid");
		$hiddenVals .= $secImg;
		$hiddenVals .= getSecurityImageText("security_try");
		}
		}
		*/
		// trigger the onBeforeEventEdit mambot
		global  $params;
		$dispatcher	=& JDispatcher::getInstance();
		$dispatcher->trigger( 'onBeforeEventEdit' , array(&$hiddenVals,&$params), true );

		$glist = null;
		$section = 0; // NO YET IMPLEMENTED

		// TODO : create image list like backend
		$images = array();

		$html_events_admin = & HTML_events_admin::getInstance();
		$html_events_admin->editEvents( $row,  $start_publish, $stop_publish, $start_time, $end_time, $section,
		$glist, $creator, $modifier, $option, $mode, $catColors, $lists, $hiddenVals);
	}

	function viewNavAdminPanel( $year, $month, $day, $option, $Itemid ){
		$is_event_editor = EventsHelper::isEventEditor();
		$user = & JFactory::getUser();

		$cfg = & EventsConfig::getInstance();

		if( $is_event_editor) { ?>
		<div class="ev_adminpanel">
		<table width="100%" border="0" align="center">
			<tr>
				<td align="left" class="nav_bar_cell">
                        <?php
                        $eventlinkadd = JRoute::_( 'index.php?option=' . $option
                        . '&task=editIcalEvent' . '&year=' . $year . '&month=' . $month . '&day=' . $day
                        . '&Itemid=' . $Itemid ); ?>
                        <a href="<?php echo $eventlinkadd; ?>" title="<?php echo _CAL_LANG_ADDEVENT;?>">
                            <b><?php echo _CAL_LANG_ADDEVENT."(ICAL)";?></b>
                        </a>
                        <br />
                        <?php
                        if ($cfg->get('com_legacyEvents',1)){
                        	$eventlinkadd = JRoute::_( 'index.php?option=' . $option
                        	. '&task=add' . '&year=' . $year . '&month=' . $month . '&day=' . $day
                        . '&Itemid=' . $Itemid ); ?>
                        <a href="<?php echo $eventlinkadd; ?>" title="<?php echo _CAL_LANG_ADDEVENT;?>">
                            <b><?php echo _CAL_LANG_ADDEVENT;?></b>
                        </a>
                        <br />
                        <?php
						}
                        if(( strtolower( $user->usertype ) != '' )) {
                        	$eventmylinks = JRoute::_( 'index.php?option=' . $option . '&task=admin'
                        	. '&year=' . $year . '&month=' . $month . '&day=' . $day
                            . '&Itemid=' . $Itemid ); ?>
                            <a href="<?php echo $eventmylinks; ?>" title="<?php echo _CAL_LANG_MYEVENTS; ?>">
                                <b><?php echo _CAL_LANG_MYEVENTS; ?></b>
                            </a>
                            <?php
                        }?>
				</td>
			</tr>
		</table>
		</div>
		<?php	} 
		}


		function eventsHeader( $Itemid, $year, $month, $day, $task) {
			global $mainframe;
$cfg = & EventsConfig::getInstance();
$option = $cfg->get("com_componentname");
			$version = & EventsVersion::getInstance();

			echo "\n" . '<!-- '
			. $version->getLongVersion() . ', '
			. html_entity_decode($version->getLongCopyright(), ENT_COMPAT, 'utf-8') . ', '
			. $version->getUrl()
			. ' -->' . "\n";
		?>
		<table class="contentpaneopen" id="jevents_header">
			<tr>
			<td class="contentheading" width="100%">
			<?php 
			global $menu;
			if (isset($menu) && isset($menu->name)) echo $menu->name;
			else echo _CAL_LANG_EVENT_CALENDAR;
			?>
			</td>
			<?php
			if (strpos($task,"view_") === 0 ){
				global  $catidsIn;
				$pop = intval(JRequest::getVar( 'pop', 0 ));
				if (isset($catidsIn) && $catidsIn!="NONE") $cids = "&catids=$catidsIn";
				else $cids = "";
				// link used by print button
				$print_link = JURI::root() . "index2.php?option=$option&Itemid=$Itemid&task=$task&month=$month&year=$year&pop=1$cids";
				$row = 1; // not used in PrintIcon !!
				$params =& new JParameter(null);
				$params->set("print",true);
				$params->set("icons",true);
				if ($pop) $params->set("popup",true);
				//TODO mosHTML::PrintIcon( $row, $params, false, $print_link );
			}
			echo '<td class="buttonheading" align="right">';
			echo "<a href=\"http://www.jevents.net\" target='_blank'>"
			. "<img src=\"" . JURI::root() . "components/$option/images/help.gif\" border=\"0\" alt=\"help\" />"
			. "</a>";
			?>
            </td>
			</tr>
		</table>
		<table class="contentpaneopen" id="jevents_body">
			<tr>
			<td width="100%">
	<?php }

	function eventsFooter( $Itemid, $year, $month, $day, $task) {
		HTML_events::viewCopyright ();
		?>
		   </td>
		   </tr>
		</table>
	<?php }

	function viewCopyright() {

		global $mainframe;

		$cfg	 = & EventsConfig::getInstance();

		$version = & EventsVersion::getInstance();

		if ($cfg->get('com_copyright', 1) == 1) {
?>
		<p align="center">
			<a href="<?php echo $version->getUrl();?>" target="_blank" style="font-size:xx-small;" title="Events Website"><?php echo $version->getLongVersion();?></a>
			&nbsp;
			<span style="color:#999999; font-size:9px;"><?php echo $version->getShortCopyright();?></span>
		</p>
		<?php
		}
	}

	// page navigation
	function showNavTableText( $year, $total, $limitstart, $limit, $task ){
		if ($limit<0) return;
		global   $mainframe;
$cfg = & EventsConfig::getInstance();
$option = $cfg->get("com_componentname");
		$Itemid	= EventsHelper::getItemid();

		if ( ( $total <= $limit ) ) {
			// not visible when they is no 'other' pages to display
		} else {
			// get the total number of records
			$limitstart = $limitstart ? $limitstart : 0;

			require_once( JPATH_ROOT. '/includes/pageNavigation.php' );
			$pageNav = new JPagination( $total, $limitstart, $limit );

			$link = 'index.php?option=' .$option. '&task=' .$task. '&year=' .$year. '&Itemid='. $Itemid;
			//echo '<tr>';
			//echo '<td valign="top" align="center">';
			echo  '<center>';
			echo $pageNav->getPagesLinks( $link );
			echo  '</center><br />';
			//echo '</td>';
			//echo '</tr>';
		}
	}
  	function viewSearchForm( $keyword, $option, $task, $Itemid ){ ?>

    	<table cellpadding="0" cellspacing="0" border="0" width="100%">
      		<tr>
      			<td align="center" width="100%">
      				<form action="index.php" method="get" style="font-size:1;">
      					<input type="hidden" name="option" value="<?php echo $option; ?>" />
      					<input type="hidden" name="task" value="search" />
      					<input type="hidden" name="Itemid" value="<?php echo $Itemid;?>" />
      					<input type="text" name="keyword" size="30" maxlength="50" class="inputbox" value="<?php echo $keyword;?>" />
      					<br />
      					<input class="button" type="submit" name="push" value="<?php echo _SEARCH_TITLE; ?>" />
      				</form>
      			</td>
      		</tr>
      	</table>
      	<?php
  	}

  	function viewYear( $Itemid, $year, $month, $day, $option, $task ,$limit, $limitstart ){
  		$this->eventsHeader( $Itemid, $year, $month, $day, $task );
  		$this->showNavTableBar( $year, $month, $day, $option, $task, $Itemid );
  		$this->showEventsByYearNEW( $year, $limit, $limitstart );
  		$this->viewNavAdminPanel( $year, $month, $day, $option, $Itemid );
  		$this->eventsFooter( $Itemid, $year, $month, $day, $task);
  	}

  	function viewMonth($Itemid, $year, $month, $day, $option, $task )
  	{
  		$this->eventsHeader( $Itemid, $year, $month, $day, $task );
  		$this->showNavTableBar( $year, $month, $day, $option, $task, $Itemid );
  		$this->showCalendarNEW( $year, $month, $day );
  		$this->viewNavAdminPanel( $year, $month, $day, $option, $Itemid );
  		$this->eventsFooter( $Itemid, $year, $month, $day, $task);
  	}
  	function view_last( $Itemid, $year, $month, $day, $option, $task ){
  		$this->eventsHeader( $Itemid, $year, $month, $day, $task );
  		$this->showNavTableBar( $year, $month, $day, $option, $task, $Itemid );
  		$this->showEventsByMonthNEW( $year, $month );
  		$this->viewNavAdminPanel( $year, $month, $day, $option, $Itemid );
  		$this->eventsFooter( $Itemid, $year, $month, $day, $task);
  	}
  	function view_week( $Itemid, $year, $month, $day, $option, $task )
  	{
  		$this->eventsHeader( $Itemid, $year, $month, $day, $task );
  		$this->showNavTableBar( $year, $month, $day, $option, $task, $Itemid );
  		$this->showEventsByWeekNEW( $year, $month, $day );
  		$this->viewNavAdminPanel( $year, $month, $day, $option, $Itemid );
  		$this->eventsFooter( $Itemid, $year, $month, $day, $task);
  	}
  	function view_day( $Itemid, $year, $month, $day, $option, $task )
  	{
  		$this->eventsHeader( $Itemid, $year, $month, $day, $task );
  		$this->showNavTableBar( $year, $month, $day, $option, $task, $Itemid );
  		$this->showEventsByDateNEW( $year, $month, $day );
  		$this->viewNavAdminPanel( $year, $month, $day, $option, $Itemid );
  		$this->eventsFooter( $Itemid, $year, $month, $day, $task);
  	}
  	function view_detail( $Itemid, $year, $month, $day, $option, $task, $pop, $agid,$jevtype )
  	{
  		$this->eventsHeader( $Itemid, $year, $month, $day, $task );
  		//  don't show navbar stuff for events detail popup
  		if( !$pop ){
  			$this->showNavTableBar( $year, $month, $day, $option, $task, $Itemid );
  		}
  		$this->showEventsById( $agid, $jevtype, $year, $month, $day );
  		if( !$pop ){
  			$this->viewNavAdminPanel( $year, $month, $day, $option, $Itemid );
  		}
  		$this->eventsFooter( $Itemid, $year, $month, $day, $task);
  	}
  	function view_cat( $Itemid, $year, $month, $day, $option, $task, $catid, $limit, $limitstart ){
  		$this->eventsHeader( $Itemid, $year, $month, $day, $task );
  		$this->showNavTableBar( $year, $month, $day, $option, $task, $Itemid );
  		$this->viewNavCatText( $catid, $option, 'view_cat', $Itemid );
  		$this->showEventsByCat( $catid, $limit, $limitstart );
  		$this->viewNavAdminPanel( $year, $month, $day, $option, $Itemid );
  		$this->eventsFooter( $Itemid, $year, $month, $day, $task);
  	}
  	function view_search($Itemid, $year, $month, $day, $option, $task )
  	{
  		$this->eventsHeader( $Itemid, $year, $month, $day, $task );
  		$this->showNavTableBar( $year, $month, $day, $option, $task, $Itemid );
  		$this->viewSearchForm( '', $option, $task, $Itemid );
  		$this->viewNavAdminPanel( $year, $month, $day, $option, $Itemid );
  		$this->eventsFooter( $Itemid, $year, $month, $day, $task);
  	}
  	function searchResults($Itemid, $year, $month, $day, $option, $task,$keyword, $limit, $limitstart  ){
  		$this->eventsHeader( $Itemid, $year, $month, $day, $task );
  		$this->showNavTableBar( $year, $month, $day, $option, $task, $Itemid );
  		$this->showEventsByKeyword( $keyword, $limit, $limitstart, true );
  		$this->viewNavAdminPanel( $year, $month, $day, $option, $Itemid );
  		$this->eventsFooter( $Itemid, $year, $month, $day, $task);
  	}
  	function adminEvents($Itemid, $year, $month, $day, $option, $task,$creator_id, $limit, $limitstart   ){
  		$this->eventsHeader( $Itemid, $year, $month, $day, $task );
  		$this->showNavTableBar( $year, $month, $day, $option, $task, $Itemid );
  		$user = & JFactory::getUser();
  		if (!( strtolower( $user->usertype ) == '')) $this->showEventsForAdmin( $creator_id, $limit, $limitstart );
  		$this->viewNavAdminPanel( $year, $month, $day, $option, $Itemid );
  		$this->eventsFooter( $Itemid, $year, $month, $day, $task);
  	}
	}
?>
