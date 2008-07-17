<?php
/**
 * Events Component for Joomla 1.0.x
 *
 * @version     $Id: latvian.php 991 2008-03-10 19:55:48Z tstahl $
 * @package     Events
 * @copyright   Copyright (C) 2006-2008 JEvents Project Group
 * @licence     http://www.gnu.org/copyleft/gpl.html
 * @link        http://joomlacode.org/gf/project/jevents
 * @encoding    utf-8
 */
// Tulkotāji (Pievienojiet savus datus, ja izdariet kādas izmaiņas)
//Lemings 
// Ainārs

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

//Check
DEFINE("_CAL_LANG_INCLUDED", 1);

// new 1.4.0 [mic]
define("_CAL_LANG_LNG",				"en"); // de|fr|etc... [ DO NOT CHANGE THIS VALUE! ]
define("_CAL_LANG_REPEAT_GRAMMAR",	"1"); // in repeat summary 1 = follow English word orde, 2= follow German word orderr

// used for colorpicker
define("_CAL_LANG_NO_COLOR",			"Bez krāsas");
define("_CAL_LANG_COLOR_PICKER",		"Krāsas izvēle");

// common
define("_CAL_LANG_TIME",				"Laiks");
define("_CAL_LANG_CLICK_TO_OPEN_EVENT",	"Klikšķināt, lai atvērtu notikumu ");
define("_CAL_LANG_UNPUBLISHED",		"** Nepublicēts **");
define("_CAL_LANG_DESCRIPTION",		"Apraksts");
define("_CAL_LANG_EMAIL_TO_AUTHOR",	"Sūtīt e-pastu autoram");
define("_CAL_LANG_MAIL_TO_ADMIN",		"Notikums iesniegts no [ %s ] līdz [ %s ]");
define("_CAL_LANG_KEYWORD_NOT_VALID",	"Nederīgs atslēgas vārds");
define("_CAL_LANG_EVENT_CALENDAR",		"Notikumu Kalendārs"); // new 1.4

// modul
define("_CAL_LANG_ERR_NO_MOD_CAL",		"Notikumu kalendārs\n<br />Šim modulim nepieciešams Notikumu kalendāra komponents");
define("_CAL_LANG_CLICK_TOSWITCH_DAY",	"Iet uz kalendāru - pašreizējā diena");
define("_CAL_LANG_CLICK_TOSWITCH_MON",	"Iet uz kalendāru - pašreizējais mēnesis");
define("_CAL_LANG_CLICK_TOSWITCH_YEAR",	"Iet uz kalendāru - pašreizējais gads");
define("_CAL_LANG_CLICK_TOSWITCH_PY",	"Iet uz kalendāru - iepriekšējais gads");
define("_CAL_LANG_CLICK_TOSWITCH_PM",	"Iet uz kalendāru - iepriekšējais mēnesis");
define("_CAL_LANG_CLICK_TOSWITCH_NM",	"Iet uz kalendāru - nākošais mēnesis");
define("_CAL_LANG_CLICK_TOSWITCH_NY",	"Iet uz kalendāru - nākošais gads");

// navTableNext
define("_CAL_LANG_NAV_TN_FIRST_LIST",	"pirmais saraksts");
define("_CAL_LANG_NAV_TN_PREV_LIST",	"iepriekšējais saraksts");
define("_CAL_LANG_NAV_TN_NEXT_LIST",	"nākošais saraksts");
define("_CAL_LANG_NAV_TN_LAST_LIST",	"gala saraksts");

// calendar monthly display
define("_CAL_LANG_FIRST_SINGLE_DAY_EVENT",		"Atsevišķs notikums");
define("_CAL_LANG_FIRST_DAY_OF_MULTIEVENT",	"Daudzdienu notikuma pirmā diena");
define("_CAL_LANG_LAST_DAY_OF_MULTIEVENT",		"Daudzdienu notikuma pēdējā diena");
define("_CAL_LANG_MULTIDAY_EVENT",				"Daudzdienu notikums");
/* ++++++ end mic +++++++++++++ */

// Months
DEFINE("_CAL_LANG_JANUARY", "Janvāris");
DEFINE("_CAL_LANG_FEBRUARY", "Februāris");
DEFINE("_CAL_LANG_MARCH", "Marts");
DEFINE("_CAL_LANG_APRIL", "Aprīlis");
DEFINE("_CAL_LANG_MAY", "Maijs");
DEFINE("_CAL_LANG_JUNE", "Jūnijs");
DEFINE("_CAL_LANG_JULY", "Jūlijs");
DEFINE("_CAL_LANG_AUGUST", "Augusts");
DEFINE("_CAL_LANG_SEPTEMBER", "Septembris");
DEFINE("_CAL_LANG_OCTOBER", "Oktobris");
DEFINE("_CAL_LANG_NOVEMBER", "Novembris");
DEFINE("_CAL_LANG_DECEMBER", "Decembris");

// Short day names
DEFINE("_CAL_LANG_SUN", "Svētd");
DEFINE("_CAL_LANG_MON", "Pirmd");
DEFINE("_CAL_LANG_TUE", "Otrd");
DEFINE("_CAL_LANG_WED", "Trešd");
DEFINE("_CAL_LANG_THU", "Ceturtd");
DEFINE("_CAL_LANG_FRI", "Piektd");
DEFINE("_CAL_LANG_SAT", "Sestd");

// Days
DEFINE("_CAL_LANG_SUNDAY", "Svētdiena");
DEFINE("_CAL_LANG_MONDAY", "Pirmdiena");
DEFINE("_CAL_LANG_TUESDAY", "Otrdiena");
DEFINE("_CAL_LANG_WEDNESDAY", "Trešdiena");
DEFINE("_CAL_LANG_THURSDAY", "Ceturtdiena");
DEFINE("_CAL_LANG_FRIDAY", "Piektdiena");
DEFINE("_CAL_LANG_SATURDAY", "Sestdiena");

// Days lettres
DEFINE("_CAL_LANG_SUNDAYSHORT", "S");
DEFINE("_CAL_LANG_MONDAYSHORT", "P");
DEFINE("_CAL_LANG_TUESDAYSHORT", "O");
DEFINE("_CAL_LANG_WEDNESDAYSHORT", "T");
DEFINE("_CAL_LANG_THURSDAYSHORT", "C");
DEFINE("_CAL_LANG_FRIDAYSHORT", "P");
DEFINE("_CAL_LANG_SATURDAYSHORT", "S");

// Repeat type
DEFINE("_CAL_LANG_ALLDAYS", "Katru dienu");
DEFINE("_CAL_LANG_EACHWEEK", "Katru nedēļu");
DEFINE("_CAL_LANG_EACHWEEKPAIR", "Katru nepāra nedēļu");
DEFINE("_CAL_LANG_EACHWEEKIMPAIR", "Katru pāra nedēļu");
DEFINE("_CAL_LANG_EACHMONTH", "Katru mēnesi");
DEFINE("_CAL_LANG_EACHYEAR", "Katru gadu");
DEFINE("_CAL_LANG_ONLYDAYS", "Tikai izvēlētās dienās");
DEFINE("_CAL_LANG_EACH", "Katru");
DEFINE("_CAL_LANG_EACHOF","no katras");
DEFINE("_CAL_LANG_ENDMONTH", "līdz mēneša beigām");

// Repeat days
DEFINE("_CAL_LANG_BYDAYNUMBER", "Pēc datuma");

// User type
DEFINE("_CAL_LANG_ANONYME", "Svešais");

// Post
//PAS D'ACCENTS DANS LES _ACT_
DEFINE("_CAL_LANG_ACT_ADDED", "Paldies, par Jūsu priekšlikumu - mēs to pārbaudīsim un publicēsim!"); //NO ACCENT !!
DEFINE("_CAL_LANG_ACT_MODIFIED", "Informācija par notikumu ir atjaunota."); //NO ACCENT !!
DEFINE("_CAL_LANG_ACT_PUBLISHED", "Šis notikums ir publicēts.");  //NEW 1.4
DEFINE("_CAL_LANG_ACT_DELETED", "Informācija par notikumu ir izdzēsta!"); //NO ACCENT !!
DEFINE("_CAL_LANG_NOPERMISSION", "Šī iespēja Jums nav pieejama!"); //NO ACCENT !!

DEFINE("_CAL_LANG_MAIL_ADDED", "Jauni notikumi");
DEFINE("_CAL_LANG_MAIL_MODIFIED", "Pēdējās izmaiņas");

// Presentation
DEFINE("_CAL_LANG_BY", "no"); 
DEFINE("_CAL_LANG_FROM", "No"); 
DEFINE("_CAL_LANG_TO", "Līdz"); 
DEFINE("_CAL_LANG_ARCHIVE", "Arhīvs"); 
DEFINE("_CAL_LANG_WEEK", "nedēļa"); 
DEFINE("_CAL_LANG_NO_EVENTS", "Nav ierakstu par notikumiem");
DEFINE("_CAL_LANG_NO_EVENTFOR", "Nav notikumu");
DEFINE("_CAL_LANG_NO_EVENTFORTHE", "Nav notikumu");
DEFINE("_CAL_LANG_THIS_DAY", "šodien");
DEFINE("_CAL_LANG_THIS_MONTH", "Mēneša notikumi");
DEFINE("_CAL_LANG_LAST_MONTH", "Pagājušais mēnesis");
DEFINE("_CAL_LANG_NEXT_MONTH", "Nākamais mēnesis");
DEFINE("_CAL_LANG_EVENTSFOR", "Notikumi");
DEFINE("_CAL_LANG_SEARCHRESULTS", "Meklēšanas rezultāti"); // new 1.4
DEFINE("_CAL_LANG_EVENTSFORTHE", "Notikumi");
DEFINE("_CAL_LANG_REP_DAY", "dienā");
DEFINE("_CAL_LANG_REP_WEEK", "nedēļā");
DEFINE("_CAL_LANG_REP_WEEKPAIR", "citā nedēļā");
DEFINE("_CAL_LANG_REP_WEEKIMPAIR", "katrā trešajā nedēļā");
DEFINE("_CAL_LANG_REP_MONTH", "mēnesī");
DEFINE("_CAL_LANG_REP_YEAR", "gadā");
DEFINE("_CAL_LANG_REP_NOEVENTSELECTED", "Sākumā jāizvēlas notikums");

// Navigation
DEFINE("_CAL_LANG_VIEWTODAY", "Šodiena");
DEFINE("_CAL_LANG_VIEWTOCOME", "Šomēnes gaidāmie");
DEFINE("_CAL_LANG_VIEWBYDAY", "Dienas skatījums");
DEFINE("_CAL_LANG_VIEWBYCAT", "Kategorijas skatījums");
DEFINE("_CAL_LANG_VIEWBYMONTH", "Mēneša skatījums");
DEFINE("_CAL_LANG_VIEWBYYEAR", "Gada skatījums");
DEFINE("_CAL_LANG_VIEWBYWEEK", "Nedēļas skatījums");
DEFINE("_CAL_LANG_JUMPTO", "Izvēlēties mēnesi");  // New 1.4
DEFINE("_CAL_LANG_BACK", "Atpakaļ");
DEFINE("_CAL_LANG_CLOSE", "Aizvērt");
DEFINE("_CAL_LANG_PREVIOUSDAY", "Diena iepriekš");
DEFINE("_CAL_LANG_PREVIOUSWEEK", "Nedēļa iepriekš");
DEFINE("_CAL_LANG_PREVIOUSMONTH", "Mēnesis iepriekš");
DEFINE("_CAL_LANG_PREVIOUSYEAR", "Gads iepriekš");
DEFINE("_CAL_LANG_NEXTDAY", "Diena uz priekšu");
DEFINE("_CAL_LANG_NEXTWEEK", "Nedēļa uz priekšu");
DEFINE("_CAL_LANG_NEXTMONTH", "Mēnesis uz priekšu");
DEFINE("_CAL_LANG_NEXTYEAR", "Gads uz priekšu");

DEFINE("_CAL_LANG_ADMINPANEL", "Pārvalde");
DEFINE("_CAL_LANG_ADDEVENT", "Pievienot notikumu");
DEFINE("_CAL_LANG_MYEVENTS", "Mani notikumi");
DEFINE("_CAL_LANG_DELETE", "Dzēst");
DEFINE("_CAL_LANG_MODIFY", "Labot");

// Form
DEFINE("_CAL_LANG_HELP", "Palīdzība");

DEFINE("_CAL_LANG_CAL_TITLE", "Notikumi");
DEFINE("_CAL_LANG_ADD_TITLE", "Pievienot");
DEFINE("_CAL_LANG_MODIFY_TITLE", "Labot");

DEFINE("_CAL_LANG_REPEAT_DISABLED", "Event Repeating is only applicable if End Date is after Start Date.  Change End Date before configuring event repeat details."); // New for 1.4
DEFINE("_CAL_LANG_EVENT_TITLE", "Nosaukums");
DEFINE("_CAL_LANG_EVENT_COLOR", "Krāsa");
DEFINE("_CAL_LANG_EVENT_CATCOLOR", "Tāda pati, kā kategorijas krāsa");
DEFINE("_CAL_LANG_EVENT_CATEGORY", "Kategorijas");
DEFINE("_CAL_LANG_EVENT_CHOOSE_CATEG", "Izvēlieties kategoriju");
DEFINE("_CAL_LANG_EVENT_ACTIVITY", "Darbība");
DEFINE("_CAL_LANG_EVENT_URLMAIL_INFO", "Lai pievienotu www vai e-pasta adresi, rakstiet <br><u>http://www.manalapa.lv</u> vai <u>mailto:es@mans_epasts.lv</u>");
DEFINE("_CAL_LANG_EVENT_ADRESSE", "Norises vieta");
DEFINE("_CAL_LANG_EVENT_CONTACT", "Kontaktinformācija");
DEFINE("_CAL_LANG_EVENT_EXTRA", "Papildus ziņas");
DEFINE("_CAL_LANG_EVENT_AUTHOR_ALIAS", "Autors (pseidonīms)");
DEFINE("_CAL_LANG_EVENT_STARTDATE", "Sākuma datums");
DEFINE("_CAL_LANG_EVENT_ENDDATE", "Beigu datums");
DEFINE("_CAL_LANG_EVENT_STARTHOURS", "Sākuma laiks");
DEFINE("_CAL_LANG_EVENT_ENDHOURS", "Beigu laiks");
DEFINE("_CAL_LANG_EVENT_STARTTIME", "Sākuma laiks");
DEFINE("_CAL_LANG_EVENT_ENDTIME", "Beigu laiks");
DEFINE("_CAL_LANG_PUB_INFO", "Publicēt");
DEFINE("_CAL_LANG_EVENT_REPEATTYPE", "Atkārtošanas tips");
DEFINE("_CAL_LANG_EVENT_REPEATDAY", "Atkārtot dienu");
DEFINE("_CAL_LANG_EVENT_CHOOSE_WEEKDAYS", "Dienas nedēļās");
DEFINE("_CAL_LANG_EVENT_PER", "");
DEFINE("_CAL_LANG_EVENT_WEEKOPT", "Week(s) of a month repeat type week");

DEFINE("_CAL_LANG_SUBMITPREVIEW", "Priekšapskatīt");
DEFINE("_CAL_LANG_SUBMITCANCEL", "Atcelt");
DEFINE("_CAL_LANG_SUBMITSAVE", "Saglabāt");

DEFINE("_CAL_LANG_E_WARNWEEKS", "Izvēlieties nedēļu.");
DEFINE("_CAL_LANG_E_WARNDAYS", "Izvēlieties dienu.");

// Admin
DEFINE("_CAL_LANG_EVENT_ALLCAT", "Visas kategorijas");
DEFINE("_CAL_LANG_EVENT_ACCESSLEVEL", "Pieejas līmenis");
DEFINE("_CAL_LANG_EVENT_HITS", "Apskatīts");
DEFINE("_CAL_LANG_EVENT_STATE", "Statuss");
DEFINE("_CAL_LANG_EVENT_CREATED", "Izveidots");
DEFINE("_CAL_LANG_EVENT_NEWEVENT", "Jauns notikums");
DEFINE("_CAL_LANG_EVENT_MODIFIED", "Informācija ir izlabota");
DEFINE("_CAL_LANG_EVENT_NOTMODIFIED", "Informācija nav izlabota");

// dmcd aug 22/04  new warning alert for no specified activity in event entry
DEFINE("_CAL_LANG_WARNACTIVITY", "Kaut kādai informācijai jābūt arī par darbību\\n un īsam aprakstam.");
 
DEFINE("_CAL_LEGEND_ALL_CATEGORIES", "Visas kategorijas ...");  // new for 1.4
DEFINE("_CAL_LEGEND_ALL_CATEGORIES_DESC", "Rādīt notikumus visās kategorijās");  // new for 1.4
	
DEFINE("_CAL_LANG_FORM_HELP_COLOR", <<<END
        <tr>
		  <td width="110" align="left" valign="top">
            <b>Krāsa</b>
          </td>
          <td>Izvēlieties mēneša skatījuma fona krāsu. Ja kategorijas izvēles rūtiņa ir aktivizēta, tad fona krāsa būs tāda pati, kā kategorijai, kā to ir definējusi administrācija. Šo iespēju var izvēlēties satura ciļņa formā, rediģējot informāciju par notikumu. Šajā gadījumā poga 'Krāsu palete' nedarbosies.</td>
        </tr>
END
);

DEFINE("_CAL_LANG_FORM_HELP",  <<<END
    	<tr>
          <td align="left"><b>Datums</b></td>
          <td>Izvēlies notikuma sākuma un beigu datumu.</td>
        </tr>
    	<tr>
          <td align="left" valign="top"><b>Laiks</b></td>
          <td>Izvēlieties notikuma norises laiku. Laika formāts <span style='color:green;font-weight:bold;'>hh:mm {am|pm}</span>.<br/>Laiks var būt pierakstīts gan 12 gan 24 stundu formātā.<br/><br/><b><i><span style='color:red;'>(Jaunums)</span></i> Uzmanību</b> gadījumā, ja <span style='color:red;font-weight:bold;'> notikums notiek vienu dienu un beidzas pēc pusnakts. </span> Piemēram notikums sākas 19:00 un beidzas 3:00, sākuma un beigu datumiem <b>jābūt</b> vienādiem, un diena jāizvēlas tā, kas bija pirms pusnakts.</td>
        </tr>
END
);

DEFINE("_CAL_LANG_FORM_HELP_EXTENDED",  <<<END
        <tr>
    	  <td align="left" valign="top" nowrap><b>Atkārtošanas veids</b></td>
  	  	<td colspan="2"></td>
  		</tr>
  		<tr>
    	  <td colspan="2" align="left" valign="top">
	    	<table width="100%" border="0" cellspacing="2">
              <tr>
                <td width="60" align="left" valign="top"><u>Dienas</u></td>
                <td width="110" align="left" valign="top" class="frm_td_bydays">
                  <font color="#000000">Katru dienu<br/><i>(noklusētais)</i></font>
                </td>
                <td align="left" valign="top" class="frm_td_bydays">
                  <font color="#000000">Izvēlieties šo iespēju, ja publicējiet vienas vai vairāku dienu vienreizējus notikumus. Notikums tiks parādīts katru dienu intervālā no sākuma līdz beigu dienai.</font>
                </td>
              </tr>
              <tr>
                <td width="60" rowspan="3" align="left" valign="top"><u>Nedēļas</u></td>
                <td width="110" align="left" valign="top" class="frm_td_byweeks">
                  <font color="#000000">
                    Reizi nedēļā
                  </font>
                </td>
                <td align="left" valign="top" class="frm_td_byweeks">
                  <font color="#000000">
                  Izvēloties šo iespēju notikums tiks atkārtots noteiktā nedēļas dienā.
                  <table border="0" width="100%" height="100%"><tr><td><b>Day number</b> for repeat type each 10/../2003</td></tr><tr><td><b>Day name</b> for repeat type each Monday</td></tr></table>
                  </font>
                </td>
              </tr>
              <tr>
                <td width="110" align="left" valign="top" class="frm_td_byweeks">
                  <font color="#000000">
                    Vairākas dienas nedēļā
                  </font>
                </td>
                <td align="left" valign="top" class="frm_td_byweeks">
                  <font color="#000000">Šī iespēja atļauj izvēlēties kurā nedēļas dienā jūsu notikums būs redzams.</font>
                </td>
              </tr>
              <tr>
                <td width="110" align="left" valign="top" class="frm_td_byweeks">
                  <font color="#000000"><i>Week of Month # <br>For 'Once per Week' and 'Multiple Days Per Week' options above</i></font></td>
                  <td align="left" valign="top" class="frm_td_byweeks">
                  <font color="#000000">
                  <table border="0" width="100%" height="100%">
                    <tr><td><b>1. nedēļa :</b> mēneša pirmā nedēļa</td></tr>
                    <tr><td><b>2. nedēļa :</b> mēneša otrā nedēļa</td></tr>
                    <tr><td><b>3. nedēļa :</b> mēneša trešā nedēļa</td></tr>
                    <tr><td><b>4. nedēļa :</b> mēneša ceturtā nedēļa</td></tr>
                    <tr><td><b>5. nedēļa :</b> mēneša piektā nedēļa (ja piemērojama)</td></tr>
                   </table>
                 </font>
                </td>
              </tr>
              <tr>
                <td width="60" rowspan="2" align="left" valign="top"><u>By Month</u></td>
                <td width="110" align="left" valign="top" class="frm_td_bymonth">
                  <font color="#000000">Vienreiz mēnesī</font></td>
                <td align="left" valign="top" class="frm_td_bymonth">
                  <font color="#000000">
                     Šī iespēja ļauj izvēlēties Mēneša atkārtošanās dienu
                     <table border="0" width="100%" height="100%"><tr><td><b>Dienas numurs</b> for repeat type each 10/../2003</td></tr><tr><td><b>Day name</b> for repeat type each Monday</td></tr></table>

                  </font>
                </td>
              </tr>
              <tr>
                <td width="110" align="left" valign="top" class="frm_td_bymonth">
                  <font color="#000000">
                  Katra mēneša beigas
                  </font>
                </td>
                <td align="left" valign="top" class="frm_td_bymonth">
                  <font color="#000000">
				   Notikums ir katra mēneša pēdējā dienā neatkarīgi no katra mēneša dienu skaita, ja pēdējā diena iekrīt noteiktajā notikuma sākuma un beigu datuma diapazonā.
                  </font>
                </td>
              </tr>
              <tr>
                <td width="60" rowspan="2" align="left" valign="top"><u>By Year</u></td>
                <td width="110" align="left" valign="top" class="frm_td_byyear">
                  <font color="#000000">
                  Vienreiz gadā
                  </font>
                </td>
                <td align="left" valign="top" class="frm_td_byyear">
                  <font color="#000000">
                  Šī iespēja ļauj izvēlēties vienu dienu gadā.
                  <table border="0" width="100%" height="100%"><tr><td><b>Day number</b> for repeat type each 10/../2003</td></tr><tr><td><b>Day name</b> for repeat type each Monday</td></tr></table>
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