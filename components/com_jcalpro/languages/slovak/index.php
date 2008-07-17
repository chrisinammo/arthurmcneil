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
	'yes' => '�no'
	,'no' => 'Nie'
	,'back' => 'Sp�'
	,'continue' => 'Pokra�uj'
	,'close' => 'Zatvor'
	,'errors' => 'Chyba'
	,'info' => 'Inform�cie'
	,'day' => 'De�'
	,'days' => 'Dn�'
	,'month' => 'Mesiac'
	,'months' => 'Mesiacov'
	,'year' => 'Rok'
	,'years' => 'Rokov'
	,'hour' => 'Hodina'
	,'hours' => 'Hod�n'
	,'minute' => 'Min�ta'
	,'minutes' => 'Min�t'
	,'everyday' => 'Ka�d� de�'
	,'everymonth' => 'Ka�d� mesiac'
	,'everyyear' => 'Ka�d� Rok'
	,'active' => 'Akt�vny'
	,'not_active' => 'Neakt�vny'
	,'today' => 'Dnes'
	,'signature' => 'Vytvoril %s'
	,'expand' => 'Roz��ri�'
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
	,'day_of_week' => array('Nede�a','Pondelok','Utorok','Streda','�tvrtok','Piatok','Sobota')
	,'months' => array('Janu�r','Febru�r','Marec','Apr�l','M�j','J�n','J�l','August','September','Okt�ber','November','December')
);

$lang_system = array (
	'system_caption' => 'Syst�mov� hl�senie'
  ,'page_access_denied' => 'Nem�te potrebn� opr�vnenia pre pr�stup k tejto vo�be.'
  ,'page_requires_login' => 'Mus�te by� prihl�sen�.'
  ,'operation_denied' => 'Nem�te potrebn� opr�vnenia pre vykonanie tejto oper�cie.'
	,'section_disabled' => 'T�to oblas� je moment�lne zablokovan�!'
  ,'non_exist_cat' => 'Zvolen� kateg�ria neexistuje!'
  ,'non_exist_event' => 'Zvolen� udalos� neexistuje !'
  ,'param_missing' => 'Zadan� parametre s� nespr�vne.'
  ,'no_events' => 'Nie s� �iadne udalosti pre zobrazenie'
  ,'config_string' => 'Pr�ve pou��vate \'%s\' prebieha %s, %s a %s.'
  ,'no_table' => 'T�to \'%s\' tabu�ka neexistuje!'
  ,'no_anonymous_group' => 'T�to %s tabu�ka neobsahuje \'Anonymous\' skupinu !'
  ,'calendar_locked' => 'T�to slu�ba je do�asne mimo prev�dzky kv�li �dr�be a upgradu. Ospravedl�ujeme sa !'
	,'new_upgrade' => 'System detekoval nov� verziu. Doporu�ujeme vykona� update. Klikni "Pokra�ova�" pre spustenie upgradu.'
	,'no_profile' => 'Pri vyvolan� v�ho profilu sa vyskytla chyba'
	,'unknown_component' => 'Nezn�my komponent'
// Mail messages
	,'new_event_subject' => 'Udalos� vy�aduje schv�lenie  %s'
	,'event_notification_failed' => 'Po�as odosielania notifika�n�ho E-mailu sa vyskytla chyba !'
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
	'login' => 'Prihl�senie'
	,'register' => 'Registr�cia'
  ,'logout' => 'Logout <span style="color:#FF9922">[<span style="color:#606F79">%s</span>]</span>'
  ,'user_profile' => 'M�j  Profil'
	,'admin_events' => 'Udalosti'
  ,'admin_categories' => 'Kateg�rie'
  ,'admin_groups' => 'Skupiny'
  ,'admin_users' => 'U��vatelia'
  ,'admin_settings' => 'Nastavenie'
);

// Main menu entries
$lang_main_menu = array (
	'add_event' => 'Pridaj udalos�'
	,'cal_view' => 'Mesa�n� n�h�ad'
  ,'flat_view' => 'Roz��ren� n�h�ad'
  ,'weekly_view' => 'T��denn� n�h�ad'
  ,'daily_view' => 'Denn� n�h�ad'
  ,'yearly_view' => 'Ro�n� n�h�ad'
  ,'categories_view' => 'Kateg�rie'
  ,'search_view' => 'H�adaj'
);

// ======================================================
// Add Event view
// ======================================================

$lang_add_event_view = array(
	'section_title' => 'Pridaj udalos�'
	,'edit_event' => 'Edituj udalos� [id%d] \'%s\''
	,'update_event_button' => 'Aktualizuj udalos�'

// Event details
	,'event_details_label' => 'Podrobnosti o udalosti'
	,'event_title' => 'N�zov udalosti'
	,'event_desc' => 'Popis udalosti'
	,'event_cat' => 'Kateg�ria'
	,'choose_cat' => 'Vyber kateg�riu'
	,'event_date' => 'D�tum udalosti'
	,'day_label' => 'De�'
	,'month_label' => 'Mesiac'
	,'year_label' => 'Rok'
	,'start_date_label' => '�as za�iatku'
	,'start_time_label' => 'O'
	,'end_date_label' => 'Trvanie'
	,'all_day_label' => 'Cel� de�'
// Contact details
	,'contact_details_label' => 'Detaily kontaktu'
	,'contact_info' => 'Info o kontakte'
	,'contact_email' => 'Email'
	,'contact_url' => 'URL'
// Repeat events
	,'repeat_event_label' => 'Opakuj udalos�'
	,'repeat_method_label' => 'Sp�sob opakovania'
	,'repeat_none' => 'Neopakuj t�to udalos�t'
	,'repeat_every' => 'Opakuj ka�d�ch'
	,'repeat_days' => 'Dn�'
	,'repeat_weeks' => 'T��d�ov'
	,'repeat_months' => 'Mesiacov'
	,'repeat_years' => 'Rokov'
	,'repeat_end_date_label' => 'Opakuj koncov� d�tum'
	,'repeat_end_date_none' => 'Bez d�tumu ukon�enia'
	,'repeat_end_date_count' => 'Koniec po %s v�skytoch'
	,'repeat_end_date_until' => 'Opakuj dokia�'
// Other details
	,'other_details_label' => '�al�ie detaily'
	,'picture_file' => 'S�bor obr�zku'
	,'file_upload_info' => '(%d KBytes limit - Valid extensions : %s )' 
	,'del_picture' => 'Vymaza� aktu�lny obr�zok ?'
// Administrative options
	,'admin_options_label' => 'Mo�nosti administr�tora'
	,'auto_appr_event' => 'Udalos� schv�len�'

// Error messages
	,'no_title' => 'Mus�te zada� n�zov udalosti !'
	,'no_desc' => 'Mus�te zada� popis udalosti !'
	,'no_cat' => 'Mus�te vybra� kateg�riu z menu !'
	,'date_invalid' => 'Mus�te zada� platn� d�tum udalosti !'
	,'end_days_invalid' => 'Hodnota zadan� v poli\'Dni\' je nespr�vna !'
	,'end_hours_invalid' => 'Hodnota zadan� v poli\'Hodiny\' je nespr�vna  !'
	,'end_minutes_invalid' => 'Hodnota zadan� v poli\'Min�ty\' je nespr�vna  !'
	,'move_image_failed' => 'Syst�mov� chyba pri nahr�van� obr�zku. Zvo�te vhodn� typ a ve�kos�, alebo kontaktujte administr�tora.'
	,'non_valid_dimensions' => '��rka a v��ka obr�zku je v��ie ako %s pixelov !'

	,'recur_val_1_invalid' => 'Hodnota vlo�en� ako \'interval opakovania\' je neplatn�. Hodnota mus� by� v��ia ako  \'0\' !'
	,'recur_end_count_invalid' => 'Hodnota vlo�en� ako \'po�et v�skytov\' je neplatn�. Hodnota mus� by� v��ia ako \'0\' !'
	,'recur_end_until_invalid' => 'Hodnota d�tumu \'opakuj pokia�\' mus� by� v��ia ako d�tum za�iatku !'
// Misc. messages
	,'submit_event_pending' => 'Va�a udalos� bola pridan�! Predsa len NEBUDE pridan� sk�r, ako ju schv�li administr�tor. �akujeme za pr�spevok!'
	,'submit_event_approved' => 'Va�a pridan� udalos� je automaticky schv�len�. �akujeme za pr�spevok!'
	,'event_repeat_msg' => 'T�to udalos� m� nastaven� opakovanie'
	,'event_no_repeat_msg' => 'T�to udalos� nem� opakovanie'
);

// ======================================================
// daily view
// ======================================================

$lang_daily_event_view = array(
	'section_title' => 'Denn� preh�ad'
	,'next_day' => '�al�� de�'
	,'previous_day' => 'Predch�dzaj�ci de�'
	,'no_events' => 'V tomto dni nie s� �iadne udalosti.'
);

// ======================================================
// weekly view
// ======================================================

$lang_weekly_event_view = array(
	'section_title' => 'T��denn� preh�ad'
	,'week_period' => '%s - %s'
	,'next_week' => '�al�� t��de�'
	,'previous_week' => 'Predch�dzaj�ci t��de�'
	,'selected_week' => 'T��de� %d'
	,'no_events' => 'V tomto t��dni nie s� �iadne udalosti'
);

// ======================================================
// monthly view
// ======================================================

$lang_monthly_event_view = array(
	'section_title' => 'Mesa�n� preh�ad'
	,'next_month' => '�al�� mesiac'
	,'previous_month' => 'Predch�dzaj�ci mesiac'
);

// ======================================================
// flat view
// ======================================================

$lang_flat_event_view = array(
	'section_title' => 'Roz��ren� n�h�ad'
	,'week_period' => '%s - %s'
	,'next_month' => '�al�� mesiac'
	,'previous_month' => 'Predch�dzaj�ci mesiac'
	,'contact_info' => 'Kontakt Info'
	,'contact_email' => 'Email'
	,'contact_url' => 'URL'
	,'no_events' => 'V tomto mesiaci nie s� �iadne udalosti'
);

// ======================================================
// Event view
// ======================================================

$lang_event_view = array(
	'section_title' => 'Preh�ad udalost�'
	,'display_event' => 'Udalos�: \'%s\''
	,'cat_name' => 'Kateg�ria'
	,'event_start_date' => 'D�tum'
	,'event_end_date' => 'A� do'
	,'event_duration' => 'Trvanie'
	,'contact_info' => 'Kontact Info'
	,'contact_email' => 'Email'
	,'contact_url' => 'URL'
	,'no_event' => 'Neexistuj� �iadne udalosti na zobrazenie.'
	,'stats_string' => '<strong>%d</strong> Udalost� celkom'
	,'edit_event' => 'Edituj udalos�'
	,'delete_event' => 'Vyma� udalos�'
	,'delete_confirm' => 'Ste si ist�, �e chcete vymaza� udalos� ?'
	
);

// ======================================================
// Categories view
// ======================================================

$lang_cats_view = array(
	'section_title' => 'Preh�ad kateg�ri�'
	,'cat_name' => 'N�zov kateg�rie'
	,'total_events' => 'Celkom udalost�'
	,'upcoming_events' => 'Najbli��ie udalosti'
	,'no_cats' => 'Neexistuj� �iadne kateg�rie na zobrazenie.'
	,'stats_string' => 'Je <strong>%d</strong> udalost� v <strong>%d</strong> Kateg�rii�ch'
);

// ======================================================
// Category Events view
// ======================================================

$lang_cat_events_view = array(
	'section_title' => 'Udalos� pod \'%s\''
	,'event_name' => 'N�zov udalosti'
	,'event_date' => 'D�tum'
	,'no_events' => 'Pod touto  kateg�riou nie s� �iadne udalosti.'
	,'stats_string' => '<strong>%d</strong> Udalost� celkom'
	,'stats_string1' => '<strong>%d</strong> Udalost� na <strong>%d</strong> strane(�ch)'
);

// ======================================================
// cal_search.php
// ======================================================

$lang_event_search_data = array(
	'section_title' => 'Preh�adaj kalend�r',
	'search_results' => 'N�jdi v�sledky',
	'category_label' => 'Kateg�ria',
	'date_label' => 'D�tum',
	'no_events' => 'Pod touto  kateg�riou nie s� �iadne udalosti.',
	'search_caption' => 'Nap� k���ov� slovo ...',
	'search_again' => 'H�adaj znovu',
	'search_button' => 'H�adaj',
// Misc.
	'no_results' => 'Bez v�sledku',	
// Stats
	'stats_string1' => '<strong>%d</strong> udalos�(ti) n�jden� (�)',
	'stats_string2' => '<strong>%d</strong> Udalosti na <strong>%d</strong> strane(�ch)'
);

// ======================================================
// profile.php
// ======================================================

if (defined('PROFILE_PHP')) 

$lang_user_profile_data = array(
	'section_title' => 'M�j Profil',
	'edit_profile' => 'Edituj m�j profil',
	'update_profile' => 'Update m�jho profilu',
	'actions_label' => 'Akcie',
// Account Info
	'account_info_label' => 'Inform�cie o ��te',
	'user_name' => 'U��vate�sk� meno',
	'user_pass' => 'Heslo',
	'user_pass_confirm' => 'Potvr� heslo',
	'user_email' => 'E-mailov� adresa',
	'group_label' => 'Skupina �lenov',
// Other Details
	'other_details_label' => '�al�ie detaily',
	'first_name' => 'Meno',
	'last_name' => 'Priezvisko',
	'full_name' => 'Cel� meno',
	'user_website' => 'Domov� str�nka',
	'user_location' => 'Lokalita',
	'user_occupation' => 'Zamestnanie',
// Misc.
	'select_language' => 'V�ber jazyka',
	'edit_profile_success' => 'Profil aktualizovan� �spe�ne',
	'update_pass_info' => 'Nechajte pole pre heslo pr�zdne, ako ho nechcete zmeni�',
// Error messages
	'invalid_password' => 'Pros�m, vlo�te heslo pozost�vaj�ce iba z p�smen a ��slic, dlh� od 4 do 16 znakov !',
	'password_is_username' => 'Heslo mus� by� odli�n� od u��vate�sk�ho mena !',
	'password_not_match' =>'Vlo�en� heslo nezodpoved� heslu v �asti \'potvr� heslo\'',
	'invalid_email' => 'Mus�te zada� platn� emailov� adresu !',
	'email_exists' => 'In� u��vate� s touto adresou je u� registrovan�. Pros�m, vlo�te in� email !',
	'no_email' => 'Mus�te zada� emailov� adresu !',
	'invalid_email' => 'Mus�te zada� platn� emailov� adresu !',
	'no_password' => 'Mus�te zada� heslo pre tento nov� ��et !'
);

// ======================================================
// register.php
// ======================================================

if (defined('USER_REGISTRATION_PHP')) 

$lang_user_registration_data = array(
	'section_title' => 'Registr�cia u��vate�a',
// Step 1: Terms & Conditions
	'terms_caption' => 'Podmienky',
	'terms_intro' => 'Pre pokra�ovanie mus�te s�hlasi� s nasledovn�m:',
	'terms_message' => 'Pros�m, pre��tajte si tieto pravidl� zn�zornen� dolu. Ak s�hlas�te s nimi a chcete pokra�ova� v registr�cii, jednoducho kliknite na tla��tko "S�hlas�m" dolu. Pre ukon�enie registr�cie bez dokon�enia, kliknite na  \'sp�\' tla��tko na va�om prehliada�i.<br /><br />Pros�me, majte na pam�ti, �e nezodpoved�me za ak�ko�vek udalos�, zadan� u��vate�mi tohoto kalend�ra. Neru��me za obsah, presnos�, �plnos� a pou�ite�nos� akejko�vek udalosti zadanej u��vate�mi.<br /><br />Oznamy vyjadruj� poh�ad autora udalosti. Ak niektor� u��vate� zist� neobjekt�vnos� alebo nespr�vnos� akejko�vek zadanej udalosti, pros�me ho o zaslanie takejto inform�cie na na�u adresu. M�me mo�nos� odstr�ni� tak�to z�znam. <br /><br />S�hlas�te pri pou��van� tejto slu�by, �e nebudete pou��va� t�to aplik�ciu na zneu��vanie, zasielanie nespr�vnych, nepresn�ch inform�ci�, nebudete pou��va� vulgarizmy, ur�ky, neslu�n�, ur�liv�, rasistick�, hanliv� v�razy .<br /><br />S�hlas�te, �e nebudete zverej�ova� inform�cie, na ktor� nie ste opr�vnen� z h�adiska autorsk�ch pr�v  %s.',
	'terms_button' => 'S�hlas�m',
	
// Account Info
	'account_info_label' => 'Inform�cie o ��te',
	'user_name' => 'U��vate�sk� meno',
	'user_pass' => 'Heslo',
	'user_pass_confirm' => 'Potvr� heslo',
	'user_email' => 'E-mailov� adresa',
// Other Details
	'other_details_label' => '�al�ie detaily',
	'first_name' => 'Meno',
	'last_name' => 'Priezvisko',
	'full_name' => 'Cel� meno',
	'user_website' => 'Domov� str�nka',
	'user_location' => 'Lokalita',
	'user_occupation' => 'Zamestnanie',
	'register_button' => 'Vykonaj moju registr�ciu',

// Stats
	'stats_string1' => '<strong>%d</strong> u��vate�ov',
	'stats_string2' => '<strong>%d</strong> u��vate�ov na <strong>%d</strong> strane(�ch)',
// Misc.
	'reg_nomail_success' => '�akujeme za registr�ciu.',
	'reg_mail_success' => 'Na vami zadan� emailov� adresu bol zaslan� aktiva�n� email s pokynmi, ako aktivova� v� ��et.',
	'reg_activation_success' => 'Gratulujeme! V� ��et je teraz akt�vny a m��ete sa prihl�si� . �akujeme za registr�ciug.',
// Mail messages
	'reg_confirm_subject' => 'Registr�cia %s',
	
// Error messages
	'no_username' => 'Mus�te zada� u��vate�sk� meno !',
	'invalid_username' => 'Zadajte u��vate�sk� meno ktor� pozost�va iba z p�smen a ��slic, dlh� od 4 do 16 znakov !',
	'username_exists' => 'U��vate�sk� meno je u� pou�it�. Zvo�te in� !',
	'no_password' => 'Mus�te zada� heslo !',
	'invalid_password' => 'Pros�m, vlo�te heslo pozost�vaj�ce iba z p�smen a ��slic, dlh� od 4 do 16 znakov !',
	'password_is_username' => 'Heslo mus� by� odli�n� od u��vate�sk�ho mena !',
	'password_not_match' =>'Vlo�en� heslo nezodpoved� heslu v �asti \'potvr� heslo\'',
	'no_email' => 'Mus�te zada� platn� emailov� adresu !',
	'invalid_email' => 'Mus�te zada� platn� emailov� adresu !',
	'email_exists' => 'In� u��vate� s touto adresou je u� registrovan�. Pros�m, vlo�te in� email !',
	'delete_user_failed' => 'Tento ��et nem��e by� vymazan�',
	'no_users' => 'Nie je �iadny u��vate�sk� ��et pre zobrazenie !',
	'already_logged' => 'U� ste prihl�sen� ako �len !',
	'registration_not_allowed' => 'Registr�cia u��vate�ov je moment�lne nefunk�n� !',
	'reg_email_failed' => 'Po�as posielania aktiva�n�ho emailu sa vyskytla chyba !',
	'reg_activation_failed' => 'Po�as pokusu aktivova� ��et sa vyskytla chyba !'

);
// Message body for email activation
$lang_user_registration_data['reg_confirm_body'] = <<<EOT
Thank you for registering at {CALENDAR_NAME}

Va�e u��vate�sk�  meno je : "{USERNAME}"
Va�e heslo je : "{PASSWORD}"

Pre aktiv�ciu v�ho ��tu je potrebn� klikn�� na odkaz dolu
or skop�rova� and a vlo�i� do v�ho prehliada�a.

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
	'section_title' => 'Administr�cia udalost�',
	'events_to_approve' => 'Administr�cia udalost�: Udalosti na schv�lenie',
	'upcoming_events' => 'Administr�cia udalost�: Najbli��ie udalosti',
	'past_events' => 'Administr�cia udalost�: Uplynul� udalosti',
	'add_event' => 'Pridaj nov� udalos�',
	'edit_event' => 'Edituj udalos�',
	'view_event' => 'Pozri udalos�',
	'approve_event' => 'Schv�li� udalos�',
	'update_event' => 'Aktualizuj Info o udalosti',
	'delete_event' => 'Vyma� udalos�',
	'events_label' => 'Udalosti',
	'auto_approve' => 'Automatick� schv�lenie',
	'date_label' => 'D�tum',
	'actions_label' => 'Akcie',
	'events_filter_label' => 'Filter udalosti',
	'events_filter_options' => array('Zobraz v�etky udalosti','Zobraz iba neschv�len� udalosti','Zobraz iba najbli��ie udalosti','Zobraz iba uplynul� udalosti'),
	'picture_attached' => 'Pripojen� obr�zok',
// View Event
	'view_event_name' => 'Udalos�: \'%s\'',
	'event_start_date' => 'D�tum',
	'event_end_date' => 'A� do',
	'event_duration' => 'Trvanie',
	'contact_info' => 'Kontact Info',
	'contact_email' => 'Email',
	'contact_url' => 'URL',
// General Info
// Event form
	'edit_event_title' => 'Udalos�: \'%s\'',
	'cat_name' => 'Kateg�ria',
	'event_start_date' => 'D�tum',
	'event_end_date' => 'A� do',
	'contact_info' => 'Kontact Info',
	'contact_email' => 'Email',
	'contact_url' => 'URL',
	'no_event' => 'Neexistuj� �iadne udalosti na zobrazenie.',
	'stats_string' => '<strong>%d</strong> Udalost� celkom',
// Stats
	'stats_string1' => '<strong>%d</strong> Udalos�(ti)',
	'stats_string2' => 'Celkom: <strong>%d</strong> udalost� na <strong>%d</strong> strane(�ch)',
// Misc.
	'add_event_success' => 'Nov� udalos� �spe�ne pridan�',
	'edit_event_success' => 'Aktualiz�cia udalosti �spe�n�',
	'approve_event_success' => 'Udalos� �spe�ne schv�len�',
	'delete_confirm' => 'Ste si ist�, �e chcete vymaza� t�to udalos� ?',
	'delete_event_success' => 'Udalos� �spe�ne vymazan�',
	'active_label' => 'Akt�vne',
	'not_active_label' => 'Neakt�vne',
// Error messages
	'no_event_name' => 'Mus�te zada� n�zov udalosti !',
	'no_event_desc' => 'Mus�te zada� popis udalosti',
	'no_cat' => 'Mus�te vybra� kateg�riu pre t�to udalos� !',
	'no_day' => 'Mus�te zvoli� de� !',
	'no_month' => 'Mus�te zvoli� mesiac !',
	'no_year' => ' Mus�te zvoli� rok !',
	'non_valid_date' => 'Pros�m, vlo�te platn� d�tum !',
	'end_days_invalid' => 'Pros�m uistite sa, �e pole \'Dni\' pod \'Trvanie\' pozost�va iba z ��slic !',
	'end_hours_invalid' => 'Pros�m uistite sa, �e pole \'Hodiny\' pod \'Trvanie\' pozost�va iba z ��slic !',
	'end_minutes_invalid' => 'Pros�m uistite sa, �e pole \'Min�ty\' pod \'Trvanie\' pozost�va iba z ��slic !',	
'delete_event_failed' => 'T�to udalos� nem��e by� vymazan�',
	'approve_event_failed' => 'T�to udalos� nem��e by� schv�len�',

	'no_events' => 'Neexistuj� �iadne udalosti na zobrazenie !',
	'recur_val_1_invalid' => 'Hodnota vlo�en� ako \'interval opakovania\' je neplatn�. Hodnota mus� by� v��ia ako  \'0\' !',
	'recur_end_count_invalid' => 'Hodnota vlo�en� ako \'po�et v�skytov\' je neplatn�. Hodnota mus� by� v��ia ako \'0\' !',
	'recur_end_until_invalid' => 'Hodnota d�tumu \'opakuj pokia�\' mus� by� v��ia ako d�tum za�iatku !'

);

// ======================================================
// admin_categories.php
// ======================================================

if (defined('ADMIN_CATS_PHP')) 

$lang_cat_admin_data = array(
	'section_title' => 'Administr�cia kateg�ri�',
	'add_cat' => 'Pridaj nov� kateg�riu',
	'edit_cat' => 'Edituj kateg�riu',
	'update_cat' => 'Update Info kateg�rie',
	'delete_cat' => 'Vymazanie kateg�rie',
	'events_label' => 'Udalosti',
	'visibility' => 'Vidite�nos�',
	'actions_label' => 'Akcie',
	'users_label' => 'U��vatelia',
	'admins_label' => 'Administr�tori',
// General Info
	'general_info_label' => 'V�eobecn� inform�cie',
	'cat_name' => 'N�zov kateg�rie',
	'cat_desc' => 'Popis kateg�rie',
	'cat_color' => 'Farba',
	'pick_color' => 'Vyber farbu!',
	'status_label' => 'Stav',
// Stats
	'stats_string1' => '<strong>%d</strong> kateg�ri�',
	'stats_string2' => 'Akt�vne: <strong>%d</strong>&nbsp;&nbsp;&nbsp;Celkom: <strong>%d</strong>&nbsp;&nbsp;&nbsp;na <strong>%d</strong> strane(�ch)',
// Misc.
	'add_cat_success' => 'Nov� kateg�ria �spe�ne pridan�',
	'edit_cat_success' => 'Kateg�ria �spe�ne aktualizovan�',
	'delete_confirm' => 'Ste si ist�, �e chcete vymaza� t�to kateg�riu ?',
	'delete_cat_success' => 'Kateg�ria �spe�ne vymazan�',
	'active_label' => 'Akt�vne',
	'not_active_label' => 'Neakt�vne',
// Error messages
	'no_cat_name' => 'Mus�te zada� n�zov tejto kateg�rie !',
	'no_cat_desc' => 'Mus�te zada� popis tejto kateg�rie !',
	'no_color' => 'Mus�te zada� farbu tejto kateg�rie !',
	'delete_cat_failed' => 'T�to kateg�ria nem��e by� vymazan�',
	'no_cats' => 'Nie s� �iadne kateg�rie pre zobrauenie !',
	'cat_has_events' => 'T�to kateg�ria obsahuje %d udalost� a preto nem��e by� vymazan�!<br>Pros�m, vyma�te najprv udalosti v tejto kateg�rii a sk�ste op�!'

);
// ======================================================
// admin_users.php
// ======================================================

if (defined('ADMIN_USERS_PHP')) 

$lang_user_admin_data = array(
	'section_title' => 'Administr�cia u��vate�ov',
	'add_user' => 'Pridaj nov�ho u��vate�a',
	'edit_user' => 'Edituj Info o u��vate�ovi',
	'update_user' => 'Aktualizuj Info o u��vate�ovi',
	'delete_user' => 'Vyma� u��vate�sk� ��et',
	'last_access' => 'Posledn� pr�stup',
	'actions_label' => 'Akcie',
	'active_label' => 'Akt�vne',
	'not_active_label' => 'Neakt�vne',
// Account Info
	'account_info_label' => 'Inform�cia o ��te',
	'user_name' => 'U��vate�sk� meno',
	'user_pass' => 'Heslo',
	'user_pass_confirm' => 'Potvr� heslo',
	'user_email' => 'E-mailov� adresa',
	'group_label' => 'Skupina �lenov',
	'status_label' => 'Stav ��tu',
// Other Details

  'other_details_label' => '�al�ie detaily',
	'first_name' => 'Meno',
	'last_name' => 'Priezvisko',
	'full_name' => 'Cel� meno',
	'user_website' => 'Domov� str�nka',
	'user_location' => 'Lokalita',
	'user_occupation' => 'Zamestnanie',
// Stats
	'stats_string1' => '<strong>%d</strong> u��vate�ov',
	'stats_string2' => '<strong>%d</strong> u��vate�ov na <strong>%d</strong> strane(�ch)',
// Misc.
	'select_group' => 'Vyber jedn�ho...',
	'add_user_success' => 'U��vate�sk� ��et �spe�ne pridan�',
	'edit_user_success' => 'U��vate�sk� ��et �spe�ne aktualizovan�',
	'delete_confirm' => 'Ste si ist�, �e chcete vymaza� tento ��et ?',
	'delete_user_success' => 'U��vate�sk� ��et �spe�ne vymazan�',
	'update_pass_info' => 'Nechajte pole pre heslo pr�zdne, ako ho nechcete zmeni�',
	'access_never' => 'Nikdy',

	
// Error messages
	'no_username' => 'Mus�te zada� u��vate�sk� meno !',
	'invalid_username' => 'Zadajte u��vate�sk� meno ktor� pozost�va iba z p�smen a ��slic, dlh� od 4 do 16 znakov !',
	'invalid_password' => 'Pros�m, vlo�te heslo pozost�vaj�ce iba z p�smen a ��slic, dlh� od 4 do 16 znakov !',
	'password_is_username' => 'Heslo mus� by� odli�n� od u��vate�sk�ho mena !',
	'password_not_match' =>'Vlo�en� heslo nezodpoved� heslu v �asti \'potvr� heslo\'',
	'invalid_email' => 'You must provide a valid email address !',
	'email_exists' => 'In� u��vate� s touto adresou je u� registrovan�. Pros�m, vlo�te in� email !',
  'username_exists' => 'U��vate�sk� meno je u� pou�it�. Zvo�te in� !',
	'no_email' => 'Mus�te zada� platn� emailov� adresu !',
	'invalid_email' => 'Mus�te zada� platn� emailov� adresu !',
  'no_password' => 'Mus�te zada� heslo !',
	'no_group' => 'Pros�m, vyberte skupinu �lenov pre tohoto u��vate�a !',
	'delete_user_failed' => 'Tento ��et nem��e by� vymazan�',
	'no_users' => 'Nie je �iadny u��vate�sk� ��et pre zobrazenie !',

);

// ======================================================
// admin_groups.php
// ======================================================

if (defined('ADMIN_GROUPS_PHP')) 

$lang_group_admin_data = array(
	'section_title' => 'Administr�cia skup�n',
	'add_group' => 'Pridaj nov� skupinu',
	'edit_group' => 'Edituj skupinu',
	'update_group' => 'Aktualizuj Info o skupine',
	'delete_group' => 'Vyma� skupinu',
	'view_group' => 'Zobraz skupinu',
	'users_label' => '�lenovia',
	'actions_label' => 'Akcie',
// General Info
	'general_info_label' => 'V�eobecn� inform�cie',
	'group_name' => 'N�zov skupiny',
	'group_desc' => 'Popis skupiny',
// Group Access Level
	'access_level_label' => '�rove� pr�stupov�ch pr�v skupiny',
	'Administrator' => 'U��vatelia tejto skupiny maj� administr�torsk� pr�stup',
	'can_manage_accounts' => 'U��vatelia tejto skupiny m��u riadi� ��ty',
	'can_change_settings' => 'U��vatelia tejto skupiny m��u meni� nastavenie kalend�ra',
	'can_manage_cats' => 'U��vatelia tejto skupiny m��u riadi� kateg�rie',
	'upl_need_approval' => 'Pridan� udalosti vy�aduj� schv�lenie administr�tora',
// Stats
	'stats_string1' => '<strong>%d</strong> skupiny',
	'stats_string2' => 'Celkom: <strong>%d</strong> skup�n na <strong>%d</strong> strane(�ch)',
	'stats_string3' => 'Celkom: <strong>%d</strong> u��vate�ov na <strong>%d</strong> strane(�ch)',
// View Group Members
	'group_members_string' => '�len \'%s\' skupiny',
	'username_label' => 'U��vate�sk� meno',
	'firstname_label' => 'Meno',
	'lastname_label' => 'Priezvisko',
	'email_label' => 'Email',
	'last_access_label' => 'Posledn� pr�stup',
	'edit_user' => 'Edituj u��vate�a',
	'delete_user' => 'Vyma� u��vate�a',
// Misc.
	'add_group_success' => 'Nov� skupina �spe�ne pridan�',
	'edit_group_success' => 'Skupina �spe�ne aktualizovan�',
	'delete_confirm' => 'Ste si ist�, �e chcete vymaza� t�to skupinu ?',
	'delete_user_confirm' => 'Ste si ist�, �e chcete vymaza� t�to skupinu  ?',
	'delete_group_success' => 'Skupina  vymazan�',
	'no_users_string' => '�iadni u��vatelia pod touto skupinou',
// Error messages
	'no_group_name' => 'Mus�te zada� n�zov tejto skupiny !',
	'no_group_desc' => 'Mus�te zada� popis tejto skupiny !',
	'delete_group_failed' => 'T�to skupina nem��e by� vymazan�d',
	'no_groups' => '�iadne skupiny pre zobrazenie !',
	'group_has_users' => 'T�to skupina obsahuje %d u��vate�ova preto nem��e by� vymazan� !<br>Odpojte zost�vaj�cich u��vate�ov z tejto skupiony a sk�ste op� !'

);

// ======================================================
// admin_settings.php / admin_settings_template.php / 
// admin_settings_updates.php
// ======================================================

$lang_settings_data = array(
	'section_title' => 'Nastavenie kalend�ra'
// Links
	,'admin_links_text' => 'Vyber sekciu'
	,'admin_links' => array('Hlavn� nastavenia','Konfigur�cia �abl�ny','Product Updates')
// General Settings
	,'general_settings_label' => 'V�eobecn�'
	,'calendar_name' => 'N�zov kalend�ra'
	,'calendar_description' => 'Popis kalend�ra'
	,'calendar_admin_email' => 'Email pre administr�ciu kalend�ra'
	,'cookie_name' => 'N�zov cookie pou��van�ho skriptom '
	,'cookie_path' => 'Cesta cookie pou��van�ho skriptom'
	,'debug_mode' => 'Re�im ladenia ch�b zapnut�'
	,'calendar_status' => 'Stav publikovania kalend�ra '
// Environment Settings
	,'env_settings_label' => 'Prostredie'
	,'lang' => 'Jazyk'
		,'lang_name' => 'Jazyk'
		,'lang_native_name' => 'N�rodnos�'
		,'lang_trans_date' => 'Prelo�il'
		,'lang_author_name' => 'Autor'
		,'lang_author_email' => 'E-mail'
		,'lang_author_url' => 'Website'
	,'charset' => 'K�dovanie znakov'
	,'theme' => 'Mot�v'
		,'theme_name' => 'N�zov mot�vu'
		,'theme_date_made' => 'Vyroben�'
		,'theme_author_name' => 'Autor'
		,'theme_author_email' => 'E-mail'
		,'theme_author_url' => 'Website'
	,'timezone' => 'Odch�lka �asovej z�ny'
	,'time_format' => 'Form�t d�tumu'
		,'24hours' => '24 Hod�n'
		,'12hours' => '12 Hod�n'
	,'auto_daylight_saving' => 'Automatick� prisp�sobenie pre denn� re�im (DST)'
	,'main_table_width' => '��rka hlavnej tabu�ky (Pixely alebo %)'
	,'day_start' => 'T��de� za��na'
	,'default_view' => '�tandardn� zobrazenie'
	,'search_view' => 'Povo� h�adanie'
	,'archive' => 'Zobraz uplynul� udalosti'
	,'events_per_page' => 'Po�et udalost� na strane'
	,'sort_order' => 'Poradie zora�ovania �tandardn�'
		,'sort_order_title_a' => 'N�zov vzostupn�'
		,'sort_order_title_d' => 'N�zov zostupn�'
		,'sort_order_date_a' => 'D�tum vzostupn�'
		,'sort_order_date_d' => 'D�tum zostupn�'
	,'show_recurrent_events' => 'Zobraz pravideln� udalosti'
	,'multi_day_events' => 'Viacdenn� udalosti'
		,'multi_day_events_all' => 'Zobraz rozsah �pln�ho d�tumu'
		,'multi_day_events_bounds' => 'Zobraz iba po�iato�n� a koncov� d�tum'
		,'multi_day_events_start' => 'Zobraz iba po�iato�n� d�tum'
	// User Settings
	,'user_settings_label' => 'U��vate�sk� nastavenie'
	,'allow_user_registration' => 'Povo� registr�ciu u��vate�ov'
	,'reg_duplicate_emails' => 'Povo� duplicitn� email'
	,'reg_email_verify' => 'Povo� aktiv�ciu ��tu cez email'
// Event View
	,'event_view_label' => 'Zobraz udalos�'
	,'popup_event_mode' => 'Prekrytie udalosti'
	,'popup_event_width' => '��rka Pop-up okna'
	,'popup_event_height' => 'V��ka Pop-up okna'
// Add Event View
	,'add_event_view_label' => 'Pridaj udalos�'
	,'add_event_view' => 'Povolen�'
	,'addevent_allow_html' => 'Povo� <b>HTML</b> v popise'
	,'addevent_allow_contact' => 'Povo� kontakt'
	,'addevent_allow_email' => 'Povo� Email'
	,'addevent_allow_url' => 'Povo� URL'
	,'addevent_allow_picture' => 'Povo� obr�zky'
	,'new_post_notification' => 'Po�li mi Email ak udalos� treba schv�li�'
// Calendar View
	,'calendar_view_label' => 'Mesa�n� n�h�ad'
	,'monthly_view' => 'Povolen�'
	,'cal_view_show_week' => 'Zobraz po�et t��d�ov'
	,'cal_view_max_chars' => 'Maxim�lny po�et znakov v popise'
// Flyer View
	,'flyer_view_label' => 'Letm� n�h�ad'
	,'flyer_view' => 'Povolen�'
	,'flyer_show_picture' => 'Zobraz obr�zok v letmom poh�ade'
	,'flyer_view_max_chars' => 'Maxim�lny po�et znakov v popise'
// Weekly View
	,'weekly_view_label' => 'T��denn� n�h�ad'
	,'weekly_view' => 'Povolen�'
	,'weekly_view_max_chars' => 'Maxim�lny po�et znakov v popise'
// Daily View
	,'daily_view_label' => 'Denn� n�h�ad'
	,'daily_view' => 'Povolen�'
	,'daily_view_max_chars' => 'Maxim�lny po�et znakov v popisen'
// Categories View
	,'categories_view_label' => 'Zobrazenie kateg�ri�'
	,'cats_view' => 'Povolen�'
	,'cats_view_max_chars' => 'Maxim�lny po�et znakov v popise'
// Mini Calendar
	,'mini_cal_label' => 'Mini Kalend�r'
	,'mini_cal_def_picture' => '�tandardn� obr�zok'
	,'mini_cal_display_picture' => 'Obr�zok displeja'
	,'mini_cal_diplay_options' => array('�iadny','�tandardn� obr�zok', 'Denn� obr�zok','T��denn� obr�zok','N�hodn� obr�zok')
// Mail Settings
	,'mail_settings_label' => 'Nastavenie E-mailu'
	,'mail_method' => 'Sp�sob zaslania E-mailu'
	,'mail_smtp_host' => 'SMTP Hosts (oddelen� bodko�iarkou ;)'
	,'mail_smtp_auth' => ' SMTP Authentication'
	,'mail_smtp_username' => 'SMTP Username'
	,'mail_smtp_password' => 'SMTP Password'

// Form Buttons
	,'update_config' => 'Ulo� nov� konfigur�ciu'
	,'restore_config' => 'Obnov p�vodn� nastavenie'
// Misc.
	,'update_settings_success' => 'Nastavenie �spe�ne aktualizovan�'
	,'restore_default_confirm' => 'Ste si ist�, �e chcete obnovi� p�vodn� nastavenie ?'
// Template Configuration
	,'template_type' => 'Druh �abl�ny'
	,'template_header' => '�prava hlavi�ky'
	,'template_footer' => '�prava p�ty'
	,'template_status_default' => 'Pou�i �tandardn� mot�v �abl�ny'
	,'template_status_custom' => 'Pou�i nasledovn� �abl�nu:'
	,'template_custom' => 'Vlastn� �abl�na'

	,'info_meta' => 'Meta Information'
	,'info_status' => 'Status control'
	,'info_status_default' => 'Zablokuj tento obsah'
	,'info_status_custom' => 'Zobraz nasledovn� obsah:'
	,'info_custom' => 'Vlastn� obsah'

	,'dynamic_tags' => 'Dynamic Tags'

// Product Updates
	,'updates_check_text' => 'Pros�me, po�kajte k�m obnov�me inform�cie zo serveru...'
	,'updates_no_response' => 'Serer neodpoved�. Pros�me, sk�ste nesk�r.'
	,'avail_updates' => 'Aktualiz�cie dostupn�'
	,'updates_download_zip' => 'Stiahni ZIP bal�k (.zip)'
	,'updates_download_tgz' => 'Stiahni TGZ bal�k (.tar.gz)'
	,'updates_released_label' => 'D�tum vydania: %s'
	,'updates_no_update' => 'M�te aktu�lnu verziu. Nie je potrebn� aktualiz�cia.'
);

// ======================================================
// cal_mini.inc.php
// ======================================================

$lang_mini_cal = array(
	'def_pic' => 'Aktu�lny obr�zok'
	,'daily_pic' => 'Obr�zok d�a (%s)'
	,'weekly_pic' => 'Obr�zok t��d�a (%s)'
	,'rand_pic' => 'N�hodn� obr�zok (%s)'
	,'post_event' => 'Pridaj nov� udalos�'
	,'num_events' => '%d Udalos�(ti)'
	,'selected_week' => 'T��de� %d'
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
	'section_title' => 'Prihl�senie'
// General Settings
	,'login_intro' => 'Vlo�te u��vate�sk� meno a heslo pre prihl�senie'
	,'username' => 'Username'
	,'password' => 'Password'
	,'remember_me' => 'Zapam�ta�'
	,'login_button' => 'Prihl�s'
// Errors
	,'invalid_login' => 'Pros�me, skontrolujte prihlasovacie �daje a sk�ste znovu!'
	,'no_username' => 'Mus�te zada� u��vate�sk� meno !'
	,'already_logged' => 'U� ste prihl�sen� !'
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
DEFINE('_EXTCAL_DATE', 'D�tum');
DEFINE('_EXTCAL_AUTHOR', 'Autor');
DEFINE('_EXTCAL_AUTHOR_EMAIL', 'Autorov E-Mail');
DEFINE('_EXTCAL_AUTHOR_URL', 'Authorova URL');
DEFINE('_EXTCAL_PUBLISHED', 'Publikovan�');

//Plugins
DEFINE('_EXTCAL_THEME_PLUGIN', 'Mot�v');
DEFINE('_EXTCAL_THEME_PLUGCOM', 'Mot�v/Pr�kaz');
DEFINE('_EXTCAL_THEME_NAME', 'Meno');
DEFINE('_EXTCAL_THEME_HEADING', 'JCal Pro Themes Manager');
DEFINE('_EXTCAL_THEME_FILTER', 'Filter');
DEFINE('_EXTCAL_THEME_ACCESS_LIST', 'Zoznam pr�stupov');
DEFINE('_EXTCAL_THEME_ACCESS_LVL', 'Pr�stupov� �rove�');
DEFINE('_EXTCAL_THEME_CORE', 'Jadro');
DEFINE('_EXTCAL_THEME_DEFAULT', '�tandardn�');
DEFINE('_EXTCAL_THEME_ORDER', 'Poradie');
DEFINE('_EXTCAL_THEME_ROW', 'Riadok');
DEFINE('_EXTCAL_THEME_TYPE', 'Typ');
DEFINE('_EXTCAL_THEME_ICON', 'Ikona');
DEFINE('_EXTCAL_THEME_LAYOUT_ICON', 'Layout Icon');
DEFINE('_EXTCAL_THEME_DESC', 'Popis');
DEFINE('_EXTCAL_THEME_EDIT', 'Edituj');
DEFINE('_EXTCAL_THEME_NEW', 'Nov�');
DEFINE('_EXTCAL_THEME_DETAILS', 'Plugin Details');
DEFINE('_EXTCAL_THEME_PARAMS', 'Parametre');
DEFINE('_EXTCAL_THEME_ELMS', 'Elementy');
//Plugin Installer
DEFINE('_EXTCAL_THEMES_INSTALL_HEADING','In�taluj nov� �abl�nu');
DEFINE('_EXTCAL_THEMES_INSTALL_MSG', 'Iba tie �abl�ny, ktor� m��u by� odin�talovan� s� zobrazen� - Hlavn� �abl�na nem��e by� odstr�nen�.');
DEFINE('_EXTCAL_THEME_NONE', 'Nie s� nain�talovan� �iadne doplnkov� �abl�ny');

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
