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
define("_CAL_LANG_COLOR_PICKER",		"Renk Seçici");

// common
define("_CAL_LANG_TIME",				"Zaman");
define("_CAL_LANG_CLICK_TO_OPEN_EVENT",	"Olayý görüntülemek için týklayýn");
define("_CAL_LANG_UNPUBLISHED",		"** Yayýnlanmamýþ **");
define("_CAL_LANG_DESCRIPTION",		"Açýklama");
define("_CAL_LANG_EMAIL_TO_AUTHOR",	"Yazara e-posta gönder");
define("_CAL_LANG_MAIL_TO_ADMIN",		"Olay [ %s ] [ %s ] tarafýndan eklenmiþ ");
define("_CAL_LANG_KEYWORD_NOT_VALID",	"Geçerli bir anahtar kelime deðil");
define("_CAL_LANG_EVENT_CALENDAR",		"Etkinlik Takvimi"); // new 1.4

// modul
define("_CAL_LANG_ERR_NO_MOD_CAL",		"Etkinlik Takvimi\n<br />JEvents isimli bileþeniniz kurulu deðil");
define("_CAL_LANG_CLICK_TOSWITCH_DAY",	"Takvime git - bu gün");
define("_CAL_LANG_CLICK_TOSWITCH_MON",	"Takvime git - bu ay");
define("_CAL_LANG_CLICK_TOSWITCH_YEAR",	"Takvime git - bu yýl");
define("_CAL_LANG_CLICK_TOSWITCH_PY",	"Takvime git - önceki yýl");
define("_CAL_LANG_CLICK_TOSWITCH_PM",	"Takvime git - önceki ay");
define("_CAL_LANG_CLICK_TOSWITCH_NM",	"Takvime git - sonraki ay");
define("_CAL_LANG_CLICK_TOSWITCH_NY",	"Takvime git - sonraki yýl");

// navTableNext
define("_CAL_LANG_NAV_TN_FIRST_LIST",	"ilk liste");
define("_CAL_LANG_NAV_TN_PREV_LIST",	"önceki liste");
define("_CAL_LANG_NAV_TN_NEXT_LIST",	"sonraki liste");
define("_CAL_LANG_NAV_TN_LAST_LIST",	"son liste");

// calendar monthly display
define("_CAL_LANG_FIRST_SINGLE_DAY_EVENT",		"Tek günlük olay");
define("_CAL_LANG_FIRST_DAY_OF_MULTIEVENT",	"Çok günlük olayýn ilk günü");
define("_CAL_LANG_LAST_DAY_OF_MULTIEVENT",		"Çok günlük olayýn son günü");
define("_CAL_LANG_MULTIDAY_EVENT",				"Çok günlük olay");
/* ++++++ end mic +++++++++++++ */

// Months
DEFINE("_CAL_LANG_JANUARY", "Ocak");
DEFINE("_CAL_LANG_FEBRUARY", "Þubat");
DEFINE("_CAL_LANG_MARCH", "Mart");
DEFINE("_CAL_LANG_APRIL", "Nisan");
DEFINE("_CAL_LANG_MAY", "Mayýs");
DEFINE("_CAL_LANG_JUNE", "Haziran");
DEFINE("_CAL_LANG_JULY", "Temmuz");
DEFINE("_CAL_LANG_AUGUST", "Aðustos");
DEFINE("_CAL_LANG_SEPTEMBER", "Eylül");
DEFINE("_CAL_LANG_OCTOBER", "Ekim");
DEFINE("_CAL_LANG_NOVEMBER", "Kasým");
DEFINE("_CAL_LANG_DECEMBER", "Aralýk");

// Short day names
DEFINE("_CAL_LANG_SUN", "Pzr");
DEFINE("_CAL_LANG_MON", "Pts");
DEFINE("_CAL_LANG_TUE", "Sal");
DEFINE("_CAL_LANG_WED", "Çar");
DEFINE("_CAL_LANG_THU", "Per");
DEFINE("_CAL_LANG_FRI", "Cum");
DEFINE("_CAL_LANG_SAT", "Cts");

// Days
DEFINE("_CAL_LANG_SUNDAY", "Pazar");
DEFINE("_CAL_LANG_MONDAY", "Pazartesi");
DEFINE("_CAL_LANG_TUESDAY", "Salý");
DEFINE("_CAL_LANG_WEDNESDAY", "Çarþamba");
DEFINE("_CAL_LANG_THURSDAY", "Perþembe");
DEFINE("_CAL_LANG_FRIDAY", "Cuma");
DEFINE("_CAL_LANG_SATURDAY", "Cumartesi");

// Days lettres
DEFINE("_CAL_LANG_SUNDAYSHORT", "P");
DEFINE("_CAL_LANG_MONDAYSHORT", "P");
DEFINE("_CAL_LANG_TUESDAYSHORT", "S");
DEFINE("_CAL_LANG_WEDNESDAYSHORT", "Ç");
DEFINE("_CAL_LANG_THURSDAYSHORT", "P");
DEFINE("_CAL_LANG_FRIDAYSHORT", "C");
DEFINE("_CAL_LANG_SATURDAYSHORT", "C");

// Repeat type
DEFINE("_CAL_LANG_ALLDAYS", "Her gün");
DEFINE("_CAL_LANG_EACHWEEK", "Her hafta");
DEFINE("_CAL_LANG_EACHWEEKPAIR", "Her çift hafta");
DEFINE("_CAL_LANG_EACHWEEKIMPAIR", "Her tek hafta");
DEFINE("_CAL_LANG_EACHMONTH", "Her ay");
DEFINE("_CAL_LANG_EACHYEAR", "Her yýl");
DEFINE("_CAL_LANG_ONLYDAYS", "Sadece seçili günler");
DEFINE("_CAL_LANG_EACH", "Her");
DEFINE("_CAL_LANG_EACHOF","'nin her");
DEFINE("_CAL_LANG_ENDMONTH", "ay sonu");

// Repeat days
DEFINE("_CAL_LANG_BYDAYNUMBER", "Gün numarasýna göre");

// User type
DEFINE("_CAL_LANG_ANONYME", "Anonim");

// Post
//PAS D'ACCENTS DANS LES _ACT_
DEFINE("_CAL_LANG_ACT_ADDED", "Katýlýmýnýz için teþekkürler - Lütfen biz gerekli iþlemleri yaparken bekleyin."); //NO ACCENT !!
DEFINE("_CAL_LANG_ACT_MODIFIED", "Bu olay deðiþtirildi."); //NO ACCENT !!
DEFINE("_CAL_LANG_ACT_PUBLISHED", "Bu olay yayýndadýr.");  //NEW 1.4
DEFINE("_CAL_LANG_ACT_DELETED", "Bu olay silindi!"); //NO ACCENT !!
DEFINE("_CAL_LANG_NOPERMISSION", "Bu bölüme eriþim hakkýnýz yok!"); //NO ACCENT !!

DEFINE("_CAL_LANG_MAIL_ADDED", "Yeni ekleme: ");
DEFINE("_CAL_LANG_MAIL_MODIFIED", "Yeni deðiþtirme: ");

// Presentation
DEFINE("_CAL_LANG_BY", "tarafýndan");
DEFINE("_CAL_LANG_FROM", "Kimden");
DEFINE("_CAL_LANG_TO", "Kime");
DEFINE("_CAL_LANG_ARCHIVE", "Arþiv(ler)");
DEFINE("_CAL_LANG_WEEK", "Bu Hafta");
DEFINE("_CAL_LANG_NO_EVENTS", "Olay yok");
DEFINE("_CAL_LANG_NO_EVENTFOR", "Olay Yok: ");
DEFINE("_CAL_LANG_NO_EVENTFORTHE", "Olay Yok: ");
DEFINE("_CAL_LANG_THIS_DAY", "Bu Gün");
DEFINE("_CAL_LANG_THIS_MONTH", "Bu Ay");
DEFINE("_CAL_LANG_LAST_MONTH", "Son Ay");
DEFINE("_CAL_LANG_NEXT_MONTH", "Sonraki Ay");
DEFINE("_CAL_LANG_EVENTSFOR", "Olay(lar): ");
DEFINE("_CAL_LANG_SEARCHRESULTS", "Þu Kelime(ler) Ýçin Arama Sonucu: "); // new 1.4
DEFINE("_CAL_LANG_EVENTSFORTHE", "Olay(lar): ");
DEFINE("_CAL_LANG_REP_DAY", "Gün");
DEFINE("_CAL_LANG_REP_WEEK", "Hafta");
DEFINE("_CAL_LANG_REP_WEEKPAIR", "her sonraki hafta");
DEFINE("_CAL_LANG_REP_WEEKIMPAIR", "her 3. hafta");
DEFINE("_CAL_LANG_REP_MONTH", "Ay");
DEFINE("_CAL_LANG_REP_YEAR", "Yýl");
DEFINE("_CAL_LANG_REP_NOEVENTSELECTED", "Lütfen önce bir olay seçin");

// Navigation
DEFINE("_CAL_LANG_VIEWTODAY", "Bugünkü Olaylar");
DEFINE("_CAL_LANG_VIEWTOCOME", "Bu Ayki Olaylar");
DEFINE("_CAL_LANG_VIEWBYDAY", "Gün Görünümü");
DEFINE("_CAL_LANG_VIEWBYCAT", "Kategori görünümü");
DEFINE("_CAL_LANG_VIEWBYMONTH", "Ay görünümü");
DEFINE("_CAL_LANG_VIEWBYYEAR", "Yýl Görünümü");
DEFINE("_CAL_LANG_VIEWBYWEEK", "Hafta Görünümü");
DEFINE("_CAL_LANG_JUMPTO", "Ay Seçin: ");  // New 1.4
DEFINE("_CAL_LANG_BACK", "Geri");
DEFINE("_CAL_LANG_CLOSE", "Kapat");
DEFINE("_CAL_LANG_PREVIOUSDAY", "Önceki Gün");
DEFINE("_CAL_LANG_PREVIOUSWEEK", "Önceki Hafta");
DEFINE("_CAL_LANG_PREVIOUSMONTH", "Önceki Ay");
DEFINE("_CAL_LANG_PREVIOUSYEAR", "Önceki Yýl");
DEFINE("_CAL_LANG_NEXTDAY", "Sonraki Gün");
DEFINE("_CAL_LANG_NEXTWEEK", "Sonraki Hafta");
DEFINE("_CAL_LANG_NEXTMONTH", "Sonraki Ay");
DEFINE("_CAL_LANG_NEXTYEAR", "Sonraki Yýl");

DEFINE("_CAL_LANG_ADMINPANEL", "Kontrol Paneli");
DEFINE("_CAL_LANG_ADDEVENT", "Olay Ekle");
DEFINE("_CAL_LANG_MYEVENTS", "Olaylarým");
DEFINE("_CAL_LANG_DELETE", "Sil");
DEFINE("_CAL_LANG_MODIFY", "Deðiþtir");

// Form
DEFINE("_CAL_LANG_HELP", "Yardým");

DEFINE("_CAL_LANG_CAL_TITLE", "Olaylar");
DEFINE("_CAL_LANG_ADD_TITLE", "Ekle");
DEFINE("_CAL_LANG_MODIFY_TITLE", "Deðiþtir");

DEFINE("_CAL_LANG_REPEAT_DISABLED", "Yinelenen Olay seçeneði sadece Bitiþ Tarihi Baþlangýç Tarihinden sonraysa aktif olur.  Lütfen Tekrarlanan Olay ayarlarýný yapmadan önce Bitiþ Tarihini sonraki bir tarihe ayarlayýnýz."); // New for 1.4
DEFINE("_CAL_LANG_EVENT_TITLE", "Konu");
DEFINE("_CAL_LANG_EVENT_COLOR", "Renk");
DEFINE("_CAL_LANG_EVENT_CATCOLOR", "Kategori rengi kullan");
DEFINE("_CAL_LANG_EVENT_CATEGORY", "Kategoriler");
DEFINE("_CAL_LANG_EVENT_CHOOSE_CATEG", "Lütfen kategori seçiniz");
DEFINE("_CAL_LANG_EVENT_ACTIVITY", "Etkinlik");
DEFINE("_CAL_LANG_EVENT_URLMAIL_INFO", "Baðlantý veya e-posta adresi eklemek için <br><u>http://www.adres.com</u> ya da <u>mailto:eposta@adresi.com</u> formatýnda yazýn.");
DEFINE("_CAL_LANG_EVENT_ADRESSE", "Yer");
DEFINE("_CAL_LANG_EVENT_CONTACT", "Ýletiþim");
DEFINE("_CAL_LANG_EVENT_EXTRA", "Ek Bilgi");
DEFINE("_CAL_LANG_EVENT_AUTHOR_ALIAS", "Yazar (alias)");
DEFINE("_CAL_LANG_EVENT_STARTDATE", "Baþlangýç Tarihi");
DEFINE("_CAL_LANG_EVENT_ENDDATE", "Bitiþ Tarihi");
DEFINE("_CAL_LANG_EVENT_STARTHOURS", "Baþlama Saati");
DEFINE("_CAL_LANG_EVENT_ENDHOURS", "Bitiþ Saati");
DEFINE("_CAL_LANG_EVENT_STARTTIME", "Baþlangýç Zamaný");
DEFINE("_CAL_LANG_EVENT_ENDTIME", "Bitiþ Zamaný");
DEFINE("_CAL_LANG_PUB_INFO", "Yayýnlanma Tarihi");
DEFINE("_CAL_LANG_EVENT_REPEATTYPE", "Yinelenme Þekli");
DEFINE("_CAL_LANG_EVENT_REPEATDAY", "Yineleme Günü");
DEFINE("_CAL_LANG_EVENT_CHOOSE_WEEKDAYS", "Haftanýn günleri");
DEFINE("_CAL_LANG_EVENT_PER", "kere, her");
DEFINE("_CAL_LANG_EVENT_WEEKOPT", "Haftalar: <br>Hafta Yinelemesi:");

DEFINE("_CAL_LANG_SUBMITPREVIEW", "Önizleme");
DEFINE("_CAL_LANG_SUBMITCANCEL", "Ýptal");
DEFINE("_CAL_LANG_SUBMITSAVE", "Kaydet");

DEFINE("_CAL_LANG_E_WARNWEEKS", "Lütfen bir hafta seçin.");
DEFINE("_CAL_LANG_E_WARNDAYS", "Lütfen bir gün seçin.");

// Admin
DEFINE("_CAL_LANG_EVENT_ALLCAT", "Tüm kategoriler");
DEFINE("_CAL_LANG_EVENT_ACCESSLEVEL", "Eriþim seviyesi");
DEFINE("_CAL_LANG_EVENT_HITS", "Týklamalar");
DEFINE("_CAL_LANG_EVENT_STATE", "Durum");
DEFINE("_CAL_LANG_EVENT_CREATED", "Kayýt");
DEFINE("_CAL_LANG_EVENT_NEWEVENT", "Yeni Olay");
DEFINE("_CAL_LANG_EVENT_MODIFIED", "Son Düzenleme");
DEFINE("_CAL_LANG_EVENT_NOTMODIFIED", "Düzenlenmemiþ");

// dmcd aug 22/04  new warning alert for no specified activity in event entry
DEFINE("_CAL_LANG_WARNACTIVITY", "Belirsiz etkinlik\\nBi açýklama ekleyin de bilelim.");

DEFINE("_CAL_LEGEND_ALL_CATEGORIES", "Tüm Kategoriler ...");  // new for 1.4
DEFINE("_CAL_LEGEND_ALL_CATEGORIES_DESC", "Tüm kategorilerdeki olaylarý göster");  // new for 1.4

DEFINE("_CAL_LANG_FORM_HELP_COLOR", <<<END
        <tr>
		  <td width="110" align="left" valign="top">
            <b>Renk</b>
          </td>
          <td>Ay görünümünde etkin olacak arkaplan rengini seçin. Kategori kutucuðu seçilmiþse,
		  seçilen renk seçtiðiniz kategori için öntan&#305;ml&#305; renk olacak ve Renk Seçicisi özelliði devre d&#305;þ&#305; kalacak.</td>
        </tr>
END
);

DEFINE("_CAL_LANG_FORM_HELP",  <<<END
    	<tr>
          <td align="left"><b>Tarih</b></td>
          <td>Eklediðiniz olay&#305;n Baþlang&#305;ç ve Bitiþ tarihlerini giriniz.</td>
        </tr>
    	<tr>
          <td align="left" valign="top"><b>Zaman</b></td>
          <td>Eklediðiniz olay&#305;n saatini giriniz.  Format <span style='color:blue;font-weight:bold;'>ss:dd {am|pm}</span> þeklinde olmal&#305;d&#305;r.<br/>Zaman 12 ya da 24 saat olarak girilebilir.<br/><br/><b><i><span style='color:red;'>(Yeni)</span></i> Dikkat!</b> <span style='color:red;font-weight:bold;'>gece yarýsýný geçen ve bir günden kýsa süren olaylar için</span> özel bir durum vardýr.  IE. Örneðin, saat 19:00'da baþlay&#305;p 3:00'de biten tek günlük bir olay için, Baþlang&#305;ç ve Bitiþ tarihleri ayn&#305; olmak zorundad&#305;r ve geceyar&#305;s&#305;n&#305; geçmemelidir.</td>
        </tr>
END
);

DEFINE("_CAL_LANG_FORM_HELP_EXTENDED",  <<<END
        <tr>
    	  <td align="left" valign="top" nowrap><b>Yineleme Þekli</b></td>
  	  	<td colspan="2"></td>
  		</tr>
  		<tr>
    	  <td colspan="2" align="left" valign="top">
	    	<table width="100%" border="0" cellspacing="2">
              <tr>
                <td width="60" align="left" valign="top"><u>Güne Göre</u></td>
                <td width="110" align="left" valign="top" class="frm_td_bydays">
                  <font color="#000000">Her Gün<br/><i>(default)</i></font>
                </td>
                <td align="left" valign="top" class="frm_td_bydays">
                  <font color="#000000">Bu seçeneði tek veya çok günlü olayýn Baþlang&#305;ç ve Bitiþ tarihleri aras&#305;nda yinelenmesi için seçin.</font>
                </td>
              </tr>
              <tr>
                <td width="60" rowspan="3" align="left" valign="top"><u>Haftaya Göre</u></td>
                <td width="110" align="left" valign="top" class="frm_td_byweeks">
                  <font color="#000000">
                    Haftada Bir
                  </font>
                </td>
                <td align="left" valign="top" class="frm_td_byweeks">
                  <font color="#000000">
                  Bu seçenek her hafta tekrarlanacak bir gün seçmek içindir.
                  <table border="0" width="100%" height="100%"><tr><td><b>Gün numaras&#305;</b>na göre tekrarlayabilir.</td></tr><tr><td><b>Gün ismi</b>ne göre tekrarlayabilir.</td></tr></table>
                  </font>
                </td>
              </tr>
              <tr>
                <td width="110" align="left" valign="top" class="frm_td_byweeks">
                  <font color="#000000">
                    Her Hafta Birden Çok Gün
                  </font>
                </td>
                <td align="left" valign="top" class="frm_td_byweeks">
                  <font color="#000000">Bu seçenek her hafta haftan&#305;n hangi günleri olay&#305;n tekrarlanacað&#305;n&#305; belirler.</font>
                </td>
              </tr>
              <tr>
                <td width="110" align="left" valign="top" class="frm_td_byweeks">
                  <font color="#000000"><i>Ay&#305;n günleri # <br>Yukar&#305;daki 'Ayda Bir' ve 'Haftada Birden Çok Gün' seçenekleri içindir.</i></font></td>
                  <td align="left" valign="top" class="frm_td_byweeks">
                  <font color="#000000">
                  <table border="0" width="100%" height="100%">
                    <tr><td><b>Hafta 1 :</b> Ay&#305;n ilk haftas&#305;</td></tr>
                    <tr><td><b>Hafta 2 :</b> Ay&#305;n ikinci haftas&#305;</td></tr>
                    <tr><td><b>Hafta 3 :</b> Ay&#305;n üçüncü haftas&#305;</td></tr>
                    <tr><td><b>Hafta 4 :</b> Ay&#305;n dördüncü haftas&#305;</td></tr>
                    <tr><td><b>Hafta 5 :</b> Ay&#305;n beþinci haftas&#305; (gerekirse)</td></tr>
                   </table>
                 </font>
                </td>
              </tr>
              <tr>
                <td width="60" rowspan="2" align="left" valign="top"><u>Aya Göre</u></td>
                <td width="110" align="left" valign="top" class="frm_td_bymonth">
                  <font color="#000000">Ayda Bir</font></td>
                <td align="left" valign="top" class="frm_td_bymonth">
                  <font color="#000000">
                     Bu seçenek her ay yinelenen olay içindir.
                     <table border="0" width="100%" height="100%"><tr><td><b>Gün numaras&#305;</b>na göre tekrarlayabilir .</td></tr><tr><td><b>Gün ismi</b>ne göre tekrarlayabilir.</td></tr></table>

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
				   Olay gün numaras&#305;ndan bað&#305;ms&#305;z olarak verilen Baþlang&#305;ç ve Bitiþ tarihleri içinde her ay&#305;n son günü tekrarlan&#305;r.
                  </font>
                </td>
              </tr>
              <tr>
                <td width="60" rowspan="2" align="left" valign="top"><u>Y&#305;la Göre</u></td>
                <td width="110" align="left" valign="top" class="frm_td_byyear">
                  <font color="#000000">
                  Y&#305;lda Bir
                  </font>
                </td>
                <td align="left" valign="top" class="frm_td_byyear">
                  <font color="#000000">
                  Bu seçenek her y&#305;l tek bir gün yinelenen olaylar için geçerlidir.
                  <table border="0" width="100%" height="100%"><tr><td><b>Gün numaras&#305;</b> her y&#305;l o gün(ler)de olay yinelenir.</td></tr><tr><td><b>Gün ismi</b> gün ismine göre tekrarlar</td></tr></table>
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
