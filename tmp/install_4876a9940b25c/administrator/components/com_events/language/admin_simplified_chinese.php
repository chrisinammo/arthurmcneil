<?php
/**
 * Events Component for Joomla 1.0.x
 * Translated by Mike Ho <mikeho1980@hotmail.com>
 * @version     $Id: admin_simplified_chinese.php 864 2007-08-14 18:56:58Z tstahl $
 * @package     Events
 * @copyright   Copyright (C) 2006-2007 JEvents Project Group
 * @licence     http://www.gnu.org/copyleft/gpl.html
 * @link        http://joomlacode.org/gf/project/jevents
 */

defined( '_VALID_MOS' ) or die( 'Restricted access' );

//Check
if( defined( '_CAL_ADMIN_LANG_INCLUDED' )) {
	return;
}

DEFINE( '_CAL_ADMIN_LANG_INCLUDED', 1 );

/* +++++++++++++++++++ */
define( '_CAL_HIDE_OLD_EVENTS',			'隐藏过去活动'); // NEW 1.4
define( '_CAL_LANG_CATEGORIES',   		'分类' );
define( '_CAL_LANG_DISPLAY',			'显示' );
define( '_CAL_LANG_CATEGORY_NAME',		'分类名称' );
define( '_CAL_LANG_RECORDS',			'之&nbsp;纪录' );
define( '_CAL_LANG_CHECKED_OUT',		'已回传' );
define( '_CAL_LANG_PUBLISHED',			'已发布' );
define( '_CAL_LANG_NOT_PUBLISHED',		'未发布' );
define( '_CAL_LANG_ACCESS',				'存取' );
define( '_CAL_LANG_REORDER',			'重新排序' );
define( '_CAL_LANG_UNPUBLISH',			'不发布' );
define( '_CAL_LANG_PUBLISH',			'发布' );
define( '_CAL_LANG_CLICK_TO_EDIT',		'点击编辑' );
define( '_CAL_LANG_MOVE_UP',			'上移' );
define( '_CAL_LANG_MOVE_DOWN',			'下移' );
define( '_CAL_LANG_EDIT_CAT',			'编辑分类' );
define( '_CAL_LANG_ADD_CAT',			'新增分类' );
define( '_CAL_LANG_CAT_TITLE',			'分类标题' );
define( '_CAL_LANG_CAT_NAME',			'分类名称' );
define( '_CAL_LANG_IMAGE',				'图片' );
define( '_CAL_LANG_PREVIEW',			'预览' );
define( '_CAL_LANG_IMG_POSITION',		'图片位置' );
define( '_CAL_LANG_ORDERING',			'排序' );
define( '_CAL_LANG_LEFT',				'左' );
define( '_CAL_LANG_CENTER',				'中' );
define( '_CAL_LANG_RIGHT',				'右' );
define( '_CAL_LANG_SELECT_IMAGE',		'选择图片' );
define( '_CAL_LANG_SEARCH',				'搜寻' );
define( '_CAL_LANG_TITLE',				'标题' );
define( '_CAL_LANG_REPEAT',				'重复' );
define( '_CAL_LANG_TIME_SHEET',			'时间表' );
define( '_CAL_CLICK_TO_CHANGE_STATUS',	'点击图示去变更状况' );
define( '_CAL_LANG_PUB_BUT_COMING',		'己发布, 但是于 <u>未来</u>' );
define( '_CAL_LANG_PUB_ACTUAL',			'已发布, 于 <u>现在</u>' );
define( '_CAL_LANG_PUB_FINISHED',		'已发布, 但已 <u>完结</u>' );
define( '_CAL_LANG_EDIT_EVENT',			'编辑活动' );
define( '_CAL_LANG_ADD_EVENT',			'增加活动' );
define( '_CAL_LANG_REQUIRED',			'必须的' );
define( '_CAL_LANG_IMG_FOLDER',			'子资料夹' );
define( '_CAL_LANG_IMAGES',				'图库图片' );
define( '_CAL_LANG_AVAL_IMAGES',		'可用图片' );
define( '_CAL_LANG_INSERT_IMG',			'插入 &raquo;' );
define( '_CAL_LANG_CONTENT_IMGS',		'内容图片' );
define( '_CAL_LANG_REMOVE',				'移除' );
define( '_CAL_LANG_EDITED_SEL_IMG',		'编辑已选取图片' );
define( '_CAL_LANG_SOURCE',				'来源' );
define( '_CAL_LANG_ALIGN',				'对齐方式' );
define( '_CAL_LANG_ALT_TXT',			'替代文字' );
define( '_CAL_LANG_BORDER',				'框线' );
define( '_CAL_LANG_CAPTION',			'标题');
define( '_CAL_LANG_CAPTION_POSITION',	'标题位置');
define( '_CAL_LANG_CAPTION_POS_BOTTOM',	'底部');
define( '_CAL_LANG_CAPTION_POS_TOP',	'顶部');
define( '_CAL_LANG_CAPTION_ALIGN',		'标题对齐方式');
define( '_CAL_LANG_CAPTION_WIDTH',		'标题宽度');
define( '_CAL_LANG_APPLY',				'套用' );
define( '_CAL_LANG_ADD_INFO',			'附加数据' );
define( '_CAL_LANG_EVENT_STATUS',		'活动状况' );
define( '_CAL_LANG_ARCHIVED',			'已封存' );
define( '_CAL_LANG_DRAFT_UNPUB',		'草稿未发布' );
define( '_CAL_LANG_NEVER',				'永不' );
define( '_CAL_LANG_CUT_TITLE',			'标题长度' );
define( '_CAL_LANG_MAX_DISPLAY',		'最多活动数目' );
define( '_CAL_LANG_DIS_STARTTIME',		'显示开始时间' );

	// config
define( '_CAL_LANG_EVENTS_CONFIG',		'JEvents 设定' );
define( '_CAL_LANG_CONFIG_WRITEABLE',	'设定档可写入' );
define( '_CAL_LANG_CONFIG_NOT_WRITEABLE','设定档不可写入' );
define( '_CAL_LANG_CSS_WRITEABLE',		'CSS 档案可写入' );
define( '_CAL_LANG_CSS_NOT_WRITEABLE',	'CSS 档案不可写入' );
define( '_CAL_LANG_ADMIN_EMAIL',		'管理员电邮' );
define( '_CAL_LANG_FRONTEND_PUBLISHING','自前台发布' );
define( '_CAL_LANG_SETT_FOR_COM',		'这些设定只适用于组件' );
define( '_CAL_LANG_SETT_FOR_CAL_MOD',	'这些设定只适用于附加的日历模块' );
define( '_CAL_LANG_SETT_FOR_MOD_LATEST','这些设定只适用于附加模块 [ 最新活动 ]' );
define( '_CAL_LANG_ICONIC_NAVBAR'		,'使用新图示浏览列'); // 1.4
define( '_CAL_LANG_CHECK_VERSION'		,"检查新版本"); // 1.4

// errors
define( '_CAL_LANG_ERR_CAT_MUST_HAVE_NAME',	'分类必须有名称' );

// title & alts
define( '_CAL_LANG_TIT_NAME_FOR_MENUS',	'显示于选单的短名称' );
define( '_CAL_LANG_TIT_LONG_NAME',		'显示于标题的长名称' );
define( '_CAL_LANG_TIT_PENDING',		'等待中' );

// msgs
define( '_CAL_LANG_MSG_CAT_IS_EDITED',	'分类 [ %s ] 现正被另一位管理员编辑中' ); // %s = $row->title
define( '_CAL_LANG_MSG_OP_FAILED',		'操作失败: 不能开启 [ %s ]' ); // %s = $filename
define( '_CAL_LANG_MSG_CHANGE_EMAIL',	'先前往活动设定部份, 然后变更电邮地址' );
define( '_CAL_LANG_MSG_ADD_CAT_BEFORE',	'你必须先为此部份新增分类' );
define( '_CAL_LANG_MSG_CONFIG_SAVED',	'设定已成功储存' );
define( '_CAL_LANG_MSG_WARNING',		'警告...' );
define( '_CAL_LANG_MSG_CHMOD_CONFIG',	'你需要变更设定档权限为 0777 才可更新设定' );
define( '_CAL_LANG_MSG_CHMOD_CSS',		'你需要变更 css 档案权限为 0777 才可更新设定' );
define( '_CAL_LANG_MSG_MOD_NOT_INSTALLED','未安装日历模块' );
define( '_CAL_LANG_MSG_NO_MOD_LATEST',	'未安装模块 [ 最新活动 ]' );

// tips
define( '_CAL_LANG_TIP_ACCESS',			'谁被允许建立新活动' );
define( '_CAL_LANG_TIP_FRONT_PUB',		'允许 publishers, managers 及 admin 用户从前台发布内容' );
define( '_CAL_LANG_TIP_NR_OF_LIST',		'星期, 月份, 或年份检视时每页的活动数目' );
define( '_CAL_LANG_TIP_FE_SIMPLE_FORM',	'使前台用户使用简易 (即无重复类型) 活动输入表格' );
define( '_CAL_LANG_TIP_DEF_EC_HIDE_FORCE',	'<b>允许指定活动颜色</b><br/>前台及后台编辑可指定活动颜色<br/><b>只限后台编辑活动颜色</b><br/>只限后台编辑指定活动颜色<br/><b>总是使用分类颜色</b><br/>编辑不能指定活动颜色, 使用此设定将会忽略所有活动已定义的颜色, 并会由分类颜色代替' );
define( '_CAL_LANG_TIP_DLM_STOP_DAY',		'现在月份开始后多少天停止显示上个月份' );
define( '_CAL_LANG_TIP_DNM_START_DAY',		'现在月份结束前多少天开始显示下个月份' );
define( '_CAL_LANG_TIP_LEV_DAY_RANGE',		'显示活动的相对现在日子的日期范围 (只限模式 1 或 3)' );
define( '_CAL_LANG_TIP_LEV_DISPLAY_YEAR',	'于活动日期中显示年份 (只限预设格式)' );
define( '_CAL_LANG_TIP_BTN_DEF_CONFIG',		'载入预设数值 [于某些情况下可能出错]' );
define( '_CAL_LANG_TIP_LEV_DISPLAY_MODE',	'0 (预设) 显示本星期及随后星期的最近活动 (直至最大活动数目)<br />1 除本星期部份过去活动亦会显示外 (如未来活动数目少于最大活动数目) 与 [ 模式 = 0 ] 相同<br />2 显示相对于现在日子 [ + 日数 ] 范围内的最近活动 (直到 $maxEvents)<br />3  除如果范围内少于最大活动数目则显示相对现在日子过去 [ - 日数 ] 范围内的活动外, 与模式 2 相同<br />4 显示本月最新活动直至最大活动数目' );
define( '_CAL_LANG_TIP_CUT_TITLE',			'如果标题有太长, 可能导致外观不理想.<br />在这里定义 x 个字后标题会被裁去及加上 ...' );
define( '_CAL_LANG_TIP_LEV_HIDE_LINK',		'如果设为是, 标题连结将由javascript &lt;b&gt;onclick&lt;/b&gt;项目动态设定. 这防止搜寻引擎追踪到连结');
define( '_CAL_LANG_TIP_MAX_DISPLAY',		'于月份检视每日最大活动数目显示成 <strong>文字</strong> <br />如果你每日有很多活动, 显示它们可能破坏你的布局.<br />在这里定义多少活动会显示成文字, 如果太多它们将会显示成图标 (小提示不受影响)<br /><strong>提示</strong>: 设定数值为 0 [无] 强制显示所有活动成图标' );
define( '_CAL_LANG_TIP_DIS_STARTTIME',		'开始时间应该显示 [ 月份检视 ]' );
	// tooltips
define( '_CAL_LANG_TIP_TT_BGROUND',			'小提示应否使用与活动相同背景<br />不使用标准频色' );
define( '_CAL_LANG_TIP_TT_POSX',			'小提示水平位置可以是左, 中或右' );
define( '_CAL_LANG_TIP_TT_POSY',			'小提示垂直位置可以是下方或上方' );
define( '_CAL_LANG_TIP_TT_SHADOW',			'小提示影子位置可以是左或右及下方或上方' );

// tabs
define( '_CAL_LANG_TAB_COMMON',			'通用' );
define( '_CAL_LANG_TAB_IMAGES',			'图片' );
define( '_CAL_LANG_TAB_CALENDAR',		'日历' );
define( '_CAL_LANG_TAB_HELP',			'说明' );
define( '_CAL_LANG_TAB_EXTRA',			'额外' );
define( '_CAL_LANG_TAB_ABOUT',			'关于' );
define( '_CAL_LANG_TAB_COMPONENT',		'组件' );
define( '_CAL_LANG_TAB_CAL_MOD',		'日历' );
define( '_CAL_LANG_TAB_LATEST_MOD',		'最新活动' );
define( '_CAL_LANG_TAB_CSS',			'CSS' );
define( '_CAL_LANG_TAB_TOOLTIP',		'小提示' );

// select lists
	//common
define( '_CAL_LANG_YES',				'是' );
define( '_CAL_LANG_NO',					'否' );
define( '_CAL_LANG_ALWAYS',				'总是' );
	// access
define( '_CAL_LANG_SEL_ACCESS_ALL_REGGED',	'所有注册用户' );
define( '_CAL_LANG_SEL_ACCESS_SPECIAL',		'只限 Special 及 Admin' );
define( '_CAL_LANG_SEL_ACCESS_ALL_ANONYM',	'所有人 (昵名) - 不建议' );
define( '_CAL_LANG_SEL_ACCESS_ALL_AUTHORS',	'Authors 或以上' );
define( '_CAL_LANG_SEL_ACCESS_ALL_EDITORS',	'Editors 或以上' );
define( '_CAL_LANG_SEL_ACCESS_ALL_PUBLISHERS',	'Publishers 或以上' );
define( '_CAL_LANG_SEL_ACCESS_ALL_MANAGERS',	'Managers 或以上' );
define( '_CAL_LANG_SEL_ACCESS_ALL_ADMIN',	'只限 Admins 及 Super Admins' );
	// first day
define( '_CAL_LANG_FIRST_DAY',			'每周首日' );
define( '_CAL_LANG_SUNDAY_FIRST',		'星期日先' );
define( '_CAL_LANG_MONDAY_FIRST',		'星期一先' );

define( '_CAL_LANG_VIEW_MAIL',			'显示电邮' );
define( '_CAL_LANG_VIEW_BY',			'显示"来自"' );
define( '_CAL_LANG_VIEW_HITS',			'显示"点击"' );
define( '_CAL_LANG_VIEW_REPEAT_TIME',	'显示重复及时间' );
define( '_CAL_LANG_VIEW_REPEAT_YEAR_LIST',	'于年份列表显示所有重复活动' );
define( '_CAL_LANG_SHOW_CATS',			'隐藏"按分类检视 (适用于活动图例模式为显示)' );
define( '_CAL_LANG_SHOW_COPYRIGHT',		'显示版权脚注');
	// date format
define( '_CAL_LANG_DATE_FORMAT',		'日期格式' );
define( '_CAL_LANG_DATE_FORMAT_FR_EN',	'法式-英语' );
define( '_CAL_LANG_DATE_FORMAT_US',		'美语' );
define( '_CAL_LANG_DATE_FORMAT_GERMAN',	'欧陆式-德语' );

define( '_CAL_LANG_TIME_FORMAT_12',		'使用 12 小时制格式' );
	// nav bar
define( '_CAL_LANG_NAV_BAR_COLOR',		'浏览列颜色' );
define( '_CAL_LANG_NAV_BAR_GREEN',		'绿色' );
define( '_CAL_LANG_NAV_BAR_ORANGE',		'橙色' );
define( '_CAL_LANG_NAV_BAR_BLUE',		'蓝色' );
define( '_CAL_LANG_NAV_BAR_RED',		'红色' );
define( '_CAL_LANG_NAV_BAR_GRAY',		'灰色' );
define( '_CAL_LANG_NAV_BAR_YELLOW',		'黄色' );

	// start page
define( '_CAL_LANG_START_PAGE',			'开始页' );
define( '_CAL_LANG_SP_DAY',				'日子' );
define( '_CAL_LANG_SP_WEEK',			'星期' );
define( '_CAL_LANG_SP_MONTH_CAL',		'月份 (日历)' );
define( '_CAL_LANG_SP_MONTH_LIST',		'月份 (表列)' );
define( '_CAL_LANG_SP_YEAR',			'年份' );
define( '_CAL_LANG_SP_CATEGORIES',		'分类' );
define( '_CAL_LANG_SP_SEARCH',			'搜寻' );

define( '_CAL_LANG_NR_OF_LIST',			'活动数目' );
define( '_CAL_LANG_FE_SIMPLE_FORM',		'使用简易' );
	// event color
define( '_CAL_LANG_DEF_EVENT_COLOR',	'预设活动颜色' );
define( '_CAL_LANG_DEF_EC_RANDOM',		'随机' );
define( '_CAL_LANG_DEF_EC_NONE',		'无' );
define( '_CAL_LANG_DEF_EC_CATEGORY',	'分类' );
define( '_CAL_LANG_DEF_EC_HIDE_FORCE',	'活动颜色规则' );
define( '_CAL_LANG_EVENT_COLS_ALLOWED',	'允许指定活动颜色' );
define( '_CAL_LANG_EVENT_COLS_BACKED',	'只限后台编辑活动颜色' );
define( '_CAL_LANG_ALWAYS_CAT_COLOR',	'总是使用分类颜色' );

	// tooltips
define( '_CAL_LANG_ABOVE',				'上方' );
define( '_CAL_LANG_BELOW',				'下方' );

// calendar module
	// display last month
define( '_CAL_LANG_DISPLAY_LAST_MONTH',	'显示上个月份' );
define( '_CAL_LANG_DLM_YES_STOP_DAY',	'是 - 有停止日期' );
define( '_CAL_LANG_DLM_YES_EVENT_SDAY',	'是 - 如果有活动及有停止日期' );
define( '_CAL_LANG_DLM_ALWYS_IF_EVENTS','总是 - 如果有活动' );
	// stop day
define( '_CAL_LANG_DLM_STOP_DAY',		'本月开始后多少天停止显示上个月份' );
	// display next month
define( '_CAL_LANG_DISPLAY_NEXT_MONTH',	'显示下个月份' );
define( '_CAL_LANG_DNM_YES_START_DAY',	'是 - 有开始日期' );
define( '_CAL_LANG_DNM_YES_EVENT_SDAY', '是 - 如果有活动及有开始日期' );
define( '_CAL_LANG_DNM_ALWYS_IF_EVENTS','总是 - 如果有活动' );
	// start day
define( '_CAL_LANG_DNM_START_DAY',		'本月结束前多少天开始显示下个月份' );

// latest events module
define( '_CAL_LANG_LEV_MAX_DISPLAY',	'显示活动的最大数目' );
define( '_CAL_LANG_LEV_DISPLAY_MODE',	'显示模式' );
define( '_CAL_LANG_LEV_DAY_RANGE',		'日前后' );
define( '_CAL_LANG_LEV_REP_EV_ONCE',	'只显示重复的活动一次' );
define( '_CAL_LANG_LEV_EV_AS_LINK',		'以连结显示活动' );
define( '_CAL_LANG_LEV_DISPLAY_YEAR',	'显示年份' );
define( '_CAL_LANG_LEV_CSS_DATE_FIELD',	'关闭预设 CSS 日期字段风格' );
define( '_CAL_LANG_LEV_CSS_TITLE_FIELD','关闭预设 CSS 标题字段风格' );
define( '_CAL_LANG_LEV_HIDE_LINK',		'隐藏标题连结');
define( '_CAL_LANG_LEV_CUST_FORM_STRING','自订格式字符串' );

// tooltips frontpage (overlib)
define( '_CAL_LANG_TOOLTIP',			'月份检视时小提示窗口的设定' );
define( '_CAL_LANG_TT_MAINWINDOW',		'小提示主窗口' );
define( '_CAL_LANG_TT_BGROUND',			'背景跟活动相同' );
define( '_CAL_LANG_TT_POSX',			'水平位置' );
define( '_CAL_LANG_TT_POSY',			'垂直位置' );
define( '_CAL_LANG_TT_SHADOW',			'影子' );
define( '_CAL_LANG_TT_SHADOWX',			'左方' );
define( '_CAL_LANG_TT_SHADOWY',			'上方' );

// buttons
define( '_CAL_LANG_BTN_DEF_CONFIG',		'重置成预设' );

// installation
define( '_CAL_LANG_INSTAL_MAIN',		'活动' );
define( '_CAL_LANG_INSTAL_MANAGE',		'管理活动' );
define( '_CAL_LANG_INSTAL_CATS',		'活动分类' );
define( '_CAL_LANG_INSTAL_CONFIG',		'设定' );
define( '_CAL_LANG_INSTAL_ARCHIVE',		'封存' );
define( '_CAL_LANG_INSTAL_ERROR',		'发生以下错误' );
define( '_CAL_LANG_INSTAL_SUCCESS',		'成功安装 Events' );
define( '_CAL_LANG_INSTALL_DB_ENTRIES',	'数据库-纪录, 变更' );
define( '_CAL_LANG_INSTALL_PREV_INST',	'双重数据库-纪录 移除' );

DEFINE("_CAL_LANG_EVENT_ALLDAY","全日活动或未指明时间");  // new for 1.4


?>

