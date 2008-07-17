<?php
/**
 * Events Component for Joomla 1.0.x
 *
 * @version     $Id: polish-utf8.php 991 2008-03-10 19:55:48Z tstahl $
 * @package     Events
 * @copyright   Copyright (C) 2006-2008 JEvents Project Group
 * @licence     http://www.gnu.org/copyleft/gpl.html
 * @link        http://forge.joomla.org/sf/projects/jevents
 * @Translate   Jakub Dirska http://www.webir.eu
 * @encoding    utf-8
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
define("_CAL_LANG_CLICK_TO_OPEN_EVENT",	"Kliknij aby otworzyć wydarzenie");
define("_CAL_LANG_UNPUBLISHED",		"** Nieopublikowane **");
define("_CAL_LANG_DESCRIPTION",		"Opis");
define("_CAL_LANG_EMAIL_TO_AUTHOR",	"Wyślij email do autora");
define("_CAL_LANG_MAIL_TO_ADMIN",		"Wydarzenie wpisane przez [ %s ] by [ %s ]");
define("_CAL_LANG_KEYWORD_NOT_VALID",	"Niepoprawna fraza wyszukiwania");
define("_CAL_LANG_EVENT_CALENDAR",		"Kalendarz wydarzeń"); // new 1.4

// modul
define("_CAL_LANG_ERR_NO_MOD_CAL",		"Kalendarz wydarzeń\n<br />Moduł wymaga zainstalowanego komponentu JEvents");
define("_CAL_LANG_CLICK_TOSWITCH_DAY",	"Idź do kalendarza - dzisiaj");
define("_CAL_LANG_CLICK_TOSWITCH_MON",	"Idź do kalendarza - obecny miesiąc");
define("_CAL_LANG_CLICK_TOSWITCH_YEAR",	"Idź do kalendarza - obecny rok");
define("_CAL_LANG_CLICK_TOSWITCH_PY",	"Idź do kalendarza - poprzedni rok");
define("_CAL_LANG_CLICK_TOSWITCH_PM",	"Idź do kalendarza - poprzedni miesiąc");
define("_CAL_LANG_CLICK_TOSWITCH_NM",	"Idź do kalendarza - następny miesiąc");
define("_CAL_LANG_CLICK_TOSWITCH_NY",	"Idź do kalendarza - następny rok");

// navTableNext
define("_CAL_LANG_NAV_TN_FIRST_LIST",	"Pierwsza lista");
define("_CAL_LANG_NAV_TN_PREV_LIST",	"Poprzednia lista");
define("_CAL_LANG_NAV_TN_NEXT_LIST",	"Następna lista");
define("_CAL_LANG_NAV_TN_LAST_LIST",	"Ostatnia lista");

// calendar monthly display
define("_CAL_LANG_FIRST_SINGLE_DAY_EVENT",		"Pojedyncze wydarzenie");
define("_CAL_LANG_FIRST_DAY_OF_MULTIEVENT",	"Pierwszy dzień wielodniowego wydarzenia");
define("_CAL_LANG_LAST_DAY_OF_MULTIEVENT",		"Ostatni dzień wielodniowego wydarzenia");
define("_CAL_LANG_MULTIDAY_EVENT",				"Wydarzenie wielodniowe");
/* ++++++ end mic +++++++++++++ */

// Months
DEFINE("_CAL_LANG_JANUARY", "Styczeń");
DEFINE("_CAL_LANG_FEBRUARY", "Luty");
DEFINE("_CAL_LANG_MARCH", "Marzec");
DEFINE("_CAL_LANG_APRIL", "Kwiecień");
DEFINE("_CAL_LANG_MAY", "Maj");
DEFINE("_CAL_LANG_JUNE", "Czerwiec");
DEFINE("_CAL_LANG_JULY", "Lipiec");
DEFINE("_CAL_LANG_AUGUST", "Sierpień");
DEFINE("_CAL_LANG_SEPTEMBER", "Wrzesień");
DEFINE("_CAL_LANG_OCTOBER", "Pażdziernik");
DEFINE("_CAL_LANG_NOVEMBER", "Listopad");
DEFINE("_CAL_LANG_DECEMBER", "Grudzień");

// Short day names
DEFINE("_CAL_LANG_SUN", "Nie");
DEFINE("_CAL_LANG_MON", "Pon");
DEFINE("_CAL_LANG_TUE", "Wto");
DEFINE("_CAL_LANG_WED", "Śro");
DEFINE("_CAL_LANG_THU", "Czw");
DEFINE("_CAL_LANG_FRI", "Pią");
DEFINE("_CAL_LANG_SAT", "Sob");

// Days
DEFINE("_CAL_LANG_SUNDAY", "Niedziela");
DEFINE("_CAL_LANG_MONDAY", "Poniedziałek");
DEFINE("_CAL_LANG_TUESDAY", "Wtorek");
DEFINE("_CAL_LANG_WEDNESDAY", "Środa");
DEFINE("_CAL_LANG_THURSDAY", "Czwartek");
DEFINE("_CAL_LANG_FRIDAY", "Piątek");
DEFINE("_CAL_LANG_SATURDAY", "Sobota");

// Days lettres
DEFINE("_CAL_LANG_SUNDAYSHORT", "N");
DEFINE("_CAL_LANG_MONDAYSHORT", "P");
DEFINE("_CAL_LANG_TUESDAYSHORT", "W");
DEFINE("_CAL_LANG_WEDNESDAYSHORT", "Ś");
DEFINE("_CAL_LANG_THURSDAYSHORT", "C");
DEFINE("_CAL_LANG_FRIDAYSHORT", "P");
DEFINE("_CAL_LANG_SATURDAYSHORT", "S");

// Repeat type
DEFINE("_CAL_LANG_ALLDAYS", "Każdego dnia");
DEFINE("_CAL_LANG_EACHWEEK", "Każdy tydzień");
DEFINE("_CAL_LANG_EACHWEEKPAIR", "Każdy parzysty tydzień");
DEFINE("_CAL_LANG_EACHWEEKIMPAIR", "Każdy nieparzysty tydzień");
DEFINE("_CAL_LANG_EACHMONTH", "Każdy miesiąc");
DEFINE("_CAL_LANG_EACHYEAR", "Każdy rok");
DEFINE("_CAL_LANG_ONLYDAYS", "Tylko wybrane dni");
DEFINE("_CAL_LANG_EACH", "Każdy");
DEFINE("_CAL_LANG_EACHOF","w każdy");
DEFINE("_CAL_LANG_ENDMONTH", "koniec miesiąca");

// Repeat days
DEFINE("_CAL_LANG_BYDAYNUMBER", "Przez ile dni");

// User type
DEFINE("_CAL_LANG_ANONYME", "Anonimowy");

// Post
//PAS D'ACCENTS DANS LES _ACT_
DEFINE("_CAL_LANG_ACT_ADDED", "Dziękujemy za Twoją propozycję - zweryfikujemy ją!"); //NO ACCENT !!
DEFINE("_CAL_LANG_ACT_MODIFIED", "To wydarzenie zostało zmodyfikowane."); //NO ACCENT !!
DEFINE("_CAL_LANG_ACT_PUBLISHED", "To wydarzenie zostało opublikowane.");  //NEW 1.4
DEFINE("_CAL_LANG_ACT_DELETED", "To wydarzenie zostało skasowane!"); //NO ACCENT !!
DEFINE("_CAL_LANG_NOPERMISSION", "Nie masz dostępu do tych zasobów !"); //NO ACCENT !!

DEFINE("_CAL_LANG_MAIL_ADDED", "Nowe publikacje na");
DEFINE("_CAL_LANG_MAIL_MODIFIED", "Nowe modyfikacje na");

// Presentation
DEFINE("_CAL_LANG_BY", "Przez");
DEFINE("_CAL_LANG_FROM", "Z");
DEFINE("_CAL_LANG_TO", "Do");
DEFINE("_CAL_LANG_ARCHIVE", "Archiwum");
DEFINE("_CAL_LANG_WEEK", "tydzień");
DEFINE("_CAL_LANG_NO_EVENTS", "Brak wydarzeń");
DEFINE("_CAL_LANG_NO_EVENTFOR", "Brak wydarzeń w dniu");
DEFINE("_CAL_LANG_NO_EVENTFORTHE", "Brak wydarzeń w dniu");
DEFINE("_CAL_LANG_THIS_DAY", "aktualny dzień");
DEFINE("_CAL_LANG_THIS_MONTH", "Aktualny miesiąc");
DEFINE("_CAL_LANG_LAST_MONTH", "Ostatni miesiąc");
DEFINE("_CAL_LANG_NEXT_MONTH", "Następny miesiąc");
DEFINE("_CAL_LANG_EVENTSFOR", "Wydarzenia - ");
DEFINE("_CAL_LANG_SEARCHRESULTS", "Rezultat wyszukiwania dla frazy:"); // new 1.4
DEFINE("_CAL_LANG_EVENTSFORTHE", "Wydarzenia - ");
DEFINE("_CAL_LANG_REP_DAY", "dzień");
DEFINE("_CAL_LANG_REP_WEEK", "tydzień");
DEFINE("_CAL_LANG_REP_WEEKPAIR", "parzysty tydzień");
DEFINE("_CAL_LANG_REP_WEEKIMPAIR", "nieparzysty tydzień");
DEFINE("_CAL_LANG_REP_MONTH", "miesiąc");
DEFINE("_CAL_LANG_REP_YEAR", "rok");
DEFINE("_CAL_LANG_REP_NOEVENTSELECTED", "Najpierw wybierz wydarzenie");

// Navigation
DEFINE("_CAL_LANG_VIEWTODAY", "Zobacz dzisiejsze");
DEFINE("_CAL_LANG_VIEWTOCOME", "W nadchodzącym miesiącu");
DEFINE("_CAL_LANG_VIEWBYDAY", "Widok dnia");
DEFINE("_CAL_LANG_VIEWBYCAT", "Widok kategorii");
DEFINE("_CAL_LANG_VIEWBYMONTH", "Widok miesiąca");
DEFINE("_CAL_LANG_VIEWBYYEAR", "Widok roku");
DEFINE("_CAL_LANG_VIEWBYWEEK", "Widok tygodnia");
DEFINE("_CAL_LANG_JUMPTO", "Wskaż miesiąc");  // New 1.4
DEFINE("_CAL_LANG_BACK", "Wróć");
DEFINE("_CAL_LANG_CLOSE", "Zamknij");
DEFINE("_CAL_LANG_PREVIOUSDAY", "Poprzedni dzień");
DEFINE("_CAL_LANG_PREVIOUSWEEK", "Poprzedni tydzień");
DEFINE("_CAL_LANG_PREVIOUSMONTH", "Poprzedni miesiąc");
DEFINE("_CAL_LANG_PREVIOUSYEAR", "Poprzedni rok");
DEFINE("_CAL_LANG_NEXTDAY", "Następny dzień");
DEFINE("_CAL_LANG_NEXTWEEK", "Następny tydzień");
DEFINE("_CAL_LANG_NEXTMONTH", "Następny miesiąc");
DEFINE("_CAL_LANG_NEXTYEAR", "Następny rok");

DEFINE("_CAL_LANG_ADMINPANEL", "Panel administratora");
DEFINE("_CAL_LANG_ADDEVENT", "Dodaj wydarzenie");
DEFINE("_CAL_LANG_MYEVENTS", "Moje wydarzenia");
DEFINE("_CAL_LANG_DELETE", "Usuń");
DEFINE("_CAL_LANG_MODIFY", "Edycja");

// Form
DEFINE("_CAL_LANG_HELP", "Pomoc");

DEFINE("_CAL_LANG_CAL_TITLE", "Wydarzenia");
DEFINE("_CAL_LANG_ADD_TITLE", "Dodaj");
DEFINE("_CAL_LANG_MODIFY_TITLE", "Edycja");

DEFINE("_CAL_LANG_REPEAT_DISABLED", "Powtarzanie jest możliwe tylko gdy data zakończenia jest inna niż data początkowa. Zmień datę zakończenia aby móc skonfigurować powtarzanie."); // New for 1.4
DEFINE("_CAL_LANG_EVENT_TITLE", "Temat");
DEFINE("_CAL_LANG_EVENT_COLOR", "Kolor");
DEFINE("_CAL_LANG_EVENT_CATCOLOR", "Użyj koloru kategorii");
DEFINE("_CAL_LANG_EVENT_CATEGORY", "Kategorie");
DEFINE("_CAL_LANG_EVENT_CHOOSE_CATEG", "Wybierz kategorię");
DEFINE("_CAL_LANG_EVENT_ACTIVITY", "Aktywność");
DEFINE("_CAL_LANG_EVENT_URLMAIL_INFO", "Aby dodać URL lub adres email, napisz <br><u>http://www.mysite.com</u> lub <u>mailto:my@mail.com</u>");
DEFINE("_CAL_LANG_EVENT_ADRESSE", "Miejsce");
DEFINE("_CAL_LANG_EVENT_CONTACT", "Kontakt");
DEFINE("_CAL_LANG_EVENT_EXTRA", "Informacje dodatkowe");
DEFINE("_CAL_LANG_EVENT_AUTHOR_ALIAS", "Autor (alias)");
DEFINE("_CAL_LANG_EVENT_STARTDATE", "Data rozpoczęcia");
DEFINE("_CAL_LANG_EVENT_ENDDATE", "Data zakończenia");
DEFINE("_CAL_LANG_EVENT_STARTHOURS", "Godzina rozpoczęcia");
DEFINE("_CAL_LANG_EVENT_ENDHOURS", "Godzina zakończenia");
DEFINE("_CAL_LANG_EVENT_STARTTIME", "Godzina rozpoczęcia");
DEFINE("_CAL_LANG_EVENT_ENDTIME", "Godzina zakończenia");
DEFINE("_CAL_LANG_PUB_INFO", "Publikowane informacje");
DEFINE("_CAL_LANG_EVENT_REPEATTYPE", "Typ powtórzenia");
DEFINE("_CAL_LANG_EVENT_REPEATDAY", "Dzień powtórzenia");
DEFINE("_CAL_LANG_EVENT_CHOOSE_WEEKDAYS", "Dzień tygodnia");
DEFINE("_CAL_LANG_EVENT_PER", "na");
DEFINE("_CAL_LANG_EVENT_WEEKOPT", "Które tygodnie w miesiącu");

DEFINE("_CAL_LANG_SUBMITPREVIEW", "Podgląd");
DEFINE("_CAL_LANG_SUBMITCANCEL", "Anuluj");
DEFINE("_CAL_LANG_SUBMITSAVE", "Zapisz");

DEFINE("_CAL_LANG_E_WARNWEEKS", "Wybierz tydzień.");
DEFINE("_CAL_LANG_E_WARNDAYS", "Wybierz dzień.");

// Admin
DEFINE("_CAL_LANG_EVENT_ALLCAT", "Wszystkie kategorie");
DEFINE("_CAL_LANG_EVENT_ACCESSLEVEL", "Poziom dostępu");
DEFINE("_CAL_LANG_EVENT_HITS", "Wybrań");
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
		  <td>Wybierz kolor tła który będzie widoczny w widoku miesięcznym kalendarza. Jeżeli pole wyboru Kategorii jest zaznaczone, wtedy kolor będzie domyślnym kolorem tej kategorii
		  (zdefiniowanym przez administratora serwisu) wybranym w zakładce Treści danego wydarzenia i wybranie koloru bedzie niemożliwe.</td>
        </tr>
END
);

DEFINE("_CAL_LANG_FORM_HELP",  <<<END
    	<tr>
          <td align="left"><b>Data</b></td>
          <td>Wybierz date Rozpoczęcia i Zakończenia wydarzenia.</td>
        </tr>
    	<tr>
          <td align="left" valign="top"><b>Czas</b></td>
          <td>Wybierz pore dnia wybranego wydarzenia.  Format: <span style='font-weight:bold;'>hh:mm {am|pm}</span>.<br/>
             Czas może być wybrany w 12 i 24 godzinnym systemie czasowym.<br/><br/>
             <b><i><span style='color:red;'>(Nowe)</span></i> Pamiętaj</b>, że w specjalnych przypadkach czyli kiedy tworzysz<span style='color:red;font-weight:bold;'>pojedyńcze wydarzenie całonocne</span>.  Np. Pojedyńcze wydarzenie Zaczynające się o 19:00 i kończące się o 3:00 w nocy, Data Rozpoczęcia i Zakończenia <b>MUSI</b> być&nbsp;
		   tą samą datą, i powinna być ustawiona na date odpowiednią do dnia przed północą.</td>
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
                  <font color="#000000">Każdy dzień<br/><i>(domyślnie)</i></font>
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
                    Raz na tydzień
                  </font>
                </td>
                <td align="left" valign="top" class="frm_td_byweeks">
                  <font color="#000000">
                  Ta opcja pozwala na wybrania dnia tygodnia powtarzania sie wydarzenia.
                  <table border="0" width="100%" height="100%"><tr><td><b>Numer dnia</b> wpisz np. 10/../2003</td></tr><tr><td><b>Nazwa dnia</b> wpisz np. Poniedziałek</td></tr></table>
                  </font>
                </td>
              </tr>
              <tr>
                <td width="110" align="left" valign="top" class="frm_td_byweeks">
                  <font color="#000000">
                    Wiele dni tygodnia na tydzień.
                  </font>
                </td>
                <td align="left" valign="top" class="frm_td_byweeks">
                  <font color="#000000">Ta opcja pozwala na wybranie dni tygodnia w których wydarzenie bedzie widoczne</font>
                </td>
              </tr>
              <tr>
                <td width="110" align="left" valign="top" class="frm_td_byweeks">
                  <font color="#000000"><i>Tygodnie miesiąca # <br>Dla opcji 'Raz na tydzień' i 'Wiele dni w tygodniu' wyżej</i></font></td>
                  <td align="left" valign="top" class="frm_td_byweeks">
                  <font color="#000000">
                  <table border="0" width="100%" height="100%">
                    <tr><td><b>Week 1 :</b> Pierwszy tydzień tygodnia</td></tr>
                    <tr><td><b>Week 2 :</b> Drugi tydzień tygodnia</td></tr>
                    <tr><td><b>Week 3 :</b> Trzeci tydzień tygodnia</td></tr>
                    <tr><td><b>Week 4 :</b> Czwarty tydzień tygodnia</td></tr>
                    <tr><td><b>Week 5 :</b> Piąty tydzień tygodnia (jeśli możliwe)</td></tr>
                   </table>
                 </font>
                </td>
              </tr>
              <tr>
                <td width="60" rowspan="2" align="left" valign="top"><u>Miesięcznie</u></td>
                <td width="110" align="left" valign="top" class="frm_td_bymonth">
                  <font color="#000000">Raz na miesiąc</font></td>
                <td align="left" valign="top" class="frm_td_bymonth">
                  <font color="#000000">
                     Ta opcja pozwala na wybranie dnia powtarzania się wydarzenia w wybranym miesiącu.
                     <table border="0" width="100%" height="100%"><tr><td><b>Numer dnia</b> wpisz np. 10/../2003</td></tr><tr><td><b>Nazwa dnia</b> fwpisz np. Poniedziałek</td></tr></table>

                  </font>
                </td>
              </tr>
              <tr>
                <td width="110" align="left" valign="top" class="frm_td_bymonth">
                  <font color="#000000">
                  Koniec każdego miesiąca
                  </font>
                </td>
                <td align="left" valign="top" class="frm_td_bymonth">
                  <font color="#000000">
				   The event is on the last day of each month independently of the day number, if that last day
		falls within the date range specified by the Start and End Dates for the event.
                  </font>
						<font color="#000000">
				  To wydarzenie odbywa się ostatniego dnia każdego miesiąca niezależnie od numeru dnia, jeżeli ostatni dzień
				  wypada w ciągu okresu określonego przez daty Rozpoczęcia i Zakńczenia wydarzenia.
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
                  Ta opcja pozwala na wybranie pojedyńczego dnia w roku.
                  <table border="0" width="100%" height="100%"><tr><td><b>Numer dnia</b> wpisz np. 10/../2003</td></tr><tr><td><b>Nazwa dnia</b> wpisz np. Poniedziałek</td></tr></table>
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
