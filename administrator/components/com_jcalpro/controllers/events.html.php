<?php
/*
**********************************************
JCal Pro v1.5.3
Copyright (c) 2006-2007 Anything-Digital.com
**********************************************
JCal Pro is a fork of the existing Extcalendar component for Joomla!
(com_extcal_0_9_2_RC4.zip from mamboguru.com). 
Extcal (http://sourceforge.net/projects/extcal) was renamed 
and adapted to become a Mambo/Joomla! component by 
Matthew Friedman, and further modified by David McKinnis
(mamboguru.com) to repair some security holes. 

This program is free software; you can redistribute it and/or modify 
it under the terms of the GNU General Public License as published by 
the Free Software Foundation; either version 2 of the License, or 
(at your option) any later version.

This header must not be removed. Additional contributions/changes
may be added to this header as long as no information is deleted.
**********************************************

$File: events.html.php - Backend events management

Revision date: 03/03/2007

**********************************************
Get the latest version of JCal Pro at:
http://dev.anything-digital.com//
**********************************************
*/

/** ensure this file is being included by a parent file */
defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );

jimport('joomla.html.pane');
jimport('joomla.html.editor');

class HTML_events
{
	function showEvents ( &$rows, &$pageNav, $search, $option, $section, &$lists ) 
	{
		global $my;

		//mosCommonHTML::loadOverlib();
        JHTML::_( 'behavior.tooltip' );
		?>
		<form action="index2.php" method="post" name="adminForm">
			<table class="adminheading">
				<tr>
					<th>
						Events
					</th>
					<td>
						Category:
					</td>
					<td>
						<?php echo $lists['categories'];?>
					</td>
					<td>
						Filter:
					</td>
					<td>
						<input type="text" name="search" value="<?php echo $search;?>" class="inputbox" onChange="document.adminForm.submit();" />
					</td>
				</tr>
			</table>

		<table class="adminlist">
			<tr>
				<th width="20">
					#
				</th>
				<th width="20" class="title">
					<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($rows); ?>);" />
				</th>
				<th class="title">
					Title
				</th>
				<th class="title">
					Category
				</th>
				<th class="title">
					Start time
				</th>
				<th class="title">
					End time
				</th>
				<th class="title">
					Published
				</th>
				<th class="title">
					Approved
				</th>
			</tr>
			<?php
			$k = 0;
			for ( $i = 0, $n = count ( $rows ); $i < $n; $i++ ) 
			{
				$row = $rows[$i];
	
				$link 	= 'index2.php?option=com_jcalpro&section=events&task=editA&hidemainmenu=1&id='. $row->extid;
				
				$row->id = $row->extid;
	
				$img 	= $row->published ? 'tick.png' : 'publish_x.png';
				$task 	= $row->published ? 'unpublish' : 'publish';
				$alt 	= $row->published ? 'Published' : 'Unpublished';
				$app_img 	= $row->approved ? 'tick.png' : 'publish_x.png';
				$app_task 	= $row->approved ? 'notapprove' : 'approve';
				$app_alt 	= $row->approved ? 'Approved' : 'Not Approved';	
				//$checked 	= mosCommonHTML::CheckedOutProcessing( $row, $i );
                $checked     = JHTML::_('grid.checkedout',   $row, $i );
				?>
				<tr class="<?php echo "row$k"; ?>">
					<td>
						<?php echo $pageNav->getRowOffset( $i ); ?>
					</td>
					<td>
						<?php echo $checked; ?>
					</td>
					<td>
						<?php
						if ( $row->checked_out && ( $row->checked_out != $my->extid ) ) 
						{
							echo $row->title;
						} 
						else 
						{
							?>
							<a href="<?php echo $link; ?>" title="Edit Event">
							<?php echo $row->title; ?>
							</a>
							<?php
						}
						?>
					</td>
					<td>
						<?php echo $row->categoryName; ?>
					</td>
					<td>
						<?php echo $row->start_date; ?>								
					</td>
					<td>
						<?php echo $row->end_date; ?>
					</td>					
					<td>
						<a href="javascript: void(0);" onClick="return listItemTask('cb<?php echo $i;?>','<?php echo $task;?>')">
						<img src="images/<?php echo $img;?>" width="12" height="12" border="0" alt="<?php echo $alt; ?>" />
						</a>
					</td>
					<td>
						<a href="javascript: void(0);" onClick="return listItemTask('cb<?php echo $i;?>','<?php echo $app_task;?>')">
						<img src="images/<?php echo $app_img;?>" width="12" height="12" border="0" alt="<?php echo $alt; ?>" />
						</a>
					</td>
				</tr>
				<?php
				$k = 1 - $k;
			}
			?>
			</table>
			
			<?php echo $pageNav->getListFooter(); ?>

			<input type="hidden" name="option" value="<?php echo $option; ?>" />
			<input type="hidden" name="section" value="<?php echo $section; ?>" />
			<input type="hidden" name="task" value="" />
			<input type="hidden" name="boxchecked" value="0" />
			<input type="hidden" name="hidemainmenu" value="0">
		</form>
		<?php
	}

	function editEvent( &$row, &$lists, $checked, $option, $section ) 
	{
        $mosConfig_live_site = JPATH_BASE;

		//if ( $row->image == '' ) 
		//{
		//	$row->image = 'blank.png';
		//}

		$tabs = & JPane::getInstance('tabs');

		JFilterOutput::objectHTMLSafe( $row, ENT_QUOTES, 'misc' );
		?>
		<script language="javascript" type="text/javascript">
		function submitbutton(pressbutton) {
			var form = document.adminForm;
			if (pressbutton == 'cancel') {
				submitform( pressbutton );
				return;
			}

			// do field validation
			if ( form.title.value == "" ) {
				alert( "You must provide a title." );
			}
			else if ( form.cat.value == "0" ) 
			{
				alert( "You must provide a category." );
			} else {

				submitform( pressbutton );
			}
		}
		</script>
		<div id="overDiv" style="position:absolute; visibility:hidden; z-index:10000;"></div>
			<form action="index2.php" method="post" name="adminForm">
	
				<table class="adminheading">
				<tr>
					<th>
					Event:
					<small>
					<?php echo $row->extid ? 'Edit' : 'New';?>
					</small>
					</th>
				</tr>
				</table>
		
				<table width="100%">
					<tr>
						<td width="60%" valign="top">
							<table width="100%" class="adminform">
							<tr>
								<th colspan="2">
									Event Details
								</th>
							<tr>
								
							<tr>
								<td width="20%" align="right">
									Title:
								</td>
								<td >
									<input class="inputbox" type="text" name="title" size="50" maxlength="100" value="<?php echo $row->title; ?>" />
								</td>
							</tr>
														
							<tr>
								<td align="right">
									Category:
								</td>
								<td>
									<?php echo $lists['categories'];?>
								</td>
							</tr>
														
							<tr>
								<td align="right">
									Event Description:
								</td>
								<td>
		            <?php 
		                // parameters : areaname, content, hidden field, width, height, rows, cols 
		                //editorArea( 'editor1',  $row->description , 'description', 500, 250, '70', '10' ) ; 
                        $editor = &JFactory::getEditor();
                        echo $editor->display( 'description',  $row->description , 500, 250, '70', '10');
                        //$editor->getContent('editor1');
		            ?>
         				</td>
							</tr>							
										
							<tr>
								<td rowspan='4' class='tableb' width='160'>Event Date</td>
								<td>Start Time:</td>
							</tr>
							<tr>
								<td>
									<?php echo $lists['days'];?>&nbsp;
									<?php echo $lists['months'];?>&nbsp;
									<?php echo $lists['years'];?>&nbsp;&nbsp;
									At:
									<?php echo $lists['hours'];?>
									<?php echo $lists['minutes'];?>
									<?php echo $lists['ampm'];?>
								</td>
							</tr>
							<tr>
								<td class='tablec'>Duration:</td>
							</tr>
							<tr>
								<td>
									<input type='radio' name='duration_type' value='1' <?php echo $checked['normal'];?>>&nbsp;&nbsp;&nbsp;
									<input type='text' name='end_days' class='textinput' value='<?php echo $row->endDays;?>' size='3'>&nbsp;Days&nbsp;&nbsp;
									<input type='text' name='end_hours' class='textinput' value='<?php echo $row->endHours;?>' size='3'>&nbsp;Hours&nbsp;&nbsp;
									<input type='text' name='end_minutes' class='textinput' value='<?php echo $row->endMinutes;?>' size='3'>&nbsp;Minutes&nbsp;&nbsp;
									<br />
									<input type='radio' name='duration_type' value='2' <?php echo $checked['allday'];?>>&nbsp;&nbsp;&nbsp;All Day
									<br />
									<input type='radio' name='duration_type' value='0' <?php echo $checked['none'];?>>&nbsp;&nbsp;&nbsp;No end date (Show start date only)
								</td>
							</tr>
							
							<tr>
								<td width="20%" align="right">
									Contact info:
								</td>
								<td >
									<textarea cols="50" rows="5" name="contact"><?php echo $row->contact; ?></textarea>
								</td>
							</tr>
							
							<tr>
								<td width="20%" align="right">
									Email:
								</td>
								<td >
									<input class="inputbox" type="text" name="email" size="50" maxlength="100" value="<?php echo $row->email; ?>" />
								</td>
							</tr>
							
							<tr>
								<td width="20%" align="right">
									URL:
								</td>
								<td >
									<input class="inputbox" type="text" name="url" size="50" maxlength="100" value="<?php echo $row->url; ?>" />
								</td>
							</tr>
							
							<tr>
								<td colspan="2">
									<table width='100%' cellpadding='4' cellspacing='0'>
										<tr>
											<td class='tablec'>Repeat Method</td>
											<td class='tablec'>Repeat End Date</td>
										</tr>
										<tr>
								  		<td class='tableb'>
								  			<input type="radio" name="recur_type_select" value="0" <?php echo $checked['recurNone'];?>> 
								  			Don't repeat this event
								  		</td>
											<td class='tableb'>
								  			<input type="radio" name="recur_end_type" value="0" <?php echo $checked['recurEndDateNone'];?>>No End Date
											</td>
										</tr>
										<tr>
								  		<td class='tableb'>
								  			<input type="radio" name="recur_type_select" value="1" <?php echo $checked['recurEvery'];?>> 
								  			Repeat every &nbsp;
								  			<input type="text" name="recur_val" value="<?php echo $row->recur_val;?>" size='3' class='textinput'>&nbsp;
												<?php echo $lists['recurValues']; ?>
								  		</td>
											<td class='tableb'>
												<input type="radio" name="recur_end_type" value="1" <?php echo $checked['recurEndDateCount'];?>>End after <input type="text" name="recur_count" value="<?php echo $row->recur_count;?>" size="2" class="textinput">
								  			occurrence(s)
											</td>
										</tr>
										<tr>
								  		<td class='tableb'>
								  		</td>
											<td class='tableb'>
								  			<input type="radio" name="recur_end_type" value="2" <?php echo $checked['recurEndDateUntil'];?>>Repeat until:
								  			&nbsp;
												<?php echo $lists['recuringDays']; ?>&nbsp;
												<?php echo $lists['recuringMonths']; ?>&nbsp;
												<?php echo $lists['recuringYears']; ?>
											
											</td>
										</tr>
									</table>
								</td>
							</tr>

							</table>
						</td>
						<td width="40%" valign="top">
							<?php
							$tabs->startPane("content-pane");
							$tabs->startPanel("Publishing","publish-page");
							?>
							<table width="100%" class="adminform">
							<tr>
								<th colspan="2">
									Publishing Info
								</th>
							<tr>
							<tr>
								<td valign="top" align="right">
									Published:
								</td>
								<td>
									<?php echo $lists['published']; ?>
								</td>
							</tr>

							<tr>
								<td valign="top" align="right">
									Approved:
								</td>
								<td>
									<?php echo $lists['approved']; ?>
								</td>
							</tr>
							
							<tr>
								<td colspan="2">
									&nbsp;
								</td>
							</tr>
							</table>
							<?php
							$tabs->endPanel();							
							$tabs->endPane();
							?>
						</td>
					</tr>
				</table>
		
				<script language="Javascript" src="<?php echo $mosConfig_live_site;?>/includes/js/overlib_mini.js"></script>
				<input type="hidden" name="option" value="<?php echo $option; ?>" />
				<input type="hidden" name="section" value="<?php echo $section; ?>" />
				<input type="hidden" name="extid" value="<?php echo $row->extid; ?>" />
				<input type="hidden" name="task" value="" />
			</form>
		<?php
	}
}
?>