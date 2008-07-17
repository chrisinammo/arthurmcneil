<?php
/**
 * Events Component for Joomla 1.0.x
 *
 * @version     $Id: admin_irish.php 1047 2008-04-12 15:15:44Z tstahl $
 * @package     Events
 * @copyright   Copyright (C) 2006-2008 JEvents Project Group
 * @copyright (C) 2000 - 2003 Eric Lamette, Dave McDonnell
 * @licence     http://www.gnu.org/copyleft/gpl.html
 * @link        http://forge.joomla.org/sf/projects/jevents
 * @translation John Duffy
 */


defined( '_VALID_MOS' ) or die( 'N� cheada�tear rochain d�reach chuig an su�omh seo.' );

//Check
if( defined( '_CAL_ADMIN_LANG_INCLUDED' )) {
       return;
}

DEFINE( '_CAL_ADMIN_LANG_INCLUDED', 1 );

/* +++++++++++++++++++ */
define( '_CAL_HIDE_OLD_EVENTS',                      'Cuir Teagmhais a chuaigh thart i bhFolach');
define( '_CAL_LANG_CATEGORIES',                  'Catag�ir�');
define( '_CAL_LANG_DISPLAY',                      'Sc�ile�n');
define( '_CAL_LANG_CATEGORY_NAME',               'Ainm na Catag�ire');
define( '_CAL_LANG_RECORDS',                      'de&nbsp;Thuairisc�');
define( '_CAL_LANG_CHECKED_OUT',               'L�nseice�ilte');
define( '_CAL_LANG_PUBLISHED',                      'A fhoilsi�');
define( '_CAL_LANG_NOT_PUBLISHED',               'N� fhoilseofar');
define( '_CAL_LANG_ACCESS',                             'Rochtain');
define( '_CAL_LANG_REORDER',                      'Athchur in ord');
define( '_CAL_LANG_UNPUBLISH',                      'D�fhoilsigh');
define( '_CAL_LANG_PUBLISH',                      'Foilsigh');
define( '_CAL_LANG_CLICK_TO_EDIT',               'Clice�il chun t�acs a chur in eagar');
define( '_CAL_LANG_MOVE_UP',                      'Bog Suas');
define( '_CAL_LANG_MOVE_DOWN',                      'Bog S�os');
define( '_CAL_LANG_EDIT_CAT',                      'Cuir Catag�ir in Eagar');
define( '_CAL_LANG_ADD_CAT',                      'Cuir Catag�ir Leis');
define( '_CAL_LANG_CAT_TITLE',                      'Teideal na Catag�ire');
define( '_CAL_LANG_CAT_NAME',                      'Ainm na Catag�ire');
define( '_CAL_LANG_IMAGE',                             '�omh�');
define( '_CAL_LANG_PREVIEW',                      'R�amhamharc');
define( '_CAL_LANG_IMG_POSITION',               'Su�omh na h�omh�');
define( '_CAL_LANG_ORDERING',                      'Ord');
define( '_CAL_LANG_LEFT',                             'Ar Chl�');
define( '_CAL_LANG_CENTER',                             'L�rnach');
define( '_CAL_LANG_RIGHT',                             'Ar Dheis');
define( '_CAL_LANG_SELECT_IMAGE',               'Roghnaigh �omh�');
define( '_CAL_LANG_SEARCH',                             'Cuardaigh');
define( '_CAL_LANG_TITLE',                             'Teideal');
define( '_CAL_LANG_REPEAT',                             'Athdh�an');
define( '_CAL_LANG_TIME_SHEET',                      'Bileog Ama');
define( '_CAL_CLICK_TO_CHANGE_STATUS',        'Clice�il ar an �oc�n leis an st�das a athr�');
define( '_CAL_LANG_PUB_BUT_COMING',               'Foilsithe, ach t� <u>Ag teacht</u>');
define( '_CAL_LANG_PUB_ACTUAL',                      'Foilsithe, ach t� <u>Ag dul ar Aghaigh</u>');
define( '_CAL_LANG_PUB_FINISHED',               'Foilsithe, ach t� <u>Cr�ochnaithe</u>');
define( '_CAL_LANG_EDIT_EVENT',                      'Cuir Imeacht in Eagar');
define( '_CAL_LANG_ADD_EVENT',                      'Cuir teagmhas leis');
define( '_CAL_LANG_REQUIRED',                      'Riachtanach');
define( '_CAL_LANG_IMG_FOLDER',                      'Fho-fhillte�n');
define( '_CAL_LANG_IMAGES',                             'Gaileara� �omh�nna');
define( '_CAL_LANG_AVAL_IMAGES',               '�omh�nna a bhfuil f�il orthu');
define( '_CAL_LANG_INSERT_IMG',                      'Cuir &raquo; isteach');
define( '_CAL_LANG_CONTENT_IMGS',               '�omh�nna �bhair');
define( '_CAL_LANG_REMOVE',                             'Bain');
define( '_CAL_LANG_EDITED_SEL_IMG',               'Cuir an �omh� roghnaithe in eagar');
define( '_CAL_LANG_SOURCE',                             'Foinse');
define( '_CAL_LANG_ALIGN',                             'Ail�nigh');
define( '_CAL_LANG_ALT_TXT',                      'T�acs Malartach');
define( '_CAL_LANG_BORDER',                             'Iml�ne');
define( '_CAL_LANG_CAPTION',                      'Teideal');
define( '_CAL_LANG_CAPTION_POSITION',        '�it an Fhortheidil');
define( '_CAL_LANG_CAPTION_POS_BOTTOM',        'Ag bun');
define( '_CAL_LANG_CAPTION_POS_TOP',        'Ag barr');
define( '_CAL_LANG_CAPTION_ALIGN',               'Ail�ni� an Fhortheidil');
define( '_CAL_LANG_CAPTION_WIDTH',               'Leithead an Fhortheidil');
define( '_CAL_LANG_APPLY',                             'Cuir i bhFeidhm');
define( '_CAL_LANG_ADD_INFO',                      'Eolas Breise');
define( '_CAL_LANG_EVENT_STATUS',               'St�das an Imeachta');
define( '_CAL_LANG_ARCHIVED',                      'Curtha i gCartlann');
define( '_CAL_LANG_DRAFT_UNPUB',               'Dr�acht neamhfhoilsithe');
define( '_CAL_LANG_NEVER',                             'Riamh');
define( '_CAL_LANG_CUT_TITLE',                      'Fad an Teidil');
define( '_CAL_LANG_MAX_DISPLAY',               'Uasmh�id Teagmhas');
define( '_CAL_LANG_DIS_STARTTIME',               'Nocht Am Tosaithe');

       // config
define( '_CAL_LANG_EVENTS_CONFIG',               'Cumra�ocht Jevents');
define( '_CAL_LANG_CONFIG_WRITEABLE',        'T� an Config inscr�ofa');
define( '_CAL_LANG_CONFIG_NOT_WRITEABLE','N�l an Config inscr�ofa');
define( '_CAL_LANG_CSS_WRITEABLE',               'T� an comhad CSS inscr�ofa');
define( '_CAL_LANG_CSS_NOT_WRITEABLE',        'N�l an comhad CSS inscr�ofa');
define( '_CAL_LANG_ADMIN_EMAIL',               'Post Riarth�ra');
define( '_CAL_LANG_FRONTEND_PUBLISHING','Foilsigh � Frontend' );
define( '_CAL_LANG_SETT_FOR_COM',               'N�l na socruithe seo ach don chomhph�irt');
define( '_CAL_LANG_SETT_FOR_CAL_MOD',        'N�l na socruithe seo ach don mhod�l fh�ilire breise');
define( '_CAL_LANG_SETT_FOR_MOD_LATEST','N�l na socruithe seo ach don mhod�l breise [Teagmhais is D�ana�]' );
define( '_CAL_LANG_ICONIC_NAVBAR'              ,'�s�id an barra Nasclean�int �oc�in �r'); // 1.4
define( '_CAL_LANG_CHECK_VERSION'              ,"Seice�il le haghaigh leagain n�os nua"); // 1.4

// errors
define( '_CAL_LANG_ERR_CAT_MUST_HAVE_NAME',        'Caithfidh go bhfuil ainm ar an Chatag�ir');

// title & alts
define( '_CAL_LANG_TIT_NAME_FOR_MENUS',        'Ainm gearr a thaispe�nfar i roghchl�ir');
define( '_CAL_LANG_TIT_LONG_NAME',               'Ainm fada a thaispe�nfar i gceannteidil');
define( '_CAL_LANG_TIT_PENDING',               'Ar Feitheamh');

// msgs
define( '_CAL_LANG_MSG_CAT_IS_EDITED',        'T� [ %s ] na catag�ire � chur in eagar ag riarth�ir eile faoi l�thair');
define( '_CAL_LANG_MSG_OP_FAILED',               'Theip ar Oibri�: N�orbh fh�idir [ %s ] a oscailt');
define( '_CAL_LANG_MSG_CHANGE_EMAIL',        'T�igh go RANN�N CUMRA�OCHTA NA dTEAGMHAS ar dt�s agus athraigh R�OMHSHEOLADH');
define( '_CAL_LANG_MSG_ADD_CAT_BEFORE',        'N� m�r catag�ir a chur leis an rann�n seo ar dt�s');
define( '_CAL_LANG_MSG_CONFIG_SAVED',        'D��irigh le s�bh�il an comhaid �config� ');
define( '_CAL_LANG_MSG_WARNING',               'Rabhadh�');
define( '_CAL_LANG_MSG_CHMOD_CONFIG',        'N� m�r duit �chmod� a dh�anamh ar an chomhad config go 0777 le go nuashonr�far an config');
define( '_CAL_LANG_MSG_CHMOD_CSS',               'N� m�r duit �chmod� a dh�anamh ar an chomhad css go 0777 le go nuashonr�far an config');
define( '_CAL_LANG_MSG_MOD_NOT_INSTALLED','N�l an mod�l f�ilire suite�ilte' );
define( '_CAL_LANG_MSG_NO_MOD_LATEST',        'N�l an mod�l [ teamghais is d�ana� ] suite�ilte');

// tips
define( '_CAL_LANG_TIP_ACCESS',                      'C� hiad a bhfuil cead acu teagmhais nua a chruth�');
define( '_CAL_LANG_TIP_FRONT_PUB',               'Ceadaigh foilsitheoir�, bainisteoir� agus �s�ideoir� riarach�in �bhar a fhoilsi� � frontend');
define( '_CAL_LANG_TIP_NR_OF_LIST',               'L�on na dteagmhas le bheith ar taispe�int ar gach leathanach do radharcanna seachtaine/m�osa/bliana');
define( '_CAL_LANG_TIP_FE_SIMPLE_FORM',        '�s�id Foirm Iontr�la Shimpl� (ms. Gan cine�lacha athdh�anta) do thosach �s�ideora');
define( '_CAL_LANG_TIP_DEF_EC_HIDE_FORCE',        '<b>Ceada�tear dathanna saini�la don teagmhas</b><br/>Is f�idir le heagarth�ir� tosaigh/deiridh dathanna saini�la don teagmhas a �s�id</br><b>Dathanna teagmhais in eagar deiridh amh�in</b><br/>N� f�idir ach le heagarth�ir� deiridh dathanna saini�la don teagmhas a shonr�<br/><b>�s�id dathanna na catag�ire i gc�na�</b><br/>N� f�idir le heagarth�ir� dathanna saini�la don teagmhas a �s�id agus d�anfar neamhaird de dhathanna saini�la don teagmhas ar bith a shain�tear sula n-�s�idtear an socr� seo, agus taispe�nfar dath na catag�ire ina n-�it');
define( '_CAL_LANG_TIP_DLM_STOP_DAY',               'L� sa Mh� Reatha ar a gcuirfear stad leis an Mh� roimhe');
define( '_CAL_LANG_TIP_DNM_START_DAY',               'Laethanta f�gtha sa Mh� Reatha go dt� go dtaispe�nfar an Ch�ad Mh� eile');
define( '_CAL_LANG_TIP_LEV_DAY_RANGE',               'Raon na leathanta i gcoibhneas leis an L� Reatha le teagmhais a thaispe�int ann (m�danna 1 n� 3 amh�in)');
define( '_CAL_LANG_TIP_LEV_DISPLAY_YEAR',        'Taispe�in an Bhliain i nD�ta an Teagmhais (form�id r�amhshocraithe amh�in)');
define( '_CAL_LANG_TIP_BTN_DEF_CONFIG',               'L�d�il r�amhluachanna [i gc�s faidbhe]');
define( '_CAL_LANG_TIP_LEV_DISPLAY_MODE',        '0 (r�amhshocraithe) taispe�in na teagmhais is c�ngara� don tseachtain reatha agus an tseachtain d�r gcionn suas go dt� uasmh�id na dteagmhas<br />1 mar aon le [ m�d = 0 ] ach amh�in go dtaispe�nfar roinnt teagmhas a chuaigh thart don tseachtain reatha fosta m� t� n�os l� teagmhas todhcha�ocha n� mar at� san uasmh�id<br />2 taispe�in na teagmhais is c�ngara� don raon [ + l� ] i gcoibhneas leis an l� reatha suas go dt� $maxEvents<br />3 mar aon le m�d 2, ach amh�in go dtaispe�nfar teagmhais a chuaigh thart laistigh den raon [ - l� ] i gcoibhneas leis an l� reatha m� t� n�os l� n� mar at� in uasmh�id na dteagmhas sa raon<br />4 taispe�in na teagmhais is c�ngara� don mh� reatha suas go dt� uasmh�id na dteagmhas i gcoibhneas leis an l� reatha ');
define( '_CAL_LANG_TIP_CUT_TITLE',                      'Seans go gcuirfear isteach ar an leagan amach m� t� barra�ocht carachtar sa teideal.<br />Sainigh l�on na gcarachtar anseo agus teascfar an teideal i ndiaidh an uasmh�id le �...�');
define( '_CAL_LANG_TIP_LEV_HIDE_LINK',               'M� t� CUIR roghnaithe, socra�onn an teagmhas javascript &lt;b&gt;onclick&lt;/b&gt; nasc an teidil go dinimici�il.  Cuireann s� seo cosc ar innill cuardaigh an nasc a lean�int.');
define( '_CAL_LANG_TIP_MAX_DISPLAY',               'Uasmh�id na dteagmhas le taispe�int <strong>mar th�acs</strong> in aghaigh an lae i radharc m�osa<br />M� t� neart teagmhas agat in aghaidh an lae, seans go scriosfar an leagan amach m� thaispe�ntar iad.<br />Socraigh anseo an mh�id teagmhais le taispe�int mar th�acs � m� t� barra�ocht ann taispe�nfar iad mar �oc�in (n� chuirtear isteach ar an leid uirlise)');
define( '_CAL_LANG_TIP_DIS_STARTTIME',               'Ar mhaith leat go dtaispe�nfa� an t-am tosaithe [ radharc m�osa ]?');

define( '_CAL_LANG_TIP_TT_BGROUND',                      'Ar mhaith leat go n-�s�idfidh an leid uirslise an c�lra c�anna agus at� in �s�id ag an teagmhas?<br />Munar mhaith, �s�idfear an dath caighde�nach.');
define( '_CAL_LANG_TIP_TT_POSX',                      'Is f�idir �it fhuinneog na leide uirlise bheith ar chl�, ar l�r n� ar dheis.');
define( '_CAL_LANG_TIP_TT_POSY',                      'Is f�idir �it ingearach na leide uirlise bheith faoi bhun n� os cionn');
define( '_CAL_LANG_TIP_TT_SHADOW',                      'Is f�idir le fuinneog na leide uirlise sc�il a bheith aici ar f�idir bheith suite ar chl� n� ar dheis agus faoi bhun n� os cionn ');

// tabs
define( '_CAL_LANG_TAB_COMMON',                      'Coim�n ');
define( '_CAL_LANG_TAB_IMAGES',                      '�omh�nna');
define( '_CAL_LANG_TAB_CALENDAR',               'F�ilire');
define( '_CAL_LANG_TAB_HELP',                      'Cabhair');
define( '_CAL_LANG_TAB_EXTRA',                      'Breis');
define( '_CAL_LANG_TAB_ABOUT',                      'Faoi');
define( '_CAL_LANG_TAB_COMPONENT',               'Comhph�irt');
define( '_CAL_LANG_TAB_CAL_MOD',               'F�ilire ');
define( '_CAL_LANG_TAB_LATEST_MOD',               'Teagmhais is D�ana�');
define( '_CAL_LANG_TAB_CSS',                      'CSS');
define( '_CAL_LANG_TAB_TOOLTIP',               'Leid Uirlis�');

// select lists
       //common
define( '_CAL_LANG_YES',                             'D�an');
define( '_CAL_LANG_NO',                                    'N� D�an');
define( '_CAL_LANG_ALWAYS',                             'I GC�NA�');
       // access
define( '_CAL_LANG_SEL_ACCESS_ALL_REGGED',        'Gac �s�ideoir cl�raithe');
define( '_CAL_LANG_SEL_ACCESS_SPECIAL',               'Sainchearta agus riarth�ir� amh�in');
define( '_CAL_LANG_SEL_ACCESS_ALL_ANONYM',        'Gach duine (anaithnid) � n� mholtar � seo');
define( '_CAL_LANG_SEL_ACCESS_ALL_AUTHORS',        '�d�ir agus a bhfuil n�os airde');
define( '_CAL_LANG_SEL_ACCESS_ALL_EDITORS',        'Eagarth�ir� agus a bhfuil n�os airde');
define( '_CAL_LANG_SEL_ACCESS_ALL_PUBLISHERS',        'Foilsitheoir� agus a bhfuil n�os airde');
define( '_CAL_LANG_SEL_ACCESS_ALL_MANAGERS',        'Bainisteoir� agus a bhfuil n�os airde');
define( '_CAL_LANG_SEL_ACCESS_ALL_ADMIN',        'Riarth�ir� agus S�r-Riarth�ir� amh�in');
       // first day
define( '_CAL_LANG_FIRST_DAY',                      'An Ch�ad L�');
define( '_CAL_LANG_SUNDAY_FIRST',               'An Domhnach ar dt�s');
define( '_CAL_LANG_MONDAY_FIRST',               'An Luan ar dt�s');

define( '_CAL_LANG_VIEW_MAIL',                      'F�ach post');
define( '_CAL_LANG_VIEW_BY',                      'F�ach �Le�');
define( '_CAL_LANG_VIEW_HITS',                      'F�ach �Amais�');
define( '_CAL_LANG_VIEW_REPEAT_TIME',        'F�ach Athdh�anamh agus am');
define( '_CAL_LANG_VIEW_REPEAT_YEAR_LIST',        'Nocht gach Teagmhas Athdh�anta i liosta Bliana');
define( '_CAL_LANG_SHOW_CATS',                      'Cuir �F�ach de r�ir catag�ire� i bhfolach (f�irsteanach m� t� mod�l eochair eolas an teagmhais le feice�il)');
define( '_CAL_LANG_SHOW_COPYRIGHT',               'Nocht bunt�sc an ch�ipchirt');
       // date format
define( '_CAL_LANG_DATE_FORMAT',               'Form�id an Dh�ta');
define( '_CAL_LANG_DATE_FORMAT_FR_EN',        'i bhFraincais-i mBearla');
define( '_CAL_LANG_DATE_FORMAT_US',               'US');
define( '_CAL_LANG_DATE_FORMAT_GERMAN',        'M�r-roinne - Gearm�nach');

define( '_CAL_LANG_TIME_FORMAT_12',               '�s�id form�id an chloig 12 uair');
       // nav bar
define( '_CAL_LANG_NAV_BAR_COLOR',               'Dath an Bharra Nasclean�na');
define( '_CAL_LANG_NAV_BAR_GREEN',               'Glas');
define( '_CAL_LANG_NAV_BAR_ORANGE',               'Or�iste');
define( '_CAL_LANG_NAV_BAR_BLUE',               'Gorm');
define( '_CAL_LANG_NAV_BAR_RED',               'Dearg');
define( '_CAL_LANG_NAV_BAR_GRAY',               'Glas');
define( '_CAL_LANG_NAV_BAR_YELLOW',               'Bu�');

       // start page
define( '_CAL_LANG_START_PAGE',                      'Leathanach Tosaithe');
define( '_CAL_LANG_SP_DAY',                             'L�');
define( '_CAL_LANG_SP_WEEK',                      'Seachtain');
define( '_CAL_LANG_SP_MONTH_CAL',               'M� (F�ilire)');
define( '_CAL_LANG_SP_MONTH_LIST',               'M� (liosta)');
define( '_CAL_LANG_SP_YEAR',                      'Bliain');
define( '_CAL_LANG_SP_CATEGORIES',               'Catag�ir�');
define( '_CAL_LANG_SP_SEARCH',                      'Cuardaigh');

define( '_CAL_LANG_NR_OF_LIST',                      'L�on na dTeagmhas');
define( '_CAL_LANG_FE_SIMPLE_FORM',               '�s�id Simpl�');
       // event color
define( '_CAL_LANG_DEF_EVENT_COLOR',        'Dath Teagmhais R�amhshocraithe');
define( '_CAL_LANG_DEF_EC_RANDOM',               'Teagmhasach');
define( '_CAL_LANG_DEF_EC_NONE',               'Neamhn�');
define( '_CAL_LANG_DEF_EC_CATEGORY',        'Catag�ir');
define( '_CAL_LANG_DEF_EC_HIDE_FORCE',        'Rial Dath an Teagmhais');
define( '_CAL_LANG_EVENT_COLS_ALLOWED',        'Ceada�tear dathanna saini�la don teagmhas');
define( '_CAL_LANG_EVENT_COLS_BACKED',        'Dathanna teagmhais in eagar deiridh amh�in');
define( '_CAL_LANG_ALWAYS_CAT_COLOR',        '�s�id dathanna catag�ire i gc�na�');

       // tooltips
define( '_CAL_LANG_ABOVE',                             'Thuas');
define( '_CAL_LANG_BELOW',                             'Th�os');

// calendar module
       // display last month
define( '_CAL_LANG_DISPLAY_LAST_MONTH',        'Taispe�in an Mh� Dheireanach');
define( '_CAL_LANG_DLM_YES_STOP_DAY',        'TAISPE�IN � le l� stad');
define( '_CAL_LANG_DLM_YES_EVENT_SDAY',        'TAISPE�IN � m� t� teagmhais AGUS l� stad ann');
define( '_CAL_LANG_DLM_ALWYS_IF_EVENTS','I gC�NA� � m� t� teagmhais ann' );
       // stop day
define( '_CAL_LANG_DLM_STOP_DAY',               'L� sa mh� reatha chun stad a dh�anamh');
       // display next month
define( '_CAL_LANG_DISPLAY_NEXT_MONTH',        'Taispe�in an ch�ad Mh� eile');
define( '_CAL_LANG_DNM_YES_START_DAY',        'TAISPE�IN � le L� T�is');
define( '_CAL_LANG_DNM_YES_EVENT_SDAY',  'TAISPE�IN � m� t� teagmhais AGUS l� t�is ann');
define( '_CAL_LANG_DNM_ALWYS_IF_EVENTS','I gC�NA� � m� t� teagmhais ann' );
       // start day
define( '_CAL_LANG_DNM_START_DAY',               'Laethanta f�gtha sa mh� reatha go dt� an T�s');

// latest events module
define( '_CAL_LANG_LEV_MAX_DISPLAY',        'Uasmh�id na dTeagmhas le Taispe�int');
define( '_CAL_LANG_LEV_DISPLAY_MODE',        'M�d Taispe�na');
define( '_CAL_LANG_LEV_DAY_RANGE',               'Laethanta Roimh/I nDiaidh');
define( '_CAL_LANG_LEV_REP_EV_ONCE',        'N� taispe�in Teagmhas athdh�anta ach uair amh�in');
define( '_CAL_LANG_LEV_EV_AS_LINK',               'Taispe�in Teagmhais mar Nasc');
define( '_CAL_LANG_LEV_DISPLAY_YEAR',        'Taispe�in Bliain');
define( '_CAL_LANG_LEV_CSS_DATE_FIELD',        'D�chumasaigh St�l R�imse an D�ta CSS r�amhshocraithe');
define( '_CAL_LANG_LEV_CSS_TITLE_FIELD','D�chumasaigh St�l Theideal an D�ta CSS r�amhshocraithe' );
define( '_CAL_LANG_LEV_HIDE_LINK',               'Cuir nasc an teidil i bhfolach');
define( '_CAL_LANG_LEV_CUST_FORM_STRING','Teaghr�n Form�ide Saincheaptha' );

// tooltips frontpage (overlib)
define( '_CAL_LANG_TOOLTIP',                      'Is le fuinneog na leide uirlise na socruithe i radharc m�osa');
define( '_CAL_LANG_TT_MAINWINDOW',               'Pr�omhfhuinneog na Leide Uirlise');
define( '_CAL_LANG_TT_BGROUND',                      'C�lra c�anna agus mar at� ar an teagmhas');
define( '_CAL_LANG_TT_POSX',                      '�it chothrom�nach');
define( '_CAL_LANG_TT_POSY',                      '�it ingearach');
define( '_CAL_LANG_TT_SHADOW',                      'Sc�il');
define( '_CAL_LANG_TT_SHADOWX',                      'Ar Chl�');
define( '_CAL_LANG_TT_SHADOWY',                      'Thuas');

// buttons
define( '_CAL_LANG_BTN_DEF_CONFIG',               'Athshocraigh');

// installation
define( '_CAL_LANG_INSTAL_MAIN',               'Imeacht');
define( '_CAL_LANG_INSTAL_MANAGE',               'Bainistigh Teagmhais');
define( '_CAL_LANG_INSTAL_CATS',               'Bainistigh Catag�ir�');
define( '_CAL_LANG_INSTAL_CONFIG',               'Cumra�ocht');
define( '_CAL_LANG_INSTAL_ARCHIVE',               'Cartlann');
define( '_CAL_LANG_INSTAL_ERROR',               'Tharla na hearr�id� seo');
define( '_CAL_LANG_INSTAL_SUCCESS',               'D��irigh le suite�il na dteagmhas');
define( '_CAL_LANG_INSTALL_DB_ENTRIES',        'Iontr�lacha bhunachar sonra�, Athruithe');
define( '_CAL_LANG_INSTALL_PREV_INST',        'Baineadh iontr�lacha d�bailte bhunachar sonra�');

DEFINE("_CAL_LANG_EVENT_ALLDAY","Teagmhas don L� ar fad n� Am Neamhshonraithe");  // new for 1.4


?>