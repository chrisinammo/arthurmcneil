<?php
/**
 * Events Component for Joomla 1.0.x
 *
 * @version     $Id: english.php 897 2007-11-17 15:32:11Z tstahl $
 * @package     Events
 * @copyright   Copyright (C) 2006 JEvents Project Group
 * @licence     http://www.gnu.org/copyleft/gpl.html
 * @link        http://joomlacode.org/gf/project/jevents
 */

defined("_VALID_MOS") or die("Direct Access to this location is not allowed");

//Check
DEFINE("_CAL_LANG_INCLUDED", 1);

// new 1.4.0 [mic]
define("_CAL_LANG_LNG",				"en"); // de|fr|etc... [ DO NOT CHANGE THIS VALUE! ]
define("_CAL_LANG_REPEAT_GRAMMAR",	"1"); // in repeat summary 1 = follow English word orde, 2= follow German word orderr

// used for colorpicker
define("_CAL_LANG_NO_COLOR",			"No Color");
define("_CAL_LANG_COLOR_PICKER",		"Color Picker");

// common
define("_CAL_LANG_TIME",				"Time");
define("_CAL_LANG_CLICK_TO_OPEN_EVENT",	"Click to open event");
define("_CAL_LANG_UNPUBLISHED",		"** Unpublished **");
define("_CAL_LANG_DESCRIPTION",		"Description");
define("_CAL_LANG_EMAIL_TO_AUTHOR",	"Email to author");
define("_CAL_LANG_MAIL_TO_ADMIN",		"Event submited from [ %s ] by [ %s ]");
define("_CAL_LANG_KEYWORD_NOT_VALID",	"Not a valid keyword");
define("_CAL_LANG_EVENT_CALENDAR",		"Events Calendar"); // new 1.4

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
DEFINE("_CAL_LANG_JANUARY", "January");
DEFINE("_CAL_LANG_FEBRUARY", "February");
DEFINE("_CAL_LANG_MARCH", "March");
DEFINE("_CAL_LANG_APRIL", "April");
DEFINE("_CAL_LANG_MAY", "May");
DEFINE("_CAL_LANG_JUNE", "June");
DEFINE("_CAL_LANG_JULY", "July");
DEFINE("_CAL_LANG_AUGUST", "August");
DEFINE("_CAL_LANG_SEPTEMBER", "September");
DEFINE("_CAL_LANG_OCTOBER", "October");
DEFINE("_CAL_LANG_NOVEMBER", "November");
DEFINE("_CAL_LANG_DECEMBER", "December");

// Short day names
DEFINE("_CAL_LANG_SUN", "Sun");
DEFINE("_CAL_LANG_MON", "Mon");
DEFINE("_CAL_LANG_TUE", "Tue");
DEFINE("_CAL_LANG_WED", "Wed");
DEFINE("_CAL_LANG_THU", "Thu");
DEFINE("_CAL_LANG_FRI", "Fri");
DEFINE("_CAL_LANG_SAT", "Sat");

// Days
DEFINE("_CAL_LANG_SUNDAY", "Sunday");
DEFINE("_CAL_LANG_MONDAY", "Monday");
DEFINE("_CAL_LANG_TUESDAY", "Tuesday");
DEFINE("_CAL_LANG_WEDNESDAY", "Wednesday");
DEFINE("_CAL_LANG_THURSDAY", "Thursday");
DEFINE("_CAL_LANG_FRIDAY", "Friday");
DEFINE("_CAL_LANG_SATURDAY", "Saturday");

// Days lettres
DEFINE("_CAL_LANG_SUNDAYSHORT", "S");
DEFINE("_CAL_LANG_MONDAYSHORT", "M");
DEFINE("_CAL_LANG_TUESDAYSHORT", "T");
DEFINE("_CAL_LANG_WEDNESDAYSHORT", "W");
DEFINE("_CAL_LANG_THURSDAYSHORT", "T");
DEFINE("_CAL_LANG_FRIDAYSHORT", "F");
DEFINE("_CAL_LANG_SATURDAYSHORT", "S");

// Repeat type
DEFINE("_CAL_LANG_ALLDAYS", "Every day");
DEFINE("_CAL_LANG_EACHWEEK", "Every week");
DEFINE("_CAL_LANG_EACHWEEKPAIR", "Every even week");
DEFINE("_CAL_LANG_EACHWEEKIMPAIR", "Every odd week");
DEFINE("_CAL_LANG_EACHMONTH", "Every month");
DEFINE("_CAL_LANG_EACHYEAR", "Every year");
DEFINE("_CAL_LANG_ONLYDAYS", "Only selected days");
DEFINE("_CAL_LANG_EACH", "Each");
DEFINE("_CAL_LANG_EACHOF","of each");
DEFINE("_CAL_LANG_ENDMONTH", "end of the month");

// Repeat days
DEFINE("_CAL_LANG_BYDAYNUMBER", "By day number");

// User type
DEFINE("_CAL_LANG_ANONYME", "Anonymous");

// Post
//PAS D'ACCENTS DANS LES _ACT_
DEFINE("_CAL_LANG_ACT_ADDED", "Thanks for you submission - We will verify your proposition!"); //NO ACCENT !!
DEFINE("_CAL_LANG_ACT_MODIFIED", "This event has been modified."); //NO ACCENT !!
DEFINE("_CAL_LANG_ACT_PUBLISHED", "This event has been published.");  //NEW 1.4
DEFINE("_CAL_LANG_ACT_DELETED", "This event has been deleted!"); //NO ACCENT !!
DEFINE("_CAL_LANG_NOPERMISSION", "You do not have access to this service !"); //NO ACCENT !!

DEFINE("_CAL_LANG_MAIL_ADDED", "New submission on");
DEFINE("_CAL_LANG_MAIL_MODIFIED", "New modification on");

// Presentation
DEFINE("_CAL_LANG_BY", "by");
DEFINE("_CAL_LANG_FROM", "From");
DEFINE("_CAL_LANG_TO", "To");
DEFINE("_CAL_LANG_ARCHIVE", "Archives");
DEFINE("_CAL_LANG_WEEK", "the week");
DEFINE("_CAL_LANG_NO_EVENTS", "No events");
DEFINE("_CAL_LANG_NO_EVENTFOR", "No events for");
DEFINE("_CAL_LANG_NO_EVENTFORTHE", "No event for ");
DEFINE("_CAL_LANG_THIS_DAY", "this day");
DEFINE("_CAL_LANG_THIS_MONTH", "This month");
DEFINE("_CAL_LANG_LAST_MONTH", "Last month");
DEFINE("_CAL_LANG_NEXT_MONTH", "Next month");
DEFINE("_CAL_LANG_EVENTSFOR", "Events for");
DEFINE("_CAL_LANG_SEARCHRESULTS", "Search Results for keyword"); // new 1.4
DEFINE("_CAL_LANG_EVENTSFORTHE", "Events for ");
DEFINE("_CAL_LANG_REP_DAY", "day");
DEFINE("_CAL_LANG_REP_WEEK", "week");
DEFINE("_CAL_LANG_REP_WEEKPAIR", "every other week");
DEFINE("_CAL_LANG_REP_WEEKIMPAIR", "every 3rd week");
DEFINE("_CAL_LANG_REP_MONTH", "month");
DEFINE("_CAL_LANG_REP_YEAR", "year");
DEFINE("_CAL_LANG_REP_NOEVENTSELECTED", "Please select an event first");

// Navigation
DEFINE("_CAL_LANG_VIEWTODAY", "See Today");
DEFINE("_CAL_LANG_VIEWTOCOME", "UpComing this month");
DEFINE("_CAL_LANG_VIEWBYDAY", "See by day");
DEFINE("_CAL_LANG_VIEWBYCAT", "See by categories");
DEFINE("_CAL_LANG_VIEWBYMONTH", "See by month");
DEFINE("_CAL_LANG_VIEWBYYEAR", "See by year");
DEFINE("_CAL_LANG_VIEWBYWEEK", "See by week");
DEFINE("_CAL_LANG_JUMPTO", "Jump to month");  // New 1.4
DEFINE("_CAL_LANG_BACK", "Back");
DEFINE("_CAL_LANG_CLOSE", "Close");
DEFINE("_CAL_LANG_PREVIOUSDAY", "Previous day");
DEFINE("_CAL_LANG_PREVIOUSWEEK", "Previous week");
DEFINE("_CAL_LANG_PREVIOUSMONTH", "Previous month");
DEFINE("_CAL_LANG_PREVIOUSYEAR", "Previous year");
DEFINE("_CAL_LANG_NEXTDAY", "Next day");
DEFINE("_CAL_LANG_NEXTWEEK", "Next week");
DEFINE("_CAL_LANG_NEXTMONTH", "Next month");
DEFINE("_CAL_LANG_NEXTYEAR", "Next year");

DEFINE("_CAL_LANG_ADMINPANEL", "Admin panel");
DEFINE("_CAL_LANG_ADDEVENT", "Add an event");
DEFINE("_CAL_LANG_MYEVENTS", "My events");
DEFINE("_CAL_LANG_DELETE", "Delete");
DEFINE("_CAL_LANG_MODIFY", "Modify");

// Form
DEFINE("_CAL_LANG_HELP", "Help");

DEFINE("_CAL_LANG_CAL_TITLE", "Events");
DEFINE("_CAL_LANG_ADD_TITLE", "Add");
DEFINE("_CAL_LANG_MODIFY_TITLE", "Modify");

DEFINE("_CAL_LANG_REPEAT_DISABLED", "Event Repeating is only applicable if End Date is after Start Date.  Change End Date before configuring event repeat details."); // New for 1.4
DEFINE("_CAL_LANG_EVENT_TITLE", "Subject");
DEFINE("_CAL_LANG_EVENT_COLOR", "Color");
DEFINE("_CAL_LANG_EVENT_CATCOLOR", "Use Category Color");
DEFINE("_CAL_LANG_EVENT_CATEGORY", "Categories");
DEFINE("_CAL_LANG_EVENT_CHOOSE_CATEG", "Please select a category");
DEFINE("_CAL_LANG_EVENT_ACTIVITY", "Activity");
DEFINE("_CAL_LANG_EVENT_URLMAIL_INFO", "For adding a URL or an email address, simply write <br><u>http://www.mysite.com</u> or <u>mailto:my@mail.com</u>");
DEFINE("_CAL_LANG_EVENT_ADRESSE", "Location");
DEFINE("_CAL_LANG_EVENT_CONTACT", "Contact");
DEFINE("_CAL_LANG_EVENT_EXTRA", "Extra Info");
DEFINE("_CAL_LANG_EVENT_AUTHOR_ALIAS", "Author (alias)");
DEFINE("_CAL_LANG_EVENT_STARTDATE", "Start date");
DEFINE("_CAL_LANG_EVENT_ENDDATE", "End date");
DEFINE("_CAL_LANG_EVENT_STARTHOURS", "Start hour");
DEFINE("_CAL_LANG_EVENT_ENDHOURS", "End hour");
DEFINE("_CAL_LANG_EVENT_STARTTIME", "Start Time");
DEFINE("_CAL_LANG_EVENT_ENDTIME", "End Time");
DEFINE("_CAL_LANG_PUB_INFO", "Publication Date");
DEFINE("_CAL_LANG_EVENT_REPEATTYPE", "Repeat type");
DEFINE("_CAL_LANG_EVENT_REPEATDAY", "Repeat day");
DEFINE("_CAL_LANG_EVENT_CHOOSE_WEEKDAYS", "Days of the week");
DEFINE("_CAL_LANG_EVENT_PER", "per");
DEFINE("_CAL_LANG_EVENT_WEEKOPT", "Week(s) of a month repeat type week");

DEFINE("_CAL_LANG_SUBMITPREVIEW", "Preview");
DEFINE("_CAL_LANG_SUBMITCANCEL", "Cancel");
DEFINE("_CAL_LANG_SUBMITSAVE", "Save");

DEFINE("_CAL_LANG_E_WARNWEEKS", "Please select a week.");
DEFINE("_CAL_LANG_E_WARNDAYS", "Please select a day.");

// Admin
DEFINE("_CAL_LANG_EVENT_ALLCAT", "All categories");
DEFINE("_CAL_LANG_EVENT_ACCESSLEVEL", "Access level");
DEFINE("_CAL_LANG_EVENT_HITS", "Hits");
DEFINE("_CAL_LANG_EVENT_STATE", "State");
DEFINE("_CAL_LANG_EVENT_CREATED", "Created");
DEFINE("_CAL_LANG_EVENT_NEWEVENT", "New Event");
DEFINE("_CAL_LANG_EVENT_MODIFIED", "Last modified");
DEFINE("_CAL_LANG_EVENT_NOTMODIFIED", "Not modified");

// dmcd aug 22/04  new warning alert for no specified activity in event entry
DEFINE("_CAL_LANG_WARNACTIVITY", "Some sort of Activity\\ndescription must be entered.");

DEFINE("_CAL_LEGEND_ALL_CATEGORIES", "All Categories ...");  // new for 1.4
DEFINE("_CAL_LEGEND_ALL_CATEGORIES_DESC", "Show events from all categories");  // new for 1.4

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
                  Every Day<br/><i>(default)</i>
                </td>
                <td align="left" valign="top" class="frm_td_bydays">
                  Choose this option for a non-reoccurring single or multi-day event, with a new event occurrence for every day within the Start and End Date range
                </td>
              </tr>
              <tr>
                <td width="60" rowspan="3" align="left" valign="top"><u>By Week</u></td>
                <td width="110" align="left" valign="top" class="frm_td_byweeks">
                  
                    Once Per Week
                  
                </td>
                <td align="left" valign="top" class="frm_td_byweeks">
                  
                  This option allow to choose the weekday of repeat
                  <table border="0" width="100%" height="100%"><tr><td><b>Day number</b> for repeat type each 10/../2003</td></tr><tr><td><b>Day name</b> for repeat type each Monday</td></tr></table>
                  
                </td>
              </tr>
              <tr>
                <td width="110" align="left" valign="top" class="frm_td_byweeks">
                  
                    Multiple Week Days Per Week
                  
                </td>
                <td align="left" valign="top" class="frm_td_byweeks">
                  This option allow to choose on which week days your event will be visible.
                </td>
              </tr>
              <tr>
                <td width="110" align="left" valign="top" class="frm_td_byweeks">
                  <i>Week of Month # <br>For 'Once per Week' and 'Multiple Days Per Week' options above</i></td>
                  <td align="left" valign="top" class="frm_td_byweeks">
                  
                  <table border="0" width="100%" height="100%">
                    <tr><td><b>Week 1 :</b> 1st week of the month</td></tr>
                    <tr><td><b>Week 2 :</b> 2nd week of the month</td></tr>
                    <tr><td><b>Week 3 :</b> 3rd week of the month</td></tr>
                    <tr><td><b>Week 4 :</b> 4th week of the month</td></tr>
                    <tr><td><b>Week 5 :</b> 5th week of the month (if applicable)</td></tr>
                   </table>
                 
                </td>
              </tr>
              <tr>
                <td width="60" rowspan="2" align="left" valign="top"><u>By Month</u></td>
                <td width="110" align="left" valign="top" class="frm_td_bymonth">
                  Once Per Month</td>
                <td align="left" valign="top" class="frm_td_bymonth">
                  
                     This option allow to choose the repeating Day of the Month
                     <table border="0" width="100%" height="100%"><tr><td><b>Day number</b> for repeat type each 10/../2003</td></tr><tr><td><b>Day name</b> for repeat type each Monday</td></tr></table>

                  
                </td>
              </tr>
              <tr>
                <td width="110" align="left" valign="top" class="frm_td_bymonth">
                  
                  End of Each Month
                  
                </td>
                <td align="left" valign="top" class="frm_td_bymonth">
                  
				   The event is on the last day of each month independently of the day number, if that last day
		falls within the date range specified by the Start and End Dates for the event.
                  
                </td>
              </tr>
              <tr>
                <td width="60" rowspan="2" align="left" valign="top"><u>By Year</u></td>
                <td width="110" align="left" valign="top" class="frm_td_byyear">
                  
                  Once Per Year
                  
                </td>
                <td align="left" valign="top" class="frm_td_byyear">
                  
                  This option allow to choose a single day every Year
                  <table border="0" width="100%" height="100%"><tr><td><b>Day number</b> for repeat type each 10/../2003</td></tr><tr><td><b>Day name</b> for repeat type each Monday</td></tr></table>
                  
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