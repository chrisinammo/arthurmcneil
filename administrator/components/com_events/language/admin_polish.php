<?php
/**
 * Events Component for Joomla 1.0.x
 *
 * @version     $Id: admin_polish.php 860 2007-08-04 08:54:28Z tstahl $
 * @package     Events
 * @copyright   Copyright (C) 2006 JEvents Project Group
 * @licence     http://www.gnu.org/copyleft/gpl.html
 * @link        http://forge.joomla.org/sf/projects/jevents
 * @Tranlate    Jakub Dirska - http://www.webir.eu
 */


defined( '_VALID_MOS' ) or defined( '_JEXEC' ) or die( 'Restricted access' );

//Check
if( defined( '_CAL_ADMIN_LANG_INCLUDED' )) {
	return;
}

DEFINE( '_CAL_ADMIN_LANG_INCLUDED', 1 );

/* +++++++++++++++++++ */
define( '_CAL_HIDE_OLD_EVENTS',			'Ukryj stare wydarzenia'); // NEW 1.4
define( '_CAL_LANG_CATEGORIES',   		'Kategorie' );
define( '_CAL_LANG_DISPLAY',			'Widok' );
define( '_CAL_LANG_CATEGORY_NAME',		'Nazwa kategorii' );
define( '_CAL_LANG_RECORDS',			'spo�r�d pozycji' );
define( '_CAL_LANG_CHECKED_OUT',		'Sprawdzone' );
define( '_CAL_LANG_PUBLISHED',			'Opublikowany' );
define( '_CAL_LANG_NOT_PUBLISHED',		'Nie opublikowane' );
define( '_CAL_LANG_ACCESS',				'Dost�p' );
define( '_CAL_LANG_REORDER',			'Reorder' );
define( '_CAL_LANG_UNPUBLISH',			'Nie publikkuj' );
define( '_CAL_LANG_PUBLISH',			'Publikuj' );
define( '_CAL_LANG_CLICK_TO_EDIT',		'Edytuj' );
define( '_CAL_LANG_MOVE_UP',			'W g�r�' );
define( '_CAL_LANG_MOVE_DOWN',			'W d�' );
define( '_CAL_LANG_EDIT_CAT',			'Edytuj kategori�' );
define( '_CAL_LANG_ADD_CAT',			'Dodaj Kategori�' );
define( '_CAL_LANG_CAT_TITLE',			'Tytu� Kategorii' );
define( '_CAL_LANG_CAT_NAME',			'Nazwa Kategorii' );
define( '_CAL_LANG_IMAGE',				'Obrazek' );
define( '_CAL_LANG_PREVIEW',			'Podgl�d' );
define( '_CAL_LANG_IMG_POSITION',		'Pozycja obrazka' );
define( '_CAL_LANG_ORDERING',			'Pozycja' );
define( '_CAL_LANG_LEFT',				'Lewo' );
define( '_CAL_LANG_CENTER',				'�rodek' );
define( '_CAL_LANG_RIGHT',				'Prawo' );
define( '_CAL_LANG_SELECT_IMAGE',		'Wybierz obraz' );
define( '_CAL_LANG_SEARCH',				'Szukaj' );
define( '_CAL_LANG_TITLE',				'Tytu�' );
define( '_CAL_LANG_REPEAT',				'Powt�rz' );
define( '_CAL_LANG_TIME_SHEET',			'lista obecno�ci' );
define( '_CAL_CLICK_TO_CHANGE_STATUS',	'Kliknij na ikon� aby zmieni� status' );
define( '_CAL_LANG_PUB_BUT_COMING',		'Opublikowane, ale <u>dopiero nadejdzie</u>' );
define( '_CAL_LANG_PUB_ACTUAL',			'Opublikowane i <u>aktualne</u>' );
define( '_CAL_LANG_PUB_FINISHED',		'Opublikowane, ale <u>zako�czone</u>' );
define( '_CAL_LANG_EDIT_EVENT',			'Edytuj wydarzenie' );
define( '_CAL_LANG_ADD_EVENT',			'Dodaj wydarzenie' );
define( '_CAL_LANG_REQUIRED',			'wymagane' );
define( '_CAL_LANG_IMG_FOLDER',			'podfolder' );
define( '_CAL_LANG_IMAGES',				'Galeria obraz�w' );
define( '_CAL_LANG_AVAL_IMAGES',		'Dost�pne obrazy' );
define( '_CAL_LANG_INSERT_IMG',			'Wstaw &raquo;' );
define( '_CAL_LANG_CONTENT_IMGS',		'Obrazy zawarto�ci' );
define( '_CAL_LANG_REMOVE',				'usu�' );
define( '_CAL_LANG_EDITED_SEL_IMG',		'Edytuj wybrany obraz' );
define( '_CAL_LANG_SOURCE',				'�r�d�o' );
define( '_CAL_LANG_ALIGN',				'Uk�ad' );
define( '_CAL_LANG_ALT_TXT',			'Tekst alternatywny - alt' );
define( '_CAL_LANG_BORDER',				'Obramowanie' );
define( '_CAL_LANG_CAPTION',			'Opis');
define( '_CAL_LANG_CAPTION_POSITION',	'Pozycja opisu');
define( '_CAL_LANG_CAPTION_POS_BOTTOM',	'Na dole');
define( '_CAL_LANG_CAPTION_POS_TOP',	'U g�ry');
define( '_CAL_LANG_CAPTION_ALIGN',		'Uk�ad opisu');
define( '_CAL_LANG_CAPTION_WIDTH',		'Szeroko�� opisu');
define( '_CAL_LANG_APPLY',				'Dodaj' );
define( '_CAL_LANG_ADD_INFO',			'Informacje dodatkowe' );
define( '_CAL_LANG_EVENT_STATUS',		'Status wydarzenia' );
define( '_CAL_LANG_ARCHIVED',			'Zarchiwizowane' );
define( '_CAL_LANG_DRAFT_UNPUB',		'Brudnopis nieopublikowany' );
define( '_CAL_LANG_NEVER',				'Nigdy' );
define( '_CAL_LANG_CUT_TITLE',			'Pe�en tytu�' );
define( '_CAL_LANG_MAX_DISPLAY',		'Maksymalnie wydarze�' );
define( '_CAL_LANG_DIS_STARTTIME',		'Poka� dat� rozpocz�cia' );

	// config
define( '_CAL_LANG_EVENTS_CONFIG',		'JEvents Konfiguracja' );
define( '_CAL_LANG_CONFIG_WRITEABLE',	'Plik config zapisywalny' );
define( '_CAL_LANG_CONFIG_NOT_WRITEABLE','Plik config niezapisywalny' );
define( '_CAL_LANG_CSS_WRITEABLE',		'Arkusz stylu CSS zapisywalny' );
define( '_CAL_LANG_CSS_NOT_WRITEABLE',	'Arkusz stylu CSS nie zapisywalny' );
define( '_CAL_LANG_ADMIN_EMAIL',		'Adres email Admina' );
define( '_CAL_LANG_FRONTEND_PUBLISHING','Opublikowane z Frontend' );
define( '_CAL_LANG_SETT_FOR_COM',		'Te ustawienia dotycz� wy��cznie komponentu' );
define( '_CAL_LANG_SETT_FOR_CAL_MOD',	'Te ustawienia dotycz� wy��cznie dodatkowego modu�u kalendarza' );
define( '_CAL_LANG_SETT_FOR_MOD_LATEST','Te ustawienia dotycz� wy��cznie dodatkowego modu�u [ Ostatnie Wydarzenia ]' );
define( '_CAL_LANG_ICONIC_NAVBAR'		,'U�ywaj ikon paska nawigacyjnego'); // 1.4
define( '_CAL_LANG_CHECK_VERSION'		,"Sprawd� czy jest nowa wersja"); // 1.4

// errors
define( '_CAL_LANG_ERR_CAT_MUST_HAVE_NAME',	'Kategoria musi mie� nazw�' );

// title & alts
define( '_CAL_LANG_TIT_NAME_FOR_MENUS',	'Pokazuj nazwy w menu' );
define( '_CAL_LANG_TIT_LONG_NAME',		'Pe�na nazwa w nag��wku' );
define( '_CAL_LANG_TIT_PENDING',		'Pending' );

// msgs
define( '_CAL_LANG_MSG_CAT_IS_EDITED',	'Kategoria [ %s ] jest aktualnie edytowana przez innego administratora' ); // %s = $row->title
define( '_CAL_LANG_MSG_OP_FAILED',		'Operacja nie powiod�a si�: Nie mo�na otworzy� [ %s ]' ); // %s = $filename
define( '_CAL_LANG_MSG_CHANGE_EMAIL',	'Przejd� najpierw do Konfiguracji JEvents i zmie� adres email' );
define( '_CAL_LANG_MSG_ADD_CAT_BEFORE',	'Najpierw musisz dodata� kategori� w tej sekcji' );
define( '_CAL_LANG_MSG_CONFIG_SAVED',	'Ustawienia pomy�lnie zapisane!' );
define( '_CAL_LANG_MSG_WARNING',		'Uwaga..' );
define( '_CAL_LANG_MSG_CHMOD_CONFIG',	'Musisz ustawi� chmod pliku konfiguracyjnego na 0777 aby m�c zmodyfikowa� ustawienia' );
define( '_CAL_LANG_MSG_CHMOD_CSS',		'Musisz ustawi� chmod pliku arkusza stylu na 0777 aby m�c zmodyfikowa� ustawieni' );
define( '_CAL_LANG_MSG_MOD_NOT_INSTALLED','Osobny modu� kalendarza nie jest zainstalowany' );
define( '_CAL_LANG_MSG_NO_MOD_LATEST',	'Osobny modu� [ Ostatnie wydarzenia ] nie jest zainstalowany' );

// tips
define( '_CAL_LANG_TIP_ACCESS',			'Kto jest uprawniony do tworzenia wydarze�' );
define( '_CAL_LANG_TIP_FRONT_PUB',		'Zezw�l publisherom, mened�erom i administratorom na publikacj� wydarze� z frontendu' );
define( '_CAL_LANG_TIP_NR_OF_LIST',		'Ilo�� wydarze� wy�wietlanych na stronie w widoku tygodnia, miesi�ca i roku' );
define( '_CAL_LANG_TIP_FE_SIMPLE_FORM',	        'U�yj prostego  formularza dla wpisywania wydarze� z frontend' ); //(IE. No Repeat types)
define( '_CAL_LANG_TIP_DEF_EC_HIDE_FORCE',	'<b>Zezw�l na specyficzny dla zadania kolor</b><br/>Edytuj�cy w Frontend oraz w panelu administracyjnym mog� definiowa� kolor wydarzenia<br/><b>Zezw�l na edycj� koloru wydarzenia tylko w panelu administracyjnym</b><br/>Tylko u�ytkownicy z dost�pem do panelu administracyjnego mog� edytowa� specyficzny kolor wydarzenia<br/><b>Zawsze u�ywaj koloru kategorii</b><br/>U�ytkownicy nie mog� edytowa� koloru wydarzenia, wszystkie ustawienia kolor�w b�d� ignorowane i zawsze b�dzie pokazywany kolor zdefiniowany dla kategorii' );
define( '_CAL_LANG_TIP_DLM_STOP_DAY',		'Dzie� obecnego miesi�ca od kt�rego nie b�dzie pokazywany kalendarz poprzedniego miesi�ca' );
define( '_CAL_LANG_TIP_DNM_START_DAY',		'Dzie� obecnego miesi�ca od kt�rego b�dzi� pokazywany kalendarz przysz�ego miesi�ca' );
define( '_CAL_LANG_TIP_LEV_DAY_RANGE',		'Day range relative to Current Day to display Events (modes 1 or 3 only)' );
define( '_CAL_LANG_TIP_LEV_DISPLAY_YEAR',	'Wy�wietlaj rok w dacie wydarze� (tylko dla domy�lnego formatu daty)' );
define( '_CAL_LANG_TIP_BTN_DEF_CONFIG',		'Wczytaj ustawienia domy�lne [stosuj w przypadku gdy co� dzia�a nie tak jak trzeba]' );
define( '_CAL_LANG_TIP_LEV_DISPLAY_MODE',	'0 (domy�lnie) wy�wietlanie najbli�szych wydarze� dla obecnego tygodnia i przysz�ego tygodnia (nie wi�cej ni� maksymalna zdefiniowana ilo��)<br />1 podobnie jak dla [opcji = 0] ale wy�wietla te� wcze�niejsze wydarzenia je�li w obecnym i przysz�ym tygodniu ilo�� wydarze� jest mniejsza ni� zdefiniowana maksymalna ich liczba<br />2 wy�wietlanie najbli�szych wydarze� dla kolejnych [ + dni ], pokazuje wszystkie wydarzenia od bie��cego dnia do maksymalnej liczby  do wy�wietlenia, tj.: $maxEvents<br />3  podobnie jak dla opcji 2 ale wy�wietla przesz�e wydarzenia je�li na kolejne dni nie ma wydarze� aby zape�ni� ca�� list� dla maksymalnej zdefiniowanej ilo�� wydarze� do wy�wietelenia [ - dni ]<br />4 wy�wietla wydarzenia od aktualnego dnia do ko�ca obecnego miesi�ca (nie wi�cej ni� maksymalna liczba: $maxEvents)' );
define( '_CAL_LANG_TIP_CUT_TITLE',			'Je�li tytu� ma zbyt wiele znak�w, ni� przewiduje formatowanie serwisu.<br />Ustaw tutaj x znak�w kt�re b�d� wy�wietlone, po czym zostanie dodany wielokropek ...' );
define( '_CAL_LANG_TIP_LEV_HIDE_LINK',		'Ustawienie TAK, ustawia link tytu�u na dynamiczny javascript z parametrem &lt;b&gt;onclick&lt;/b&gt; . Zabezpiecza to przed indeksowaniem linku wydarzenia przez roboty wyszukiwarek');
define( '_CAL_LANG_TIP_MAX_DISPLAY',		'Ilo�� maksymalna wy�wietlanych wydarze� <strong>jako tekst</strong> na dzie� w miesi�cu<br />Je�li masz zbyt du�o wydarze� w ci�gu jednego dnia, wy�wietlenie wszystkich mo�e spowodowa�, nieczytelne wy�wietlanie.<br />Zdefiniuj jaka ilo�� wydarze� ma by� wy�wietlana jako tekst, gdy b�dzie ich wi�cej zostan� wy�wietlone ikony (Nie b�dzie dzia�a� okno informacyjne)<br /><strong>Info</strong>: Ustaw na 0 [zero] aby zawsze wy�wietla� wszystkie wydarzenia jako ikony' );
define( '_CAL_LANG_TIP_DIS_STARTTIME',		'Wy�wietlanie daty pocz�tkowej [ dla widoku miesi�ca ]' );
	// tooltips
define( '_CAL_LANG_TIP_TT_BGROUND',			'Okno informacyjne ma ten sam kolor t�a co wydarzenie<br />Kolor standardowy nie b�dzie u�ywany' );
define( '_CAL_LANG_TIP_TT_POSX',			'Okno informacyjne mo�e by� usytuowane: po lewej, po�rodku lub po prawej' );
define( '_CAL_LANG_TIP_TT_POSY',			'Pozycja pionowa okna informacyjnego mo�e mie� ustawienie: poni�ej lub powy�ej' );
define( '_CAL_LANG_TIP_TT_SHADOW',			'Okno informacyjne mo�e mie� cie� z lewej lub prawej strony, na g�rze lub na dole' );

// tabs
define( '_CAL_LANG_TAB_COMMON',			'Og�lne' );
define( '_CAL_LANG_TAB_IMAGES',			'Obrazek' );
define( '_CAL_LANG_TAB_CALENDAR',		'Kalendarz' );
define( '_CAL_LANG_TAB_HELP',			'Pomoc' );
define( '_CAL_LANG_TAB_EXTRA',			'Extra' );
define( '_CAL_LANG_TAB_ABOUT',			'O programie' );
define( '_CAL_LANG_TAB_COMPONENT',		'Komponent' );
define( '_CAL_LANG_TAB_CAL_MOD',		'Kalendarz' );
define( '_CAL_LANG_TAB_LATEST_MOD',		'Ostatnie wyd.' );
define( '_CAL_LANG_TAB_CSS',			'CSS' );
define( '_CAL_LANG_TAB_TOOLTIP',		'Okno infor.' );

// select lists
	//common
define( '_CAL_LANG_YES',				'Tak' );
define( '_CAL_LANG_NO',					'Ne' );
define( '_CAL_LANG_ALWAYS',				'ZAWSZE' );
	// access
define( '_CAL_LANG_SEL_ACCESS_ALL_REGGED',	'Wszyscy zarejestrowani u�ytkownicy' );
define( '_CAL_LANG_SEL_ACCESS_SPECIAL',		'Tylko u�ytkownicy o specjalnych uprawnieniach i administratorzy' );
define( '_CAL_LANG_SEL_ACCESS_ALL_ANONYM',	'Wszyscy (anonimowo) - nie rekomendowane' );
define( '_CAL_LANG_SEL_ACCESS_ALL_AUTHORS',	'Autorzy i wy�ej' );
define( '_CAL_LANG_SEL_ACCESS_ALL_EDITORS',	'Edytorzy i wy�ej' );
define( '_CAL_LANG_SEL_ACCESS_ALL_PUBLISHERS',	'Publikatorzy i wy�ej' );
define( '_CAL_LANG_SEL_ACCESS_ALL_MANAGERS',	'Mened�erowie i wy�ej' );
define( '_CAL_LANG_SEL_ACCESS_ALL_ADMIN',	'Tylko Administratorzy i Super administratorzy' );
	// first day
define( '_CAL_LANG_FIRST_DAY',			'Pierwszy dzie�' );
define( '_CAL_LANG_SUNDAY_FIRST',		'zacznij od Niedzieli' );
define( '_CAL_LANG_MONDAY_FIRST',		'zacznij od poniedzia�ku' );

define( '_CAL_LANG_VIEW_MAIL',			'Widok email-a' );
define( '_CAL_LANG_VIEW_BY',			'Widok "wed�ug"' );
define( '_CAL_LANG_VIEW_HITS',			'Widok "Klikni��"' );
define( '_CAL_LANG_VIEW_REPEAT_TIME',	        'Widok powt�rzonych / View Repeat and time' );
define( '_CAL_LANG_VIEW_REPEAT_YEAR_LIST',	'Poka� wszystkie powt�rzenia wydarzenia w widoku rocznym' );
define( '_CAL_LANG_SHOW_CATS',			'Ukryj "Widok wed�ug kategorii (najlepiej gdy modu� legendy jest w��czony)' );
define( '_CAL_LANG_SHOW_COPYRIGHT',		'Poka� Stopk� z zastrze�eniami prawnymi Copyright');
	// date format
define( '_CAL_LANG_DATE_FORMAT',		'Format daty' );
define( '_CAL_LANG_DATE_FORMAT_FR_EN',	        '1 stycze� 2007' );
define( '_CAL_LANG_DATE_FORMAT_US',		'stycze�, 1-st 2007' );
define( '_CAL_LANG_DATE_FORMAT_GERMAN',	        'Kontynentalny - Niemiecki' );

define( '_CAL_LANG_TIME_FORMAT_12',		'Format dwunastogodzinny' );
	// nav bar
define( '_CAL_LANG_NAV_BAR_COLOR',		'Kolor paska nawigacji' );
define( '_CAL_LANG_NAV_BAR_GREEN',		'Zielony' );
define( '_CAL_LANG_NAV_BAR_ORANGE',		'Pomara�czowy' );
define( '_CAL_LANG_NAV_BAR_BLUE',		'Niebieski' );
define( '_CAL_LANG_NAV_BAR_RED',		'Czerwony' );
define( '_CAL_LANG_NAV_BAR_GRAY',		'Szary' );
define( '_CAL_LANG_NAV_BAR_YELLOW',		'��ty' );

	// start page
define( '_CAL_LANG_START_PAGE',			'Strona startowa' );
define( '_CAL_LANG_SP_DAY',				'Dzie�' );
define( '_CAL_LANG_SP_WEEK',			'Tydzie�' );
define( '_CAL_LANG_SP_MONTH_CAL',		'Miesi�c (Kalendarz)' );
define( '_CAL_LANG_SP_MONTH_LIST',		'Miesi�c (Lista)' );
define( '_CAL_LANG_SP_YEAR',			'Rok' );
define( '_CAL_LANG_SP_CATEGORIES',		'Kategorie' );
define( '_CAL_LANG_SP_SEARCH',			'Szukaj' );

define( '_CAL_LANG_NR_OF_LIST',			'Numer wydarzenia' );
define( '_CAL_LANG_FE_SIMPLE_FORM',		'U�yj prostego formularza' );
	// event color
define( '_CAL_LANG_DEF_EVENT_COLOR',	        'Kolor domy�lny wydarzenia' );
define( '_CAL_LANG_DEF_EC_RANDOM',		'Losowy' );
define( '_CAL_LANG_DEF_EC_NONE',		'�aden' );
define( '_CAL_LANG_DEF_EC_CATEGORY',	        'Kategorii' );
define( '_CAL_LANG_DEF_EC_HIDE_FORCE',	        'Xasada koloru wydarzenia' );
define( '_CAL_LANG_EVENT_COLS_ALLOWED',	        'Dozwolony specyficzny kolor wydarzenia' );
define( '_CAL_LANG_EVENT_COLS_BACKED',	        'Edycja kolor�w tylko w backend' );
define( '_CAL_LANG_ALWAYS_CAT_COLOR',	        'Zawsze u�ywaj kolor kategorii' );

	// tooltips
define( '_CAL_LANG_ABOVE',				'Ponad' );
define( '_CAL_LANG_BELOW',				'Poni�ej' );

// calendar module
	// display last month
define( '_CAL_LANG_DISPLAY_LAST_MONTH',	'Wy�wietl ostatni miesi�c' );
define( '_CAL_LANG_DLM_YES_STOP_DAY',	'TAK - z dat� ko�ca' );
define( '_CAL_LANG_DLM_YES_EVENT_SDAY',	'TAK - je�li s� wydarzenia ORAZ z dat� ko�ca' );
define( '_CAL_LANG_DLM_ALWYS_IF_EVENTS','ZAWSZE - je�li s� wydarzenia' );
	// stop day
define( '_CAL_LANG_DLM_STOP_DAY',		'Ostatni dzie� w danym miesi�cu' );
	// display next month
define( '_CAL_LANG_DISPLAY_NEXT_MONTH',	'Wy�wietl nast�pny miesi�c' );
define( '_CAL_LANG_DNM_YES_START_DAY',	'TAK - z dat� pocz�tkow�' );
define( '_CAL_LANG_DNM_YES_EVENT_SDAY', 'TAK - je�li s� wydarzenia ORAZ z dat� pocz�tkow�' );
define( '_CAL_LANG_DNM_ALWYS_IF_EVENTS','ZAWSZE - je�li s� wydarzenia' );
	// start day
define( '_CAL_LANG_DNM_START_DAY',		'Pozosta�o dni do pocz�tku w tym miesi�cu' );

// latest events module
define( '_CAL_LANG_LEV_MAX_DISPLAY',	'Maksymalna ilo�� wy�wietlanych Wydarze�' );
define( '_CAL_LANG_LEV_DISPLAY_MODE',	'Rodzaj wy�wietlania' );
define( '_CAL_LANG_LEV_DAY_RANGE',		'Dni przed-po' );
define( '_CAL_LANG_LEV_REP_EV_ONCE',	'Powtarzaj�ce si� wydarzenia wy�wietl tylko raz' );
define( '_CAL_LANG_LEV_EV_AS_LINK',		'Wy�wietl Wydarzenie jako Link' );
define( '_CAL_LANG_LEV_DISPLAY_YEAR',	'Wy�wietl rok' );
define( '_CAL_LANG_LEV_CSS_DATE_FIELD',	'Wy��cz domy�lny styl CSS daty' );
define( '_CAL_LANG_LEV_CSS_TITLE_FIELD','Wy��cz domy�lny styl CSS dla tytu�u' );
define( '_CAL_LANG_LEV_HIDE_LINK',		'Ukryj Tytu� - link');
define( '_CAL_LANG_LEV_CUST_FORM_STRING','W�asny format wy�wietlania' );

// tooltips frontpage (overlib)
define( '_CAL_LANG_TOOLTIP',			'Ustawienia zale�� ustawie� widoku miesi�ca' );
define( '_CAL_LANG_TT_MAINWINDOW',		'Okno informacyjne - Ustawienia' );
define( '_CAL_LANG_TT_BGROUND',			'Takie samo t�o jak wydarzenie' );
define( '_CAL_LANG_TT_POSX',			'Pozycja poziomo' );
define( '_CAL_LANG_TT_POSY',			'Pozycja pionowo' );
define( '_CAL_LANG_TT_SHADOW',			'Cie�' );
define( '_CAL_LANG_TT_SHADOWX',			'Po lewej' );
define( '_CAL_LANG_TT_SHADOWY',			'Powy�ej' );

// buttons
define( '_CAL_LANG_BTN_DEF_CONFIG',		'Przywr�� ustawienia domy�lne' );

// installation
define( '_CAL_LANG_INSTAL_MAIN',		'Wydarzenia' );
define( '_CAL_LANG_INSTAL_MANAGE',		'Zarz�dzaj wydarzeniami' );
define( '_CAL_LANG_INSTAL_CATS',		'Zarz�dzaj kategoriami' );
define( '_CAL_LANG_INSTAL_CONFIG',		'Konfiguracja' );
define( '_CAL_LANG_INSTAL_ARCHIVE',		'Archiwum' );
define( '_CAL_LANG_INSTAL_ERROR',		'Wyst�pi�y nast�puj�ce b��dy' );
define( '_CAL_LANG_INSTAL_SUCCESS',		'Komponent Events zainstalowany poprawnie' );
define( '_CAL_LANG_INSTALL_DB_ENTRIES',	'Zmiana danych w bazie' );
define( '_CAL_LANG_INSTALL_PREV_INST',	'Powtarzaj�ce si� rekordy w bazie danych usuni�te' );

DEFINE("_CAL_LANG_EVENT_ALLDAY","Wydarzenie ca�odzienne (godziny nie okre�lane)");  // new for 1.4


?>

