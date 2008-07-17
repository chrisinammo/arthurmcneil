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
	'name' => 'German'
	,'nativename' => 'Deutsch' // Sprache name in native language. E.g: 'Fran�ais' for 'French'
	,'locale' => array('de','german') // Standard locale alternatives for a specific language. For reference, go to: http://www.php.net/manual/en/function.setlocale.php
	,'charset' => 'ISO-8859-1' // For reference, go to : http://www.w3.org/International/O-charset-lang.html
	,'direction' => 'ltr' // 'ltr' for Left to Right. 'rtl' for Right to Left languages such as Arabic.
	,'author' => 'Antoine Johannes Kuske aka fesseChaud, fixed 4 Mambo by Ben Kioo'
	,'author_email' => 'antoine@bachtel.ch, info@novacore.org'
	,'author_url' => 'http://www.randonneurs.org/, http://www.novacore.org'
	,'transdate' => '12/07/2004'
);

$lang_general = array (
	'yes' => 'Ja'
	,'no' => 'Nein'
	,'back' => 'Zur&#252;ck'
	,'continue' => 'Vorw&#228;rts'
	,'close' => 'Schliessen'
	,'errors' => 'Fehler'
	,'info' => 'Informationen'
	,'day' => 'Tag'
	,'days' => 'Tage'
	,'month' => 'Monat'
	,'months' => 'Monate'
	,'year' => 'Jahr'
	,'years' => 'Jahre'
	,'hour' => 'Stunde'
	,'hours' => 'Stunden'
	,'minute' => 'Minute'
	,'minutes' => 'Minuten'
	,'everyday' => 'Jeden Tag'
	,'everymonth' => 'Jeden Monat'
	,'everyyear' => 'Jedes Jahr'
	,'active' => 'Aktiv'
	,'not_active' => 'Nicht aktiv'
	,'today' => 'Heute'
	,'signature' => 'Powered by %s'
	,'expand' => 'Ausklappen'
	,'collapse' => 'Einklappen'
);

// Datum formats, For reference, go to : http://www.php.net/manual/en/function.strftime.php
$lang_date_format = array (
	'full_date' => '%A, %d. %B, %Y' // e.g. Mittwoch, Juni 05, 2002
	,'full_date_time_24hour' => '%A, %d. %B, %Y um %H:%M' // e.g. Mittwoch, Juni 05, 2002 um 21:05
	,'full_date_time_12hour' => '%A, %d. %B, %Y um %I:%M %p' // e.g. Mittwoch, Juni 05, 2002 um 9:05 pm
	,'day_month_year' => '%d.%m.%Y' // e.g 10-Sep-2004
	,'local_date' => '%c' // Preferred date and time representation for current language 
	,'mini_date' => '%a. %d. %b, %Y' 
	,'month_year' => '%B %Y'
	,'day_of_week' => array('Sonntag','Montag','Dienstag','Mittwoch','Donnerstag','Freitag','Samstag')
	,'months' => array('Januar','Februar','M&#228;rz','April','Mai','Juni','Juli','August','September','Oktober','November','Dezember')
);

$lang_system = array (
	'system_caption' => 'System Nachricht'
  ,'page_access_denied' => 'Du hast nicht die Rechte um diese Seite zu besuchen. Wende dich bitte an den Administrator.'
  ,'page_requires_login' => 'Du musst dich einloggen um auf diese Seite zuzugreifen.'
  ,'operation_denied' => 'Du hast nicht die Rechte Rechte um diese Operation durchzuf&#252;hren. Wende dich bitte an den Administrator.'
	,'section_disabled' => 'Diese Sektion ist zur Zeit nicht aktiv !'
  ,'non_exist_cat' => 'Die ausgew&#228;hlte Rubrik existiert nicht !'
  ,'non_exist_event' => 'Die ausgew&#228;hlte Veranstaltung existiert nicht !'
  ,'param_missing' => 'Die eingetragen Datum sind nicht g&#252;ltig.'
  ,'no_events' => 'Es gibt keine Veranstaltungen'
  ,'config_string' => 'Du benutzt zur Zeit \'%s\', konfiguriert mit %s, %s und %s.'
  ,'no_table' => 'Diese\'%s\' Tabelle ist in existent !'
  ,'no_anonymous_group' => 'Diese  %s enth&#228;lt nicht die \'Anonymous\' Gruppe !'
  ,'calendar_locked' => 'Der Service ist zur Zeit nicht erreichbar'
	,'new_upgrade' => 'Das System hat eine neue Version gefunden. Ein Upgrade wird empfohlen!'
	,'no_profile' => 'Ein Fehler ist aufgetreten'
	,'unknown_component' => 'Unbekannte Komponente'
// Mail messages
	,'new_event_subject' => 'Neue Veranstaltung um %s'
	,'event_notification_failed' => 'Ein Fehler ist aufgetreten. Es wurde keine Mail gesendet.'
);

// Message body for new event email notification
$lang_system['event_notification_body'] = <<<EOT
The following event has just been posted at {CALENDAR_NAME}

Title: "{TITLE}"
Date: "{DATE}"
Duration: "{DURATION}"

You can access this event by clickig the link below 
or copy and paste it in your web browser.

{LINK}

Regards,

The management of {CALENDAR_NAME}

EOT;


// Admin menu entries
$lang_admin_menu = array (
	'login' => 'Login'
	,'register' => 'Registrieren'
  ,'logout' => 'Logout <span style="color:#FF9922">[<span style="color:#606F79">%s</span>]</span>'
  ,'user_profile' => 'Mein Profil'
	,'admin_events' => 'Veranstaltungen'
  ,'admin_categories' => 'Rubriken'
  ,'admin_groups' => 'Gruppen'
  ,'admin_users' => 'Benutzer'
  ,'admin_settings' => 'Einstellungen'
);

// Main menu entries
$lang_main_menu = array (
	'add_event' => 'Eintragen'
   ,'cal_view' => 'Monatsansicht'
  ,'flat_view' => 'Flache Ansicht'
  ,'weekly_view' => 'Wochenansicht'
  ,'daily_view' => 'Tagesansicht'
  ,'yearly_view' => 'Jahresansicht'
  ,'categories_view' => 'Rubrikenansicht'
  ,'search_view' => 'Suchen'
);

// ======================================================
// Veranstaltung hinzuf&#252;gen Ansicht
// ======================================================

$lang_add_event_view = array(
	'section_title' => 'Veranstaltung hinzuf&#252;gen'
	,'edit_event' => 'Veranstaltung bearbeiten [id%d] \'%s\''
	,'update_event_button' => 'Update Veranstaltung'

// Veranstaltung details
	,'event_details_label' => 'Einzelheiten der Veranstaltung '
	,'event_title' => 'Titel der Veranstaltung'
	,'event_desc' => 'Beschreibung der Veranstaltung'
	,'event_cat' => 'Rubrik'
	,'choose_cat' => 'Eine Rubrik ausw&#228;hlen'
	,'event_date' => 'Veranstaltungsdatum'
	,'day_label' => 'Tag'
	,'month_label' => 'Monat'
	,'year_label' => 'Jahr'
	,'start_date_label' => 'Start Zeit'
	,'start_time_label' => 'um'
	,'end_date_label' => 'Dauer'
	,'all_day_label' => 'Ganzt�gig'
// Contact details
	,'contact_details_label' => 'Kontaktinformationen'
	,'contact_info' => 'Kontakt Info'
	,'contact_email' => 'Kontakt E-Mail'
	,'contact_url' => 'Kontakt Homepage'
	// Repeat events
	,'repeat_event_label' => 'Wiederholung der Veranstaltung'
	,'repeat_method_label' => 'Zyklus:'
	,'repeat_none' => 'Keine Wiederholung'
	,'repeat_every' => 'Alle'
	,'repeat_days' => 'Tag(e)'
	,'repeat_weeks' => 'Woche(n)'
	,'repeat_months' => 'Monat(e)'
	,'repeat_years' => 'Jahr(e)'
	,'repeat_end_date_label' => 'Zyklus endet nach:'
	,'repeat_end_date_none' => 'Kein Ende'
	,'repeat_end_date_count' => 'Ende nach %s Vorkommen'
	,'repeat_end_date_until' => 'Wiederholen bis'
// Other details
	,'other_details_label' => 'Zus&#228;tzliche Informationen'
	,'picture_file' => 'Bilddatei'
	,'file_upload_info' => '(%d KBytes Limit - G&#252;ltige extensions : %s )' 
	,'del_picture' => 'Das aktuelle Bild l&#246;schen?'
// Administrative options
	,'admin_options_label' => 'Administrative Einstellungen'
	,'auto_appr_event' => 'Veranstaltung freischalten'

// Error messages
	,'no_title' => 'Du musst einen Titel eingeben !'
	,'no_desc' => 'Du musst diese Veranstaltung beschreiben !'
	,'no_cat' => 'Du musst aus der Dropdownliste eine Rubrik ausw&#228;hlen!'
	,'date_invalid' => 'Du musst f&#252;r die Veranstaltung ein g&#252;ltiges Datum eingeben !'
	,'end_days_invalid' => 'Die Werte in \'Tags\' sind nicht g&#252;ltig !'
	,'end_hours_invalid' => 'Die Werte in den \'Stunden\' sind nicht g&#252;ltig !'
	,'end_minutes_invalid' => 'Die Werte in den \'Minuten\' sind nicht g&#252;ltig !'

	,'non_valid_extension' => 'Dieses Bildformat wird nicht unterst&#252;tzt! (Valid extensions: %s)'

	,'file_too_large' => 'Das Bild ist gr&#246;sser als %d KBytes !'
	,'move_image_failed' => 'Das Bild konnte nicht hoch geladen werden !'
	,'non_valid_dimensions' => 'Die Bildbreite oder Bildh&#246;he ist gr&#246;sser als %s Pixels !'

	,'recur_val_1_invalid' => 'Der eingetragene Wiederholungswert ist fehlerhaft. Dieser Wert muss gr&#246;sser als \'0\' !'
	,'recur_end_count_invalid' => 'Der eingetragene Wert bei \'Vorkommen\' ist fehlerhaft. Dieser Wert mus gr&#246;sser als \'0\' sein !'
	,'recur_end_until_invalid' => 'Das eingetragene Datum \'Wiederholen bis\' muss gr&#246;sser sein als das Start Datum !' 
// Misc. messages
	,'submit_event_pending' => 'Deine Veranstaltung muss noch freigeschaltet werden. Danke f&#252;r deinen Beitrag'
	,'submit_event_approved' => 'Deine Veranstaltung wurde automatisch freigeschaltet. Danke f&#252;r deinen Beitrag'
	,'event_repeat_msg' => 'Dieses Event wiederholt sich'
	,'event_no_repeat_msg' => 'Dieses Event wiederholt sich nicht'	
);

// ======================================================
// daily Ansicht
// ======================================================

$lang_daily_event_view = array(
	'section_title' => 'Tagesansicht'
	,'next_day' => 'n&#228;chster Tag'
	,'previous_day' => 'letzter Tag'
	,'no_events' => 'F&#252;r heute sind keine Veranstaltung eingetragen.'
);

// ======================================================
// weekly Ansicht
// ======================================================

$lang_weekly_event_view = array(
	'section_title' => 'Wochenansicht'
	,'week_period' => '%s - %s'
	,'next_week' => 'n&#228;chste Woche'
	,'previous_week' => 'letzte Woche'
	,'selected_week' => 'Woche %d'
	,'no_events' => 'F&#252;r diese Woche sind keine Veranstaltungen eingetragen'
);

// ======================================================
// monthly Ansicht
// ======================================================

$lang_monthly_event_view = array(
	'section_title' => 'Monatsansicht'
	,'next_month' => 'n&#228;chster Monat'
	,'previous_month' => 'letzter Monat'
);

// ======================================================
// flat Ansicht
// ======================================================

$lang_flat_event_view = array(
	'section_title' => 'Flache Ansicht'
	,'week_period' => '%s - %s'
	,'next_month' => 'n&#228;chster Monat'
	,'previous_month' => 'letzter Monat'
	,'contact_info' => 'Kontakt Info'
	,'contact_email' => 'E-mail'
	,'contact_url' => 'URL'
	,'no_events' => 'F&#252;r diesen Monat sind keine Veranstaltungen eingetragen'
);

// ======================================================
// Veranstaltung Ansicht
// ======================================================

$lang_event_view = array(
	'section_title' => 'Veranstaltungsansicht'
	,'display_event' => 'Veranstaltung: \'%s\''
	,'cat_name' => 'Rubrik'
	,'event_start_date' => 'Datum'
	,'event_end_date' => 'bis'
	,'event_duration' => 'Dauer'
	,'contact_info' => 'Kontakt Info'
	,'contact_E-mail' => 'E-mail'
	,'contact_url' => 'URL'
	,'no_event' => 'es gibt keine Veranstaltung anzuzeigen.'
	,'stats_string' => '<strong>%d</strong> Total der Veranstaltungen'
	,'edit_event' => 'Event bearbeiten'
	,'delete_event' => 'Event l&#246;schen'
	,'delete_confirm' => 'Dieses Event wirklich l&#246;schen ?'
);

// ======================================================
// Rubriken Ansicht
// ======================================================

$lang_cats_view = array(
	'section_title' => 'Rubrikenansichten'
	,'cat_name' => 'Rubrikenname'
	,'total_events' => 'Veranstaltungen insgesamt'
	,'upcoming_events' => 'Kommende Veranstaltungen'
	,'no_cats' => 'Es gibt keine Veranstaltungen.'
	,'stats_string' => 'Es gibt <strong>%d</strong> Veranstaltungen in <strong>%d</strong> Rubriken'
);

// ======================================================
// Rubrik Veranstaltungs Ansicht
// ======================================================

$lang_cat_events_Ansicht = array(
	'section_title' => 'Veranstaltungs under \'%s\''
	,'event_name' => 'Name der Veranstaltung'
	,'event_date' => 'Datum'
	,'no_events' => 'In dieser Rubrik gibt es keine Veranstaltungen.'
	,'stats_string' => '<strong>%d</strong> Anzahl Veranstaltungen'
	,'stats_string1' => '<strong>%d</strong> Veranstaltung(en) in <strong>%d</strong> Seite(n)'
);

// ======================================================
// cal_Suche.php
// ======================================================

$lang_event_search_data = array(
	'section_title' => 'Agenda - Suche',
	'search_results' => 'Ergebnis der Suche',
	'category_label' => 'Rubrik',
	'date_label' => 'Datum',
	'no_events' => 'In dieser Rubrik gibt es keine Veranstaltungen.',
	'search_caption' => 'Geben Sie Schl&#252;sselworte ein',
	'search_again' => 'nochmals Suchen',
	'search_button' => 'Suchen',
// Misc.
	'no_results' => 'Kein Resultat gefunden',	
// Stats
	'stats_string1' => '<strong>%d</strong> Veranstaltung(en) gefunden',
	'stats_string2' => '<strong>%d</strong> Veranstaltung(en) in <strong>%d</strong> Seit(en)'
);

// ======================================================
// profile.php
// ======================================================

if (defined('PROFILE_PHP')) 

$lang_user_profile_data = array(
	'section_title' => 'Mein Profil',
	'edit_profile' => 'Mein Profil bearbeiten',
	'update_profile' => 'Mein Profil aktualisieren',
	'actions_label' => 'Aktionen',
// Account Info
	'account_info_label' => 'Account Informationen',
	'user_name' => 'Username',
	'user_pass' => 'Passwort',
	'user_pass_confirm' => 'Passwort best&#228;tigen',
	'user_email' => 'E-mail Addresse',
	'group_label' => 'Gruppen Mitglied',
// Other Details
	'other_details_label' => 'Andere Details',
	'first_name' => 'Vorname',
	'last_name' => 'Nachname',
	'full_name' => 'Voller Name',
	'user_website' => 'Homepage',
	'user_location' => 'Ort',
	'user_occupation' => 'Beruf',
// Misc. 
	'select_language' => 'Sprache ausw&#228;len',
	'edit_profile_success' => 'Profil erfolgreich aktualisiert',
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
	'section_title' => 'BenutzerInnen Registration',
// Step 1: Terms & Conditions
	'terms_caption' => 'Regeln und Bedingungen',
	'terms_intro' => 'Um sich anmelden zu k&#246;nne m&#252;ssen Sie sich mit folgenden einverstanden erkl&#228;ren:',
	'terms_message' => 'Please take a moment to review these rules detailed below. If you agree with them and wish to proceed with the registration, simply click the "I agree" button below. To cancel this registration, simply hit the \'back\' button on your browser.<br /><br />Please remember that we are not responsible for any events posted by users of this calendar application. We do not vouch for or warrant the accuracy, completeness or usefulness of any posted event, and are not responsible for the contents of any event.<br /><br />The messages express the views of the author of the event, not necessarily the views of this calendar application. Any user who feels that a posted event is objectionable is encouraged to contact us immediately by email. We have the ability to remove objectionable content and we will make every effort to do so, within a reasonable time frame, if we determine that removal is necessary.<br /><br />You agree, through your use of this service, that you will not use this calendar application to post any material which is knowingly false and/or defamatory, inaccurate, abusive, vulgar, hateful, harassing, obscene, profane, sexually oriented, threatening, invasive of a person\'s privacy, or otherwise violative of any law.<br /><br />You agree not to post any copyrighted material unless the copyright is owned by you or by %s.',
	'terms_button' => 'I agree',
	
// Benutzerkonto Info
	'account_info_label' => 'Konto Informationen',
	'user_name' => 'Benutzername',
	'user_pass' => 'Passwort',
	'user_pass_confirm' => 'Best&#228;tigen Sie das Passwort',
	'user_email' => 'E-mail Adresse',
// Andere Einzelheiten
	'other_details_label' => 'Andere Einzelheiten',
	'first_name' => 'Vorname',
	'last_name' => 'Nachnamen',
	'user_website' => 'Homepage',
	'user_location' => 'Wohnort',
	'user_occupation' => 'Besch&#228;ftigung',
	'register_button' => 'Meine Registration absenden',

// Stats
	'stats_string1' => '<strong>%d</strong> BenutzerInnen',
	'stats_string2' => '<strong>%d</strong> BenutzerInnen in <strong>%d</strong> Seit(en)',
// Misc.
	'reg_nomail_success' => 'Danke f&#252;r deine Anmeldung.',
	'reg_mail_success' => 'Eine E-mail mit den n&#246;tigen Informationen um dein Konto zu aktivieren wurde dir soeben zugestellt.',
	'reg_activation_success' => 'Gl&#252;ckwunsch du haben sich soeben erfolgreich in der Agenda angemeldet. Danke f&#252;r deine Anmeldung.',
// Mail messages
	'reg_confirm_subject' => 'Registriert als %s',
	
// Error messages
	'no_username' => 'Du musst einen Benutzernamen eintragen !',
	'invalid_username' => 'W&#228;hle einen Benutzernamen der zwischen 4 und 30 Buchstaben lang ist !',
	'username_exists' => 'Dieser Benutzername wurde schon vergeben, w&#228;hle einen andern!',
	'no_password' => 'Du musst ein Passwort w&#228;hlen !',
	'invalid_password' => 'W&#228;hle ein Passwort der zwischen 4 und 30 Buchstaben lang ist und nur aus Zahlen und Buchstaben besteht!',
	'password_is_username' => 'Benutzername und Passwort m&#252;ssen sich unterscheiden !',
	'password_not_match' =>'Du hast ein ung&#252;ltiges Passwort eingegeben \'Best&#228;tige Passwort\'',
	'no_email' => 'Du musst eine E-mail angeben! !',
	'invalid_email' => 'Du musst eine g&#252;ltige E-mail angeben!',
	'email_exists' => 'Eine andere BenutzerIn hat sich schon mir dieser E-mail eingetragen, w&#228;hle bitte eine andere E-mail!',
	'delete_user_failed' => 'Dieses Benutzerkonto kann nicht gel&#246;scht werden',
	'no_users' => 'Es gibt keine Benutzerkonten zum anzeigen !',
	'already_logged' => 'Du bist schon als Mitglied eingeloggt !',
	'registration_not_allowed' => 'Die Benutzeranmeldung ist zur Zeit nicht verf&#252;gbar, schau\' bitte sp&#228;ter noch einmal vorbei !',
	'reg_E-mail_failed' => 'Ein Fehler ist beim pr&#252;fen deiner E-mail entstanden!',
	'reg_activation_failed' => 'Ein Fehler ist bei der Aktivierung aufgetreten, versuche es bitte nochmals !'

);
// Message body for E-mail activation
$lang_user_registration_data['reg_confirm_body'] = <<<EOT
Danke, dass du dich bei uns Registriert hast{CALENDAR_NAME}

Dein Benutzername ist : "{USERNAME}"
Dein Passwort ist : "{PASSWORD}"

Zum aktivieren deiner Anmeldung musst du auf den folgenden Link klicken:

{REG_LINK}

Herzlichen Dank, dass du dich bei uns angemeldet hast,

Viel Spass w&#252;nscht das Team von {CALENDAR_NAME}

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
	'section_title' => 'Veranstaltungs Administration',
	'events_to_approve' => 'Veranstaltungs Administration: Veranstaltungen zum freischalten',
	'upcoming_events' => 'Veranstaltungs Administration: Kommende Veranstaltungen',
	'past_events' => 'Veranstaltungs Administration: Abgelaufene Veranstaltungen',
	'add_event' => 'Neue Veranstaltung hinzuf&#252;gen',
	'edit_event' => 'Veranstaltungen bearbeiten',
	'view_event' => 'Veranstaltungen anzeigen',
	'approve_event' => 'Pr&#252;fen der Veranstaltung(en)',
	'update_event' => 'Aktualisierung der Veranstaltungs Informationen',
	'delete_event' => 'L&#246;sche Veranstaltung(en)',
	'events_label' => 'Veranstaltungen',
	'auto_approve' => 'Automatische &#220;berpr&#252;fung',
	'date_label' => 'Datum',
	'actions_label' => 'Aktion',
	'events_filter_label' => 'Veranstaltungsfilter',
	'events_filter_options' => array('Alle Veranstaltungen anzeigen','Nur ungepr&#252;fte Veranstaltungen anzeigen','Kommende Veranstaltungen anzeigen','Nur vergangene Veranstaltungen anzeigen'),
	'picture_attached' => 'Bild hinzugef&#252;gt',
// Ansicht Veranstaltung
	'view_event_name' => 'Veranstaltung: \'%s\'',
	'event_start_date' => 'Datum',
	'event_end_date' => 'bis',
	'event_duration' => 'Dauer',
	'contact_info' => 'Kontakt Info',
	'contact_E-mail' => 'E-Mail',
	'contact_url' => 'URL',
// General Info
// Veranstaltung form
	'edit_event_title' => 'Veranstaltung: \'%s\'',
	'cat_name' => 'Rubrik',
	'event_start_date' => 'Datum',
	'event_end_date' => 'bis',
	'contact_info' => 'Kontakt Info',
	'contact_E-mail' => 'E-Mail',
	'contact_url' => 'URL',
	'no_event' => 'es gibt keine Veranstaltung anzuzeigen.',
	'stats_string' => '<strong>%d</strong> Total der Veranstaltungen',
// Stats
	'stats_string1' => '<strong>%d</strong> Veranstaltung(en)',
	'stats_string2' => 'Total: <strong>%d</strong> Veranstaltungen auf <strong>%d</strong> Seit(en)',
// Misc.
	'add_event_success' => 'Veranstaltung erfolgreich hinzugef&#252;gt',
	'edit_event_success' => 'Veranstaltungen erfolgreich aktualisiert',
	'approve_event_success' => 'Veranstaltung erfolgreich &#252;berpr&#252;ft',
	'delete_confirm' => 'Bist du sicher, dass du diese Veranstaltung l&#246;schen willst?',
	'delete_event_success' => 'Veranstaltung erfolgreich gel&#246;scht',
	'active_label' => 'Aktive',
	'not_active_label' => 'Keine Aktiven',
// Error messages
	'no_event_name' => 'Du musst f&#252;r diese Veranstaltung einen Namen eintragen!',
	'no_event_desc' => 'Du musst f&#252;r diese Veranstaltung eine Beschreibung eingeben!',
	'no_cat' => 'Du musst f&#252;r diese Veranstaltung eine Rubrik ausw&#228;hlen!',
	'no_day' => 'Du musst einen Tag ausw&#228;hlen!',
	'no_month' => 'Du musst einen Monat ausw&#228;hlen!',
	'no_year' => 'Du musst ein Jahr ausw&#228;hlen!',
	'non_valid_date' => 'Bitte gib ein g&#252;ltiges Datum ein!',
	'end_days_invalid' => 'Vergewissere dich, dass das \'Tage\' Feld unter \'Dauer\' nur aus Zahlen besteht !',
	'end_hours_invalid' => 'Vergewissere dich, dass das \'Stunden\' Feld unter \'Dauer\'password nur aus Zahlen besteht !',
	'end_minutes_invalid' => 'Vergewissere dich, dass das \'Minuten\' Feld unter \'Dauer\' nur aus Zahlen besteht !',
	'file_too_large' => 'Das ist gr&#246;sser als %d KBytes, versuche es bitte mit einer andern Gr&#246;sse !',
	'non_valid_extension' => 'Dieses Bildformat wird nicht unterst&#252;tzt!',
	'delete_event_failed' => 'Diese Veranstaltung kann nicht gel&#246;scht werden',
	'approve_event_failed' => 'Diese Veranstaltung kann nicht &#252;berpr&#252;ft werden',
	'no_events' => 'es gibt keine Veranstaltung anzuzeigen !',
	'move_image_failed' => 'Das System konnte nicht das hochgeladene Bild verarbeiten!',
	'non_valid_dimensions' => 'Das Bild ist h&#246;her oder breiter als %s Pixels!',
	'recur_val_1_invalid' => 'The value entered as \'repeat interval\' is not valid. This value must be a number greater than \'0\' !',
	'recur_end_count_invalid' => 'The value entered as \'number of occurrences\' is not valid. This value must be a number greater than \'0\' !',
	'recur_end_until_invalid' => 'The \'repeat until\' date must be greater than the event start date !'
	
);

// ======================================================
// admin_Rubriken.php
// ======================================================

if (defined('ADMIN_CATS_PHP')) 

$lang_cat_admin_data = array(
	'section_title' => 'Rubriken Administration',
	'add_cat' => 'Neue Rubrik hinzuf&#252;gen',
	'edit_cat' => 'Rubrik bearbeiten',
	'update_cat' => 'Update Rubrik Info',
	'delete_cat' => 'Rubrik l&#246;schen',
	'events_label' => 'Veranstaltungen',
	'visibility' => 'Sichtbarkeit',
	'actions_label' => 'Aktion',
	'users_label' => 'BenutzerInnen',
	'admins_label' => 'Administratoren',
// General Info
	'general_info_label' => 'Basisinformation',
	'cat_name' => 'Rubrikenname',
	'cat_desc' => 'Rubrik Beschreibung',
	'cat_color' => 'Farbe',
	'pick_color' => 'W&#228;hle eine Farbe!',
	'status_label' => 'Status',
// Administrative Options
	'admin_label' => 'Administrative Optionen',
	'auto_admin_appr' => 'Automatisches &#252;berpr&#252;fen der Admineingaben',
	'auto_user_appr' => 'Automatisches &#252;berpr&#252;fen der Benutzereingaben',
// Stats
	'stats_string1' => '<strong>%d</strong> Rubriken',
	'stats_string2' => 'Aktiv: <strong>%d</strong>&nbsp;&nbsp;&nbsp;Total: <strong>%d</strong>&nbsp;&nbsp;&nbsp;on <strong>%d</strong> Seit(en)',
// Misc.
	'add_cat_success' => 'Neue Rubrik erfolgreich hinzuf&#252;gen',
	'edit_cat_success' => ' Die Aktualisierung der Rubrik war erfolgreich',
	'delete_confirm' => 'Bist du sicher, dass du diese Rubrik l&#246;schen willst? ?',
	'delete_cat_success' => 'Rubrik erfolgreich gel&#246;scht',
	'active_label' => 'Aktive',
	'not_active_label' => 'Keine Aktiv(en)',
// Error messages
	'no_cat_name' => 'Du musst einen Name f&#252;r diese Rubrik eingeben !',
	'no_cat_desc' => 'Du musst einen Beschreibung f&#252;r diese Rubrik eingeben !',
	'no_Farbe' => 'Du musst eine Farbe f&#252;r diese Rubrik eingeben !',
	'delete_cat_failed' => 'Diese Rubrik kann nicht gel&#246;scht werden',
	'no_cats' => 'Es gibt keine Veranstaltungen !',
	'cat_has_events' => 'Diese Rubrik enth&#228;lt %d Veranstaltungsdaten und kann nicht gel&#246;scht werden!<br>Bitte l&#246;sche die Veranstaltungen einzeln bevor du diese Rubrik l&#246;schst!'

);
// ======================================================
// admin_BenutzerInnens.php
// ======================================================

if (defined('ADMIN_USERS_PHP')) 

$lang_user_admin_data = array(
	'section_title' => 'BenutzerInnen Administration',
	'add_user' => 'Neuer BenutzerInnen hinzuf&#252;gen',
	'edit_user' => 'Bearbeiten der BenutzerInnen Info',
	'update_user' => 'Update BenutzerInnen Info',
	'delete_user' => 'Benutzerkonto l&#246;schen',
	'last_access' => 'Letzte Anmeldung der BenutzerInnen',
	'actions_label' => 'Aktion',
	'active_label' => 'Aktiv',
	'not_active_label' => 'Nicht Aktiv',
// Benutzerkonto Info
	'user_info_label' => 'Konto Informationen',
	'user_name' => 'Benutzername',
	'user_pass' => 'Passwort',
	'user_pass_confirm' => 'Best&#228;tigen Sie das Passwort',
	'user_email' => 'E-mail Adresse',
	'group_label' => 'Gruppen Mitgliedschaft',
	'status_label' => 'Benutzerkonto Status',
// Andere EinzelheitenPasswort
	'other_details_label' => 'Andere Einzelheiten',
	'first_name' => 'Vorname',
	'last_name' => 'Nachnamen',
	'user_website' => 'Homepage',
	'user_location' => 'Wohnort',
	'user_occupation' => 'Besch&#228;ftigung',
// Stats
	'stats_string1' => '<strong>%d</strong> BenutzerInnen',
	'stats_string2' => '<strong>%d</strong> BenutzerInnen in <strong>%d</strong> Seit(en)',
// Misc.
	'select_group' => 'W&#228;hlen sie...',
	'add_username_success' => 'Benutzerkonto erfolgreich hinzugef&#252;gt',
	'edit_username_success' => 'Die Aktualisierung Benutzerkonto war erfolgreich',
	'delete_confirm' => 'Bist du sicher, dass du das Benutzerkonto l&#246;schen willst?',
	'delete_user_success' => 'Benutzerkonto erfolgreich gel&#246;scht',
	'update_pass_info' => 'Lass\' das Passwortfeld frei, du musst es nicht aktualisieren ',
	'access_never' => 'Niemals',
// Error messages
	'no_username' => 'Du musst einen Benutzername eingeben!',
	'invalid_username' => 'W&#228;hle einen Benutzernamen der zwischen 4 und 30 Buchstaben lang ist !',
	'invalid_password' => 'W&#228;hle ein Passwort das zwischen 4 und 30 Buchstaben lang ist und nur aus Zahlen und Buchstaben besteht!',
	'password_is_username' => 'Das Passwort muss sich vom Benutzername unterscheiden!',
	'password_not_match' =>'Das Passwort, dass du angeben haben stimmt nicht \'confirm Passwort\'',
	'invalid_email' => 'Du musst eine g&#252;ltige E-mail angeben!',
	'email_exists' => 'Ein/e andere/r BenutzerIn hat sich schon mit dieser E-mail eingetragen, w&#228;hle bitte eine andere E-mail!',
	'username_exists' => 'Der Benutzername ist schon vergeben, w&#228;hle bitte einen andern Benutzername !',
	'no_email' => 'Du musst einen E-mail eingeben!',
	'invalid_email' => 'Du musst eine g&#252;ltige E-mail eingeben !',
	'no_pasword' => 'Du musst eine Passwort f&#252;r diese neue Konto eingeben!',
	'no_group' => 'Bitte w&#228;hle eine Gruppe f&#252;r diese/n BenutzerIn!',
	'delete_users_failed' => 'Dieses Benutzerkonto kann nicht gel&#246;scht werden',
	'no_users' => 'Es gibt keine Benutzerkonten zum anzeigen!'

);

// ======================================================
// admin_Gruppes.php
// ======================================================

if (defined('ADMIN_GROUPS_PHP')) 

$lang_group_admin_data = array(
	'section_title' => 'Gruppen - Administration',
	'add_group' => 'Neue Gruppe hinzuf&#252;gen',
	'edit_group' => 'Gruppe bearbeiten',
	'update_group' => 'Update Gruppe Info',
	'delete_group' => 'Gruppe l&#246;schen',
	'view_group' => 'Gruppe anzeigen',
	'users_label' => 'Mitglied',
	'actions_label' => 'Aktion',
// General Info
	'general_info_label' => 'Basisinformation',
	'group_name' => 'Gruppen Name',
	'group_desc' => 'Gruppen Beschreibung',
// Gruppe Access Level
	'access_level_label' => 'Gruppe Access Level',
	'has_admin_access' => 'Benutzer in dieser Gruppe haben Adminrechte',
	'can_manage_accounts' => 'Benutzer in dieser Gruppe K&#246;nne Konten managen',
	'can_change_settings' => 'Benutzer in dieser Gruppe k&#246;nnen  Agendaeinstellungen bearbeiten',
	'can_manage_cats' => 'BenutzerInnen in dieser Gruppe d&#252;rfen Rubriken managen',
	'upl_need_approval' => 'Veranstaltungshinweise einsenden ben&#246;tigt Adminrechte',
// Stats
	'stats_string1' => '<strong>%d</strong> Gruppen',
	'stats_string2' => 'Total: <strong>%d</strong> Gruppen in <strong>%d</strong> Seit(en)',
	'stats_string3' => 'Total: <strong>%d</strong> BenutzerInnen in <strong>%d</strong> Seit(en)',
// Ansicht Gruppe Mitglied
	'group_members_string' => 'Mitglied von \'%s\' Gruppe',
	'username_label' => 'Benutzername',
	'firstname_label' => 'Vorname',
	'lastname_label' => 'Nachnamen',
	'email_label' => 'E-mail',
	'last_access_label' => 'Letztes Login',
	'edit_user' => 'BenutzerIn  bearbeiten',
	'delete_user' => 'BenutzerIn l&#246;schen',
// Misc.
	'add_group_success' => 'Neue Gruppe erfolgreich hinzugef&#252;gt',
	'edit_group_success' => 'Aktualisierung der Gruppe war erfolgreich',
	'delete_confirm' => 'Bist du sicher das Sie diese Gruppe l&#246;schen willst?',
	'delete_user_confirm' => 'Bist du sicher das Sie diese Gruppe l&#246;schen willst?',
	'delete_group_success' => 'Gruppe erfolgreich gel&#246;scht',
	'no_user_string' => 'Es gibt keine BenutzerInnen in dieser  Gruppe',
// Error messages
	'no_group_name' => 'Du musst einen Namen f&#252;r diese Gruppe eingeben!',
	'no_group_desc' => 'Du musst einen Beschreibung f&#252;r diese Gruppe eingeben!',
	'delete_group_failed' => 'Diese Gruppe kann nicht gel&#246;scht werden',
	'no_group' => 'Es gibt keine Gruppes zum anzeigen!',
	'group_has_user' => 'Diese Gruppe enth&#228;lt %d Benutzerdaten und kann nicht gel&#246;scht werden!<br>Bitte l&#246;sche die Benutzerdaten einzeln bevor du diese Gruppe l&#246;schst!'

);

// ======================================================
// admin_settings.php / admin_settings_template.php / 
// admin_settings_updates.php
// ======================================================

$lang_settings_data = array(
	'section_title' => 'Agenda - Administration'
// Links
	,'admin_links_text' => 'W&#228;hle eine Sektion'
	,'admin_links' => array('Basiseinstellungen','Template Konfiguration','Produkt Updates')
// General Einstellungen
	,'general_settings_label' => 'Basiseinstellungen'
	,'calendar_name' => 'Name der Agenda'
	,'calendar_description' => 'Agenda Beschreibung'
	,'calendar_admin_email' => 'E-mai der Agenda - Administratoren'
	,'cookie_name' => 'Name der Cookie die von Script benutzt werden.'
	,'cookie_path' => 'Pfad der Cookie die von Script benutzt werden.'
	,'debug_mode' => 'Debugmode aktivieren'
	,'calendar_status' => 'Kalender Public Status'
// Environment Einstellungen
	,'env_settings_label' => 'Umgebungseinstellungen'
	,'lang' => 'Sprache'
		,'lang_name' => 'Sprache'
		,'lang_native_name' => 'Sprache'
		,'lang_trans_date' => '&#220;bersetzt von'
		,'lang_author_name' => 'Autor'
		,'lang_author_email' => 'E-mail'
		,'lang_author_url' => 'Website'
	,'charset' => 'Character encoding'
	,'theme' => 'Theme'
		,'theme_name' => 'Theme name'
		,'theme_date_made' => 'Made on'
		,'theme_author_name' => 'Autor'
		,'theme_author_E-mail' => 'E-mail'
		,'theme_author_url' => 'Website'
	,'timezone' => 'Timezone offset'
	,'time_format' => 'Zeitformat AM - PM'
		,'24hours' => '24 Stunden'
		,'12hours' => '12 Stunden'
	,'auto_daylight_saving' => 'Automatischer Wechsel Sommerzeit - Winterzeit (DST)'
	,'main_table_width' => 'Tabellenbreite der Haupttabelle (Pixels oder %)'
	,'day_start' => 'Woche startet am'
	,'default_view' => 'Standardansicht'
	,'search_view' => 'Aktiviere Suche'
	,'archive' => 'Anzeige der abgelaufen Veranstaltungen'
	,'events_per_page' => 'Anzahl der Veranstaltungen auf einer Seite' 
	,'sort_order' => 'Reihenfolge in der geordnet wird'
		,'sort_order_title_a' => 'Titel aufsteigend'
		,'sort_order_title_d' => 'Titel absteigend'
		,'sort_order_date_a' => 'Datum aufsteigend'
		,'sort_order_date_d' => 'Datum absteigend'
   	,'show_recurrent_events' => 'Zeige wiederholende Veranstaltungen'
	,'multi_day_events' => 'Mehrt&#228;gige Veranstaltungen'
		,'multi_day_events_all' => 'Zeige gesamte Zeitspanne'
		,'multi_day_events_bounds' => 'Zeige nur Start- & Enddatum'
		,'multi_day_events_start' => 'Zeige nur Start- Datum'		
// user Einstellungen
	,'user_settings_label' => 'BenutzerInnen Einstellungen'
	,'allow_user_registration' => 'Erlaube BenutzerInnen  die Registratur'
	,'reg_duplicate_emails' => 'Erlaube doppelte Benutzung einer E-mail- addy'
	,'reg_email_verify' => 'Aktiviere Benutzerkonten durch E-mail'
// Veranstaltungsansicht
	,'event_view_label' => 'Veranstaltungsansicht'
	,'popup_event_mode' => 'Pop-up Veranstaltung'
	,'popup_event_width' => 'Breite der Pop-up Fenster'
	,'popup_event_height' => 'H&#246;he der Pop-up Fenster'
// Veranstaltung hinzuf&#252;gen Ansicht
	,'add_event_view_label' => 'Ansicht - Veranstaltungen hinzuf&#252;gen'
	,'add_event_view' => 'Aktiviert'
	,'addevent_allow_html' => 'Erlaube <b>BB Code</b> in der Beschreibung'
	,'addevent_allow_contact' => 'Erlaube Kontakt'
	,'addevent_allow_email' => 'Erlaube E-mail'
	,'addevent_allow_url' => 'Erlaube URL'
	,'addevent_allow_picture' => 'Erlaube Bilder'
	,'new_post_notification' => 'Benachrichtigung bei neuer Post'
// Agenda Ansicht
	,'calendar_view_label' => 'Monatliche Agenda-Ansicht'
	,'monthly_view' => 'Aktiviert'
	,'cal_view_show_week' => 'Zeige Nummmer der Kalenderwoche'	
	,'cal_view_max_chars' => 'Maximale Anzahl Buchstaben in der Beschreibung'
// Flugblatt Ansicht
	,'flyer_view_label' => 'Flugblatt Ansicht'
	,'flyer_view' => 'Aktiviert'
	,'flyer_show_picture' => 'Zeige Bilder in der Flugblatt Ansicht'
	,'flyer_view_max_chars' => 'Maximale Anzahl Buchstaben in der Beschreibung'
// Wochenansicht
	,'weekly_view_label' => 'Wochenansicht'
	,'weekly_view' => 'Aktiviert'
	,'weekly_view_max_chars' => 'Maximale Buchstabenanzahl in der Beschreibung'
// Tagesansicht
	,'daily_view_label' => 'Tagesansicht'
	,'daily_view' => 'Aktiviert'
	,'daily_view_max_chars' => 'Maximale Anzahl Buchstaben in der Beschreibung'
// Rubrikenansichten
	,'categories_view_label' => 'Rubrikenansichten'
	,'cats_view' => 'Aktiviert'
	,'cats_view_max_chars' => 'Maximale Anzahl Buchstaben in der Beschreibung'
// Mini Agenda
	,'mini_cal_label' => 'Mini Agenda'
	,'mini_cal_def_picture' => 'Standardbild'
	,'mini_cal_display_picture' => 'Bild anzeige'
	,'mini_cal_diplay_options' => array('Kein Bild','Standartbild', 'Bild des Tages','Bild der Woche','Zufallsbild')
	// Mail Settings
	,'mail_settings_label' => 'Mail Settings'
	,'mail_method' => 'Method to Send Mail'
	,'mail_smtp_host' => 'SMTP Hosts (separated by a semicolon ;)'
	,'mail_smtp_auth' => ' SMTP Authentication'
	,'mail_smtp_username' => 'SMTP Username'
	,'mail_smtp_password' => 'SMTP Password'
	
// Bild Einstellungen
	,'picture_settings_label' => 'Bild Einstellungen'
	,'max_upl_dim' => 'Max. Breite oder H&#246;he der Bilder'
	,'max_upl_size' => 'Max. Gr&#246;sse der Bilder (in Bytes)'
	,'picture_chmod' => 'Standardrechte der Bilder (CHMOD) (in Octal)'
	,'allowed_file_extensions' => 'G&#252;ltige File Extensions f&#252;r der Bilder'
// Form Buttons
	,'update_config' => 'Sichere neue Konfiguration'
	,'restore_config' => 'Stelle Werkseinstellungen wieder her'
// Misc.
	,'update_settings_success' => 'Einstellungen erfolgreich aktualisiert'
	,'restore_default_confirm' => 'Dist du sicher, dass du die Standardeinstellungen wieder herstellen willst?'
// Template Konfiguration
	,'template_type' => 'Template Typ'
	,'template_header' => 'Header Anpassung'
	,'template_footer' => 'Footer Anpassung'
	,'template_status_default' => 'Benutze das Standard Template'
	,'template_status_custom' => 'Benutze folgendes Template:'
	,'template_custom' => 'Standard Template'

	,'info_meta' => 'Meta Information'
	,'info_status' => 'Status kontrolle'
	,'info_status_default' => 'L&#246;sche diesen Content'
	,'info_status_custom' => 'Zeige den folgenden Content:'
	,'info_custom' => 'Standard Content'

	,'dynamic_tags' => 'Dynamic Tags'

// Product Updates
	,'updates_check_text' => 'Bitte warte einen Moment, der Server &#252;bertr&#228;gt Daten...'
	,'updates_no_response' => 'Keine Antwort vom Server. Versuche es sp&#228;ter noch einmal.'
	,'avail_updates' => 'Verf&#252;gbare Updates'
	,'updates_download_zip' => 'Download ZIP package (.zip)'
	,'updates_download_tgz' => 'Download TGZ package (.tar.gz)'
	,'updates_released_label' => 'Release Datum: %s'
	,'updates_no_update' => 'Dies ist die aktuelle Version.  Ein Update ist nicht n&#246;tig'
);

// ======================================================
// cal_mini.inc.php
// ======================================================

$lang_mini_cal = array(
	'def_pic' => 'Standartbild'
	,'daily_pic' => 'Bild des Tag (%s)'
	,'weekly_pic' => 'Bild der Woche (%s)'
	,'rand_pic' => 'Zufallsbild (%s)'
	,'post_event' => 'Neue Veranstaltung einsenden'
	,'num_events' => '%d Veranstaltung(en)'
	,'selected_week' => 'Woche %d'
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
	'section_title' => 'Anmeldung'
// General Einstellungen
	,'login_intro' => 'geben Sie Ihren Benutzername und Ihr Passwort ein'
	,'username' => 'Benutzername'
	,'password' => 'Passwort'
	,'remember_me' => 'Erinnere mich'
	,'login_button' => 'Login'
// Errors
	,'invalid_login' => 'Bitte &#252;berpr&#252;fe deine Login Informationen und versuche es nochmals!'
	,'no_username' => 'Du musst einen Benutzername eingeben!'
	,'already_logged' => 'Du bist schon eingeloggt !'
);

// New defined constants, used to make a start with new language system

if (!defined('_EXTCAL_THEMES_INSTALL_HEADING'))
{
	DEFINE('_EXTCAL_THEMES_INSTALL_HEADING', 'JCal Pro Themes Manager');
	
	//Common
	DEFINE('_EXTCAL_VERSION', 'Version');
	DEFINE('_EXTCAL_DATE', 'Datum');
	DEFINE('_EXTCAL_AUTHOR', 'Verfasser');
	DEFINE('_EXTCAL_AUTHOR_EMAIL', 'Verfasser E-Mail');
	DEFINE('_EXTCAL_AUTHOR_URL', 'Verfasser URL');
	DEFINE('_EXTCAL_PUBLISHED', 'Ver&#246;ffentlicht');
	
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
	DEFINE('_EXTCAL_THEME_ORDER', 'Reihenfolge');
	DEFINE('_EXTCAL_THEME_ROW', 'Spalte');
	DEFINE('_EXTCAL_THEME_TYPE', 'Type');
	DEFINE('_EXTCAL_THEME_ICON', 'Icon');
	DEFINE('_EXTCAL_THEME_LAYOUT_ICON', 'Layout Icon');
	DEFINE('_EXTCAL_THEME_DESC', 'Beschreibung');
	DEFINE('_EXTCAL_THEME_EDIT', 'Editieren');
	DEFINE('_EXTCAL_THEME_NEW', 'Neu');
	DEFINE('_EXTCAL_THEME_DETAILS', 'Plugin Details');
	DEFINE('_EXTCAL_THEME_PARAMS', 'Parameter');
	DEFINE('_EXTCAL_THEME_ELMS', 'Elements');
	//Plugin Installer
	DEFINE('_EXTCAL_THEMES_INSTALL_MSG', 'Nur die Themes die deinstalliert werden k&#246;nnen, werden angezeigt.- Das Core Theme kann nicht entfernt werden.');
	DEFINE('_EXTCAL_THEME_NONE', 'Es sind keine nicht-core Themes installiert');
	
	//Language Manager
	DEFINE('_EXTCAL_LANG_HEADING', 'EXTCAL Sprachen Manager');
	DEFINE('_EXTCAL_LANG_LANG', 'Sprache');
	
	//Language Installer
	DEFINE('_EXTCAL_LANG_HEADING_INSTALL', 'Installiere neue EXTCAL Sprache');
	DEFINE('_EXTCAL_LANG_BACK', 'Zur�ck zum Sprachen Manager');
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

