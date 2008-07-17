<?php
/**
 * Events Component for Joomla 1.0.x
 *
 * @version     $Id: irish-utf8.php 1047 2008-04-12 15:15:44Z tstahl $
 * @package     Events
 * @copyright   Copyright (C) 2006-2008 JEvents Project Group
 * @licence     http://www.gnu.org/copyleft/gpl.html
 * @link        http://forge.joomla.org/sf/projects/jevents
 * @translation John Duffy
 */

defined("_VALID_MOS") or die("Ní cheadaítear rochain díreach chuig an suíomh seo.");

//Check
DEFINE("_CAL_LANG_INCLUDED", 1);

// new 1.4.0 [mic]
define("_CAL_LANG_LNG", "ga"); // de|fr|etc... [ DO NOT CHANGE THIS VALUE! ]
define("_CAL_LANG_REPEAT_GRAMMAR","1"); // in repeat summary 1 = follow English word order, 2= follow German word order

// used for colorpicker
define("_CAL_LANG_NO_COLOR", "Dath ar bith");
define("_CAL_LANG_COLOR_PICKER", "Roghnóir na nDathanna");

// common
define("_CAL_LANG_TIME", "Am");
define("_CAL_LANG_CLICK_TO_OPEN_EVENT", "Cliceáil chun teagmhas a oscailt");
define("_CAL_LANG_UNPUBLISHED", "** Neamhfhoilsithe **");
define("_CAL_LANG_DESCRIPTION", "Cur Síos");
define("_CAL_LANG_EMAIL_TO_AUTHOR", "Cuir Ríomhphost chuig an Údar");
define("_CAL_LANG_MAIL_TO_ADMIN", "Chuir [ %s ] an Teagmhas isteach ó [ %s ]");
define("_CAL_LANG_KEYWORD_NOT_VALID", "Ní eochairfhocal bailí é seo");
define("_CAL_LANG_EVENT_CALENDAR", "Féilire Teagmhas");

// modul
define("_CAL_LANG_ERR_NO_MOD_CAL", "Féilire Teagmhas\n<br />Tá an chomhpháirt Teagmhas de dhíth ar an mhodúl seo");
define("_CAL_LANG_CLICK_TOSWITCH_DAY", "Téigh go dtí an féilire  an lá inniu");
define("_CAL_LANG_CLICK_TOSWITCH_MON", "Téigh go dtí an féilire  an mhí reatha");
define("_CAL_LANG_CLICK_TOSWITCH_YEAR", "Téigh go dtí an féilire  an bhliain reatha");
define("_CAL_LANG_CLICK_TOSWITCH_PY", "Téigh go dtí an féilire  an bhliain roimhe");
define("_CAL_LANG_CLICK_TOSWITCH_PM", "Téigh go dtí an féilire  an mhí roimhe");
define("_CAL_LANG_CLICK_TOSWITCH_NM", "Téigh go dtí an féilire  an chéad mhí eile");
define("_CAL_LANG_CLICK_TOSWITCH_NY", "Téigh go dtí an féilire  an chéad bhliain eile");

// navTableNext
define("_CAL_LANG_NAV_TN_FIRST_LIST", "An chéad liosta");
define("_CAL_LANG_NAV_TN_PREV_LIST", "An liosta roimhe");
define("_CAL_LANG_NAV_TN_NEXT_LIST", "An chéad liosta eile");
define("_CAL_LANG_NAV_TN_LAST_LIST", "An liosta deireanach");

// calendar monthly display
define("_CAL_LANG_FIRST_SINGLE_DAY_EVENT", "Teagmhas aonair");
define("_CAL_LANG_FIRST_DAY_OF_MULTIEVENT", "An chéad lá de theagmhas il-laethanta");
define("_CAL_LANG_LAST_DAY_OF_MULTIEVENT", "An lá deireanach de theagmhas il-laethanta");
define("_CAL_LANG_MULTIDAY_EVENT", "Teagmhas il-laethanta");
/* ++++++ end mic +++++++++++++ */

// Months
DEFINE("_CAL_LANG_JANUARY", "Eanáir");
DEFINE("_CAL_LANG_FEBRUARY", "Feabhra");
DEFINE("_CAL_LANG_MARCH", "Márta");
DEFINE("_CAL_LANG_APRIL", "Aibreán");
DEFINE("_CAL_LANG_MAY", "Bealtaine");
DEFINE("_CAL_LANG_JUNE", "Meitheamh");
DEFINE("_CAL_LANG_JULY", "Iúil");
DEFINE("_CAL_LANG_AUGUST", "Lúnasa");
DEFINE("_CAL_LANG_SEPTEMBER", "Meán Fómhair");
DEFINE("_CAL_LANG_OCTOBER", "Deireadh Fómhair");
DEFINE("_CAL_LANG_NOVEMBER", "Mí na Samhna");
DEFINE("_CAL_LANG_DECEMBER", "Mí na Nollag");

// Short day names
DEFINE("_CAL_LANG_SUN", "Dom");
DEFINE("_CAL_LANG_MON", "Lua");
DEFINE("_CAL_LANG_TUE", "Mhá");
DEFINE("_CAL_LANG_WED", "Céa");
DEFINE("_CAL_LANG_THU", "Déa");
DEFINE("_CAL_LANG_FRI", "Aoi");
DEFINE("_CAL_LANG_SAT", "Sat");

// Days
DEFINE("_CAL_LANG_SUNDAY", "Domhnach");
DEFINE("_CAL_LANG_MONDAY", "Luan");
DEFINE("_CAL_LANG_TUESDAY", "Mháirt");
DEFINE("_CAL_LANG_WEDNESDAY", "Céadaoin");
DEFINE("_CAL_LANG_THURSDAY", "Déardaoin");
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
DEFINE("_CAL_LANG_ALLDAYS", "Gach lá");
DEFINE("_CAL_LANG_EACHWEEK", "Gach seachtain");
DEFINE("_CAL_LANG_EACHWEEKPAIR", "Gach seachtain chothrom ");
DEFINE("_CAL_LANG_EACHWEEKIMPAIR", "Gach seachtain chorr");
DEFINE("_CAL_LANG_EACHMONTH", "Gach mí");
DEFINE("_CAL_LANG_EACHYEAR", "Gach bliain");
DEFINE("_CAL_LANG_ONLYDAYS", "Laethanta roghnaithe amháin");
DEFINE("_CAL_LANG_EACH", "Gach");
DEFINE("_CAL_LANG_EACHOF","as gach");
DEFINE("_CAL_LANG_ENDMONTH", "deireadh na míosa");

// Repeat days
DEFINE("_CAL_LANG_BYDAYNUMBER", "De réir uimhir lae");

// User type
DEFINE("_CAL_LANG_ANONYME", "Gan ainm");

// Post
//PAS D'ACCENTS DANS LES _ACT_
DEFINE("_CAL_LANG_ACT_ADDED", "Go raibh maith agat as dinchur - Breithneoidh muid ar do thairiscint!");
DEFINE("_CAL_LANG_ACT_MODIFIED", "Mionathraíodh an teagmhas seo.");
DEFINE("_CAL_LANG_ACT_PUBLISHED", "Foilsíodh an teagmhas seo.");
DEFINE("_CAL_LANG_ACT_DELETED", "Scriosadh an teagmhas seo!");
DEFINE("_CAL_LANG_NOPERMISSION", "Níl rochtain agat ar an tseirbhís seo!");

DEFINE("_CAL_LANG_MAIL_ADDED", "Aighneacht nua ar");
DEFINE("_CAL_LANG_MAIL_MODIFIED", "Mionathrú nua ar");

// Presentation
DEFINE("_CAL_LANG_BY", "Le");
DEFINE("_CAL_LANG_FROM", "Ó");
DEFINE("_CAL_LANG_TO", "go");
DEFINE("_CAL_LANG_ARCHIVE", "Cartlanna");
DEFINE("_CAL_LANG_WEEK", "an tseachtain");
DEFINE("_CAL_LANG_NO_EVENTS", "Teagmhas ar bith");
DEFINE("_CAL_LANG_NO_EVENTFOR", "Teagmhas ar bith do");
DEFINE("_CAL_LANG_NO_EVENTFORTHE", "Teagmhas ar bith don");
DEFINE("_CAL_LANG_THIS_DAY", "an lá inniu féin");
DEFINE("_CAL_LANG_THIS_MONTH", "An mhí seo");
DEFINE("_CAL_LANG_LAST_MONTH", "An mhí dheiridh");
DEFINE("_CAL_LANG_NEXT_MONTH", "An mhí seo chugainn");
DEFINE("_CAL_LANG_EVENTSFOR", "Teagmhais do");
DEFINE("_CAL_LANG_SEARCHRESULTS", "Torthaí Cuardaigh d'eochairfhocal"); // new 1.4
DEFINE("_CAL_LANG_EVENTSFORTHE", "Teagmhais don");
DEFINE("_CAL_LANG_REP_DAY", "lá");
DEFINE("_CAL_LANG_REP_WEEK", "seachtain");
DEFINE("_CAL_LANG_REP_WEEKPAIR", "Gach dara seachtain");
DEFINE("_CAL_LANG_REP_WEEKIMPAIR", "Gach tríú seachtain");
DEFINE("_CAL_LANG_REP_MONTH", "mí");
DEFINE("_CAL_LANG_REP_YEAR", "bliain");
DEFINE("_CAL_LANG_REP_NOEVENTSELECTED", "Roghnaigh teagmhas ar dtús");

// Navigation
DEFINE("_CAL_LANG_VIEWTODAY", "Féach an Lá inniu");
DEFINE("_CAL_LANG_VIEWTOCOME", "Ag teacht aníos an mhí seo");
DEFINE("_CAL_LANG_VIEWBYDAY", "Féach de réir lae");
DEFINE("_CAL_LANG_VIEWBYCAT", "Féach de réir catagóire");
DEFINE("_CAL_LANG_VIEWBYMONTH", "Féach de réir míosa");
DEFINE("_CAL_LANG_VIEWBYYEAR", "Féach de réir bliana");
DEFINE("_CAL_LANG_VIEWBYWEEK", "Féach de réir seachtaine");
DEFINE("_CAL_LANG_JUMPTO", "Léim go dtí mí éigin");
DEFINE("_CAL_LANG_BACK", "Ar Ais");
DEFINE("_CAL_LANG_CLOSE", "Dún");
DEFINE("_CAL_LANG_PREVIOUSDAY", "Bliana lá sin");
DEFINE("_CAL_LANG_PREVIOUSWEEK", "Bliana seachtain sin");
DEFINE("_CAL_LANG_PREVIOUSMONTH", "Bliana mí sin");
DEFINE("_CAL_LANG_PREVIOUSYEAR", "Bliana roimhe sin");
DEFINE("_CAL_LANG_NEXTDAY", "An lá seo chugainn");
DEFINE("_CAL_LANG_NEXTWEEK", "An tseachtain seo chugainn");
DEFINE("_CAL_LANG_NEXTMONTH", "An mhí seo chugainn");
DEFINE("_CAL_LANG_NEXTYEAR", "An bliain seo chugainn");

DEFINE("_CAL_LANG_ADMINPANEL", "Painéal Riarthóra");
DEFINE("_CAL_LANG_ADDEVENT", "Cuir teagmhas leis");
DEFINE("_CAL_LANG_MYEVENTS", "Mo theagmhais");
DEFINE("_CAL_LANG_DELETE", "Scrios");
DEFINE("_CAL_LANG_MODIFY", "Mionathraigh");

// Form
DEFINE("_CAL_LANG_HELP", "Cabhair");

DEFINE("_CAL_LANG_CAL_TITLE", "Imeacht");
DEFINE("_CAL_LANG_ADD_TITLE", "Cuir Leis");
DEFINE("_CAL_LANG_MODIFY_TITLE", "Mionathraigh");

DEFINE("_CAL_LANG_REPEAT_DISABLED", "Níl Athdhéanamh na dTeagmhas infheidhmithe muna dtagann an Dáta Deiridh i ndiaidh an Dáta Túis.  Athraigh an Dáta Deiridh sula gcumraí tú mionshonraí athdhéanamh na dteagmhas.");
DEFINE("_CAL_LANG_EVENT_TITLE", "Ábhar");
DEFINE("_CAL_LANG_EVENT_COLOR", "Dath");
DEFINE("_CAL_LANG_EVENT_CATCOLOR", "Úsáid Dath na Catagóire");
DEFINE("_CAL_LANG_EVENT_CATEGORY", "Catagóirí");
DEFINE("_CAL_LANG_EVENT_CHOOSE_CATEG", "Roghnaigh catagóir le do thoil");
DEFINE("_CAL_LANG_EVENT_ACTIVITY", "Gníomhaíocht");
DEFINE("_CAL_LANG_EVENT_URLMAIL_INFO", "Más mian leat URL a chur leis, scríobh <br><u>http://www.mysite.com</u> nó <u>mailto:my@mail.com</u> ");
DEFINE("_CAL_LANG_EVENT_ADRESSE", "Suíomh");
DEFINE("_CAL_LANG_EVENT_CONTACT", "Teagmháil");
DEFINE("_CAL_LANG_EVENT_EXTRA", "Eolas breise");
DEFINE("_CAL_LANG_EVENT_AUTHOR_ALIAS", "Údar (ailias)");
DEFINE("_CAL_LANG_EVENT_STARTDATE", "Dáta tosaigh");
DEFINE("_CAL_LANG_EVENT_ENDDATE", "Dáta deiridh");
DEFINE("_CAL_LANG_EVENT_STARTHOURS", "Uair an chloig tosaigh");
DEFINE("_CAL_LANG_EVENT_ENDHOURS", "Uair an chloig deiridh");
DEFINE("_CAL_LANG_EVENT_STARTTIME", "Am tosaigh");
DEFINE("_CAL_LANG_EVENT_ENDTIME", "Am deiridh");
DEFINE("_CAL_LANG_PUB_INFO", "Dáta foilsithe");
DEFINE("_CAL_LANG_EVENT_REPEATTYPE", "Cineál Athdhéanta");
DEFINE("_CAL_LANG_EVENT_REPEATDAY", "Lá athdhéanta");
DEFINE("_CAL_LANG_EVENT_CHOOSE_WEEKDAYS", "laethanta na seachtaine");
DEFINE("_CAL_LANG_EVENT_PER", "De réir");
DEFINE("_CAL_LANG_EVENT_WEEKOPT", "Seachtain(í) den mhí; cineál athdhéanta");

DEFINE("_CAL_LANG_SUBMITPREVIEW", "Réamhamharc");
DEFINE("_CAL_LANG_SUBMITCANCEL", "Cealaigh");
DEFINE("_CAL_LANG_SUBMITSAVE", "Sábháil");

DEFINE("_CAL_LANG_E_WARNWEEKS", "Roghnaigh seachtain le do thoil.");
DEFINE("_CAL_LANG_E_WARNDAYS", "Roghnaigh lá le do thoil.");

// Admin
DEFINE("_CAL_LANG_EVENT_ALLCAT", "Gach Catagóir");
DEFINE("_CAL_LANG_EVENT_ACCESSLEVEL", "Leibhéal Rochtana");
DEFINE("_CAL_LANG_EVENT_HITS", "Amais");
DEFINE("_CAL_LANG_EVENT_STATE", "Staid");
DEFINE("_CAL_LANG_EVENT_CREATED", "Cruthaithe");
DEFINE("_CAL_LANG_EVENT_NEWEVENT", "Imeacht Nua");
DEFINE("_CAL_LANG_EVENT_MODIFIED", "Athraithe");
DEFINE("_CAL_LANG_EVENT_NOTMODIFIED", "Gan mhionathrú");

// dmcd aug 22/04  new warning alert for no specified activity in event entry
DEFINE("_CAL_LANG_WARNACTIVITY", "Caithfidh go bhfuil\\ncur síos de chineál éigin iontráilte don Ghníomhaíocht");

DEFINE("_CAL_LEGEND_ALL_CATEGORIES", "Na Catagóirí Uilig ...");
DEFINE("_CAL_LEGEND_ALL_CATEGORIES_DESC", "Nocht teagmhais as na catagóirí uilig");

DEFINE("_CAL_LANG_FORM_HELP_COLOR", <<<END
        <tr>
                            <td width="110" align="left" valign="top">
            <b>Dath</b>
          </td>
          <td>Roghnaigh dath an chúlra a bheidh le feiceáil i radharc fhéilire míosa.  Má tá tic le ticbhosca na Catagóire,
                            socrófar an dath mar dhath na catagóire (socraithe ag an riatharthóir suímh) atá roghnaithe faoi fhoirm an táib Ábhar don teagmhas, agus
                            díchumasófar an cnaipe Roghnóir na nDathanna.</td>
        </tr>
END
);

DEFINE("_CAL_LANG_FORM_HELP",  <<<END
                 <tr>
          <td align="left"><b>Dáta</b></td>
          <td>Roghnaigh an Dáta Túis agus an Dáta Deiridh don teagmhas.</td>
        </tr>
                 <tr>
          <td align="left" valign="top"><b>Am</b></td>
          <td>Roghnaigh Am Lae do theagmhais.  Is é <span style='color:blue;font-weight:bold;'>uu:nn {am|pm}</span> an fhormáid.<br/>Is féidir an t-am a shonrú i bhformáid an chloig 12 uair nó i bhformáid an chloig 24 uair. <br/><br/><b><i><span style='color:red;'>(Nua)</span></i> Tabhair faoi deara</b> go dtarlaíonn cás speisialta do <span style='color:red;font-weight:bold;'>theagmhais aon-lae thar oíche</span>.  Mar shampla, má tá teagmhas aon-lae ann ag tosnú ar 19:00 agus ag críochniú ar 3:00, <b>NÍ MÓR</b> &nbsp;
                             gurb ionann an Dáta Túis agus an Dáta Deiridh, agus ba chóir go bhfuil siad socraithe mar aon leis an dáta comhfhreagrach leis an lá roimh mheán oíche.</td>
        </tr>
END
);

DEFINE("_CAL_LANG_FORM_HELP_EXTENDED",  <<<END
        <tr>
                   <td align="left" valign="top" nowrap><b>Cineál Athdhéanta</b></td>
                              <td colspan="2"></td>
                            </tr>
                            <tr>
                   <td colspan="2" align="left" valign="top">
                              <table width="100%" border="0" cellspacing="2">
              <tr>
                <td width="60" align="left" valign="top"><u>De réir Lae</u></td>
                <td width="110" align="left" valign="top" class="frm_td_bydays">
                  <font color="#000000">Gach Lá<br/><i>(default)</i></font>
                </td>
                <td align="left" valign="top" class="frm_td_bydays">
                  <font color="#000000">Roghnaigh an rogha seo do theagmhas aonair neamh-atharlaithe nó do theagmhas il-laethanta, le teagmhas nua ag tarlú ar gach lá laistigh de raon an Dáta Túis agus an Dáta Deiridh</font>
                </td>
              </tr>
              <tr>
                <td width="60" rowspan="3" align="left" valign="top"><u>De réir Seachtaine</u></td>
                <td width="110" align="left" valign="top" class="frm_td_byweeks">
                  <font color="#000000">
                    Uair Amháin in aghaidh na Seachtaine
                  </font>
                </td>
                <td align="left" valign="top" class="frm_td_byweeks">
                  <font color="#000000">
                  Cumasaíonn an rogha seo duit an lá den tseachtain athdhéanta a roghnú
                  <table border="0" width="100%" height="100%"><tr><td><b>Uimhir lae</b> don chineál athdhéanta gach 10/../2003</td></tr><tr><td><b>Ainm lae</b> don chineál athdhéanta gach Luan</td></tr></table>
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
                  <font color="#000000">Cumasaíonn an rogha seo duit na laethanta a roghnú a mbeidh do theagmhas le feiceáil orthu.</font>
                </td>
              </tr>
              <tr>
                <td width="110" align="left" valign="top" class="frm_td_byweeks">
                  <font color="#000000"><i>Seachtain na Míosa # <br>Le haghaidh roghanna Uair Amháin in aghaidh na Seachtaine thuas</i></font></td>
                  <td align="left" valign="top" class="frm_td_byweeks">
                  <font color="#000000">
                  <table border="0" width="100%" height="100%">
                    <tr><td><b>Seachtain 1 :</b> An chéad seachtain den mhí</td></tr>
                    <tr><td><b>Seachtain 2 :</b> An dara seachtain den mhí</td></tr>
                    <tr><td><b>Seachtain 3 :</b> An tríú seachtain den mhí</td></tr>
                    <tr><td><b>Seachtain 4 :</b> An ceathrú seachtain den mhí</td></tr>
                    <tr><td><b>Seachtain 5 :</b> An cúigiú seachtain den mhí</td></tr>
                   </table>
                 </font>
                </td>
              </tr>
              <tr>
                <td width="60" rowspan="2" align="left" valign="top"><u>Dé réir Míosa</u></td>
                <td width="110" align="left" valign="top" class="frm_td_bymonth">
                  <font color="#000000">Uair amháin in aghaidh na Míosa</font></td>
                <td align="left" valign="top" class="frm_td_bymonth">
                  <font color="#000000">
                     Cumasaíonn an rogha seo duit an Lá den Mhí athdhéanta a roghnú
                     <table border="0" width="100%" height="100%"><tr><td><b>Uimhir lae</b> don chineál athdhéanta gach 10/../2003</td></tr><tr><td><b>Ainm lae</b> don chineál athdhéanta gach Luan</td></tr></table>

                  </font>
                </td>
              </tr>
              <tr>
                <td width="110" align="left" valign="top" class="frm_td_bymonth">
                  <font color="#000000">
                  Deireadh gach Mí
                  </font>
                </td>
                <td align="left" valign="top" class="frm_td_bymonth">
                  <font color="#000000">
                                                       Tá an teagmhas ar an lá deireanach gach mí go neamhspleách ar uimhir an lae,
                          má thiteann an lá deireanach sin laistigh den raon dáta sonraithe le Dáta Túis agus Dáta Deiridh an teagmhais.
                  </font>
                </td>
              </tr>
              <tr>
                <td width="60" rowspan="2" align="left" valign="top"><u>De réir Bliana</u></td>
                <td width="110" align="left" valign="top" class="frm_td_byyear">
                  <font color="#000000">
                  Uair amháin in aghaigh na Bliana
                  </font>
                </td>
                <td align="left" valign="top" class="frm_td_byyear">
                  <font color="#000000">
                  Cumasaíonn an rogha seo duit lá aonair a roghnú gach bliain
                  <table border="0" width="100%" height="100%"><tr><td><b>Uimhir lae</b> don chineál athdhéanta gach 10/../2003</td></tr><tr><td><b>Ainm lae</b> don chineál athdhéanta gach Luan</td></tr></table>
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