<?php
/**
 * Events Component for Joomla 1.0.x
 *
 * @version     $Id: events.html.php 1107 2008-05-31 09:20:02Z tstahl $
 * @package     Events
 * @copyright   Copyright (C) 2006 JEvents Project Group
 * @copyright   Copyright (C) 2000 - 2003 Eric Lamette, Dave McDonnell
 * @licence     http://www.gnu.org/copyleft/gpl.html
 * @link        http://joomlacode.org/gf/project/jevents
 */

// Thanks to Andrew Eddie for his help

// ################################################################
// MOS Intruder Alerts
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
// ################################################################
if( $my->id ){
	// load only if logged in (no need before [mic]
	require_once( $GLOBALS['mosConfig_absolute_path'] . '/includes/HTML_toolbar.php' );
}

// option masks
define( 'MASK_BACKTOLIST', 0x0001 );
define( 'MASK_READON',     0x0002 );
define( 'MASK_POPUP',      0x0004 );
define( 'MASK_HIDEPDF',    0x0008 );
define( 'MASK_HIDEPRINT',  0x0010 );
define( 'MASK_HIDEEMAIL',  0x0020 );
define( 'MASK_IMAGES',     0x0040 );
define( 'MASK_VOTES',      0x0080 );
define( 'MASK_VOTEFORM',   0x0100 );

define( 'MASK_HIDEAUTHOR',     0x0200 );
define( 'MASK_HIDECREATEDATE', 0x0400 );
define( 'MASK_HIDEMODIFYDATE', 0x0800 );

define( 'MASK_LINK_TITLES', 0x1000 );

// mos_content.mask masks
define( 'MASK_HIDE_TITLE', 0x0001 );
define( 'MASK_HIDE_INTRO', 0x0002 );

Class HTML_events {

	/* displays event
	 */
	function viewEventRow( $id, $title, $task, $year, $month, $day, $contactlink, $option, $Itemid, $fgcolor ="orange",$bgcolor ="inherit") {

		global $catidsOut;
		$cat = "";
		if ($catidsOut != 0){
			$cat = '&amp;catids='.$catidsOut;
		}
		$cfg = & EventsConfig::getInstance();

		$eventlink = sefRelToAbs( 'index.php?option=' . $option . '&amp;task=' . $task . '&amp;agid=' . $id
		. '&amp;year=' . $year . '&amp;month=' . $month . '&amp;day=' . $day . '&amp;Itemid=' . $Itemid . $cat );

		// [mic] if title is too long, cut 'em for display
		$tmpTitle = $title;
		if( strlen( $title ) >= 50 ){
			$tmpTitle = substr( $title, 0, 50 ) . ' ...';
		} ?>
			<a class="ev_link_row" href="<?php echo $eventlink; ?>" style="font-weight:bold;color:<?php echo $fgcolor;?>;" title="<?php echo $title ;?>"><?php echo $tmpTitle ;?></a>
			<?php
				if( $cfg->get('com_byview') == '1' ) {
					 echo _CAL_LANG_BY . '&nbsp;<i>'. $contactlink .'</i>';
				}
			?>
		<?php
	}

	/* displays categories
	 */
	function viewEventCatRow( $catid, $catname, $task, $year, $month, $day, $option, $Itemid, $fgcolor ="orange",$bgcolor ="inherit" ) {

		$eventlink = sefRelToAbs( 'index.php?option=' . $option . '&amp;task=' . $task . '&amp;catid=' . $catid
		. '&amp;year=' . $year . '&amp;month=' . $month . '&amp;day=' . $day . '&amp;Itemid=' . $Itemid );?>
		<a class="ev_link_cat" href="<?php echo $eventlink; ?>"  style="color:<?php echo $fgcolor;?>;" title="<?php echo $catname;?>"><?php echo $catname;?></a>
		<?php
	}

	function viewEventRowAdmin( $row, $task, $year, $month, $day, $deletelink, $modifylink, $contactlink, $option, $Itemid, $state) {

		$eventlink = sefRelToAbs( 'index.php?option=' . $option . '&amp;task=' . $task . '&amp;agid=' . $row->id
		. '&amp;year=' . $year . '&amp;month=' . $month . '&amp;day=' . $day . '&amp;Itemid=' . $Itemid );?>
		<li class="ev_td_li">
			<a class="<?php echo $state ? 'ev_link_row' : 'ev_link_unpublished'; ?>" style="font-weight:bold;" href="<?php echo sefRelToAbs($eventlink); ?>" title="<?php echo $row->title . ( $state ? '' : _CAL_LANG_UNPUBLISHED );?>"><?php echo $row->title . ( $state ? '' : _CAL_LANG_UNPUBLISHED );?></a>
			&nbsp;<?php echo _CAL_LANG_BY;?>
			&nbsp;<i><?php echo $contactlink;?></i>
			&nbsp;&nbsp;<?php echo $deletelink;?>&nbsp;&nbsp;<?php echo $modifylink;?>
		</li>
		<?php
	}

	function viewEventDetail ( $row, $contactlink, $mask=0, $params, $page=0 ) {
		global $option, $Itemid, $cur_template;
		global $mosConfig_live_site, $agid, $year, $month, $day,$hide_js, $my, $is_event_editor;
		// Joomla 1.5
		global $jev_dispatcher;

		$cfg = & EventsConfig::getInstance();

		// Mat Oct 5/04 show details only if called from a selected event to avoid probs with navbar
        if (isset($row)) {

            // process bots
			$row->introtext="";  // required to avoid mosimage php notice
            //$row->text      = $row->content;
			$params->set("image",1);
			// text field is the one I want to change - mambots only look at content field
			$row->text = $row->content;
			$results = $jev_dispatcher->trigger( 'onPrepareContent', array( &$row, &$params, $page ), true ); 
			$row->content = $row->text ;
			
            // Also want to cloak contact details so 
            $contactDetails = new stdClass();
			$contactDetails->text = $contactlink;            
			$jev_dispatcher->trigger( 'onPrepareContent', array( &$contactDetails, &$params, $page ), true ); 
			$contactlink=$contactDetails->text;
            ?>

            <!-- <div name="events">  -->
            <table class="contentpaneopen" border="0">
                <tr>
                    <td class="contentheading"><?php echo $row->title; ?></td>
                    <td class="buttonheading" align="right">
                        <?php
                        // dmcd Aug 6/04  allow editor/owner to modify the event from here by providing an 'edit' icon?
                        // [mic] added superadmin
                        if( $is_event_editor && ( $row->created_by == $my->id || strtolower($my->usertype ) == 'super administrator' || strtolower($my->usertype ) == 'administrator') && !( $mask & MASK_POPUP )) { ?>
                            <a href="<?php echo sefRelToAbs( 'index.php?option=com_events&amp;task=edit&amp;agid='
                            . $row->id . '&amp;Itemid=' . $Itemid ); ?>" title="<?php echo _CAL_LANG_EDIT;?>">
                                <img src="<?php echo $mosConfig_live_site;?>/images/M_images/edit.png" align="middle" name="image" border=0 alt="<?php echo _CAL_LANG_EDIT;?>" />
                            </a>
                            </td>
                            <td class="buttonheading" align="right">
                            <?php
                        }

                        if( !( $mask & MASK_HIDEPRINT ) && !$hide_js && !($mask&MASK_POPUP)) { ?>
                            <a href="javascript:void window.open('<?php echo $mosConfig_live_site; ?>/index2.php?option=com_events&amp;task=view_detail&amp;agid=<?php echo $agid; ?>&amp;year=<?php echo $year; ?>&amp;month=<?php echo $month; ?>&amp;day=<?php echo $day; ?>&amp;Itemid=<?php echo $Itemid; ?>&amp;pop=1', 'win2', 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=600,height=400,directories=no,location=no');" title="<?php echo _CAL_LANG_PRINT; ?>"><img src="<?php echo $mosConfig_live_site; ?>/images/M_images/printButton.png"  align="middle" name="image" border="0" alt="<?php echo _CAL_LANG_PRINT; ?>" /></a>
                            </td>
                            <td class="buttonheading" align="right">
                            <?php
                        }elseif( !($mask & MASK_HIDEPRINT ) && !$hide_js ) { ?>
                            <a href="#" onclick="javascript:window.print(); return false;" title="<?php echo _CAL_LANG_PRINT; ?>">
                                <img src="<?php echo $mosConfig_live_site;?>/images/M_images/printButton.png" align="middle" name="image" border="0" alt="<?php echo _CAL_LANG_PRINT;?>" />
                            </a>
                            <?php
                        } ?>
                    </td>
                </tr>
                <tr>
                    <td align="left" valign="top" colspan="4">
                        <table width="100%" border="0">
                            <tr>
                                <?php
                                if( $cfg->get('com_repeatview') == '1' ){ ?>
                                    <td class="ev_detail" width="65%">
                                        <?php

                                        if (defined("_CAL_LANG_REPEAT_GRAMMAR")){
                                        	$grammar = _CAL_LANG_REPEAT_GRAMMAR;
                                        }
                                        else $grammar=1; // i.e. follow English word order by default

										// if starttime and end time the same then show no times!

                                        if( $row->start_date == $row->stop_date ){
											if ($row->start_time != $row->stop_time) {
                                            	echo $row->start_date . ',&nbsp;' . $row->start_time
												. '&nbsp;-&nbsp;' . $row->stop_time;
											} else {
												echo $row->start_date;
											}
                                        } else {
                                        	// recurring events should have time related to recurrance not range of dates
											if ($row->start_time != $row->stop_time && !($row->reccurtype > 0)) {
												echo _CAL_LANG_FROM . '&nbsp;' . $row->start_date . '&nbsp;-&nbsp; '
												. $row->start_time . '<br />'
												. _CAL_LANG_TO . '&nbsp;' . $row->stop_date . '&nbsp;-&nbsp;'
												. $row->stop_time . '<br/>';
											} else {
												echo _CAL_LANG_FROM . '&nbsp;' . $row->start_date . '<br />'
												. _CAL_LANG_TO . '&nbsp;' . $row->stop_date . '<br/>';
											}
                                        }

                                        if( $row->reccurtype > 0 ){
                                            switch( $row->reccurtype ){
                                                case '1': $reccur = _CAL_LANG_REP_WEEK;     break;
                                                case '2': $reccur = _CAL_LANG_REP_WEEK;     break;
                                                case '3': $reccur = _CAL_LANG_REP_MONTH;    break;
                                                case '4': $reccur = _CAL_LANG_REP_MONTH;    break;
                                                case '5': $reccur = _CAL_LANG_REP_YEAR;     break;
                                            }

                                            if( $row->reccurday >= 0 || ($row->reccurtype==1 || $row->reccurtype==2)){
                                                $timeString = "";
												if ($row->start_time != $row->stop_time) {
													$timeString = $row->start_time."&nbsp;-&nbsp;".$row->stop_time."&nbsp;";
												}
												echo $timeString;
												
												if (intval($row->reccurday)<0){
													$event_start_date = strtotime($row->publish_up) ;
													$reccurday = intval(date( 'w',$event_start_date));
												}
												else $reccurday =$row->reccurday;

                                                if( $row->reccurtype == 1 ){
	                                                $dayname = mosEventsHTML::getLongDayName( $reccurday );
                                                    echo $dayname . '&nbsp;' . _CAL_LANG_EACHOF . '&nbsp;' . $reccur;
                                                }else if($row->reccurtype == 2 ){
                                                	$each =  _CAL_LANG_EACH . '&nbsp;';
                                                	if ($grammar==1){
                                                		$each = strtolower($each);
                                                	}
                                                	$daystring="";
                                                	if (strlen($row->reccurweeks)==0){
                                                		$days = explode("|",$row->reccurweekdays);
                                                		for ($d=0;$d<count($days);$d++){
                                                			$daystring .= mosEventsHTML::getLongDayName( $days[$d] );
                                                			$daystring .= ($d==0?",":"")."&nbsp;";
                                                		}
                                                		$weekstring="";
                                                	}
                                                	else {
                                                		$days = explode("|",$row->reccurweekdays);
                                                		for ($d=0;$d<count($days);$d++){
                                                			$daystring .= mosEventsHTML::getLongDayName( $days[$d] );
                                                			$daystring .= ($d==0?",":"")."&nbsp;";
                                                		}
                                                		$weekstring = $row->reccurweeks == 'pair' ? _CAL_LANG_REP_WEEKPAIR : ( $row->reccurweeks == 'impair' ? _CAL_LANG_REP_WEEKIMPAIR : "" );
                                                		if ($weekstring==""){
                                                			switch ($grammar){
                                                				case 1:
                                                					$weekstring = "- "._CAL_LANG_REP_WEEK." ";
                                                					$weekstring .= str_replace("|",", ",$row->reccurweeks)." ";
                                                					$weekstring .= strtolower(_CAL_LANG_EACHMONTH);
                                                					break;
                                                				default:
                                                					$weekstring = str_replace("|",", ",$row->reccurweeks)." ";
                                                					$weekstring .= $reccur." ";
                                                					$weekstring .= strtolower(_CAL_LANG_EACHMONTH);
                                                					break;
                                                			}
                                                		}
                                                	}
                                                	$firstword=true;
                                                	switch ($grammar){
                                                		case 1:
                                                			echo $daystring.$weekstring;
                                                			break;
                                                		default:
                                                			echo $each.$daystring.$weekstring;
                                                			break;
                                                	}
                                                } else {
                                                    echo _CAL_LANG_EACH . '&nbsp;' . $reccur;
                                                }

                                            } else {
                                                echo _CAL_LANG_EACH . '&nbsp;' . $reccur;
                                            }
                                        } else {
                                            if( $row->start_date != $row->stop_date ){
                                                echo _CAL_LANG_ALLDAYS;
                                            }
                                        } ?>
                                    </td>
                                    <?php
                                } ?>
                                <td class="ev_detail" style="width:25%;">
                                    <?php
                                    if( $cfg->get('com_byview') == '1' ){
                                    	
                                        echo _CAL_LANG_BY . '&nbsp;' . $contactlink;
                                    } ?>
                                </td>
                                <td class="ev_detail" style="width:10%;">
                                    <?php
                                    if( $cfg->get('com_hitsview') == '1' ){
                                        echo _CAL_LANG_EVENT_HITS . ' : ' . $row->hits;
                                    } ?>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr align="left" valign="top">
                    <td colspan="4"><?php echo $row->content; ?></td>
                </tr>
                <?php
                if( !empty( $row->adresse_info ) || !empty( $row->contact_info )){ ?>
                    <tr>
                        <td class="ev_detail" align="left" valign="top" colspan="4">
                            <?php
                            if( !empty( $row->adresse_info )){ ?>
                                <b><?php echo _CAL_LANG_EVENT_ADRESSE; ?>: </b><?php echo $row->adresse_info; ?>
                                <?php
                            }

                            if( !empty( $row->contact_info )){
                                if( !empty( $row->adresse_info )){ ?>
                                    <br />
                                    <?php
                                } ?>
                                <b><?php echo _CAL_LANG_EVENT_CONTACT; ?>: </b><?php echo $row->contact_info; ?>
                                <?php
                            } ?>
                        </td>
                    </tr>
                    <?php
                }

                if( !empty( $row->extra_info )){ ?>
                    <tr>
                        <td class="ev_detail" align="left" valign="top" colspan="4"><?php echo $row->extra_info; ?></td>
                    </tr>
                    <?php
                } ?>
            </table>
            <!--  </div>  -->
            <?php
            $results = $jev_dispatcher->trigger( 'onAfterDisplayContent', array( &$row, &$params, $page ) );
            echo trim( implode( "\n", $results ) );

        } else { ?>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td class="contentheading"  align="left" valign="top"><?php echo _CAL_LANG_REP_NOEVENTSELECTED; ?></td>
                </tr>
            </table>
            <?php
        }

		if(!($mask & MASK_BACKTOLIST)) { ?>
    		<p align="center">
    			<a href="javascript:window.history.go(-1);" title="<?php echo _CAL_LANG_BACK; ?>"><?php echo _CAL_LANG_BACK; ?></a>
    		</p>
    		<?php
    	} else { ?>
    		<p align="center">
    			<a href="javascript:self.close();" title="<?php echo _CAL_LANG_CLOSE;?>"><?php echo _CAL_LANG_CLOSE;?></a>
    		</p>
    		<?php
    	}
	}

	function viewNavTableText( $prev_offset, $page_bar, $next_offset, $max_offset, $option, $task, $Itemid ){
	
		global $catidsOut;
		
		$cfg = & EventsConfig::getInstance();

		$cat = "";
		if ($catidsOut != 0){
			$cat = '&amp;catids='.$catidsOut;
		} ?>

    	<table cellpadding="2" cellspacing="0" border="0" width="100%">
    		<tr class="nav_bar_cell">
    			<td align="center" class="heading" width="100%">
    				<?php
    				$link = 'index.php?option=' . $option . '&amp;task=' . $task . $cat . '&amp;Itemid=' . $Itemid
    				. '&amp;offset=';

    				$eventlinkstart = sefRelToAbs( $link . '1' );?>
    				<a href="<?php echo $eventlinkstart;?>" title="<?php echo _CAL_LANG_NAV_TN_FIRST_LIST; ?>">
    					<strong>&laquo;&laquo;</strong>
    				</a>

    				<?php $eventlinkprevoffset=sefRelToAbs( $link . $prev_offset );?>
    				<a href="<?php echo $eventlinkprevoffset;?>" title="<?php echo _CAL_LANG_NAV_TN_PREV_LIST; ?>">
    					<strong>&laquo;</strong>
    				</a>

    				<?php echo $page_bar;?>
    				<?php $eventlinknextoffset=sefRelToAbs( $link . $next_offset );?>
    				<a href="<?php echo $eventlinknextoffset;?>" title="<?php echo _CAL_LANG_NAV_TN_NEXT_LIST; ?>">
    					<strong>&raquo;</strong>
    				</a>

    				<?php $eventlinkmaxoffset=sefRelToAbs( $link . $max_offset );?>
    				<a href="<?php echo $eventlinkmaxoffset;?>" title="<?php echo _CAL_LANG_NAV_TN_LAST_LIST; ?>">
    					<strong>&raquo;&raquo;</strong>
    				</a>
    			</td>
    		</tr>
    	</table>
    	<p align="center">
    		<a href="javascript:window.history.go(-1);" title="<?php echo _CAL_LANG_BACK; ?>"><?php echo _CAL_LANG_BACK; ?></a>
    	</p>
    	<?php
	}

	function viewNavCatText( $catid, $option, $task, $Itemid ){ ?>

    	<table cellpadding="0" cellspacing="0" border="0" width="100%">
      		<tr>
        		<td align="center" width="100%">
        			<form action="index.php" method="get">
        				<input type="hidden" name="option" value="<?php echo $option; ?>" />
        				<input type="hidden" name="task" value="<?php echo $task; ?>" />
        				<input type="hidden" name="offset" value="1" />
        				<?php
        				/*Categories Select*/
        				mosEventsHTML::buildCategorySelect( $catid, 'onchange="submit(this.form)" style="font-size:10px;"' ); ?>
        				<input type="hidden" name="Itemid" value="<?php echo $Itemid; ?>" />
        			</form>
        		</td>
        	</tr>
        </table>
        <?php
    }

    function viewFormEvent( $row, $start_publish, $stop_publish, $start_time, $end_time, $lists, $Itemid, $option, $task, $mode, $catColors, $agid) {
    	global $mainframe,$mosConfig_lang, $mosConfig_live_site, $mosConfig_absolute_path;
		$mainframe->set( 'joomlaJavascript', 1 );

		require_once( $mosConfig_absolute_path . '/includes/HTML_toolbar.php' );
    	$admin_html = $mainframe->getPath( 'admin_html' ) ;
    	$admindir = dirname($admin_html);

    	// load language constants
		EventsHelper::loadLanguage('admin');

    	require_once($admin_html );

    	echo '<div align="right">';
    	
    	mosToolBar::startTable();

    	global $access;
    	if (isset($row) && isset($row->id) && $row->id>0 && isset($row->state) && $row->state==0 && $access->canPublish){
    		mosToolBar::custom("publish","publish.png","publish_f2.png","",false);
    		mosToolBar::spacer();
    	}
    	mosToolBar::save();
    	mosToolBar::spacer();
    	mosToolBar::cancel();
    	mosToolBar::endtable();
    	echo '</div>';

    	if (isset($row) && isset($row->id)) $eventid = $row->id;

    	// get list of images
    	global $mosConfig_absolute_path;
    	$imgFiles					= mosReadDirectory( $mosConfig_absolute_path . '/images/stories' );
    	$images 					= array();
    	$folders 					= array();
    	$folders[] 					= mosHTML::makeOption( '/' );

    	foreach ( $imgFiles as $file) {
    		if( is_dir( $mosConfig_absolute_path . '/images/stories/' . $file )) {
    			$folders[]	= mosHTML::makeOption( '/' . $file );
    			$folder		= mosReadDirectory( $mosConfig_absolute_path . '/images/stories/' . $file );

    			foreach( $folder as $file2 ){
    				if( eregi( 'bmp|gif|jpg|png', $file2 )
    				&& is_file( $mosConfig_absolute_path . '/images/stories/' . $file . '/' . $file2 )) {
    					$images["/$file"][] = mosHTML::makeOption( $file . '/' . $file2 );
    				}
    			}

    		}elseif( eregi( 'bmp|gif|jpg|png', $file )
    		&& is_file( $mosConfig_absolute_path . '/images/stories/' . $file )) {
    			$images['/'][] = mosHTML::makeOption( $file );
    		}
    	}

    	$lists['ilist'] = mosHTML::selectList( $images['/'], 'imagefiles',
    	"class=\"inputbox\" size=\"10\" multiple=\"multiple\""
    	. " onchange=\"previewImage('imagefiles','view_imagefiles','$mosConfig_live_site/images/stories/')\"",
    	'value', 'text', null );

    	$lists['folderlist'] = mosHTML::selectList( $folders, 'folders', 'class="inputbox" size="1" '
    	. 'onchange="changeDynaList(\'imagefiles\', folderimages, document.adminForm.folders.options[document.adminForm.folders.selectedIndex].value, 0, 0)"',
    	'value', 'text', '/' );

    	// make the list of saved images
    	$images2 = array();
		
		if (trim( $row->images )) {
			$row->images = explode( "\n", $row->images );
		} else {
			$row->images = array();
		}

		foreach ($row->images as $file) { 	 
            $temp = explode( '|', $file );    	
    		$images2[] = mosHTML::makeOption( $file, $temp[0] );
    	}

    	$lists['i2list'] = mosHTML::selectList( $images2, 'imagelist', 'class="inputbox" size="10"'
    	. " onchange=\"showImageProps('$mosConfig_live_site/images/stories/')\"",
    	'value', 'text', null );

    	// make the select list for the image positions
    	$pos[] = mosHTML::makeOption( 'left',	_CAL_LANG_LEFT );
    	$pos[] = mosHTML::makeOption( 'center',	_CAL_LANG_CENTER );
    	$pos[] = mosHTML::makeOption( 'right',	_CAL_LANG_RIGHT );

    	// build the html select list
    	$lists['poslist'] = mosHTML::selectList( $pos, '_align', 'class="inputbox" size="3"',
    	'value', 'text', null );

    	global $my , $database;
		if ($my->usertype=="Manager" || $my->usertype=="Administrator" || $my->usertype=="Super Administrator"){
			// get list of groups
			$query = "SELECT id AS value, name AS text"
			. "\n FROM #__groups"
			. "\n ORDER BY id"
			;
			$database->setQuery( $query );
			$groups = $database->loadObjectList();

			// build the html select list
			$glist = mosHTML::selectList( $groups, 'access', 'class="inputbox" size="1"',
			'value', 'text', intval( $row->access ) );
		}

    	$creator	= '';
    	$modifier	= '';
    	if( $eventid ) {
    		$query = "SELECT name"
    		. "\n FROM #__users"
    		. "\n WHERE id=$row->created_by"
    		;
    		$database->setQuery( $query );
    		$creator = $database->loadResult();

    		$query = "SELECT name"
    		. "\n FROM #__users"
    		. "\n WHERE id=$row->modified_by"
    		;
    		$database->setQuery( $query );
    		$modifier = $database->loadResult();
    	}

		$hiddenVals = "\n".'<input type="hidden" name="state" value="'.$row->state.'" />'."\n";
		$hiddenVals .= '<input type="hidden" name="created_by_alias" value="'.$row->created_by_alias.'" />';
		$hiddenVals .= '<input type="hidden" name="Itemid" value="'.$Itemid.'" />';
		/*
	 	// Captch code for anon and registered users
    	global $my;    	
    	if ($my->gid<2){
    		mosToolBar::spacer();
    		if (file_exists($mosConfig_absolute_path.'/administrator/components/com_securityimages/client.php')) {
				include_once($mosConfig_absolute_path.'/administrator/components/com_securityimages/client.php'); 
		    	$secImg =  insertSecurityImage("security_refid"); 
		    	$hiddenVals .= $secImg;
		    	$hiddenVals .= getSecurityImageText("security_try"); 
    		}
    	}
    	*/

		$glist = null;
		$section = 0; // NO YET IMPLEMENTED

    	HTML_events_admin::editEvents( $row,  $start_publish, $stop_publish, $start_time, $end_time, $section,
    	$glist, $images, $creator, $modifier, $option, $mode, $catColors, $lists, $hiddenVals);
    }

    function viewNavTableBarIconic( $today_date, $this_date, $dates, $alts, $option, $task, $Itemid ) {
    	global $catidsOut;
    	global $mosConfig_live_site;
		global $pop;
		if ($pop) return;
    	
		$cfg = & EventsConfig::getInstance();

    	$cat		= "";
    	$hiddencat	= "";
    	if ($catidsOut!=0){
    		$cat = '&amp;catids=' . $catidsOut;
    		$hiddencat = '<input type="hidden" name="catids" value="'.$catidsOut.'"/>';
    	}

		$imgSingle = '<img border="0" src="' . $mosConfig_live_site . '/components/' . $option
		. '/images/'; // width="13" height="13" [mic]
    	$imgDouble = '<img border="0" src="' . $mosConfig_live_site . '/components/' . $option
		. '/images/'; // width="19" height="13" [mic]
    	$gg	= $imgDouble . 'gg_' . $cfg->get('com_navbarcolor') . '.gif" alt="' . $alts['prev2'] . '" />';
    	$g	= $imgSingle . 'g_' . $cfg->get('com_navbarcolor') . '.gif" alt="' . $alts['prev1'] . '" />';
    	$d	= $imgSingle . 'd_' . $cfg->get('com_navbarcolor') . '.gif" alt="' . $alts['next1'] . '" />';
    	$dd = $imgDouble . 'dd_' . $cfg->get('com_navbarcolor') . '.gif" alt="' . $alts['next2'] . '" />';

		$link = 'index.php?option=' . $option . '&amp;task=' . $task . $cat . '&amp;Itemid=' . $Itemid. '&amp;';
    	$prev2 = '<a href="' . sefRelToAbs( $link . $dates['prev2']->toDateURL() )
    	. '" title="' . $alts['prev2'] . '">' . $gg . '</a>' . "\n";
    	$prev1 = '<a href="' . sefRelToAbs( $link . $dates['prev1']->toDateURL() )
    	. '" title="' . $alts['prev1'] . '">' . $g . '</a>' . "\n";
    	$next1 = '<a href="' . sefRelToAbs( $link . $dates['next1']->toDateURL() )
    	. '" title="' . $alts['next1'] . '">' . $d . '</a>' . "\n";
    	$next2 = '<a href="' . sefRelToAbs( $link . $dates['next2']->toDateURL() )
    	. '" title="' . $alts['next2'] . '">'.$dd.'</a>'."\n";
    	$transparentGif = $mosConfig_live_site."/components/com_events/images/transp.gif";
    	?>
    	<div class="ev_navigation" style="width:100%">
    		<table  border="0" align="center" >
    			<tr align="center" valign="top">
	        		<td width="10" align="center" valign="middle"><?php echo $prev2; ?></td>
    	    		<td width="10" align="center" valign="middle"><?php echo $prev1; ?></td>
    				<td class="iconic_td" align="center" valign="middle">
    					<div id="ev_icon_yearly" class="nav_bar_cal"><a href="<?php echo sefRelToAbs( 'index.php?option=' . $option . $cat . '&amp;task=view_year&amp;'. $today_date->toDateURL() . '&amp;Itemid=' . $Itemid );?>" title="<?php echo  _CAL_LANG_VIEWBYYEAR;?>"> 
    					<img src="<?php echo $transparentGif;?>" alt="<?php echo _CAL_LANG_VIEWBYYEAR;?>"/></a>
    					</div>
                    </td>
    				<td class="iconic_td" align="center" valign="middle">
    					<div id="ev_icon_monthly" class="nav_bar_cal" ><a href="<?php echo sefRelToAbs( 'index.php?option=' . $option . $cat . '&amp;task=view_month&amp;'. $today_date->toDateURL() . '&amp;Itemid=' . $Itemid );?>" title="<?php echo  _CAL_LANG_VIEWBYMONTH;?>">
    					<img src="<?php echo $transparentGif;?>" alt="<?php echo _CAL_LANG_VIEWBYMONTH;?>"/></a>
    					</div>
                    </td>
    				<td class="iconic_td" align="center" valign="middle">
    					<div id="ev_icon_weekly" class="nav_bar_cal"><a href="<?php echo sefRelToAbs( 'index.php?option=' . $option . $cat . '&amp;task=view_week&amp;'. $today_date->toDateURL() . '&amp;Itemid=' . $Itemid );?>" title="<?php echo  _CAL_LANG_VIEWBYWEEK;?>">
    					<img src="<?php echo $transparentGif;?>" alt="<?php echo _CAL_LANG_VIEWBYWEEK;?>"/></a>
    					</div>
                    </td>
    				<td class="iconic_td" align="center" valign="middle">
    					<div id="ev_icon_daily" class="nav_bar_cal" ><a href="<?php echo sefRelToAbs( 'index.php?option=' . $option . $cat . '&amp;task=view_day&amp;'. $today_date->toDateURL() . '&amp;Itemid=' . $Itemid );?>" title="<?php echo  _CAL_LANG_VIEWTODAY;?>"><img src="<?php echo $transparentGif;?>" alt="<?php echo _CAL_LANG_VIEWBYDAY;?>"/></a>
    					</div>
                    </td>
    				<td class="iconic_td" align="center" valign="middle">
    					<div id="ev_icon_search" class="nav_bar_cal"><a href="<?php echo sefRelToAbs( 'index.php?option=' . $option . $cat . '&amp;task=view_search&amp;'. $today_date->toDateURL() . '&amp;Itemid=' . $Itemid );?>" title="<?php echo  _CAL_LANG_SEARCH_TITLE;?>"><img src="<?php echo $transparentGif;?>" alt="<?php echo _CAL_LANG_SEARCH_TITLE;?>"/></a>
    					</div>
                    </td>                
    				<td class="iconic_td" align="center" valign="middle">
    					<div id="ev_icon_jumpto" class="nav_bar_cal"><a onclick="jtdisp = document.getElementById('jumpto').style.display;document.getElementById('jumpto').style.display=(jtdisp=='none')?'block':'none';" title="<?php echo   _CAL_LANG_JUMPTO;?>"><img src="<?php echo $transparentGif;?>" alt="<?php echo  _CAL_LANG_JUMPTO;?>"/></a>
    					</div>
                    </td>                
	        		<td width="10" align="center" valign="middle"><?php echo $next1; ?></td>
    	    		<td width="10" align="center" valign="middle"><?php echo $next2; ?></td>
                </tr>
    			<tr class="icon_labels" align="center" valign="top">
	        		<td colspan="2"></td>
    				<td class="iconic_td" ><?php echo _CAL_LANG_VIEWBYYEAR;?></td>
    				<td class="iconic_td" ><?php echo _CAL_LANG_VIEWBYMONTH;?></td>
    				<td class="iconic_td" ><?php echo _CAL_LANG_VIEWBYWEEK;?></td>
    				<td class="iconic_td" ><?php echo _CAL_LANG_VIEWTODAY;?></td>
    				<td class="iconic_td" ><?php echo _CAL_LANG_SEARCH_TITLE;?></td>
    				<td class="iconic_td" ><?php echo  _CAL_LANG_JUMPTO;?></td>
	        		<td colspan="2"></td>
                </tr>
    			<tr align="center" valign="top">
 	        		<td colspan="10" align="center" valign="top">
 	        		<div id="jumpto"  style="display:none">
        			<form name="BarNav" action="index.php" method="get">
        				<input type="hidden" name="option" value="<?php echo $option;?>" />
        				<input type="hidden" name="task" value="view_month" />
        				<?php
        				echo $hiddencat;
        				/*Day Select*/
        				// mosEventsHTML::buildDaySelect( $this_date->getYear(1), $this_date->getMonth(1), $this_date->getDay(1), ' style="font-size:10px;"' );
        				/*Month Select*/
        				mosEventsHTML::buildMonthSelect( $this_date->getMonth(1), 'style="font-size:10px;"');
        				/*Year Select*/
        				mosEventsHTML::buildYearSelect( $this_date->getYear(1), 'style="font-size:10px;"' ); ?>
        				<button onclick="submit(this.form)"><?php echo   _CAL_LANG_JUMPTO;?></button>
        				<input type="hidden" name="Itemid" value="<?php echo $Itemid; ?>" />
        			</form>
        			</div>
    	    		</td>
                </tr>
            </table>
        </div>
		<?php    	
    }

	/**
    ***************************
    *     << < --NAV BAR-- > >>
    ***************************
    * prev2 prev1 next1 next2
    *  <<     <     >     >>
    */
    function viewNavTableBar( $today_date, $this_date, $dates, $alts, $option, $task, $Itemid ) {
    	
    	global $catidsOut;
    	global $mosConfig_live_site;
		global $pop;
		if ($pop) return;
    	
		$cfg = & EventsConfig::getInstance();

    	$cat		= "";
    	$hiddencat	= "";
    	if ($catidsOut!=0){
    		$cat = '&amp;catids=' . $catidsOut;
    		$hiddencat = '<input type="hidden" name="catids" value="'.$catidsOut.'"/>';
    	}

		$imgSingle = '<img border="0" src="' . $mosConfig_live_site . '/components/' . $option
		. '/images/'; // width="13" height="13" [mic]
    	$imgDouble = '<img border="0" src="' . $mosConfig_live_site . '/components/' . $option
		. '/images/'; // width="19" height="13" [mic]
    	$gg	= $imgDouble . 'gg_' . $cfg->get('com_navbarcolor') . '.gif" alt="' . $alts['prev2'] . '" />';
    	$g	= $imgSingle . 'g_' . $cfg->get('com_navbarcolor') . '.gif" alt="' . $alts['prev1'] . '" />';
    	$d	= $imgSingle . 'd_' . $cfg->get('com_navbarcolor') . '.gif" alt="' . $alts['next1'] . '" />';
    	$dd = $imgDouble . 'dd_' . $cfg->get('com_navbarcolor') . '.gif" alt="' . $alts['next2'] . '" />';

		$link = 'index.php?option=' . $option . '&amp;task=' . $task . $cat . '&amp;Itemid=' . $Itemid. '&amp;';
    	$prev2 = '<a href="' . sefRelToAbs( $link . $dates['prev2']->toDateURL() )
    	. '" title="' . $alts['prev2'] . '">' . $gg . '</a>' . "\n";
    	$prev1 = '<a href="' . sefRelToAbs( $link . $dates['prev1']->toDateURL() )
    	. '" title="' . $alts['prev1'] . '">' . $g . '</a>' . "\n";
    	$next1 = '<a href="' . sefRelToAbs( $link . $dates['next1']->toDateURL() )
    	. '" title="' . $alts['next1'] . '">' . $d . '</a>' . "\n";
    	$next2 = '<a href="' . sefRelToAbs( $link . $dates['next2']->toDateURL() )
    	. '" title="' . $alts['next2'] . '">'.$dd.'</a>'."\n";

    	$today_link = '<a class="nav_bar_link_' . $cfg->get('com_navbarcolor') . '" href="'
    	. sefRelToAbs( 'index.php?option=' . $option . $cat . '&amp;task=view_day&amp;'
    	. $today_date->toDateURL() . '&amp;Itemid=' . $Itemid )
    	. '" title="' . _CAL_LANG_VIEWTODAY . '">' . _CAL_LANG_VIEWTODAY . '</a>' . "\n";
    	//$current_month_link = '<a class="nav_bar_link" href="index.php?option='.$option.$cat.'&task=view_month&'.$this_date->toDateURL().'&Itemid='.$Itemid.'">'._CAL_LANG_VIEWBYMONTH.'</a>'."\n";
    	//$current_week_link = '<a class="nav_bar_link" href="index.php?option='.$option.$cat.'&task=view_week&'.$this_date->toDateURL().'&Itemid='.$Itemid.'">'._CAL_LANG_VIEWBYWEEK.'</a>'."\n";
    	//$archive_link = '<a class="nav_bar_link" href="index.php?option='.$option.$cat.'&task=view_year&year='.$this_date->getYear(1).'&Itemid='.$Itemid.'">'._CAL_LANG_ARCHIVE.'&nbsp;'.$this_date->getYear(1).'</a>'."\n";
    	//$categories_link = '<a class="nav_bar_link" href="index.php?option='.$option.$cat.'&task=view_cat&'.$this_date->toDateURL().'&Itemid='.$Itemid.'">'._CAL_LANG_VIEWBYCAT.'</a>'."\n";
    	$lastmonth_link = '<a class="nav_bar_link_' . $cfg->get('com_navbarcolor') . '" href="'
    	. sefRelToAbs( 'index.php?option=' . $option . '&amp;task=view_last&amp;'
    	. $today_date->toDateURL() . '&amp;Itemid=' . $Itemid . $cat)
    	. '" title="' . _CAL_LANG_VIEWTOCOME . '">' . _CAL_LANG_VIEWTOCOME . '</a>' . "\n"; ?>
    	
		<div class="ev_navigation" style="width:100%">
    		<table width="300" border="0" align="center" >
    			<tr align="center" valign="top">
    				<td height="1" width="100" align="right" valign="top">
    					<?php echo $today_link; ?>
    				</td>
    				<td height="1" align="center" valign="bottom">
    					<form name="ViewSelect" action="index.php" method="get">
                            <input type="hidden" name="Itemid" value="<?php echo $Itemid;?>" />
                            <input type="hidden" name="option" value="<?php echo $option;?>" />
                            <input type="hidden" name="year" value="<?php echo $this_date->getYear(1);?>" />
                            <input type="hidden" name="month" value="<?php echo $this_date->getMonth(1);?>" />
                            <input type="hidden" name="day" value="<?php echo $this_date->getDay(1);?>" />
                            <?php
                            echo $hiddencat;
                            mosEventsHTML::buildViewSelect( $task, 'onchange="submit(this.form)" style="font-size:10px;"' ); ?>
                        </form>
                    </td>
                    <td height="1" width="100" align="left" valign="top">
                    	<?php echo $lastmonth_link; ?>
                    </td>
                </tr>
            </table>

        <table width="300" border="0" align="center">
        	<tr valign="top">
        		<td width="10" align="center" valign="top"><?php echo $prev2; ?></td>
        		<td width="10" align="center" valign="top"><?php echo $prev1; ?></td>
        		<td align="center" valign="top">
        			<form name="BarNav" action="index.php" method="get">
        				<input type="hidden" name="option" value="<?php echo $option;?>" />
        				<input type="hidden" name="task" value="<?php echo $task;?>" />
        				<?php
        				echo $hiddencat;
        				/*Day Select*/
        				mosEventsHTML::buildDaySelect( $this_date->getYear(1), $this_date->getMonth(1), $this_date->getDay(1), 'onchange="submit(this.form)" style="font-size:10px;"' );
        				/*Month Select*/
        				mosEventsHTML::buildMonthSelect( $this_date->getMonth(1), 'onchange="submit(this.form)" style="font-size:10px;"');
        				/*Year Select*/
        				mosEventsHTML::buildYearSelect( $this_date->getYear(1), 'onchange="submit(this.form)" style="font-size:10px;"' ); ?>
        				<input type="hidden" name="Itemid" value="<?php echo $Itemid; ?>" />
        			</form>
        		</td>
        		<td width="10" align="center" valign="top"><?php echo $next1; ?></td>
        		<td width="10" align="center" valign="top"><?php echo $next2; ?></td>
        	</tr>
        </table>
        </div>
        <br />
        <?php
    }

	function viewNavAdminPanel( $year, $month, $day, $option, $Itemid ){
		global $is_event_editor, $my; 
		global $pop;
		if ($pop) return;

		$cfg = & EventsConfig::getInstance();

		if( $is_event_editor) { ?>
		<div class="ev_adminpanel">
		<table width="100%" border="0" align="center">
			<tr>
				<td align="left" class="nav_bar_cell">
                        <?php
                        $eventlinkadd = sefRelToAbs( 'index.php?option=' . $option
                        . '&amp;task=edit' . '&amp;year=' . $year . '&amp;month=' . $month . '&amp;day=' . $day
                        . '&amp;Itemid=' . $Itemid ); ?>
                        <a href="<?php echo $eventlinkadd; ?>" title="<?php echo _CAL_LANG_ADDEVENT;?>">
                            <b><?php echo _CAL_LANG_ADDEVENT;?></b>
                        </a>
                        <br />
                        <?php
                        if(( strtolower( $my->usertype ) != '' )) {
                            $eventmylinks = sefRelToAbs( 'index.php?option=' . $option . '&amp;task=admin'
                            . '&amp;year=' . $year . '&amp;month=' . $month . '&amp;day=' . $day
                            . '&amp;Itemid=' . $Itemid ); ?>
                            <a href="<?php echo $eventmylinks; ?>" title="<?php echo _CAL_LANG_MYEVENTS; ?>">
                                <b><?php echo _CAL_LANG_MYEVENTS; ?></b>
                            </a>
                            <?php
                        }?>
				</td>
			</tr>
		</table>
		</div>
		<?php	} 
	}

	
	function eventsHeader( $Itemid, $year, $month, $day, $task) {

		$version = & EventsVersion::getInstance();

		echo "\n" . '<!-- '
			. $version->getLongVersion() . ', '
			. $version->getLongCopyright() . ', '
			. $version->getUrl()
			. ' -->' . "\n";
		?>
		<table class="contentpaneopen"  id="jevents_header">
			<tr>
			<td class="contentheading" width="100%">
			<?php 
			global $menu;
			if (isset($menu) && isset($menu->name)) echo $menu->name;
			else echo _CAL_LANG_EVENT_CALENDAR;
			?>
			</td>
			<?php
			if ($task == "view_year" ||  $task == "view_month" || $task == "view_week" || $task == "view_day"  || $task == "view_last"){
				global $mosConfig_live_site, $hide_js, $pop, $catidsOut;
				if (!empty($catidsOut)) $cids = "&amp;catids=$catidsOut";
				else $cids = "";
				// link used by print button
				$print_link = $mosConfig_live_site. "/index2.php?option=com_events&amp;Itemid=$Itemid&amp;task=$task&amp;month=$month&amp;year=$year&amp;pop=1$cids";
				$row = 1; // not used in PrintIcon !!
				$params =& new mosParameters(null);
				$params->set("print",true);
				$params->set("icons",true);
				if ($pop) $params->set("popup",true);
				mosHTML::PrintIcon( $row, $params, false, $print_link );
			}
			?>
			</tr>
		</table>
		<table class="contentpaneopen"  id="jevents_body">
			<tr>
			<td width="100%">
	<?php }
	
	function eventsFooter( $Itemid, $year, $month, $day, $task) {
		HTML_events::viewCopyright ();
		?>
		   </td>
		   </tr>
		</table>
	<?php }

	function viewCopyright() {

	global $mainframe;

	$cfg	 = & EventsConfig::getInstance();

	$version = & EventsVersion::getInstance();

	if ($cfg->get('com_copyright', 1) == 1) {
?>
		<p align="center">
			<a href="<?php echo $version->getUrl();?>" target="_blank" style="font-size:xx-small;" title="Events Website"><?php echo $version->getLongVersion();?></a>
			&nbsp;
			<span style="color:#999999; font-size:9px;"><?php echo $version->getShortCopyright();?></span>
		</p>
		<?php
	}
	}

  	function viewSearchForm( $keyword, $option, $task, $Itemid ){ ?>

    	<table cellpadding="0" cellspacing="0" border="0" width="100%">
      		<tr>
      			<td align="center" width="100%">
      				<form action="index.php" method="get" style="font-size:1;">
      					<input type="hidden" name="option" value="<?php echo $option; ?>" />
      					<input type="hidden" name="task" value="search" />
      					<input type="hidden" name="Itemid" value="<?php echo $Itemid;?>" />
      					<input type="text" name="keyword" size="30" maxlength="50" class="inputbox" value="<?php echo $keyword;?>" />
      					<br />
      					<input class="button" type="submit" name="push" value="<?php echo _CAL_LANG_SEARCH_TITLE; ?>" />
      				</form>
      			</td>
      		</tr>
      	</table>
      	<?php
    }
}
?>
