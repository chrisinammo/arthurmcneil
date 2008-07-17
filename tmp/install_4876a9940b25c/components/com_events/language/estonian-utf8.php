<?php
/**
 * Events Component for Joomla 1.0.x
 *
 * @version     $Id: estonian-utf8.php 991 2008-03-10 19:55:48Z tstahl $
 * @package     Events
 * @copyright   Copyright (C) 2006 JEvents Project Group
 * @licence     http://www.gnu.org/copyleft/gpl.html
 * @link        http://joomlacode.org/gf/project/jevents
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
DEFINE("_CAL_LANG_JANUARY", "Jaanuar");
DEFINE("_CAL_LANG_FEBRUARY", "Veebruar");
DEFINE("_CAL_LANG_MARCH", "Märts");
DEFINE("_CAL_LANG_APRIL", "Aprill");
DEFINE("_CAL_LANG_MAY", "Mai");
DEFINE("_CAL_LANG_JUNE", "Juuni");
DEFINE("_CAL_LANG_JULY", "Juuli");
DEFINE("_CAL_LANG_AUGUST", "August");
DEFINE("_CAL_LANG_SEPTEMBER", "September");
DEFINE("_CAL_LANG_OCTOBER", "Oktoober");
DEFINE("_CAL_LANG_NOVEMBER", "November");
DEFINE("_CAL_LANG_DECEMBER", "Detsember");

// Short day names
DEFINE("_CAL_LANG_SUN", "Püh");
DEFINE("_CAL_LANG_MON", "Esm");
DEFINE("_CAL_LANG_TUE", "Tei");
DEFINE("_CAL_LANG_WED", "Kol");
DEFINE("_CAL_LANG_THU", "Nel");
DEFINE("_CAL_LANG_FRI", "Ree");
DEFINE("_CAL_LANG_SAT", "Lau");

// Days
DEFINE("_CAL_LANG_SUNDAY", "Pühapäev");
DEFINE("_CAL_LANG_MONDAY", "Esmaspäev");
DEFINE("_CAL_LANG_TUESDAY", "Teisipäev");
DEFINE("_CAL_LANG_WEDNESDAY", "Kolmapäev");
DEFINE("_CAL_LANG_THURSDAY", "Neljapäev");
DEFINE("_CAL_LANG_FRIDAY", "Reede");
DEFINE("_CAL_LANG_SATURDAY", "Laupäev");

// Days lettres
DEFINE("_CAL_LANG_SUNDAYSHORT", "P");
DEFINE("_CAL_LANG_MONDAYSHORT", "E");
DEFINE("_CAL_LANG_TUESDAYSHORT", "N");
DEFINE("_CAL_LANG_WEDNESDAYSHORT", "K");
DEFINE("_CAL_LANG_THURSDAYSHORT", "N");
DEFINE("_CAL_LANG_FRIDAYSHORT", "R");
DEFINE("_CAL_LANG_SATURDAYSHORT", "P");

// Repeat type
DEFINE("_CAL_LANG_ALLDAYS", "Iga päev");
DEFINE("_CAL_LANG_EACHWEEK", "Iga nädal");
DEFINE("_CAL_LANG_EACHWEEKPAIR", "Iga paaris nädal");
DEFINE("_CAL_LANG_EACHWEEKIMPAIR", "Iga paaritu nädal");
DEFINE("_CAL_LANG_EACHMONTH", "Iga kuu");
DEFINE("_CAL_LANG_EACHYEAR", "Iga aasta");
DEFINE("_CAL_LANG_ONLYDAYS", "Ainult valitud päevad");
DEFINE("_CAL_LANG_EACH", "Iga");
DEFINE("_CAL_LANG_EACHOF","kõigist");
DEFINE("_CAL_LANG_ENDMONTH", "aeg kuu");

// Repeat days
DEFINE("_CAL_LANG_BYDAYNUMBER", "Päeva numbri järgi");

// User type
DEFINE("_CAL_LANG_ANONYME", "Anonüümne");

// Post
//PAS D'ACCENTS DANS LES _ACT_
DEFINE("_CAL_LANG_ACT_ADDED", "Täname saatmise eest - Kontrollime sinu ettepanekut!"); //NO ACCENT !!
DEFINE("_CAL_LANG_ACT_MODIFIED", "Sündmus on muudetud."); //NO ACCENT !!
DEFINE("_CAL_LANG_ACT_PUBLISHED", "XXXXThis event has been published.");  //NEW 1.4
DEFINE("_CAL_LANG_ACT_DELETED", "Sündmus on kustutatud!"); //NO ACCENT !!
DEFINE("_CAL_LANG_NOPERMISSION", "Sul ei ole selleks tegevuseks õigusi !"); //NO ACCENT !!

DEFINE("_CAL_LANG_MAIL_ADDED", "Värskelt postitatud");
DEFINE("_CAL_LANG_MAIL_MODIFIED", "Värskelt muudetud");

// Presentation
DEFINE("_CAL_LANG_BY", "sisestaja");
DEFINE("_CAL_LANG_FROM", "Algus");
DEFINE("_CAL_LANG_TO", "Lõpp");
DEFINE("_CAL_LANG_ARCHIVE", "Arhiiv");
DEFINE("_CAL_LANG_WEEK", "nädal");
DEFINE("_CAL_LANG_NO_EVENTS", "Sündmused puuduvad");
DEFINE("_CAL_LANG_NO_EVENTFOR", "Ei ole sündmusi");
DEFINE("_CAL_LANG_NO_EVENTFORTHE", "Ei ole sündmusi");
DEFINE("_CAL_LANG_THIS_DAY", "täna");
DEFINE("_CAL_LANG_THIS_MONTH", "käesolev kuu");
DEFINE("_CAL_LANG_LAST_MONTH", "Last month");
DEFINE("_CAL_LANG_NEXT_MONTH", "Mois suivant");
DEFINE("_CAL_LANG_EVENTSFOR", "Sündmused");
DEFINE("_CAL_LANG_SEARCHRESULTS", "XXXXSearch Results for keyword"); // new 1.4
DEFINE("_CAL_LANG_EVENTSFORTHE", "Sündmused");
DEFINE("_CAL_LANG_REP_DAY", "day");
DEFINE("_CAL_LANG_REP_WEEK", "nädal");
DEFINE("_CAL_LANG_REP_WEEKPAIR", "paaris nädal");
DEFINE("_CAL_LANG_REP_WEEKIMPAIR", "paaritu nädal");
DEFINE("_CAL_LANG_REP_MONTH", "kuu");
DEFINE("_CAL_LANG_REP_YEAR", "aasta");
DEFINE("_CAL_LANG_REP_NOEVENTSELECTED", "Please select an event first");

// Navigation
DEFINE("_CAL_LANG_VIEWTODAY", "See Today");
DEFINE("_CAL_LANG_VIEWTOCOME", "XXXXUpComing this month");
DEFINE("_CAL_LANG_VIEWBYDAY", "XXXXSee by day");
DEFINE("_CAL_LANG_VIEWBYCAT", "Näita kategooriate järgi");
DEFINE("_CAL_LANG_VIEWBYMONTH", "Näita kuud");
DEFINE("_CAL_LANG_VIEWBYYEAR", "XXXXSee by year");
DEFINE("_CAL_LANG_VIEWBYWEEK", "Näita nädalat");
DEFINE("_CAL_LANG_JUMPTO", "XXXXJump to specific month");  // New 1.4
DEFINE("_CAL_LANG_BACK", "Tagasi");
DEFINE("_CAL_LANG_CLOSE", "Close");
DEFINE("_CAL_LANG_PREVIOUSDAY", "Jour précédent");
DEFINE("_CAL_LANG_PREVIOUSWEEK", "Semaine précédente");
DEFINE("_CAL_LANG_PREVIOUSMONTH", "Mois précédent");
DEFINE("_CAL_LANG_PREVIOUSYEAR", "Année précédente");
DEFINE("_CAL_LANG_NEXTDAY", "Jour suivant");
DEFINE("_CAL_LANG_NEXTWEEK", "Semaine suivante");
DEFINE("_CAL_LANG_NEXTMONTH", "Mois suivant");
DEFINE("_CAL_LANG_NEXTYEAR", "Année suivante");

DEFINE("_CAL_LANG_ADMINPANEL", "Admini paneel");
DEFINE("_CAL_LANG_ADDEVENT", "Lisa sündmus");
DEFINE("_CAL_LANG_MYEVENTS", "Minu sündmused");
DEFINE("_CAL_LANG_DELETE", "Kustuta");
DEFINE("_CAL_LANG_MODIFY", "Muuda");

// Form
DEFINE("_CAL_LANG_HELP", "Help");

DEFINE("_CAL_LANG_CAL_TITLE", "Sündmused");
DEFINE("_CAL_LANG_ADD_TITLE", "Lisa");
DEFINE("_CAL_LANG_MODIFY_TITLE", "Muuda");

DEFINE("_CAL_LANG_REPEAT_DISABLED", "XXXXEvent Repeating is only applicable if End Date is after Start Date.  Change End Date before configuring event repeat details."); // New for 1.4
DEFINE("_CAL_LANG_EVENT_TITLE", "Teema");
DEFINE("_CAL_LANG_EVENT_COLOR", "Värv");
DEFINE("_CAL_LANG_EVENT_CATCOLOR", "Use Category Color");
DEFINE("_CAL_LANG_EVENT_CATEGORY", "Kategooriad");
DEFINE("_CAL_LANG_EVENT_CHOOSE_CATEG", "Vali kategooria");
DEFINE("_CAL_LANG_EVENT_ACTIVITY", "Aktiivne");
DEFINE("_CAL_LANG_EVENT_URLMAIL_INFO", "URL'i või E-posti lisamiseks, kirjutage lihtsalt <u>http://www.mysite.com</u> või <u>mailto:my@mail.com</u>");
DEFINE("_CAL_LANG_EVENT_ADRESSE", "Asukoht");
DEFINE("_CAL_LANG_EVENT_CONTACT", "Kontakt");
DEFINE("_CAL_LANG_EVENT_EXTRA", "Eriinfo");
DEFINE("_CAL_LANG_EVENT_AUTHOR_ALIAS", "Autor (hüüdnimi)");
DEFINE("_CAL_LANG_EVENT_STARTDATE", "Alguse kuupäev");
DEFINE("_CAL_LANG_EVENT_ENDDATE", "Lõpu kuupäev");
DEFINE("_CAL_LANG_EVENT_STARTHOURS", "Alguse aeg");
DEFINE("_CAL_LANG_EVENT_ENDHOURS", "Lõpu aeg");
DEFINE("_CAL_LANG_EVENT_STARTTIME", "Alguse aeg");
DEFINE("_CAL_LANG_EVENT_ENDTIME", "Lõpu aeg");
DEFINE("_CAL_LANG_PUB_INFO", "Publitseerimise info");
DEFINE("_CAL_LANG_EVENT_REPEATTYPE", "Korduse tüüp");
DEFINE("_CAL_LANG_EVENT_REPEATDAY", "Korduse päev");
DEFINE("_CAL_LANG_EVENT_CHOOSE_WEEKDAYS", "Päevad nädalas");
DEFINE("_CAL_LANG_EVENT_PER", "per");
DEFINE("_CAL_LANG_EVENT_WEEKOPT", "Week(s) of a month repeat type week");

DEFINE("_CAL_LANG_SUBMITPREVIEW", "Eelvaade");
DEFINE("_CAL_LANG_SUBMITCANCEL", "Katkesta");
DEFINE("_CAL_LANG_SUBMITSAVE", "Salvesta");

DEFINE("_CAL_LANG_E_WARNWEEKS", "XXXXPlease select a week.");
DEFINE("_CAL_LANG_E_WARNDAYS", "XXXXPlease select a day.");

// Admin
DEFINE("_CAL_LANG_EVENT_ALLCAT", "Kõik kategooriad");
DEFINE("_CAL_LANG_EVENT_ACCESSLEVEL", "Õiguste tase");
DEFINE("_CAL_LANG_EVENT_HITS", "Loetud kordi");
DEFINE("_CAL_LANG_EVENT_STATE", "Seisund");
DEFINE("_CAL_LANG_EVENT_CREATED", "Loodud");
DEFINE("_CAL_LANG_EVENT_NEWEVENT", "Uus sündmus");
DEFINE("_CAL_LANG_EVENT_MODIFIED", "Viimati muudetud");
DEFINE("_CAL_LANG_EVENT_NOTMODIFIED", "Ei ole muudetud");

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
