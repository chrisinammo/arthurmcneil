<?php
/**
 * Events Component for Joomla 1.0.x
 *
 * @version     $Id: russian.php 880 2007-10-31 19:16:08Z tstahl $
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
DEFINE("_CAL_LANG_JANUARY", "������");
DEFINE("_CAL_LANG_FEBRUARY", "�������");
DEFINE("_CAL_LANG_MARCH", "����");
DEFINE("_CAL_LANG_APRIL", "������");
DEFINE("_CAL_LANG_MAY", "���");
DEFINE("_CAL_LANG_JUNE", "����");
DEFINE("_CAL_LANG_JULY", "����");
DEFINE("_CAL_LANG_AUGUST", "������");
DEFINE("_CAL_LANG_SEPTEMBER", "��������");
DEFINE("_CAL_LANG_OCTOBER", "�������");
DEFINE("_CAL_LANG_NOVEMBER", "������");
DEFINE("_CAL_LANG_DECEMBER", "�������");

// Short day names
DEFINE("_CAL_LANG_SUN", "��");
DEFINE("_CAL_LANG_MON", "��");
DEFINE("_CAL_LANG_TUE", "��");
DEFINE("_CAL_LANG_WED", "��");
DEFINE("_CAL_LANG_THU", "��");
DEFINE("_CAL_LANG_FRI", "��");
DEFINE("_CAL_LANG_SAT", "��");

// Days
DEFINE("_CAL_LANG_SUNDAY", "�����������");
DEFINE("_CAL_LANG_MONDAY", "�����������");
DEFINE("_CAL_LANG_TUESDAY", "�������");
DEFINE("_CAL_LANG_WEDNESDAY", "�����");
DEFINE("_CAL_LANG_THURSDAY", "�������");
DEFINE("_CAL_LANG_FRIDAY", "�������");
DEFINE("_CAL_LANG_SATURDAY", "�������");

// Days lettres
DEFINE("_CAL_LANG_SUNDAYSHORT", "��");
DEFINE("_CAL_LANG_MONDAYSHORT", "��");
DEFINE("_CAL_LANG_TUESDAYSHORT", "��");
DEFINE("_CAL_LANG_WEDNESDAYSHORT", "��");
DEFINE("_CAL_LANG_THURSDAYSHORT", "��");
DEFINE("_CAL_LANG_FRIDAYSHORT", "��");
DEFINE("_CAL_LANG_SATURDAYSHORT", "��");

// Repeat type
DEFINE("_CAL_LANG_ALLDAYS", "������ ����");
DEFINE("_CAL_LANG_EACHWEEK", "������ ������");
DEFINE("_CAL_LANG_EACHWEEKPAIR", "������ ������ ������");
DEFINE("_CAL_LANG_EACHWEEKIMPAIR", "������ �������� ������");
DEFINE("_CAL_LANG_EACHMONTH", "������ �����");
DEFINE("_CAL_LANG_EACHYEAR", "������ ���");
DEFINE("_CAL_LANG_ONLYDAYS", "������ ��������� ���");
DEFINE("_CAL_LANG_EACH", "����.");
DEFINE("_CAL_LANG_EACHOF","�������");
DEFINE("_CAL_LANG_ENDMONTH", "����� ������");

// Repeat days
DEFINE("_CAL_LANG_BYDAYNUMBER", "��� �� ������");

// User type
DEFINE("_CAL_LANG_ANONYME", "���������");

// Post
//PAS D'ACCENTS DANS LES _ACT_
DEFINE("_CAL_LANG_ACT_ADDED", "���������� ��� �� ���������� �������! �� �������� � ���������� ��� � ��������� �����"); //NO ACCENT !!
DEFINE("_CAL_LANG_ACT_MODIFIED", "������ ������� ���� ��������."); //NO ACCENT !!
DEFINE("_CAL_LANG_ACT_PUBLISHED", "XXXXThis event has been published.");  //NEW 1.4
DEFINE("_CAL_LANG_ACT_DELETED", "������ ������� ���� �������!"); //NO ACCENT !!
DEFINE("_CAL_LANG_NOPERMISSION", "� ��� ��� ������� � ����� �������!"); //NO ACCENT !!

DEFINE("_CAL_LANG_MAIL_ADDED", "����� ����������:");
DEFINE("_CAL_LANG_MAIL_MODIFIED", "����� ���������");

// Presentation
DEFINE("_CAL_LANG_BY", "������������:");
DEFINE("_CAL_LANG_FROM", "�");
DEFINE("_CAL_LANG_TO", "��");
DEFINE("_CAL_LANG_ARCHIVE", "������");
DEFINE("_CAL_LANG_WEEK", "������");
DEFINE("_CAL_LANG_NO_EVENTS", "��� �������");
DEFINE("_CAL_LANG_NO_EVENTFOR", "��� ������� ��:");
DEFINE("_CAL_LANG_NO_EVENTFORTHE", "��� ������� ��:");
DEFINE("_CAL_LANG_THIS_DAY", "���� ����");
DEFINE("_CAL_LANG_THIS_MONTH", "� ���� ������...");
DEFINE("_CAL_LANG_LAST_MONTH", "� ������� ������...");
DEFINE("_CAL_LANG_NEXT_MONTH", "� ��������� ������...");
DEFINE("_CAL_LANG_EVENTSFOR", "������� ��:");
DEFINE("_CAL_LANG_SEARCHRESULTS", "XXXXSearch Results for keyword"); // new 1.4
DEFINE("_CAL_LANG_EVENTSFORTHE", "������� ��");
DEFINE("_CAL_LANG_REP_DAY", "����");
DEFINE("_CAL_LANG_REP_WEEK", "������ ��:");
DEFINE("_CAL_LANG_REP_WEEKPAIR", "������ ������");
DEFINE("_CAL_LANG_REP_WEEKIMPAIR", "�������� ������");
DEFINE("_CAL_LANG_REP_MONTH", "����� ��:");
DEFINE("_CAL_LANG_REP_YEAR", "��� ��:");
DEFINE("_CAL_LANG_REP_NOEVENTSELECTED", "Please select an event first");

// Navigation
DEFINE("_CAL_LANG_VIEWTODAY", "�������&nbsp;��&nbsp;�������");
DEFINE("_CAL_LANG_VIEWTOCOME", "�������&nbsp;�&nbsp;����&nbsp;������");
DEFINE("_CAL_LANG_VIEWBYDAY", "���������� �� ����");
DEFINE("_CAL_LANG_VIEWBYCAT", "���������� �� ����������");
DEFINE("_CAL_LANG_VIEWBYMONTH", "���������� �� �����");
DEFINE("_CAL_LANG_VIEWBYYEAR", "���������� �� ���");
DEFINE("_CAL_LANG_VIEWBYWEEK", "���������� �� ������");
DEFINE("_CAL_LANG_JUMPTO", "XXXXJump to specific month");  // New 1.4
DEFINE("_CAL_LANG_BACK", "�������");
DEFINE("_CAL_LANG_CLOSE", "Close");
DEFINE("_CAL_LANG_PREVIOUSDAY", "���������� ����");
DEFINE("_CAL_LANG_PREVIOUSWEEK", "���������� ������");
DEFINE("_CAL_LANG_PREVIOUSMONTH", "���������� �����");
DEFINE("_CAL_LANG_PREVIOUSYEAR", "���������� ���");
DEFINE("_CAL_LANG_NEXTDAY", "�������� ����");
DEFINE("_CAL_LANG_NEXTWEEK", "�������� ������");
DEFINE("_CAL_LANG_NEXTMONTH", "� ��������� ������...");
DEFINE("_CAL_LANG_NEXTYEAR", "�������� ���");

DEFINE("_CAL_LANG_ADMINPANEL", "�����. ������");
DEFINE("_CAL_LANG_ADDEVENT", ":: �������� �������");
DEFINE("_CAL_LANG_MYEVENTS", ":: ��� �������");
DEFINE("_CAL_LANG_DELETE", "�������");
DEFINE("_CAL_LANG_MODIFY", "��������");

// Form
DEFINE("_CAL_LANG_HELP", "������");

DEFINE("_CAL_LANG_CAL_TITLE", "�������");
DEFINE("_CAL_LANG_ADD_TITLE", "��������");
DEFINE("_CAL_LANG_MODIFY_TITLE", "��������");

DEFINE("_CAL_LANG_EVENT_TITLE", "�������");
DEFINE("_CAL_LANG_EVENT_COLOR", "����");
DEFINE("_CAL_LANG_EVENT_CATCOLOR", "������������ ����");
DEFINE("_CAL_LANG_EVENT_CATEGORY", "���������");
DEFINE("_CAL_LANG_EVENT_CHOOSE_CATEG", "�������� ���������");
DEFINE("_CAL_LANG_EVENT_ACTIVITY", "��������");
DEFINE("_CAL_LANG_EVENT_URLMAIL_INFO", "��� ���������� URL ��� E-mail, ���������� � ��������� ������� <u>http://www.mysite.com</u> ��� <u>mailto:my@mail.com</u>");
DEFINE("_CAL_LANG_EVENT_ADRESSE", "���� ��������������");
DEFINE("_CAL_LANG_EVENT_CONTACT", "�������");
DEFINE("_CAL_LANG_EVENT_EXTRA", "�������������� ����������");
DEFINE("_CAL_LANG_EVENT_AUTHOR_ALIAS", "����� (���������)");
DEFINE("_CAL_LANG_EVENT_STARTDATE", "���� ������ ����������");
DEFINE("_CAL_LANG_EVENT_ENDDATE", "���� ��������� ����������");
DEFINE("_CAL_LANG_EVENT_STARTHOURS", "����� ������");
DEFINE("_CAL_LANG_EVENT_ENDHOURS", "����� �����");
DEFINE("_CAL_LANG_EVENT_STARTTIME", "����� ������");
DEFINE("_CAL_LANG_EVENT_ENDTIME", "����� �����");
DEFINE("_CAL_LANG_PUB_INFO", "����������� ����������");
DEFINE("_CAL_LANG_EVENT_REPEATTYPE", "��� �������");
DEFINE("_CAL_LANG_EVENT_REPEATDAY", "���� �������");
DEFINE("_CAL_LANG_EVENT_CHOOSE_WEEKDAYS", "���� � ������");
DEFINE("_CAL_LANG_EVENT_PER", "�");
DEFINE("_CAL_LANG_EVENT_WEEKOPT", "������(�) ������ �� ����������� ������");

DEFINE("_CAL_LANG_SUBMITPREVIEW", "������������");
DEFINE("_CAL_LANG_SUBMITCANCEL", "������");
DEFINE("_CAL_LANG_SUBMITSAVE", "���������");

DEFINE("_CAL_LANG_E_WARNWEEKS", "��������������.");
DEFINE("_CAL_LANG_E_WARNDAYS", "��������������.");

// Admin
DEFINE("_CAL_LANG_EVENT_ALLCAT", "��� ���������");
DEFINE("_CAL_LANG_EVENT_ACCESSLEVEL", "������� �������");
DEFINE("_CAL_LANG_EVENT_HITS", "�������");
DEFINE("_CAL_LANG_EVENT_STATE", "���������");
DEFINE("_CAL_LANG_EVENT_CREATED", "���� ��������");
DEFINE("_CAL_LANG_EVENT_NEWEVENT", "����� �������");
DEFINE("_CAL_LANG_EVENT_MODIFIED", "���� ���������� ���������");
DEFINE("_CAL_LANG_EVENT_NOTMODIFIED", "�� ��������");

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
