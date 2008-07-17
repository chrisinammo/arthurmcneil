<?php
/**
 * Events Component for Joomla 1.0.x
 *
 * @version     $Id: danish.php 1086 2008-05-08 14:26:18Z tstahl $
 * @package     Events
 * @copyright   Copyright (C) 2006 JEvents Project Group
 * @licence     http://www.gnu.org/copyleft/gpl.html
 * @link        http://joomlacode.org/gf/project/jevents
 */

defined("_VALID_MOS") or die("Direct Access to this location is not allowed");

//Check
DEFINE("_CAL_LANG_INCLUDED", 1);

// new 1.4.0 [mic]
define("_CAL_LANG_LNG",				"da"); // de|fr|etc... [ DO NOT CHANGE THIS VALUE! ]

// used for colorpicker
define("_CAL_LANG_NO_COLOR",			"Ingen farve");
define("_CAL_LANG_COLOR_PICKER",		"Farvepalette");

// common
define("_CAL_LANG_TIME",				"Tid");
define("_CAL_LANG_CLICK_TO_OPEN_EVENT",	"Klik for at åbne hændelse");
define("_CAL_LANG_UNPUBLISHED",		"** Ikke publiceret **");
define("_CAL_LANG_DESCRIPTION",		"Beskrivelse");
define("_CAL_LANG_EMAIL_TO_AUTHOR",	"Email til ansvarlig");
define("_CAL_LANG_MAIL_TO_ADMIN",		"Hændelse oprettet fra [ %s ] af [ %s ]");
define("_CAL_LANG_KEYWORD_NOT_VALID",	"Ukendt nøgleord");
define("_CAL_LANG_EVENT_CALENDAR",		"Kalender"); // new 1.4

// modul
define("_CAL_LANG_ERR_NO_MOD_CAL",		"Events Calendar\n<br />This module needs the Events component");
define("_CAL_LANG_CLICK_TOSWITCH_DAY",	"Kalender - i dag");
define("_CAL_LANG_CLICK_TOSWITCH_MON",	"Kalender - denne måned");
define("_CAL_LANG_CLICK_TOSWITCH_YEAR",	"Kalender - dette år");
define("_CAL_LANG_CLICK_TOSWITCH_PY",	"Kalender - sidste år");
define("_CAL_LANG_CLICK_TOSWITCH_PM",	"Kalender - sidste måned");
define("_CAL_LANG_CLICK_TOSWITCH_NM",	"Kalender - næste måned");
define("_CAL_LANG_CLICK_TOSWITCH_NY",	"Kalendar - næste år");

// navTableNext
define("_CAL_LANG_NAV_TN_FIRST_LIST",	"første oversigt");
define("_CAL_LANG_NAV_TN_PREV_LIST",	"forrige oversigt");
define("_CAL_LANG_NAV_TN_NEXT_LIST",	"næste oversigt");
define("_CAL_LANG_NAV_TN_LAST_LIST",	"sidste oversigt");

// calendar monthly display
define("_CAL_LANG_FIRST_SINGLE_DAY_EVENT",		"Endagshændelse");
define("_CAL_LANG_FIRST_DAY_OF_MULTIEVENT",	"Første dag i flerdagshændelse");
define("_CAL_LANG_LAST_DAY_OF_MULTIEVENT",		"Sidste dag i flerdagshændelse");
define("_CAL_LANG_MULTIDAY_EVENT",				"Flerdagshændelse");
/* ++++++ end mic +++++++++++++ */

// Months
DEFINE("_CAL_LANG_JANUARY", "Januar");
DEFINE("_CAL_LANG_FEBRUARY", "Februar");
DEFINE("_CAL_LANG_MARCH", "Marts");
DEFINE("_CAL_LANG_APRIL", "April");
DEFINE("_CAL_LANG_MAY", "Maj");
DEFINE("_CAL_LANG_JUNE", "Juni");
DEFINE("_CAL_LANG_JULY", "Juli");
DEFINE("_CAL_LANG_AUGUST", "August");
DEFINE("_CAL_LANG_SEPTEMBER", "September");
DEFINE("_CAL_LANG_OCTOBER", "Oktober");
DEFINE("_CAL_LANG_NOVEMBER", "November");
DEFINE("_CAL_LANG_DECEMBER", "December");

// Short day names
DEFINE("_CAL_LANG_SUN", "Søn");
DEFINE("_CAL_LANG_MON", "Man");
DEFINE("_CAL_LANG_TUE", "Tir");
DEFINE("_CAL_LANG_WED", "Ons");
DEFINE("_CAL_LANG_THU", "Tor");
DEFINE("_CAL_LANG_FRI", "Fre");
DEFINE("_CAL_LANG_SAT", "Lør");

// Days
DEFINE("_CAL_LANG_SUNDAY", "Søndag");
DEFINE("_CAL_LANG_MONDAY", "Mandag");
DEFINE("_CAL_LANG_TUESDAY", "Tirsdag");
DEFINE("_CAL_LANG_WEDNESDAY", "Onsdag");
DEFINE("_CAL_LANG_THURSDAY", "Torsdag");
DEFINE("_CAL_LANG_FRIDAY", "Fredag");
DEFINE("_CAL_LANG_SATURDAY", "Lørdag");

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
DEFINE("_CAL_LANG_EACHWEEK", "Hver uge");
DEFINE("_CAL_LANG_EACHWEEKPAIR", "Hver lige uge");
DEFINE("_CAL_LANG_EACHWEEKIMPAIR", "Hver ulige uge");
DEFINE("_CAL_LANG_EACHMONTH", "Hver måned");
DEFINE("_CAL_LANG_EACHYEAR", "Hvert år");
DEFINE("_CAL_LANG_ONLYDAYS", "Kun valgte dage");
DEFINE("_CAL_LANG_EACH", "Hver");
DEFINE("_CAL_LANG_EACHOF","af hver");
DEFINE("_CAL_LANG_ENDMONTH", "slutningen af måneden");

// Repeat days
DEFINE("_CAL_LANG_BYDAYNUMBER", "efter dag nummer");

// User type
DEFINE("_CAL_LANG_ANONYME", "Anononym");

// Post
//PAS D'ACCENTS DANS LES _ACT_
DEFINE("_CAL_LANG_ACT_ADDED", "Tak for dit bidrag - Vi vil overveje dit forslag!"); //NO ACCENT !!
DEFINE("_CAL_LANG_ACT_MODIFIED", "Hændelsen er blevet ændret."); //NO ACCENT !!
DEFINE("_CAL_LANG_ACT_PUBLISHED", "Denne hændelse er blevet publiceret.");  //NEW 1.4
DEFINE("_CAL_LANG_ACT_DELETED", "Hændelsen er blevet slettet!"); //NO ACCENT !!
DEFINE("_CAL_LANG_NOPERMISSION", "Du har ikke adgang til denne funktion !"); //NO ACCENT !!

DEFINE("_CAL_LANG_MAIL_ADDED", "Nyt bidrag fra");
DEFINE("_CAL_LANG_MAIL_MODIFIED", "Ny ændring fra");

// Presentation
DEFINE("_CAL_LANG_BY", "af");
DEFINE("_CAL_LANG_FROM", "Fra");
DEFINE("_CAL_LANG_TO", "Til");
DEFINE("_CAL_LANG_ARCHIVE", "Arkiv");
DEFINE("_CAL_LANG_WEEK", "ugen");
DEFINE("_CAL_LANG_NO_EVENTS", "Ingen hændelser");
DEFINE("_CAL_LANG_NO_EVENTFOR", "Ingen hændelser for");
DEFINE("_CAL_LANG_NO_EVENTFORTHE", "Ingen hændelser for");
DEFINE("_CAL_LANG_THIS_DAY", "Denne dag");
DEFINE("_CAL_LANG_THIS_MONTH", "Denne måned");
DEFINE("_CAL_LANG_LAST_MONTH", "Sidste måned");
DEFINE("_CAL_LANG_NEXT_MONTH", "Næste måned");
DEFINE("_CAL_LANG_EVENTSFOR", "Hændelser for");
DEFINE("_CAL_LANG_SEARCHRESULTS", "Søgeresultat for nøgleord"); // new 1.4
DEFINE("_CAL_LANG_EVENTSFORTHE", "Hændelser for");
DEFINE("_CAL_LANG_REP_DAY", "dag");
DEFINE("_CAL_LANG_REP_WEEK", "uge");
DEFINE("_CAL_LANG_REP_WEEKPAIR", "hver anden uge");
DEFINE("_CAL_LANG_REP_WEEKIMPAIR", "hver tredje uge");
DEFINE("_CAL_LANG_REP_MONTH", "måned");
DEFINE("_CAL_LANG_REP_YEAR", "år");
DEFINE("_CAL_LANG_REP_NOEVENTSELECTED", "Vælg først en hændelse");

// Navigation
DEFINE("_CAL_LANG_VIEWTODAY", "Vis i dag");
DEFINE("_CAL_LANG_VIEWTOCOME", "Kommende i denne måned");
DEFINE("_CAL_LANG_VIEWBYDAY", "Vis efter dag");
DEFINE("_CAL_LANG_VIEWBYCAT", "Vis efter kategori");
DEFINE("_CAL_LANG_VIEWBYMONTH", "Vis efter måned");
DEFINE("_CAL_LANG_VIEWBYYEAR", "Vis efter år");
DEFINE("_CAL_LANG_VIEWBYWEEK", "Vis efter uge");
DEFINE("_CAL_LANG_JUMPTO", "Gå til måned");  // New 1.4
DEFINE("_CAL_LANG_BACK", "Tilbage");
DEFINE("_CAL_LANG_CLOSE", "Afslut");
DEFINE("_CAL_LANG_PREVIOUSDAY", "Foregående dag");
DEFINE("_CAL_LANG_PREVIOUSWEEK", "Foregående uge");
DEFINE("_CAL_LANG_PREVIOUSMONTH", "Foregående måned");
DEFINE("_CAL_LANG_PREVIOUSYEAR", "Foregående år");
DEFINE("_CAL_LANG_NEXTDAY", "Næste dag");
DEFINE("_CAL_LANG_NEXTWEEK", "Næste uge");
DEFINE("_CAL_LANG_NEXTMONTH", "Næste måned");
DEFINE("_CAL_LANG_NEXTYEAR", "Næste år");

DEFINE("_CAL_LANG_ADMINPANEL", "Admin panel");
DEFINE("_CAL_LANG_ADDEVENT", "Tilføj en hændelse");
DEFINE("_CAL_LANG_MYEVENTS", "Mine hændelser");
DEFINE("_CAL_LANG_DELETE", "Slet");
DEFINE("_CAL_LANG_MODIFY", "Rediger");

// Form
DEFINE("_CAL_LANG_HELP", "Hjælp");

DEFINE("_CAL_LANG_CAL_TITLE", "Hændelser");
DEFINE("_CAL_LANG_ADD_TITLE", "Tilføj");
DEFINE("_CAL_LANG_MODIFY_TITLE", "Rediger");

DEFINE("_CAL_LANG_REPEAT_DISABLED", "For gentaget hændelse skal slutdato være efter startdato. Slutdatoen skal ændres før gentagelsesdetaljerne kan konfigureres."); // New for 1.4
DEFINE("_CAL_LANG_EVENT_TITLE", "Emne");
DEFINE("_CAL_LANG_EVENT_COLOR", "Farve");
DEFINE("_CAL_LANG_EVENT_CATCOLOR", "Anvend kategori farve");
DEFINE("_CAL_LANG_EVENT_CATEGORY", "Kategorier");
DEFINE("_CAL_LANG_EVENT_CHOOSE_CATEG", "Vælg en kategori");
DEFINE("_CAL_LANG_EVENT_ACTIVITY", "Aktivitet");
DEFINE("_CAL_LANG_EVENT_URLMAIL_INFO", "For at tilføje en URL eller e-mail adresse, skriv blot <br><u>http://www.mysite.com</u> eller <u>mailto:my@mail.com</u>");
DEFINE("_CAL_LANG_EVENT_ADRESSE", "Sted");
DEFINE("_CAL_LANG_EVENT_CONTACT", "Kontakt");
DEFINE("_CAL_LANG_EVENT_EXTRA", "Yderligere Info");
DEFINE("_CAL_LANG_EVENT_AUTHOR_ALIAS", "Forfatter (alias)");
DEFINE("_CAL_LANG_EVENT_STARTDATE", "Start dato");
DEFINE("_CAL_LANG_EVENT_ENDDATE", "Slut dato");
DEFINE("_CAL_LANG_EVENT_STARTHOURS", "Start time");
DEFINE("_CAL_LANG_EVENT_ENDHOURS", "Slut time");
DEFINE("_CAL_LANG_EVENT_STARTTIME", "Start tidspunkt");
DEFINE("_CAL_LANG_EVENT_ENDTIME", "Slut tidspunkt");
DEFINE("_CAL_LANG_PUB_INFO", "Publikationsdato");
DEFINE("_CAL_LANG_EVENT_REPEATTYPE", "Gentagelsestype");
DEFINE("_CAL_LANG_EVENT_REPEATDAY", "Gentag dag");
DEFINE("_CAL_LANG_EVENT_CHOOSE_WEEKDAYS", "Dage i ugen");
DEFINE("_CAL_LANG_EVENT_PER", "pr.");
DEFINE("_CAL_LANG_EVENT_WEEKOPT", "Uge(r) i en måned gentag ugetype");

DEFINE("_CAL_LANG_SUBMITPREVIEW", "Forhåndsvis");
DEFINE("_CAL_LANG_SUBMITCANCEL", "Afbryd");
DEFINE("_CAL_LANG_SUBMITSAVE", "Gem");

DEFINE("_CAL_LANG_E_WARNWEEKS", "Vælg en uge.");
DEFINE("_CAL_LANG_E_WARNDAYS", "Vælg en dag.");

// Admin
DEFINE("_CAL_LANG_EVENT_ALLCAT", "Alle kategorier");
DEFINE("_CAL_LANG_EVENT_ACCESSLEVEL", "Adgangs niveau");
DEFINE("_CAL_LANG_EVENT_HITS", "Hits");
DEFINE("_CAL_LANG_EVENT_STATE", "Status");
DEFINE("_CAL_LANG_EVENT_CREATED", "Oprettet");
DEFINE("_CAL_LANG_EVENT_NEWEVENT", "Ny hændelse");
DEFINE("_CAL_LANG_EVENT_MODIFIED", "Sidst ændret");
DEFINE("_CAL_LANG_EVENT_NOTMODIFIED", "Uændret");

// dmcd aug 22/04  new warning alert for no specified activity in event entry
DEFINE("_CAL_LANG_WARNACTIVITY", "Some sort of Activity\\ndescription must be entered.");

DEFINE("_CAL_LEGEND_ALL_CATEGORIES", "Alle kategorier ...");  // new for 1.4
DEFINE("_CAL_LEGEND_ALL_CATEGORIES_DESC", "Vis hændelser fra alle kategorier");  // new for 1.4

DEFINE("_CAL_LANG_FORM_HELP_COLOR", <<<END
        <tr>
		  <td width="110" align="left" valign="top">
            <b>Farve</b>
          </td>
          <td>Vælg baggrundsfarven for månedsvisningen.  Hvis Kategori checkbox&apos;en er valgt
		  vil farven være kategoriens standardfarve (defineret af site administratoren) som valgt under Indholds tab&apos;en for hændelsen og &apos;Farvepalette&apos; knappen vil være deaktiveret.</td>
        </tr>
END
);

DEFINE("_CAL_LANG_FORM_HELP",  <<<END
    	<tr>
          <td align="left"><b>Dato</b></td>
          <td>Vælg Start- og Slutdato for din hændelse.</td>
        </tr>
    	<tr>
          <td align="left" valign="top"><b>Tid</b></td>
          <td>Vælg tidspunktet for din hændelse. Formatet er <span style='color:blue;font-weight:bold;'>tt:mm {am|pm}</span>.<br/>Tidspunktet kan skrives i både 12 og 24 timers format.<br/><br/><b>Note</b>: For enkeltdagshændelser der krydser midnat, f.eks. fra 19:00 til 03:00, skal start- og slutdato være den samme, specifikt datoen før midnat.</td>
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
