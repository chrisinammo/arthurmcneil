<?php
/**
 * Events Component for Joomla 1.0.x
 *
 * @version     $Id: admin_hungariani.php 849 2007-07-21 17:47:48Z tstahl $
 * @package     Events
 * @copyright   Copyright (C) 2006 JEvents Project Group
 * @copyright (C) 2000 - 2003 Eric Lamette, Dave McDonnell
 * @licence     http://www.gnu.org/copyleft/gpl.html
 * @link        http://joomlacode.org/gf/project/jevents
 * @translation           Jozsef Tamas Herczeg, www.joomlandia.eu
 * @translation license   http://creativecommons.org/licenses/by-nc-nd/2.5/
 */


defined( '_VALID_MOS' ) or die( 'A közvetlen hozzáférés tilos!' );

//Check
if( defined( '_CAL_ADMIN_LANG_INCLUDED' )) {
	return;
}

DEFINE( '_CAL_ADMIN_LANG_INCLUDED', 1 );

/* +++++++++++++++++++ */
define( '_CAL_HIDE_OLD_EVENTS',			'Az elavult események elrejtése'); // NEW 1.4
define( '_CAL_LANG_CATEGORIES',   		'Kategóriák' );
define( '_CAL_LANG_DISPLAY',			'Megjelenítés' );
define( '_CAL_LANG_CATEGORY_NAME',		'Kategória neve' );
define( '_CAL_LANG_RECORDS',			'Bejegyzések' );
define( '_CAL_LANG_CHECKED_OUT',		'Visszavéve' );
define( '_CAL_LANG_PUBLISHED',			'Közzétéve' );
define( '_CAL_LANG_NOT_PUBLISHED',		'Nincs közzétéve' );
define( '_CAL_LANG_ACCESS',				'Hozzáférés' );
define( '_CAL_LANG_REORDER',			'Átrendezés' );
define( '_CAL_LANG_UNPUBLISH',			'Visszavonás' );
define( '_CAL_LANG_PUBLISH',			'Közzététel' );
define( '_CAL_LANG_CLICK_TO_EDIT',		'Kattints ide a szerkesztéshez' );
define( '_CAL_LANG_MOVE_UP',			'Fel' );
define( '_CAL_LANG_MOVE_DOWN',			'Le' );
define( '_CAL_LANG_EDIT_CAT',			'Kategória szerkesztése' );
define( '_CAL_LANG_ADD_CAT',			'Kategória hozzáadása' );
define( '_CAL_LANG_CAT_TITLE',			'Kategória címe' );
define( '_CAL_LANG_CAT_NAME',			'Kategória neve' );
define( '_CAL_LANG_IMAGE',				'Kép' );
define( '_CAL_LANG_PREVIEW',			'Elõnézet' );
define( '_CAL_LANG_IMG_POSITION',		'Kép elhelyezése' );
define( '_CAL_LANG_ORDERING',			'Sorrend' );
define( '_CAL_LANG_LEFT',				'Balra' );
define( '_CAL_LANG_CENTER',				'Középre' );
define( '_CAL_LANG_RIGHT',				'Jobbra' );
define( '_CAL_LANG_SELECT_IMAGE',		'Válasszon képet' );
define( '_CAL_LANG_SEARCH',				'Keresés' );
define( '_CAL_LANG_TITLE',				'Cím' );
define( '_CAL_LANG_REPEAT',				'Ismétlõdés' );
define( '_CAL_LANG_TIME_SHEET',			'Idõrend' );
define( '_CAL_CLICK_TO_CHANGE_STATUS',	'Kattints az ikonra az állapot átváltásához' );
define( '_CAL_LANG_PUB_BUT_COMING',		'Közzétéve, és <u>esedékes</u>' );
define( '_CAL_LANG_PUB_ACTUAL',			'Közzétéve, és a <u>jelenlegi</u>' );
define( '_CAL_LANG_PUB_FINISHED',		'Közzétéve, de <u>befejezõdött</u>' );
define( '_CAL_LANG_EDIT_EVENT',			'Esemény módosítása' );
define( '_CAL_LANG_ADD_EVENT',			'Új esemény' );
define( '_CAL_LANG_REQUIRED',			'kötelezõ' );
define( '_CAL_LANG_IMG_FOLDER',			'Alkönyvtár' );
define( '_CAL_LANG_IMAGES',				'Galériaképek' );
define( '_CAL_LANG_AVAL_IMAGES',		'Létezõ képek' );
define( '_CAL_LANG_INSERT_IMG',			'Beszúrás &raquo;' );
define( '_CAL_LANG_CONTENT_IMGS',		'Tartalmi elem képei' );
define( '_CAL_LANG_REMOVE',				'eltávolítás' );
define( '_CAL_LANG_EDITED_SEL_IMG',		'A kijelölt kép szerkesztése' );
define( '_CAL_LANG_SOURCE',				'Forrás' );
define( '_CAL_LANG_ALIGN',				'Igazítás' );
define( '_CAL_LANG_ALT_TXT',			'Helyettesítõ szöveg' );
define( '_CAL_LANG_BORDER',				'Szegély' );
define( '_CAL_LANG_CAPTION',			'Aláírás');
define( '_CAL_LANG_CAPTION_POSITION',	'Aláírás elhelyezése');
define( '_CAL_LANG_CAPTION_POS_BOTTOM',	'Lent');
define( '_CAL_LANG_CAPTION_POS_TOP',	'Fönt');
define( '_CAL_LANG_CAPTION_ALIGN',		'Aláírás igazítása');
define( '_CAL_LANG_CAPTION_WIDTH',		'Aláírás szélessége');
define( '_CAL_LANG_APPLY',				'Alkalmaz' );
define( '_CAL_LANG_ADD_INFO',			'Kiegészítõ információ' );
define( '_CAL_LANG_EVENT_STATUS',		'Esemény állapota' );
define( '_CAL_LANG_ARCHIVED',			'Archivált' );
define( '_CAL_LANG_DRAFT_UNPUB',		'Kiadatlan kézirat' );
define( '_CAL_LANG_NEVER',				'Soha' );
define( '_CAL_LANG_CUT_TITLE',			'Cím hossza' );
define( '_CAL_LANG_MAX_DISPLAY',		'Események megjelenítendõ száma' );
define( '_CAL_LANG_DIS_STARTTIME',		'Kezdõ idõpont megjelenítése' );

	// config
define( '_CAL_LANG_EVENTS_CONFIG',		'JEvents beállításai' );
define( '_CAL_LANG_CONFIG_WRITEABLE',	'A konfigurációs fájl írható' );
define( '_CAL_LANG_CONFIG_NOT_WRITEABLE','A konfigurációs fájl nem írható' );
define( '_CAL_LANG_CSS_WRITEABLE',		'A CSS fájl írható' );
define( '_CAL_LANG_CSS_NOT_WRITEABLE',	'A CSS fájl nem írható' );
define( '_CAL_LANG_ADMIN_EMAIL',		'Adminisztrátor email címe' );
define( '_CAL_LANG_FRONTEND_PUBLISHING','Közzététel a látogatói oldalról' );
define( '_CAL_LANG_SETT_FOR_COM',		'Az alábbi beállítások csak a komponensre vonatkoznak' );
define( '_CAL_LANG_SETT_FOR_CAL_MOD',	'Az alábbi beállítások csak a kiegészítõ naptármodulra vonatkoznak' );
define( '_CAL_LANG_SETT_FOR_MOD_LATEST','Az alábbi beállítások csak az [ Új események ] kiegészítõ modulra vonatkoznak' );
define( '_CAL_LANG_ICONIC_NAVBAR'		,'Új navigációs ikonsáv használata'); // 1.4
define( '_CAL_LANG_CHECK_VERSION'		,"Új verzió ellenõrzése"); // 1.4

// errors
define( '_CAL_LANG_ERR_CAT_MUST_HAVE_NAME',	'Adj nevet a kategóriának!' );

// title & alts
define( '_CAL_LANG_TIT_NAME_FOR_MENUS',	'A menükben látható rövid név' );
define( '_CAL_LANG_TIT_LONG_NAME',		'A címsorban megjelenített hosszú név' );
define( '_CAL_LANG_TIT_PENDING',		'Függõben' );

// msgs
define( '_CAL_LANG_MSG_CAT_IS_EDITED',	'A kategóriát [ %s ] épp egy másik adminisztrátor szerkeszti' ); // %s = $row->title
define( '_CAL_LANG_MSG_OP_FAILED',		'Sikertelen mûvelet: nem nyitható meg a(z) [ %s ]' ); // %s = $filename
define( '_CAL_LANG_MSG_CHANGE_EMAIL',	'Elõbb változtasd meg a JEVENTS beállításaiban az EMAIL címet' );
define( '_CAL_LANG_MSG_ADD_CAT_BEFORE',	'Elõbb adj hozzá egy kategóriát ehhez a szekcióhoz' );
define( '_CAL_LANG_MSG_CONFIG_SAVED',	'A beállítások mentése sikerült' );
define( '_CAL_LANG_MSG_WARNING',		'Figyelmeztetés...' );
define( '_CAL_LANG_MSG_CHMOD_CONFIG',	'A konfigurációs fájl CHMOD értékét állítsd 0777-re, hogy a beállítások módosíthatók legyenek' );
define( '_CAL_LANG_MSG_CHMOD_CSS',		'A CSS fájl CHMOD értékét állítsd 0777-re, hogy a beállítások módosíthatók legyenek' );
define( '_CAL_LANG_MSG_MOD_NOT_INSTALLED','A naptármodult még nem telepítetted' );
define( '_CAL_LANG_MSG_NO_MOD_LATEST',	'Az [ Új események ] modult még nem telepítetted' );

// tips
define( '_CAL_LANG_TIP_ACCESS',			'Kinek engedélyezed az új események bejegyzését' );
define( '_CAL_LANG_TIP_FRONT_PUB',		'A közzétevõk, a kezelõk és az adminisztrátorok tehetik közzé a bejegyzéseket a látogatói oldalról' );
define( '_CAL_LANG_TIP_NR_OF_LIST',		'A heti, havi vagy éves nézetben oldalanként kilistázandó események száma' );
define( '_CAL_LANG_TIP_FE_SIMPLE_FORM',	'Az egyszerû (pl. nincsenek ismétlõdési típusok) eseménybejegyzési ûrlapot használja a látogatói oldalon' );
define( '_CAL_LANG_TIP_DEF_EC_HIDE_FORCE',	'<b>Eseményspecifikus színek használata engedélyezett</b><br/>A látogatói oldal és a kiszolgálói oldal szerkesztõi eseményspecifikus színeket használhatnak<br/><b>Eseményszínek csak a kiszolgáló oldali szerkesztésben</b><br/>Csak a kiszolgálói oldal szerkesztõi határozhatnak meg eseményspecifikus színeket<br/><b>Mindig a kategóriaszíneket használja</b><br/>A szerkesztõk nem használhatnak eseményspecifikus színeket, és bármilyen eseményspecifikus szín, melyet eme beállítás használata elõtt definiáltak, mellõzésre kerül, a kategóriaszín látható helyette' );
define( '_CAL_LANG_TIP_DLM_STOP_DAY',		'A jelenlegi hónap napjainak száma az elõzõ hónap megjelenítéséhez' );
define( '_CAL_LANG_TIP_DNM_START_DAY',		'A jelenlegi hónapból hátralévõ napok száma a következõ hónap megjelenítésének az indításához' );
define( '_CAL_LANG_TIP_LEV_DAY_RANGE',		'A mai naphoz viszonyított idõtartam napban az események megjelenítéséhez (csak az 1. és a 3. módban)' );
define( '_CAL_LANG_TIP_LEV_DISPLAY_YEAR',	'Az évszám kijelzése az esemény dátumában (csak az alapértelmezett formátumban)' );
define( '_CAL_LANG_TIP_BTN_DEF_CONFIG',		'Betölti az alapértelmezés szerinti értékeket [abban az esetben, ha valamit elrontottál]' );
define( '_CAL_LANG_TIP_LEV_DISPLAY_MODE',	'0 (alapértelmezett) a jelenlegi hét legközelebbi eseményeit jeleníti meg, a következõ hetet csak az eseményes legnagyobb számáig<br />1 ugyanaz, mint a [ mode = 0 ], azzal a kivétellel, hogy a jelenlegi hét elavult eseményei is láthatók lesznek, ha a jövõbeli események száma kisebb az események maximális számánál<br />2 a [ + napok ] idõköz a mai naphoz viszonyított legközelebbi eseményeit jeleníti meg a $maxEvents számáig<br />3 ugyanaz, mint a 2. mód, azzal a kivétellel, hogy a maximális eseményeknél kevesebb van az idõtartamban, majd a mai naphoz viszonyítva  megjeleníti az elavult eseményeket a [ - napok ] tartományban<br />4 a jelenlegi hónap legközelebbi eseményeit jeleníti meg a mai naphoz viszonyítva az oldalankénti számban' );
define( '_CAL_LANG_TIP_CUT_TITLE',			'Ha túl sok jel van egy címben, akkor annak nem kívánatos tervezés lehet az eredménye.<br />Adon meg itt x jelet, ami után a címet lerövidítjük, és beszúrjuk a ... jelet' );
define( '_CAL_LANG_TIP_LEV_HIDE_LINK',		'Ha az IGEN-t választja, akkor a JavaScript &lt;b&gt;onclick&lt;/b&gt; esemény dinamikusan végzi a címcsatolást. Ezzel megakadályozhatja, hogy a keresõmotorok követhessék a hivatkozást');
define( '_CAL_LANG_TIP_MAX_DISPLAY',		'A <strong>szövegként</strong> megjelenítendõ események száma naponta havi nézetben<br />Ha sok eseménye van naponta, megjelenítésük rombolhatja az elrendezést.<br />Itt adhatja meg, hogy hány esemény legyen látható szövegként, ha túl sok van, akkor ikonnal történik a megjelenítésük (a buborékra nincs hatással)<br /><strong>Tipp</strong>: Az érték 0-ra [nullára] állítása az összes esemény ikonnal történõ megjelenítésére kényszerít' );
define( '_CAL_LANG_TIP_DIS_STARTTIME',		'Legyen-e látható a kezdõ idõpont [ havi nézetben ]' );
	// tooltips
define( '_CAL_LANG_TIP_TT_BGROUND',			'A buboréknak az eseményével azonos legyen-e a háttérszíne.<br />Nem esetén a szokásos szín kerül felhasználásra' );
define( '_CAL_LANG_TIP_TT_POSX',			'A buborék elhelyezése történhet balra, középre vagy jobbra' );
define( '_CAL_LANG_TIP_TT_POSY',			'A buborék függõleges elhelyezése történhet alá vagy fölé' );
define( '_CAL_LANG_TIP_TT_SHADOW',			'A buboréknak lehet árnyéka, amit balra vagy jobbra, ill. alul vagy felül helyezhet el' );

// tabs
define( '_CAL_LANG_TAB_COMMON',			'Általános' );
define( '_CAL_LANG_TAB_IMAGES',			'Képek' );
define( '_CAL_LANG_TAB_CALENDAR',		'Naptár' );
define( '_CAL_LANG_TAB_HELP',			'Súgó' );
define( '_CAL_LANG_TAB_EXTRA',			'Összegzés' );
define( '_CAL_LANG_TAB_ABOUT',			'Névjegy' );
define( '_CAL_LANG_TAB_COMPONENT',		'Komponens' );
define( '_CAL_LANG_TAB_CAL_MOD',		'Naptár' );
define( '_CAL_LANG_TAB_LATEST_MOD',		'Új események' );
define( '_CAL_LANG_TAB_CSS',			'CSS' );
define( '_CAL_LANG_TAB_TOOLTIP',		'Buborék' );

// select lists
	//common
define( '_CAL_LANG_YES',				'Igen' );
define( '_CAL_LANG_NO',					'Nem' );
define( '_CAL_LANG_ALWAYS',				'MINDIG' );
	// access
define( '_CAL_LANG_SEL_ACCESS_ALL_REGGED',	'Minden regisztrált felhasználó' );
define( '_CAL_LANG_SEL_ACCESS_SPECIAL',		'Csak a speciálisak és az adminisztrátorok' );
define( '_CAL_LANG_SEL_ACCESS_ALL_ANONYM',	'Mindenki (névtelenek) - nem ajánlott' );
define( '_CAL_LANG_SEL_ACCESS_ALL_AUTHORS',	'Szerzõk és fölötte' );
define( '_CAL_LANG_SEL_ACCESS_ALL_EDITORS',	'Szerkesztõk és fölötte' );
define( '_CAL_LANG_SEL_ACCESS_ALL_PUBLISHERS',	'Közzétevõk és fölötte' );
define( '_CAL_LANG_SEL_ACCESS_ALL_MANAGERS',	'Kezelõk és fölötte' );
define( '_CAL_LANG_SEL_ACCESS_ALL_ADMIN',	'Csak az adminisztrátorok és a fõadminisztrátorok' );
	// first day
define( '_CAL_LANG_FIRST_DAY',			'A hét elsõ napja' );
define( '_CAL_LANG_SUNDAY_FIRST',		'Vasárnap' );
define( '_CAL_LANG_MONDAY_FIRST',		'Hétfõ' );

define( '_CAL_LANG_VIEW_MAIL',			'Az email cím megjelenítése' );
define( '_CAL_LANG_VIEW_BY',			'A "Beírta" megjelenítése' );
define( '_CAL_LANG_VIEW_HITS',			'A "Találatok" megjelenítése' );
define( '_CAL_LANG_VIEW_REPEAT_TIME',	'Az ismétlõdés és az idõpont megjelenítése' );
define( '_CAL_LANG_VIEW_REPEAT_YEAR_LIST',	'Az összes ismétlõdõ esemény megjelenítése az éves listában' );
define( '_CAL_LANG_SHOW_CATS',			'A "Kategóriánként" elrejtése (csak akkor, ha az események jelmagyarázata modul látható)' );
define( '_CAL_LANG_SHOW_COPYRIGHT',		'A szerzõi jogi információt megjelenítõ lábjegyzet megjelenítése');
	// date format
define( '_CAL_LANG_DATE_FORMAT',		'Dátum formátuma' );
define( '_CAL_LANG_DATE_FORMAT_FR_EN',	'Francia-angol' );
define( '_CAL_LANG_DATE_FORMAT_US',		'Amerikai' );
define( '_CAL_LANG_DATE_FORMAT_GERMAN',	'Európai - Német' );

define( '_CAL_LANG_TIME_FORMAT_12',		'Az idõ kijelzése 12 órás formátumban' );
	// nav bar
define( '_CAL_LANG_NAV_BAR_COLOR',		'Navigációs sáv színe' );
define( '_CAL_LANG_NAV_BAR_GREEN',		'Zöld' );
define( '_CAL_LANG_NAV_BAR_ORANGE',		'Narancssárga' );
define( '_CAL_LANG_NAV_BAR_BLUE',		'Kék' );
define( '_CAL_LANG_NAV_BAR_RED',		'Piros' );
define( '_CAL_LANG_NAV_BAR_GRAY',		'Szürke' );
define( '_CAL_LANG_NAV_BAR_YELLOW',		'Sárga' );

	// start page
define( '_CAL_LANG_START_PAGE',			'Kezdõ oldal' );
define( '_CAL_LANG_SP_DAY',				'Nap' );
define( '_CAL_LANG_SP_WEEK',			'Hét' );
define( '_CAL_LANG_SP_MONTH_CAL',		'Hónap (naptár)' );
define( '_CAL_LANG_SP_MONTH_LIST',		'Hónap (lista)' );
define( '_CAL_LANG_SP_YEAR',			'Év' );
define( '_CAL_LANG_SP_CATEGORIES',		'Kategória' );
define( '_CAL_LANG_SP_SEARCH',			'Keresés' );

define( '_CAL_LANG_NR_OF_LIST',			'Események oldalankénti száma' );
define( '_CAL_LANG_FE_SIMPLE_FORM',		'Egyszerû mód használata' );
	// event color
define( '_CAL_LANG_DEF_EVENT_COLOR',	'Alapértelmezett eseményszín' );
define( '_CAL_LANG_DEF_EC_RANDOM',		'Véletlenszerû' );
define( '_CAL_LANG_DEF_EC_NONE',		'Nincs' );
define( '_CAL_LANG_DEF_EC_CATEGORY',	'Kategória' );
define( '_CAL_LANG_DEF_EC_HIDE_FORCE',	'Eseményszín szabálya' );
define( '_CAL_LANG_EVENT_COLS_ALLOWED',	'Eseményspecifikus színek használata engedélyezett' );
define( '_CAL_LANG_EVENT_COLS_BACKED',	'Eseményszínek csak a kiszolgáló oldali szerkesztésben' );
define( '_CAL_LANG_ALWAYS_CAT_COLOR',	'Mindig a kategóriaszíneket használom' );

	// tooltips
define( '_CAL_LANG_ABOVE',				'Fölé' );
define( '_CAL_LANG_BELOW',				'Alá' );

// calendar module
	// display last month
define( '_CAL_LANG_DISPLAY_LAST_MONTH',	'Az elõzõ hónap megjelenítése' );
define( '_CAL_LANG_DLM_YES_STOP_DAY',	'IGEN - az utolsó nappal' );
define( '_CAL_LANG_DLM_YES_EVENT_SDAY',	'IGEN - ha vannak események ÉS az utolsó nappal' );
define( '_CAL_LANG_DLM_ALWYS_IF_EVENTS','MINDIG - ha vannak események' );
	// stop day
define( '_CAL_LANG_DLM_STOP_DAY',		'A jelenlegi hónap napjainak száma a leállításhoz' );
	// display next month
define( '_CAL_LANG_DISPLAY_NEXT_MONTH',	'A következõ hónap megjelenítése' );
define( '_CAL_LANG_DNM_YES_START_DAY',	'IGEN - az elsõ nappal' );
define( '_CAL_LANG_DNM_YES_EVENT_SDAY', 'IGEN - ha vannak események ÉS az elsõ nappal' );
define( '_CAL_LANG_DNM_ALWYS_IF_EVENTS','MINDIG - ha vannak események' );
	// start day
define( '_CAL_LANG_DNM_START_DAY',		'A jelenlegi hónapból hátralévõ napok száma a kezdéshez' );

// latest events module
define( '_CAL_LANG_LEV_MAX_DISPLAY',	'A megjelenítendõ események száma' );
define( '_CAL_LANG_LEV_DISPLAY_MODE',	'Megjelenítési mód' );
define( '_CAL_LANG_LEV_DAY_RANGE',		'Napok száma elõtte-utána' );
define( '_CAL_LANG_LEV_REP_EV_ONCE',	'Egy ismétlõdõ esemény megjelenítése csak egyszer' );
define( '_CAL_LANG_LEV_EV_AS_LINK',		'Az események megjelenítése hivatkozásként' );
define( '_CAL_LANG_LEV_DISPLAY_YEAR',	'Évszám kijelzése' );
define( '_CAL_LANG_LEV_CSS_DATE_FIELD',	'Az alapértelmezett CSS dátummezõ stílusának letiltása' );
define( '_CAL_LANG_LEV_CSS_TITLE_FIELD','Az alapértelmezett CSS címmezõ stílusának letiltása' );
define( '_CAL_LANG_LEV_HIDE_LINK',		'Címcsatolás elrejtése');
define( '_CAL_LANG_LEV_CUST_FORM_STRING','Egyedi formázási karakterlánc' );

// tooltips frontpage (overlib)
define( '_CAL_LANG_TOOLTIP',			'Az alábbi beállítások a havi nézetben látható buborékra vonatkoznak' );
define( '_CAL_LANG_TT_MAINWINDOW',		'Buborék fõablaka' );
define( '_CAL_LANG_TT_BGROUND',			'Az eseményével azonos háttér' );
define( '_CAL_LANG_TT_POSX',			'Vízszintes elhelyezés' );
define( '_CAL_LANG_TT_POSY',			'Függõleges elhelyezés' );
define( '_CAL_LANG_TT_SHADOW',			'Árnyék' );
define( '_CAL_LANG_TT_SHADOWX',			'Balra' );
define( '_CAL_LANG_TT_SHADOWY',			'Fent' );

// buttons
define( '_CAL_LANG_BTN_DEF_CONFIG',		'Alaphelyzet' );

// installation
define( '_CAL_LANG_INSTAL_MAIN',		'Események' );
define( '_CAL_LANG_INSTAL_MANAGE',		'Események kezelése' );
define( '_CAL_LANG_INSTAL_CATS',		'Kategóriák kezelése' );
define( '_CAL_LANG_INSTAL_CONFIG',		'Konfiguráció' );
define( '_CAL_LANG_INSTAL_ARCHIVE',		'Archívum' );
define( '_CAL_LANG_INSTAL_ERROR',		'A következõ hibák merültek föl' );
define( '_CAL_LANG_INSTAL_SUCCESS',		'Az Events telepítése sikerült' );
define( '_CAL_LANG_INSTALL_DB_ENTRIES',	'Adatbázis-bejegyzések, változások' );
define( '_CAL_LANG_INSTALL_PREV_INST',	'A dupla adatbázis-bejegyzések eltávolítása megtörtént' );

DEFINE("_CAL_LANG_EVENT_ALLDAY","Egész napos vagy meghatározatlan idõtartamú esemény");  // new for 1.4


?>

