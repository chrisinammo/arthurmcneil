<?php
/**
 * Events Component for Joomla 1.0.x
 *
 * @version     $Id: admin_polish-utf8.php 991 2008-03-10 19:55:48Z tstahl $
 * @package     Events
 * @copyright   Copyright (C) 2006-2008 JEvents Project Group
 * @licence     http://www.gnu.org/copyleft/gpl.html
 * @link        http://forge.joomla.org/sf/projects/jevents
 * @Tranlate    Jakub Dirska - http://www.webir.eu
 * @encoding    utf-8
 */


defined("_VALID_MOS") or die( 'Restricted access' );

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
define( '_CAL_LANG_RECORDS',			'spośród pozycji' );
define( '_CAL_LANG_CHECKED_OUT',		'Sprawdzone' );
define( '_CAL_LANG_PUBLISHED',			'Opublikowany' );
define( '_CAL_LANG_NOT_PUBLISHED',		'Nie opublikowane' );
define( '_CAL_LANG_ACCESS',				'Dostęp' );
define( '_CAL_LANG_REORDER',			'Reorder' );
define( '_CAL_LANG_UNPUBLISH',			'Nie publikkuj' );
define( '_CAL_LANG_PUBLISH',			'Publikuj' );
define( '_CAL_LANG_CLICK_TO_EDIT',		'Edytuj' );
define( '_CAL_LANG_MOVE_UP',			'W górę' );
define( '_CAL_LANG_MOVE_DOWN',			'W dół' );
define( '_CAL_LANG_EDIT_CAT',			'Edytuj kategorię' );
define( '_CAL_LANG_ADD_CAT',			'Dodaj Kategorię' );
define( '_CAL_LANG_CAT_TITLE',			'Tytuł Kategorii' );
define( '_CAL_LANG_CAT_NAME',			'Nazwa Kategorii' );
define( '_CAL_LANG_IMAGE',				'Obrazek' );
define( '_CAL_LANG_PREVIEW',			'Podgląd' );
define( '_CAL_LANG_IMG_POSITION',		'Pozycja obrazka' );
define( '_CAL_LANG_ORDERING',			'Pozycja' );
define( '_CAL_LANG_LEFT',				'Lewo' );
define( '_CAL_LANG_CENTER',				'Środek' );
define( '_CAL_LANG_RIGHT',				'Prawo' );
define( '_CAL_LANG_SELECT_IMAGE',		'Wybierz obraz' );
define( '_CAL_LANG_SEARCH',				'Szukaj' );
define( '_CAL_LANG_TITLE',				'Tytuł' );
define( '_CAL_LANG_REPEAT',				'Powtórz' );
define( '_CAL_LANG_TIME_SHEET',			'lista obecności' );
define( '_CAL_CLICK_TO_CHANGE_STATUS',	'Kliknij na ikonę aby zmienić status' );
define( '_CAL_LANG_PUB_BUT_COMING',		'Opublikowane, ale <u>dopiero nadejdzie</u>' );
define( '_CAL_LANG_PUB_ACTUAL',			'Opublikowane i <u>aktualne</u>' );
define( '_CAL_LANG_PUB_FINISHED',		'Opublikowane, ale <u>zakończone</u>' );
define( '_CAL_LANG_EDIT_EVENT',			'Edytuj wydarzenie' );
define( '_CAL_LANG_ADD_EVENT',			'Dodaj wydarzenie' );
define( '_CAL_LANG_REQUIRED',			'wymagane' );
define( '_CAL_LANG_IMG_FOLDER',			'podfolder' );
define( '_CAL_LANG_IMAGES',				'Galeria obrazów' );
define( '_CAL_LANG_AVAL_IMAGES',		'Dostępne obrazy' );
define( '_CAL_LANG_INSERT_IMG',			'Wstaw &raquo;' );
define( '_CAL_LANG_CONTENT_IMGS',		'Obrazy zawartości' );
define( '_CAL_LANG_REMOVE',				'usuń' );
define( '_CAL_LANG_EDITED_SEL_IMG',		'Edytuj wybrany obraz' );
define( '_CAL_LANG_SOURCE',				'Źródło' );
define( '_CAL_LANG_ALIGN',				'Układ' );
define( '_CAL_LANG_ALT_TXT',			'Tekst alternatywny - alt' );
define( '_CAL_LANG_BORDER',				'Obramowanie' );
define( '_CAL_LANG_CAPTION',			'Opis');
define( '_CAL_LANG_CAPTION_POSITION',	'Pozycja opisu');
define( '_CAL_LANG_CAPTION_POS_BOTTOM',	'Na dole');
define( '_CAL_LANG_CAPTION_POS_TOP',	'U góry');
define( '_CAL_LANG_CAPTION_ALIGN',		'Układ opisu');
define( '_CAL_LANG_CAPTION_WIDTH',		'Szerokość opisu');
define( '_CAL_LANG_APPLY',				'Dodaj' );
define( '_CAL_LANG_ADD_INFO',			'Informacje dodatkowe' );
define( '_CAL_LANG_EVENT_STATUS',		'Status wydarzenia' );
define( '_CAL_LANG_ARCHIVED',			'Zarchiwizowane' );
define( '_CAL_LANG_DRAFT_UNPUB',		'Brudnopis nieopublikowany' );
define( '_CAL_LANG_NEVER',				'Nigdy' );
define( '_CAL_LANG_CUT_TITLE',			'Pełen tytuł' );
define( '_CAL_LANG_MAX_DISPLAY',		'Maksymalnie wydarzeń' );
define( '_CAL_LANG_DIS_STARTTIME',		'Pokaż datę rozpoczęcia' );

	// config
define( '_CAL_LANG_EVENTS_CONFIG',		'JEvents Konfiguracja' );
define( '_CAL_LANG_CONFIG_WRITEABLE',	'Plik config zapisywalny' );
define( '_CAL_LANG_CONFIG_NOT_WRITEABLE','Plik config niezapisywalny' );
define( '_CAL_LANG_CSS_WRITEABLE',		'Arkusz stylu CSS zapisywalny' );
define( '_CAL_LANG_CSS_NOT_WRITEABLE',	'Arkusz stylu CSS nie zapisywalny' );
define( '_CAL_LANG_ADMIN_EMAIL',		'Adres email Admina' );
define( '_CAL_LANG_FRONTEND_PUBLISHING','Opublikowane z Frontend' );
define( '_CAL_LANG_SETT_FOR_COM',		'Te ustawienia dotyczą wyłącznie komponentu' );
define( '_CAL_LANG_SETT_FOR_CAL_MOD',	'Te ustawienia dotyczą wyłącznie dodatkowego modułu kalendarza' );
define( '_CAL_LANG_SETT_FOR_MOD_LATEST','Te ustawienia dotyczą wyłącznie dodatkowego modułu [ Ostatnie Wydarzenia ]' );
define( '_CAL_LANG_ICONIC_NAVBAR'		,'Używaj ikon paska nawigacyjnego'); // 1.4
define( '_CAL_LANG_CHECK_VERSION'		,"Sprawdź czy jest nowa wersja"); // 1.4

// errors
define( '_CAL_LANG_ERR_CAT_MUST_HAVE_NAME',	'Kategoria musi mieć nazwę' );

// title & alts
define( '_CAL_LANG_TIT_NAME_FOR_MENUS',	'Pokazuj nazwy w menu' );
define( '_CAL_LANG_TIT_LONG_NAME',		'Pełna nazwa w nagłówku' );
define( '_CAL_LANG_TIT_PENDING',		'Pending' );

// msgs
define( '_CAL_LANG_MSG_CAT_IS_EDITED',	'Kategoria [ %s ] jest aktualnie edytowana przez innego administratora' ); // %s = $row->title
define( '_CAL_LANG_MSG_OP_FAILED',		'Operacja nie powiodła się: Nie można otworzyć [ %s ]' ); // %s = $filename
define( '_CAL_LANG_MSG_CHANGE_EMAIL',	'Przejdź najpierw do Konfiguracji JEvents i zmień adres email' );
define( '_CAL_LANG_MSG_ADD_CAT_BEFORE',	'Najpierw musisz dodatać kategorię w tej sekcji' );
define( '_CAL_LANG_MSG_CONFIG_SAVED',	'Ustawienia pomyślnie zapisane!' );
define( '_CAL_LANG_MSG_WARNING',		'Uwaga..' );
define( '_CAL_LANG_MSG_CHMOD_CONFIG',	'Musisz ustawić chmod pliku konfiguracyjnego na 0777 aby móc zmodyfikować ustawienia' );
define( '_CAL_LANG_MSG_CHMOD_CSS',		'Musisz ustawić chmod pliku arkusza stylu na 0777 aby móc zmodyfikować ustawieni' );
define( '_CAL_LANG_MSG_MOD_NOT_INSTALLED','Osobny moduł kalendarza nie jest zainstalowany' );
define( '_CAL_LANG_MSG_NO_MOD_LATEST',	'Osobny moduł [ Ostatnie wydarzenia ] nie jest zainstalowany' );

// tips
define( '_CAL_LANG_TIP_ACCESS',			'Kto jest uprawniony do tworzenia wydarzeń' );
define( '_CAL_LANG_TIP_FRONT_PUB',		'Zezwól publisherom, menedżerom i administratorom na publikację wydarzeń z frontendu' );
define( '_CAL_LANG_TIP_NR_OF_LIST',		'Ilość wydarzeń wyświetlanych na stronie w widoku tygodnia, miesiąca i roku' );
define( '_CAL_LANG_TIP_FE_SIMPLE_FORM',	        'Użyj prostego  formularza dla wpisywania wydarzeń z frontend' ); //(IE. No Repeat types)
define( '_CAL_LANG_TIP_DEF_EC_HIDE_FORCE',	'<b>Zezwól na specyficzny dla zadania kolor</b><br/>Edytujący w Frontend oraz w panelu administracyjnym mogą definiować kolor wydarzenia<br/><b>Zezwól na edycję koloru wydarzenia tylko w panelu administracyjnym</b><br/>Tylko użytkownicy z dostępem do panelu administracyjnego mogą edytować specyficzny kolor wydarzenia<br/><b>Zawsze używaj koloru kategorii</b><br/>Użytkownicy nie mogą edytować koloru wydarzenia, wszystkie ustawienia kolorów będą ignorowane i zawsze będzie pokazywany kolor zdefiniowany dla kategorii' );
define( '_CAL_LANG_TIP_DLM_STOP_DAY',		'Dzień obecnego miesiąca od którego nie będzie pokazywany kalendarz poprzedniego miesiąca' );
define( '_CAL_LANG_TIP_DNM_START_DAY',		'Dzień obecnego miesiąca od którego będzię pokazywany kalendarz przyszłego miesiąca' );
define( '_CAL_LANG_TIP_LEV_DAY_RANGE',		'Day range relative to Current Day to display Events (modes 1 or 3 only)' );
define( '_CAL_LANG_TIP_LEV_DISPLAY_YEAR',	'Wyświetlaj rok w dacie wydarzeń (tylko dla domyślnego formatu daty)' );
define( '_CAL_LANG_TIP_BTN_DEF_CONFIG',		'Wczytaj ustawienia domyślne [stosuj w przypadku gdy coś działa nie tak jak trzeba]' );
define( '_CAL_LANG_TIP_LEV_DISPLAY_MODE',	'0 (domyślnie) wyświetlanie najbliższych wydarzeń dla obecnego tygodnia i przyszłego tygodnia (nie więcej niż maksymalna zdefiniowana ilość)<br />1 podobnie jak dla [opcji = 0] ale wyświetla też wcześniejsze wydarzenia jeśli w obecnym i przyszłym tygodniu ilość wydarzeń jest mniejsza niż zdefiniowana maksymalna ich liczba<br />2 wyświetlanie najbliższych wydarzeń dla kolejnych [ + dni ], pokazuje wszystkie wydarzenia od bieżącego dnia do maksymalnej liczby  do wyświetlenia, tj.: $maxEvents<br />3  podobnie jak dla opcji 2 ale wyświetla przeszłe wydarzenia jeśli na kolejne dni nie ma wydarzeń aby zapełnić całą listę dla maksymalnej zdefiniowanej ilość wydarzeń do wyświetelenia [ - dni ]<br />4 wyświetla wydarzenia od aktualnego dnia do końca obecnego miesiąca (nie więcej niż maksymalna liczba: $maxEvents)' );
define( '_CAL_LANG_TIP_CUT_TITLE',			'Jeśli tytuł ma zbyt wiele znaków, niż przewiduje formatowanie serwisu.<br />Ustaw tutaj x znaków które będą wyświetlone, po czym zostanie dodany wielokropek ...' );
define( '_CAL_LANG_TIP_LEV_HIDE_LINK',		'Ustawienie TAK, ustawia link tytułu na dynamiczny javascript z parametrem &lt;b&gt;onclick&lt;/b&gt; . Zabezpiecza to przed indeksowaniem linku wydarzenia przez roboty wyszukiwarek');
define( '_CAL_LANG_TIP_MAX_DISPLAY',		'Ilość maksymalna wyświetlanych wydarzeń <strong>jako tekst</strong> na dzień w miesiącu<br />Jeśli masz zbyt dużo wydarzeń w ciągu jednego dnia, wyświetlenie wszystkich może spowodować, nieczytelne wyświetlanie.<br />Zdefiniuj jaka ilość wydarzeń ma być wyświetlana jako tekst, gdy będzie ich więcej zostaną wyświetlone ikony (Nie będzie działać okno informacyjne)<br /><strong>Info</strong>: Ustaw na 0 [zero] aby zawsze wyświetlać wszystkie wydarzenia jako ikony' );
define( '_CAL_LANG_TIP_DIS_STARTTIME',		'Wyświetlanie daty początkowej [ dla widoku miesiąca ]' );
	// tooltips
define( '_CAL_LANG_TIP_TT_BGROUND',			'Okno informacyjne ma ten sam kolor tła co wydarzenie<br />Kolor standardowy nie będzie używany' );
define( '_CAL_LANG_TIP_TT_POSX',			'Okno informacyjne może być usytuowane: po lewej, pośrodku lub po prawej' );
define( '_CAL_LANG_TIP_TT_POSY',			'Pozycja pionowa okna informacyjnego może mieć ustawienie: poniżej lub powyżej' );
define( '_CAL_LANG_TIP_TT_SHADOW',			'Okno informacyjne może mieć cień z lewej lub prawej strony, na górze lub na dole' );

// tabs
define( '_CAL_LANG_TAB_COMMON',			'Ogólne' );
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
define( '_CAL_LANG_SEL_ACCESS_ALL_REGGED',	'Wszyscy zarejestrowani użytkownicy' );
define( '_CAL_LANG_SEL_ACCESS_SPECIAL',		'Tylko użytkownicy o specjalnych uprawnieniach i administratorzy' );
define( '_CAL_LANG_SEL_ACCESS_ALL_ANONYM',	'Wszyscy (anonimowo) - nie rekomendowane' );
define( '_CAL_LANG_SEL_ACCESS_ALL_AUTHORS',	'Autorzy i wyżej' );
define( '_CAL_LANG_SEL_ACCESS_ALL_EDITORS',	'Edytorzy i wyżej' );
define( '_CAL_LANG_SEL_ACCESS_ALL_PUBLISHERS',	'Publikatorzy i wyżej' );
define( '_CAL_LANG_SEL_ACCESS_ALL_MANAGERS',	'Menedżerowie i wyżej' );
define( '_CAL_LANG_SEL_ACCESS_ALL_ADMIN',	'Tylko Administratorzy i Super administratorzy' );
	// first day
define( '_CAL_LANG_FIRST_DAY',			'Pierwszy dzień' );
define( '_CAL_LANG_SUNDAY_FIRST',		'zacznij od Niedzieli' );
define( '_CAL_LANG_MONDAY_FIRST',		'zacznij od poniedziałku' );

define( '_CAL_LANG_VIEW_MAIL',			'Widok email-a' );
define( '_CAL_LANG_VIEW_BY',			'Widok "według"' );
define( '_CAL_LANG_VIEW_HITS',			'Widok "Kliknięć"' );
define( '_CAL_LANG_VIEW_REPEAT_TIME',	        'Widok powtórzonych / View Repeat and time' );
define( '_CAL_LANG_VIEW_REPEAT_YEAR_LIST',	'Pokaż wszystkie powtórzenia wydarzenia w widoku rocznym' );
define( '_CAL_LANG_SHOW_CATS',			'Ukryj "Widok według kategorii (najlepiej gdy moduł legendy jest włączony)' );
define( '_CAL_LANG_SHOW_COPYRIGHT',		'Pokaż Stopkę z zastrzeżeniami prawnymi Copyright');
	// date format
define( '_CAL_LANG_DATE_FORMAT',		'Format daty' );
define( '_CAL_LANG_DATE_FORMAT_FR_EN',	        '1 styczeń 2007' );
define( '_CAL_LANG_DATE_FORMAT_US',		'styczeń, 1-st 2007' );
define( '_CAL_LANG_DATE_FORMAT_GERMAN',	        'Kontynentalny - Niemiecki' );

define( '_CAL_LANG_TIME_FORMAT_12',		'Format dwunastogodzinny' );
	// nav bar
define( '_CAL_LANG_NAV_BAR_COLOR',		'Kolor paska nawigacji' );
define( '_CAL_LANG_NAV_BAR_GREEN',		'Zielony' );
define( '_CAL_LANG_NAV_BAR_ORANGE',		'Pomarańczowy' );
define( '_CAL_LANG_NAV_BAR_BLUE',		'Niebieski' );
define( '_CAL_LANG_NAV_BAR_RED',		'Czerwony' );
define( '_CAL_LANG_NAV_BAR_GRAY',		'Szary' );
define( '_CAL_LANG_NAV_BAR_YELLOW',		'Żółty' );

	// start page
define( '_CAL_LANG_START_PAGE',			'Strona startowa' );
define( '_CAL_LANG_SP_DAY',				'Dzień' );
define( '_CAL_LANG_SP_WEEK',			'Tydzień' );
define( '_CAL_LANG_SP_MONTH_CAL',		'Miesiąc (Kalendarz)' );
define( '_CAL_LANG_SP_MONTH_LIST',		'Miesiąc (Lista)' );
define( '_CAL_LANG_SP_YEAR',			'Rok' );
define( '_CAL_LANG_SP_CATEGORIES',		'Kategorie' );
define( '_CAL_LANG_SP_SEARCH',			'Szukaj' );

define( '_CAL_LANG_NR_OF_LIST',			'Numer wydarzenia' );
define( '_CAL_LANG_FE_SIMPLE_FORM',		'Użyj prostego formularza' );
	// event color
define( '_CAL_LANG_DEF_EVENT_COLOR',	        'Kolor domyślny wydarzenia' );
define( '_CAL_LANG_DEF_EC_RANDOM',		'Losowy' );
define( '_CAL_LANG_DEF_EC_NONE',		'Żaden' );
define( '_CAL_LANG_DEF_EC_CATEGORY',	        'Kategorii' );
define( '_CAL_LANG_DEF_EC_HIDE_FORCE',	        'Xasada koloru wydarzenia' );
define( '_CAL_LANG_EVENT_COLS_ALLOWED',	        'Dozwolony specyficzny kolor wydarzenia' );
define( '_CAL_LANG_EVENT_COLS_BACKED',	        'Edycja kolorów tylko w backend' );
define( '_CAL_LANG_ALWAYS_CAT_COLOR',	        'Zawsze używaj kolor kategorii' );

	// tooltips
define( '_CAL_LANG_ABOVE',				'Ponad' );
define( '_CAL_LANG_BELOW',				'Poniżej' );

// calendar module
	// display last month
define( '_CAL_LANG_DISPLAY_LAST_MONTH',	'Wyświetl ostatni miesiąc' );
define( '_CAL_LANG_DLM_YES_STOP_DAY',	'TAK - z datą końca' );
define( '_CAL_LANG_DLM_YES_EVENT_SDAY',	'TAK - jeśli są wydarzenia ORAZ z datą końca' );
define( '_CAL_LANG_DLM_ALWYS_IF_EVENTS','ZAWSZE - jeśli są wydarzenia' );
	// stop day
define( '_CAL_LANG_DLM_STOP_DAY',		'Ostatni dzień w danym miesiącu' );
	// display next month
define( '_CAL_LANG_DISPLAY_NEXT_MONTH',	'Wyświetl następny miesiąc' );
define( '_CAL_LANG_DNM_YES_START_DAY',	'TAK - z datą początkową' );
define( '_CAL_LANG_DNM_YES_EVENT_SDAY', 'TAK - jeśli są wydarzenia ORAZ z datą początkową' );
define( '_CAL_LANG_DNM_ALWYS_IF_EVENTS','ZAWSZE - jeśli są wydarzenia' );
	// start day
define( '_CAL_LANG_DNM_START_DAY',		'Pozostało dni do początku w tym miesiącu' );

// latest events module
define( '_CAL_LANG_LEV_MAX_DISPLAY',	'Maksymalna ilość wyświetlanych Wydarzeń' );
define( '_CAL_LANG_LEV_DISPLAY_MODE',	'Rodzaj wyświetlania' );
define( '_CAL_LANG_LEV_DAY_RANGE',		'Dni przed-po' );
define( '_CAL_LANG_LEV_REP_EV_ONCE',	'Powtarzające się wydarzenia wyświetl tylko raz' );
define( '_CAL_LANG_LEV_EV_AS_LINK',		'Wyświetl Wydarzenie jako Link' );
define( '_CAL_LANG_LEV_DISPLAY_YEAR',	'Wyświetl rok' );
define( '_CAL_LANG_LEV_CSS_DATE_FIELD',	'Wyłącz domyślny styl CSS daty' );
define( '_CAL_LANG_LEV_CSS_TITLE_FIELD','Wyłącz domyślny styl CSS dla tytułu' );
define( '_CAL_LANG_LEV_HIDE_LINK',		'Ukryj Tytuł - link');
define( '_CAL_LANG_LEV_CUST_FORM_STRING','Własny format wyświetlania' );

// tooltips frontpage (overlib)
define( '_CAL_LANG_TOOLTIP',			'Ustawienia zależą ustawień widoku miesiąca' );
define( '_CAL_LANG_TT_MAINWINDOW',		'Okno informacyjne - Ustawienia' );
define( '_CAL_LANG_TT_BGROUND',			'Takie samo tło jak wydarzenie' );
define( '_CAL_LANG_TT_POSX',			'Pozycja poziomo' );
define( '_CAL_LANG_TT_POSY',			'Pozycja pionowo' );
define( '_CAL_LANG_TT_SHADOW',			'Cień' );
define( '_CAL_LANG_TT_SHADOWX',			'Po lewej' );
define( '_CAL_LANG_TT_SHADOWY',			'Powyżej' );

// buttons
define( '_CAL_LANG_BTN_DEF_CONFIG',		'Przywróć ustawienia domyślne' );

// installation
define( '_CAL_LANG_INSTAL_MAIN',		'Wydarzenia' );
define( '_CAL_LANG_INSTAL_MANAGE',		'Zarządzaj wydarzeniami' );
define( '_CAL_LANG_INSTAL_CATS',		'Zarządzaj kategoriami' );
define( '_CAL_LANG_INSTAL_CONFIG',		'Konfiguracja' );
define( '_CAL_LANG_INSTAL_ARCHIVE',		'Archiwum' );
define( '_CAL_LANG_INSTAL_ERROR',		'Wystąpiły następujące błędy' );
define( '_CAL_LANG_INSTAL_SUCCESS',		'Komponent Events zainstalowany poprawnie' );
define( '_CAL_LANG_INSTALL_DB_ENTRIES',	'Zmiana danych w bazie' );
define( '_CAL_LANG_INSTALL_PREV_INST',	'Powtarzające się rekordy w bazie danych usunięte' );

DEFINE("_CAL_LANG_EVENT_ALLDAY","Wydarzenie całodzienne (godziny nie określane)");  // new for 1.4


?>

