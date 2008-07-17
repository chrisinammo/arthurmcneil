<?php
/**
 * Events Component for Joomla 1.0.x
 *
 * @version     $Id: turkish.php 991 2008-03-10 19:55:48Z tstahl $
 * @package     Events
 * @copyright   Copyright (C) 2006-2008 JEvents Project Group
 * @licence     http://www.gnu.org/copyleft/gpl.html
 * @link        http://joomlacode.org/gf/project/jevents
 * @translated  Durukan Duru
 * @encoding    windows-1254
 */

defined("_VALID_MOS") or die( 'Restricted access' );

//Check
DEFINE("_CAL_LANG_INCLUDED", 1);

// new 1.4.0 [mic]
define("_CAL_LANG_LNG",				"en"); // de|fr|etc... [ DO NOT CHANGE THIS VALUE! ]
define("_CAL_LANG_REPEAT_GRAMMAR",	"1"); // in repeat summary 1 = follow English word orde, 2= follow German word orderr

// used for colorpicker
define("_CAL_LANG_NO_COLOR",			"Renksiz");
define("_CAL_LANG_COLOR_PICKER",		"Renk Se�ici");

// common
define("_CAL_LANG_TIME",				"Zaman");
define("_CAL_LANG_CLICK_TO_OPEN_EVENT",	"Olay� g�r�nt�lemek i�in t�klay�n");
define("_CAL_LANG_UNPUBLISHED",		"** Yay�nlanmam�� **");
define("_CAL_LANG_DESCRIPTION",		"A��klama");
define("_CAL_LANG_EMAIL_TO_AUTHOR",	"Yazara e-posta g�nder");
define("_CAL_LANG_MAIL_TO_ADMIN",		"Olay [ %s ] [ %s ] taraf�ndan eklenmi� ");
define("_CAL_LANG_KEYWORD_NOT_VALID",	"Ge�erli bir anahtar kelime de�il");
define("_CAL_LANG_EVENT_CALENDAR",		"Etkinlik Takvimi"); // new 1.4

// modul
define("_CAL_LANG_ERR_NO_MOD_CAL",		"Etkinlik Takvimi\n<br />JEvents isimli bile�eniniz kurulu de�il");
define("_CAL_LANG_CLICK_TOSWITCH_DAY",	"Takvime git - bu g�n");
define("_CAL_LANG_CLICK_TOSWITCH_MON",	"Takvime git - bu ay");
define("_CAL_LANG_CLICK_TOSWITCH_YEAR",	"Takvime git - bu y�l");
define("_CAL_LANG_CLICK_TOSWITCH_PY",	"Takvime git - �nceki y�l");
define("_CAL_LANG_CLICK_TOSWITCH_PM",	"Takvime git - �nceki ay");
define("_CAL_LANG_CLICK_TOSWITCH_NM",	"Takvime git - sonraki ay");
define("_CAL_LANG_CLICK_TOSWITCH_NY",	"Takvime git - sonraki y�l");

// navTableNext
define("_CAL_LANG_NAV_TN_FIRST_LIST",	"ilk liste");
define("_CAL_LANG_NAV_TN_PREV_LIST",	"�nceki liste");
define("_CAL_LANG_NAV_TN_NEXT_LIST",	"sonraki liste");
define("_CAL_LANG_NAV_TN_LAST_LIST",	"son liste");

// calendar monthly display
define("_CAL_LANG_FIRST_SINGLE_DAY_EVENT",		"Tek g�nl�k olay");
define("_CAL_LANG_FIRST_DAY_OF_MULTIEVENT",	"�ok g�nl�k olay�n ilk g�n�");
define("_CAL_LANG_LAST_DAY_OF_MULTIEVENT",		"�ok g�nl�k olay�n son g�n�");
define("_CAL_LANG_MULTIDAY_EVENT",				"�ok g�nl�k olay");
/* ++++++ end mic +++++++++++++ */

// Months
DEFINE("_CAL_LANG_JANUARY", "Ocak");
DEFINE("_CAL_LANG_FEBRUARY", "�ubat");
DEFINE("_CAL_LANG_MARCH", "Mart");
DEFINE("_CAL_LANG_APRIL", "Nisan");
DEFINE("_CAL_LANG_MAY", "May�s");
DEFINE("_CAL_LANG_JUNE", "Haziran");
DEFINE("_CAL_LANG_JULY", "Temmuz");
DEFINE("_CAL_LANG_AUGUST", "A�ustos");
DEFINE("_CAL_LANG_SEPTEMBER", "Eyl�l");
DEFINE("_CAL_LANG_OCTOBER", "Ekim");
DEFINE("_CAL_LANG_NOVEMBER", "Kas�m");
DEFINE("_CAL_LANG_DECEMBER", "Aral�k");

// Short day names
DEFINE("_CAL_LANG_SUN", "Pzr");
DEFINE("_CAL_LANG_MON", "Pts");
DEFINE("_CAL_LANG_TUE", "Sal");
DEFINE("_CAL_LANG_WED", "�ar");
DEFINE("_CAL_LANG_THU", "Per");
DEFINE("_CAL_LANG_FRI", "Cum");
DEFINE("_CAL_LANG_SAT", "Cts");

// Days
DEFINE("_CAL_LANG_SUNDAY", "Pazar");
DEFINE("_CAL_LANG_MONDAY", "Pazartesi");
DEFINE("_CAL_LANG_TUESDAY", "Sal�");
DEFINE("_CAL_LANG_WEDNESDAY", "�ar�amba");
DEFINE("_CAL_LANG_THURSDAY", "Per�embe");
DEFINE("_CAL_LANG_FRIDAY", "Cuma");
DEFINE("_CAL_LANG_SATURDAY", "Cumartesi");

// Days lettres
DEFINE("_CAL_LANG_SUNDAYSHORT", "P");
DEFINE("_CAL_LANG_MONDAYSHORT", "P");
DEFINE("_CAL_LANG_TUESDAYSHORT", "S");
DEFINE("_CAL_LANG_WEDNESDAYSHORT", "�");
DEFINE("_CAL_LANG_THURSDAYSHORT", "P");
DEFINE("_CAL_LANG_FRIDAYSHORT", "C");
DEFINE("_CAL_LANG_SATURDAYSHORT", "C");

// Repeat type
DEFINE("_CAL_LANG_ALLDAYS", "Her g�n");
DEFINE("_CAL_LANG_EACHWEEK", "Her hafta");
DEFINE("_CAL_LANG_EACHWEEKPAIR", "Her �ift hafta");
DEFINE("_CAL_LANG_EACHWEEKIMPAIR", "Her tek hafta");
DEFINE("_CAL_LANG_EACHMONTH", "Her ay");
DEFINE("_CAL_LANG_EACHYEAR", "Her y�l");
DEFINE("_CAL_LANG_ONLYDAYS", "Sadece se�ili g�nler");
DEFINE("_CAL_LANG_EACH", "Her");
DEFINE("_CAL_LANG_EACHOF","'nin her");
DEFINE("_CAL_LANG_ENDMONTH", "ay sonu");

// Repeat days
DEFINE("_CAL_LANG_BYDAYNUMBER", "G�n numaras�na g�re");

// User type
DEFINE("_CAL_LANG_ANONYME", "Anonim");

// Post
//PAS D'ACCENTS DANS LES _ACT_
DEFINE("_CAL_LANG_ACT_ADDED", "Kat�l�m�n�z i�in te�ekk�rler - L�tfen biz gerekli i�lemleri yaparken bekleyin."); //NO ACCENT !!
DEFINE("_CAL_LANG_ACT_MODIFIED", "Bu olay de�i�tirildi."); //NO ACCENT !!
DEFINE("_CAL_LANG_ACT_PUBLISHED", "Bu olay yay�ndad�r.");  //NEW 1.4
DEFINE("_CAL_LANG_ACT_DELETED", "Bu olay silindi!"); //NO ACCENT !!
DEFINE("_CAL_LANG_NOPERMISSION", "Bu b�l�me eri�im hakk�n�z yok!"); //NO ACCENT !!

DEFINE("_CAL_LANG_MAIL_ADDED", "Yeni ekleme: ");
DEFINE("_CAL_LANG_MAIL_MODIFIED", "Yeni de�i�tirme: ");

// Presentation
DEFINE("_CAL_LANG_BY", "taraf�ndan");
DEFINE("_CAL_LANG_FROM", "Kimden");
DEFINE("_CAL_LANG_TO", "Kime");
DEFINE("_CAL_LANG_ARCHIVE", "Ar�iv(ler)");
DEFINE("_CAL_LANG_WEEK", "Bu Hafta");
DEFINE("_CAL_LANG_NO_EVENTS", "Olay yok");
DEFINE("_CAL_LANG_NO_EVENTFOR", "Olay Yok: ");
DEFINE("_CAL_LANG_NO_EVENTFORTHE", "Olay Yok: ");
DEFINE("_CAL_LANG_THIS_DAY", "Bu G�n");
DEFINE("_CAL_LANG_THIS_MONTH", "Bu Ay");
DEFINE("_CAL_LANG_LAST_MONTH", "Son Ay");
DEFINE("_CAL_LANG_NEXT_MONTH", "Sonraki Ay");
DEFINE("_CAL_LANG_EVENTSFOR", "Olay(lar): ");
DEFINE("_CAL_LANG_SEARCHRESULTS", "�u Kelime(ler) ��in Arama Sonucu: "); // new 1.4
DEFINE("_CAL_LANG_EVENTSFORTHE", "Olay(lar): ");
DEFINE("_CAL_LANG_REP_DAY", "G�n");
DEFINE("_CAL_LANG_REP_WEEK", "Hafta");
DEFINE("_CAL_LANG_REP_WEEKPAIR", "her sonraki hafta");
DEFINE("_CAL_LANG_REP_WEEKIMPAIR", "her 3. hafta");
DEFINE("_CAL_LANG_REP_MONTH", "Ay");
DEFINE("_CAL_LANG_REP_YEAR", "Y�l");
DEFINE("_CAL_LANG_REP_NOEVENTSELECTED", "L�tfen �nce bir olay se�in");

// Navigation
DEFINE("_CAL_LANG_VIEWTODAY", "Bug�nk� Olaylar");
DEFINE("_CAL_LANG_VIEWTOCOME", "Bu Ayki Olaylar");
DEFINE("_CAL_LANG_VIEWBYDAY", "G�n G�r�n�m�");
DEFINE("_CAL_LANG_VIEWBYCAT", "Kategori g�r�n�m�");
DEFINE("_CAL_LANG_VIEWBYMONTH", "Ay g�r�n�m�");
DEFINE("_CAL_LANG_VIEWBYYEAR", "Y�l G�r�n�m�");
DEFINE("_CAL_LANG_VIEWBYWEEK", "Hafta G�r�n�m�");
DEFINE("_CAL_LANG_JUMPTO", "Ay Se�in: ");  // New 1.4
DEFINE("_CAL_LANG_BACK", "Geri");
DEFINE("_CAL_LANG_CLOSE", "Kapat");
DEFINE("_CAL_LANG_PREVIOUSDAY", "�nceki G�n");
DEFINE("_CAL_LANG_PREVIOUSWEEK", "�nceki Hafta");
DEFINE("_CAL_LANG_PREVIOUSMONTH", "�nceki Ay");
DEFINE("_CAL_LANG_PREVIOUSYEAR", "�nceki Y�l");
DEFINE("_CAL_LANG_NEXTDAY", "Sonraki G�n");
DEFINE("_CAL_LANG_NEXTWEEK", "Sonraki Hafta");
DEFINE("_CAL_LANG_NEXTMONTH", "Sonraki Ay");
DEFINE("_CAL_LANG_NEXTYEAR", "Sonraki Y�l");

DEFINE("_CAL_LANG_ADMINPANEL", "Kontrol Paneli");
DEFINE("_CAL_LANG_ADDEVENT", "Olay Ekle");
DEFINE("_CAL_LANG_MYEVENTS", "Olaylar�m");
DEFINE("_CAL_LANG_DELETE", "Sil");
DEFINE("_CAL_LANG_MODIFY", "De�i�tir");

// Form
DEFINE("_CAL_LANG_HELP", "Yard�m");

DEFINE("_CAL_LANG_CAL_TITLE", "Olaylar");
DEFINE("_CAL_LANG_ADD_TITLE", "Ekle");
DEFINE("_CAL_LANG_MODIFY_TITLE", "De�i�tir");

DEFINE("_CAL_LANG_REPEAT_DISABLED", "Yinelenen Olay se�ene�i sadece Biti� Tarihi Ba�lang�� Tarihinden sonraysa aktif olur.  L�tfen Tekrarlanan Olay ayarlar�n� yapmadan �nce Biti� Tarihini sonraki bir tarihe ayarlay�n�z."); // New for 1.4
DEFINE("_CAL_LANG_EVENT_TITLE", "Konu");
DEFINE("_CAL_LANG_EVENT_COLOR", "Renk");
DEFINE("_CAL_LANG_EVENT_CATCOLOR", "Kategori rengi kullan");
DEFINE("_CAL_LANG_EVENT_CATEGORY", "Kategoriler");
DEFINE("_CAL_LANG_EVENT_CHOOSE_CATEG", "L�tfen kategori se�iniz");
DEFINE("_CAL_LANG_EVENT_ACTIVITY", "Etkinlik");
DEFINE("_CAL_LANG_EVENT_URLMAIL_INFO", "Ba�lant� veya e-posta adresi eklemek i�in <br><u>http://www.adres.com</u> ya da <u>mailto:eposta@adresi.com</u> format�nda yaz�n.");
DEFINE("_CAL_LANG_EVENT_ADRESSE", "Yer");
DEFINE("_CAL_LANG_EVENT_CONTACT", "�leti�im");
DEFINE("_CAL_LANG_EVENT_EXTRA", "Ek Bilgi");
DEFINE("_CAL_LANG_EVENT_AUTHOR_ALIAS", "Yazar (alias)");
DEFINE("_CAL_LANG_EVENT_STARTDATE", "Ba�lang�� Tarihi");
DEFINE("_CAL_LANG_EVENT_ENDDATE", "Biti� Tarihi");
DEFINE("_CAL_LANG_EVENT_STARTHOURS", "Ba�lama Saati");
DEFINE("_CAL_LANG_EVENT_ENDHOURS", "Biti� Saati");
DEFINE("_CAL_LANG_EVENT_STARTTIME", "Ba�lang�� Zaman�");
DEFINE("_CAL_LANG_EVENT_ENDTIME", "Biti� Zaman�");
DEFINE("_CAL_LANG_PUB_INFO", "Yay�nlanma Tarihi");
DEFINE("_CAL_LANG_EVENT_REPEATTYPE", "Yinelenme �ekli");
DEFINE("_CAL_LANG_EVENT_REPEATDAY", "Yineleme G�n�");
DEFINE("_CAL_LANG_EVENT_CHOOSE_WEEKDAYS", "Haftan�n g�nleri");
DEFINE("_CAL_LANG_EVENT_PER", "kere, her");
DEFINE("_CAL_LANG_EVENT_WEEKOPT", "Haftalar: <br>Hafta Yinelemesi:");

DEFINE("_CAL_LANG_SUBMITPREVIEW", "�nizleme");
DEFINE("_CAL_LANG_SUBMITCANCEL", "�ptal");
DEFINE("_CAL_LANG_SUBMITSAVE", "Kaydet");

DEFINE("_CAL_LANG_E_WARNWEEKS", "L�tfen bir hafta se�in.");
DEFINE("_CAL_LANG_E_WARNDAYS", "L�tfen bir g�n se�in.");

// Admin
DEFINE("_CAL_LANG_EVENT_ALLCAT", "T�m kategoriler");
DEFINE("_CAL_LANG_EVENT_ACCESSLEVEL", "Eri�im seviyesi");
DEFINE("_CAL_LANG_EVENT_HITS", "T�klamalar");
DEFINE("_CAL_LANG_EVENT_STATE", "Durum");
DEFINE("_CAL_LANG_EVENT_CREATED", "Kay�t");
DEFINE("_CAL_LANG_EVENT_NEWEVENT", "Yeni Olay");
DEFINE("_CAL_LANG_EVENT_MODIFIED", "Son D�zenleme");
DEFINE("_CAL_LANG_EVENT_NOTMODIFIED", "D�zenlenmemi�");

// dmcd aug 22/04  new warning alert for no specified activity in event entry
DEFINE("_CAL_LANG_WARNACTIVITY", "Belirsiz etkinlik\\nBi a��klama ekleyin de bilelim.");

DEFINE("_CAL_LEGEND_ALL_CATEGORIES", "T�m Kategoriler ...");  // new for 1.4
DEFINE("_CAL_LEGEND_ALL_CATEGORIES_DESC", "T�m kategorilerdeki olaylar� g�ster");  // new for 1.4

DEFINE("_CAL_LANG_FORM_HELP_COLOR", <<<END
        <tr>
		  <td width="110" align="left" valign="top">
            <b>Renk</b>
          </td>
          <td>Ay g�r�n�m�nde etkin olacak arkaplan rengini se�in. Kategori kutucu�u se�ilmi�se,
		  se�ilen renk se�ti�iniz kategori i�in �ntan&#305;ml&#305; renk olacak ve Renk Se�icisi �zelli�i devre d&#305;�&#305; kalacak.</td>
        </tr>
END
);

DEFINE("_CAL_LANG_FORM_HELP",  <<<END
    	<tr>
          <td align="left"><b>Tarih</b></td>
          <td>Ekledi�iniz olay&#305;n Ba�lang&#305;� ve Biti� tarihlerini giriniz.</td>
        </tr>
    	<tr>
          <td align="left" valign="top"><b>Zaman</b></td>
          <td>Ekledi�iniz olay&#305;n saatini giriniz.  Format <span style='color:blue;font-weight:bold;'>ss:dd {am|pm}</span> �eklinde olmal&#305;d&#305;r.<br/>Zaman 12 ya da 24 saat olarak girilebilir.<br/><br/><b><i><span style='color:red;'>(Yeni)</span></i> Dikkat!</b> <span style='color:red;font-weight:bold;'>gece yar�s�n� ge�en ve bir g�nden k�sa s�ren olaylar i�in</span> �zel bir durum vard�r.  IE. �rne�in, saat 19:00'da ba�lay&#305;p 3:00'de biten tek g�nl�k bir olay i�in, Ba�lang&#305;� ve Biti� tarihleri ayn&#305; olmak zorundad&#305;r ve geceyar&#305;s&#305;n&#305; ge�memelidir.</td>
        </tr>
END
);

DEFINE("_CAL_LANG_FORM_HELP_EXTENDED",  <<<END
        <tr>
    	  <td align="left" valign="top" nowrap><b>Yineleme �ekli</b></td>
  	  	<td colspan="2"></td>
  		</tr>
  		<tr>
    	  <td colspan="2" align="left" valign="top">
	    	<table width="100%" border="0" cellspacing="2">
              <tr>
                <td width="60" align="left" valign="top"><u>G�ne G�re</u></td>
                <td width="110" align="left" valign="top" class="frm_td_bydays">
                  <font color="#000000">Her G�n<br/><i>(default)</i></font>
                </td>
                <td align="left" valign="top" class="frm_td_bydays">
                  <font color="#000000">Bu se�ene�i tek veya �ok g�nl� olay�n Ba�lang&#305;� ve Biti� tarihleri aras&#305;nda yinelenmesi i�in se�in.</font>
                </td>
              </tr>
              <tr>
                <td width="60" rowspan="3" align="left" valign="top"><u>Haftaya G�re</u></td>
                <td width="110" align="left" valign="top" class="frm_td_byweeks">
                  <font color="#000000">
                    Haftada Bir
                  </font>
                </td>
                <td align="left" valign="top" class="frm_td_byweeks">
                  <font color="#000000">
                  Bu se�enek her hafta tekrarlanacak bir g�n se�mek i�indir.
                  <table border="0" width="100%" height="100%"><tr><td><b>G�n numaras&#305;</b>na g�re tekrarlayabilir.</td></tr><tr><td><b>G�n ismi</b>ne g�re tekrarlayabilir.</td></tr></table>
                  </font>
                </td>
              </tr>
              <tr>
                <td width="110" align="left" valign="top" class="frm_td_byweeks">
                  <font color="#000000">
                    Her Hafta Birden �ok G�n
                  </font>
                </td>
                <td align="left" valign="top" class="frm_td_byweeks">
                  <font color="#000000">Bu se�enek her hafta haftan&#305;n hangi g�nleri olay&#305;n tekrarlanaca�&#305;n&#305; belirler.</font>
                </td>
              </tr>
              <tr>
                <td width="110" align="left" valign="top" class="frm_td_byweeks">
                  <font color="#000000"><i>Ay&#305;n g�nleri # <br>Yukar&#305;daki 'Ayda Bir' ve 'Haftada Birden �ok G�n' se�enekleri i�indir.</i></font></td>
                  <td align="left" valign="top" class="frm_td_byweeks">
                  <font color="#000000">
                  <table border="0" width="100%" height="100%">
                    <tr><td><b>Hafta 1 :</b> Ay&#305;n ilk haftas&#305;</td></tr>
                    <tr><td><b>Hafta 2 :</b> Ay&#305;n ikinci haftas&#305;</td></tr>
                    <tr><td><b>Hafta 3 :</b> Ay&#305;n ���nc� haftas&#305;</td></tr>
                    <tr><td><b>Hafta 4 :</b> Ay&#305;n d�rd�nc� haftas&#305;</td></tr>
                    <tr><td><b>Hafta 5 :</b> Ay&#305;n be�inci haftas&#305; (gerekirse)</td></tr>
                   </table>
                 </font>
                </td>
              </tr>
              <tr>
                <td width="60" rowspan="2" align="left" valign="top"><u>Aya G�re</u></td>
                <td width="110" align="left" valign="top" class="frm_td_bymonth">
                  <font color="#000000">Ayda Bir</font></td>
                <td align="left" valign="top" class="frm_td_bymonth">
                  <font color="#000000">
                     Bu se�enek her ay yinelenen olay i�indir.
                     <table border="0" width="100%" height="100%"><tr><td><b>G�n numaras&#305;</b>na g�re tekrarlayabilir .</td></tr><tr><td><b>G�n ismi</b>ne g�re tekrarlayabilir.</td></tr></table>

                  </font>
                </td>
              </tr>
              <tr>
                <td width="110" align="left" valign="top" class="frm_td_bymonth">
                  <font color="#000000">
                  Her Ay Sonu
                  </font>
                </td>
                <td align="left" valign="top" class="frm_td_bymonth">
                  <font color="#000000">
				   Olay g�n numaras&#305;ndan ba�&#305;ms&#305;z olarak verilen Ba�lang&#305;� ve Biti� tarihleri i�inde her ay&#305;n son g�n� tekrarlan&#305;r.
                  </font>
                </td>
              </tr>
              <tr>
                <td width="60" rowspan="2" align="left" valign="top"><u>Y&#305;la G�re</u></td>
                <td width="110" align="left" valign="top" class="frm_td_byyear">
                  <font color="#000000">
                  Y&#305;lda Bir
                  </font>
                </td>
                <td align="left" valign="top" class="frm_td_byyear">
                  <font color="#000000">
                  Bu se�enek her y&#305;l tek bir g�n yinelenen olaylar i�in ge�erlidir.
                  <table border="0" width="100%" height="100%"><tr><td><b>G�n numaras&#305;</b> her y&#305;l o g�n(ler)de olay yinelenir.</td></tr><tr><td><b>G�n ismi</b> g�n ismine g�re tekrarlar</td></tr></table>
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
