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
	'name' => 'Spanish'
	,'nativename' => 'Espa�ol' // Language name in native language. E.g: 'Fran�ais' for 'French'
	,'locale' => array('sp','spanish') // Standard locale alternatives for a specific language. For reference, go to: http://www.php.net/manual/en/function.setlocale.php
	,'charset' => 'ISO-8859-1' // For reference, go to : http://www.w3.org/International/O-charset-lang.html
	,'direction' => 'ltr' // 'ltr' for Left to Right. 'rtl' for Right to Left languages such as Arabic.
	,'author' => 'Jorge Bernardo (yeibi)'
	,'author_email' => 'jorge@bernardo.net'
	,'author_url' => 'http://jorge.bernardo.net'
	,'transdate' => '04/01/2005'
);

$lang_general = array (
	'yes' => 'Si'
	,'no' => 'No'
	,'back' => 'Atr�s'
	,'continue' => 'Continuar'
	,'close' => 'Cerrar'
	,'errors' => 'Errores'
	,'info' => 'Informaci�n'
	,'day' => 'D�a'
	,'days' => 'D�ass'
	,'month' => 'Mes'
	,'months' => 'Meses'
	,'year' => 'A�o'
	,'years' => 'A�os'
	,'hour' => 'Hora'
	,'hours' => 'Horas'
	,'minute' => 'Minuto'
	,'minutes' => 'Minutos'
	,'everyday' => 'Cada D�a'
	,'everymonth' => 'Cada Mes'
	,'everyyear' => 'Cada A�o'
	,'active' => 'Activo'
	,'not_active' => 'No Activo'
	,'today' => 'Hoy'
	,'signature' => 'Hecho por %s'
	,'expand' => 'Expandir'
	,'collapse' => 'Colapsar'
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
	,'day_of_week' => array('Domingo','Lunes','Martes','Mi�rcoles','Jueves','Viernes','S�bado')
	,'months' => array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre')
);

$lang_system = array (
	'system_caption' => 'Mensaje del Sistema'
  ,'page_access_denied' => 'No tiene suficientes privilegios para acceder a esta p�gina.'
  ,'page_requires_login' => 'Debe haber ingresado para acceder a esta p�gina.'
  ,'operation_denied' => 'No tiene suficientes privilegios para realizar esta operaci�n.'
	,'section_disabled' => 'Esta secci�n esta actualmente deshabilitada!'
  ,'non_exist_cat' => 'La categor�a seleccionada no existe !'
  ,'non_exist_event' => 'El evento seleccionado no existe !'
  ,'param_missing' => 'Los par�metros provistos son incorrectos.'
  ,'no_events' => 'No hay eventos para mostrar'
  ,'config_string' => 'Esta actualmente usando \'%s\' corriendo sobre %s, %s y %s.'
  ,'no_table' => 'La \'%s\' tabla no existe !'
  ,'no_anonymous_group' => 'La %s tabla no contiene el grupo \'Anonymous\' !'
  ,'calendar_locked' => 'Este servicio esta temporariamente deshabilitado por mantenimiento y mejoras. Disc�lpenos por los inconvenientes !'
	,'new_upgrade' => 'El sistema ha detectado una nueva versi�n. Se recomienda ejecutar el upgrade ahora. Presione "Continuar" para correr la herramienta de upgrade.'
	,'no_profile' => 'Ocurri� un error mientras recuper�bamos su informaci�n de perfil'
// Mail messages
	,'new_event_subject' => 'Nuevo Evento en %s'
	,'event_notification_failed' => 'Ocurri� un error mientras trat�bamos de enviar un correo de notificaci�n !'
);

// Message body for new event email notification
$lang_system['event_notification_body'] = <<<EOT
El siguiente evento fue agregado en {CALENDAR_NAME}

Titulo: "{TITLE}"
Fecha: "{DATE}"
Duraci�n: "{DURATION}"

Puedes acceder a este evento clickeando el siguiente link o copi�ndolo y peg�ndolo en tu navegador

{LINK}

Que tenga un buen d�a,

El equipo de {CALENDAR_NAME}

EOT;

// Admin menu entries
$lang_admin_menu = array (
	'login' => 'Ingresar'
	,'register' => 'Registro'
  ,'logout' => 'Salir <span style="color:#FF9922">[<span style="color:#606F79">%s</span>]</span>'
  ,'user_profile' => 'Mi Perfil'
	,'admin_events' => 'Eventos'
  ,'admin_categories' => 'Categor�as'
  ,'admin_groups' => 'Grupos'
  ,'admin_users' => 'Usuarios'
  ,'admin_settings' => 'Configuraciones'
);

// Main menu entries
$lang_main_menu = array (
	'add_event' => 'Agregar Evento'
	,'cal_view' => 'Vista Mensual'
  ,'flat_view' => 'Vista Plana'
  ,'weekly_view' => 'Vista Semanal'
  ,'daily_view' => 'Vista Diaria'
  ,'yearly_view' => 'Vista Anual'
  ,'categories_view' => 'Categor�as'
  ,'search_view' => 'Buscar'
);

// ======================================================
// Add Event view
// ======================================================

$lang_add_event_view = array(
	'section_title' => 'Agregar Evento'
	,'edit_event' => 'Editar evento [id%d] \'%s\''
	,'update_event_button' => 'Modificar Evento'

// Event details
	,'event_details_label' => 'Detalles Evento'
	,'event_title' => 'T�tulo Evento'
	,'event_desc' => 'Descripci�n Evento'
	,'event_cat' => 'Categor�a'
	,'choose_cat' => 'Seleccione una categor�a'
	,'event_date' => 'Fecha Evento'
	,'day_label' => 'D�a'
	,'month_label' => 'Mes'
	,'year_label' => 'A�o'
	,'start_date_label' => 'Hora Comienzo'
	,'start_time_label' => 'A'
	,'end_date_label' => 'Duraci�n'
	,'all_day_label' => 'Todo el d�a'
// Contact details
	,'contact_details_label' => 'Detalles Contacto'
	,'contact_info' => 'Infomaci�n Contacto'
	,'contact_email' => 'Email'
	,'contact_url' => 'URL'
// Repeat events
	,'repeat_event_label' => 'Repetir Evento'
	,'repeat_method_label' => 'Repetir M�todo'
	,'repeat_none' => 'No repetir este evento'
	,'repeat_every' => 'Repetir cada'
	,'repeat_days' => 'D�a(s)'
	,'repeat_weeks' => 'Semana(s)'
	,'repeat_months' => 'Mes(es)'
	,'repeat_years' => 'A�o(s)'
	,'repeat_end_date_label' => 'Repetir hasta Fecha'
	,'repeat_end_date_none' => 'Sin fecha de fin'
	,'repeat_end_date_count' => 'Fin despu�s de %s ocurrencia(s)'
	,'repeat_end_date_until' => 'Repetir hasta'
// Other details
	,'other_details_label' => 'Otros Detalles'
	,'picture_file' => 'Archivo de Imagen'
	,'file_upload_info' => '(%d KBytes limites- Extensiones v�lidas : %s )' 
	,'del_picture' => 'Eliminar imagen actual ?'
// Administrative options
	,'admin_options_label' => 'Opciones Administrativas'
	,'auto_appr_event' => 'Evento Aprobado'

// Error messages
	,'no_title' => 'Debe proveer un t�tulo de evento !'
	,'no_desc' => 'Debe proveer una descripci�n para este evento !'
	,'no_cat' => 'Debe seleccionar una categor�a desde el men� drop down !'
	,'date_invalid' => 'Debe proveer una fecha v�lida para este evento !'
	,'end_days_invalid' => 'El valor ingresado en el campo \'D�as\' no es v�lido !'
	,'end_hours_invalid' => 'El valor ingresado en el campo \'Horas\' no es v�lido !'
	,'end_minutes_invalid' => 'El valor ingresado en el campo \'Minutos\' no es v�lido !'

	,'non_valid_extension' => 'El formato del archivo de la imagen adjunta no est� soportado ! (Extensiones v�lidas: %s)'

	,'file_too_large' => 'La imagen adjunta es m�s grande que %d KBytes !'
	,'move_image_failed' => 'El sistema fall� al mover la imagen cargada !'
	,'non_valid_dimensions' => 'El ancho o largo de la imagen es mayor que %s pixels !'

	,'recur_val_1_invalid' => 'El valor ingresado como \'intervalo de repetici�n\' no es v�lido. Este valor debe ser un n�mero m�s grande que \'0\' !'
	,'recur_end_count_invalid' => 'El valor ingresado como \'n�mero de ocurrencias\' no es v�lido. Este valor debe ser un n�mero m�s grande que \'0\' !'
	,'recur_end_until_invalid' => 'La fecha \'repetir hasta\' debe ser mayor que la fecha de inicio del evento !'
// Misc. messages
	,'submit_event_pending' => 'Su evento esta pendiente de aprobaci�n. Gracias por enviarlo!'
	,'submit_event_approved' => 'Su evento ha sido autom�ticamente aprobado. Gracias por enviarlo!'
	,'event_repeat_msg' => 'Este evento se repite'
	,'event_no_repeat_msg' => 'Este evento no se repite'
);

// ======================================================
// daily view
// ======================================================

$lang_daily_event_view = array(
	'section_title' => 'Vista Diaria'
	,'next_day' => 'Pr�ximo d�a'
	,'previous_day' => 'D�a previo'
	,'no_events' => 'No hay eventos en este d�a'
);

// ======================================================
// weekly view
// ======================================================

$lang_weekly_event_view = array(
	'section_title' => 'Vista Semanal'
	,'week_period' => '%s - %s'
	,'next_week' => 'Pr�xima semana'
	,'previous_week' => 'Semana previa'
	,'selected_week' => 'Semana %d'
	,'no_events' => 'No hay eventos en esta semana'
);

// ======================================================
// monthly view
// ======================================================

$lang_monthly_event_view = array(
	'section_title' => 'Vista Mensual'
	,'next_month' => 'Pr�ximo mes'
	,'previous_month' => 'Mes previo'
);

// ======================================================
// flat view
// ======================================================

$lang_flat_event_view = array(
	'section_title' => 'Vista Plana'
	,'week_period' => '%s - %s'
	,'next_month' => 'Pr�ximo mes'
	,'previous_month' => 'Mes previo'
	,'contact_info' => 'Informaci�n Contacto'
	,'contact_email' => 'Email'
	,'contact_url' => 'URL'
	,'no_events' => 'No hay eventos para este mes'
);

// ======================================================
// Event view
// ======================================================

$lang_event_view = array(
	'section_title' => 'Vista Eventos'
	,'display_event' => 'Evento: \'%s\''
	,'cat_name' => 'Categor�a'
	,'event_start_date' => 'Fecha'
	,'event_end_date' => 'Hasta'
	,'event_duration' => 'Duraci�n'
	,'contact_info' => 'Informaci�n Contacto'
	,'contact_email' => 'Email'
	,'contact_url' => 'URL'
	,'no_event' => 'No hay eventos para mostrar'
	,'stats_string' => '<strong>%d</strong> Total Eventos'
	,'edit_event' => 'Editar Evento'
	,'delete_event' => 'Eliminar Evento'
	,'delete_confirm' => 'Esta seguro que quiere eliminar este evento ?'
	
);

// ======================================================
// Categories view
// ======================================================

$lang_cats_view = array(
	'section_title' => 'Vista Categor�as'
	,'cat_name' => 'Nombre Categor�a'
	,'total_events' => 'Eventos Totales'
	,'upcoming_events' => 'Pr�ximos Eventos'
	,'no_cats' => 'No hay categor�as para mostrar.'
	,'stats_string' => 'Hay <strong>%d</strong> Eventos en la Categor�a <strong>%d</strong>'
);

// ======================================================
// Category Events view
// ======================================================

$lang_cat_events_view = array(
	'section_title' => 'Eventos bajo \'%s\''
	,'event_name' => 'Nombre del Evento'
	,'event_date' => 'Fecha'
	,'no_events' => 'No hay eventos en esta categor�a.'
	,'stats_string' => '<strong>%d</strong> Eventos en Total'
);

// ======================================================
// cal_search.php
// ======================================================

$lang_event_search_data = array(
	'section_title' => 'B�squeda en Calendario',
	'search_results' => 'Resultados B�squeda',
	'category_label' => 'Categor�a',
	'date_label' => 'Fecha',
	'no_events' => 'No hay eventos en esta categor�a.',
	'search_caption' => 'Ingrese algunas palabras clave...',
	'search_again' => 'Buscar de nuevo',
	'search_button' => 'Buscar',
// Misc.
	'no_results' => 'No se encontraron resultados',	
// Stats
	'stats_string1' => '<strong>%d</strong> evento(s) encontrados',
	'stats_string2' => '<strong>%d</strong> Evento(s) en <strong>%d</strong> p�gina(s)'
);

// ======================================================
// profile.php
// ======================================================

if (defined('PROFILE_PHP')) 

$lang_user_profile_data = array(
	'section_title' => 'Mi Perfil',
	'edit_profile' => 'Editar Mi Perfil',
	'update_profile' => 'Modificar Mi Perfil',
	'actions_label' => 'Acciones',
// Account Info
	'account_info_label' => 'Informaci�n de Cuenta',
	'user_name' => 'Nombre Usuario',
	'user_pass' => 'Password',
	'user_pass_confirm' => 'Confirmar Password',
	'user_email' => 'Direcci�n E-mail',
	'group_label' => 'Miembro del Grupo',
// Other Details
	'other_details_label' => 'Otros Detalles',
	'first_name' => 'Nombre',
	'last_name' => 'Apellido',
	'full_name' => 'Nombre completo',
	'user_website' => 'Home page',
	'user_location' => 'Locaci�n',
	'user_occupation' => 'Ocupaci�n',
// Misc.
	'select_language' => 'Seleccione Lenguaje',
	'edit_profile_success' => 'Modificaci�n de perfil satisfactoria',
	'update_pass_info' => 'Deje el campo password vac�o si no necesita cambiarlo',
// Error messages
	'invalid_password' => 'Por favor ingrese una password que consista solo de letras y n�meros, entre 4 y 16 caracteres de longitud !',
	'password_is_username' => 'La password debe ser diferente al nombre de usuario !',
	'password_not_match' =>'La password que ingreso no coincide \'confirme la password\'',
	'invalid_email' => 'Debe ingresar una direccion de email v�lida !',
	'email_exists' => 'Otro usuario se ha registrado con la direcci�n de email que usted ingres�. Por favor ingrese un email diferente !',
	'no_email' => 'Debe ingresar una direcci�n de email !',
	'invalid_email' => 'Debe ingresar una direcci�n de email v�lida !',
	'no_password' => 'Debe ingresar una password para esta cuenta nueva !'
);

// ======================================================
// register.php
// ======================================================

if (defined('USER_REGISTRATION_PHP')) 

$lang_user_registration_data = array(
	'section_title' => 'Registraci�n de Usuario',
// Step 1: Terms & Conditions
	'terms_caption' => 'T�rminos y Condiciones',
	'terms_intro' => 'Para poder proceder, debe estar de acuerdo con lo siguiente:',
	'terms_message' => 'Por favor tome un momento para revisar las reglas detalladas a continuaci�n. Si est� de acuerdo con ellas y desea proceder con la registraci�n, simplemente haga click en el bot�n "De acuerdo". Para cancelar esta registraci�n, simplemente apriente el bot�n \'back\' en su navegador.<br /><br />Por favor recuerdo que no somos responsables de cualquiery evento ingresado por usuarios de esta aplicaci�n de calendario. No damos garant�a de precisi�n, completitud o  usabilidad de cualquier evento ingresado, y no somos responsables por el contenido de los eventos.<br /><br />Los mensajes expresan la visi�n del autor de los eventos, no necesariamente la visi�n de la aplicaci�n del calendariol. Cualquier usuario que sienta que se ha ingresado un evento objetable puede contactarse inmediatamente con nosotros por email. Tenemos la posibilidad de remover contenidos objetables y haremos nuestro mayor esfuerzo, dentro de un plazo de tiempo razonable, para removerlos si es necesario.<br /><br />Est� de acuerdo, respecto al uso de este servicio, que no se podr� emplear este calendario para colocar cualquier material que sea reconocido como falso y/o difamatorio, inexacto, abusivo, vulgar, peligroso, obsceno, profano, orientado sexualmente, amenazador, invasivo de la privacidad personal, o que viole cualquier legislaci�n<br /><br />Acuerda no ingresar material que posea derechos de autor a menos que la propiedad sea suya o %s.',
	'terms_button' => 'De acuerdo',
	
// Account Info
	'account_info_label' => 'Informaci�n de Cuenta',
	'user_name' => 'Nombre de Usuario',
	'user_pass' => 'Password',
	'user_pass_confirm' => 'Confirmar Password',
	'user_email' => 'Direcci�n de E-mail',
// Other Details
	'other_details_label' => 'Otros Detalles',
	'first_name' => 'Nombre',
	'last_name' => 'Apellido',
	'user_website' => 'Home page',
	'user_location' => 'Ubicaci�n',
	'user_occupation' => 'Ocupaci�n',
	'register_button' => 'Enviar mi registraci�n',

// Stats
	'stats_string1' => '<strong>%d</strong> usuarios',
	'stats_string2' => '<strong>%d</strong> usuarios en <strong>%d</strong> p�gina(s)',
// Misc.
	'reg_nomail_success' => 'Gracias por su registro.',
	'reg_mail_success' => 'Un email con informaci�n sobre como activar su cuenta fue enviado a la direcci�n de correo que nos suministr�.',
	'reg_activation_success' => 'Felicitaciones! Su cuenta esta activa y Ud. puede ingresar con su nombre de usuario y password. Gracias por su registro.',
// Mail messages
	'reg_confirm_subject' => 'Registraci�n a %s',
	
// Error messages
	'no_username' => 'Debe proveer un nombre de usuario !',
	'invalid_username' => 'Por favor ingrese un nombre de usuario que consite solo en letras y n�meros, entre 4 y 30 caracteres de longitud !',
	'username_exists' => 'El nombre de usuario que ingres�, ya existe. Por favor pruebe con un nombre de usuario diferente !',
	'no_password' => 'Debe ingresar una password !',
	'invalid_password' => 'Por favor ingrese una password que consista solo de letras y n�meros, entre 4 y 16 caracteres de longitud !',
	'password_is_username' => 'La password debe ser diferente del nombre de usuario !',
	'password_not_match' =>'La password que ingres� no corresponde \'confirme password\'',
	'no_email' => 'Debe ingresar una direcci�n de email !',
	'invalid_email' => 'Debe ingresar una direcci�n de email v�lida !',
	'email_exists' => 'Otro usuario se encuentra registrado con la misma direcci�n de email que Ud. ingres�. Por favor ingrese una direcci�n de email diferente !',
	'delete_user_failed' => 'Esta cuenta de usuario no puede ser eliminada',
	'no_users' => 'No hay cuentas de usuario para mostrar !',
	'already_logged' => 'Ud. ya ha ingresado como miembro !',
	'registration_not_allowed' => 'La registraci�n de usuarios est� actualmente deshabilitada !',
	'reg_email_failed' => 'Ocurri� un error mientras se trataba de enviar el email de activaci�n !',
	'reg_activation_failed' => 'Ocurri� un error mientras se estaba en el proceso de activaci�n !'

);

// Message body for email activation
$lang_user_registration_data['reg_confirm_body'] = <<<EOT
Gracias por registrarse en {CALENDAR_NAME}

Su nombre de usuario es : "{USERNAME}"
Su password es : "{PASSWORD}"

Para activar su cuenta, necesitamos que haga click en el link siguiente
o haga copy and paste en su navegador.

{REG_LINK}

Atentamente,

La administraci�n de {CALENDAR_NAME}

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
	'section_title' => 'Administraci�n de Eventos',
	'events_to_approve' => 'Administraci�n de Eventos: Eventos para Aprobar',
	'upcoming_events' => 'Administraci�n de Eventos: Eventos futuros',
	'past_events' => 'Administraci�n de Eventos: Eventos Pasados',
	'add_event' => 'Agregar un Nuevo Evento',
	'edit_event' => 'Editar Evento',
	'view_event' => 'Ver Evento',
	'approve_event' => 'Aprobar Evento',
	'update_event' => 'Modificar Informaci�n de Evento',
	'delete_event' => 'Eliminar Evento',
	'events_label' => 'Eventos',
	'auto_approve' => 'Auto Aprobaci�n',
	'date_label' => 'Fecha',
	'actions_label' => 'Acciones',
	'events_filter_label' => 'Filtro de Eventos',
	'events_filter_options' => array('Mostrar todos los eventos','Mostrar s�lo los eventos no aprobados','Mostras s�lo los eventos futuros','Mostrar s�lo los eventos pasados'),
	'picture_attached' => 'Imagen adjunta',
// View Event
	'view_event_name' => 'Evento: \'%s\'',
	'event_start_date' => 'Fecha',
	'event_end_date' => 'Hasta',
	'event_duration' => 'Duraci�n',
	'contact_info' => 'Informaci�n de Contacto',
	'contact_email' => 'Email',
	'contact_url' => 'URL',
// General Info
// Event form
	'edit_event_title' => 'Evento: \'%s\'',
	'cat_name' => 'Categor�a',
	'event_start_date' => 'Fecha',
	'event_end_date' => 'Hasta',
	'contact_info' => 'Informaci�n de Contacto',
	'contact_email' => 'Email',
	'contact_url' => 'URL',
	'no_event' => 'No hay eventos para mostrar.',
	'stats_string' => '<strong>%d</strong> Eventos en Total',
// Stats
	'stats_string1' => '<strong>%d</strong> evento(s)',
	'stats_string2' => 'Total: <strong>%d</strong> eventos en <strong>%d</strong> p�gina(s)',
// Misc.
	'add_event_success' => 'Nuevo evento agregado satisfactoriamente',
	'edit_event_success' => 'Evento modificado satisfactoriamente',
	'approve_event_success' => 'Evento aprobado satisfactoriamente',
	'delete_confirm' => 'Est� seguro que quiere eliminar este evento ?',
	'delete_event_success' => 'Evento eliminado satisfactoriamente',
	'active_label' => 'Activo',
	'not_active_label' => 'No Activo',
// Error messages
	'no_event_name' => 'Debe ingresar un nombre para este evento !',
	'no_event_desc' => 'Debe ingresar una descripci�n para este evento !',
	'no_cat' => 'Debe seleccionar una categor�a para este evento !',
	'no_day' => 'Debe seleccionar un d�a !',
	'no_month' => 'Debe seleccionar un mes !',
	'no_year' => 'Debe seleccionar un a�o !',
	'non_valid_date' => 'Por favor ingrese una fecha v�lida !',
	'end_days_invalid' => 'Por favor aseg�rese que el campo \'D�as\' bajo \'Duraci�n\' consiste solamente de n�meros !',
	'end_hours_invalid' => 'Por favor aseg�rese que el campo \'Horas\' bajo \'Duraci�n\' consiste solamente de n�meros !',
	'end_minutes_invalid' => 'Por favor aseg�rese que el campo \'Minutos\' bajo \'Duraci�n\' consiste solamente de n�meros !',
	'file_too_large' => 'La imagen que adjunt� en mayor que %d KBytes !',
	'non_valid_extension' => 'El formato del archivo de la imagen adjunta no es soportado !',
	'delete_event_failed' => 'Este evento no puede ser eliminado',
	'approve_event_failed' => 'Este evento no puede ser aprobado',
	'no_events' => 'No hay eventos para mostrar !',
	'move_image_failed' => 'El sistema fall� al mover la imagen cargada !',
	'non_valid_dimensions' => 'El ancho o largo de la imagne es mayor que %s pixels !',

	'recur_val_1_invalid' => 'El valor ingresado como \'intervalo de repetici�n\' no es v�lido. Este valor debe ser un n�mero mayor que \'0\' !',
	'recur_end_count_invalid' => 'El valor ingresado como \'n�mero de ocurriencias\' no es v�lido. Este valor debe ser un n�mero mayor que \'0\' !',
	'recur_end_until_invalid' => 'La fecha de \'repetir hasta\' debe ser mayir que la fecha de inicio del evento !'

);

// ======================================================
// admin_categories.php
// ======================================================

if (defined('ADMIN_CATS_PHP')) 

$lang_cat_admin_data = array(
	'section_title' => 'Administraci�n de Categor�as',
	'add_cat' => 'Agregar Nueva Categor�a',
	'edit_cat' => 'Editar Categor�a',
	'update_cat' => 'Modificar Informaci�n de Categor�a',
	'delete_cat' => 'Borrar Categor�a',
	'events_label' => 'Eventos',
	'visibility' => 'Visibilidad',
	'actions_label' => 'Acciones',
	'users_label' => 'Usuarios',
	'admins_label' => 'Administradores',
// General Info
	'general_info_label' => 'Informaci�n General',
	'cat_name' => 'Nombre de la Categor�a',
	'cat_desc' => 'Descripci�n de la Categor�a',
	'cat_color' => 'Color',
	'pick_color' => 'Elegir un Color!',
	'status_label' => 'Estado',
// Administrative Options
	'admin_label' => 'Opciones Administrativas',
	'auto_admin_appr' => 'Auto aprobar env�os de la administraci�n',
	'auto_user_appr' => 'Auto aprobar env�os del usuario',
// Stats
	'stats_string1' => '<strong>%d</strong> categor�as',
	'stats_string2' => 'Activo: <strong>%d</strong>&nbsp;&nbsp;&nbsp;Total: <strong>%d</strong>&nbsp;&nbsp;&nbsp;on <strong>%d</strong> p�gina(s)',
// Misc.
	'add_cat_success' => 'Nueva categor�a agregada satisfactoriamente',
	'edit_cat_success' => 'Categor�a modificada satisfactoriamente',
	'delete_confirm' => 'Est� seguro que quiere eliminar esta categor�a ?',
	'delete_cat_success' => 'Categor�a eliminada satisfactoriamente',
	'active_label' => 'Activo',
	'not_active_label' => 'No Activo',
// Error messages
	'no_cat_name' => 'Debe ingresar un nombre para esta categor�a !',
	'no_cat_desc' => 'Debe ingresar una descripci�n para esta categor�a !',
	'no_color' => 'Debe ingresar un color para esta categor�a !',
	'delete_cat_failed' => 'Esta categor�a no puede ser eliminada',
	'no_cats' => 'No hay categor�as para mostrar !',
	'cat_has_events' => 'Esta categor�a contiene %d evento(s) y por esto no puede ser eliminada!<br>Por favor saque los eventos bajo esta categor�a y pruebe de nuevo!'

);
// ======================================================
// admin_users.php
// ======================================================

if (defined('ADMIN_USERS_PHP')) 

$lang_user_admin_data = array(
	'section_title' => 'Administraci�n de Usuarios',
	'add_user' => 'Agregar Nuevo Usuario',
	'edit_user' => 'Editar Informaci�n del Usuario',
	'update_user' => 'Modificar Informaci�n del Usuario',
	'delete_user' => 'Eliminar Cuenta de Usuario',
	'last_access' => 'Ultimo Acceso',
	'actions_label' => 'Acciones',
	'active_label' => 'Activo',
	'not_active_label' => 'No Activo',
// Account Info
	'account_info_label' => 'Informaci�n de Cuenta',
	'user_name' => 'Nombre del Usuario',
	'user_pass' => 'Password',
	'user_pass_confirm' => 'Confirmar Password',
	'user_email' => 'Direcci�n de E-mail',
	'group_label' => 'Miembro del Grupo',
	'status_label' => 'Estado de la Cuenta',
// Other Details
	'other_details_label' => 'Otros Detalles',
	'first_name' => 'Nombre',
	'last_name' => 'Apellido',
	'user_website' => 'Home page',
	'user_location' => 'Ubicaci�n',
	'user_occupation' => 'Ocupaci�n',
// Stats
	'stats_string1' => '<strong>%d</strong> usuarios',
	'stats_string2' => '<strong>%d</strong> usuarios en <strong>%d</strong> p�gina(s)',
// Misc.
	'select_group' => 'Seleccione uno...',
	'add_user_success' => 'Cuenta de usuario agregada satisfactoriamente',
	'edit_user_success' => 'Cuenta de usuario modificada satisfactoriamente',
	'delete_confirm' => 'Est� seguro que quiere eliminar esta cuenta?',
	'delete_user_success' => 'Cuenta de usuario eliminada satisfactoriamente',
	'update_pass_info' => 'Deje el campo password vac�o si no necesita cambiarlo',
	'access_never' => 'Nunca',
// Error messages
	'no_username' => 'Debe ingresar un nombre de usuario !',
	'invalid_username' => 'Por favor ingrese un nombre de usuario que consista s�lo de letras y n�meros, entre 4 y 30 caracteres de longitud !',
	'invalid_password' => 'Por favor ingrese una password que consista s�lo de letras y n�meros, entre 4 y 16 caracteres de longitud !',
	'password_is_username' => 'La password debe ser diferente al nombre del usuario !',
	'password_not_match' =>'La password que ingres� no corresponde \'confirme la password\'',
	'invalid_email' => 'Debe ingresar una direcci�n de email v�lida !',
	'email_exists' => 'Otro usuario se ha registrado con la direcci�n de email que usted ingres�. Por favor ingrese una direcci�n de email diferente !',
	'username_exists' => 'El nombre de usuario que ingres� ya existe. Por favor sugiera un nombre de usuario diferente !',
	'no_email' => 'Debe ingresar una direcci�n de email !',
	'invalid_email' => 'Debe ingresar una direcci�n de email v�lida !',
	'no_password' => 'Debe ingresar una password para esta cuenta nueva !',
	'no_group' => 'Por favor seleccione un grupo de membres�a para este usuario !',
	'delete_user_failed' => 'Esta cuenta de usuario no puede ser eliminada',
	'no_users' => 'No hay cuentas de usuarios para mostrar !'

);

// ======================================================
// admin_groups.php
// ======================================================

if (defined('ADMIN_GROUPS_PHP')) 

$lang_group_admin_data = array(
	'section_title' => 'Administraci�n de Grupos',
	'add_group' => 'Agregar Nuevo Grupo',
	'edit_group' => 'Editar Grupo',
	'update_group' => 'Modificar Informaci�n de Grupo',
	'delete_group' => 'Eliminar Grupo',
	'view_group' => 'Ver Grupo',
	'users_label' => 'Miembros',
	'actions_label' => 'Acciones',
// General Info
	'general_info_label' => 'Informaci�n General',
	'group_name' => 'Nombre del Grupo',
	'group_desc' => 'Descripci�n del Grupo',
// Group Access Level
	'access_level_label' => 'Nivel de Acceso del Grupo',
	'Administrator' => 'Los usuarios de este grupo tienen accesos de administraci�n',
	'can_manage_accounts' => 'Los usuarios de este grupo pueden administrar cuentas',
	'can_change_settings' => 'Los usuarios de este grupo pueden cambiar las definiciones del calendario',
	'can_manage_cats' => 'Los usuarios de este grupo pueden administrar categor�as',
	'upl_need_approval' => 'Los evenots enviados requieren aprobaci�n del administrador',
// Stats
	'stats_string1' => '<strong>%d</strong> grupos',
	'stats_string2' => 'Total: <strong>%d</strong> grupos en <strong>%d</strong> p�gina(s)',
	'stats_string3' => 'Total: <strong>%d</strong> usuarios en <strong>%d</strong> p�gina(s)',
// View Group Members
	'group_members_string' => 'Miembros de \'%s\' grupo',
	'username_label' => 'Nombre del usuario',
	'firstname_label' => 'Nombre',
	'lastname_label' => 'Apellido',
	'email_label' => 'Email',
	'last_access_label' => 'Ultimo Acceso',
	'edit_user' => 'Editar Usuario',
	'delete_user' => 'Eliminar Usuario',
// Misc.
	'add_group_success' => 'Nuevo grupo agregado satisfactoriamente',
	'edit_group_success' => 'Grupo modificado satisfactoriamente',
	'delete_confirm' => 'Esta seguro que desea eliminar este grupo ?',
	'delete_user_confirm' => 'Esta seguro que quiere eliminar este grupo ?',
	'delete_group_success' => 'Grupo eliminado satisfactoriamente',
	'no_users_string' => 'No hay usuarios en este grupo',
// Error messages
	'no_group_name' => 'Debe ingresar un nombre para este grupo !',
	'no_group_desc' => 'Debe ingresar una descripci�n para este grupo !',
	'delete_group_failed' => 'Este grupo no puede ser eliminado',
	'no_groups' => 'No hay grupos para mostrar !',
	'group_has_users' => 'Este grupo contiene %d usuario(s) y por lo tanto no puede ser eliminado!<br>Por favor reubique los usuarios de este grupo y pruebe de nuevo!'

);

// ======================================================
// admin_settings.php / admin_settings_template.php / 
// admin_settings_updates.php
// ======================================================

$lang_settings_data = array(
	'section_title' => 'Definici�n de Calendario'
// Links
	,'admin_links_text' => 'Elija Secci�n'
	,'admin_links' => array('Definiciones Principales','Configuration de Plantilla','Modificaci�n de Producto')
// General Settings
	,'general_settings_label' => 'Definiciones Generales'
	,'calendar_name' => 'Nombre del Calendario'
	,'calendar_description' => 'Descripci�n del Calendario'
	,'calendar_admin_email' => 'Email del administrador del Calendario'
	,'cookie_name' => 'Nombre de la cookie usada por el script'
	,'cookie_path' => 'Ruta de la cookie usada por el script'
	,'debug_mode' => 'Habilitar modo debug'
	,'calendar_status' => 'Estado del Calendario p�blico'
// Environment Settings
	,'env_settings_label' => 'Definiciones de Entorno'
	,'lang' => 'Lenguaje'
		,'lang_name' => 'Lenguaje'
		,'lang_native_name' => 'Nombre Nativo'
		,'lang_trans_date' => 'Traducido el'
		,'lang_author_name' => 'Autor'
		,'lang_author_email' => 'E-mail'
		,'lang_author_url' => 'Website'
	,'charset' => 'Codificaci�n de caracteres'
	,'theme' => 'Tema'
		,'theme_name' => 'Nombre del tema'
		,'theme_date_made' => 'Hecho por'
		,'theme_author_name' => 'Autor'
		,'theme_author_email' => 'E-mail'
		,'theme_author_url' => 'Website'
	,'timezone' => 'Diferencia de zona horaria'
	,'time_format' => 'Formato para mostrar la hora'
		,'24hours' => '24 Horas'
		,'12hours' => '12 Horas'
	,'auto_daylight_saving' => 'Ajuste autom�tico para ahorro de luz diurna (DST)'
	,'main_table_width' => 'Ancho de la tabla principal (Pixels o %)'
	,'day_start' => 'Las semanas comienzan en'
	,'default_view' => 'Vista por default'
	,'search_view' => 'Habilitar b�squeda'
	,'archive' => 'Mostrar eventos pasados'
	,'events_per_page' => 'N�mero de eventos por p�gina'
	,'sort_order' => 'Orden de clasificaci�n default'
		,'sort_order_title_a' => 'T�tulo ascendente'
		,'sort_order_title_d' => 'T�tulo descendente'
		,'sort_order_date_a' => 'Fecha ascendente'
		,'sort_order_date_d' => 'Fecha descendente'
	,'show_recurrent_events' => 'Mostrar eventos recurrentes'
	,'multi_day_events' => 'Eventos multi-d�a'
		,'multi_day_events_all' => 'Mostrar rango completo de fechas'
		,'multi_day_events_bounds' => 'Mostrar s�lo las fecha de inicio y fin'
		,'multi_day_events_start' => 'Mostrar s�lo las fechas de inicio'
	// User Settings
	,'user_settings_label' => 'Definiciones de usuarios'
	,'allow_user_registration' => 'Permitir registraci�n de usuarios'
	,'reg_duplicate_emails' => 'Permitir emails duplicados'
	,'reg_email_verify' => 'Habilitar la activaci�n de cuentas a trav�s de email'
// Event View
	,'event_view_label' => 'Vista de Evento'
	,'popup_event_mode' => 'Ventana de Evento'
	,'popup_event_width' => 'Ancho de la ventana'
	,'popup_event_height' => 'Alto de la ventana'
// Add Event View
	,'add_event_view_label' => 'Agregar vista de evento'
	,'add_event_view' => 'Habiltar'
	,'addevent_allow_html' => 'Permitir <b>C�digo BB</b> en la descripci�n'
	,'addevent_allow_contact' => 'Permitir contacto'
	,'addevent_allow_email' => 'Permitir Email'
	,'addevent_allow_url' => 'Permitir URL'
	,'addevent_allow_picture' => 'Permitir im�genes'
	,'new_post_notification' => 'Notificaci�n de nuevo evento'
// Calendar View
	,'calendar_view_label' => 'Vista de Calendario (Mensual)'
	,'monthly_view' => 'Habilitada'
	,'cal_view_show_week' => 'Mostrar n�mero de semana'
	,'cal_view_max_chars' => 'M�ximo de Caracteres en la Descripci�n'
// Flyer View
	,'flyer_view_label' => 'Vista voladora'
	,'flyer_view' => 'Habilitada'
	,'flyer_show_picture' => 'Mostrar im�genes en la vista voladora'
	,'flyer_view_max_chars' => 'M�ximo de Caracteres en la Descripci�n'
// Weekly View
	,'weekly_view_label' => 'Vista Semanal'
	,'weekly_view' => 'Habilitada'
	,'weekly_view_max_chars' => 'M�ximo de Caracteres en la Descripci�n'
// Daily View
	,'daily_view_label' => 'Vista Diaria'
	,'daily_view' => 'Habilitada'
	,'daily_view_max_chars' => 'M�ximo de Caracteres en la Descripci�n'
// Categories View
	,'categories_view_label' => 'Vista de Categor�as'
	,'cats_view' => 'Habilitada'
	,'cats_view_max_chars' => 'M�ximo de Caracteres en la Descripci�n'
// Mini Calendar
	,'mini_cal_label' => 'Mini Calendario'
	,'mini_cal_def_picture' => 'Imagen inicial'
	,'mini_cal_display_picture' => 'Mostrar imagen'
	,'mini_cal_diplay_options' => array('Nada','Imagen inicial', 'Imagen diaria','Imagen semanal','Imagen al azar')
// Mail Settings
	,'mail_settings_label' => 'Definiciones de Mail'
	,'mail_method' => 'M�todo para env�o de Mail'
	,'mail_smtp_host' => 'Hosts SMTP (separados por punto y coma ;)'
	,'mail_smtp_auth' => ' Autenticaci�n SMTP'
	,'mail_smtp_username' => 'Nombre de Usuario SMTP'
	,'mail_smtp_password' => 'Password SMTP'

// Picture Settings
	,'picture_settings_label' => 'Definici�n de imagen'
	,'max_upl_dim' => 'Max. ancho o alto para im�genes subidas'
	,'max_upl_size' => 'Max. tama�o para im�genes subidas (en Bytes)'
	,'picture_chmod' => 'Modo inicial para im�genes (CHMOD) (en Octal)'
	,'allowed_file_extensions' => 'Extensiones de archivos aceptadas para im�genes subidas'
// Form Buttons
	,'update_config' => 'Guardar Nueva Configuraci�n'
	,'restore_config' => 'Recuperar los valores de f�brica'
// Misc.
	,'update_settings_success' => 'Definici�n satisfactoria de modificaciones'
	,'restore_default_confirm' => 'Esta seguro que desea recuperar las definiciones originales ?'
// Template Configuration
	,'template_type' => 'Tipo de Plantilla'
	,'template_header' => 'Definici�n de la cabecera'
	,'template_footer' => 'Definici�n del pie'
	,'template_status_default' => 'Usar la plantilla de tema original'
	,'template_status_custom' => 'Usar la plantilla siguiente:'
	,'template_custom' => 'Plantilla personalizada'

	,'info_meta' => 'Meta Informaci�n'
	,'info_status' => 'Estado de control'
	,'info_status_default' => 'Deshabilitar este contenido'
	,'info_status_custom' => 'Mostrar el contenido siguiente:'
	,'info_custom' => 'Contenido personalizado'

	,'dynamic_tags' => 'Marcas din�micas'

// Product Updates
	,'updates_check_text' => 'Por favor espere mientras recuperamos la informacion desde el server...'
	,'updates_no_response' => 'No hay respuesta del server. Por favor intente luego.'
	,'avail_updates' => 'Modificaciones disponibles'
	,'updates_download_zip' => 'Descargar paquete ZIP (.zip)'
	,'updates_download_tgz' => 'Descargar paquete TGZ (.tar.gz)'
	,'updates_released_label' => 'Fecha de publicaci�n: %s'
	,'updates_no_update' => 'Esta corriendo la �ltima versi�n disponible. No requiere modificaciones.'
);

// ======================================================
// cal_mini.inc.php
// ======================================================

$lang_mini_cal = array(
	'def_pic' => 'Imagen original'
	,'daily_pic' => 'Imagen del d�a (%s)'
	,'weekly_pic' => 'Imagen de la semana (%s)'
	,'rand_pic' => 'Imagen al azar (%s)'
	,'post_event' => 'Ingreso de Nuevo Evento'
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
	'section_title' => 'Pantalla de Login'
// General Settings
	,'login_intro' => 'Ingrese su nombre de usuario y password'
	,'username' => 'Nombre de Usuario'
	,'password' => 'Password'
	,'remember_me' => 'Recordarme'
	,'login_button' => 'Login'
// Errors
	,'invalid_login' => 'Por favor verifique la informaci�n ingresada y pruebe nuevamente!'
	,'no_username' => 'Debe ingresar un nombre de usuario !'
	,'already_logged' => 'Usted ya esta conectado !'
);

// ======================================================
// logout.php
// ======================================================

// To Be Done


?>