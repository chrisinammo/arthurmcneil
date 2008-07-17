<?php
/**
 * Events Component for Joomla 1.0.x
 * Translated by Mike Ho <mikeho1980@hotmail.com>
 * @version     $Id: admin_traditional_chinese.php 864 2007-08-14 18:56:58Z tstahl $
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
define( '_CAL_HIDE_OLD_EVENTS',			'隱藏過去活動'); // NEW 1.4
define( '_CAL_LANG_CATEGORIES',   		'分類' );
define( '_CAL_LANG_DISPLAY',			'顯示' );
define( '_CAL_LANG_CATEGORY_NAME',		'分類名稱' );
define( '_CAL_LANG_RECORDS',			'之&nbsp;紀錄' );
define( '_CAL_LANG_CHECKED_OUT',		'已回傳' );
define( '_CAL_LANG_PUBLISHED',			'已發佈' );
define( '_CAL_LANG_NOT_PUBLISHED',		'未發佈' );
define( '_CAL_LANG_ACCESS',				'存取' );
define( '_CAL_LANG_REORDER',			'重新排序' );
define( '_CAL_LANG_UNPUBLISH',			'不發佈' );
define( '_CAL_LANG_PUBLISH',			'發佈' );
define( '_CAL_LANG_CLICK_TO_EDIT',		'點擊編輯' );
define( '_CAL_LANG_MOVE_UP',			'上移' );
define( '_CAL_LANG_MOVE_DOWN',			'下移' );
define( '_CAL_LANG_EDIT_CAT',			'編輯分類' );
define( '_CAL_LANG_ADD_CAT',			'新增分類' );
define( '_CAL_LANG_CAT_TITLE',			'分類標題' );
define( '_CAL_LANG_CAT_NAME',			'分類名稱' );
define( '_CAL_LANG_IMAGE',				'圖片' );
define( '_CAL_LANG_PREVIEW',			'預覽' );
define( '_CAL_LANG_IMG_POSITION',		'圖片位置' );
define( '_CAL_LANG_ORDERING',			'排序' );
define( '_CAL_LANG_LEFT',				'左' );
define( '_CAL_LANG_CENTER',				'中' );
define( '_CAL_LANG_RIGHT',				'右' );
define( '_CAL_LANG_SELECT_IMAGE',		'選擇圖片' );
define( '_CAL_LANG_SEARCH',				'搜尋' );
define( '_CAL_LANG_TITLE',				'標題' );
define( '_CAL_LANG_REPEAT',				'重複' );
define( '_CAL_LANG_TIME_SHEET',			'時間表' );
define( '_CAL_CLICK_TO_CHANGE_STATUS',	'點擊圖示去變更狀況' );
define( '_CAL_LANG_PUB_BUT_COMING',		'己發佈, 但是於 <u>未來</u>' );
define( '_CAL_LANG_PUB_ACTUAL',			'已發佈, 於 <u>現在</u>' );
define( '_CAL_LANG_PUB_FINISHED',		'已發佈, 但已 <u>完結</u>' );
define( '_CAL_LANG_EDIT_EVENT',			'編輯活動' );
define( '_CAL_LANG_ADD_EVENT',			'增加活動' );
define( '_CAL_LANG_REQUIRED',			'必須的' );
define( '_CAL_LANG_IMG_FOLDER',			'子資料夾' );
define( '_CAL_LANG_IMAGES',				'圖庫圖片' );
define( '_CAL_LANG_AVAL_IMAGES',		'可用圖片' );
define( '_CAL_LANG_INSERT_IMG',			'插入 &raquo;' );
define( '_CAL_LANG_CONTENT_IMGS',		'內容圖片' );
define( '_CAL_LANG_REMOVE',				'移除' );
define( '_CAL_LANG_EDITED_SEL_IMG',		'編輯已選取圖片' );
define( '_CAL_LANG_SOURCE',				'來源' );
define( '_CAL_LANG_ALIGN',				'對齊方式' );
define( '_CAL_LANG_ALT_TXT',			'替代文字' );
define( '_CAL_LANG_BORDER',				'框線' );
define( '_CAL_LANG_CAPTION',			'標題');
define( '_CAL_LANG_CAPTION_POSITION',	'標題位置');
define( '_CAL_LANG_CAPTION_POS_BOTTOM',	'底部');
define( '_CAL_LANG_CAPTION_POS_TOP',	'頂部');
define( '_CAL_LANG_CAPTION_ALIGN',		'標題對齊方式');
define( '_CAL_LANG_CAPTION_WIDTH',		'標題寬度');
define( '_CAL_LANG_APPLY',				'套用' );
define( '_CAL_LANG_ADD_INFO',			'附加資料' );
define( '_CAL_LANG_EVENT_STATUS',		'活動狀況' );
define( '_CAL_LANG_ARCHIVED',			'已封存' );
define( '_CAL_LANG_DRAFT_UNPUB',		'草稿未發佈' );
define( '_CAL_LANG_NEVER',				'永不' );
define( '_CAL_LANG_CUT_TITLE',			'標題長度' );
define( '_CAL_LANG_MAX_DISPLAY',		'最多活動數目' );
define( '_CAL_LANG_DIS_STARTTIME',		'顯示開始時間' );

	// config
define( '_CAL_LANG_EVENTS_CONFIG',		'JEvents 設定' );
define( '_CAL_LANG_CONFIG_WRITEABLE',	'設定檔可寫入' );
define( '_CAL_LANG_CONFIG_NOT_WRITEABLE','設定檔不可寫入' );
define( '_CAL_LANG_CSS_WRITEABLE',		'CSS 檔案可寫入' );
define( '_CAL_LANG_CSS_NOT_WRITEABLE',	'CSS 檔案不可寫入' );
define( '_CAL_LANG_ADMIN_EMAIL',		'管理員電郵' );
define( '_CAL_LANG_FRONTEND_PUBLISHING','自前台發佈' );
define( '_CAL_LANG_SETT_FOR_COM',		'這些設定只適用於元件' );
define( '_CAL_LANG_SETT_FOR_CAL_MOD',	'這些設定只適用於附加的日曆模組' );
define( '_CAL_LANG_SETT_FOR_MOD_LATEST','這些設定只適用於附加模組 [ 最新活動 ]' );
define( '_CAL_LANG_ICONIC_NAVBAR'		,'使用新圖示瀏覽列'); // 1.4
define( '_CAL_LANG_CHECK_VERSION'		,"檢查新版本"); // 1.4

// errors
define( '_CAL_LANG_ERR_CAT_MUST_HAVE_NAME',	'分類必須有名稱' );

// title & alts
define( '_CAL_LANG_TIT_NAME_FOR_MENUS',	'顯示於選單的短名稱' );
define( '_CAL_LANG_TIT_LONG_NAME',		'顯示於標題的長名稱' );
define( '_CAL_LANG_TIT_PENDING',		'等待中' );

// msgs
define( '_CAL_LANG_MSG_CAT_IS_EDITED',	'分類 [ %s ] 現正被另一位管理員編輯中' ); // %s = $row->title
define( '_CAL_LANG_MSG_OP_FAILED',		'操作失敗: 不能開啟 [ %s ]' ); // %s = $filename
define( '_CAL_LANG_MSG_CHANGE_EMAIL',	'先前往活動設定部份, 然後變更電郵地址' );
define( '_CAL_LANG_MSG_ADD_CAT_BEFORE',	'你必須先為此部份新增分類' );
define( '_CAL_LANG_MSG_CONFIG_SAVED',	'設定已成功儲存' );
define( '_CAL_LANG_MSG_WARNING',		'警告...' );
define( '_CAL_LANG_MSG_CHMOD_CONFIG',	'你需要變更設定檔權限為 0777 才可更新設定' );
define( '_CAL_LANG_MSG_CHMOD_CSS',		'你需要變更 css 檔案權限為 0777 才可更新設定' );
define( '_CAL_LANG_MSG_MOD_NOT_INSTALLED','未安裝日曆模組' );
define( '_CAL_LANG_MSG_NO_MOD_LATEST',	'未安裝模組 [ 最新活動 ]' );

// tips
define( '_CAL_LANG_TIP_ACCESS',			'誰被允許建立新活動' );
define( '_CAL_LANG_TIP_FRONT_PUB',		'允許 publishers, managers 及 admin 用戶從前台發佈內容' );
define( '_CAL_LANG_TIP_NR_OF_LIST',		'星期, 月份, 或年份檢視時每頁的活動數目' );
define( '_CAL_LANG_TIP_FE_SIMPLE_FORM',	'使前台用戶使用簡易 (即無重複類型) 活動輸入表格' );
define( '_CAL_LANG_TIP_DEF_EC_HIDE_FORCE',	'<b>允許指定活動顏色</b><br/>前台及後台編輯可指定活動顏色<br/><b>只限後台編輯活動顏色</b><br/>只限後台編輯指定活動顏色<br/><b>總是使用分類顏色</b><br/>編輯不能指定活動顏色, 使用此設定將會忽略所有活動已定義的顏色, 並會由分類顏色代替' );
define( '_CAL_LANG_TIP_DLM_STOP_DAY',		'現在月份開始後多少天停止顯示上個月份' );
define( '_CAL_LANG_TIP_DNM_START_DAY',		'現在月份結束前多少天開始顯示下個月份' );
define( '_CAL_LANG_TIP_LEV_DAY_RANGE',		'顯示活動的相對現在日子的日期範圍 (只限模式 1 或 3)' );
define( '_CAL_LANG_TIP_LEV_DISPLAY_YEAR',	'於活動日期中顯示年份 (只限預設格式)' );
define( '_CAL_LANG_TIP_BTN_DEF_CONFIG',		'載入預設數值 [於某些情況下可能出錯]' );
define( '_CAL_LANG_TIP_LEV_DISPLAY_MODE',	'0 (預設) 顯示本星期及隨後星期的最近活動 (直至最大活動數目)<br />1 除本星期部份過去活動亦會顯示外 (如未來活動數目少於最大活動數目) 與 [ 模式 = 0 ] 相同<br />2 顯示相對於現在日子 [ + 日數 ] 範圍內的最近活動 (直到 $maxEvents)<br />3  除如果範圍內少於最大活動數目則顯示相對現在日子過去 [ - 日數 ] 範圍內的活動外, 與模式 2 相同<br />4 顯示本月最新活動直至最大活動數目' );
define( '_CAL_LANG_TIP_CUT_TITLE',			'如果標題有太長, 可能導致外觀不理想.<br />在這裡定義 x 個字後標題會被裁去及加上 ...' );
define( '_CAL_LANG_TIP_LEV_HIDE_LINK',		'如果設為是, 標題連結將由javascript &lt;b&gt;onclick&lt;/b&gt;項目動態設定. 這防止搜尋引擎追蹤到連結');
define( '_CAL_LANG_TIP_MAX_DISPLAY',		'於月份檢視每日最大活動數目顯示成 <strong>文字</strong> <br />如果你每日有很多活動, 顯示它們可能破壞你的佈局.<br />在這裡定義多少活動會顯示成文字, 如果太多它們將會顯示成圖示 (小提示不受影響)<br /><strong>提示</strong>: 設定數值為 0 [無] 強制顯示所有活動成圖示' );
define( '_CAL_LANG_TIP_DIS_STARTTIME',		'開始時間應該顯示 [ 月份檢視 ]' );
	// tooltips
define( '_CAL_LANG_TIP_TT_BGROUND',			'小提示應否使用與活動相同背景<br />不使用標準頻色' );
define( '_CAL_LANG_TIP_TT_POSX',			'小提示水平位置可以是左, 中或右' );
define( '_CAL_LANG_TIP_TT_POSY',			'小提示垂直位置可以是下方或上方' );
define( '_CAL_LANG_TIP_TT_SHADOW',			'小提示影子位置可以是左或右及下方或上方' );

// tabs
define( '_CAL_LANG_TAB_COMMON',			'通用' );
define( '_CAL_LANG_TAB_IMAGES',			'圖片' );
define( '_CAL_LANG_TAB_CALENDAR',		'日曆' );
define( '_CAL_LANG_TAB_HELP',			'說明' );
define( '_CAL_LANG_TAB_EXTRA',			'額外' );
define( '_CAL_LANG_TAB_ABOUT',			'關於' );
define( '_CAL_LANG_TAB_COMPONENT',		'元件' );
define( '_CAL_LANG_TAB_CAL_MOD',		'日曆' );
define( '_CAL_LANG_TAB_LATEST_MOD',		'最新活動' );
define( '_CAL_LANG_TAB_CSS',			'CSS' );
define( '_CAL_LANG_TAB_TOOLTIP',		'小提示' );

// select lists
	//common
define( '_CAL_LANG_YES',				'是' );
define( '_CAL_LANG_NO',					'否' );
define( '_CAL_LANG_ALWAYS',				'總是' );
	// access
define( '_CAL_LANG_SEL_ACCESS_ALL_REGGED',	'所有註冊用戶' );
define( '_CAL_LANG_SEL_ACCESS_SPECIAL',		'只限 Special 及 Admin' );
define( '_CAL_LANG_SEL_ACCESS_ALL_ANONYM',	'所有人 (暱名) - 不建議' );
define( '_CAL_LANG_SEL_ACCESS_ALL_AUTHORS',	'Authors 或以上' );
define( '_CAL_LANG_SEL_ACCESS_ALL_EDITORS',	'Editors 或以上' );
define( '_CAL_LANG_SEL_ACCESS_ALL_PUBLISHERS',	'Publishers 或以上' );
define( '_CAL_LANG_SEL_ACCESS_ALL_MANAGERS',	'Managers 或以上' );
define( '_CAL_LANG_SEL_ACCESS_ALL_ADMIN',	'只限 Admins 及 Super Admins' );
	// first day
define( '_CAL_LANG_FIRST_DAY',			'每週首日' );
define( '_CAL_LANG_SUNDAY_FIRST',		'星期日先' );
define( '_CAL_LANG_MONDAY_FIRST',		'星期一先' );

define( '_CAL_LANG_VIEW_MAIL',			'顯示電郵' );
define( '_CAL_LANG_VIEW_BY',			'顯示"來自"' );
define( '_CAL_LANG_VIEW_HITS',			'顯示"點擊"' );
define( '_CAL_LANG_VIEW_REPEAT_TIME',	'顯示重複及時間' );
define( '_CAL_LANG_VIEW_REPEAT_YEAR_LIST',	'於年份列表顯示所有重複活動' );
define( '_CAL_LANG_SHOW_CATS',			'隱藏"按分類檢視 (適用於活動圖例模式為顯示)' );
define( '_CAL_LANG_SHOW_COPYRIGHT',		'顯示版權註腳');
	// date format
define( '_CAL_LANG_DATE_FORMAT',		'日期格式' );
define( '_CAL_LANG_DATE_FORMAT_FR_EN',	'法式-英語' );
define( '_CAL_LANG_DATE_FORMAT_US',		'美語' );
define( '_CAL_LANG_DATE_FORMAT_GERMAN',	'歐陸式-德語' );

define( '_CAL_LANG_TIME_FORMAT_12',		'使用 12 小時制格式' );
	// nav bar
define( '_CAL_LANG_NAV_BAR_COLOR',		'瀏覽列顏色' );
define( '_CAL_LANG_NAV_BAR_GREEN',		'綠色' );
define( '_CAL_LANG_NAV_BAR_ORANGE',		'橙色' );
define( '_CAL_LANG_NAV_BAR_BLUE',		'藍色' );
define( '_CAL_LANG_NAV_BAR_RED',		'紅色' );
define( '_CAL_LANG_NAV_BAR_GRAY',		'灰色' );
define( '_CAL_LANG_NAV_BAR_YELLOW',		'黃色' );

	// start page
define( '_CAL_LANG_START_PAGE',			'開始頁' );
define( '_CAL_LANG_SP_DAY',				'日子' );
define( '_CAL_LANG_SP_WEEK',			'星期' );
define( '_CAL_LANG_SP_MONTH_CAL',		'月份 (日曆)' );
define( '_CAL_LANG_SP_MONTH_LIST',		'月份 (表列)' );
define( '_CAL_LANG_SP_YEAR',			'年份' );
define( '_CAL_LANG_SP_CATEGORIES',		'分類' );
define( '_CAL_LANG_SP_SEARCH',			'搜尋' );

define( '_CAL_LANG_NR_OF_LIST',			'活動數目' );
define( '_CAL_LANG_FE_SIMPLE_FORM',		'使用簡易' );
	// event color
define( '_CAL_LANG_DEF_EVENT_COLOR',	'預設活動顏色' );
define( '_CAL_LANG_DEF_EC_RANDOM',		'隨機' );
define( '_CAL_LANG_DEF_EC_NONE',		'無' );
define( '_CAL_LANG_DEF_EC_CATEGORY',	'分類' );
define( '_CAL_LANG_DEF_EC_HIDE_FORCE',	'活動顏色規則' );
define( '_CAL_LANG_EVENT_COLS_ALLOWED',	'允許指定活動顏色' );
define( '_CAL_LANG_EVENT_COLS_BACKED',	'只限後台編輯活動顏色' );
define( '_CAL_LANG_ALWAYS_CAT_COLOR',	'總是使用分類顏色' );

	// tooltips
define( '_CAL_LANG_ABOVE',				'上方' );
define( '_CAL_LANG_BELOW',				'下方' );

// calendar module
	// display last month
define( '_CAL_LANG_DISPLAY_LAST_MONTH',	'顯示上個月份' );
define( '_CAL_LANG_DLM_YES_STOP_DAY',	'是 - 有停止日期' );
define( '_CAL_LANG_DLM_YES_EVENT_SDAY',	'是 - 如果有活動及有停止日期' );
define( '_CAL_LANG_DLM_ALWYS_IF_EVENTS','總是 - 如果有活動' );
	// stop day
define( '_CAL_LANG_DLM_STOP_DAY',		'本月開始後多少天停止顯示上個月份' );
	// display next month
define( '_CAL_LANG_DISPLAY_NEXT_MONTH',	'顯示下個月份' );
define( '_CAL_LANG_DNM_YES_START_DAY',	'是 - 有開始日期' );
define( '_CAL_LANG_DNM_YES_EVENT_SDAY', '是 - 如果有活動及有開始日期' );
define( '_CAL_LANG_DNM_ALWYS_IF_EVENTS','總是 - 如果有活動' );
	// start day
define( '_CAL_LANG_DNM_START_DAY',		'本月結束前多少天開始顯示下個月份' );

// latest events module
define( '_CAL_LANG_LEV_MAX_DISPLAY',	'顯示活動的最大數目' );
define( '_CAL_LANG_LEV_DISPLAY_MODE',	'顯示模式' );
define( '_CAL_LANG_LEV_DAY_RANGE',		'日前後' );
define( '_CAL_LANG_LEV_REP_EV_ONCE',	'只顯示重複的活動一次' );
define( '_CAL_LANG_LEV_EV_AS_LINK',		'以連結顯示活動' );
define( '_CAL_LANG_LEV_DISPLAY_YEAR',	'顯示年份' );
define( '_CAL_LANG_LEV_CSS_DATE_FIELD',	'關閉預設 CSS 日期欄位風格' );
define( '_CAL_LANG_LEV_CSS_TITLE_FIELD','關閉預設 CSS 標題欄位風格' );
define( '_CAL_LANG_LEV_HIDE_LINK',		'隱藏標題連結');
define( '_CAL_LANG_LEV_CUST_FORM_STRING','自訂格式字串' );

// tooltips frontpage (overlib)
define( '_CAL_LANG_TOOLTIP',			'月份檢視時小提示視窗的設定' );
define( '_CAL_LANG_TT_MAINWINDOW',		'小提示主視窗' );
define( '_CAL_LANG_TT_BGROUND',			'背景跟活動相同' );
define( '_CAL_LANG_TT_POSX',			'水平位置' );
define( '_CAL_LANG_TT_POSY',			'垂直位置' );
define( '_CAL_LANG_TT_SHADOW',			'影子' );
define( '_CAL_LANG_TT_SHADOWX',			'左方' );
define( '_CAL_LANG_TT_SHADOWY',			'上方' );

// buttons
define( '_CAL_LANG_BTN_DEF_CONFIG',		'重置成預設' );

// installation
define( '_CAL_LANG_INSTAL_MAIN',		'活動' );
define( '_CAL_LANG_INSTAL_MANAGE',		'管理活動' );
define( '_CAL_LANG_INSTAL_CATS',		'活動分類' );
define( '_CAL_LANG_INSTAL_CONFIG',		'設定' );
define( '_CAL_LANG_INSTAL_ARCHIVE',		'封存' );
define( '_CAL_LANG_INSTAL_ERROR',		'發生以下錯誤' );
define( '_CAL_LANG_INSTAL_SUCCESS',		'成功安裝 Events' );
define( '_CAL_LANG_INSTALL_DB_ENTRIES',	'資料庫-紀錄, 變更' );
define( '_CAL_LANG_INSTALL_PREV_INST',	'雙重資料庫-紀錄 移除' );

DEFINE("_CAL_LANG_EVENT_ALLDAY","全日活動或未指明時間");  // new for 1.4


?>

