<?php
/**
 * Events Component for Joomla 1.0.x
 *
 * @version     $Id: admin.events.html.php 1102 2008-05-22 06:11:59Z tstahl $
 * @package     Events
 * @copyright   Copyright (C) 2006 JEvents Project Group
 * @copyright   Copyright (C) 2000 - 2003 Eric Lamette, Dave McDonnell
 * @licence     http://www.gnu.org/copyleft/gpl.html
 * @link        http://joomlacode.org/gf/project/jevents
 */

// ensure this file is being included by a parent file
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

class HTML_events_admin {
	/**
	* Writes a list of the events items
	* @param array An array of events objects
	*/
	function showEvents( $rows, $clist, $search, $pageNav, $option, $hideOldEvents=1, $catData ) {
		global $my, $mosConfig_live_site, $database;

		mosCommonHTML::loadOverlib();

		// get configuration object
		$cfg = & EventsConfig::getInstance();

		$pathIMG = $mosConfig_live_site . '/administrator/images/'; ?>
<!--
		<div id="overDiv" style="position:absolute; visibility:hidden; z-index:1000;"></div>
		<script language="Javascript" src="../includes/js/overlib_mini.js"></script>
-->
		<form action="index2.php" method="post" name="adminForm">
			<table cellpadding="4" cellspacing="0" border="0" width="100%">
				<tr>
					<td width="100%">
						<img src="<?php echo $mosConfig_live_site; ?>/components/<?php echo $option; ?>/images/logo.gif" border="0" alt="" />
					</td>
				    <td nowrap><?php echo _CAL_HIDE_OLD_EVENTS;
				        echo mosHTML::yesnoSelectList("oldev","onchange='document.adminForm.submit();'",$hideOldEvents);
      					?>
      				</td>
					<td><?php echo _CAL_LANG_SEARCH; ?>&nbsp;</td>
					<td>
						<input type="text" name="search" value="<?php echo $search; ?>" class="inputbox" onChange="document.adminForm.submit();" />
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
                $nullDate 	= $database->getNullDate();

                for( $i=0, $n=count( $rows ); $i < $n; $i++ ){
                	$row = &$rows[$i]; ?>
                    <tr class="row<?php echo $k; ?>">
                    	<td width="20" style="background-color:<?php echo setColor($row);?>">
                            <?php
                            if ($row->checked_out && $row->checked_out != $my->id) { ?>
                                &nbsp;
                                <?php
                            }else{ ?>
                                <input type="checkbox" id="cb<?php echo $i;?>" name="cid[]" value="<?php echo $row->id; ?>" onclick="isChecked(this.checked);" />
                                <?php
                            } ?>
                    	</td>
                      	<td width="30%">
                      		<a href="#edit" onclick="return listItemTask('cb<?php echo $i;?>','edit')" title="<?php echo _CAL_LANG_CLICK_TO_EDIT; ?>"><?php echo $row->title; ?></a>
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
                    	    
                    	    /*
                            if( $row->reccurtype > 0 ){

                                switch( $row->reccurtype ){
                                    case '1': $reccur = _CAL_LANG_REP_WEEK;     break;
                                    case '2': $reccur = _CAL_LANG_REP_WEEK;     break;
                                    case '3': $reccur = _CAL_LANG_REP_MONTH;    break;
                                    case '4': $reccur = _CAL_LANG_REP_MONTH;    break;
                                    case '5': $reccur = _CAL_LANG_REP_YEAR;     break;
                                }

                                if( $row->reccurday >= 0 ){
                                    $dayname = mosEventsHTML::getLongDayName( $row->reccurday );

                                    if( $row->reccurtype == 1 ){
                                        echo $dayname . '&nbsp;' . _CAL_LANG_EACHOF . '&nbsp;' . $reccur;
                                    }elseif(( $row->reccurtype == 1 ) || ( $row->reccurtype == 2 )) {
                                        $pairorimpair = $row->reccurweeks == 'pair' ? _CAL_LANG_REP_WEEKPAIR : ( $row->reccurweeks == 'impair' ? _CAL_LANG_REP_WEEKIMPAIR : _CAL_LANG_REP_WEEK );
                                        echo _CAL_LANG_EACH . '&nbsp;' . $dayname . '&nbsp;' . $pairorimpair;
                                    }else{
                                        echo _CAL_LANG_EACH . '&nbsp;' . $reccur;
                                    }
                                }else{
                                    echo _CAL_LANG_EACH . '&nbsp;' . $reccur;
                                }
                            } else {
                                echo _CAL_LANG_ALLDAYS;
                            } 
                            */
                    	    ?>
                    	</td>

						<td width="10%" align="center">
                      	    <?php
                            global $mosConfig_offset;
							$now	= strftime( '%Y-%m-%d %H:%M:%S', jevNow(true));
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
            		<td align="center" colspan="8"><?php echo $pageNav->getListFooter(); ?></td>
            	</tr>
            </table>
            <input type="hidden" name="option" value="<?php echo $option;?>" />
            <input type="hidden" name="task" value="<?php global $task;if ($task=="viewarchiv") echo $task;?>"  />
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
		$images, $creator, $modifier, $option, $mode, $catColors, $lists , $hiddenVals="") {

		global $mosConfig_live_site, $my;
		global $mainframe;

		// clean any existing cache files
		mosCache::cleanCache( 'com_events' );
		
		// get configuration object
		$cfg = & EventsConfig::getInstance();

		mosCommonHTML::loadOverlib();
		mosCommonHTML::loadCalendar();

		$tabs 		= new mosTabs(0);
		$return2cat = intval( mosGetParam( $_POST, 'catid', 0 ) );
		$myid		= $my->id;

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
            var folderimages = new Array;
            <?php
            $i = 0;
            foreach ($images as $k=>$items) {
                foreach ($items as $v) {
                    echo "\n    folderimages[".$i++."] = new Array( '$k','$v->value','$v->text' );";
                }
            } ?>

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
                checkDisable();
                var form = document.adminForm;
                if (pressbutton == 'cancel') {
                    submitform( pressbutton );
                    return;
                }
                // assemble the images back into one field
                var temp = new Array;
                for (var i=0, n=form.imagelist.options.length; i < n; i++) {
                    temp[i] = form.imagelist.options[i].value;
                }
                form.images.value = temp.join( '\n' );

                // Note that this php function below is not really doing anything in most of the editor scripts.
                // The actual editor contents is passed back into the textarea when the form is about to be submitted
                // by chaining into the form's onsubmit() event function.  The problem here is that we don't actually
                // call the form's submit event until we are done with our checks below.  What we need to do here is
                // call the form's onsubmit() function first to let the editor copy the contents into the textarea
                document.adminForm.onsubmit();
                <?php getEditorContents( 'editor1', 'content' ) ; ?>

                // Call this function to provide content for introtext attribute (needed for preview)
                document.adminForm.introtext.value = document.adminForm.content.value;

                // do field validation
                var sw = checkSelectedWeeks();
                var sd = checkSelectedDays();
                if (form.title.value == "") {
                    alert ( "<?php echo html_entity_decode( _CAL_LANG_WARNTITLE ); ?>" );
                //} else if (form.content.value == "") {
                //  alert ( "<?php echo _CAL_LANG_WARNACTIVITY; ?>" );
                } else if (form.catid.value == "0"){
                    alert( "<?php echo html_entity_decode( _CAL_LANG_WARNCAT ); ?>" );
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
                                // if time was > 12 then this is probably the after noon so don't check for pm
                                //adjust radio checkboxes
                                chkBoxGroup[0].checked = false;
                                chkBoxGroup[1].checked = true;
                            }
                            if(amUsed){
                                chkBoxGroup[0].checked = true;
                                chkBoxGroup[1].checked = false;
                            }
                            else if (pmUsed){
                                chkBoxGroup[0].checked = false;
                                chkBoxGroup[1].checked = true;
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

                        // TODO force end_time to be after start time when dates match
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
						&nbsp;<small>[&nbsp;<?php echo $row->title; ?>&nbsp;]</small>
						<?php
					} ?>
				</td>
			</tr>
		</table>
<?php 
$target = $mainframe->isAdmin()?"index2.php":"index.php";
?>
		<form action="<?php echo $target;?>" method="post" name="adminForm" onsubmit="javascript:setgood();">
			<table cellspacing="0" cellpadding="4" border="0" width="100%">
                <tr>
                    <td>
                        <?php
                        $tabs->startPane( 'jevent' );
                        $tabs->startTab( _CAL_LANG_TAB_COMMON, 'event' ); ?>
				        <table cellpadding="5" cellspacing="0" border="0" class="adminform">
                            <tr>
                                <td width="10%" align="left"><?php echo _CAL_LANG_EVENT_TITLE; ?>:</td>
                                <td colspan="3">
                                    <input class="inputbox" type="text" name="title" size="50" maxlength="100" value="<?php echo $row->title; ?>" />
                                </td>
                            </tr>
                            <tr>
                                <td valign="top" align="left"><?php echo _CAL_LANG_EVENT_CATEGORY; ?>: </td>
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
                                <td valign="top" align="left" colspan="4">
                                    <p><?php echo _CAL_LANG_EVENT_ACTIVITY; ?>: </p>
                                <div onmouseout="introTocontent();">
                                    <?php
                                    // parameters : areaname, content, hidden field, width, height, rows, cols
                                    editorArea( 'editor1',  $row->content , 'content', 600, 250, '70', '10' ) ; ?>
                                </div>
                                </td>
                            </tr>
                            <tr>
                                <td width="130" align="left"><?php echo _CAL_LANG_EVENT_ADRESSE; ?></td>
                                <td colspan="3">
                                    <input class="inputbox" type="text" name="adresse_info" size="80" maxlength="120" value="<?php echo $row->adresse_info; ?>" />
                                </td>
                            </tr>
                            <tr>
                                <td align="left"><?php echo _CAL_LANG_EVENT_CONTACT; ?></td>
                                <td colspan="3">
                                    <input class="inputbox" type="text" name="contact_info" size="80" maxlength="120" value="<?php echo $row->contact_info; ?>" />
                                </td>
                            </tr>
                            <tr>
                                <td align="left" valign="top"><?php echo _CAL_LANG_EVENT_EXTRA; ?></td>
                                <td>
                                	<textarea class="text_area" name="extra_info" id="extra_info" cols="50" rows="4" maxlength="240" wrap="virtual"><?php echo $row->extra_info; ?></textarea>
                                </td>
                            </tr>
                        </table>
                        <!-- // END EXTRA TAB -->
                        <?php
                        $tabs->endTab();
                        $tabs->startTab( _CAL_LANG_TAB_CALENDAR, 'calendar' ); 
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
										include_once(dirname(__FILE__)."/colorMap.php"); 
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
 												<?php include(dirname(__FILE__)."/colours.html.php"); ?>
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
                                            <?php
											// Joomla 1.5 compatability
											global $_VERSION;
											if (floatval($_VERSION->getShortVersion())>=1.5){                                            
												echo JHTML::calendar($start_publish, 'publish_up', 'publish_up', '%Y-%m-%d',
												array('size'=>'12','maxlength'=>'10','onchange'=>'checkPublish();'));                                            
											}
											else {
                                            ?>
                                                <input class="inputbox" type="text" name="publish_up" id="publish_up" size="12" maxlength="10" value="<?php echo $start_publish;?>" onchange="checkPublish();" />
                                                <input type="reset" class="button" value="..." onclick="return showCalendar('publish_up', 'y-mm-dd');" />
                                            <?php } ?>
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
                                            <?php
											// Joomla 1.5 compatability
											global $_VERSION;
											if (floatval($_VERSION->getShortVersion())>=1.5){                                            
												echo JHTML::calendar($stop_publish, 'publish_down', 'publish_down', '%Y-%m-%d',
												array('size'=>'12','maxlength'=>'10','onchange'=>'checkPublish();'));                                            
											}
											else {
                                            ?>
                                                <input class="inputbox" type="text" name="publish_down" id="publish_down" size="12" maxlength="10" value="<?php echo $stop_publish; ?>" onchange="checkPublish();" />
                                                <input type="reset" class="button" value="..." onclick="return showCalendar('publish_down', 'y-mm-dd');" />
                                            <?php } ?>
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
	                        else {
	                        	$hideRepeat="style='display:none;'";
	                        }
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
                        $tabs->endTab();
                        $tabs->startTab( _CAL_LANG_TAB_IMAGES, 'images' ); ?>
                        <table cellpadding="5" cellspacing="0" border="0" width="100%" class="adminform">
                            <tr>
                                <td colspan="6"><?php echo _CAL_LANG_IMG_FOLDER; ?> :: <?php echo $lists['folderlist'];?></td>
                            </tr>
                            <tr>
                                <td>
                                    <strong><?php echo _CAL_LANG_AVAL_IMAGES; ?></strong>
                                    <br />
                                    <?php echo $lists['ilist']; ?>
                                    <br /><br />
                                    <input class="button" type="button" value="<?php echo _CAL_LANG_INSERT_IMG; ?>" onclick="addSelectedToList('adminForm','imagefiles','imagelist')" />
                                </td>
                                <td>
                                    <strong><?php echo _CAL_LANG_CONTENT_IMGS; ?></strong>
                                    <br />
                                    <?php echo $lists['i2list']; ?>
                                    <br /><br />
                                    <input class="button" type="button" value="<?php echo _CAL_LANG_MOVE_UP; ?>" onclick="moveInList('adminForm','imagelist',adminForm.imagelist.selectedIndex,-1)" />
                                    <input class="button" type="button" value="<?php echo _CAL_LANG_MOVE_DOWN; ?>" onclick="moveInList('adminForm','imagelist',adminForm.imagelist.selectedIndex,+1)" />
                                    <input class="button" type="button" value="<?php echo _CAL_LANG_REMOVE; ?>" onclick="delSelectedFromList('adminForm','imagelist')" />
                                </td>
                                <td>
                                    <strong><?php echo _CAL_LANG_EDITED_SEL_IMG; ?></strong>
                                    <table>
                                        <tr>
                                            <td align="right"><?php echo _CAL_LANG_SOURCE; ?></td>
                                            <td>
                                                <input type="text" name= "_source" value="" size="35" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="right"><?php echo _CAL_LANG_ALIGN; ?></td>
                                            <td><?php echo $lists['poslist']; ?></td>
                                        </tr>
                                        <tr>
                                            <td align="right"><?php echo _CAL_LANG_ALT_TXT; ?></td>
                                            <td><input type="text" name="_alt" value="" size="35" /></td>
                                        </tr>
                                        <tr>
                                            <td align="right"><?php echo _CAL_LANG_BORDER; ?></td>
                                            <td>
                                            	<input type="text" name="_border" value="" size="2" maxlength="1" />
                                            	&nbsp;px
                                            </td>
                                        </tr>
										<tr>
											<td align="right"><?php echo _CAL_LANG_CAPTION;?></td>
											<td> <input type="text" name="_caption" value="" size="30" /></td>
										</tr>
										<tr>
											<td align="right"><?php echo _CAL_LANG_CAPTION_POSITION;?>:</td>
											<td>
											<?php 	// build the select list for the image caption position
												$pos[] = mosHTML::makeOption( 'bottom', _CAL_LANG_CAPTION_POS_BOTTOM );
												$pos[] = mosHTML::makeOption( 'top',  _CAL_LANG_CAPTION_POS_TOP );
												echo mosHTML::selectList( $pos, '_caption_position', 'class="inputbox" size="1"',
							 						'value', 'text' );//echo $lists['_caption_position'];
											?>
											</td>
										</tr>
										<tr>
											<td align="right"><?php echo _CAL_LANG_CAPTION_ALIGN?>:</td>
											<td><?php echo mosAdminMenus::Positions( '_caption_align' );?></td>
										</tr>
										<tr>
											<td align="right"><?php echo _CAL_LANG_CAPTION_WIDTH?>:</td>
											<td><input class="text_area" type="text" name="_width" value="" size="5" maxlength="5" /></td>
										</tr>
                                        <tr>
                                            <td align="right"></td>
                                            <td><input class="button" type="button" value=" <?php echo _CAL_LANG_APPLY; ?> " onclick="applyImageProps();" /></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <img name="view_imagefiles" src="../images/M_images/blank.png" width="100" />
                                </td>
                                <td>
                                    <img name="view_imagelist" src="../images/M_images/blank.png" width="100" />
                                </td>
                            </tr>
                        </table>
                        <?php
                        $tabs->endTab();
                        $tabs->startTab( _CAL_LANG_TAB_EXTRA, 'extra' ); ?>
						<table cellpadding="5" cellspacing="0" border="0" width="100%" class="adminform">                                                    <tr>
                                <th class="info" colspan="2"><?php echo _CAL_LANG_EVENT_STATUS; ?></th>
                            </tr>
                            <tr>
                                <td><?php echo _CAL_LANG_STATE; ?></td>
                                <td>
                                    <?php echo $row->state > 0 ? '<strong style="color:green;">' . _CAL_LANG_PUBLISHED . '</strong>' : ( $row->state < 0 ? '<strong style="color:red;">' . _CAL_LANG_ARCHIVED . '</strong>' : '<strong style="color:red;">' . _CAL_LANG_DRAFT_UNPUB . '</strong>' ); ?>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo _CAL_LANG_HITS; ?></td>
                                <td><?php echo $row->hits;?></td>
                            </tr>
                            <tr>
                                <td><?php echo _CAL_LANG_CREATED; ?></td>
                                <td>
                                    <?php echo $row->created ? $row->created
                                    . '</td></tr><tr><td><strong>' . _CAL_LANG_BY . '</strong></td><td>'
                                    . $creator : _CAL_LANG_EVENT_NEWEVENT; ?>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo _CAL_LANG_LAST_MOD; ?></td>
                                <td>
                                    <?php echo $row->modified ? $row->modified
                                    . '</td></tr><tr><td><strong>' ._CAL_LANG_BY . '</strong></td><td>'
                                    . $modifier : _CAL_LANG_EVENT_NOTMODIFIED; ?>
                                </td>
                            </tr>
						</table>
                        <?php
                        $tabs->endTab();
                        $tabs->startTab( _CAL_LANG_TAB_HELP, 'help' ); ?>
                        <table align="left" width="100%" cellpadding="0" cellspacing="5" border="0" class="adminform">
                        	<?php echo _CAL_LANG_EVENT_FORM_HELP_ADMIN; ?>
                        </table>
                     	<?php
                        $tabs->endTab();

                        // only show the about tab in the backend and when copyright notice is enabled
						if ($mainframe->isAdmin() || $cfg->get('com_copyright', 1) == 1) {							
                        $tabs->startTab( _CAL_LANG_TAB_ABOUT, 'about' ); ?>
                        <table width="100%" border="0" cellpadding="2" cellspacing="0" class="adminForm">
                            <tr>
                                <td colspan="2">
                                    <?php
                                    $pathLang = $GLOBALS['mosConfig_absolute_path']
                                    . '/administrator/components/com_events/help/README_';
                                    if( file_exists( $pathLang . _CAL_LANG_LNG . '.php' )){
                                        include_once( $pathLang . _CAL_LANG_LNG . '.php' );
                                    }else{
                                        include_once( $pathLang . 'en.php' );
                                    } ?>
                                </td>
                            </tr>
                        </table>
                     	<?php
                        $tabs->endTab();
						}
                        $tabs->endPane(); ?>
                    </td>
                </tr>
            </table>

        	<input type="hidden" name="option" value="<?php echo $option;?>" />
        	<input type="hidden" name="id" value="<?php echo $row->id; ?>" />
        	<input type="hidden" name="sid" value="<?php echo $row->sid; ?>" />
        	<input type="hidden" name="return2cat" value="<?php echo $return2cat; ?>" />
        	<input type="hidden" name="task" value="" />
        	<input type="hidden" name="introtext" />
        	<input type="hidden" name="goodexit" value="0" />
        	<input type="hidden" name="images" value="" />
        	<?php echo $hiddenVals ?>
		</form>

		<script type="text/javascript">
        	checkPublish();
        	document.adminForm.catid.onchange();
			checkAllDayEvent();
        </script>

		<?php
	}

	function showConfig( $option, $conf_style) {

		global $mosConfig_live_site, $mosConfig_absolute_path;

		mosCommonHTML::loadOverlib();

		// get configuration object
		$cfg = & EventsConfig::getInstance();

		$version = EventsVersion::getInstance();

		$pathCompAdminRef = $mosConfig_live_site . '/administrator/components/com_events/';
        $pathCompAdminAbs = $mosConfig_absolute_path . '/administrator/components/com_events/';

		$tabs 			= new mosTabs(1);

		$configfile 	= $mosConfig_absolute_path . '/administrator/components/' . $option . '/events_config.ini.php';
		$cssfile 		= $mosConfig_absolute_path . '/components/' . $option . '/events_css.css';
		$writeConfig	= true;
		$writeCss		= true;

		if( !is_writable( $configfile )){
			$writeConfig = false;
		}

		if( !is_writable( $cssfile )){
			$writeCss = false;
		}

		// define some lists ( should be done inside the admin.php [mic])
		$lists = array();

		?>

		<table border="0" cellpadding="0" cellspacing="0" width="95%">
			<tr>
				<td>
					<img src="<?php echo $mosConfig_live_site; ?>/components/<?php echo $option;?>/images/logo.gif" border="0" alt="JEvents">
				</td>
				<td align="left" valign="bottom"> <span style="font-size:200%;"><?php echo _CAL_LANG_EVENTS_CONFIG; ?></span>&nbsp;[&nbsp;<?php echo $version->getShortVersion();?>&nbsp;<a href='<?php echo $version->getURL()?>'><?php echo _CAL_LANG_CHECK_VERSION;?> </a>]</td>
				<td align="left" valign="bottom">
					[&nbsp;
					<?php
					if( $writeConfig ){
						echo '<small style="color:green;">' . _CAL_LANG_CONFIG_WRITEABLE ;
					}else{
						echo '<small style="color:red;">' . _CAL_LANG_CONFIG_NOT_WRITEABLE;
					}
					echo '</small>&nbsp;]<br />[&nbsp;';
					if( $writeCss ){
						echo '<small style="color:green;">' . _CAL_LANG_CSS_WRITEABLE ;
					}else{
						echo '<small style="color:red;">' . _CAL_LANG_CSS_NOT_WRITEABLE;
					}
					echo '</small>&nbsp;]';?>
				</td>
			</tr>
		</table>

		<form action="index2.php" method="post" name="adminForm">
            <?php
            // Include default config javascript
            defaultConfig(); ?>
            <input type="hidden" name="task" value="saveconfig" />
            <input type="hidden" name="option" value="<?php echo $option;?>" />

            <table cellspacing="0" cellpadding="4" border="0" width="100%">
                <tr>
                    <td>
                        <?php
                        $tabs->startPane( 'configs' );
                        $tabs->startTab( _CAL_LANG_TAB_COMPONENT, 'config_com' ); ?>
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
    							<td><?php echo _CAL_LANG_ACCESS; ?></td>
    							<td>
    								<?php
                                    $level[] = mosHTML::makeOption( '0', _CAL_LANG_SEL_ACCESS_ALL_REGGED );
                                    $level[] = mosHTML::makeOption( '1', _CAL_LANG_SEL_ACCESS_SPECIAL );
                                    $level[] = mosHTML::makeOption( '2', _CAL_LANG_SEL_ACCESS_ALL_ANONYM );

                                    $tosend = mosHTML::selectList( $level, 'conf_adminlevel', '', 'value', 'text', $cfg->get('com_adminlevel'));
                                    echo $tosend; ?>
                                    &nbsp;
                                    <?php
                                    $tip = _CAL_LANG_TIP_ACCESS;
                                    echo mosToolTip( $tip ); ?>
                                </td>
                            </tr>
                            <tr>
                            	<td>
                            		<?php echo _CAL_LANG_FRONTEND_PUBLISHING; ?>
                            	</td>
                            	<td>
                            		<?php
                            		$publevel = array();
                                    $publevel[] = mosHTML::makeOption( '1', _CAL_LANG_SEL_ACCESS_ALL_REGGED );
                                    $publevel[] = mosHTML::makeOption( '2', _CAL_LANG_SEL_ACCESS_ALL_AUTHORS );
                                    $publevel[] = mosHTML::makeOption( '3', _CAL_LANG_SEL_ACCESS_ALL_EDITORS );
                                    $publevel[] = mosHTML::makeOption( '4', _CAL_LANG_SEL_ACCESS_ALL_PUBLISHERS );
                                    $publevel[] = mosHTML::makeOption( '5', _CAL_LANG_SEL_ACCESS_ALL_MANAGERS );
                                    $publevel[] = mosHTML::makeOption( '6', _CAL_LANG_SEL_ACCESS_ALL_ADMIN );
									echo  mosHTML::selectList( $publevel,'conf_frontendPublish', '','value','text', $cfg->get('com_frontendPublish'));
                                    $tip = _CAL_LANG_TIP_FRONT_PUB;
                                    echo '&nbsp;' . mosToolTip( $tip ); ?>
                                </td>
                            </tr>
                            <tr>
                            	<td><?php echo _CAL_LANG_FIRST_DAY; ?></td>
                            	<td>
                            		<?php
                                    $first[] = mosHTML::makeOption( '0', _CAL_LANG_SUNDAY_FIRST );
                                    $first[] = mosHTML::makeOption( '1', _CAL_LANG_MONDAY_FIRST );
                                    $tosend = mosHTML::selectList( $first, 'conf_starday', '', 'value', 'text', $cfg->get('com_starday'));
                                    echo $tosend; ?>
                                </td>
                            </tr>
                            <tr>
                            	<td><?php echo _CAL_LANG_VIEW_MAIL; ?></td>
                            	<td>
                            		<?php
									echo mosHTML::yesnoRadioList('conf_mailview', '', $cfg->get('com_mailview'));
                                    ?>
                                </td>
                            </tr>
                            <tr>
                            	<td><?php echo _CAL_LANG_VIEW_BY; ?></td>
                            	<td>
									<?php
									echo mosHTML::yesnoRadioList('conf_byview', '', $cfg->get('com_byview'));
									?>
                                </td>
                            </tr>
                            <tr>
                            	<td><?php echo _CAL_LANG_VIEW_HITS; ?></td>
                            	<td>
                            		<?php
									echo mosHTML::yesnoRadioList('conf_hitsview', '', $cfg->get('com_hitsview'));
                                    ?>
                                </td>
                            </tr>
                            <tr>
                            	<td><?php echo _CAL_LANG_VIEW_REPEAT_TIME; ?></td>
                            	<td>
                            		<?php
									echo mosHTML::yesnoRadioList('conf_repeatview', '', $cfg->get('com_repeatview'));
									?>
                                </td>
                            </tr>
                            <tr>
                            	<td><?php echo _CAL_LANG_VIEW_REPEAT_YEAR_LIST; ?></td>
                            	<td>
                            		<?php
									echo mosHTML::yesnoRadioList('conf_showrepeats', '', $cfg->get('com_showrepeats'));
                                    ?>
                                </td>
                            </tr>
                            <tr>
                            	<td><?php echo _CAL_LANG_SHOW_CATS; ?></td>
                            	<td>
                            		<?php
									echo mosHTML::yesnoRadioList('conf_hideshowbycats', '', $cfg->get('com_hideshowbycats'));
                                    ?>
                                </td>
                            </tr>
                            <tr>
                            	<td><?php echo _CAL_LANG_SHOW_COPYRIGHT; ?></td>
                            	<td>
                            		<?php
									echo mosHTML::yesnoRadioList('conf_copyright', '', $cfg->get('com_copyright', 1));
                                    ?>
                                </td>
                            </tr>
                            <tr>
                            	<td><?php echo _CAL_LANG_DATE_FORMAT; ?></td>
                            	<td>
                            		<?php
                                    $datef[] = mosHTML::makeOption( '0', _CAL_LANG_DATE_FORMAT_FR_EN );
                                    $datef[] = mosHTML::makeOption( '1', _CAL_LANG_DATE_FORMAT_US );
                                    $datef[] = mosHTML::makeOption( '2', _CAL_LANG_DATE_FORMAT_GERMAN );
                                    $tosend = mosHTML::selectList( $datef, 'conf_dateformat', '', 'value', 'text', $cfg->get('com_dateformat'));
                                    echo $tosend; ?>
                                </td>
                            </tr>
                            <tr>
                            	<td><?php echo _CAL_LANG_TIME_FORMAT_12; ?></td>
                            	<td>
                            		<?php
                                    $lists['stdTime'] = mosHTML::yesnoRadioList('conf_calUseStdTime', '', $cfg->get('com_calUseStdTime'));
                                    echo $lists['stdTime']; ?>
                                </td>
                            </tr>
                            <tr>
                            	<td><?php echo _CAL_LANG_ICONIC_NAVBAR; ?></td>
                            	<td>
                            		<?php
                                    $lists['iconic'] = mosHTML::yesnoRadioList('conf_calUseIconic', '', $cfg->get('com_calUseIconic'));
                                    echo $lists['iconic']; ?>
                                </td>
                            </tr>
                            <tr>
                            	<td><?php echo _CAL_LANG_NAV_BAR_COLOR; ?></td>
                            	<td>
                            		<?php
                                    $navcol[] = mosHTML::makeOption( 'green',	_CAL_LANG_NAV_BAR_GREEN );
                                    $navcol[] = mosHTML::makeOption( 'orange',	_CAL_LANG_NAV_BAR_ORANGE );
                                    $navcol[] = mosHTML::makeOption( 'blue', 	_CAL_LANG_NAV_BAR_BLUE );
                                    $navcol[] = mosHTML::makeOption( 'red', 	_CAL_LANG_NAV_BAR_RED );
                                    $navcol[] = mosHTML::makeOption( 'gray', 	_CAL_LANG_NAV_BAR_GRAY );
                                    $navcol[] = mosHTML::makeOption( 'yellow', 	_CAL_LANG_NAV_BAR_YELLOW );

                                    $tosend = mosHTML::selectList( $navcol, 'conf_navbarcolor', '', 'value', 'text', $cfg->get('com_navbarcolor'));
                                    echo $tosend; ?>
                                </td>
                            </tr>
                            <tr>
                            	<td><?php echo _CAL_LANG_START_PAGE; ?></td>
                            	<td>
                            		<?php
                                    $startpg[] = mosHTML::makeOption( 'view_day',	_CAL_LANG_SP_DAY );
                                    $startpg[] = mosHTML::makeOption( 'view_week',	_CAL_LANG_SP_WEEK );
                                    $startpg[] = mosHTML::makeOption( 'view_month', _CAL_LANG_SP_MONTH_CAL );
                                    $startpg[] = mosHTML::makeOption( 'view_last',	_CAL_LANG_SP_MONTH_LIST );
                                    $startpg[] = mosHTML::makeOption( 'view_year',	_CAL_LANG_SP_YEAR );
                                    $startpg[] = mosHTML::makeOption( 'view_cat',	_CAL_LANG_SP_CATEGORIES );
                                    $startpg[] = mosHTML::makeOption( 'view_search', _CAL_LANG_SP_SEARCH );

                                    $tosend = mosHTML::selectList( $startpg, 'conf_startview', '', 'value', 'text', $cfg->get('com_startview'));
                                    echo $tosend; ?>
                                </td>
                            </tr>
                            <tr>
                            	<td><?php echo _CAL_LANG_NR_OF_LIST; ?></td>
                            	<td>
                            		<input type="text" size="3" name="conf_calEventListRowsPpg" value="<?php echo $cfg->get('com_calEventListRowsPpg'); ?>" />
                            		&nbsp;
                                    <?php
                                    $tip = _CAL_LANG_TIP_NR_OF_LIST;
                                    echo mosToolTip( $tip ); ?>
                            	</td>
                            </tr>
                            <tr>
                            	<td><?php echo _CAL_LANG_FE_SIMPLE_FORM; ?></td>
                                <td>
                                    <?php
                                    $lists['formOpt'] = mosHTML::yesnoRadioList('conf_calSimpleEventForm', '', $cfg->get('com_calSimpleEventForm'));
                                    echo $lists['formOpt']; ?>
                                    &nbsp;
                                    <?php
                                    $tip = _CAL_LANG_TIP_FE_SIMPLE_FORM;
                                    echo mosToolTip( $tip ); ?>
                                </td>
                            </tr>
                            <tr>
                            	<td><?php echo _CAL_LANG_DEF_EVENT_COLOR; ?></td>
                            	<td>
                            		<?php
                                    $defColor[] = mosHTML::makeOption( 'random',	_CAL_LANG_DEF_EC_RANDOM );
                                    $defColor[] = mosHTML::makeOption( 'none',		_CAL_LANG_DEF_EC_NONE );
                                    $defColor[] = mosHTML::makeOption( 'category',	_CAL_LANG_DEF_EC_CATEGORY );

                                    //$tosend = mosHTML::selectList( $defColor, 'conf_defColor', '', 'value', 'text', $conf_defColor );
                                    $lists['defColor'] = mosHTML::radioList( $defColor, 'conf_defColor', '', $cfg->get('com_defColor'), 'value', 'text' );
                                    echo $lists['defColor']; ?>
                                </td>
                            </tr>
                            <tr>
                            	<td><?php echo _CAL_LANG_DEF_EC_HIDE_FORCE; ?></td>
                            	<td>
                            		<?php
                                    //$lists['colCatOpt'] = mosHTML::yesnoRadioList('conf_calForceCatColorEventForm', '', $cfg->get('com_calForceCatColorEventForm'));
                                    //echo $lists['colCatOpt']; 
                                    $evcols = array();
                                    $evcols[] = mosHTML::makeOption( '0',	_CAL_LANG_EVENT_COLS_ALLOWED );
                                    $evcols[] = mosHTML::makeOption( '1',	_CAL_LANG_EVENT_COLS_BACKED );
                                    $evcols[] = mosHTML::makeOption( '2',   _CAL_LANG_ALWAYS_CAT_COLOR );

                                    $tosend = mosHTML::selectList( $evcols, 'conf_calForceCatColorEventForm', '', 'value', 'text', $cfg->get('com_calForceCatColorEventForm'));
                                    echo $tosend;
                                    
                                    $tip = _CAL_LANG_TIP_DEF_EC_HIDE_FORCE;
                                    echo mosToolTip( $tip ); ?>
                                </td>
                            </tr>
                            <tr>
                            	<td><?php echo _CAL_LANG_CUT_TITLE; ?></td>
                            	<td>
                            		<input type="text" size="2" name="conf_calCutTitle" value="<?php echo $cfg->get('com_calCutTitle'); ?>" />
                            		&nbsp;
                                    <?php
                                    $tip = _CAL_LANG_TIP_CUT_TITLE;
                                    echo mosToolTip( $tip ); ?>
                            	</td>
                            </tr>
                            <tr>
                            	<td><?php echo _CAL_LANG_MAX_DISPLAY; ?></td>
                            	<td>
                            		<input type="text" size="2" name="conf_calMaxDisplay" value="<?php echo $cfg->get('com_calMaxDisplay'); ?>" />
                            		&nbsp;
                                    <?php
                                    $tip = _CAL_LANG_TIP_MAX_DISPLAY;
                                    echo mosToolTip( $tip ); ?>
                            	</td>
                            </tr>
                            <tr>
                            	<td><?php echo _CAL_LANG_DIS_STARTTIME; ?></td>
                        	    <td>
                                    <?php 
									$lists['dis_starttime'] = mosHTML::yesnoRadioList( 'conf_calDisplayStarttime', 'class="inputbox"', $cfg->get('com_calDisplayStarttime'));
									echo $lists['dis_starttime']; ?>
                            		&nbsp;
                                    <?php
                                    $tip = _CAL_LANG_TIP_DIS_STARTTIME;
                                    echo mosToolTip( $tip ); ?>
                            	</td>
                            </tr>
							<tr>
								<td>
									<input class="inputbox" type="button" name="default_config" size="20" value="<?php echo _CAL_LANG_BTN_DEF_CONFIG;?>" onclick="defaultConfig_com()"/>&nbsp;
									<?php
									$tip = _CAL_LANG_TIP_BTN_DEF_CONFIG;
				        			echo mosToolTip( $tip ); ?>
								</td>
							</tr>
    					</table>
                     	<?php
                        $tabs->endTab();
                        $tabs->startTab( _CAL_LANG_TAB_CAL_MOD, 'config_cal_mod' );

                        if( file_exists( $pathCompAdminAbs . 'help/mod_events_calendar_help_' . _CAL_LANG_LNG . '.html' )){
                        	$jeventHelp = $pathCompAdminRef . 'help/mod_events_calendar_help_' . _CAL_LANG_LNG . '.html';
                        }else{
                        	$jeventHelp = $pathCompAdminRef . 'help/mod_events_calendar_help_en.html';
                        } ?>
				        <table width="100%" border="0" cellpadding="2" cellspacing="0" class="adminForm">
				        	<tr>
				        		<td colspan="2" style="color:#993300; font-weight:bold; font-size:8pt;">
				        			<?php echo _CAL_LANG_SETT_FOR_CAL_MOD; ?>
				        			&nbsp;
				        			<a href="#calendar" onclick="javascript:window.open('<?php echo $jeventHelp; ?>', 'EventsCalendarModHelp', 'width=500,height=700,scrollbars');" title="<?php echo _CAL_LANG_HELP; ?>" style="text-decoration:none;">
				        			<img src="<?php echo $pathCompAdminRef; ?>/images/help_ques_inact.gif" onMouseOver='this.src="<?php echo $pathCompAdminRef; ?>/images/help_ques.gif"' onMouseOut='this.src="<?php echo $pathCompAdminRef; ?>/images/help_ques_inact.gif"' border="0" style="vertical-align:bottom; cursor:help;" alt="<?php echo _CAL_LANG_HELP; ?>" />
				        			</a>&nbsp;
				        			<?php
				        			if( !file_exists( $mosConfig_absolute_path . '/modules/mod_events_cal.php' ) &&
				        				!file_exists( $mosConfig_absolute_path . '/modules/mod_events_cal/mod_events_cal.php' )){
				        				$tip = _CAL_LANG_MSG_MOD_NOT_INSTALLED;
				        				echo HTML_events_admin::jevWarning( $tip );
				        			} ?>
				        		</td>
				        	</tr>
				        	<tr>
				        		<td width="265"><?php echo _CAL_LANG_DISPLAY_LAST_MONTH; ?></td>
				        		<td>
				        			<?php
                                    $dispLmnth[] = mosHTML::makeOption( 'NO', 		_CAL_LANG_NO );
                                    $dispLmnth[] = mosHTML::makeOption( 'YES_stop', _CAL_LANG_DLM_YES_STOP_DAY );
                                    $dispLmnth[] = mosHTML::makeOption( 'YES_stop_events', _CAL_LANG_DLM_YES_EVENT_SDAY );
                                    $dispLmnth[] = mosHTML::makeOption( 'ALWAYS', 	_CAL_LANG_ALWAYS );
                                    $dispLmnth[] = mosHTML::makeOption( 'ALWAYS_events', _CAL_LANG_DLM_ALWYS_IF_EVENTS );

                                    $tosend = mosHTML::selectList( $dispLmnth, 'conf_modCalDispLastMonth', '', 'value', 'text', $cfg->get('modcal_DispLastMonth'));
                                    echo $tosend; ?>
                                </td>
                            </tr>
                            <tr>
                            	<td><?php echo _CAL_LANG_DLM_STOP_DAY; ?></td>
                            	<td>
                            		<input type=text size=2 name="conf_modCalDispLastMonthDays" value="<?php echo $cfg->get('modcal_DispLastMonthDays'); ?>" />
                            		&nbsp;
                            		<?php
                            		$tip = _CAL_LANG_TIP_DLM_STOP_DAY;
                            		echo mosToolTip( $tip ); ?>
                            	</td>
                            </tr>
                            <tr>
                            	<td><?php echo _CAL_LANG_DISPLAY_NEXT_MONTH; ?></td>
                            	<td>
                            		<?php
                                    $dispNmnth[] = mosHTML::makeOption( 'NO', 		_CAL_LANG_NO );
                                    $dispNmnth[] = mosHTML::makeOption( 'YES_stop',	_CAL_LANG_DNM_YES_START_DAY );
                                    $dispNmnth[] = mosHTML::makeOption( 'YES_stop_events', _CAL_LANG_DNM_YES_EVENT_SDAY );
                                    $dispNmnth[] = mosHTML::makeOption( 'ALWAYS',	_CAL_LANG_ALWAYS );
                                    $dispNmnth[] = mosHTML::makeOption( 'ALWAYS_events', _CAL_LANG_DNM_ALWYS_IF_EVENTS );

                                    $tosend = mosHTML::selectList( $dispNmnth, 'conf_modCalDispNextMonth', '', 'value', 'text', $cfg->get('modcal_DispNextMonth'));
                                    echo $tosend; ?>
                                </td>
                            </tr>
                            <tr>
                            	<td><?php echo _CAL_LANG_DNM_START_DAY; ?></td>
                            	<td>
                            		<input type=text size=2 name="conf_modCalDispNextMonthDays" value="<?php echo $cfg->get('modcal_DispNextMonthDays'); ?>" />
                            		&nbsp;
                            		<?php
                            		$tip = _CAL_LANG_TIP_DNM_START_DAY;
                            		echo mosToolTip( $tip ); ?>
                            	</td>
                            </tr>
							<tr>
								<td>
									<input class="inputbox" type="button" name="default_config" size="20" value="<?php echo _CAL_LANG_BTN_DEF_CONFIG;?>" onclick="defaultConfig_cal()"/>&nbsp;
									<?php
									$tip = _CAL_LANG_TIP_BTN_DEF_CONFIG;
				        			echo mosToolTip( $tip ); ?>
								</td>
							</tr>
                        </table>
                     	<?php
                        $tabs->endTab();
                        $tabs->startTab( _CAL_LANG_TAB_LATEST_MOD, 'config_latest_mod' );

                        if( file_exists( $pathCompAdminAbs . 'help/mod_events_latest_help_' . _CAL_LANG_LNG . '.html' )){
                        	$jeventHelp = $pathCompAdminRef . 'help/mod_events_latest_help_' . _CAL_LANG_LNG . '.html';
                        }else{
                        	$jeventHelp = $pathCompAdminRef . 'help/mod_events_latest_help_en.html';
                        } ?>
				        <table width="100%" border="0" cellpadding="2" cellspacing="0" class="adminForm">
				        	<tr>
				        		<td colspan="2" style="color:#993300; font-weight:bold; font-size:8pt;">
				        			<?php echo _CAL_LANG_SETT_FOR_MOD_LATEST; ?>
				        			&nbsp;
				        			<a href="#calendar" onclick="javascript:window.open('<?php echo $jeventHelp; ?>', 'EventsCalendarModHelp', 'width=500,height=700,scrollbars');" title="<?php echo _CAL_LANG_HELP; ?>" style="text-decoration:none;">
				        			<img src="<?php echo $pathCompAdminRef; ?>/images/help_ques_inact.gif" onMouseOver='this.src="<?php echo $pathCompAdminRef; ?>/images/help_ques.gif"' onMouseOut='this.src="<?php echo $pathCompAdminRef; ?>/images/help_ques_inact.gif"' border="0" style="vertical-align:bottom; cursor:help;" alt="<?php echo _CAL_LANG_HELP; ?>" />
				        			</a>&nbsp;
				        			<?php
				        			if( !file_exists( $mosConfig_absolute_path . '/modules/mod_events_latest.php') &&
				        				!file_exists( $mosConfig_absolute_path . '/modules/mod_events_latest/mod_events_latest.php')){
				        				$tip = _CAL_LANG_MSG_NO_MOD_LATEST;
				        				echo HTML_events_admin::jevWarning( $tip );
				        			} ?>
				        		</td>
				        	</tr>
				        	<tr>
				        		<td width="265"><?php echo _CAL_LANG_LEV_MAX_DISPLAY; ?></td>
				        		<td>
				        			<input type=text size=3 name="conf_modLatestMaxEvents" value="<?php echo $cfg->get('modlatest_MaxEvents'); ?>" />
				        		</td>
				        	</tr>
				        	<tr>
				        		<td><?php echo _CAL_LANG_LEV_DISPLAY_MODE; ?></td>
				        		<td>
				        			<?php
				        			echo mosHTML::integerSelectList( 0, 4, 1, 'conf_modLatestMode', '', $cfg->get('modlatest_Mode')); ?>
				        			&nbsp;
				        			<?php
				        			$tip = _CAL_LANG_TIP_LEV_DISPLAY_MODE;
				        			echo mosToolTip( $tip ); ?>
				        		</td>
				        	</tr>
				        	<tr>
				        		<td><?php echo _CAL_LANG_LEV_DAY_RANGE; ?></td>
				        		<td>
				        			<input type=text size=2 name="conf_modLatestDays" value="<?php echo $cfg->get('modlatest_Days'); ?>" />
				        			&nbsp;
				        			<?php
				        			$tip = _CAL_LANG_TIP_LEV_DAY_RANGE;
				        			echo mosToolTip( $tip ); ?>
				        		</td>
				        	</tr>
				        	<tr>
				        		<td><?php echo _CAL_LANG_LEV_REP_EV_ONCE; ?></td>
				        		<td>
				        			<?php
                                    $lists['NoRepeat'] = mosHTML::yesnoRadioList( 'conf_modLatestNoRepeat', '', $cfg->get('modlatest_NoRepeat'));
                                    echo $lists['NoRepeat']; ?>
                                </td>
                            </tr>
                            <tr>
                            	<td><?php echo _CAL_LANG_LEV_EV_AS_LINK; ?></td>
                            	<td>
                            		<?php
                                    $lists['dispLinks'] = mosHTML::yesnoRadioList('conf_modLatestDispLinks', '', $cfg->get('modlatest_DispLinks'));
                                    echo $lists['dispLinks']; ?>
                                </td>
                            </tr>
                            <tr>
                            	<td><?php echo _CAL_LANG_LEV_DISPLAY_YEAR; ?></td>
                            	<td>
                            		<?php
                                    $lists['dispYear'] = mosHTML::yesnoRadioList('conf_modLatestDispYear', '', $cfg->get('modlatest_DispYear'));
                                    echo $lists['dispYear']; ?>
                                    &nbsp;
                                    <?php
                                    $tip = _CAL_LANG_TIP_LEV_DISPLAY_YEAR;
                                    echo mosToolTip( $tip ); ?>
                                </td>
                            </tr>
                            <tr>
                            	<td><?php echo _CAL_LANG_LEV_CSS_DATE_FIELD; ?></td>
                                <td>
                                    <?php
                                    $lists['disDateStyle'] = mosHTML::yesnoRadioList('conf_modLatestDisDateStyle', '', $cfg->get('modlatest_DisDateStyle'));
                                    echo $lists['disDateStyle']; ?>
                                </td>
                            </tr>
                            <tr>
                            	<td><?php echo _CAL_LANG_LEV_CSS_TITLE_FIELD; ?></td>
                            	<td>
                            		<?php
                                    $lists['disTitleStyle'] = mosHTML::yesnoRadioList('conf_modLatestDisTitleStyle', '', $cfg->get('modlatest_DisTitleStyle'));
                                    echo $lists['disTitleStyle']; ?>
                                </td>
                            </tr>
							<tr>
								<td><?php echo _CAL_LANG_LEV_HIDE_LINK; ?></td>
								<td>
									<?php
									echo mosHTML::yesnoRadioList('conf_modLatestLinkCloaking', '', $cfg->get('modlatest_LinkCloaking', 0));
									echo mosToolTip( _CAL_LANG_TIP_LEV_HIDE_LINK );
									?>
								</td>
							</tr>

                            <tr>
                            	<td><?php echo _CAL_LANG_LEV_CUST_FORM_STRING; ?></td>
                            	<td>
                            		<textarea class="text_area" name="conf_modLatestCustFmtStr" id="conf_modLatestCustFmtStr" cols="50" rows="4" wrap="virtual"><?php echo stripslashes( htmlspecialchars( $cfg->get('modlatest_CustFmtStr'), ENT_QUOTES )); ?></textarea>
                            	</td>
                            </tr>
							<tr>
								<td>
									<input class="inputbox" type="button" name="default_config" size="20" value="<?php echo _CAL_LANG_BTN_DEF_CONFIG;?>" onclick="defaultConfig_latest()"/>&nbsp;
									<?php
									$tip = _CAL_LANG_TIP_BTN_DEF_CONFIG;
				        			echo mosToolTip( $tip ); ?>
								</td>
							</tr>
                        </table>
                     	<?php
                        $tabs->endTab();
                        $tabs->startTab( _CAL_LANG_TAB_CSS, 'config_css' ); ?>
				        <table width="100%" border="0" cellpadding="2" cellspacing="0" class="adminForm">
				        	<tr>
				        		<td align="center" valign="middle">
				        			<textarea rows="25" cols="100%" name="conf_style"><?php echo $conf_style;?></textarea>
				        		</td>
				        	</tr>
							<tr>
								<td>
									<input class="inputbox" type="button" name="default_config" size="20" value="<?php echo _CAL_LANG_BTN_DEF_CONFIG; ?>" onclick="defaultConfig_css()"/>&nbsp;
									<?php
									$tip = _CAL_LANG_TIP_BTN_DEF_CONFIG;
				        			echo mosToolTip( $tip ); ?>
								</td>
							</tr>
				        </table>
				        <?php
                        $tabs->endTab();
                        $tabs->startTab( _CAL_LANG_TAB_TOOLTIP, 'tooltip' ); ?>
                        <table width="100%" border="0" cellpadding="2" cellspacing="0" class="adminForm">
                        	<tr>
                                <td colspan="2" style="color:#993300; font-weight:bold; font-size:8pt;">
                                    <?php echo _CAL_LANG_TOOLTIP; ?>
                                </td>
                            </tr>
                        	<tr>
                        		<td width="50%">
                        			<fieldset>
                        				<legend><?php echo _CAL_LANG_TT_MAINWINDOW; ?></legend>
                        				<table>
                                            <tr>
                                                <td width="120"><?php echo _CAL_LANG_TT_BGROUND; ?></td>
                                                <td>
                                                <?php
                                                $lists['tt_bground'] = mosHTML::yesnoRadioList( 'conf_calTTBackground', 'class="inputbox"', $cfg->get('com_calTTBackground')); ?>
                                                    <?php echo $lists['tt_bground']; ?>
                                                    &nbsp;
                                                    <?php
                                                    $tip = _CAL_LANG_TIP_TT_BGROUND;
                                                    echo mosToolTip( $tip ); ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><?php echo _CAL_LANG_TT_POSX; ?></td>
                                                <td>
                                                    <?php
                                                    $posx[] = mosHTML::makeOption( 'LEFT',      _CAL_LANG_LEFT );
                                                    $posx[] = mosHTML::makeOption( 'CENTER',    _CAL_LANG_CENTER );
                                                    $posx[] = mosHTML::makeOption( 'RIGHT',     _CAL_LANG_RIGHT );
                                                    $lists['tt_posx'] = mosHTML::radioList( $posx, 'conf_calTTPosX', '', $cfg->get('com_calTTPosX'), 'value', 'text' ); ?>
                                                    <?php echo $lists['tt_posx']; ?>
                                                    &nbsp;
                                                    <?php
                                                    $tip = _CAL_LANG_TIP_TT_POSX;
                                                    echo mosToolTip( $tip ); ?>
                                                </td>
                                            </tr>
                                            <!-- y-position of TT: above, below (NOTE: if above, HEIGHT MUST BE SET!) -->
                                            <tr>
                                                <td><?php echo _CAL_LANG_TT_POSY; ?></td>
                                                <td>
                                                    <?php
                                                    $posy[] = mosHTML::makeOption( 'BELOW',     _CAL_LANG_BELOW );
                                                    $posy[] = mosHTML::makeOption( 'ABOVE',     _CAL_LANG_ABOVE );
                                                    $lists['tt_posy'] = mosHTML::radioList( $posy, 'conf_calTTPosY', '', $cfg->get('com_calTTPosY'), 'value', 'text' ); ?>
                                                    <?php echo $lists['tt_posy']; ?>
                                                    &nbsp;
                                                    <?php
                                                    $tip = _CAL_LANG_TIP_TT_POSY;
                                                    echo mosToolTip( $tip ); ?>
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
                                            $tip = _CAL_LANG_TIP_TT_SHADOW;
                                            echo mosToolTip( $tip ); ?>
                                    	</legend>
                                        <table>
                                            <tr>
                                                <td width="120"><?php echo _CAL_LANG_TT_SHADOW; ?></td>
                                                <td>
                                                    <?php
                                                    $lists['tt_shadow'] = mosHTML::yesnoRadioList( 'conf_calTTShadow', 'class="inputbox"', $cfg->get('com_calTTShadow') ); ?>
                                                    <?php echo $lists['tt_shadow']; ?>
                                                </td>
                                            </tr>
                                            <!-- y-position of TT-shadow: BOOL 0=below, 1=above, [ value as standard: -10 = above ] -->
                                            <tr>
                                                <td><?php echo _CAL_LANG_TT_SHADOWX; ?></td>
                                                <td>
                                                    <?php $lists['tt_shadowx'] = mosHTML::yesnoRadioList( 'conf_calTTShadowX', 'class="inputbox"', $cfg->get('com_calTTShadowX') ); ?>
                                                    <?php echo $lists['tt_shadowx']; ?>
                                                </td>
                                            </tr>
                                            <!-- y-position of TT-shadow: BOOL 0=below, 1=above, [ value as standard: -10 = above ] -->
                                            <tr>
                                                <td><?php echo _CAL_LANG_TT_SHADOWY; ?></td>
                                                <td>
                                                    <?php $lists['tt_shadowy'] = mosHTML::yesnoRadioList( 'conf_calTTShadowY', 'class="inputbox"', $cfg->get('com_calTTShadowY') ); ?>
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
									$tip = _CAL_LANG_TIP_BTN_DEF_CONFIG;
				        			echo mosToolTip( $tip ); ?>
								</td>
							</tr>
                        </table>
                        <?php
                        $tabs->endTab();
				        $tabs->startTab( _CAL_LANG_TAB_ABOUT, 'about' ); ?>
                        <table width="100%" border="0" cellpadding="2" cellspacing="0" class="adminForm">
                            <tr>
                                <td colspan="2">
                                    <?php
                                    $pathLang = $GLOBALS['mosConfig_absolute_path']
                                    . '/administrator/components/com_events/help/README_';
                                    if( file_exists( $pathLang . _CAL_LANG_LNG . '.php' )){
                                        include_once( $pathLang . _CAL_LANG_LNG . '.php' );
                                    }else{
                                        include_once( $pathLang . 'en.php' );
                                    } ?>
                                </td>
                            </tr>
                        </table>
                        <?php
                        $tabs->endTab();
                        $tabs->endPane(); ?>
                    </td>
                </tr>
            </table>
    	</form>
    	<?php
    }
    
    /**
	* Utility function to provide Warning Icons - should be in Joomla 1.5 but isn't!
	*/
    function jevWarning($warning, $title='Joomla! Warning') {
    	global $mosConfig_live_site;

    	$mouseover 	= 'return overlib(\''. $warning .'\', CAPTION, \''. $title .'\', BELOW, RIGHT);';

    	$tip 		= "<!-- Warning -->\n";
    	$tip 		.= '<a href="javascript:void(0)" onmouseover="'. $mouseover .'" onmouseout="return nd();">';
    	$tip 		.= '<img src="'. $mosConfig_live_site .'/includes/js/ThemeOffice/warning.png" border="0"  alt="warning"/></a>';

    	return $tip;
    }

}
?>