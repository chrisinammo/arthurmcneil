<?php
/**
* @package Joomla
* @subpackage Fabrik
* @copyright Copyright (C) 2005 Rob Clayburn. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/


// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

class FabrikViewPackage {
	
	/**
	 * set up the menu when viewing the list of  packages
	 */

	function setPackagesToolbar()
	{
		JToolBarHelper::title( JText::_( 'Packages' ), 'generic.png' );
		JToolBarHelper::custom( 'startExport', 'export.png', 'export_f2.png', 'Export' );
		JToolBarHelper::custom( 'import', 'copy.png', 'copy_f2.png', 'Import', false );
		JToolBarHelper::custom( 'copy', 'copy.png', 'copy_f2.png', 'Copy' );
		JToolBarHelper::deleteList();
		JToolBarHelper::editListX( );
		JToolBarHelper::addNewX( );
	}
	
	/**
	 * set up the menu when editing the package
	 */

	function setPackageToolbar()
	{
		$task = JRequest::getVar( 'task', '', 'method', 'string');
		JToolBarHelper::title( $task == 'add' ? JText::_( 'Package' ) . ': <small><small>[ '. JText::_( 'New' ) .' ]</small></small>' : JText::_( 'Package' ) . ': <small><small>[ '. JText::_( 'Edit' ) .' ]</small></small>', 'generic.png' );
		JToolBarHelper::save( );
		JToolBarHelper::apply( );
		JToolBarHelper::cancel( );
		//JToolBarHelper::help( 'screen.banners.edit' );
	}
	
	/**
	 * toolbar for export
	 */
	
	function setPackageExportToolbar()
	{
		JToolBarHelper::custom( 'export', 'forward.png', 'forward_f2.png', 'Export', false );
	}
	
	/**
	 * show export settings
	 */
	
	/**
	 * export table settings
	 */
	 
	function exportSettings( $rows )
	{
		FabrikViewPackage::setPackageExportToolbar();
	 	echo "<h1 class=\"sectionname\">" .  JText::_( 'Export' ) . "</h1>";
	 	echo "<p>" . JText::_( 'For the following packges:' ) . "</p>";
	 	echo "<ul>";
	 	foreach( $rows as $package ){
	 		echo "<li>" . $package->label . "</li>";	
	 	}
	 	echo "</ul>";
	 	echo "<p>" . JText::_( 'Please choose the export file type and which parts of the table\'s data you wish to export' ) . "</p>";
	 	?>
	 	<form action="index3.php" method="post" name="adminForm">
	 	<?php 
	 	foreach( $rows as $oTable ){
	 		echo "<input type='hidden' name='cid[]' value='" . $oTable->id . "' />";	
	 	}
	 	?>
	 	<table cellpadding="4" cellspacing="0" border="0" width="100%"  class="adminform">
	 		<tr>
	 			<th colspan="2"><?php echo JText::_( 'Format' ) ;?></th>
	 		</tr>
	 		<tr>
	 			<td><?php echo JText::_( 'Format' ) ;?></td>
	 			<td>
	 				<label><input class="inputbox" checked="checked" type="radio" name="format" value="xml" />xml</label>
	 				<!--<label><input class="inputbox" type="radio" name="format" value="sql" />csv</label>-->
	 			</td>
	 		</tr>
	 		<tr>
	 			<td><?php echo JText::_( 'Label' ) ;?></td>
	 			<td>
	 				<label><input class="inputbox" name="label" value="" /></label>
	 			</td>
	 		</tr>
	 		
	 		<tr>
	 			<th colspan="2"><?php echo JText::_( 'Options' ) ;?></th>
	 		</tr>
	 		
	 		<!--<tr>
	 			<td><label for="joins"><?php //echo _EXPORT_JOINS ;?></label></td>
	 			<td><input class="inputbox" type="checkbox" id="joins" name="joins" value="1" /></td>
	 		</tr>-->
	 		<tr>
	 			<td><label for="fabrikfields"><?php echo JText::_( 'Export fabrik structure' )  ;?></label></td>
	 			<td><input class="inputbox" type="checkbox" name="fabrikfields" id="fabrikfields" value="1" /></td>
	 		</tr>
	 		<tr>
	 			<td><label for="tabledata"><?php echo JText::_( 'Export table structure (drop &amp; create db tables)' ) ;?></label></td>
	 			<td><input class="inputbox" type="checkbox" id="tablestructure" name="tablestructure" value="1" /></td>
	 		</tr>
	 		<tr>
	 			<td><label for="tabledata"><?php echo JText::_( 'Export Table Records' ) ;?></label></td>
		<td><input class="inputbox" type="checkbox" id="tabledata"
			name="tabledata" value="1" /></td>
	</tr>
	 	</table>
	 	<input type="hidden" name="option" value="com_fabrik" />
	 	<input type="hidden" name="c" value="package" />
		<input type="hidden" name="task" value="doexportTable" />
		<input type="hidden" name="no_html" value="1" />
		<?php echo JHTML::_( 'form.token' ); ?>
	</form>
	 	<?php 
	 }
	
	/**
	* Display the form to add or edit a package
	* @param object package
	* @param object parameters from attributes
	* @param array lists
	*/
	
	function edit( $row, $tables, $lists, $menus )
	{
		JRequest::setVar( 'hidemainmenu', 1 );
		jimport('joomla.html.pane');
		$pane	=& JPane::getInstance( );
		FabrikViewPackage::setPackageToolbar();
		JHTML::script( 'adminpackage.js', 'administrator/components/com_fabrik/views/', true );
		?> 
		<form action="index.php" method="post" name="adminForm">
		<table style="width:100%;">
		 	<tr>
	 			<td style="width:50%;" valign="top">
	 			<fieldset class="adminform">
				<legend><?php echo JText::_( 'Details' );?></legend>
				<table class="admintable"> 
					<tr>
						<td class="key">
						<label for="label"><?php echo JText::_( 'Label'); ?>:</label>
						</td>
						<td><input class="inputbox" type="text" id="label" name="label" size="30" value="<?php echo $row->label; ?>" /></td>
					</tr>
					<tr>
						<td class="key" valign="top"  style="text-align:right">
						<label for="state"><?php echo JText::_( 'Published' ); ?>:</label>
						</td>
						<td>
						<input type="checkbox" id="state" name="state" value="1" <?php echo $row->state ? 'checked="checked"' : ''; ?> />
						</td>
					</tr>
					<tr>
						<td class="key" valign="top"  style="text-align:right">
							<label for="template"><?php echo JText::_( 'Template' ); ?>:</label>
						</td>
						<td>
						<?php echo $lists['template']; ?>
						</td>
					</tr>
					
					<?php foreach( $tables as $table ){?>
					<tr class="packageTable" >
						<td class="key"><?php echo JText::_( 'Tables' ); ?></td>
						<td><?php echo $table; ?> <a href="#" class="add"><?php echo JText::_( 'Add' );?></a> | <a href="#" class="delete"><?php echo JText::_( 'Delete' );?></a></td>
					</tr> 
					<?php } ?>
				</table>
				</fieldset>
				</td>
				<td style="width:50%;"  valign="top">
					<?php echo $pane->startPane("content-pane");
					echo $pane->startPanel( JText::_( 'Link to menu' ), "menu-page"); ?>
					<table class="adminform">
			<tr>
				<th colspan="2"><?php echo JText::_( 'Link to menu' ); ?></th>
			</tr>
			<tr>
				<td>
				<label for="menuselect">
				<?php echo JText::_( 'Select menu'); ?>
				</label>
				</td>
				<td><?php echo $lists['menuselect']; ?></td>
			</tr>
			<tr>
				<td valign="top" width="90px"><label for="link_name"><?php echo JText::_( 'Label' ); ?></label></td>
				<td>
					<input type="text" id="link_name" name="link_name" class="inputbox" value="" size="30" />
				</td>
			</tr>
			<tr>
				<td valign="top">
				<label for="alias"><?php echo JText::_( 'Alias' ); ?></label>
				</td>
				<td>
				<input type="text" id="alias" name="alias" class="inputbox" value="" size="30" />
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<input name="menu_link" type="button" class="button" value="<?php echo JText::_( 'Link to menu' ); ?>" onclick="submitbutton('menulinkPackage');" />
				</td>
			</tr>
			<tr>
				<th colspan="2"><?php echo JText::_( 'Existing menu links' ); ?></th>
			</tr>
			<?php if ($menus == NULL) { ?>
				<tr>
					<td colspan="2"><?php echo JText::_( 'None' ); ?></td>
				</tr>
			<?php } else {
					FabrikHelperAdminHTML::menuLinksContent($menus, 'Form');
			}?>
			<tr>
				<td colspan="2">
				</td>
			</tr>										
		</table>
				<?php echo $pane->endPanel();
					echo $pane->endPane();?>
				</td>
			</tr>
		</table>
		<input type="hidden" name="option" value="com_fabrik" /> 
		<input type="hidden" name="c" value="package" />
		<input type="hidden" name="task" value="savePackage" /> 
		<input type="hidden" name="id" value="<?php echo $row->id; ?>" /> 	
		<input type="hidden" name="cid[]" value="<?php echo $row->id; ?>" />
		<?php echo JHTML::_( 'form.token' ); ?>
	</form>
	<?php  }

	/**
	* Display all available packages
	* @param array array of package_rule objects
	* @param object page navigation 
	*/
	
	function show( $packages, $pageNav ) {
		FabrikViewPackage::setPackagesToolbar();
		$user	  = &JFactory::getUser();
		$n=count( $packages );
		?> 
		
		<form action="index.php" method="post" name="adminForm">
			<table class="adminlist">
				<thead>
				<tr> 
					<th width="2%">#</th>
					<th width="1%">
						<input type="checkbox" id="toggle" name="toggle" value="" onclick="checkAll(<?php echo $n ;?>);" />
					</th>
					<th width="95%" ><?php echo JText::_( 'Label' );?></th>
					<th width="3%"><?php echo JText::_( 'Published' );?></th>
				</tr> 
				</thead>
				<?php 
				$k = 0;	
				for ($i = 0; $i < $n; $i++) { 
					$row = &$packages[$i]; 
					$checked		= JHTML::_('grid.checkedout',   $row, $i );
					$link 	= JRoute::_( 'index.php?option=com_fabrik&c=package&task=edit&cid='. $row->id );
					$row->published = $row->state;
					$published		= JHTML::_('grid.published', $row, $i );?>
					<tr class="<?php echo "row$k"; ?>">
					<td><?php echo $row->id; ?></td>
					<td width="1%"><?php echo $checked; ?></td>
					<td width="35%">
						<?php
						if ( $row->checked_out && ( $row->checked_out != $user->get( 'id' ) )) {
							echo  $row->label;
						} else {
						?>
						<a href="<?php echo $link; ?>">
							<?php echo $row->label; ?>
						</a>
					<?php } ?>
					</td>
		
					<td width="5%">
						<?php echo $published;?>
					</td>
				</tr> 
				
				<?php $k = 1 - $k;
				}?>
				<tfoot>
					<tr><td colspan="4">
						<?php echo $pageNav->getListFooter(); ?>
					</td></tr>
				</tfoot>
			</table>
			<input type="hidden" name="option" value="com_fabrik" />
			<input type="hidden" name="c" value="package" />
			<input type="hidden" name="boxchecked" value="0" />
			<input type="hidden" name="task" value="package" />
			<?php echo JHTML::_( 'form.token' ); ?>
		</form>
	<?php }	
}
?>