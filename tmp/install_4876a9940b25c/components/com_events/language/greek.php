<?php
/**
 * Events Component for Joomla 1.0.x
 *
 * @version     $Id: greek.php 991 2008-03-10 19:55:48Z tstahl $
 * @package     Events
 * @copyright   Copyright (C) 2006-2008 JEvents Project Group
 * @licence     http://www.gnu.org/copyleft/gpl.html
 * @link        http://joomlacode.org/gf/project/jevents
 * @translated  by George Kolios
 * @encoding    utf-8
 */

defined("_VALID_MOS") or die( 'Restricted access' );

//Check
DEFINE("_CAL_LANG_INCLUDED", 1);

// new 1.4.0 [mic]
define("_CAL_LANG_LNG",				"el"); // de|fr|etc... [ DO NOT CHANGE THIS VALUE! ]

// used for colorpicker
define("_CAL_LANG_NO_COLOR",			"Χωρίς Χρώμα");
define("_CAL_LANG_COLOR_PICKER",		"Κάντε κλικ για επιλογή χρώματος");

// common
define("_CAL_LANG_TIME",				"Ώρα");
define("_CAL_LANG_CLICK_TO_OPEN_EVENT",	"κάντε κλίκ εδώ για να δημιουργήσετε νέο γεγονός");
define("_CAL_LANG_UNPUBLISHED",		"** Unpubl **");
define("_CAL_LANG_DESCRIPTION",		"Περιγραφή");
define("_CAL_LANG_EMAIL_TO_AUTHOR",	"Email στον συγγραφέα");
define("_CAL_LANG_MAIL_TO_ADMIN",		"Το γεγονός προστέθηκε  [ %s ] από [ %s ]");
define("_CAL_LANG_KEYWORD_NOT_VALID",	"Μη έγκυρη λέξη αναζήτησης");
define("_CAL_LANG_EVENT_CALENDAR",		"Ημερολόγιο γεγονόνων"); // new 1.4

// modul
define("_CAL_LANG_ERR_NO_MOD_CAL",		"Ημερολόγιο γεγονόντων\n<br />Αυτό το  module χρειάζεται το  Events component");
define("_CAL_LANG_CLICK_TOSWITCH_DAY",	" Ημερολόγιο- τρέχων ημέρα");
define("_CAL_LANG_CLICK_TOSWITCH_MON",	"Ημερολόγιο - τρέχων μήνας");
define("_CAL_LANG_CLICK_TOSWITCH_YEAR",	" Ημερολόγιο- τρέχων χρόνος");
define("_CAL_LANG_CLICK_TOSWITCH_PY",	"Ημερολόγιο- προηγούμενος χρόνος");
define("_CAL_LANG_CLICK_TOSWITCH_PM",	"Ημερολόγιο - προηγούμενος μήνας");
define("_CAL_LANG_CLICK_TOSWITCH_NM",	"Ημερολόγιο - επόμενος μήνας");
define("_CAL_LANG_CLICK_TOSWITCH_NY",	"Ημερολόγιο- επόμενος χρόνος");

// navTableNext
define("_CAL_LANG_NAV_TN_FIRST_LIST",	"πρώτη λίστα");
define("_CAL_LANG_NAV_TN_PREV_LIST",	"προηγούμενη λίστα");
define("_CAL_LANG_NAV_TN_NEXT_LIST",	"επόμενη λίστα");
define("_CAL_LANG_NAV_TN_LAST_LIST",	"τελική λίστα");

// calendar monthly display
define("_CAL_LANG_FIRST_SINGLE_DAY_EVENT",		"Ένα γεγόνος");
define("_CAL_LANG_FIRST_DAY_OF_MULTIEVENT",	"Πρώτη μέρα από πολλαπλό γεγονός");
define("_CAL_LANG_LAST_DAY_OF_MULTIEVENT",		"Τελευταία  μέρα από πολλαπλό γεγονός");
define("_CAL_LANG_MULTIDAY_EVENT",				"Πολλαπλό γεγονός");
/* ++++++ end mic +++++++++++++ */

// Months
DEFINE("_CAL_LANG_JANUARY", "Ιανουάριος");
DEFINE("_CAL_LANG_FEBRUARY", "Φεβρουάριος");
DEFINE("_CAL_LANG_MARCH", "Μάρτιος");
DEFINE("_CAL_LANG_APRIL", "Απρίλιος");
DEFINE("_CAL_LANG_MAY", "Μάιος");
DEFINE("_CAL_LANG_JUNE", "Ιούνιος");
DEFINE("_CAL_LANG_JULY", "Ιούλιος");
DEFINE("_CAL_LANG_AUGUST", "Άυγουστος");
DEFINE("_CAL_LANG_SEPTEMBER", "Σεπτέμβριος");
DEFINE("_CAL_LANG_OCTOBER", "Οκτώβριος");
DEFINE("_CAL_LANG_NOVEMBER", "Νοέμβριος");
DEFINE("_CAL_LANG_DECEMBER", "Δεκέμβριος");

// Short day names
DEFINE("_CAL_LANG_SUN", "Κυρ");
DEFINE("_CAL_LANG_MON", "Δευτ");
DEFINE("_CAL_LANG_TUE", "Τρ");
DEFINE("_CAL_LANG_WED", "Τετ");
DEFINE("_CAL_LANG_THU", "Πεμ");
DEFINE("_CAL_LANG_FRI", "Παρ");
DEFINE("_CAL_LANG_SAT", "Σαβ");

// Days
DEFINE("_CAL_LANG_SUNDAY", "Κυριακή");
DEFINE("_CAL_LANG_MONDAY", "Δευτέρα");
DEFINE("_CAL_LANG_TUESDAY", "Τρίτη");
DEFINE("_CAL_LANG_WEDNESDAY", "Τετάρτη");
DEFINE("_CAL_LANG_THURSDAY", "Πέμπτη");
DEFINE("_CAL_LANG_FRIDAY", "Παρασκευή");
DEFINE("_CAL_LANG_SATURDAY", "Σαββάτο");

// Days lettres
DEFINE("_CAL_LANG_SUNDAYSHORT", "Κ");
DEFINE("_CAL_LANG_MONDAYSHORT", "Δ");
DEFINE("_CAL_LANG_TUESDAYSHORT", "Τ");
DEFINE("_CAL_LANG_WEDNESDAYSHORT", "Τ");
DEFINE("_CAL_LANG_THURSDAYSHORT", "Π");
DEFINE("_CAL_LANG_FRIDAYSHORT", "Π");
DEFINE("_CAL_LANG_SATURDAYSHORT", "Σ");

// Repeat type
DEFINE("_CAL_LANG_ALLDAYS", "Κάθε μέρα");
DEFINE("_CAL_LANG_EACHWEEK", "Κάθε εβδομάδα");
DEFINE("_CAL_LANG_EACHWEEKPAIR", "Κάθε 2 εβδομάδες");
DEFINE("_CAL_LANG_EACHWEEKIMPAIR", "Κάθε 2 εβδομάδες");
DEFINE("_CAL_LANG_EACHMONTH", "Κάθε μήνα");
DEFINE("_CAL_LANG_EACHYEAR", "Κάθε χρόνο");
DEFINE("_CAL_LANG_ONLYDAYS", "Μόνο επιλεγμένες μέρες");
DEFINE("_CAL_LANG_EACH", "Κάθε");
DEFINE("_CAL_LANG_EACHOF","από κάθε");
DEFINE("_CAL_LANG_ENDMONTH", "τέλος του μήνα");

// Repeat days
DEFINE("_CAL_LANG_BYDAYNUMBER", "Με ημερόμηνια");

// User type
DEFINE("_CAL_LANG_ANONYME", "Ανώνυμος");

// Post
//PAS D'ACCENTS DANS LES _ACT_
DEFINE("_CAL_LANG_ACT_ADDED", "Ευχαριστούμε για την καταχώρηση  - θα επιβεβαιώσουμε την προτασή σας!"); //NO ACCENT !!
DEFINE("_CAL_LANG_ACT_MODIFIED", "Αυτό το γεγονός έχει αλλάξει."); //NO ACCENT !!
DEFINE("_CAL_LANG_ACT_PUBLISHED", "Αυτό το γεγονός έχει δημοσιευτεί.");  //NEW 1.4
DEFINE("_CAL_LANG_ACT_DELETED", "Το γεγονός έχει διαγραφεί!"); //NO ACCENT !!
DEFINE("_CAL_LANG_NOPERMISSION", "Δέν έχετε πρόσβαση σε αυτή τη υπηρεσία !"); //NO ACCENT !!

DEFINE("_CAL_LANG_MAIL_ADDED", "Προστέθηκε στίς");
DEFINE("_CAL_LANG_MAIL_MODIFIED", "Έγινε αλλαγή στίς");

// Presentation
DEFINE("_CAL_LANG_BY", "από");
DEFINE("_CAL_LANG_FROM", "Από");
DEFINE("_CAL_LANG_TO", "Πρός");
DEFINE("_CAL_LANG_ARCHIVE", "Αρχεία");
DEFINE("_CAL_LANG_WEEK", "την εβδομάδα");
DEFINE("_CAL_LANG_NO_EVENTS", "Δέν υπάρχουν γεγονότα ");
DEFINE("_CAL_LANG_NO_EVENTFOR", "Δεν υπάρχουν γεγονότα για");
DEFINE("_CAL_LANG_NO_EVENTFORTHE", "Δεν υπάρχουν γεγονότα για ");
DEFINE("_CAL_LANG_THIS_DAY", "αυτή την ημέρα");
DEFINE("_CAL_LANG_THIS_MONTH", "Αυτό το μήνα");
DEFINE("_CAL_LANG_LAST_MONTH", "Προηγουμένο μήνα");
DEFINE("_CAL_LANG_NEXT_MONTH", "Επόμενο μήνα");
DEFINE("_CAL_LANG_EVENTSFOR", "Γεγονότα για");
DEFINE("_CAL_LANG_SEARCHRESULTS", "Αποτελέσματα αναζήτησης για την λέξη"); // new 1.4
DEFINE("_CAL_LANG_EVENTSFORTHE", "Γεγονότα ανά ");
DEFINE("_CAL_LANG_REP_DAY", "ημέρα");
DEFINE("_CAL_LANG_REP_WEEK", "εβδομάδα");
DEFINE("_CAL_LANG_REP_WEEKPAIR", "κάθε 2 εβδομάδες");
DEFINE("_CAL_LANG_REP_WEEKIMPAIR", "κάθε 3 εβδομάδα");
DEFINE("_CAL_LANG_REP_MONTH", "μήνας");
DEFINE("_CAL_LANG_REP_YEAR", "χρόνος");
DEFINE("_CAL_LANG_REP_NOEVENTSELECTED", "Παρακαλώ επιλέξτε πρώτα ένα γεγονός");

// Navigation
DEFINE("_CAL_LANG_VIEWTODAY", "Δές σήμερα");
DEFINE("_CAL_LANG_VIEWTOCOME", "Επόμενος μήνας");
DEFINE("_CAL_LANG_VIEWBYDAY", "Δές ανά ημέρα");
DEFINE("_CAL_LANG_VIEWBYCAT", "Δές ανά κατηγορία");
DEFINE("_CAL_LANG_VIEWBYMONTH", "Δές ανά μήνα");
DEFINE("_CAL_LANG_VIEWBYYEAR", "Δές ανά χρόνο");
DEFINE("_CAL_LANG_VIEWBYWEEK", "Δές ανά εβδομάδα");
DEFINE("_CAL_LANG_JUMPTO", "Πήγαινε σε μήνα");  // New 1.4
DEFINE("_CAL_LANG_BACK", "Πίσω");
DEFINE("_CAL_LANG_CLOSE", "Κλείσε");
DEFINE("_CAL_LANG_PREVIOUSDAY", "Προηγούμενη μέρα");
DEFINE("_CAL_LANG_PREVIOUSWEEK", "Προηγουμενη εβδομάδα");
DEFINE("_CAL_LANG_PREVIOUSMONTH", "Προηγούμενος μήνας");
DEFINE("_CAL_LANG_PREVIOUSYEAR", "Προηγούμενος χρόνος");
DEFINE("_CAL_LANG_NEXTDAY", "Επόμενη μέρα");
DEFINE("_CAL_LANG_NEXTWEEK", "Επόμενη εβδομάδα");
DEFINE("_CAL_LANG_NEXTMONTH", "Επόμενος μήνας");
DEFINE("_CAL_LANG_NEXTYEAR", "Επόμενος χρόνος");

DEFINE("_CAL_LANG_ADMINPANEL", "Διαχειριστής");
DEFINE("_CAL_LANG_ADDEVENT", "Να προστεεθί το γεγονός");
DEFINE("_CAL_LANG_MYEVENTS", "Τα γεγονότα μου");
DEFINE("_CAL_LANG_DELETE", "Διαγραφή");
DEFINE("_CAL_LANG_MODIFY", "Άλλαξε");

// Form
DEFINE("_CAL_LANG_HELP", "Βοήθεια");

DEFINE("_CAL_LANG_CAL_TITLE", "Γεγονότα");
DEFINE("_CAL_LANG_ADD_TITLE", "Πρόσθεσε");
DEFINE("_CAL_LANG_MODIFY_TITLE", "Άλλαξε");

DEFINE("_CAL_LANG_REPEAT_DISABLED", "Η επανάληψη τον γεγονότων γίνεται μόνο όταν η τελική ημερομηνία είναι μετά την ημέρα έναρξης. Αλλάξτε τελική ημερομηνία πρώτα."); // New for 1.4
DEFINE("_CAL_LANG_EVENT_TITLE", "Θέμα");
DEFINE("_CAL_LANG_EVENT_COLOR", "Χρώμα");
DEFINE("_CAL_LANG_EVENT_CATCOLOR", "Με χρώματα για τις κατηγορίες");
DEFINE("_CAL_LANG_EVENT_CATEGORY", "Κατηγορίες");
DEFINE("_CAL_LANG_EVENT_CHOOSE_CATEG", "Παρακαλώ επιλέξτε κατηγορία");
DEFINE("_CAL_LANG_EVENT_ACTIVITY", "Λειτουργία");
DEFINE("_CAL_LANG_EVENT_URLMAIL_INFO", "Για να προσθέσετε URL η email διεύθυνση απλώς γράψτε <br><u>http://www.mysite.com</u> or <u>mailto:my@mail.com</u>");
DEFINE("_CAL_LANG_EVENT_ADRESSE", "Τοποθεσία");
DEFINE("_CAL_LANG_EVENT_CONTACT", "Επαφή");
DEFINE("_CAL_LANG_EVENT_EXTRA", "Επιπλέον πληροφορίες");
DEFINE("_CAL_LANG_EVENT_AUTHOR_ALIAS", "Συγγραφέας (alias)");
DEFINE("_CAL_LANG_EVENT_STARTDATE", "Ημερομηνία έναρξης");
DEFINE("_CAL_LANG_EVENT_ENDDATE", "Τελική ημερομηνία");
DEFINE("_CAL_LANG_EVENT_STARTHOURS", "Ώρα έναρξης");
DEFINE("_CAL_LANG_EVENT_ENDHOURS", "Ώρα τέλος");
DEFINE("_CAL_LANG_EVENT_STARTTIME", "Ώρα έναρξης");
DEFINE("_CAL_LANG_EVENT_ENDTIME", "Ώρα τέλος");
DEFINE("_CAL_LANG_PUB_INFO", "Ημερομηνία δημοσίευσης");
DEFINE("_CAL_LANG_EVENT_REPEATTYPE", "Είδος επανάληψης");
DEFINE("_CAL_LANG_EVENT_REPEATDAY", "Επανάληψη ημέρας");
DEFINE("_CAL_LANG_EVENT_CHOOSE_WEEKDAYS", "Ημέρες της εβδομάδας");
DEFINE("_CAL_LANG_EVENT_PER", "ανά");
DEFINE("_CAL_LANG_EVENT_WEEKOPT", "Εβδομάδ(ες) of a month repeat type week");

DEFINE("_CAL_LANG_SUBMITPREVIEW", "Προεπισκόπηση");
DEFINE("_CAL_LANG_SUBMITCANCEL", "Άκυρο");
DEFINE("_CAL_LANG_SUBMITSAVE", "Αποθήκευση");

DEFINE("_CAL_LANG_E_WARNWEEKS", "Παρακαλώ επιλέξτε εβδομάδα.");
DEFINE("_CAL_LANG_E_WARNDAYS", "Παρακαλώ επιλέξε μέρα.");

// Admin
DEFINE("_CAL_LANG_EVENT_ALLCAT", "Όλες οι κατηγορίες");
DEFINE("_CAL_LANG_EVENT_ACCESSLEVEL", "Επίπεδο πρόσβασης");
DEFINE("_CAL_LANG_EVENT_HITS", "Επισκέψεις");
DEFINE("_CAL_LANG_EVENT_STATE", "Κατάσταση");
DEFINE("_CAL_LANG_EVENT_CREATED", "Δημουργία");
DEFINE("_CAL_LANG_EVENT_NEWEVENT", "Νέο γεγονός");
DEFINE("_CAL_LANG_EVENT_MODIFIED", "Τελευταία τροποποίηση");
DEFINE("_CAL_LANG_EVENT_NOTMODIFIED", "Δέν τροποποιήθηκε");

// dmcd aug 22/04  new warning alert for no specified activity in event entry
DEFINE("_CAL_LANG_WARNACTIVITY", "Κάποιο είδος εργασίας \\ λεπτομέρια πρέπει να προστεθεί.");

DEFINE("_CAL_LEGEND_ALL_CATEGORIES", "Όλλες οι κατηγορίες ...");  // new for 1.4
DEFINE("_CAL_LEGEND_ALL_CATEGORIES_DESC", "Δείξε γεγονότα από όλες τις κατηγορίες");  // new for 1.4

DEFINE("_CAL_LANG_FORM_HELP_COLOR", <<<END
        <tr>
		  <td width="110" align="left" valign="top">
            <b>Χρώμα</b>
          </td>
          <td>Διάλεξτε φόντο στο οποιό θα εμφανίζεται το ημερολόγιο. Άν η κατηγορία είναι επιλεγμένη,
		  τότε το χρώμα θα είναι το ίδιο με την κατηγορία (ορισμένο απο τον διαχειριστή) που έχει επιλεχτεί στα Περιεχόμενα τών γεγονότων, και
		 το κουμπί  'Επιλογή Χρώμα' θα απενεργοποιηθεί.</td>
        </tr>
END
);

DEFINE("_CAL_LANG_FORM_HELP",  <<<END
    	<tr>
          <td align="left"><b>Date</b></td>
          <td>Διαλέξτε ημερομηνία έναρξης και τελική ημερομηνία για το γεγονός.</td>
        </tr>
    	<tr>
          <td align="left" valign="top"><b>Ώρα</b></td>
          <td>Διαλέξτε την ώρα για το γεγονός σας. Η μορφή είναι <span style='color:blue;font-weight:bold;'>hh:mm {am|pm}</span>.<br/>Η ώρα πρέπει να είναι σε 12 ή 24 hr μορφή.<br/><br/><b><i><span style='color:red;'>(New)
	 </tr>
END
);

DEFINE("_CAL_LANG_FORM_HELP_EXTENDED",  <<<END
        <tr>
    	  <td align="left" valign="top" nowrap><b>Repeat Type</b></td>
  	  	<td colspan="2"></td>
  		</tr>
  		<tr>
    	  <td colspan="2" align="left" valign="top">
	    	<table width="100%" border="0" cellspacing="2">
              <tr>
                <td width="60" align="left" valign="top"><u>Ανά μέρα</u></td>
                <td width="110" align="left" valign="top" class="frm_td_bydays">
                  <font color="#000000">Κάθε μέρα<br/><i>(default)</i></font>
                </td>
                <td align="left" valign="top" class="frm_td_bydays">
                  <font color="#000000">Choose this option for a non-reoccurring single or multi-day event, with a new event occurrence for every day within the Start and End Date range</font>
                </td>
              </tr>
              <tr>
                <td width="60" rowspan="3" align="left" valign="top"><u>Ανά εβδομάδα</u></td>
                <td width="110" align="left" valign="top" class="frm_td_byweeks">
                  <font color="#000000">
                    Μιά φορά την εβδομάδα
                  </font>
                </td>
                <td align="left" valign="top" class="frm_td_byweeks">
                  <font color="#000000">
                  Αυτή η επιλογή σας επιτρέπει να επιλέξετε την μέρα απο την εβδόμαδα για επανάληψη. 
                  <table border="0" width="100%" height="100%"><tr><td><b>Ημέρα</b> for repeat type each 10/../2003</td></tr><tr><td><b>Day name</b> for repeat type each Δευτέρα</td></tr></table>
                  </font>
                </td>
              </tr>
              <tr>
                <td width="110" align="left" valign="top" class="frm_td_byweeks">
                  <font color="#000000">
                    Πολλές μέρες της εβδομάδας
                  </font>
                </td>
                <td align="left" valign="top" class="frm_td_byweeks">
                  <font color="#000000">Αυτή η επιλογή σας επιτρέπει να επιλέξετε τα γεγονότα ποιάς εβδομάδας να εμφανίζονται.</font>
                </td>
              </tr>
              <tr>
                <td width="110" align="left" valign="top" class="frm_td_byweeks">
                  <font color="#000000"><i>Εβδομάδα του μήνα # <br>For 'Once per Week' and 'Multiple Days Per Week' options above</i></font></td>
                  <td align="left" valign="top" class="frm_td_byweeks">
                  <font color="#000000">
                  <table border="0" width="100%" height="100%">
                    <tr><td><b>Week 1 :</b> 1η Εβδομάδα του μήνα</td></tr>
                    <tr><td><b>Week 2 :</b> 2η  Εβδομάδα του μήνα</td></tr>
                    <tr><td><b>Week 3 :</b> 3η  Εβδομάδα του μήνα</td></tr>
                    <tr><td><b>Week 4 :</b> 4η  Εβδομάδα του μήνα</td></tr>
                    <tr><td><b>Week 5 :</b> 5η  Εβδομάδα του μήνα (if applicable)</td></tr>
                   </table>
                 </font>
                </td>
              </tr>
              <tr>
                <td width="60" rowspan="2" align="left" valign="top"><u>Ανά μήνα</u></td>
                <td width="110" align="left" valign="top" class="frm_td_bymonth">
                  <font color="#000000">Μια φορά το μήνα</font></td>
                <td align="left" valign="top" class="frm_td_bymonth">
                  <font color="#000000">
                     Αυτή η επιλογή σας επιτρέπει να επιλέξετε την ημέρα επανάληψης του μήνα.
                     <table border="0" width="100%" height="100%"><tr><td><b>Ημερομηνία</b> for επανάληψη γράψτε κάθε 10/../2003</td></tr><tr><td><b>Ημέρα</b> for επανάληψη γράψτε κάθε each Δευτέρα</td></tr></table>

                  </font>
                </td>
              </tr>
              <tr>
                <td width="110" align="left" valign="top" class="frm_td_bymonth">
                  <font color="#000000">
                  Τέλος του κάθε μήνα
                  </font>
                </td>
                <td align="left" valign="top" class="frm_td_bymonth">
                  <font color="#000000">
				   The event is on the last day of each month independently of the day number, if that last day
		falls within the date range specified by the Start and End Dates for the event.
                  </font>
                </td>
              </tr>
              <tr>
                <td width="60" rowspan="2" align="left" valign="top"><u>Ανά χρόνο</u></td>
                <td width="110" align="left" valign="top" class="frm_td_byyear">
                  <font color="#000000">
                  Μιά φορά του χρόνο
                  </font>
                </td>
                <td align="left" valign="top" class="frm_td_byyear">
                  <font color="#000000">
                  Αυτή η επιλογή σας επιτρέπει να επιλέξετε μέρα για κάθε χρόνο.
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
