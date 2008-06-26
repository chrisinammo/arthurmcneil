<?php
/**
 * Events Component for Joomla 1.5.x
 *
 * @version     $Id: modView.php 972 2008-02-16 12:55:12Z geraint $
 * @package     Events
 * @copyright   Copyright (C) 2006 JEvents Project Group
 * @copyright   Copyright (C) 2003 Eric Lamette
 * @licence     http://www.gnu.org/copyleft/gpl.html
 * @link        http://forge.joomla.org/sf/projects/jevents
 */

defined('_JEXEC') or die( 'Direct Access to this location is not allowed.' );

global $mainframe;
$cfg = & EventsConfig::getInstance();
$compname = $cfg->get("com_componentname");

include_once(JPATH_SITE."/components/$compname/layouts/default/modView.php");

/** ensure that class and functions are declared only once */
if (!class_exists("JEventsLegend_alternative")) {
	EventsViewer::setViewClassName("mod_legend","JEventsLegend_alternative");

	class JEventsLegend_alternative extends JEventsLegend{

		function getViewName(){
			return "alternative";
		}

		function displayCalendarLegend($style="list"){

			// since this is meant to be a comprehensive legend look for catids from menu first:
			global $mainframe;
			$Itemid	= EventsHelper::getItemid();
			$user = & JFactory::getUser();
			$db	=& JFactory::getDBO();
			// Parameters - This module should only be displayed alongside a com_events calendar component!!!
			$cfg = & EventsConfig::getInstance();
			$compname = $cfg->get("com_componentname");
			
			global $option; // NB $option must be global $option here!!!
			if ($option!=$compname) {
				echo "Calendar legend should not be displayed here!!!<br/>";
				return;
			}

			$catidList = "";

			include_once(JPATH_ADMINISTRATOR."/components/$option/lib/colorMap.php");


			// I can't rely on
			// $menu = mosMainFrame::get( 'menu' );
			// $params = new mosParameters( $menu->params );
			// so I get the paramaters from the database directly
			if ($Itemid>0){
				$query = "SELECT id, params"
				. "\n FROM #__menu WHERE"
				. "\n link = 'index.php?option=".$option."'"
				. "\n AND published = 1"
				. "\n AND access <= $user->gid"
				. "\n AND id = $Itemid"
				. "\n ORDER BY access ASC";
				$db->setQuery($query);
				$idParam =	$db->loadObject();
				if (isset($idParam) && intval($idParam->id) == $Itemid){
					$test = new JParameter( $idParam->params);
					$c=0;
					$catids = array();
					while ($nextCatId = $test->get( "catid$c", null )){
						if (!in_array($nextCatId,$catids)){
							$catids[]=$nextCatId;
							$catidList .= (strlen($catidList)>0?",":"").$nextCatId;
						}
						$c++;
					}
				}
				$catidsOut = str_replace(",","|",$catidList);
			}

			// I should only show legend for items that **can** be shown in calendar so must filter based on GET/POST
			$catidsIn = JRequest::getVar( 'catids', "NONE" );
			if ($catidsIn!="NONE") $catidsGP = explode("|",$catidsIn);
			else $catidsGP = array();

			$sql = "SELECT cat.id, cat.name, cat.description, cat.access, evcat.color FROM #__events_categories as evcat, #__categories as cat"
			. "\nWHERE  evcat.id=cat.id";// AND b.access <= $gid AND #__events.access <= $gid"
			if (strlen($catidList)>0) $sql .= " AND evcat.id IN ($catidList)";
			$db->setQuery($sql);
			$allrows = $db->loadObjectList();

			$allcats = new catLegend("0", _CAL_LEGEND_ALL_CATEGORIES,"lightgray",_CAL_LEGEND_ALL_CATEGORIES_DESC);

			$availableCatsIds="";
			foreach ($allrows as $row){
				$availableCatsIds.=(strlen($availableCatsIds)>0?"|":"").$row->id;
			}

			array_push($allrows,$allcats);
			if (count($allrows)==0) return "";
			else {
				if ($Itemid<999999) $itm = "&Itemid=$Itemid";
				$task 	= JRequest::getVar(	'task',	$cfg->get('com_startview'));
				list($year,$month,$day) = EventsHelper::getYMD();
				$tsk="";
				if ($task=="view_month" || $task=="view_week" ||  $task=="view_day" || $task=="view_year"|| $task=="view_cat"){
					$tsk="&task=$task&year=$year&month=$month&day=$day";
				}
				if ($style=="list"){
					$content = "<div class=\"event_legend_container\"><ul class=\"event_legend_list\">";
					foreach ($allrows as $row) {
						// do not show legend for categories exluded via GET/POST
						if ($row->id>0 && count($catidsGP) && !in_array($row->id, $catidsGP)) continue;
						$st1="background-color:white;border-left:12px solid ".$row->color;
						$cat = $row->id>0?"&catids=$row->id":"&catids=$availableCatsIds";
						$content .= "<li style='list-style:none;margin-top:5px;'>"
						."<div class='event_legend_name' style='".$st1."'>"
						//."$row->name ($row->id)</div>"
						."<a href='".JRoute::_("index.php?option=$option$cat$itm$tsk")."' title='".$row->name."' style='color:inherit'>"
						."$row->name</a></div>";
						if (strlen($row->description)>0) {
							$content .="<div class='event_legend_desc'  style='".$st1."'>$row->description</div>";
						}
						$content .="</li>";
					}
					$content .= "</ul></div>";
				}
				else {
					$content = "<div style='margin-top:5px;'>";
					foreach ($allrows as $row) {
						// do not show legend for categories exluded via GET/POST
						if ($row->id>0 && count($catidsGP) && !in_array($row->id, $catidsGP)) continue;
						$st1="border-left:12px solid ".$row->color;
						$cat = $row->id>0?"&catids=$row->id":"&catids=$availableCatsIds";
						$content .= "<div class='legend_box'>"
						."<div class='event_legend_name' style='".$st1."'>"
						//."$row->name ($row->id)</div>"
						."<a href='".JRoute::_("index.php?option=$option$cat$itm$tsk")."' title='".$row->name."' style='color:inherit'>"
						."$row->name</a></div>";
						if (strlen($row->description)>0) {
							$content .="<div class='event_legend_desc' style='".$st1."'>$row->description</div>";
						}
						else {
							$content .="<div class='event_legend_desc' style='".$st1."'>&nbsp;</div>";
						}

						$content .="</div>";
					}
					$content .= "</div>";

				}
				return $content;
			}
		}
	}
}

/** ensure that class and functions are declared only once */
if (!class_exists("JEventsCal_alternative")) {


	EventsViewer::setViewClassName("mod_cal","JEventsCal_alternative");
	/**
	* instance of a mini calendar
	*/
	class JEventsCal_alternative extends  JEventsCal {

		/* uncomment when this class is implementd
		function getViewName(){
		return "alternative";
		}
		*/

		/**
		 * generates html code for one mini calendar
		 *
		 * @return string HTML
		 */
		function _displayCalendarModxx($time, $startday, $timeWithOffset, $linkString,
		$day_name, $monthMustHaveEvent=false){
			$cfg = & EventsConfig::getInstance();
			$option = $cfg->get("com_componentname");
			echo <<<STYLE
<style>
.DP_monthtable{width:100%;background:#fff;padding:0;border-bottom:1px #A2BBDD solid;font-size:83%}
.DP_monthtable TD{text-align:center;padding:2px;font-family:Verdana;font-size:85%}
.DP_heading{cursor:pointer;background:#c3d9ff ;color:#112ABB;vertical-align:middle}
.DP_days{background:#c3d9ff }
.DP_dayh{cursor:default;font-size:78%}
.DP_cur{font:bold 78%/1em Verdana,Sans-serif;padding-bottom:4px;text-align:center}
.DP_prev,.DP_next{font-size:125%;padding-bottom:6px;cursor:pointer}
.DP_prev{text-align:right}
.DP_next{text-align:left}

td.tl{background:url("http://www.google.com/calendar/images/corner_tl.gif") top left}
td.bl{background:url("http://www.google.com/calendar/images/corner_bl.gif") bottom left}
td.tr{background:url("http://www.google.com/calendar/images/corner_tr.gif") top right}
td.br{background:url("http://www.google.com/calendar/images/corner_br.gif") bottom right}
td.dphtml{background-repeat:no-repeat;width:2px}
</style>
STYLE;

			$db	=& JFactory::getDBO();

			if (strlen($this->catidsOut)>0) {
				$cat = "&catids=$this->catidsOut";
			} else {
				$cat="";
			}

			$cal_year=date("Y",$time);
			$cal_month=date("m",$time);
			$calmonth=date("n",$time);

			$month_name = EventsHelper::getMonthName($cal_month);

			$content = <<<START
<TABLE cellspacing="0" cellpadding="0"   style="background-color: rgb(195, 217, 255); margin-top: 4px;">
  <TBODY>
    <TR style="height: 2px;">
      <TD class="tl dphtml"/>
      <TD/>
      <TD class="tr dphtml"/>
    </TR>

    <TR>
      <TD/>
      <TD style="width: 13em;">
        <DIV>
          <TABLE cols="7" cellspacing="0" cellpadding="3" style="cursor: pointer;" class="DP_monthtable">
            <TBODY>
              <TR 1_header" class="DP_heading">
                <TD class="DP_prev"  colspan="1">&laquo;</TD>
                <TD class="DP_cur"  colspan="5">$month_name $cal_year</TD>
                <TD class="DP_next"  colspan="1">&raquo;</TD>
              </TR>
START;
			$lf="\n";


			$content	.= '<tr  class="DP_days">'.$lf;

			// Days name rows
			for ($i=0;$i<7;$i++) {
				$content.="<td class=\"mod_events_td_dayname\">".$day_name[($i+$startday)%7]."</td>".$lf	;
			}

			$content.='</tr>'.$lf.'<tr>';

			// dmcd May 7/04 fix to fill in end days out of month correctly
			$dayOfWeek=$startday;

			$start= (date("w",mktime(0,0,0,$cal_month,1,$cal_year))-$startday+7)%7;

			$d=date("t",mktime(0,0,0,$cal_month,0,$cal_year))-$start + 1;

			for($a=$start; $a>0; $a--) {
				$content .= "<td class=\"mod_events_td_dayoutofmonth\">".$d++."</td>";
				$dayOfWeek++;
			}

			$monthHasEvent=false;

			$lastDayOfMonth = date("t",mktime(0,0,0,$cal_month,1,$cal_year));

			$rows = listEventsByMonthNew( $cal_year, $cal_month,"");

			$rowcount=count($rows);

			$repeatArray = array();
			for( $i = 0; $i < $rowcount; $i++ ){
				$repeatArray[$i] = mosEventRepeatArrayMonth( $rows[$i], $cal_year, $cal_month );
			}

			for($d=1;$d<=$lastDayOfMonth;$d++) {
				// Note that if we are on the last day of the month and last day of week then we won't have
				// any out of month days so don't start a new row!
				if((( date( 'w', mktime( 0, 0, 0, $cal_month, $d, $cal_year )) - $startday ) % 7 ) == 0
				&& $d!=date( 't', mktime( 0, 0, 0, $cal_month, $d, $cal_year ))){
					$content.= "<tr>";
				}

				$do = ($d<10) ? "0$d" : "$d";
				$selected_date = "$cal_year-$cal_month-$do";

				$cellDate = mktime(0,0,0,$cal_month,$d,$cal_year);

				$mark_bold			= '';
				$mark_close_bold 	= '';
				$class = ($selected_date == $to_day) ? "mod_events_td_todaynoevents" : "mod_events_td_daynoevents";

				$dayHasEvent = false;
				for ($r = 0; $r < $rowcount && !$dayHasEvent; $r++) {

					if (array_key_exists($cellDate,$repeatArray[$r])) {
						$monthHasEvent=true;
						$dayHasEvent=true;
						$mark_bold = "<b>";
						$mark_close_bold = "</b>";
						$class = ($selected_date == $to_day) ? "mod_events_td_todaywithevents" : "mod_events_td_daywithevents";
						break;
					}
				}

				$daylink = "index.php?option=$option"
				. "&task=view_day"
				. "&year=".$cal_year
				. "&month=".$cal_month
				. "&day=".$do
				. "&Itemid=".$this->myItemid . $cat;

				$content .= '<td class="'.$class.'">'
				. $this->_htmlLinkCloaking($daylink, $mark_bold.$d.$mark_close_bold, array('class' => '"mod_events_daylink"',
				'title' => '"'._CAL_LANG_CLICK_TOSWITCH_DAY.'"'))
				. "</td>\n";

				// Check if Next week row
				// dmcd May 7/04 fix to fill in end days out of month correctly
				//if(((date("w",mktime(0,0,0,$cal_month,$d,$cal_year))-$startday+1)%7)==0) {
				if((1 + $dayOfWeek++)%7 == $startday && intval($d)!=date( 't', mktime( 0, 0, 0, $cal_month, $d, $cal_year ))) {
					$content .= "</tr>\n";
				}
			}

			// Days out of the month
			// dmcd May 7/04 fix to fill in end days out of month correctly
			//if(((date("w",mktime(0,0,0,$cal_month+1,1,$cal_year))-$startday)%7)<>1) {
			$d=1;
			//    while(((date("w",mktime(0,0,0,($cal_month+1),$d,$cal_year))-$startday+1)%7)<>1) {
			while($dayOfWeek++ %7 != $startday) {
				$content .= "<td class=\"mod_events_td_dayoutofmonth\">".$d."</td>\n";
				$d++;
			}

			$content .= '</tr></table>'.$lf;

			// Now check to see if this month needs to have at least 1 event in order to display
			if (!$monthMustHaveEvent || $monthHasEvent) return $content;
			else return '';
}

function getCalxx() {

	$user =& JFactory::getUser();

	$db	=& JFactory::getDBO();
	global $mainframe;

	static $isloaded_css = false;

	$timeWithOffset = time() + ($mainframe->getCfg('offset') * 60 * 60);

	$day_name = array("<span style='color: red'>"._CAL_LANG_SUNDAYSHORT."</span>",
	_CAL_LANG_MONDAYSHORT,_CAL_LANG_TUESDAYSHORT,_CAL_LANG_WEDNESDAYSHORT,
	_CAL_LANG_THURSDAYSHORT,_CAL_LANG_FRIDAYSHORT,_CAL_LANG_SATURDAYSHORT);

	$content="";
	if( ($this->inc_ec_css == 1) && !$isloaded_css) {
		$content .= '<link href="' . JURI::root() . '/modules/mod_events_latest/mod_events_cal.css" rel="stylesheet" type="text/css" />' . "\n";
		$isloaded_css = true;
	}

	// dmcd - May 7/04, make calendar display a function.  Want to show 1,2, or 3 calendars optionally
	// depending upon module parameters. (IE. Last Month, This Month, or Next Month)

	$thisDayOfMonth = date("j", $timeWithOffset);
	$daysLeftInMonth = date("t", $timeWithOffset) - date("j", $timeWithOffset) + 1;

	if($this->disp_lastMonth && (!$this->disp_lastMonthDays || $thisDayOfMonth <= $this->disp_lastMonthDays))
	$content .= $this->_displayCalendarMod(mktime(0,0,0,date("n", $timeWithOffset)-1,1,date("Y", $timeWithOffset)),
	$this->com_starday, $timeWithOffset, _CAL_LANG_LAST_MONTH,
	$day_name, $this->disp_lastMonth == 2);

	$content .= $this->_displayCalendarMod(mktime(0,0,0,date("n", $timeWithOffset),1,date("Y", $timeWithOffset)),
	$this->com_starday, $timeWithOffset, _CAL_LANG_THIS_MONTH,
	$day_name, false);

	if($this->disp_nextMonth && (!$this->disp_nextMonthDays || $daysLeftInMonth <= $this->disp_nextMonthDays))
	$content .= $this->_displayCalendarMod(mktime(0,0,0,date("n", $timeWithOffset)+1,1,date("Y", $timeWithOffset)),
	$this->com_starday, $timeWithOffset, _CAL_LANG_NEXT_MONTH,
	$day_name, $this->disp_nextMonth == 2);


	$content .= <<<END
        </DIV>
      </TD>
      <TD/>
    </TR>

    <TR style="height: 2px;">
      <TD class="bl dphtml"/>
      <TD/>
      <TD class="br dphtml"/>
    </TR>

  </TBODY>
</TABLE>
END;
	return $content;
} // function getCal
} // class JEventsCal
} // (!class_exists("JEventsCal")

if (!class_exists("JEventsLatest_alternative")) {

	EventsViewer::setViewClassName("mod_latest","JEventsLatest_alternative");

	class JEventsLatest_alternative  extends JEventsLatest {

		function getViewName(){
			return "alternative";
		}

		function displayLatestEvents(){

			$dispatcher	=& JDispatcher::getInstance();

			$this->getLatestEventsData();

			static $isloaded_css = false;
			$content = "";

			if( $this->inccss && !$isloaded_css) {
				$content .= '<link href="' . JURI::root() . '/modules/mod_events_latest/mod_events_latest.css" rel="stylesheet" type="text/css" />' . "\n";
				$isloaded_css = true;
			}
			$content .= '<table class="mod_events_latest_table" width="100%" border="0" cellspacing="0" cellpadding="0" align="center">';

			if(isset($this->eventsByRelDay) && count($this->eventsByRelDay)){

				// Now to display these events, we just start at the smallest index of the $this->eventsByRelDay array
				// and work our way up.

				$firstTime=true;

				// initialize name of com_events module and task defined to view
				// event detail.  Note that these could change in future com_event
				// component revisions!!  Note that the '$itemId' can be left out in
				// the link parameters for event details below since the event.php
				// component handler will fetch its own id from the db menu table
				// anyways as far as I understand it.

				$cfg = & EventsConfig::getInstance();
				$option = $cfg->get("com_componentname");
				$task_events = 'view_detail';



				// Note we MUST get the $Itemid value for the events component
				// here, or some mambo things can break.
				/* replace by findAppropriateMenuID [tstahl]
				$query = "SELECT id"
				. "\n FROM #__menu WHERE"
				. "\n link = 'index.php?option=$option'"
				. "\n AND published = 1"
				. "\n AND access <= $this->gid"
				. "\n ORDER BY access ASC";
				$db->setQuery($query);
				$Itemid = intval($db->loadResult());
				*/

				$this->processFormatString();

				foreach($this->eventsByRelDay as $relDay => $daysEvents){

					reset($daysEvents);

					// get all of the events for this day
					foreach($daysEvents as $dayEvent){
						// get the title and start time
						$startDate = $dayEvent->publish_up();
						$eventDate = mktime(substr($startDate,11,2),substr($startDate,14,2), substr($startDate,17,2),
						$this->now_m,$this->now_d + $relDay,$this->now_Y);
						$startDate = mktime(substr($startDate,11,2),substr($startDate,14,2), substr($startDate,17,2),
						substr($startDate,5,2), substr($startDate,8,2), substr($startDate,0,4));
						$endDate = $dayEvent->publish_down();
						$endDate = mktime(substr($endDate,11,2),substr($endDate,14,2), substr($endDate,17,2),
						substr($endDate,5,2), substr($endDate,8,2), substr($endDate,0,4));

						$year = date('Y', $startDate);
						$month = date('m', $startDate);
						$day = date('d', $startDate);

						$color = setColor($dayEvent);
						$tdst1=" style='background-color:white;border-left:8px solid ".$color.";border-bottom:1px solid ".$color.";padding:0px 0px 2px 2px;'";
						if($firstTime) $content .= '<tr ><td class="mod_events_latest_first"'.$tdst1.'>';
						else $content .= '<tr><td class="mod_events_latest"'.$tdst1.'>';

						// generate output according custom string
						foreach($this->splitCustomFormat as $condtoken) {

							// evaluate all_day_event
							$all_day_event = false;
							//if ($dayEvent->publish_up == $dayEvent->publish_down) {
							if (($dayEvent->hup()   == $dayEvent->hdn()) &&
							($dayEvent->minup() == $dayEvent->mindn()) &&
							($dayEvent->sup()   == $dayEvent->sdn())) {
								$all_day_event = true;
							}

							if (isset($condtoken['cond'])) {
								if ( $condtoken['cond'] == 'a'  && !$all_day_event) continue;
								if ( $condtoken['cond'] == '!a' &&  $all_day_event) continue;
							}
							foreach($condtoken['data'] as $token) {
								unset($match);
								unset($dateParm);
								$match='';
								if (is_array($token)) {
									$match = $token['keyword'];
									$dateParm = isset($token['dateParm']) ? trim($token['dateParm']) : "";
								} else {
									$content .= $token;
									continue;
								}


								switch ($match){

									case 'endDate':
									case 'startDate':
									case 'eventDate':
										// Note we need to examine the date specifiers used to determine if language translation will be
										// necessary.  Do this later when script is debugged.

										if(!$this->disableDateStyle) $content .= '<span class="mod_events_latest_date">';

										if (!isset($dateParm) || $dateParm == ''){
											// no actual format specified, use default, eg. Fri Oct 12th, @7:30pm\
											// use the strftime function for international support
											if($this->lang == 'english'){
												//if($lang == 'english'){
												$time_fmt = $all_day_event ? '' : ', @g:ia';
												$dateFormat = $this->displayYear ?  'D, M jS, Y'.$time_fmt: 'D, M jS'.$time_fmt;
												$content .= date($dateFormat, $$match);
											} else {
												$time_fmt = $all_day_event ? '' : ' @%I:%M%p';
												$dateFormat = $this->displayYear ? '%a %b %d, %Y'.$time_fmt : '%a %b %d'.$time_fmt;
												$content .= strftime($dateFormat, $$match);
											}
										} else {
											// if a '%' sign detected in date format string, we assume strftime() is to be used,
											if(preg_match("/\%/", $dateParm)) $content .= strftime($dateParm, $$match);
											// otherwise the date() function is assumed.
											else $content .= date($dateParm, $$match);
										}

										if(!$this->disableDateStyle) $content .= "</span>";
										break;

									case 'title':

										if (!$this->disableTitleStyle) $content .= '<span class="mod_events_latest_content">';
										if ($this->displayLinks) {

											$content .= $this->_htmlLinkCloaking("index.php?option=".$option
											. "&task="  . $task_events
											. "&agid="  . $dayEvent->id()
											. "&year="  . date("Y", $eventDate)
											. "&month=" . date("m", $eventDate)
											. "&day=" 	. date("d", $eventDate)
											. "&Itemid=". $this->myItemid . $this->cat, $dayEvent->title());
										} else {
											$content .= $dayEvent->title();
										}
										if (!$this->disableTitleStyle) $content .= '</span>';
										break;

									case 'category':
										$catobj   = $this->_getCategory($dayEvent->catid());
										$content .= $catobj->name;
										break;

									case 'contact':
										// Also want to cloak contact details so
										$this->modparams->set("image",1);
										$dayEvent->text = $dayEvent->contact_info();
										$dispatcher->trigger( 'onPrepareContent', array( &$dayEvent, &$this->modparams, 0 ), true );
										$dayEvent->contact_info($dayEvent->text);
										$content .= $dayEvent->contact_info();
										break;

									case 'content':  // Added by Kaz McCoy 1-10-2004
									$this->modparams->set("image",1);
									$dayEvent->data->text = $dayEvent->content();
									$results = $dispatcher->trigger( 'onPrepareContent', array( &$dayEvent->data, &$this->modparams, 0 ), true );
									$dayEvent->content($dayEvent->data->text);
									//$content .= substr($dayEvent->content, 0, 150);
									$content .= $dayEvent->content();
									break;

									case 'addressInfo':
									case 'location':
										$content .= $dayEvent->location();
										break;

									case 'extraInfo':
										$content .= $dayEvent->extra_info();
										break;

									case 'createdByAlias':
										$content .= $dayEvent->created_by_alias();
										break;

									case 'createdByUserName':
										$catobj   = $this->_getUser($dayEvent->created_by());
										$content .= $catobj->username;
										break;

									case 'createdByUserEmail':
										// Note that users email address will NOT be available if they don't want to receive email
										$catobj   = $this->_getUser($dayEvent->created_by());
										$content .= $catobj->sendEmail ? $catobj->email : '';
										break;

									case 'createdByUserEmailLink':
										// Note that users email address will NOT be available if they don't want to receive email
										$content .= JRoute::_("index.php?option="
										. $option
										. "&task=".$task_events
										. "&agid=".$dayEvent->id()
										. "&year=".$year
										. "&month=".$month
										. "&day=".$day
										. "&Itemid=".$this->myItemid . $this->cat);
										break;

									case 'color':
										$content .= $dayEvent->color_bar();
										break;

									case 'eventDetailLink':
										$content .= JRoute::_("index.php?option="
										. $option
										. "&task=".$task_events
										. "&agid=".$dayEvent->id()
										. "&year=".$year
										. "&month=".$month
										. "&day=".$day
										. "&Itemid=".$this->myItemid . $this->cat);

										break;

									default:
										if ($match) $content .= $match;
										break;
								} // end of switch
							} // end of foreach
						} // end of foreach
						$content .= "</td></tr>\n";
						$firstTime=false;
					} // end of foreach
				} // end of foreach

			} else {
				$content .= '<tr><td class="mod_events_latest_noevents">'. _CAL_LANG_NO_EVENTS . '</td></tr>' . "\n";
			}
			$content .="</table>\n";

			$cfg = & EventsConfig::getInstance();
			$option = $cfg->get("com_componentname");
			$callink_HTML = '<div class="mod_events_latest_callink">'
			. $this->_htmlLinkCloaking("index.php?option=$option" .  "&Itemid=". $this->myItemid . $this->cat, _CAL_LANG_CLICK_TOCOMPONENT)
			. '</div>';

			if ($this->linkToCal == 1) $content = $callink_HTML . $content;
			if ($this->linkToCal == 2) $content .= $callink_HTML;

			if ($this->displayRSS){
				$cfg = & EventsConfig::getInstance();
				$compname = $cfg->get("com_componentname");
				$compimages = JURI::root() . "components/$compname/images";

				$callink_HTML = '<div class="mod_events_latest_rsslink">'
				.'<a href="'.$this->rsslink.'" title="'.JText::_("RSS Feed").'">'
				.'<img src="'.$compimages.'/rss.png" alt="'.JText::_("RSS Feed").'" />'
				.JText::_("Subscribe to RSS Feed")
				. '</a>'
				. '</div>';
				$content .= $callink_HTML;
			}

			return $content;
		} // end of function

	} // end of class
} // !defined( 'JEVENTS_LATEST_MODULE')



?>
