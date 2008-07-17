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
	,'nativename' => 'Thai' // Language name in native language. E.g: 'Fran็ais' for 'French'
	,'locale' => array('th','thai') // Standard locale alternatives for a specific language. For reference, go to: http://www.php.net/manual/en/function.setlocale.php
	,'charset' => 'TIS-620' // For reference, go to : http://www.w3.org/International/O-charset-lang.html
	,'direction' => 'ltr' // 'ltr' for Left to Right. 'rtl' for Right to Left languages such as Arabic.
	,'author' => 'Mohamed Moujami (Simo)' 
	,'author_email' => 'simoami@hotmail.com' 
	,'author_url' => 'http://www.MarocTour.com'
	,'transdate' => '05/15/2005' // Translate by Chaisilp Panawiwatn => chaisilp@hotmail.com
);

$lang_general = array (
	'yes' => 'ใช่'
	,'no' => 'ไม่ใช่'
	,'back' => 'กลับ'
	,'continue' => 'ทำต่อ'
	,'close' => 'ปิด'
	,'errors' => 'ผิดพลาด'
	,'info' => 'รายละเอียด'
	,'day' => 'วัน'
	,'days' => 'วัน'
	,'month' => 'เดือน'
	,'months' => 'เดือน'
	,'year' => 'ปี'
	,'years' => 'ปี'
	,'hour' => 'ชั่วโมง'
	,'hours' => 'ชั่วโมง'
	,'minute' => 'นาที'
	,'minutes' => 'นาที'
	,'everyday' => 'ทุกๆวัน'
	,'everymonth' => 'ทุกๆเดือน'
	,'everyyear' => 'ทุกๆปี'
	,'active' => 'แสดง'
	,'not_active' => 'ไม่แสดง'
	,'today' => 'วันนี้'
	,'signature' => 'Powered by %s'
	,'expand' => 'ขยาย'
	,'collapse' => 'ปิด'
);

// Date formats, For reference, go to : http://www.php.net/manual/en/function.strftime.php
$lang_date_format = array (
	'full_date' => 'วัน%Aที่ %d %B %Y' // e.g. Wednesday, June 05, 2002
	,'full_date_time_24hour' => 'วัน%Aที่ %d %B %Y เวลา %H:%M' // e.g. Wednesday, June 05, 2002 At 21:05
	,'full_date_time_12hour' => 'วัน%Aที่ %d %B %Y เวลา %I:%M %p' // e.g. Wednesday, June 05, 2002 At 9:05 pm
	,'day_month_year' => '%d-%b-%Y' // e.g 10-Sep-2004
	,'local_date' => '%c' // Preferred date and time representation for current language 
	,'mini_date' => '%a %d %b %Y' 
	,'month_year' => '%B %Y'
	,'day_of_week' => array('อ','จ','อ','พ','พ','ศ','ส')
	,'months' => array('มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม')
);

$lang_system = array (
	'system_caption' => 'ข้อความระบบ'
	,'page_access_denied' => 'คุณไม่มีสิทธิ์ในการเข้าใช้งานนี้'
	,'page_requires_login' => 'คุณต้องเข้าสู่ระบบก่อน'
	,'operation_denied' => 'คุณไม่มีสิทธิ์ในการเข้าใช้งานนี้'
	,'section_disabled' => 'section ปิด !'
	,'non_exist_cat' => 'ยังไม่มีหมวดกิจกรรมนี้ !'
	,'non_exist_event' => 'ยังไม่มีกิจกรรมนี้ !'
	,'param_missing' => 'ข้อมูลไม่ถูกต้อง'
	,'no_events' => 'ไม่มีรายการกิจกรรม'
	,'config_string' => 'คุณใช้ \'%s\' บน %s, %s และ %s.'
	,'no_table' => 'ไม่มีตาราง \'%s\' !'
	,'no_anonymous_group' => 'ตาราง %s ไม่ตรงกับกลุ่ม \'Anonymous\' !'
	,'calendar_locked' => 'ขออภัย ปิดใช้งานชั่วคราว !'
	,'new_upgrade' => 'ระบบตรวจพบเวอร์ชั่นใหม่ กดปุ่ม "Continue" เพื่อทำการอัพเกรด'
	,'no_profile' => 'พบข้อผิดพลาดขณะเรียกข้อมูลประวัติของคุณ'
	,'unknown_component' => 'ไม่รู้จักคอมโพเน้นท์'
// Mail messages
	,'new_event_subject' => 'ยืนยันรายการกิจกรรม : %s'
	,'event_notification_failed' => 'พบข้อผิดพลาดในการส่งอีเมล์ !'
);

// Message body for new event email notification
$lang_system['event_notification_body'] = <<<EOT
รายการกิจกรรมได้กำหนดขึ้นใน {CALENDAR_NAME}
และต้องการการยืนยัน :

หัวข้อ: "{TITLE}"
วันที่: "{DATE}"
ช่วงเวลา: "{DURATION}"

คุณสามารถจัดการกิจกรรมนี้โดยการคลิ๊กลิ๊งค์ด้านล่าง หรือ copy ไปเปิดในบราวเซอร์ได้

{LINK}

(หมายเหตุ คุณต้องเข้าสู่ระบบก่อนจึงจะดำเนินการได้)

ขอแสดงความนับถือ

ผู้บริหารจัดการ {CALENDAR_NAME}

EOT;

// Admin menu entries
$lang_admin_menu = array (
	'login' => 'เข้าสู่ระบบ'
	,'register' => 'ลงทะเบียน'
  ,'logout' => 'ออกจากระบบ <span style="color:#FF9922">[<span style="color:#606F79">%s</span>]</span>'
  ,'user_profile' => 'ประวัติส่วนตัว'
	,'admin_events' => 'กิจกรรม'
  ,'admin_categories' => 'หมวด'
  ,'admin_groups' => 'กลุ่ม'
  ,'admin_users' => 'ผู้ใช้งาน'
  ,'admin_settings' => 'ตั้งค่า'
);

// Main menu entries
$lang_main_menu = array (
	'add_event' => 'เพิ่มกิจกรรม'
	,'cal_view' => 'รายเดือน'
  ,'flat_view' => 'ตามลำดับ'
  ,'weekly_view' => 'รายสัปดาห์'
  ,'daily_view' => 'รายวัน'
  ,'yearly_view' => 'รายปี'
  ,'categories_view' => 'หมวดกิจกรรม'
  ,'search_view' => 'ค้นหา'
);

// ======================================================
// Add Event view
// ======================================================

$lang_add_event_view = array(
	'section_title' => 'เพิ่มกิจกรรม'
	,'edit_event' => 'แก้ไขกิจกรรม [id%d] \'%s\''
	,'update_event_button' => 'ปรับปรุงกิจกรรม'

// Event details
	,'event_details_label' => 'รายละเอียด'
	,'event_title' => 'หัวข้อกิจกรรม'
	,'event_desc' => 'รายละเอียด'
	,'event_cat' => 'หมวด'
	,'choose_cat' => 'เลือก'
	,'event_date' => 'ช่วงเวลา'
	,'day_label' => 'วัน'
	,'month_label' => 'เดือน'
	,'year_label' => 'ปี'
	,'start_date_label' => 'วันที่เริ่มต้น'
	,'start_time_label' => 'เวลา'
	,'end_date_label' => 'ระยะเวลา'
	,'all_day_label' => 'ตลอดวัน'
// Contact details
	,'contact_details_label' => 'รายละเอียดผู้ติดต่อ'
	,'contact_info' => 'รายละเอียดการติดต่อ'
	,'contact_email' => 'อีเมล์'
	,'contact_url' => 'เว็บไซต์'
// Repeat events
	,'repeat_event_label' => 'กิจกรรมต่อเนื่อง'
	,'repeat_method_label' => 'วิธีการแสดง'
	,'repeat_none' => 'ไม่ต้องแสดงกิจกรรมต่อเนื่อง'
	,'repeat_every' => 'แสดงซ้ำทุกๆ'
	,'repeat_days' => 'วัน'
	,'repeat_weeks' => 'สัปดาห์'
	,'repeat_months' => 'เดือน'
	,'repeat_years' => 'ปี'
	,'repeat_end_date_label' => 'แสดงวันสิ้นสุดกิจกรรม'
	,'repeat_end_date_none' => 'ไม่กำหนดวันสิ้นสุดกิจกรรม'
	,'repeat_end_date_count' => 'สิ้นสุดหลังจาก %s กิจกรรม'
	,'repeat_end_date_until' => 'แสดงซ้ำจนถึงวันที่'
// Other details
	,'other_details_label' => 'รายละเอียดอื่นๆ'
	,'picture_file' => 'ไฟล์รูปภาพ'
	,'file_upload_info' => '(ไม่เกิน %d Kb - เฉพาะ : %s )' 
	,'del_picture' => 'ลบภาพปัจจุบัน ?'
// Administrative options
	,'admin_options_label' => 'ส่วนของผู้ดูแลระบบ'
	,'auto_appr_event' => 'ยืนยันกิจกรรม'

// Error messages
	,'no_title' => 'ยังไม่ได้ระบุหัวข้อกิจกรรม !'
	,'no_desc' => 'ยังไม่ได้ระบุรายละเอียด !'
	,'no_cat' => 'ยังไม่ได้เลือกหมวดกิจกรรม !'
	,'date_invalid' => 'ระบุวันที่ไม่ถูกต้อง !'
	,'end_days_invalid' => 'ระบุค่าวันไม่ถูกต้อง !'
	,'end_hours_invalid' => 'ระบุค่าชั่วโมงไม่ถูกต้อง !'
	,'end_minutes_invalid' => 'ระบุค่านาทีไม่ถูกต้อง !'
	,'non_valid_extension' => 'รูปแบบไฟล์รูปภาพไม่ถูกต้อง ! (เฉพาะ: %s เท่านั้น)'
	,'file_too_large' => 'ขนาดรูปภาพใหญ่เกิน %d Kb !'
	,'move_image_failed' => 'ระบบไม่สามารถทำการอัพโหลดรูปภาพได้ กรุณาตรวจสอบขนาดรูปภาพ หรือแจ้งผู้ดูแลระบบ'
	,'non_valid_dimensions' => 'ความกว้างหรือความสูงใหญ่เกิน %s พิกเซล !'
	,'recur_val_1_invalid' => 'ระบุค่าไม่ถูกต้อง ต้องระบุค่าที่มากกว่า \'0\' !'
	,'recur_end_count_invalid' => 'ระบุค่าไม่ถูกต้อง ต้องระบุค่าที่มากกว่า \'0\' !'
	,'recur_end_until_invalid' => 'วันที่ในกิจกรรมต่อเนื่องต้องมากกว่าวันที่เริ่มต้นกิจกรรม !'
// Misc. messages
	,'submit_event_pending' => 'ได้รับกิจกรรมของท่าน แต่จะยังไม่แสดงในปฏิทินจนกว่าจะได้รับการอนุมัติจากผู้ดูแลระบบ!'
	,'submit_event_approved' => 'กิจกรรมของคุณได้รับการอนุมัติแล้ว ขอบคุณที่เพิ่มกิจกรรม!'
	,'event_repeat_msg' => 'กิจกรรมนี้ได้กำหนดให้เป็นกิจกรรมต่อเนื่อง'
	,'event_no_repeat_msg' => 'กิจกรรมนี้ไม่สามารถต่อเนื่องได้'
);

// ======================================================
// daily view
// ======================================================

$lang_daily_event_view = array(
	'section_title' => 'แสดงแบบรายวัน'
	,'next_day' => 'วันถัดไป'
	,'previous_day' => 'วันก่อนหน้า'
	,'no_events' => 'ไม่มีกิจกรรมในวันนี้'
);

// ======================================================
// weekly view
// ======================================================

$lang_weekly_event_view = array(
	'section_title' => 'แสดงแบบรายสัปดาห์'
	,'week_period' => '%s - %s'
	,'next_week' => 'สัปดาห์ถัดไป'
	,'previous_week' => 'สัปดาห์ที่แล้ว'
	,'selected_week' => 'สัปดาห์ที่ %d'
	,'no_events' => 'ไม่มีกิจกรรมในสัปดาห์นี้'
);

// ======================================================
// monthly view
// ======================================================

$lang_monthly_event_view = array(
	'section_title' => 'แสดงแบบรายเดือน'
	,'next_month' => 'เดือนถัดไป'
	,'previous_month' => 'เดือนที่แล้ว'
);

// ======================================================
// flat view
// ======================================================

$lang_flat_event_view = array(
	'section_title' => 'แสดงแบบตามลำดับ'
	,'week_period' => '%s - %s'
	,'next_month' => 'เดือนถัดไป'
	,'previous_month' => 'เดือนที่แล้ว'
	,'contact_info' => 'รายละเอียดการติดต่อ'
	,'contact_email' => 'อีเมล์'
	,'contact_url' => 'เว็บไซต์'
	,'no_events' => 'ไม่มีกิจกรรมสำหรับเดือนนี้'
);

// ======================================================
// Event view
// ======================================================

$lang_event_view = array(
	'section_title' => 'แสดงรายการกิจกรรม'
	,'display_event' => 'กิจกรรม: \'%s\''
	,'cat_name' => 'หมวด'
	,'event_start_date' => 'เริ่มวันที่'
	,'event_end_date' => 'ถึงวันที่'
	,'event_duration' => 'ช่วงเวลา'
	,'contact_info' => 'รายละเอียดการติดต่อ'
	,'contact_email' => 'อีเมล์'
	,'contact_url' => 'เว็บไซต์'
	,'no_event' => 'ไม่มีรายการกิจกรรม'
	,'stats_string' => 'รวมทั้งสิ้น <strong>%d</strong> กิจกรรม'
	,'edit_event' => 'แก้ไขกิจกรรม'
	,'delete_event' => 'ลบกิจกรรม'
	,'delete_confirm' => 'ต้องการลบกิจกรรมหรือไม่ ?'
	
);

// ======================================================
// Categories view
// ======================================================

$lang_cats_view = array(
	'section_title' => 'แสดงหมวดกิจกรรม'
	,'cat_name' => 'ชื่อหมวด'
	,'total_events' => 'กิจกรรมทั้งหมด'
	,'upcoming_events' => 'กิจกรรมที่จะมาถึง'
	,'no_cats' => 'ไม่มีหมวดกิจกรรม'
	,'stats_string' => 'มีจำนวน <strong>%d</strong> กิจกรรม ใน <strong>%d</strong> หมวด'
);

// ======================================================
// Category Events view
// ======================================================

$lang_cat_events_view = array(
	'section_title' => 'กิจกรรมภายใต้ \'%s\''
	,'event_name' => 'ชื่อกิจกรรม'
	,'event_date' => 'วันที่'
	,'no_events' => 'ไม่มีกิจกรรมในหมวดนี้'
	,'stats_string' => 'รวมทั้งสิ้น <strong>%d</strong> กิจกรรม'
	,'stats_string1' => '<strong>%d</strong> กิจกรรม ใน <strong>%d</strong> หน้า'
);

// ======================================================
// cal_search.php
// ======================================================

$lang_event_search_data = array(
	'section_title' => 'ค้นหากิจกรรม',
	'search_results' => 'ผลการค้นหา',
	'category_label' => 'หมวด',
	'date_label' => 'วันที่',
	'no_events' => 'ไม่มีกิจกรรมในหมวดนี้',
	'search_caption' => 'ระบุคำที่ค้นหา...',
	'search_again' => 'ค้นหาอีกครั้ง',
	'search_button' => 'ค้นหา',
// Misc.
	'no_results' => 'ไม่พบรายการที่ค้นหา',	
// Stats
	'stats_string1' => 'ค้นพบ <strong>%d</strong> กิจกรรม',
	'stats_string2' => '<strong>%d</strong> กิจกรรม ใน <strong>%d</strong> หน้า'
);

// ======================================================
// profile.php
// ======================================================

if (defined('PROFILE_PHP')) 

$lang_user_profile_data = array(
	'section_title' => 'ประวัติส่วนตัว',
	'edit_profile' => 'แก้ไขประวัติส่วนตัว',
	'update_profile' => 'ปรับปรุงประวัติส่วนตัว',
	'actions_label' => 'Actions',
// Account Info
	'account_info_label' => 'รายละเอียดบัญชีผู้ใช้งาน',
	'user_name' => 'ชื่อผู้ใช้งาน',
	'user_pass' => 'รหัสผ่าน',
	'user_pass_confirm' => 'ยืนยันรหัสผ่าน',
	'user_email' => 'อีเมล์ผู้ใช้งาน',
	'group_label' => 'สมาชิกกลุ่ม',
// Other Details
	'other_details_label' => 'รายละเอียดอื่นๆ',
	'first_name' => 'ชื่อ',
	'last_name' => 'นามสกุล',
	'full_name' => 'ชื่อเต็ม',
	'user_website' => 'เว็บไซต์',
	'user_location' => 'ที่อยู่',
	'user_occupation' => 'อาชีพ',
// Misc.
	'select_language' => 'เลือกภาษา',
	'edit_profile_success' => 'ปรับปรุงประวัติส่วนตัวเรียบร้อยแล้ว',
	'update_pass_info' => 'หากไม่ต้องการแก้ไขรหัสผ่าน ให้เว้นว่างไว้',
// Error messages
	'invalid_password' => 'กรุณาใส่รหัสผ่านเป็นตัวอักษรและตัวเลข 4 ถึง 16 ตัวอักษร !',
	'password_is_username' => 'รหัสผ่านต้องไม่ซ้ำกับชื่อผู้ใช้งาน !',
	'password_not_match' =>'รหัสผ่านไม่ตรงกันกับ \'ยืนยันรหัสผ่าน\'',
	'invalid_email' => 'ต้องระบุอีเมล์ให้ถูกต้อง !',
	'email_exists' => 'อีเมล์นี้มีผู้ใช้งานอยู่แล้ว กรุณาเลือกอีเมล์ใหม่ !',
	'no_email' => 'ต้องระบุอีเมล์ !',
	'invalid_email' => 'ต้องระบุอีเมล์ให้ถูกต้อง !',
	'no_password' => 'ต้องระบุรหัสผ่าน !'
);

// ======================================================
// register.php
// ======================================================

if (defined('USER_REGISTRATION_PHP')) 

$lang_user_registration_data = array(
	'section_title' => 'ลงทะเบียนผู้ใช้งาน',
// Step 1: Terms & Conditions
	'terms_caption' => 'Terms and Conditions',
	'terms_intro' => 'In order to proceed, you must agree to the following:',
	'terms_message' => 'Please take a moment to review these rules detailed below. If you agree with them and wish to proceed with the registration, simply click the "I agree" button below. To cancel this registration, simply hit the \'back\' button on your browser.<br /><br />Please remember that we are not responsible for any events posted by users of this calendar application. We do not vouch for or warrant the accuracy, completeness or usefulness of any posted event, and are not responsible for the contents of any event.<br /><br />The messages express the views of the author of the event, not necessarily the views of this calendar application. Any user who feels that a posted event is objectionable is encouraged to contact us immediately by email. We have the ability to remove objectionable content and we will make every effort to do so, within a reasonable time frame, if we determine that removal is necessary.<br /><br />You agree, through your use of this service, that you will not use this calendar application to post any material which is knowingly false and/or defamatory, inaccurate, abusive, vulgar, hateful, harassing, obscene, profane, sexually oriented, threatening, invasive of a person\'s privacy, or otherwise violative of any law.<br /><br />You agree not to post any copyrighted material unless the copyright is owned by you or by %s.',
	'terms_button' => 'ยอมรับ',
	
// Account Info
	'account_info_label' => 'รายละเอียดบัญชีผู้ใช้งาน',
	'user_name' => 'ชื่อผู้ใช้งาน',
	'user_pass' => 'รหัสผ่าน',
	'user_pass_confirm' => 'ยืนยันรหัสผ่าน',
	'user_email' => 'อีเมล์',
// Other Details
	'other_details_label' => 'รายละเอียดอื่นๆ',
	'first_name' => 'ชื่อ',
	'last_name' => 'นามสกุล',
	'user_website' => 'เว็บไซต์',
	'user_location' => 'ที่อยู่',
	'user_occupation' => 'อาชีพ',
	'register_button' => 'ลงทะเบียน',

// Stats
	'stats_string1' => '<strong>%d</strong> ผู้ใช้งาน',
	'stats_string2' => '<strong>%d</strong> ผู้ใช้งาน จำนวน <strong>%d</strong> หน้า',
// Misc.
	'reg_nomail_success' => 'ขอบคุณ',
	'reg_mail_success' => 'รายละเอียดการยืนยันการลงทะเบียนได้ส่งให้ทางอีเมล์ที่คุณระบุแล้ว',
	'reg_activation_success' => 'คุณได้ลงทะเบียนเรียบร้อยแล้ว คุณสามารถเข้าสู่ระบบด้วยชื่อและรหัสผ่านของคุณ',
// Mail messages
	'reg_confirm_subject' => 'ยืนยันการลงทะเบียน %s',
	
// Error messages
	'no_username' => 'ต้องระบุชื่อผู้ใช้งาน !',
	'invalid_username' => 'โปรดระบุชื่อเป็นเฉพาะตัวอักษรหรือตัวเลข จำนวน 4 ถึง 30 ตัวอักษร !',
	'username_exists' => '่มีชื่อผู้ใช้งานนี้อยู่แล้ว กรุณาระบุชื่ออื่น !',
	'no_password' => 'ต้องระบุรหัสผ่าน !',
	'invalid_password' => 'กรุณาใส่รหัสผ่านเป็นตัวอักษรและตัวเลข 4 ถึง 16 ตัวอักษร !',
	'password_is_username' => 'รหัสผ่านต้องไม่ซ้ำกับชื่อผู้ใช้งาน !',
	'password_not_match' =>'รหัสผ่านไม่ตรงกันกับ \'ยืนยันรหัสผ่าน\'',
	'no_email' => 'ต้องระบุอีเมล์ !',
	'invalid_email' => 'ต้องระบุอีเมล์ให้ถูกต้อง !',
	'email_exists' => 'อีเมล์นี้มีผู้ใช้งานอยู่แล้ว กรุณาเลือกอีเมล์ใหม่ !',
	'delete_user_failed' => 'ไม่สามารถลบบัญชีผู้ใช้งานนี้',
	'no_users' => 'ไม่มีรายการผู้ใช้งาน !',
	'already_logged' => 'คุณเข้าสู่ระบบแล้ว !',
	'registration_not_allowed' => 'ระงับการใช้งานระบบลงทะเบียน !',
	'reg_email_failed' => 'พบข้อผิดพลาดในการส่งอีเมล์ !',
	'reg_activation_failed' => 'พบข้อผิดพลาดในการทำรายการนี้ !'
);
// Message body for email activation
$lang_user_registration_data['reg_confirm_body'] = <<<EOT
ยืนยันการลงทะเบียน {CALENDAR_NAME}

ชื่อผู้ใช้งาน : "{USERNAME}"
รหัสผ่าน : "{PASSWORD}"

เพื่อยืนยันการลงทะเบียนคุณต้องคลิ๊กลิ๊งค์ข้างล่าง หรือ copy ไปเปิดในบราวเซอร์ได้

{REG_LINK}

ขอแสดงความนับถือ

ผู้บริหารจัดการ {CALENDAR_NAME}

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
	'section_title' => 'จัดการรายการกิจกรรม',
	'events_to_approve' => 'จัดการรายการกิจกรรม: ยืนยันกิจกรรม',
	'upcoming_events' => 'จัดการรายการกิจกรรม: กิจกรรมที่จะมาถึง',
	'past_events' => 'จัดการรายการกิจกรรม: กิจกรรมที่ผ่านมา',
	'add_event' => 'เพิ่มกิจกรรม',
	'edit_event' => 'แก้ไขกิจกรรม',
	'view_event' => 'แสดงกิจกรรม',
	'approve_event' => 'ยืนยันกิจกรรม',
	'update_event' => 'ปรับปรุงกิจกรรม',
	'delete_event' => 'ลบกิจกรรม',
	'events_label' => 'กิจกรรม',
	'auto_approve' => 'ยืนยันอัตโนมัติ',
	'date_label' => 'วันที่',
	'actions_label' => 'Actions',
	'events_filter_label' => 'กรองรายการกิจกรรม',
	'events_filter_options' => array('แสดงกิจกรรมทั้งหมด','เฉพาะกิจกรรมที่ยังไม่ยืนยัน','แสดงกิจกรรมที่จะมาถึง','เฉพาะกิจกรรมที่ผ่านมา'),
	'picture_attached' => 'แนบรูปภาพ',
// View Event
	'view_event_name' => 'กิจกรรม: \'%s\'',
	'event_start_date' => 'วัีนที่',
	'event_end_date' => 'จนถึง',
	'event_duration' => 'ช่วงเวลา',
	'contact_info' => 'รายละเอียดการติดต่อ',
	'contact_email' => 'อีเมล์',
	'contact_url' => 'เว็บไซต์',
// General Info
// Event form
	'edit_event_title' => 'กิจกรรม: \'%s\'',
	'cat_name' => 'หมวดกิจกรรม',
	'event_start_date' => 'วันที่',
	'event_end_date' => 'จนถึง',
	'contact_info' => 'รายละเอียดการติดต่อ',
	'contact_email' => 'อีเมล์',
	'contact_url' => 'เว็บไซต์',
	'no_event' => 'ไม่มีรายการกิจกรรม',
	'stats_string' => 'ทั้งหมด <strong>%d</strong> กิจกรรม',
// Stats
	'stats_string1' => '<strong>%d</strong> รายการ',
	'stats_string2' => 'ทั้งหมด: <strong>%d</strong> รายการ จำนวน <strong>%d</strong> หน้า',
// Misc.
	'add_event_success' => 'เพิ่มกิจกรรมใหม่เรียบร้อยแล้ว',
	'edit_event_success' => 'แก้ไขรายการกิจกรรมเรียบร้อยแล้ว',
	'approve_event_success' => 'ปรับปรุงรายการกิจกรรมเรียบร้อยแล้ว',
	'delete_confirm' => 'ต้องการลบรายการกิจกรรมหรือไม่ ?',
	'delete_event_success' => 'ลบรายการกิจกรรมแล้ว',
	'active_label' => 'แสดง',
	'not_active_label' => 'ไม่แสดง',
// Error messages
	'no_event_name' => 'ต้องระบุชื่อกิจกรรม !',
	'no_event_desc' => 'ต้องระบุรายละเอียด !',
	'no_cat' => 'ต้องเลือกหมวดกิจกรรม !',
	'no_day' => 'ต้องระบุวัน !',
	'no_month' => 'ต้องระบุเดือน !',
	'no_year' => 'ต้องระบุปี !',
	'non_valid_date' => 'ระบุวันให้ถูกต้อง !',
	'end_days_invalid' => 'ช่อง \'วัน\' ในส่วนของ \'ระยะเวลา\' ต้องเป็นตัวเลขเท่านั้น !',
	'end_hours_invalid' => 'ช่อง \'ชั่วโมง\' ในส่วนของ \'ระยะเวลา\' ต้องเป็นตัวเลขเท่านั้น !',
	'end_minutes_invalid' => 'ช่อง \'นาที\' ในส่วนของ \'ระยะเวลา\' ต้องเป็นตัวเลขเท่านั้น !',
	'file_too_large' => 'ขนาดภาพใหญ่เกิน %d Kb !',
	'non_valid_extension' => 'รูปแบบไฟล์รูปภาพไม่ถูกต้อง !',
	'delete_event_failed' => 'ไม่สามารถลบรายการกิจกรรมนี้ได้',
	'approve_event_failed' => 'ยังไม่มีการยืนยันกิจกรรมนี้',
	'no_events' => 'ไม่มีรายการกิจกรรม !',
	'move_image_failed' => 'ไม่สามารถอัพโหลดรูปภาพได้ !',
	'non_valid_dimensions' => 'ขนาดภาพกว้าง หรือสูงเกิน %s พิกเซล !',
	'recur_val_1_invalid' => 'ค่าที่ระบุในส่วน \'แสดงซ้ำทุกๆ\' ต้องมากกว่า \'0\' !',
	'recur_end_count_invalid' => 'ค่าที่ระบุในส่วน \'สิ้นสุดหลังจาก\' ต้องมากกว่า \'0\' !',
	'recur_end_until_invalid' => 'วันที่ที่ระบุในส่วน \'แสดงซ้ำจนถึงวันที่\' ต้องมากกว่าวันเริ่มต้น !'
);

// ======================================================
// admin_categories.php
// ======================================================

if (defined('ADMIN_CATS_PHP')) 

$lang_cat_admin_data = array(
	'section_title' => 'จัดการหมวดกิจกรรม',
	'add_cat' => 'เพิ่มหมวดกิจกรรม',
	'edit_cat' => 'แก้ไขหมวดกิจกรรม',
	'update_cat' => 'ปรับปรุงหมวดกิจกรรม',
	'delete_cat' => 'ลบหมวดกิจกรรม',
	'events_label' => 'กิจกรรม',
	'visibility' => 'แสดง',
	'actions_label' => 'Actions',
	'users_label' => 'ผู้ใช้งาน',
	'admins_label' => 'Admins',
// General Info
	'general_info_label' => 'รายละเอียดทั่วไป',
	'cat_name' => 'ชื่อหมวด',
	'cat_desc' => 'รายละเอียด',
	'cat_color' => 'สี',
	'pick_color' => 'เลือกสี!',
	'status_label' => 'สถานะ',
// Administrative Options
	'admin_label' => 'ส่วนของผู้ดูแลระบบ',
	'auto_admin_appr' => 'ยืนยันกิจกรรมของผู้ดูแลระบบโดยอัตโนมัติ',
	'auto_user_appr' => 'ยืนยันกิจกรรมของผู้ใช้งานโดยอัตโนมัติ',
// Stats
	'stats_string1' => '<strong>%d</strong> หมวด',
	'stats_string2' => 'แสดง: <strong>%d</strong>&nbsp;&nbsp;&nbsp;Total: <strong>%d</strong>&nbsp;&nbsp;&nbsp;on <strong>%d</strong> page(s)',
// Misc.
	'add_cat_success' => 'เพิ่มหมวดกิจกรรมเรียบร้อยแล้ว',
	'edit_cat_success' => 'ปรับปรุงหมวดกิจกรรมเรียบร้อยแล้ว',
	'delete_confirm' => 'ต้องการลบหมวดกิจกรรมนี้หรือไม่ ?',
	'delete_cat_success' => 'ลบหมวดกิจกรรมเรียบร้อยแล้ว',
	'active_label' => 'แสดง',
	'not_active_label' => 'ไม่แสดง',
// Error messages
	'no_cat_name' => 'ต้องระบุชื่อหมวดกิจกรรม !',
	'no_cat_desc' => 'ต้องระบุรายละเอียดหมวดกิจกรรม !',
	'no_color' => 'ต้องระบุสีสำหรับหมวดกิจกรรม !',
	'delete_cat_failed' => 'ไม่สามารถลบหมวดกิจกรรมนี้ได้',
	'no_cats' => 'ไม่มีหมวดกิจกรรม !',
	'cat_has_events' => 'ไม่สามารถลบได้ เพราะหมวดกิจกรรมนี้มีรายการอยู่ %d กิจกรรม!<br>ต้องลบรายการกิจกรรมออกก่อน จึงจะลบหมวดกิจกรรมได้!'

);
// ======================================================
// admin_users.php
// ======================================================

if (defined('ADMIN_USERS_PHP')) 

$lang_user_admin_data = array(
	'section_title' => 'การจัดการผู้ใช้งาน',
	'add_user' => 'เพิ่มผู้ใช้งานใหม่',
	'edit_user' => 'แก้ไขรายละเอียดผู้ใช้งาน',
	'update_user' => 'ปรับปรุงบัญชีผู้ใช้งาน',
	'delete_user' => 'ลบบัญชีผู้ใช้งาน',
	'last_access' => 'เข้าครั้งสุดท้าย',
	'actions_label' => 'Actions',
	'active_label' => 'แสดง',
	'not_active_label' => 'ไม่แสดง',
// Account Info
	'account_info_label' => 'รายละเอียดบัญชี',
	'user_name' => 'ชื่อผู้ใช้งาน',
	'user_pass' => 'รหัสผ่าน',
	'user_pass_confirm' => 'ยืนยันรหัสผ่าน',
	'user_email' => 'อีเมล์',
	'group_label' => 'กลุ่มผู้ใช้งาน',
	'status_label' => 'สถานะ',
// Other Details
	'other_details_label' => 'รายละเอียดอื่นๆ',
	'first_name' => 'ชื่อ',
	'last_name' => 'นามสกุล',
	'user_website' => 'เว็บไซต์',
	'user_location' => 'ที่อยู่',
	'user_occupation' => 'อาชีพ',
// Stats
	'stats_string1' => '<strong>%d</strong> ผู้ใช้งาน',
	'stats_string2' => '<strong>%d</strong> ผู้ใช้งาน จำนวน <strong>%d</strong> หน้า',
// Misc.
	'select_group' => 'เลือกรายการ...',
	'add_user_success' => 'เพิ่มบัญชีผู้ใช้งานเรียบร้อยแล้ว',
	'edit_user_success' => 'ปรับปรุงบัญชีผู้ใช้งานเรียบร้อยแล้ว',
	'delete_confirm' => 'ต้องการลบบัญชีผู้ใช้งานนี้หรือไม่ ?',
	'delete_user_success' => 'ลบบัญชีผู้ใช้งานเรียบร้อยแล้ว',
	'update_pass_info' => 'หากไม่ต้องการแก้ไขรหัสผ่าน ให้เว้นว่างไว้',
	'access_never' => 'ไม่เคย',
// Error messages
	'no_username' => 'ต้องระบุชื่อผู้ใช้งาน !',
	'invalid_username' => 'โปรดระบุชื่อเป็นเฉพาะตัวอักษรหรือตัวเลข จำนวน 4 ถึง 30 ตัวอักษร !',
	'invalid_password' => 'กรุณาใส่รหัสผ่านเป็นตัวอักษรและตัวเลข 4 ถึง 16 ตัวอักษร !',
	'password_is_username' => 'รหัสผ่านต้องไม่ซ้ำกับชื่อผู้ใช้งาน !',
	'password_not_match' =>'รหัสผ่านไม่ตรงกันกับ \'ยืนยันรหัสผ่าน\'',
	'invalid_email' => 'ต้องระบุอีเมล์ให้ถูกต้อง !',
	'email_exists' => 'อีเมล์นี้มีผู้ใช้งานอยู่แล้ว กรุณาเลือกอีเมล์ใหม่ !',
	'username_exists' => 'ชื่อผู้ใช้งานนี้มีผู้ใช้งานอยู่แล้ว กรุณาเลือกชื่อผู้ใช้งานใหม่ !',
	'no_email' => 'ต้องระบุอีเมล์ !',
	'invalid_email' => 'ต้องระบุอีเมล์ให้ถูกต้อง !',
	'no_password' => 'ต้องระบุรหัสผ่าน !',
	'no_group' => 'เลือกกลุ่มสำหรับผู้ใช้งานนี้ !',
	'delete_user_failed' => 'ไม่สามารถลบผู้ใช้งานนี้ได้',
	'no_users' => 'ไม่มีบัญชีผู้ใช้งาน !'

);

// ======================================================
// admin_groups.php
// ======================================================

if (defined('ADMIN_GROUPS_PHP')) 

$lang_group_admin_data = array(
	'section_title' => 'กลุ่มผู้ใช้งาน',
	'add_group' => 'เพิ่มกลุ่มใหม่',
	'edit_group' => 'แก้ไขกลุ่ม',
	'update_group' => 'ปรับปรุงรายละเอียดกลุ่ม',
	'delete_group' => 'ลบกลุ่ม',
	'view_group' => 'ดูกลุ่ม',
	'users_label' => 'สมาชิก',
	'actions_label' => 'Actions',
// General Info
	'general_info_label' => 'รายละเอียดทั่วไป',
	'group_name' => 'ชื่อกลุ่ม',
	'group_desc' => 'รายละเอียด',
// Group Access Level
	'access_level_label' => 'ระดับการเข้าถึง',
	'Administrator' => 'เฉพาะผู้ดูแลระบบ จึงจะสามารถทำรายการได้',
	'can_manage_accounts' => 'กลุ่มผู้ใช้งานนี้ สามารถจัดการบัญชีผู้ใช้งานได้',
	'can_change_settings' => 'กลุ่มผู้ใช้งานนี้ สามารถแก้ไขปฏิทินได้',
	'can_manage_cats' => 'กลุ่มผู้ใช้งานนี้ สามารถจัดการหมวดกิจกรรมได้',
	'upl_need_approval' => 'การส่งรายการกิจกรรมต้องมีการยืนยันจากผู้ดูแลระบบ',
// Stats
	'stats_string1' => '<strong>%d</strong> กลุ่ม',
	'stats_string2' => 'ทั้งหมด: <strong>%d</strong> กลุ่ม จำนวน <strong>%d</strong> หน้า',
	'stats_string3' => 'ทั้งหมด: <strong>%d</strong> ผู้ใช้งาน จำนวน <strong>%d</strong> หน้า',
// View Group Members
	'group_members_string' => 'สมาชิกกลุ่ม \'%s\' ',
	'username_label' => 'ชื่อผู้ใช้งาน',
	'firstname_label' => 'ชื่อ',
	'lastname_label' => 'นามสกุล',
	'email_label' => 'อีเมล์',
	'last_access_label' => 'เข้าครั้งสุดท้าย',
	'edit_user' => 'แก้ไขผู้ใช้งาน',
	'delete_user' => 'ลบผู้ใช้งาน',
// Misc.
	'add_group_success' => 'เพิ่มกลุ่มเรียบร้อยแล้ว',
	'edit_group_success' => 'ปรับปรุงกลุ่มเรียบร้อยแล้ว',
	'delete_confirm' => 'ต้องการลบกลุ่มนี้หรือไม่ ?',
	'delete_user_confirm' => 'ต้องการลบผู้ใช้งานนี้หรือไม่ ?',
	'delete_group_success' => 'ลบกลุ่มเรียบร้อยแล้ว',
	'no_users_string' => 'ไม่มีผู้ใช้งานในกลุ่มนี้',
// Error messages
	'no_group_name' => 'ต้องระบุชื่อกลุ่ม !',
	'no_group_desc' => 'ต้องระบุรายละเอียดกลุ่ม !',
	'delete_group_failed' => 'ไม่สามารถลบกลุ่มนี้ได้',
	'no_groups' => 'ไม่มีกลุ่มให้แสดง !',
	'group_has_users' => 'ไม่สามารถลบได้ เพราะกลุ่มนี้มีผู้ใช้งานอยู่ %d ผู้ใช้งาน!<br>ต้องลบผู้ใช้งานออกก่อน จึงจะลบกลุ่มได้!'
);

// ======================================================
// admin_settings.php / admin_settings_template.php / 
// admin_settings_updates.php
// ======================================================

$lang_settings_data = array(
	'section_title' => 'ตั้งค่าปฏิทิน'
// Links
	,'admin_links_text' => 'เลือกรายการ'
	,'admin_links' => array('ตั้งค่าหลัก','การตั้งค่าเทมเพลต','ปรับปรุงสินค้า')
// General Settings
	,'general_settings_label' => 'การตั้งค่าทั่วไป'
	,'calendar_name' => 'ชื่อปฏิทิน'
	,'calendar_description' => 'รายละเีอียด'
	,'calendar_admin_email' => 'อีเมล์ของผู้บริหารปฏิทินกิจกรรม'
	,'cookie_name' => 'ชื่อคุ๊กกี้'
	,'cookie_path' => 'พาธที่เก็บคุ๊กกี้'
	,'debug_mode' => 'แสดงโหมดแก้ไข'
	,'calendar_status' => 'แสดงปฏิทินแบบสาธารณะ'
// Environment Settings
	,'env_settings_label' => 'การตั้งค่าสภาพแวดล้อม'
	,'lang' => 'ภาษา'
		,'lang_name' => 'ภาษา'
		,'lang_native_name' => 'ชื่อพื้นเมือง'
		,'lang_trans_date' => 'แปลเมื่อ'
		,'lang_author_name' => 'ผู้สร้าง'
		,'lang_author_email' => 'อีเมล์'
		,'lang_author_url' => 'เว็บไซต์'
	,'charset' => 'รหัสอักขระ'
	,'theme' => 'ธีม'
		,'theme_name' => 'ชื่อธีม'
		,'theme_date_made' => 'สร้างเมื่อ'
		,'theme_author_name' => 'ผู้สร้าง'
		,'theme_author_email' => 'อีเมล์'
		,'theme_author_url' => 'เว็บไซต์'
	,'timezone' => 'ค่าเหลื่อมเวลา'
	,'time_format' => 'รูปแบบการแสดงเวลา'
		,'24hours' => '24 ชั่วโมง'
		,'12hours' => '12 ชั่วโมง'
	,'auto_daylight_saving' => 'ตั้งค่า Daylight Saving Time (DST) แบบอัตโนมัติ'
	,'main_table_width' => 'ความกว้างของตารางหลัก (พิกเซล หรือ %)'
	,'day_start' => 'วันเริ่มต้นสัปดาห์'
	,'default_view' => 'แสดงแบบปกติ'
	,'search_view' => 'แสดงการค้นหา'
	,'archive' => 'แสดงกิจกรรมที่ผ่านมา'
	,'events_per_page' => 'จำนวนกิจกรรมต่อหน้า'
	,'sort_order' => 'การเรียงลำดับ'
		,'sort_order_title_a' => 'เรียงตามหัวข้อ ก-ฮ'
		,'sort_order_title_d' => 'เรียงตามหัวข้อ ฮ-ก'
		,'sort_order_date_a' => 'เรียงตามวันที่น้อยไปหามาก'
		,'sort_order_date_d' => 'เรียงตามวันที่มากมาหาน้อย'
	,'show_recurrent_events' => 'แสดงกิจกรรมที่เกิดซ้ำ'
	,'multi_day_events' => 'กิจกรรมแบบหลายวัน'
		,'multi_day_events_all' => 'แสดงทุกช่วงกิจกรรม'
		,'multi_day_events_bounds' => 'แสดงวันเริ่มต้น & และวันสินสุดกิจกรรม'
		,'multi_day_events_start' => 'แสดงเฉพาะวันเริ่มต้นกิจกรรม'
	// User Settings
	,'user_settings_label' => 'การตั้งค่าผู้ใช้งาน'
	,'allow_user_registration' => 'อนุญาตให้ผู้ใช้ลงทะเบียน'
	,'reg_duplicate_emails' => 'ห้ามมีอีเมล์ซ้ำกัน'
	,'reg_email_verify' => 'ใช้การยืนยันลงทะเบียน'
// Event View
	,'event_view_label' => 'แสดงกิจกรรม'
	,'popup_event_mode' => 'แสดงแบบหน้าต่างป๊อบอัพ'
	,'popup_event_width' => 'ความกว้างของหน้าต่างป๊อบอัพ'
	,'popup_event_height' => 'ความสูงของหน้าต่างป๊อบอัพ'
// Add Event View
	,'add_event_view_label' => 'เพิ่มกิจกรรม'
	,'add_event_view' => 'แสดง'
	,'addevent_allow_html' => 'ใช้ <b>BB Code</b> ในส่วนรายละเอียด'
	,'addevent_allow_contact' => 'แสดงรายละเอียดการติดต่อ'
	,'addevent_allow_email' => 'แสดงอีเมล์'
	,'addevent_allow_url' => 'แสดงเว็บไซต์'
	,'addevent_allow_picture' => 'แสดงรูปภาพ'
	,'new_post_notification' => 'ใช้การยืนยันการเพิ่มกิจกรรมใหม่'
// Calendar View
	,'calendar_view_label' => 'แสดงแบบปฏิทิน'
	,'monthly_view' => 'แสดงแบบรายเดือน'
	,'cal_view_show_week' => 'แสดงเลขสัปดาห์'
	,'cal_view_max_chars' => 'จำนวนตัวอักษรสูงสุด'
// Flyer View
	,'flyer_view_label' => 'Flyer View'
	,'flyer_view' => 'แสดง'
	,'flyer_show_picture' => 'แสดงรูปภาพใน Flyer View'
	,'flyer_view_max_chars' => 'จำนวนตัวอักษรสูงสุด'
// Weekly View
	,'weekly_view_label' => 'แสดงแบบรายสัปดาห์'
	,'weekly_view' => 'แสดง'
	,'weekly_view_max_chars' => 'จำนวนตัวอักษรสูงสุด'
// Daily View
	,'daily_view_label' => 'แสดงแบบรายวัน'
	,'daily_view' => 'แสดง'
	,'daily_view_max_chars' => 'จำนวนตัวอักษรสูงสุด'
// Categories View
	,'categories_view_label' => 'แสดงแบบหมวด'
	,'cats_view' => 'แสดง'
	,'cats_view_max_chars' => 'จำนวนตัวอักษรสูงสุด'
// Mini Calendar
	,'mini_cal_label' => 'ปฏิทินจิ๋ว'
	,'mini_cal_def_picture' => 'รูปภาพปกติ'
	,'mini_cal_display_picture' => 'แสดงรูปภาพ'
	,'mini_cal_diplay_options' => array('ไม่แสดง','ภาพปกติ', 'ภาพรายวัน','ภาพรายสัปดาห์','ภาพสุ่ม')
// Mail Settings
	,'mail_settings_label' => 'ตั้งค่าอีเมล์'
	,'mail_method' => 'รูปแบบการส่งเมล์'
	,'mail_smtp_host' => 'SMTP Hosts (แยกด้วยเครื่องหมาย ;)'
	,'mail_smtp_auth' => ' SMTP Authentication'
	,'mail_smtp_username' => 'SMTP Username'
	,'mail_smtp_password' => 'SMTP Password'

// Picture Settings
	,'picture_settings_label' => 'ตั้งค่้ารูปภาพ'
	,'max_upl_dim' => 'ขนาดกว้างสุดหรือสูงสุดสำหรับรูปภาพที่จะอัพโหลด'
	,'max_upl_size' => 'ขนาดสูงสุดสำหรับรูปภาพที่จะอัพโหลด (ไบต์)'
	,'picture_chmod' => 'โหมดปกติสำหรับรูปภาพ (CHMOD)'
	,'allowed_file_extensions' => 'ประเภทไฟล์ของรูปภาพที่จะอัพโหลด'
// Form Buttons
	,'update_config' => 'บันทึกการตั้งค่าใหม่'
	,'restore_config' => 'ใช้้ค่าเดิมของระบบ'
// Misc.
	,'update_settings_success' => 'การตั้งค่าเรียบร้อยแล้ว'
	,'restore_default_confirm' => 'ต้องการใช้ค่าเดิมของระบบหรือไม่ ?'
// Template Configuration
	,'template_type' => 'ประเภทเทมเพลต'
	,'template_header' => 'แก้ไข Header'
	,'template_footer' => 'แก้ไข Footer'
	,'template_status_default' => 'ใช้เทมเพลตปกติ'
	,'template_status_custom' => 'ใช้เทมเพลต:'
	,'template_custom' => 'กำหนดเอง'

	,'info_meta' => 'รายละเอียดเมต้า'
	,'info_status' => 'สถานะ'
	,'info_status_default' => 'ไม่แสดงบทความ'
	,'info_status_custom' => 'แสดงบทความ:'
	,'info_custom' => 'รายละเอียด'

	,'dynamic_tags' => 'ไดนามิคแท็ก'

// Product Updates
	,'updates_check_text' => 'กรุณารอซักครู่ กำลังทำรายการ...'
	,'updates_no_response' => 'ทำรายการไม่ได้ กรุณาลองใหม่อีกครั้ง'
	,'avail_updates' => 'อัพเดทล่าสุด'
	,'updates_download_zip' => 'ดาวน์โหลด ZIP แพ็คเก็จ (.zip)'
	,'updates_download_tgz' => 'ดาวน์โหลด TGZ แพ็คเก็จ (.tar.gz)'
	,'updates_released_label' => 'วันที่ปรับปรุง: %s'
	,'updates_no_update' => 'คุณกำลังใช้งานเวอร์ชั่นล่าสุด ไม่จำเป็นต้องอัพเดท'
);

// ======================================================
// cal_mini.inc.php
// ======================================================

$lang_mini_cal = array(
	'def_pic' => 'ภาพปกติ'
	,'daily_pic' => 'ภาพประจำวันที่ (%s)'
	,'weekly_pic' => 'ภาพประจำสัปดาห์ที่ (%s)'
	,'rand_pic' => 'ภาพสุ่ม (%s)'
	,'post_event' => 'เพิ่มกิจกรรมใหม่'
	,'num_events' => '%d กิจกรรม'
	,'selected_week' => 'สัปดาห์ที่ %d'
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
	'section_title' => 'เข้าสู่ระบบ'
// General Settings
	,'login_intro' => 'ใส่ชื่อผู้ใช้งาน และรหัสผ่านเพื่อเข้าสู่ระบบ'
	,'username' => 'ชื่อผู้ใช้งาน'
	,'password' => 'รหัสผ่าน'
	,'remember_me' => 'จำข้อมูลการล็อกอิน'
	,'login_button' => 'เข้าสู่ระบบ'
// Errors
	,'invalid_login' => 'กรุณาลองใหม่อีกครั้ง !'
	,'no_username' => 'ต้องระบุชื่อผู้ใช้งาน !'
	,'already_logged' => 'คุณเข้าสู่ระบบแล้ว !'
);

// ======================================================
// logout.php
// ======================================================

// To Be Done


?>