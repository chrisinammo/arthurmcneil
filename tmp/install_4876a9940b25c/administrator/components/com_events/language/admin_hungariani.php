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


defined( '_VALID_MOS' ) or die( 'A k�zvetlen hozz�f�r�s tilos!' );

//Check
if( defined( '_CAL_ADMIN_LANG_INCLUDED' )) {
	return;
}

DEFINE( '_CAL_ADMIN_LANG_INCLUDED', 1 );

/* +++++++++++++++++++ */
define( '_CAL_HIDE_OLD_EVENTS',			'Az elavult esem�nyek elrejt�se'); // NEW 1.4
define( '_CAL_LANG_CATEGORIES',   		'Kateg�ri�k' );
define( '_CAL_LANG_DISPLAY',			'Megjelen�t�s' );
define( '_CAL_LANG_CATEGORY_NAME',		'Kateg�ria neve' );
define( '_CAL_LANG_RECORDS',			'Bejegyz�sek' );
define( '_CAL_LANG_CHECKED_OUT',		'Visszav�ve' );
define( '_CAL_LANG_PUBLISHED',			'K�zz�t�ve' );
define( '_CAL_LANG_NOT_PUBLISHED',		'Nincs k�zz�t�ve' );
define( '_CAL_LANG_ACCESS',				'Hozz�f�r�s' );
define( '_CAL_LANG_REORDER',			'�trendez�s' );
define( '_CAL_LANG_UNPUBLISH',			'Visszavon�s' );
define( '_CAL_LANG_PUBLISH',			'K�zz�t�tel' );
define( '_CAL_LANG_CLICK_TO_EDIT',		'Kattints ide a szerkeszt�shez' );
define( '_CAL_LANG_MOVE_UP',			'Fel' );
define( '_CAL_LANG_MOVE_DOWN',			'Le' );
define( '_CAL_LANG_EDIT_CAT',			'Kateg�ria szerkeszt�se' );
define( '_CAL_LANG_ADD_CAT',			'Kateg�ria hozz�ad�sa' );
define( '_CAL_LANG_CAT_TITLE',			'Kateg�ria c�me' );
define( '_CAL_LANG_CAT_NAME',			'Kateg�ria neve' );
define( '_CAL_LANG_IMAGE',				'K�p' );
define( '_CAL_LANG_PREVIEW',			'El�n�zet' );
define( '_CAL_LANG_IMG_POSITION',		'K�p elhelyez�se' );
define( '_CAL_LANG_ORDERING',			'Sorrend' );
define( '_CAL_LANG_LEFT',				'Balra' );
define( '_CAL_LANG_CENTER',				'K�z�pre' );
define( '_CAL_LANG_RIGHT',				'Jobbra' );
define( '_CAL_LANG_SELECT_IMAGE',		'V�lasszon k�pet' );
define( '_CAL_LANG_SEARCH',				'Keres�s' );
define( '_CAL_LANG_TITLE',				'C�m' );
define( '_CAL_LANG_REPEAT',				'Ism�tl�d�s' );
define( '_CAL_LANG_TIME_SHEET',			'Id�rend' );
define( '_CAL_CLICK_TO_CHANGE_STATUS',	'Kattints az ikonra az �llapot �tv�lt�s�hoz' );
define( '_CAL_LANG_PUB_BUT_COMING',		'K�zz�t�ve, �s <u>esed�kes</u>' );
define( '_CAL_LANG_PUB_ACTUAL',			'K�zz�t�ve, �s a <u>jelenlegi</u>' );
define( '_CAL_LANG_PUB_FINISHED',		'K�zz�t�ve, de <u>befejez�d�tt</u>' );
define( '_CAL_LANG_EDIT_EVENT',			'Esem�ny m�dos�t�sa' );
define( '_CAL_LANG_ADD_EVENT',			'�j esem�ny' );
define( '_CAL_LANG_REQUIRED',			'k�telez�' );
define( '_CAL_LANG_IMG_FOLDER',			'Alk�nyvt�r' );
define( '_CAL_LANG_IMAGES',				'Gal�riak�pek' );
define( '_CAL_LANG_AVAL_IMAGES',		'L�tez� k�pek' );
define( '_CAL_LANG_INSERT_IMG',			'Besz�r�s &raquo;' );
define( '_CAL_LANG_CONTENT_IMGS',		'Tartalmi elem k�pei' );
define( '_CAL_LANG_REMOVE',				'elt�vol�t�s' );
define( '_CAL_LANG_EDITED_SEL_IMG',		'A kijel�lt k�p szerkeszt�se' );
define( '_CAL_LANG_SOURCE',				'Forr�s' );
define( '_CAL_LANG_ALIGN',				'Igaz�t�s' );
define( '_CAL_LANG_ALT_TXT',			'Helyettes�t� sz�veg' );
define( '_CAL_LANG_BORDER',				'Szeg�ly' );
define( '_CAL_LANG_CAPTION',			'Al��r�s');
define( '_CAL_LANG_CAPTION_POSITION',	'Al��r�s elhelyez�se');
define( '_CAL_LANG_CAPTION_POS_BOTTOM',	'Lent');
define( '_CAL_LANG_CAPTION_POS_TOP',	'F�nt');
define( '_CAL_LANG_CAPTION_ALIGN',		'Al��r�s igaz�t�sa');
define( '_CAL_LANG_CAPTION_WIDTH',		'Al��r�s sz�less�ge');
define( '_CAL_LANG_APPLY',				'Alkalmaz' );
define( '_CAL_LANG_ADD_INFO',			'Kieg�sz�t� inform�ci�' );
define( '_CAL_LANG_EVENT_STATUS',		'Esem�ny �llapota' );
define( '_CAL_LANG_ARCHIVED',			'Archiv�lt' );
define( '_CAL_LANG_DRAFT_UNPUB',		'Kiadatlan k�zirat' );
define( '_CAL_LANG_NEVER',				'Soha' );
define( '_CAL_LANG_CUT_TITLE',			'C�m hossza' );
define( '_CAL_LANG_MAX_DISPLAY',		'Esem�nyek megjelen�tend� sz�ma' );
define( '_CAL_LANG_DIS_STARTTIME',		'Kezd� id�pont megjelen�t�se' );

	// config
define( '_CAL_LANG_EVENTS_CONFIG',		'JEvents be�ll�t�sai' );
define( '_CAL_LANG_CONFIG_WRITEABLE',	'A konfigur�ci�s f�jl �rhat�' );
define( '_CAL_LANG_CONFIG_NOT_WRITEABLE','A konfigur�ci�s f�jl nem �rhat�' );
define( '_CAL_LANG_CSS_WRITEABLE',		'A CSS f�jl �rhat�' );
define( '_CAL_LANG_CSS_NOT_WRITEABLE',	'A CSS f�jl nem �rhat�' );
define( '_CAL_LANG_ADMIN_EMAIL',		'Adminisztr�tor email c�me' );
define( '_CAL_LANG_FRONTEND_PUBLISHING','K�zz�t�tel a l�togat�i oldalr�l' );
define( '_CAL_LANG_SETT_FOR_COM',		'Az al�bbi be�ll�t�sok csak a komponensre vonatkoznak' );
define( '_CAL_LANG_SETT_FOR_CAL_MOD',	'Az al�bbi be�ll�t�sok csak a kieg�sz�t� napt�rmodulra vonatkoznak' );
define( '_CAL_LANG_SETT_FOR_MOD_LATEST','Az al�bbi be�ll�t�sok csak az [ �j esem�nyek ] kieg�sz�t� modulra vonatkoznak' );
define( '_CAL_LANG_ICONIC_NAVBAR'		,'�j navig�ci�s ikons�v haszn�lata'); // 1.4
define( '_CAL_LANG_CHECK_VERSION'		,"�j verzi� ellen�rz�se"); // 1.4

// errors
define( '_CAL_LANG_ERR_CAT_MUST_HAVE_NAME',	'Adj nevet a kateg�ri�nak!' );

// title & alts
define( '_CAL_LANG_TIT_NAME_FOR_MENUS',	'A men�kben l�that� r�vid n�v' );
define( '_CAL_LANG_TIT_LONG_NAME',		'A c�msorban megjelen�tett hossz� n�v' );
define( '_CAL_LANG_TIT_PENDING',		'F�gg�ben' );

// msgs
define( '_CAL_LANG_MSG_CAT_IS_EDITED',	'A kateg�ri�t [ %s ] �pp egy m�sik adminisztr�tor szerkeszti' ); // %s = $row->title
define( '_CAL_LANG_MSG_OP_FAILED',		'Sikertelen m�velet: nem nyithat� meg a(z) [ %s ]' ); // %s = $filename
define( '_CAL_LANG_MSG_CHANGE_EMAIL',	'El�bb v�ltoztasd meg a JEVENTS be�ll�t�saiban az EMAIL c�met' );
define( '_CAL_LANG_MSG_ADD_CAT_BEFORE',	'El�bb adj hozz� egy kateg�ri�t ehhez a szekci�hoz' );
define( '_CAL_LANG_MSG_CONFIG_SAVED',	'A be�ll�t�sok ment�se siker�lt' );
define( '_CAL_LANG_MSG_WARNING',		'Figyelmeztet�s...' );
define( '_CAL_LANG_MSG_CHMOD_CONFIG',	'A konfigur�ci�s f�jl CHMOD �rt�k�t �ll�tsd 0777-re, hogy a be�ll�t�sok m�dos�that�k legyenek' );
define( '_CAL_LANG_MSG_CHMOD_CSS',		'A CSS f�jl CHMOD �rt�k�t �ll�tsd 0777-re, hogy a be�ll�t�sok m�dos�that�k legyenek' );
define( '_CAL_LANG_MSG_MOD_NOT_INSTALLED','A napt�rmodult m�g nem telep�tetted' );
define( '_CAL_LANG_MSG_NO_MOD_LATEST',	'Az [ �j esem�nyek ] modult m�g nem telep�tetted' );

// tips
define( '_CAL_LANG_TIP_ACCESS',			'Kinek enged�lyezed az �j esem�nyek bejegyz�s�t' );
define( '_CAL_LANG_TIP_FRONT_PUB',		'A k�zz�tev�k, a kezel�k �s az adminisztr�torok tehetik k�zz� a bejegyz�seket a l�togat�i oldalr�l' );
define( '_CAL_LANG_TIP_NR_OF_LIST',		'A heti, havi vagy �ves n�zetben oldalank�nt kilist�zand� esem�nyek sz�ma' );
define( '_CAL_LANG_TIP_FE_SIMPLE_FORM',	'Az egyszer� (pl. nincsenek ism�tl�d�si t�pusok) esem�nybejegyz�si �rlapot haszn�lja a l�togat�i oldalon' );
define( '_CAL_LANG_TIP_DEF_EC_HIDE_FORCE',	'<b>Esem�nyspecifikus sz�nek haszn�lata enged�lyezett</b><br/>A l�togat�i oldal �s a kiszolg�l�i oldal szerkeszt�i esem�nyspecifikus sz�neket haszn�lhatnak<br/><b>Esem�nysz�nek csak a kiszolg�l� oldali szerkeszt�sben</b><br/>Csak a kiszolg�l�i oldal szerkeszt�i hat�rozhatnak meg esem�nyspecifikus sz�neket<br/><b>Mindig a kateg�riasz�neket haszn�lja</b><br/>A szerkeszt�k nem haszn�lhatnak esem�nyspecifikus sz�neket, �s b�rmilyen esem�nyspecifikus sz�n, melyet eme be�ll�t�s haszn�lata el�tt defini�ltak, mell�z�sre ker�l, a kateg�riasz�n l�that� helyette' );
define( '_CAL_LANG_TIP_DLM_STOP_DAY',		'A jelenlegi h�nap napjainak sz�ma az el�z� h�nap megjelen�t�s�hez' );
define( '_CAL_LANG_TIP_DNM_START_DAY',		'A jelenlegi h�napb�l h�tral�v� napok sz�ma a k�vetkez� h�nap megjelen�t�s�nek az ind�t�s�hoz' );
define( '_CAL_LANG_TIP_LEV_DAY_RANGE',		'A mai naphoz viszony�tott id�tartam napban az esem�nyek megjelen�t�s�hez (csak az 1. �s a 3. m�dban)' );
define( '_CAL_LANG_TIP_LEV_DISPLAY_YEAR',	'Az �vsz�m kijelz�se az esem�ny d�tum�ban (csak az alap�rtelmezett form�tumban)' );
define( '_CAL_LANG_TIP_BTN_DEF_CONFIG',		'Bet�lti az alap�rtelmez�s szerinti �rt�keket [abban az esetben, ha valamit elrontott�l]' );
define( '_CAL_LANG_TIP_LEV_DISPLAY_MODE',	'0 (alap�rtelmezett) a jelenlegi h�t legk�zelebbi esem�nyeit jelen�ti meg, a k�vetkez� hetet csak az esem�nyes legnagyobb sz�m�ig<br />1 ugyanaz, mint a [ mode = 0 ], azzal a kiv�tellel, hogy a jelenlegi h�t elavult esem�nyei is l�that�k lesznek, ha a j�v�beli esem�nyek sz�ma kisebb az esem�nyek maxim�lis sz�m�n�l<br />2 a [ + napok ] id�k�z a mai naphoz viszony�tott legk�zelebbi esem�nyeit jelen�ti meg a $maxEvents sz�m�ig<br />3 ugyanaz, mint a 2. m�d, azzal a kiv�tellel, hogy a maxim�lis esem�nyekn�l kevesebb van az id�tartamban, majd a mai naphoz viszony�tva  megjelen�ti az elavult esem�nyeket a [ - napok ] tartom�nyban<br />4 a jelenlegi h�nap legk�zelebbi esem�nyeit jelen�ti meg a mai naphoz viszony�tva az oldalank�nti sz�mban' );
define( '_CAL_LANG_TIP_CUT_TITLE',			'Ha t�l sok jel van egy c�mben, akkor annak nem k�v�natos tervez�s lehet az eredm�nye.<br />Adon meg itt x jelet, ami ut�n a c�met ler�vid�tj�k, �s besz�rjuk a ... jelet' );
define( '_CAL_LANG_TIP_LEV_HIDE_LINK',		'Ha az IGEN-t v�lasztja, akkor a JavaScript &lt;b&gt;onclick&lt;/b&gt; esem�ny dinamikusan v�gzi a c�mcsatol�st. Ezzel megakad�lyozhatja, hogy a keres�motorok k�vethess�k a hivatkoz�st');
define( '_CAL_LANG_TIP_MAX_DISPLAY',		'A <strong>sz�vegk�nt</strong> megjelen�tend� esem�nyek sz�ma naponta havi n�zetben<br />Ha sok esem�nye van naponta, megjelen�t�s�k rombolhatja az elrendez�st.<br />Itt adhatja meg, hogy h�ny esem�ny legyen l�that� sz�vegk�nt, ha t�l sok van, akkor ikonnal t�rt�nik a megjelen�t�s�k (a bubor�kra nincs hat�ssal)<br /><strong>Tipp</strong>: Az �rt�k 0-ra [null�ra] �ll�t�sa az �sszes esem�ny ikonnal t�rt�n� megjelen�t�s�re k�nyszer�t' );
define( '_CAL_LANG_TIP_DIS_STARTTIME',		'Legyen-e l�that� a kezd� id�pont [ havi n�zetben ]' );
	// tooltips
define( '_CAL_LANG_TIP_TT_BGROUND',			'A bubor�knak az esem�ny�vel azonos legyen-e a h�tt�rsz�ne.<br />Nem eset�n a szok�sos sz�n ker�l felhaszn�l�sra' );
define( '_CAL_LANG_TIP_TT_POSX',			'A bubor�k elhelyez�se t�rt�nhet balra, k�z�pre vagy jobbra' );
define( '_CAL_LANG_TIP_TT_POSY',			'A bubor�k f�gg�leges elhelyez�se t�rt�nhet al� vagy f�l�' );
define( '_CAL_LANG_TIP_TT_SHADOW',			'A bubor�knak lehet �rny�ka, amit balra vagy jobbra, ill. alul vagy fel�l helyezhet el' );

// tabs
define( '_CAL_LANG_TAB_COMMON',			'�ltal�nos' );
define( '_CAL_LANG_TAB_IMAGES',			'K�pek' );
define( '_CAL_LANG_TAB_CALENDAR',		'Napt�r' );
define( '_CAL_LANG_TAB_HELP',			'S�g�' );
define( '_CAL_LANG_TAB_EXTRA',			'�sszegz�s' );
define( '_CAL_LANG_TAB_ABOUT',			'N�vjegy' );
define( '_CAL_LANG_TAB_COMPONENT',		'Komponens' );
define( '_CAL_LANG_TAB_CAL_MOD',		'Napt�r' );
define( '_CAL_LANG_TAB_LATEST_MOD',		'�j esem�nyek' );
define( '_CAL_LANG_TAB_CSS',			'CSS' );
define( '_CAL_LANG_TAB_TOOLTIP',		'Bubor�k' );

// select lists
	//common
define( '_CAL_LANG_YES',				'Igen' );
define( '_CAL_LANG_NO',					'Nem' );
define( '_CAL_LANG_ALWAYS',				'MINDIG' );
	// access
define( '_CAL_LANG_SEL_ACCESS_ALL_REGGED',	'Minden regisztr�lt felhaszn�l�' );
define( '_CAL_LANG_SEL_ACCESS_SPECIAL',		'Csak a speci�lisak �s az adminisztr�torok' );
define( '_CAL_LANG_SEL_ACCESS_ALL_ANONYM',	'Mindenki (n�vtelenek) - nem aj�nlott' );
define( '_CAL_LANG_SEL_ACCESS_ALL_AUTHORS',	'Szerz�k �s f�l�tte' );
define( '_CAL_LANG_SEL_ACCESS_ALL_EDITORS',	'Szerkeszt�k �s f�l�tte' );
define( '_CAL_LANG_SEL_ACCESS_ALL_PUBLISHERS',	'K�zz�tev�k �s f�l�tte' );
define( '_CAL_LANG_SEL_ACCESS_ALL_MANAGERS',	'Kezel�k �s f�l�tte' );
define( '_CAL_LANG_SEL_ACCESS_ALL_ADMIN',	'Csak az adminisztr�torok �s a f�adminisztr�torok' );
	// first day
define( '_CAL_LANG_FIRST_DAY',			'A h�t els� napja' );
define( '_CAL_LANG_SUNDAY_FIRST',		'Vas�rnap' );
define( '_CAL_LANG_MONDAY_FIRST',		'H�tf�' );

define( '_CAL_LANG_VIEW_MAIL',			'Az email c�m megjelen�t�se' );
define( '_CAL_LANG_VIEW_BY',			'A "Be�rta" megjelen�t�se' );
define( '_CAL_LANG_VIEW_HITS',			'A "Tal�latok" megjelen�t�se' );
define( '_CAL_LANG_VIEW_REPEAT_TIME',	'Az ism�tl�d�s �s az id�pont megjelen�t�se' );
define( '_CAL_LANG_VIEW_REPEAT_YEAR_LIST',	'Az �sszes ism�tl�d� esem�ny megjelen�t�se az �ves list�ban' );
define( '_CAL_LANG_SHOW_CATS',			'A "Kateg�ri�nk�nt" elrejt�se (csak akkor, ha az esem�nyek jelmagyar�zata modul l�that�)' );
define( '_CAL_LANG_SHOW_COPYRIGHT',		'A szerz�i jogi inform�ci�t megjelen�t� l�bjegyzet megjelen�t�se');
	// date format
define( '_CAL_LANG_DATE_FORMAT',		'D�tum form�tuma' );
define( '_CAL_LANG_DATE_FORMAT_FR_EN',	'Francia-angol' );
define( '_CAL_LANG_DATE_FORMAT_US',		'Amerikai' );
define( '_CAL_LANG_DATE_FORMAT_GERMAN',	'Eur�pai - N�met' );

define( '_CAL_LANG_TIME_FORMAT_12',		'Az id� kijelz�se 12 �r�s form�tumban' );
	// nav bar
define( '_CAL_LANG_NAV_BAR_COLOR',		'Navig�ci�s s�v sz�ne' );
define( '_CAL_LANG_NAV_BAR_GREEN',		'Z�ld' );
define( '_CAL_LANG_NAV_BAR_ORANGE',		'Narancss�rga' );
define( '_CAL_LANG_NAV_BAR_BLUE',		'K�k' );
define( '_CAL_LANG_NAV_BAR_RED',		'Piros' );
define( '_CAL_LANG_NAV_BAR_GRAY',		'Sz�rke' );
define( '_CAL_LANG_NAV_BAR_YELLOW',		'S�rga' );

	// start page
define( '_CAL_LANG_START_PAGE',			'Kezd� oldal' );
define( '_CAL_LANG_SP_DAY',				'Nap' );
define( '_CAL_LANG_SP_WEEK',			'H�t' );
define( '_CAL_LANG_SP_MONTH_CAL',		'H�nap (napt�r)' );
define( '_CAL_LANG_SP_MONTH_LIST',		'H�nap (lista)' );
define( '_CAL_LANG_SP_YEAR',			'�v' );
define( '_CAL_LANG_SP_CATEGORIES',		'Kateg�ria' );
define( '_CAL_LANG_SP_SEARCH',			'Keres�s' );

define( '_CAL_LANG_NR_OF_LIST',			'Esem�nyek oldalank�nti sz�ma' );
define( '_CAL_LANG_FE_SIMPLE_FORM',		'Egyszer� m�d haszn�lata' );
	// event color
define( '_CAL_LANG_DEF_EVENT_COLOR',	'Alap�rtelmezett esem�nysz�n' );
define( '_CAL_LANG_DEF_EC_RANDOM',		'V�letlenszer�' );
define( '_CAL_LANG_DEF_EC_NONE',		'Nincs' );
define( '_CAL_LANG_DEF_EC_CATEGORY',	'Kateg�ria' );
define( '_CAL_LANG_DEF_EC_HIDE_FORCE',	'Esem�nysz�n szab�lya' );
define( '_CAL_LANG_EVENT_COLS_ALLOWED',	'Esem�nyspecifikus sz�nek haszn�lata enged�lyezett' );
define( '_CAL_LANG_EVENT_COLS_BACKED',	'Esem�nysz�nek csak a kiszolg�l� oldali szerkeszt�sben' );
define( '_CAL_LANG_ALWAYS_CAT_COLOR',	'Mindig a kateg�riasz�neket haszn�lom' );

	// tooltips
define( '_CAL_LANG_ABOVE',				'F�l�' );
define( '_CAL_LANG_BELOW',				'Al�' );

// calendar module
	// display last month
define( '_CAL_LANG_DISPLAY_LAST_MONTH',	'Az el�z� h�nap megjelen�t�se' );
define( '_CAL_LANG_DLM_YES_STOP_DAY',	'IGEN - az utols� nappal' );
define( '_CAL_LANG_DLM_YES_EVENT_SDAY',	'IGEN - ha vannak esem�nyek �S az utols� nappal' );
define( '_CAL_LANG_DLM_ALWYS_IF_EVENTS','MINDIG - ha vannak esem�nyek' );
	// stop day
define( '_CAL_LANG_DLM_STOP_DAY',		'A jelenlegi h�nap napjainak sz�ma a le�ll�t�shoz' );
	// display next month
define( '_CAL_LANG_DISPLAY_NEXT_MONTH',	'A k�vetkez� h�nap megjelen�t�se' );
define( '_CAL_LANG_DNM_YES_START_DAY',	'IGEN - az els� nappal' );
define( '_CAL_LANG_DNM_YES_EVENT_SDAY', 'IGEN - ha vannak esem�nyek �S az els� nappal' );
define( '_CAL_LANG_DNM_ALWYS_IF_EVENTS','MINDIG - ha vannak esem�nyek' );
	// start day
define( '_CAL_LANG_DNM_START_DAY',		'A jelenlegi h�napb�l h�tral�v� napok sz�ma a kezd�shez' );

// latest events module
define( '_CAL_LANG_LEV_MAX_DISPLAY',	'A megjelen�tend� esem�nyek sz�ma' );
define( '_CAL_LANG_LEV_DISPLAY_MODE',	'Megjelen�t�si m�d' );
define( '_CAL_LANG_LEV_DAY_RANGE',		'Napok sz�ma el�tte-ut�na' );
define( '_CAL_LANG_LEV_REP_EV_ONCE',	'Egy ism�tl�d� esem�ny megjelen�t�se csak egyszer' );
define( '_CAL_LANG_LEV_EV_AS_LINK',		'Az esem�nyek megjelen�t�se hivatkoz�sk�nt' );
define( '_CAL_LANG_LEV_DISPLAY_YEAR',	'�vsz�m kijelz�se' );
define( '_CAL_LANG_LEV_CSS_DATE_FIELD',	'Az alap�rtelmezett CSS d�tummez� st�lus�nak letilt�sa' );
define( '_CAL_LANG_LEV_CSS_TITLE_FIELD','Az alap�rtelmezett CSS c�mmez� st�lus�nak letilt�sa' );
define( '_CAL_LANG_LEV_HIDE_LINK',		'C�mcsatol�s elrejt�se');
define( '_CAL_LANG_LEV_CUST_FORM_STRING','Egyedi form�z�si karakterl�nc' );

// tooltips frontpage (overlib)
define( '_CAL_LANG_TOOLTIP',			'Az al�bbi be�ll�t�sok a havi n�zetben l�that� bubor�kra vonatkoznak' );
define( '_CAL_LANG_TT_MAINWINDOW',		'Bubor�k f�ablaka' );
define( '_CAL_LANG_TT_BGROUND',			'Az esem�ny�vel azonos h�tt�r' );
define( '_CAL_LANG_TT_POSX',			'V�zszintes elhelyez�s' );
define( '_CAL_LANG_TT_POSY',			'F�gg�leges elhelyez�s' );
define( '_CAL_LANG_TT_SHADOW',			'�rny�k' );
define( '_CAL_LANG_TT_SHADOWX',			'Balra' );
define( '_CAL_LANG_TT_SHADOWY',			'Fent' );

// buttons
define( '_CAL_LANG_BTN_DEF_CONFIG',		'Alaphelyzet' );

// installation
define( '_CAL_LANG_INSTAL_MAIN',		'Esem�nyek' );
define( '_CAL_LANG_INSTAL_MANAGE',		'Esem�nyek kezel�se' );
define( '_CAL_LANG_INSTAL_CATS',		'Kateg�ri�k kezel�se' );
define( '_CAL_LANG_INSTAL_CONFIG',		'Konfigur�ci�' );
define( '_CAL_LANG_INSTAL_ARCHIVE',		'Arch�vum' );
define( '_CAL_LANG_INSTAL_ERROR',		'A k�vetkez� hib�k mer�ltek f�l' );
define( '_CAL_LANG_INSTAL_SUCCESS',		'Az Events telep�t�se siker�lt' );
define( '_CAL_LANG_INSTALL_DB_ENTRIES',	'Adatb�zis-bejegyz�sek, v�ltoz�sok' );
define( '_CAL_LANG_INSTALL_PREV_INST',	'A dupla adatb�zis-bejegyz�sek elt�vol�t�sa megt�rt�nt' );

DEFINE("_CAL_LANG_EVENT_ALLDAY","Eg�sz napos vagy meghat�rozatlan id�tartam� esem�ny");  // new for 1.4


?>

