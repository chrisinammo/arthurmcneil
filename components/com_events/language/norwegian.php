<?php
/**
 * Events Component for Joomla 1.0.x
 *
 * @version     $Id: norwegian.php 880 2007-10-31 19:16:08Z tstahl $
 * @package     Events
 * @copyright   Copyright (C) 2006-2007 JEvents Project Group
 * @licence     http://www.gnu.org/copyleft/gpl.html
 * @link        http://joomlacode.org/gf/project/jevents
 */

defined( '_JEXEC' ) or die( 'Restricted access' );

//Check
DEFINE("_CAL_LANG_INCLUDED", 1);

// new 1.4.0 [mic]
define("_CAL_LANG_LNG",				"no"); // de|fr|etc... [ DO NOT CHANGE THIS VALUE! ]

// used for colorpicker
define("_CAL_LANG_NO_COLOR",			"Ingen farger");
define("_CAL_LANG_COLOR_PICKER",		"Farge velger");

// common
define("_CAL_LANG_TIME",				"Tid");
define("_CAL_LANG_CLICK_TO_OPEN_EVENT",	"Klikk for � �pne hendelse");
define("_CAL_LANG_UNPUBLISHED",		"** Ikke offentliggjort **");
define("_CAL_LANG_DESCRIPTION",		"Beskrivelse");
define("_CAL_LANG_EMAIL_TO_AUTHOR",	"Epost til forfatter");
define("_CAL_LANG_MAIL_TO_ADMIN",		"Hendelse avgitt fra [ %s ] by [ %s ]");
define("_CAL_LANG_KEYWORD_NOT_VALID",	"Ikke gyldig n�kkelord");
define("_CAL_LANG_EVENT_CALENDAR",		"Hendelses kalender"); // new 1.4

// modul
define("_CAL_LANG_ERR_NO_MOD_CAL",		"Events Calendar\n<br />Denne modulen trenger Events komponenten");
define("_CAL_LANG_CLICK_TOSWITCH_DAY",	"G� til kalender - aktuell dag");
define("_CAL_LANG_CLICK_TOSWITCH_MON",	"G� til kalender - aktuell m�ned");
define("_CAL_LANG_CLICK_TOSWITCH_YEAR",	"G� til kalender - aktuelt �r");
define("_CAL_LANG_CLICK_TOSWITCH_PY",	"G� til kalender - forrige �r");
define("_CAL_LANG_CLICK_TOSWITCH_PM",	"G� til kalender - forrige m�ned");
define("_CAL_LANG_CLICK_TOSWITCH_NM",	"G� til kalender - neste m�ned");
define("_CAL_LANG_CLICK_TOSWITCH_NY",	"G� til kalender - neste �r");

// navTableNext
define("_CAL_LANG_NAV_TN_FIRST_LIST",	"f�rste liste");
define("_CAL_LANG_NAV_TN_PREV_LIST",	"forrige liste");
define("_CAL_LANG_NAV_TN_NEXT_LIST",	"neste liste");
define("_CAL_LANG_NAV_TN_LAST_LIST",	"siste liste");

// calendar monthly display
define("_CAL_LANG_FIRST_SINGLE_DAY_EVENT",		"enkelt hendelse");
define("_CAL_LANG_FIRST_DAY_OF_MULTIEVENT",	"F�rste dag av en gjentagende hendelse");
define("_CAL_LANG_LAST_DAY_OF_MULTIEVENT",		"Siste dag av en gjentagende hendelse");
define("_CAL_LANG_MULTIDAY_EVENT",				"Flerdags hendelse");
/* ++++++ end mic +++++++++++++ */

// Months
DEFINE("_CAL_LANG_JANUARY", "Januar");
DEFINE("_CAL_LANG_FEBRUARY", "Februar");
DEFINE("_CAL_LANG_MARCH", "Mars");
DEFINE("_CAL_LANG_APRIL", "April");
DEFINE("_CAL_LANG_MAY", "Mai");
DEFINE("_CAL_LANG_JUNE", "Juni");
DEFINE("_CAL_LANG_JULY", "Juli");
DEFINE("_CAL_LANG_AUGUST", "August");
DEFINE("_CAL_LANG_SEPTEMBER", "September");
DEFINE("_CAL_LANG_OCTOBER", "Oktober");
DEFINE("_CAL_LANG_NOVEMBER", "November");
DEFINE("_CAL_LANG_DECEMBER", "Desember");

// Short day names
DEFINE("_CAL_LANG_SUN", "S�n");
DEFINE("_CAL_LANG_MON", "Man");
DEFINE("_CAL_LANG_TUE", "Tir");
DEFINE("_CAL_LANG_WED", "Ons");
DEFINE("_CAL_LANG_THU", "Tor");
DEFINE("_CAL_LANG_FRI", "Fre");
DEFINE("_CAL_LANG_SAT", "L�r");

// Days
DEFINE("_CAL_LANG_SUNDAY", "S�ndag");
DEFINE("_CAL_LANG_MONDAY", "Mandag");
DEFINE("_CAL_LANG_TUESDAY", "Tirsdag");
DEFINE("_CAL_LANG_WEDNESDAY", "Onsdag");
DEFINE("_CAL_LANG_THURSDAY", "Torsdag");
DEFINE("_CAL_LANG_FRIDAY", "Fredag");
DEFINE("_CAL_LANG_SATURDAY", "L�rdag");

// Days lettres
DEFINE("_CAL_LANG_SUNDAYSHORT", "S");
DEFINE("_CAL_LANG_MONDAYSHORT", "M");
DEFINE("_CAL_LANG_TUESDAYSHORT", "T");
DEFINE("_CAL_LANG_WEDNESDAYSHORT", "O");
DEFINE("_CAL_LANG_THURSDAYSHORT", "T");
DEFINE("_CAL_LANG_FRIDAYSHORT", "F");
DEFINE("_CAL_LANG_SATURDAYSHORT", "L");

// Repeat type
DEFINE("_CAL_LANG_ALLDAYS", "Hver dag");
DEFINE("_CAL_LANG_EACHWEEK", "Hver uke");
DEFINE("_CAL_LANG_EACHWEEKPAIR", "Hver partallsuke");
DEFINE("_CAL_LANG_EACHWEEKIMPAIR", "Hver oddetalsuke");
DEFINE("_CAL_LANG_EACHMONTH", "Hver m�ned");
DEFINE("_CAL_LANG_EACHYEAR", "Hvert �r");
DEFINE("_CAL_LANG_ONLYDAYS", "Bare valgte dager");
DEFINE("_CAL_LANG_EACH", "Hver");
DEFINE("_CAL_LANG_EACHOF","av hver");
DEFINE("_CAL_LANG_ENDMONTH", "slutten av m�neden");

// Repeat days
DEFINE("_CAL_LANG_BYDAYNUMBER", "Etter dagnummer");

// User type
DEFINE("_CAL_LANG_ANONYME", "Anonym");

// Post
//PAS D'ACCENTS DANS LES _ACT_
DEFINE("_CAL_LANG_ACT_ADDED", "Takk for ditt bidrag - vi vil kontrollere ditt forslag!"); //NO ACCENT !!
DEFINE("_CAL_LANG_ACT_MODIFIED", "Hendelsen har blitt redigert."); //NO ACCENT !!
DEFINE("_CAL_LANG_ACT_PUBLISHED", "Denne hendelsen har blitt publisert.");  //NEW 1.4
DEFINE("_CAL_LANG_ACT_DELETED", "Denne hendelsen har blitt slettet!"); //NO ACCENT !!
DEFINE("_CAL_LANG_NOPERMISSION", "Du har ikke adgang til denne tjenesten!"); //NO ACCENT !!

DEFINE("_CAL_LANG_MAIL_ADDED", "Nytt bidrag den");
DEFINE("_CAL_LANG_MAIL_MODIFIED", "Ny endring den");

// Presentation
DEFINE("_CAL_LANG_BY", "av");
DEFINE("_CAL_LANG_FROM", "Fra");
DEFINE("_CAL_LANG_TO", "Til");
DEFINE("_CAL_LANG_ARCHIVE", "Arkiv");
DEFINE("_CAL_LANG_WEEK", "uka");
DEFINE("_CAL_LANG_NO_EVENTS", "Ingen hendelser");
DEFINE("_CAL_LANG_NO_EVENTFOR", "Ingen hendelser for");
DEFINE("_CAL_LANG_NO_EVENTFORTHE", "Ingen hendelsen for den");
DEFINE("_CAL_LANG_THIS_DAY", "Denne dag");
DEFINE("_CAL_LANG_THIS_MONTH", "Denne m�ned");
DEFINE("_CAL_LANG_LAST_MONTH", "Forrige m�ned");
DEFINE("_CAL_LANG_NEXT_MONTH", "Neste m�ned");
DEFINE("_CAL_LANG_EVENTSFOR", "Hendelser for");
DEFINE("_CAL_LANG_SEARCHRESULTS", "S�ke resultater for n�kkelord"); // new 1.4
DEFINE("_CAL_LANG_EVENTSFORTHE", "Hendelser for den");
DEFINE("_CAL_LANG_REP_DAY", "dag");
DEFINE("_CAL_LANG_REP_WEEK", "uke");
DEFINE("_CAL_LANG_REP_WEEKPAIR", "partallsuke");
DEFINE("_CAL_LANG_REP_WEEKIMPAIR", "oddetallsuke");
DEFINE("_CAL_LANG_REP_MONTH", "m�ned");
DEFINE("_CAL_LANG_REP_YEAR", "�r");
DEFINE("_CAL_LANG_REP_NOEVENTSELECTED", "Please select an event first");

// Navigation
DEFINE("_CAL_LANG_VIEWTODAY", "Vis idag");
DEFINE("_CAL_LANG_VIEWTOCOME", "Kommende denne m�ned");
DEFINE("_CAL_LANG_VIEWBYDAY", "Vis etter dag");
DEFINE("_CAL_LANG_VIEWBYCAT", "Vis etter kategori");
DEFINE("_CAL_LANG_VIEWBYMONTH", "Vis etter m�ned");
DEFINE("_CAL_LANG_VIEWBYYEAR", "Vis etter �r");
DEFINE("_CAL_LANG_VIEWBYWEEK", "Vis etter uke");
DEFINE("_CAL_LANG_JUMPTO", "Hopp til spesifikk m�ned");  // New 1.4
DEFINE("_CAL_LANG_BACK", "Tilbake");
DEFINE("_CAL_LANG_CLOSE", "Close");
DEFINE("_CAL_LANG_PREVIOUSDAY", "Forrige dag");
DEFINE("_CAL_LANG_PREVIOUSWEEK", "Forrige uke");
DEFINE("_CAL_LANG_PREVIOUSMONTH", "Forrige m�ned");
DEFINE("_CAL_LANG_PREVIOUSYEAR", "Forrige �r");
DEFINE("_CAL_LANG_NEXTDAY", "Neste dag");
DEFINE("_CAL_LANG_NEXTWEEK", "Neste uke");
DEFINE("_CAL_LANG_NEXTMONTH", "Neste m�ned");
DEFINE("_CAL_LANG_NEXTYEAR", "Neste �r");

DEFINE("_CAL_LANG_ADMINPANEL", "Administrasjonspanel");
DEFINE("_CAL_LANG_ADDEVENT", "Legg til ny hendelse");
DEFINE("_CAL_LANG_MYEVENTS", "Mine hendelser");
DEFINE("_CAL_LANG_DELETE", "Slett");
DEFINE("_CAL_LANG_MODIFY", "Rediger");

// Form
DEFINE("_CAL_LANG_HELP", "Hjelp");

DEFINE("_CAL_LANG_CAL_TITLE", "Hendelser");
DEFINE("_CAL_LANG_ADD_TITLE", "Ny");
DEFINE("_CAL_LANG_MODIFY_TITLE", "Rediger");

DEFINE("_CAL_LANG_EVENT_TITLE", "Tittel");
DEFINE("_CAL_LANG_EVENT_COLOR", "Farge");
DEFINE("_CAL_LANG_EVENT_CATCOLOR", "Bruk kategorifarge");
DEFINE("_CAL_LANG_EVENT_CATEGORY", "Kategorier");
DEFINE("_CAL_LANG_EVENT_CHOOSE_CATEG", "Velg en kategori");
DEFINE("_CAL_LANG_EVENT_ACTIVITY", "Aktivitet");
DEFINE("_CAL_LANG_EVENT_URLMAIL_INFO", "For � legge til en URL eller en MAIL, s� bare skriv <u>http://www.mysite.com</u> eller <u>mailto:my@mail.com</u>");
DEFINE("_CAL_LANG_EVENT_ADRESSE", "Sted");
DEFINE("_CAL_LANG_EVENT_CONTACT", "Kontakt");
DEFINE("_CAL_LANG_EVENT_EXTRA", "Ekstra informasjon");
DEFINE("_CAL_LANG_EVENT_AUTHOR_ALIAS", "Forfatter (alias)");
DEFINE("_CAL_LANG_EVENT_STARTDATE", "Startdato");
DEFINE("_CAL_LANG_EVENT_ENDDATE", "Sluttdato");
DEFINE("_CAL_LANG_EVENT_STARTHOURS", "Starttid");
DEFINE("_CAL_LANG_EVENT_ENDHOURS", "Slutttid");
DEFINE("_CAL_LANG_EVENT_STARTTIME", "Starttid");
DEFINE("_CAL_LANG_EVENT_ENDTIME", "Slutttid");
DEFINE("_CAL_LANG_PUB_INFO", "Publiseringsinformasjon");
DEFINE("_CAL_LANG_EVENT_REPEATTYPE", "Gjentagelsestype");
DEFINE("_CAL_LANG_EVENT_REPEATDAY", "Gjenta dag");
DEFINE("_CAL_LANG_EVENT_CHOOSE_WEEKDAYS", "Dager i uken");
DEFINE("_CAL_LANG_EVENT_PER", "per");
DEFINE("_CAL_LANG_EVENT_WEEKOPT", "Uke(r) i en m�ned, gjenta uketype");

DEFINE("_CAL_LANG_SUBMITPREVIEW", "Forh�ndsvis");
DEFINE("_CAL_LANG_SUBMITCANCEL", "Avbryt");
DEFINE("_CAL_LANG_SUBMITSAVE", "Lagre");

DEFINE("_CAL_LANG_E_WARNWEEKS", "Velg en uke.");
DEFINE("_CAL_LANG_E_WARNDAYS", "Velg en dag.");

// Admin
DEFINE("_CAL_LANG_EVENT_ALLCAT", "Alle kategorier");
DEFINE("_CAL_LANG_EVENT_ACCESSLEVEL", "Adgangsniv�");
DEFINE("_CAL_LANG_EVENT_HITS", "Treff");
DEFINE("_CAL_LANG_EVENT_STATE", "Status");
DEFINE("_CAL_LANG_EVENT_CREATED", "Opprettet");
DEFINE("_CAL_LANG_EVENT_NEWEVENT", "Ny hendelse");
DEFINE("_CAL_LANG_EVENT_MODIFIED", "Sist endret");
DEFINE("_CAL_LANG_EVENT_NOTMODIFIED", "Ikke endret");

// dmcd aug 22/04  new warning alert for no specified activity in event entry
DEFINE("_CAL_LANG_WARNACTIVITY", "Some sort of Activity\\ndescription must be entered.");

DEFINE("_CAL_LEGEND_ALL_CATEGORIES", "Alle kategorier ...");  // new for 1.4
DEFINE("_CAL_LEGEND_ALL_CATEGORIES_DESC", "Vis hendelser fra alle kategorier");  // new for 1.4

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
