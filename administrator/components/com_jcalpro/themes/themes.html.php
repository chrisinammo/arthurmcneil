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

This file is based on admin.mambots.html.php v85 (2005-09-15) by eddieajau.

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
* @subpackage Mambots
*/
class EXTCAL_themes {
    function AccessList(){
        $access_list = array(
                    JHTML::_( 'select.option', '','Select Access Level' ),
                    JHTML::_( 'select.option', '18','Registered' ),
                    JHTML::_( 'select.option', '19','-Author' ),
                    JHTML::_( 'select.option', '20','--Editor' ),
                    JHTML::_( 'select.option', '21','---Publisher' ),
                    JHTML::_( 'select.option', '23','----Manager' ),
                    JHTML::_( 'select.option', '24','-----Administrator' ),
                    JHTML::_( 'select.option', '25','------Super Administrator' )
        );

        //$lists['access'] = mosHTML::selectList( $access_list, 'access', 'class="inputbox" size="1"', 'value', 'text' );
        $lists['access'] = JHTML::_('select.genericlist',  $access_list, 'access', 'class="inputbox" size="1"', 'value', 'text' );

        return $lists['access'];
    }

    /**
	* Writes a list of the defined modules
	* @param array An array of category objects
	*/
	function showThemes( &$rows, $client, &$pageNav, $option, &$lists, $search ) {
		//global $my, $mosConfig_live_site, $mosConfig_absolute_path, $database;
        global $mainframe;
        $my = & JFactory::getUser();
        $registry = & JFactory::getConfig();
        $mosConfig_live_site = $registry->live_site;
        $mosConfig_absolute_path = $registry->absolute_path;
        $database = & JFactory::getDBO();

        //$database->setQuery( "SELECT lang FROM #__jcalpro_langs WHERE published= '1'" );
        //$lang = $database->loadResult();
        //require_once( $mosConfig_absolute_path."/administrator/components/com_jcalpro/language/".$lang.".php" );

		//mosCommonHTML::loadOverlib();
        JHTML::_('behavior.tooltip');
		$access = EXTCAL_themes::AccessList();
		?>
		<form action="index2.php" method="post" name="adminForm">

		<table class="adminheading">
		<tr>
			<th class="modules">
			<?php echo _EXTCAL_THEME_HEADING;?> <small><small>[ <?php echo $client == 'admin' ? 'Administrator' : 'Site';?> ]</small></small>
			</th>
		</tr>
		</table>

		<table class="adminlist">
		<tr>
			<th width="20">#</th>
			<th width="20">
                <input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $rows ); ?>);" />
            </th>
			<th class="title">
			<?php echo _EXTCAL_THEME_NAME;?>
			</th>
			<th nowrap="nowrap" width="15%">
			<?php echo _EXTCAL_THEME_DEFAULT;?>
			</th>
			<th nowrap="nowrap" width="10%">
			<?php echo _EXTCAL_THEME_CORE;?>
			</th>
			<th nowrap="nowrap" width="25%">
			<?php echo _EXTCAL_THEME_TYPE;?>
			</th>
			<th nowrap="nowrap" width="25%">
			<?php echo _EXTCAL_THEME_PLUGCOM;?>
			</th>
		</tr>
		<?php
		$k = 0;
		for ($i=0, $n=count( $rows ); $i < $n; $i++) {
			$row 	= &$rows[$i];
            //$link = 'index2.php?option=com_jcalpro&client='. $client .'&task=edittheme&hidemainmenu=1&id='. $row->id;
            //$access 	= EXTCAL_themes::AccessProcessing( $row, $i );
            //$checked 	= mosCommonHTML::CheckedOutProcessing( $row, $i );
            $checked     = JHTML::_('grid.checkedout',   $row, $i );
			$core = ( $row->iscore == 1 ) ? 'Yes' : 'No';
			$published     = JHTML::_('grid.published', $row, $i );
			//$published 	= mosCommonHTML::PublishedProcessing( $row, $i );
			?>
			<tr class="<?php echo "row$k"; ?>">
				<td align="right"><?php echo $pageNav->getRowOffset( $i ); ?></td>
				<td>
					<input type="radio" id="cb<?php echo $i;?>" name="cid[]" value="<?php echo $row->name; ?>" onClick="isChecked(this.checked);" />
				</td>
				<td>
				<?php
					echo $row->name;
				?>
				</td>
				<td align="center">
       			
                <?php
       			//events/administrator/images/tick.png
       			
					if ( $row->published )
					{				
						echo '<img src="images/tick.png">';
					}
					?>
				</td>		
				<td align="center">
                <?php echo $core;?>
				</td>
				<td align="center">
				<?php echo $row->type;?>
				</td>
				
				<td align="center">
				<?php echo $row->theme;?>
				</td>
			</tr>
			<?php
			$k = 1 - $k;
		}
		?>
		</table>

		<?php echo $pageNav->getListFooter(); ?>

		<input type="hidden" name="option" value="<?php echo $option;?>" />
		<input type="hidden" name="task" value="showthemes" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="hidemainmenu" value="0" />
		</form>
		<?php
	}
	/**
	* Writes the edit form for new and existing module
	*
	* A new record is defined when <var>$row</var> is passed with the <var>id</var>
	* property set to 0.
	* @param mosCategory The category object
	* @param array <p>The modules of the left side.  The array elements are in the form
	* <var>$leftorder[<i>order</i>] = <i>label</i></var>
	* where <i>order</i> is the module order from the db table and <i>label</i> is a
	* text label associciated with the order.</p>
	* @param array See notes for leftorder
	* @param array An array of select lists
	* @param object Parameters
	*/
	function editThemes( &$row, &$lists, &$params, $option ) {
		global $mainframe;
        $database =& JFactory::getDBO();
        $registry =& JFactory::getConfig();
        $mosConfig_live_site = $registry->live_site;
        $mosConfig_absolute_path = $registry->absolute_path;

        //$database->setQuery( "SELECT lang FROM #__jcalpro_langs WHERE published= '1'" );
        //$lang = $database->loadResult();
        //require_once( $mosConfig_absolute_path."/administrator/components/com_jcalpro/language/".$lang.".php" );

		$row->nameA = '';
		if ( $row->id ) {
			$row->nameA = '<small><small>[ '. $row->name .' ]</small></small>';
		}
		$row_row = ( $row->row ) ? $row->row : '4';
		$row_ordering = ( $row->ordering ) ? $row->ordering : '1';
		?>
		<div id="overDiv" style="position:absolute; visibility:hidden; z-index:10000;"></div>
		<script language="javascript" type="text/javascript">
		function submitbutton(pressbutton) {
			if (pressbutton == "canceltheme") {
				submitform(pressbutton);
				return;
			}
			// validation
			var form = document.adminForm;
			submitform(pressbutton);
		}
		</script>
		<table class="adminheading">
		<tr>
			<th class="mambots">
			Themes:
			<small>
			<?php echo $row->id ? _EXTCAL_THEME_EDIT : _EXTCAL_THEME_NEW;?>
			</small>
			<?php echo $row->nameA; ?>
			</th>
		</tr>
		</table>

		<form action="index2.php" method="post" name="adminForm">
		<table cellspacing="0" cellpadding="0" width="100%">
		<tr valign="top">
			<td width="60%" valign="top">
				<table class="adminform">
				<tr>
					<th colspan="2">
					<?php echo _EXTCAL_THEME_DETAILS;?>
					</th>
				<tr>
				<tr>
					<td width="100" align="left">
					<?php echo _EXTCAL_THEME_NAME;?>:
					</td>
					<td>
					<input class="text_area" type="text" name="name" size="35" value="<?php echo $row->name; ?>" />
					</td>
				</tr>
				<tr>
					<td valign="top" align="left">
					<?php echo _EXTCAL_THEME_THEME;?>:
					</td>
					<td>
					<input class="text_area" type="text" name="theme" size="35" value="<?php echo $row->theme; ?>" />
					</td>
				</tr>
				<tr>
					<td valign="top" align="left">
					<?php echo _EXTCAL_THEME_TYPE;?>:
					</td>
					<td>
                    <?php echo _EXTCAL_THEME_THEME;?>
                    <input type="hidden" name="type" value="theme" />
					</td>
				</tr>
				<tr>
					<td valign="top" align="left">
					<?php echo _EXTCAL_THEME_ICON;?>:
					</td>
					<td>
					<input class="text_area" type="text" name="icon" size="35" value="<?php echo $row->icon; ?>" />
					</td>
				</tr>
				<tr>
					<td valign="top" align="left">
					<?php echo _EXTCAL_THEME_LAYOUT_ICON;?>:
					</td>
					<td>
					<input class="text_area" type="text" name="layout_icon" size="35" value="<?php echo $row->layout_icon; ?>" />
					</td>
				</tr>
				<tr>
					<td valign="top" align="left">
					<?php echo _EXTCAL_THEME_ACCESS_LVL;?>:
					</td>
					<td>
                    <?php echo $lists['access']; ?>
					</td>
				</tr>
				<tr>
					<td valign="top" align="left">
					<?php echo _EXTCAL_THEME_ROW;?>:
					</td>
					<td>
                    <?php echo $row_row; ?><input type="hidden" name="row" value="<?php echo $row_row;?>" />
					</td>
				</tr>
				<tr>
					<td valign="top" align="left">
					<?php echo _EXTCAL_THEME_ORDER;?>:
					</td>
					<td>
                    <?php echo $row_ordering; ?><input type="hidden" name="ordering" value="<?php echo $row_ordering; ?>" />
					</td>
				</tr>
				<tr>
					<td valign="top">
					<?php echo _EXTCAL_PUBLISHED;?>:
					</td>
					<td>
					<?php echo $lists['published']; ?>
					</td>
				</tr>
				<tr>
					<td valign="top">
					<?php echo _EXTCAL_THEME_ELMS;?>:
					</td>
					<td><input class="text_area" type="text" name="elements" size="35" value="<?php echo $row->elements; ?>" />
					</td>
				</tr>
				<tr>
					<td valign="top">
					<?php echo _EXTCAL_THEME_DESC;?>:
					</td>
					<td>
					<?php echo $row->description; ?>
					</td>
				</tr>
				</table>
			</td>
			<td width="40%">
				<table class="adminform">
				<tr>
					<th colspan="2">
					<?php echo _EXTCAL_THEME_PARAMS;?>
					</th>
				<tr>
				<tr>
					<td>
					<?php
					if ( $row->id ) {
						echo $params->render();
					} else {
						echo '<i>No Parameters</i>';
					}
					?>
					</td>
				</tr>
				</table>
			</td>
		</tr>
		</table>

		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="id" value="<?php echo $row->id; ?>" />
		<input type="hidden" name="client" value="<?php echo $row->client_id; ?>" />
		<input type="hidden" name="task" value="" />
		</form>
		<script language="Javascript" src="<?php echo $mosConfig_live_site;?>/includes/js/overlib_mini.js"></script>
		<?php
	}
}
?>
