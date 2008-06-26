<?php
/**
 * Events Component for Joomla 1.0.x
 *
 * @version     $Id: hungarian.php 880 2007-10-31 19:16:08Z tstahl $
 * @package     Events
 * @copyright   Copyright (C) 2006-2007 JEvents Project Group
 * @licence     http://www.gnu.org/copyleft/gpl.html
 * @link        http://joomlacode.org/gf/project/jevents
 */

defined( '_JEXEC' ) or die( 'Restricted access' );

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
DEFINE("_CAL_LANG_JANUARY", "Janu�r");
DEFINE("_CAL_LANG_FEBRUARY", "Febru�r");
DEFINE("_CAL_LANG_MARCH", "M�rcius");
DEFINE("_CAL_LANG_APRIL", "�prilis");
DEFINE("_CAL_LANG_MAY", "M�jus");
DEFINE("_CAL_LANG_JUNE", "J�nius");
DEFINE("_CAL_LANG_JULY", "J�lius");
DEFINE("_CAL_LANG_AUGUST", "Augusztus");
DEFINE("_CAL_LANG_SEPTEMBER", "Szeptember");
DEFINE("_CAL_LANG_OCTOBER", "Okt�ber");
DEFINE("_CAL_LANG_NOVEMBER", "November");
DEFINE("_CAL_LANG_DECEMBER", "December");

// Short day names
DEFINE("_CAL_LANG_SUN", "Vas");
DEFINE("_CAL_LANG_MON", "H�t");
DEFINE("_CAL_LANG_TUE", "Ke");
DEFINE("_CAL_LANG_WED", "Szer");
DEFINE("_CAL_LANG_THU", "Cs�t");
DEFINE("_CAL_LANG_FRI", "P�n");
DEFINE("_CAL_LANG_SAT", "Szo");

// Days
DEFINE("_CAL_LANG_SUNDAY", "Vas�rnap");
DEFINE("_CAL_LANG_MONDAY", "H�tf�");
DEFINE("_CAL_LANG_TUESDAY", "Kedd");
DEFINE("_CAL_LANG_WEDNESDAY", "Szerda");
DEFINE("_CAL_LANG_THURSDAY", "Cs�t�rt�k");
DEFINE("_CAL_LANG_FRIDAY", "P�ntek");
DEFINE("_CAL_LANG_SATURDAY", "Szombat");

// Days lettres
DEFINE("_CAL_LANG_SUNDAYSHORT", "V");
DEFINE("_CAL_LANG_MONDAYSHORT", "H");
DEFINE("_CAL_LANG_TUESDAYSHORT", "K");
DEFINE("_CAL_LANG_WEDNESDAYSHORT", "S");
DEFINE("_CAL_LANG_THURSDAYSHORT", "K");
DEFINE("_CAL_LANG_FRIDAYSHORT", "P");
DEFINE("_CAL_LANG_SATURDAYSHORT", "V");

// Repeat type
DEFINE("_CAL_LANG_ALLDAYS", "Minden nap");
DEFINE("_CAL_LANG_EACHWEEK", "Minden h�ten");
DEFINE("_CAL_LANG_EACHWEEKPAIR", "Minden p�ros h�ten");
DEFINE("_CAL_LANG_EACHWEEKIMPAIR", "Minden p�ratlan h�ten");
DEFINE("_CAL_LANG_EACHMONTH", "Minden h�napban");
DEFINE("_CAL_LANG_EACHYEAR", "Minden �vben");
DEFINE("_CAL_LANG_ONLYDAYS", "Csak a kiv�lasztott napon");
DEFINE("_CAL_LANG_EACH", "Each");
DEFINE("_CAL_LANG_EACHOF","of each");
DEFINE("_CAL_LANG_ENDMONTH", "h�nap v�ge");

// Repeat days
DEFINE("_CAL_LANG_BYDAYNUMBER", "By day number");

// User type
DEFINE("_CAL_LANG_ANONYME", "N�v n�l�l");

// Post
//PAS D'ACCENTS DANS LES _ACT_
DEFINE("_CAL_LANG_ACT_ADDED", "K�sz a r�gz�t�st - �tn�zz�k!"); //NO ACCENT !!
DEFINE("_CAL_LANG_ACT_MODIFIED", "Ez az esem�ny m�dosult."); //NO ACCENT !!
DEFINE("_CAL_LANG_ACT_PUBLISHED", "XXXXThis event has been published.");  //NEW 1.4
DEFINE("_CAL_LANG_ACT_DELETED", "Esem�ny t�rl�d�tt!"); //NO ACCENT !!
DEFINE("_CAL_LANG_NOPERMISSION", "Nincs jogosults�god a szerv�zhez !"); //NO ACCENT !!

DEFINE("_CAL_LANG_MAIL_ADDED", "�j r�gz�t�s");
DEFINE("_CAL_LANG_MAIL_MODIFIED", "�j m�dos�t�s");

// Presentation
DEFINE("_CAL_LANG_BY", "");
DEFINE("_CAL_LANG_FROM", "kezdet::");
DEFINE("_CAL_LANG_TO", "v�ge::");
DEFINE("_CAL_LANG_ARCHIVE", "Archiv");
DEFINE("_CAL_LANG_WEEK", "a h�t");
DEFINE("_CAL_LANG_NO_EVENTS", "Nincs esem�ny");
DEFINE("_CAL_LANG_NO_EVENTFOR", "Nincs esem�ny");
DEFINE("_CAL_LANG_NO_EVENTFORTHE", "Nincs esem�ny");
DEFINE("_CAL_LANG_THIS_DAY", "ez a nap");
DEFINE("_CAL_LANG_THIS_MONTH", "ez a h�nap");
DEFINE("_CAL_LANG_LAST_MONTH", "Utols� h�nap");
DEFINE("_CAL_LANG_NEXT_MONTH", "K�vetkez� h�nap");
DEFINE("_CAL_LANG_EVENTSFOR", "Esem�nyek");
DEFINE("_CAL_LANG_SEARCHRESULTS", "XXXXSearch Results for keyword"); // new 1.4
DEFINE("_CAL_LANG_EVENTSFORTHE", "Esem�nyek");
DEFINE("_CAL_LANG_REP_DAY", "nap");
DEFINE("_CAL_LANG_REP_WEEK", "h�t");
DEFINE("_CAL_LANG_REP_WEEKPAIR", "p�ros h�t");
DEFINE("_CAL_LANG_REP_WEEKIMPAIR", "p�ratlan h�t");
DEFINE("_CAL_LANG_REP_MONTH", "h�nap");
DEFINE("_CAL_LANG_REP_YEAR", "�v");
DEFINE("_CAL_LANG_REP_NOEVENTSELECTED", "Please select an event first");

// Navigation
DEFINE("_CAL_LANG_VIEWTODAY", "Mai nap");
DEFINE("_CAL_LANG_VIEWTOCOME", "K�vetkez� ebben a h�napban");
DEFINE("_CAL_LANG_VIEWBYDAY", "Naponk�nt");
DEFINE("_CAL_LANG_VIEWBYCAT", "Kateg�ri�nk�nt");
DEFINE("_CAL_LANG_VIEWBYMONTH", "H�napk�nt");
DEFINE("_CAL_LANG_VIEWBYYEAR", "�venk�nt");
DEFINE("_CAL_LANG_VIEWBYWEEK", "Hetente");
DEFINE("_CAL_LANG_JUMPTO", "XXXXJump to specific month");  // New 1.4
DEFINE("_CAL_LANG_BACK", "Vissza");
DEFINE("_CAL_LANG_CLOSE", "Close");
DEFINE("_CAL_LANG_PREVIOUSDAY", "El�z� nap");
DEFINE("_CAL_LANG_PREVIOUSWEEK", "El�z� h�t");
DEFINE("_CAL_LANG_PREVIOUSMONTH", "El�z� h�nap");
DEFINE("_CAL_LANG_PREVIOUSYEAR", "El�z� �v");
DEFINE("_CAL_LANG_NEXTDAY", "K�vetkez� nap");
DEFINE("_CAL_LANG_NEXTWEEK", "K�vetkez� h�t");
DEFINE("_CAL_LANG_NEXTMONTH", "K�vetkez� h�nap");
DEFINE("_CAL_LANG_NEXTYEAR", "K�vetkez� �v");

DEFINE("_CAL_LANG_ADMINPANEL", "Admin panel");
DEFINE("_CAL_LANG_ADDEVENT", "Esem�ny hozz�ad�sa");
DEFINE("_CAL_LANG_MYEVENTS", "Esem�nyeim");
DEFINE("_CAL_LANG_DELETE", "T�rl�s");
DEFINE("_CAL_LANG_MODIFY", "M�dos�t�s");

// Form
DEFINE("_CAL_LANG_HELP", "Help");

DEFINE("_CAL_LANG_CAL_TITLE", "Esem�nyek");
DEFINE("_CAL_LANG_ADD_TITLE", "Hozz�ad");
DEFINE("_CAL_LANG_MODIFY_TITLE", "M�dos�t�s");

DEFINE("_CAL_LANG_EVENT_TITLE", "T�rgy");
DEFINE("_CAL_LANG_EVENT_COLOR", "Sz�n");
DEFINE("_CAL_LANG_EVENT_CATCOLOR", "Use Category Color");
DEFINE("_CAL_LANG_EVENT_CATEGORY", "Kateg�ria");
DEFINE("_CAL_LANG_EVENT_CHOOSE_CATEG", "V�lassz kateg�ri�t");
DEFINE("_CAL_LANG_EVENT_ACTIVITY", "Aktivit�s");
DEFINE("_CAL_LANG_EVENT_URLMAIL_INFO", "URL vagy MAIL hozz�ad�sakor haszn�ld  ezt a f�rm�t: <u>http://www.mysite.com</u> vagy <u>mailto:my@mail.com</u>");
DEFINE("_CAL_LANG_EVENT_ADRESSE", "Hely");
DEFINE("_CAL_LANG_EVENT_CONTACT", "Kapcsolat");
DEFINE("_CAL_LANG_EVENT_EXTRA", "Extra info");
DEFINE("_CAL_LANG_EVENT_AUTHOR_ALIAS", "Szerz� (alias)");
DEFINE("_CAL_LANG_EVENT_STARTDATE", "Indul� d�tum");
DEFINE("_CAL_LANG_EVENT_ENDDATE", "V�ge d�tum");
DEFINE("_CAL_LANG_EVENT_STARTHOURS", "Indul� �ra");
DEFINE("_CAL_LANG_EVENT_ENDHOURS", "V�ge �ra");
DEFINE("_CAL_LANG_EVENT_STARTTIME", "Indul� �ra");
DEFINE("_CAL_LANG_EVENT_ENDTIME", "V�ge �ra");
DEFINE("_CAL_LANG_PUB_INFO", "Publik�ci�");
DEFINE("_CAL_LANG_EVENT_REPEATTYPE", "Ism�tl�s tipusa");
DEFINE("_CAL_LANG_EVENT_REPEATDAY", "Napi ism�tl�s");
DEFINE("_CAL_LANG_EVENT_CHOOSE_WEEKDAYS", "A h�t napjai");
DEFINE("_CAL_LANG_EVENT_PER", "per");
DEFINE("_CAL_LANG_EVENT_WEEKOPT", "Week(s) of a month repeat type week");

DEFINE("_CAL_LANG_SUBMITPREVIEW", "N�zet");
DEFINE("_CAL_LANG_SUBMITCANCEL", "Elvet");
DEFINE("_CAL_LANG_SUBMITSAVE", "Ment");

DEFINE("_CAL_LANG_E_WARNWEEKS", "Veuillez choisir une semaine.");
DEFINE("_CAL_LANG_E_WARNDAYS", "Veuillez choisir un jour.");

// Admin
DEFINE("_CAL_LANG_EVENT_ALLCAT", "Minden kateg�ria");
DEFINE("_CAL_LANG_EVENT_ACCESSLEVEL", "Jogosults�g szint");
DEFINE("_CAL_LANG_EVENT_HITS", "L�tt�k");
DEFINE("_CAL_LANG_EVENT_STATE", "�llapot");
DEFINE("_CAL_LANG_EVENT_CREATED", "K�sz�tve");
DEFINE("_CAL_LANG_EVENT_NEWEVENT", "�j esem�ny");
DEFINE("_CAL_LANG_EVENT_MODIFIED", "Utols� m�dos�t�s");
DEFINE("_CAL_LANG_EVENT_NOTMODIFIED", "Nem m�dosult");

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
	
?>
