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
	,'nativename' => 'Czech' // Language name in native language. E.g: 'Français' for 'French'
	,'locale' => array('cs_CZ','czech') // Standard locale alternatives for a specific language. For reference, go to: http://www.php.net/manual/en/function.setlocale.php
	,'charset' => 'ISO-8859-2' // For reference, go to : http://www.w3.org/International/O-charset-lang.html
	,'direction' => 'ltr' // 'ltr' for Left to Right. 'rtl' for Right to Left languages such as Arabic.
	,'author' => 'Tomá¹ Macnar'
	,'author_email' => 'info@rhkhradec.cz'
	,'author_url' => 'http://www.rhkhradec.cz'
 	,'transdate' => '20/12/2006'
);

$lang_general = array (
	'yes' => 'Ano'
	,'no' => 'Ne'
	,'back' => 'Zpìt'
	,'continue' => 'Pokraèuj'
	,'close' => 'Zavøi'
	,'errors' => 'Chyba'
	,'info' => 'Informace'
	,'day' => 'Den'
	,'days' => 'Dní'
	,'month' => 'Mìsíc'
	,'months' => 'Mìsícù'
	,'year' => 'Rok'
	,'years' => 'Rokù'
	,'hour' => 'Hodina'
	,'hours' => 'Hodin'
	,'minute' => 'Minuta'
	,'minutes' => 'Minut'
	,'everyday' => 'Ka¾dý den'
	,'everymonth' => 'Ka¾dý mìsíc'
	,'everyyear' => 'Ka¾dý rok'
	,'active' => 'Aktivní'
	,'not_active' => 'Neaktivní'
	,'today' => 'Dnes'
	,'signature' => 'Vytvoøil %s'
	,'expand' => 'Roz¹íøit'
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
	,'day_of_week' => array('Nedìle','Pondìlí','Úterý','Støeda','Ètvrtek','Pátek','Sobota')
	,'months' => array('Leden','Únor','Bøezen','Duben','Kvìten','Èerven','Èervenec','Srpen','Záøí','Øíjen','Listopad','Prosinec')
);

$lang_system = array (
	'system_caption' => 'Systémové hlá¹ení'
  ,'page_access_denied' => 'Nemáte potøebné oprávnìní pro pøístup k této volbì.'
  ,'page_requires_login' => 'Musíte být pøihlá¹ený.'
  ,'operation_denied' => 'Nemáte potøebné oprávnìní pro k vykonání této operace.'
	,'section_disabled' => 'Tato sekce je momentálnì nepøístupná !'
  ,'non_exist_cat' => 'Vybraná kategorie neexistuje !'
  ,'non_exist_event' => 'Vybraná událost neexistuje !'
  ,'param_missing' => 'Zadané údaje jsou neplatné.'
  ,'no_events' => 'Nejsou k zobrazení ¾ádné události'
  ,'config_string' => 'Právì pou¾íváte \'%s\' bì¾ících na %s, %s a %s.'
  ,'no_table' => 'Tato \'%s\' tabulka neexistuje !'
  ,'no_anonymous_group' => 'Tato %s tabulka neobsahuje \'Anonymous\' skupinu !'
  ,'calendar_locked' => 'Tato slu¾ba je doèasnì nedostupná z dùvodù údr¾by. Omlouváme se za vzniklé problémy !'
	,'new_upgrade' => 'Systém ohlásil novou verzi. Doporuèujeme provést upgrade. Klikni na "Pokraèovat" pro spu¹tìní upgradu.'
	,'no_profile' => 'Pøi vyvolání va¹eho profilu se vyskytla chyba'
	,'unknown_component' => 'Neznámá komponenta'
// Mail messages
	,'new_event_subject' => 'Událost vy¾aduje schválení %s'
	,'event_notification_failed' => 'Pøi odeslání potvrzujícího emailu se vyskytla chyba !'
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
	'login' => 'Pøihlá¹ení'
	,'register' => 'Registrace'
  ,'logout' => 'Logout <span style="color:#FF9922">[<span style="color:#606F79">%s</span>]</span>'
  ,'user_profile' => 'Mùj profil'
	,'admin_events' => 'Události'
  ,'admin_categories' => 'Kategorie'
  ,'admin_groups' => 'Skupiny'
  ,'admin_users' => 'U¾ivatelé'
  ,'admin_settings' => 'Nastavení'
);

// Main menu entries
$lang_main_menu = array (
	'add_event' => 'Pøidej událost'
	,'cal_view' => 'Mìsíèní pøehled'
  ,'flat_view' => 'Roz¹íøený pøehled'
  ,'weekly_view' => 'Týdenní pøehled'
  ,'daily_view' => 'Denní pøehled'
  ,'yearly_view' => 'Roèní pøehled'
  ,'categories_view' => 'Kategorie'
  ,'search_view' => 'Hledej'
);

// ======================================================
// Add Event view
// ======================================================

$lang_add_event_view = array(
	'section_title' => 'Pøidej událost'
	,'edit_event' => 'Uprav událost [id%d] \'%s\''
	,'update_event_button' => 'Aktualizuj událost'

// Event details
	,'event_details_label' => 'Podrobnosti o události'
	,'event_title' => 'Název události'
	,'event_desc' => 'Popis události'
	,'event_cat' => 'Kategorie'
	,'choose_cat' => 'Vyber kategorii'
	,'event_date' => 'Datum události'
	,'day_label' => 'Den'
	,'month_label' => 'Mìsíc'
	,'year_label' => 'Rok'
	,'start_date_label' => 'Doba zaèátku'
	,'start_time_label' => 'Od'
	,'end_date_label' => 'Trvání'
	,'all_day_label' => 'Celý den'
// Contact details
	,'contact_details_label' => 'Dateily kontaktu'
	,'contact_info' => 'Info o kontaktu'
	,'contact_email' => 'Email'
	,'contact_url' => 'URL'
// Repeat events
	,'repeat_event_label' => 'Opakuj událost'
	,'repeat_method_label' => 'Zpùsob opakování'
	,'repeat_none' => 'Neopakuj tuto událost'
	,'repeat_every' => 'Opakuj ka¾dých'
	,'repeat_days' => 'Dní'
	,'repeat_weeks' => 'Týdnù'
	,'repeat_months' => 'Mìsícù'
	,'repeat_years' => 'Rokù'
	,'repeat_end_date_label' => 'Opakuj koncové datum'
	,'repeat_end_date_none' => 'Bez data ukonèení'
	,'repeat_end_date_count' => 'Konec po %s opakování'
	,'repeat_end_date_until' => 'Opakuj dokud'
// Other details
	,'other_details_label' => 'Dal¹í detaily'
	,'picture_file' => 'Obrázek'
	,'file_upload_info' => '(%d KBytes limit - Valid extensions : %s )' 
	,'del_picture' => 'Vymazat aktuální obrázek ?'
// Administrative options
	,'admin_options_label' => 'Mo¾nosti administrátora'
	,'auto_appr_event' => 'Událost schválena'

// Error messages
	,'no_title' => 'Musíte zadat název události !'
	,'no_desc' => 'Musíte zadat popis události !'
	,'no_cat' => 'Musíte zadat kategorii z menu !'
	,'date_invalid' => 'Musíte zadat platný den události !'
	,'end_days_invalid' => 'Hodnota zadaná v poli \'Dni\' není platná !'
	,'end_hours_invalid' => 'Hodnota zadaná v poli \'Hodiny\' není platná !'
	,'end_minutes_invalid' => 'Hodnota zadaná v poli \'Minuty\' není platná !'
	,'move_image_failed' => 'Systémová chyba pøi nahrání obrázku. Zvolte správnou velikost nebo kontaktujte administrátora.'
	,'non_valid_dimensions' => '©íøka nebo bvý¹ka obrázku je vìt¹í o %s pixelù !'

	,'recur_val_1_invalid' => 'Zadaná hodnota \'interval opakování\' není platná. Hodnota musí být vìt¹í ne¾ \'0\' !'
	,'recur_end_count_invalid' => 'Zadaná hodnota \'poèet výskytù\' není platná. Hodnota musí být vìt¹í ne¾ \'0\' !'
	,'recur_end_until_invalid' => 'Hodnota datumu \'opakuj dokud\' musí být vìt¹í ne¾ výchozí datum !'
// Misc. messages
	,'submit_event_pending' => 'Va¹e událost byla vlo¾ena! <br/> Po kontrole administrátora bude publikována. <br/> Dìkujeme za vlo¾ení!'
	,'submit_event_approved' => 'Va¹e událost byla automaticky schválena. <br/> Dìkujeme za vlo¾ení !'
	,'event_repeat_msg' => 'Tato událost má nastavené opakování.'
	,'event_no_repeat_msg' => 'Tato událost se nebude opakovat.'
);

// ======================================================
// daily view
// ======================================================

$lang_daily_event_view = array(
	'section_title' => 'Denní pøehled'
	,'next_day' => 'Následující den'
	,'previous_day' => 'Pøedchozí den'
	,'no_events' => 'Pro tento den nebyla zadána ¾ádná událost.'
);

// ======================================================
// weekly view
// ======================================================

$lang_weekly_event_view = array(
	'section_title' => 'Týdenní pøehled'
	,'week_period' => '%s - %s'
	,'next_week' => 'Následující týden'
	,'previous_week' => 'Pøedchozí týden'
	,'selected_week' => '%d Týden'
	,'no_events' => 'V tomto týdnu nejsou ¾ádné události'
);

// ======================================================
// monthly view
// ======================================================

$lang_monthly_event_view = array(
	'section_title' => 'Mìsíèní pøehled'
	,'next_month' => 'Následující mìsíc'
	,'previous_month' => 'Pøedchozí mìsíc'
);

// ======================================================
// flat view
// ======================================================

$lang_flat_event_view = array(
	'section_title' => 'Roz¹íøený pøehled'
	,'week_period' => '%s - %s'
	,'next_month' => 'Následující mìsíc'
	,'previous_month' => 'Pøedchozí mìsíc'
	,'contact_info' => 'Kontakt info'
	,'contact_email' => 'Email'
	,'contact_url' => 'URL'
	,'no_events' => 'V tomto mìsíci nejsou ¾ádné události'
);

// ======================================================
// Event view
// ======================================================

$lang_event_view = array(
	'section_title' => 'Pøehled událostí'
	,'display_event' => 'Událost: \'%s\''
	,'cat_name' => 'Kategorie'
	,'event_start_date' => 'Datum'
	,'event_end_date' => 'A¾ do'
	,'event_duration' => 'Trvání'
	,'contact_info' => 'Kontakt info'
	,'contact_email' => 'Email'
	,'contact_url' => 'URL'
	,'no_event' => 'Neexistují ¾ádné události k zobrazení.'
	,'stats_string' => '<strong>%d</strong> Událostí celkem'
	,'edit_event' => 'Edituj událost'
	,'delete_event' => 'Sma¾ událost'
	,'delete_confirm' => 'Jste si jistý, ¾e chcete vymazat tuto událost ?'
	
);

// ======================================================
// Categories view
// ======================================================

$lang_cats_view = array(
	'section_title' => 'Pøehled kategorií'
	,'cat_name' => 'Název kategorie'
	,'total_events' => 'Celkem událostí'
	,'upcoming_events' => 'Oèekávané události'
	,'no_cats' => 'Neexistuje kategorie k zobrazení.'
	,'stats_string' => '<strong>%d</strong> událostí v <strong>%d</strong> kategorii (ích)'
);

// ======================================================
// Category Events view
// ======================================================

$lang_cat_events_view = array(
	'section_title' => 'Události pod \'%s\''
	,'event_name' => 'Název události'
	,'event_date' => 'Datum'
	,'no_events' => 'V kategorii nejsou ¾ádné události.'
	,'stats_string' => '<strong>%d</strong> Událostí celkem'
	,'stats_string1' => '<strong>%d</strong> událost(í) na <strong>%d</strong> stránce (stránkách)'
);

// ======================================================
// cal_search.php
// ======================================================

$lang_event_search_data = array(
	'section_title' => 'Hledej v kalendáøi',
	'search_results' => 'Hledej výsledky',
	'category_label' => 'Kategorie',
	'date_label' => 'Datum',
	'no_events' => 'V kategorii nejsou ¾ádné události.',
	'search_caption' => 'Napi¹ klíèové slovo...',
	'search_again' => 'Hledej znovu',
	'search_button' => 'Hledej',
// Misc.
	'no_results' => 'Nenalezen ¾ádný výsledek',	
// Stats
	'stats_string1' => '<strong>%d</strong> událost(í) nalezena (o)',
	'stats_string2' => '<strong>%d</strong> událost(í) na <strong>%d</strong> stránce (stránkách)'
);

// ======================================================
// profile.php
// ======================================================

if (defined('PROFILE_PHP')) 

$lang_user_profile_data = array(
	'section_title' => 'Mùj profil',
	'edit_profile' => 'Edituj mùj profil',
	'update_profile' => 'Aktualizuj mùj profil',
	'actions_label' => 'Akce',
// Account Info
	'account_info_label' => 'Informace o úètì',
	'user_name' => 'U¾ivatelské jméno',
	'user_pass' => 'Heslo',
	'user_pass_confirm' => 'Potvrï heslo',
	'user_email' => 'E-mailová adresa',
	'group_label' => 'Skupina èlenù',
// Other Details
	'other_details_label' => 'Dal¹í detaily',
	'first_name' => 'Jméno',
	'last_name' => 'Pøíjmení',
	'full_name' => 'Celé jméno',
	'user_website' => 'Výchozí stránka',
	'user_location' => 'Umístìní',
	'user_occupation' => 'Zamìstnání',
// Misc.
	'select_language' => 'Vyber jazyk',
	'edit_profile_success' => 'Profil byl úspì¹nì aktualizovaný.',
	'update_pass_info' => 'Pokud nechcete mìnit heslo nechte pole prázdné.',
// Error messages
	'invalid_password' => 'Prosím zadejte heslo obsahující jen písmena a èíslice s 4 a¾ 16 znaky !',
	'password_is_username' => 'Heslo musí být rozdílné od va¹eho pøihla¹ovacího jména !',
	'password_not_match' =>'Heslo není schodné',
	'invalid_email' => 'Musíte zadat platnou email adresu !',
	'email_exists' => 'Emailová adresa je ji¾ registrována jiným u¾ivatelem. Zadejte jinou !',
	'no_email' => 'Musíte zadat emailovou adresu !',
	'invalid_email' => 'Musíte zadat platnou email adresu !',
	'no_password' => 'K novému úètu musíte zadat heslo !'
);

// ======================================================
// register.php
// ======================================================

if (defined('USER_REGISTRATION_PHP')) 

$lang_user_registration_data = array(
	'section_title' => 'Registrace',
// Step 1: Terms & Conditions
	'terms_caption' => 'Podmínky',
	'terms_intro' => 'Pro pokraèování musíte souhlasit s následujícím:',
	'terms_message' => 'Prosím vìnujte pozornost následujícím pravidlùm. Pokud souhlasítea a chcete pokraèovat v registraci, kliknìte na tlaèítko "Souhlasím". Ke zru¹ení registrace, kliknìte na tlaèítko zpìt ve va¹em prohlí¾eèi.<br /><br />Uvìdomte si, ¾e nejsme odpovìdní za události vlo¾ené u¾ivateli do kalendáøe. Neruèíme za obsah, pøesnost, úplnnost a pou¾itelnost vlo¾ených událostí.<br /><br />Vlo¾ené zprávy vyjadøují pouze názory autorù. Pokud nìkterý z u¾ivatelù zjistí neobjektivnost èi nesprávnost vlo¾ených událostí, nech» se obrátí na administrátora. Máme mo¾nost tenty zprávy odtranit. <br /><br /> Pøi pou¾ívání této slu¾by se zavazujete k tomu, ¾e nebudete zneu¾ívat aplikaci k zasílání nepøesných a nesprávných informací, nebudete pou¾ívat vulgarizmy, urá¾ky, neslu¹né, rasistické a hanlivé výrazy, které odporují platné legislativì. <br /><br /> Dále souhlasíte, ¾e nebudete zveøejòovat informace, v rozporu s autorským zákonem. %s.',
	'terms_button' => 'Souhlasím',
	
// Account Info
	'account_info_label' => 'Informace o úètì',
	'user_name' => 'U¾ivatelské jméno',
	'user_pass' => 'Heslo',
	'user_pass_confirm' => 'Potvrï heslo',
	'user_email' => 'E-mailová adresa',
// Other Details
	'other_details_label' => 'Dal¹í detaily',
	'first_name' => 'Jméno',
	'last_name' => 'Pøíjmení',
	'user_website' => 'Výchozí stránka',
	'user_location' => 'Umístìní',
	'user_occupation' => 'Zamìstnání',
	'register_button' => 'Potvrï registraci',

// Stats
	'stats_string1' => '<strong>%d</strong> u¾ivatelé',
	'stats_string2' => '<strong>%d</strong> u¾ivatelù na <strong>%d</strong> stránce(stránkách)',
// Misc.
	'reg_nomail_success' => 'Dìkujeme za registraci.',
	'reg_mail_success' => 'Zpráva jak provést aktivaci úètu Vám byla zaslán na vá¹ email.',
	'reg_activation_success' => 'Gratulujeme! Vá¹ úèet je nyní zaktivován. <br/> Prosím pøihla¹te se. <br/> Dìkujeme za registraci!',
// Mail messages
	'reg_confirm_subject' => 'Registrace %s',
	
// Error messages
	'no_username' => 'Musíte zadat u¾ivatelské jméno !',
	'invalid_username' => 'Prosím zadejte u¾ivatelské jméno, které musí obsahovat pouze písmena a èíslice s maximální délkou 4 a¾  30 znakù !',
	'username_exists' => 'Vámi zadané u¾ivatelské jméno je ji¾ pou¾ito. Zadejte prosím jiné !',
	'no_password' => 'Musíte zadat heslo !',
	'invalid_password' => 'Prosím zadejte heslo obsahující pouze písmena a èíslice s maximální délkou 4 a¾ 16 znakù !',
	'password_is_username' => 'Heslo musí být odli¹né od u¾ivatelského jména !',
	'password_not_match' =>'Zadané heslo není stejné v èásti \'potvrïte heslo\'',
	'no_email' => 'Musíte zadat emailovou adresu !',
	'invalid_email' => 'Musíte zadat platnou emailovou adresu !',
	'email_exists' => 'Zadaný email je ji¾ pou¾íván. Zadejte prosím jiný !',
	'delete_user_failed' => 'U¾ivatelský úèet nemù¾e být odstranìn',
	'no_users' => 'Neexistuje ¾ádný u¾ivatelský úèet k zobrazení !',
	'already_logged' => 'Ji¾ jste pøihlá¹en jako èlen !',
	'registration_not_allowed' => 'U¾ivatelské registrace nejsou povoleny !',
	'reg_email_failed' => 'Nastala chyba pøi odeslání aktivaèního mailu !',
	'reg_activation_failed' => 'Nastala chyba pøi aktivaci va¹eho úètu !'

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
	'section_title' => 'Administrace událostí',
	'events_to_approve' => 'Administrace událostí: Události ke schválení',
	'upcoming_events' => 'Administrace událostí: Oèekávané události',
	'past_events' => 'Administrace událostí: Uplynulé události',
	'add_event' => 'Pøidat novou událost',
	'edit_event' => 'Editovat událost',
	'view_event' => 'Náhled události',
	'approve_event' => 'Schválení události',
	'update_event' => 'Aktualizuj událost',
	'delete_event' => 'Vyma¾ událost',
	'events_label' => 'Události',
	'auto_approve' => 'Automatické schválení',
	'date_label' => 'Datum',
	'actions_label' => 'Akce',
	'events_filter_label' => 'Filtr událostí',
	'events_filter_options' => array('Zobraz v¹echny události','Pouze neschválené události','Pouze oèekávané události','Pouze uplynulé události'),
	'picture_attached' => 'Obrázek pøilo¾en',
// View Event
	'view_event_name' => 'Událost: \'%s\'',
	'event_start_date' => 'Datum',
	'event_end_date' => 'Do',
	'event_duration' => 'Trvání',
	'contact_info' => 'Kontaktní info',
	'contact_email' => 'Email',
	'contact_url' => 'URL',
// General Info
// Event form
	'edit_event_title' => 'Událost: \'%s\'',
	'cat_name' => 'Kategoriy',
	'event_start_date' => 'Datum',
	'event_end_date' => 'DO',
	'contact_info' => 'Kontaktní info',
	'contact_email' => 'Email',
	'contact_url' => 'URL',
	'no_event' => 'Nejsou ¾ádné události k zobrazení.',
	'stats_string' => '<strong>%d</strong> Událostí celkem',
// Stats
	'stats_string1' => '<strong>%d</strong> událost(i)',
	'stats_string2' => 'Celkem: <strong>%d</strong> událost(í) na <strong>%d</strong> stránce (stránkách)',
// Misc.
	'add_event_success' => 'Událost úspì¹nì vlo¾ena',
	'edit_event_success' => 'Událost úspì¹nì atualizována',
	'approve_event_success' => 'Událost úspì¹nì schválena',
	'delete_confirm' => 'Jste si jisti, ¾e chcete událost smazat ?',
	'delete_event_success' => 'Událost úspì¹nì smazána',
	'active_label' => 'Aktivní',
	'not_active_label' => 'Neaktivní',
// Error messages
	'no_event_name' => 'Musíte zadat jméno události !',
	'no_event_desc' => 'Musíte zadat popis události !',
	'no_cat' => 'Musíte pro událost vybrat kategorii  !',
	'no_day' => 'Musíte vybrat den !',
	'no_month' => 'Musíte vybrat mìsíc !',
	'no_year' => 'Musíte vybrat rok !',
	'non_valid_date' => 'Zadejte platné datum !',
	'end_days_invalid' => 'Prosím ujistìte se, ¾e pole \'Dny\' pod \'Trváním\' obsahuje pouze èíslice !',
	'end_hours_invalid' => 'Prosím ujistìte se, ¾e pole \'Hodiny\' pod \'Trváním\' obsahuje pouze èíslice !',
	'end_minutes_invalid' => 'Prosím ujistìte se, ¾e pole \'Minuty\' pod \'Trváním\' obsahuje pouze èíslice  !',
	'delete_event_failed' => 'Událost nemù¾e být smazána !',
	'approve_event_failed' => 'Událost nemù¾e být schválena !',
	'no_events' => 'Nejsou ¾ádné události k zobrazení !',
	'recur_val_1_invalid' => 'Hodnota zadaná jako \'interval opakování\' není platná. Hodnota musí být vìt¹í ne¾ \'0\' !',
	'recur_end_count_invalid' => 'Hodnota zadaná jako \'poèet výskytù\' není platná. Hodnota musí být vìt¹í ne¾ \'0\' !',
	'recur_end_until_invalid' => 'Hodnota datumu \'opakuj dokud\' musí být vìt¹í ne¾ poèáteèní datum !'

);

// ======================================================
// admin_categories.php
// ======================================================

if (defined('ADMIN_CATS_PHP')) 

$lang_cat_admin_data = array(
	'section_title' => 'Administrace kategorií',
	'add_cat' => 'Pøidej novou kategorii',
	'edit_cat' => 'Uprav kategorii',
	'update_cat' => 'Aktualizuj informace o kategorii',
	'delete_cat' => 'Sma¾ kategorii',
	'events_label' => 'Události',
	'visibility' => 'Viditelnost',
	'actions_label' => 'Akce',
	'users_label' => 'U¾ivatelé',
	'admins_label' => 'Administrátoøi',
// General Info
	'general_info_label' => 'V¹eobecné informace',
	'cat_name' => 'Jméno kategorie',
	'cat_desc' => 'Popis kategorie',
	'cat_color' => 'Barva',
	'pick_color' => 'Vyber barvu!',
	'status_label' => 'Stav',
// Stats
	'stats_string1' => '<strong>%d</strong> kategorie',
	'stats_string2' => 'Aktivní: <strong>%d</strong>&nbsp;&nbsp;&nbsp;Celkem: <strong>%d</strong>&nbsp;&nbsp;&nbsp; na <strong>%d</strong> stránce(stránkách)',
// Misc.
	'add_cat_success' => 'Nová kategorie úspì¹nì pøidána',
	'edit_cat_success' => 'Aktualizace kategorie úspì¹nì provedena',
	'delete_confirm' => 'Jste si jisti, ¾e chcte kategorii vymazat ?',
	'delete_cat_success' => 'Kategorie úspì¹nì smazána',
	'active_label' => 'Aktivní',
	'not_active_label' => 'Neaktivní',
// Error messages
	'no_cat_name' => 'Musíte zadat název kategorie !',
	'no_cat_desc' => 'Musíte zadat popis kategorie !',
	'no_color' => 'Musíte zvolit barvu kategorie !',
	'delete_cat_failed' => 'Kategorie nemù¾e být vymazána',
	'no_cats' => 'Není ¾ádná kategorie k zobrazení !',
	'cat_has_events' => 'Kategorie obsahuje %d události(i)) a proto nemù¾e být smazána!<br>Vyma¾te prosím události z kategorie a zkuste smazat katagorii znovu!'

);
// ======================================================
// admin_users.php
// ======================================================

if (defined('ADMIN_USERS_PHP')) 

$lang_user_admin_data = array(
	'section_title' => 'Administrace u¾ivatelù',
	'add_user' => 'Pøidej nového u¾ivatele',
	'edit_user' => 'Uprav info o u¾ivateli',
	'update_user' => 'Aktualizuj info o u¾ivateli',
	'delete_user' => 'Vyma¾ úèet u¾ivatele',
	'last_access' => 'Poslední pøístup',
	'actions_label' => 'Akce',
	'active_label' => 'Aktivní',
	'not_active_label' => 'Neaktivní',
// Account Info
	'account_info_label' => 'Informace o úètì',
	'user_name' => 'U¾ivatelské jméno',
	'user_pass' => 'Heslo',
	'user_pass_confirm' => 'Potvrï heslo',
	'user_email' => 'E-mailová adresa',
	'group_label' => 'Skupina èlenù',
	'status_label' => 'Stav úètu',
// Other Details
	'other_details_label' => 'Dal¹í detaily',
	'first_name' => 'Jméno',
	'last_name' => 'Pøíjmení',
	'user_website' => 'Výchozí stránka',
	'user_location' => 'Místo',
	'user_occupation' => 'Zamìstnání',
// Stats
	'stats_string1' => '<strong>%d</strong> u¾ivatelé',
	'stats_string2' => '<strong>%d</strong> u¾ivatel(ù) na <strong>%d</strong> stránce(stránkách)',
// Misc.
	'select_group' => 'Vyber jednoho...',
	'add_user_success' => 'U¾ivatelský úèet byl úspì¹nì pøidán',
	'edit_user_success' => 'U¾ivatelský úèet byl úspì¹nì aktualizován',
	'delete_confirm' => 'Jste si jisti, ¾e chcete u¾ivatelský úèet vymazat?',
	'delete_user_success' => 'U¾ivatelský úèet byl úspì¹nì vymazám',
	'update_pass_info' => 'Pokud nechcete mìnit heslo nechte pole prázdné.',
	'access_never' => 'Nikdy',
// Error messages
	'no_username' => 'Musíte zadat u¾ivatelské jméno !',
	'invalid_username' => 'Prosím zadejte u¾ivatelské jméno, které musí obsahovat pouze písmena a èíslice s maximální délkou 4 a¾  30 znakù !',
	'invalid_password' => 'Prosím zadejte heslo obsahující pouze písmena a èíslice s maximální délkou 4 a¾ 16 znakù !',
	'password_is_username' => 'Heslo musí být odli¹né od u¾ivatelského jména !',
	'password_not_match' =>'Zadané heslo není stejné v èásti \'potvrïte heslo\'',
	'invalid_email' => 'Musíte zadat platnou emailovou adresu !',
	'email_exists' => 'Emailová adresa je ji¾ registrována jiným u¾ivatelem. Zadejte jinou !',
	'username_exists' => 'Vámi zadané u¾ivatelské jméno je ji¾ pou¾ito. Zadejte prosím jiné !',
	'no_email' => 'Musíte zadat emailovou adresu !',
	'invalid_email' => 'Musíte zadat platný email !',
	'no_password' => 'Musíte zadat heslo k Va¹emu úètu !',
	'no_group' => 'Prosím vyberte skupinu pro tohoto u¾ivatele !',
	'delete_user_failed' => 'U¾ivatelský úèet nemù¾e být smazán',
	'no_users' => 'Nejsou ¾ádné u¾ivatelské úèty k zobrazení !'

);

// ======================================================
// admin_groups.php
// ======================================================

if (defined('ADMIN_GROUPS_PHP')) 

$lang_group_admin_data = array(
	'section_title' => 'Administrace skupiny',
	'add_group' => 'Pøidej novou skupinu',
	'edit_group' => 'Uprav skupinu',
	'update_group' => 'Aktualizuj info o skupinì',
	'delete_group' => 'Vyma¾ skupinu',
	'view_group' => 'Zobraz skupinu',
	'users_label' => 'Èlenové',
	'actions_label' => 'Akce',
// General Info
	'general_info_label' => 'V¹eobecné informace',
	'group_name' => 'Jméno skupiny',
	'group_desc' => 'Popis skupiny',
// Group Access Level
	'access_level_label' => 'Úroveò pøístupových práv',
	'Administrator' => 'U¾ivatelé v této skupinì mají administrátorský pøístup',
	'can_manage_accounts' => 'U¾ivatelé v této skupinì mohou spravovat úèty',
	'can_change_settings' => 'U¾ivatelé v této skupinì mohou mìnit nastavení kalendáøe',
	'can_manage_cats' => 'U¾ivatelé v této skupinì mohou spravovat kategorie',
	'upl_need_approval' => 'Pøidané události vy¾adují schválení administrátora',
// Stats
	'stats_string1' => '<strong>%d</strong> skupiny',
	'stats_string2' => 'Celkem: <strong>%d</strong> skupin na <strong>%d</strong> stránce(stránkách)',
	'stats_string3' => 'Celkem: <strong>%d</strong> u¾ivatelù na <strong>%d</strong> stránce(stránkách)',
// View Group Members
	'group_members_string' => 'Èlen \'%s\' skupiny',
	'username_label' => 'U¾ivatelské jméno',
	'firstname_label' => 'Jméno',
	'lastname_label' => 'Pøíjmení',
	'email_label' => 'Email',
	'last_access_label' => 'Poslední pøístup',
	'edit_user' => 'Uprav u¾ivatele',
	'delete_user' => 'Sma¾ u¾ivatele',
// Misc.
	'add_group_success' => 'Nová skupina úspì¹nì pøidána',
	'edit_group_success' => 'Aktualizace skupiny probìhla úspì¹nì',
	'delete_confirm' => 'Jste si jistí, ¾e chcete skupinu smazat ?',
	'delete_user_confirm' => 'Jste si jistí, ¾e chcete skupinu smazat ?',
	'delete_group_success' => 'Skupina úspì¹nì smazána',
	'no_users_string' => 'Ve skupinì nejsou ¾ádní u¾ivatelé',
// Error messages
	'no_group_name' => 'Musíte zadat jméno skupiny !',
	'no_group_desc' => 'Musíte zadat popis skupiny !',
	'delete_group_failed' => 'Skupina nemù¾e být vymazána',
	'no_groups' => 'Nejsou ¾ádné skupiny k zobrazení !',
	'group_has_users' => 'Skupina obsahuje %d u¾ivatele(ù) a proto nemù¾e být smazána!<br>Prosím odstraòte u¾ivatele ze skupiny a zkuste to znovu!'

);

// ======================================================
// admin_settings.php / admin_settings_template.php / 
// admin_settings_updates.php
// ======================================================

$lang_settings_data = array(
	'section_title' => 'Nastavení kalendáøe'
// Links
	,'admin_links_text' => 'Vyber sekci'
	,'admin_links' => array('Hlavní nastavení','Nastav ¹ablonu','Aktualizace')
// General Settings
	,'general_settings_label' => 'V¹eobecné'
	,'calendar_name' => 'Jméno kalendáøe'
	,'calendar_description' => 'Popis kalendáøe'
	,'calendar_admin_email' => 'Email administrátora kalendáøe'
	,'cookie_name' => 'Jméno cookie pou¾ívaných scripty'
	,'cookie_path' => 'Cesta cookie pou¾ívaných scripty'
	,'debug_mode' => 'Zapni ladící re¾im'
	,'calendar_status' => 'Stav publikování kalendáøe'
// Environment Settings
	,'env_settings_label' => 'Prostøedí'
	,'lang' => 'Jazyk'
		,'lang_name' => 'Název jazyka'
		,'lang_native_name' => 'Národnost'
		,'lang_trans_date' => 'Pøelo¾il:'
		,'lang_author_name' => 'Autor'
		,'lang_author_email' => 'E-mail'
		,'lang_author_url' => 'Website'
	,'charset' => 'Kódová stránka'
	,'theme' => 'Motiv'
		,'theme_name' => 'Jméno motivu'
		,'theme_date_made' => 'Vyrobeno'
		,'theme_author_name' => 'Autor'
		,'theme_author_email' => 'E-mail'
		,'theme_author_url' => 'Website'
	,'timezone' => 'Èasová zóna'
	,'time_format' => 'Formát èasu'
		,'24hours' => '24 hodinový'
		,'12hours' => '12 hodinový'
	,'auto_daylight_saving' => 'Automatické nastavení (DST)'
	,'main_table_width' => '©íøka hlavní tabulky (pixely nebo %)'
	,'day_start' => 'Týden zaèíná'
	,'default_view' => 'Standardní zobrazení'
	,'search_view' => 'Povol vyhledávání'
	,'archive' => 'Uka¾ uplynulé události'
	,'events_per_page' => 'Poèet událostí na stránku'
	,'sort_order' => 'Øadit dle'
		,'sort_order_title_a' => 'Název vzestupnì'
		,'sort_order_title_d' => 'Název sestupnì'
		,'sort_order_date_a' => 'Datum vzestupnì'
		,'sort_order_date_d' => 'Datum sestupnì'
	,'show_recurrent_events' => 'Zobraz opakující se události'
	,'multi_day_events' => 'Více-denní události'
		,'multi_day_events_all' => 'Zobraz rozsah datumu'
		,'multi_day_events_bounds' => 'Zobraz jen poèáteèní a koneèné datumu'
		,'multi_day_events_start' => 'Zobraz jen poèáteèní datum'
	// User Settings
	,'user_settings_label' => 'Nastavení u¾ivatelù'
	,'allow_user_registration' => 'Povolit u¾ivatelùm registraci'
	,'reg_duplicate_emails' => 'Povolit duplicitní emaily'
	,'reg_email_verify' => 'Zapni aktivaci u¾ivatelských úètù pøes email'
// Event View
	,'event_view_label' => 'Zobraz událost'
	,'popup_event_mode' => 'Pøekrytí události'
	,'popup_event_width' => '©íøka Pop-up okna'
	,'popup_event_height' => 'Vý¹ka Pop-up okna'
// Add Event View
	,'add_event_view_label' => 'Pøidej událost'
	,'add_event_view' => 'Zapnuto'
	,'addevent_allow_html' => 'Povol <b>HTML</b> popisy'
	,'addevent_allow_contact' => 'Povol kontakt'
	,'addevent_allow_email' => 'Povol email'
	,'addevent_allow_url' => 'Povol URL'
	,'addevent_allow_picture' => 'Povol obrázky'
	,'new_post_notification' => 'Za¹li email kdy¾ události vy¾adují schválení'
// Calendar View
	,'calendar_view_label' => 'Mìsíèní zobratení'
	,'monthly_view' => 'Zapnuto'
	,'cal_view_show_week' => 'Zobraz poèet týdnù'
	,'cal_view_max_chars' => 'Maximální poèet znakù v popisu'
// Flyer View
	,'flyer_view_label' => 'Letmý náhled'
	,'flyer_view' => 'Zapnuto'
	,'flyer_show_picture' => 'Zobraz obrázky v letmém náhledu'
	,'flyer_view_max_chars' => 'Maximální poèet znakù v popisu'
// Weekly View
	,'weekly_view_label' => 'Týdenní zobrazení'
	,'weekly_view' => 'Zapnuto'
	,'weekly_view_max_chars' => 'Maximální poèet znakù v popisu'
// Daily View
	,'daily_view_label' => 'Denní zobrazení'
	,'daily_view' => 'Zapnuto'
	,'daily_view_max_chars' => 'Maximální poèet znakù v popisu'
// Categories View
	,'categories_view_label' => 'Zobrazení kategorií'
	,'cats_view' => 'Zapnuto'
	,'cats_view_max_chars' => 'Maximální poèet znakù v popisu'
// Mini Calendar
	,'mini_cal_label' => 'Kalendáø'
	,'mini_cal_def_picture' => 'Standardní obrázek'
	,'mini_cal_display_picture' => 'Zobraz obrázek'
	,'mini_cal_diplay_options' => array('®ádný','Standarní obrázek', 'Denní obrázek','Týdenní obrázek','Náhodný obrázek')
// Mail Settings
	,'mail_settings_label' => 'Nastavení mailu'
	,'mail_method' => 'Metoda zasílání'
	,'mail_smtp_host' => 'SMTP adresy (oddìlte støeníkem ;)'
	,'mail_smtp_auth' => ' SMTP Autentizace'
	,'mail_smtp_username' => 'SMTP U¾ivatelské jméno'
	,'mail_smtp_password' => 'SMTP Heslo'

// Form Buttons
	,'update_config' => 'Ulo¾ novou konfiguraci'
	,'restore_config' => 'Obnov výchozí nastavení'
// Misc.
	,'update_settings_success' => 'Aktualizace nastavení probìhla úspì¹nì'
	,'restore_default_confirm' => 'Jste si jistí, ¾e chcete obnovit výchozí nastavení ?'
// Template Configuration
	,'template_type' => 'Typ ¹ablony'
	,'template_header' => 'U¾ivatelské záhlaví'
	,'template_footer' => 'U¾ivatelské zápatí'
	,'template_status_default' => 'Pou¾ij výchozí ¹ablonu'
	,'template_status_custom' => 'Pou¾ij následující ¹ablonu:'
	,'template_custom' => 'U¾ivatelská ¹ablona'

	,'info_meta' => 'Meta informace'
	,'info_status' => 'Status control'
	,'info_status_default' => 'Vypni tento obsah'
	,'info_status_custom' => 'Zobraz následující obsah:'
	,'info_custom' => 'U¾ivatelský obsah'

	,'dynamic_tags' => 'Dynamic Tags'

// Product Updates
	,'updates_check_text' => 'Prosím poèkejte dokud se neobnoví informace ze serveru...'
	,'updates_no_response' => 'Server neodpovídá. Zkuste náv¹tìvu pozdìji.'
	,'avail_updates' => 'Dostupné updaty'
	,'updates_download_zip' => 'Stáhni ZIP balíèek (.zip)'
	,'updates_download_tgz' => 'Stáhni TGZ balíèek (.tar.gz)'
	,'updates_released_label' => 'Datum vydání: %s'
	,'updates_no_update' => 'Pou¾íváte poslední veri. Update není nutný.'
);

// ======================================================
// cal_mini.inc.php
// ======================================================

$lang_mini_cal = array(
	'def_pic' => 'Výchozí obrázek'
	,'daily_pic' => 'Obrázek dne (%s)'
	,'weekly_pic' => 'Obrázek týdne (%s)'
	,'rand_pic' => 'Náhodný obrázek (%s)'
	,'post_event' => 'Vlo¾ novou událost'
	,'num_events' => '%d Událost(i)'
	,'selected_week' => 'Týden %d'
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
	'section_title' => 'Pøihlá¹ení'
// General Settings
	,'login_intro' => 'Pro pøihlá¹ení zadej u¾ivatelské jméno a heslo'
	,'username' => 'U¾ivatelské jméno'
	,'password' => 'Heslo'
	,'remember_me' => 'Zapamatuj si mne'
	,'login_button' => 'Pøihlá¹ení'
// Errors
	,'invalid_login' => 'Zkontrolujte si pøihla¹ovací informace a zkuste to znovu!'
	,'no_username' => 'Musíte zadat u¾ivatelské jméno !'
	,'already_logged' => 'Ji¾ jste pøihlá¹en !'
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
DEFINE('_EXTCAL_PUBLISHED', 'Publikováno');

//Plugins
DEFINE('_EXTCAL_THEME_PLUGIN', 'Motiv');
DEFINE('_EXTCAL_THEME_PLUGCOM', 'Motiv/Pøíkaz');
DEFINE('_EXTCAL_THEME_NAME', 'Jméno');
DEFINE('_EXTCAL_THEME_HEADING', 'JCal Pro Motiv Mana¾er');
DEFINE('_EXTCAL_THEME_FILTER', 'Filtr');
DEFINE('_EXTCAL_THEME_ACCESS_LIST', 'Seznam pøístupù');
DEFINE('_EXTCAL_THEME_ACCESS_LVL', 'Pøístupová úroveò');
DEFINE('_EXTCAL_THEME_CORE', 'Jádro');
DEFINE('_EXTCAL_THEME_DEFAULT', 'Standardní');
DEFINE('_EXTCAL_THEME_ORDER', 'Poøadí');
DEFINE('_EXTCAL_THEME_ROW', 'Øádek');
DEFINE('_EXTCAL_THEME_TYPE', 'Typ');
DEFINE('_EXTCAL_THEME_ICON', 'Ikony');
DEFINE('_EXTCAL_THEME_LAYOUT_ICON', 'Layout Icon');
DEFINE('_EXTCAL_THEME_DESC', 'Popis');
DEFINE('_EXTCAL_THEME_EDIT', 'Edit');
DEFINE('_EXTCAL_THEME_NEW', 'Nový');
DEFINE('_EXTCAL_THEME_DETAILS', 'Detaily pluginù');
DEFINE('_EXTCAL_THEME_PARAMS', 'Parametry');
DEFINE('_EXTCAL_THEME_ELMS', 'Elementy');
//Plugin Installer
DEFINE('_EXTCAL_THEMES_INSTALL_HEADING','Instaluj nový motiv');
DEFINE('_EXTCAL_THEMES_INSTALL_MSG', 'Jen zobrazené motivy mohou být odinstalovány - Hlavní motiv nemù¾e být odinstalován.');
DEFINE('_EXTCAL_THEME_NONE', 'Nejsou nainstalována ¾ádné doplòkové motivy');

//Language Manager
DEFINE('_EXTCAL_LANG_HEADING', 'EXTCAL Jazykový mana¾er');
DEFINE('_EXTCAL_LANG_LANG', 'Jazyk');

//Language Installer
DEFINE('_EXTCAL_LANG_HEADING_INSTALL', 'Instaluj nový EXTCAL jazyk');
DEFINE('_EXTCAL_LANG_BACK', 'Návrat do jazykového mana¾eru');
//

//Global Installer
DEFINE('_EXTCAL_INS_PACKAGE_UPLOAD', 'Nahrání balíèku');
DEFINE('_EXTCAL_INS_PACKAGE_FILE', 'Balíèek');
DEFINE('_EXTCAL_INS_INSTALL', 'Instaluj z adresáøe');
DEFINE('_EXTCAL_INS_INSTALL_DIR', 'Instalaèní adresáø');
DEFINE('_EXTCAL_INS_UPLOAD_BUTTON', 'Nahraj soubor &amp; Instaluj');
DEFINE('_EXTCAL_INS_INSTALL_BUTTON', 'Instaluj');
?>
