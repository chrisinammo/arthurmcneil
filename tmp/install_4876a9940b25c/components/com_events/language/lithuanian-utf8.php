<?php
/**
 * Events Component for Joomla 1.0.x
 *
 * @version     $Id: lithuanian-utf8.php 991 2008-03-10 19:55:48Z tstahl $
 * @package     Events
 * @copyright   Copyright (C) 2006-2008 JEvents Project Group
 * @licence     http://www.gnu.org/copyleft/gpl.html
 * @link        http://joomlacode.org/gf/project/jevents
 * @encoding    utf-8
 */

defined("_VALID_MOS") or die("Direct Access to this location is not allowed");

//Check
DEFINE("_CAL_LANG_INCLUDED", 1);

// new 1.4.0 [mic]
define("_CAL_LANG_LNG",				"XXXXen"); // de|fr|etc... [ DO NOT CHANGE THIS VALUE! ]

// used for colorpicker
define("_CAL_LANG_NO_COLOR",			"XXXXNo Color");
define("_CAL_LANG_COLOR_PICKER",		"XXXXColor Picker");

// common
define("_CAL_LANG_TIME",				"XXXXTime");
define("_CAL_LANG_CLICK_TO_OPEN_EVENT",	"XXXXClick to open event");
define("_CAL_LANG_UNPUBLISHED",		"XXXX** Unpublished **");
define("_CAL_LANG_DESCRIPTION",		"XXXXDescription");
define("_CAL_LANG_EMAIL_TO_AUTHOR",	"XXXXEmail to author");
define("_CAL_LANG_MAIL_TO_ADMIN",		"XXXXEvent submited from [ %s ] by [ %s ]");
define("_CAL_LANG_KEYWORD_NOT_VALID",	"XXXXNot a valid keyword");
define("_CAL_LANG_EVENT_CALENDAR",		"XXXXEvents Calendar"); // new 1.4

// modul
define("_CAL_LANG_ERR_NO_MOD_CAL",		"Events Calendar\n<br />This module needs the Events component");
define("_CAL_LANG_CLICK_TOSWITCH_DAY",	"XXXXGo to calendar - current day");
define("_CAL_LANG_CLICK_TOSWITCH_MON",	"XXXXGo to calendar - current month");
define("_CAL_LANG_CLICK_TOSWITCH_YEAR",	"XXXXGo to calendar - current year");
define("_CAL_LANG_CLICK_TOSWITCH_PY",	"XXXXGo to calendar - previous year");
define("_CAL_LANG_CLICK_TOSWITCH_PM",	"XXXXGo to calendar - previous month");
define("_CAL_LANG_CLICK_TOSWITCH_NM",	"XXXXGo to calendar - next month");
define("_CAL_LANG_CLICK_TOSWITCH_NY",	"XXXXGo to calendar - next year");

// navTableNext
define("_CAL_LANG_NAV_TN_FIRST_LIST",	"XXXXfirst list");
define("_CAL_LANG_NAV_TN_PREV_LIST",	"XXXXprevious list");
define("_CAL_LANG_NAV_TN_NEXT_LIST",	"XXXXnext list");
define("_CAL_LANG_NAV_TN_LAST_LIST",	"XXXXfinal list");

// calendar monthly display
define("_CAL_LANG_FIRST_SINGLE_DAY_EVENT",		"XXXXSingle event");
define("_CAL_LANG_FIRST_DAY_OF_MULTIEVENT",	"XXXXFirst day of multiday event");
define("_CAL_LANG_LAST_DAY_OF_MULTIEVENT",		"XXXXLast day of a multiday event");
define("_CAL_LANG_MULTIDAY_EVENT",				"XXXXMultiday event");
/* ++++++ end mic +++++++++++++ */

// Months
DEFINE("_CAL_LANG_JANUARY", "Sausis");
DEFINE("_CAL_LANG_FEBRUARY", "Vasaris");
DEFINE("_CAL_LANG_MARCH", "Kovas");
DEFINE("_CAL_LANG_APRIL", "Balandis");
DEFINE("_CAL_LANG_MAY", "Gegužė");
DEFINE("_CAL_LANG_JUNE", "Birželis");
DEFINE("_CAL_LANG_JULY", "Liepa");
DEFINE("_CAL_LANG_AUGUST", "Rugpjūtis");
DEFINE("_CAL_LANG_SEPTEMBER", "Rugsėjis");
DEFINE("_CAL_LANG_OCTOBER", "Spalis");
DEFINE("_CAL_LANG_NOVEMBER", "Lapkritis");
DEFINE("_CAL_LANG_DECEMBER", "Gruodis");

// Short day names
DEFINE("_CAL_LANG_SUN", "Sk");
DEFINE("_CAL_LANG_MON", "Pr");
DEFINE("_CAL_LANG_TUE", "An");
DEFINE("_CAL_LANG_WED", "Tr");
DEFINE("_CAL_LANG_THU", "Kt");
DEFINE("_CAL_LANG_FRI", "Pn");
DEFINE("_CAL_LANG_SAT", "Št");

// Days
DEFINE("_CAL_LANG_SUNDAY", "Sekmadienis");
DEFINE("_CAL_LANG_MONDAY", "Pirmadienis");
DEFINE("_CAL_LANG_TUESDAY", "Antradienis");
DEFINE("_CAL_LANG_WEDNESDAY", "Trečiadienis");
DEFINE("_CAL_LANG_THURSDAY", "Ketvirtadienis");
DEFINE("_CAL_LANG_FRIDAY", "Penktadienis");
DEFINE("_CAL_LANG_SATURDAY", "Šeštadienis");

// Days lettres
DEFINE("_CAL_LANG_SUNDAYSHORT", "Š");
DEFINE("_CAL_LANG_MONDAYSHORT", "P");
DEFINE("_CAL_LANG_TUESDAYSHORT", "A");
DEFINE("_CAL_LANG_WEDNESDAYSHORT", "K");
DEFINE("_CAL_LANG_THURSDAYSHORT", "A");
DEFINE("_CAL_LANG_FRIDAYSHORT", "P");
DEFINE("_CAL_LANG_SATURDAYSHORT", "Š");

// Repeat type
DEFINE("_CAL_LANG_ALLDAYS", "Visomis dienomis");
DEFINE("_CAL_LANG_EACHWEEK", "Visomis savaitėmis");
DEFINE("_CAL_LANG_EACHWEEKPAIR", "Visomis nelyginėmis savaitėmis");
DEFINE("_CAL_LANG_EACHWEEKIMPAIR", "Visomis lyginėmis savaitėmis");
DEFINE("_CAL_LANG_EACHMONTH", "Visais mėnesiais");
DEFINE("_CAL_LANG_EACHYEAR", "Visais metais");
DEFINE("_CAL_LANG_ONLYDAYS", "Tik pažymėtomis dienomis");
DEFINE("_CAL_LANG_EACH", "Kiekvieną");
DEFINE("_CAL_LANG_EACHOF","Kiekvieną iš");
DEFINE("_CAL_LANG_ENDMONTH", "mėnesio pabaigos");

// Repeat days
DEFINE("_CAL_LANG_BYDAYNUMBER", "Pagal dienos numerį");

// User type
DEFINE("_CAL_LANG_ANONYME", "Anonimas");

// Post
//PAS D'ACCENTS DANS LES _ACT_
DEFINE("_CAL_LANG_ACT_ADDED", "Ačiū už pasiūlytą renginį - Mes patikrinę informaciją, jį patalpinsime!"); //NO ACCENT !!
DEFINE("_CAL_LANG_ACT_MODIFIED", "Šis renginis pakeistas sėkmingai."); //NO ACCENT !!
DEFINE("_CAL_LANG_ACT_PUBLISHED", "XXXXThis event has been published.");  //NEW 1.4
DEFINE("_CAL_LANG_ACT_DELETED", "Šis renginys panaikintas!"); //NO ACCENT !!
DEFINE("_CAL_LANG_NOPERMISSION", "Jums nesuteikta teisi atlikti šį veiksmą !"); //NO ACCENT !!

DEFINE("_CAL_LANG_MAIL_ADDED", "Naujas renginys: ");
DEFINE("_CAL_LANG_MAIL_MODIFIED", "Naujas pataisymas: ");

// Presentation
DEFINE("_CAL_LANG_BY", "patalpino");
DEFINE("_CAL_LANG_FROM", "Nuo");
DEFINE("_CAL_LANG_TO", "Iki");
DEFINE("_CAL_LANG_ARCHIVE", "Archyvas");
DEFINE("_CAL_LANG_WEEK", "savaitė");
DEFINE("_CAL_LANG_NO_EVENTS", "Nėra renginių");
DEFINE("_CAL_LANG_NO_EVENTFOR", "Nėra renginių: ");
DEFINE("_CAL_LANG_NO_EVENTFORTHE", "Nėra renginių: ");
DEFINE("_CAL_LANG_THIS_DAY", "šiai dienai");
DEFINE("_CAL_LANG_THIS_MONTH", "šiam mėnesiui");
DEFINE("_CAL_LANG_LAST_MONTH", "Last month");
DEFINE("_CAL_LANG_NEXT_MONTH", "Sekantis mėnuo");
DEFINE("_CAL_LANG_EVENTSFOR", "Renginiai: ");
DEFINE("_CAL_LANG_SEARCHRESULTS", "XXXXSearch Results for keyword"); // new 1.4
DEFINE("_CAL_LANG_EVENTSFORTHE", "Renginiai: ");
DEFINE("_CAL_LANG_REP_DAY", "diena");
DEFINE("_CAL_LANG_REP_WEEK", "savaitei");
DEFINE("_CAL_LANG_REP_WEEKPAIR", "nelyginei savaitei");
DEFINE("_CAL_LANG_REP_WEEKIMPAIR", "lyginei savaitei");
DEFINE("_CAL_LANG_REP_MONTH", "mėnesiui");
DEFINE("_CAL_LANG_REP_YEAR", "metams");
DEFINE("_CAL_LANG_REP_NOEVENTSELECTED", "Please select an event first");

// Navigation
DEFINE("_CAL_LANG_VIEWTODAY", "Šiandien");
DEFINE("_CAL_LANG_VIEWTOCOME", "Šį mėnesį");
DEFINE("_CAL_LANG_VIEWBYDAY", "Diena");
DEFINE("_CAL_LANG_VIEWBYCAT", "Kategorija");
DEFINE("_CAL_LANG_VIEWBYMONTH", "Mėnuo");
DEFINE("_CAL_LANG_VIEWBYYEAR", "Metai");
DEFINE("_CAL_LANG_VIEWBYWEEK", "Savaitė");
DEFINE("_CAL_LANG_JUMPTO", "XXXXJump to specific month");  // New 1.4
DEFINE("_CAL_LANG_BACK", "Atgal");
DEFINE("_CAL_LANG_CLOSE", "Close");
DEFINE("_CAL_LANG_PREVIOUSDAY", "Praėjusi diena");
DEFINE("_CAL_LANG_PREVIOUSWEEK", "Praėjusi sąvaitė");
DEFINE("_CAL_LANG_PREVIOUSMONTH", "Praėjęs mėnuo");
DEFINE("_CAL_LANG_PREVIOUSYEAR", "Praėję metai");
DEFINE("_CAL_LANG_NEXTDAY", "Sekanti diena");
DEFINE("_CAL_LANG_NEXTWEEK", "Sekanti savaitė");
DEFINE("_CAL_LANG_NEXTMONTH", "Sekantis mėnuo");
DEFINE("_CAL_LANG_NEXTYEAR", "Sekantys metai");

DEFINE("_CAL_LANG_ADMINPANEL", "Administratoriaus irankiai");
DEFINE("_CAL_LANG_ADDEVENT", "Naujas renginys");
DEFINE("_CAL_LANG_MYEVENTS", "Mano renginiai");
DEFINE("_CAL_LANG_DELETE", "Šalinti");
DEFINE("_CAL_LANG_MODIFY", "Keisti");

// Form
DEFINE("_CAL_LANG_HELP", "Pagalba");

DEFINE("_CAL_LANG_CAL_TITLE", "Renginiai");
DEFINE("_CAL_LANG_ADD_TITLE", "Pridėti");
DEFINE("_CAL_LANG_MODIFY_TITLE", "Keisti");

DEFINE("_CAL_LANG_REPEAT_DISABLED", "XXXXEvent Repeating is only applicable if End Date is after Start Date.  Change End Date before configuring event repeat details."); // New for 1.4
DEFINE("_CAL_LANG_EVENT_TITLE", "Tema");
DEFINE("_CAL_LANG_EVENT_COLOR", "Spalva");
DEFINE("_CAL_LANG_EVENT_CATCOLOR", "Use Category Color");
DEFINE("_CAL_LANG_EVENT_CATEGORY", "Kategorijos");
DEFINE("_CAL_LANG_EVENT_CHOOSE_CATEG", "Pasirinkite kategoriją");
DEFINE("_CAL_LANG_EVENT_ACTIVITY", "Aktyvumas");
DEFINE("_CAL_LANG_EVENT_URLMAIL_INFO", "Norėdami įvesti interneto adresą ar e-mail adresą, paprasčiausiai rašykite <u>http://www.adresas.com</u> arba <u>mailto:mano@pastas.com</u>");
DEFINE("_CAL_LANG_EVENT_ADRESSE", "Adresas");
DEFINE("_CAL_LANG_EVENT_CONTACT", "Kontaktai");
DEFINE("_CAL_LANG_EVENT_EXTRA", "Extra Informacija");
DEFINE("_CAL_LANG_EVENT_AUTHOR_ALIAS", "Autorius (nikas)");
DEFINE("_CAL_LANG_EVENT_STARTDATE", "Pradžios data");
DEFINE("_CAL_LANG_EVENT_ENDDATE", "Pabaigos data");
DEFINE("_CAL_LANG_EVENT_STARTHOURS", "Pradžios valanda");
DEFINE("_CAL_LANG_EVENT_ENDHOURS", "Pabaigos valanda");
DEFINE("_CAL_LANG_EVENT_STARTTIME", "Pradžios valanda");
DEFINE("_CAL_LANG_EVENT_ENDTIME", "Pabaigos valanda");
DEFINE("_CAL_LANG_PUB_INFO", "Publication informations");
DEFINE("_CAL_LANG_EVENT_REPEATTYPE", "Kartojimo tipas");
DEFINE("_CAL_LANG_EVENT_REPEATDAY", "Kartojimo diena");
DEFINE("_CAL_LANG_EVENT_CHOOSE_WEEKDAYS", "Savaitės dienos");
DEFINE("_CAL_LANG_EVENT_PER", "per");
DEFINE("_CAL_LANG_EVENT_WEEKOPT", "Week(s) of a month repeat type week");

DEFINE("_CAL_LANG_SUBMITPREVIEW", "Perziura");
DEFINE("_CAL_LANG_SUBMITCANCEL", "Atšaukti");
DEFINE("_CAL_LANG_SUBMITSAVE", "Išsaugoti");

DEFINE("_CAL_LANG_E_WARNWEEKS", "Pasirinkite savaitę.");
DEFINE("_CAL_LANG_E_WARNDAYS", "Pasirinkite dieną.");

// Admin
DEFINE("_CAL_LANG_EVENT_ALLCAT", "Visos kategorijos");
DEFINE("_CAL_LANG_EVENT_ACCESSLEVEL", "Priėjimo lygis");
DEFINE("_CAL_LANG_EVENT_HITS", "Peržiūrėta");
DEFINE("_CAL_LANG_EVENT_STATE", "Būklė");
DEFINE("_CAL_LANG_EVENT_CREATED", "Patalpinta");
DEFINE("_CAL_LANG_EVENT_NEWEVENT", "Naujas renginys");
DEFINE("_CAL_LANG_EVENT_MODIFIED", "Paskutinį kartą keista");
DEFINE("_CAL_LANG_EVENT_NOTMODIFIED", "Nepakeista");

// dmcd aug 22/04  new warning alert for no specified activity in event entry
DEFINE("_CAL_LANG_WARNACTIVITY", "Some sort of Activity\\ndescription must be entered.");

DEFINE("_CAL_LEGEND_ALL_CATEGORIES", "XXXXAll Categories ...");  // new for 1.4
DEFINE("_CAL_LEGEND_ALL_CATEGORIES_DESC", "XXXXShow events from all categories");  // new for 1.4

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
