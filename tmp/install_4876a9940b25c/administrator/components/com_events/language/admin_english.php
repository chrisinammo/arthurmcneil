<?php
/**
 * Events Component for Joomla 1.0.x
 *
 * @version     $Id: admin_english.php 1068 2008-04-28 16:32:29Z tstahl $
 * @package     Events
 * @copyright   Copyright (C) 2006 JEvents Project Group
 * @copyright (C) 2000 - 2003 Eric Lamette, Dave McDonnell
 * @licence     http://www.gnu.org/copyleft/gpl.html
 * @link        http://joomlacode.org/gf/project/jevents
 */


defined( '_VALID_MOS' ) or die( 'No Direct Access' );

//Check
if( defined( '_CAL_ADMIN_LANG_INCLUDED' )) {
	return;
}

DEFINE( '_CAL_ADMIN_LANG_INCLUDED', 1 );

/* +++++++++++++++++++ */
define( '_CAL_HIDE_OLD_EVENTS',			'Hide Past Events'); // NEW 1.4
define( '_CAL_LANG_CATEGORIES',   		'Categories' );
define( '_CAL_LANG_DISPLAY',			'Display' );
define( '_CAL_LANG_CATEGORY_NAME',		'Category Name' );
define( '_CAL_LANG_RECORDS',			'of&nbsp;Records' );
define( '_CAL_LANG_CHECKED_OUT',		'Checked&nbsp;Out' );
define( '_CAL_LANG_PUBLISHED',			'Published' );
define( '_CAL_LANG_NOT_PUBLISHED',		'Not Published' );
define( '_CAL_LANG_ACCESS',				'Access' );
define( '_CAL_LANG_REORDER',			'Reorder' );
define( '_CAL_LANG_UNPUBLISH',			'Unpublish' );
define( '_CAL_LANG_PUBLISH',			'Publish' );
define( '_CAL_LANG_CLICK_TO_EDIT',		'Click to edit' );
define( '_CAL_LANG_MOVE_UP',			'Move Up' );
define( '_CAL_LANG_MOVE_DOWN',			'Move Down' );
define( '_CAL_LANG_EDIT_CAT',			'Edit Category' );
define( '_CAL_LANG_ADD_CAT',			'Add Category' );
define( '_CAL_LANG_CAT_TITLE',			'Category Title' );
define( '_CAL_LANG_CAT_NAME',			'Category Name' );
define( '_CAL_LANG_IMAGE',				'Image' );
define( '_CAL_LANG_PREVIEW',			'Preview' );
define( '_CAL_LANG_IMG_POSITION',		'Image Position' );
define( '_CAL_LANG_ORDERING',			'Ordering' );
define( '_CAL_LANG_LEFT',				'Left' );
define( '_CAL_LANG_CENTER',				'Center' );
define( '_CAL_LANG_RIGHT',				'Right' );
define( '_CAL_LANG_SELECT_IMAGE',		'Select Image' );
define( '_CAL_LANG_SEARCH',				'Search' );
define( '_CAL_LANG_TITLE',				'Title' );
define( '_CAL_LANG_REPEAT',				'Repeat' );
define( '_CAL_LANG_TIME_SHEET',			'Timesheet' );
define( '_CAL_CLICK_TO_CHANGE_STATUS',	'Click on icon to change status' );
define( '_CAL_LANG_PUB_BUT_COMING',		'Published, but is <u>Coming</u>' );
define( '_CAL_LANG_PUB_ACTUAL',			'Published and is <u>Current</u>' );
define( '_CAL_LANG_PUB_FINISHED',		'Published, but has <u>Finished</u>' );
define( '_CAL_LANG_EDIT_EVENT',			'Edit event' );
define( '_CAL_LANG_ADD_EVENT',			'Add event' );
define( '_CAL_LANG_REQUIRED',			'required' );
define( '_CAL_LANG_IMG_FOLDER',			'Sub-folder' );
define( '_CAL_LANG_IMAGES',				'Gallery Images' );
define( '_CAL_LANG_AVAL_IMAGES',		'Avaliable Images' );
define( '_CAL_LANG_INSERT_IMG',			'Insert &raquo;' );
define( '_CAL_LANG_CONTENT_IMGS',		'Content Images' );
define( '_CAL_LANG_REMOVE',				'remove' );
define( '_CAL_LANG_EDITED_SEL_IMG',		'Edit the image selected' );
define( '_CAL_LANG_SOURCE',				'Source' );
define( '_CAL_LANG_ALIGN',				'Align' );
define( '_CAL_LANG_ALT_TXT',			'Alt Text' );
define( '_CAL_LANG_BORDER',				'Border' );
define( '_CAL_LANG_CAPTION',			'Caption');
define( '_CAL_LANG_CAPTION_POSITION',	'Caption Position');
define( '_CAL_LANG_CAPTION_POS_BOTTOM',	'Bottom');
define( '_CAL_LANG_CAPTION_POS_TOP',	'Top');
define( '_CAL_LANG_CAPTION_ALIGN',		'Caption Align');
define( '_CAL_LANG_CAPTION_WIDTH',		'Caption Width');
define( '_CAL_LANG_APPLY',				'Apply' );
define( '_CAL_LANG_ADD_INFO',			'Additional Information' );
define( '_CAL_LANG_EVENT_STATUS',		'Event Status' );
define( '_CAL_LANG_ARCHIVED',			'Archived' );
define( '_CAL_LANG_DRAFT_UNPUB',		'Draft Unpublished' );
define( '_CAL_LANG_NEVER',				'Never' );
define( '_CAL_LANG_CUT_TITLE',			'Titlelength' );
define( '_CAL_LANG_MAX_DISPLAY',		'Max. Events' );
define( '_CAL_LANG_DIS_STARTTIME',		'Show starttime' );

	// config
define( '_CAL_LANG_EVENTS_CONFIG',		'JEvents Config' );
define( '_CAL_LANG_CONFIG_WRITEABLE',	'Config is writeable' );
define( '_CAL_LANG_CONFIG_NOT_WRITEABLE','Config is not writeable' );
define( '_CAL_LANG_CSS_WRITEABLE',		'CSS file is writeable' );
define( '_CAL_LANG_CSS_NOT_WRITEABLE',	'CSS file is not writeable' );
define( '_CAL_LANG_ADMIN_EMAIL',		'Admin Mail' );
define( '_CAL_LANG_FRONTEND_PUBLISHING','Publish from Frontend' );
define( '_CAL_LANG_SETT_FOR_COM',		'These settings are only for the component' );
define( '_CAL_LANG_SETT_FOR_CAL_MOD',	'These setting are only for the additional calendar module' );
define( '_CAL_LANG_SETT_FOR_MOD_LATEST','These setting are only for the additional module [ Latest Events ]' );
define( '_CAL_LANG_ICONIC_NAVBAR'		,'Use new Icon Navigation bar'); // 1.4
define( '_CAL_LANG_CHECK_VERSION'		,"Check for newer version"); // 1.4

// errors
define( '_CAL_LANG_ERR_CAT_MUST_HAVE_NAME',	'Category must have a name' );

// title & alts
define( '_CAL_LANG_TIT_NAME_FOR_MENUS',	'A short name to appear in menus' );
define( '_CAL_LANG_TIT_LONG_NAME',		'A long name to be displayed in headings' );
define( '_CAL_LANG_TIT_PENDING',		'Pending' );

// msgs
define( '_CAL_LANG_MSG_CAT_IS_EDITED',	'The category [ %s ] is currently being edited by another administrator' ); // %s = $row->title
define( '_CAL_LANG_MSG_OP_FAILED',		'Operation Failed: Could not open [ %s ]' ); // %s = $filename
define( '_CAL_LANG_MSG_CHANGE_EMAIL',	'Go to EVENTS CONFIG SECTION first and change EMAIL adress' );
define( '_CAL_LANG_MSG_ADD_CAT_BEFORE',	'You must add a category for this section first' );
define( '_CAL_LANG_MSG_CONFIG_SAVED',	'Config sucessfully saved' );
define( '_CAL_LANG_MSG_WARNING',		'Warning...' );
define( '_CAL_LANG_MSG_CHMOD_CONFIG',	'You need to chmod config file to 0777 in order for the config to be updated' );
define( '_CAL_LANG_MSG_CHMOD_CSS',		'You need to chmod css file to 0777 in order for the config to be updated' );
define( '_CAL_LANG_MSG_MOD_NOT_INSTALLED','The calendar module is not installed' );
define( '_CAL_LANG_MSG_NO_MOD_LATEST',	'The module [ latest events ] is not installed' );

// tips
define( '_CAL_LANG_TIP_ACCESS',			'Who is allowed to create new events' );
define( '_CAL_LANG_TIP_FRONT_PUB',		'Allow publishers, managers and admin users to publish content from frontend' );
define( '_CAL_LANG_TIP_NR_OF_LIST',		'No. of Events to List per page for week, month, or year views' );
define( '_CAL_LANG_TIP_FE_SIMPLE_FORM',	'Use Simple (IE. No Repeat types) Event entry Form for user front end' );
define( '_CAL_LANG_TIP_DEF_EC_HIDE_FORCE',	'<b>Event specific colors allowed</b><br/>Frontend and backend editors can use event specific colours<br/><b>Event colors in backend edit only</b><br/>Only backend editors can specify event specific colours<br/><b>Always use category colors</b><br/>Editors cannot use event specific colours and any events specific colours defined before the use of this setting will be ignored and the category colour displayed instead' );
define( '_CAL_LANG_TIP_DLM_STOP_DAY',		'Day in Current Month to Stop displaying Last Month' );
define( '_CAL_LANG_TIP_DNM_START_DAY',		'Days left in Current Month to Start displaying Next Month' );
define( '_CAL_LANG_TIP_LEV_DAY_RANGE',		'Day range relative to Current Day to display Events (modes 2 or 3 only)' );
define( '_CAL_LANG_TIP_LEV_DISPLAY_YEAR',	'Display Year in the Event\\\'s Date (default format only)' );
define( '_CAL_LANG_TIP_BTN_DEF_CONFIG',		'Loads default values [in the case something went wrong]' );
define( '_CAL_LANG_TIP_LEV_DISPLAY_MODE',	'0 (default) display closest events for current week and following week only up to maximal events<br />1 same as [ mode = 0 ] except some past events for the current week will also be displayed if num of future events is less than maximal events<br />2 display closest events for [ + days ] range relative to current day up to $maxEvents<br />3  same as mode 2 except if there are less than maximal events in the range, then display past events within [ - days ] range relative to current day<br />4 display closest events for current month up to maximal events relative to current day' );
define( '_CAL_LANG_TIP_CUT_TITLE',			'If a title has too many sign, an unwanted design could be the result.<br />Define here x sign after that the title will be cutted and ... added' );
define( '_CAL_LANG_TIP_LEV_HIDE_LINK',		'If set to YES, title link is set dynamically by the javascript &lt;b&gt;onclick&lt;/b&gt; event. This prevents search enginges to follow the link');
define( '_CAL_LANG_TIP_MAX_DISPLAY',		'Amount of maximal displayed events <strong>as text</strong> per day in month view<br />If you have many events per day, displaying them could distroying your layout.<br />Define here how many events should dislayed as text, if too many they will be displayed as an icon (tooltip is not affected)<br /><strong>Tip</strong>: Setting the value to 0 [null] force the display for all events as icon' );
define( '_CAL_LANG_TIP_DIS_STARTTIME',		'Should the starttime displayed [ month view ]' );
	// tooltips
define( '_CAL_LANG_TIP_TT_BGROUND',			'Should the tooltip use the same background as the event<br />At no the standard color will be used' );
define( '_CAL_LANG_TIP_TT_POSX',			'The position of the tooltip window can be left, center or right' );
define( '_CAL_LANG_TIP_TT_POSY',			'The vertical position of the tooltip window can be below or above' );
define( '_CAL_LANG_TIP_TT_SHADOW',			'The tooltip window can have a shadow which can positioned left or right and below or above' );

// tabs
define( '_CAL_LANG_TAB_COMMON',			'Common' );
define( '_CAL_LANG_TAB_IMAGES',			'Images' );
define( '_CAL_LANG_TAB_CALENDAR',		'Calendar' );
define( '_CAL_LANG_TAB_HELP',			'Help' );
define( '_CAL_LANG_TAB_EXTRA',			'Extra' );
define( '_CAL_LANG_TAB_ABOUT',			'About' );
define( '_CAL_LANG_TAB_COMPONENT',		'Component' );
define( '_CAL_LANG_TAB_CAL_MOD',		'Calendar' );
define( '_CAL_LANG_TAB_LATEST_MOD',		'Latest Events' );
define( '_CAL_LANG_TAB_CSS',			'CSS' );
define( '_CAL_LANG_TAB_TOOLTIP',		'Tooltip' );

// select lists
	//common
define( '_CAL_LANG_YES',				'Yes' );
define( '_CAL_LANG_NO',					'No' );
define( '_CAL_LANG_ALWAYS',				'ALWAYS' );
	// access
define( '_CAL_LANG_SEL_ACCESS_ALL_REGGED',	'All registered users' );
define( '_CAL_LANG_SEL_ACCESS_SPECIAL',		'Only special rights and admins' );
define( '_CAL_LANG_SEL_ACCESS_ALL_ANONYM',	'All (anonymous) - not recommended' );
define( '_CAL_LANG_SEL_ACCESS_ALL_AUTHORS',	'Authors and above' );
define( '_CAL_LANG_SEL_ACCESS_ALL_EDITORS',	'Editors and above' );
define( '_CAL_LANG_SEL_ACCESS_ALL_PUBLISHERS',	'Publishers and above' );
define( '_CAL_LANG_SEL_ACCESS_ALL_MANAGERS',	'Managers and above' );
define( '_CAL_LANG_SEL_ACCESS_ALL_ADMIN',	'Admins and Super Admins only' );
	// first day
define( '_CAL_LANG_FIRST_DAY',			'First Day' );
define( '_CAL_LANG_SUNDAY_FIRST',		'Sunday first' );
define( '_CAL_LANG_MONDAY_FIRST',		'Monday first' );

define( '_CAL_LANG_VIEW_MAIL',			'View mail' );
define( '_CAL_LANG_VIEW_BY',			'View "By"' );
define( '_CAL_LANG_VIEW_HITS',			'View "Hits"' );
define( '_CAL_LANG_VIEW_REPEAT_TIME',	'View Repeat and time' );
define( '_CAL_LANG_VIEW_REPEAT_YEAR_LIST',	'Show All Repeat Events in Year List' );
define( '_CAL_LANG_SHOW_CATS',			'Hide "See By Categories (appropriate if events legend module is visible)' );
define( '_CAL_LANG_SHOW_COPYRIGHT',		'Show Copyright Footer');
	// date format
define( '_CAL_LANG_DATE_FORMAT',		'Date Format' );
define( '_CAL_LANG_DATE_FORMAT_FR_EN',	'French-English' );
define( '_CAL_LANG_DATE_FORMAT_US',		'US' );
define( '_CAL_LANG_DATE_FORMAT_GERMAN',	'Continental - German' );

define( '_CAL_LANG_TIME_FORMAT_12',		'Use 12hr time Format' );
	// nav bar
define( '_CAL_LANG_NAV_BAR_COLOR',		'Navigation Bar Color' );
define( '_CAL_LANG_NAV_BAR_GREEN',		'Green' );
define( '_CAL_LANG_NAV_BAR_ORANGE',		'Orange' );
define( '_CAL_LANG_NAV_BAR_BLUE',		'Blue' );
define( '_CAL_LANG_NAV_BAR_RED',		'Red' );
define( '_CAL_LANG_NAV_BAR_GRAY',		'Gray' );
define( '_CAL_LANG_NAV_BAR_YELLOW',		'Yellow' );

	// start page
define( '_CAL_LANG_START_PAGE',			'Start Page' );
define( '_CAL_LANG_SP_DAY',				'Day' );
define( '_CAL_LANG_SP_WEEK',			'Week' );
define( '_CAL_LANG_SP_MONTH_CAL',		'Month (Calendar)' );
define( '_CAL_LANG_SP_MONTH_LIST',		'Month (List)' );
define( '_CAL_LANG_SP_YEAR',			'Year' );
define( '_CAL_LANG_SP_CATEGORIES',		'Categories' );
define( '_CAL_LANG_SP_SEARCH',			'Search' );

define( '_CAL_LANG_NR_OF_LIST',			'No. of Events' );
define( '_CAL_LANG_FE_SIMPLE_FORM',		'Use Simple' );
	// event color
define( '_CAL_LANG_DEF_EVENT_COLOR',	'Default Event Color' );
define( '_CAL_LANG_DEF_EC_RANDOM',		'Random' );
define( '_CAL_LANG_DEF_EC_NONE',		'None' );
define( '_CAL_LANG_DEF_EC_CATEGORY',	'Category' );
define( '_CAL_LANG_DEF_EC_HIDE_FORCE',	'Event color rule' );
define( '_CAL_LANG_EVENT_COLS_ALLOWED',	'Event specific colors allowed' );
define( '_CAL_LANG_EVENT_COLS_BACKED',	'Event colors in backend edit only' );
define( '_CAL_LANG_ALWAYS_CAT_COLOR',	'Always use category colors' );

	// tooltips
define( '_CAL_LANG_ABOVE',				'Above' );
define( '_CAL_LANG_BELOW',				'Below' );

// calendar module
	// display last month
define( '_CAL_LANG_DISPLAY_LAST_MONTH',	'Display Last Month' );
define( '_CAL_LANG_DLM_YES_STOP_DAY',	'YES - with stop day' );
define( '_CAL_LANG_DLM_YES_EVENT_SDAY',	'YES - if has events AND with stop day' );
define( '_CAL_LANG_DLM_ALWYS_IF_EVENTS','ALWAYS - if has events' );
	// stop day
define( '_CAL_LANG_DLM_STOP_DAY',		'Day in Current Month to Stop' );
	// display next month
define( '_CAL_LANG_DISPLAY_NEXT_MONTH',	'Display Next Month' );
define( '_CAL_LANG_DNM_YES_START_DAY',	'YES - with start day' );
define( '_CAL_LANG_DNM_YES_EVENT_SDAY', 'YES - if has events AND with start day' );
define( '_CAL_LANG_DNM_ALWYS_IF_EVENTS','ALWAYS - if has events' );
	// start day
define( '_CAL_LANG_DNM_START_DAY',		'Days left in Current Month to Start' );

// latest events module
define( '_CAL_LANG_LEV_MAX_DISPLAY',	'Maximum Events to Display' );
define( '_CAL_LANG_LEV_DISPLAY_MODE',	'Display Mode' );
define( '_CAL_LANG_LEV_DAY_RANGE',		'Days Before-After' );
define( '_CAL_LANG_LEV_REP_EV_ONCE',	'Only Display a Repeating Event Once' );
define( '_CAL_LANG_LEV_EV_AS_LINK',		'Display Events As Link' );
define( '_CAL_LANG_LEV_DISPLAY_YEAR',	'Display Year' );
define( '_CAL_LANG_LEV_CSS_DATE_FIELD',	'Disable default CSS Date Field Style' );
define( '_CAL_LANG_LEV_CSS_TITLE_FIELD','Disable default CSS Title Field Style' );
define( '_CAL_LANG_LEV_HIDE_LINK',		'Hide title link');
define( '_CAL_LANG_LEV_CUST_FORM_STRING','Custom Format String' );

// tooltips frontpage (overlib)
define( '_CAL_LANG_TOOLTIP',			'Settings belongs to the tooltip window in monthly view' );
define( '_CAL_LANG_TT_MAINWINDOW',		'Tooltip Mainwindow' );
define( '_CAL_LANG_TT_BGROUND',			'Same background as event' );
define( '_CAL_LANG_TT_POSX',			'Horizontal Position' );
define( '_CAL_LANG_TT_POSY',			'Vertical Position' );
define( '_CAL_LANG_TT_SHADOW',			'Shadow' );
define( '_CAL_LANG_TT_SHADOWX',			'Left' );
define( '_CAL_LANG_TT_SHADOWY',			'Above' );

// buttons
define( '_CAL_LANG_BTN_DEF_CONFIG',		'Reset to default' );

// installation
define( '_CAL_LANG_INSTAL_MAIN',		'Events' );
define( '_CAL_LANG_INSTAL_MANAGE',		'Manage Events' );
define( '_CAL_LANG_INSTAL_CATS',		'Manage Categories' );
define( '_CAL_LANG_INSTAL_CONFIG',		'Configuration' );
define( '_CAL_LANG_INSTAL_ARCHIVE',		'Archive' );
define( '_CAL_LANG_INSTAL_ERROR',		'Following errors occured' );
define( '_CAL_LANG_INSTAL_SUCCESS',		'Events successfully installed' );
define( '_CAL_LANG_INSTALL_DB_ENTRIES',	'DB-Entries, Changes' );
define( '_CAL_LANG_INSTALL_PREV_INST',	'Double DB-Entries removed' );

DEFINE("_CAL_LANG_EVENT_ALLDAY","All day Event or Unspecified time");  // new for 1.4


?>

