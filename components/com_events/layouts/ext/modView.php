<?php
/**
 * Events Component for Joomla 1.5.x
 *
 * @version     $Id: modView.php 965 2008-02-16 11:01:09Z geraint $
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
if (!class_exists("JEventsLegend_ext")) {
	EventsViewer::setViewClassName("mod_legend","JEventsLegend_ext");

	class JEventsLegend_ext extends JEventsLegend{

		function getViewName(){
			return "ext";
		}

		function displayCalendarLegend($style="list"){

			// since this is meant to be a comprehensive legend look for catids from menu first:
			global $mainframe;
			$cfg = & EventsConfig::getInstance();
			$option = $cfg->get("com_componentname");
			$Itemid = EventsHelper::getItemid();
			$user =& JFactory::getUser();

			$db	=& JFactory::getDBO();
			// Parameters - This module should only be displayed alongside a com_events calendar component!!!
			$cfg = & EventsConfig::getInstance();
			$compname = $cfg->get("com_componentname");

			global $option; // NB $option must be global $option here!!!
			if ($option!=$compname) return;

			$catidList = "";

			include_once(JPATH_ADMINISTRATOR."/components/$compname/lib/colorMap.php");


			// I can't rely on
			// $menu = $mainframe->get( 'menu' );
			// $params = new mosParameters( $menu->params );
			// so I get the paramaters from the database directly
			if ($Itemid>0){
				$query = "SELECT id, params"
				. "\n FROM #__menu WHERE"
				. "\n link = 'index.php?option=".$compname."'"
				. "\n AND published = 1"
				. "\n AND access <= $user->gid"
				. "\n AND id = $Itemid"
				. "\n ORDER BY access ASC";
				$db->setQuery($query);
				$idParam = $db->loadObject();
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
			$catidsIn = JRequest::getVar('catids', "NONE" );
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
					$content = "<div class=\"event_legend_container\">";
					$content .= '<table border="0" cellpadding="0" cellspacing="5" width="100%">';
					foreach ($allrows as $row) {
						// do not show legend for categories exluded via GET/POST
						if ($row->id>0 && count($catidsGP) && !in_array($row->id, $catidsGP)) continue;
						$cat = $row->id>0?"&catids=$row->id":"&catids=$availableCatsIds";
						$content .= "<tr><td style='border:solid 1px #000000;height:5px;width:5px;background-color:".$row->color."'></td>\n"
						."<td class='legend' >"
						."<a style='text-decoration:none' href='".JRoute::_("index.php?option=$compname$cat$itm$tsk")."' title='".$row->name."'>"
						."$row->name</a></td></tr>\n";
					}
					$content .= "</table>\n";
					$content .= "</div>";
				}
				else {

					$content = '<table border="0" cellpadding="0" cellspacing="5" width="100%"><tr>';
					foreach ($allrows as $row) {
						// do not show legend for categories exluded via GET/POST
						if ($row->id>0 && count($catidsGP) && !in_array($row->id, $catidsGP)) continue;
						$cat = $row->id>0?"&catids=$row->id":"&catids=$availableCatsIds";
						$content .= "<td style='border:solid 1px #000000;height:5px;width:5px;background-color:".$row->color."'></td>\n"
						."<td class='legend' >"
						."<a href='".JRoute::_("index.php?option=$compname$cat$itm$tsk")."' title='".$row->name."'>"
						."$row->name</a></td>\n";
					}
					$content .= "</tr></table>\n";
				}
				global $params; // from module
				/*
				if (isset($params) && isset($params->show_admin) && $params->show_admin && isset($year) && isset($month) && isset($day) && isset($Itemid)) {
				global $mainframe;
				include_once(JPATH_BASE."/components/$compname/events.html.php");
				ob_start();
				HTML_events::viewNavAdminPanel( $year, $month, $day, $option, $Itemid );
				$content .= ob_get_contents();
				ob_end_clean();
				}
				*/
				return $content;
			}
		}
	}

}

/** ensure that class and functions are declared only once */
if (!class_exists("JEventsCal_ext")) {


	EventsViewer::setViewClassName("mod_cal","JEventsCal_ext");
	/**
	* instance of a mini calendar
	*/
	class JEventsCal_ext extends  JEventsCal {

		function getViewName(){
			return "ext";
		}

		/**
		 * generates html code for one mini calendar
		 *
		 * @return string HTML
		 */
		function _displayCalendarMod($time, $startday, $linkString,	&$day_name, $monthMustHaveEvent=false){
			global  $mainframe;
			$db	=& JFactory::getDBO();
			$cfg = & EventsConfig::getInstance();
			$compname = $cfg->get("com_componentname");

			$cal_day=date("d",$time);
			$cal_year=date("Y",$time);
			$cal_month=date("m",$time);
			$calmonth=date("n",$time);
			$data = $this->datamodel->getCalendarData($cal_year,$cal_month,1,true,$this->modcatids,$this->catidList, $this->myItemid);

			$month_name = EventsHelper::getMonthName($cal_month);
			$to_day     = date("Y-m-d", $this->timeWithOffset);
			$today = mktime(0,0,0,$cal_month, $cal_day, $cal_year);

			$cal_prev_month 	= $cal_month - 1;
			$cal_next_month 	= $cal_month + 1;
			$cal_next_month_year	= $cal_year;
			$cal_prev_month_year	= $cal_year;

			// additional EBS
			if( $cal_prev_month == 0 ) {
				$cal_prev_month 	= 12;
				$cal_prev_month_year 	-=1;
			}
			if( $cal_next_month == 13 ) {
				$cal_next_month 	= 1;
				$cal_next_month_year 	+=1;
			}

			$linkpref = "index.php?option=$compname&Itemid=".$this->myItemid.$this->cat."&task=";
			$linkprevious = $linkpref."view_month&day=$cal_day&month=$cal_prev_month&year=$cal_prev_month_year";
			$linkprevious = JRoute::_($linkprevious);
			$linkcurrent = $linkpref."view_month&day=$cal_day&month=$cal_month&year=$cal_year";
			$linkcurrent = JRoute::_($linkcurrent);
			$linknext = $linkpref."view_month&day=$cal_day&month=$cal_next_month&year=$cal_next_month_year";
			$linknext = JRoute::_($linknext);

			$viewname = getJEventsViewName();
			$viewpath = JURI::root() . "/components/$compname/layouts/".$viewname;
			$viewimages = $viewpath . "/images";

			$content = <<<START
<div id="extcal_minical">
	<table cellspacing="1" cellpadding="0" border="0" align="center" style="border: 1px solid rgb(190, 194, 195); background-color: rgb(255, 255, 255);">
		<tr>
			<td>
				<table width="100%" cellspacing="0" cellpadding="2" border="0" class="extcal_navbar">
					<tr>
						<td valign="middle" height="18" align="center">
							<a href="$linkprevious">
                    		<img border="0" title="previous month" alt="previous month" src="$viewimages/mini_arrowleft.gif"/>
                  			</a>
                		</td>
		                <td width="98%" valign="middle" nowrap="nowrap" height="18" align="center" class="extcal_month_label">
							<a href="$linkcurrent" style="text-decoration:none;color:inherit;">
		                	$month_name $cal_year
							</a>
		                </td>
						<td valign="middle" height="18" align="center">
		                    <a href="$linknext">
		                    <img border="0" title="next month" alt="next month" src="$viewimages/mini_arrowright.gif"/>
        					</a>
                		</td>
					</tr>
				</table>
				<table width="135" cellspacing="0" cellpadding="0" border="0" align="center" class="extcal_weekdays">
START;
			$lf="\n";


			// Days name rows - with blank week no.
			$content	.= "<tr>\n<td/>\n";
			for ($i=0;$i<7;$i++) {
				$content.="<td  valign='top' height='24' align='center' class='extcal_weekdays'>".$day_name[($i+$startday)%7]."</td>".$lf	;
			}
			$content.="</tr>\n";

			$datacount = count($data["dates"]);
			$dn=0;
			for ($w=0;$w<6 && $dn<$datacount;$w++){
				$content .="<tr>\n";
				// the week column
				list($week,$link) = each($data['weeks']);
				$content .= '<td align="center" class="extcal_weekcell">';
				$content .= "<a href='".$link."'><img width='5' height='20' border='0' alt='week ".$week."' src='".$viewimages."/icon-mini-week.gif'/></a></td>\n";

				for ($d=0;$d<7 && $dn<$datacount;$d++){
					$currentDay = $data["dates"][$dn];
					switch ($currentDay["monthType"]){
						case "prior":
						case "following":
							$content .= "<td class='extcal_othermonth'/>\n";
							break;
						case "current":

							$dayOfWeek=strftime("%w",$currentDay["cellDate"]);

							$class = ($currentDay["today"]) ? "extcal_todaycell" : "extcal_daycell";
							$linkclass = "extcal_daylink";
							if($dayOfWeek==0 && !$currentDay["today"]) {
								$class = "extcal_sundaycell";
								$linkclass = "extcal_sundaylink";
							}

							if ($currentDay["events"]) {
								$linkclass = "extcal_busylink";
							}
							$content .= "<td class='".$class."'>\n";
							$content .="<a class='".$linkclass."' href='".$currentDay["link"]."' title='". _CAL_LANG_CLICK_TOSWITCH_DAY."'>". $currentDay['d']."</a>\n";

							$content .="</td>\n";
							break;

					}
					$dn++;
				}
				$content .="</tr>\n";
			}
			$content .= "</table>\n";
			$content .= "</td></tr></table></div>\n";

			// Now check to see if this month needs to have at least 1 event in order to display
//			if (!$monthMustHaveEvent || $monthHasEvent) return $content;
//			else return '';
			return $content;
		}

	} // class JEventsCal
} // (!class_exists("JEventsCal")

if (!class_exists("JEventsLatest_ext")) {

	EventsViewer::setViewClassName("mod_latest","JEventsLatest_ext");

	class JEventsLatest_ext  extends JEventsLatest {

		/* uncomment when this class is implementd
		function getViewName(){
		return "alternative";
		}
		*/

	} // end of class
} // !defined( 'JEVENTS_LATEST_MODULE')



?>
