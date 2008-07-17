<?php
/**
 * Events Component for Joomla 1.0.x
 *
 * @version     $Id: dutch.php 897 2007-11-17 15:32:11Z tstahl $
 * @package     Events
 * @copyright   Copyright (C) 2006 JEvents Project Group
 * @licence     http://www.gnu.org/copyleft/gpl.html
 * @link        http://joomlacode.org/gf/project/jevents
 */

defined("_VALID_MOS") or die("Direct Access to this location is not allowed");

//Check
DEFINE("_CAL_LANG_INCLUDED", 1);

// new 1.4.0 [mic]
define("_CAL_LANG_LNG",				"nl"); // de|fr|etc... [ DO NOT CHANGE THIS VALUE! ]

// used for colorpicker
define("_CAL_LANG_NO_COLOR",			"Geen kleur gekozen");
define("_CAL_LANG_COLOR_PICKER",		"Kleur Kiezer");

// common
define("_CAL_LANG_TIME",				"Time");
define("_CAL_LANG_CLICK_TO_OPEN_EVENT",	"Klik om te openen");
define("_CAL_LANG_UNPUBLISHED",		"** Unpublished **");
define("_CAL_LANG_DESCRIPTION",		"Description");
define("_CAL_LANG_EMAIL_TO_AUTHOR",	"Email to author");
define("_CAL_LANG_MAIL_TO_ADMIN",		"Evenement verstuurd van [ %s ] door [ %s ]");
define("_CAL_LANG_KEYWORD_NOT_VALID",	"Onjuist zoekwoord");
define("_CAL_LANG_EVENT_CALENDAR",		"Kalender"); // new 1.4

// modul
define("_CAL_LANG_ERR_NO_MOD_CAL",		"Events Calendar\n<br />This module needs the Events component");
define("_CAL_LANG_CLICK_TOSWITCH_DAY",	"Klik voor Dagoverzicht");
define("_CAL_LANG_CLICK_TOSWITCH_MON",	"Ga naar Kalender - Deze maand");
define("_CAL_LANG_CLICK_TOSWITCH_YEAR",	"Ga naar Kalender - Dit jaar");
define("_CAL_LANG_CLICK_TOSWITCH_PY",	"Ga naar Kalender - Vorig jaar");
define("_CAL_LANG_CLICK_TOSWITCH_PM",	"Ga naar Kalender - Vorige maand");
define("_CAL_LANG_CLICK_TOSWITCH_NM",	"Ga naar Kalender - Volgende maand");
define("_CAL_LANG_CLICK_TOSWITCH_NY",	"Ga naar Kalender - volgend jaar");

// navTableNext
define("_CAL_LANG_NAV_TN_FIRST_LIST",	"Eerste Lijst");
define("_CAL_LANG_NAV_TN_PREV_LIST",	"Vorige Lijst");
define("_CAL_LANG_NAV_TN_NEXT_LIST",	"Volgende Lijst");
define("_CAL_LANG_NAV_TN_LAST_LIST",	"Laatste Lijst");

// calendar monthly display
define("_CAL_LANG_FIRST_SINGLE_DAY_EVENT",		"Eendags festival");
define("_CAL_LANG_FIRST_DAY_OF_MULTIEVENT",	"Eerste dag");
define("_CAL_LANG_LAST_DAY_OF_MULTIEVENT",		"Laatste dag");
define("_CAL_LANG_MULTIDAY_EVENT",				"Meer dagen Festival");
/* ++++++ end mic +++++++++++++ */

// Months
DEFINE("_CAL_LANG_JANUARY", "jan");
DEFINE("_CAL_LANG_FEBRUARY", "feb");
DEFINE("_CAL_LANG_MARCH", "mar");
DEFINE("_CAL_LANG_APRIL", "apr");
DEFINE("_CAL_LANG_MAY", "mei");
DEFINE("_CAL_LANG_JUNE", "jun");
DEFINE("_CAL_LANG_JULY", "jul");
DEFINE("_CAL_LANG_AUGUST", "aug");
DEFINE("_CAL_LANG_SEPTEMBER", "sep");
DEFINE("_CAL_LANG_OCTOBER", "okt");
DEFINE("_CAL_LANG_NOVEMBER", "nov");
DEFINE("_CAL_LANG_DECEMBER", "dec");

// Short day names
DEFINE("_CAL_LANG_SUN", "Zo");
DEFINE("_CAL_LANG_MON", "Ma");
DEFINE("_CAL_LANG_TUE", "Di");
DEFINE("_CAL_LANG_WED", "Wo");
DEFINE("_CAL_LANG_THU", "Do");
DEFINE("_CAL_LANG_FRI", "Vr");
DEFINE("_CAL_LANG_SAT", "Za");

// Days
DEFINE("_CAL_LANG_SUNDAY", "zondag");
DEFINE("_CAL_LANG_MONDAY", "maandag");
DEFINE("_CAL_LANG_TUESDAY", "dinsdag");
DEFINE("_CAL_LANG_WEDNESDAY", "woensdag");
DEFINE("_CAL_LANG_THURSDAY", "donderdag");
DEFINE("_CAL_LANG_FRIDAY", "vrijdag");
DEFINE("_CAL_LANG_SATURDAY", "zaterdag");

// Days lettres
DEFINE("_CAL_LANG_SUNDAYSHORT", "Zo");
DEFINE("_CAL_LANG_MONDAYSHORT", "Ma");
DEFINE("_CAL_LANG_TUESDAYSHORT", "Di");
DEFINE("_CAL_LANG_WEDNESDAYSHORT", "Wo");
DEFINE("_CAL_LANG_THURSDAYSHORT", "Do");
DEFINE("_CAL_LANG_FRIDAYSHORT", "Vr");
DEFINE("_CAL_LANG_SATURDAYSHORT", "Za");

// Repeat type
DEFINE("_CAL_LANG_ALLDAYS", "Elke dag");
DEFINE("_CAL_LANG_EACHWEEK", "Elke week");
DEFINE("_CAL_LANG_EACHWEEKPAIR", "Elke even week");
DEFINE("_CAL_LANG_EACHWEEKIMPAIR", "Elke oneven week");
DEFINE("_CAL_LANG_EACHMONTH", "Elke maand");
DEFINE("_CAL_LANG_EACHYEAR", "Elk jaar");
DEFINE("_CAL_LANG_ONLYDAYS", "Alleen geselecteerde dagen");
DEFINE("_CAL_LANG_EACH", "elk");
DEFINE("_CAL_LANG_EACHOF","van iedere");
DEFINE("_CAL_LANG_ENDMONTH", "einde maand");

// Repeat days
DEFINE("_CAL_LANG_BYDAYNUMBER", "op de dag v/d opgegeven datum");

// User type
DEFINE("_CAL_LANG_ANONYME", "Anoniem");

// Post
//PAS D'ACCENTS DANS LES _ACT_
DEFINE("_CAL_LANG_ACT_ADDED", "Bedankt voor de inzending - Wij zullen hem beoordelen!"); //NO ACCENT !!
DEFINE("_CAL_LANG_ACT_MODIFIED", "Agendapunt gewijzigd!"); //NO ACCENT !!
DEFINE("_CAL_LANG_ACT_PUBLISHED", "Dit evenement is gepubliceerd");  //NEW 1.4
DEFINE("_CAL_LANG_ACT_DELETED", "Agendapunt verwijderd!"); //NO ACCENT !!
DEFINE("_CAL_LANG_NOPERMISSION", "U heeft geen toegang tot deze dienst!"); //NO ACCENT !!

DEFINE("_CAL_LANG_MAIL_ADDED", "Nieuwe inzending agendapunt ");
DEFINE("_CAL_LANG_MAIL_MODIFIED", "Wijziging van agendapunt");

// Presentation
DEFINE("_CAL_LANG_BY", "Door:");
DEFINE("_CAL_LANG_FROM", "van");
DEFINE("_CAL_LANG_TO", "tot");
DEFINE("_CAL_LANG_ARCHIVE", "archief");
DEFINE("_CAL_LANG_WEEK", "de week");
DEFINE("_CAL_LANG_NO_EVENTS", "Agenda is leeg");
DEFINE("_CAL_LANG_NO_EVENTFOR", "Agenda is leeg.");
DEFINE("_CAL_LANG_NO_EVENTFORTHE", "Agenda is leeg.");
DEFINE("_CAL_LANG_THIS_DAY", "deze dag");
DEFINE("_CAL_LANG_THIS_MONTH", "deze maand");
DEFINE("_CAL_LANG_LAST_MONTH", "Vorige maand");
DEFINE("_CAL_LANG_NEXT_MONTH", "Volgende maand");
DEFINE("_CAL_LANG_EVENTSFOR", "agenda voor");
DEFINE("_CAL_LANG_SEARCHRESULTS", "Uw zoekresultaat"); // new 1.4
DEFINE("_CAL_LANG_EVENTSFORTHE", "agenda voor");
DEFINE("_CAL_LANG_REP_DAY", "dag");
DEFINE("_CAL_LANG_REP_WEEK", "week");
DEFINE("_CAL_LANG_REP_WEEKPAIR", "even week");
DEFINE("_CAL_LANG_REP_WEEKIMPAIR", "oneven week");
DEFINE("_CAL_LANG_REP_MONTH", "maand");
DEFINE("_CAL_LANG_REP_YEAR", "jaar");
DEFINE("_CAL_LANG_REP_NOEVENTSELECTED", "Selecteer eerst een agendapunt");

// Navigation
DEFINE("_CAL_LANG_VIEWTODAY", "vandaag");
DEFINE("_CAL_LANG_VIEWTOCOME", "deze maand");
DEFINE("_CAL_LANG_VIEWBYDAY", "per dag");
DEFINE("_CAL_LANG_VIEWBYCAT", "per categorie");
DEFINE("_CAL_LANG_VIEWBYMONTH", "per maand");
DEFINE("_CAL_LANG_VIEWBYYEAR", "per jaar");
DEFINE("_CAL_LANG_VIEWBYWEEK", "per week");
DEFINE("_CAL_LANG_JUMPTO", "Kies een maand");  // New 1.4
DEFINE("_CAL_LANG_BACK", "Terug");
DEFINE("_CAL_LANG_CLOSE", "Sluiten");
DEFINE("_CAL_LANG_PREVIOUSDAY", "Vorige dag");
DEFINE("_CAL_LANG_PREVIOUSWEEK", "Vorige week");
DEFINE("_CAL_LANG_PREVIOUSMONTH", "Vorige maand");
DEFINE("_CAL_LANG_PREVIOUSYEAR", "Vorig jaar");
DEFINE("_CAL_LANG_NEXTDAY", "Volgende dag");
DEFINE("_CAL_LANG_NEXTWEEK", "Volgende week");
DEFINE("_CAL_LANG_NEXTMONTH", "Volgende maand");
DEFINE("_CAL_LANG_NEXTYEAR", "Volgend jaar");

DEFINE("_CAL_LANG_ADMINPANEL", "Beheer");
DEFINE("_CAL_LANG_ADDEVENT", "Evenement Toevoegen");
DEFINE("_CAL_LANG_MYEVENTS", "Mijn ingediende agendapunten");
DEFINE("_CAL_LANG_DELETE", "Verwijderen");
DEFINE("_CAL_LANG_MODIFY", "Wijzigen");

// Form
DEFINE("_CAL_LANG_HELP", "Help");

DEFINE("_CAL_LANG_CAL_TITLE", "Agenda");
DEFINE("_CAL_LANG_ADD_TITLE", "Toevoegen");
DEFINE("_CAL_LANG_MODIFY_TITLE", "Wijzigen");

DEFINE("_CAL_LANG_REPEAT_DISABLED", "XXXXEvent Repeating is only applicable if End Date is after Start Date.  Change End Date before configuring event repeat details."); // New for 1.4
DEFINE("_CAL_LANG_EVENT_TITLE", "Onderwerp");
DEFINE("_CAL_LANG_EVENT_COLOR", "Kleur");
DEFINE("_CAL_LANG_EVENT_CATCOLOR", "Gebruik Categoriekleur");
DEFINE("_CAL_LANG_EVENT_CATEGORY", "Categorie");
DEFINE("_CAL_LANG_EVENT_CHOOSE_CATEG", "Kies categorie");
DEFINE("_CAL_LANG_EVENT_ACTIVITY", "Activiteit");
DEFINE("_CAL_LANG_EVENT_URLMAIL_INFO", "Voor toevoegen van URL of email adres, gebruik <br><u>http://www.mijnsite.nl</u> of <u>mailto:adres@provider.nl</u>");
DEFINE("_CAL_LANG_EVENT_ADRESSE", "Locatie");
DEFINE("_CAL_LANG_EVENT_CONTACT", "Contactpersoon");
DEFINE("_CAL_LANG_EVENT_EXTRA", "Extra Info");
DEFINE("_CAL_LANG_EVENT_AUTHOR_ALIAS", "Door (alias)");
DEFINE("_CAL_LANG_EVENT_STARTDATE", "Begin datum");
DEFINE("_CAL_LANG_EVENT_ENDDATE", "Eind datum");
DEFINE("_CAL_LANG_EVENT_STARTHOURS", "Begin uur");
DEFINE("_CAL_LANG_EVENT_ENDHOURS", "Einde uur");
DEFINE("_CAL_LANG_EVENT_STARTTIME", "Begin uur");
DEFINE("_CAL_LANG_EVENT_ENDTIME", "Einde uur");
DEFINE("_CAL_LANG_PUB_INFO", "Informatie");
DEFINE("_CAL_LANG_EVENT_REPEATTYPE", "Type Herhaling");
DEFINE("_CAL_LANG_EVENT_REPEATDAY", "Herhaal dag");
DEFINE("_CAL_LANG_EVENT_CHOOSE_WEEKDAYS", "Dagen van de week");
DEFINE("_CAL_LANG_EVENT_PER", "per");
DEFINE("_CAL_LANG_EVENT_WEEKOPT", "Welke We(e)k(en) v/d maand herhalen?");

DEFINE("_CAL_LANG_SUBMITPREVIEW", "Voorbeeld");
DEFINE("_CAL_LANG_SUBMITCANCEL", "Annuleer");
DEFINE("_CAL_LANG_SUBMITSAVE", "Opslaan");

DEFINE("_CAL_LANG_E_WARNWEEKS", "Week kiezen aub");
DEFINE("_CAL_LANG_E_WARNDAYS", "Dag kiezen aub");

// Admin
DEFINE("_CAL_LANG_EVENT_ALLCAT", "Alle categorien");
DEFINE("_CAL_LANG_EVENT_ACCESSLEVEL", "Toegangsnivo");
DEFINE("_CAL_LANG_EVENT_HITS", "Hits");
DEFINE("_CAL_LANG_EVENT_STATE", "Status");
DEFINE("_CAL_LANG_EVENT_CREATED", "Aangemaakt");
DEFINE("_CAL_LANG_EVENT_NEWEVENT", "Nieuw");
DEFINE("_CAL_LANG_EVENT_MODIFIED", "Laatste wijziging");
DEFINE("_CAL_LANG_EVENT_NOTMODIFIED", "Geen wijziging");

// dmcd aug 22/04  new warning alert for no specified activity in event entry
DEFINE("_CAL_LANG_WARNACTIVITY", "Some sort of Activity\\ndescription must be entered.");

DEFINE("_CAL_LEGEND_ALL_CATEGORIES", "Alle Categorieen ...");  // new for 1.4
DEFINE("_CAL_LEGEND_ALL_CATEGORIES_DESC", "Laat alle evenementen zien van alle categorieen");  // new for 1.4

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
