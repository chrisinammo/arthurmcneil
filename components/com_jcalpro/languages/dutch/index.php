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
	'name' => 'Dutch'
	,'nativename' => 'Nederlands' // Language name in native language. E.G.: 'Nederlands' for 'Dutch'
	,'locale' => array('nl','dutch') // Standard locale alternatives for a specific language. For reference, go to: http://www.php.net/manual/en/function.setlocale.php
	,'charset' => 'ISO-8859-1' // For reference, go to : http://www.w3.org/International/O-charset-lang.html
	,'direction' => 'ltr' // 'ltr' for Left to Right. 'rtl' for Right to Left languages such as Arabic.
	,'author' => 'fusillade'
	,'author_email' => 'contact@alphanet-sc.com'
	,'author_url' => 'http://dev.anything-digital.com'
	,'transdate' => '12/29/2006'
);

$lang_general = array (
	'yes' => 'Ja'
	,'no' => 'Nee'
	,'back' => 'Terug'
	,'continue' => 'Doorgaan'
	,'close' => 'Sluiten'
	,'errors' => 'Fouten'
	,'info' => 'Info'
	,'day' => 'dag'
	,'days' => 'dagen'
	,'month' => 'maand'
	,'months' => 'Maanden'
	,'year' => 'jaar'
	,'years' => 'jaren'
	,'hour' => 'uur'
	,'hours' => 'uren'
	,'minute' => 'minuut'
	,'minutes' => 'minuten'
	,'everyday' => 'Elke dag'
	,'everymonth' => 'Elke maand'
	,'everyyear' => 'Elk jaar'
	,'active' => 'Actief'
	,'not_active' => 'Niet actief'
	,'today' => 'Vandaag'
	,'signature' => 'Powered by %s'
	,'expand' => 'Uitvouwen'
	,'collapse' => 'Inklappen'
);

// Date formats, For reference, go to : http://www.php.net/manual/en/function.strftime.php
$lang_date_format = array (
	'full_date' => '%A %d %B %Y' // e.g. Wednesday 05 June 2002
	,'full_date_time_24hour' => '%A %d %B %Y om %H:%M' // e.g. Wednesday 05 June 2002 At 21:05
	,'full_date_time_12hour' => '%A %d %B %Y om %I:%M %p' // e.g. Wednesday 05 June  2002 At 9:05 pm
	,'day_month_year' => '%d %b %Y' // e.g 10-Sep-2004
	,'local_date' => '%c' // Preferred date and time representation for current language 
	,'mini_date' => '%a. %d %b %Y' 
	,'month_year' => '%B %Y'
	,'day_of_week' => array('Zondag','Maandag','Dinsdag','Woensdag','Donderdag','Vrijdag','Zaterdag')
	,'months' => array('Januari','Februari','Maart','April','Mei','Juni','Juli','Augustus','September','Oktober','November','December')
);

$lang_system = array (
	'system_caption' => 'Systeembericht'
	,'page_access_denied' => 'U heeft niet genoeg bevoegdheden voor toegang tot deze pagina.'
	,'page_requires_login' => 'Je moet ingelogd zijn om deze pagina te bekijken.'
	,'operation_denied' => 'U heeft niet genoeg bevoegdheden om deze funktie uit te voeren.'
	,'section_disabled' => 'Deze afdeling is momenteel uitgeschakeld!'
	,'non_exist_cat' => 'De geselecteerde categorie bestaat niet!'
	,'non_exist_event' => 'Het geselecteerde agendapunt bestaat niet!'
	,'param_missing' => 'De opgegeven parameters zijn niet correct.'
	,'no_events' => 'Geen events'
	,'config_string' => 'Je gebruikt momenteel \'%s\' draait op %s, %s en %s.'
	,'no_table' => 'De \'%s\' tabel bestaat niet!'
	,'no_anonymous_group' => 'De %s tabel bevat niet de \'Anonieme\' groep!'
	,'calendar_locked' => 'Deze service is tijdelijk niet beschikbaar voor onderhoud en upgrades. Onze excuses voor het ongemak.'
	,'new_upgrade' => 'Het systeem heeft een nieuwe versie gedetecteerd. Het is aanbevolen om de upgrade nu uit te voeren. Klik "Continue" om de upgrade tool te starten.'
	,'no_profile' => 'Een fout is opgetreden tijdens het opvragen van je profiel informatie'
// Mail messages
	,'new_event_subject' => 'Agendapunt heeft toestemming nodig bij %s'
	,'event_notification_failed' => 'Een fout is opgetreden tijdens het verzenden van de notificatie e-mail.'
);

// Message body for new event email notification
$lang_system['event_notification_body'] = <<<EOT
Het volgende agendapunt is net geplaats op je {CALENDAR_NAME}
en dit heeft toestemming nodig:

Titel: "{TITLE}"
Datum: "{DATE}"
Duur: "{DURATION}"

Je kan dit agendapunt bekijken door op de link hieronder te klikken
of copy paste het in je web browser.

{LINK}

De link werkt alleen al je bent ingelogd als Administrator.

Groeten,

Beheerder van {CALENDAR_NAME}

EOT;

// Admin menu entries
$lang_admin_menu = array (
	'login' => 'Login'
	,'register' => 'Registeer'
  ,'logout' => 'Logout <span style="color:#FF9922">[<span style="color:#606F79">%s</span>]</span>'
  ,'user_profile' => 'Mijn profiel'
	,'admin_events' => 'Agendapunten'
  ,'admin_categories' => 'Categorie&euml;n'
  ,'admin_groups' => 'Groepen'
  ,'admin_users' => 'Gebruikers'
  ,'admin_settings' => 'Instellingen'
);

// Main menu entries
$lang_main_menu = array (
	'add_event' => 'Voeg toe'
	,'cal_view' => 'Maand'
  ,'flat_view' => 'Lijst'
  ,'weekly_view' => 'Week'
  ,'daily_view' => 'Dag'
  ,'yearly_view' => 'Jaar'
  ,'categories_view' => 'Categorie&euml;n'
  ,'search_view' => 'Zoeken'
);

// ======================================================
// Add Event view
// ======================================================

$lang_add_event_view = array(
	'section_title' => 'Voeg agendapunt toe'
	,'edit_event' => 'Bewerk agendapunt [id%d] \'%s\''
	,'update_event_button' => 'Agendapunt bijwerken'

// Event details
	,'event_details_label' => 'Agendapunt details'
	,'event_title' => 'Titel'
	,'event_desc' => 'Beschrijving'
	,'event_cat' => 'Categorie'
	,'choose_cat' => 'Selecteer een categorie'
	,'event_date' => 'Datum'
	,'day_label' => 'dag'
	,'month_label' => 'maand'
	,'year_label' => 'jaar'
	,'start_date_label' => 'Begin tijd'
	,'start_time_label' => 'om'
	,'end_date_label' => 'Duur'
	,'all_day_label' => 'Hele dag'
// Contact details
	,'contact_details_label' => 'Contact'
	,'contact_info' => 'Contact informatie'
	,'contact_email' => 'Contact e-mail'
	,'contact_url' => 'Contact website'
// Repeat events
	,'repeat_event_label' => 'Herhaal agendapunt'
	,'repeat_method_label' => 'Herhaal methode'
	,'repeat_none' => 'Herhaal dit agendapunt niet'
	,'repeat_every' => 'Herhaal elke'
	,'repeat_days' => 'dag(en)'
	,'repeat_weeks' => 'week(en)'
	,'repeat_months' => 'maand(en)'
	,'repeat_years' => 'jaar(en)'
	,'repeat_end_date_label' => 'Herhaal einddatum'
	,'repeat_end_date_none' => 'Geen einddatum'
	,'repeat_end_date_count' => 'Stop na %s keer'
	,'repeat_end_date_until' => 'Herhaal tot'
// Other details
	,'other_details_label' => 'Overige details'
	,'picture_file' => 'Afbeelding bestand'
	,'file_upload_info' => '(%d KB limiet - toegestane extensies: %s )' 
	,'del_picture' => 'Verwijder huidige afbeelding?'
// Administrative options
	,'admin_options_label' => 'Administratie opties'
	,'auto_appr_event' => 'Agendapunt goedgekeurd'

// Error messages
	,'no_title' => 'U moet een titel voor het agendapunt opgeven!'
	,'no_desc' => 'U moet een beschrijving voor het agendapunt opgeven!'
	,'no_cat' => 'U moet een categorie uit het menu selecteren!'
	,'date_invalid' => 'U moet een correcte datum voor het agendapunt opgeven!'
	,'end_days_invalid' => 'De opgegeven waarde in het \'dagen\' veld is niet correct!'
	,'end_hours_invalid' => 'De opgegeven waarde in het \'uren\' veld is niet correct!'
	,'end_minutes_invalid' => 'De opgegeven waarde in het \'minuten\' veld is niet correct!'

	,'non_valid_extension' => 'Het formaat van de toegevoegde afbeelding wordt niet ondersteund! Extensies die toegestaan zijn: %s.'

	,'file_too_large' => 'Het toegevoegde bestand is te groot! (gelimiteerd tot %d KB)'
	,'move_image_failed' => 'De afbeelding kan niet worden verplaatst!'
	,'non_valid_dimensions' => 'De breedte of hoogte van de afbeelding is groter dan %s pixels!'

	,'recur_val_1_invalid' => 'De ingevoerde waarde als \'herhaal interval\' is niet geldig. Deze waarde moet een nummer zijn groter dan \'0\'!'
	,'recur_end_count_invalid' => 'De ingevoerde waarde als \'aantal herhalingen\' is niet geldig. Deze waarde moet een nummer zijn groter dan \'0\'!'
	,'recur_end_until_invalid' => 'De \'herhaal tot\' datum moet groter zijn dan de startdatum van het agendapunt!'
// Misc. messages
	,'submit_event_pending' => 'Uw agendapunt wacht op goedkeuring. Bedankt voor uw toevoeging.'
	,'submit_event_approved' => 'Uw agendapunt is automatisch goedgekeurd. Bedankt voor uw toevoeging.'
	,'event_repeat_msg' => 'Dit agendapunt wordt herhaald'
	,'event_no_repeat_msg' => 'Dit agendapunt wordt niet herhaald'
);

// ======================================================
// daily view
// ======================================================

$lang_daily_event_view = array(
	'section_title' => 'Dag'
	,'next_day' => 'Volgende dag'
	,'previous_day' => 'Vorige dag'
	,'no_events' => 'Er zijn geen agendapunten op deze dag.'
);

// ======================================================
// weekly view
// ======================================================

$lang_weekly_event_view = array(
	'section_title' => 'Week'
	,'week_period' => '%s - %s'
	,'next_week' => 'Volgende week'
	,'previous_week' => 'Vorige week'
	,'selected_week' => 'Week %d'
	,'no_events' => 'Er zijn geen agendapunten deze week'
);

// ======================================================
// monthly view
// ======================================================

$lang_monthly_event_view = array(
	'section_title' => 'Maand'
	,'next_month' => 'Volgende maand'
	,'previous_month' => 'Vorige maand'
);

// ======================================================
// flat view
// ======================================================

$lang_flat_event_view = array(
	'section_title' => 'Lijst'
	,'week_period' => '%s - %s'
	,'next_month' => 'Volgende maand'
	,'previous_month' => 'Vorige maand'
	,'contact_info' => 'Contact informatie'
	,'contact_email' => 'E-mail'
	,'contact_url' => 'URL'
	,'no_events' => 'Er zijn geen agendapunten deze maand'
);

// ======================================================
// Event view
// ======================================================

$lang_event_view = array(
	'section_title' => 'Agendapunt'
	,'display_event' => 'Agendapunt: \'%s\''
	,'cat_name' => 'Categorie'
	,'event_start_date' => 'Datum'
	,'event_end_date' => 'Tot'
	,'event_duration' => 'Duur'
	,'contact_info' => 'Contact info'
	,'contact_email' => 'E-mail'
	,'contact_url' => 'URL'
	,'no_event' => 'Er is geen agendapunt om weer te geven.'
	,'stats_string' => '<strong>%d</strong> agendapunt(en) in totaal'
	,'edit_event' => 'Wijzig agendapunt'
	,'delete_event' => 'Verwijder agendapunt'
	,'delete_confirm' => 'Weet je zeker dat je dit agendapunt wilt verwijderen?'
	
);

// ======================================================
// Categories view
// ======================================================

$lang_cats_view = array(
	'section_title' => 'Categorie&euml;n'
	,'cat_name' => 'Categorie naam'
	,'total_events' => 'Totaal'
	,'upcoming_events' => 'Binnenkort'
	,'no_cats' => 'Er zijn geen categorie&euml;n om weer te geven.'
	,'stats_string' => 'Er zijn <strong>%d</strong> agendapunt(en) in <strong>%d</strong> categorie&euml;n'
);

// ======================================================
// Category Events view
// ======================================================

$lang_cat_events_view = array(
	'section_title' => 'Agendapunt onder \'%s\''
	,'event_name' => 'Agendapunt naam'
	,'event_date' => 'Datum'
	,'no_events' => 'Er zijn geen agendapunten binnen deze categorie.'
	,'stats_string' => '<strong>%d</strong> agendapunten in totaal'
);

// ======================================================
// cal_search.php
// ======================================================

$lang_event_search_data = array(
	'section_title' => 'Zoeken in kalender',
	'search_results' => 'Zoek resultaten',
	'category_label' => 'Categorie',
	'date_label' => 'Datum',
	'no_events' => 'Er zijn geen agendapunten in deze categorie.',
	'search_caption' => 'Typ een aantal steekwoorden in...',
	'search_again' => 'Zoek opnieuw',
	'search_button' => 'Zoeken',
// Misc.
	'no_results' => 'Geen resultaten gevonden',	
// Stats
	'stats_string1' => '<strong>%d</strong> agendapunt(en) gevonden',
	'stats_string2' => '<strong>%d</strong> agendapunt(en) in <strong>%d</strong> pagina(\'s)'
);

// ======================================================
// profile.php
// ======================================================

if (defined('PROFILE_PHP')) 

$lang_user_profile_data = array(
	'section_title' => 'Mijn profiel',
	'edit_profile' => 'Wijzig mijn profiel',
	'update_profile' => 'Werk mijn profiel bij',
	'actions_label' => 'Actions',
// Account Info
	'account_info_label' => 'Account Informatie',
	'user_name' => 'Gebruikersnaam',
	'user_pass' => 'Wachtwoord',
	'user_pass_confirm' => 'Bevestig wachtwoord',
	'user_email' => 'E-mailadres',
	'group_label' => 'Groep lidmaatschap',
// Other Details
	'other_details_label' => 'Andere details',
	'first_name' => 'Voornaam',
	'last_name' => 'Achternaam',
	'full_name' => 'Volledige naam',
	'user_website' => 'Website',
	'user_location' => 'Woonplaats',
	'user_occupation' => 'Beroep',
// Misc.
	'select_language' => 'Selecteer taal',
	'edit_profile_success' => 'Profiel is successvol bijgewerkt',
	'update_pass_info' => 'Laat het wachtwoord veld leeg als je het niet wilt veranderen',
// Error messages
	'invalid_password' => 'Voer een wachtwoord in dat alleen bestaat uit letters en cijfers, tussen 4 en 16 karakters lang!',
	'password_is_username' => 'Het wachtwoord moet verschillen van de gebruikersnaam!',
	'password_not_match' =>'Het ingevoerde wachtwoord komt niet overeen met het bevestigde wachtwoord',
	'invalid_email' => 'Je moet een e-mailadres invoeren!',
	'email_exists' => 'Een andere gebruiker is al geregistreerd met het e-mailadres dat je hebt ingevoerd. Voer een ander e-mailadres in!',
	'no_email' => 'Je moet een e-mailadres invoeren!',
	'invalid_email' => 'Je moet een correct e-mailadres invoeren!',
	'no_password' => 'Je moet een wachtwoord invoeren voor dit nieuwe account!'
);

// ======================================================
// register.php
// ======================================================

if (defined('USER_REGISTRATION_PHP')) 

$lang_user_registration_data = array(
	'section_title' => 'Gebruiker registratie',
// Step 1: Terms & Conditions
	'terms_caption' => 'Voorwaarden',
	'terms_intro' => 'Om verder te gaan, moet je met het volgende akkoord gaan:',
	'terms_message' => 'Neem de tijd om de voorwaarden hieronder te bekijken. Als je akkoord gaat en wenst door te gaan met de registratie, klik de \'Ik ga akkoord\' button hieronder. Om de registratie te annuleren, klik op de \'terug\' button van je browser.<br /><br />Bedenk wel dat we niet verantwoordelijk zijn voor iedere agendapunt geplaatst door gebruikers van deze kalender applicatie. Wij staan niet in voor de juistheid, volledigheid of nuttigheid van iedere geplaatste agendapunt, en zijn niet verantwoordelijk voor de inhoud van iedere agendapunt.<br /><br />De berichten uiten de mening van de auteur van het agendapunt, niet de mening van deze kalender applicatie. Iedere gebruiker die vind dat een geplaatst agendapunt aanstootgevend is kan zich wenden tot de makers van deze kalender applicatie via e-mail. Wij hebben de mogelijkheid om aanstootgevende inhoud te verwijderen en zullen er alles aan doen, binnen een redelijke termijn, als we vaststellen dat verwijdering noodzakelijk is.<br /><br />Door het gebruik van deze dienst ga je ermee akkoord dat je deze kalender applicatie niet gebruikt om materiaal te plaatsen dat willens en wetens incorrect en/of lasterlijk, onjuist, beledigend, vulgair, kwaadaardig, kwellend, obsceen, profaan, seksueel getint, dreigend, inbreuk doet op het priv&eacute;leven van een persoon of in strijd is met de wet.<br /><br />Je accepteert geen auteursrechtelijk beschermd materiaal te plaatsen tenzij het materiaal in bezit is van jou of van %s.',
	'terms_button' => 'Ik ga akkoord',
	
// Account Info
	'account_info_label' => 'Account informatie',
	'user_name' => 'Gebruikersnaam',
	'user_pass' => 'Wachtwoord',
	'user_pass_confirm' => 'Bevestig wachtwoord',
	'user_email' => 'E-mailadres',
// Other Details
	'other_details_label' => 'Andere details',
	'first_name' => 'Voornaam',
	'last_name' => 'Achternaam',
	'user_website' => 'Website',
	'user_location' => 'Woonplaats',
	'user_occupation' => 'Beroep',
	'register_button' => 'Verzend registratie',

// Stats
	'stats_string1' => '<strong>%d</strong> gebruikers',
	'stats_string2' => '<strong>%d</strong> gebruiker(s) op %d pagina(\'s)',
// Misc.
	'reg_nomail_success' => 'Bedankt voor je registratie.',
	'reg_mail_success' => 'Een e-mail met informatie over hoe je je account activeerd is verstuurd naar het e-mailadres dat je hebt ingevoerd.',
	'reg_activation_success' => 'Gefeliciteerd! Je account is nu actief en je kan inloggen met je gebruikersnaam en wachtwoord. Bedankt voor je registratie.',
// Mail messages
	'reg_confirm_subject' => 'Geregistreerd om %s',
	
// Error messages
	'no_username' => 'Voer een gebruikersnaam in!',
	'invalid_username' => 'Voer een wachtwoord in dat alleen bestaat uit letters en cijfers, tussen 4 en 30 karakters lang!',
	'username_exists' => 'De ingevoerde gebruikersnaam bestaat al. Voer een andere naam in.',
	'no_password' => 'Voer een wachtwoord in!',
	'invalid_password' => 'Voer een wachtwoord in dat alleen bestaat uit letters en cijfers, tussen 4 en 16 karakters lang!',
	'password_is_username' => 'Het wachtwoord moet verschillen van de gebruikersnaam!',
	'password_not_match' =>'Het ingevoerde wachtwoord komt niet overeen met het bevestigde wachtwoord',
	'no_email' => 'Je moet een e-mailadres invoeren!',
	'invalid_email' => 'Je moet een correct e-mailadres invoeren!',
	'email_exists' => 'Een andere gebruiker is al geregistreerd met het e-mailadres dat je hebt ingevoerd. Voer een ander e-mailadres in!',
	'delete_user_failed' => 'Dit gebruikers account kan niet worden verwijderd.',
	'no_users' => 'Er zijn geen gebruikers om weer te geven.',
	'already_logged' => 'Je bent al ingelogd!',
	'registration_not_allowed' => 'Gebruikersregistratie is momenteel niet toegestaan.',
	'reg_email_failed' => 'Een fout is opgetreden tijdens het versturen van de activatie e-mail.',
	'reg_activation_failed' => 'Een fout is opgetreden tijdens het verwerken van de activatie.'

);
// Message body for email activation
$lang_user_registration_data['reg_confirm_body'] = <<<EOT
Bedankt voor het registreren op {CALENDAR_NAME}

Je gebruikersnaam is: "{USERNAME}"
Je wachtwoord is: "{PASSWORD}"

Om je account te activeren klik op de link hieronder
of copy paste het in je web browser.

{REG_LINK}

Groeten,

Beheerder van {CALENDAR_NAME}

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
	'section_title' => 'Agendapunt administratie',
	'events_to_approve' => 'Agendapunt administratie: agendapunt(en) te goedkeuren',
	'upcoming_events' => 'Agendapunt administratie: binnenkort',
	'past_events' => 'Agendapunt administratie: geweest',
	'add_event' => 'Nieuw agendapunt',
	'edit_event' => 'Wijzig agendapunt',
	'view_event' => 'Bekijk agendapunt',
	'approve_event' => 'Agendapunt goedkeuren',
	'update_event' => 'Agendapunt bijwerken',
	'delete_event' => 'Verwijder agendapunt',
	'events_label' => 'Agendapunten',
	'auto_approve' => 'Automatisch goedkeuren',
	'date_label' => 'Datum',
	'actions_label' => 'Acties',
	'events_filter_label' => 'Filter agendapunten',
	'events_filter_options' => array('Laat alle agendapunten zien','Laat alleen niet goedgekeurde agendapunten zien','Laat alleen agendapunten van binnenkort zien','Laat alleen agendapunten zien die zijn geweest'),
	'picture_attached' => 'Afbeelding toegevoegd',
// View Event
	'view_event_name' => 'Agendapunt: \'%s\'',
	'event_start_date' => 'Datum',
	'event_end_date' => 'Tot',
	'event_duration' => 'Duur',
	'contact_info' => 'Contact Info',
	'contact_email' => 'E-mail',
	'contact_url' => 'URL',
// General Info
// Event form
	'edit_event_title' => 'Agendapunt: \'%s\'',
	'cat_name' => 'Categorie',
	'event_start_date' => 'Datum',
	'event_end_date' => 'Tot',
	'contact_info' => 'Contact info',
	'contact_email' => 'E-mail',
	'contact_url' => 'URL',
	'no_event' => 'Er is geen agendapunt om weer te geven.',
	'stats_string' => '<strong>%d</strong> agendapunt(en) in totaal',
// Stats
	'stats_string1' => '<strong>%d</strong> agendapunt(en)',
	'stats_string2' => 'Totaal: <strong>%d</strong> agendapunten op %d pagina(\'s)',
// Misc.
	'add_event_success' => 'Nieuw agendapunt succesvol toegevoegd',
	'edit_event_success' => 'Agendapunt succesvol bijgewerkt',
	'approve_event_success' => 'Agendapunt succesvol goedgekeurd',
	'delete_confirm' => 'Weet je zeker dat je dit agendapunt wilt verwijderen?',
	'delete_event_success' => 'Agendapunt succesvol verwijderd',
	'active_label' => 'Actief',
	'not_active_label' => 'Niet actief',
// Error messages
	'no_event_name' => 'Voer een naam in voor dit agendapunt!',
	'no_event_desc' => 'Voer een beschrijving in over dit agendapunt!',
	'no_cat' => 'Selecteer een categorie voor dit agendapunt!',
	'no_day' => 'Je moet een dag selecteren!',
	'no_month' => 'Je moet een maand selecteren!',
	'no_year' => 'Je moet een jaar selecteren!',
	'non_valid_date' => 'Voer een correcte datum in!',
	'end_days_invalid' => 'Zorg ervoor dat het \'dagen\' veld onder \'Duur\' alleen uit cijfers bestaat!',
	'end_hours_invalid' => 'Zorg ervoor dat het \'uren\' veld onder \'Duur\' alleen uit cijfers bestaat!',
	'end_minutes_invalid' => 'Zorg ervoor dat het \'minuten\' veld onder \'Duur\' alleen uit cijfers bestaat!',
	'file_too_large' => 'De afbeelding die je hebt toegevoegd is groter dan %s KB!',
	'non_valid_extension' => 'Het formaat van het toegevoegde bestand is niet ondersteund!',
	'delete_event_failed' => 'Dit agendapunt kan niet worden verwijderd',
	'approve_event_failed' => 'Dit agendapunt kan niet worden goedgekeurd',
	'no_events' => 'Er is geen agendapunt om weer te geven.',
	'move_image_failed' => 'Het is niet gelukt om de afbeelding te verplaatsen.',
	'non_valid_dimensions' => 'De breedte of de hoogte van de afbeelding is groter dan %s pixels!',
	'recur_val_1_invalid' => 'De ingevoerde waarde als \'herhaal interval\' is niet geldig. Deze waarde moet een nummer zijn groter dan \'0\'!',
	'recur_end_count_invalid' => 'De ingevoerde waarde als \'aantal herhalingen\' is niet geldig. Deze waarde moet een nummer zijn groter dan \'0\'!',
	'recur_end_until_invalid' => 'De \'herhaal tot\' datum moet groter zijn dan de startdatum van het agendapunt!'

);

// ======================================================
// admin_categories.php
// ======================================================

if (defined('ADMIN_CATS_PHP')) 

$lang_cat_admin_data = array(
	'section_title' => 'Categorie administratie',
	'add_cat' => 'Voeg nieuwe categorie toe',
	'edit_cat' => 'Bewerk categorie',
	'update_cat' => 'Categorie bijwerken',
	'delete_cat' => 'Verwijder categorie',
	'events_label' => 'Agendapunten',
	'visibility' => 'Zichtbaarheid',
	'actions_label' => 'Acties',
	'users_label' => 'Gebruikers',
	'admins_label' => 'Admins',
// General Info
	'general_info_label' => 'Algemene informatie',
	'cat_name' => 'Categorie naam',
	'cat_desc' => 'Categorie beschrijving',
	'cat_color' => 'Kleur',
	'pick_color' => 'Kies een kleur!',
	'status_label' => 'Status',
// Administrative Options
	'admin_label' => 'Administratie opties',
	'auto_admin_appr' => 'Automatisch goedkeuren door admins',
	'auto_user_appr' => 'Automatisch goedkeuren door gebruikers',
// Stats
	'stats_string1' => '<strong>%d</strong> categorie&euml;n',
	'stats_string2' => 'Actief: <strong>%d</strong>&nbsp;&nbsp;&nbsp;Totaal: <strong>%d</strong>&nbsp;&nbsp;&nbsp;op %d pagina(\'s)',
// Misc.
	'add_cat_success' => 'Nieuwe categorie succesvol toegevoegd',
	'edit_cat_success' => 'Categorie met succes bewerkt',
	'delete_confirm' => 'Weet je zeker dat je deze categorie wilt verwijderen?',
	'delete_cat_success' => 'Categorie succesvol verwijderd',
	'active_label' => 'Actief',
	'not_active_label' => 'Niet actief',
// Error messages
	'no_cat_name' => 'Je moet een naam opgeven voor deze categorie!',
	'no_cat_desc' => 'Je moet een beschrijving opgeven voor deze categorie!',
	'no_color' => 'Je moet een kleur opgeven voor deze categorie!',
	'delete_cat_failed' => 'Deze categorie kan niet verwijderd worden',
	'no_cats' => 'Er zijn geen categorie&euml;n om weer te geven!',
	'cat_has_events' => 'Deze categorie bevat %d agendapunt(en) en kan derhalve niet verwijderd worden!<br>Verwijder a.u.b. overgebleven agendapunten onder deze categorie en probeer het nogmaals!'

);
// ======================================================
// admin_users.php
// ======================================================

if (defined('ADMIN_USERS_PHP')) 

$lang_user_admin_data = array(
	'section_title' => 'Gebruikers administratie',
	'add_user' => 'Voeg nieuwe gebruiker toe',
	'edit_user' => 'Bewerk gebrukersinfo',
	'update_user' => 'Gebruikersinfo bijwerken',
	'delete_user' => 'Verwijder gebruiker',
	'last_access' => 'Laatst ingelogd',
	'actions_label' => 'Acties',
	'active_label' => 'Aktief',
	'not_active_label' => 'Niet aktief',
// Account Info
	'account_info_label' => 'Account informatie',
	'user_name' => 'Gebruikersnaam',
	'user_pass' => 'Wachtwoord',
	'user_pass_confirm' => 'Bevestig wachtwoord',
	'user_email' => 'E-mail',
	'group_label' => 'Groep lidmaatschap',
	'status_label' => 'Account status',
// Other Details
	'other_details_label' => 'Overige details',
	'first_name' => 'Voornaam',
	'last_name' => 'Achternaam',
	'user_website' => 'Website',
	'user_location' => 'Woonplaats',
	'user_occupation' => 'Werk',
// Stats
	'stats_string1' => '<strong>%d</strong> gebruikers',
	'stats_string2' => '<strong>%d</strong> gebruikers op %d pagina(\'s)',
// Misc.
	'select_group' => 'Selecteer iets...',
	'add_user_success' => 'Gebruikersaccount met succes toegevoegd',
	'edit_user_success' => 'Gebruikersaccount met succes bewerkt',
	'delete_confirm' => 'Weet U zeker dat U dit account wilt verwijderen?',
	'delete_user_success' => 'Gebruikersaccount met succes verwijderd',
	'update_pass_info' => 'Laat het wachtwoord-veld leeg als het wachtwoord niet veranderd hoeft te worden',
	'access_never' => 'Nooit',
// Error messages
	'no_username' => 'Je moet een gebruikersnaam opgeven!',
	'invalid_username' => 'Vul een gebruikersnaam in die alleen bestaat uit letters en cijfers, tussen 4 en 30 karakters lang',
	'invalid_password' => 'Vul een wachtwoord in die alleen bestaat uit letters en cijfers, tussen 4 en 16 karakters lang',
	'password_is_username' => 'Het wachtwoord moet verschillen van de gebruikersnaam',
	'password_not_match' =>'Het ingevulde wachtwoord komt niet overeen met \'bevestig wachtwoord\'',
	'invalid_email' => 'Je moet een geldig e-mailadres opgeven',
	'email_exists' => 'Een andere gebruiker heeft zich al geregistreerd met het e-mailadres dat je hebt opgegeven. Voer een ander e-mailadres in',
	'username_exists' => 'De gekozen gebruikersnaam is reeds in gebruik.<br>Kies een andere gebruikersnaam!',
	'no_email' => 'U moet een e-mailadres opgeven!',
	'invalid_email' => 'U moet een geldig e-mailadres opgeven!',
	'no_password' => 'U moet een wachtwoord opgeven voor het nieuwe account!',
	'no_group' => 'Kies een groep waar deze gebruiker lid van dient te zijn!',
	'delete_user_failed' => 'Dit gebruikersaccount kan niet verwijderd worden',
	'no_users' => 'Er zijn geen gebruikersaccounts om weer te geven!'

);

// ======================================================
// admin_groups.php
// ======================================================

if (defined('ADMIN_GROUPS_PHP')) 

$lang_group_admin_data = array(
	'section_title' => 'Groep administratie',
	'add_group' => 'Nieuwe group toevoegen',
	'edit_group' => 'Groep bewerken',
	'update_group' => 'Groep info bijwerken',
	'delete_group' => 'Verwijder groep',
	'view_group' => 'Bekijk groep',
	'users_label' => 'Leden',
	'actions_label' => 'Acties',
// General Info
	'general_info_label' => 'Algemene informatie',
	'group_name' => 'Groep naam',
	'group_desc' => 'Groep beschrijving',
// Group Access Level
	'access_level_label' => 'Groep toegang niveau',
	'Administrator' => 'Gebruikers van deze groep hebben admin rechten',
	'can_manage_accounts' => 'Gebruikers van deze groep kunnen accounts bewerken',
	'can_change_settings' => 'Gebruikers van deze groep kunnen kallender instellingen veranderen',
	'can_manage_cats' => 'Gebruikers van deze groep kunnen categorie&euml;n bewerken',
	'upl_need_approval' => 'Opgestuurde agendapunten vereisen goedkeuring',
// Stats
	'stats_string1' => '<strong>%d</strong> groepen',
	'stats_string2' => 'Totaal: <strong>%d</strong> groepen op <strong>%d</strong> pagina(\'s)',
	'stats_string3' => 'Totaal: <strong>%d</strong> gebruikers op <strong>%d</strong> pagina(\'s)',
// View Group Members
	'group_members_string' => 'Lid van \'%s\' groep',
	'username_label' => 'Gebruikersnaam',
	'firstname_label' => 'Voornaam',
	'lastname_label' => 'Achternaam',
	'email_label' => 'E-mail',
	'last_access_label' => 'Laatste login',
	'edit_user' => 'Bewerk gebruiker',
	'delete_user' => 'Verwijder gebruiker',
// Misc.
	'add_group_success' => 'Nieuwe groep succesvol toegevoegd',
	'edit_group_success' => 'Groep succesvol bijgewerkt',
	'delete_confirm' => 'Weet je zeker dat je deze groep wilt verwijderen?',
	'delete_user_confirm' => 'Weet je zeker dat je deze groep wilt verwijderen?',
	'delete_group_success' => 'Groep succesvol verwijderd',
	'no_users_string' => 'Er zijn geen gebruikers in deze groep',
// Error messages
	'no_group_name' => 'Voer een naam in voor deze groep!',
	'no_group_desc' => 'Voer een beschrijving in van deze groep!',
	'delete_group_failed' => 'Deze groep kan niet worden verwijderd',
	'no_groups' => 'Er zijn geen groepen om weer te geven!',
	'group_has_users' => 'Deze groep bevat %d gebruiker(s) en kan daarom niet worden verwijderd!<br>Verwijder a.u.b. de overgebleven gebruikers van deze groep en probeer het opnieuw!'

);

// ======================================================
// admin_settings.php / admin_settings_template.php / 
// admin_settings_updates.php
// ======================================================

$lang_settings_data = array(
	'section_title' => 'Kalenderinstellingen'
// Links
	,'admin_links_text' => 'Kies sectie'
	,'admin_links' => array('Algemene instellingen','Template instellingen','Product updates')
// General Settings
	,'general_settings_label' => 'Algemeen'
	,'calendar_name' => 'Kalender naam'
	,'calendar_description' => 'Kalender beschrijving'
	,'calendar_admin_email' => 'Kalender admin e-mail'
	,'cookie_name' => 'Naam van het cookie dat door het script gebruikt wordt'
	,'cookie_path' => 'Pad van het cookie dat door het script gebruikt wordt'
	,'debug_mode' => 'Zet foutopsporingsmodus aan'
	,'calendar_status' => 'Kalender publieke weergave'
// Environment Settings
	,'env_settings_label' => 'Omgeving'
	,'lang' => 'Taal'
		,'lang_name' => 'Taal'
		,'lang_native_name' => 'Nationale naam'
		,'lang_trans_date' => 'Vertaald op'
		,'lang_author_name' => 'Auteur'
		,'lang_author_email' => 'E-mail'
		,'lang_author_url' => 'Website'
	,'charset' => 'Character encoding'
	,'theme' => 'Thema'
		,'theme_name' => 'Thema naam'
		,'theme_date_made' => 'Gemaakt op'
		,'theme_author_name' => 'Auteur'
		,'theme_author_email' => 'E-mail'
		,'theme_author_url' => 'Website'
	,'timezone' => 'Tijdzone'
	,'time_format' => 'Tijdsweergave formaat'
		,'24hours' => '24 uurs'
		,'12hours' => '12 uurs'
	,'auto_daylight_saving' => 'Automatisch aanpassen voor zomer- of wintertijd'
	,'main_table_width' => 'Breedte van de hoofdtabel (pixels of percentage)'
	,'day_start' => 'Week start op'
	,'default_view' => 'Standaardweergave'
	,'search_view' => 'Zoeken activeren'
	,'archive' => 'Toon agendapunten in het verleden'
	,'events_per_page' => 'Aantal agendapunten per pagina'
	,'sort_order' => 'Standaard sorteren op'
		,'sort_order_title_a' => 'Titel oplopend'
		,'sort_order_title_d' => 'Titel aflopend'
		,'sort_order_date_a' => 'Datum oplopend'
		,'sort_order_date_d' => 'Datum aflopend'
	,'show_recurrent_events' => 'Laat herhaalde agendapunten zien'
	,'multi_day_events' => 'Meerdaagse agendapunten'
		,'multi_day_events_all' => 'Hele datum reeks weergeven'
		,'multi_day_events_bounds' => 'Alleen start en eind datum weergeven'
		,'multi_day_events_start' => 'Alleen startdatum weergeven'
	// User Settings
	,'user_settings_label' => 'Gebruiker instellingen'
	,'allow_user_registration' => 'Gebruiker registratie toestaan'
	,'reg_duplicate_emails' => 'Identieke e-mailadressen toestaan'
	,'reg_email_verify' => 'Account activatie via e-mail toestaan'
// Event View
	,'event_view_label' => 'Event view'
	,'popup_event_mode' => 'Pop-up event'
	,'popup_event_width' => 'Breedte van het pop-up venster'
	,'popup_event_height' => 'Hoogte van het pop-up venster'
// Add Event View
	,'add_event_view_label' => 'Nieuw event'
	,'add_event_view' => 'Geactiveerd'
	,'addevent_allow_html' => 'Sta <b>BB Code</b> toe in de beschrijvingen'
	,'addevent_allow_contact' => 'Toestaan contactgegevens'
	,'addevent_allow_email' => 'Toestaan e-mail'
	,'addevent_allow_url' => 'Toestaan URL'
	,'addevent_allow_picture' => 'Toestaan afbeeldingen'
	,'new_post_notification' => 'Nieuwe toevoeging notificatie'
// Calendar View
	,'calendar_view_label' => 'Maand view'
	,'monthly_view' => 'Geactiveerd'
	,'cal_view_show_week' => 'Toon weeknummers'
	,'cal_view_max_chars' => 'Maximum aantal tekens in beschrijvingen'
// Flyer View
	,'flyer_view_label' => 'Lijst view'
	,'flyer_view' => 'Geactiveerd'
	,'flyer_show_picture' => 'Toon afbeeldingen in lijst weergave'
	,'flyer_view_max_chars' => 'Maximum aantal tekens in beschrijvingen'
// Weekly View
	,'weekly_view_label' => 'Week view'
	,'weekly_view' => 'Geactiveerd'
	,'weekly_view_max_chars' => 'Maximum aantal tekens in beschrijvingen'
// Daily View
	,'daily_view_label' => 'Dag view'
	,'daily_view' => 'Geactiveerd'
	,'daily_view_max_chars' => 'Maximum aantal tekens in beschrijvingen'
// Categories View
	,'categories_view_label' => 'Cat. view'
	,'cats_view' => 'Geactiveerd'
	,'cats_view_max_chars' => 'Maximum aantal tekens in beschrijvingen'
// Mini Calendar
	,'mini_cal_label' => 'Minikalender'
	,'mini_cal_def_picture' => 'Standaard afbeelding'
	,'mini_cal_display_picture' => 'Weergeven afbeelding'
	,'mini_cal_diplay_options' => array('Geen','Standaard afbeelding', 'Dagelijkse afbeelding','Wekelijkse afbeelding','Willekeurige afbeelding')
// Mail Settings
	,'mail_settings_label' => 'Mail'
	,'mail_method' => 'Methode om e-mail te verzenden'
	,'mail_smtp_host' => 'SMTP hosts (gescheiden met punt komma ;)'
	,'mail_smtp_auth' => ' SMTP authenticatie'
	,'mail_smtp_username' => 'SMTP gebruikersnaam'
	,'mail_smtp_password' => 'SMTP wachtwoord'

// Picture Settings
	,'picture_settings_label' => 'Afbeelding instellingen'
	,'max_upl_dim' => 'Maximale breedte en hoogte voor de geuploade afbeeldingen'
	,'max_upl_size' => 'Maximale groote voor de geuploade afbeeldingen (in KB)'
	,'picture_chmod' => 'Standaard CHMOD voor de afbeeldingen'
	,'allowed_file_extensions' => 'Toegestane extensies voor de geuploade afbeeldingen'
// Form Buttons
	,'update_config' => 'Bewaar nieuwe configuratie'
	,'restore_config' => 'Herstel standaardinstellingen'
// Misc.
	,'update_settings_success' => 'Instellingen succesvol bijgewerkt'
	,'restore_default_confirm' => 'Weet je zeker dat je de oude instellingen wilt terugzetten?'
// Template Configuration
	,'template_type' => 'Template type'
	,'template_header' => 'Header aanpassen'
	,'template_footer' => 'Footer aanpassen'
	,'template_status_default' => 'Gebruik standaard template'
	,'template_status_custom' => 'Gebruik de volgende template:'
	,'template_custom' => 'Aangepasde template'

	,'info_meta' => 'Meta informatie'
	,'info_status' => 'Status controle'
	,'info_status_default' => 'Blokkeer deze inhoud'
	,'info_status_custom' => 'Laat de volgende inhoud zien:'
	,'info_custom' => 'Aangepasde inhoud'

	,'dynamic_tags' => 'Dynamische tags'

// Product Updates
	,'updates_check_text' => 'Even geduld a.u.b. De informatie wordt van de server opgehaald...'
	,'updates_no_response' => 'Geen reactie van de server. Probeer het later nog eens.'
	,'avail_updates' => 'Beschikbare updates'
	,'updates_download_zip' => 'Download ZIP bestand (.zip)'
	,'updates_download_tgz' => 'Download TGZ bestand (.tar.gz)'
	,'updates_released_label' => 'Release date: %s'
	,'updates_no_update' => 'Je hebt de laatste versie die beschikbaar is. Een update is niet nodig.'
);

// ======================================================
// cal_mini.inc.php
// ======================================================

$lang_mini_cal = array(
	'def_pic' => 'Standaardafbeelding'
	,'daily_pic' => 'Afbeelding van de dag (%s)'
	,'weekly_pic' => 'Afbeelding van de week (%s)'
	,'rand_pic' => 'Willekeurige afbeelding (%s)'
	,'post_event' => 'Plaats nieuw agendapunt'
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
	'section_title' => 'Loginscherm'
// General Settings
	,'login_intro' => 'Voer je gebruikersnaam en wachtwoord in om in te loggen'
	,'username' => 'Gebruikersnaam'
	,'password' => 'Wachtwoord'
	,'remember_me' => 'Herinner mij'
	,'login_button' => 'Login'
// Errors
	,'invalid_login' => 'Controleer je login informatie en probeer het opnieuw'
	,'no_username' => 'Je moet een gebruikersnaam invullen'
	,'already_logged' => 'Je bent al ingelogd!'
);

// ======================================================
// logout.php
// ======================================================

// To Be Done


?>