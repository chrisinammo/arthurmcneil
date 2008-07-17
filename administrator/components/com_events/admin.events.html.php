<?php
/**
 * Events Component for Joomla 1.5.x
 *
 * @version     $Id: admin.events.html.php 986 2008-02-21 22:22:38Z tstahl $
 * @package     Events
 * @copyright   Copyright (C) 2006 - 2007 JEvents Project Group
 * @copyright   Copyright (C) 2000 - 2003 Eric Lamette, Dave McDonnell
 * @licence     http://www.gnu.org/copyleft/gpl.html
 * @link        http://joomlacode.org/gf/project/jevents
 */

// ensure this file is being included by a parent file
defined( '_JEXEC' ) or die( 'Restricted access' );

$cfg = & EventsConfig::getInstance();
$jev_component_name = $cfg->get("com_componentname");
include_once(JPATH_SITE."/components/$jev_component_name/libraries/datamodel.php");
include_once(JPATH_ADMINISTRATOR."/components/$jev_component_name/lib/adminqueries.php");
jimport('joomla.html.pane');

class HTML_events_admin {

	var $dataModel = null;

	function HTML_events_admin() {
		$this->dataModel = new JEventsDataModel("JEventsAdminDBModel");
		global $mainframe;
		$cfg = & EventsConfig::getInstance();
		$option = $cfg->get("com_componentname", "com_events");
		$this->live_site = JURI::root();
		$cssPath = 'components/com_events/css/jevents.css';
		$cssHTML = '<link rel="stylesheet" href="' . $this->live_site . $cssPath . '" type="text/css" />' . "\n";
		if (file_exists(JPATH_ADMINISTRATOR . DS . $cssPath)) {
			$mainframe->addCustomHeadTag( $cssHTML );
		}
		if ($mainframe->isAdmin()){
			$cssHTML = '<link href="' . JURI::root() . 'administrator/components/' . $option.'/css/eventsadmin.css" rel="stylesheet" type="text/css" />' . "\n";
			$mainframe->addCustomHeadTag( $cssHTML );
		}

	}

	/**
	 * Returns a reference to a object, only creating it
	 * if it doesn't already exist.
	 *
	 * @static
	 * @access public
	 * @return object  		The HTML_events_admin object.
	 */
	function &getInstance() {

		static $instance;

		if (!$instance) {
			$instance = new HTML_events_admin();
		}

		return $instance;
	}

	/**
	* Creates label and tool tip window as onmouseover event
	* if label is empty, a (i) icon is used
	*
	* @static
	* @param $tip	string	tool tip text declaring label
	* @param $label	string	label text
	* @return		string	html string
	*/
	function tip ( $tip='', $label='') {

		JHTML::_('behavior.tooltip');
		if (!$tip) {
			$str = $label;
		}
		//$tip = htmlspecialchars($tip, ENT_QUOTES);
		//$tip = str_replace('&quot;', '\&quot;', $tip);
		$tip = str_replace("\n", " ", $tip);
		if (!$label) {
			$str = JHTML::_('tooltip',$tip, null, 'tooltip.png', null, null, 0);
		} else {
			$str = '<span class="editlinktip">'
			. JHTML::_('tooltip',$tip, $label, null,  $label, '', 0)
			. '</span>';
		}
		return $str;
	}

	/**
	* Creates a help icon with link to help information as onclick event
	*
	* if $help is url, link opens a new window with target url
	* if $help is text, text is shown in a sticky overlib window with close button
	*
	* @static
	* @param	$help		string	help text (html text or url to target)
	* @param	$caption	string	caption of overlib window
	* @return				string	html sting
	*/
	function help ( $help='help text', $caption='') {

		global $mainframe;
		$cfg = & EventsConfig::getInstance();
		$option = $cfg->get("com_componentname", "com_events");


		$compath = JURI::root() . 'administrator/components/'.$option;
		$imgpath = $compath . '/images';

		if (empty($caption)) $caption = '&nbsp;';

		if (substr($help, 0, 7) == 'http://' || substr($help, 0, 8) == 'https://') {
			//help text is url, open new window
			$onclick_cmd = "window.open(\"$help\", \"help\", \"height=700,width=800,resizable=yes,scrollbars\");return false";
		} else {
			// help text is plain text with html tags
			// prepare text as overlib parameter
			// escape ", replace new line by space
			$help = htmlspecialchars($help, ENT_QUOTES);
			$help = str_replace('&quot;', '\&quot;', $help);
			$help = str_replace("\n", " ", $help);

			$ol_cmds = 'RIGHT, ABOVE, VAUTO, WRAP, STICKY, CLOSECLICK, CLOSECOLOR, "white"';
			$ol_cmds .= ', CLOSETEXT, "<span style=\"border:solid white 1px;padding:0px;margin:1px;\"><b>X</b></span>"';
			$onclick_cmd = 'return overlib("'.$help.'", ' . $ol_cmds . ', CAPTION, "'.$caption.'")';
		}

		$str = '<img border="0" style="vertical-align:bottom; cursor:help;" alt="'. _CAL_LANG_HELP . '"'
		. ' title="' . _CAL_LANG_HELP .'"'
		. ' src="' . $imgpath . '/help_ques_inact.gif"'
		. ' onmouseover=\'this.src="' . $imgpath . '/help_ques.gif"\''
		. ' onmouseout=\'this.src="' . $imgpath . '/help_ques_inact.gif"\''
		. ' onclick=\'' . $onclick_cmd . '\'>';

		return $str;
	}

	/**
	* Writes a list of the events items
	* @param array An array of events objects
	*/
	function showEvents( $rows, $clist, $search, $pageNav, $option, $hideOldEvents=1, $catData ) {

		global $mainframe, $task;
		$db	=& JFactory::getDBO();
		$user =& JFactory::getUser();

		JHTML::_('behavior.tooltip');

		// get configuration object
		$cfg = & EventsConfig::getInstance();

		$pathIMG = $this->live_site . 'administrator/images/'; ?>
<!--
		<div id="overDiv" style="position:absolute; visibility:hidden; z-index:1000;"></div>
		<script language="Javascript" src="../includes/js/overlib_mini.js"></script>
-->
		<form action="index2.php" method="post" name="adminForm">
			<table cellpadding="4" cellspacing="0" border="0" width="100%">
				<tr>
					<td width="100%" >
						&nbsp;
					</td>
				    <td nowrap><?php echo _CAL_HIDE_OLD_EVENTS;
				    echo JHTML::_('select.integerlist',0,1,1,"oldev","onchange='submitbutton(\"viewEvents\");'",$hideOldEvents);
      					?>
      				</td>
					<td><?php echo _CAL_LANG_SEARCH; ?>&nbsp;</td>
					<td>
						<input type="text" name="search" value="<?php echo $search; ?>" class="inputbox" onchange="submitbutton('viewEvents');" />
					</td>
					<td align="right"><?php echo $clist;?> </td>
				</tr>
			</table>

			<table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">
				<tr>
					<th width="20" nowrap="nowrap">
						<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $rows ); ?>);" />
					</th>
					<th class="title" width="30%" nowrap="nowrap"><?php echo _CAL_LANG_TITLE; ?></th>
					<th width="10%" align="left" nowrap="nowrap"><?php echo _CAL_LANG_EVENT_CATEGORY; ?></th>
					<th width="10%" align="left" nowrap="nowrap"><?php echo _CAL_LANG_REPEAT; ?></th>
					<th width="10" nowrap="nowrap"><?php echo _CAL_LANG_PUBLISHED; ?></th>
					<th width="20%" nowrap="nowrap"><?php echo _CAL_LANG_TIME_SHEET; ?></th>
					<th width="10%" nowrap="nowrap"><?php echo _CAL_LANG_CHECKED_OUT; ?></th>
					<th width="10%" nowrap="nowrap"><?php echo _CAL_LANG_ACCESS; ?></th>
				</tr>

                <?php
                $k 			= 0;
                $nullDate 	= $db->getNullDate();

                for( $i=0, $n=count( $rows ); $i < $n; $i++ ){
                	$row = &$rows[$i]; ?>
                    <tr class="row<?php echo $k; ?>">
                    	<td width="20" style="background-color:<?php echo setColor($row);?>">
                            <?php
                            if ($row->checked_out && $row->checked_out != $user->id) { ?>
                                &nbsp;
                                <?php
                            }else{ ?>
                                <input type="checkbox" id="cb<?php echo $i;?>" name="cid[]" value="<?php echo $row->id; ?>" onclick="isChecked(this.checked);" />
                                <?php
                            } ?>
                    	</td>
                      	<td width="30%">
                      		<a href="#edit" onclick="return listItemTask('cb<?php echo $i;?>','edit')" title="<?php echo _CAL_LANG_CLICK_TO_EDIT; ?>"><?php echo mosEventsHtml::special($row->title); ?></a>
                      	</td>

                      	<td width="10%"><?php echo $row->category; ?></td>

						<td width="10%">
                    	    <?php
                    	    $day_name = array(_CAL_LANG_SUN,_CAL_LANG_MON,_CAL_LANG_TUE,_CAL_LANG_WED,
                    	    _CAL_LANG_THU,_CAL_LANG_FRI,_CAL_LANG_SAT);
                    	    switch( $row->reccurtype ){
                    	    	case '0':
                    	    		if (strtotime($row->publish_down)-strtotime($row->publish_up)>86400){
                    	    			echo _CAL_LANG_ALLDAYS;
                    	    		}
                    	    		else {
                    	    			echo "-";
                    	    		}
                    	    		break;
                    	    	case '1':
                    	    		echo "1* "._CAL_LANG_EVENT_PER." "._CAL_LANG_REP_WEEK." (".$day_name[$row->reccurday].")";
                    	    		break;
                    	    	case '2':
                    	    		$repdays = explode("|",$row->reccurweekdays);
                    	    		foreach ($repdays as $key=>$rep) {
                    	    			$repdays[$key] = $day_name[$rep];
                    	    		}
                    	    		$repdays = implode(", ",$repdays);
                    	    		echo "n* "._CAL_LANG_EVENT_PER." "._CAL_LANG_REP_WEEK." (".$repdays.") ";
                    	    		switch ($row->reccurweeks) {
                    	    			case "pair":
                    	    				echo _CAL_LANG_REP_WEEKPAIR ;
                    	    				break;
                    	    			case "pair":
                    	    				echo _CAL_LANG_REP_WEEKIMPAIR ;
                    	    				break;
                    	    			default:
                    	    				$repweeks = str_replace("|",", ",$row->reccurweeks);
                    	    				echo _CAL_LANG_REP_WEEK." ".$repweeks;
                    	    				break;
                    	    		}

                    	    		break;
                    	    	case '3':
                    	    		echo  _CAL_LANG_EACH ." "._CAL_LANG_REP_MONTH;
                    	    		break;
                    	    	case '4':
                    	    		echo  _CAL_LANG_EACH ." "._CAL_LANG_REP_MONTH;
                    	    		break;
                    	    	case '5':
                    	    		echo "1 * "._CAL_LANG_REP_YEAR;
                    	    		break;
                    	    }
								?>
                    	</td>

						<td width="10%" align="center">
                      	    <?php
                      	    // changed by mic
                      	    $now	= strftime( '%Y-%m-%d %H:%M:%S', time() + ( $mainframe->getCfg('offset')*60*60 ));
                      	    if ( $now <= $row->publish_up && $row->state == 1 ) {
                      	    	// Published
                      	    	$img = 'publish_y.png';
                      	    }elseif( ( $now <= $row->publish_down || $row->publish_down == $nullDate ) && $row->state == 1 ) {
                      	    	// Pending
                      	    	$img = 'publish_g.png';
                      	    } else if ( $now > $row->publish_down && $row->state == 1 ) {
                      	    	// Expired
                      	    	$img = 'publish_r.png';
                      	    } elseif ( $row->state == 0 ) {
                      	    	// Unpublished
                      	    	$img = 'publish_x.png';
                      	    }

                      	    $times = '';

                      	    if( isset( $row->publish_up )) {
                      	    	if( $row->publish_up == '0000-00-00 00:00:00' ){
                      	    		$times .= '<tr><td>' . _CAL_LANG_FROM . ' : Always</td></tr>';
                      	    	} else {
                      	    		$times .= '<tr><td>' . _CAL_LANG_FROM . ' : ' . $row->publish_up . '</td></tr>';
                      	    	}
                      	    }

                      	    if( isset( $row->publish_down )) {
                      	    	if( $row->publish_down == '0000-00-00 00:00:00' ) {
                      	    		$times .= '<tr><td>' . _CAL_LANG_TO . ' : Never</td></tr>';
                      	    	} else {
                      	    		$times .= '<tr><td>' . _CAL_LANG_TO . ' : ' . $row->publish_down . '</td></tr>';
                      	    	}
                      	    }

                      	    $timeINFO = '';
                      	    if( $times != '' ){
                      	    	$timesINFO = $times;
                      	    	$timesINFO .= '<tr><td><strong>' . _CAL_CLICK_TO_CHANGE_STATUS . '</strong></td></tr>';
                      	    }

                            if( $times ){ ?>
                            	<a href="javascript: void(0);" onMouseOver="return overlib('<table border=0 width=100% height=100%><?php echo $timesINFO; ?></table>', CAPTION, '<?php echo _CAL_LANG_PUB_INFO; ?>', BELOW, RIGHT);" onMouseOut="return nd();" onclick="return listItemTask('cb<?php echo $i; ?>','<?php echo $row->state ? 'unpublish' : 'publish'; ?>')"><img src="<?php echo $pathIMG . $img; ?>" width="12" height="12" border="0" alt="" /></a>
                            	<?php
                            } ?>
                        </td>
                      	<td width="20%">
                      		<table style="border: 1px solid #666666; width:100%;"><?php echo $times; ?></table>
                      	</td>
                      	<?php
                      	if ($row->checked_out) { ?>
                      		<td width="10%" align="center"><?php echo $row->editor; ?></td>
                      		<?php
                      	}else{ ?>
                      		<td width="10%" align="center">&nbsp;</td>
                      		<?php
                      	} ?>
                      	<td width="10%" align="center"><?php echo $row->groupname;?></td>
                    </tr>
                    <?php
                    $k = 1 - $k;
                } ?>
            	<tr>
            		<th align="center" colspan="9"><?php echo $pageNav->getListFooter(); ?></th>
            	</tr>
            </table>
            <input type="hidden" name="option" value="<?php echo $option;?>" />
            <input type="hidden" name="task" value="<?php echo $task;?>" />
            <input type="hidden" name="boxchecked" value="0" />
        </form>

        <br />
        <table cellspacing="0" cellpadding="4" border="0" align="center">
        	<tr align="center">
        		<td>
        			<img src="<?php echo $pathIMG; ?>publish_y.png" width="12" height="12" border=0 alt="<?php echo _CAL_LANG_TIT_PENDING; ?>" title="<?php echo _CAL_LANG_TIT_PENDING; ?>" />
        		</td>
        		<td>
        			<?php echo _CAL_LANG_PUB_BUT_COMING; ?>
        			&nbsp;|
        		</td>
        		<td>
        			<img src="<?php echo $pathIMG; ?>publish_g.png" width="12" height="12" border=0 alt="Visible" />
        		</td>
        		<td>
        			<?php echo _CAL_LANG_PUB_ACTUAL; ?>
        			&nbsp;|
        		</td>
        		<td>
        			<img src="<?php echo $pathIMG; ?>publish_r.png" width="12" height="12" border=0 alt="Finished" />
        		</td>
        		<td>
        			<?php echo _CAL_LANG_PUB_FINISHED; ?>
        			&nbsp;|
        		</td>
        		<td>
        			<img src="<?php echo $pathIMG; ?>publish_x.png" width="12" height="12" border=0 alt="Finished" />
        		</td>
        		<td><?php echo _CAL_LANG_NOT_PUBLISHED; ?></td>
        	</tr>
        	<tr>
        		<td colspan="8" align="center"><?php echo _CAL_CLICK_TO_CHANGE_STATUS; ?></td>
        	</tr>
        </table>
        <?php
	}

	function editEvents( $row, $start_publish, $stop_publish, $start_time, $end_time, $section, $glist,
		$creator, $modifier, $option, $mode, $catColors, $lists , $hiddenVals="") {

		// TODO image handling for legacy events

		$user =& JFactory::getUser();
		$editor =& JFactory::getEditor();
		global $mainframe;

		// clean any existing cache files
		$cache =& JFactory::getCache($option);
		$cache->clean($option);

		$this->_header();

		echo "<tr><td>\n";
		
		// get configuration object
		$cfg = & EventsConfig::getInstance();

		JHTML::_('behavior.tooltip');
		// This causes a javascript error in MSIE 7 if the scripts haven't loaded when the dom is ready!
		//JHTML::_('behavior.calendar');

		$tabs = & JPane::getInstance('tabs');
		$return2cat = intval( JRequest::getVar( 'catid', 0 ) );
		$myid		= $user->id;

		list( $start_hrs, $start_mins ) = explode( ':', $start_time );
		list( $end_hrs, $end_mins ) 	= explode( ':', $end_time );

		if( $cfg->get('com_calUseStdTime') == 1 ) {
			$start_pm	= false;
			$end_pm		= false;
			$start_hrs	= intval( $start_hrs );
			$end_hrs	= intval( $end_hrs );

			if( $start_hrs >= 12 ){
				$start_pm = true;
			}

			if( $start_hrs > 12 ){
				$start_hrs -= 12;
			}elseif( $start_hrs == 0 ){
				$start_hrs = 12;
			}

			if( $end_hrs >= 12 ){
				$end_pm = true;
			}

			if( $end_hrs > 12 ){
				$end_hrs -= 12;
			}elseif( $end_hrs == 0 ){
				$end_hrs = 12;
			}
		}

		if( strlen( $start_mins ) == 1 ){
			$start_mins = '0' . $start_mins;
		}

		if( strlen( $start_hrs ) == 1 ){
			$start_hrs = '0' . $start_hrs;
		}

		$start_time = $start_hrs . ':' . $start_mins;

		if( strlen( $end_mins ) == 1 ){
			$end_mins = '0' . $end_mins;
		}

		if( strlen( $end_hrs ) == 1 ){
			$end_hrs = '0' . $end_hrs;
		}

        $end_time = $end_hrs . ':' . $end_mins; ?>

        <style type="text/css" media="screen">
            <!--
            .jevent_day {
                background-color    : #FFE9E9;
                color               : #000000;
            }
            .jevent_week {
                background-color    : #FFECD9; /* #FFCC99 */
                color               : #000000;
            }
            .jevent_month {
                background-color    : #D9FFE7; /* 99CC66 */
                color               : #000000;
            }
            .jevent_year {
                background-color    : #D9FFFE; /* FFCCCC */
                color               : #000000;
            }
            -->
        </style>

		<script type="text/javascript">
		/* <![CDATA[ */

		var oldColor = "<?php echo $row->color_bar; ?>";
		var catColors = new Object();
		var oldChecked = <?php echo ( $cfg->get('com_defColor') == 'category' && $mode == 'new' ) ? 'true' : 'false'; ?>;
		<?php
		$i = 0;
		foreach( $catColors as $id=>$color ){
			echo "\n    catColors['$id'] = '$color->color';";
		}

		// dmcd - nov 6/04, there will be no category associated with a new event which will cause an error
		// below unless we detect an invalid catid for the new event $row
		// [added catColors-check by mic - 2006.07.28 - otherise we get an error because of undefined index!]
		if( $catColors ){
			echo "\nvar catColor='";
			if( $row->catid == null ){
				echo "';\n";
			}else{
				echo $catColors[$row->catid]->color."';\n";
			}
		}else{
			echo "\nvar catColor='';\n";
		} ?>
		/* ]]> */
		</script>
		
		<script type="text/javascript">
		/* <![CDATA[ */
		function introTocontent(){
			document.adminForm.introtext.value = document.adminForm.content.value;
		}

		function submitbutton(pressbutton) {
			setgood();
			if (pressbutton == 'cancel' || pressbutton == 'viewEvents') {
				submitform( pressbutton );
				return;
			}
			checkDisable();

			<?php echo $editor->getContent( 'content' ); ?>

			// Call this function to provide content for introtext attribute (needed for preview)
			document.adminForm.introtext.value = document.adminForm.content.value;

			// do field validation
			var sw = checkSelectedWeeks();
			var sd = checkSelectedDays();
			var form = document.adminForm;
			if (form.title.value == "") {
				alert ( "<?php echo html_entity_decode( _E_WARNTITLE ); ?>" );
				//} else if (form.content.value == "") {
				/*
				alert ( "<?php echo _CAL_LANG_WARNACTIVITY; ?>" );
				*/
			} else if (form.catid.value == "0"){
				alert( "<?php echo html_entity_decode( _E_WARNCAT ); ?>" );
			} else if (sw == "0"){
				alert( "<?php echo html_entity_decode( _CAL_LANG_E_WARNWEEKS ); ?>" );
			} else if (sd == "0"){
				alert( "<?php echo html_entity_decode( _CAL_LANG_E_WARNDAYS ); ?>" );
			} else {

				//alert('about to submit the form');
				submitform(pressbutton);
			}
		}

		function setgood(){
			var form = document.adminForm;
			form.goodexit.value=1;
		}

		//dmcd function below is an ovveride of a celndar support function in mamboscript.js
		// This function gets called when an end-user clicks on some date
		function selected(cal, date) {
			cal.sel.value = date; // just update the value of the input field
			checkPublish();
		}

		function checkTime(myField){
			// chop leading zeros or non numeric chars from left
			// capture 4 numbers at most, 2 for hours, 2 for mins, truncate the rest
			// look for /(a,am,p,pm)/i  for std time spec in remaining string from above
			// rewrite the value of the field based on either 24hr or 12hr time formats according
			// to the events config.
			// if an illegal time format is entered, restore field value to original value before bad edit

			if(myField.name.search(/start/i) != -1){
				name = "Start";
				chkBoxGroup = document.adminForm.start_pm;
			}
			else{
				name = "End";
				chkBoxGroup = document.adminForm.end_pm;
			}

			pmUsed=false;
			amUsed=false;
			no_hours=false;

			var time = myField.value;
			// if value begins with an optional leading 0 followed by a delimiter, assume only minutes being specified
			if(time.search(/^\s*0?[\.\-\+:]/) != -1) no_hours=true;
			time = time.replace(/[-\.,_=\+:;]/g, "");
			time = time.replace(/^\s+/,"");
			if(time.search(/^\d+/) != -1){
				if(time.search(/^0+\D*$/) != -1) time = '0';
				// leading zeros may indicate 24 hr format
				else time = time.replace(/^0+(\d{4})/,"$1");
				time = time.replace(/\s+$/,"");
				//time = time.replace(/([^1,2]\d{2})\d+/,"$1");
				//time = time.replace(/((1|2)\d{3})\d+/,"$1");
				num = time.replace(/^(\d+).*/, "$1");

				if(num*1 <= 2359){
					// pad the entered numer with zeros on the right to make it 4 digits
					if(no_hours){
						num = num.replace(/^(\d)$/,"0" + "$1");
						num = '00' + num + '00';
						// Konqueror and Safari couldn't cope before!!!
						num = num.replace(/^(\d\d\d\d).*$/,"$1");
					}
					num = num.replace(/^(\d)$/,"$1" + "00");
					num = num.replace(/^((1|2)\d)$/,"$1" + "00");
					num = num.replace(/^(\d\d)$/,"$1" + "0");

					if (document.all) mins = num.slice(-2);
					else mins = num.substr(-2);
					//alert('mins are: '+ mins);
					if(mins*1 < 60){
						num *= 1;

						// need to determine here if am/pm being used
						if(time.search(/(a|p)m?$/i) != -1){
							// using std time for entry
							// if pm, don't allow number to exceed 1200
							if(time.search(/p(m)?$/i) != -1){
								pmUsed=true;
								if(num < 1200) num += 1200;
							} else {
								amUsed=true;
								if(num >= 1200 && num < 1300) num -= 1200;
							}
						}
						if(num < 60) hrs = '0';
						else {
							num = num + '';
							hrs = num.substr(0,num.length - mins.length);
						}
						//alert('hrs are: '+ hrs);

						// now put the time back into the correct format for the input control depending upon the mode
						<?php
						if($cfg->get('com_calUseStdTime') == 1) { ?>
						// std time, convert to am/pm format, update the am/pm radio checkboxes as well
						// if am/pm was specified in the field
						if(hrs*1 > 12){
							hrs = hrs*1 -12 + '';
							if(pmUsed){
								//adjust radio checkboxes
								chkBoxGroup[0].checked = false;
								chkBoxGroup[1].checked = true;
							}
						}
						if(amUsed){
							chkBoxGroup[0].checked = true;
							chkBoxGroup[1].checked = false;
						}
						if(hrs*1 == 0) hrs = 12;
						time = hrs + ':' + mins;
						<?php }
						else { ?>
						// 24hr military time format, add a leading 0 onto nums < 1000
						if(hrs.length == 1) hrs = '0' + hrs;
						time = hrs + ':' + mins;
						<?php } ?>

						// sucessful field edit.  update the old field value with the new one
						myField.oldValue = myField.value;
						myField.value = time;
						return true;
					}
				}
				else if (num*1 <= 2400){
					alert("for midnight please set 00:00 on the following day");
					return true;
				}
			}
			// bad input format, alert user, reset field value
			if(myField.name.search(/start/i) != -1) name = "Start";
			else name = "End";
			alert('Bad ' + name + ' Time format: ' + myField.value + '\nValid format is hh:mm {am|pm} (12 or 24hr format).  Please try again.');
			if(myField.oldValue) myField.value = myField.oldValue;
			else myField.value = '';
			window.globalObj = myField;
			var t = setTimeout('window.globalObj.focus();',100);
			return true;
		}

		function checkPublish(){
			var form = document.adminForm;
			if (form.publish_down.value < form.publish_up.value) {
				form.publish_down.value = form.publish_up.value;
			}
			// dmcd aug 20/04 disabled to allow overnite events
			//if (form._publish_down_hour.value < form._publish_up_hour.value) {
			//   var temphour= '';
			//   var nb1=0;
			//   nb1 = eval(form._publish_up_hour.value);
			//   temphour = nb1 + 1;
			//   form._publish_down_hour.value = eval(temphour);
			//}
			checkDisable();
		}

		function checkSelectedWeeks(){
			var form = document.adminForm;
			if((form.reccurtype[1].checked==true) || (form.reccurtype[2].checked==true)){
				var check = 0;
				for (i=1; i < 8; i++) {
					cb = eval( 'form.cb_wn' + i );
					if(cb.checked==true) {
						check++;
					}
				}
				return check;
			}
		}

		function checkSelectedDays(){
			var form = document.adminForm;
			if(form.reccurtype[5].checked==true){
				var f = form.reccurday_year;
				var check = 0;
				for (i=0; i < f.length; i++) {
					if(f[i].checked==true) {
						check++;
					}
				}
				return check;
			}
			if(form.reccurtype[3].checked==true){
				var f = form.reccurday_month;
				var check = 0;
				for (i=0; i < f.length; i++) {
					if(f[i].checked==true) {
						check++;
					}
				}
				return check;
			}

			if(form.reccurtype[1].checked==true){
				var f = form.reccurday_week;
				var check = 0;
				for (i=0; i < f.length; i++) {
					if(f[i].checked==true) {
						check++;
					}
				}
				return check;
			}
			if(form.reccurtype[2].checked==true){
				var check = 0;
				for (i=0; i < 7; i++) {
					cb = eval( 'form.cb_wd' + i );
					if(cb.checked==true) {
						check++;
					}
				}
				return check;
			}
		}

		function checkDisable(){
			var form = document.adminForm;
			// Check repeat Disable repeat option
			if (form.publish_down.value == form.publish_up.value) {
				var f = form.reccurtype;
				for (i=1; i < f.length; i++) {
					f[i].disabled = true;
				}
				form.reccurtype[0].checked=true;
				document.getElementById('repeat_msg').style.display="";
			} else {
				var f = form.reccurtype;
				for (i=0; i < f.length; i++) {
					f[i].disabled = false;
				}
				document.getElementById('repeat_msg').style.display="none";
			}
			// By Week : Check reccurday
			if(form.reccurtype[1].checked==true){
				var f = form.reccurday_week;
				for (i=0; i < f.length; i++) {
					f[i].disabled = false;
				}
			} else {
				var f = form.reccurday_week;
				for (i=0; i < f.length; i++) {
					f[i].disabled = true;
				}
			}
			// By Week : Check weekdays
			if(form.reccurtype[2].checked==true){
				var f = document.adminForm;
				for (i=0; i < 7; i++) {
					cb = eval( 'f.cb_wd' + i );
					cb.disabled = false;
				}
			} else {
				var f = document.adminForm;
				for (i=0; i < 7; i++) {
					cb = eval( 'f.cb_wd' + i );
					cb.disabled = true;
				}
			}

			// By Week : Disable Weeks select
			if((form.reccurtype[1].checked==true) || (form.reccurtype[2].checked==true)){
				var g = document.adminForm;
				for (i=1; i < 8; i++) {
					cb = eval( 'g.cb_wn' + i );
					cb.disabled = false;
					if((i<6) && (cb.checked==true)) {
						g.cb_wn6.checked = false;
						g.cb_wn7.checked = false;
					}
				}
			} else {
				var g = document.adminForm;
				for (i=1; i < 8; i++) {
					cb = eval( 'g.cb_wn' + i );
					cb.disabled = true;
				}
			}

			// By Month : Check reccurday
			if(form.reccurtype[3].checked==true){
				var f = form.reccurday_month;
				for (i=0; i < f.length; i++) {
					f[i].disabled = false;
				}
			} else {
				var f = form.reccurday_month;
				for (i=0; i < f.length; i++) {
					f[i].disabled = true;
				}
			}

			// By Year : Check reccurday
			if(form.reccurtype[5].checked==true){
				var f = form.reccurday_year;
				for (i=0; i < f.length; i++) {
					f[i].disabled = false;
				}
			} else {
				var f = form.reccurday_year;
				for (i=0; i < f.length; i++) {
					f[i].disabled = true;
				}
			}
		}
		function toggleAllDayEvent(){
			checkbox = document.getElementById("allDayEvent");
			starttime=document.getElementById("start_time");
			endtime=document.getElementById("end_time");
			start_pm0= document.getElementById("start_pm0");
			start_pm1= document.getElementById("start_pm1");
			end_pm0= document.getElementById("end_pm0");
			end_pm1= document.getElementById("end_pm1");
			if (checkbox.checked){
				starttime.value="00:01";
				endtime.value="00:01";
				document.getElementById("st1").style.visibility="hidden";
				document.getElementById("st2").style.visibility="hidden";
				if (document.getElementById("st3")) {
					document.getElementById("st3").style.visibility="hidden";
					start_pm0.checked=true;
					start_pm1.checked=false;
					start_pm0.style.visibility="hidden";
					start_pm1.style.visibility="hidden";
				}
				document.getElementById("et1").style.visibility="hidden";
				document.getElementById("et2").style.visibility="hidden";
				if (document.getElementById("et3")) {
					document.getElementById("et3").style.visibility="hidden";
					end_pm0.checked=true;
					end_pm1.checked=false;
					end_pm0.style.visibility="hidden";
					end_pm1.style.visibility="hidden";
				}
				starttime.style.visibility="hidden";
				endtime.style.visibility="hidden";
				/*
				starttime.disabled=true;
				endtime.disabled=true;
				start_pm0.disabled=true;
				start_pm1.disabled=true;
				end_pm0.disabled=true;
				end_pm1.disabled=true;
				*/
			}
			else {
				/*
				starttime.disabled=false;
				endtime.disabled=false;
				start_pm0.disabled=false;
				start_pm1.disabled=false;
				end_pm0.disabled=false;
				end_pm1.disabled=false;
				*/
				document.getElementById("st1").style.visibility="visible";
				document.getElementById("st2").style.visibility="visible";
				if (document.getElementById("st3")) {
					document.getElementById("st3").style.visibility="visible";
					start_pm0.style.visibility="visible";
					start_pm1.style.visibility="visible";
				}
				document.getElementById("et1").style.visibility="visible";
				document.getElementById("et2").style.visibility="visible";
				if (document.getElementById("et3")) {
					document.getElementById("et3").style.visibility="visible";
					end_pm0.style.visibility="visible";
					end_pm1.style.visibility="visible";
				}
				starttime.style.visibility="visible";
				endtime.style.visibility="visible";
			}
		}

		function checkAllDayEvent() {
			checkbox = document.getElementById("allDayEvent");
			starttime=document.getElementById("start_time");
			endtime=document.getElementById("end_time");

			start_pm0= document.getElementById("start_pm0");
			start_pm0_checked = start_pm0 ? start_pm0.checked : false;

			start_pm1= document.getElementById("start_pm1");
			start_pm1_checked = start_pm1 ? start_pm1.checked : false;

			end_pm0= document.getElementById("end_pm0");
			end_pm0_checked = end_pm0 ? end_pm0.checked : false;

			end_pm1= document.getElementById("end_pm1");
			end_pm1_checked = end_pm1 ? end_pm1.checked : false;


			if (starttime.value==endtime.value && start_pm0_checked==end_pm0_checked && start_pm1_checked==end_pm1_checked)	{
				document.getElementById("st1").style.visibility="hidden";
				document.getElementById("st2").style.visibility="hidden";

				if (document.getElementById("st3")) document.getElementById("st3").style.visibility="hidden";

				document.getElementById("et1").style.visibility="hidden";
				document.getElementById("et2").style.visibility="hidden";

				if (document.getElementById("et3")) {
					document.getElementById("et3").style.visibility="hidden";
					start_pm0.style.visibility="hidden";
					start_pm1.style.visibility="hidden";
					end_pm0.style.visibility="hidden";
					end_pm1.style.visibility="hidden";
				}
				starttime.style.visibility="hidden";
				endtime.style.visibility="hidden";
			}
			else checkbox.checked=false;
		}
		/* ]]> */
        </script>

        <table cellpadding="4" cellspacing="0" border="0" width="100%">
			<tr>
				<td class="sectionname">
					<?php echo $row->id ? _CAL_LANG_EDIT_EVENT : _CAL_LANG_ADD_EVENT; ?>
					<?php
					if( $row->title ){ ?>
						&nbsp;<small>[&nbsp;<?php echo mosEventsHtml::special($row->title); ?>&nbsp;]</small>
						<?php
					} ?>
				</td>
			</tr>
		</table>

			<table cellspacing="0" cellpadding="4" border="0" width="100%">
                <tr>
                    <td>
                        <?php
                        echo $tabs->startPane( 'jevent' );
                        echo $tabs->startPanel( _CAL_LANG_TAB_COMMON, 'event' ); 
                        ?>
				        <table cellpadding="5" cellspacing="0" border="0" width="100%" class="adminform">
                            <tr>
                                <td width="10%" align="left"><?php echo _CAL_LANG_EVENT_TITLE; ?>:</td>
                                <td colspan="3">
                                    <input class="inputbox" type="text" name="title" size="50" maxlength="100" value="<?php
										echo mosEventsHtml::special($row->title); ?>" />
                                </td>
                            </tr>
                            <tr>
                                <td valign="top" align="left"><?php echo _CAL_LANG_EVENT_CATEGORY; ?></td>
                                <td style="width:200px" >
                                    <?php mosEventsHTML::buildCategorySelect($row->catid, 'onchange="if(catColors[this.value])catColor=catColors[this.value]; else catColor=\'\';if(document.adminForm.useCatColor.checked) {setPickerColor(catColor,\'#000000\');};"'); ?>
                                </td>
                            <?php if (isset($glist)) {?>
                                <td width="10%" align="left"><?php echo _CAL_LANG_EVENT_ACCESSLEVEL; ?></td>
                                <td><?php echo $glist; ?></td>
                            <?php } 
                            else echo "<td/><td/>\n";?>
                            </tr>
                            <tr>
                                <td valign="top" align="left">
                                    <?php echo _CAL_LANG_EVENT_ACTIVITY; ?>
                                </td>
                                <td style="width:600px"  onMouseOut="introTocontent();" colspan="3">
                                    <?php
                                    // parameters : areaname, content, width, height, rows, cols
				                    echo $editor->display( 'content',  mosEventsHtml::special($row->content),  "100%", 250, '70', '10' ) ;?>
                                </td>
                            </tr>
                            <tr>
                                <td width="130" align="left"><?php echo _CAL_LANG_EVENT_ADRESSE; ?></td>
                                <td colspan="3">
                                    <input class="inputbox" type="text" name="location" size="80" maxlength="120" value="<?php
										echo mosEventsHtml::special($row->adresse_info); ?>" />
                                </td>
                            </tr>
                            <tr>
                                <td align="left"><?php echo _CAL_LANG_EVENT_CONTACT; ?></td>
                                <td colspan="3">
                                    <input class="inputbox" type="text" name="contact_info" size="80" maxlength="120" value="<?php
										echo mosEventsHtml::special($row->contact_info); ?>" />
                                </td>
                            </tr>
                            <tr>
                                <td align="left" valign="top"><?php echo _CAL_LANG_EVENT_EXTRA; ?></td>
                                <td>
                                	<textarea class="text_area" name="extra_info" id="extra_info" cols="50" rows="4" maxlength="240" wrap="virtual"><?php
										echo mosEventsHtml::special($row->extra_info); ?></textarea>
                                </td>
                            </tr>
                        </table>
                        <!-- // END EXTRA TAB -->
                        <?php
                        echo $tabs->endPanel();
                        echo $tabs->startPanel( _CAL_LANG_TAB_CALENDAR, 'calendar' );
                        if ( ($cfg->get('com_calForceCatColorEventForm', 0) == 1) && (! $mainframe->isAdmin())){
                        	$hideColour=" style='display:none;'";
                        }
                        else if ( $cfg->get('com_calForceCatColorEventForm', 0) == 2) {
                        	$hideColour=" style='display:none;'";
                        }
                        else $hideColour="";?>
            	        <table cellpadding="5" cellspacing="0" border="0" width="100%" class="adminform">
                            <tr>
                            	<td colspan="2" <?php echo $hideColour?>>
                                <fieldset><legend><?php echo _CAL_LANG_EVENT_COLOR; ?></legend>
                                <table>
                                <tr>
                                <td>
									<!-- New Colour Picker Start //-->
									<?php 
									include_once(dirname(__FILE__)."/lib/colorMap.php");
									$currentBG = ($row->useCatColor) ? ($row->catid > 0 ? $catColors[$row->catid]->color : '') : $row->color_bar;
									$currentFG = mapColor($currentBG);
									?>
                                    <table id="pick1064797275" align="left" style="background-color:<?php echo $currentBG.';color:'.$currentFG; ?>;border:solid 1px black;">
                                        <tr>
                                            <td width="80">
	          									<div><?php echo _CAL_LANG_EVENT_COLOR; ?></div>
												<input type="hidden" id="pick1064797275field" name="color_bar" value="<?php echo $currentBG;?>"/>
												</td>

												<td  nowrap>
		  										<a id="colorPickButton" name ="colorPickButton" href="javascript:void(0)"  onclick="if(!document.adminForm.useCatColor.checked) {showColors();}"
		  style="visibility:<?php if (( $cfg->get('com_defColor') == 'category' && $mode == 'new') || $row->useCatColor ) echo 'hidden';else echo "visible"; ?>;"><?php echo _CAL_LANG_COLOR_PICKER; ?></a>
 												<?php include(dirname(__FILE__)."/lib/colours.html.php"); ?>
                                            </td>
                                        </tr>
                                    </table>
                                    <table>
                                        <tr>
                                            <td style="background-color:#FFFFFF; border:1px dotted #666666;">
                                                <input type="checkbox" id="useCatColor" name="useCatColor" value="1"<?php if (( $cfg->get('com_defColor') == 'category' && $mode == 'new') || $row->useCatColor ) echo ' checked="checked"'; ?> onchange="togglePicker(catColor,'<?php echo $row->color_bar;?>');" />
                                                <label for="useCatColor" style="color:<?php echo (isset($row->catid) && $catColors[$row->catid]->color) ? $catColors[$row->catid]->color : ''; ?>">
                                                	<?php echo _CAL_LANG_EVENT_CATCOLOR; ?>
                                                </label>
                                            </td>
                                        </tr>
                                    </table>
									<!-- New Colour Picker End //--> 												
                                </td>
                                </tr>
                                </table>
                                </fieldset>
                                </td>
                            </tr>
							<tr>
								<td>
									<span style="font-weight:bold"><?php echo _CAL_LANG_EVENT_ALLDAY;?></span>
									<span><input type="checkbox" id='allDayEvent' name='allDayEvent' value='0' 
										<?php
										if (($cfg->get('com_calUseStdTime') == 1 && $start_time==$end_time && $start_pm==$end_pm) ||
										($cfg->get('com_calUseStdTime') != 1 && $start_time==$end_time) )
										echo "checked";
										?>
										 onclick="toggleAllDayEvent();" />
									</span>
								</td>
							</tr>
                            <tr>
                                <td>
                                	<fieldset><legend><?php echo _CAL_LANG_EVENT_STARTDATE; ?></legend>
                                    <table width="100%">
                                        <tr>
                                            <td>
												<?php echo JHTML::calendar($start_publish, 'publish_up', 'publish_up', '%Y-%m-%d',
												array('size'=>'12','maxlength'=>'10','onchange'=>'checkPublish();'));?>
                                            </td>
                                            <td id="st1" align="right" nowrap="nowrap">
                                                <?php echo _CAL_LANG_EVENT_STARTTIME; ?>
                                                &nbsp;
                                            </td>
                                            <td id="st2">
                                            	<?php
                                            	// dmcd aug/4/04
                                            	// changing this so user can enter time in one field including am/pm
                                            	// attr if they desire, or military time.
                                            	// New config constant to specify military
                                            	// or std time display format.
                                            	// If std, 2 radio boxes for am or pm are displayed.
                                            	// js form validator function 'CheckTime()' will be used.

                                                /* Hours Select */ ?>
                                                <input class="inputbox" type="text" name="start_time" id="start_time" size="8" maxlength="8" value="<?php echo $start_time;?>" onchange="checkTime(this);checkPublish();" />
                                            </td>
                                            <?php
                                            if( $cfg->get('com_calUseStdTime') == 1 ) { ?>
                                                <td id="st3" align="left" valign="middle">
                                                    <input id="start_pm0" name="start_pm" type="radio" value="0" onclick="checkDisable();"<?php if( !$start_pm ) echo ' checked="checked"'; ?> />
                                                    <label for="start_pm0" style="vertical-align:25%;">AM</label>
                                                    <input id="start_pm1" name="start_pm" type="radio" value="1" onclick="checkDisable();"<?php if( $start_pm ) echo ' checked="checked"'; ?> />
                                                    <label for="start_pm1" style="vertical-align:25%;">PM</label>
                                                </td>
                                                <?php
                                            } ?>
                                        </tr>
                                    </table>
                                    </fieldset>
                                </td>

                                <td>
                                	<fieldset><legend><?php echo _CAL_LANG_EVENT_ENDDATE; ?></legend>
                                    <table width="100%">
                                        <tr>
                                            <td>
												<?php echo JHTML::calendar($stop_publish, 'publish_down', 'publish_down', '%Y-%m-%d',
												array('size'=>'12','maxlength'=>'10','onchange'=>'checkPublish();'));?>
                                            </td>
                                            <td id="et1" align="right" nowrap="nowrap">
                                                <?php echo _CAL_LANG_EVENT_ENDTIME; ?>
                                                &nbsp;
                                            </td>
                                            <td id="et2" align="left">
                                                <input class="inputbox" type="text" name="end_time" id="end_time" size="8" maxlength="8" value="<?php echo $end_time; ?>" onchange="checkTime(this);checkPublish();" />
                                            </td>
                                            <?php
                                            if( $cfg->get('com_calUseStdTime') == 1 ) { ?>
                                                <td id="et3" align="left" valign="middle">
                                                    <input id="end_pm0" name="end_pm" type="radio" value="0" onclick="checkDisable();"<?php if( !$end_pm ) echo ' checked="checked"'; ?> />
                                                    <label for="end_pm0" style="vertical-align:25%;">AM</label>
                                                    <input id="end_pm1" name="end_pm" type="radio" value="1" onclick="checkDisable();"<?php if( $end_pm ) echo ' checked="checked"'; ?> />
                                                    <label for="end_pm1" style="vertical-align:25%;">PM</label>
                                                </td>
                                                <?php
                                            } ?>
                                        </tr>
                                    </table>
                                    </fieldset>
                                </td>
                            </tr>
                            <!-- REPEAT -->
							<?php 
							global $mainframe;
							if($mainframe->isAdmin() || ($cfg->get('com_calSimpleEventForm', 0) == 0) ){
								$hideRepeat="";
							}
							else $hideRepeat="style='display:none;'";
							$reccurtype_attribs = array();
							for ($i = 0; $i <= 5; $i++) {
								$reccurtype_attribs[$i] = 'name="reccurtype" type="radio" value="'.$i.'" onclick="checkDisable();"';
								if ($i == $row->reccurtype) $reccurtype_attribs[$i] .= ' checked="checked"';
							}
							$cb_wn6_checked = null;
							$cb_wn7_checked = null;
							if ( $row->reccurtype == 1 || $row->reccurtype == 2) {
								if ( $row->reccurweeks == "pair")   $cb_wn6_checked = 'checked="checked"';
								if ( $row->reccurweeks == "impair") $cb_wn7_checked = 'checked="checked"';
							}
							?>
                            <tr <?php echo $hideRepeat?>>
                            	<td colspan="2">
                            	<fieldset><legend><?php echo _CAL_LANG_EVENT_REPEATTYPE; ?></legend>
                            		<div id="repeat_msg" style="font-weight:bold"><?php echo _CAL_LANG_REPEAT_DISABLED; ?></div>
                            		<table width="100%">
                                        <tr onmouseover="checkDisable();">
                                            <td>
                                                <table width="100%" border="0" cellspacing="2">
                                                    <tr>
                                                        <td width="60"><u><?php echo _CAL_LANG_REP_DAY; ?></u></td>
                                                        <td colspan="2" class="jevent_day">
                                                            <input id="reccurtype_days" <?php echo $reccurtype_attribs[0]?> />
                                                            <label for="reccurtype_days"><?php echo _CAL_LANG_ALLDAYS; ?></label>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="60" rowspan="3"><u><?php echo _CAL_LANG_REP_WEEK;?></u></td>
                                                        <td width="100" class="jevent_week">
                                                            <input id="reccurtype_week" <?php echo $reccurtype_attribs[1]?> />
                                                            <label for="reccurtype_week">1 * <?php echo _CAL_LANG_EVENT_PER . ' ' . _CAL_LANG_REP_WEEK; ?></label>
                                                        </td>
                                                        <td class="jevent_week">
                                                            <?php
                                                            $arguments = 'disabled="disabled" onclick="checkDisable();"';
                                                            mosEventsHTML::buildReccurDaySelect( $row->reccurday_week, 'reccurday_week', $arguments ); ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="jevent_week">
                                                            <input id="reccurtype_weekn" <?php echo $reccurtype_attribs[2]?> />
                                                            <label for="reccurtype_weekn">n * <?php echo _CAL_LANG_EVENT_PER . ' ' . _CAL_LANG_REP_WEEK; ?></label>
                                                        </td>
                                                        <td class="jevent_week">
                                                            <?php
                                                            mosEventsHTML::buildWeekDaysCheck( $row->reccurweekdays, 'disabled="disabled"' ); ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="100" align="right" valign="top" class="jevent_week">
                                                            <i><?php echo _CAL_LANG_EVENT_WEEKOPT;?></i>
                                                        </td>
                                                        <td class="jevent_week">
                                                            <?php
                                                            $arguments = 'disabled="disabled" onclick="checkDisable();"';
                                                            mosEventsHTML::buildWeeksCheck( $row->reccurweeks, $arguments ); ?>
                                                            <br />
                                                            <input id="cb_wn6" name="reccurweeks[]" type="radio" value="pair" onclick="checkDisable();" disabled="disabled" <?php echo $cb_wn6_checked;?>/>
                                                            <label for="cb_wn6"><?php echo _CAL_LANG_REP_WEEKPAIR; ?></label>
                                                            &nbsp;
                                                            <input id="cb_wn7" name="reccurweeks[]" type="radio" value="impair" onclick="checkDisable();" disabled="disabled" <?php echo $cb_wn7_checked;?>/>
                                                            <label for="cb_wn7"><?php echo _CAL_LANG_REP_WEEKIMPAIR; ?></label>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="60" rowspan="2"><u><?php echo _CAL_LANG_REP_MONTH;?></u></td>
                                                        <td width="100" class="jevent_month">
                                                            <input id="reccurtype_month" <?php echo $reccurtype_attribs[3]?> />
                                                            <label for="reccurtype_month">1 * <?php echo _CAL_LANG_EVENT_PER . ' ' . _CAL_LANG_REP_MONTH; ?></label>
                                                        </td>
                                                        <td class="jevent_month">
                                                            <?php
                                                            $arguments = 'disabled="disabled" onclick="checkDisable();"';
                                                            mosEventsHTML::buildReccurDaySelect( $row->reccurday_month, 'reccurday_month', $arguments ); ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2" class="jevent_month">
                                                            <input id="reccurtype_month1" <?php echo $reccurtype_attribs[4]?> />
                                                            <label for="reccurtype_month1"><?php echo _CAL_LANG_EACH . ' ' . _CAL_LANG_ENDMONTH; ?></label>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="60" rowspan="2"><u><?php echo _CAL_LANG_REP_YEAR;?></u></td>
                                                        <td width="100" class="jevent_year">
                                                            <input id="reccurtype_year" <?php echo $reccurtype_attribs[5]?> />
                                                            <label for="reccurtype_year">1 * <?php echo _CAL_LANG_EVENT_PER . ' ' . _CAL_LANG_REP_YEAR; ?></label>
                                                        </td>
                                                        <td class="jevent_year">
                                                            <?php
                                                            $arguments = 'disabled="disabled" onclick="checkDisable();"';
                                                            mosEventsHTML::buildReccurDaySelect( $row->reccurday_year, 'reccurday_year', $arguments ); ?>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                            		</table>
                            	</fieldset>
                            	</td>
                            </tr>
                            <!-- END REPEAT -->
                        </table>
                        <?php
                        echo $tabs->endPanel();
                        echo $tabs->startPanel( _CAL_LANG_TAB_EXTRA, 'extra' ); ?>
						<table cellpadding="5" cellspacing="0" border="0" width="100%" class="adminform">                                                    <tr>
                                <th class="info" colspan="2"><?php echo _CAL_LANG_EVENT_STATUS; ?></th>
                            </tr>
                            <tr>
                                <td><?php echo _E_STATE; ?></td>
                                <td>
                                    <?php echo $row->state > 0 ? '<strong style="color:green;">' . _CAL_LANG_PUBLISHED . '</strong>' : ( $row->state < 0 ? '<strong style="color:red;">' . _CAL_LANG_ARCHIVED . '</strong>' : '<strong style="color:red;">' . _CAL_LANG_DRAFT_UNPUB . '</strong>' ); ?>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo _E_HITS; ?></td>
                                <td><?php echo $row->hits;?></td>
                            </tr>
                            <tr>
                                <td><?php echo _E_CREATED; ?></td>
                                <td>
                                    <?php echo $row->created ? $row->created
                                    . '</td></tr><tr><td><strong>' . _CAL_LANG_BY . '</strong></td><td>'
                                    . $creator : _CAL_LANG_EVENT_NEWEVENT; ?>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo _E_LAST_MOD; ?></td>
                                <td>
                                    <?php echo $row->modified ? $row->modified
                                    . '</td></tr><tr><td><strong>' ._CAL_LANG_BY . '</strong></td><td>'
                                    . $modifier : _CAL_LANG_EVENT_NOTMODIFIED; ?>
                                </td>
                            </tr>
						</table>
                        <?php
                        echo $tabs->endPanel();

                        // PLUGINS CAN BE LAYERED IN HERE
                        global $params;
                        // append array to extratabs keys content, title, paneid
                        $extraTabs = array();
                        $dispatcher	=& JDispatcher::getInstance();
                        $dispatcher->trigger( 'onEventEdit' , array(&$extraTabs,&$row,&$params), true );
                        if (count($extraTabs)>0) {
                        	foreach ($extraTabs as $extraTab) {
                        		echo $tabs->startPanel( $extraTab['title'], $extraTab['paneid'] );
                        		echo  $extraTab['content'];
                        		echo $tabs->endPanel();
                        	}
                        }
                        echo $tabs->startPanel( _CAL_LANG_TAB_HELP, 'help' ); ?>
                        <table align="left" width="100%" cellpadding="0" cellspacing="5" border="0" class="adminform">
                        	<?php echo _CAL_LANG_EVENT_FORM_HELP_ADMIN; ?>
                        </table>
                     	<?php
                     	echo $tabs->endPanel();
                        echo $tabs->startPanel( _CAL_LANG_TAB_ABOUT, 'about' ); ?>
                        <table width="100%" border="0" cellpadding="2" cellspacing="0" class="adminForm">
                            <tr>
                                <td colspan="2">
                                    <?php
                                    $pathLang = JPATH_ADMINISTRATOR . "/components/$option/help/README_";
                                    if( file_exists( $pathLang . _CAL_LANG_LNG . '.php' )){
                                    	include_once( $pathLang . _CAL_LANG_LNG . '.php' );
                                    }else{
                                    	include_once( $pathLang . 'en.php' );
                                    } ?>
                                </td>
                            </tr>
                        </table>
                     	<?php
                     	echo $tabs->endPanel();
                        echo $tabs->endPane(); ?>
                    </td>
                </tr>
            </table>

        	<input type="hidden" name="option" value="<?php echo $option;?>" />
        	<input type="hidden" name="id" value="<?php echo $row->id; ?>" />
        	<input type="hidden" name="sid" value="<?php echo $row->sid; ?>" />
        	<input type="hidden" name="return2cat" value="<?php echo $return2cat; ?>" />
        	<input type="hidden" name="introtext" />
        	<input type="hidden" name="goodexit" value="0" />
        	<input type="hidden" name="images" value="" />
        	<?php echo $hiddenVals ?>

		<script type="text/javascript">
		checkPublish();
		document.adminForm.catid.onchange();
		checkAllDayEvent();
        </script>

		<?php
        echo "</td></tr>\n";
		global $task;
		$this->_footer($task,$option);
	}

	/**
	* Writes a list of the events items
	* @param array An array of jicaleventdb objects
	*/
	function showICalEvents( $rows, $search, $pageNav, $option, $clist, $icsList="") {
		global  $task;
		$db	=& JFactory::getDBO();
		$user =& JFactory::getUser();

		JHTML::_('behavior.tooltip');

		// get configuration object
		$cfg = & EventsConfig::getInstance();

		$pathIMG = $this->live_site . 'administrator/images/'; ?>

		<form action="index2.php" method="post" name="adminForm">
			<table cellpadding="4" cellspacing="0" border="0" width="100%">
				<tr>
					<td width="100%">
						&nbsp;
					</td>
					<td align="right"><?php echo $clist;?> </td>
					<td align="right"><?php echo $icsList;?> </td>
					<td><?php echo _CAL_LANG_SEARCH; ?>&nbsp;</td>
					<td>
						<input type="text" name="search" value="<?php echo $search; ?>" class="inputbox" onChange="document.adminForm.submit();" />
					</td>
				</tr>
			</table>

			<table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">
				<tr>
					<th width="20" nowrap="nowrap">
						<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $rows ); ?>);" />
					</th>
					<th class="title" width="50%" nowrap="nowrap"><?php echo _CAL_LANG_ICAL_SUMMARY; ?></th>
					<th width="10%" nowrap="nowrap"><?php echo "Repeats"; ?></th>
					<th width="10%" nowrap="nowrap"><?php echo _CAL_LANG_PUBLISHED; ?></th>
					<th width="20%" nowrap="nowrap"><?php echo _CAL_LANG_TIME_SHEET; ?></th>
					<th width="10%" nowrap="nowrap"><?php echo _CAL_LANG_ACCESS; ?></th>
				</tr>

                <?php
                $k 			= 0;
                $nullDate 	= $db->getNullDate();

                for( $i=0, $n=count( $rows ); $i < $n; $i++ ){
                	$row = &$rows[$i]; ?>
                    <tr class="row<?php echo $k; ?>">
                    	<td width="20" style="background-color:<?php echo setColor($row);?>">
                            <input type="checkbox" id="cb<?php echo $i;?>" name="cid[]" value="<?php echo $row->id(); ?>" onclick="isChecked(this.checked);" />
                    	</td>
                      	<td >
                      		<a href="#edit" onclick="return listItemTask('cb<?php echo $i;?>','editical')" title="<?php echo _CAL_LANG_CLICK_TO_EDIT; ?>"><?php echo $row->title(); ?></a>
                      	</td>
                      	<td align="center">
                      	<?php
                      	if ($row->hasrepetition()){
                      	?>
                  	    	<a href="javascript: void(0);" onclick="return listItemTask('cb<?php echo $i; ?>','icalrepeats')"><img src="<?php echo $pathIMG . "copy_f2.png"; ?>" width="12" height="12" border="0" alt="" /></a>    
                  	    <?php }?>
                      	</td>
                      	<td align="center">
                      	<?php                      	
                      	$img = $row->state()?'publish_y.png':'publish_x.png';
                      	?>
                      	<a href="javascript: void(0);" onclick="return listItemTask('cb<?php echo $i; ?>','<?php echo $row->state() ? 'unpublishIcal' : 'publishIcal'; ?>')"><img src="<?php echo $pathIMG . $img; ?>" width="12" height="12" border="0" alt="" /></a>
                      	</td>
                      	<td >
                      	<?php
                      	$times = '<table style="border: 1px solid #666666; width:100%;">';
                      	$times .= '<tr><td>' . _CAL_LANG_FROM . ' : '. $row->publish_up().'</td></tr>';
                      	$times .= '<tr><td>' . _CAL_LANG_TO . ' : ' . $row->publish_down(). '</td></tr>';
                      	$times .="</table>";
                      	echo $times;
						?>
                      	</td>
                      	<td align="center"><?php echo $row->_groupname;?></td>
                    </tr>
                    <?php
                    $k = 1 - $k;
                } ?>
            	<tr>
            		<th align="center" colspan="9"><?php echo $pageNav->getListFooter(); ?></th>
            	</tr>
            </table>
            <input type="hidden" name="option" value="<?php echo $option;?>" />
            <input type="hidden" name="task" value="<?php echo $task;?>" />
            <input type="hidden" name="boxchecked" value="0" />
        </form>

        <br />
        <table cellspacing="0" cellpadding="4" border="0" align="center">
        	<tr align="center">
        		<td>
        			<img src="<?php echo $pathIMG; ?>publish_y.png" width="12" height="12" border=0 alt="<?php echo _CAL_LANG_TIT_PENDING; ?>" title="<?php echo _CAL_LANG_TIT_PENDING; ?>" />
        		</td>
        		<td>
        			<?php echo _CAL_LANG_PUB_BUT_COMING; ?>
        			&nbsp;|
        		</td>
        		<td>
        			<img src="<?php echo $pathIMG; ?>publish_g.png" width="12" height="12" border=0 alt="Visible" />
        		</td>
        		<td>
        			<?php echo _CAL_LANG_PUB_ACTUAL; ?>
        			&nbsp;|
        		</td>
        		<td>
        			<img src="<?php echo $pathIMG; ?>publish_r.png" width="12" height="12" border=0 alt="Finished" />
        		</td>
        		<td>
        			<?php echo _CAL_LANG_PUB_FINISHED; ?>
        			&nbsp;|
        		</td>
        		<td>
        			<img src="<?php echo $pathIMG; ?>publish_x.png" width="12" height="12" border=0 alt="Finished" />
        		</td>
        		<td><?php echo _CAL_LANG_NOT_PUBLISHED; ?></td>
        	</tr>
        	<tr>
        		<td colspan="8" align="center"><?php echo _CAL_CLICK_TO_CHANGE_STATUS; ?></td>
        	</tr>
        </table>
        <?php
	}

	function showICalSubscriptions( $rows, $search, $pageNav, $option, $clist){
		global  $task;
		$db	=& JFactory::getDBO();
		$user =& JFactory::getUser();
		JHTML::_('behavior.tooltip');

		// get configuration object
		$cfg = & EventsConfig::getInstance();

		$pathIMG = $this->live_site . 'administrator/images/';
		$pathJeventsIMG = $this->live_site . "administrator/components/$option/images/"; ?>

		<form action="index2.php" method="post" name="adminForm">
			<table cellpadding="4" cellspacing="0" border="0" width="100%">
				<tr>
					<td width="100%">
						&nbsp;
					</td>
					<td align="right"><?php echo $clist;?> </td>
					<td><?php echo _CAL_LANG_SEARCH; ?>&nbsp;</td>
					<td>
						<input type="text" name="search" value="<?php echo $search; ?>" class="inputbox" onChange="document.adminForm.submit();" />
					</td>
				</tr>
			</table>

			<table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">
				<tr>
					<th width="20" nowrap="nowrap">
						<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $rows ); ?>);" />
					</th>
					<th class="title" width="50%" nowrap="nowrap"><?php echo _CAL_LANG_ICAL_SUMMARY; ?></th>
					<th width="10%" nowrap="nowrap"><?php echo "type"; ?></th>
					<th width="10%" nowrap="nowrap"><?php echo _CAL_LANG_CATEGORY_NAME; ?></th>
					<th width="10%" nowrap="nowrap"><?php echo _CAL_LANG_ADMIN_REFRESH; ?></th>
					<th width="10%" nowrap="nowrap"><?php echo _CAL_LANG_PUBLISHED; ?></th>
					<th width="20%" nowrap="nowrap"><?php echo _CAL_LANG_TIME_SHEET; ?></th>
					<th width="10%" nowrap="nowrap"><?php echo _CAL_LANG_ACCESS; ?></th>
				</tr>

                <?php
                $k 			= 0;
                $nullDate 	= $db->getNullDate();

                for( $i=0, $n=count( $rows ); $i < $n; $i++ ){
                	$row = &$rows[$i]; ?>
                    <tr class="row<?php echo $k; ?>">
                    	<td width="20">
                            <input type="checkbox" id="cb<?php echo $i;?>" name="cid[]" value="<?php echo $row->ics_id; ?>" onclick="isChecked(this.checked);" />
                    	</td>
                      	<td width="30%">
                      		<a href="#edit" onclick="return listItemTask('cb<?php echo $i;?>','editics')" title="<?php echo _CAL_LANG_CLICK_TO_EDIT; ?>"><?php echo $row->label; ?></a>
                      	</td>
                      	<td width="10%" align="center">
                      	<?php
                      	$types = array("Remote","Uploaded File", "Native");
                      	echo $types[$row->icaltype];
                      	?>
                      	</td>
						<td width="10%" align="center"><?php echo $row->category; ?></td>
                      	<td width="10%" align="center">
                      	<?php
                      	// only offer reload for URL based ICS
                      	if ($row->srcURL!=""){
                      	?>
                      	<a href="javascript: void(0);" onclick="return listItemTask('cb<?php echo $i; ?>','reloadICS')"><img src="<?php echo $pathJeventsIMG . "reload.png"; ?>" border="0" alt="reload" /></a>
                      	<?php
                      	}
                      	?>
                      	
                      	</td>
                      	<td width="10%" align="center">
                      	<?php                      	
                      	$img = $row->state?'publish_y.png':'publish_x.png';
                      	?>
                      	<a href="javascript: void(0);" onclick="return listItemTask('cb<?php echo $i; ?>','<?php echo $row->state ? 'unpublishICS' : 'publishICS'; ?>')"><img src="<?php echo $pathIMG . $img; ?>" width="12" height="12" border="0" alt="" /></a>
                      	</td>
                      	<td width="20%">
                      	<?php
                      	$times = '<table style="border: 1px solid #666666; width:100%;">';
                      	$times .= '<tr><td>Created : '. $row->created.'</td></tr>';
                      	$times .= '<tr><td>Last Refreshed : ' . $row->refreshed. '</td></tr>';
                      	$times .="</table>";
                      	echo $times;
						?>
                      	</td>
                      	<td width="10%" align="center"><?php echo $row->_groupname;?></td>
                    </tr>
                    <?php
                    $k = 1 - $k;
                } ?>
            	<tr>
            		<th align="center" colspan="9"><?php echo $pageNav->getListFooter(); ?></th>
            	</tr>
            </table>
            <input type="hidden" name="option" value="<?php echo $option;?>" />
            <input type="hidden" name="task" value="<?php echo $task;?>" />
            <input type="hidden" name="boxchecked" value="0" />
        </form>

        <?php
	}

	function showICalRepetitions( $rows, $pageNav, $option){
		global   $task;
		$db	=& JFactory::getDBO();
		$user =& JFactory::getUser();
		JHTML::_('behavior.tooltip');

		// get configuration object
		$cfg = & EventsConfig::getInstance();

		$pathIMG = $this->live_site . 'administrator/images/';
		$pathJeventsIMG = $this->live_site . "administrator/components/$option/images/"; ?>

		<form action="index2.php" method="post" name="adminForm">
			<table cellpadding="4" cellspacing="0" border="0" width="100%">
				<tr>
					<td width="100%">
						&nbsp;
					</td>
				</tr>
			</table>

			<table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">
				<tr>
					<th width="20" nowrap="nowrap">
						<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $rows ); ?>);" />
					</th>
					<th class="title" width="60%" nowrap="nowrap"><?php echo _CAL_LANG_ICAL_SUMMARY; ?></th>
					<th width="40%" nowrap="nowrap"><?php echo "Repeat Date/Time"; ?></th>
				</tr>

                <?php
                $k 			= 0;
                $nullDate 	= $db->getNullDate();

                for( $i=0, $n=count( $rows ); $i < $n; $i++ ){
                	$row = &$rows[$i]; ?>
                    <tr class="row<?php echo $k; ?>">
                    	<td width="20">
                            <input type="checkbox" id="cb<?php echo $i;?>" name="cid[]" value="<?php echo $row->rp_id(); ?>" onclick="isChecked(this.checked);" />
                    	</td>
                      	<td width="30%">
                      		<a href="#edit" onclick="return listItemTask('cb<?php echo $i;?>','editIcalRepeat')" title="<?php echo _CAL_LANG_CLICK_TO_EDIT; ?>"><?php echo $row->title(); ?></a>
                      	</td>
                      	<td width="40%">
                      	<?php
                      	$times = '<table style="border: 1px solid #666666; width:100%;">';
                      	$times .= '<tr><td>Start : '. $row->publish_up().'</td></tr>';
                      	$times .= '<tr><td>End : ' . $row->publish_down(). '</td></tr>';
                      	$times .="</table>";
                      	echo $times;
						?>
                      	</td>
                    </tr>
                    <?php
                    $k = 1 - $k;
                } ?>
            	<tr>
            		<th align="center" colspan="9"><?php echo $pageNav->getListFooter(); ?></th>
            	</tr>
            </table>
            <input type="hidden" name="option" value="<?php echo $option;?>" />
            <input type="hidden" name="task" value="<?php echo $task;?>" />
            <input type="hidden" name="boxchecked" value="0" />
        </form>

        <br />
        <table cellspacing="0" cellpadding="4" border="0" align="center">
        	<tr align="center">
        		<td>
        			<img src="<?php echo $pathIMG; ?>publish_y.png" width="12" height="12" border=0 alt="<?php echo _CAL_LANG_TIT_PENDING; ?>" title="<?php echo _CAL_LANG_TIT_PENDING; ?>" />
        		</td>
        		<td>
        			<?php echo _CAL_LANG_PUB_BUT_COMING; ?>
        			&nbsp;|
        		</td>
        		<td>
        			<img src="<?php echo $pathIMG; ?>publish_g.png" width="12" height="12" border=0 alt="Visible" />
        		</td>
        		<td>
        			<?php echo _CAL_LANG_PUB_ACTUAL; ?>
        			&nbsp;|
        		</td>
        		<td>
        			<img src="<?php echo $pathIMG; ?>publish_r.png" width="12" height="12" border=0 alt="Finished" />
        		</td>
        		<td>
        			<?php echo _CAL_LANG_PUB_FINISHED; ?>
        			&nbsp;|
        		</td>
        		<td>
        			<img src="<?php echo $pathIMG; ?>publish_x.png" width="12" height="12" border=0 alt="Finished" />
        		</td>
        		<td><?php echo _CAL_LANG_NOT_PUBLISHED; ?></td>
        	</tr>
        	<tr>
        		<td colspan="8" align="center"><?php echo _CAL_CLICK_TO_CHANGE_STATUS; ?></td>
        	</tr>
        </table>
        <?php		
	}

	function editICSItem($editItem=null) {
		global $task;
		$cfg = & EventsConfig::getInstance();
		$option = $cfg->get("com_componentname", "com_events");
		$this->_header(' accept-charset="UTF-8" enctype="multipart/form-data" ');
		if (isset($editItem->ics_id)){
			$id = $editItem->ics_id;
			$catid = $editItem->catid;
			$access = $editItem->access;
			$srcURL = $editItem->srcURL;
			$filename = $editItem->filename;
			$label = $editItem->label;
			$icaltype = $editItem->icaltype;
			if ($srcURL == "") $filemessage="Loaded from Local file called ";
			else $filemessage="From file";
		}
		else {
			$id=0;
			$catid = 0;
			$access = 0;
			$srcURL = "";
			$filename = "";
			$label = "";
			$icaltype = 2;
			$filemessage="From file";
		}

		// get list of groups
		$db	=& JFactory::getDBO();
		$query = "SELECT id AS value, name AS text"
		. "\n FROM #__groups"
		. "\n ORDER BY id"	;
		$db->setQuery( $query );
		$groups = $db->loadObjectList();

		// build the html select list
		$glist = JHTML::_('select.genericlist', $groups, 'access', 'class="inputbox" size="1"',	'value', 'text', $access );

		$disabled ="";
		?>
		<table style="width:90%">
			<tr>
		    	<td style="width:200px;font-weight:bold" colspan="3">
                Unique Identifier : <input class="inputbox" type="text" name="icsLabel" id="icsLabel" value="<?php echo $label;?>" size="80" />
                <br/>
                <br/>
                </td>
			</tr>
			<tr>
		    	<td style="width:200px;font-weight:bold" >
                <?php echo "Select Category : ";echo   mosEventsHTML::buildCategorySelect($catid ,""); ?>
                </td>
				<td width="10%" align="left"><?php echo _CAL_LANG_EVENT_ACCESSLEVEL; ?></td>
                <td><?php echo $glist; ?></td>
			</tr>
			<?php
			if ($id==0 || $icaltype==1){
			?>
			<tr>
				<td style="padding:10px;border:solid 1px black;background-color:#ff99ff;" colspan="3">
				<?php echo $filemessage.$filename;?>
				<input class="inputbox" type="file" name="upload" id="upload" size="80" /><br/>
				<button name="loadical"  title="Load Ical" onclick="var icalfile=document.getElementById('upload').value;if (icalfile.length==0)return false; else submitbutton('saveics')">Load Ical from File</button>
                </td>
			</tr>
			<?php
			}
			if ($id==0 || $icaltype==0){
			?>
			<tr>
				<td style="padding:10px;border:solid 1px black;background-color:#99ffff;" colspan="3">
				<?php
				$urlsAllowed = ini_get("allow_url_fopen");
				echo "From URL";
				if (!$urlsAllowed) {
					echo "<h3>DISABLED - you server does not support loading files by URL</h3>";
					echo "<p>Save the file locally and upload it from there</p>";
					$disabled = "disabled";
				}
				else {
					$disabled ="";
				}
				?>
				
				<input class="inputbox" type="text" name="uploadURL" id="uploadURL" <?php echo $disabled;?> size="120" value="<?php echo $srcURL;?>"/><br/>
				<button name="loadical"  title="Load Ical"  <?php echo $disabled;?> onclick="var icalfile=document.getElementById('uploadURL').value;if (icalfile.length==0)return false; else submitbutton('saveics')">Load Ical from URL</button>
			</td>
		</tr>
			<?php
			}
			if ($id==0 && $icaltype==2){
			?>
		<tr>
		   <td style="margin-top:50px!important;padding:10px;border:solid 1px black;background-color:#ffff99;" colspan="3">
		   <h3>Creating from scratch</h3>
			<button name="newical"  title="Create New" onclick="submitbutton('createNewIcalCal')">Create Calendar from scratch</button>
		   </td>
		</tr>
			<?php
			}
			?>
		</table>
		<input type="hidden" name="icsid" id="icsid"  <?php echo $disabled;?> value="<?php echo $id;?>"/>

		<?php
		$this->_footer($task,$option);
	}


	function editIcalItem($option,$id, $repeatId=0){
		global $task,$catid, $mainframe,  $Itemid;
		$db	=& JFactory::getDBO();
		$editor =& JFactory::getEditor();
		/*
		if ($id==0 && $repeatId==0){
		return false;
		}
		*/
		// clean any existing cache files
		$cache =& JFactory::getCache($option);
		$cache->clean($option);

		$this->_header();

		echo "<tr><td>\n";

		if (isset($Itemid)){
			echo '<input type="hidden" name="Itemid" value="'.$Itemid.'" />';
		}

		// get configuration object
		$cfg = & EventsConfig::getInstance();
		if( $cfg->get('com_calUseStdTime') == 0 ) {
			$clock24=true;
		}
		else $clock24=false;

		JHTML::_('behavior.tooltip');
		// This causes a javascript error in MSIE 7 if the scripts haven't loaded when the dom is ready!
		//JHTML::_('behavior.calendar');
		$tabs = & JPane::getInstance('tabs');

		include_once(JPATH_ADMINISTRATOR."/components/$option/lib/adminqueries.php");
		include_once(JPATH_SITE."/components/$option/libraries/iCalImport.php");

		// these are needed for front end admin
		?>
		<input type="hidden" name="jevtype" value="<?php global $jevtype;echo $jevtype;?>">
		<?php

		if ($repeatId==0) {
			$repeatStyle="";
		}
		else {
			$repeatStyle="style='display:none;'";
			?>
			<h3>You are editing an Ical Repeat not the event itself!!</h3>
			<input type="hidden" name="cid[]" value="<?php echo $id;?>">
			<input type="hidden" name="rp_id" value="<?php echo $repeatId;?>">
			<?php
		}

		// iCal agid uses GUID or UUID as identifier
		if ($id>0){
			if ($repeatId==0) {
				$vevent = $this->dataModel->queryModel->getVEventById( $id);
				$row = new jIcalEventDB($vevent);
			}
			else {
				$row = $this->dataModel->queryModel->listEventsById($repeatId, true, "icaldb");
			}
			if (isset($row->_uid)){
			?>
			<input type="hidden" name="uid" value="<?php echo $row->_uid;?>">
			<?php
			}
		}
		else {
			$vevent = new iCalEvent($db);
			$vevent->set("freq","DAILY");
			$vevent->set("description","");
			$vevent->set("summary","");
			$vevent->set("dtstart",mktime(8,0,0));
			$vevent->set("dtend",mktime(15,0,0));
			$row = new jIcalEventDB($vevent);

			// TODO - move this to class!!
			// populate with meaningful initial values
			$row->starttime("07:23");
			$row->endtime("16:47");

		}

		// TODO move this to adminqueries
		// get list of groups
		$query = "SELECT id AS value, name AS text"
		. "\n FROM #__groups"
		. "\n ORDER BY id"	;
		$db->setQuery( $query );
		$groups = $db->loadObjectList();

		// build the html select list
		$glist = JHTML::_('select.genericlist', $groups, 'access', 'class="inputbox" size="1"',
		'value', 'text', intval( $row->access() ) );

		?>
		<div></div>
 		<script src="<?php echo $this->live_site."administrator/components/$option/js/editical.js";?>" type="text/javascript" language="Javascript" ></script>
		<input type="hidden" name="state" id="state" value="<?php echo $row->state();?>">
		<input type="hidden" name="ev_id" id="ev_id" value="<?php echo $row->id();?>">
		<input type="hidden" name="valid_dates" id="valid_dates" value="1" >
		<script type="text/javascript" language="Javascript">

		function submitbutton(pressbutton) {
			if (pressbutton == 'cancel' || pressbutton == 'iCalevents' || pressbutton == 'icalrepeats') {
				submitform( pressbutton );
				return;
			}
			var form = document.adminForm;
			<?php echo $editor->getContent( 'content' );  ?>
			// do field validation
			if (form.title.value == "") {
				alert ( "<?php echo html_entity_decode( "_E_WARNTITLE" ); ?>" );
			}
			else if (form.ics_id.value == "0"){
				alert( "<?php echo html_entity_decode( 'MISSING ICAL SELECTION' ); ?>" );
			}
			else if (form.valid_dates.value =="0"){
				alert( "Invalid dates - please correct" );
			}
			else {
				submitform(pressbutton);
			}
		}

		</script>
        <div class="adminform" align="left">
        <?php
        echo $tabs->startPane( 'jevent' );
        echo $tabs->startPanel( _CAL_LANG_TAB_COMMON, 'event' );
         ?>
            <?php 
            $native=true;
            if ( $row->icsid()>0){
            	$thisCal = $this->dataModel->queryModel->getIcalByIcsid( $row->icsid());
            	if (isset($thisCal) && $thisCal->icaltype==0){
          			// note that icaltype = 0 for imported from URL, 1 for imported from file, 2 for created natively
					echo "<h3>This event is imported from a URL - any changes you make will be lost if you refresh the source</h3>";
	            	$native=false;
            	}
            	else if(isset($thisCal) && $thisCal->icaltype==1){
          			// note that icaltype = 0 for imported from URL, 1 for imported from file, 2 for created natively
					echo "<h3>This event is imported from a file - any changes you make will be lost if you refresh the source</h3>";
	            	$native=false;
            	}
            }
            if ($native){
	        	echo '<div style="margin-bottom:20px;">';
            	// get all the raw native calendars
            	$nativeCals = $this->dataModel->queryModel->getNativeIcalendars();
				?>
				<script type="text/javascript" language="Javascript">
				function preselectCategory(select){
					var lookup = new Array();
					lookup[0]=0;
					<?php
					foreach ($nativeCals as $nc) {
						echo 'lookup['.$nc->ics_id.']='.$nc->catid.';';
					}
					?>
					document.adminForm['catid'].value=lookup[select.value];
				}
				</script>
		        <?php
	        	echo "Select Ical (from raw icals)";
            	$icalList = array();
            	$icalList[] = JHTML::_('select.option', '0', _CAL_LANG_EVENT_CHOOSE_ICAL, 'ics_id', 'label' );
            	$icalList = array_merge( $icalList, $nativeCals );
            	$clist = JHTML::_('select.genericlist', $icalList, 'ics_id', " onchange='preselectCategory(this);'", 'ics_id', 'label', $row->icsid() );

            	echo $clist;
	            echo "</div>\n";
            }
            else {
            	?>
            	<input type="hidden" name='ics_id' value="<?php echo  $row->icsid()?>" />
            	<?php
            }
             ?>
	        <table cellpadding="5" cellspacing="0" border="0" width="100%" class="adminform">
    			<tr>
                	<td width="10%" align="left"><?php echo _CAL_LANG_EVENT_TITLE; ?>:</td>
                    <td colspan="3">
                    	<input class="inputbox" type="text" name="title" size="50" maxlength="100" value="<?php echo mosEventsHtml::special($row->title()); ?>" />
                    </td>
      			</tr>
                <tr>
	                <?php
					if ($repeatId==0) {
                	?>
                	<td valign="top" align="left"><?php echo _CAL_LANG_EVENT_CATEGORY; ?></td>
                    <td style="width:200px" >
                    <?php mosEventsHTML::buildCategorySelect($row->catid(), '') ?>
                    </td>
	                <?php
	                }
	                if (isset($glist)) {?>
                    <td width="10%" align="left"><?php echo _CAL_LANG_EVENT_ACCESSLEVEL; ?></td>
                    <td><?php echo $glist; ?></td>
                    <?php } 
                   	echo "<td/><td/>\n";
					if ($repeatId!=0) {
	                	echo "<td/><td/>\n";
	                }
				?>
				</tr>
                 <tr>
                 	<td valign="top" align="left">
                    <?php echo _CAL_LANG_EVENT_ACTIVITY; ?>
                    </td>
                    <td style="width:600px"colspan="3">
                    <?php
                    // parameters : areaname, content, hidden field, width, height, rows, cols
                    echo $editor->display( 'content',  mosEventsHtml::special($row->content()) ,  "100%", 250, '70', '10' ) ;
 					?>
                    </td>
                 </tr>
                 <tr>
                 	<td width="130" align="left"><?php echo _CAL_LANG_EVENT_ADRESSE; ?></td>
                    <td colspan="3">
                    <input class="inputbox" type="text" name="location" size="80" maxlength="120" value="<?php echo mosEventsHtml::special($row->location()); ?>" />
                    </td>
                 </tr>
                 <tr>
                    <td align="left"><?php echo _CAL_LANG_EVENT_CONTACT; ?></td>
                    <td colspan="3">
                    <input class="inputbox" type="text" name="contact_info" size="80" maxlength="120" value="<?php echo mosEventsHtml::special($row->contact_info()); ?>" />
                    </td>
    	          </tr>
	                <tr>
	                    <td align="left" valign="top"><?php echo _CAL_LANG_EVENT_EXTRA; ?></td>
	                    <td>
	                    	<textarea class="text_area" name="extra_info" id="extra_info" cols="50" rows="4" maxlength="240" wrap="virtual"><?php echo mosEventsHtml::special($row->extra_info()); ?></textarea>
	                    </td>
	                </tr>
                  
            </table>
			<?php
			echo $tabs->endPanel();
			echo $tabs->startPanel( _CAL_LANG_TAB_CALENDAR, 'calendar' );
            ?>
            
			<fieldset><legend>Start, End, Duration</legend>
            <span>
				<span style="font-weight:bold"><?php echo _CAL_LANG_EVENT_ALLDAY;?></span>
				<span><input type="checkbox" id='allDayEvent' name='allDayEvent' <?php echo $row->alldayevent()?"checked":"";?> onclick="toggleAllDayEvent();" />
				</span>
            </span>
			<span style="margin:20px">
				<span style="font-weight:bold">12 Hour</span>
				<span><input type="checkbox" id='view12Hour' name='view12Hour' <?php echo !$clock24 ?"checked":"";?> onclick="toggleView12Hour();" value="1"/>
				</span>
			</span>
            <div style="float:left">
                <fieldset><legend><?php echo _CAL_LANG_EVENT_STARTDATE; ?></legend>
                <div style="float:left">
					<?php
					echo JHTML::calendar($row->startDate(), 'publish_up', 'publish_up', '%Y-%m-%d',
					array('size'=>'12',
					'maxlength'=>'10',
					'onchange'=>'checkDates(this);fixRepeatDates();'));
					?>
                 </div>
                 <div style="float:left;margin-left:20px!important;">
                    <?php echo _CAL_LANG_EVENT_STARTTIME."&nbsp;"; ?>
					<span id="start_24h_area" style="display:inline">
                    <input class="inputbox" type="text" name="start_time" id="start_time" size="8" <?php echo $row->alldayevent()?"disabled":"";?> maxlength="8" value="<?php echo $row->startTime();?>" onchange="checkTime(this);"/>
					</span>
					<span id="start_12h_area" style="display:inline">
                   	<input class="inputbox" type="text" name="start_12h" id="start_12h" size="8" maxlength="8" <?php echo $row->alldayevent()?"disabled":"";?> value="" onchange="check12hTime(this);" />
              		<input type="radio" name="start_ampm" id="startAM" value="none" checked onclick="toggleAMPM('startAM');" <?php echo $row->alldayevent()?"disabled":"";?>>am
              		<input type="radio" name="start_ampm" id="startPM" value="none" onclick="toggleAMPM('startPM');" <?php echo $row->alldayevent()?"disabled":"";?>>pm
					<span>
                 </div>
                 </fieldset>
             </div>
            <div style="float:left">
                <fieldset><legend><?php echo _CAL_LANG_EVENT_ENDDATE; ?></legend>
                <div style="float:left">
 					<?php
 					echo JHTML::calendar($row->endDate(), 'publish_down', 'publish_down', '%Y-%m-%d',
 					array('size'=>'12',
 					'maxlength'=>'10',
 					'onchange'=>'checkDates(this);'));
					?>
                 </div>
                 <div style="float:left;margin-left:20px!important">
                     <?php echo _CAL_LANG_EVENT_ENDTIME."&nbsp;"; ?>
					<span id="end_24h_area" style="display:inline">
                   	<input class="inputbox" type="text" name="end_time" id="end_time" size="8" maxlength="8" <?php echo $row->alldayevent()?"disabled":"";?> value="<?php echo $row->endTime();?>" onchange="checkTime(this);" />
					</span>
					<span id="end_12h_area" style="display:inline">
                   	<input class="inputbox" type="text" name="end_12h" id="end_12h" size="8" maxlength="8" <?php echo $row->alldayevent()?"disabled":"";?> value="" onchange="check12hTime(this);" />
              		<input type="radio" name="end_ampm" id="endAM" value="none" checked onclick="toggleAMPM('endAM');" <?php echo $row->alldayevent()?"disabled":"";?>>am
              		<input type="radio" name="end_ampm" id="endPM" value="none" onclick="toggleAMPM('endPM');" <?php echo $row->alldayevent()?"disabled":"";?>>pm
					</span>
                 </div>
                 </fieldset>
             </div>
             </fieldset>
             <div <?php echo $repeatStyle;?>>
			 <!-- REPEAT FREQ -->
             <div style="clear:both;">
				<fieldset><legend><?php echo _CAL_LANG_EVENT_REPEATTYPE; ?></legend>
                <table border="0" cellspacing="2">
                	<tr>                                	
                    <td ><input type="radio" name="freq" id="NONE" value="none" checked onclick="toggleFreq('NONE');">No Repeat</td>
                    <td ><input type="radio" name="freq" id="DAILY" value="DAILY" onclick="toggleFreq('DAILY');">Daily</td>
                    <td ><input type="radio" name="freq" id="WEEKLY" value="WEEKLY" onclick="toggleFreq('WEEKLY');">Weekly</td>
                    <td ><input type="radio" name="freq" id="MONTHLY" value="MONTHLY" onclick="toggleFreq('MONTHLY');">Monthly</td>
                    <td ><input type="radio" name="freq" id="YEARLY" value="YEARLY" onclick="toggleFreq('YEARLY');">Yearly</td>
                    </tr>
				</table>
                </fieldset>
			</div>			
           <!-- END REPEAT FREQ-->
           <div style="clear:both;display:none" id="interval_div">
           		<div style="float:left">
           		<fieldset><legend><?php echo "Repeat Interval" ?></legend>
                    <input class="inputbox" type="text" name="rinterval" id="rinterval" size="2" maxlength="2" value="<?php echo $row->interval();?>" onchange="checkInterval();" /><span id='interval_label' style="margin-left:1em"></span>
           		</fieldset>
           		</div>
           		<div style="float:left;margin-left:20px!important"  id="cu_count" >
           		<fieldset><legend><input type="radio" name="countuntil"value="count" id="cuc" checked onclick="toggleCountUntil('cu_count');"><?php echo "Repeat Count" ?></legend>
                    <input class="inputbox" type="text" name="count" id="count" size="2" maxlength="2" value="<?php echo $row->count();?>" onchange="checkInterval();" /><span id='count_label' style="margin-left:1em">repeats</span>
           		</fieldset>
           		</div>
           		<div style="float:left;margin-left:20px!important;" id="cu_until">
           		<fieldset style="background-color:#dddddd"><legend><input type="radio" name="countuntil" value="until" id="cuu" onclick="toggleCountUntil('cu_until');"><?php echo "Repeat Until" ?></legend>
					<?php echo JHTML::calendar(strftime("%Y-%m-%d",$row->until()), 'until', 'until', '%Y-%m-%d',
												array('size'=>'12','maxlength'=>'10'));?>

           		</fieldset>
           		</div>
           </div>
           <br style="clear:both;"/>
           <div  style="float:left;display:none" id="byyearday">
           		<fieldset><legend><input type="radio" name="whichby" id="byd" value="byd"  onclick="toggleWhichBy('byyearday');"><?php echo "By Year Day" ?></legend>
           			Comma separated list
                    <input class="inputbox" type="text" name="byyearday" size="20" maxlength="20" value="<?php echo $row->byyearday();?>" onchange="checkInterval();" />
           			<br/>Count back from year end<input type="checkbox" name="byd_direction"  <?php echo $row->getByDirectionChecked("byyearday");?>/>
           		</fieldset>
           </div>
           <div  style="float:left;display:none" id="bymonth">
           		<fieldset><legend><input type="radio" name="whichby"  id="bm" value="bm"  onclick="toggleWhichBy('bymonth');"><?php echo "By Month" ?></legend>
           			Comma separated list
                    <input class="inputbox" type="text" name="bymonth" size="30" maxlength="20" value="<?php echo $row->bymonth();?>" onchange="checkInterval();" />
                </fieldset>
           </div>
           <div  style="float:left;display:none" id="byweekno">
           		<fieldset><legend><input type="radio" name="whichby"  id="bwn" value="bwn"  onclick="toggleWhichBy('byweekno');"><?php echo "By Week No" ?></legend>
           			Comma separated list
                    <input class="inputbox" type="text" name="byweekno" size="20" maxlength="20" value="<?php echo $row->byweekno();?>" onchange="checkInterval();" />
           			<br/>Count back from year end<input type="checkbox" name="bwn_direction"  <?php echo $row->getByDirectionChecked("byweekno");?>>
                </fieldset>
           </div>
           <div  style="float:left;display:none" id="bymonthday">
           		<fieldset><legend><input type="radio" name="whichby"  id="bmd" value="bmd"  onclick="toggleWhichBy('bymonthday');"><?php echo "By Month Day" ?></legend>
           			Comma separated list
                    <input class="inputbox" type="text" name="bymonthday" size="30" maxlength="20" value="<?php echo $row->bymonthday();?>" onchange="checkInterval();" />
           			<br/>Count back from month end<input type="checkbox" name="bmd_direction"   <?php echo $row->getByDirectionChecked("bymonthday");?>/>
                </fieldset>
           </div>
		   <div  style="float:left;display:none" id="byday">
		   		<fieldset><legend><input type="radio" name="whichby"  id="bd" value="bd"  onclick="toggleWhichBy('byday');"><?php echo "By Day" ?></legend>           			
                    <?php 
                    mosEventsHTML::buildWeekDaysCheck( $row->getByDay_days(), '' ,"weekdays");
                    ?>
                    <div id="weekofmonth">
           			<?php
           			mosEventsHTML::buildWeeksCheck( $row->getByDay_weeks(), "" ,"weeknums");
                    ?>
           			<br/>Count back from month end<input type="checkbox" name="bd_direction" <?php echo $row->getByDirectionChecked("byday");?> />
                    </div>
           		</fieldset>
           </div>
		   <div  style="float:left;display:none" id="bysetpos">
		   		<fieldset><legend><?php echo "NOT YET SUPPORTED" ?></legend>
           		</fieldset>
           </div>
		</div>
		<script type="text/javascript" language="Javascript">
		// make the correct frequency visible
		function setupRepeats(){
			<?php
			if ($row->id()!=0 && $row->freq()){
				?>
				var freq = "<?php echo strtoupper($row->freq());?>";
				document.getElementById(freq).checked=true;
				toggleFreq(freq);
				var by = "<?php
				if ($row->byyearday(true)!="") echo "byd";
				else if ($row->bymonth(true)!="") echo "bm";
				else if ($row->bymonthday(true)!="") echo "bmd";
				else if ($row->byweekno(true)!="") echo "bwn";
				else if ($row->byday(true)!="") echo "bd";
				?>";
				document.getElementById(by).checked=true;
				var by = "<?php
				if ($row->byyearday(true)!="") echo "byyearday";
				else if ($row->bymonth(true)!="") echo "bymonth";
				else if ($row->bymonthday(true)!="") echo "bymonthday";
				else if ($row->byweekno(true)!="") echo "byweekno";
				else if ($row->byday(true)!="") echo "byday";
				?>";
				toggleWhichBy(by);
				var cu = "cu_<?php
				if ($row->rawuntil()!="") echo "until";
				else echo "count";
				?>";
				document.getElementById(cu=="cu_until"?"cuu":"cuc").checked=true;
				toggleCountUntil(cu);
				<?php
			}
			?>
		}
		//if (window.attachEvent) window.attachEvent("onload",setupRepeats);
		//else window.onload=setupRepeats;
		setupRepeats();
		// move to 12h fields
		set12hTime(document.adminForm.start_time);
		set12hTime(document.adminForm.end_time);
		// toggle unvisible time fields
		toggleView12Hour();
		</script>
		<?php
		echo $tabs->endPanel();

		// Plugins CAN BE LAYERED IN HERE
		global $params;
		// append array to extratabs keys content, title, paneid
		$extraTabs = array();
		$dispatcher	=& JDispatcher::getInstance();
		$dispatcher->trigger( 'onEventEdit' , array(&$extraTabs,&$row,&$params), true );
		if (count($extraTabs)>0) {
			foreach ($extraTabs as $extraTab) {
				echo $tabs->startPanel( $extraTab['title'], $extraTab['paneid'] );
				echo  $extraTab['content'];
				echo $tabs->endPanel();
			}
		}

		echo $tabs->endPane();
		//print_r($row);
		echo "</td></tr>\n";


		$this->_footer($task,$option);
	}

	function exportToIcal() {
		global $task;
		$cfg = & EventsConfig::getInstance();
		$option = $cfg->get("com_componentname", "com_events");
		$this->_header(' enctype="multipart/form-data" ');
		$catid=0;
		?>
		<table>
			<tr>
		    	<td style="font-weight:bold" colspan="2">
                Unique FileName : <input class="inputbox" type="text" name="icsFilename" id="icsFilename" size="80" />
                <br/>
                <br/>
                </td>
			</tr>
			<tr>
		    	<td style="width:200px" >
                <?php mosEventsHTML::buildCategorySelect($catid ,""); ?>
                </td>
				<td>
		<button name="exportToIcs"  title="Export To Ical" onclick="var icalfile=document.getElementById('icsFilename').value;if (icsfile.length==0)return false; else submitbutton('exporttoics')">Export Events to ICS File</button>
				</td>
			</tr>
			<tr>
		    	<td colspan="2">
		    	Download ICS Files? <input type="checkbox" title="Download File" name="showBR" id="showBR" checked/>
		    	</td>
		    </tr>
		</table>

		<?php
		$this->_footer($task,$option);
	}

	function showConfig( $option){//, $conf_style) {

		JHTML::_('behavior.tooltip');
		EventsHelper::loadOverlib();

		// get configuration object
		$cfg = & EventsConfig::getInstance();

		$version = EventsVersion::getInstance();

		$pathCompAdminRef = $this->live_site . "administrator/components/$option/";
		$pathCompAdminAbs = JPATH_ADMINISTRATOR . "/components/$option/";

		jimport('joomla.html.pane');
		$tabs = & JPane::getInstance('tabs');

		$configfile 	= JPATH_ADMINISTRATOR. '/components/' . $option . '/events_config.ini.php';
		//$cssfile 		= JPATH_BASE . '/components/' . $option . '/events_css.css';
		$writeConfig	= true;
		//$writeCss		= true;

		if( !is_writable( $configfile )){
			$writeConfig = false;
		}
		/*
		if( !is_writable( $cssfile )){
		$writeCss = false;
		}
		*/
		// define some lists ( should be done inside the admin.php [mic])
		$lists = array();

		?>

		<table border="0" cellpadding="0" cellspacing="0" width="95%">
			<tr>
				<td>
					&nbsp;
				</td>
				<td align="left" valign="bottom"> <span style="font-size:200%;"><?php echo _CAL_LANG_EVENTS_CONFIG; ?></span>&nbsp;[&nbsp;<?php echo $version->getShortVersion();?>&nbsp;<a href='<?php echo $version->getURL();?>'><?php echo _CAL_LANG_CHECK_VERSION;?> </a>]</td>
				<td align="left" valign="bottom">
					[&nbsp;
					<?php
					if( $writeConfig ){
						echo '<small style="color:green;">' . _CAL_LANG_CONFIG_WRITEABLE ;
					}else{
						echo '<small style="color:red;">' . _CAL_LANG_CONFIG_NOT_WRITEABLE;
					} ?>
					</small>&nbsp;]
				</td>
			</tr>
		</table>

		<form action="index2.php" method="post" name="adminForm">
            <?php
            // Include default config javascript
            defaultConfig(); ?>
            <input type="hidden" name="task" value="saveconfig" />
            <input type="hidden" name="option" value="<?php echo $option;?>" />
            <input type="hidden" name="conf_componentname" value="<?php echo $cfg->get('com_componentname','com_events');?>" />

            <table cellspacing="0" cellpadding="4" border="0" width="100%">
                <tr>
                    <td>
                        <?php
                        echo $tabs->startPane( 'configs' );
                        echo $tabs->startPanel( _CAL_LANG_TAB_COMPONENT." 1", 'config_com_admin' ); ?>
                    	<table width="100%" border="0" cellpadding="2" cellspacing="0" class="adminForm">
				        	<tr>
				        		<td colspan="2" style="color:#993300; font-weight:bold; font-size:8pt;">
				        			<?php echo _CAL_LANG_SETT_FOR_COM; ?>
				        		</td>
				        	</tr>
                            <tr>
    							<td width="265"><?php echo _CAL_LANG_ADMIN_EMAIL; ?></td>
    							<td>
    								<input type="text" name="conf_adminmail" size="30" maxlength="50" value="<?php echo $cfg->get('com_adminmail');?>" />
    							</td>
    						</tr>
    						<tr>
    							<td><?php echo $this->tip(_CAL_LANG_TIP_ACCESS, _CAL_LANG_ACCESS); ?></td>
    							<td>
    								<?php
    								$level[] = JHTML::_('select.option', '0', _CAL_LANG_SEL_ACCESS_ALL_REGGED );
    								$level[] = JHTML::_('select.option', '1', _CAL_LANG_SEL_ACCESS_SPECIAL );
    								$level[] = JHTML::_('select.option', '2', _CAL_LANG_SEL_ACCESS_ALL_ANONYM );

    								$tosend = JHTML::_('select.genericlist', $level, 'conf_adminlevel', '', 'value', 'text', $cfg->get('com_adminlevel'));
    								echo $tosend;
									?>
                                </td>
                            </tr>
                            <tr>
                            	<td>
                            		<?php echo $this->tip(_CAL_LANG_TIP_FRONT_PUB, _CAL_LANG_FRONTEND_PUBLISHING); ?>
                            	</td>
                            	<td>
                            		<?php
                            		$publevel = array();
                            		$publevel[] = JHTML::_('select.option', '1', _CAL_LANG_SEL_ACCESS_ALL_REGGED );
                            		$publevel[] = JHTML::_('select.option', '2', _CAL_LANG_SEL_ACCESS_ALL_AUTHORS );
                            		$publevel[] = JHTML::_('select.option', '3', _CAL_LANG_SEL_ACCESS_ALL_EDITORS );
                            		$publevel[] = JHTML::_('select.option', '4', _CAL_LANG_SEL_ACCESS_ALL_PUBLISHERS );
                            		$publevel[] = JHTML::_('select.option', '5', _CAL_LANG_SEL_ACCESS_ALL_MANAGERS );
                            		$publevel[] = JHTML::_('select.option', '6', _CAL_LANG_SEL_ACCESS_ALL_ADMIN );
                            		echo  JHTML::_('select.genericlist', $publevel,'conf_frontendPublish', '','value','text', $cfg->get('com_frontendPublish'));
                                    ?>
                                </td>
                            </tr>
                            <tr>
                            	<td><?php echo _CAL_LANG_DATE_FORMAT; ?></td>
                            	<td>
                            		<?php
                            		$datef[] = JHTML::_('select.option', '0', _CAL_LANG_DATE_FORMAT_FR_EN );
                            		$datef[] = JHTML::_('select.option', '1', _CAL_LANG_DATE_FORMAT_US );
                            		$datef[] = JHTML::_('select.option', '2', _CAL_LANG_DATE_FORMAT_GERMAN );
                            		$tosend = JHTML::_('select.genericlist', $datef, 'conf_dateformat', '', 'value', 'text', $cfg->get('com_dateformat'));
                                    echo $tosend; ?>
                                </td>
                            </tr>
                            <tr>
                            	<td><?php echo _CAL_LANG_TIME_FORMAT_12; ?></td>
                            	<td>
                            		<?php
                            		$lists['stdTime'] = JHTML::_('select.booleanlist', 'conf_calUseStdTime', '', $cfg->get('com_calUseStdTime'));
                                    echo $lists['stdTime']; ?>
                                </td>
                            </tr>
                            <tr>
                            	<td><?php echo $this->tip(_CAL_LANG_TIP_FE_SIMPLE_FORM, _CAL_LANG_FE_SIMPLE_FORM); ?></td>
                                <td>
                                    <?php
                                    $lists['formOpt'] = JHTML::_('select.booleanlist', 'conf_calSimpleEventForm', '', $cfg->get('com_calSimpleEventForm'));
                                    echo $lists['formOpt']; ?>
                                </td>
                            </tr>
                            <tr>
                            	<td><?php echo _CAL_LANG_DEF_EVENT_COLOR; ?></td>
                            	<td>
                            		<?php
                            		$defColor[] = JHTML::_('select.option', 'random',	_CAL_LANG_DEF_EC_RANDOM );
                            		$defColor[] = JHTML::_('select.option', 'none',		_CAL_LANG_DEF_EC_NONE );
                            		$defColor[] = JHTML::_('select.option', 'category',	_CAL_LANG_DEF_EC_CATEGORY );

                            		//$tosend = JHTML::_('select.genericlist', $defColor, 'conf_defColor', '', 'value', 'text', $conf_defColor );
                            		$lists['defColor'] = JHTML::_('select.radiolist', $defColor, 'conf_defColor', '',  'value', 'text',$cfg->get('com_defColor') );
                                    echo $lists['defColor']; ?>
                                </td>
                            </tr>
                            <tr>
                            	<td><?php echo _CAL_STOP_ROBOTS; ?></td>
                            	<td>
                            		<?php
                            		$lists['robots'] = JHTML::_('select.booleanlist', 'conf_blockRobots', '', $cfg->get('com_blockRobots',1));
                                    echo $lists['robots']; ?>
                                </td>
                            </tr>
                            <tr>
                            	<td><?php echo $this->tip(_CAL_LANG_TIP_DEF_EC_HIDE_FORCE, _CAL_LANG_DEF_EC_HIDE_FORCE); ?></td>
                            	<td>
                            		<?php
                            		//$lists['colCatOpt'] = JHTML::_('select.booleanlist', 'conf_calForceCatColorEventForm', '', $cfg->get('com_calForceCatColorEventForm'));
                            		//echo $lists['colCatOpt'];
                            		$evcols = array();
                            		$evcols[] = JHTML::_('select.option', '0',	_CAL_LANG_EVENT_COLS_ALLOWED );
                            		$evcols[] = JHTML::_('select.option', '1',	_CAL_LANG_EVENT_COLS_BACKED );
                            		$evcols[] = JHTML::_('select.option', '2',   _CAL_LANG_ALWAYS_CAT_COLOR );

                            		$tosend = JHTML::_('select.genericlist', $evcols, 'conf_calForceCatColorEventForm', '', 'value', 'text', $cfg->get('com_calForceCatColorEventForm'));
                            		echo $tosend;
									?>
                                </td>
                            </tr>
                            <tr>
                            	<td><?php echo $this->tip("Choose yes if you wish to continue to display old style Events - support may not continue after version 1.5","Support Legacy Events"); ?></td>
                                <td>
                                    <?php
                                    $legacyOpt = JHTML::_('select.booleanlist', 'conf_legacyEvents', '', $cfg->get('com_legacyEvents',1));
                                    echo $legacyOpt; ?>
                                </td>
                            </tr>
							<tr>
								<td>
									<input class="inputbox" type="button" name="default_config" size="20" value="<?php echo _CAL_LANG_BTN_DEF_CONFIG;?>" onclick="defaultConfig_com()"/>&nbsp;
									<?php
									$tip = _CAL_LANG_TIP_BTN_DEF_CONFIG;
				        			echo $this->tip( $tip ); ?>
								</td>
							</tr>
    					</table>
                        
                        <?php
                        echo $tabs->endPanel();
                        echo $tabs->startPanel( _CAL_LANG_TAB_COMPONENT." 2", 'config_com_view' );
                        ?>
                    	<table width="100%" border="0" cellpadding="2" cellspacing="0" class="adminForm">
				        	<tr>
				        		<td colspan="2" style="color:#993300; font-weight:bold; font-size:8pt;">
				        			<?php echo _CAL_LANG_SETT_FOR_COM; ?>
				        		</td>
				        	</tr>
                            <tr>
                            	<td><?php echo $this->tip(_CAL_LANG_TIP_VIEWNAME, _CAL_LANG_VIEWNAME); ?><br/><b>[Load thse from directory names]</b></td>
                            	<td>
                            		<?php
                            		$views = array();
                            		$views[] = JHTML::_('select.option', 'default',	_CAL_LANG_VIEW_DEFAULT );
                            		$views[] = JHTML::_('select.option', 'alternative',	_CAL_LANG_VIEW_ALTERNATIVE );
                            		$views[] = JHTML::_('select.option', 'ext',	"EXT (translate me)" );
                            		$views[] = JHTML::_('select.option', 'geraint',	"Geraint (need name)" );

                            		$tosend = JHTML::_('select.genericlist', $views, 'conf_calViewName', '', 'value', 'text', $cfg->get('com_calViewName'));
                                    echo $tosend; ?>
                                </td>
                            </tr>
                            <tr>
                            	<td><?php echo _CAL_LANG_ICONIC_NAVBAR; ?></td>
                            	<td>
                            		<?php
                            		$lists['iconic'] = JHTML::_('select.booleanlist', 'conf_calUseIconic', '', $cfg->get('com_calUseIconic'));
                                    echo $lists['iconic']; ?>
                                </td>
                            </tr>
                            <tr>
                            	<td><?php echo _CAL_LANG_NAV_BAR_COLOR; ?></td>
                            	<td>
                            		<?php
                            		$navcol[] = JHTML::_('select.option', 'green',	_CAL_LANG_NAV_BAR_GREEN );
                            		$navcol[] = JHTML::_('select.option', 'orange',	_CAL_LANG_NAV_BAR_ORANGE );
                            		$navcol[] = JHTML::_('select.option', 'blue', 	_CAL_LANG_NAV_BAR_BLUE );
                            		$navcol[] = JHTML::_('select.option', 'red', 	_CAL_LANG_NAV_BAR_RED );
                            		$navcol[] = JHTML::_('select.option', 'gray', 	_CAL_LANG_NAV_BAR_GRAY );
                            		$navcol[] = JHTML::_('select.option', 'yellow', 	_CAL_LANG_NAV_BAR_YELLOW );

                            		$tosend = JHTML::_('select.genericlist', $navcol, 'conf_navbarcolor', '', 'value', 'text', $cfg->get('com_navbarcolor'));
                                    echo $tosend; ?>
                                </td>
                            </tr>
                            <tr>
    							<td width="265"><?php echo _CAL_LANG_EARLIEST_YEAR; ?></td>
    							<td>
    								<input type="text" name="conf_earliestyear" size="4" maxlength="4" value="<?php echo $cfg->get('com_earliestyear',1995);?>" />
    							</td>
    						</tr>
                            <tr>
    							<td width="265"><?php echo _CAL_LANG_LATEST_YEAR; ?></td>
    							<td>
    								<input type="text" name="conf_latestyear" size="4" maxlength="4" value="<?php echo $cfg->get('com_latestyear',2015);?>" />
    							</td>
    						</tr>
                            <tr>
                            	<td><?php echo _CAL_LANG_START_PAGE; ?></td>
                            	<td>
                            		<?php
                            		$startpg[] = JHTML::_('select.option', 'view_day',	_CAL_LANG_SP_DAY );
                            		$startpg[] = JHTML::_('select.option', 'view_week',	_CAL_LANG_SP_WEEK );
                            		$startpg[] = JHTML::_('select.option', 'view_month', _CAL_LANG_SP_MONTH_CAL );
                            		$startpg[] = JHTML::_('select.option', 'view_last',	_CAL_LANG_SP_MONTH_LIST );
                            		$startpg[] = JHTML::_('select.option', 'view_year',	_CAL_LANG_SP_YEAR );
                            		$startpg[] = JHTML::_('select.option', 'view_cat',	_CAL_LANG_SP_CATEGORIES );
                            		$startpg[] = JHTML::_('select.option', 'view_search', _CAL_LANG_SP_SEARCH );

                            		$tosend = JHTML::_('select.genericlist', $startpg, 'conf_startview', '', 'value', 'text', $cfg->get('com_startview'));
                                    echo $tosend; ?>
                                </td>
                            </tr>
                            <tr>
                            	<td><?php echo _CAL_LANG_FIRST_DAY; ?></td>
                            	<td>
                            		<?php
                            		$first[] = JHTML::_('select.option', '0', _CAL_LANG_SUNDAY_FIRST );
                            		$first[] = JHTML::_('select.option', '1', _CAL_LANG_MONDAY_FIRST );
                            		$tosend = JHTML::_('select.genericlist', $first, 'conf_starday', '', 'value', 'text', $cfg->get('com_starday'));
                                    echo $tosend; ?>
                                </td>
                            </tr>
                            <tr>
                            	<td><?php echo _CAL_LANG_SHOW_CATS; ?></td>
                            	<td>
                            		<?php
                            		echo  JHTML::_('select.booleanlist', 'conf_hideshowbycats', '', $cfg->get('com_hideshowbycats'));
                                    ?>
                                </td>
                            </tr>
      						<tr>
								<td width="265"><?php echo $this->tip(_CAL_LANG_HIDE_LINKS_TIP, _CAL_LANG_HIDE_LINKS); ?></td>
								<td>
								<?php
								echo  JHTML::_('select.booleanlist', 'conf_linkcloaking', '', $cfg->get('com_linkcloaking'));
								?>
								</td>
	  						</tr>
                            <tr>
                            	<td><?php echo _CAL_LANG_SHOW_COPYRIGHT; ?></td>
                            	<td>
                            		<?php
                            		echo  JHTML::_('select.booleanlist', 'conf_copyright', '', $cfg->get('com_copyright', 1));
                                    ?>
                                </td>
                            </tr>
				        	<tr>
				        		<td colspan="2" style="color:#993300; font-weight:bold; font-size:8pt;">
				        			<?php echo "Settings related to Event Detail"; ?>
				        		</td>
				        	</tr>
                            <tr>
                            	<td><?php echo _CAL_LANG_VIEW_MAIL; ?></td>
                            	<td>
                            		<?php
                            		echo  JHTML::_('select.booleanlist', 'conf_mailview', '', $cfg->get('com_mailview'));
                                    ?>
                                </td>
                            </tr>
                            <tr>
                            	<td><?php echo _CAL_LANG_VIEW_BY; ?></td>
                            	<td>
									<?php
									echo  JHTML::_('select.booleanlist', 'conf_byview', '', $cfg->get('com_byview'));
									?>
                                </td>
                            </tr>
                            <tr>
                            	<td><?php echo _CAL_LANG_VIEW_HITS; ?></td>
                            	<td>
                            		<?php
                            		echo  JHTML::_('select.booleanlist', 'conf_hitsview', '', $cfg->get('com_hitsview'));
                                    ?>
                                </td>
                            </tr>
                            <tr>
                            	<td><?php echo _CAL_LANG_VIEW_REPEAT_TIME; ?></td>
                            	<td>
                            		<?php
                            		echo  JHTML::_('select.booleanlist', 'conf_repeatview', '', $cfg->get('com_repeatview'));
									?>
                                </td>
                            </tr>
				        	<tr>
				        		<td colspan="2" style="color:#993300; font-weight:bold; font-size:8pt;">
				        			<?php echo "Settings related to Monthly View"; ?>
				        		</td>
				        	</tr>
                            <tr>
                            	<td><?php echo $this->tip(_CAL_LANG_TIP_CUT_TITLE, _CAL_LANG_CUT_TITLE); ?></td>
                            	<td>
                            		<input type="text" size="2" name="conf_calCutTitle" value="<?php echo $cfg->get('com_calCutTitle'); ?>" />
                            	</td>
                            </tr>
                            <tr>
                            	<td><?php echo $this->tip(_CAL_LANG_TIP_MAX_DISPLAY, _CAL_LANG_MAX_DISPLAY); ?></td>
                            	<td>
                            		<input type="text" size="2" name="conf_calMaxDisplay" value="<?php echo $cfg->get('com_calMaxDisplay'); ?>" />
                            	</td>
                            </tr>
                            <tr>
                            	<td><?php echo $this->tip(_CAL_LANG_TIP_DIS_STARTTIME, _CAL_LANG_DIS_STARTTIME); ?></td>
                        	    <td>
                                    <?php 
                                    $lists['dis_starttime'] = JHTML::_('select.booleanlist',  'conf_calDisplayStarttime', 'class="inputbox"', $cfg->get('com_calDisplayStarttime'));
									echo $lists['dis_starttime']; ?>
                            	</td>
                            </tr>
				        	<tr>
				        		<td colspan="2" style="color:#993300; font-weight:bold; font-size:8pt;">
				        			<?php echo "Other Calendar display settings"; ?>
				        		</td>
				        	</tr>
                            <tr>
                            	<td><?php echo _CAL_LANG_VIEW_REPEAT_YEAR_LIST; ?></td>
                            	<td>
                            		<?php
                            		echo  JHTML::_('select.booleanlist', 'conf_showrepeats', '', $cfg->get('com_showrepeats'));
                                    ?>
                                </td>
                            </tr>
                            <tr>
                            	<td><?php echo $this->tip(_CAL_LANG_TIP_NR_OF_LIST, _CAL_LANG_NR_OF_LIST); ?></td>
                            	<td>
                            		<input type="text" size="3" name="conf_calEventListRowsPpg" value="<?php echo $cfg->get('com_calEventListRowsPpg'); ?>" />
                            	</td>
                            </tr>
							<tr>
								<td>
									<input class="inputbox" type="button" name="default_config" size="20" value="<?php echo _CAL_LANG_BTN_DEF_CONFIG;?>" onclick="defaultConfig_com()"/>&nbsp;
									<?php
									$tip = _CAL_LANG_TIP_BTN_DEF_CONFIG;
				        			echo $this->tip( $tip ); ?>
								</td>
							</tr>
    					</table>

                        <?php
                        echo $tabs->endPanel();
                        echo $tabs->startPanel( _CAL_LANG_TAB_RSS, 'config_rss' );
                        ?>
				        <table width="100%" border="0" cellpadding="2" cellspacing="0" class="adminForm">
				        	<tr>
				        		<td colspan="2" style="color:#993300; font-weight:bold; font-size:8pt;">
				        			<?php echo _CAL_LANG_SETT_FOR_RSS; ?>
				        		</td>
				        	</tr>
				        	<tr>
                            	<td width="265"><?php echo _CAL_RSS_CACHE; ?></td>
                            	<td>
									<?php
									echo  JHTML::_('select.booleanlist', 'conf_rss_cache', '', $cfg->get('com_rss_cache'));
									?>
                                </td>
                            </tr>
				        	<tr>
				        		<td><?php echo _CAL_RSS_CACHE; ?></td>
				        		<td>
				        			<input type=text size=6 name="conf_rss_cache_time" value="<?php echo $cfg->get('com_rss_cache_time'); ?>" />
				        		</td>
				        	</tr>
				        	<tr>
				        		<td><?php echo _CAL_RSS_LIMIT; ?></td>
				        		<td>
				        			<input type=text size=3 name="conf_rss_count" value="<?php echo $cfg->get('com_rss_count'); ?>" />
				        		</td>
				        	</tr>
				        	<tr>
				        		<td><?php echo _CAL_RSS_TITLE; ?></td>
				        		<td>
				        			<input type=text size=80 name="conf_rss_title" value="<?php echo $cfg->get('com_rss_title'); ?>" />
				        		</td>
				        	</tr>
				        	<tr>
				        		<td><?php echo _CAL_RSS_DESCRIPTION; ?></td>
				        		<td>
                                	<textarea class="text_area" name="conf_rss_description" id="conf_rss_description" cols="50" rows="4" maxlength="240" wrap="virtual"><?php echo $cfg->get('com_rss_description'); ?></textarea>

				        		</td>
				        	</tr>
				        	<tr>
				        		<td colspan="2"><h2>More CONFIG to GO HERE</h2></td>
				        	</tr>
				        	<tr>
                            	<td width="265"><?php echo _CAL_RSS_LIMIT_TEXT_LENGTH; ?></td>
                            	<td>
									<?php
									echo  JHTML::_('select.booleanlist', 'conf_rss_limit_text', '', $cfg->get('com_rss_limit_text'));
									?>
                                </td>
                            </tr>
				        	<tr>
				        		<td><?php echo _CAL_RSS_TEXT_LIMIT; ?></td>
				        		<td>
				        			<input type=text size=3 name="conf_rss_text_length" value="<?php echo $cfg->get('com_rss_text_length'); ?>" />
				        		</td>
				        	</tr>
				        	
<?php
/*
define( '_CAL_RSS_DESCRIPTION',			'RSS Description' );
define( '_CAL_RSS_IMAGE',				'Image to be included in Feed' );
define( '_CAL_RSS_IMAGE_ALT',			'Alternative Text for image' );
define( '_CAL_RSS_LIMIT_TEXT_LENGHT',	'Limit Text Length' );
define( '_CAL_RSS_TEXT_LIMIT',			'Text Limit' );
define( '_CAL_RSS_LIVE_BOOMARKS',		'Live Bookmarks' );
*/
?>

                        </table>
                     	<?php
                     	echo $tabs->endPanel();
                     	echo $tabs->startPanel( _CAL_LANG_TAB_CAL_MOD, 'config_cal_mod' );

                     	if( file_exists( $pathCompAdminAbs . 'help/mod_events_calendar_help_' . _CAL_LANG_LNG . '.html' )){
                     		$jeventHelp = $pathCompAdminRef . 'help/mod_events_calendar_help_' . _CAL_LANG_LNG . '.html';
                     	}else{
                     		$jeventHelp = $pathCompAdminRef . 'help/mod_events_calendar_help_en.html';
                        } ?>
				        <table width="100%" border="0" cellpadding="2" cellspacing="0" class="adminForm">
				        	<tr>
				        		<td colspan="2" style="color:#993300; font-weight:bold; font-size:8pt;">
				        			<?php echo _CAL_LANG_SETT_FOR_CAL_MOD . '&nbsp';
				        			echo $this->help($jeventHelp) . '&nbsp';
				        			if( !file_exists( JPATH_SITE . '/modules/mod_events_cal/mod_events_cal.php' )){
				        				$tip = _CAL_LANG_MSG_MOD_NOT_INSTALLED;
				        				echo $this->jevWarning( $tip );
				        			} ?>
				        		</td>
				        	</tr>
				        	<tr>
				        		<td width="265"><?php echo _CAL_LANG_DISPLAY_LAST_MONTH; ?></td>
				        		<td>
				        			<?php
				        			$dispLmnth[] = JHTML::_('select.option', 'NO', 		_CAL_LANG_NO );
				        			$dispLmnth[] = JHTML::_('select.option', 'YES_stop', _CAL_LANG_DLM_YES_STOP_DAY );
				        			$dispLmnth[] = JHTML::_('select.option', 'YES_stop_events', _CAL_LANG_DLM_YES_EVENT_SDAY );
				        			$dispLmnth[] = JHTML::_('select.option', 'ALWAYS', 	_CAL_LANG_ALWAYS );
				        			$dispLmnth[] = JHTML::_('select.option', 'ALWAYS_events', _CAL_LANG_DLM_ALWYS_IF_EVENTS );

				        			$tosend = JHTML::_('select.genericlist', $dispLmnth, 'conf_modCalDispLastMonth', '', 'value', 'text', $cfg->get('modcal_DispLastMonth'));
                                    echo $tosend; ?>
                                </td>
                            </tr>
                            <tr>
                            	<td><?php echo $this->tip(_CAL_LANG_TIP_DLM_STOP_DAY, _CAL_LANG_DLM_STOP_DAY); ?></td>
                            	<td>
                            		<input type=text size=2 name="conf_modCalDispLastMonthDays" value="<?php echo $cfg->get('modcal_DispLastMonthDays'); ?>" />
                            	</td>
                            </tr>
                            <tr>
                            	<td><?php echo _CAL_LANG_DISPLAY_NEXT_MONTH; ?></td>
                            	<td>
                            		<?php
                            		$dispNmnth[] = JHTML::_('select.option', 'NO', 		_CAL_LANG_NO );
                            		$dispNmnth[] = JHTML::_('select.option', 'YES_stop',	_CAL_LANG_DNM_YES_START_DAY );
                            		$dispNmnth[] = JHTML::_('select.option', 'YES_stop_events', _CAL_LANG_DNM_YES_EVENT_SDAY );
                            		$dispNmnth[] = JHTML::_('select.option', 'ALWAYS',	_CAL_LANG_ALWAYS );
                            		$dispNmnth[] = JHTML::_('select.option', 'ALWAYS_events', _CAL_LANG_DNM_ALWYS_IF_EVENTS );

                            		$tosend = JHTML::_('select.genericlist', $dispNmnth, 'conf_modCalDispNextMonth', '', 'value', 'text', $cfg->get('modcal_DispNextMonth'));
                                    echo $tosend; ?>
                                </td>
                            </tr>
                            <tr>
                            	<td><?php echo $this->tip(_CAL_LANG_TIP_DNM_START_DAY, _CAL_LANG_DNM_START_DAY); ?></td>
                            	<td>
                            		<input type=text size=2 name="conf_modCalDispNextMonthDays" value="<?php echo $cfg->get('modcal_DispNextMonthDays'); ?>" />
                            	</td>
                            </tr>
							<tr>
								<td><?php echo $this->tip(_CAL_LANG_HIDE_LINKS_TIP, _CAL_LANG_HIDE_LINKS); ?></td>
								<td>
									<?php
									echo  JHTML::_('select.booleanlist', 'conf_modCalLinkCloaking', '', $cfg->get('modcal_LinkCloaking', 0));
									?>
								</td>
							</tr>
							<tr>
								<td>
									<input class="inputbox" type="button" name="default_config" size="20" value="<?php echo _CAL_LANG_BTN_DEF_CONFIG;?>" onclick="defaultConfig_cal()"/>&nbsp;
									<?php
									echo $this->tip(_CAL_LANG_TIP_BTN_DEF_CONFIG);
				        			?>
								</td>
							</tr>

                        </table>
                     	<?php
                     	echo $tabs->endPanel();
                     	echo $tabs->startPanel( _CAL_LANG_TAB_LATEST_MOD, 'config_latest_mod' );

                     	/*
                     	if( file_exists( $pathCompAdminAbs . 'help/mod_events_latest_help_' . _CAL_LANG_LNG . '.html' )){
                     	$jeventHelp = $pathCompAdminRef . 'help/mod_events_latest_help_' . _CAL_LANG_LNG . '.html';
                     	}else{
                     	$jeventHelp = $pathCompAdminRef . 'help/mod_events_latest_help_en.html';
                     	}
                     	*/

                     	if( file_exists( dirname(__FILE__) . '/help/mod_events_latest_help_' . _CAL_LANG_LNG . '.php' )){
                     		$jeventHelpPopup = dirname(__FILE__) . '/help/mod_events_latest_help_' . _CAL_LANG_LNG . '.php';
                     	}else{
                     		$jeventHelpPopup = dirname(__FILE__) . '/help/mod_events_latest_help_en.php';
                     	}
                     	include($jeventHelpPopup);
						?>
				        <table width="100%" border="0" cellpadding="2" cellspacing="0" class="adminForm">
				        	<tr>
				        		<td colspan="2" style="color:#993300; font-weight:bold; font-size:8pt;">
				        			<?php echo _CAL_LANG_SETT_FOR_MOD_LATEST . '&nbsp';
				        			// echo $this->help($jeventHelp) . '&nbsp';
				        			// TODO find where $_cal_lang_lev_main_help is defined???
				        			echo $this->help($_cal_lang_lev_main_help, 'Module') . '&nbsp';
				        			if( !file_exists( JPATH_SITE . '/modules/mod_events_latest/mod_events_latest.php' )){
				        				$tip = _CAL_LANG_MSG_NO_MOD_LATEST;
				        				echo $this->jevWarning( $tip );
				        			} ?>
				        		</td>
				        	</tr>
				        	<tr>
				        		<td width="265"><?php echo $this->tip(_CAL_LANG_LEV_MAX_DISPLAY_TIP, _CAL_LANG_LEV_MAX_DISPLAY); ?></td>
				        		<td>
									<input type=text size=3 name="conf_modLatestMaxEvents" value="<?php echo $cfg->get('modlatest_MaxEvents'); ?>" />
				        		</td>
				        	</tr>
				        	<tr>
				        		<td><?php echo $this->tip(_CAL_LANG_TIP_LEV_DISPLAY_MODE, _CAL_LANG_LEV_DISPLAY_MODE); ?></td>
				        		<td>
				        			<?php
				        			echo JHTML::_('select.integerlist', 0,4,1, 'conf_modLatestMode',  '', $cfg->get('modlatest_Mode')); ?>
				        		</td>
				        	</tr>
				        	<tr>
				        		<td><?php echo $this->tip(_CAL_LANG_TIP_LEV_DAY_RANGE, _CAL_LANG_LEV_DAY_RANGE); ?></td>
				        		<td>
				        			<input type=text size=2 name="conf_modLatestDays" value="<?php echo $cfg->get('modlatest_Days'); ?>" />
				        		</td>
				        	</tr>
				        	<tr>
				        		<td><?php echo $this->tip(_CAL_LANG_LEV_REP_EV_ONCE_TIP, _CAL_LANG_LEV_REP_EV_ONCE); ?></td>
				        		<td>
				        			<?php
				        			$lists['NoRepeat'] = JHTML::_('select.booleanlist',  'conf_modLatestNoRepeat', '', $cfg->get('modlatest_NoRepeat'));
                                    echo $lists['NoRepeat']; ?>
                                </td>
                            </tr>
                            <tr>
                            	<td><?php echo $this->tip(_CAL_LANG_LEV_EV_AS_LINK_TIP, _CAL_LANG_LEV_EV_AS_LINK); ?></td>
                            	<td>
                            		<?php
                            		$lists['dispLinks'] = JHTML::_('select.booleanlist', 'conf_modLatestDispLinks', '', $cfg->get('modlatest_DispLinks'));
                                    echo $lists['dispLinks']; ?>
                                </td>
                            </tr>
                            <tr>
                            	<td><?php echo $this->tip(_CAL_LANG_TIP_LEV_DISPLAY_YEAR, _CAL_LANG_LEV_DISPLAY_YEAR); ?></td>
                            	<td>
                            		<?php
                            		$lists['dispYear'] = JHTML::_('select.booleanlist', 'conf_modLatestDispYear', '', $cfg->get('modlatest_DispYear'));
                                    echo $lists['dispYear']; ?>
                                </td>
                            </tr>
                            <tr>
                            	<td><?php echo $this->tip(_CAL_LANG_LEV_CSS_DATE_FIELD_TIP, _CAL_LANG_LEV_CSS_DATE_FIELD); ?></td>
                                <td>
                                    <?php
                                    $lists['disDateStyle'] = JHTML::_('select.booleanlist', 'conf_modLatestDisDateStyle', '', $cfg->get('modlatest_DisDateStyle'));
                                    echo $lists['disDateStyle']; ?>
                                </td>
                            </tr>
                            <tr>
                            	<td><?php echo $this->tip(_CAL_LANG_LEV_CSS_TITLE_FIELD_TIP, _CAL_LANG_LEV_CSS_TITLE_FIELD); ?></td>
                            	<td>
                            		<?php
                            		$lists['disTitleStyle'] = JHTML::_('select.booleanlist', 'conf_modLatestDisTitleStyle', '', $cfg->get('modlatest_DisTitleStyle'));
                                    echo $lists['disTitleStyle']; ?>
                                </td>
                            </tr>
							<tr>
								<td><?php echo $this->tip(_CAL_LANG_LEV_LINKCAL_FIELD_TIP, _CAL_LANG_LEV_LINKCAL_FIELD); ?></td>
								<td><?php
								$html_options = array(
								JHTML::_('select.option', '0',	_CAL_LANG_LEV_NOLINK ),
								JHTML::_('select.option', '1',	_CAL_LANG_LEV_FIRSTLINE ),
								JHTML::_('select.option', '2',   _CAL_LANG_LEV_LASTLINE )
								);
								$lists['linkToCal'] =JHTML::_('select.radiolist',$html_options,
								'conf_modLatestLinkToCal', '', 'value', 'text', $cfg->get('modlatest_LinkToCal',0));
									echo $lists['linkToCal']; ?>
								</td>
							</tr>
							<tr>
								<td><?php echo $this->tip(_CAL_LANG_TIP_LEV_HIDE_LINK, _CAL_LANG_LEV_HIDE_LINK); ?></td>
								<td>
									<?php
									echo  JHTML::_('select.booleanlist', 'conf_modLatestLinkCloaking', '', $cfg->get('modlatest_LinkCloaking', 0));
									?>
								</td>
							</tr>

                            <tr>
                            	<td><?php echo $this->tip(_CAL_LANG_LEV_CUST_FORM_STRING_TIP, _CAL_LANG_LEV_CUST_FORM_STRING); ?></td>
                            	<td>
                            		<div style="float:left">
										<textarea class="text_area" name="conf_modLatestCustFmtStr" id="conf_modLatestCustFmtStr" cols="50" rows="4" wrap="virtual"><?php
										echo htmlspecialchars( str_replace('<br />', "\n", $cfg->get('modlatest_CustFmtStr')), ENT_QUOTES );
										?></textarea>
                            		</div>
									<div>
									<?php
									// TODO find where $_cal_lang_lev_custformstr_help is defined
									echo $this->help($_cal_lang_lev_custformstr_help, 'Event fields')
									. _CAL_LANG_LEV_AVAIL_FIELDS . '<br />'
									// TODO find where $_cal_lang_lev_date_help is defined
									. $this->help($_cal_lang_lev_date_help, 'date()')
									. _CAL_LANG_LEV_FUNC_DATE . '<br />'
									// TODO find where $_cal_lang_lev_strftime_help is defined
									. $this->help($_cal_lang_lev_strftime_help, 'strftime()')
									. _CAL_LANG_LEV_FUNC_STRFTIME;
									?>
									</div>
                            	</td>
                            </tr>
                            <tr>
                            	<td><?php echo $this->tip(_CAL_LANG_RSSLINK_TIP, _CAL_LANG_RSSLINK_FIELD); ?></td>
                                <td>
                                    <?php
                                    $lists['showRSSLink'] = JHTML::_('select.booleanlist', 'conf_modLatestRSS', '', $cfg->get('modlatest_RSS'));
                                    echo $lists['showRSSLink']; ?>
                                </td>
                            </tr>
							<tr>
								<td>
									<input class="inputbox" type="button" name="default_config" size="20" value="<?php echo _CAL_LANG_BTN_DEF_CONFIG;?>" onclick="defaultConfig_latest()"/>&nbsp;
									<?php
									echo $this->tip(_CAL_LANG_TIP_BTN_DEF_CONFIG);
				        			?>
								</td>
							</tr>
                        </table>
                     	<?php
                     	echo $tabs->endPanel();
                        echo $tabs->startPanel( _CAL_LANG_TAB_TOOLTIP, 'tooltip' ); ?>
                        <table width="100%" border="0" cellpadding="2" cellspacing="0" class="adminForm">
                        	<tr>
                                <td colspan="2" style="color:#993300; font-weight:bold; font-size:8pt;">
                                    <?php echo _CAL_LANG_TOOLTIP; ?>
                                </td>
                            </tr>
				        	<tr>
				        		<td colspan="2" ><?php echo $this->tip(_CAL_LANG_ENABLETOOLTIP_TIP, _CAL_LANG_ENABLETOOLTIP); ?>
				        			<?php
				        			$lists['EnableToolTip'] = JHTML::_('select.booleanlist',  'conf_enableToolTip', '', $cfg->get('com_enableToolTip',1));
                                    echo $lists['EnableToolTip']; ?>
                                </td>
                            </tr>
                        	<tr>
                        		<td width="50%">
                        			<fieldset>
                        				<legend><?php echo _CAL_LANG_TT_MAINWINDOW; ?></legend>
                        				<table>
                                            <tr>
                                                <td width="120"><?php echo $this->tip(_CAL_LANG_TIP_TT_BGROUND,  _CAL_LANG_TT_BGROUND); ?></td>
                                                <td>
                                                <?php
                                                $lists['tt_bground'] = JHTML::_('select.booleanlist',  'conf_calTTBackground', 'class="inputbox"', $cfg->get('com_calTTBackground')); ?>
                                                    <?php echo $lists['tt_bground']; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><?php echo $this->tip(_CAL_LANG_TIP_TT_POSX, _CAL_LANG_TT_POSX); ?></td>
                                                <td>
                                                    <?php
                                                    $posx[] = JHTML::_('select.option', 'LEFT',      _CAL_LANG_LEFT );
                                                    $posx[] = JHTML::_('select.option', 'CENTER',    _CAL_LANG_CENTER );
                                                    $posx[] = JHTML::_('select.option', 'RIGHT',     _CAL_LANG_RIGHT );
                                                    $lists['tt_posx'] =JHTML::_('select.radiolist', $posx, 'conf_calTTPosX', '', 'value', 'text', $cfg->get('com_calTTPosX') ); ?>
                                                    <?php echo $lists['tt_posx']; ?>
                                                </td>
                                            </tr>
                                            <!-- y-position of TT: above, below (NOTE: if above, HEIGHT MUST BE SET!) -->
                                            <tr>
                                                <td><?php echo $this->tip(_CAL_LANG_TIP_TT_POSY, _CAL_LANG_TT_POSY); ?></td>
                                                <td>
                                                    <?php
                                                    $posy[] = JHTML::_('select.option', 'BELOW',     _CAL_LANG_BELOW );
                                                    $posy[] = JHTML::_('select.option', 'ABOVE',     _CAL_LANG_ABOVE );
                                                    $lists['tt_posy'] =JHTML::_('select.radiolist', $posy, 'conf_calTTPosY', '', 'value', 'text' , $cfg->get('com_calTTPosY')); ?>
                                                    <?php echo $lists['tt_posy']; ?>
                                                </td>
                                            </tr>
                                        </table>
                                    </fieldset>
                                </td>
                                <td>
                                    <fieldset>
                                    	<legend>
                                    		<?php echo _CAL_LANG_TT_SHADOW; ?>
                                    		&nbsp;
                                            <?php
                                            echo $this->tip(_CAL_LANG_TIP_TT_SHADOW);
                                            ?>
                                    	</legend>
                                        <table>
                                            <tr>
                                                <td width="120"><?php echo _CAL_LANG_TT_SHADOW; ?></td>
                                                <td>
                                                    <?php
                                                    $lists['tt_shadow'] = JHTML::_('select.booleanlist',  'conf_calTTShadow', 'class="inputbox"', $cfg->get('com_calTTShadow') ); ?>
                                                    <?php echo $lists['tt_shadow']; ?>
                                                </td>
                                            </tr>
                                            <!-- y-position of TT-shadow: BOOL 0=below, 1=above, [ value as standard: -10 = above ] -->
                                            <tr>
                                                <td><?php echo _CAL_LANG_TT_SHADOWX; ?></td>
                                                <td>
                                                    <?php $lists['tt_shadowx'] = JHTML::_('select.booleanlist',  'conf_calTTShadowX', 'class="inputbox"', $cfg->get('com_calTTShadowX') ); ?>
                                                    <?php echo $lists['tt_shadowx']; ?>
                                                </td>
                                            </tr>
                                            <!-- y-position of TT-shadow: BOOL 0=below, 1=above, [ value as standard: -10 = above ] -->
                                            <tr>
                                                <td><?php echo _CAL_LANG_TT_SHADOWY; ?></td>
                                                <td>
                                                    <?php $lists['tt_shadowy'] = JHTML::_('select.booleanlist',  'conf_calTTShadowY', 'class="inputbox"', $cfg->get('com_calTTShadowY') ); ?>
                                                    <?php echo $lists['tt_shadowy']; ?>
                                                </td>
                                            </tr>
                                        </table>
                                    </fieldset>
                                </td>
                            </tr>
							<tr>
								<td>
									<input class="inputbox" type="button" name="default_config" size="20" value="<?php echo _CAL_LANG_BTN_DEF_CONFIG;?>" onclick="defaultConfig_tooltip()"/>&nbsp;
									<?php
									echo $this->tip(_CAL_LANG_TIP_BTN_DEF_CONFIG);
				        			?>
								</td>
							</tr>
                        </table>
                        <?php
                        echo $tabs->endPanel();
				        echo $tabs->startPanel( _CAL_LANG_TAB_ABOUT, 'about' ); ?>
                        <table width="100%" border="0" cellpadding="2" cellspacing="0" class="adminForm">
                            <tr>
                                <td colspan="2">
                                    <?php
                                    $pathLang = JPATH_ADMINISTRATOR."/components/$option/help/README_";
                                    if( file_exists( $pathLang . _CAL_LANG_LNG . '.php' )){
                                    	include_once( $pathLang . _CAL_LANG_LNG . '.php' );
                                    }else{
                                    	include_once( $pathLang . 'en.php' );
                                    } ?>
                                </td>
                            </tr>
                        </table>
                        <?php
                        echo $tabs->endPanel();
                        echo $tabs->endPane(); ?>
                    </td>
                </tr>
            </table>
    	</form>
    	<?php
	}

	function showCategories($cats, $pageNav, $option){
		global  $task;
		$user =& JFactory::getUser();
		HTML_events_admin::_header();
		echo "<tr><td>\n";
		HTML_category_admin::showCategories($cats, $pageNav, $option);
		echo "</td>\n";
		HTML_events_admin::_footer($task,$option);
	}

	function editCategory($cat, $plist, $glist) {
		global  $task;
		$cfg = & EventsConfig::getInstance();
		$jev_component_name = $cfg->get("com_componentname");
		$user =& JFactory::getUser();
		HTML_events_admin::_header();
		echo "<tr><td>\n";
		// clean any existing cache files
		$cache =& JFactory::getCache($jev_component_name);
		$cache->clean($jev_component_name);
		HTML_category_admin::editCategory($cat, $plist, $glist,$jev_component_name) ;
		echo "</td>\n";
		HTML_events_admin::_footer($task,$jev_component_name);

	}

	/**
	 * Creates the CPanel for the Events component
	 *
	 */
	function _header($enctype = "") {
	?>
	<div id="jevents">
	<?php 
	global $mainframe;
	$cfg = & EventsConfig::getInstance();
	$option = $cfg->get("com_componentname", "com_events");
	$target = $mainframe->isAdmin()?"index2.php":"index.php";
	?>
    <form action="<?php echo $target;?>" method="post" name="adminForm" <?php echo $enctype;?>>
	<table width="90%" border="0" cellpadding="2" cellspacing="2" class="adminform">
	<?php
	}

	function _footer($task,$option) {
	?>
    </tr>
  </table>
	  <input type="hidden" name="task" value="<?php echo $task; ?>" />
	  <input type="hidden" name="act" value="" />
	  <input type="hidden" name="option" value="<?php echo $option; ?>" />
    </form>    </div>
	<?php
	}

	function showCPanel( $panelStates ) {
		global $task;
		$cfg = & EventsConfig::getInstance();
		$option = $cfg->get("com_componentname", "com_events");
		$this->_header();
		?>
		<tr>
			<td width="55%" valign="top">
				<div id="cpanel">
				<?php				

				$link = "index2.php?option=$option&task=iCalsubs";
				$this->_quickiconButton( $link, "upload_f2.png", _CAL_LANG_ADMIN_ICAL_SUBSCRIPTIONS );

				$link = "index2.php?option=$option&task=iCalevents";
				$this->_quickiconButton( $link, "addedit.png", _CAL_LANG_ADMIN_ICAL_EVENTS );

				$link = "index2.php?option=$option&task=categories";
				$this->_quickiconButton( $link, "categories.png", _CAL_LANG_INSTAL_CATS );

				$link = "index2.php?option=$option&task=exportToIcal";
				$this->_quickiconButton( $link, "dbrestore.png", _CAL_LANG_ADMIN_EXPORT_TO_ICAL);

				echo "<div style='clear:both;' />";

				$link = "index2.php?option=$option&task=conf";
				$this->_quickiconButton( $link, "config.png", _CAL_LANG_INSTAL_CONFIG );

				//$link = "index2.php?option=$option&task=confModules";
				//$this->_quickiconButton( $link, "config.png", _CAL_LANG_ADMIN_CONFIG_MODULES );

				$link = "about:blank";
				$this->_quickiconButton( $link, 'support.png', _CAL_LANG_TAB_HELP );

				$link = "about:blank";
				$this->_quickiconButton( $link, 'credits.png', _CAL_LANG_TAB_ABOUT );

				echo "<div style='clear:both;' />";

				echo "<fieldset style='background-color:#eeeeee;'><label>"._CAL_LANG_ADMIN_LEGACY."</label>\n";
				echo "<div style='text-align:center' />";
				$link = "index2.php?option=$option&task=viewEvents";
				$this->_quickiconButton( $link, "addedit.png", _CAL_LANG_INSTAL_MANAGE );

				$link = "index2.php?option=$option&task=viewarchiv";
				$this->_quickiconButton( $link, "archive_f2.png", _CAL_LANG_INSTAL_ARCHIVE );
				echo "</div></fieldset>\n";
				?>
				</div>
			</td>
			<td width="45%" valign="top">
				<div style="width: 100%;">
					<form action="index2.php" method="post" name="adminForm">
					<?php

					// Tabs
					jimport('joomla.html.pane');
					$tabs = & JPane::getInstance('tabs');
					//		$tabs = new JPaneTabs(1);
					echo $tabs->startPane( 'statuspane' );
					echo $tabs->startPanel( "Setup", 'jevsetup' );
					$href2 = $this->live_site."administrator/index2.php?option=$option&task=migrate";
					$href4 = $this->live_site."administrator/index2.php?option=$option&task=convertToIcalBatch";
					?>
					<h2>Temporary Development Tab</h2>
					<a href="<?php echo $href2;?>">Migrate admin menus and update databases</a><br/>
					<hr/>
					<a href="<?php echo $href4;?>">Migrate All Events to IcalEvents</a><br/>
					<?php 
					echo $tabs->endPanel();

					// Prepare formating for the output of the state
					echo $tabs->startPanel( _CAL_LANG_ADMIN_STATUS, 'jevstatus' );
					?>
					<table class="adminlist">
						<tr>
							<th colspan="4">
							<?php echo _CAL_LANG_ADMIN_COMPONENT_STATE;?>
							</th>
						</tr>
						<?php foreach ($panelStates as $key => $state ) { ?>
						<tr class="row0">
							<td><?php echo $panelStates[$key]['desc'] ?></td>
							<td><?php echo $panelStates[$key]['title'] ?></td>
							<td><?php echo $panelStates[$key]['pub'];?></td>
							<td><a href="<?php echo $panelStates[$key]['href'];?>"><img src="<?php echo $this->live_site;?>images/M_images/edit.png" border="0" alt="<?php echo _E_EDIT;?>" /></a></td>							
						</tr>
						<?php } ?>
					</table>
					<?php
					echo $tabs->endPanel();


					// Prepare formating for the output of the state
					echo $tabs->startPanel("Tools", 'jevtools' );
					$href = $this->live_site."administrator/index2.php?option=$option&task=checkLocale";
					?>
					<table class="adminlist">
						<tr>
							<th colspan="4">
							<?php echo "Tools";?>
							</th>
						</tr>
						<tr class="row0">
							<td><a href="<?php echo $href;?>"><?php echo _CAL_CHECK_LOCALE;?></a></td>
						</tr>
					</table>
					<?php
					echo $tabs->endPanel();

					echo $tabs->startPanel( "Advanced", 'jevadvanced' );
					$href1 = $this->live_site."administrator/index2.php?option=$option&task=dropIcalTables";
					//$href3 = $this->live_site."administrator/index2.php?option=$option&task=convertExtCal";
					?>
					<h2>Only use these options if speficically asked to do so</h2>
					<a href="<?php echo $href1;?>">Delete iCal related tables</a><br/>
					<hr/>
					<!--
					<a href="<?php //echo $href3;?>">Convert ExtCal data to JEvents</a><br/>
					<hr/>
					//-->
					<?php 
					echo $tabs->endPanel();
					
					echo $tabs->endPane();
					?>
					</form>
				</div>
			</td>
		</tr>
		<?php
		$this->_footer($task,$option);
	}

	/**
	 * This method creates a standard cpanel button
	 *
	 * @param unknown_type $link
	 * @param unknown_type $image
	 * @param unknown_type $text
	 */
	function _quickiconButton( $link, $image, $text, $path='/administrator/images/' ) {
		?>
		<div style="float:left;">
			<div class="icon">
				<a href="<?php echo $link; ?>">
					<?php echo JHTML::_('image.administrator', $image, $path, NULL, NULL, $text ); ?>
					<span><?php echo $text; ?></span>
				</a>
			</div>
		</div>
		<?php
	}

	/**
	* Utility function to provide Warning Icons - should be in Joomla 1.5 but isn't!
	*/
	function jevWarning($warning, $title='Joomla! Warning') {

		$mouseover 	= 'return overlib(\''. $warning .'\', CAPTION, \''. $title .'\', BELOW, RIGHT);';

		$tip 		= "<!-- Warning -->\n";
		$tip 		.= '<a href="javascript:void(0)" onmouseover="'. $mouseover .'" onmouseout="return nd();">';
		$tip 		.= '<img src="'. $this->live_site .'includes/js/ThemeOffice/warning.png" border="0"  alt="warning"/></a>';

		return $tip;
	}

}

?>
