<?php
/**
 * Events Component for Joomla 1.0.x
 *
 * @version     $Id: russian-utf8.php 991 2008-03-10 19:55:48Z tstahl $
 * @package     Events
 * @copyright   Copyright (C) 2006-2008 JEvents Project Group
 * @licence     http://www.gnu.org/copyleft/gpl.html
 * @link        http://joomlacode.org/gf/project/jevents
 * @encoding    uft-8
 */

defined("_VALID_MOS") or die("Direct Access to this location is not allowed");

//Check
DEFINE("_CAL_LANG_INCLUDED", 1);

// new 1.4.0 [mic]
define("_CAL_LANG_LNG",				"XXXXen"); // de|fr|etc... [ DO NOT CHANGE THIS VALUE! ]

// used for colorpicker
define("_CAL_LANG_NO_COLOR",			"Без цвета");
define("_CAL_LANG_COLOR_PICKER",		"Выбрать цвет");

// common
define("_CAL_LANG_TIME",				"Время");
define("_CAL_LANG_CLICK_TO_OPEN_EVENT",	"Нажмите, чтобы открыть событие");
define("_CAL_LANG_UNPUBLISHED",		"** Не опубликовано **");
define("_CAL_LANG_DESCRIPTION",		"Описание");
define("_CAL_LANG_EMAIL_TO_AUTHOR",	"Написать автору");
define("_CAL_LANG_MAIL_TO_ADMIN",		"Событие создано из [ %s ] пользователем [ %s ]");
define("_CAL_LANG_KEYWORD_NOT_VALID",	"Неверное ключевое слово");
define("_CAL_LANG_EVENT_CALENDAR",		"Календарь событий"); // new 1.4

// modul
define("_CAL_LANG_ERR_NO_MOD_CAL",		"Events Calendar\n<br />Данный модуль требует компонента Events");
define("_CAL_LANG_CLICK_TOSWITCH_DAY",	"Перейти к текущему дню");
define("_CAL_LANG_CLICK_TOSWITCH_MON",	"Перейти к текущему месяцу");
define("_CAL_LANG_CLICK_TOSWITCH_YEAR",	"Перейти к текущему году");
define("_CAL_LANG_CLICK_TOSWITCH_PY",	"Перейти к предыдущему году");
define("_CAL_LANG_CLICK_TOSWITCH_PM",	"Перейти к предыдущему месяцу");
define("_CAL_LANG_CLICK_TOSWITCH_NM",	"Перейти к следующему месяцу");
define("_CAL_LANG_CLICK_TOSWITCH_NY",	"Перейти к следующему году");

// navTableNext
define("_CAL_LANG_NAV_TN_FIRST_LIST",	"Первый список");
define("_CAL_LANG_NAV_TN_PREV_LIST",	"Предыдущий список");
define("_CAL_LANG_NAV_TN_NEXT_LIST",	"Следующий список");
define("_CAL_LANG_NAV_TN_LAST_LIST",	"Последний список");

// calendar monthly display
define("_CAL_LANG_FIRST_SINGLE_DAY_EVENT",		"Однократное событие");
define("_CAL_LANG_FIRST_DAY_OF_MULTIEVENT",	"Первый день повторяющегося события");
define("_CAL_LANG_LAST_DAY_OF_MULTIEVENT",		"Последний день повторяющегося события");
define("_CAL_LANG_MULTIDAY_EVENT",				"Повторяющееся событие");
/* ++++++ end mic +++++++++++++ */

// Months
DEFINE("_CAL_LANG_JANUARY", "Январь");
DEFINE("_CAL_LANG_FEBRUARY", "Февраль");
DEFINE("_CAL_LANG_MARCH", "Март");
DEFINE("_CAL_LANG_APRIL", "Апрель");
DEFINE("_CAL_LANG_MAY", "Май");
DEFINE("_CAL_LANG_JUNE", "Июнь");
DEFINE("_CAL_LANG_JULY", "Июль");
DEFINE("_CAL_LANG_AUGUST", "Август");
DEFINE("_CAL_LANG_SEPTEMBER", "Сентябрь");
DEFINE("_CAL_LANG_OCTOBER", "Октябрь");
DEFINE("_CAL_LANG_NOVEMBER", "Ноябрь");
DEFINE("_CAL_LANG_DECEMBER", "Декабрь");

// Short day names
DEFINE("_CAL_LANG_SUN", "Вс");
DEFINE("_CAL_LANG_MON", "Пн");
DEFINE("_CAL_LANG_TUE", "Вт");
DEFINE("_CAL_LANG_WED", "Ср");
DEFINE("_CAL_LANG_THU", "Чт");
DEFINE("_CAL_LANG_FRI", "Пт");
DEFINE("_CAL_LANG_SAT", "Сб");

// Days
DEFINE("_CAL_LANG_SUNDAY", "Воскресенье");
DEFINE("_CAL_LANG_MONDAY", "Понедельник");
DEFINE("_CAL_LANG_TUESDAY", "Вторник");
DEFINE("_CAL_LANG_WEDNESDAY", "Среда");
DEFINE("_CAL_LANG_THURSDAY", "Четверг");
DEFINE("_CAL_LANG_FRIDAY", "Пятница");
DEFINE("_CAL_LANG_SATURDAY", "Суббота");

// Days letters
DEFINE("_CAL_LANG_SUNDAYSHORT", "Вс");
DEFINE("_CAL_LANG_MONDAYSHORT", "Пн");
DEFINE("_CAL_LANG_TUESDAYSHORT", "Вт");
DEFINE("_CAL_LANG_WEDNESDAYSHORT", "Ср");
DEFINE("_CAL_LANG_THURSDAYSHORT", "Вт");
DEFINE("_CAL_LANG_FRIDAYSHORT", "Пт");
DEFINE("_CAL_LANG_SATURDAYSHORT", "Вс");

// Repeat type
DEFINE("_CAL_LANG_ALLDAYS", "Каждый день");
DEFINE("_CAL_LANG_EACHWEEK", "Каждую неделю");
DEFINE("_CAL_LANG_EACHWEEKPAIR", "Каждую четную неделю");
DEFINE("_CAL_LANG_EACHWEEKIMPAIR", "Каждую нечетную неделю");
DEFINE("_CAL_LANG_EACHMONTH", "Каждый месяц");
DEFINE("_CAL_LANG_EACHYEAR", "Каждый год");
DEFINE("_CAL_LANG_ONLYDAYS", "Только выбранные дни");
DEFINE("_CAL_LANG_EACH", "Кажд.");
DEFINE("_CAL_LANG_EACHOF","Кажд.");
DEFINE("_CAL_LANG_ENDMONTH", "конец месяца");

// Repeat days
DEFINE("_CAL_LANG_BYDAYNUMBER", "Тем же числам");

// User type
DEFINE("_CAL_LANG_ANONYME", "Анонимный");

// Post
//PAS D'ACCENTS DANS LES _ACT_
DEFINE("_CAL_LANG_ACT_ADDED", "Благодарим вас за добавление события! Мы проверим и опубликуем его в ближайшее время"); //NO ACCENT !!
DEFINE("_CAL_LANG_ACT_MODIFIED", "Данное событие было изменено."); //NO ACCENT !!
DEFINE("_CAL_LANG_ACT_PUBLISHED", "Данное событие было опубликовано.");  //NEW 1.4
DEFINE("_CAL_LANG_ACT_DELETED", "Данное событие было удалено!"); //NO ACCENT !!
DEFINE("_CAL_LANG_NOPERMISSION", "У вас нет доступа к этому сервису!"); //NO ACCENT !!

DEFINE("_CAL_LANG_MAIL_ADDED", "Новое добавление:");
DEFINE("_CAL_LANG_MAIL_MODIFIED", "Новое изменение");

// Presentation
DEFINE("_CAL_LANG_BY", "Представлено:");
DEFINE("_CAL_LANG_FROM", "С");
DEFINE("_CAL_LANG_TO", "До");
DEFINE("_CAL_LANG_ARCHIVE", "Архивы");
DEFINE("_CAL_LANG_WEEK", "Неделю");
DEFINE("_CAL_LANG_NO_EVENTS", "Нет событий");
DEFINE("_CAL_LANG_NO_EVENTFOR", "Нет событий за:");
DEFINE("_CAL_LANG_NO_EVENTFORTHE", "Нет событий за:");
DEFINE("_CAL_LANG_THIS_DAY", "Этот день");
DEFINE("_CAL_LANG_THIS_MONTH", "В этом месяце...");
DEFINE("_CAL_LANG_LAST_MONTH", "В прошлом месяце...");
DEFINE("_CAL_LANG_NEXT_MONTH", "В следующем месяце...");
DEFINE("_CAL_LANG_EVENTSFOR", "События за:");
DEFINE("_CAL_LANG_SEARCHRESULTS", "Результаты поиска по ключевому слову"); // new 1.4
DEFINE("_CAL_LANG_EVENTSFORTHE", "События за");
DEFINE("_CAL_LANG_REP_DAY", "день");
DEFINE("_CAL_LANG_REP_WEEK", "неделю");
DEFINE("_CAL_LANG_REP_WEEKPAIR", "Четная неделя");
DEFINE("_CAL_LANG_REP_WEEKIMPAIR", "Нечетная неделя");
DEFINE("_CAL_LANG_REP_MONTH", "месяц по:");
DEFINE("_CAL_LANG_REP_YEAR", "год по:");
DEFINE("_CAL_LANG_REP_NOEVENTSELECTED", "Сначала выберите событие, пожалуйста");

// Navigation
DEFINE("_CAL_LANG_VIEWTODAY", "События&nbsp;на&nbsp;сегодня");
DEFINE("_CAL_LANG_VIEWTOCOME", "События&nbsp;в&nbsp;этом&nbsp;месяце");
DEFINE("_CAL_LANG_VIEWBYDAY", "Посмотреть на день");
DEFINE("_CAL_LANG_VIEWBYCAT", "Посмотреть по категориям");
DEFINE("_CAL_LANG_VIEWBYMONTH", "Посмотреть на месяц");
DEFINE("_CAL_LANG_VIEWBYYEAR", "Посмотреть на год");
DEFINE("_CAL_LANG_VIEWBYWEEK", "Посмотреть на неделю");
DEFINE("_CAL_LANG_JUMPTO", "Перейти к месяцу");  // New 1.4
DEFINE("_CAL_LANG_BACK", "Обратно");
DEFINE("_CAL_LANG_CLOSE", "Close");
DEFINE("_CAL_LANG_PREVIOUSDAY", "Предыдущий день");
DEFINE("_CAL_LANG_PREVIOUSWEEK", "Предыдущая неделя");
DEFINE("_CAL_LANG_PREVIOUSMONTH", "Предыдущий месяц");
DEFINE("_CAL_LANG_PREVIOUSYEAR", "Предыдущий год");
DEFINE("_CAL_LANG_NEXTDAY", "Следующий день");
DEFINE("_CAL_LANG_NEXTWEEK", "Следующая неделя");
DEFINE("_CAL_LANG_NEXTMONTH", "В следующем месяце...");
DEFINE("_CAL_LANG_NEXTYEAR", "Следующий год");

DEFINE("_CAL_LANG_ADMINPANEL", "Админ. панель");
DEFINE("_CAL_LANG_ADDEVENT", ":: Добавить событие");
DEFINE("_CAL_LANG_MYEVENTS", ":: Мои события");
DEFINE("_CAL_LANG_DELETE", "Удалить");
DEFINE("_CAL_LANG_MODIFY", "Изменить");

// Form
DEFINE("_CAL_LANG_HELP", "Помощь");

DEFINE("_CAL_LANG_CAL_TITLE", "События");
DEFINE("_CAL_LANG_ADD_TITLE", "Добавить");
DEFINE("_CAL_LANG_MODIFY_TITLE", "Изменить");

DEFINE("_CAL_LANG_REPEAT_DISABLED", "Повторение возможно, только при условии, что дата окончания установлена позже даты начала события. Измените дату окончания перед тем, как устанавливать настройки повторения события."); // New for 1.4DEFINE("_CAL_LANG_EVENT_TITLE", "Событие");
DEFINE("_CAL_LANG_EVENT_COLOR", "Цвет");
DEFINE("_CAL_LANG_EVENT_CATCOLOR", "Использовать цвет");
DEFINE("_CAL_LANG_EVENT_CATEGORY", "Категория");
DEFINE("_CAL_LANG_EVENT_CHOOSE_CATEG", "Выберите категорию");
DEFINE("_CAL_LANG_EVENT_ACTIVITY", "Действие");
DEFINE("_CAL_LANG_EVENT_URLMAIL_INFO", "Для добавления URL или E-mail, заполняйте в следующем формате <u>http://www.mysite.com</u> или <u>mailto:my@mail.com</u>");
DEFINE("_CAL_LANG_EVENT_ADRESSE", "Ваше местоположение");
DEFINE("_CAL_LANG_EVENT_CONTACT", "Контакт");
DEFINE("_CAL_LANG_EVENT_EXTRA", "Дополнительная информация");
DEFINE("_CAL_LANG_EVENT_AUTHOR_ALIAS", "Автор (Псевдоним)");
DEFINE("_CAL_LANG_EVENT_STARTDATE", "Дата начала публикации");
DEFINE("_CAL_LANG_EVENT_ENDDATE", "Дата окончания публикации");
DEFINE("_CAL_LANG_EVENT_STARTHOURS", "Время начала");
DEFINE("_CAL_LANG_EVENT_ENDHOURS", "Время конца");
DEFINE("_CAL_LANG_EVENT_STARTTIME", "Время начала");
DEFINE("_CAL_LANG_EVENT_ENDTIME", "Время конца");
DEFINE("_CAL_LANG_PUB_INFO", "Публикуемая информация");
DEFINE("_CAL_LANG_EVENT_REPEATTYPE", "Тип повтора");
DEFINE("_CAL_LANG_EVENT_REPEATDAY", "День повтора");
DEFINE("_CAL_LANG_EVENT_CHOOSE_WEEKDAYS", "Дней в неделю");
DEFINE("_CAL_LANG_EVENT_PER", "в");
DEFINE("_CAL_LANG_EVENT_WEEKOPT", "Неделя(и) месяца по порядковому номеру");

DEFINE("_CAL_LANG_SUBMITPREVIEW", "Предпросмотр");
DEFINE("_CAL_LANG_SUBMITCANCEL", "Отмена");
DEFINE("_CAL_LANG_SUBMITSAVE", "Сохранить");

DEFINE("_CAL_LANG_E_WARNWEEKS", "Предупреждение.");
DEFINE("_CAL_LANG_E_WARNDAYS", "Предупреждение.");

// Admin
DEFINE("_CAL_LANG_EVENT_ALLCAT", "Все категории");
DEFINE("_CAL_LANG_EVENT_ACCESSLEVEL", "Уровень доступа");
DEFINE("_CAL_LANG_EVENT_HITS", "Показов");
DEFINE("_CAL_LANG_EVENT_STATE", "Состояние");
DEFINE("_CAL_LANG_EVENT_CREATED", "Дата создания");
DEFINE("_CAL_LANG_EVENT_NEWEVENT", "Новое событие");
DEFINE("_CAL_LANG_EVENT_MODIFIED", "Дата последнего изменения");
DEFINE("_CAL_LANG_EVENT_NOTMODIFIED", "Не изменено");

// dmcd aug 22/04  new warning alert for no specified activity in event entry
DEFINE("_CAL_LANG_WARNACTIVITY", "Необходимо ввести\\nкакое-либо описание события.");

DEFINE("_CAL_LEGEND_ALL_CATEGORIES", "Все категории...");  // new for 1.4
DEFINE("_CAL_LEGEND_ALL_CATEGORIES_DESC", "Показать события всех категорий");  // new for 1.4

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
