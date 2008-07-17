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

Revision date: 02/21/2007

**********************************************
Get the latest version of JCal Pro at:
http://dev.anything-digital.com//
**********************************************
*/

/** ensure this file is being included by a parent file */
defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );

// New language structure
$lang_info = array (
	'name' => 'Swedish'
	,'nativename' => 'Svenska' // Language name in native language. E.g: 'Fran�ais' for 'French'
	,'locale' => array('sv','swedish') // Standard locale alternatives for a specific language. For reference, go to: http://www.php.net/manual/en/function.setlocale.php
	,'charset' => 'ISO-8859-1' // For reference, go to : http://www.w3.org/International/O-charset-lang.html
	,'direction' => 'ltr' // 'ltr' for Left to Right. 'rtl' for Right to Left languages such as Arabic.
	,'author' => 'Tommie'
	,'author_email' => 'tommielindavist@hotmail.com'
	,'author_url' => 'not avalible'
	,'transdate' => '04/09/2005'
);

$lang_general = array (
	'yes' => 'Ja'
	,'no' => 'Nej'
	,'back' => 'Tillbaka'
	,'continue' => 'Forts�tt'
	,'close' => 'St�ng'
	,'errors' => 'Fel'
	,'info' => 'Information'
	,'day' => 'Dag'
	,'days' => 'Dagar'
	,'month' => 'M�nad'
	,'months' => 'M�nader'
	,'year' => '�r'
	,'years' => '�r'
	,'hour' => 'Timme'
	,'hours' => 'Timmar'
	,'minute' => 'Minut'
	,'minutes' => 'Minuter'
	,'everyday' => 'Varje Dag'
	,'everymonth' => 'Varje M�nad'
	,'everyyear' => 'Varje �r'
	,'active' => 'Aktiv'
	,'not_active' => 'Ej Aktiv'
	,'today' => 'Idag'
	,'signature' => 'Powered by %s'
	,'expand' => 'Expandera'
	,'collapse' => 'F�rminska'
);

// Date formats, For reference, go to : http://www.php.net/manual/en/function.strftime.php
$lang_date_format = array (
	'full_date' => '%A, %B %d, %Y' // e.g. Wednesday, June 05, 2002
	,'full_date_time_24hour' => '%A, %B %d, %Y At %H:%M' // e.g. Wednesday, June 05, 2002 At 21:05
	,'full_date_time_12hour' => '%A, %B %d, %Y At %I:%M %p' // e.g. Wednesday, June 05, 2002 At 9:05 pm
	,'day_month_year' => '%d-%b-%Y' // e.g 10-Sep-2004
	,'local_date' => '%c' // Preferred date and time representation for current language 
	,'mini_date' => '%a. %d %b, %Y' 
	,'month_year' => '%B %Y'
	,'day_of_week' => array('S�ndag','M�ndag','Tisdag','Onsdag','Torsdag','Fredag','L�rdag')
	,'months' => array('Januari','Februari','Mars','April','Maj','Juni','Juli','Augusti','September','Oktober','November','December')
);

$lang_system = array (
	'system_caption' => 'Systemmeddelande'
  ,'page_access_denied' => 'Du har inte tillr�cklig beh�righet att h�mta denna sida.'
  ,'page_requires_login' => 'Du m�ste logga in f�r att n� denna sida.'
  ,'operation_denied' => 'Du har inte tillr�cklig beh�righet att utf�ra denna instruktion.'
	,'section_disabled' => 'Denna del �r tillf�lligt nere !'
  ,'non_exist_cat' => 'Den valda kategorin finns inte !'
  ,'non_exist_event' => 'Den valda h�ndelsen finns inte !'
  ,'param_missing' => 'De inmatatade parametrarna �r inte korrekta.'
  ,'no_events' => 'Det finns inga h�ndelser att visa'
  ,'config_string' => 'Du anv�nder f�r n�rvarande \'%s\' som k�rs p� %s, %s och %s.'
  ,'no_table' => '\'%s\' tabellen finns inte !'
  ,'no_anonymous_group' => '%s tabellen inneh�ller inte gruppen \'Anonymous\' !'
  ,'calendar_locked' => 'Tj�nsten �r tillf�lligt nere f�r service och uppgradering. Vi ber om uts�kt f�r detta !'
	,'new_upgrade' => 'Systemet har funnit en ny version. Det �r att rekommendera en uppgradering nu. Klicka "Forts�tt" f�r att starta uppgraderingsverktyget.'
	,'no_profile' => 'Ett fel intr�ffade n�r din profil h�mtades'
	,'unknown_component' => 'Ok�nd komponent'
// Mail messages
	,'new_event_subject' => 'Ny h�ndelse %s'
	,'event_notification_failed' => 'Ett fel intr�ffade n�r ett informations-Epost skulle skickas !'
);

// Message body for new event email notification
$lang_system['event_notification_body'] = <<<EOT
F�ljande h�ndelse har skickats {CALENDAR_NAME}

Titel: "{TITLE}"
Datum: "{DATE}"
Varaktighet: "{DURATION}"

Du kan n� denna h�ndelse genom att klicka i l�nken nedan
eller kopiera och klistra in i din webbl�sarer.

{LINK}

Mvh,

Kalenderhanteraren {CALENDAR_NAME}

EOT;

// Admin menu entries
$lang_admin_menu = array (
	'login' => 'Logga in'
	,'register' => 'Registera'
  ,'logout' => 'Logga ut <span style="color:#FF9922">[<span style="color:#606F79">%s</span>]</span>'
  ,'user_profile' => 'Min Profil'
	,'admin_events' => 'H�ndelser'
  ,'admin_categories' => 'Kategorier'
  ,'admin_groups' => 'Grupper'
  ,'admin_users' => 'Anv�ndare'
  ,'admin_settings' => 'Inst�llningar'
);

// Main menu entries
$lang_main_menu = array (
	'add_event' => 'L�gg till h�ndelse'
	,'cal_view' => 'M�nadsformat'
  ,'flat_view' => 'Listformat'
  ,'weekly_view' => 'Veckoformat'
  ,'daily_view' => 'Dagformat'
  ,'yearly_view' => '�rsformat'
  ,'categories_view' => 'Kategorier'
  ,'search_view' => 'S�k'
);

// ======================================================
// Add Event view
// ======================================================

$lang_add_event_view = array(
	'section_title' => 'L�gg till h�ndelse'
	,'edit_event' => 'Redigera h�ndelse [id%d] \'%s\''
	,'update_event_button' => 'Updatera h�ndelse'

// Event details
	,'event_details_label' => 'H�ndelsedetaljer'
	,'event_title' => 'H�ndelsetitel'
	,'event_desc' => 'H�ndelsebeskrivning'
	,'event_cat' => 'Kategori'
	,'choose_cat' => 'V�lj en kategori'
	,'event_date' => 'H�ndelsedatum'
	,'day_label' => 'Dag'
	,'month_label' => 'M�nad'
	,'year_label' => '�r'
	,'start_date_label' => 'Starttid'
	,'start_time_label' => 'kl.'
	,'end_date_label' => 'Varaktighet'
	,'all_day_label' => 'hela Dagen'
// Contact details
	,'contact_details_label' => 'Kontaktdetailjer'
	,'contact_info' => 'Kontaktinfo'
	,'contact_email' => 'E-post'
	,'contact_url' => 'URL'
// Repeat events
	,'repeat_event_label' => 'Upprepa h�ndelse'
	,'repeat_method_label' => 'Upprepa metod'
	,'repeat_none' => 'Upprepa inte denna h�ndelse'
	,'repeat_every' => 'Upprepa varje'
	,'repeat_days' => 'Dag(ar)'
	,'repeat_weeks' => 'Vecka(or)'
	,'repeat_months' => 'M�nad(er)'
	,'repeat_years' => '�r'
	,'repeat_end_date_label' => 'Upprepa slutdatum'
	,'repeat_end_date_none' => 'Inget slutdatum'
	,'repeat_end_date_count' => 'Avsluta efter %s f�rekomster'
	,'repeat_end_date_until' => 'Upprepa till'
// Other details
	,'other_details_label' => '�vriga detaljer'
	,'picture_file' => 'Bildfil'
	,'file_upload_info' => '(%d KBytes begr. - Godk�nt uttryck : %s )' 
	,'del_picture' => 'Radera nuvarande bild ?'
// Administrative options
	,'admin_options_label' => 'Administrativa val'
	,'auto_appr_event' => 'H�ndelse godk�nd'

// Error messages
	,'no_title' => 'Du m�ste mata in en h�ndelsetitel !'
	,'no_desc' => 'Du m�ste mata in en beskrivning f�r denna h�ndelse !'
	,'no_cat' => 'Du m�ste v�lja en kategori fr�n rullmenyn !'
	,'date_invalid' => 'Du m�ste mata in ett giltigt datum f�r h�ndelsen !'
	,'end_days_invalid' => 'Det inmatade v�rdet i \'Dagar\' f�ltet �r inte giltigt !'
	,'end_hours_invalid' => 'Det inmatade v�rdet i \'Timmar\' f�ltet �r inte giltigt !'
	,'end_minutes_invalid' => 'Det inmatade v�rdet i \'Minuter\' f�ltet �r inte giltigt !'

	,'non_valid_extension' => 'Filformatet f�r den valda bilden st�ds inte ! (Godk�nda �ndelser: %s)'

	,'file_too_large' => 'Bilden du vill bifoga �r st�rre �n %d KBytes !'
	,'move_image_failed' => 'Systemet misslyckades att ladda upp bilden. Kontrollera att bilden �r av r�tt typ och inte f�r stor, eller meddela systemadministr�ren.'
	,'non_valid_dimensions' => 'Bildens bredd eller h�jd �r st�rre �n %s pixlar !'

	,'recur_val_1_invalid' => 'Det inmatade v�rdet i \'upprepa intervall\' �r inte giltigt. Detta v�rde m�ste vara ett nummer st�rre �n \'0\' !'
	,'recur_end_count_invalid' => 'Det inmatade v�rdet i \'antalet f�rekomster\' �r inte giltigt. Detta v�rde m�ste vara ett nummer st�rre �n \'0\' !'
	,'recur_end_until_invalid' => 'The \'upprepa until\' datum m�ste vara senare �n h�ndelsens startdatum !'
// Misc. messages
	,'submit_event_pending' => 'Din h�ndelse v�ntar p� godk�nnande. Tack f�r ditt bidrag!'
	,'submit_event_approved' => 'Din h�ndelse �r automatiskt godk�nd. Tack f�r ditt bidrag!'
	,'event_repeat_msg' => 'Denna h�ndelse �r satt att repeteras'
	,'event_no_repeat_msg' => 'Denna h�ndelse repeteras inte'
);

// ======================================================
// daily view
// ======================================================

$lang_daily_event_view = array(
	'section_title' => 'Daglig vy'
	,'next_day' => 'N�sta dag'
	,'previous_day' => 'F�reg�ende dag'
	,'no_events' => 'Det finns inga h�ndelser denna dag.'
);

// ======================================================
// weekly view
// ======================================================

$lang_weekly_event_view = array(
	'section_title' => 'Veckovy'
	,'week_period' => '%s - %s'
	,'next_week' => 'N�sta vecka'
	,'previous_week' => 'F�reg�ende vecka'
	,'selected_week' => 'Vecka %d'
	,'no_events' => 'Det finns inga h�ndelser denna vecka'
);

// ======================================================
// monthly view
// ======================================================

$lang_monthly_event_view = array(
	'section_title' => 'M�nadsvy'
	,'next_month' => 'N�sta m�nad'
	,'previous_month' => 'F�reg�ende m�nad'
);

// ======================================================
// flat view
// ======================================================

$lang_flat_event_view = array(
	'section_title' => 'Listvy'
	,'week_period' => '%s - %s'
	,'next_month' => 'N�sta m�nad'
	,'previous_month' => 'F�reg�ende m�nad'
	,'contact_info' => 'Kontaktinfo'
	,'contact_email' => 'E-post'
	,'contact_url' => 'URL'
	,'no_events' => 'Det finns inga h�ndelser denna m�nad'
);

// ======================================================
// Event view
// ======================================================

$lang_event_view = array(
	'section_title' => 'H�ndelsevy'
	,'display_event' => 'H�ndelse: \'%s\''
	,'cat_name' => 'Kategori'
	,'event_start_date' => 'Datum'
	,'event_end_date' => 'Till'
	,'event_duration' => 'Varaktighet'
	,'contact_info' => 'Kontaktinfo'
	,'contact_email' => 'E-post'
	,'contact_url' => 'URL'
	,'no_event' => 'Det finns inga h�ndelser att visa.'
	,'stats_string' => '<strong>%d</strong> H�ndelser totalt'
	,'edit_event' => 'Redigera H�ndelse'
	,'delete_event' => 'Radera H�ndelse'
	,'delete_confirm' => '�r du s�ker att du vill radera denna h�ndelse ?'
	
);

// ======================================================
// Categories view
// ======================================================

$lang_cats_view = array(
	'section_title' => 'Kategorivy'
	,'cat_name' => 'Kategorinamn'
	,'total_events' => 'Totalt h�ndelser'
	,'upcoming_events' => 'Kommande h�ndelser'
	,'no_cats' => 'Det finns inga kategorier att visa.'
	,'stats_string' => 'Det finns <strong>%d</strong> h�ndelser i <strong>%d</strong> kategorier'
);

// ======================================================
// Category Events view
// ======================================================

$lang_cat_events_view = array(
	'section_title' => 'H�ndelser under \'%s\''
	,'event_name' => 'H�ndelsenamn'
	,'event_date' => 'Datum'
	,'no_events' => 'Det finns inga h�ndelser i denna kategori.'
	,'stats_string' => 'Totalt <strong>%d</strong> h�ndelser'
	,'stats_string1' => '<strong>%d</strong> h�ndelse(r) i <strong>%d</strong> sid(or)'
);

// ======================================================
// cal_search.php
// ======================================================

$lang_event_search_data = array(
	'section_title' => 'S�k i kalender',
	'search_results' => 'S�kresultat',
	'category_label' => 'Kategori',
	'date_label' => 'Datum',
	'no_events' => 'Det finns inga h�ndelser under denna kategori.',
	'search_caption' => 'Skriv in n�gra nyckelord...',
	'search_again' => 'S�k igen',
	'search_button' => 'S�k',
// Misc.
	'no_results' => 'Inga resultat finna',	
// Stats
	'stats_string1' => '<strong>%d</strong> h�ndelse(r) funna',
	'stats_string2' => '<strong>%d</strong> h�ndelse(r) i <strong>%d</strong> sid(or)'
);

// ======================================================
// profile.php
// ======================================================

if (defined('PROFILE_PHP')) 

$lang_user_profile_data = array(
	'section_title' => 'Min profil',
	'edit_profile' => 'Redigera min profil',
	'update_profile' => 'Uppdatera min profil',
	'actions_label' => 'Val',
// Account Info
	'account_info_label' => 'Kontoinformation',
	'user_name' => 'Anv�ndarnamn',
	'user_pass' => 'L�senord',
	'user_pass_confirm' => 'Bekr�fta l�senord',
	'user_email' => 'E-postadress',
	'group_label' => 'Gruppmedlemskap',
// Other Details
	'other_details_label' => 'Andra detaljer',
	'first_name' => 'F�sta namn',
	'last_name' => 'Sista namn',
	'full_name' => 'Hela namnet',
	'user_website' => 'Hemsida',
	'user_location' => 'Plats',
	'user_occupation' => 'Yrke',
// Misc.
	'select_language' => 'V�lj spr�k',
	'edit_profile_success' => 'Profil uppdatederad',
	'update_pass_info' => 'L�mna l�senordsf�ltet tomt om du inte vill �ndra det',
// Error messages
	'invalid_password' => 'Mata in l�senord som best�r endast av boks�ver och siffror, mellan 4 och 16 tecken l�ngt !',
	'password_is_username' => 'L�senordet m�ste vara annat �n anv�ndarnamnet !',
	'password_not_match' =>'L�senordet du matat in st�mmer inte med det \'bekr�ftade l�senordet\'',
	'invalid_email' => 'Du m�ste mata in en giltig e-postadress !',
	'email_exists' => 'En annan anv�ndare har redan registrerat den e-postadress du matade in. Mata in en annan e-postadress !',
	'no_email' => 'Du m�ste mata in en e-postadress !',
	'invalid_email' => 'Du m�ste mata in en godk�nd e-pstadress !',
	'no_password' => 'Du m�ste mata in ett l�senord f�r ditt nya konto !'
);

// ======================================================
// register.php
// ======================================================

if (defined('USER_REGISTRATION_PHP')) 

$lang_user_registration_data = array(
	'section_title' => 'Anv�ndar registrering',
// Step 1: Terms & Conditions
	'terms_caption' => 'Villkor',
	'terms_intro' => 'F�r att kunna forts�tta m�ste du godk�nna f�ljande:',
	'terms_message' => 'Ta dig en stund och l�s reglerna nedan. Om du accepterar s� forts�tt med registreringen, klicka "Jag godk�nner" knappen nedan. F�r att avbryta registreringen, klicka \'tillbaka\' knappen i webbl�saren.<br /><br />Kom ih�g att vi inte ansvarar f�r h�ndelser postade av anv�ndare i denna kalender. Vi garanterar inte och svarar inte f�r eller riktigheten, fullst�ndigheten eller anv�ndbarheten i n�gon av de postade h�ndelserna, och vi �r inte ansvariga f�r inneh�llet i n�gon h�ndelse.<br /><br />Meddelandena uttrycker uttrycker f�rfattarnas st�ndpunkt om h�ndelsen, inte n�dv�ndigtvis webbplatsen och kalenderapplikationens st�ndpunkt. Anv�ndare som anser att en postad h�ndelse �r tvivelaktig karakt�r, uppmanas att kontakta oss omedelbart via e-post. Vi har m�jlighet att radera tvivelaktigt inneh�ll och vi kommer att anstr�nga oss f�r att g�ra det inom rimlig tid, om vi uppt�cker att radering �r n�dv�ndigt.<br /><br />Du samtycker, genom ditt anv�ndande av den h�r tj�nsten, att du inte kommer att anv�nda den h�r kalenderapplikationenf�r att posta n�got som helst inneh�ll som �r medvetet felaktigt och/eller vilseledande, f�rol�mpande, f�rnedrande, vulg�rt, rasistiskt, f�rnedrande, obscent, pornografiskt, hotfullt, inkr�ktande p� en persons privatliv, eller p� n�got annat s�tt medf�r �vertr�delse av n�gon lag.<br /><br />Du samtycker att inte posta n�got copyrightskyddat material annat �n om copyrightskyddet innehas av dig eller %s.',
	'terms_button' => 'Jag godk�nner',
	
// Account Info
	'account_info_label' => 'Kontoinformation',
	'user_name' => 'Anv�ndarnamn',
	'user_pass' => 'L�senord',
	'user_pass_confirm' => 'Bekr�fta l�senord',
	'user_email' => 'E-postadress',
// Other Details
	'other_details_label' => 'Andra Detaljer',
	'first_name' => 'F�rnamn',
	'last_name' => 'Efternamn',
	'user_website' => 'Hemsida',
	'user_location' => 'Ort',
	'user_occupation' => 'Yrke',
	'register_button' => 'Skicka din registrering',

// Stats
	'stats_string1' => '<strong>%d</strong> anv�ndare',
	'stats_string2' => '<strong>%d</strong> anv�ndare p� <strong>%d</strong> sid(or)',
// Misc.
	'reg_nomail_success' => 'Tack f�r din registrering.',
	'reg_mail_success' => 'Ett meddelande med information om hur du aktiverar ditt konto har skickats till e-postadressen du matat in.',
	'reg_activation_success' => 'Gratuelerar! Ditt konto �r nu aktivt och du kan logga in med ditt anv�ndarnamn och l�senord. Tack f�r att du registrerade dig.',
// Mail messages
	'reg_confirm_subject' => 'Registrering vid %s',
	
// Error messages
	'no_username' => 'Du m�ste mata in ett anv�ndarnamn !',
	'invalid_username' => 'Mata in ett anv�ndarnamn som endast best�r av bokst�ver och siffror, mellan 4 och 30 tecken l�ngt !',
	'username_exists' => 'Anv�ndarnamnet du matat in �r upptaget. F�rs�k med ett annat anv�ndarnamn !',
	'no_password' => 'Du m�ste mata in ett l�senord !',
	'invalid_password' => 'Mata in ett l�senord som endast best�r av bokst�ver och siffror, mellan 4 och 16 tecken l�ngt !',
	'password_is_username' => 'L�senordet m�ste skilja sig fr�n anv�ndarnamnet !',
	'password_not_match' =>'L�senordet du matat in st�mmer inte med det \'bekr�ftade L�senordet\'',
	'no_email' => 'Du m�ste mata in en e-postadress !',
	'invalid_email' => 'Du m�ste mata in en giltig e-postadress !',
	'email_exists' => 'En annan anv�ndare har redan registererat den e-postadressdu matat in. Mata in en annan epostadress !',
	'delete_user_failed' => 'Detta anv�ndarkonto kan inte raderas',
	'no_users' => 'Det finns inga anv�ndarkonton att visa !',
	'already_logged' => 'Du �r redan inloggad som medlem !',
	'registration_not_allowed' => 'Anv�ndarregistreringen �r tillf�lligt nere !',
	'reg_email_failed' => 'Ett fel uppstod n�r vi f�rs�kte skicka aktiveringsmeddelandet !',
	'reg_activation_failed' => 'Ett fel uppstod n�r aktiveringen behandlades !'

);
// Message body for email activation
$lang_user_registration_data['reg_confirm_body'] = <<<EOT
Tack f�r registeringen p� {CALENDAR_NAME}

Ditt anv�ndarnamn is : "{USERNAME}"
Ditt l�senord �r : "{PASSWORD}"

F�r att aktivera ditt konto, s� m�ste du klicka p� l�nken nedan
eller kopiera och klistra in i adressf�ltet i din browser.

{REG_LINK}

Mvh,

Systemansvarig {CALENDAR_NAME}

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
	'section_title' => 'H�ndelse Administration',
	'events_to_approve' => 'H�ndelse Administration: H�ndelser att godk�nna',
	'upcoming_events' => 'H�ndelse Administration: Kommande h�ndelser',
	'past_events' => 'H�ndelse Administration: Tidigare h�ndelser',
	'add_event' => 'L�gg till ny h�ndelse',
	'edit_event' => '�ndra h�ndelse',
	'view_event' => 'Visa h�ndelse',
	'approve_event' => 'Godk�nn h�ndelse',
	'update_event' => 'Updatera h�ndelseinfo',
	'delete_event' => 'Radera h�ndelse',
	'events_label' => 'H�ndelser',
	'auto_approve' => 'Godk�nn automatiskt',
	'date_label' => 'Datum',
	'actions_label' => 'Val',
	'events_filter_label' => 'Filtrera h�ndelser',
	'events_filter_options' => array('Visa alla h�ndelser','Visa endast ej godk�nda h�ndelser','Visa endast kommande h�ndelser','Visa endast tidigare'),
	'picture_attached' => 'bild bifogad',
// View Event
	'view_event_name' => 'H�ndelse: \'%s\'',
	'event_start_date' => 'Datum',
	'event_end_date' => 'Tills',
	'event_duration' => 'Varaktighet',
	'contact_info' => 'Kontaktinfo',
	'contact_email' => 'E-post',
	'contact_url' => 'URL',
// General Info
// Event form
	'edit_event_title' => 'H�ndelse: \'%s\'',
	'cat_name' => 'Kategori',
	'event_start_date' => 'Datum',
	'event_end_date' => 'Tills',
	'contact_info' => 'Kontaktinfo',
	'contact_email' => 'E-post',
	'contact_url' => 'URL',
	'no_event' => 'Det finns inga h�ndelser att visa.',
	'stats_string' => '<strong>%d</strong> H�ndelser totalt',
// Stats
	'stats_string1' => '<strong>%d</strong> h�ndelse(er)',
	'stats_string2' => 'Totalt: <strong>%d</strong> h�ndelser p� <strong>%d</strong> sid(or)',
// Misc.
	'add_event_success' => 'Ny h�ndelse adderad',
	'edit_event_success' => 'H�ndelse uppdaterad',
	'approve_event_success' => 'H�ndelse godk�nd',
	'delete_confirm' => '�r du s�ker du vill radera denna h�ndelse ?',
	'delete_event_success' => 'H�ndelse raderad',
	'active_label' => 'Aktiv',
	'not_active_label' => 'Ej aktiv',
// Error messages
	'no_event_name' => 'Du m�ste mata in ett namn f�r denna h�ndelse !',
	'no_event_desc' => 'Du m�ste mata in en beskrivning f�r denna h�ndelse !',
	'no_cat' => 'Du m�ste v�lja en kategori f�r denna h�ndelse !',
	'no_day' => 'Du m�ste v�lja en dag !',
	'no_month' => 'Du m�ste v�lja en m�nad !',
	'no_year' => 'Du m�ste v�lja ett �r !',
	'non_valid_date' => 'Mata in ett giltigt datum !',
	'end_days_invalid' => 'Kontrollera att \'Dagar\' f�ltet under \'Varaktighet\' endast best�r av siffror !',
	'end_hours_invalid' => 'Kontrollera att \'Timmar\' f�ltet under \'Varaktighet\' endast best�r av siffror !',
	'end_minutes_invalid' => 'Kontrollera att \'Minuter\' f�ltet under \'Varaktighet\' endast best�r av siffror !',
	'file_too_large' => 'Bilden du bifogade �r st�rre �n %d KBytes !',
	'non_valid_extension' => 'Filformatet f�r den bifogade bilden st�ds ej !',
	'delete_event_failed' => 'Denna h�ndelse kan inte raderas',
	'approve_event_failed' => 'Denna h�ndelse kan inte godk�nnas',
	'no_events' => 'Det finns inga h�ndelser att visa !',
	'move_image_failed' => 'Systemet misslyckades att flytta bilden !',
	'non_valid_dimensions' => 'Bildens bredd eller h�jd �r st�rre �n %s pixlar !',

	'recur_val_1_invalid' => 'Det inmatade v�rdet i \'upprepa intervall\' �r inte giltigt. Detta v�rde m�ste vara ett nummer st�rre �n \'0\' !',
	'recur_end_count_invalid' => 'Det inmatade v�rdet i \'antal f�rekomster\' �r inte giltigt. Detta v�rde m�ste vara ett nummer st�rre �n \'0\' !',
	'recur_end_until_invalid' => '\'upprepa tills\' datumet m�ste vara st�rre �n h�ndelsens start datum !'

);

// ======================================================
// admin_categories.php
// ======================================================

if (defined('ADMIN_CATS_PHP')) 

$lang_cat_admin_data = array(
	'section_title' => 'Kategori Administration',
	'add_cat' => 'L�gg till ny kategori',
	'edit_cat' => '�ndra kategori',
	'update_cat' => 'Uppdatera kategoriinfo',
	'delete_cat' => 'Radera kategori',
	'events_label' => 'H�ndelser',
	'visibility' => 'Synlighet',
	'actions_label' => 'Val',
	'users_label' => 'Anv�ndare',
	'admins_label' => 'Administrat�r',
// General Info
	'general_info_label' => 'Generell information',
	'cat_name' => 'Kategorinamn',
	'cat_desc' => 'Kategoribeskrivning',
	'cat_color' => 'F�rg',
	'pick_color' => 'V�lj f�rg!',
	'status_label' => 'Status',
// Administrative Options
	'admin_label' => 'Administrativa alternativ',
	'auto_admin_appr' => 'Autogodk�nn adminbidrag',
	'auto_user_appr' => 'Autogodk�nn anv�ndarbidrag',
// Stats
	'stats_string1' => '<strong>%d</strong> kategorier',
	'stats_string2' => 'Aktiva: <strong>%d</strong>&nbsp;&nbsp;&nbsp;Totalt: <strong>%d</strong>&nbsp;&nbsp;&nbsp;p� <strong>%d</strong> sid(or)',
// Misc.
	'add_cat_success' => 'Ny kategori adderad',
	'edit_cat_success' => 'Kategori uppdaterad',
	'delete_confirm' => '�r du s�ker p� att du vill radera denna kategori ?',
	'delete_cat_success' => 'Kategorin raderad',
	'active_label' => 'Aktiv',
	'not_active_label' => 'Ej aktiv',
// Error messages
	'no_cat_name' => 'Du m�ste mata in ett namn f�r denna kategori !',
	'no_cat_desc' => 'Du m�ste mata in en beskrivning f�r denna kategori !',
	'no_color' => 'Du m�ste mata in en f�rg f�r denna kategori !',
	'delete_cat_failed' => 'Denna kategori kan inte raderas',
	'no_cats' => 'Det finns inga kategorier att visa !',
	'cat_has_events' => 'Denna kategori inneh�ller %d h�ndelse(er) och kan d�rf�r inte raderas!<br>Radera kvarvarande h�ndelser i denna kategori och f�rs�k igen!'

);
// ======================================================
// admin_users.php
// ======================================================

if (defined('ADMIN_USERS_PHP')) 

$lang_user_admin_data = array(
	'section_title' => 'Anv�ndar Administration',
	'add_user' => 'L�gg till ny anv�ndare',
	'edit_user' => '�ndra anv�ndarinfo',
	'update_user' => 'Uppdatera anv�ndarinfo',
	'delete_user' => 'Radera anv�ndarkonto',
	'last_access' => 'Senaste inloggning',
	'actions_label' => 'Val',
	'active_label' => 'Aktiv',
	'not_active_label' => 'Ej aktiv',
// Account Info
	'account_info_label' => 'Kontoinformation',
	'user_name' => 'Anv�ndarnamn',
	'user_pass' => 'L�senord',
	'user_pass_confirm' => 'Bekr�fta l�senord',
	'user_email' => 'E-postadress',
	'group_label' => 'gruppmedlemskap',
	'status_label' => 'Kontostatus',
// Other Details
	'other_details_label' => '�vriga detaljer',
	'first_name' => 'F�rnamn',
	'last_name' => 'Efternamn',
	'user_website' => 'Hemsida',
	'user_location' => 'Ort',
	'user_occupation' => 'Yrke',
// Stats
	'stats_string1' => '<strong>%d</strong> anv�ndare',
	'stats_string2' => '<strong>%d</strong> anv�ndare p� <strong>%d</strong> sid(or)',
// Misc.
	'select_group' => 'V�lj en...',
	'add_user_success' => 'Anv�ndarkonto adderad',
	'edit_user_success' => 'Anv�ndarkonto uppdaterad',
	'delete_confirm' => '�r du s�ker p� att du vill radera detta konto?',
	'delete_user_success' => 'Anv�ndarkonto raderat',
	'update_pass_info' => 'L�mna l�senordsf�ltet om du inte vill �ndra det',
	'access_never' => 'Aldrig',
// Error messages
	'no_username' => 'Du m�ste mata in ett anv�ndarnamn !',
	'invalid_username' => 'Mata in ett anv�ndarnamn som endast best�r av bokst�ver och siffror, mellan 4 och 30 tecken l�ngt !',
	'invalid_password' => 'Mata in ett l�senord som endast best�r av bokst�ver och siffror, mellan 4 och 16 tecken l�ngt !',
	'password_is_username' => 'L�senordet m�ste skilja sig fr�n anv�ndarnamnet !',
	'L�senord_not_match' =>'L�senordet du matade in st�mmer inte mot det \'bekr�fta l�senord\'',
	'invalid_email' => 'Du m�ste mata in en giltig e-postadress !',
	'email_exists' => 'En annan anv�ndare har redan registrerat den e-postadress du matat in. Mata in en annan e-postadress !',
	'username_exists' => 'Anv�ndarnamnet du matade in �r upptaget. F�resl� ett annat anv�ndarnamn !',
	'no_email' => 'Du m�ste mata in en e-postadress !',
	'invalid_email' => 'Du m�ste mata in en giltig e-postadress !',
	'no_password' => 'Du m�ste mata in ett l�senord f�r det nya kontot !',
	'no_group' => 'V�lj en grupp av medlemskap f�r denna anv�ndare !',
	'delete_user_failed' => 'Detta anv�ndarkonto kan inte raderas',
	'no_users' => 'Det finns inga anv�ndarkonton att visa !'

);

// ======================================================
// admin_groups.php
// ======================================================

if (defined('ADMIN_GROUPS_PHP')) 

$lang_group_admin_data = array(
	'section_title' => 'Grupp Administration',
	'add_group' => 'L�gg till ny grupp',
	'edit_group' => '�ndra grupp',
	'update_group' => 'Uppdatera gruppinfo',
	'delete_group' => 'Radera grupp',
	'view_group' => 'Visa grupp',
	'users_label' => 'Medlemmar',
	'actions_label' => 'Val',
// General Info
	'general_info_label' => 'Generell information',
	'group_name' => 'Gruppnamn',
	'group_desc' => 'Gruppbeskrivning',
// Group Access Level
	'access_level_label' => 'Gruppaccessniv�',
	'has_admin_access' => 'Anv�ndare av denna grupp har �tkomstniv� som admin',
	'can_manage_accounts' => 'Anv�ndare av denna grupp kan hantera konton',
	'can_change_settings' => 'Anv�ndare av denna grupp kan �ndra kalenderinst�llningar',
	'can_manage_cats' => 'Anv�ndare av denna grupp kan underh�lla kategorier',
	'upl_need_approval' => 'Skickade h�ndelser kr�ver administrativt medgivande',
// Stats
	'stats_string1' => '<strong>%d</strong> grupper',
	'stats_string2' => 'Total: <strong>%d</strong> grupper p� <strong>%d</strong> sid(or)',

	'stats_string3' => 'Total: <strong>%d</strong> anv�ndare p� <strong>%d</strong> sid(or)',
// View Group Members
	'group_members_string' => 'Medlemmar av \'%s\' grupp',
	'username_label' => 'Anv�ndarnamn',
	'firstname_label' => 'F�rnamn',
	'lastname_label' => 'Efternamn',
	'email_label' => 'E-post',
	'last_access_label' => 'Senaste Access',
	'edit_user' => '�ndra anv�ndare',
	'delete_user' => 'Radera anv�ndare',
// Misc.
	'add_group_success' => 'Ny grupp adderad',
	'edit_group_success' => 'grupp uppdaterad',
	'delete_confirm' => '�r du s�ker p� att du vill radera denna grupp ?',
	'delete_user_confirm' => '�r du s�ker p� att du vill radera denna grupp ?',
	'delete_group_success' => 'grupp raderad',
	'no_users_string' => 'Det finns inga anv�ndare i denna grupp',
// Error messages
	'no_group_name' => 'Du m�ste mata in ett namn p� denna grupp !',
	'no_group_desc' => 'Du m�ste mata in en beskrivning f�r denna grupp !',
	'delete_group_failed' => 'This grupp kan inte raderas',
	'no_groups' => 'Det finns inga grupper att visa !',
	'group_has_users' => 'Denna grupp inneh�ller %d anv�ndare och kan d�rf�r inte raderas!<br>Frikoppla f�rst kvarvarande anv�ndare fr�n gruppen och f�rs�k igen!'

);

// ======================================================
// admin_settings.php / admin_settings_template.php / 
// admin_settings_updates.php
// ======================================================

$lang_settings_data = array(
	'section_title' => 'Kalenderinst�llningar'
// Links
	,'admin_links_text' => 'Val'
	,'admin_links' => array('Huvudinst�llningar','Mallkonfiguration','Produktuppdateringar')
// General Settings
	,'general_settings_label' => 'Generella inst�llningar'
	,'calendar_name' => 'Kalendernamn'
	,'calendar_description' => 'Kalenderbeskrivning'
	,'calendar_admin_email' => 'Kalender Administrat�rens e-post'
	,'cookie_name' => 'Namn p� cookie som anv�nds av skript'
	,'cookie_path' => 'S�kv�g till cookie som anv�nds av skript'
	,'debug_mode' => 'Starta debugl�ge'
	,'calendar_status' => 'Kalender publik status'
// Environment Settings
	,'env_settings_label' => 'Milj�inst�llningar'
	,'lang' => 'Spr�k'
		,'lang_name' => 'Spr�k'
		,'lang_native_name' => 'Lokalt namn'
		,'lang_trans_date' => '�versatt av'
		,'lang_author_name' => 'F�rfattare'
		,'lang_author_email' => 'E-post'
		,'lang_author_url' => 'Webbplats'
	,'charset' => 'Tecken kodning'
	,'theme' => 'Tema'
		,'theme_name' => 'Temanamn'
		,'theme_date_made' => 'Skapad'
		,'theme_author_name' => 'F�rfattare'
		,'theme_author_email' => 'E-post'
		,'theme_author_url' => 'Webbplats'
	,'timezone' => 'Tidszon offset'
	,'time_format' => 'Tidsformat'
		,'24hours' => '24 timmar'
		,'12hours' => '12 timmar'
	,'auto_daylight_saving' => 'Justera automatiskt f�r sommar/vintertid (DST)'
	,'main_table_width' => 'Bredd p� huvudtabell (Pixlar eller %)'
	,'day_start' => 'Vecka startar med'
	,'default_view' => 'Standardvy'
	,'search_view' => 'Visa s�kruta'
	,'archive' => 'Visa tidigare h�ndelser'
	,'events_per_page' => 'Antal h�ndelser per sida'
	,'sort_order' => 'Standard sorteringsordning'
		,'sort_order_title_a' => 'Titel stigande'
		,'sort_order_title_d' => 'Titel fallande'
		,'sort_order_date_a' => 'Datum stigande'
		,'sort_order_date_d' => 'Datum fallande'
	,'show_recurrent_events' => 'Visa �terkommande h�ndelser'
	,'multi_day_events' => 'Flera dagars h�ndelser'
		,'multi_day_events_all' => 'Visa hela datum omr�den'
		,'multi_day_events_bounds' => 'Visa endast start & slut datum'
		,'multi_day_events_start' => 'Visa endast startdatum'
	// User Settings
	,'user_settings_label' => 'Anv�ndarinst�llningar'
	,'allow_user_registration' => 'Till�t anv�ndarregistrering'
	,'reg_duplicate_emails' => 'Till�t flera med samma e-postadress'
	,'reg_email_verify' => 'Aktivera konto genom e-post aktivering'
// Event View
	,'event_view_label' => 'H�ndelsevy'
	,'popup_event_mode' => 'Pop-up h�ndelse'
	,'popup_event_width' => 'Bredd p� pop-up f�nster'
	,'popup_event_height' => 'H�jd p� pop-up f�nster'
// Add Event View
	,'add_event_view_label' => 'L�gg till h�ndelsevy'
	,'add_event_view' => 'Tillg�nglig'
	,'addevent_allow_html' => 'Till�t <b>BB Code</b> i beskrivningen'
	,'addevent_allow_contact' => 'Till�t kontakt'
	,'addevent_allow_email' => 'Till�t e-post'
	,'addevent_allow_url' => 'Till�t URL'
	,'addevent_allow_picture' => 'Till�t bilder'
	,'new_post_notification' => 'Ny post meddelande'
// Calendar View
	,'calendar_view_label' => 'Kalender (M�natlig) Vy'
	,'monthly_view' => 'Tillg�nglig'
	,'cal_view_show_week' => 'Visa veckonummer'
	,'cal_view_max_chars' => 'Maximalt antal tecken i beskrivningen'
// Flyer View
	,'flyer_view_label' => 'Flyervy'
	,'flyer_view' => 'Tillg�nglig'
	,'flyer_show_picture' => 'Visa bilder i flyervyn'
	,'flyer_view_max_chars' => 'Maximalt antal tecken i beskrivningen'
// Weekly View
	,'weekly_view_label' => 'Veckovy'
	,'weekly_view' => 'Tillg�nglig'
	,'weekly_view_max_chars' => 'Maximalt antal tecken i beskrivningen'
// Daily View
	,'daily_view_label' => 'Daglig vy'
	,'daily_view' => 'Tillg�nglig'
	,'daily_view_max_chars' => 'Maximalt antal tecken i beskrivningen'
// Categories View
	,'categories_view_label' => 'Kategorivy'
	,'cats_view' => 'Tillg�nglig'
	,'cats_view_max_chars' => 'Maximalt antal tecken i beskrivningen'
// Mini Calendar
	,'mini_cal_label' => 'Minikalender'
	,'mini_cal_def_picture' => 'Standardbild'
	,'mini_cal_display_picture' => 'Visa bild'
	,'mini_cal_diplay_options' => array('Ingen','Standardbild', 'Daglig bild','Veckobild','Slumpm�ssig bild')
// Mail Settings
	,'mail_settings_label' => 'E-post inst�llningar'
	,'mail_method' => 'Hur skall e-post skickas'
	,'mail_smtp_host' => 'SMTP Hosts (skiljt med semikolon ;)'
	,'mail_smtp_auth' => ' SMTP bekr�ftelse'
	,'mail_smtp_username' => 'SMTP Anv�ndarnamn'
	,'mail_smtp_password' => 'SMTP L�senord'

// Picture Settings
	,'picture_settings_label' => 'Bildinst�llningar'
	,'max_upl_dim' => 'Max. bredd eller h�jd f�r uppladdade bilder'
	,'max_upl_size' => 'Max. h�jd for uppladdade bilder (i Bytes)'
	,'picture_chmod' => 'Default mode f�r bilder (CHMOD) (i Octal)'
	,'allowed_file_extensions' => 'Godk�nda fil�ndelser f�r uppladdade bilder'
// Form Buttons
	,'update_config' => 'Spara ny konfiguration'
	,'restore_config' => '�terst�ll fabriksinst�llningar'
// Misc.
	,'update_settings_success' => 'Inst�llningar uppdaterade'
	,'restore_default_confirm' => '�r du s�ker p� att du vill �terst�lla till standardinst�llningarna ?'
// Template Configuration
	,'template_type' => 'Malltyp'
	,'template_header' => 'Header utseende'
	,'template_footer' => 'Footer utseende'
	,'template_status_default' => 'Anv�nd standard temamall'
	,'template_status_custom' => 'An�vnd f�ljande mall:'
	,'template_custom' => 'Anpassad mall'

	,'info_meta' => 'Meta Information'
	,'info_status' => 'Statuskontroll'
	,'info_status_default' => 'St�ng av detta inneh�ll'
	,'info_status_custom' => 'Visa f�ljande inneh�ll:'
	,'info_custom' => 'Anpassat inneh�ll'

	,'dynamic_tags' => 'Dynamiska Taggar'

// Product Updates
	,'updates_check_text' => 'V�nta medan information h�mtas fr�n servern...'
	,'updates_no_response' => 'Ingen respons fr�n servern. F�rs�k igen senare.'
	,'avail_updates' => 'M�jliga uppdateringar'
	,'updates_download_zip' => 'Ladda ner ZIP paket (.zip)'
	,'updates_download_tgz' => 'Ladda ner TGZ paket (.tar.gz)'
	,'updates_released_label' => 'Releasedatum: %s'
	,'updates_no_update' => 'Du k�r den senast tillg�ngliga versionen. Ingen uppdatering beh�vs.'
);

// ======================================================
// cal_mini.inc.php
// ======================================================

$lang_mini_cal = array(
	'def_pic' => 'Standardbild'
	,'daily_pic' => 'Dagens bild (%s)'
	,'weekly_pic' => 'Veckans bild (%s)'
	,'rand_pic' => 'Slumpm�ssig bild (%s)'
	,'post_event' => 'L�gg till ny h�ndelse'
	,'num_events' => '%d H�ndelse(r)'
	,'selected_week' => 'Vecka %d'
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
	'section_title' => 'Inloggningssk�rm'
// General Settings
	,'login_intro' => 'Skriv in anv�ndarnamn och l�senord f�r att logga in'
	,'username' => 'Anv�ndarnamn'
	,'password' => 'L�senord'
	,'remember_me' => 'kom ih�g mig'
	,'login_button' => 'Login'
// Errors
	,'invalid_login' => 'Verifiera inloggningen och f�rs�k igen!'
	,'no_username' => 'Du m�ste mata in ett anv�ndarnamn !'
	,'already_logged' => 'Du �r redan inloggad !'
);

// ======================================================
// logout.php
// ======================================================

// To Be Done


?>