<?php
/**
 * Events Component for Joomla 1.0.x
 *
 * @version     $Id: admin_german.php 1068 2008-04-28 16:32:29Z tstahl $
 * @package     Events
 * @copyright   Copyright (C) 2006-2008 JEvents Project Group
 * @copyright   Copyright (C) 2000 - 2003 Eric Lamette, Dave McDonnell
 * @licence     http://www.gnu.org/copyleft/gpl.html
 * @link        http://joomlacode.org/gf/project/jevents
 */

defined( '_VALID_MOS' ) or die( 'Direkter Zugriff zu diesem Bereich ist nicht erlaubt.' );

//Check
if( defined( '_CAL_ADMIN_LANG_INCLUDED' )) {
	return;
}

DEFINE( '_CAL_ADMIN_LANG_INCLUDED', 1 );

/* +++++++++++++++++++ */

define( '_CAL_HIDE_OLD_EVENTS',			'Unterdr&uuml;cke abgelaufene Events'); // NEW 1.4
define( '_CAL_LANG_CATEGORIES',   		'Kategorien' );
define( '_CAL_LANG_DISPLAY',			'Anzeigen' );
define( '_CAL_LANG_CATEGORY_NAME',		'Kategorienname' );
define( '_CAL_LANG_RECORDS',			'Eintr&auml;ge' );
define( '_CAL_LANG_CHECKED_OUT',		'Gesperrt' );
define( '_CAL_LANG_PUBLISHED',			'Ver&ouml;ffentlicht' );
define( '_CAL_LANG_NOT_PUBLISHED',		'Nicht Ver&ouml;ffentlicht' );
define( '_CAL_LANG_ACCESS',				'Berechtigt' );
define( '_CAL_LANG_REORDER',			'Reihenfolge' );
define( '_CAL_LANG_UNPUBLISH',			'Ver&ouml;ffentlichung zur&uuml;cknehmen' );
define( '_CAL_LANG_PUBLISH',			'Ver&ouml;ffentlichen' );
define( '_CAL_LANG_CLICK_TO_EDIT',		'Zum Bearbeiten anklicken' );
define( '_CAL_LANG_MOVE_UP',			'Hinauf' );
define( '_CAL_LANG_MOVE_DOWN',			'Hinab' );
define( '_CAL_LANG_EDIT_CAT',			'Kategorie bearbeiten' );
define( '_CAL_LANG_ADD_CAT',			'Kategorie hinzuf&uuml;gen' );
define( '_CAL_LANG_CAT_TITLE',			'Kategorietitel' );
define( '_CAL_LANG_CAT_NAME',			'Kategoriename' );
define( '_CAL_LANG_IMAGE',				'Bild' );
define( '_CAL_LANG_PREVIEW',			'Vorschau' );
define( '_CAL_LANG_IMG_POSITION',		'Bildposition' );
define( '_CAL_LANG_ORDERING',			'Reihenfolge' );
define( '_CAL_LANG_LEFT',				'Links' );
define( '_CAL_LANG_CENTER',				'Zentriert' );
define( '_CAL_LANG_RIGHT',				'Rechts' );
define( '_CAL_LANG_SELECT_IMAGE',		'Bild Ausw&auml;hlen' );
define( '_CAL_LANG_SEARCH',				'Suche' );
define( '_CAL_LANG_TITLE',				'Titel' );
define( '_CAL_LANG_REPEAT',				'Wiederholung' );
define( '_CAL_LANG_TIME_SHEET',			'Zeitplan' );
define( '_CAL_CLICK_TO_CHANGE_STATUS',	'Auf Icon klicken um Status zu &auml;ndern' );
define( '_CAL_LANG_PUB_BUT_COMING',		'Ver&ouml;ffentlicht aber noch nicht <u>Aktuell</u>' );
define( '_CAL_LANG_PUB_ACTUAL',			'Ver&ouml;ffentlicht und <u>Aktuell</u>' );
define( '_CAL_LANG_PUB_FINISHED',		'Ver&ouml;ffentlicht aber schon <u>Abgelaufen</u>' );
define( '_CAL_LANG_EDIT_EVENT',			'Termin bearbeiten' );
define( '_CAL_LANG_ADD_EVENT',			'Neuer Termin' );
define( '_CAL_LANG_REQUIRED',			'erforderlich' );
define( '_CAL_LANG_IMG_FOLDER',			'Bilderverzeichnis' );
define( '_CAL_LANG_IMAGES',				'Bilder' );
define( '_CAL_LANG_AVAL_IMAGES',		'Verf&uuml;gbare Bilder' );
define( '_CAL_LANG_INSERT_IMG',			'Einf&uuml;gen &raquo;' );
define( '_CAL_LANG_CONTENT_IMGS',		'Bereits in Verwendung' );
define( '_CAL_LANG_REMOVE',				'Entfernen' );
define( '_CAL_LANG_EDITED_SEL_IMG',		'Gew&auml;hltes Bild bearbeiten' );
define( '_CAL_LANG_SOURCE',				'Name' );
define( '_CAL_LANG_ALIGN',				'Ausrichtung' );
define( '_CAL_LANG_ALT_TXT',			'Alt.Text' );
define( '_CAL_LANG_BORDER',				'Rahmen' );
define( '_CAL_LANG_CAPTION',			'Bildunterschrift');
define( '_CAL_LANG_CAPTION_POSITION',	'Position Bildunterschrift');
define( '_CAL_LANG_CAPTION_POS_BOTTOM',	'Unten');
define( '_CAL_LANG_CAPTION_POS_TOP',	'Oben');
define( '_CAL_LANG_CAPTION_ALIGN',		'Ausrichtung Bildunterschrift');
define( '_CAL_LANG_CAPTION_WIDTH',		'Breite Bildunterschrift');
define( '_CAL_LANG_APPLY',				'&Uuml;bernehmen' );
define( '_CAL_LANG_ADD_INFO',			'Weitere Termininfos' );
define( '_CAL_LANG_EVENT_STATUS',		'Terminstatus' );
define( '_CAL_LANG_ARCHIVED',			'Archiviert' );
define( '_CAL_LANG_DRAFT_UNPUB',		'Entwurf - Unver&ouml;ffentlicht' );
define( '_CAL_LANG_NEVER',				'Nie' );
define( '_CAL_LANG_CUT_TITLE',			'Titell&auml;nge' );
define( '_CAL_LANG_MAX_DISPLAY',		'Max. Termine als Text' );
define( '_CAL_LANG_DIS_STARTTIME',		'Beginnzeit anzeigen' );

	// config
define( '_CAL_LANG_EVENTS_CONFIG',		'JEvents Konfiguration' );
define( '_CAL_LANG_CONFIG_WRITEABLE',	'Konfiguration ist beschreibbar' );
define( '_CAL_LANG_CONFIG_NOT_WRITEABLE','Konfiguration ist nicht beschreibbar' );
define( '_CAL_LANG_CSS_WRITEABLE',		'CSS-Datei ist beschreibbar' );
define( '_CAL_LANG_CSS_NOT_WRITEABLE',	'CSS-Datei ist nicht beschreibbar' );
define( '_CAL_LANG_ADMIN_EMAIL',		'Admin-Email' );
define( '_CAL_LANG_FRONTEND_PUBLISHING','Frontendver&ouml;ffentlichungen' );
define( '_CAL_LANG_SETT_FOR_COM',		'Diese Einstellungen betreffen nur die Komponente' );
define( '_CAL_LANG_SETT_FOR_CAL_MOD',	'Diese Enstellungen betreffen nur das zus&auml;tzliche Modul MiniKalender (mod_events_cal)' );
define( '_CAL_LANG_SETT_FOR_MOD_LATEST','Diese Enstellungen betreffen nur das zus&auml;tzliche Modul N&auml;chsteTermine (mod_events_latest)' );
define( '_CAL_LANG_ICONIC_NAVBAR'		,'Verwende Icons als Navigationsleiste'); // 1.4
define( '_CAL_LANG_CHECK_VERSION'		,"Nach neuerer Version suchen"); // 1.4

// errors
define( '_CAL_LANG_ERR_CAT_MUST_HAVE_NAME',	'Kategorie muss einen Namen haben!' );
// title & alts
define( '_CAL_LANG_TIT_NAME_FOR_MENUS',	'Kurzname f&uuml;r Men&uuml;s' );
define( '_CAL_LANG_TIT_LONG_NAME',		'Kategoriename welcher in den &Uuml;berschriften angezeigt wird' );
define( '_CAL_LANG_TIT_PENDING',		'Wartend' );

// msgs
define( '_CAL_LANG_MSG_CAT_IS_EDITED',	'Die Kategorie [ %s ] wird momentan von einem anderen Administrator bearbeitet' );
define( '_CAL_LANG_MSG_OP_FAILED',		'Vorgang abgebrochen: konnte [ %s ] nicht &ouml;ffnen!' );
define( '_CAL_LANG_MSG_CHANGE_EMAIL',	'Bitte zuerst die Konfiguration aufrufen UND die Emailadresse &auml;ndern!' );
define( '_CAL_LANG_MSG_ADD_CAT_BEFORE',	'Zuerst muss eine Kategorie angelegt werden' );
define( '_CAL_LANG_MSG_CONFIG_SAVED',	'Konfiguration erfolgreich gesichert' );
define( '_CAL_LANG_MSG_WARNING',		'ACHTUNG .....' );
define( '_CAL_LANG_MSG_CHMOD_CONFIG',	'Die Rechte der Konfigurationsdatei m&uuml;ssen vor dem Bearbeiten/Speichern ge&auml;ndert werden!' );
define( '_CAL_LANG_MSG_CHMOD_CSS',		'Die Rechte der CSS-Datei m&uuml;ssen vor dem Bearbeiten/Speichern ge&auml;ndert werden!' );
define( '_CAL_LANG_MSG_MOD_NOT_INSTALLED','Das Kalendermodul ist nicht installiert' );
define( '_CAL_LANG_MSG_NO_MOD_LATEST',	'Das Modul [ neueste Termine ] ist nicht installiert' );

// tips
define( '_CAL_LANG_TIP_ACCESS',			'Wer darf neue neue Termine/Veranstaltungen erstellen' );
define( '_CAL_LANG_TIP_FRONT_PUB',		'D&uuml;rfen neue Termine im Frontend ver&ouml;ffentlicht werden' );
define( '_CAL_LANG_TIP_NR_OF_LIST',		'Anzahl der Termine welche in der Wochen-, Monats- und Jahresansicht angezeigt werden sollen' );
define( '_CAL_LANG_TIP_FE_SIMPLE_FORM',	'Soll f&uuml;r das Eintragen neuer Termine im Frontend ein einfaches Formular (z.B. ohne Wiederholungstermine) angezeigt werden' );
define( '_CAL_LANG_TIP_DEF_EC_HIDE_FORCE',	'<b>frei einstellbar</b><br/>Frontend und Backend Editoren k&ouml;nnen die Farbe des Termins einstellen<br/><b>einstellbar nur im Backend</b><br/>Nur Backend Editoren k&ouml;nnen die Farbe des Termins einstellen<br/><b>immer wie Kategorie</b><br/>Editoren  k&ouml;nnen die Farbe des Termins nicht einstellen und alle eingestellte Farben vor der Wahl dieser Option werden ignoriert. Die Kategoriefarbe wird stattdessen verwendet.' );
define( '_CAL_LANG_TIP_DLM_STOP_DAY',		'Der sogenannte [ Stop-Tag ] ist ein Tag des laufenden Monats welcher bestimmt werden kann um den VOR-Monat nicht anzuzeigen' );
define( '_CAL_LANG_TIP_DNM_START_DAY',		'Wieviele Tage sollen im laufenden Monat noch &uuml;brig sein, um den nachfolgenden Monat anzuzeigen' );
define( '_CAL_LANG_TIP_LEV_DAY_RANGE',		'Anzahl der Tage VOR und NACH dem heutigen Tag um weitere Termine anzuzeigen [nur g&uuml;ltig im Modus 2 und 3]');
define( '_CAL_LANG_TIP_LEV_DISPLAY_YEAR',	'Soll das Jahr im Termin angezeigt werden [nur im Standardformat m&ouml;glich]' );
define( '_CAL_LANG_TIP_BTN_DEF_CONFIG',		'Laded eine Standard-Konfiguration [f&uuml;r den Fall falls mal was schief gegangen sein sollte]' );
define( '_CAL_LANG_TIP_LEV_DISPLAY_MODE',	'0 (Vorgabe) - Anzeige der n&auml;chsten Termine der aktuellen Woche PLUS folgende Woche bis <strong>maximal anzuzeigende Termine</strong><br />1  &Auml;hnlich der Einstellung 0, ausser dass auch Termine der Vorwoche angezeigt werden, wenn die Anzahl der nachfolgenden Termine kleiner als der Maximalwert aller anzuzeigenden Termine ist<br />2  Anzeige der Termine welche am n&auml;chsten der Anzahl <strong>Tage Vor-Nachher</strong> liegen<br />3  &Auml;hnlich dem Modus 2, ausgenommen wenn die maximale Anzahl der anzuzeigenden Termine innerhalb des Bereichs liegen, werden auch die bereits vergangenen Termin angezeigt (Relativ zum heutigen Tag)<br />4  Anzeige der am n&auml;chsten liegenden Termine bis zum Maximalwert des aktuellen Monats - relativ zum heutigen Tag' );
define( '_CAL_LANG_TIP_CUT_TITLE',			'Anzahl der Zeichen f&uuml;r den Titel in der Kalenderansicht<br />Bei &Uuml;berl&auml;ngen des Titels (z.B. 1 Wort hat mehr als 20 Buchstaben) kann es zu unsch&ouml;nen Designanzeigen kommen, daher hier nicht zu viele Buchstaben angeben.<br />Der Title wird dann nach x Zeichen abgeschnitten und mit ... erg&auml;nzt)' );
define( '_CAL_LANG_TIP_LEV_HIDE_LINK',		'Soll der Titellink mit Javascript Event &lt;b&gt;onclick&lt;/b&gt; gemacht werden. Suchroboter folgen diesem Link nicht');
define( '_CAL_LANG_TIP_MAX_DISPLAY',		'Maximalanzahl der anzuzeigenden Termine <strong>in Textform</strong> pro Tag in der Monatsansicht<br />Sind sehr viele Termine vorhanden, kann es dadurch zu unsch&ouml;nen Bildschirmausgaben kommen.<br />&Uuml;bersteigt die t&auml;gliche Anzahl der Termine den hier angegebenen Wert, werden die Termine nur mit einem Icon statt als Text angezeigt (Tooltip wird nicht ge&auml;ndert)<br /><strong>Hinweis</strong>: wird hier 0 [Null] angegeben, werden alle Termine als Icon angezeigt' );
define( '_CAL_LANG_TIP_DIS_STARTTIME',		'Hier kann definiert werden, ob die Beginnzeit in der <strong>Monats&uuml;bersicht</strong> angezeigt werden soll' );
	// tooltips
define( '_CAL_LANG_TIP_TT_BGROUND',			'Soll der gleiche Hintergrund wie der Kalendereintrag verwendet werden<br />Bei Nein wird der Standardhintergrund verwendet' );
define( '_CAL_LANG_TIP_TT_POSX',			'Das ToolTip-Fenster kann entweder links, rechts oder mittig zum Termineintrag ausgerichtet werden' );
define( '_CAL_LANG_TIP_TT_POSY',			'Das ToolTip-Fenster kann entweder oberhalb oder unterhalb des  Termineintrages ausgerichtet werden' );
define( '_CAL_LANG_TIP_TT_SHADOW',				'Das Tootip-Fenster kann mit einem Schatten versehen werden welcher entweder links, oder rechts, sowie ober- oder unterhalb positioniert werden kann' );

// tabs
define( '_CAL_LANG_TAB_COMMON',			'Allgemein' );
define( '_CAL_LANG_TAB_IMAGES',			'Bilder' );
define( '_CAL_LANG_TAB_CALENDAR',		'Kalender' );
define( '_CAL_LANG_TAB_HELP',			'Hilfe' );
define( '_CAL_LANG_TAB_EXTRA',			'Extra' );
define( '_CAL_LANG_TAB_ABOUT',			'&Uuml;ber' );
define( '_CAL_LANG_TAB_COMPONENT',		'Komponente' );
define( '_CAL_LANG_TAB_CAL_MOD',		'MiniKalender' );
define( '_CAL_LANG_TAB_LATEST_MOD',		'N&auml;chsteTermine' );
define( '_CAL_LANG_TAB_CSS',			'CSS' );
define( '_CAL_LANG_TAB_TOOLTIP',		'Tooltip' );

// select lists
	//common
define( '_CAL_LANG_YES',				'Ja' );
define( '_CAL_LANG_NO',					'Nein' );
define( '_CAL_LANG_ALWAYS',				'Immer' );
	// access
define( '_CAL_LANG_SEL_ACCESS_ALL_REGGED',	'Alle registrierten Benutzer' );
define( '_CAL_LANG_SEL_ACCESS_SPECIAL',		'Nur mit spezellen Rechten und Admins' );
define( '_CAL_LANG_SEL_ACCESS_ALL_ANONYM',	'&raquo; Alle (Anonym) - Nicht empfohlen! &laquo;' );
define( '_CAL_LANG_SEL_ACCESS_ALL_AUTHORS',	'Authoren und h&ouml;her' );
define( '_CAL_LANG_SEL_ACCESS_ALL_EDITORS',	'Editoren und h&ouml;her' );
define( '_CAL_LANG_SEL_ACCESS_ALL_PUBLISHERS',	'Publisher und h&ouml;her' );
define( '_CAL_LANG_SEL_ACCESS_ALL_MANAGERS',	'Manager und h&ouml;her' );
define( '_CAL_LANG_SEL_ACCESS_ALL_ADMIN',	'nur Admins und Super Admins' );
	// first day
define( '_CAL_LANG_FIRST_DAY',			'Erster Wochentag' );
define( '_CAL_LANG_SUNDAY_FIRST',		'Sonntag erster Tag' );
define( '_CAL_LANG_MONDAY_FIRST',		'Montag erster Tag' );

define( '_CAL_LANG_VIEW_MAIL',			'Email anzeigen' );
define( '_CAL_LANG_VIEW_BY',			'Anzeigen "Von"' );
define( '_CAL_LANG_VIEW_HITS',			'Treffer anzeigen' );
define( '_CAL_LANG_VIEW_REPEAT_TIME',	'Wiederholung(en) anzeigen' );
define( '_CAL_LANG_VIEW_REPEAT_YEAR_LIST',	'Wiederholunge in Jahresliste anzeigen' );
define( '_CAL_LANG_SHOW_CATS',			'Unterdr&uuml;cke Auswahl nach Kategorie(empfohlen wenn Modul "legend module" aktiv)' );
define( '_CAL_LANG_SHOW_COPYRIGHT',		'Anzeigen Copyright Zeile');
	// date format
define( '_CAL_LANG_DATE_FORMAT',		'Datumsformat' );
define( '_CAL_LANG_DATE_FORMAT_FR_EN',	'Franz&ouml;sisch-English');
define( '_CAL_LANG_DATE_FORMAT_US',		'Amerikanisch' );
define( '_CAL_LANG_DATE_FORMAT_GERMAN',	'Kontinental - Deutsch' );

define( '_CAL_LANG_TIME_FORMAT_12',		'Verwende 12-Stunden-Format' );
	// nav bar
define( '_CAL_LANG_NAV_BAR_COLOR',		'Farbe Navigationsleiste' );
define( '_CAL_LANG_NAV_BAR_GREEN',		'Gr&uuml;n' );
define( '_CAL_LANG_NAV_BAR_ORANGE',		'Orange' );
define( '_CAL_LANG_NAV_BAR_BLUE',		'Blau' );
define( '_CAL_LANG_NAV_BAR_RED',		'Rot' );
define( '_CAL_LANG_NAV_BAR_GRAY',		'Grau' );
define( '_CAL_LANG_NAV_BAR_YELLOW',		'Gelb' );

	// start page
define( '_CAL_LANG_START_PAGE',			'Startseite' );
define( '_CAL_LANG_SP_DAY',				'Tag' );
define( '_CAL_LANG_SP_WEEK',			'Woche' );
define( '_CAL_LANG_SP_MONTH_CAL',		'Monat (Kalender)' );
define( '_CAL_LANG_SP_MONTH_LIST',		'Monat (Liste)' );
define( '_CAL_LANG_SP_YEAR',			'Jahr' );
define( '_CAL_LANG_SP_CATEGORIES',		'Kategorien' );
define( '_CAL_LANG_SP_SEARCH',			'Suche' );

define( '_CAL_LANG_NR_OF_LIST',			'Anzahl Termine' );
define( '_CAL_LANG_FE_SIMPLE_FORM',		'Einfaches Formular' );
	// event color
define( '_CAL_LANG_DEF_EVENT_COLOR',	'Farbvorgabe neuer Termin' );
define( '_CAL_LANG_DEF_EC_RANDOM',		'Zuf&auml;llig' );
define( '_CAL_LANG_DEF_EC_NONE',		'Keine' );
define( '_CAL_LANG_DEF_EC_CATEGORY',	'Kategorie' );
define( '_CAL_LANG_DEF_EC_HIDE_FORCE',	'Farbe des Termins' );
define( '_CAL_LANG_EVENT_COLS_ALLOWED',	'frei einstellbar' );
define( '_CAL_LANG_EVENT_COLS_BACKED',	'einstellbar nur im Backend' );
define( '_CAL_LANG_ALWAYS_CAT_COLOR',	'immer wie Kategorie' );
	// tooltips
define( '_CAL_LANG_ABOVE',				'Oben' );
define( '_CAL_LANG_BELOW',				'Unten' );

// calendar module
	// display last month
define( '_CAL_LANG_DISPLAY_LAST_MONTH',	'Vormonat anzeigen' );
define( '_CAL_LANG_DLM_YES_STOP_DAY',	'Ja - mit letztem Tag' );
define( '_CAL_LANG_DLM_YES_EVENT_SDAY',	'Ja - wenn Termine UND Stop-Tag' );
define( '_CAL_LANG_DLM_ALWYS_IF_EVENTS','Immer - nur wenn Termine vorhanden' );
	// stop day
define( '_CAL_LANG_DLM_STOP_DAY',		'Stop-Tag des laufenden Monats' );
	// display next month
define( '_CAL_LANG_DISPLAY_NEXT_MONTH',	'N&auml;chsten Monat anzeigen' );
define( '_CAL_LANG_DNM_YES_START_DAY',	'Ja - mit Starttag' );
define( '_CAL_LANG_DNM_YES_EVENT_SDAY', 'Ja - wenn Termine UND Starttag' );
define( '_CAL_LANG_DNM_ALWYS_IF_EVENTS','Immer - nur wenn Termine vorhanden' );
	// start day
define( '_CAL_LANG_DNM_START_DAY',		'Start-Tag des laufenden Monats' );

// latest events module
define( '_CAL_LANG_LEV_MAX_DISPLAY',	'Maximal x Termine anzeigen' );
define( '_CAL_LANG_LEV_DISPLAY_MODE',	'Anzeigemodus' );
define( '_CAL_LANG_LEV_DAY_RANGE',		'Tage Vor-Nachher');
define( '_CAL_LANG_LEV_REP_EV_ONCE',	'Wiederholungstermin nur einmal anzeigen' );
define( '_CAL_LANG_LEV_EV_AS_LINK',		'Termine als Link anzeigen' );
define( '_CAL_LANG_LEV_DISPLAY_YEAR',	'Jahr anzeigen' );
define( '_CAL_LANG_LEV_CSS_DATE_FIELD',	'CSS f&uuml;r Datumsfeld ausschalten' );
define( '_CAL_LANG_LEV_CSS_TITLE_FIELD','CSS f&uuml;r Titel ausschalten' );
define( '_CAL_LANG_LEV_HIDE_LINK',		'Verstecke Titellink');
define( '_CAL_LANG_LEV_CUST_FORM_STRING','Individuelle Formatierung' );

// tooltips frontpage (overlib)
define( '_CAL_LANG_TOOLTIP',			'Einstellungen betreffend das Tooltip-Fenster in der Monats&uuml;bersicht' );
define( '_CAL_LANG_TT_MAINWINDOW',		'ToolTip Hauptfenster' );
define( '_CAL_LANG_TT_BGROUND',			'Hintergrund wie Termin' );
define( '_CAL_LANG_TT_POSX',			'Horizontale Position' );
define( '_CAL_LANG_TT_POSY',			'Vertikale Position' );
define( '_CAL_LANG_TT_SHADOW',			'Schatten' );
define( '_CAL_LANG_TT_SHADOWX',			'Links' );
define( '_CAL_LANG_TT_SHADOWY',			'Oberhalb' );

// buttons
define( '_CAL_LANG_BTN_DEF_CONFIG',		'Standardkonfiguration laden' );

// installation
define( '_CAL_LANG_INSTAL_MAIN',		'Kalender' );
define( '_CAL_LANG_INSTAL_MANAGE',		'Terminverwaltung' );
define( '_CAL_LANG_INSTAL_CATS',		'Kategorien' );
define( '_CAL_LANG_INSTAL_CONFIG',		'Konfiguration' );
define( '_CAL_LANG_INSTAL_ARCHIVE',		'Archiv' );
define( '_CAL_LANG_INSTAL_ERROR',		'Folgende Fehler sind aufgetreten' );
define( '_CAL_LANG_INSTAL_SUCCESS',		'Events wurde erfolgreich installiert' );
define( '_CAL_LANG_INSTALL_DB_ENTRIES',	'Datenbankeintragungen, -&auml;nderungen' );
define( '_CAL_LANG_INSTALL_PREV_INST',	'Vorige bzw. doppelte DB-Eintragungen entfernt' );

DEFINE("_CAL_LANG_EVENT_ALLDAY","Ganzt&auml;gig oder unbestimmte Zeit");  // new for 1.4

?>
