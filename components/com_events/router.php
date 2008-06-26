<?php

include_once(JPATH_ADMINISTRATOR . '/components/com_events/lib/config.php');

function EventsBuildRoute(&$query)
{
	$cfg = & EventsConfig::getInstance();
	$segments = array();
	if (!isset($query['task'])){
		$task = $cfg->get('com_startview');
	}
	else {
		$task=$query['task'];
		unset($query['task']);
	}

	switch ($task) {
		case "view_year":
		case "view_month":
		case "view_week":
		case "view_day":
		case "view_detail":
		case "view_search":
		case "admin":
		case "add":
		case "editIcalEvent":
		case "delete":
		case "deleteIcalEvent":
			{
				$segments[]=$task;
				$config	=& JFactory::getConfig();
				$year		= intval( JRequest::getVar( 'year',	strftime( '%Y', time() + ( $config->getValue('config.offset')*60*60 )) ));
				$month	= intval( JRequest::getVar( 'month',	strftime( '%m', time() + ( $config->getValue('config.offset')*60*60 )) ));
				$day		= intval( JRequest::getVar( 'day',	strftime( '%d', time() + ( $config->getValue('config.offset')*60*60 )) ));

				if(isset($query['year'])) {
					$segments[] = $query['year'];
					unset($query['year']);
				}
				else {
					$segments[] = $year;
				}
				if(isset($query['month'])) {
					$segments[] = $query['month'];
					unset($query['month']);
				}
				else {
					$segments[] = $month;
				}
				if(isset($query['day'])) {
					$segments[] = $query['day'];
					unset($query['day']);
				}
				else {
					$segments[] = $day;
				}
				switch ($task) {
					case  "view_detail" :
						if(isset($query['agid'])) {
							$segments[] = $query['agid'];
							unset($query['agid']);
						}
						else {
							$segments[] = "";
						}
						if(isset($query['jevtype'])) {
							$segments[] = $query['jevtype'];
							unset($query['jevtype']);
						}
						else {
							$segments[] = "";
						}
						break;
					case  "delete" :
					case  "modify" :
					case "deleteIcalEvent" :
					case "editIcalEvent":
						if(isset($query['agid'])) {
							$segments[] = $query['agid'];
							unset($query['agid']);
						}
						else {
							$segments[] = "";
						}

						break;
					default:
						break;
				}
			}
			break;
		case "rss":
			$segments[]=$task;
			if(isset($query['feed'])) {
				$segments[] = $query['feed'];
				unset($query['feed']);
			}
			else {
				$segments[] = "RSS2.0";
			}
			if(isset($query['modid'])) {
				$segments[] = $query['modid'];
				unset($query['modid']);
			}
			else {
				$segments[] = "";
			}
			if(isset($query['no_html'])) {
				$segments[] = $query['no_html'];
				unset($query['no_html']);
			}
			else {
				$segments[] = 0;
			}
			break;

		default:
			echo $task;
			break;
	}

	return $segments;
}

function EventsParseRoute($segments)
{
	$vars = array();

	//Get the active menu item
	$menu =& JSite::getMenu();
	$item =& $menu->getActive();

	// Count route segments
	$count = count($segments);

	if ($count>0){
		// task
		$task = $segments[0];
		$vars["task"]=$task;

		switch 	($task){
			case "view_year":
			case "view_month":
			case "view_week":
			case "view_day":
			case "view_detail":
				if($count>1) {
					$vars['year'] = $segments[1];
				}
				if($count>2) {
					$vars['month'] = $segments[2];
				}
				if($count>3) {
					$vars['day'] = $segments[3];
				}
				if ($task=="view_detail"){
					if($count>4) {
						$vars['agid'] = $segments[4];
					}
					if($count>5) {
						$vars['jevtype'] = $segments[5];
					}
				}
				break;
			case "rss":
				if($count>1) {
					$vars['feed']= $segments[1];
				}
				else {
					$vars[] = "RSS2.0";
				}
				if($count>2) {
					$vars['modid'] = $segments[2];
				}
				else {
					$vars[] = "0";
				}
				if($count>3) {
					$vars['no_html'] = $segments[3];
				}
				else {
					$vars[] = "1";
				}
				break;

			default:
				break;
		}


	}
	return $vars;

}