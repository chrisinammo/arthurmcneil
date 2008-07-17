<?php
/**
 * Events Component for Joomla 1.0.x
 *
 * @version     $Id: hungarian.php 897 2007-11-17 15:32:11Z tstahl $
 * @package     Events
 * @copyright   Copyright (C) 2006 JEvents Project Group
 * @licence     http://www.gnu.org/copyleft/gpl.html
 * @link        http://joomlacode.org/gf/project/jevents
 * @translation           Jozsef Tamas Herczeg, www.joomlandia.eu
 * @translation license   http://creativecommons.org/licenses/by-nc-nd/2.5/
 */

defined("_VALID_MOS") or die("A k�zvetlen hozz�f�r�s ehhez a helyhez nem enged�lyezett");

//Check
DEFINE("_CAL_LANG_INCLUDED", 1);

// new 1.4.0 [mic]
define("_CAL_LANG_LNG",				"hu"); // de|fr|etc... [ DO NOT CHANGE THIS VALUE! ]

// used for colorpicker
define("_CAL_LANG_NO_COLOR",			"Nincs sz�n");
define("_CAL_LANG_COLOR_PICKER",		"Sz�nv�laszt�");

// common
define("_CAL_LANG_TIME",				"Id�pont");
define("_CAL_LANG_CLICK_TO_OPEN_EVENT",	"Kattintson ide az esem�ny megnyit�s�hoz");
define("_CAL_LANG_UNPUBLISHED",		"** Visszavonva **");
define("_CAL_LANG_DESCRIPTION",		"Le�r�s");
define("_CAL_LANG_EMAIL_TO_AUTHOR",	"Email a szerz�nek");
define("_CAL_LANG_MAIL_TO_ADMIN",		"Esem�ny �rkezett a(z) [ %s ] weblapr�l, bek�ldte: [ %s ]");
define("_CAL_LANG_KEYWORD_NOT_VALID",	"Nem �rv�nyes kulcssz�");
define("_CAL_LANG_EVENT_CALENDAR",		"Esem�nynapt�r"); // new 1.4

// modul
define("_CAL_LANG_ERR_NO_MOD_CAL",		"Esem�nynapt�r\n<br />Ehhez a modulhoz az Events komponensre van sz�ks�g");
define("_CAL_LANG_CLICK_TOSWITCH_DAY",	"Ugr�s a napt�rban ide - kijel�lt nap");
define("_CAL_LANG_CLICK_TOSWITCH_MON",	"Ugr�s a napt�rban ide - jelenlegi h�nap");
define("_CAL_LANG_CLICK_TOSWITCH_YEAR",	"Ugr�s a napt�rban ide - idei �v");
define("_CAL_LANG_CLICK_TOSWITCH_PY",	"Ugr�s a napt�rban ide - m�lt �v");
define("_CAL_LANG_CLICK_TOSWITCH_PM",	"Ugr�s a napt�rban ide - m�lt h�nap");
define("_CAL_LANG_CLICK_TOSWITCH_NM",	"Ugr�s a napt�rban ide - k�vetkez� h�nap");
define("_CAL_LANG_CLICK_TOSWITCH_NY",	"Ugr�s a napt�rban ide - k�vetkez� �v");

// navTableNext
define("_CAL_LANG_NAV_TN_FIRST_LIST",	"els� lista");
define("_CAL_LANG_NAV_TN_PREV_LIST",	"utols� lista");
define("_CAL_LANG_NAV_TN_NEXT_LIST",	"k�vetkez� lista");
define("_CAL_LANG_NAV_TN_LAST_LIST",	"utols� lista");

// calendar monthly display
define("_CAL_LANG_FIRST_SINGLE_DAY_EVENT",		"Egyszeri esem�ny");
define("_CAL_LANG_FIRST_DAY_OF_MULTIEVENT",	"Egy t�bbnapos esem�ny els� napja");
define("_CAL_LANG_LAST_DAY_OF_MULTIEVENT",		"Egy t�bbnapos esem�ny utols� napja");
define("_CAL_LANG_MULTIDAY_EVENT",				"T�bbnapos esem�ny");
/* ++++++ end mic +++++++++++++ */

// Months
DEFINE("_CAL_LANG_JANUARY", "Janu�r");
DEFINE("_CAL_LANG_FEBRUARY", "Febru�r");
DEFINE("_CAL_LANG_MARCH", "M�rcius");
DEFINE("_CAL_LANG_APRIL", "�prilis");
DEFINE("_CAL_LANG_MAY", "M�jus");
DEFINE("_CAL_LANG_JUNE", "J�nius");
DEFINE("_CAL_LANG_JULY", "J�lius");
DEFINE("_CAL_LANG_AUGUST", "Augusztus");
DEFINE("_CAL_LANG_SEPTEMBER", "Szeptember");
DEFINE("_CAL_LANG_OCTOBER", "Okt�ber");
DEFINE("_CAL_LANG_NOVEMBER", "November");
DEFINE("_CAL_LANG_DECEMBER", "December");

// Short day names
DEFINE("_CAL_LANG_SUN", "Vas");
DEFINE("_CAL_LANG_MON", "H�t");
DEFINE("_CAL_LANG_TUE", "Ked");
DEFINE("_CAL_LANG_WED", "Sze");
DEFINE("_CAL_LANG_THU", "Cs�");
DEFINE("_CAL_LANG_FRI", "P�n");
DEFINE("_CAL_LANG_SAT", "Szo");

// Days
DEFINE("_CAL_LANG_SUNDAY", "Vas�rnap");
DEFINE("_CAL_LANG_MONDAY", "H�tf�");
DEFINE("_CAL_LANG_TUESDAY", "Kedd");
DEFINE("_CAL_LANG_WEDNESDAY", "Szerda");
DEFINE("_CAL_LANG_THURSDAY", "Cs�t�rt�k");
DEFINE("_CAL_LANG_FRIDAY", "P�ntek");
DEFINE("_CAL_LANG_SATURDAY", "Szombat");

// Days lettres
DEFINE("_CAL_LANG_SUNDAYSHORT", "V");
DEFINE("_CAL_LANG_MONDAYSHORT", "H");
DEFINE("_CAL_LANG_TUESDAYSHORT", "K");
DEFINE("_CAL_LANG_WEDNESDAYSHORT", "S");
DEFINE("_CAL_LANG_THURSDAYSHORT", "K");
DEFINE("_CAL_LANG_FRIDAYSHORT", "P");
DEFINE("_CAL_LANG_SATURDAYSHORT", "V");

// Repeat type
DEFINE("_CAL_LANG_ALLDAYS", "Naponta");
DEFINE("_CAL_LANG_EACHWEEK", "Hetente");
DEFINE("_CAL_LANG_EACHWEEKPAIR", "P�ros heteken");
DEFINE("_CAL_LANG_EACHWEEKIMPAIR", "P�ratlan heteken");
DEFINE("_CAL_LANG_EACHMONTH", "Havonta");
DEFINE("_CAL_LANG_EACHYEAR", "�vente");
DEFINE("_CAL_LANG_ONLYDAYS", "Csak a megadott napon");
DEFINE("_CAL_LANG_EACH", "Minden");
DEFINE("_CAL_LANG_EACHOF","of each");
DEFINE("_CAL_LANG_ENDMONTH", "h�nap v�g�n");

// Repeat days
DEFINE("_CAL_LANG_BYDAYNUMBER", "A nap sorsz�ma szerint");

// User type
DEFINE("_CAL_LANG_ANONYME", "N�vtelen");

// Post
//PAS D'ACCENTS DANS LES _ACT_
DEFINE("_CAL_LANG_ACT_ADDED", "K�sz�nj�k a bejegyz�s�t - Javaslat�t r�videsen ellen�rizni fogjuk!"); //NO ACCENT !!
DEFINE("_CAL_LANG_ACT_MODIFIED", "Ez az esem�ny megv�ltozott."); //NO ACCENT !!
DEFINE("_CAL_LANG_ACT_PUBLISHED", "Ez az esem�ny k�zz�t�telre ker�lt.");  //NEW 1.4
DEFINE("_CAL_LANG_ACT_DELETED", "Az esem�ny t�rl�se megt�rt�nt!"); //NO ACCENT !!
DEFINE("_CAL_LANG_NOPERMISSION", "Eme szolg�ltat�shoz val� hozz�f�r�s az �n sz�m�ra nem enged�lyezett!"); //NO ACCENT !!

DEFINE("_CAL_LANG_MAIL_ADDED", "�j bejegyz�s");
DEFINE("_CAL_LANG_MAIL_MODIFIED", "�j m�dos�t�s");

// Presentation
DEFINE("_CAL_LANG_BY", "Be�rta:");
DEFINE("_CAL_LANG_FROM", "Mett�l");
DEFINE("_CAL_LANG_TO", "Meddig");
DEFINE("_CAL_LANG_ARCHIVE", "Arch�vumok");
DEFINE("_CAL_LANG_WEEK", "a h�t");
DEFINE("_CAL_LANG_NO_EVENTS", "Nincs esem�ny");
DEFINE("_CAL_LANG_NO_EVENTFOR", "Nincs tal�lat a k�vetkez� kulcssz�ra:");
DEFINE("_CAL_LANG_NO_EVENTFORTHE", "Nincs esem�ny");
DEFINE("_CAL_LANG_THIS_DAY", "ma");
DEFINE("_CAL_LANG_THIS_MONTH", "E h�nap");
DEFINE("_CAL_LANG_LAST_MONTH", "Utols� h�nap");
DEFINE("_CAL_LANG_NEXT_MONTH", "K�vetkez� h�nap");
DEFINE("_CAL_LANG_EVENTSFOR", "Esem�nyek");
DEFINE("_CAL_LANG_SEARCHRESULTS", "A kulcssz� keres�s�nek eredm�nye"); // new 1.4
DEFINE("_CAL_LANG_EVENTSFORTHE", "Esem�nyek");
DEFINE("_CAL_LANG_REP_DAY", "naponta");
DEFINE("_CAL_LANG_REP_WEEK", "hetente");
DEFINE("_CAL_LANG_REP_WEEKPAIR", "minden 2. h�ten");
DEFINE("_CAL_LANG_REP_WEEKIMPAIR", "minden 3. h�ten");
DEFINE("_CAL_LANG_REP_MONTH", "havonta");
DEFINE("_CAL_LANG_REP_YEAR", "�vente");
DEFINE("_CAL_LANG_REP_NOEVENTSELECTED", "K�rj�k, hogy el�bb v�lassza ki az esem�nyt");

// Navigation
DEFINE("_CAL_LANG_VIEWTODAY", "Ma");
DEFINE("_CAL_LANG_VIEWTOCOME", "E h�napban esed�kes");
DEFINE("_CAL_LANG_VIEWBYDAY", "Napi");
DEFINE("_CAL_LANG_VIEWBYCAT", "Kateg�ri�nk�nt");
DEFINE("_CAL_LANG_VIEWBYMONTH", "Havi");
DEFINE("_CAL_LANG_VIEWBYYEAR", "�ves");
DEFINE("_CAL_LANG_VIEWBYWEEK", "Heti");
DEFINE("_CAL_LANG_JUMPTO", "Ugr�s h�naphoz");  // New 1.4
DEFINE("_CAL_LANG_BACK", "Vissza");
DEFINE("_CAL_LANG_CLOSE", "Bez�r�s");
DEFINE("_CAL_LANG_PREVIOUSDAY", "El�z� nap");
DEFINE("_CAL_LANG_PREVIOUSWEEK", "El�z� h�t");
DEFINE("_CAL_LANG_PREVIOUSMONTH", "El�z� h�nap");
DEFINE("_CAL_LANG_PREVIOUSYEAR", "El�z� �v");
DEFINE("_CAL_LANG_NEXTDAY", "K�vetkez� nap");
DEFINE("_CAL_LANG_NEXTWEEK", "K�vetkez� h�t");
DEFINE("_CAL_LANG_NEXTMONTH", "K�vetkez� h�nap");
DEFINE("_CAL_LANG_NEXTYEAR", "K�vetkez� �v");

DEFINE("_CAL_LANG_ADMINPANEL", "Kezel�panel");
DEFINE("_CAL_LANG_ADDEVENT", "�j esem�ny");
DEFINE("_CAL_LANG_MYEVENTS", "Esem�nyeim");
DEFINE("_CAL_LANG_DELETE", "T�rl�s");
DEFINE("_CAL_LANG_MODIFY", "M�dos�t�s");

// Form
DEFINE("_CAL_LANG_HELP", "S�g�");

DEFINE("_CAL_LANG_CAL_TITLE", "Esem�nyek");
DEFINE("_CAL_LANG_ADD_TITLE", "Hozz�ad�s");
DEFINE("_CAL_LANG_MODIFY_TITLE", "M�dos�t�s");

DEFINE("_CAL_LANG_REPEAT_DISABLED", "Az esem�ny ism�tl�d�se csak akkor alkalmazhat�, ha a z�r� d�tum r�gebbi a kezd� d�tumn�l.  V�ltoztassa meg a z�r� d�tumot az esem�ny ism�tl�d�si r�szleteinek be�ll�t�sa el�tt."); // New for 1.4
DEFINE("_CAL_LANG_EVENT_TITLE", "T�rgy");
DEFINE("_CAL_LANG_EVENT_COLOR", "Sz�n");
DEFINE("_CAL_LANG_EVENT_CATCOLOR", "Kateg�riasz�n haszn�lata");
DEFINE("_CAL_LANG_EVENT_CATEGORY", "Kateg�ria");
DEFINE("_CAL_LANG_EVENT_CHOOSE_CATEG", "- V�lasszon kateg�ri�t -");
DEFINE("_CAL_LANG_EVENT_ACTIVITY", "Tev�kenys�g");
DEFINE("_CAL_LANG_EVENT_URLMAIL_INFO", "URL-c�m vagy email c�m hozz�ad�sa eset�n egyszer�en �rja csak be, hogy <u>http://www.enweblapom.hu</u> vagy <u>mailto:en@mail.com</u>");
DEFINE("_CAL_LANG_EVENT_ADRESSE", "Hely");
DEFINE("_CAL_LANG_EVENT_CONTACT", "Kapcsolattart�");
DEFINE("_CAL_LANG_EVENT_EXTRA", "Kieg�sz�t� inform�ci�");
DEFINE("_CAL_LANG_EVENT_AUTHOR_ALIAS", "Szerz� (�ln�v)");
DEFINE("_CAL_LANG_EVENT_STARTDATE", "Kezd� d�tum");
DEFINE("_CAL_LANG_EVENT_ENDDATE", "Z�r� d�tum");
DEFINE("_CAL_LANG_EVENT_STARTHOURS", "Kezd� �ra");
DEFINE("_CAL_LANG_EVENT_ENDHOURS", "Z�r� �ra");
DEFINE("_CAL_LANG_EVENT_STARTTIME", "Kezd� id�pont");
DEFINE("_CAL_LANG_EVENT_ENDTIME", "Z�r� id�pont");
DEFINE("_CAL_LANG_PUB_INFO", "K�zz�t�tel d�tuma");
DEFINE("_CAL_LANG_EVENT_REPEATTYPE", "Ism�tl�d�s tipusa");
DEFINE("_CAL_LANG_EVENT_REPEATDAY", "Ism�tl�d�s napja");
DEFINE("_CAL_LANG_EVENT_CHOOSE_WEEKDAYS", "A h�t napjai");
DEFINE("_CAL_LANG_EVENT_PER", "");
DEFINE("_CAL_LANG_EVENT_WEEKOPT", "Egy h�nap hete(i)nek ism�tl�d�si t�pusa a h�t");

DEFINE("_CAL_LANG_SUBMITPREVIEW", "El�n�zet");
DEFINE("_CAL_LANG_SUBMITCANCEL", "M�gse");
DEFINE("_CAL_LANG_SUBMITSAVE", "Ment�s");

DEFINE("_CAL_LANG_E_WARNWEEKS", "K�rj�k, hogy v�lassza ki a hetet.");
DEFINE("_CAL_LANG_E_WARNDAYS", "K�rj�k, hogy v�lassza ki a napot.");

// Admin
DEFINE("_CAL_LANG_EVENT_ALLCAT", "Minden kateg�ria");
DEFINE("_CAL_LANG_EVENT_ACCESSLEVEL", "Hozz�f�r�si szint");
DEFINE("_CAL_LANG_EVENT_HITS", "Tal�latok");
DEFINE("_CAL_LANG_EVENT_STATE", "�llapot");
DEFINE("_CAL_LANG_EVENT_CREATED", "L�trehozva");
DEFINE("_CAL_LANG_EVENT_NEWEVENT", "�j esem�ny");
DEFINE("_CAL_LANG_EVENT_MODIFIED", "M�dos�tva");
DEFINE("_CAL_LANG_EVENT_NOTMODIFIED", "Nem m�dos�tott�k");

// dmcd aug 22/04  new warning alert for no specified activity in event entry
DEFINE("_CAL_LANG_WARNACTIVITY", "�rja be a tev�kenys�g\\nle�r�s�t ide.");

DEFINE("_CAL_LEGEND_ALL_CATEGORIES", "Minden kateg�ria ...");  // new for 1.4
DEFINE("_CAL_LEGEND_ALL_CATEGORIES_DESC", "Az �sszes kateg�ri�ban l�v� esem�nyek megjelen�t�se");  // new for 1.4

DEFINE("_CAL_LANG_FORM_HELP_COLOR", <<<END
        <tr>
		  <td width="110" align="left" valign="top">
            <b>Sz�n</b>
          </td>
          <td>V�lassza ki a havi napt�r n�zetben l�that� h�tt�rsz�nt.  Ha kijel�li a Kateg�ria jel�l�n�gyzetet, akkor ez a sz�n lesz 
		  a kateg�ria alap�rtelmezett (a weblap adminisztr�tora �ltal meghat�rozott) sz�ne, amit a Tartalom f�l�n v�lasztott ki az esem�nyhez,
		  a 'Sz�nv�laszt�' gomb pedig letilt�sra ker�l.</td>
        </tr>
END
);

DEFINE("_CAL_LANG_FORM_HELP",  <<<END
    	<tr>
          <td align="left"><b>D�tum</b></td>
          <td>V�lassza ki az esem�ny kezd� �s z�r� d�tum�t.</td>
        </tr>
    	<tr>
          <td align="left" valign="top"><b>Id�pont</b></td>
          <td>Adja meg az esem�ny id�pontj�t.  A form�tuma <span style='color:blue;font-weight:bold;'>hh:mm {am|pm}</span>.<br/>Az id�pontot 12 vagy �r�s form�tumban is megadhatja.<br/><br/><b><i><span style='color:red;'>(�j)</span></i> Megjegyz�s</b>: k�l�nleges eset �ll fenn az <span style='color:red;font-weight:bold;'>egynapos �jszakai esem�nyekn�l</span>.  Pl.: tegy�k fel, hogy egy egynapos esem�ny 19:00 �rakor kezd�dik, �s 3:00 �rakor fejez�dik be, ilyenkor a kezd� �s a z�r� d�tumnak ugyanannak a d�tumnak&nbsp;
		   <b>KELL</b> lennie, �s arra a d�tumra kell �ll�tania, amelyik megegyezik az �jf�l el�tti nappal.</td>
        </tr>
END
);

DEFINE("_CAL_LANG_FORM_HELP_EXTENDED",  <<<END
        <tr>
    	  <td align="left" valign="top" nowrap><b>Ism�tl�d�s t�pusa</b></td>
  	  	<td colspan="2"></td>
  		</tr>
  		<tr>
    	  <td colspan="2" align="left" valign="top">
	    	<table width="100%" border="0" cellspacing="2">
              <tr>
                <td width="60" align="left" valign="top"><u>Naponta</u></td>
                <td width="110" align="left" valign="top" class="frm_td_bydays">
                  <font color="#000000">Minden nap<br/><i>(alap�rtelmez�s)</i></font>
                </td>
                <td align="left" valign="top" class="frm_td_bydays">
                  <font color="#000000">Ezt a lehet�s�get nem ism�tl�d�, egyszeri vagy t�bbnapos esem�ny eset�n v�lassza, �j esem�ny el�fordul�s�val minden napra a kezd� �s a z�r� d�tum id�tartam�n bel�l</font>
                </td>
              </tr>
              <tr>
                <td width="60" rowspan="3" align="left" valign="top"><u>Hetente</u></td>
                <td width="110" align="left" valign="top" class="frm_td_byweeks">
                  <font color="#000000">
                    Hetente egyszer
                  </font>
                </td>
                <td align="left" valign="top" class="frm_td_byweeks">
                  <font color="#000000">
                  Ezzel a lehet�s�ggel az ism�tl�d�s napjait v�laszthatja ki
                  <table border="0" width="100%" height="100%"><tr><td><b>Nap sorsz�ma</b> minden 10/../2003 t�pus� ism�tl�d�shez</td></tr><tr><td><b>Nap sorsz�ma</b> minden h�tf�n t�pus� ism�tl�d�shez</td></tr></table>
                  </font>
                </td>
              </tr>
              <tr>
                <td width="110" align="left" valign="top" class="frm_td_byweeks">
                  <font color="#000000">
                    Hetente t�bbsz�r
                  </font>
                </td>
                <td align="left" valign="top" class="frm_td_byweeks">
                  <font color="#000000">Ezzel a lehet�s�ggel v�laszthatja ki, hogy a h�t mely napjain legyen l�that� az esem�ny.</font>
                </td>
              </tr>
              <tr>
                <td width="110" align="left" valign="top" class="frm_td_byweeks">
                  <font color="#000000"><i>H�nap #. hete <br>A fenti 'Hetente egyszer' �s 'Hetente t�bbsz�r' lehet�s�gekhez</i></font></td>
                  <td align="left" valign="top" class="frm_td_byweeks">
                  <font color="#000000">
                  <table border="0" width="100%" height="100%">
                    <tr><td><b>1. h�t :</b> A h�nap 1. hete</td></tr>
                    <tr><td><b>2. h�t :</b> A h�nap 2. hete</td></tr>
                    <tr><td><b>3. h�t :</b> A h�nap 3. hete</td></tr>
                    <tr><td><b>4. h�t :</b> A h�nap 4. hete</td></tr>
                    <tr><td><b>5. h�t :</b> A h�nap 5. hete (ha felhaszn�lhat�)</td></tr>
                   </table>
                 </font>
                </td>
              </tr>
              <tr>
                <td width="60" rowspan="2" align="left" valign="top"><u>Havonta</u></td>
                <td width="110" align="left" valign="top" class="frm_td_bymonth">
                  <font color="#000000">Havonta egyszer</font></td>
                <td align="left" valign="top" class="frm_td_bymonth">
                  <font color="#000000">
                     Ezzel a lehet�s�ggek v�laszthatja ki a h�nap ism�tl�d� napj�t
                     <table border="0" width="100%" height="100%"><tr><td><b>Nap sorsz�ma</b> minden 10/../2003 t�pus� ism�tl�d�shez</td></tr><tr><td><b>Nap sorsz�ma</b> minden h�tf�n t�pus� ism�tl�d�shez</td></tr></table>

                  </font>
                </td>
              </tr>
              <tr>
                <td width="110" align="left" valign="top" class="frm_td_bymonth">
                  <font color="#000000">
                  Minden h�nap v�g�n
                  </font>
                </td>
                <td align="left" valign="top" class="frm_td_bymonth">
                  <font color="#000000">
				   Az esem�ny a nap sorsz�m�t�l f�ggetlen�l minden h�nap utols� napj�ra esik, ha az utols� nap
		az esem�nyhez megadott kezd� �s z�r� d�tum k�zti id�tartamba esik.
                  </font>
                </td>
              </tr>
              <tr>
                <td width="60" rowspan="2" align="left" valign="top"><u>�vente</u></td>
                <td width="110" align="left" valign="top" class="frm_td_byyear">
                  <font color="#000000">
                  �vente egyszer
                  </font>
                </td>
                <td align="left" valign="top" class="frm_td_byyear">
                  <font color="#000000">
                  Ezzel a lehet�s�ggel minden �vben egy napot v�laszthat ki
                  <table border="0" width="100%" height="100%"><tr><td><b>Nap sorsz�ma</b> minden 10/../2003 t�pus� ism�tl�d�shez</td></tr><tr><td><b>Nap sorsz�ma</b> minden h�tf�n t�pus� ism�tl�d�shez</td></tr></table>
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
