<?php
/**
* @package Joomla
* @subpackage Fabrik
* @copyright Copyright (C) 2005 Rob Clayburn. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/


// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

class FabrikViewConenction {
	
	/**
	 * set up the menu when viewing the list of connections
	 */

	function setConnectionsToolbar()
	{
		JToolBarHelper::title( JText::_( 'Connections' ), 'generic.png' );
		JToolBarHelper::makeDefault( 'setdefault' );
		JToolBarHelper::publishList( );
		JToolBarHelper::unpublishList( );
		JToolBarHelper::customX( 'copy', 'copy.png', 'copy_f2.png', 'Copy' );
		JToolBarHelper::deleteList( );
		JToolBarHelper::editListX( );
		JToolBarHelper::addNewX( );
	}
	
	/**
	 * set up the menu when editing the connection
	 */

	function setConnectionToolbar()
	{
		$task = JRequest::getVar( 'task', '', 'method', 'string');
		JToolBarHelper::title( $task == 'add' ? JText::_( 'Connection' ) . ': <small><small>[ '. JText::_( 'New' ) .' ]</small></small>' : JText::_( 'Connection' ) . ': <small><small>[ '. JText::_( 'Edit' ) .' ]</small></small>', 'generic.png' );
		JToolBarHelper::save( 'save' );
		JToolBarHelper::apply('apply');
		JToolBarHelper::cancel( 'cancel' );
	}
	
	/**
	 * show a list of all the connections
	 * @param array of connection objects
	 * @param object page navigation
	 */

	function show( $rows, $pageNav ) {
		FabrikViewConenction::setConnectionsToolbar();
		$user	  = &JFactory::getUser();
		 ?> 
		<form action="index.php" method="post" name="adminForm"> 
		<table class="adminlist"> 
			<thead>
			<tr>
			<th width="2%">#</th>
				<th width="1%" > 
					<input type="checkbox" name="toggle" value=""  onclick="checkAll(<?php echo count( $rows ); ?>);" />
				</th>
				<th width="29%" align="center">
					<?php echo JText::_( 'Label' ); ?>
				</th>
				<th width="20%" align="center"><?php echo JText::_( 'Host' ); ?></th>
				<th width="5%"><?php echo JText::_('Default'); ?></th>
				<th width="5%" align ="center"><?php echo JText::_( 'Published' ); ?></th>
				<th width="20%" ><?php echo JText::_( 'Database' ); ?></th>
				<th width="20%" ><?php echo JText::_( 'Test connection' ); ?></th>
			</tr>
			</thead> 
			<?php
		$k = 0;
		for ( $i = 0, $n = count($rows); $i < $n; $i ++ ) {
			$row = & $rows[$i];
			$checked		= JHTML::_('grid.checkedout',   $row, $i );
			$link 	= JRoute::_( 'index.php?option=com_fabrik&c=connection&task=edit&cid='. $row->id );
			$row->published = $row->state;
			$published		= JHTML::_('grid.published', $row, $i );
			?> 
			<tr class="<?php echo "row$k"; ?>">
				<td width="1%"><?php echo $row->id; ?></td>
				<td width="1%"><?php echo $checked; ?></td>
				<td width="29%">
					<?php
					if ( $row->checked_out && ( $row->checked_out != $user->get( 'id' ) )) {
						echo $row->description;
					} else {
					?>
						<a href="<?php echo $link; ?>" >
						<?php 
						echo $row->description; 
					}
					?>
					</a>
				</td>
				<td width="25%">
					<?php echo $row->host; ?>
				</td>
				<td align="center">
				<?php if ( $row->default == 1 ) { ?>
					<img src="templates/khepri/images/menu/icon-16-default.png" alt="<?php echo JText::_( 'Default' ); ?>" />
				<?php } else { ?>
				&nbsp;
				<?php } ?>
			</td>
				<td>
					<?php echo $published;?>
				</td>
				<td width="20%" >
					<?php echo $row->database; ?>
				</td>		
				<td width="20%" >
					<a href="#edit" onclick="return listItemTask('cb<?php echo $i; ?>','test')">
						<?php echo JText::_( 'Test connection' ); ?>
					</a>
				</td>						
			</tr> 
			<?php
			$k = 1 - $k;
		} 
		?> 
			<tfoot>
			<tr>
				<td colspan="8">
					<?php echo $pageNav->getListFooter(); ?>
				</td>
				</tr>
			</tfoot>
		</table>
		<input type="hidden" name="option" value="com_fabrik" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="c" value="connection" />
		<input type="hidden" name="task" value="" />
		<?php echo JHTML::_( 'form.token' ); ?>
	</form>		
	<?php
	}

	/** 
	 * edits a database connection
	 * @param object connection
	 */
	 
	function edit( $row ) {
		FabrikViewConenction::setConnectionToolbar();
		JRequest::setVar( 'hidemainmenu', 1 );
		$config =& JFactory::getConfig();
		if ($row->id == 1) {
			global $mosConfig_db;
	    $row->host = $config->getValue( 'host' );
	    $row->user = $config->getValue( 'user' );
	    $row->password = $config->getValue( 'password' );
	    $row->database = $config->getValue( 'db' );
	    echo "<strong>" . JText::_('This is original connection, details are taken from Joomla&apos;s configuration.php file') . "</strong>";
		}
		?>
		<form action="index.php" method="post" name="adminForm"> 
		<div class="col100">
			<fieldset class="adminform">
				<legend><?php echo JText::_( 'Details' ); ?></legend>
		<table class="admintable">
		<tbody>
			<tr>
				<td valign="top" class="key"><?php echo JText::_( 'Description' ); ?>:</td>
				<td><input class="inputbox" type="text" name="description" size="75" value="<?php echo $row->description; ?>" /></td>
			</tr>
			<tr>
				<td valign="top" class="key"><?php echo JText::_( 'Host' ); ?>:</td>
				<td><input class="inputbox" type="text" name="host" size="75" value="<?php echo $row->host; ?>" /></td>
			</tr>
			<tr>
		<td valign="top" class="key"><?php echo JText::_( 'Database' ); ?>:</td>
		<td><input class="inputbox" type="text" name="database" size="75" value="<?php echo $row->database; ?>" /></td>
			</tr> 
			<tr>
				<td valign="top" class="key"><?php echo JText::_( 'User' );?>:</td>
				<td><input class="inputbox" type="text" name="user" id="user" size="75" value="<?php echo $row->user; ?>" /></td>
			</tr>
			<?php if ($row->host != ""){?>
				<tr>
				<td valign="top" class="key"><?php echo JText::_('Enter a new password below or leave as it is');  ?></td>
				<td></td>
			</tr>	
			<?php } ?>		
			<tr>
				<td valign="top" class="key"><?php echo JText::_( 'Password' ); ?>:</td>
				<td><input class="inputbox" type="password" name="password" size="20" value="<?php echo $row->password; ?>" /></td>
			</tr>
			<tr>
				<td valign="top" class="key"><?php echo JText::_( 'Confirm password' ); ?>:</td>
				<td><input class="inputbox" type="password" name="passwordConf" size="20" value="<?php echo $row->password; ?>" /></td>
			</tr>			
			<tr>
				<td valign="top" class="key"><label for="state"><?php echo JText::_( 'Published' ); ?>:</label></td>
				<td>
					<input type="checkbox" id="state" name="state" value="1" <?php echo $row->state ? 'checked="checked"' : ''; ?> />
				</td>
			</tr>
			<tbody>					
		</table>
		<input type="hidden" name="option" value="com_fabrik" /> 
		<input type="hidden" name="task" value="save" />
		<input type="hidden" name="c" value="connection" /> 
		<input type="hidden" name="id" value="<?php echo $row->id; ?>" />
		</fieldset>
		</div>
		<?php echo JHTML::_( 'form.token' ); ?>
	</form>
<?php
 }
}
?>