<?php
/**
 * Events Component for Joomla 1.5.x
 *
 * @version     $Id: eventsView.php 965 2008-02-16 11:01:09Z geraint $
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

EventsViewer::setViewClassName("front","JEvents_geraint_View");

Class JEvents_geraint_View  extends JEvents_Default_View  {

	function getViewName()
	{
		return "geraint";
	}

	function viewNavTableBarIconic( $today_date, $this_date, $dates, $alts, $option, $task, $Itemid ) {
    	?>
    	<div class="ev_navigation">
    		<table  >
    			<tr align="center" valign="top">
    	    		<?php 
    	    		echo $this->_lastYearIcon($dates, $alts); 
    	    		echo $this->_lastMonthIcon($dates, $alts); 
    	    		echo $this->_viewYearIcon($today_date);
    	    		echo $this->_viewMonthIcon($today_date);
    	    		echo $this->_viewWeekIcon($today_date);
    	    		echo $this->_viewSearchIcon($today_date);
    	    		echo $this->_viewJumptoIcon($today_date);
    	    		echo $this->_nextMonthIcon($dates, $alts);
    	    		echo $this->_nextYearIcon($dates, $alts);
    	    		?>
                </tr>
    			<tr class="icon_labels" align="center" valign="top">
	        		<td colspan="2"></td>
    				<td><?php echo _CAL_LANG_VIEWBYYEAR;?></td>
    				<td><?php echo _CAL_LANG_VIEWBYMONTH;?></td>
    				<td><?php echo _CAL_LANG_VIEWBYWEEK;?></td>
    				<td><?php echo _SEARCH_TITLE;?></td>
    				<td><?php echo  _CAL_LANG_JUMPTO;?></td>
	        		<td colspan="2"></td>
                </tr>
                <?php
                echo $this->_viewHiddenJumpto($this_date);
                ?>
            </table>
        </div>
		<?php    	
	}

	function _detailList($events, $todayTime, $showcategorydetail = true){
		$cfg = & EventsConfig::getInstance();
		$option = $cfg->get("com_componentname");
		$Itemid = EventsHelper::getItemid();
		$view =  $this->getViewName();
		$eventCellClass = "EventCalendarCell_".$view;

		// include popup code
		include_once( JPATH_SITE . '/components/' . $option . '/layouts/'.$view.'/events_calendar_cell.php' );
		echo '<ul class="ev_ul">' . "\n";
		foreach ($events as $row) {
			$listyle = 'style="border-color:'.$row->bgcolor().';"';
			echo "<li class='ev_td_li' $listyle>\n";

			$ecc = new $eventCellClass($row);
			$args = $ecc->calendarCell_popup($todayTime);
			$this->viewEventRowNew ( $row,'view_detail',$option, $Itemid,$args);
			if ($showcategorydetail){
				echo '&nbsp;::&nbsp;';
				$this->viewEventCatRowNew($row,'view_cat',$option,$Itemid);
			}
			echo "</li>\n";
		}
		echo "</ul>";
	}

	function _emptyList() {
		echo '<ul class="ev_ul">'."\n";
		$listyle = 'style="border:0px;"';
		echo "<li class='ev_td_li' $listyle>&nbsp;</li>\n";
		echo "</ul>\n";
	}

	function showEventsByWeekNEW( $year, $month, $day ){
		// get week data with details for day $day
		$data = $this->datamodel->getWeekData($year, $month, $day, true);


		$cfg = & EventsConfig::getInstance();
		$option = $cfg->get("com_componentname");
		$Itemid = EventsHelper::getItemid();
		$db	=& JFactory::getDBO();
		global $mainframe;

		$cfg = & EventsConfig::getInstance();

		EventsHelper::loadOverlib();
		
		if( !defined( '_LOAD_OVERLIB_SHADOW' )){
            define( '_LOAD_OVERLIB_SHADOW', 1 ); ?>
            <script type="text/javascript" src="<?php echo JURI::root(); ?>/components/<?php echo $option;?>/js/overlib_shadow.js"></script>
            <?php
		}

		for ($d=0;$d<7;$d++){
			if ($data['days'][$d]["week_day"]==$day){
				$today=$d;
				break;
			}
		}

		echo "<div id='cal_title'>". _CAL_LANG_EVENTSFOR . '&nbsp;' . _CAL_LANG_WEEK." : ".$data['startdate'] . ' - ' . $data['enddate']."</div>\n";
?>
        <table id="weekview" width="100%" align="center"  style="border-collapse:collapse;border-spacing:0" class="cal_table">
            <tr valign="top">
			<td style="width:70%;height:100%!important;padding:0px;" id="weekview_left">
            <table style="width:100%;height:100%!important;border-collapse:collapse;border-spacing:0">
	<?php
	$oddeven="odd";
	// Do today first
	$d = $today;
	echo '<tr><td class="cal_td_daysnames" colspan="2">' . mosEventsHTML::getDateFormat( $data['days'][$d]['week_year'], $data['days'][$d]['week_month'], $data['days'][$d]['week_day'], 0 ) . "</td></tr>\n";
	$todayTime = mktime(0,0,0, $data['days'][$d]['week_month'], $data['days'][$d]['week_day'], $data['days'][$d]['week_year']);

	// Timeless Events First
	if (count($data['hours']['timeless']['events'])>0){
		$start_time = "Timeless<br/>(translate)";

		echo '<tr><td class="ev_td_left '.$oddeven.'">' . $start_time . '</td>' . "\n";
		echo '<td class="ev_td_right '.$oddeven.'">';
		$this->_detailList($data['hours']['timeless']['events'], $todayTime,$oddeven);
		echo "</td></tr>\n";
		$oddeven = ($oddeven=="odd")?"even":"odd";
	}

	// find earliest and last hour
	$firstHour=-1;
	$lastHour=-1;
	for ($h=0;$h<24;$h++){
		if (count($data['hours'][$h]['events'])>0){
			if ($firstHour==0) $firstHour=$h;
			$lastHour=$h;
		}
	}
	if ($firstHour==-1) $firstHour=8;
	if ($lastHour==-1) $lastHour=20;
	$firstHour = min($firstHour,8);
	$lastHour = max($lastHour,19);

	for ($h=$firstHour;$h<$lastHour;$h++){
		$start_time = ($cfg->get('com_calUseStdTime')== '1') ? strftime("%I:%M%p",$data['hours'][$h]['hour_start']) : strftime("%H:%M",$data['hours'][$h]['hour_start']);

		echo '<tr><td class="ev_td_left '.$oddeven.'">' . $start_time . '</td>' . "\n";
		echo '<td class="ev_td_right '.$oddeven.'">'. "\n";
		if (count($data['hours'][$h]['events'])>0){
			$this->_detailList($data['hours'][$h]['events'], $todayTime);
		}
		else {
			$this->_emptyList();
		}
		echo "</td></tr>\n";
		$oddeven = ($oddeven=="odd")?"even":"odd";
	}
	?>
	</table>
	</td>
	<td style="width:30%;padding:0px;height:100%!important;" id="weekview_right">
    <table style="width:100%;height:100%!important;border-collapse:collapse;border-spacing:0;margin:0px;"  >
	<?php
	for( $d = 0; $d < 7; $d++ ){

		$todayTime = mktime(0,0,0, $data['days'][$d]['week_month'], $data['days'][$d]['week_day'], $data['days'][$d]['week_year']);
		$day_link = '<a class="ev_link_weekday" href="' . $data['days'][$d]['link'] . '" title="' . _CAL_LANG_CLICK_TOSWITCH_DAY . '">'
		. mosEventsHTML::getDateFormat( $data['days'][$d]['week_year'], $data['days'][$d]['week_month'], $data['days'][$d]['week_day'], 7 ).'</a>'."\n";

		echo "<tr><td class='cal_td_daysnames'>$day_link</td></tr>\n";

		if( $d==$today)	{
			$bg = 'class="ev_td_today '.$oddeven.'" ';
		}
		else {
			$bg = 'class="ev_td_left '.$oddeven.'"';
		}

		echo "<tr><td $bg>\n";

		$num_events		= count($data['days'][$d]['rows']);
		//if ($num_events>0 && $d!=$today) {
		if ($num_events>0) {
			$this->_detailList($data['days'][$d]['rows'], $todayTime,false);
		}
		else {
			$this->_emptyList();
		}
		echo "</td></tr>\n";
		$oddeven = ($oddeven=="odd")?"even":"odd";
	}
	echo "</table>\n";

	echo "</td></tr></table><br />\n";
	}

	function showEventsByDateNEW( $year, $month, $day ){
		$this->showEventsByWeekNEW($year, $month, $day );
	}

}

?>
