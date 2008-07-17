<?php
/**
 * Events Component for Joomla 1.0.x
 * @translated by Mike Ho @ http://www.dogneighbor.com
 * @version     $Id: traditional_chinese.php 897 2007-11-17 15:32:11Z tstahl $
 * @package     Events
 * @copyright   Copyright (C) 2006-2007 JEvents Project Group
 * @licence     http://www.gnu.org/copyleft/gpl.html
 * @link        http://joomlacode.org/gf/project/jevents
 */

defined( '_VALID_MOS' ) or die( 'Restricted access' );

//Check
DEFINE("_CAL_LANG_INCLUDED", 1);

// new 1.4.0 [mic]
define("_CAL_LANG_LNG",				"zh_TW"); // de|fr|etc... [ DO NOT CHANGE THIS VALUE! ]
define("_CAL_LANG_REPEAT_GRAMMAR",	"1"); // in repeat summary 1 = follow English word orde, 2= follow German word orderr

// used for colorpicker
define("_CAL_LANG_NO_COLOR",			"沒有顏色");
define("_CAL_LANG_COLOR_PICKER",		"顏色選擇器");

// common
define("_CAL_LANG_TIME",				"時間");
define("_CAL_LANG_CLICK_TO_OPEN_EVENT",	"點擊以開啟活動");
define("_CAL_LANG_UNPUBLISHED",		"** 未發佈 **");
define("_CAL_LANG_DESCRIPTION",		"描述");
define("_CAL_LANG_EMAIL_TO_AUTHOR",	"電郵給作者");
define("_CAL_LANG_MAIL_TO_ADMIN",		"活動來自 [ %s ] 由 [ %s ] 發佈");
define("_CAL_LANG_KEYWORD_NOT_VALID",	"不是有效的關鍵字");
define("_CAL_LANG_EVENT_CALENDAR",		"活動行事曆"); // new 1.4

// modul
define("_CAL_LANG_ERR_NO_MOD_CAL",		"活動行事曆\n<br />此模組需要 Events 元件");
define("_CAL_LANG_CLICK_TOSWITCH_DAY",	"前往行事曆 - 現在日子");
define("_CAL_LANG_CLICK_TOSWITCH_MON",	"前往行事曆 - 現在月份");
define("_CAL_LANG_CLICK_TOSWITCH_YEAR",	"前往行事曆 - 現在年份");
define("_CAL_LANG_CLICK_TOSWITCH_PY",	"前往行事曆 - 上年");
define("_CAL_LANG_CLICK_TOSWITCH_PM",	"前往行事曆 - 上月");
define("_CAL_LANG_CLICK_TOSWITCH_NM",	"前往行事曆 - 下月");
define("_CAL_LANG_CLICK_TOSWITCH_NY",	"前往行事曆 - 下年");

// navTableNext
define("_CAL_LANG_NAV_TN_FIRST_LIST",	"首頁清單");
define("_CAL_LANG_NAV_TN_PREV_LIST",	"前頁清單");
define("_CAL_LANG_NAV_TN_NEXT_LIST",	"下頁清單");
define("_CAL_LANG_NAV_TN_LAST_LIST",	"末頁清單");

// calendar monthly display
define("_CAL_LANG_FIRST_SINGLE_DAY_EVENT",		"單一活動");
define("_CAL_LANG_FIRST_DAY_OF_MULTIEVENT",	"多日活動的開始日");
define("_CAL_LANG_LAST_DAY_OF_MULTIEVENT",		"多日活動的結束日");
define("_CAL_LANG_MULTIDAY_EVENT",				"多日活動");
/* ++++++ end mic +++++++++++++ */

// Months
DEFINE("_CAL_LANG_JANUARY", "一月");
DEFINE("_CAL_LANG_FEBRUARY", "二月");
DEFINE("_CAL_LANG_MARCH", "三月");
DEFINE("_CAL_LANG_APRIL", "四月");
DEFINE("_CAL_LANG_MAY", "五月");
DEFINE("_CAL_LANG_JUNE", "六月");
DEFINE("_CAL_LANG_JULY", "七月");
DEFINE("_CAL_LANG_AUGUST", "八月");
DEFINE("_CAL_LANG_SEPTEMBER", "九月");
DEFINE("_CAL_LANG_OCTOBER", "十月");
DEFINE("_CAL_LANG_NOVEMBER", "十一月");
DEFINE("_CAL_LANG_DECEMBER", "十二月");

// Short day names
DEFINE("_CAL_LANG_SUN", "周日");
DEFINE("_CAL_LANG_MON", "週一");
DEFINE("_CAL_LANG_TUE", "週二");
DEFINE("_CAL_LANG_WED", "週三");
DEFINE("_CAL_LANG_THU", "週四");
DEFINE("_CAL_LANG_FRI", "週五");
DEFINE("_CAL_LANG_SAT", "週六");

// Days
DEFINE("_CAL_LANG_SUNDAY", "星期日");
DEFINE("_CAL_LANG_MONDAY", "星期一");
DEFINE("_CAL_LANG_TUESDAY", "星期二");
DEFINE("_CAL_LANG_WEDNESDAY", "星期三");
DEFINE("_CAL_LANG_THURSDAY", "星期四");
DEFINE("_CAL_LANG_FRIDAY", "星期五");
DEFINE("_CAL_LANG_SATURDAY", "星期六");

// Days lettres
DEFINE("_CAL_LANG_SUNDAYSHORT", "日");
DEFINE("_CAL_LANG_MONDAYSHORT", "一");
DEFINE("_CAL_LANG_TUESDAYSHORT", "二");
DEFINE("_CAL_LANG_WEDNESDAYSHORT", "三");
DEFINE("_CAL_LANG_THURSDAYSHORT", "四");
DEFINE("_CAL_LANG_FRIDAYSHORT", "五");
DEFINE("_CAL_LANG_SATURDAYSHORT", "六");

// Repeat type
DEFINE("_CAL_LANG_ALLDAYS", "每天");
DEFINE("_CAL_LANG_EACHWEEK", "每週");
DEFINE("_CAL_LANG_EACHWEEKPAIR", "每雙數周");
DEFINE("_CAL_LANG_EACHWEEKIMPAIR", "每單數周");
DEFINE("_CAL_LANG_EACHMONTH", "每月");
DEFINE("_CAL_LANG_EACHYEAR", "每年");
DEFINE("_CAL_LANG_ONLYDAYS", "只於所選的日子");
DEFINE("_CAL_LANG_EACH", "每");
DEFINE("_CAL_LANG_EACHOF","於每個");
DEFINE("_CAL_LANG_ENDMONTH", "月底");

// Repeat days
DEFINE("_CAL_LANG_BYDAYNUMBER", "依照日期");

// User type
DEFINE("_CAL_LANG_ANONYME", "匿名");

// Post
//PAS D'ACCENTS DANS LES _ACT_
DEFINE("_CAL_LANG_ACT_ADDED", "謝謝您提供訊息 - 我們將儘快加以驗證！"); //NO ACCENT !!
DEFINE("_CAL_LANG_ACT_MODIFIED", "此活動資料已被修改。"); //NO ACCENT !!
DEFINE("_CAL_LANG_ACT_PUBLISHED", "此活動已經發佈.");  //NEW 1.4
DEFINE("_CAL_LANG_ACT_DELETED", "此活動資料已被刪除！"); //NO ACCENT !!
DEFINE("_CAL_LANG_NOPERMISSION", "您沒有取用這項服務的許可權！"); //NO ACCENT !!

DEFINE("_CAL_LANG_MAIL_ADDED", "有新提交的訊息在");
DEFINE("_CAL_LANG_MAIL_MODIFIED", "有新修改的訊息在");

// Presentation
DEFINE("_CAL_LANG_BY", "作者");
DEFINE("_CAL_LANG_FROM", "從");
DEFINE("_CAL_LANG_TO", "到");
DEFINE("_CAL_LANG_ARCHIVE", "活動項目");
DEFINE("_CAL_LANG_WEEK", "星期");
DEFINE("_CAL_LANG_NO_EVENTS", "沒有活動項目");
DEFINE("_CAL_LANG_NO_EVENTFOR", "沒有活動項目於");
DEFINE("_CAL_LANG_NO_EVENTFORTHE", "沒有活動項目於此");
DEFINE("_CAL_LANG_THIS_DAY", "這一天");
DEFINE("_CAL_LANG_THIS_MONTH", "這個月");
DEFINE("_CAL_LANG_LAST_MONTH", "上個月");
DEFINE("_CAL_LANG_NEXT_MONTH", "下個月");
DEFINE("_CAL_LANG_EVENTSFOR", "活動項目於");
DEFINE("_CAL_LANG_SEARCHRESULTS", "關鍵字的搜尋結果"); // new 1.4
DEFINE("_CAL_LANG_EVENTSFORTHE", "活動項目於此");
DEFINE("_CAL_LANG_REP_DAY", "日");
DEFINE("_CAL_LANG_REP_WEEK", "周");
DEFINE("_CAL_LANG_REP_WEEKPAIR", "每隔一星期");
DEFINE("_CAL_LANG_REP_WEEKIMPAIR", "每隔兩星期");
DEFINE("_CAL_LANG_REP_MONTH", "月");
DEFINE("_CAL_LANG_REP_YEAR", "年");
DEFINE("_CAL_LANG_REP_NOEVENTSELECTED", "請先選一項活動");

// Navigation
DEFINE("_CAL_LANG_VIEWTODAY", "今天的活動");
DEFINE("_CAL_LANG_VIEWTOCOME", "本月將到來的活動");
DEFINE("_CAL_LANG_VIEWBYDAY", "以日期檢視");
DEFINE("_CAL_LANG_VIEWBYCAT", "以分類檢視");
DEFINE("_CAL_LANG_VIEWBYMONTH", "以月份檢視");
DEFINE("_CAL_LANG_VIEWBYYEAR", "以年份檢視");
DEFINE("_CAL_LANG_VIEWBYWEEK", "以星期檢視");
DEFINE("_CAL_LANG_JUMPTO", "跳到指定月份");  // New 1.4
DEFINE("_CAL_LANG_BACK", "返回");
DEFINE("_CAL_LANG_CLOSE", "關閉");
DEFINE("_CAL_LANG_PREVIOUSDAY", "前一日");
DEFINE("_CAL_LANG_PREVIOUSWEEK", "前一周");
DEFINE("_CAL_LANG_PREVIOUSMONTH", "前一月");
DEFINE("_CAL_LANG_PREVIOUSYEAR", "前一年");
DEFINE("_CAL_LANG_NEXTDAY", "後一日");
DEFINE("_CAL_LANG_NEXTWEEK", "後一周");
DEFINE("_CAL_LANG_NEXTMONTH", "下個月");
DEFINE("_CAL_LANG_NEXTYEAR", "後一年");

DEFINE("_CAL_LANG_ADMINPANEL", "管理控制臺");
DEFINE("_CAL_LANG_ADDEVENT", "新加一項活動項目");
DEFINE("_CAL_LANG_MYEVENTS", "我的活動項目");
DEFINE("_CAL_LANG_DELETE", "刪除");
DEFINE("_CAL_LANG_MODIFY", "修改");

// Form
DEFINE("_CAL_LANG_HELP", "說明");

DEFINE("_CAL_LANG_CAL_TITLE", "活動");
DEFINE("_CAL_LANG_ADD_TITLE", "新加");
DEFINE("_CAL_LANG_MODIFY_TITLE", "修改");

DEFINE("_CAL_LANG_REPEAT_DISABLED", "重複活動只適用在如果結束日期是在開始日期之後.  在設定活動重複詳情前變更結束日期."); // New for 1.4
DEFINE("_CAL_LANG_EVENT_TITLE", "主題");
DEFINE("_CAL_LANG_EVENT_COLOR", "顏色");
DEFINE("_CAL_LANG_EVENT_CATCOLOR", "使用分類顏色");
DEFINE("_CAL_LANG_EVENT_CATEGORY", "分類");
DEFINE("_CAL_LANG_EVENT_CHOOSE_CATEG", "請選擇一個分類");
DEFINE("_CAL_LANG_EVENT_ACTIVITY", "活動");
DEFINE("_CAL_LANG_EVENT_URLMAIL_INFO", "當加入一個網址或電郵位址時，簡單地寫上 <br><u>http://www.mysite.com</u> 或 <u>mailto:my@mail.com</u>");
DEFINE("_CAL_LANG_EVENT_ADRESSE", "地點");
DEFINE("_CAL_LANG_EVENT_CONTACT", "聯絡");
DEFINE("_CAL_LANG_EVENT_EXTRA", "其他資訊");
DEFINE("_CAL_LANG_EVENT_AUTHOR_ALIAS", "作者 (別名)");
DEFINE("_CAL_LANG_EVENT_STARTDATE", "開始日期");
DEFINE("_CAL_LANG_EVENT_ENDDATE", "結束日期");
DEFINE("_CAL_LANG_EVENT_STARTHOURS", "開始時數");
DEFINE("_CAL_LANG_EVENT_ENDHOURS", "結束時數");
DEFINE("_CAL_LANG_EVENT_STARTTIME", "開始時間");
DEFINE("_CAL_LANG_EVENT_ENDTIME", "結束時間");
DEFINE("_CAL_LANG_PUB_INFO", "發布日期");
DEFINE("_CAL_LANG_EVENT_REPEATTYPE", "重複方式");
DEFINE("_CAL_LANG_EVENT_REPEATDAY", "重複日");
DEFINE("_CAL_LANG_EVENT_CHOOSE_WEEKDAYS", "星期幾");
DEFINE("_CAL_LANG_EVENT_PER", "每");
DEFINE("_CAL_LANG_EVENT_WEEKOPT", "在一個月中的哪幾周要重複");

DEFINE("_CAL_LANG_SUBMITPREVIEW", "預覽");
DEFINE("_CAL_LANG_SUBMITCANCEL", "取消");
DEFINE("_CAL_LANG_SUBMITSAVE", "儲存");

DEFINE("_CAL_LANG_E_WARNWEEKS", "請選擇一個星期");
DEFINE("_CAL_LANG_E_WARNDAYS", "請選擇一個日子");

// Admin
DEFINE("_CAL_LANG_EVENT_ALLCAT", "所有分類");
DEFINE("_CAL_LANG_EVENT_ACCESSLEVEL", "存取等級");
DEFINE("_CAL_LANG_EVENT_HITS", "點擊數");
DEFINE("_CAL_LANG_EVENT_STATE", "狀態");
DEFINE("_CAL_LANG_EVENT_CREATED", "建立");
DEFINE("_CAL_LANG_EVENT_NEWEVENT", "新活動項目");
DEFINE("_CAL_LANG_EVENT_MODIFIED", "最後修改");
DEFINE("_CAL_LANG_EVENT_NOTMODIFIED", "未修改過");

// dmcd aug 22/04  new warning alert for no specified activity in event entry
DEFINE("_CAL_LANG_WARNACTIVITY", "一些活動\\n必須輸入描述.");

DEFINE("_CAL_LEGEND_ALL_CATEGORIES", "所有類別 ...");  // new for 1.4
DEFINE("_CAL_LEGEND_ALL_CATEGORIES_DESC", "顯示活動自所有類別");  // new for 1.4

DEFINE("_CAL_LANG_FORM_HELP_COLOR", <<<END
        <tr>
		  <td width="110" align="left" valign="top">
            <b>顏色</b>
          </td>
          <td>選擇將會顯示於月份日曆顯示的背景顏色.  如果類別方塊已被剔選,
		  顏色預設為類別的顏色 (由管理員定義) 這是於活動的內容分頁下, 及
		  '顏色選擇器' 按鈕會被關閉.</td>
        </tr>
END
);

DEFINE("_CAL_LANG_FORM_HELP",  <<<END
    	<tr>
          <td align="left"><b>日期</b></td>
          <td>選擇你的活動的開始日期及結束日期.</td>
        </tr>
    	<tr>
          <td align="left" valign="top"><b>時間</b></td>
          <td>選擇你的活動的時間.  格式為 <span style='color:blue;font-weight:bold;'>hh:mm {am|pm}</span>.<br/>時間可指定是 12 或 24 hr 格式.<br/><br/><b><i><span style='color:red;'>(新)</span></i> 注意</b> 一個特殊例子發生於 <span style='color:red;font-weight:bold;'>單日過夜活動</span>.  即是當單日活動開始於例如 19:00 及結束於 3:00, 開始及結束日期 <b>必須</b> 為&nbsp;
		   同一日, 及應該設定為子夜前的相關日子.</td>
        </tr>
END
);

DEFINE("_CAL_LANG_FORM_HELP_EXTENDED",  <<<END
        <tr>
    	  <td align="left" valign="top" nowrap><b>重複類別</b></td>
  	  	<td colspan="2"></td>
  		</tr>
  		<tr>
    	  <td colspan="2" align="left" valign="top">
	    	<table width="100%" border="0" cellspacing="2">
              <tr>
                <td width="60" align="left" valign="top"><u>按日子</u></td>
                <td width="110" align="left" valign="top" class="frm_td_bydays">
                  每日<br/><i>(預設)</i>
                </td>
                <td align="left" valign="top" class="frm_td_bydays">
                  非重複發生單日或多日活動選擇此項, 新活動會於開始及結束日期範圍每日發生
                </td>
              </tr>
              <tr>
                <td width="60" rowspan="3" align="left" valign="top"><u>按星期</u></td>
                <td width="110" align="left" valign="top" class="frm_td_byweeks">
                  
                    每星期一次
                  
                </td>
                <td align="left" valign="top" class="frm_td_byweeks">
                  
                  此選項允許選擇重複的日子
                  <table border="0" width="100%" height="100%"><tr><td><b>日子號碼</b> 為重複類別為每 10/../2003</td></tr><tr><td><b>日子名稱</b> 為重複類別為逄星期一</td></tr></table>
                  
                </td>
              </tr>
              <tr>
                <td width="110" align="left" valign="top" class="frm_td_byweeks">
                  
                    每星期多個日子
                  
                </td>
                <td align="left" valign="top" class="frm_td_byweeks">
                  此選項允許選擇活動會於哪些日子顯示.
                </td>
              </tr>
              <tr>
                <td width="110" align="left" valign="top" class="frm_td_byweeks">
                  <i>循環周 # <br>為上述 '每星期一次' 及 每星期多個日子' 選項</i></td>
                  <td align="left" valign="top" class="frm_td_byweeks">
                  
                  <table border="0" width="100%" height="100%">
                    <tr><td><b>循環周 1 :</b> 每月的第一個星期</td></tr>
                    <tr><td><b>循環周 2 :</b> 每月的第二個星期</td></tr>
                    <tr><td><b>循環周 3 :</b> 每月的第三個星期</td></tr>
                    <tr><td><b>循環周 4 :</b> 每月的第四個星期</td></tr>
                    <tr><td><b>循環周 5 :</b> 每月的第五個星期 (如適用)</td></tr>
                   </table>
                 
                </td>
              </tr>
              <tr>
                <td width="60" rowspan="2" align="left" valign="top"><u>按月份</u></td>
                <td width="110" align="left" valign="top" class="frm_td_bymonth">
                  每月一次</td>
                <td align="left" valign="top" class="frm_td_bymonth">
                  
                     此選項允許選擇月份的重複日子
                     <table border="0" width="100%" height="100%"><tr><td><b>日子號碼</b> 為重複類別為每 10/../2003</td></tr><tr><td><b>日子名稱</b> 為重複類別為逄星期一</td></tr></table>

                  
                </td>
              </tr>
              <tr>
                <td width="110" align="left" valign="top" class="frm_td_bymonth">
                  
                  每月的結束
                  
                </td>
                <td align="left" valign="top" class="frm_td_bymonth">
                  
				   如果該最後日子落在活動的指定開始及結束範圍, 不論日子號碼活動是於每月的最後日子.

                  
                </td>
              </tr>
              <tr>
                <td width="60" rowspan="2" align="left" valign="top"><u>按年份</u></td>
                <td width="110" align="left" valign="top" class="frm_td_byyear">
                  
                  每年一次
                  
                </td>
                <td align="left" valign="top" class="frm_td_byyear">
                  
                  此選項允許選擇每年的單日
                  <table border="0" width="100%" height="100%"><tr><td><b>日子號碼</b> 為重複類別為每 10/../2003</td></tr><tr><td><b>日子名稱</b> 為重複類別為逄星期一</td></tr></table>
                  
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
DEFINE("_CAL_LANG_WARNTITLE",	"缺少了標題");
DEFINE("_CAL_LANG_WARNCAT",		"缺少了分類");
DEFINE("_CAL_LANG_STATE",		"狀態");
DEFINE("_CAL_LANG_HITS",		"點擊");
DEFINE("_CAL_LANG_CREATED",		"已建立");
DEFINE("_CAL_LANG_LAST_MOD",	"最後修改");
DEFINE("_CAL_LANG_EDIT",		_E_EDIT);
DEFINE("_CAL_LANG_SEARCH_TITLE","搜尋");
DEFINE("_CAL_LANG_PRINT",		_CMN_PRINT);

?>