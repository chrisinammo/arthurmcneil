<?php
/**
 * Events Component for Joomla 1.0.x
 *
 * @version     $Id: finnish.php 880 2007-10-31 19:16:08Z tstahl $
 * @package     Events
 * @copyright   Copyright (C) 2006-2007 JEvents Project Group
 * @licence     http://www.gnu.org/copyleft/gpl.html
 * @link        http://joomlacode.org/gf/project/jevents
 */

defined('_JEXEC') or die( 'Restricted access' );

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
DEFINE("_CAL_LANG_JANUARY", "Tammikuu");
DEFINE("_CAL_LANG_FEBRUARY", "Helmikuu");
DEFINE("_CAL_LANG_MARCH", "Maaliskuu");
DEFINE("_CAL_LANG_APRIL", "Huhtikuu");
DEFINE("_CAL_LANG_MAY", "Toukokuu");
DEFINE("_CAL_LANG_JUNE", "Kesäkuu");
DEFINE("_CAL_LANG_JULY", "Heinäkuu");
DEFINE("_CAL_LANG_AUGUST", "Elokuu");
DEFINE("_CAL_LANG_SEPTEMBER", "Syyskuu");
DEFINE("_CAL_LANG_OCTOBER", "Lokakuu");
DEFINE("_CAL_LANG_NOVEMBER", "Marraskuu");
DEFINE("_CAL_LANG_DECEMBER", "Joulukuu");

// Short day names
DEFINE("_CAL_LANG_SUN", "Su");
DEFINE("_CAL_LANG_MON", "Ma");
DEFINE("_CAL_LANG_TUE", "Ti");
DEFINE("_CAL_LANG_WED", "Ke");
DEFINE("_CAL_LANG_THU", "Loppuu");
DEFINE("_CAL_LANG_FRI", "Pe");
DEFINE("_CAL_LANG_SAT", "La");

// Days
DEFINE("_CAL_LANG_SUNDAY", "Sunnuntai");
DEFINE("_CAL_LANG_MONDAY", "Maanantai");
DEFINE("_CAL_LANG_TUESDAY", "Tiistai");
DEFINE("_CAL_LANG_WEDNESDAY", "Keskiviikko");
DEFINE("_CAL_LANG_THURSDAY", "Torstai");
DEFINE("_CAL_LANG_FRIDAY", "Perjantai");
DEFINE("_CAL_LANG_SATURDAY", "Lauantai");

// Days lettres
DEFINE("_CAL_LANG_SUNDAYSHORT", "L");
DEFINE("_CAL_LANG_MONDAYSHORT", "M");
DEFINE("_CAL_LANG_TUESDAYSHORT", "T");
DEFINE("_CAL_LANG_WEDNESDAYSHORT", "K");
DEFINE("_CAL_LANG_THURSDAYSHORT", "T");
DEFINE("_CAL_LANG_FRIDAYSHORT", "P");
DEFINE("_CAL_LANG_SATURDAYSHORT", "L");

// Repeat type
DEFINE("_CAL_LANG_ALLDAYS", "Yksittäinen tapahtuma");
DEFINE("_CAL_LANG_EACHWEEK", "Kerran viikossa");
DEFINE("_CAL_LANG_EACHWEEKPAIR", "Joka parillinen viikko");
DEFINE("_CAL_LANG_EACHWEEKIMPAIR", "Joka pariton viikko");
DEFINE("_CAL_LANG_EACHMONTH", "Joka kuukausi");
DEFINE("_CAL_LANG_EACHYEAR", "Joka vuosi");
DEFINE("_CAL_LANG_ONLYDAYS", "Vain valittuina päivinä");
DEFINE("_CAL_LANG_EACH", "Joka");
DEFINE("_CAL_LANG_EACHOF","jokainen");
DEFINE("_CAL_LANG_ENDMONTH", "kuukauden lopussa");

// Repeat days
DEFINE("_CAL_LANG_BYDAYNUMBER", "Päivän numeron mukaan");

// User type
DEFINE("_CAL_LANG_ANONYME", "Nimetön");

// Post
//PAS D'ACCENTS DANS LES _ACT_
DEFINE("_CAL_LANG_ACT_ADDED", "Kiitos viestistäsi - vahvistamme ehdotuksesi!"); //NO ACCENT !!
DEFINE("_CAL_LANG_ACT_MODIFIED", "Tapahtumaa on muokattu."); //NO ACCENT !!
DEFINE("_CAL_LANG_ACT_PUBLISHED", "XXXXThis event has been published.");  //NEW 1.4
DEFINE("_CAL_LANG_ACT_DELETED", "Tapahtuma on poistettu!"); //NO ACCENT !!
DEFINE("_CAL_LANG_NOPERMISSION", "Sinulla ei ole käyttöoikeuksia tälle sivustolle!"); //NO ACCENT !!

DEFINE("_CAL_LANG_MAIL_ADDED", "Uusi viesti lähtien");
DEFINE("_CAL_LANG_MAIL_MODIFIED", "Uusi muutos lähtien");

// Presentation
DEFINE("_CAL_LANG_BY", "Lisännyt");
DEFINE("_CAL_LANG_FROM", "Alkaa");
DEFINE("_CAL_LANG_TO", "Loppuu");
DEFINE("_CAL_LANG_ARCHIVE", "Arkistot");
DEFINE("_CAL_LANG_WEEK", "viikko");
DEFINE("_CAL_LANG_NO_EVENTS", "Ei tapahtumia");
DEFINE("_CAL_LANG_NO_EVENTFOR", "Ei tapahtumia ajanjaksolla");
DEFINE("_CAL_LANG_NO_EVENTFORTHE", "Ei tapahtumia");
DEFINE("_CAL_LANG_THIS_DAY", "tämä päivä");
DEFINE("_CAL_LANG_THIS_MONTH", "Tämä kuukausi");
DEFINE("_CAL_LANG_LAST_MONTH", "Edellinen kuukausi");
DEFINE("_CAL_LANG_NEXT_MONTH", "Seuraava kuukausi");
DEFINE("_CAL_LANG_EVENTSFOR", "Tapahtumat ajalla - ");
DEFINE("_CAL_LANG_SEARCHRESULTS", "XXXXSearch Results for keyword"); // new 1.4
DEFINE("_CAL_LANG_EVENTSFORTHE", "Tapahtumat ajalla - ");
DEFINE("_CAL_LANG_REP_DAY", "päivä");
DEFINE("_CAL_LANG_REP_WEEK", "viikko");
DEFINE("_CAL_LANG_REP_WEEKPAIR", "joka toinen viikko");
DEFINE("_CAL_LANG_REP_WEEKIMPAIR", "joka kolmas viikko");
DEFINE("_CAL_LANG_REP_MONTH", "kuukausi");
DEFINE("_CAL_LANG_REP_YEAR", "vuosi");
DEFINE("_CAL_LANG_REP_NOEVENTSELECTED", "Valitse tapahtuma");

// Navigation
DEFINE("_CAL_LANG_VIEWTODAY", "Tänään");
DEFINE("_CAL_LANG_VIEWTOCOME", "Tulossa tässä kuussa");
DEFINE("_CAL_LANG_VIEWBYDAY", "Päivänäkymä");
DEFINE("_CAL_LANG_VIEWBYCAT", "Katso kategorioittain");
DEFINE("_CAL_LANG_VIEWBYMONTH", "Kuukausinäkymä");
DEFINE("_CAL_LANG_VIEWBYYEAR", "Vuosinäkymä");
DEFINE("_CAL_LANG_VIEWBYWEEK", "Viikkonäkymä");
DEFINE("_CAL_LANG_JUMPTO", "XXXXJump to specific month");  // New 1.4
DEFINE("_CAL_LANG_BACK", "Takaisin");
DEFINE("_CAL_LANG_CLOSE", "Sulje");
DEFINE("_CAL_LANG_PREVIOUSDAY", "Edellinen päivä");
DEFINE("_CAL_LANG_PREVIOUSWEEK", "Edellinen viikko");
DEFINE("_CAL_LANG_PREVIOUSMONTH", "Edellinen kuukausi");
DEFINE("_CAL_LANG_PREVIOUSYEAR", "Edellinen vuosi");
DEFINE("_CAL_LANG_NEXTDAY", "Seuraava päivä");
DEFINE("_CAL_LANG_NEXTWEEK", "Seuraava viikko");
DEFINE("_CAL_LANG_NEXTMONTH", "Seuraava kuukausi");
DEFINE("_CAL_LANG_NEXTYEAR", "Seuraava vuosi");

DEFINE("_CAL_LANG_ADMINPANEL", "Ylläpito");
DEFINE("_CAL_LANG_ADDEVENT", "Lisää tapahtuma");
DEFINE("_CAL_LANG_MYEVENTS", "Omat tapahtumat");
DEFINE("_CAL_LANG_DELETE", "Poista");
DEFINE("_CAL_LANG_MODIFY", "Muokkaa");

// Form
DEFINE("_CAL_LANG_HELP", "Ohje");

DEFINE("_CAL_LANG_CAL_TITLE", "Tapahtumat");
DEFINE("_CAL_LANG_ADD_TITLE", "Lisää");
DEFINE("_CAL_LANG_MODIFY_TITLE", "Muokkaa");

DEFINE("_CAL_LANG_EVENT_TITLE", "Aihe");
DEFINE("_CAL_LANG_EVENT_COLOR", "Väri");
DEFINE("_CAL_LANG_EVENT_CATCOLOR", "Käytä kategorian väriä");
DEFINE("_CAL_LANG_EVENT_CATEGORY", "Kategoria");
DEFINE("_CAL_LANG_EVENT_CHOOSE_CATEG", "Valitse kategoria");
DEFINE("_CAL_LANG_EVENT_ACTIVITY", "Tapahtuman kuvaus");
DEFINE("_CAL_LANG_EVENT_URLMAIL_INFO", "Lisää  www- tai sähköpostiosoite kirjoittamallla esim. <u>http://www.yle.fi</u> tai <u>info@yle.fi</u>");
DEFINE("_CAL_LANG_EVENT_ADRESSE", "Sijainti");
DEFINE("_CAL_LANG_EVENT_CONTACT", "Yhteyshenkilö");
DEFINE("_CAL_LANG_EVENT_EXTRA", "Lisätietoa");
DEFINE("_CAL_LANG_EVENT_AUTHOR_ALIAS", "Kirjoittanut (alias)");
DEFINE("_CAL_LANG_EVENT_STARTDATE", "Aloituspäivä");
DEFINE("_CAL_LANG_EVENT_ENDDATE", "Lopetuspäivä");
DEFINE("_CAL_LANG_EVENT_STARTHOURS", "Aloitus (tunti)");
DEFINE("_CAL_LANG_EVENT_ENDHOURS", "Lopetus (tunti)");
DEFINE("_CAL_LANG_EVENT_STARTTIME", "Aloitusaika");
DEFINE("_CAL_LANG_EVENT_ENDTIME", "Lopetusaika");
DEFINE("_CAL_LANG_PUB_INFO", "Julkaisupäivä");
DEFINE("_CAL_LANG_EVENT_REPEATTYPE", "Toistotyyppi");
DEFINE("_CAL_LANG_EVENT_REPEATDAY", "Toistopäivä");
DEFINE("_CAL_LANG_EVENT_CHOOSE_WEEKDAYS", "Päiviä viikossa");
DEFINE("_CAL_LANG_EVENT_PER", "joka");
DEFINE("_CAL_LANG_EVENT_WEEKOPT", "Kuukauden viikko (viikot)");

DEFINE("_CAL_LANG_SUBMITPREVIEW", "Esikatsele");
DEFINE("_CAL_LANG_SUBMITCANCEL", "Peru");
DEFINE("_CAL_LANG_SUBMITSAVE", "Tallenna");

DEFINE("_CAL_LANG_E_WARNWEEKS", "Valitse viikko.");
DEFINE("_CAL_LANG_E_WARNDAYS", "Valitse päivä.");

// Admin
DEFINE("_CAL_LANG_EVENT_ALLCAT", "Kaikki kategoriat");
DEFINE("_CAL_LANG_EVENT_ACCESSLEVEL", "Käyttöoikeustaso");
DEFINE("_CAL_LANG_EVENT_HITS", "Osumia");
DEFINE("_CAL_LANG_EVENT_STATE", "Tila");
DEFINE("_CAL_LANG_EVENT_CREATED", "Luotu");
DEFINE("_CAL_LANG_EVENT_NEWEVENT", "Uusi tapahtuma");
DEFINE("_CAL_LANG_EVENT_MODIFIED", "Viimeksi muokattu");
DEFINE("_CAL_LANG_EVENT_NOTMODIFIED", "Ei muokattu");

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
