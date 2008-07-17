<?php
/**
* @package Joomla
* @subpackage Fabrik
* @copyright Copyright (C) 2005 Rob Clayburn. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/


// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

class FabrikViewGroup {
	
	/**
	 * set up the menu when viewing the list of groups
	 */

	function setGroupsToolbar()
	{
		JToolBarHelper::title( JText::_( 'Groups' ), 'generic.png' );
		JToolBarHelper::publishList( );
		JToolBarHelper::unpublishList( );
		JToolBarHelper::customX( 'copy', 'copy.png', 'copy_f2.png', 'Copy' );
		JToolBarHelper::deleteList(  );
		JToolBarHelper::editListX();
		JToolBarHelper::addNewX();
	}
	
	/**
	 * set up the menu when editing the group
	 */

	function setGroupToolbar()
	{
		$task = JRequest::getVar( 'task', '', 'method', 'string');
		JToolBarHelper::title( $task == 'add' ? JText::_( 'Group' ) . ': <small><small>[ '. JText::_( 'New' ) .' ]</small></small>' : JText::_( 'Group' ) . ': <small><small>[ '. JText::_( 'Edit' ) .' ]</small></small>', 'generic.png' );
		JToolBarHelper::save( );
		JToolBarHelper::apply( );
		JToolBarHelper::cancel( );
	}
	
	/**
	* Display the form to add or edit a group
	* @param object group
	* @param object parameters from attributes
	*/
	
	function edit( $row, $params )
		{
		JRequest::setVar( 'hidemainmenu', 1 );
		JHTML::_('behavior.tooltip');
		FabrikViewGroup::setGroupToolbar();
		?> 
			<script language="javascript" type="text/javascript">
			<!--
			function submitbutton(pressbutton) {
				var form = document.adminForm;
				if (pressbutton == 'cancel') {
					submitform( pressbutton );
					return;
				}
		
				/* do field validation */
				if (form.name.value == "") {
					alert( "<?php echo JText::_('Please ente a name');?>" );
				} else {
					submitform( pressbutton );
				}
			}
			-->
		</script> 
		<form action="index.php" method="post" name="adminForm">
		<div class="col100">
			<fieldset class="adminform">
				<legend><?php echo JText::_( 'Details' ); ?></legend>
			<table class="admintable"> 
				<tr>
					<td class="key"><label for="name"><?php echo JText::_( 'Name' ); ?>:</label></td>
					<td><input class="inputbox" type="text" id="name" name="name" size="75" value="<?php echo $row->name; ?>" /></td>
				</tr>
				<tr>
					<td class="key"><label for="label"><?php echo JText::_( 'Title' ); ?>:</label></td>
					<td><input class="inputbox" type="text" id="label" name="label" size="75" value="<?php echo $row->label; ?>" /></td>
				</tr>
				<tr>
					<td class="key"><label for="css"><?php echo JText::_( 'CSS' );?>:</label></td>
					<td> <textarea rows="8" cols="72" id="css" name="css" class="inputbox"><?php echo  $row->css; ?></textarea>	
					</td>
				</tr>
				<tr>
					<td colspan="2">
				<?php 
				echo  stripslashes($params->render());
				?>
					</td>
				</tr>
			</table>
			</fieldset> 
			 <fieldset class="adminform">
				<legend><?php echo JText::_( 'Pagination' ); ?></legend>
			<?php echo $params->render('params', 'pagination'); ?>
				<input type="hidden" name="option" value="com_fabrik" /> 
				<input type="hidden" name="c" value="group" />
				<input type="hidden" name="task" />
				<input type="hidden" name="is_join" value="<?php echo $row->is_join;?>" />
				<input type="hidden" name="id" value="<?php echo $row->id; ?>" /> 
			</fieldset>
			</div>
			<?php echo JHTML::_( 'form.token' ); ?>
		</form>
	<?php  }

	/**
	* Display all available groups
	* @param array array of group objects
	* @param object page navigation 
	* @param array lists
	*/
	
	function show( $groups, $pageNav, $lists ) {
		FabrikViewGroup::setGroupsToolbar();
		$user	  = &JFactory::getUser();
		?> 
		<form action="index.php" method="post" name="adminForm"> 
		<table class="adminlist">
			<tr> 
				<td>
					<?php echo $lists['formId']; ?>
				</td>
				<td>
					<?php echo $lists['groupId'];?>
				</td>
			</tr>
		</table>
		
		<table class="adminlist">
			<thead>
			<tr>
				<th width="2%"><?php echo JHTML::_('grid.sort',  '#', 'g.id', @$lists['order_Dir'], @$lists['order'] ); ?></th>
				<th width="1%"> <input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $groups );?>);" /> </th>
				<th width="35%" >
					<?php echo JHTML::_('grid.sort',  'Name', 'g.name', @$lists['order_Dir'], @$lists['order'] ); ?>
				</th>
				<th width="35%">
					<?php echo JHTML::_('grid.sort',  'Form', 'label', @$lists['order_Dir'], @$lists['order'] ); ?>
				</th>
				<th width="29%">
					<?php echo JText::_( 'Number of elements' );?>
				</th>
				<th width="5%">
				<?php echo JHTML::_('grid.sort',  'Published', 'g.state', @$lists['order_Dir'], @$lists['order'] ); ?>
				</th>
			</tr> 
			</thead>
			<?php $k = 0;
			for ( $i = 0, $n = count($groups); $i < $n; $i ++ ) {
				$row = & $groups[$i]; 
				$checked		= JHTML::_('grid.checkedout',   $row, $i );
				$link 	= JRoute::_( 'index.php?option=com_fabrik&c=group&task=edit&cid='. $row->id );
				$row->published = $row->state;
				$published		= JHTML::_('grid.published', $row, $i );
				?>
				<tr class="<?php echo "row$k"; ?>">
					<td width="2%"><?php echo $row->id; ?></td>
					<td width="1%"><?php echo $checked; ?></td>
					<td width="35%">
						<?php
						if ( $row->checked_out && ( $row->checked_out != $user->get( 'id' ) )) {
							echo  $row->name;
						} else {
						?>
						<a href="<?php echo $link; ?>">
							<?php echo $row->name; ?>
						</a>
					<?php } ?>
					</td>
					<td width="35%">
						<?php echo "($row->form_id) " . $row->label; ?>
					</td>
					<td width="29%">
						<?php echo $row->_elementCount; ?>
					</td>
					<td width="5%">
						<?php echo $published;?>
					</td>
				</tr> 
				<?php $k = 1 - $k;
			} ?>
			<tfoot>
			<tr>
				<td colspan="5">
					<?php echo $pageNav->getListFooter(); ?>
				</td>
				</tr>
			</tfoot>
		</table>
		<input type="hidden" name="option" value="com_fabrik" />
		<input type="hidden" name=c value="group" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="filter_order" value="<?php echo $lists['order']; ?>" />
		<input type="hidden" name="filter_order_Dir" value="<?php echo $lists['order_Dir']; ?>" />
		<?php echo JHTML::_( 'form.token' ); ?>
	</form>
	<?php }	
}
?>