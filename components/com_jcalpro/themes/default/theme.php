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

$File: theme.php - All templates and other theme related codes$

Revision date: 03/07/2007

**********************************************
Get the latest version of JCal Pro at:
http://dev.anything-digital.com/
**********************************************
*/

/** ensure this file is being included by a parent file */
defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );

global $option, $template_header, $template_footer, $meta_content, $lang_general;

$mosConfig_live_site = JPATH_SITE;



// Theme information
$theme_info = array (
	'name' => 'Default'
	,'author' => 'Anything Digital'
	,'author_email' => 'admin@anything-digital.com'
	,'author_url' => 'http://www.anything-digital.com'
	,'datemade' => '03/03/2007'
);

$todayclr = '#D0E6F6'; # color today
$sundayclr = '#DDE0E0'; # color calendarsunday
$weekdayclr = '#EEF0F0'; # color calendarweekday

// Highlighted colors
$todayclrHl = colorHighlight($todayclr);
$weekdayclrHl = colorHighlight($weekdayclr);
$sundayclrHl = colorHighlight($sundayclr);

// event icons array
$event_icons = array(
		'eventfull' => 'icon-event-onedate.gif'
		,'eventstart' => 'icon-event-startdate.gif'
		,'eventmiddle' => 'icon-event-middate.gif'
		,'eventend' => 'icon-event-enddate.gif'
);

$template_main_menu = <<<EOT
			<table border="0" cellpadding="0" cellspacing="0">
				<tr>
<!-- BEGIN add_event -->
					<td><img src="{URL}images/spacer.gif" width="10" height="25" border="0" alt="" /></td>
					<td class="buttontext" align="center" valign="middle" nowrap='nowrap'>
						<a href="{ADD_EVENT_TGT}" title="{ADD_EVENT_LNK}" class="buttontext">
							<img src="{URL}themes/default/images/icon-addevent.gif" border="0" alt="{ADD_EVENT_LNK}" /><br />
							{ADD_EVENT_LNK}</a>
					</td>
<!-- END add_event -->
<!-- BEGIN monthly_view -->
					<td><img src="{URL}images/spacer.gif" width="10" height="25" border="0" alt="" /></td>
					<td class="buttontext" align="center" valign="middle" nowrap='nowrap'>
						<a href="{CAL_VIEW_TGT}" title="{CAL_VIEW_LNK}" class="buttontext">
							<img src="{URL}themes/default/images/icon-calendarview.gif" border="0" alt="{CAL_VIEW_LNK}" /><br />
							{CAL_VIEW_LNK}</a>
					</td>
<!-- END monthly_view -->
<!-- BEGIN flyer_view -->
					<td><img src="{URL}images/spacer.gif" width="10" height="25" border="0" alt="" /></td>
					<td class="buttontext" align="center" valign="middle" nowrap='nowrap'>
						<a href="{FLYER_VIEW_TGT}" title="{FLYER_VIEW_LNK}" class="buttontext">
							<img src="{URL}themes/default/images/icon-flyer.gif" border="0" alt="{FLYER_VIEW_LNK}" /><br />
							{FLYER_VIEW_LNK}</a>
					</td>
<!-- END flyer_view -->
<!-- BEGIN weekly_view -->
					<td><img src="{URL}images/spacer.gif" width="10" height="25" border="0" alt="" /></td>
					<td class="buttontext" align="center" valign="middle" nowrap='nowrap'>
						<a href="{WEEKVIEW_TGT}" title="{WEEKVIEW_LNK}" class="buttontext">
							<img src="{URL}themes/default/images/icon-weekly.gif" border="0" alt="{WEEKVIEW_LNK}" /><br />
							{WEEKVIEW_LNK}</a>
					</td>
<!-- END weekly_view -->
<!-- BEGIN daily_view -->
					<td><img src="{URL}images/spacer.gif" width="10" height="25" border="0" alt="" /></td>
					<td class="buttontext" align="center" valign="middle" nowrap='nowrap'>
						<a href="{DAYVIEW_TGT}" title="{DAYVIEW_LNK}" class="buttontext">
							<img src="{URL}themes/default/images/icon-daily.gif" border="0" alt="{DAYVIEW_LNK}" /><br />
							{DAYVIEW_LNK}</a>
					</td>
<!-- END daily_view -->
<!-- BEGIN cat_view -->
					<td><img src="{URL}images/spacer.gif" width="10" height="25" border="0" alt="" /></td>
					<td class="buttontext" align="center" valign="middle" nowrap='nowrap'>
						<a href="{CAT_VIEW_TGT}" title="{CAT_VIEW_LNK}" class="buttontext">
							<img src="{URL}themes/default/images/icon-cats.gif" border="0" alt="{CAT_VIEW_LNK}" /><br />
							{CAT_VIEW_LNK}</a>
					</td>
<!-- END cat_view -->
<!-- BEGIN search_view -->
					<td><img src="{URL}images/spacer.gif" width="10" height="25" border="0" alt="" /></td>
					<td class="buttontext" align="center" valign="middle" nowrap='nowrap'>
						<a href="{SEARCH_TGT}" title="{SEARCH_LNK}" class="buttontext">
							<img src="{URL}themes/default/images/icon-search.gif" border="0" alt="{SEARCH_LNK}" /><br />
							{SEARCH_LNK}</a>
					</td>
<!-- END search_view -->
				</tr>
			</table>
EOT;

// HTML template for a generic message dialog box
$template_caption_dialog = <<<EOT
<!-- BEGIN message_row -->
				<tr class="tableb">
					<td align="center" class="tableb">
					<br /><br />
					<strong>{MESSAGE}</strong>
					<br /><br /><br />
					</td>
				</tr>
<!-- END message_row -->
<!-- BEGIN redirect_row -->
				<tr class="tablec">
					<td align='center' colspan='2' height='40' valign='middle' nowrap='nowrap' class="tablec">
					<form action="{URL}" method="post">
						<input type='submit' value="&nbsp;&nbsp;{BUTTON}&nbsp;&nbsp;" class='button' />
					</form>
					</td>
				</tr>
<!-- END redirect_row -->
EOT;

// HTML template to display an event form
$template_add_event_form = <<<EOT
	<tr><td>
    <form name="eventform" action="{TARGET}" method="post" enctype="multipart/form-data">
		<input name="extmode" type="hidden" value="{MODE}" />
		<input name="extid" type="hidden" value="{EVENT_ID}" />
        <table cellspacing="0" cellpadding="0" border="0">
<!-- BEGIN errors_row -->
		<tr>
			<td class='tablec' colspan='2'>
				<img src='{$CONFIG_EXT['calendar_url']}themes/default/images/errormessage.gif' style='vertical-align: middle' />&nbsp;<strong>{ERRORS}</strong>
			</td>
		</tr>
		<tr>
			<td class='tableb' colspan='2'>
				<div class='atomic'>{ERROR_MSG}</div>
			</td>
		</tr>
<!-- END errors_row -->
<!-- BEGIN event_details_row -->
		<tr>
			<td class='tableh2' colspan='2'>{EVENT_DETAILS_CAPTION}</td>
		</tr>
		<tr>
			<td class='tableb' width='160'>{TITLE_LABEL}</td>
			<td class='tableb'><input type='text' name='title' class='textinput' value="{TITLE_VAL}" size='37' />
			</td>
		</tr>
		<tr>
			<td class='tableb' width='160'>{DESC_LABEL}</td>
			<td class='tableb'>
			
			{DESC_EDITOR}
	
			</td>
		</tr>
		<tr>
			<td class='tableb' width='160'>{SEL_CATS_LABEL}</td>
			<td class='tableb'>
				<select name='cat' class='listbox'>
					<option value='0' style='color: #666666'>{SEL_CATS_DEF}</option>
					{SEL_CATS_VAL}
				</select>
			</td>
		</tr>
		<tr>
			<td rowspan='4' class='tableb' width='160'>{DATE_LABEL}</td>
			<td class='tablec'>{START_DATE_LABEL}:</td>
		</tr>
		<tr>
			<td class='tableb'>
				<select name='day' class='listbox'>
					<option value='0' style='color: #666666'>{DAY_LABEL}</option>
					{START_DAY_VAL}
				</select>&nbsp;
				<select name='month' class='listbox'>
					<option value='0' style='color: #666666'>{MONTH_LABEL}</option>
					{START_MONTH_VAL}
				</select>&nbsp;
				<select name='year' class='listbox'>
					<option value='0' style='color: #666666'>{YEAR_LABEL}</option>
					{START_YEAR_VAL}
				</select>&nbsp;&nbsp;
				{START_TIME_LABEL}:
				<select name='start_time_hour' class='listbox'>
					{START_HOUR_VAL}
				</select>
				<select name='start_time_minute' class='listbox'>
					{START_MINUTE_VAL}
				</select>
<!-- BEGIN 12hour_mode_row -->
				<select name='start_time_ampm' class='listbox'>
					{START_AMPM_VAL}
				</select>
<!-- END 12hour_mode_row -->
			</td>
		</tr>
		<tr>
			<td class='tablec'>{END_DATE_LABEL}:</td>
		</tr>
		<tr>
			<td class='tableb'>
				<input type='radio' name='duration_type' value='1' {DURATION_TYPE_NORMAL_CHECKED} />&nbsp;&nbsp;&nbsp;
				<input type='text' name='end_days' class='textinput' value='{DAYS_VAL}' size='3' />&nbsp;{DAYS_LABEL}&nbsp;&nbsp;
				<input type='text' name='end_hours' class='textinput' value='{HOURS_VAL}' size='3' />&nbsp;{HOURS_LABEL}&nbsp;&nbsp;
				<input type='text' name='end_minutes' class='textinput' value='{MINUTES_VAL}' size='3' />&nbsp;{MINUTES_LABEL}&nbsp;&nbsp;
				<br />
				<input type='radio' name='duration_type' value='2' {DURATION_TYPE_ALLDAY_CHECKED} />&nbsp;&nbsp;&nbsp;{ALL_DAY_LABEL}
				<br />
				<input type='radio' name='duration_type' value='0' {DURATION_TYPE_NONE_CHECKED} />&nbsp;&nbsp;&nbsp;{NO_DURATION_LABEL}
			</td>
		</tr>
<!-- END event_details_row -->
		<tr>
			<td class='tableh2' colspan='2'>{CONTACT_CAPTION}</td>
		</tr>
<!-- BEGIN contact_row -->
		<tr>
			<td class='tableb' width='160'>{CONTACT_LABEL}</td>
			<td class='tableb'>
				<textarea name='contact' cols='50' rows='5' class='textarea'>{CONTACT_VAL}</textarea>
			</td>
		</tr>
<!-- END contact_row -->
<!-- BEGIN email_row -->
		<tr>
			<td class='tableb' width='160'>{EMAIL_LABEL}</td>
			<td class='tableb'><input type='text' name='email' class='textinput' value="{EMAIL_VAL}" size='25' /></td>
		</tr>
<!-- END email_row -->
<!-- BEGIN url_row -->
		<tr>
			<td class='tableb' width='160'>{URL_LABEL}</td>
			<td class='tableb'><input type='text' name='url' class='textinput' value="{URL_VAL}" size='25' />
			</td>
		</tr>
<!-- END url_row -->

<!-- BEGIN recurrence_row -->
<tr>
	<td colspan='2'>

	<div style='{RECURRENCE_OPEN_SECTION}' id='recurrence_open'>
	  <div class='tableh2'>
	   <div style='float:right;width:auto'><a href='javascript:togglecategory("recurrence",1);'><img src='{THEME_DIR}/images/icon-plus.gif' border='0' alt='{EXPAND}' style='vertical-align: middle' /></a></div>
	   <div class='tableh2_nobackground'>{RECUR_CAPTION}</div>
	  </div>
	  <div class='tableb' align="center" id="recur_message">
	  	{RECURRENCE_MESSAGE}
	  </div>
	</div>
	
	
	<div style='{RECURRENCE_CLOSE_SECTION}' id='recurrence_close'>
	 	<div class='tableh2'>
	  	<div style='float:right;width:auto'><a href='javascript:togglecategory("recurrence",0);'><img src='{THEME_DIR}/images/icon-minus.gif' border='0' alt='{COLLAPSE}' style='vertical-align: middle' /></a></div>
	  	<div class='tableh2_nobackground'>{RECUR_CAPTION}</div>
		</div>
		<table width='100%' cellpadding='4' cellspacing='0'><tr>
				<td class='tablec'>{RECUR_METHOD_CAPTION}</td>
				<td class='tablec'>{RECUR_END_DATE_CAPTION}</td>
			</tr>
			<tr>
	  		<td class='tableb'>
	  			<input type="radio" name="recur_type_select" value="0" {RECUR_TYPE_NONE_CHECKED} onChange="setText('recur_message', noRecurEventMsg)" /> 
	  			{RECUR_TYPE_NONE}
	  		</td>
				<td class='tableb'>
	  			<input type="radio" name="recur_end_type" value="0" {RECUR_END_DATE_NONE_CHECKED} />{RECUR_END_DATE_NONE}
				</td>
			</tr>
			<tr>
	  		<td class='tableb'>
	  			<input type="radio" name="recur_type_select" value="1" {RECUR_TYPE_1_CHECKED} onChange="setText('recur_message', recurEventMsg)" /> 
	  			{RECUR_EVERY}&nbsp;
	  			<input type="text" name="recur_val_1" value="{RECUR_VAL_1}" size='3' class='textinput' />&nbsp;
	  			<select name="recur_type_1" class='listbox'>
						{RECUR_TYPE_1_OPTIONS}
					</select>
	  		</td>
				<td class='tableb'>
	  			<input type="radio" name="recur_end_type" value="1" {RECUR_END_DATE_COUNT_CHECKED} />{RECUR_END_DATE_COUNT}
				</td>
			</tr>
			<tr>
	  		<td class='tableb'>
	  		</td>
				<td class='tableb'>
	  			<input type="radio" name="recur_end_type" value="2" {RECUR_END_DATE_UNTIL_CHECKED} />{RECUR_END_DATE_UNTIL}:
	  			&nbsp;
					<select name='recur_until_day' class='listbox'>
						<option value='0' style='color: #666666'>{DAY_LABEL}</option>
						{RECUR_UNTIL_DAY_VAL}
					</select>&nbsp;
					<select name='recur_until_month' class='listbox'>
						<option value='0' style='color: #666666'>{MONTH_LABEL}</option>
						{RECUR_UNTIL_MONTH_VAL}
					</select>&nbsp;
					<select name='recur_until_year' class='listbox'>
						<option value='0' style='color: #666666'>{YEAR_LABEL}</option>
						{RECUR_UNTIL_YEAR_VAL}
					</select>
				
				</td>
			</tr>
		</table>
	</div>

	</td>
</tr>
<!-- END recurrence_row -->

<!-- BEGIN admin_row -->
		<tr>
			<td class='tableh2' colspan='2'>{ADMIN_CAPTION}</td>
		</tr>
		<tr>
			<td class='tableb' colspan='2' valign="middle">
				<input name="autoapprove" type="checkbox" value="1" {AUTO_APPR_STATUS} />{AUTO_APPR_LABEL}
			</td>
		</tr>
<!-- END admin_row -->
<!-- BEGIN submit_row -->
		<tr>
			<td class='tablec' colspan='2' align='center' valign='middle' height='40'>
				<input name='submit' type='submit' value="&nbsp;&nbsp;{SUBMIT}&nbsp;&nbsp;" class='button' />
			</td>
		</tr>
<!-- END submit_row -->
    </table>
	</form>
    </td></tr>
    
EOT;

// HTML template to display a monthly calendar view
$template_monthly_view = <<<EOT
<!-- BEGIN navigation_row -->
		<tr>
<!-- BEGIN weeknumber_row -->
			<td rowspan='2' class='tablev1'>&nbsp;</td>
<!-- END weeknumber_row -->
			<td colspan='2' height='22' align='center' valign='middle' nowrap='nowrap' class='previousmonth'>&nbsp;
<!-- BEGIN previous_month_link_row -->
				<a href="{PREVIOUS_MONTH_URL}" onmouseover='showOnBar("{PREVIOUS_MONTH}");return true;' onmouseout="showOnBar('');return true;">
      	<img src='$mosConfig_live_site/components/com_jcalpro/images/mini_arrowleft.gif' border='0' alt="{PREVIOUS_MONTH}" style='vertical-align: middle' hspace='5' />
      	{PREVIOUS_MONTH}</a>
<!-- END previous_month_link_row -->
			</td>
			<td colspan='3' height='22' align='center' valign='middle' class='currentmonth' style='{BG_COLOR}' nowrap='nowrap'>
				{CURRENT_MONTH}
			</td>
			<td colspan='2' height='22' align='center' valign='middle' nowrap='nowrap' class='nextmonth'>
				<a href="{NEXT_MONTH_URL}" onmouseover='showOnBar("{NEXT_MONTH}");return true;' onmouseout="showOnBar('');return true;">
      	{NEXT_MONTH}
      	<img src='$mosConfig_live_site/components/com_jcalpro/images/mini_arrowright.gif' border='0' alt="{NEXT_MONTH}" style='vertical-align: middle' hspace='5' />
      	</a>
			</td>
		</tr>
<!-- END navigation_row -->

<!-- BEGIN weekday_header_row -->
		<tr>
<!-- END weekday_header_row -->
<!-- BEGIN weekday_cell_row -->
			<td align="center" width="14%" height="18" valign="middle" class="{CSS_CLASS}">
				{WEEK_DAY}
			</td>
<!-- END weekday_cell_row -->
<!-- BEGIN weekday_footer_row -->
		</tr>
<!-- END weekday_footer_row -->

<!-- BEGIN day_cell_info_row -->
<!-- BEGIN day_cell_header_row -->
		<tr>
<!-- END day_cell_header_row -->
<!-- BEGIN weeknumber_cell_row -->
		<td class='tablev1' align='center'><a href="{URL_WEEK_VIEW}">{WEEK_NUMBER}</a></td>
<!-- END weeknumber_cell_row -->
<!-- BEGIN other_month_cell_row -->
		<td height='50' class='weekdayemptyclr' align='center' valign='middle'>{CELL_CONTENT}</td>
<!-- END other_month_cell_row -->
<!-- BEGIN day_cell_row -->
		<td height='50' class='{DAY_CLASS}' align='center' valign='top' onmouseover="cal_switchImage('add{DAY}', document.imageArray[0][1].src);cOn(this,'{HOVER_BG_COLOR}');showOnBar('{DATE_STRING}');return true;" onmouseout="cal_switchImage('add{DAY}', document.imageArray[0][0].src);cOut(this,'{BG_COLOR}');showOnBar('');return true;">
			<table border="0" cellspacing="0" cellpadding="0" width="100%">
				<tr>
					<td class="caldaydigits">&nbsp;<strong>
						<a href="{DAY_VIEW_LINK}">{DAY}</a></strong>
					</td>
					<td align="right">
						<a href="{ADD_EVENT_LINK}">
							<img name="add{DAY}" src="{THEME_DIR}/images/addsign.gif" alt="Add new event on {DATE_STRING}" border="0" /></a>&nbsp;
					</td>
				</tr>
			</table>
			{CELL_CONTENT}
		</td>
<!-- END day_cell_row -->
<!-- BEGIN day_cell_row_no_plus_sign -->
		<td height='50' class='{DAY_CLASS}' align='center' valign='top' onmouseover="cOn(this,'{HOVER_BG_COLOR}');showOnBar('{DATE_STRING}');return true;" onmouseout="cOut(this,'{BG_COLOR}');showOnBar('');return true;">
			<table border="0" cellspacing="0" cellpadding="0" width="100%">
				<tr>
					<td class="caldaydigits">&nbsp;<strong>
						<a href="{DAY_VIEW_LINK}">{DAY}</a></strong>
					</td>
				</tr>
			</table>
			{CELL_CONTENT}
		</td>
<!-- END day_cell_row_no_plus_sign -->
<!-- BEGIN day_cell_footer_row -->
		</tr>
<!-- END day_cell_footer_row -->
<!-- END day_cell_info_row -->
EOT;

// HTML template to display a monthly calendar view
$template_mini_cal_view = <<<EOT
<!-- BEGIN header_row -->
	<table align="center" border="0" cellspacing="1" cellpadding="0" style="background-color: #FFFFFF; border: 1px solid #BEC2C3; width: 135">
		<tr>
			<td>
<!-- END header_row -->
<!-- BEGIN navigation_row -->
			<table border="0" cellspacing="0" cellpadding="2" width="100%" class="extcal_navbar">
				<tr>
<!-- BEGIN with_navigation_row -->
<!-- BEGIN no_previous_month_link_row -->
					<td align="center" height="18" valign="middle"><img src="{THEME_DIR}/images/mini_arrowleft_inactive.gif" border="0" alt="" title="" /></td>
<!-- END no_previous_month_link_row -->
<!-- BEGIN previous_month_link_row -->
					<td align="center" height="18" valign="middle"
						onmouseover="extcal_showOnBar('{PREVIOUS_MONTH}');return true;" 
						onmouseout="extcal_showOnBar('');return true;">
						<a href="{PREVIOUS_MONTH_URL}"><img src="{THEME_DIR}/images/mini_arrowleft.gif" border="0" alt="{PREVIOUS_MONTH}" title="{PREVIOUS_MONTH}" /></a></td>
<!-- END previous_month_link_row -->
					<td align="center" height="18" valign="middle" width="98%" class='extcal_month_label' nowrap='nowrap'>{CURRENT_MONTH}</td>
					<td align="center" height="18" valign="middle"
						onmouseover="extcal_showOnBar('{NEXT_MONTH}');return true;" 
						onmouseout="extcal_showOnBar('');return true;">
					  <a href="{NEXT_MONTH_URL}"><img src="{THEME_DIR}/images/mini_arrowright.gif" border="0" alt="{NEXT_MONTH}" title="{NEXT_MONTH}" /></a></td>
<!-- END with_navigation_row -->
<!-- BEGIN without_navigation_row -->
					<td colspan="3" align="center" height="18" valign="middle" width="98%" class='extcal_month_label' nowrap='nowrap'>{CURRENT_MONTH}</td>
<!-- END without_navigation_row -->
				</tr>
			</table>
<!-- END navigation_row -->

<!-- BEGIN picture_row -->
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
			  <tr>
			    <td class="extcal_picture">
						<a href='{TODAY_URL}' 
							onmouseover="extcal_showOnBar('{STATUS_MESSAGE}');return true;" 
							onmouseout="extcal_showOnBar('');return true;">
					<img src='{PICTURE_URL}' width='135' alt='{PICTURE_MESSAGE}' border='0' /></a></td>
			  </tr>
			</table>
<!-- END picture_row -->

<!-- BEGIN weekday_header_row -->
	<table align="center" border="0" cellspacing="0" cellpadding="0" width="135"  class="extcal_weekdays">
		<tr>
			<td></td>
<!-- END weekday_header_row -->
<!-- BEGIN weekday_cell_row -->
			<td height='24' class="{CSS_CLASS}" valign="top" align="center">
				{WEEK_DAY}
			</td>
<!-- END weekday_cell_row -->
<!-- BEGIN weekday_footer_row -->
		</tr>
<!-- END weekday_footer_row -->

<!-- BEGIN day_cell_info_row -->
<!-- BEGIN day_cell_header_row -->
		<tr>
<!-- END day_cell_header_row -->
<!-- BEGIN weeknumber_cell_row -->
		<td class='extcal_weekcell' align='center'
				onmouseover="extcal_showOnBar('{WEEK_NUMBER}');return true;" 
				onmouseout="extcal_showOnBar('');return true;">
			<a href="{URL_WEEK_VIEW}" target="{TARGET}"><img src="{THEME_DIR}/images/icon-mini-week.gif" width="5" height="20" border="0" alt="{WEEK_NUMBER}" /></a></td>
<!-- END weeknumber_cell_row -->
<!-- BEGIN other_month_cell_row -->
		<td height='15' class='extcal_othermonth' align='center' valign='middle'>{CELL_CONTENT}</td>
<!-- END other_month_cell_row -->
<!-- BEGIN day_cell_row -->
		<td height='15' class='{DAY_CLASS}' align='center' valign='top' onmouseover="extcal_showOnBar('{DATE_STRING}');return true;" onmouseout="extcal_showOnBar('');return true;">
<!-- BEGIN linkable_row -->
			<a href="{URL_TARGET_DATE}" title="{CELL_CONTENT}" class="{DAY_LINK_CLASS}" target="{TARGET}">{DAY}</a>
<!-- END linkable_row -->
<!-- BEGIN static_row -->
			<span title="{CELL_CONTENT}" class="{DAY_CLASS}">{DAY}</span>
<!-- END static_row -->
		</td>
<!-- END day_cell_row -->

<!-- BEGIN day_cell_footer_row -->
		</tr>
<!-- END day_cell_footer_row -->
<!-- END day_cell_info_row -->
<!-- BEGIN footer_row -->
			</table>
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
			  <tr>
			    <td height="1" bgcolor="#D5D5D5"><img src="{THEME_DIR}/images/pixel.gif" height="1" /></td>
			  </tr>
			</table>
	  </td>
  </tr>
</table>
<table width="135" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td height="1" bgcolor="#EEEEEE"><img src="{THEME_DIR}/images/pixel.gif" height="1" /></td>
  </tr>
	<tr>
		<td align="center" nowrap='nowrap'>
<!-- BEGIN add_event_row -->
			<a href="{ADD_EVENT_URL}"
				onmouseover="extcal_showOnBar('{ADD_EVENT_TITLE}');return true;" 
				onmouseout="extcal_showOnBar('');return true;">
				<img src="{THEME_DIR}/images/addsign_a.gif" align="middle" alt="{ADD_EVENT_TITLE}" border="0" /></a>
<!-- END add_event_row -->
		</td>
	</tr>
</table>
</div>
<!-- END footer_row -->
<!-- BEGIN inline_style_row -->
<style type="text/css">
.extcal_navbar {
	background-image: url({THEME_DIR}/images/bg1.gif);
	background-repeat: repeat-x;
	border-bottom: 1px solid #B4B4B6;
}

TABLE.extcal_weekdays {
	background-image: url({THEME_DIR}/images/bg1.gif);
	background-repeat: repeat-x;
	border-top: 1px solid #FFFFFF;
}
TD.extcal_weekdays {
	font-family: "Trebuchet MS", Verdana, Arial, "Microsoft Sans Serif"; 
	font-size: 9px;
	font-weight: normal;
	color: #333333;
	text-decoration: none;
	padding-top: 4px;
}
.extcal_small {
	font-family: Verdana;
	font-size: 9px;
	color:#575767;
	text-decoration: none;
}
.extcal_small:link,.extcal_small:visited {
	text-decoration: none;
}
.extcal_small:hover {
	text-decoration: underline;
}

.extcal_daycell,.extcal_todaycell,
.extcal_sundaycell,.extcal_othermonth {
	font-family: "Trebuchet MS", Verdana, Arial, "Microsoft Sans Serif"; 
	font-size: 9px;
	font-weight: bold;
	font-style: normal;
	text-decoration: none;
	color:#555555;
	background-repeat: no-repeat;
	background-position: center center;
	padding-top: 3px;
	padding-bottom: 3px;
	padding-right: 2px;
	padding-left: 2px;
}

.extcal_todaycell {
	color:#99AAAA;
	background-image: url({THEME_DIR}/images/rect.gif);
}

.extcal_sundaycell {
	color:#99AAAA;
}

.extcal_othermonth {
	color:#99AAAA;
}

.extcal_daylink, .extcal_sundaylink,
.extcal_busylink  {
	font-family: "Trebuchet MS", Verdana, Arial, "Microsoft Sans Serif"; 
	font-size: 9px;
	font-weight: bold;
	font-style: normal;
	text-decoration: none;
}

.extcal_daylink:link,.extcal_daylink:visited {
	color:#555555;
}

.extcal_busylink:link,.extcal_busylink:visited { 
	color:#2266EE;
	text-decoration: none; 
}

.extcal_sundaylink:link,.extcal_sundaylink:visited {
	color:#99AAAA;
}

.extcal_month_label {
	font-family: Verdana, Arial, "Microsoft Sans Serif"; 
	font-size: 10px;
	font-weight: bold;
	color: #565666;
}
.extcal_picture {
}
.extcal_weekcell {
  margin: 0px;
  padding: 0px;
}
</style>
<script type="text/javascript">
	function extcal_showOnBar(Str)
	{
		window.status=Str;
		return true;
	}
</script>
<!-- END inline_style_row -->
EOT;

// HTML template to display a category form in the admin panel
$template_cat_form = <<<EOT
	<table class="adminheading">
		<tr>
			<th class="modules">
				{CAT_MAIN_CAPTION}
			</th>
		</tr>
	</table>
		
	<table width="100%">
		<tr>
			<td>
				<form name="adminForm" action="{TARGET}" method="post">
					<input name="extmode" type="hidden" value="{MODE}" />
					<input name="cat_id" type="hidden" value="{CAT_ID}" />
    				<table class="adminform">
				    <!-- BEGIN errors_row -->
						<tr>
							<td colspan='2'>
								<img src='{$CONFIG_EXT['calendar_url']}themes/default/images/errormessage.gif' style='vertical-align: middle' />&nbsp;<strong>{ERRORS}</strong>
							</td>
						</tr>
						<tr>
							<td class='tableb' colspan='2'>
								<div class='atomic'>{ERROR_MSG}</div>
							</td>
						</tr>
				    <!-- END errors_row -->
				    <!-- BEGIN cat_details_row -->
						<tr>
							<th colspan='2'>{CAT_DETAILS_CAPTION}</td>
						</tr>
						<tr>
							<td class='tableb' width='160'>{CAT_NAME_LABEL}</td>
							<td class='tableb'><input type='text' name='cat_name' class='textinput' value="{CAT_NAME_VAL}" size='25' />
							</td>
						</tr>
						<tr>
							<td class='tableb' width='160'>{DESC_LABEL}</td>
							<td class='tableb'><textarea name='description' cols='25' rows='3' class='textarea'>{DESC_VAL}</textarea>
							</td>
						</tr>
				    <!-- END cat_details_row -->
						<tr>
							<td class='tableb' width='160'>{COLOR_LABEL}</td>
							<td class='tableb'><table cellpadding="0" cellspacing="0" border="0"><tr><td><input type='text' name='color' id='color' class='textinput' value="{COLOR}" onChange="getElement('colorpickerbg').style.backgroundColor= getElement('color').value;" size='12' />&nbsp;&nbsp;</td><td><table cellpadding="0" cellspacing="0" border="0" width="18" height="17"><tr><td id="colorpickerbg" bgcolor="{COLOR}" width="18" height="17"><a href='Javascript: //' 
				 				onClick="MM_openBrWindow('{PICK_COLOR_LNK}','ColorPicker','toolbar=no,status=no,resizable=yes',165,145,true)"><img src='{PICK_COLOR_ICON}' border='0' /></a></td></tr></table></td><td nowrap='nowrap'><span class='atomic'>&nbsp;&nbsp;{PICK_COLOR}</span></td></tr></table>
							</td>
						</tr>
						<tr>
							<td class='tableb' width='160'>{CATEGORY_LABEL}</td>
							<td class='tableb'>
								{CATEGORIES_SELECT}
							</td>
						</tr>
						<tr>
							<td class='tableb' width='160'>{STATUS_LABEL}</td>
							<td class='tableb'>
								<input name="published" type="checkbox" value="1" {STATUS_CHK} />{STATUS_ACTIVE_LABEL}
							</td>
						</tr>
					<input type="hidden" name="option" value="$option" />
					<input type="hidden" name="task" value="" />
				    </table>
			    </form>
			</tr>
		</td>
	</table>
EOT;

// HTML template for the search form
$template_search_form = <<<EOT
<!-- BEGIN message_row -->
		<tr class="tableb_search">
			<td colspan="3" align="center" valign="middle" class="tableb_search">
		    <form action="{$CONFIG_EXT['calendar_calling_page']}" method="post">
			    <input type='text' name='extcal_search' class='textinput' value="{KEY_DESC}" onfocus="if(this.value == '{KEY_DESC}') this.value='';" onblur="if(!this.value) this.value = '{KEY_DESC}';" size='25' />
				<input name='submit' type='submit' value="Go" class='button' />
				<input name='extmode' type='hidden' value="extcal_search" />
    	    </form>
			</td>
		</tr>
		
EOT;

// HTML template to display a specific event
$template_event_view = <<<EOT
<!-- BEGIN info_row -->
		<tr>
			<td width="50%">
			<table width='100%' cellpadding='0' cellspacing='0' border='0'>
				<tr>
					<td width='6' bgcolor='{BG_COLOR}'>
						<img src='$mosConfig_live_site/components/com_jcalpro/images/spacer.gif' width='6' height='{CATEGORY_COLOR_SPACER_IMAGE_HEIGHT}' alt='' />
					</td>
					<td class='tablec' valign='middle' width='100%'>
        		<a {CAT_LINK} class='cattitle'>{CAT_NAME}</a><br />
        		<div class='catdesc'>{CAT_DESC}</div>
					</td>
				</tr>
			</table>
			</td>
			<td class="tablec" width="50%">
				<div class="atomic"><strong>{EVENT_START_DATE_LABEL}</strong> {EVENT_START_DATE}</div>
<!-- BEGIN duration_row -->
				<div class="atomic"><strong>{EVENT_DURATION_LABEL}</strong> {EVENT_DURATION}</div>
<!-- END duration_row -->
<!-- BEGIN recurrence_row -->
				<div class="atomic"><strong>{EVENT_RECURRENCE_LABEL}</strong> {EVENT_RECURRENCE}</div>
<!-- END recurrence_row -->
			</td>
		</tr>
<!-- END info_row -->
<!-- BEGIN contact_row -->
		<tr class="tablec">
			<td class="tablec" colspan="2">
				<table width='100%' cellpadding='0' cellspacing='4' border='0' align="center">
					<td width="50%" valign="top">
						<div class="atomic"><strong>{CONTACT_INFO_LABEL}</strong></div>
						<div class="atomic">{CONTACT_INFO}</div>
					</td>
					<td width="50%">
						<div class="atomic"><strong>{CONTACT_EMAIL_LABEL}</strong> {CONTACT_EMAIL}</a></div>
						<div class="atomic"><strong>{CONTACT_URL_LABEL}</strong> <a href='{CONTACT_URL}' target="{CONTACT_URL_TARGET}">{CONTACT_URL}</a></div>
					</td>
				</table>
			</td>
		</tr>
<!-- END contact_row -->
<!-- BEGIN result_row -->
		<tr class="tableb" style="height: 30px">
			<td class='tableb' colspan="2" valign='middle'>
				<img src='$mosConfig_live_site/components/com_jcalpro/images/spacer.gif' width='1' height='8' alt='' /><br />
    		<div class='eventdesclarge'>{EVENT_DESC}</div>
    		<br />
			</td>
		</tr>
<!-- END result_row -->
<!-- BEGIN nav_row -->
		<tr>
			<td class='tablec' colspan='2' align='center' valign='middle' height='40'>
				<input name='back' type='button' onclick="{BACK_LINK}" value="&nbsp;&nbsp;{BACK_BUTTON}&nbsp;&nbsp;" class='button' />
			</td>
		</tr>
<!-- END nav_row -->
EOT;


// HTML template for a list of events within a category
$template_cat_events_list = <<<EOT
<!-- BEGIN info1_row -->
		<tr class="tablec">
			<td class="tablec" colspan="2" align="left" nowrap='nowrap'><img src='{$CONFIG_EXT['calendar_url']}themes/default/images/icon-cat-active.gif' alt='{CATEGORY_INFO}' style='vertical-align: middle' />&nbsp;<span class="atomic">{CATEGORY_DESC}</span></td>
		</tr>
<!-- BEGIN noevents_row -->
		<tr class="tableb">
			<td class="tableb" colspan="2" align="center"><strong>{NO_EVENTS}</strong>&nbsp;&nbsp;</td>
		</tr>
<!-- END noevents_row -->
<!-- END info1_row -->
<!-- BEGIN info2_row -->
		<tr class="tableh2">
			<td class="tableh2" width="90%">{EVENT_NAME}</td>
			<td class="tableh2" align="center" nowrap='nowrap'>{EVENT_DATE}</td>
		</tr>
<!-- END info2_row -->
<!-- BEGIN result_row -->
		<tr class="tableb" style="height: 30px">
			<td class='tableb' valign='middle'><a {LINK} class='eventtitle'>{EVENT_NAME}</a>
			</td>
			<td class='tableb' align='center' valign='middle' nowrap='nowrap'><span class='atomic'>{EVENT_DATE}</span></td>
		</tr>
<!-- END result_row -->
<!-- BEGIN stats_row -->
		<tr class="tablec">
			<td class="tablec" colspan="2" align="right"><span class="atomic">{STATS}&nbsp;&nbsp;</span></td>
		</tr>
<!-- END stats_row -->
EOT;

// HTML template for a list of active categories
$template_cats_list = <<<EOT
<!-- BEGIN info_row -->
		<tr class="tableh2">
			<td class="tableh2" width="90%">{CAT_NAME}</td>
			<td class="tableh2" align="center" nowrap='nowrap'>{UPCOMING_EVENTS}</td>
			<td class="tableh2" align="center" nowrap='nowrap'>{TOTAL_EVENTS}</td>
		</tr>
<!-- END info_row -->
<!-- BEGIN result_row -->
		<tr>
			<td>
			<table width='100%' cellpadding='0' cellspacing='0' border='0'>
				<tr>
					<td width='6' bgcolor='{BG_COLOR}'>
						<img src='$mosConfig_live_site/components/com_jcalpro/images/spacer.gif' width='6' height='25' alt=''/>
					</td>
					<td class='tableb' valign='middle' width='100%'>
        		<a href='{LINK}' class='cattitle'>{CAT_NAME}</a><br />
        		<div class='catdesc'>{CAT_DESC}</div>
					</td>
				</tr>
			</table>
			</td>
			<td class='tableb' align='center' valign='middle'>{UPCOMING_EVENTS}</td>
			<td class='tableb' align='center' valign='middle'>{TOTAL_EVENTS}</td>
		</tr>
<!-- END result_row -->
<!-- BEGIN stats_row -->
		<tr class="tablec">
			<td class="tablec" colspan="3" align="right"><span class="atomic">{STATS}&nbsp;&nbsp;</span></td>
		</tr>
<!-- END stats_row -->
EOT;

// HTML template for the search results
$template_search_results = <<<EOT

<!-- BEGIN no_results_row -->
		<tr class="tableb">
			<td class="tableb" colspan="4" align="center"><br /><br /><strong>{NO_RESULTS}</strong><br /><br /><br /></td>
		</tr>
<!-- END no_results_row -->
<!-- BEGIN info_row -->
		<tr class="tableh2">
			<td width="80%" nowrap='nowrap' class="tableh2">
				<strong>{SEARCH_RESULTS}</strong>
			</td>
			<td align='center' nowrap='nowrap' class="tableh2">
				<strong>{CATEGORY}</strong>
			</td>
			<td align='center' nowrap='nowrap' class="tableh2">
				<strong>{DATE}</strong>
			</td>
		</tr>
<!-- END info_row -->
<!-- BEGIN result_row -->
		<tr class="tableb">
			<td width="80%" nowrap='nowrap' class="tableb">
				<a {SEARCH_LNK} class='searchlink'>{SEARCH_TITLE}</a><br />
				<img src='$mosConfig_live_site/components/com_jcalpro/images/spacer.gif' width='1' height='5' alt='' /><br />
				<div class='searchdesc'>{SEARCH_DESC}</div>
				<img src='$mosConfig_live_site/components/com_jcalpro/images/spacer.gif' width='1' height='8' alt='' /><br />
			</td>
			<td align='center' nowrap='nowrap' class="tableb">
				<a href='{CAT_LINK}'>{CAT_NAME}</a>
			</td>
			<td align='center' nowrap='nowrap' class="tableb">
				<span class='atomic'>{DATE}</span>
			</td>
		</tr>
<!-- END result_row -->
<!-- BEGIN stats_row -->
		<tr class="tablec">
			<td class="tablec" colspan="3" align="right"><span class="atomic">{STATS}&nbsp;&nbsp;</span></td>
		</tr>
<!-- END stats_row -->
<!-- BEGIN search_row -->

<!-- BEGIN message_row -->
		<tr class="tableb_search">
			<td colspan="3" align="center" valign="middle" class="tableb_search">
		    <form action="{$CONFIG_EXT['calendar_calling_page']}" method="post">
			    <input type='text' name='extcal_search' class='textinput' value="{KEY_DESC}" onfocus="if(this.value == '{KEY_DESC}') this.value='';" onblur="if(!this.value) this.value = '{KEY_DESC}';" size='25' />
				<input name='submit' type='submit' value="Go" class='button' />
				<input name='extmode' type='hidden' value="extcal_search" />		
        	</form>
			</td>
		</tr>
<!-- END search_row -->
EOT;

// HTML template for the legend of color-coded categories
$template_cat_legend = <<<EOT
<!-- BEGIN header_row -->
<tr>
	<td colspan="{ROWS}" class="tablec">
		<table border="0" cellspacing="5" cellpadding="0" width="100%">
<!-- END header_row -->
<!-- BEGIN start_col_row -->
			<tr>
<!-- END start_col_row -->
<!-- BEGIN today_row -->
				<td bgcolor="{COLOR}" width='5' height='5' style='border: 1px solid #FFFFFF'>
					<img src="$mosConfig_live_site/components/com_jcalpro/images/spacer.gif" width="5" height="5" alt="" />
				</td>
				<td class="legend">{TODAY}&nbsp;&nbsp;</td>
<!-- END today_row -->
<!-- BEGIN cats_row -->
				<td bgcolor="{COLOR}" width='5' height='5' style='border: 1px solid #FFFFFF'>
					<img src="$mosConfig_live_site/components/com_jcalpro/images/spacer.gif" width="5" height="5" alt="" />
				</td>
				<td class="legend">
					<a {CAT_LINK}>{CAT_NAME}</a>&nbsp;&nbsp;
				</td>
<!-- END cats_row -->
<!-- BEGIN empty_cell_row -->
				<td width='5' height='5'>
					<img src="$mosConfig_live_site/components/com_jcalpro/images/spacer.gif" width="5" height="5" alt="" />
				</td>
				<td>&nbsp;</td>
<!-- END empty_cell_row -->
<!-- BEGIN end_col_row -->
			</tr>
<!-- END end_col_row -->
<!-- BEGIN footer_row -->
		</table>
	</td>
</tr>
<!-- END footer_row -->
EOT;

// HTML template for the events to approve
$template_admin_events = <<<EOT
<!-- BEGIN filter_row -->
		<tr class="tablec">
			<td height="35" colspan="5" nowrap='nowrap' class="tablec" align="right" valign="middle"><span class="atomic">{EVENTS_FILTER_LABEL}:</span>&nbsp;
			    <form name="filter" action="{FILTER_LINK}" method="post">
				<select name='eventfilter' class='listbox' onChange="this.form.submit()">
					{EVENTS_FILTER_OPTIONS}
				</select>
			    </form>
			</td>
		</tr>
<!-- END filter_row -->
<!-- BEGIN noevents_row -->
		<tr class="tableb">
			<td class="tableb" colspan="5" align="center"><strong>{NO_EVENTS}</strong>&nbsp;&nbsp;</td>
		</tr>
<!-- END noevents_row -->
<!-- BEGIN info_row -->
		<tr class="tableh2">
			<td colspan="1" width="90%" nowrap='nowrap' class="tableh2">{EVENT_STAT}</td>
			<td nowrap='nowrap' class="tableh2">
				&nbsp;
			</td>
			<td align='center' nowrap='nowrap' class="tableh2">{DATE}</td>
			<td align='center' nowrap='nowrap' class="tableh2">{ACTION}</td>
		</tr>
<!-- END info_row -->
<!-- BEGIN result_row -->
		<tr>
			<td width="90%" nowrap='nowrap'>
				<table width='100%' cellpadding='0' cellspacing='0' border='0'>
					<tr>
						<td width='6' bgcolor='{BG_COLOR}'>
							<img src='$mosConfig_live_site/components/com_jcalpro/images/spacer.gif' alt="{CAT_NAME}" width='6' height='40' />
						</td>
						<td width='18' class='tablec'>
							<a href='{EVENT_LNK}'><img src="{STATUS_ICON}" alt="{STATUS}" border="0" /></a>
						</td>
						<td class='tableb' valign='middle' width='100%'>
							<a href='{EVENT_LNK}' class='eventtitle'>{EVENT_TITLE}</a>
	        	</td>
					</tr>
				</table>
			</td>
			<td align='center' class="tablec" valign="middle">
				{PICTURE}
			</td>
			<td align='center' nowrap='nowrap' class="tableb">
				<span class='atomic'>{DATE}</span>
			</td>
			<td align='center' nowrap='nowrap' class="tableb">
				<a href='{ADMIN_EDIT_EVENT_LINK}'><img src="{$CONFIG_EXT['calendar_url']}themes/default/images/icon-editevent.gif" alt="{EDIT}" hspace="2" border="0" /></a>
<!-- BEGIN approve_row -->
				<a href='{ADMIN_APPROVE_EVENT_LINK}'><img src="{$CONFIG_EXT['calendar_url']}themes/default/images/icon-apprevent.gif" alt="{APPROVE}" hspace="2" border="0" /></a>
<!-- END approve_row -->
				<a href='{ADMIN_DELETE_EVENT_LINK}' onClick="return verify('{DEL_MSG}')"><img src="{$CONFIG_EXT['calendar_url']}themes/default/images/icon-delevent.gif" alt="{DELETE}" hspace="2" border="0" /></a>
			</td>
		</tr>
<!-- END result_row -->
<!-- BEGIN stats_row -->
		<tr class="tablec">
			<td class="tablec" colspan="5" align="right"><span class="atomic">{STATS}&nbsp;&nbsp;</span></td>
		</tr>
<!-- END stats_row -->
EOT;

// HTML template for error strings in form validation
$template_error_string = <<<EOT
<div class='atomic'>
	<span style='color:red'>&middot;</span>&nbsp;{MESSAGE}
</div>
EOT;
 
// Function that returns dynamic javascript code that cannot be included in a javascript file
//
function inline_jscode($set = '')
{
	global $CONFIG_EXT, $lang_add_event_view;

	$js_variables = <<<EOT

	// text editor variables
	var text_enter_url      = "Enter the complete URL for the hyperlink";
	var text_enter_url_name = "Enter the title of the webpage";
	var text_enter_image    = "Enter the complete URL for the image";
	var text_enter_email    = "Enter the email address";
	var prompt_start        = "Enter the text to be formatted";
	
	// repeat event messages
	var recurEventMsg = "{$lang_add_event_view['event_repeat_msg']}";
	var noRecurEventMsg = "{$lang_add_event_view['event_no_repeat_msg']}";

	// cookie variables
	var extcal_cookie_id = "{$CONFIG_EXT['cookie_name']}";
	var extcal_cookie_path = "{$CONFIG_EXT['cookie_path']}";
	var extcal_cookie_domain = "";

EOT;

	$inline_jscode = <<<EOT
	
<script type="text/javascript">
<!--
	function printDocument()
	{
		self.focus();
		self.print();
	}
	function verify(msg){
			if(!msg) msg = "Are you absolutely sure that you want to delete this item?";
			//all we have to do is return the return value of the confirm() method
			return confirm(msg);
	}
//-->
</script>
	
EOT;

// selecting requested code
$selected_code = $js_variables;
	$selected_code = <<<EOT
<script type="text/javascript">
<!--
$selected_code;	
//-->
</script>	
EOT;

	return $selected_code;

}

// Custom template for the Admin Menu in Mambo installation
function theme_admin_menu() {
  global $CONFIG_EXT, $lang_event_admin_data, $event_mode;
  $database = &JFactory::getDBO();
  $my = &JFactory::getUser();

  $returnstring = '';
  if (has_priv("approve") && ($event_mode != 'view')) {
   // Only show that events need approval if user is administrator, if events actually exist,
   // and if you are not already viewing those events. 
    $query = "SELECT extid FROM ".$CONFIG_EXT['TABLE_EVENTS']." WHERE approved = 0";
	$result = extcal_db_query($query);
	$rows = extcal_db_num_rows($result);
	if ($rows > 0) {
       define('ADMIN_EVENTS_PHP', true);
       include $CONFIG_EXT['LANGUAGES_DIR']."{$CONFIG_EXT['lang']}/index.php";
	   $sef_href = JRoute::_( $CONFIG_EXT['calendar_calling_page'].'&extmode=event&event_mode=view' );
       $linkstring = '<a href="'.$sef_href.'" class="button">&nbsp;'.$lang_event_admin_data['events_to_approve'].'&nbsp;('.$rows.')&nbsp;</a>';
       $returnstring = '
		<table width="100%" cellpadding="10" cellspacing="0" border="0" bgcolor="#FFFFFF">
		 <tr>
		  <td class="tableh1" align="center" nowrap="nowrap"><div class="atomic">'.$linkstring.'</div></td>
		 </tr>
		</table>
';
	 }
  }
  return $returnstring;
}

// HTML template for the page header
function pageheader($section = '', $meta = '')
{
	global $CONFIG_EXT, $THEME_DIR, $lang_event_admin_data, $event_mode;
	global $template_header, $meta_content, $lang_info, $lang_general, $lang_system, $upgrade_detected;
	global $show_main_menu;
    $database = &JFactory::getDBO();
    $my = &JFactory::getUser();
	
	// If this is a theme where the main menu bar is normally displayed, check with config
	// to see whether in fact to display it.
	if( $show_main_menu ) $show_main_menu = $CONFIG_EXT['show_top_navigation_bar'];
	
	if(empty($section)) $section = $CONFIG_EXT['app_name'];

    $template_vars = array(
  		'{LANG_DIR}' => $lang_info['direction'],
      '{TITLE}' => $section,
      '{CHARSET}' => $CONFIG_EXT['charset'] == 'language-file' ? $lang_info['charset'] : $CONFIG_EXT['charset'],
      '{META}' => inline_jscode(),
      '{CAL_NAME}' => $CONFIG_EXT['app_name'],
      '{CAL_DESCRIPTION}' => $CONFIG_EXT['calendar_description'],
      '{MAIN_MENU}' => $show_main_menu ? theme_main_menu() : '',
      '{ADMIN_MENU}' => defined('IN_MAMBO_ADMIN_SECTION') ? '' : theme_admin_menu(),
      '{THEME_DIR}' => addslashes($THEME_DIR),
      '{MAIN_TABLE_WIDTH}' => $CONFIG_EXT['main_table_width']
      );
      
    echo template_eval($template_header, $template_vars);
}

// HTML template for Pop-up page headers
function popup_pageheader($section = '', $meta = '')
{
	global $CONFIG_EXT, $THEME_DIR;
	global $template_header, $lang_info;
	
	if(empty($section)) $section = $CONFIG_EXT['app_name'];
?>
<html>
<head>
<title><?php echo $section; ?></title>
<?php echo $meta; ?>
<link rel="stylesheet" href="<?php echo $THEME_DIR; ?>/style.css" type="text/css">
<script type="text/javascript">
<!--
	function printDocument()
	{
	  self.focus();
	  self.print();
	}
	function verify(msg){
			if(!msg) msg = "Are you absolutely sure that you want to delete this item?";
			
			//all we have to do is return the return value of the confirm() method
			return confirm(msg);
	}
//-->
</script>
</head>
<body bgcolor="#FFFFFF" text="#000000" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<div id="extcalendar">
  <div align="center">
<?php
}

// HTML template for the page footer
function pagefooter()
{
	global $CONFIG_EXT, $THEME_DIR, $template_footer;
	
	$section = $CONFIG_EXT['app_name'];

  $template_vars = array(
      '{TITLE}' => $section,
      '{CAL_NAME}' => $CONFIG_EXT['app_name'],
      '{CAL_DESCRIPTION}' => $CONFIG_EXT['calendar_description'],
      '{THEME_DIR}' => $THEME_DIR
      );

  echo template_eval($template_footer, $template_vars);

	//ob_end_flush();
	
}

// HTML template for pop-up page footer
function popup_pagefooter()
{
	global $CONFIG_EXT, $THEME_DIR, $template_footer;

?>
		<div class="atomic">Powered by <a href="http://dev.anything-digital.com/" target="_blank"><strong>JCal Pro <span style="color:orange">1.5</span></strong></a></div>
	 </div>
 </div>
</body>
</html>
<noscript><plaintext>
<?php
	ob_end_flush();

}

// Function to start a 'standard' table
function starttable($width = '-1', $title='', $title_colspan='1', $class = '', $date = '')
{
	global $CONFIG_EXT;

  if ($width == '-1') $width = $CONFIG_EXT['main_table_width'];
 	if ($width == '100%' ) $width = $CONFIG_EXT['main_table_width'];

	if (!empty($class)) {
	echo <<<EOT

<!-- Start standard table -->
<table align="center" width="$width" cellspacing="0" cellpadding="0" class="$class">

EOT;
	} else {
	echo <<<EOT
	
<!-- Start standard table -->
<table align="center" width="$width" cellspacing="0" cellpadding="0" class="maintable">

EOT;
	}
	
	if ($title) {
	echo <<<EOT
	<tr>
		<td class="tableh1" colspan="$title_colspan">
			<table width="100%"  border="0" cellspacing="0" cellpadding="0">
				<tr> 
					<td><h2 class="title">$title</h2></td>
EOT;
		if ($date) {
	echo <<<EOT
					<td align="right" class="today">$date</td>
EOT;
		}
	echo <<<EOT
				</tr>
			</table>
	  </td>
	</tr>

EOT;
	}
}

function endtable()
{
	echo <<<EOT
</table>
<!-- End standard table -->

EOT;
}

function theme_caption_dialog($title, $message, $menumessage = '', $width = "100%")
{
    global $template_caption_dialog;

		if($menumessage) starttable($width,$title,1,'',$menumessage);
		else starttable($width,$title);
		
		template_extract_block($template_caption_dialog, 'redirect_row');
		$params = array('{MESSAGE}' => $message);
		echo template_eval($template_caption_dialog, $params);
		endtable();
}

function theme_redirect_dialog($title, $message, $button, $redirect)
{
    global $template_caption_dialog;

		starttable('100%',$title);
		
		$params = array(
			'{MESSAGE}' => $message,
			'{BUTTON}' => $button,
			'{URL}' => $redirect
		);
		echo template_eval($template_caption_dialog, $params);
		endtable();
}

function theme_calendar_locked() {
	global $lang_system;
	theme_caption_dialog($lang_system['system_caption'], $lang_system['calendar_locked'], '',450);
}

function theme_search_form($keyword, $button)
{
    global $template_search_form, $lang_event_search_data;

		starttable('100%', $lang_event_search_data['section_title'], 1);
		$params = array(
			'{KEY_VAL}' => $keyword,
			'{KEY_DESC}' => $lang_event_search_data['search_caption'],
			'{SUBMIT}' => $button
		);
		echo template_eval($template_search_form, $params);
		endtable();
}

function theme_cat_events_list(&$results, $cat_info, $stats) {
    global $template_cat_events_list, $lang_cat_events_view, $today, $lang_date_format;
    $database = &JFactory::getDBO();

		$header1_row = template_extract_block($template_cat_events_list, 'info1_row');
		$header2_row = template_extract_block($template_cat_events_list, 'info2_row');
		$result_row = template_extract_block($template_cat_events_list, 'result_row');
		$stats_row = template_extract_block($template_cat_events_list, 'stats_row');

		$today_date = ucwords(strftime($lang_date_format['full_date'], mktime(0,0,0,$today['month'],$today['day'],$today['year'])));
		starttable('100%', sprintf($lang_cat_events_view['section_title'],$cat_info['cat_name']), 2, '', $today_date);

		$params = array(
			'{CATEGORY_INFO}' => $cat_info['cat_name'],
			'{CATEGORY_DESC}' => $cat_info['cat_desc'],
			'{NO_EVENTS}' => $lang_cat_events_view['no_events']
		);
		if($stats['total_events']) template_extract_block($header1_row, 'noevents_row');
		echo template_eval($header1_row, $params);

		if($stats['total_events']) {
			$params = array(
				'{EVENT_NAME}' => $lang_cat_events_view['event_name'],
				'{EVENT_DATE}' => $lang_cat_events_view['event_date'],
			);
			echo template_eval($header2_row, $params);
		
			foreach($results as $result){
	
				$params = array(
					'{ID}' => $result['extid'],
					'{LINK}' => $result['link'],
					'{EVENT_NAME}' => $result['title'],
					//'{EVENT_DESC}' => $result['description'],
					'{EVENT_DATE}' => $result['date']
				);				
				echo template_eval($result_row, $params);
	
			}
		}
		$stats_string = sprintf($lang_cat_events_view['stats_string1'], $stats['total_events'], 1);
		$params = array(
			'{STATS}' => $stats_string
		);
		echo template_eval($stats_row, $params);

		endtable();
		echo "<br />";
	
}

function theme_view_event(&$event, $is_popup = false) {

    global $template_event_view, $lang_event_view, $lang_general, $lang_date_format, $lang_add_event_view, $extmode, $CONFIG_EXT, $REFERER, $THEME_DIR;
    $database = &JFactory::getDBO();
    $my = &JFactory::getUser();

		$print_link = "<a href=\"Javascript://Print this Event\" title=\"Print this Event\" onClick=\"printDocument()\"><img src=\"$THEME_DIR/images/icon-print.gif\" border=\"0\" /></a>";
		$sef_href = JRoute::_( $CONFIG_EXT['calendar_calling_page']."&extmode=event&event_mode=edit&extid=".$event->extid );
		$edit_link_URL = $is_popup ? "<a href=\"Javascript://Edit Event\" onClick=\"window.opener.location.href='".$sef_href."';window.close();\" title=\"".$lang_event_view['edit_event']."\">" : "<a href=\"".$sef_href."\" title=\"".$lang_event_view['edit_event']."\">" ;
		$edit_link = has_priv('edit')?$edit_link_URL."<img src='".$CONFIG_EXT['calendar_url']."themes/default/images/icon-editevent.gif' alt='".$lang_event_view['edit_event']."' hspace='2' border='0' /></a>":"";
		$sef_href = JRoute::_( $CONFIG_EXT['calendar_calling_page']."&extmode=event&event_mode=del&extid=".$event->extid );
		$delete_link_URL = $is_popup ? "<a href=\"Javascript://Delete Event\" onClick=\"if (verify('".$lang_event_view['delete_confirm']."')) { window.opener.location.href='".$sef_href."';window.close(); }\" title=\"".$lang_event_view['delete_event']."\">" : "<a href=\"".$sef_href."\" onClick=\"return verify('".$lang_event_view['delete_confirm']."')\" title=\"".$lang_event_view['delete_event']."\">" ;
		$delete_link = has_priv('delete')?$delete_link_URL."<img src='".$CONFIG_EXT['calendar_url']."themes/default/images/icon-delevent.gif' alt='".$lang_event_view['delete_event']."' hspace='2' border='0' /></a>":"";

		$width = $is_popup?(int)$CONFIG_EXT['popup_event_width']-20:'100%';
		starttable($width, sprintf($lang_event_view['display_event'],$event->title), 2, '', $print_link.$edit_link.$delete_link );

		if(empty($event->contact) && empty($event->email) && empty($event->link) ) template_extract_block($template_event_view, 'contact_row');
		$picture = empty($event->picture)?'':"<img src='".$CONFIG_EXT['UPLOAD_DIR_URL'].$event->picture."' border='0' align='right' hspace='8' alt='' />";
		
		if($CONFIG_EXT['time_format_24hours']) 
		{
			$date_mask = $lang_date_format['full_date_time_24hour'];			
		}
		else 
		{
			$date_mask = $lang_date_format['full_date_time_12hour'];
			$ampm = date ( "A", $event->startDate );
		}
		
		$duration_array = $event->getDuration();
		$days_string = $duration_array['days']?$duration_array['days']." ".$lang_general['day']. " ":'';
		$days_string = $duration_array['days']>1?$duration_array['days']." ".$lang_general['days']. " ":$days_string;
		$hours_string = $duration_array['hours']?$duration_array['hours']." ".$lang_general['hour']. " ":'';
		$hours_string = $duration_array['hours']>1?$duration_array['hours']." ".$lang_general['hours']. " ":$hours_string;
		$minutes_string = $duration_array['minutes']?$duration_array['minutes']." ".$lang_general['minute']:'';
		$minutes_string = $duration_array['minutes']>1?$duration_array['minutes']." ".$lang_general['minutes']:$minutes_string;
		
		$sef_href = JRoute::_( $CONFIG_EXT['calendar_calling_page']."&extmode=cat&cat_id=".$event->catId );
		$cat_link_URL = $is_popup ? "href=\"Javascript://View Category\" onClick=\"window.opener.location.href='".$sef_href."';window.close();\" title=\"".$event->catName."\"" : "href='".$sef_href."'" ;

		// Does the event have a duration (or is "start date only" enabled in Settings):
		$noduration = ( ($event->end_date == '0000-00-00 00:00:00') || $CONFIG_EXT['show_only_start_times'] ) ? true : false;

		if ( !$noduration ) {
			$durationString = ($event->end_date == '0000-00-00 00:00:01') ? EXTCAL_TEXT_ALL_DAY : $days_string.$hours_string.$minutes_string;
		}
	    else { $durationString = ""; }

	    		
		$params = array(
			'{BACK_LINK}' => $is_popup?"self.close();":"location.href='".htmlentities($REFERER)."'",
			'{BACK_BUTTON}' => $is_popup?$lang_general['close']:$lang_general['back'],
			'{PICTURE}' => $picture,
			'{BG_COLOR}' => $event->color,
			'{CAT_NAME}' => $event->catName,
			'{CAT_LINK}' => $cat_link_URL,
			'{CAT_DESC}' => $event->catDesc,
			'{CATEGORY_COLOR_SPACER_IMAGE_HEIGHT}' => ($event->isRecurrent() && $CONFIG_EXT['show_recurrence_info_event_view'] && !$noduration ) ? '60' : '40',
			'{EVENT_START_DATE_LABEL}' => $lang_event_view['event_start_date'].":",
			'{EVENT_DURATION_LABEL}' => $lang_event_view['event_duration'].":",
			'{EVENT_RECURRENCE_LABEL}' => $lang_add_event_view['repeat_event_label'].":",
			'{EVENT_START_DATE}' => ucwords(strftime($date_mask, (int)$event->startDate)).($CONFIG_EXT['time_format_24hours']?'':$ampm),
			'{EVENT_DURATION}' => $durationString,
			'{EVENT_RECURRENCE}' => mf_get_recurrence_info_string($event),
			'{CONTACT_INFO_LABEL}' => $lang_event_view['contact_info'].":",
			'{CONTACT_INFO}' => $event->contact,
			'{CONTACT_EMAIL_LABEL}' => $lang_event_view['contact_email'].":",
			'{CONTACT_EMAIL}' => $event->email,
			'{CONTACT_URL_LABEL}' => $lang_event_view['contact_url'].":",
			'{CONTACT_URL}' => $event->link,
			'{CONTACT_URL_TARGET}' => $CONFIG_EXT['url_target_for_events'],
			'{EVENT_DESC}' => $event->description,
		);
		
		if ( !$event->isRecurrent() || !$CONFIG_EXT['show_recurrence_info_event_view'] ) template_extract_block($template_event_view, 'recurrence_row');
		if ( $noduration ) template_extract_block($template_event_view, 'duration_row');
		if ( $CONFIG_EXT['popup_event_mode'] && $extmode == "view" ) template_extract_block($template_event_view, 'nav_row');
		echo template_eval($template_event_view, $params);

		endtable();
		echo "<br />";
	
}

function theme_monthly_view($date, &$results, &$info_data)
{
    global $template_monthly_view, $THEME_DIR, $lang_monthly_event_view;
    global $CONFIG_EXT, $today, $lang_date_format, $lang_general, $event_icons;
    global $todayclr, $weekdayclr, $sundayclr;
	global $sundayclrHl, $weekdayclrHl, $todayclrHl;
	global $option, $Itemid_Querystring;

	$navigation_row = template_extract_block($template_monthly_view, 'navigation_row');

	$weekday_header_row = template_extract_block($template_monthly_view, 'weekday_header_row');
	$weekday_cell_row = template_extract_block($template_monthly_view, 'weekday_cell_row');
	$weekday_footer_row = template_extract_block($template_monthly_view, 'weekday_footer_row');

	$day_cell_header_row = template_extract_block($template_monthly_view, 'day_cell_header_row');
	$weeknumber_cell_row = template_extract_block($template_monthly_view, 'weeknumber_cell_row');
	if (has_priv('add')) {
			$day_cell_row = template_extract_block($template_monthly_view, 'day_cell_row');
			template_extract_block($template_monthly_view, 'day_cell_row_no_plus_sign');
	} else {
			$day_cell_row = template_extract_block($template_monthly_view, 'day_cell_row_no_plus_sign');
			template_extract_block($template_monthly_view, 'day_cell_row');
	}
	$other_month_cell_row = template_extract_block($template_monthly_view, 'other_month_cell_row');
	$day_cell_footer_row = template_extract_block($template_monthly_view, 'day_cell_footer_row');

    //  make the days of week, consisting of seven days
    $firstday = date ("w", mktime(0,0,0,$date['month'],1,$date['year']));
    if ($CONFIG_EXT['day_start']) $firstday-=1;
    //if (!$firstday && $CONFIG_EXT['day_start']) $firstday = 7; 
	$firstday = ($firstday < 0)? $firstday + 7: $firstday%7;

    // number of days in selected month
    $nr = date("t",mktime(0,0,0,$date['month'],1,$date['year']));

	$today_date = ucwords(strftime($lang_date_format['full_date'], mktime(0,0,0,$today['month'],$today['day'],$today['year'])));
    starttable('100%', $lang_monthly_event_view['section_title'], $CONFIG_EXT['cal_view_show_week']?8:7, '', $today_date);

	$params = array(
		'{PREVIOUS_MONTH}' => ucwords(strftime($lang_date_format['month_year'], mktime(0,0,0,$date['month']-1,1,$date['year']))),
		'{PREVIOUS_MONTH_URL}' => $info_data['previous_month_url'],
		'{CURRENT_MONTH}' => ucwords(strftime($lang_date_format['month_year'], mktime(0,0,0,$date['month'],1,$date['year']))),
		'{BG_COLOR}' => $info_data['current_month_color'],
		'{NEXT_MONTH}' => ucwords(strftime($lang_date_format['month_year'], mktime(0,0,0,$date['month']+1,1,$date['year']))),
		'{NEXT_MONTH_URL}' => $info_data['next_month_url'],
	);
	if(!$CONFIG_EXT['cal_view_show_week']) template_extract_block($navigation_row, 'weeknumber_row');
	if(!$info_data['show_past_months']) template_extract_block($navigation_row, 'previous_month_link_row'); 
	echo template_eval($navigation_row, $params);

    // print weekday labels
	echo $weekday_header_row;
    for ($i=0;$i<count($info_data['weekdays']);$i++)
    {
			$params = array(
				'{WEEK_DAY}' => $info_data['weekdays'][$i]['name'],
				'{CSS_CLASS}' => $info_data['weekdays'][$i]['class']
			);
			echo template_eval($weekday_cell_row, $params);
		}
		echo $weekday_footer_row;

    // print day cells
    
    for ($i=1-$firstday;$i<=count($results);$i+=7)
    {
			echo $day_cell_header_row;
			if($CONFIG_EXT['cal_view_show_week']) {
				$weeknumber_cell_row1 = str_replace('{WEEK_NUMBER}', $results[$i<1?1:$i]['week_number'], $weeknumber_cell_row);
				$week_stamp = mktime(0,0,0,$date['month'],$i + 6,$date['year']);
				$url_week_date = date("Y-m-d", $week_stamp);
				$sef_href = JRoute::_( $CONFIG_EXT['calendar_calling_page']."&extmode=week&date=".$url_week_date );
				echo str_replace('{URL_WEEK_VIEW}', $sef_href, $weeknumber_cell_row1);

			}
	    for ($row=0;$row<7;$row++)
	    {
				$day_stamp = mktime(0,0,0,$date['month'],$i + $row,$date['year']);
				$url_target_date = date("Y-m-d", $day_stamp);
				if($i+$row<1 || $i+$row> $nr) {
					$date_string = ucwords(strftime($lang_date_format['month_year'], $day_stamp));
					echo str_replace('{CELL_CONTENT}', $date_string,$other_month_cell_row);
				} else {
					$date_string = ucwords(strftime($lang_date_format['day_month_year'], $day_stamp));
		      if ($day_stamp == mktime(0,0,0,$today['month'],$today['day'],$today['year'])) {
		      	// higlight today's day
		      	$css_class = "todayclr";
		      	$hlColor = $todayclrHl; 
		      	$regColor = $todayclr; 
		      } elseif (!(int)date('w', $day_stamp)) {
		      	// use sunday colors
		      	$css_class = "sundayemptyclr";
		      	$hlColor = $sundayclrHl; 
		      	$regColor = $sundayclr; 
		      } else  { 
		      	// use regular day colors
		      	$css_class = "weekdayclr";
		      	$hlColor = $weekdayclrHl; 
		      	$regColor = $weekdayclr; 
		      }

			  $event_list = '';
			  	if ( isset ( $results[($i + $row)]['events'] ) )
			  	{
			  		$events = $results[($i + $row)]['events'];
			  	}			  
		      
		      // Initialize the event object
		      while (@is_array($events) && list(,$event_info) = each($events))
		      {

        $event = $event_info['eventdata'];
        
        $event_style = $event_info['style'];
        
        $event_icon = $event_info['icon'];
        $event_list .= "<div class='$event_style'><div class='eventstyle' style='border-bottom-color: ".$event->color."'><img src='$THEME_DIR/images/$event_icon' hspace='2' alt='' />";
        // popup or not
        
		if ($CONFIG_EXT['popup_event_mode'])
        {
          $non_sef_href = "index2.php?option=" . $option . $Itemid_Querystring ."&extmode=view&extid=".$event->extid.($event->isRecurrent()?"&recurdate=".$event->recurStartDay:'');
          $event_list .= "<a href=\"javascript:;\" onclick=\"MM_openBrWindow('".$non_sef_href."','Calendar','toolbar=no,location=no,";
          $event_list .= "status=no,menubar=no,scrollbars=yes,resizable=yes',".$CONFIG_EXT['popup_event_width'].",".$CONFIG_EXT['popup_event_height'].",false)\">";
        } else {
		  $sef_href = JRoute::_( $CONFIG_EXT['calendar_calling_page']."&extmode=view&extid=".$event->extid.($event->isRecurrent()?"&recurdate=".$event->recurStartDay:'') );
		  $event_list .= "<a href='".$sef_href."'>";
		}
				if ( $CONFIG_EXT['show_event_times_in_monthly_view'] ) {
					if ( $event->isRecurrent() ) $event_date_string = ( $event->recurStartDay == $day_stamp ) ? ' ('.mf_get_timerange($event).')' : '';
					else $event_date_string = (  mf_convert_to_timestamp($event->start_date, 'dateonly') == $day_stamp ) ? ' ('.mf_get_timerange($event).')' : '';
				} else {
					$event_date_string = '';
				}
				$title = format_text(sub_string($event->title,$CONFIG_EXT['cal_view_max_chars'],'...'),false,$CONFIG_EXT['capitalize_event_titles']).$event_date_string;

				$event_list .= $title."</a></div></div>";
					}
					
					$sef_href_1 = JRoute::_( $CONFIG_EXT['calendar_calling_page'] . "&extmode=day&date=$url_target_date" );
					$sef_href_2 = JRoute::_( $CONFIG_EXT['calendar_calling_page'] . "&extmode=event&event_mode=add&date=$url_target_date" );
					$params = array(
						'{DAY}' => $i + $row,
						'{URL_TARGET_DATE}' => $url_target_date,
						'{DAY_CLASS}' => $css_class,
						'{CELL_CONTENT}' => $event_list,
						'{BG_COLOR}' => $regColor,
						'{HOVER_BG_COLOR}' => $hlColor,
						'{DATE_STRING}' => $date_string,
						'{THEME_DIR}' => addslashes($THEME_DIR),
						'{DAY_VIEW_LINK}' => $sef_href_1,
						'{ADD_EVENT_LINK}' => $sef_href_2,
					);
					echo template_eval($day_cell_row, $params);
				}
			}
			echo $day_cell_footer_row;
		}

		display_cat_legend ($CONFIG_EXT['cal_view_show_week']?8:7, 1);
    endtable();

}

function theme_mini_cal_view($date, &$results, &$info_data)
{
    global $template_mini_cal_view, $THEME_DIR, $lang_mini_cal;
    global $CONFIG_EXT, $today, $lang_date_format, $lang_general, $event_icons, $extcal_code_insert;
    global $todayclr, $weekdayclr, $sundayclr;
		global $sundayclrHl, $weekdayclrHl, $todayclrHl; 

		$template_mini_cal_view1 = $template_mini_cal_view;
		// replace global variables
		$template_mini_cal_view1 = str_replace('{THEME_DIR}', $THEME_DIR,$template_mini_cal_view1);
		$template_mini_cal_view1 = str_replace('{TARGET}', $info_data['target'],$template_mini_cal_view1);


		$header_row = template_extract_block($template_mini_cal_view1, 'header_row');
		$navigation_row = template_extract_block($template_mini_cal_view1, 'navigation_row');
		$picture_row = template_extract_block($template_mini_cal_view1, 'picture_row');
		$footer_row = template_extract_block($template_mini_cal_view1, 'footer_row');

		$weekday_header_row = template_extract_block($template_mini_cal_view1, 'weekday_header_row');
		$weekday_cell_row = template_extract_block($template_mini_cal_view1, 'weekday_cell_row');
		$weekday_footer_row = template_extract_block($template_mini_cal_view1, 'weekday_footer_row');

		$day_cell_header_row = template_extract_block($template_mini_cal_view1, 'day_cell_header_row');
		$weeknumber_cell_row = template_extract_block($template_mini_cal_view1, 'weeknumber_cell_row');
		$day_cell_row = template_extract_block($template_mini_cal_view1, 'day_cell_row');
		$other_month_cell_row = template_extract_block($template_mini_cal_view1, 'other_month_cell_row');
		$day_cell_footer_row = template_extract_block($template_mini_cal_view1, 'day_cell_footer_row');
		$inline_style_row = template_extract_block($template_mini_cal_view1, 'inline_style_row');

    if($info_data['day_link']) template_extract_block($day_cell_row, 'static_row');
    else template_extract_block($day_cell_row, 'linkable_row');
    
    //  make the days of week, consisting of seven days
    $firstday = date ("w", mktime(0,0,0,$date['month'],1,$date['year']));
    if ($CONFIG_EXT['day_start']) $firstday-=1;
    //if (!$firstday && $CONFIG_EXT['day_start']) $firstday = 7; 
		$firstday = ($firstday < 0)? $firstday + 7: $firstday%7;

    // number of days in asked month
    $nr = date("t",mktime(0,0,0,$date['month'],1,$date['year']));

		$today_date = ucwords(strftime($lang_date_format['full_date'], mktime(0,0,0,$today['month'],$today['day'],$today['year'])));
    //starttable('100%', $lang_monthly_event_view['section_title'], $CONFIG_EXT['cal_view_show_week']?8:7, '', $today_date);
		echo $header_row;
		$params = array(
			'{PREVIOUS_MONTH}' => ucwords(strftime($lang_date_format['month_year'], mktime(0,0,0,$date['month']-1,1,$date['year']))),
			'{PREVIOUS_MONTH_URL}' => $info_data['previous_month_url'],
			'{CURRENT_MONTH}' => ucwords(strftime($lang_date_format['month_year'], mktime(0,0,0,$date['month'],1,$date['year']))),
			'{NEXT_MONTH}' => ucwords(strftime($lang_date_format['month_year'], mktime(0,0,0,$date['month']+1,1,$date['year']))),
			'{NEXT_MONTH_URL}' => $info_data['next_month_url'],
		);
		if(!$CONFIG_EXT['cal_view_show_week']) template_extract_block($navigation_row, 'weeknumber_row');
		if(!$info_data['show_past_months']) template_extract_block($navigation_row, 'previous_month_link_row'); 
		else template_extract_block($navigation_row, 'no_previous_month_link_row'); 
		if($info_data['navigation_controls']) template_extract_block($navigation_row, 'without_navigation_row');
		else template_extract_block($navigation_row, 'with_navigation_row');
		echo template_eval($navigation_row, $params);

		if(isset($info_data['picture_info'])) {
			$params = array(
				'{PICTURE_URL}' => $CONFIG_EXT['MINI_PICS_URL'].$info_data['picture_info']['picture_url'],
				'{PICTURE_MESSAGE}' => $info_data['picture_info']['picture_message'],
				'{STATUS_MESSAGE}' => ucwords(strftime($lang_date_format['month_year'], mktime(0,0,0,$date['month'],1,$date['year']))),
				'{TODAY_URL}' => $info_data['current_month_url']
			);
			
			echo template_eval($picture_row, $params);
		}
		
		//echo $weekdays_row;
		
    // print weekday labels
		echo $weekday_header_row;
    for ($i=0;$i<count($info_data['weekdays']);$i++)
    {
			$params = array(
				'{WEEK_DAY}' => $info_data['weekdays'][$i]['name'],
				'{CSS_CLASS}' => $info_data['weekdays'][$i]['class']
			);
			echo template_eval($weekday_cell_row, $params);
		}
		echo $weekday_footer_row;

   
    // print day cells
    for ($i=1-$firstday;$i<=count($results);$i+=7)
    {
			echo $day_cell_header_row;
			if($CONFIG_EXT['cal_view_show_week']) {
				$weeknumber_cell_row1 = $weeknumber_cell_row;
				$weeknumber = $results[$i<1?1:$i]['week_number'];
				$week_stamp = mktime(0,0,0,$date['month'],$i + 6,$date['year']);
				$url_week_date = date("Y-m-d", $week_stamp);
				$sef_href = JRoute::_( $CONFIG_EXT['calendar_calling_page']."&extmode=week&date=".$url_week_date );
				$params = array(
					'{URL_WEEK_VIEW}' => $sef_href,
					'{WEEK_NUMBER}' => sprintf($lang_mini_cal['selected_week'],$weeknumber)
				);
				echo template_eval( $weeknumber_cell_row1, $params);
			}
	    for ($row=0;$row<7;$row++)
	    {
				$day_stamp = mktime(0,0,0,$date['month'],$i + $row,$date['year']);
				if($i+$row<1 || $i+$row> $nr) {
					//$date_string = ucwords(strftime($lang_date_format['month_year'], $day_stamp));
					$date_string = "";
					echo str_replace('{CELL_CONTENT}', $date_string,$other_month_cell_row);
				} else {
					$url_target_date = $results[($i + $row)]['date_link'];
		      $events = $results[($i + $row)]['num_events'];
		      $num_events =  $info_data['day_link']?(int)$events:0;
					$date_string = ucwords(strftime($lang_date_format['day_month_year'], $day_stamp));
		      if ($day_stamp == mktime(0,0,0,$today['month'],$today['day'],$today['year'])) {
		      	// higlight today's day
		      	$css_class = "extcal_todaycell";
						$link_class = $num_events?"extcal_busylink":"extcal_daylink";
		      	$hlColor = $todayclrHl; 
		      	$regColor = $todayclr; 
		      } elseif (!(int)date('w', $day_stamp)) {
		      	// use sunday colors
		      	$css_class = "extcal_sundaycell";
						$link_class = $num_events?"extcal_busylink":"extcal_sundaylink";
		      	$hlColor = $sundayclrHl; 
		      	$regColor = $sundayclr; 
		      } else  { 
		      	// use regular day colors
		      	$css_class = "extcal_daycell";
						$link_class = $num_events?"extcal_busylink":"extcal_daylink";
		      	$hlColor = $weekdayclrHl; 
		      	$regColor = $weekdayclr; 
		      }


					$params = array(
						'{DAY}' => $i + $row,
						'{URL_TARGET_DATE}' => $url_target_date,
						'{DAY_CLASS}' => $css_class,
						'{DAY_LINK_CLASS}' => $link_class,
						'{CELL_CONTENT}' => sprintf($lang_mini_cal['num_events'],$num_events),
						'{BG_COLOR}' => $regColor,
						'{HOVER_BG_COLOR}' => $hlColor,
						'{DATE_STRING}' => $date_string
					);
					echo template_eval($day_cell_row, $params);
				}
			}
			echo $day_cell_footer_row;
		}
		if(!$CONFIG_EXT['add_event_view'] || !has_priv('add') ) template_extract_block($footer_row, 'add_event_row');
		$sef_href = JRoute::_( $CONFIG_EXT['calendar_calling_page'] . "&extmode=event&event_mode=add" );
		$params = array(
			'{ADD_EVENT_URL}' => $sef_href ,
			'{ADD_EVENT_TITLE}' => $lang_mini_cal['post_event']
		);
		echo template_eval($footer_row, $params);
		if(!$extcal_code_insert) {
			//$extcal_code_insert = 1;
			echo $inline_style_row;
		}
}



function theme_cats_list(&$results, $stats_string) {
    global $template_cats_list, $lang_cats_view, $today, $lang_date_format;

		$header_row = template_extract_block($template_cats_list, 'info_row');
		$result_row = template_extract_block($template_cats_list, 'result_row');
		$stats_row = template_extract_block($template_cats_list, 'stats_row');

		$today_date = ucwords(strftime($lang_date_format['full_date'], mktime(0,0,0,$today['month'],$today['day'],$today['year'])));
		starttable('100%', $lang_cats_view['section_title'], 3, '', $today_date);

		$params = array(
			'{CAT_NAME}' => $lang_cats_view['cat_name'],
			'{TOTAL_EVENTS}' => $lang_cats_view['total_events'],
			'{UPCOMING_EVENTS}' => $lang_cats_view['upcoming_events']
		);
		echo template_eval($header_row, $params);
		
		foreach($results as $result){

			$params = array(
				'{CAT_ID}' => $result['cat_id'],
				'{LINK}' => $result['link'],
				'{CAT_NAME}' => $result['cat_name'],
				'{CAT_DESC}' => $result['description'],
				'{BG_COLOR}' => $result['color'],
				'{TOTAL_EVENTS}' => $result['total_events'],
				'{UPCOMING_EVENTS}' => $result['upcoming_events']
			);
			echo template_eval($result_row, $params);

		}

		$params = array(
			'{STATS}' => $stats_string
		);
		echo template_eval($stats_row, $params);

		endtable();

}

function theme_search_results(&$results, $rows)
{
    global $template_search_results, $lang_event_search_data;
	global $CONFIG_EXT;
	
		$search_row = template_extract_block($template_search_results, 'search_row');
		$no_results_row = template_extract_block($template_search_results, 'no_results_row');
		$header_row = template_extract_block($template_search_results, 'info_row');
		$result_row = template_extract_block($template_search_results, 'result_row');
		$stats_row = template_extract_block($template_search_results, 'stats_row');

		if(count($_POST)) {
			
			starttable('100%', $lang_event_search_data['search_results'], 3);
			
			$params = array(
				'{NO_RESULTS}' => $lang_event_search_data['no_results']
			);
			if(!$rows) echo template_eval($no_results_row, $params);
			else {
	
			
				$params = array(
					'{SEARCH_RESULTS}' => sprintf($lang_event_search_data['stats_string1'],(int)$rows),
					'{CATEGORY}' => $lang_event_search_data['category_label'],
					'{DATE}' => $lang_event_search_data['date_label']
				);
				echo template_eval($header_row, $params);
				
				foreach($results as $result){
		
					$sef_href = JRoute::_( $CONFIG_EXT['calendar_calling_page'].'&extmode=cat&cat_id='.$result['cat_id'] );
					$params = array(
						'{SEARCH_TITLE}' => $result['search_title'],
						'{SEARCH_LNK}' => $result['search_link'],
						'{SEARCH_DESC}' => $result['search_desc'],
						'{CAT_ID}' => $result['cat_id'],
						'{CAT_NAME}' => $result['cat_name'],
						'{CAT_LINK}' => $sef_href,
						'{DATE}' => $result['date']
					);
					echo template_eval($result_row, $params);
		
				}
		
				$params = array(
					'{STATS}' => sprintf($lang_event_search_data['stats_string2'],(int)$rows, 1),
				);
				echo template_eval($stats_row, $params);
			}
		} else starttable('100%', $lang_event_search_data['section_title'], 3);

		$keyword = (isset($_POST["extcal_search"]) && !empty($_POST["extcal_search"])) ?$_POST["extcal_search"]:$lang_event_search_data['search_caption'];
		$button = (isset($_POST["extcal_search"]) && !empty($_POST["extcal_search"])) ?$lang_event_search_data['search_again']:$lang_event_search_data['search_button'];


		$params = array(
			'{KEY_VAL}' => $keyword,
			'{KEY_DESC}' => $lang_event_search_data['search_caption'],
			'{SUBMIT}' => $button
		);
		echo template_eval($search_row, $params);

		endtable();
		echo "<br />";
}

function theme_user_profile($target, $profile_info) {
/* Display user form */
	
	global $CONFIG_EXT, $template_user_profile_view, $THEME_DIR, $errors, $lang_user_profile_data, $lang_general;

	starttable("100%", $lang_user_profile_data['section_title'],3);
	
	$user_website = str_replace("http://","",$profile_info['user_website']);
	$user_website = !empty($user_website)?"<a href='http://".$user_website."' target='_blank'>".$user_website."</a>":"";
	
	$params = array(
		'{TARGET}' => $target,
		'{USER_ID}' => $profile_info['user_id'],
		'{PAGE_URL}' => $target,
		'{ACCOUNT_INFO_CAPTION}' => $lang_user_profile_data['account_info_label'],
		'{USER_NAME_LABEL}' => $lang_user_profile_data['user_name'],
		'{USER_NAME_VAL}' => $profile_info['username'],
		'{USER_EMAIL_LABEL}' => $lang_user_profile_data['user_email'],
		'{USER_EMAIL_VAL}' => $profile_info['email'],
		'{USER_GROUP_LABEL}' => $lang_user_profile_data['group_label'],
		'{USER_GROUP_VAL}' => $profile_info['group_name'],
		'{OTHER_DETAILS_CAPTION}' => $lang_user_profile_data['other_details_label'],
		'{USER_FNAME_LABEL}' => $lang_user_profile_data['full_name'],
		'{USER_FNAME_VAL}' => $profile_info['firstname']." ".$profile_info['lastname'],
		'{USER_WEBSITE_LABEL}' => $lang_user_profile_data['user_website'],
		'{USER_WEBSITE_VAL}' => $user_website,
		'{USER_LOCATION_LABEL}' => $lang_user_profile_data['user_location'],
		'{USER_LOCATION_VAL}' => $profile_info['user_location'],
		'{USER_OCCUPATION_LABEL}' => $lang_user_profile_data['user_occupation'],
		'{USER_OCCUPATION_VAL}' => $profile_info['user_occupation'],
		'{EDIT_PROFILE}' => $lang_user_profile_data['edit_profile']
	);

	echo template_eval($template_user_profile_view, $params);
	endtable();
}

function theme_admin_events(&$results, $rows, $section_title, $filter=0)
{
    global $CONFIG_EXT, $template_admin_events, $lang_event_admin_data, $THEME_DIR;
		
		$filter_row = template_extract_block($template_admin_events, 'filter_row');
		$noevents_row = template_extract_block($template_admin_events, 'noevents_row');
		$header_row = template_extract_block($template_admin_events, 'info_row');
		$result_row = template_extract_block($template_admin_events, 'result_row');
		$stats_row = template_extract_block($template_admin_events, 'stats_row');

		$sef_href = JRoute::_( $CONFIG_EXT['calendar_calling_page'] . "&extmode=add" );
		starttable("100%",$section_title,5,"", "<img src='".$THEME_DIR."/images/icon-add.gif' style='vertical-align: middle' hspace='4' /><a href='".$sef_href."'>".$lang_event_admin_data['add_event']."</a>");
		// generate filter options for event list select menu
		$event_filter_options = '';
		for ($i = 0;$i<sizeof($lang_event_admin_data['events_filter_options']);$i++)
		{
			$selected = ($filter==$i)?"selected":"";
			$event_filter_options .= "\t<option value='$i' $selected>".$lang_event_admin_data['events_filter_options'][$i]."</option>\n";
		}
		$sef_href = JRoute::_( $CONFIG_EXT['calendar_calling_page'].'&extmode=event' );
		$params = array(
			'{FILTER_LINK}' => $sef_href,
			'{EVENTS_FILTER_LABEL}' => $lang_event_admin_data['events_filter_label'],
			'{EVENTS_FILTER_OPTIONS}' => $event_filter_options
		);
		echo template_eval($filter_row, $params);

		$params = array(
			'{NO_EVENTS}' => $lang_event_admin_data['no_events']
		);
		if(!$rows) echo template_eval($noevents_row, $params);
		else {

			$params = array(
				'{EVENT_STAT}' => sprintf($lang_event_admin_data['stats_string1'],$rows),
				'{DATE}' => $lang_event_admin_data['date_label'],
				'{ACTION}' => $lang_event_admin_data['actions_label']
			);
			echo template_eval($header_row, $params);
	
			foreach($results as $result){
				$result_row1 = $result_row;
				$recur_ext = $result['event_recur_type']?"recur-":"";
				$status_icon = $result['event_status']?$THEME_DIR."/images/icon-".$recur_ext."
					event-active.gif":$THEME_DIR."/images/icon-".$recur_ext."event-inactive.gif";
				$params = array(
					'{EVENT_ID}' => $result['event_id'],
					'{EVENT_TITLE}' => $result['event_title'],
					'{EVENT_LNK}' => $result['event_link'],
					'{EVENT_DESC}' => $result['event_desc'],
					'{ADMIN_EDIT_EVENT_LINK}' => JRoute::_( $CONFIG_EXT['calendar_calling_page']."&extmode=event&event_mode=edit&extid=".$result['event_id'] ),
					'{ADMIN_APPROVE_EVENT_LINK}' => JRoute::_( $CONFIG_EXT['calendar_calling_page']."&extmode=event&event_mode=apr&extid=".$result['event_id'] ),
					'{ADMIN_DELETE_EVENT_LINK}' => JRoute::_( $CONFIG_EXT['calendar_calling_page']."&extmode=event&event_mode=del&extid=".$result['event_id'] ),
					'{STATUS}' => $result['event_status']?addslashes($lang_event_admin_data['active_label']):addslashes($lang_event_admin_data['not_active_label']),

					'{STATUS_ICON}' => $status_icon, 
					'{PICTURE}' => $result['event_picture']?"<img 
					src='".$THEME_DIR."/images/icon-photo.gif' 
					alt='".addslashes($lang_event_admin_data['picture_attached'])."' />":"", 
					'{CAT_ID}' => $result['cat_id'], '{CAT_NAME}' => $result['cat_name'], 
					'{BG_COLOR}' => $result['color'], '{DATE}' => $result['date'], 
					'{EDIT}' => $lang_event_admin_data['edit_event'], '{APPROVE}' => 
					$lang_event_admin_data['auto_approve'], '{DELETE}' => 
					$lang_event_admin_data['delete_event'], '{DEL_MSG}' => 
					$lang_event_admin_data['delete_confirm']
					); 
					if($result['event_status']) template_extract_block($result_row1, 'approve_row');
					echo template_eval($result_row1, $params);
	
			}

		}	
		
		$params = array(
			'{STATS}' => sprintf($lang_event_admin_data['stats_string2'],$rows,1)
		);
		echo template_eval($stats_row, $params);

		endtable();
		echo "<br />";
}

function theme_admin_cats(&$results, $stats)
{
    global $template_admin_cats, $THEME_DIR, $lang_cat_admin_data;

		$header_row = template_extract_block($template_admin_cats, 'info_row');
		$result_row = template_extract_block($template_admin_cats, 'result_row');
		$stats_row = template_extract_block($template_admin_cats, 'stats_row');

		$sef_href = JRoute::_( $CONFIG_EXT['calendar_calling_page']."&extmode=add" );
		starttable("100%",$lang_cat_admin_data['section_title'],5,"","<img src='".$THEME_DIR."/images/icon-add.gif' style='vertical-align: middle' hspace='4' /><a href='".$sef_href."'>".$lang_cat_admin_data['add_cat']."</a>");

		$params = array(
			'{CATS_STAT}' => sprintf($lang_cat_admin_data['stats_string1'],$stats['total_cats']),
			'{EVENTS}' => $lang_cat_admin_data['events_label'],
			'{STATUS}' => $lang_cat_admin_data['status_label'],
			'{VISIBILITY}' => $lang_cat_admin_data['visibility'],
			'{ACTION}' => $lang_cat_admin_data['actions_label']
		);
		echo template_eval($header_row, $params);

		foreach($results as $result){
			
			//$auto_approve_list = ($result['options']& 1)?$lang_cat_admin_data['users_label']:"";
			//$comma = empty($auto_approve_list)?"":", ";
			//$auto_approve_list .= ($result['options']& 2)?$comma.$lang_cat_admin_data['admins_label']:"";
			
			$params = array(
				'{BG_COLOR}' => $result['color'],
				'{CAT_ID}' => $result['cat_id'],
				'{CAT_LNK}' => $result['cat_link'],
				'{CAT_NAME}' => $result['cat_name'],
				'{CAT_DESC}' => $result['cat_desc'],
				'{PICTURE}' => $result['status']?"<img src='".$THEME_DIR."/images/icon-cat-active.gif' alt='".addslashes($lang_cat_admin_data['active_label'])."' />":"<img src='".$THEME_DIR."/images/icon-cat-inactive.gif' alt='".addslashes($lang_cat_admin_data['not_active_label'])."' />",
				'{VISIBILITY}' => $lang_cat_admin_data['visibility'],
				'{EDIT}' => $lang_cat_admin_data['edit_cat'],
				'{DELETE}' => $lang_cat_admin_data['delete_cat'],
				'{DEL_MSG}' => $lang_cat_admin_data['delete_confirm']
			);
			echo template_eval($result_row, $params);

		}
		
		$stats_string = sprintf($lang_cat_admin_data['stats_string2'],$stats['active_cats'], $stats['total_cats'], 1);
		
		$params = array(
			'{STATS}' => $stats_string
		);
		echo template_eval($stats_row, $params);

		endtable();
		echo "<br />";
}

function theme_admin_view_event(&$result, $is_popup = false) {

    global $template_event_view, $lang_event_admin_data, $lang_general, $lang_date_format, $CONFIG_EXT, $REFERER, $THEME_DIR;
	global $lang_add_event_view;
    $database = &JFactory::getDBO();
    $my = &JFactory::getUser();
	
		$print_link = $CONFIG_EXT['popup_event_mode']?"<a href=\"Javascript://Print this Event\" title=\"Print this Event\" onClick=\"printDocument()\"><img src=\"$THEME_DIR/images/icon-print.gif\" border=\"0\" /></a>":"";
		$sef_href = JRoute::_( $CONFIG_EXT['calendar_calling_page']."&extmode=event&event_mode=del&extid=".$result['extid'] );
		$delete_link = has_priv("delete")?"<a href='".$sef_href."' onClick=\"return verify('".$lang_event_admin_data['delete_confirm']."')\"><img src='".$CONFIG_EXT['calendar_url']."themes/default/images/icon-delevent.gif' alt='".$lang_event_admin_data['delete_event']."' hspace='2' border='0' /></a>":"";
		$sef_href = JRoute::_( $CONFIG_EXT['calendar_calling_page']."&extmode=event&event_mode=edit&extid=".$result['extid'] );
		$edit_link = has_priv("edit")?"<a href='".$sef_href."'><img src='".$CONFIG_EXT['calendar_url']."themes/default/images/icon-editevent.gif' alt='".$lang_event_admin_data['edit_event']."' hspace='2' border='0' /></a>":"";
		starttable('100%', sprintf($lang_event_admin_data['view_event_name'],$result['title']), 2, '', $print_link.$edit_link.$delete_link );

		if( empty($result['contact']) && empty($result['email']) && empty($result['url']) ) template_extract_block($template_event_view, 'contact_row');
		$picture = empty($result['picture'])?'':"<img src='".$CONFIG_EXT['UPLOAD_DIR_URL'].$result['picture']."' border='0' align='right' hspace='8' />";
		
		if($CONFIG_EXT['time_format_24hours']) $date_mask = $lang_date_format['full_date_time_24hour'];
		else $date_mask = $lang_date_format['full_date_time_12hour'];

		$duration_array = datestoduration ($result['start_date'],$result['end_date']);
		$days_string = $duration_array['days']?$duration_array['days']." ".$lang_general['day']. " ":'';
		$days_string = $duration_array['days']>1?$duration_array['days']." ".$lang_general['days']. " ":$days_string;
		$hours_string = $duration_array['hours']?$duration_array['hours']." ".$lang_general['hour']. " ":'';
		$hours_string = $duration_array['hours']>1?$duration_array['hours']." ".$lang_general['hours']. " ":$hours_string;
		$minutes_string = $duration_array['minutes']?$duration_array['minutes']." ".$lang_general['minute']:'';
		$minutes_string = $duration_array['minutes']>1?$duration_array['minutes']." ".$lang_general['minutes']:$minutes_string;
		
		$sef_href = JRoute::_( $CONFIG_EXT['calendar_calling_page'] . "&extmode=cat&cat_id=".$result['cat'] );
		
		// $result is an associative array, the mf_get_recurrence_info_string expects an object
		// this is a temporary hack, when someone re-writes this, a more correct fix can be made
		foreach ($result as $ar_key => $ar_value) {
			$event->{$ar_key} = $ar_value;
		}

		$params = array(
			'{BACK_LINK}' => $is_popup?"self.close();":"location.href='".$REFERER."'",
			'{BACK_BUTTON}' => $is_popup?$lang_general['close']:$lang_general['back'],
			'{PICTURE}' => $picture,
			'{BG_COLOR}' => $result['color'],
			'{CAT_NAME}' => $result['cat_name'],
			'{CAT_LINK}' => "href='".$sef_href."'",
			'{CAT_DESC}' => $result['cat_desc'],
			'{EVENT_START_DATE_LABEL}' => $lang_event_admin_data['event_start_date'].":",
			'{EVENT_DURATION_LABEL}' => $lang_event_admin_data['event_duration'].":",
			'{EVENT_START_DATE}' => ucwords(strftime($date_mask, strtotime($result['start_date'])). ' ' . date ( "A", strtotime($result->startDate) )),
			'{EVENT_DURATION}' => $days_string.$hours_string.$minutes_string,
			'{CONTACT_INFO_LABEL}' => $lang_event_admin_data['contact_info'].":",
			'{CONTACT_INFO}' => $result['contact'],
			'{CONTACT_EMAIL_LABEL}' => $lang_event_admin_data['contact_email'].":",
			'{CONTACT_EMAIL}' => $result['email'],
			'{CONTACT_URL_LABEL}' => $lang_event_admin_data['contact_url'].":",
			'{CONTACT_URL}' => $result['link'],
			'{EVENT_DESC}' => $result['description'],
			'{EVENT_RECURRENCE_LABEL}' => $lang_add_event_view['repeat_event_label'].":",
			'{EVENT_RECURRENCE}' => mf_get_recurrence_info_string($event),
		);
		echo template_eval($template_event_view, $params);

		endtable();
		echo "<br />";
	
}

function theme_main_menu()
{
	global $CONFIG_EXT, $REFERER, $HTTP_SERVER_VARS;
	global $template_main_menu, $lang_main_menu;

	static $main_menu = '';

	// if ($main_menu != '') return $main_menu;

	$template_main_menu1 = '
		<table width="100%" cellpadding="10" cellspacing="0" border="0" bgcolor="#FFFFFF">
		 <tr>
		  <td class="tableh1" align="center">
		  '. $template_main_menu .'
		  </td>
		 </tr>
		</table>
		  ';

	if ((!$CONFIG_EXT['add_event_view'] || !has_priv('add'))) template_extract_block($template_main_menu1, 'add_event');
	if (!$CONFIG_EXT['cats_view']) template_extract_block($template_main_menu1, 'cat_view');
	if (!$CONFIG_EXT['daily_view']) template_extract_block($template_main_menu1, 'daily_view');
	if (!$CONFIG_EXT['weekly_view']) template_extract_block($template_main_menu1, 'weekly_view');
	if (!$CONFIG_EXT['monthly_view']) template_extract_block($template_main_menu1, 'monthly_view');
	if (!$CONFIG_EXT['flyer_view']) template_extract_block($template_main_menu1, 'flyer_view');
	if (!$CONFIG_EXT['search_view']) template_extract_block($template_main_menu1, 'search_view');

	$param = array(
		'{URL}' => $CONFIG_EXT['calendar_url'],
		'{ADD_EVENT_TGT}' => JRoute::_( $CONFIG_EXT['calendar_calling_page']."&extmode=event&event_mode=add" ),
		'{ADD_EVENT_LNK}' => $lang_main_menu['add_event'],
		'{CAL_VIEW_TGT}' => JRoute::_($CONFIG_EXT['calendar_calling_page']."&extmode=cal" ),
		'{CAL_VIEW_LNK}' => $lang_main_menu['cal_view'],
		'{FLYER_VIEW_TGT}' => JRoute::_($CONFIG_EXT['calendar_calling_page']."&extmode=flat" ),
		'{FLYER_VIEW_LNK}' => $lang_main_menu['flat_view'],
		'{WEEKVIEW_TGT}'=> JRoute::_($CONFIG_EXT['calendar_calling_page']."&extmode=week" ),
		'{WEEKVIEW_LNK}'=> $lang_main_menu['weekly_view'],
		'{DAYVIEW_TGT}' => JRoute::_($CONFIG_EXT['calendar_calling_page']."&extmode=day" ),
		'{DAYVIEW_LNK}' => $lang_main_menu['daily_view'],
		'{CAT_VIEW_TGT}'=> JRoute::_($CONFIG_EXT['calendar_calling_page']."&extmode=cats" ),
		'{CAT_VIEW_LNK}'=> $lang_main_menu['categories_view'],
		'{SEARCH_TGT}'=> JRoute::_($CONFIG_EXT['calendar_calling_page']."&extmode=extcal_search" ),
		'{SEARCH_LNK}'=> $lang_main_menu['search_view']
	);

	$main_menu = template_eval($template_main_menu1, $param);
	return $main_menu;
}

?>