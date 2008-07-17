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

$File: extcalendar.php - Calendar view display$

Revision date: 03/07/2007

**********************************************
Get the latest version of JCal Pro at:
http://dev.anything-digital.com//
**********************************************
*/

/** ensure this file is being included by a parent file */
defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );

require_once($CONFIG_EXT['ADMIN_PATH']. DS . 'admin.config.inc.php');
jimport('joomla.html.pane');
jimport('joomla.application.module.helper');

// Start buffering
ob_start();

function form_admin_sections($name, $default_value = 0)
{
   global $CONFIG_EXT, $lang_settings_data, $ME;
   $my = &JFactory::getUser();
   $database = &JFactory::getDBO();

  $links = 	array(
  						"admin_settings.php",
  						"admin_settings_template.php",
  						"admin_settings_updates.php"
  					);
  $selected = array();
  $selected[] = ($default_value == sizeof($selected)) ? 'selected' : '';
  $selected[] = ($default_value == sizeof($selected)) ? 'selected' : '';
  $selected[] = ($default_value == sizeof($selected)) ? 'selected' : '';

	echo <<<EOT
<!-- BEGIN link_row -->
		<tr class="tablec">
			<form name="admin_links" action="$ME" method="get">
			<td height="35" colspan="2" nowrap='nowrap' class="tablec" align="right" valign="middle"><span class="atomic">{$lang_settings_data['admin_links_text']}:</span>&nbsp;
				<select name='admin_links' class='listbox' onChange="document.location.replace(this.value);">
            <option value="{$links[0]}" {$selected[0]} >{$lang_settings_data[$name][0]}</option>
            <option value="{$links[1]}" {$selected[1]} >{$lang_settings_data[$name][1]}</option>
            <option value="{$links[2]}" {$selected[2]} >{$lang_settings_data[$name][2]}</option>
				</select>
			</td>
			</form>
		</tr>
<!-- END link_row -->
EOT;
}

function form_label($text, $tabs)
{
	if ( isset ( $GLOBALS['bool'] ) )
	{
		echo '</table>';
		
		echo $tabs->endPanel();
	}
	
	echo $tabs->startPanel($text, $text);
	
	echo <<<EOT
		<table class="adminform" border="1">
			<tr>
				<th colspan="2">
					$text
				</th>
			</tr>
	
EOT;
	$GLOBALS['bool'] = 'test';

}

function form_input($text, $name)
{
    global $CONFIG_EXT;
    $database = &JFactory::getDBO();

    $value = $CONFIG_EXT[$name];

    echo <<<EOT
        <tr>
            <td width="50%" class="tableb">
                        $text
        		</td>
        		<td width="30%" class="tableb" valign="top">
                <input type="text" class="textinput" name="$name" value="$value">
             </td>
        </tr>
EOT;
}

function form_yes_no($text, $name)
{
    global $CONFIG_EXT, $lang_general;
    $database = &JFactory::getDBO();
    
    $value = $CONFIG_EXT[$name];
    $yes_selected = $value ? 'selected' : '';
    $no_selected = !$value ? 'selected' : '';
		$yes = $lang_general['yes'];
		$no = $lang_general['no'];
		
    echo <<<EOT
        <tr>
            <td class="tableb">
                        $text
        </td>
        <td class="tableb" valign="top">
                        <select name="$name" class="listbox">
                                <option value="1" $yes_selected>$yes</option>
                                <option value="0" $no_selected>$no</option>
                        </select>
                </td>
        </tr>

EOT;
}

function form_yes_no_firstonly($text, $name)
{
    global $CONFIG_EXT, $lang_general;
    $database = &JFactory::getDBO();
    
    $value = $CONFIG_EXT[$name];
    $yes_selected = $value == 1 ? 'selected' : '';
    $no_selected = $value == 0 ? 'selected' : '';
    $firstonly_selected = $value == 2 ? 'selected' : '';
		$yes = $lang_general['yes'];
		$no = $lang_general['no'];
		$firstonly = 'First Only';
		
    echo <<<EOT
        <tr>
            <td class="tableb">
                        $text
        </td>
        <td class="tableb" valign="top">
                        <select name="$name" class="listbox">
                                <option value="1" $yes_selected>$yes</option>
                                <option value="0" $no_selected>$no</option>
                                <option value="2" $firstonly_selected>$firstonly</option>
                        </select>
                </td>
        </tr>

EOT;
}

function form_start_day($text, $name)
{
    global $CONFIG_EXT, $lang_date_format;
    $database = &JFactory::getDBO();

    $value = $CONFIG_EXT[$name];
    $sunday_select = $value == 0 ? 'selected' : '';
    $monday_select = $value == 1 ? 'selected' : '';
		$sunday = $lang_date_format['day_of_week'][0];
		$monday = $lang_date_format['day_of_week'][1];
		
    echo <<<EOT
        <tr>
            <td class="tableb">
                        $text
        </td>
        <td class="tableb" valign="top">
                        <select name="$name" class="listbox">
                                <option value="0" $sunday_select>$sunday</option>
                                <option value="1" $monday_select>$monday</option>
                        </select>
                </td>
        </tr>

EOT;
}

function form_sort_order($text, $name)
{
    global $CONFIG_EXT, $lang_settings_data;
    $database = &JFactory::getDBO();

    $value = $CONFIG_EXT[$name];
    $ta_selected = ($value == 'title_asc') ? 'selected' : '';
    $td_selected = ($value == 'title_desc') ? 'selected' : '';
    $da_selected = ($value == 'date_asc') ? 'selected' : '';
    $dd_selected = ($value == 'date_desc') ? 'selected' : '';

    echo <<<EOT
        <tr>
            <td class="tableb">
                        $text
        </td>
        <td class="tableb" valign="top">
                        <select name="$name" class="listbox">
                                <option value="title_asc" $ta_selected>{$lang_settings_data['sort_order_title_a']}</option>
                                <option value="title_desc" $td_selected>{$lang_settings_data['sort_order_title_d']}</option>
                                 <option value="date_asc" $da_selected>{$lang_settings_data['sort_order_date_a']}</option>
                                <option value="date_desc" $dd_selected>{$lang_settings_data['sort_order_date_d']}</option>
                        </select>
                </td>
        </tr>

EOT;
}

function form_default_view($text, $name)
{
    global $CONFIG_EXT, $lang_settings_data;
    $database = &JFactory::getDBO();

    $value = $CONFIG_EXT[$name];
    $day_view_select = ($value == 0) ? 'selected' : '';
    $week_view_select = ($value == 1) ? 'selected' : '';
    $cal_view_select = ($value == 2) ? 'selected' : '';
    $flyer_view_select = ($value == 3) ? 'selected' : '';
	$cats_view_select = ($value == 4) ? 'selected' : '';
	
    $day_view = $lang_settings_data['daily_view_label']; 
    $week_view = $lang_settings_data['weekly_view_label'];
    $cal_view = $lang_settings_data['calendar_view_label'];
    $flyer_view = $lang_settings_data['flyer_view_label'];
    $cats_view = $lang_settings_data['categories_view_label'];
    
    echo <<<EOT
        <tr>
            <td class="tableb">
                        $text
        </td>
        <td class="tableb" valign="top">
                        <select name="$name" class="listbox">
                                <option value="0" $day_view_select>$day_view</option>
                                <option value="1" $week_view_select>$week_view</option>
                                <option value="2" $cal_view_select>$cal_view</option>
                                <option value="3" $flyer_view_select>$flyer_view</option>
								<option value="4" $cats_view_select>$cats_view</option>
                        </select>
                </td>
        </tr>

EOT;
}

function form_timezone($text, $name)
{
    global $CONFIG_EXT;
    $database = &JFactory::getDBO();

    $timezone = $CONFIG_EXT[$name];
    echo <<<EOT
        <tr>
            <td width="50%" class="tableb">
                        $text
        </td>
        <td width="30%" class="tableb" valign="top">
EOT;
?>
					<select name="<?php echo $name?>" class="listbox">
						<option value="-12" <?php echo ($timezone == '-12')?"selected":"";?>>(GMT -12:00) Eniwetok, Kwajalein</option>
						<option value="-11" <?php echo ($timezone == '-11')?"selected":"";?>>(GMT -11:00) Midway Island, Samoa</option>
						<option value="-10" <?php echo ($timezone == '-10')?"selected":"";?>>(GMT -10:00) Hawaii</option>
						<option value="-9" <?php echo ($timezone == '-9')?"selected":"";?>>(GMT -9:00) Alaska</option>
						<option value="-8" <?php echo ($timezone == '-8')?"selected":"";?>>(GMT -8:00) Pacific Time (US & Canada)</option>
						<option value="-7" <?php echo ($timezone == '-7')?"selected":"";?>>(GMT -7:00) Mountain Time (US & Canada)</option>
						<option value="-6" <?php echo ($timezone == '-6')?"selected":"";?>>(GMT -6:00) Central Time (US & Canada)</option>
						<option value="-5" <?php echo ($timezone == '-5')?"selected":"";?>>(GMT -5:00) Eastern Time (US & Canada)</option>
						<option value="-4" <?php echo ($timezone == '-4')?"selected":"";?>>(GMT -4:00) Atlantic Time (Canada)</option>
						<option value="-3.5" <?php echo ($timezone == '-3.5')?"selected":"";?>>(GMT -3:30) Newfoundland</option>
						<option value="-3" <?php echo ($timezone == '-3')?"selected":"";?>>(GMT -3:00) Brazil, Buenos Aires</option>
						<option value="-2" <?php echo ($timezone == '-2')?"selected":"";?>>(GMT -2:00) Mid-Atlantic</option>
						<option value="-1" <?php echo ($timezone == '-1')?"selected":"";?>>(GMT -1:00) Azores, Cape Verde Islands</option>
						<option value="0" <?php echo ($timezone == '0')?"selected":"";?>>(GMT) Western Europe Time, Casablanca</option>
						<option value="1" <?php echo ($timezone == '1')?"selected":"";?>>(GMT +1:00) CET(Central Europe Time)</option>
						<option value="2" <?php echo ($timezone == '2')?"selected":"";?>>(GMT +2:00) EET(Eastern Europe Time)</option>
						<option value="3" <?php echo ($timezone == '3')?"selected":"";?>>(GMT +3:00) Baghdad, Kuwait, Riyadh</option>
						<option value="3.5" <?php echo ($timezone == '3.5')?"selected":"";?>>(GMT +3:30) Tehran</option>
						<option value="4" <?php echo ($timezone == '4')?"selected":"";?>>(GMT +4:00) Abu Dhabi, Muscat</option>
						<option value="4.5" <?php echo ($timezone == '4.5')?"selected":"";?>>(GMT +4:30) Kabul</option>
						<option value="5" <?php echo ($timezone == '5')?"selected":"";?>>(GMT +5:00) Ekaterinburg, Islamabad</option>
						<option value="5.5" <?php echo ($timezone == '5.5')?"selected":"";?>>(GMT +5:30) Bombay, Calcutta</option>
						<option value="6" <?php echo ($timezone == '6')?"selected":"";?>>(GMT +6:00) Almaty, Dhaka, Colombo</option>
						<option value="7" <?php echo ($timezone == '7')?"selected":"";?>>(GMT +7:00) Bangkok, Hanoi</option>
						<option value="8" <?php echo ($timezone == '8')?"selected":"";?>>(GMT +8:00) Beijing, Perth</option>
						<option value="9" <?php echo ($timezone == '9')?"selected":"";?>>(GMT +9:00) Tokyo, Seoul, Osaka</option>
						<option value="9.5" <?php echo ($timezone == '9.5')?"selected":"";?>>(GMT +9:30) Adelaide, Darwin</option>
						<option value="10" <?php echo ($timezone == '10')?"selected":"";?>>(GMT +10:00) (East Australian Standard)</option>
						<option value="11" <?php echo ($timezone == '11')?"selected":"";?>>(GMT +11:00) Magadan, Solomon Islands</option>
						<option value="12" <?php echo ($timezone == '12')?"selected":"";?>>(GMT +12:00) Auckland, Wellington</option>
					</select>			 
<?php
		echo <<<EOT
           </td>
        </tr>

EOT;
}

function form_charset($text, $name)
{
    global $CONFIG_EXT;
    $database = &JFactory::getDBO();

    $charsets = array('Default' => 'language-file',
        'Arabic' => 'iso-8859-6',
        'Baltic' => 'iso-8859-4',
        'Central European' => 'iso-8859-2',
        'Chinese Simplified' => 'euc-cn',
        'Chinese Traditional' => 'big5',
        'Cyrillic' => 'koi8-r',
        'Greek' => 'iso-8859-7',
        'Hebrew' => 'iso-8859-8-i',
        'Icelandic' => 'x-mac-icelandic',
        'Japanese' => 'euc-jp',
        'Korean' => 'euc-kr',
        'Maltese' => 'iso-8859-3',
        'Thai' => 'windows-874 ',
        'Turkish' => 'iso-8859-9',
        'Unicode' => 'utf-8',
        'Vietnamese' => 'windows-1258',
        'Western' => 'iso-8859-1'
        );

    $value = strtolower($CONFIG_EXT[$name]);

    echo <<<EOT
        <tr>
            <td class="tableb">
                        $text
        </td>
        <td class="tableb" valign="top">
                        <select name="$name" class="listbox">

EOT;
    foreach ($charsets as $country => $charset) {
        echo "                                <option value=\"$charset\" " . ($value == $charset ? 'selected' : '') . ">$country ($charset)</option>\n";
    }
    echo <<<EOT
                        </select>
                </td>
        </tr>

EOT;
}

function form_language($text, $name)
{
    global $CONFIG_EXT, $lang_info, $lang_settings_data;
    $database = &JFactory::getDBO();

    $value = strtolower($CONFIG_EXT[$name]);
		$language_dir = $CONFIG_EXT['LANGUAGES_DIR'];
		
    $dir = opendir($language_dir);
    while ($dir_name = readdir($dir)) {
        if (is_dir($language_dir . $dir_name) && is_file($language_dir . $dir_name ."/index.php") && $dir_name != '.' && $dir_name != '..') {
            $lang_array[] = $dir_name;
        }
    }
    closedir($dir);

    natcasesort($lang_array);

    echo <<<EOT
        <tr>
          <td class="tableb" valign="top">
	          $text
		      </td>
		      <td class="tableb" valign="top">
            <select name="$name" class="listbox">

EOT;
    foreach ($lang_array as $language) {
        echo "                                <option value=\"$language\" " . ($value == $language ? 'selected' : '') . ">" . get_language_name($language) . "</option>\n";
    }

    echo <<<EOT
            </select>
          </td>
        </tr>
        <tr>
          <td class="tablec" colspan="2">
						<table border="0" cellspacing="6" cellpadding="0" width="98%" align="center">
							<tr>
								<td width="50%" class="atomic">$lang_settings_data[lang_name] <b>:</b> $lang_info[name]</td>
								<td width="50%" class="atomic">$lang_settings_data[lang_author_name] <b>:</b> $lang_info[author]</td>
							</tr>
							<tr>
								<td width="50%" class="atomic">$lang_settings_data[lang_native_name] <b>:</b> $lang_info[nativename]</td>
								<td width="50%" class="atomic">$lang_settings_data[lang_trans_date] <b>:</b> $lang_info[transdate]</td>
							</tr>
							<tr>
								<td width="50%" class="atomic">$lang_settings_data[lang_author_email] <b>:</b> <a href="mailto:$lang_info[author_email]">$lang_info[author_email]</a></td>
								<td width="50%" class="atomic">$lang_settings_data[lang_author_url] <b>:</b> <a href="$lang_info[author_url]" target="_blank">$lang_info[author_url]</a></td>
							</tr>
						</table>
	        </td>
        </tr>

EOT;
}

function form_theme($text, $name)
{
    global $CONFIG_EXT, $theme_info, $lang_settings_data;
    $database = &JFactory::getDBO();

    echo <<<EOT
        <tr>
          <td class="tableb" valign="top">
						$text (you can change theme in theme manager)
	        </td>
	        <td class="tableb" valign="top">

EOT;
        echo ucfirst ( $CONFIG_EXT['theme'] );

    echo <<<EOT
                </td>
        </tr>
        <tr>
          <td class="tablec" colspan="2">
						<table border="0" cellspacing="6" cellpadding="0" width="98%" align="center">
							<tr>
								<td width="50%" class="atomic">$lang_settings_data[theme_name] <b>:</b> $theme_info[name]</td>
								<td width="50%" align="center" rowspan="5">		   					
									<div id="theme"><img src="{$CONFIG_EXT['calendar_url']}themes/$CONFIG_EXT[theme]/images/preview.gif"></div>
								</td>
							</tr>
							<tr>
								<td width="50%" class="atomic">$lang_settings_data[theme_date_made] <b>:</b> $theme_info[datemade]</td>
							</tr>
							<tr>
								<td width="50%" class="atomic">$lang_settings_data[theme_author_name] <b>:</b> $theme_info[author]</td>
							</tr>
							<tr>
								<td width="50%" class="atomic">$lang_settings_data[theme_author_email] <b>:</b> <a href="mailto:$theme_info[author_email]">$theme_info[author_email]</a></td>
							</tr>
							<tr>
								<td width="50%" class="atomic">$lang_settings_data[theme_author_url] <b>:</b> <a href="$theme_info[author_url]" target="_blank">$theme_info[author_url]</a></td>
							</tr>
						</table>
	        </td>
        </tr>
EOT;
}

function form_mini_cal_display_options($text, $name)
{
    global $CONFIG_EXT, $lang_settings_data;
    $database = &JFactory::getDBO();

    $value = $CONFIG_EXT[$name];
    $none_selected = ($value == '0') ? 'selected' : '';
    $def_selected = ($value == '1') ? 'selected' : '';
    $daily_selected = ($value == '2') ? 'selected' : '';
    $weekly_selected = ($value == '3') ? 'selected' : '';
    $random_selected = ($value == '4') ? 'selected' : '';
    echo <<<EOT
      <tr>
        <td class="tableb">
          $text
        </td>
        <td class="tableb" valign="top">
          <select name="$name" class="listbox">
            <option value="0" $none_selected>{$lang_settings_data[$name][0]}</option>
            <option value="1" $def_selected>{$lang_settings_data[$name][1]}</option>
            <option value="2" $daily_selected>{$lang_settings_data[$name][2]}</option>
            <option value="3" $weekly_selected>{$lang_settings_data[$name][3]}</option>
            <option value="4" $random_selected>{$lang_settings_data[$name][4]}</option>
          </select>
        </td>
      </tr>

EOT;
}

function form_time_format ($text, $name)
{
    global $mainframe, $CONFIG_EXT, $lang_settings_data, $lang_info, $lang_date_format;
    $database = &JFactory::getDBO();

    $value = $CONFIG_EXT[$name];
    $sel_24hours = $value ? 'selected' : '';
    $sel_12hours = !$value ? 'selected' : '';
		$label_24hour = $lang_settings_data['24hours'];
		$label_12hour = $lang_settings_data['12hours'];

    echo <<<EOT
        <tr>
            <td class="tableb">
                        $text
        </td>
        <td class="tableb" valign="top">
                        <select name="$name" class="listbox">
                                <option value="1" $sel_24hours>$label_24hour</option>
                                <option value="0" $sel_12hours>$label_12hour</option>
                        </select>
                </td>
        </tr>

EOT;
    $language = &JFactory::getLanguage();
    $lang_setting = $language->getBackwardLang();
    $local_name = $lang_info['nativename'];
    $locale_setting = $lang_info['locale'];
    $locale_setting_str = implode(",",$locale_setting);
    $locale_str = setlocale(LC_ALL,$locale_setting);
    $locale_error = empty($locale_str) ? '<span style="color: #FF0000">NO MATCHING SYSTEM LOCALE FOUND</span>' : "(first server locale match)";
    $sample_24 = strftime($lang_date_format['full_date_time_24hour']);
    $sample_12 = strftime($lang_date_format['full_date_time_12hour']);

    echo <<<EOF
        <tr>
            <td class="tablec" colspan="2">
			    <table border="0" cellspacing="6" cellpadding="0" width="98%" align="center">
                    <tr>
                        <td>Joomla language:</td>
                        <td colspan="2">$lang_setting</td>
                    </tr>
                    <tr>
                        <td>JCalPro language:</td>
                        <td>$local_name</td>
                        <td>Using "com_jcalpro/languages/$lang_setting/index.php"</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Locale settings to attempt:</td>
                        <td>$locale_setting_str</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Locale setting successful:</td>
                        <td>$locale_str</td>
                        <td>$locale_error</td>
                    </tr>
                    <tr>
                        <td>Date/time in 24-hour format:</td>
                        <td colspan="2">$sample_24</td>
                    </tr>
                    <tr>
                        <td>Date/time in 12-hour format:</td>
                        <td colspan="2">$sample_12</td>
                    </tr>
                </table>
            </td>
        </tr>

EOF;
}

function form_status($text, $name)
{
    global $CONFIG_EXT, $lang_general;
    $database = &JFactory::getDBO();

    $value = $CONFIG_EXT[$name];
    $yes_selected = $value ? 'selected' : '';
    $no_selected = !$value ? 'selected' : '';
		$yes = $lang_general['active'];
		$no = $lang_general['not_active'];
		
    echo <<<EOT
        <tr>
            <td class="tableb">
                        $text
        </td>
        <td class="tableb" valign="top">
                        <select name="$name" class="listbox">
                                <option value="1" $yes_selected>$yes</option>
                                <option value="0" $no_selected>$no</option>
                        </select>
                </td>
        </tr>

EOT;
}

function form_multi_day_events($text, $name)
{
    global $CONFIG_EXT, $lang_settings_data;
    $database = &JFactory::getDBO();

    $value = $CONFIG_EXT[$name];
    $all_selected = ($value == 'all') ? 'selected' : '';
    $bounds_selected = ($value == 'bounds') ? 'selected' : '';
    $start_selected = ($value == 'start') ? 'selected' : '';

    echo <<<EOT
        <tr>
            <td class="tableb">
                        $text
        </td>
        <td class="tableb" valign="top">
                        <select name="$name" class="listbox">
                                <option value="all" $all_selected>{$lang_settings_data['multi_day_events_all']}</option>
                                <option value="bounds" $bounds_selected>{$lang_settings_data['multi_day_events_bounds']}</option>
                                <option value="start" $start_selected>{$lang_settings_data['multi_day_events_start']}</option>
                        </select>
                </td>
        </tr>

EOT;
}

function form_mail_method($text, $name)
{
    global $CONFIG_EXT;
    $database = &JFactory::getDBO();

    $mail_methods = array(
        'SMTP' => 'smtp',
    		'PHP Mail' => 'mail',
        'Sendmail' => 'sendmail',
        'Qmail' => 'qmail'
        );

    $value = strtolower($CONFIG_EXT[$name]);

    echo <<<EOT
        <tr>
          <td class="tableb">
            $text
        	</td>
        	<td class="tableb" valign="top">
            <select name="$name" class="listbox">

EOT;
    foreach ($mail_methods as $method_name => $method) {
        echo "                                <option value=\"$method\" " . ($value == $method ? 'selected' : '') . ">$method_name</option>\n";
    }
    echo <<<EOT
          </select>
				  </td>
        </tr>

EOT;
}
function form_user_level($text, $name)
{
    global $CONFIG_EXT;
    $database = &JFactory::getDBO();
    $acl = &JFactory::getACL();

		$groupA = $acl->get_group_children_tree( null, 'USERS', false );
		
		foreach ( $groupA as $groupAKey => $groupAValue )
		{		
			$groupAValue->textEdit = str_replace ( "&nbsp;", "", $groupAValue->text );
			$groupAValue->textEdit = str_replace ( "-", "", $groupAValue->textEdit );
			$groupAValue->textEdit = str_replace ( ".", "", $groupAValue->textEdit );
			
			$groupAValue->textEdit =	strtolower ( $groupAValue->textEdit );
			
			$user_levels[$groupAValue->text] = $groupAValue->textEdit;
		}

    $value = $CONFIG_EXT[$name];

    echo <<<EOT
        <tr>
          <td class="tableb">
            $text
        	</td>
        	<td class="tableb" valign="top">
            <select name="$name" class="listbox">

EOT;
    foreach ($user_levels as $userlevel_name => $userlevel) {
        echo "                                <option value=\"$userlevel\" " . ($value == $userlevel ? 'selected' : '') . ">$userlevel_name</option>\n";
    }
    echo <<<EOT
          </select>
				  </td>
        </tr>

EOT;
}

function create_form(&$data, $tabs)
{
    global $ME;
    $database = &JFactory::getDBO();
    
    foreach($data as $element) {
        if ((is_array($element))) {
            switch ($element[2]) {
                case 0 :
                    form_input($element[0], $element[1]);
                    break;
                case 1 :
                    form_yes_no($element[0], $element[1]);
                    break;
                case 2 :
                    form_default_view($element[0], $element[1]);
                    break;
                case 3 :
                    form_sort_order($element[0], $element[1]);
                    break;
                case 4 :
                    form_charset($element[0], $element[1]);
                    break;
                case 5 :
                    form_language($element[0], $element[1]);
                    break;
                case 6 :
                    form_theme($element[0], $element[1]);
                    break;
                case 7 :
                    form_timezone($element[0], $element[1]);
                    break;
                case 8 :
                    // do nothing
                    break;
                case 9 :
                    form_start_day($element[0], $element[1]);
                    break;
                case 10 :
                    form_mini_cal_display_options($element[0], $element[1]);
                    break;
                case 11 :
                    form_time_format($element[0], $element[1]);
                    break;
                case 12 :
                    form_status($element[0], $element[1]);
                    break;
                case 13 :
                    form_multi_day_events($element[0], $element[1]);
                    break;
                case 14 :
                    form_mail_method($element[0], $element[1]);
                    break;
                case 15 :
                    form_user_level($element[0], $element[1]);
                    break;
                case 16 :
                    form_yes_no_firstonly($element[0], $element[1]);
                    break;
                default:
                    die('Invalid action');
            } // switch
        } else {
          form_label($element, $tabs);
        }
    }
}

$section_index = 0; // Main Settings
$section_title = $lang_settings_data['section_title']." : ".$lang_settings_data['admin_links'][$section_index];

if (count($_POST) > 0) {
    if (isset($_POST['update_config'])) {
        /*
				$need_to_be_positive = array('events_per_page',
            'event_list_cols',
            'max_tabs');

        foreach ($need_to_be_positive as $parameter)
        $_POST[$parameter] = max(1, (int)$_POST[$parameter]);
				*/
				
        foreach($lang_config_data as $element) {
            if ((is_array($element))) {
                if ((!isset($_POST[$element[1]]))) die("Missing config value for '{$element[1]}'". __FILE__ . __LINE__);
                $value = addslashes($_POST[$element[1]]);
                extcal_db_query("UPDATE {$CONFIG_EXT['TABLE_CONFIG']} SET  value = '$value' WHERE name = '{$element[1]}'");
            }
        }
        
        pageheader($section_title);
        theme_redirect_dialog($section_title, $lang_settings_data['update_settings_success'], $lang_general['continue'], $ME);
        pagefooter();
        exit;
    }
}
	
//pageheader($section_title, '', false);

$signature = 'JCal Pro Calendar' . " ". CALENDAR_VERSION;

echo <<<EOT
<script>
	function generateimage(which){
	if (document.all){
		if(which!=''){
			theme.innerHTML='<center>Loading image...</center>'
			theme.innerHTML='<img src="themes/'+which+'/images/preview.gif">'
		} else {
			theme.innerHTML='&nbsp;'
		}
	}
	else if (document.layers){
	}
}

</script>
EOT;

//starttable('600', $section_title, 2);
// MF - we do not show the dropdown box allowing you to select which kind of config to use.
// Not used in Mambo version.
//form_admin_sections("admin_links", $section_index);
echo <<<EOT
        <form action="index2.php" name="adminForm" method="post">

EOT;

//$tabs 	= new mosTabs(0);
$tabs = & JPane::getInstance('tabs');

echo '		<table class="adminheading">
		<tr>
			<th class="info">
				Settings
			</th>
		</tr>
		</table>
';
echo $tabs->startPane('sysinfo');
//echo $tabs->startPanel("sysinfo",'sysinfo');

create_form($lang_config_data, $tabs);

endtable();
echo $tabs->endPanel();
echo $tabs->endPane();

echo <<<EOT
	   <input type="hidden" name="option" value="$option">
	   <input type="hidden" name="task" value="initial">
        </form>
EOT;


// footer
//pagefooter();
?>