<?PHP

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

Revision date: 03/06/2007

**********************************************
Get the latest version of JCal Pro at:
http://dev.anything-digital.com//
**********************************************
*/

/** ensure this file is being included by a parent file */
defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );

// New language structure
$lang_info = array (
	'name' => 'Catalan'
	,'nativename' => 'Catal�' // Language name in native language. E.g: 'Fran�ais' for 'French'
	,'locale' => array('ca','catalan') // Standard locale alternatives for a specific language. For reference, go to: http://www.php.net/manual/en/function.setlocale.php
	,'charset' => 'ISO-8859-1' // For reference, go to : http://www.w3.org/International/O-charset-lang.html
	,'direction' => 'ltr' // 'ltr' for Left to Right. 'rtl' for Right to Left languages such as Arabic.
	,'author' => 'Toni "Estil Web"'
	,'author_email' => 'info@estilweb.net'
	,'author_url' => 'http://www.estilweb.net'
	,'transdate' => '03/06/2007'
);

$lang_general = array (
	'yes' => 'Si'
	,'no' => 'No'
	,'back' => 'Enrrera'
	,'continue' => 'Continuar'
	,'close' => 'Tancar'
	,'errors' => 'Errors'
	,'info' => 'Informaci�'
	,'day' => 'Dia'
	,'days' => 'Dies'
	,'month' => 'Mes'
	,'months' => 'Mesos'
	,'year' => 'Any'
	,'years' => 'Anys'
	,'hour' => 'Hora'
	,'hours' => 'Hores'
	,'minute' => 'Minut'
	,'minutes' => 'Minuts'
	,'everyday' => 'Cada Dia'
	,'everymonth' => 'Cada Mes'
	,'everyyear' => 'Cada Any'
	,'active' => 'Actiu'
	,'not_active' => 'No Actiu'
	,'today' => 'Avui'
	,'signature' => 'Escrit per %s'
	,'expand' => 'Expandir'
	,'collapse' => 'Contraure'
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
	,'day_of_week' => array('Diumenge','Dilluns','Dimarts','Dimecres','Dijous','Divendres','Dissabte')
	,'day_of_week_mini' => array('Dm','Dl','Dm','Dc','Dj','Dv','Ds') // Nom�s en cas d'utilitzar el m�dul jcalpro_minical, s'ha de sustituir a on posa: ['day_of_week'] per ['day_of_week_mini'] (linia 407)
	,'months' => array('Gener','Febrer','Mar�','Abril','Maig','Juny','Juliol','Agost','Setembre','Octubre','Novembre','Desembre')
);

$lang_system = array (
	'system_caption' => 'Missatge del Sistema'
  ,'page_access_denied' => 'No t� suficients privilegis per accedir a aquesta p�gina.'
  ,'page_requires_login' => 'Ha d\'haver ingressat per accedir a aquesta p�gina.'
  ,'operation_denied' => 'No t� suficients privilegis per realitzar aquesta operaci�.'
	,'section_disabled' => 'Aquesta secci� est� actualmente deshabilitada!'
  ,'non_exist_cat' => 'La categoria seleccionada no existeix !'
  ,'non_exist_event' => 'L\'esdeveniment seleccionat no existeix !'
  ,'param_missing' => 'Els par�metres previstos son incorrectes.'
  ,'no_events' => 'No hi ha esdeveniments per mostrar'
  ,'config_string' => 'Actualment est� fent sevir \'%s\' funcionant sobre %s, %s y %s.'
  ,'no_table' => 'La \'%s\' taula no existeix !'
  ,'no_anonymous_group' => 'La %s taula no cont� el grup \'Anonymous\' !'
  ,'calendar_locked' => 'Aquest servei est� temporalment deshabilitat per mantenimient i millores. Disculpeu els inconvenients ocasionats !'
	,'new_upgrade' => 'El sistema ha detectat una nova versi�. Es recomana executar l\'actualitzaci� ara. Premeu sobre "Continuar" per actualitzar.'
	,'no_profile' => 'Hi ha hagut un error mentres recuper�vem la seva informaci� de perfil'
// Mail messages
	,'new_event_subject' => 'Nou Esdeveniment el %s'
	,'event_notification_failed' => 'Hi ha hagut un error mentre s\'enviava un correo de notificaci� !'
);

// Message body for new event email notification
$lang_system['event_notification_body'] = <<<EOT
El seg�ent esdeveniment ha estat agregat al {CALENDAR_NAME}

T�tol: "{TITLE}"
Data: "{DATE}"
Duraci�: "{DURATION}"

Pot accedir a aquest esdeveniment prement sobre el seg�ent link o copiant i enganxant al seu navegador

{LINK}

Que tingui un bon dia,

El seu equip de {CALENDAR_NAME}

EOT;

// Admin menu entries
$lang_admin_menu = array (
	'login' => 'Ingressar'
	,'register' => 'Registre'
  ,'logout' => 'Sortir <span style="color:#FF9922">[<span style="color:#606F79">%s</span>]</span>'
  ,'user_profile' => 'Perfil'
	,'admin_events' => 'Esdeveniments'
  ,'admin_categories' => 'Categories'
  ,'admin_groups' => 'Grups'
  ,'admin_users' => 'Usuaris'
  ,'admin_settings' => 'Configuracions'
);

// Main menu entries
$lang_main_menu = array (
	'add_event' => 'Afegir Esdeveniment'
	,'cal_view' => 'Vista Mensual'
  ,'flat_view' => 'Vista Plana'
  ,'weekly_view' => 'Vista Setmanal'
  ,'daily_view' => 'Vista Diaria'
  ,'yearly_view' => 'Vista Anual'
  ,'categories_view' => 'Categories'
  ,'search_view' => 'Cercar'
);

// ======================================================
// Add Event view
// ======================================================

$lang_add_event_view = array(
	'section_title' => 'Afegir Esdeveniment'
	,'edit_event' => 'Editar esdeveniment [id%d] \'%s\''
	,'update_event_button' => 'Modificar Esdeveniment'

// Event details
	,'event_details_label' => 'Detalls Esdeveniment'
	,'event_title' => 'T�tol Esdeveniment'
	,'event_desc' => 'Descripci� Esdeveniment'
	,'event_cat' => 'Categoria'
	,'choose_cat' => 'Seleccioni una categoria'
	,'event_date' => 'Data Esdeveniment'
	,'day_label' => 'Dia'
	,'month_label' => 'Mes'
	,'year_label' => 'Any'
	,'start_date_label' => 'Hora Inici'
	,'start_time_label' => 'A'
	,'end_date_label' => 'Duraci�'
	,'all_day_label' => 'Tot el dia'
// Contact details
	,'contact_details_label' => 'Detalls Contacte'
	,'contact_info' => 'Infomaci� Contacte'
	,'contact_email' => 'Email'
	,'contact_url' => 'URL'
// Repeat events
	,'repeat_event_label' => 'Repetir Esdeveniment'
	,'repeat_method_label' => 'Repetir M�tode'
	,'repeat_none' => 'No repetir aquest esdeveniment'
	,'repeat_every' => 'Repetir cada'
	,'repeat_days' => 'Dia(es)'
	,'repeat_weeks' => 'Setmana(es)'
	,'repeat_months' => 'Mes(os)'
	,'repeat_years' => 'Any(s)'
	,'repeat_end_date_label' => 'Repetir fins la Data'
	,'repeat_end_date_none' => 'Sense data Final'
	,'repeat_end_date_count' => 'Fi despr�s de %s ocurr�ncia(es)'
	,'repeat_end_date_until' => 'Repetir fins'
// Other details
	,'other_details_label' => 'Altres Detalls'
	,'picture_file' => 'Arxiu d\'Imatge'
	,'file_upload_info' => '(%d KBytes l�mit- Extensions v�lides : %s )' 
	,'del_picture' => 'Eliminar imatge actual ?'
// Administrative options
	,'admin_options_label' => 'Opcions Administratives'
	,'auto_appr_event' => 'Esdeveniment Aprovat'

// Error messages
	,'no_title' => 'Ha d\'escriure un t�tol d\'esdeveniment !'
	,'no_desc' => 'Ha d\'escriure una descripci� per aquest esdeveniment !'
	,'no_cat' => 'Ha de seleccionar una categoria desde el menu expandible !'
	,'date_invalid' => 'Ha d\'escriure una data v�lida per aquest esdeveniment !'
	,'end_days_invalid' => 'El valor ingressat en el camp \'Dies\' no �s v�lid !'
	,'end_hours_invalid' => 'El valor ingressat en el camp \'Hores\' no �s v�lid !'
	,'end_minutes_invalid' => 'El valor ingressat en el camp \'Minuts\' no �s v�lid !'

	,'non_valid_extension' => 'El format de l\'arxiu de la imatge adjunta no est� soportat ! (Extensions v�lides: %s)'

	,'file_too_large' => 'La imatge adjunta �s mes gran de %d KBytes !'
	,'move_image_failed' => 'El sistema ha fallat al moure la imatge carregada !'
	,'non_valid_dimensions' => 'L\'ample o l\'alt de la imatge �s mes gran de %s pixels !'

	,'recur_val_1_invalid' => 'El valor ingressat com \'interval de repetici�\' no �s v�lid. Aquest valor ha de ser un n�mero mes gran de \'0\' !'
	,'recur_end_count_invalid' => 'El valor ingressat com \'n�mero d\'ocurrencies\' no �s v�lid. Aquest valor ha de ser un n�mero mes gran de \'0\' !'
	,'recur_end_until_invalid' => 'La data \'repetir fins\' ha de ser mes gran que la data d\'inici de l\'esdeveniment !'
// Misc. messages
	,'submit_event_pending' => 'El seu esdeveniment est� pendent d\'aprobaci�. Gracies per enviar-lo!'
	,'submit_event_approved' => 'El seu esdeveniment ha estat autom�ticament aprovat. Gracies per enviar-lo!'
	,'event_repeat_msg' => 'Aquest esdeveniment es repeteix'
	,'event_no_repeat_msg' => 'Aquest esdeveniment no es repeteix'
);

// ======================================================
// daily view
// ======================================================

$lang_daily_event_view = array(
	'section_title' => 'Vista Diaria'
	,'next_day' => 'Pr�xim dia'
	,'previous_day' => 'Dia previ'
	,'no_events' => 'No hi ha esdeveniments aquest dia'
);

// ======================================================
// weekly view
// ======================================================

$lang_weekly_event_view = array(
	'section_title' => 'Vista Setmanal'
	,'week_period' => '%s - %s'
	,'next_week' => 'Pr�xima setmana'
	,'previous_week' => 'Setmana previa'
	,'selected_week' => 'Setmana %d'
	,'no_events' => 'No hi ha esdeveniments aquesta setmana'
);

// ======================================================
// monthly view
// ======================================================

$lang_monthly_event_view = array(
	'section_title' => 'Vista Mensual'
	,'next_month' => 'Pr�ximo mes'
	,'previous_month' => 'Mes previ'
);

// ======================================================
// flat view
// ======================================================

$lang_flat_event_view = array(
	'section_title' => 'Vista Plana'
	,'week_period' => '%s - %s'
	,'next_month' => 'Pr�ximo mes'
	,'previous_month' => 'Mes previ'
	,'contact_info' => 'Informaci� Contacte'
	,'contact_email' => 'Email'
	,'contact_url' => 'URL'
	,'no_events' => 'No hi ha esdeveniments aquest mes'
);

// ======================================================
// Event view
// ======================================================

$lang_event_view = array(
	'section_title' => 'Vista Esdeveniments'
	,'display_event' => 'Esdeveniment: \'%s\''
	,'cat_name' => 'Categoria'
	,'event_start_date' => 'Data'
	,'event_end_date' => 'Fins'
	,'event_duration' => 'Duraci�'
	,'contact_info' => 'Informaci� Contact'
	,'contact_email' => 'Email'
	,'contact_url' => 'URL'
	,'no_event' => 'No hi ha esdeveniments per mostrar'
	,'stats_string' => '<strong>%d</strong> Total Esdeveniments'
	,'edit_event' => 'Editar Esdeveniment'
	,'delete_event' => 'Eliminar Esdeveniment'
	,'delete_confirm' => 'Est� segur que vol eliminar aquest esdeveniment ?'
	
);

// ======================================================
// Categories view
// ======================================================

$lang_cats_view = array(
	'section_title' => 'Vista Categories'
	,'cat_name' => 'Nom Categoria'
	,'total_events' => 'Esdeveniments Totals'
	,'upcoming_events' => 'Pr�xims Esdeveniments'
	,'no_cats' => 'No hi ha categories per mostrar.'
	,'stats_string' => 'Hi ha <strong>%d</strong> Esdeveniments en la Categoria <strong>%d</strong>'
);

// ======================================================
// Category Events view
// ======================================================

$lang_cat_events_view = array(
	'section_title' => 'Esdeveniments sota \'%s\''
	,'event_name' => 'Nom de l\'Esdeveniment'
	,'event_date' => 'Data'
	,'no_events' => 'No hi ha esdeveniments en aquesta categoria.'
	,'stats_string' => '<strong>%d</strong> Esdeveniments en Total'
);

// ======================================================
// cal_search.php
// ======================================================

$lang_event_search_data = array(
	'section_title' => 'Cerca al Calendari',
	'search_results' => 'Resultats de la Cerca',
	'category_label' => 'Categoria',
	'date_label' => 'Data',
	'no_events' => 'No hi ha esdeveniments en aquesta categoria.',
	'search_caption' => 'Ingressi algunes paraules clau...',
	'search_again' => 'Cercar de nou',
	'search_button' => 'Cercar',
// Misc.
	'no_results' => 'No s\'han trobat resultats',	
// Stats
	'stats_string1' => '<strong>%d</strong> evento(s) trobats',
	'stats_string2' => '<strong>%d</strong> Esdeveniment(s) en <strong>%d</strong> p�gina(es)'
);

// ======================================================
// profile.php
// ======================================================

if (defined('PROFILE_PHP')) 

$lang_user_profile_data = array(
	'section_title' => 'El meu Perfil',
	'edit_profile' => 'Editar el meu Perfil',
	'update_profile' => 'Modificar el meu Perfil',
	'actions_label' => 'Accions',
// Account Info
	'account_info_label' => 'Informaci� de Compte',
	'user_name' => 'Nom Usuari',
	'user_pass' => 'Contrasenya',
	'user_pass_confirm' => 'Confirmar Contrasenya',
	'user_email' => 'Direcci� E-mail',
	'group_label' => 'Membre del Grup',
// Other Details
	'other_details_label' => 'Altres Detalls',
	'first_name' => 'Nom',
	'last_name' => 'Cognom',
	'full_name' => 'Nom complert',
	'user_website' => 'P�gina web',
	'user_location' => 'Localitzaci�',
	'user_occupation' => 'Ocupaci�',
// Misc.
	'select_language' => 'Seleccioni Llenguatge',
	'edit_profile_success' => 'Modificaci� del perfil satisfactoria',
	'update_pass_info' => 'Deixi el camp contrasenya buit si no necessita cambiar-lo',
// Error messages
	'invalid_password' => 'Si us plau ingressi una contrasenya que consti nom�s de lletres i n�meros, entre 4 i 16 car�cters de longitud !',
	'password_is_username' => 'La contrasenya ha de ser diferente al nom d\'usuari !',
	'password_not_match' =>'La contrasenya escrita no coincideix \'confirmi la contrasenya\'',
	'invalid_email' => 'Ha d\'escriure una direcci� de correu v�lida !',
	'email_exists' => 'Un altre usuari s\'ha registrat amb la direcci� de correu que vost� ha escrit. Si us plau escrigui un correu diferent !',
	'no_email' => 'Ha d\'escriure una direcci� de correu !',
	'invalid_email' => 'Ha d\'escriure una direcci� de correu v�lida !',
	'no_password' => 'Ha d\'escriure una contrasenya per aquest compte nou !'
);

// ======================================================
// register.php
// ======================================================

if (defined('USER_REGISTRATION_PHP')) 

$lang_user_registration_data = array(
	'section_title' => 'Registre d\'Usuari',
// Step 1: Terms & Conditions
	'terms_caption' => 'Termes i Condicions',
	'terms_intro' => 'Per poder continuar, ha d\'estar d\'acord amb els seg�ents termes:',
	'terms_message' => 'Si us plau, llegeixi amb atenci� les seg�ents normes detallades. Si est� d\'acord amb elles i vol continuar amb el registre simplement accepti prement sobre el bot� corresponent. Per cancel�lar el registre torni enrrera mitjan�ant el bot� corresponent del seu navegador.<br /><br />Recordi que no som responsables de qualsevol esdeveniment afegit per usuaris d\'aquest calendari. No donem garantia de funcionalitat i usabilitat de qualsevol esdeveniment afegit, i no som responsables del seu contingut.<br /><br />Els missatges reflexen la visi� de l\'autor dels esdeveniments, no necess�riament la visi� del calendari. Qualsevol usuari que vegi algun tipus d\'ofensa en quelsevol dels esdeveniments pot posar-se en contacte amb nosaltres a trav�s d\' email. Podem esborrar qualsevol esdeveniment que calgui o sigui digne de tal i procurarem fer-ho dins un termini raonable.<br /><br />Est� d\'acuerd, respecte a l\'us d\'aquest servei, que no es podr� utilitzar aquest calendari per escriure material fals i/o difamatori, inexacte, abusiu, perill�s, obsc�, prof�, sota orientacions sexuals, contrari a la privacitat personal, o que violi la legislaci� vigent.<br /><br />Est� d\'acord en no escriure material sota drets d\'autor a menys que la propietat sigui seva o %s.',
	'terms_button' => 'D\'acord',
	
// Account Info
	'account_info_label' => 'Informaci� de Compte',
	'user_name' => 'Nom d\'Usuari',
	'user_pass' => 'Contrasenya',
	'user_pass_confirm' => 'Confirmar Contrasenya',
	'user_email' => 'Direcci� d\'E-mail',
// Other Details
	'other_details_label' => 'Altres Detalls',
	'first_name' => 'Nom',
	'last_name' => 'Cognom',
	'user_website' => 'P�gina web',
	'user_location' => 'Localitzaci�',
	'user_occupation' => 'Ocupaci�',
	'register_button' => 'Desar el meu registre',

// Stats
	'stats_string1' => '<strong>%d</strong> usuaris',
	'stats_string2' => '<strong>%d</strong> usuaris en <strong>%d</strong> p�gina(es)',
// Misc.
	'reg_nomail_success' => 'Gracies pel seu registre.',
	'reg_mail_success' => 'Un correu amb informaci� sobre com activar el seu compte nou ha estat desat a la direcci� de correu que ens ha escrit.',
	'reg_activation_success' => 'Felicitats! El seu nou compte est� actiu i vost� pot ingressar amb el seu nom d\'usuario contrasenya. Gracies pel seu registre.',
// Mail messages
	'reg_confirm_subject' => 'Registre a %s',
	
// Error messages
	'no_username' => 'Ha d\'escriure un nom d\'usuari !',
	'invalid_username' => 'Si us plau escrigui un nom d\'usuari que consti nom�s de lletres i n�meros, entre 4 i 30 car�cters de longitud !',
	'username_exists' => 'El nom d\'usuari que ha escrit, ja existeix. Si us plau provi amb un nom d\'usuari diferent !',
	'no_password' => 'Ha d\'escriure una contrasenya !',
	'invalid_password' => 'Si us plau escrigui una contrasenya que consti nom�s de lletres i n�meros, entre 4 i 16 car�cters de longitud !',
	'password_is_username' => 'La contrasenya ha de ser diferent del nombre d\'usuari !',
	'password_not_match' =>'La contrasenya que ha escrit no es correspon \'confirmi contrasenya\'',
	'no_email' => 'Ha d\'escriure una direcci� de correu !',
	'invalid_email' => 'Ha d\'escriure una direcci� de correu v�lida !',
	'email_exists' => 'Un altre usuari s\'ha registrat amb la direcci� de correu que vost� ha escrit. Si us plau escrigui un correu diferent !',
	'delete_user_failed' => 'Aquest compte d\'usuari no pot ser eliminat',
	'no_users' => 'No hi ha comptes d\'usuari per mostrar !',
	'already_logged' => 'Vost� ja ha ingressat como a membre !',
	'registration_not_allowed' => 'El registre d\'usuaris est� actualment deshabilitat !',
	'reg_email_failed' => 'Hi ha hagut un error mentre s\'enviava el correu d\'activaci� !',
	'reg_activation_failed' => 'Hi ha hagut un error mentre s\'estava en proc�s d\'activaci� !'

);

// Message body for email activation
$lang_user_registration_data['reg_confirm_body'] = <<<EOT
Gracies per registrar-se a {CALENDAR_NAME}

El seu nom �s : "{USERNAME}"
La seva contrasenya �s : "{PASSWORD}"

Per activar el seu compte, necessitem que premi en el link seg�ent
o fent copy and paste en el seu navegador.

{REG_LINK}

Atentament,

El seu equip de {CALENDAR_NAME}

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
	'section_title' => 'Administraci� d\'Esdeveniments',
	'events_to_approve' => 'Administraci� d\'Esdeveniments: Esdeveniments per Aprovar',
	'upcoming_events' => 'Administraci� d\'Esdeveniments: Esdeveniments futurs',
	'past_events' => 'Administraci� d\'Esdeveniments: Esdeveniments Passats',
	'add_event' => 'Afegir un Nou Esdeveniment',
	'edit_event' => 'Editar Esdeveniment',
	'view_event' => 'Veure Esdeveniment',
	'approve_event' => 'Aprovar Esdeveniment',
	'update_event' => 'Modificar Informaci� d\'Esdeveniment',
	'delete_event' => 'Eliminar Esdeveniment',
	'events_label' => 'Esdeveniments',
	'auto_approve' => 'Auto Aprobaci�',
	'date_label' => 'Data',
	'actions_label' => 'Accions',
	'events_filter_label' => 'Filtre d\'Esdeveniments',
	'events_filter_options' => array('Mostrar tots els esdeveniments','Mostrar nom�s els esdeveniments no aprovats','Mostrar nom�s els esdeveniments futurs','Mostrar nom�s els esdeveniments passats'),
	'picture_attached' => 'Imatge adjunta',
// View Event
	'view_event_name' => 'Esdeveniment: \'%s\'',
	'event_start_date' => 'Data',
	'event_end_date' => 'Fins',
	'event_duration' => 'Duraci�',
	'contact_info' => 'Informaci� de Contacte',
	'contact_email' => 'Email',
	'contact_url' => 'URL',
// General Info
// Event form
	'edit_event_title' => 'Esdeveniment: \'%s\'',
	'cat_name' => 'Categoria',
	'event_start_date' => 'Data',
	'event_end_date' => 'Fins',
	'contact_info' => 'Informaci� de Contacte',
	'contact_email' => 'Email',
	'contact_url' => 'URL',
	'no_event' => 'No hi ha esdeveniments per mostrar.',
	'stats_string' => '<strong>%d</strong> Esdeveniments en Total',
// Stats
	'stats_string1' => '<strong>%d</strong> esdeveniment(s)',
	'stats_string2' => 'Total: <strong>%d</strong> esdeveniment(s) en <strong>%d</strong> p�gina(es)',
// Misc.
	'add_event_success' => 'Nou esdeveniment afegit satisfactoriament',
	'edit_event_success' => 'Esdeveniment modificat satisfactoriament',
	'approve_event_success' => 'Esdeveniment aprovat satisfactoriament',
	'delete_confirm' => 'Segur que vol eliminar aquest esdeveniment?',
	'delete_event_success' => 'Esdeveniment eliminat satisfactoriament',
	'active_label' => 'Actiu',
	'not_active_label' => 'No Actiu',
// Error messages
	'no_event_name' => 'Ha d\'escriure un nom per aquest esdeveniment!',
	'no_event_desc' => 'Ha d\'escriure una descripci� per aquest esdeveniment!',
	'no_cat' => 'Ha d\'escollir una categoria per aquest esdeveniment!',
	'no_day' => 'Ha d\'escollir un dia!',
	'no_month' => 'Ha d\'escollir un mes!',
	'no_year' => 'Ha d\'escollir un any!',
	'non_valid_date' => 'Si us plau, escriu una data v�lida!',
	'end_days_invalid' => 'Si us plau, asseguri\'s que el camp \'Dies\' sota \'Duraci�\' consisteix �nicament de n�meros!',
	'end_hours_invalid' => 'Si us plau, asseguri\'s que el camp \'Hores\' sota \'Duraci�\' consisteix �nicament de n�meros!',
	'end_minutes_invalid' => 'Si us plau, asseguri\'s que el camp \'Minuts\' sota \'Duraci�\' consisteix �nicament de n�meros!',
	'file_too_large' => 'La imatge adjuntada es m�s gran de %d KBytes!',
	'non_valid_extension' => 'El format de l\'arxiu de la imatge adjunta no �s suportat!',
	'delete_event_failed' => 'Aquest esdeveniment no es pot eliminar',
	'approve_event_failed' => 'Aquest esdeveniment no es pot aprovar',
	'no_events' => 'No hi ha esdeveniment per mostrar',
	'move_image_failed' => 'El sistema ha fallat al moure la imatge carregada !',
	'non_valid_dimensions' => 'L\'ample i el llarg de la imatge �s major que %s pixels !',

	'recur_val_1_invalid' => 'El valor escrit com a \'interval de repetici�\' no �s v�lid. Aquest valor ha de ser un n�mero major que \'0\'',
	'recur_end_count_invalid' => 'El valor escrit com a \'n�mero d\'ocurr�ncies\' no �s v�lid. Aquest valor ha de ser un n�mero major que \'0\'',
	'recur_end_until_invalid' => 'La data de \'repetir fins\' ha de ser major que la data d\'inici de  l\'esdeveniment'

);

// ======================================================
// admin_categories.php
// ======================================================

if (defined('ADMIN_CATS_PHP')) 

$lang_cat_admin_data = array(
	'section_title' => 'Administraci� de Categories',
	'add_cat' => 'Afegir Nova Categoria',
	'edit_cat' => 'Editar Categoria',
	'update_cat' => 'Modificar Informaci� de Categoria',
	'delete_cat' => 'Esborrar Categoria',
	'events_label' => 'Esdeveniments',
	'visibility' => 'Visibilitat',
	'actions_label' => 'Accions',
	'users_label' => 'Usuaris',
	'admins_label' => 'Administradors',
// General Info
	'general_info_label' => 'Informaci� General',
	'cat_name' => 'Nom de la Categoria',
	'cat_desc' => 'Descripci� de la Categoria',
	'cat_color' => 'Color',
	'pick_color' => 'Escollir un Color!',
	'status_label' => 'Estat',
// Administrative Options
	'admin_label' => 'Opcions Administratives',
	'auto_admin_appr' => 'Auto aprovar enviaments de l\'administraci�',
	'auto_user_appr' => 'Auto aprovar enviaments de l\'usuari',
// Stats
	'stats_string1' => '<strong>%d</strong> categories',
	'stats_string2' => 'Actiu: <strong>%d</strong>&nbsp;&nbsp;&nbsp;Total: <strong>%d</strong>&nbsp;&nbsp;&nbsp;on <strong>%d</strong> p�gina(es)',
// Misc.
	'add_cat_success' => 'Nova categoria afegida satisfactoriament',
	'edit_cat_success' => 'Categoria modificada satisfactoriament',
	'delete_confirm' => 'Seguro que vol esborrar aquesta categoria?',
	'delete_cat_success' => 'Categoria esborrada satisfactoriament',
	'active_label' => 'Actiu',
	'not_active_label' => 'No Actiu',
// Error messages
	'no_cat_name' => 'Ha d\'esciure un nom per aquesta categoria!',
	'no_cat_desc' => 'Ha d\'escriure una descripci� per aquesta categoria!',
	'no_color' => 'Ha d\'escriure un color per aquesta categoria !',
	'delete_cat_failed' => 'Aquesta categoria no es pot esborrar',
	'no_cats' => 'No hi ha categories per mostrar!',
	'cat_has_events' => 'Aquesta categoria cont� %d esdeveniment(s) i per aix� no es pot esborrar!<br>Si us plau, esborri els esdeveniments d\'aquesta categoria i provi de nou'

);
// ======================================================
// admin_users.php
// ======================================================

if (defined('ADMIN_USERS_PHP')) 

$lang_user_admin_data = array(
	'section_title' => 'Administraci� d\'Usuaris',
	'add_user' => 'Afegir Nou Usuari',
	'edit_user' => 'Editar Informaci� d\'Usuari',
	'update_user' => 'Modificar Informaci� d\'Usuari',
	'delete_user' => 'Eliminar compte d\'Usuari',
	'last_access' => '�ltim Acces',
	'actions_label' => 'Accions',
	'active_label' => 'Actiu',
	'not_active_label' => 'No Actiu',
// Account Info
	'account_info_label' => 'Informaci� de Compte',
	'user_name' => 'Nom d\'Usuari',
	'user_pass' => 'Contrasenya',
	'user_pass_confirm' => 'Confirmar contrasenya',
	'user_email' => 'Direcci� d\'E-mail',
	'group_label' => 'Membre del Grup',
	'status_label' => 'Estat del Compte',
// Other Details
	'other_details_label' => 'Altres Detalls',
	'first_name' => 'Nom',
	'last_name' => 'Cognom',
	'user_website' => 'P�gina web',
	'user_location' => 'Localitzaci�',
	'user_occupation' => 'Ocupaci�',
// Stats
	'stats_string1' => '<strong>%d</strong> usuaris',
	'stats_string2' => '<strong>%d</strong> usuaris en <strong>%d</strong> p�gina(es)',
// Misc.
	'select_group' => 'Seleccioni un...',
	'add_user_success' => 'Compte d\'usuari afegida satisfactoriament',
	'edit_user_success' => 'Compte d\'usuari modificada satisfactoriament',
	'delete_confirm' => 'Segur que vol esborrar aquest compte?',
	'delete_user_success' => 'Compte d\'usuari esborrat satisfactoriament',
	'update_pass_info' => 'Deixi el camp de la contrasenya buit si no necessita modificar-la',
	'access_never' => 'Mai',
// Error messages
	'no_username' => 'Ha d\'escriure un nom d\'usuari',
	'invalid_username' => 'Ha d\'escriure un nom d\'usuari que consti nom�s de lletres i n�meros, entre 4 y 30 car�cters de longitud',
	'invalid_password' => 'Ha d\'escriure una contrasenya que consti nom�s de lletres i n�meros, entre 4 y 16 car�cters de longitud',
	'password_is_username' => 'La contrasenya ha de ser diferent del nom d\'usuari',
	'password_not_match' =>'La contrasenya que ha escrit no es correspon \'confirmi contrasenya\'',
	'invalid_email' => 'Ha d\'escriure una direcci� de correu v�lida',
	'email_exists' => 'Un altre usuari s\'ha registrat amb la direcci� de correu que vost� ha escrit. Si us plau escrigui un correu diferent !',
	'username_exists' => 'El nombre de usuario que ingres� ya existe. Por favor sugiera un nombre de usuario diferente !',
	'no_email' => 'Ha d\'escriure una direcci� de correu !',
	'invalid_email' => 'Ha d\'escriure una direcci� de correu v�lida !',
	'no_password' => 'Ha d\'escriure una contrasenya !',
	'no_group' => 'Seleccioni un grup per aquest usuari',
	'delete_user_failed' => 'Aquest compte d\'usuari no es pot esborrar',
	'no_users' => 'No hi ha comptes d\'usuari per mostrar'

);

// ======================================================
// admin_groups.php
// ======================================================

if (defined('ADMIN_GROUPS_PHP')) 

$lang_group_admin_data = array(
	'section_title' => 'Administraci� de Grups',
	'add_group' => 'Afegir Nou Grup',
	'edit_group' => 'Editar Grup',
	'update_group' => 'Modificar Informaci� de Grup',
	'delete_group' => 'Esborrar Grup',
	'view_group' => 'Veure Grup',
	'users_label' => 'Membres',
	'actions_label' => 'Accions',
// General Info
	'general_info_label' => 'Informaci� General',
	'group_name' => 'Nom del Grup',
	'group_desc' => 'Descripci� del Grup',
// Group Access Level
	'access_level_label' => 'Nivell d\'Acces del Grup',
	'Administrator' => 'Els usuaris d\'aquest grup tenen accesos d\'administraci�',
	'can_manage_accounts' => 'Els usuaris d\'aquest grup poden administrar comptes',
	'can_change_settings' => 'Els usuaris d\'aquest grup poden canviar les definicions del calendari',
	'can_manage_cats' => 'Els usuaris d\'aquest grup poden administrar categories',
	'upl_need_approval' => 'Els esdeveniments enviats requereixen aprovaci� de l\'administrador',
// Stats
	'stats_string1' => '<strong>%d</strong> grups',
	'stats_string2' => 'Total: <strong>%d</strong> grups en <strong>%d</strong> p�gina(es)',
	'stats_string3' => 'Total: <strong>%d</strong> usuaris en <strong>%d</strong> p�gina(es)',
// View Group Members
	'group_members_string' => 'Membres de \'%s\' grup',
	'username_label' => 'Nom d\'usuari',
	'firstname_label' => 'Nom',
	'lastname_label' => 'Cognom',
	'email_label' => 'Email',
	'last_access_label' => '�ltim Acces',
	'edit_user' => 'Editar Usuari',
	'delete_user' => 'Esborrar Usuari',
// Misc.
	'add_group_success' => 'Nou grup afegit satisfactoriament',
	'edit_group_success' => 'Grup modificat satisfactoriament',
	'delete_confirm' => 'Segur que vol esborrar aquest grup?',
	'delete_user_confirm' => 'Segur que vol esborrar aquest grup?',
	'delete_group_success' => 'Grup esborrat satisfactoriament',
	'no_users_string' => 'No hi ha usuaris en aquest grup',
// Error messages
	'no_group_name' => 'Ha d\'escriure un nom per aquest grup',
	'no_group_desc' => 'Ha d\'escriure una descripci� per aquest grup',
	'delete_group_failed' => 'Aquest grup no es pot esborrar',
	'no_groups' => 'No hi ha grups per mostrar',
	'group_has_users' => 'En aquest grup hi ha %d usuari(s) i no es pot esborrar!<br>Haur� de moure els usuaris d\'aquest grup i intentar-ho de nou'

);

// ======================================================
// admin_settings.php / admin_settings_template.php / 
// admin_settings_updates.php
// ======================================================

$lang_settings_data = array(
	'section_title' => 'Definici� de Calendari'
// Links
	,'admin_links_text' => 'Escollir Secci�'
	,'admin_links' => array('Definicions Principals','Configuraci� de Plantilla','Modificaci� de Producte')
// General Settings
	,'general_settings_label' => 'Definicions Generals'
	,'calendar_name' => 'Nom del Calendari'
	,'calendar_description' => 'Descripci� del Calendari'
	,'calendar_admin_email' => 'Email de l\'Administrador del Calendari'
	,'cookie_name' => 'Nom de la cookie utilitzada per l\'script'
	,'cookie_path' => 'Ruta de la cookie utilitzada per l\'script'
	,'debug_mode' => 'Habilitar mode debug'
	,'calendar_status' => 'Estat del Calendari p�blic'
// Environment Settings
	,'env_settings_label' => 'Definicions de l\'Entorn'
	,'lang' => 'Llenguatge'
		,'lang_name' => 'Llenguatge'
		,'lang_native_name' => 'Nom Nadiu'
		,'lang_trans_date' => 'Tradu�t el'
		,'lang_author_name' => 'Autor'
		,'lang_author_email' => 'E-mail'
		,'lang_author_url' => 'Web autor'
	,'charset' => 'Codificaci� de car�cters'
	,'theme' => 'Tema'
		,'theme_name' => 'Nom del tema'
		,'theme_date_made' => 'Fet per'
		,'theme_author_name' => 'Autor'
		,'theme_author_email' => 'E-mail'
		,'theme_author_url' => 'Web autor'
	,'timezone' => 'Diferencia de zona horaria'
	,'time_format' => 'Format per mostrar l\'hora'
		,'24hours' => '24 Hores'
		,'12hours' => '12 Hores'
	,'auto_daylight_saving' => 'Ajustament autom�tic per estalvi de llum di�rna (DST)'
	,'main_table_width' => 'Ample de la taula principal (P�xels o %)'
	,'day_start' => 'El primer dia de la setmana ser� el'
	,'default_view' => 'Vista per defecte'
	,'search_view' => 'Habilitar cerca'
	,'archive' => 'Mostrar esdeveniments passats'
	,'events_per_page' => 'N�mero d\'esdeveniments per p�gina'
	,'sort_order' => 'Ordre de clasificaci� per defecte'
		,'sort_order_title_a' => 'T�tol ascendent'
		,'sort_order_title_d' => 'T�tol descendent'
		,'sort_order_date_a' => 'Data ascendent'
		,'sort_order_date_d' => 'Data descendent'
	,'show_recurrent_events' => 'Mostrar esdeveniments recurrents'
	,'multi_day_events' => 'Esdeveniments multi-dia'
		,'multi_day_events_all' => 'Mostrar rang complert de dies'
		,'multi_day_events_bounds' => 'Mostrar nom�s les dates d\'inici i fi'
		,'multi_day_events_start' => 'Mostrar nom�s les dates d\'inici'
	// User Settings
	,'user_settings_label' => 'Definicions d\'usuaris'
	,'allow_user_registration' => 'Permetre registre d\'usuaris'
	,'reg_duplicate_emails' => 'Permetre emails duplicats'
	,'reg_email_verify' => 'Habilitar l\'activaci� de comptes a trav�s d\'email'
// Event View
	,'event_view_label' => 'Vista de l\'Esdeveniment'
	,'popup_event_mode' => 'Finestra de l\'Esdeveniment'
	,'popup_event_width' => 'Ample de la finestra'
	,'popup_event_height' => 'Alt de la finestra'
// Add Event View
	,'add_event_view_label' => 'Afegir vista de l\'esdeveniment'
	,'add_event_view' => 'Habiltar'
	,'addevent_allow_html' => 'Permetre <b>Codi BB</b> a la descripci�'
	,'addevent_allow_contact' => 'Permetre contacte'
	,'addevent_allow_email' => 'Permetre Email'
	,'addevent_allow_url' => 'Permetre URL'
	,'addevent_allow_picture' => 'Permetre imatges'
	,'new_post_notification' => 'Notificaci� de nou esdeveniment'
// Calendar View
	,'calendar_view_label' => 'Vista de Calendari (Mensual)'
	,'monthly_view' => 'Habilitada'
	,'cal_view_show_week' => 'Mostrar n�mero de setmana'
	,'cal_view_max_chars' => 'Car�cters m�xims a la Descripci�'
// Flyer View
	,'flyer_view_label' => 'Vista voladora'
	,'flyer_view' => 'Habilitada'
	,'flyer_show_picture' => 'Mostrar imatges a la vista voladora'
	,'flyer_view_max_chars' => 'Car�cters m�xims a la Descripci�'
// Weekly View
	,'weekly_view_label' => 'Vista Setmanal'
	,'weekly_view' => 'Habilitada'
	,'weekly_view_max_chars' => 'Car�cters m�xims a la Descripci�'
// Daily View
	,'daily_view_label' => 'Vista Diaria'
	,'daily_view' => 'Habilitada'
	,'daily_view_max_chars' => 'Car�cters m�xims a la Descripci�'
// Categories View
	,'categories_view_label' => 'Vista de Categories'
	,'cats_view' => 'Habilitada'
	,'cats_view_max_chars' => 'Car�cters m�xims a la Descripci�'
// Mini Calendar
	,'mini_cal_label' => 'Mini Calendari'
	,'mini_cal_def_picture' => 'Imatge inicial'
	,'mini_cal_display_picture' => 'Mostrar imatge'
	,'mini_cal_diplay_options' => array('Res','Imatge inicial', 'Imatge diaria','Imatge setmanal','Imatge a l\'atzar')
// Mail Settings
	,'mail_settings_label' => 'Definicions de Mail'
	,'mail_method' => 'M�tode per enviament de Mail'
	,'mail_smtp_host' => 'Hosts SMTP (separats per punt i coma ;)'
	,'mail_smtp_auth' => ' Autenticaci� SMTP'
	,'mail_smtp_username' => 'Nom d\'Usuari SMTP'
	,'mail_smtp_password' => 'Contrasenya SMTP'

// Picture Settings
	,'picture_settings_label' => 'Definici� d\'imatge'
	,'max_upl_dim' => 'Max. ample o alt per imatges pujades'
	,'max_upl_size' => 'Max. tamany per imatges pujades (en Bytes)'
	,'picture_chmod' => 'Mode inicial per imatges (CHMOD) (en Octal)'
	,'allowed_file_extensions' => 'Extensions d\'arxius acceptades per imatges pujades'
// Form Buttons
	,'update_config' => 'Desar Nova Configuraci�'
	,'restore_config' => 'Recuperar els valors per defecte'
// Misc.
	,'update_settings_success' => 'Definici� satisfactoria de modificacions'
	,'restore_default_confirm' => 'Segur que vol recuperar las definicions originals?'
// Template Configuration
	,'template_type' => 'Tipus de Plantilla'
	,'template_header' => 'Definici� de la cap�alera'
	,'template_footer' => 'Definici� del peu'
	,'template_status_default' => 'Utilitzar la plantilla de tema original'
	,'template_status_custom' => 'Utilitzar la plantilla seg�ent:'
	,'template_custom' => 'Plantilla personalitzada'

	,'info_meta' => 'Meta Informaci�'
	,'info_status' => 'Estat de control'
	,'info_status_default' => 'Deshabilitar aquest contingut'
	,'info_status_custom' => 'Mostrar el contingut seg�ent:'
	,'info_custom' => 'Contingut personalitzat'

	,'dynamic_tags' => 'Marques din�miques'

// Product Updates
	,'updates_check_text' => 'Si us plau, esperi mentre recuperem la informaci� del servidor...'
	,'updates_no_response' => 'No hi ha resposta del servidor. Si us plau, intenti-ho despr�s.'
	,'avail_updates' => 'Modificacions disponibles'
	,'updates_download_zip' => 'Descarregar paquet ZIP (.zip)'
	,'updates_download_tgz' => 'Descarregar paquet TGZ (.tar.gz)'
	,'updates_released_label' => 'Data de publicaci�: %s'
	,'updates_no_update' => 'Est� utilitzant la versi� m�s nova disponible. No requereix modificacions.'
);

// ======================================================
// cal_mini.inc.php
// ======================================================

$lang_mini_cal = array(
	'def_pic' => 'Imatge original'
	,'daily_pic' => 'Imatge del dia (%s)'
	,'weekly_pic' => 'Imatge de la setmana (%s)'
	,'rand_pic' => 'Imatge a l\'atzar (%s)'
	,'post_event' => 'Ingres de Nou Esdeveniment'
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
	'section_title' => 'Pantalla d\'Acc�s'
// General Settings
	,'login_intro' => 'Escrigui el seu nom d\'usuari i contrasenya'
	,'username' => 'Nom d\'Usuari'
	,'password' => 'Contrasenya'
	,'remember_me' => 'Recordar'
	,'login_button' => 'Accedir'
// Errors
	,'invalid_login' => 'Si us plau, ha de verificar la informaci� escrita!'
	,'no_username' => 'Ha d\'escriure un nom d\'usuari'
	,'already_logged' => 'Ja est� conectat'
);

// ======================================================
// logout.php
// ======================================================

// To Be Done


?>