<?php
/**
 * Events Component for Joomla 1.0.x
 *
 * @version     $Id: hungariani-utf8.php 991 2008-03-10 19:55:48Z tstahl $
 * @package     Events
 * @copyright   Copyright (C) 2006-2008 JEvents Project Group
 * @licence     http://www.gnu.org/copyleft/gpl.html
 * @link        http://joomlacode.org/gf/project/jevents
 * @translation           Jozsef Tamas Herczeg, www.joomlandia.eu
 * @translation license   http://creativecommons.org/licenses/by-nc-nd/2.5/
 * @encoding    windows-1250
 */

defined("_VALID_MOS") or die("A közvetlen hozzáférés ehhez a helyhez nem engedélyezett");

//Check
DEFINE("_CAL_LANG_INCLUDED", 1);

// new 1.4.0 [mic]
define("_CAL_LANG_LNG",				"hu"); // de|fr|etc... [ DO NOT CHANGE THIS VALUE! ]

// used for colorpicker
define("_CAL_LANG_NO_COLOR",			"Nincs szín");
define("_CAL_LANG_COLOR_PICKER",		"Színválasztó");

// common
define("_CAL_LANG_TIME",				"Időpont");
define("_CAL_LANG_CLICK_TO_OPEN_EVENT",	"Kattints ide az esemény megnyitásához");
define("_CAL_LANG_UNPUBLISHED",		"** Visszavonva **");
define("_CAL_LANG_DESCRIPTION",		"Leírás");
define("_CAL_LANG_EMAIL_TO_AUTHOR",	"Email a szerzőnek");
define("_CAL_LANG_MAIL_TO_ADMIN",		"Esemény érkezett a(z) [ %s ] weblapról, beküldte: [ %s ]");
define("_CAL_LANG_KEYWORD_NOT_VALID",	"Nem érvényes kulcsszó");
define("_CAL_LANG_EVENT_CALENDAR",		"Eseménynaptár"); // new 1.4

// modul
define("_CAL_LANG_ERR_NO_MOD_CAL",		"Eseménynaptár\n<br />Ehhez a modulhoz az Events komponensre van szükség");
define("_CAL_LANG_CLICK_TOSWITCH_DAY",	"Ugrás a naptárban ide - kijelölt nap");
define("_CAL_LANG_CLICK_TOSWITCH_MON",	"Ugrás a naptárban ide - jelenlegi hónap");
define("_CAL_LANG_CLICK_TOSWITCH_YEAR",	"Ugrás a naptárban ide - idei év");
define("_CAL_LANG_CLICK_TOSWITCH_PY",	"Ugrás a naptárban ide - múlt év");
define("_CAL_LANG_CLICK_TOSWITCH_PM",	"Ugrás a naptárban ide - múlt hónap");
define("_CAL_LANG_CLICK_TOSWITCH_NM",	"Ugrás a naptárban ide - következő hónap");
define("_CAL_LANG_CLICK_TOSWITCH_NY",	"Ugrás a naptárban ide - következő év");

// navTableNext
define("_CAL_LANG_NAV_TN_FIRST_LIST",	"első lista");
define("_CAL_LANG_NAV_TN_PREV_LIST",	"utolsó lista");
define("_CAL_LANG_NAV_TN_NEXT_LIST",	"következő lista");
define("_CAL_LANG_NAV_TN_LAST_LIST",	"utolsó lista");

// calendar monthly display
define("_CAL_LANG_FIRST_SINGLE_DAY_EVENT",		"Egyszeri esemény");
define("_CAL_LANG_FIRST_DAY_OF_MULTIEVENT",	"Egy többnapos esemény első napja");
define("_CAL_LANG_LAST_DAY_OF_MULTIEVENT",		"Egy többnapos esemény utolsó napja");
define("_CAL_LANG_MULTIDAY_EVENT",				"Többnapos esemény");
/* ++++++ end mic +++++++++++++ */

// Months
DEFINE("_CAL_LANG_JANUARY", "Január");
DEFINE("_CAL_LANG_FEBRUARY", "Február");
DEFINE("_CAL_LANG_MARCH", "Március");
DEFINE("_CAL_LANG_APRIL", "Április");
DEFINE("_CAL_LANG_MAY", "Május");
DEFINE("_CAL_LANG_JUNE", "Június");
DEFINE("_CAL_LANG_JULY", "Július");
DEFINE("_CAL_LANG_AUGUST", "Augusztus");
DEFINE("_CAL_LANG_SEPTEMBER", "Szeptember");
DEFINE("_CAL_LANG_OCTOBER", "Október");
DEFINE("_CAL_LANG_NOVEMBER", "November");
DEFINE("_CAL_LANG_DECEMBER", "December");

// Short day names
DEFINE("_CAL_LANG_SUN", "Vas");
DEFINE("_CAL_LANG_MON", "Hét");
DEFINE("_CAL_LANG_TUE", "Ked");
DEFINE("_CAL_LANG_WED", "Sze");
DEFINE("_CAL_LANG_THU", "Csü");
DEFINE("_CAL_LANG_FRI", "Pén");
DEFINE("_CAL_LANG_SAT", "Szo");

// Days
DEFINE("_CAL_LANG_SUNDAY", "Vasárnap");
DEFINE("_CAL_LANG_MONDAY", "Hétfő");
DEFINE("_CAL_LANG_TUESDAY", "Kedd");
DEFINE("_CAL_LANG_WEDNESDAY", "Szerda");
DEFINE("_CAL_LANG_THURSDAY", "Csütörtök");
DEFINE("_CAL_LANG_FRIDAY", "Péntek");
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
DEFINE("_CAL_LANG_EACHWEEKPAIR", "Páros heteken");
DEFINE("_CAL_LANG_EACHWEEKIMPAIR", "Páratlan heteken");
DEFINE("_CAL_LANG_EACHMONTH", "Havonta");
DEFINE("_CAL_LANG_EACHYEAR", "Évente");
DEFINE("_CAL_LANG_ONLYDAYS", "Csak a megadott napon");
DEFINE("_CAL_LANG_EACH", "Minden");
DEFINE("_CAL_LANG_EACHOF","of each");
DEFINE("_CAL_LANG_ENDMONTH", "hónap végén");

// Repeat days
DEFINE("_CAL_LANG_BYDAYNUMBER", "A nap sorszáma szerint");

// User type
DEFINE("_CAL_LANG_ANONYME", "Névtelen");

// Post
//PAS D'ACCENTS DANS LES _ACT_
DEFINE("_CAL_LANG_ACT_ADDED", "Köszönjük a bejegyzésedet - Javaslatodat rövidesen ellenőrizni fogjuk!"); //NO ACCENT !!
DEFINE("_CAL_LANG_ACT_MODIFIED", "Ez az esemény megváltozott."); //NO ACCENT !!
DEFINE("_CAL_LANG_ACT_PUBLISHED", "Ez az esemény közzétételre került.");  //NEW 1.4
DEFINE("_CAL_LANG_ACT_DELETED", "Az esemény törlése megtörtént!"); //NO ACCENT !!
DEFINE("_CAL_LANG_NOPERMISSION", "Eme szolgáltatáshoz való hozzáférés a számodra nem engedélyezett!"); //NO ACCENT !!

DEFINE("_CAL_LANG_MAIL_ADDED", "Új bejegyzés");
DEFINE("_CAL_LANG_MAIL_MODIFIED", "Új módosítás");

// Presentation
DEFINE("_CAL_LANG_BY", "Beírta:");
DEFINE("_CAL_LANG_FROM", "Mettől");
DEFINE("_CAL_LANG_TO", "Meddig");
DEFINE("_CAL_LANG_ARCHIVE", "Archívumok");
DEFINE("_CAL_LANG_WEEK", "a hét");
DEFINE("_CAL_LANG_NO_EVENTS", "Nincs esemény");
DEFINE("_CAL_LANG_NO_EVENTFOR", "Nincs találat a következő kulcsszóra:");
DEFINE("_CAL_LANG_NO_EVENTFORTHE", "Nincs esemény");
DEFINE("_CAL_LANG_THIS_DAY", "ma");
DEFINE("_CAL_LANG_THIS_MONTH", "E hónap");
DEFINE("_CAL_LANG_LAST_MONTH", "Utolsó hónap");
DEFINE("_CAL_LANG_NEXT_MONTH", "Következő hónap");
DEFINE("_CAL_LANG_EVENTSFOR", "Események");
DEFINE("_CAL_LANG_SEARCHRESULTS", "A kulcsszó keresésének eredménye"); // new 1.4
DEFINE("_CAL_LANG_EVENTSFORTHE", "Események");
DEFINE("_CAL_LANG_REP_DAY", "naponta");
DEFINE("_CAL_LANG_REP_WEEK", "hetente");
DEFINE("_CAL_LANG_REP_WEEKPAIR", "minden 2. héten");
DEFINE("_CAL_LANG_REP_WEEKIMPAIR", "minden 3. héten");
DEFINE("_CAL_LANG_REP_MONTH", "havonta");
DEFINE("_CAL_LANG_REP_YEAR", "évente");
DEFINE("_CAL_LANG_REP_NOEVENTSELECTED", "Kérjük, hogy előbb válaszd ki az eseményt");

// Navigation
DEFINE("_CAL_LANG_VIEWTODAY", "Ma");
DEFINE("_CAL_LANG_VIEWTOCOME", "E hónapban esedékes");
DEFINE("_CAL_LANG_VIEWBYDAY", "Napi");
DEFINE("_CAL_LANG_VIEWBYCAT", "Kategóriánként");
DEFINE("_CAL_LANG_VIEWBYMONTH", "Havi");
DEFINE("_CAL_LANG_VIEWBYYEAR", "Éves");
DEFINE("_CAL_LANG_VIEWBYWEEK", "Heti");
DEFINE("_CAL_LANG_JUMPTO", "Ugrás hónaphoz");  // New 1.4
DEFINE("_CAL_LANG_BACK", "Vissza");
DEFINE("_CAL_LANG_CLOSE", "Bezárás");
DEFINE("_CAL_LANG_PREVIOUSDAY", "Előző nap");
DEFINE("_CAL_LANG_PREVIOUSWEEK", "Előző hét");
DEFINE("_CAL_LANG_PREVIOUSMONTH", "Előző hónap");
DEFINE("_CAL_LANG_PREVIOUSYEAR", "Előző év");
DEFINE("_CAL_LANG_NEXTDAY", "Következő nap");
DEFINE("_CAL_LANG_NEXTWEEK", "Következő hét");
DEFINE("_CAL_LANG_NEXTMONTH", "Következő hónap");
DEFINE("_CAL_LANG_NEXTYEAR", "Következő év");

DEFINE("_CAL_LANG_ADMINPANEL", "Kezelőpanel");
DEFINE("_CAL_LANG_ADDEVENT", "Új esemény");
DEFINE("_CAL_LANG_MYEVENTS", "Eseményeim");
DEFINE("_CAL_LANG_DELETE", "Törlés");
DEFINE("_CAL_LANG_MODIFY", "Módosítás");

// Form
DEFINE("_CAL_LANG_HELP", "Súgó");

DEFINE("_CAL_LANG_CAL_TITLE", "Események");
DEFINE("_CAL_LANG_ADD_TITLE", "Hozzáadás");
DEFINE("_CAL_LANG_MODIFY_TITLE", "Módosítás");

DEFINE("_CAL_LANG_REPEAT_DISABLED", "Az esemény ismétlődése csak akkor alkalmazható, ha a záró dátum régebbi a kezdő dátumnál.  Változtasd meg a záró dátumot az esemény ismétlődési részleteinek beállítása előtt."); // New for 1.4
DEFINE("_CAL_LANG_EVENT_TITLE", "Tárgy");
DEFINE("_CAL_LANG_EVENT_COLOR", "Szín");
DEFINE("_CAL_LANG_EVENT_CATCOLOR", "Kategóriaszín használata");
DEFINE("_CAL_LANG_EVENT_CATEGORY", "Kategória");
DEFINE("_CAL_LANG_EVENT_CHOOSE_CATEG", "- Válasszon kategóriát -");
DEFINE("_CAL_LANG_EVENT_ACTIVITY", "Tevékenység");
DEFINE("_CAL_LANG_EVENT_URLMAIL_INFO", "URL-cím vagy email cím hozzáadása esetén egyszerűen írd csak be, hogy <u>http://www.enweblapom.hu</u> vagy <u>mailto:en@mail.com</u>");
DEFINE("_CAL_LANG_EVENT_ADRESSE", "Hely");
DEFINE("_CAL_LANG_EVENT_CONTACT", "Kapcsolattartó");
DEFINE("_CAL_LANG_EVENT_EXTRA", "Kiegészítő információ");
DEFINE("_CAL_LANG_EVENT_AUTHOR_ALIAS", "Szerző (álnév)");
DEFINE("_CAL_LANG_EVENT_STARTDATE", "Kezdő dátum");
DEFINE("_CAL_LANG_EVENT_ENDDATE", "Záró dátum");
DEFINE("_CAL_LANG_EVENT_STARTHOURS", "Kezdő óra");
DEFINE("_CAL_LANG_EVENT_ENDHOURS", "Záró óra");
DEFINE("_CAL_LANG_EVENT_STARTTIME", "Kezdő időpont");
DEFINE("_CAL_LANG_EVENT_ENDTIME", "Záró időpont");
DEFINE("_CAL_LANG_PUB_INFO", "Közzététel dátuma");
DEFINE("_CAL_LANG_EVENT_REPEATTYPE", "Ismétlődés tipusa");
DEFINE("_CAL_LANG_EVENT_REPEATDAY", "Ismétlődés napja");
DEFINE("_CAL_LANG_EVENT_CHOOSE_WEEKDAYS", "A hét napjai");
DEFINE("_CAL_LANG_EVENT_PER", "");
DEFINE("_CAL_LANG_EVENT_WEEKOPT", "Egy hónap hete(i)nek ismétlődési típusa a hét");

DEFINE("_CAL_LANG_SUBMITPREVIEW", "Előnézet");
DEFINE("_CAL_LANG_SUBMITCANCEL", "Mégse");
DEFINE("_CAL_LANG_SUBMITSAVE", "Mentés");

DEFINE("_CAL_LANG_E_WARNWEEKS", "Kérjük, hogy válaszd ki a hetet.");
DEFINE("_CAL_LANG_E_WARNDAYS", "Kérjük, hogy válaszd ki a napot.");

// Admin
DEFINE("_CAL_LANG_EVENT_ALLCAT", "Minden kategória");
DEFINE("_CAL_LANG_EVENT_ACCESSLEVEL", "Hozzáférési szint");
DEFINE("_CAL_LANG_EVENT_HITS", "Találatok");
DEFINE("_CAL_LANG_EVENT_STATE", "Állapot");
DEFINE("_CAL_LANG_EVENT_CREATED", "Létrehozva");
DEFINE("_CAL_LANG_EVENT_NEWEVENT", "Új esemény");
DEFINE("_CAL_LANG_EVENT_MODIFIED", "Módosítva");
DEFINE("_CAL_LANG_EVENT_NOTMODIFIED", "Nem módosították");

// dmcd aug 22/04  new warning alert for no specified activity in event entry
DEFINE("_CAL_LANG_WARNACTIVITY", "Írd be a tevékenység\\nleírását ide.");

DEFINE("_CAL_LEGEND_ALL_CATEGORIES", "Minden kategória ...");  // new for 1.4
DEFINE("_CAL_LEGEND_ALL_CATEGORIES_DESC", "Az összes kategóriában lévő események megjelenítése");  // new for 1.4

DEFINE("_CAL_LANG_FORM_HELP_COLOR", <<<END
        <tr>
		  <td width="110" align="left" valign="top">
            <b>Szín</b>
          </td>
          <td>Válaszd ki a havi naptár nézetben látható háttérszínt.  Ha kijelölöd a Kategória jelölőnégyzetet, akkor ez a szín lesz 
		  a kategória alapértelmezett (a weblap adminisztrátora által meghatározott) színe, amit a Tartalom fülön választott ki az eseményhez,
		  a 'Színválasztó' gomb pedig letiltásra kerül.</td>
        </tr>
END
);

DEFINE("_CAL_LANG_FORM_HELP",  <<<END
    	<tr>
          <td align="left"><b>Dátum</b></td>
          <td>Válassza ki az esemény kezdő és záró dátumát.</td>
        </tr>
    	<tr>
          <td align="left" valign="top"><b>Időpont</b></td>
          <td>Add meg az esemény időpontját.  A formátuma <span style='color:blue;font-weight:bold;'>hh:mm {am|pm}</span>.<br/>Az időpontot 12 vagy órás formátumban is megadhatod.<br/><br/><b><i><span style='color:red;'>(Új)</span></i> Megjegyzés</b>: különleges eset áll fenn az <span style='color:red;font-weight:bold;'>egynapos éjszakai eseményeknél</span>.  Pl.: tegyük fel, hogy egy egynapos esemény 19:00 órakor kezdődik, és 3:00 órakor fejeződik be, ilyenkor a kezdő és a záró dátumnak ugyanannak a dátumnak&nbsp;
		   <b>KELL</b> lennie, és arra a dátumra kell állítanod, amelyik megegyezik az éjfél előtti nappal.</td>
        </tr>
END
);

DEFINE("_CAL_LANG_FORM_HELP_EXTENDED",  <<<END
        <tr>
    	  <td align="left" valign="top" nowrap><b>Ismétlődés típusa</b></td>
  	  	<td colspan="2"></td>
  		</tr>
  		<tr>
    	  <td colspan="2" align="left" valign="top">
	    	<table width="100%" border="0" cellspacing="2">
              <tr>
                <td width="60" align="left" valign="top"><u>Naponta</u></td>
                <td width="110" align="left" valign="top" class="frm_td_bydays">
                  <font color="#000000">Minden nap<br/><i>(alapértelmezés)</i></font>
                </td>
                <td align="left" valign="top" class="frm_td_bydays">
                  <font color="#000000">Ezt a lehetőséget nem ismétlődő, egyszeri vagy többnapos esemény esetén válaszd, új esemény előfordulásával minden napra a kezdő és a záró dátum időtartamán belül</font>
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
                  Ezzel a lehetőséggel az ismétlődés napjait választhatod ki
                  <table border="0" width="100%" height="100%"><tr><td><b>Nap sorszáma</b> minden 10/../2003 típusú ismétlődéshez</td></tr><tr><td><b>Nap sorszáma</b> minden hétfőn típusú ismétlődéshez</td></tr></table>
                  </font>
                </td>
              </tr>
              <tr>
                <td width="110" align="left" valign="top" class="frm_td_byweeks">
                  <font color="#000000">
                    Hetente többször
                  </font>
                </td>
                <td align="left" valign="top" class="frm_td_byweeks">
                  <font color="#000000">Ezzel a lehetőséggel választhatod ki, hogy a hét mely napjain legyen látható az esemény.</font>
                </td>
              </tr>
              <tr>
                <td width="110" align="left" valign="top" class="frm_td_byweeks">
                  <font color="#000000"><i>Hónap #. hete <br>A fenti 'Hetente egyszer' és 'Hetente többször' lehetőségekhez</i></font></td>
                  <td align="left" valign="top" class="frm_td_byweeks">
                  <font color="#000000">
                  <table border="0" width="100%" height="100%">
                    <tr><td><b>1. hét :</b> A hónap 1. hete</td></tr>
                    <tr><td><b>2. hét :</b> A hónap 2. hete</td></tr>
                    <tr><td><b>3. hét :</b> A hónap 3. hete</td></tr>
                    <tr><td><b>4. hét :</b> A hónap 4. hete</td></tr>
                    <tr><td><b>5. hét :</b> A hónap 5. hete (ha felhasználható)</td></tr>
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
                     Ezzel a lehetőséggek választhatod ki a hónap ismétlődő napját
                     <table border="0" width="100%" height="100%"><tr><td><b>Nap sorszáma</b> minden 10/../2003 típusú ismétlődéshez</td></tr><tr><td><b>Nap sorszáma</b> minden hétfőn típusú ismétlődéshez</td></tr></table>

                  </font>
                </td>
              </tr>
              <tr>
                <td width="110" align="left" valign="top" class="frm_td_bymonth">
                  <font color="#000000">
                  Minden hónap végén
                  </font>
                </td>
                <td align="left" valign="top" class="frm_td_bymonth">
                  <font color="#000000">
				   Az esemény a nap sorszámától függetlenül minden hónap utolsó napjára esik, ha az utolsó nap
		az eseményhez megadott kezdő és záró dátum közti időtartamba esik.
                  </font>
                </td>
              </tr>
              <tr>
                <td width="60" rowspan="2" align="left" valign="top"><u>Évente</u></td>
                <td width="110" align="left" valign="top" class="frm_td_byyear">
                  <font color="#000000">
                  Évente egyszer
                  </font>
                </td>
                <td align="left" valign="top" class="frm_td_byyear">
                  <font color="#000000">
                  Ezzel a lehetőséggel minden évben egy napot választhatsz ki
                  <table border="0" width="100%" height="100%"><tr><td><b>Nap sorszáma</b> minden 10/../2003 típusú ismétlődéshez</td></tr><tr><td><b>Nap sorszáma</b> minden hétfőn típusú ismétlődéshez</td></tr></table>
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
