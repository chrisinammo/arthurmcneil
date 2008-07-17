<?php
/**
 * Events Component for Joomla 1.0.x
 *
 * @version     $Id: admin_spanish.php 849 2007-07-21 17:47:48Z tstahl $
 * @package     Events
 * @copyright   Copyright (C) 2006 JEvents Project Group
 * @copyright (C) 2000 - 2003 Eric Lamette, Dave McDonnell
 * @licence     http://www.gnu.org/copyleft/gpl.html
 * @link        http://joomlacode.org/gf/project/jevents
 */


defined( '_VALID_MOS' ) or die( 'Sin acceso Directo' );

//Check
if( defined( '_CAL_ADMIN_LANG_INCLUDED' )) {
	return;
}

DEFINE( '_CAL_ADMIN_LANG_INCLUDED', 1 );

/* +++++++++++++++++++ */
define( '_CAL_HIDE_OLD_EVENTS',			'Ocultar eventos pasados'); // NEW 1.4
define( '_CAL_LANG_CATEGORIES',   		'Categorías' );
define( '_CAL_LANG_DISPLAY',			'Mostrar' );
define( '_CAL_LANG_CATEGORY_NAME',		'Nombre Categorías' );
define( '_CAL_LANG_RECORDS',			'def&nbsp;Records' );
define( '_CAL_LANG_CHECKED_OUT',		'Comporbado&nbsp;Out' );
define( '_CAL_LANG_PUBLISHED',			'Publicado' );
define( '_CAL_LANG_NOT_PUBLISHED',		'No Publicado' );
define( '_CAL_LANG_ACCESS',				'Acceso' );
define( '_CAL_LANG_REORDER',			'Reordenar' );
define( '_CAL_LANG_UNPUBLISH',			'Sin Publicar' );
define( '_CAL_LANG_PUBLISH',			'Publicar' );
define( '_CAL_LANG_CLICK_TO_EDIT',		'Click para editar' );
define( '_CAL_LANG_MOVE_UP',			'Subir' );
define( '_CAL_LANG_MOVE_DOWN',			'Bajar' );
define( '_CAL_LANG_EDIT_CAT',			'Editar Categoria' );
define( '_CAL_LANG_ADD_CAT',			'Añadir Categoria' );
define( '_CAL_LANG_CAT_TITLE',			'Título Categoría' );
define( '_CAL_LANG_CAT_NAME',			'Nombre Categoría' );
define( '_CAL_LANG_IMAGE',				'Imagen' );
define( '_CAL_LANG_PREVIEW',			'Previsualizar' );
define( '_CAL_LANG_IMG_POSITION',		'Posicion Imagen' );
define( '_CAL_LANG_ORDERING',			'Ordenar' );
define( '_CAL_LANG_LEFT',				'Izquierda' );
define( '_CAL_LANG_CENTER',				'Centrado' );
define( '_CAL_LANG_RIGHT',				'Derecha' );
define( '_CAL_LANG_SELECT_IMAGE',		'Seleccionar Imagen' );
define( '_CAL_LANG_SEARCH',				'Buscar' );
define( '_CAL_LANG_TITLE',				'Titulo' );
define( '_CAL_LANG_REPEAT',				'Repetir' );
define( '_CAL_LANG_TIME_SHEET',			'Control Horario' );
define( '_CAL_CLICK_TO_CHANGE_STATUS',	'Click en el icono para cambiar el estado' );
define( '_CAL_LANG_PUB_BUT_COMING',		'Publicado, pero esta <u>Coming</u>' );
define( '_CAL_LANG_PUB_ACTUAL',			'Publicado y esta <u>Current</u>' );
define( '_CAL_LANG_PUB_FINISHED',		'Publicado, pero has <u>Finished</u>' );
define( '_CAL_LANG_EDIT_EVENT',			'Editar evento' );
define( '_CAL_LANG_ADD_EVENT',			'Añadir evento' );
define( '_CAL_LANG_REQUIRED',			'requerido' );
define( '_CAL_LANG_IMG_FOLDER',			'Sub-carpeta' );
define( '_CAL_LANG_IMAGES',				'Galeria de Imagenes' );
define( '_CAL_LANG_AVAL_IMAGES',		'Imagenes Disponibles' );
define( '_CAL_LANG_INSERT_IMG',			'Insertar &raquo;' );
define( '_CAL_LANG_CONTENT_IMGS',		'Contener Imagenes' );
define( '_CAL_LANG_REMOVE',				'Borrar' );
define( '_CAL_LANG_EDITED_SEL_IMG',		'Editar la imagen seleccionada' );
define( '_CAL_LANG_SOURCE',				'Origen' );
define( '_CAL_LANG_ALIGN',				'Alinear' );
define( '_CAL_LANG_ALT_TXT',			'Texto Alternativo' );
define( '_CAL_LANG_BORDER',				'Borde' );
define( '_CAL_LANG_CAPTION',			'Subtitulo');
define( '_CAL_LANG_CAPTION_POSITION',	'Posicion Subtitulo');
define( '_CAL_LANG_CAPTION_POS_BOTTOM',	'Bajo');
define( '_CAL_LANG_CAPTION_POS_TOP',	'Arriba');
define( '_CAL_LANG_CAPTION_ALIGN',		'Alinear Subtitulo');
define( '_CAL_LANG_CAPTION_WIDTH',		'Ancho Subtitulo');
define( '_CAL_LANG_APPLY',				'Aplicar' );
define( '_CAL_LANG_ADD_INFO',			'Informacion Adicional' );
define( '_CAL_LANG_EVENT_STATUS',		'Estado del Evento' );
define( '_CAL_LANG_ARCHIVED',			'Archivado' );
define( '_CAL_LANG_DRAFT_UNPUB',		'Borrador sin publicar' );
define( '_CAL_LANG_NEVER',				'Nunca' );
define( '_CAL_LANG_CUT_TITLE',			'Longitud Titulo' );
define( '_CAL_LANG_MAX_DISPLAY',		'Max. Eventos' );
define( '_CAL_LANG_DIS_STARTTIME',		'Mostrar tiempo de inicio' );

	// config
define( '_CAL_LANG_EVENTS_CONFIG',		'JEvents Configuracion' );
define( '_CAL_LANG_CONFIG_WRITEABLE',	'Configuracion es modificable' );
define( '_CAL_LANG_CONFIG_NOT_WRITEABLE','Configuracion no es modificable' );
define( '_CAL_LANG_CSS_WRITEABLE',		'CSS es modificable' );
define( '_CAL_LANG_CSS_NOT_WRITEABLE',	'CSS no es modificabl' );
define( '_CAL_LANG_ADMIN_EMAIL',		'Emal Administrador' );
define( '_CAL_LANG_FRONTEND_PUBLISHING','Publicar desde el Frontend' );
define( '_CAL_LANG_SETT_FOR_COM',		'Estos cambios son solo para el componente' );
define( '_CAL_LANG_SETT_FOR_CAL_MOD',	'Estos cambios son solo para los modulos adicionales del calendario' );
define( '_CAL_LANG_SETT_FOR_MOD_LATEST','Este cambio es solo para el modulo adicional [ Latest Events ]' );
define( '_CAL_LANG_ICONIC_NAVBAR'		,'Use la nueva barra de Iconos de Navegacion'); // 1.4
define( '_CAL_LANG_CHECK_VERSION'		,"Comprobar una nueva version"); // 1.4

// errors
define( '_CAL_LANG_ERR_CAT_MUST_HAVE_NAME',	'La Categoria debe tener un nombre' );

// title & alts
define( '_CAL_LANG_TIT_NAME_FOR_MENUS',	'Nombre corto que aparecera en los menus' );
define( '_CAL_LANG_TIT_LONG_NAME',		'Nombre largo para mostrar en el encabezado' );
define( '_CAL_LANG_TIT_PENDING',		'Pendiente' );

// msgs
define( '_CAL_LANG_MSG_CAT_IS_EDITED',	'La categoria [ %s ] esta siendo editada por otro administrador' ); // %s = $row->title
define( '_CAL_LANG_MSG_OP_FAILED',		'Fallo operativo: No es posible abrir [ %s ]' ); // %s = $filename
define( '_CAL_LANG_MSG_CHANGE_EMAIL',	'Ir a SECCION CONFIGURACION DE EVENTOS primero y cambiar la direccion de EMAIL' );
define( '_CAL_LANG_MSG_ADD_CAT_BEFORE',	'Debes añadir una categoria para esta seccion primero' );
define( '_CAL_LANG_MSG_CONFIG_SAVED',	'Configuracion ha sido guardada' );
define( '_CAL_LANG_MSG_WARNING',		'Atencion...' );
define( '_CAL_LANG_MSG_CHMOD_CONFIG',	'You need to chmod config file to 0777 in order for the config to be updated' );
define( '_CAL_LANG_MSG_CHMOD_CSS',		'You need to chmod css file to 0777 in order for the config to be updated' );
define( '_CAL_LANG_MSG_MOD_NOT_INSTALLED','El modulo de calendario no esta instalado' );
define( '_CAL_LANG_MSG_NO_MOD_LATEST',	'El modulo [ latest events ] no esta instalado' );

// tips
define( '_CAL_LANG_TIP_ACCESS',			'Quien esta autorizadoa a crear nuevos eventos' );
define( '_CAL_LANG_TIP_FRONT_PUB',		'Autorizar publishers, managers y usuarios admin para publicar conteniddo desde el frontend' );
define( '_CAL_LANG_TIP_NR_OF_LIST',		'No. de Eventos a listar por pagina por vista semanal, mensual o anual' );
define( '_CAL_LANG_TIP_FE_SIMPLE_FORM',	'Use Simple (IE. No Repeat types) Event entry Form for user front end' );
define( '_CAL_LANG_TIP_DEF_EC_HIDE_FORCE',	'<b>Permitir colores especificos a los Eventos</b><br/>Frontend and backend editors can use event specific colours<br/><b>Event colors in backend edit only</b><br/>Only backend editors can specify event specific colours<br/><b>Always use category colors</b><br/>Editors cannot use event specific colours and any events specific colours defined before the use of this setting will be ignored and the category colour displayed instead' );
define( '_CAL_LANG_TIP_DLM_STOP_DAY',		'Day in Current Month to Stop displaying Last Month' );
define( '_CAL_LANG_TIP_DNM_START_DAY',		'Days left in Current Month to Start displaying Next Month' );
define( '_CAL_LANG_TIP_LEV_DAY_RANGE',		'Day range relative to Current Day to display Events (modes 1 or 3 only)' );
define( '_CAL_LANG_TIP_LEV_DISPLAY_YEAR',	'Display Year in the Event\\\'s Date (default format only)' );
define( '_CAL_LANG_TIP_BTN_DEF_CONFIG',		'Loads default values [in the case something went wrong]' );
define( '_CAL_LANG_TIP_LEV_DISPLAY_MODE',	'0 (default) display closest events for current week and following week only up to maximal events<br />1 same as [ mode = 0 ] except some past events for the current week will also be displayed if num of future events is less than maximal events<br />2 display closest events for [ + days ] range relative to current day up to $maxEvents<br />3  same as mode 2 except if there are less than maximal events in the range, then display past events within [ - days ] range relative to current day<br />4 display closest events for current month up to maximal events relative to current day' );
define( '_CAL_LANG_TIP_CUT_TITLE',			'If a title has too many sign, an unwanted design could be the result.<br />Define here x sign after that the title will be cutted and ... added' );
define( '_CAL_LANG_TIP_LEV_HIDE_LINK',		'If set to YES, title link is set dynamically by the javascript &lt;b&gt;onclick&lt;/b&gt; event. This prevents search enginges to follow the link');
define( '_CAL_LANG_TIP_MAX_DISPLAY',		'Amount of maximal displayed events <strong>as text</strong> per day in month view<br />If you have many events per day, displaying them could distroying your layout.<br />Define here how many events should dislayed as text, if too many they will be displayed as an icon (tooltip is not affected)<br /><strong>Tip</strong>: Setting the value to 0 [null] force the display for all events as icon' );
define( '_CAL_LANG_TIP_DIS_STARTTIME',		'Should the starttime displayed [ month view ]' );
	// tooltips
define( '_CAL_LANG_TIP_TT_BGROUND',			'Should the tooltip use the same background as the event<br />At no the standard color will be used' );
define( '_CAL_LANG_TIP_TT_POSX',			'La posicion de la ventana tooltip puede ser izquierda, centrado o derecha' );
define( '_CAL_LANG_TIP_TT_POSY',			'La posicion horizontal de la ventana Tooltip puede ser sobre o bajo' );
define( '_CAL_LANG_TIP_TT_SHADOW',			'La ventana Tooltip puede tener sombra y puede dirigirse a izquierda o derecha y sobre o bajo' );

// tabs
define( '_CAL_LANG_TAB_COMMON',			'Common' );
define( '_CAL_LANG_TAB_IMAGES',			'Imagenes' );
define( '_CAL_LANG_TAB_CALENDAR',		'Calendario' );
define( '_CAL_LANG_TAB_HELP',			'Ayuda' );
define( '_CAL_LANG_TAB_EXTRA',			'Extra' );
define( '_CAL_LANG_TAB_ABOUT',			'Acerca de' );
define( '_CAL_LANG_TAB_COMPONENT',		'Componente' );
define( '_CAL_LANG_TAB_CAL_MOD',		'Calendario' );
define( '_CAL_LANG_TAB_LATEST_MOD',		'Ultimos Eventos' );
define( '_CAL_LANG_TAB_CSS',			'CSS' );
define( '_CAL_LANG_TAB_TOOLTIP',		'Tooltip' );

// select lists
	//common
define( '_CAL_LANG_YES',				'Si' );
define( '_CAL_LANG_NO',					'No' );
define( '_CAL_LANG_ALWAYS',				'SIEMPRE' );
	// access
define( '_CAL_LANG_SEL_ACCESS_ALL_REGGED',	'Todos los usuarios registrados' );
define( '_CAL_LANG_SEL_ACCESS_SPECIAL',		'Solo derechos especiales y admins' );
define( '_CAL_LANG_SEL_ACCESS_ALL_ANONYM',	'Todos (anonimos) - no recomendado' );
define( '_CAL_LANG_SEL_ACCESS_ALL_AUTHORS',	'Autores y superiores' );
define( '_CAL_LANG_SEL_ACCESS_ALL_EDITORS',	'Editores y superiores' );
define( '_CAL_LANG_SEL_ACCESS_ALL_PUBLISHERS',	'Publicadores y superiores' );
define( '_CAL_LANG_SEL_ACCESS_ALL_MANAGERS',	'Managers y superiores' );
define( '_CAL_LANG_SEL_ACCESS_ALL_ADMIN',	'Admins y Super Admins solo' );
	// first day
define( '_CAL_LANG_FIRST_DAY',			'Primer dia' );
define( '_CAL_LANG_SUNDAY_FIRST',		'Domingo primero' );
define( '_CAL_LANG_MONDAY_FIRST',		'Lunes primero' );

define( '_CAL_LANG_VIEW_MAIL',			'Ver mail' );
define( '_CAL_LANG_VIEW_BY',			'Ver "Por"' );
define( '_CAL_LANG_VIEW_HITS',			'Ver "Hits"' );
define( '_CAL_LANG_VIEW_REPEAT_TIME',	'Ver Repetir y tiempo' );
define( '_CAL_LANG_VIEW_REPEAT_YEAR_LIST',	'Mostrar todos los eventos repetidos en la Lista del Año' );
define( '_CAL_LANG_SHOW_CATS',			'Ocultar "Ver Por Categorias (apropriado si el modulo de leyendas esta visible)' );
define( '_CAL_LANG_SHOW_COPYRIGHT',		'Mostrar Pie de Copyright');
	// date format
define( '_CAL_LANG_DATE_FORMAT',		'Formato Fecha' );
define( '_CAL_LANG_DATE_FORMAT_FR_EN',	'Frances-Ingles' );
define( '_CAL_LANG_DATE_FORMAT_US',		'US' );
define( '_CAL_LANG_DATE_FORMAT_GERMAN',	'Continental - Aleman' );

define( '_CAL_LANG_TIME_FORMAT_12',		'Usar formato de 12h' );
	// nav bar
define( '_CAL_LANG_NAV_BAR_COLOR',		'Color Barra Navegacion' );
define( '_CAL_LANG_NAV_BAR_GREEN',		'Verde' );
define( '_CAL_LANG_NAV_BAR_ORANGE',		'Naranja' );
define( '_CAL_LANG_NAV_BAR_BLUE',		'Azul' );
define( '_CAL_LANG_NAV_BAR_RED',		'Rojo' );
define( '_CAL_LANG_NAV_BAR_GRAY',		'Gris' );
define( '_CAL_LANG_NAV_BAR_YELLOW',		'Amarillo' );

	// start page
define( '_CAL_LANG_START_PAGE',			'Pagina de Inicio' );
define( '_CAL_LANG_SP_DAY',				'Dia' );
define( '_CAL_LANG_SP_WEEK',			'Semana' );
define( '_CAL_LANG_SP_MONTH_CAL',		'Mes (Calendario)' );
define( '_CAL_LANG_SP_MONTH_LIST',		'Mes (Lista)' );
define( '_CAL_LANG_SP_YEAR',			'Año' );
define( '_CAL_LANG_SP_CATEGORIES',		'Categorias' );
define( '_CAL_LANG_SP_SEARCH',			'Buscar' );

define( '_CAL_LANG_NR_OF_LIST',			'No. de Eventos' );
define( '_CAL_LANG_FE_SIMPLE_FORM',		'Use Simple' );
	// event color
define( '_CAL_LANG_DEF_EVENT_COLOR',	'Color de Evento por Defecto' );
define( '_CAL_LANG_DEF_EC_RANDOM',		'Aleatorio' );
define( '_CAL_LANG_DEF_EC_NONE',		'Ninguno' );
define( '_CAL_LANG_DEF_EC_CATEGORY',	'Categoria' );
define( '_CAL_LANG_DEF_EC_HIDE_FORCE',	'Regla de Color de Evento' );
define( '_CAL_LANG_EVENT_COLS_ALLOWED',	'Colores de Eventos especificos permitidos' );
define( '_CAL_LANG_EVENT_COLS_BACKED',	'Edicion de Colores de Eventos solo en backend' );
define( '_CAL_LANG_ALWAYS_CAT_COLOR',	'Usar siempre los colores de categorias' );

	// tooltips
define( '_CAL_LANG_ABOVE',				'Sobre' );
define( '_CAL_LANG_BELOW',				'Bajo' );

// calendar module
	// display last month
define( '_CAL_LANG_DISPLAY_LAST_MONTH',	'Mostrar Ultimo Mes' );
define( '_CAL_LANG_DLM_YES_STOP_DAY',	'SI - con dia final' );
define( '_CAL_LANG_DLM_YES_EVENT_SDAY',	'SI - si ha eventos Y con dia final' );
define( '_CAL_LANG_DLM_ALWYS_IF_EVENTS','SIEMPRE - si hay eventos' );
	// stop day
define( '_CAL_LANG_DLM_STOP_DAY',		'Dias en este mes para detenerse' );
	// display next month
define( '_CAL_LANG_DISPLAY_NEXT_MONTH',	'Mostrar Proximo Mes' );
define( '_CAL_LANG_DNM_YES_START_DAY',	'SI - con dia de inicio' );
define( '_CAL_LANG_DNM_YES_EVENT_SDAY', 'SI - si hay eventos Y un dia de inicio' );
define( '_CAL_LANG_DNM_ALWYS_IF_EVENTS','SIEMPRE - si hay eventos' );
	// start day
define( '_CAL_LANG_DNM_START_DAY',		'Dias en este mes para iniciar' );

// latest events module
define( '_CAL_LANG_LEV_MAX_DISPLAY',	'Maximo de eventos para mostrar' );
define( '_CAL_LANG_LEV_DISPLAY_MODE',	'Modo visualizacion' );
define( '_CAL_LANG_LEV_DAY_RANGE',		'Dias Antes-Despues' );
define( '_CAL_LANG_LEV_REP_EV_ONCE',	'Solo Mostrar Enevtos Repetidos una vez' );
define( '_CAL_LANG_LEV_EV_AS_LINK',		'Mostrar Eventos como enlace' );
define( '_CAL_LANG_LEV_DISPLAY_YEAR',	'Mostrar Año' );
define( '_CAL_LANG_LEV_CSS_DATE_FIELD',	'Desactivar CSS por defecto del estilo del campo de Fecha CSS' );
define( '_CAL_LANG_LEV_CSS_TITLE_FIELD','Desactivar CSS por defecto del estilo del campo de Titulo CSS' );
define( '_CAL_LANG_LEV_HIDE_LINK',		'Ocultar enlace del titulo');
define( '_CAL_LANG_LEV_CUST_FORM_STRING','Formato de Cadena Personalizado' );

// tooltips frontpage (overlib)
define( '_CAL_LANG_TOOLTIP',			'Ajustes pertenecientes a la ventana de tooltip en la vista mensual' );
define( '_CAL_LANG_TT_MAINWINDOW',		'Ventana principal Tooltip' );
define( '_CAL_LANG_TT_BGROUND',			'Igual fondo que el evento' );
define( '_CAL_LANG_TT_POSX',			'Posicion Horizontal' );
define( '_CAL_LANG_TT_POSY',			'Posicion Vertical' );
define( '_CAL_LANG_TT_SHADOW',			'Sombra' );
define( '_CAL_LANG_TT_SHADOWX',			'Izquierda' );
define( '_CAL_LANG_TT_SHADOWY',			'Sobre' );

// buttons
define( '_CAL_LANG_BTN_DEF_CONFIG',		'Valores por defecto' );

// installation
define( '_CAL_LANG_INSTAL_MAIN',		'Eventos' );
define( '_CAL_LANG_INSTAL_MANAGE',		'Gestionar Eventos' );
define( '_CAL_LANG_INSTAL_CATS',		'Gestionar Categorias' );
define( '_CAL_LANG_INSTAL_CONFIG',		'Configuracion' );
define( '_CAL_LANG_INSTAL_ARCHIVE',		'Archivo' );
define( '_CAL_LANG_INSTAL_ERROR',		'Han ocurrido los siguientes errores' );
define( '_CAL_LANG_INSTAL_SUCCESS',		'Events ha sido instalado' );
define( '_CAL_LANG_INSTALL_DB_ENTRIES',	'Entradas DB, Cambios' );
define( '_CAL_LANG_INSTALL_PREV_INST',	'Eliminadas las entradas duplicadas de la DB' );

DEFINE("_CAL_LANG_EVENT_ALLDAY","Evento todo el dia son especificar horario");  // new for 1.4


?>

