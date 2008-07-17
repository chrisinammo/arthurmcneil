<?php
/**
 * Events Component for Joomla 1.0.x
 * @translated by Mike Ho @ http://www.dogneighbor.com
 * @version     $Id: simplified_chinese.php 897 2007-11-17 15:32:11Z tstahl $
 * @package     Events
 * @copyright   Copyright (C) 2006-2007 JEvents Project Group
 * @licence     http://www.gnu.org/copyleft/gpl.html
 * @link        http://joomlacode.org/gf/project/jevents
 */

defined( '_VALID_MOS' ) or die( 'Restricted access' );

//Check
DEFINE("_CAL_LANG_INCLUDED", 1);

// new 1.4.0 [mic]
define("_CAL_LANG_LNG",				"zh_CN"); // de|fr|etc... [ DO NOT CHANGE THIS VALUE! ]
define("_CAL_LANG_REPEAT_GRAMMAR",	"1"); // in repeat summary 1 = follow English word orde, 2= follow German word orderr

// used for colorpicker
define("_CAL_LANG_NO_COLOR",			"没有颜色");
define("_CAL_LANG_COLOR_PICKER",		"颜色选择器");

// common
define("_CAL_LANG_TIME",				"时间");
define("_CAL_LANG_CLICK_TO_OPEN_EVENT",	"点击以开启活动");
define("_CAL_LANG_UNPUBLISHED",		"** 未发布 **");
define("_CAL_LANG_DESCRIPTION",		"描述");
define("_CAL_LANG_EMAIL_TO_AUTHOR",	"电邮给作者");
define("_CAL_LANG_MAIL_TO_ADMIN",		"活动来自 [ %s ] 由 [ %s ] 发布");
define("_CAL_LANG_KEYWORD_NOT_VALID",	"不是有效的关键词");
define("_CAL_LANG_EVENT_CALENDAR",		"活动行事历"); // new 1.4

// modul
define("_CAL_LANG_ERR_NO_MOD_CAL",		"活动行事历\n<br />此模块需要 Events 组件");
define("_CAL_LANG_CLICK_TOSWITCH_DAY",	"前往行事历 - 现在日子");
define("_CAL_LANG_CLICK_TOSWITCH_MON",	"前往行事历 - 现在月份");
define("_CAL_LANG_CLICK_TOSWITCH_YEAR",	"前往行事历 - 现在年份");
define("_CAL_LANG_CLICK_TOSWITCH_PY",	"前往行事历 - 上年");
define("_CAL_LANG_CLICK_TOSWITCH_PM",	"前往行事历 - 上月");
define("_CAL_LANG_CLICK_TOSWITCH_NM",	"前往行事历 - 下月");
define("_CAL_LANG_CLICK_TOSWITCH_NY",	"前往行事历 - 下年");

// navTableNext
define("_CAL_LANG_NAV_TN_FIRST_LIST",	"首页清单");
define("_CAL_LANG_NAV_TN_PREV_LIST",	"前页清单");
define("_CAL_LANG_NAV_TN_NEXT_LIST",	"下页清单");
define("_CAL_LANG_NAV_TN_LAST_LIST",	"末页清单");

// calendar monthly display
define("_CAL_LANG_FIRST_SINGLE_DAY_EVENT",		"单一活动");
define("_CAL_LANG_FIRST_DAY_OF_MULTIEVENT",	"多日活动的开始日");
define("_CAL_LANG_LAST_DAY_OF_MULTIEVENT",		"多日活动的结束日");
define("_CAL_LANG_MULTIDAY_EVENT",				"多日活动");
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
DEFINE("_CAL_LANG_MON", "周一");
DEFINE("_CAL_LANG_TUE", "周二");
DEFINE("_CAL_LANG_WED", "周三");
DEFINE("_CAL_LANG_THU", "周四");
DEFINE("_CAL_LANG_FRI", "周五");
DEFINE("_CAL_LANG_SAT", "周六");

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
DEFINE("_CAL_LANG_EACHWEEK", "每周");
DEFINE("_CAL_LANG_EACHWEEKPAIR", "每双数周");
DEFINE("_CAL_LANG_EACHWEEKIMPAIR", "每单数周");
DEFINE("_CAL_LANG_EACHMONTH", "每月");
DEFINE("_CAL_LANG_EACHYEAR", "每年");
DEFINE("_CAL_LANG_ONLYDAYS", "只于所选的日子");
DEFINE("_CAL_LANG_EACH", "每");
DEFINE("_CAL_LANG_EACHOF","于每个");
DEFINE("_CAL_LANG_ENDMONTH", "月底");

// Repeat days
DEFINE("_CAL_LANG_BYDAYNUMBER", "依照日期");

// User type
DEFINE("_CAL_LANG_ANONYME", "匿名");

// Post
//PAS D'ACCENTS DANS LES _ACT_
DEFINE("_CAL_LANG_ACT_ADDED", "谢谢您提供讯息 - 我们将尽快加以验证！"); //NO ACCENT !!
DEFINE("_CAL_LANG_ACT_MODIFIED", "此活动资料已被修改。"); //NO ACCENT !!
DEFINE("_CAL_LANG_ACT_PUBLISHED", "此活动已经发布.");  //NEW 1.4
DEFINE("_CAL_LANG_ACT_DELETED", "此活动资料已被删除！"); //NO ACCENT !!
DEFINE("_CAL_LANG_NOPERMISSION", "您没有取用这项服务的权限！"); //NO ACCENT !!

DEFINE("_CAL_LANG_MAIL_ADDED", "有新提交的讯息在");
DEFINE("_CAL_LANG_MAIL_MODIFIED", "有新修改的讯息在");

// Presentation
DEFINE("_CAL_LANG_BY", "作者");
DEFINE("_CAL_LANG_FROM", "从");
DEFINE("_CAL_LANG_TO", "到");
DEFINE("_CAL_LANG_ARCHIVE", "活动项目");
DEFINE("_CAL_LANG_WEEK", "星期");
DEFINE("_CAL_LANG_NO_EVENTS", "没有活动项目");
DEFINE("_CAL_LANG_NO_EVENTFOR", "没有活动项目于");
DEFINE("_CAL_LANG_NO_EVENTFORTHE", "没有活动项目于此");
DEFINE("_CAL_LANG_THIS_DAY", "这一天");
DEFINE("_CAL_LANG_THIS_MONTH", "这个月");
DEFINE("_CAL_LANG_LAST_MONTH", "上个月");
DEFINE("_CAL_LANG_NEXT_MONTH", "下个月");
DEFINE("_CAL_LANG_EVENTSFOR", "活动项目于");
DEFINE("_CAL_LANG_SEARCHRESULTS", "关键词的搜寻结果"); // new 1.4
DEFINE("_CAL_LANG_EVENTSFORTHE", "活动项目于此");
DEFINE("_CAL_LANG_REP_DAY", "日");
DEFINE("_CAL_LANG_REP_WEEK", "周");
DEFINE("_CAL_LANG_REP_WEEKPAIR", "每隔一星期");
DEFINE("_CAL_LANG_REP_WEEKIMPAIR", "每隔两星期");
DEFINE("_CAL_LANG_REP_MONTH", "月");
DEFINE("_CAL_LANG_REP_YEAR", "年");
DEFINE("_CAL_LANG_REP_NOEVENTSELECTED", "请先选一项活动");

// Navigation
DEFINE("_CAL_LANG_VIEWTODAY", "今天的活动");
DEFINE("_CAL_LANG_VIEWTOCOME", "本月将到来的活动");
DEFINE("_CAL_LANG_VIEWBYDAY", "以日期检视");
DEFINE("_CAL_LANG_VIEWBYCAT", "以分类检视");
DEFINE("_CAL_LANG_VIEWBYMONTH", "以月份检视");
DEFINE("_CAL_LANG_VIEWBYYEAR", "以年份检视");
DEFINE("_CAL_LANG_VIEWBYWEEK", "以星期检视");
DEFINE("_CAL_LANG_JUMPTO", "跳到指定月份");  // New 1.4
DEFINE("_CAL_LANG_BACK", "返回");
DEFINE("_CAL_LANG_CLOSE", "关闭");
DEFINE("_CAL_LANG_PREVIOUSDAY", "前一日");
DEFINE("_CAL_LANG_PREVIOUSWEEK", "前一周");
DEFINE("_CAL_LANG_PREVIOUSMONTH", "前一月");
DEFINE("_CAL_LANG_PREVIOUSYEAR", "前一年");
DEFINE("_CAL_LANG_NEXTDAY", "后一日");
DEFINE("_CAL_LANG_NEXTWEEK", "后一周");
DEFINE("_CAL_LANG_NEXTMONTH", "下个月");
DEFINE("_CAL_LANG_NEXTYEAR", "后一年");

DEFINE("_CAL_LANG_ADMINPANEL", "管理控制台");
DEFINE("_CAL_LANG_ADDEVENT", "新加一项活动项目");
DEFINE("_CAL_LANG_MYEVENTS", "我的活动项目");
DEFINE("_CAL_LANG_DELETE", "删除");
DEFINE("_CAL_LANG_MODIFY", "修改");

// Form
DEFINE("_CAL_LANG_HELP", "说明");

DEFINE("_CAL_LANG_CAL_TITLE", "活动");
DEFINE("_CAL_LANG_ADD_TITLE", "新加");
DEFINE("_CAL_LANG_MODIFY_TITLE", "修改");

DEFINE("_CAL_LANG_REPEAT_DISABLED", "重复活动只适用在如果结束日期是在开始日期之后.  在设定活动重复详情前变更结束日期."); // New for 1.4
DEFINE("_CAL_LANG_EVENT_TITLE", "主题");
DEFINE("_CAL_LANG_EVENT_COLOR", "颜色");
DEFINE("_CAL_LANG_EVENT_CATCOLOR", "使用分类颜色");
DEFINE("_CAL_LANG_EVENT_CATEGORY", "分类");
DEFINE("_CAL_LANG_EVENT_CHOOSE_CATEG", "请选择一个分类");
DEFINE("_CAL_LANG_EVENT_ACTIVITY", "活动");
DEFINE("_CAL_LANG_EVENT_URLMAIL_INFO", "当加入一个网址或电邮地址时，简单地写上 <br><u>http://www.mysite.com</u> 或 <u>mailto:my@mail.com</u>");
DEFINE("_CAL_LANG_EVENT_ADRESSE", "地点");
DEFINE("_CAL_LANG_EVENT_CONTACT", "联络");
DEFINE("_CAL_LANG_EVENT_EXTRA", "其它信息");
DEFINE("_CAL_LANG_EVENT_AUTHOR_ALIAS", "作者 (别名)");
DEFINE("_CAL_LANG_EVENT_STARTDATE", "开始日期");
DEFINE("_CAL_LANG_EVENT_ENDDATE", "结束日期");
DEFINE("_CAL_LANG_EVENT_STARTHOURS", "开始时数");
DEFINE("_CAL_LANG_EVENT_ENDHOURS", "结束时数");
DEFINE("_CAL_LANG_EVENT_STARTTIME", "开始时间");
DEFINE("_CAL_LANG_EVENT_ENDTIME", "结束时间");
DEFINE("_CAL_LANG_PUB_INFO", "发布日期");
DEFINE("_CAL_LANG_EVENT_REPEATTYPE", "重复方式");
DEFINE("_CAL_LANG_EVENT_REPEATDAY", "重复日");
DEFINE("_CAL_LANG_EVENT_CHOOSE_WEEKDAYS", "星期几");
DEFINE("_CAL_LANG_EVENT_PER", "每");
DEFINE("_CAL_LANG_EVENT_WEEKOPT", "在一个月中的哪几周要重复");

DEFINE("_CAL_LANG_SUBMITPREVIEW", "预览");
DEFINE("_CAL_LANG_SUBMITCANCEL", "取消");
DEFINE("_CAL_LANG_SUBMITSAVE", "储存");

DEFINE("_CAL_LANG_E_WARNWEEKS", "请选择一个星期");
DEFINE("_CAL_LANG_E_WARNDAYS", "请选择一个日子");

// Admin
DEFINE("_CAL_LANG_EVENT_ALLCAT", "所有分类");
DEFINE("_CAL_LANG_EVENT_ACCESSLEVEL", "存取等级");
DEFINE("_CAL_LANG_EVENT_HITS", "点击数");
DEFINE("_CAL_LANG_EVENT_STATE", "状态");
DEFINE("_CAL_LANG_EVENT_CREATED", "建立");
DEFINE("_CAL_LANG_EVENT_NEWEVENT", "新活动项目");
DEFINE("_CAL_LANG_EVENT_MODIFIED", "最后修改");
DEFINE("_CAL_LANG_EVENT_NOTMODIFIED", "未修改过");

// dmcd aug 22/04  new warning alert for no specified activity in event entry
DEFINE("_CAL_LANG_WARNACTIVITY", "一些活动\\n必须输入描述.");

DEFINE("_CAL_LEGEND_ALL_CATEGORIES", "所有类别 ...");  // new for 1.4
DEFINE("_CAL_LEGEND_ALL_CATEGORIES_DESC", "显示活动自所有类别");  // new for 1.4

DEFINE("_CAL_LANG_FORM_HELP_COLOR", <<<END
        <tr>
		  <td width="110" align="left" valign="top">
            <b>颜色</b>
          </td>
          <td>选择将会显示于月份日历显示的背景颜色.  如果类别方块已被剔选,
		  颜色预设为类别的颜色 (由管理员定义) 这是于活动的内容分页下, 及
		  '颜色选择器' 按钮会被关闭.</td>
        </tr>
END
);

DEFINE("_CAL_LANG_FORM_HELP",  <<<END
    	<tr>
          <td align="left"><b>日期</b></td>
          <td>选择你的活动的开始日期及结束日期.</td>
        </tr>
    	<tr>
          <td align="left" valign="top"><b>时间</b></td>
          <td>选择你的活动的时间.  格式为 <span style='color:blue;font-weight:bold;'>hh:mm {am|pm}</span>.<br/>时间可指定是 12 或 24 hr 格式.<br/><br/><b><i><span style='color:red;'>(新)</span></i> 注意</b> 一个特殊例子发生于 <span style='color:red;font-weight:bold;'>单日过夜活动</span>.  即是当单日活动开始于例如 19:00 及结束于 3:00, 开始及结束日期 <b>必须</b> 为&nbsp;
		   同一日, 及应该设定为子夜前的相关日子.</td>
        </tr>
END
);

DEFINE("_CAL_LANG_FORM_HELP_EXTENDED",  <<<END
        <tr>
    	  <td align="left" valign="top" nowrap><b>重复类别</b></td>
  	  	<td colspan="2"></td>
  		</tr>
  		<tr>
    	  <td colspan="2" align="left" valign="top">
	    	<table width="100%" border="0" cellspacing="2">
              <tr>
                <td width="60" align="left" valign="top"><u>按日子</u></td>
                <td width="110" align="left" valign="top" class="frm_td_bydays">
                  每日<br/><i>(预设)</i>
                </td>
                <td align="left" valign="top" class="frm_td_bydays">
                  非重复发生单日或多日活动选择此项, 新活动会于开始及结束日期范围每日发生
                </td>
              </tr>
              <tr>
                <td width="60" rowspan="3" align="left" valign="top"><u>按星期</u></td>
                <td width="110" align="left" valign="top" class="frm_td_byweeks">
                  
                    每星期一次
                  
                </td>
                <td align="left" valign="top" class="frm_td_byweeks">
                  
                  此选项允许选择重复的日子
                  <table border="0" width="100%" height="100%"><tr><td><b>日子号码</b> 为重复类别为每 10/../2003</td></tr><tr><td><b>日子名称</b> 为重复类别为逄星期一</td></tr></table>
                  
                </td>
              </tr>
              <tr>
                <td width="110" align="left" valign="top" class="frm_td_byweeks">
                  
                    每星期多个日子
                  
                </td>
                <td align="left" valign="top" class="frm_td_byweeks">
                  此选项允许选择活动会于哪些日子显示.
                </td>
              </tr>
              <tr>
                <td width="110" align="left" valign="top" class="frm_td_byweeks">
                  <i>循环周 # <br>为上述 '每星期一次' 及 每星期多个日子' 选项</i></td>
                  <td align="left" valign="top" class="frm_td_byweeks">
                  
                  <table border="0" width="100%" height="100%">
                    <tr><td><b>循环周 1 :</b> 每月的第一个星期</td></tr>
                    <tr><td><b>循环周 2 :</b> 每月的第二个星期</td></tr>
                    <tr><td><b>循环周 3 :</b> 每月的第三个星期</td></tr>
                    <tr><td><b>循环周 4 :</b> 每月的第四个星期</td></tr>
                    <tr><td><b>循环周 5 :</b> 每月的第五个星期 (如适用)</td></tr>
                   </table>
                 
                </td>
              </tr>
              <tr>
                <td width="60" rowspan="2" align="left" valign="top"><u>按月份</u></td>
                <td width="110" align="left" valign="top" class="frm_td_bymonth">
                  每月一次</td>
                <td align="left" valign="top" class="frm_td_bymonth">
                  
                     此选项允许选择月份的重复日子
                     <table border="0" width="100%" height="100%"><tr><td><b>日子号码</b> 为重复类别为每 10/../2003</td></tr><tr><td><b>日子名称</b> 为重复类别为逄星期一</td></tr></table>

                  
                </td>
              </tr>
              <tr>
                <td width="110" align="left" valign="top" class="frm_td_bymonth">
                  
                  每月的结束
                  
                </td>
                <td align="left" valign="top" class="frm_td_bymonth">
                  
				   如果该最后日子落在活动的指定开始及结束范围, 不论日子号码活动是于每月的最后日子.

                  
                </td>
              </tr>
              <tr>
                <td width="60" rowspan="2" align="left" valign="top"><u>按年份</u></td>
                <td width="110" align="left" valign="top" class="frm_td_byyear">
                  
                  每年一次
                  
                </td>
                <td align="left" valign="top" class="frm_td_byyear">
                  
                  此选项允许选择每年的单日
                  <table border="0" width="100%" height="100%"><tr><td><b>日子号码</b> 为重复类别为每 10/../2003</td></tr><tr><td><b>日子名称</b> 为重复类别为逄星期一</td></tr></table>
                  
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
DEFINE("_CAL_LANG_WARNTITLE",	"缺少了标题");
DEFINE("_CAL_LANG_WARNCAT",		"缺少了分类");
DEFINE("_CAL_LANG_STATE",		"状态");
DEFINE("_CAL_LANG_HITS",		"点击");
DEFINE("_CAL_LANG_CREATED",		"已建立");
DEFINE("_CAL_LANG_LAST_MOD",	"最后修改");
DEFINE("_CAL_LANG_EDIT",		_E_EDIT);
DEFINE("_CAL_LANG_SEARCH_TITLE","搜寻");
DEFINE("_CAL_LANG_PRINT",		_CMN_PRINT);	
?>
