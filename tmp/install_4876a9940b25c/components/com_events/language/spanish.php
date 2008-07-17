<?php
/**
 * Events Component for Joomla 1.0.x
 *
 * @version     $Id: spanish.php 897 2007-11-17 15:32:11Z tstahl $
 * @package     Events
 * @copyright   Copyright (C) 2006 JEvents Project Group
 * @licence     http://www.gnu.org/copyleft/gpl.html
 * @link        http://joomlacode.org/gf/project/jevents
 * Spanish translation by Juan Biosca, Rafael Romero, Yhony Fernandez & Miguel from www.isotrabajo.org
 */

defined("_VALID_MOS") or die("Direct Access to this location is not allowed");

//Check
DEFINE("_CAL_LANG_INCLUDED", 1);

// new 1.4.0 [mic]
define("_CAL_LANG_LNG",				"es"); // de|fr|etc... [ DO NOT CHANGE THIS VALUE! ]

// used for colorpicker
define("_CAL_LANG_NO_COLOR",			"Sin color");
define("_CAL_LANG_COLOR_PICKER",		"Selector de color");

// common
define("_CAL_LANG_TIME",			"Hora");
define("_CAL_LANG_CLICK_TO_OPEN_EVENT",	"Clic para abrir");
define("_CAL_LANG_UNPUBLISHED",		"** No publicado **");
define("_CAL_LANG_DESCRIPTION",		"Descripción");
define("_CAL_LANG_EMAIL_TO_AUTHOR",		"Email al autor");
define("_CAL_LANG_MAIL_TO_ADMIN",		"Evento enviado desde [%s] por [%s]");
define("_CAL_LANG_KEYWORD_NOT_VALID",	"Clave no válida");
define("_CAL_LANG_EVENT_CALENDAR",		"Calendario de eventos"); // new 1.4

// modul
define("_CAL_LANG_ERR_NO_MOD_CAL",		"Calendario de eventos\n<br />Este módulo necesita el componente Eventos (Events)");
define("_CAL_LANG_CLICK_TOSWITCH_DAY",	"Ir al calendario - día actual");
define("_CAL_LANG_CLICK_TOSWITCH_MON",	"Ir al calendario - mes actual");
define("_CAL_LANG_CLICK_TOSWITCH_YEAR",	"Ir al calendario - año actual");
define("_CAL_LANG_CLICK_TOSWITCH_PY",	"Ir al calendario - año anterior");
define("_CAL_LANG_CLICK_TOSWITCH_PM",	"Ir al calendario - mes anterior");

define("_CAL_LANG_CLICK_TOSWITCH_NM",	"Ir al calendario - mes siguiente");
define("_CAL_LANG_CLICK_TOSWITCH_NY",	"Ir al calendario - año siguiente");

// navTableNext
define("_CAL_LANG_NAV_TN_FIRST_LIST",	"lista primera");
define("_CAL_LANG_NAV_TN_PREV_LIST",	"lista previa");
define("_CAL_LANG_NAV_TN_NEXT_LIST",	"lista siguiente");

define("_CAL_LANG_NAV_TN_LAST_LIST",	"lista última");

// calendar monthly display
define("_CAL_LANG_FIRST_SINGLE_DAY_EVENT",	"Evento único");
define("_CAL_LANG_FIRST_DAY_OF_MULTIEVENT",	"Primer día de evento de varios días");
define("_CAL_LANG_LAST_DAY_OF_MULTIEVENT",	"Último día de evento de varios días");
define("_CAL_LANG_MULTIDAY_EVENT",			"Evento de varios días");
/* ++++++ end mic +++++++++++++ */

// Months
DEFINE("_CAL_LANG_JANUARY", "Enero");
DEFINE("_CAL_LANG_FEBRUARY", "Febrero");
DEFINE("_CAL_LANG_MARCH", "Marzo");
DEFINE("_CAL_LANG_APRIL", "Abril");
DEFINE("_CAL_LANG_MAY", "Mayo");
DEFINE("_CAL_LANG_JUNE", "Junio");
DEFINE("_CAL_LANG_JULY", "Julio");
DEFINE("_CAL_LANG_AUGUST", "Agosto");
DEFINE("_CAL_LANG_SEPTEMBER", "Septiembre");
DEFINE("_CAL_LANG_OCTOBER", "Octubre");
DEFINE("_CAL_LANG_NOVEMBER", "Noviembre");
DEFINE("_CAL_LANG_DECEMBER", "Diciembre");

// Short day names
DEFINE("_CAL_LANG_SUN", "Dom");
DEFINE("_CAL_LANG_MON", "Lun");
DEFINE("_CAL_LANG_TUE", "Mar");
DEFINE("_CAL_LANG_WED", "Mié;");
DEFINE("_CAL_LANG_THU", "Jue");
DEFINE("_CAL_LANG_FRI", "Vie");
DEFINE("_CAL_LANG_SAT", "Sáb");

// Days
DEFINE("_CAL_LANG_SUNDAY", "Domingo");
DEFINE("_CAL_LANG_MONDAY", "Lunes");
DEFINE("_CAL_LANG_TUESDAY", "Martes");
DEFINE("_CAL_LANG_WEDNESDAY", "Miércoles");
DEFINE("_CAL_LANG_THURSDAY", "Jueves");
DEFINE("_CAL_LANG_FRIDAY", "Viernes");
DEFINE("_CAL_LANG_SATURDAY", "Sábado");

// Days lettres
DEFINE("_CAL_LANG_SUNDAYSHORT", "D");
DEFINE("_CAL_LANG_MONDAYSHORT", "L");
DEFINE("_CAL_LANG_TUESDAYSHORT", "M");
DEFINE("_CAL_LANG_WEDNESDAYSHORT", "X");
DEFINE("_CAL_LANG_THURSDAYSHORT", "J");
DEFINE("_CAL_LANG_FRIDAYSHORT", "V");
DEFINE("_CAL_LANG_SATURDAYSHORT", "S");

// Repeat type
DEFINE("_CAL_LANG_ALLDAYS", "Cada d&iacute;a");
DEFINE("_CAL_LANG_EACHWEEK", "Cada semana");
DEFINE("_CAL_LANG_EACHWEEKPAIR", "Cada semana par");
DEFINE("_CAL_LANG_EACHWEEKIMPAIR", "Cada semana impar");
DEFINE("_CAL_LANG_EACHMONTH", "Cada mes");
DEFINE("_CAL_LANG_EACHYEAR", "Cada a&ntilde;o");
DEFINE("_CAL_LANG_ONLYDAYS", "S&oacute;lo los d&iacute;as elegidos");
DEFINE("_CAL_LANG_EACH", "Cada");
DEFINE("_CAL_LANG_EACHOF","de cada");
DEFINE("_CAL_LANG_ENDMONTH", "fin de mes");

// Repeat days
DEFINE("_CAL_LANG_BYDAYNUMBER", "Por n&uacute;mero del d&iacute;a");

// User type
DEFINE("_CAL_LANG_ANONYME", "An&oacute;nimo");

// Post
//PAS D'ACCENTS DANS LES _ACT_
DEFINE("_CAL_LANG_ACT_ADDED", "La propuesta debe ser verificada antes de ser publicada."); //NO ACCENT !!
DEFINE("_CAL_LANG_ACT_MODIFIED", "Evento modificado."); //NO ACCENT !!
DEFINE("_CAL_LANG_ACT_PUBLISHED", "Este evento ha sido publicado"); //NEW 1.4  
DEFINE("_CAL_LANG_ACT_DELETED", "Evento eliminado."); //NO ACCENT !!
DEFINE("_CAL_LANG_NOPERMISSION", "No tienes acceso al servicio."); //NO ACCENT !!

DEFINE("_CAL_LANG_MAIL_ADDED", "Nueva publicaci&oacute;n el");
DEFINE("_CAL_LANG_MAIL_MODIFIED", "Nueva modificaci&oacute;n el");

// Presentation
DEFINE("_CAL_LANG_BY", "por");
DEFINE("_CAL_LANG_FROM", "Desde");
DEFINE("_CAL_LANG_TO", "Hasta");
DEFINE("_CAL_LANG_ARCHIVE", "Archivos");
DEFINE("_CAL_LANG_WEEK", "la semana");
DEFINE("_CAL_LANG_NO_EVENTS", "Sin eventos");
DEFINE("_CAL_LANG_NO_EVENTFOR", "Sin eventos para");
DEFINE("_CAL_LANG_NO_EVENTFORTHE", "Sin eventos para el");
DEFINE("_CAL_LANG_THIS_DAY", "este d&iacute;a");
DEFINE("_CAL_LANG_THIS_MONTH", "Este mes");
DEFINE("_CAL_LANG_LAST_MONTH", "&Uacute;ltimo mes");
DEFINE("_CAL_LANG_NEXT_MONTH", "Mes siguiente");
DEFINE("_CAL_LANG_EVENTSFOR", "Eventos para");
DEFINE("_CAL_LANG_SEARCHRESULTS", "Buscar resultados por palabra clave"); // new 1.4  
DEFINE("_CAL_LANG_EVENTSFORTHE", "Eventos para el");
DEFINE("_CAL_LANG_REP_DAY", "d&iacute;a");
DEFINE("_CAL_LANG_REP_WEEK", "semana");
DEFINE("_CAL_LANG_REP_WEEKPAIR", "semana par");
DEFINE("_CAL_LANG_REP_WEEKIMPAIR", "semana impar");
DEFINE("_CAL_LANG_REP_MONTH", "mes");
DEFINE("_CAL_LANG_REP_YEAR", "a&ntilde;o");
DEFINE("_CAL_LANG_REP_NOEVENTSELECTED", "Por favor, seleccione primero un evento");

// Navigation
DEFINE("_CAL_LANG_VIEWTODAY", "Ver hoy");
DEFINE("_CAL_LANG_VIEWTOCOME", "Resto del mes");
DEFINE("_CAL_LANG_VIEWBYDAY", "Ver d&iacute;a");
DEFINE("_CAL_LANG_VIEWBYCAT", "Ver categor&iacute;as");
DEFINE("_CAL_LANG_VIEWBYMONTH", "Ver mes");
DEFINE("_CAL_LANG_VIEWBYYEAR", "Ver a&ntilde;o");
DEFINE("_CAL_LANG_VIEWBYWEEK", "Ver semana");
DEFINE("_CAL_LANG_JUMPTO", "Ir al mes específico"); // New 1.4  
DEFINE("_CAL_LANG_BACK", "Volver");
DEFINE("_CAL_LANG_CLOSE", "Cerrar");
DEFINE("_CAL_LANG_PREVIOUSDAY", "D&iacute;a anterior");
DEFINE("_CAL_LANG_PREVIOUSWEEK", "Semana anterior");
DEFINE("_CAL_LANG_PREVIOUSMONTH", "Mes anteior");
DEFINE("_CAL_LANG_PREVIOUSYEAR", "A&ntilde;o anterior");
DEFINE("_CAL_LANG_NEXTDAY", "D&iacute;a siguiente");
DEFINE("_CAL_LANG_NEXTWEEK", "Semana siguiente");
DEFINE("_CAL_LANG_NEXTMONTH", "Mes siguiente");
DEFINE("_CAL_LANG_NEXTYEAR", "A&ntilde;o siguiente");

DEFINE("_CAL_LANG_ADMINPANEL", "Panel administrador");
DEFINE("_CAL_LANG_ADDEVENT", "A&ntilde;adir evento");
DEFINE("_CAL_LANG_MYEVENTS", "Mis eventos");
DEFINE("_CAL_LANG_DELETE", "Borrar");
DEFINE("_CAL_LANG_MODIFY", "Modificar");

// Form
DEFINE("_CAL_LANG_HELP", "Ayuda");

DEFINE("_CAL_LANG_CAL_TITLE", "Eventos");
DEFINE("_CAL_LANG_ADD_TITLE", "A&ntilde;adir");
DEFINE("_CAL_LANG_MODIFY_TITLE", "Modificar");

DEFINE("_CAL_LANG_REPEAT_DISABLED", "Repetir el evento sólo es posible si la Fecha Final es posterior a la Fecha Inicial. Cambie la Fecha Final antes de configurar la repetición del evento."); // New for 1.4
                                              
DEFINE("_CAL_LANG_EVENT_TITLE", "Asunto");
DEFINE("_CAL_LANG_EVENT_COLOR", "Color");
DEFINE("_CAL_LANG_EVENT_CATCOLOR", "Use Category Color");
DEFINE("_CAL_LANG_EVENT_CATEGORY", "Categor&iacute;as");
DEFINE("_CAL_LANG_EVENT_CHOOSE_CATEG", "Elegir una categor&iacute;a");
DEFINE("_CAL_LANG_EVENT_ACTIVITY", "Actividad");
DEFINE("_CAL_LANG_EVENT_URLMAIL_INFO", "para incluir una URL o e-mail, escribir <br><u>http://www.servidor.com</u> o <u>mailto:usuario@correo.com</u>");
DEFINE("_CAL_LANG_EVENT_ADRESSE", "Localizaci&oacute;n");
DEFINE("_CAL_LANG_EVENT_CONTACT", "Contacto");
DEFINE("_CAL_LANG_EVENT_EXTRA", "Info. extra");
DEFINE("_CAL_LANG_EVENT_AUTHOR_ALIAS", "Autor (alias)");
DEFINE("_CAL_LANG_EVENT_STARTDATE", "Fecha inicial");
DEFINE("_CAL_LANG_EVENT_ENDDATE", "Fecha final");
DEFINE("_CAL_LANG_EVENT_STARTHOURS", "Hora inicial");
DEFINE("_CAL_LANG_EVENT_ENDHOURS", "Hora final");
DEFINE("_CAL_LANG_EVENT_STARTTIME", "Hora inicial");
DEFINE("_CAL_LANG_EVENT_ENDTIME", "Hora final");
DEFINE("_CAL_LANG_PUB_INFO", "Informaci&oacute;n de la publicaci&oacute;n");
DEFINE("_CAL_LANG_EVENT_REPEATTYPE", "Tipo de repetici&oacute;n");
DEFINE("_CAL_LANG_EVENT_REPEATDAY", "Repetir d&iacute;as");
DEFINE("_CAL_LANG_EVENT_CHOOSE_WEEKDAYS", "D&iacute;as del mes");
DEFINE("_CAL_LANG_EVENT_PER", "por");
  DEFINE("_CAL_LANG_EVENT_WEEKOPT", "Semana(s) por mes repetición tipo semana"); // ¿? verificar!
# DEFINE("_CAL_LANG_EVENT_WEEKOPT", "Week(s) of a month repeat type week");

DEFINE("_CAL_LANG_SUBMITPREVIEW", "Vista previa");
DEFINE("_CAL_LANG_SUBMITCANCEL", "Cancelar");
DEFINE("_CAL_LANG_SUBMITSAVE", "Guardar");

DEFINE("_CAL_LANG_E_WARNWEEKS", "Elegir una semana.");
DEFINE("_CAL_LANG_E_WARNDAYS", "Elegir un d&iacute;a.");

// Admin
DEFINE("_CAL_LANG_EVENT_ALLCAT", "Todas las categor&iacute;as");
DEFINE("_CAL_LANG_EVENT_ACCESSLEVEL", "Nivel de accesso");
DEFINE("_CAL_LANG_EVENT_HITS", "Accesos");
DEFINE("_CAL_LANG_EVENT_STATE", "Estado");
DEFINE("_CAL_LANG_EVENT_CREATED", "Creado");
DEFINE("_CAL_LANG_EVENT_NEWEVENT", "Nuevo evento");
DEFINE("_CAL_LANG_EVENT_MODIFIED", "&Uacute;ltima modificaci&oacute;n");
DEFINE("_CAL_LANG_EVENT_NOTMODIFIED", "No modificado");

// dmcd aug 22/04  new warning alert for no specified activity in event entry
DEFINE("_CAL_LANG_WARNACTIVITY", "Debe introducirse alguna\\ndescripción de actividad.");
DEFINE("_CAL_LEGEND_ALL_CATEGORIES", "Todas las categorías..."); // new for 1.4   
DEFINE("_CAL_LEGEND_ALL_CATEGORIES_DESC", "Mostrar eventos de todas las categorías"); // new for 1.4

DEFINE("_CAL_LANG_FORM_HELP_COLOR", <<<END
        <tr>
		  <td width="110" align="left" valign="top">
            <b>Color</b>  
          </td>
          <td>
Elija el color del fondo que será visible en la vista del calendario mensual. Si la casilla de la Categoría esta 
señalada, el color se predeterminará al color de la categoría (definido por el administrador del sitio) que se elija
bajo la pestaña de Contenido para el evento, y el botón del 'Selector de Color' será desactivado.
</td>
        </tr>
END
);

DEFINE("_CAL_LANG_FORM_HELP",  <<<END
          <td align="left"><b> Fecha </b></td>
          <td> Elija la Fecha Inicial y la Fecha Final de su evento.</td>
        </tr>
    	<tr>
          <td align="left" valign="top"><b>Hora</b></td>   
          <td> Elija la Hora del Día de su evento.  El formato es <span style='color:blue;font-weight:bold;'>hh:mm {am|pm}</span>.<br/> La hora puede ser especificada en formato de 12 o 24 hr.<br/><br/><b><i><span style='color:red;'>(Nuevo)</span></i> Considere que</b> un caso especial ocurre con los <span style='color:red;font-weight:bold;'>
eventos de un solo día hasta más de media noche </span>. 
Para un evento de un solo día que comience digamos a las 19.00 y acabe a las 3.00, las Fechas de Comienzo y Fin <b>DEBEN</b> 
ser la misma fecha, y deberá ponerse para ambas la fecha correspondiente al día de antes de medianoche.</td>
        </tr>
END
);

DEFINE("_CAL_LANG_FORM_HELP_EXTENDED",  <<<END
        <tr>
    	  <td align="left" valign="top" nowrap><b>Tipo de repetición</b></td>
  	  	<td colspan="2"></td>
  		</tr>
  		<tr>
    	  <td colspan="2" align="left" valign="top">
	    	<table width="100%" border="0" cellspacing="2">
              <tr>
                <td width="60" align="left" valign="top"><u>Por día</u></td>
                <td width="110" align="left" valign="top" class="frm_td_bydays">
                  <font color="#000000">Cada día<br/><i>(por defecto)</i></font>
                </td>
                <td align="left" valign="top" class="frm_td_bydays">
                  <font color="#000000">
Escoja esta opción para un evento de uno o varios días que no se repite, pero con
una ocurrencia en cada día dentro del rango de Fecha de Inicio y Final.
</font>
                </td>
              </tr>
              <tr>
                <td width="60" rowspan="3" align="left" valign="top"><u> Por Semana </u></td>
                <td width="110" align="left" valign="top" class="frm_td_byweeks">
                  <font color="#000000">
                 Una vez por semana
                  </font>
                </td>
                <td align="left" valign="top" class="frm_td_byweeks">
                  <font color="#000000">
              Esta opción permite elegir el día de la semana para la repetición
                  <table border="0" width="100%" height="100%"><tr><td>
<b> Número del día</b> para una repetición en el mismo número de día DD de cada mes: DD/mm/aaaa

</td></tr>
<tr><td><b> Nombre del día </b> para repetir, por ej., cada Lunes </td></tr></table>
                  </font>
                </td>
              </tr>
              <tr>
                <td width="110" align="left" valign="top" class="frm_td_byweeks">
                  <font color="#000000">
                Varios días de la semana por semana
                  </font>
                </td>
                <td align="left" valign="top" class="frm_td_byweeks">
                  <font color="#000000"> Esta opción permite elegir en qué días de la semana será visible su evento.</font>
                </td>
              </tr>
              <tr>
                <td width="110" align="left" valign="top" class="frm_td_byweeks">
                  <font color="#000000"><i>Día del mes # 
<br>Para las opciones de ‘Una vez por semana’ y ‘Varios días por semana’ (ver arriba)</i></font></td>
     <td align="left" valign="top" class="frm_td_byweeks">
                  <font color="#000000">
                  <table border="0" width="100%" height="100%">
                    <tr><td><b>Semana 1:</b> 1ª semana del mes </td></tr> 
                    <tr><td><b>Semana 2:</b> 2ª semana del mes </td></tr>
                    <tr><td><b>Semana 3:</b> 3ª semana del mes </td></tr>
                    <tr><td><b>Semana 4:</b> 4ª semana del mes </td></tr>
                    <tr><td><b>Semana 5:</b> 5ª semana del mes (si es posible)</td></tr>
                   </table>
                 </font>
                </td>
              </tr>
              <tr>
                <td width="60" rowspan="2" align="left" valign="top"><u>Por Mes</u></td>
                <td width="110" align="left" valign="top" class="frm_td_bymonth">
                  <font color="#000000">Una vez al mes</font></td>
                <td align="left" valign="top" class="frm_td_bymonth">
                  <font color="#000000">
                     Esta opción permite elegir el Día a repetir del Mes                     
                     <table border="0" width="100%" height="100%">
<tr><td><b> Número del día DD </b> 
para una repetición en el mismo número de día DD de cada mes: DD/mm/aaaa </td></tr>
<tr><td><b> Nombre del día</b> para repetir, por ej., cada Lunes
                  <font color="#000000">
                  (Nota del Trad.: poco claro en el original)</font></td></tr></table>
</font>
                </td>
              </tr>
              <tr>
                <td width="110" align="left" valign="top" class="frm_td_bymonth">
                  <font color="#000000">
                  Fin de cada mes
                  </font>
                </td>
                <td align="left" valign="top" class="frm_td_bymonth">
                  <font color="#000000">
				   El evento se muestra en el último día de cada mes independientemente del número del día, si este último día
		cae dentro del rango de fecha especificado por el Día Inicial y el Día Final del evento
                  </font>
                </td>
              </tr>
              <tr>
                <td width="60" rowspan="2" align="left" valign="top"><u>Por año</u></td>
                <td width="110" align="left" valign="top" class="frm_td_byyear">
                  <font color="#000000">
                 Una vez por año
                  </font>
                </td>
                <td align="left" valign="top" class="frm_td_byyear">
                  <font color="#000000">
                  Esta opción permite elegir un solo día cada Año
                  <table border="0" width="100%" height="100%"><tr>
                <td><b> Número del día </b> para una repetición en el mismo número de día cada año</td></tr><tr>
                <td><b>Nombre del día</b> para repetir, por ej., cada Lunes (Nota del Trad.: poco claro en el original)</td></tr></table>
                       
                  </font>
                </td>
              </tr>
            </table>
          </td>
        </tr>

        <!-- END REPEAT -->
END
);

// translate combatibility constants and remove include file
include_once(dirname(__FILE__).'/compat15.php');

// compatibility constants
DEFINE("_CAL_LANG_WARNTITLE",	_E_WARNTITLE);
DEFINE("_CAL_LANG_WARNCAT",		_E_WARNCAT);
DEFINE("_CAL_LANG_STATE",		_E_STATE);
DEFINE("_CAL_LANG_HITS",		_E_HITS);
DEFINE("_CAL_LANG_CREATED",		_E_CREATED);
DEFINE("_CAL_LANG_LAST_MOD",	_E_LAST_MOD);
DEFINE("_CAL_LANG_EDIT",		_E_EDIT);
DEFINE("_CAL_LANG_SEARCH_TITLE",_SEARCH_TITLE);
DEFINE("_CAL_LANG_PRINT",		_CMN_PRINT);

?>
