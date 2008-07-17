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

This file is based on mambot.html.php v85 (2005-09-15) by eddieajau.

This program is free software; you can redistribute it and/or modify 
it under the terms of the GNU General Public License as published by 
the Free Software Foundation; either version 2 of the License, or 
(at your option) any later version.

This header must not be removed. Additional contributions/changes
may be added to this header as long as no information is deleted.
**********************************************

$File: themes.html.php $

Revision date: 02/20/2007

**********************************************
Get the latest version of JCal Pro at:
http://dev.anything-digital.com//
**********************************************
*/

/** ensure this file is being included by a parent file */
defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );

/**
* @package Joomla
* @subpackage Installer
*/
class HTML_themes {
/**
* Displays the installed non-core Mambot
* @param array An array of mambot object
* @param strong The URL option
*/
	function showInstalledThemes( &$rows, $option ) {
        $mosConfig_absolute_path = JPATH_BASE;
        $database = &JFactory::getDBO();
        $database->setQuery( "SELECT lang FROM #__jcalpro_langs WHERE published= '1'" );
        $lang = $database->loadResult();
        //require_once( $mosConfig_absolute_path."/administrator/components/com_jcalpro/language/".$lang.".php" );
        ?>
		<table class="adminheading">
		<tr>
			<th class="install">
			Installed Themes
			</th>
		</tr>
		<tr>
			<td>
            <?php echo _EXTCAL_THEMES_INSTALL_MSG;?>
			<br /><br />
			</td>
		</tr>
		</table>
		<?php
		if ( count( $rows ) ) { ?>
			<form action="index2.php" method="post" name="adminForm">
			<table class="adminlist">
			<tr>
				<th width="20%" class="title">
				<?php echo _EXTCAL_THEME_NAME;?>
				</th>
				<th width="15%" align="left">
				<?php echo _EXTCAL_AUTHOR;?>
				</th>
				<th width="10%" align="center">
				<?php echo _EXTCAL_VERSION;?>
				</th>
				<th width="10%" align="center">
				<?php echo _EXTCAL_DATE;?>
				</th>
				<th width="15%" align="left">
				<?php echo _EXTCAL_AUTHOR_EMAIL;?>
				</th>
				<th width="15%" align="left">
				<?php echo _EXTCAL_AUTHOR_URL;?>
				</th>
			</tr>
			<?php
			$rc = 0;
			$n = count( $rows );
			for ($i = 0; $i < $n; $i++) {
				$row =& $rows[$i];
				?>
				<tr class="<?php echo "row$rc"; ?>">
					<td>
					<input type="radio" id="cb<?php echo $i;?>" name="cid[]" value="<?php echo $row->id; ?>" onclick="isChecked(this.checked);">
					<span class="bold">
					<?php echo $row->name; ?>
					</span>
					</td>
					<td>
					<?php echo @$row->author != '' ? $row->author : "&nbsp;"; ?>
					</td>
					<td align="center">
					<?php echo @$row->version != '' ? $row->version : "&nbsp;"; ?>
					</td>
					<td align="center">
					<?php echo @$row->creationdate != '' ? $row->creationdate : "&nbsp;"; ?>
					</td>
					<td>
					<?php echo @$row->authorEmail != '' ? $row->authorEmail : "&nbsp;"; ?>
					</td>
					<td>
					<?php echo @$row->authorUrl != "" ? "<a href=\"" .(substr( $row->authorUrl, 0, 7) == 'http://' ? $row->authorUrl : 'http://'.$row->authorUrl). "\" target=\"_blank\">$row->authorUrl</a>" : "&nbsp;";?>
					</td>
				</tr>
				<?php
				$rc = 1 - $rc;
			}
			?>
			</table>

			<input type="hidden" name="task" value="" />
			<input type="hidden" name="boxchecked" value="0" />
			<input type="hidden" name="option" value="com_jcalpro" />
			<input type="hidden" name="element" value="themes" />
			</form>
			<?php
		} else {
			?>
			<?php echo _EXTCAL_THEME_NONE;?>
			<form action="index2.php" method="post" name="adminForm">
				<input type="hidden" name="task" value="" />
				<input type="hidden" name="boxchecked" value="0" />
				<input type="hidden" name="option" value="com_jcalpro" />
				<input type="hidden" name="element" value="themes" />
			</form>
			
			<?php
		}
	}
}
?>
