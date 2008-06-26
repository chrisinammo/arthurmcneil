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

/** ensure that class and functions are declared only once */
if (!function_exists("jevp_setStyleSheet")) {

	/**
		 * Sets Style sheet for module
		 *
		 * @param unknown_type $viewpath
		 */
	function jevp_setStyleSheet($viewpath, $inccss){

		global $mainframe;
		static $isloaded_cssList	= array();

		$cssfile	= $viewpath . '/css/modstyle.css';
		if ( ($inccss == 1) && !isset($isloaded_cssList[$cssfile])) {
			$cssHTML = '<link href="' . $cssfile . '" rel="stylesheet" type="text/css" />' . "\n";
			$mainframe->addCustomHeadTag($cssHTML);
			$isloaded_cssList[$cssfile] = true;
		}
	}

}

class catLegend {
	function catLegend($id, $name, $color, $description)
	{
		$this->id=$id;
		$this->name=$name;
		$this->color=$color;
		$this->description=$description;
	}
}

/** ensure that class and functions are declared only once */
if (!class_exists("JEventsLegend")) {
	EventsViewer::setViewClassName("mod_legend","JEventsLegend");

	class JEventsLegend {

		function getViewName(){
			return "default";
		}

		function JEventsLegend() {
			$this->datamodel = new JEventsdatamodel();
		}

		function displayCalendarLegend($style="list"){

			// since this is meant to be a comprehensive legend look for catids from menu first:
			global $mainframe;
			$Itemid	= EventsHelper::getItemid();
			$user =& JFactory::getUser();

			$db	=& JFactory::getDBO();
			// Parameters - This module should only be displayed alongside a com_events calendar component!!!
			$cfg = & EventsConfig::getInstance();
			$compname = $cfg->get("com_componentname");

			global $option; // NB $option must be global $option here!!!
			if ($option!=$compname) {				echo "Calendar legend should not be displayed here!!!<br/>";
			return;
			}

			$catidList = "";

			include_once(JPATH_ADMINISTRATOR."/components/$option/lib/colorMap.php");


			// I can't rely on
			// $menu = $mainframe->get( 'menu' );
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
				$idParam = 	$db->loadObject();
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
			. "\nWHERE  evcat.id=cat.id AND cat.access <= $user->gid";
			if (strlen($catidList)>0) $sql .= " AND evcat.id IN ($catidList)";
			$sql .= " ORDER BY cat.ordering ASC";
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
						$st1="background-color:".$row->color.";color:".mapColor($row->color);
						$cat = $row->id>0?"&catids=$row->id":"&catids=$availableCatsIds";
						$content .= "<li style='list-style:none;margin-top:5px;'>"
						."<div class='event_legend_name' style='".$st1."'>"
						//."$row->name ($row->id)</div>"
						."<a href='".JRoute::_("index.php?option=$option$cat$itm$tsk")."' title='".mosEventsHTML::special($row->name)."' style='color:inherit'>"
						."$row->name</a></div>";
						if (strlen($row->description)>0) {
							$content .="<div class='event_legend_desc'>$row->description</div>";
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
						$st1="background-color:".$row->color.";color:".mapColor($row->color);
						$cat = $row->id>0?"&catids=$row->id":"&catids=$availableCatsIds";
						$content .= "<div style='float:left;border:1px solid;'>"
						."<div class='event_legend_name' style='".$st1."'>"
						//."$row->name ($row->id)</div>"
						."<a href='".JRoute::_("index.php?option=$option$cat$itm$tsk")."' title='".mosEventsHTML::special($row->name)."' style='color:inherit'>"
						."$row->name</a></div>";

						$content .="<div class='event_legend_desc'>".(strlen($row->description)>0?$row->description:"&nbsp;")."</div>";
						$content .="</div>";
					}
					$content .= "</div>";

				}
				global $params; // from module
				if (isset($params) && isset($params->show_admin) && $params->show_admin && isset($year) && isset($month) && isset($day) && isset($Itemid)) {
					global $mainframe;
					include_once(JPATH_SITE."/components/$option/events.html.php");
					ob_start();
					HTML_events::viewNavAdminPanel( $year, $month, $day, $option, $Itemid );
					$content .= ob_get_contents();
					ob_end_clean();
				}

				return $content;
			}
		}
	}
}
/** ensure that class and functions are declared only once */
if (!class_exists("JEventsCal")) {

	EventsViewer::setViewClassName("mod_cal","JEventsCal");

	/**
	* instance of a mini calendar
	*/
	class JEventsCal {
		/* parameters form module or component */
		var $displayLastMonth		= null;
		var $disp_lastMonthDays		= null;
		var $disp_lastMonth			= null;

		var $displayNextMonth		= null;
		var $disp_nextMonthDays		= null;
		var $disp_nextMonth			= null;

		var $linkCloaking			= null;

		/* component only parameter */
		var $com_starday			= null;

		/* module only parameters */
		var $inc_ec_css				= null;
		var $minical_showlink		= null;
		var $minical_prevyear		= null;
		var $minical_prevmonth		= null;
		var $minical_actmonth		= null;
		var $minical_actyear		= null;
		var $minical_nextmonth		= null;
		var $minical_nextyear		= null;

		/* class variables */
		var $catidsOut				= null;
		var $modcatids				= null;
		var $catidList				= "";
		var $gid					= null;
		var $lang					= null;
		var $myItemid				= 0;
		var $cat 					= "";

		/* modules parameter object */
		var $modparams				= null;

		// data model for module
		var $datamodel				= null;

		function getViewName(){
			return "default";
		}

		/**
		* Constructor
		*
		*/		
		function JEventsCal(&$params) {

			global $mainframe;
			$user =& JFactory::getUser();

			$cfg = & EventsConfig::getInstance();
			$jev_component_name  = $cfg->get("com_componentname");
			$db	=& JFactory::getDBO();

			$this->datamodel = new JEventsDataModel();

			// component config object
			$jevents_config		= & EventsConfig::getInstance();

			$this->modparams	= & $params;
			$this->gid			= $user->gid;
			$tmplang			=& JFactory::getLanguage();
			$this->langname		= $tmplang->getBackwardLang();

			// get params exclusive to module
			$this->inc_ec_css			= $this->modparams->get('inc_ec_css', 0);
			$this->minical_showlink		= $this->modparams->get('minical_showlink', 1);;
			$this->minical_prevyear		= $this->modparams->get('minical_prevyear', 1);;
			$this->minical_prevmonth	= $this->modparams->get('minical_prevmonth', 1);;
			$this->minical_actmonth		= $this->modparams->get('minical_actmonth', 1);;
			$this->minical_actmonth		= $this->modparams->get('minical_actmonth', 1);;
			$this->minical_actyear		= $this->modparams->get('minical_actyear', 1);;
			$this->minical_nextmonth	= $this->modparams->get('minical_nextmonth', 1);;
			$this->minical_nextyear		= $this->modparams->get('minical_nextyear', 1);;

			// get params exclusive to component
			$this->com_starday	= intval($jevents_config->get('com_starday',0));

			// make config object (module or component) current
			if (intval($this->modparams->get('modcal_useLocalParam',  0)) == 1) {
				$myparam	= & $this->modparams;
			} else {
				$myparam	= & $jevents_config;
			}

			// get com_event config parameters for this module
			$this->displayLastMonth		= $myparam->get('modcal_DispLastMonth', 'NO');
			$this->disp_lastMonthDays	= $myparam->get('modcal_DispLastMonthDays', 0);
			$this->linkCloaking			= $myparam->get('modcal_LinkCloaking', 0);

			$this->timeWithOffset = time() + ($mainframe->getCfg('offset') * 60 * 60);

			switch($this->displayLastMonth) {
				case 'YES_stop':
					$this->disp_lastMonth = 1;
					break;
				case 'YES_stop_events':
					$this->disp_lastMonth = 2;
					break;
				case 'ALWAYS':
					$this->disp_lastMonthDays = 0;
					$this->disp_lastMonth = 1;
					break;
				case 'ALWAYS_events':
					$this->disp_lastMonthDays = 0;
					$this->disp_lastMonth = 2;
					break;
				case 'NO':
				default:
					$this->disp_lastMonthDays = 0;
					$this->disp_lastMonth = 0;
					break;
			}

			$this->displayNextMonth		= $myparam->get('modcal_DispNextMonth', 'NO');
			$this->disp_nextMonthDays	= $myparam->get('modcal_DispNextMonthDays', 0);

			switch($this->displayNextMonth) {
				case 'YES_stop':
					$this->disp_nextMonth = 1;
					break;
				case 'YES_stop_events':
					$this->disp_nextMonth = 2;
					break;
				case 'ALWAYS':
					$this->disp_nextMonthDays = 0;
					$this->disp_nextMonth = 1;
					break;
				case 'ALWAYS_events':
					$this->disp_nextMonthDays = 0;
					$this->disp_nextMonth = 2;
					break;
				case 'NO':
				default:
					$this->disp_nextMonthDays = 0;
					$this->disp_nextMonth = 0;
					break;
			}

			// find appropriate Itemid and setup catids for datamodel
			$this->myItemid = $this->datamodel->setupModuleCatids($this->modparams);

			$this->cat = $this->datamodel->getCatidsOutLink(true);

			$this->linkpref = 'index.php?option='.$jev_component_name.'&Itemid='.$this->myItemid.$this->cat.'&task=';

		}

		/**
		 * Cloaks html link whith javascript
		 *
		 * @param string The cloaking URL
		 * @param string The link text
		 * @return string HTML
		 */
		function _htmlLinkCloaking($url='', $text='', $attribs=array()) {

			$link = JRoute::_($url);

			if ($this->linkCloaking) {
				$attribs['onclick'] = '"window.location.href=\''. $link . '\';return false;"';
				$href = '"#"';
			} else {
				$href = '"' . $link . '"';
			}

			$attrstr = '';
			foreach ($attribs as $key => $value) {
				$attrstr .= ' ' . $key .'=' . $value;
			}

			return '<a href=' . $href . $attrstr . '>' . $text . '</a>';

		}

		/**
		 * generates html code for one mini calendar
		 *
		 * @return string HTML
		 */
		function _displayCalendarModOLD($time, $startday, $linkString,	&$day_name, $monthMustHaveEvent=false){

			$db	=& JFactory::getDBO();
			$cfg = & EventsConfig::getInstance();
			$option = $cfg->get("com_componentname");

			$cal_year=date("Y",$time);
			$cal_month=date("m",$time);
			$calmonth=date("n",$time);

			$month_name = EventsHelper::getMonthName($cal_month);
			$to_day     = date("Y-m-d", $this->timeWithOffset);

			$cal_prev_month 	= $cal_month - 1;
			$cal_next_month 	= $cal_month + 1;
			$cal_mod_next_year	= $cal_year + 1;
			$cal_mod_prev_year	= $cal_year - 1;

			// additional EBS
			if( $cal_prev_month == 0 ) {
				$cal_prev_month 	= 12;
				$cal_mod_prev_year 	= $cal_mod_prev_year - 1;
			}
			if( $cal_next_month == 13 ) {
				$cal_next_month 	= 1;
				$cal_mod_next_year 	= $cal_mod_prev_year + 1;
			}

			$content    = '';

			if( $this->minical_showlink ){

				$content = '<table cellpadding="0" cellspacing="0" width="140" align="center" class="mod_events_monthyear">' . "\n"
				. '<tr >' . "\n";

				if( $this->minical_showlink == 1 ){

					$linkpref = 'index.php?option='.$option.'&Itemid='  . $this->myItemid . $this->cat . '&task=';

					if( $this->minical_prevyear ){
						$link = $linkpref . 'view_year'
						. '&day=1&month=' . $cal_month . '&year=' . $cal_mod_prev_year
						. '&mod_cal_year=' . $cal_mod_prev_year . '&mod_cal_month=' . $cal_month;
						$content .= '<td>';
						$content .= $this->_htmlLinkCloaking( $link, '&laquo;',
						array('class' => '"mod_events_link"',
						'title' => '"'._CAL_LANG_CLICK_TOSWITCH_PY.'"'))."\n";
						$content .= '</td>';
					}

					if( $this->minical_prevmonth ){
						$link = $linkpref . 'view_month'
						. '&day=1&month=' . $cal_prev_month . '&year=' . $cal_year
						. '&mod_cal_year=' . $cal_year . '&mod_cal_month=' . $cal_prev_month;
						$content .= '<td>';
						$content .= $this->_htmlLinkCloaking( $link, '&lt;',
						array('class' => '"mod_events_link"',
						'title' => '"'._CAL_LANG_CLICK_TOSWITCH_PM.'"'))."\n";
						$content .= '</td>';
					}

					if( $this->minical_actmonth == 1 ){
						// combination of actual month and year: view month
						$seflinkActMonth = JRoute::_( $linkpref . 'view_month' . '&month=' . $cal_month
						. '&year=' . $cal_year);

						$content .= '<td align="center">';
						$content .= '<a class="mod_events_link" href="' . $seflinkActMonth
						. '" title="' . _CAL_LANG_CLICK_TOSWITCH_MON . '">' . $month_name . '</a>' . "\n";
						if( $this->minical_actyear < 1 ) $content .= '</td>';
					}elseif( $this->minical_actmonth == 2 ){
						$content .= '<td align="center">';
						$content .= $month_name . "\n";
						if( $this->minical_actyear < 1 ) $content .= '</td>';
					}

					if( $this->minical_actyear == 1 ){
						// combination of actual month and year: view year
						$seflinkActYear = JRoute::_( $linkpref . 'view_year' . '&month=' . $cal_month
						. '&year=' . $cal_year );

						if( $this->minical_actmonth < 1 )$content .= '<td align="center">';
						$content .= '<a class="mod_events_link" href="' . $seflinkActYear
						. '" title="' . _CAL_LANG_CLICK_TOSWITCH_YEAR . '">' . $cal_year . '</a>' . "\n";
						$content .= '</td>';
					}elseif( $this->minical_actyear == 2 ){
						if( $this->minical_actmonth < 1 ) $content .= '<td align="center">';
						$content .= $cal_year . "\n";
						$content .= '</td>';
					}

					if( $this->minical_nextmonth ){
						$link = $linkpref . 'view_month'
						. '&day=1&month=' . $cal_next_month . '&year=' . $cal_year
						. '&mod_cal_year=' . $cal_year . '&mod_cal_month=' . $cal_next_month;

						$content .= '<td>';
						$content .= $this->_htmlLinkCloaking( $link, '&gt',
						array('class' => '"mod_events_link"',
						'title' => '"'._CAL_LANG_CLICK_TOSWITCH_NM.'"')) . "\n";
						$content .= '</td>';
					}

					if( $this->minical_nextyear ){
						$link = $linkpref . 'view_year'
						. '&day=1&month=' . $cal_month . '&year=' . $cal_mod_next_year
						. '&mod_cal_year=' . $cal_mod_next_year . '&mod_cal_month=' . $cal_month;

						$content .= '<td>';
						$content .= $this->_htmlLinkCloaking( $link, '&raquo;',
						array('class' => '"mod_events_link"',
						'title' => '"'._CAL_LANG_CLICK_TOSWITCH_NY.'"')) . "\n";
						$content .= '</td>';
					}

					// combination of actual month and year: view year & month [ mic: not used here ]
					// $seflinkActYM   = JRoute::_( $link . 'view_month' . '&month=' . $cal_month
					// . '&year=' . $cal_year );
				}else{
					// show only text
					$content .= '<td>';
					$content .= $month_name . ' ' . $cal_year;
					$content .= '</td>';
				}

				$content .= "</tr>\n"
				. "</table>\n";
			}
			$lf = "\n";

			$content	.= '<table align="center" class="mod_events_table" cellspacing="0" cellpadding="2" >'.$lf
			. '<tr class="mod_events_dayname">'.$lf;

			// Days name rows
			for ($i=0;$i<7;$i++) {
				$content.="<td class=\"mod_events_td_dayname\">".$day_name[($i+$startday)%7]."</td>".$lf	;
			}

			$content.='</tr>'.$lf;

			// dmcd May 7/04 fix to fill in end days out of month correctly
			$dayOfWeek=$startday;

			$start= (date("w",mktime(0,0,0,$cal_month,1,$cal_year))-$startday+7)%7;

			$d=date("t",mktime(0,0,0,$cal_month,0,$cal_year))-$start + 1;

			if ($start>0) $content.="<tr>\n";
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
				if((( date( 'w', mktime( 0, 0, 0, $cal_month, $d, $cal_year )) - $startday ) % 7 ) == 0){
					// Note that if we are on the last day of the month and last day of week then we won't have
					// any out of month days so don't start a new row!
					//&& $d!=date( 't', mktime( 0, 0, 0, $cal_month, $d, $cal_year ))){
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

				$daylink = "index.php?option=".$option
				. "&task=view_day"
				. "&year=".$cal_year
				. "&month=".$cal_month
				. "&day=".$do
				. "&Itemid=".$this->myItemid . $this->cat;

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

		function _navigationJS($modid){
			static $included = false;
			if ($included) return;
			$included = true;
			?>
			<script language="javascript"  type="text/javascript" ><!--
			function navLoaded(elem, modid){
				myspan = document.getElementById("testspan"+modid);
				modbody = myspan.parentNode;
				modbody.innerHTML=elem.innerHTML;
			}
			function callNavigation(link){
				body = document.getElementsByTagName('body')[0];
				if (!document.getElementById('calnav')){
					iframe = document.createElement('iframe');
					iframe.setAttribute("name","calnav");
					iframe.setAttribute("id","calnav");
					iframe.setAttribute("style","display:none;");
				}
				body.appendChild(iframe);
				iframe.setAttribute("src",link);
			}
			//--></script>
			<?php
}

function monthYearNavigation($cal_today,$adj,$symbol, $label,$action="view_month"){
	$cfg = & EventsConfig::getInstance();
	$jev_component_name  = $cfg->get("com_componentname");
	$adjDate = strtotime($adj,$cal_today);
	list($year,$month) = explode(":",strftime("%Y:%m",$adjDate));
	$link = JRoute::_($this->linkpref.$action."&day=1&month=$month&year=$year".$this->cat);
	/*
	$link = JRoute::_($link);
	$content = '<td>';
	$content .= $this->_htmlLinkCloaking($link,$symbol,array('class'=>'"mod_events_link"','title'=>'"'.$label.'"'))."\n";
	$content .= '</td>';
	*/
	$content ="";
	if (isset($this->_modid) && $this->_modid>0){
		$this->_navigationJS($this->_modid);
		$link = htmlentities("index2.php?option=$jev_component_name&task=mod_cal&day=1&month=$month&year=$year&modid=$this->_modid".$this->cat);
		$content = '<td>';
		$content .= '<div class="mod_events_link" onmousedown="callNavigation(\''.$link.'\');">'.$symbol."</div>\n";
		$content .= '</td>';
	}
	return $content;
}

function _displayCalendarMod($time, $startday, $linkString, $day_name, $monthMustHaveEvent=false){

	$db	=& JFactory::getDBO();
	$cfg = & EventsConfig::getInstance();
	$option = $cfg->get("com_componentname");

	$cal_year=date("Y",$time);
	$cal_month=date("m",$time);
	$cal_day=date("d",$time);

	$data = $this->datamodel->getCalendarData($cal_year,$cal_month,1,true);

	$month_name = EventsHelper::getMonthName($cal_month);
	$first_of_month = mktime(0,0,0,$cal_month, 1, $cal_year);
	$today = mktime(0,0,0,$cal_month, $cal_day, $cal_year);

	$content    = '<div style="margin:0px;padding:0px;border-width:0px;">';

	$mod ="";
	if (isset($this->_modid) && $this->_modid>0){
		$mod = 'id="modid_'.$this->_modid.'" ';
		$content  .= "<span id='testspan".$this->_modid."' style='display:none'></span>\n";
	}

	if( $this->minical_showlink ){

		$content .= "\n".'<table cellpadding="0" cellspacing="0" align="center" class="mod_events_monthyear" >' . "\n"
		. '<tr >' . "\n";

		if( $this->minical_showlink == 1 ){

			if( $this->minical_prevyear ){
				$content .= $this->monthYearNavigation($first_of_month,"-1 year",'&laquo;',_CAL_LANG_CLICK_TOSWITCH_PY);
			}

			if( $this->minical_prevmonth ){
				$content .= $this->monthYearNavigation($first_of_month,"-1 month",'&lt;',_CAL_LANG_CLICK_TOSWITCH_PM);
			}

			if( $this->minical_actmonth == 1 ){
				// combination of actual month and year: view month
				$seflinkActMonth = JRoute::_( $this->linkpref.'view_month&month='.$cal_month.'&year='.$cal_year);

				$content .= '<td align="center">';
				$content .= '<a class="mod_events_link" href="' . $seflinkActMonth
				. '" title="' . _CAL_LANG_CLICK_TOSWITCH_MON . '">' . $month_name . '</a>' . "\n";
				if( $this->minical_actyear < 1 ) $content .= '</td>';
			}elseif( $this->minical_actmonth == 2 ){
				$content .= '<td align="center">';
				$content .= $month_name . "\n";
				if( $this->minical_actyear < 1 ) $content .= '</td>';
			}

			if( $this->minical_actyear == 1 ){
				// combination of actual month and year: view year
				$seflinkActYear = JRoute::_( $this->linkpref . 'view_year' . '&month=' . $cal_month
				. '&year=' . $cal_year );

				if( $this->minical_actmonth < 1 )$content .= '<td align="center">';
				$content .= '<a class="mod_events_link" href="' . $seflinkActYear
				. '" title="' . _CAL_LANG_CLICK_TOSWITCH_YEAR . '">' . $cal_year . '</a>' . "\n";
				$content .= '</td>';
			}elseif( $this->minical_actyear == 2 ){
				if( $this->minical_actmonth < 1 ) $content .= '<td align="center">';
				$content .= $cal_year . "\n";
				$content .= '</td>';
			}

			if( $this->minical_nextmonth ){
				$content .= $this->monthYearNavigation($first_of_month,"+1 month",'&gt;',_CAL_LANG_CLICK_TOSWITCH_NM);
			}

			if( $this->minical_nextyear ){
				$content .= $this->monthYearNavigation($first_of_month,"+1 year",'&raquo;',_CAL_LANG_CLICK_TOSWITCH_NY);
			}

			// combination of actual month and year: view year & month [ mic: not used here ]
			// $seflinkActYM   = JRoute::_( $link . 'view_month' . '&month=' . $cal_month
			// . '&year=' . $cal_year );
		}else{
			// show only text
			$content .= '<td>';
			$content .= $month_name . ' ' . $cal_year;
			$content .= '</td>';
		}

		$content .= "</tr>\n"
		. "</table>\n";
	}
	$lf = "\n";



	$content	.= '<table align="center" class="mod_events_table" cellspacing="0" cellpadding="2" >'.$lf
	. '<tr class="mod_events_dayname">'.$lf;

	// Days name rows
	for ($i=0;$i<7;$i++) {
		$content.="<td class=\"mod_events_td_dayname\">".$day_name[($i+$startday)%7]."</td>".$lf	;
	}

	$content.='</tr>'.$lf;

	$datacount = count($data["dates"]);
	$dn=0;
	for ($w=0;$w<6 && $dn<$datacount;$w++){
		$content .="<tr>\n";
		/*
		echo "<td width='2%' class='cal_td_weeklink'>";
		list($week,$link) = each($data['weeks']);
		echo "<a href='".$link."'>$week</a></td>\n";
		*/
		for ($d=0;$d<7 && $dn<$datacount;$d++){
			$currentDay = $data["dates"][$dn];
			switch ($currentDay["monthType"]){
				case "prior":
				case "following":
					$content .= '<td class="mod_events_td_dayoutofmonth">'.$currentDay["d"]."</td>\n";
					break;
				case "current":
					if ($currentDay["events"]){
						$class = ($currentDay["cellDate"] == $today) ? "mod_events_td_todaywithevents" : "mod_events_td_daywithevents";
					}
					else {
						$class = ($currentDay["cellDate"] == $today) ? "mod_events_td_todaynoevents" : "mod_events_td_daynoevents";
					}
					$content .= "<td class='".$class."'>\n";
					$content .="<a class='mod_events_daylink' href='".$currentDay["link"]."' title='". _CAL_LANG_CLICK_TOSWITCH_DAY."'>". $currentDay['d']."</a>\n";

					$content .="</td>\n";

					break;
			}
			$dn++;
		}
		$content .= "</tr>\n";
	}

	$content .= '</table>'.$lf;
	$content .= '</div>'.$lf;

	return $content;
}

function getAjaxCal($modid=0, $month, $year){
	// capture module id so that we can use it for ajax type navigation
	if ($modid!=0) {
		$this->_modid=$modid;
	}
	global   $mainframe;
	$user =& JFactory::getUser();

	$db	=& JFactory::getDBO();

	static $isloaded_css = false;
	// this will get the viewname based on which classes have been implemented
	$viewname = $this->getViewName();

	$cfg = & EventsConfig::getInstance();
	$compname = $cfg->get("com_componentname");

	$viewpath = JURI::root() . "components/$compname/layouts/".$viewname;
	$viewimages = $viewpath . "/images";

	$day_name = array( '<span class="sunday">' . _CAL_LANG_SUNDAYSHORT . '</span>',
	_CAL_LANG_MONDAYSHORT, _CAL_LANG_TUESDAYSHORT, _CAL_LANG_WEDNESDAYSHORT,
	_CAL_LANG_THURSDAYSHORT, _CAL_LANG_FRIDAYSHORT,
	'<span class="saturday">' ._CAL_LANG_SATURDAYSHORT. '</span>' );

	$content="";

	$temptime = mktime(12,0,0,$month,15,$year);

	$content .= $this->_displayCalendarMod($temptime,$this->com_starday, _CAL_LANG_THIS_MONTH,$day_name, false);

	return $content;
} // function getSpecificCal


function getCal($modid=0) {
	// capture module id so that we can use it for ajax type navigation
	if ($modid!=0) {
		$this->_modid=$modid;
	}
	global   $mainframe;
	$user =& JFactory::getUser();

	$db	=& JFactory::getDBO();

	// this will get the viewname based on which classes have been implemented
	$viewname = $this->getViewName();

	$cfg = & EventsConfig::getInstance();
	$compname = $cfg->get("com_componentname");

	$viewpath = JURI::root() . "components/$compname/layouts/".$viewname;
	$viewimages = $viewpath . "/images";

	$day_name = array( '<span class="sunday">' . _CAL_LANG_SUNDAYSHORT . '</span>',
	_CAL_LANG_MONDAYSHORT, _CAL_LANG_TUESDAYSHORT, _CAL_LANG_WEDNESDAYSHORT,
	_CAL_LANG_THURSDAYSHORT, _CAL_LANG_FRIDAYSHORT,
	'<span class="saturday">' ._CAL_LANG_SATURDAYSHORT. '</span>' );

	$content="";
	jevp_setStyleSheet( $viewpath, $this->inc_ec_css);

	$thisDayOfMonth = date("j", $this->timeWithOffset);
	$daysLeftInMonth = date("t", $this->timeWithOffset) - date("j", $this->timeWithOffset) + 1;

	if($this->disp_lastMonth && (!$this->disp_lastMonthDays || $thisDayOfMonth <= $this->disp_lastMonthDays))
	$content .= $this->_displayCalendarMod(strtotime("-1 month", $this->timeWithOffset),
	$this->com_starday, _CAL_LANG_LAST_MONTH,	$day_name, $this->disp_lastMonth == 2);

	//$content .= $this->_displayCalendarModOLD($this->timeWithOffset,$this->com_starday, _CAL_LANG_THIS_MONTH,$day_name, false);

	$content .= $this->_displayCalendarMod($this->timeWithOffset,
	$this->com_starday, _CAL_LANG_THIS_MONTH,$day_name, false);

	if($this->disp_nextMonth && (!$this->disp_nextMonthDays || $daysLeftInMonth <= $this->disp_nextMonthDays))
	$content .= $this->_displayCalendarMod(strtotime("+1 month", $this->timeWithOffset),
	$this->com_starday, _CAL_LANG_NEXT_MONTH,$day_name, $this->disp_nextMonth == 2);
	return $content;
} // function getCal
} // class JEventsCal
} // (!class_exists("JEventsCal")

if (!class_exists("JEventsLatest")) {

	EventsViewer::setViewClassName("mod_latest","JEventsLatest");

	class JEventsLatest{

		// Note that we encapsulate all this in a class to create
		// an isolated name space from everythng else (I hope).

		var $gid				= null;
		var $lang				= null;
		var $catid				= null;
		var $inccss				= null;

		var $maxEvents			= null;
		var $dispMode			= null;
		var $rangeDays			= null;
		var $norepeat			= null;
		var $displayLinks		= null;
		var $displayYear		= null;
		var $disableDateStyle	= null;
		var $disableTitleStyle	= null;
		var $linkCloaking		= null;
		var $customFormatStr	= null;
		var $defaultfFormatStr	= '${eventDate}[!a: - ${endDate(%I:%M%p)}]<br />${title}';
		var $linkToCal			= null;	// 0=no, 1=top, 2=bottom

		var $displayRSS			= null;
		var $rsslink 			= null;

		var $com_starday		= null;

		var $modparams			= null;

		var $datamodel 			= null;

		function getViewName(){
			return "default";
		}

		function JEventsLatest(&$params, $modid=0) {

			global  $mainframe;
			$user =& JFactory::getUser();


			$this->datamodel = new JEventsDataModel();

			// get global configuration object
			$jevents_config		= &EventsConfig::getInstance();

			$this->gid     = $user->gid;
			// Can't use getCfg since this cannot be changed by Joomfish etc.
			$tmplang		=& JFactory::getLanguage();
			$this->langname	= $tmplang->getBackwardLang();

			$this->modparams = & $params;

			// get params exclusive to module
			$this->inccss	= $params->get('modlatest_inccss', 0);

			// get params exclusive to component
			$this->com_starday = intval($jevents_config->get('com_starday',0));

			// get params depending on switch
			if (intval($params->get('modlatest_useLocalParam',  0)) == 1) {
				$myparam = &$params;
			} else {
				$myparam = &$jevents_config;
			}
			$this->maxEvents			= intval($myparam->get('modlatest_MaxEvents', 15));
			$this->dispMode				= intval($myparam->get('modlatest_Mode',   0));
			$this->rangeDays			= intval($myparam->get('modlatest_Days', 30));
			$this->norepeat				= intval($myparam->get('modlatest_NoRepeat',   0));
			$this->displayLinks			= intval($myparam->get('modlatest_DispLinks', 1));
			$this->displayYear			= intval($myparam->get('modlatest_DispYear',  0));
			$this->disableDateStyle		= intval($myparam->get('modlatest_DisDateStyle',  0));
			$this->disableTitleStyle	= intval($myparam->get('modlatest_DisTitleStyle', 0));
			$this->linkCloaking			= intval($myparam->get('modlatest_LinkCloaking', 0));
			$this->linkToCal			= intval($myparam->get('modlatest_LinkToCal', 0));
			$this->customFormatStr		= $myparam->get('modlatest_CustFmtStr', '');
			$this->displayRSS			= intval($myparam->get('modlatest_RSS', 0));

			if($this->dispMode > 4) $this->dispMode = 0;

			// $maxEvents hardcoded to 105 for now to avoid bad mistakes in params
			if($this->maxEvents > 150) $this->maxEvents = 150;

			// find appropriate Itemid and setup catids for datamodel
			$this->myItemid = $this->datamodel->setupModuleCatids($this->modparams);

			if ($this->displayRSS){
				if ($modid>0){
					$this->rsslink= JURI::base(false).JRoute::_("index.php?option=com_events&task=rss&feed=RSS2.0&modid=$modid&no_html=1");
				}
				else {
					$this->displayRSS=false;
				}
			}
		}


		/**
		 * Creates a JEvents_Latest object
		 *
		 * @param object The module parameter
		 * @return object A JEvents_Latest object
		 */
		function &getInstance(&$params) {

			$object = & new  JEventsLatest($params);
			return $object;
		}

		/**
		 * Serves requested category
		 *
		 * @param int category id
		 * @return object database row
		 */
		function &_getCategory($id) {

			global $mainframe;
			$db	=& JFactory::getDBO();
			$cfg = & EventsConfig::getInstance();
			$compname = $cfg->get("com_componentname");

			static $rows;

			if ($id <= 0) {
				return null;
			}
			if (!isset($rows)) {
				$rows = array();
			}

			if (!isset($rows[$id])) {
				$rows[$id] = null;
				$query = "SELECT id, name FROM #__categories WHERE section= '".$compname."'"
				. "\n AND published='1'"
				. "\n AND id = " . $id;
				$db->setQuery($query);
				$rows[$id]=$db->loadObject();
			}
			return $rows[$id];
		}

		/**
		 * Serves requested user
		 *
		 * @param int user id
		 * @return object database row
		 */
		function &_getUser($id) {

			global $mainframe;
			$db	=& JFactory::getDBO();

			static $rows;

			if ($id <= 0) {
				return null;
			}
			if (!isset($rows)) {
				$rows = array();
			}

			if (!isset($rows[$id])) {
				$rows[$id] = null;
				$query = "SELECT id, username, sendEmail, email FROM #__users"
				. "\n WHERE block ='0'"
				. "\n AND id = " . $id;
				$db->setQuery($query);
				$rows[$id]=$db->loadObject();
			}
			return $rows[$id];
		}

		/**
		 * Cloaks html link whith javascript
		 *
		 * @param string The cloaking URL
		 * @param string The link text
		 * @return string HTML
		 */
		function _htmlLinkCloaking($url='', $text='') {

			//$link = JRoute::_($url);
			// sef already should be already called below
			$link = $url;

			if ($this->linkCloaking) {
				//return mosHTML::Link("", $text, array('onclick'=>'"window.location.href=\''.josURL($url).'\';return false;"'));
				return '<a href="#" onclick="window.location.href=\'' . $link . '\'; return false;">' . $text . '</a>';
			} else {
				//return mosHTML::Link(josURL($url), "$text");
				return '<a href="' . $link .'">' . $text . '</a>';
			}
		}

		function JEventsLatestcmpByStartTime (&$a, &$b) {
			// this custom sort compare function compares the start times of events that are referenced by the a & b vars
			if ($a->publish_up() == $b->publish_up()) return 0;
			if (!isset($a->_startTime)){
				$a->_startTime = mktime($a->hup(),$a->minup(),$a->sup());
			}
			if (!isset($b->_startTime)){
				$b->_startTime = mktime($b->hup(),$b->minup(),$b->sup());
			}
			return ($a->_startTime < $b->_startTime) ? -1 : 1;
		}

		// this could go to a data model class
		// for the time being put it here so the different views can inherit from this 'base' class
		function getLatestEventsData(){

			global $mainframe;
			$db	=& JFactory::getDBO();

			$catidsOut = null;
			$modcatids = null;
			$catidList = null;

			$this->myItemid = findAppropriateMenuID($catidsOut, $modcatids, $catidList, $this->modparams->toObject());

			$this->cat = "";
			if ($catidsOut != 0){
				$this->cat = '&catids='.$catidsOut;
			}

			$this->now = time()+($mainframe->getCfg('offset')*60*60);
			$this->now_Y_m_d	= date('Y-m-d', $this->now);
			$this->now_d		= date('d', $this->now);
			$this->now_m		= date('m', $this->now);
			$this->now_Y		= date('Y', $this->now);
			$this->now_w		= date('w', $this->now);

			// derive the event date range we want based on current date and
			// form the db query.

			$todayBegin = $this->now_Y_m_d." 00:00:00";
			$yesterdayEnd = date('Y-m-d', mktime(0,0,0,$this->now_m,$this->now_d - 1, $this->now_Y))." 23:59:59";

			switch ($this->dispMode){
				case 0:
				case 1:

					// week start (ie. Sun or Mon) is according to what has been selected in the events
					// component configuration thru the events admin interface.

					$numDay=($this->now_w - $this->com_starday + 7)%7;
					// begin of this week
					$beginDate = date('Y-m-d', mktime(0,0,0,$this->now_m,$this->now_d - $numDay, $this->now_Y))." 00:00:00";
					//$thisWeekEnd = date('Y-m-d', mktime(0,0,0,$this->now_m,$this->now_d - $this->now_w+6, $this->now_Y)." 23:59:59";
					// end of next week
					$endDate = date('Y-m-d', mktime(0,0,0,$this->now_m,$this->now_d - $numDay + 13, $this->now_Y))." 23:59:59";
					break;

				case 2:
				case 3:
					// begin of today - $days
					$beginDate = date('Y-m-d', mktime(0,0,0,$this->now_m,$this->now_d - $this->rangeDays, $this->now_Y))." 00:00:00";
					// end of today + $days
					$endDate = date('Y-m-d', mktime(0,0,0,$this->now_m,$this->now_d + $this->rangeDays, $this->now_Y))." 23:59:59";
					break;

				case 4:
				default:
					// beginning of this month
					$beginDate = date('Y-m-d', mktime(0,0,0,$this->now_m,1, $this->now_Y))." 00:00:00";
					// end of this month
					$endDate = date('Y-m-d', mktime(0,0,0,$this->now_m+1,0, $this->now_Y))." 23:59:59";
					break;
			}

			$periodStart=substr($beginDate,0,10);
			$periodEnd=substr($endDate,0,10);
			$rows = $this->datamodel->queryModel->listEvents($periodStart, $periodEnd,"",$modcatids,$catidList);
			$icalrows = $this->datamodel->queryModel->listIcalEvents( $periodStart, $periodEnd,"",$modcatids,$catidList);
			$rows = array_merge($rows,$icalrows);

			// determine the events that occur each day within our range

			$events = 0;
			// I need the date not the time of day !!
			//$date = $this->now;
			$date = mktime(0,0,0,$this->now_m,$this->now_d, $this->now_Y);
			$lastDate = mktime(0,0,0,intval(substr($endDate,5,2)),intval(substr($endDate,8,2)),intval(substr($endDate,0,4)));
			$i=0;

			$seenThisEvent = array();
			$this->eventsByRelDay = array();

			if(count($rows)){

				while($date <= $lastDate){
					// get the events for this $date
					$eventsThisDay = array();
					foreach ($rows as $row) {
						if ($row->checkRepeatDay($date))  {
							if ($this->norepeat){
								// make sure this event has not already been used!
								$eventAlreadyAdded = false;
								foreach ($this->eventsByRelDay as $ebrd)
								if (in_array($row,$ebrd)){
									$eventAlreadyAdded = true;
									break;
								}
								if (!$eventAlreadyAdded) {
									$eventsThisDay[]=$row;
								}
							}
							else {
								$eventsThisDay[]=$row;
							}
						}
					}
					if(count($eventsThisDay)) {
						// dmcd May 7/04  bug fix to not exceed maxEvents
						$eventsToAdd = min($this->maxEvents-$events, count($eventsThisDay));
						$eventsThisDay = array_slice($eventsThisDay, 0, $eventsToAdd);

						$this->eventsByRelDay[$i] = $eventsThisDay;
						$events += count($this->eventsByRelDay[$i]);
					}
					if($events >= $this->maxEvents) break;
					$date = strtotime("+1 day",$date);
					$i++;
				}
			}
			if($events < $this->maxEvents && ($this->dispMode==1 || $this->dispMode==3)){

				if(count($rows)){

					// start from yesterday
					$date = mktime(23,59,59,$this->now_m,$this->now_d-1,$this->now_Y);
					$lastDate = mktime(0,0,0,intval(substr($beginDate,5,2)),intval(substr($beginDate,8,2)),intval(substr($beginDate,0,4)));
					$i=-1;

					while($date >= $lastDate){
						// get the events for this $date
						$eventsThisDay = array();
						foreach ($rows as $row) {
							if ($row->checkRepeatDay($date))  {
								if ($this->norepeat){
									// make sure this event has not already been used!
									$eventAlreadyAdded = false;
									foreach ($this->eventsByRelDay as $ebrd)
									if (in_array($row,$ebrd)){
										$eventAlreadyAdded = true;
										break;
									}
									if (!$eventAlreadyAdded) {
										$eventsThisDay[]=$row;
									}
								}
								else {
									$eventsThisDay[]=$row;
								}
							}
						}
						if(count($eventsThisDay)) {
							$this->eventsByRelDay[$i] = $eventsThisDay;
							$events += count($this->eventsByRelDay[$i]);
						}
						if($events >= $this->maxEvents) break;
						$date = strtotime("-1 day",$date);
						$i--;
					}
				}
			}
			if(isset($this->eventsByRelDay) && count($this->eventsByRelDay)){

				// When we display these events, we just start at the smallest index of the $this->eventsByRelDay array
				// and work our way up so sort the data first

				ksort($this->eventsByRelDay, SORT_NUMERIC);
				reset($this->eventsByRelDay);
			}

		}

		function processFormatString(){
			// see if $customFormatStr has been specified.  If not, set it to the default format
			// of date followed by event title.
			if($this->customFormatStr == NULL) $this->customFormatStr = $this->defaultfFormatStr;
			else {
				$this->customFormatStr = preg_replace('/^"(.*)"$/', "\$1", $this->customFormatStr);
				$this->customFormatStr = preg_replace("/^'(.*)'$/", "\$1", $this->customFormatStr);
				// escape all " within the string
				// $customFormatStr = preg_replace('/"/','\"', $customFormatStr);
			}

			// strip out event variables and run the string thru an html checker to make sure
			// it is legal html.  If not, we will not use the custom format and print an error
			// message in the module output.  This functionality is not here for now.

			// parse the event variables and reformat them into php syntax with special handling
			// for the startDate and endDate fields.
			//asdbg_break();
			$customFormat=$this->customFormatStr;

			$keywords = array(
			'content',				'eventDetailLink',		'createdByAlias',	'color',
			'createdByUserName',	'createdByUserEmail',	'createdByUserEmailLink',
			'eventDate',			'endDate',				'startDate',		'title',	'category',
			'contact',				'addressInfo',			'location',			'extraInfo'
			);
			$keywords_or = implode('|', $keywords);
			$whsp		= '[\t ]*'; // white space
			$datefm		= '\([^\)]*\)'; // date formats
			//$modifiers	= '(?::[[:alnum:]]*)';

			$pattern		= '/(\$\{'.$whsp.'(?:'.$keywords_or.')(?:'.$datefm.')?'.$whsp.'\})/';	// keyword pattern
			$cond_pattern	= '/(\[!?[[:alnum:]]+:[^\]]*])/';	// conditional string pattern e.g. [!a: blabla ${endDate(%a)}]

			// tokenize conditional strings
			$splitTerm = preg_split($cond_pattern, $customFormat, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);

			$this->splitCustomFormat = array();
			foreach ( $splitTerm as $key => $value) {
				if (preg_match('/^\[(.*)\]$/', $value, $matches)) {
					// remove outer []
					$this->splitCustomFormat[$key]['data'] = $matches[1];
					// split condition
					preg_match('/^([^:]*):(.*)$/', $this->splitCustomFormat[$key]['data'], $matches);
					$this->splitCustomFormat[$key]['cond'] = $matches[1];
					$this->splitCustomFormat[$key]['data'] = $matches[2];
				} else {
					$this->splitCustomFormat[$key]['data'] = $value;
				}
				// tokenize into array
				$this->splitCustomFormat[$key]['data'] = preg_split($pattern, $this->splitCustomFormat[$key]['data'], -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
			}

			// cleanup, remove white spaces from key words, seperate date parm string and modifier into array;
			// e.g.  ${ keyword ( 'aaaa' ) } => array('keyword', 'aaa',)
			foreach($this->splitCustomFormat as $ix => $yy) {
				foreach($this->splitCustomFormat[$ix]['data'] as $keyToken => $customToken) {
					if (preg_match('/\$\{'.$whsp.'('.$keywords_or.')('.$datefm.')?'.$whsp.'}/', $customToken, $matches)) {
						$this->splitCustomFormat[$ix]['data'][$keyToken] = array();
						$this->splitCustomFormat[$ix]['data'][$keyToken]['keyword'] = stripslashes($matches[1]);
						if (isset($matches[2])) {
							// ('aaa') => aaa
							$this->splitCustomFormat[$ix]['data'][$keyToken]['dateParm'] = preg_replace('/^\(["\']?(.*)["\']?\)$/',"\$1", stripslashes($matches[2]));
						}
					} else {
						$this->splitCustomFormat[$ix]['data'][$keyToken] = stripslashes($customToken);
					}
				}
			}
		}

		function displayLatestEvents(){

			// this will get the viewname based on which classes have been implemented
			$viewname = $this->getViewName();

			$cfg = & EventsConfig::getInstance();
			$compname = $cfg->get("com_componentname");

			$viewpath = JURI::root() . "components/$compname/layouts/".$viewname;

			jevp_setStyleSheet( $viewpath, $this->inccss);

			global $mainframe;
			$dispatcher	=& JDispatcher::getInstance();

			$this->getLatestEventsData();

			$content = "";
			$content .= '<table class="mod_events_latest_table" width="100%" border="0" cellspacing="0" cellpadding="0" align="center">';

			if(isset($this->eventsByRelDay) && count($this->eventsByRelDay)){

				// Now to display these events, we just start at the smallest index of the $this->eventsByRelDay array
				// and work our way up.

				$firstTime=true;

				// initialize name of com_events module and task defined to view
				// event detail.  Note that these could change in future com_event
				// component revisions!!  Note that the '$this->itemId' can be left out in
				// the link parameters for event details below since the event.php
				// component handler will fetch its own id from the db menu table
				// anyways as far as I understand it.

				$cfg = & EventsConfig::getInstance();
				$option = $cfg->get("com_componentname");
				$task_events = 'view_detail';

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

						if($firstTime) $content .= '<tr><td class="mod_events_latest_first">';
						else $content .= '<tr><td class="mod_events_latest">';

						// generate output according custom string
						foreach($this->splitCustomFormat as $condtoken) {

							if (isset($condtoken['cond'])) {
								if ( $condtoken['cond'] == 'a'  && !$dayEvent->alldayevent()) continue;
								if ( $condtoken['cond'] == '!a' &&  $dayEvent->alldayevent()) continue;
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
											if($this->langname == 'english'){
												//if($lang == 'english'){
												$time_fmt = $dayEvent->alldayevent() ? '' : ', @g:ia';
												$dateFormat = $this->displayYear ?  'D, M jS, Y'.$time_fmt: 'D, M jS'.$time_fmt;
												$content .= date($dateFormat, $$match);
											} else {
												$time_fmt = $dayEvent->alldayevent() ? '' : ' @%I:%M%p';
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

											$link = $dayEvent->viewDetailLink(date("Y", $eventDate),date("m", $eventDate),date("d", $eventDate),false);
											$link = JRoute::_($link.$this->datamodel->getItemidLink().$this->datamodel->getCatidsOutLink());

											$content .= $this->_htmlLinkCloaking($link,$dayEvent->title());
											/*
											"index.php?option=".$option
											. "&task="  . $task_events
											. "&agid="  . $dayEvent->id()
											. "&year="  . date("Y", $eventDate)
											. "&month=" . date("m", $eventDate)
											. "&day=" 	. date("d", $eventDate)
											. "&Itemid=". $this->myItemid . $this->cat, $dayEvent->title());
											*/
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
										$this->modparams->set("image",0);
										$dayEvent->data->text = $dayEvent->location();
										$results = $dispatcher->trigger( 'onPrepareContent', array( &$dayEvent->data, &$this->modparams, 0 ), true );
										$dayEvent->location($dayEvent->data->text);
										$content .= $dayEvent->location();
										break;

									case 'extraInfo':
										$this->modparams->set("image",0);
										$dayEvent->data->text = $dayEvent->extra_info();
										$results = $dispatcher->trigger( 'onPrepareContent', array( &$dayEvent->data, &$this->modparams, 0 ), true );
										$dayEvent->extra_info($dayEvent->data->text);
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
										$link = $dayEvent->viewDetailLink($year,$month,$day,false);
										$link = JRoute::_($link.$this->datamodel->getItemidLink().$this->datamodel->getCatidsOutLink());
										$content .= $link;

										/*
										$content .= JRoute::_("index.php?option="
										. $option
										. "&task=".$task_events
										. "&agid=".$dayEvent->id()
										. "&year=".$year
										. "&month=".$month
										. "&day=".$day
										. "&Itemid=".$this->myItemid . $this->cat);
										*/
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
			$compname = $cfg->get("com_componentname");
			$callink_HTML = '<div class="mod_events_latest_callink">'
			. $this->_htmlLinkCloaking("index.php?option=$compname" .  "&Itemid=". $this->myItemid . $this->cat, _CAL_LANG_CLICK_TOCOMPONENT)
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
