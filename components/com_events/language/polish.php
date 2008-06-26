<?php
/**
 * Events Component for Joomla 1.0.x
 *
 * @version     $Id: polish.php 880 2007-10-31 19:16:08Z tstahl $
 * @package     Events
 * @copyright   Copyright (C) 2006 JEvents Project Group
 * @licence     http://www.gnu.org/copyleft/gpl.html
 * @link        http://forge.joomla.org/sf/projects/jevents
 * @Translate   Jakub Dirska http://www.webir.eu
 */

defined( '_JEXEC' ) or die( 'Restricted access' );

//Check
DEFINE("_CAL_LANG_INCLUDED", 1);

// new 1.4.0 [mic]
define("_CAL_LANG_LNG",				"pl"); // de|fr|etc... [ DO NOT CHANGE THIS VALUE! ]

// used for colorpicker
define("_CAL_LANG_NO_COLOR",			"Kolor");
define("_CAL_LANG_COLOR_PICKER",		"Wyb�r koloru");

// common
define("_CAL_LANG_TIME",				"Godzina");
define("_CAL_LANG_CLICK_TO_OPEN_EVENT",	"Kliknij aby otworzy� wydarzenie");
define("_CAL_LANG_UNPUBLISHED",		"** Nieopublikowane **");
define("_CAL_LANG_DESCRIPTION",		"Opis");
define("_CAL_LANG_EMAIL_TO_AUTHOR",	"Wy�lij email do autora");
define("_CAL_LANG_MAIL_TO_ADMIN",		"Wydarzenie wpisane przez [ %s ] by [ %s ]");
define("_CAL_LANG_KEYWORD_NOT_VALID",	"Niepoprawna fraza wyszukiwania");
define("_CAL_LANG_EVENT_CALENDAR",		"Kalendarz wydarze�"); // new 1.4

// modul
define("_CAL_LANG_ERR_NO_MOD_CAL",		"Kalendarz wydarze�\n<br />Modu� wymaga zainstalowanego komponentu JEvents");
define("_CAL_LANG_CLICK_TOSWITCH_DAY",	"Id� do kalendarza - dzisiaj");
define("_CAL_LANG_CLICK_TOSWITCH_MON",	"Id� do kalendarza - obecny miesi�c");
define("_CAL_LANG_CLICK_TOSWITCH_YEAR",	"Id� do kalendarza - obecny rok");
define("_CAL_LANG_CLICK_TOSWITCH_PY",	"Id� do kalendarza - poprzedni rok");
define("_CAL_LANG_CLICK_TOSWITCH_PM",	"Id� do kalendarza - poprzedni miesi�c");
define("_CAL_LANG_CLICK_TOSWITCH_NM",	"Id� do kalendarza - nast�pny miesi�c");
define("_CAL_LANG_CLICK_TOSWITCH_NY",	"Id� do kalendarza - nast�pny rok");

// navTableNext
define("_CAL_LANG_NAV_TN_FIRST_LIST",	"Pierwsza lista");
define("_CAL_LANG_NAV_TN_PREV_LIST",	"Poprzednia lista");
define("_CAL_LANG_NAV_TN_NEXT_LIST",	"Nast�pna lista");
define("_CAL_LANG_NAV_TN_LAST_LIST",	"Ostatnia lista");

// calendar monthly display
define("_CAL_LANG_FIRST_SINGLE_DAY_EVENT",		"Pojedyncze wydarzenie");
define("_CAL_LANG_FIRST_DAY_OF_MULTIEVENT",	"Pierwszy dzie� wielodniowego wydarzenia");
define("_CAL_LANG_LAST_DAY_OF_MULTIEVENT",		"Ostatni dzie� wielodniowego wydarzenia");
define("_CAL_LANG_MULTIDAY_EVENT",				"Wydarzenie wielodniowe");
/* ++++++ end mic +++++++++++++ */

// Months
DEFINE("_CAL_LANG_JANUARY", "Stycze�");
DEFINE("_CAL_LANG_FEBRUARY", "Luty");
DEFINE("_CAL_LANG_MARCH", "Marzec");
DEFINE("_CAL_LANG_APRIL", "Kwiecie�");
DEFINE("_CAL_LANG_MAY", "Maj");
DEFINE("_CAL_LANG_JUNE", "Czerwiec");
DEFINE("_CAL_LANG_JULY", "Lipiec");
DEFINE("_CAL_LANG_AUGUST", "Sierpie�");
DEFINE("_CAL_LANG_SEPTEMBER", "Wrzesie�");
DEFINE("_CAL_LANG_OCTOBER", "Pa�dziernik");
DEFINE("_CAL_LANG_NOVEMBER", "Listopad");
DEFINE("_CAL_LANG_DECEMBER", "Grudzie�");

// Short day names
DEFINE("_CAL_LANG_SUN", "Nie");
DEFINE("_CAL_LANG_MON", "Pon");
DEFINE("_CAL_LANG_TUE", "Wto");
DEFINE("_CAL_LANG_WED", "�ro");
DEFINE("_CAL_LANG_THU", "Czw");
DEFINE("_CAL_LANG_FRI", "Pi�");
DEFINE("_CAL_LANG_SAT", "Sob");

// Days
DEFINE("_CAL_LANG_SUNDAY", "Niedziela");
DEFINE("_CAL_LANG_MONDAY", "Poniedzia�ek");
DEFINE("_CAL_LANG_TUESDAY", "Wtorek");
DEFINE("_CAL_LANG_WEDNESDAY", "�roda");
DEFINE("_CAL_LANG_THURSDAY", "Czwartek");
DEFINE("_CAL_LANG_FRIDAY", "Pi�tek");
DEFINE("_CAL_LANG_SATURDAY", "Sobota");

// Days lettres
DEFINE("_CAL_LANG_SUNDAYSHORT", "N");
DEFINE("_CAL_LANG_MONDAYSHORT", "P");
DEFINE("_CAL_LANG_TUESDAYSHORT", "W");
DEFINE("_CAL_LANG_WEDNESDAYSHORT", "�");
DEFINE("_CAL_LANG_THURSDAYSHORT", "C");
DEFINE("_CAL_LANG_FRIDAYSHORT", "P");
DEFINE("_CAL_LANG_SATURDAYSHORT", "S");

// Repeat type
DEFINE("_CAL_LANG_ALLDAYS", "Ka�dego dnia");
DEFINE("_CAL_LANG_EACHWEEK", "Ka�dy tydzie�");
DEFINE("_CAL_LANG_EACHWEEKPAIR", "Ka�dy parzysty tydzie�");
DEFINE("_CAL_LANG_EACHWEEKIMPAIR", "Ka�dy nieparzysty tydzie�");
DEFINE("_CAL_LANG_EACHMONTH", "Ka�dy miesi�c");
DEFINE("_CAL_LANG_EACHYEAR", "Ka�dy rok");
DEFINE("_CAL_LANG_ONLYDAYS", "Tylko wybrane dni");
DEFINE("_CAL_LANG_EACH", "Ka�dy");
DEFINE("_CAL_LANG_EACHOF","w ka�dy");
DEFINE("_CAL_LANG_ENDMONTH", "koniec miesi�ca");

// Repeat days
DEFINE("_CAL_LANG_BYDAYNUMBER", "Przez ile dni");

// User type
DEFINE("_CAL_LANG_ANONYME", "Anonimowy");

// Post
//PAS D'ACCENTS DANS LES _ACT_
DEFINE("_CAL_LANG_ACT_ADDED", "Dzi�kujemy za Twoj� propozycj� - zweryfikujemy j�!"); //NO ACCENT !!
DEFINE("_CAL_LANG_ACT_MODIFIED", "To wydarzenie zosta�o zmodyfikowane."); //NO ACCENT !!
DEFINE("_CAL_LANG_ACT_PUBLISHED", "To wydarzenie zosta�o opublikowane.");  //NEW 1.4
DEFINE("_CAL_LANG_ACT_DELETED", "To wydarzenie zosta�o skasowane!"); //NO ACCENT !!
DEFINE("_CAL_LANG_NOPERMISSION", "Nie masz dost�pu do tych zasob�w !"); //NO ACCENT !!

DEFINE("_CAL_LANG_MAIL_ADDED", "Nowe publikacje na");
DEFINE("_CAL_LANG_MAIL_MODIFIED", "Nowe modyfikacje na");

// Presentation
DEFINE("_CAL_LANG_BY", "Przez");
DEFINE("_CAL_LANG_FROM", "Z");
DEFINE("_CAL_LANG_TO", "Do");
DEFINE("_CAL_LANG_ARCHIVE", "Archiwum");
DEFINE("_CAL_LANG_WEEK", "tydzie�");
DEFINE("_CAL_LANG_NO_EVENTS", "Brak wydarze�");
DEFINE("_CAL_LANG_NO_EVENTFOR", "Brak wydarze� w dniu");
DEFINE("_CAL_LANG_NO_EVENTFORTHE", "Brak wydarze� w dniu");
DEFINE("_CAL_LANG_THIS_DAY", "aktualny dzie�");
DEFINE("_CAL_LANG_THIS_MONTH", "Aktualny miesi�c");
DEFINE("_CAL_LANG_LAST_MONTH", "Ostatni miesi�c");
DEFINE("_CAL_LANG_NEXT_MONTH", "Nast�pny miesi�c");
DEFINE("_CAL_LANG_EVENTSFOR", "Wydarzenia - ");
DEFINE("_CAL_LANG_SEARCHRESULTS", "Rezultat wyszukiwania dla frazy:"); // new 1.4
DEFINE("_CAL_LANG_EVENTSFORTHE", "Wydarzenia - ");
DEFINE("_CAL_LANG_REP_DAY", "dzie�");
DEFINE("_CAL_LANG_REP_WEEK", "tydzie�");
DEFINE("_CAL_LANG_REP_WEEKPAIR", "parzysty tydzie�");
DEFINE("_CAL_LANG_REP_WEEKIMPAIR", "nieparzysty tydzie�");
DEFINE("_CAL_LANG_REP_MONTH", "miesi�c");
DEFINE("_CAL_LANG_REP_YEAR", "rok");
DEFINE("_CAL_LANG_REP_NOEVENTSELECTED", "Najpierw wybierz wydarzenie");

// Navigation
DEFINE("_CAL_LANG_VIEWTODAY", "Zobacz dzisiejsze");
DEFINE("_CAL_LANG_VIEWTOCOME", "W nadchodz�cym miesi�cu");
DEFINE("_CAL_LANG_VIEWBYDAY", "Widok dnia");
DEFINE("_CAL_LANG_VIEWBYCAT", "Widok kategorii");
DEFINE("_CAL_LANG_VIEWBYMONTH", "Widok miesi�ca");
DEFINE("_CAL_LANG_VIEWBYYEAR", "Widok roku");
DEFINE("_CAL_LANG_VIEWBYWEEK", "Widok tygodnia");
DEFINE("_CAL_LANG_JUMPTO", "Wska� miesi�c");  // New 1.4
DEFINE("_CAL_LANG_BACK", "Wr��");
DEFINE("_CAL_LANG_CLOSE", "Zamknij");
DEFINE("_CAL_LANG_PREVIOUSDAY", "Poprzedni dzie�");
DEFINE("_CAL_LANG_PREVIOUSWEEK", "Poprzedni tydzie�");
DEFINE("_CAL_LANG_PREVIOUSMONTH", "Poprzedni miesi�c");
DEFINE("_CAL_LANG_PREVIOUSYEAR", "Poprzedni rok");
DEFINE("_CAL_LANG_NEXTDAY", "Nast�pny dzie�");
DEFINE("_CAL_LANG_NEXTWEEK", "Nast�pny tydzie�");
DEFINE("_CAL_LANG_NEXTMONTH", "Nast�pny miesi�c");
DEFINE("_CAL_LANG_NEXTYEAR", "Nast�pny rok");

DEFINE("_CAL_LANG_ADMINPANEL", "Panel administratora");
DEFINE("_CAL_LANG_ADDEVENT", "Dodaj wydarzenie");
DEFINE("_CAL_LANG_MYEVENTS", "Moje wydarzenia");
DEFINE("_CAL_LANG_DELETE", "Usu�");
DEFINE("_CAL_LANG_MODIFY", "Edycja");

// Form
DEFINE("_CAL_LANG_HELP", "Pomoc");

DEFINE("_CAL_LANG_CAL_TITLE", "Wydarzenia");
DEFINE("_CAL_LANG_ADD_TITLE", "Dodaj");
DEFINE("_CAL_LANG_MODIFY_TITLE", "Edycja");

DEFINE("_CAL_LANG_REPEAT_DISABLED", "Powtarzanie jest mo�liwe tylko gdy data zako�czenia jest inna ni� data pocz�tkowa. Zmie� dat� zako�czenia aby m�c skonfigurowa� powtarzanie."); // New for 1.4
DEFINE("_CAL_LANG_EVENT_TITLE", "Temat");
DEFINE("_CAL_LANG_EVENT_COLOR", "Kolor");
DEFINE("_CAL_LANG_EVENT_CATCOLOR", "U�yj koloru kategorii");
DEFINE("_CAL_LANG_EVENT_CATEGORY", "Kategorie");
DEFINE("_CAL_LANG_EVENT_CHOOSE_CATEG", "Wybierz kategori�");
DEFINE("_CAL_LANG_EVENT_ACTIVITY", "Aktywno��");
DEFINE("_CAL_LANG_EVENT_URLMAIL_INFO", "Aby doda� URL lub adres email, napisz <br><u>http://www.mysite.com</u> lub <u>mailto:my@mail.com</u>");
DEFINE("_CAL_LANG_EVENT_ADRESSE", "Miejsce");
DEFINE("_CAL_LANG_EVENT_CONTACT", "Kontakt");
DEFINE("_CAL_LANG_EVENT_EXTRA", "Informacje dodatkowe");
DEFINE("_CAL_LANG_EVENT_AUTHOR_ALIAS", "Autor (alias)");
DEFINE("_CAL_LANG_EVENT_STARTDATE", "Data rozpocz�cia");
DEFINE("_CAL_LANG_EVENT_ENDDATE", "Data zako�czenia");
DEFINE("_CAL_LANG_EVENT_STARTHOURS", "Godzina rozpocz�cia");
DEFINE("_CAL_LANG_EVENT_ENDHOURS", "Godzina zako�czenia");
DEFINE("_CAL_LANG_EVENT_STARTTIME", "Godzina rozpocz�cia");
DEFINE("_CAL_LANG_EVENT_ENDTIME", "Godzina zako�czenia");
DEFINE("_CAL_LANG_PUB_INFO", "Publikowane informacje");
DEFINE("_CAL_LANG_EVENT_REPEATTYPE", "Typ powt�rzenia");
DEFINE("_CAL_LANG_EVENT_REPEATDAY", "Dzie� powt�rzenia");
DEFINE("_CAL_LANG_EVENT_CHOOSE_WEEKDAYS", "Dzie� tygodnia");
DEFINE("_CAL_LANG_EVENT_PER", "na");
DEFINE("_CAL_LANG_EVENT_WEEKOPT", "Kt�re tygodnie w miesi�cu");

DEFINE("_CAL_LANG_SUBMITPREVIEW", "Podgl�d");
DEFINE("_CAL_LANG_SUBMITCANCEL", "Anuluj");
DEFINE("_CAL_LANG_SUBMITSAVE", "Zapisz");

DEFINE("_CAL_LANG_E_WARNWEEKS", "Wybierz tydzie�.");
DEFINE("_CAL_LANG_E_WARNDAYS", "Wybierz dzie�.");

// Admin
DEFINE("_CAL_LANG_EVENT_ALLCAT", "Wszystkie kategorie");
DEFINE("_CAL_LANG_EVENT_ACCESSLEVEL", "Poziom dost�pu");
DEFINE("_CAL_LANG_EVENT_HITS", "Wybra�");
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
		  <td>Wybierz kolor t�a kt�ry b�dzie widoczny w widoku miesi�cznym kalendarza. Je�eli pole wyboru Kategorii jest zaznaczone, wtedy kolor b�dzie domy�lnym kolorem tej kategorii
		  (zdefiniowanym przez administratora serwisu) wybranym w zak�adce Tre�ci danego wydarzenia i wybranie koloru bedzie niemo�liwe.</td>
        </tr>
END
);

DEFINE("_CAL_LANG_FORM_HELP",  <<<END
    	<tr>
          <td align="left"><b>Data</b></td>
          <td>Wybierz date Rozpocz�cia i Zako�czenia wydarzenia.</td>
        </tr>
    	<tr>
          <td align="left" valign="top"><b>Czas</b></td>
          <td>Wybierz pore dnia wybranego wydarzenia.  Format: <span style='font-weight:bold;'>hh:mm {am|pm}</span>.<br/>
             Czas mo�e by� wybrany w 12 i 24 godzinnym systemie czasowym.<br/><br/>
             <b><i><span style='color:red;'>(Nowe)</span></i> Pami�taj</b>, �e w specjalnych przypadkach czyli kiedy tworzysz<span style='color:red;font-weight:bold;'>pojedy�cze wydarzenie ca�onocne</span>.  Np. Pojedy�cze wydarzenie Zaczynaj�ce si� o 19:00 i ko�cz�ce si� o 3:00 w nocy, Data Rozpocz�cia i Zako�czenia <b>MUSI</b> by�&nbsp;
		   t� sam� dat�, i powinna by� ustawiona na date odpowiedni� do dnia przed p�noc�.</td>
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
                  <font color="#000000">Ka�dy dzie�<br/><i>(domy�lnie)</i></font>
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
                    Raz na tydzie�
                  </font>
                </td>
                <td align="left" valign="top" class="frm_td_byweeks">
                  <font color="#000000">
                  Ta opcja pozwala na wybrania dnia tygodnia powtarzania sie wydarzenia.
                  <table border="0" width="100%" height="100%"><tr><td><b>Numer dnia</b> wpisz np. 10/../2003</td></tr><tr><td><b>Nazwa dnia</b> wpisz np. Poniedzia�ek</td></tr></table>
                  </font>
                </td>
              </tr>
              <tr>
                <td width="110" align="left" valign="top" class="frm_td_byweeks">
                  <font color="#000000">
                    Wiele dni tygodnia na tydzie�.
                  </font>
                </td>
                <td align="left" valign="top" class="frm_td_byweeks">
                  <font color="#000000">Ta opcja pozwala na wybranie dni tygodnia w kt�rych wydarzenie bedzie widoczne</font>
                </td>
              </tr>
              <tr>
                <td width="110" align="left" valign="top" class="frm_td_byweeks">
                  <font color="#000000"><i>Tygodnie miesi�ca # <br>Dla opcji 'Raz na tydzie�' i 'Wiele dni w tygodniu' wy�ej</i></font></td>
                  <td align="left" valign="top" class="frm_td_byweeks">
                  <font color="#000000">
                  <table border="0" width="100%" height="100%">
                    <tr><td><b>Week 1 :</b> Pierwszy tydzie� tygodnia</td></tr>
                    <tr><td><b>Week 2 :</b> Drugi tydzie� tygodnia</td></tr>
                    <tr><td><b>Week 3 :</b> Trzeci tydzie� tygodnia</td></tr>
                    <tr><td><b>Week 4 :</b> Czwarty tydzie� tygodnia</td></tr>
                    <tr><td><b>Week 5 :</b> Pi�ty tydzie� tygodnia (je�li mo�liwe)</td></tr>
                   </table>
                 </font>
                </td>
              </tr>
              <tr>
                <td width="60" rowspan="2" align="left" valign="top"><u>Miesi�cznie</u></td>
                <td width="110" align="left" valign="top" class="frm_td_bymonth">
                  <font color="#000000">Raz na miesi�c</font></td>
                <td align="left" valign="top" class="frm_td_bymonth">
                  <font color="#000000">
                     Ta opcja pozwala na wybranie dnia powtarzania si� wydarzenia w wybranym miesi�cu.
                     <table border="0" width="100%" height="100%"><tr><td><b>Numer dnia</b> wpisz np. 10/../2003</td></tr><tr><td><b>Nazwa dnia</b> fwpisz np. Poniedzia�ek</td></tr></table>

                  </font>
                </td>
              </tr>
              <tr>
                <td width="110" align="left" valign="top" class="frm_td_bymonth">
                  <font color="#000000">
                  Koniec ka�dego miesi�ca
                  </font>
                </td>
                <td align="left" valign="top" class="frm_td_bymonth">
                  <font color="#000000">
				   The event is on the last day of each month independently of the day number, if that last day
		falls within the date range specified by the Start and End Dates for the event.
                  </font>
						<font color="#000000">
				  To wydarzenie odbywa si� ostatniego dnia ka�dego miesi�ca niezale�nie od numeru dnia, je�eli ostatni dzie�
				  wypada w ci�gu okresu okre�lonego przez daty Rozpocz�cia i Zak�czenia wydarzenia.
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
                  Ta opcja pozwala na wybranie pojedy�czego dnia w roku.
                  <table border="0" width="100%" height="100%"><tr><td><b>Numer dnia</b> wpisz np. 10/../2003</td></tr><tr><td><b>Nazwa dnia</b> wpisz np. Poniedzia�ek</td></tr></table>
                  </font>
                </td>
              </tr>
            </table>
          </td>
        </tr>
        <!-- END REPEAT -->
END
);
	
	
?>
