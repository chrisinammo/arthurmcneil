<?php
/**
* @package Joomla
* @subpackage Fabrik
* @copyright Copyright (C) 2005 Rob Clayburn. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

class FabrikViewElement {
	
	/**
	 * set up the menu when viewing the list of  validation rules
	 */

	function setElementsToolbar()
	{
		JToolBarHelper::title( JText::_( 'Elements' ), 'generic.png' );
		JToolBarHelper::customX( 'addToTableView', 'publish.png', 'publish_f2.png', JText::_('Add to table view') );
		JToolBarHelper::customX( 'removeFromTableView', 'unpublish.png', 'unpublish_f2.png', JText::_('Remove from table view') );
		JToolBarHelper::publishList( );
		JToolBarHelper::unpublishList( );
		JToolBarHelper::customX( 'copy', 'copy.png', 'copy_f2.png', 'Copy' );
		JToolBarHelper::deleteList( );
		JToolBarHelper::editListX( );
		JToolBarHelper::addNewX( );
	}
	
	/**
	 * set up the menu when editing the validation rule
	 */

	function setElementToolbar()
	{
		$task = JRequest::getVar( 'task', '', 'method', 'string' );
		JToolBarHelper::title( $task == 'add' ? JText::_( 'Element' ) . ': <small><small>[ '. JText::_( 'New' ) .' ]</small></small>' : JText::_( 'Element' ) . ': <small><small>[ '. JText::_( 'Edit' ) .' ]</small></small>', 'generic.png' );
		JToolBarHelper::save( );
		JToolBarHelper::apply( );
		JToolBarHelper::cancel( );
	}
	
	/**
	* Display the form to add or edit an validation rule
	* @param object element table object
	* @param object plugin manager model
	* @param array lists
	* @param object parameters
	*/
	
	function edit( $row, $pluginManager, $lists, $params, $form )
	{
		FabrikViewElement::setElementToolbar();
		JHTML::stylesheet( 'fabrikadmin.css', 'administrator/components/com_fabrik/views/' );
		JRequest::setVar( 'hidemainmenu', 1 );
		$document =& JFactory::getDocument( );
		jimport( 'joomla.html.pane' );
		JHTML::_( 'behavior.mootools' );
		$pane	=& JPane::getInstance( );
		JHTML::_( 'behavior.tooltip' );
		jimport( 'joomla.html.editor' );
		$editor =& JFactory::getEditor();
		JHTML::script( 'element.js', 'components/com_fabrik/views/form/', true );
		JHTML::script( 'adminelement.js', 'administrator/components/com_fabrik/views/', true );
		$fbConfig =& JComponentHelper::getParams( 'com_fabrik' );
		?> 
		<script language="javascript" type="text/javascript">
		/* <![CDATA[ */

	var igCounter = 0;
	var valCounter = 0;
	var jsCounter = 0;

	function buildJavascript(){
		<?php 
		for($ii = 0; $ii < count($lists['jsActions']); $ii ++)
		{
			$action = addslashes(str_replace("\n", "", $lists['jsActions'][$ii][0]));
			$code = addslashes(str_replace("\n", "", $lists['jsActions'][$ii][1]));
			$code = str_replace("\r", "", $code);
			echo "addJavascript( '" . $action . "', \"" . $code . "\");\n";
		 } ?>	
		
	}
	
	function addJavascript(action, code){
		action = action ? action : '';
		code = code ? code : '';
		rExp = /;/gi;
		newString = new String (";\n")
		code = code.replace(rExp, newString)
           if(action == ''){	
           	action = 	'<?php echo str_replace("\n", "", $lists['jsDefaultActions']); ?>';
           }          		
		var sContent = 
			'<table class="adminform" id="jsAction_' + jsCounter + '">'
			+ '<tr><td colspan="2"></td></tr>'	
			+ '<tr>'
			+ '<td><?php echo JText::_('Javascript action'); ?></td>' 
			+'	<td>'
			+ action
			+'</td><tr>'
			+ '<tr><td><?php echo JText::_('Javascript code'); ?></td>' 
			+'	<td><textarea rows="8" cols="40" name="js_code[]" class="inputbox">' + code + '</textarea></td>'
			+'</tr>'
			+'<tr>'
			+	'<td colspan="2"><a href="#" class="removeButton" onclick="deleteSubElements(\'jsAction_'+jsCounter+'\');"><?php echo JText::_('Delete'); ?></a></td>'
			+ '</tr>'					
			+'</table>';					          	
		var oNewBody = $('javascriptActions');
		var oNew = document.createElement('div');
		oNew.innerHTML = sContent;
		oNewBody.appendChild(oNew.firstChild , oNewBody.childNodes[0]);
		jsCounter++;				
	}

	function buildValidations(sPrefix, sTagId){
		<?php
		$c = count( $lists['validations'] );
		for ($ii = 0; $ii < $c; $ii ++ )
			{?>
			addValidation(<?php echo $lists['validations'][$ii][3];?>, sPrefix, sTagId, '<?php echo addslashes(str_replace("\n", "", $lists['validations'][$ii][1])); ?>', '<?php echo addslashes(str_replace("\n", "", $lists['validations'][$ii][0])); ?>', '<?php echo addslashes($lists['validations'][$ii][2]); ?>');								 	
		<?php } ?>       	
	}
   			
	/* adds a validation dropdown and error field to the element */
		
	function addValidation( id, sPrefix, sTagId, sDropDown, sError, sCondition )
	{
		sDropDown = sDropDown ? sDropDown : '';
		sError = sError ? sError : '';
		sCondition = sCondition ? sCondition : '';
		if(sDropDown == ''){	
			sDropDown = 	'<?php echo str_replace("\n", "", $lists['validationrulelist']); ?>';
		}
		//var sCondition = '<input size="30" name="validation_param[validation_condition][]" value="' + sCondition + '" />';
		sCondition = '<textarea style="width:100%" cols="30" rows="5" name="validation_param[validation_condition][]">' + sCondition + '</textarea>';
		var sContent = 
			'<table class="adminform" id="valcontent_' + valCounter + '">'
			+ '<tr><td colspan="2"></td></tr>'	
			+ '<tr>'
			+ '<td><?php echo JText::_('Validation rule'); ?><input type="hidden" name="validation_id[]" value="' + id + '" /></td>' 
			+'	<td>'
			+ sDropDown
			+'</td><tr>'
			+ '<tr><td><?php echo JText::_('Error message'); ?></td>' 
			+'	<td><input class="inputbox" size="30" type="text" name="message[]"  id="' + sPrefix + 'value_'+valCounter+'" size="20" value="' + sError + '" /></td>'
			+'</tr>'
			+ '<tr>'
			+ '<td><?php echo JText::_('Validation condition<br><small>eval\'d PHP<br />can use {element_name}<br />condition must be true <br />to run validation</small>', true);?></td>'
			+ '<td>' + sCondition + '</td>'
			+ '</tr>'	
			+'<tr>'
			+	'<td colspan="2"><a href="#" class="removeButton" onclick="deleteSubElements(\'valcontent_'+valCounter+'\');"><?php echo JText::_('Delete'); ?></a></td>'
			+ '</tr>'
			+'</table>';					          	
		var oNewBody = $(sPrefix+sTagId);
		var oNew = document.createElement('div');
		oNew.innerHTML = sContent;
		oNewBody.appendChild(oNew.firstChild , oNewBody.childNodes[0]);
		valCounter++;
	}
				
	function addSubElement(sPrefix, sTagId, sValue, sText, sChecked) {
		var sCurValue = sValue ? sValue : '';
		rExp = /\"/gi;
		sCurValue = sCurValue.replace(rExp, "&quot;");
		var sCurText = sText ? sText : '';
		sCurText = sCurText.replace(rExp, "&quot;");
		var sCurChecked = sChecked ? sChecked : '';
		var sContent = 
			'<table name="contentArea" id="content_'+ igCounter +'">'
			+'<tbody>'
			+'<tr>' 
			+'	<td width="20%"><label for="' + sPrefix + 'value_'+igCounter+'"><?php echo JText::_( 'Value' );?></label></td>'
			+'	<td width="80%"><input class="inputbox" type="text" name="' + sPrefix +  'values" id="' + sPrefix + 'value_'+igCounter+'" size="20" value="' + sCurValue + '" /></td>'
			+'</tr>'
			+'<tr>' 
			+'	<td width="20%"><label for="' + sPrefix + 'text_'+igCounter+'"><?php echo JText::_( 'Label' );?></label></td>'
			+'	<td width="80%"><input class="inputbox" type="text" name="' + sPrefix + 'text" id="' + sPrefix + 'text_'+igCounter+'" size="20" value="' + sCurText + '" /></td>'
			+'</tr>';
			if(sPrefix != 'sort_'){
				sContent = sContent + 
				+'<tr>'
				+'	<td><label for="' + sPrefix + 'checked_'+igCounter+'" ><?php echo JText::_( 'Selected as default' );?></label></td>';
			
				if(sPrefix == 'rad_'){
					sContent = sContent + 
				'	<td><input class="inputbox" type="radio" name="' + sPrefix + 'intial_selection" id="' + sPrefix + 'checked_'+igCounter+'" ' + sCurChecked + ' /></td>';
				}else{
					sContent = sContent + 
				'	<td><input class="inputbox" type="checkbox" name="' + sPrefix + 'intial_selection" id="' + sPrefix + 'checked_'+igCounter+'" ' + sCurChecked + ' /></td>';
				}			
			}		
			sContent = sContent +'</tr>'
			+'<tr>'
			+	'<td colspan="2"><a href="#" onclick="deleteSubElements(\'content_'+igCounter+'\');"><?php echo JText::_( 'Delete' ); ?></a><hr /></td>'
			+ '</tr>'
			+'</tbody>'
			+'</table>';
		var oNewBody = $(sPrefix+sTagId);
		var oNew = document.createElement('div');
		oNew.innerHTML = sContent;
		oNewBody.appendChild(oNew.firstChild , oNewBody.childNodes[0]);
		igCounter++;
	}

	function submitbutton(pressbutton){
		adminform = $('adminForm');
		/*  do field validation */
		if (pressbutton == 'cancel' ){
			submitform( pressbutton );                   
			return ;
   	}        
		if (adminform.name.value == "") {
			alert( "<?php echo JText::_( 'Please select a name' );?>" );
		} else {
			submitbutton2( pressbutton );
		}
	}

	function submitbutton2(pressbutton) {
		<?php echo $editor->save( 'label' );?>
		//iternate through the plugin controllers to match selected plugin
		var adminform = document.adminForm;
		$A(pluginControllers).each(function(plugin){
			if($('detailsplugin').value == plugin.element){
				plugin.controller.onSave();
			}
		});
		submitform( pressbutton );
		return;
	}
	/* ]]> */
		</script>
		<?php
		$js = "window.addEvent('domready', function(){\n";
		$js .= "\tvar options = {'plugin':'$row->plugin','parentid':'$row->parent_id'};\n";
		$js .= "\tvar lang = {};\n";	
		$js .= "\tcontroller = new fabrikAdminElement(options, lang);\n";
		
		foreach ($pluginManager->_plugIns['element'] as $key => $tmp) 
				{
					$oPlugin =& $pluginManager->_plugIns['element'][$key];
					$oPlugin->setId( $row->id );
					$js .= $oPlugin->getAdminJS();
				}
		$js .= "});";
		$document->addScriptDeclaration($js);
		?>
<form action="index.php" method="post" name="adminForm" id="adminForm">
<?php if ($row->parent_id != 0) {
	?>
	<div id="system-message">
	<dl>
		<dd class="notice">
		<ul>
			<li>
				<?php echo JText::_( 'This element\'s properties are linked to:' ) ?>
			</li>
			<li>
				<a href="#" id="swapToParent" class="element_<?php echo $lists['parent']->id ?>"><?php echo $lists['parent']->label ?></a>
			</li>
			<li>
				<label><input id="unlink" name="unlink" id="unlinkFromParent" type="checkbox"> <?php echo JText::_( 'unlink') ?></label>	
			</li>
		</ul>
		</dd>
	</dl>
	</div>
<?php }?>
<table style="width:100%" id="elementFormTable" >
	<tr>
		<td style="width:50%" valign="top">
		<fieldset class="admintable">
			<legend><?php echo JText::_( 'Details' );?></legend>
			<table class="admintable">
				<tr>
					<td class="key">
						<label for="name">
						<?php echo JHTML::_( 'tooltip', JText::_( 'NAMEDESC' ), JText::_( 'Name' ), 'tooltip.png', JText::_( 'Name', true )); ?>
						</label>
					</td>
					<td>
						<input class="inputbox" type="text" id="name" name="name" size="75" value="<?php echo $row->name; ?>" /> 
						<input type="hidden" id="name_orig" name="name_orig" value="<?php echo $row->name; ?>" />
					</td>
				</tr>
				<tr>
					<td class="key">
						<label for="label">
							<?php echo JHTML::_('tooltip', JText::_( 'LABELDESC' ), JText::_( 'Label' ), 'tooltip.png', JText::_( 'Label', true ));?>
						</label>
					</td>
					<td>
						<?php if ($fbConfig->get( 'fbConf_wysiwyg_label' )) {
							echo $editor->display( 'label', $row->label, '100%', '200', '50', '5', false );
						} else { ?>
							<input class="inputbox" type="text" id="label" name="label" size="75" value="<?php echo $row->label; ?>" />
						<?php }?>
					</td>
				</tr>
			</table>
			<?php 
			echo $form->render('params');
			echo $form->render( 'details', 'basics');
			?>
		</fieldset>
		
		<fieldset class="admintable">
			<legend><?php echo JText::_( 'Options' );?></legend>
			<?php 
				foreach ($pluginManager->_plugIns['element'] as $key => $tmp) 
				{
					$oPlugin =& $pluginManager->_plugIns['element'][$key];
					$oPlugin->setId( $row->id );
					$oPlugin->renderAdminSettings( $lists );
				}
			?>
		</fieldset>
		
		</td>
		<td style="width:50%" valign="top">
		<?php
		echo $pane->startPane( "content-pane" );
		echo $pane->startPanel( JText::_( 'Publishing' ), "publish-page" );
		?>
		<fieldset>
		<?php
		echo $form->render( 'details', 'publishing' );
		echo $form->render( 'params', 'publishing2' );
		?>
		</fieldset>
		<fieldset class="admintable">
			<legend><?php echo JText::_( 'RSS' );?></legend>
			<?php 
			echo $form->render('params', 'rss');
			?>
			</fieldset>
		<?php
			echo $pane->endPanel();
			echo $pane->startPanel( JText::_( 'Table settings '), "table-page");
			?>
			<fieldset>
				<?php 
				echo $form->render('details', 'tablesettings');
				echo $form->render('params', 'tablesettings2');
				?>
			</fieldset>
					
			<fieldset>
				<legend><?php echo JText::_('Filters'); ?></legend>
				<?php 
				echo $form->render( 'details', 'filtersettings');
				echo $form->render( 'params', 'filtersettings2');
				?>
			</fieldset>
			
			<fieldset>
				<legend><?php echo JText::_('Calculations'); ?></legend>
				<?php echo $form->render('params', 'calculations');?>
			</fieldset>
		<?php
			echo $pane->endPanel();
			echo $pane->startPanel(JText::_('Validations'), "validations-page");
		?>
		<fieldset>
			<legend><?php echo JText::_('Validations'); ?></legend>
			<a class="addButton" href="#" onclick="addValidation(0, 'val_', 'subElementBody'); return false;"><?php echo JText::_('Add'); ?></a>
			<div id="val_subElementBody">
			</div>
		</fieldset>
		<script language="javascript" type="text/javascript">buildValidations('val_', 'subElementBody');</script>
		<?php
		echo $pane->endPanel();
		echo $pane->startPanel(JText::_('Javascript'), "javascript-page");?>
		<fieldset>
			<legend><?php echo JText::_('Javascript'); ?></legend>
			<a class="addButton" href="#" onclick="addJavascript();return false;"><?php echo JText::_('Add'); ?></a>
			<div id="javascriptActions">
			</div>
		</fieldset>
		<script language="javascript" type="text/javascript">buildJavascript();</script>
		<?php
		echo $pane->endPanel();
		echo $pane->endPane();
		?></td>
	</tr>
</table>
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="option" value="com_fabrik" />
	<input type="hidden" name="c" value="element" />
	<input type="hidden" name="id" value="<?php echo $row->id; ?>" />
	<input type="hidden" name="boxchecked" value="" />
	<input type="hidden" name="redirectto" value="" />
	<?php echo JHTML::_( 'form.token' ); ?>
	</form>
	<?php  }

	/**
	* Display all available validation rules
	* @param array array of validation_rule objects
	* @param object page navigation 
	* @param array lists
	*/
	
	function show( $elements, $pageNav, $lists )
	{
		FabrikViewElement::setElementsToolbar();	
		$user	  = &JFactory::getUser();
		?> 
		<form action="index.php" method="post" name="adminForm"> 
			<table cellpadding="4" cellspacing="0" border="0" width="100%">
				<tr> 
					<td><?php echo JText::_( 'Name' ).": "; ?>
						<input type="text" name="filter_elementName" value="<?php echo $lists['search'];?>" class="text_area" onChange="document.adminForm.submit();" />
					</td>
					<td>
						<?php echo $lists['groupId']; ?>
					</td>					
					<td>
						<?php echo $lists['elementId']; ?>
					</td>
					<td>
						<?php echo $lists['filter_showInTable'];?>
					</td>
					<td>
						<?php echo $lists['filter_published']; ?>
					</td>
				</tr> 
			</table>
			<table class="adminlist"> 
			<thead>
			<tr> 
				<th width="2%"> <input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $elements );?>);" /></th>
				<th width="25%" >
					<?php echo JHTML::_('grid.sort', 'Name', 'e.name', @$lists['order_Dir'], @$lists['order'] ); ?>
				</th>
				<th width="25%" >
					<?php echo JHTML::_('grid.sort', 'Label', 'e.label', @$lists['order_Dir'], @$lists['order'] ); ?>
				</th>
				<th width="20%" >
					<?php echo JHTML::_('grid.sort', 'Group', 'g.name', @$lists['order_Dir'], @$lists['order'] ); ?>
				</th>
				<th width="10%" >
					<?php echo JHTML::_('grid.sort', 'Element type', 'plugin', @$lists['order_Dir'], @$lists['order'] ); ?>
				</th>
				<th width="5%">
					<?php echo JHTML::_('grid.sort', 'Show in table', 'show_in_table_summary', @$lists['order_Dir'], @$lists['order'] ); ?>
				</th>
				<th width="3%">
					<?php echo JHTML::_('grid.sort', 'Published', 'e.state', @$lists['order_Dir'], @$lists['order'] ); ?>
				</th>
				<th width="10%">
					<?php echo JHTML::_('grid.sort',  'Order', 'e.ordering', @$lists['order_Dir'], @$lists['order'] ); ?>
					<?php echo JHTML::_('grid.order', $elements ); ?>
				</th>
			</tr>
			</thead>
			<?php $k = 0;
			for ($i = 0, $n = count($elements); $i < $n; $i ++) {
				$row 				= & $elements[$i]; 
				$checked		= JHTML::_('grid.checkedout',   $row, $i );
				$link 			= JRoute::_( 'index.php?option=com_fabrik&c=element&task=edit&cid='. $row->id );
				$row->published = $row->state;
				$published		= JHTML::_('grid.published', $row, $i );
				?>
				<tr class="<?php echo "row$k"; ?>"> 
					<td>
						<?php echo $checked; ?>
					</td>
					<td >
						<?php
						if ($row->checked_out && ( $row->checked_out != $user->get( 'id' ) )) {
							echo $row->name;
						} else {
						?>
							<a href="<?php echo $link;?>"><?php echo $row->name; ?></a>
						<?php } ?>
					</td>
					<td><?php echo $row->label; ?></td>
					<td><?php echo $row->group_name; ?></td>
					<td><?php echo $row->pluginlabel; ?></td>
					<td>
					<?php if ($row->show_in_table_summary == "1") {
						$img = 'publish_g.png';
						$alt = JText::_( 'Shown in table view' );
					} else {
						$img = "publish_x.png";
						$alt = JText::_( 'Not Shown in table view' );
					}
					?>
						<a href="javascript:void(0);" onclick="return listItemTask('cb<?php echo $i;?>','<?php echo $row->show_in_table_summary ? "removeFromTableview" : "addToTableView";?>');">
							<img src="images/<?php echo $img;?>" border="0" alt="<?php echo $alt; ?>" />
						</a>
					</td>
					<td>
						<?php echo $published;?>
					</td>
					<td class="order"> 
					<?php $condition = $row->group_id == @ $elements[$i -1]->group_id;
					echo '<span>' . $pageNav->orderUpIcon($i, ($condition), 'orderUpElement') . '</span>'; 
					$condition = $row->group_id == @ $elements[$i +1]->group_id;
					echo '<span>' . $pageNav->orderDownIcon($i, $n, ($condition), 'orderDownElement') . '</span>'; 
					?>
						<input type="text" name="order[]" size="5" value="<?php echo $row->ordering; ?>" class="text_area" style="text-align: center" />
					</td>
				</tr> 
			<?php
			$k = 1 - $k;
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
		<input type="hidden" name="c" value="element" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="filter_order" value="<?php echo $lists['order']; ?>" />
		<input type="hidden" name="filter_order_Dir" value="<?php echo $lists['order_Dir']; ?>" />
		<?php echo JHTML::_( 'form.token' ); ?>
	</form>
	<?php }	
}
?>