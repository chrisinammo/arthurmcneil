<?php
/**
 * Events Component for Joomla 1.0.x
 *
 * @version     $Id: germanf-utf8.php 1086 2008-05-08 14:26:18Z tstahl $
 * @package     Events
 * @copyright   Copyright (C) 2006-2008 JEvents Project Group
 * @licence     http://www.gnu.org/copyleft/gpl.html
 * @link        http://joomlacode.org/gf/project/jevents
 * @encoding    utf-8
 */

defined("_VALID_MOS") or die("Direct Access to this location is not allowed");

//Check
DEFINE("_CAL_LANG_INCLUDED", 1);

// new 1.4.0 [mic]
define("_CAL_LANG_LNG",				"de"); // de|fr|etc... [ DO NOT CHANGE THIS VALUE! ]

// used for colorpicker
define("_CAL_LANG_NO_COLOR",			"Keine Farbe");
define("_CAL_LANG_COLOR_PICKER",		"Farbe bestimmen");

// common
define("_CAL_LANG_TIME",				"Zeit");
define("_CAL_LANG_CLICK_TO_OPEN_EVENT",	"Link anklicken &ouml;ffnet Termin");
define("_CAL_LANG_UNPUBLISHED",		"** Unver&ouml;ffentlicht **");
define("_CAL_LANG_DESCRIPTION",		"Beschreibung");
define("_CAL_LANG_EMAIL_TO_AUTHOR",	"Email an Autor");
define("_CAL_LANG_MAIL_TO_ADMIN",		"Neuer Termin auf [ %s ] von [ %s ]");
define("_CAL_LANG_KEYWORD_NOT_VALID",	"Kein g&uuml;ltiger Suchbegriff");
define("_CAL_LANG_EVENT_CALENDAR",		"Terminkalender"); // new 1.4

// modul
define("_CAL_LANG_ERR_NO_MOD_CAL",		"Terminkalender\n<br />Dieses Module ben&ouml;tigt die Events Komponente");
define("_CAL_LANG_CLICK_TOSWITCH_DAY",	"Zum Kalender - Aktueller Tag");
define("_CAL_LANG_CLICK_TOSWITCH_MON",	"Zum Kalender - Aktueller Monat");
define("_CAL_LANG_CLICK_TOSWITCH_YEAR",	"Zum Kalender - Aktuelles Jahr");
define("_CAL_LANG_CLICK_TOSWITCH_PY",	"Zum Kalender - Vorjahr");
define("_CAL_LANG_CLICK_TOSWITCH_PM",	"Zum Kalender - Vormonat");
define("_CAL_LANG_CLICK_TOSWITCH_NM",	"Zum Kalender - N&auml;chster Monat");
define("_CAL_LANG_CLICK_TOSWITCH_NY",	"Zum Kalender - N&auml;chstes Jahr");

// navTableNext
define("_CAL_LANG_NAV_TN_FIRST_LIST",	"Erste Liste");
define("_CAL_LANG_NAV_TN_PREV_LIST",	"Vorige Liste");
define("_CAL_LANG_NAV_TN_NEXT_LIST",	"N&auml;chste Liste");
define("_CAL_LANG_NAV_TN_LAST_LIST",	"Letzte Liste");

// calendar monthly display
define("_CAL_LANG_FIRST_SINGLE_DAY_EVENT",		"Einmaliger Termin");
define("_CAL_LANG_FIRST_DAY_OF_MULTIEVENT",	"Erster Tag eines mehrt&auml;gigen Termins");
define("_CAL_LANG_LAST_DAY_OF_MULTIEVENT",		"Letzter Tag eines mehrt&auml;gigen Termins");
define("_CAL_LANG_MULTIDAY_EVENT",				"Mehrt&auml;giger Termin");
/* ++++++ end mic +++++++++++++ */

// Months
DEFINE("_CAL_LANG_JANUARY", "Januar");
DEFINE("_CAL_LANG_FEBRUARY", "Februar");
DEFINE("_CAL_LANG_MARCH", "M&auml;rz");
DEFINE("_CAL_LANG_APRIL", "April");
DEFINE("_CAL_LANG_MAY", "Mai");
DEFINE("_CAL_LANG_JUNE", "Juni");
DEFINE("_CAL_LANG_JULY", "Juli");
DEFINE("_CAL_LANG_AUGUST", "August");
DEFINE("_CAL_LANG_SEPTEMBER", "September");
DEFINE("_CAL_LANG_OCTOBER", "Oktober");
DEFINE("_CAL_LANG_NOVEMBER", "November");
DEFINE("_CAL_LANG_DECEMBER", "Dezember");

// Short day names
DEFINE("_CAL_LANG_SUN", "So");
DEFINE("_CAL_LANG_MON", "Mo");
DEFINE("_CAL_LANG_TUE", "Di");
DEFINE("_CAL_LANG_WED", "Mi");
DEFINE("_CAL_LANG_THU", "Do");
DEFINE("_CAL_LANG_FRI", "Fr");
DEFINE("_CAL_LANG_SAT", "Sa");

// Days
DEFINE("_CAL_LANG_SUNDAY", "Sonntag");
DEFINE("_CAL_LANG_MONDAY", "Montag");
DEFINE("_CAL_LANG_TUESDAY", "Dienstag");
DEFINE("_CAL_LANG_WEDNESDAY", "Mittwoch");
DEFINE("_CAL_LANG_THURSDAY", "Donnerstag");
DEFINE("_CAL_LANG_FRIDAY", "Freitag");
DEFINE("_CAL_LANG_SATURDAY", "Samstag");

// Days lettres
DEFINE("_CAL_LANG_SUNDAYSHORT", "So");
DEFINE("_CAL_LANG_MONDAYSHORT", "Mo");
DEFINE("_CAL_LANG_TUESDAYSHORT", "Di");
DEFINE("_CAL_LANG_WEDNESDAYSHORT", "Mi");
DEFINE("_CAL_LANG_THURSDAYSHORT", "Do");
DEFINE("_CAL_LANG_FRIDAYSHORT", "Fr");
DEFINE("_CAL_LANG_SATURDAYSHORT", "Sa");

// Repeat type
DEFINE("_CAL_LANG_ALLDAYS", "T&auml;glich");
DEFINE("_CAL_LANG_EACHWEEK", "W&ouml;chentlich");
DEFINE("_CAL_LANG_EACHWEEKPAIR", "Jede gerade Woche");
DEFINE("_CAL_LANG_EACHWEEKIMPAIR", "Jede ungerade Woche");
DEFINE("_CAL_LANG_EACHMONTH", "Monatlich");
DEFINE("_CAL_LANG_EACHYEAR", "J&auml;hrlich");
DEFINE("_CAL_LANG_ONLYDAYS", "Nur an bestimmten Tagen");
DEFINE("_CAL_LANG_EACH", "jeden / jedes");
DEFINE("_CAL_LANG_EACHOF","jede");
DEFINE("_CAL_LANG_ENDMONTH", "Monatsende");

// Repeat days
DEFINE("_CAL_LANG_BYDAYNUMBER", "Ausgehend vom Startdatum");

// User type
DEFINE("_CAL_LANG_ANONYME", "Anonym");

// Post
//PAS D'ACCENTS DANS LES _ACT_
DEFINE("_CAL_LANG_ACT_ADDED", "Danke f&uuml;r den Eintrag - er wird so rasch als m&ouml;glich bearbeitet"); //NO ACCENT !!
DEFINE("_CAL_LANG_ACT_MODIFIED", "Der Termin wurde bearbeitet"); //NO ACCENT !!
DEFINE("_CAL_LANG_ACT_PUBLISHED", "Der Termin wurde ver&ouml;ffentlicht.");  //NEW 1.4
DEFINE("_CAL_LANG_ACT_DELETED", "Der Termin wurde entfernt"); //NO ACCENT !!
DEFINE("_CAL_LANG_NOPERMISSION", "Sie haben keinen Zugriff!"); //NO ACCENT !!

DEFINE("_CAL_LANG_MAIL_ADDED", "Neuer Eintrag auf");
DEFINE("_CAL_LANG_MAIL_MODIFIED", "Neue &Auml;nderung auf");

// Presentation
DEFINE("_CAL_LANG_BY", "von");
DEFINE("_CAL_LANG_FROM", "von");
DEFINE("_CAL_LANG_TO", "bis");
DEFINE("_CAL_LANG_ARCHIVE", "&Uuml;bersicht");
DEFINE("_CAL_LANG_WEEK", "die Woche");
DEFINE("_CAL_LANG_NO_EVENTS", "Keine Termine");
DEFINE("_CAL_LANG_NO_EVENTFOR", "Keine Termine f&uuml;r");
DEFINE("_CAL_LANG_NO_EVENTFORTHE", "Keine Termine f&uuml;r");
DEFINE("_CAL_LANG_THIS_DAY", "diesen Tag");
DEFINE("_CAL_LANG_THIS_MONTH", "Aktueller Monat");
DEFINE("_CAL_LANG_LAST_MONTH", "Letzter Monat");
DEFINE("_CAL_LANG_NEXT_MONTH", "N&auml;chster Monat");
DEFINE("_CAL_LANG_EVENTSFOR", "Termine f&uuml;r");
DEFINE("_CAL_LANG_SEARCHRESULTS", "Suchergebnis"); // new 1.4
DEFINE("_CAL_LANG_EVENTSFORTHE", "Termine f&uuml;r");
DEFINE("_CAL_LANG_REP_DAY", "Tag");
DEFINE("_CAL_LANG_REP_WEEK", "Woche");
DEFINE("_CAL_LANG_REP_WEEKPAIR", "alle 2 Wochen");
DEFINE("_CAL_LANG_REP_WEEKIMPAIR", "alle 3 Wochen");
DEFINE("_CAL_LANG_REP_MONTH", "Monat");
DEFINE("_CAL_LANG_REP_YEAR", "Jahr");
DEFINE("_CAL_LANG_REP_NOEVENTSELECTED", "Bitte zuerst einen Termin ausw&auml;hlen");

// Navigation
DEFINE("_CAL_LANG_VIEWTODAY", "Heute");
DEFINE("_CAL_LANG_VIEWTOCOME", "Zuk&uuml;nftig");
DEFINE("_CAL_LANG_VIEWBYDAY", "Tagesansicht");
DEFINE("_CAL_LANG_VIEWBYCAT", "Kategorieansicht");
DEFINE("_CAL_LANG_VIEWBYMONTH", "Monatsansicht");
DEFINE("_CAL_LANG_VIEWBYYEAR", "Jahresansicht");
DEFINE("_CAL_LANG_VIEWBYWEEK", "Wochenansicht");
DEFINE("_CAL_LANG_JUMPTO", "Zum ausgw&auml;hlten Monat wechseln");  // New 1.4
DEFINE("_CAL_LANG_BACK", "Zur&uuml;ck");
DEFINE("_CAL_LANG_CLOSE", "Schlie&szlig;en");
DEFINE("_CAL_LANG_PREVIOUSDAY", "Vorheriger Tag");
DEFINE("_CAL_LANG_PREVIOUSWEEK", "Vorherige Woche");
DEFINE("_CAL_LANG_PREVIOUSMONTH", "Vorheriger Monat");
DEFINE("_CAL_LANG_PREVIOUSYEAR", "Vorheriges Jahr");
DEFINE("_CAL_LANG_NEXTDAY", "N&auml;chster Tag");
DEFINE("_CAL_LANG_NEXTWEEK", "N&auml;chste Woche");
DEFINE("_CAL_LANG_NEXTMONTH", "Nächster Monat");
DEFINE("_CAL_LANG_NEXTYEAR", "N&auml;chstes Jahr");

DEFINE("_CAL_LANG_ADMINPANEL", "Administrationsoberfl&auml;che");
DEFINE("_CAL_LANG_ADDEVENT", "Neuen Termin eintragen");
DEFINE("_CAL_LANG_MYEVENTS", "Meine Termine");
DEFINE("_CAL_LANG_DELETE", "L&ouml;schen");
DEFINE("_CAL_LANG_MODIFY", "&Auml;ndern");

// Form
DEFINE("_CAL_LANG_HELP", "Hilfe");

DEFINE("_CAL_LANG_CAL_TITLE", "Termine");
DEFINE("_CAL_LANG_ADD_TITLE", "Hinzuf&uuml;gen");
DEFINE("_CAL_LANG_MODIFY_TITLE", "&Auml;ndern");

DEFINE("_CAL_LANG_REPEAT_DISABLED", "Wiederholungen sind nur m&ouml;glich, wenn das Endedatum nach dem Startdatum liegt."); // New for 1.4
DEFINE("_CAL_LANG_EVENT_TITLE", "Thema");
DEFINE("_CAL_LANG_EVENT_COLOR", "Farbe");
DEFINE("_CAL_LANG_EVENT_CATCOLOR", "Kategoriefarbe verwenden");
DEFINE("_CAL_LANG_EVENT_CATEGORY", "Kategorien");
DEFINE("_CAL_LANG_EVENT_CHOOSE_CATEG", "Bitte eine Kategorie ausw&auml;hlen");
DEFINE("_CAL_LANG_EVENT_ACTIVITY", "Beschreibung<br />");
DEFINE("_CAL_LANG_EVENT_URLMAIL_INFO", "Links oder Emailadressen bitte in der Form: <u>http://www.mysite.com</u> oder <u>mailto:my@mail.com</u> angeben.");
DEFINE("_CAL_LANG_EVENT_ADRESSE", "Ort");
DEFINE("_CAL_LANG_EVENT_CONTACT", "Kontakt");
DEFINE("_CAL_LANG_EVENT_EXTRA", "Zusatzinformationen");
DEFINE("_CAL_LANG_EVENT_AUTHOR_ALIAS", "Autor (alias)");
DEFINE("_CAL_LANG_EVENT_STARTDATE", "Erster Tag");
DEFINE("_CAL_LANG_EVENT_ENDDATE", "Letzter Tag");
DEFINE("_CAL_LANG_EVENT_STARTHOURS", "Beginn");
DEFINE("_CAL_LANG_EVENT_ENDHOURS", "Ende");
DEFINE("_CAL_LANG_EVENT_STARTTIME", "Startzeit");
DEFINE("_CAL_LANG_EVENT_ENDTIME", "Endzeit");
DEFINE("_CAL_LANG_PUB_INFO", "Weitere Infos");
DEFINE("_CAL_LANG_EVENT_REPEATTYPE", "Wiederholungstyp");
DEFINE("_CAL_LANG_EVENT_REPEATDAY", "Wiederholungstag");
DEFINE("_CAL_LANG_EVENT_CHOOSE_WEEKDAYS", "Wochentag");
DEFINE("_CAL_LANG_EVENT_PER", "pro");
DEFINE("_CAL_LANG_EVENT_WEEKOPT", "Woche(n) innerhalb eines Monats f&uuml;r Wiederholungstyp Woche");

DEFINE("_CAL_LANG_SUBMITPREVIEW", "Vorschau");
DEFINE("_CAL_LANG_SUBMITCANCEL", "Abbrechen");
DEFINE("_CAL_LANG_SUBMITSAVE", "Speichern");

DEFINE("_CAL_LANG_E_WARNWEEKS", "Bitte ein Woche ausw&auml;hlen");
DEFINE("_CAL_LANG_E_WARNDAYS", "Bitte einen Tag ausw&auml;hlen");

// Admin
DEFINE("_CAL_LANG_EVENT_ALLCAT", "Alle Kategorien");
DEFINE("_CAL_LANG_EVENT_ACCESSLEVEL", "Zugriffsstufe");
DEFINE("_CAL_LANG_EVENT_HITS", "Aufrufe");
DEFINE("_CAL_LANG_EVENT_STATE", "Status");
DEFINE("_CAL_LANG_EVENT_CREATED", "Erstellt");
DEFINE("_CAL_LANG_EVENT_NEWEVENT", "Neuer Termin");
DEFINE("_CAL_LANG_EVENT_MODIFIED", "Zuletzt bearbeitet");
DEFINE("_CAL_LANG_EVENT_NOTMODIFIED", "Nicht bearbeitet");

// dmcd aug 22/04  new warning alert for no specified activity in event entry
DEFINE("_CAL_LANG_WARNACTIVITY", "Eine Terminbeschreibung muss eingegeben werden.");

DEFINE("_CAL_LEGEND_ALL_CATEGORIES", "Alle Kategorien ...");  // new for 1.4
DEFINE("_CAL_LEGEND_ALL_CATEGORIES_DESC", "Zeige Termine aller Kategorien");  // new for 1.4

DEFINE("_CAL_LANG_FORM_HELP_COLOR", <<<END
        <tr>
		  <td width="110" align="left" valign="top">
            <b>Farbe</b>
          </td>
          <td><p>Bitte w&auml;hlen Sie die Hintergrundfarbe für die Kalenderansicht.</p><p>Wenn die Option Kategoriefarbe ausgew&auml;hlt ist,
		wird automatisch die eingestellte Farbe der ausgew&auml;ten Terminkategorie verwendet (einstellbar in der Konfiguration von JEvents im Backend).
		und das Eingabefeld für die Hintergrundfarbe wird deaktiviert.</td>
        </tr>
END
);

DEFINE("_CAL_LANG_FORM_HELP",  <<<END
    	<tr>
          <td align="left"><b>Datum</b></td>
          <td>W&auml;hlen Sie Startdatum und Ende des Termins</td>
        </tr>
    	<tr>
          <td align="left" valign="top"><b>Zeit</b></td>
          <td>Tragen Sie den Beginn des Termines ein. Das Format kann so <span style='font-weight:bold;'>hh:mm</span> als 24h Format
              oder <span style='font-weight:bold;'>hh:mm am/pm</span> als 12h-Format eingegeben werden.
<br/><b><i><span style='color:red;'>(Neu)</span>
</i> Beachten Sie</b> den Sonderfall eines <span style='color:red;font-weight:bold;'>eint&auml;gigen Abendtermines</span>. Wenn zum Beispiel eine Feier um 19:00 Uhr beginnt und gegen 3:00 in der Nacht endet, <b>MUSS</b> das gleiche Datum f&uuml;r Beginn und Ende verwendet werden.</td>
        </tr>
END
);

DEFINE("_CAL_LANG_FORM_HELP_EXTENDED",  <<<END
        <tr>
    	  <td align="left" valign="top" nowrap><b>Wiederholungstyp</b></td>
  	  	<td colspan="2"></td>
  		</tr>
  		<tr>
    	  <td colspan="2" align="left" valign="top">
	    	<table width="100%" border="0" cellspacing="2">
              <tr>
                <td width="60" align="left" valign="top"><u>t&auml;glich</u></td>
                <td width="110" align="left" valign="top" class="frm_td_bydays">
                  <font color="#000000">Jeden Tag<br/><i>(Voreinstellung)</i></font>
                </td>
                <td align="left" valign="top" class="frm_td_bydays">
                  <font color="#000000">W&auml;hlen Sie diese Option f&uuml;r einen eint&auml;gigen oder mehrt&auml;gigen Termin, wenn jeder Tag zwischen Beginn und Ende als Termin angezeigt werden soll.</font>
                </td>
              </tr>
              <tr>
                <td width="60" rowspan="3" align="left" valign="top"><u>w&ouml;chentlich</u></td>
                <td width="110" align="left" valign="top" class="frm_td_byweeks">
                  <font color="#000000">
                    einmal pro Woche
                  </font>
                </td>
                <td align="left" valign="top" class="frm_td_byweeks">
                  <font color="#000000">
                  Auswahl an welchen Wochentagen sich der Termin wiederholen soll
                  <table border="0" width="100%" height="100%"><tr><td><b>w&ouml;chentlich</b> wie Wochentag des Terminbeginns</td></tr><tr><td><b>Wochentag</b> z.B. montags</td></tr></table>
                  </font>
                </td>
              </tr>
              <tr>
                <td width="110" align="left" valign="top" class="frm_td_byweeks">
                  <font color="#000000">
                    Mehrere Tage in der Woche
                  </font>
                </td>
                <td align="left" valign="top" class="frm_td_byweeks">
                  <font color="#000000">Diese Option erlaubt die Auswahl mehrerer Wochentage f&uuml;r einen Wiederholungstermin.</font>
                </td>
              </tr>
              <tr>
                <td width="110" align="left" valign="top" class="frm_td_byweeks">
                  <font color="#000000"><i>Wochen des Monats<br>F&uuml;r 'Einmal pro Woche' und 'Mehrere Tage in der Woche' Option </i></font></td>
                  <td align="left" valign="top" class="frm_td_byweeks">
                  <font color="#000000">
                  <table border="0" width="100%" height="100%">
                    <tr><td><b>Woche 1 :</b> Jede erste Woche im Monat</td></tr>
                    <tr><td><b>Woche 2 :</b> Jede zweite Woche im Monat</td></tr>
                    <tr><td><b>Woche 3 :</b> Jede dritte Woche im Monat</td></tr>
                    <tr><td><b>Woche 4 :</b> Jede vierte Woche im Monat</td></tr>
                    <tr><td><b>Woche 5 :</b> Jede f&uuml;nfte Woche im Monat (wenn m&ouml;glich)</td></tr>
                   </table>
                 </font>
                </td>
              </tr>
              <tr>
                <td width="60" rowspan="2" align="left" valign="top"><u>monatlich</u></td>
                <td width="110" align="left" valign="top" class="frm_td_bymonth">
                  <font color="#000000">einmal pro Monat</font></td>
                <td align="left" valign="top" class="frm_td_bymonth">
                  <font color="#000000">
                     Auswahl des Wiederholungstages im Monat
                     <table border="0" width="100%" height="100%"><tr><td><b>Datum</b> z.B jeden 10. des Monats </td></tr><tr><td><b>Wochentag nach dem Startdatum</b> z.B. am Montag nach dem 10. des Monats</td></tr></table>

                  </font>
                </td>
              </tr>
              <tr>
                <td width="110" align="left" valign="top" class="frm_td_bymonth">
                  <font color="#000000">
                  Ende jeden Monats
                  </font>
                </td>
                <td align="left" valign="top" class="frm_td_bymonth">
                  <font color="#000000">Der Termin ist immer am letzten Tag eines Monats, wenn er innerhalb des Terminzeitraumes liegt.
                  </font>
                </td>
              </tr>
              <tr>
                <td width="60" rowspan="2" align="left" valign="top"><u>j&auml;hrlich</u></td>
                <td width="110" align="left" valign="top" class="frm_td_byyear">
                  <font color="#000000">
                  einmal pro Jahr
                  </font>
                </td>
                <td align="left" valign="top" class="frm_td_byyear">
                  <font color="#000000">
                  Diese Option kann für j&auml;hrlich wiederkehrende Termine verwendet werden.
                  <table border="0" width="100%" height="100%"><tr><td><b>Datum</b> z.B. 16. Januar jeden Jahres</td></tr><tr><td><b>Wochentag nach dem Startdatum</b> z.B. am Montag nach dem 10. Februar jeden Jahres</td></tr></table>
                  </font>
                </td>
              </tr>
            </table>
          </td>
        </tr>
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
