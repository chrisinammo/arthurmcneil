<?php

/**
* @package Joomla
* @subpackage Fabrik
* @copyright Copyright (C) 2005 Rob Clayburn. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/


// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );


function com_install() {
	//@TODO only run this when installing for the first time
	global $mainframe;
	$db =& JFactory::getDBO();
	
	$db->setQuery("select count(*) from #__fabrik_connections");
	$c = $db->loadResult();
	//only load once (could be running from an upgrade)
	if($c == 0){
		
		
		
			$db->setQuery("INSERT INTO `#__fabrik_plugins` (name, label, type, state, iscore) VALUES ('fabrikfield', 'text field', 'element', 1, 1);");
			$db->query();
			$db->setQuery("INSERT INTO `#__fabrik_plugins` (name, label, type, state, iscore) VALUES ('fabrikaccess', 'access', 'element', 1, 1);");
			$db->query();
			$db->setQuery("INSERT INTO `#__fabrik_plugins` (name, label, type, state, iscore) VALUES ('fabrikcheckbox', 'checkbox', 'element', 1, 1);");
			$db->query();
			$db->setQuery("INSERT INTO `#__fabrik_plugins` (name, label, type, state, iscore) VALUES ('fabrikradiobutton', 'radio button', 'element', 1, 1);");
			$db->query();
			$db->setQuery("INSERT INTO `#__fabrik_plugins` (name, label, type, state, iscore) VALUES ('fabriktextarea', 'text area', 'element', 1, 1);");
			$db->query();
			$db->setQuery("INSERT INTO `#__fabrik_plugins` (name, label, type, state, iscore) VALUES ('fabrikdropdown', 'drop down', 'element', 1, 1);");
			$db->query();
			$db->setQuery("INSERT INTO `#__fabrik_plugins` (name, label, type, state, iscore) VALUES ('fabrikdisplaytext', 'display text', 'element', 1, 1);");
			$db->query();
			$db->setQuery("INSERT INTO `#__fabrik_plugins` (name, label, type, state, iscore) VALUES ('fabrikfileupload', 'file upload', 'element', 1, 1);");
			$db->query();
			$db->setQuery("INSERT INTO `#__fabrik_plugins` (name, label, type, state, iscore) VALUES ('fabrikimage', 'image', 'element', 1, 1);");
			$db->query();
			$db->setQuery("INSERT INTO `#__fabrik_plugins` (name, label, type, state, iscore) VALUES ('fabrikinternalid', 'id', 'element', '1', '1');");
			$db->query();
			$db->setQuery("INSERT INTO `#__fabrik_plugins` (name, label, type, state, iscore) VALUES ('fabrikuser', 'user', 'element', 1, 1);");
			$db->query();
			$db->setQuery("INSERT INTO `#__fabrik_plugins` (name, label, type, state, iscore) VALUES ('fabrikdate', 'date', 'element', 1, 1);");
			$db->query();
			$db->setQuery("INSERT INTO `#__fabrik_plugins` (name, label, type, state, iscore) VALUES ('fabrikdatabasejoin', 'database join', 'element', 1, 1);");
			$db->query();
			$db->setQuery("INSERT INTO `#__fabrik_plugins` (name, label, type, state, iscore) VALUES ('fabrikbutton', 'button', 'element', 1, 1);");
			$db->query();
			$db->setQuery("INSERT INTO `#__fabrik_plugins` (name, label, type, state, iscore) VALUES ('fabriklink', 'link', 'element', 1, 1);");
			$db->query();
			$db->setQuery("INSERT INTO `#__fabrik_plugins` (name, label, type, state, iscore) VALUES ('fabrikemail', 'email', 'form', 1, 1);");
			$db->query();
			$db->setQuery("INSERT INTO `#__fabrik_plugins` (name, label, type, state, iscore) VALUES ('fabrikreceipt', 'receipt', 'form', 1, 1);");
			$db->query();
			$db->setQuery("INSERT INTO `#__fabrik_plugins` (name, label, type, state, iscore) VALUES ('fabrikredirect', 'redirect', 'form', 1, 1);	");		
			$db->query();
			$db->setQuery("INSERT INTO `#__fabrik_plugins` (name, label, type, state, iscore) VALUES ('fabrikphp', 'Run PHP', 'form', 1, 1);");
			$db->query();
			$db->setQuery("INSERT INTO `#__fabrik_plugins` (name, label, type, state, iscore) VALUES ('notempty', 'Not empty', 'validationrule', 1, 1);");
			$db->query();
			$db->setQuery("INSERT INTO `#__fabrik_plugins` (name, label, type, state, iscore) VALUES ('isalphanumeric', 'Is alpha-numeric', 'validationrule', 1, 1);");
			$db->query();
			$db->setQuery("INSERT INTO `#__fabrik_plugins` (name, label, type, state, iscore) VALUES ('isemail', 'Is email', 'validationrule', 1, 1);");
			$db->query();
			$db->setQuery("INSERT INTO `#__fabrik_plugins` (name, label, type, state, iscore) VALUES ('calendar', 'calendar', 'visualization', '1', '1');");
			$db->query();
			$db->setQuery("INSERT INTO `#__fabrik_plugins` (name, label, type, state, iscore) VALUES ('googlemap', 'map', 'visualization', '1', '1');");
			$db->query();
			$db->setQuery("INSERT INTO `#__fabrik_plugins` (name, label, type, state, iscore) VALUES ('chart', 'chart', 'visualization', '1', '1');");
			
		$sql = "insert into #__fabrik_connections (`host`,`user`,`password`,`database`,`description`,`state`, `default`) " ;
	
		$sql .= "VALUES ('" . $mainframe->getCfg('host') . "', " . 
							 "\n '" . $mainframe->getCfg('user') ."', " . 
							 "\n '" . $mainframe->getCfg('password') ."', " . 
							 "\n '" . $mainframe->getCfg('db') ."', " . 
							 "\n'site database','1', '1')";
		
		$db->setQuery($sql);
		$db->query();
		
		/* Set up new icons for admin menu */
		$db->setQuery("UPDATE #__components SET admin_menu_img='../administrator/components/com_fabrik/images/logo.png' WHERE admin_menu_link LIKE 'option=com_fabrik%' AND admin_menu_alt='Fabrik'");
		$res = $db->query();
		
		$db->setQuery("UPDATE #__components SET admin_menu_img='../administrator/components/com_fabrik/images/connections.png' WHERE admin_menu_link LIKE 'option=com_fabrik%' AND admin_menu_alt='Connections'");
		$res = $db->query();
	
		$db->setQuery("UPDATE #__components SET admin_menu_img='../administrator/components/com_fabrik/images/tables.png' WHERE admin_menu_link LIKE 'option=com_fabrik%' AND admin_menu_alt='Tables'");
		$res = $db->query();
	
			$db->setQuery("UPDATE #__components SET admin_menu_img='../administrator/components/com_fabrik/images/forms.png' WHERE admin_menu_link LIKE 'option=com_fabrik%' AND admin_menu_alt='Forms'");
		$res = $db->query();
	
		$db->setQuery("UPDATE #__components SET admin_menu_img='../administrator/components/com_fabrik/images/groups.png' WHERE admin_menu_link LIKE 'option=com_fabrik%' AND admin_menu_alt='Groups'");
		$res = $db->query();
	
		$db->setQuery("UPDATE #__components SET admin_menu_img='../administrator/components/com_fabrik/images/elements.png' WHERE admin_menu_link LIKE 'option=com_fabrik%' AND admin_menu_alt='Elements'");
		$res = $db->query();
	
		$db->setQuery("UPDATE #__components SET admin_menu_img='../administrator/components/com_fabrik/images/validations.png' WHERE admin_menu_link LIKE 'option=com_fabrik%' AND admin_menu_alt='Form Validations'");
		$res = $db->query();
	
		$db->setQuery("UPDATE #__components SET admin_menu_img='../administrator/components/com_fabrik/images/validation_rules.png' WHERE admin_menu_link LIKE 'option=com_fabrik%' AND admin_menu_alt='Validation Rules'");
		$res = $db->query();
		
		// install event data
		
		$prefix = $mainframe->getCfg('dbprefix');
		$db->setQuery("INSERT INTO `#__fabrik_tables` (`id` ,`label` ,`introduction` ,`form_id` ,`db_table_name` ,`db_primary_key` ,
	`auto_inc` ,`connection_id` ,`created` ,`created_by` ,`created_by_alias` ,`modified` ,`modified_by` ,`checked_out` ,
	`checked_out_time` ,`state` ,`publish_up` ,`publish_down` ,`access` ,`hits` ,
	`rows_per_page` ,`template` ,`order_by` ,`order_dir` ,`filter_action` ,`group_by` ,`private` ,`attribs`
	)
	VALUES (
	1 , 'Events', 'This table is used to store the calendar visualization events. Only super administrators can see and edit it in administration. ', '1', '{$prefix}fabrik_calendar_events', '{$prefix}fabrik_calendar_events.id', '1', '1', NULL , '62', 'fabrik', NULL , '', '', NULL , '1', NULL , NULL , '0', '0', '10', 'default', 'jos_fabrik_calendar_events.start_date', 'DESC', 'onchange', '', '1', 'detaillink=0
	empty_data_msg=sorry no data found
	advanced-filter=0
	show-table-nav=1
	pdf=
	rss=0
	feed_title=
	feed_date=
	rsslimit=150
	rsslimitmax=2500
	csv_import_frontend=0
	csv_export_frontend=0
	csvfullname=0
	access=0
	allow_view_details=0
	allow_edit_details=18
	allow_add=18
	allow_delete=20
	group_by_order=
	group_by_order_dir=ASC
	prefilter_query='
		);");
		$res = $db->query();
		
		$db->setQuery("INSERT INTO `#__fabrik_forms` (
	`id` ,`label` ,`record_in_database` ,`error` ,`intro` ,`created` ,`created_by` ,`created_by_alias` ,
	`modified` ,`modified_by` ,`checked_out` ,`checked_out_time` ,`publish_up` ,
	`publish_down` ,`submit_button_label` ,`form_template` ,`view_only_template` ,`state` ,
	`attribs`
	)
	VALUES (
	1 , 'Add Event', '1', 'Some of the data is either missing or incorrect, please check your response and resubmit', '', '', '62', 'fabrik', '', '', '', '', NULL , NULL , 'Save', 'default', 'default', '1', 'reset_button=0
	reset_button_label=Reset
	copy_button=0
	copy_button_label=Save as a copy
	remove_table_filtres=0
	email_template=
	pdf=
	print=
	email='
	);");
	$res = $db->query();
	
	
	$db->setQuery("INSERT INTO `#__fabrik_groups` (
	`id` ,`name` ,`css` ,`label` ,`state` ,`created` ,`created_by` ,
	`created_by_alias` ,`modified` ,`modified_by` ,`checked_out` ,`checked_out_time` 
	,`is_join` , `private`, `attribs`	
	)
	VALUES (
	1 , 'events', '', '', '1', NOW( ) , '62', 'fabrik', '', '', '', '', '0', '1', 'repeat_group_button=0
	repeat_group_show_first=1
	repeat_group_js_add=
	repeat_group_js_delete='
	);");
	$res = $db->query();
	
	$db->setQuery("INSERT INTO `#__fabrik_formgroup` ( `id` ,`form_id` ,`group_id` ,`ordering`) VALUES ('1' , '1', '1', '1');");
	$res = $db->query();
	
	$fields = "INSERT INTO #__fabrik_elements (`id`, `name`, `group_id`, `plugin`, `label`, `checked_out`, `checked_out_time`, `created`, `created_by`, `created_by_alias`, `modified`, `modified_by`, `width`, `height`, `default`, `hidden`, `eval`, `ordering`, `show_in_table_summary`, `can_order`, `filter_type`, `filter_exact_match`, `state`, `button_javascript`, `link_to_detail`, `primary_key`, `auto_increment`, `access`, `use_in_page_title`, `sub_values`, `sub_labels`, `sub_intial_selection`, `attribs`) VALUES";
	$db->setQuery($fields ."(1, 'visualization_id', 1, 'fabrikdatabasejoin', 'Visualization', 0, '0000-00-00 00:00:00', '2008-04-08 10:46:08', 62, 'admin', '0000-00-00 00:00:00', 0, 20, 0, '', 0, 0, 1, 1, 0, '', 0, 1, '', 0, 0, 0, 0, 0, '', '', '', 'rollover=\nhover_text_title=\ncomment=\npassword=0\nmaxlength=255\ntext_format=text\ninteger_length=6\ndecimal_length=2\ntext_format_string=\nguess_linktype=0\ndisable=0\nreadonly=0\nck_value=\nelement_before_label=0\noptions_per_row=4\nradio_element_before_label=0\nuse_wysiwyg=0\nallow_frontend_addtodropdown=0\nmultiple=0\ndrd_initial_selection=\nul_max_file_size=\nul_file_types=\nul_directory=\nul_email_file=0\nul_file_increment=0\nupload_allow_folderselect=1\ndefault_image=\nmake_link=0\nfu_show_image_in_table=0\nfu_show_image=0\nimage_library=gd2\nfu_main_max_width=\nfu_main_max_height=\nmake_thumbnail=0\nthumb_dir=\nthumb_prefix=\nthumb_max_height=\nthumb_max_width=\nselectImage_root_folder=-1\nimage_front_end_select=0\nshow_image_in_table=0\nimage_float=none\nlink_url=\nmy_data=id\nupdate_on_edit=0\ndate_table_format=Y-m-d\ndate_form_format=%Y-%m-%d\ndate_showtime=0\ndatabase_join_display_type=dropdown\nshow_both_with_radio_dbjoin=0\njoinType=simple\njoin_conn_id=1\njoin_db_name=jos_fabrik_visualizations\njoin_key_column=id\njoin_val_column=label\nadvJoin_concat=\nadvJoin_key=\nadvJoin_startTable=\ndatabase_join_where_sql=\ndatabase_join_noselectionvalue=\nfabrikdatabasejoin_frontend_add=0\nfabrikdatabasejoin_popupform=1\nlink_target=_self\nview_access=0\nshow_in_rss_feed=0\nshow_label_in_rss_feed=0\nuse_as_fake_key=0\nfilter_access=0\nfull_words_only=0\nicon_folder=images/stories/food\ncustom_link=\nsum_on=0\nsum_access=0\nsum_split=\navg_on=0\navg_access=0\navg_split=\nmedian_on=0\nmedian_access=0\ncount_on=0\nmedian_split=\ncount_condition=\ncount_access=0\ncount_split=')");
	$res = $db->query();
	$db->setQuery($fields ."(2, 'label', 1, 'fabrikfield', 'label', 0, '0000-00-00 00:00:00', '2008-04-08 10:46:25', 62, 'admin', '0000-00-00 00:00:00', 0, 20, 0, '', 0, 0, 2, 1, 0, '', 0, 1, '', 0, 0, 0, 0, 0, '', '', '', 'rollover=\nhover_text_title=\ncomment=\npassword=0\nmaxlength=255\ntext_format=text\ninteger_length=6\ndecimal_length=2\ntext_format_string=\nguess_linktype=0\ndisable=0\nreadonly=0\nck_value=\nelement_before_label=0\noptions_per_row=4\nradio_element_before_label=0\nuse_wysiwyg=0\nallow_frontend_addtodropdown=0\nmultiple=0\ndrd_initial_selection=\nul_max_file_size=\nul_file_types=\nul_directory=\nul_email_file=0\nul_file_increment=0\nupload_allow_folderselect=1\ndefault_image=\nmake_link=0\nfu_show_image_in_table=0\nfu_show_image=0\nimage_library=gd2\nfu_main_max_width=\nfu_main_max_height=\nmake_thumbnail=0\nthumb_dir=\nthumb_prefix=\nthumb_max_height=\nthumb_max_width=\nselectImage_root_folder=-1\nimage_front_end_select=0\nshow_image_in_table=0\nimage_float=none\nlink_url=\nmy_data=id\nupdate_on_edit=0\ndate_table_format=Y-m-d\ndate_form_format=%Y-%m-%d\ndate_showtime=0\ndatabase_join_display_type=dropdown\nshow_both_with_radio_dbjoin=0\njoinType=simple\njoin_conn_id=-1\njoin_db_name=-1\njoin_key_column=\njoin_val_column=\nadvJoin_concat=\nadvJoin_key=\nadvJoin_startTable=\ndatabase_join_where_sql=\ndatabase_join_noselectionvalue=\nfabrikdatabasejoin_frontend_add=0\nfabrikdatabasejoin_popupform=1\nlink_target=_self\nview_access=0\nshow_in_rss_feed=0\nshow_label_in_rss_feed=0\nuse_as_fake_key=0\nfilter_access=0\nfull_words_only=0\nicon_folder=images/stories/food\ncustom_link=\nsum_on=0\nsum_access=0\nsum_split=\navg_on=0\navg_access=0\navg_split=\nmedian_on=0\nmedian_access=0\ncount_on=0\nmedian_split=\ncount_condition=\ncount_access=0\ncount_split=')");
	$res = $db->query();
	$db->setQuery($fields ."(3, 'start_date', 1, 'fabrikdate', 'start date', 0, '0000-00-00 00:00:00', '2008-04-08 10:46:52', 62, 'admin', '0000-00-00 00:00:00', 0, 20, 0, '', 0, 0, 3, 1, 0, '', 0, 1, '', 0, 0, 0, 0, 0, '', '', '', 'rollover=\nhover_text_title=\ncomment=\npassword=0\nmaxlength=255\ntext_format=text\ninteger_length=6\ndecimal_length=2\ntext_format_string=\nguess_linktype=0\ndisable=0\nreadonly=0\nck_value=\nelement_before_label=0\noptions_per_row=4\nradio_element_before_label=0\nuse_wysiwyg=0\nallow_frontend_addtodropdown=0\nmultiple=0\ndrd_initial_selection=\nul_max_file_size=\nul_file_types=\nul_directory=\nul_email_file=0\nul_file_increment=0\nupload_allow_folderselect=1\ndefault_image=\nmake_link=0\nfu_show_image_in_table=0\nfu_show_image=0\nimage_library=gd2\nfu_main_max_width=\nfu_main_max_height=\nmake_thumbnail=0\nthumb_dir=\nthumb_prefix=\nthumb_max_height=\nthumb_max_width=\nselectImage_root_folder=-1\nimage_front_end_select=0\nshow_image_in_table=0\nimage_float=none\nlink_url=\nmy_data=id\nupdate_on_edit=0\ndate_table_format=Y-m-d\ndate_form_format=%Y-%m-%d\ndate_showtime=1\ndatabase_join_display_type=dropdown\nshow_both_with_radio_dbjoin=0\njoinType=simple\njoin_conn_id=-1\njoin_db_name=-1\njoin_key_column=\njoin_val_column=\nadvJoin_concat=\nadvJoin_key=\nadvJoin_startTable=\ndatabase_join_where_sql=\ndatabase_join_noselectionvalue=\nfabrikdatabasejoin_frontend_add=0\nfabrikdatabasejoin_popupform=1\nlink_target=_self\nview_access=0\nshow_in_rss_feed=0\nshow_label_in_rss_feed=0\nuse_as_fake_key=0\nfilter_access=0\nfull_words_only=0\nicon_folder=images/stories/food\ncustom_link=\nsum_on=0\nsum_access=0\nsum_split=\navg_on=0\navg_access=0\navg_split=\nmedian_on=0\nmedian_access=0\ncount_on=0\nmedian_split=\ncount_condition=\ncount_access=0\ncount_split=')");
	$res = $db->query();
	$db->setQuery($fields ."(4, 'created_by', 1, 'fabrikuser', 'creator', 0, '0000-00-00 00:00:00', '2008-04-08 10:47:19', 62, 'admin', '0000-00-00 00:00:00', 0, 20, 0, '', 1, 0, 4, 1, 0, '', 0, 1, '', 0, 0, 0, 0, 0, '', '', '', 'rollover=\nhover_text_title=\ncomment=\npassword=0\nmaxlength=255\ntext_format=text\ninteger_length=6\ndecimal_length=2\ntext_format_string=\nguess_linktype=0\ndisable=0\nreadonly=0\nck_value=\nelement_before_label=0\noptions_per_row=4\nradio_element_before_label=0\nuse_wysiwyg=0\nallow_frontend_addtodropdown=0\nmultiple=0\ndrd_initial_selection=\nul_max_file_size=\nul_file_types=\nul_directory=\nul_email_file=0\nul_file_increment=0\nupload_allow_folderselect=1\ndefault_image=\nmake_link=0\nfu_show_image_in_table=0\nfu_show_image=0\nimage_library=gd2\nfu_main_max_width=\nfu_main_max_height=\nmake_thumbnail=0\nthumb_dir=\nthumb_prefix=\nthumb_max_height=\nthumb_max_width=\nselectImage_root_folder=-1\nimage_front_end_select=0\nshow_image_in_table=0\nimage_float=none\nlink_url=\nmy_data=id\nupdate_on_edit=0\ndate_table_format=Y-m-d\ndate_form_format=%Y-%m-%d\ndate_showtime=0\ndatabase_join_display_type=dropdown\nshow_both_with_radio_dbjoin=0\njoinType=simple\njoin_conn_id=-1\njoin_db_name=-1\njoin_key_column=\njoin_val_column=\nadvJoin_concat=\nadvJoin_key=\nadvJoin_startTable=\ndatabase_join_where_sql=\ndatabase_join_noselectionvalue=\nfabrikdatabasejoin_frontend_add=0\nfabrikdatabasejoin_popupform=1\nlink_target=_self\nview_access=0\nshow_in_rss_feed=0\nshow_label_in_rss_feed=0\nuse_as_fake_key=0\nfilter_access=0\nfull_words_only=0\nicon_folder=images/stories/food\ncustom_link=\nsum_on=0\nsum_access=0\nsum_split=\navg_on=0\navg_access=0\navg_split=\nmedian_on=0\nmedian_access=0\ncount_on=0\nmedian_split=\ncount_condition=\ncount_access=0\ncount_split=')");
	$res = $db->query();
	$db->setQuery($fields ."(5, 'created_by_alias', 1, 'fabrikfield', 'created by alias', 0, '0000-00-00 00:00:00', '2008-04-08 10:48:30', 62, 'admin', '0000-00-00 00:00:00', 0, 20, 0, 'global \$my;\r\nreturn \$my->username;', 1, 1, 5, 1, 0, '', 0, 1, '', 0, 0, 0, 0, 0, '', '', '', 'rollover=\nhover_text_title=\ncomment=\npassword=0\nmaxlength=255\ntext_format=text\ninteger_length=6\ndecimal_length=2\ntext_format_string=\nguess_linktype=0\ndisable=0\nreadonly=0\nck_value=\nelement_before_label=0\noptions_per_row=4\nradio_element_before_label=0\nuse_wysiwyg=0\nallow_frontend_addtodropdown=0\nmultiple=0\ndrd_initial_selection=\nul_max_file_size=\nul_file_types=\nul_directory=\nul_email_file=0\nul_file_increment=0\nupload_allow_folderselect=1\ndefault_image=\nmake_link=0\nfu_show_image_in_table=0\nfu_show_image=0\nimage_library=gd2\nfu_main_max_width=\nfu_main_max_height=\nmake_thumbnail=0\nthumb_dir=\nthumb_prefix=\nthumb_max_height=\nthumb_max_width=\nselectImage_root_folder=-1\nimage_front_end_select=0\nshow_image_in_table=0\nimage_float=none\nlink_url=\nmy_data=username\nupdate_on_edit=0\ndate_table_format=Y-m-d\ndate_form_format=%Y-%m-%d\ndate_showtime=0\ndatabase_join_display_type=dropdown\nshow_both_with_radio_dbjoin=0\njoinType=simple\njoin_conn_id=-1\njoin_db_name=-1\njoin_key_column=\njoin_val_column=\nadvJoin_concat=\nadvJoin_key=\nadvJoin_startTable=\ndatabase_join_where_sql=\ndatabase_join_noselectionvalue=\nfabrikdatabasejoin_frontend_add=0\nfabrikdatabasejoin_popupform=1\nlink_target=_self\nview_access=0\nshow_in_rss_feed=0\nshow_label_in_rss_feed=0\nuse_as_fake_key=0\nfilter_access=0\nfull_words_only=0\nicon_folder=images/stories/food\ncustom_link=\nsum_on=0\nsum_access=0\nsum_split=\navg_on=0\navg_access=0\navg_split=\nmedian_on=0\nmedian_access=0\ncount_on=0\nmedian_split=\ncount_condition=\ncount_access=0\ncount_split=')");
	$res = $db->query();
	$db->setQuery($fields ."(6, 'description', 1, 'fabriktextarea', 'description', 0, '0000-00-00 00:00:00', '2008-04-08 10:48:51', 62, 'admin', '0000-00-00 00:00:00', 0, 20, 3, '', 0, 0, 6, 1, 0, '', 0, 1, '', 0, 0, 0, 0, 0, '', '', '', 'rollover=\nhover_text_title=\ncomment=\npassword=0\nmaxlength=255\ntext_format=text\ninteger_length=6\ndecimal_length=2\ntext_format_string=\nguess_linktype=0\ndisable=0\nreadonly=0\nck_value=\nelement_before_label=0\noptions_per_row=4\nradio_element_before_label=0\nuse_wysiwyg=0\nallow_frontend_addtodropdown=0\nmultiple=0\ndrd_initial_selection=\nul_max_file_size=\nul_file_types=\nul_directory=\nul_email_file=0\nul_file_increment=0\nupload_allow_folderselect=1\ndefault_image=\nmake_link=0\nfu_show_image_in_table=0\nfu_show_image=0\nimage_library=gd2\nfu_main_max_width=\nfu_main_max_height=\nmake_thumbnail=0\nthumb_dir=\nthumb_prefix=\nthumb_max_height=\nthumb_max_width=\nselectImage_root_folder=-1\nimage_front_end_select=0\nshow_image_in_table=0\nimage_float=none\nlink_url=\nmy_data=id\nupdate_on_edit=0\ndate_table_format=Y-m-d\ndate_form_format=%Y-%m-%d\ndate_showtime=0\ndatabase_join_display_type=dropdown\nshow_both_with_radio_dbjoin=0\njoinType=simple\njoin_conn_id=-1\njoin_db_name=-1\njoin_key_column=\njoin_val_column=\nadvJoin_concat=\nadvJoin_key=\nadvJoin_startTable=\ndatabase_join_where_sql=\ndatabase_join_noselectionvalue=\nfabrikdatabasejoin_frontend_add=0\nfabrikdatabasejoin_popupform=1\nlink_target=_self\nview_access=0\nshow_in_rss_feed=0\nshow_label_in_rss_feed=0\nuse_as_fake_key=0\nfilter_access=0\nfull_words_only=0\nicon_folder=images/stories/food\ncustom_link=\nsum_on=0\nsum_access=0\nsum_split=\navg_on=0\navg_access=0\navg_split=\nmedian_on=0\nmedian_access=0\ncount_on=0\nmedian_split=\ncount_condition=\ncount_access=0\ncount_split=')");
	$res = $db->query();
	}
?>
	<h3>Fabrik 2.0 Installed Successfully</h3>
	<p>
	<a href="index.php?option=com_fabrik&amp;task=installSampleData">Click here to install sample data</a></p>

	<?php
}
?>
