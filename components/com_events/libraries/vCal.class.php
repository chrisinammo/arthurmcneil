<?php
/**
 * JEvents Component for Joomla 1.1
 *
 * @version   $Id: vCal.class.php 911 2007-12-21 11:14:36Z geraint $
 * @package   JEvents
 * @copyright Copyright (C) 2006 Geraint Edwards, Thomas Stahl
 * @licence   http://www.gnu.org/copyleft/gpl.html
 */
/***************************************************************************
PHP vCal class v0.1
***************************************************************************/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

// borrow encoding stuff from bitfolge.vcard
global $mainframe;
include_once(JPATH_ROOT."/includes/vcard.class.php");

class vEvent// extends JObject
{
	var $properties;
	var $reccurdays= array("SU","MO","TU","WE","TH","FR","SA");
	var $reccurday = "";
	
	//function __construct($event) {
	function vEvent($event) {
		$this->properties = array();

		$this->addProperty("SUMMARY",$event->title);
		$this->setDescription( $event->content);
		$this->addProperty("LOCATION",$event->adresse_info);
		$this->addProperty("CONTACT",$event->contact_info);
		$this->addProperty("CATEGORIES",$event->category);
		$this->addProperty("X-EXTRAINFO",$event->extra_info);

		//recurrence
		if ($event->reccurtype==0){
			$this->addProperty("DTSTART",date("Ymd\THi00",$event->dtstart ));
			$this->addProperty("DTEND",date("Ymd\THi00",$event->dtend ));
			$this->addProperty("UID",time()."evt".$event->id);
		}
		else {
			$rrule = "";
			switch ($event->reccurtype) {
				case 1://each week                                   
					$rrule.="FREQ=WEEKLY;";
					$rrule.="UNTIL=".date("Ymd\THi00", $event->dtend )."Z;";
					if ($event->reccurweeks=="pair") $rrule.="INTERVAL=2;";
					elseif ($event->reccurweeks=="impair") $rrule.="INTERVAL=3;";
					else $rrule.="INTERVAL=1;";
					$rrule.="BYDAY=".$this->reccurdays[$event->reccurday];

					break;
				case 2://more than once a week  or set days per month                                
					if ($event->reccurweeks=="pair" || $event->reccurweeks=="impair"){
						$rrule.="FREQ=WEEKLY;";						
						$rrule.="UNTIL=".date("Ymd\THi00", $event->dtend )."Z;";
						if ($event->reccurweeks=="pair") $rrule.="INTERVAL=2;";
						elseif ($event->reccurweeks=="impair") $rrule.="INTERVAL=3;";
						$bd = explode("|",$event->reccurweekdays);
						foreach ($bd as $key=>$val){
							$bd[$key] = $this->reccurdays[$val];
						}
						$rrule.="BYDAY=".implode(",",$bd);
					}
					else {
						$rrule.="FREQ=MONTHLY;";												
						$rrule.="UNTIL=".date("Ymd\THi00", $event->dtend )."Z;";
						$rrule.="INTERVAL=1;";
						//$rrule.="BYWEEKNO=".str_replace("|",",",$event->reccurweeks).";";
						$wn = explode("|",$event->reccurweeks);
						$bd = explode("|",$event->reccurweekdays);
						$bydays = array();
						foreach ($wn as $weeknum){
							foreach ($bd as $dayname){
								$bydays[] = $weeknum.$this->reccurdays[$dayname];
							}
						}
						$rrule.="BYDAY=".implode(",",$bydays);
					}
					break;

				case 3://each month                                   
					$rrule.="FREQ=MONTHLY;";
					$rrule.="UNTIL=".date("Ymd\THi00", $event->dtend )."Z;";
					$rrule.="INTERVAL=1;";
					if ($event->reccurday==-1){
						$rrule.="BYMONTHDAY=".date("d",$event->dtstart );
					}
					else {
						$monthday = date("d",$event->dtstart );
						$days = array();
						for ($d=0;$d<7;$d++){
							if ($monthday+$d>31) break;
							$days[]=$monthday+$d;
						}
						$rrule.="BYMONTHDAY=".implode(",",$days).";";
						$rrule.="BYDAY=".$this->reccurdays[$event->reccurday];						
					}
					
					break;
				case 4://the end of each month                                   
					//$this->reccurday = $event->reccurday_month;
					$rrule.="FREQ=MONTHLY;";
					$rrule.="UNTIL=".date("Ymd\THi00", $event->dtend )."Z;";
					$rrule.="INTERVAL=1;";
					$rrule.="BYMONTHDAY=-1";
					break;
				case 5://each year                                   
					$rrule.="FREQ=YEARLY;";
					$rrule.="UNTIL=".date("Ymd\THi00", $event->dtend )."Z;";
					$rrule.="INTERVAL=1;";
					if ($event->reccurday == -1){
						$rrule.="BYMONTHDAY=".date("d",$event->dtstart );						
					}
					else {
						$monthday = date("d",$event->dtstart );
						$days = array();
						for ($d=0;$d<7;$d++){
							if ($monthday+$d>31) break;
							$days[]=$monthday+$d;
						}
						$rrule.="BYMONTHDAY=".implode(",",$days).";";
						$rrule.="BYDAY=".$this->reccurdays[$event->reccurday];						
					}
					break;
				default:
					$this->reccurday = "";
			}

			$this->addProperty("DTSTART",date("Ymd\THi00",$event->dtstart ));
			$endtime = $event->dtstart + (($event->dtend - $event->dtstart) % (24*60*60));
			//$event->reccurweekdays
			//$event->reccurweeks
			if ($rrule!="")	$this->addProperty("RRULE",$rrule);
			$this->addProperty("DTEND",date("Ymd\THi00",$endtime ));
			$this->addProperty("UID",time()."evt".$event->id." ".time()."recur");
		}
		$this->addProperty("DTSTAMP",date("Ymd\THi00")."Z");
	}

	function addProperty($key,$prop) {
		$this->properties[$key]=$prop;
	}

	function setDescription($desc) {
		$description = $desc;
		$description 	= str_replace( '<p>', "\n\n", $description );
		$description 	= str_replace( '<P>', "\n\n", $description );
		$description 	= str_replace( '</p>', "\n" ,$description );
		$description 	= str_replace( '</P>', "\n" ,$description );
		$description 	= str_replace( '<p/>', "\n\n", $description );
		$description 	= str_replace( '<P/>', "\n\n", $description );
		$description 	= str_replace( '<br />', "\n", $description );
		$description 	= str_replace( '<br>', "\n" ,$description );
		$description 	= str_replace( '<BR />', "\n", $description );
		$description 	= str_replace( '<BR>', "\n" ,$description );
		$description 	= str_replace( '<li>', "\n - ", $description );
		$description 	= str_replace( '<LI>', "\n - ", $description );
		$description 	= strip_tags( $description );
		$description 	= str_replace( '{mosimage}', '', $description );
		$description 	= str_replace( '{mospagebreak}', '', $description	);
		$description 	= strtr( $description,	array_flip(get_html_translation_table( HTML_ENTITIES ) ) );
		$description 	= preg_replace( "/&#([0-9]+);/me","chr('\\1')", $description );
		
		// quoted_printable_encode	from vCard class
		$this->addProperty("DESCRIPTION;ENCODING=QUOTED-PRINTABLE",quoted_printable_encode($description));
	}

	function getEvent() {
	  	$output = "";
  		$output .=  "BEGIN:VEVENT\r\n";
		$showBR = intval(JRequest::getVar('showBR', '1'));
		if ($showBR) $output.= "<br/>";
		
		foreach($this->properties as $key => $value) {
			$output.= "$key:$value\r\n";
			if ($showBR) $output.= "<br/>";
		}

 		$output .=  "END:VEVENT\r\n";
		if ($showBR) $output.= "<br/>"; 				

		return $output;
	}
	
}

class vCal //extends JObject 
{
	var $properties;
	var $filename;
	var $events;

	/**
	* @param filename for download
	*/
	//function __construct($vCalFileName) {
	function vCal($vCalFileName){
		$this->properties = array();
		$this->filename = $vCalFileName;		
		$this->events = array();
	}


	function addProperty($key,$prop) {
		$this->properties[$key]=$prop;
	}
	
	function addEvent($event){
		$this->events[] = new vEvent($event);
	}
	
	function getVCal() {
		$showBR = intval(JRequest::getVar('showBR', '1'));
		
	  	$output = "";
	  	$output .=  "BEGIN:VCALENDAR\r\n";
		if ($showBR) $output.= "<br/>";  	
	  	$output .=  "PRODID: -//JEvents for Joomla 1.0.x\r\n";
		if ($showBR) $output.= "<br/>";
	  	$output .=  "VERSION:2.0\r\n";
		if ($showBR) $output.= "<br/>";
	  	$output .=  "METHOD:PUBLISH\r\n";
		if ($showBR) $output.= "<br/>";
		
	  	foreach ($this->events as $evt) {
	  		$output .= $evt->getEvent() ;
	  	}
	  	
		foreach($this->properties as $key => $value) {
			$output.= "$key:$value\r\n";
		}

	  	$output .=  "END:VCALENDAR\r\n";

		return $output;
	}

	function getFileName() {
		return $this->filename;
	}
}
?>
