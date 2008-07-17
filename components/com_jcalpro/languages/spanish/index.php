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
	,'nativename' => 'Español' // Language name in native language. E.g: 'Français' for 'French'
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
	,'back' => 'Atrás'
	,'continue' => 'Continuar'
	,'close' => 'Cerrar'
	,'errors' => 'Errores'
	,'info' => 'Información'
	,'day' => 'Día'
	,'days' => 'Díass'
	,'month' => 'Mes'
	,'months' => 'Meses'
	,'year' => 'Año'
	,'years' => 'Años'
	,'hour' => 'Hora'
	,'hours' => 'Horas'
	,'minute' => 'Minuto'
	,'minutes' => 'Minutos'
	,'everyday' => 'Cada Día'
	,'everymonth' => 'Cada Mes'
	,'everyyear' => 'Cada Año'
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
	,'day_of_week' => array('Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado')
	,'months' => array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre')
);

$lang_system = array (
	'system_caption' => 'Mensaje del Sistema'
  ,'page_access_denied' => 'No tiene suficientes privilegios para acceder a esta página.'
  ,'page_requires_login' => 'Debe haber ingresado para acceder a esta página.'
  ,'operation_denied' => 'No tiene suficientes privilegios para realizar esta operación.'
	,'section_disabled' => 'Esta sección esta actualmente deshabilitada!'
  ,'non_exist_cat' => 'La categoría seleccionada no existe !'
  ,'non_exist_event' => 'El evento seleccionado no existe !'
  ,'param_missing' => 'Los parámetros provistos son incorrectos.'
  ,'no_events' => 'No hay eventos para mostrar'
  ,'config_string' => 'Esta actualmente usando \'%s\' corriendo sobre %s, %s y %s.'
  ,'no_table' => 'La \'%s\' tabla no existe !'
  ,'no_anonymous_group' => 'La %s tabla no contiene el grupo \'Anonymous\' !'
  ,'calendar_locked' => 'Este servicio esta temporariamente deshabilitado por mantenimiento y mejoras. Discúlpenos por los inconvenientes !'
	,'new_upgrade' => 'El sistema ha detectado una nueva versión. Se recomienda ejecutar el upgrade ahora. Presione "Continuar" para correr la herramienta de upgrade.'
	,'no_profile' => 'Ocurrió un error mientras recuperábamos su información de perfil'
// Mail messages
	,'new_event_subject' => 'Nuevo Evento en %s'
	,'event_notification_failed' => 'Ocurrió un error mientras tratábamos de enviar un correo de notificación !'
);

// Message body for new event email notification
$lang_system['event_notification_body'] = <<<EOT
El siguiente evento fue agregado en {CALENDAR_NAME}

Titulo: "{TITLE}"
Fecha: "{DATE}"
Duración: "{DURATION}"

Puedes acceder a este evento clickeando el siguiente link o copiándolo y pegándolo en tu navegador

{LINK}

Que tenga un buen día,

El equipo de {CALENDAR_NAME}

EOT;

// Admin menu entries
$lang_admin_menu = array (
	'login' => 'Ingresar'
	,'register' => 'Registro'
  ,'logout' => 'Salir <span style="color:#FF9922">[<span style="color:#606F79">%s</span>]</span>'
  ,'user_profile' => 'Mi Perfil'
	,'admin_events' => 'Eventos'
  ,'admin_categories' => 'Categorías'
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
  ,'categories_view' => 'Categorías'
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
	,'event_title' => 'Título Evento'
	,'event_desc' => 'Descripción Evento'
	,'event_cat' => 'Categoría'
	,'choose_cat' => 'Seleccione una categoría'
	,'event_date' => 'Fecha Evento'
	,'day_label' => 'Día'
	,'month_label' => 'Mes'
	,'year_label' => 'Año'
	,'start_date_label' => 'Hora Comienzo'
	,'start_time_label' => 'A'
	,'end_date_label' => 'Duración'
	,'all_day_label' => 'Todo el día'
// Contact details
	,'contact_details_label' => 'Detalles Contacto'
	,'contact_info' => 'Infomación Contacto'
	,'contact_email' => 'Email'
	,'contact_url' => 'URL'
// Repeat events
	,'repeat_event_label' => 'Repetir Evento'
	,'repeat_method_label' => 'Repetir Método'
	,'repeat_none' => 'No repetir este evento'
	,'repeat_every' => 'Repetir cada'
	,'repeat_days' => 'Día(s)'
	,'repeat_weeks' => 'Semana(s)'
	,'repeat_months' => 'Mes(es)'
	,'repeat_years' => 'Año(s)'
	,'repeat_end_date_label' => 'Repetir hasta Fecha'
	,'repeat_end_date_none' => 'Sin fecha de fin'
	,'repeat_end_date_count' => 'Fin después de %s ocurrencia(s)'
	,'repeat_end_date_until' => 'Repetir hasta'
// Other details
	,'other_details_label' => 'Otros Detalles'
	,'picture_file' => 'Archivo de Imagen'
	,'file_upload_info' => '(%d KBytes limites- Extensiones válidas : %s )' 
	,'del_picture' => 'Eliminar imagen actual ?'
// Administrative options
	,'admin_options_label' => 'Opciones Administrativas'
	,'auto_appr_event' => 'Evento Aprobado'

// Error messages
	,'no_title' => 'Debe proveer un título de evento !'
	,'no_desc' => 'Debe proveer una descripción para este evento !'
	,'no_cat' => 'Debe seleccionar una categoría desde el menú drop down !'
	,'date_invalid' => 'Debe proveer una fecha válida para este evento !'
	,'end_days_invalid' => 'El valor ingresado en el campo \'Días\' no es válido !'
	,'end_hours_invalid' => 'El valor ingresado en el campo \'Horas\' no es válido !'
	,'end_minutes_invalid' => 'El valor ingresado en el campo \'Minutos\' no es válido !'

	,'non_valid_extension' => 'El formato del archivo de la imagen adjunta no está soportado ! (Extensiones válidas: %s)'

	,'file_too_large' => 'La imagen adjunta es más grande que %d KBytes !'
	,'move_image_failed' => 'El sistema falló al mover la imagen cargada !'
	,'non_valid_dimensions' => 'El ancho o largo de la imagen es mayor que %s pixels !'

	,'recur_val_1_invalid' => 'El valor ingresado como \'intervalo de repetición\' no es válido. Este valor debe ser un número más grande que \'0\' !'
	,'recur_end_count_invalid' => 'El valor ingresado como \'número de ocurrencias\' no es válido. Este valor debe ser un número más grande que \'0\' !'
	,'recur_end_until_invalid' => 'La fecha \'repetir hasta\' debe ser mayor que la fecha de inicio del evento !'
// Misc. messages
	,'submit_event_pending' => 'Su evento esta pendiente de aprobación. Gracias por enviarlo!'
	,'submit_event_approved' => 'Su evento ha sido automáticamente aprobado. Gracias por enviarlo!'
	,'event_repeat_msg' => 'Este evento se repite'
	,'event_no_repeat_msg' => 'Este evento no se repite'
);

// ======================================================
// daily view
// ======================================================

$lang_daily_event_view = array(
	'section_title' => 'Vista Diaria'
	,'next_day' => 'Próximo día'
	,'previous_day' => 'Día previo'
	,'no_events' => 'No hay eventos en este día'
);

// ======================================================
// weekly view
// ======================================================

$lang_weekly_event_view = array(
	'section_title' => 'Vista Semanal'
	,'week_period' => '%s - %s'
	,'next_week' => 'Próxima semana'
	,'previous_week' => 'Semana previa'
	,'selected_week' => 'Semana %d'
	,'no_events' => 'No hay eventos en esta semana'
);

// ======================================================
// monthly view
// ======================================================

$lang_monthly_event_view = array(
	'section_title' => 'Vista Mensual'
	,'next_month' => 'Próximo mes'
	,'previous_month' => 'Mes previo'
);

// ======================================================
// flat view
// ======================================================

$lang_flat_event_view = array(
	'section_title' => 'Vista Plana'
	,'week_period' => '%s - %s'
	,'next_month' => 'Próximo mes'
	,'previous_month' => 'Mes previo'
	,'contact_info' => 'Información Contacto'
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
	,'cat_name' => 'Categoría'
	,'event_start_date' => 'Fecha'
	,'event_end_date' => 'Hasta'
	,'event_duration' => 'Duración'
	,'contact_info' => 'Información Contacto'
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
	'section_title' => 'Vista Categorías'
	,'cat_name' => 'Nombre Categoría'
	,'total_events' => 'Eventos Totales'
	,'upcoming_events' => 'Próximos Eventos'
	,'no_cats' => 'No hay categorías para mostrar.'
	,'stats_string' => 'Hay <strong>%d</strong> Eventos en la Categoría <strong>%d</strong>'
);

// ======================================================
// Category Events view
// ======================================================

$lang_cat_events_view = array(
	'section_title' => 'Eventos bajo \'%s\''
	,'event_name' => 'Nombre del Evento'
	,'event_date' => 'Fecha'
	,'no_events' => 'No hay eventos en esta categoría.'
	,'stats_string' => '<strong>%d</strong> Eventos en Total'
);

// ======================================================
// cal_search.php
// ======================================================

$lang_event_search_data = array(
	'section_title' => 'Búsqueda en Calendario',
	'search_results' => 'Resultados Búsqueda',
	'category_label' => 'Categoría',
	'date_label' => 'Fecha',
	'no_events' => 'No hay eventos en esta categoría.',
	'search_caption' => 'Ingrese algunas palabras clave...',
	'search_again' => 'Buscar de nuevo',
	'search_button' => 'Buscar',
// Misc.
	'no_results' => 'No se encontraron resultados',	
// Stats
	'stats_string1' => '<strong>%d</strong> evento(s) encontrados',
	'stats_string2' => '<strong>%d</strong> Evento(s) en <strong>%d</strong> página(s)'
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
	'account_info_label' => 'Información de Cuenta',
	'user_name' => 'Nombre Usuario',
	'user_pass' => 'Password',
	'user_pass_confirm' => 'Confirmar Password',
	'user_email' => 'Dirección E-mail',
	'group_label' => 'Miembro del Grupo',
// Other Details
	'other_details_label' => 'Otros Detalles',
	'first_name' => 'Nombre',
	'last_name' => 'Apellido',
	'full_name' => 'Nombre completo',
	'user_website' => 'Home page',
	'user_location' => 'Locación',
	'user_occupation' => 'Ocupación',
// Misc.
	'select_language' => 'Seleccione Lenguaje',
	'edit_profile_success' => 'Modificación de perfil satisfactoria',
	'update_pass_info' => 'Deje el campo password vacío si no necesita cambiarlo',
// Error messages
	'invalid_password' => 'Por favor ingrese una password que consista solo de letras y números, entre 4 y 16 caracteres de longitud !',
	'password_is_username' => 'La password debe ser diferente al nombre de usuario !',
	'password_not_match' =>'La password que ingreso no coincide \'confirme la password\'',
	'invalid_email' => 'Debe ingresar una direccion de email válida !',
	'email_exists' => 'Otro usuario se ha registrado con la dirección de email que usted ingresó. Por favor ingrese un email diferente !',
	'no_email' => 'Debe ingresar una dirección de email !',
	'invalid_email' => 'Debe ingresar una dirección de email válida !',
	'no_password' => 'Debe ingresar una password para esta cuenta nueva !'
);

// ======================================================
// register.php
// ======================================================

if (defined('USER_REGISTRATION_PHP')) 

$lang_user_registration_data = array(
	'section_title' => 'Registración de Usuario',
// Step 1: Terms & Conditions
	'terms_caption' => 'Términos y Condiciones',
	'terms_intro' => 'Para poder proceder, debe estar de acuerdo con lo siguiente:',
	'terms_message' => 'Por favor tome un momento para revisar las reglas detalladas a continuación. Si está de acuerdo con ellas y desea proceder con la registración, simplemente haga click en el botón "De acuerdo". Para cancelar esta registración, simplemente apriente el botón \'back\' en su navegador.<br /><br />Por favor recuerdo que no somos responsables de cualquiery evento ingresado por usuarios de esta aplicación de calendario. No damos garantía de precisión, completitud o  usabilidad de cualquier evento ingresado, y no somos responsables por el contenido de los eventos.<br /><br />Los mensajes expresan la visión del autor de los eventos, no necesariamente la visión de la aplicación del calendariol. Cualquier usuario que sienta que se ha ingresado un evento objetable puede contactarse inmediatamente con nosotros por email. Tenemos la posibilidad de remover contenidos objetables y haremos nuestro mayor esfuerzo, dentro de un plazo de tiempo razonable, para removerlos si es necesario.<br /><br />Está de acuerdo, respecto al uso de este servicio, que no se podrá emplear este calendario para colocar cualquier material que sea reconocido como falso y/o difamatorio, inexacto, abusivo, vulgar, peligroso, obsceno, profano, orientado sexualmente, amenazador, invasivo de la privacidad personal, o que viole cualquier legislación<br /><br />Acuerda no ingresar material que posea derechos de autor a menos que la propiedad sea suya o %s.',
	'terms_button' => 'De acuerdo',
	
// Account Info
	'account_info_label' => 'Información de Cuenta',
	'user_name' => 'Nombre de Usuario',
	'user_pass' => 'Password',
	'user_pass_confirm' => 'Confirmar Password',
	'user_email' => 'Dirección de E-mail',
// Other Details
	'other_details_label' => 'Otros Detalles',
	'first_name' => 'Nombre',
	'last_name' => 'Apellido',
	'user_website' => 'Home page',
	'user_location' => 'Ubicación',
	'user_occupation' => 'Ocupación',
	'register_button' => 'Enviar mi registración',

// Stats
	'stats_string1' => '<strong>%d</strong> usuarios',
	'stats_string2' => '<strong>%d</strong> usuarios en <strong>%d</strong> página(s)',
// Misc.
	'reg_nomail_success' => 'Gracias por su registro.',
	'reg_mail_success' => 'Un email con información sobre como activar su cuenta fue enviado a la dirección de correo que nos suministró.',
	'reg_activation_success' => 'Felicitaciones! Su cuenta esta activa y Ud. puede ingresar con su nombre de usuario y password. Gracias por su registro.',
// Mail messages
	'reg_confirm_subject' => 'Registración a %s',
	
// Error messages
	'no_username' => 'Debe proveer un nombre de usuario !',
	'invalid_username' => 'Por favor ingrese un nombre de usuario que consite solo en letras y números, entre 4 y 30 caracteres de longitud !',
	'username_exists' => 'El nombre de usuario que ingresó, ya existe. Por favor pruebe con un nombre de usuario diferente !',
	'no_password' => 'Debe ingresar una password !',
	'invalid_password' => 'Por favor ingrese una password que consista solo de letras y números, entre 4 y 16 caracteres de longitud !',
	'password_is_username' => 'La password debe ser diferente del nombre de usuario !',
	'password_not_match' =>'La password que ingresó no corresponde \'confirme password\'',
	'no_email' => 'Debe ingresar una dirección de email !',
	'invalid_email' => 'Debe ingresar una dirección de email válida !',
	'email_exists' => 'Otro usuario se encuentra registrado con la misma dirección de email que Ud. ingresó. Por favor ingrese una dirección de email diferente !',
	'delete_user_failed' => 'Esta cuenta de usuario no puede ser eliminada',
	'no_users' => 'No hay cuentas de usuario para mostrar !',
	'already_logged' => 'Ud. ya ha ingresado como miembro !',
	'registration_not_allowed' => 'La registración de usuarios está actualmente deshabilitada !',
	'reg_email_failed' => 'Ocurrió un error mientras se trataba de enviar el email de activación !',
	'reg_activation_failed' => 'Ocurrió un error mientras se estaba en el proceso de activación !'

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

La administración de {CALENDAR_NAME}

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
	'section_title' => 'Administración de Eventos',
	'events_to_approve' => 'Administración de Eventos: Eventos para Aprobar',
	'upcoming_events' => 'Administración de Eventos: Eventos futuros',
	'past_events' => 'Administración de Eventos: Eventos Pasados',
	'add_event' => 'Agregar un Nuevo Evento',
	'edit_event' => 'Editar Evento',
	'view_event' => 'Ver Evento',
	'approve_event' => 'Aprobar Evento',
	'update_event' => 'Modificar Información de Evento',
	'delete_event' => 'Eliminar Evento',
	'events_label' => 'Eventos',
	'auto_approve' => 'Auto Aprobación',
	'date_label' => 'Fecha',
	'actions_label' => 'Acciones',
	'events_filter_label' => 'Filtro de Eventos',
	'events_filter_options' => array('Mostrar todos los eventos','Mostrar sólo los eventos no aprobados','Mostras sólo los eventos futuros','Mostrar sólo los eventos pasados'),
	'picture_attached' => 'Imagen adjunta',
// View Event
	'view_event_name' => 'Evento: \'%s\'',
	'event_start_date' => 'Fecha',
	'event_end_date' => 'Hasta',
	'event_duration' => 'Duración',
	'contact_info' => 'Información de Contacto',
	'contact_email' => 'Email',
	'contact_url' => 'URL',
// General Info
// Event form
	'edit_event_title' => 'Evento: \'%s\'',
	'cat_name' => 'Categoría',
	'event_start_date' => 'Fecha',
	'event_end_date' => 'Hasta',
	'contact_info' => 'Información de Contacto',
	'contact_email' => 'Email',
	'contact_url' => 'URL',
	'no_event' => 'No hay eventos para mostrar.',
	'stats_string' => '<strong>%d</strong> Eventos en Total',
// Stats
	'stats_string1' => '<strong>%d</strong> evento(s)',
	'stats_string2' => 'Total: <strong>%d</strong> eventos en <strong>%d</strong> página(s)',
// Misc.
	'add_event_success' => 'Nuevo evento agregado satisfactoriamente',
	'edit_event_success' => 'Evento modificado satisfactoriamente',
	'approve_event_success' => 'Evento aprobado satisfactoriamente',
	'delete_confirm' => 'Está seguro que quiere eliminar este evento ?',
	'delete_event_success' => 'Evento eliminado satisfactoriamente',
	'active_label' => 'Activo',
	'not_active_label' => 'No Activo',
// Error messages
	'no_event_name' => 'Debe ingresar un nombre para este evento !',
	'no_event_desc' => 'Debe ingresar una descripción para este evento !',
	'no_cat' => 'Debe seleccionar una categoría para este evento !',
	'no_day' => 'Debe seleccionar un día !',
	'no_month' => 'Debe seleccionar un mes !',
	'no_year' => 'Debe seleccionar un año !',
	'non_valid_date' => 'Por favor ingrese una fecha válida !',
	'end_days_invalid' => 'Por favor asegúrese que el campo \'Días\' bajo \'Duración\' consiste solamente de números !',
	'end_hours_invalid' => 'Por favor asegúrese que el campo \'Horas\' bajo \'Duración\' consiste solamente de números !',
	'end_minutes_invalid' => 'Por favor asegúrese que el campo \'Minutos\' bajo \'Duración\' consiste solamente de números !',
	'file_too_large' => 'La imagen que adjuntó en mayor que %d KBytes !',
	'non_valid_extension' => 'El formato del archivo de la imagen adjunta no es soportado !',
	'delete_event_failed' => 'Este evento no puede ser eliminado',
	'approve_event_failed' => 'Este evento no puede ser aprobado',
	'no_events' => 'No hay eventos para mostrar !',
	'move_image_failed' => 'El sistema falló al mover la imagen cargada !',
	'non_valid_dimensions' => 'El ancho o largo de la imagne es mayor que %s pixels !',

	'recur_val_1_invalid' => 'El valor ingresado como \'intervalo de repetición\' no es válido. Este valor debe ser un número mayor que \'0\' !',
	'recur_end_count_invalid' => 'El valor ingresado como \'número de ocurriencias\' no es válido. Este valor debe ser un número mayor que \'0\' !',
	'recur_end_until_invalid' => 'La fecha de \'repetir hasta\' debe ser mayir que la fecha de inicio del evento !'

);

// ======================================================
// admin_categories.php
// ======================================================

if (defined('ADMIN_CATS_PHP')) 

$lang_cat_admin_data = array(
	'section_title' => 'Administración de Categorías',
	'add_cat' => 'Agregar Nueva Categoría',
	'edit_cat' => 'Editar Categoría',
	'update_cat' => 'Modificar Información de Categoría',
	'delete_cat' => 'Borrar Categoría',
	'events_label' => 'Eventos',
	'visibility' => 'Visibilidad',
	'actions_label' => 'Acciones',
	'users_label' => 'Usuarios',
	'admins_label' => 'Administradores',
// General Info
	'general_info_label' => 'Información General',
	'cat_name' => 'Nombre de la Categoría',
	'cat_desc' => 'Descripción de la Categoría',
	'cat_color' => 'Color',
	'pick_color' => 'Elegir un Color!',
	'status_label' => 'Estado',
// Administrative Options
	'admin_label' => 'Opciones Administrativas',
	'auto_admin_appr' => 'Auto aprobar envíos de la administración',
	'auto_user_appr' => 'Auto aprobar envíos del usuario',
// Stats
	'stats_string1' => '<strong>%d</strong> categorías',
	'stats_string2' => 'Activo: <strong>%d</strong>&nbsp;&nbsp;&nbsp;Total: <strong>%d</strong>&nbsp;&nbsp;&nbsp;on <strong>%d</strong> página(s)',
// Misc.
	'add_cat_success' => 'Nueva categoría agregada satisfactoriamente',
	'edit_cat_success' => 'Categoría modificada satisfactoriamente',
	'delete_confirm' => 'Está seguro que quiere eliminar esta categoría ?',
	'delete_cat_success' => 'Categoría eliminada satisfactoriamente',
	'active_label' => 'Activo',
	'not_active_label' => 'No Activo',
// Error messages
	'no_cat_name' => 'Debe ingresar un nombre para esta categoría !',
	'no_cat_desc' => 'Debe ingresar una descripción para esta categoría !',
	'no_color' => 'Debe ingresar un color para esta categoría !',
	'delete_cat_failed' => 'Esta categoría no puede ser eliminada',
	'no_cats' => 'No hay categorías para mostrar !',
	'cat_has_events' => 'Esta categoría contiene %d evento(s) y por esto no puede ser eliminada!<br>Por favor saque los eventos bajo esta categoría y pruebe de nuevo!'

);
// ======================================================
// admin_users.php
// ======================================================

if (defined('ADMIN_USERS_PHP')) 

$lang_user_admin_data = array(
	'section_title' => 'Administración de Usuarios',
	'add_user' => 'Agregar Nuevo Usuario',
	'edit_user' => 'Editar Información del Usuario',
	'update_user' => 'Modificar Información del Usuario',
	'delete_user' => 'Eliminar Cuenta de Usuario',
	'last_access' => 'Ultimo Acceso',
	'actions_label' => 'Acciones',
	'active_label' => 'Activo',
	'not_active_label' => 'No Activo',
// Account Info
	'account_info_label' => 'Información de Cuenta',
	'user_name' => 'Nombre del Usuario',
	'user_pass' => 'Password',
	'user_pass_confirm' => 'Confirmar Password',
	'user_email' => 'Dirección de E-mail',
	'group_label' => 'Miembro del Grupo',
	'status_label' => 'Estado de la Cuenta',
// Other Details
	'other_details_label' => 'Otros Detalles',
	'first_name' => 'Nombre',
	'last_name' => 'Apellido',
	'user_website' => 'Home page',
	'user_location' => 'Ubicación',
	'user_occupation' => 'Ocupación',
// Stats
	'stats_string1' => '<strong>%d</strong> usuarios',
	'stats_string2' => '<strong>%d</strong> usuarios en <strong>%d</strong> página(s)',
// Misc.
	'select_group' => 'Seleccione uno...',
	'add_user_success' => 'Cuenta de usuario agregada satisfactoriamente',
	'edit_user_success' => 'Cuenta de usuario modificada satisfactoriamente',
	'delete_confirm' => 'Está seguro que quiere eliminar esta cuenta?',
	'delete_user_success' => 'Cuenta de usuario eliminada satisfactoriamente',
	'update_pass_info' => 'Deje el campo password vacío si no necesita cambiarlo',
	'access_never' => 'Nunca',
// Error messages
	'no_username' => 'Debe ingresar un nombre de usuario !',
	'invalid_username' => 'Por favor ingrese un nombre de usuario que consista sólo de letras y números, entre 4 y 30 caracteres de longitud !',
	'invalid_password' => 'Por favor ingrese una password que consista sólo de letras y números, entre 4 y 16 caracteres de longitud !',
	'password_is_username' => 'La password debe ser diferente al nombre del usuario !',
	'password_not_match' =>'La password que ingresó no corresponde \'confirme la password\'',
	'invalid_email' => 'Debe ingresar una dirección de email válida !',
	'email_exists' => 'Otro usuario se ha registrado con la dirección de email que usted ingresó. Por favor ingrese una dirección de email diferente !',
	'username_exists' => 'El nombre de usuario que ingresó ya existe. Por favor sugiera un nombre de usuario diferente !',
	'no_email' => 'Debe ingresar una dirección de email !',
	'invalid_email' => 'Debe ingresar una dirección de email válida !',
	'no_password' => 'Debe ingresar una password para esta cuenta nueva !',
	'no_group' => 'Por favor seleccione un grupo de membresía para este usuario !',
	'delete_user_failed' => 'Esta cuenta de usuario no puede ser eliminada',
	'no_users' => 'No hay cuentas de usuarios para mostrar !'

);

// ======================================================
// admin_groups.php
// ======================================================

if (defined('ADMIN_GROUPS_PHP')) 

$lang_group_admin_data = array(
	'section_title' => 'Administración de Grupos',
	'add_group' => 'Agregar Nuevo Grupo',
	'edit_group' => 'Editar Grupo',
	'update_group' => 'Modificar Información de Grupo',
	'delete_group' => 'Eliminar Grupo',
	'view_group' => 'Ver Grupo',
	'users_label' => 'Miembros',
	'actions_label' => 'Acciones',
// General Info
	'general_info_label' => 'Información General',
	'group_name' => 'Nombre del Grupo',
	'group_desc' => 'Descripción del Grupo',
// Group Access Level
	'access_level_label' => 'Nivel de Acceso del Grupo',
	'Administrator' => 'Los usuarios de este grupo tienen accesos de administración',
	'can_manage_accounts' => 'Los usuarios de este grupo pueden administrar cuentas',
	'can_change_settings' => 'Los usuarios de este grupo pueden cambiar las definiciones del calendario',
	'can_manage_cats' => 'Los usuarios de este grupo pueden administrar categorías',
	'upl_need_approval' => 'Los evenots enviados requieren aprobación del administrador',
// Stats
	'stats_string1' => '<strong>%d</strong> grupos',
	'stats_string2' => 'Total: <strong>%d</strong> grupos en <strong>%d</strong> página(s)',
	'stats_string3' => 'Total: <strong>%d</strong> usuarios en <strong>%d</strong> página(s)',
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
	'no_group_desc' => 'Debe ingresar una descripción para este grupo !',
	'delete_group_failed' => 'Este grupo no puede ser eliminado',
	'no_groups' => 'No hay grupos para mostrar !',
	'group_has_users' => 'Este grupo contiene %d usuario(s) y por lo tanto no puede ser eliminado!<br>Por favor reubique los usuarios de este grupo y pruebe de nuevo!'

);

// ======================================================
// admin_settings.php / admin_settings_template.php / 
// admin_settings_updates.php
// ======================================================

$lang_settings_data = array(
	'section_title' => 'Definición de Calendario'
// Links
	,'admin_links_text' => 'Elija Sección'
	,'admin_links' => array('Definiciones Principales','Configuration de Plantilla','Modificación de Producto')
// General Settings
	,'general_settings_label' => 'Definiciones Generales'
	,'calendar_name' => 'Nombre del Calendario'
	,'calendar_description' => 'Descripción del Calendario'
	,'calendar_admin_email' => 'Email del administrador del Calendario'
	,'cookie_name' => 'Nombre de la cookie usada por el script'
	,'cookie_path' => 'Ruta de la cookie usada por el script'
	,'debug_mode' => 'Habilitar modo debug'
	,'calendar_status' => 'Estado del Calendario público'
// Environment Settings
	,'env_settings_label' => 'Definiciones de Entorno'
	,'lang' => 'Lenguaje'
		,'lang_name' => 'Lenguaje'
		,'lang_native_name' => 'Nombre Nativo'
		,'lang_trans_date' => 'Traducido el'
		,'lang_author_name' => 'Autor'
		,'lang_author_email' => 'E-mail'
		,'lang_author_url' => 'Website'
	,'charset' => 'Codificación de caracteres'
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
	,'auto_daylight_saving' => 'Ajuste automático para ahorro de luz diurna (DST)'
	,'main_table_width' => 'Ancho de la tabla principal (Pixels o %)'
	,'day_start' => 'Las semanas comienzan en'
	,'default_view' => 'Vista por default'
	,'search_view' => 'Habilitar búsqueda'
	,'archive' => 'Mostrar eventos pasados'
	,'events_per_page' => 'Número de eventos por página'
	,'sort_order' => 'Orden de clasificación default'
		,'sort_order_title_a' => 'Título ascendente'
		,'sort_order_title_d' => 'Título descendente'
		,'sort_order_date_a' => 'Fecha ascendente'
		,'sort_order_date_d' => 'Fecha descendente'
	,'show_recurrent_events' => 'Mostrar eventos recurrentes'
	,'multi_day_events' => 'Eventos multi-día'
		,'multi_day_events_all' => 'Mostrar rango completo de fechas'
		,'multi_day_events_bounds' => 'Mostrar sólo las fecha de inicio y fin'
		,'multi_day_events_start' => 'Mostrar sólo las fechas de inicio'
	// User Settings
	,'user_settings_label' => 'Definiciones de usuarios'
	,'allow_user_registration' => 'Permitir registración de usuarios'
	,'reg_duplicate_emails' => 'Permitir emails duplicados'
	,'reg_email_verify' => 'Habilitar la activación de cuentas a través de email'
// Event View
	,'event_view_label' => 'Vista de Evento'
	,'popup_event_mode' => 'Ventana de Evento'
	,'popup_event_width' => 'Ancho de la ventana'
	,'popup_event_height' => 'Alto de la ventana'
// Add Event View
	,'add_event_view_label' => 'Agregar vista de evento'
	,'add_event_view' => 'Habiltar'
	,'addevent_allow_html' => 'Permitir <b>Código BB</b> en la descripción'
	,'addevent_allow_contact' => 'Permitir contacto'
	,'addevent_allow_email' => 'Permitir Email'
	,'addevent_allow_url' => 'Permitir URL'
	,'addevent_allow_picture' => 'Permitir imágenes'
	,'new_post_notification' => 'Notificación de nuevo evento'
// Calendar View
	,'calendar_view_label' => 'Vista de Calendario (Mensual)'
	,'monthly_view' => 'Habilitada'
	,'cal_view_show_week' => 'Mostrar número de semana'
	,'cal_view_max_chars' => 'Máximo de Caracteres en la Descripción'
// Flyer View
	,'flyer_view_label' => 'Vista voladora'
	,'flyer_view' => 'Habilitada'
	,'flyer_show_picture' => 'Mostrar imágenes en la vista voladora'
	,'flyer_view_max_chars' => 'Máximo de Caracteres en la Descripción'
// Weekly View
	,'weekly_view_label' => 'Vista Semanal'
	,'weekly_view' => 'Habilitada'
	,'weekly_view_max_chars' => 'Máximo de Caracteres en la Descripción'
// Daily View
	,'daily_view_label' => 'Vista Diaria'
	,'daily_view' => 'Habilitada'
	,'daily_view_max_chars' => 'Máximo de Caracteres en la Descripción'
// Categories View
	,'categories_view_label' => 'Vista de Categorías'
	,'cats_view' => 'Habilitada'
	,'cats_view_max_chars' => 'Máximo de Caracteres en la Descripción'
// Mini Calendar
	,'mini_cal_label' => 'Mini Calendario'
	,'mini_cal_def_picture' => 'Imagen inicial'
	,'mini_cal_display_picture' => 'Mostrar imagen'
	,'mini_cal_diplay_options' => array('Nada','Imagen inicial', 'Imagen diaria','Imagen semanal','Imagen al azar')
// Mail Settings
	,'mail_settings_label' => 'Definiciones de Mail'
	,'mail_method' => 'Método para envío de Mail'
	,'mail_smtp_host' => 'Hosts SMTP (separados por punto y coma ;)'
	,'mail_smtp_auth' => ' Autenticación SMTP'
	,'mail_smtp_username' => 'Nombre de Usuario SMTP'
	,'mail_smtp_password' => 'Password SMTP'

// Picture Settings
	,'picture_settings_label' => 'Definición de imagen'
	,'max_upl_dim' => 'Max. ancho o alto para imágenes subidas'
	,'max_upl_size' => 'Max. tamaño para imágenes subidas (en Bytes)'
	,'picture_chmod' => 'Modo inicial para imágenes (CHMOD) (en Octal)'
	,'allowed_file_extensions' => 'Extensiones de archivos aceptadas para imágenes subidas'
// Form Buttons
	,'update_config' => 'Guardar Nueva Configuración'
	,'restore_config' => 'Recuperar los valores de fábrica'
// Misc.
	,'update_settings_success' => 'Definición satisfactoria de modificaciones'
	,'restore_default_confirm' => 'Esta seguro que desea recuperar las definiciones originales ?'
// Template Configuration
	,'template_type' => 'Tipo de Plantilla'
	,'template_header' => 'Definición de la cabecera'
	,'template_footer' => 'Definición del pie'
	,'template_status_default' => 'Usar la plantilla de tema original'
	,'template_status_custom' => 'Usar la plantilla siguiente:'
	,'template_custom' => 'Plantilla personalizada'

	,'info_meta' => 'Meta Información'
	,'info_status' => 'Estado de control'
	,'info_status_default' => 'Deshabilitar este contenido'
	,'info_status_custom' => 'Mostrar el contenido siguiente:'
	,'info_custom' => 'Contenido personalizado'

	,'dynamic_tags' => 'Marcas dinámicas'

// Product Updates
	,'updates_check_text' => 'Por favor espere mientras recuperamos la informacion desde el server...'
	,'updates_no_response' => 'No hay respuesta del server. Por favor intente luego.'
	,'avail_updates' => 'Modificaciones disponibles'
	,'updates_download_zip' => 'Descargar paquete ZIP (.zip)'
	,'updates_download_tgz' => 'Descargar paquete TGZ (.tar.gz)'
	,'updates_released_label' => 'Fecha de publicación: %s'
	,'updates_no_update' => 'Esta corriendo la última versión disponible. No requiere modificaciones.'
);

// ======================================================
// cal_mini.inc.php
// ======================================================

$lang_mini_cal = array(
	'def_pic' => 'Imagen original'
	,'daily_pic' => 'Imagen del día (%s)'
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
	,'invalid_login' => 'Por favor verifique la información ingresada y pruebe nuevamente!'
	,'no_username' => 'Debe ingresar un nombre de usuario !'
	,'already_logged' => 'Usted ya esta conectado !'
);

// ======================================================
// logout.php
// ======================================================

// To Be Done


?>