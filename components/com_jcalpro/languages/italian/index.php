<?php
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

Revision date: 02/24/2007

**********************************************
Get the latest version of JCal Pro at:
http://dev.anything-digital.com//
**********************************************
*/

/** ensure this file is being included by a parent file */
defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );

// New language structure
$lang_info = array (
	'name' => 'Italian'
	,'nativename' => 'Italiano' // Language name in native language. E.g: 'Français' for 'French'
	,'locale' => array('it','Italiano') // Standard locale alternatives for a specific language. For reference, go to: http://www.php.net/manual/en/function.setlocale.php
	,'charset' => 'ISO-8859-1' // For reference, go to : http://www.w3.org/International/O-charset-lang.html
	,'direction' => 'ltr' // 'ltr' for Left to Right. 'rtl' for Right to Left languages such as Arabic.
	,'author' => 'Giuseppe Santoro'
	,'author_email' => 'giuseppesantoro@axelera.it'
	,'author_url' => 'http://www.axelera.it'
	,'transdate' => '02/22/2007'
);

$lang_general = array (
	'yes' => 'Sì'
	,'no' => 'No'
	,'back' => 'Indietro'
	,'continue' => 'Continua'
	,'close' => 'Chiudi'
	,'errors' => 'Errori'
	,'info' => 'Informazioni'
	,'day' => 'Giorno'
	,'days' => 'Giorni'
	,'month' => 'Mese'
	,'months' => 'Mesi'
	,'year' => 'Anno'
	,'years' => 'Anni'
	,'hour' => 'Ora'
	,'hours' => 'Ore'
	,'minute' => 'Minuto'
	,'minutes' => 'Minuti'
	,'everyday' => 'Ogni giorno'
	,'everymonth' => 'Ogni mese'
	,'everyyear' => 'Ogni anno'
	,'active' => 'Attivo'
	,'not_active' => 'Non attivo'
	,'today' => 'Oggi'
	,'signature' => 'Basato su %s'
	,'expand' => 'Espandi'
	,'collapse' => 'Restringi'
);

// Date formats, For reference, go to : http://www.php.net/manual/en/function.strftime.php
$lang_date_format = array (
	'full_date' => '%A, %d %B, %Y' // e.g. Wednesday, June 05, 2002
	,'full_date_time_24hour' => '%A, %d %B, %Y ore %H:%M' // e.g. Wednesday, June 05, 2002 At 21:05
	,'full_date_time_12hour' => '%A, %d %B, %Y ore %I:%M %p' // e.g. Wednesday, June 05, 2002 At 9:05 pm
	,'day_month_year' => '%d-%b-%Y' // e.g 10-Sep-2004
	,'local_date' => '%c' // Preferred date and time representation for current language
	,'mini_date' => '%a. %d %b, %Y'
	,'month_year' => '%B %Y'
	,'day_of_week' => array('Domenica','Lunedì','Martedì','Mercoledì','Giovedì','Venerdì','Sabato')
	,'months' => array('Gennaio','Febbraio','Marzo','Aprile','Maggio','Giugno','Luglio','Agosto','Settembre','Ottobre','Novembre','Dicembre')
);

$lang_system = array (
	'system_caption' => 'Messaggio di sistema'
  ,'page_access_denied' => 'Non hai privilegi sufficienti per accedere a questa pagina.'
  ,'page_requires_login' => 'Devi avere effettuato il LOGIN per accedere a questa pagina.'
  ,'operation_denied' => 'Non hai privilegi sufficienti per effettuare questa operazione.'
	,'section_disabled' => 'Questa sezione è attualmente disattivata !'
  ,'non_exist_cat' => 'La categoria selezionata non esiste !'
  ,'non_exist_event' => 'L\'evento selezionato non esiste !'
  ,'param_missing' => 'I parametri forniti non sono corretti.'
  ,'no_events' => 'Nessun evento da mostrare'
  ,'config_string' => 'Stai usando \'%s\' running on %s, %s and %s.'
  ,'no_table' => 'La tabella\'%s\' non esiste !'
  ,'no_anonymous_group' => 'La tabella %s non contiene il gruppo \'Anonimo\' !'
  ,'calendar_locked' => 'Questo servizio è temporaneamente sospeso per lavori di manutenzione e aggiornamento. Ci scusiamo per il disagio arrecato !'
	,'new_upgrade' => 'Il sistema ha rilevato la presenza di una versione più aggiornata che è consigliato installare subito. Clicca su "Continua" per effettuare ora l\'aggiornamento.'
	,'no_profile' => 'Si è verificato un errore nel recuperare le informazioni dal tuo profilo'
	,'unknown_component' => 'Componente sconosciuto'
// Mail messages
	,'new_event_subject' => 'Questo evento deve essere approvato a %s'
	,'event_notification_failed' => 'Errore nell\'invio dell\'e-mail di notifica !'
);

// Message body for new event email notification
$lang_system['event_notification_body'] = <<<EOT
L'evento che segue è appena stato inviato al tuo {CALENDAR_NAME}
e ne è richiesta l'approvazione:

Titolo: "{TITLE}"
Data: "{DATE}"
Durata: "{DURATION}"

Puoi accedere a questo evento cliccando sul link qui sotto,
o puoi copiarlo e incollarlo nel tuo browser.

{LINK}

(Ricorda che devi avere effettuato il login come Amministratore
affinchè il link funzioni.)

Saluti,

Il gestore di {CALENDAR_NAME}

EOT;

// Admin menu entries
$lang_admin_menu = array (
	'login' => 'Login'
	,'register' => 'Registrati'
  ,'logout' => 'Logout <span style="color:#FF9922">[<span style="color:#606F79">%s</span>]</span>'
  ,'user_profile' => 'Il Mio Profilo'
	,'admin_events' => 'Eventi'
  ,'admin_categories' => 'Categorie'
  ,'admin_groups' => 'Gruppi'
  ,'admin_users' => 'Utenti'
  ,'admin_settings' => 'Impostazioni'
);

// Main menu entries
$lang_main_menu = array (
	'add_event' => 'Aggiungi Evento'
	,'cal_view' => 'Vista Mensile'
  ,'flat_view' => 'Vista Semplice'
  ,'weekly_view' => 'Vista Settimanale'
  ,'daily_view' => 'Vista Giornaliera'
  ,'yearly_view' => 'Vista Annuale'
  ,'categories_view' => 'Categorie'
  ,'search_view' => 'Cerca'
);

// ======================================================
// Aggiungi Evento view
// ======================================================

$lang_add_event_view = array(
	'section_title' => 'Aggiungi Evento'
	,'edit_event' => 'Modifica evento [id%d] \'%s\''
	,'update_event_button' => 'Aggiorna evento'

// Event details
	,'event_details_label' => 'Dettagli Evento'
	,'event_title' => 'Titolo dell\'Evento'
	,'event_desc' => 'Descrizione dell\'Evento'
	,'event_cat' => 'Categoria'
	,'choose_cat' => 'Seleziona una categoria'
	,'event_date' => 'Data dell\'Evento'
	,'day_label' => 'Giorno'
	,'month_label' => 'Mese'
	,'year_label' => 'Anno'
	,'start_date_label' => 'Ora Inizio'
	,'start_time_label' => 'A'
	,'end_date_label' => 'Durata'
	,'all_day_label' => 'Tutto il giorno'
// Contact details
	,'contact_details_label' => 'Dettagli Contatto'
	,'contact_info' => 'Info Contatto'
	,'contact_email' => 'E-mail'
	,'contact_url' => 'URL'
// Repeat events
	,'repeat_event_label' => 'Evento Ripetitivo'
	,'repeat_method_label' => 'Metodo Ripetitivo'
	,'repeat_none' => 'Non ripetere questo Evento'
	,'repeat_every' => 'Ripetere ogni'
	,'repeat_days' => 'Giorno(i)'
	,'repeat_weeks' => 'Settimana(e)'
	,'repeat_months' => 'Mese(i)'
	,'repeat_years' => 'Anno(i)'
	,'repeat_end_date_label' => 'Data di fine ripetizione'
	,'repeat_end_date_none' => 'Nessuna data di fine ripetizione'
	,'repeat_end_date_count' => 'Termina dopo %s evenienza(e)'
	,'repeat_end_date_until' => 'Ripeti fino'
// Other details
	,'other_details_label' => 'Altri Dettagli'
	,'picture_file' => 'File Immagine'
	,'file_upload_info' => '(Limite di %d KBytes - Estensioni valide : %s )'
	,'del_picture' => 'Eliminare questa immagine ?'
// Administrative options
	,'admin_options_label' => 'Opzioni di Amministrazione'
	,'auto_appr_event' => 'Evento Approvato'

// Error messages
	,'no_title' => 'Devi dare un titolo all\'evento !'
	,'no_desc' => 'Devi dare una descrizione a questo evento !'
	,'no_cat' => 'Devi selezionare una categoria dal menù a discesa !'
	,'date_invalid' => 'Devi dare una data valida a questo evento !'
	,'end_days_invalid' => 'Il valore digitato nel campo \'Giorni\' non è valido !'
	,'end_hours_invalid' => 'Il valore digitato nel campo \'Ore\' non è valido !'
	,'end_minutes_invalid' => 'Il valore digitato nel campo \'Minuti\'  non è valido !'
	,'move_image_failed' => 'Il sistema non è riuscito a completare l\'upload dell\'immagine. Verifica che sia del tipo corretto e non troppo grande. In caso contrario segnala il fatto all\'amministratore di sistema.'
	,'non_valid_dimensions' => 'La larghezza o l\'altezza dell\'immagine è superiore a %s pixel !'

	,'recur_val_1_invalid' => 'Il valore immesso per \'intervallo di ripetizione\' non è valido. Questo deve essere un numero maggiore di  \'0\' !'
	,'recur_end_count_invalid' => 'Il valore immesso per \'numero di eventi\' non è valido. Questo deve essere un numero maggiore di  \'0\' !'
	,'recur_end_until_invalid' => 'La data \'ripeti fino al\' deve essere posteriore alla data di inizio !'
// Misc. messages
	,'submit_event_pending' => 'Il tuo evento è stato inviato! Tuttavia NON comparirà nel calendario fino a quando riceverà l\'approvazione dell\'amministratore. Grazie per il tuo contributo !'
	,'submit_event_approved' => 'Il tuo evento è automaticamente approvato. Grazie per il contributo !'
	,'event_repeat_msg' => 'Questo evento è impostato per la ripetizione'
	,'event_no_repeat_msg' => 'Questo evento non avrà ripetizioni'
);

// ======================================================
// daily view
// ======================================================

$lang_daily_event_view = array(
	'section_title' => 'Vista Giornaliera'
	,'next_day' => 'Giorno Successivo'
	,'previous_day' => 'Giorno Precedente'
	,'no_events' => 'Non ci sono eventi in questo giorno.'
);

// ======================================================
// weekly view
// ======================================================

$lang_weekly_event_view = array(
	'section_title' => 'Vista Settimanale'
	,'week_period' => '%s - %s'
	,'next_week' => 'Settimana Successiva'
	,'previous_week' => 'Settimana Precedente'
	,'selected_week' => 'Settimana %d'
	,'no_events' => 'Non ci sono eventi in questa settimana'
);

// ======================================================
// monthly view
// ======================================================

$lang_monthly_event_view = array(
	'section_title' => 'Vista Mensile'
	,'next_month' => 'Mese Successivo'
	,'previous_month' => 'Mese Precedente'
);

// ======================================================
// flat view
// ======================================================

$lang_flat_event_view = array(
	'section_title' => 'Vista Semplice'
	,'week_period' => '%s - %s'
	,'next_month' => 'Mese Successivo'
	,'previous_month' => 'Mese Precedente'
	,'contact_info' => 'Info Contatto'
	,'contact_email' => 'E-mail'
	,'contact_url' => 'URL'
	,'no_events' => 'Non ci sono eventi in questo mese'
);

// ======================================================
// Event view
// ======================================================

$lang_event_view = array(
	'section_title' => 'Vista Evento'
	,'display_event' => 'Evento: \'%s\''
	,'cat_name' => 'Categoria'
	,'event_start_date' => 'Data'
	,'event_end_date' => 'Fino a'
	,'event_duration' => 'Durata'
	,'contact_info' => 'Info Contatto'
	,'contact_email' => 'E-mail'
	,'contact_url' => 'URL'
	,'no_event' => 'Non ci sono eventi da mostrare.'
	,'stats_string' => '<strong>%d</strong> Eventi in totale'
	,'edit_event' => 'Modifica Evento'
	,'delete_event' => 'Elimina Evento'
	,'delete_confirm' => 'Sei sicuro di voler cancellare questo evento ?'

);

// ======================================================
// Categories view
// ======================================================

$lang_cats_view = array(
	'section_title' => 'Vista Categorie'
	,'cat_name' => 'Nome Categoria'
	,'total_events' => 'Totale Eventi'
	,'upcoming_events' => 'Eventi Prossimi'
	,'no_cats' => 'Non ci sono categorie da mostrare.'
	,'stats_string' => 'Ci sono <strong>%d</strong> Eventi in <strong>%d</strong> Categorie'
);

// ======================================================
// Category Events view
// ======================================================

$lang_cat_events_view = array(
	'section_title' => 'Eventi in \'%s\''
	,'event_name' => 'Nome Evento'
	,'event_date' => 'Data'
	,'no_events' => 'Non ci sono eventi in questa categoria.'
	,'stats_string' => '<strong>%d</strong> Eventi in Totale'
	,'stats_string1' => '<strong>%d</strong> Evento(i) in <strong>%d</strong> pagina(e)'
);

// ======================================================
// cal_search.php
// ======================================================

$lang_event_search_data = array(
	'section_title' => 'Cerca Calendario',
	'search_results' => 'Cerca Risultati',
	'category_label' => 'Categoria',
	'date_label' => 'Data',
	'no_events' => 'Non ci sono eventi in questa categoria.',
	'search_caption' => 'Digita una parola chiave...',
	'search_again' => 'Cerca ancora',
	'search_button' => 'Cerca',
// Misc.
	'no_results' => 'Ricerca negativa: nessun risultato',
// Stats
	'stats_string1' => '<strong>%d</strong> Evento(i) trovati',
	'stats_string2' => '<strong>%d</strong> Evento(i) in <strong>%d</strong> pagina(e)'
);

// ======================================================
// profile.php
// ======================================================

if (defined('PROFILE_PHP'))

$lang_user_profile_data = array(
	'section_title' => 'Il Mio Profilo',
	'edit_profile' => 'Modifica Il Mio Profilo',
	'update_profile' => 'Aggiorna Il Mio Profilo',
	'actions_label' => 'Azioni',
// Account Info
	'account_info_label' => 'Info Account',
	'user_name' => 'Nome Utente',
	'user_pass' => 'Password',
	'user_pass_confirm' => 'Conferma Password',
	'user_email' => 'Indirizzo e-mail',
	'group_label' => 'Appartenenza a Gruppi',
// Other Details
	'other_details_label' => 'Altri Dettagli',
	'first_name' => 'Nome',
	'last_name' => 'Cognome',
	'full_name' => 'Nome Completo',
	'user_website' => 'Home page',
	'user_location' => 'Luogo',
	'user_occupation' => 'Professione',
// Misc.
	'select_language' => 'Seleziona la Lingua',
	'edit_profile_success' => 'Profilo aggiornato correttamente',
	'update_pass_info' => 'Lacia il campo password vuoto se non devi sostituirla',
// Error messages
	'invalid_password' => 'Digita una password composta da lettere e numeri, di lunghezza compresa tra 4 e 16 caratteri !',
	'password_is_username' => 'La password deve differire dal nome utente !',
	'password_not_match' =>'Le password digitate sono differenti fra loro',
	'invalid_email' => 'Devi fornire un indirizzo e-mail valido !',
	'email_exists' => 'L\'e-mail digitata è già usata da un\'altro utente. Inseriscine una diversa !',
	'no_email' => 'Devi fornire un indirizzo e-mail !',
	'invalid_email' => 'Devi fornire un indirizzo e-mail valido !',
	'no_password' => 'Devi fornire una password per questo nuovo account !'
);

// ======================================================
// register.php
// ======================================================

if (defined('USER_REGISTRATION_PHP'))

$lang_user_registration_data = array(
	'section_title' => 'Registrazione Utente',
// Step 1: Terms & Conditions
	'terms_caption' => 'Termini e Condizioni',
	'terms_intro' => 'Per continuare, devi accettare quanto segue:',
	'terms_message' => 'Per favore prenditi un attimo di tempo per dare un\'occhiata alle regole che seguono. Se le accetti e vuoi procedere con la registrazione, Clicca sul pulsante "Accetto" che trovi qui sotto. Per annullare questa registrazione, clicca il pulsante \'Indietro\' del tuo browser.<br /><br />Ricorda che non siamo in alcun modo responsabili degli eventi immessi dagli utenti di questo calendario. Non siamo responsabili dell\'utilità, appropriatezza, contenuto e completezza di alcuno degli eventi inseriti.<br /><br />I messaggi esprimono il punto di vista dell\'autore dell\'evento, non del programma calendario. Qualsiasi utente ritenga discutibile il contenuto di un evento è invitato a contattarci immediatamente a mezzo e-mail. Noi abbiamo la facoltà di rimuovere il contenuto inappropriato e faremo ogni sforzo per farlo in un tempo ragionevole, se concorderemo con la necessità della rimozione.<br /><br />Se decidi di utilizzare questo servizio, accetti di non utilizzare l\'applicazione calendario per pubblicare qualsiasi materiale che sia deliberatamente falso e/o diffamatorio, non accurato, offensivo, volgare, disgustoso, molesto, osceno, blasfemo, a sfondo sessuale, minaccioso, invasivo della privacy personale, o in qualsiasi altro modo in violazione della legge.<br /><br />Accetti di non pubblicare alcun materiale protetto da copyright, a meno che il proprietario del copyright sia tu o %s.',
	'terms_button' => 'Sono d\'accordo',

// Account Info
	'account_info_label' => 'Info Account',
	'user_name' => 'Nome Utente',
	'user_pass' => 'Password',
	'user_pass_confirm' => 'Conferma Password',
	'user_email' => 'Indirizzo e-mail',
// Other Details
	'other_details_label' => 'Altri Dettagli',
	'first_name' => 'Nome',
	'last_name' => 'Cognome',
	'user_website' => 'Home page',
	'user_location' => 'Luogo',
	'user_occupation' => 'Professione',
	'register_button' => 'Invia la mia registrazione',

// Stats
	'stats_string1' => '<strong>%d</strong> utenti',
	'stats_string2' => '<strong>%d</strong> utenti in <strong>%d</strong> pagina(e)',
// Misc.
	'reg_nomail_success' => 'Grazie per esserti registrato.',
	'reg_mail_success' => 'All\'indirizzo e-mail fornito è stata spedito un messaggio con le informazioni per l\'attivazione del tuo nuovo account.',
	'reg_activation_success' => 'Congratulazioni! Il tuo account è attivo da questo momento. Puoi effettuare il login con Nome Utente e Password da te scelti. Grazie per esserti registrato.',
// Mail messages
	'reg_confirm_subject' => 'Registrazione a %s',

// Error messages
	'no_username' => 'Devi fornire un Nome Utente !',
	'invalid_username' => 'Digita un Nome Utente composto da lettere e numeri, di lunghezza compresa tra 4 e 30 caratteri !',
	'username_exists' => 'Il Nome Utente che hai digitato è già usato da un altro utente. Sostituiscilo !',
	'no_password' => 'Devi fornite una password !',
	'invalid_password' => 'Digita una password composta da lettere e numeri, di lunghezza compresa tra 4 e 16 caratteri !',
	'password_is_username' => 'La password deve essere differente dal Nome Utente !',
	'password_not_match' =>'La password digitata non corrisponde a quella nel campo \'conferma password\'',
	'no_email' => 'Devi fornire un indirizzo e-mail !',
	'invalid_email' => 'Devi fornire un indirizzo e-mail valido !',
	'email_exists' => 'L\'indirizzo e-mail da te digitato è già usato da un altro utente. Immettine uno differente !',
	'delete_user_failed' => 'Questo account non può essere eliminato',
	'no_users' => 'Nessunt account da mostrare !',
	'already_logged' => 'Hai già effettuato il login come membro !',
	'registration_not_allowed' => 'La registrazione di nuovi utenti è al momento disattivata !',
	'reg_email_failed' => 'Si è verificato un errore nell\'invio dell\'e-mail di notifica !',
	'reg_activation_failed' => 'Si è verificato un errore mentre il sistema processava l\'attivazione !'

);
// Message body for email activation
$lang_user_registration_data['reg_confirm_body'] = <<<EOT
Grazie per esserti registrato su {CALENDAR_NAME}

Il tuo Nome Utente è : "{USERNAME}"
La tua Password è : "{PASSWORD}"

Per attivare il tuo account clicca sul link qui sotto o copialo
nel tuo browser.

{REG_LINK}

Saluti,

Il gestore di {CALENDAR_NAME}

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
	'section_title' => 'Amministrazione Evento',
	'events_to_approve' => 'Amministrazione Evento: Eventi da Approvare',
	'upcoming_events' => 'Amministrazione Evento: Eventi Prossimi',
	'past_events' => 'Amministrazione Evento: Eventi Passati',
	'add_event' => 'Aggiungi Nuovo Evento',
	'edit_event' => 'Modifica Evento',
	'view_event' => 'Vista Evento',
	'approve_event' => 'Approva Evento',
	'update_event' => 'Aggiorna Info Evento',
	'delete_event' => 'Elimina Evento',
	'events_label' => 'Eventi',
	'auto_approve' => 'Auto Approva',
	'date_label' => 'Data',
	'actions_label' => 'Azioni',
	'events_filter_label' => 'Filtra Eventi',
	'events_filter_options' => array('Mostra tutti gli eventi','Mostra solo eventi non approvati','Mostra solo gli eventi prossimi','Mostra solo gli eventi passati'),
	'picture_attached' => 'Immagine allegata',
// View Event
	'view_event_name' => 'Evento: \'%s\'',
	'event_start_date' => 'Data',
	'event_end_date' => 'Fino a',
	'event_duration' => 'Durata',
	'contact_info' => 'Info Contatto',
	'contact_email' => 'E-mail',
	'contact_url' => 'URL',
// General Info
// Event form
	'edit_event_title' => 'Evento: \'%s\'',
	'cat_name' => 'Categoria',
	'event_start_date' => 'Data',
	'event_end_date' => 'Fino a',
	'contact_info' => 'Info Contatto',
	'contact_email' => 'E-mail',
	'contact_url' => 'URL',
	'no_event' => 'Non ci sono eventi da mostrare.',
	'stats_string' => '<strong>%d</strong> Eventi in Totale',
// Stats
	'stats_string1' => '<strong>%d</strong> evento(i)',
	'stats_string2' => 'Totale: <strong>%d</strong> eventi in <strong>%d</strong> pagina(e)',
// Misc.
	'add_event_success' => 'Nuovo Evento aggiunto correttamente',
	'edit_event_success' => 'Evento aggiornato correttamente',
	'approve_event_success' => 'Evento approvato correttamente',
	'delete_confirm' => 'Sicuro di voler eliminare questo evento ?',
	'delete_event_success' => 'Evento eliminato correttamente',
	'active_label' => 'Attivo',
	'not_active_label' => 'Non Attivo',
// Error messages
	'no_event_name' => 'Devi fornire un nome per questo evento !',
	'no_event_desc' => 'Devi fornire una descrizione per questo evento !',
	'no_cat' => 'Devi selezionare una categoria per questo evento !',
	'no_day' => 'Devi selezionare il giorno !',
	'no_month' => 'Devi selezionare il mese !',
	'no_year' => 'Devi selezionare l\'anno !',
	'non_valid_date' => 'Per favore digita una data valida !',
	'end_days_invalid' => 'Per favore assicurati che il campo \'Giorni\' sotto \'Durata\' consista di soli numeri !',
	'end_hours_invalid' => 'Per favore assicurati che il campo \'Ore\' sotto \'Durata\' consista di soli numeri !',
	'end_minutes_invalid' => 'Per favore assicurati che il campo \'Minuti\' sotto \'Durata\' consista di soli numeri !',
	'delete_event_failed' => 'Questo evento non può essere eliminato',
	'approve_event_failed' => 'Questo evento non può essere approvato',
	'no_events' => 'Non ci sono eventi da mostrare !',
	'recur_val_1_invalid' => 'Il valore immesso per \'intervallo di ripetizione\' non è valido. Questo deve essere un numero maggiore di  \'0\' !',
	'recur_end_count_invalid' => 'Il valore immesso per \'numero di ricorrenze\' non è valido. Questo deve essere un numero maggiore di  \'0\' !',
	'recur_end_until_invalid' => 'La data \'ripeti fino al\' deve essere posteriore alla data di inizio !'

);

// ======================================================
// admin_categories.php
// ======================================================

if (defined('ADMIN_CATS_PHP'))

$lang_cat_admin_data = array(
	'section_title' => 'Amministrazione della Categoria',
	'add_cat' => 'Aggiungi Nuova Categoria',
	'edit_cat' => 'Modifica Categoria',
	'update_cat' => 'Aggiorna Info Categoria',
	'delete_cat' => 'Elimina Categoria',
	'events_label' => 'Eventi',
	'visibility' => 'Visibilità',
	'actions_label' => 'Azioni',
	'users_label' => 'Utenti',
	'admins_label' => 'Amministratori',
// General Info
	'general_info_label' => 'Info Generali',
	'cat_name' => 'Nome Categoria',
	'cat_desc' => 'Descrizione Categoria',
	'cat_color' => 'Colore',
	'pick_color' => 'Scegli un colore!',
	'status_label' => 'Stato',
// Stats
	'stats_string1' => '<strong>%d</strong> categorie',
	'stats_string2' => 'Attivo: <strong>%d</strong>&nbsp;&nbsp;&nbsp;Totale: <strong>%d</strong>&nbsp;&nbsp;&nbsp;on <strong>%d</strong> pagina(e)',
// Misc.
	'add_cat_success' => 'Nuova categoria aggiunta correttamente',
	'edit_cat_success' => 'Categoria aggiornata correttamente',
	'delete_confirm' => 'Sicuro di voler eliminare questa categoria ?',
	'delete_cat_success' => 'Categoria eliminata correttamente',
	'active_label' => 'Attivo',
	'not_active_label' => 'Non Attivo',
// Error messages
	'no_cat_name' => 'Devi dare un nome a questa categoria !',
	'no_cat_desc' => 'Devi fornire una descrizione per questa categoria !',
	'no_color' => 'Devi dare un colore a questa categoria !',
	'delete_cat_failed' => 'Questa categoria non può essere eliminata',
	'no_cats' => 'Non ci sono categorie da mostrare !',
	'cat_has_events' => 'Questa categoria contiene %d evento(i) e pertanto non può essere eliminata!<br>Per favore elimina gli eventi rimanenti in essa e riprovaci!'

);
// ======================================================
// admin_users.php
// ======================================================

if (defined('ADMIN_USERS_PHP'))

$lang_user_admin_data = array(
	'section_title' => 'Amministrazione Utenti',
	'add_user' => 'Aggiungi Nuovo Utente',
	'edit_user' => 'Modifica Info Utente',
	'update_user' => 'Aggiorna Info Utente',
	'delete_user' => 'Elimina Account Utente',
	'last_access' => 'Ultimo Accesso',
	'actions_label' => 'Azioni',
	'active_label' => 'Attivo',
	'not_active_label' => 'Non Attivo',
// Account Info
	'account_info_label' => 'Info Account',
	'user_name' => 'Nome Utente',
	'user_pass' => 'Password',
	'user_pass_confirm' => 'Conferma Password',
	'user_email' => 'Indirizzo e-mail',
	'group_label' => 'Appartenenza a Gruppi',
	'status_label' => 'Stato Account',
// Other Details
	'other_details_label' => 'Altri Dettagli',
	'first_name' => 'Nome',
	'last_name' => 'Cognome',
	'user_website' => 'Home page',
	'user_location' => 'Luogo',
	'user_occupation' => 'Professione',
// Stats
	'stats_string1' => '<strong>%d</strong> utenti',
	'stats_string2' => '<strong>%d</strong> utenti su <strong>%d</strong> pagina(e)',
// Misc.
	'select_group' => 'Selezionane uno...',
	'add_user_success' => 'Account utente aggiunto correttamente',
	'edit_user_success' => 'Account utente aggiornato correttamente',
	'delete_confirm' => 'Sei sicuro di vole cancellare questo account ?',
	'delete_user_success' => 'Account utente eliminato correttamente',
	'update_pass_info' => 'Lascia il campo password vuoto se non devi sostituirla',
	'access_never' => 'Mai',
// Error messages
	'no_username' => 'Devi fornire il nome utente !',
	'invalid_username' => 'Digita un nome utente composto da lettere e numeri, di lunghezza compresa tra 4 e 30 caratteri !',
	'invalid_password' => 'Digita una password  composta da lettere e numeri, di lunghezza compresa tra 4 e 16 caratteri !',
	'password_is_username' => 'La password deve essere differente dal nome utente !',
	'password_not_match' =>'La password digitata non corrisponde a quella immessa nel campo \'conferma password\'',
	'invalid_email' => 'Devi fornire un indirizzo e-mail valido !',
	'email_exists' => 'L\'e-mail che hai dato è già stata utilizzata per la registrazione di un altro utente. Devi fornirne una differente !',
	'username_exists' => 'Il nome utente che hai scelto è già utilizzato da un altro utente. Cambialo !',
	'no_email' => 'Devi fornire un indirizzo e-mail !',
	'invalid_email' => 'Devi fornire un indirizzo e-mail valido !',
	'no_password' => 'Devi fornire una password per questo nuovo account !',
	'no_group' => 'Per favore selezione un gruppo di appartenenza per questo utente !',
	'delete_user_failed' => 'Questo account utente non può essere eliminato',
	'no_users' => 'Nessun account utente da mostrare !'

);

// ======================================================
// admin_groups.php
// ======================================================

if (defined('ADMIN_GROUPS_PHP'))

$lang_group_admin_data = array(
	'section_title' => 'Amministrazione di Gruppi',
	'add_group' => 'Aggiungi Nuovo Gruppo',
	'edit_group' => 'Modifica Gruppo',
	'update_group' => 'Aggiorna Info Gruppo',
	'delete_group' => 'Elimina Gruppo',
	'view_group' => 'Vista Gruppo',
	'users_label' => 'Membri',
	'actions_label' => 'Azioni',
// General Info
	'general_info_label' => 'Info Generali',
	'group_name' => 'Nome del Gruppo',
	'group_desc' => 'Descrizione del Gruppo',
// Group Access Level
	'access_level_label' => 'Livello di Accesso del Gruppo',
	'Administrator' => 'Utenti di questo gruppo hanno accesso da Amministratore',
	'can_manage_accounts' => 'Utenti di questo gruppo possono gestire gli account',
	'can_change_settings' => 'Utenti di questo gruppo possono cambiare le impostazioni del calendario',
	'can_manage_cats' => 'Utenti di questo gruppo possono gestire le categorie',
	'upl_need_approval' => 'Gli eventi inviati richiedono approvazione',
// Stats
	'stats_string1' => '<strong>%d</strong> gruppi',
	'stats_string2' => 'Totale: <strong>%d</strong> gruppi in <strong>%d</strong> pagina(e)',
	'stats_string3' => 'Totale: <strong>%d</strong> utenti in <strong>%d</strong> pagina(e)',
// View Group Members
	'group_members_string' => 'Membri di \'%s\' gruppo',
	'username_label' => 'Nome Utente',
	'firstname_label' => 'Nome',
	'lastname_label' => 'Cognome',
	'email_label' => 'E-mail',
	'last_access_label' => 'Ultimo accesso',
	'edit_user' => 'Modifica Utente',
	'delete_user' => 'Elimina Utente',
// Misc.
	'add_group_success' => 'Nuovo gruppo aggiunto correttamente',
	'edit_group_success' => 'Gruppo aggiornato correttamente',
	'delete_confirm' => 'Sicuri di voler eliminare questo gruppo ?',
	'delete_user_confirm' => 'Sicuri di voler eliminare questo gruppo ?',
	'delete_group_success' => 'Gruppo eliminato correttamente',
	'no_users_string' => 'Non ci sono utenti in questo gruppo',
// Error messages
	'no_group_name' => 'Devi dare un nome a questo gruppo !',
	'no_group_desc' => 'Devi fornire una descrizione per questo gruppo !',
	'delete_group_failed' => 'Questo gruppo non può essere eliminato',
	'no_groups' => 'Nessun gruppo da mostrare !',
	'group_has_users' => 'Questo gruppo contiene %d utente(i) e quindi non può essere eliminato!<br>Per favore togli gli utenti rimanenti da questo gruppo prima di riprovare ad eliminarlo!'

);

// ======================================================
// admin_settings.php / admin_settings_template.php /
// admin_settings_updates.php
// ======================================================

$lang_settings_data = array(
	'section_title' => 'Impostazioni Calendario'
// Links
	,'admin_links_text' => 'Scegli Sezione'
	,'admin_links' => array('Impostazioni Principali','Configurazione Modello','Aggiornamenti Prodotto')
// General Settings
	,'general_settings_label' => 'Generale'
	,'calendar_name' => 'Nome Calendario'
	,'calendar_description' => 'Descrizione Calendario'
	,'calendar_admin_email' => 'E-mail dell\'Amministratore Calendario'
	,'cookie_name' => 'Nome del cookie usato dallo script'
	,'cookie_path' => 'Percorso del cookie usato dallo script'
	,'debug_mode' => 'Abilita modalità di debug'
	,'calendar_status' => 'Stato pubblico del Calendario'
// Environment Settings
	,'env_settings_label' => 'Ambiente'
	,'lang' => 'Lingua'
		,'lang_name' => 'Lingua'
		,'lang_native_name' => 'Nome nativo'
		,'lang_trans_date' => 'Tradotto il'
		,'lang_author_name' => 'Autore'
		,'lang_author_email' => 'E-mail'
		,'lang_author_url' => 'Sito Web'
	,'charset' => 'Codifica carattere'
	,'theme' => 'Tema'
		,'theme_name' => 'Nome del Tema'
		,'theme_date_made' => 'Creato il'
		,'theme_author_name' => 'Autore'
		,'theme_author_email' => 'E-mail'
		,'theme_author_url' => 'Sito Web'
	,'timezone' => 'Fuso orario'
	,'time_format' => 'Formato ora'
		,'24hours' => '24 ore'
		,'12hours' => '12 ore'
	,'auto_daylight_saving' => 'Passa automativamente all\'ora legale (DST)'
	,'main_table_width' => 'Larghezza della tabella principale (Pixel o %)'
	,'day_start' => 'La settimana inizia'
	,'default_view' => 'Vista Predefinita'
	,'search_view' => 'Abilita ricerca'
	,'archive' => 'Mostra eventi passati'
	,'events_per_page' => 'Numero di eventi per pagina'
	,'sort_order' => 'Ordinamento predefinito'
		,'sort_order_title_a' => 'Titolo, ascendente'
		,'sort_order_title_d' => 'Titolo, discendente'
		,'sort_order_date_a' => 'Data, ascendente'
		,'sort_order_date_d' => 'Data discendente'
	,'show_recurrent_events' => 'Mostra eventi ripetuti'
	,'multi_day_events' => 'Eventi di più giorni'
		,'multi_day_events_all' => 'Mostra l\'intero intervallo di date'
		,'multi_day_events_bounds' => 'Mostra solo data di inizio e di fine'
		,'multi_day_events_start' => 'Mostra solo data di inizio'
	// User Settings
	,'user_settings_label' => 'Impostazioni Utente'
	,'allow_user_registration' => 'Consenti registrazione utenti'
	,'reg_duplicate_emails' => 'Consenti doppioni e-mail'
	,'reg_email_verify' => 'Abilita attivazione account via e-mail'
// Event View
	,'event_view_label' => 'Vista Evento'
	,'popup_event_mode' => 'Pop-up Evento'
	,'popup_event_width' => 'Larghezza della finestra Pop-up'
	,'popup_event_height' => 'Altezza della finestra Pop-up'
// Aggiungi Evento View
	,'add_event_view_label' => 'Aggiungi Evento'
	,'add_event_view' => 'Abilitato'
	,'addevent_allow_html' => 'Consenti <b>HTML</b> nella descrizione'
	,'addevent_allow_contact' => 'Consenti contatto'
	,'addevent_allow_email' => 'Consenti e-mail'
	,'addevent_allow_url' => 'Consenti URL'
	,'addevent_allow_picture' => 'Consenti Immagini'
	,'new_post_notification' => 'Mandami un\'e-mail quando un evento richiede approvazione'
// Calendar View
	,'calendar_view_label' => 'Vista Mensile'
	,'monthly_view' => 'Abilitata'
	,'cal_view_show_week' => 'Mostra numeri di Settimana'
	,'cal_view_max_chars' => 'Lunghezza massima della descrizione (num. caratteri)'
// Flyer View
	,'flyer_view_label' => 'Vista volantino'
	,'flyer_view' => 'Abilitata'
	,'flyer_show_picture' => 'Mostra immagini in vista volantino'
	,'flyer_view_max_chars' => 'Lunghezza massima della descrizione (num. caratteri)'
// Vista Settimanale
	,'weekly_view_label' => 'Vista Settimanale'
	,'weekly_view' => 'Abilitata'
	,'weekly_view_max_chars' => 'Lunghezza massima della descrizione (num. caratteri)'
// Vista Giornaliera
	,'daily_view_label' => 'Vista Giornaliera'
	,'daily_view' => 'Abilitata'
	,'daily_view_max_chars' => 'Lunghezza massima della descrizione (num. caratteri)'
// Categories View
	,'categories_view_label' => 'Vista Categorie'
	,'cats_view' => 'Abilitata'
	,'cats_view_max_chars' => 'Lunghezza massima della descrizione (num. caratteri)'
// Mini Calendar
	,'mini_cal_label' => 'Mini Calendario'
	,'mini_cal_def_picture' => 'Immagine predefinita'
	,'mini_cal_display_picture' => 'Mostra Immagine'
	,'mini_cal_diplay_options' => array('Nessuna','Predefinita', 'Immagine quotidiana','Immagine settimanale','Immagine casuale')
// Mail Settings
	,'mail_settings_label' => 'Impostazioni Mail'
	,'mail_method' => 'Metodo di invio Mail'
	,'mail_smtp_host' => 'Host SMTP (separati da punto e virgola ;)'
	,'mail_smtp_auth' => 'Autenticazione SMTP'
	,'mail_smtp_username' => 'Nome Utente SMTP'
	,'mail_smtp_password' => 'Password SMTP'

// Form Buttons
	,'update_config' => 'Salva Nuova Configurazione'
	,'restore_config' => 'Ripristina Impostazioni Predefinite'
// Misc.
	,'update_settings_success' => 'Impostazioni aggiornate correttamente'
	,'restore_default_confirm' => 'Sicuri di voler ripristinare le impostazioeni predefinite ?'
// Template Configuration
	,'template_type' => 'tipo modello'
	,'template_header' => 'Personalizzazione Header'
	,'template_footer' => 'Personalizzazione Footer'
	,'template_status_default' => 'Usa il modello predefinito del tema'
	,'template_status_custom' => 'Usa il seguente modello:'
	,'template_custom' => 'Modello personale'

	,'info_meta' => 'Meta Informazioni'
	,'info_status' => 'Controllo Stato'
	,'info_status_default' => 'Disabilite questo contenuto'
	,'info_status_custom' => 'Mostra il seguente contenuto:'
	,'info_custom' => 'Contenuto personale'

	,'dynamic_tags' => 'Tag Dinamici'

// Product Updates
	,'updates_check_text' => 'Per favore attendere mentre recupero le info dal server...'
	,'updates_no_response' => 'Nessuna risposta dal server. Per favore riprova più tardi.'
	,'avail_updates' => 'Sono disponibili aggiornamenti'
	,'updates_download_zip' => 'Scarica il pacchetto ZIP (.zip)'
	,'updates_download_tgz' => 'Scarica il pacchetto TGZ (.tar.gz)'
	,'updates_released_label' => 'Data release: %s'
	,'updates_no_update' => 'Versione aggiornata. Non sono necessari aggiornamenti ulteriori.'
);

// ======================================================
// cal_mini.inc.php
// ======================================================

$lang_mini_cal = array(
	'def_pic' => 'Immagine predefinita'
	,'daily_pic' => 'Immagine del Giorno (%s)'
	,'weekly_pic' => 'Immagine della Settimana (%s)'
	,'rand_pic' => 'Immagine casuale (%s)'
	,'post_event' => 'Spedisci Nuovo Evento'
	,'num_events' => '%d Evento(s)'
	,'selected_week' => 'Settimana %d'
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
	'section_title' => 'Schermata di Login'
// General Settings
	,'login_intro' => 'Digita Nome Utente e Password per effettuare il Login'
	,'username' => 'Nome Utente'
	,'password' => 'Password'
	,'remember_me' => 'Ricordami'
	,'login_button' => 'Login'
// Errors
	,'invalid_login' => 'Per favore verifica le info di login e riprova!'
	,'no_username' => 'Devi fornire il nome utente !'
	,'already_logged' => 'Hai già effettuato il login !'
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


DEFINE('_EXTCAL_THEMES_INSTALL_HEADING', 'Gestore dei Temi di JCal Pro');

//Common
DEFINE('_EXTCAL_VERSION', 'Versione');
DEFINE('_EXTCAL_DATE', 'Data');
DEFINE('_EXTCAL_AUTHOR', 'Autore');
DEFINE('_EXTCAL_AUTHOR_EMAIL', 'E-Mail dell\'autore');
DEFINE('_EXTCAL_AUTHOR_URL', 'URL dell\'autore');
DEFINE('_EXTCAL_PUBLISHED', 'Publlicato');

//Plugins
DEFINE('_EXTCAL_THEME_PLUGIN', 'Tema');
DEFINE('_EXTCAL_THEME_PLUGCOM', 'Tema/Comando');
DEFINE('_EXTCAL_THEME_NAME', 'Nome');
DEFINE('_EXTCAL_THEME_HEADING', 'Gestore dei Temi di JCal Pro');
DEFINE('_EXTCAL_THEME_FILTER', 'Filtro');
DEFINE('_EXTCAL_THEME_ACCESS_LIST', 'Lista di Accesso');
DEFINE('_EXTCAL_THEME_ACCESS_LVL', 'Livello di Accesso');
DEFINE('_EXTCAL_THEME_CORE', 'Core');
DEFINE('_EXTCAL_THEME_DEFAULT', 'Predefinito');
DEFINE('_EXTCAL_THEME_ORDER', 'Ordine');
DEFINE('_EXTCAL_THEME_ROW', 'Riga');
DEFINE('_EXTCAL_THEME_TYPE', 'Tipo');
DEFINE('_EXTCAL_THEME_ICON', 'Icona');
DEFINE('_EXTCAL_THEME_LAYOUT_ICON', 'Icona di Layout');
DEFINE('_EXTCAL_THEME_DESC', 'Descrizione');
DEFINE('_EXTCAL_THEME_EDIT', 'Modifica');
DEFINE('_EXTCAL_THEME_NEW', 'Nuovo');
DEFINE('_EXTCAL_THEME_DETAILS', 'Dettagli del Plugin');
DEFINE('_EXTCAL_THEME_PARAMS', 'Parametri');
DEFINE('_EXTCAL_THEME_ELMS', 'Elementi');
//Plugin Installer
DEFINE('_EXTCAL_THEMES_INSTALL_HEADING','Installa nuovi Temi');
DEFINE('_EXTCAL_THEMES_INSTALL_MSG', 'Sono mostrati solo i Temi che possono essere disinstallati - Il Tema Core non può essere rimosso.');
DEFINE('_EXTCAL_THEME_NONE', 'Non ci sono Temi non-core installati');

//Language Manager
DEFINE('_EXTCAL_LANG_HEADING', 'Gestore dei Linguaggi di EXTCAL');
DEFINE('_EXTCAL_LANG_LANG', 'Linguaggio');

//Language Installer
DEFINE('_EXTCAL_LANG_HEADING_INSTALL', 'Installa un nuovo Linguaggio per EXTCAL');
DEFINE('_EXTCAL_LANG_BACK', 'Indietro al Gestore dei Linguaggi');
//

//Global Installer
DEFINE('_EXTCAL_INS_PACKAGE_UPLOAD', 'Carica Pacchetto');
DEFINE('_EXTCAL_INS_PACKAGE_FILE', 'Pacchetto File');
DEFINE('_EXTCAL_INS_INSTALL', 'Installa da Cartella');
DEFINE('_EXTCAL_INS_INSTALL_DIR', 'Cartella di Installazione');
DEFINE('_EXTCAL_INS_UPLOAD_BUTTON', 'Carica File &amp; Installa');
DEFINE('_EXTCAL_INS_INSTALL_BUTTON', 'Installa');
?>