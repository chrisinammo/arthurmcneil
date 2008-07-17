<?php
/**
 * Events Component for Joomla 1.0.x
 *
 * @version     $Id: french-utf8.php 991 2008-03-10 19:55:48Z tstahl $
 * @package     Events
 * @copyright   Copyright (C) 2006-2008 JEvents Project Group
 * @licence     http://www.gnu.org/copyleft/gpl.html
 * @link        http://joomlacode.org/gf/project/jevents
 * @encoding    utf-8
 */

defined("_VALID_MOS") or die("Direct Access to this location is not allowed");

//Check
DEFINE("_CAL_LANG_INCLUDED", 1);

// new 1.4.0 [mic]
define("_CAL_LANG_LNG",				"fr"); // de|fr|etc... [ DO NOT CHANGE THIS VALUE! ]

// used for colorpicker
define("_CAL_LANG_NO_COLOR",			"Pas de couleur");
define("_CAL_LANG_COLOR_PICKER",		"Palette de couleurs");

// common
define("_CAL_LANG_TIME",				"Heure");
define("_CAL_LANG_CLICK_TO_OPEN_EVENT",	"Cliquez pour éditer un évènement");
define("_CAL_LANG_UNPUBLISHED",		"** Non publié **");
define("_CAL_LANG_DESCRIPTION",		"Description");
define("_CAL_LANG_EMAIL_TO_AUTHOR",	"Envoyer un email à l'auteur");
define("_CAL_LANG_MAIL_TO_ADMIN",		"Evènement soumis le [ %s ] par [ %s ]");
define("_CAL_LANG_KEYWORD_NOT_VALID",	"Mot-clé non valide");
define("_CAL_LANG_EVENT_CALENDAR",		"Calendrier d'évènements"); // new 1.4

// modul
define("_CAL_LANG_ERR_NO_MOD_CAL",		"Events Calendar\n<br />Ce module nécessite le composant Events");
define("_CAL_LANG_CLICK_TOSWITCH_DAY",	"Voir le calendrier - jour actuel");
define("_CAL_LANG_CLICK_TOSWITCH_MON",	"Voir le calendrier - mois actuel");
define("_CAL_LANG_CLICK_TOSWITCH_YEAR",	"Voir le calendrier - année actuelle");
define("_CAL_LANG_CLICK_TOSWITCH_PY",	"Voir le calendrier - année précédente");
define("_CAL_LANG_CLICK_TOSWITCH_PM",	"Voir le calendrier - mois précédent");
define("_CAL_LANG_CLICK_TOSWITCH_NM",	"Voir le calendrier - mois prochain");
define("_CAL_LANG_CLICK_TOSWITCH_NY",	"Voir le calendrier - année prochaine");

// navTableNext
define("_CAL_LANG_NAV_TN_FIRST_LIST",	"première liste");
define("_CAL_LANG_NAV_TN_PREV_LIST",	"liste précédente");
define("_CAL_LANG_NAV_TN_NEXT_LIST",	"liste suivante");
define("_CAL_LANG_NAV_TN_LAST_LIST",	"dernière liste");

// calendar monthly display
define("_CAL_LANG_FIRST_SINGLE_DAY_EVENT",		"Evènement journalier");
define("_CAL_LANG_FIRST_DAY_OF_MULTIEVENT",	"Premier jour d'un évènement de plusieurs jours");
define("_CAL_LANG_LAST_DAY_OF_MULTIEVENT",		"Dernier jour d'un évènement de plusieurs jours");
define("_CAL_LANG_MULTIDAY_EVENT",				"Evènement de plusieurs jours");
/* ++++++ end mic +++++++++++++ */

// Months
DEFINE("_CAL_LANG_JANUARY", "Janvier");
DEFINE("_CAL_LANG_FEBRUARY", "Février");
DEFINE("_CAL_LANG_MARCH", "Mars");
DEFINE("_CAL_LANG_APRIL", "Avril");
DEFINE("_CAL_LANG_MAY", "Mai");
DEFINE("_CAL_LANG_JUNE", "Juin");
DEFINE("_CAL_LANG_JULY", "Juillet");
DEFINE("_CAL_LANG_AUGUST", "Août");
DEFINE("_CAL_LANG_SEPTEMBER", "Septembre");
DEFINE("_CAL_LANG_OCTOBER", "Octobre");
DEFINE("_CAL_LANG_NOVEMBER", "Novembre");
DEFINE("_CAL_LANG_DECEMBER", "Décembre");

// Short day names
DEFINE("_CAL_LANG_SUN", "Dim");
DEFINE("_CAL_LANG_MON", "Lun");
DEFINE("_CAL_LANG_TUE", "Mar");
DEFINE("_CAL_LANG_WED", "Mer");
DEFINE("_CAL_LANG_THU", "Jeu");
DEFINE("_CAL_LANG_FRI", "Ven");
DEFINE("_CAL_LANG_SAT", "Sam");

// Days
DEFINE("_CAL_LANG_SUNDAY", "Dimanche");
DEFINE("_CAL_LANG_MONDAY", "Lundi");
DEFINE("_CAL_LANG_TUESDAY", "Mardi");
DEFINE("_CAL_LANG_WEDNESDAY", "Mercredi");
DEFINE("_CAL_LANG_THURSDAY", "Jeudi");
DEFINE("_CAL_LANG_FRIDAY", "Vendredi");
DEFINE("_CAL_LANG_SATURDAY", "Samedi");

// Days lettres
DEFINE("_CAL_LANG_SUNDAYSHORT", "D");
DEFINE("_CAL_LANG_MONDAYSHORT", "L");
DEFINE("_CAL_LANG_TUESDAYSHORT", "M");
DEFINE("_CAL_LANG_WEDNESDAYSHORT", "M");
DEFINE("_CAL_LANG_THURSDAYSHORT", "J");
DEFINE("_CAL_LANG_FRIDAYSHORT", "V");
DEFINE("_CAL_LANG_SATURDAYSHORT", "S");

// Repeat type
DEFINE("_CAL_LANG_ALLDAYS", "Tous les jours");
DEFINE("_CAL_LANG_EACHWEEK", "Toutes les semaines");
DEFINE("_CAL_LANG_EACHWEEKPAIR", "Toutes les semaines paires");
DEFINE("_CAL_LANG_EACHWEEKIMPAIR", "Toutes les semaines impaires");
DEFINE("_CAL_LANG_EACHMONTH", "Tous les mois");
DEFINE("_CAL_LANG_EACHYEAR", "Tous les ans");
DEFINE("_CAL_LANG_ONLYDAYS", "Seulement les jours choisis");
DEFINE("_CAL_LANG_EACH", "Chaque");
DEFINE("_CAL_LANG_EACHOF","de chaque");
DEFINE("_CAL_LANG_ENDMONTH", "fin du mois");

// Repeat days
DEFINE("_CAL_LANG_BYDAYNUMBER", "Par numéro du jour");

// User type
DEFINE("_CAL_LANG_ANONYME", "Anonyme");

// Post
//PAS D'ACCENTS DANS LES _ACT_
DEFINE("_CAL_LANG_ACT_ADDED", "Merci pour votre envoi - Nous allons verifier votre proposition !"); //NO ACCENT !!
DEFINE("_CAL_LANG_ACT_MODIFIED", "Cet evenement a ete modifie."); //NO ACCENT !!
DEFINE("_CAL_LANG_ACT_PUBLISHED", "Cet evenement a ete publie.");  //NEW 1.4
DEFINE("_CAL_LANG_ACT_DELETED", "Cet evenement est efface !"); //NO ACCENT !!
DEFINE("_CAL_LANG_NOPERMISSION", "Vous n'avez pas acces a ce service !"); //NO ACCENT !!

DEFINE("_CAL_LANG_MAIL_ADDED", "Nouvelle soumission sur");
DEFINE("_CAL_LANG_MAIL_MODIFIED", "Nouvelle modification sur");

// Presentation
DEFINE("_CAL_LANG_BY", "par");
DEFINE("_CAL_LANG_FROM", "Du");
DEFINE("_CAL_LANG_TO", "Au");
DEFINE("_CAL_LANG_ARCHIVE", "Archives");
DEFINE("_CAL_LANG_WEEK", "la semaine");
DEFINE("_CAL_LANG_NO_EVENTS", "Pas d'événements");
DEFINE("_CAL_LANG_NO_EVENTFOR", "Pas d'activité pour");
DEFINE("_CAL_LANG_NO_EVENTFORTHE", "Pas d'activité pour le");
DEFINE("_CAL_LANG_THIS_DAY", "ce jour");
DEFINE("_CAL_LANG_THIS_MONTH", "Ce mois");
DEFINE("_CAL_LANG_LAST_MONTH", "Le mois dernier");
DEFINE("_CAL_LANG_NEXT_MONTH", "Mois suivant");
DEFINE("_CAL_LANG_EVENTSFOR", "Evènements pour");
DEFINE("_CAL_LANG_SEARCHRESULTS", "Résultats de la recherche pour le mot-clé"); // new 1.4
DEFINE("_CAL_LANG_EVENTSFORTHE", "Evènements pour le");
DEFINE("_CAL_LANG_REP_DAY", "jour");
DEFINE("_CAL_LANG_REP_WEEK", "semaine");
DEFINE("_CAL_LANG_REP_WEEKPAIR", "semaine paire");
DEFINE("_CAL_LANG_REP_WEEKIMPAIR", "semaine impaire");
DEFINE("_CAL_LANG_REP_MONTH", "mois");
DEFINE("_CAL_LANG_REP_YEAR", "année");
DEFINE("_CAL_LANG_REP_NOEVENTSELECTED", "Choissisez d'abord un évènement");

// Navigation
DEFINE("_CAL_LANG_VIEWTODAY", "Aujourd'hui");
DEFINE("_CAL_LANG_VIEWTOCOME", "Prochainement");
DEFINE("_CAL_LANG_VIEWBYDAY", "Vue par jour");
DEFINE("_CAL_LANG_VIEWBYCAT", "Vue par catégories");
DEFINE("_CAL_LANG_VIEWBYMONTH", "Vue par mois");
DEFINE("_CAL_LANG_VIEWBYYEAR", "Vue par an");
DEFINE("_CAL_LANG_VIEWBYWEEK", "Vue par semaine");
DEFINE("_CAL_LANG_JUMPTO", "Aller à un mois donné");  // New 1.4
DEFINE("_CAL_LANG_BACK", "Retour");
DEFINE("_CAL_LANG_CLOSE", "Fermer");
DEFINE("_CAL_LANG_PREVIOUSDAY", "Jour precedent");
DEFINE("_CAL_LANG_PREVIOUSWEEK", "Semaine precedente");
DEFINE("_CAL_LANG_PREVIOUSMONTH", "Mois précédent");
DEFINE("_CAL_LANG_PREVIOUSYEAR", "Année précédente");
DEFINE("_CAL_LANG_NEXTDAY", "Jour suivant");
DEFINE("_CAL_LANG_NEXTWEEK", "Semaine suivante");
DEFINE("_CAL_LANG_NEXTMONTH", "Mois suivant");
DEFINE("_CAL_LANG_NEXTYEAR", "Année suivante");

DEFINE("_CAL_LANG_ADMINPANEL", "Panneau d'administration");
DEFINE("_CAL_LANG_ADDEVENT", "Ajouter un évènement");
DEFINE("_CAL_LANG_MYEVENTS", "Mes évènements");
DEFINE("_CAL_LANG_DELETE", "Effacer");
DEFINE("_CAL_LANG_MODIFY", "Modifier");

// Form
DEFINE("_CAL_LANG_HELP", "Aide");

DEFINE("_CAL_LANG_CAL_TITLE", "Evènements");
DEFINE("_CAL_LANG_ADD_TITLE", "Ajouter");
DEFINE("_CAL_LANG_MODIFY_TITLE", "Modifier");

DEFINE("_CAL_LANG_REPEAT_DISABLED", "XXXXEvent Repeating is only applicable if End Date is after Start Date.  Change End Date before configuring event repeat details."); // New for 1.4
DEFINE("_CAL_LANG_EVENT_TITLE", "Sujet");
DEFINE("_CAL_LANG_EVENT_COLOR", "Couleur");
DEFINE("_CAL_LANG_EVENT_CATCOLOR", "Utiliser la couleur de la catégorie par défaut");
DEFINE("_CAL_LANG_EVENT_CATEGORY", "Catégories");
DEFINE("_CAL_LANG_EVENT_CHOOSE_CATEG", "Veuillez choisir une catégorie");
DEFINE("_CAL_LANG_EVENT_ACTIVITY", "Activité");
DEFINE("_CAL_LANG_EVENT_URLMAIL_INFO", "Pour ajouter une URL ou un mail, écrivez simplement <u>http://www.mysite.com</u> ou <u>mailto:my@mail.com</u>");
DEFINE("_CAL_LANG_EVENT_ADRESSE", "Lieu");
DEFINE("_CAL_LANG_EVENT_CONTACT", "Contact");
DEFINE("_CAL_LANG_EVENT_EXTRA", "Infos complémentaires");
DEFINE("_CAL_LANG_EVENT_AUTHOR_ALIAS", "Auteur (alias)");
DEFINE("_CAL_LANG_EVENT_STARTDATE", "Date de début");
DEFINE("_CAL_LANG_EVENT_ENDDATE", "Date de fin");
DEFINE("_CAL_LANG_EVENT_STARTHOURS", "Heure de début");
DEFINE("_CAL_LANG_EVENT_ENDHOURS", "Heure de fin");
DEFINE("_CAL_LANG_EVENT_STARTTIME", "Heure de début");
DEFINE("_CAL_LANG_EVENT_ENDTIME", "Heure de fin");
DEFINE("_CAL_LANG_PUB_INFO", "Informations de publication");
DEFINE("_CAL_LANG_EVENT_REPEATTYPE", "Type de récurrence");
DEFINE("_CAL_LANG_EVENT_REPEATDAY", "Jour de récurrence");
DEFINE("_CAL_LANG_EVENT_CHOOSE_WEEKDAYS", "Jours de la semaine");
DEFINE("_CAL_LANG_EVENT_PER", "par");
DEFINE("_CAL_LANG_EVENT_WEEKOPT", "Répétition des semaines dans le mois");

DEFINE("_CAL_LANG_SUBMITPREVIEW", "Prévisualiser");
DEFINE("_CAL_LANG_SUBMITCANCEL", "Annuler");
DEFINE("_CAL_LANG_SUBMITSAVE", "Sauvegarder");

DEFINE("_CAL_LANG_E_WARNWEEKS", "Veuillez choisir une semaine.");
DEFINE("_CAL_LANG_E_WARNDAYS", "Veuillez choisir un jour.");

// Admin
DEFINE("_CAL_LANG_EVENT_ALLCAT", "Toutes les catégories");
DEFINE("_CAL_LANG_EVENT_ACCESSLEVEL", "Niveau d'accès");
DEFINE("_CAL_LANG_EVENT_HITS", "Vues");
DEFINE("_CAL_LANG_EVENT_STATE", "Etat");
DEFINE("_CAL_LANG_EVENT_CREATED", "Créé le");
DEFINE("_CAL_LANG_EVENT_NEWEVENT", "Nouvel évènement");
DEFINE("_CAL_LANG_EVENT_MODIFIED", "Dernière modification le");
DEFINE("_CAL_LANG_EVENT_NOTMODIFIED", "Non modifié");

// dmcd aug 22/04  new warning alert for no specified activity in event entry
DEFINE("_CAL_LANG_WARNACTIVITY", "Some sort of Activity\\ndescription must be entered.");

DEFINE("_CAL_LEGEND_ALL_CATEGORIES", "Toutes les catégories ...");  // new for 1.4
DEFINE("_CAL_LEGEND_ALL_CATEGORIES_DESC", "Voir les évènements de toutes les catégories");  // new for 1.4

DEFINE("_CAL_LANG_FORM_HELP_COLOR", <<<END
        <tr>
		  <td width="110" align="left" valign="top">
            <b>Couleur</b>
          </td>
          <td>Choisir la couleur de fond qui sera visible dans la vue mensuelle du calendrier. Si la case catégorie est cochée,
		  la couleur sélectionnée sera celle de la catégorie (définie par l'administrateur) qui est choisie sur le formulaire de saisie de l'évènement, et le
		  bouton 'Sélecteur de couleur' sera désactivé.</td>
        </tr>
END
);

DEFINE("_CAL_LANG_FORM_HELP",  <<<END
    	<tr>
          <td align="left"><b>Date de début/fin</b></td>
          <td>Choisir la date de début et de fin de votre évènement.</td>
        </tr>
    	<tr>
          <td align="left" valign="top"><b>Heure de début/fin</b></td>
          <td>Choisir l'heure du jour pour votre évènement. Le format est <span style='color:blue;font-weight:bold;'>hh:mm {am|pm}</span>.<br/>L'heure peut être spécifiée en suivant le format 12h ou 24h.<br/><br/><b><i><span style='color:red;'>(Nouveau)</span></i> Notez</b> qu'un cas particulier peut arriver pour <span style='color:red;font-weight:bold;'>un évènement sur un seul jour au cours de la nuit</span>. Par exemple pour un évènement qui commence à 19:00 et qui termine à 3:00 du matin, les dates de début et de fin <b>DOIVENT</b> être&nbsp;
		   le même jour, et réglés à la date correspondant au jour avant minuit.</td>
        </tr>
END
);

DEFINE("_CAL_LANG_FORM_HELP_EXTENDED",  <<<END
        <tr>
    	  <td align="left" valign="top" nowrap><b>Type de récurrence</b></td>
  	  	<td colspan="2"></td>
  		</tr>
  		<tr>
    	  <td colspan="2" align="left" valign="top">
	    	<table width="100%" border="0" cellspacing="2">
              <tr>
                <td width="60" align="left" valign="top"><u>Par Jour</u></td>
                <td width="110" align="left" valign="top" class="frm_td_bydays">
                  <font color="#000000">Tous les jours<br/><i>(default)</i></font>
                </td>
                <td align="left" valign="top" class="frm_td_bydays">
                  <font color="#000000">Choisir cette option pour un évènement non répété sur un ou plusieurs jours, ou un évènement répété avec une nouvelle occurrence pour chaque jour entre la date de début et la date de fin</font>
                </td>
              </tr>
              <tr>
                <td width="60" rowspan="3" align="left" valign="top"><u>Par Semaine</u></td>
                <td width="110" align="left" valign="top" class="frm_td_byweeks">
                  <font color="#000000">
                    1 * par semaine
                  </font>
                </td>
                <td align="left" valign="top" class="frm_td_byweeks">
                  <font color="#000000">
                  Cette option permet de choisir le jour de la semaine pour la répétition
                  <table border="0" width="100%" height="100%"><tr><td><b>Numéro du jour</b> pour répéter par exemple chaque 1er jour de la semaine</td></tr><tr><td><b>Nom du jour</b> pour répéter par exemple chaque Lundi</td></tr></table>
                  </font>
                </td>
              </tr>
              <tr>
                <td width="110" align="left" valign="top" class="frm_td_byweeks">
                  <font color="#000000">
                    n * par semaine
                  </font>
                </td>
                <td align="left" valign="top" class="frm_td_byweeks">
                  <font color="#000000">Cette option permet de choisir quels jours de chaque semaine votre évènement sera visible.</font>
                </td>
              </tr>
              <tr>
                <td width="110" align="left" valign="top" class="frm_td_byweeks">
                  <font color="#000000"><i>Répétition des semaines dans le mois # <br>Pour les options '1 * par semaine' et 'n * par semaine' ci-dessus</i></font></td>
                  <td align="left" valign="top" class="frm_td_byweeks">
                  <font color="#000000">
                  <table border="0" width="100%" height="100%">
                    <tr><td><b>Semaine 1 :</b> 1ère semaine du mois</td></tr>
                    <tr><td><b>Semaine 2 :</b> 2ème semaine du mois</td></tr>
                    <tr><td><b>Semaine 3 :</b> 3ème semaine du mois</td></tr>
                    <tr><td><b>Semaine 4 :</b> 4ème semaine du mois</td></tr>
                    <tr><td><b>Semaine 5 :</b> 5ème semaine du mois (si applicable)</td></tr>
                   </table>
                 </font>
                </td>
              </tr>
              <tr>
                <td width="60" rowspan="2" align="left" valign="top"><u>Par mois</u></td>
                <td width="110" align="left" valign="top" class="frm_td_bymonth">
                  <font color="#000000">1 * par mois</font></td>
                <td align="left" valign="top" class="frm_td_bymonth">
                  <font color="#000000">
                     Cette option permet de choisir le jour du mois pour la répétition
                     <table border="0" width="100%" height="100%"><tr><td><b>Numéro du jour</b> pour répéter par exemple chaque 10/??/????</td></tr><tr><td><b>Nom du jour</b> pour répéter par exemple chaque Lundi de la même semaine</td></tr></table>

                  </font>
                </td>
              </tr>
              <tr>
                <td width="110" align="left" valign="top" class="frm_td_bymonth">
                  <font color="#000000">
                  Chaque fin de chaque mois
                  </font>
                </td>
                <td align="left" valign="top" class="frm_td_bymonth">
                  <font color="#000000">
				   Cet évènement se déroule chaque dernier jour du mois, indépendamment du numéro du jour, si ce dernier jour
		tombe entre les dates spécifiées pour la fin et le début de cet évènement.
                  </font>
                </td>
              </tr>
              <tr>
                <td width="60" rowspan="2" align="left" valign="top"><u>Par année</u></td>
                <td width="110" align="left" valign="top" class="frm_td_byyear">
                  <font color="#000000">
                  1 * par année
                  </font>
                </td>
                <td align="left" valign="top" class="frm_td_byyear">
                  <font color="#000000">
                  Cette option permet de choisir un jour unique chaque année
                  <table border="0" width="100%" height="100%"><tr><td><b>Numéro du jour</b> pour répéter par exemple chaque 10/10/????</td></tr><tr><td><b>Nom du jour</b> pour répéter par exemple chaque Lundi de la même semaine et du même mois</td></tr></table>
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
