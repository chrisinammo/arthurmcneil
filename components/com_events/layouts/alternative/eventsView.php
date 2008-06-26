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
$option = $cfg->get("com_componentname");
include_once(JPATH_SITE."/components/$option/layouts/default/eventsView.php");

EventsViewer::setViewClassName("front","JEvents_Alternative_View");

Class JEvents_Alternative_View  extends JEvents_Default_View  {

	function getViewName()
	{
		return "alternative";
	}

	function viewMonth($Itemid, $year, $month, $day, $option, $task )
	{
		$this->eventsHeader( $Itemid, $year, $month, $day, $task );
		$this->showNavTableBar( $year, $month, $day, $option, $task, $Itemid );
		$this->showCalendarNEW( $year, $month, $day );
		$this->eventsLegend();
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


	function buildMonthSelect($link, $month, $year ){
		for( $a=-6; $a<6; $a++ ){
			$m = $month+$a;
			$y=$year;
			if ($m<=0){
				$m+=12;
				$y-=1;
			}
			if ($m>12){
				$m-=12;
				$y+=1;
			}
			$name_of_month = EventsHelper::getMonthName($m)." $y";
			$monthslist[] = JHTML::_('select.option', "$m|$y", $name_of_month );
		}
		$cfg = & EventsConfig::getInstance();
		$jev_component_name  = $cfg->get("com_componentname");

		$tosend = "<script language='JavaScript' type='text/javascript'>\n";
		$tosend .= " function selectMD(elem) {
        var ym = elem.options[elem.selectedIndex].value.split('|');\n";

		$link.="day=1&month=MMMMmmmm&year=YYYYyyyy";
		$link2 = JRoute::_($link);
		$tosend .= "var link = '$link2';\n";
		// This is needed in case SEF is not activated
		$tosend .= "link = link.replace(/&/g,'&');\n";
		$tosend .= "link = link.replace(/MMMMmmmm/g,ym[0]);\n";
		$tosend .= "link = link.replace(/YYYYyyyy/g,ym[1]);\n";
		$tosend .= "location.replace(link);\n";
		$tosend .= "}\n";
		$tosend .= "</script>\n";
		$tosend .= JHTML::_('select.genericlist', $monthslist, 'monthyear', "onchange=\"selectMD(this);\"", 'value', 'text', "$month|$year" );
		return $tosend;
	}

	function viewNavTableBarIconic( $today_date, $this_date, $dates, $alts, $option, $task, $Itemid ) {
		global $catidsOut;
		global $mainframe;

		$cfg = & EventsConfig::getInstance();

		$cat		= "";
		$hiddencat	= "";
		if ($this->datamodel->catidsOut!=0){
			$cat = '&catids=' . $this->datamodel->catidsOut;
			$hiddencat = '<input type="hidden" name="catids" value="'.$this->datamodel->catidsOut.'"/>';
		}

		$link = 'index.php?option=' . $option . '&task=' . $task . $cat . '&Itemid=' . $Itemid. '&';

		$monthSelect = $this->buildMonthSelect( $link,$this_date->month,$this_date->year);

		$transparentGif = JURI::root() . "/components/$option/images/transp.gif";
    	?>
    	<div class="ev_navigation" style="width:100%">
    		<table  border="0" >
    			<tr valign="top">
    				<td class="iconic_td" align="center" valign="middle">
    					<div id="ev_icon_monthly<?php echo ($task=="view_month")?"_active":""?>" class="nav_bar_cal" ><a href="<?php echo JRoute::_( 'index.php?option=' . $option . $cat . '&task=view_month&'. $today_date->toDateURL() . '&Itemid=' . $Itemid );?>" title="<?php echo  _CAL_LANG_VIEWBYMONTH;?>">
    					<img src="<?php echo $transparentGif;?>" alt="<?php echo _CAL_LANG_VIEWBYMONTH;?>"/></a>
    					</div>
                    </td>
    				<td class="iconic_td" align="center" valign="middle">
    					<div id="ev_icon_weekly<?php echo $task=="view_week"?"_active":""?>" class="nav_bar_cal"><a href="<?php echo JRoute::_( 'index.php?option=' . $option . $cat . '&task=view_week&'. $today_date->toDateURL() . '&Itemid=' . $Itemid );?>" title="<?php echo  _CAL_LANG_VIEWBYWEEK;?>">
    					<img src="<?php echo $transparentGif;?>" alt="<?php echo _CAL_LANG_VIEWBYWEEK;?>"/></a>
    					</div>
                    </td>
    				<td class="iconic_td" align="center" valign="middle">
    					<div id="ev_icon_daily<?php echo $task=="view_day"?"_active":""?>" class="nav_bar_cal" ><a href="<?php echo JRoute::_( 'index.php?option=' . $option . $cat . '&task=view_day&'. $today_date->toDateURL() . '&Itemid=' . $Itemid );?>" title="<?php echo  _CAL_LANG_VIEWTODAY;?>"><img src="<?php echo $transparentGif;?>" alt="<?php echo _CAL_LANG_VIEWBYDAY;?>"/></a>
    					</div>
                    </td>
    				<td class="iconic_td" align="center" valign="middle">
    				<?php echo $monthSelect;?>
					</td>                    
                </tr>
            </table>
        </div>
		<?php    	
	}

	function showCalendarNEW(  $year, $month, $day ){

		$data = $this->datamodel->getCalendarData( $year, $month, $day );

		global $mainframe;
		$cfg = & EventsConfig::getInstance();
		$option = $cfg->get("com_componentname");
		$Itemid	= EventsHelper::getItemid();

		EventsHelper::loadOverlib();

		$view =  $this->getViewName();
		include_once( JPATH_SITE . '/components/' . $option . '/layouts/'.$view.'/events_calendar_cell.php' );
		$eventCellClass = "EventCalendarCell_".$view;

		// previous and following month names and links
		$followingMonth = $this->datamodel->getFollowingMonth($data);
		$precedingMonth = $this->datamodel->getPrecedingMonth($data);

		//if( _CAL_CONF_TT_SHADOW == 1 ){ // disbled only for test [mic]
		if( !defined( '_LOAD_OVERLIB_SHADOW' )){
            define( '_LOAD_OVERLIB_SHADOW', 1 ); ?>
            <script type="text/javascript" src="<?php echo JURI::root(); ?>/components/<?php echo $option;?>/js/overlib_shadow.js"></script>
            <?php
		}
    ?>

        <table width="100%" align="center" cellpadding="0" cellspacing="0" class="cal_table">
            <tr valign="top" style="height:25px!important;line-height:25px;font-weight:bold;">
            	<td width="2%" rowspan="2" />
                <td colspan="2" class="cal_td_month" style="text-align:center;">                
                   <?php echo "<a href='".$precedingMonth["link"]."' title='last month' style='text-decoration:none;'>".$precedingMonth['name']."</a>";?>
                </td>
                <td colspan="3" class="cal_td_currentmonth" style="text-align:center;"><?php echo $data['fieldsetText']; ?></td>
                <td colspan="2" class="cal_td_month" style="text-align:center;">                
                   <?php echo "<a href='".$followingMonth["link"]."' title='next month' style='text-decoration:none;'>".$followingMonth['name']."</a>";?>
                </td>
            </tr>
            <tr valign="top">
                 <?php foreach ($data["daynames"] as $dayname) { ?>
                    <td width="14%" align="center" style="height:25px!important;line-height:25px;font-weight:bold;">
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
                <?php
                echo "<td width='2%' class='cal_td_weeklink'>";
                list($week,$link) = each($data['weeks']);
                echo "<a href='".$link."'>$week</a></td>\n";

                for ($d=0;$d<7 && $dn<$datacount;$d++){
                	$currentDay = $data["dates"][$dn];
                	switch ($currentDay["monthType"]){
                		case "prior":
                		case "following":
                		?>
                    <td width="14%" class="cal_td_daysoutofmonth" valign="middle">
                        <?php echo EventsHelper::getMonthName($currentDay["month"]); ?>
                    </td>
                    	<?php
                    	break;
                		case "current":
                			$cellclass = $currentDay["today"]?'class="cal_td_today"':'class="cal_td_daysnoevents"';
                			// stating the height here is needed for konqueror and safari
						?>
                    <td <?php echo $cellclass;?> width="14%" valign="top" style="height:80px;">
                    	<a class="cal_daylink" href="<?php echo $currentDay["link"]; ?>" title="<?php echo _CAL_LANG_CLICK_TOSWITCH_DAY; ?>"><?php echo $currentDay['d']; ?></a>
                        <?php
                        if (count($currentDay["events"])>0){
                        	foreach ($currentDay["events"] as $key=>$val){
								if( $currentDay['countDisplay'] < $cfg->get('com_calMaxDisplay')) {
                        			echo '<div style="width:100%; border:0;padding:2px;">' . "\n";
								} else {
									echo '<div style="float:left; border:0;padding:0px;">' . "\n";
								}
                        		$ecc = new $eventCellClass($val, $this->datamodel);
                        		echo $ecc->calendarCell($currentDay,$year,$month,$key);
                        		echo '</div>' . "\n";
								$currentDay['countDisplay']++;
                        	}
                        }
                        echo "</td>\n";
                        break;
                	}
                	$dn++;
                }
                echo "</tr>\n";
            }
            echo "</table>\n";
	}

}

?>
