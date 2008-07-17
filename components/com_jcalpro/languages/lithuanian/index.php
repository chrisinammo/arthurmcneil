<?PHP

// New language structure
$lang_info = array (
	'name' => 'Lithuanian'
	,'nativename' => 'Lietuvių' // Language name in native language. E.g: 'Franais' for 'French'
	,'locale' => array('lt','lithuanian') // Standard locale alternatives for a specific language. For reference, go to: http://www.php.net/manual/en/function.setlocale.php
	,'charset' => 'utf-8' // For reference, go to : http://www.w3.org/International/O-charset-lang.html
	,'direction' => 'ltr' // 'ltr' for Left to Right. 'rtl' for Right to Left languages such as Arabic.
	,'author' => 'Katinas'
	,'author_email' => 'katynas@gmail.com'
	,'author_url' => 'http://www.essentialsofid.com'
	,'transdate' => '02/02/2007'
);

$lang_general = array (
	'yes' => 'Taip'
	,'no' => 'Ne'
	,'back' => 'Atgal'
	,'continue' => 'Tęsti'
	,'close' => 'Uždaryti'
	,'errors' => 'Klaidos'
	,'info' => 'Informacija'
	,'day' => 'Diena'
	,'days' => 'Dienos'
	,'month' => 'Mėnuo'
	,'months' => 'Mėnesiai'
	,'year' => 'Metai'
	,'years' => 'Metai'
	,'hour' => 'Valanda'
	,'hours' => 'Valandos'
	,'minute' => 'Minutė'
	,'minutes' => 'Minutės'
	,'everyday' => 'Kiekvieną dieną'
	,'everymonth' => 'Kiekvieną mėnesį'
	,'everyyear' => 'Kiekvienais metais'
	,'active' => 'Aktyvus'
	,'not_active' => 'Neaktyvus'
	,'today' => 'Šiandien'
	,'signature' => 'Sukurta %s'
	,'expand' => 'Išskleisti'
	,'collapse' => 'Suglausti'
);

// Date formats, For reference, go to : http://www.php.net/manual/en/function.strftime.php
$lang_date_format = array (
	'full_date' => '%Y | %m | %d' // e.g. Wednesday, June 05, 2002
	,'full_date_time_24hour' => '%Y %m %d  At %H:%M' // e.g. Wednesday, June 05, 2002 At 21:05
	,'full_date_time_12hour' => '%Y %m %d  At %I:%M %p' // e.g. Wednesday, June 05, 2002 At 9:05 pm
	,'day_month_year' => '%Y-%m-%d' // e.g 10-Sep-2004
	,'local_date' => '%c' // Preferred date and time representation for current language 
	,'mini_date' => '%a. %d %m, %Y' 
	,'month_year' => '%Y %m'
	,'day_of_week' => array('Sekmadienis','Pirmadienis','Antradienis','Trečiadienis','Ketvirtadienis','Penktadienis','Šeštadienis')
	,'months' => array('Sausis','Vasaris','Kovas','Balandis','Gegužė','Birželis','Liepa','Rugpjūtis','Rugsėjis','Spalis','Lapkritis','Gruodis')
);

$lang_system = array (
	'system_caption' => 'Sisteminis pranešimas'
  ,'page_access_denied' => 'Jums nepakanka teisių atlikti šį veiksmą. Kreipkitės į sistemos administratorių.'
  ,'page_requires_login' => 'Jūs neprisiregistravote!'
  ,'operation_denied' => 'Jums nepakanka teisių atlikti šį veiksmą. Kreipkitės į sistemos administratorių.'
	,'section_disabled' => 'Šis skyrius šiuo metu išjungtas !'
  ,'non_exist_cat' => 'Tokia kategorija neegzistuoja !'
  ,'non_exist_event' => 'Tokio renginio nėra !'
  ,'param_missing' => 'Neteisingi parametrai'
  ,'no_events' => 'Renginių nėra'
  ,'config_string' => 'You are currently using \'%s\' running on %s, %s and %s.'
// Šito kintamojo laikinai neverčiam 
  ,'no_table' => '\'%s\' lentelės nėra !'
  ,'no_anonymous_group' => '%s lentelėje nėra grupės \'Anonymous\' !'
  ,'calendar_locked' => 'Kalendorius laikinai neveikia. Atsiprašome už nepatogumus !'
	,'new_upgrade' => 'Jau yra nauja sistemos versija. Rekomenduojame atlikti pakeitimus dabar. Spauskite "Tęsti" norėdami paleisti atnaujinimų diegimo įrankį.'
	,'no_profile' => 'Jūsų aprašymas nepasiekiamas!'
	,'unknown_component' => 'Nežinomas komponentas!'
// Mail messages
	,'new_event_subject' => 'Renginį reikia patvirtinti iki %s'
// Nežinau ar teisingai išverčiau - buvo taip: Event Needs Approval at %s	
	,'event_notification_failed' => 'Klaida! Negaliu išsiųsti laiško!'
);

// Message body for new event email notification
$lang_system['event_notification_body'] = <<<EOT
{CALENDAR_NAME} pasipildė nauju renginiu, kurį reikia patvirtinti:

Pavadinimas: "{TITLE}"
Data: "{DATE}"
Trukmė: "{DURATION}"

Galite pažiūrėti renginio aprašymą paspaudę žemiau esančią nuorodą arba šią nuorodą nukopijavę į savo interneto naršyklės adreso laukelį.

{LINK}

(Atminkite, jog norėdami peržiūrėti renginio aprašyma, Jūs turite jungtis į sistemą vartotoju, turiunčiu administratoriaus teises)

Pagarbiai,

{CALENDAR_NAME} administratorius

EOT;

// Admin menu entries
$lang_admin_menu = array (
	'login' => 'Prisijungti'
	,'register' => 'Registruotis'
  ,'logout' => 'Atsijungti <span style="color:#FF9922">[<span style="color:#606F79">%s</span>]</span>'
  ,'user_profile' => 'Mano profilis'
	,'admin_events' => 'Įvykiai'
  ,'admin_categories' => 'Kategorijos'
  ,'admin_groups' => 'Grupės'
  ,'admin_users' => 'Vartotojai'
  ,'admin_settings' => 'Nustatymai'
);

// Main menu entries
$lang_main_menu = array (
	'add_event' => 'Pridėti įvykį'
	,'cal_view' => 'Mėnesio vaizdas'
  ,'flat_view' => 'Plokščias vaizdas'
  ,'weekly_view' => 'Savaitės vaizdas'
  ,'daily_view' => 'Dienos vaizdas'
  ,'yearly_view' => 'Visų metų vaizdas'
  ,'categories_view' => 'Kategorijos'
  ,'search_view' => 'Paieška'
);

// ======================================================
// Add Event view
// ======================================================

$lang_add_event_view = array(
	'section_title' => 'Pridėti įvykį'
	,'edit_event' => 'Keisti įvykį [id%d] \'%s\''
	,'update_event_button' => 'Atnaujinti įvykį'

// Event details
	,'event_details_label' => 'Apie įvykį plačiau'
	,'event_title' => 'Įvykio antraštė'
	,'event_desc' => 'Įvykio aprašymas'
	,'event_cat' => 'Kategorija'
	,'choose_cat' => 'Pasirinkite kategoriją'
	,'event_date' => 'Įvykio data'
	,'day_label' => 'Diena'
	,'month_label' => 'Mėnuo'
	,'year_label' => 'Metai'
	,'start_date_label' => 'Pradžios data'
	,'start_time_label' => 'Pradžios laikas'
	,'end_date_label' => 'Trukmė'
	,'all_day_label' => 'Visą dieną'
// Contact details
	,'contact_details_label' => 'Kontaktai'
	,'contact_info' => 'Contact Info'
	,'contact_email' => 'El. paštas'
	,'contact_url' => 'www'
// Repeat events
	,'repeat_event_label' => 'Pakartoti renginį'
	,'repeat_method_label' => 'Pasikartojimo metodas'
	,'repeat_none' => 'Nekartoti šio renginio'
	,'repeat_every' => 'Kartoti kas'
	,'repeat_days' => 'Dieną(-as, -ų)'
	,'repeat_weeks' => 'Savaitę(-es, -čių)'
	,'repeat_months' => 'Mėnesį(-ius, -ių)'
	,'repeat_years' => 'metus'
	,'repeat_end_date_label' => 'Pasikartojimo pabaigos data'
	,'repeat_end_date_none' => 'Nesibaigiantis pasikartojimas'
	,'repeat_end_date_count' => 'Nebekartoti, kai renginys įvyks %s kartų(-us)'
	,'repeat_end_date_until' => 'Kartoti iki'
// Other details
	,'other_details_label' => 'Detaliau'
	,'picture_file' => 'Paveikslėlio byla'
	,'file_upload_info' => '(%d KBytes limitas - leidžiami išplėtimai : %s )' 
	,'del_picture' => 'Ištrinti dabartinį paveikslėlį ?'
// Administrative options
	,'admin_options_label' => 'Administravimo pasirinktys'
	,'auto_appr_event' => 'Renginys patvirtintas'

// Error messages
	,'no_title' => 'Suteikite renginiui pavadinimą !'
	,'no_desc' => 'Sukurkite renginio aprašymą!'
	,'no_cat' => 'Pasirinkite ketegoriją iš sąrašo !'
	,'date_invalid' => 'Nurodykite datą !'
	,'end_days_invalid' => 'Neteisinga reikšmė laukelyje \'Dienos\' !'
	,'end_hours_invalid' => 'Neteisinga reikšmė  laukelyje \'Valandos\'!'
	,'end_minutes_invalid' => 'Neteisinga reikšmė  laukelyje \'Minutės\'!'
	,'move_image_failed' => 'Nepavyko įkelti paveikslėlio. Patikrinkite paveikslėlio parametrus arba informuokite sistemos administratorių.'
	,'non_valid_dimensions' => 'Paveikslėlio plotis arba aukštis didesnis nei %s taškų !'

	,'recur_val_1_invalid' => 'Neteisinga \'Pasikartojimo intervalas\' reikšmė. Reikšmė turi būti didesnė už \'0\' !'
	,'recur_end_count_invalid' => 'Neteisinga \'Pasikartojimu skaičius\' reikšmė. Reikšmė turi būti didesnė už \'0\' !'
	,'recur_end_until_invalid' => ' \'Kartoti iki\' data turi būti vėlesnė nei renginio pradžio data !'
// Misc. messages
	,'submit_event_pending' => 'Renginys įvestas sėkmingai, tačiau jis bus matomas kalendoriuje tik tada, kai jį patvirtins administratorius! '
	,'submit_event_approved' => 'Renginys patvirtintas!'
	,'event_repeat_msg' => 'Renginys kartosis'
	,'event_no_repeat_msg' => 'Vienkartinis renginys'
);

// ======================================================
// daily view
// ======================================================

$lang_daily_event_view = array(
	'section_title' => 'Daily View'
	,'next_day' => 'Sekanti diena'
	,'previous_day' => 'Praėjusi diena'
	,'no_events' => 'Renginių nėra.'
);

// ======================================================
// weekly view
// ======================================================

$lang_weekly_event_view = array(
	'section_title' => 'Savaitės vaizdas'
	,'week_period' => '%s - %s'
	,'next_week' => 'Sekanti savaitė'
	,'previous_week' => 'Ankstesnė savaitė'
	,'selected_week' => 'Week %d'
	,'no_events' => 'Šią savaitę renginių nėra'
);

// ======================================================
// monthly view
// ======================================================

$lang_monthly_event_view = array(
	'section_title' => 'Mėnesio vaizdas'
	,'next_month' => 'Sekantis mėnuo'
	,'previous_month' => 'Ankstesnis mėnuo'
);

// ======================================================
// flat view
// ======================================================

$lang_flat_event_view = array(
	'section_title' => 'Plokščias vaizdas'
	,'week_period' => '%s - %s'
	,'next_month' => 'Sekantis mėnuo'
	,'previous_month' => 'Ankstesnis mėnuo'
	,'contact_info' => 'Kontaktinė informacija'
	,'contact_email' => 'e. paštas'
	,'contact_url' => 'www'
	,'no_events' => 'Šį mėnesį renginių nėra'
);

// ======================================================
// Event view
// ======================================================

$lang_event_view = array(
	'section_title' => 'Renginio vaizdas'
	,'display_event' => 'Renginys: \'%s\''
	,'cat_name' => 'Kategorija'
	,'event_start_date' => 'Data'
	,'event_end_date' => 'Iki'
	,'event_duration' => 'Trukmė'
	,'contact_info' => 'Kontaktinė informacija'
	,'contact_email' => 'El. paštas'
	,'contact_url' => ' www '
	,'no_event' => 'Renginių nėra'
	,'stats_string' => 'Viso renginių: <strong>%d</strong> '
	,'edit_event' => 'Redaguoti renginį'
	,'delete_event' => 'Ištrinti renginį'
	,'delete_confirm' => 'Ar tikrai norite ištrinti šį renginį ?'
	
);

// ======================================================
// Categories view
// ======================================================

$lang_cats_view = array(
	'section_title' => 'Kategorijos vaizdas'
	,'cat_name' => 'Kategorija'
	,'total_events' => 'Viso renginių:'
	,'upcoming_events' => 'Artimiausias renginys'
	,'no_cats' => 'Kategorijų nėra'
	,'stats_string' => 'Viso yra <strong>%d</strong> renginys(-iai, -ių) <strong>%d</strong> kategorijoje (-ose)'
);

// ======================================================
// Category Events view
// ======================================================

$lang_cat_events_view = array(
	'section_title' => 'Renginiai \'%s\' kategorijoje'
	,'event_name' => 'Renginys'
	,'event_date' => 'Data'
	,'no_events' => 'Šioje kategorijoje renginių nėra.'
	,'stats_string' => ' Viso renginių : <strong>%d</strong> '
	,'stats_string1' => '<strong>%d</strong> renginiai <strong>%d</strong> puslapyje (-uose)'
);

// ======================================================
// cal_search.php
// ======================================================

$lang_event_search_data = array(
	'section_title' => 'Ieškoti kalendoriuje',
	'search_results' => 'Paieškos rezultatai',
	'category_label' => 'Kategorija',
	'date_label' => 'Data',
	'no_events' => 'Šioje kategorijoje nėra įvykių.',
	'search_caption' => 'Raktiniai žodiai....',
	'search_again' => 'Ieškoti dar kartą',
	'search_button' => 'Ieškoti',
// Misc.
	'no_results' => 'Nieko nerasta',	
// Stats
	'stats_string1' => 'Rasta renginių: <strong>%d</strong> ',
	'stats_string2' => 'Viso renginių <strong>%d</strong> <strong>%d</strong> puslapyje (iuose)'
);

// ======================================================
// profile.php
// ======================================================

if (defined('PROFILE_PHP')) 

$lang_user_profile_data = array(
	'section_title' => 'Asmeninė informacija',
	'edit_profile' => 'Keisti mano informaciją ',
	'update_profile' => 'Papildyti mano informaciją',
	'actions_label' => 'Veiksmai',
// Account Info
	'account_info_label' => 'Vartotojo aprašo informacija',
	'user_name' => 'Vartotojo vardas',
	'user_pass' => 'Slaptažodis',
	'user_pass_confirm' => 'Patvirtinti slaptažodį',
	'user_email' => 'El. pašto adresas',
	'group_label' => 'Vartotojų grupė',
// Other Details
	'other_details_label' => 'Kiti duomenys',
	'first_name' => 'Vardas',
	'last_name' => 'Pavardė',
	'full_name' => 'Full Name',
	'user_website' => 'www',
	'user_location' => 'Miestas',
	'user_occupation' => 'Profesija',
// Misc.
	'select_language' => 'Pasirinkite kalbą',
	'edit_profile_success' => 'Aprašas atnaujintas',
	'update_pass_info' => ' Slaptažodžio laukelį palikite tuščią, jei slaptažodžio keisti nenorite',
// Error messages
	'invalid_password' => 'Įveskite 4-16 simbolių ilgio slaptažodį, sudarytą iš raidžių ir (arba) skaičių!',
	'password_is_username' => 'Slaptažodis ir vartotojo vardas neturi sutapti!',
	'password_not_match' => 'Suklydote rašydami slaptažodį laukelyje  \'patvirtinti slaptažodį\' ',
	'invalid_email' => 'Įveskite teisingą el.pašto adresą!',
	'email_exists' => 'Su šiuo el.pašto adresu  jau yra įregistruotas vartotojas. Pasirinkite kitą el. pašto adresą!',
	'no_email' => 'Įveskite el. pašto adresą!',
	'invalid_email' => 'Įveskite teisingą el.pašto adresą !',
	'no_password' => 'Jūs nesuteikėte slaptažodžio šiam vartotojo aprašui!'
);

// ======================================================
// register.php
// ======================================================

if (defined('USER_REGISTRATION_PHP')) 

$lang_user_registration_data = array(
	'section_title' => 'VArtotojo registracija',
// Step 1: Terms & Conditions
	'terms_caption' => 'Terminai ir sąlygos',
	'terms_intro' => 'Norėdami tęsti, Jūs turėtumėte sutikti su:',
	'terms_message' => 'Prašome peržiūrėti žemiau pateiktas taisykles. Jei jūs sutinkate su taisyklėmis ir norite tęsti registracijos procedūra, paspauskite žemiau esantį "I agree" mygtuką. Jei nusprendėte nutrakti registracijos procedūrą, paspauskite jūsų interneto naršyklės mygtuką \'back\'.<br /><br />Please remember that we are not responsible for any events posted by users of this calendar application. We do not vouch for or warrant the accuracy, completeness or usefulness of any posted event, and are not responsible for the contents of any event.<br /><br />The messages express the views of the author of the event, not necessarily the views of this calendar application. Any user who feels that a posted event is objectionable is encouraged to contact us immediately by email. We have the ability to remove objectionable content and we will make every effort to do so, within a reasonable time frame, if we determine that removal is necessary.<br /><br />You agree, through your use of this service, that you will not use this calendar application to post any material which is knowingly false and/or defamatory, inaccurate, abusive, vulgar, hateful, harassing, obscene, profane, sexually oriented, threatening, invasive of a person\'s privacy, or otherwise violative of any law.<br /><br />You agree not to post any copyrighted material unless the copyright is owned by you or by %s.',
	'terms_button' => 'Sutinku',
	
// Account Info
	'account_info_label' => 'Vartotojo aprašo informacija',
	'user_name' => 'Vartotojo vardas',
	'user_pass' => 'Slaptažodis',
	'user_pass_confirm' => 'Slaptažodžio patvirtinimas',
	'user_email' => 'El. pašto adresas',
// Other Details
	'other_details_label' => 'Kiti duomenys',
	'first_name' => 'Vardas',
	'last_name' => 'pavardė',
	'user_website' => 'www',
	'user_location' => 'Miestas',
	'user_occupation' => 'Profesija',
	'register_button' => 'Patvirtinti registraciją',

// Stats
	'stats_string1' => '<strong>%d</strong> vartotojai',
	'stats_string2' => '<strong>%d</strong> vartotojai <strong>%d</strong> puslapyje',
// Misc.
	'reg_nomail_success' => 'Dėkojame!',
	'reg_mail_success' => 'Jūsų nurodytu elektroninio pašto adresu išsiuntėme laišką su Jūsų sukurto vartotojo aprašo patvirtinimo nuoroda.',
	'reg_activation_success' => 'Sveikiname! Jūsų vartotojo aprašas aktyvuotas ir jūs galite prisijungti naudodamis registracijos metu pasirinktus vartotojo vardą ir slaptažodį.',
// Mail messages
	'reg_confirm_subject' => 'Registracija %s',
	
// Error messages
	'no_username' => 'Įveskite vartotojo vardą !',
	'invalid_username' => 'Įveskite vartotojo vardą, kurio ilgis nuo 4 iki 30 simbolių! Sudarant vartotojo vardą galima naudoti tik raides ir skaičius.',
	'username_exists' => 'Toks vardas jau yra! Pasirinkite kitą vartotojo vardą.',
	'no_password' => 'Įveskite slaptažodį !',
	'invalid_password' => 'Įveskite slaptažodį, kurio ilgis nuo 4 iki 16 simbolių. Sudarant slaptažodį galima naudoti tik raides ir skaičius. !',
	'password_is_username' => 'Vartotojo vardas ir slaptažodis neturi sutapti!',
	'password_not_match' =>'Suklydote rašydami slaptažodį laukelyje  \'Patvirtinti slaptažodį\'',
	'no_email' => 'Įrašykite el. pašto adresą!',
	'invalid_email' => 'Įrašykite teisingą el. pašto adresą!!',
	'email_exists' => 'Jau yra registruotas vartotojas su šiuo el. pašto adresu. Pasirinkte kitą el. pašto adresą!',
	'delete_user_failed' => 'Šio vartotojo aprašo ištrinti negalima!',
	'no_users' => 'Vartotojų aprašų nėra!',
	'already_logged' => 'Jūs jau esate prisijungęs!',
	'registration_not_allowed' => 'Vartotojų registravimo funkcija laikinai išjungta!',
	'reg_email_failed' => 'Įvyko klaida išsiunčiant el. laišką su aktyvavimo nuoroda!',
	'reg_activation_failed' => 'Įvyko klaida bandant aktyvuoti vartotojo registraciją!'

);
// Message body for email activation
$lang_user_registration_data['reg_confirm_body'] = <<<EOT
Pranešimas apie registraciją {CALENDAR_NAME} sistemoje

Jūsų vartotojo vardas : "{USERNAME}"
Slaptažodis: "{PASSWORD}"

Norėdami aktyvuoti jūsų vartotojo aprašą, turite paspausti žemiau esančią nuorodą
arba nukopijuoti ją į jūsų interneto naršyklės adreso laukelį.


{REG_LINK}

Pagarbiai,

{CALENDAR_NAME} administracija

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
	'section_title' => 'Renginių administrtavimas',
	'events_to_approve' => 'Renginių administravimas: Renginiai, kuriuos reikia patvirtinti',
	'upcoming_events' => 'Renginių administravimas: Artėjantys renginiai',
	'past_events' => 'Renginių administravimas: Įvykę renginiai',
	'add_event' => 'Įtraukti naują renginį',
	'edit_event' => 'Redaguoti renginio aprašymą',
	'view_event' => 'Peržiųrėti renginio aprašymą',
	'approve_event' => 'patvirtinti renginį',
	'update_event' => 'Atnaujinti renginio informaciją',
	'delete_event' => 'Ištrinti renginį',
	'events_label' => 'Renginiai',
	'auto_approve' => 'Automatinis patvirtinimas',
	'date_label' => 'Data',
	'actions_label' => 'Įvykiai',
	'events_filter_label' => 'Filtruoti renginius',
	'events_filter_options' => array('Rodyti visus renginius','Rodyti tik nepatvirtintus renginius','Rodyti artėjančius renginius','Rodyti tik įvykusius renginius'),
	'picture_attached' => 'Paveikslėlis prisegtas',
// View Event
	'view_event_name' => 'Renginys: \'%s\'',
	'event_start_date' => 'Data',
	'event_end_date' => 'Iki',
	'event_duration' => 'Trukmė',
	'contact_info' => 'Kontaktinė informacija',
	'contact_email' => 'El. pašto adresas',
	'contact_url' => 'www',
// General Info
// Event form
	'edit_event_title' => 'Renginys: \'%s\'',
	'cat_name' => 'Kategorija',
	'event_start_date' => 'Data',
	'event_end_date' => 'Iki',
	'contact_info' => 'Kontaktinė informacija',
	'contact_email' => 'El. pašto adresas',
	'contact_url' => 'www',
	'no_event' => 'Renginių nėra',
	'stats_string' => 'Viso <strong>%d</strong> renginiai (-ių)',
// Stats
	'stats_string1' => '<strong>%d</strong> renginiai (-ių)',
	'stats_string2' => 'Viso: <strong>%d</strong> renginiai (-ių) <strong>%d</strong> puslapyje (-iuose)',
// Misc.
	'add_event_success' => 'Renginys įtrauktas',
	'edit_event_success' => 'Renginys atnaujintas',
	'approve_event_success' => 'Renginys patvirtintas',
	'delete_confirm' => 'Ar tikrai norite ištrinti šį renginį?',
	'delete_event_success' => 'Renginys ištrintas',
	'active_label' => 'Aktyvus',
	'not_active_label' => 'Neaktyvus',
// Error messages
	'no_event_name' => 'Suteikite renginiui pavadinimą !',
	'no_event_desc' => 'Sukurkite renginio aprašymą!',
	'no_cat' => 'Pasirinkite renginio kategoriją!',
	'no_day' => 'Nurodykite dieną!',
	'no_month' => 'Nurodykite mėnesį !',
	'no_year' => 'Nurodykite metus !',
	'non_valid_date' => 'Nurodykite teisingą datą !',
	'end_days_invalid' => 'Įsitikinkite, kad  nurodydami trukmę, laukelyje \'Dienos\'  įvedėte tik skaičius!',
	'end_hours_invalid' => 'Įsitikinkite, kad nurodydami trukmę laukelyje, \'Valandos\'  įvedėte tik skaičius!',
	'end_minutes_invalid' => 'Įsitikinkite, kad nurodydami trukmę laukelyje, \'Minutės\'  įvedėte tik skaičius!',
	'delete_event_failed' => 'Negalima ištrinti šio renginio',
	'approve_event_failed' => 'Negalima patvirtinti šio renginio',
	'no_events' => 'Renginių nėra!',
	'recur_val_1_invalid' => 'Reikšmė nurodyta \'Pasikartojimo intervalas\' neteisinga. Reikšmė turi būti didesnė už \'0\' !',
	'recur_end_count_invalid' => 'Reikšmė nurodyta  \'Pasikartojimų skaičius\' neteisinga. Reikšmė turi būti didesnė už \'0\' !',
	'recur_end_until_invalid' => ' \'Kartoti iki\' data turi būti vėlesnė už renginio pradžios datą !'

);

// ======================================================
// admin_categories.php
// ======================================================

if (defined('ADMIN_CATS_PHP')) 

$lang_cat_admin_data = array(
	'section_title' => 'Kategorijų administravimas',
	'add_cat' => 'Sukurti naują kategoriją',
	'edit_cat' => 'Redaguoti kategoriją',
	'update_cat' => 'Antnaujinti informaciją apie kategoriją',
	'delete_cat' => 'Ištrinti kategoriją',
	'events_label' => 'Renginiai',
	'visibility' => 'Kategorijos rodymas',
	'actions_label' => 'Veiksmai',
	'users_label' => 'Vartotojai',
	'admins_label' => 'Administratoriai',
// General Info
	'general_info_label' => 'Pagrindinė informacija',
	'cat_name' => 'Kategorijos pavadinimas',
	'cat_desc' => 'Kategorijos aprašymas',
	'cat_color' => 'Spalva',
	'pick_color' => 'Pasirinkite spalvą!',
	'status_label' => 'Būklė',
// Stats
	'stats_string1' => '<strong>%d</strong> kategorijos',
	'stats_string2' => 'Aktualu: <strong>%d</strong>&nbsp;&nbsp;&nbsp;Viso: <strong>%d</strong>&nbsp;&nbsp;&nbsp; <strong>%d</strong> puslapyje(-iuose)',
// Misc.
	'add_cat_success' => 'Kategorija sukurta',
	'edit_cat_success' => 'Informacija apie kategoriją atnaujinta',
	'delete_confirm' => 'Ar tikrai norite ištrinti šią kategoriją?',
	'delete_cat_success' => 'Kategorija ištrinta',
	'active_label' => 'Aktyvus',
	'not_active_label' => 'Neaktyvus',
// Error messages
	'no_cat_name' => 'Suteikite kategirijai pavadinimą!',
	'no_cat_desc' => 'Sukurkite kategorijos aprašymą!',
	'no_color' => 'Parinkie kategorijai spalvą!',
	'delete_cat_failed' => 'Negalima ištrinti šios kategorijos',
	'no_cats' => 'Kategorijų nėra!',
	'cat_has_events' => 'Šioje kategorijoje yra %d renginys (-iai), todėl kategorijos ištrinti negalima!<br>Pirmiau ištrinkite šios kategorijos renginius!'

);
// ======================================================
// admin_users.php
// ======================================================

if (defined('ADMIN_USERS_PHP')) 

$lang_user_admin_data = array(
	'section_title' => 'Vartotojų administravimas',
	'add_user' => 'Sukurti naują vartotoją',
	'edit_user' => 'Redaguoti informaciją apie vartotoją',
	'update_user' => 'Atnaujinti informaciją apie vartotoją',
	'delete_user' => 'Ištrinti vartotojo aprašą',
	'last_access' => 'Paskutinį kartą  buvo prisijungęs',
	'actions_label' => 'Veiksmai',
	'active_label' => 'Aktyvus',
	'not_active_label' => 'Neaktyvus',
// Account Info
	'account_info_label' => 'Vartotojo aprašas',
	'user_name' => 'Vartotojo vardas',
	'user_pass' => 'Slaptažodis ',
	'user_pass_confirm' => 'Patvirtinti slaptažodį',
	'user_email' => 'El. pašto adresas',
	'group_label' => 'Vartotojų grupė',
	'status_label' => 'Aprašo būklė',
// Other Details
	'other_details_label' => 'Kita informacija',
	'first_name' => 'Vardas',
	'last_name' => 'Pavardė',
	'user_website' => 'www',
	'user_location' => 'Miestas',
	'user_occupation' => 'Profesija',
// Stats
	'stats_string1' => '<strong>%d</strong> vartotojai (-ų)',
	'stats_string2' => '<strong>%d</strong> vartotojai (-ų) <strong>%d</strong> puslapyje (-iuose)',
// Misc.
	'select_group' => 'Pasirinkti iš sąrašo',
	'add_user_success' => 'Vartotojo aprašas sukurtas',
	'edit_user_success' => 'Vartotojo aprašas atnaujintas',
	'delete_confirm' => 'Ar tikrai norite ištrinti ši vartotojo aprašą?',
	'delete_user_success' => 'Vartotojo aprašas ištrintas',
	'update_pass_info' => 'Jei slaptažodžio keisti nenorite, slaptažodžio laukelį palikite tuščią',
	'access_never' => 'Niekada',
// Error messages
	'no_username' => 'Įrašykite vartototojo vardą!',
	'invalid_username' => 'Įveskite vartotojo vardą, kurio ilgis nuo 4 iki 30 simbolių! Sudarant vartotojo vardą galima naudoti tik raides ir skaičius.',
	'invalid_password' => 'Įveskite slaptažodį, kurio ilgis nuo 4 iki 16 simbolių. Sudarant slaptažodį galima naudoti tik raides ir skaičius. !',
	'password_is_username' => 'Vartotojo vardas ir slaptažodis negali būti tokie patys!',
	'password_not_match' =>'Suklydote rašydami slaptažodį laukelyje  \'patvirtinti slaptažodį\'',
	'invalid_email' => 'Įveskite teisingą el. pašto adresą !',
	'email_exists' => 'Jau yra registruotas vartotojas su šiuo el. pašto adresu. Pasirinkte kitą el. pašto adresą!',
	'username_exists' => 'Toks vartotjo vardas jau yra! pasirinkite kitą vartotojo vardą',
	'no_email' => 'Įveskite el. pašto adresą!',
	'invalid_email' => 'Įveskite teisingą el. pašto adresą !',
	'no_password' => 'Būtin įvesti slaptažodį !',
	'no_group' => 'Vartotojo aprašą priskirkite vartotojų grupei!',
	'delete_user_failed' => 'Negalima ištrinti šio vartotojo aprašo',
	'no_users' => 'Vartotojų nėra!'

);

// ======================================================
// admin_groups.php
// ======================================================

if (defined('ADMIN_GROUPS_PHP')) 

$lang_group_admin_data = array(
	'section_title' => 'Vartotojų grupės administravimas',
	'add_group' => 'Sukurti naują grupę',
	'edit_group' => 'Redaguoti grrupę',
	'update_group' => 'Atnaujinti informaciją apie grupę',
	'delete_group' => 'Ištrinti grupę',
	'view_group' => 'Grupės peržiūra',
	'users_label' => 'Nariai',
	'actions_label' => 'Įvykiai',
// General Info
	'general_info_label' => 'Pagrindinė informacija',
	'group_name' => 'grupės pavadinimas',
	'group_desc' => 'Grupės aprašymas',
// Group Access Level
	'access_level_label' => 'Vartotojų grupės teisės',
	'Administrator' => 'Šios grupės nariai turi administratoriaus teises',
	'can_manage_accounts' => 'Šios grupės nariai gali administruoti vartotojų aprašus',
	'can_change_settings' => 'Šios grupės nariai gali keisti kalendoriais nustatymus',
	'can_manage_cats' => 'Šios grupės nariai gali administruoti kategorijas',
	'upl_need_approval' => 'Įvestus renginius turi patvirtinti administracija',
// Stats
	'stats_string1' => '<strong>%d</strong> ggrupės (-0ių)',
	'stats_string2' => 'Viso: <strong>%d</strong> grupės <strong>%d</strong> puslapyje (-iuose)',
	'stats_string3' => 'Viso: <strong>%d</strong> vartotojai (-ų) <strong>%d</strong> puslapyje (-iuose)',
// View Group Members
	'group_members_string' => '\'%s\' groupės nariai',
	'username_label' => 'Vartotojo vardas',
	'firstname_label' => 'vardas',
	'lastname_label' => 'Pavardė',
	'email_label' => 'El. pašto adresas',
	'last_access_label' => 'Paskutinį kartą prisijungė',
	'edit_user' => 'Redaguoti vartotojo aprašą',
	'delete_user' => 'Ištrinti vartotojo aprašą',
// Misc.
	'add_group_success' => 'Sukurta nauja grupė',
	'edit_group_success' => 'Atnaujinta informacija apie grupę',
	'delete_confirm' => 'Ar tikrai norite ištrinti šią grupę?',
	'delete_user_confirm' => 'Ar tikrai norite ištrinti šią grupę?',
	'delete_group_success' => 'Grupė ištrinta',
	'no_users_string' => ':Šioje grupėje narių nėra',
// Error messages
	'no_group_name' => 'Sukurkite grupės pavadinimą!',
	'no_group_desc' => 'Sukurkite grupės aprašymą!',
	'delete_group_failed' => 'Negalima ištrinti šios grupės',
	'no_groups' => 'Grupių nėra!',
	'group_has_users' => 'Šioje grupėje yra %d vartotojai (-ų), todėl grupės ištrinti negalima!<br>Atsiekite vartotojus nuo šios grupės ir pabandykite dar kartą!'

);

// ======================================================
// admin_settings.php / admin_settings_template.php / 
// admin_settings_updates.php
// ======================================================

$lang_settings_data = array(
	'section_title' => 'Kalendoriaus nustatymai'
// Links
	,'admin_links_text' => 'Pasirinkite skyrių'
	,'admin_links' => array('Pagrindiniai nustatymai','Šablono nustatymai','Produkto atnaujinimai')
// General Settings
	,'general_settings_label' => 'Pagrindiniai nustatymai'
	,'calendar_name' => 'Kalendoriaus pavadinimas'
	,'calendar_description' => 'kalendoriaus aprašymas'
	,'calendar_admin_email' => 'Kalendoriaus administratoriaus el. pašto adresas'
	,'cookie_name' => 'Name of the cookie used by the script'
	,'cookie_path' => 'Path of the cookie used by the script'
	,'debug_mode' => ' Įjungti klaidų tikrinimo režimą'
	,'calendar_status' => 'Kalendoriaus  vaizdavimas'
// Environment Settings
	,'env_settings_label' => 'Aplinka'
	,'lang' => 'Kalba'
		,'lang_name' => 'Kalba'
		,'lang_native_name' => 'Native name'
		,'lang_trans_date' => 'Vertimo data'
		,'lang_author_name' => 'Autorius'
		,'lang_author_email' => 'Autoriaus el. pašto adresas'
		,'lang_author_url' => 'www'
	,'charset' => 'Koduotė'
	,'theme' => 'Tema'
		,'theme_name' => 'Temos pavadinimas'
		,'theme_date_made' => 'Temos sukūrimo data'
		,'theme_author_name' => 'Autorius'
		,'theme_author_email' => 'Autoriaus el. pašto adresas'
		,'theme_author_url' => 'www'
	,'timezone' => 'Laiko zona'
	,'time_format' => 'Laiko vaizdavimo formatas'
		,'24hours' => '24 valandos'
		,'12hours' => '12 valandų'
	,'auto_daylight_saving' => 'Automatically adjust for daylight saving (DST)'
	,'main_table_width' => 'Pagrindinės lentelės plotis(taškais arba %)'
	,'day_start' => 'Savaitės pradžios diena'
	,'default_view' => 'Standartinis vaizdas'
	,'search_view' => 'Įjungti paiešką'
	,'archive' => 'Rodyti įvykusius renginius'
	,'events_per_page' => 'Renginiai esantys puslapyje'
	,'sort_order' => 'Standartinis rūšiavimas'
		,'sort_order_title_a' => 'Pagal pavadinimą didėjančia tvarka'
		,'sort_order_title_d' => 'Pagal pavadinimą mažėjančia tvarka'
		,'sort_order_date_a' => 'Pagal datą didėjančia tvarka'
		,'sort_order_date_d' => 'Pagal datą mažėjančia tvarka'
	,'show_recurrent_events' => 'Rodyti pasikartojančius renginius'
	,'multi_day_events' => 'Renginiai trunkantys ilgiau nei 1 dieną'
		,'multi_day_events_all' => 'Rodyti visą laikotarpį'
		,'multi_day_events_bounds' => 'Rodyti tik pradžios ir pabaigos datas'
		,'multi_day_events_start' => 'Rodyti tik pradžios datą'
	// User Settings
	,'user_settings_label' => 'Vartotojų nustatymai'
	,'allow_user_registration' => 'Vartotojams leidžiama registruotis'
	,'reg_duplicate_emails' => 'Neprivalomas unikalus el. pašto adresas'
	,'reg_email_verify' => 'Įjungti aprašoaktyvavimo elektroniniu paštu  galimybę'
// Event View
	,'event_view_label' => 'Renginio vaizdas'
	,'popup_event_mode' => 'Iššokantis pranešimo apie renginį langas'
	,'popup_event_width' => 'Iššokančio pranešimo lango plotis'
	,'popup_event_height' => 'Iššokančio pranešimo lango aukštis'
// Add Event View
	,'add_event_view_label' => 'Įtraukti renginį'
	,'add_event_view' => 'Įjungta'
	,'addevent_allow_html' => 'Įjungti <b>HTML</b> kodą aprašyme'
	,'addevent_allow_contact' => 'Leisti nurodyti kontaktiniuis duomenis'
	,'addevent_allow_email' => 'Leisti nurodyti el. pašto adresą'
	,'addevent_allow_url' => 'Leisti nurodyti www adresą'
	,'addevent_allow_picture' => 'Leisti prisegti paveikslėlius'
	,'new_post_notification' => 'Apie renginio patvirtinimo reikalingumą pranešti el. paštu'
// Calendar View
	,'calendar_view_label' => 'Mėnesio vaizdas'
	,'monthly_view' => 'Įjungta'
	,'cal_view_show_week' => 'Rodyti savaitės numerį'
	,'cal_view_max_chars' => 'Maksimalus simbolių skaičius aprašyme'
// Flyer View
	,'flyer_view_label' => 'Skrajutės vaizdas'
	,'flyer_view' => 'Įjungta'
	,'flyer_show_picture' => 'Rodyti paveikslėlius skrajutėje'
	,'flyer_view_max_chars' => 'Maksimalus simbolių skaičius aprašyme'
// Weekly View
	,'weekly_view_label' => 'savaitės vaizdas'
	,'weekly_view' => 'Įjungta'
	,'weekly_view_max_chars' => 'Maksimalus simbolių skaičius aprašyme'
// Daily View
	,'daily_view_label' => 'Dienos vaizdas'
	,'daily_view' => 'Įjungta'
	,'daily_view_max_chars' => 'Maksimalus simbolių skaičius aprašyme'
// Categories View
	,'categories_view_label' => 'Kategorijos vaizdas'
	,'cats_view' => 'Įjungta'
	,'cats_view_max_chars' => 'Maksimalus simbolių skaičius aprašyme'
// Mini Calendar
	,'mini_cal_label' => 'Mini kalendarius'
	,'mini_cal_def_picture' => 'Standartinis paveikslėlis'
	,'mini_cal_display_picture' => 'Rodyti paveikslėlį'
	,'mini_cal_diplay_options' => array('Nerodyti','Standartinis paveikslėlis', 'Dienos paveikslėlis','Savaitės paveikslėlis','Atsitiktinis paveikslėlis')
// Mail Settings
	,'mail_settings_label' => 'El. pašto nustatymai'
	,'mail_method' => 'El. pašto siuntimo metodas'
	,'mail_smtp_host' => 'SMTP Hosts (separated by a semicolon ;)'
	,'mail_smtp_auth' => ' SMTP Authentication'
	,'mail_smtp_username' => 'SMTP Username'
	,'mail_smtp_password' => 'SMTP Password'

// Form Buttons
	,'update_config' => 'Išsaugoti pakeitimus'
	,'restore_config' => 'Atkurti pradinius nustatymus'
// Misc.
	,'update_settings_success' => 'Pakeitimai išsaugoti'
	,'restore_default_confirm' => 'Ar tikrai norite atkurti pradinius nustatymus?'
// Template Configuration
	,'template_type' => 'Šablono tipas'
	,'template_header' => 'Antraštės nustatymai'
	,'template_footer' => 'Apatinės eilutės nustatymai'
	,'template_status_default' => 'Naudoti standartinį temos šabloną'
	,'template_status_custom' => 'Naudoti šį šabloną:'
	,'template_custom' => 'Sukurti šabloną'

	,'info_meta' => 'Meta informacija'
	,'info_status' => 'Būklės kontrolė'
	,'info_status_default' => 'Nerodyti šio turinio'
	,'info_status_custom' => 'Roditi šį turinį:'
	,'info_custom' => 'Sukurti turinį'

	,'dynamic_tags' => 'Besikeičiančios žymos'

// Product Updates
	,'updates_check_text' => 'Prašome palaukti. Informacija ruošiama...'
	,'updates_no_response' => 'Nėra ryšio su serveriu. Pabandykite vėliau.'
	,'avail_updates' => 'Jau yra programos atnaujinimų'
	,'updates_download_zip' => 'Parsisiųsti suarchyvuotą bylą (.zip)'
	,'updates_download_tgz' => 'Parsisiųsti suarchyvuotą bylą (.tar.gz)'
	,'updates_released_label' => 'Išleidimo data: %s'
	,'updates_no_update' => 'Jūs naudojate pačią naujausią programos versiją.'
);

// ======================================================
// cal_mini.inc.php
// ======================================================

$lang_mini_cal = array(
	'def_pic' => 'Standartinis paveikslėlis'
	,'daily_pic' => 'Dienos paveikslėlis (%s)'
	,'weekly_pic' => 'Savaitės paveikslėlis (%s)'
	,'rand_pic' => 'Atsitiktinis paveikslėlis (%s)'
	,'post_event' => 'Paskelbti naują renginį'
	,'num_events' => '%d įvykis (-iai, -ių)'
	,'selected_week' => '%d savaitė'
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
	'section_title' => 'Login Screen'
// General Settings
	,'login_intro' => 'Įveskite vartotojo vardąir slaptažodį'
	,'username' => 'Vartotojo vardas'
	,'password' => 'Slaptažodis'
	,'remember_me' => 'Prisiminti mane'
	,'login_button' => 'Prisijunti'
// Errors
	,'invalid_login' => 'Patikrinkite prisijungimo informaciją ir bandykite dar kartą!'
	,'no_username' => 'Įveskite vartotojo vardą!'
	,'already_logged' => 'Jūs jau esate prisijungęs !'
);

// ======================================================
// logout.php
// ======================================================

// To Be Done


// ======================================================
// plugins.php
// ======================================================

// To Be Done




// New defined constants, used to make a start with new language system


DEFINE('_EXTCAL_THEMES_INSTALL_HEADING', 'JCal Pro temų valdymo įrankis');

//Common
DEFINE('_EXTCAL_VERSION', 'Versija');
DEFINE('_EXTCAL_DATE', 'Data');
DEFINE('_EXTCAL_AUTHOR', 'Autorius');
DEFINE('_EXTCAL_AUTHOR_EMAIL', 'Autoriaus E. pašto adresas');
DEFINE('_EXTCAL_AUTHOR_URL', 'Autoriaus www');
DEFINE('_EXTCAL_PUBLISHED', 'Paskelbta');

//Plugins
DEFINE('_EXTCAL_THEME_PLUGIN', 'Tema');
DEFINE('_EXTCAL_THEME_PLUGCOM', 'Tema/Komanda');
DEFINE('_EXTCAL_THEME_NAME', 'Pavadinimas');
DEFINE('_EXTCAL_THEME_HEADING', 'JCal Pro temų valdymo įrankis');
DEFINE('_EXTCAL_THEME_FILTER', 'Filtruoti');
DEFINE('_EXTCAL_THEME_ACCESS_LIST', 'Teisių sąrašas');
DEFINE('_EXTCAL_THEME_ACCESS_LVL', 'Teisių lygis');
DEFINE('_EXTCAL_THEME_CORE', 'Branduolys');
DEFINE('_EXTCAL_THEME_DEFAULT', 'Standartinis');
DEFINE('_EXTCAL_THEME_ORDER', 'Rikiavimas');
DEFINE('_EXTCAL_THEME_ROW', 'Eilutė');
DEFINE('_EXTCAL_THEME_TYPE', 'Tipas');
DEFINE('_EXTCAL_THEME_ICON', 'Piktograma');
DEFINE('_EXTCAL_THEME_LAYOUT_ICON', 'Išdėstymo piktograma');
DEFINE('_EXTCAL_THEME_DESC', 'Aprašymas');
DEFINE('_EXTCAL_THEME_EDIT', 'Redaguoti');
DEFINE('_EXTCAL_THEME_NEW', 'Nauja');
DEFINE('_EXTCAL_THEME_DETAILS', 'Įskiepio elementai');
DEFINE('_EXTCAL_THEME_PARAMS', 'Parametrai');
DEFINE('_EXTCAL_THEME_ELMS', 'Elementai');
//Plugin Installer
DEFINE('_EXTCAL_THEMES_INSTALL_HEADING','Įdiegti naujas temas');
DEFINE('_EXTCAL_THEMES_INSTALL_MSG', 'Rodomos tik tos temos, kurias galima pašalinti- pagrindinės temos šalinti negalima');
DEFINE('_EXTCAL_THEME_NONE', 'Papildomų temų neįdiegta');

//Language Manager
DEFINE('_EXTCAL_LANG_HEADING', 'EXTCAL kalbos valdymo įrankis');
DEFINE('_EXTCAL_LANG_LANG', 'Kalba');

//Language Installer
DEFINE('_EXTCAL_LANG_HEADING_INSTALL', 'Įdiegti naują EXTCAL kalbą');
DEFINE('_EXTCAL_LANG_BACK', 'Atgal į kalbos valdymo įrankio aplinką');
//

//Global Installer
DEFINE('_EXTCAL_INS_PACKAGE_UPLOAD', 'Įkelti archyvo bylą');
DEFINE('_EXTCAL_INS_PACKAGE_FILE', 'Archyvo byla');
DEFINE('_EXTCAL_INS_INSTALL', 'Įdiegti iš katalogo');
DEFINE('_EXTCAL_INS_INSTALL_DIR', 'Diegimo katalogas');
DEFINE('_EXTCAL_INS_UPLOAD_BUTTON', 'Įkelti bylą &amp; Idiegti');
DEFINE('_EXTCAL_INS_INSTALL_BUTTON', 'Įdiegti');
?>