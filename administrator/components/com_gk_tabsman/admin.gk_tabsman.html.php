<?php
/*
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

class TabsView{
	
	/**
		metoda do pokazywania grup komponentu
		pobiera dane z zapytania MySQL oraz parametr Option i dane o u¿ytkowniku
	**/
	
	function showTabsGroups(& $rows, $option, & $client){
		
		global $mainframe;
		// stworzenie obiektu u¿ytkownika
		$user = & JFactory :: getUser();
		
		// wypisanie nag³ówków tabeli
?>
		<form action="index.php" method="post" name="adminForm">
			<table class="adminlist">
			<thead>
				<tr>
					<th width="3%" class="title" align="center"><?php echo JText::_( '#' ); ?></th>
					<th width="3%" class="title" align="center"><?php echo JText::_( 'ID' ); ?></th>
					<th width="20%" class="title" colspan="2"><?php echo JText::_( 'Tabs group name' ); ?></th>
					<th width="59%" align="center"><?php echo JText::_( 'Tabs group description' ); ?></th>
					<th width="5%" class="title" align="center"><?php echo JText::_( 'Tabs' ); ?></th>
					<th width="10%" class="title" align="center"><?php echo JText::_( 'Module' ); ?></th>
				</tr>
			</thead>
			<tbody>
			
			<?php 
			
				// wypisanie wierszy tabeli
				if(count($rows) > 0){
					for ($i = 0, $n = count($rows); $i < $n; $i++) { 
						$row = & $rows[$i]; 
			?>
			
				<tr class="<?php echo 'row'. $i; ?>">
					<td width="3%" align="center"><?php echo $i+1; ?></td>
					<td width="3%" align="center"><?php echo $row->id; ?></td>
					
					<td width="3%" align="center">
						<input type="radio" id="cb<?php echo $i;?>" name="cid[]" value="<?php echo $row->id; ?>" onclick="isChecked(this.checked);" />
					</td>
					
					<td width="17%" align="left">
						<span style="text-decoration: underline;cursor: pointer;" onclick="javascript:document.getElementById('cb<?php echo $i ?>').checked='checked';isChecked(document.getElementById('cb<?php echo $i ?>').checked);submitbutton('view_group');" title="Click it to show this tabs group.">
							<?php echo $row->name;?>
						</span>
					</td>
					<td width="59%" align="left"><?php echo $row->desc; ?></td>
					<td width="5%" align="center"><?php echo $row->tamount; ?></td>
					<td width="10%" align="center"><?php echo $row->module; ?></td>
				</tr>
				
			<?php 
					} 
				}
				else{ 
				// gdy brak grup do za³adowania
			?>
				<tr>
					<td width="100%" align="center" colspan="7">Any groups to load...</td>
				</tr>
			<?php } ?>
			
			</tbody>
			</table>
		<input type="hidden" name="option" value="<?php echo $option;?>" />
		<input type="hidden" name="client" value="<?php echo $client->id;?>" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		<?php echo JHTML::_( 'form.token' ); ?>
	</form>
	<?php
	}
	
	/**
		metoda do pokazywania danej grupy komponentu
		pobiera dane z zapytania MySQL oraz parametr Option i dane o u¿ytkowniku
	**/	
	
	function showTabsGroup(& $rows, $module, $gid, $option, & $client){
	
		global $mainframe;
		// stworzenie obiektu u¿ytkownika
		$user = & JFactory :: getUser();
		
		if($module == 'tabarts'){
			$db =& JFactory::getDBO();
			$db->setQuery( "SELECT id, title FROM #__content ORDER BY id;" );
			
			$artsTitles = array();
			
			foreach($db->loadObjectList() as $art) $artsTitles[$art->id] = $art->title;
		}
		
		// wyœwietlenie nag³ówka tabeli
?>
		<form action="index.php" method="post" name="adminForm">
			<table class="adminlist">
			<thead>
				<tr>
					<th width="3%" class="title" align="center"><?php echo JText::_( '#' ); ?></th>
					<th width="3%" class="title" align="center"><?php echo JText::_( 'ID' ); ?></th>
					<th width="20%" class="title" colspan="2"><?php echo JText::_( 'Tab name' ); ?></th>
					<th width="59%" align="center"><?php echo JText::_( 'Tab content' ); ?></th>
					<th width="15%" class="title" align="center">Order <?php echo JHTML::_('grid.order',  $rows ); ?></th>
				</tr>
			</thead>
			<tbody>
			
			<?php 
				// wyœwietlenie wierszy tabeli
				if(count($rows) > 0){
					for ($i = 0, $n = count($rows); $i < $n; $i++) { 
						$row = & $rows[$i]; 
			?>
			
				<tr class="<?php echo 'row'. $i; ?>">
					<td width="3%" align="center"><?php echo $i+1; ?></td>
					<td width="3%" align="center"><?php echo $row->id; ?></td>
					
					<td width="3%" align="center">
						<input type="radio" id="cb<?php echo $i;?>" name="cid[]" value="<?php echo $row->id; ?>" onclick="isChecked(this.checked);" />
					</td>
					
					<td width="17%" align="left"><?php echo $row->name;?></td>
					<td width="59%" align="left">
					<?php 
						if($module == 'tabarts'){
							echo '<strong>Article</strong>: <strong>ID</strong>: '.$row->content.' <em>"'.$artsTitles[$row->content].'"</em>' ; 
						}else{
							echo '<strong>Position</strong>: <em>'.$row->content.'</em>'; 
						}
					?>
					</td>
					<td width="15%" align="center"><input type="text" name="order[]" size="5" value="<?php echo $row->order;?>" class="text_area" style="text-align: center" /></td>
				</tr>
				
			<?php 
					} 
				}
				else{ 
				// je¿eli brak tabów do za³adowania
			?>
				<tr>
					<td width="100%" align="center" colspan="6">Any tabs to load...</td>
				</tr>
			<?php } ?>
			
			</tbody>
			</table>
		<input type="hidden" name="option" value="<?php echo $option;?>" />
		<input type="hidden" name="client" value="<?php echo $client->id;?>" />
		<input type="hidden" name="gid" value="<?php echo $gid;?>" />
		<input type="hidden" name="module" value="<?php echo $module;?>" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		<?php echo JHTML::_( 'form.token' ); ?>
	</form>
	<?php
	}
	
	/**
		metoda do pokazywania edytora dodawania grupy komponentu
		pobiera dane z zapytania MySQL oraz parametr Option i dane o u¿ytkowniku
	**/
	
	function showAddTabsGroup($option, & $client){
		
		global $mainframe;
		
		// wyœwietlenie formularza
		?>
			<form action="index.php" method="post" name="adminForm">

			<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
				<td valign="top">
					<table class="adminform">
					<tr>
						<td width="150px" align="center"><strong>Group name:</strong></td>
						<td>
							<input type="text" name="name" id="name" class="input_box" size="70" value="" />
						</td>
					</tr>
				
					<tr>
						<td width="150px" align="center"><strong>Group description:</strong></td>
						<td>
							<textarea name="desc" id="desc"></textarea>
						</td>
					</tr>
				
					<tr>
						<td width="150px" align="center"><strong>Module for group:</strong></td>
						<td>
							<select name="module" id="module">
								<option selected="selected" value="tabmods">TabMods</option>
								<option value="tabarts">TabArts</option>
							</select>
						</td>
					</tr>
					</table>
				</td>
			</tr>
			</table>

			<input type="hidden" name="id" value="<?php echo $row->id; ?>" />
			<input type="hidden" name="cid[]" value="<?php echo $row->id; ?>" />
			<input type="hidden" name="version" value="<?php echo $row->version; ?>" />
			<input type="hidden" name="mask" value="0" />
			<input type="hidden" name="option" value="<?php echo $option;?>" />
			<input type="hidden" name="task" value="" />
			<?php echo JHTML::_( 'form.token' ); ?>
		</form>
		<?php
	}
	
	/**
		metoda do pokazywania edytora edycji grupy komponentu
		pobiera dane z zapytania MySQL (id, name, desc, module) oraz parametr Option i dane o u¿ytkowniku
	**/
	
	function showEditTabsGroup($id, $name, $desc, $module, $option, & $client){
		
		global $mainframe;
		// wyœwietlenie edytora wraz z wpisanymi danymi
		?>
			<form action="index.php" method="post" name="adminForm">

			<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
				<td valign="top">
					<table class="adminform">
					<tr>
						<td width="150px" align="center"><strong>Group name:</strong></td>
						<td>
							<input type="text" name="name" id="name" class="input_box" size="70" value="<?php echo $name;?>" />
						</td>
					</tr>
				
					<tr>
						<td width="150px" align="center"><strong>Group description:</strong></td>
						<td>
							<textarea name="desc" id="desc"><?php echo $desc;?></textarea>
						</td>
					</tr>
				
					<tr>
						<td width="150px" align="center"><strong>Module for group:</strong></td>
						<td>
							<select name="module" id="module">
								<option <?php if($module == "tabmods") echo 'selected="selected"'; ?> value="tabmods">TabMods</option>
								<option <?php if($module == "tabarts") echo 'selected="selected"'; ?> value="tabarts">TabArts</option>
							</select>
						</td>
					</tr>
					</table>
				</td>
			</tr>
			</table>

			<input type="hidden" name="id" value="<?php echo $id; ?>" />
			<input type="hidden" name="cid[]" value="<?php echo $id; ?>" />
			<input type="hidden" name="version" value="0" />
			<input type="hidden" name="mask" value="0" />
			<input type="hidden" name="option" value="<?php echo $option;?>" />
			<input type="hidden" name="task" value="" />
			<?php echo JHTML::_( 'form.token' ); ?>
		</form>
		<?php
	}
	
	/**
		metoda do pokazywania edytora dodawania taba do grupy komponentu
		pobiera dane z zapytania MySQL (id, name, desc, module) oraz parametr Option i dane o u¿ytkowniku
	**/
	
	function showAddTab($rowid, $rowmod, $option, & $client){
		
		global $mainframe;
		
		//  wyœwietlenie edytora taba
		?>
			<form action="index.php" method="post" name="adminForm">

			<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
				<td valign="top">
					<table class="adminform">
					<tr>
						<td width="150px" align="center"><strong>Tab name:</strong></td>
						<td>
							<input type="text" name="name" id="name" class="input_box" size="70" value="" />
						</td>
					</tr>
				
					<tr>
						<td width="150px" align="center"><strong>Tab content:</strong></td>
						<td>
							<?php if($rowmod == 'tabmods') :?>
								<?php 
									$url = & JURI::getInstance();
									$db =& JFactory::getDBO();
									$db->setQuery( "SELECT template FROM #__templates_menu WHERE client_id = 0 LIMIT 1" );

									foreach($db->loadObjectList() as $t) $templateDir = $t->template;
									
									$xml = & JFactory::getXMLParser('Simple');

									if ($xml->loadFile(JPATH_SITE . DS . 'templates' . DS . $templateDir . DS . 'templateDetails.xml')){
										$element = & $xml->document->positions[0];
										if($element){
											echo '<select id="content" name="content">';
											for($i = 0; $element->position[$i]; $i++){
												echo '<option value="'.$element->position[$i]->data().'">'.$element->position[$i]->data().'</option>';
											}
											echo '</select>';
										}
									}
									else{
										echo '<input type="text" name="content" id="content" class="input_box" size="70" value="" /> <strong>Warning:</strong> component canno\'t load template position from XML file, you must put module positions manually.';
									}
								?>
							<?php endif; ?>
							<?php if($rowmod == 'tabarts'){
								$db =& JFactory::getDBO();
								$db->setQuery( "SELECT id AS value, title AS text FROM #__content ORDER BY title ASC" );
								$arts = $db->loadObjectList();
								echo JHTML::_( 'select.genericlist', $arts, 'content' );	
							} ?>				
						</td>
					</tr>
					
					</table>
				</td>
			</tr>
			</table>

			<input type="hidden" name="id" value="<?php echo $rowid; ?>" />
			<input type="hidden" name="cid[]" value="<?php echo $rowid; ?>" />
			<input type="hidden" name="mask" value="0" />
			<input type="hidden" name="module" value="<?php echo $rowmod;?>" />
			<input type="hidden" name="option" value="<?php echo $option;?>" />
			<input type="hidden" name="task" value="add_tab" />
			<?php echo JHTML::_( 'form.token' ); ?>
		</form>
		<?php
	}
	
	/**
		metoda do pokazywania edytora edycji taba grupy komponentu
		pobiera dane z zapytania MySQL (id, name, desc, module) oraz parametr Option i dane o u¿ytkowniku
	**/
	
	function showEditTab($rowid, $rowmod, $tabid, $option, & $client){
		
		global $mainframe;
		
		$db =& JFactory::getDBO();
		$db->setQuery( "SELECT id, name, content FROM #__gk_tabsman_tabs WHERE id=".$tabid." LIMIT 1;" );
		foreach($db->loadObjectList() as $tab){
			$name = $tab->name;
			$content = $tab->content;
		}
		
		//  wyœwietlenie edytora taba
		?>
			<form action="index.php" method="post" name="adminForm">

			<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
				<td valign="top">
					<table class="adminform">
					<tr>
						<td width="150px" align="center"><strong>Tab name:</strong></td>
						<td>
							<input type="text" name="name" id="name" class="input_box" size="70" value="<?php echo $name;?>" />
						</td>
					</tr>
				
					<tr>
						<td width="150px" align="center"><strong>Tab content:</strong></td>
						<td>
							<?php if($rowmod == 'tabmods') :?>
								<?php 
									$url = & JURI::getInstance();
									$db =& JFactory::getDBO();
									$db->setQuery( "SELECT template FROM #__templates_menu WHERE client_id = 0 LIMIT 1" );

									foreach($db->loadObjectList() as $t) $templateDir = $t->template;
									
									$xml = & JFactory::getXMLParser('Simple');

									if ($xml->loadFile(JPATH_SITE . DS . 'templates' . DS . $templateDir . DS . 'templateDetails.xml')){
										$element = & $xml->document->positions[0];
										if($element){
											echo '<select id="content" name="content">';
											for($i = 0; $element->position[$i]; $i++){
												echo '<option '.(($element->position[$i]->data() == $content) ? 'selected="selected"': '').' value="'.$element->position[$i]->data().'">'.$element->position[$i]->data().'</option>';
											}
											echo '</select>';
										}
									}
									else{
										echo '<input type="text" name="content" id="content" class="input_box" size="70" value="'.$content.'" /> <strong>Warning:</strong> component canno\'t load template position from XML file, you must put module positions manually.';
									}
								?>
							<?php endif; ?>
							<?php if($rowmod == 'tabarts'){
								$db =& JFactory::getDBO();
								$db->setQuery( "SELECT id AS value, title AS text FROM #__content ORDER BY title ASC" );
								$arts = $db->loadObjectList();
								echo JHTML::_( 'select.genericlist', $arts, 'content', null, "value", "text", $content);
							} ?>				
						</td>
					</tr>
					
					</table>
				</td>
			</tr>
			</table>

			<input type="hidden" name="id" value="<?php echo $tabid; ?>" />
			<input type="hidden" name="gid" value="<?php echo $rowid; ?>" />
			<input type="hidden" name="cid[]" value="<?php echo $rowid; ?>" />
			<input type="hidden" name="mask" value="0" />
			<input type="hidden" name="module" value="<?php echo $rowmod;?>" />
			<input type="hidden" name="option" value="<?php echo $option;?>" />
			<input type="hidden" name="task" value="edit_tab" />
			<?php echo JHTML::_( 'form.token' ); ?>
		</form>
		<?php
	}
	
	/**
		metoda do pokazywania pomocy i informacji o komponencie
		pobiera parametr Option i dane o u¿ytkowniku
	**/	
	
	function showHelp($option, & $client){
		global $mainframe;
		?>
			<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
				<td valign="top">
					<h2>Help & Info</h2>
					
					<p>You can find the help file <a href="http://tools.gavick.com/help/TabsManagerHelpFile.pdf" target="_blank"> here...</a></p>
				</td>
			</tr>
			</table>
		<?php
	}
}