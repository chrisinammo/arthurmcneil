<?php
/**
 * Events Component for Joomla 1.0.x
 *
 * @version     $Id: catalan.php 897 2007-11-17 15:32:11Z tstahl $
 * @package     Events
 * @copyright   Copyright (C) 2006 JEvents Project Group
 * @licence     http://www.gnu.org/copyleft/gpl.html
 * @link        http://joomlacode.org/gf/project/jevents
 * @translated  by Ermengol Bota
 */

defined("_VALID_MOS") or die("Direct Access to this location is not allowed");

//Check
DEFINE("_CAL_LANG_INCLUDED", 1);

// new 1.4.0 [mic]
define("_CAL_LANG_LNG",				"ca"); // de|fr|etc... [ DO NOT CHANGE THIS VALUE! ]
define("_CAL_LANG_REPEAT_GRAMMAR",	"1"); // in repeat summary 1 = follow English word orde, 2= follow German word

// used for colorpicker
define("_CAL_LANG_NO_COLOR",			"Sense Color");
define("_CAL_LANG_COLOR_PICKER",		"Seleccionador de Color");

// common
define("_CAL_LANG_TIME",				"Hora");
define("_CAL_LANG_CLICK_TO_OPEN_EVENT",	"Cliqueu per obrir l'esdeveniment");
define("_CAL_LANG_UNPUBLISHED",		"** Sense publicar **");
define("_CAL_LANG_DESCRIPTION",		"Descripci&oacute;");
define("_CAL_LANG_EMAIL_TO_AUTHOR",	"Enviar un correu electr&ograve;nic a l'autor");
define("_CAL_LANG_MAIL_TO_ADMIN",		"Esdeveniment enviat des de [ %s ] per [ %s ]");
define("_CAL_LANG_KEYWORD_NOT_VALID",	"No &eacute;s un paraula clau");
define("_CAL_LANG_EVENT_CALENDAR",		"Calendari d'esdeveniments"); // new 1.4

// modul
define("_CAL_LANG_ERR_NO_MOD_CAL",		"Events Calendar\n<br />This module needs the Events component");
define("_CAL_LANG_CLICK_TOSWITCH_DAY",	"Anar al calendari - dia actual");
define("_CAL_LANG_CLICK_TOSWITCH_MON",	"Anar al calendari - mes acual");
define("_CAL_LANG_CLICK_TOSWITCH_YEAR",	"Anar al calendari - any actual");
define("_CAL_LANG_CLICK_TOSWITCH_PY",	"Anar al calendari - any anterior");
define("_CAL_LANG_CLICK_TOSWITCH_PM",	"Anar al calendari - mes anterior");
define("_CAL_LANG_CLICK_TOSWITCH_NM",	"Anar al calendari - mes seg&uuml;ent");
define("_CAL_LANG_CLICK_TOSWITCH_NY",	"Anar al calendari - any seg&uuml;ent");

// navTableNext
define("_CAL_LANG_NAV_TN_FIRST_LIST",	"primera llista");
define("_CAL_LANG_NAV_TN_PREV_LIST",	"llista anterior");
define("_CAL_LANG_NAV_TN_NEXT_LIST",	"llista seg&uuml;ent");
define("_CAL_LANG_NAV_TN_LAST_LIST",	"&uacute;ltima llista");

// calendar monthly display
define("_CAL_LANG_FIRST_SINGLE_DAY_EVENT",		"Esdeveniment &uacute;nic");
define("_CAL_LANG_FIRST_DAY_OF_MULTIEVENT",	"Primer dia d'un esdeveniment de m&uacute;ltiples dies");
define("_CAL_LANG_LAST_DAY_OF_MULTIEVENT",		"&Uacute;ltim dia d'un esdeveniment de m&uacute;ltiples dies");
define("_CAL_LANG_MULTIDAY_EVENT",				"Esdeveniment de m&uacute;ltiples dies");
/* ++++++ end mic +++++++++++++ */

// Months
DEFINE("_CAL_LANG_JANUARY", "Gener");
DEFINE("_CAL_LANG_FEBRUARY", "Febrer");
DEFINE("_CAL_LANG_MARCH", "Mar&ccedil;");
DEFINE("_CAL_LANG_APRIL", "Abril");
DEFINE("_CAL_LANG_MAY", "Maig");
DEFINE("_CAL_LANG_JUNE", "Juny");
DEFINE("_CAL_LANG_JULY", "Juliol");
DEFINE("_CAL_LANG_AUGUST", "Agost");
DEFINE("_CAL_LANG_SEPTEMBER", "Setembre");
DEFINE("_CAL_LANG_OCTOBER", "Octubre");
DEFINE("_CAL_LANG_NOVEMBER", "Novembre");
DEFINE("_CAL_LANG_DECEMBER", "Desembre");

// Short day names
DEFINE("_CAL_LANG_SUN", "Dg");
DEFINE("_CAL_LANG_MON", "Dl");
DEFINE("_CAL_LANG_TUE", "Dm");
DEFINE("_CAL_LANG_WED", "Dc");
DEFINE("_CAL_LANG_THU", "Dj");
DEFINE("_CAL_LANG_FRI", "Dv");
DEFINE("_CAL_LANG_SAT", "Ds");

// Days
DEFINE("_CAL_LANG_SUNDAY", "Diumenge");
DEFINE("_CAL_LANG_MONDAY", "Dilluns");
DEFINE("_CAL_LANG_TUESDAY", "Dimarts");
DEFINE("_CAL_LANG_WEDNESDAY", "Dimecres");
DEFINE("_CAL_LANG_THURSDAY", "Dijous");
DEFINE("_CAL_LANG_FRIDAY", "Divendres");
DEFINE("_CAL_LANG_SATURDAY", "Dissabte");

// Days lettres
DEFINE("_CAL_LANG_SUNDAYSHORT", "Dg");
DEFINE("_CAL_LANG_MONDAYSHORT", "Dl");
DEFINE("_CAL_LANG_TUESDAYSHORT", "Dm");
DEFINE("_CAL_LANG_WEDNESDAYSHORT", "Dc");
DEFINE("_CAL_LANG_THURSDAYSHORT", "Dj");
DEFINE("_CAL_LANG_FRIDAYSHORT", "Dv");
DEFINE("_CAL_LANG_SATURDAYSHORT", "Ds");

// Repeat type
DEFINE("_CAL_LANG_ALLDAYS", "Cada dia");
DEFINE("_CAL_LANG_EACHWEEK", "Cada setmana");
DEFINE("_CAL_LANG_EACHWEEKPAIR", "Cada setmana parell");
DEFINE("_CAL_LANG_EACHWEEKIMPAIR", "Cada setmana senar");
DEFINE("_CAL_LANG_EACHMONTH", "Cada mes");
DEFINE("_CAL_LANG_EACHYEAR", "Cada any");
DEFINE("_CAL_LANG_ONLYDAYS", "Nom&eacute;s els dies escollits");
DEFINE("_CAL_LANG_EACH", "Cada");
DEFINE("_CAL_LANG_EACHOF","de cada");
DEFINE("_CAL_LANG_ENDMONTH", "final de mes");

// Repeat days
DEFINE("_CAL_LANG_BYDAYNUMBER", "Per n&uacute;mero de dia");

// User type
DEFINE("_CAL_LANG_ANONYME", "An&ograve;nim");

// Post
//PAS D'ACCENTS DANS LES _ACT_
DEFINE("_CAL_LANG_ACT_ADDED", "La proposta ha de ser verificada abans de ser publicada."); //NO ACCENT !!
DEFINE("_CAL_LANG_ACT_MODIFIED", "Esdeveniment modificat."); //NO ACCENT !!
DEFINE("_CAL_LANG_ACT_PUBLISHED", "Aquest esdeveniment ha estat publicat.");  //NEW 1.4
DEFINE("_CAL_LANG_ACT_DELETED", "Esdeveniment eliminat."); //NO ACCENT !!
DEFINE("_CAL_LANG_NOPERMISSION", "No teniu acc&eacute;s al servei."); //NO ACCENT !!

DEFINE("_CAL_LANG_MAIL_ADDED", "Nova publicaci&oacute;");
DEFINE("_CAL_LANG_MAIL_MODIFIED", "Nova modificaci&oacute; el");

// Presentation
DEFINE("_CAL_LANG_BY", "per");
DEFINE("_CAL_LANG_FROM", "Des de");
DEFINE("_CAL_LANG_TO", "Fins");
DEFINE("_CAL_LANG_ARCHIVE", "Arxius");
DEFINE("_CAL_LANG_WEEK", "la setmana");
DEFINE("_CAL_LANG_NO_EVENTS", "Sense esdeveniments");
DEFINE("_CAL_LANG_NO_EVENTFOR", "Sense esdeveniments per a");
DEFINE("_CAL_LANG_NO_EVENTFORTHE", "Sense esdeveniments per al");
DEFINE("_CAL_LANG_THIS_DAY", "aquest dia");
DEFINE("_CAL_LANG_THIS_MONTH", "Aquest mes");
DEFINE("_CAL_LANG_LAST_MONTH", "Darrer mes");
DEFINE("_CAL_LANG_NEXT_MONTH", "Mes seg&ccedil;ent");
DEFINE("_CAL_LANG_EVENTSFOR", "Esdeveniments per a");
DEFINE("_CAL_LANG_SEARCHRESULTS", "Cerca resultat per paraula clau"); // new 1.4
DEFINE("_CAL_LANG_EVENTSFORTHE", "Esdeveniments per al");
DEFINE("_CAL_LANG_REP_DAY", "dia");
DEFINE("_CAL_LANG_REP_WEEK", "setmana");
DEFINE("_CAL_LANG_REP_WEEKPAIR", "setmana parell");
DEFINE("_CAL_LANG_REP_WEEKIMPAIR", "setmana senar");
DEFINE("_CAL_LANG_REP_MONTH", "mes");
DEFINE("_CAL_LANG_REP_YEAR", "any");
DEFINE("_CAL_LANG_REP_NOEVENTSELECTED", "Si us plau, seleccioneu un esdeveniment");

// Navigation
DEFINE("_CAL_LANG_VIEWTODAY", "Mostra avui");
DEFINE("_CAL_LANG_VIEWTOCOME", "Resta del mes");
DEFINE("_CAL_LANG_VIEWBYDAY", "Mostra dia");
DEFINE("_CAL_LANG_VIEWBYCAT", "Mostra categories");
DEFINE("_CAL_LANG_VIEWBYMONTH", "Mostra mes");
DEFINE("_CAL_LANG_VIEWBYYEAR", "Mostra any");
DEFINE("_CAL_LANG_VIEWBYWEEK", "Mostra setmana");
DEFINE("_CAL_LANG_JUMPTO", "Ves a un mes en concret");  // New 1.4
DEFINE("_CAL_LANG_BACK", "Torna");
DEFINE("_CAL_LANG_CLOSE", "Close");
DEFINE("_CAL_LANG_PREVIOUSDAY", "Dia anterior");
DEFINE("_CAL_LANG_PREVIOUSWEEK", "Setmana anterior");
DEFINE("_CAL_LANG_PREVIOUSMONTH", "Mes anterior");
DEFINE("_CAL_LANG_PREVIOUSYEAR", "Any anterior");
DEFINE("_CAL_LANG_NEXTDAY", "Dia seg&ccedil;ent");
DEFINE("_CAL_LANG_NEXTWEEK", "Setmana seg&ccedil;ent");
DEFINE("_CAL_LANG_NEXTMONTH", "Mes seg&ccedil;ent");
DEFINE("_CAL_LANG_NEXTYEAR", "Any seg&ccedil;ent");

DEFINE("_CAL_LANG_ADMINPANEL", "Eina d'administraci&oacute;");
DEFINE("_CAL_LANG_ADDEVENT", "Afegeix esdeveniment");
DEFINE("_CAL_LANG_MYEVENTS", "Els meus esdeveniments");
DEFINE("_CAL_LANG_DELETE", "Elimina");
DEFINE("_CAL_LANG_MODIFY", "Modifica");

// Form
DEFINE("_CAL_LANG_HELP", "Ajuda");

DEFINE("_CAL_LANG_CAL_TITLE", "Esdeveniments");
DEFINE("_CAL_LANG_ADD_TITLE", "Afegeix");
DEFINE("_CAL_LANG_MODIFY_TITLE", "Modifica");

DEFINE("_CAL_LANG_REPEAT_DISABLED", "La repetici&oacute; d'esdeveniments nom&eacute;s &eacute;s aplicable si la Data final &eacute;s posterior a la Data inicial. Canvieu la Data final abans de configurar els detalls de la repetici&oacute;."); // New for 1.4
DEFINE("_CAL_LANG_EVENT_TITLE", "Assumpte");
DEFINE("_CAL_LANG_EVENT_COLOR", "Color");
DEFINE("_CAL_LANG_EVENT_CATCOLOR", "Utilitza el color de la categoria");
DEFINE("_CAL_LANG_EVENT_CATEGORY", "Categories");
DEFINE("_CAL_LANG_EVENT_CHOOSE_CATEG", "Seleccioneu una categoria");
DEFINE("_CAL_LANG_EVENT_ACTIVITY", "Activitat");
DEFINE("_CAL_LANG_EVENT_URLMAIL_INFO", "per incloure una URL o a/e, escriviu <br><u>http://www.servidor.com</u> o <u>mailto:usuari@correu.com</u>");
DEFINE("_CAL_LANG_EVENT_ADRESSE", "Localitzaci&oacute;");
DEFINE("_CAL_LANG_EVENT_CONTACT", "Contacte");
DEFINE("_CAL_LANG_EVENT_EXTRA", "Info. extra");
DEFINE("_CAL_LANG_EVENT_AUTHOR_ALIAS", "Autor (&agrave;lies)");
DEFINE("_CAL_LANG_EVENT_STARTDATE", "Data inicial");
DEFINE("_CAL_LANG_EVENT_ENDDATE", "Data final");
DEFINE("_CAL_LANG_EVENT_STARTHOURS", "Hora inicial");
DEFINE("_CAL_LANG_EVENT_ENDHOURS", "Hora final");
DEFINE("_CAL_LANG_EVENT_STARTTIME", "Hora inicial");
DEFINE("_CAL_LANG_EVENT_ENDTIME", "Hora final");
DEFINE("_CAL_LANG_PUB_INFO", "Informaci&oacute; de la publicaci&oacute;");
DEFINE("_CAL_LANG_EVENT_REPEATTYPE", "Tipus de repetici&oacute;");
DEFINE("_CAL_LANG_EVENT_REPEATDAY", "Repeteix dies");
DEFINE("_CAL_LANG_EVENT_CHOOSE_WEEKDAYS", "Dies del mes");
DEFINE("_CAL_LANG_EVENT_PER", "per");
DEFINE("_CAL_LANG_EVENT_WEEKOPT", "Setmana(es) d'un mes - tipus de repetici&oacute; setmana");

DEFINE("_CAL_LANG_SUBMITPREVIEW", "Vista pr&egrave;via");
DEFINE("_CAL_LANG_SUBMITCANCEL", "Cancel&middot;la");
DEFINE("_CAL_LANG_SUBMITSAVE", "Desa");

DEFINE("_CAL_LANG_E_WARNWEEKS", "Selecciona una setmana.");
DEFINE("_CAL_LANG_E_WARNDAYS", "Selecciona un dia.");

// Admin
DEFINE("_CAL_LANG_EVENT_ALLCAT", "Totes les categories");
DEFINE("_CAL_LANG_EVENT_ACCESSLEVEL", "Nivell d'acc&eacute;s");
DEFINE("_CAL_LANG_EVENT_HITS", "Accessos");
DEFINE("_CAL_LANG_EVENT_STATE", "Estat");
DEFINE("_CAL_LANG_EVENT_CREATED", "Creat");
DEFINE("_CAL_LANG_EVENT_NEWEVENT", "Nou esdeveniment");
DEFINE("_CAL_LANG_EVENT_MODIFIED", "Darrera modificaci&oacute;");
DEFINE("_CAL_LANG_EVENT_NOTMODIFIED", "No modificat");

// dmcd aug 22/04  new warning alert for no specified activity in event entry
DEFINE("_CAL_LANG_WARNACTIVITY", "Algun tipus d'activitat\\&Eacute;s necessari introduir la descripci&oacute;.");

DEFINE("_CAL_LEGEND_ALL_CATEGORIES", "Totes les Categories ...");  // new for 1.4
DEFINE("_CAL_LEGEND_ALL_CATEGORIES_DESC", "Mostra els esdeveniments per a totes les categories");  // new for 1.4

DEFINE("_CAL_LANG_FORM_HELP_COLOR", <<<END
        <tr>
		  <td width="110" align="left" valign="top">
            <b>Color</b>
          </td>
          <td>Tria el color del fons que ser&agrave; visible en la vista mensual. Si la casella "Utilitza el color de la categoria" est&agrave; marcada,
		  s'utilitzar&agrave; el color predeterminat per a la categoria (definit per l'administrador) que estigui seleccionada en el tab de contingut del formulari de l'esdeveniment, i el 
		  but&oacute; del 'Selector de color' estar&agrave; desactivat.</td>
        </tr>
END
);

DEFINE("_CAL_LANG_FORM_HELP",  <<<END
    	<tr>
          <td align="left"><b>Data</b></td>
          <td>Tria la Data Inicial i la Data Final de l'esdeveniment.</td>
        </tr>
    	<tr>
          <td align="left" valign="top"><b>Hora</b></td>
          <td>Tria l'hora del dia del teu esdeveniment. El format &eacute;s <span style='color:blue;font-weight:bold;'>hh:mm {am|pm}</span>.<br/>L'hora es pot especificar en qualsevol dels dos formats 12 o 24 hr.<br/><br/><b><i><span style='color:red;'>(Novetat)</span></i> Atenci&oacute;</b> that a special case occurs for <span style='color:red;font-weight:bold;'>single day over-night events</span>.  IE. For a single day event beginning at say 19:00 and finishing at 3:00, the Start and End Dates <b>MUST</b> be&nbsp;
		   the same date, and should be set to the date corresponding to the day before midnight.</td>
        </tr>
END
);

DEFINE("_CAL_LANG_FORM_HELP_EXTENDED",  <<<END
        <tr>
    	  <td align="left" valign="top" nowrap><b>Tipus de repetic&oacute;</b></td>
  	  	<td colspan="2"></td>
  		</tr>
  		<tr>
    	  <td colspan="2" align="left" valign="top">
	    	<table width="100%" border="0" cellspacing="2">
              <tr>
                <td width="60" align="left" valign="top"><u>Per Dia</u></td>
                <td width="110" align="left" valign="top" class="frm_td_bydays">
                  <font color="#000000">Cada Dia<br/><i>(predeterminat)</i></font>
                </td>
                <td align="left" valign="top" class="frm_td_bydays">
                  <font color="#000000">Choose this option for a non-reoccurring single or multi-day event, with a new event occurrence for every day within the Start and End Date range</font>
                </td>
              </tr>
              <tr>
                <td width="60" rowspan="3" align="left" valign="top"><u>Per setmanak</u></td>
                <td width="110" align="left" valign="top" class="frm_td_byweeks">
                  <font color="#000000">
                    Un cop per Setmana
                  </font>
                </td>
                <td align="left" valign="top" class="frm_td_byweeks">
                  <font color="#000000">
                  This option allow to choose the weekday of repeat
                  <table border="0" width="100%" height="100%"><tr><td><b>Day number</b> for repeat type each 10/../2003</td></tr><tr><td><b>Day name</b> for repeat type each Monday</td></tr></table>
                  </font>
                </td>
              </tr>
              <tr>
                <td width="110" align="left" valign="top" class="frm_td_byweeks">
                  <font color="#000000">
                    Multiple Week Days Per Week
                  </font>
                </td>
                <td align="left" valign="top" class="frm_td_byweeks">
                  <font color="#000000">This option allow to choose on which week days your event will be visible.</font>
                </td>
              </tr>
              <tr>
                <td width="110" align="left" valign="top" class="frm_td_byweeks">
                  <font color="#000000"><i>Week of Month # <br>For 'Once per Week' and 'Multiple Days Per Week' options above</i></font></td>
                  <td align="left" valign="top" class="frm_td_byweeks">
                  <font color="#000000">
                  <table border="0" width="100%" height="100%">
                    <tr><td><b>Week 1 :</b> 1st week of the month</td></tr>
                    <tr><td><b>Week 2 :</b> 2nd week of the month</td></tr>
                    <tr><td><b>Week 3 :</b> 3rd week of the month</td></tr>
                    <tr><td><b>Week 4 :</b> 4th week of the month</td></tr>
                    <tr><td><b>Week 5 :</b> 5th week of the month (if applicable)</td></tr>
                   </table>
                 </font>
                </td>
              </tr>
              <tr>
                <td width="60" rowspan="2" align="left" valign="top"><u>By Month</u></td>
                <td width="110" align="left" valign="top" class="frm_td_bymonth">
                  <font color="#000000">Once Per Month</font></td>
                <td align="left" valign="top" class="frm_td_bymonth">
                  <font color="#000000">
                     This option allow to choose the repeating Day of the Month
                     <table border="0" width="100%" height="100%"><tr><td><b>Day number</b> for repeat type each 10/../2003</td></tr><tr><td><b>Day name</b> for repeat type each Monday</td></tr></table>

                  </font>
                </td>
              </tr>
              <tr>
                <td width="110" align="left" valign="top" class="frm_td_bymonth">
                  <font color="#000000">
                  End of Each Month
                  </font>
                </td>
                <td align="left" valign="top" class="frm_td_bymonth">
                  <font color="#000000">
				   The event is on the last day of each month independently of the day number, if that last day
		falls within the date range specified by the Start and End Dates for the event.
                  </font>
                </td>
              </tr>
              <tr>
                <td width="60" rowspan="2" align="left" valign="top"><u>By Year</u></td>
                <td width="110" align="left" valign="top" class="frm_td_byyear">
                  <font color="#000000">
                  Once Per Year
                  </font>
                </td>
                <td align="left" valign="top" class="frm_td_byyear">
                  <font color="#000000">
                  This option allow to choose a single day every Year
                  <table border="0" width="100%" height="100%"><tr><td><b>Day number</b> for repeat type each 10/../2003</td></tr><tr><td><b>Day name</b> for repeat type each Monday</td></tr></table>
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
