<?php
/**
* @package Joomla
* @subpackage Fabrik
* @copyright Copyright (C) 2005 Rob Clayburn. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/


// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

class FabrikViewVisualization {
	
	/**
	 * set up the menu when viewing the list of  Visualizations
	 */

	function setVisualizationsToolbar()
	{
		JToolBarHelper::title( JText::_( 'Visualizations' ), 'generic.png' );
		JToolBarHelper::customX( 'copy', 'copy.png', 'copy_f2.png', 'Copy' );
		JToolBarHelper::deleteList( );
		JToolBarHelper::editListX( );
		JToolBarHelper::addNewX( );
	}
	
	/**
	 * set up the menu when editing the Visualization
	 */

	function setVisualizationToolbar()
	{
		$task = JRequest::getVar( 'task', '', 'method', 'string');
		JToolBarHelper::title( $task == 'add' ? JText::_( 'Visualization' ) . ': <small><small>[ '. JText::_( 'New' ) .' ]</small></small>' : JText::_( 'Visualization' ) . ': <small><small>[ '. JText::_( 'Edit' ) .' ]</small></small>', 'generic.png' );
		JToolBarHelper::save( );
		JToolBarHelper::apply( );
		JToolBarHelper::cancel( );
	}
	
	/**
	* Display the form to add or edit a Visualization
	* @param object Visualization
	* @param object parameters from attributes
	* @param array lists
	* @param object menus
	* @param object pluginmanager
	* @param object form - used to render xml form cdoe
	*/
	
	function edit( &$row, &$params, &$lists, &$menus, &$pluginManager, &$form )
	{
		JRequest::setVar( 'hidemainmenu', 1 );
		FabrikViewVisualization::setVisualizationToolbar();
		
		$document =& JFactory::getDocument( );
		JHTML::script( 'adminvisualization.js', 'administrator/components/com_fabrik/views/', true );
		JFilterOutput::objectHTMLSafe( $row );
		$db =& JFactory::getDBO();
		jimport( 'joomla.html.pane' );
		$pane	=& JPane::getInstance( );
		$editor =& JFactory::getEditor();
		$js = 
	"window.addEvent('load', function(){ 
		new adminVisualization({'sel':'" . $row->plugin . "'});
	});";
		$document->addScriptDeclaration($js);
		?>
				<script language="javascript" type="text/javascript">
		<!--
		
		function submitbutton(pressbutton) {
			var form = document.adminForm;
			if (pressbutton == 'cancel') {
				submitform( pressbutton );
				return;
			}
			// do field validation
			if ($('plugin').getValue() == "") {
				alert( "<?php echo JText::_( 'You must select a plugin.', true ); ?>" );
			} else if ($('label').getValue()  == '') {
				alert( "<?php echo JText::_( 'Please enter a label.', true ); ?>" );
			} else {
				submitform( pressbutton );
			}
		}
		//-->
		</script>
		<form action="index.php" method="post" name="adminForm">
			<table style="width:100%;">
		 		<tr>
	 			<td  valign="top" style="width:50%;">
	 			<fieldset class="adminform">
					<legend><?php echo JText::_( 'Details' );?></legend>
	 				<table class="admintable">
	 					<tr>
							<td class="key" width="30%"><label for="label"><?php echo JText::_( 'Label' );?></label></td>
							<td width="70%">
								<input class="inputbox" type="text" name="label" id="label"" size="50" value="<?php echo $row->label; ?>" />
							</td>
						</tr>
					<tr>
						<td class="key">
							<label for="intro_text">
								<?php echo JText::_( 'Intro text' );?>
							</label>
						</td>
						<td>
							<?php 
								echo $editor->display( 'intro_text', $row->intro_text, '100%', '200', '50', '5', false );
						 	?>
						</td>
					</tr>						
						<tr>
							<td class="key">
								<label for=""><?php echo JText::_( 'Plug-in' );?></label>
							</td>
							<td>
								<?php echo $lists['plugins'];?>
							</td>
						</tr>
							<?php 
								foreach ($pluginManager->_plugIns['visualization'] as $oPlugin)
								{
									$oPlugin->setId( $row->id );
									?>
								<tr>
								<td colspan="2">
									<?php 
									$oPlugin->renderAdminSettings( );
									?>
									</td>
								</tr>
								<?php }
							?>
							</td>
						</tr>
	 				</table>
	 				</fieldset>
	 			</td>
	 			<td valign="top">
	 				<?php  
	 				echo $pane->startPane( "content-pane" );
					echo $pane->startPanel( JText::_( 'Publishing' ), "publish-page" );
					echo $form->render('details'); 
					echo $pane->endPanel();
						echo $pane->startPanel( JText::_( 'Link to menu' ), "menu-page" ); ?>
						<table class="adminform">
							<tr>
								<th colspan="2"><?php echo JText::_( 'Link to menu' ); ?></th>
							</tr>
							<tr>
								<td>
								<label for="menuselect"><?php echo JText::_( 'Select menu' ); ?>:</label>
								</td>
								<td><?php echo $lists['menuselect']; ?></td>
							</tr>
							<tr>
								<td valign="top" width="90px"><label for="link_name"><?php echo JText::_( 'Label' ); ?></label>:</td>
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
									<input name="menu_link" type="button" class="button" value="<?php echo JText::_( 'Link to menu' ); ?>" onclick="submitbutton('menulinkVisualization');" />
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
								FabrikHelperAdminHTML::menuLinksContent( $menus, 'Visualization' );
							}?>
							<tr>
								<td colspan="2">
								</td>
							</tr>										
						</table>
						<?php echo $pane->endPanel();
						echo $pane->endPane(); ?>
		 			</td>
		 		</tr>
	 		</table>
	 		<input type="hidden" name="task" value=""> 
			<input type="hidden" name="option" value="com_fabrik" />
			<input type="hidden" name="c" value="visualization" />
			<input type="hidden" name="id" value="<?php echo $row->id; ?>" />
			<?php echo JHTML::_( 'form.token' ); ?>
		</form>
	<?php
	}

	/**
	* Display all available Visualizations
	* @param array array of objects
	* @param object page navigation 
	* @param array lists
	*/
	
	function show( $visualizations, $pageNav, $lists )
	{
		FabrikViewVisualization::setVisualizationsToolbar();
		$user	  = &JFactory::getUser();
		$n=count( $visualizations );
		echo $lists['vizualizations'];
		?> 
		
		<form action="index.php" method="post" name="adminForm">
			<table class="adminlist">
				<thead>
				<tr>
					<th width="2%"><?php echo JHTML::_('grid.sort',  '#', 'id', @$lists['order_Dir'], @$lists['order'] ); ?></th>
					<th width="1%">
						<input type="checkbox" id="toggle" name="toggle" value="" onclick="checkAll(<?php echo $n ;?>);" />
					</th>
					<th width="95%"><?php echo JText::_( 'Label' ); ?></th>
					<th width="3%"><?php echo JText::_( 'Published' ); ?></th>
				</tr> 
				</thead>
				<?php 
				$k = 0;	
				for ($i = 0; $i < $n; $i++) { 
					$row = &$visualizations[$i]; 
					$checked		= JHTML::_('grid.checkedout', $row, $i );
					$link 	= JRoute::_( 'index.php?option=com_fabrik&c=visualization&task=edit&cid='. $row->id );
					$row->published = $row->state;
					$published		= JHTML::_('grid.published', $row, $i );?>
					<tr class="<?php echo "row$k"; ?>">
						<td width="1%"><?php echo $row->id; ?></td>
						<td width="1%"><?php echo $checked;?></td>
						<td width="29%"><?php
						if ($row->checked_out && ( $row->checked_out != $user->get( 'id' ) )) {
							echo $row->label;
						} else {
							?> <a href="<?php echo $link;?>"><?php echo $row->label; ?></a> <?php } ?>
						</td>
						<td>
							<?php echo $published;?>
						</td>
						
					</tr> 
					<?php $k = 1 - $k;
				}?>
				<tfoot>
					<tr>
						<td colspan="4">
						<?php echo $pageNav->getListFooter(); ?>
					</td>
					</tr>
				</tfoot>
			</table>
			<input type="hidden" name="option" value="com_fabrik" />
			<input type="hidden" name="c" value="visualization" />
			<input type="hidden" name="boxchecked" value="0" />
			<input type="hidden" name="task" value="visualization" />
			<?php echo JHTML::_( 'form.token' ); ?>
		</form>
	<?php }	
}
?>