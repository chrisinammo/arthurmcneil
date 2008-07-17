<?php
/**
 * @package		Joomla
 * @subpackage	Fabrik
 * @license		GNU/GPL, see LICENSE.php
 */

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

class FabrikViewForm {
	
	/**
	 * set up the menu when viewing the list of forms
	 */

	function setFormsToolbar()
	{
		JToolBarHelper::publishList();
		JToolBarHelper::unpublishList();
		JToolBarHelper::title( JText::_( 'Forms' ), 'generic.png' );
		JToolBarHelper::customX( 'copy', 'copy.png', 'copy_f2.png', 'Copy' );
		JToolBarHelper::deleteList( );
		JToolBarHelper::editListX( );
		JToolBarHelper::addNewX( );
	}
	
	/**
	 * set up the menu when editing the form 
	 */

	function setFormToolbar()
	{
		$task = JRequest::getVar( 'task', '', 'method', 'string');
		JToolBarHelper::title( $task == 'addForm' ? JText::_( 'Form' ) . ': <small><small>[ '. JText::_( 'New' ) .' ]</small></small>' : JText::_( 'Form' ) . ': <small><small>[ '. JText::_( 'Edit' ) .' ]</small></small>', 'generic.png' );
		JToolBarHelper::save( );
		JToolBarHelper::apply( );
		JToolBarHelper::cancel( );
	}
	
	/**
	* Display all available forms
	* @param array array of form_rule objects
	* @param object page navigation 
	*/
	
	function show( $forms, $pageNav, $lists ) {
		FabrikViewForm::setFormsToolbar();
		$user	  = &JFactory::getUser();
		$user	  = &JFactory::getUser();
		?>
		
		<form action="index.php" method="post" name="adminForm">
			<table class="adminlist">
				<tr> 
					<td>
						<?php
						echo JText::_('Form') . ': ';
						echo $lists['filter_form'];
						?>
					</td>
				</tr>
			</table>
			
		<table class="adminlist"> 
			<thead>
			<tr>
				<th width="2%"><?php echo JHTML::_('grid.sort',  '#', 'f.id', @$lists['order_Dir'], @$lists['order'] ); ?></th>
				<th width="1%" > 
					<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $forms );?>);" />
				</th>
				<th width="29%" align="center">
					<?php echo JHTML::_('grid.sort',  'Label', 'f.label', @$lists['order_Dir'], @$lists['order'] ); ?>
				</th>
				<th width="5%">
					<?php echo JHTML::_('grid.sort',  'Published', 'f.state', @$lists['order_Dir'], @$lists['order'] ); ?>
				</th>
				<th width="20%">&nbsp;</th>
				<th width="20%">&nbsp;</th>
			</tr>
			</thead>
			<?php $k = 0;
		for ( $i = 0, $n = count($forms); $i < $n; $i ++ ) {
			$row = & $forms[$i]; 
			$link 	= JRoute::_('index.php?option=com_fabrik&c=form&task=edit&cid='. $row->id );
			$checked		= JHTML::_('grid.checkedout',   $row, $i );
			$row->published = $row->state;
			$published		= JHTML::_('grid.published', $row, $i );
			?> 
			<tr class="<?php echo "row$k"; ?>">
				<td><?php echo $row->id; ?></td>
				<td><?php echo $checked;?>
				<td>
					<?php
					if ( $row->checked_out && ( $row->checked_out != $user->get( 'id' ) )) {
						echo $row->label;
					} else {
					?>
						<a href="<?php echo $link;?>"><?php echo $row->label; ?></a>
					<?php } ?>
				</td>
				<td>
					<?php echo $published?>
				</td>						
				<td style="text-align:right">
					<?php if ( $row->record_in_database == '1' ) { ?> 
						<a href="#updatedatabase" onclick="return listItemTask('cb<?php echo $i;?>','updatedatabase')"><?php echo JText::_('Update database');?></a> 
					<?php
					} else {
						echo JText::_('n/a');
					} ?> 
				</td>
				<td width="20%" style="text-align:right"> 
					<?php
					if ( $row->record_in_database == '1' ) { ?>
							<a href="<?php echo JRoute::_('index.php?option=com_fabrik&c=table&task=viewTable&cid='.$row->_table_id);?>"><?php echo JText::_( 'View data' );?></a>
					<?php } else {
						echo JText::_('n/a');
					}?>
				</td>
			</tr> 
			<?php $k = 1 - $k;
			} ?>
			<tfoot>
				<tr>
				<td colspan="8">
					<?php echo $pageNav->getListFooter(); ?>
				</td>
				</tr>
			</tfoot>
		</table>
		<input type="hidden" name="option" value="com_fabrik" />
		<input type="hidden" name="c" value="form" />
		<input type="hidden" name="task" value="forms" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="filter_order" value="<?php echo $lists['order']; ?>" />
		<input type="hidden" name="filter_order_Dir" value="<?php echo $lists['order_Dir']; ?>" />
		<?php echo JHTML::_( 'form.token' ); ?>
	</form>
	<?php }	

	
	/**
	* Display the form to add or edit an form
	* @param object form table
	* @param object plugin manager
	* @param array lists
	* @param array menu
	* @param object parameters from attributes
	* @param object form - used to render xml form cdoe
	*/
	
	function edit( $row, $pluginManager, $lists, $menus, $params, &$form )
	{
		JHTML::stylesheet( 'fabrikadmin.css', 'administrator/components/com_fabrik/views/' );
		jimport('joomla.html.pane');
		JRequest::setVar( 'hidemainmenu', 1 );
		$pane	=& JPane::getInstance( );
		JHTML::_('behavior.tooltip');
		FabrikViewForm::setFormToolbar();
		$editor =& JFactory::getEditor();
		$document =& JFactory::getDocument();
		JHTML::script( 'mootools-ext.js', 'components/com_fabrik/libs/', true );
		JHTML::script( 'adminform.js', 'administrator/components/com_fabrik/views/', true );
		JFilterOutput::objectHTMLSafe( $row );
		$js = 
		
	"
  window.addEvent('load', function(){ 
  	var lang = {
			'action':'".JText::_( 'Action' )."',
			'do':'".JText::_( 'Do' )."',
			'del':'".JText::_( 'Delete' )."',
			'in':'".JText::_( 'In' )."',
			'on':'".JText::_( 'On' )."',
			'options':'".JText::_( 'Options' )."',
			'please_select': '".JText::_( 'Please select' )."'
		}
  	var aPlugins = [];\n";

  $c = 0;

  foreach ($pluginManager->_plugIns['form'] as $usedPlugin => $oPlugin) {
		$pluginParams = &new fabrikParams( $row->attribs, $oPlugin->_xmlPath, 'fabrikplugin' );
		$pluginParams->_duplicate = true;
		$oPlugin->_adminVisible = false;
		$pluginHtml = $oPlugin->renderAdminSettings( $usedPlugin, $row, $pluginParams, $lists, $c );
	  $js .= "aPlugins.push({'".$usedPlugin."':'".$oPlugin->_pluginLabel."','value':'".$usedPlugin."','label':'".$oPlugin->_pluginLabel."', 'html':'".$pluginHtml."'});\n";
		$c ++; 
	}
	$js .= "controller = new fabrikAdminForm(aPlugins, lang);\n";
 	$usedPlugins 		= $params->get( 'plugin', '', '_default', 'array' );
 	$usedLocations 	= $params->get( 'plugin_locations', '', '_default', 'array' );
 	$usedEvents 		= $params->get( 'plugin_events', '', '_default', 'array' );
	$c = 0;
	foreach ($usedPlugins as $usedPlugin) {
		$oPlugin 		= $pluginManager->_plugIns['form'][$usedPlugin];
		$pluginParams 	= new fabrikParams( $row->attribs, $oPlugin->_xmlPath, 'fabrikplugin');
		$names 			= $pluginParams->_getParamNames();
		$tmpAttribs 	= '';
		foreach ($names as $name) {
			$pluginElOpts = $params->get($name, '', '_default', 'array');
			$val = (array_key_exists($c, $pluginElOpts)) ? $pluginElOpts[$c] : '';
			$tmpAttribs .= $name . "=" . $val . "\n";
		}
    //redo the parmas with the exploded data
    $pluginParams = new fabrikParams( $tmpAttribs, $oPlugin->_xmlPath, 'fabrikplugin');
    $pluginParams->_duplicate = true;
    $oPlugin->_adminVisible = true;
    $oPlugin->_counter = $c;
		$data = $oPlugin->renderAdminSettings( $usedPlugin, $row, $pluginParams, $lists, 0);
		
		$js .= "controller.addAction( '".$data."', '".$usedPlugins[$c]."', '".$usedLocations[$c]."', '".$usedEvents[$c]."');\n";
		$c ++;
  }
  jimport( 'joomla.html.editor' );
  $js .= "
});

function submitbutton(pressbutton) {		

	var form = document.adminForm;"
	. $editor->save( 'intro' )  
	. $editor->save( 'receipt_message' )
	. $editor->save( 'form_submit_message' )
	."
	if (pressbutton == 'cancel') {
		submitform( pressbutton );
		return;
	}

	/* do field validation */
	var err = '';
	
	if(pressbutton == 'menulinkForm'){
		if($('menuselect').selectedIndex == -1){
			err = err + '". JText::_( 'Please select a menu to pulish the link to' ) . '\n' . "';
		}
		if(\$('link_name').value == ''){
			err = err + '". JText::_( 'Please enter a label for your link' ). '\n' .  "';
		}
		if(\$('alias').value == ''){
			err = err + '". JText::_( 'Please enter an alias for your link' ). '\n' . "';
		}
	}
	
	if (form.label.value == '') {
		err = err + '". JText::_( 'Please enter a form label' ). '\n' . "';
	} 
	
	//if(form.id.value == 0 && form.record_in_database.checked == true && form._database_name.value == ''){
	if(form.record_in_database.checked == true && form._database_name.value == ''){
		err = err + '". JText::_( 'Please enter a database table name' ) . "';
	}
	if (err == ''){
		/* assemble the form groups back into one field */
		mergeFormGroups()
		submitform( pressbutton );
	}else{
		alert (err);
	}
}

function mergeFormGroups(){
	/* assemble the form groups back into one field */
	var tmp = [];
	if($('current_groups')){
		var opts = $('current_groups').options;
		for (var i=0, n=opts.length; i < n; i++) {	
			tmp.push(opts[i].value);
		}	
		$('current_groups_str').value = tmp.join(',');
	}
}
";
	$document->addScriptDeclaration($js);
	?>
		<form action="index.php" method="post" name="adminForm" id="adminForm">
		 	<table style="width:100%;">
		 		<tr>
	 			<td style="width:50%;" valign="top">
	 			<fieldset class="adminform">
				<legend><?php echo JText::_( 'Details' ); ?></legend>
					<table class="admintable"> 
						<tr>
							<td class="key" width="30%">
							<label for="label"><?php echo JText::_( 'Label' );?>: </label></td>
							<td width="70%">
								<input class="inputbox" type="text" name="label" id="label" size="50" value="<?php echo $row->label; ?>" />
							</td>
						</tr>
						<tr>
							<td class="key"><?php echo JText::_( 'Introduction' );?>: </td>
							<td><?php echo $editor->display( 'intro', $row->intro, '100%', '200', '50', '5', false );?>
							</td>
						</tr>
						<tr> 
							<td class="key">
								<label for="error">
								<?php echo JHTML::_('tooltip', JText::_( 'Error message Long' ), JText::_( 'Error message' ), 'tooltip.png', JText::_( 'Error message', true ));?>:
								</label> 
							</td>
							<td>
								<input class="inputbox" type="text" name="error" id="error" size="50" value="<?php echo $row->error; ?>" />
							</td>
						</tr> 
					</table>
				</fieldset>
				<fieldset class="adminform">
				<legend><?php echo JText::_( 'Buttons' ); ?></legend>
						<?php 
						echo $form->render( 'params', 'buttons' );
						?>
						<table class="admintable">
						<tr>
							<td class="key">
								<label for="submit_button_label">
								<?php echo JText::_('Submit label');?>: 
								</label>
							</td>
							<td>
								<input type="text" class="inputbox" id="submit_button_label" name="submit_button_label" value="<?php echo $row->submit_button_label;?>" />
							</td>
						</tr>
					</table>
				</fieldset>
				<fieldset class="adminform">
				<legend><?php echo JText::_( 'Form processing' ); ?></legend>
					<table class="admintable">
						<tr>
							<td class="key">
							<label for="record_in_database">
							<?php echo JText::_('Record in database');?>: 
							</label>
							</td>
							<td>
							<input type="checkbox" id="record_in_database" name="record_in_database" value="1" <?php if($row->record_in_database == '1'){echo(" checked=\"checked\"");}?> />
							</td>
						</tr>
						<tr>
							<td class="key">
							<label for="database_name">
							<?php echo JText::_('Table name');?>: 
							</label>
							</td>
							<td>
							<?php if($row->record_in_database != '1'){?>
								<input id="database_name" name="_database_name" value="" size="40" />
							<?php }else{ ?>
									<?php echo $row->_database_name;?>
									<input type="hidden" id="database_name" name="_database_name" value="<?php echo $row->_database_name;?>"  />
									<input type="hidden" id="_connection_id" name="_connection_id" value="<?php echo $row->_connection_id;?>"  />
							<?php }?>
							</td>
						</tr>
				</table>
				<?php 
						echo $form->render( 'params', 'processing');
						 ?>
			</fieldset>
					</td>
					<td valign="top">
					<?php 
					echo $pane->startPane("content-pane");
					echo $pane->startPanel( 'Publishing', "publish-page"); 
					echo $form->render('details');
					echo  $pane->endPanel();
					echo $pane->startPanel(JText::_( 'Form groups' ), "formgroups-page"); ?>
		<table class="adminform">
			<tr>
				<th colspan="2"><?php echo JText::_( 'Form groups' ); ?></th>
			</tr>
			<?php if(empty($lists['groups']) && empty($lists['current_groups'])){?>
			<tr>
				<td>
				<?php echo JText::_( 'No groups created' );?>
				<input type="hidden" name="_createGroup" id="_createGroup" value="1" />
				</td>
			</tr>
			<?php }else{?>
			<tr>
				<td colspan="2"><label>
				<?php $checked = empty($lists['current_groups']) ? 'checked="checked"' : '';?>
				<input type="checkbox" <?php echo $checked?> name="_createGroup" id="_createGroup" value="1" />
				<?php echo JText::_( 'Create a group with the same name as this form' );?>
				</label></td>
			</tr>
			<?php 
				}
				if(!empty($lists['groups']) || !empty($lists['current_groups']) ){?>
			<tr>
				<td><?php echo JText::_( 'Available groups' );?></td>
				<td><?php echo $lists['grouplist']; ?>
					<input "class="button" type="button" value="<?php echo JText::_('Add'); ?>"
					onclick="$('_createGroup').checked = false;addSelectedToList('adminForm','groups','current_groups');delSelectedFromList('adminForm','groups');" />
				</td>
			</tr>
			<tr>
				<td><?php echo JText::_( 'Current groups' );?></td>
				<td><?php echo $lists['current_grouplist'];?></td>
			</tr>
			<tr>
				<td colspan="2"><input class="button" type="button"
					value="<?php echo JText::_( 'Up' ); ?>"
					onclick="moveInList('adminForm','current_groups',adminForm.current_groups.selectedIndex,-1)" />
				<input class="button" type="button" value="<?php echo JText::_( 'Down' ); ?>"
					onclick="moveInList('adminForm','current_groups',adminForm.current_groups.selectedIndex,+1)" />
				<input class="button" type="button" value="<?php echo JText::_( 'Remove' ); ?>"
					onclick="addSelectedToList( 'adminForm', 'current_groups', 'groups' );delSelectedFromList('adminForm','current_groups');" />
				</td>
			</tr>
			<?php }?>
		</table>
		<?php echo  $pane->endPanel();
		echo $pane->startPanel( JText::_( 'Templates' ), "template-page"); ?>
		<table class="adminform">
			<tr>
				<th colspan="2"><?php echo JText::_( 'Templates' ); ?></th>
			</tr>
			<tr>
				<td><?php echo JText::_('Detailed view template'); ?></td>
				<td><?php echo $lists['viewOnlyTemplates']; ?></td>
			</tr>
			<tr>
				<td><?php echo JText::_('Form template'); ?></td>
				<td><?php echo $lists['formTemplates']; ?></td>
			</tr>
		</table>
		<?php echo  $pane->endPanel();
		echo $pane->startPanel( JText::_( 'Link to menu' ), "menu-page"); ?>
		<table class="adminform">
			<tr>
				<th colspan="2"><?php echo JText::_( 'Link to menu' ); ?></th>
			</tr>
			<tr>
				<td><?php echo JText::_( 'Select Menu' ); ?></td>
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
					<input name="menu_link" type="button" class="button" value="<?php echo JText::_( 'Link to menu' ); ?>" onclick="submitbutton('menulinkForm');" />
				</td>
			</tr>
			<tr>
				<th colspan="2"><?php echo JText::_( 'Menu Links' ); ?></th>
			</tr>
			<?php if ($menus == NULL) { ?>
				<tr>
					<td colspan="2"><?php echo JText::_('None'); ?></td>
				</tr>
			<?php } else {
					FabrikHelperAdminHTML::menuLinksContent( $menus, 'Form' );
			}?>
			<tr>
				<td colspan="2">
				</td>
			</tr>										
		</table>
		<?php 
		echo $pane->endPanel();
		echo $pane->startPanel( JText::_( 'Options' ), "menu-page" ); 
		echo $form->render( 'params', 'options' );
		echo $pane->endPanel();
		echo $pane->startPanel( 'Form actions', "actions-page" );?>
			<table class="adminform">
				<tr>
					<th colspan="2">
					<a href="#" class="addButton" id="addAction"><?php echo JText::_( 'Add' ); ?></a>
					</th>
				</tr>
				<tr>
					<td colspan="2" id="formActions"><br />
					</td>
				</tr>
			</table>
		<?php echo $pane->endPanel();
		echo $pane->endPane(); ?>
			</td>
		</tr>
	</table>
	<input type="hidden" name="task" id="task" value="" />
	<input type="hidden" name="option" value="com_fabrik" />
	<input type="hidden" name="c" value="form" />
	<input type="hidden" name="id" value="<?php echo $row->id; ?>" />
	<input type="hidden" name="boxchecked" value="" />
	<input type="hidden" name="current_groups_str" id="current_groups_str" value="" />
	<?php echo JHTML::_( 'form.token' ); ?>
</form>
	<?php }	
}


?>