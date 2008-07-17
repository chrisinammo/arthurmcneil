<?php
/**
 * Events Component for Joomla 1.0.x
 *
 * @version     $Id: admin_irish-utf8.php 1047 2008-04-12 15:15:44Z tstahl $
 * @package     Events
 * @copyright   Copyright (C) 2006-2008 JEvents Project Group
 * @copyright (C) 2000 - 2003 Eric Lamette, Dave McDonnell
 * @licence     http://www.gnu.org/copyleft/gpl.html
 * @link        http://forge.joomla.org/sf/projects/jevents
 * @translation John Duffy
 */


defined( '_VALID_MOS' ) or die( 'Ní cheadaítear rochain díreach chuig an suíomh seo.' );

//Check
if( defined( '_CAL_ADMIN_LANG_INCLUDED' )) {
       return;
}

DEFINE( '_CAL_ADMIN_LANG_INCLUDED', 1 );

/* +++++++++++++++++++ */
define( '_CAL_HIDE_OLD_EVENTS',                      'Cuir Teagmhais a chuaigh thart i bhFolach');
define( '_CAL_LANG_CATEGORIES',                  'Catagóirí');
define( '_CAL_LANG_DISPLAY',                      'Scáileán');
define( '_CAL_LANG_CATEGORY_NAME',               'Ainm na Catagóire');
define( '_CAL_LANG_RECORDS',                      'de&nbsp;Thuairiscí');
define( '_CAL_LANG_CHECKED_OUT',               'Lánseiceáilte');
define( '_CAL_LANG_PUBLISHED',                      'A fhoilsiú');
define( '_CAL_LANG_NOT_PUBLISHED',               'Ní fhoilseofar');
define( '_CAL_LANG_ACCESS',                             'Rochtain');
define( '_CAL_LANG_REORDER',                      'Athchur in ord');
define( '_CAL_LANG_UNPUBLISH',                      'Dífhoilsigh');
define( '_CAL_LANG_PUBLISH',                      'Foilsigh');
define( '_CAL_LANG_CLICK_TO_EDIT',               'Cliceáil chun téacs a chur in eagar');
define( '_CAL_LANG_MOVE_UP',                      'Bog Suas');
define( '_CAL_LANG_MOVE_DOWN',                      'Bog Síos');
define( '_CAL_LANG_EDIT_CAT',                      'Cuir Catagóir in Eagar');
define( '_CAL_LANG_ADD_CAT',                      'Cuir Catagóir Leis');
define( '_CAL_LANG_CAT_TITLE',                      'Teideal na Catagóire');
define( '_CAL_LANG_CAT_NAME',                      'Ainm na Catagóire');
define( '_CAL_LANG_IMAGE',                             'Íomhá');
define( '_CAL_LANG_PREVIEW',                      'Réamhamharc');
define( '_CAL_LANG_IMG_POSITION',               'Suíomh na hÍomhá');
define( '_CAL_LANG_ORDERING',                      'Ord');
define( '_CAL_LANG_LEFT',                             'Ar Chlé');
define( '_CAL_LANG_CENTER',                             'Lárnach');
define( '_CAL_LANG_RIGHT',                             'Ar Dheis');
define( '_CAL_LANG_SELECT_IMAGE',               'Roghnaigh Íomhá');
define( '_CAL_LANG_SEARCH',                             'Cuardaigh');
define( '_CAL_LANG_TITLE',                             'Teideal');
define( '_CAL_LANG_REPEAT',                             'Athdhéan');
define( '_CAL_LANG_TIME_SHEET',                      'Bileog Ama');
define( '_CAL_CLICK_TO_CHANGE_STATUS',        'Cliceáil ar an íocón leis an stádas a athrú');
define( '_CAL_LANG_PUB_BUT_COMING',               'Foilsithe, ach tá <u>Ag teacht</u>');
define( '_CAL_LANG_PUB_ACTUAL',                      'Foilsithe, ach tá <u>Ag dul ar Aghaigh</u>');
define( '_CAL_LANG_PUB_FINISHED',               'Foilsithe, ach tá <u>Críochnaithe</u>');
define( '_CAL_LANG_EDIT_EVENT',                      'Cuir Imeacht in Eagar');
define( '_CAL_LANG_ADD_EVENT',                      'Cuir teagmhas leis');
define( '_CAL_LANG_REQUIRED',                      'Riachtanach');
define( '_CAL_LANG_IMG_FOLDER',                      'Fho-fhillteán');
define( '_CAL_LANG_IMAGES',                             'Gailearaí Íomhánna');
define( '_CAL_LANG_AVAL_IMAGES',               'Íomhánna a bhfuil fáil orthu');
define( '_CAL_LANG_INSERT_IMG',                      'Cuir &raquo; isteach');
define( '_CAL_LANG_CONTENT_IMGS',               'Íomhánna Ábhair');
define( '_CAL_LANG_REMOVE',                             'Bain');
define( '_CAL_LANG_EDITED_SEL_IMG',               'Cuir an íomhá roghnaithe in eagar');
define( '_CAL_LANG_SOURCE',                             'Foinse');
define( '_CAL_LANG_ALIGN',                             'Ailínigh');
define( '_CAL_LANG_ALT_TXT',                      'Téacs Malartach');
define( '_CAL_LANG_BORDER',                             'Imlíne');
define( '_CAL_LANG_CAPTION',                      'Teideal');
define( '_CAL_LANG_CAPTION_POSITION',        'Áit an Fhortheidil');
define( '_CAL_LANG_CAPTION_POS_BOTTOM',        'Ag bun');
define( '_CAL_LANG_CAPTION_POS_TOP',        'Ag barr');
define( '_CAL_LANG_CAPTION_ALIGN',               'Ailíniú an Fhortheidil');
define( '_CAL_LANG_CAPTION_WIDTH',               'Leithead an Fhortheidil');
define( '_CAL_LANG_APPLY',                             'Cuir i bhFeidhm');
define( '_CAL_LANG_ADD_INFO',                      'Eolas Breise');
define( '_CAL_LANG_EVENT_STATUS',               'Stádas an Imeachta');
define( '_CAL_LANG_ARCHIVED',                      'Curtha i gCartlann');
define( '_CAL_LANG_DRAFT_UNPUB',               'Dréacht neamhfhoilsithe');
define( '_CAL_LANG_NEVER',                             'Riamh');
define( '_CAL_LANG_CUT_TITLE',                      'Fad an Teidil');
define( '_CAL_LANG_MAX_DISPLAY',               'Uasmhéid Teagmhas');
define( '_CAL_LANG_DIS_STARTTIME',               'Nocht Am Tosaithe');

       // config
define( '_CAL_LANG_EVENTS_CONFIG',               'Cumraíocht Jevents');
define( '_CAL_LANG_CONFIG_WRITEABLE',        'Tá an Config inscríofa');
define( '_CAL_LANG_CONFIG_NOT_WRITEABLE','Níl an Config inscríofa');
define( '_CAL_LANG_CSS_WRITEABLE',               'Tá an comhad CSS inscríofa');
define( '_CAL_LANG_CSS_NOT_WRITEABLE',        'Níl an comhad CSS inscríofa');
define( '_CAL_LANG_ADMIN_EMAIL',               'Post Riarthóra');
define( '_CAL_LANG_FRONTEND_PUBLISHING','Foilsigh ó Frontend' );
define( '_CAL_LANG_SETT_FOR_COM',               'Níl na socruithe seo ach don chomhpháirt');
define( '_CAL_LANG_SETT_FOR_CAL_MOD',        'Níl na socruithe seo ach don mhodúl fhéilire breise');
define( '_CAL_LANG_SETT_FOR_MOD_LATEST','Níl na socruithe seo ach don mhodúl breise [Teagmhais is Déanaí]' );
define( '_CAL_LANG_ICONIC_NAVBAR'              ,'Úsáid an barra Nascleanúint Íocóin úr'); // 1.4
define( '_CAL_LANG_CHECK_VERSION'              ,"Seiceáil le haghaigh leagain níos nua"); // 1.4

// errors
define( '_CAL_LANG_ERR_CAT_MUST_HAVE_NAME',        'Caithfidh go bhfuil ainm ar an Chatagóir');

// title & alts
define( '_CAL_LANG_TIT_NAME_FOR_MENUS',        'Ainm gearr a thaispeánfar i roghchláir');
define( '_CAL_LANG_TIT_LONG_NAME',               'Ainm fada a thaispeánfar i gceannteidil');
define( '_CAL_LANG_TIT_PENDING',               'Ar Feitheamh');

// msgs
define( '_CAL_LANG_MSG_CAT_IS_EDITED',        'Tá [ %s ] na catagóire á chur in eagar ag riarthóir eile faoi láthair');
define( '_CAL_LANG_MSG_OP_FAILED',               'Theip ar Oibriú: Níorbh fhéidir [ %s ] a oscailt');
define( '_CAL_LANG_MSG_CHANGE_EMAIL',        'Téigh go RANNÁN CUMRAÍOCHTA NA dTEAGMHAS ar dtús agus athraigh RÍOMHSHEOLADH');
define( '_CAL_LANG_MSG_ADD_CAT_BEFORE',        'Ní mór catagóir a chur leis an rannán seo ar dtús');
define( '_CAL_LANG_MSG_CONFIG_SAVED',        'Déirigh le sábháil an comhaid config ');
define( '_CAL_LANG_MSG_WARNING',               'Rabhadh');
define( '_CAL_LANG_MSG_CHMOD_CONFIG',        'Ní mór duit chmod a dhéanamh ar an chomhad config go 0777 le go nuashonrófar an config');
define( '_CAL_LANG_MSG_CHMOD_CSS',               'Ní mór duit chmod a dhéanamh ar an chomhad css go 0777 le go nuashonrófar an config');
define( '_CAL_LANG_MSG_MOD_NOT_INSTALLED','Níl an modúl féilire suiteáilte' );
define( '_CAL_LANG_MSG_NO_MOD_LATEST',        'Níl an modúl [ teamghais is déanaí ] suiteáilte');

// tips
define( '_CAL_LANG_TIP_ACCESS',                      'Cé hiad a bhfuil cead acu teagmhais nua a chruthú');
define( '_CAL_LANG_TIP_FRONT_PUB',               'Ceadaigh foilsitheoirí, bainisteoirí agus úsáideoirí riaracháin ábhar a fhoilsiú ó frontend');
define( '_CAL_LANG_TIP_NR_OF_LIST',               'Líon na dteagmhas le bheith ar taispeáint ar gach leathanach do radharcanna seachtaine/míosa/bliana');
define( '_CAL_LANG_TIP_FE_SIMPLE_FORM',        'Úsáid Foirm Iontrála Shimplí (ms. Gan cineálacha athdhéanta) do thosach úsáideora');
define( '_CAL_LANG_TIP_DEF_EC_HIDE_FORCE',        '<b>Ceadaítear dathanna sainiúla don teagmhas</b><br/>Is féidir le heagarthóirí tosaigh/deiridh dathanna sainiúla don teagmhas a úsáid</br><b>Dathanna teagmhais in eagar deiridh amháin</b><br/>Ní féidir ach le heagarthóirí deiridh dathanna sainiúla don teagmhas a shonrú<br/><b>Úsáid dathanna na catagóire i gcónaí</b><br/>Ní féidir le heagarthóirí dathanna sainiúla don teagmhas a úsáid agus déanfar neamhaird de dhathanna sainiúla don teagmhas ar bith a shainítear sula n-úsáidtear an socrú seo, agus taispeánfar dath na catagóire ina n-áit');
define( '_CAL_LANG_TIP_DLM_STOP_DAY',               'Lá sa Mhí Reatha ar a gcuirfear stad leis an Mhí roimhe');
define( '_CAL_LANG_TIP_DNM_START_DAY',               'Laethanta fágtha sa Mhí Reatha go dtí go dtaispeánfar an Chéad Mhí eile');
define( '_CAL_LANG_TIP_LEV_DAY_RANGE',               'Raon na leathanta i gcoibhneas leis an Lá Reatha le teagmhais a thaispeáint ann (módanna 1 nó 3 amháin)');
define( '_CAL_LANG_TIP_LEV_DISPLAY_YEAR',        'Taispeáin an Bhliain i nDáta an Teagmhais (formáid réamhshocraithe amháin)');
define( '_CAL_LANG_TIP_BTN_DEF_CONFIG',               'Lódáil réamhluachanna [i gcás faidbhe]');
define( '_CAL_LANG_TIP_LEV_DISPLAY_MODE',        '0 (réamhshocraithe) taispeáin na teagmhais is cóngaraí don tseachtain reatha agus an tseachtain dár gcionn suas go dtí uasmhéid na dteagmhas<br />1 mar aon le [ mód = 0 ] ach amháin go dtaispeánfar roinnt teagmhas a chuaigh thart don tseachtain reatha fosta má tá níos lú teagmhas todhchaíocha ná mar atá san uasmhéid<br />2 taispeáin na teagmhais is cóngaraí don raon [ + lá ] i gcoibhneas leis an lá reatha suas go dtí $maxEvents<br />3 mar aon le mód 2, ach amháin go dtaispeánfar teagmhais a chuaigh thart laistigh den raon [ - lá ] i gcoibhneas leis an lá reatha má tá níos lú ná mar atá in uasmhéid na dteagmhas sa raon<br />4 taispeáin na teagmhais is cóngaraí don mhí reatha suas go dtí uasmhéid na dteagmhas i gcoibhneas leis an lá reatha ');
define( '_CAL_LANG_TIP_CUT_TITLE',                      'Seans go gcuirfear isteach ar an leagan amach má tá barraíocht carachtar sa teideal.<br />Sainigh líon na gcarachtar anseo agus teascfar an teideal i ndiaidh an uasmhéid le ...');
define( '_CAL_LANG_TIP_LEV_HIDE_LINK',               'Má tá CUIR roghnaithe, socraíonn an teagmhas javascript &lt;b&gt;onclick&lt;/b&gt; nasc an teidil go dinimiciúil.  Cuireann sé seo cosc ar innill cuardaigh an nasc a leanúint.');
define( '_CAL_LANG_TIP_MAX_DISPLAY',               'Uasmhéid na dteagmhas le taispeáint <strong>mar théacs</strong> in aghaigh an lae i radharc míosa<br />Má tá neart teagmhas agat in aghaidh an lae, seans go scriosfar an leagan amach má thaispeántar iad.<br />Socraigh anseo an mhéid teagmhais le taispeáint mar théacs  má tá barraíocht ann taispeánfar iad mar íocóin (ní chuirtear isteach ar an leid uirlise)');
define( '_CAL_LANG_TIP_DIS_STARTTIME',               'Ar mhaith leat go dtaispeánfaí an t-am tosaithe [ radharc míosa ]?');

define( '_CAL_LANG_TIP_TT_BGROUND',                      'Ar mhaith leat go n-úsáidfidh an leid uirslise an cúlra céanna agus atá in úsáid ag an teagmhas?<br />Munar mhaith, úsáidfear an dath caighdeánach.');
define( '_CAL_LANG_TIP_TT_POSX',                      'Is féidir áit fhuinneog na leide uirlise bheith ar chlé, ar lár nó ar dheis.');
define( '_CAL_LANG_TIP_TT_POSY',                      'Is féidir áit ingearach na leide uirlise bheith faoi bhun nó os cionn');
define( '_CAL_LANG_TIP_TT_SHADOW',                      'Is féidir le fuinneog na leide uirlise scáil a bheith aici ar féidir bheith suite ar chlé nó ar dheis agus faoi bhun nó os cionn ');

// tabs
define( '_CAL_LANG_TAB_COMMON',                      'Coimín ');
define( '_CAL_LANG_TAB_IMAGES',                      'Íomhánna');
define( '_CAL_LANG_TAB_CALENDAR',               'Féilire');
define( '_CAL_LANG_TAB_HELP',                      'Cabhair');
define( '_CAL_LANG_TAB_EXTRA',                      'Breis');
define( '_CAL_LANG_TAB_ABOUT',                      'Faoi');
define( '_CAL_LANG_TAB_COMPONENT',               'Comhpháirt');
define( '_CAL_LANG_TAB_CAL_MOD',               'Féilire ');
define( '_CAL_LANG_TAB_LATEST_MOD',               'Teagmhais is Déanaí');
define( '_CAL_LANG_TAB_CSS',                      'CSS');
define( '_CAL_LANG_TAB_TOOLTIP',               'Leid Uirlisí');

// select lists
       //common
define( '_CAL_LANG_YES',                             'Déan');
define( '_CAL_LANG_NO',                                    'Ná Déan');
define( '_CAL_LANG_ALWAYS',                             'I GCÓNAÍ');
       // access
define( '_CAL_LANG_SEL_ACCESS_ALL_REGGED',        'Gac úsáideoir cláraithe');
define( '_CAL_LANG_SEL_ACCESS_SPECIAL',               'Sainchearta agus riarthóirí amháin');
define( '_CAL_LANG_SEL_ACCESS_ALL_ANONYM',        'Gach duine (anaithnid)  ní mholtar é seo');
define( '_CAL_LANG_SEL_ACCESS_ALL_AUTHORS',        'Údáir agus a bhfuil níos airde');
define( '_CAL_LANG_SEL_ACCESS_ALL_EDITORS',        'Eagarthóirí agus a bhfuil níos airde');
define( '_CAL_LANG_SEL_ACCESS_ALL_PUBLISHERS',        'Foilsitheoirí agus a bhfuil níos airde');
define( '_CAL_LANG_SEL_ACCESS_ALL_MANAGERS',        'Bainisteoirí agus a bhfuil níos airde');
define( '_CAL_LANG_SEL_ACCESS_ALL_ADMIN',        'Riarthóirí agus Sár-Riarthóirí amháin');
       // first day
define( '_CAL_LANG_FIRST_DAY',                      'An Chéad Lá');
define( '_CAL_LANG_SUNDAY_FIRST',               'An Domhnach ar dtús');
define( '_CAL_LANG_MONDAY_FIRST',               'An Luan ar dtús');

define( '_CAL_LANG_VIEW_MAIL',                      'Féach post');
define( '_CAL_LANG_VIEW_BY',                      'Féach Le');
define( '_CAL_LANG_VIEW_HITS',                      'Féach Amais');
define( '_CAL_LANG_VIEW_REPEAT_TIME',        'Féach Athdhéanamh agus am');
define( '_CAL_LANG_VIEW_REPEAT_YEAR_LIST',        'Nocht gach Teagmhas Athdhéanta i liosta Bliana');
define( '_CAL_LANG_SHOW_CATS',                      'Cuir Féach de réir catagóire i bhfolach (fóirsteanach má tá modúl eochair eolas an teagmhais le feiceáil)');
define( '_CAL_LANG_SHOW_COPYRIGHT',               'Nocht buntásc an chóipchirt');
       // date format
define( '_CAL_LANG_DATE_FORMAT',               'Formáid an Dháta');
define( '_CAL_LANG_DATE_FORMAT_FR_EN',        'i bhFraincais-i mBearla');
define( '_CAL_LANG_DATE_FORMAT_US',               'US');
define( '_CAL_LANG_DATE_FORMAT_GERMAN',        'Mór-roinne - Gearmánach');

define( '_CAL_LANG_TIME_FORMAT_12',               'Úsáid formáid an chloig 12 uair');
       // nav bar
define( '_CAL_LANG_NAV_BAR_COLOR',               'Dath an Bharra Nascleanúna');
define( '_CAL_LANG_NAV_BAR_GREEN',               'Glas');
define( '_CAL_LANG_NAV_BAR_ORANGE',               'Oráiste');
define( '_CAL_LANG_NAV_BAR_BLUE',               'Gorm');
define( '_CAL_LANG_NAV_BAR_RED',               'Dearg');
define( '_CAL_LANG_NAV_BAR_GRAY',               'Glas');
define( '_CAL_LANG_NAV_BAR_YELLOW',               'Buí');

       // start page
define( '_CAL_LANG_START_PAGE',                      'Leathanach Tosaithe');
define( '_CAL_LANG_SP_DAY',                             'Lá');
define( '_CAL_LANG_SP_WEEK',                      'Seachtain');
define( '_CAL_LANG_SP_MONTH_CAL',               'Mí (Féilire)');
define( '_CAL_LANG_SP_MONTH_LIST',               'Mí (liosta)');
define( '_CAL_LANG_SP_YEAR',                      'Bliain');
define( '_CAL_LANG_SP_CATEGORIES',               'Catagóirí');
define( '_CAL_LANG_SP_SEARCH',                      'Cuardaigh');

define( '_CAL_LANG_NR_OF_LIST',                      'Líon na dTeagmhas');
define( '_CAL_LANG_FE_SIMPLE_FORM',               'Úsáid Simplí');
       // event color
define( '_CAL_LANG_DEF_EVENT_COLOR',        'Dath Teagmhais Réamhshocraithe');
define( '_CAL_LANG_DEF_EC_RANDOM',               'Teagmhasach');
define( '_CAL_LANG_DEF_EC_NONE',               'Neamhní');
define( '_CAL_LANG_DEF_EC_CATEGORY',        'Catagóir');
define( '_CAL_LANG_DEF_EC_HIDE_FORCE',        'Rial Dath an Teagmhais');
define( '_CAL_LANG_EVENT_COLS_ALLOWED',        'Ceadaítear dathanna sainiúla don teagmhas');
define( '_CAL_LANG_EVENT_COLS_BACKED',        'Dathanna teagmhais in eagar deiridh amháin');
define( '_CAL_LANG_ALWAYS_CAT_COLOR',        'Úsáid dathanna catagóire i gcónaí');

       // tooltips
define( '_CAL_LANG_ABOVE',                             'Thuas');
define( '_CAL_LANG_BELOW',                             'Thíos');

// calendar module
       // display last month
define( '_CAL_LANG_DISPLAY_LAST_MONTH',        'Taispeáin an Mhí Dheireanach');
define( '_CAL_LANG_DLM_YES_STOP_DAY',        'TAISPEÁIN  le lá stad');
define( '_CAL_LANG_DLM_YES_EVENT_SDAY',        'TAISPEÁIN  má tá teagmhais AGUS lá stad ann');
define( '_CAL_LANG_DLM_ALWYS_IF_EVENTS','I gCÓNAÍ  má tá teagmhais ann' );
       // stop day
define( '_CAL_LANG_DLM_STOP_DAY',               'Lá sa mhí reatha chun stad a dhéanamh');
       // display next month
define( '_CAL_LANG_DISPLAY_NEXT_MONTH',        'Taispeáin an chéad Mhí eile');
define( '_CAL_LANG_DNM_YES_START_DAY',        'TAISPEÁIN  le Lá Túis');
define( '_CAL_LANG_DNM_YES_EVENT_SDAY',  'TAISPEÁIN  má tá teagmhais AGUS lá túis ann');
define( '_CAL_LANG_DNM_ALWYS_IF_EVENTS','I gCÓNAÍ  má tá teagmhais ann' );
       // start day
define( '_CAL_LANG_DNM_START_DAY',               'Laethanta fágtha sa mhí reatha go dtí an Tús');

// latest events module
define( '_CAL_LANG_LEV_MAX_DISPLAY',        'Uasmhéid na dTeagmhas le Taispeáint');
define( '_CAL_LANG_LEV_DISPLAY_MODE',        'Mód Taispeána');
define( '_CAL_LANG_LEV_DAY_RANGE',               'Laethanta Roimh/I nDiaidh');
define( '_CAL_LANG_LEV_REP_EV_ONCE',        'Ná taispeáin Teagmhas athdhéanta ach uair amháin');
define( '_CAL_LANG_LEV_EV_AS_LINK',               'Taispeáin Teagmhais mar Nasc');
define( '_CAL_LANG_LEV_DISPLAY_YEAR',        'Taispeáin Bliain');
define( '_CAL_LANG_LEV_CSS_DATE_FIELD',        'Díchumasaigh Stíl Réimse an Dáta CSS réamhshocraithe');
define( '_CAL_LANG_LEV_CSS_TITLE_FIELD','Díchumasaigh Stíl Theideal an Dáta CSS réamhshocraithe' );
define( '_CAL_LANG_LEV_HIDE_LINK',               'Cuir nasc an teidil i bhfolach');
define( '_CAL_LANG_LEV_CUST_FORM_STRING','Teaghrán Formáide Saincheaptha' );

// tooltips frontpage (overlib)
define( '_CAL_LANG_TOOLTIP',                      'Is le fuinneog na leide uirlise na socruithe i radharc míosa');
define( '_CAL_LANG_TT_MAINWINDOW',               'Príomhfhuinneog na Leide Uirlise');
define( '_CAL_LANG_TT_BGROUND',                      'Cúlra céanna agus mar atá ar an teagmhas');
define( '_CAL_LANG_TT_POSX',                      'Áit chothrománach');
define( '_CAL_LANG_TT_POSY',                      'Áit ingearach');
define( '_CAL_LANG_TT_SHADOW',                      'Scáil');
define( '_CAL_LANG_TT_SHADOWX',                      'Ar Chlé');
define( '_CAL_LANG_TT_SHADOWY',                      'Thuas');

// buttons
define( '_CAL_LANG_BTN_DEF_CONFIG',               'Athshocraigh');

// installation
define( '_CAL_LANG_INSTAL_MAIN',               'Imeacht');
define( '_CAL_LANG_INSTAL_MANAGE',               'Bainistigh Teagmhais');
define( '_CAL_LANG_INSTAL_CATS',               'Bainistigh Catagóirí');
define( '_CAL_LANG_INSTAL_CONFIG',               'Cumraíocht');
define( '_CAL_LANG_INSTAL_ARCHIVE',               'Cartlann');
define( '_CAL_LANG_INSTAL_ERROR',               'Tharla na hearráidí seo');
define( '_CAL_LANG_INSTAL_SUCCESS',               'Déirigh le suiteáil na dteagmhas');
define( '_CAL_LANG_INSTALL_DB_ENTRIES',        'Iontrálacha bhunachar sonraí, Athruithe');
define( '_CAL_LANG_INSTALL_PREV_INST',        'Baineadh iontrálacha dúbailte bhunachar sonraí');

DEFINE("_CAL_LANG_EVENT_ALLDAY","Teagmhas don Lá ar fad nó Am Neamhshonraithe");  // new for 1.4


?>