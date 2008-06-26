<?php
/**
 * Events Component for Joomla 1.5.x
 *
 * @version     $Id: eventsView.php 978 2008-02-16 15:29:27Z tstahl $
 * @package     Events
 * @copyright   Copyright (C) 2006-2007 JEvents Project Group
 * @licence     http://www.gnu.org/copyleft/gpl.html
 * @link        http://joomlacode.org/gf/project/jevents
 */

/**
 * My use of the $data struct should be replaced by classes for day data, week data, month daya (simple and calendar) etc. 
 * This works pretty well for a generation 1 generalisation - walk before running!
 */

defined('_JEXEC') or die( 'Direct Access to this location is not allowed.' );

EventsViewer::setViewClassName("front","JEvents_Default_View");

Class JEvents_Default_View  extends HTML_events {

	function getViewName()
	{
		return "default";
	}

	/**
	 * Creates mini event dialog for view detail page etc.
	 * note this must be contained in a position:relative block element in order to work
	 *
	 * @param Jevent or descendent $row
	 */
	function eventManagementDialog($row, $mask){

		global $mainframe;

		if( $row->canUserEdit() && !( $mask & MASK_POPUP )) {
			$pathIMG = JURI::root() . 'administrator/images/';
			$editImg = $pathIMG."/edit_f2.png";
			$editLink = $row->editLink();
			$editRepeatImg = $pathIMG."/copy_f2.png";
			$editRepeatLink = $row->editRepeatLink();
			$deleteImg = $pathIMG."/delete_f2.png";
			$deleteLink = $row->deleteLink();
			$deleteRepeatImg = $pathIMG."/delete_f2.png";
			$deleteRepeatLink = $row->deleteRepeatLink();
            ?>
            <div id="action_dialog"  style="position:absolute;right:0px;background-color:#dedede;border:solid 1px #000000;width:150px;padding:10px;visibility:hidden">
            	<div style="width:12px!important;float:right;background-color:#ffffff;;border:solid #000000;border-width:0 0 1px 1px;text-align:center;margin:-10px;">
            		<a href="javascript:void(0)" onclick="closedialog()" style="font-weight:bold;text-decoration:none;color:#000000;">x</a>
            	</div>
                 <?php
                 if ($editRepeatLink!=""){
                 ?>
                 <a href="<?php echo $editRepeatLink;?>" id="edit_reccur"  title="edit event" style="text-decoration:none;"><img src="<?php echo $editRepeatImg; ?>" style="width:20px;height:20px;border:0px;margin-right:1em;" alt="" />Edit Recurrence</a><br/>
                 <?php
                 }
                 ?>
            	<a href="<?php echo $editLink;?>" id="edit_event" title="edit event" style="text-decoration:none;"><img src="<?php echo $editImg; ?>" style="width:20px;height:20px;border:0px;margin-right:1em;" alt="" />Edit Event</a><br/>
                 <?php
                 if ($deleteRepeatLink!=""){
                 ?>
                 <a href="<?php echo $deleteRepeatLink;?>" onclick="return confirm('Are you sure you want to delete this recurrence?')" id="delete_repeat"  title="delete repeat" style="text-decoration:none;"><img src="<?php echo $deleteRepeatImg; ?>"  style="width:20px;height:20px;border:0px;margin-right:1em;" alt="" />Delete Recurrence</a><br/>
                 <?php
                 }
                 ?>
                 <a href="<?php echo $deleteLink;?>" onclick="return confirm('Are you sure you with to delete this event and all its repeat?')" id="delete_event"  title="delete event" style="text-decoration:none;"><img src="<?php echo $deleteImg; ?>"  style="width:20px;height:20px;border:0px;margin-right:1em;" alt="" />Delete Event</a><br/>
            </div>
            <?php
		}
	}
	
	function eventIcalDialog($row, $mask){

		global $mainframe;
		$cfg = & EventsConfig::getInstance();
		$option = $cfg->get("com_componentname");

        ?>
        <div id="ical_dialog"  style="position:absolute;right:0px;background-color:#dedede;border:solid 1px #000000;width:200px;padding:10px;visibility:hidden">
        	<div style="width:12px!important;float:right;background-color:#ffffff;;border:solid #000000;border-width:0 0 1px 1px;text-align:center;margin:-10px;">
        		<a href="javascript:void(0)" onclick="closeical()" style="font-weight:bold;text-decoration:none;color:#000000;">x</a>
        	</div>
        	<a href="<?php echo $row->vCalExportLink(false,false);?>" style="text-decoration:none;" title="vCalendar export">
        	<?php
             echo '<img src="'. JURI::root() . 'components/'.$option.'/images/vcal.gif" style="border:0px;margin-right:1em;border="0"" alt="vCalendar export"  />';
             ?>
             All Recurrences
             </a><br/>
        	<a href="<?php echo $row->vCalExportLink(false,true);?>" style="text-decoration:none;" title="vCalendar export">
        	<?php
             echo '<img src="'. JURI::root() . 'components/'.$option.'/images/vcal.gif" alt="vCalendar export" style="border:0px;margin-right:1em;border:0px"  alt="vCalendar export"  />';
             ?>
             Single Recurrence
             </a><br/>
        </div>
        <?php
	}

	function viewEventDetail ( $row, $mask=0, $page=0 ) {
		global $mainframe,  $cur_template;
		$cfg = & EventsConfig::getInstance();
		$option = $cfg->get("com_componentname");
		$Itemid	= EventsHelper::getItemid();
		$agid = EventsHelper::getAGID();
		$is_event_editor = EventsHelper::isEventEditor();
		list($year,$month,$day) = EventsHelper::getYMD();
		$user =& JFactory::getUser();

		$dispatcher	=& JDispatcher::getInstance();
		$params =& new JParameter(null);

		$cfg = & EventsConfig::getInstance();

		if (isset($row)) {
            ?>
            <!-- <div name="events">  -->
            <table class="contentpaneopen" border="0">
                <tr>
                    <td  width="100%" class="contentheading"><?php echo $row->title(); ?></td>
                    <td  width="20" class="buttonheading" align="right">
						<?php
						$jevtype=JRequest::getVar('jevtype',"jevent" );
						if ($jevtype=="jevent"){
						
						echo jEventsLinkCloaking(
						$row->vCalExportLink(),
						'<img src="'. JURI::root() . 'components/'.$option.'/images/vcal.gif" align="middle" alt="vCalendar export" border="0" />',
						array('title' => '"vCalendar export"'));
						}
							
						else {
							$cfg = & EventsConfig::getInstance();
							$jev_component_name  = $cfg->get("com_componentname");
							$mainframe->addCustomHeadTag("<script language='JavaScript' type='text/javascript'  src='"
							. JURI::root()
							. "administrator/components/$jev_component_name/js/view_detail.js'></script>");
							?>
                            <a href="javascript:void(0)" onclick='clickIcalButton()' title="<?php echo _E_EDIT;?>">
                                <img src="<?php echo JURI::root().'components/'.$option.'/images/vcal.gif'?>" align="middle" name="image" border=0 alt="<?php echo _E_EDIT;?>" />
                            </a>
							<?php
						}
						if( $row->canUserEdit() && !( $mask & MASK_POPUP )) {
							$cfg = & EventsConfig::getInstance();
							$jev_component_name  = $cfg->get("com_componentname");
							$mainframe->addCustomHeadTag("<script language='JavaScript' type='text/javascript'  src='"
							. JURI::root()
							. "administrator/components/$jev_component_name/js/view_detail.js'></script>");
                        	?>
                            <td  width="20" class="buttonheading" align="right">
                            <a href="javascript:void(0)" onclick='clickEditButton()' title="<?php echo _E_EDIT;?>">
                                <img src="<?php echo JURI::root();?>images/M_images/edit.png" align="middle" name="image" border=0 alt="<?php echo _E_EDIT;?>" />
                            </a>
                            </td>
                            <?php
						}

                        if( !( $mask & MASK_HIDEPRINT ) && !($mask&MASK_POPUP)) { ?>
                            <td  width="20" class="buttonheading" align="right">
                            <a href="javascript:void window.open('<?php echo JURI::root(); ?>index2.php?option=<?php echo $option?>&task=view_detail&agid=<?php echo $agid; ?>&year=<?php echo $year; ?>&month=<?php echo $month; ?>&day=<?php echo $day; ?>&Itemid=<?php echo $Itemid; ?>&pop=1', 'win2', 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=600,height=400,directories=no,location=no');" title="<?php echo _CMN_PRINT; ?>"><img src="<?php echo JURI::root(); ?>images/M_images/printButton.png"  align="middle" name="image" border="0" alt="<?php echo _CMN_PRINT; ?>" /></a>
                            </td>
                            <?php
                        }elseif( !($mask & MASK_HIDEPRINT )  ) { ?>
                            <td width="20" class="buttonheading" align="right">
                            <a href="#" onclick="javascript:window.print(); return false;" title="<?php echo _CMN_PRINT; ?>">
                                <img src="<?php echo JURI::root();?>images/M_images/printButton.png" align="middle" name="image" border="0" alt="<?php echo _CMN_PRINT;?>" />
                            </a>
		                    </td>
                            <?php
                        } ?>
                </tr>
                <tr>
                    <td align="left" valign="top" colspan="3">
                    <div style="position:relative;">
                    <?php
                    $this->eventIcalDialog($row, $mask);
                    ?>
                    </div>
                    </td>
                    <td align="left" valign="top">
                    <div style="position:relative;">
                    <?php
                    $this->eventManagementDialog($row, $mask);
                    ?>
                    </div>
                    </td>
                    <td />
                </tr>
                <tr>
                    <td align="left" valign="top" colspan="4">
                        <table width="100%" border="0">
                            <tr>
                                <?php                                
                                if( $cfg->get('com_repeatview') == '1' ){ ?>
                                    <td class="ev_detail" style="width:50%;">
                                        <?php
                                        echo $row->repeatSummary();
                                        echo "<td/>";
                                } ?>
                                <td class="ev_detail" style="width:25%;">
                                    <?php
                                    if( $cfg->get('com_byview') == '1' ){

                                    	echo _CAL_LANG_BY . '&nbsp;' . $row->contactlink();
                                    } ?>
                                </td>
                                <td class="ev_detail" style="width:25%;">
                                    <?php
                                    if( $cfg->get('com_hitsview') == '1' ){
                                    	echo _CAL_LANG_EVENT_HITS . ' : ' . $row->hits();
                                    } ?>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr align="left" valign="top">
                    <td colspan="4"><?php echo $row->content(); ?></td>
                </tr>
                <?php
                if ($row->hasLocation() || $row->hasContactInfo()) { ?>
                    <tr>
                        <td class="ev_detail" align="left" valign="top" colspan="4">
                            <?php
                            if( $row->hasLocation() ){
                            	echo "<b>"._CAL_LANG_EVENT_ADRESSE." : </b>". $row->location();
                            }

                            if( $row->hasContactInfo()){
                            	if(  $row->hasLocation()){
                            		echo "<br/>";
                            	}
                            	echo "<b>"._CAL_LANG_EVENT_CONTACT." : </b>". $row->contact_info();
                            } ?>
                        </td>
                    </tr>
                    <?php
                }

                if( $row->hasExtraInfo()){ ?>
                    <tr>
                        <td class="ev_detail" align="left" valign="top" colspan="4"><?php echo $row->extra_info(); ?></td>
                    </tr>
                    <?php
                } ?>
            </table>
            <!--  </div>  -->
            <?php
            $results = $dispatcher->trigger( 'onAfterDisplayContent', array( &$row, &$params, $page ) );
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

	function _genericMonthNavigation($dates, $alts, $which, $icon){
		global $mainframe;
		$cfg = & EventsConfig::getInstance();
		$task 	= JRequest::getVar(	'task',	$cfg->get('com_startview'));
		$jev_component_name  = $cfg->get("com_componentname");
		$Itemid = EventsHelper::getItemid();
		$cat = $this->datamodel->getCatidsOutLink();
		$link = 'index.php?option=' . $jev_component_name . '&task=' . $task . $cat . '&Itemid=' . $Itemid. '&';

		$gg	="<img border='0' src='"
		. JURI::root()
		. "components/$jev_component_name/images/$icon"."_"
		. $cfg->get('com_navbarcolor').".gif' alt='".$alts[$which]."'/>";

		$thelink = '<a href="'.JRoute::_($link.$dates[$which]->toDateURL()).'" title="'.$alts[$which].'">'.$gg.'</a>'."\n";
		if ($dates[$which]->getYear()>=$cfg->get('com_earliestyear') && $dates[$which]->getYear()<=$cfg->get('com_latestyear')){
		?>
    	<td width="10" align="center" valign="middle"><?php echo $thelink; ?></td>
		<?php		
		}
		else {
		?>
    	<td width="10" align="center" valign="middle"></td>
		<?php		
		}
	}

	function _lastYearIcon($dates, $alts){
		$this->_genericMonthNavigation($dates, $alts, "prev2","gg");
	}

	function _lastMonthIcon($dates, $alts){
		$this->_genericMonthNavigation($dates, $alts,"prev1","g");
	}

	function _nextMonthIcon($dates, $alts){
		$this->_genericMonthNavigation($dates, $alts,"next1","d");
	}

	function _nextYearIcon($dates, $alts){
		$this->_genericMonthNavigation($dates, $alts,"next2","dd");
	}

	function _viewYearIcon($today_date) {
		global $mainframe;
		$cfg = & EventsConfig::getInstance();
		$jev_component_name  = $cfg->get("com_componentname");
		$Itemid = EventsHelper::getItemid();
		$transparentGif = JURI::root() . "components/$jev_component_name/images/transp.gif";
		$cat = $this->datamodel->getCatidsOutLink();

		?>
		<td class="iconic_td" align="center" valign="middle">
    		<div id="ev_icon_yearly" class="nav_bar_cal"><a href="<?php echo JRoute::_( 'index.php?option=' . $jev_component_name . $cat . '&task=view_year&'. $today_date->toDateURL() . '&Itemid=' . $Itemid );?>" title="<?php echo  _CAL_LANG_VIEWBYYEAR;?>"> 
    			<img src="<?php echo $transparentGif;?>" alt="<?php echo _CAL_LANG_VIEWBYYEAR;?>"/></a>
    		</div>
        </td>
        <?php
	}

	function _viewMonthIcon($today_date) {
		global $mainframe;
		$cfg = & EventsConfig::getInstance();
		$jev_component_name  = $cfg->get("com_componentname");
		$Itemid = EventsHelper::getItemid();
		$transparentGif = JURI::root() . "components/$jev_component_name/images/transp.gif";
		$cat = $this->datamodel->getCatidsOutLink();
		?>
    	<td class="iconic_td" align="center" valign="middle">
    		<div id="ev_icon_monthly" class="nav_bar_cal" ><a href="<?php echo JRoute::_( 'index.php?option=' . $jev_component_name . $cat . '&task=view_month&'. $today_date->toDateURL() . '&Itemid=' . $Itemid );?>" title="<?php echo  _CAL_LANG_VIEWBYMONTH;?>">
    			<img src="<?php echo $transparentGif;?>" alt="<?php echo _CAL_LANG_VIEWBYMONTH;?>"/></a>
    		</div>
        </td>
        <?php
	}

	function _viewWeekIcon($today_date) {
		global $mainframe;
		$cfg = & EventsConfig::getInstance();
		$jev_component_name  = $cfg->get("com_componentname");
		$Itemid = EventsHelper::getItemid();
		$transparentGif = JURI::root() . "components/$jev_component_name/images/transp.gif";
		$cat = $this->datamodel->getCatidsOutLink();
		?>
		<td class="iconic_td" align="center" valign="middle">
			<div id="ev_icon_weekly" class="nav_bar_cal"><a href="<?php echo JRoute::_( 'index.php?option=' . $jev_component_name . $cat . '&task=view_week&'. $today_date->toDateURL() . '&Itemid=' . $Itemid );?>" title="<?php echo  _CAL_LANG_VIEWBYWEEK;?>">
			<img src="<?php echo $transparentGif;?>" alt="<?php echo _CAL_LANG_VIEWBYWEEK;?>"/></a>
			</div>
        </td>
        <?php
	}

	function _viewDayIcon($today_date) {
		global $mainframe;
		$cfg = & EventsConfig::getInstance();
		$jev_component_name  = $cfg->get("com_componentname");
		$Itemid = EventsHelper::getItemid();
		$transparentGif = JURI::root() . "components/$jev_component_name/images/transp.gif";
		$cat = $this->datamodel->getCatidsOutLink();
		?>
		<td class="iconic_td" align="center" valign="middle">
			<div id="ev_icon_daily" class="nav_bar_cal" ><a href="<?php echo JRoute::_( 'index.php?option=' . $jev_component_name . $cat . '&task=view_day&'. $today_date->toDateURL() . '&Itemid=' . $Itemid );?>" title="<?php echo  _CAL_LANG_VIEWTODAY;?>"><img src="<?php echo $transparentGif;?>" alt="<?php echo _CAL_LANG_VIEWBYDAY;?>"/></a>
			</div>
        </td>
        <?php
	}

	function _viewSearchIcon($today_date) {
		global $mainframe;
		$cfg = & EventsConfig::getInstance();
		$jev_component_name  = $cfg->get("com_componentname");
		$Itemid = EventsHelper::getItemid();
		$transparentGif = JURI::root() . "components/$jev_component_name/images/transp.gif";
		$cat = $this->datamodel->getCatidsOutLink();
		?>
		<td class="iconic_td" align="center" valign="middle">
			<div id="ev_icon_search" class="nav_bar_cal"><a href="<?php echo JRoute::_( 'index.php?option=' . $jev_component_name . $cat . '&task=view_search&'. $today_date->toDateURL() . '&Itemid=' . $Itemid );?>" title="<?php echo  _SEARCH_TITLE;?>"><img src="<?php echo $transparentGif;?>" alt="<?php echo _SEARCH_TITLE;?>"/></a>
			</div>
        </td>                
        <?php
	}

	function _viewJumptoIcon($today_date) {
		global $mainframe;
		$cfg = & EventsConfig::getInstance();
		$jev_component_name  = $cfg->get("com_componentname");
		$Itemid = EventsHelper::getItemid();
		$transparentGif = JURI::root() . "components/$jev_component_name/images/transp.gif";
		?>
		<td class="iconic_td" align="center" valign="middle">
			<div id="ev_icon_jumpto" class="nav_bar_cal"><a onclick="jtdisp = document.getElementById('jumpto').style.display;document.getElementById('jumpto').style.display=(jtdisp=='none')?'block':'none';" title="<?php echo   _CAL_LANG_JUMPTO;?>"><img src="<?php echo $transparentGif;?>" alt="<?php echo  _CAL_LANG_JUMPTO;?>"/></a>
			</div>
        </td>                
        <?php
	}

	function _viewHiddenJumpto($this_date){
		$cfg = & EventsConfig::getInstance();
		$jev_component_name  = $cfg->get("com_componentname");
		$Itemid = EventsHelper::getItemid();
		$hiddencat	= "";
		if ($this->datamodel->catidsOut!=0){
			$hiddencat = '<input type="hidden" name="catids" value="'.$this->datamodel->catidsOut.'"/>';
		}
		?>
		<tr align="center" valign="top">
	    	<td colspan="10" align="center" valign="top">
	    	<div id="jumpto"  style="display:none">
			<form name="BarNav" action="index.php" method="get">
				<input type="hidden" name="option" value="<?php echo $jev_component_name;?>" />
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
		<?php
	}

	function viewNavTableBarIconic( $today_date, $this_date, $dates, $alts, $option, $task, $Itemid ) {
    	?>
    	<div class="ev_navigation" style="width:100%">
    		<table  border="0" align="center" >
    			<tr align="center" valign="top">
    	    		<?php 
    	    		echo $this->_lastYearIcon($dates, $alts);
    	    		echo $this->_lastMonthIcon($dates, $alts);
    	    		echo $this->_viewYearIcon($today_date);
    	    		echo $this->_viewMonthIcon($today_date);
    	    		echo $this->_viewWeekIcon($today_date);
    	    		echo $this->_viewDayIcon($today_date);
    	    		echo $this->_viewSearchIcon($today_date);
    	    		echo $this->_viewJumptoIcon($today_date);
    	    		echo $this->_nextMonthIcon($dates, $alts);
    	    		echo $this->_nextYearIcon($dates, $alts);
    	    		?>
                </tr>
    			<tr class="icon_labels" align="center" valign="top">
	        		<td colspan="2"></td>
    				<td><?php echo _CAL_LANG_VIEWBYYEAR;?></td>
    				<td><?php echo _CAL_LANG_VIEWBYMONTH;?></td>
    				<td><?php echo _CAL_LANG_VIEWBYWEEK;?></td>
    				<td><?php echo _CAL_LANG_VIEWTODAY;?></td>
    				<td><?php echo _SEARCH_TITLE;?></td>
    				<td><?php echo  _CAL_LANG_JUMPTO;?></td>
	        		<td colspan="2"></td>
                </tr>
                <?php
                echo $this->_viewHiddenJumpto($this_date);
                ?>
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

		global $mainframe;

		$cfg = & EventsConfig::getInstance();

		$cat		= "";
		$hiddencat	= "";
		if ($this->datamodel->getCatidsOut!=0){
			$cat = '&catids=' . $this->datamodel->getCatidsOut;
			$hiddencat = '<input type="hidden" name="catids" value="'.$this->datamodel->getCatidsOut.'"/>';
		}

		$imgSingle = '<img border="0" src="' . JURI::root() . 'components/' . $option
		. '/images/'; // width="13" height="13" [mic]
		$imgDouble = '<img border="0" src="' . JURI::root() . 'components/' . $option
		. '/images/'; // width="19" height="13" [mic]
		$gg	= $imgDouble . 'gg_' . $cfg->get('com_navbarcolor') . '.gif" alt="' . $alts['prev2'] . '" />';
		$g	= $imgSingle . 'g_' . $cfg->get('com_navbarcolor') . '.gif" alt="' . $alts['prev1'] . '" />';
		$d	= $imgSingle . 'd_' . $cfg->get('com_navbarcolor') . '.gif" alt="' . $alts['next1'] . '" />';
		$dd = $imgDouble . 'dd_' . $cfg->get('com_navbarcolor') . '.gif" alt="' . $alts['next2'] . '" />';

		$link = 'index.php?option=' . $option . '&task=' . $task . $cat . '&Itemid=' . $Itemid. '&';
		$prev2 = '<a href="' . JRoute::_( $link . $dates['prev2']->toDateURL() )
		. '" title="' . $alts['prev2'] . '">' . $gg . '</a>' . "\n";
		$prev1 = '<a href="' . JRoute::_( $link . $dates['prev1']->toDateURL() )
		. '" title="' . $alts['prev1'] . '">' . $g . '</a>' . "\n";
		$next1 = '<a href="' . JRoute::_( $link . $dates['next1']->toDateURL() )
		. '" title="' . $alts['next1'] . '">' . $d . '</a>' . "\n";
		$next2 = '<a href="' . JRoute::_( $link . $dates['next2']->toDateURL() )
		. '" title="' . $alts['next2'] . '">'.$dd.'</a>'."\n";

		$today_link = '<a class="nav_bar_link_' . $cfg->get('com_navbarcolor') . '" href="'
		. JRoute::_( 'index.php?option=' . $option . $cat . '&task=view_day&'
		. $today_date->toDateURL() . '&Itemid=' . $Itemid )
		. '" title="' . _CAL_LANG_VIEWTODAY . '">' . _CAL_LANG_VIEWTODAY . '</a>' . "\n";
		//$current_month_link = '<a class="nav_bar_link" href="index.php?option='.$option.$cat.'&task=view_month&'.$this_date->toDateURL().'&Itemid='.$Itemid.'">'._CAL_LANG_VIEWBYMONTH.'</a>'."\n";
		//$current_week_link = '<a class="nav_bar_link" href="index.php?option='.$option.$cat.'&task=view_week&'.$this_date->toDateURL().'&Itemid='.$Itemid.'">'._CAL_LANG_VIEWBYWEEK.'</a>'."\n";
		//$archive_link = '<a class="nav_bar_link" href="index.php?option='.$option.$cat.'&task=view_year&year='.$this_date->getYear(1).'&Itemid='.$Itemid.'">'._CAL_LANG_ARCHIVE.'&nbsp;'.$this_date->getYear(1).'</a>'."\n";
		//$categories_link = '<a class="nav_bar_link" href="index.php?option='.$option.$cat.'&task=view_cat&'.$this_date->toDateURL().'&Itemid='.$Itemid.'">'._CAL_LANG_VIEWBYCAT.'</a>'."\n";
		$lastmonth_link = '<a class="nav_bar_link_' . $cfg->get('com_navbarcolor') . '" href="'
		. JRoute::_( 'index.php?option=' . $option . '&task=view_last&'
		. $today_date->toDateURL() . '&Itemid=' . $Itemid . $cat)
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

	function showNavTableBar( $year, $month, $day, $option, $task, $Itemid ){
		// this, previous and next date handling
		global $mainframe;

		$cfg = & EventsConfig::getInstance();

		$datetime = strftime( '%Y-%m-%d %H:%M:%S', time() + ( $mainframe->getCfg('offset') * 60 * 60 ));
		ereg( "([0-9]{4})-([0-9]{2})-([0-9]{2})[ ]([0-9]{2}):([0-9]{2}):([0-9]{2})", $datetime, $regs );

		$this_date = new mosEventDate();
		$this_date->setDate( $year, $month, $day );

		$today_date = clone($this_date);
		$today_date->setDate( $regs[1], $regs[2], $regs[3] );

		$prev_year = clone($this_date);
		$prev_year->addMonths( -12 );
		$next_year = clone($this_date);
		$next_year->addMonths( +12 );

		$prev_month = clone($this_date);
		$prev_month->addMonths( -1 );
		$next_month = clone($this_date);
		$next_month->addMonths( +1 );

		$prev_week = clone($this_date);
		$prev_week->addDays( -7 );
		$next_week = clone($this_date);
		$next_week->addDays( +7 );

		$prev_day = clone($this_date);
		$prev_day->addDays( -1 );
		$next_day = clone($this_date);
		$next_day->addDays( +1 );

		switch( $task ){
			case 'view_year':
				$dates['prev2'] = $prev_year;
				$dates['prev1'] = $prev_year;
				$dates['next1'] = $next_year;
				$dates['next2'] = $next_year;

				$alts['prev2'] = _CAL_LANG_PREVIOUSYEAR;
				$alts['prev1'] = _CAL_LANG_PREVIOUSYEAR;
				$alts['next1'] = _CAL_LANG_NEXTYEAR;
				$alts['next2'] = _CAL_LANG_NEXTYEAR;

				// Show
				if($cfg->get('com_calUseIconic', 1) == 1) $this->viewNavTableBarIconic( $today_date, $this_date, $dates, $alts, $option, $task, $Itemid );
				else  $this->viewNavTableBar( $today_date, $this_date, $dates, $alts, $option, $task, $Itemid );
				break;

			case 'view_month':
				$dates['prev2'] = $prev_year;
				$dates['prev1'] = $prev_month;
				$dates['next1'] = $next_month;
				$dates['next2'] = $next_year;

				$alts['prev2'] = _CAL_LANG_PREVIOUSYEAR;
				$alts['prev1'] = _CAL_LANG_PREVIOUSMONTH;
				$alts['next1'] = _CAL_LANG_NEXTMONTH;
				$alts['next2'] = _CAL_LANG_NEXTYEAR;

				// Show
				if($cfg->get('com_calUseIconic', 1) == 1) $this->viewNavTableBarIconic( $today_date, $this_date, $dates, $alts, $option, $task, $Itemid );
				else  $this->viewNavTableBar( $today_date, $this_date, $dates, $alts, $option, $task, $Itemid );
				break;

			case 'view_week':
				$dates['prev2'] = $prev_month;
				$dates['prev1'] = $prev_week;
				$dates['next1'] = $next_week;
				$dates['next2'] = $next_month;

				$alts['prev2'] = _CAL_LANG_PREVIOUSMONTH;
				$alts['prev1'] = _CAL_LANG_PREVIOUSWEEK;
				$alts['next1'] = _CAL_LANG_NEXTWEEK;
				$alts['next2'] = _CAL_LANG_NEXTMONTH;

				// Show
				if($cfg->get('com_calUseIconic', 1) == 1) $this->viewNavTableBarIconic( $today_date, $this_date, $dates, $alts, $option, $task, $Itemid );
				else $this->viewNavTableBar( $today_date, $this_date, $dates, $alts, $option, $task, $Itemid );
				break;

			case 'view_day':
			default:
				$dates['prev2'] = $prev_month;
				$dates['prev1'] = $prev_day;
				$dates['next1'] = $next_day;
				$dates['next2'] = $next_month;

				$alts['prev2'] = _CAL_LANG_PREVIOUSMONTH;
				$alts['prev1'] = _CAL_LANG_PREVIOUSDAY;
				$alts['next1'] = _CAL_LANG_NEXTDAY;
				$alts['next2'] = _CAL_LANG_NEXTMONTH;

				// Show
				if($cfg->get('com_calUseIconic', 1) == 1) $this->viewNavTableBarIconic( $today_date, $this_date, $dates, $alts, $option, "view_day", $Itemid );
				else $this->viewNavTableBar( $today_date, $this_date, $dates, $alts, $option, "view_day", $Itemid );
				break;
		}
	}

	function showEventsByYearNEW( $year, $limit, $limitstart ){
		$cfg = & EventsConfig::getInstance();
		$option = $cfg->get("com_componentname");
		$Itemid = EventsHelper::getItemid();

		// Note that using a $limit value of -1 the limit is ignored in the query
		$data = $this->datamodel->getYearData($year,$limit, $limitstart);

		$cfg = & EventsConfig::getInstance();

		echo "<div id='cal_title'>"._CAL_LANG_ARCHIVE."</div>\n";
		//echo '<fieldset id="ev_fieldset"><legend class="ev_fieldset">' . _CAL_LANG_ARCHIVE . '</legend><br />' . "\n";
		?>
		<table align="center" width="90%" cellspacing="0" cellpadding="0" class="ev_table">
            <tr valign="top">
                <td colspan="2"  align="center" class="cal_td_daysnames">
                   <!-- <div class="cal_daysnames"> -->
                    <?php echo $data["year"] ;?>
                    <!-- </div> -->
                </td>
            </tr>
		<?php
		for($month = 1; $month <= 12; $month++) {
			$num_events = count($data["months"][$month]["rows"]);
			if ($num_events>0){
				echo "<tr><td class='ev_td_left'>".mosEventsHTML::getDateFormat($year,$month,'',3)."</td>\n";
				echo "<td class='ev_td_right'>\n";
				echo "<ul class='ev_ul'>\n";
				for ($r = 0; $r < $num_events; $r++) {
					if (!isset($data["months"][$month]["rows"][$r])) continue;
					$row =& $data["months"][$month]["rows"][$r];
					$listyle = 'style="border-color:'.$row->bgcolor().';"';

					echo "<li class='ev_td_li' $listyle>\n";
					$this->viewEventRowNEW ($row,'view_detail',$option, $Itemid);
					echo "&nbsp;::&nbsp;";
					$this->viewEventCatRowNEW ($row,'view_cat',$option, $Itemid);
					echo "</li>\n";
				}
				echo "<ul>\n";
				echo '</td></tr>' . "\n";
			}

		}
		echo '</table><br />' . "\n";
		//echo '</fieldset><br />' . "\n";

		$this->showNavTableText( $data["year"], $data["total"], $data["limitstart"], $data["limit"], 'view_year' );
	}

	function showCalendarNEW( $year, $month, $day) {

		$data = $this->datamodel->getCalendarData($year, $month, $day );

		global $mainframe;
		$cfg = & EventsConfig::getInstance();
		$option = $cfg->get("com_componentname");
		$Itemid = EventsHelper::getItemid();

		EventsHelper::loadOverlib();

		//if( _CAL_CONF_TT_SHADOW == 1 ){ // disbled only for test [mic]
		if( !defined( '_LOAD_OVERLIB_SHADOW' )){
            define( '_LOAD_OVERLIB_SHADOW', 1 ); ?>
            <script type="text/javascript" src="<?php echo JURI::root(); ?>components/<?php echo $option;?>/js/overlib_shadow.js"></script>
            <?php
		}

		$view =  $this->getViewName();
		include_once( JPATH_SITE . '/components/' . $option . '/layouts/'.$view.'/events_calendar_cell.php' );
		$eventCellClass = "EventCalendarCell_".$view;

		/* Override Joomla class definitions for overlib decoration - only affects logged in users */
		?>
		<script language="Javascript" type="text/javascript">
		ol_fgclass='';
		ol_bgclass='';
		ol_textfontclass='';
		ol_captionfontclass='';
		ol_closefontclass='';
		</script>
		<?php

		echo "<div id='cal_title'>".$data['fieldsetText']."</div>\n";
    ?>
        <table width="100%" align="center" border="0" cellspacing="1" cellpadding="0" class="cal_table">
            <tr valign="top">
            	<td width='2%' class="cal_td_daysnames"/>
                <?php foreach ($data["daynames"] as $dayname) { ?>
                    <td width="14%" align="center" class="cal_td_daysnames">
                        <?php 
                        echo $dayname;?>
                    </td>
                    <?php
                } ?>
            </tr>
            <?php
            $datacount = count($data["dates"]);
            $dn=0;
            for ($w=0;$w<6 && $dn<$datacount;$w++){
            ?>
			<tr valign="top" style="height:80px;">
                <?php
                echo "<td width='2%' class='cal_td_weeklink'>";
                list($week,$link) = each($data['weeks']);
                echo "<a href='".$link."'>$week</a></td>\n";
                for ($d=0;$d<7 && $dn<$datacount;$d++){
                	$currentDay = $data["dates"][$dn];
                	switch ($currentDay["monthType"]){
                		case "prior":
                		case "following":
                		?>
                    <td width="14%" class="cal_td_daysoutofmonth" valign="top">
                        <?php echo $currentDay["d"]; ?>
                    </td>
                    	<?php
                    	break;
                		case "current":
                			$cellclass = $currentDay["today"]?'class="cal_td_today"':'class="cal_td_daysnoevents"';

						?>
                    <td <?php echo $cellclass;?> width="14%" valign="top" style="height:80px;">
                    	<a class="cal_daylink" href="<?php echo $currentDay["link"]; ?>" title="<?php echo _CAL_LANG_CLICK_TOSWITCH_DAY; ?>"><?php echo $currentDay['d']; ?></a>
                        <?php

                        if (count($currentDay["events"])>0){
                        	foreach ($currentDay["events"] as $key=>$val){
								if( $currentDay['countDisplay'] < $cfg->get('com_calMaxDisplay')) {
									echo '<div style="border:0;width:100%;">';
								} else {
									// float small icons left
									echo '<div style="border:0;float:left;">';
								}
                        		echo "\n";
                        		$ecc = new $eventCellClass($val,$this->datamodel);
                        		echo $ecc->calendarCell($currentDay,$year,$month,$key);
                        		echo '</div>' . "\n";
								$currentDay['countDisplay']++;
                        	}
                        }
                        echo "</td>\n";
                        break;
                	}
                	$dn++;
                }
                echo "</tr>\n";
            }
            echo "</table>\n";
	}

	function showEventsByMonthNEW( $year, $month ){
		$cfg = & EventsConfig::getInstance();
		$option = $cfg->get("com_componentname");
		$Itemid = EventsHelper::getItemid();
		// this is overkill since I don't need all the data - but hey!
		$data = $this->datamodel->getCalendarData($year, $month, 1);

		$cfg = & EventsConfig::getInstance();
		?>
		<fieldset><legend class="ev_fieldset"><?php echo _CAL_LANG_EVENTSFOR;?></legend><br />
		<table align="center" width="90%" cellspacing="0" cellpadding="5" class="ev_table">
			<tr valign="top">
				<td colspan="2"  align="center" class="cal_td_daysnames">
				<?php echo mosEventsHTML::getDateFormat( $year, $month, '', 3 );?>
			</td>
			</tr>
		<?php

		for( $d = 0; $d < count($data['dates']); $d++ ){
			$rowcount = count($data['dates'][$d]['events']);
			if ($rowcount>0){
				?>
			 <tr>
				<td class="ev_td_left">
					<?php echo mosEventsHTML::getDateFormat( $year, $month, $d, 7 ); ?>
				</td>
				<td align="left" valign="top" class="ev_td_right">
					<ul class="ev_ul">
					<?php
					foreach ($data["dates"][$d]["events"] as $key=>$row){
						$listyle = 'style="border-color:'.$row->bgcolor().';"';
						echo "<li class='ev_td_li' $listyle>\n";
						$this->viewEventRowNEW($row,'view_detail',$option, $Itemid);
						echo '&nbsp;::&nbsp;';
						$this->viewEventCatRowNEW($row,'view_cat',$option,$Itemid);
						echo "</li>\n";
					}
					echo '</ul></td></tr>' . "\n";
			}
		}
		echo '</table><br />' . "\n";
		echo '</fieldset><br /><br />' . "\n";
	}

	function showEventsByWeekNEW( $year, $month, $day ){
		$data = $this->datamodel->getWeekData($year, $month, $day);

		$cfg = & EventsConfig::getInstance();
		$option = $cfg->get("com_componentname");
		$Itemid = EventsHelper::getItemid();
		$db	=& JFactory::getDBO();
		global $mainframe;

		$cfg = & EventsConfig::getInstance();

		echo '<fieldset><legend class="ev_fieldset">' . _CAL_LANG_EVENTSFOR . '&nbsp;' . _CAL_LANG_WEEK
		. ' : </legend><br />' . "\n";
		echo '<table align="center" width="90%" cellspacing="0" cellpadding="5" class="ev_table">' . "\n";
    	?>
            <tr valign="top">
                <td colspan="2"  align="center" class="cal_td_daysnames">
                   <!-- <div class="cal_daysnames"> -->
                    <?php echo  $data['startdate'] . ' - ' . $data['enddate'] ;?>
                    <!-- </div> -->
                </td>
            </tr>
		<?php
		for( $d = 0; $d < 7; $d++ ){

			$day_link = '<a class="ev_link_weekday" href="' . $data['days'][$d]['link'] . '" title="' . _CAL_LANG_CLICK_TOSWITCH_DAY . '">'
			. mosEventsHTML::getDateFormat( $data['days'][$d]['week_year'], $data['days'][$d]['week_month'], $data['days'][$d]['week_day'], 2 ).'</a>'."\n";

			if( $data['days'][$d]['today'])	$bg = 'class="ev_td_today"';
			else $bg = 'class="ev_td_left"';

			echo '<tr><td ' . $bg . '>' . $day_link . '</td>' . "\n";
			echo '<td class="ev_td_right">' . "\n";

			$num_events		= count($data['days'][$d]['rows']);
			if ($num_events>0) {
				echo "<ul class='ev_ul'>\n";

				for( $r = 0; $r < $num_events; $r++ ){
					$row = $data['days'][$d]['rows'][$r];

					$listyle = 'style="border-color:'.$row->bgcolor().';"';
					echo "<li class='ev_td_li' $listyle>\n";
					$this->viewEventRowNew ( $row,'view_detail',$option, $Itemid);
					$this->viewEventCatRowNew($row,'view_cat',$option,$Itemid);
					echo "</li>\n";
				}
				echo "</ul>\n";
			}
			echo '</td></tr>' . "\n";
		} // end for days

		echo '</table><br />' . "\n";
		echo '</fieldset><br /><br />' . "\n";
		//$this->showNavTableText(20, 20, $max_events, $offset, 'view_week');
	}

	function showEventsByDateNEW( $year, $month, $day ){
		$data = $this->datamodel->getDayData( $year, $month, $day );

		$cfg = & EventsConfig::getInstance();
		$option = $cfg->get("com_componentname");
		$Itemid = EventsHelper::getItemid();
		$cfg = & EventsConfig::getInstance();

		echo '<fieldset><legend class="ev_fieldset">' . _CAL_LANG_EVENTSFORTHE .'</legend><br />' . "\n";
		echo '<table align="center" width="90%" cellspacing="0" cellpadding="5" class="ev_table">' . "\n";
	    ?>
            <tr valign="top">
                <td colspan="2"  align="center" class="cal_td_daysnames">
                   <!-- <div class="cal_daysnames"> -->
                    <?php echo mosEventsHTML::getDateFormat( $year, $month, $day, 0) ;?>
                    <!-- </div> -->
                </td>
            </tr>
		<?php
		// Timeless Events First
		if (count($data['hours']['timeless']['events'])>0){
			$start_time = "Timeless";

			echo '<tr><td class="ev_td_left">' . $start_time . '</td>' . "\n";
			echo '<td class="ev_td_right"><ul class="ev_ul">' . "\n";
			foreach ($data['hours']['timeless']['events'] as $row) {
				$listyle = 'style="border-color:'.$row->bgcolor().';"';
				echo "<li class='ev_td_li' $listyle>\n";

				$this->viewEventRowNew ( $row,'view_detail',$option, $Itemid);
				echo '&nbsp;::&nbsp;';
				$this->viewEventCatRowNew($row,'view_cat',$option,$Itemid);
				echo "</li>\n";
			}
			echo "</ul></td></tr>\n";
		}

		for ($h=0;$h<24;$h++){
			if (count($data['hours'][$h]['events'])>0){
				$start_time = ($cfg->get('com_calUseStdTime')== '1') ? strftime("%I:%M%p",$data['hours'][$h]['hour_start']) : strftime("%H:%M",$data['hours'][$h]['hour_start']);

				echo '<tr><td class="ev_td_left">' . $start_time . '</td>' . "\n";
				echo '<td class="ev_td_right"><ul class="ev_ul">' . "\n";
				foreach ($data['hours'][$h]['events'] as $row) {
					$listyle = 'style="border-color:'.$row->bgcolor().';"';
					echo "<li class='ev_td_li' $listyle>\n";

					$this->viewEventRowNew ( $row,'view_detail',$option, $Itemid);
					echo '&nbsp;::&nbsp;';
					$this->viewEventCatRowNew($row,'view_cat',$option,$Itemid);
					echo "</li>\n";
				}
				echo "</ul></td></tr>\n";
			}
		}
		echo '</table><br />' . "\n";
		echo '</fieldset><br /><br />' . "\n";
		//  $this->showNavTableText(10, 10, $num_events, $offset, '');
	}

	function showEventsById( $agid, $jevtype, $year, $month, $day ){
		// MLr: check if called from detail navigation. if yes, only showEventsByDate make sense
		if( 0 == $agid && strpos(JRequest::getVar('agid',"0") ,"-")===false) {
			$this->showEventsByDateNew ($year,$month,$day);
			return;
		}

		global  $mainframe;
		$cfg = & EventsConfig::getInstance();
		$option = $cfg->get("com_componentname");
		$pop = intval(JRequest::getVar( 'pop', 0 ));
		$Itemid = EventsHelper::getItemid();
		$db	=& JFactory::getDBO();
		$data = $this->datamodel->getEventData( $agid, $jevtype, $year, $month, $day );

		if (is_null($data)){
			global $mainframe;
			$mainframe->redirect(JRoute::_("index.php?option=$option&Itemid=$Itemid"), "Sorry - This item may have been updated while you have been viewing the webpage.  Please try again");
		}

		$cfg = & EventsConfig::getInstance();

		if( array_key_exists('row',$data) ){
			$row=$data['row'];

			// Dynamic Page Title
			$mainframe->SetPageTitle( $row->title() );

			$this->viewEventDetail($row, $data['mask']);

		}
	}

	function showEventsByCat( $catid, $limit, $limitstart ){
		$data = $this->datamodel->getCatData( $catid, $limit, $limitstart);

		$cfg = & EventsConfig::getInstance();
		$option = $cfg->get("com_componentname");
		$Itemid = EventsHelper::getItemid();

		$cfg = & EventsConfig::getInstance();

		echo '<fieldset><legend class="ev_fieldset">' . $data['catname'] . '</legend><br />' . "\n";
		echo '<table align="center" width="90%" cellspacing="0" cellpadding="5" class="ev_table">' . "\n";
		$num_events = count($data['rows']);
		$chdate ="";
		if( $num_events > 0 ){
			echo "<tr>\n";

			for( $r = 0; $r < $num_events; $r++ ){
				$row = $data['rows'][$r];

				$event_day_month_year 	= $row->dup() . $row->mup() . $row->yup();

				if(( $event_day_month_year <> $chdate ) && $chdate <> '' ){
					echo '</ul></td></tr>' . "\n";
				}

				if( $event_day_month_year <> $chdate ){
					$date =mosEventsHTML::getDateFormat( $row->yup(), $row->mup(), $row->dup(), 1 );
					echo '<tr><td class="ev_td_left">'.$date.'</td>' . "\n";
					echo '<td align="left" valign="top" class="ev_td_right"><ul class="ev_ul">' . "\n";
				}

				$listyle = 'style="border-color:'.$row->bgcolor().';"';
				echo "<li class='ev_td_li' $listyle>\n";
				$this->viewEventRowNew ( $row,'view_detail',$option, $Itemid);
				echo "</li>\n";

				$chdate = $event_day_month_year;
			}
			echo "</ul></td>\n";
		} else {
			echo '<tr>';
			echo '<td align="left" valign="top" class="ev_td_right">' . "\n";

			if( $catid==0 ){
				echo _CAL_LANG_EVENT_CHOOSE_CATEG . '</td>';
			} else {
				echo _CAL_LANG_NO_EVENTFOR . '&nbsp;<b>' . $data['catname']. '</b></td>';
			}
		}

		echo '</tr></table><br />' . "\n";
		echo '</fieldset><br /><br />' . "\n";

		list($year,$month,$day) = EventsHelper::getYMD();
		$this->showNavTableText( $year, $data['total'], $data['limitstart'], $data['limit'], 'view_cat&catid=' . $data['catid'] );
	}

	function showEventsByKeyword( $keyword, $limit, $limitstart, $useRegX=false ) {
		$data = $this->datamodel->getKeywordData($keyword, $limit, $limitstart, $useRegX);

		$cfg = & EventsConfig::getInstance();
		$option = $cfg->get("com_componentname");
		$Itemid = EventsHelper::getItemid();
		global $mainframe;

		$searchisValid =true;

		$cfg = & EventsConfig::getInstance();

		$chdate	= '';
		echo '<fieldset><legend class="ev_fieldset">' . _CAL_LANG_SEARCHRESULTS. '&nbsp;:&nbsp;</legend><br />'	. "\n";
		?>
		<table align="center" width="90%" cellspacing="0" cellpadding="5" class="ev_table">
           <tr valign="top">
               <td colspan="2"  align="center" class="cal_td_daysnames">
                    <?php echo $keyword  ;?>
                </td>
            </tr>
	 	<?php

	 	if( $data['num_events'] > 0 ){
	 		echo '<tr>';
	 		for( $r = 0; $r < $data['num_events']; $r++ ){
	 			$row = $data['rows'][$r];

	 			$event_day_month_year 	= $row->dup().$row->mup().$row->yup();

	 			if(( $event_day_month_year <> $chdate ) && $chdate <> '' ){
	 				echo '</ul></td></tr>' . "\n";
	 			}

	 			if( $event_day_month_year <> $chdate ){
	 				$date =mosEventsHTML::getDateFormat( $row->yup(), $row->mup(), $row->dup(), 1 );
	 				echo '<tr><td class="ev_td_left">'.$date.'</td>' . "\n";
	 				echo '<td align="left" valign="top" class="ev_td_right"><ul class="ev_ul">' . "\n";
	 			}

	 			$listyle = 'style="border-color:'.$row->bgcolor().';"';
	 			echo "<li class='ev_td_li' $listyle>\n";
	 			$this->viewEventRowNew ( $row,'view_detail',$option, $Itemid);
	 			$this->viewEventCatRowNew($row,'view_cat',$option,$Itemid);
	 			echo "</li>\n";

	 			$chdate = $event_day_month_year;
	 		}
	 		echo "</ul></td>\n";
	 	} else {
	 		echo "<tr>";
	 		echo "<td align='left' valign='top' class='ev_td_right'>\n";
	 		// new by mic
	 		if( $searchisValid ){
	 			echo _CAL_LANG_NO_EVENTFOR . '&nbsp;<b>' . $keyword . '</b>';
	 		}else{
	 			echo '<b>' . $keyword . '</b>';
	 			$keyword = '';
	 		}
	 	}

	 	echo '</tr></table><br />' . "\n";
	 	echo '</fieldset><br /><br />' . "\n";

		list($year,$month,$day) = EventsHelper::getYMD();

	 	$this->showNavTableText( $year, $data['total'], $data['limitstart'], $data['limit'], 'search&keyword=' . $keyword);
	}


	function showEventsForAdmin( $creator_id, $limit, $limitstart ) {
		$data = $this->datamodel->getDataForAdmin( $creator_id, $limit, $limitstart );

		$cfg = & EventsConfig::getInstance();
		$option = $cfg->get("com_componentname");
		$is_event_editor = EventsHelper::isEventEditor();
		$Itemid = EventsHelper::getItemid();
		$user =& JFactory::getUser();


		$cfg = & EventsConfig::getInstance();

		$frontendPublish = intval($cfg->get('com_frontendPublish', 0)) > 0;

		$num_events = count( $data['rows'] );
		$chdate 	= '';

		echo '<fieldset><legend class="ev_fieldset">' . _CAL_LANG_ADMINPANEL . '</legend><br />' . "\n";
		echo '<table align="center" width="90%" cellspacing="0" cellpadding="5" class="ev_table">' . "\n";

		if( $num_events > 0 ){
			for( $r = 0; $r < $num_events; $r++ ) {
				$row = $data['rows'][$r];
				$event_month_year 	= $row->mup().$row->yup();

				if( $event_month_year <> $chdate && $chdate <> ""){
					echo '</ul></td></tr>' . "\n";
				}
				if( $event_month_year <> $chdate ){
					echo '<tr><td class="ev_td_left">'. "\n"
					. mosEventsHTML::getDateFormat( $row->yup(), $row->mup(), '', 3 ) .'</td>' . "\n";
					echo '<td class="ev_td_right"><ul class="ev_ul">' . "\n";
				}

				$this->viewEventRowAdminNEW($row, 'view_detail', $option, $Itemid);
				$chdate = $event_month_year;
			}
			echo '</ul></td>' . "\n";
		} else {
			echo '<tr>' . "\n";
			echo '<td align="left" valign="top" class="ev_td_right">' . "\n";
			echo _CAL_LANG_NO_EVENTS;
		}
		echo '</tr></table><br />' . "\n";
		echo '</fieldset><br /><br />' . "\n";

		list($year,$month,$day) = EventsHelper::getYMD();
		$this->showNavTableText( $year, $data['total'], $data['limitstart'], $data['limit'], 'admin' );
	}

	/* displays event
	*/
	function viewEventRowNEW( $row,$task,$option, $Itemid, $args="") {

		$cfg = & EventsConfig::getInstance();

		$eventlink = $row->viewDetailLink($row->yup(),$row->mup(),$row->dup(),false);
		$eventlink = JRoute::_($eventlink.$this->datamodel->getItemidLink().$this->datamodel->getCatidsOutLink());

		// I choost not to use $row->fgcolor
		$fgcolor="inherit";
		// [mic] if title is too long, cut 'em for display
		$tmpTitle = $row->title();
		if( strlen( $row->title() ) >= 50 ){
			$tmpTitle = substr( $row->title(), 0, 50 ) . ' ...';
		} ?>
			<a class="ev_link_row" href="<?php echo $eventlink; ?>" <?php echo $args;?> style="font-weight:bold;color:<?php echo $fgcolor;?>;" title="<?php echo mosEventsHTML::special($row->title()) ;?>"><?php echo $tmpTitle ;?></a>
			<?php
			if( $cfg->get('com_byview') == '1' ) {
				echo _CAL_LANG_BY . '&nbsp;<i>'. $row->contactlink() .'</i>';
			}
			?>
		<?php
	}

	/* displays categories
	*/
	function viewEventCatRowNEW( $row, $task, $option, $Itemid) {

		// I choost not to use $row->fgcolor()
		$fgcolor="inherit";

		$eventlink = $row->viewDetailLink($row->yup(),$row->mup(),$row->dup(),false);
		$eventlink = JRoute::_($eventlink.$this->datamodel->getItemidLink().$this->datamodel->getCatidsOutLink());
		?>
		<a class="ev_link_cat" href="<?php echo $eventlink; ?>"  style="color:<?php echo $fgcolor;?>;" title="<?php echo mosEventsHTML::special($row->catname());?>"><?php echo $row->catname();?></a>
		<?php
	}

	function viewEventRowAdminNEW( $row, $task, $option, $Itemid) {
		$is_event_editor = EventsHelper::isEventEditor();
		if( $is_event_editor ){
			$deletelink = '<a href="' . $row->deletelink() . '" title="'. _CAL_LANG_DELETE . '"><b>' . _CAL_LANG_DELETE . "</b></a>\n";
			$modifylink = '<a href="' . $row->modifylink() . '" title="' . _CAL_LANG_MODIFY . '"><b>' . _CAL_LANG_MODIFY . "</b></a>\n";
		}

		$eventlink = $row->viewDetailLink($row->yup(),$row->mup(),$row->dup(),false);
		$eventlink = JRoute::_($eventlink.$this->datamodel->getItemidLink().$this->datamodel->getCatidsOutLink());
		$border="border-color:".$row->bgcolor().";";
		?>
		
		<li class="ev_td_li" style="<?php echo $border;?>">
			<a class="<?php echo $row->state() ? 'ev_link_row' : 'ev_link_unpublished'; ?>" style="font-weight:bold;" href="<?php echo JRoute::_($eventlink); ?>" title="<?php echo mosEventsHTML::special($row->title()) . ( $row->state() ? '' : _CAL_LANG_UNPUBLISHED );?>"><?php echo $row->title() . ( $row->state() ? '' : _CAL_LANG_UNPUBLISHED );?></a>
			&nbsp;<?php echo _CAL_LANG_BY;?>
			&nbsp;<i><?php echo $row->contactlink();?></i>
			&nbsp;&nbsp;<?php echo $deletelink;?>&nbsp;&nbsp;<?php echo $modifylink;?>
		</li>
		<?php
	}

}

?>
