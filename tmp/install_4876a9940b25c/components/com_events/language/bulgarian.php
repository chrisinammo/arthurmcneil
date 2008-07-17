<?php
/**
 * Events Component for Joomla 1.0.x
 *
 * @version     $Id: bulgarian.php 991 2008-03-10 19:55:48Z tstahl $
 * @package     Events
 * @copyright   Copyright (C) 2006 JEvents Project Group
 * @licence     http://www.gnu.org/copyleft/gpl.html
 * @link        http://joomlacode.org/gf/project/jevents
 * @encoding    windows-1251
 */

defined("_VALID_MOS") or die("Direct Access to this location is not allowed");

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
DEFINE("_CAL_LANG_JANUARY", "Януари");
DEFINE("_CAL_LANG_FEBRUARY", "Февруари");
DEFINE("_CAL_LANG_MARCH", "Март");
DEFINE("_CAL_LANG_APRIL", "Април");
DEFINE("_CAL_LANG_MAY", "Май");
DEFINE("_CAL_LANG_JUNE", "Юни");
DEFINE("_CAL_LANG_JULY", "Юли");
DEFINE("_CAL_LANG_AUGUST", "Август");
DEFINE("_CAL_LANG_SEPTEMBER", "Септември");
DEFINE("_CAL_LANG_OCTOBER", "Октомври");
DEFINE("_CAL_LANG_NOVEMBER", "Ноември");
DEFINE("_CAL_LANG_DECEMBER", "Декември");

// Short day names
DEFINE("_CAL_LANG_SUN", "Нед");
DEFINE("_CAL_LANG_MON", "Пон");
DEFINE("_CAL_LANG_TUE", "Вт");
DEFINE("_CAL_LANG_WED", "Ср");
DEFINE("_CAL_LANG_THU", "Чет");
DEFINE("_CAL_LANG_FRI", "Пет");
DEFINE("_CAL_LANG_SAT", "Съб");

// Days
DEFINE("_CAL_LANG_SUNDAY", "Неделя");
DEFINE("_CAL_LANG_MONDAY", "Понеделник");
DEFINE("_CAL_LANG_TUESDAY", "Вторник");
DEFINE("_CAL_LANG_WEDNESDAY", "Сряда");
DEFINE("_CAL_LANG_THURSDAY", "Четвъртък");
DEFINE("_CAL_LANG_FRIDAY", "Петък");
DEFINE("_CAL_LANG_SATURDAY", "Събота");

// Days lettres
DEFINE("_CAL_LANG_SUNDAYSHORT", "С");
DEFINE("_CAL_LANG_MONDAYSHORT", "П");
DEFINE("_CAL_LANG_TUESDAYSHORT", "В");
DEFINE("_CAL_LANG_WEDNESDAYSHORT", "С");
DEFINE("_CAL_LANG_THURSDAYSHORT", "В");
DEFINE("_CAL_LANG_FRIDAYSHORT", "П");
DEFINE("_CAL_LANG_SATURDAYSHORT", "С");

// Repeat type
DEFINE("_CAL_LANG_ALLDAYS", "Всички дни");
DEFINE("_CAL_LANG_EACHWEEK", "Всяка седмица");
DEFINE("_CAL_LANG_EACHWEEKPAIR", "Всяко седмично събитие");
DEFINE("_CAL_LANG_EACHWEEKIMPAIR", "Всяка минала седмица");
DEFINE("_CAL_LANG_EACHMONTH", "Всеки месец");
DEFINE("_CAL_LANG_EACHYEAR", "Всяка година");
DEFINE("_CAL_LANG_ONLYDAYS", "Само посочените дни");
DEFINE("_CAL_LANG_EACH", "Всяко");
DEFINE("_CAL_LANG_EACHOF","от всяко");
DEFINE("_CAL_LANG_ENDMONTH", "край на месеца");

// Repeat days
DEFINE("_CAL_LANG_BYDAYNUMBER", "По номер на ден");

// User type
DEFINE("_CAL_LANG_ANONYME", "Анонимко");

// Post
//PAS D'ACCENTS DANS LES _ACT_
DEFINE("_CAL_LANG_ACT_ADDED", "Благодарим за Вашата добавка - Ние ще разгледаме Вашето предложение!"); //NO ACCENT !!
DEFINE("_CAL_LANG_ACT_MODIFIED", "Събитието беше променено."); //NO ACCENT !!
DEFINE("_CAL_LANG_ACT_PUBLISHED", "XXXXThis event has been published.");  //NEW 1.4
DEFINE("_CAL_LANG_ACT_DELETED", "Събитието беше изтрито!"); //NO ACCENT !!
DEFINE("_CAL_LANG_NOPERMISSION", "Нямате достъп до тази услуга!"); //NO ACCENT !!

DEFINE("_CAL_LANG_MAIL_ADDED", "Ново въведение в");
DEFINE("_CAL_LANG_MAIL_MODIFIED", "Нова промяна в");

// Presentation
DEFINE("_CAL_LANG_BY", "от");
DEFINE("_CAL_LANG_FROM", "От");
DEFINE("_CAL_LANG_TO", "До");
DEFINE("_CAL_LANG_ARCHIVE", "Архив");
DEFINE("_CAL_LANG_WEEK", "седмицата");
DEFINE("_CAL_LANG_NO_EVENTS", "Няма събития");
DEFINE("_CAL_LANG_NO_EVENTFOR", "Няма събития за");
DEFINE("_CAL_LANG_NO_EVENTFORTHE", "Няма събития за");
DEFINE("_CAL_LANG_THIS_DAY", "този ден");
DEFINE("_CAL_LANG_THIS_MONTH", "Този месец");
DEFINE("_CAL_LANG_LAST_MONTH", "Последен Месец");
DEFINE("_CAL_LANG_NEXT_MONTH", "Следващ месец");
DEFINE("_CAL_LANG_EVENTSFOR", "Събитие за");
DEFINE("_CAL_LANG_SEARCHRESULTS", "XXXXSearch Results for keyword"); // new 1.4
DEFINE("_CAL_LANG_EVENTSFORTHE", "Събитие за");
DEFINE("_CAL_LANG_REP_DAY", "ден");
DEFINE("_CAL_LANG_REP_WEEK", "седмица");
DEFINE("_CAL_LANG_REP_WEEKPAIR", "седмично събитие");
DEFINE("_CAL_LANG_REP_WEEKIMPAIR", "минала седмица");
DEFINE("_CAL_LANG_REP_MONTH", "месец");
DEFINE("_CAL_LANG_REP_YEAR", "година");
DEFINE("_CAL_LANG_REP_NOEVENTSELECTED", "Please select an event first");

// Navigation
DEFINE("_CAL_LANG_VIEWTODAY", "Отиди до Днес");
DEFINE("_CAL_LANG_VIEWTOCOME", "Предстоящи събития през този Месец");
DEFINE("_CAL_LANG_VIEWBYDAY", "Виж по ден");
DEFINE("_CAL_LANG_VIEWBYCAT", "Виж по категории");
DEFINE("_CAL_LANG_VIEWBYMONTH", "Виж по месец");
DEFINE("_CAL_LANG_VIEWBYYEAR", "Виж по година");
DEFINE("_CAL_LANG_VIEWBYWEEK", "Виж по седмица");
DEFINE("_CAL_LANG_JUMPTO", "XXXXJump to specific month");  // New 1.4
DEFINE("_CAL_LANG_BACK", "Назад");
DEFINE("_CAL_LANG_CLOSE", "Close");
DEFINE("_CAL_LANG_PREVIOUSDAY", "Предишен ден");
DEFINE("_CAL_LANG_PREVIOUSWEEK", "Предишна седмица");
DEFINE("_CAL_LANG_PREVIOUSMONTH", "Предишен месец");
DEFINE("_CAL_LANG_PREVIOUSYEAR", "Предишна година");
DEFINE("_CAL_LANG_NEXTDAY", "Следващ ден");
DEFINE("_CAL_LANG_NEXTWEEK", "Следваща седмица");
DEFINE("_CAL_LANG_NEXTMONTH", "Следващ месец");
DEFINE("_CAL_LANG_NEXTYEAR", "Следваща година");

DEFINE("_CAL_LANG_ADMINPANEL", "Администрация");
DEFINE("_CAL_LANG_ADDEVENT", "Добави събитие");
DEFINE("_CAL_LANG_MYEVENTS", "Мои събития");
DEFINE("_CAL_LANG_DELETE", "Изтрий");
DEFINE("_CAL_LANG_MODIFY", "Промени");

// Form
DEFINE("_CAL_LANG_HELP", "Помощ");

DEFINE("_CAL_LANG_CAL_TITLE", "Събития");
DEFINE("_CAL_LANG_ADD_TITLE", "Добави");
DEFINE("_CAL_LANG_MODIFY_TITLE", "Промени");

DEFINE("_CAL_LANG_REPEAT_DISABLED", "XXXXEvent Repeating is only applicable if End Date is after Start Date.  Change End Date before configuring event repeat details."); // New for 1.4
DEFINE("_CAL_LANG_EVENT_TITLE", "Заглавие");
DEFINE("_CAL_LANG_EVENT_COLOR", "Цвят");
DEFINE("_CAL_LANG_EVENT_CATCOLOR", "Use Category Color");
DEFINE("_CAL_LANG_EVENT_CATEGORY", "Категория");
DEFINE("_CAL_LANG_EVENT_CHOOSE_CATEG", "Моля посочете категория");
DEFINE("_CAL_LANG_EVENT_ACTIVITY", "Активност");
DEFINE("_CAL_LANG_EVENT_URLMAIL_INFO", "За добавяне на URL или email адрес просто напишете<br><u>http://www.mysite.com</u> или<u>mailto:my@mail.com</u>");
DEFINE("_CAL_LANG_EVENT_ADRESSE", "Положение");
DEFINE("_CAL_LANG_EVENT_CONTACT", "Контакт");
DEFINE("_CAL_LANG_EVENT_EXTRA", "Екстра инфо");
DEFINE("_CAL_LANG_EVENT_AUTHOR_ALIAS", "Автор (съюзници)");
DEFINE("_CAL_LANG_EVENT_STARTDATE", "Стартираща дата");
DEFINE("_CAL_LANG_EVENT_ENDDATE", "Дата на спиране");
DEFINE("_CAL_LANG_EVENT_STARTHOURS", "Стартиращ час");
DEFINE("_CAL_LANG_EVENT_ENDHOURS", "Час на спиране");
DEFINE("_CAL_LANG_EVENT_STARTTIME", "Стартиращ час");
DEFINE("_CAL_LANG_EVENT_ENDTIME", "Час на спиране");
DEFINE("_CAL_LANG_PUB_INFO", "Публикуване на информацията");
DEFINE("_CAL_LANG_EVENT_REPEATTYPE", "Повтори типа");
DEFINE("_CAL_LANG_EVENT_REPEATDAY", "Повтори деня");
DEFINE("_CAL_LANG_EVENT_CHOOSE_WEEKDAYS", "Ден от седмицата");
DEFINE("_CAL_LANG_EVENT_PER", "per");
DEFINE("_CAL_LANG_EVENT_WEEKOPT", "Week(s) of a month repeat type week");

DEFINE("_CAL_LANG_SUBMITPREVIEW", "Преглед");
DEFINE("_CAL_LANG_SUBMITCANCEL", "Отмени");
DEFINE("_CAL_LANG_SUBMITSAVE", "Съхрани");

DEFINE("_CAL_LANG_E_WARNWEEKS", "Veuillez choisir une semaine.");
DEFINE("_CAL_LANG_E_WARNDAYS", "Veuillez choisir un jour.");

// Admin
DEFINE("_CAL_LANG_EVENT_ALLCAT", "Всички категории");
DEFINE("_CAL_LANG_EVENT_ACCESSLEVEL", "Ниво на достъп");
DEFINE("_CAL_LANG_EVENT_HITS", "Посещения");
DEFINE("_CAL_LANG_EVENT_STATE", "Държава");
DEFINE("_CAL_LANG_EVENT_CREATED", "Създадено");
DEFINE("_CAL_LANG_EVENT_NEWEVENT", "Ново Събитие");
DEFINE("_CAL_LANG_EVENT_MODIFIED", "Последна промяна");
DEFINE("_CAL_LANG_EVENT_NOTMODIFIED", "Не е променяно");

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
