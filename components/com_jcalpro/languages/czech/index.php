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
	'name' => 'Czech'
	,'nativename' => 'Czech' // Language name in native language. E.g: 'Fran�ais' for 'French'
	,'locale' => array('cs_CZ','czech') // Standard locale alternatives for a specific language. For reference, go to: http://www.php.net/manual/en/function.setlocale.php
	,'charset' => 'ISO-8859-2' // For reference, go to : http://www.w3.org/International/O-charset-lang.html
	,'direction' => 'ltr' // 'ltr' for Left to Right. 'rtl' for Right to Left languages such as Arabic.
	,'author' => 'Tom� Macnar'
	,'author_email' => 'info@rhkhradec.cz'
	,'author_url' => 'http://www.rhkhradec.cz'
 	,'transdate' => '20/12/2006'
);

$lang_general = array (
	'yes' => 'Ano'
	,'no' => 'Ne'
	,'back' => 'Zp�t'
	,'continue' => 'Pokra�uj'
	,'close' => 'Zav�i'
	,'errors' => 'Chyba'
	,'info' => 'Informace'
	,'day' => 'Den'
	,'days' => 'Dn�'
	,'month' => 'M�s�c'
	,'months' => 'M�s�c�'
	,'year' => 'Rok'
	,'years' => 'Rok�'
	,'hour' => 'Hodina'
	,'hours' => 'Hodin'
	,'minute' => 'Minuta'
	,'minutes' => 'Minut'
	,'everyday' => 'Ka�d� den'
	,'everymonth' => 'Ka�d� m�s�c'
	,'everyyear' => 'Ka�d� rok'
	,'active' => 'Aktivn�'
	,'not_active' => 'Neaktivn�'
	,'today' => 'Dnes'
	,'signature' => 'Vytvo�il %s'
	,'expand' => 'Roz���it'
	,'collapse' => 'Kolaps'
);

// Date formats, For reference, go to : http://www.php.net/manual/en/function.strftime.php
$lang_date_format = array (
	'full_date' => '%A, %B %d, %Y' // e.g. Wednesday, June 05, 2002
	,'full_date_time_24hour' => '%A, %B %d, %Y od %H:%M' // e.g. Wednesday, June 05, 2002 At 21:05
	,'full_date_time_12hour' => '%A, %B %d, %Y od %I:%M %p' // e.g. Wednesday, June 05, 2002 At 9:05 pm
	,'day_month_year' => '%d-%b-%Y' // e.g 10-Sep-2004
	,'local_date' => '%c' // Preferred date and time representation for current language 
	,'mini_date' => '%a. %d %b, %Y' 
	,'month_year' => '%B %Y'
	,'day_of_week' => array('Ned�le','Pond�l�','�ter�','St�eda','�tvrtek','P�tek','Sobota')
	,'months' => array('Leden','�nor','B�ezen','Duben','Kv�ten','�erven','�ervenec','Srpen','Z���','��jen','Listopad','Prosinec')
);

$lang_system = array (
	'system_caption' => 'Syst�mov� hl�en�'
  ,'page_access_denied' => 'Nem�te pot�ebn� opr�vn�n� pro p��stup k t�to volb�.'
  ,'page_requires_login' => 'Mus�te b�t p�ihl�en�.'
  ,'operation_denied' => 'Nem�te pot�ebn� opr�vn�n� pro k vykon�n� t�to operace.'
	,'section_disabled' => 'Tato sekce je moment�ln� nep��stupn� !'
  ,'non_exist_cat' => 'Vybran� kategorie neexistuje !'
  ,'non_exist_event' => 'Vybran� ud�lost neexistuje !'
  ,'param_missing' => 'Zadan� �daje jsou neplatn�.'
  ,'no_events' => 'Nejsou k zobrazen� ��dn� ud�losti'
  ,'config_string' => 'Pr�v� pou��v�te \'%s\' b��c�ch na %s, %s a %s.'
  ,'no_table' => 'Tato \'%s\' tabulka neexistuje !'
  ,'no_anonymous_group' => 'Tato %s tabulka neobsahuje \'Anonymous\' skupinu !'
  ,'calendar_locked' => 'Tato slu�ba je do�asn� nedostupn� z d�vod� �dr�by. Omlouv�me se za vznikl� probl�my !'
	,'new_upgrade' => 'Syst�m ohl�sil novou verzi. Doporu�ujeme prov�st upgrade. Klikni na "Pokra�ovat" pro spu�t�n� upgradu.'
	,'no_profile' => 'P�i vyvol�n� va�eho profilu se vyskytla chyba'
	,'unknown_component' => 'Nezn�m� komponenta'
// Mail messages
	,'new_event_subject' => 'Ud�lost vy�aduje schv�len� %s'
	,'event_notification_failed' => 'P�i odesl�n� potvrzuj�c�ho emailu se vyskytla chyba !'
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
	'login' => 'P�ihl�en�'
	,'register' => 'Registrace'
  ,'logout' => 'Logout <span style="color:#FF9922">[<span style="color:#606F79">%s</span>]</span>'
  ,'user_profile' => 'M�j profil'
	,'admin_events' => 'Ud�losti'
  ,'admin_categories' => 'Kategorie'
  ,'admin_groups' => 'Skupiny'
  ,'admin_users' => 'U�ivatel�'
  ,'admin_settings' => 'Nastaven�'
);

// Main menu entries
$lang_main_menu = array (
	'add_event' => 'P�idej ud�lost'
	,'cal_view' => 'M�s��n� p�ehled'
  ,'flat_view' => 'Roz���en� p�ehled'
  ,'weekly_view' => 'T�denn� p�ehled'
  ,'daily_view' => 'Denn� p�ehled'
  ,'yearly_view' => 'Ro�n� p�ehled'
  ,'categories_view' => 'Kategorie'
  ,'search_view' => 'Hledej'
);

// ======================================================
// Add Event view
// ======================================================

$lang_add_event_view = array(
	'section_title' => 'P�idej ud�lost'
	,'edit_event' => 'Uprav ud�lost [id%d] \'%s\''
	,'update_event_button' => 'Aktualizuj ud�lost'

// Event details
	,'event_details_label' => 'Podrobnosti o ud�losti'
	,'event_title' => 'N�zev ud�losti'
	,'event_desc' => 'Popis ud�losti'
	,'event_cat' => 'Kategorie'
	,'choose_cat' => 'Vyber kategorii'
	,'event_date' => 'Datum ud�losti'
	,'day_label' => 'Den'
	,'month_label' => 'M�s�c'
	,'year_label' => 'Rok'
	,'start_date_label' => 'Doba za��tku'
	,'start_time_label' => 'Od'
	,'end_date_label' => 'Trv�n�'
	,'all_day_label' => 'Cel� den'
// Contact details
	,'contact_details_label' => 'Dateily kontaktu'
	,'contact_info' => 'Info o kontaktu'
	,'contact_email' => 'Email'
	,'contact_url' => 'URL'
// Repeat events
	,'repeat_event_label' => 'Opakuj ud�lost'
	,'repeat_method_label' => 'Zp�sob opakov�n�'
	,'repeat_none' => 'Neopakuj tuto ud�lost'
	,'repeat_every' => 'Opakuj ka�d�ch'
	,'repeat_days' => 'Dn�'
	,'repeat_weeks' => 'T�dn�'
	,'repeat_months' => 'M�s�c�'
	,'repeat_years' => 'Rok�'
	,'repeat_end_date_label' => 'Opakuj koncov� datum'
	,'repeat_end_date_none' => 'Bez data ukon�en�'
	,'repeat_end_date_count' => 'Konec po %s opakov�n�'
	,'repeat_end_date_until' => 'Opakuj dokud'
// Other details
	,'other_details_label' => 'Dal�� detaily'
	,'picture_file' => 'Obr�zek'
	,'file_upload_info' => '(%d KBytes limit - Valid extensions : %s )' 
	,'del_picture' => 'Vymazat aktu�ln� obr�zek ?'
// Administrative options
	,'admin_options_label' => 'Mo�nosti administr�tora'
	,'auto_appr_event' => 'Ud�lost schv�lena'

// Error messages
	,'no_title' => 'Mus�te zadat n�zev ud�losti !'
	,'no_desc' => 'Mus�te zadat popis ud�losti !'
	,'no_cat' => 'Mus�te zadat kategorii z menu !'
	,'date_invalid' => 'Mus�te zadat platn� den ud�losti !'
	,'end_days_invalid' => 'Hodnota zadan� v poli \'Dni\' nen� platn� !'
	,'end_hours_invalid' => 'Hodnota zadan� v poli \'Hodiny\' nen� platn� !'
	,'end_minutes_invalid' => 'Hodnota zadan� v poli \'Minuty\' nen� platn� !'
	,'move_image_failed' => 'Syst�mov� chyba p�i nahr�n� obr�zku. Zvolte spr�vnou velikost nebo kontaktujte administr�tora.'
	,'non_valid_dimensions' => '���ka nebo bv��ka obr�zku je v�t�� o %s pixel� !'

	,'recur_val_1_invalid' => 'Zadan� hodnota \'interval opakov�n�\' nen� platn�. Hodnota mus� b�t v�t�� ne� \'0\' !'
	,'recur_end_count_invalid' => 'Zadan� hodnota \'po�et v�skyt�\' nen� platn�. Hodnota mus� b�t v�t�� ne� \'0\' !'
	,'recur_end_until_invalid' => 'Hodnota datumu \'opakuj dokud\' mus� b�t v�t�� ne� v�choz� datum !'
// Misc. messages
	,'submit_event_pending' => 'Va�e ud�lost byla vlo�ena! <br/> Po kontrole administr�tora bude publikov�na. <br/> D�kujeme za vlo�en�!'
	,'submit_event_approved' => 'Va�e ud�lost byla automaticky schv�lena. <br/> D�kujeme za vlo�en� !'
	,'event_repeat_msg' => 'Tato ud�lost m� nastaven� opakov�n�.'
	,'event_no_repeat_msg' => 'Tato ud�lost se nebude opakovat.'
);

// ======================================================
// daily view
// ======================================================

$lang_daily_event_view = array(
	'section_title' => 'Denn� p�ehled'
	,'next_day' => 'N�sleduj�c� den'
	,'previous_day' => 'P�edchoz� den'
	,'no_events' => 'Pro tento den nebyla zad�na ��dn� ud�lost.'
);

// ======================================================
// weekly view
// ======================================================

$lang_weekly_event_view = array(
	'section_title' => 'T�denn� p�ehled'
	,'week_period' => '%s - %s'
	,'next_week' => 'N�sleduj�c� t�den'
	,'previous_week' => 'P�edchoz� t�den'
	,'selected_week' => '%d T�den'
	,'no_events' => 'V tomto t�dnu nejsou ��dn� ud�losti'
);

// ======================================================
// monthly view
// ======================================================

$lang_monthly_event_view = array(
	'section_title' => 'M�s��n� p�ehled'
	,'next_month' => 'N�sleduj�c� m�s�c'
	,'previous_month' => 'P�edchoz� m�s�c'
);

// ======================================================
// flat view
// ======================================================

$lang_flat_event_view = array(
	'section_title' => 'Roz���en� p�ehled'
	,'week_period' => '%s - %s'
	,'next_month' => 'N�sleduj�c� m�s�c'
	,'previous_month' => 'P�edchoz� m�s�c'
	,'contact_info' => 'Kontakt info'
	,'contact_email' => 'Email'
	,'contact_url' => 'URL'
	,'no_events' => 'V tomto m�s�ci nejsou ��dn� ud�losti'
);

// ======================================================
// Event view
// ======================================================

$lang_event_view = array(
	'section_title' => 'P�ehled ud�lost�'
	,'display_event' => 'Ud�lost: \'%s\''
	,'cat_name' => 'Kategorie'
	,'event_start_date' => 'Datum'
	,'event_end_date' => 'A� do'
	,'event_duration' => 'Trv�n�'
	,'contact_info' => 'Kontakt info'
	,'contact_email' => 'Email'
	,'contact_url' => 'URL'
	,'no_event' => 'Neexistuj� ��dn� ud�losti k zobrazen�.'
	,'stats_string' => '<strong>%d</strong> Ud�lost� celkem'
	,'edit_event' => 'Edituj ud�lost'
	,'delete_event' => 'Sma� ud�lost'
	,'delete_confirm' => 'Jste si jist�, �e chcete vymazat tuto ud�lost ?'
	
);

// ======================================================
// Categories view
// ======================================================

$lang_cats_view = array(
	'section_title' => 'P�ehled kategori�'
	,'cat_name' => 'N�zev kategorie'
	,'total_events' => 'Celkem ud�lost�'
	,'upcoming_events' => 'O�ek�van� ud�losti'
	,'no_cats' => 'Neexistuje kategorie k zobrazen�.'
	,'stats_string' => '<strong>%d</strong> ud�lost� v <strong>%d</strong> kategorii (�ch)'
);

// ======================================================
// Category Events view
// ======================================================

$lang_cat_events_view = array(
	'section_title' => 'Ud�losti pod \'%s\''
	,'event_name' => 'N�zev ud�losti'
	,'event_date' => 'Datum'
	,'no_events' => 'V kategorii nejsou ��dn� ud�losti.'
	,'stats_string' => '<strong>%d</strong> Ud�lost� celkem'
	,'stats_string1' => '<strong>%d</strong> ud�lost(�) na <strong>%d</strong> str�nce (str�nk�ch)'
);

// ======================================================
// cal_search.php
// ======================================================

$lang_event_search_data = array(
	'section_title' => 'Hledej v kalend��i',
	'search_results' => 'Hledej v�sledky',
	'category_label' => 'Kategorie',
	'date_label' => 'Datum',
	'no_events' => 'V kategorii nejsou ��dn� ud�losti.',
	'search_caption' => 'Napi� kl��ov� slovo...',
	'search_again' => 'Hledej znovu',
	'search_button' => 'Hledej',
// Misc.
	'no_results' => 'Nenalezen ��dn� v�sledek',	
// Stats
	'stats_string1' => '<strong>%d</strong> ud�lost(�) nalezena (o)',
	'stats_string2' => '<strong>%d</strong> ud�lost(�) na <strong>%d</strong> str�nce (str�nk�ch)'
);

// ======================================================
// profile.php
// ======================================================

if (defined('PROFILE_PHP')) 

$lang_user_profile_data = array(
	'section_title' => 'M�j profil',
	'edit_profile' => 'Edituj m�j profil',
	'update_profile' => 'Aktualizuj m�j profil',
	'actions_label' => 'Akce',
// Account Info
	'account_info_label' => 'Informace o ��t�',
	'user_name' => 'U�ivatelsk� jm�no',
	'user_pass' => 'Heslo',
	'user_pass_confirm' => 'Potvr� heslo',
	'user_email' => 'E-mailov� adresa',
	'group_label' => 'Skupina �len�',
// Other Details
	'other_details_label' => 'Dal�� detaily',
	'first_name' => 'Jm�no',
	'last_name' => 'P��jmen�',
	'full_name' => 'Cel� jm�no',
	'user_website' => 'V�choz� str�nka',
	'user_location' => 'Um�st�n�',
	'user_occupation' => 'Zam�stn�n�',
// Misc.
	'select_language' => 'Vyber jazyk',
	'edit_profile_success' => 'Profil byl �sp�n� aktualizovan�.',
	'update_pass_info' => 'Pokud nechcete m�nit heslo nechte pole pr�zdn�.',
// Error messages
	'invalid_password' => 'Pros�m zadejte heslo obsahuj�c� jen p�smena a ��slice s 4 a� 16 znaky !',
	'password_is_username' => 'Heslo mus� b�t rozd�ln� od va�eho p�ihla�ovac�ho jm�na !',
	'password_not_match' =>'Heslo nen� schodn�',
	'invalid_email' => 'Mus�te zadat platnou email adresu !',
	'email_exists' => 'Emailov� adresa je ji� registrov�na jin�m u�ivatelem. Zadejte jinou !',
	'no_email' => 'Mus�te zadat emailovou adresu !',
	'invalid_email' => 'Mus�te zadat platnou email adresu !',
	'no_password' => 'K nov�mu ��tu mus�te zadat heslo !'
);

// ======================================================
// register.php
// ======================================================

if (defined('USER_REGISTRATION_PHP')) 

$lang_user_registration_data = array(
	'section_title' => 'Registrace',
// Step 1: Terms & Conditions
	'terms_caption' => 'Podm�nky',
	'terms_intro' => 'Pro pokra�ov�n� mus�te souhlasit s n�sleduj�c�m:',
	'terms_message' => 'Pros�m v�nujte pozornost n�sleduj�c�m pravidl�m. Pokud souhlas�tea a chcete pokra�ovat v registraci, klikn�te na tla��tko "Souhlas�m". Ke zru�en� registrace, klikn�te na tla��tko zp�t ve va�em prohl�e�i.<br /><br />Uv�domte si, �e nejsme odpov�dn� za ud�losti vlo�en� u�ivateli do kalend��e. Neru��me za obsah, p�esnost, �plnnost a pou�itelnost vlo�en�ch ud�lost�.<br /><br />Vlo�en� zpr�vy vyjad�uj� pouze n�zory autor�. Pokud n�kter� z u�ivatel� zjist� neobjektivnost �i nespr�vnost vlo�en�ch ud�lost�, nech� se obr�t� na administr�tora. M�me mo�nost tenty zpr�vy odtranit. <br /><br /> P�i pou��v�n� t�to slu�by se zavazujete k tomu, �e nebudete zneu��vat aplikaci k zas�l�n� nep�esn�ch a nespr�vn�ch informac�, nebudete pou��vat vulgarizmy, ur�ky, neslu�n�, rasistick� a hanliv� v�razy, kter� odporuj� platn� legislativ�. <br /><br /> D�le souhlas�te, �e nebudete zve�ej�ovat informace, v rozporu s autorsk�m z�konem. %s.',
	'terms_button' => 'Souhlas�m',
	
// Account Info
	'account_info_label' => 'Informace o ��t�',
	'user_name' => 'U�ivatelsk� jm�no',
	'user_pass' => 'Heslo',
	'user_pass_confirm' => 'Potvr� heslo',
	'user_email' => 'E-mailov� adresa',
// Other Details
	'other_details_label' => 'Dal�� detaily',
	'first_name' => 'Jm�no',
	'last_name' => 'P��jmen�',
	'user_website' => 'V�choz� str�nka',
	'user_location' => 'Um�st�n�',
	'user_occupation' => 'Zam�stn�n�',
	'register_button' => 'Potvr� registraci',

// Stats
	'stats_string1' => '<strong>%d</strong> u�ivatel�',
	'stats_string2' => '<strong>%d</strong> u�ivatel� na <strong>%d</strong> str�nce(str�nk�ch)',
// Misc.
	'reg_nomail_success' => 'D�kujeme za registraci.',
	'reg_mail_success' => 'Zpr�va jak prov�st aktivaci ��tu V�m byla zasl�n na v� email.',
	'reg_activation_success' => 'Gratulujeme! V� ��et je nyn� zaktivov�n. <br/> Pros�m p�ihla�te se. <br/> D�kujeme za registraci!',
// Mail messages
	'reg_confirm_subject' => 'Registrace %s',
	
// Error messages
	'no_username' => 'Mus�te zadat u�ivatelsk� jm�no !',
	'invalid_username' => 'Pros�m zadejte u�ivatelsk� jm�no, kter� mus� obsahovat pouze p�smena a ��slice s maxim�ln� d�lkou 4 a�  30 znak� !',
	'username_exists' => 'V�mi zadan� u�ivatelsk� jm�no je ji� pou�ito. Zadejte pros�m jin� !',
	'no_password' => 'Mus�te zadat heslo !',
	'invalid_password' => 'Pros�m zadejte heslo obsahuj�c� pouze p�smena a ��slice s maxim�ln� d�lkou 4 a� 16 znak� !',
	'password_is_username' => 'Heslo mus� b�t odli�n� od u�ivatelsk�ho jm�na !',
	'password_not_match' =>'Zadan� heslo nen� stejn� v ��sti \'potvr�te heslo\'',
	'no_email' => 'Mus�te zadat emailovou adresu !',
	'invalid_email' => 'Mus�te zadat platnou emailovou adresu !',
	'email_exists' => 'Zadan� email je ji� pou��v�n. Zadejte pros�m jin� !',
	'delete_user_failed' => 'U�ivatelsk� ��et nem��e b�t odstran�n',
	'no_users' => 'Neexistuje ��dn� u�ivatelsk� ��et k zobrazen� !',
	'already_logged' => 'Ji� jste p�ihl�en jako �len !',
	'registration_not_allowed' => 'U�ivatelsk� registrace nejsou povoleny !',
	'reg_email_failed' => 'Nastala chyba p�i odesl�n� aktiva�n�ho mailu !',
	'reg_activation_failed' => 'Nastala chyba p�i aktivaci va�eho ��tu !'

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
	'section_title' => 'Administrace ud�lost�',
	'events_to_approve' => 'Administrace ud�lost�: Ud�losti ke schv�len�',
	'upcoming_events' => 'Administrace ud�lost�: O�ek�van� ud�losti',
	'past_events' => 'Administrace ud�lost�: Uplynul� ud�losti',
	'add_event' => 'P�idat novou ud�lost',
	'edit_event' => 'Editovat ud�lost',
	'view_event' => 'N�hled ud�losti',
	'approve_event' => 'Schv�len� ud�losti',
	'update_event' => 'Aktualizuj ud�lost',
	'delete_event' => 'Vyma� ud�lost',
	'events_label' => 'Ud�losti',
	'auto_approve' => 'Automatick� schv�len�',
	'date_label' => 'Datum',
	'actions_label' => 'Akce',
	'events_filter_label' => 'Filtr ud�lost�',
	'events_filter_options' => array('Zobraz v�echny ud�losti','Pouze neschv�len� ud�losti','Pouze o�ek�van� ud�losti','Pouze uplynul� ud�losti'),
	'picture_attached' => 'Obr�zek p�ilo�en',
// View Event
	'view_event_name' => 'Ud�lost: \'%s\'',
	'event_start_date' => 'Datum',
	'event_end_date' => 'Do',
	'event_duration' => 'Trv�n�',
	'contact_info' => 'Kontaktn� info',
	'contact_email' => 'Email',
	'contact_url' => 'URL',
// General Info
// Event form
	'edit_event_title' => 'Ud�lost: \'%s\'',
	'cat_name' => 'Kategoriy',
	'event_start_date' => 'Datum',
	'event_end_date' => 'DO',
	'contact_info' => 'Kontaktn� info',
	'contact_email' => 'Email',
	'contact_url' => 'URL',
	'no_event' => 'Nejsou ��dn� ud�losti k zobrazen�.',
	'stats_string' => '<strong>%d</strong> Ud�lost� celkem',
// Stats
	'stats_string1' => '<strong>%d</strong> ud�lost(i)',
	'stats_string2' => 'Celkem: <strong>%d</strong> ud�lost(�) na <strong>%d</strong> str�nce (str�nk�ch)',
// Misc.
	'add_event_success' => 'Ud�lost �sp�n� vlo�ena',
	'edit_event_success' => 'Ud�lost �sp�n� atualizov�na',
	'approve_event_success' => 'Ud�lost �sp�n� schv�lena',
	'delete_confirm' => 'Jste si jisti, �e chcete ud�lost smazat ?',
	'delete_event_success' => 'Ud�lost �sp�n� smaz�na',
	'active_label' => 'Aktivn�',
	'not_active_label' => 'Neaktivn�',
// Error messages
	'no_event_name' => 'Mus�te zadat jm�no ud�losti !',
	'no_event_desc' => 'Mus�te zadat popis ud�losti !',
	'no_cat' => 'Mus�te pro ud�lost vybrat kategorii  !',
	'no_day' => 'Mus�te vybrat den !',
	'no_month' => 'Mus�te vybrat m�s�c !',
	'no_year' => 'Mus�te vybrat rok !',
	'non_valid_date' => 'Zadejte platn� datum !',
	'end_days_invalid' => 'Pros�m ujist�te se, �e pole \'Dny\' pod \'Trv�n�m\' obsahuje pouze ��slice !',
	'end_hours_invalid' => 'Pros�m ujist�te se, �e pole \'Hodiny\' pod \'Trv�n�m\' obsahuje pouze ��slice !',
	'end_minutes_invalid' => 'Pros�m ujist�te se, �e pole \'Minuty\' pod \'Trv�n�m\' obsahuje pouze ��slice  !',
	'delete_event_failed' => 'Ud�lost nem��e b�t smaz�na !',
	'approve_event_failed' => 'Ud�lost nem��e b�t schv�lena !',
	'no_events' => 'Nejsou ��dn� ud�losti k zobrazen� !',
	'recur_val_1_invalid' => 'Hodnota zadan� jako \'interval opakov�n�\' nen� platn�. Hodnota mus� b�t v�t�� ne� \'0\' !',
	'recur_end_count_invalid' => 'Hodnota zadan� jako \'po�et v�skyt�\' nen� platn�. Hodnota mus� b�t v�t�� ne� \'0\' !',
	'recur_end_until_invalid' => 'Hodnota datumu \'opakuj dokud\' mus� b�t v�t�� ne� po��te�n� datum !'

);

// ======================================================
// admin_categories.php
// ======================================================

if (defined('ADMIN_CATS_PHP')) 

$lang_cat_admin_data = array(
	'section_title' => 'Administrace kategori�',
	'add_cat' => 'P�idej novou kategorii',
	'edit_cat' => 'Uprav kategorii',
	'update_cat' => 'Aktualizuj informace o kategorii',
	'delete_cat' => 'Sma� kategorii',
	'events_label' => 'Ud�losti',
	'visibility' => 'Viditelnost',
	'actions_label' => 'Akce',
	'users_label' => 'U�ivatel�',
	'admins_label' => 'Administr�to�i',
// General Info
	'general_info_label' => 'V�eobecn� informace',
	'cat_name' => 'Jm�no kategorie',
	'cat_desc' => 'Popis kategorie',
	'cat_color' => 'Barva',
	'pick_color' => 'Vyber barvu!',
	'status_label' => 'Stav',
// Stats
	'stats_string1' => '<strong>%d</strong> kategorie',
	'stats_string2' => 'Aktivn�: <strong>%d</strong>&nbsp;&nbsp;&nbsp;Celkem: <strong>%d</strong>&nbsp;&nbsp;&nbsp; na <strong>%d</strong> str�nce(str�nk�ch)',
// Misc.
	'add_cat_success' => 'Nov� kategorie �sp�n� p�id�na',
	'edit_cat_success' => 'Aktualizace kategorie �sp�n� provedena',
	'delete_confirm' => 'Jste si jisti, �e chcte kategorii vymazat ?',
	'delete_cat_success' => 'Kategorie �sp�n� smaz�na',
	'active_label' => 'Aktivn�',
	'not_active_label' => 'Neaktivn�',
// Error messages
	'no_cat_name' => 'Mus�te zadat n�zev kategorie !',
	'no_cat_desc' => 'Mus�te zadat popis kategorie !',
	'no_color' => 'Mus�te zvolit barvu kategorie !',
	'delete_cat_failed' => 'Kategorie nem��e b�t vymaz�na',
	'no_cats' => 'Nen� ��dn� kategorie k zobrazen� !',
	'cat_has_events' => 'Kategorie obsahuje %d ud�losti(i)) a proto nem��e b�t smaz�na!<br>Vyma�te pros�m ud�losti z kategorie a zkuste smazat katagorii znovu!'

);
// ======================================================
// admin_users.php
// ======================================================

if (defined('ADMIN_USERS_PHP')) 

$lang_user_admin_data = array(
	'section_title' => 'Administrace u�ivatel�',
	'add_user' => 'P�idej nov�ho u�ivatele',
	'edit_user' => 'Uprav info o u�ivateli',
	'update_user' => 'Aktualizuj info o u�ivateli',
	'delete_user' => 'Vyma� ��et u�ivatele',
	'last_access' => 'Posledn� p��stup',
	'actions_label' => 'Akce',
	'active_label' => 'Aktivn�',
	'not_active_label' => 'Neaktivn�',
// Account Info
	'account_info_label' => 'Informace o ��t�',
	'user_name' => 'U�ivatelsk� jm�no',
	'user_pass' => 'Heslo',
	'user_pass_confirm' => 'Potvr� heslo',
	'user_email' => 'E-mailov� adresa',
	'group_label' => 'Skupina �len�',
	'status_label' => 'Stav ��tu',
// Other Details
	'other_details_label' => 'Dal�� detaily',
	'first_name' => 'Jm�no',
	'last_name' => 'P��jmen�',
	'user_website' => 'V�choz� str�nka',
	'user_location' => 'M�sto',
	'user_occupation' => 'Zam�stn�n�',
// Stats
	'stats_string1' => '<strong>%d</strong> u�ivatel�',
	'stats_string2' => '<strong>%d</strong> u�ivatel(�) na <strong>%d</strong> str�nce(str�nk�ch)',
// Misc.
	'select_group' => 'Vyber jednoho...',
	'add_user_success' => 'U�ivatelsk� ��et byl �sp�n� p�id�n',
	'edit_user_success' => 'U�ivatelsk� ��et byl �sp�n� aktualizov�n',
	'delete_confirm' => 'Jste si jisti, �e chcete u�ivatelsk� ��et vymazat?',
	'delete_user_success' => 'U�ivatelsk� ��et byl �sp�n� vymaz�m',
	'update_pass_info' => 'Pokud nechcete m�nit heslo nechte pole pr�zdn�.',
	'access_never' => 'Nikdy',
// Error messages
	'no_username' => 'Mus�te zadat u�ivatelsk� jm�no !',
	'invalid_username' => 'Pros�m zadejte u�ivatelsk� jm�no, kter� mus� obsahovat pouze p�smena a ��slice s maxim�ln� d�lkou 4 a�  30 znak� !',
	'invalid_password' => 'Pros�m zadejte heslo obsahuj�c� pouze p�smena a ��slice s maxim�ln� d�lkou 4 a� 16 znak� !',
	'password_is_username' => 'Heslo mus� b�t odli�n� od u�ivatelsk�ho jm�na !',
	'password_not_match' =>'Zadan� heslo nen� stejn� v ��sti \'potvr�te heslo\'',
	'invalid_email' => 'Mus�te zadat platnou emailovou adresu !',
	'email_exists' => 'Emailov� adresa je ji� registrov�na jin�m u�ivatelem. Zadejte jinou !',
	'username_exists' => 'V�mi zadan� u�ivatelsk� jm�no je ji� pou�ito. Zadejte pros�m jin� !',
	'no_email' => 'Mus�te zadat emailovou adresu !',
	'invalid_email' => 'Mus�te zadat platn� email !',
	'no_password' => 'Mus�te zadat heslo k Va�emu ��tu !',
	'no_group' => 'Pros�m vyberte skupinu pro tohoto u�ivatele !',
	'delete_user_failed' => 'U�ivatelsk� ��et nem��e b�t smaz�n',
	'no_users' => 'Nejsou ��dn� u�ivatelsk� ��ty k zobrazen� !'

);

// ======================================================
// admin_groups.php
// ======================================================

if (defined('ADMIN_GROUPS_PHP')) 

$lang_group_admin_data = array(
	'section_title' => 'Administrace skupiny',
	'add_group' => 'P�idej novou skupinu',
	'edit_group' => 'Uprav skupinu',
	'update_group' => 'Aktualizuj info o skupin�',
	'delete_group' => 'Vyma� skupinu',
	'view_group' => 'Zobraz skupinu',
	'users_label' => '�lenov�',
	'actions_label' => 'Akce',
// General Info
	'general_info_label' => 'V�eobecn� informace',
	'group_name' => 'Jm�no skupiny',
	'group_desc' => 'Popis skupiny',
// Group Access Level
	'access_level_label' => '�rove� p��stupov�ch pr�v',
	'Administrator' => 'U�ivatel� v t�to skupin� maj� administr�torsk� p��stup',
	'can_manage_accounts' => 'U�ivatel� v t�to skupin� mohou spravovat ��ty',
	'can_change_settings' => 'U�ivatel� v t�to skupin� mohou m�nit nastaven� kalend��e',
	'can_manage_cats' => 'U�ivatel� v t�to skupin� mohou spravovat kategorie',
	'upl_need_approval' => 'P�idan� ud�losti vy�aduj� schv�len� administr�tora',
// Stats
	'stats_string1' => '<strong>%d</strong> skupiny',
	'stats_string2' => 'Celkem: <strong>%d</strong> skupin na <strong>%d</strong> str�nce(str�nk�ch)',
	'stats_string3' => 'Celkem: <strong>%d</strong> u�ivatel� na <strong>%d</strong> str�nce(str�nk�ch)',
// View Group Members
	'group_members_string' => '�len \'%s\' skupiny',
	'username_label' => 'U�ivatelsk� jm�no',
	'firstname_label' => 'Jm�no',
	'lastname_label' => 'P��jmen�',
	'email_label' => 'Email',
	'last_access_label' => 'Posledn� p��stup',
	'edit_user' => 'Uprav u�ivatele',
	'delete_user' => 'Sma� u�ivatele',
// Misc.
	'add_group_success' => 'Nov� skupina �sp�n� p�id�na',
	'edit_group_success' => 'Aktualizace skupiny prob�hla �sp�n�',
	'delete_confirm' => 'Jste si jist�, �e chcete skupinu smazat ?',
	'delete_user_confirm' => 'Jste si jist�, �e chcete skupinu smazat ?',
	'delete_group_success' => 'Skupina �sp�n� smaz�na',
	'no_users_string' => 'Ve skupin� nejsou ��dn� u�ivatel�',
// Error messages
	'no_group_name' => 'Mus�te zadat jm�no skupiny !',
	'no_group_desc' => 'Mus�te zadat popis skupiny !',
	'delete_group_failed' => 'Skupina nem��e b�t vymaz�na',
	'no_groups' => 'Nejsou ��dn� skupiny k zobrazen� !',
	'group_has_users' => 'Skupina obsahuje %d u�ivatele(�) a proto nem��e b�t smaz�na!<br>Pros�m odstra�te u�ivatele ze skupiny a zkuste to znovu!'

);

// ======================================================
// admin_settings.php / admin_settings_template.php / 
// admin_settings_updates.php
// ======================================================

$lang_settings_data = array(
	'section_title' => 'Nastaven� kalend��e'
// Links
	,'admin_links_text' => 'Vyber sekci'
	,'admin_links' => array('Hlavn� nastaven�','Nastav �ablonu','Aktualizace')
// General Settings
	,'general_settings_label' => 'V�eobecn�'
	,'calendar_name' => 'Jm�no kalend��e'
	,'calendar_description' => 'Popis kalend��e'
	,'calendar_admin_email' => 'Email administr�tora kalend��e'
	,'cookie_name' => 'Jm�no cookie pou��van�ch scripty'
	,'cookie_path' => 'Cesta cookie pou��van�ch scripty'
	,'debug_mode' => 'Zapni lad�c� re�im'
	,'calendar_status' => 'Stav publikov�n� kalend��e'
// Environment Settings
	,'env_settings_label' => 'Prost�ed�'
	,'lang' => 'Jazyk'
		,'lang_name' => 'N�zev jazyka'
		,'lang_native_name' => 'N�rodnost'
		,'lang_trans_date' => 'P�elo�il:'
		,'lang_author_name' => 'Autor'
		,'lang_author_email' => 'E-mail'
		,'lang_author_url' => 'Website'
	,'charset' => 'K�dov� str�nka'
	,'theme' => 'Motiv'
		,'theme_name' => 'Jm�no motivu'
		,'theme_date_made' => 'Vyrobeno'
		,'theme_author_name' => 'Autor'
		,'theme_author_email' => 'E-mail'
		,'theme_author_url' => 'Website'
	,'timezone' => '�asov� z�na'
	,'time_format' => 'Form�t �asu'
		,'24hours' => '24 hodinov�'
		,'12hours' => '12 hodinov�'
	,'auto_daylight_saving' => 'Automatick� nastaven� (DST)'
	,'main_table_width' => '���ka hlavn� tabulky (pixely nebo %)'
	,'day_start' => 'T�den za��n�'
	,'default_view' => 'Standardn� zobrazen�'
	,'search_view' => 'Povol vyhled�v�n�'
	,'archive' => 'Uka� uplynul� ud�losti'
	,'events_per_page' => 'Po�et ud�lost� na str�nku'
	,'sort_order' => '�adit dle'
		,'sort_order_title_a' => 'N�zev vzestupn�'
		,'sort_order_title_d' => 'N�zev sestupn�'
		,'sort_order_date_a' => 'Datum vzestupn�'
		,'sort_order_date_d' => 'Datum sestupn�'
	,'show_recurrent_events' => 'Zobraz opakuj�c� se ud�losti'
	,'multi_day_events' => 'V�ce-denn� ud�losti'
		,'multi_day_events_all' => 'Zobraz rozsah datumu'
		,'multi_day_events_bounds' => 'Zobraz jen po��te�n� a kone�n� datumu'
		,'multi_day_events_start' => 'Zobraz jen po��te�n� datum'
	// User Settings
	,'user_settings_label' => 'Nastaven� u�ivatel�'
	,'allow_user_registration' => 'Povolit u�ivatel�m registraci'
	,'reg_duplicate_emails' => 'Povolit duplicitn� emaily'
	,'reg_email_verify' => 'Zapni aktivaci u�ivatelsk�ch ��t� p�es email'
// Event View
	,'event_view_label' => 'Zobraz ud�lost'
	,'popup_event_mode' => 'P�ekryt� ud�losti'
	,'popup_event_width' => '���ka Pop-up okna'
	,'popup_event_height' => 'V��ka Pop-up okna'
// Add Event View
	,'add_event_view_label' => 'P�idej ud�lost'
	,'add_event_view' => 'Zapnuto'
	,'addevent_allow_html' => 'Povol <b>HTML</b> popisy'
	,'addevent_allow_contact' => 'Povol kontakt'
	,'addevent_allow_email' => 'Povol email'
	,'addevent_allow_url' => 'Povol URL'
	,'addevent_allow_picture' => 'Povol obr�zky'
	,'new_post_notification' => 'Za�li email kdy� ud�losti vy�aduj� schv�len�'
// Calendar View
	,'calendar_view_label' => 'M�s��n� zobraten�'
	,'monthly_view' => 'Zapnuto'
	,'cal_view_show_week' => 'Zobraz po�et t�dn�'
	,'cal_view_max_chars' => 'Maxim�ln� po�et znak� v popisu'
// Flyer View
	,'flyer_view_label' => 'Letm� n�hled'
	,'flyer_view' => 'Zapnuto'
	,'flyer_show_picture' => 'Zobraz obr�zky v letm�m n�hledu'
	,'flyer_view_max_chars' => 'Maxim�ln� po�et znak� v popisu'
// Weekly View
	,'weekly_view_label' => 'T�denn� zobrazen�'
	,'weekly_view' => 'Zapnuto'
	,'weekly_view_max_chars' => 'Maxim�ln� po�et znak� v popisu'
// Daily View
	,'daily_view_label' => 'Denn� zobrazen�'
	,'daily_view' => 'Zapnuto'
	,'daily_view_max_chars' => 'Maxim�ln� po�et znak� v popisu'
// Categories View
	,'categories_view_label' => 'Zobrazen� kategori�'
	,'cats_view' => 'Zapnuto'
	,'cats_view_max_chars' => 'Maxim�ln� po�et znak� v popisu'
// Mini Calendar
	,'mini_cal_label' => 'Kalend��'
	,'mini_cal_def_picture' => 'Standardn� obr�zek'
	,'mini_cal_display_picture' => 'Zobraz obr�zek'
	,'mini_cal_diplay_options' => array('��dn�','Standarn� obr�zek', 'Denn� obr�zek','T�denn� obr�zek','N�hodn� obr�zek')
// Mail Settings
	,'mail_settings_label' => 'Nastaven� mailu'
	,'mail_method' => 'Metoda zas�l�n�'
	,'mail_smtp_host' => 'SMTP adresy (odd�lte st�en�kem ;)'
	,'mail_smtp_auth' => ' SMTP Autentizace'
	,'mail_smtp_username' => 'SMTP U�ivatelsk� jm�no'
	,'mail_smtp_password' => 'SMTP Heslo'

// Form Buttons
	,'update_config' => 'Ulo� novou konfiguraci'
	,'restore_config' => 'Obnov v�choz� nastaven�'
// Misc.
	,'update_settings_success' => 'Aktualizace nastaven� prob�hla �sp�n�'
	,'restore_default_confirm' => 'Jste si jist�, �e chcete obnovit v�choz� nastaven� ?'
// Template Configuration
	,'template_type' => 'Typ �ablony'
	,'template_header' => 'U�ivatelsk� z�hlav�'
	,'template_footer' => 'U�ivatelsk� z�pat�'
	,'template_status_default' => 'Pou�ij v�choz� �ablonu'
	,'template_status_custom' => 'Pou�ij n�sleduj�c� �ablonu:'
	,'template_custom' => 'U�ivatelsk� �ablona'

	,'info_meta' => 'Meta informace'
	,'info_status' => 'Status control'
	,'info_status_default' => 'Vypni tento obsah'
	,'info_status_custom' => 'Zobraz n�sleduj�c� obsah:'
	,'info_custom' => 'U�ivatelsk� obsah'

	,'dynamic_tags' => 'Dynamic Tags'

// Product Updates
	,'updates_check_text' => 'Pros�m po�kejte dokud se neobnov� informace ze serveru...'
	,'updates_no_response' => 'Server neodpov�d�. Zkuste n�v�t�vu pozd�ji.'
	,'avail_updates' => 'Dostupn� updaty'
	,'updates_download_zip' => 'St�hni ZIP bal��ek (.zip)'
	,'updates_download_tgz' => 'St�hni TGZ bal��ek (.tar.gz)'
	,'updates_released_label' => 'Datum vyd�n�: %s'
	,'updates_no_update' => 'Pou��v�te posledn� veri. Update nen� nutn�.'
);

// ======================================================
// cal_mini.inc.php
// ======================================================

$lang_mini_cal = array(
	'def_pic' => 'V�choz� obr�zek'
	,'daily_pic' => 'Obr�zek dne (%s)'
	,'weekly_pic' => 'Obr�zek t�dne (%s)'
	,'rand_pic' => 'N�hodn� obr�zek (%s)'
	,'post_event' => 'Vlo� novou ud�lost'
	,'num_events' => '%d Ud�lost(i)'
	,'selected_week' => 'T�den %d'
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
	'section_title' => 'P�ihl�en�'
// General Settings
	,'login_intro' => 'Pro p�ihl�en� zadej u�ivatelsk� jm�no a heslo'
	,'username' => 'U�ivatelsk� jm�no'
	,'password' => 'Heslo'
	,'remember_me' => 'Zapamatuj si mne'
	,'login_button' => 'P�ihl�en�'
// Errors
	,'invalid_login' => 'Zkontrolujte si p�ihla�ovac� informace a zkuste to znovu!'
	,'no_username' => 'Mus�te zadat u�ivatelsk� jm�no !'
	,'already_logged' => 'Ji� jste p�ihl�en !'
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
DEFINE('_EXTCAL_VERSION', 'Verze');
DEFINE('_EXTCAL_DATE', 'Datum');
DEFINE('_EXTCAL_AUTHOR', 'Autor');
DEFINE('_EXTCAL_AUTHOR_EMAIL', 'Autor E-Mail');
DEFINE('_EXTCAL_AUTHOR_URL', 'Autor URL');
DEFINE('_EXTCAL_PUBLISHED', 'Publikov�no');

//Plugins
DEFINE('_EXTCAL_THEME_PLUGIN', 'Motiv');
DEFINE('_EXTCAL_THEME_PLUGCOM', 'Motiv/P��kaz');
DEFINE('_EXTCAL_THEME_NAME', 'Jm�no');
DEFINE('_EXTCAL_THEME_HEADING', 'JCal Pro Motiv Mana�er');
DEFINE('_EXTCAL_THEME_FILTER', 'Filtr');
DEFINE('_EXTCAL_THEME_ACCESS_LIST', 'Seznam p��stup�');
DEFINE('_EXTCAL_THEME_ACCESS_LVL', 'P��stupov� �rove�');
DEFINE('_EXTCAL_THEME_CORE', 'J�dro');
DEFINE('_EXTCAL_THEME_DEFAULT', 'Standardn�');
DEFINE('_EXTCAL_THEME_ORDER', 'Po�ad�');
DEFINE('_EXTCAL_THEME_ROW', '��dek');
DEFINE('_EXTCAL_THEME_TYPE', 'Typ');
DEFINE('_EXTCAL_THEME_ICON', 'Ikony');
DEFINE('_EXTCAL_THEME_LAYOUT_ICON', 'Layout Icon');
DEFINE('_EXTCAL_THEME_DESC', 'Popis');
DEFINE('_EXTCAL_THEME_EDIT', 'Edit');
DEFINE('_EXTCAL_THEME_NEW', 'Nov�');
DEFINE('_EXTCAL_THEME_DETAILS', 'Detaily plugin�');
DEFINE('_EXTCAL_THEME_PARAMS', 'Parametry');
DEFINE('_EXTCAL_THEME_ELMS', 'Elementy');
//Plugin Installer
DEFINE('_EXTCAL_THEMES_INSTALL_HEADING','Instaluj nov� motiv');
DEFINE('_EXTCAL_THEMES_INSTALL_MSG', 'Jen zobrazen� motivy mohou b�t odinstalov�ny - Hlavn� motiv nem��e b�t odinstalov�n.');
DEFINE('_EXTCAL_THEME_NONE', 'Nejsou nainstalov�na ��dn� dopl�kov� motivy');

//Language Manager
DEFINE('_EXTCAL_LANG_HEADING', 'EXTCAL Jazykov� mana�er');
DEFINE('_EXTCAL_LANG_LANG', 'Jazyk');

//Language Installer
DEFINE('_EXTCAL_LANG_HEADING_INSTALL', 'Instaluj nov� EXTCAL jazyk');
DEFINE('_EXTCAL_LANG_BACK', 'N�vrat do jazykov�ho mana�eru');
//

//Global Installer
DEFINE('_EXTCAL_INS_PACKAGE_UPLOAD', 'Nahr�n� bal��ku');
DEFINE('_EXTCAL_INS_PACKAGE_FILE', 'Bal��ek');
DEFINE('_EXTCAL_INS_INSTALL', 'Instaluj z adres��e');
DEFINE('_EXTCAL_INS_INSTALL_DIR', 'Instala�n� adres��');
DEFINE('_EXTCAL_INS_UPLOAD_BUTTON', 'Nahraj soubor &amp; Instaluj');
DEFINE('_EXTCAL_INS_INSTALL_BUTTON', 'Instaluj');
?>
