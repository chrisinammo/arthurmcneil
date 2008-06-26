<?php
/**
 * Events Component for Joomla 1.5.x
 *
 * @version     $Id: admin.events.main.php 912 2007-12-21 11:19:31Z geraint $
 * @package     Events
 * @copyright   Copyright (C) 2006-2007 JEvents Project Group
 * @copyright   Copyright (C) 2000 - 2003 Eric Lamette, Dave McDonnell
 * @licence     http://www.gnu.org/copyleft/gpl.html
 * @link        http://joomlacode.org/gf/project/jevents
 */

// essential reference
// http://www.w3.org/2002/12/cal/rfc2445

defined( '_JEXEC' ) or die( 'Restricted access' );

function testJEventModBot($type="plg",$name, $desc)
{
	global $mainframe;
	$live_site = $mainframe->getSiteURL();
	$db	=& JFactory::getDBO();
	$state_array = array();
	$state = array();
	$state_tpl = array();

	$pub_text[0] = 'Uninstalled';
	$pub_text[1] = _CAL_LANG_NOT_PUBLISHED;
	$pub_text[2] = _CAL_LANG_PUBLISHED;

	// 0 = not installed, 1 = installed but not published, 2 = published
	$state_tpl['status']=0;
	$state_tpl['id']=null;
	$state_tpl['href']=null;
	$state_tpl['title'] = null;
	$state_tpl['pub'] = $pub_text[$state_tpl['status']];
	$state_tpl['desc']=$desc;

	if ($type=="plg"){
		$query= "SELECT m.* , g.name AS _groupname FROM #__plugins as m"
				. "\n LEFT JOIN #__groups AS g ON g.id = m.access"			
				."\nWHERE element='$name' ORDER BY published DESC";
		$db->setQuery($query);
		$db->query();
		$plugins = $db->loadObjectList();
		if (count($plugins) == 0) {
			$state_array[] = $state_tpl;
		} else {
			foreach ($plugins as $plugin) {
				if ($plugin != null){
					$state = $state_tpl;
					$state['id'] = $plugin->id;
					$state['title'] = $plugin->name;
					if ($plugin->published == "1") $state['status']=2;
					else $state['status']=1;
					$state['pub'] = $pub_text[$state['status']];
					$state['href']="$live_site" . "administrator/index2.php?option=com_plugins"
						. "&client=site&view=plugin&task=edit&hidemainmenu=1&cid[]=$plugin->id";
					$state['plugin']=$plugin;
					$state_array[] = $state;
				}
			}
		}
	}
	else if ($type=="mod"){
		$query= "SELECT m.* , g.name AS _groupname FROM #__modules as m"
				. "\n LEFT JOIN #__groups AS g ON g.id = m.access"			
				."\nWHERE module='mod_$name' ORDER BY published DESC";
		$db->setQuery($query);
		$db->query();
		$modules = $db->loadObjectList();
		if (count($modules) == 0) {
			$state_array[] = $state_tpl;
		} else {
			foreach ($modules as $module) {
				if ($module != null){
					$state = $state_tpl;
					$state['id'] = $module->id;
					$state['title'] = $module->title;
					if ($module->published == "1") $state['status']=2;
					else $state['status']=1;
					$state['pub'] = $pub_text[$state['status']];
					//$state['href']="$live_site/administrator/index2.php?option=com_events&task=editModule&hidemainmenu=1&id=$module->id";
					$state['href']="$live_site" . "administrator/index2.php?option=com_modules"
						. "&client=0&task=edit&cid[]=$module->id";
					$state['module']=$module;
					$state_array[] = $state;
				}
			}
		}
	}
	else return null;
	return $state_array;

}

	function missConfig() {
		echo '<center><h2 style="color:red;">' . _CAL_LANG_MSG_WARNING . '</h2><br />';
		echo '<h3>' . _CAL_LANG_MSG_CHMOD_CONFIG . '</h3><br />';
		return;
	}

	function missCss() {
		echo '<center><h2 style="color:red;">' . _CAL_LANG_MSG_WARNING . '</h2><br />';
		echo '<h3>' . _CAL_LANG_MSG_CHMOD_CSS . '</h3><br />';
	}

	function defaultConfig() { ?>
	<script type="text/javascript">
	/* <![CDATA[ */

	function defaultConfig_com() {
		document.adminForm.conf_adminmail.value = "your@example.com";
		document.adminForm.conf_starday[0].checked = true;
		document.adminForm.conf_adminlevel.value = 1;
		document.adminForm.conf_mailview[1].checked = true;
		document.adminForm.conf_frontendPublish.value = 6;
		document.adminForm.conf_byview[1].checked = true;
		document.adminForm.conf_hitsview[1].checked = 1;
		document.adminForm.conf_repeatview[1].checked = true;
		document.adminForm.conf_showrepeats[1].checked = true;
		document.adminForm.conf_hideshowbycats[0].checked = true;
		document.adminForm.conf_dateformat.value = 1;
		document.adminForm.conf_copyright[1].checked = true;
		document.adminForm.conf_calUseIconic[1].checked = true;
		document.adminForm.conf_navbarcolor.value = "green";
		document.adminForm.conf_startview.value = "view_month";
		document.adminForm.conf_defColor[2].checked = true;
		document.adminForm.conf_calSimpleEventForm[0].checked = true;
		document.adminForm.conf_calForceCatColorEventForm.value = 0;
		document.adminForm.conf_calEventListRowsPpg.value = 15;
		document.adminForm.conf_calUseStdTime[1].checked = true;
		document.adminForm.conf_calCutTitle.value = "20";
		document.adminForm.conf_calMaxDisplay.value = "5";
		document.adminForm.conf_calDisplayStarttime[1].checked = true;
		document.adminForm.conf_calViewName.value = "default";
	}

	function defaultConfig_cal() {
		document.adminForm.conf_modCalDispLastMonth.value =  "NO";
		document.adminForm.conf_modCalDispLastMonthDays.value = "0";
		document.adminForm.conf_modCalDispNextMonth.value =  "NO";
		document.adminForm.conf_modCalDispNextMonthDays.value = "0";
		document.adminForm.conf_modCalLinkCloaking[0].checked = true;

	}
	function defaultConfig_latest() {
		document.adminForm.conf_modLatestMaxEvents.value = 5;
		document.adminForm.conf_modLatestMode.value = 0;
		document.adminForm.conf_modLatestDays.value = 20;
		document.adminForm.conf_modLatestNoRepeat[0].checked =  true;
		document.adminForm.conf_modLatestDispLinks[1].checked =  true;
		document.adminForm.conf_modLatestDispYear[0].checked =  true;
		document.adminForm.conf_modLatestCustFmtStr.value = "${eventDate}[!a: - ${endDate(%I:%M%p)}]\n${title}";
		document.adminForm.conf_modLatestDisDateStyle[0].checked =  true;
		document.adminForm.conf_modLatestDisTitleStyle[0].checked = true;
		document.adminForm.conf_modLatestLinkToCal[0].checked = true;
		document.adminForm.conf_modLatestLinkCloaking[0].checked = true;
	}
	function defaultConfig_css() {
		var style = (""
		<?php
		// load this from a file - its far easier to manage
		set_magic_quotes_runtime(0);
		$style = @file(dirname(__FILE__)."/default.css",true);
		foreach ($style as $linenum => $line) {
			$line = str_replace('"',"'",$line);
			if (strlen($line)>0) echo '+"\n"+"'.trim($line,"\n\r").'"';
			echo "\n";
		}
		?>
		+"");
		document.adminForm.conf_style.value = style;
	}
	function defaultConfig_tooltip() {
		document.adminForm.conf_calTTBackground[1].checked = true;
		document.adminForm.conf_calTTPosX[2].checked = true;
		document.adminForm.conf_calTTPosY[1].checked = true;
		document.adminForm.conf_calTTShadow[1].checked = true;
		document.adminForm.conf_calTTShadowX[0].checked = true;
		document.adminForm.conf_calTTShadowY[0].checked = true;
	}

	function defaultConfig_all() {
		defaultConfig_com();
		defaultConfig_cal();
		defaultConfig_latest();
		defaultConfig_css();
		defaultConfig_tooltip();
	}
	/* ]]> */
	</script>
	<?php
	}

