<?php
/**
 * Events Component for Joomla 1.0.x
 *
 * @version     $Id: admin_finnish.php 849 2007-07-21 17:47:48Z tstahl $
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
define( '_CAL_HIDE_OLD_EVENTS',			'Piilota menneet tapahtumat'); // NEW 1.4
define( '_CAL_LANG_CATEGORIES',   		'Kategoriat' );
define( '_CAL_LANG_DISPLAY',			'N‰yt‰' );
define( '_CAL_LANG_CATEGORY_NAME',		'Kategorian nimi' );
define( '_CAL_LANG_RECORDS',			'Tapahtumien&nbsp;m&auml;&auml;r&auml;' );
define( '_CAL_LANG_CHECKED_OUT',		'Lukittu' );
define( '_CAL_LANG_PUBLISHED',			'Julkaistu' );
define( '_CAL_LANG_NOT_PUBLISHED',		'Julkaisematon' );
define( '_CAL_LANG_ACCESS',				'Oikeudet' );
define( '_CAL_LANG_REORDER',			'J&auml;rjest&auml;' );
define( '_CAL_LANG_UNPUBLISH',			'Peru julkaisu' );
define( '_CAL_LANG_PUBLISH',			'Julkaise' );
define( '_CAL_LANG_CLICK_TO_EDIT',		'Klikkaa muokataksesi' );
define( '_CAL_LANG_MOVE_UP',			'Siirr&auml; yl&ouml;s' );
define( '_CAL_LANG_MOVE_DOWN',			'Siirr&auml; alas' );
define( '_CAL_LANG_EDIT_CAT',			'Muokkaa kategoriaa' );
define( '_CAL_LANG_ADD_CAT',			'Lis&auml;&auml; kategoria' );
define( '_CAL_LANG_CAT_TITLE',			'Kategorian otsikko' );
define( '_CAL_LANG_CAT_NAME',			'Kategorian nimi' );
define( '_CAL_LANG_IMAGE',				'Kuva' );
define( '_CAL_LANG_PREVIEW',			'Esikatselu' );
define( '_CAL_LANG_IMG_POSITION',		'Kuvan sijainti' );
define( '_CAL_LANG_ORDERING',			'J&auml;rjestys' );
define( '_CAL_LANG_LEFT',				'Vasen' );
define( '_CAL_LANG_CENTER',				'Keskell&auml;' );
define( '_CAL_LANG_RIGHT',				'Oikea' );
define( '_CAL_LANG_SELECT_IMAGE',		'Valitse kuva' );
define( '_CAL_LANG_SEARCH',				'Haku' );
define( '_CAL_LANG_TITLE',				'Otsikko' );
define( '_CAL_LANG_REPEAT',				'Toisto' );
define( '_CAL_LANG_TIME_SHEET',			'Kesto' );
define( '_CAL_CLICK_TO_CHANGE_STATUS',	'Muuta tilaa klikkaamalla ikonista' );
define( '_CAL_LANG_PUB_BUT_COMING',		'Julkaistu, mutta <u>tulossa</u>' );
define( '_CAL_LANG_PUB_ACTUAL',			'Julkaistu ja <u>ajankohtainen</u>' );
define( '_CAL_LANG_PUB_FINISHED',		'Julkaistu, mutta <u>p&auml;&auml;ttynyt</u>' );
define( '_CAL_LANG_EDIT_EVENT',			'Muokkaa tapahtumaa' );
define( '_CAL_LANG_ADD_EVENT',			'Lis&auml;&auml; tapahtuma' );
define( '_CAL_LANG_REQUIRED',			'pakollinen' );
define( '_CAL_LANG_IMG_FOLDER',			'Alihakemisto' );
define( '_CAL_LANG_IMAGES',				'Gallerian kuvat' );
define( '_CAL_LANG_AVAL_IMAGES',		'K&auml;ytett&auml;viss&auml; olevat kuvat' );
define( '_CAL_LANG_INSERT_IMG',			'Lis&auml;&auml; &raquo;' );
define( '_CAL_LANG_CONTENT_IMGS',		'Sis&auml;ll&ouml;n kuvat' );
define( '_CAL_LANG_REMOVE',				'poista' );
define( '_CAL_LANG_EDITED_SEL_IMG',		'Muokkaa valittua kuvaa' );
define( '_CAL_LANG_SOURCE',				'L&auml;hde' );
define( '_CAL_LANG_ALIGN',				'Tasaus' );
define( '_CAL_LANG_ALT_TXT',			'Vaihtoehtoinen teksti' );
define( '_CAL_LANG_BORDER',				'Reunus' );
define( '_CAL_LANG_CAPTION',			'Otsikko');
define( '_CAL_LANG_CAPTION_POSITION',	'Otsikon sijainti');
define( '_CAL_LANG_CAPTION_POS_BOTTOM',	'Alareuna');
define( '_CAL_LANG_CAPTION_POS_TOP',	'Yl&auml;reuna');
define( '_CAL_LANG_CAPTION_ALIGN',		'Otsikon tasaus');
define( '_CAL_LANG_CAPTION_WIDTH',		'Otsikon leveys');
define( '_CAL_LANG_APPLY',				'K&auml;yt&auml;' );
define( '_CAL_LANG_ADD_INFO',			'Lis&auml;tietoja' );
define( '_CAL_LANG_EVENT_STATUS',		'Tapahtuman tila' );
define( '_CAL_LANG_ARCHIVED',			'Arkistoitu' );
define( '_CAL_LANG_DRAFT_UNPUB',		'Julkaisematon luonnos' );
define( '_CAL_LANG_NEVER',				'Ei koskaan' );
define( '_CAL_LANG_CUT_TITLE',			'Otsikon pituus' );
define( '_CAL_LANG_MAX_DISPLAY',		'Tapahtumien maksimim&auml;&auml;r&auml;' );
define( '_CAL_LANG_DIS_STARTTIME',		'N&auml;yt&auml; aloitusaika' );

	// config
define( '_CAL_LANG_EVENTS_CONFIG',		'JEvents asetukset' );
define( '_CAL_LANG_CONFIG_WRITEABLE',	'Asetustiedostoon voi kirjoittaa' );
define( '_CAL_LANG_CONFIG_NOT_WRITEABLE','Asetustiedostoon ei voi kirjoittaa' );
define( '_CAL_LANG_CSS_WRITEABLE',		'CSS tiedostoon voi kirjoittaa' );
define( '_CAL_LANG_CSS_NOT_WRITEABLE',	'CSS tiedostoon ei voi kirjoittaa' );
define( '_CAL_LANG_ADMIN_EMAIL',		'Yll&auml;pit&auml;j&auml;n s&auml;hk&ouml;posti' );
define( '_CAL_LANG_FRONTEND_PUBLISHING','Julkaise frontendist&auml;' );
define( '_CAL_LANG_SETT_FOR_COM',		'N&auml;m&auml; asetukset ovat vain JEvents komponentille' );
define( '_CAL_LANG_SETT_FOR_CAL_MOD',	'N&auml;m&auml; asetukset ovat vain valinnaiselle kalenterimoduulille' );
define( '_CAL_LANG_SETT_FOR_MOD_LATEST','N&auml;m&auml; asetukkset ovat vain valinnaiselle [ Ajankohtaiset tapahtumat ] moduulille' );
define( '_CAL_LANG_ICONIC_NAVBAR'		,'K&auml;yt&auml; uutta navigointipalkkia, jossa on ikonit'); // 1.4
define( '_CAL_LANG_CHECK_VERSION'		,'Tarkista uusin versio'); // 1.4

// errors
define( '_CAL_LANG_ERR_CAT_MUST_HAVE_NAME',	'Kategorialla pit&auml;&auml; olla nimi' );

// title & alts
define( '_CAL_LANG_TIT_NAME_FOR_MENUS',	'Lyhyt nimi, joka n&auml;ytet&auml;&auml;n valikoissa' );
define( '_CAL_LANG_TIT_LONG_NAME',		'Pitk&auml; nimi, joka n&auml;ytet&auml;&auml;n otsikossa' );
define( '_CAL_LANG_TIT_PENDING',		'Vireill&auml;' );

// msgs
define( '_CAL_LANG_MSG_CAT_IS_EDITED',	'Kategoriaa [ %s ] muokkaa juuri toinen yll&auml;pit&auml;j&auml;' ); // %s = $row->title
define( '_CAL_LANG_MSG_OP_FAILED',		'Toiminto ep&auml;onnistui: Tiedostoa [ %s ] ei voitu avata' ); // %s = $filename
define( '_CAL_LANG_MSG_CHANGE_EMAIL',	'Mene ensin JEvents asetuksiin ja vaihda s&auml;hk&ouml;postiosoite' );
define( '_CAL_LANG_MSG_ADD_CAT_BEFORE',	'Sinun pit&auml;&auml; ensin valita kategoria t&auml;lle alueelle' );
define( '_CAL_LANG_MSG_CONFIG_SAVED',	'Asetukset tallennettiin onnistuneesti' );
define( '_CAL_LANG_MSG_WARNING',		'Varoitus...' );
define( '_CAL_LANG_MSG_CHMOD_CONFIG',	'Sinun pit‰‰ antaa asetustiedostoon kirjoitusoikeudet kaikille (chmod 0777), jotta se voidaan p&auml;ivitt&auml;&auml;' );
define( '_CAL_LANG_MSG_CHMOD_CSS',		'Sinun pit‰‰ antaa CSS tiedostoon kirjoitusoikeudet kaikille (chmod 0777), jotta se voidaan p&auml;ivitt&auml;&auml;' );
define( '_CAL_LANG_MSG_MOD_NOT_INSTALLED','Kalenterimoduulia ei ole asennettu' );
define( '_CAL_LANG_MSG_NO_MOD_LATEST',	'Moduulia [ Ajankohtaiset tapahtumat ] ei ole asennettu' );

// tips
define( '_CAL_LANG_TIP_ACCESS',			'Keill&auml; on oikeus lis&auml;t&auml; uusia tapahtumia' );
define( '_CAL_LANG_TIP_FRONT_PUB',		'Salli julkaisijoiden, managerien ja yll&auml;pit&auml;jien julkaista sis&auml;lt&ouml;&auml; frontendist&auml;' );
define( '_CAL_LANG_TIP_NR_OF_LIST',		'Listattavien tapahtumien lukum&auml;&auml;r&auml; viikko-, kuukausi-, ja vuosin&auml;kymiss&auml;' );
define( '_CAL_LANG_TIP_FE_SIMPLE_FORM',	'K&auml;yt&auml; yksinkertaista tapahtumienlis&auml;yslomaketta (esim. ei toistotyyppej&auml;) frontendiss&auml;' );
define( '_CAL_LANG_TIP_DEF_EC_HIDE_FORCE',	'<b>Tapahtumakohtaiset v&auml;rit sallittu</b><br/>Sek‰ frontend, ett‰ backend puolella voi m&auml;&auml;ritt&auml;&auml; tapahtumakohtaisia v&auml;rej&auml;<br/><b>Tapahtumav&auml;rit vain backendiss&auml;</b><br/>Vain backend editorissa voi m&auml;&auml;ritt&auml;&auml; tapahtumakohtaisia v&auml;rej&auml;<br/><b>K&auml;yt&auml; aina kategorian v&auml;ri&auml;</b><br/>Tapahtumakohtaisia v&auml;rej&auml; ei voi m&auml;&auml;ritt&auml;&auml;. Kaikki ennen t&auml;m&auml;n asetuksen k&auml;ytt&ouml;&ouml;nottoa asetetut tapahtumakohtaiset v&auml;rit j&auml;tet&auml;&auml;n huomiotta ja kategoriav&auml;ri&auml; k&auml;ytet&auml;&auml;n niiden sijaan' );
define( '_CAL_LANG_TIP_DLM_STOP_DAY',		'T&auml;m&auml;n kuukauden p&auml;iv&auml;, jonka j‰lkeen ei en&auml;&auml; n&auml;ytet&auml; edellist&auml; kuukautta' );
define( '_CAL_LANG_TIP_DNM_START_DAY',		'Kuinka monentena p&auml;iv&auml;n&auml; kuun lopusta laskettuna aletaan n&auml;ytt&auml;&auml; seuraavaa kuukautta' );
define( '_CAL_LANG_TIP_LEV_DAY_RANGE',		'Tapahtuman et‰isyys (p‰ivin‰) nykyisest‰ p‰iv‰st‰, jolloin tapahtuma listataan (vain moodit 1 ja 3)' );
define( '_CAL_LANG_TIP_LEV_DISPLAY_YEAR',	'N&auml;yt&auml; vuosi tapahtuman p&auml;iv&auml;m&auml;&auml;r&auml;ss&auml; (vain oletusmuoto)' );
define( '_CAL_LANG_TIP_BTN_DEF_CONFIG',		'Lataa oletusasetukset [jos jokin meni vikaan]' );
define( '_CAL_LANG_TIP_LEV_DISPLAY_MODE',	'0 (oletus) n&auml;yt&auml; l&auml;himm&auml;t tapahtumat nykyiselle ja seuraavalle viikolle, mutta vain n&auml;ytett&auml;vien tapahtumien maksimim&auml;&auml;r&auml;&auml;n asti<br />1 sama kuin 0 paitsi my&ouml;s joitakin menneit&auml; tapahtumia n&auml;ytet&auml;&auml;n, jos tulevien tapahtumien lukum&auml;&auml;r&auml; on pienempi kuin n&auml;ytett&auml;vien tapahtumien maksimilukum&auml;&auml;r&auml;<br />2 n&auml;yt&auml; l&auml;himm&auml;t tulevat tapahtumat valitun p&auml;iv&auml;lukum&auml;&auml;r&auml;n et&auml;isyydell&auml;<br />3 sama kuin 2 paitsi, jos tulevia tapahtumia on valitulla et&auml;isyydell&auml; v&auml;hemm&auml;n kuin listattavien tapahtumien maksimim&auml;&auml;r&auml;, niin n&auml;yt&auml; my&auml;s l&auml;himpi&auml; menneit&auml; tapahtumia yht&auml; suurelta et&auml;isyydelt&auml;<br />4 n&auml;yt&auml; l&auml;himm&auml;t tapahtumat nykyiselt&auml; kuukaudelta' );
define( '_CAL_LANG_TIP_CUT_TITLE',			'Jos otsikossa on liian monta merkki&auml;, tuloksena saattaisi olla tarkoituksettoman venynyt kuukausin&auml;kym&auml;.<br />M&auml;&auml;rit&auml; otsikon merkkien maksimilukum&auml;&auml;r&auml;, jonka j&auml;lkeen otsikon per&auml;&auml;n lis&auml;t&auml;&auml;n kolme pistett&auml;' );
define( '_CAL_LANG_TIP_LEV_HIDE_LINK',		'Jos t‰m‰ on KYLL&Auml;, otsikon linkki asetetaan dynaamisesti javascriptill‰ &lt;b&gt;onclick&lt;/b&gt;-tapahtumassa. T&auml;m&auml; est&auml;&auml; hakukoneita seuraamasta linkki&auml;');
define( '_CAL_LANG_TIP_MAX_DISPLAY',		'Kuinka monta tapahtumaa kuukausin&auml;kym&auml;ss&auml; korkeintaan n&auml;ytet&auml;&auml;n <strong>tekstin&auml;</strong> per p&auml;iv&auml;<br />Jos sinulla on monta tapahtumaa p&auml;iv&auml;ss&auml;, niiden kaikkien n&auml;ytt&auml;minen tekstin&auml; voisi venytt&auml;&auml; ulkoasua.<br />M&auml;&auml;rit&auml; t&auml;ss&auml; kuinka monta tapahtumaa tulisi n&auml;ytt&auml;&auml; tekstin&auml;. Jos niit&auml; on liikaa, ne n&auml;ytet&auml;&auml;n kuvakkeina (ei vaikutusta vihjeeseen)<br /><strong>Vihje</strong>: Jos t&auml;m&auml; asetetaan nollaksi, kaikki tapahtumat n&auml;ytet&auml;&auml;n kuvakkeina' );
define( '_CAL_LANG_TIP_DIS_STARTTIME',		'N&auml;ytet&auml;&auml;nk&ouml; aloitusaika [ kuukausin&auml;kym&auml; ]' );
	// tooltips
define( '_CAL_LANG_TIP_TT_BGROUND',			'Pit&auml;isik&ouml; vihjeen k&auml;ytt&auml;&auml;k&ouml; samaa taustav&auml;ri&auml; kuin tapahtuma<br />Muuten k&auml;ytet&auml;&auml;n oletusv&auml;ri&auml;' );
define( '_CAL_LANG_TIP_TT_POSX',			'Vihjeikkunan vaakasijainti voi olla vasen, keskitetty tai oikea' );
define( '_CAL_LANG_TIP_TT_POSY',			'Vihjeikkunan pystysijainti voi olla alapuolella tai yl&auml;puolella' );
define( '_CAL_LANG_TIP_TT_SHADOW',			'Vihjeikkunalla voi olla varjo, joka voidaan sijoittaa vasemmalle tai oikealle ja alapuolelle tai yl&auml;puolelle' );

// tabs
define( '_CAL_LANG_TAB_COMMON',			'Yleinen' );
define( '_CAL_LANG_TAB_IMAGES',			'Kuvat' );
define( '_CAL_LANG_TAB_CALENDAR',		'Kalenteri' );
define( '_CAL_LANG_TAB_HELP',			'Ohje' );
define( '_CAL_LANG_TAB_EXTRA',			'Extra' );
define( '_CAL_LANG_TAB_ABOUT',			'Tietoja' );
define( '_CAL_LANG_TAB_COMPONENT',		'Komponentti' );
define( '_CAL_LANG_TAB_CAL_MOD',		'Kalenteri' );
define( '_CAL_LANG_TAB_LATEST_MOD',		'Ajank.tapaht.' );
define( '_CAL_LANG_TAB_CSS',			'CSS' );
define( '_CAL_LANG_TAB_TOOLTIP',		'Vihje' );

// select lists
	//common
define( '_CAL_LANG_YES',				'Kyll&auml;' );
define( '_CAL_LANG_NO',					'Ei' );
define( '_CAL_LANG_ALWAYS',				'AINA' );
	// access
define( '_CAL_LANG_SEL_ACCESS_ALL_REGGED',	'Kaikki register&ouml;idyt k&auml;ytt&auml;j&auml;t' );
define( '_CAL_LANG_SEL_ACCESS_SPECIAL',		'Vain erityiset oikeudet ja yll&auml;pit&auml;j&auml;t' );
define( '_CAL_LANG_SEL_ACCESS_ALL_ANONYM',	'Kaikki (anonyymit) - ei suositella' );
define( '_CAL_LANG_SEL_ACCESS_ALL_AUTHORS',	'Kirjoittajat ja suuremmat' );
define( '_CAL_LANG_SEL_ACCESS_ALL_EDITORS',	'Muokkaajat ja suuremmat' );
define( '_CAL_LANG_SEL_ACCESS_ALL_PUBLISHERS',	'Julkaisijat ja suuremmat' );
define( '_CAL_LANG_SEL_ACCESS_ALL_MANAGERS',	'Managerit ja suuremmat' );
define( '_CAL_LANG_SEL_ACCESS_ALL_ADMIN',	'Vain yll&auml;pit&auml;j&auml;t ja superyll&auml;pit&auml;j&auml;t' );
	// first day
define( '_CAL_LANG_FIRST_DAY',			'Ensimm&auml;inen p&auml;iv&auml;' );
define( '_CAL_LANG_SUNDAY_FIRST',		'Sunnuntai ensin' );
define( '_CAL_LANG_MONDAY_FIRST',		'Maanantai ensin' );

define( '_CAL_LANG_VIEW_MAIL',			'N&auml;yt&auml; s&auml;hk&ouml;posti' );
define( '_CAL_LANG_VIEW_BY',			'N&auml;yt&auml; "kenelt&auml;"' );
define( '_CAL_LANG_VIEW_HITS',			'N&auml;yt&auml; "osumat"' );
define( '_CAL_LANG_VIEW_REPEAT_TIME',	'N&auml;yt&auml; toisto ja aika' );
define( '_CAL_LANG_VIEW_REPEAT_YEAR_LIST',	'N&auml;yt&auml; kaikki toistuvat tapahtumat vuosin&auml;kym&auml;ss&auml;' );
define( '_CAL_LANG_SHOW_CATS',			'Piilota "Katso kategorioittain" (sopiva, jos JEvents Legenda -moduuli on n&auml;kyvill&auml;)' );
define( '_CAL_LANG_SHOW_COPYRIGHT',		'N&auml;yt&auml; tekij&auml;noikeusalatunniste');
	// date format
define( '_CAL_LANG_DATE_FORMAT',		'P&auml;iv&auml;m&auml;&auml;r&auml;n muoto' );
define( '_CAL_LANG_DATE_FORMAT_FR_EN',	'Ranska-Englanti' );
define( '_CAL_LANG_DATE_FORMAT_US',		'US' );
define( '_CAL_LANG_DATE_FORMAT_GERMAN',	'Mannermainen - Saksa' );

define( '_CAL_LANG_TIME_FORMAT_12',		'K&auml;yt&auml; 12 tunnin aikamuotoa' );
	// nav bar
define( '_CAL_LANG_NAV_BAR_COLOR',		'Navigointipalkin v&auml;ri' );
define( '_CAL_LANG_NAV_BAR_GREEN',		'Vihre&auml;' );
define( '_CAL_LANG_NAV_BAR_ORANGE',		'Oranssi' );
define( '_CAL_LANG_NAV_BAR_BLUE',		'Sininen' );
define( '_CAL_LANG_NAV_BAR_RED',		'Punainen' );
define( '_CAL_LANG_NAV_BAR_GRAY',		'Harmaa' );
define( '_CAL_LANG_NAV_BAR_YELLOW',		'Keltainen' );

	// start page
define( '_CAL_LANG_START_PAGE',			'Aloitussivu' );
define( '_CAL_LANG_SP_DAY',				'P&auml;iv&auml;' );
define( '_CAL_LANG_SP_WEEK',			'Viikko' );
define( '_CAL_LANG_SP_MONTH_CAL',		'Kuukausi (kalenteri)' );
define( '_CAL_LANG_SP_MONTH_LIST',		'Kuukausi (listaus)' );
define( '_CAL_LANG_SP_YEAR',			'Vuosi' );
define( '_CAL_LANG_SP_CATEGORIES',		'Kategoriat' );
define( '_CAL_LANG_SP_SEARCH',			'Haku' );

define( '_CAL_LANG_NR_OF_LIST',			'Tapahtumien lukum&auml;&auml;r&auml;' );
define( '_CAL_LANG_FE_SIMPLE_FORM',		'K&auml;yt&auml; yksinkertaista' );
	// event color
define( '_CAL_LANG_DEF_EVENT_COLOR',	'Tapahtumien oletusv&auml;ri' );
define( '_CAL_LANG_DEF_EC_RANDOM',		'Satunnainen' );
define( '_CAL_LANG_DEF_EC_NONE',		'Ei mit&auml;&auml;n' );
define( '_CAL_LANG_DEF_EC_CATEGORY',	'Kategoria' );
define( '_CAL_LANG_DEF_EC_HIDE_FORCE',	'Tapahtumien v&auml;ris&auml;&auml;nt&ouml;' );
define( '_CAL_LANG_EVENT_COLS_ALLOWED',	'Tapahtumakohtaiset v&auml;rit sallittu' );
define( '_CAL_LANG_EVENT_COLS_BACKED',	'Tapahtumav&auml;rit vain backendiss&auml;' );
define( '_CAL_LANG_ALWAYS_CAT_COLOR',	'K&auml;yt&auml; aina kategorian v&auml;ri&auml;' );

	// tooltips
define( '_CAL_LANG_ABOVE',				'Yl&auml;puolella' );
define( '_CAL_LANG_BELOW',				'Alapuolella' );

// calendar module
	// display last month
define( '_CAL_LANG_DISPLAY_LAST_MONTH',	'N&auml;yt&auml; edellinen kuukausi' );
define( '_CAL_LANG_DLM_YES_STOP_DAY',	'KYLL&Auml; - valittuun p&auml;iv&auml;&auml;n asti' );
define( '_CAL_LANG_DLM_YES_EVENT_SDAY',	'KYLL&Auml; - valittuun p&auml;iv&auml;&auml;n asti, mutta vain jos se sis&auml;lt&auml;&auml; tapahtumia' );
define( '_CAL_LANG_DLM_ALWYS_IF_EVENTS','AINA - jos se sis&auml;lt&auml;&auml; tapahtumia' );
	// stop day
define( '_CAL_LANG_DLM_STOP_DAY',		'P‰iv‰, jolloin lakataan n‰ytt‰m‰st‰ viime kuukautta' );
	// display next month
define( '_CAL_LANG_DISPLAY_NEXT_MONTH',	'N&auml;yt&auml; seuraava kuukausi' );
define( '_CAL_LANG_DNM_YES_START_DAY',	'KYLL&Auml; - valitusta p&auml;iv&auml;st&auml; l&auml;htien' );
define( '_CAL_LANG_DNM_YES_EVENT_SDAY', 'KYLL&Auml; - valitusta p&auml;iv&auml;st&auml; l&auml;htien, mutta vain jos se sis&auml;lt&auml;&auml; tapahtumia' );
define( '_CAL_LANG_DNM_ALWYS_IF_EVENTS','AINA - jos se sis&auml;lt&auml;&auml; tapahtumia' );
	// start day
define( '_CAL_LANG_DNM_START_DAY',		'Kuinka monta p&auml;iv&auml;&auml; ennen kuun loppua aletaan n&auml;ytt&auml;&auml; seuraavaa kuukautta' );

// latest events module
define( '_CAL_LANG_LEV_MAX_DISPLAY',	'N&auml;ytett&auml;vien tapahtumien maksimim&auml;&auml;r&auml;' );
define( '_CAL_LANG_LEV_DISPLAY_MODE',	'Moodi' );
define( '_CAL_LANG_LEV_DAY_RANGE',		'P&auml;ivi&auml; ennen/j&auml;lkeen' );
define( '_CAL_LANG_LEV_REP_EV_ONCE',	'N&auml;yt&auml; toistuvat tapahtumat vain kerran' );
define( '_CAL_LANG_LEV_EV_AS_LINK',		'N&auml;yt&auml; tapahtumat linkkein&auml;' );
define( '_CAL_LANG_LEV_DISPLAY_YEAR',	'N&auml;yt&auml; vuosi' );
define( '_CAL_LANG_LEV_CSS_DATE_FIELD',	'Poista k&auml;yt&ouml;st&auml; p&auml;iv&auml;m&auml;&auml;r&auml;kent&auml;n oletus-CSS-tyyli' );
define( '_CAL_LANG_LEV_CSS_TITLE_FIELD','Poista k&auml;yt&ouml;st&auml; otsikon oletus-CSS-tyyli' );
define( '_CAL_LANG_LEV_HIDE_LINK',		'Piilota otsikkolinkki');
define( '_CAL_LANG_LEV_CUST_FORM_STRING','Mukautettu p&auml;iv&auml;m&auml;&auml;r&auml;n/ajan esitysmuoto' );

// tooltips frontpage (overlib)
define( '_CAL_LANG_TOOLTIP',			'N&auml;m&auml; asetukset ovat kuukausin&auml;kym&auml;n vihjeikkunalle' );
define( '_CAL_LANG_TT_MAINWINDOW',		'Vihjeikkuna' );
define( '_CAL_LANG_TT_BGROUND',			'Sama taustav&auml;ri kuin tapahtumalla' );
define( '_CAL_LANG_TT_POSX',			'Vaakasijainti' );
define( '_CAL_LANG_TT_POSY',			'Pystysijainti' );
define( '_CAL_LANG_TT_SHADOW',			'Varjo' );
define( '_CAL_LANG_TT_SHADOWX',			'Vasemmalla' );
define( '_CAL_LANG_TT_SHADOWY',			'Ylh&auml;&auml;ll&auml;' );

// buttons
define( '_CAL_LANG_BTN_DEF_CONFIG',		'Palauta oletusasetukset' );

// installation
define( '_CAL_LANG_INSTAL_MAIN',		'Tapahtumat' );
define( '_CAL_LANG_INSTAL_MANAGE',		'Hallitse tapahtumia' );
define( '_CAL_LANG_INSTAL_CATS',		'Hallitse kategorioita' );
define( '_CAL_LANG_INSTAL_CONFIG',		'Asetukset' );
define( '_CAL_LANG_INSTAL_ARCHIVE',		'Arkisto' );
define( '_CAL_LANG_INSTAL_ERROR',		'Seuraavat virheet tapahtuivat' );
define( '_CAL_LANG_INSTAL_SUCCESS',		'JEvents asennettu onnistuneesti' );
define( '_CAL_LANG_INSTALL_DB_ENTRIES',	'Tietokantamerkinn&auml;t, muutokset' );
define( '_CAL_LANG_INSTALL_PREV_INST',	'Kaksoistietokantamerkinn&auml;t poistettu' );

DEFINE("_CAL_LANG_EVENT_ALLDAY","Koko p&auml;iv&auml;n tapahtuma tai m&auml;&auml;rittelem&auml;t&ouml;n aika");  // new for 1.4


?>

