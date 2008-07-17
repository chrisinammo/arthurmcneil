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
	'name' => 'Portuguese'
	,'nativename' => 'Portugu�s' // Language name in native language. E.g: 'Fran�ais' for 'French'
	,'locale' => array('por_BR','Portuguese') // Standard locale alternatives for a specific language. For reference, go to: http://www.php.net/manual/en/function.setlocale.php
	,'charset' => 'ISO-8859-1' // For reference, go to : http://www.w3.org/International/O-charset-lang.html
	,'direction' => 'ltr' // 'ltr' for Left to Right. 'rtl' for Right to Left languages such as Arabic.
	,'author' => 'Allan Rodrigo Bomfim'
	,'author_email' => 'allanrodrigo@gmx.net'
	,'author_url' => 'www.infonet.com.br/allanrodrigo'
	,'transdate' => '01/20/2005'
);

$lang_general = array (
	'yes' => 'Sim'
	,'no' => 'N�o'
	,'back' => 'Voltar'
	,'continue' => 'Continuar'
	,'close' => 'Fechar'
	,'errors' => 'Erros'
	,'info' => 'Informa��o'
	,'day' => 'Dia'
	,'days' => 'Dias'
	,'month' => 'M�s'
	,'months' => 'Meses'
	,'year' => 'Ano'
	,'years' => 'Anos'
	,'hour' => 'Hora'
	,'hours' => 'Horas'
	,'minute' => 'Minuto'
	,'minutes' => 'Minutos'
	,'everyday' => 'Todo Dia'
	,'everymonth' => 'Todo M�s'
	,'everyyear' => 'Todo Ano'
	,'active' => 'Ativo'
	,'not_active' => 'N�o Ativo'
	,'today' => 'Hoje'
	,'signature' => 'Powered by %s'
	,'expand' => 'Expandir'
	,'collapse' => 'Encolher'	
);

// Date formats, For reference, go to : http://www.php.net/manual/en/function.strftime.php
$lang_date_format = array (
	'full_date' => '%A, %B %d, %Y' // e.g. Wednesday, June 05, 2002
	,'full_date_time_24hour' => '%A, %B %d, %Y At %H:%M' // e.g. Wednesday, June 05, 2002 At 21:05
	,'full_date_time_12hour' => '%A, %B %d, %Y At %I:%M %p' // e.g. Wednesday, June 05, 2002 At 9:05 pm
	,'day_month_year' => '%d-%b-%Y'
	,'local_date' => '%c'
	,'mini_date' => '%a. %d %b, %Y'
	,'month_year' => '%B %Y'
	,'day_of_week' => array('Domingo','Segunda','Ter�a','Quarta','Quinta','Sexta','S�bado')
	,'months' => array('Janeiro','Fevereiro','Mar�o','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro')
);

$lang_system = array (
	'system_caption' => 'Mensagem de Sistema'
  ,'page_access_denied' => 'Voc� n�o tem o n�vel de privil�gio para acessar esta p�gina.'
  ,'page_requires_login' => 'Voc� deve estar registrado para acessar esta p�gina.'
  ,'operation_denied' => 'Vo� n�o tem o n�vel de privil�gio para executar esta opera��o.'
  ,'section_disabled' => 'Esta se��o est� atualnente desabilitada !'
  ,'non_exist_cat' => 'A categoria selecionada n�o existe !'
  ,'non_exist_event' => 'O evento selecionado n�o existe !'
  ,'param_missing' => 'O par�metro fornecido est� incorreto.'
  ,'no_events' => 'N�o h� eventos a mostrar'
   ,'config_string' => 'You are currently using \'%s\' running on %s, %s and %s.'
  ,'no_table' => 'A \'%s\' tabela n�o existe !'
  ,'no_anonymous_group' => 'A %s tabela n�o cont�m o grupo \'Anonymous\'  !'
  ,'calendar_locked' => 'Este servi�o est� em manuten��o temporariamente. '
	,'new_upgrade' => 'O sistema detectou uma nova vers�o. � recomendada a tualiza��o agora. Clique "Continuar" para iniciar a atualiza��o.'
	,'no_profile' => 'Um erro ocorreu enquanto recuperamos a informa��o do seu perfil'
// Mail messages
	,'new_event_subject' => 'Novo Evento em %s'
	,'event_notification_failed' => 'Um erro ocorreu durante o envio da notifica��o de ativa��o por email !'
);

// Message body for new event email notification
$lang_system['event_notification_body'] = <<<EOT
O seguinte evento tem sido postado no {CALENDAR_NAME}

T�tulo: "{TITLE}"
Data: "{DATE}"
Dura��o: "{DURATION}"

Voc� pode acessar este evento clicando no link abaixo
ou copiando e colando no seu navegador.

{LINK}

Atenciosamente,

O administrador de {CALENDAR_NAME}

EOT;

// Admin menu entries
$lang_admin_menu = array (
	'login' => 'Login'
	,'register' => 'Registrar'
  ,'logout' => 'Logout <span style="color:#FF9922">[<span style="color:#606F79">%s</span>]</span>'
  ,'user_profile' => 'Meu Perfil'
	,'admin_events' => 'Eventos'
  ,'admin_categories' => 'Categorias'
  ,'admin_groups' => 'Grupos'
  ,'admin_users' => 'Usu�rios'
  ,'admin_settings' => 'Configura��es'
);

// Main menu entries
$lang_main_menu = array (
	'add_event' => 'Adicionar Evento'
	,'cal_view' => 'Visualizar Meses'
  ,'flat_view' => 'Visualizar Flat'
  ,'weekly_view' => 'Visualizar Semanas'
  ,'daily_view' => 'Visualizar Dias'
  ,'yearly_view' => 'Visualizar Anos'
  ,'categories_view' => 'Categorias'
  ,'search_view' => 'Procurar'
);

// ======================================================
// Add Event view
// ======================================================

$lang_add_event_view = array(
	'section_title' => 'Adicionar Evento'
	,'edit_event' => 'Editar Evento [id%d] \'%s\''
	,'update_event_button' => 'Atualizar Evento'

// Event details
	,'event_details_label' => 'Detalhes do Evento'
	,'event_title' => 'T�tulo do Evento'
	,'event_desc' => 'Descri��o do Evento'
	,'event_cat' => 'Categoria'
	,'choose_cat' => 'Selecione a Categoria'
	,'event_date' => 'Data do Evento'
	,'day_label' => 'Dia'
	,'month_label' => 'M�s'
	,'year_label' => 'Ano'
	,'start_date_label' => 'In�cio do Evento'
	,'start_time_label' => 'em'
	,'end_date_label' => 'Dura��o'
	,'all_day_label' => 'Todo dia'
// Contact details
	,'contact_details_label' => 'Contato - Detalhes'
	,'contact_info' => 'Contato - Info'
	,'contact_email' => 'Contato - Email'
	,'contact_url' => 'Contato - URL'
// Repeat events
	,'repeat_event_label' => 'Repetir Evento'
	,'repeat_method_label' => 'Repetir M�todo'
	,'repeat_none' => 'N�o repetir este evento'
	,'repeat_every' => 'Repetir todos'
	,'repeat_days' => 'Dia(s)'
	,'repeat_weeks' => 'Semana(s)'
	,'repeat_months' => 'M�s(es)'
	,'repeat_years' => 'Ano(s)'
	,'repeat_end_date_label' => 'Repetir data final'
	,'repeat_end_date_none' => 'Sem data final'
	,'repeat_end_date_count' => 'Finalizado depois de %s ocorr�ncia(s)'
	,'repeat_end_date_until' => 'Repetir at�'	
// Other details
	,'other_details_label' => 'Outros Detalhes'
	,'picture_file' => 'Arquivo de Imagem'
	,'file_upload_info' => '(%d KBytes limite - v�lida extens�es : %s )' 
	,'del_picture' => 'Deletar imagem atual ?'
// Administrative options
	,'admin_options_label' => 'Op��o Administrativas'
	,'auto_appr_event' => 'Evento Aprovado'

// Error messages
	,'no_title' => 'Voc� deve dar um t�tulo para o evento !'
	,'no_desc' => 'Voc� deve dar uma descri��o para este evento !'
	,'no_cat' => 'Voc� deve selecionar uma categoria !'
	,'date_invalid' => 'Voc� deve dar uma data v�lida para este evento !'
	,'end_days_invalid' => 'O valor colocado no \'Days\' campo n�o � v�lido !'
	,'end_hours_invalid' => 'O valor colocado no campo \'Hours\' n�o � v�lido !'
	,'end_minutes_invalid' => 'O valor colocado no campo \'Minutes\' n�o � v�lido !'
	
	,'non_valid_extension' => 'O formato de arquivo da imagem n�o � suportado ! (V�lidas extens�es: %s)'

	,'file_too_large' => 'O arquivo � muito grande ! (%d KBytes limit)'
	,'move_image_failed' => 'O sistema falhou ao mover a imagem !'
	,'non_valid_dimensions' => 'A largura e altura da imagem � maior que %s pixels !'

	,'recur_val_1_invalid' => 'O valor colocado como \'repeat interval\' n�o � v�lido. Este valor deve ser um n�mero maior que \'0\' !'
	,'recur_end_count_invalid' => 'O valor colocado como \'number of occurrences\' n�o � v�lido. Este valor deve ser um n�mero maior que \'0\' !'
	,'recur_end_until_invalid' => 'O \'repeat until\' date deve ser uma data posterior ao in�cio do evento !'
// Misc. messages
	,'submit_event_pending' => 'Seu evento depende de aprova��o. Obrigado pela sua participa��o !'
	,'submit_event_approved' => 'Seu evento est� automaticamente aprovado. Obrigado pela sua participa��o !'
	,'event_repeat_msg' => 'Este evento est� configurado para repetir'
	,'event_no_repeat_msg' => 'Este evento n�o ser� repetido'
);

// ======================================================
// daily view
// ======================================================

$lang_daily_event_view = array(
	'section_title' => 'Visualizar Dias'
	,'next_day' => 'Pr�ximo Dia'
	,'previous_day' => 'Dia Anterior'
	,'no_events' => 'N�o h� eventos neste dia.'
);

// ======================================================
// weekly view
// ======================================================

$lang_weekly_event_view = array(
	'section_title' => 'Visualizar Semanas'
	,'week_period' => '%s - %s'
	,'next_week' => 'Pr�xima Semana'
	,'previous_week' => 'Semana Anterior'
	,'selected_week' => 'Semana %d'
	,'no_events' => 'N�o h� eventos nesta semana'
);

// ======================================================
// monthly view
// ======================================================

$lang_monthly_event_view = array(
	'section_title' => 'Visualizar M�ses'
	,'next_month' => 'Pr�ximo M�s'
	,'previous_month' => 'M�s Anterior'
);

// ======================================================
// flat view
// ======================================================

$lang_flat_event_view = array(
	'section_title' => 'Visualizar Flat'
	,'week_period' => '%s - %s'
	,'next_month' => 'Pr�ximo M�s'
	,'previous_month' => 'M�s Anterior'
	,'contact_info' => 'Contato - Info'
	,'contact_email' => 'Contato - Email'
	,'contact_url' => 'Contato - URL'
	,'no_events' => 'N�o h� eventos neste m�s'
);

// ======================================================
// Event view
// ======================================================

$lang_event_view = array(
	'section_title' => 'Evento: \'%s\''
	,'display_event' => 'Evento: \'%s\''
	,'cat_name' => 'Categoria'
	,'event_start_date' => 'Data'
	,'event_end_date' => 'At�'
	,'event_duration' => 'Dura��o'
	,'contact_info' => 'Contato - Info'
	,'contact_email' => 'Email'
	,'contact_url' => 'URL'
	,'no_event' => 'N�o h� eventos a serem exibidas.'
	,'stats_string' => '<strong>%d</strong> Eventos no Total'
	,'edit_event' => 'Editar Evento'
	,'delete_event' => 'Deletar Evento'
	,'delete_confirm' => 'Voc� tem certeza que quer deletar este evento?'
	
);

// ======================================================
// Categories view
// ======================================================

$lang_cats_view = array(
	'section_title' => 'Mostrar Categorias'
	,'cat_name' => 'Nome da Categoria'
	,'total_events' => 'Total de Eventos'
	,'upcoming_events' => 'Eventos Pr�ximos'
	,'no_cats' => 'N�o h� categorias a serem exibidas.'
	,'stats_string' => 'H� <strong>%d</strong> Eventos em <strong>%d</strong> Categorias'
);

// ======================================================
// Category Events view
// ======================================================

$lang_cat_events_view = array(
	'section_title' => 'Eventos sobre \'%s\''
	,'event_name' => 'Nome do Evento'
	,'event_date' => 'Data'
	,'no_events' => 'N�o h� eventos nesta categoria.'
	,'stats_string' => '<strong>%d</strong> Eventos como Total'
);

// ======================================================
// cal_search.php
// ======================================================

$lang_event_search_data = array(
	'section_title' => 'Procurar no Calend�rio',
	'search_results' => 'Resultado da Procura',
	'category_label' => 'Categoria',
	'date_label' => 'Data',
	'no_events' => 'N�o h� eventos nesta categoria.',
	'search_caption' => 'Digite alguma palavra-chave...',
	'search_again' => 'Procurar Novamente',
	'search_button' => 'Procurar',
// Misc.
	'no_results' => 'Nenhum resultado encontrado',	
// Stats
	'stats_string1' => '<strong>%d</strong> evento(s) encontrados',
	'stats_string2' => '<strong>%d</strong> Evento(s) em <strong>%d</strong> p�gina(s)'
);

// ======================================================
// profile.php
// ======================================================

if (defined('PROFILE_PHP')) 

$lang_user_profile_data = array(
	'section_title' => 'Meu Perfil',
	'edit_profile' => 'Editar Meu Perfil',
	'update_profile' => 'Atualizar Meu Perfil',
	'actions_label' => 'A��es',
// Account Info
	'account_info_label' => 'Informa��o da Conta',
	'user_name' => 'Login',
	'user_pass' => 'Senha',
	'user_pass_confirm' => 'Confirmar Senha',
	'user_email' => 'E-mai',
	'group_label' => 'Grupo',
// Other Details
	'other_details_label' => 'Outras Informa��es',
	'first_name' => 'Nome',
	'last_name' => 'Sobrenome',
	'full_name' => 'Nome Completo',
	'user_website' => 'Home page',
	'user_location' => 'Localiza��o',
	'user_occupation' => 'Ocupa��o',
// Misc.
	'select_language' => 'Selecionar Idioma',
	'edit_profile_success' => 'Perfil atualizado com sucesso',
	'update_pass_info' => 'Deixe o campo de senha vazio caso n�o queira mud�-la',
// Error messages
	'invalid_password' => 'Por favor, digite uma senha com apenas letras e n�meros e entre 4 e 16 caracteres !',
	'password_is_username' => 'A senha deve ser diferentes do login !',
	'password_not_match' =>'Senha n�o confirmada',
	'invalid_email' => 'Voc� deve fornecer um email v�lido !',
	'email_exists' => 'Outro usu�rio j� est� registrado com seu email. Por favor, digite um email diferente !',
	'no_email' => 'Voc� deve fornecer um email !',
	'invalid_email' => 'Voc� deve fornecer um email v�lido !',
	'no_password' => 'Voc� deve fornecer uma senha para esta nova conta !'
);

// ======================================================
// register.php
// ======================================================

if (defined('USER_REGISTRATION_PHP')) 

$lang_user_registration_data = array(
	'section_title' => 'Usu�rio Registrado',
// Step 1: Terms & Conditions
	'terms_caption' => 'Termos and Condi��es',
	'terms_intro' => 'Para prosseguir, voc� deve concordar com os seguintes termos:',
	'terms_message' => 'Por favor, reserve um momento para revisar esses termos abaixo. Se voc� concordar com eles e desejar prosseguir com a instala��o, simplesmente clique em "Eu concordo". Para cancelar este registro, simplesmente clique no bot�o \'back\'  do seu navegador.<br /><br />Lembre-se que n�s n�o nos responsabilizamos por nenhum evento postado por usu�rios desta aplica��o de calend�rio. N�s n�o garantimos a extadid�o, integridade ou utilidade de nenhum evento postado, e n�o nos responsabilizamos pelo conte�do de nenhum evento.<br /><br />As mensagens expressam as opini�es o autor do evento, n�o necessariamente as opini�es dos desenvolvedores desta aplica��o de calend�rio. Todo usu�rio que sentir que um evento afixado � desagrad�vel, incetivamos a entrar em contato conosco imediatamente por email. N�s podemos remover o conte�do desagrad�vel e n�s faremos esfor�o para faz�-lo dentro de um espa�o de tempo razo�vel, se n�s determinarmos que a remo��o � necess�ria.<br /><br />Voc� concorda, atrav�s do seu uso deste servi�o, que voc� n�o usar� este calend�rio para postar nenhum material que seja conscientemente falso ou defamat�rio, inexato, abusivo, odioso, vulgar, inc�modo, obsceno, ame�ador, sexualmente orientado, invasor de privacidade ou qualquer outra forma de viola��o da lei.w.<br /><br />Voc� concorda em n�o postar material protegido por direitos autorais a n�o ser que os direitos autorais sejam seus ou a %s.',
	'terms_button' => 'Eu concordo',

// Account Info
	'account_info_label' => 'Informa��o da Conta',
	'user_name' => 'Login',
	'user_pass' => 'Senha',
	'user_pass_confirm' => 'Confirmar Senha',
	'user_email' => 'E-mail',
// Other Details
	'other_details_label' => 'Outras Informa��es',
	'first_name' => 'Nome',
	'last_name' => 'Sobrenome',
	'user_website' => 'Home page',
	'user_location' => 'Localiza��o',
	'user_occupation' => 'Ocupa��o',
	'register_button' => 'Registrar',

// Stats
	'stats_string1' => '<strong>%d</strong> usu�rios',
	'stats_string2' => '<strong>%d</strong> usu�rios em <strong>%d</strong> p�gina(s)',
// Misc.
	'reg_nomail_success' => 'Obrigado pelo seu registro.',
	'reg_mail_success' => 'Um email com informa��o de como ativar sua conta foi enviado para voc�.',
	'reg_activation_success' => 'Parab�ns! Sua conta est� ativada e voc� j� pode se logar. Obrigado pelo seu registro.',
// Mail messages
	'reg_confirm_subject' => 'Registrado em %s',
	
// Error messages
	'no_username' => 'Voc� deve fornecer um nome para o login !',
	'invalid_username' => 'Por favor, digite um nome para o login que tenha somente letras e n�meros  e entre 4 a 30 caracteres !',
	'username_exists' => 'O login que voc� digitou j� existe. Por favor, tente registrar um outro nome para login !',
	'no_password' => 'Voc� deve fornecer uma senha !',
	'invalid_password' => 'Por favor, digite uma senha com apenas letras e n�meros e entre 4 e 16 caracteres !',
	'password_is_username' => 'A senha deve ser diferentes do login !',
	'password_not_match' =>'Senha n�o confirmada',
	'no_email' => 'Voc� deve fornecer um email !',
	'invalid_email' => 'Voc� deve fornecer uma email v�lido  !',
	'email_exists' => 'Outro usu�rio j� est� registrado com seu email. Por favor, digite um email diferente !',
	'delete_user_failed' => 'Este usu�rio n�o pode ser deletado',
	'no_users' => 'N�o h� contas de usu�rio para exibir !',
	'already_logged' => 'Voc� j� est� logado como um membro !',
	'registration_not_allowed' => 'Usu�rios registrados est�o atualmente sem permiss�o !',
	'reg_email_failed' => 'Um erro ocorreu durante o envio da notifica��o de ativa��o por email !',
	'reg_activation_failed' => 'Um erro ocorreu durante o processo de ativa��o !'

);		
// Message body for email activation
$lang_user_registration_data['reg_confirm_body'] = <<<EOT
Obrigado pelo seu registro not {CALENDAR_NAME}

Seu login � : "{USERNAME}"
Sua senha � : "{PASSWORD}"

Para ativar sua conta, voc� precisa clicar no link abaixo ou copiar e colar no seu navegador.

{REG_LINK}

Atenciosamente,

O administrador do {CALENDAR_NAME}

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
	'section_title' => 'Administra��o de Evento',
	'events_to_approve' => 'Administra��o de Evento: Eventos para Aprovar',
	'upcoming_events' => 'Administra��o de Evento: Eventos Programados',
	'past_events' => 'Administra��o de Evento: Eventos Passados',
	'add_event' => 'Adicionar Novo Evento',
	'edit_event' => 'Editar Evento',
	'view_event' => 'Exibir Evento',
	'approve_event' => 'Aprovar Evento',
	'update_event' => 'Atualizar Informa��es do Evento',
	'delete_event' => 'Deletar Evento',
	'events_label' => 'Eventos',
	'auto_approve' => 'Auto-Aprovar',
	'date_label' => 'Data',
	'actions_label' => 'A��es',
	'events_filter_label' => 'Filtrar Eventos',
	'events_filter_options' => array('Mostrar todos eventos','Mostrar somente eventos n�o aprovados','Mostrar eventos programados','Mostrar somente eventos passados'),
	'picture_attached' => 'Imagem Anexada',
// View Event
	'view_event_name' => 'Evento: \'%s\'',
	'event_start_date' => 'Data',
	'event_end_date' => 'At�',
	'event_duration' => 'Dura��o',
	'contact_info' => 'Contato - Info',
	'contact_email' => 'Email',
	'contact_url' => 'URL',
// General Info
// Event form
	'edit_event_title' => 'Evento: \'%s\'',
	'cat_name' => 'Categoria',
	'event_start_date' => 'Data',
	'event_end_date' => 'At�',
	'contact_info' => 'Contato - Info',
	'contact_email' => 'Email',
	'contact_url' => 'URL',
	'no_event' => 'N�o h� eventos a serem exibidos.',
	'stats_string' => '<strong>%d</strong> Eventos no Total',
// Stats
	'stats_string1' => '<strong>%d</strong> evento(s)',
	'stats_string2' => 'Total: <strong>%d</strong> eventos na(s) %d p�gina(s)',
// Misc.
	'add_event_success' => 'Novo evento adicionado com sucesso',
	'edit_event_success' => 'Evento atualizado com sucesso',
	'approve_event_success' => 'Evento aprovado com sucesso',
	'delete_confirm' => 'Voc� tem certeza que quer deletar este evento ?',
	'delete_event_success' => 'Evento deletado com sucesso',
	'active_label' => 'Ativo',
	'not_active_label' => 'Inativo',
// Error messages
	'no_event_name' => 'Voc� deve fornecer um nome para este evento !',
	'no_event_desc' => 'Voc� deve fornecer uma descri��o para este evento !',
	'no_cat' => 'Voc� deve selecionar a categoria para este evento !',
	'no_day' => 'Voc� deve selecionar um dia !',
	'no_month' => 'Voc� deve selecionar um m�s !',
	'no_year' => 'Voc� deve selecionar um ano !',
	'non_valid_date' => 'Por favor, entre com uma data v�lida !',
	'end_days_invalid' => 'Por favor, verifique se o campo \'Days\' sobre \'Duration\' possui apenas n�meros !',
	'end_hours_invalid' => 'Por favor, verifique se o campo \'Hours\' sobre \'Duration\' possui apenas n�meros !',
	'end_minutes_invalid' => 'Por favor, verifique se o campo \'Minutes\' sobre \'Duration\' possui apenas n�meros !',
	'file_too_large' => 'A imagem � maior que %s KBytes !',
	'non_valid_extension' => 'O formato de arquivo da imagem n�o � suportado !',
	'delete_event_failed' => 'Este evento n�o pode ser deletado',
	'approve_event_failed' => 'Este evento n�o pode ser aprovado',
	'no_events' => 'N�o h� eventos para exibir !',
	'move_image_failed' => 'O sistema falhou ao mover a imagem !',
	'non_valid_dimensions' => 'A imagem tem largura ou altura maior que %s pixels !',
	
	'recur_val_1_invalid' => 'O valor digitado como \'repeat interval\' n�o � v�lido. Este valor deve ser um n�mero maior que \'0\' !',
	'recur_end_count_invalid' => 'O valor digitado como \'number of occurrences\' n�o � v�lido. Este valor deve ser um n�mero maior que \'0\' !',
	'recur_end_until_invalid' => 'A data do \'repeat until\' deve ser posterior a data inicial do evento !'

);

// ======================================================
// admin_categories.php
// ======================================================

if (defined('ADMIN_CATS_PHP')) 

$lang_cat_admin_data = array(
	'section_title' => 'Categoria -  Administra��o',
	'add_cat' => 'Adicionar Nova Categoria',
	'edit_cat' => 'Editar Categoria',
	'update_cat' => 'Atualizar Informa��o da Categoria',
	'delete_cat' => 'Deletar Categoria',
	'events_label' => 'Eventos',
	'auto_approve' => 'Auto-Aprovar',
	'actions_label' => 'A��es',
	'users_label' => 'Usus�rios',
	'admins_label' => 'Admins',
// General Info
	'general_info_label' => 'Informa��o Geral',
	'cat_name' => 'Nome da Categoria',
	'cat_desc' => 'Descri��o da Categoria',
	'cat_color' => 'Cor',
	'pick_color' => 'Esclha uma Cor!',
	'status_label' => 'Status',
// Administrative Options
	'admin_label' => 'Op��es Administrativas',
	'auto_admin_appr' => 'Auto-aprovar posts dos administradores',
	'auto_user_appr' => 'Auto-aprovar posts dos usu�rios',
// Stats
	'stats_string1' => '<strong>%d</strong> categorias',
	'stats_string2' => 'Ativo: <strong>%d</strong>&nbsp;&nbsp;&nbsp;Total: <strong>%d</strong>&nbsp;&nbsp;&nbsp;na(s) %d p�gina(s)',
// Misc.
	'add_cat_success' => 'Nova categoria adicionaca com sucesso',
	'edit_cat_success' => 'Categoria atualizada com sucesso',
	'delete_confirm' => 'Voc� est� certo que quer deletar esta categoria ?',
	'delete_cat_success' => 'Categoria deletada com sucesso',
	'active_label' => 'Ativo',
	'not_active_label' => 'Inativo',
// Error messages
	'no_cat_name' => 'Voc� deve fornecer um nome pare esta categoria !',
	'no_cat_desc' => 'Voc� deve fornecer uma descri��o para esta categoria !',
	'no_color' => 'Voc~e deve fornecer uma cor para esta categoria !',
	'delete_cat_failed' => 'Esta categoria n�o pode ser deletada',
	'no_cats' => 'N�o h� categorias para exibir!',
	'cat_has_events' => 'Esta categoria cont�m %d evento(s) e n�o pode ser deletada!<br>Por favor, delete os eventos que restam nessa categoria e tente novamente!'

);
// ======================================================
// admin_users.php
// ======================================================

if (defined('ADMIN_USERS_PHP')) 

$lang_user_admin_data = array(
	'section_title' => 'Administrador',
	'add_user' => 'Adicionar Novo Usu�rio',
	'edit_user' => 'Editar Informa��o de Usu�rio',
	'update_user' => 'Atualizar Informa��o de Usu�rio',
	'delete_user' => 'Deletar Conta de Usu�rio',
	'last_access' => '�ltimo Acesso',
	'actions_label' => 'A��es',
	'active_label' => 'Ativo',
	'not_active_label' => 'N�o Ativo',
// Account Info
	'account_info_label' => 'Informa��o da Conta',
	'user_name' => 'Login',
	'user_pass' => 'Senha',
	'user_pass_confirm' => 'Confirmar Senha',
	'user_email' => 'E-mail',
	'group_label' => 'Grupo de Membros',
	'status_label' => 'Status da Conta',
// Other Details
	'other_details_label' => 'Outras Informa��es',
	'first_name' => 'Nome',
	'last_name' => 'Sobrenome',
	'user_website' => 'Home page',
	'user_location' => 'Localiza��o',
	'user_occupation' => 'Ocupa��o',
// Stats
	'stats_string1' => '<strong>%d</strong> usu�rios',
	'stats_string2' => '<strong>%d</strong> usu�rios em %d p�gina(s)',
// Misc.
	'select_group' => 'Selecione uma...',
	'add_user_success' => 'Conta do usu�rio adicionada com sucesso',
	'edit_user_success' => 'Conta do usu�rio atualizada com sucesso',
	'delete_confirm' => 'Voc� est� certo que deseja deletar esta conta?',
	'delete_user_success' => 'Conta de usu�rio deletada com sucesso',
	'update_pass_info' => 'Deixa o compo de senha vazia se n�o deseja mud�-la',
	'access_never' => 'Nunca',
// Error messages
	'no_username' => 'Voc� deve fornecer o login !',
	'invalid_username' => 'Por favor, digite um nome para o login que tenha somente letras e n�meros  e entre 4 a 30 caracteres !',
	'invalid_password' => 'Por favor, digite uma senha com apenas letras e n�meros e entre 4 e 16 caracteres !',
	'password_is_username' => 'A senha deve ser diferente do login !',
	'password_not_match' =>'Senha n�o confirmada',
	'invalid_email' => 'Voc� deve fornecer uma email v�lido !',
	'email_exists' => 'Outro usu�rio j� est� registrado com seu email. Por favor, digite um email diferente !',
	'username_exists' => 'O login que voc� digitou j� existe. Por favor, tente registrar um outro nome para login !',
	'no_email' => 'Voc� deve fornecer um email !',
	'invalid_email' => 'Voc� deve fornecer uma email v�lido !',
	'no_password' => 'Voc� deve fornecer uma senha para esta conta !',
	'no_group' => 'Por favor selecione um grupo de mebros para este usu�rio !',
	'delete_user_failed' => 'Esta conta de usu�rio n�o pode ser deletada',
	'no_users' => 'N�o h� contas de usu�rio para exibir !'

);

// ======================================================
// admin_groups.php
// ======================================================

if (defined('ADMIN_GROUPS_PHP')) 

$lang_group_admin_data = array(
	'section_title' => 'Grupo - Administra��o',
	'add_group' => 'Adicionar Novo Grupo',
	'edit_group' => 'Editar Grupo',
	'update_group' => 'Atualizar Informa��es de Grupo',
	'delete_group' => 'Deletar Grupo',
	'view_group' => 'Visualizar Grupo',
	'users_label' => 'Membros',
	'actions_label' => 'A��es',
// General Info
	'general_info_label' => 'Informa��o Geral',
	'group_name' => 'Nome do Grupo',
	'group_desc' => 'Descri��o do Grupo',
// Group Access Level
	'access_level_label' => 'N�vel de Acesso do Grupo',
	'Administrator' => 'Usu�rios deste grupo tem acesso administrativo',
	'can_manage_accounts' => 'Usu�rios deste grupo podem manipular contas',
	'can_change_settings' => 'Usu�rios deste grupo podem mudar configura��es do calend�rio',
	'can_manage_cats' => 'Usu�rios deste grupo podem manipular categorias',
	'upl_need_approval' => 'Postar eventos requer aprova��o dos administradores',
// Stats
	'stats_string1' => '<strong>%d</strong> grupos',
	'stats_string2' => 'Total: <strong>%d</strong> grupos em %d p�gina(s)',
	'stats_string3' => 'Total: <strong>%d</strong> usu�rios em %d p�gina(s)',
// View Group Members
	'group_members_string' => 'Membros de \'%s\' grupos',
	'username_label' => 'Login',
	'firstname_label' => 'Primeiro Nome',
	'lastname_label' => 'Sobrenome',
	'email_label' => 'Email',
	'last_access_label' => '�ltimo Acesso',
	'edit_user' => 'Editar Uus�rio',
	'delete_user' => 'Deletar Usu�rio',
// Misc.
	'add_group_success' => 'Novo grupo adicionado com sucesso',
	'edit_group_success' => 'Grupo atualizado com sucesso',
	'delete_confirm' => 'Voc� est� certo que deseja atualizar este grupo ?',
	'delete_user_confirm' => 'Voc� est� certo que deseja deletar este grupo ?',
	'delete_group_success' => 'Grupo deletado com sucesso',
	'no_users_string' => 'N�o h� usu�rio neste grupo',
// Error messages
	'no_group_name' => 'Voc� deve fornecer um nome para o grupo !',
	'no_group_desc' => 'Voc� deve fornecer uma descri��o para este grupo !',
	'delete_group_failed' => 'Este grupo n�o pode ser deletado',
	'no_groups' => 'N�o h� grupos para serem exibidos !',
	'group_has_users' => 'Este grupo cont�m %d usu�rio(s) e n�o pode ser deletado!<br>Favor, desvincule os usu�rios restantes deste grupo e tente novamente!'

);

// ======================================================
// admin_settings.php / admin_settings_template.php / 
// admin_settings_updates.php
// ======================================================

$lang_settings_data = array(
	'section_title' => 'Configura��es do Calend�rio'
// Links
	,'admin_links_text' => 'Escolha a Se��o'
	,'admin_links' => array('Configura��es Principais','Configura��o de Template','Atualizar Programa')
// General Settings
	,'general_settings_label' => 'Configura��es Gerais'
	,'calendar_name' => 'Nome do Calend�rio'
	,'calendar_description' => 'Descri��o do Calend�rio'
	,'calendar_admin_email' => 'Email do Administrador do Calend�rio'
	,'cookie_name' => 'Nome para o cookie usado pelo script'
	,'cookie_path' => 'Path para o cookie usado pelo script'
	,'debug_mode' => 'Habilitar debug mode'
	,'calendar_status' => 'Status do Calend�rio'
// Environment Settings
	,'env_settings_label' => 'Configura��es Ambiente'
	,'lang' => 'Idioma'
		,'lang_name' => 'Idioma'
		,'lang_native_name' => 'Nome Nativo'
		,'lang_trans_date' => 'Traduzido em'
		,'lang_author_name' => 'Autor'
		,'lang_author_email' => 'E-mail'
		,'lang_author_url' => 'Website'
	,'charset' => 'Character encoding'
	,'theme' => 'Tema'
		,'theme_name' => 'Nome do Tema'
		,'theme_date_made' => 'Feito em'
		,'theme_author_name' => 'Autor'
		,'theme_author_email' => 'E-mail'
		,'theme_author_url' => 'Website'
	,'timezone' => 'Fuso Hor�rio'
	,'time_format' => 'Formato de exibi��o de horas'
		,'24hours' => '24 Hours'
		,'12hours' => '12 Hours'
	,'auto_daylight_saving' => 'Ajustar automaticamente hor�rio de ver�o (DST)'
	,'main_table_width' => 'Largura da tabela principal (Pixels ou %)'
	,'day_start' => 'Semana come�a em'
	,'default_view' => 'Visualiza��o padr�o'
	,'search_view' => 'Habilitar procura'
	,'archive' => 'Mostrar �ltimos eventos'
	,'events_per_page' => 'N�mero de eventos por p�gina'
	,'sort_order' => 'Ordem de classifica��o padr�o'
		,'sort_order_title_a' => 'T�tulo ascendente'
		,'sort_order_title_d' => 'T�tulo descendente'
		,'sort_order_date_a' => 'Date ascendente'
		,'sort_order_date_d' => 'Date descendente'
	,'show_recurrent_events' => 'Mostrar eventos recorrentes'
	,'multi_day_events' => 'Eventos em v�rios dias'
		,'multi_day_events_all' => 'Mostrar toda escala de data'
		,'multi_day_events_bounds' => 'Mostrar data inicial e final somente'
		,'multi_day_events_start' => 'Mostrar data inicial somente'
	// User Settings
	,'user_settings_label' => 'Configura��es do Usu�rio'
	,'allow_user_registration' => 'Permitir registro de usu�rios'
	,'reg_duplicate_emails' => 'Permitir emails duplicados'
	,'reg_email_verify' => 'Habilitar ativa��o de conta atrav�s de email'
// Event View
	,'event_view_label' => 'Visualizar Evento'
	,'popup_event_mode' => 'Evento Pop-up'
	,'popup_event_width' => 'Largura da Janela Pop-up'
	,'popup_event_height' => 'Altura da Janela Pop-up'
// Add Event View
	,'add_event_view_label' => 'Adicionar Visuliza��o de Evento'
	,'add_event_view' => 'Ativado'
	,'addevent_allow_html' => 'Permitir <b>BB Code</b> '
	,'addevent_allow_contact' => 'Permitir Contato'
	,'addevent_allow_email' => 'Permitir Email'
	,'addevent_allow_url' => 'Permitir URL'
	,'addevent_allow_picture' => 'Permitir Imagens'
	,'new_post_notification' => 'Postar Nova Notifica��o'
// Calendar View
	,'calendar_view_label' => 'Visualizar Calend�rio (Mensal) '
	,'monthly_view' => 'Ativado'
	,'cal_view_show_week' => 'Exibir N�mero da Semana'
	,'cal_view_max_chars' => 'Maximo de Caracteres na Descri��o'
// Flyer View
	,'flyer_view_label' => 'Flyer View'
	,'flyer_view' => 'Ativado'
	,'flyer_show_picture' => 'Exibir imagens na Flyer View'
	,'flyer_view_max_chars' => 'Maximo de Caracteres na Descri��o'
// Weekly View
	,'weekly_view_label' => 'Visualizar Semanas'
	,'weekly_view' => 'Ativado'
	,'weekly_view_max_chars' => 'Maximo de Caracteres na Descri��o'
// Daily View
	,'daily_view_label' => 'Visualizar Dias'
	,'daily_view' => 'Ativado'
	,'daily_view_max_chars' => 'Maximo de Caracteres na Descri��o'
// Categories View
	,'categories_view_label' => 'Visualizar Categorias'
	,'cats_view' => 'Ativado'
	,'cats_view_max_chars' => 'Maximo de Caracteres na Descri��o'
// Mini Calendar
	,'mini_cal_label' => 'Mini Calend�rio'
	,'mini_cal_def_picture' => 'Imagem Padr�o'
	,'mini_cal_display_picture' => 'Exibir Imagem'
	,'mini_cal_diplay_options' => array('Nenhuma','Imagem Padr�o', 'Imagens Di�ria','Imagem Semanal','Imagem Aleat�ria')
// Mail Settings
	,'mail_settings_label' => 'Configura��o de Correio'
	,'mail_method' => 'M�todo para Enviar Email'
	,'mail_smtp_host' => 'SMTP Hosts (separada por ponto e v�rgula ;)'
	,'mail_smtp_auth' => ' SMTP Autentica��o'
	,'mail_smtp_username' => 'SMTP Login'
	,'mail_smtp_password' => 'SMTP Senha'
	
	// Picture Settings
	,'picture_settings_label' => 'Configura��es de Imagems'
	,'max_upl_dim' => 'Max. largura ou altura para enviar imagens'
	,'max_upl_size' => 'Max. tamanho para enviar imagens (em Bytes)'
	,'picture_chmod' => 'Modo padr�o para imagens (CHMOD) (em Octal)'
	,'allowed_file_extensions' => 'Extens�es de arquivo permitidos para upload de imagens'
// Form Buttons
	,'update_config' => 'Salvar Nova Configura��o'
	,'restore_config' => 'Restaurar Padr�es'
// Misc.
	,'update_settings_success' => 'Configura��o salva com sucesso'
	,'restore_default_confirm' => 'Voc� ter certeza que quer restaurar as configura��es padr�o?'
// Template Configuration
	,'template_type' => 'Tipo de Template'
	,'template_header' => 'Personalizar Cabe�alho'
	,'template_footer' => 'Personalizar Rodap�'
	,'template_status_default' => 'Usar tema template padr�o'
	,'template_status_custom' => 'Usar o seguinte template:'
	,'template_custom' => 'Personalizar template'

	,'info_meta' => 'Meta Information'
	,'info_status' => 'Controle de Status'
	,'info_status_default' => 'Desabilitar este �ndice'
	,'info_status_custom' => 'Exibir o seguinte �ndice:'
	,'info_custom' => 'Personalizar �ndice'

	,'dynamic_tags' => 'Tags Din�micas'

// Product Updates
	,'updates_check_text' => 'Por favor espera enquanto n�s recuperamos a informa��o do servidor...'
	,'updates_no_response' => 'Nenhuma resposta do servidor. Por favor tente novamente mais tarde.'
	,'avail_updates' => 'Atualiza��o Dispon�vel'
	,'updates_download_zip' => 'Download ZIP package (.zip)'
	,'updates_download_tgz' => 'Download TGZ package (.tar.gz)'
	,'updates_released_label' => 'Release Date: %s'
	,'updates_no_update' => 'Voc� est� executando a �ltima vers�o dispon�vel. N�o � necess�rio atualiza��o.'
);

// ======================================================
// cal_mini.inc.php
// ======================================================

$lang_mini_cal = array(
	'def_pic' => 'Imagem Padr�o'
	,'daily_pic' => 'Imagem do Dia (%s)'
	,'weekly_pic' => 'Imagem da Semana (%s)'
	,'rand_pic' => 'Imagem Aleat�ria (%s)'
	,'post_event' => 'Postar Novo Evento'
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
	'section_title' => 'Tela de Login'
// General Settings
	,'login_intro' => 'Digitar seu login e senha para entrar'
	,'username' => 'Login'
	,'password' => 'Senha'
	,'remember_me' => 'Lembre-me'
	,'login_button' => 'Entrar'
// Errors
	,'invalid_login' => 'Por favor, verifique seu login e senha e tente novamente !'
	,'no_username' => 'Voc� deve digitar o login !'
	,'already_logged' => 'Voc� j� est� logado !'
);

// ======================================================
// logout.php
// ======================================================

// To Be Done


?>