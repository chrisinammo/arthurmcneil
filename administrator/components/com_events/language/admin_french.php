<?php
/**
 * Events Component for Joomla 1.5.x
 *
 * @version     $Id: admin_french.php 880 2007-10-31 19:16:08Z tstahl $
 * @package     Events
 * @copyright   Copyright (C) 2006-2007 JEvents Project Group
 * @copyright (C) 2000 - 2003 Eric Lamette, Dave McDonnell
 * @licence     http://www.gnu.org/copyleft/gpl.html
 * @link        http://joomlacode.org/gf/project/jevents
 */


defined( '_JEXEC' ) or die( 'Restricted access' );

//Check
if( defined( '_CAL_ADMIN_LANG_INCLUDED' )) {
	return;
}

DEFINE( '_CAL_ADMIN_LANG_INCLUDED', 1 );

/* +++++++++++++++++++ */
define( '_CAL_HIDE_OLD_EVENTS',			'Cacher les �v�nements pass�s'); // NEW 1.4
define( '_CAL_LANG_CATEGORIES',   		'Cat�gories' );
define( '_CAL_LANG_DISPLAY',			'Affichage' );
define( '_CAL_LANG_CATEGORY_NAME',		'Nom de la cat�gorie' );
define( '_CAL_LANG_RECORDS',			'des&nbsp;enregistrements' );
define( '_CAL_LANG_CHECKED_OUT',		'Rejet�' );
define( '_CAL_LANG_PUBLISHED',			'Publi�' );
define( '_CAL_LANG_NOT_PUBLISHED',		'Non Publi�' );
define( '_CAL_LANG_ACCESS',				'Acc�s' );
define( '_CAL_LANG_REORDER',			'R�ordonner' );
define( '_CAL_LANG_UNPUBLISH',			'D�publier' );
define( '_CAL_LANG_PUBLISH',			'Publier' );
define( '_CAL_LANG_CLICK_TO_EDIT',		'Cliquez pour �diter' );
define( '_CAL_LANG_MOVE_UP',			'Monter' );
define( '_CAL_LANG_MOVE_DOWN',			'Descendre' );
define( '_CAL_LANG_EDIT_CAT',			'Editer la cat�gorie' );
define( '_CAL_LANG_ADD_CAT',			'Ajouter la cat�gorie' );
define( '_CAL_LANG_CAT_TITLE',			'Titre de la cat�gorie' );
define( '_CAL_LANG_CAT_NAME',			'Nom de la cat�gorie' );
define( '_CAL_LANG_IMAGE',				'Image' );
define( '_CAL_LANG_PREVIEW',			'Pr�visualisation' );
define( '_CAL_LANG_IMG_POSITION',		"Position de l'image" );
define( '_CAL_LANG_ORDERING',			'Ordre' );
define( '_CAL_LANG_LEFT',				'Gauche' );
define( '_CAL_LANG_CENTER',				'Centre' );
define( '_CAL_LANG_RIGHT',				'Droite' );
define( '_CAL_LANG_SELECT_IMAGE',		"S�lectionner l'image" );
define( '_CAL_LANG_SEARCH',				"Recherche" );
define( '_CAL_LANG_TITLE',				"Titre" );
define( '_CAL_LANG_REPEAT',				"R�p�tition" );
define( '_CAL_LANG_TIME_SHEET',			'Feuille de temps' );
define( '_CAL_CLICK_TO_CHANGE_STATUS',	"Cliquer sur l'icone pour changer l'�tat" );
define( '_CAL_LANG_PUB_BUT_COMING',		'Publi�, mais <u>� venir</u>' );
define( '_CAL_LANG_PUB_ACTUAL',			'Publi� et <u>en cours</u>' );
define( '_CAL_LANG_PUB_FINISHED',		'Publi�, mais <u>est fini</u>' );
define( '_CAL_LANG_EDIT_EVENT',			"Editer l'�v�nement" );
define( '_CAL_LANG_ADD_EVENT',			'Ajouter un �v�nement' );
define( '_CAL_LANG_REQUIRED',			'obligatoire' );
define( '_CAL_LANG_IMG_FOLDER',			'Sous r�pertoire' );
define( '_CAL_LANG_IMAGES',				"Galerie d'images" );
define( '_CAL_LANG_AVAL_IMAGES',		'Images disponibles' );
define( '_CAL_LANG_INSERT_IMG',			'Ins�rer &raquo;' );
define( '_CAL_LANG_CONTENT_IMGS',		'Images s�lectionn�es' );
define( '_CAL_LANG_REMOVE',				'enlever' );
define( '_CAL_LANG_EDITED_SEL_IMG',		"Editer l'image s�lectionn�e" );
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
define( '_CAL_LANG_ADD_INFO',			'Information compl�mentaire' );
define( '_CAL_LANG_EVENT_STATUS',		"Etat de l'�v�nement" );
define( '_CAL_LANG_ARCHIVED',			'Archiv�' );
define( '_CAL_LANG_DRAFT_UNPUB',		'Brouillon non publi�' );
define( '_CAL_LANG_NEVER',				'Jamais' );
define( '_CAL_LANG_CUT_TITLE',			'Longueur du titre' );
define( '_CAL_LANG_MAX_DISPLAY',		'Ev�nements Max.' );
define( '_CAL_LANG_DIS_STARTTIME',		'Voir heure de d�but' );

	// config
define( '_CAL_LANG_EVENTS_CONFIG',		'Configuration JEvents' );
define( '_CAL_LANG_CONFIG_WRITEABLE',	'La configuration est modifiable' );
define( '_CAL_LANG_CONFIG_NOT_WRITEABLE',"La configuration n'est pas modifiable" );
define( '_CAL_LANG_CSS_WRITEABLE',		'Le fichier CSS est modifiable' );
define( '_CAL_LANG_CSS_NOT_WRITEABLE',	"Le fichier CSS n'est pas modifiable" );
define( '_CAL_LANG_ADMIN_EMAIL',		"Mail de l'admin" );
define( '_CAL_LANG_FRONTEND_PUBLISHING','Publication depuis le Frontend' );
define( '_CAL_LANG_SETT_FOR_COM',		'Ces param�tres concernent seulement le composant' );
define( '_CAL_LANG_SETT_FOR_CAL_MOD',	'Ces param�tres concernent seulement le module additionnel [ Calendar ]' );
define( '_CAL_LANG_SETT_FOR_MOD_LATEST','Ces param�tres concernent seulement le module additionnel  [ Latest Events ]' );
define( '_CAL_LANG_ICONIC_NAVBAR'		,'Utiliser la nouvelle barre de navigation avec des ic�nes'); // 1.4
define( '_CAL_LANG_CHECK_VERSION'		,"V�rifier une nouvelle version"); // 1.4

// errors
define( '_CAL_LANG_ERR_CAT_MUST_HAVE_NAME',	'Une cat�gorie doit avoir un nom' );

// title & alts
define( '_CAL_LANG_TIT_NAME_FOR_MENUS',	'Un nom court � afficher dans les menus' );
define( '_CAL_LANG_TIT_LONG_NAME',		'Un nom long � afficher dans les en-t�tes' );
define( '_CAL_LANG_TIT_PENDING',		'En attente' );

// msgs
define( '_CAL_LANG_MSG_CAT_IS_EDITED',	'La cat�gorie [ %s ] est actuellement �dit�e par un autre administrateur' ); // %s = $row->title
define( '_CAL_LANG_MSG_OP_FAILED',		"Echec de l'op�ration: Impossible d'ouvrir [ %s ]" ); // %s = $filename
define( '_CAL_LANG_MSG_CHANGE_EMAIL',	"Aller d'abord � la section de configuration et changer l'adresse email" );
define( '_CAL_LANG_MSG_ADD_CAT_BEFORE',	"Vous devez d'abord ajouter une cat�gorie pour cette section" );
define( '_CAL_LANG_MSG_CONFIG_SAVED',	'Configuration correctement sauvegard�e' );
define( '_CAL_LANG_MSG_WARNING',		'Avertissement...' );
define( '_CAL_LANG_MSG_CHMOD_CONFIG',	'Vous devez passer le fichier de configuration en chmod 0777 pour pouvoir mettre � jour la configuration' );
define( '_CAL_LANG_MSG_CHMOD_CSS',		'Vous devez passer le fichier de css en chmod 0777 pour pouvoir mettre � jour la configuration' );
define( '_CAL_LANG_MSG_MOD_NOT_INSTALLED',"Le module [ calendar ] n'est pas install�" );
define( '_CAL_LANG_MSG_NO_MOD_LATEST',	"Le module [ latest events ] n'est pas install�" );

// tips
define( '_CAL_LANG_TIP_ACCESS',			'Qui est autoris� � cr�er des nouveaux �v�nements' );
define( '_CAL_LANG_TIP_FRONT_PUB',		"Autoriser les publieurs, managers et administrateurs � publier le contenu depuis l\'interface publique" );
define( '_CAL_LANG_TIP_NR_OF_LIST',		"Nombre d\'�v�nements � lister par page pour les vues par semaine, mois ou ann�e" );
define( '_CAL_LANG_TIP_FE_SIMPLE_FORM',	"Utiliser sur l\'interface publique le formulaire simplifi� de saisie d\'�v�nements (sans les options de r�p�tition)" );
define( '_CAL_LANG_TIP_DEF_EC_HIDE_FORCE',	"<b>Couleur sp�cifique d\'�v�nement autoris�e</b><br/>Les interfaces publique et d\'administration peuvent utiliser les couleurs sp�cifiques par �v�nement<br/><b>Couleur d\'�v�nement seulement dans l\'interface d\'administration</b><br/>Seule l\'interface d\'administration permet de choisir les couleurs sp�cifiques par �v�nement<br/><b>Toujours utiliser la couleur de la cat�gorie</b><br/>Les interfaces ne peuvent pas utiliser les couleurs sp�cifiques par �v�nement, toutes les couleurs par �v�nement sp�cifi�es avant le r�glage de ce param�tre seront ignor�es et la couleur de la cat�gorie sera utilis�e � la place" );
define( '_CAL_LANG_TIP_DLM_STOP_DAY',		"Jour du mois en cours � partir duquel d�sactiver l\'affichage du mois pr�c�dent" );
define( '_CAL_LANG_TIP_DNM_START_DAY',		"Jours restants dans le mois en cours pour commencer l\'affichage du mois suivant" );
define( '_CAL_LANG_TIP_LEV_DAY_RANGE',		"Marge par rapport au jour actuel pour afficher les �v�nements (modes 2 ou 3 seulement)" );
define( '_CAL_LANG_TIP_LEV_DISPLAY_YEAR',	"Afficher l\'ann�e dans la date de l\'�v�nement (format par d�faut seulement)" );
define( '_CAL_LANG_TIP_BTN_DEF_CONFIG',		"Recharger les valeurs par d�faut [au cas o� quelque chose aille de travers]" );
define( '_CAL_LANG_TIP_LEV_DISPLAY_MODE',   "<b>mode 0</b> (par d�faut)<br />affiche les �v�nements les plus proches pour la semaine en cours et la semaine suivante seulement jusqu\'au nombre maximum d\'�v�nements<br /><b>mode 1</b><br />identique au mode 0 sauf que les �v�nements pass�s de la semaine en cours seront aussi affich�s si le nombre d\'�v�nements � venir est moins grand que le nombre maximum d\'�v�nements<br /><b>mode 2</b><br />affiche les �v�nements les plus proches devant se produire dans les prochains jours (en utilisant la marge des jours apr�s choisie) et dans la limite du nombre d\'�v�nements maximum<br /><b>mode 3</b><br />identique au mode 2 sauf si il y a moins d\'�v�nements que le nombre maximum dans les prochains jours auquel cas affiche �galement les �v�nements pass�s (avec la marge des jours avant)<br /><b>mode 4</b><br />affiche les �v�nements les plus proches du mois en cours relativement au jour actuel et jusqu\'au nombre maximal" );
define( '_CAL_LANG_TIP_CUT_TITLE',			"Si un titre contient trop de caract�res, l\'affichage peut �tre d�grad�.<br />D�finir ici le nombre de caract�res � partir duquel le titre sera coup� et ... ajout�" );
define( '_CAL_LANG_TIP_LEV_HIDE_LINK',		"Si r�gl� � OUI, le lien du titre sera automatiquement rempli par l\'�v�nement javascript &lt;b&gt;onclick&lt;/b&gt;. Cela emp�che les moteurs de recherche de suivre ce lien");
define( '_CAL_LANG_TIP_MAX_DISPLAY',		"Nombre total d\'�v�nements affich�s <strong>en tant que texte</strong> pour chaque jour dans la vue mensuelle<br />Si il y a trop d\'�v�nements affich�s chaque jour, l\'affichage peut �tre d�grad�.<br />D�finir ici combien d\'�v�nements doivent �tre affich�s comme texte, si il y en a trop ils seront affich�s en ic�nes (la bo�te flottante n\'est pas affect�e)<br /><strong>Astuce</strong>: R�gler la valeur � 0 force l\'affichage de tous les �v�nements en ic�nes" );
define( '_CAL_LANG_TIP_DIS_STARTTIME',		"Affichage de l\'heure de d�but dans la vue mensuelle" );
	// tooltips
define( '_CAL_LANG_TIP_TT_BGROUND',			"La bo�te flottante doit-elle utiliser le m�me fond que l\�v�nement ?<br />Si non, la couleur standard sera utilis�e" );
define( '_CAL_LANG_TIP_TT_POSX',			"La position horizontale de la fen�tre flottante peut �tre � gauche, au centre ou � droite" );
define( '_CAL_LANG_TIP_TT_POSY',			"La position verticale de la fen�tre flottante peut �tre en-dessous ou au-dessus" );
define( '_CAL_LANG_TIP_TT_SHADOW',			"La fen�tre flottante peut avoir une ombre positionn�e horizontalement � gauche ou � droite et verticalement en-dessous ou au-dessus" );

// tabs
define( '_CAL_LANG_TAB_COMMON',			'G�n�ral' );
define( '_CAL_LANG_TAB_IMAGES',			'Images' );
define( '_CAL_LANG_TAB_CALENDAR',		'Calendrier' );
define( '_CAL_LANG_TAB_HELP',			'Aide' );
define( '_CAL_LANG_TAB_EXTRA',			'Statistiques' );
define( '_CAL_LANG_TAB_ABOUT',			'A propos' );
define( '_CAL_LANG_TAB_COMPONENT',		'Composant' );
define( '_CAL_LANG_TAB_CAL_MOD',		'Calendar' );
define( '_CAL_LANG_TAB_LATEST_MOD',		'Latest Events' );
define( '_CAL_LANG_TAB_CSS',			'CSS' );
define( '_CAL_LANG_TAB_TOOLTIP',		'Bo�te flottante' );

// select lists
	//common
define( '_CAL_LANG_YES',				'Oui' );
define( '_CAL_LANG_NO',					'Non' );
define( '_CAL_LANG_ALWAYS',				'TOUJOURS' );
	// access
define( '_CAL_LANG_SEL_ACCESS_ALL_REGGED',	'Tous les utilisateurs enregistr�s' );
define( '_CAL_LANG_SEL_ACCESS_SPECIAL',		'Seulement les droits sp�ciaux et admins' );
define( '_CAL_LANG_SEL_ACCESS_ALL_ANONYM',	'Tous (anonymes) - non recommand�' );
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
define( '_CAL_LANG_VIEW_REPEAT_TIME',	'Voir R�p�tition et heure' );
define( '_CAL_LANG_VIEW_REPEAT_YEAR_LIST',	'Voir tous les �v�nements r�p�t�s dans la liste annuelle' );
define( '_CAL_LANG_SHOW_CATS',			'Cacher "Voir par cat�gories" (appropri� si le module "Events legend" est affich�)' );
define( '_CAL_LANG_SHOW_COPYRIGHT',		'Voir le copyright en pied de page');
	// date format
define( '_CAL_LANG_DATE_FORMAT',		'Format de la date' );
define( '_CAL_LANG_DATE_FORMAT_FR_EN',	'Fran�ais-Anglais' );
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
define( '_CAL_LANG_START_PAGE',			"Page d'entr�e" );
define( '_CAL_LANG_SP_DAY',				'Jour' );
define( '_CAL_LANG_SP_WEEK',			'Semaine' );
define( '_CAL_LANG_SP_MONTH_CAL',		'Mois (Calendrier)' );
define( '_CAL_LANG_SP_MONTH_LIST',		'Mois (Liste)' );
define( '_CAL_LANG_SP_YEAR',			'Ann�e' );
define( '_CAL_LANG_SP_CATEGORIES',		'Cat�gories' );
define( '_CAL_LANG_SP_SEARCH',			'Recherche' );

define( '_CAL_LANG_NR_OF_LIST',			"Nb d'�v�nements" );
define( '_CAL_LANG_FE_SIMPLE_FORM',		'Utiliser formulaire simple' );
	// event color
define( '_CAL_LANG_DEF_EVENT_COLOR',	'Couleur par d�faut des �v�nements' );
define( '_CAL_LANG_DEF_EC_RANDOM',		'Hasard' );
define( '_CAL_LANG_DEF_EC_NONE',		'Aucune' );
define( '_CAL_LANG_DEF_EC_CATEGORY',	'Cat�gorie' );
define( '_CAL_LANG_DEF_EC_HIDE_FORCE',	'R�gle pour la couleur des �v�nements' );
define( '_CAL_LANG_EVENT_COLS_ALLOWED',	"Couleur sp�cifique d'�v�nement autoris�e" );
define( '_CAL_LANG_EVENT_COLS_BACKED',	"Couleur d'�v�nement seulement dans l'interface d'administration" );
define( '_CAL_LANG_ALWAYS_CAT_COLOR',	"Toujours utiliser la couleur de la cat�gorie" );

	// tooltips
define( '_CAL_LANG_ABOVE',				'Au-dessus' );
define( '_CAL_LANG_BELOW',				'En-dessous' );

// calendar module
	// display last month
define( '_CAL_LANG_DISPLAY_LAST_MONTH',	'Afficher le mois pr�c�dent' );
define( '_CAL_LANG_DLM_YES_STOP_DAY',	'OUI - avec jour limite' );
define( '_CAL_LANG_DLM_YES_EVENT_SDAY',	'OUI - si il y a un �v�nement ET avec jour limite' );
define( '_CAL_LANG_DLM_ALWYS_IF_EVENTS','TOUJOURS - si il y a des �v�nements' );
	// stop day
define( '_CAL_LANG_DLM_STOP_DAY',		"Jour du mois courant pour l'arr�t de l'affichage" );
	// display next month
define( '_CAL_LANG_DISPLAY_NEXT_MONTH',	'Afficher le mois prochain' );
define( '_CAL_LANG_DNM_YES_START_DAY',	'OUI - avec jour limite' );
define( '_CAL_LANG_DNM_YES_EVENT_SDAY', 'OUI - si il y a un �v�nement ET avec jour limite' );
define( '_CAL_LANG_DNM_ALWYS_IF_EVENTS','TOUJOURS - si il y a des �v�nements' );
	// start day
define( '_CAL_LANG_DNM_START_DAY',		"Jour du mois courant pour le d�but de l'affichage" );

// latest events module
define( '_CAL_LANG_LEV_MAX_DISPLAY',	"Nombre max d'�v�nements � afficher" );
define( '_CAL_LANG_LEV_DISPLAY_MODE',	"Mode d'affichage" );
define( '_CAL_LANG_LEV_DAY_RANGE',		'Jours avant et apr�s' );
define( '_CAL_LANG_LEV_REP_EV_ONCE',	'Afficher un �v�nement r�p�t� seulement une fois' );
define( '_CAL_LANG_LEV_EV_AS_LINK',		'Afficher les �v�nements comme des liens' );
define( '_CAL_LANG_LEV_DISPLAY_YEAR',	"Afficher l'ann�e" );
define( '_CAL_LANG_LEV_CSS_DATE_FIELD',	'D�sactiver le style CSS par d�faut pour le champ date' );
define( '_CAL_LANG_LEV_CSS_TITLE_FIELD','D�sactiver le style CSS par d�faut pour le champ titre' );
define( '_CAL_LANG_LEV_HIDE_LINK',		'Cacher le lien du titre');
define( '_CAL_LANG_LEV_CUST_FORM_STRING','Format de cha�ne personnalis�' );

// tooltips frontpage (overlib)
define( '_CAL_LANG_TOOLTIP',			'Param�tres pour la bo�te flottante dans la vue mensuelle' );
define( '_CAL_LANG_TT_MAINWINDOW',		'Fen�tre principale de la bo�te' );
define( '_CAL_LANG_TT_BGROUND',			"M�me fond que l'�v�nement" );
define( '_CAL_LANG_TT_POSX',			'Position horizontal' );
define( '_CAL_LANG_TT_POSY',			'Position vertical' );
define( '_CAL_LANG_TT_SHADOW',			'Ombre' );
define( '_CAL_LANG_TT_SHADOWX',			'A gauche' );
define( '_CAL_LANG_TT_SHADOWY',			'Au-dessus' );

// buttons
define( '_CAL_LANG_BTN_DEF_CONFIG',		'Recharger les valeurs par d�faut' );

// installation
define( '_CAL_LANG_INSTAL_MAIN',		'Ev�nements' );
define( '_CAL_LANG_INSTAL_MANAGE',		'Gestion des �v�nements' );
define( '_CAL_LANG_INSTAL_CATS',		'Gestion des cat�gories' );
define( '_CAL_LANG_INSTAL_CONFIG',		'Configuration' );
define( '_CAL_LANG_INSTAL_ARCHIVE',		'Archive' );
define( '_CAL_LANG_INSTAL_ERROR',		'Les erreurs suivantes se sont produites' );
define( '_CAL_LANG_INSTAL_SUCCESS',		'Composant Events correctement install�' );
define( '_CAL_LANG_INSTALL_DB_ENTRIES',	'Changements dans la base' );
define( '_CAL_LANG_INSTALL_PREV_INST',	'Doublons supprim�s dans la base' );

DEFINE("_CAL_LANG_EVENT_ALLDAY","Toute la journ�e / heures inconnues");  // new for 1.4


?>

