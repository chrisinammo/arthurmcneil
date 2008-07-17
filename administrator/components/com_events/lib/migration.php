<?php
/**
 * Events Component for Joomla 1.5.x
 *
 * @version     $Id: migration.php 912 2007-12-21 11:19:31Z geraint $
 * @package     Events
 * @copyright   Copyright (C) 2006-2007 JEvents Project Group
 * @copyright   Copyright (C) 2000 - 2003 Eric Lamette, Dave McDonnell
 * @licence     http://www.gnu.org/copyleft/gpl.html
 * @link        http://joomlacode.org/gf/project/jevents
 */

/**
 * Class and methods to manage migration from 1.4 to 1.5
 */

defined( '_JEXEC' ) or die( 'Restricted access' );

class JEvents_Migration {

	function jevents_checkDatabase(){
		$cfg = & EventsConfig::getInstance();
		$option = $cfg->get("com_componentname", "com_events");
		$db	=& JFactory::getDBO();

		$db->setQuery( "SHOW COLUMNS FROM #__events LIKE 'alldayevent'");
		$fields = $db->loadObjectList();
		if( count($fields)==0){
			// add the NEW FIELD NOW

			$db->setQuery("ALTER TABLE #__events ADD alldayevent TINYINT(1) NOT NULL DEFAULT '0'");
			if(!$db->query()){
				// trouble, maybe 'ALTER' SQL command disabled?
				?> alert('DV alter table error:\n' + '<?php echo $db->_errorMsg; ?>'); <?php
			}

			// Now set the allday flag based on event times
			$query = "SELECT *"
			. "\n , YEAR(publish_up  ) as yup, MONTH(publish_up  ) as mup, DAYOFMONTH(publish_up  ) as dup"
			. "\n , YEAR(publish_down) as ydn, MONTH(publish_down) as mdn, DAYOFMONTH(publish_down) as ddn"
			. "\n , HOUR(publish_up  ) as hup, MINUTE(publish_up  ) as minup, SECOND(publish_up  ) as sup"
			. "\n , HOUR(publish_down) as hdn, MINUTE(publish_down) as mindn, SECOND(publish_down) as sdn"
			. "\n FROM #__events";
			$db->setQuery($query);

			$events = $db->loadObjectList();
			$matchedlist = "";
			foreach ($events as $ev) {
				if ($ev->hup==$ev->hdn && $ev->minup==$ev->mindn && $ev->sup==$ev->sdn){
					if ($matchedlist!="") $matchedlist.=",";
					$matchedlist.="$ev->id";
				}
			}
			if ($matchedlist!=""){
				$query = "UPDATE #__events SET alldayevent=1 WHERE id IN ($matchedlist)";
				$db->setQuery($query);
				$db->query();
			}
		}

		// Change main menu item to link to cpanel (NOT NEEDED FOR NEW INSTALLATION/CLEAN UPGRADE)
		$query = "UPDATE #__components"
		. "\n SET admin_menu_link='option=".$option."&task=cpanel'"
		. "\n WHERE link='option=".$option."'"
		. "\n AND parent=0";
		$db->setQuery($query);
		$db->query();

		/**
	 * create table if it doesn't exit
	 * 
	 * For now : 
	 * 
	 * I'm ignoring attach,comment, resources, transp, attendee, related to, rdate, request-status
	 * 
	 * note that icaltype = 0 for imported from URL, 1 for imported from file, 2 for created natively
	 * Separate tables for rrule and exrule
	 */
		$sql = <<<SQL
CREATE TABLE IF NOT EXISTS #__jevents_icsfile(
	ics_id int(12) NOT NULL auto_increment,
	srcURL VARCHAR(120) NOT NULL default "",
	label varchar(30) NOT NULL UNIQUE default "",

	filename VARCHAR(120) NOT NULL default "",

	icaltype tinyint(3) NOT NULL default 0,
	state tinyint(3) NOT NULL default 1,
	access int(11) unsigned NOT NULL default 0,
	catid int(11) NOT NULL default 1,
	created datetime  NOT NULL default '0000-00-00 00:00:00',
	`created_by` int(11) unsigned NOT NULL default '0',
	`created_by_alias` varchar(100) NOT NULL default '',
	`modified_by` int(11) unsigned NOT NULL default '0',
	refreshed datetime  NOT NULL default '0000-00-00 00:00:00',
		
	PRIMARY KEY  (ics_id)
) TYPE=MyISAM;	
SQL;
		$db->setQuery($sql);
		$db->query();


		/**
	 * create table if it doesn't exit
	 * 
	 * For now : 
	 * 
	 * I'm ignoring attach,comment, resources, transp, attendee, related to, rdate, request-status
	 * 
	 * Separate tables for rrule and exrule
	 */
		$sql = <<<SQL
CREATE TABLE IF NOT EXISTS #__jevents_vevent(
	ev_id int(12) NOT NULL auto_increment,
	icsid int(12) NOT NULL default 0,
	catid int(11) NOT NULL default 1,
	uid varchar(255) NOT NULL UNIQUE default "",
	refreshed datetime  NOT NULL default '0000-00-00 00:00:00',
	`created_by` int(11) unsigned NOT NULL default '0',
	`created_by_alias` varchar(100) NOT NULL default '',
	`modified_by` int(11) unsigned NOT NULL default '0',

	rawdata longtext NOT NULL default "",
	recurrence_id varchar(30) NOT NULL default "",
	
	detail_id int(12) NOT NULL default 0,
	
	state tinyint(3) NOT NULL default 1,
	access int(11) unsigned NOT NULL default 0,
	
	PRIMARY KEY  (ev_id),
	INDEX (icsid)
) TYPE=MyISAM;	
SQL;
		$db->setQuery($sql);
		$db->query();

		/**
	 * create table if it doesn't exit
	 * 
	 * For now : 
	 * 
	 * I'm ignoring attach,comment, resources, transp, attendee, related to, rdate, request-status
	 * 
	 * Separate tables for rrule and exrule
	 */
		$sql = <<<SQL
CREATE TABLE IF NOT EXISTS #__jevents_vevdetail(
	evdet_id int(12) NOT NULL auto_increment,

	rawdata longtext NOT NULL default "",
	dtstart int(11) NOT NULL default 0,
	dtstartraw varchar(30) NOT NULL default "",
	duration int(11) NOT NULL default 0,
	durationraw varchar(30) NOT NULL default "",
	dtend int(11) NOT NULL default 0,
	dtendraw varchar(30) NOT NULL default "",
	dtstamp varchar(30) NOT NULL default "",
	class  varchar(10) NOT NULL default "",
	categories varchar(120) NOT NULL default "",
	description longtext NOT NULL default "",
	geolon float NOT NULL default 0,
	geolat float NOT NULL default 0,
	location VARCHAR(120) NOT NULL default "",
	priority tinyint unsigned NOT NULL default 0,
	status varchar(20) NOT NULL default "",
	summary longtext NOT NULL default "",
	contact VARCHAR(120) NOT NULL default "",
	organizer VARCHAR(120) NOT NULL default "",
	url VARCHAR(120) NOT NULL default "",
	extra_info VARCHAR(240) NOT NULL DEFAULT '',
	created varchar(30) NOT NULL default "",
	sequence int(11) NOT NULL default 1,
	state tinyint(3) NOT NULL default 1,
		
	PRIMARY KEY  (evdet_id)
) TYPE=MyISAM;	
SQL;
		$db->setQuery($sql);
		$db->query();

		$sql = <<<SQL
CREATE TABLE IF NOT EXISTS #__jevents_rrule (
	rr_id int(12) NOT NULL auto_increment,
	eventid int(12) NOT NULL default 1,
	freq varchar(30) NOT NULL default "",
	until int(12) NOT NULL default 1,
	untilraw varchar(30) NOT NULL default "",
	count int(6) NOT NULL default 1,
	rinterval int(6) NOT NULL default 1,
	bysecond  varchar(50) NOT NULL default "",
	byminute  varchar(50) NOT NULL default "",
	byhour  varchar(50) NOT NULL default "",
	byday  varchar(50) NOT NULL default "",
	bymonthday  varchar(50) NOT NULL default "",
	byyearday  varchar(50) NOT NULL default "",
	byweekno  varchar(50) NOT NULL default "",
	bymonth  varchar(50) NOT NULL default "",
	bysetpos  varchar(50) NOT NULL default "",
	wkst  varchar(50) NOT NULL default "",
	PRIMARY KEY  (rr_id)
) TYPE=MyISAM;	
SQL;
		$db->setQuery($sql);
		$db->query();

		$sql = <<<SQL
CREATE TABLE IF NOT EXISTS #__jevents_repetition (
	rp_id int(12) NOT NULL auto_increment,
	eventid int(12) NOT NULL default 1,
	eventdetail_id int(12) NOT NULL default 0,	
	duplicatecheck varchar(32) NOT NULL UNIQUE default "",
	startrepeat datetime  NOT NULL default '0000-00-00 00:00:00',
	endrepeat datetime  NOT NULL default '0000-00-00 00:00:00',
	PRIMARY KEY  (rp_id),
	INDEX (eventid)
) TYPE=MyISAM;	
SQL;
		$db->setQuery($sql);
		$db->query();

	}

	function convertAdminMenu() {

		HTML_events_admin::_header();
		echo "<tr><td>\n";

		global $mainframe;
		$db	=& JFactory::getDBO();
		$lang =& JFactory::getLanguage();
		$langname = $lang->getBackwardLang();

		// TODO check what value global option variable has at this stage
		$option = "com_events";

		$queries	= array();
		$errors 	= array();
		$dataSum	= '';
		$cleaned 	= '';

		// get proper language
		$pathLang 	= JPATH_ADMINISTRATOR . '/components/'.$option.'/language/admin_';
		// tries to get adminlang (if defined - see MGFi www.mgfi.info for more info)
		if( file_exists( $pathLang . $langname . '.php' )) {
			include( $pathLang . $langname . '.php' );
		} else {
			include( $pathLang . 'english.php' );
		}

		// Do the clean up if installed on a previous installation
		$query = "SELECT count(id) as count, max(id) as lastInstalled"
		. "\n FROM #__components"
		. "\n WHERE link='option=".$option."'"
		;
		$db->setQuery( $query );
		$reginfo = $db->loadObjectList();
		$lastInstalled = $reginfo[0]->lastInstalled;

		// Check if there are more registered instances of the Events component
		if( $reginfo[0]->count >= 1 ) {
			// Remove duplicates
			$query = "SELECT *"
			. "\n FROM #__components"
			. "\n WHERE link='option=".$option."'"
			. "\n AND id!='$lastInstalled'"
			. "\n AND admin_menu_link LIKE 'option=".$option."'"
			;
			$db->setQuery( $query);
			$toberemoved = $db->loadObjectList();

			foreach( $toberemoved as $remid ){
				// Delete duplicate entries
				$query = "DELETE FROM #__components"
				. "\n WHERE id='$remid->id'"
				. "\n OR parent='$remid->id'"
				;
				$db->setQuery( $query );
				$db->query();

				$cleaned++;
				$dataSum++;
			}
		}

		// Remove 'old' child menu items
		$query = "DELETE FROM #__components"
		. "\n WHERE parent='$lastInstalled'"
		;
		$db->setQuery( $query );
		$db->query();

		// update images
		$eventsIMG 		= '../administrator/components/'.$option.'/images/events_ico.png';

		// updates entries for menus in correct language and updates images
		// main entry
		$queries[] = "UPDATE #__components SET name = '" . _CAL_LANG_INSTAL_MAIN . "'"
		."\n , admin_menu_alt = '" . _CAL_LANG_INSTAL_MAIN . "'"
		."\n , admin_menu_img='" . $eventsIMG . "'"
		."\n  WHERE link = 'option=".$option."'";

		foreach( $queries AS $query ){
			$db->setQuery( $query );
			if( !$db->query() ) {
				$errors[] = array( $db->getErrorMsg(), $query );
			}else{
				$dataSum++;
			}
		}

     ?>

    <div>
        <?php
        if( $errors ){
        	echo '<strong style="color:red;">' . _CAL_LANG_INSTAL_ERROR . '</strong>';
        	echo '<ul>';
        	foreach( $errors AS $error ){
        		echo '<li>' . $error[0] . '</li>';
        	}
        	echo '</ul>';
        }else{
        	echo '<strong style="color:green;">' . $dataSum . ' ' . _CAL_LANG_INSTALL_DB_ENTRIES . '</strong>';
        }

        if( $cleaned ){
        	echo '<strong style="color:green;">' . $cleaned . ' ' . _CAL_LANG_INSTALL_PREV_INST . '</strong>';
        } ?>
    </div>

    <div style="text-align:left; float:left;">
    	<?php
    	$path = JPATH_ADMINISTRATOR . '/components/'.$option.'/help/README_';
    	$lang = strtok($mainframe->getCfg('locale'), '_');
    	if( file_exists( $path . $lang . '.php' )){
    		include( $path . $lang . '.php' );
    	}else{
    		include( $path . 'en.php' );
    	} ?>
    </div>
    <?php
    echo "</td></tr>\n";
    global $task;
    HTML_events_admin::_footer($task,$option);

	}


	function convertExtCalData() {
		HTML_events_admin::_header();
		echo "<tr><td>\n";

		global $task;

		$cfg = & EventsConfig::getInstance();
		$option = $cfg->get("com_componentname", "com_events");
		global $mainframe;
		$db	=& JFactory::getDBO();

		/**
		 * Categories first 
		 **/
		$query = "SELECT * FROM #__extcal_categories";
		$db->setQuery($query);
		$cats = $db->loadObjectList();

		foreach ($cats as $ec){
			// Remove identical category first !!
			// First remove the extra jevents category information
			$query="SELECT id FROM #__categories"
			."\n WHERE title='$ec->cat_name (ext)' and section='com_events'";
			$db->setQuery($query);
			$ids = $db->loadResultArray();
			$idlist = implode(",",$ids);

			if (count($ids>0)){
				$idlist = implode(",",$ids);
				$query="DELETE FROM #__events_categories WHERE id IN ($idlist)";
				$db->setQuery($query);
				if( !$db->query() ) {
					$error = array( $db->getErrorMsg(), $query );
					echo "Error in - ".$error[1]."<br/>";
					echo "Error message is ".$error[0]."<hr/>";
				}

				$query="DELETE FROM #__categories"
				."\n WHERE id IN ($idlist)";
				$db->setQuery($query);
				if( !$db->query() ) {
					$error = array( $db->getErrorMsg(), $query );
					echo "Error in - ".$error[1]."<br/>";
					echo "Error message is ".$error[0]."<hr/>";
				}

			}


			// Assume for time being all parents = 0!!
			$query="INSERT INTO #__categories"
			."\n (parent_id, title, name, image, section, image_position, description, published, checked_out, checked_out_time, editor, ordering, access, count, params)"
			."\n VALUES (0, '$ec->cat_name (ext)', '$ec->cat_name (ext)', '', 'com_events' ,'left', '$ec->description', $ec->published, $ec->checked_out, '$ec->checked_out_time','',0,0,0,'') ";
			$db->setQuery($query);
			if( !$db->query() ) {
				$error = array( $db->getErrorMsg(), $query );
				echo "Error in - ".$error[1]."<br/>";
				echo "Error message is ".$error[0]."<hr/>";
			}

			// Now set the extra jevents category information
			$query="SELECT id FROM #__categories"
			."\n WHERE title='$ec->cat_name (ext)'";
			$db->setQuery($query);
			$id = $db->loadResult();

			if ($id>0){
				$query="INSERT INTO #__events_categories"
				."\n (id, color)"
				."\n VALUES ($id, '$ec->color')";
				$db->setQuery($query);
				if( !$db->query() ) {
					$error = array( $db->getErrorMsg(), $query );
					echo "Error in - ".$error[1]."<br/>";
					echo "Error message is ".$error[0]."<hr/>";
				}
			}

		}

		/**
		 * Now to convert the events put them in a special series of icals from scratch called by their category names
		 */
		include_once(dirname(__FILE__)."/icalManagement.php");
		$_icalManagement = new IcalManagement();
		include_once(JPATH_SITE."/components/$option/libraries/iCalImport.php");
		foreach ($cats as $ec) {
			// clean out any aborter migration attempts
			$query="DELETE FROM #__jevents_icsfile"
			."\n WHERE label='$ec->cat_name (ext)'"
			."\n AND icaltype=2";
			$db->setQuery($query);
			if( !$db->query() ) {
				$error = array( $db->getErrorMsg(), $query );
				echo "Error in - ".$error[1]."<br/>";
				echo "Error message is ".$error[0]."<hr/>";
			}

			$query="SELECT id FROM #__categories"
			."\n WHERE title='$ec->cat_name (ext)' and section='com_events'";
			$db->setQuery($query);
			$catid = $db->loadResult();
			if (is_null($catid) || 	$catid==0){
				echo "missing category selection<br/>";
				return;
			}
			// Should come from the form or existing item
			$access = 0;
			$state = 1;
			$icsLabel = "$ec->cat_name (ext)";
			$icsid = 0;
			$icsFile = iCalICSFile::editICalendar($icsid,$catid,$access,$state,$icsLabel);
			$icsFileid = $icsFile->store();


			$query = "SELECT * FROM #__extcal_events"
			."\n WHERE cat=$ec->cat_id";
			$db->setQuery($query);
			$exevents = $db->loadObjectList();
/*
			foreach ($exevents as $xv){
				$icalevent = array();
				$icalevent['uid']=md5(uniqid(rand(),true));
				$icalevent['adresse_info']="";
				// TODO check this
				$icalevent['allDayEvent']="off";
				$icalevent['contact_info']=$ec->contact."&nbsp;".$ec->email;
				$icalevent['content']=$ec->description."<hr/>".$ec->url;
				//$icalevent['publish_down']
				//$icalevent['publish_up']
				$icalevent['rinterval']=$ec->recur_val;
				$icalevent['title']=$ec->title;
				$icalevent['ics_id']= $icsFileid;
				else $start_time			= JArrayHelper::getValue( ($array, "start_time","08:00");
				else $end_time 			= JArrayHelper::getValue( ($array, "end_time","15:00");
				$countuntil		= JArrayHelper::getValue( ($array, "countuntil","count");
				$count 			= intval(JArrayHelper::getValue( ($array, "count",1));
				$until			= JArrayHelper::getValue( ($array, "until",$data["publish_down"]);
				$whichby			= JArrayHelper::getValue( ($array, "whichby","bd");
				$byd_direction		= JArrayHelper::getValue( ($array, "byd_direction","off")=="off"?"+":"-";
				$byyearday 			= JArrayHelper::getValue( ($array, "byyearday","");
				$bm_direction		= JArrayHelper::getValue( ($array, "bm_direction","off")=="off"?"+":"-";
				$bymonth			= JArrayHelper::getValue( ($array, "bymonth","");
				$bwn_direction		= JArrayHelper::getValue( ($array, "bwn_direction","off")=="off"?"+":"-";
				$byweekno			= JArrayHelper::getValue( ($array, "byweekno","");
				$bmd_direction		= JArrayHelper::getValue( ($array, "bmd_direction","off")=="off"?"+":"-";
				$bymonthday			= JArrayHelper::getValue( ($array, "bymonthday","");
				$bd_direction		= JArrayHelper::getValue( ($array, "bd_direction","off")=="off"?"+":"-";
				$weekdays			= JArrayHelper::getValue( ($array, "weekdays",array());
				$weeknums			= JArrayHelper::getValue( ($array, "weeknums",array());
				$vevent->catid = JArrayHelper::getValue( ($array, "catid",0);
				$vevent->access = JArrayHelper::getValue( ($array, "access",0);
				$vevent->state =  intval(JArrayHelper::getValue( ($array, "state",0));

			}
*/

		}

		echo "</td></tr>\n";
		HTML_events_admin::_footer($task,$option);

	}

}

?>
