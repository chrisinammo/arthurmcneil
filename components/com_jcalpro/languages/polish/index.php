<?PHP

/*
**********************************************
JCal Pro v1.5.3
Copyright (c) 2006-2007 Anything-Digital.com
**********************************************
JCal Pro is a fork of the existing Extcalendar component for Joomla!
(com_extcal_0_9_2_RC4.zip from mamboguru.com). 
Extcal (http://sourceforge.net/projects/extcal) was renamed 
and adapted to become a Mambo/Joomla! component by 
Matthew Friedman, and further modified by David McKinnis
(mamboguru.com) to repair some security holes. 

This program is free software; you can redistribute it and/or modify 
it under the terms of the GNU General Public License as published by 
the Free Software Foundation; either version 2 of the License, or 
(at your option) any later version.

This header must not be removed. Additional contributions/changes
may be added to this header as long as no information is deleted.
**********************************************

$File: index.php - language file$

Revision date: 02/28/2007

**********************************************
Get the latest version of JCal Pro at:
http://dev.anything-digital.com//
**********************************************
*/

/** ensure this file is being included by a parent file */
defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );

// New language structure
$lang_info = array (
	'name' => 'Polish'
	,'nativename' => 'Polski' // Language name in native language. E.g: 'Franτais' for 'French'
	,'locale' => array('pl_PL.UTF-8') // Standard locale alternatives for a specific language. For reference, go to: http://www.php.net/manual/en/function.setlocale.php
	,'charset' => 'UTF-8' // For reference, go to : http://www.w3.org/International/O-charset-lang.html
	,'direction' => 'ltr' // 'ltr' for Left to Right. 'rtl' for Right to Left languages such as Arabic.
	,'author' => 'tomeq'
	,'author_email' => 'soon'
	,'author_url' => 'soon'
	,'transdate' => '02/28/2007'
);

$lang_general = array (
	'yes' => 'Tak'
	,'no' => 'Nie'
	,'back' => 'Wstecz'
	,'continue' => 'Kontynuuj'
	,'close' => 'Zamknij'
	,'errors' => 'Błędy'
	,'info' => 'Informacja'
	,'day' => 'dzień'
	,'days' => 'dni'
	,'month' => 'miesiąc'
	,'months' => 'miesiące'
	,'year' => 'rok'
	,'years' => 'lata'
	,'hour' => 'godzina'
	,'hours' => 'godziny'
	,'minute' => 'minuta'
	,'minutes' => 'minuty'
	,'everyday' => 'codziennie'
	,'everymonth' => 'co miesiąc'
	,'everyyear' => 'co rok'
	,'active' => 'Aktywny'
	,'not_active' => 'Nieaktywny'
	,'today' => 'Dzisiaj'
	,'signature' => 'Wykonany przez: %s'
	,'expand' => 'Rozszerz'
	,'collapse' => 'Zmniejsz'
);

// Date formats, For reference, go to : http://www.php.net/manual/en/function.strftime.php
$lang_date_format = array (
	'full_date' => '%A, %B %d, %Y' // e.g. Wednesday, June 05, 2002
	,'full_date_time_24hour' => '%A, %B %d, %Y At %H:%M' // e.g. Wednesday, June 05, 2002 At 21:05
	,'full_date_time_12hour' => '%A, %B %d, %Y At %I:%M %p' // e.g. Wednesday, June 05, 2002 At 9:05 pm
	,'day_month_year' => '%d-%b-%Y' // e.g 10-Sep-2004
	,'local_date' => '%c' // Preferred date and time representation for current language 
	,'mini_date' => '%a. %d %b, %Y' 
	,'month_year' => '%B %Y'
	,'day_of_week' => array('Niedziela','Poniedziałek','Wtorek','Środa','Czwartek','Piątek','Sobota')
	,'months' => array('Styczeń','Luty','Marzec','Kwiecień','Maj','Czerwiec','Lipiec','Sierpień','Wrzesień','Październik','Listopad','Grudzień')
);

$lang_system = array (
	'system_caption' => 'Komunikat systemowy'
  ,'page_access_denied' => 'Nie masz odpowiednich uprawnień, aby uzyskać dostęp do tej opcji.'
  ,'page_requires_login' => 'Zaloguj się lub zarejestruj, aby mieć dostęp do tej strony.'
  ,'operation_denied' => 'Nie masz uprawnień, aby wykonać tę operację.'
	,'section_disabled' => 'Ta sekcja jest aktualnie wyłączona !'
  ,'non_exist_cat' => 'Wybrana kategoria nie istnieje !'
  ,'non_exist_event' => 'Wybrane wydarzenie nie istnieje !'
  ,'param_missing' => 'Wprowadzone parametry są nieprawidłowe.'
  ,'no_events' => 'Nie ma żadnych informacji o wydarzeniach.'
  ,'config_string' => 'Używasz \'%s\' działającego na %s, %s i %s.'
  ,'no_table' => 'Tabela \'%s\' nie istnieje !'
  ,'no_anonymous_group' => 'Tabela  %s nie zawiera grupy \'Anonymous\' !'
  ,'calendar_locked' => 'Ta usługa jest chwilowo wyłączona w celach konserwacji. Przepraszamy za utrudnienia !'
	,'new_upgrade' => 'System wykrył nową wersję. Wskazane jest, aby teraz wykonać aktualizację. Kliknij <b>Kontynuuj</b>, aby rozpocząć aktualizację.'
	,'no_profile' => 'Podczas odzyskiwania danych z Twojego profilu pojawił się błąd'
	,'unknown_component' => 'Nieznany komponent'
// Mail messages
	,'new_event_subject' => 'Wydarzenie wymaga akceptacji w %s'
	,'event_notification_failed' => 'Podczas próby wysyłania maila pojawił się błąd !'
);

// Message body for new event email notification
$lang_system['event_notification_body'] = <<<EOT
Następujące wydarzenie zostało umieszczone w Twoim  {CALENDAR_NAME}
i wymaga akceptacji:

Tytuł: "{TITLE}"
Data: "{DATE}"
Czas trwania: "{DURATION}"

Aby przejrzeć dodane wydarzenie, kliknij link poniżej
lub skopiuj go i wklej w pasku adresu Twojej przegląrki.

{LINK}

(Uwaga: Musisz być zalogowany jako administrator, aby link działał.)

Pozdrawiam,

Zespół zarządzający {CALENDAR_NAME}

EOT;

// Admin menu entries
$lang_admin_menu = array (
	'login' => 'Login'
	,'register' => 'Rejestracja'
  ,'logout' => 'Wyloguj <span style="color:#FF9922">[<span style="color:#606F79">%s</span>]</span>'
  ,'user_profile' => 'Twój profil'
	,'admin_events' => 'Wydarzenia'
  ,'admin_categories' => 'Kategorie'
  ,'admin_groups' => 'Grupy'
  ,'admin_users' => 'Użytkownicy'
  ,'admin_settings' => 'Ustawienia'
);

// Main menu entries
$lang_main_menu = array (
	'add_event' => 'Dodaj wydarzenie'
	,'cal_view' => 'Miesiąc'
  ,'flat_view' => 'Wykaz'
  ,'weekly_view' => 'Tydzień'
  ,'daily_view' => 'Dzień'
  ,'yearly_view' => 'Rok'
  ,'categories_view' => 'Kategorie'
  ,'search_view' => 'Znajdź'
);

// ======================================================
// Add Event view
// ======================================================

$lang_add_event_view = array(
	'section_title' => 'Dodaj wydarzenie'
	,'edit_event' => 'Edytuj wydarzenie [id%d] \'%s\''
	,'update_event_button' => 'Zmień wydarzenie'

// Event details
	,'event_details_label' => 'Szczegóły wydarzenia'
	,'event_title' => 'Nazwa wydarzenia'
	,'event_desc' => 'Opis wydarzenia'
	,'event_cat' => 'Kategoria'
	,'choose_cat' => 'Wybierz kategorię'
	,'event_date' => 'Data wydarzenia'
	,'day_label' => 'Dzień'
	,'month_label' => 'Miesiąc'
	,'year_label' => 'Rok'
	,'start_date_label' => 'Rozpoczęcie'
	,'start_time_label' => 'Do'
	,'end_date_label' => 'Czas trwania'
	,'all_day_label' => 'Wszystkie dni'
// Contact details
	,'contact_details_label' => 'Szczegóły kontaktu'
	,'contact_info' => 'Informacje o kontakcie'
	,'contact_email' => 'Email'
	,'contact_url' => 'URL'
// Repeat events
	,'repeat_event_label' => 'Cykl'
	,'repeat_method_label' => 'Cykl powtórzeń'
	,'repeat_none' => 'Niepowtarzalne'
	,'repeat_every' => 'Cyklicznie co '
	,'repeat_days' => 'dni'
	,'repeat_weeks' => 'tygodnie'
	,'repeat_months' => 'miesiące'
	,'repeat_years' => 'lata'
	,'repeat_end_date_label' => 'Data zakończenia cyklu'
	,'repeat_end_date_none' => 'Bez daty zakończenia'
	,'repeat_end_date_count' => 'Zakończ po %s wystąpieniach'
	,'repeat_end_date_until' => 'Powtarzaj do'
// Other details
	,'other_details_label' => 'Inne szczegóły'
	,'picture_file' => 'Plik obrazu'
	,'file_upload_info' => '(maks. %d KBitów - Dozwolone rozszerzenia : %s )'
	,'del_picture' => 'Czy na pewno usuąć aktualny obraz?'
// Administrative options
	,'admin_options_label' => 'Opcje administracyjne'
	,'auto_appr_event' => 'Wydarzenie zaakceptowane'

// Error messages
	,'no_title' => 'Podaj tytuł wydarzenia! Jest wymagany.'
	,'no_desc' => 'Wprowadź opis tego wydarzenia! Jest wymagany'
	,'no_cat' => 'Wybierz z listy rozwijanej kategorię!'
	,'date_invalid' => 'Wprowadź poprawną datę wydarzenia!'
	,'end_days_invalid' => 'Wartość wprowadzona w polu \'Dni\' nie jest poprawna !'
	,'end_hours_invalid' => 'Wartość wprowadzona w polu \'Godziny\' nie jest poprawna !'
	,'end_minutes_invalid' => 'Wartość wprowadzona w polu \'Minuty\' nie jest poprawna !'

	,'non_valid_extension' => 'Format załączonego pliku nie jest dopuszczalny ! (Poprawne rozszerzenia: %s)'

	,'file_too_large' => 'Obraz, który załączyłeś jest większy niż %d KBajtów !'
	,'move_image_failed' => 'System nie zadziałał podczas wysyłania obrazu. Upewnij się, że to jest dobry format pliku i nie jest za duży, albo skontaktuj się z administratorem.'
	,'non_valid_dimensions' => 'Wysokość lub szerokość obrazu jest większa niż %s pikseli !'

	,'recur_val_1_invalid' => 'Wartość wprowadzona jako \'powtarzaj cyklicznie\' nie jest poprawna. Ta wartość musi być liczbą większą niż \'0\' !'
	,'recur_end_count_invalid' => 'Wartość wprowadzona jako \'liczba wystąpień\' nie jest poprawna. Ta wartość musi być liczbą większą niż \'0\' !'
	,'recur_end_until_invalid' => 'Data w polu \'powtarzaj do dnia\' musi być późniejsza niż data rozpoczęcia!'
// Misc. messages
	,'submit_event_pending' => 'Twoja informacja o wydarzeniu została wysłana! W kalendarzu zostanie umieszczona po zaakceptowaniu przez administratora. Dziękujemy za nadesłanie wiadomości!'
	,'submit_event_approved' => 'Twoja informacja o wydarzeniu została automatycznie zaakceptowana. Dziękujemy za nadesłanie wiadomości!'
	,'event_repeat_msg' => 'To wydarzenie ma ustawione powtarzanie'
	,'event_no_repeat_msg' => 'To wydarzenie się nie będzie powtarzać'
);

// ======================================================
// daily view
// ======================================================

$lang_daily_event_view = array(
	'section_title' => 'Wydarzenia w dniu:'
	,'next_day' => 'Następny dzień'
	,'previous_day' => 'Poprzedni dzień'
	,'no_events' => 'Nie ma dzisiaj żadnych informacji o wydarzeniach.'
);

// ======================================================
// weekly view
// ======================================================

$lang_weekly_event_view = array(
	'section_title' => 'Wydarzenia w tygodniu'
	,'week_period' => '%s - %s'
	,'next_week' => 'Następny tydzień'
	,'previous_week' => 'Poprzedni tydzień'
	,'selected_week' => 'Tydzień %d'
	,'no_events' => 'W tym tygodniu nie ma żadnych wydarzeń'
);

// ======================================================
// monthly view
// ======================================================

$lang_monthly_event_view = array(
	'section_title' => 'Wydarzenia w miesiacu'
	,'next_month' => 'Następny miesiąc'
	,'previous_month' => 'Poprzedni miesiąc'
);

// ======================================================
// flat view
// ======================================================

$lang_flat_event_view = array(
	'section_title' => 'Wykaz wydarzeń'
	,'week_period' => '%s - %s'
	,'next_month' => 'Następny miesiąc'
	,'previous_month' => 'Poprzedni miesiąc'
	,'contact_info' => 'Informacje kontaktowe'
	,'contact_email' => 'Email'
	,'contact_url' => 'URL'
	,'no_events' => 'W tym miesiącu nie ma żadnych wydarzeń'
);

// ======================================================
// Event view
// ======================================================

$lang_event_view = array(
	'section_title' => 'Wydarzenie'
	,'display_event' => 'Wydarzenie: \'%s\''
	,'cat_name' => 'Kategoria'
	,'event_start_date' => 'Data'
	,'event_end_date' => 'do'
	,'event_duration' => 'Czas trwania'
	,'contact_info' => 'Informacje kontaktowe'
	,'contact_email' => 'Email'
	,'contact_url' => 'URL'
	,'no_event' => 'Nie ma wydarzeń do wyświetlenia.'
	,'stats_string' => '<strong>%d</strong> Wydarzeń łącznie'
	,'edit_event' => 'Edytuj wydarzenie'
	,'delete_event' => 'Usuń wydarzenie'
	,'delete_confirm' => 'Czy na pewno chcesz usunąć to wydarzenie? '
	
);

// ======================================================
// Categories view
// ======================================================

$lang_cats_view = array(
	'section_title' => 'Kategorie wydarzeń'
	,'cat_name' => 'Nazwa kategorii'
	,'total_events' => 'łącznie wydarzeń'
	,'upcoming_events' => 'Nadchodzące wydarzenia'
	,'no_cats' => 'Nie ma jeszcze założonych kategorii.'
	,'stats_string' => 'Jest <strong>%d</strong> wydarzeń w <strong>%d</strong> kategoriach'
);

// ======================================================
// Category Events view
// ======================================================

$lang_cat_events_view = array(
	'section_title' => 'Wydarzenia w \'%s\''
	,'event_name' => 'Nazwa wydarzenia '
	,'event_date' => 'Data'
	,'no_events' => 'Nie ma w tej kategorii żadnych wydarzeń.'
	,'stats_string' => '<strong>%d</strong> wszystkich wydarzeń'
	,'stats_string1' => '<strong>%d</strong> wydarzeń na <strong>%d</strong> stronach'
);

// ======================================================
// cal_search.php
// ======================================================

$lang_event_search_data = array(
	'section_title' => 'Znajdź w kalendarzu',
	'search_results' => 'Wyniki wyszukiwania',
	'category_label' => 'Kategoria',
	'date_label' => 'Data',
	'no_events' => 'Nie ma w tej kategorii żadnych wydarzeń.',
	'search_caption' => 'Wprowadź szukane słowo...',
	'search_again' => 'Szukaj ponownie ',
	'search_button' => 'Znajdź',
// Misc.
	'no_results' => 'Nic nie znaleziono',	
// Stats
	'stats_string1' => 'Znaleziono <strong>%d</strong> wydarzeń',
	'stats_string2' => '<strong>%d</strong> Wydarzeń na <strong>%d</strong> stronach'
);

// ======================================================
// profile.php
// ======================================================

if (defined('PROFILE_PHP')) 

$lang_user_profile_data = array(
	'section_title' => 'Twój profil',
	'edit_profile' => 'Edytuj swój profil',
	'update_profile' => 'Zmień swój profil',
	'actions_label' => 'Działanie',
// Account Info
	'account_info_label' => 'Informacje o koncie',
	'user_name' => 'Login',
	'user_pass' => 'Hasło',
	'user_pass_confirm' => 'Powtórz hasło',
	'user_email' => 'Adres E-mail',
	'group_label' => 'Członek grupy',
// Other Details
	'other_details_label' => 'Inne szczegóły',
	'first_name' => 'Imię',
	'last_name' => 'Nazwisko',
	'full_name' => 'Pełna nazwa',
	'user_website' => 'Strona domowa',
	'user_location' => 'Lokalizacja',
	'user_occupation' => 'Stanowisko',
// Misc.
	'select_language' => 'Wybierz język',
	'edit_profile_success' => 'Profil został zmieniony',
	'update_pass_info' => 'Pozostaw pole hasła puste, jeśli nie chcesz go zmieniać',
// Error messages
	'invalid_password' => 'Wprowadź hasło zawierające tylko litery, cyfry o długości od 4 do 16 znaków !',
	'password_is_username' => 'Hasło musi być inne niż Login !',
	'password_not_match' =>'Hasła nie zgadzają się.',
	'invalid_email' => 'Wprowadź poprawny adres email !',
	'email_exists' => 'Jest już użytkownik używajacy tego adresu email. Jeśli nie pamiętasz hasła skorzystaj z opji przypomnienia. !',
	'no_email' => 'Wpisz adres email! Jest wymagany!',
	'invalid_email' => 'Adres email jest niepoprawny!!',
	'no_password' => 'Wprowadź hasło dla Twojego konta !'
);

// ======================================================
// register.php
// ======================================================

if (defined('USER_REGISTRATION_PHP')) 

$lang_user_registration_data = array(
	'section_title' => 'Rejestracja użytkownika',
// Step 1: Terms & Conditions
	'terms_caption' => 'Warunki korzystania',
	'terms_intro' => 'Aby korzystać z kalendarza, zaakceptuj następujące warunki:',
	'terms_message' => 'Zatrzmaj się na moment, by przejrzeć wyszczególnione poniżej zasady. Jeśłi się z nimi zgadzasz i chcesz kontynuować rejestrację, kliknij przycisk "Akceptuję" poniżej. Aby anulować rejestrację, kliknij przycisk <b>Wstecz</b> w pasku narzędzi swojej przeglądarki.<br /><br />Prosimy pamiętać, że nie odpowiadamy za treść informacji nadsyanych i umieszczanych w kalendarzu przez użytkowników. Nie gwarantujemy że wydarzenie będzie rzeczywiście mieć miejsce, ani tez nie gwarantujemy dokładności, kompletności czy prawdziwości umieszczonych przez użytkowników informacji o jakimkolwiek wydarzeniu.<br /><br />Wszelkie informacje wyrażają wiedzę i przekonania autorów opisu wydarzenia. Każdego, kto ma zastrzeżenia do opublikowanych przez innych treści, zachęcamy do kontaktu z nami pocztą elektroniczną. Usuniemy "wątpliwą" zawartość, o ile tylko uzyskamy informację w czasie pozwalajacym nam rozstrzygnąć wątpliwości.<br /><br />Zgadzasz się nie wykorzystywać kalendarza do publikowania wiadomości nieprawdziwych, niedokładnych, zniekształconych, obraźliwych, obelżywych, nieprzyzwoitych, wulgarnych, obscenicznych, antagonistycznych kulturowo i religijnie, nacjonalistycznych,  faszystowskich, rasistowskich lub w jakikolwiek inny sposób sprzecznych z ogólnie przyjętymi normami społecznymi, moralnymi i prawnymi, a także treści służących uzyskiwaniu rozgłosu i reklamowych..<br /><br />Zgadzasz się zawsze umiesczać informację o prawach własności (copyright), jeżeli nadsyłany materiał nie jest własnością Twoją lub %s.',
	'terms_button' => 'Zgadzam się',
	
// Account Info
	'account_info_label' => 'Informacje o koncie',
	'user_name' => 'Login',
	'user_pass' => 'Hasło',
	'user_pass_confirm' => 'Powtórz hasło ',
	'user_email' => 'Adres E-mail',
// Other Details
	'other_details_label' => 'Inne szczegóły',
	'first_name' => 'Imię',
	'last_name' => 'Nazwisko',
	'user_website' => 'Strona domowa',
	'user_location' => 'Lokalizacja',
	'user_occupation' => 'Stanowisko',
	'register_button' => 'Wyślij',

// Stats
	'stats_string1' => '<strong>%d</strong> użytkowników',
	'stats_string2' => '<strong>%d</strong> użytkowników na <strong>%d</strong> stronach',
// Misc.
	'reg_nomail_success' => 'Dziękujemy za rejestrację.',
	'reg_mail_success' => 'Email z linkiem aktywacyjnym został wysłany na adres, który podałeś przy rejestracji.',
	'reg_activation_success' => 'Gratulacje! Twoje konto jest aktywne i możesz się teraz zalogować. Dziękujemy za rejestrację.',
// Mail messages
	'reg_confirm_subject' => 'Rejestracja w %s',
	
// Error messages
	'no_username' => 'Musisz podać Login !',
	'invalid_username' => 'Podaj Login zawierający tylko litery, cyfry o długości od 4 do 30 znaków!',
	'username_exists' => 'Wybrany przez ciebie Login już jest zajęty. Skorzystaj z innego !',
	'no_password' => 'Musisz podać hasło !',
	'invalid_password' => 'Podaj Hasło zawierające tylko litery, cyfry o długości od 4 do 30 znaków!',
	'password_is_username' => 'Hasło musi się różnić od Loginu !',
	'password_not_match' =>'Wprowadzone hasła nie pasują do siebie',
	'no_email' => 'Musisz podać adres email !',
	'invalid_email' => 'Musisz podać prawidłowy adres email !',
	'email_exists' => 'Inny użytkownik zarejestrował się z takim adresem email. Skorzystaj z innego emaila !',
	'delete_user_failed' => 'Konta tego użytkownika nie można usunąć',
	'no_users' => 'Nie ma żadnych kont użytkowników do wyświetlenia !',
	'already_logged' => 'Już jesteś zalogowany jako użytkownik!',
	'registration_not_allowed' => 'Rejestracja użytkowników jest aktualnie wyłączona !',
	'reg_email_failed' => 'Pojawił się błąd podczas próby wysyłania maila aktywacyjnego !',
	'reg_activation_failed' => 'Pojawił się błąd podczas próby procesu aktywacji !'

);
// Message body for email activation
$lang_user_registration_data['reg_confirm_body'] = <<<EOT
Dziękujemy za rejestrację w {CALENDAR_NAME}

Twój Login : "{USERNAME}"
Twoje hasło : "{PASSWORD}"

Aby aktywować swoje konto, kliknij na poniższym linku albo skopiuj go
i wklej do paska adresu swojej przeglądarki.

{REG_LINK}

Pozdrowienia,

Zespół zarządzający {CALENDAR_NAME}

EOT;

// ======================================================
// theme.php
// ======================================================

// To Be Done

// ======================================================
// functions.inc.php
// ======================================================

// To Be Done

// ======================================================
// dblib.php
// ======================================================

// To Be Done

// ======================================================
// admin_events.php
// ======================================================

if (defined('ADMIN_EVENTS_PHP')) 

$lang_event_admin_data = array(
	'section_title' => 'Menedżer wydarzeń',
	'events_to_approve' => 'Menedżer wydarzeń: Wydarzenia do akceptacji',
	'upcoming_events' => 'Menedżer wydarzeń: Nadchodzące wydarzenia',
	'past_events' => 'Menedżer wydarzeń: Przeszłe wydarzenia',
	'add_event' => 'Dodaj nowe wydarzenie',
	'edit_event' => 'Edytuj wydarzenie',
	'view_event' => 'Widok wydarzenia',
	'approve_event' => 'Akceptuj wydarzenie',
	'update_event' => 'Zmień informację o wydarzeniu',
	'delete_event' => 'Usuń wydarzenie',
	'events_label' => 'Wydarzenia',
	'auto_approve' => 'Autoakceptacja',
	'date_label' => 'Data',
	'actions_label' => 'Działanie',
	'events_filter_label' => 'Filtruj wydarzenia',
	'events_filter_options' => array('Pokaż wszystkie','Pokaż niezaakceptowane','Pokaż nadchodzące','Pokaż przeszłe'),	'picture_attached' => 'Załączony obraz',
// View Event
	'view_event_name' => 'Wydarzenie: \'%s\'',
	'event_start_date' => 'Data',
	'event_end_date' => 'Do',
	'event_duration' => 'Czas trwania',
	'contact_info' => 'Informacje kontaktowe',
	'contact_email' => 'Email',
	'contact_url' => 'URL',
// General Info
// Event form
	'edit_event_title' => 'Wydarzenie: \'%s\'',
	'cat_name' => 'Kategoria',
	'event_start_date' => 'Data',
	'event_end_date' => 'Do',
	'contact_info' => 'Informacje kontaktowe',
	'contact_email' => 'Email',
	'contact_url' => 'URL',
	'no_event' => 'Nie ma wydarzeń do wyświetlenia.',
	'stats_string' => '<strong>%d</strong> Wydarzeń łącznie',
// Stats
	'stats_string1' => '<strong>%d</strong> wydarzenia',
	'stats_string2' => 'Total: <strong>%d</strong> wydarzenia na <strong>%d</strong> stronach',
// Misc.
	'add_event_success' => 'Nowe wydarzenie zostało dodane',
	'edit_event_success' => 'Wydarzenie zostało zmienione',
	'approve_event_success' => 'Wydarzenie zostało zaakceptowane',
	'delete_confirm' => 'Czy na pewno chcesz usunąć to wydarzenie ?',
	'delete_event_success' => 'Wydarzenie zostało skasowane',
	'active_label' => 'Aktywne',
	'not_active_label' => 'Nieaktywne',
// Error messages
	'no_event_name' => 'Wpisz nazwę wydarzenia! Jest wymagana.',
	'no_event_desc' => 'Wprowadź opis wydarzenia! Jest wymagany.',
	'no_cat' => 'Wybierz kategorię wydarzenia! Jest wymagana.',
	'no_day' => 'Wybierz dzień, jest wymagany!',
	'no_month' => 'Wybierz miesiąc, jest wymagany!',
	'no_year' => 'Wybierz rok, jest wymagany!!',
	'non_valid_date' => 'Wprowadź poprawną datę !',
	'end_days_invalid' => 'Upewnij się, że pole \'Dni\' pod \'Czas trwania\' zawiera tylko liczby !',
	'end_hours_invalid' => 'Upewnij się, że pole \'Godziny\' pod \'Czas trwania\' zawiera tylko liczby !',
	'end_minutes_invalid' => 'Upewnij się, że pole \'Minuty\' pod \'Czas trwania\' zawiera tylko liczby !',
	'file_too_large' => 'Załączony obraz ma większy rozmiar niż %d KB !',
	'non_valid_extension' => 'Format załączonego pliku nie jest dopuszczalny !',
	'delete_event_failed' => 'To wydarzenie nie może być usunięte',
	'approve_event_failed' => 'To wydarzenie nie może być zaakceptowane',
	'no_events' => 'Nie ma żadnych informacji o wydarzeniach.',
	'move_image_failed' => 'System nie pozwala przenieść obrazu !',
	'non_valid_dimensions' => 'Szerokość lub wysokość obrazu jest większa niż %s pikseli !',

	'recur_val_1_invalid' => 'Wprowadzono niepoprawną wartość w pole \'powtarzaj w okresie\'. Ta wartość musi być liczbą większa niż \'0\' !',
	'recur_end_count_invalid' => 'Wprowadzono niepoprawną wartość w pole \'liczba wystąpień\'. Ta wartość musi być liczbą większa niż \'0\' !',
	'recur_end_until_invalid' => 'Data w \'powtarzaj aż do dnia\' musi być większa niż data rozpoczęcia !'

);

// ======================================================
// admin_categories.php
// ======================================================

if (defined('ADMIN_CATS_PHP')) 

$lang_cat_admin_data = array(
	'section_title' => 'Zarządzanie kategoriami',
	'add_cat' => 'Dodaj nową kategorię',
	'edit_cat' => 'Edytuj kategorię',
	'update_cat' => 'Zmień opis kategorii',
	'delete_cat' => 'Usuń Kategorię',
	'events_label' => 'Wydarzenia',
	'visibility' => 'Oglądalność',
	'actions_label' => 'działania',
	'users_label' => 'Użytkownicy',
	'admins_label' => 'Administratorzy',
// General Info
	'general_info_label' => 'Ogólne informacje',
	'cat_name' => 'Nazwa kategorii',
	'cat_desc' => 'Opis kategorii',
	'cat_color' => 'Kolor',
	'pick_color' => 'Wskaż kolor!',
	'status_label' => 'Status',
// Administrative Options
	'admin_label' => 'Opcje administracyjne',
	'auto_admin_appr' => 'Autoaprobata wysłanych przez administratorów',
	'auto_user_appr' => 'Autoaprobata wysłanych przez użytkowników',
// Stats
	'stats_string1' => '<strong>%d</strong> kategorii',
	'stats_string2' => 'Aktywne: <strong>%d</strong>&nbsp;&nbsp;&nbsp;úącznie: <strong>%d</strong>&nbsp;&nbsp;&nbsp;on <strong>%d</strong> stron',
// Misc.
	'add_cat_success' => 'Dodano nową kategorię',
	'edit_cat_success' => 'Zmieniono kategorię',
	'delete_confirm' => 'Czy na pewno chcesz usunąć tę kategorię?',
	'delete_cat_success' => 'Usunięto kategorię',
	'active_label' => 'Aktywna',
	'not_active_label' => 'Nieaktywna',
// Error messages
	'no_cat_name' => 'Wpisz nazwę kategorii! Jest wymagana.',
	'no_cat_desc' => 'Wpisz opis kategorii! Jest wymagany.',
	'no_color' => 'Wybierz kolor dla kategorii !',
	'delete_cat_failed' => 'Tej kategorii nie można usunąć',
	'no_cats' => 'Nie ma jeszcze założonych kategorii!',
	'cat_has_events' => 'Ta kategoria zawiera %d wydarzeń i w związku z tym nie można jej usunąć <br>Usuń najpierw istniejące wydarzenia i spróbuj ponownie!'

);
// ======================================================
// admin_users.php
// ======================================================

if (defined('ADMIN_USERS_PHP')) 

$lang_user_admin_data = array(
	'section_title' => 'Administracja użytkownikami',
	'add_user' => 'Dodaj nowego użytkownika',
	'edit_user' => 'Edytuj profil użytkownika',
	'update_user' => 'Zmień profil użytkownika',
	'delete_user' => 'Usuń konto użytkownika',
	'last_access' => 'Ostatnio zalogowany',
	'actions_label' => 'Działania',
	'active_label' => 'Aktywny',
	'not_active_label' => 'Nieakatywny',
// Account Info
	'account_info_label' => 'Szczegóły profilu',
	'user_name' => 'Login',
	'user_pass' => 'Hasło',
	'user_pass_confirm' => 'Powtórz hasło',
	'user_email' => 'Adres E-mail',
	'group_label' => 'Członek grupy',
	'status_label' => 'Status konta',
// Other Details
	'other_details_label' => 'Inne szczegóły',
	'first_name' => 'Imię',
	'last_name' => 'Nazwisko',
	'user_website' => 'Strona domowa',
	'user_location' => 'Lokalizacja',
	'user_occupation' => 'Stanowisko',
// Stats
	'stats_string1' => '<strong>%d</strong> użytkowników',
	'stats_string2' => '<strong>%d</strong> użytkowników na <strong>%d</strong> stronach',
// Misc.
	'select_group' => 'Wybierz jeden...',
	'add_user_success' => 'Konto użytkownika dodane',
	'edit_user_success' => 'Konto użytkownika zaktualizowane',
	'delete_confirm' => 'Czy na pewno chcesz usunąć to konto?',
	'delete_user_success' => 'Konto użytkownika zostało usunięte',
	'update_pass_info' => 'Pozostaw puste pole hasła, jeśli nie chcesz go zmieniać',
	'access_never' => 'Nigdy',
// Error messages
	'no_username' => 'Musisz podać Login !',
	'invalid_username' => 'Podaj Login zawierający tylko litery i cyfry o długości od 4 do 30 znaków !',
	'invalid_password' => 'Podaj Hasło zawierające tylko litery i cyfry o długości od 4 do 30 znaków !',
	'password_is_username' => 'Hasło musi się różnić od Loginu !',
	'password_not_match' =>'Wprowadzone hasła nie zgadzają się',
	'invalid_email' => 'Musisz podać poprawny adres email !',
	'email_exists' => 'Inny użytkownik już zarejestrował się z takim samym adresem email jak ty. Wprowadź inny adres email !',
	'username_exists' => 'Ktoś inny wykorzystuje już ten login. Wprowadź inny !',
	'no_email' => 'Musisz wprowadzić adres email !',
	'invalid_email' => 'Musisz wprowadzić poprawny adres email !',
	'no_password' => 'Musisz podać hasło dla tego nowego konta !',
	'no_group' => 'Wybierz grupę, do której można przypisać tego użytkownika !',
	'delete_user_failed' => 'To konto nie może być skasowane',
	'no_users' => 'Nie ma jeszcze założonych kont użytkowników!'

);

// ======================================================
// admin_groups.php
// ======================================================

if (defined('ADMIN_GROUPS_PHP')) 

$lang_group_admin_data = array(
	'section_title' => 'Administracja grupami',
	'add_group' => 'Dodaj nową grupę',
	'edit_group' => 'Edytuj grupę',
	'update_group' => 'Zmień informacje o grupie',
	'delete_group' => 'Usuń grupę',
	'view_group' => 'Zobacz grupę',
	'users_label' => 'Członkowie',
	'actions_label' => 'Działania',
// General Info
	'general_info_label' => 'Informacje ogólne',
	'group_name' => 'Nazwa grupy',
	'group_desc' => 'Opis grupy',
// Group Access Level
	'access_level_label' => 'Poziom dostępu grupy',
	'Administrator' => 'Użytkownicy tej grupy mają dostęp do opcji admininistracyjnych',
	'can_manage_accounts' => 'Użytkownicy tej grupy mogą zarządzać kontami',
	'can_change_settings' => 'Użytkownicy tej grupy mogą zmieniać ustawienia kalendarza',
	'can_manage_cats' => 'Użytkownicy tej grupy mogą zarządzać Kategoriami',
	'upl_need_approval' => 'Wysłane wydarzenia wymagają akceptacji admina',
// Stats
	'stats_string1' => '<strong>%d</strong> grupy',
	'stats_string2' => 'úącznie: <strong>%d</strong> grup na <strong>%d</strong> stronach',
	'stats_string3' => 'úącznie: <strong>%d</strong> użytkowników na <strong>%d</strong> stronach',
// View Group Members
	'group_members_string' => 'Członkowie \'%s\' grup',
	'username_label' => 'Login',
	'firstname_label' => 'Imię',
	'lastname_label' => 'Nazwisko',
	'email_label' => 'Email',
	'last_access_label' => 'Ostatnio zalogowany',
	'edit_user' => 'Edytuj profil użytkownika',
	'delete_user' => 'Usuń użytkownika',
// Misc.
	'add_group_success' => 'Dodano nową grupę',
	'edit_group_success' => 'Szczegóły informacji o grupie zostały zmienione.',
	'delete_confirm' => 'Czy na pewno chcesz usunąć grupę ?',
	'delete_user_confirm' => 'Czy na pewno chcesz usunąć grupę ?',
	'delete_group_success' => 'Grupa została usnięta',
	'no_users_string' => 'W tej grupie nie ma użytkowników',
// Error messages
	'no_group_name' => 'Wprowadź nazwę grupy! Jest wymagana',
	'no_group_desc' => 'Wprowadź opis grupy! Jest wymagany',
	'delete_group_failed' => 'Tej grupy nie można usunąć',
	'no_groups' => 'Nie ma żadnych grup do wyświetlenia !',
	'group_has_users' => 'Ta grupa zawiera %d użytkowników i w związku z tym nie można jej usunąć!<br>Usuń powiązania użytkowników z tą grupą i spróbuj ponownie!'

);

// ======================================================
// admin_settings.php / admin_settings_template.php / 
// admin_settings_updates.php
// ======================================================

//if (defined('SETTINGS_PHP')) 

$lang_settings_data = array(
	'section_title' => 'Ustawienia kalendarza'
// Links
	,'admin_links_text' => 'Wybierz sekcję'
	,'admin_links' => array('Glówne ustawienia','Konfiguracja szablonu','Zmiany produktu')
// General Settings
	,'general_settings_label' => 'Glówne ustawienia'
	,'calendar_name' => 'Nazwa kalendarza'
	,'calendar_description' => 'Opis kalendarza'
	,'calendar_admin_email' => 'Email administratora'
	,'cookie_name' => 'Nazwa cookie używanych przez skrypt'
	,'cookie_path' => 'ªcieżka cookie używana przez skrypt'
	,'debug_mode' => 'Włącz tryb diagnostyczny'
	,'calendar_status' => 'Włącz kalendarz'
//zwiastun add	
	,'url_target_for_events' => 'Domyślne okno dla URL wydarzenia'
	,'capitalize_event_titles' => 'Nazwa wydarzenia kapitalikami'
	,'show_only_start_times' => 'Pokaż tylko czas rozpoczęcia'
	,'show_top_navigation_bar' => 'Pokaż górny pasek nawigacyjny'
	,'who_can_add_events_as_long' => 'Prawo dodawania wydarzeń<br /><small>(jeśli <b>'	
	,'is_enabled_below' => '</b> poniżej włączone)</small>'
	,'who_can_edit_events' => 'Prawo edytowania wydarzeń'
	,'who_can_delete_events' => 'Prawo usuwania wydarzeń'	
	,'new_post_notification_desc' => '<br /><small>(Wysyła powiadomienie na adres email administratora, gdy nowe albo edytowane wydarzenie wymaga aprobaty.)</small>'	
//end zwiastun	
	
// Environment Settings
	,'env_settings_label' => 'Ustawienia środowiska'
	,'lang' => 'Język'
		,'lang_name' => 'Język'
		,'lang_native_name' => 'Nazwa w języku'
		,'lang_trans_date' => 'Tłumaczono w'
		,'lang_author_name' => 'Autor'
		,'lang_author_email' => 'E-mail'
		,'lang_author_url' => 'WWW'
	,'charset' => 'Kodowanie'
	,'theme' => 'Szablon'
		,'theme_name' => 'Nazwa szablonu'
		,'theme_date_made' => 'Utworzony '
		,'theme_author_name' => 'Autor'
		,'theme_author_email' => 'Mail'
		,'theme_author_url' => 'WWW'
	,'timezone' => 'Przesunięcie czasu'
	,'time_format' => 'Format wyświetlania czasu'
		,'24hours' => '24 godzinny'
		,'12hours' => '12 godzinny'
	,'auto_daylight_saving' => 'Automatyczna zmiana czasu: letni-zimowy (DST)'
	,'main_table_width' => 'Szerokość głównej tabeli (piksele albo %)'
	,'day_start' => 'Tydzień zaczyna się w '
	,'default_view' => 'Domyślny widok'
	,'search_view' => 'Włącz wyszukiwanie'
	,'archive' => 'Pokaż przeszłe wydarzenia'
	,'events_per_page' => 'Liczba wydarzeń na stronie'
	,'sort_order' => 'Domyślny porządek sortowania'
		,'sort_order_title_a' => 'Tytuły rosnąco'
		,'sort_order_title_d' => 'Tytuły malejąco'
		,'sort_order_date_a' => 'Daty rosnąco'
		,'sort_order_date_d' => 'Daty malejąco'
	,'show_recurrent_events' => 'Pokaż wydarzenia cykliczne'
	,'multi_day_events' => 'Wielodzienne wydarzenia'
		,'multi_day_events_all' => 'Pokaż cały zakres dat'
		,'multi_day_events_bounds' => 'Pokaż tylko datę startu i zakończenia'
		,'multi_day_events_start' => 'Pokaż tylko datę startu'
	// User Settings
	,'user_settings_label' => 'Użytkownicy - ustawienia'
	,'allow_user_registration' => 'Rejestracja użytkowników?'
	,'reg_duplicate_emails' => 'Powtarzalny email przy rejestracji?'
	,'reg_email_verify' => 'Włącz aktywację mailem'
// Event View
	,'event_view_label' => 'Wydarzenie'
	,'popup_event_mode' => 'Pokaż w oknie wyskakującym'
	,'popup_event_width' => 'Szerokość okna wyskakującego'
	,'popup_event_height' => 'Wysokość okna wyskakującego'

//zwiastun add	
   ,'show_overlapping_recurrences' => 'Pokaż pokrywające się - powtarzalne<br /><small>tylko jeśli czas trwania wydarzenia jest dłuższy niż odstęp czasowy między nimi (interwał), np. wydarzenie trwa 3 dni, a powtarza się co 2 dni.)</small>)'
   ,'allow_javascript_in_event_urls_descr' => 'Zgoda na Javascript w URL do opisu wydarzenia'
   ,'show_recurrence_info' => 'Pokaż informację o cykliczności'	
//zwiastun end	   
   	
// Add Event View
	,'add_event_view_label' => 'Dodawanie wydarzeń'
	,'add_event_view' => 'Włączony odnośnik'
	,'addevent_allow_html' => 'Zgoda na <b>BB Code</b> w opisach'
	,'addevent_allow_contact' => 'Zgoda na informacje o kontakcie'
	,'addevent_allow_email' => 'Zgoda na adres Email'
	,'addevent_allow_url' => 'Zgoda na URL strony WWW'
	,'addevent_allow_picture' => 'Zgoda na obrazy'
	,'new_post_notification' => 'Powiadomienia, gdy wydarzenie wymaga akceptacji'
// Calendar View
	,'calendar_view_label' => 'Kalendarz miesiąca'
	,'monthly_view' => 'Włączony odnośnik'
	,'cal_view_show_week' => 'Wyświetl numery tygodni'
	,'cal_view_max_chars' => 'Maks. ilość znaków w opisie'	
 //zwiastun add				
   ,'show_event_times' => 'Pokaż czas trwania wydarzenia'	
   ,'add_event_view_desc' => '<br /><small>Uwaga, jeśli <b>Nie</b>, ustawienie w opcji "Kto może dodawać wydarzenia" zostanie unieważnione. Ale administratorzy zawsze mogą dodawać i edytować wydarzenia.</small>'   	
//zwiastun end	  	

// Flyer View
	,'flyer_view_label' => 'Wykaz wydarzeń'
	,'flyer_view' => 'Włączony odnośnik'
	,'flyer_show_picture' => 'Pokaż obrazy w oknie wyskakujacym'
	,'flyer_view_max_chars' => 'Maks. ilość znaków w opisie'

// Weekly View
	,'weekly_view_label' => 'Wydarzenia w tygodniu'
	,'weekly_view' => 'Włączony odnośnik'
	,'weekly_view_max_chars' => 'Maks. ilość znaków w opisie'

// Daily View
	,'daily_view_label' => 'Wydarzenia w dniu'
	,'daily_view' => 'Włączony odnośnik'
	,'daily_view_max_chars' => 'Maks. ilość znaków w opisie'
// Categories View
	,'categories_view_label' => 'Kategorie wydarzeń'
	,'cats_view' => 'Włączony odnośnik'
	,'cats_view_max_chars' => 'Maks. ilość znaków w opisie'
// Mini Calendar
	,'mini_cal_label' => 'Mini kalendarz'
	,'mini_cal_def_picture' => 'Domyślna ikona'
	,'mini_cal_display_picture' => 'Wyświetl ikonę'
	,'mini_cal_diplay_options' => array('»adna','Domyślna ikona', 'Ikona dnia','Ikona tygodnia','Ikona losowa')
// Mail Settings
	,'mail_settings_label' => 'Ustawienia poczty'
	,'mail_method' => 'Metoda wysyłania maili'
	,'mail_smtp_host' => ' Hosty SMTP (oddzielone średnikami ;)'
	,'mail_smtp_auth' => 'SMTP wymaga uwierzytelnienia'
	,'mail_smtp_username' => 'Login SMTP '
	,'mail_smtp_password' => 'Hasło SMTP'

// Picture Settings
	,'picture_settings_label' => 'Grafiki - ustawienia'
	,'max_upl_dim' => 'Maks. szerokość albo wysokość obrazów'
	,'max_upl_size' => 'Maks. rozmiar obrazów (w Bitach)'
	,'picture_chmod' => 'Domyślne prawa dla obrazów (CHMOD)'
	,'allowed_file_extensions' => 'Akceptowane rozszerzenia nazw plików obrazów'
// Form Buttons
	,'update_config' => 'Zapisz nową konfigurację'
	,'restore_config' => 'Przywróć ustawienia standardowe'
// Misc.
	,'update_settings_success' => 'Ustawienia zostały zmienione'
	,'restore_default_confirm' => 'Czy na pewno chcesz przywrócić standardowe ustawienia ?'
// Template Configuration
	,'template_type' => 'Typ szablonu'
	,'template_header' => 'Własny nagłówek'
	,'template_footer' => 'Własna stopka'
	,'template_status_default' => 'Użyj domyślnego szablonu'
	,'template_status_custom' => 'Użyj następującego szablonu:'
	,'template_custom' => 'Własny szablon'

	,'info_meta' => 'Metadane'
	,'info_status' => 'Kontrola Statusu'
	,'info_status_default' => 'Wyłącz tę zawartość'
	,'info_status_custom' => 'Wyświetl następującą zawartość:'
	,'info_custom' => 'Własna zawartość'

	,'dynamic_tags' => 'Dynamiczne znaczniki'

// Product Updates
	,'updates_check_text' => 'Poczekaj, dopóki nie otrzymasz informacji z serwera...'
	,'updates_no_response' => 'Brak odpowiedzi z serwera. Spróbuj ponownie za jakiś czas.'
	,'avail_updates' => 'Dostępne aktualizacje'
	,'updates_download_zip' => 'Pobierz plik ZIP (.zip)'
	,'updates_download_tgz' => 'Pobierz  plik TGZ (.tar.gz)'
	,'updates_released_label' => 'Data wersji: %s'
	,'updates_no_update' => 'Używasz najnowszej dostępnej wersji. Nie musisz nic aktualizować.'
);

// ======================================================
// cal_mini.inc.php
// ======================================================

$lang_mini_cal = array(
	'def_pic' => 'Domyślny obraz'
	,'daily_pic' => 'Ikona dnia (%s)'
	,'weekly_pic' => 'Ikona tygodnia (%s)'
	,'rand_pic' => 'Losowa ikona (%s)'
	,'post_event' => 'Dodaj nowe zdarzenie'
	,'num_events' => '%d wydarzeń'
	,'selected_week' => 'Tydzień %d'
);

// ======================================================
// extcalendar.php
// ======================================================

// To Be Done

// ======================================================
// config.inc.php
// ======================================================

// To Be Done

// ======================================================
// install.php
// ======================================================

// To Be Done

// ======================================================
// login.php
// ======================================================

if (defined('LOGIN_PHP')) 

$lang_login_data = array(
	'section_title' => 'Ekran Logowania'
// General Settings
	,'login_intro' => 'Wprowadź swoją nazwę użytkownika i hasło'
	,'username' => 'Login'
	,'password' => 'Hasło'
	,'remember_me' => 'Zapamiętaj mnie'
	,'login_button' => 'Zaloguj'
// Errors
	,'invalid_login' => 'Zweryfikuj wprowadzone informacje i spróbuj ponownie!'
	,'no_username' => 'Musisz podać login !'
	,'already_logged' => 'Jesteś już zalogowany !'
);

// ======================================================
// logout.php
// ======================================================

// To Be Done

?>
