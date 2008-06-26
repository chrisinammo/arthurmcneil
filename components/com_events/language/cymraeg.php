<?php
/**
 * Events Component for Joomla 1.0.x
 *
 * @version     $Id: cymraeg.php 880 2007-10-31 19:16:08Z tstahl $
 * @package     Events
 * @copyright   Copyright (C) 2006-2007 JEvents Project Group
 * @licence     http://www.gnu.org/copyleft/gpl.html
 * @link        http://joomlacode.org/gf/project/jevents
 */

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

define("_CAL_LANG_INCLUDED",		"1");
define("_CAL_LANG_LNG",		"cym");
define("_CAL_LANG_REPEAT_GRAMMAR",	"1");
define("_CAL_LANG_NO_COLOR",		"Dim Lliw");
define("_CAL_LANG_COLOR_PICKER",		"Dewisiwr Liw");
define("_CAL_LANG_TIME",		"Amser");
define("_CAL_LANG_CLICK_TO_OPEN_EVENT",		"Clicio i agor digwyddiad");
define("_CAL_LANG_UNPUBLISHED",		"** Heb ei gyhoeddi **");
define("_CAL_LANG_DESCRIPTION",		"Discrifiad");
define("_CAL_LANG_EMAIL_TO_AUTHOR",		"Ebost i'r awdur");
define("_CAL_LANG_MAIL_TO_ADMIN",		"Event submited from [ %s ] by [ %s ]");
define("_CAL_LANG_KEYWORD_NOT_VALID",		"Not a valid keyword");
define("_CAL_LANG_EVENT_CALENDAR",		"Calendar Digwyddiadau");
define("_CAL_LANG_ERR_NO_MOD_CAL",		"Events Calendar
<br />This module needs the Events component");
define("_CAL_LANG_CLICK_TOSWITCH_DAY",		"Go to calendar - current day");
define("_CAL_LANG_CLICK_TOSWITCH_MON",		"Go to calendar - current month");
define("_CAL_LANG_CLICK_TOSWITCH_YEAR",		"Go to calendar - current year");
define("_CAL_LANG_CLICK_TOSWITCH_PY",		"Go to calendar - previous year");
define("_CAL_LANG_CLICK_TOSWITCH_PM",		"Go to calendar - previous month");
define("_CAL_LANG_CLICK_TOSWITCH_NM",		"Go to calendar - next month");
define("_CAL_LANG_CLICK_TOSWITCH_NY",		"Go to calendar - next year");
define("_CAL_LANG_CLICK_TOCOMPONENT",	"View Full Calendar");
define("_CAL_LANG_NAV_TN_FIRST_LIST",		"first list");
define("_CAL_LANG_NAV_TN_PREV_LIST",		"previous list");
define("_CAL_LANG_NAV_TN_NEXT_LIST",		"next list");
define("_CAL_LANG_NAV_TN_LAST_LIST",		"final list");
define("_CAL_LANG_FIRST_SINGLE_DAY_EVENT",		"Single event");
define("_CAL_LANG_FIRST_DAY_OF_MULTIEVENT",		"First day of multiday event");
define("_CAL_LANG_LAST_DAY_OF_MULTIEVENT",		"Last day of a multiday event");
define("_CAL_LANG_MULTIDAY_EVENT",		"Multiday event");
define("_CAL_LANG_JANUARY",		"Ionawr");
define("_CAL_LANG_FEBRUARY",		"Chwefror");
define("_CAL_LANG_MARCH",		"Mawrth");
define("_CAL_LANG_APRIL",		"Ebrill");
define("_CAL_LANG_MAY",		"Mai");
define("_CAL_LANG_JUNE",		"Mehefin");
define("_CAL_LANG_JULY",		"Gorffenaf");
define("_CAL_LANG_AUGUST",		"Awst");
define("_CAL_LANG_SEPTEMBER",		"Medi");
define("_CAL_LANG_OCTOBER",		"Hydref");
define("_CAL_LANG_NOVEMBER",		"Tachwedd");
define("_CAL_LANG_DECEMBER",		"Rhagfyr");
define("_CAL_LANG_SUN",		"Sul");
define("_CAL_LANG_MON",		"Llun");
define("_CAL_LANG_TUE",		"Maw");
define("_CAL_LANG_WED",		"Mer");
define("_CAL_LANG_THU",		"Iau");
define("_CAL_LANG_FRI",		"Gwe");
define("_CAL_LANG_SAT",		"Sad");
define("_CAL_LANG_SUNDAY",		"Sul");
define("_CAL_LANG_MONDAY",		"Llun");
define("_CAL_LANG_TUESDAY",		"Mawrth");
define("_CAL_LANG_WEDNESDAY",		"Mercher");
define("_CAL_LANG_THURSDAY",		"Iau");
define("_CAL_LANG_FRIDAY",		"Gwener");
define("_CAL_LANG_SATURDAY",		"Sadwrn");
define("_CAL_LANG_SUNDAYSHORT",		"S");
define("_CAL_LANG_MONDAYSHORT",		"Ll");
define("_CAL_LANG_TUESDAYSHORT",		"M");
define("_CAL_LANG_WEDNESDAYSHORT",		"M");
define("_CAL_LANG_THURSDAYSHORT",		"I");
define("_CAL_LANG_FRIDAYSHORT",		"G");
define("_CAL_LANG_SATURDAYSHORT",		"S");
define("_CAL_LANG_ALLDAYS",		"Pob dydd");
define("_CAL_LANG_EACHWEEK",		"Pob wythnos");
define("_CAL_LANG_EACHWEEKPAIR",		"Pob wythnos eilrif");
define("_CAL_LANG_EACHWEEKIMPAIR",		"Pos wythnos odrif");
define("_CAL_LANG_EACHMONTH",		"Pob mis");
define("_CAL_LANG_EACHYEAR",		"Pob blwyddyn");
define("_CAL_LANG_ONLYDAYS",		"Dyddiau dethol yn unig");
define("_CAL_LANG_EACH",		"Pob");
define("_CAL_LANG_EACHOF",		"o bob");
define("_CAL_LANG_ENDMONTH",		"diwedd pob mis");
define("_CAL_LANG_BYDAYNUMBER",		"wrth rhif y dydd");
define("_CAL_LANG_ANONYME",		"Dienw");
define("_CAL_LANG_ACT_ADDED",		"Thanks for you submission - We will verify your proposition!");
define("_CAL_LANG_ACT_MODIFIED",		"Mae&apos;r digwyddiad yma wedi ei newid.");
define("_CAL_LANG_ACT_PUBLISHED",		"This event has been published.");
define("_CAL_LANG_ACT_DELETED",		"Mae'r digwyddiad yna weid ei ddiddymu.");
define("_CAL_LANG_NOPERMISSION",		"Ni allwch ddefnyddio'r gwasanaeth yma!");
define("_CAL_LANG_MAIL_ADDED",		"Cyflwyniad newydd ar");
define("_CAL_LANG_MAIL_MODIFIED",		"Newid newydd ar");
define("_CAL_LANG_BY",		"gan");
define("_CAL_LANG_FROM",		"O");
define("_CAL_LANG_TO",		"Tan");
define("_CAL_LANG_ARCHIVE",		"Archifau");
define("_CAL_LANG_WEEK",		"yr wythnos");
define("_CAL_LANG_NO_EVENTS",		"Dim digwyddiadau");
define("_CAL_LANG_NO_EVENTFOR",		"Dim digwyddiad ar gyfer");
define("_CAL_LANG_NO_EVENTFORTHE",		"Dim digwyddiad ar gyfer");
define("_CAL_LANG_THIS_DAY",		"y diwrnod yma");
define("_CAL_LANG_THIS_MONTH",		"Mis Yma");
define("_CAL_LANG_LAST_MONTH",		"Mis diwethaf");
define("_CAL_LANG_NEXT_MONTH",		"Mis nesaf");
define("_CAL_LANG_EVENTSFOR",		"Digwyddiadau ar gyfer");
define("_CAL_LANG_SEARCHRESULTS",		"Search Results for keyword");
define("_CAL_LANG_EVENTSFORTHE",		"Digwyddiadau");
define("_CAL_LANG_REP_DAY",		"diwrnod");
define("_CAL_LANG_REP_WEEK",		"wythnos");
define("_CAL_LANG_REP_WEEKPAIR",		"pob yn ail wythnos");
define("_CAL_LANG_REP_WEEKIMPAIR",		"pob tair wythnoss");
define("_CAL_LANG_REP_MONTH",		"mis");
define("_CAL_LANG_REP_YEAR",		"blwyddyn");
define("_CAL_LANG_REP_NOEVENTSELECTED",		"Dweisiwch digwyddiad yn gyntaf");
define("_CAL_LANG_VIEWTODAY",		"Gweld Heddiw");
define("_CAL_LANG_VIEWTOCOME",		"Digyddiadau mis yma");
define("_CAL_LANG_VIEWBYDAY",		"Gweld fesul dydd");
define("_CAL_LANG_VIEWBYCAT",		"Gweld fesul categori");
define("_CAL_LANG_VIEWBYMONTH",		"Gweld fesul mis");
define("_CAL_LANG_VIEWBYYEAR",		"Gweld fesul blwyddyn");
define("_CAL_LANG_VIEWBYWEEK",		"Gweld fesul wythnos");
define("_CAL_LANG_JUMPTO",		"Neidio at fis penodol");
define("_CAL_LANG_BACK",		"Yn ol");
define("_CAL_LANG_CLOSE",		"Cau");
define("_CAL_LANG_PREVIOUSDAY",		"Diwrnod blaenorol");
define("_CAL_LANG_PREVIOUSWEEK",		"Wythnos blaenorol");
define("_CAL_LANG_PREVIOUSMONTH",		"Mis blaenorol");
define("_CAL_LANG_PREVIOUSYEAR",		"Blwyddyn blaenorol");
define("_CAL_LANG_NEXTDAY",		"Diwrnod canlynol");
define("_CAL_LANG_NEXTWEEK",		"Wythnos canlynol");
define("_CAL_LANG_NEXTMONTH",		"Mis nesaf");
define("_CAL_LANG_NEXTYEAR",		"Blwyddyn canlynol");
define("_CAL_LANG_ADMINPANEL",		"Panel gweinyddu");
define("_CAL_LANG_ADDEVENT",		"Ychwanegu Digwyddiad");
define("_CAL_LANG_MYEVENTS",		"Fy nigwyddiadau");
define("_CAL_LANG_DELETE",		"Dileu");
define("_CAL_LANG_MODIFY",		"Adnewid");
define("_CAL_LANG_HELP",		"Cymorth");
define("_CAL_LANG_CAL_TITLE",		"Teitl");
define("_CAL_LANG_ADD_TITLE",		"Ychwanegu");
define("_CAL_LANG_MODIFY_TITLE",		"Adnewid");
define("_CAL_LANG_REPEAT_DISABLED",		"XXXXEvent Repeating is only applicable if End Date is after Start Date.  Change End Date before configuring event repeat details.");
define("_CAL_LANG_EVENT_TITLE",		"Pwnc");
define("_CAL_LANG_EVENT_COLOR",		"Lliw");
define("_CAL_LANG_EVENT_CATCOLOR",		"Defnyddio Lliw Categori");
define("_CAL_LANG_EVENT_CATEGORY",		"Categoriau");
define("_CAL_LANG_EVENT_CHOOSE_CATEG",		"Dewisiwch gategori");
define("_CAL_LANG_EVENT_ACTIVITY",		"Gweithgaredd");
define("_CAL_LANG_EVENT_URLMAIL_INFO",		"I ychwanegu URL neu cyfeiriad ebost, sgwennuch <br><u>http://www.mysite.com</u> neu <u>mailto:my@mail.com</u>");
define("_CAL_LANG_EVENT_ADRESSE",		"Lleoliad");
define("_CAL_LANG_EVENT_CONTACT",		"Person Gyswllt");
define("_CAL_LANG_EVENT_EXTRA",		"Gwybodaeth pellach");
define("_CAL_LANG_EVENT_AUTHOR_ALIAS",		"Awdur (alias)");
define("_CAL_LANG_EVENT_STARTDATE",		"Dyddiad dechrau");
define("_CAL_LANG_EVENT_ENDDATE",		"Dyddiad gorffen");
define("_CAL_LANG_EVENT_STARTHOURS",		"Awr dechrau");
define("_CAL_LANG_EVENT_ENDHOURS",		"Awr gorffen");
define("_CAL_LANG_EVENT_STARTTIME",		"Amswer dechrau");
define("_CAL_LANG_EVENT_ENDTIME",		"Amswer gorffen");
define("_CAL_LANG_PUB_INFO",		"Dyddiad cyhoeddiad");
define("_CAL_LANG_EVENT_REPEATTYPE",		"Math yr ailadrodd");
define("_CAL_LANG_EVENT_REPEATDAY",		"Dydd ailadrodd");
define("_CAL_LANG_EVENT_CHOOSE_WEEKDAYS",		"Dyddiau yr wythnos");
define("_CAL_LANG_EVENT_PER",		"pob");
define("_CAL_LANG_EVENT_WEEKOPT",		"Week(s) of a month repeat type week");
define("_CAL_LANG_SUBMITPREVIEW",		"Rhagolwg");
define("_CAL_LANG_SUBMITCANCEL",		"Diddymu");
define("_CAL_LANG_SUBMITSAVE",		"Cadw");
define("_CAL_LANG_E_WARNWEEKS",		"Dewisiwch wythnos.");
define("_CAL_LANG_E_WARNDAYS",		"Dewisiwch dydd.");
define("_CAL_LANG_EVENT_ALLCAT",		"Pob categori");
define("_CAL_LANG_EVENT_ACCESSLEVEL",		"Lefel hawl mynediad");
define("_CAL_LANG_EVENT_HITS",		"Trawiadau");
define("_CAL_LANG_EVENT_STATE",		"Cyflwr");
define("_CAL_LANG_EVENT_CREATED",		"Creuwyd");
define("_CAL_LANG_EVENT_NEWEVENT",		"Digwyddiad Newydd");
define("_CAL_LANG_EVENT_MODIFIED",		"Digwyddiad weid adnewid");
define("_CAL_LANG_EVENT_NOTMODIFIED",		"Hed ei adnewid");
define("_CAL_LANG_WARNACTIVITY",		"Some sort of Activity\ndescription must be entered.");
define("_CAL_LEGEND_ALL_CATEGORIES",		"Pob Categori ...");
define("_CAL_LEGEND_ALL_CATEGORIES_DESC",		"Digwyddiadau o bob categori");
define("_CAL_LANG_FORM_HELP_COLOR",		<<<END
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
define("_CAL_LANG_FORM_HELP",		<<<END
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
define("_CAL_LANG_FORM_HELP_EXTENDED",		<<<END
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
