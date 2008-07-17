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
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
// New language structure
$lang_info = array (
	'name' => 'Slovak'
	,'nativename' => 'Slovak' // Language name in native language. E.g: 'Fran?ais' for 'French'
	,'locale' => array('sk_SK','slovak') // Standard locale alternatives for a specific language. For reference, go to: http://www.php.net/manual/en/function.setlocale.php
	,'charset' => 'ISO-8859-2' // For reference, go to : http://www.w3.org/International/O-charset-lang.html
	,'direction' => 'ltr' // 'ltr' for Left to Right. 'rtl' for Right to Left languages such as Arabic.
	,'author' => 'Dusan Hornik (Duho)'
	,'author_email' => 'dusanho@centrum.sk'
	,'author_url' => 'http://www.fcnitra.com'
	,'transdate' => '12/26/2006'
);

$lang_general = array (
	'yes' => 'Áno'
	,'no' => 'Nie'
	,'back' => 'Spä'
	,'continue' => 'Pokraèuj'
	,'close' => 'Zatvor'
	,'errors' => 'Chyba'
	,'info' => 'Informácie'
	,'day' => 'Deò'
	,'days' => 'Dní'
	,'month' => 'Mesiac'
	,'months' => 'Mesiacov'
	,'year' => 'Rok'
	,'years' => 'Rokov'
	,'hour' => 'Hodina'
	,'hours' => 'Hodín'
	,'minute' => 'Minúta'
	,'minutes' => 'Minút'
	,'everyday' => 'Kadı deò'
	,'everymonth' => 'Kadı mesiac'
	,'everyyear' => 'Kadı Rok'
	,'active' => 'Aktívny'
	,'not_active' => 'Neaktívny'
	,'today' => 'Dnes'
	,'signature' => 'Vytvoril %s'
	,'expand' => 'Rozšíri'
	,'collapse' => 'Collapse'
);

// Date formats, For reference, go to : http://www.php.net/manual/en/function.strftime.php
$lang_date_format = array (
	'full_date' => '%A, %B %d, %Y' // napr. Streda, June 05, 2002
	,'full_date_time_24hour' => '%A, %B %d, %Y At %H:%M' // e.g. Wednesday, June 05, 2002 At 21:05
	,'full_date_time_12hour' => '%A, %B %d, %Y At %I:%M %p' // e.g. Wednesday, June 05, 2002 At 9:05 pm
	,'day_month_year' => '%d-%b-%Y' // e.g 10-Sep-2004
	,'local_date' => '%c' // Preferred date and time representation for current language 
	,'mini_date' => '%a. %d %b, %Y' 
	,'month_year' => '%B %Y'
	,'day_of_week' => array('Nede¾a','Pondelok','Utorok','Streda','Štvrtok','Piatok','Sobota')
	,'months' => array('Január','Február','Marec','Apríl','Máj','Jún','Júl','August','September','Október','November','December')
);

$lang_system = array (
	'system_caption' => 'Systémové hlásenie'
  ,'page_access_denied' => 'Nemáte potrebné oprávnenia pre prístup k tejto vo¾be.'
  ,'page_requires_login' => 'Musíte by prihlásenı.'
  ,'operation_denied' => 'Nemáte potrebné oprávnenia pre vykonanie tejto operácie.'
	,'section_disabled' => 'Táto oblas je momentálne zablokovaná!'
  ,'non_exist_cat' => 'Zvolená kategória neexistuje!'
  ,'non_exist_event' => 'Zvolená udalos neexistuje !'
  ,'param_missing' => 'Zadané parametre sú nesprávne.'
  ,'no_events' => 'Nie sú iadne udalosti pre zobrazenie'
  ,'config_string' => 'Práve pouívate \'%s\' prebieha %s, %s a %s.'
  ,'no_table' => 'Táto \'%s\' tabu¾ka neexistuje!'
  ,'no_anonymous_group' => 'Táto %s tabu¾ka neobsahuje \'Anonymous\' skupinu !'
  ,'calendar_locked' => 'Táto sluba je doèasne mimo prevádzky kvôli údrbe a upgradu. Ospravedlòujeme sa !'
	,'new_upgrade' => 'System detekoval novú verziu. Doporuèujeme vykona update. Klikni "Pokraèova" pre spustenie upgradu.'
	,'no_profile' => 'Pri vyvolaní vášho profilu sa vyskytla chyba'
	,'unknown_component' => 'Neznámy komponent'
// Mail messages
	,'new_event_subject' => 'Udalos vyaduje schválenie  %s'
	,'event_notification_failed' => 'Poèas odosielania notifikaèného E-mailu sa vyskytla chyba !'
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
	'login' => 'Prihlásenie'
	,'register' => 'Registrácia'
  ,'logout' => 'Logout <span style="color:#FF9922">[<span style="color:#606F79">%s</span>]</span>'
  ,'user_profile' => 'Môj  Profil'
	,'admin_events' => 'Udalosti'
  ,'admin_categories' => 'Kategórie'
  ,'admin_groups' => 'Skupiny'
  ,'admin_users' => 'Uívatelia'
  ,'admin_settings' => 'Nastavenie'
);

// Main menu entries
$lang_main_menu = array (
	'add_event' => 'Pridaj udalos'
	,'cal_view' => 'Mesaènı náh¾ad'
  ,'flat_view' => 'Rozšírenı náh¾ad'
  ,'weekly_view' => 'Tıdennı náh¾ad'
  ,'daily_view' => 'Dennı náh¾ad'
  ,'yearly_view' => 'Roènı náh¾ad'
  ,'categories_view' => 'Kategórie'
  ,'search_view' => 'H¾adaj'
);

// ======================================================
// Add Event view
// ======================================================

$lang_add_event_view = array(
	'section_title' => 'Pridaj udalos'
	,'edit_event' => 'Edituj udalos [id%d] \'%s\''
	,'update_event_button' => 'Aktualizuj udalos'

// Event details
	,'event_details_label' => 'Podrobnosti o udalosti'
	,'event_title' => 'Názov udalosti'
	,'event_desc' => 'Popis udalosti'
	,'event_cat' => 'Kategória'
	,'choose_cat' => 'Vyber kategóriu'
	,'event_date' => 'Dátum udalosti'
	,'day_label' => 'Deò'
	,'month_label' => 'Mesiac'
	,'year_label' => 'Rok'
	,'start_date_label' => 'Èas zaèiatku'
	,'start_time_label' => 'O'
	,'end_date_label' => 'Trvanie'
	,'all_day_label' => 'Celı deò'
// Contact details
	,'contact_details_label' => 'Detaily kontaktu'
	,'contact_info' => 'Info o kontakte'
	,'contact_email' => 'Email'
	,'contact_url' => 'URL'
// Repeat events
	,'repeat_event_label' => 'Opakuj udalos'
	,'repeat_method_label' => 'Spôsob opakovania'
	,'repeat_none' => 'Neopakuj túto udalost'
	,'repeat_every' => 'Opakuj kadıch'
	,'repeat_days' => 'Dní'
	,'repeat_weeks' => 'Tıdòov'
	,'repeat_months' => 'Mesiacov'
	,'repeat_years' => 'Rokov'
	,'repeat_end_date_label' => 'Opakuj koncovı dátum'
	,'repeat_end_date_none' => 'Bez dátumu ukonèenia'
	,'repeat_end_date_count' => 'Koniec po %s vıskytoch'
	,'repeat_end_date_until' => 'Opakuj dokia¾'
// Other details
	,'other_details_label' => 'Ïalšie detaily'
	,'picture_file' => 'Súbor obrázku'
	,'file_upload_info' => '(%d KBytes limit - Valid extensions : %s )' 
	,'del_picture' => 'Vymaza aktuálny obrázok ?'
// Administrative options
	,'admin_options_label' => 'Monosti administrátora'
	,'auto_appr_event' => 'Udalos schválená'

// Error messages
	,'no_title' => 'Musíte zada názov udalosti !'
	,'no_desc' => 'Musíte zada popis udalosti !'
	,'no_cat' => 'Musíte vybra kategóriu z menu !'
	,'date_invalid' => 'Musíte zada platnı dátum udalosti !'
	,'end_days_invalid' => 'Hodnota zadaná v poli\'Dni\' je nesprávna !'
	,'end_hours_invalid' => 'Hodnota zadaná v poli\'Hodiny\' je nesprávna  !'
	,'end_minutes_invalid' => 'Hodnota zadaná v poli\'Minúty\' je nesprávna  !'
	,'move_image_failed' => 'Systémová chyba pri nahrávaní obrázku. Zvo¾te vhodnı typ a ve¾kos, alebo kontaktujte administrátora.'
	,'non_valid_dimensions' => 'Šírka a vıška obrázku je väèšie ako %s pixelov !'

	,'recur_val_1_invalid' => 'Hodnota vloená ako \'interval opakovania\' je neplatná. Hodnota musí by väèšia ako  \'0\' !'
	,'recur_end_count_invalid' => 'Hodnota vloená ako \'poèet vıskytov\' je neplatná. Hodnota musí by väèšia ako \'0\' !'
	,'recur_end_until_invalid' => 'Hodnota dátumu \'opakuj pokia¾\' musí by väèšia ako dátum zaèiatku !'
// Misc. messages
	,'submit_event_pending' => 'Vaša udalos bola pridaná! Predsa len NEBUDE pridaná skôr, ako ju schváli administrátor. Ïakujeme za príspevok!'
	,'submit_event_approved' => 'Vaša pridaná udalos je automaticky schválená. Ïakujeme za príspevok!'
	,'event_repeat_msg' => 'Táto udalos má nastavené opakovanie'
	,'event_no_repeat_msg' => 'Táto udalos nemá opakovanie'
);

// ======================================================
// daily view
// ======================================================

$lang_daily_event_view = array(
	'section_title' => 'Dennı preh¾ad'
	,'next_day' => 'Ïalší deò'
	,'previous_day' => 'Predchádzajúci deò'
	,'no_events' => 'V tomto dni nie sú iadne udalosti.'
);

// ======================================================
// weekly view
// ======================================================

$lang_weekly_event_view = array(
	'section_title' => 'Tıdennı preh¾ad'
	,'week_period' => '%s - %s'
	,'next_week' => 'Ïalší tıdeò'
	,'previous_week' => 'Predchádzajúci tıdeò'
	,'selected_week' => 'Tıdeò %d'
	,'no_events' => 'V tomto tıdni nie sú iadne udalosti'
);

// ======================================================
// monthly view
// ======================================================

$lang_monthly_event_view = array(
	'section_title' => 'Mesaènı preh¾ad'
	,'next_month' => 'Ïalší mesiac'
	,'previous_month' => 'Predchádzajúci mesiac'
);

// ======================================================
// flat view
// ======================================================

$lang_flat_event_view = array(
	'section_title' => 'Rozšírenı náh¾ad'
	,'week_period' => '%s - %s'
	,'next_month' => 'Ïalší mesiac'
	,'previous_month' => 'Predchádzajúci mesiac'
	,'contact_info' => 'Kontakt Info'
	,'contact_email' => 'Email'
	,'contact_url' => 'URL'
	,'no_events' => 'V tomto mesiaci nie sú iadne udalosti'
);

// ======================================================
// Event view
// ======================================================

$lang_event_view = array(
	'section_title' => 'Preh¾ad udalostí'
	,'display_event' => 'Udalos: \'%s\''
	,'cat_name' => 'Kategória'
	,'event_start_date' => 'Dátum'
	,'event_end_date' => 'A do'
	,'event_duration' => 'Trvanie'
	,'contact_info' => 'Kontact Info'
	,'contact_email' => 'Email'
	,'contact_url' => 'URL'
	,'no_event' => 'Neexistujú iadne udalosti na zobrazenie.'
	,'stats_string' => '<strong>%d</strong> Udalostí celkom'
	,'edit_event' => 'Edituj udalos'
	,'delete_event' => 'Vyma udalos'
	,'delete_confirm' => 'Ste si istı, e chcete vymaza udalos ?'
	
);

// ======================================================
// Categories view
// ======================================================

$lang_cats_view = array(
	'section_title' => 'Preh¾ad kategórií'
	,'cat_name' => 'Názov kategórie'
	,'total_events' => 'Celkom udalostí'
	,'upcoming_events' => 'Najblišie udalosti'
	,'no_cats' => 'Neexistujú iadne kategórie na zobrazenie.'
	,'stats_string' => 'Je <strong>%d</strong> udalostí v <strong>%d</strong> Kategóriiách'
);

// ======================================================
// Category Events view
// ======================================================

$lang_cat_events_view = array(
	'section_title' => 'Udalos pod \'%s\''
	,'event_name' => 'Názov udalosti'
	,'event_date' => 'Dátum'
	,'no_events' => 'Pod touto  kategóriou nie sú iadne udalosti.'
	,'stats_string' => '<strong>%d</strong> Udalostí celkom'
	,'stats_string1' => '<strong>%d</strong> Udalostí na <strong>%d</strong> strane(ách)'
);

// ======================================================
// cal_search.php
// ======================================================

$lang_event_search_data = array(
	'section_title' => 'Preh¾adaj kalendár',
	'search_results' => 'Nájdi vısledky',
	'category_label' => 'Kategória',
	'date_label' => 'Dátum',
	'no_events' => 'Pod touto  kategóriou nie sú iadne udalosti.',
	'search_caption' => 'Napíš k¾úèové slovo ...',
	'search_again' => 'H¾adaj znovu',
	'search_button' => 'H¾adaj',
// Misc.
	'no_results' => 'Bez vısledku',	
// Stats
	'stats_string1' => '<strong>%d</strong> udalos(ti) nájdená (é)',
	'stats_string2' => '<strong>%d</strong> Udalosti na <strong>%d</strong> strane(ách)'
);

// ======================================================
// profile.php
// ======================================================

if (defined('PROFILE_PHP')) 

$lang_user_profile_data = array(
	'section_title' => 'Môj Profil',
	'edit_profile' => 'Edituj môj profil',
	'update_profile' => 'Update môjho profilu',
	'actions_label' => 'Akcie',
// Account Info
	'account_info_label' => 'Informácie o úète',
	'user_name' => 'Uívate¾ské meno',
	'user_pass' => 'Heslo',
	'user_pass_confirm' => 'Potvrï heslo',
	'user_email' => 'E-mailová adresa',
	'group_label' => 'Skupina èlenov',
// Other Details
	'other_details_label' => 'Ïalšie detaily',
	'first_name' => 'Meno',
	'last_name' => 'Priezvisko',
	'full_name' => 'Celé meno',
	'user_website' => 'Domová stránka',
	'user_location' => 'Lokalita',
	'user_occupation' => 'Zamestnanie',
// Misc.
	'select_language' => 'Vıber jazyka',
	'edit_profile_success' => 'Profil aktualizovanı úspešne',
	'update_pass_info' => 'Nechajte pole pre heslo prázdne, ako ho nechcete zmeni',
// Error messages
	'invalid_password' => 'Prosím, vlote heslo pozostávajúce iba z písmen a èíslic, dlhé od 4 do 16 znakov !',
	'password_is_username' => 'Heslo musí by odlišné od uívate¾ského mena !',
	'password_not_match' =>'Vloené heslo nezodpovedá heslu v èasti \'potvrï heslo\'',
	'invalid_email' => 'Musíte zada platnú emailovú adresu !',
	'email_exists' => 'Inı uívate¾ s touto adresou je u registrovanı. Prosím, vlote inı email !',
	'no_email' => 'Musíte zada emailovú adresu !',
	'invalid_email' => 'Musíte zada platnú emailovú adresu !',
	'no_password' => 'Musíte zada heslo pre tento novı úèet !'
);

// ======================================================
// register.php
// ======================================================

if (defined('USER_REGISTRATION_PHP')) 

$lang_user_registration_data = array(
	'section_title' => 'Registrácia uívate¾a',
// Step 1: Terms & Conditions
	'terms_caption' => 'Podmienky',
	'terms_intro' => 'Pre pokraèovanie musíte súhlasi s nasledovnım:',
	'terms_message' => 'Prosím, preèítajte si tieto pravidlá znázornené dolu. Ak súhlasíte s nimi a chcete pokraèova v registrácii, jednoducho kliknite na tlaèítko "Súhlasím" dolu. Pre ukonèenie registrácie bez dokonèenia, kliknite na  \'spä\' tlaèítko na vašom prehliadaèi.<br /><br />Prosíme, majte na pamäti, e nezodpovedáme za akúko¾vek udalos, zadanú uívate¾mi tohoto kalendára. Neruèíme za obsah, presnos, úplnos a pouite¾nos akejko¾vek udalosti zadanej uívate¾mi.<br /><br />Oznamy vyjadrujú poh¾ad autora udalosti. Ak niektorı uívate¾ zistí neobjektívnos alebo nesprávnos akejko¾vek zadanej udalosti, prosíme ho o zaslanie takejto informácie na našu adresu. Máme monos odstráni takıto záznam. <br /><br />Súhlasíte pri pouívaní tejto sluby, e nebudete pouíva túto aplikáciu na zneuívanie, zasielanie nesprávnych, nepresnıch informácií, nebudete pouíva vulgarizmy, uráky, neslušné, urálivé, rasistické, hanlivé vırazy .<br /><br />Súhlasíte, e nebudete zverejòova informácie, na ktoré nie ste oprávnenı z h¾adiska autorskıch práv  %s.',
	'terms_button' => 'Súhlasím',
	
// Account Info
	'account_info_label' => 'Informácie o úète',
	'user_name' => 'Uívate¾ské meno',
	'user_pass' => 'Heslo',
	'user_pass_confirm' => 'Potvrï heslo',
	'user_email' => 'E-mailová adresa',
// Other Details
	'other_details_label' => 'Ïalšie detaily',
	'first_name' => 'Meno',
	'last_name' => 'Priezvisko',
	'full_name' => 'Celé meno',
	'user_website' => 'Domová stránka',
	'user_location' => 'Lokalita',
	'user_occupation' => 'Zamestnanie',
	'register_button' => 'Vykonaj moju registráciu',

// Stats
	'stats_string1' => '<strong>%d</strong> uívate¾ov',
	'stats_string2' => '<strong>%d</strong> uívate¾ov na <strong>%d</strong> strane(ách)',
// Misc.
	'reg_nomail_success' => 'Ïakujeme za registráciu.',
	'reg_mail_success' => 'Na vami zadanú emailovú adresu bol zaslanı aktivaènı email s pokynmi, ako aktivova váš úèet.',
	'reg_activation_success' => 'Gratulujeme! Váš úèet je teraz aktívny a môete sa prihlási . Ïakujeme za registráciug.',
// Mail messages
	'reg_confirm_subject' => 'Registrácia %s',
	
// Error messages
	'no_username' => 'Musíte zada uívate¾ské meno !',
	'invalid_username' => 'Zadajte uívate¾ské meno ktoré pozostáva iba z písmen a èíslic, dlhé od 4 do 16 znakov !',
	'username_exists' => 'Uívate¾ské meno je u pouité. Zvo¾te iné !',
	'no_password' => 'Musíte zada heslo !',
	'invalid_password' => 'Prosím, vlote heslo pozostávajúce iba z písmen a èíslic, dlhé od 4 do 16 znakov !',
	'password_is_username' => 'Heslo musí by odlišné od uívate¾ského mena !',
	'password_not_match' =>'Vloené heslo nezodpovedá heslu v èasti \'potvrï heslo\'',
	'no_email' => 'Musíte zada platnú emailovú adresu !',
	'invalid_email' => 'Musíte zada platnú emailovú adresu !',
	'email_exists' => 'Inı uívate¾ s touto adresou je u registrovanı. Prosím, vlote inı email !',
	'delete_user_failed' => 'Tento úèet nemôe by vymazanı',
	'no_users' => 'Nie je iadny uívate¾skı úèet pre zobrazenie !',
	'already_logged' => 'U ste prihlásenı ako èlen !',
	'registration_not_allowed' => 'Registrácia uívate¾ov je momentálne nefunkèná !',
	'reg_email_failed' => 'Poèas posielania aktivaèného emailu sa vyskytla chyba !',
	'reg_activation_failed' => 'Poèas pokusu aktivova úèet sa vyskytla chyba !'

);
// Message body for email activation
$lang_user_registration_data['reg_confirm_body'] = <<<EOT
Thank you for registering at {CALENDAR_NAME}

Vaše uívate¾ské  meno je : "{USERNAME}"
Vaše heslo je : "{PASSWORD}"

Pre aktiváciu vášho úètu je potrebné kliknú na odkaz dolu
or skopírova and a vloi do vášho prehliadaèa.

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
	'section_title' => 'Administrácia udalostí',
	'events_to_approve' => 'Administrácia udalostí: Udalosti na schválenie',
	'upcoming_events' => 'Administrácia udalostí: Najblišie udalosti',
	'past_events' => 'Administrácia udalostí: Uplynulé udalosti',
	'add_event' => 'Pridaj novú udalos',
	'edit_event' => 'Edituj udalos',
	'view_event' => 'Pozri udalos',
	'approve_event' => 'Schváli udalos',
	'update_event' => 'Aktualizuj Info o udalosti',
	'delete_event' => 'Vyma udalos',
	'events_label' => 'Udalosti',
	'auto_approve' => 'Automatické schválenie',
	'date_label' => 'Dátum',
	'actions_label' => 'Akcie',
	'events_filter_label' => 'Filter udalosti',
	'events_filter_options' => array('Zobraz všetky udalosti','Zobraz iba neschválené udalosti','Zobraz iba najblišie udalosti','Zobraz iba uplynulé udalosti'),
	'picture_attached' => 'Pripojenı obrázok',
// View Event
	'view_event_name' => 'Udalos: \'%s\'',
	'event_start_date' => 'Dátum',
	'event_end_date' => 'A do',
	'event_duration' => 'Trvanie',
	'contact_info' => 'Kontact Info',
	'contact_email' => 'Email',
	'contact_url' => 'URL',
// General Info
// Event form
	'edit_event_title' => 'Udalos: \'%s\'',
	'cat_name' => 'Kategória',
	'event_start_date' => 'Dátum',
	'event_end_date' => 'A do',
	'contact_info' => 'Kontact Info',
	'contact_email' => 'Email',
	'contact_url' => 'URL',
	'no_event' => 'Neexistujú iadne udalosti na zobrazenie.',
	'stats_string' => '<strong>%d</strong> Udalostí celkom',
// Stats
	'stats_string1' => '<strong>%d</strong> Udalos(ti)',
	'stats_string2' => 'Celkom: <strong>%d</strong> udalostí na <strong>%d</strong> strane(ách)',
// Misc.
	'add_event_success' => 'Nová udalos úspešne pridaná',
	'edit_event_success' => 'Aktualizácia udalosti úspešná',
	'approve_event_success' => 'Udalos úspešne schválená',
	'delete_confirm' => 'Ste si istı, e chcete vymaza túto udalos ?',
	'delete_event_success' => 'Udalos úspešne vymazaná',
	'active_label' => 'Aktívne',
	'not_active_label' => 'Neaktívne',
// Error messages
	'no_event_name' => 'Musíte zada názov udalosti !',
	'no_event_desc' => 'Musíte zada popis udalosti',
	'no_cat' => 'Musíte vybra kategóriu pre túto udalos !',
	'no_day' => 'Musíte zvoli deò !',
	'no_month' => 'Musíte zvoli mesiac !',
	'no_year' => ' Musíte zvoli rok !',
	'non_valid_date' => 'Prosím, vlote platnı dátum !',
	'end_days_invalid' => 'Prosím uistite sa, e pole \'Dni\' pod \'Trvanie\' pozostáva iba z èíslic !',
	'end_hours_invalid' => 'Prosím uistite sa, e pole \'Hodiny\' pod \'Trvanie\' pozostáva iba z èíslic !',
	'end_minutes_invalid' => 'Prosím uistite sa, e pole \'Minúty\' pod \'Trvanie\' pozostáva iba z èíslic !',	
'delete_event_failed' => 'Táto udalos nemôe by vymazaná',
	'approve_event_failed' => 'Táto udalos nemôe by schválená',

	'no_events' => 'Neexistujú iadne udalosti na zobrazenie !',
	'recur_val_1_invalid' => 'Hodnota vloená ako \'interval opakovania\' je neplatná. Hodnota musí by väèšia ako  \'0\' !',
	'recur_end_count_invalid' => 'Hodnota vloená ako \'poèet vıskytov\' je neplatná. Hodnota musí by väèšia ako \'0\' !',
	'recur_end_until_invalid' => 'Hodnota dátumu \'opakuj pokia¾\' musí by väèšia ako dátum zaèiatku !'

);

// ======================================================
// admin_categories.php
// ======================================================

if (defined('ADMIN_CATS_PHP')) 

$lang_cat_admin_data = array(
	'section_title' => 'Administrácia kategórií',
	'add_cat' => 'Pridaj novú kategóriu',
	'edit_cat' => 'Edituj kategóriu',
	'update_cat' => 'Update Info kategórie',
	'delete_cat' => 'Vymazanie kategórie',
	'events_label' => 'Udalosti',
	'visibility' => 'Vidite¾nos',
	'actions_label' => 'Akcie',
	'users_label' => 'Uívatelia',
	'admins_label' => 'Administrátori',
// General Info
	'general_info_label' => 'Všeobecné informácie',
	'cat_name' => 'Názov kategórie',
	'cat_desc' => 'Popis kategórie',
	'cat_color' => 'Farba',
	'pick_color' => 'Vyber farbu!',
	'status_label' => 'Stav',
// Stats
	'stats_string1' => '<strong>%d</strong> kategórií',
	'stats_string2' => 'Aktívne: <strong>%d</strong>&nbsp;&nbsp;&nbsp;Celkom: <strong>%d</strong>&nbsp;&nbsp;&nbsp;na <strong>%d</strong> strane(ách)',
// Misc.
	'add_cat_success' => 'Nová kategória úspešne pridaná',
	'edit_cat_success' => 'Kategória úspešne aktualizovaná',
	'delete_confirm' => 'Ste si istı, e chcete vymaza túto kategóriu ?',
	'delete_cat_success' => 'Kategória úspešne vymazaná',
	'active_label' => 'Aktívne',
	'not_active_label' => 'Neaktívne',
// Error messages
	'no_cat_name' => 'Musíte zada názov tejto kategórie !',
	'no_cat_desc' => 'Musíte zada popis tejto kategórie !',
	'no_color' => 'Musíte zada farbu tejto kategórie !',
	'delete_cat_failed' => 'Táto kategória nemôe by vymazaná',
	'no_cats' => 'Nie sú iadne kategórie pre zobrauenie !',
	'cat_has_events' => 'Táto kategória obsahuje %d udalostí a preto nemôe by vymazaná!<br>Prosím, vymate najprv udalosti v tejto kategórii a skúste opä!'

);
// ======================================================
// admin_users.php
// ======================================================

if (defined('ADMIN_USERS_PHP')) 

$lang_user_admin_data = array(
	'section_title' => 'Administrácia uívate¾ov',
	'add_user' => 'Pridaj nového uívate¾a',
	'edit_user' => 'Edituj Info o uívate¾ovi',
	'update_user' => 'Aktualizuj Info o uívate¾ovi',
	'delete_user' => 'Vyma uívate¾skı úèet',
	'last_access' => 'Poslednı prístup',
	'actions_label' => 'Akcie',
	'active_label' => 'Aktívne',
	'not_active_label' => 'Neaktívne',
// Account Info
	'account_info_label' => 'Informácia o úète',
	'user_name' => 'Uívate¾ské meno',
	'user_pass' => 'Heslo',
	'user_pass_confirm' => 'Potvrï heslo',
	'user_email' => 'E-mailová adresa',
	'group_label' => 'Skupina èlenov',
	'status_label' => 'Stav úètu',
// Other Details

  'other_details_label' => 'Ïalšie detaily',
	'first_name' => 'Meno',
	'last_name' => 'Priezvisko',
	'full_name' => 'Celé meno',
	'user_website' => 'Domová stránka',
	'user_location' => 'Lokalita',
	'user_occupation' => 'Zamestnanie',
// Stats
	'stats_string1' => '<strong>%d</strong> uívate¾ov',
	'stats_string2' => '<strong>%d</strong> uívate¾ov na <strong>%d</strong> strane(ách)',
// Misc.
	'select_group' => 'Vyber jedného...',
	'add_user_success' => 'Uívatešskı úèet úspešne pridanı',
	'edit_user_success' => 'Uívatešskı úèet úspešne aktualizovanı',
	'delete_confirm' => 'Ste si istı, e chcete vymaza tento úèet ?',
	'delete_user_success' => 'Uívatešskı úèet úspešne vymazanı',
	'update_pass_info' => 'Nechajte pole pre heslo prázdne, ako ho nechcete zmeni',
	'access_never' => 'Nikdy',

	
// Error messages
	'no_username' => 'Musíte zada uívate¾ské meno !',
	'invalid_username' => 'Zadajte uívate¾ské meno ktoré pozostáva iba z písmen a èíslic, dlhé od 4 do 16 znakov !',
	'invalid_password' => 'Prosím, vlote heslo pozostávajúce iba z písmen a èíslic, dlhé od 4 do 16 znakov !',
	'password_is_username' => 'Heslo musí by odlišné od uívate¾ského mena !',
	'password_not_match' =>'Vloené heslo nezodpovedá heslu v èasti \'potvrï heslo\'',
	'invalid_email' => 'You must provide a valid email address !',
	'email_exists' => 'Inı uívate¾ s touto adresou je u registrovanı. Prosím, vlote inı email !',
  'username_exists' => 'Uívate¾ské meno je u pouité. Zvo¾te iné !',
	'no_email' => 'Musíte zada platnú emailovú adresu !',
	'invalid_email' => 'Musíte zada platnú emailovú adresu !',
  'no_password' => 'Musíte zada heslo !',
	'no_group' => 'Prosím, vyberte skupinu èlenov pre tohoto uívate¾a !',
	'delete_user_failed' => 'Tento úèet nemôe by vymazanı',
	'no_users' => 'Nie je iadny uívate¾skı úèet pre zobrazenie !',

);

// ======================================================
// admin_groups.php
// ======================================================

if (defined('ADMIN_GROUPS_PHP')) 

$lang_group_admin_data = array(
	'section_title' => 'Administrácia skupín',
	'add_group' => 'Pridaj novú skupinu',
	'edit_group' => 'Edituj skupinu',
	'update_group' => 'Aktualizuj Info o skupine',
	'delete_group' => 'Vyma skupinu',
	'view_group' => 'Zobraz skupinu',
	'users_label' => 'Èlenovia',
	'actions_label' => 'Akcie',
// General Info
	'general_info_label' => 'Všeobecné informácie',
	'group_name' => 'Názov skupiny',
	'group_desc' => 'Popis skupiny',
// Group Access Level
	'access_level_label' => 'Úroveò prístupovıch práv skupiny',
	'Administrator' => 'Uívatelia tejto skupiny majú administrátorskı prístup',
	'can_manage_accounts' => 'Uívatelia tejto skupiny môu riadi úèty',
	'can_change_settings' => 'Uívatelia tejto skupiny môu meni nastavenie kalendára',
	'can_manage_cats' => 'Uívatelia tejto skupiny môu riadi kategórie',
	'upl_need_approval' => 'Pridané udalosti vyadujú schválenie administrátora',
// Stats
	'stats_string1' => '<strong>%d</strong> skupiny',
	'stats_string2' => 'Celkom: <strong>%d</strong> skupín na <strong>%d</strong> strane(ách)',
	'stats_string3' => 'Celkom: <strong>%d</strong> uívate¾ov na <strong>%d</strong> strane(ách)',
// View Group Members
	'group_members_string' => 'Èlen \'%s\' skupiny',
	'username_label' => 'Uívate¾ské meno',
	'firstname_label' => 'Meno',
	'lastname_label' => 'Priezvisko',
	'email_label' => 'Email',
	'last_access_label' => 'Poslednı prístup',
	'edit_user' => 'Edituj uívate¾a',
	'delete_user' => 'Vyma uívate¾a',
// Misc.
	'add_group_success' => 'Nová skupina úspešne pridaná',
	'edit_group_success' => 'Skupina úspešne aktualizovaná',
	'delete_confirm' => 'Ste si istı, e chcete vymaza túto skupinu ?',
	'delete_user_confirm' => 'Ste si istı, e chcete vymaza túto skupinu  ?',
	'delete_group_success' => 'Skupina  vymazaná',
	'no_users_string' => 'iadni uívatelia pod touto skupinou',
// Error messages
	'no_group_name' => 'Musíte zada názov tejto skupiny !',
	'no_group_desc' => 'Musíte zada popis tejto skupiny !',
	'delete_group_failed' => 'Táto skupina nemôe by vymazanád',
	'no_groups' => 'iadne skupiny pre zobrazenie !',
	'group_has_users' => 'Táto skupina obsahuje %d uívate¾ova preto nemôe by vymazaná !<br>Odpojte zostávajúcich uívate¾ov z tejto skupiony a skúste opä !'

);

// ======================================================
// admin_settings.php / admin_settings_template.php / 
// admin_settings_updates.php
// ======================================================

$lang_settings_data = array(
	'section_title' => 'Nastavenie kalendára'
// Links
	,'admin_links_text' => 'Vyber sekciu'
	,'admin_links' => array('Hlavné nastavenia','Konfigurácia šablóny','Product Updates')
// General Settings
	,'general_settings_label' => 'Všeobecné'
	,'calendar_name' => 'Názov kalendára'
	,'calendar_description' => 'Popis kalendára'
	,'calendar_admin_email' => 'Email pre administráciu kalendára'
	,'cookie_name' => 'Názov cookie pouívaného skriptom '
	,'cookie_path' => 'Cesta cookie pouívaného skriptom'
	,'debug_mode' => 'Reim ladenia chıb zapnutı'
	,'calendar_status' => 'Stav publikovania kalendára '
// Environment Settings
	,'env_settings_label' => 'Prostredie'
	,'lang' => 'Jazyk'
		,'lang_name' => 'Jazyk'
		,'lang_native_name' => 'Národnos'
		,'lang_trans_date' => 'Preloil'
		,'lang_author_name' => 'Autor'
		,'lang_author_email' => 'E-mail'
		,'lang_author_url' => 'Website'
	,'charset' => 'Kódovanie znakov'
	,'theme' => 'Motív'
		,'theme_name' => 'Názov motívu'
		,'theme_date_made' => 'Vyrobené'
		,'theme_author_name' => 'Autor'
		,'theme_author_email' => 'E-mail'
		,'theme_author_url' => 'Website'
	,'timezone' => 'Odchılka èasovej zóny'
	,'time_format' => 'Formát dátumu'
		,'24hours' => '24 Hodín'
		,'12hours' => '12 Hodín'
	,'auto_daylight_saving' => 'Automatické prispôsobenie pre dennı reim (DST)'
	,'main_table_width' => 'Šírka hlavnej tabu¾ky (Pixely alebo %)'
	,'day_start' => 'Tıdeò zaèína'
	,'default_view' => 'Štandardné zobrazenie'
	,'search_view' => 'Povo¾ h¾adanie'
	,'archive' => 'Zobraz uplynulé udalosti'
	,'events_per_page' => 'Poèet udalostí na strane'
	,'sort_order' => 'Poradie zoraïovania štandardné'
		,'sort_order_title_a' => 'Názov vzostupnı'
		,'sort_order_title_d' => 'Názov zostupnı'
		,'sort_order_date_a' => 'Dátum vzostupnı'
		,'sort_order_date_d' => 'Dátum zostupnı'
	,'show_recurrent_events' => 'Zobraz pravidelné udalosti'
	,'multi_day_events' => 'Viacdenné udalosti'
		,'multi_day_events_all' => 'Zobraz rozsah úplného dátumu'
		,'multi_day_events_bounds' => 'Zobraz iba poèiatoènı a koncovı dátum'
		,'multi_day_events_start' => 'Zobraz iba poèiatoènı dátum'
	// User Settings
	,'user_settings_label' => 'Uívate¾ské nastavenie'
	,'allow_user_registration' => 'Povo¾ registráciu uívate¾ov'
	,'reg_duplicate_emails' => 'Povo¾ duplicitnı email'
	,'reg_email_verify' => 'Povo¾ aktiváciu úètu cez email'
// Event View
	,'event_view_label' => 'Zobraz udalos'
	,'popup_event_mode' => 'Prekrytie udalosti'
	,'popup_event_width' => 'Šírka Pop-up okna'
	,'popup_event_height' => 'Vıška Pop-up okna'
// Add Event View
	,'add_event_view_label' => 'Pridaj udalos'
	,'add_event_view' => 'Povolené'
	,'addevent_allow_html' => 'Povo¾ <b>HTML</b> v popise'
	,'addevent_allow_contact' => 'Povo¾ kontakt'
	,'addevent_allow_email' => 'Povo¾ Email'
	,'addevent_allow_url' => 'Povo¾ URL'
	,'addevent_allow_picture' => 'Povo¾ obrázky'
	,'new_post_notification' => 'Pošli mi Email ak udalos treba schváli'
// Calendar View
	,'calendar_view_label' => 'Mesaènı náh¾ad'
	,'monthly_view' => 'Povolené'
	,'cal_view_show_week' => 'Zobraz poèet tıdòov'
	,'cal_view_max_chars' => 'Maximálny poèet znakov v popise'
// Flyer View
	,'flyer_view_label' => 'Letmı náh¾ad'
	,'flyer_view' => 'Povolené'
	,'flyer_show_picture' => 'Zobraz obrázok v letmom poh¾ade'
	,'flyer_view_max_chars' => 'Maximálny poèet znakov v popise'
// Weekly View
	,'weekly_view_label' => 'Tıdennı náh¾ad'
	,'weekly_view' => 'Povolené'
	,'weekly_view_max_chars' => 'Maximálny poèet znakov v popise'
// Daily View
	,'daily_view_label' => 'Dennı náh¾ad'
	,'daily_view' => 'Povolené'
	,'daily_view_max_chars' => 'Maximálny poèet znakov v popisen'
// Categories View
	,'categories_view_label' => 'Zobrazenie kategórií'
	,'cats_view' => 'Povolené'
	,'cats_view_max_chars' => 'Maximálny poèet znakov v popise'
// Mini Calendar
	,'mini_cal_label' => 'Mini Kalendár'
	,'mini_cal_def_picture' => 'Štandardnı obrázok'
	,'mini_cal_display_picture' => 'Obrázok displeja'
	,'mini_cal_diplay_options' => array('iadny','Štandardnı obrázok', 'Dennı obrázok','Tıdennı obrázok','Náhodnı obrázok')
// Mail Settings
	,'mail_settings_label' => 'Nastavenie E-mailu'
	,'mail_method' => 'Spôsob zaslania E-mailu'
	,'mail_smtp_host' => 'SMTP Hosts (oddelené bodkoèiarkou ;)'
	,'mail_smtp_auth' => ' SMTP Authentication'
	,'mail_smtp_username' => 'SMTP Username'
	,'mail_smtp_password' => 'SMTP Password'

// Form Buttons
	,'update_config' => 'Ulo novú konfiguráciu'
	,'restore_config' => 'Obnov pôvodné nastavenie'
// Misc.
	,'update_settings_success' => 'Nastavenie úspešne aktualizované'
	,'restore_default_confirm' => 'Ste si istı, e chcete obnovi pôvodné nastavenie ?'
// Template Configuration
	,'template_type' => 'Druh šablóny'
	,'template_header' => 'Úprava hlavièky'
	,'template_footer' => 'Úprava päty'
	,'template_status_default' => 'Poui štandardnı motív šablóny'
	,'template_status_custom' => 'Poui nasledovnú šablónu:'
	,'template_custom' => 'Vlastná šablóna'

	,'info_meta' => 'Meta Information'
	,'info_status' => 'Status control'
	,'info_status_default' => 'Zablokuj tento obsah'
	,'info_status_custom' => 'Zobraz nasledovnı obsah:'
	,'info_custom' => 'Vlastnı obsah'

	,'dynamic_tags' => 'Dynamic Tags'

// Product Updates
	,'updates_check_text' => 'Prosíme, poèkajte kım obnovíme informácie zo serveru...'
	,'updates_no_response' => 'Serer neodpovedá. Prosíme, skúste neskôr.'
	,'avail_updates' => 'Aktualizácie dostupné'
	,'updates_download_zip' => 'Stiahni ZIP balík (.zip)'
	,'updates_download_tgz' => 'Stiahni TGZ balík (.tar.gz)'
	,'updates_released_label' => 'Dátum vydania: %s'
	,'updates_no_update' => 'Máte aktuálnu verziu. Nie je potrebná aktualizácia.'
);

// ======================================================
// cal_mini.inc.php
// ======================================================

$lang_mini_cal = array(
	'def_pic' => 'Aktuálny obrázok'
	,'daily_pic' => 'Obrázok dòa (%s)'
	,'weekly_pic' => 'Obrázok tıdòa (%s)'
	,'rand_pic' => 'Náhodnı obrázok (%s)'
	,'post_event' => 'Pridaj novú udalos'
	,'num_events' => '%d Udalos(ti)'
	,'selected_week' => 'Tıdeò %d'
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
	'section_title' => 'Prihlásenie'
// General Settings
	,'login_intro' => 'Vlote uívate¾ské meno a heslo pre prihlásenie'
	,'username' => 'Username'
	,'password' => 'Password'
	,'remember_me' => 'Zapamäta'
	,'login_button' => 'Prihlás'
// Errors
	,'invalid_login' => 'Prosíme, skontrolujte prihlasovacie údaje a skúste znovu!'
	,'no_username' => 'Musíte zada uívate¾ské meno !'
	,'already_logged' => 'U ste prihlásenı !'
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


DEFINE('_EXTCAL_THEMES_INSTALL_HEADING', 'JCal Pro Themes Manager');

//Common
DEFINE('_EXTCAL_VERSION', 'Verzia');
DEFINE('_EXTCAL_DATE', 'Dátum');
DEFINE('_EXTCAL_AUTHOR', 'Autor');
DEFINE('_EXTCAL_AUTHOR_EMAIL', 'Autorov E-Mail');
DEFINE('_EXTCAL_AUTHOR_URL', 'Authorova URL');
DEFINE('_EXTCAL_PUBLISHED', 'Publikované');

//Plugins
DEFINE('_EXTCAL_THEME_PLUGIN', 'Motív');
DEFINE('_EXTCAL_THEME_PLUGCOM', 'Motív/Príkaz');
DEFINE('_EXTCAL_THEME_NAME', 'Meno');
DEFINE('_EXTCAL_THEME_HEADING', 'JCal Pro Themes Manager');
DEFINE('_EXTCAL_THEME_FILTER', 'Filter');
DEFINE('_EXTCAL_THEME_ACCESS_LIST', 'Zoznam prístupov');
DEFINE('_EXTCAL_THEME_ACCESS_LVL', 'Prístupová úroveò');
DEFINE('_EXTCAL_THEME_CORE', 'Jadro');
DEFINE('_EXTCAL_THEME_DEFAULT', 'Štandardné');
DEFINE('_EXTCAL_THEME_ORDER', 'Poradie');
DEFINE('_EXTCAL_THEME_ROW', 'Riadok');
DEFINE('_EXTCAL_THEME_TYPE', 'Typ');
DEFINE('_EXTCAL_THEME_ICON', 'Ikona');
DEFINE('_EXTCAL_THEME_LAYOUT_ICON', 'Layout Icon');
DEFINE('_EXTCAL_THEME_DESC', 'Popis');
DEFINE('_EXTCAL_THEME_EDIT', 'Edituj');
DEFINE('_EXTCAL_THEME_NEW', 'Novı');
DEFINE('_EXTCAL_THEME_DETAILS', 'Plugin Details');
DEFINE('_EXTCAL_THEME_PARAMS', 'Parametre');
DEFINE('_EXTCAL_THEME_ELMS', 'Elementy');
//Plugin Installer
DEFINE('_EXTCAL_THEMES_INSTALL_HEADING','Inštaluj novú šablónu');
DEFINE('_EXTCAL_THEMES_INSTALL_MSG', 'Iba tie šablóny, ktoré môu by odinštalované sú zobrazené - Hlavná šablóna nemôe by odstránená.');
DEFINE('_EXTCAL_THEME_NONE', 'Nie sú nainštalované iadne doplnkové šablóny');

//Language Manager
DEFINE('_EXTCAL_LANG_HEADING', 'EXTCAL Language Manager');
DEFINE('_EXTCAL_LANG_LANG', 'Jazyk');

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
?>
