<?php
/**
 * Events Component for Joomla 1.0.x
 *
 * @version     $Id: slovak-utf8.php 1061 2008-04-22 18:42:23Z tstahl $
 * @package     Events
 * @copyright   Copyright (C) 2006 JEvents Project Group
 * @licence     http://www.gnu.org/copyleft/gpl.html
 * @link        http://joomlacode.org/gf/project/jevents
 */

defined("_VALID_MOS") or die("Direct Access to this location is not allowed");

//Check
DEFINE("_CAL_LANG_INCLUDED", 1);

// new 1.4.0 [mic]
define("_CAL_LANG_LNG",				"sk"); // de|fr|etc... [ DO NOT CHANGE THIS VALUE! ]

// used for colorpicker
define("_CAL_LANG_NO_COLOR",			"Žiadna farba");
define("_CAL_LANG_COLOR_PICKER",		"Výber farby");

// common
define("_CAL_LANG_TIME",				"Čas");
define("_CAL_LANG_CLICK_TO_OPEN_EVENT",	"Klikni na otvorenie udalosti");
define("_CAL_LANG_UNPUBLISHED",		"Nepublikovaný");
define("_CAL_LANG_DESCRIPTION",		"Popis");
define("_CAL_LANG_EMAIL_TO_AUTHOR",	"Email Autorovi");
define("_CAL_LANG_MAIL_TO_ADMIN",		"Udalosť [ %s ] by [ %s ]");
define("_CAL_LANG_KEYWORD_NOT_VALID",	"Nesprávne kľúčové slovo");
define("_CAL_LANG_EVENT_CALENDAR",		"Kalendár udalostí"); // new 1.4

// modul
define("_CAL_LANG_ERR_NO_MOD_CAL",		"Kalendár udalostí<br />This module needs the Events component");
define("_CAL_LANG_CLICK_TOSWITCH_DAY",	"Kalendár - aktuálny deň");
define("_CAL_LANG_CLICK_TOSWITCH_MON",	"Kalendár - aktuálny mesiac");
define("_CAL_LANG_CLICK_TOSWITCH_YEAR",	"Kalendár - aktuálny rok");
define("_CAL_LANG_CLICK_TOSWITCH_PY",	"Kalendár - predchádzajúci rok");
define("_CAL_LANG_CLICK_TOSWITCH_PM",	"Kalendár - predchádzajúci mesiac");
define("_CAL_LANG_CLICK_TOSWITCH_NM",	"Kalendár - nasledujúci mesiac");
define("_CAL_LANG_CLICK_TOSWITCH_NY",	"Kalendár - nasledujúci rok");

// navTableNext
define("_CAL_LANG_NAV_TN_FIRST_LIST",	"Prvý zoznam");
define("_CAL_LANG_NAV_TN_PREV_LIST",	"Predchádzajúci zoznam");
define("_CAL_LANG_NAV_TN_NEXT_LIST",	"Ďalši zoznam");
define("_CAL_LANG_NAV_TN_LAST_LIST",	"Poslendý zoznam");

// calendar monthly display
define("_CAL_LANG_FIRST_SINGLE_DAY_EVENT",		"Jendorázová udalosť");
define("_CAL_LANG_FIRST_DAY_OF_MULTIEVENT",	"Prvý deň viacdňovej udalosti");
define("_CAL_LANG_LAST_DAY_OF_MULTIEVENT",		"Posledný deň viacdňovej udalosti");
define("_CAL_LANG_MULTIDAY_EVENT",				"Viacdňová udalosť");
/* ++++++ end mic +++++++++++++ */

// Months
DEFINE("_CAL_LANG_JANUARY", "Január");
DEFINE("_CAL_LANG_FEBRUARY", "Február");
DEFINE("_CAL_LANG_MARCH", "Marec");
DEFINE("_CAL_LANG_APRIL", "Apríl");
DEFINE("_CAL_LANG_MAY", "Máj");
DEFINE("_CAL_LANG_JUNE", "Jún");
DEFINE("_CAL_LANG_JULY", "Júl");
DEFINE("_CAL_LANG_AUGUST", "August");
DEFINE("_CAL_LANG_SEPTEMBER", "September");
DEFINE("_CAL_LANG_OCTOBER", "Október");
DEFINE("_CAL_LANG_NOVEMBER", "November");
DEFINE("_CAL_LANG_DECEMBER", "December");

// Short day names
DEFINE("_CAL_LANG_SUN", "Ne");
DEFINE("_CAL_LANG_MON", "Po");
DEFINE("_CAL_LANG_TUE", "Ut");
DEFINE("_CAL_LANG_WED", "St");
DEFINE("_CAL_LANG_THU", "Št");
DEFINE("_CAL_LANG_FRI", "Pi");
DEFINE("_CAL_LANG_SAT", "So");

// Days
DEFINE("_CAL_LANG_SUNDAY", "Nedeľa");
DEFINE("_CAL_LANG_MONDAY", "Pondelok");
DEFINE("_CAL_LANG_TUESDAY", "Utorok");
DEFINE("_CAL_LANG_WEDNESDAY", "Streda");
DEFINE("_CAL_LANG_THURSDAY", "Štvrtok");
DEFINE("_CAL_LANG_FRIDAY", "Piatok");
DEFINE("_CAL_LANG_SATURDAY", "Sobota");

// Days lettres
DEFINE("_CAL_LANG_SUNDAYSHORT", "N");
DEFINE("_CAL_LANG_MONDAYSHORT", "P");
DEFINE("_CAL_LANG_TUESDAYSHORT", "U");
DEFINE("_CAL_LANG_WEDNESDAYSHORT", "S");
DEFINE("_CAL_LANG_THURSDAYSHORT", "Š");
DEFINE("_CAL_LANG_FRIDAYSHORT", "P");
DEFINE("_CAL_LANG_SATURDAYSHORT", "S");

// Repeat type
DEFINE("_CAL_LANG_ALLDAYS", "Každý deň");
DEFINE("_CAL_LANG_EACHWEEK", "Každý týždeň");
DEFINE("_CAL_LANG_EACHWEEKPAIR", "Každý párny týždeň");
DEFINE("_CAL_LANG_EACHWEEKIMPAIR", "Každý nepárny týždeň");
DEFINE("_CAL_LANG_EACHMONTH", "Každý mesiac");
DEFINE("_CAL_LANG_EACHYEAR", "Každý rok");
DEFINE("_CAL_LANG_ONLYDAYS", "Iba vybrané dni");
DEFINE("_CAL_LANG_EACH", "Každý");
DEFINE("_CAL_LANG_EACHOF","Každý z");
DEFINE("_CAL_LANG_ENDMONTH", "Koniec mesiaca");

// Repeat days
DEFINE("_CAL_LANG_BYDAYNUMBER", "Podľa dňa");

// User type
DEFINE("_CAL_LANG_ANONYME", "Anonymný");

// Post
//PAS D'ACCENTS DANS LES _ACT_
DEFINE("_CAL_LANG_ACT_ADDED", "Dakujem za prispevok. Pred publikovanim este prejde kontrolou!"); //NO ACCENT !!
DEFINE("_CAL_LANG_ACT_MODIFIED", "Tato udalost bola zmenena."); //NO ACCENT !!
DEFINE("_CAL_LANG_ACT_PUBLISHED", "Tato udalost bola publikovana.");  //NEW 1.4
DEFINE("_CAL_LANG_ACT_DELETED", "Tato udalost bola zmazana!"); //NO ACCENT !!
DEFINE("_CAL_LANG_NOPERMISSION", "Nemate pristup k tejto sluzbe!"); //NO ACCENT !!

DEFINE("_CAL_LANG_MAIL_ADDED", "Nový príspevok k");
DEFINE("_CAL_LANG_MAIL_MODIFIED", "Nová zmena k");

// Presentation
DEFINE("_CAL_LANG_BY", "Autor");
DEFINE("_CAL_LANG_FROM", "Od");
DEFINE("_CAL_LANG_TO", "Do");
DEFINE("_CAL_LANG_ARCHIVE", "Archív");
DEFINE("_CAL_LANG_WEEK", "Týždeň");
DEFINE("_CAL_LANG_NO_EVENTS", "Žiadna udalosť");
DEFINE("_CAL_LANG_NO_EVENTFOR", "Žiadna udalosť");
DEFINE("_CAL_LANG_NO_EVENTFORTHE", "Žiadna udalosť pre");
DEFINE("_CAL_LANG_THIS_DAY", "Tento deň");
DEFINE("_CAL_LANG_THIS_MONTH", "Tento mesiac");
DEFINE("_CAL_LANG_LAST_MONTH", "Predchádzajúci mesiac");
DEFINE("_CAL_LANG_NEXT_MONTH", "Nasledovný mesiac");
DEFINE("_CAL_LANG_EVENTSFOR", "Udalosť pre");
DEFINE("_CAL_LANG_SEARCHRESULTS", "Výsledok hľadania"); // new 1.4
DEFINE("_CAL_LANG_EVENTSFORTHE", "Udalosť pre");
DEFINE("_CAL_LANG_REP_DAY", "Deň");
DEFINE("_CAL_LANG_REP_WEEK", "Týždeň");
DEFINE("_CAL_LANG_REP_WEEKPAIR", "Párny týždeň");
DEFINE("_CAL_LANG_REP_WEEKIMPAIR", "Nepárny týždeň");
DEFINE("_CAL_LANG_REP_MONTH", "Mesiac");
DEFINE("_CAL_LANG_REP_YEAR", "Rok");
DEFINE("_CAL_LANG_REP_NOEVENTSELECTED", "Proosím najskôr zvoľte udalosť!");

// Navigation
DEFINE("_CAL_LANG_VIEWTODAY", "Dnes");
DEFINE("_CAL_LANG_VIEWTOCOME", "Tento mesiac");
DEFINE("_CAL_LANG_VIEWBYDAY", "Zobraziť po dňoch");
DEFINE("_CAL_LANG_VIEWBYCAT", "Zobraziť podľa kategórie");
DEFINE("_CAL_LANG_VIEWBYMONTH", "Tento mesiac");
DEFINE("_CAL_LANG_VIEWBYYEAR", "Tento rok");
DEFINE("_CAL_LANG_VIEWBYWEEK", "Tento týždeň");
DEFINE("_CAL_LANG_JUMPTO", "Skok na určitý mesiac");  // New 1.4
DEFINE("_CAL_LANG_BACK", "Späť");
DEFINE("_CAL_LANG_CLOSE", "Zatvor");
DEFINE("_CAL_LANG_PREVIOUSDAY", "Predchádzajúci deň");
DEFINE("_CAL_LANG_PREVIOUSWEEK", "Predchádzajúci týždeň");
DEFINE("_CAL_LANG_PREVIOUSMONTH", "Predchádzajúci mesiac");
DEFINE("_CAL_LANG_PREVIOUSYEAR", "Predchádzajúci rok");
DEFINE("_CAL_LANG_NEXTDAY", "Nasledovný deň");
DEFINE("_CAL_LANG_NEXTWEEK", "Nasledovný týždeň");
DEFINE("_CAL_LANG_NEXTMONTH", "Nasledovný mesiac");
DEFINE("_CAL_LANG_NEXTYEAR", "Nasledovný rok");

DEFINE("_CAL_LANG_ADMINPANEL", "Administrácia");
DEFINE("_CAL_LANG_ADDEVENT", "Pridať udalosť");
DEFINE("_CAL_LANG_MYEVENTS", "Moje udalosti");
DEFINE("_CAL_LANG_DELETE", "Zmazať");
DEFINE("_CAL_LANG_MODIFY", "Editovať");

// Form
DEFINE("_CAL_LANG_HELP", "Nápoveda");

DEFINE("_CAL_LANG_CAL_TITLE", "Udalosť");
DEFINE("_CAL_LANG_ADD_TITLE", "Pridať");
DEFINE("_CAL_LANG_MODIFY_TITLE", "Editovať");

DEFINE("_CAL_LANG_REPEAT_DISABLED", "Opakovanie udalosti je možné len ak je dátum definovaný OD menší ako DO.  Opravte dátum."); // New for 1.4
DEFINE("_CAL_LANG_EVENT_TITLE", "Predmet");
DEFINE("_CAL_LANG_EVENT_COLOR", "Farba");
DEFINE("_CAL_LANG_EVENT_CATCOLOR", "Použiť farbu kategórie");
DEFINE("_CAL_LANG_EVENT_CATEGORY", "Kategória");
DEFINE("_CAL_LANG_EVENT_CHOOSE_CATEG", "Vyberte kategóriu");
DEFINE("_CAL_LANG_EVENT_ACTIVITY", "Činnost");
DEFINE("_CAL_LANG_EVENT_URLMAIL_INFO", "Ak chcete pridať URL alebo mail. Naapíšte jednoducho <u>http://www.google.sk</u> alebo <u>mailto:meno@email.sk</u>");
DEFINE("_CAL_LANG_EVENT_ADRESSE", "Mesto");
DEFINE("_CAL_LANG_EVENT_CONTACT", "Kontakt");
DEFINE("_CAL_LANG_EVENT_EXTRA", "Extra info");
DEFINE("_CAL_LANG_EVENT_AUTHOR_ALIAS", "Autor (alias)");
DEFINE("_CAL_LANG_EVENT_STARTDATE", "Začiatok (dátum)");
DEFINE("_CAL_LANG_EVENT_ENDDATE", "Koniec (dátum)");
DEFINE("_CAL_LANG_EVENT_STARTHOURS", "Začiatok (hodina)");
DEFINE("_CAL_LANG_EVENT_ENDHOURS", "Koniec (hodina)");
DEFINE("_CAL_LANG_EVENT_STARTTIME", "Začiatok (čas)");
DEFINE("_CAL_LANG_EVENT_ENDTIME", "Koniec (čas)");
DEFINE("_CAL_LANG_PUB_INFO", "Publikovať");
DEFINE("_CAL_LANG_EVENT_REPEATTYPE", "Opakovať typ");
DEFINE("_CAL_LANG_EVENT_REPEATDAY", "Opakovať deň");
DEFINE("_CAL_LANG_EVENT_CHOOSE_WEEKDAYS", "Dni v týždni");
DEFINE("_CAL_LANG_EVENT_PER", "per");
DEFINE("_CAL_LANG_EVENT_WEEKOPT", "Týždeň mesiaca pre opakovanie");

DEFINE("_CAL_LANG_SUBMITPREVIEW", "Náhľad");
DEFINE("_CAL_LANG_SUBMITCANCEL", "Zrušiť");
DEFINE("_CAL_LANG_SUBMITSAVE", "Uložiť");

DEFINE("_CAL_LANG_E_WARNWEEKS", "Vyberte týždeň");
DEFINE("_CAL_LANG_E_WARNDAYS", "Vyberte deň");

// Admin
DEFINE("_CAL_LANG_EVENT_ALLCAT", "Všetky kategórie");
DEFINE("_CAL_LANG_EVENT_ACCESSLEVEL", "Úroveň prístupu");
DEFINE("_CAL_LANG_EVENT_HITS", "Zobrazené");
DEFINE("_CAL_LANG_EVENT_STATE", "Status");
DEFINE("_CAL_LANG_EVENT_CREATED", "Vytvorené");
DEFINE("_CAL_LANG_EVENT_NEWEVENT", "Nová udalosť");
DEFINE("_CAL_LANG_EVENT_MODIFIED", "Posledná zmena");
DEFINE("_CAL_LANG_EVENT_NOTMODIFIED", "Bez zmeny");

// dmcd aug 22/04  new warning alert for no specified activity in event entry
DEFINE("_CAL_LANG_WARNACTIVITY", "Some sort of Activity\\ndescription must be entered.");

DEFINE("_CAL_LEGEND_ALL_CATEGORIES", "Všetky kategórie...");  // new for 1.4
DEFINE("_CAL_LEGEND_ALL_CATEGORIES_DESC", "Všetko udalosti vo všetkýcj kategóriach");  // new for 1.4

DEFINE("_CAL_LANG_FORM_HELP_COLOR", <<<END
        <tr>
		  <td width="110" align="left" valign="top">
            <b>Color</b>
          </td>
          <td>Choose the color of the background which will be visible in month calendar view.  If the Category checkbox is checked,
		  the color will default to the color of the category (defined by the site admin) that is chosen under the Content tab form for the event, and the
		  'Color Picker' button will be disabled.</td>
        </tr>
END
);

DEFINE("_CAL_LANG_FORM_HELP",  <<<END
    	<tr>
          <td align="left"><b>Date</b></td>
          <td>Choose the Begin Date and the End Date of your event.</td>
        </tr>
    	<tr>
          <td align="left" valign="top"><b>Time</b></td>
          <td>Choose the Time of Day of your event.  Format is <span style='color:blue;font-weight:bold;'>hh:mm {am|pm}</span>.<br/>Time can be specified in either 12 or 24 hr format.<br/><br/><b><i><span style='color:red;'>(New)</span></i> Note</b> that a special case occurs for <span style='color:red;font-weight:bold;'>single day over-night events</span>.  IE. For a single day event beginning at say 19:00 and finishing at 3:00, the Start and End Dates <b>MUST</b> be&nbsp;
		   the same date, and should be set to the date corresponding to the day before midnight.</td>
        </tr>
END
);

DEFINE("_CAL_LANG_FORM_HELP_EXTENDED",  <<<END
        <tr>
    	  <td align="left" valign="top" nowrap><b>Repeat Type</b></td>
  	  	<td colspan="2"></td>
  		</tr>
  		<tr>
    	  <td colspan="2" align="left" valign="top">
	    	<table width="100%" border="0" cellspacing="2">
              <tr>
                <td width="60" align="left" valign="top"><u>By Day</u></td>
                <td width="110" align="left" valign="top" class="frm_td_bydays">
                  <font color="#000000">Every Day<br/><i>(default)</i></font>
                </td>
                <td align="left" valign="top" class="frm_td_bydays">
                  <font color="#000000">Choose this option for a non-reoccurring single or multi-day event, with a new event occurrence for every day within the Start and End Date range</font>
                </td>
              </tr>
              <tr>
                <td width="60" rowspan="3" align="left" valign="top"><u>By Week</u></td>
                <td width="110" align="left" valign="top" class="frm_td_byweeks">
                  <font color="#000000">
                    Once Per Week
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
