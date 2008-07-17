<?php
/**
 * Events Component for Joomla 1.0.x
 *
 * @version     $Id: swedish.php 897 2007-11-17 15:32:11Z tstahl $
 * @package     Events
 * @copyright   Copyright (C) 2006 JEvents Project Group
 * @licence     http://www.gnu.org/copyleft/gpl.html
 * @link        http://joomlacode.org/gf/project/jevents
 */

defined("_VALID_MOS") or die("Direct Access to this location is not allowed");

//Check
DEFINE("_CAL_LANG_INCLUDED", 1);

// new 1.4.0 [mic]
define("_CAL_LANG_LNG",				"sv"); // de|fr|etc... [ DO NOT CHANGE THIS VALUE! ]

// used for colorpicker
define("_CAL_LANG_NO_COLOR",			"Ingen färg");
define("_CAL_LANG_COLOR_PICKER",		"Välj färg");

// common
define("_CAL_LANG_TIME",				"Tid");
define("_CAL_LANG_CLICK_TO_OPEN_EVENT",	"Klicka för att öppna händelsen");
define("_CAL_LANG_UNPUBLISHED",		"** Opublicerad**");
define("_CAL_LANG_DESCRIPTION",		"Beskrivning");
define("_CAL_LANG_EMAIL_TO_AUTHOR",	"Maila författaren");
define("_CAL_LANG_MAIL_TO_ADMIN",		"Händelse från [ %s ] av [ %s ]");
define("_CAL_LANG_KEYWORD_NOT_VALID",	"Inget giltigt sökord");
define("_CAL_LANG_EVENT_CALENDAR",		"Händelse Kalender"); // new 1.4

// modul
define("_CAL_LANG_ERR_NO_MOD_CAL",		"Events Calendar\n<br />This module needs the Events component");
define("_CAL_LANG_CLICK_TOSWITCH_DAY",	"Gå till vald dag");
define("_CAL_LANG_CLICK_TOSWITCH_MON",	"Gå till vald månad");
define("_CAL_LANG_CLICK_TOSWITCH_YEAR",	"Gå till valt år");
define("_CAL_LANG_CLICK_TOSWITCH_PY",	"Gå till föregående år");
define("_CAL_LANG_CLICK_TOSWITCH_PM",	"Gå till föregående månad");
define("_CAL_LANG_CLICK_TOSWITCH_NM",	"Gå till nästa månad");
define("_CAL_LANG_CLICK_TOSWITCH_NY",	"Gå till nästa år");

// navTableNext
define("_CAL_LANG_NAV_TN_FIRST_LIST",	"Första listan");
define("_CAL_LANG_NAV_TN_PREV_LIST",	"Föregående lista");
define("_CAL_LANG_NAV_TN_NEXT_LIST",	"Nästa lista");
define("_CAL_LANG_NAV_TN_LAST_LIST",	"Sista listan");

// calendar monthly display
define("_CAL_LANG_FIRST_SINGLE_DAY_EVENT",		"Ensam händelse");
define("_CAL_LANG_FIRST_DAY_OF_MULTIEVENT",	"Första dagen av en flerdagars händelse");
define("_CAL_LANG_LAST_DAY_OF_MULTIEVENT",		"Sista dagen av en flerdagars händelse");
define("_CAL_LANG_MULTIDAY_EVENT",				"Flerdagars händelse");
/* ++++++ end mic +++++++++++++ */

// Months
DEFINE("_CAL_LANG_JANUARY", "Januari");
DEFINE("_CAL_LANG_FEBRUARY", "Februari");
DEFINE("_CAL_LANG_MARCH", "Mars");
DEFINE("_CAL_LANG_APRIL", "April");
DEFINE("_CAL_LANG_MAY", "Maj");
DEFINE("_CAL_LANG_JUNE", "Juni");
DEFINE("_CAL_LANG_JULY", "Juli");
DEFINE("_CAL_LANG_AUGUST", "Augusti");
DEFINE("_CAL_LANG_SEPTEMBER", "September");
DEFINE("_CAL_LANG_OCTOBER", "Oktober");
DEFINE("_CAL_LANG_NOVEMBER", "November");
DEFINE("_CAL_LANG_DECEMBER", "December");

// Short day names
DEFINE("_CAL_LANG_SUN", "Sön");
DEFINE("_CAL_LANG_MON", "Mån");
DEFINE("_CAL_LANG_TUE", "Tis");
DEFINE("_CAL_LANG_WED", "Ons");
DEFINE("_CAL_LANG_THU", "Tor");
DEFINE("_CAL_LANG_FRI", "Fre");
DEFINE("_CAL_LANG_SAT", "Lör");

// Days
DEFINE("_CAL_LANG_SUNDAY", "Söndag");
DEFINE("_CAL_LANG_MONDAY", "Måndag");
DEFINE("_CAL_LANG_TUESDAY", "Tisdag");
DEFINE("_CAL_LANG_WEDNESDAY", "Onsdag");
DEFINE("_CAL_LANG_THURSDAY", "Torsdag");
DEFINE("_CAL_LANG_FRIDAY", "Fredag");
DEFINE("_CAL_LANG_SATURDAY", "Lördag");

// Days lettres
DEFINE("_CAL_LANG_SUNDAYSHORT", "S");
DEFINE("_CAL_LANG_MONDAYSHORT", "M");
DEFINE("_CAL_LANG_TUESDAYSHORT", "T");
DEFINE("_CAL_LANG_WEDNESDAYSHORT", "O");
DEFINE("_CAL_LANG_THURSDAYSHORT", "T");
DEFINE("_CAL_LANG_FRIDAYSHORT", "F");
DEFINE("_CAL_LANG_SATURDAYSHORT", "L");

// Repeat type
DEFINE("_CAL_LANG_ALLDAYS", "Varje dag");
DEFINE("_CAL_LANG_EACHWEEK", "Varje vecka");
DEFINE("_CAL_LANG_EACHWEEKPAIR", "Alla jämna veckor");
DEFINE("_CAL_LANG_EACHWEEKIMPAIR", "Alla udda veckor");
DEFINE("_CAL_LANG_EACHMONTH", "Varje månad");
DEFINE("_CAL_LANG_EACHYEAR", "Varje år");
DEFINE("_CAL_LANG_ONLYDAYS", "Endast utvalda dagar");
DEFINE("_CAL_LANG_EACH", "varje");
DEFINE("_CAL_LANG_EACHOF","i varje");
DEFINE("_CAL_LANG_ENDMONTH", "sista dag i månaden");

// Repeat days
DEFINE("_CAL_LANG_BYDAYNUMBER", "På datumet");

// User type
DEFINE("_CAL_LANG_ANONYME", "Anonym");

// Post
//PAS D'ACCENTS DANS LES _ACT_
DEFINE("_CAL_LANG_ACT_ADDED", "Tack för ditt bidrag - Vi kommer kontrollera dina uppgifter!"); //NO ACCENT !!
DEFINE("_CAL_LANG_ACT_MODIFIED", "Denna händelse är nu ändrad."); //NO ACCENT !!
DEFINE("_CAL_LANG_ACT_PUBLISHED", "Denna händelse har blivit publicerad.");  //NEW 1.4
DEFINE("_CAL_LANG_ACT_DELETED", "Denna händelse är nu raderad!"); //NO ACCENT !!
DEFINE("_CAL_LANG_NOPERMISSION", "Du har inte tillgång till denna funktion!"); //NO ACCENT !!

DEFINE("_CAL_LANG_MAIL_ADDED", "Nytt bidrag på");
DEFINE("_CAL_LANG_MAIL_MODIFIED", "Ny förändring på");

// Presentation
DEFINE("_CAL_LANG_BY", "registerat av");
DEFINE("_CAL_LANG_FROM", "Från");
DEFINE("_CAL_LANG_TO", "Till");
DEFINE("_CAL_LANG_ARCHIVE", "Arkivet");
DEFINE("_CAL_LANG_WEEK", "veckan");
DEFINE("_CAL_LANG_NO_EVENTS", "Inga händelser");
DEFINE("_CAL_LANG_NO_EVENTFOR", "Inga händelser");
DEFINE("_CAL_LANG_NO_EVENTFORTHE", "Inga händelser den");
DEFINE("_CAL_LANG_THIS_DAY", "Vad händer idag?");
DEFINE("_CAL_LANG_THIS_MONTH", "Vad händer denna månad?");
DEFINE("_CAL_LANG_LAST_MONTH", "Föregående månad");
DEFINE("_CAL_LANG_NEXT_MONTH", "Nästa månad");
DEFINE("_CAL_LANG_EVENTSFOR", "Händelser");
DEFINE("_CAL_LANG_SEARCHRESULTS", "Resultat för sökord"); // new 1.4
DEFINE("_CAL_LANG_EVENTSFORTHE", "Händelser");
DEFINE("_CAL_LANG_REP_DAY", "dag");
DEFINE("_CAL_LANG_REP_WEEK", "vecka");
DEFINE("_CAL_LANG_REP_WEEKPAIR", "jämn vecka");
DEFINE("_CAL_LANG_REP_WEEKIMPAIR", "udda vecka");
DEFINE("_CAL_LANG_REP_MONTH", "månad");
DEFINE("_CAL_LANG_REP_YEAR", "år");
DEFINE("_CAL_LANG_REP_NOEVENTSELECTED", "Vänligen välj en händelse först");

// Navigation
DEFINE("_CAL_LANG_VIEWTODAY", "Dagens händelser");
DEFINE("_CAL_LANG_VIEWTOCOME", "Månadens händelser");
DEFINE("_CAL_LANG_VIEWBYDAY", "Urval per dag");
DEFINE("_CAL_LANG_VIEWBYCAT", "Urval per kategori");
DEFINE("_CAL_LANG_VIEWBYMONTH", "Urval per månad");
DEFINE("_CAL_LANG_VIEWBYYEAR", "Urval per år");
DEFINE("_CAL_LANG_VIEWBYWEEK", "Urval per vecka");
DEFINE("_CAL_LANG_JUMPTO", "Hoppas till vald månad");  // New 1.4
DEFINE("_CAL_LANG_BACK", "Tillbaka");
DEFINE("_CAL_LANG_CLOSE", "Stäng");
DEFINE("_CAL_LANG_PREVIOUSDAY", "Föregående dag");
DEFINE("_CAL_LANG_PREVIOUSWEEK", "Föregående vecka");
DEFINE("_CAL_LANG_PREVIOUSMONTH", "Föregående månad");
DEFINE("_CAL_LANG_PREVIOUSYEAR", "Föregående år");
DEFINE("_CAL_LANG_NEXTDAY", "Nästa dag");
DEFINE("_CAL_LANG_NEXTWEEK", "Nästa vecka");
DEFINE("_CAL_LANG_NEXTMONTH", "Nästa månad");
DEFINE("_CAL_LANG_NEXTYEAR", "Nästa år");

DEFINE("_CAL_LANG_ADMINPANEL", "Administrationspanel");
DEFINE("_CAL_LANG_ADDEVENT", "Lägg till händelse");
DEFINE("_CAL_LANG_MYEVENTS", "Min kalender");
DEFINE("_CAL_LANG_DELETE", "Ta bort");
DEFINE("_CAL_LANG_MODIFY", "Ändra");

// Form
DEFINE("_CAL_LANG_HELP", "Hjälp");

DEFINE("_CAL_LANG_CAL_TITLE", "Kalendarium");
DEFINE("_CAL_LANG_ADD_TITLE", "Lägg till");
DEFINE("_CAL_LANG_MODIFY_TITLE", "Ändra");

DEFINE("_CAL_LANG_REPEAT_DISABLED", "XXXXEvent Repeating is only applicable if End Date is after Start Date.  Change End Date before configuring event repeat details."); // New for 1.4
DEFINE("_CAL_LANG_EVENT_TITLE", "Rubrik");
DEFINE("_CAL_LANG_EVENT_COLOR", "Färg");
DEFINE("_CAL_LANG_EVENT_CATCOLOR", "Använd kategorins färg");
DEFINE("_CAL_LANG_EVENT_CATEGORY", "Kategorier");
DEFINE("_CAL_LANG_EVENT_CHOOSE_CATEG", "Välj kategori");
DEFINE("_CAL_LANG_EVENT_ACTIVITY", "Händelser");
DEFINE("_CAL_LANG_EVENT_URLMAIL_INFO", "För att lägga till en URL eller en epostadress, skriv <br><u>http://www.mysite.com</u> eller <u>mailto:my@mail.com</u>");
DEFINE("_CAL_LANG_EVENT_ADRESSE", "Plats");
DEFINE("_CAL_LANG_EVENT_CONTACT", "Kontakta");
DEFINE("_CAL_LANG_EVENT_EXTRA", "Extra information");
DEFINE("_CAL_LANG_EVENT_AUTHOR_ALIAS", "Författare (alias)");
DEFINE("_CAL_LANG_EVENT_STARTDATE", "Startdatum");
DEFINE("_CAL_LANG_EVENT_ENDDATE", "Slutdatum");
DEFINE("_CAL_LANG_EVENT_STARTHOURS", "Starttid");
DEFINE("_CAL_LANG_EVENT_ENDHOURS", "Sluttid");
DEFINE("_CAL_LANG_EVENT_STARTTIME", "Start Time");
DEFINE("_CAL_LANG_EVENT_ENDTIME", "End Time");
DEFINE("_CAL_LANG_PUB_INFO", "Publiceringsinformation");
DEFINE("_CAL_LANG_EVENT_REPEATTYPE", "Repetitionstyp");
DEFINE("_CAL_LANG_EVENT_REPEATDAY", "Repetera dag");
DEFINE("_CAL_LANG_EVENT_CHOOSE_WEEKDAYS", "Veckodagar");
DEFINE("_CAL_LANG_EVENT_PER", "per");
DEFINE("_CAL_LANG_EVENT_WEEKOPT", "Veckor i en månad för repetition varje vecka");

DEFINE("_CAL_LANG_SUBMITPREVIEW", "Förhandsgranska");
DEFINE("_CAL_LANG_SUBMITCANCEL", "Avbryt");
DEFINE("_CAL_LANG_SUBMITSAVE", "Spara");

DEFINE("_CAL_LANG_E_WARNWEEKS", "Var vänlig och välj en vecka.");
DEFINE("_CAL_LANG_E_WARNDAYS", "Var vänlig och välj en dag.");

// Admin
DEFINE("_CAL_LANG_EVENT_ALLCAT", "Alla kategorier");
DEFINE("_CAL_LANG_EVENT_ACCESSLEVEL", "Accessnivå");
DEFINE("_CAL_LANG_EVENT_HITS", "Besök");
DEFINE("_CAL_LANG_EVENT_STATE", "Tillstånd");
DEFINE("_CAL_LANG_EVENT_CREATED", "Skapad");
DEFINE("_CAL_LANG_EVENT_NEWEVENT", "Ny händelse");
DEFINE("_CAL_LANG_EVENT_MODIFIED", "Senast ändrad");
DEFINE("_CAL_LANG_EVENT_NOTMODIFIED", "Aldrig ändrad");

// dmcd aug 22/04  new warning alert for no specified activity in event entry
DEFINE("_CAL_LANG_WARNACTIVITY", "Some sort of Activity\\ndescription must be entered.");

DEFINE("_CAL_LEGEND_ALL_CATEGORIES", "Alla kategorier ...");  // new for 1.4
DEFINE("_CAL_LEGEND_ALL_CATEGORIES_DESC", "Visa händelser för alla kategorier");  // new for 1.4

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
