<?php
/**
 * Events Component for Joomla 1.0.x
 *
 * @version     $Id: admin_dutch.php 991 2008-03-10 19:55:48Z tstahl $
 * @package     Events
 * @copyright   Copyright (C) 2006-2008 JEvents Project Group
 * @copyright (C) 2000 - 2003 Eric Lamette, Dave McDonnell
 * @licence     http://www.gnu.org/copyleft/gpl.html
 * @link        http://joomlacode.org/gf/project/jevents
 * @translation David Speijer
 * @ecnoding    iso-8859-1
 */


defined( '_VALID_MOS' ) or die( 'No Direct Access' );

//Check
if( defined( '_CAL_ADMIN_LANG_INCLUDED' )) {
	return;
}

DEFINE( '_CAL_ADMIN_LANG_INCLUDED', 1 );

/* +++++++++++++++++++ */
define( '_CAL_HIDE_OLD_EVENTS',			'Verberg gebeurtenissen in het verleden'); // NEW 1.4
define( '_CAL_LANG_CATEGORIES',   		'Categorieën' );
define( '_CAL_LANG_DISPLAY',			'Toon' );
define( '_CAL_LANG_CATEGORY_NAME',		'Naam Categorie' );
define( '_CAL_LANG_RECORDS',			'of&nbsp;Records' );
define( '_CAL_LANG_CHECKED_OUT',		'Checked&nbsp;Out' );
define( '_CAL_LANG_PUBLISHED',			'Gepubliceerd' );
define( '_CAL_LANG_NOT_PUBLISHED',		'Niet Gepubliceerd' );
define( '_CAL_LANG_ACCESS',				'Toegangsniveau' );
define( '_CAL_LANG_REORDER',			'Herschikken' );
define( '_CAL_LANG_UNPUBLISH',			'Depubliceren' );
define( '_CAL_LANG_PUBLISH',			'Publiceren' );
define( '_CAL_LANG_CLICK_TO_EDIT',		'Klik om te bewerken' );
define( '_CAL_LANG_MOVE_UP',			'Naar boven' );
define( '_CAL_LANG_MOVE_DOWN',			'Naar beneden' );
define( '_CAL_LANG_EDIT_CAT',			'Wijzig Categorie' );
define( '_CAL_LANG_ADD_CAT',			'Categorie Toevoegen' );
define( '_CAL_LANG_CAT_TITLE',			'Titel Categorie' );
define( '_CAL_LANG_CAT_NAME',			'Naam Categorie' );
define( '_CAL_LANG_IMAGE',				'Afbeelding' );
define( '_CAL_LANG_PREVIEW',			'Voorbeeld' );
define( '_CAL_LANG_IMG_POSITION',		'Positie Afbeelding' );
define( '_CAL_LANG_ORDERING',			'Volgorde' );
define( '_CAL_LANG_LEFT',				'Links' );
define( '_CAL_LANG_CENTER',				'Midden' );
define( '_CAL_LANG_RIGHT',				'Rechts' );
define( '_CAL_LANG_SELECT_IMAGE',		'Selecteer Afbeelding' );
define( '_CAL_LANG_SEARCH',				'Zoeken' );
define( '_CAL_LANG_TITLE',				'Titel' );
define( '_CAL_LANG_REPEAT',				'Herhaal' );
define( '_CAL_LANG_TIME_SHEET',			'Tijdschema' );
define( '_CAL_CLICK_TO_CHANGE_STATUS',	'Klik op het icoon om de status te wijzigen' );
define( '_CAL_LANG_PUB_BUT_COMING',		'Gepubliceerd, maar moet nog <u>komen</u>' );
define( '_CAL_LANG_PUB_ACTUAL',			'Gepubliceerd en is <u>huidig</u>' );
define( '_CAL_LANG_PUB_FINISHED',		'Gepubliceerd, maar is <u>voorbij</u>' );
define( '_CAL_LANG_EDIT_EVENT',			'Wijzig event' );
define( '_CAL_LANG_ADD_EVENT',			'Event toevoegen' );
define( '_CAL_LANG_REQUIRED',			'Verplicht' );
define( '_CAL_LANG_IMG_FOLDER',			'Sub-map' );
define( '_CAL_LANG_IMAGES',				'Gallerij Afbeeldingen' );
define( '_CAL_LANG_AVAL_IMAGES',		'Beschikbare Afbeeldingen' );
define( '_CAL_LANG_INSERT_IMG',			'Invoegen &raquo;' );
define( '_CAL_LANG_CONTENT_IMGS',		'Gekozen Afbeeldingen' );
define( '_CAL_LANG_REMOVE',				'Verwijder' );
define( '_CAL_LANG_EDITED_SEL_IMG',		'Wijzig Geselecteerde Afbeelding' );
define( '_CAL_LANG_SOURCE',				'Bron' );
define( '_CAL_LANG_ALIGN',				'Uitlijning' );
define( '_CAL_LANG_ALT_TXT',			'Alt Tekst' );
define( '_CAL_LANG_BORDER',				'Rand' );
define( '_CAL_LANG_CAPTION',			'Onderschrift');
define( '_CAL_LANG_CAPTION_POSITION',	'Positie Onderschrift');
define( '_CAL_LANG_CAPTION_POS_BOTTOM',	'Onder');
define( '_CAL_LANG_CAPTION_POS_TOP',	'Boven');
define( '_CAL_LANG_CAPTION_ALIGN',		'Uitlijning Onderschrift');
define( '_CAL_LANG_CAPTION_WIDTH',		'Breedte Onderschrift');
define( '_CAL_LANG_APPLY',				'Toepassen' );
define( '_CAL_LANG_ADD_INFO',			'Extra Informatie' );
define( '_CAL_LANG_EVENT_STATUS',		'Status Event' );
define( '_CAL_LANG_ARCHIVED',			'Gearchiveerd' );
define( '_CAL_LANG_DRAFT_UNPUB',		'Ontwerp Ongepubliceerd' );
define( '_CAL_LANG_NEVER',				'Nooit' );

// config
define( '_CAL_LANG_CUT_TITLE',			'Titellengte' );
define( '_CAL_LANG_MAX_DISPLAY',		'Max. events' );
define( '_CAL_LANG_DIS_STARTTIME',		'Toon starttijd' );
define( '_CAL_LANG_EVENTS_CONFIG',		'Configuratie' );
define( '_CAL_LANG_CONFIG_WRITEABLE',	'Configuratie bestand is schrijfbaar' );
define( '_CAL_LANG_CONFIG_NOT_WRITEABLE','Configuratie bestand is niet schrijfbaar' );
define( '_CAL_LANG_CSS_WRITEABLE',		'CSS bestand is schrijfbaar' );
define( '_CAL_LANG_CSS_NOT_WRITEABLE',	'CSS bestand is niet schrijfbaar' );
define( '_CAL_LANG_ADMIN_EMAIL',		'Administrator E-Mail' );
define( '_CAL_LANG_FRONTEND_PUBLISHING','Publiceren vanaf frontend' );
define( '_CAL_LANG_SETT_FOR_COM',		'Deze instellingen zijn enkel voor de component' );
define( '_CAL_LANG_SETT_FOR_CAL_MOD',	'Deze instellingen zijn enkel voor de extra kalender module' );
define( '_CAL_LANG_SETT_FOR_MOD_LATEST','Deze instellingen zijn enkel voor de extra module [ Latest Events ]' );
define( '_CAL_LANG_ICONIC_NAVBAR'		,'Gebruik nieuw icoon navigatiebar'); // 1.4
define( '_CAL_LANG_CHECK_VERSION'		,'Controlleer op nieuwe versie'); // 1.4

// errors
define( '_CAL_LANG_ERR_CAT_MUST_HAVE_NAME',	'Categorie moet een naam hebben' );

// title & alts
define( '_CAL_LANG_TIT_NAME_FOR_MENUS',	'Een korte naam om in het menu te tonen' );
define( '_CAL_LANG_TIT_LONG_NAME',		'Een lange naam om in de hoofding te tonen' );
define( '_CAL_LANG_TIT_PENDING',		'In afwachting' );

// msgs
define( '_CAL_LANG_MSG_CAT_IS_EDITED',	'De categorie [ %s ] wordt op dit moment gewijzigd door een andere administrator' ); // %s = $row->title
define( '_CAL_LANG_MSG_OP_FAILED',		'Bewerking mislukt: Kan [ %s ] niet openen' ); // %s = $filename
define( '_CAL_LANG_MSG_CHANGE_EMAIL',	'Ga eerst naar CONFIGURATIE en wijzig E-mail adres' );
define( '_CAL_LANG_MSG_ADD_CAT_BEFORE',	'U moet eerst een categorie toevoegen' );
define( '_CAL_LANG_MSG_CONFIG_SAVED',	'Configuratie succesvol opgeslagen' );
define( '_CAL_LANG_MSG_WARNING',		'Waarschuwing...' );
define( '_CAL_LANG_MSG_CHMOD_CONFIG',	'U moet eerst het config bestand chmodden naar 777 voordat de configuratie opgeslagen kan worden' );
define( '_CAL_LANG_MSG_CHMOD_CSS',		'U moet eerst het css bestand chmodden naar 777 voordat de css opgeslagen kan worden' );
define( '_CAL_LANG_MSG_MOD_NOT_INSTALLED','De kalender module is niet geïnstalleerd' );
define( '_CAL_LANG_MSG_NO_MOD_LATEST',	'De module [ latest events ] is niet geïnstalleerd' );

// tips
define( '_CAL_LANG_TIP_ACCESS',			'Wie mag nieuwe events toevoegen' );
define( '_CAL_LANG_TIP_FRONT_PUB',		'Laat publishers, managers en admin gebruikers toe om vanaf frontend te publiceren' );
define( '_CAL_LANG_TIP_NR_OF_LIST',		'Aantal events weergeven per pagina per week, maand of jaar' );
define( '_CAL_LANG_TIP_FE_SIMPLE_FORM',	'Gebruik simpel formulier voor frontend (b.v. Geen herhalingen)' );
define( '_CAL_LANG_TIP_DEF_EC_HIDE_FORCE',	'<b>Event specifieke kleuren toegestaan</b><br/>Frontend end backend gebruikers kunnen event specifieke kleuren gebruiken<br/><br/><b>Event kleuren alleen in backend</b><br/>Alleen backend gebruikers kunnen event specifieke kleuren gebruiken<br/><br/><b>Gebruik altijd categorie kleuren</b><br/>Geen enkele gebruiker kan event specifieke kleuren gebruiken' );
define( '_CAL_LANG_TIP_DLM_STOP_DAY',		'Dag in huidige maand om vorige maand niet meer te tonen' );
define( '_CAL_LANG_TIP_DNM_START_DAY',		'Dagen over in huidige maand om volgende maand te tonen' );
define( '_CAL_LANG_TIP_LEV_DAY_RANGE',		'Bereik in dagen relatief tot huidige dag om events te tonen (Enkel modes 1 of 3)' );
define( '_CAL_LANG_TIP_LEV_DISPLAY_YEAR',	'Toon jaartal van het event (Enkel standaard formaat)' );
define( '_CAL_LANG_TIP_BTN_DEF_CONFIG',		'Laad standaard waarden' );
define( '_CAL_LANG_TIP_LEV_DISPLAY_MODE',	'0 (standaard) toont eerste events voor de huidige week and volgende week tot maximaal weer te geven events<br /><br />1 zelfde als [ mode = 0 ] alleen sommige events die al plaatsgevonden hebben in de huidige week worden weergegeven zolang er minder events in de toekomst zijn als maximaal mag worden weergegeven<br /><br />2 toont volgende events [ + dagen ] bereik is relatief aan huidige dag tot maximaal weer te geven events<br /><br />3  zelfde als mode 2 alleen als er minder dan maximaal weer te geven events zij, dan worden er ook events uit het verleden weergegeven<br /><br />4 toont volgende events voor de huidige maand tot maximaal weer te geven events' );
define( '_CAL_LANG_TIP_CUT_TITLE',			'Als een titel teveel characterd heeft dan kan een verspringend design het gevolg zijn<br />Definieer hoeveel karakters getoond worden voor dat de titel afgekapt wordt en ... wordt toegevoegd' );
define( '_CAL_LANG_TIP_LEV_HIDE_LINK',		'Als ingesteld is op ja, dan wordt de titel link een javascript &lt;b&gt;onclick&lt;/b&gt; methode. Dit voorkomt dat zoekmachines de link volgen');
define( '_CAL_LANG_TIP_MAX_DISPLAY',		'Maximaal weer te geven events <strong>als tekst</strong> per dag in maandelijkse weergave<br />Als er meer events zijn als aangegeven dan worden ze met een icoon weergegeven. (Tooltip wordt niet aangepast)<br /><br /><strong>Tip</strong>: Waarde 0 [nul] alle events als icoon weergeven' );
define( '_CAL_LANG_TIP_DIS_STARTTIME',		'Moet de starttijd weergeven worden [maandelijkse weergave]' );
	// tooltips
define( '_CAL_LANG_TIP_TT_BGROUND',			'Moet de tooltip de standaard kleur van het event overnemen<br />Bij nee wordt de standaard kleur gebruikt' );
define( '_CAL_LANG_TIP_TT_POSX',			'De horizontale positie van de tooltip kan links, midden of rechts zijn' );
define( '_CAL_LANG_TIP_TT_POSY',			'De verticale postie van de tooltip kan boven of onder zijn' );
define( '_CAL_LANG_TIP_TT_SHADOW',			'De tooltip kan een schaduw boven, onder, links of rechts hebben' );

// tabs
define( '_CAL_LANG_TAB_COMMON',			'Algemeen' );
define( '_CAL_LANG_TAB_IMAGES',			'Afbeeldingen' );
define( '_CAL_LANG_TAB_CALENDAR',		'Kalender' );
define( '_CAL_LANG_TAB_HELP',			'Help' );
define( '_CAL_LANG_TAB_EXTRA',			'Extra' );
define( '_CAL_LANG_TAB_ABOUT',			'Over' );
define( '_CAL_LANG_TAB_COMPONENT',		'Component' );
define( '_CAL_LANG_TAB_CAL_MOD',		'Kalender' );
define( '_CAL_LANG_TAB_LATEST_MOD',		'Latest Events' );
define( '_CAL_LANG_TAB_CSS',			'CSS' );
define( '_CAL_LANG_TAB_TOOLTIP',		'Tooltip' );

// select lists
	//common
define( '_CAL_LANG_YES',				'Ja' );
define( '_CAL_LANG_NO',					'Nee' );
define( '_CAL_LANG_ALWAYS',				'Altijd' );
	// access
define( '_CAL_LANG_SEL_ACCESS_ALL_REGGED',	'Alle geregistreerde gebruikers' );
define( '_CAL_LANG_SEL_ACCESS_SPECIAL',		'Aleen speciale rechten en administrators' );
define( '_CAL_LANG_SEL_ACCESS_ALL_ANONYM',	'Alle (anoniem) - niet aanbevolen' );
define( '_CAL_LANG_SEL_ACCESS_ALL_AUTHORS',	'Auteurs en daarboven' );
define( '_CAL_LANG_SEL_ACCESS_ALL_EDITORS',	'Redacteur en daarboven' );
define( '_CAL_LANG_SEL_ACCESS_ALL_PUBLISHERS',	'Hoofdredacteur en daarboven' );
define( '_CAL_LANG_SEL_ACCESS_ALL_MANAGERS',	'Beheerder en daarboven' );
define( '_CAL_LANG_SEL_ACCESS_ALL_ADMIN',	'Enkel (Super) Administrator' );
	// first day
define( '_CAL_LANG_FIRST_DAY',			'Eerste Dag' );
define( '_CAL_LANG_SUNDAY_FIRST',		'Eerst zondag' );
define( '_CAL_LANG_MONDAY_FIRST',		'Eerst maandag' );

define( '_CAL_LANG_VIEW_MAIL',			'Toon E-mail' );
define( '_CAL_LANG_VIEW_BY',			'Toon "Door"' );
define( '_CAL_LANG_VIEW_HITS',			'Toon "Hits"' );
define( '_CAL_LANG_VIEW_REPEAT_TIME',	'Toon herhaling en tijd' );
define( '_CAL_LANG_VIEW_REPEAT_YEAR_LIST',	'Toon alle herhaalde events in het jaaroverzicht' );
define( '_CAL_LANG_SHOW_CATS',			'Verberg "Toon bij categorie (Passend als legenda zichtbaar is)' );
define( '_CAL_LANG_SHOW_COPYRIGHT',		'Toon copyright footer');
	// date format
define( '_CAL_LANG_DATE_FORMAT',		'Datum formaat' );
define( '_CAL_LANG_DATE_FORMAT_FR_EN',	'Frans-Engels' );
define( '_CAL_LANG_DATE_FORMAT_US',		'US' );
define( '_CAL_LANG_DATE_FORMAT_GERMAN',	'Continentaal - Duits' );

define( '_CAL_LANG_TIME_FORMAT_12',		'Gebruik 12 uurs formaat' );
	// nav bar
define( '_CAL_LANG_NAV_BAR_COLOR',		'Kleur navigatiebalk' );
define( '_CAL_LANG_NAV_BAR_GREEN',		'Groen' );
define( '_CAL_LANG_NAV_BAR_ORANGE',		'Oranje' );
define( '_CAL_LANG_NAV_BAR_BLUE',		'Blauw' );
define( '_CAL_LANG_NAV_BAR_RED',		'Rood' );
define( '_CAL_LANG_NAV_BAR_GRAY',		'Grijs' );
define( '_CAL_LANG_NAV_BAR_YELLOW',		'Geel' );

	// start page
define( '_CAL_LANG_START_PAGE',			'Start pagina' );
define( '_CAL_LANG_SP_DAY',				'Dag' );
define( '_CAL_LANG_SP_WEEK',			'Week' );
define( '_CAL_LANG_SP_MONTH_CAL',		'Maand (Kalender)' );
define( '_CAL_LANG_SP_MONTH_LIST',		'Maand (Lijst)' );
define( '_CAL_LANG_SP_YEAR',			'Jaar' );
define( '_CAL_LANG_SP_CATEGORIES',		'Categorieën' );
define( '_CAL_LANG_SP_SEARCH',			'Zoeken' );

define( '_CAL_LANG_NR_OF_LIST',			'Aantal Events' );
define( '_CAL_LANG_FE_SIMPLE_FORM',		'Gebruik simpel formulier');
	// event color
define( '_CAL_LANG_DEF_EVENT_COLOR',	'Standaard kleur event' );
define( '_CAL_LANG_DEF_EC_RANDOM',		'Random' );
define( '_CAL_LANG_DEF_EC_NONE',		'Geen' );
define( '_CAL_LANG_DEF_EC_CATEGORY',	'Categorie' );
define( '_CAL_LANG_DEF_EC_HIDE_FORCE',	'Regels event kleuren' );
define( '_CAL_LANG_EVENT_COLS_ALLOWED',	'Event specifieke kleuren toegestaan' );
define( '_CAL_LANG_EVENT_COLS_BACKED',	'Event kleuren alleen in backend' );
define( '_CAL_LANG_ALWAYS_CAT_COLOR',	'Gebruik altijd categorie kleuren' );

	// tooltips
define( '_CAL_LANG_ABOVE',				'Boven' );
define( '_CAL_LANG_BELOW',				'Onder' );

// calendar module
	// display last month
define( '_CAL_LANG_DISPLAY_LAST_MONTH',	'Toon vorige maand' );
define( '_CAL_LANG_DLM_YES_STOP_DAY',	'JA - met stopdag' );
define( '_CAL_LANG_DLM_YES_EVENT_SDAY',	'JA - als maand events bevat EN met stopdag' );
define( '_CAL_LANG_DLM_ALWYS_IF_EVENTS','ALTIJD - als maand events bevat' );
	// stop day
define( '_CAL_LANG_DLM_STOP_DAY',		'Dag in huidige maand om te stoppen' );
	// display next month
define( '_CAL_LANG_DISPLAY_NEXT_MONTH',	'Toon volgende maand' );
define( '_CAL_LANG_DNM_YES_START_DAY',	'JA - met startdag' );
define( '_CAL_LANG_DNM_YES_EVENT_SDAY', 'JA - als maand events bevat EN met startdag' );
define( '_CAL_LANG_DNM_ALWYS_IF_EVENTS','ALTIJD - als maand events bevat' );
	// start day
define( '_CAL_LANG_DNM_START_DAY',		'Dagen over in huidige maand om te starten' );

// latest events module
define( '_CAL_LANG_LEV_MAX_DISPLAY',	'Maximum events weer te geven' );
define( '_CAL_LANG_LEV_DISPLAY_MODE',	'Weergave modes' );
define( '_CAL_LANG_LEV_DAY_RANGE',		'Dagen voor-na' );
define( '_CAL_LANG_LEV_REP_EV_ONCE',	'Toon een herhalend event slechts eenmaal' );
define( '_CAL_LANG_LEV_EV_AS_LINK',		'Toon events als een link' );
define( '_CAL_LANG_LEV_DISPLAY_YEAR',	'Toon jaar' );
define( '_CAL_LANG_LEV_CSS_DATE_FIELD',	'Schakel standaard CSS datum veld stijl uit' );
define( '_CAL_LANG_LEV_CSS_TITLE_FIELD','Schakel standaard CSS titel veld stijl uit' );
define( '_CAL_LANG_LEV_HIDE_LINK',		'Verberg titel link');
define( '_CAL_LANG_LEV_CUST_FORM_STRING','Aangepast formaat' );

// tooltips frontpage (overlib)
define( '_CAL_LANG_TOOLTIP',			'Instellingen voor de tooltip in maandelijkse weergave' );
define( '_CAL_LANG_TT_MAINWINDOW',		'Tooltip' );
define( '_CAL_LANG_TT_BGROUND',			'Zelfde achtergrond als event' );
define( '_CAL_LANG_TT_POSX',			'Horizontale positie' );
define( '_CAL_LANG_TT_POSY',			'Verticale positie' );
define( '_CAL_LANG_TT_SHADOW',			'Shaduw' );
define( '_CAL_LANG_TT_SHADOWX',			'Links' );
define( '_CAL_LANG_TT_SHADOWY',			'Boven' );

// buttons
define( '_CAL_LANG_BTN_DEF_CONFIG',		'Reset' );

// installation
define( '_CAL_LANG_INSTAL_MAIN',		'Events' );
define( '_CAL_LANG_INSTAL_MANAGE',		'Beheer Events' );
define( '_CAL_LANG_INSTAL_CATS',		'Beheer Categorieën' );
define( '_CAL_LANG_INSTAL_CONFIG',		'Configuratie' );
define( '_CAL_LANG_INSTAL_ARCHIVE',		'Archief' );
define( '_CAL_LANG_INSTAL_ERROR',		'Volgende errors vonden plaats' );
define( '_CAL_LANG_INSTAL_SUCCESS',		'JEvents succesvol geïnstalleerd' );
define( '_CAL_LANG_INSTALL_DB_ENTRIES',	'DB-records, Gewijzigd' );
define( '_CAL_LANG_INSTALL_PREV_INST',	'Dubbele DB-records verwijderd' );

DEFINE("_CAL_LANG_EVENT_ALLDAY","Event duurt heel de dag of tijd is niet gespecificeerd");  // new for 1.4


?>
