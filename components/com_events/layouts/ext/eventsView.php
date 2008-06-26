<?php
/**
 * Events Component for Joomla 1.5.x
 *
 * @version     $Id: eventsView.php 978 2008-02-16 15:29:27Z tstahl $
 * @package     Events
 * @copyright   Copyright (C) 2006-2007 JEvents Project Group
 * @copyright   Copyright (C) 2003 Eric Lamette
 * @licence     http://www.gnu.org/copyleft/gpl.html
 * @link        http://joomlacode.org/gf/project/jevents
 */

defined('_JEXEC') or die( 'Direct Access to this location is not allowed.' );

global $mainframe;
$cfg = & EventsConfig::getInstance();
$compname = $cfg->get("com_componentname");

include_once(JPATH_SITE."/components/$compname/layouts/default/eventsView.php");

EventsViewer::setViewClassName("front","JEvents_Ext_View");

Class JEvents_Ext_View  extends JEvents_Default_View  {

	function getViewName()
	{
		return "ext";
	}

	function viewMonth($Itemid, $year, $month, $day, $option, $task )
	{
		$this->eventsHeader( $Itemid, $year, $month, $day, $task );
		$this->showNavTableBar( $year, $month, $day, $option, $task, $Itemid );
		$this->showCalendarNEW(  $year, $month, $day );
		$this->eventsFooter( $Itemid, $year, $month, $day, $task);
		$this->viewNavAdminPanel( $year, $month, $day, $option, $Itemid );
	}

	function eventsLegend()
	{
		// include the appropraite VIEW - this should be based on config and/or URL?
		$JEventsModCalClass = EventsViewer::viewClassName("mod_legend");
		$jeventCalObject = & new $JEventsModCalClass();
		echo $jeventCalObject->displayCalendarLegend("table");
		echo "<br style='clear:both'/>";
	}

	function showCalendarNEW(  $year, $month, $day ){
		$data = $this->datamodel->getCalendarData( $year, $month, $day );

		global $mainframe;
		$cfg = & EventsConfig::getInstance();
		$option = $cfg->get("com_componentname");
		$Itemid = EventsHelper::getItemid();

		$cfg = & EventsConfig::getInstance();
		$compname = $cfg->get("com_componentname");
		$viewname = $this->getViewName();
		$viewpath = JURI::root() . "/components/$compname/layouts/".$viewname;
		$viewimages = $viewpath . "/images";

		EventsHelper::loadOverlib();

		include_once( JPATH_SITE . '/components/' . $option . '/layouts/'.$viewname.'/events_calendar_cell.php' );
		$eventCellClass = "EventCalendarCell_".$viewname;

		// previous and following month names and links
		$followingMonth = $this->datamodel->getFollowingMonth($data);
		$precedingMonth = $this->datamodel->getPrecedingMonth($data);

		//if( _CAL_CONF_TT_SHADOW == 1 ){ // disbled only for test [mic]
		if( !defined( '_LOAD_OVERLIB_SHADOW' )){
            define( '_LOAD_OVERLIB_SHADOW', 1 ); ?>
            <script type="text/javascript" src="<?php echo JURI::root(); ?>/components/<?php echo $compname;?>/js/overlib_shadow.js"></script>
            <?php
		}
    ?>
<table class="maintable" align="center" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td class="tableh1" colspan="8">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
				<tr> 
					<td><h2>Monthly View</h2></td>
					<td class="today" align="right"><?php echo $data['fieldsetText']; ?></td>				
				</tr>
			</table>
	  </td>
	</tr>
		<tr>
<!-- BEGIN weeknumber_row -->
			<td rowspan="2" class="tablev1">&nbsp;&nbsp;</td>
<!-- END weeknumber_row -->
			<td colspan="2" class="previousmonth" align="center" height="22" nowrap="nowrap" valign="middle">&nbsp;
<!-- BEGIN previous_month_link_row -->
      	<?php echo "<a href='".$precedingMonth["link"]."' title='last month' >"?>
      	<img src="<?php echo $viewimages;?>/mini_arrowleft.gif" alt="<?php echo $precedingMonth['name'];?>" align="middle" border="0" hspace="5"/>
      	<?php echo $precedingMonth['name'];?>
      	</a>

<!-- END previous_month_link_row -->
			</td>
			<td colspan="3" class="currentmonth" style="background-color: rgb(208, 230, 246);" align="center" height="22" nowrap="nowrap" valign="middle">
				<?php echo $data['fieldsetText']; ?>
			</td>
			<td colspan="2" class="nextmonth" align="center" height="22" nowrap="nowrap" valign="middle">
      	<?php echo "<a href='".$followingMonth["link"]."' title='next month' >"?>
      	<?php echo $followingMonth['name'];?>
      	<img src="<?php echo $viewimages;?>/mini_arrowright.gif" alt="<?php echo $followingMonth['name'];?>" align="middle" border="0" hspace="5"/>
      	</a>

			</td>
		</tr>	
            <tr valign="top">
                <?php foreach ($data["daynames"] as $dayname) { ?>
                	<td class="weekdaytopclr" align="center" height="18" valign="middle" width="14%">
                        <?php 
                        echo $dayname;?>
					</td>
                    <?php
                } ?>
            </tr>
            <?php
            $datacount = count($data["dates"]);
            $dn=0;
            for ($w=0;$w<6 && $dn<$datacount;$w++){
            ?>
			<tr valign="top" style="height:80px;">				
                <td class='tablev1' align='center'>
                <?php
                list($week,$link) = each($data['weeks']);
                echo "<a href='".$link."'>$week</a></td>\n";
                for ($d=0;$d<7 && $dn<$datacount;$d++){
                	$currentDay = $data["dates"][$dn];
                	switch ($currentDay["monthType"]){
                		case "prior":
                		case "following":
                		?>
                    <td class="weekdayemptyclr" align="center" height="50" valign="middle">
                        <?php echo $currentDay["d"]; ?>
                    </td>
                    	<?php
                    	break;

                		case "current":
                			//Current month
                			$dayOfWeek = strftime("%w",$currentDay["cellDate"]);
                			$style=($dayOfWeek==0)?"sundayemptyclr":"weekdayclr";
                			if ($currentDay['today']) $style="todayclr"
					?>
                    <td class="<?php echo $style;?>" width="14%" align="center" height="50" valign="top">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
						<tr>
						<td class="caldaydigits">&nbsp;
						<strong><a href="<?php echo $currentDay["link"]; ?>" title="<?php echo _CAL_LANG_CLICK_TOSWITCH_DAY; ?>"><?php echo $currentDay['d']; ?></a></strong>
						</td>
						</tr>
					</table>
                        <?php

                        if (count($currentDay["events"])>0){
                        	foreach ($currentDay["events"] as $key=>$val){
                        		$ecc = new $eventCellClass($val, $this->datamodel);
								if( $currentDay['countDisplay'] < $cfg->get('com_calMaxDisplay')){
                        			echo '<table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td>' . "\n";
                        			echo $ecc->calendarCell($currentDay,$year,$month,$key);
                        			echo '</td></tr></table>' . "\n";
								} else {
									echo '<div style="padding:0;margin:0;width:10px;float:left">';
                        			echo $ecc->calendarCell($currentDay,$year,$month,$key);
									echo '</div>';
								}
								$currentDay['countDisplay']++;
                        	}
                        }
					?>
                    </td>
                    <?php
                    break;
                	}
                	$dn++;
                }
                ?>
            </tr>
            <?php
            }
         ?>   
         <tr>
	<td colspan="8" class="tablec">
<?php   		
$this->eventsLegend();
	?>
	</td>
</tr>

        </table>
    <?php
	}


	function viewNavTableBarIconic( $today_date, $this_date, $dates, $alts, $option, $task, $Itemid ) {
		global $catidsOut;
		global $mainframe;
		$cfg = & EventsConfig::getInstance();
		$compname = $cfg->get("com_componentname");

		$viewname = $this->getViewName();
		$viewpath = JURI::root() . "/components/$compname/layouts/".$viewname;
		$viewimages = $viewpath . "/images";

		$cat		= "";
		$hiddencat	= "";
		if ($catidsOut!=0){
			$cat = '&catids=' . $catidsOut;
			$hiddencat = '<input type="hidden" name="catids" value="'.$catidsOut.'"/>';
		}

		$link = 'index.php?option=' . $option . '&task=' . $task . $cat . '&Itemid=' . $Itemid. '&';
    	?>
    	<table bgcolor="#ffffff" border="0" cellpadding="10" cellspacing="0" width="100%">
    	<tr>
    		<td class="tableh1" align="center">
    		<table border="0" cellpadding="0" cellspacing="0">
    			<tr>
    		<!-- BEGIN add_event -->
    		<!--
					<td><img name="spacer" src="http://joomla1.0.10/components/com_extcalendar//images/spacer.gif"  alt="" border="0" height="25" width="10"/></td>
					<td class="buttontext" align="center" nowrap="nowrap" valign="middle">

						<a href="http://joomla1.0.10/index.php?option=com_extcalendar&Itemid=37&extmode=addevent" title="Add Event" class="buttontext">
							<img src="http://joomla1.0.10/components/com_extcalendar//themes/default/images/icon-addevent.gif" alt="Add Event" border="0"><br/>
							Add Event</a>
					</td>
				-->
    		<!-- END add_event -->
<!-- BEGIN flyer_view -->
					<td><img name="spacer" src="<?php echo $viewimages;?>/spacer.gif"  alt="" border="0" height="25" width="10"/></td>
					<td class="buttontext" align="center" nowrap="nowrap" valign="middle">
						<a href="<?php echo JRoute::_( 'index.php?option=' . $option . $cat . '&task=view_year&'. $today_date->toDateURL() . '&Itemid=' . $Itemid );?>" title="<?php echo  _CAL_LANG_VIEWBYYEAR;?>"  class="buttontext">
							<img src="<?php echo $viewimages;?>/icon-flyer.gif" alt="Flat View" border="0"/><br/>
							<?php echo _CAL_LANG_VIEWBYYEAR;?></a>
					</td>
<!-- END flyer_view -->
<!-- BEGIN monthly_view -->
					<td><img name="spacer" src="<?php echo $viewimages;?>/spacer.gif"  alt="" border="0" height="25" width="10"/></td>
					<td class="buttontext" align="center" nowrap="nowrap" valign="middle">
						<a href="<?php echo JRoute::_( 'index.php?option=' . $option . $cat . '&task=view_month&'. $today_date->toDateURL() . '&Itemid=' . $Itemid );?>" title="<?php echo  _CAL_LANG_VIEWBYMONTH;?>" class="buttontext">
							<img src="<?php echo $viewimages;?>/icon-calendarview.gif" alt="Monthly View" border="0"/><br/>
							<?php echo  _CAL_LANG_VIEWBYMONTH;?></a>
					</td>
<!-- END monthly_view -->
<!-- BEGIN weekly_view -->
					<td><img name="spacer" src="<?php echo $viewimages;?>/spacer.gif"  alt="" border="0" height="25" width="10"/></td>
					<td class="buttontext" align="center" nowrap="nowrap" valign="middle">
						<a href="<?php echo JRoute::_( 'index.php?option=' . $option . $cat . '&task=view_week&'. $today_date->toDateURL() . '&Itemid=' . $Itemid );?>" title="<?php echo  _CAL_LANG_VIEWBYWEEK;?>" class="buttontext">
							<img src="<?php echo $viewimages;?>/icon-weekly.gif" alt="Weekly View" border="0"/><br/>
							<?php echo  _CAL_LANG_VIEWBYWEEK;?></a>
					</td>
<!-- END weekly_view -->
<!-- BEGIN daily_view -->
					<td><img name="spacer" src="<?php echo $viewimages;?>/spacer.gif"  alt="" border="0" height="25" width="10"/></td>
					<td class="buttontext" align="center" nowrap="nowrap" valign="middle">
						<a href="<?php echo JRoute::_( 'index.php?option=' . $option . $cat . '&task=view_day&'. $today_date->toDateURL() . '&Itemid=' . $Itemid );?>" title="<?php echo  _CAL_LANG_VIEWTODAY;?>" class="buttontext">
							<img src="<?php echo $viewimages;?>/icon-daily.gif" alt="Daily View" border="0"/><br/>
							<?php echo _CAL_LANG_VIEWTODAY;?></a>
					</td>

<!-- END daily_view -->
<!-- BEGIN cat_view -->
					<td><img name="spacer" src="<?php echo $viewimages;?>/spacer.gif"  alt="" border="0" height="25" width="10"/></td>
					<td class="buttontext" align="center" nowrap="nowrap" valign="middle">
						<a href="<?php echo JRoute::_( 'index.php?option=' . $option . $cat . '&task=view_cat&'. $today_date->toDateURL() . '&Itemid=' . $Itemid );?>" title="<?php echo  _CAL_LANG_VIEWBYCAT;?>" class="buttontext">
							<img src="<?php echo $viewimages;?>/icon-cats.gif" alt="Categories" border="0"/><br/>
							<?php echo  _CAL_LANG_VIEWBYCAT;?></a>
					</td>
<!-- END cat_view -->
<!-- BEGIN search_view -->
					<td><img name="spacer" src="<?php echo $viewimages;?>/spacer.gif"  alt="" border="0" height="25" width="10"/></td>
					<td class="buttontext" align="center" nowrap="nowrap" valign="middle">
						<a href="<?php echo JRoute::_( 'index.php?option=' . $option . $cat . '&task=view_search&'. $today_date->toDateURL() . '&Itemid=' . $Itemid );?>" title="<?php echo  _SEARCH_TITLE;?>" class="buttontext">
							<img src="<?php echo $viewimages;?>/icon-search.gif" alt="Search" border="0"/><br/>
							<?php echo _SEARCH_TITLE;?></a>
					</td>
<!-- END search_view -->
					
				</tr>
			</table>

        </td>
        </tr></table>
		<?php    	
	}


}

?>
