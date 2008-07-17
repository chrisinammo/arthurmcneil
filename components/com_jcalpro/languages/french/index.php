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

$File: index.php - French language file$

Revision date: 02/21/2007

**********************************************
Get the latest version of JCal Pro at:
http://dev.anything-digital.com//
**********************************************
*/

/** ensure this file is being included by a parent file */
defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );

// New language structure
$lang_info = array (
	'name' => 'French'
	,'nativename' => 'Français' // Language name in native language. E.g: 'Français' for 'French'
	,'locale' => array('fr','french') // Standard locale alternatives for a specific language. For reference, go to: http://www.php.net/manual/en/function.setlocale.php
	,'charset' => 'ISO-8859-1' // For reference, go to : http://www.w3.org/International/O-charset-lang.html
	,'direction' => 'ltr' // 'ltr' for Left to Right. 'rtl' for Right to Left languages such as Arabic.
	,'author' => 'DreamCatcher Team Leader'
	,'author_email' => 'contact@alphanet-sc.com'
	,'author_url' => 'http://www.alphanet-sc.com'
	,'transdate' => '26/12/2004'
);

$lang_general = array (
	'yes' => 'Oui'
	,'no' => 'Non'
	,'back' => 'Retour'
	,'continue' => 'Continuer'
	,'close' => 'Fermer'
	,'errors' => 'Erreurs'
	,'info' => 'Info'
	,'day' => 'Jour'
	,'days' => 'Jours'
	,'month' => 'Mois'
	,'months' => 'Mois'
	,'year' => 'Année'
	,'years' => 'Années'
	,'hour' => 'Heure'
	,'hours' => 'Heures'
	,'minute' => 'Minute'
	,'minutes' => 'Minutes'
	,'everyday' => 'Chaque jour'
	,'everymonth' => 'Chaque mois'
	,'everyyear' => 'Chaque année'
	,'active' => 'Activé'
	,'not_active' => 'Désactivé'
	,'today' => 'Aujourd\'hui'
	,'signature' => 'Réalisé par %s'
	,'expand' => 'Développer'
	,'collapse' => 'Réduire'
);

// Date formats, For reference, go to : http://www.php.net/manual/en/function.strftime.php
$lang_date_format = array (
	'full_date' => '%A, %d %B, %Y' // e.g. Wednesday, June 05, 2002
	,'full_date_time_24hour' => '%A, %d %B, %Y à %H:%M' // e.g. Wednesday, June 05, 2002 At 21:05
	,'full_date_time_12hour' => '%A, %d %B, %Y à %I:%M %p' // e.g. Wednesday, June 05, 2002 At 9:05 pm
	,'day_month_year' => '%d-%b-%Y' // e.g 10-Sep-2004
	,'local_date' => '%c' // Preferred date and time representation for current language 
	,'mini_date' => '%a. %d %b, %Y' 
	,'month_year' => '%B %Y'
	,'day_of_week' => array('Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi')
	,'months' => array('Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Décembre')
);

$lang_system = array (
	'system_caption' => 'Message système'
  ,'page_access_denied' => 'Vous n\'avez pas assez de privilèges pour accéder à cette page.'
  ,'page_requires_login' => 'Vous devez être identifié pour accéder à cette page.'
  ,'operation_denied' => 'Vous n\'avez pas assez de privilèges pour effectuer cette opération.'
	,'section_disabled' => 'Cette partie est désactivée actuellement !'
  ,'non_exist_cat' => 'La catégorie sélectionnée n\'existe pas !'
  ,'non_exist_event' => 'L\'événement sélectionné n\'existe pas !'
  ,'param_missing' => 'Les paramètres fournis sont incorrects.'
  ,'no_events' => 'Il n\'y a pas d\'événement à afficher'
  ,'config_string' => 'Vous utilisez \'%s\' fonctionnant sur %s, %s et %s.'
  ,'no_table' => 'La table \'%s\' n\'existe pas !'
  ,'no_anonymous_group' => 'La table %s ne contient pas le groupe \'Anonymes\' !'
  ,'calendar_locked' => 'Ce service est momentanément désactivé pour des raisons de maintenance. Nous sommes désolés pour cet inconvénient !'
	,'new_upgrade' => 'Le système a détecté une nouvelle version. Il est recommandé d\'effectué la mise à jour maintenant. Clickez sur "Continuer" pour lancer l\'outil de mise à jour.'
	,'no_profile' => 'Une erreur s\'est produite en recherchant les informations concernant votre profil'
// Mail messages
	,'new_event_subject' => 'Nouvel événement à %s'
	,'event_notification_failed' => 'Une erreur s\'est produite en essayant d\'envoyer un email de notification !'
);

// Message body for new event email notification
$lang_system['event_notification_body'] = <<<EOT
L'événement suivant vient d'être posté à {CALENDAR_NAME}

Titre : "{TITLE}"
Date : "{DATE}"
Durée : "{DURATION}"

Vous pouvez accéder à l'événement en clickant sur le lien suivant 
ou en le copiant l'URL dans votre navigateur.

{LINK}

Salutations,

L'administrateur de {CALENDAR_NAME}

EOT;

// Admin menu entries
$lang_admin_menu = array (
	'login' => 'Login'
	,'register' => 'S\'enregister'
  ,'logout' => 'Logout <span style="color:#FF9922">[<span style="color:#606F79">%s</span>]</span>'
  ,'user_profile' => 'Mon Profil'
	,'admin_events' => 'Evénements'
  ,'admin_categories' => 'Catégories'
  ,'admin_groups' => 'Groupes'
  ,'admin_users' => 'Utilisateurs'
  ,'admin_settings' => 'Réglages'
);

// Main menu entries
$lang_main_menu = array (
	'add_event' => 'Evénement'
	,'cal_view' => 'Mensuel'
  ,'flat_view' => 'Etendue'
  ,'weekly_view' => 'Hebdomadaire'
  ,'daily_view' => 'Journalier'
  ,'yearly_view' => 'Annuel'
  ,'categories_view' => 'Catégories'
  ,'search_view' => 'Chercher'
);

// ======================================================
// Add Event view
// ======================================================

$lang_add_event_view = array(
	'section_title' => 'Ajouter un événement'
	,'edit_event' => 'Editer l\'événement [id%d] \'%s\''
	,'update_event_button' => 'Mettre à jour'

// Event details
	,'event_details_label' => 'Détails de l\'événement'
	,'event_title' => 'Titre de l\'événement'
	,'event_desc' => 'Description de l\'événement'
	,'event_cat' => 'Catégorie'
	,'choose_cat' => 'Sélectionner une catégorie'
	,'event_date' => 'Date de l\'événement'
	,'day_label' => 'Jour'
	,'month_label' => 'Mois'
	,'year_label' => 'Année'
	,'start_date_label' => 'Heure de début'
	,'start_time_label' => 'à'
	,'end_date_label' => 'Durée'
	,'all_day_label' => 'Tous les jours'
// Contact details
	,'contact_details_label' => 'Détails concernant le contact'
	,'contact_info' => 'Informations sur le contact'
	,'contact_email' => 'Email du contact'
	,'contact_url' => 'URL du contact'
// Repeat events
	,'repeat_event_label' => 'Répéter l\'événement'
	,'repeat_method_label' => 'Méthode pour répéter'
	,'repeat_none' => 'Ne pas répéter l\'événement'
	,'repeat_every' => 'Répéter chaque'
	,'repeat_days' => 'Jour(s)'
	,'repeat_weeks' => 'Semaine(s)'
	,'repeat_months' => 'Mois'
	,'repeat_years' => 'Année(s)'
	,'repeat_end_date_label' => 'Date de fin'
	,'repeat_end_date_none' => 'Pas de date de fin'
	,'repeat_end_date_count' => 'Fin après %s occurence(s)'
	,'repeat_end_date_until' => 'Répéter jusqu\'au'
// Other details
	,'other_details_label' => 'Autres détails'
	,'picture_file' => 'Fichier image'
	,'file_upload_info' => '(limité à %d Koctets - extensions valides : %s )' 
	,'del_picture' => 'Effacer l\'image actuelle ?'
// Administrative options
	,'admin_options_label' => 'Options d\'administration'
	,'auto_appr_event' => 'Evénement approuvé'

// Error messages
	,'no_title' => 'Vous devez fournir un titre pour l\'événement !'
	,'no_desc' => 'Vous devez fournir une description pour cet événement !'
	,'no_cat' => 'Vous devez sélectionner une catégorie dans le menu déroulant !'
	,'date_invalid' => 'Vous devez fournir une date valide pour cet événement !'
	,'end_days_invalid' => 'La valeur saisie dans le champ \'Jours\' n\'est pas valide !'
	,'end_hours_invalid' => 'La valeur saisie dans le champ \'Heures\' n\'est pas valide !'
	,'end_minutes_invalid' => 'La valeur saisie dans le champ \'Minutes\' n\'est pas valide !'

	,'non_valid_extension' => 'Le format du fichier image attaché n\'est pas supporté ! (Extensions valides : %s)'

	,'file_too_large' => 'Le fichier attaché est trop grand ! (limité à %d Koctets)'
	,'move_image_failed' => 'Le système n\'a pas pu déplacer l\'image !'
	,'non_valid_dimensions' => 'La largeur ou la hauteur de l\'image est plus large que %s pixels !'

	,'recur_val_1_invalid' => 'La valeur entrée comme \'période de répétition\' n\'est pas valide. Cette valeur doit être un nombre supérieur à \'0\' !'
	,'recur_end_count_invalid' => 'La valeur entrée comme \'nombre d\'occurences\' n\'est pas valide. Cette valeur doit être un nombre supérieur à \'0\' !'
	,'recur_end_until_invalid' => 'La date \'répéter jusqu\'à\' doit être supérieure à la date de début d\'événement !'
// Misc. messages
	,'submit_event_pending' => 'Votre événement est en attente d\'approbation. Merci pour votre collaboration !'
	,'submit_event_approved' => 'Votre événement est automatiquement approuvé. Merci pour votre collaboration !'
	,'event_repeat_msg' => 'Cet événement est prévu pour être répété'
	,'event_no_repeat_msg' => 'Cet événement ne se répète pas'
);

// ======================================================
// daily view
// ======================================================

$lang_daily_event_view = array(
	'section_title' => 'Vue journalière'
	,'next_day' => 'Jour suivant'
	,'previous_day' => 'Jour précédent'
	,'no_events' => 'Il n\'y a pas d\'événement pour ce jour'
);

// ======================================================
// weekly view
// ======================================================

$lang_weekly_event_view = array(
	'section_title' => 'Vue hebdomadaire'
	,'week_period' => '%s - %s'
	,'next_week' => 'Semaine suivante'
	,'previous_week' => 'Semaine précédente'
	,'selected_week' => 'Semaine %d'
	,'no_events' => 'Il n\'y a pas d\'événement pour cette semaine'
);

// ======================================================
// monthly view
// ======================================================

$lang_monthly_event_view = array(
	'section_title' => 'Vue mensuelle'
	,'next_month' => 'Mois suivant'
	,'previous_month' => 'Mois précédent'
);

// ======================================================
// flat view
// ======================================================

$lang_flat_event_view = array(
	'section_title' => 'Vue étendue'
	,'week_period' => '%s - %s'
	,'next_month' => 'Mois suivant'
	,'previous_month' => 'Mois précédent'
	,'contact_info' => 'Info Contact'
	,'contact_email' => 'Email'
	,'contact_url' => 'URL'
	,'no_events' => 'Il n\'y a pas d\'événement pour ce mois'
);

// ======================================================
// Event view
// ======================================================

$lang_event_view = array(
	'section_title' => 'Evénement'
	,'display_event' => 'Evénement : \'%s\''
	,'cat_name' => 'Catégorie'
	,'event_start_date' => 'Date'
	,'event_end_date' => 'Jusqu\'à'
	,'event_duration' => 'Durée'
	,'contact_info' => 'Info Contact'
	,'contact_email' => 'Email'
	,'contact_url' => 'URL'
	,'no_event' => 'Il n\'y a aucun événement à afficher.'
	,'stats_string' => '<strong>%d</strong> événements au total'
	,'edit_event' => 'Editer l\'événement'
	,'delete_event' => 'Détruire l\'événement'
	,'delete_confirm' => 'Etes vous sûr de vouloir détruire cet événement ?'
	
);

// ======================================================
// Categories view
// ======================================================

$lang_cats_view = array(
	'section_title' => 'Vue des catégories'
	,'cat_name' => 'Nom de la catégorie'
	,'total_events' => 'Total des événements'
	,'upcoming_events' => 'Evénements à venir'
	,'no_cats' => 'Il n\'y a aucune catégorie à afficher.'
	,'stats_string' => 'Il y a <strong>%d</strong> événements dans <strong>%d</strong> catégories'
);

// ======================================================
// Category Events view
// ======================================================

$lang_cat_events_view = array(
	'section_title' => 'Evénements sous \'%s\''
	,'event_name' => 'Nom de l\'événement'
	,'event_date' => 'Date'
	,'no_events' => 'Il n\'y a aucun événement dans cette catégorie.'
	,'stats_string' => '<strong>%d</strong> événement(s) au total'
);

// ======================================================
// cal_search.php
// ======================================================

$lang_event_search_data = array(
	'section_title' => 'Rechercher dans le calendrier',
	'search_results' => 'Résultat de la recherche',
	'category_label' => 'Catégorie',
	'date_label' => 'Date',
	'no_events' => 'Il n\'y a aucun événement dans cette catégorie.',
	'search_caption' => 'Entrer des mots clés...',
	'search_again' => 'Chercher encore',
	'search_button' => 'Chercher',
// Misc.
	'no_results' => 'Aucun résultat trouvé',	
// Stats
	'stats_string1' => '<strong>%d</strong> événement(s) trouvé(s)',
	'stats_string2' => '<strong>%d</strong> événement(s) dans <strong>%d</strong> page(s)'
);

// ======================================================
// profile.php
// ======================================================

if (defined('PROFILE_PHP')) 

$lang_user_profile_data = array(
	'section_title' => 'Mon profil',
	'edit_profile' => 'Editer mon profil',
	'update_profile' => 'Mettre à jour mon profil',
	'actions_label' => 'Actions',
// Account Info
	'account_info_label' => 'Informations',
	'user_name' => 'Login',
	'user_pass' => 'Mot de passe',
	'user_pass_confirm' => 'Confirmer le mot de passe',
	'user_email' => 'Addresse E-mail',
	'group_label' => 'Groupe d\'appartenance',
// Other Details
	'other_details_label' => 'Autres Détails',
	'first_name' => 'Prénom',
	'last_name' => 'Nom',
	'full_name' => 'Nom complet',
	'user_website' => 'Page d\'accueil',
	'user_location' => 'Localisation',
	'user_occupation' => 'Fonction',
// Misc.
	'select_language' => 'Selectionner la Langue',
	'edit_profile_success' => 'Le profil a été mis à jour avec succès',
	'update_pass_info' => 'Laisser le champ mot de passe vide si vous ne souhaitez pas le changer',
// Error messages
	'invalid_password' => 'Entrez un mot de passe constitué seulement de lettres et de chiffres, entre 4 et 16 caractères de long !',
	'password_is_username' => 'Le mot de passe doit être différent du login !',
	'password_not_match' =>'Le mot de passe entré ne correspond pas au mot de passe de confirmation',
	'invalid_email' => 'Vous devez fournir une adresse email valide !',
	'email_exists' => 'Un autre utilisateur s\'est déjà enregistré avec l\'adresse email que vous avez entré. Entrez un email différent !',
	'no_email' => 'Vous devez fournir une adresse email !',
	'invalid_email' => 'Vous devez fournir une adresse email valide !',
	'no_password' => 'Vous devez fournir un mot de passe pour ce nouveau compte !'
);

// ======================================================
// register.php
// ======================================================

if (defined('USER_REGISTRATION_PHP')) 

$lang_user_registration_data = array(
	'section_title' => 'Enregistrement utilisateur',
// Step 1: Terms & Conditions
	'terms_caption' => 'Termes et Conditions',
	'terms_intro' => 'Pour pouvoir continuer, vous devez accepter ce qui suit :',
	'terms_message' => 'Prenez un moment s\'il vous plaît, pour étudier les règles ci-dessous. Si vous êtes d\'accord avec et souhaitez continuer à vous enregistrer, clickez sur le bouton "je suis d\'accord" ci-dessous. Pour abandonner l\'enregistrement, clickez sur la flèche "retour arrière" de votre navigateur.<br /><br />Rappelez vous que nous ne sommes pas responsable des événements enregistrés par les utilisateurs dans le calendrier. Nous ne nous portons pas garrant, ni ne garantissons l\'exactitude, l\'exhaustitivté ou l\'utilité des événements enregistrés, et ne sommes pas responsables de leur contenus.<br /><br />Les messages expriment les opinions de l\'auteur de l\'événenement, pas nécessairement celles des administrateurs de %s. N\'importe quel utilisateur qui estime qu\'un événement est répréhensible est encouragé à nous contacter immédiatement par email. Nous avons la capacité d\'enlever le contenu répréhensible et nous ferons tout pour le faire dans un temps raisonnable, si nous déterminons que son retrait est necessaire.<br/><br/>Vous approuvez, par votre utilisation de ce service, que vous n\'emploierez pas cette application de calendrier pour mettre en avant un événement volontairement faux, diffamatoire, imprécis, abusif, vulgaire, obscène, orienté sexuel, menaçant, risquant de compromettre l\'intimité d\'une personne ou violer une loi.<br/><br/>Vous acceptez de ne pas proposer des informations soumises à des droits, sauf si les droits d\'auteur vous appartiennent ou appartiennent à %s.',
	'terms_button' => 'Je suis d\'accord',
	
// Account Info
	'account_info_label' => 'Information du compte',
	'user_name' => 'Nom de login',
	'user_pass' => 'Mot de passe',
	'user_pass_confirm' => 'Confirmer le mot de passe',
	'user_email' => 'Adresse E-mail',
// Other Details
	'other_details_label' => 'Autres détails',
	'first_name' => 'Prénom',
	'last_name' => 'Nom',
	'user_website' => 'Page d\'accueil',
	'user_location' => 'Localisation',
	'user_occupation' => 'Profession',
	'register_button' => 'Soumettre ma requette',

// Stats
	'stats_string1' => '<strong>%d</strong> utilisateurs',
	'stats_string2' => '<strong>%d</strong> utilisateur(s) sur %d page(s)',
// Misc.
	'reg_nomail_success' => 'Merci de votre inscription.',
	'reg_mail_success' => 'Un email avec les informations sur comment activer votre compte vous a été envoyé à l\'adresse indiquée.',
	'reg_activation_success' => 'Félicitations ! Votre compte est activé et vous pouvez vous connecter avec votre login et votre mot de passe. Merci de votre inscription.',
// Mail messages
	'reg_confirm_subject' => 'Inscrit à %s',
	
// Error messages
	'no_username' => 'Vous devez fournir un nom de login !',
	'invalid_username' => 'Entrer un nom de login constitué seulement de lettres et de nombres, entre 4 et 30 caractères de long !',
	'username_exists' => 'Le nom de login que vous avez entré est déja pris. Proposez un nom différent SVP !',
	'no_password' => 'Vous devez fournir un mot de passe pour ce nouveau compte !',
	'invalid_password' => 'Entrer un mot de passe constitué seulement de lettres et de nombres, entre 4 et 16 caractères de long !',
	'password_is_username' => 'Le mot de passe doit être différent du login !',
	'password_not_match' =>'Le mot de passe entré ne correspond pas à celui de confirmation',
	'no_email' => 'Vous devez fournir une adresse email !',
	'invalid_email' => 'Vous devez fournir une adresse email valide !',
	'email_exists' => 'Un autre utilisateur a déja fourni cette adresse email. Choisissez en une différente s\'il vous plaît !',
	'delete_user_failed' => 'Ce compte utilisateur ne peut pas être détruit',
	'no_users' => 'Il n\'y a pas de compte utilisateur à afficher !',
	'already_logged' => 'Vous êtes déja connecté !',
	'registration_not_allowed' => 'Les inscriptions sont momentanément closes !',
	'reg_email_failed' => 'Une erreur s\'est produite en essayant d\'envoyer l\'email d\'activation !',
	'reg_activation_failed' => 'Une erreur s\'est produite en essaynt d\'activer le compte !'

);
// Message body for email activation
$lang_user_registration_data['reg_confirm_body'] = <<<EOT
Merci pour votre inscription à {CALENDAR_NAME}

Votre login est  : "{USERNAME}"
Votre mot de passe est : "{PASSWORD}"

Pour activer votre compte, vous devez clicker sur le lien ci-dessous
ou le recopier dans votre navigateur.

{REG_LINK}

Salutations,

Administrateur de {CALENDAR_NAME}

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
	'section_title' => 'Administration des événements',
	'events_to_approve' => 'Administration des événements : Evénements à approuver',
	'upcoming_events' => 'Administration des événements : Evénements à venir',
	'past_events' => 'Administration des événements : Evénements passés',
	'add_event' => 'Ajouter un nouvel événement',
	'edit_event' => 'Editer l\'événement',
	'view_event' => 'Afficher l\'événement',
	'approve_event' => 'Approuver l\'événement',
	'update_event' => 'Mettre à jour les informations de l\'événement',
	'delete_event' => 'Détruire l\'événement',
	'events_label' => 'Evénements',
	'auto_approve' => 'Auto-approbation',
	'date_label' => 'Date',
	'actions_label' => 'Actions',
	'events_filter_label' => 'Filtrer les événements',
	'events_filter_options' => array('Afficher tous les événements','Afficher seulement les événements non-approuvés','Afficher seulement les événements à venir','Afficher seulement les événements passés'),
	'picture_attached' => 'Image attachée',
// View Event
	'view_event_name' => 'Evénement : \'%s\'',
	'event_start_date' => 'Date',
	'event_end_date' => 'Jusqu\'à',
	'event_duration' => 'Durée',
	'contact_info' => 'Info Contact',
	'contact_email' => 'Email',
	'contact_url' => 'URL',
// General Info
// Event form
	'edit_event_title' => 'Evénement : \'%s\'',
	'cat_name' => 'Catégorie',
	'event_start_date' => 'Date',
	'event_end_date' => 'Jusqu\'à',
	'contact_info' => 'Info Contact',
	'contact_email' => 'Email',
	'contact_url' => 'URL',
	'no_event' => 'Il n\'y a pas d\'événement à afficher.',
	'stats_string' => '<strong>%d</strong> événement(s) au total',
// Stats
	'stats_string1' => '<strong>%d</strong> événement(s)',
	'stats_string2' => 'Total : <strong>%d</strong> événements sur %d page(s)',
// Misc.
	'add_event_success' => 'Nouvel événement ajouté avec succès',
	'edit_event_success' => 'Evénement mis à jour avec succès',
	'approve_event_success' => 'Evénement approuvé avec succès',
	'delete_confirm' => 'Etes vous sûr de vouloir détruire cet événement ?',
	'delete_event_success' => 'Evénement détruit avec succès',
	'active_label' => 'Activé',
	'not_active_label' => 'Désactivé',
// Error messages
	'no_event_name' => 'Vous devez fournir un nom pour cet événement !',
	'no_event_desc' => 'Vous devez fournir une description pour cet événement !',
	'no_cat' => 'Vous devez sélectionner une catégorie pour cet événement !',
	'no_day' => 'Vous devez sélectionner un jour !',
	'no_month' => 'Vous devez sélectionner un mois !',
	'no_year' => 'Vous devez sélectionner une année !',
	'non_valid_date' => 'Entrer une date valide SVP !',
	'end_days_invalid' => 'Assurez vous que le champ \'Jours\' sous \'Durée\' est constitué seulement de nombres !',
	'end_hours_invalid' => 'Assurez vous que le champ \'Heures\' sous \'Durée\' est constitué seulement de nombres !',
	'end_minutes_invalid' => 'Assurez vous que le champ \'Minutes\' sous \'Durée\' est constitué seulement de nombres !',
	'file_too_large' => 'L\'image que vous avez attaché est plus grande que %s Koctets !',
	'non_valid_extension' => 'Le format du fichier attaché n\'est pas supporté !',
	'delete_event_failed' => 'Cet événement ne peut pas être détruit',
	'approve_event_failed' => 'Cet événement ne peut pas être approuvé',
	'no_events' => 'Il n\'y a pas d\'événement à afficher !',
	'move_image_failed' => 'Le système n\'a pas réussi à déplacer l\'image !',
	'non_valid_dimensions' => 'La largeur ou la hauteur de l\'image est supérieure à %s pixels !',

	'recur_val_1_invalid' => 'La valeur entrée comme \'période de répétition\' n\'est pas valide. Cette valeur doit être un nombre supérieur à \'0\' !',
	'recur_end_count_invalid' => 'La valeur entrée comme \'nombre d\'occurences\' n\'est pas valide. Cette valeur doit être un nombre supérieur à \'0\' !',
	'recur_end_until_invalid' => 'La date \'répéter jusqu\'à\' doit être supérieure à la date de début d\'événement !'

);

// ======================================================
// admin_categories.php
// ======================================================

if (defined('ADMIN_CATS_PHP')) 

$lang_cat_admin_data = array(
	'section_title' => 'Administration des catégories',
	'add_cat' => 'Ajouter une nouvelle catégorie',
	'edit_cat' => 'Editer la catégorie',
	'update_cat' => 'Mettre à jour les informations de la catégorie',
	'delete_cat' => 'Détruire la catégorie',
	'events_label' => 'Evénements',
	'visibility' => 'Visibilité',
	'actions_label' => 'Actions',
	'users_label' => 'Utilisateurs',
	'admins_label' => 'Administrateurs',
// General Info
	'general_info_label' => 'Information générale',
	'cat_name' => 'Nom de la catégorie',
	'cat_desc' => 'Description de la catégorie',
	'cat_color' => 'Couleur',
	'pick_color' => 'Choisir une couleur !',
	'status_label' => 'Statut',
// Administrative Options
	'admin_label' => 'Options d\'administration',
	'auto_admin_appr' => 'Approuver automatiquement les soumissions des administrateurs',
	'auto_user_appr' => 'Approuver automatiquement les soumissions des utilisateurs',
// Stats
	'stats_string1' => '<strong>%d</strong> catégories',
	'stats_string2' => 'Actives : <strong>%d</strong>&nbsp;&nbsp;&nbsp;Total : <strong>%d</strong>&nbsp;&nbsp;&nbsp;sur %d page(s)',
// Misc.
	'add_cat_success' => 'Nouvelle catégorie ajoutée avec succès',
	'edit_cat_success' => 'Catégorie mise à jour avec succès',
	'delete_confirm' => 'Etes vous sûr de vouloir détruire cette catégorie ?',
	'delete_cat_success' => 'Catégorie détruite avec succès',
	'active_label' => 'Activée',
	'not_active_label' => 'Désactivée',
// Error messages
	'no_cat_name' => 'Vous devez fournir un nom pour cette catégorie !',
	'no_cat_desc' => 'Vous devez fournir une description pour cette catégorie !',
	'no_color' => 'Vous devez fournir une couleur pour cette catégorie !',
	'delete_cat_failed' => 'Cette catégorie ne peut pas être détruite',
	'no_cats' => 'Il n\'y a pas de catégorie à afficher !',
	'cat_has_events' => 'Cette catégorie contient %d événement(s) et ne peut donc pas être détruite !<br>Détruisez les événements restants dans cette catégorie et recommencer à nouveau !'

);
// ======================================================
// admin_users.php
// ======================================================

if (defined('ADMIN_USERS_PHP')) 

$lang_user_admin_data = array(
	'section_title' => 'Administration des utilisateurs',
	'add_user' => 'Ajouter un nouvel utilisateur',
	'edit_user' => 'Editer les informations de l\'utilisateur',
	'update_user' => 'Mettre à jour les informations de l\'utilisateur',
	'delete_user' => 'Détruire le compte de l\'utilisateur',
	'last_access' => 'Dernier accès',
	'actions_label' => 'Actions',
	'active_label' => 'Activée',
	'not_active_label' => 'Désactivée',
// Account Info
	'account_info_label' => 'Information du compte',
	'user_name' => 'Nom de login',
	'user_pass' => 'Mot de passe',
	'user_pass_confirm' => 'Confirmer le mot de passe',
	'user_email' => 'E-mail',
	'group_label' => 'Groupe d\'appartenance',
	'status_label' => 'Statut du compte',
// Other Details
	'other_details_label' => 'Autres détails',
	'first_name' => 'Prénom',
	'last_name' => 'Nom',
	'user_website' => 'Site web',
	'user_location' => 'Localisation',
	'user_occupation' => 'Profession',
// Stats
	'stats_string1' => '<strong>%d</strong> utilisateurs',
	'stats_string2' => '<strong>%d</strong> utilisateur(s) sur %d page(s)',
// Misc.
	'select_group' => 'En sélectionner un...',
	'add_user_success' => 'Compte utilisateur ajouté avec succès',
	'edit_user_success' => 'Compte utilisateur mis à jour avec succès',
	'delete_confirm' => 'Etes vous sûr de vouloir détruire ce compte ?',
	'delete_user_success' => 'Compte utilisateur détruit avec succès',
	'update_pass_info' => 'Laisser le champ du mot de passe vide si vous n\'avez pas besoin de le changer',
	'access_never' => 'Jamais',
// Error messages
	'no_username' => 'Vous devez fournir un nom de login !',
	'invalid_username' => 'Entrer un nom de login constitué seulement de lettres et de nombres, entre 4 et 30 caractères de long !',
	'invalid_password' => 'Entrer un mot de passe constitué seulement de lettres et de nombres, entre 4 et 16 caractères de long !',
	'password_is_username' => 'Le mot de passe doit être différent du nom de login !',
	'password_not_match' =>'Le mot de passe que vou savez entré ne correspond pas à celui de confirmation',
	'invalid_email' => 'Vous devez fournir une adresse email valide !',
	'email_exists' => 'Un autre utilisateur a déja fourni cette adresse email. Choisissez en une différente s\'il vous plaît !',
	'username_exists' => 'Le nom de login que vous avez entré est déja pris. Proposez un nom différent SVP !',
	'no_email' => 'Vous devez fournir une adresse email !',
	'invalid_email' => 'Vous devez fournir une adresse email valide !',
	'no_password' => 'Vous devez fournir un mot de passe pour ce nouveau compte !',
	'no_group' => 'Sélectionner un groupe d\'appartenance pour cet utilisateur !',
	'delete_user_failed' => 'Ce compte utilisateur ne peut pas être détruit',
	'no_users' => 'Il n\'y a pas de compte utilisateur à afficher !'

);

// ======================================================
// admin_groups.php
// ======================================================

if (defined('ADMIN_GROUPS_PHP')) 

$lang_group_admin_data = array(
	'section_title' => 'Administration des groupes',
	'add_group' => 'Ajouter un nouveau groupe',
	'edit_group' => 'Editer le groupe',
	'update_group' => 'Mettre à jour les informations du groupe',
	'delete_group' => 'Détruire le groupe',
	'view_group' => 'Afficher le groupe',
	'users_label' => 'Membres',
	'actions_label' => 'Actions',
// General Info
	'general_info_label' => 'Information générale',
	'group_name' => 'Nom du groupe',
	'group_desc' => 'Description du groupe',
// Group Access Level
	'access_level_label' => 'Niveau d\'accès du groupe',
	'Administrator' => 'Les utilisateurs de ce groupe ont l\'accès administrateur',
	'can_manage_accounts' => 'Les utilisateurs de ce groupe peuvent administrer les comptes',
	'can_change_settings' => 'Les utilisateurs de ce groupe peuvent changer la configuration du calendrier',
	'can_manage_cats' => 'Les utilisateurs de ce groupe peuvent gérer les catégories',
	'upl_need_approval' => 'Les événements soumis nécessitent l\'approbation d\'un administrateur',
// Stats
	'stats_string1' => '<strong>%d</strong> groupe(s)',
	'stats_string2' => 'Total : <strong>%d</strong> groupe(s) dans %d page(s)',
	'stats_string3' => 'Total : <strong>%d</strong> utilisateur(s) sur %d page(s)',
// View Group Members
	'group_members_string' => 'Membres du groupe \'%s\'',
	'username_label' => 'Nom de login',
	'firstname_label' => 'Prénom',
	'lastname_label' => 'Nom',
	'email_label' => 'Email',
	'last_access_label' => 'Dernier accès',
	'edit_user' => 'Editer l\'utilisateur',
	'delete_user' => 'Détruire l\'utilisateur',
// Misc.
	'add_group_success' => 'Nouveau groupe ajouté avec succès',
	'edit_group_success' => 'Groupe mis à jour avec succès',
	'delete_confirm' => 'Etes vous sûr de vouloir détruire ce groupe ?',
	'delete_user_confirm' => 'Etes vous sûr de vouloir détruire ce groupe ?',
	'delete_group_success' => 'Groupe détruit avec succès',
	'no_users_string' => 'Il n\'y a pas d\'utilisateur dans ce groupe',
// Error messages
	'no_group_name' => 'Vous devez fournir un nom pour ce groupe !',
	'no_group_desc' => 'Vous devez fournir une description pour ce groupe !',
	'delete_group_failed' => 'Ce groupe ne peut pas être détruit',
	'no_groups' => 'Il n\'y a pas de groupe à afficher !',
	'group_has_users' => 'Ce groupe contient %d utilisateur(s) et ne peut donc pas être détruit!<br>Retirez les utilisateurs de ce groupe et recommencez SVP !'

);

// ======================================================
// admin_settings.php / admin_settings_template.php / 
// admin_settings_updates.php
// ======================================================

$lang_settings_data = array(
	'section_title' => 'Réglages du calendrier'
// Links
	,'admin_links_text' => 'Choisir la section'
	,'admin_links' => array('Réglages principaux','Configuration du Template','Mise à jour produit')
// General Settings
	,'general_settings_label' => 'Paramètres généraux'
	,'calendar_name' => 'Nom du calendrier'
	,'calendar_description' => 'Description du calendrier'
	,'calendar_admin_email' => 'Email de l\'administrateur du calendrier'
	,'cookie_name' => 'Nom du cookie utilisé par le script'
	,'cookie_path' => 'Chemin du cookie utilisé par le script'
	,'debug_mode' => 'Activer le mode debug'
	,'calendar_status' => 'Situation publique du calendrier'
// Environment Settings
	,'env_settings_label' => 'Paramètres d\'environnement'
	,'lang' => 'Langage'
		,'lang_name' => 'Code langue'
		,'lang_native_name' => 'Langue'
		,'lang_trans_date' => 'Traduit le'
		,'lang_author_name' => 'Auteur'
		,'lang_author_email' => 'E-mail'
		,'lang_author_url' => 'Site web'
	,'charset' => 'Encodage des caractères'
	,'theme' => 'Thème'
		,'theme_name' => 'Nom du thème'
		,'theme_date_made' => 'Fait le'
		,'theme_author_name' => 'Auteur'
		,'theme_author_email' => 'E-mail'
		,'theme_author_url' => 'Site web'
	,'timezone' => 'Décalage horaire'
	,'time_format' => 'Format d\'affichage de l\'heure'
		,'24hours' => '24 Heures'
		,'12hours' => '12 Heures'
	,'auto_daylight_saving' => 'Ajustement automatique de l\'heure d\'été/hiver (DST)'
	,'main_table_width' => 'Largeur de la Table principale (Pixels ou %)'
	,'day_start' => 'Les semaines commence le'
	,'default_view' => 'Affichage par défaut'
	,'search_view' => 'Permettre la recherche'
	,'archive' => 'Afficher les événements passés'
	,'events_per_page' => 'Nombre d\'événements par page'
	,'sort_order' => 'Ordre de tri par défaut'
		,'sort_order_title_a' => 'Titre ascendant'
		,'sort_order_title_d' => 'Title descendant'
		,'sort_order_date_a' => 'Date croissante'
		,'sort_order_date_d' => 'Date décroissante'
	,'show_recurrent_events' => 'Voir les événements réccurents'
	,'multi_day_events' => 'Evénements sur plusieurs jours'
		,'multi_day_events_all' => 'Voir toute la période'
		,'multi_day_events_bounds' => 'Voir seulement la date de début et de fin'
		,'multi_day_events_start' => 'Voir seulement la date de début'
	// User Settings
	,'user_settings_label' => 'Réglages utilisateur'
	,'allow_user_registration' => 'Permettre l\'inscription des utilisateurs'
	,'reg_duplicate_emails' => 'Autoriser la duplication des emails'
	,'reg_email_verify' => 'Permettre l\'activation des compte par email'
// Event View
	,'event_view_label' => 'Affichage des événements'
	,'popup_event_mode' => 'Affichage des événements en Pop-up'
	,'popup_event_width' => 'Largeur de la fenêtre Pop-up'
	,'popup_event_height' => 'Hauteur de la fenêtre Pop-up'
// Add Event View
	,'add_event_view_label' => 'Ajout des événements'
	,'add_event_view' => 'Activé'
	,'addevent_allow_html' => 'Permettre les codes <b>BB</b> dans la description'
	,'addevent_allow_contact' => 'Autoriser Contact'
	,'addevent_allow_email' => 'Autoriser Email'
	,'addevent_allow_url' => 'Autoriser URL'
	,'addevent_allow_picture' => 'Autoriser Images'
	,'new_post_notification' => 'Notification de nouvelle entrée'
// Calendar View
	,'calendar_view_label' => 'Vue mensuelle (calendrier)'
	,'monthly_view' => 'Activée'
	,'cal_view_show_week' => 'Afficher les numéros de semaine'
	,'cal_view_max_chars' => 'Nombre maximum de caractères pour la description'
// Flyer View
	,'flyer_view_label' => 'Vue des catégories'
	,'flyer_view' => 'Activée'
	,'flyer_show_picture' => 'Afficher les images dans la vue des catégories'
	,'flyer_view_max_chars' => 'Nombre maximum de caractères pour la description'
// Weekly View
	,'weekly_view_label' => 'Vue hebdomadaire'
	,'weekly_view' => 'Activée'
	,'weekly_view_max_chars' => 'Nombre maximum de caractères pour la description'
// Daily View
	,'daily_view_label' => 'Vue journalière'
	,'daily_view' => 'Activée'
	,'daily_view_max_chars' => 'Nombre maximum de caractères pour la description'
// Categories View
	,'categories_view_label' => 'Vue par catégorie'
	,'cats_view' => 'Activée'
	,'cats_view_max_chars' => 'Nombre maximum de caractères pour la description'
// Mini Calendar
	,'mini_cal_label' => 'Mini Calendrier'
	,'mini_cal_def_picture' => 'Image par défaut'
	,'mini_cal_display_picture' => 'Affiche l\'image'
	,'mini_cal_diplay_options' => array('Aucune','Image par défaut', 'Image du jour','Image de la semaine','Image aléatoire')
// Mail Settings
	,'mail_settings_label' => 'Réglages de mail'
	,'mail_method' => 'Méthode pour envoyer le mail'
	,'mail_smtp_host' => 'Serveurs SMTP (Séparés par un point virgule ;)'
	,'mail_smtp_auth' => ' Authentification SMTP'
	,'mail_smtp_username' => 'Login SMTP'
	,'mail_smtp_password' => 'Mot de passe SMTP'

// Picture Settings
	,'picture_settings_label' => 'Réglages pour les images'
	,'max_upl_dim' => 'Largeur et hauteur max. pour les images téléchargées'
	,'max_upl_size' => 'Taille maximum pour les images téléchargées (Upload) (en Koctets)'
	,'picture_chmod' => 'Mode par défaut pour les images (CHMOD) (en base 8 - Octal)'
	,'allowed_file_extensions' => 'Extensions de fichier acceptées pour les images téléchargées'
// Form Buttons
	,'update_config' => 'Enregistrer'
	,'restore_config' => 'Restaurer d\'origine'
// Misc.
	,'update_settings_success' => 'Réglages mis à jour avec succès'
	,'restore_default_confirm' => 'Etes vous sûr de vouloir remettre les réglages par défaut ?'
// Template Configuration
	,'template_type' => 'Type de gabarit'
	,'template_header' => 'Personnalisation de l\'entête'
	,'template_footer' => 'Personnalisation du pied de page'
	,'template_status_default' => 'Utiliser le gabarit par défaut'
	,'template_status_custom' => 'Utiliser le gabarit suivant :'
	,'template_custom' => 'Gabarit personnalisé'

	,'info_meta' => 'Meta Information'
	,'info_status' => 'Contrôle de statut'
	,'info_status_default' => 'Désactiver ce contenu'
	,'info_status_custom' => 'Afficher le contenu suivant :'
	,'info_custom' => 'Contenu personnalisé'

	,'dynamic_tags' => 'Tags Dynamiques'

// Product Updates
	,'updates_check_text' => 'Attendez le temps de retrouver le sinformations sur ce serveur...'
	,'updates_no_response' => 'Pas de réponse du serveur. Essayez plus tard.'
	,'avail_updates' => 'Mises à jour disponibles'
	,'updates_download_zip' => 'Télécharger le package ZIP (.zip)'
	,'updates_download_tgz' => 'Télécharger le package TGZ (.tar.gz)'
	,'updates_released_label' => 'Date de version : %s'
	,'updates_no_update' => 'Vous utilisez la dernière version disponible. La mise à jour n\'est pas nécessaire.'
);

// ======================================================
// cal_mini.inc.php
// ======================================================

$lang_mini_cal = array(
	'def_pic' => 'Image par défaut'
	,'daily_pic' => 'Image du jour (%s)'
	,'weekly_pic' => 'Image de la semaine (%s)'
	,'rand_pic' => 'Image aléatoire (%s)'
	,'post_event' => 'Nouvel événement'
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
	'section_title' => 'Fenêtre d\'extidentification'
// General Settings
	,'login_intro' => 'Entrer votre login et mot de passe pour vous connecter'
	,'username' => 'Login'
	,'password' => 'Mot de passe'
	,'remember_me' => 'Se rappeler de moi'
	,'login_button' => 'Login'
// Errors
	,'invalid_login' => 'Vérifiez vos information de login et re-essayer !'
	,'no_username' => 'Vous devez fournir un nom de login !'
	,'already_logged' => 'Vous êtes déja connecté !'
);

// ======================================================
// logout.php
// ======================================================

// To Be Done


?>