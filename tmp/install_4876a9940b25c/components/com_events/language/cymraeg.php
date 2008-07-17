<?php
/**
 * Events Component for Joomla 1.0.x
 *
 * @version     $Id: cymraeg.php 897 2007-11-17 15:32:11Z tstahl $
 * @package     Events
 * @copyright   Copyright (C) 2006 JEvents Project Group
 * @licence     http://www.gnu.org/copyleft/gpl.html
 * @link        http://joomlacode.org/gf/project/jevents
 */

defined("_VALID_MOS") or die("Direct Access to this location is not allowed");

//Check
DEFINE("_CAL_LANG_INCLUDED", 1);

// new 1.4.0 [mic]
define("_CAL_LANG_LNG",				"cym"); // de|fr|etc... [ DO NOT CHANGE THIS VALUE! ]
define("_CAL_LANG_REPEAT_GRAMMAR",	"1"); // in repeat summary 1 = follow English word orde, 2= follow German word orderr

// used for colorpicker
define("_CAL_LANG_NO_COLOR",			"Dim Lliw");
define("_CAL_LANG_COLOR_PICKER",		"Dewisiwr Liw");

// common
define("_CAL_LANG_TIME",				"Amser");
define("_CAL_LANG_CLICK_TO_OPEN_EVENT",	"Clicio i agor digwyddiad");
define("_CAL_LANG_UNPUBLISHED",		"** Heb ei gyhoeddi **");
define("_CAL_LANG_DESCRIPTION",		"Discrifiad");
define("_CAL_LANG_EMAIL_TO_AUTHOR",	"Ebost i'r awdur");
define("_CAL_LANG_MAIL_TO_ADMIN",		"Event submited from [ %s ] by [ %s ]");
define("_CAL_LANG_KEYWORD_NOT_VALID",	"Not a valid keyword");
define("_CAL_LANG_EVENT_CALENDAR",		"Calendar Digwyddiadau"); // new 1.4

// modul
define("_CAL_LANG_ERR_NO_MOD_CAL",		"Events Calendar\n<br />This module needs the Events component");
define("_CAL_LANG_CLICK_TOSWITCH_DAY",	"Go to calendar - current day");
define("_CAL_LANG_CLICK_TOSWITCH_MON",	"Go to calendar - current month");
define("_CAL_LANG_CLICK_TOSWITCH_YEAR",	"Go to calendar - current year");
define("_CAL_LANG_CLICK_TOSWITCH_PY",	"Go to calendar - previous year");
define("_CAL_LANG_CLICK_TOSWITCH_PM",	"Go to calendar - previous month");
define("_CAL_LANG_CLICK_TOSWITCH_NM",	"Go to calendar - next month");
define("_CAL_LANG_CLICK_TOSWITCH_NY",	"Go to calendar - next year");

// navTableNext
define("_CAL_LANG_NAV_TN_FIRST_LIST",	"first list");
define("_CAL_LANG_NAV_TN_PREV_LIST",	"previous list");
define("_CAL_LANG_NAV_TN_NEXT_LIST",	"next list");
define("_CAL_LANG_NAV_TN_LAST_LIST",	"final list");

// calendar monthly display
define("_CAL_LANG_FIRST_SINGLE_DAY_EVENT",		"Single event");
define("_CAL_LANG_FIRST_DAY_OF_MULTIEVENT",	"First day of multiday event");
define("_CAL_LANG_LAST_DAY_OF_MULTIEVENT",		"Last day of a multiday event");
define("_CAL_LANG_MULTIDAY_EVENT",				"Multiday event");
/* ++++++ end mic +++++++++++++ */

// Months
DEFINE("_CAL_LANG_JANUARY", "Ionawr");
DEFINE("_CAL_LANG_FEBRUARY", "Chwefror");
DEFINE("_CAL_LANG_MARCH", "Mawrth");
DEFINE("_CAL_LANG_APRIL", "Ebrill");
DEFINE("_CAL_LANG_MAY", "Mai");
DEFINE("_CAL_LANG_JUNE", "Mehefin");
DEFINE("_CAL_LANG_JULY", "Gorffenaf");
DEFINE("_CAL_LANG_AUGUST", "Awst");
DEFINE("_CAL_LANG_SEPTEMBER", "Medi");
DEFINE("_CAL_LANG_OCTOBER", "Hydref");
DEFINE("_CAL_LANG_NOVEMBER", "Tachwedd");
DEFINE("_CAL_LANG_DECEMBER", "Rhagfyr");

// Short day names
DEFINE("_CAL_LANG_SUN", "Sul");
DEFINE("_CAL_LANG_MON", "Llun");
DEFINE("_CAL_LANG_TUE", "Maw");
DEFINE("_CAL_LANG_WED", "Mer");
DEFINE("_CAL_LANG_THU", "Iau");
DEFINE("_CAL_LANG_FRI", "Gwe");
DEFINE("_CAL_LANG_SAT", "Sad");

// Days
DEFINE("_CAL_LANG_SUNDAY", "Sul");
DEFINE("_CAL_LANG_MONDAY", "Llun");
DEFINE("_CAL_LANG_TUESDAY", "Mawrth");
DEFINE("_CAL_LANG_WEDNESDAY", "Mercher");
DEFINE("_CAL_LANG_THURSDAY", "Iau");
DEFINE("_CAL_LANG_FRIDAY", "Gwener");
DEFINE("_CAL_LANG_SATURDAY", "Sadwrn");

// Days lettres
DEFINE("_CAL_LANG_SUNDAYSHORT", "S");
DEFINE("_CAL_LANG_MONDAYSHORT", "Ll");
DEFINE("_CAL_LANG_TUESDAYSHORT", "M");
DEFINE("_CAL_LANG_WEDNESDAYSHORT", "M");
DEFINE("_CAL_LANG_THURSDAYSHORT", "I");
DEFINE("_CAL_LANG_FRIDAYSHORT", "G");
DEFINE("_CAL_LANG_SATURDAYSHORT", "S");

// Repeat type
DEFINE("_CAL_LANG_ALLDAYS", "Pob dydd");
DEFINE("_CAL_LANG_EACHWEEK", "Pob wythnos");
DEFINE("_CAL_LANG_EACHWEEKPAIR", "Pob wythnos eilrif");
DEFINE("_CAL_LANG_EACHWEEKIMPAIR", "Pos wythnos odrif");
DEFINE("_CAL_LANG_EACHMONTH", "Pob mis");
DEFINE("_CAL_LANG_EACHYEAR", "Pob blwyddyn");
DEFINE("_CAL_LANG_ONLYDAYS", "Dyddiau dethol yn unig");
DEFINE("_CAL_LANG_EACH", "Pob");
DEFINE("_CAL_LANG_EACHOF","o bob");
DEFINE("_CAL_LANG_ENDMONTH", "diwedd pob mis");

// Repeat days
DEFINE("_CAL_LANG_BYDAYNUMBER", "wrth rhif y dydd");

// User type
DEFINE("_CAL_LANG_ANONYME", "Dienw");

// Post
//PAS D'ACCENTS DANS LES _ACT_
DEFINE("_CAL_LANG_ACT_ADDED", "Thanks for you submission - We will verify your proposition!"); //NO ACCENT !!
DEFINE("_CAL_LANG_ACT_MODIFIED", "Mae'r digwyddiad yma wedi ei newid."); //NO ACCENT !!
DEFINE("_CAL_LANG_ACT_PUBLISHED", "This event has been published.");  //NEW 1.4
DEFINE("_CAL_LANG_ACT_DELETED", "Mae'r digwyddiad yna weid ei ddiddymu."); //NO ACCENT !!
DEFINE("_CAL_LANG_NOPERMISSION", "Ni allwch ddefnyddio'r gwasanaeth yma!"); //NO ACCENT !!

DEFINE("_CAL_LANG_MAIL_ADDED", "Cyflwyniad newydd ar");
DEFINE("_CAL_LANG_MAIL_MODIFIED", "Newid newydd ar");

// Presentation
DEFINE("_CAL_LANG_BY", "gan");
DEFINE("_CAL_LANG_FROM", "O");
DEFINE("_CAL_LANG_TO", "Tan");
DEFINE("_CAL_LANG_ARCHIVE", "Archifau");
DEFINE("_CAL_LANG_WEEK", "yr wythnos");
DEFINE("_CAL_LANG_NO_EVENTS", "Dim digwyddiadau");
DEFINE("_CAL_LANG_NO_EVENTFOR", "Dim digwyddiad ar gyfer");
DEFINE("_CAL_LANG_NO_EVENTFORTHE", "Dim digwyddiad ar gyfer");
DEFINE("_CAL_LANG_THIS_DAY", "y diwrnod yma");
DEFINE("_CAL_LANG_THIS_MONTH", "Mis Yma");
DEFINE("_CAL_LANG_LAST_MONTH", "Mis diwethaf");
DEFINE("_CAL_LANG_NEXT_MONTH", "Mis nesaf");
DEFINE("_CAL_LANG_EVENTSFOR", "Digwyddiadau ar gyfer");
DEFINE("_CAL_LANG_SEARCHRESULTS", "Search Results for keyword"); // new 1.4
DEFINE("_CAL_LANG_EVENTSFORTHE", "Digwyddiadau");
DEFINE("_CAL_LANG_REP_DAY", "diwrnod");
DEFINE("_CAL_LANG_REP_WEEK", "wythnos");
DEFINE("_CAL_LANG_REP_WEEKPAIR", "pob yn ail wythnos");
DEFINE("_CAL_LANG_REP_WEEKIMPAIR", "pob 3ydd wythnoss");
DEFINE("_CAL_LANG_REP_MONTH", "mis");
DEFINE("_CAL_LANG_REP_YEAR", "blwyddyn");
DEFINE("_CAL_LANG_REP_NOEVENTSELECTED", "Dweisiwch digwyddiad yn gyntaf");

// Navigation
DEFINE("_CAL_LANG_VIEWTODAY", "Gweld Heddiw");
DEFINE("_CAL_LANG_VIEWTOCOME", "Digyddiadau mis yma");
DEFINE("_CAL_LANG_VIEWBYDAY", "Gweld fesul dydd");
DEFINE("_CAL_LANG_VIEWBYCAT", "Gweld fesul categori");
DEFINE("_CAL_LANG_VIEWBYMONTH", "Gweld fesul mis");
DEFINE("_CAL_LANG_VIEWBYYEAR", "Gweld fesul blwyddyn");
DEFINE("_CAL_LANG_VIEWBYWEEK", "Gweld fesul wythnos");
DEFINE("_CAL_LANG_JUMPTO", "Neidio at fis penodol");  // New 1.4
DEFINE("_CAL_LANG_BACK", "Yn ol");
DEFINE("_CAL_LANG_CLOSE", "Cau");
DEFINE("_CAL_LANG_PREVIOUSDAY", "Diwrnod blaenorol");
DEFINE("_CAL_LANG_PREVIOUSWEEK", "Wythnos blaenorol");
DEFINE("_CAL_LANG_PREVIOUSMONTH", "Mis blaenorol");
DEFINE("_CAL_LANG_PREVIOUSYEAR", "Blwyddyn blaenorol");
DEFINE("_CAL_LANG_NEXTDAY", "Diwrnod canlynol");
DEFINE("_CAL_LANG_NEXTWEEK", "Wythnos canlynol");
DEFINE("_CAL_LANG_NEXTMONTH", "Mis nesaf");
DEFINE("_CAL_LANG_NEXTYEAR", "Blwyddyn canlynol");

DEFINE("_CAL_LANG_ADMINPANEL", "Panel gweinyddu");
DEFINE("_CAL_LANG_ADDEVENT", "Ychwanegu Digwyddiad");
DEFINE("_CAL_LANG_MYEVENTS", "Fy nigwyddiadau");
DEFINE("_CAL_LANG_DELETE", "Dileu");
DEFINE("_CAL_LANG_MODIFY", "Adnewid");

// Form
DEFINE("_CAL_LANG_HELP", "Cymorth");

DEFINE("_CAL_LANG_CAL_TITLE", "Teitl");
DEFINE("_CAL_LANG_ADD_TITLE", "Ychwanegu");
DEFINE("_CAL_LANG_MODIFY_TITLE", "Adnewid");

DEFINE("_CAL_LANG_REPEAT_DISABLED", "XXXXEvent Repeating is only applicable if End Date is after Start Date.  Change End Date before configuring event repeat details."); // New for 1.4
DEFINE("_CAL_LANG_EVENT_TITLE", "Pwnc");
DEFINE("_CAL_LANG_EVENT_COLOR", "Lliw");
DEFINE("_CAL_LANG_EVENT_CATCOLOR", "Defnyddio Lliw Categori");
DEFINE("_CAL_LANG_EVENT_CATEGORY", "Categoriau");
DEFINE("_CAL_LANG_EVENT_CHOOSE_CATEG", "Dewisiwch gategori");
DEFINE("_CAL_LANG_EVENT_ACTIVITY", "Gweithgaredd");
DEFINE("_CAL_LANG_EVENT_URLMAIL_INFO", "I ychwanegu URL neu cyfeiriad ebost, sgwennuch <br><u>http://www.mysite.com</u> neu <u>mailto:my@mail.com</u>");
DEFINE("_CAL_LANG_EVENT_ADRESSE", "Lleoliad");
DEFINE("_CAL_LANG_EVENT_CONTACT", "Person Gyswllt");
DEFINE("_CAL_LANG_EVENT_EXTRA", "Gwybodaeth pellach");
DEFINE("_CAL_LANG_EVENT_AUTHOR_ALIAS", "Awdur (alias)");
DEFINE("_CAL_LANG_EVENT_STARTDATE", "Dyddiad dechrau");
DEFINE("_CAL_LANG_EVENT_ENDDATE", "Dyddiad gorffen");
DEFINE("_CAL_LANG_EVENT_STARTHOURS", "Awr dechrau");
DEFINE("_CAL_LANG_EVENT_ENDHOURS", "Awr gorffen");
DEFINE("_CAL_LANG_EVENT_STARTTIME", "Amswer dechrau");
DEFINE("_CAL_LANG_EVENT_ENDTIME", "Amswer gorffen");
DEFINE("_CAL_LANG_PUB_INFO", "Dyddiad cyhoeddiad");
DEFINE("_CAL_LANG_EVENT_REPEATTYPE", "Math yr ailadrodd");
DEFINE("_CAL_LANG_EVENT_REPEATDAY", "Dydd ailadrodd");
DEFINE("_CAL_LANG_EVENT_CHOOSE_WEEKDAYS", "Dyddiau yr wythnos");
DEFINE("_CAL_LANG_EVENT_PER", "pob");
DEFINE("_CAL_LANG_EVENT_WEEKOPT", "Week(s) of a month repeat type week");

DEFINE("_CAL_LANG_SUBMITPREVIEW", "Rhagolwg");
DEFINE("_CAL_LANG_SUBMITCANCEL", "Diddymu");
DEFINE("_CAL_LANG_SUBMITSAVE", "Cadw");

DEFINE("_CAL_LANG_E_WARNWEEKS", "Dewisiwch wythnos.");
DEFINE("_CAL_LANG_E_WARNDAYS", "Dewisiwch dydd.");

// Admin
DEFINE("_CAL_LANG_EVENT_ALLCAT", "Pob categori");
DEFINE("_CAL_LANG_EVENT_ACCESSLEVEL", "Lefel hawl mynediad");
DEFINE("_CAL_LANG_EVENT_HITS", "Trawiadau");
DEFINE("_CAL_LANG_EVENT_STATE", "Cyflwr");
DEFINE("_CAL_LANG_EVENT_CREATED", "Creuwyd");
DEFINE("_CAL_LANG_EVENT_NEWEVENT", "Digwyddiad Newydd");
DEFINE("_CAL_LANG_EVENT_MODIFIED", "Digwyddiad weid adnewid");
DEFINE("_CAL_LANG_EVENT_NOTMODIFIED", "Hed ei adnewid");

// dmcd aug 22/04  new warning alert for no specified activity in event entry
DEFINE("_CAL_LANG_WARNACTIVITY", "Some sort of Activity\\ndescription must be entered.");

DEFINE("_CAL_LEGEND_ALL_CATEGORIES", "Pob Categori ...");  // new for 1.4
DEFINE("_CAL_LEGEND_ALL_CATEGORIES_DESC", "Digwyddiadau o bob categori");  // new for 1.4

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