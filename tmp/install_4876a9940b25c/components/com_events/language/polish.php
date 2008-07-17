<?php
/**
 * Events Component for Joomla 1.0.x
 *
 * @version     $Id: polish.php 991 2008-03-10 19:55:48Z tstahl $
 * @package     Events
 * @copyright   Copyright (C) 2006-2008 JEvents Project Group
 * @licence     http://www.gnu.org/copyleft/gpl.html
 * @link        http://forge.joomla.org/sf/projects/jevents
 * @Translate   Jakub Dirska http://www.webir.eu
 * @encoding    iso-8859-2
 */

defined("_VALID_MOS") or die( 'Restricted access' );

//Check
DEFINE("_CAL_LANG_INCLUDED", 1);

// new 1.4.0 [mic]
define("_CAL_LANG_LNG",				"pl"); // de|fr|etc... [ DO NOT CHANGE THIS VALUE! ]

// used for colorpicker
define("_CAL_LANG_NO_COLOR",			"Kolor");
define("_CAL_LANG_COLOR_PICKER",		"Wybór koloru");

// common
define("_CAL_LANG_TIME",				"Godzina");
define("_CAL_LANG_CLICK_TO_OPEN_EVENT",	"Kliknij aby otworzyæ wydarzenie");
define("_CAL_LANG_UNPUBLISHED",		"** Nieopublikowane **");
define("_CAL_LANG_DESCRIPTION",		"Opis");
define("_CAL_LANG_EMAIL_TO_AUTHOR",	"Wy¶lij email do autora");
define("_CAL_LANG_MAIL_TO_ADMIN",		"Wydarzenie wpisane przez [ %s ] by [ %s ]");
define("_CAL_LANG_KEYWORD_NOT_VALID",	"Niepoprawna fraza wyszukiwania");
define("_CAL_LANG_EVENT_CALENDAR",		"Kalendarz wydarzeñ"); // new 1.4

// modul
define("_CAL_LANG_ERR_NO_MOD_CAL",		"Kalendarz wydarzeñ\n<br />Modu³ wymaga zainstalowanego komponentu JEvents");
define("_CAL_LANG_CLICK_TOSWITCH_DAY",	"Id¼ do kalendarza - dzisiaj");
define("_CAL_LANG_CLICK_TOSWITCH_MON",	"Id¼ do kalendarza - obecny miesi±c");
define("_CAL_LANG_CLICK_TOSWITCH_YEAR",	"Id¼ do kalendarza - obecny rok");
define("_CAL_LANG_CLICK_TOSWITCH_PY",	"Id¼ do kalendarza - poprzedni rok");
define("_CAL_LANG_CLICK_TOSWITCH_PM",	"Id¼ do kalendarza - poprzedni miesi±c");
define("_CAL_LANG_CLICK_TOSWITCH_NM",	"Id¼ do kalendarza - nastêpny miesi±c");
define("_CAL_LANG_CLICK_TOSWITCH_NY",	"Id¼ do kalendarza - nastêpny rok");

// navTableNext
define("_CAL_LANG_NAV_TN_FIRST_LIST",	"Pierwsza lista");
define("_CAL_LANG_NAV_TN_PREV_LIST",	"Poprzednia lista");
define("_CAL_LANG_NAV_TN_NEXT_LIST",	"Nastêpna lista");
define("_CAL_LANG_NAV_TN_LAST_LIST",	"Ostatnia lista");

// calendar monthly display
define("_CAL_LANG_FIRST_SINGLE_DAY_EVENT",		"Pojedyncze wydarzenie");
define("_CAL_LANG_FIRST_DAY_OF_MULTIEVENT",	"Pierwszy dzieñ wielodniowego wydarzenia");
define("_CAL_LANG_LAST_DAY_OF_MULTIEVENT",		"Ostatni dzieñ wielodniowego wydarzenia");
define("_CAL_LANG_MULTIDAY_EVENT",				"Wydarzenie wielodniowe");
/* ++++++ end mic +++++++++++++ */

// Months
DEFINE("_CAL_LANG_JANUARY", "Styczeñ");
DEFINE("_CAL_LANG_FEBRUARY", "Luty");
DEFINE("_CAL_LANG_MARCH", "Marzec");
DEFINE("_CAL_LANG_APRIL", "Kwiecieñ");
DEFINE("_CAL_LANG_MAY", "Maj");
DEFINE("_CAL_LANG_JUNE", "Czerwiec");
DEFINE("_CAL_LANG_JULY", "Lipiec");
DEFINE("_CAL_LANG_AUGUST", "Sierpieñ");
DEFINE("_CAL_LANG_SEPTEMBER", "Wrzesieñ");
DEFINE("_CAL_LANG_OCTOBER", "Pa¿dziernik");
DEFINE("_CAL_LANG_NOVEMBER", "Listopad");
DEFINE("_CAL_LANG_DECEMBER", "Grudzieñ");

// Short day names
DEFINE("_CAL_LANG_SUN", "Nie");
DEFINE("_CAL_LANG_MON", "Pon");
DEFINE("_CAL_LANG_TUE", "Wto");
DEFINE("_CAL_LANG_WED", "¦ro");
DEFINE("_CAL_LANG_THU", "Czw");
DEFINE("_CAL_LANG_FRI", "Pi±");
DEFINE("_CAL_LANG_SAT", "Sob");

// Days
DEFINE("_CAL_LANG_SUNDAY", "Niedziela");
DEFINE("_CAL_LANG_MONDAY", "Poniedzia³ek");
DEFINE("_CAL_LANG_TUESDAY", "Wtorek");
DEFINE("_CAL_LANG_WEDNESDAY", "¦roda");
DEFINE("_CAL_LANG_THURSDAY", "Czwartek");
DEFINE("_CAL_LANG_FRIDAY", "Pi±tek");
DEFINE("_CAL_LANG_SATURDAY", "Sobota");

// Days lettres
DEFINE("_CAL_LANG_SUNDAYSHORT", "N");
DEFINE("_CAL_LANG_MONDAYSHORT", "P");
DEFINE("_CAL_LANG_TUESDAYSHORT", "W");
DEFINE("_CAL_LANG_WEDNESDAYSHORT", "¦");
DEFINE("_CAL_LANG_THURSDAYSHORT", "C");
DEFINE("_CAL_LANG_FRIDAYSHORT", "P");
DEFINE("_CAL_LANG_SATURDAYSHORT", "S");

// Repeat type
DEFINE("_CAL_LANG_ALLDAYS", "Ka¿dego dnia");
DEFINE("_CAL_LANG_EACHWEEK", "Ka¿dy tydzieñ");
DEFINE("_CAL_LANG_EACHWEEKPAIR", "Ka¿dy parzysty tydzieñ");
DEFINE("_CAL_LANG_EACHWEEKIMPAIR", "Ka¿dy nieparzysty tydzieñ");
DEFINE("_CAL_LANG_EACHMONTH", "Ka¿dy miesi±c");
DEFINE("_CAL_LANG_EACHYEAR", "Ka¿dy rok");
DEFINE("_CAL_LANG_ONLYDAYS", "Tylko wybrane dni");
DEFINE("_CAL_LANG_EACH", "Ka¿dy");
DEFINE("_CAL_LANG_EACHOF","w ka¿dy");
DEFINE("_CAL_LANG_ENDMONTH", "koniec miesi±ca");

// Repeat days
DEFINE("_CAL_LANG_BYDAYNUMBER", "Przez ile dni");

// User type
DEFINE("_CAL_LANG_ANONYME", "Anonimowy");

// Post
//PAS D'ACCENTS DANS LES _ACT_
DEFINE("_CAL_LANG_ACT_ADDED", "Dziêkujemy za Twoj± propozycjê - zweryfikujemy j±!"); //NO ACCENT !!
DEFINE("_CAL_LANG_ACT_MODIFIED", "To wydarzenie zosta³o zmodyfikowane."); //NO ACCENT !!
DEFINE("_CAL_LANG_ACT_PUBLISHED", "To wydarzenie zosta³o opublikowane.");  //NEW 1.4
DEFINE("_CAL_LANG_ACT_DELETED", "To wydarzenie zosta³o skasowane!"); //NO ACCENT !!
DEFINE("_CAL_LANG_NOPERMISSION", "Nie masz dostêpu do tych zasobów !"); //NO ACCENT !!

DEFINE("_CAL_LANG_MAIL_ADDED", "Nowe publikacje na");
DEFINE("_CAL_LANG_MAIL_MODIFIED", "Nowe modyfikacje na");

// Presentation
DEFINE("_CAL_LANG_BY", "Przez");
DEFINE("_CAL_LANG_FROM", "Z");
DEFINE("_CAL_LANG_TO", "Do");
DEFINE("_CAL_LANG_ARCHIVE", "Archiwum");
DEFINE("_CAL_LANG_WEEK", "tydzieñ");
DEFINE("_CAL_LANG_NO_EVENTS", "Brak wydarzeñ");
DEFINE("_CAL_LANG_NO_EVENTFOR", "Brak wydarzeñ w dniu");
DEFINE("_CAL_LANG_NO_EVENTFORTHE", "Brak wydarzeñ w dniu");
DEFINE("_CAL_LANG_THIS_DAY", "aktualny dzieñ");
DEFINE("_CAL_LANG_THIS_MONTH", "Aktualny miesi±c");
DEFINE("_CAL_LANG_LAST_MONTH", "Ostatni miesi±c");
DEFINE("_CAL_LANG_NEXT_MONTH", "Nastêpny miesi±c");
DEFINE("_CAL_LANG_EVENTSFOR", "Wydarzenia - ");
DEFINE("_CAL_LANG_SEARCHRESULTS", "Rezultat wyszukiwania dla frazy:"); // new 1.4
DEFINE("_CAL_LANG_EVENTSFORTHE", "Wydarzenia - ");
DEFINE("_CAL_LANG_REP_DAY", "dzieñ");
DEFINE("_CAL_LANG_REP_WEEK", "tydzieñ");
DEFINE("_CAL_LANG_REP_WEEKPAIR", "parzysty tydzieñ");
DEFINE("_CAL_LANG_REP_WEEKIMPAIR", "nieparzysty tydzieñ");
DEFINE("_CAL_LANG_REP_MONTH", "miesi±c");
DEFINE("_CAL_LANG_REP_YEAR", "rok");
DEFINE("_CAL_LANG_REP_NOEVENTSELECTED", "Najpierw wybierz wydarzenie");

// Navigation
DEFINE("_CAL_LANG_VIEWTODAY", "Zobacz dzisiejsze");
DEFINE("_CAL_LANG_VIEWTOCOME", "W nadchodz±cym miesi±cu");
DEFINE("_CAL_LANG_VIEWBYDAY", "Widok dnia");
DEFINE("_CAL_LANG_VIEWBYCAT", "Widok kategorii");
DEFINE("_CAL_LANG_VIEWBYMONTH", "Widok miesi±ca");
DEFINE("_CAL_LANG_VIEWBYYEAR", "Widok roku");
DEFINE("_CAL_LANG_VIEWBYWEEK", "Widok tygodnia");
DEFINE("_CAL_LANG_JUMPTO", "Wska¿ miesi±c");  // New 1.4
DEFINE("_CAL_LANG_BACK", "Wróæ");
DEFINE("_CAL_LANG_CLOSE", "Zamknij");
DEFINE("_CAL_LANG_PREVIOUSDAY", "Poprzedni dzieñ");
DEFINE("_CAL_LANG_PREVIOUSWEEK", "Poprzedni tydzieñ");
DEFINE("_CAL_LANG_PREVIOUSMONTH", "Poprzedni miesi±c");
DEFINE("_CAL_LANG_PREVIOUSYEAR", "Poprzedni rok");
DEFINE("_CAL_LANG_NEXTDAY", "Nastêpny dzieñ");
DEFINE("_CAL_LANG_NEXTWEEK", "Nastêpny tydzieñ");
DEFINE("_CAL_LANG_NEXTMONTH", "Nastêpny miesi±c");
DEFINE("_CAL_LANG_NEXTYEAR", "Nastêpny rok");

DEFINE("_CAL_LANG_ADMINPANEL", "Panel administratora");
DEFINE("_CAL_LANG_ADDEVENT", "Dodaj wydarzenie");
DEFINE("_CAL_LANG_MYEVENTS", "Moje wydarzenia");
DEFINE("_CAL_LANG_DELETE", "Usuñ");
DEFINE("_CAL_LANG_MODIFY", "Edycja");

// Form
DEFINE("_CAL_LANG_HELP", "Pomoc");

DEFINE("_CAL_LANG_CAL_TITLE", "Wydarzenia");
DEFINE("_CAL_LANG_ADD_TITLE", "Dodaj");
DEFINE("_CAL_LANG_MODIFY_TITLE", "Edycja");

DEFINE("_CAL_LANG_REPEAT_DISABLED", "Powtarzanie jest mo¿liwe tylko gdy data zakoñczenia jest inna ni¿ data pocz±tkowa. Zmieñ datê zakoñczenia aby móc skonfigurowaæ powtarzanie."); // New for 1.4
DEFINE("_CAL_LANG_EVENT_TITLE", "Temat");
DEFINE("_CAL_LANG_EVENT_COLOR", "Kolor");
DEFINE("_CAL_LANG_EVENT_CATCOLOR", "U¿yj koloru kategorii");
DEFINE("_CAL_LANG_EVENT_CATEGORY", "Kategorie");
DEFINE("_CAL_LANG_EVENT_CHOOSE_CATEG", "Wybierz kategoriê");
DEFINE("_CAL_LANG_EVENT_ACTIVITY", "Aktywno¶æ");
DEFINE("_CAL_LANG_EVENT_URLMAIL_INFO", "Aby dodaæ URL lub adres email, napisz <br><u>http://www.mysite.com</u> lub <u>mailto:my@mail.com</u>");
DEFINE("_CAL_LANG_EVENT_ADRESSE", "Miejsce");
DEFINE("_CAL_LANG_EVENT_CONTACT", "Kontakt");
DEFINE("_CAL_LANG_EVENT_EXTRA", "Informacje dodatkowe");
DEFINE("_CAL_LANG_EVENT_AUTHOR_ALIAS", "Autor (alias)");
DEFINE("_CAL_LANG_EVENT_STARTDATE", "Data rozpoczêcia");
DEFINE("_CAL_LANG_EVENT_ENDDATE", "Data zakoñczenia");
DEFINE("_CAL_LANG_EVENT_STARTHOURS", "Godzina rozpoczêcia");
DEFINE("_CAL_LANG_EVENT_ENDHOURS", "Godzina zakoñczenia");
DEFINE("_CAL_LANG_EVENT_STARTTIME", "Godzina rozpoczêcia");
DEFINE("_CAL_LANG_EVENT_ENDTIME", "Godzina zakoñczenia");
DEFINE("_CAL_LANG_PUB_INFO", "Publikowane informacje");
DEFINE("_CAL_LANG_EVENT_REPEATTYPE", "Typ powtórzenia");
DEFINE("_CAL_LANG_EVENT_REPEATDAY", "Dzieñ powtórzenia");
DEFINE("_CAL_LANG_EVENT_CHOOSE_WEEKDAYS", "Dzieñ tygodnia");
DEFINE("_CAL_LANG_EVENT_PER", "na");
DEFINE("_CAL_LANG_EVENT_WEEKOPT", "Które tygodnie w miesi±cu");

DEFINE("_CAL_LANG_SUBMITPREVIEW", "Podgl±d");
DEFINE("_CAL_LANG_SUBMITCANCEL", "Anuluj");
DEFINE("_CAL_LANG_SUBMITSAVE", "Zapisz");

DEFINE("_CAL_LANG_E_WARNWEEKS", "Wybierz tydzieñ.");
DEFINE("_CAL_LANG_E_WARNDAYS", "Wybierz dzieñ.");

// Admin
DEFINE("_CAL_LANG_EVENT_ALLCAT", "Wszystkie kategorie");
DEFINE("_CAL_LANG_EVENT_ACCESSLEVEL", "Poziom dostêpu");
DEFINE("_CAL_LANG_EVENT_HITS", "Wybrañ");
DEFINE("_CAL_LANG_EVENT_STATE", "Stan");
DEFINE("_CAL_LANG_EVENT_CREATED", "Stworzone");
DEFINE("_CAL_LANG_EVENT_NEWEVENT", "Nowe wydarzenie");
DEFINE("_CAL_LANG_EVENT_MODIFIED", "Ostatnio modyfikowany");
DEFINE("_CAL_LANG_EVENT_NOTMODIFIED", "Nie modyfikowany");

// dmcd aug 22/04  new warning alert for no specified activity in event entry
DEFINE("_CAL_LANG_WARNACTIVITY", "Some sort of Activity\\ndescription must be entered.");

DEFINE("_CAL_LEGEND_ALL_CATEGORIES", "Wszystkie kategorie ...");  // new for 1.4
DEFINE("_CAL_LEGEND_ALL_CATEGORIES_DESC", "Wydarzenia we wszystkich kategoriach");  // new for 1.4

DEFINE("_CAL_LANG_FORM_HELP_COLOR", <<<END
        <tr>
		  <td width="110" align="left" valign="top">
            <b>Kolor</b>
          </td>
		  <td>Wybierz kolor t³a który bêdzie widoczny w widoku miesiêcznym kalendarza. Je¿eli pole wyboru Kategorii jest zaznaczone, wtedy kolor bêdzie domy¶lnym kolorem tej kategorii
		  (zdefiniowanym przez administratora serwisu) wybranym w zak³adce Tre¶ci danego wydarzenia i wybranie koloru bedzie niemo¿liwe.</td>
        </tr>
END
);

DEFINE("_CAL_LANG_FORM_HELP",  <<<END
    	<tr>
          <td align="left"><b>Data</b></td>
          <td>Wybierz date Rozpoczêcia i Zakoñczenia wydarzenia.</td>
        </tr>
    	<tr>
          <td align="left" valign="top"><b>Czas</b></td>
          <td>Wybierz pore dnia wybranego wydarzenia.  Format: <span style='font-weight:bold;'>hh:mm {am|pm}</span>.<br/>
             Czas mo¿e byæ wybrany w 12 i 24 godzinnym systemie czasowym.<br/><br/>
             <b><i><span style='color:red;'>(Nowe)</span></i> Pamiêtaj</b>, ¿e w specjalnych przypadkach czyli kiedy tworzysz<span style='color:red;font-weight:bold;'>pojedyñcze wydarzenie ca³onocne</span>.  Np. Pojedyñcze wydarzenie Zaczynaj±ce siê o 19:00 i koñcz±ce siê o 3:00 w nocy, Data Rozpoczêcia i Zakoñczenia <b>MUSI</b> byæ&nbsp;
		   t± sam± dat±, i powinna byæ ustawiona na date odpowiedni± do dnia przed pó³noc±.</td>
        </tr>
END
);

DEFINE("_CAL_LANG_FORM_HELP_EXTENDED",  <<<END
        <tr>
    	  <td align="left" valign="top" nowrap><b>Rodzaj powtarzania</b></td>
  	  	<td colspan="2"></td>
  		</tr>
  		<tr>
    	  <td colspan="2" align="left" valign="top">
	    	<table width="100%" border="0" cellspacing="2">
              <tr>
                <td width="60" align="left" valign="top"><u>Dziennie</u></td>
                <td width="110" align="left" valign="top" class="frm_td_bydays">
                  <font color="#000000">Ka¿dy dzieñ<br/><i>(domy¶lnie)</i></font>
                </td>
                <td align="left" valign="top" class="frm_td_bydays">
                  <font color="#000000">Choose this option for a non-reoccurring single or multi-day event, with a new event occurrence for every day within the Start and End Date range</font>
						<font color="#000000">Wybierz ta opcje dla </font>
                </td>
              </tr>
              <tr>
                <td width="60" rowspan="3" align="left" valign="top"><u>Tygodniowo</u></td>
                <td width="110" align="left" valign="top" class="frm_td_byweeks">
                  <font color="#000000">
                    Raz na tydzieñ
                  </font>
                </td>
                <td align="left" valign="top" class="frm_td_byweeks">
                  <font color="#000000">
                  Ta opcja pozwala na wybrania dnia tygodnia powtarzania sie wydarzenia.
                  <table border="0" width="100%" height="100%"><tr><td><b>Numer dnia</b> wpisz np. 10/../2003</td></tr><tr><td><b>Nazwa dnia</b> wpisz np. Poniedzia³ek</td></tr></table>
                  </font>
                </td>
              </tr>
              <tr>
                <td width="110" align="left" valign="top" class="frm_td_byweeks">
                  <font color="#000000">
                    Wiele dni tygodnia na tydzieñ.
                  </font>
                </td>
                <td align="left" valign="top" class="frm_td_byweeks">
                  <font color="#000000">Ta opcja pozwala na wybranie dni tygodnia w których wydarzenie bedzie widoczne</font>
                </td>
              </tr>
              <tr>
                <td width="110" align="left" valign="top" class="frm_td_byweeks">
                  <font color="#000000"><i>Tygodnie miesi±ca # <br>Dla opcji 'Raz na tydzieñ' i 'Wiele dni w tygodniu' wy¿ej</i></font></td>
                  <td align="left" valign="top" class="frm_td_byweeks">
                  <font color="#000000">
                  <table border="0" width="100%" height="100%">
                    <tr><td><b>Week 1 :</b> Pierwszy tydzieñ tygodnia</td></tr>
                    <tr><td><b>Week 2 :</b> Drugi tydzieñ tygodnia</td></tr>
                    <tr><td><b>Week 3 :</b> Trzeci tydzieñ tygodnia</td></tr>
                    <tr><td><b>Week 4 :</b> Czwarty tydzieñ tygodnia</td></tr>
                    <tr><td><b>Week 5 :</b> Pi±ty tydzieñ tygodnia (je¶li mo¿liwe)</td></tr>
                   </table>
                 </font>
                </td>
              </tr>
              <tr>
                <td width="60" rowspan="2" align="left" valign="top"><u>Miesiêcznie</u></td>
                <td width="110" align="left" valign="top" class="frm_td_bymonth">
                  <font color="#000000">Raz na miesi±c</font></td>
                <td align="left" valign="top" class="frm_td_bymonth">
                  <font color="#000000">
                     Ta opcja pozwala na wybranie dnia powtarzania siê wydarzenia w wybranym miesi±cu.
                     <table border="0" width="100%" height="100%"><tr><td><b>Numer dnia</b> wpisz np. 10/../2003</td></tr><tr><td><b>Nazwa dnia</b> fwpisz np. Poniedzia³ek</td></tr></table>

                  </font>
                </td>
              </tr>
              <tr>
                <td width="110" align="left" valign="top" class="frm_td_bymonth">
                  <font color="#000000">
                  Koniec ka¿dego miesi±ca
                  </font>
                </td>
                <td align="left" valign="top" class="frm_td_bymonth">
                  <font color="#000000">
				   The event is on the last day of each month independently of the day number, if that last day
		falls within the date range specified by the Start and End Dates for the event.
                  </font>
						<font color="#000000">
				  To wydarzenie odbywa siê ostatniego dnia ka¿dego miesi±ca niezale¿nie od numeru dnia, je¿eli ostatni dzieñ
				  wypada w ci±gu okresu okre¶lonego przez daty Rozpoczêcia i Zakñczenia wydarzenia.
                  </font>
                </td>
              </tr>
              <tr>
                <td width="60" rowspan="2" align="left" valign="top"><u>By Year</u></td>
                <td width="110" align="left" valign="top" class="frm_td_byyear">
                  <font color="#000000">
                  Raz na rok
                  </font>
                </td>
                <td align="left" valign="top" class="frm_td_byyear">
                  <font color="#000000">
                  Ta opcja pozwala na wybranie pojedyñczego dnia w roku.
                  <table border="0" width="100%" height="100%"><tr><td><b>Numer dnia</b> wpisz np. 10/../2003</td></tr><tr><td><b>Nazwa dnia</b> wpisz np. Poniedzia³ek</td></tr></table>
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
