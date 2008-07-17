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

Revision date: 03/07/2007

**********************************************
Get the latest version of JCal Pro at:
http://dev.anything-digital.com//
**********************************************
*/

/** ensure this file is being included by a parent file */
defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );

// New language structure
$lang_info = array (
	'name' => 'English'
	,'nativename' => 'English' // Language name in native language. E.g: 'Français' for 'French'
	,'locale' => array('en','english','en_US','en_US.ISO8859-15') // Standard locale alternatives for a specific language. For reference, go to: http://www.php.net/manual/en/function.setlocale.php
	,'charset' => 'ISO-8859-1' // For reference, go to : http://www.w3.org/International/O-charset-lang.html
	,'direction' => 'ltr' // 'ltr' for Left to Right. 'rtl' for Right to Left languages such as Arabic.
	,'author' => 'Mohamed Moujami (Simo)'
	,'author_email' => 'simoami@hotmail.com'
	,'author_url' => 'http://www.MarocTour.com'
	,'transdate' => '04/17/2004'
);

$lang_general = array (
	'yes' => 'Yes'
	,'no' => 'No'
	,'back' => 'Back'
	,'continue' => 'Continue'
	,'close' => 'Close'
	,'errors' => 'Errors'
	,'info' => 'Information'
	,'day' => 'Day'
	,'days' => 'Days'
	,'month' => 'Month'
	,'months' => 'Months'
	,'year' => 'Year'
	,'years' => 'Years'
	,'hour' => 'Hour'
	,'hours' => 'Hours'
	,'minute' => 'Minute'
	,'minutes' => 'Minutes'
	,'everyday' => 'Every Day'
	,'everymonth' => 'Every Month'
	,'everyyear' => 'Every Year'
	,'active' => 'Active'
	,'not_active' => 'Not Active'
	,'today' => 'Today'
	,'signature' => 'Powered by %s'
	,'expand' => 'Expand'
	,'collapse' => 'Collapse'
);

// Date formats, For reference, go to : http://www.php.net/manual/en/function.strftime.php
$lang_date_format = array (
	'full_date' => '%A, %B %d, %Y' // e.g. Wednesday, June 05, 2002
	,'full_date_time_24hour' => '%A, %B %d, %Y At %H:%M' // e.g. Wednesday, June 05, 2002 At 21:05
	,'full_date_time_12hour' => '%A, %B %d, %Y At %H:%M ' // e.g. Wednesday, June 05, 2002 At 9:05 pm
	,'day_month_year' => '%d-%b-%Y' // e.g 10-Sep-2004
	,'local_date' => '%c' // Preferred date and time representation for current language 
	,'mini_date' => '%a. %d %b, %Y' 
	,'month_year' => '%B %Y'
	,'day_of_week' => array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday')
	,'months' => array('January','February','March','April','May','June','July','August','September','October','November','December')
);

$lang_system = array (
	'system_caption' => 'System Message'
  ,'page_access_denied' => 'You don\'t have enough privileges to access this option.'
  ,'page_requires_login' => 'You must be logged in to access this page.'
  ,'operation_denied' => 'You don\'t have enough privileges to perform this operation.'
	,'section_disabled' => 'This section is currently disabled !'
  ,'non_exist_cat' => 'The selected category does not exist !'
  ,'non_exist_event' => 'The selected event does not exist !'
  ,'param_missing' => 'The provided parameters are incorrect.'
  ,'no_events' => 'There are no events to display'
  ,'config_string' => 'You are currently using \'%s\' running on %s, %s and %s.'
  ,'no_table' => 'The \'%s\' table does not exist !'
  ,'no_anonymous_group' => 'The %s table does not contain the \'Anonymous\' group !'
  ,'calendar_locked' => 'This service is temporarily down for maintenance and upgrades. We apologize for the inconvenience !'
	,'new_upgrade' => 'The system has detected a new version. It is recommended to perform the upgrade now. Click "Continue" to launch the upgrade tool.'
	,'no_profile' => 'An error occurred while retrieving your profile information'
	,'unknown_component' => 'Unknown component'
// Mail messages
	,'new_event_subject' => 'Event Needs Approval at %s'
	,'event_notification_failed' => 'An error occurred while trying to send a notification email !'
);

// Message body for new event email notification
$lang_system['event_notification_body'] = <<<EOT
The following event has just been posted on your {CALENDAR_NAME}
and requires approval:

Title: "{TITLE}"
Date: "{DATE}"
Duration: "{DURATION}"

You can access this event by clicking the link below 
or copy and paste it in your web browser.

{LINK}

(NOTE that you must be logged in as an Administrator for
the link to work.)

Regards,

The management of {CALENDAR_NAME}

EOT;

// Admin menu entries
$lang_admin_menu = array (
	'login' => 'Login'
	,'register' => 'Register'
  ,'logout' => 'Logout <span style="color:#FF9922">[<span style="color:#606F79">%s</span>]</span>'
  ,'user_profile' => 'My Profile'
	,'admin_events' => 'Events'
  ,'admin_categories' => 'Categories'
  ,'admin_groups' => 'Groups'
  ,'admin_users' => 'Users'
  ,'admin_settings' => 'Settings'
);

// Main menu entries
$lang_main_menu = array (
	'add_event' => 'Add Event'
	,'cal_view' => 'Monthly View'
  ,'flat_view' => 'Flat View'
  ,'weekly_view' => 'Weekly View'
  ,'daily_view' => 'Daily View'
  ,'yearly_view' => 'Yearly View'
  ,'categories_view' => 'Categories'
  ,'search_view' => 'Search'
);

// ======================================================
// Add Event view
// ======================================================

$lang_add_event_view = array(
	'section_title' => 'Add Event'
	,'edit_event' => 'Edit event [id%d] \'%s\''
	,'update_event_button' => 'Update Event'

// Event details
	,'event_details_label' => 'Event Details'
	,'event_title' => 'Event Title'
	,'event_desc' => 'Event Description'
	,'event_cat' => 'Category'
	,'choose_cat' => 'Select a category'
	,'event_date' => 'Event Date'
	,'day_label' => 'Day'
	,'month_label' => 'Month'
	,'year_label' => 'Year'
	,'start_date_label' => 'Start Time'
	,'start_time_label' => 'At'
	,'end_date_label' => 'Duration'
	,'all_day_label' => 'All Day'
// Contact details
	,'contact_details_label' => 'Contact Details'
	,'contact_info' => 'Contact Info'
	,'contact_email' => 'Email'
	,'contact_url' => 'URL'
// Repeat events
	,'repeat_event_label' => 'Repeat Event'
	,'repeat_method_label' => 'Repeat Method'
	,'repeat_none' => 'Don\'t repeat this event'
	,'repeat_every' => 'Repeat every'
	,'repeat_days' => 'Day(s)'
	,'repeat_weeks' => 'Week(s)'
	,'repeat_months' => 'Month(s)'
	,'repeat_years' => 'Year(s)'
	,'repeat_end_date_label' => 'Repeat End Date'
	,'repeat_end_date_none' => 'No end date'
	,'repeat_end_date_count' => 'End after %s occurrence(s)'
	,'repeat_end_date_until' => 'Repeat until'
// Other details
	,'other_details_label' => 'Other Details'
	,'picture_file' => 'Picture File'
	,'file_upload_info' => '(%d KBytes limit - Valid extensions : %s )' 
	,'del_picture' => 'Delete current picture ?'
// Administrative options
	,'admin_options_label' => 'Administrative Options'
	,'auto_appr_event' => 'Event Approved'

// Error messages
	,'no_title' => 'You must provide an event title !'
	,'no_desc' => 'You must provide an description for this event !'
	,'no_cat' => 'You must select a category from the drop down menu !'
	,'date_invalid' => 'You must provide a valid date for this event !'
	,'end_days_invalid' => 'The value entered in the \'Days\' field is not valid !'
	,'end_hours_invalid' => 'The value entered in the \'Hours\' field is not valid !'
	,'end_minutes_invalid' => 'The value entered in the \'Minutes\' field is not valid !'
	,'move_image_failed' => 'The system failed to properly upload the image. Please make sure it is the proper type and not too large, or notify the site administrator.'
	,'non_valid_dimensions' => 'The picture width or height is larger than %s pixels !'

	,'recur_val_1_invalid' => 'The value entered as \'repeat interval\' is not valid. This value must be a number greater than \'0\' !'
	,'recur_end_count_invalid' => 'The value entered as \'number of occurrences\' is not valid. This value must be a number greater than \'0\' !'
	,'recur_end_until_invalid' => 'The \'repeat until\' date must be greater than the event start date !'
// Misc. messages
	,'submit_event_pending' => 'Your event has been submitted! However, it will NOT appear on the calendar until it receives administrator approval. Thank you for your submission!'
	,'submit_event_approved' => 'Your event is automatically approved. Thank you for your submission!'
	,'event_repeat_msg' => 'This event is set to repeat'
	,'event_no_repeat_msg' => 'This event does not repeat'
);

// ======================================================
// daily view
// ======================================================

$lang_daily_event_view = array(
	'section_title' => 'Daily View'
	,'next_day' => 'Next Day'
	,'previous_day' => 'Previous Day'
	,'no_events' => 'There are no events on this day.'
);

// ======================================================
// weekly view
// ======================================================

$lang_weekly_event_view = array(
	'section_title' => 'Weekly View'
	,'week_period' => '%s - %s'
	,'next_week' => 'Next Week'
	,'previous_week' => 'Previous Week'
	,'selected_week' => 'Week %d'
	,'no_events' => 'There are no events on this week'
);

// ======================================================
// monthly view
// ======================================================

$lang_monthly_event_view = array(
	'section_title' => 'Monthly View'
	,'next_month' => 'Next Month'
	,'previous_month' => 'Previous Month'
);

// ======================================================
// flat view
// ======================================================

$lang_flat_event_view = array(
	'section_title' => 'Flat View'
	,'week_period' => '%s - %s'
	,'next_month' => 'Next Month'
	,'previous_month' => 'Previous Month'
	,'contact_info' => 'Contact Info'
	,'contact_email' => 'Email'
	,'contact_url' => 'URL'
	,'no_events' => 'There are no events on this month'
);

// ======================================================
// Event view
// ======================================================

$lang_event_view = array(
	'section_title' => 'Event View'
	,'display_event' => 'Event: \'%s\''
	,'cat_name' => 'Category'
	,'event_start_date' => 'Date'
	,'event_end_date' => 'Until'
	,'event_duration' => 'Duration'
	,'contact_info' => 'Contact Info'
	,'contact_email' => 'Email'
	,'contact_url' => 'URL'
	,'no_event' => 'There are no events to display.'
	,'stats_string' => '<strong>%d</strong> Events as Total'
	,'edit_event' => 'Edit Event'
	,'delete_event' => 'Delete Event'
	,'delete_confirm' => 'Are you sure you want to delete this event ?'
	
);

// ======================================================
// Categories view
// ======================================================

$lang_cats_view = array(
	'section_title' => 'Categories View'
	,'cat_name' => 'Category Name'
	,'total_events' => 'Total Events'
	,'upcoming_events' => 'Upcoming Events'
	,'no_cats' => 'There are no categories to display.'
	,'stats_string' => 'There are <strong>%d</strong> Events in <strong>%d</strong> Categories'
);

// ======================================================
// Category Events view
// ======================================================

$lang_cat_events_view = array(
	'section_title' => 'Events under \'%s\''
	,'event_name' => 'Event Name'
	,'event_date' => 'Date'
	,'no_events' => 'There are no events under this category.'
	,'stats_string' => '<strong>%d</strong> Events as Total'
	,'stats_string1' => '<strong>%d</strong> Event(s) in <strong>%d</strong> page(s)'
);

// ======================================================
// cal_search.php
// ======================================================

$lang_event_search_data = array(
	'section_title' => 'Search Calendar',
	'search_results' => 'Search Results',
	'category_label' => 'Category',
	'date_label' => 'Date',
	'no_events' => 'There are no events under this category.',
	'search_caption' => 'Type in some keywords...',
	'search_again' => 'Search Again',
	'search_button' => 'Search',
// Misc.
	'no_results' => 'No results found',	
// Stats
	'stats_string1' => '<strong>%d</strong> event(s) found',
	'stats_string2' => '<strong>%d</strong> Event(s) in <strong>%d</strong> page(s)'
);

// ======================================================
// profile.php
// ======================================================

if (defined('PROFILE_PHP')) 

$lang_user_profile_data = array(
	'section_title' => 'My Profile',
	'edit_profile' => 'Edit My Profile',
	'update_profile' => 'Update My Profile',
	'actions_label' => 'Actions',
// Account Info
	'account_info_label' => 'Account Information',
	'user_name' => 'Username',
	'user_pass' => 'Password',
	'user_pass_confirm' => 'Confirm Password',
	'user_email' => 'E-mail Address',
	'group_label' => 'Group Membership',
// Other Details
	'other_details_label' => 'Other Details',
	'first_name' => 'First Name',
	'last_name' => 'Last Name',
	'full_name' => 'Full Name',
	'user_website' => 'Home page',
	'user_location' => 'Location',
	'user_occupation' => 'Occupation',
// Misc.
	'select_language' => 'Select Language',
	'edit_profile_success' => 'Profile updated succesfully',
	'update_pass_info' => 'Leave the password field empty if you don\'t need to change it',
// Error messages
	'invalid_password' => 'Please enter a password that consists only of letters and numbers, between 4 and 16 characters long !',
	'password_is_username' => 'The password must be different from the username !',
	'password_not_match' =>'The password you entered does not match the \'confirm password\'',
	'invalid_email' => 'You must provide a valid email address !',
	'email_exists' => 'Another user has already registered with the email address you entered. Please enter a different email !',
	'no_email' => 'You must provide an email address !',
	'invalid_email' => 'You must provide a valid email address !',
	'no_password' => 'You must provide a password for this new account !'
);

// ======================================================
// register.php
// ======================================================

if (defined('USER_REGISTRATION_PHP')) 

$lang_user_registration_data = array(
	'section_title' => 'User Registration',
// Step 1: Terms & Conditions
	'terms_caption' => 'Terms and Conditions',
	'terms_intro' => 'In order to proceed, you must agree to the following:',
	'terms_message' => 'Please take a moment to review these rules detailed below. If you agree with them and wish to proceed with the registration, simply click the "I agree" button below. To cancel this registration, simply hit the \'back\' button on your browser.<br /><br />Please remember that we are not responsible for any events posted by users of this calendar application. We do not vouch for or warrant the accuracy, completeness or usefulness of any posted event, and are not responsible for the contents of any event.<br /><br />The messages express the views of the author of the event, not necessarily the views of this calendar application. Any user who feels that a posted event is objectionable is encouraged to contact us immediately by email. We have the ability to remove objectionable content and we will make every effort to do so, within a reasonable time frame, if we determine that removal is necessary.<br /><br />You agree, through your use of this service, that you will not use this calendar application to post any material which is knowingly false and/or defamatory, inaccurate, abusive, vulgar, hateful, harassing, obscene, profane, sexually oriented, threatening, invasive of a person\'s privacy, or otherwise violative of any law.<br /><br />You agree not to post any copyrighted material unless the copyright is owned by you or by %s.',
	'terms_button' => 'I agree',
	
// Account Info
	'account_info_label' => 'Account Information',
	'user_name' => 'Username',
	'user_pass' => 'Password',
	'user_pass_confirm' => 'Confirm Password',
	'user_email' => 'E-mail Address',
// Other Details
	'other_details_label' => 'Other Details',
	'first_name' => 'First Name',
	'last_name' => 'Last Name',
	'user_website' => 'Home page',
	'user_location' => 'Location',
	'user_occupation' => 'Occupation',
	'register_button' => 'Submit my registration',

// Stats
	'stats_string1' => '<strong>%d</strong> users',
	'stats_string2' => '<strong>%d</strong> users on <strong>%d</strong> page(s)',
// Misc.
	'reg_nomail_success' => 'Thank your for registering.',
	'reg_mail_success' => 'An email with information on how to activate your account was sent to the email address your provided.',
	'reg_activation_success' => 'Congratulations! Your account is now active and you can login with your username and password. Thank your for registering.',
// Mail messages
	'reg_confirm_subject' => 'Registration at %s',
	
// Error messages
	'no_username' => 'You must provide a username !',
	'invalid_username' => 'Please enter a username that consists only of letters and numbers, between 4 and 30 characters long !',
	'username_exists' => 'The username you entered is taken. Please suggest a different username !',
	'no_password' => 'You must provide a password !',
	'invalid_password' => 'Please enter a password that consists only of letters and numbers, between 4 and 16 characters long !',
	'password_is_username' => 'The password must be different from the username !',
	'password_not_match' =>'The password you entered does not match the \'confirm password\'',
	'no_email' => 'You must provide an email address !',
	'invalid_email' => 'You must provide a valid email address !',
	'email_exists' => 'Another user has already registered with the email address you entered. Please enter a different email !',
	'delete_user_failed' => 'This user account cannot be deleted',
	'no_users' => 'There are no user accounts to display !',
	'already_logged' => 'You are already logged in as a member !',
	'registration_not_allowed' => 'User registrations are currently disabled !',
	'reg_email_failed' => 'An error occurred while trying to send the activation email !',
	'reg_activation_failed' => 'An error occurred while trying to process the activation !'

);
// Message body for email activation
$lang_user_registration_data['reg_confirm_body'] = <<<EOT
Thank you for registering at {CALENDAR_NAME}

Your username is : "{USERNAME}"
Your password is : "{PASSWORD}"

In order to activate your account, you need to click on the link below
or copy and paste it in your web browser.

{REG_LINK}

Regards,

The management of {CALENDAR_NAME}

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
	'section_title' => 'Event Administration',
	'events_to_approve' => 'Event Administration: Events to Approve',
	'upcoming_events' => 'Event Administration: Upcoming Events',
	'past_events' => 'Event Administration: Past Events',
	'add_event' => 'Add New Event',
	'edit_event' => 'Edit Event',
	'view_event' => 'View Event',
	'approve_event' => 'Approve Event',
	'update_event' => 'Update Event Info',
	'delete_event' => 'Delete Event',
	'events_label' => 'Events',
	'auto_approve' => 'Auto Approve',
	'date_label' => 'Date',
	'actions_label' => 'Actions',
	'events_filter_label' => 'Filter Events',
	'events_filter_options' => array('Show all events','Show unapproved events only','Show upcoming events only','Show past events only'),
	'picture_attached' => 'Picture attached',
// View Event
	'view_event_name' => 'Event: \'%s\'',
	'event_start_date' => 'Date',
	'event_end_date' => 'Until',
	'event_duration' => 'Duration',
	'contact_info' => 'Contact Info',
	'contact_email' => 'Email',
	'contact_url' => 'URL',
// General Info
// Event form
	'edit_event_title' => 'Event: \'%s\'',
	'cat_name' => 'Category',
	'event_start_date' => 'Date',
	'event_end_date' => 'Until',
	'contact_info' => 'Contact Info',
	'contact_email' => 'Email',
	'contact_url' => 'URL',
	'no_event' => 'There are no events to display.',
	'stats_string' => '<strong>%d</strong> Events as Total',
// Stats
	'stats_string1' => '<strong>%d</strong> event(s)',
	'stats_string2' => 'Total: <strong>%d</strong> events on <strong>%d</strong> page(s)',
// Misc.
	'add_event_success' => 'New event added succesfully',
	'edit_event_success' => 'Event updated succesfully',
	'approve_event_success' => 'Event approved succesfully',
	'delete_confirm' => 'Are you sure you want to delete this event ?',
	'delete_event_success' => 'Event deleted succesfully',
	'active_label' => 'Active',
	'not_active_label' => 'Not Active',
// Error messages
	'no_event_name' => 'You must provide a name for this event !',
	'no_event_desc' => 'You must provide a description for this event !',
	'no_cat' => 'You must select a category for this event !',
	'no_day' => 'You must select a day !',
	'no_month' => 'You must select a month !',
	'no_year' => 'You must select a year !',
	'non_valid_date' => 'Please enter a valid date !',
	'end_days_invalid' => 'Please make sure the \'Days\' field under \'Duration\' consists of numbers only !',
	'end_hours_invalid' => 'Please make sure the \'Hours\' field under \'Duration\' consists of numbers only !',
	'end_minutes_invalid' => 'Please make sure the \'Minutes\' field under \'Duration\' consists of numbers only !',
	'delete_event_failed' => 'This event cannot be deleted',
	'approve_event_failed' => 'This event cannot not be approved',
	'no_events' => 'There are no events to display !',
	'recur_val_1_invalid' => 'The value entered as \'repeat interval\' is not valid. This value must be a number greater than \'0\' !',
	'recur_end_count_invalid' => 'The value entered as \'number of occurrences\' is not valid. This value must be a number greater than \'0\' !',
	'recur_end_until_invalid' => 'The \'repeat until\' date must be greater than the event start date !'

);

// ======================================================
// admin_categories.php
// ======================================================

if (defined('ADMIN_CATS_PHP')) 

$lang_cat_admin_data = array(
	'section_title' => 'Category Administration',
	'add_cat' => 'Add New Category',
	'edit_cat' => 'Edit Category',
	'update_cat' => 'Update Category Info',
	'delete_cat' => 'Delete Category',
	'events_label' => 'Events',
	'visibility' => 'Visibility',
	'actions_label' => 'Actions',
	'users_label' => 'Users',
	'admins_label' => 'Admins',
// General Info
	'general_info_label' => 'General Information',
	'cat_name' => 'Category Name',
	'cat_desc' => 'Category Description',
	'cat_color' => 'Color',
	'pick_color' => 'Pick a Color!',
	'status_label' => 'Status',
	'category_label' => 'Category permissions',
// Stats
	'stats_string1' => '<strong>%d</strong> categories',
	'stats_string2' => 'Active: <strong>%d</strong>&nbsp;&nbsp;&nbsp;Total: <strong>%d</strong>&nbsp;&nbsp;&nbsp;on <strong>%d</strong> page(s)',
// Misc.
	'add_cat_success' => 'New category added succesfully',
	'edit_cat_success' => 'Category updated succesfully',
	'delete_confirm' => 'Are you sure you want to delete this category ?',
	'delete_cat_success' => 'Category deleted succesfully',
	'active_label' => 'Active',
	'not_active_label' => 'Not Active',
// Error messages
	'no_cat_name' => 'You must provide a name for this category !',
	'no_cat_desc' => 'You must provide a description for this category !',
	'no_color' => 'You must provide a color for this category !',
	'delete_cat_failed' => 'This category cannot be deleted',
	'no_cats' => 'There are no categories to display !',
	'cat_has_events' => 'This category contains %d event(s) and therefore cannot be deleted!<br>Please delete remaining events under this category and try again!',
	'default' => 'Use default from settings'

);
// ======================================================
// admin_users.php
// ======================================================

if (defined('ADMIN_USERS_PHP')) 

$lang_user_admin_data = array(
	'section_title' => 'User Administration',
	'add_user' => 'Add New User',
	'edit_user' => 'Edit User Info',
	'update_user' => 'Update User Info',
	'delete_user' => 'Delete User Account',
	'last_access' => 'Last Access',
	'actions_label' => 'Actions',
	'active_label' => 'Active',
	'not_active_label' => 'Not Active',
// Account Info
	'account_info_label' => 'Account Information',
	'user_name' => 'Username',
	'user_pass' => 'Password',
	'user_pass_confirm' => 'Confirm Password',
	'user_email' => 'E-mail Address',
	'group_label' => 'Group Membership',
	'status_label' => 'Account Status',
// Other Details
	'other_details_label' => 'Other Details',
	'first_name' => 'First Name',
	'last_name' => 'Last Name',
	'user_website' => 'Home page',
	'user_location' => 'Location',
	'user_occupation' => 'Occupation',
// Stats
	'stats_string1' => '<strong>%d</strong> users',
	'stats_string2' => '<strong>%d</strong> users on <strong>%d</strong> page(s)',
// Misc.
	'select_group' => 'Select one...',
	'add_user_success' => 'User account added succesfully',
	'edit_user_success' => 'User account updated succesfully',
	'delete_confirm' => 'Are you sure you want to delete this account?',
	'delete_user_success' => 'User account deleted succesfully',
	'update_pass_info' => 'Leave the password field empty if you don\'t need to change it',
	'access_never' => 'Never',
// Error messages
	'no_username' => 'You must provide a username !',
	'invalid_username' => 'Please enter a username that consists only of letters and numbers, between 4 and 30 characters long !',
	'invalid_password' => 'Please enter a password that consists only of letters and numbers, between 4 and 16 characters long !',
	'password_is_username' => 'The password must be different from the username !',
	'password_not_match' =>'The password you entered does not match the \'confirm password\'',
	'invalid_email' => 'You must provide a valid email address !',
	'email_exists' => 'Another user has already registered with the email address you entered. Please enter a different email !',
	'username_exists' => 'The username you entered is taken. Please suggest a different username !',
	'no_email' => 'You must provide an email address !',
	'invalid_email' => 'You must provide a valid email address !',
	'no_password' => 'You must provide a password for this new account !',
	'no_group' => 'Please select a group of membership for this user !',
	'delete_user_failed' => 'This user account cannot be deleted',
	'no_users' => 'There are no user accounts to display !'

);

// ======================================================
// admin_groups.php
// ======================================================

if (defined('ADMIN_GROUPS_PHP')) 

$lang_group_admin_data = array(
	'section_title' => 'Group Administration',
	'add_group' => 'Add New Group',
	'edit_group' => 'Edit Group',
	'update_group' => 'Update Group Info',
	'delete_group' => 'Delete Group',
	'view_group' => 'View Group',
	'users_label' => 'Members',
	'actions_label' => 'Actions',
// General Info
	'general_info_label' => 'General Information',
	'group_name' => 'Group Name',
	'group_desc' => 'Group Description',
// Group Access Level
	'access_level_label' => 'Group Access Level',
	'Administrator' => 'Users of this group have admin access',
	'can_manage_accounts' => 'Users of this group can manage accounts',
	'can_change_settings' => 'Users of this group can change calendar settings',
	'can_manage_cats' => 'Users of this group can manage categories',
	'upl_need_approval' => 'Submitted events require administrative approval',
// Stats
	'stats_string1' => '<strong>%d</strong> groups',
	'stats_string2' => 'Total: <strong>%d</strong> groups on <strong>%d</strong> page(s)',
	'stats_string3' => 'Total: <strong>%d</strong> users on <strong>%d</strong> page(s)',
// View Group Members
	'group_members_string' => 'Members of \'%s\' group',
	'username_label' => 'Username',
	'firstname_label' => 'First Name',
	'lastname_label' => 'Last Name',
	'email_label' => 'Email',
	'last_access_label' => 'Last Access',
	'edit_user' => 'Edit User',
	'delete_user' => 'Delete User',
// Misc.
	'add_group_success' => 'New group added succesfully',
	'edit_group_success' => 'Group updated succesfully',
	'delete_confirm' => 'Are you sure you want to delete this group ?',
	'delete_user_confirm' => 'Are you sure you want to delete this group ?',
	'delete_group_success' => 'Group deleted succesfully',
	'no_users_string' => 'There are no users under this group',
// Error messages
	'no_group_name' => 'You must provide a name for this group !',
	'no_group_desc' => 'You must provide a description for this group !',
	'delete_group_failed' => 'This group cannot be deleted',
	'no_groups' => 'There are no groups to display !',
	'group_has_users' => 'This group contains %d user(s) and therefore cannot be deleted!<br>Please unlink remaining users from this group and try again!'

);

// ======================================================
// admin_settings.php / admin_settings_template.php / 
// admin_settings_updates.php
// ======================================================

$lang_settings_data = array(
	'section_title' => 'Calendar Settings'
// Links
	,'admin_links_text' => 'Choose Section'
	,'admin_links' => array('Main Settings','Template Configuration','Product Updates')
// General Settings
	,'general_settings_label' => 'General'
	,'calendar_name' => 'Calendar name'
	,'calendar_description' => 'Calendar description'
	,'calendar_admin_email' => 'Calendar Administrator email'
	,'cookie_name' => 'Name of the cookie used by the script'
	,'cookie_path' => 'Path of the cookie used by the script'
	,'debug_mode' => 'Enable debug mode'
// Environment Settings
	,'env_settings_label' => 'Environment'
	,'lang' => 'Language'
		,'lang_name' => 'Language'
		,'lang_native_name' => 'Native name'
		,'lang_trans_date' => 'Translated on'
		,'lang_author_name' => 'Author'
		,'lang_author_email' => 'E-mail'
		,'lang_author_url' => 'Website'
	,'charset' => 'Character encoding'
	,'theme' => 'Theme'
		,'theme_name' => 'Theme name'
		,'theme_date_made' => 'Made on'
		,'theme_author_name' => 'Author'
		,'theme_author_email' => 'E-mail'
		,'theme_author_url' => 'Website'
	,'timezone' => 'Timezone offset'
	,'time_format' => 'Time display format'
		,'24hours' => '24 Hours'
		,'12hours' => '12 Hours'
	,'auto_daylight_saving' => 'Automatically adjust for daylight saving (DST)'
	,'main_table_width' => 'Width of the main table (Pixels or %)'
	,'day_start' => 'Weeks start on'
	,'default_view' => 'Default view'
	,'search_view' => 'Enable search'
	,'archive' => 'Show past events'
	,'events_per_page' => 'Number of events per page'
	,'sort_order' => 'Default sort order'
		,'sort_order_title_a' => 'Title ascending'
		,'sort_order_title_d' => 'Title descending'
		,'sort_order_date_a' => 'Date ascending'
		,'sort_order_date_d' => 'Date descending'
	,'show_recurrent_events' => 'Show recurrent events'
	,'multi_day_events' => 'Multi-day events'
		,'multi_day_events_all' => 'Show entire date range'
		,'multi_day_events_bounds' => 'Show start & end dates only'
		,'multi_day_events_start' => 'Show start date only'
	// User Settings
	,'user_settings_label' => 'User Settings'
	,'allow_user_registration' => 'Allow user registrations'
	,'reg_duplicate_emails' => 'Allow duplicate emails'
	,'reg_email_verify' => 'Enable account activation through email'
// Event View
	,'event_view_label' => 'Event View'
	,'popup_event_mode' => 'Pop-up Event'
	,'popup_event_width' => 'Width of the Pop-up window'
	,'popup_event_height' => 'Height of the Pop-up window'
// Add Event View
	,'add_event_view_label' => 'Add Event'
	,'add_event_view' => 'Enabled'
	,'addevent_allow_html' => 'Allow <b>HTML</b> in the description'
	,'addevent_allow_contact' => 'Allow Contact'
	,'addevent_allow_email' => 'Allow Email'
	,'addevent_allow_url' => 'Allow URL'
	,'addevent_allow_picture' => 'Allow Pictures'
	,'new_post_notification' => 'Email Me When Events Need Approval'
// Calendar View
	,'calendar_view_label' => 'Monthly View'
	,'monthly_view' => 'Enabled'
	,'cal_view_show_week' => 'Display Week Numbers'
	,'cal_view_max_chars' => 'Maximum Characters in the Title'
// Flyer View
	,'flyer_view_label' => 'Flat View'
	,'flyer_view' => 'Enabled'
	,'flyer_show_picture' => 'Display Pictures in Flat View'
	,'flyer_view_max_chars' => 'Maximum Characters in the Description'
// Weekly View
	,'weekly_view_label' => 'Weekly View'
	,'weekly_view' => 'Enabled'
	,'weekly_view_max_chars' => 'Maximum Characters in the Title'
// Daily View
	,'daily_view_label' => 'Daily View'
	,'daily_view' => 'Enabled'
	,'daily_view_max_chars' => 'Maximum Characters in the Title'
// Categories View
	,'categories_view_label' => 'Cats View'
	,'cats_view' => 'Enabled'
	,'cats_view_max_chars' => 'Maximum Characters in the Title'
// Mini Calendar
	,'mini_cal_label' => 'Mini Calendar'
	,'mini_cal_def_picture' => 'Default Picture'
	,'mini_cal_display_picture' => 'Display Picture'
	,'mini_cal_diplay_options' => array('None','Default Picture', 'Daily Picture','Weekly Picture','Random Picture')
// Mail Settings
	,'mail_settings_label' => 'Mail Settings'
	,'mail_method' => 'Method to Send Mail'
	,'mail_smtp_host' => 'SMTP Hosts (separated by a semicolon ;)'
	,'mail_smtp_auth' => ' SMTP Authentication'
	,'mail_smtp_username' => 'SMTP Username'
	,'mail_smtp_password' => 'SMTP Password'

// Form Buttons
	,'update_config' => 'Save New Configuration'
	,'restore_config' => 'Restore Factory Defaults'
// Misc.
	,'update_settings_success' => 'Settings updated succesfully'
	,'restore_default_confirm' => 'Are you sure you want to restore default settings ?'
// Template Configuration
	,'template_type' => 'Template type'
	,'template_header' => 'Header Customization'
	,'template_footer' => 'Footer Customization'
	,'template_status_default' => 'Use default theme template'
	,'template_status_custom' => 'Use the following template:'
	,'template_custom' => 'Custom template'

	,'info_meta' => 'Meta Information'
	,'info_status' => 'Status control'
	,'info_status_default' => 'Disable this content'
	,'info_status_custom' => 'Display the following content:'
	,'info_custom' => 'Custom content'

	,'dynamic_tags' => 'Dynamic Tags'

// Product Updates
	,'updates_check_text' => 'Please wait while we retrieve information from the server...'
	,'updates_no_response' => 'No response from the server. Please try again later.'
	,'avail_updates' => 'Available Updates'
	,'updates_download_zip' => 'Download ZIP package (.zip)'
	,'updates_download_tgz' => 'Download TGZ package (.tar.gz)'
	,'updates_released_label' => 'Release Date: %s'
	,'updates_no_update' => 'You are running the latest version available. No update is needed.'
);

// ======================================================
// cal_mini.inc.php
// ======================================================

$lang_mini_cal = array(
	'def_pic' => 'Default Picture'
	,'daily_pic' => 'Picture of the Day (%s)'
	,'weekly_pic' => 'Picture of the Week (%s)'
	,'rand_pic' => 'Random Picture (%s)'
	,'post_event' => 'Post New Event'
	,'num_events' => '%d Event(s)'
	,'selected_week' => 'Week %d'
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
	'section_title' => 'Login Screen'
// General Settings
	,'login_intro' => 'Enter your username and password to login'
	,'username' => 'Username'
	,'password' => 'Password'
	,'remember_me' => 'Remember me'
	,'login_button' => 'Login'
// Errors
	,'invalid_login' => 'Please verify you login information and try again!'
	,'no_username' => 'You must provide a username !'
	,'already_logged' => 'You are already logged in !'
);

// ======================================================
// logout.php
// ======================================================

// To Be Done


// ======================================================
// plugins.php
// ======================================================

// To Be Done




// New defined constants, used to make a start with new language system

if (!defined('_EXTCAL_THEMES_INSTALL_HEADING'))
{
	DEFINE('_EXTCAL_THEMES_INSTALL_HEADING', 'JCal Pro Themes Manager');
	
	//Common
	DEFINE('_EXTCAL_VERSION', 'Version');
	DEFINE('_EXTCAL_DATE', 'Date');
	DEFINE('_EXTCAL_AUTHOR', 'Author');
	DEFINE('_EXTCAL_AUTHOR_EMAIL', 'Author E-Mail');
	DEFINE('_EXTCAL_AUTHOR_URL', 'Author URL');
	DEFINE('_EXTCAL_PUBLISHED', 'Published');
	
	//Plugins
	DEFINE('_EXTCAL_THEME_PLUGIN', 'Theme');
	DEFINE('_EXTCAL_THEME_PLUGCOM', 'Theme/Command');
	DEFINE('_EXTCAL_THEME_NAME', 'Name');
	DEFINE('_EXTCAL_THEME_HEADING', 'JCal Pro Themes Manager');
	DEFINE('_EXTCAL_THEME_FILTER', 'Filter');
	DEFINE('_EXTCAL_THEME_ACCESS_LIST', 'Access List');
	DEFINE('_EXTCAL_THEME_ACCESS_LVL', 'Access Level');
	DEFINE('_EXTCAL_THEME_CORE', 'Core');
	DEFINE('_EXTCAL_THEME_DEFAULT', 'Default');
	DEFINE('_EXTCAL_THEME_ORDER', 'Order');
	DEFINE('_EXTCAL_THEME_ROW', 'Row');
	DEFINE('_EXTCAL_THEME_TYPE', 'Type');
	DEFINE('_EXTCAL_THEME_ICON', 'Icon');
	DEFINE('_EXTCAL_THEME_LAYOUT_ICON', 'Layout Icon');
	DEFINE('_EXTCAL_THEME_DESC', 'Description');
	DEFINE('_EXTCAL_THEME_EDIT', 'Edit');
	DEFINE('_EXTCAL_THEME_NEW', 'New');
	DEFINE('_EXTCAL_THEME_DETAILS', 'Plugin Details');
	DEFINE('_EXTCAL_THEME_PARAMS', 'Parameters');
	DEFINE('_EXTCAL_THEME_ELMS', 'Elements');
	//Plugin Installer
	DEFINE('_EXTCAL_THEMES_INSTALL_MSG', 'Only those Themes that can be uninstalled are displayed - the Core Theme cannot be removed.');
	DEFINE('_EXTCAL_THEME_NONE', 'There are no non-core themes installed');
	
	//Language Manager
	DEFINE('_EXTCAL_LANG_HEADING', 'EXTCAL Language Manager');
	DEFINE('_EXTCAL_LANG_LANG', 'Language');
	
	//Language Installer
	DEFINE('_EXTCAL_LANG_HEADING_INSTALL', 'Install new EXTCAL Language');
	DEFINE('_EXTCAL_LANG_BACK', 'Back to Language Manager');
	//
	
	//Global Installer
	DEFINE('_EXTCAL_INS_PACKAGE_UPLOAD', 'Upload Package File');
	DEFINE('_EXTCAL_INS_PACKAGE_FILE', 'Package File');
	DEFINE('_EXTCAL_INS_INSTALL', 'Install From Directory');
	DEFINE('_EXTCAL_INS_INSTALL_DIR', 'Install Directory');
	DEFINE('_EXTCAL_INS_UPLOAD_BUTTON', 'Upload File &amp; Install');
	DEFINE('_EXTCAL_INS_INSTALL_BUTTON', 'Install');
}
?>