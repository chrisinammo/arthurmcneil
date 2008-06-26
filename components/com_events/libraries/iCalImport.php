<?php
/**
 * Events Component for Joomla 1.5.x
 *
 * @version     $Id: iCalImport.php 982 2008-02-17 10:42:18Z geraint $
 * @package     Events
 * @copyright   Copyright (C) 2006-2007 JEvents Project Group
 * @licence     http://www.gnu.org/copyleft/gpl.html
 * @link        http://joomlacode.org/gf/project/jevents
 */

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );


// This class doesn't yet deal with repeating events

class iCalImport
{
	/**
	 * This array saves the iCalendar parsed data as an array - may make a class later!
	 *
	 * @var array
	 */
	var $cal;

	var $key;
	var $rawData;
	var $eventCount = -1;
	var $todoCount = -1;

	var $vevents;

	// constructor
	function iCalImport($filename,$rawtext="")
	{
		$cfg = & EventsConfig::getInstance();
		$option = $cfg->get("com_componentname");
		// resultant data goes here
		$this->cal = array();
		if ($filename!=""){
			$file = $filename;
			if (!file_exists($file)) {
				global $mainframe;
				$file = JPATH_SITE."/components/$option/".$filename;
			}
			if (!file_exists($file)) {
				echo "I hope this is a URL!!<br/>";
				$file = $filename;
			}

			// get name
			$this->srcURL ="";
			$isFile = false;
			if (isset($_FILES['upload']) && is_array($_FILES['upload']) ) {
				$uploadfile = $_FILES['upload'];
				// MSIE sets a mime-type of application/octet-stream
				if ($uploadfile['size']!=0 && ($uploadfile['type']=="text/calendar" || $uploadfile['type']=="application/octet-stream")){
					$this->srcURL = $uploadfile['name'];
					$isFile = true;
				}
			}
			if ($this->srcURL =="")  {
				$this->srcURL = $file;
			}

			// $this->rawData = iconv("ISO-8859-1","UTF-8",file_get_contents($file));

			/*
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,($isFile?"file://":"").$file);
			curl_setopt($ch, CURLOPT_VERBOSE, 1);
			curl_setopt($ch, CURLOPT_POST, 0);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
			$returned = curl_exec($ch);
			curl_close ($ch);

			echo $returned;
			*/
			$this->rawData = file_get_contents($file);

			// Returns true if $string is valid UTF-8 and false otherwise.
			/*
			$isutf8 = $this->detectUTF8($this->rawData);
			if ($isutf8) {
				$this->rawData = iconv("ISO-8859-1","UTF-8",$this->rawData);
			}
			*/

		}
		else {
			$this->srcURL="n/a";
			$this->rawData = $rawtext;
		}

		// get rid of spurious carriage returns and spaces
		$this->rawData = preg_replace("/[\r\n]+ ([:;])/","$1",$this->rawData);

		// TODO make sure I can always ignore the second line
		// Some google calendars has spaces and carriage returns in their UIDs

		// Convert string into array for easier processing
		$this->rawData = explode("\n", $this->rawData);

		// The file should start with BEGIN:VCALENDAR
		if (!stristr($this->rawData[0],'BEGIN:VCALENDAR')) return 'Not a valid VCALENDAR data file';

		foreach ($this->rawData as $vcLine)
		{
			$vcLine = trim($vcLine); // trim one line
			if (!empty($vcLine))
			{
				$matches = explode(":",$vcLine,2);

				if (count($matches)<2) {
					// in this case leave the key as is from last time round and append result
					$value = $vcLine;
					$append=true;
				}
				else  {
					list($this->key,$value)= $matches;
					$append=false;
				}

				// Treat Accordingly
				switch ($vcLine)
				{
					case "BEGIN:VTODO":
						// start of VTODO section
						$this->todoCount++;
						$parent = "VTODO";
						break;

					case "BEGIN:VEVENT":
						// start of VEVENT section
						$this->eventCount++;
						$parent = "VEVENT";
						break;

					case "BEGIN:VCALENDAR":
					case "BEGIN:DAYLIGHT":
					case "BEGIN:VTIMEZONE":
					case "BEGIN:STANDARD":
						$parent = $value; // save tu array under value key
						break;

					case "END:VTODO":
					case "END:VEVENT":

					case "END:VCALENDAR":
					case "END:DAYLIGHT":
					case "END:VTIMEZONE":
					case "END:STANDARD":
						$parent = "VCALENDAR";
						break;

					default:
						// Generic processing
						$this->add_to_cal($parent, $this->key, $value,$append);
						break;
				}
			}
		}
		// Sort the events into start date order
		// there's little point in doing this id an RRULE is present!
		//	usort($this->cal['VEVENT'], array("iCalImport","comparedates"));

		// Populate vevent class - should do this first trawl through !!
		$this->vevents = array();
		if (array_key_exists("VEVENT",$this->cal)) {
			foreach ($this->cal["VEVENT"] as $vevent){
				$this->vevents[] = iCalEvent::iCalEventFromData($vevent);
			}
		}

		return $this;
	}

	function add_to_cal($parent, $key, $value, $append)
	{

		// I'm not interested in when the events were created/modified
		if (($key == "DTSTAMP") or ($key == "LAST-MODIFIED") or ($key == "CREATED")) return;

		if ($key == "RRULE" && $value!="") {
			$value = $this->parseRRULE($value,$parent);
		}

		$rawkey="";
		if (stristr($key,"DTSTART") || stristr($key,"DTEND") || stristr($key,"EXDATE")) {
			list($key,$value,$rawkey,$rawvalue) = $this->handleDate($key,$value);
		}
		if (stristr($key,"DURATION")) {
			list($key,$value,$rawkey,$rawvalue) = $this->handleDuration($key,$value);
		}

		switch ($parent)
		{
			case "VTODO":
				$this->cal[$parent][$this->todoCount][$key] = $value;
				break;

			case "VEVENT":
				// strip off unnecessary quoted printable encoding message
				$parts = explode(';',$key);
				if (count($parts)>1 ){
					$key=$parts[0];
					for ($i=1; $i<count($parts);$i++) {
						if ($parts[$i]=="ENCODING=QUOTED-PRINTABLE"){
							//$value=str_replace("=0D=0A","<br/>",$value);
							$value=quoted_printable_decode($value);
						}
						// drop other ibts like language etc.
					}
				}

				// Special treatment of
				if (strpos($key,"EXDATE")===false){
					$target =& $this->cal[$parent][$this->eventCount][$key];
					$rawtarget =& $this->cal[$parent][$this->eventCount][$rawkey];
				}
				else {
					// TODO timezone info is dropped here
					if (!array_key_exists("EXDATE",$this->cal[$parent][$this->eventCount])){
						$this->cal[$parent][$this->eventCount]["EXDATE"]=array();
						$this->cal[$parent][$this->eventCount]["RAWEXDATE"]=array();
					}
					$target =& $this->cal[$parent][$this->eventCount]["EXDATE"][count($this->cal[$parent][$this->eventCount]["EXDATE"])];
					$rawtarget =& $this->cal[$parent][$this->eventCount]["RAWEXDATE"][count($this->cal[$parent][$this->eventCount]["RAWEXDATE"])];
				}

				// THIS IS NEEDED BECAUSE OF DODGY carriage returns in google calendar UID
				// TODO check its enough
				if ($append){
					$target .= $value;
				}
				else {
					$target = $value;
				}
				if ($rawkey!=""){
					$rawtarget = $rawvalue;
				}
				break;

			default:
				$this->cal[$parent][$key] = $value;
				break;
		}
	}

	function parseRRULE($value, $parent)
	{
		$result = array();
		$parts = explode(';',$value);
		foreach ($parts as $part) {
			if (strlen($part)==0) continue;
			$portion = explode('=', $part);
			if (stristr($portion[0],"UNTIL")){
				$untilArray = $this->handleDate($portion[0],$portion[1]);
				$result[$untilArray[0]] = $untilArray[1];
				$result[$untilArray[2]] = $untilArray[3];
			}
			else $result[$portion[0]] = $portion[1];

		}
		return $result;
	}

	/**
	 * iCal spec represents date in ISO 8601 format followed by "T" then the time
	 * a "Z at the end means the time is UTC and not local time zone
	 */
	function unixTime($ical_date)
	{
		if (strpos($ical_date,"Z")!== false){
			// TODO sort this out
			echo "can't deal with UTC time yet ".$ical_date."<br/>";
		}
		// strip "T" and "Z" from the string
		$ical_date = str_replace('T', '', $ical_date);
		$ical_date = str_replace('Z', '', $ical_date);

		// split it out intyo YYYY MM DD HH MM SS
		ereg("([0-9]{4})([0-9]{2})([0-9]{2})([0-9]{0,2})([0-9]{0,2})([0-9]{0,2})", $ical_date,$date);
		list($temp,$y,$m,$d,$h,$min,$s)=$date;
		if (!$min) $min=0;
		if (!$d) $d=0;
		if (!$s) $s=0;

		// Trap unix dated beofre 1970
		$y = max($y,1970);
		$result = mktime($h,$min,$s,$m,$d,$y);
		// double check!!
		//list($y1,$m1,$d1,$h1,$min1,$s1)=explode(":",strftime('%Y:%m:%d:%H:%M:%S',$result));
		return  $result;
	}

	function handleDate($key, $value)
	{
		$rawvalue = $value;
		$value = $this->unixTime($value);
		$parts = explode(";",$key);

		if (count($parts)<2 || strlen($parts[1])==0)
		{
			$rawkey=$key."RAW";
			return array($key,$value, $rawkey, $rawvalue);
		}
		$key = 	$parts[0];
		$rawkey=$key."RAW";
		return array($key,$value, $rawkey, $rawvalue);
	}

	function handleDuration($key,$value)
	{
		$rawvalue = $value;
		// strip "P" from the string
		$value = str_replace('P', '', $value);
		// split it out intyo W D H M S
		preg_match("/([0-9]*W)*([0-9]*D)*T?([0-9]*H)*([0-9]*M)*([0-9]*S)*/",$value,$details);
		list($temp,$w,$d,$h,$min,$s)=$details;
		$duration = 0;
		$multiplier=1;
		$duration += intval(str_replace('S','',$s))*$multiplier;
		$multiplier=60;
		$duration += intval(str_replace('M','',$min))*$multiplier;
		$multiplier=3600;
		$duration += intval(str_replace('H','',$h))*$multiplier;
		$multiplier=86400;
		$duration += intval(str_replace('D','',$d))*$multiplier;
		$multiplier=604800;
		$duration += intval(str_replace('W','',$w))*$multiplier;

		$rawkey=$key."RAW";
		return array($key, $duration, $rawkey, $rawvalue);
	}

	/**
	 * Compare two unix timestamp
	 *
	 * @param array $a
	 * @param array $b
	 * @return integer
	 */
	function comparedates($a, $b)
	{
		if (!array_key_exists('DTSTART',$a) || !array_key_exists('DTSTART',$b) ){
			echo "help<br/>";
		}
		if ($a['DTSTART'] == $b['DTSTART']) return 0;
		return ($a['DTSTART'] > $b['DTSTART'])? +1 : -1;
	}


	// from http://fr3.php.net/manual/en/function.mb-detect-encoding.php#50087
	function is_utf8($string) {

		// From http://w3.org/International/questions/qa-forms-utf-8.html
		$result =  preg_match('%^(?:
         [\x09\x0A\x0D\x20-\x7E]            # ASCII
       | [\xC2-\xDF][\x80-\xBF]            # non-overlong 2-byte
       |  \xE0[\xA0-\xBF][\x80-\xBF]        # excluding overlongs
       | [\xE1-\xEC\xEE\xEF][\x80-\xBF]{2}  # straight 3-byte
       |  \xED[\x80-\x9F][\x80-\xBF]        # excluding surrogates
       |  \xF0[\x90-\xBF][\x80-\xBF]{2}    # planes 1-3
       | [\xF1-\xF3][\x80-\xBF]{3}          # planes 4-15
       |  \xF4[\x80-\x8F][\x80-\xBF]{2}    # plane 16
   )*$%xs', $string);

		return $result;

	} // function is_utf8

	// from http://fr3.php.net/manual/en/function.mb-detect-encoding.php#68607
	function detectUTF8($string)
	{
		return preg_match('%(?:
       [\xC2-\xDF][\x80-\xBF]        # non-overlong 2-byte
       |\xE0[\xA0-\xBF][\x80-\xBF]              # excluding overlongs
       |[\xE1-\xEC\xEE\xEF][\x80-\xBF]{2}      # straight 3-byte
       |\xED[\x80-\x9F][\x80-\xBF]              # excluding surrogates
       |\xF0[\x90-\xBF][\x80-\xBF]{2}    # planes 1-3
       |[\xF1-\xF3][\x80-\xBF]{3}                  # planes 4-15
       |\xF4[\x80-\x8F][\x80-\xBF]{2}    # plane 16
       )+%xs', $string);
	}


}
/*
class iCalFreq {

}
class iCalYearly extends iCalFreq{

}
class iCalMonthly extends iCalFreq{

}
*/
class iCalRepetition extends JTable  {

	/** @var int Primary key */
	var $rp_id		= null;
	var $eventid = null;
	var $eventdetail_id = null;
	var $startrepeat = null;
	var $endrepeat =null;

	function iCalRepetition( &$db ) {
		parent::__construct( '#__jevents_repetition', 'rp_id', $db );
	}
}

class iCalRRule extends JTable  {

	/** @var int Primary key */
	var $rr_id					= null;

	/**
	 * This holds the raw data as an array 
	 *
	 * @var array
	 */
	var $data;
	var $freq;

	// array of exception dates
	var $_exdate = array();

	/**
	 * Null Constructor
	 */
	function iCalRRule( &$db ) {
		parent::__construct( '#__jevents_rrule', 'rr_id', $db );
	}

	/**
	 * Pseudo Constructor
	 *
	 * @param iCal Entry parsed from ICS file as an array $ice
	 * @return n/a
	 */
	function iCalRRuleFromDB($icalrowAsArray){
		$db	=& JFactory::getDBO();
		$temp = new iCalRRule($db);

		$temp->data = $icalrowAsArray;

		// Should really test count
		$temp->processField2("freq","YEARLY");
		$temp->processField2("count",999999);
		$temp->processField2("rinterval",1);
		//interval ios a mysql reserved word
		$temp->_interval = $temp->rinterval;
		$temp->processField2("until","");
		$temp->processField2("untilraw","");
		$temp->processField2("bysecond","");
		$temp->processField2("byminute","");
		$temp->processField2("byhour","");
		$temp->processField2("byday","");
		$temp->processField2("bymonthday","");
		$temp->processField2("byyearday","");
		$temp->processField2("byweekno","");
		$temp->processField2("bymonth","");
		$temp->processField2("bysetpos","");
		$temp->processField2("wkst","");
		return $temp;
	}
	function processField2($field,$default){
		$this->$field = array_key_exists(strtolower($field),$this->data)?$this->data[strtolower($field)]:$default;
	}


	/**
	 * Pseudo Constructor
	 *
	 * @param iCal Entry parsed from ICS file as an array $ice
	 * @return n/a
	 */
	function iCalRRuleFromData($rrule){
		$db	=& JFactory::getDBO();
		$temp = new iCalRRule($db);

		$temp->data = $rrule;
		$temp->freq = $temp->data['FREQ'];

		// Should really test count
		$temp->processField("count",99999);
		$temp->processField("interval",1);
		//interval ios a mysql reserved word
		$temp->rinterval = $temp->interval;
		$temp->_interval = $temp->interval;
		unset($temp->interval);
		$temp->processField("until","");
		$temp->processField("untilraw","");
		$temp->processField("bysecond","");
		$temp->processField("byminute","");
		$temp->processField("byhour","");
		$temp->processField("byday","");
		$temp->processField("bymonthday","");
		$temp->processField("byyearday","");
		$temp->processField("byweekno","");
		$temp->processField("bymonth","");
		$temp->processField("bysetpos","");
		$temp->processField("wkst","");
		return $temp;
	}

	function processField($field,$default){
		$this->$field = array_key_exists(strtoupper($field),$this->data)?$this->data[strtoupper($field)]:$default;
	}
	/**
	 * Creates a repeat if not an exception date returns 1 if successful
	 *
	 * @param unknown_type $start
	 * @param unknown_type $end
	 * @return unknown
	 */
	function _makeRepeat($start,$end){
		if (!isset($this->_repetitions)) $this->_repetitions = array();
		$db	=& JFactory::getDBO();
		$repeat = new iCalRepetition($db);
		$repeat->eventid = $this->eventid;
		// TODO CHECK THIS logic
		$repeat->startrepeat = strftime('%Y-%m-%d %H:%M:%S',$start);
		// iCal for whole day uses 00:00:00 on the next day JEvents uses 23:59:59 on the same day
		list ($h,$m,$s) = explode(":",strftime("%H:%M:%S",$end));
		if (($h+$m+$s)==0) {
//			$repeat->endrepeat = strftime('%Y-%m-%d 23:59:59',($end-86400));
			$repeat->endrepeat = strftime('%Y-%m-%d 23:59:59',$end);
		}
		else {
			$repeat->endrepeat = strftime('%Y-%m-%d %H:%M:%S',$end);
		}

		$repeat->duplicatecheck = md5($repeat->eventid . $start );

		// Double check its not in the list of exception dates
		foreach ($this->_exdate as $exdate) {
			if ($exdate == $start)	{
				return 0;
			}
		}
		$this->_repetitions[] = $repeat;
		return 1;
	}

	function _afterUntil($testDate){
		if (strlen($this->until)==0) return false;
		if (!isset($this->_untilMidnight)) {
			list ($d,$m,$y) = explode(":",strftime("%d:%m:%Y",$this->until));
			$this->_untilMidnight = mktime(23,59,59,$m,$d,$y);
		}
		if (strlen($this->until)>0 && $testDate>intval($this->_untilMidnight)) {
			return true;
		}
		else return false;
	}


	/**
	 * sort the by days string for negative values so that we start at the beginning of the month/start date
	 *
	 * @param unknown_type $days
	 * @param unknown_type $currentMonthStart
	 * @param unknown_type $dtstart
	 */
	function sortByDays(&$days,$currentMonthStart,$dtstart){
		if (count($days)==0) return;
		// only sort negative values
		if (strpos($days[0],"-")===false) return;

		static $weekdayMap=array("SU"=>0,"MO"=>1,"TU"=>2,"WE"=>3,"TH"=>4,"FR"=>5,"SA"=>6);
		static $weekdayReverseMap=array("SU","MO","TU","WE","TH","FR","SA");

		list ($currentMonth,$currentYear) = explode(":",strftime("%m:%Y",$currentMonthStart));
		list ($startMonth,$startYear) = explode(":",strftime("%m:%Y",$dtstart));
		if ($startMonth==$currentMonth && $startYear==$currentYear){
			$startdate = $dtstart;
		}
		else {
			$startdate = $currentMonthStart;
		}
		$startWD = strftime("%w",$startdate);

		$sorteddays = array();
		// start from week -6 and go forward (overkill I know)
		for ($w=-6;$w<0;$w++){
			// now loop over the week starting at the appropriate day fo the week
			for ($i=0;$i<7;$i++){
				$wd = ($startWD+$i)%7;
				$check = strval($w).$weekdayReverseMap[$wd];
				if (in_array($check,$days)) $sorteddays[]=$check;
			}
		}
		$days = $sorteddays;

	}

	/**
	 * Technically this is very complicated 
	 * see http://www.w3.org/2002/12/cal/rfc2445 ad search for "BYxxx rule parts modify the recurrence in some manner"
	 * 
	 * Priority to 'analysis' should therefore be (??)
	 * 
	 * FREQ=YEARLY
	 * BYMONTH
	 * BYWEEKNO
	 * BYYEARDAY
	 * FREQ=MONTHLY ??
	 * BYMONTHDAY
	 * FREQ=WEEKLY ??
	 * BYDAY
	 * FREQ=DAILY ??
	 * BYHOUR, BYMINUTE, BYSECOND
	 * BYSETPOS
	 * 
	 * INTERVAL always applies to FREQ
	 * 
	 * So if I go over step in freq units adding the BYMONTH to YEARLY etc.
	 * then restricting DAILY with BYMONTH (do an excessive loop in this situation and test if the rules hols
	 * until I get some better logic)
	 */


	/**
	 * Generates repetition from vevent & rrule data from scratch
	 * The result can then be saved to the database
	 */
	function getRepetitions($dtstart,$dtend,$duration,$recreate=false,$exdate=array()) {
		// put exdate into somewhere that I can get from _makerepeat
		$this->_exdate = $exdate;
		echo "getRepetitions doesnt yet deal with Short months and 31st or leap years/week 53<br/>";
		if ($dtend==0 && $duration>0){
			$dtend=$dtstart+$duration;
		}
		if (!$recreate && isset($this->_repetitions)) return $this->_repetitions;
		$this->_repetitions = array();
		if (!isset($this->eventid)) {
			echo "no eventid set in generateRepetitions<br/>";
			return $this->_repetitions;
		}

		if ($this->count==1){
			echo "count=1 returing<br/>";
			$this->_makeRepeat($dtstart,$dtend);
			return $this->_repetitions;
		}
		//list ($h,$min,$s,$d,$m,$y) = explode(":",strftime("%H:%M:%S:%d:%m:%Y",$end));

		list ($startHour,$startMin,$startSecond,$startDay,$startMonth,$startYear,$startWD)
		= explode(":",strftime("0%H:0%M:0%S:%d:%m:%Y:%w",$dtstart));
		echo "$startHour,$startMin,$startSecond,$startDay,$startMonth,$startYear,$startWD,$dtstart<br/>";
		$dtstartMidnight = mktime(0,0,0,$startMonth,$startDay,$startYear);
		list ($endDay,$endMonth,$endYear,$endWD) = explode(":",strftime("%d:%m:%Y:%w",$dtend));
		$duration = $dtend-$dtstart;
		static $weekdayMap=array("SU"=>0,"MO"=>1,"TU"=>2,"WE"=>3,"TH"=>4,"FR"=>5,"SA"=>6);
		static $weekdayReverseMap=array("SU","MO","TU","WE","TH","FR","SA");
		static $dailySecs = 86400;
		static $weeklySecs = 604800;
		// TODO implement byyearday
		// TODO do full leap year audit e.g. YEARLY repeats
		echo "freq = ".$this->freq."<br/>";
		switch ($this->freq) {
			case "YEARLY":
				// TODO the code doesn't yet deal with multiple bymonths
				if ($this->bymonth=="") $this->bymonth=$startMonth;
				//if ($this->byday=="") $this->byday=$weekdayReverseMap[$startWD];

				// If I have byday and bymonthday then the two considions must be met
				$weekdays = array();
				if ($this->byday!=""){
					foreach (explode(",",$this->byday) as $bday) {
						$weekdays[]=$weekdayMap[$bday];
					}
				}

				if ($this->byyearday!=""){
					echo "byyearday <br/>";
					$days = explode(",",$this->byyearday);

					$start = $dtstart;
					$end = $dtend;
					$countRepeats = 0;
					$currentYearStart = mktime(0,0,0,1,1,$startYear);
					// do the current month first
					while  ($countRepeats < $this->count  && !$this->_afterUntil($currentYearStart)) {
						$currentYear = strftime("%Y",$currentYearStart);
						$currentYearDays = date("L",$currentYearStart)?366:365;
						foreach ($days as $day) {
							if ($countRepeats >= $this->count || $this->_afterUntil($start)) return  $this->_repetitions;

							// TODO I am assuming all + or all -ve
							$details=array();
							preg_match("/(\+|-?)(\d*)/",$day,$details);
							list($temp,$plusminus,$daynumber) = $details;
							if (strlen($plusminus)==0) $plusminus="+";

							// do not go over year end
							if ($daynumber>$currentYearDays) continue;
							if ($plusminus=="+"){
								$targetStart = mktime($startHour,$startMin,$startSecond,12,31,$currentYear-1);
								$targetStart = strtotime("+$daynumber days",$targetStart);
							}
							else {
								$targetStart = mktime($startHour,$startMin,$startSecond,1,1,$currentYear+1);
								$targetStart = strtotime("-$daynumber days",$targetStart);
							}
							$targetEnd = $targetStart+$duration;
							if ($countRepeats >= $this->count) {
								return  $this->_repetitions;
							}
							if ($targetStart>=$dtstartMidnight && !$this->_afterUntil($targetStart)){
								// double check for byday constraints
								if ($this->byday!=""){
									if (!in_array(strftime("%w",$targetStart),$weekdays)){
										continue;
									}
								}
								$countRepeats+=$this->_makeRepeat($targetStart,$targetEnd);
							}
						}
						// now ago to the start of next year
						if ($currentYear+$this->rinterval>2036) return  $this->_repetitions;
						$currentYearStart = mktime(0,0,0,1,1,$currentYear+$this->rinterval);
					}

				}

				// assume for now that its an anniversary of the start month only!
				// TODO relzs this assumption !!
				else if ($this->bymonthday!="") {
					echo "bymonthday".$this->bymonthday." <br/>";
					$days = explode(",",$this->bymonthday);


					$start = $dtstart;
					$end = $dtend;
					$countRepeats = 0;

					$currentMonthStart = mktime(0,0,0,$startMonth,1,$startYear);
					// do the current month first
					while  ($countRepeats < $this->count  && !$this->_afterUntil($currentMonthStart)) {
						list ($currentMonth,$currentYear) = explode(":",strftime("%m:%Y",$currentMonthStart));
						$currentMonthDays = date("t",$currentMonthStart);
						foreach ($days as $day) {
							if ($countRepeats >= $this->count || $this->_afterUntil($start)) return  $this->_repetitions;

							// Assume no negative bymonthday values
							// TODO relax this assumption

							// do not go over month end
							if ($day>$currentMonthDays) continue;

							$targetStart = mktime($startHour,$startMin,$startSecond,$currentMonth,$day,$currentYear);
							$targetEnd = $targetStart+$duration;
							if ($countRepeats >= $this->count) {
								return  $this->_repetitions;
							}
							if ($targetStart>=$dtstartMidnight && !$this->_afterUntil($targetStart)){
								// double check for byday constraints
								if ($this->byday!=""){
									if (!in_array(strftime("%w",$targetStart),$weekdays)){
										continue;
									}
								}
								$countRepeats+=$this->_makeRepeat($targetStart,$targetEnd);
							}
						}
						// now ago to the start of next month
						if ($currentYear+$this->rinterval>2036) return  $this->_repetitions;
						$currentMonthStart = mktime(0,0,0,$currentMonth,1,$currentYear+$this->rinterval);
					}

				}
				// annual repeats of the start date - TODO check this
				else if ($this->byday=="") {
					$start = $dtstart;
					$end = $dtend;
					$countRepeats = 0;
					while ($countRepeats < $this->count && !$this->_afterUntil($start)) {
						$countRepeats+=$this->_makeRepeat($start,$end);

						$currentYear = strftime("%Y",$start);
						list ($h,$min,$s,$d,$m,$y) = explode(":",strftime("%H:%M:%S:%d:%m:%Y",$start));
						if (($currentYear+$this->rinterval)>=2037) break;
						$start = strtotime("+".$this->rinterval." years",$start);
						$end = strtotime("+".$this->rinterval." years",$end);
					}
				}
				else {
					$days = explode(",",$this->byday);
					$start = $dtstart;
					$end = $dtend;
					$countRepeats = 0;

					// do the current month first
					while  ($countRepeats < $this->count  && !$this->_afterUntil($start)) {
						$currentMonth = strftime("%m",$start);
						foreach ($days as $day) {
							if ($countRepeats >= $this->count || $this->_afterUntil($start)) {
								return  $this->_repetitions;
							}

							$details=array();
							preg_match("/(\+|-?)(\d?)(.+)/",$day,$details);
							if (count($details)!=4) {
								echo "<br/><br/><b>PROBLEMS with $day</b><br/><br/>";
								return  $this->_repetitions;
							}
							else {
								list($temp,$plusminus,$weeknumber,$dayname) = $details;
								if (strlen($plusminus)==0) $plusminus="+";
								if (strlen($weeknumber)==0) $weeknumber=1;

								// always check for dtstart (nothing is allowed earlier)
								if ($plusminus=="-") {
									//echo "count back $weeknumber weeks on $dayname<br/>";
									list ($startDay,$startMonth,$startYear,$startWD) = explode(":",strftime("%d:%m:%Y:%w",$start));
									$startLast = date("t",$start);
									$monthEnd = mktime(0,0,0,$startMonth,$startLast,$startYear);
									$meWD = strftime("%w",$monthEnd );
									$adjustment = $startLast - (7+$meWD-$weekdayMap[$dayname])%7;

									$targetstartDay = $adjustment - ($weeknumber-1)*7;
									$targetendDay = $targetstartDay + $endDay-$startDay;
									list ($h,$min,$s,$d,$m,$y) = explode(":",strftime("%H:%M:%S:%d:%m:%Y",$start));

									$testStart = mktime($h,$min,$s,$m,$targetstartDay,$y);
									if ($currentMonth==strftime("%m",$testStart)){
										$targetStart = $testStart;
										$targetEnd = $targetStart + $duration;
										if ($countRepeats >= $this->count) {
											return  $this->_repetitions;
										}
										if ($targetStart>=$dtstartMidnight && !$this->_afterUntil($targetStart)){
											$countRepeats+=$this->_makeRepeat($targetStart,$targetEnd);
										}
									}
								}
								else {
									//echo "count forward $weeknumber weeks on $dayname<br/>";
									list ($startDay,$startMonth,$startYear,$startWD) = explode(":",strftime("%d:%m:%Y:%w",$start));
									$monthStart = mktime(0,0,0,$startMonth,1,$startYear);
									$msWD = strftime("%w",$monthStart );
									$adjustment = 1 + (7+$weekdayMap[$dayname]-$msWD)%7;

									$targetstartDay = $adjustment+($weeknumber-1)*7;
									$targetendDay = $targetstartDay + $endDay-$startDay;
									list ($h,$min,$s,$d,$m,$y) = explode(":",strftime("%H:%M:%S:%d:%m:%Y",$start));

									$testStart = mktime($h,$min,$s,$m,$targetstartDay,$y);
									if ($currentMonth==strftime("%m",$testStart)){
										$targetStart = $testStart;
										$targetEnd = $targetStart + $duration;
										if ($countRepeats >= $this->count) {
											return  $this->_repetitions;
										}
										if ($targetStart>=$dtstartMidnight && !$this->_afterUntil($targetStart)){
											$countRepeats+=$this->_makeRepeat($targetStart,$targetEnd);
										}
									}
								}
							}
						}
						// now ago to the start of the next month
						$start = $targetStart;
						$end = $targetEnd;
						list ($h,$min,$s,$d,$m,$y) = explode(":",strftime("%H:%M:%S:%d:%m:%Y",$start));
						if (($y+$this->rinterval+$m/12)>2036) return  $this->_repetitions;
						$start = mktime($h,$min,$s,$m,1,$y+$this->rinterval);
						$end = $start + $duration;
					}

				}
				return $this->_repetitions;
				break;
			case "MONTHLY":
				if ($this->bymonthday=="" && $this->byday==""){
					$this->bymonthday=$startDay;
				}
				if ($this->bymonthday!="") {
					echo "bymonthday".$this->bymonthday." <br/>";
					// if not byday then by monthday
					$days = explode(",",$this->bymonthday);

					// If I have byday and bymonthday then the two considions must be met
					$weekdays = array();
					if ($this->byday!=""){
						foreach (explode(",",$this->byday) as $bday) {
							$weekdays[]=$weekdayMap[$bday];
						}
					}

					$start = $dtstart;
					$end = $dtend;
					$countRepeats = 0;
					$currentMonthStart = mktime(0,0,0,$startMonth,1,$startYear);

					// do the current month first
					while  ($countRepeats < $this->count  && !$this->_afterUntil($currentMonthStart)) {
						echo $countRepeats ." ".$this->count." ".$currentMonthStart."<br/>";
						list ($currentMonth,$currentYear) = explode(":",strftime("%m:%Y",$currentMonthStart));
						$currentMonthDays = date("t",$currentMonthStart);
						foreach ($days as $day) {
							if ($countRepeats >= $this->count || $this->_afterUntil($start)) return  $this->_repetitions;

							$details=array();
							preg_match("/(\+|-?)(\d+)/",$day,$details);
							if (count($details)!=3) {
								echo "<br/><br/><b>PROBLEMS with $day</b><br/><br/>";
								return  $this->_repetitions;
							}
							else {
								list($temp,$plusminus,$daynumber) = $details;
								if (strlen($plusminus)==0) $plusminus="+";
								if (strlen($daynumber)==0) $daynumber=$startDay;

								// always check for dtstart (nothing is allowed earlier)
								if ($plusminus=="-") {
									// must not go before start of month etc.
									if ($daynumber>$currentMonthDays) continue;

									echo "I need to check negative bymonth days <br/>";
									$targetStart = mktime($startHour,$startMin,$startSecond,$currentMonth,$currentMonthDays+1-$daynumber,$currentYear);
									$targetEnd = $targetStart+$duration;
									if ($countRepeats >= $this->count) {
										return  $this->_repetitions;
									}
									if ($targetStart>=$dtstartMidnight && !$this->_afterUntil($targetStart)){
										$countRepeats+=$this->_makeRepeat($targetStart,$targetEnd);
									}
								}
								else {
									echo "$daynumber $currentMonthDays bd=".$this->byday." <br/>";
									// must not go over end month etc.
									if ($daynumber>$currentMonthDays) continue;
									echo "$startHour,$startMin,$startSecond,$currentMonth,$daynumber,$currentYear<br/>";
									$targetStart = mktime($startHour,$startMin,$startSecond,$currentMonth,$daynumber,$currentYear);
									$targetEnd = $targetStart+$duration;
									echo "$targetStart $targetEnd $dtstartMidnight<br/>";
									if ($countRepeats >= $this->count) {
										return  $this->_repetitions;
									}
									if ($targetStart>=$dtstartMidnight && !$this->_afterUntil($targetStart)){
										// double check for byday constraints
										if ($this->byday!=""){
											if (!in_array(strftime("%w",$targetStart),$weekdays)){
												continue;
											}
										}
										$countRepeats+=$this->_makeRepeat($targetStart,$targetEnd);
										echo "countrepeats = $countRepeats<br/>";
									}
								}
							}
						}
						// now ago to the start of next month
						if (($currentYear+($currentMonth+$this->rinterval)/12)>2036) return  $this->_repetitions;
						$currentMonthStart = mktime(0,0,0,$currentMonth+$this->rinterval,1,$currentYear);
					}

				}
				// This is byday
				else {
					$days = explode(",",$this->byday);
					// TODO I should also iterate over week number if this is used
					//$weeknumbers = explode(",",$this->byweekno);

					$start = $dtstart;
					$end = $dtend;
					$countRepeats = 0;
					$currentMonthStart = mktime(0,0,0,$startMonth,1,$startYear);

					// do the current month first
					while  ($countRepeats < $this->count  && !$this->_afterUntil($currentMonthStart)) {
						list ($currentMonth,$currentYear,$currentMonthStartWD) = explode(":",strftime("%m:%Y:%w",$currentMonthStart));
						$currentMonthDays = date("t",$currentMonthStart);
						$this->sortByDays($days,$currentMonthStart,$dtstart);

						foreach ($days as $day) {
							if ($countRepeats >= $this->count || $this->_afterUntil($start)) {
								return  $this->_repetitions;
							}

							$details=array();
							preg_match("/(\+|-?)(\d?)(.+)/",$day,$details);
							if (count($details)!=4) {
								echo "<br/><br/><b>PROBLEMS with $day</b><br/><br/>";
								return  $this->_repetitions;
							}
							else {
								list($temp,$plusminus,$weeknumber,$dayname) = $details;
								if (strlen($plusminus)==0) $plusminus="+";
								if (strlen($weeknumber)==0) $weeknumber=1;

								$multiplier = $plusminus=="+"?1:-1;
								// always check for dtstart (nothing is allowed earlier)
								if ($plusminus=="-") {
									//echo "count back $weeknumber weeks on $dayname<br/>";
									$startLast = date("t",$currentMonthStart);
									$currentMonthEndWD = ($startLast - 1 + $currentMonthStartWD)%7;

									$adjustment = $startLast - (7+$currentMonthEndWD-$weekdayMap[$dayname])%7;

									$targetstartDay = $adjustment - ($weeknumber-1)*7;
								}
								else {
									//echo "count forward $weeknumber weeks on $dayname<br/>";
									$adjustment = 1 + (7+$weekdayMap[$dayname]-$currentMonthStartWD)%7;

									$targetstartDay = $adjustment+($weeknumber-1)*7;

								}
								$targetStart = mktime($startHour,$startMin,$startSecond,$currentMonth,$targetstartDay,$currentYear);

								if ($currentMonth==strftime("%m",$targetStart)){
									$targetEnd = $targetStart + $duration;
									if ($countRepeats >= $this->count) {
										return  $this->_repetitions;
									}
									if ($targetStart>=$dtstartMidnight && !$this->_afterUntil($targetStart)){
										$countRepeats+=$this->_makeRepeat($targetStart,$targetEnd);
									}
								}

							}
						}
						// now go to the start of next month
						if (($currentYear+($currentMonth+$this->rinterval)/12)>2036) return  $this->_repetitions;
						$currentMonthStart = mktime(0,0,0,$currentMonth+$this->rinterval,1,$currentYear);
					}
				}
				return  $this->_repetitions;

				break;
			case "WEEKLY":
				$days = explode(",",$this->byday);
				$start = $dtstart;
				$end = $dtend;
				$countRepeats = 0;
				$currentWeekDay = strftime("%w",$start);
				// Go to the zero day of the first week (even if this is in the past)
				// this will be the base from which we count the weeks and weekdays
				$currentWeekStart = strtotime("-$currentWeekDay days",$start);

				while  ($countRepeats < $this->count  && !$this->_afterUntil($currentWeekStart)) {
					list ($currentDay,$currentMonth,$currentYear) = explode(":",strftime("%d:%m:%Y",$currentWeekStart));

					foreach ($days as $day) {
						if ($countRepeats >= $this->count || $this->_afterUntil($start)) {
							return  $this->_repetitions;
						}
						$details=array();
						preg_match("/(\+|-?)(\d?)(.+)/",$day,$details);
						if (count($details)!=4) {
							echo "<br/><br/><b>PROBLEMS with $day</b><br/><br/>";
							return  $this->_repetitions;
						}
						else {
							list($temp,$plusminus,$daynumber,$dayname) = $details;
							if (strlen($plusminus)==0) $plusminus="+";
							// this is not relevant for weekly recurrence ?!?!?
							//if (strlen($daynumber)==0) $daynumber=1;
							$multiplier = $plusminus=="+"?1:-1;
							if ($plusminus=="-") {
								// TODO find out if I ever have this situation?
								// It would seem meaningless
							}
							else {
								//echo "count forward $daynumber days on $dayname<br/>";
								$targetstartDay = $currentDay+$weekdayMap[$dayname];
							}

							$targetStart = mktime($startHour,$startMin,$startSecond,$currentMonth,$targetstartDay,$currentYear);

							$targetEnd = $targetStart + $duration;
							if ($countRepeats >= $this->count) {
								return  $this->_repetitions;
							}
							if ($targetStart>=$dtstartMidnight && !$this->_afterUntil($targetStart)){
								$countRepeats+=$this->_makeRepeat($targetStart,$targetEnd);
							}

						}
					}

					// now go to the start of next week
					if ($currentYear+($currentMonth/12)>2036) return  $this->_repetitions;
					$currentWeekStart = strtotime("+".($this->rinterval)." weeks",$currentWeekStart);

				}
				return $this->_repetitions;
				break;
			case "DAILY":
				$start = $dtstart;
				$end = $dtend;
				$countRepeats = 0;

				$startYear = strftime("%Y",$start);
				while ($startYear<2027 && $countRepeats < $this->count && !$this->_afterUntil($start)) {
					$countRepeats+=$this->_makeRepeat($start,$end);
					$start = strtotime("+".$this->rinterval." days",$start);
					$end = strtotime("+".$this->rinterval." days",$end);
					$startYear = strftime("%Y",$start);
				}
				return $this->_repetitions;
				break;
			default:
				echo "UNKNOWN TYPE<br/>";
				return $this->_repetitions;
				break;
		}
	}

	function dumpData(){
		echo "Freq : $this->freq <br/>";
		echo "Interval : ".$this->data['INTERVAL']."<br/>";
		switch ($this->freq) {
			case "YEARLY":
				echo "By Month : ".$this->data['BYMONTH']."<br/>";
				break;
			case "MONTHLY":
				echo "By Day : ".$this->data['BYDAY']."<br/>";
				$days = explode(",",$this->data['BYDAY']);
				foreach ($days as $day) {
					$details=array();
					preg_match("/(\+|-?)(\d?)(.+)/",$day,$details);
					if (count($details)!=4) echo "<br/><br/><b>PROBLEMS with $day</b><br/><br/>";
					else {
						if (strlen($details[1])==0) $details[1]="+";
						echo "Event repeat details<br/>";
						if ($details[1]=="-") echo "count back $details[2] weeks on $details[3]<br/>";
						else echo "count forward $details[2] weeks on $details[3]<br/>";

						// Note if no number given then EVERY specified day!!
					}
				}
				break;
			case "WEEKLY":
				echo "By Day : ".$this->data['BYDAY']."<br/>";
				$days = explode(",",$this->data['BYDAY']);
				foreach ($days as $day) {
					$details=array();
					preg_match("/(\+|-?)(\d?)(.+)/",$day,$details);
					if (count($details)!=4) echo "<br/><br/><b>PROBLEMS with $day</b><br/><br/>";
					else {
						if (strlen($details[1])==0) $details[1]="+";
						echo "Event repeat details<br/>";
						if ($details[1]=="-") echo "count back $details[2] weeks on $details[3]<br/>";
						else echo "count forward $details[2] weeks on $details[3]<br/>";

						// Note if no number given then EVERY specified day!!
					}
				}
				break;
			default:
				echo "UNKNOWN TYPE<br/>";
				break;
		}

		// Doesnt yet deal with INTERVAL, UNTIL or COUNT
		print_r($this->data);
		echo "<hr/>";
	}

	function checkDate($test, $start, $end){
		if ($test>=$start && $test<=$end) return true;
		else return false;
	}

	function eventInPeriod($startDate,$endDate, $start, $end){
		// stupid verison to start that scans through EVERY single day!!!
		$checkDate = $startDate;
		while ($checkDate<=$endDate){
			if ($this->checkDate($checkDate,$start,$end)) return true;
			$checkDate+=24*60*60;
		}
		return false;
	}

	function isDuplicate(){
		$sql = "SELECT rr_id from #__jevents_rrule as rr WHERE rr.eventid = '".$this->eventid."'";
		$this->_db->setQuery($sql);
		$matches = $this->_db->loadObjectList();
		if (count($matches)>0 && isset($matches[0]->rr_id)) {
			return $matches[0]->rr_id;
		}
		return false;
	}
}


class iCalEvent extends JTable  {

	/** @var int Primary key */
	var $ev_id					= null;

	/**
	 * This holds the raw data as an array 
	 *
	 * @var array
	 */
	var $data;
	var $rrule = null;

	var $_detail;
	var $vevent;

	var $_start = null;
	var $_end = null;

	// array of exception date via EXDATE tag
	var $_exdate = array();

	// default values
	//var $rinterval = 1;
	//var $freq = "DAILY";
	//var $description = "";
	//var $summary = "";
	//var $dtstart="";
	//var $dtend="";

	/**
	 * Null Constructor
	 */
	function iCalEvent( &$db ) {
		parent::__construct( '#__jevents_vevent', 'ev_id', $db );
	}

	/**
	 * override store function to force rrule to save too!
	 *
	 * @param unknown_type $updateNulls
	 */
	function store($updateNulls=false ) {
		// TODO need to get existing row to see if
		$user =& JFactory::getUser();

		$this->created_by		= $user->id;
		$this->modified_by		= $user->id;
		$this->created_by_alias	= "";

		// make sure I update existing detail
		$matchingDetail = $this->matchingEventDetails();
		if (isset($matchingDetail) && isset($matchingDetail->evdet_id)){
			$this->_detail->evdet_id = $matchingDetail->evdet_id;
		}
		$detailid = $this->_detail->store($updateNulls);
		if (!$detailid){
			echo "problems<br/>";
			return false;
		}
		$this->detail_id = $detailid;
		parent::store($updateNulls);
		if (isset($this->rrule)) {
			$this->rrule->eventid = $this->ev_id;
			if($id = $this->rrule->isDuplicate()){
				$this->rrule->rr_id = $id;
			}
			$this->rrule->store($updateNulls);
		}
	}

	function isDuplicate(){
		$sql = "SELECT ev_id from #__jevents_vevent as vev WHERE vev.uid = '".$this->uid."'";
		$this->_db->setQuery($sql);
		$matches = $this->_db->loadObjectList();
		if (count($matches)>0 && isset($matches[0]->ev_id)) {
			return $matches[0]->ev_id;
		}
		return false;
	}

	function matchingEventDetails(){
		$sql = "SELECT *  from #__jevents_vevent as vev,#__jevents_vevdetail as det"
		."\n WHERE vev.uid = '".$this->uid."'"
		."\n AND vev.detail_id = det.evdet_id";
		$this->_db->setQuery($sql);
		$matches = $this->_db->loadObjectList();
		if (count($matches)>0 && isset($matches[0]->ev_id)) {
			return $matches[0];
		}
		return false;
	}

	/**
	 * Pseudo Constructor
	 *
	 * @param iCal Event parsed from ICS file as an array $ice
	 * @return n/a
	 */
	function iCalEventFromData($ice){
		$db	=& JFactory::getDBO();
		$temp = new iCalEvent($db);
		$temp->data = $ice;
		if (array_key_exists("RRULE",$temp->data)){
			$temp->rrule =iCalRRule::iCalRRuleFromData($temp->data['RRULE']);
		}
		$temp->convertData();
		$temp->setupEventDetail();
		//		$temp->map_iCal_to_Jevents();
		return $temp;
		//print_r($this->data);
	}

	/**
	 * Pseudo Constructor
	 *
	 * @param iCal Event parsed from ICS file as an array $ice
	 * @return n/a
	 */
	function iCalEventFromDB($icalrowAsArray){
		$db	=& JFactory::getDBO();
		$temp = new iCalEvent($db);
		foreach ($icalrowAsArray as $key=>$val) {
			$temp->$key = $val;
		}
		if ($temp->freq!=""){
			$temp->rrule = iCalRRule::iCalRRuleFromDB($icalrowAsArray);
		}
		$temp->setupEventDetailFromDB($icalrowAsArray);
		return $temp;
	}

	/**
	 * private function
	 *
	 * @param string $field
	 */
	function processField($field,$default){
		$targetfield = str_replace("-","_",$field);
		$this->$targetfield = array_key_exists(strtoupper($field),$this->data)?$this->data[strtoupper($field)]:$default;
	}
	/**
	 * Converts $data into class values 
	 *
	 */
	function convertData(){
		$this->processField("uid",0);
		$this->rawdata = serialize($this->data);
		//$this->processField("catid","");

		/* most of this now goes in the eventdetail
		$this->processField("dtstart",0);
		$this->processField("dtstartraw","");
		$this->processField("duration",0);
		$this->processField("durationraw","");
		$this->processField("dtend",0);
		$this->processField("dtendraw","");
		$this->processField("dtstamp","");
		$this->processField("class","");
		$this->processField("categories","");
		$this->processField("description","");
		$this->processField("geolon","");
		$this->processField("geolat","");
		$this->processField("location","");
		$this->processField("priority","");
		$this->processField("status","");
		$this->processField("summary","");
		$this->processField("contact","");
		$this->processField("organizer","");
		$this->processField("url","");
		$this->processField("created","");
		$this->processField("sequence","");
		*/
		$this->processField("recurrence-id","");
		/*

		if (isset($this->rrule)) $this->trueend = $this->rrule->trueEndDate($this->dtend);
		else $this->trueend = $this->dtend;
		*/

		if (array_key_exists("EXDATE",$this->data) && count($this->data["EXDATE"])>0){
			$this->_exdate= $this->data["EXDATE"];
		}
	}


	/**
	 * Create and setup event detail
	 *
	 * @param data array
	 */
	function setupEventDetail() {
		//if ($this->recurrence_id==""){
		$this->_detail = iCalEventDetail::iCalEventDetailFromData($this->data);
		/*
}
else $this->_detail = false;
*/
	}

	function setupEventDetailFromDB($icalrowAsArray) {
		//if ($this->recurrence_id==""){
		$this->_detail = iCalEventDetail::iCalEventDetailFromDB($icalrowAsArray);
		/*
}
else $this->_detail = false;
*/
	}

	function hasRepetition() {
		return isset($this->rrule);
	}

	/**
	 * Generates repetition from vevent & rrule data from scratch
	 * The result can then be saved to the database
	 */
	function getRepetitions($recreate=false) {
		if (!$recreate && isset($this->_repetitions)) return $this->_repetitions;
		$this->_repetitions = array();
		if (!isset($this->ev_id)) {
			echo "no id set in generateRepetitions<br/>";
			return $this->_repetitions;
		}
		// if no rrule then only one instance
		if (!isset($this->rrule)){
			$db	=& JFactory::getDBO();
			$repeat = new iCalRepetition($db);
			$repeat->eventid = $this->ev_id;
			$repeat->startrepeat = strftime('%Y-%m-%d %H:%M:%S',$this->_detail->dtstart);
			$repeat->endrepeat = strftime('%Y-%m-%d %H:%M:%S',$this->_detail->dtend);
			$repeat->duplicatecheck = md5($repeat->eventid . $this->_detail->dtstart);
			$this->_repetitions[] = $repeat;
			return $this->_repetitions;
		}
		else {
			$this->_repetitions = $this->rrule->getRepetitions($this->_detail->dtstart,$this->_detail->dtend,$this->_detail->duration, $recreate,$this->_exdate);
			return $this->_repetitions;
		}
	}

	/**
	 * function that removed cancelled instances from repetitions table
	 *
	 */
	function cancelRepetition() {
		// TODO - rather than deleting the repetition I should save the new detail and report it as cancelled
		// this would make subsequent export easier
		$eventid = $this->ev_id;
		$start = iCalImport::unixTime($this->recurrence_id);

		// TODO CHECK THIS logic - an make it more abstract since a few functions do the same !!!

		// TODO if I implement this outsite of upload I need to clean the detail table too
		$duplicatecheck = md5($eventid . $start);
		$db	=& JFactory::getDBO();
		$sql = "DELETE FROM #__jevents_repetition WHERE duplicatecheck='".$duplicatecheck."'";
		$db->setQuery($sql);
		return $db->query();
	}

	/**
	 * function that adjusts instances in the repetitions table
	 *
	 */
	function adjustRepetition($matchingEvent){
		$eventid = $this->ev_id;
		$start = iCalImport::unixTime($this->recurrence_id);
		$duplicatecheck = md5($eventid . $start );

		// find the existing repetition in order to get the detailid
		$db	=& JFactory::getDBO();
		$sql = "SELECT * FROM #__jevents_repetition WHERE duplicatecheck='$duplicatecheck'";
		$db->setQuery($sql);
		$matchingRepetition=$db->loadObject();
		if (!isset($matchingRepetition)) {
			return false;
		}
		// I now create a new evdetail instance
		$newDetail = iCalEventDetail::iCalEventDetailFromData($this->data);
		if (isset($matchingRepetition) && isset($matchingRepetition->eventdetail_id)){
			// This traps the first time through since the 'global id has not been overwritten
			if ($matchingEvent->detail_id!=$matchingRepetition->eventdetail_id){
				//$newDetail->evdet_id = $matchingRepetition->eventdetail_id;
			}
		}
		if (!$newDetail->store()){
			return false;
		}

		// clumsy - add in the new version with the correct times (does not deal with modified descriptions and sequence)
		$start= strftime('%Y-%m-%d %H:%M:%S',$newDetail->dtstart);
		if ($newDetail->dtend!=0){
			$end = $newDetail->dtend;
		}
		else {
			$end = $start + $newDetail->duration;
		}
		// iCal for whole day uses 00:00:00 on the next day JEvents uses 23:59:59 on the same day
		list ($h,$m,$s) = explode(":",strftime("%H:%M:%S",$end));
		if (($h+$m+$s)==0) {
			$end = strftime('%Y-%m-%d 23:59:59',($end-86400));
		}
		else {
			$end = strftime('%Y-%m-%d %H:%M:%S',$end);
		}

		$duplicatecheck = md5($eventid . $start );
		$db	=& JFactory::getDBO();
		$sql = "UPDATE #__jevents_repetition SET eventdetail_id=".$newDetail->evdet_id
		.", startrepeat='".$start."'"
		.", endrepeat='".$end."'"
		.", duplicatecheck='".$duplicatecheck."'"
		." WHERE rp_id=".$matchingRepetition->rp_id;
		$db->setQuery($sql);
		return $db->query();

	}

	function storeRepetitions() {
		if (!isset($this->_repetitions)) $this->getRepetitions(true);
		if (count($this->_repetitions)==0) return false;
		$db	=& JFactory::getDBO();
		// I must delete the eventdetails for repetitions not matching the global event detail
		// these will be recreated later to match the new adjusted repetitions

		$sql = "SELECT evdet_id FROM #__jevents_vevdetail as detail"
		."\n LEFT JOIN #__jevents_repetition as rpt ON rpt.eventdetail_id=detail.evdet_id"
		."\n WHERE eventid=".$this->ev_id
		."\n AND rpt.eventdetail_id != ".$this->_detail->evdet_id;
		$db->setQuery($sql);
		$ids = $db->loadResultArray();
		if (count($ids)>0){
			$idlist = implode(",",$ids);
			$sql = "DELETE FROM #__jevents_vevdetail  WHERE evdet_id IN(".$idlist.")";
			$db->setQuery($sql);
			$db->query();
		}

		// First I delete all existing repetitions - I can't do an update or replace
		// since the repeat may have been= adjusted
		$sql = "DELETE FROM #__jevents_repetition  WHERE eventid=".$this->ev_id;
		$db->setQuery($sql);
		$db->query();

		/*
		SELECT * FROM jos_jevents_vevdetail as detail ,jos_jevents_repetition as rpt, jos_jevents_vevent as event
		WHERE eventid=1
		AND rpt.eventdetail_id=detail.evdet_id
		AND rpt.eventid = event.ev_id
		AND rpt.eventdetail_id != detail.evdet_id
		*/

		$sql = "REPLACE INTO #__jevents_repetition (eventid,eventdetail_id,startrepeat,endrepeat,duplicatecheck) VALUES ";
		for ($r = 0;$r<count($this->_repetitions);$r++){
			$repeat = $this->_repetitions[$r];
			if (!isset($repeat->duplicatecheck)){
				echo "fred";
			}
			// for now use the 'global' detail id - I really should override this
			$sql .= "\n ($repeat->eventid,'".$this->detail_id."','".$repeat->startrepeat."','".$repeat->endrepeat."','".$repeat->duplicatecheck."')";
			if ($r+1 < count($this->_repetitions)) $sql .= ",";
		}
		$db->setQuery($sql);
		return $db->query();
	}

	function eventOnDate($testDate){
		if (!isset($this->_start)){
			$this->_start = mktime(0,0,0,$this->mup,$this->dup,$this->yup);
			$this->_end = mktime(0,0,0,$this->mup,$this->dup,$this->yup);
		}
		if (!isset($this->rrule)){
			if ($this->_start<=$testDate && $this->_end>=$testDate){
				return true;
			}
			else return false;
		}
		else {
			if (isset($this->rrule)) {
				//				if ($testDate>$this->trueend) return false;
				return $this->rrule->checkDate($testDate, $this->_start,$this->_end);
			}
		}
		return false;

	}

	function eventInPeriod($startDate,$endDate){
		if (!isset($this->_start)){
			$this->_start = mktime(0,0,0,$this->mup,$this->dup,$this->yup);
			$this->_end = mktime(0,0,0,$this->mdn,$this->ddn,$this->ydn);
		}
		if (!isset($this->rrule)){
			if ($this->_start<=$endDate && $this->_end>=$startDate){
				return true;
			}
			else return false;
		}
		else {
			if (isset($this->rrule)) {
				return $this->rrule->eventInPeriod($startDate,$endDate, $this->_start,$this->_end);
			}
		}
		return false;

	}

	function isCancelled() {
		if ($this->_detail){
			return $this->_detail->isCancelled();
		}
		return false;
	}

	function isRecurrence() {
		return $this->recurrence_id!="";
	}

	/**
	 * Utility function since DTEND really only tells me the end time in repeated events
	 *
	 */
	/*
	function getEndDate(){
	if (isset($this->rrule)) {
	return $this->rrule->getEndDate($this->dtstart,$this->dtend);
	}
	else return $this->dtend;
	}
	*/

	function dumpData(){
		echo "starting : ".$this->dtstart."<br/>";
		echo "ending : ".$this->dtend."<br/>";
		if (isset($this->rrule)){
			$this->rrule->dumpData();
		}
		print_r($this->data);
		echo "<hr/>";
	}
}

class iCalEventDetail extends JTable  {

	/** @var int Primary key */
	var $evdet_id					= null;

	/**
	 * This holds the raw data as an array 
	 *
	 * @var array
	 */
	var $data;

	/**
	 * Null Constructor
	 */
	function iCalEventDetail( &$db ) {
		parent::__construct( '#__jevents_vevdetail', 'evdet_id', $db );
	}

	/**
	 * override store function to force rrule to save too!
	 *
	 * @param unknown_type $updateNulls
	 */
	function store($updateNulls=false ) {
		parent::store($updateNulls);
		return $this->evdet_id;
	}

	/**
	 * Pseudo Constructor
	 *
	 * @param iCal Event parsed from ICS file as an array $ice
	 * @return n/a
	 */
	function iCalEventDetailFromData($ice){
		$db	=& JFactory::getDBO();
		$temp = new iCalEventDetail($db);
		$temp->data = $ice;
		$temp->convertData();
		return $temp;
	}

	/**
	 * Pseudo Constructor
	 *
	 * @param iCal Event parsed from ICS file as an array $ice
	 * @return n/a
	 */
	function iCalEventDetailFromDB($icalrowAsArray){
		$db	=& JFactory::getDBO();
		$temp = new iCalEventDetail($db);
		$temp->data = $icalrowAsArray;
		$temp->convertData();
		return $temp;
	}

	/**
	 * private function
	 *
	 * @param string $field
	 */
	function processField($field,$default,$targetFieldName=""){
		if ($targetFieldName==""){
			$targetfield = str_replace("-","_",$field);
		}
		else {
			$targetfield = $targetFieldName;
		}
		$this->$targetfield = array_key_exists(strtoupper($field),$this->data)?$this->data[strtoupper($field)]:$default;
	}
	/**
	 * Converts $data into class values 
	 *
	 */
	function convertData(){
		$this->rawdata = serialize($this->data);

		$this->processField("dtstart",0);
		$this->processField("dtstartraw","");
		$this->processField("duration",0);
		$this->processField("durationraw","");
		$this->processField("dtend",0);
		$this->processField("dtendraw","");
		$this->processField("dtstamp","");
		$this->processField("class","");
		$this->processField("categories","");
		$this->processField("description","");
		$this->processField("geolon","");
		$this->processField("geolat","");
		$this->processField("location","");
		$this->processField("priority","");
		$this->processField("status","");
		$this->processField("summary","");
		$this->processField("contact","");
		$this->processField("organizer","");
		$this->processField("url","");
		$this->processField("created","");
		$this->processField("sequence","");

		$this->processField("x-extrainfo","", "extra_info");

		// To make DB searches easier I set the dtend regardless
		if ($this->dtend==0 && $this->duration>0){
			$this->dtend=$this->dtstart+$this->duration;
		}
	}

	function isCancelled() {
		return $this->status=="CANCELLED";
	}

	function dumpData(){
		echo "starting : ".$this->dtstart."<br/>";
		echo "ending : ".$this->dtend."<br/>";
		if (isset($this->rrule)){
			$this->rrule->dumpData();
		}
		print_r($this->data);
		echo "<hr/>";
	}
}



class iCalICSFile extends JTable  {

	/** @var int Primary key */
	var $ics_id					= null;
	var $filename = "";
	var $srcURL = "";
	var $state = 1;
	var $access = 0;
	var $catid = 0;
	var $label ="";
	var $created;
	var $refreshed;

	/**
	 * This holds the raw data as an array 
	 *
	 * @var array
	 */
	var $data;
	var $rrule = null;

	var $vevent;

	/**
	 * Null Constructor
	 */
	function iCalICSFile( &$db ) {
		parent::__construct( '#__jevents_icsfile', 'ics_id', $db );
	}

	function _setup($icsid,$catid,$access=0,$state=1){
		if ($icsid>0) $this->ics_id = $icsid;
		$this->created = date( 'Y-m-d H:i:s' );
		$this->refreshed = $this->created;
		$this->catid = $catid;
		$this->access = $access;
		$this->state = $state;
	}

	function editICalendar($icsid,$catid,$access=0,$state=1, $label=""){
		$db	=& JFactory::getDBO();
		$temp = new iCalICSFile($db);
		$temp->_setup($icsid,$catid,$access,$state);
		$temp->filename="_from_scratch_";
		$temp->icaltype=2;
		$temp->label = $label;
		$temp->srcURL ="";

		$rawText = <<<RAWTEXT
BEGIN:VCALENDAR
PRODID:-//JEvents Project//JEvents Calendar 1.5.0//EN
VERSION:2.0
CALSCALE:GREGORIAN
METHOD:PUBLISH
X-WR-CALNAME:$label
X-WR-TIMEZONE:Europe/London
BEGIN:VTIMEZONE
TZID:Europe/London
X-LIC-LOCATION:Europe/London
BEGIN:DAYLIGHT
TZOFFSETFROM:+0000
TZOFFSETTO:+0100
TZNAME:BST
DTSTART:19700329T010000
RRULE:FREQ=YEARLY;BYMONTH=3;BYDAY=-1SU
END:DAYLIGHT
BEGIN:STANDARD
TZOFFSETFROM:+0100
TZOFFSETTO:+0000
TZNAME:GMT
DTSTART:19701025T020000
RRULE:FREQ=YEARLY;BYMONTH=10;BYDAY=-1SU
END:STANDARD
END:VTIMEZONE
END:VCALENDAR
		
RAWTEXT;
		$temp->_icalInfo =& EventsHelper::iCalInstance("", $rawText);
		return $temp;
	}

	function newICSFileFromURL($uploadURL,$icsid,$catid,$access=0,$state=1, $label=""){
		$db	=& JFactory::getDBO();
		$temp = new iCalICSFile($db);
		$temp->_setup($icsid,$catid,$access,$state);

		$urlParts = parse_url($uploadURL);
		$pathParts = pathinfo($urlParts['path']);
		/*
		if (isset($pathParts['basename'])) $temp->filename =  $pathParts['basename'];
		else $temp->filename = $uploadURL;
		*/
		$temp->filename = md5($uploadURL);
		$temp->icaltype=0;  // i.e. from URL

		if ($label!="") $temp->label = $label;
		else $temp->label = $temp->filename;

		$temp->srcURL =  $uploadURL;

		$temp->_icalInfo =& EventsHelper::iCalInstance($uploadURL);

		return $temp;
	}

	function newICSFileFromFile($file,$icsid,$catid,$access=0,$state=1, $label=""){
		$db	=& JFactory::getDBO();
		$temp = new iCalICSFile($db);
		$temp->_setup($icsid,$catid,$access,$state);
		$temp->srcURL = "";
		$temp->filename = $file['name'];
		$temp->icaltype=1;  // i.e. from file

		if ($label!="") $temp->label = $label;
		else $temp->label = $temp->filename;

		$temp->_icalInfo =& EventsHelper::iCalInstance($file['tmp_name']);

		return $temp;
	}

	/**
	 * Used to create Ical from raw strring
	 */
	function newICSFileFromString($rawtext,$icsid,$catid,$access=0,$state=1, $label=""){
		$db	=& JFactory::getDBO();
		$temp = new iCalICSFile($db);
		$temp->_setup($icsid,$catid,$access,$state);
		$temp->srcURL = "";
		$temp->filename = "_from_events_cat".$catid;
		$temp->icaltype=2;  // i.e. from file

		if ($label!="") $temp->label = $label;
		else $temp->label = $temp->filename;

		$temp->_icalInfo =& EventsHelper::iCalInstance("",$rawtext);

		return $temp;
	}

	/**
	 * Method that updates details about the ical but does not touch the events contained
	 *
	 */
	function updateDetails(){
		return parent::store($updateNulls);
	}

	/**
	 * override store function to return id to pass to iCalEvent and store the events too!
	 *
	 * @param unknown_type $updateNulls
	 */
	function store($updateNulls=false ) {
		if ($id = $this->isDuplicate()){
			$this->ics_id = $id;
			// TODO return warning about duplicate file name  VERY IMPORTANT TO DECIDE WHAT TO DO
			// UIDs for the vcalendar itself are not compulsory
		}
		// There is a better way to find
		// duplicate key info trap repeated insertions - I should
		if (!parent::store($updateNulls)){
			echo "failed to store icsFile<br/>";
		}

		// insert the data - this will need to deal with multiple rrule values
		foreach ($this->_icalInfo->vevents as $vevent) {
			if (!$vevent->isCancelled() && !$vevent->isRecurrence()){
				$vevent->catid = $this->catid;
				$vevent->access = $this->access;
				$vevent->state =  $this->state;
				$vevent->icsid = $this->ics_id;
				// The refreshed field is used to track dropped events on reload
				$vevent->refreshed = $this->refreshed;
				// make sure I don't add the same events more than once
				if ($matchingEvent = $vevent->matchingEventDetails()){
					$vevent->ev_id = $matchingEvent->ev_id;
					$vevent->_detail->evdet_id = $matchingEvent->evdet_id;
				}
				$vevent->store();

				$repetitions = $vevent->getRepetitions(true);
				$vevent->storeRepetitions();
			}
		}

		// Having stored all the repetitions - remove the cancelled instances
		// this should be done as a batch but for now I'll do them one at a time
		foreach ($this->_icalInfo->vevents as $vevent) {
			if ($vevent->isCancelled() || $vevent->isRecurrence()){
				$vevent->catid = $this->catid;
				$vevent->access = $this->access;
				$vevent->state =  $this->state;
				$vevent->icsid = $this->ics_id;
				// make sure I don't add the same events more than once
				if ($matchingEvent = $vevent->matchingEventDetails()){
					$vevent->ev_id = $matchingEvent->ev_id;
				}
				if ($vevent->isCancelled()) {
					$vevent->cancelRepetition();
				}
				else {
					// replace event that is only 'adjusted' with the correct settings
					$vevent->adjustRepetition($matchingEvent);
				}
			}
		}
	}

	// find if icsFile already imported
	function isDuplicate(){
		$sql = "SELECT ics_id from #__jevents_icsfile as ics WHERE ics.label = '".$this->label."'";
		$this->_db->setQuery($sql);
		$matches = $this->_db->loadObjectList();
		if (count($matches)>0 && isset($matches[0]->ics_id)) {
			return $matches[0]->ics_id;
		}
		return false;

	}
}

// This class is probably redudant
class iCalHelper {

	// TODO remove redundant code - keep it for now in caes we need it
	/*
	function getHolidayDataForMonth($year, $month, $holidayFile){

	iCalHelper::getRepetitions($holidayFile);
	$holidays = array();
	// This logic is backward - I should go through the evnets lloking for the days on which they occur
	for( $day = 1; $day <= date( 't', mktime( 0, 0, 0,( $month + 1 ), 0, $year )); $day++ ){
	$hols=iCalHelper::getVEventsByDate($year, $month, $day, $holidayFile);
	if (count($hols)>0){
	$holidays = array_merge($holidays,$hols);
	}
	}
	return $holidays;
	}

	function getHolidayDataForMonthBACKUP(&$data, $year, $month, $holidayFile){
	iCalHelper::getRepetitions($holidayFile);

	for( $day = 1; $day <= date( 't', mktime( 0, 0, 0,( $month + 1 ), 0, $year )); $day++ ){
	// set 1 second after midnight to deal with holiday files from midnight - midnight inclusive!
	$hols = iCalHelper::getVEventsByDate($year, $month, $day, $holidayFile);

	if (!is_array($data["currentMonth"][$day]["events"])) $data["currentMonth"][$day]["events"]=array();
	if (!array_key_exists('countDisplay',$data["currentMonth"][$day])){
	$data["currentMonth"][$day]['countDisplay']=0;
	}
	foreach ($hols as $hol) {
	$count = count($data["currentMonth"][$day]["events"]);
	$data["currentMonth"][$day]["events"][$count]=$hol;
	}
	}
	}

	function getHolidayDataForWeek($startday,$startmonth,$startyear,$holidayFile){
	$holidays = array();
	for( $d = 0; $d < 7; $d++ ){
	list($year,$month,$day) = explode(":",strftime("%Y:%m:%d",mktime(0,0,0,$startmonth,$startday+$d,$startyear)));
	// set 1 second after midnight to deal with holiday files from midnight - midnight inclusive!
	$hols = iCalHelper::getVEventsByDate($year, $month, $day, $holidayFile);
	if (count($hols)>0){
	$holidays = array_merge($holidays,$hols);
	}
	}
	return $holidays;
	}

	function getHolidayDataForWeekBACKUP(&$data, $holidayFile){
	$startday   = $data['days'][0]['week_day'];
	$startmonth = $data['days'][0]['week_month'];
	$startyear  = $data['days'][0]['week_year'];
	for( $d = 0; $d < 7; $d++ ){
	list($year,$month,$day) = explode(":",strftime("%Y:%m:%d",mktime(0,0,0,$startmonth,$startday+$d,$startyear)));
	// set 1 second after midnight to deal with holiday files from midnight - midnight inclusive!
	$hols = iCalHelper::getVEventsByDate($year, $month, $day, $holidayFile);

	if (!is_array($data["days"][$d]["rows"])) $data["days"][$d]["rows"]=array();
	foreach ($hols as $hol) {
	$count = count( $data["days"][$d]["rows"]);
	$data["days"][$d]["rows"][$count]=$hol;
	}
	}
	}
	function getHolidayDataForDay(&$data,$day,$month,$year, $holidayFile){
	$hols = iCalHelper::getVEventsByDate($year, $month, $day, $holidayFile);
	foreach ($hols as $hol){
	$count = count($data['hours']['timeless']['events']);
	$data['hours']['timeless']['events'][$count]=$hol;
	}
	}

	function getHolidayDataForYear(&$data, $holidayFile){
	// logic - go though events and populate year array
	$ical = iCalHelper::getiCal($holidayFile);

	$hols = array();

	if (isset($ical->vevents)) {

	$year  = $data['year'];
	$startDate	= mktime (0, 0, 1, 1, 1, $year);
	$endDate	= mktime (23, 59, 59, 12, 31, $year);
	foreach ($ical->vevents as $vevent){
	if ($vevent->eventInPeriod($startDate,$endDate)){
	$holiday = new jIcalEvent($vevent);
	$month = intval($holiday->mup());
	$count = count( $data["months"][$month]["rows"]);
	$data["months"][$month]["rows"][$count]=$holiday;

	}
	}
	}
	}
	*/
	/*
	function & getiCal($holidayFile){
	if (is_array($holidayFile)){
	echo "prblem";
	}
	$ical  =& EventsHelper::iCalInstance($holidayFile);
	return $ical;
	//static $ical; // Should be an array by filename!
	//if (!isset($ical)) $ical = new iCalImport($holidayFile);
	//return $ical;
	}
	*/
	// TODO remove redundant code - keep it for now in caes we need it
	/*
	function getVEventsByDate($year, $month, $day, $holidayFile){

	$ical = iCalHelper::getiCal($holidayFile);
	$hols = array();
	if (isset($ical->vevents)) {
	// each day of current month
	// $data[$d] need to add to $data[$d]["events"]
	$cellDate	= mktime (0, 0, 1, $month, $day, $year);

	// inefficient - I create these jIcalEvents lots of times ??
	foreach ($ical->vevents as $vevent){
	// INEFFICIENT - I CAN END UP LOOKING FOR THE SAME EVENT MULTIPLE TIMES
	if (!array_key_exists($vevent->data["UID"],$hols)){
	if ($vevent->eventOnDate($cellDate)){
	$holiday = new jIcalEvent($vevent);
	$count = count($hols);
	//		$hols[$count] = $holiday;

	$hols[$vevent->data["UID"]] = $holiday;
	}
	}
	}
	}
	return $hols;
	}

	function getVEventsByDateKEEP($year, $month, $day, $holidayFile){
	$ical = iCalHelper::getiCal($holidayFile);
	$icaldata  =& $ical->cal;
	$hols = array();
	if (array_key_exists("VEVENT",$icaldata)) {

	// each day of current month
	// $data[$d] need to add to $data[$d]["events"]
	$cellDate	= mktime (0, 0, 1, $month, $day, $year);

	foreach ($icaldata["VEVENT"] as $vevent){
	if (array_key_exists("DTSTART",$vevent)){
	$pos = true;
	if ($pos!==false){
	// This should really work with counted events too!
	if ($vevent["DTSTART"]<=$cellDate && $vevent["DTEND"]>=$cellDate){
	$holiday = new jIcalEvent($vevent);
	$count = count($hols);
	$hols[$count] = $holiday;

	}
	}

	}
	}
	}
	return $hols;
	}

	function getVEventByUID($uid,$holidayFile){
	$ical = iCalHelper::getiCal($holidayFile);
	$icaldata  = $ical->cal;

	if (array_key_exists("VEVENT",$icaldata)) {

	foreach ($icaldata["VEVENT"] as $vevent){

	if ( $vevent['UID']==$uid){
	$holiday = new jIcalEvent($vevent);
	return $holiday;
	}

	}
	}
	}
	*/

}
?>
