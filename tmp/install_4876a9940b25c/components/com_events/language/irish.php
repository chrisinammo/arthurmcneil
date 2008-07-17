<?php
/**
 * Events Component for Joomla 1.0.x
 *
 * @version     $Id: irish.php 1047 2008-04-12 15:15:44Z tstahl $
 * @package     Events
 * @copyright   Copyright (C) 2006-2008 JEvents Project Group
 * @licence     http://www.gnu.org/copyleft/gpl.html
 * @link        http://forge.joomla.org/sf/projects/jevents
 * @translation John Duffy
 */

defined("_VALID_MOS") or die("N� cheada�tear rochain d�reach chuig an su�omh seo.");

//Check
DEFINE("_CAL_LANG_INCLUDED", 1);

// new 1.4.0 [mic]
define("_CAL_LANG_LNG", "ga"); // de|fr|etc... [ DO NOT CHANGE THIS VALUE! ]
define("_CAL_LANG_REPEAT_GRAMMAR","1"); // in repeat summary 1 = follow English word order, 2= follow German word order

// used for colorpicker
define("_CAL_LANG_NO_COLOR", "Dath ar bith");
define("_CAL_LANG_COLOR_PICKER", "Roghn�ir na nDathanna");

// common
define("_CAL_LANG_TIME", "Am");
define("_CAL_LANG_CLICK_TO_OPEN_EVENT", "Clice�il chun teagmhas a oscailt");
define("_CAL_LANG_UNPUBLISHED", "** Neamhfhoilsithe **");
define("_CAL_LANG_DESCRIPTION", "Cur S�os");
define("_CAL_LANG_EMAIL_TO_AUTHOR", "Cuir R�omhphost chuig an �dar");
define("_CAL_LANG_MAIL_TO_ADMIN", "Chuir [ %s ] an Teagmhas isteach � [ %s ]");
define("_CAL_LANG_KEYWORD_NOT_VALID", "N� eochairfhocal bail� � seo");
define("_CAL_LANG_EVENT_CALENDAR", "F�ilire Teagmhas");

// modul
define("_CAL_LANG_ERR_NO_MOD_CAL", "F�ilire Teagmhas\n<br />T� an chomhph�irt Teagmhas de dh�th ar an mhod�l seo");
define("_CAL_LANG_CLICK_TOSWITCH_DAY", "T�igh go dt� an f�ilire � an l� inniu");
define("_CAL_LANG_CLICK_TOSWITCH_MON", "T�igh go dt� an f�ilire � an mh� reatha");
define("_CAL_LANG_CLICK_TOSWITCH_YEAR", "T�igh go dt� an f�ilire � an bhliain reatha");
define("_CAL_LANG_CLICK_TOSWITCH_PY", "T�igh go dt� an f�ilire � an bhliain roimhe");
define("_CAL_LANG_CLICK_TOSWITCH_PM", "T�igh go dt� an f�ilire � an mh� roimhe");
define("_CAL_LANG_CLICK_TOSWITCH_NM", "T�igh go dt� an f�ilire � an ch�ad mh� eile");
define("_CAL_LANG_CLICK_TOSWITCH_NY", "T�igh go dt� an f�ilire � an ch�ad bhliain eile");

// navTableNext
define("_CAL_LANG_NAV_TN_FIRST_LIST", "An ch�ad liosta");
define("_CAL_LANG_NAV_TN_PREV_LIST", "An liosta roimhe");
define("_CAL_LANG_NAV_TN_NEXT_LIST", "An ch�ad liosta eile");
define("_CAL_LANG_NAV_TN_LAST_LIST", "An liosta deireanach");

// calendar monthly display
define("_CAL_LANG_FIRST_SINGLE_DAY_EVENT", "Teagmhas aonair");
define("_CAL_LANG_FIRST_DAY_OF_MULTIEVENT", "An ch�ad l� de theagmhas il-laethanta");
define("_CAL_LANG_LAST_DAY_OF_MULTIEVENT", "An l� deireanach de theagmhas il-laethanta");
define("_CAL_LANG_MULTIDAY_EVENT", "Teagmhas il-laethanta");
/* ++++++ end mic +++++++++++++ */

// Months
DEFINE("_CAL_LANG_JANUARY", "Ean�ir");
DEFINE("_CAL_LANG_FEBRUARY", "Feabhra");
DEFINE("_CAL_LANG_MARCH", "M�rta");
DEFINE("_CAL_LANG_APRIL", "Aibre�n");
DEFINE("_CAL_LANG_MAY", "Bealtaine");
DEFINE("_CAL_LANG_JUNE", "Meitheamh");
DEFINE("_CAL_LANG_JULY", "I�il");
DEFINE("_CAL_LANG_AUGUST", "L�nasa");
DEFINE("_CAL_LANG_SEPTEMBER", "Me�n F�mhair");
DEFINE("_CAL_LANG_OCTOBER", "Deireadh F�mhair");
DEFINE("_CAL_LANG_NOVEMBER", "M� na Samhna");
DEFINE("_CAL_LANG_DECEMBER", "M� na Nollag");

// Short day names
DEFINE("_CAL_LANG_SUN", "Dom");
DEFINE("_CAL_LANG_MON", "Lua");
DEFINE("_CAL_LANG_TUE", "Mh�");
DEFINE("_CAL_LANG_WED", "C�a");
DEFINE("_CAL_LANG_THU", "D�a");
DEFINE("_CAL_LANG_FRI", "Aoi");
DEFINE("_CAL_LANG_SAT", "Sat");

// Days
DEFINE("_CAL_LANG_SUNDAY", "Domhnach");
DEFINE("_CAL_LANG_MONDAY", "Luan");
DEFINE("_CAL_LANG_TUESDAY", "Mh�irt");
DEFINE("_CAL_LANG_WEDNESDAY", "C�adaoin");
DEFINE("_CAL_LANG_THURSDAY", "D�ardaoin");
DEFINE("_CAL_LANG_FRIDAY", "Aoine");
DEFINE("_CAL_LANG_SATURDAY", "Satharn");

// Days lettres
DEFINE("_CAL_LANG_SUNDAYSHORT", "D");
DEFINE("_CAL_LANG_MONDAYSHORT", "L");
DEFINE("_CAL_LANG_TUESDAYSHORT", "M");
DEFINE("_CAL_LANG_WEDNESDAYSHORT", "C");
DEFINE("_CAL_LANG_THURSDAYSHORT", "D");
DEFINE("_CAL_LANG_FRIDAYSHORT", "A");
DEFINE("_CAL_LANG_SATURDAYSHORT", "S");

// Repeat type
DEFINE("_CAL_LANG_ALLDAYS", "Gach l�");
DEFINE("_CAL_LANG_EACHWEEK", "Gach seachtain");
DEFINE("_CAL_LANG_EACHWEEKPAIR", "Gach seachtain chothrom ");
DEFINE("_CAL_LANG_EACHWEEKIMPAIR", "Gach seachtain chorr");
DEFINE("_CAL_LANG_EACHMONTH", "Gach m�");
DEFINE("_CAL_LANG_EACHYEAR", "Gach bliain");
DEFINE("_CAL_LANG_ONLYDAYS", "Laethanta roghnaithe amh�in");
DEFINE("_CAL_LANG_EACH", "Gach");
DEFINE("_CAL_LANG_EACHOF","as gach");
DEFINE("_CAL_LANG_ENDMONTH", "deireadh na m�osa");

// Repeat days
DEFINE("_CAL_LANG_BYDAYNUMBER", "De r�ir uimhir lae");

// User type
DEFINE("_CAL_LANG_ANONYME", "Gan ainm");

// Post
//PAS D'ACCENTS DANS LES _ACT_
DEFINE("_CAL_LANG_ACT_ADDED", "Go raibh maith agat as d�inchur - Breithneoidh muid ar do thairiscint!");
DEFINE("_CAL_LANG_ACT_MODIFIED", "Mionathra�odh an teagmhas seo.");
DEFINE("_CAL_LANG_ACT_PUBLISHED", "Foils�odh an teagmhas seo.");
DEFINE("_CAL_LANG_ACT_DELETED", "Scriosadh an teagmhas seo!");
DEFINE("_CAL_LANG_NOPERMISSION", "N�l rochtain agat ar an tseirbh�s seo!");

DEFINE("_CAL_LANG_MAIL_ADDED", "Aighneacht nua ar");
DEFINE("_CAL_LANG_MAIL_MODIFIED", "Mionathr� nua ar");

// Presentation
DEFINE("_CAL_LANG_BY", "Le");
DEFINE("_CAL_LANG_FROM", "�");
DEFINE("_CAL_LANG_TO", "go");
DEFINE("_CAL_LANG_ARCHIVE", "Cartlanna");
DEFINE("_CAL_LANG_WEEK", "an tseachtain");
DEFINE("_CAL_LANG_NO_EVENTS", "Teagmhas ar bith");
DEFINE("_CAL_LANG_NO_EVENTFOR", "Teagmhas ar bith do");
DEFINE("_CAL_LANG_NO_EVENTFORTHE", "Teagmhas ar bith don");
DEFINE("_CAL_LANG_THIS_DAY", "an l� inniu f�in");
DEFINE("_CAL_LANG_THIS_MONTH", "An mh� seo");
DEFINE("_CAL_LANG_LAST_MONTH", "An mh� dheiridh");
DEFINE("_CAL_LANG_NEXT_MONTH", "An mh� seo chugainn");
DEFINE("_CAL_LANG_EVENTSFOR", "Teagmhais do");
DEFINE("_CAL_LANG_SEARCHRESULTS", "Tortha� Cuardaigh d'eochairfhocal"); // new 1.4
DEFINE("_CAL_LANG_EVENTSFORTHE", "Teagmhais don");
DEFINE("_CAL_LANG_REP_DAY", "l�");
DEFINE("_CAL_LANG_REP_WEEK", "seachtain");
DEFINE("_CAL_LANG_REP_WEEKPAIR", "Gach dara seachtain");
DEFINE("_CAL_LANG_REP_WEEKIMPAIR", "Gach tr�� seachtain");
DEFINE("_CAL_LANG_REP_MONTH", "m�");
DEFINE("_CAL_LANG_REP_YEAR", "bliain");
DEFINE("_CAL_LANG_REP_NOEVENTSELECTED", "Roghnaigh teagmhas ar dt�s");

// Navigation
DEFINE("_CAL_LANG_VIEWTODAY", "F�ach an L� inniu");
DEFINE("_CAL_LANG_VIEWTOCOME", "Ag teacht an�os an mh� seo");
DEFINE("_CAL_LANG_VIEWBYDAY", "F�ach de r�ir lae");
DEFINE("_CAL_LANG_VIEWBYCAT", "F�ach de r�ir catag�ire");
DEFINE("_CAL_LANG_VIEWBYMONTH", "F�ach de r�ir m�osa");
DEFINE("_CAL_LANG_VIEWBYYEAR", "F�ach de r�ir bliana");
DEFINE("_CAL_LANG_VIEWBYWEEK", "F�ach de r�ir seachtaine");
DEFINE("_CAL_LANG_JUMPTO", "L�im go dt� m� �igin");
DEFINE("_CAL_LANG_BACK", "Ar Ais");
DEFINE("_CAL_LANG_CLOSE", "D�n");
DEFINE("_CAL_LANG_PREVIOUSDAY", "Bliana l� sin");
DEFINE("_CAL_LANG_PREVIOUSWEEK", "Bliana seachtain sin");
DEFINE("_CAL_LANG_PREVIOUSMONTH", "Bliana m� sin");
DEFINE("_CAL_LANG_PREVIOUSYEAR", "Bliana roimhe sin");
DEFINE("_CAL_LANG_NEXTDAY", "An l� seo chugainn");
DEFINE("_CAL_LANG_NEXTWEEK", "An tseachtain seo chugainn");
DEFINE("_CAL_LANG_NEXTMONTH", "An mh� seo chugainn");
DEFINE("_CAL_LANG_NEXTYEAR", "An bliain seo chugainn");

DEFINE("_CAL_LANG_ADMINPANEL", "Pain�al Riarth�ra");
DEFINE("_CAL_LANG_ADDEVENT", "Cuir teagmhas leis");
DEFINE("_CAL_LANG_MYEVENTS", "Mo theagmhais");
DEFINE("_CAL_LANG_DELETE", "Scrios");
DEFINE("_CAL_LANG_MODIFY", "Mionathraigh");

// Form
DEFINE("_CAL_LANG_HELP", "Cabhair");

DEFINE("_CAL_LANG_CAL_TITLE", "Imeacht");
DEFINE("_CAL_LANG_ADD_TITLE", "Cuir Leis");
DEFINE("_CAL_LANG_MODIFY_TITLE", "Mionathraigh");

DEFINE("_CAL_LANG_REPEAT_DISABLED", "N�l Athdh�anamh na dTeagmhas infheidhmithe muna dtagann an D�ta Deiridh i ndiaidh an D�ta T�is.  Athraigh an D�ta Deiridh sula gcumra� t� mionshonra� athdh�anamh na dteagmhas.");
DEFINE("_CAL_LANG_EVENT_TITLE", "�bhar");
DEFINE("_CAL_LANG_EVENT_COLOR", "Dath");
DEFINE("_CAL_LANG_EVENT_CATCOLOR", "�s�id Dath na Catag�ire");
DEFINE("_CAL_LANG_EVENT_CATEGORY", "Catag�ir�");
DEFINE("_CAL_LANG_EVENT_CHOOSE_CATEG", "Roghnaigh catag�ir le do thoil");
DEFINE("_CAL_LANG_EVENT_ACTIVITY", "Gn�omha�ocht");
DEFINE("_CAL_LANG_EVENT_URLMAIL_INFO", "M�s mian leat URL a chur leis, scr�obh <br><u>http://www.mysite.com</u> n� <u>mailto:my@mail.com</u> ");
DEFINE("_CAL_LANG_EVENT_ADRESSE", "Su�omh");
DEFINE("_CAL_LANG_EVENT_CONTACT", "Teagmh�il");
DEFINE("_CAL_LANG_EVENT_EXTRA", "Eolas breise");
DEFINE("_CAL_LANG_EVENT_AUTHOR_ALIAS", "�dar (ailias)");
DEFINE("_CAL_LANG_EVENT_STARTDATE", "D�ta tosaigh");
DEFINE("_CAL_LANG_EVENT_ENDDATE", "D�ta deiridh");
DEFINE("_CAL_LANG_EVENT_STARTHOURS", "Uair an chloig tosaigh");
DEFINE("_CAL_LANG_EVENT_ENDHOURS", "Uair an chloig deiridh");
DEFINE("_CAL_LANG_EVENT_STARTTIME", "Am tosaigh");
DEFINE("_CAL_LANG_EVENT_ENDTIME", "Am deiridh");
DEFINE("_CAL_LANG_PUB_INFO", "D�ta foilsithe");
DEFINE("_CAL_LANG_EVENT_REPEATTYPE", "Cine�l Athdh�anta");
DEFINE("_CAL_LANG_EVENT_REPEATDAY", "L� athdh�anta");
DEFINE("_CAL_LANG_EVENT_CHOOSE_WEEKDAYS", "laethanta na seachtaine");
DEFINE("_CAL_LANG_EVENT_PER", "De r�ir");
DEFINE("_CAL_LANG_EVENT_WEEKOPT", "Seachtain(�) den mh�; cine�l athdh�anta");

DEFINE("_CAL_LANG_SUBMITPREVIEW", "R�amhamharc");
DEFINE("_CAL_LANG_SUBMITCANCEL", "Cealaigh");
DEFINE("_CAL_LANG_SUBMITSAVE", "S�bh�il");

DEFINE("_CAL_LANG_E_WARNWEEKS", "Roghnaigh seachtain le do thoil.");
DEFINE("_CAL_LANG_E_WARNDAYS", "Roghnaigh l� le do thoil.");

// Admin
DEFINE("_CAL_LANG_EVENT_ALLCAT", "Gach Catag�ir");
DEFINE("_CAL_LANG_EVENT_ACCESSLEVEL", "Leibh�al Rochtana");
DEFINE("_CAL_LANG_EVENT_HITS", "Amais");
DEFINE("_CAL_LANG_EVENT_STATE", "Staid");
DEFINE("_CAL_LANG_EVENT_CREATED", "Cruthaithe");
DEFINE("_CAL_LANG_EVENT_NEWEVENT", "Imeacht Nua");
DEFINE("_CAL_LANG_EVENT_MODIFIED", "Athraithe");
DEFINE("_CAL_LANG_EVENT_NOTMODIFIED", "Gan mhionathr�");

// dmcd aug 22/04  new warning alert for no specified activity in event entry
DEFINE("_CAL_LANG_WARNACTIVITY", "Caithfidh go bhfuil\\ncur s�os de chine�l �igin iontr�ilte don Ghn�omha�ocht");

DEFINE("_CAL_LEGEND_ALL_CATEGORIES", "Na Catag�ir� Uilig ...");
DEFINE("_CAL_LEGEND_ALL_CATEGORIES_DESC", "Nocht teagmhais as na catag�ir� uilig");

DEFINE("_CAL_LANG_FORM_HELP_COLOR", <<<END
        <tr>
                            <td width="110" align="left" valign="top">
            <b>Dath</b>
          </td>
          <td>Roghnaigh dath an ch�lra a bheidh le feice�il i radharc fh�ilire m�osa.  M� t� tic le ticbhosca na Catag�ire,
                            socr�far an dath mar dhath na catag�ire (socraithe ag an riatharth�ir su�mh) at� roghnaithe faoi fhoirm an t�ib ��bhar� don teagmhas, agus
                            d�chumas�far an cnaipe �Roghn�ir na nDathanna�.</td>
        </tr>
END
);

DEFINE("_CAL_LANG_FORM_HELP",  <<<END
                 <tr>
          <td align="left"><b>D�ta</b></td>
          <td>Roghnaigh an D�ta T�is agus an D�ta Deiridh don teagmhas.</td>
        </tr>
                 <tr>
          <td align="left" valign="top"><b>Am</b></td>
          <td>Roghnaigh Am Lae do theagmhais.  Is � <span style='color:blue;font-weight:bold;'>uu:nn {am|pm}</span> an fhorm�id.<br/>Is f�idir an t-am a shonr� i bhform�id an chloig 12 uair n� i bhform�id an chloig 24 uair. <br/><br/><b><i><span style='color:red;'>(Nua)</span></i> Tabhair faoi deara</b> go dtarla�onn c�s speisialta do <span style='color:red;font-weight:bold;'>theagmhais aon-lae thar o�che</span>.  Mar shampla, m� t� teagmhas aon-lae ann ag tosn� ar 19:00 agus ag cr�ochni� ar 3:00, <b>N� M�R</b> &nbsp;
                             gurb ionann an D�ta T�is agus an D�ta Deiridh, agus ba ch�ir go bhfuil siad socraithe mar aon leis an d�ta comhfhreagrach leis an l� roimh mhe�n o�che.</td>
        </tr>
END
);

DEFINE("_CAL_LANG_FORM_HELP_EXTENDED",  <<<END
        <tr>
                   <td align="left" valign="top" nowrap><b>Cine�l Athdh�anta</b></td>
                              <td colspan="2"></td>
                            </tr>
                            <tr>
                   <td colspan="2" align="left" valign="top">
                              <table width="100%" border="0" cellspacing="2">
              <tr>
                <td width="60" align="left" valign="top"><u>De r�ir Lae</u></td>
                <td width="110" align="left" valign="top" class="frm_td_bydays">
                  <font color="#000000">Gach L�<br/><i>(default)</i></font>
                </td>
                <td align="left" valign="top" class="frm_td_bydays">
                  <font color="#000000">Roghnaigh an rogha seo do theagmhas aonair neamh-atharlaithe n� do theagmhas il-laethanta, le teagmhas nua ag tarl� ar gach l� laistigh de raon an D�ta T�is agus an D�ta Deiridh</font>
                </td>
              </tr>
              <tr>
                <td width="60" rowspan="3" align="left" valign="top"><u>De r�ir Seachtaine</u></td>
                <td width="110" align="left" valign="top" class="frm_td_byweeks">
                  <font color="#000000">
                    Uair Amh�in in aghaidh na Seachtaine
                  </font>
                </td>
                <td align="left" valign="top" class="frm_td_byweeks">
                  <font color="#000000">
                  Cumasa�onn an rogha seo duit an l� den tseachtain athdh�anta a roghn�
                  <table border="0" width="100%" height="100%"><tr><td><b>Uimhir lae</b> don chine�l athdh�anta gach 10/../2003</td></tr><tr><td><b>Ainm lae</b> don chine�l athdh�anta gach Luan</td></tr></table>
                  </font>
                </td>
              </tr>
              <tr>
                <td width="110" align="left" valign="top" class="frm_td_byweeks">
                  <font color="#000000">
                    Laethanta iolracha den tseachtain in aghaidh na seachtaine
                  </font>
                </td>
                <td align="left" valign="top" class="frm_td_byweeks">
                  <font color="#000000">Cumasa�onn an rogha seo duit na laethanta a roghn� a mbeidh do theagmhas le feice�il orthu.</font>
                </td>
              </tr>
              <tr>
                <td width="110" align="left" valign="top" class="frm_td_byweeks">
                  <font color="#000000"><i>Seachtain na M�osa # <br>Le haghaidh roghanna �Uair Amh�in in aghaidh na Seachtaine� thuas</i></font></td>
                  <td align="left" valign="top" class="frm_td_byweeks">
                  <font color="#000000">
                  <table border="0" width="100%" height="100%">
                    <tr><td><b>Seachtain 1 :</b> An ch�ad seachtain den mh�</td></tr>
                    <tr><td><b>Seachtain 2 :</b> An dara seachtain den mh�</td></tr>
                    <tr><td><b>Seachtain 3 :</b> An tr�� seachtain den mh�</td></tr>
                    <tr><td><b>Seachtain 4 :</b> An ceathr� seachtain den mh�</td></tr>
                    <tr><td><b>Seachtain 5 :</b> An c�igi� seachtain den mh�</td></tr>
                   </table>
                 </font>
                </td>
              </tr>
              <tr>
                <td width="60" rowspan="2" align="left" valign="top"><u>D� r�ir M�osa</u></td>
                <td width="110" align="left" valign="top" class="frm_td_bymonth">
                  <font color="#000000">Uair amh�in in aghaidh na M�osa</font></td>
                <td align="left" valign="top" class="frm_td_bymonth">
                  <font color="#000000">
                     Cumasa�onn an rogha seo duit an L� den Mh� athdh�anta a roghn�
                     <table border="0" width="100%" height="100%"><tr><td><b>Uimhir lae</b> don chine�l athdh�anta gach 10/../2003</td></tr><tr><td><b>Ainm lae</b> don chine�l athdh�anta gach Luan</td></tr></table>

                  </font>
                </td>
              </tr>
              <tr>
                <td width="110" align="left" valign="top" class="frm_td_bymonth">
                  <font color="#000000">
                  Deireadh gach M�
                  </font>
                </td>
                <td align="left" valign="top" class="frm_td_bymonth">
                  <font color="#000000">
                                                       T� an teagmhas ar an l� deireanach gach m� go neamhsple�ch ar uimhir an lae,
                          m� thiteann an l� deireanach sin laistigh den raon d�ta sonraithe le D�ta T�is agus D�ta Deiridh an teagmhais.
                  </font>
                </td>
              </tr>
              <tr>
                <td width="60" rowspan="2" align="left" valign="top"><u>De r�ir Bliana</u></td>
                <td width="110" align="left" valign="top" class="frm_td_byyear">
                  <font color="#000000">
                  Uair amh�in in aghaigh na Bliana
                  </font>
                </td>
                <td align="left" valign="top" class="frm_td_byyear">
                  <font color="#000000">
                  Cumasa�onn an rogha seo duit l� aonair a roghn� gach bliain
                  <table border="0" width="100%" height="100%"><tr><td><b>Uimhir lae</b> don chine�l athdh�anta gach 10/../2003</td></tr><tr><td><b>Ainm lae</b> don chine�l athdh�anta gach Luan</td></tr></table>
                  </font>
                </td>
              </tr>
            </table>
          </td>
        </tr>
        <!-- END REPEAT -->
END
);

// translate combatibility constants and remove include file
include_once(dirname(__FILE__).'/compat15.php');

// compatibility constants
DEFINE("_CAL_LANG_WARNTITLE",	_E_WARNTITLE);
DEFINE("_CAL_LANG_WARNCAT",		_E_WARNCAT);
DEFINE("_CAL_LANG_STATE",		_E_STATE);
DEFINE("_CAL_LANG_HITS",		_E_HITS);
DEFINE("_CAL_LANG_CREATED",		_E_CREATED);
DEFINE("_CAL_LANG_LAST_MOD",	_E_LAST_MOD);
DEFINE("_CAL_LANG_EDIT",		_E_EDIT);
DEFINE("_CAL_LANG_SEARCH_TITLE",_SEARCH_TITLE);
DEFINE("_CAL_LANG_PRINT",		_CMN_PRINT);


?>