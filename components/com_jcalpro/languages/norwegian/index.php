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
	'name' => 'Norwegian'
	,'nativename' => 'Norsk' // Language name in native language. E.g: 'Français' for 'French'
	,'locale' => array('no','norwegian') // Standard locale alternatives for a specific language. For reference, go to: http://www.php.net/manual/en/function.setlocale.php
	,'charset' => 'ISO-8859-1' // For reference, go to : http://www.w3.org/International/O-charset-lang.html
	,'direction' => 'ltr' // 'ltr' for Left to Right. 'rtl' for Right to Left languages such as Arabic.
	,'author' => 'Jeanette'
	,'author_email' => 'jeanette@bewebbed.no'
	,'author_url' => 'http://www.bewebbed.no'
	,'transdate' => '12/19/2006'
);

$lang_general = array (
	'yes' => 'Ja'
	,'no' => 'Nei'
	,'back' => 'Tilbake'
	,'continue' => 'Fortsett'
	,'close' => 'Lukk'
	,'errors' => 'Feil'
	,'info' => 'Informasjon'
	,'day' => 'Dag'
	,'days' => 'Dager'
	,'month' => 'Måned'
	,'months' => 'Måneder'
	,'year' => 'År'
	,'years' => 'År'
	,'hour' => 'Time'
	,'hours' => 'Timer'
	,'minute' => 'Minutt'
	,'minutes' => 'Minutter'
	,'everyday' => 'Hver Dag'
	,'everymonth' => 'Hver Måned'
	,'everyyear' => 'Hvert år'
	,'active' => 'Aktiv'
	,'not_active' => 'Inaktiv'
	,'today' => 'Idag'
	,'signature' => 'Powered by %s'
	,'expand' => 'Åpne'
	,'collapse' => 'Lukke'
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
	,'day_of_week' => array('Søndag','Mandag','Tisdag','Onsdag','Torsdag','Fredag','Lørdag')
	,'months' => array('Januar','Februar','Mars','April','Mai','Juni','Juli','August','September','Oktober','November','Desember')
);

$lang_system = array (
	'system_caption' => 'Systemmelding'
  ,'page_access_denied' => 'Du har ikke nok rettigheter til å hente frem denne siden.'
  ,'page_requires_login' => 'Du må logge på for å hente frem denne siden.'
  ,'operation_denied' => 'Du har ikke nok rettigheter til å utføre denne operasjonen.'
	,'section_disabled' => 'Seksjonen er ikke tilgjengelig !'
  ,'non_exist_cat' => 'Kategorien eksisterer ikke !'
  ,'non_exist_event' => 'Aktiviteten finnes ikke !'
  ,'param_missing' => 'Oppgitte parametre er feil.'
  ,'no_events' => 'Det er ingen aktiviteter å vise.'
  ,'config_string' => 'Du bruker for øyeblikket \'%s\' som kjører på %s, %s och %s.'
  ,'no_table' => '\'%s\' tabellen finnes ikke !'
  ,'no_anonymous_group' => '%s tabellen inneholder ikke gruppen \'Anonymous\' !'
  ,'calendar_locked' => 'Tjenesten er nede for service og oppgradering. Vi beklager detta !'
	,'new_upgrade' => 'Systemet har funnet en ny version. Det anbefales å oppgradere nå. Klikk "Fortsett" for å starte oppgraderingen.'
	,'no_profile' => 'Det oppstod en feil ved henting av din profil.'
	,'unknown_component' => 'Ukjent komponent'
// Mail messages
	,'new_event_subject' => 'Ny aktivitet %s'
	,'event_notification_failed' => 'En feil oppstod når notifikasjons-epost skulle sendes !'
);

// Message body for new event email notification
$lang_system['event_notification_body'] = <<<EOT
Følgende aktivitet er sendt {CALENDAR_NAME}

Tittel: "{TITLE}"
Dato: "{DATE}"
Varighet: "{DURATION}"

Du kan nå denne aktiviteten ved å klikke på lenken nederst
eller kopiere og lime inn i din nettleser.

{LINK}

Mvh,

Aktivitetskalenderen {CALENDAR_NAME}

EOT;

// Admin menu entries
$lang_admin_menu = array (
	'login' => 'Logg inn'
	,'register' => 'Registrer'
  ,'logout' => 'Logg ut <span style="color:#FF9922">[<span style="color:#606F79">%s</span>]</span>'
  ,'user_profile' => 'Min Profil'
	,'admin_events' => 'Aktiviteter'
  ,'admin_categories' => 'Kategorier'
  ,'admin_groups' => 'Grupper'
  ,'admin_users' => 'Brukere'
  ,'admin_settings' => 'Instillinger'
);

// Main menu entries
$lang_main_menu = array (
	'add_event' => 'Legg till aktivitet'
	,'cal_view' => 'Månedsformat'
  ,'flat_view' => 'Listeformat'
  ,'weekly_view' => 'Ukeformat'
  ,'daily_view' => 'Dagformat'
  ,'yearly_view' => 'Årsformat'
  ,'categories_view' => 'Kategorier'
  ,'search_view' => 'Søk'
);

// ======================================================
// Add Event view
// ======================================================

$lang_add_event_view = array(
	'section_title' => 'Legg till aktivitet'
	,'edit_event' => 'Rediger aktivitet [id%d] \'%s\''
	,'update_event_button' => 'Oppdater aktivitet'

// Event details
	,'event_details_label' => 'Aktivitetsdetaljer'
	,'event_title' => 'Aktivitetstittel'
	,'event_desc' => 'Aktivitetsbeskrivelse'
	,'event_cat' => 'Kategori'
	,'choose_cat' => 'Velg en kategori'
	,'event_date' => 'Aktivitetsdato'
	,'day_label' => 'Dag'
	,'month_label' => 'Måned'
	,'year_label' => 'År'
	,'start_date_label' => 'Starttid'
	,'start_time_label' => 'kl.'
	,'end_date_label' => 'Varighet'
	,'all_day_label' => 'hele dagen'
// Contact details
	,'contact_details_label' => 'Kontaktdetailjer'
	,'contact_info' => 'Kontaktinfo'
	,'contact_email' => 'E-post'
	,'contact_url' => 'URL'
// Repeat events
	,'repeat_event_label' => 'Gjenta aktivitet'
	,'repeat_method_label' => 'Gjenta-metode'
	,'repeat_none' => 'Ikke gjenta denne aktiviteten'
	,'repeat_every' => 'Gjenta hver'
	,'repeat_days' => 'Dag(er)'
	,'repeat_weeks' => 'Uke(r)'
	,'repeat_months' => 'Måned(er)'
	,'repeat_years' => 'År'
	,'repeat_end_date_label' => 'Gjenta sluttdato'
	,'repeat_end_date_none' => 'Ingen sluttdato'
	,'repeat_end_date_count' => 'Avslutt etter %s forekomster'
	,'repeat_end_date_until' => 'Gjenta til'
// Other details
	,'other_details_label' => 'Andre detaljer'
	,'picture_file' => 'Bildefil'
	,'file_upload_info' => '(Maksimal størrelse: %d Kb  - Gyldige filtyper : %s )' 
	,'del_picture' => 'Slett nåværende bilde ?'
// Administrative options
	,'admin_options_label' => 'Administrativa valg'
	,'auto_appr_event' => 'Aktivitet godkjent'

// Error messages
	,'no_title' => 'Du må oppgi en overskrift!'
	,'no_desc' => 'Du må oppgi en beskrivelse!'
	,'no_cat' => 'Du må velge en kategori fra menyen!'
	,'date_invalid' => 'Du må oppgi en gyldig dato!'
	,'end_days_invalid' => 'Verdien indtastet i \'Dager\' feltet er ikke gyldig!'
	,'end_hours_invalid' => 'Verdien indtastet i \'Timer\' feltet er ikke gyldig!'
	,'end_minutes_invalid' => 'Verdien indtastet i \'Minutter\' feltet er ikke gyldig!'

	,'non_valid_extension' => 'Filformatet på det tilføyde bildet er ikke gyldig! (Gyldige formater: %s)'

	,'file_too_large' => 'Det tilføyde bildet er større end %d Kb!'
	,'move_image_failed' => 'Systemet kunne ikke uploade bildet ordentlig. Vennligst sjekk at det er den rette størrelse og i et gyldig format, eller kontakt administratoren.'
	,'non_valid_dimensions' => 'Bildets bredde eller høyde er større enn %s pixels!'

	,'recur_val_1_invalid' => 'Verdien inntastet i \'gjenta interval\' er ikke gyldig. Verdien skal være et tall større enn \'0\'!'
	,'recur_end_count_invalid' => 'Verdien inntastet i \'antall gjentagelser\' er ikke gyldig. Verdien skal være et tall større enn \'0\'!'
	,'recur_end_until_invalid' => 'Datoen i \'gjenta inntil\' skal være etter startdatoen!'
// Misc. messages
	,'submit_event_pending' => 'Din aktivitet er sendt. Den vil ikke kunne ses i kalenderen før den er godkjent av en administrator. Takk for ditt bidrag!'
	,'submit_event_approved' => 'Din aktivitet er automatisk godkjent. Takk for ditt bidrag!'
	,'event_repeat_msg' => 'Denne aktiviteten gjentas'
	,'event_no_repeat_msg' => 'Denne aktiviteten gjentas ikke'
);

// ======================================================
// daily view
// ======================================================

$lang_daily_event_view = array(
	'section_title' => 'Daglig'
	,'next_day' => 'Neste dag'
	,'previous_day' => 'Forrige dag'
	,'no_events' => 'Det er ingen aktiviteter denne dag.'
);

// ======================================================
// weekly view
// ======================================================

$lang_weekly_event_view = array(
	'section_title' => 'Ukentlig'
	,'week_period' => '%s - %s'
	,'next_week' => 'Neste uke'
	,'previous_week' => 'Forrige uke'
	,'selected_week' => 'Uke %d'
	,'no_events' => 'Det er ingen aktiviteter denne uke'
);

// ======================================================
// monthly view
// ======================================================

$lang_monthly_event_view = array(
	'section_title' => 'Månedlig'
	,'next_month' => 'Neste måned'
	,'previous_month' => 'Forrige måned'
);

// ======================================================
// flat view
// ======================================================

$lang_flat_event_view = array(
	'section_title' => 'Flat visning'
	,'week_period' => '%s - %s'
	,'next_month' => 'Neste måned'
	,'previous_month' => 'Forrige måned'
	,'contact_info' => 'Kontaktinformasjon'
	,'contact_email' => 'E-mail'
	,'contact_url' => 'Webside'
	,'no_events' => 'Det er ingen aktiviteter denne måned'
);

// ======================================================
// Begivenhed view
// ======================================================

$lang_event_view = array(
	'section_title' => 'Vis aktivitet'
	,'display_event' => 'Aktivitet: \'%s\''
	,'cat_name' => 'Kategori'
	,'event_start_date' => 'Dato'
	,'event_end_date' => 'Inntil'
	,'event_duration' => 'Varighet'
	,'contact_info' => 'Kontaktinformasjon'
	,'contact_email' => 'E-mail'
	,'contact_url' => 'Webside'
	,'no_event' => 'Det er ingen aktiviteter'
	,'stats_string' => '<strong>%d</strong> aktiviteter i alt'
	,'edit_event' => 'Rediger aktivitet'
	,'delete_event' => 'Slett aktivitet'
	,'delete_confirm' => 'Er du sikker på at du vil slette denne aktiviteten?'
	
);

// ======================================================
// Categories view
// ======================================================

$lang_cats_view = array(
	'section_title' => 'Vis kategorier'
	,'cat_name' => 'Kategorinavn'
	,'total_events' => 'Aktiviteter i alt'
	,'upcoming_events' => 'Kommende aktiviteter'
	,'no_cats' => 'Der er ingen kategorier.'
	,'stats_string' => 'Det er <strong>%d</strong> aktiviteter i <strong>%d</strong> kategorier'
);

// ======================================================
// Kategori Begivenheder view
// ======================================================

$lang_cat_events_view = array(
	'section_title' => 'Aktivitet under \'%s\''
	,'event_name' => 'Aktivitetsnavn'
	,'event_date' => 'Dato'
	,'no_events' => 'Det er ingen aktiviteter under denne kategori.'
	,'stats_string' => '<strong>%d</strong> aktiviteter ialt.'
	,'stats_string1' => '<strong>%d</strong> aktiviteter(er) på <strong>%d</strong> side(r)'
);

// ======================================================
// cal_search.php
// ======================================================

$lang_event_search_data = array(
	'section_title' => 'Søk i kalender',
	'search_results' => 'Søkeresultater',
	'category_label' => 'Kategori',
	'date_label' => 'Dato',
	'no_event' => 'Det er ingen aktiviteter under denne kategori.',
	'search_caption' => 'Tast søkeord...',
	'search_again' => 'Søk igjen',
	'search_button' => 'Søk',
// Misc.
	'no_results' => 'Søkingen ga ingen resultater.',	
// Stats
	'stats_string1' => 'Søkingen fant <strong>%d</strong> aktivitet(er)',
	'stats_string2' => 'Søkingen fant <strong>%d</strong> aktivitet(er) på <strong>%d</strong> side(r)'
);

// ======================================================
// profile.php
// ======================================================

if (defined('PROFILE_PHP')) 

$lang_user_profile_data = array(
	'section_title' => 'Min profil',
	'edit_profile' => 'Endre min profil',
	'update_profile' => 'Oppdater min profil',
	'actions_label' => 'Aksjoner',  
// Account Info
	'account_info_label' => 'Profil-information',
	'user_name' => 'Brukernavn',
	'user_pass' => 'Passord',
	'user_pass_confirm' => 'Bekreft passord',
	'user_email' => 'E-mail-adresse',
	'group_label' => 'Gruppemedlemsskap',
// Andre Oplysninger
	'other_details_label' => 'Andre detaljer',
	'first_name' => 'Fornavn',
	'last_name' => 'Etternavn',
	'full_name' => 'Fullt navn',
	'user_website' => 'Hjemmeside',
	'user_location' => 'Sted',
	'user_occupation' => 'Yrke',
// Misc.
	'select_language' => 'Velg språk',
	'edit_profile_success' => 'Din profil er oppdateret',
	'update_pass_info' => 'La passordfeltene være tomme, hvis du ikke vil endre ditt nåværende passord',
// Error messages
	'invalid_password' => 'Oppgi et passord som utelukkende består av bokstaver og tall, og som er mellom 4 og 16 tegn langt!',
	'password_is_username' => 'Passord skal være forskellig fra brukernavnet!',
	'password_not_match' =>'De inntastede passord er forskellige',
	'invalid_email' => 'Du skal oppgi en gyldig e-mail-adresse!',
	'email_exists' => 'En anden bruker er allerede registreret med den e-mail-adresse du har oppgitt. Velg en annen e-mail-adresse!',
	'no_email' => 'Du må oppgi en e-mail-adresse!',
	'no_password' => 'Du må oppgi et passord!'
);

// ======================================================
// register.php
// ======================================================

if (defined('USER_REGISTRATION_PHP')) 

$lang_user_registration_data = array(
	'section_title' => 'Brukerregistrering',
// Step 1: Terms & Conditions
	'terms_caption' => 'Brukerbetingelser',
	'terms_intro' => 'For å fortsette, må du godkjenne følgende:',
	'terms_message' => 'Læs venligst reglerne herunder. Hvis du kan acceptere dem og ønsker at fortsætte med registreringen, så klik på "Godkend"-knappen herunder. For at afbryde registreringen, tryk på din \'Tilbage\'-knap i din browser.<br /><br />Bemærk venligst at vi ikke er ansvarlige for begivenheder indtastet af brugerne. Vi er ikke ansvarlige for nøjagtigheden, fuldstændigheden eller brugbarheden af de offentliggjorte begivenheder, ej heller for indholdet af begivenhederne.<br /><br />Teksterne udtrykker forfatteren af begivenhedernes synspunkt, ikke nødvendigvis denne kalenderapplikations synspunkt. Enhver bruger, som finder at en offentliggjort begivenhed er anstødelig, opfordres til straks at kontakte os via e-mail. Vi har mulighed for at slette anstødeligt indhold, og vi bestræber os på at gøre dette indenfor en rimelig tidsramme, såfremt vi afgør at sletning er nødvendig.<br /><br />Du samtykker i forbindelse med brugen af denne service i, at du ikke vil bruge denne kalenderapplikation til at offentliggøre materiale, som du ved er usand og/eller ærekrænkende, unøjagtig, stødende, vulgært, hadefuldt, chikanerende, uanstændigt, blasfemisk, seksuelt orienteret, truende, krænker privatlivets fred eller på anden måder krænker danske love.<br/><br/>Du samtykker i, at du ikke vil offentliggøre copyright-beskyttet materiale medmindre rettighederne ejes af dig eller af %s.',
	'terms_button' => 'Godkjenn',

/////////////////////////////////////////////////////////////////TERMS_MESSAGE er ikke 100% oversat.

	
// Account Info
	'account_info_label' => 'Profil-informasjon',
	'user_name' => 'Brukernavn',
	'user_pass' => 'Passord',
	'user_pass_confirm' => 'Godkjenn passord',
	'user_email' => 'E-mail',
// Andre Oplysninger
	'other_details_label' => 'Andre oplysninger',
	'first_name' => 'Fornavn',
	'last_name' => 'Etternavn',
	'user_website' => 'Hjemmeside',
	'user_location' => 'Sted',
	'user_occupation' => 'Yrke',
	'register_button' => 'Send registrering',

// Stats
	'stats_string1' => '<strong>%d</strong> brukere',
	'stats_string2' => '<strong>%d</strong> brukere på <strong>%d</strong> side(r)',
// Misc.
	'reg_nomail_success' => 'Takk for din registrering.',
	'reg_mail_success' => 'En e-mail med informasjon om hvordan du aktiverer din konto er blitt sendt til den e-mail-adresse du oppga.',
	'reg_activation_success' => 'Gratulerer! Din profil er nå aktiv og du kan logge inn med ditt brukernavn og passord. Takk for din registrering.',
// Mail messages
	'reg_confirm_subject' => 'Registrering hos %s',
	
// Error messages
	'no_username' => 'Du må oppgi et brukernavn!',
	'invalid_username' => 'Oppgi et brukernavn, som kun består av bokstaver og tall, og er mellom 4 og 30 tegn langt!',
	'username_exists' => 'Brukernavnet du valgte er opptatt. Tast inn et nyyt brukernavn!',
	'no_password' => 'Du må oppgi et passord!',
	'invalid_password' => 'Tast inn passord, som kun består af bokstaver og tall, og er mellom 4 og 16 tegn langt!',
	'password_is_username' => 'Passordet skal være forskjellig fra brukernavnet!',
	'password_not_match' =>'Inntastede passord er forskellige',
	'no_email' => 'Du må oppgi en e-mail!',
	'invalid_email' => 'Du må oppgi en gyldig e-mail-adresse!',
	'email_exists' => 'En annen bruker er registreret med den e-mail-adresse du oppga. Tast inn en annen e-mail-adresse.!',
	'delete_user_failed' => 'Denne profilen kan ikke slettes',
	'no_users' => 'Det er ingen brukerprofiler!',
	'already_logged' => 'Du er allerede logget inn som medlem!',
	'registration_not_allowed' => 'Brukerregistrering er ikke aktiv!',
	'reg_email_failed' => 'Der skjedde en feil under avsendelse af aktiveringsmail!',
	'reg_activation_failed' => 'Der skjedde en feil under godkjennelsen av aktiveringen'

);
// Message body for email activation
$lang_user_registration_data['reg_confirm_body'] = <<<EOT
Takk fordi du registrerte deg i {CALENDAR_NAME}

Ditt brukernavn er: "{USERNAME}"
Ditt passord er: "{PASSWORD}"

For at aktivere din profil skal du klikke på linket herunder
eller kopiere det til din webbrowser

{REG_LINK}

Vennlig hilsen

Administratoren i {CALENDAR_NAME}

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
// admin_Begivenheder.php
// ======================================================


if (defined('ADMIN_EVENTS_PHP')) 

$lang_event_admin_data = array(
	'section_title' => 'Aktivitetsadministrator',
	'events_to_approve' => 'Aktivitetsadministrator: Aktiviteter som avventer godkjennelse',
	'upcoming_event' => 'Aktivitetsadministrator: Kommende begivenheter',
	'past_event' => 'Aktivitetsadministrator: Tidligere begivenheter',
	'add_event' => 'Legg til ny aktivitet',
	'edit_event' => 'Rediger aktivitet',
	'view_event' => 'Vis aktivitet',
	'approve_event' => 'Godkjenn aktivitet',
	'update_event' => 'Oppdater aktivitetsinformasjon',
	'delete_event' => 'Slett aktivitet',
	'events_label' => 'Aktiviteter',
	'auto_approve' => 'Auto-godkjenn',
	'date_label' => 'Dato',
	'actions_label' => 'Aksjoner',
	'events_filter_label' => 'Sorter aktiviteter',
	'events_filter_options' => array('Vis alle aktiviteter','Vis ikke-godkjente aktiviteter','Vis kommende aktiviteter','Vis tidligere aktiviteter'),
	'picture_attached' => 'Bilde vedlagt',
// Vis Begivenhed
	'view_event_name' => 'Aktivitet: \'%s\'',
	'event_start_date' => 'Dato',
	'event_end_date' => 'Inntil',
	'event_duration' => 'Varighet',
	'contact_info' => 'Kontaktinformasjon',
	'contact_email' => 'E-mail',
	'contact_url' => 'Webside',
// General Info
// Begivenhed form
	'edit_event_title' => 'Aktivitet: \'%s\'',
	'cat_name' => 'Kategori',
	'event_start_date' => 'Dato',
	'event_end_date' => 'Inntil',
	'contact_info' => 'Kontaktinformasjon',
	'contact_email' => 'E-mail',
	'contact_url' => 'Webside',
	'no_event' => 'Det finnes ingen aktiviteter',
	'stats_string' => '<strong>%d</strong> Aktiviteter ialt',
// Stats
	'stats_string1' => '<strong>%d</strong> Begivenhed(er)',
	'stats_string2' => 'Total: <strong>%d</strong> Aktiviteter på <strong>%d</strong> side(r)',
// Misc.
	'add_event_success' => 'Ny aktivitet lagt til',
	'edit_event_success' => 'Aktivitet oppdatert',
	'approve_event_success' => 'Aktivitet godkjent',
	'delete_confirm' => 'Er du sikker på at du vil slette denne aktiviteten ?',
	'delete_event_success' => 'Aktivitet slettet',
	'active_label' => 'Aktiv',
	'not_active_label' => 'Inaktiv',
// Error messages
	'no_event_name' => 'Du må oppgi et navn til denne aktiviteten!',
	'no_event_desc' => 'Du må oppgi en beskrivelse av aktiviteten!',
	'no_cat' => 'Du må velge en kategori til denne aktiviteten!',
	'no_day' => 'Du må velge en dag!',
	'no_month' => 'Du må velge en måned!',
	'no_year' => 'Du må velge et år!',
	'non_valid_date' => 'Oppgi en gyldig dato!',
	'end_days_invalid' => '\'Dag\'-feltet under \'Varighet\' kan kun bestå av tall!',
	'end_hours_invalid' => '\'Timer\'-feltet under \'Varighet\' kan kun inneholde tall!',
	'end_minutes_invalid' => '\'Minutter\'-feltet under \'Varighet\' kan kun inneholde tall!',
	'file_too_large' => 'Vedlagt fil er større enn %d Kb!',
	'non_valid_extension' => 'Det vedlagte bildets filformat er ikke tillat!',
	'delete_event_failed' => 'Denne aktiviteten kunne ikke slettes',
	'approve_event_failed' => 'Denne aktiviteten kunne ikke godkjennes',
	'no_events' => 'Det er ingen aktiviteter!',
	'move_image_failed' => 'Systemet kunne ikke flytte det opplastede bildet!',
	'non_valid_dimensions' => 'Bildets bredde eller høyde er større enn %s pixels!',

	'recur_val_1_invalid' => 'Verdien inntastet i \'Gjenta intervall\' er ikke gyldig. Det må være et tall større end \'0\'!',
	'recur_end_count_invalid' => 'Verdien inntastet i \'Antall gjentagelser\' er ikke gyldig. Det må være et tall større end \'0\'!',
	'recur_end_until_invalid' => 'Verdien inntastet i \'Gjentag inntil\', er ikke gyldig. Det må være en dato etter startdatoen!'

);

// ======================================================
// admin_categories.php
// ======================================================

if (defined('ADMIN_CATS_PHP')) 

$lang_cat_admin_data = array(
	'section_title' => 'Kategori-administrasjon',
	'add_cat' => 'Legg til ny kategori',
	'edit_cat' => 'Endre kategori',
	'update_cat' => 'Oppdater kategori-info',
	'delete_cat' => 'Slett kategori',
	'events_label' => 'Aktiviteter',
	'visibility' => 'Offentliggjort',
	'actions_label' => 'Aksjoner',
	'users_label' => 'Brukere',
	'admins_label' => 'Administratorer',
// General Info
	'general_info_label' => 'Generell informasjon',
	'cat_name' => 'Kategorinavn',
	'cat_desc' => 'Kategoribeskrivelse',
	'cat_color' => 'Farve',
	'pick_color' => 'Velg en farve!',
	'status_label' => 'Status',
// Administrative Options
	'admin_label' => 'Administrative egenskaper',
	'auto_admin_appr' => 'Auto-godkjenn admin-inntastninger',
	'auto_user_appr' => 'Auto-godkjenn bruker-inntastninger',
// Stats
	'stats_string1' => '<strong>%d</strong> kategorier',
	'stats_string2' => 'Aktiv: <strong>%d</strong>&nbsp;&nbsp;&nbsp;Total: <strong>%d</strong>&nbsp;&nbsp;&nbsp;på <strong>%d</strong> side(r)',
// Misc.
	'add_cat_success' => 'Ny kategori lagt til',
	'edit_cat_success' => 'Kategori oppdatert',
	'delete_confirm' => 'Er du sikker på at du vil slette denne kategorien ?',
	'delete_cat_success' => 'Kategori slettet',
	'active_label' => 'Aktiv',
	'not_active_label' => 'Inaktiv',
// Error messages
	'no_cat_name' => 'Du må oppgi et navn til kategorien!',
	'no_cat_desc' => 'Du må oppgi en beskrivelse på kategorien!',
	'no_color' => 'Du må velge en farve til kategorien!',
	'delete_cat_failed' => 'Kategorien kunne ikke slettes',
	'no_cats' => 'Det er ingen kategorier!',
	'cat_has_events' => 'Denne kategori inneholder %d aktivitet(er) og kan derfor ikke slettes!<br>Slett resterende aktiviteter og prøv igen!'

);
// ======================================================
// admin_users.php
// ======================================================

if (defined('ADMIN_USERS_PHP')) 

$lang_user_admin_data = array(
	'section_title' => 'Brukeradministration',
	'add_user' => 'Legg til ny bruker',
	'edit_user' => 'Rediger bruker',
	'update_user' => 'Oppdater bruker',
	'delete_user' => 'Slett bruker',
	'last_access' => 'Siste innlogging',
	'actions_label' => 'Aksjoner',
	'active_label' => 'Aktiv',
	'not_active_label' => 'Inaktiv',
// Account Info
	'account_info_label' => 'Brukerinformasjon',
	'user_name' => 'Brukernavn',
	'user_pass' => 'Passord',
	'user_pass_confirm' => 'Bekreft passord',
	'user_email' => 'E-mail',
	'group_label' => 'Gruppemedlemskap',
	'status_label' => 'Brukerstatus',
// Andre Oplysninger
	'other_details_label' => 'Andre opplysninger',
	'first_name' => 'Fornavn',
	'last_name' => 'Etternavn',
	'user_website' => 'Hjemmeside',
	'user_location' => 'Sted',
	'user_occupation' => 'Yrke',
// Stats
	'stats_string1' => '<strong>%d</strong> brukere',
	'stats_string2' => '<strong>%d</strong> brukere på <strong>%d</strong> side(r)',
// Misc.
	'select_group' => 'Velg...',
	'add_user_success' => 'Bruker lagt til',
	'edit_user_success' => 'Bruker oppdatert',
	'delete_confirm' => 'Er du sikker på du vil slette denne brueren?',
	'delete_user_success' => 'Bruker slettet',
	'update_pass_info' => 'La passord-feltet være tomt, hvis du ikke vil endre det',
	'access_never' => 'Aldri',
// Error messages
	'no_username' => 'Du må oppgi et brukernavn!',
	'invalid_username' => 'Oppgi et brukernavn, som består av tall og bokstaver, og er mellom 4 og 30 tegn langt!',
	'invalid_password' => 'Oppgi et passord, som består av tall og bokstaver, og er mellom 4 og 16 tegn langt!',
	'password_is_username' => 'Passord skal være forskellig fra brukernavnet!',
	'password_not_match' =>'De 2 oppgitte passord var forskellige',
	'invalid_email' => 'Du må oppgi en gyldig e-mail-adresse!',
	'email_exists' => 'En annen bruker er registreret med den e-mail-adresse du oppga. Oppgi en annen e-mail-adresse.!',
	'username_exists' => 'Brukernavnet er opptatt, vennligst velg et annet!',
	'no_email' => 'Du må oppgi en e-mail-adresse!',
	'invalid_email' => 'Du må oppgi en gyldig e-mail-adresse!',
	'no_password' => 'Du må oppgi et passord!',
	'no_group' => 'Velg en gruppe til denne brukeren!',
	'delete_user_failed' => 'Denne profilen kan ikke slettes',
	'no_users' => 'Det finnes ingen brukerprofiler!'

);

// ======================================================
// admin_groups.php
// ======================================================

if (defined('ADMIN_GROUPS_PHP')) 

$lang_group_admin_data = array(
	'section_title' => 'Gruppeadministration',
	'add_group' => 'Legg til ny gruppe',
	'edit_group' => 'Rediger gruppe',
	'update_group' => 'Oppdater gruppe',
	'delete_group' => 'Slett gruppe',
	'view_group' => 'Vis gruppe',
	'users_label' => 'Brukere',
	'actions_label' => 'Aksjoner',
// General Info
	'general_info_label' => 'Generell information',
	'group_name' => 'Gruppenavn',
	'group_desc' => 'Gruppebeskrivelse',
// Group Access Level
	'access_level_label' => 'Gruppe-adgangsnivå',
	'Administrator' => 'Brukere i denne gruppen har administratortilgang',
	'can_manage_accounts' => 'Brukere i denne gruppen kan redigere brukere',
	'can_change_settings' => 'Brukere i denne gruppen kan endre kalenderegenskaper',
	'can_manage_cats' => 'Brukere i denne gruppen kan redigere kategorier',
	'upl_need_approval' => 'Registrerte aktiviteter krever administrativ godkjennelse',
// Stats
	'stats_string1' => '<strong>%d</strong> grupper',
	'stats_string2' => 'Total: <strong>%d</strong> grupper på <strong>%d</strong> side(r)',
	'stats_string3' => 'Total: <strong>%d</strong> brukere på <strong>%d</strong> side(r)',
// View Group Members
	'group_members_string' => 'Medlemmer av \'%s\' gruppen',
	'username_label' => 'Brukernavn',
	'firstname_label' => 'Fornavn',
	'lastname_label' => 'Etternavn',
	'email_label' => 'E-mail',
	'last_access_label' => 'Siste login',
	'edit_user' => 'Rediger bruker',
	'delete_user' => 'Slett bruker',
// Misc.
	'add_group_success' => 'Ny gruppe lagt til',
	'edit_group_success' => 'Gruppe oppdatert',
	'delete_confirm' => 'Er du sikker på du vil slette denne gruppen?',
	'delete_user_confirm' => 'Er du sikker på du vil slette denne brukeren?',
	'delete_group_success' => 'Gruppe slettet',
	'no_users_string' => 'Der er ingen brukere i denne gruppen',
// Error messages
	'no_group_name' => 'Du må oppgi et navn på gruppen!',
	'no_group_desc' => 'Du må oppgi en beskrivelse for gruppen!',
	'delete_group_failed' => 'Denne gruppen kunne ikke slettes',
	'no_groups' => 'Det finnes ingen grupper!',
	'group_has_users' => 'Denne gruppen inneholder %d bruker(e) og kan derfor ikke slettes!<br>Fjern resterende brukere fra gruppen og prøv igen!'

);

// ======================================================
// admin_settings.php / admin_settings_template.php / 
// admin_settings_updates.php
// ======================================================

$lang_settings_data = array(
	'section_title' => 'Kalenderinnstillinger'
// Links
	,'admin_links_text' => 'Velg seksjon'
	,'admin_links' => array('Hovedinnstillinger','Templateinnstillinger','Oppdateringer')
// General Settings
	,'general_settings_label' => 'Hovedinnstillinger'
	,'calendar_name' => 'Kalendernavn'
	,'calendar_description' => 'Kalenderbeskrivelse'
	,'calendar_admin_email' => 'Kalenderadministrators e-mail'
	,'cookie_name' => 'Navn på cookie brukt af komponenten'
	,'cookie_path' => 'Sti på cookie brukt af komponenten'
	,'debug_mode' => 'Aktiver debug mode'
	,'calendar_status' => 'Kalenderens offentlige status'
// Environment Settings
	,'env_settings_label' => 'Miljøinnstillinger'
	,'lang' => 'Språk'
		,'lang_name' => 'Språk'
		,'lang_native_name' => 'Navn'
		,'lang_trans_date' => 'Oversatt dato'
		,'lang_author_name' => 'Forfatter'
		,'lang_author_email' => 'E-mail'
		,'lang_author_url' => 'Webside'
	,'charset' => 'Landkode'
	,'theme' => 'Tema'
		,'theme_name' => 'Temanavn'
		,'theme_date_made' => 'Laget den'
		,'theme_author_name' => 'Forfatter'
		,'theme_author_email' => 'E-mail'
		,'theme_author_url' => 'Webside'
	,'timezone' => 'Tidssone-forskyvning'
	,'time_format' => 'Format for klokkeslett'
		,'24hours' => '24 timer'
		,'12hours' => '12 timer'
	,'auto_daylight_saving' => 'Automatisk innstilling av sommertid'
	,'main_table_width' => 'Bredde på hovedtabell (pixels eller %)'
	,'day_start' => 'Ukedager starter med'
	,'default_view' => 'Standardvisning'
	,'search_view' => 'Tillat søking'
	,'archive' => 'Vis tidligere aktiviteter'
	,'events_per_page' => 'Antall aktiviteter pr. side'
	,'sort_order' => 'Standardsortering'
		,'sort_order_title_a' => 'Tittel stigende'
		,'sort_order_title_d' => 'Tittel synkende'
		,'sort_order_date_a' => 'Dato stigende'
		,'sort_order_date_d' => 'Dato synkende'
	,'show_recurrent_events' => 'Vis repeterende aktiviteter'
	,'multi_day_events' => 'Flerdagsaktiviteter'
		,'multi_day_events_all' => 'Vis alle datoer'
		,'multi_day_events_bounds' => 'Vis kun start og sluttdatoer'
		,'multi_day_events_start' => 'Vis kun startdato'
	// User Settings
	,'user_settings_label' => 'Brukerinnstillinger'
	,'allow_user_registration' => 'Tillat brukerregistreringer'
	,'reg_duplicate_emails' => 'Tillat samme e-mail-adresse til flere brukere'
	,'reg_email_verify' => 'Aktiver brukeraktivering gjennom e-mail'
// event View
	,'Begivenhed_view_label' => 'Vis aktiviteter'
	,'popup_event_mode' => 'Popup-aktivitet'
	,'popup_event_width' => 'Bredde på popup-vindu'
	,'popup_event_height' => 'Høyde på popup-vindu'
// Add event View
	,'add_event_view_label' => 'Legg til aktivitetsvisning'
	,'add_event_view' => 'Aktivert'
	,'addevent_allow_html' => 'Tillat <b>BB Code</b> i beskrivelse'
	,'addevent_allow_contact' => 'Tillat kontakt'
	,'addevent_allow_email' => 'Tillat e-mail'
	,'addevent_allow_url' => 'Tillat URL'
	,'addevent_allow_picture' => 'Tillat bilder'
	,'new_post_notification' => 'Send meg en e-mail når en aktivitet skal godkjennes'
// Calendar View
	,'calendar_view_label' => 'Vis kalender (månedlig)'
	,'monthly_view' => 'Aktivert'
	,'cal_view_show_week' => 'Vis ukenummer'
	,'cal_view_max_chars' => 'Maks. tegn i beskrivelse'
// Flyer View
	,'flyer_view_label' => 'Vis brosjyre'
	,'flyer_view' => 'Aktivert'
	,'flyer_show_picture' => 'Vis bilder i brosjyrevisning'
	,'flyer_view_max_chars' => 'Maks. tegn i beskrivelse'
// Weekly View
	,'weekly_view_label' => 'Vis ukentlig'
	,'weekly_view' => 'Aktivert'
	,'weekly_view_max_chars' => 'Maks. tegn i beskrivelse'
// Daily View
	,'daily_view_label' => 'Vis daglig'
	,'daily_view' => 'Aktivert'
	,'daily_view_max_chars' => 'Maks. tegn i beskrivelse'
// Vis Kategorier
	,'categories_view_label' => 'Vis kategorier'
	,'cats_view' => 'Aktivert'
	,'cats_view_max_chars' => 'Maks. tegn i beskrivelse'
// Mini Calendar
	,'mini_cal_label' => 'Minikalender'
	,'mini_cal_def_picture' => 'Standardbilde'
	,'mini_cal_display_picture' => 'Vis bilde'
	,'mini_cal_diplay_options' => array('Intet','Standardbilde', 'Daglig bilde','Ukentligt bilde','Tilfeldig bilde')
// Mail Settings
	,'mail_settings_label' => 'Mail-innstillinger'
	,'mail_method' => 'Metode til sending av mail'
	,'mail_smtp_host' => 'SMTP hosts (adskilt af semikolon;)'
	,'mail_smtp_auth' => ' SMTP authentication'
	,'mail_smtp_username' => 'SMTP brukernavn'
	,'mail_smtp_adgangskode' => 'SMTP passord'

// Picture Settings
	,'picture_settings_label' => 'Bilde-innstillinger'
	,'max_upl_dim' => 'Maks. bredde og høyde for opplastede bilder'
	,'max_upl_size' => 'Maks. størrelse for opplastede bilder (i bytes)'
	,'picture_chmod' => 'Standardrettigheter for bilder (CHMOD)(oktalt)'
	,'allowed_file_extensions' => 'Godkjente filtyper for opplastede bilder'
// Form Buttons
	,'update_config' => 'Lagre ny konfigurasjon'
	,'restore_config' => 'Restore standardinnstillinger'
// Misc.
	,'update_settings_success' => 'Innstillinger oppdatert'
	,'restore_default_confirm' => 'Er du sikker på at du vil restore til standardinnstillinger?'
// Template Configuration
	,'template_type' => 'Templatetype'
	,'template_header' => 'Hovedtekst'
	,'template_footer' => 'Fottekst'
	,'template_status_default' => 'Bruk standard-tema-template'
	,'template_status_custom' => 'Bruk flg. template:'
	,'template_custom' => 'Brukerdefineret template'

	,'info_meta' => 'Meta-informasjon'
	,'info_status' => 'Statuskontroll'
	,'info_status_default' => 'Deaktiver dette innhold'
	,'info_status_custom' => 'Vis flg. innhold:'
	,'info_custom' => 'Brugerdefineret innhold'

	,'dynamic_tags' => 'Dynamiske tags'

// Product updates
	,'updates_check_text' => 'Vennligst vent mens vi henter informasjon fra serveren...'
	,'updates_no_response' => 'Intet svar fra serveren, prøv igjen senere.'
	,'avail_updates' => 'Tilgjengelige oppdateringer:'
	,'updates_download_zip' => 'Download ZIP-fil (.zip)'
	,'updates_download_tgz' => 'Download TGZ-fil (.tar.gz)'
	,'updates_released_label' => 'Utgivelsesdag: %s'
	,'updates_no_update' => 'Du bruger den siste versjonen. Ingen oppdatering nødvendig.'
);

// ======================================================
// cal_mini.inc.php
// ======================================================

$lang_mini_cal = array(
	'def_pic' => 'Standardbilde'
	,'daily_pic' => 'Dagens bilde (%s)'
	,'weekly_pic' => 'Ukens bilde (%s)'
	,'rand_pic' => 'Tilfeldigt bilde (%s)'
	,'post_event' => 'Legg til ny aktivitet'
	,'num_events' => '%d aktivitet(er)'
	,'selected_week' => 'Uke %d'
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
// installe.php
// ======================================================

// To Be Done

// ======================================================
// login.php
// ======================================================

if (defined('LOGIN_PHP')) 

$lang_login_data = array(
	'section_title' => 'Logg inn'
// General Settings
	,'login_intro' => 'Oppgi brukernavn og passord for å logge inn'
	,'username' => 'Brukernavn'
	,'password' => 'Passord'
	,'remember_me' => 'Husk meg'
	,'login_button' => 'Logg inn'
// Errors
	,'invalid_login' => 'Sjekk dine inntastede opplysninger og prøv igjen!'
	,'no_username' => 'Du må oppgi ditt brukernavn!'
	,'already_logged' => 'Du er allerede logget inn!'
);

// ======================================================
// logout.php
// ======================================================

// To Be Done


?>