<?php
/**
 * Events Component for Joomla 1.0.x
 *
 * @version     $Id: admin_french-utf8.php 991 2008-03-10 19:55:48Z tstahl $
 * @package     Events
 * @copyright   Copyright (C) 2006-2008 JEvents Project Group
 * @copyright (C) 2000 - 2003 Eric Lamette, Dave McDonnell
 * @licence     http://www.gnu.org/copyleft/gpl.html
 * @link        http://joomlacode.org/gf/project/jevents
 * @encoding    utf-8
 */


defined( '_VALID_MOS' ) or die( 'No Direct Access' );

//Check
if( defined( '_CAL_ADMIN_LANG_INCLUDED' )) {
	return;
}

DEFINE( '_CAL_ADMIN_LANG_INCLUDED', 1 );

/* +++++++++++++++++++ */
define( '_CAL_HIDE_OLD_EVENTS',			'Cacher les évènements passés'); // NEW 1.4
define( '_CAL_LANG_CATEGORIES',   		'Catégories' );
define( '_CAL_LANG_DISPLAY',			'Affichage' );
define( '_CAL_LANG_CATEGORY_NAME',		'Nom de la catégorie' );
define( '_CAL_LANG_RECORDS',			'des&nbsp;enregistrements' );
define( '_CAL_LANG_CHECKED_OUT',		'Rejeté' );
define( '_CAL_LANG_PUBLISHED',			'Publié' );
define( '_CAL_LANG_NOT_PUBLISHED',		'Non Publié' );
define( '_CAL_LANG_ACCESS',				'Accès' );
define( '_CAL_LANG_REORDER',			'Réordonner' );
define( '_CAL_LANG_UNPUBLISH',			'Dépublier' );
define( '_CAL_LANG_PUBLISH',			'Publier' );
define( '_CAL_LANG_CLICK_TO_EDIT',		'Cliquez pour éditer' );
define( '_CAL_LANG_MOVE_UP',			'Monter' );
define( '_CAL_LANG_MOVE_DOWN',			'Descendre' );
define( '_CAL_LANG_EDIT_CAT',			'Editer la catégorie' );
define( '_CAL_LANG_ADD_CAT',			'Ajouter la catégorie' );
define( '_CAL_LANG_CAT_TITLE',			'Titre de la catégorie' );
define( '_CAL_LANG_CAT_NAME',			'Nom de la catégorie' );
define( '_CAL_LANG_IMAGE',				'Image' );
define( '_CAL_LANG_PREVIEW',			'Prévisualisation' );
define( '_CAL_LANG_IMG_POSITION',		"Position de l'image" );
define( '_CAL_LANG_ORDERING',			'Ordre' );
define( '_CAL_LANG_LEFT',				'Gauche' );
define( '_CAL_LANG_CENTER',				'Centre' );
define( '_CAL_LANG_RIGHT',				'Droite' );
define( '_CAL_LANG_SELECT_IMAGE',		"Sélectionner l'image" );
define( '_CAL_LANG_SEARCH',				"Recherche" );
define( '_CAL_LANG_TITLE',				"Titre" );
define( '_CAL_LANG_REPEAT',				"Répétition" );
define( '_CAL_LANG_TIME_SHEET',			'Feuille de temps' );
define( '_CAL_CLICK_TO_CHANGE_STATUS',	"Cliquer sur l'icone pour changer l'état" );
define( '_CAL_LANG_PUB_BUT_COMING',		'Publié, mais <u>à venir</u>' );
define( '_CAL_LANG_PUB_ACTUAL',			'Publié et <u>en cours</u>' );
define( '_CAL_LANG_PUB_FINISHED',		'Publié, mais <u>est fini</u>' );
define( '_CAL_LANG_EDIT_EVENT',			"Editer l'évènement" );
define( '_CAL_LANG_ADD_EVENT',			'Ajouter un événement' );
define( '_CAL_LANG_REQUIRED',			'obligatoire' );
define( '_CAL_LANG_IMG_FOLDER',			'Sous répertoire' );
define( '_CAL_LANG_IMAGES',				"Galerie d'images" );
define( '_CAL_LANG_AVAL_IMAGES',		'Images disponibles' );
define( '_CAL_LANG_INSERT_IMG',			'Insérer &raquo;' );
define( '_CAL_LANG_CONTENT_IMGS',		'Images sélectionnées' );
define( '_CAL_LANG_REMOVE',				'enlever' );
define( '_CAL_LANG_EDITED_SEL_IMG',		"Editer l'image sélectionnée" );
define( '_CAL_LANG_SOURCE',				'Source' );
define( '_CAL_LANG_ALIGN',				'Alignement' );
define( '_CAL_LANG_ALT_TXT',			'Text alternatif' );
define( '_CAL_LANG_BORDER',				'Bordure' );
define( '_CAL_LANG_CAPTION',			'Titre');
define( '_CAL_LANG_CAPTION_POSITION',	'Position du titre');
define( '_CAL_LANG_CAPTION_POS_BOTTOM',	'En bas');
define( '_CAL_LANG_CAPTION_POS_TOP',	'En haut');
define( '_CAL_LANG_CAPTION_ALIGN',		'Alignement du titre');
define( '_CAL_LANG_CAPTION_WIDTH',		'Largeur du titre');
define( '_CAL_LANG_APPLY',				'Appliquer' );
define( '_CAL_LANG_ADD_INFO',			'Information complémentaire' );
define( '_CAL_LANG_EVENT_STATUS',		"Etat de l'évènement" );
define( '_CAL_LANG_ARCHIVED',			'Archivé' );
define( '_CAL_LANG_DRAFT_UNPUB',		'Brouillon non publié' );
define( '_CAL_LANG_NEVER',				'Jamais' );
define( '_CAL_LANG_CUT_TITLE',			'Longueur du titre' );
define( '_CAL_LANG_MAX_DISPLAY',		'Evènements Max.' );
define( '_CAL_LANG_DIS_STARTTIME',		'Voir heure de début' );

	// config
define( '_CAL_LANG_EVENTS_CONFIG',		'Configuration JEvents' );
define( '_CAL_LANG_CONFIG_WRITEABLE',	'La configuration est modifiable' );
define( '_CAL_LANG_CONFIG_NOT_WRITEABLE',"La configuration n'est pas modifiable" );
define( '_CAL_LANG_CSS_WRITEABLE',		'Le fichier CSS est modifiable' );
define( '_CAL_LANG_CSS_NOT_WRITEABLE',	"Le fichier CSS n'est pas modifiable" );
define( '_CAL_LANG_ADMIN_EMAIL',		"Mail de l'admin" );
define( '_CAL_LANG_FRONTEND_PUBLISHING','Publication depuis le Frontend' );
define( '_CAL_LANG_SETT_FOR_COM',		'Ces paramètres concernent seulement le composant' );
define( '_CAL_LANG_SETT_FOR_CAL_MOD',	'Ces paramètres concernent seulement le module additionnel [ Calendar ]' );
define( '_CAL_LANG_SETT_FOR_MOD_LATEST','Ces paramètres concernent seulement le module additionnel  [ Latest Events ]' );
define( '_CAL_LANG_ICONIC_NAVBAR'		,'Utiliser la nouvelle barre de navigation avec des icônes'); // 1.4
define( '_CAL_LANG_CHECK_VERSION'		,"Vérifier une nouvelle version"); // 1.4

// errors
define( '_CAL_LANG_ERR_CAT_MUST_HAVE_NAME',	'Une catégorie doit avoir un nom' );

// title & alts
define( '_CAL_LANG_TIT_NAME_FOR_MENUS',	'Un nom court à afficher dans les menus' );
define( '_CAL_LANG_TIT_LONG_NAME',		'Un nom long à afficher dans les en-têtes' );
define( '_CAL_LANG_TIT_PENDING',		'En attente' );

// msgs
define( '_CAL_LANG_MSG_CAT_IS_EDITED',	'La catégorie [ %s ] est actuellement éditée par un autre administrateur' ); // %s = $row->title
define( '_CAL_LANG_MSG_OP_FAILED',		"Echec de l'opération: Impossible d'ouvrir [ %s ]" ); // %s = $filename
define( '_CAL_LANG_MSG_CHANGE_EMAIL',	"Aller d'abord à la section de configuration et changer l'adresse email" );
define( '_CAL_LANG_MSG_ADD_CAT_BEFORE',	"Vous devez d'abord ajouter une catégorie pour cette section" );
define( '_CAL_LANG_MSG_CONFIG_SAVED',	'Configuration correctement sauvegardée' );
define( '_CAL_LANG_MSG_WARNING',		'Avertissement...' );
define( '_CAL_LANG_MSG_CHMOD_CONFIG',	'Vous devez passer le fichier de configuration en chmod 0777 pour pouvoir mettre à jour la configuration' );
define( '_CAL_LANG_MSG_CHMOD_CSS',		'Vous devez passer le fichier de css en chmod 0777 pour pouvoir mettre à jour la configuration' );
define( '_CAL_LANG_MSG_MOD_NOT_INSTALLED',"Le module [ calendar ] n'est pas installé" );
define( '_CAL_LANG_MSG_NO_MOD_LATEST',	"Le module [ latest events ] n'est pas installé" );

// tips
define( '_CAL_LANG_TIP_ACCESS',			'Qui est autorisé à créer des nouveaux évènements' );
define( '_CAL_LANG_TIP_FRONT_PUB',		"Autoriser les publieurs, managers et administrateurs à publier le contenu depuis l\'interface publique" );
define( '_CAL_LANG_TIP_NR_OF_LIST',		"Nombre d\'évènements à lister par page pour les vues par semaine, mois ou année" );
define( '_CAL_LANG_TIP_FE_SIMPLE_FORM',	"Utiliser sur l\'interface publique le formulaire simplifié de saisie d\'évènements (sans les options de répétition)" );
define( '_CAL_LANG_TIP_DEF_EC_HIDE_FORCE',	"<b>Couleur spécifique d\'évènement autorisée</b><br/>Les interfaces publique et d\'administration peuvent utiliser les couleurs spécifiques par évènement<br/><b>Couleur d\'évènement seulement dans l\'interface d\'administration</b><br/>Seule l\'interface d\'administration permet de choisir les couleurs spécifiques par évènement<br/><b>Toujours utiliser la couleur de la catégorie</b><br/>Les interfaces ne peuvent pas utiliser les couleurs spécifiques par évènement, toutes les couleurs par évènement spécifiées avant le réglage de ce paramètre seront ignorées et la couleur de la catégorie sera utilisée à la place" );
define( '_CAL_LANG_TIP_DLM_STOP_DAY',		"Jour du mois en cours à partir duquel désactiver l\'affichage du mois précédent" );
define( '_CAL_LANG_TIP_DNM_START_DAY',		"Jours restants dans le mois en cours pour commencer l\'affichage du mois suivant" );
define( '_CAL_LANG_TIP_LEV_DAY_RANGE',		"Marge par rapport au jour actuel pour afficher les évènements (modes 2 ou 3 seulement)" );
define( '_CAL_LANG_TIP_LEV_DISPLAY_YEAR',	"Afficher l\'année dans la date de l\'évènement (format par défaut seulement)" );
define( '_CAL_LANG_TIP_BTN_DEF_CONFIG',		"Recharger les valeurs par défaut [au cas où quelque chose aille de travers]" );
define( '_CAL_LANG_TIP_LEV_DISPLAY_MODE',   "<b>mode 0</b> (par défaut)<br />affiche les évènements les plus proches pour la semaine en cours et la semaine suivante seulement jusqu\'au nombre maximum d\'évènements<br /><b>mode 1</b><br />identique au mode 0 sauf que les évènements passés de la semaine en cours seront aussi affichés si le nombre d\'évènements à venir est moins grand que le nombre maximum d\'évènements<br /><b>mode 2</b><br />affiche les évènements les plus proches devant se produire dans les prochains jours (en utilisant la marge des jours après choisie) et dans la limite du nombre d\'évènements maximum<br /><b>mode 3</b><br />identique au mode 2 sauf si il y a moins d\'évènements que le nombre maximum dans les prochains jours auquel cas affiche également les évènements passés (avec la marge des jours avant)<br /><b>mode 4</b><br />affiche les évènements les plus proches du mois en cours relativement au jour actuel et jusqu\'au nombre maximal" );
define( '_CAL_LANG_TIP_CUT_TITLE',			"Si un titre contient trop de caractères, l\'affichage peut être dégradé.<br />Définir ici le nombre de caractères à partir duquel le titre sera coupé et ... ajouté" );
define( '_CAL_LANG_TIP_LEV_HIDE_LINK',		"Si réglé à OUI, le lien du titre sera automatiquement rempli par l\'évènement javascript &lt;b&gt;onclick&lt;/b&gt;. Cela empêche les moteurs de recherche de suivre ce lien");
define( '_CAL_LANG_TIP_MAX_DISPLAY',		"Nombre total d\'évènements affichés <strong>en tant que texte</strong> pour chaque jour dans la vue mensuelle<br />Si il y a trop d\'évènements affichés chaque jour, l\'affichage peut être dégradé.<br />Définir ici combien d\'évènements doivent être affichés comme texte, si il y en a trop ils seront affichés en icônes (la boîte flottante n\'est pas affectée)<br /><strong>Astuce</strong>: Régler la valeur à 0 force l\'affichage de tous les évènements en icônes" );
define( '_CAL_LANG_TIP_DIS_STARTTIME',		"Affichage de l\'heure de début dans la vue mensuelle" );
	// tooltips
define( '_CAL_LANG_TIP_TT_BGROUND',			"La boîte flottante doit-elle utiliser le même fond que l\évènement ?<br />Si non, la couleur standard sera utilisée" );
define( '_CAL_LANG_TIP_TT_POSX',			"La position horizontale de la fenêtre flottante peut être à gauche, au centre ou à droite" );
define( '_CAL_LANG_TIP_TT_POSY',			"La position verticale de la fenêtre flottante peut être en-dessous ou au-dessus" );
define( '_CAL_LANG_TIP_TT_SHADOW',			"La fenêtre flottante peut avoir une ombre positionnée horizontalement à gauche ou à droite et verticalement en-dessous ou au-dessus" );

// tabs
define( '_CAL_LANG_TAB_COMMON',			'Général' );
define( '_CAL_LANG_TAB_IMAGES',			'Images' );
define( '_CAL_LANG_TAB_CALENDAR',		'Calendrier' );
define( '_CAL_LANG_TAB_HELP',			'Aide' );
define( '_CAL_LANG_TAB_EXTRA',			'Statistiques' );
define( '_CAL_LANG_TAB_ABOUT',			'A propos' );
define( '_CAL_LANG_TAB_COMPONENT',		'Composant' );
define( '_CAL_LANG_TAB_CAL_MOD',		'Calendar' );
define( '_CAL_LANG_TAB_LATEST_MOD',		'Latest Events' );
define( '_CAL_LANG_TAB_CSS',			'CSS' );
define( '_CAL_LANG_TAB_TOOLTIP',		'Boîte flottante' );

// select lists
	//common
define( '_CAL_LANG_YES',				'Oui' );
define( '_CAL_LANG_NO',					'Non' );
define( '_CAL_LANG_ALWAYS',				'TOUJOURS' );
	// access
define( '_CAL_LANG_SEL_ACCESS_ALL_REGGED',	'Tous les utilisateurs enregistrés' );
define( '_CAL_LANG_SEL_ACCESS_SPECIAL',		'Seulement les droits spéciaux et admins' );
define( '_CAL_LANG_SEL_ACCESS_ALL_ANONYM',	'Tous (anonymes) - non recommandé' );
define( '_CAL_LANG_SEL_ACCESS_ALL_AUTHORS',	'Auteurs et au-dessus' );
define( '_CAL_LANG_SEL_ACCESS_ALL_EDITORS',	'Editeurs et au-dessus' );
define( '_CAL_LANG_SEL_ACCESS_ALL_PUBLISHERS',	'Publieurs et au-dessus' );
define( '_CAL_LANG_SEL_ACCESS_ALL_MANAGERS',	'Managers et au-dessus' );
define( '_CAL_LANG_SEL_ACCESS_ALL_ADMIN',	'Seulement les admins et super-admins' );
	// first day
define( '_CAL_LANG_FIRST_DAY',			'Premier jour' );
define( '_CAL_LANG_SUNDAY_FIRST',		'Dimanche en 1er' );
define( '_CAL_LANG_MONDAY_FIRST',		'Lundi en 1er' );

define( '_CAL_LANG_VIEW_MAIL',			'Voir mail' );
define( '_CAL_LANG_VIEW_BY',			'Voir "Par"' );
define( '_CAL_LANG_VIEW_HITS',			'Voir "Hits"' );
define( '_CAL_LANG_VIEW_REPEAT_TIME',	'Voir Répétition et heure' );
define( '_CAL_LANG_VIEW_REPEAT_YEAR_LIST',	'Voir tous les évènements répétés dans la liste annuelle' );
define( '_CAL_LANG_SHOW_CATS',			'Cacher "Voir par catégories" (approprié si le module "Events legend" est affiché)' );
define( '_CAL_LANG_SHOW_COPYRIGHT',		'Voir le copyright en pied de page');
	// date format
define( '_CAL_LANG_DATE_FORMAT',		'Format de la date' );
define( '_CAL_LANG_DATE_FORMAT_FR_EN',	'Français-Anglais' );
define( '_CAL_LANG_DATE_FORMAT_US',		'USA' );
define( '_CAL_LANG_DATE_FORMAT_GERMAN',	'Europe - Allemand' );

define( '_CAL_LANG_TIME_FORMAT_12',		'Utiliser le format sur 12h' );
	// nav bar
define( '_CAL_LANG_NAV_BAR_COLOR',		'Couleur de la barre de navigation' );
define( '_CAL_LANG_NAV_BAR_GREEN',		'Verte' );
define( '_CAL_LANG_NAV_BAR_ORANGE',		'Orange' );
define( '_CAL_LANG_NAV_BAR_BLUE',		'Bleue' );
define( '_CAL_LANG_NAV_BAR_RED',		'Rouge' );
define( '_CAL_LANG_NAV_BAR_GRAY',		'Grise' );
define( '_CAL_LANG_NAV_BAR_YELLOW',		'Jaune' );

	// start page
define( '_CAL_LANG_START_PAGE',			"Page d'entrée" );
define( '_CAL_LANG_SP_DAY',				'Jour' );
define( '_CAL_LANG_SP_WEEK',			'Semaine' );
define( '_CAL_LANG_SP_MONTH_CAL',		'Mois (Calendrier)' );
define( '_CAL_LANG_SP_MONTH_LIST',		'Mois (Liste)' );
define( '_CAL_LANG_SP_YEAR',			'Année' );
define( '_CAL_LANG_SP_CATEGORIES',		'Catégories' );
define( '_CAL_LANG_SP_SEARCH',			'Recherche' );

define( '_CAL_LANG_NR_OF_LIST',			"Nb d'évènements" );
define( '_CAL_LANG_FE_SIMPLE_FORM',		'Utiliser formulaire simple' );
	// event color
define( '_CAL_LANG_DEF_EVENT_COLOR',	'Couleur par défaut des évènements' );
define( '_CAL_LANG_DEF_EC_RANDOM',		'Hasard' );
define( '_CAL_LANG_DEF_EC_NONE',		'Aucune' );
define( '_CAL_LANG_DEF_EC_CATEGORY',	'Catégorie' );
define( '_CAL_LANG_DEF_EC_HIDE_FORCE',	'Règle pour la couleur des événements' );
define( '_CAL_LANG_EVENT_COLS_ALLOWED',	"Couleur spécifique d'évènement autorisée" );
define( '_CAL_LANG_EVENT_COLS_BACKED',	"Couleur d'évènement seulement dans l'interface d'administration" );
define( '_CAL_LANG_ALWAYS_CAT_COLOR',	"Toujours utiliser la couleur de la catégorie" );

	// tooltips
define( '_CAL_LANG_ABOVE',				'Au-dessus' );
define( '_CAL_LANG_BELOW',				'En-dessous' );

// calendar module
	// display last month
define( '_CAL_LANG_DISPLAY_LAST_MONTH',	'Afficher le mois précédent' );
define( '_CAL_LANG_DLM_YES_STOP_DAY',	'OUI - avec jour limite' );
define( '_CAL_LANG_DLM_YES_EVENT_SDAY',	'OUI - si il y a un événement ET avec jour limite' );
define( '_CAL_LANG_DLM_ALWYS_IF_EVENTS','TOUJOURS - si il y a des évènements' );
	// stop day
define( '_CAL_LANG_DLM_STOP_DAY',		"Jour du mois courant pour l'arrêt de l'affichage" );
	// display next month
define( '_CAL_LANG_DISPLAY_NEXT_MONTH',	'Afficher le mois prochain' );
define( '_CAL_LANG_DNM_YES_START_DAY',	'OUI - avec jour limite' );
define( '_CAL_LANG_DNM_YES_EVENT_SDAY', 'OUI - si il y a un événement ET avec jour limite' );
define( '_CAL_LANG_DNM_ALWYS_IF_EVENTS','TOUJOURS - si il y a des évènements' );
	// start day
define( '_CAL_LANG_DNM_START_DAY',		"Jour du mois courant pour le début de l'affichage" );

// latest events module
define( '_CAL_LANG_LEV_MAX_DISPLAY',	"Nombre max d'évènements à afficher" );
define( '_CAL_LANG_LEV_DISPLAY_MODE',	"Mode d'affichage" );
define( '_CAL_LANG_LEV_DAY_RANGE',		'Jours avant et après' );
define( '_CAL_LANG_LEV_REP_EV_ONCE',	'Afficher un évènement répété seulement une fois' );
define( '_CAL_LANG_LEV_EV_AS_LINK',		'Afficher les évènements comme des liens' );
define( '_CAL_LANG_LEV_DISPLAY_YEAR',	"Afficher l'année" );
define( '_CAL_LANG_LEV_CSS_DATE_FIELD',	'Désactiver le style CSS par défaut pour le champ date' );
define( '_CAL_LANG_LEV_CSS_TITLE_FIELD','Désactiver le style CSS par défaut pour le champ titre' );
define( '_CAL_LANG_LEV_HIDE_LINK',		'Cacher le lien du titre');
define( '_CAL_LANG_LEV_CUST_FORM_STRING','Format de chaîne personnalisé' );

// tooltips frontpage (overlib)
define( '_CAL_LANG_TOOLTIP',			'Paramètres pour la boîte flottante dans la vue mensuelle' );
define( '_CAL_LANG_TT_MAINWINDOW',		'Fenêtre principale de la boîte' );
define( '_CAL_LANG_TT_BGROUND',			"Même fond que l'évènement" );
define( '_CAL_LANG_TT_POSX',			'Position horizontal' );
define( '_CAL_LANG_TT_POSY',			'Position vertical' );
define( '_CAL_LANG_TT_SHADOW',			'Ombre' );
define( '_CAL_LANG_TT_SHADOWX',			'A gauche' );
define( '_CAL_LANG_TT_SHADOWY',			'Au-dessus' );

// buttons
define( '_CAL_LANG_BTN_DEF_CONFIG',		'Recharger les valeurs par défaut' );

// installation
define( '_CAL_LANG_INSTAL_MAIN',		'Evènements' );
define( '_CAL_LANG_INSTAL_MANAGE',		'Gestion des événements' );
define( '_CAL_LANG_INSTAL_CATS',		'Gestion des catégories' );
define( '_CAL_LANG_INSTAL_CONFIG',		'Configuration' );
define( '_CAL_LANG_INSTAL_ARCHIVE',		'Archive' );
define( '_CAL_LANG_INSTAL_ERROR',		'Les erreurs suivantes se sont produites' );
define( '_CAL_LANG_INSTAL_SUCCESS',		'Composant Events correctement installé' );
define( '_CAL_LANG_INSTALL_DB_ENTRIES',	'Changements dans la base' );
define( '_CAL_LANG_INSTALL_PREV_INST',	'Doublons supprimés dans la base' );

DEFINE("_CAL_LANG_EVENT_ALLDAY","Toute la journée / heures inconnues");  // new for 1.4


?>

