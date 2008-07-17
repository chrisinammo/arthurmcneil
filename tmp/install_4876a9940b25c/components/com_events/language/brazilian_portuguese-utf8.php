<?php
/**
 * Events Component for Joomla 1.0.x
 *
 * @version     $Id: brazilian_portuguese-utf8.php 991 2008-03-10 19:55:48Z tstahl $
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
define("_CAL_LANG_LNG",				"pt_br"); // de|fr|etc... [ DO NOT CHANGE THIS VALUE! ]

// used for colorpicker
define("_CAL_LANG_NO_COLOR",			"Sem Cor");
define("_CAL_LANG_COLOR_PICKER",		"Paleta de Cores");

// common
define("_CAL_LANG_TIME",				"Hora");
define("_CAL_LANG_CLICK_TO_OPEN_EVENT",	"Clique para abrir o evento");
define("_CAL_LANG_UNPUBLISHED",		"** Não publicado **");
define("_CAL_LANG_DESCRIPTION",		"Descrição");
define("_CAL_LANG_EMAIL_TO_AUTHOR",	"Email para o autor");
define("_CAL_LANG_MAIL_TO_ADMIN",		"Evento enviado de [ %s ] por [ %s ]");
define("_CAL_LANG_KEYWORD_NOT_VALID",	"Palavra-chave não válida");
define("_CAL_LANG_EVENT_CALENDAR",		"Calendário de Eventos"); // new 1.4

// modul
define("_CAL_LANG_ERR_NO_MOD_CAL",		"Calendário de Eventos\n<br />Este módulo necessita do componente de Eventos");
define("_CAL_LANG_CLICK_TOSWITCH_DAY",	"Ir ao calendário - dia de hoje");
define("_CAL_LANG_CLICK_TOSWITCH_MON",	"Ir ao calendário - mês atual");
define("_CAL_LANG_CLICK_TOSWITCH_YEAR",	"Ir ao calendário - ano atual");
define("_CAL_LANG_CLICK_TOSWITCH_PY",	"Ir ao calendário - ano anterior");
define("_CAL_LANG_CLICK_TOSWITCH_PM",	"Ir ao calendário - mês anterior");
define("_CAL_LANG_CLICK_TOSWITCH_NM",	"Ir ao calendário - próximo mês");
define("_CAL_LANG_CLICK_TOSWITCH_NY",	"Ir ao calendário - próximo ano");

// navTableNext
define("_CAL_LANG_NAV_TN_FIRST_LIST",	"primeira lista");
define("_CAL_LANG_NAV_TN_PREV_LIST",	"lista anterior");
define("_CAL_LANG_NAV_TN_NEXT_LIST",	"próxima lista");
define("_CAL_LANG_NAV_TN_LAST_LIST",	"última lista");

// calendar monthly display
define("_CAL_LANG_FIRST_SINGLE_DAY_EVENT",		"Evento de único dia");
define("_CAL_LANG_FIRST_DAY_OF_MULTIEVENT",	"Primeiro dia de evento de vários dias");
define("_CAL_LANG_LAST_DAY_OF_MULTIEVENT",		"Último dia de evento de vários dias");
define("_CAL_LANG_MULTIDAY_EVENT",				"Evento de vários");
/* ++++++ end mic +++++++++++++ */

// Months
DEFINE("_CAL_LANG_JANUARY", "Janeiro");
DEFINE("_CAL_LANG_FEBRUARY", "Fevereiro");
DEFINE("_CAL_LANG_MARCH", "Março");
DEFINE("_CAL_LANG_APRIL", "Abril");
DEFINE("_CAL_LANG_MAY", "Maio");
DEFINE("_CAL_LANG_JUNE", "Junho");
DEFINE("_CAL_LANG_JULY", "Julho");
DEFINE("_CAL_LANG_AUGUST", "Agosto");
DEFINE("_CAL_LANG_SEPTEMBER", "Setembro");
DEFINE("_CAL_LANG_OCTOBER", "Outubro");
DEFINE("_CAL_LANG_NOVEMBER", "Novembro");
DEFINE("_CAL_LANG_DECEMBER", "Dezembro");

// Short day names
DEFINE("_CAL_LANG_SUN", "Dom");
DEFINE("_CAL_LANG_MON", "Seg");
DEFINE("_CAL_LANG_TUE", "Ter");
DEFINE("_CAL_LANG_WED", "Qua");
DEFINE("_CAL_LANG_THU", "Qui");
DEFINE("_CAL_LANG_FRI", "Sex");
DEFINE("_CAL_LANG_SAT", "Sab");

// Days
DEFINE("_CAL_LANG_SUNDAY", "Domingo");
DEFINE("_CAL_LANG_MONDAY", "Segunda");
DEFINE("_CAL_LANG_TUESDAY", "Terça");
DEFINE("_CAL_LANG_WEDNESDAY", "Quarta");
DEFINE("_CAL_LANG_THURSDAY", "Quinta");
DEFINE("_CAL_LANG_FRIDAY", "Sexta");
DEFINE("_CAL_LANG_SATURDAY", "Sábado");

// Days lettres
DEFINE("_CAL_LANG_SUNDAYSHORT", "D");
DEFINE("_CAL_LANG_MONDAYSHORT", "S");
DEFINE("_CAL_LANG_TUESDAYSHORT", "Q");
DEFINE("_CAL_LANG_WEDNESDAYSHORT", "Q");
DEFINE("_CAL_LANG_THURSDAYSHORT", "Q");
DEFINE("_CAL_LANG_FRIDAYSHORT", "S");
DEFINE("_CAL_LANG_SATURDAYSHORT", "D");

// Repeat type
DEFINE("_CAL_LANG_ALLDAYS", "Todos os dias");
DEFINE("_CAL_LANG_EACHWEEK", "Todas as semanas");
DEFINE("_CAL_LANG_EACHWEEKPAIR", "Todas as semanas pares");
DEFINE("_CAL_LANG_EACHWEEKIMPAIR", "Todas as semanas ímpares");
DEFINE("_CAL_LANG_EACHMONTH", "Todos os meses");
DEFINE("_CAL_LANG_EACHYEAR", "Todos os anos");
DEFINE("_CAL_LANG_ONLYDAYS", "Somente os dias marcados");
DEFINE("_CAL_LANG_EACH", "Cada");
DEFINE("_CAL_LANG_EACHOF","de cada");
DEFINE("_CAL_LANG_ENDMONTH", "término do mês");

// Repeat days
DEFINE("_CAL_LANG_BYDAYNUMBER", "Por número do dia");

// User type
DEFINE("_CAL_LANG_ANONYME", "Anônimo");

// Post
//PAS D'ACCENTS DANS LES _ACT_
DEFINE("_CAL_LANG_ACT_ADDED", "Obrigado por sua colaboração - Verificaremos sua proposta!"); //NO ACCENT !!
DEFINE("_CAL_LANG_ACT_MODIFIED", "Este evento foi modificado."); //NO ACCENT !!
DEFINE("_CAL_LANG_ACT_PUBLISHED", "Este evento foi publicado.");  //NEW 1.4
DEFINE("_CAL_LANG_ACT_DELETED", "Este evento foi apagado!"); //NO ACCENT !!
DEFINE("_CAL_LANG_NOPERMISSION", "Você não tem acesso a esse serviço!"); //NO ACCENT !!

DEFINE("_CAL_LANG_MAIL_ADDED", "Nova submissão");
DEFINE("_CAL_LANG_MAIL_MODIFIED", "Nova modificação");

// Presentation
DEFINE("_CAL_LANG_BY", "por");
DEFINE("_CAL_LANG_FROM", "De");
DEFINE("_CAL_LANG_TO", "Para");
DEFINE("_CAL_LANG_ARCHIVE", "Arquivos");
DEFINE("_CAL_LANG_WEEK", "a semana");
DEFINE("_CAL_LANG_NO_EVENTS", "Nenhum evento");
DEFINE("_CAL_LANG_NO_EVENTFOR", "Nenhum evento para");
DEFINE("_CAL_LANG_NO_EVENTFORTHE", "Nenhum evento para o");
DEFINE("_CAL_LANG_THIS_DAY", "esse dia");
DEFINE("_CAL_LANG_THIS_MONTH", "Esse mes");
DEFINE("_CAL_LANG_LAST_MONTH", "Mês anterior");
DEFINE("_CAL_LANG_NEXT_MONTH", "Próximo mês");
DEFINE("_CAL_LANG_EVENTSFOR", "Eventos para");
DEFINE("_CAL_LANG_SEARCHRESULTS", "Resultados da busca por palavra-chave"); // new 1.4
DEFINE("_CAL_LANG_EVENTSFORTHE", "Eventos para o");
DEFINE("_CAL_LANG_REP_DAY", "dia");
DEFINE("_CAL_LANG_REP_WEEK", "semana");
DEFINE("_CAL_LANG_REP_WEEKPAIR", "semana par");
DEFINE("_CAL_LANG_REP_WEEKIMPAIR", "semana ímpar");
DEFINE("_CAL_LANG_REP_MONTH", "mês");
DEFINE("_CAL_LANG_REP_YEAR", "ano");
DEFINE("_CAL_LANG_REP_NOEVENTSELECTED", "Por favor selecione um evento");

// Navigation
DEFINE("_CAL_LANG_VIEWTODAY", "Atual");
DEFINE("_CAL_LANG_VIEWTOCOME", "Próximo");
DEFINE("_CAL_LANG_VIEWBYDAY", "Ver por dia");
DEFINE("_CAL_LANG_VIEWBYCAT", "Ver por categoria");
DEFINE("_CAL_LANG_VIEWBYMONTH", "Ver o mês");
DEFINE("_CAL_LANG_VIEWBYYEAR", "Ver por ano");
DEFINE("_CAL_LANG_VIEWBYWEEK", "Ver por semana");
DEFINE("_CAL_LANG_JUMPTO", "Ir para um mês");  // New 1.4
DEFINE("_CAL_LANG_BACK", "Voltar");
DEFINE("_CAL_LANG_CLOSE", "Fechar");
DEFINE("_CAL_LANG_PREVIOUSDAY", "Dia anterior");
DEFINE("_CAL_LANG_PREVIOUSWEEK", "Semana anterior");
DEFINE("_CAL_LANG_PREVIOUSMONTH", "Mês anterior");
DEFINE("_CAL_LANG_PREVIOUSYEAR", "Ano anterior");
DEFINE("_CAL_LANG_NEXTDAY", "Próximo dia");
DEFINE("_CAL_LANG_NEXTWEEK", "Próxima semana");
DEFINE("_CAL_LANG_NEXTMONTH", "Próximo mês");
DEFINE("_CAL_LANG_NEXTYEAR", "Próximo ano");

DEFINE("_CAL_LANG_ADMINPANEL", "Painel de administração");
DEFINE("_CAL_LANG_ADDEVENT", "Adicionar um evento");
DEFINE("_CAL_LANG_MYEVENTS", "Meus eventos");
DEFINE("_CAL_LANG_DELETE", "Apagar");
DEFINE("_CAL_LANG_MODIFY", "Modificar");

// Form
DEFINE("_CAL_LANG_HELP", "Ajuda");

DEFINE("_CAL_LANG_CAL_TITLE", "Eventos");
DEFINE("_CAL_LANG_ADD_TITLE", "Adicionar");
DEFINE("_CAL_LANG_MODIFY_TITLE", "Modificar");

DEFINE("_CAL_LANG_REPEAT_DISABLED", "A Repetição de Eventos é aplicável apenas se a Data Final for uma data posterior da Data Inicial.  Mude da Data Final antes de configurar os detalhes da repetição de evento."); // New for 1.4
DEFINE("_CAL_LANG_EVENT_TITLE", "Assunto");
DEFINE("_CAL_LANG_EVENT_COLOR", "Cor");
DEFINE("_CAL_LANG_EVENT_CATCOLOR", "Usar Cor da Categoria");
DEFINE("_CAL_LANG_EVENT_CATEGORY", "Categorias");
DEFINE("_CAL_LANG_EVENT_CHOOSE_CATEG", "Por favor selecione uma categoria");
DEFINE("_CAL_LANG_EVENT_ACTIVITY", "Atividade");
DEFINE("_CAL_LANG_EVENT_URLMAIL_INFO", "Para incluir uma URL ou um EMAIL, simplesmente digite <u>http://www.meusite.com</u> ou <u>mailto:meu@email.com</u>");
DEFINE("_CAL_LANG_EVENT_ADRESSE", "Endereço");
DEFINE("_CAL_LANG_EVENT_CONTACT", "Contato");
DEFINE("_CAL_LANG_EVENT_EXTRA", "Informações complementares");
DEFINE("_CAL_LANG_EVENT_AUTHOR_ALIAS", "Autor (alias)");
DEFINE("_CAL_LANG_EVENT_STARTDATE", "Data de inicio");
DEFINE("_CAL_LANG_EVENT_ENDDATE", "Data do término");
DEFINE("_CAL_LANG_EVENT_STARTHOURS", "Hora de inicio");
DEFINE("_CAL_LANG_EVENT_ENDHOURS", "Hora do término");
DEFINE("_CAL_LANG_EVENT_STARTTIME", "Hora de inicio");
DEFINE("_CAL_LANG_EVENT_ENDTIME", "Hora do término");
DEFINE("_CAL_LANG_PUB_INFO", "Informações de publicação");
DEFINE("_CAL_LANG_EVENT_REPEATTYPE", "Tipo de repetição");
DEFINE("_CAL_LANG_EVENT_REPEATDAY", "Dia de repetição");
DEFINE("_CAL_LANG_EVENT_CHOOSE_WEEKDAYS", "Dias da semana");
DEFINE("_CAL_LANG_EVENT_PER", "por");
DEFINE("_CAL_LANG_EVENT_WEEKOPT", "Week(s) of a month repeat type week");

DEFINE("_CAL_LANG_SUBMITPREVIEW", "Prever");
DEFINE("_CAL_LANG_SUBMITCANCEL", "Cancelar");
DEFINE("_CAL_LANG_SUBMITSAVE", "Salvar");

DEFINE("_CAL_LANG_E_WARNWEEKS", "Selecione uma semana.");
DEFINE("_CAL_LANG_E_WARNDAYS", "Selecione um dia.");

// Admin
DEFINE("_CAL_LANG_EVENT_ALLCAT", "Todas as categorias");
DEFINE("_CAL_LANG_EVENT_ACCESSLEVEL", "Nivel de acesso");
DEFINE("_CAL_LANG_EVENT_HITS", "Hits");
DEFINE("_CAL_LANG_EVENT_STATE", "Estado");
DEFINE("_CAL_LANG_EVENT_CREATED", "Criado");
DEFINE("_CAL_LANG_EVENT_NEWEVENT", "Novo evento");
DEFINE("_CAL_LANG_EVENT_MODIFIED", "Última modificação");
DEFINE("_CAL_LANG_EVENT_NOTMODIFIED", "Não modificado");

// dmcd aug 22/04  new warning alert for no specified activity in event entry
DEFINE("_CAL_LANG_WARNACTIVITY", "Algum tipo de descrição\\da atividade deve ser inserida.");

DEFINE("_CAL_LEGEND_ALL_CATEGORIES", "Todas as categorias ...");  // new for 1.4
DEFINE("_CAL_LEGEND_ALL_CATEGORIES_DESC", "Mostrar eventos de todas as categorias");  // new for 1.4

DEFINE("_CAL_LANG_FORM_HELP_COLOR", <<<END
        <tr>
		  <td width="110" align="left" valign="top">
            <b>Color</b>
          </td>
          <td>Choose the color of the background which will be visible in month calendar view.  If the Category checkbox is checked,
		  the color will default to the color of the category (defined by the site admin) that is chosen under the Content tab form for the event, and the
		  'Color Picker' button will be disabled.</td>
        </tr>
END
);

DEFINE("_CAL_LANG_FORM_HELP",  <<<END
    	<tr>
          <td align="left"><b>Date</b></td>
          <td>Choose the Begin Date and the End Date of your event.</td>
        </tr>
    	<tr>
          <td align="left" valign="top"><b>Time</b></td>
          <td>Choose the Time of Day of your event.  Format is <span style='color:blue;font-weight:bold;'>hh:mm {am|pm}</span>.<br/>Time can be specified in either 12 or 24 hr format.<br/><br/><b><i><span style='color:red;'>(New)</span></i> Note</b> that a special case occurs for <span style='color:red;font-weight:bold;'>single day over-night events</span>.  IE. For a single day event beginning at say 19:00 and finishing at 3:00, the Start and End Dates <b>MUST</b> be&nbsp;
		   the same date, and should be set to the date corresponding to the day before midnight.</td>
        </tr>
END
);

DEFINE("_CAL_LANG_FORM_HELP_EXTENDED",  <<<END
        <tr>
    	  <td align="left" valign="top" nowrap><b>Repeat Type</b></td>
  	  	<td colspan="2"></td>
  		</tr>
  		<tr>
    	  <td colspan="2" align="left" valign="top">
	    	<table width="100%" border="0" cellspacing="2">
              <tr>
                <td width="60" align="left" valign="top"><u>By Day</u></td>
                <td width="110" align="left" valign="top" class="frm_td_bydays">
                  <font color="#000000">Every Day<br/><i>(default)</i></font>
                </td>
                <td align="left" valign="top" class="frm_td_bydays">
                  <font color="#000000">Choose this option for a non-reoccurring single or multi-day event, with a new event occurrence for every day within the Start and End Date range</font>
                </td>
              </tr>
              <tr>
                <td width="60" rowspan="3" align="left" valign="top"><u>By Week</u></td>
                <td width="110" align="left" valign="top" class="frm_td_byweeks">
                  <font color="#000000">
                    Once Per Week
                  </font>
                </td>
                <td align="left" valign="top" class="frm_td_byweeks">
                  <font color="#000000">
                  This option allow to choose the weekday of repeat
                  <table border="0" width="100%" height="100%"><tr><td><b>Day number</b> for repeat type each 10/../2003</td></tr><tr><td><b>Day name</b> for repeat type each Monday</td></tr></table>
                  </font>
                </td>
              </tr>
              <tr>
                <td width="110" align="left" valign="top" class="frm_td_byweeks">
                  <font color="#000000">
                    Multiple Week Days Per Week
                  </font>
                </td>
                <td align="left" valign="top" class="frm_td_byweeks">
                  <font color="#000000">This option allow to choose on which week days your event will be visible.</font>
                </td>
              </tr>
              <tr>
                <td width="110" align="left" valign="top" class="frm_td_byweeks">
                  <font color="#000000"><i>Week of Month # <br>For 'Once per Week' and 'Multiple Days Per Week' options above</i></font></td>
                  <td align="left" valign="top" class="frm_td_byweeks">
                  <font color="#000000">
                  <table border="0" width="100%" height="100%">
                    <tr><td><b>Week 1 :</b> 1st week of the month</td></tr>
                    <tr><td><b>Week 2 :</b> 2nd week of the month</td></tr>
                    <tr><td><b>Week 3 :</b> 3rd week of the month</td></tr>
                    <tr><td><b>Week 4 :</b> 4th week of the month</td></tr>
                    <tr><td><b>Week 5 :</b> 5th week of the month (if applicable)</td></tr>
                   </table>
                 </font>
                </td>
              </tr>
              <tr>
                <td width="60" rowspan="2" align="left" valign="top"><u>By Month</u></td>
                <td width="110" align="left" valign="top" class="frm_td_bymonth">
                  <font color="#000000">Once Per Month</font></td>
                <td align="left" valign="top" class="frm_td_bymonth">
                  <font color="#000000">
                     This option allow to choose the repeating Day of the Month
                     <table border="0" width="100%" height="100%"><tr><td><b>Day number</b> for repeat type each 10/../2003</td></tr><tr><td><b>Day name</b> for repeat type each Monday</td></tr></table>

                  </font>
                </td>
              </tr>
              <tr>
                <td width="110" align="left" valign="top" class="frm_td_bymonth">
                  <font color="#000000">
                  End of Each Month
                  </font>
                </td>
                <td align="left" valign="top" class="frm_td_bymonth">
                  <font color="#000000">
				   The event is on the last day of each month independently of the day number, if that last day
		falls within the date range specified by the Start and End Dates for the event.
                  </font>
                </td>
              </tr>
              <tr>
                <td width="60" rowspan="2" align="left" valign="top"><u>By Year</u></td>
                <td width="110" align="left" valign="top" class="frm_td_byyear">
                  <font color="#000000">
                  Once Per Year
                  </font>
                </td>
                <td align="left" valign="top" class="frm_td_byyear">
                  <font color="#000000">
                  This option allow to choose a single day every Year
                  <table border="0" width="100%" height="100%"><tr><td><b>Day number</b> for repeat type each 10/../2003</td></tr><tr><td><b>Day name</b> for repeat type each Monday</td></tr></table>
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
