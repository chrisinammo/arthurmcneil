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
	,'nativename' => 'Svenska' // Language name in native language. E.g: 'Français' for 'French'
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
	,'continue' => 'Fortsätt'
	,'close' => 'Stäng'
	,'errors' => 'Fel'
	,'info' => 'Information'
	,'day' => 'Dag'
	,'days' => 'Dagar'
	,'month' => 'Månad'
	,'months' => 'Månader'
	,'year' => 'År'
	,'years' => 'År'
	,'hour' => 'Timme'
	,'hours' => 'Timmar'
	,'minute' => 'Minut'
	,'minutes' => 'Minuter'
	,'everyday' => 'Varje Dag'
	,'everymonth' => 'Varje Månad'
	,'everyyear' => 'Varje år'
	,'active' => 'Aktiv'
	,'not_active' => 'Ej Aktiv'
	,'today' => 'Idag'
	,'signature' => 'Powered by %s'
	,'expand' => 'Expandera'
	,'collapse' => 'Förminska'
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
	,'day_of_week' => array('Söndag','Måndag','Tisdag','Onsdag','Torsdag','Fredag','Lördag')
	,'months' => array('Januari','Februari','Mars','April','Maj','Juni','Juli','Augusti','September','Oktober','November','December')
);

$lang_system = array (
	'system_caption' => 'Systemmeddelande'
  ,'page_access_denied' => 'Du har inte tillräcklig behörighet att hämta denna sida.'
  ,'page_requires_login' => 'Du måste logga in för att nå denna sida.'
  ,'operation_denied' => 'Du har inte tillräcklig behörighet att utföra denna instruktion.'
	,'section_disabled' => 'Denna del är tillfälligt nere !'
  ,'non_exist_cat' => 'Den valda kategorin finns inte !'
  ,'non_exist_event' => 'Den valda händelsen finns inte !'
  ,'param_missing' => 'De inmatatade parametrarna är inte korrekta.'
  ,'no_events' => 'Det finns inga händelser att visa'
  ,'config_string' => 'Du använder för närvarande \'%s\' som körs på %s, %s och %s.'
  ,'no_table' => '\'%s\' tabellen finns inte !'
  ,'no_anonymous_group' => '%s tabellen innehåller inte gruppen \'Anonymous\' !'
  ,'calendar_locked' => 'Tjänsten är tillfälligt nere för service och uppgradering. Vi ber om utsäkt för detta !'
	,'new_upgrade' => 'Systemet har funnit en ny version. Det är att rekommendera en uppgradering nu. Klicka "Fortsätt" för att starta uppgraderingsverktyget.'
	,'no_profile' => 'Ett fel inträffade när din profil hämtades'
	,'unknown_component' => 'Okänd komponent'
// Mail messages
	,'new_event_subject' => 'Ny händelse %s'
	,'event_notification_failed' => 'Ett fel inträffade när ett informations-Epost skulle skickas !'
);

// Message body for new event email notification
$lang_system['event_notification_body'] = <<<EOT
Följande händelse har skickats {CALENDAR_NAME}

Titel: "{TITLE}"
Datum: "{DATE}"
Varaktighet: "{DURATION}"

Du kan nå denna händelse genom att klicka i länken nedan
eller kopiera och klistra in i din webbläsarer.

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
	,'admin_events' => 'Händelser'
  ,'admin_categories' => 'Kategorier'
  ,'admin_groups' => 'Grupper'
  ,'admin_users' => 'Användare'
  ,'admin_settings' => 'Inställningar'
);

// Main menu entries
$lang_main_menu = array (
	'add_event' => 'Lägg till händelse'
	,'cal_view' => 'Månadsformat'
  ,'flat_view' => 'Listformat'
  ,'weekly_view' => 'Veckoformat'
  ,'daily_view' => 'Dagformat'
  ,'yearly_view' => 'Årsformat'
  ,'categories_view' => 'Kategorier'
  ,'search_view' => 'Sök'
);

// ======================================================
// Add Event view
// ======================================================

$lang_add_event_view = array(
	'section_title' => 'Lägg till händelse'
	,'edit_event' => 'Redigera händelse [id%d] \'%s\''
	,'update_event_button' => 'Updatera händelse'

// Event details
	,'event_details_label' => 'Händelsedetaljer'
	,'event_title' => 'Händelsetitel'
	,'event_desc' => 'Händelsebeskrivning'
	,'event_cat' => 'Kategori'
	,'choose_cat' => 'Välj en kategori'
	,'event_date' => 'Händelsedatum'
	,'day_label' => 'Dag'
	,'month_label' => 'Månad'
	,'year_label' => 'År'
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
	,'repeat_event_label' => 'Upprepa händelse'
	,'repeat_method_label' => 'Upprepa metod'
	,'repeat_none' => 'Upprepa inte denna händelse'
	,'repeat_every' => 'Upprepa varje'
	,'repeat_days' => 'Dag(ar)'
	,'repeat_weeks' => 'Vecka(or)'
	,'repeat_months' => 'Månad(er)'
	,'repeat_years' => 'År'
	,'repeat_end_date_label' => 'Upprepa slutdatum'
	,'repeat_end_date_none' => 'Inget slutdatum'
	,'repeat_end_date_count' => 'Avsluta efter %s förekomster'
	,'repeat_end_date_until' => 'Upprepa till'
// Other details
	,'other_details_label' => 'Övriga detaljer'
	,'picture_file' => 'Bildfil'
	,'file_upload_info' => '(%d KBytes begr. - Godkänt uttryck : %s )' 
	,'del_picture' => 'Radera nuvarande bild ?'
// Administrative options
	,'admin_options_label' => 'Administrativa val'
	,'auto_appr_event' => 'Händelse godkänd'

// Error messages
	,'no_title' => 'Du måste mata in en händelsetitel !'
	,'no_desc' => 'Du måste mata in en beskrivning för denna händelse !'
	,'no_cat' => 'Du måste välja en kategori från rullmenyn !'
	,'date_invalid' => 'Du måste mata in ett giltigt datum för händelsen !'
	,'end_days_invalid' => 'Det inmatade värdet i \'Dagar\' fältet är inte giltigt !'
	,'end_hours_invalid' => 'Det inmatade värdet i \'Timmar\' fältet är inte giltigt !'
	,'end_minutes_invalid' => 'Det inmatade värdet i \'Minuter\' fältet är inte giltigt !'

	,'non_valid_extension' => 'Filformatet för den valda bilden stöds inte ! (Godkända ändelser: %s)'

	,'file_too_large' => 'Bilden du vill bifoga är större än %d KBytes !'
	,'move_image_failed' => 'Systemet misslyckades att ladda upp bilden. Kontrollera att bilden är av rätt typ och inte för stor, eller meddela systemadministrören.'
	,'non_valid_dimensions' => 'Bildens bredd eller höjd är större än %s pixlar !'

	,'recur_val_1_invalid' => 'Det inmatade värdet i \'upprepa intervall\' är inte giltigt. Detta värde måste vara ett nummer större än \'0\' !'
	,'recur_end_count_invalid' => 'Det inmatade värdet i \'antalet förekomster\' är inte giltigt. Detta värde måste vara ett nummer större än \'0\' !'
	,'recur_end_until_invalid' => 'The \'upprepa until\' datum måste vara senare än händelsens startdatum !'
// Misc. messages
	,'submit_event_pending' => 'Din händelse väntar på godkännande. Tack för ditt bidrag!'
	,'submit_event_approved' => 'Din händelse är automatiskt godkänd. Tack för ditt bidrag!'
	,'event_repeat_msg' => 'Denna händelse är satt att repeteras'
	,'event_no_repeat_msg' => 'Denna händelse repeteras inte'
);

// ======================================================
// daily view
// ======================================================

$lang_daily_event_view = array(
	'section_title' => 'Daglig vy'
	,'next_day' => 'Nästa dag'
	,'previous_day' => 'Föregående dag'
	,'no_events' => 'Det finns inga händelser denna dag.'
);

// ======================================================
// weekly view
// ======================================================

$lang_weekly_event_view = array(
	'section_title' => 'Veckovy'
	,'week_period' => '%s - %s'
	,'next_week' => 'Nästa vecka'
	,'previous_week' => 'Föregående vecka'
	,'selected_week' => 'Vecka %d'
	,'no_events' => 'Det finns inga händelser denna vecka'
);

// ======================================================
// monthly view
// ======================================================

$lang_monthly_event_view = array(
	'section_title' => 'Månadsvy'
	,'next_month' => 'Nästa månad'
	,'previous_month' => 'Föregående månad'
);

// ======================================================
// flat view
// ======================================================

$lang_flat_event_view = array(
	'section_title' => 'Listvy'
	,'week_period' => '%s - %s'
	,'next_month' => 'Nästa månad'
	,'previous_month' => 'Föregående månad'
	,'contact_info' => 'Kontaktinfo'
	,'contact_email' => 'E-post'
	,'contact_url' => 'URL'
	,'no_events' => 'Det finns inga händelser denna månad'
);

// ======================================================
// Event view
// ======================================================

$lang_event_view = array(
	'section_title' => 'Händelsevy'
	,'display_event' => 'Händelse: \'%s\''
	,'cat_name' => 'Kategori'
	,'event_start_date' => 'Datum'
	,'event_end_date' => 'Till'
	,'event_duration' => 'Varaktighet'
	,'contact_info' => 'Kontaktinfo'
	,'contact_email' => 'E-post'
	,'contact_url' => 'URL'
	,'no_event' => 'Det finns inga händelser att visa.'
	,'stats_string' => '<strong>%d</strong> Händelser totalt'
	,'edit_event' => 'Redigera Händelse'
	,'delete_event' => 'Radera Händelse'
	,'delete_confirm' => 'är du säker att du vill radera denna händelse ?'
	
);

// ======================================================
// Categories view
// ======================================================

$lang_cats_view = array(
	'section_title' => 'Kategorivy'
	,'cat_name' => 'Kategorinamn'
	,'total_events' => 'Totalt händelser'
	,'upcoming_events' => 'Kommande händelser'
	,'no_cats' => 'Det finns inga kategorier att visa.'
	,'stats_string' => 'Det finns <strong>%d</strong> händelser i <strong>%d</strong> kategorier'
);

// ======================================================
// Category Events view
// ======================================================

$lang_cat_events_view = array(
	'section_title' => 'Händelser under \'%s\''
	,'event_name' => 'Händelsenamn'
	,'event_date' => 'Datum'
	,'no_events' => 'Det finns inga händelser i denna kategori.'
	,'stats_string' => 'Totalt <strong>%d</strong> händelser'
	,'stats_string1' => '<strong>%d</strong> händelse(r) i <strong>%d</strong> sid(or)'
);

// ======================================================
// cal_search.php
// ======================================================

$lang_event_search_data = array(
	'section_title' => 'Sök i kalender',
	'search_results' => 'Sökresultat',
	'category_label' => 'Kategori',
	'date_label' => 'Datum',
	'no_events' => 'Det finns inga händelser under denna kategori.',
	'search_caption' => 'Skriv in några nyckelord...',
	'search_again' => 'Sök igen',
	'search_button' => 'Sök',
// Misc.
	'no_results' => 'Inga resultat finna',	
// Stats
	'stats_string1' => '<strong>%d</strong> händelse(r) funna',
	'stats_string2' => '<strong>%d</strong> händelse(r) i <strong>%d</strong> sid(or)'
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
	'user_name' => 'Användarnamn',
	'user_pass' => 'Lösenord',
	'user_pass_confirm' => 'Bekräfta lösenord',
	'user_email' => 'E-postadress',
	'group_label' => 'Gruppmedlemskap',
// Other Details
	'other_details_label' => 'Andra detaljer',
	'first_name' => 'Fösta namn',
	'last_name' => 'Sista namn',
	'full_name' => 'Hela namnet',
	'user_website' => 'Hemsida',
	'user_location' => 'Plats',
	'user_occupation' => 'Yrke',
// Misc.
	'select_language' => 'Välj språk',
	'edit_profile_success' => 'Profil uppdatederad',
	'update_pass_info' => 'Lämna lösenordsfältet tomt om du inte vill ändra det',
// Error messages
	'invalid_password' => 'Mata in lösenord som består endast av boksäver och siffror, mellan 4 och 16 tecken långt !',
	'password_is_username' => 'Lösenordet måste vara annat än användarnamnet !',
	'password_not_match' =>'Lösenordet du matat in stämmer inte med det \'bekräftade lösenordet\'',
	'invalid_email' => 'Du måste mata in en giltig e-postadress !',
	'email_exists' => 'En annan användare har redan registrerat den e-postadress du matade in. Mata in en annan e-postadress !',
	'no_email' => 'Du måste mata in en e-postadress !',
	'invalid_email' => 'Du måste mata in en godkänd e-pstadress !',
	'no_password' => 'Du måste mata in ett lösenord för ditt nya konto !'
);

// ======================================================
// register.php
// ======================================================

if (defined('USER_REGISTRATION_PHP')) 

$lang_user_registration_data = array(
	'section_title' => 'Användar registrering',
// Step 1: Terms & Conditions
	'terms_caption' => 'Villkor',
	'terms_intro' => 'För att kunna fortsätta måste du godkänna följande:',
	'terms_message' => 'Ta dig en stund och läs reglerna nedan. Om du accepterar så fortsätt med registreringen, klicka "Jag godkänner" knappen nedan. För att avbryta registreringen, klicka \'tillbaka\' knappen i webbläsaren.<br /><br />Kom ihåg att vi inte ansvarar för händelser postade av användare i denna kalender. Vi garanterar inte och svarar inte för eller riktigheten, fullständigheten eller användbarheten i någon av de postade händelserna, och vi är inte ansvariga för innehållet i någon händelse.<br /><br />Meddelandena uttrycker uttrycker författarnas ståndpunkt om händelsen, inte nödvändigtvis webbplatsen och kalenderapplikationens ståndpunkt. Användare som anser att en postad händelse är tvivelaktig karaktär, uppmanas att kontakta oss omedelbart via e-post. Vi har möjlighet att radera tvivelaktigt innehåll och vi kommer att anstränga oss för att göra det inom rimlig tid, om vi upptäcker att radering är nödvändigt.<br /><br />Du samtycker, genom ditt användande av den här tjänsten, att du inte kommer att använda den här kalenderapplikationenför att posta något som helst innehåll som är medvetet felaktigt och/eller vilseledande, förolämpande, förnedrande, vulgärt, rasistiskt, förnedrande, obscent, pornografiskt, hotfullt, inkräktande på en persons privatliv, eller på något annat sätt medför överträdelse av någon lag.<br /><br />Du samtycker att inte posta något copyrightskyddat material annat än om copyrightskyddet innehas av dig eller %s.',
	'terms_button' => 'Jag godkänner',
	
// Account Info
	'account_info_label' => 'Kontoinformation',
	'user_name' => 'Användarnamn',
	'user_pass' => 'Lösenord',
	'user_pass_confirm' => 'Bekräfta lösenord',
	'user_email' => 'E-postadress',
// Other Details
	'other_details_label' => 'Andra Detaljer',
	'first_name' => 'Förnamn',
	'last_name' => 'Efternamn',
	'user_website' => 'Hemsida',
	'user_location' => 'Ort',
	'user_occupation' => 'Yrke',
	'register_button' => 'Skicka din registrering',

// Stats
	'stats_string1' => '<strong>%d</strong> användare',
	'stats_string2' => '<strong>%d</strong> användare på <strong>%d</strong> sid(or)',
// Misc.
	'reg_nomail_success' => 'Tack för din registrering.',
	'reg_mail_success' => 'Ett meddelande med information om hur du aktiverar ditt konto har skickats till e-postadressen du matat in.',
	'reg_activation_success' => 'Gratuelerar! Ditt konto är nu aktivt och du kan logga in med ditt användarnamn och lösenord. Tack för att du registrerade dig.',
// Mail messages
	'reg_confirm_subject' => 'Registrering vid %s',
	
// Error messages
	'no_username' => 'Du måste mata in ett användarnamn !',
	'invalid_username' => 'Mata in ett användarnamn som endast består av bokstäver och siffror, mellan 4 och 30 tecken långt !',
	'username_exists' => 'Användarnamnet du matat in är upptaget. Försök med ett annat användarnamn !',
	'no_password' => 'Du måste mata in ett lösenord !',
	'invalid_password' => 'Mata in ett lösenord som endast består av bokstäver och siffror, mellan 4 och 16 tecken långt !',
	'password_is_username' => 'Lösenordet måste skilja sig från användarnamnet !',
	'password_not_match' =>'Lösenordet du matat in stämmer inte med det \'bekräftade Lösenordet\'',
	'no_email' => 'Du måste mata in en e-postadress !',
	'invalid_email' => 'Du måste mata in en giltig e-postadress !',
	'email_exists' => 'En annan användare har redan registererat den e-postadressdu matat in. Mata in en annan epostadress !',
	'delete_user_failed' => 'Detta användarkonto kan inte raderas',
	'no_users' => 'Det finns inga användarkonton att visa !',
	'already_logged' => 'Du är redan inloggad som medlem !',
	'registration_not_allowed' => 'Användarregistreringen är tillfälligt nere !',
	'reg_email_failed' => 'Ett fel uppstod när vi försökte skicka aktiveringsmeddelandet !',
	'reg_activation_failed' => 'Ett fel uppstod när aktiveringen behandlades !'

);
// Message body for email activation
$lang_user_registration_data['reg_confirm_body'] = <<<EOT
Tack för registeringen på {CALENDAR_NAME}

Ditt användarnamn is : "{USERNAME}"
Ditt lösenord är : "{PASSWORD}"

För att aktivera ditt konto, så måste du klicka på länken nedan
eller kopiera och klistra in i adressfältet i din browser.

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
	'section_title' => 'Händelse Administration',
	'events_to_approve' => 'Händelse Administration: Händelser att godkänna',
	'upcoming_events' => 'Händelse Administration: Kommande händelser',
	'past_events' => 'Händelse Administration: Tidigare händelser',
	'add_event' => 'Lägg till ny händelse',
	'edit_event' => 'ändra händelse',
	'view_event' => 'Visa händelse',
	'approve_event' => 'Godkänn händelse',
	'update_event' => 'Updatera händelseinfo',
	'delete_event' => 'Radera händelse',
	'events_label' => 'Händelser',
	'auto_approve' => 'Godkänn automatiskt',
	'date_label' => 'Datum',
	'actions_label' => 'Val',
	'events_filter_label' => 'Filtrera händelser',
	'events_filter_options' => array('Visa alla händelser','Visa endast ej godkända händelser','Visa endast kommande händelser','Visa endast tidigare'),
	'picture_attached' => 'bild bifogad',
// View Event
	'view_event_name' => 'Händelse: \'%s\'',
	'event_start_date' => 'Datum',
	'event_end_date' => 'Tills',
	'event_duration' => 'Varaktighet',
	'contact_info' => 'Kontaktinfo',
	'contact_email' => 'E-post',
	'contact_url' => 'URL',
// General Info
// Event form
	'edit_event_title' => 'Händelse: \'%s\'',
	'cat_name' => 'Kategori',
	'event_start_date' => 'Datum',
	'event_end_date' => 'Tills',
	'contact_info' => 'Kontaktinfo',
	'contact_email' => 'E-post',
	'contact_url' => 'URL',
	'no_event' => 'Det finns inga händelser att visa.',
	'stats_string' => '<strong>%d</strong> Händelser totalt',
// Stats
	'stats_string1' => '<strong>%d</strong> händelse(er)',
	'stats_string2' => 'Totalt: <strong>%d</strong> händelser på <strong>%d</strong> sid(or)',
// Misc.
	'add_event_success' => 'Ny händelse adderad',
	'edit_event_success' => 'Händelse uppdaterad',
	'approve_event_success' => 'Händelse godkänd',
	'delete_confirm' => 'är du säker du vill radera denna händelse ?',
	'delete_event_success' => 'Händelse raderad',
	'active_label' => 'Aktiv',
	'not_active_label' => 'Ej aktiv',
// Error messages
	'no_event_name' => 'Du måste mata in ett namn för denna händelse !',
	'no_event_desc' => 'Du måste mata in en beskrivning för denna händelse !',
	'no_cat' => 'Du måste välja en kategori för denna händelse !',
	'no_day' => 'Du måste välja en dag !',
	'no_month' => 'Du måste välja en månad !',
	'no_year' => 'Du måste välja ett år !',
	'non_valid_date' => 'Mata in ett giltigt datum !',
	'end_days_invalid' => 'Kontrollera att \'Dagar\' fältet under \'Varaktighet\' endast består av siffror !',
	'end_hours_invalid' => 'Kontrollera att \'Timmar\' fältet under \'Varaktighet\' endast består av siffror !',
	'end_minutes_invalid' => 'Kontrollera att \'Minuter\' fältet under \'Varaktighet\' endast består av siffror !',
	'file_too_large' => 'Bilden du bifogade är större än %d KBytes !',
	'non_valid_extension' => 'Filformatet för den bifogade bilden stöds ej !',
	'delete_event_failed' => 'Denna händelse kan inte raderas',
	'approve_event_failed' => 'Denna händelse kan inte godkännas',
	'no_events' => 'Det finns inga händelser att visa !',
	'move_image_failed' => 'Systemet misslyckades att flytta bilden !',
	'non_valid_dimensions' => 'Bildens bredd eller höjd är större än %s pixlar !',

	'recur_val_1_invalid' => 'Det inmatade värdet i \'upprepa intervall\' är inte giltigt. Detta värde måste vara ett nummer större än \'0\' !',
	'recur_end_count_invalid' => 'Det inmatade värdet i \'antal förekomster\' är inte giltigt. Detta värde måste vara ett nummer större än \'0\' !',
	'recur_end_until_invalid' => '\'upprepa tills\' datumet måste vara större än händelsens start datum !'

);

// ======================================================
// admin_categories.php
// ======================================================

if (defined('ADMIN_CATS_PHP')) 

$lang_cat_admin_data = array(
	'section_title' => 'Kategori Administration',
	'add_cat' => 'Lägg till ny kategori',
	'edit_cat' => 'ändra kategori',
	'update_cat' => 'Uppdatera kategoriinfo',
	'delete_cat' => 'Radera kategori',
	'events_label' => 'Händelser',
	'visibility' => 'Synlighet',
	'actions_label' => 'Val',
	'users_label' => 'Användare',
	'admins_label' => 'Administratör',
// General Info
	'general_info_label' => 'Generell information',
	'cat_name' => 'Kategorinamn',
	'cat_desc' => 'Kategoribeskrivning',
	'cat_color' => 'Färg',
	'pick_color' => 'Välj färg!',
	'status_label' => 'Status',
// Administrative Options
	'admin_label' => 'Administrativa alternativ',
	'auto_admin_appr' => 'Autogodkänn adminbidrag',
	'auto_user_appr' => 'Autogodkänn användarbidrag',
// Stats
	'stats_string1' => '<strong>%d</strong> kategorier',
	'stats_string2' => 'Aktiva: <strong>%d</strong>&nbsp;&nbsp;&nbsp;Totalt: <strong>%d</strong>&nbsp;&nbsp;&nbsp;på <strong>%d</strong> sid(or)',
// Misc.
	'add_cat_success' => 'Ny kategori adderad',
	'edit_cat_success' => 'Kategori uppdaterad',
	'delete_confirm' => 'är du säker på att du vill radera denna kategori ?',
	'delete_cat_success' => 'Kategorin raderad',
	'active_label' => 'Aktiv',
	'not_active_label' => 'Ej aktiv',
// Error messages
	'no_cat_name' => 'Du måste mata in ett namn för denna kategori !',
	'no_cat_desc' => 'Du måste mata in en beskrivning för denna kategori !',
	'no_color' => 'Du måste mata in en färg för denna kategori !',
	'delete_cat_failed' => 'Denna kategori kan inte raderas',
	'no_cats' => 'Det finns inga kategorier att visa !',
	'cat_has_events' => 'Denna kategori innehåller %d händelse(er) och kan därför inte raderas!<br>Radera kvarvarande händelser i denna kategori och försök igen!'

);
// ======================================================
// admin_users.php
// ======================================================

if (defined('ADMIN_USERS_PHP')) 

$lang_user_admin_data = array(
	'section_title' => 'Användar Administration',
	'add_user' => 'Lägg till ny användare',
	'edit_user' => 'ändra användarinfo',
	'update_user' => 'Uppdatera användarinfo',
	'delete_user' => 'Radera användarkonto',
	'last_access' => 'Senaste inloggning',
	'actions_label' => 'Val',
	'active_label' => 'Aktiv',
	'not_active_label' => 'Ej aktiv',
// Account Info
	'account_info_label' => 'Kontoinformation',
	'user_name' => 'Användarnamn',
	'user_pass' => 'Lösenord',
	'user_pass_confirm' => 'Bekräfta lösenord',
	'user_email' => 'E-postadress',
	'group_label' => 'gruppmedlemskap',
	'status_label' => 'Kontostatus',
// Other Details
	'other_details_label' => 'övriga detaljer',
	'first_name' => 'Förnamn',
	'last_name' => 'Efternamn',
	'user_website' => 'Hemsida',
	'user_location' => 'Ort',
	'user_occupation' => 'Yrke',
// Stats
	'stats_string1' => '<strong>%d</strong> användare',
	'stats_string2' => '<strong>%d</strong> användare på <strong>%d</strong> sid(or)',
// Misc.
	'select_group' => 'Välj en...',
	'add_user_success' => 'Användarkonto adderad',
	'edit_user_success' => 'Användarkonto uppdaterad',
	'delete_confirm' => 'är du säker på att du vill radera detta konto?',
	'delete_user_success' => 'Användarkonto raderat',
	'update_pass_info' => 'Lämna lösenordsfältet om du inte vill ändra det',
	'access_never' => 'Aldrig',
// Error messages
	'no_username' => 'Du måste mata in ett användarnamn !',
	'invalid_username' => 'Mata in ett användarnamn som endast består av bokstäver och siffror, mellan 4 och 30 tecken långt !',
	'invalid_password' => 'Mata in ett lösenord som endast består av bokstäver och siffror, mellan 4 och 16 tecken långt !',
	'password_is_username' => 'Lösenordet måste skilja sig från användarnamnet !',
	'Lösenord_not_match' =>'Lösenordet du matade in stämmer inte mot det \'bekräfta lösenord\'',
	'invalid_email' => 'Du måste mata in en giltig e-postadress !',
	'email_exists' => 'En annan användare har redan registrerat den e-postadress du matat in. Mata in en annan e-postadress !',
	'username_exists' => 'Användarnamnet du matade in är upptaget. Föreslå ett annat användarnamn !',
	'no_email' => 'Du måste mata in en e-postadress !',
	'invalid_email' => 'Du måste mata in en giltig e-postadress !',
	'no_password' => 'Du måste mata in ett lösenord för det nya kontot !',
	'no_group' => 'Välj en grupp av medlemskap för denna användare !',
	'delete_user_failed' => 'Detta användarkonto kan inte raderas',
	'no_users' => 'Det finns inga användarkonton att visa !'

);

// ======================================================
// admin_groups.php
// ======================================================

if (defined('ADMIN_GROUPS_PHP')) 

$lang_group_admin_data = array(
	'section_title' => 'Grupp Administration',
	'add_group' => 'Lägg till ny grupp',
	'edit_group' => 'ändra grupp',
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
	'access_level_label' => 'Gruppaccessnivå',
	'has_admin_access' => 'Användare av denna grupp har åtkomstnivå som admin',
	'can_manage_accounts' => 'Användare av denna grupp kan hantera konton',
	'can_change_settings' => 'Användare av denna grupp kan ändra kalenderinställningar',
	'can_manage_cats' => 'Användare av denna grupp kan underhålla kategorier',
	'upl_need_approval' => 'Skickade händelser kräver administrativt medgivande',
// Stats
	'stats_string1' => '<strong>%d</strong> grupper',
	'stats_string2' => 'Total: <strong>%d</strong> grupper på <strong>%d</strong> sid(or)',

	'stats_string3' => 'Total: <strong>%d</strong> användare på <strong>%d</strong> sid(or)',
// View Group Members
	'group_members_string' => 'Medlemmar av \'%s\' grupp',
	'username_label' => 'Användarnamn',
	'firstname_label' => 'Förnamn',
	'lastname_label' => 'Efternamn',
	'email_label' => 'E-post',
	'last_access_label' => 'Senaste Access',
	'edit_user' => 'ändra användare',
	'delete_user' => 'Radera användare',
// Misc.
	'add_group_success' => 'Ny grupp adderad',
	'edit_group_success' => 'grupp uppdaterad',
	'delete_confirm' => 'är du säker på att du vill radera denna grupp ?',
	'delete_user_confirm' => 'är du säker på att du vill radera denna grupp ?',
	'delete_group_success' => 'grupp raderad',
	'no_users_string' => 'Det finns inga användare i denna grupp',
// Error messages
	'no_group_name' => 'Du måste mata in ett namn på denna grupp !',
	'no_group_desc' => 'Du måste mata in en beskrivning för denna grupp !',
	'delete_group_failed' => 'This grupp kan inte raderas',
	'no_groups' => 'Det finns inga grupper att visa !',
	'group_has_users' => 'Denna grupp innehåller %d användare och kan därför inte raderas!<br>Frikoppla först kvarvarande användare från gruppen och försök igen!'

);

// ======================================================
// admin_settings.php / admin_settings_template.php / 
// admin_settings_updates.php
// ======================================================

$lang_settings_data = array(
	'section_title' => 'Kalenderinställningar'
// Links
	,'admin_links_text' => 'Val'
	,'admin_links' => array('Huvudinställningar','Mallkonfiguration','Produktuppdateringar')
// General Settings
	,'general_settings_label' => 'Generella inställningar'
	,'calendar_name' => 'Kalendernamn'
	,'calendar_description' => 'Kalenderbeskrivning'
	,'calendar_admin_email' => 'Kalender Administratörens e-post'
	,'cookie_name' => 'Namn på cookie som används av skript'
	,'cookie_path' => 'Sökväg till cookie som används av skript'
	,'debug_mode' => 'Starta debugläge'
	,'calendar_status' => 'Kalender publik status'
// Environment Settings
	,'env_settings_label' => 'Miljöinställningar'
	,'lang' => 'Språk'
		,'lang_name' => 'Språk'
		,'lang_native_name' => 'Lokalt namn'
		,'lang_trans_date' => 'översatt av'
		,'lang_author_name' => 'Författare'
		,'lang_author_email' => 'E-post'
		,'lang_author_url' => 'Webbplats'
	,'charset' => 'Tecken kodning'
	,'theme' => 'Tema'
		,'theme_name' => 'Temanamn'
		,'theme_date_made' => 'Skapad'
		,'theme_author_name' => 'Författare'
		,'theme_author_email' => 'E-post'
		,'theme_author_url' => 'Webbplats'
	,'timezone' => 'Tidszon offset'
	,'time_format' => 'Tidsformat'
		,'24hours' => '24 timmar'
		,'12hours' => '12 timmar'
	,'auto_daylight_saving' => 'Justera automatiskt för sommar/vintertid (DST)'
	,'main_table_width' => 'Bredd på huvudtabell (Pixlar eller %)'
	,'day_start' => 'Vecka startar med'
	,'default_view' => 'Standardvy'
	,'search_view' => 'Visa sökruta'
	,'archive' => 'Visa tidigare händelser'
	,'events_per_page' => 'Antal händelser per sida'
	,'sort_order' => 'Standard sorteringsordning'
		,'sort_order_title_a' => 'Titel stigande'
		,'sort_order_title_d' => 'Titel fallande'
		,'sort_order_date_a' => 'Datum stigande'
		,'sort_order_date_d' => 'Datum fallande'
	,'show_recurrent_events' => 'Visa återkommande händelser'
	,'multi_day_events' => 'Flera dagars händelser'
		,'multi_day_events_all' => 'Visa hela datum områden'
		,'multi_day_events_bounds' => 'Visa endast start & slut datum'
		,'multi_day_events_start' => 'Visa endast startdatum'
	// User Settings
	,'user_settings_label' => 'Användarinställningar'
	,'allow_user_registration' => 'Tillåt användarregistrering'
	,'reg_duplicate_emails' => 'Tillåt flera med samma e-postadress'
	,'reg_email_verify' => 'Aktivera konto genom e-post aktivering'
// Event View
	,'event_view_label' => 'Händelsevy'
	,'popup_event_mode' => 'Pop-up händelse'
	,'popup_event_width' => 'Bredd på pop-up fönster'
	,'popup_event_height' => 'Höjd på pop-up fönster'
// Add Event View
	,'add_event_view_label' => 'Lägg till händelsevy'
	,'add_event_view' => 'Tillgänglig'
	,'addevent_allow_html' => 'Tillåt <b>BB Code</b> i beskrivningen'
	,'addevent_allow_contact' => 'Tillåt kontakt'
	,'addevent_allow_email' => 'Tillåt e-post'
	,'addevent_allow_url' => 'Tillåt URL'
	,'addevent_allow_picture' => 'Tillåt bilder'
	,'new_post_notification' => 'Ny post meddelande'
// Calendar View
	,'calendar_view_label' => 'Kalender (Månatlig) Vy'
	,'monthly_view' => 'Tillgänglig'
	,'cal_view_show_week' => 'Visa veckonummer'
	,'cal_view_max_chars' => 'Maximalt antal tecken i beskrivningen'
// Flyer View
	,'flyer_view_label' => 'Flyervy'
	,'flyer_view' => 'Tillgänglig'
	,'flyer_show_picture' => 'Visa bilder i flyervyn'
	,'flyer_view_max_chars' => 'Maximalt antal tecken i beskrivningen'
// Weekly View
	,'weekly_view_label' => 'Veckovy'
	,'weekly_view' => 'Tillgänglig'
	,'weekly_view_max_chars' => 'Maximalt antal tecken i beskrivningen'
// Daily View
	,'daily_view_label' => 'Daglig vy'
	,'daily_view' => 'Tillgänglig'
	,'daily_view_max_chars' => 'Maximalt antal tecken i beskrivningen'
// Categories View
	,'categories_view_label' => 'Kategorivy'
	,'cats_view' => 'Tillgänglig'
	,'cats_view_max_chars' => 'Maximalt antal tecken i beskrivningen'
// Mini Calendar
	,'mini_cal_label' => 'Minikalender'
	,'mini_cal_def_picture' => 'Standardbild'
	,'mini_cal_display_picture' => 'Visa bild'
	,'mini_cal_diplay_options' => array('Ingen','Standardbild', 'Daglig bild','Veckobild','Slumpmässig bild')
// Mail Settings
	,'mail_settings_label' => 'E-post inställningar'
	,'mail_method' => 'Hur skall e-post skickas'
	,'mail_smtp_host' => 'SMTP Hosts (skiljt med semikolon ;)'
	,'mail_smtp_auth' => ' SMTP bekräftelse'
	,'mail_smtp_username' => 'SMTP Användarnamn'
	,'mail_smtp_password' => 'SMTP Lösenord'

// Picture Settings
	,'picture_settings_label' => 'Bildinställningar'
	,'max_upl_dim' => 'Max. bredd eller höjd för uppladdade bilder'
	,'max_upl_size' => 'Max. höjd for uppladdade bilder (i Bytes)'
	,'picture_chmod' => 'Default mode för bilder (CHMOD) (i Octal)'
	,'allowed_file_extensions' => 'Godkända filändelser för uppladdade bilder'
// Form Buttons
	,'update_config' => 'Spara ny konfiguration'
	,'restore_config' => 'Återställ fabriksinställningar'
// Misc.
	,'update_settings_success' => 'Inställningar uppdaterade'
	,'restore_default_confirm' => 'är du säker på att du vill återställa till standardinställningarna ?'
// Template Configuration
	,'template_type' => 'Malltyp'
	,'template_header' => 'Header utseende'
	,'template_footer' => 'Footer utseende'
	,'template_status_default' => 'Använd standard temamall'
	,'template_status_custom' => 'Anävnd följande mall:'
	,'template_custom' => 'Anpassad mall'

	,'info_meta' => 'Meta Information'
	,'info_status' => 'Statuskontroll'
	,'info_status_default' => 'Stäng av detta innehåll'
	,'info_status_custom' => 'Visa följande innehåll:'
	,'info_custom' => 'Anpassat innehåll'

	,'dynamic_tags' => 'Dynamiska Taggar'

// Product Updates
	,'updates_check_text' => 'Vänta medan information hämtas från servern...'
	,'updates_no_response' => 'Ingen respons från servern. Försök igen senare.'
	,'avail_updates' => 'Möjliga uppdateringar'
	,'updates_download_zip' => 'Ladda ner ZIP paket (.zip)'
	,'updates_download_tgz' => 'Ladda ner TGZ paket (.tar.gz)'
	,'updates_released_label' => 'Releasedatum: %s'
	,'updates_no_update' => 'Du kör den senast tillgängliga versionen. Ingen uppdatering behövs.'
);

// ======================================================
// cal_mini.inc.php
// ======================================================

$lang_mini_cal = array(
	'def_pic' => 'Standardbild'
	,'daily_pic' => 'Dagens bild (%s)'
	,'weekly_pic' => 'Veckans bild (%s)'
	,'rand_pic' => 'Slumpmässig bild (%s)'
	,'post_event' => 'Lägg till ny händelse'
	,'num_events' => '%d Händelse(r)'
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
	'section_title' => 'Inloggningsskärm'
// General Settings
	,'login_intro' => 'Skriv in användarnamn och lösenord för att logga in'
	,'username' => 'Användarnamn'
	,'password' => 'Lösenord'
	,'remember_me' => 'kom ihåg mig'
	,'login_button' => 'Login'
// Errors
	,'invalid_login' => 'Verifiera inloggningen och försök igen!'
	,'no_username' => 'Du måste mata in ett användarnamn !'
	,'already_logged' => 'Du är redan inloggad !'
);

// ======================================================
// logout.php
// ======================================================

// To Be Done


?>