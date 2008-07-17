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

$File: index.php - language file$

Revision date: 02/20/2007

**********************************************
Get the latest version of JCal Pro at:
http://dev.anything-digital.com//
**********************************************
*/

/** ensure this file is being included by a parent file */
defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );

// New language structure
$lang_info = array (
	'name' => 'Thai'
	,'nativename' => 'Thai' // Language name in native language. E.g: 'Fran�ais' for 'French'
	,'locale' => array('th','thai') // Standard locale alternatives for a specific language. For reference, go to: http://www.php.net/manual/en/function.setlocale.php
	,'charset' => 'TIS-620' // For reference, go to : http://www.w3.org/International/O-charset-lang.html
	,'direction' => 'ltr' // 'ltr' for Left to Right. 'rtl' for Right to Left languages such as Arabic.
	,'author' => 'Mohamed Moujami (Simo)' 
	,'author_email' => 'simoami@hotmail.com' 
	,'author_url' => 'http://www.MarocTour.com'
	,'transdate' => '05/15/2005' // Translate by Chaisilp Panawiwatn => chaisilp@hotmail.com
);

$lang_general = array (
	'yes' => '��'
	,'no' => '�����'
	,'back' => '��Ѻ'
	,'continue' => '�ӵ��'
	,'close' => '�Դ'
	,'errors' => '�Դ��Ҵ'
	,'info' => '��������´'
	,'day' => '�ѹ'
	,'days' => '�ѹ'
	,'month' => '��͹'
	,'months' => '��͹'
	,'year' => '��'
	,'years' => '��'
	,'hour' => '�������'
	,'hours' => '�������'
	,'minute' => '�ҷ�'
	,'minutes' => '�ҷ�'
	,'everyday' => '�ء��ѹ'
	,'everymonth' => '�ء���͹'
	,'everyyear' => '�ء��'
	,'active' => '�ʴ�'
	,'not_active' => '����ʴ�'
	,'today' => '�ѹ���'
	,'signature' => 'Powered by %s'
	,'expand' => '����'
	,'collapse' => '�Դ'
);

// Date formats, For reference, go to : http://www.php.net/manual/en/function.strftime.php
$lang_date_format = array (
	'full_date' => '�ѹ%A��� %d %B %Y' // e.g. Wednesday, June 05, 2002
	,'full_date_time_24hour' => '�ѹ%A��� %d %B %Y ���� %H:%M' // e.g. Wednesday, June 05, 2002 At 21:05
	,'full_date_time_12hour' => '�ѹ%A��� %d %B %Y ���� %I:%M %p' // e.g. Wednesday, June 05, 2002 At 9:05 pm
	,'day_month_year' => '%d-%b-%Y' // e.g 10-Sep-2004
	,'local_date' => '%c' // Preferred date and time representation for current language 
	,'mini_date' => '%a %d %b %Y' 
	,'month_year' => '%B %Y'
	,'day_of_week' => array('�','�','�','�','�','�','�')
	,'months' => array('���Ҥ�','����Ҿѹ��','�չҤ�','����¹','����Ҥ�','�Զع�¹','�á�Ҥ�','�ԧ�Ҥ�','�ѹ��¹','���Ҥ�','��Ȩԡ�¹','�ѹ�Ҥ�')
);

$lang_system = array (
	'system_caption' => '��ͤ����к�'
	,'page_access_denied' => '�س������Է���㹡�������ҹ���'
	,'page_requires_login' => '�س��ͧ�������к���͹'
	,'operation_denied' => '�س������Է���㹡�������ҹ���'
	,'section_disabled' => 'section �Դ !'
	,'non_exist_cat' => '�ѧ�������Ǵ�Ԩ������� !'
	,'non_exist_event' => '�ѧ����աԨ������� !'
	,'param_missing' => '���������١��ͧ'
	,'no_events' => '�������¡�áԨ����'
	,'config_string' => '�س�� \'%s\' �� %s, %s ��� %s.'
	,'no_table' => '����յ��ҧ \'%s\' !'
	,'no_anonymous_group' => '���ҧ %s ���ç�Ѻ����� \'Anonymous\' !'
	,'calendar_locked' => '������ �Դ��ҹ���Ǥ��� !'
	,'new_upgrade' => '�к���Ǩ������������� ������ "Continue" ���ͷӡ���Ѿ�ô'
	,'no_profile' => '����ͼԴ��Ҵ������¡�����Ż���ѵԢͧ�س'
	,'unknown_component' => '������ѡ�����鹷�'
// Mail messages
	,'new_event_subject' => '�׹�ѹ��¡�áԨ���� : %s'
	,'event_notification_failed' => '����ͼԴ��Ҵ㹡���������� !'
);

// Message body for new event email notification
$lang_system['event_notification_body'] = <<<EOT
��¡�áԨ�������˹����� {CALENDAR_NAME}
��е�ͧ��á���׹�ѹ :

��Ǣ��: "{TITLE}"
�ѹ���: "{DATE}"
��ǧ����: "{DURATION}"

�س����ö�Ѵ��áԨ��������¡�ä�����ꧤ��ҹ��ҧ ���� copy ��Դ㹺���������

{LINK}

(�����˵� �س��ͧ�������к���͹�֧�д��Թ�����)

���ʴ������Ѻ���

�������èѴ��� {CALENDAR_NAME}

EOT;

// Admin menu entries
$lang_admin_menu = array (
	'login' => '�������к�'
	,'register' => 'ŧ����¹'
  ,'logout' => '�͡�ҡ�к� <span style="color:#FF9922">[<span style="color:#606F79">%s</span>]</span>'
  ,'user_profile' => '����ѵ���ǹ���'
	,'admin_events' => '�Ԩ����'
  ,'admin_categories' => '��Ǵ'
  ,'admin_groups' => '�����'
  ,'admin_users' => '�����ҹ'
  ,'admin_settings' => '��駤��'
);

// Main menu entries
$lang_main_menu = array (
	'add_event' => '�����Ԩ����'
	,'cal_view' => '�����͹'
  ,'flat_view' => '����ӴѺ'
  ,'weekly_view' => '����ѻ����'
  ,'daily_view' => '����ѹ'
  ,'yearly_view' => '��»�'
  ,'categories_view' => '��Ǵ�Ԩ����'
  ,'search_view' => '����'
);

// ======================================================
// Add Event view
// ======================================================

$lang_add_event_view = array(
	'section_title' => '�����Ԩ����'
	,'edit_event' => '��䢡Ԩ���� [id%d] \'%s\''
	,'update_event_button' => '��Ѻ��ا�Ԩ����'

// Event details
	,'event_details_label' => '��������´'
	,'event_title' => '��Ǣ�͡Ԩ����'
	,'event_desc' => '��������´'
	,'event_cat' => '��Ǵ'
	,'choose_cat' => '���͡'
	,'event_date' => '��ǧ����'
	,'day_label' => '�ѹ'
	,'month_label' => '��͹'
	,'year_label' => '��'
	,'start_date_label' => '�ѹ����������'
	,'start_time_label' => '����'
	,'end_date_label' => '��������'
	,'all_day_label' => '��ʹ�ѹ'
// Contact details
	,'contact_details_label' => '��������´���Դ���'
	,'contact_info' => '��������´��õԴ���'
	,'contact_email' => '������'
	,'contact_url' => '���䫵�'
// Repeat events
	,'repeat_event_label' => '�Ԩ����������ͧ'
	,'repeat_method_label' => '�Ըա���ʴ�'
	,'repeat_none' => '����ͧ�ʴ��Ԩ����������ͧ'
	,'repeat_every' => '�ʴ���ӷء�'
	,'repeat_days' => '�ѹ'
	,'repeat_weeks' => '�ѻ����'
	,'repeat_months' => '��͹'
	,'repeat_years' => '��'
	,'repeat_end_date_label' => '�ʴ��ѹ����ش�Ԩ����'
	,'repeat_end_date_none' => '����˹��ѹ����ش�Ԩ����'
	,'repeat_end_date_count' => '����ش��ѧ�ҡ %s �Ԩ����'
	,'repeat_end_date_until' => '�ʴ���Ө��֧�ѹ���'
// Other details
	,'other_details_label' => '��������´����'
	,'picture_file' => '����ٻ�Ҿ'
	,'file_upload_info' => '(����Թ %d Kb - ੾�� : %s )' 
	,'del_picture' => 'ź�Ҿ�Ѩ�غѹ ?'
// Administrative options
	,'admin_options_label' => '��ǹ�ͧ�������к�'
	,'auto_appr_event' => '�׹�ѹ�Ԩ����'

// Error messages
	,'no_title' => '�ѧ������к���Ǣ�͡Ԩ���� !'
	,'no_desc' => '�ѧ������к���������´ !'
	,'no_cat' => '�ѧ��������͡��Ǵ�Ԩ���� !'
	,'date_invalid' => '�к��ѹ������١��ͧ !'
	,'end_days_invalid' => '�кؤ���ѹ���١��ͧ !'
	,'end_hours_invalid' => '�кؤ�Ҫ���������١��ͧ !'
	,'end_minutes_invalid' => '�кؤ�ҹҷ����١��ͧ !'
	,'non_valid_extension' => '�ٻẺ����ٻ�Ҿ���١��ͧ ! (੾��: %s ��ҹ��)'
	,'file_too_large' => '��Ҵ�ٻ�Ҿ�˭��Թ %d Kb !'
	,'move_image_failed' => '�к��������ö�ӡ���Ѿ��Ŵ�ٻ�Ҿ�� ��سҵ�Ǩ�ͺ��Ҵ�ٻ�Ҿ �����駼������к�'
	,'non_valid_dimensions' => '�������ҧ���ͤ����٧�˭��Թ %s �ԡ�� !'
	,'recur_val_1_invalid' => '�кؤ�����١��ͧ ��ͧ�кؤ�ҷ���ҡ���� \'0\' !'
	,'recur_end_count_invalid' => '�кؤ�����١��ͧ ��ͧ�кؤ�ҷ���ҡ���� \'0\' !'
	,'recur_end_until_invalid' => '�ѹ���㹡Ԩ����������ͧ��ͧ�ҡ�����ѹ���������鹡Ԩ���� !'
// Misc. messages
	,'submit_event_pending' => '���Ѻ�Ԩ�����ͧ��ҹ ����ѧ����ʴ�㹻�ԷԹ�����Ҩ����Ѻ���͹��ѵԨҡ�������к�!'
	,'submit_event_approved' => '�Ԩ�����ͧ�س���Ѻ���͹��ѵ����� �ͺ�س��������Ԩ����!'
	,'event_repeat_msg' => '�Ԩ����������˹�����繡Ԩ����������ͧ'
	,'event_no_repeat_msg' => '�Ԩ��������������ö������ͧ��'
);

// ======================================================
// daily view
// ======================================================

$lang_daily_event_view = array(
	'section_title' => '�ʴ�Ẻ����ѹ'
	,'next_day' => '�ѹ�Ѵ�'
	,'previous_day' => '�ѹ��͹˹��'
	,'no_events' => '����աԨ������ѹ���'
);

// ======================================================
// weekly view
// ======================================================

$lang_weekly_event_view = array(
	'section_title' => '�ʴ�Ẻ����ѻ����'
	,'week_period' => '%s - %s'
	,'next_week' => '�ѻ����Ѵ�'
	,'previous_week' => '�ѻ����������'
	,'selected_week' => '�ѻ������ %d'
	,'no_events' => '����աԨ������ѻ������'
);

// ======================================================
// monthly view
// ======================================================

$lang_monthly_event_view = array(
	'section_title' => '�ʴ�Ẻ�����͹'
	,'next_month' => '��͹�Ѵ�'
	,'previous_month' => '��͹�������'
);

// ======================================================
// flat view
// ======================================================

$lang_flat_event_view = array(
	'section_title' => '�ʴ�Ẻ����ӴѺ'
	,'week_period' => '%s - %s'
	,'next_month' => '��͹�Ѵ�'
	,'previous_month' => '��͹�������'
	,'contact_info' => '��������´��õԴ���'
	,'contact_email' => '������'
	,'contact_url' => '���䫵�'
	,'no_events' => '����աԨ��������Ѻ��͹���'
);

// ======================================================
// Event view
// ======================================================

$lang_event_view = array(
	'section_title' => '�ʴ���¡�áԨ����'
	,'display_event' => '�Ԩ����: \'%s\''
	,'cat_name' => '��Ǵ'
	,'event_start_date' => '������ѹ���'
	,'event_end_date' => '�֧�ѹ���'
	,'event_duration' => '��ǧ����'
	,'contact_info' => '��������´��õԴ���'
	,'contact_email' => '������'
	,'contact_url' => '���䫵�'
	,'no_event' => '�������¡�áԨ����'
	,'stats_string' => '��������� <strong>%d</strong> �Ԩ����'
	,'edit_event' => '��䢡Ԩ����'
	,'delete_event' => 'ź�Ԩ����'
	,'delete_confirm' => '��ͧ���ź�Ԩ����������� ?'
	
);

// ======================================================
// Categories view
// ======================================================

$lang_cats_view = array(
	'section_title' => '�ʴ���Ǵ�Ԩ����'
	,'cat_name' => '������Ǵ'
	,'total_events' => '�Ԩ����������'
	,'upcoming_events' => '�Ԩ���������Ҷ֧'
	,'no_cats' => '�������Ǵ�Ԩ����'
	,'stats_string' => '�ըӹǹ <strong>%d</strong> �Ԩ���� � <strong>%d</strong> ��Ǵ'
);

// ======================================================
// Category Events view
// ======================================================

$lang_cat_events_view = array(
	'section_title' => '�Ԩ��������� \'%s\''
	,'event_name' => '���͡Ԩ����'
	,'event_date' => '�ѹ���'
	,'no_events' => '����աԨ�������Ǵ���'
	,'stats_string' => '��������� <strong>%d</strong> �Ԩ����'
	,'stats_string1' => '<strong>%d</strong> �Ԩ���� � <strong>%d</strong> ˹��'
);

// ======================================================
// cal_search.php
// ======================================================

$lang_event_search_data = array(
	'section_title' => '���ҡԨ����',
	'search_results' => '�š�ä���',
	'category_label' => '��Ǵ',
	'date_label' => '�ѹ���',
	'no_events' => '����աԨ�������Ǵ���',
	'search_caption' => '�кؤӷ�����...',
	'search_again' => '�����ա����',
	'search_button' => '����',
// Misc.
	'no_results' => '��辺��¡�÷�����',	
// Stats
	'stats_string1' => '�鹾� <strong>%d</strong> �Ԩ����',
	'stats_string2' => '<strong>%d</strong> �Ԩ���� � <strong>%d</strong> ˹��'
);

// ======================================================
// profile.php
// ======================================================

if (defined('PROFILE_PHP')) 

$lang_user_profile_data = array(
	'section_title' => '����ѵ���ǹ���',
	'edit_profile' => '��䢻���ѵ���ǹ���',
	'update_profile' => '��Ѻ��ا����ѵ���ǹ���',
	'actions_label' => 'Actions',
// Account Info
	'account_info_label' => '��������´�ѭ�ռ����ҹ',
	'user_name' => '���ͼ����ҹ',
	'user_pass' => '���ʼ�ҹ',
	'user_pass_confirm' => '�׹�ѹ���ʼ�ҹ',
	'user_email' => '����������ҹ',
	'group_label' => '��Ҫԡ�����',
// Other Details
	'other_details_label' => '��������´����',
	'first_name' => '����',
	'last_name' => '���ʡ��',
	'full_name' => '�������',
	'user_website' => '���䫵�',
	'user_location' => '�������',
	'user_occupation' => '�Ҫվ',
// Misc.
	'select_language' => '���͡����',
	'edit_profile_success' => '��Ѻ��ا����ѵ���ǹ������º��������',
	'update_pass_info' => '�ҡ����ͧ���������ʼ�ҹ ��������ҧ���',
// Error messages
	'invalid_password' => '��س�������ʼ�ҹ�繵���ѡ����е���Ţ 4 �֧ 16 ����ѡ�� !',
	'password_is_username' => '���ʼ�ҹ��ͧ����ӡѺ���ͼ����ҹ !',
	'password_not_match' =>'���ʼ�ҹ���ç�ѹ�Ѻ \'�׹�ѹ���ʼ�ҹ\'',
	'invalid_email' => '��ͧ�к����������١��ͧ !',
	'email_exists' => '���������ռ����ҹ�������� ��س����͡���������� !',
	'no_email' => '��ͧ�к������� !',
	'invalid_email' => '��ͧ�к����������١��ͧ !',
	'no_password' => '��ͧ�к����ʼ�ҹ !'
);

// ======================================================
// register.php
// ======================================================

if (defined('USER_REGISTRATION_PHP')) 

$lang_user_registration_data = array(
	'section_title' => 'ŧ����¹�����ҹ',
// Step 1: Terms & Conditions
	'terms_caption' => 'Terms and Conditions',
	'terms_intro' => 'In order to proceed, you must agree to the following:',
	'terms_message' => 'Please take a moment to review these rules detailed below. If you agree with them and wish to proceed with the registration, simply click the "I agree" button below. To cancel this registration, simply hit the \'back\' button on your browser.<br /><br />Please remember that we are not responsible for any events posted by users of this calendar application. We do not vouch for or warrant the accuracy, completeness or usefulness of any posted event, and are not responsible for the contents of any event.<br /><br />The messages express the views of the author of the event, not necessarily the views of this calendar application. Any user who feels that a posted event is objectionable is encouraged to contact us immediately by email. We have the ability to remove objectionable content and we will make every effort to do so, within a reasonable time frame, if we determine that removal is necessary.<br /><br />You agree, through your use of this service, that you will not use this calendar application to post any material which is knowingly false and/or defamatory, inaccurate, abusive, vulgar, hateful, harassing, obscene, profane, sexually oriented, threatening, invasive of a person\'s privacy, or otherwise violative of any law.<br /><br />You agree not to post any copyrighted material unless the copyright is owned by you or by %s.',
	'terms_button' => '����Ѻ',
	
// Account Info
	'account_info_label' => '��������´�ѭ�ռ����ҹ',
	'user_name' => '���ͼ����ҹ',
	'user_pass' => '���ʼ�ҹ',
	'user_pass_confirm' => '�׹�ѹ���ʼ�ҹ',
	'user_email' => '������',
// Other Details
	'other_details_label' => '��������´����',
	'first_name' => '����',
	'last_name' => '���ʡ��',
	'user_website' => '���䫵�',
	'user_location' => '�������',
	'user_occupation' => '�Ҫվ',
	'register_button' => 'ŧ����¹',

// Stats
	'stats_string1' => '<strong>%d</strong> �����ҹ',
	'stats_string2' => '<strong>%d</strong> �����ҹ �ӹǹ <strong>%d</strong> ˹��',
// Misc.
	'reg_nomail_success' => '�ͺ�س',
	'reg_mail_success' => '��������´����׹�ѹ���ŧ����¹�������ҧ��������س�к�����',
	'reg_activation_success' => '�س��ŧ����¹���º�������� �س����ö�������к����ª���������ʼ�ҹ�ͧ�س',
// Mail messages
	'reg_confirm_subject' => '�׹�ѹ���ŧ����¹ %s',
	
// Error messages
	'no_username' => '��ͧ�кت��ͼ����ҹ !',
	'invalid_username' => '�ô�кت�����੾�е���ѡ�����͵���Ţ �ӹǹ 4 �֧ 30 ����ѡ�� !',
	'username_exists' => '��ժ��ͼ����ҹ����������� ��س��кت������ !',
	'no_password' => '��ͧ�к����ʼ�ҹ !',
	'invalid_password' => '��س�������ʼ�ҹ�繵���ѡ����е���Ţ 4 �֧ 16 ����ѡ�� !',
	'password_is_username' => '���ʼ�ҹ��ͧ����ӡѺ���ͼ����ҹ !',
	'password_not_match' =>'���ʼ�ҹ���ç�ѹ�Ѻ \'�׹�ѹ���ʼ�ҹ\'',
	'no_email' => '��ͧ�к������� !',
	'invalid_email' => '��ͧ�к����������١��ͧ !',
	'email_exists' => '���������ռ����ҹ�������� ��س����͡���������� !',
	'delete_user_failed' => '�������öź�ѭ�ռ����ҹ���',
	'no_users' => '�������¡�ü����ҹ !',
	'already_logged' => '�س�������к����� !',
	'registration_not_allowed' => '�ЧѺ�����ҹ�к�ŧ����¹ !',
	'reg_email_failed' => '����ͼԴ��Ҵ㹡���������� !',
	'reg_activation_failed' => '����ͼԴ��Ҵ㹡�÷���¡�ù�� !'
);
// Message body for email activation
$lang_user_registration_data['reg_confirm_body'] = <<<EOT
�׹�ѹ���ŧ����¹ {CALENDAR_NAME}

���ͼ����ҹ : "{USERNAME}"
���ʼ�ҹ : "{PASSWORD}"

�����׹�ѹ���ŧ����¹�س��ͧ������ꧤ��ҧ��ҧ ���� copy ��Դ㹺���������

{REG_LINK}

���ʴ������Ѻ���

�������èѴ��� {CALENDAR_NAME}

EOT;

// ======================================================
// theme.php
// ======================================================

// To Be Done

// ======================================================
// functions.inc.php
// ======================================================

// To Be Done

// ======================================================
// dblib.php
// ======================================================

// To Be Done

// ======================================================
// admin_events.php
// ======================================================

if (defined('ADMIN_EVENTS_PHP')) 

$lang_event_admin_data = array(
	'section_title' => '�Ѵ�����¡�áԨ����',
	'events_to_approve' => '�Ѵ�����¡�áԨ����: �׹�ѹ�Ԩ����',
	'upcoming_events' => '�Ѵ�����¡�áԨ����: �Ԩ���������Ҷ֧',
	'past_events' => '�Ѵ�����¡�áԨ����: �Ԩ��������ҹ��',
	'add_event' => '�����Ԩ����',
	'edit_event' => '��䢡Ԩ����',
	'view_event' => '�ʴ��Ԩ����',
	'approve_event' => '�׹�ѹ�Ԩ����',
	'update_event' => '��Ѻ��ا�Ԩ����',
	'delete_event' => 'ź�Ԩ����',
	'events_label' => '�Ԩ����',
	'auto_approve' => '�׹�ѹ�ѵ��ѵ�',
	'date_label' => '�ѹ���',
	'actions_label' => 'Actions',
	'events_filter_label' => '��ͧ��¡�áԨ����',
	'events_filter_options' => array('�ʴ��Ԩ����������','੾�СԨ��������ѧ����׹�ѹ','�ʴ��Ԩ���������Ҷ֧','੾�СԨ��������ҹ��'),
	'picture_attached' => 'Ṻ�ٻ�Ҿ',
// View Event
	'view_event_name' => '�Ԩ����: \'%s\'',
	'event_start_date' => '��չ���',
	'event_end_date' => '���֧',
	'event_duration' => '��ǧ����',
	'contact_info' => '��������´��õԴ���',
	'contact_email' => '������',
	'contact_url' => '���䫵�',
// General Info
// Event form
	'edit_event_title' => '�Ԩ����: \'%s\'',
	'cat_name' => '��Ǵ�Ԩ����',
	'event_start_date' => '�ѹ���',
	'event_end_date' => '���֧',
	'contact_info' => '��������´��õԴ���',
	'contact_email' => '������',
	'contact_url' => '���䫵�',
	'no_event' => '�������¡�áԨ����',
	'stats_string' => '������ <strong>%d</strong> �Ԩ����',
// Stats
	'stats_string1' => '<strong>%d</strong> ��¡��',
	'stats_string2' => '������: <strong>%d</strong> ��¡�� �ӹǹ <strong>%d</strong> ˹��',
// Misc.
	'add_event_success' => '�����Ԩ�����������º��������',
	'edit_event_success' => '�����¡�áԨ�������º��������',
	'approve_event_success' => '��Ѻ��ا��¡�áԨ�������º��������',
	'delete_confirm' => '��ͧ���ź��¡�áԨ����������� ?',
	'delete_event_success' => 'ź��¡�áԨ��������',
	'active_label' => '�ʴ�',
	'not_active_label' => '����ʴ�',
// Error messages
	'no_event_name' => '��ͧ�кت��͡Ԩ���� !',
	'no_event_desc' => '��ͧ�к���������´ !',
	'no_cat' => '��ͧ���͡��Ǵ�Ԩ���� !',
	'no_day' => '��ͧ�к��ѹ !',
	'no_month' => '��ͧ�к���͹ !',
	'no_year' => '��ͧ�кػ� !',
	'non_valid_date' => '�к��ѹ���١��ͧ !',
	'end_days_invalid' => '��ͧ \'�ѹ\' ���ǹ�ͧ \'��������\' ��ͧ�繵���Ţ��ҹ�� !',
	'end_hours_invalid' => '��ͧ \'�������\' ���ǹ�ͧ \'��������\' ��ͧ�繵���Ţ��ҹ�� !',
	'end_minutes_invalid' => '��ͧ \'�ҷ�\' ���ǹ�ͧ \'��������\' ��ͧ�繵���Ţ��ҹ�� !',
	'file_too_large' => '��Ҵ�Ҿ�˭��Թ %d Kb !',
	'non_valid_extension' => '�ٻẺ����ٻ�Ҿ���١��ͧ !',
	'delete_event_failed' => '�������öź��¡�áԨ���������',
	'approve_event_failed' => '�ѧ����ա���׹�ѹ�Ԩ�������',
	'no_events' => '�������¡�áԨ���� !',
	'move_image_failed' => '�������ö�Ѿ��Ŵ�ٻ�Ҿ�� !',
	'non_valid_dimensions' => '��Ҵ�Ҿ���ҧ �����٧�Թ %s �ԡ�� !',
	'recur_val_1_invalid' => '��ҷ���к����ǹ \'�ʴ���ӷء�\' ��ͧ�ҡ���� \'0\' !',
	'recur_end_count_invalid' => '��ҷ���к����ǹ \'����ش��ѧ�ҡ\' ��ͧ�ҡ���� \'0\' !',
	'recur_end_until_invalid' => '�ѹ������к����ǹ \'�ʴ���Ө��֧�ѹ���\' ��ͧ�ҡ�����ѹ������� !'
);

// ======================================================
// admin_categories.php
// ======================================================

if (defined('ADMIN_CATS_PHP')) 

$lang_cat_admin_data = array(
	'section_title' => '�Ѵ�����Ǵ�Ԩ����',
	'add_cat' => '������Ǵ�Ԩ����',
	'edit_cat' => '�����Ǵ�Ԩ����',
	'update_cat' => '��Ѻ��ا��Ǵ�Ԩ����',
	'delete_cat' => 'ź��Ǵ�Ԩ����',
	'events_label' => '�Ԩ����',
	'visibility' => '�ʴ�',
	'actions_label' => 'Actions',
	'users_label' => '�����ҹ',
	'admins_label' => 'Admins',
// General Info
	'general_info_label' => '��������´�����',
	'cat_name' => '������Ǵ',
	'cat_desc' => '��������´',
	'cat_color' => '��',
	'pick_color' => '���͡��!',
	'status_label' => 'ʶҹ�',
// Administrative Options
	'admin_label' => '��ǹ�ͧ�������к�',
	'auto_admin_appr' => '�׹�ѹ�Ԩ�����ͧ�������к����ѵ��ѵ�',
	'auto_user_appr' => '�׹�ѹ�Ԩ�����ͧ�����ҹ���ѵ��ѵ�',
// Stats
	'stats_string1' => '<strong>%d</strong> ��Ǵ',
	'stats_string2' => '�ʴ�: <strong>%d</strong>&nbsp;&nbsp;&nbsp;Total: <strong>%d</strong>&nbsp;&nbsp;&nbsp;on <strong>%d</strong> page(s)',
// Misc.
	'add_cat_success' => '������Ǵ�Ԩ�������º��������',
	'edit_cat_success' => '��Ѻ��ا��Ǵ�Ԩ�������º��������',
	'delete_confirm' => '��ͧ���ź��Ǵ�Ԩ�������������� ?',
	'delete_cat_success' => 'ź��Ǵ�Ԩ�������º��������',
	'active_label' => '�ʴ�',
	'not_active_label' => '����ʴ�',
// Error messages
	'no_cat_name' => '��ͧ�кت�����Ǵ�Ԩ���� !',
	'no_cat_desc' => '��ͧ�к���������´��Ǵ�Ԩ���� !',
	'no_color' => '��ͧ�к�������Ѻ��Ǵ�Ԩ���� !',
	'delete_cat_failed' => '�������öź��Ǵ�Ԩ���������',
	'no_cats' => '�������Ǵ�Ԩ���� !',
	'cat_has_events' => '�������öź�� ������Ǵ�Ԩ�����������¡������ %d �Ԩ����!<br>��ͧź��¡�áԨ�����͡��͹ �֧��ź��Ǵ�Ԩ������!'

);
// ======================================================
// admin_users.php
// ======================================================

if (defined('ADMIN_USERS_PHP')) 

$lang_user_admin_data = array(
	'section_title' => '��èѴ��ü����ҹ',
	'add_user' => '���������ҹ����',
	'edit_user' => '�����������´�����ҹ',
	'update_user' => '��Ѻ��ا�ѭ�ռ����ҹ',
	'delete_user' => 'ź�ѭ�ռ����ҹ',
	'last_access' => '��Ҥ����ش����',
	'actions_label' => 'Actions',
	'active_label' => '�ʴ�',
	'not_active_label' => '����ʴ�',
// Account Info
	'account_info_label' => '��������´�ѭ��',
	'user_name' => '���ͼ����ҹ',
	'user_pass' => '���ʼ�ҹ',
	'user_pass_confirm' => '�׹�ѹ���ʼ�ҹ',
	'user_email' => '������',
	'group_label' => '����������ҹ',
	'status_label' => 'ʶҹ�',
// Other Details
	'other_details_label' => '��������´����',
	'first_name' => '����',
	'last_name' => '���ʡ��',
	'user_website' => '���䫵�',
	'user_location' => '�������',
	'user_occupation' => '�Ҫվ',
// Stats
	'stats_string1' => '<strong>%d</strong> �����ҹ',
	'stats_string2' => '<strong>%d</strong> �����ҹ �ӹǹ <strong>%d</strong> ˹��',
// Misc.
	'select_group' => '���͡��¡��...',
	'add_user_success' => '�����ѭ�ռ����ҹ���º��������',
	'edit_user_success' => '��Ѻ��ا�ѭ�ռ����ҹ���º��������',
	'delete_confirm' => '��ͧ���ź�ѭ�ռ����ҹ���������� ?',
	'delete_user_success' => 'ź�ѭ�ռ����ҹ���º��������',
	'update_pass_info' => '�ҡ����ͧ���������ʼ�ҹ ��������ҧ���',
	'access_never' => '�����',
// Error messages
	'no_username' => '��ͧ�кت��ͼ����ҹ !',
	'invalid_username' => '�ô�кت�����੾�е���ѡ�����͵���Ţ �ӹǹ 4 �֧ 30 ����ѡ�� !',
	'invalid_password' => '��س�������ʼ�ҹ�繵���ѡ����е���Ţ 4 �֧ 16 ����ѡ�� !',
	'password_is_username' => '���ʼ�ҹ��ͧ����ӡѺ���ͼ����ҹ !',
	'password_not_match' =>'���ʼ�ҹ���ç�ѹ�Ѻ \'�׹�ѹ���ʼ�ҹ\'',
	'invalid_email' => '��ͧ�к����������١��ͧ !',
	'email_exists' => '���������ռ����ҹ�������� ��س����͡���������� !',
	'username_exists' => '���ͼ����ҹ����ռ����ҹ�������� ��س����͡���ͼ����ҹ���� !',
	'no_email' => '��ͧ�к������� !',
	'invalid_email' => '��ͧ�к����������١��ͧ !',
	'no_password' => '��ͧ�к����ʼ�ҹ !',
	'no_group' => '���͡���������Ѻ�����ҹ��� !',
	'delete_user_failed' => '�������öź�����ҹ�����',
	'no_users' => '����պѭ�ռ����ҹ !'

);

// ======================================================
// admin_groups.php
// ======================================================

if (defined('ADMIN_GROUPS_PHP')) 

$lang_group_admin_data = array(
	'section_title' => '����������ҹ',
	'add_group' => '�������������',
	'edit_group' => '��䢡����',
	'update_group' => '��Ѻ��ا��������´�����',
	'delete_group' => 'ź�����',
	'view_group' => '�١����',
	'users_label' => '��Ҫԡ',
	'actions_label' => 'Actions',
// General Info
	'general_info_label' => '��������´�����',
	'group_name' => '���͡����',
	'group_desc' => '��������´',
// Group Access Level
	'access_level_label' => '�дѺ�����Ҷ֧',
	'Administrator' => '੾�м������к� �֧������ö����¡����',
	'can_manage_accounts' => '����������ҹ��� ����ö�Ѵ��úѭ�ռ����ҹ��',
	'can_change_settings' => '����������ҹ��� ����ö��䢻�ԷԹ��',
	'can_manage_cats' => '����������ҹ��� ����ö�Ѵ�����Ǵ�Ԩ������',
	'upl_need_approval' => '�������¡�áԨ������ͧ�ա���׹�ѹ�ҡ�������к�',
// Stats
	'stats_string1' => '<strong>%d</strong> �����',
	'stats_string2' => '������: <strong>%d</strong> ����� �ӹǹ <strong>%d</strong> ˹��',
	'stats_string3' => '������: <strong>%d</strong> �����ҹ �ӹǹ <strong>%d</strong> ˹��',
// View Group Members
	'group_members_string' => '��Ҫԡ����� \'%s\' ',
	'username_label' => '���ͼ����ҹ',
	'firstname_label' => '����',
	'lastname_label' => '���ʡ��',
	'email_label' => '������',
	'last_access_label' => '��Ҥ����ش����',
	'edit_user' => '��䢼����ҹ',
	'delete_user' => 'ź�����ҹ',
// Misc.
	'add_group_success' => '������������º��������',
	'edit_group_success' => '��Ѻ��ا��������º��������',
	'delete_confirm' => '��ͧ���ź��������������� ?',
	'delete_user_confirm' => '��ͧ���ź�����ҹ���������� ?',
	'delete_group_success' => 'ź��������º��������',
	'no_users_string' => '����ռ����ҹ㹡�������',
// Error messages
	'no_group_name' => '��ͧ�кت��͡���� !',
	'no_group_desc' => '��ͧ�к���������´����� !',
	'delete_group_failed' => '�������öź����������',
	'no_groups' => '����ա��������ʴ� !',
	'group_has_users' => '�������öź�� ���С��������ռ����ҹ���� %d �����ҹ!<br>��ͧź�����ҹ�͡��͹ �֧��ź�������!'
);

// ======================================================
// admin_settings.php / admin_settings_template.php / 
// admin_settings_updates.php
// ======================================================

$lang_settings_data = array(
	'section_title' => '��駤�һ�ԷԹ'
// Links
	,'admin_links_text' => '���͡��¡��'
	,'admin_links' => array('��駤����ѡ','��õ�駤�����ŵ','��Ѻ��ا�Թ���')
// General Settings
	,'general_settings_label' => '��õ�駤�ҷ����'
	,'calendar_name' => '���ͻ�ԷԹ'
	,'calendar_description' => '���������´'
	,'calendar_admin_email' => '������ͧ�������û�ԷԹ�Ԩ����'
	,'cookie_name' => '���ͤ�ꡡ��'
	,'cookie_path' => '�Ҹ����纤�ꡡ��'
	,'debug_mode' => '�ʴ��������'
	,'calendar_status' => '�ʴ���ԷԹẺ�Ҹ�ó�'
// Environment Settings
	,'env_settings_label' => '��õ�駤����Ҿ�Ǵ����'
	,'lang' => '����'
		,'lang_name' => '����'
		,'lang_native_name' => '���;�����ͧ'
		,'lang_trans_date' => '�������'
		,'lang_author_name' => '������ҧ'
		,'lang_author_email' => '������'
		,'lang_author_url' => '���䫵�'
	,'charset' => '�����ѡ���'
	,'theme' => '���'
		,'theme_name' => '���͸��'
		,'theme_date_made' => '���ҧ�����'
		,'theme_author_name' => '������ҧ'
		,'theme_author_email' => '������'
		,'theme_author_url' => '���䫵�'
	,'timezone' => '��������������'
	,'time_format' => '�ٻẺ����ʴ�����'
		,'24hours' => '24 �������'
		,'12hours' => '12 �������'
	,'auto_daylight_saving' => '��駤�� Daylight Saving Time (DST) Ẻ�ѵ��ѵ�'
	,'main_table_width' => '�������ҧ�ͧ���ҧ��ѡ (�ԡ�� ���� %)'
	,'day_start' => '�ѹ��������ѻ����'
	,'default_view' => '�ʴ�Ẻ����'
	,'search_view' => '�ʴ���ä���'
	,'archive' => '�ʴ��Ԩ��������ҹ��'
	,'events_per_page' => '�ӹǹ�Ԩ�������˹��'
	,'sort_order' => '������§�ӴѺ'
		,'sort_order_title_a' => '���§�����Ǣ�� �-�'
		,'sort_order_title_d' => '���§�����Ǣ�� �-�'
		,'sort_order_date_a' => '���§����ѹ����������ҡ'
		,'sort_order_date_d' => '���§����ѹ����ҡ���ҹ���'
	,'show_recurrent_events' => '�ʴ��Ԩ��������Դ���'
	,'multi_day_events' => '�Ԩ����Ẻ�����ѹ'
		,'multi_day_events_all' => '�ʴ��ء��ǧ�Ԩ����'
		,'multi_day_events_bounds' => '�ʴ��ѹ������� & ����ѹ�Թ�ش�Ԩ����'
		,'multi_day_events_start' => '�ʴ�੾���ѹ������鹡Ԩ����'
	// User Settings
	,'user_settings_label' => '��õ�駤�Ҽ����ҹ'
	,'allow_user_registration' => '͹حҵ�������ŧ����¹'
	,'reg_duplicate_emails' => '�������������ӡѹ'
	,'reg_email_verify' => '�����׹�ѹŧ����¹'
// Event View
	,'event_view_label' => '�ʴ��Ԩ����'
	,'popup_event_mode' => '�ʴ�Ẻ˹�ҵ�ҧ��ͺ�Ѿ'
	,'popup_event_width' => '�������ҧ�ͧ˹�ҵ�ҧ��ͺ�Ѿ'
	,'popup_event_height' => '�����٧�ͧ˹�ҵ�ҧ��ͺ�Ѿ'
// Add Event View
	,'add_event_view_label' => '�����Ԩ����'
	,'add_event_view' => '�ʴ�'
	,'addevent_allow_html' => '�� <b>BB Code</b> ���ǹ��������´'
	,'addevent_allow_contact' => '�ʴ���������´��õԴ���'
	,'addevent_allow_email' => '�ʴ�������'
	,'addevent_allow_url' => '�ʴ����䫵�'
	,'addevent_allow_picture' => '�ʴ��ٻ�Ҿ'
	,'new_post_notification' => '�����׹�ѹ��������Ԩ��������'
// Calendar View
	,'calendar_view_label' => '�ʴ�Ẻ��ԷԹ'
	,'monthly_view' => '�ʴ�Ẻ�����͹'
	,'cal_view_show_week' => '�ʴ��Ţ�ѻ����'
	,'cal_view_max_chars' => '�ӹǹ����ѡ���٧�ش'
// Flyer View
	,'flyer_view_label' => 'Flyer View'
	,'flyer_view' => '�ʴ�'
	,'flyer_show_picture' => '�ʴ��ٻ�Ҿ� Flyer View'
	,'flyer_view_max_chars' => '�ӹǹ����ѡ���٧�ش'
// Weekly View
	,'weekly_view_label' => '�ʴ�Ẻ����ѻ����'
	,'weekly_view' => '�ʴ�'
	,'weekly_view_max_chars' => '�ӹǹ����ѡ���٧�ش'
// Daily View
	,'daily_view_label' => '�ʴ�Ẻ����ѹ'
	,'daily_view' => '�ʴ�'
	,'daily_view_max_chars' => '�ӹǹ����ѡ���٧�ش'
// Categories View
	,'categories_view_label' => '�ʴ�Ẻ��Ǵ'
	,'cats_view' => '�ʴ�'
	,'cats_view_max_chars' => '�ӹǹ����ѡ���٧�ش'
// Mini Calendar
	,'mini_cal_label' => '��ԷԹ����'
	,'mini_cal_def_picture' => '�ٻ�Ҿ����'
	,'mini_cal_display_picture' => '�ʴ��ٻ�Ҿ'
	,'mini_cal_diplay_options' => array('����ʴ�','�Ҿ����', '�Ҿ����ѹ','�Ҿ����ѻ����','�Ҿ����')
// Mail Settings
	,'mail_settings_label' => '��駤��������'
	,'mail_method' => '�ٻẺ���������'
	,'mail_smtp_host' => 'SMTP Hosts (�¡��������ͧ���� ;)'
	,'mail_smtp_auth' => ' SMTP Authentication'
	,'mail_smtp_username' => 'SMTP Username'
	,'mail_smtp_password' => 'SMTP Password'

// Picture Settings
	,'picture_settings_label' => '��駤����ٻ�Ҿ'
	,'max_upl_dim' => '��Ҵ���ҧ�ش�����٧�ش����Ѻ�ٻ�Ҿ�����Ѿ��Ŵ'
	,'max_upl_size' => '��Ҵ�٧�ش����Ѻ�ٻ�Ҿ�����Ѿ��Ŵ (亵�)'
	,'picture_chmod' => '������������Ѻ�ٻ�Ҿ (CHMOD)'
	,'allowed_file_extensions' => '���������ͧ�ٻ�Ҿ�����Ѿ��Ŵ'
// Form Buttons
	,'update_config' => '�ѹ�֡��õ�駤������'
	,'restore_config' => '���������ͧ�к�'
// Misc.
	,'update_settings_success' => '��õ�駤�����º��������'
	,'restore_default_confirm' => '��ͧ�����������ͧ�к�������� ?'
// Template Configuration
	,'template_type' => '���������ŵ'
	,'template_header' => '��� Header'
	,'template_footer' => '��� Footer'
	,'template_status_default' => '�����ŵ����'
	,'template_status_custom' => '�����ŵ:'
	,'template_custom' => '��˹��ͧ'

	,'info_meta' => '��������´�����'
	,'info_status' => 'ʶҹ�'
	,'info_status_default' => '����ʴ�������'
	,'info_status_custom' => '�ʴ�������:'
	,'info_custom' => '��������´'

	,'dynamic_tags' => '䴹��Ԥ��'

// Product Updates
	,'updates_check_text' => '��س��ͫѡ���� ���ѧ����¡��...'
	,'updates_no_response' => '����¡������� ��س��ͧ�����ա����'
	,'avail_updates' => '�Ѿഷ����ش'
	,'updates_download_zip' => '��ǹ���Ŵ ZIP ���� (.zip)'
	,'updates_download_tgz' => '��ǹ���Ŵ TGZ ���� (.tar.gz)'
	,'updates_released_label' => '�ѹ����Ѻ��ا: %s'
	,'updates_no_update' => '�س���ѧ��ҹ�����������ش �����繵�ͧ�Ѿഷ'
);

// ======================================================
// cal_mini.inc.php
// ======================================================

$lang_mini_cal = array(
	'def_pic' => '�Ҿ����'
	,'daily_pic' => '�Ҿ��Ш��ѹ��� (%s)'
	,'weekly_pic' => '�Ҿ��Ш��ѻ������ (%s)'
	,'rand_pic' => '�Ҿ���� (%s)'
	,'post_event' => '�����Ԩ��������'
	,'num_events' => '%d �Ԩ����'
	,'selected_week' => '�ѻ������ %d'
);

// ======================================================
// extcalendar.php
// ======================================================

// To Be Done

// ======================================================
// config.inc.php
// ======================================================

// To Be Done

// ======================================================
// install.php
// ======================================================

// To Be Done

// ======================================================
// login.php
// ======================================================

if (defined('LOGIN_PHP')) 

$lang_login_data = array(
	'section_title' => '�������к�'
// General Settings
	,'login_intro' => '�����ͼ����ҹ ������ʼ�ҹ�����������к�'
	,'username' => '���ͼ����ҹ'
	,'password' => '���ʼ�ҹ'
	,'remember_me' => '�Ӣ����š����͡�Թ'
	,'login_button' => '�������к�'
// Errors
	,'invalid_login' => '��س��ͧ�����ա���� !'
	,'no_username' => '��ͧ�кت��ͼ����ҹ !'
	,'already_logged' => '�س�������к����� !'
);

// ======================================================
// logout.php
// ======================================================

// To Be Done


?>