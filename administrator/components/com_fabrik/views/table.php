<?php
/**
* @package Joomla
* @subpackage Fabrik
* @copyright Copyright (C) 2005 Rob Clayburn. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

class FabrikViewTable {
	
	/**
	 * set up the menu when viewing the list of  tables
	 */

	function setTablesToolbar()
	{
		JToolBarHelper::publishList();
		JToolBarHelper::unpublishList();
		JToolBarHelper::title( JText::_( 'Table' ), 'generic.png' );
		JToolBarHelper::customX( 'copy', 'copy.png', 'copy_f2.png', 'Copy' );
		JToolBarHelper::deleteList( );
		JToolBarHelper::editListX( );
		JToolBarHelper::addNewX( );
		JToolBarHelper::preferences('com_fabrik', '200');
	}
	
	/**
	 * set up the menu when editing the tables
	 */

	function setTableToolbar()
	{
		$task = JRequest::getVar( 'task', '', 'method', 'string');
		JToolBarHelper::title( $task == 'add' ? JText::_( 'Table' ) . ': <small><small>[ '. JText::_( 'New' ) .' ]</small></small>' : JText::_( 'Table' ) . ': <small><small>[ '. JText::_( 'Edit' ) .' ]</small></small>', 'generic.png' );
		JToolBarHelper::save( );
		JToolBarHelper::apply( );
		JToolBarHelper::cancel( );
	}
	
	/**
	* Display the form to add or edit a table
	 * @param object table
	 * @param array the drop down lists used on the form
	 * @param array connection tables
	 * @param object menus
	 * @param string compoent action
	 * @param int form id that the table links to?
	 * @param object parameters
	 * @param object plugin mangager
	 * @param object table model
	*/
	
	function edit( $row, $lists, $connectionTables, $menus, $fabrikid, $params, $pluginManager, $model, $form )
	{
		JHTML::stylesheet( 'fabrikadmin.css', 'administrator/components/com_fabrik/views/' );
		FabrikViewTable::setTableToolbar( );
		JRequest::setVar( 'hidemainmenu', 1 );
		$document =& JFactory::getDocument( );
		JHTML::script( 'mootools-ext.js', 'components/com_fabrik/libs/', true );
		JHTML::script( 'admintable.js', 'administrator/components/com_fabrik/views/', true );
		JFilterOutput::objectHTMLSafe( $row );
		jimport( 'joomla.html.editor' );
		jimport('joomla.html.pane');
		JHTML::_('behavior.tooltip');
		$editor =& JFactory::getEditor( );
		$pane	=& JPane::getInstance( );
		$js = "window.addEvent('load', function(){
  			var lang = {
			'action':'".JText::_( 'Action' )."',
			'do':'".JText::_( 'Do' )."',
			'del':'". JText::_( 'Delete' )."',
			'in':'".JText::_( 'In' )."',
			'on':'".JText::_( 'On' )."',
			'options':'".JText::_( 'Options' )."',
			'please_select':'".JText::_( 'Please select' )."'
		}
  		var aPlugins = [];";
	
	  $c = 0;
		foreach ($pluginManager->_plugIns['table'] as $usedPlugin => $oPlugin) {
			$pluginParams = new fabrikParams( $row->attribs, $oPlugin->_xmlPath, 'fabrikplugin');
			$pluginParams->_duplicate = true;
			$oPlugin->_adminVisible = false;
			$pluginHtml = $oPlugin->renderAdminSettings( $usedPlugin, $row, $pluginParams, $lists, $c );
			$js .= "aPlugins.push({'key':'".$oPlugin->_pluginLabel."','value':'".$usedPlugin."','label':'".$oPlugin->_pluginLabel."', 'html':'".$pluginHtml."'});\n";
			$c ++; 
		}
		$js .= "pluginManager = new TablePluginManager(aPlugins);\n";
		$usedPlugins 	= $params->get( 'plugin', '', '_default', 'array' );
		$usedLocations 	= $params->get( 'plugin_locations', '', '_default', 'array' );
		$usedEvents 	= $params->get( 'plugin_events', '', '_default', 'array' );
		$c = 0;

		foreach ($usedPlugins as $usedPlugin) {
			$oPlugin 		= $pluginManager->_plugIns['table'][$usedPlugin];
			$pluginParams 	= new fabrikParams( $row->attribs, $oPlugin->_xmlPath, 'fabrikplugin');
			$names 			= $pluginParams->_getParamNames();
			$tmpAttribs 	= '';
			foreach ($names as $name) {
				$pluginElOpts = $params->get( $name, '', '_default', 'array' );
				$val = ( array_key_exists( $c, $pluginElOpts ) ) ? $pluginElOpts[$c] : '';
				$tmpAttribs .= $name . "=" . $val . "\n";
			}
			//redo the parmas with the exploded data
			$pluginParams = new fabrikParams( $tmpAttribs, $oPlugin->_xmlPath, 'fabrikplugin');
			$pluginParams->_duplicate = true;
			$oPlugin->_adminVisible = true;
			$oPlugin->_counter = $c;
			$data = $oPlugin->renderAdminSettings( $usedPlugin, $row, $pluginParams, $lists, 0);
			$js .= "pluginManager.addAction( '<?php echo $data;?>', '<?php echo $usedPlugins[$c];?>', '', '');\n";
			$c ++;
		}
 
		$js .= "});\n";
		$js .= "var connectiontables = new Array;\n";
		$i = 0;
		if( is_array( $connectionTables ) ){
			foreach ( $connectionTables as $k => $items ) {
				foreach ( $items as $v ) {
					$js .= "connectiontables[".$i ++."] = new Array( '$k','".addslashes($v->value)."','".addslashes($v->text)."' );\n\t\t";
				}
			}
		}
		$js .= "
			function submitbutton(pressbutton){
				if (pressbutton == 'cancel') {
					submitform( pressbutton );
					return;
				}
				var err = '';";
				$js .= $editor->save( 'introduction' );
				$js .= "if(\$('label').value == ''){
					err = err +'".JText::_( 'Please enter a table label', true ). '\n'."';
				}
				
				if(pressbutton == 'menuLinkTable'){
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
				if($('database_name')){
					if($('database_name').value == ''){
						if($('connection_id')){
							if($('connection_id').value == '-1'){
								err = err +'".JText::_( 'Please select a connection', true ). '\n' ."';
							}
						}			
						
						if($('tablename')){
							if($('tablename').value == '' || $('tablename').value == '-1'){
								err = err + '".JText::_( 'Please select a database table', true ). '\n' ."';
							}	
						}
					}
				}
				if (err == ''){
					submitform( pressbutton );
				}else{
					alert (err);
					return false;
				}
			}
			var joinCounter = 0;";
			$document->addScriptDeclaration( $js );
;?>
<form action="index.php" method="post" name="adminForm">
<table style="width:100%">
	<tr>
		<td style="width:50%" valign="top">
		<fieldset class="adminform">
		<legend><?php echo JText::_( 'Details' );?></legend>
		<table class="admintable">
			<tr>
				<td class="key"><label for="label"><?php echo JText::_( 'Label' ); ?>: </label></td>
				<td>
				<input class="inputbox" type="text" id="label" name="label" size="50" value="<?php echo $row->label?>" />
				</td>
			</tr>
			<tr>
				<td class="key"><?php echo JText::_( 'Introduction' ); ?>: </td>
				<td>
				<?php echo $editor->display( 'introduction', $row->introduction, '100%', '200', '45', '25', false ); ?>
				</td>
			</tr>
			<tr>
				<td class="key"><?php echo JText::_( 'Template' ); ?>: </td>
				<td><?php print_r($lists['tableTemplates']); ?></td>
			</tr>
			<tr>
				<td class="key">
				<label for="rows_per_page"><?php echo JText::_( 'Rows per page' ); ?>: </label>
				</td>
				<td>
				<input type="text" name="rows_per_page" id="rows_per_page" class="inputbox" value="<?php echo ($row->rows_per_page != '') ? $row->rows_per_page : 10; ?>" size="3" />
				</td>
			</tr>
			<tr>
				<td class="key"><?php echo JText::_( 'Filter trigger' );?>: </td>
				<td><?php echo $lists['filter_action']; ?></td>
			</tr>
		</table>
		</fieldset>
		
		<fieldset>
			<legend><?php echo JText::_( 'Layout' );?></legend>
			<?php echo $form->render('params', 'layout');?>
		</fieldset>
		
		</td>
		<td valign="top"><?php
		 echo $pane->startPane("content-pane");
		echo $pane->startPanel( JText::_( 'Publishing' ), "publish-page"); 
		echo $form->render('details');
		 ?>
		<fieldset>
			<legend><?php echo JText::_('RSS Options'); ?></legend>
			<?php 
			echo $form->render('params', 'rss');
			?>
		</fieldset>
		<fieldset>
			<legend><?php echo JText::_( 'CSV Options' );?></legend>
			<?php echo $form->render('params', 'csv');?>
		</fieldset>
		
		<?php
		echo $pane->endPanel( );
		echo $pane->startPanel( JText::_( 'Access' ), "access-page" ); ?>
		<fieldset>
			<legend><?php echo JText::_('Access'); ?></legend>
			<?php echo $form->render('params', 'access');?>
		</fieldset>
		<?php
		echo $pane->endPanel( );
		echo $pane->startPanel( JText::_( 'Data' ), "tabledata-page" ); ?>
		<fieldset>
			<legend><?php echo JText::_( 'Data' ); ?></legend>
			
			<table class="admintable">
				<tr>
					<td class="paramlist_key"><?php echo JText::_('Database Connection to use'); ?>:</td>
					<td><?php echo $lists['connections']; ?></td>
				</tr>
				<?php if($row->id == 0){ ?>
					<tr>
						<td class="paramlist_key"><?php echo JText::_('Create new table');?>:</td>
						<td><input id="database_name" name="_database_name" size="40" /></td>
					</tr>
					<tr>
						<td colspan="2"><?php echo JText::_('OR');?></td>
					</tr>
				<?php } ?>
				
				<tr>
					<td class="paramlist_key"><?php echo JText::_('Database Table to link to'); ?>:</td>
					<td><?php echo $lists['tablename']; ?></td>
				</tr>
				<?php if($row->id <> ''){ ?>
				<tr>
					<td class="paramlist_key">
					<label for="db_primary_key">
						<?php 
						echo JHTML::_('tooltip', JText::_( "Only alter this is you're sure you know what you're doing. The default value should be correct" ), JText::_( 'Primary key' ), 'tooltip.png', JText::_( 'Primary key' ));?>
					</label>
					</td>
					<td><?php echo $lists['db_primary_key'];?></td>
				</tr>
				<tr>
					<td class="paramlist_key"><label for="auto_inc"><?php echo JText::_( 'Auto increment' ); ?></label></td>
					<td><input type="checkbox" name="auto_inc" id="auto_inc" value="1"
					<?php echo $row->auto_inc ? 'checked="checked"' : ''; ?> /></td>
				</tr>
				<?php } ?>
				<tr>
					<td class="paramlist_key"><label for="order_by"><?php echo JText::_( 'Order by' ); ?>:</label></td>
					<td id="orderByTd"><?php echo $lists['order_by']; ?></td>
				</tr>
				<tr>
					<td class="paramlist_key"><?php echo JText::_( 'Order direction' ); ?>:</td>
					<td><?php echo $lists['order_dir']; ?></td>
				</tr>
				</table>
							
		</fieldset>

		<fieldset>
			<legend><?php echo JText::_('Group by'); ?></legend>
			<table class="admintable">
				<tr>
					<td class="paramlist_key">
					<label for="group_by"><?php echo JText::_('Group by'); ?>:</label>
					</td>
					<td id="groupByTd"><?php echo $lists['group_by'];?></td>
				</tr>
			</table>
			<?php echo $form->render('params', 'grouping');?>
		</fieldset>
		
		<fieldset>
			<legend><?php echo JHTML::_('tooltip', JText::_( 'PREFILTER INFO', true ), JText::_( 'Pre-filter' ), 'tooltip.png', JText::_( 'Pre-filter' )); ?></legend>
			<a class="addButton" href="#"
					onclick="oAdminFilters.addFilterOption(); return false;"><?php echo JText::_( 'Add' ); ?></a>
				<?php echo $form->render('params', 'prefilter');?>
				<table class="adminform" width="100%">
					<tbody id="filterContainer">
					</tbody>
				</table>
		</fieldset>
		
		<fieldset>
			<legend>
				<?php echo JHTML::_('tooltip', JText::_( 'JOINDESC' ), JText::_( 'Table Joins' ), 'tooltip.png', JText::_( 'Table Joins' ));?>
			</legend>
			<?php if($row->id != 0){ ?>
				<a href="#" id="addAJoin" class="addButton"><?php echo JText::_('Add'); ?></a>
				<div id="joindtd">
				</div>
			<?php
			}else{
				echo JText::_('Available once saved');
			}
			?>
		</fieldset>
		<fieldset>
			<legend>
			<?php echo JHTML::_('tooltip', JText::_( 'Other tables that have foregn keys pointing to this table' ), JText::_( 'Related Data' ), 'tooltip.png', JText::_( 'Related Data' ));?>
			</legend>
			<?php if( empty( $lists['linkedtables'] ) ){
				echo "<i>" . JText::_( 'No other tables link here') . "</i>";
			}else{
				?>
			<table class="adminform">
				<tr>
					<td><?php echo JText::_( 'Table' );?></td>
					<td><?php echo JText::_( 'Link to table' );?></td>
					<td><?php echo JText::_( 'Label' );?></td>
					<td><?php echo JText::_( 'Popup' );?></td>
					<td><?php echo JText::_( 'Link to form' );?></td>
					<td><?php echo JText::_( 'Label' );?></td>
					<td><?php echo JText::_( 'Popup' );?></td>
				</tr>
				<?php foreach ($lists['linkedtables'] as $linkedTable) {?>
					<tr>
						<td>
						<?php echo JHTML::_('tooltip', $linkedTable[0], $linkedTable[1], 'tooltip.png', $linkedTable[1]);?>
						<td><?php echo $linkedTable[2]; ?></td>
						<td><?php echo $linkedTable[3]; ?></td>
						<td><?php echo $linkedTable[4]; ?></td>
						<td><?php echo $linkedTable[5]; ?></td>
						<td><?php echo $linkedTable[6]; ?></td>
						<td><?php echo $linkedTable[7]; ?></td>
					</tr>
			<?php }?>
		</table>
		<?php }?>
		</fieldset>
		
		<?php
		echo $pane->endPanel( );
		echo $pane->startPanel( JText::_( 'Link to menu' ), "linktomenu-page" ); ?>
		<table class="adminform">
			<tr>
				<th colspan="2"><?php echo JText::_( 'Link to menu' ); ?></th>
			</tr>
			<tr>
				<td><?php echo JText::_( 'Select Menu' ); ?></td>
				<td><?php echo $lists['menuselect']; ?></td>
			</tr>
			<tr>
				<td valign="top">
				<label for="link_name"><?php echo JText::_( 'Label' ); ?></label>
				</td>
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
				<input name="menu_link" type="button" class="button" value="<?php echo JText::_( 'Link to menu' ); ?>" onclick="submitbutton('menuLinkTable');" />
				</td>
			</tr>
			<tr>
				<th colspan="2"><?php echo JText::_( 'Menu Links' ); ?></th>
			</tr>
			<?php if ($menus == NULL) { ?>
			<tr>
				<td colspan="2"><?php echo JText::_( 'None' ); ?></td>
			</tr>
			<?php
} else {
	FabrikHelperAdminHTML::menuLinksContent($menus, 'Table');
}?>
			<tr>
				<td colspan="2"></td>
			</tr>
		</table>
		<?php
		echo $pane->endPanel();
		echo $pane->startPanel( JText::_( 'Plugins' ), "plugins-page" );?>
			<table class="adminform">
				<tr>
					<th colspan="2"><?php echo JText::_( 'Plugins' ); ?></th>
				</tr>
				<tr>
					<th colspan="2">
					<a href="#" id="addPlugin" class="addButton"><?php echo JText::_( 'Add' ); ?></a>
					</th>
				</tr>
				<tr>
					<td colspan="2" id="plugins"><br />
					</td>
				</tr>
			</table>
		<?php echo $pane->endPanel();
		echo $pane->endPane(); ?></td>
	</tr>
</table>
	<input type="hidden" name="option" value="com_fabrik" />
	<input type="hidden" name="task" value="saveTable" />
	<input type="hidden" name="c" value="table" /> 
	<input type="hidden" name="id" value="<?php echo $row->id;?>" />
	<input type="hidden" name="fabrikid" value="<?php echo $fabrikid; ?>" />
	<?php echo JHTML::_( 'form.token' ); ?>
</form>

<script language="javascript" type="text/javascript">
<?php
	$joinTypeOpts = "[['inner', '" . JText::_( 'Inner join' ) ."'], ['left', '" . JText::_( 'Left join' ) ."'], ['right', '" . JText::_( 'Right join' ) ."']]";
	
	$activetableOpts[] = "";
	$activetableOpts[] = $row->db_table_name;
	if( array_key_exists( 'joins', $lists ) ){
		for ($i = 0; $i < count($lists['joins']); $i ++) {
			$j = $lists['joins'][$i];
			$activetableOpts[] = $j->table_join;
			$activetableOpts[] = $j->join_from_table;
		}
	}
	$activetableOpts = array_unique($activetableOpts);
	
	$strActivetableOpts = '[';
	foreach($activetableOpts as $tableopt){
		$strActivetableOpts .= "'$tableopt',";
	}
	$strActivetableOpts = rtrim($strActivetableOpts, ',');
	$strActivetableOpts .= "]";
?>
window.addEvent('domready', function(){			
oAdminTable = new tableForm(
	{
		'joinOpts':<?php echo $joinTypeOpts;?>,
		'tableOpts' : <?php echo $lists['defaultJoinTables'];?>,
		'activetableOpts' : <?php echo $strActivetableOpts;?>
	},
	{
		'joinType':'<?php echo JText::_( 'Join type' ); ?>',
		'joinFromTable':'<?php echo JText::_( 'Join from' ); ?>',
		'joinToTable':'<?php echo JText::_( 'Join to' ); ?>',
		'thisTablesIdCol':'<?php echo JText::_( 'Join from column' ); ?>',
		'joinTablesIdCol':'<?php echo JText::_( 'Join to column' ); ?>',
		'del':'<?php echo JText::_( 'Delete' ); ?>'
	}
);
	oAdminTable.watchJoins();
	
	<?php
	if( array_key_exists( 'joins', $lists ) ){
		for ($i = 0; $i < count($lists['joins']); $i ++) {
			$j = $lists['joins'][$i];
			?>
			oAdminTable.addJoin(<?php echo "'" . $j->group_id . "','" . $j->id . "','" . $j->join_type . "','" . 
			$j->table_join . "','" . $j->table_key . "','" . $j->table_join_key  . "','" . 
			 $j->join_from_table . "'," .  FastJSON::encode($j->joinFormFields) . "," .
			 FastJSON::encode($j->joinToFields) ;?>);												 
	<?php }
	}?>
	oAdminFilters = new adminFilters( 'filterContainer', 
'<?php echo addslashes( str_replace(array("\n", "\r"), '', $lists['filter-fields']) );?>'
, {
'filterJoinDd':'<?php	echo $model->getFilterJoinDd( true, 'params[filter-join][]');?>',
'filterCondDd':'<?php echo $model->getFilterConditionDd( true, 'params[filter-conditions][]', 2);?>',
'filterAccess':'<?php echo addslashes( str_replace(array("\n", "\r"), '', $lists['filter-access'] ) );?>'
},
{'join':'<?php echo JText::_( 'Join' ); ?>',
'field':'<?php echo  JText::_( 'Field' ); ?>',
'condition':'<?php echo  JText::_( 'Condition' ); ?>',
'eval':'<?php echo  JText::_( 'Value' ). " (" . JText::_( 'Eval' ) . ")"; ?>',
'applyFilterTo':'<?php echo JText::_( 'Apply filter to' ); ?>',
'del':'<?php echo JText::_( 'Delete' ) ; ?>',
'yes':'<?php echo  JText::_( 'Yes' ); ?>',
'no':'<?php echo  JText::_( 'No' ); ?>',
'grouped':'<?php echo JText::_( 'Grouped' );?>'
}  );

<?php 
$afilterJoins 		= $params->get( 'filter-join','', '_default', 'array' ); 
$afilterFields 		= $params->get( 'filter-fields','', '_default', 'array' );
$afilterConditions 	= $params->get( 'filter-conditions','', '_default', 'array' );
$afilterEval 		= $params->get( 'filter-eval','', '_default', 'array' );
$afilterValues 		= $params->get( 'filter-value','', '_default', 'array' );
$afilterAccess 		= $params->get( 'filter-access','', '_default', 'array' );
$aGrouped			= $params->get( 'filter-grouped','', '_default', 'array' );
for ($i=0;$i<count($afilterFields);$i++) {
	$selJoin 	  = ( array_key_exists( $i, $afilterJoins )) ? 	$afilterJoins[$i] : "and"; 
	$selFilter 	  = $afilterFields[$i];
	$grouped 	  = $aGrouped[$i];
	$selCondition = $afilterConditions[$i];
	$filerEval	  = ( array_key_exists( $i, $afilterEval )) ? 	$afilterEval[$i] : "1"; 
	if($selCondition == '&gt;'){ $selCondition = '>';}
	if($selCondition == '&lt;'){ $selCondition = '<';}
	$selValue 	  = $afilterValues[$i];
	$selAccess 	  = $afilterAccess[$i];
	
	//alow for multiline js variables ?
	$selValue = htmlspecialchars_decode( $selValue, ENT_QUOTES );
	$selValue = FastJSON::encode($selValue);
	
	if( $selFilter != '' ){
		echo 	"oAdminFilters.addFilterOption( '$selJoin', '$selFilter', '$selCondition', $selValue, '$selAccess', '$filerEval', '$grouped' );\n";
	}
}?>
});
</script>
	<?php  }

	/**
	* Display all available tables
	* @param array array of table_rule objects
	* @param object page navigation
	* @param array lists
	*/
	
	function show( $tables, $pageNav, $lists ) {
		FabrikViewTable::setTablesToolbar();
		$user	  = &JFactory::getUser();
		?> 
		<form action="index.php" method="post" name="adminForm" id="adminForm">
		<table summary="table filter" >
			<tr>
				<td>
					<?php echo $lists['packages'];?>
				</td>
				<td><?php
				echo JText::_( 'Table' ) . ": ";
				echo $lists['filter_table'];
				?></td>
			</tr>
		</table>
		<table class="adminlist">
			<thead>
				<tr>
					<th width="2%"><?php echo JHTML::_('grid.sort',  '#', 't.id', @$lists['order_Dir'], @$lists['order'] ); ?></th>
					<th width="1%">
						<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $tables );?>);" />
					</th>
					<th width="29%">
						<?php echo JHTML::_('grid.sort',  'Table name', 'label', @$lists['order_Dir'], @$lists['order'] ); ?>
					</th>
					<th width="49%"><?php echo JText::_( 'View data' ) ;?></th>
					<th width="5%">
						<?php echo JHTML::_('grid.sort',  'Published', 'state', @$lists['order_Dir'], @$lists['order'] ); ?>
					</th>
					<th width="20%"><?php echo JText::_( 'View details' ); ?></th>
				</tr>
			</thead>
	<?php
	$k = 0;
	for ( $i = 0, $n = count( $tables ); $i < $n; $i ++ ) {
		$row = & $tables[$i];
		$checked		= JHTML::_('grid.checkedout', $row, $i );
		$link 	= JRoute::_('index.php?option=com_fabrik&c=table&task=edit&cid='. $row->id);
		$row->published = $row->state;
		$published		= JHTML::_('grid.published', $row, $i );
		?>
	<tr class="<?php echo "row$k"; ?>">
		<td width="1%"><?php echo $row->id; ?></td>
		<td width="1%"><?php echo $checked;?></td>
		<td width="29%"><?php
		if ( $row->checked_out && ( $row->checked_out != $user->get( 'id' ) )) {
			echo $row->label;
		} else {
			?> <a href="<?php echo $link;?>"><?php echo $row->label; ?></a> <?php } ?>
		</td>
		<td width="50%"><a href="#view"
			onclick="return listItemTask('cb<?php echo $i;?>','viewTable');"><?php echo JText::_( 'View data' );?></a>
		</td>
		<td width="5%">
			<?php echo $published;?>
		</td>
		<td width="20%"><a href="#showlinkedelements"
			onclick="return listItemTask('cb<?php echo $i;?>','showlinkedelements');"><?php echo JText::_( 'View details' );?></a>
		</td>
	</tr>
	<?php $k = 1 - $k;
} ?>
	<tfoot>
		<tr>
			<td colspan="6"><?php echo $pageNav->getListFooter(); ?></td>
		</tr>
	</tfoot>
</table>
	<input type="hidden" name="option" value="com_fabrik" />
	<input type="hidden" name="boxchecked" value="0" />
	<input type="hidden" name="c" value="table" />
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="filter_order" value="<?php echo $lists['order']; ?>" />
	<input type="hidden" name="filter_order_Dir" value="<?php echo $lists['order_Dir']; ?>" />
	<?php echo JHTML::_( 'form.token' ); ?>
</form>
	<?php }
	
	/** 
	 * show a summary of the table's forms, groups and elements
	 * @param object form 
	 * @param array element group objects
	 */

	function showTableDetail( &$form, &$formGroupEls ) {
		echo "<h1 class=\"sectionname\">".JText::_('Table parts') . "</h1>";
		echo "<h3>".JText::_('Form') ."</h3>";
		echo "<a href=\"index.php?option=com_fabrik&amp;c=form&amp;task=edit&amp;cid=$form->id\">".$form->label."</a><br />";
		echo "<h3>".JText::_('Elements') ."</h3>";
		echo "<table style=\"margin-bottom:50px;\" class=\"adminlist\" width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" >\n";		
		echo "<tr><th class='title'>". JText::_('Element') ."</th><th class='title'>". JText::_('Label') ."</th><th class='title'>".JText::_('Group')."</th></tr>";
		$k = 1;
		foreach ( $formGroupEls as $el ) {
			$cid = $el->id;
			echo "<tr class='sectiontableentry$k row$k'>"
			."<td><a href=\"index.php?option=com_fabrik&amp;c=element&amp;task=edit&amp;cid=$cid\">$el->name</a></td>"
			."<td>"."$el->label"."</td><td><a href='index.php?option=com_fabrik&amp;c=group&amp;task=edit&amp;cid=$el->group_id'>"."$el->group_name"."</a></td></tr>";
			$k = 1 - $k;
		}
		echo "</table>";
	}
	
	function askDeleteTableMethod()
	{
	   $cid	= JRequest::getVar( 'cid', array(), 'post', 'array' );
	  ?>
	  	<h1><?php echo Jtext::_('Delete table');?></h1>
	<form action="index.php" method="post" name="adminForm">
		<table class="adminform">
			<tr><td><label>
			<input type="radio" name="deleteMethod" value="0" checked="checked"/>
			<?php echo JText::_( 'Delete only the fabrik table' );?>
		</label></td></tr>
		<tr><td><label>
			<input type="radio" name="deleteMethod" value="1" checked="checked"/>
			<?php echo JText::_( 'Delete fabrik table, form, groups and elements' );?>
		</label>
		<?php foreach ($cid as $id) { ?>
			<input type="hidden" name="cid[]" value="<?php echo $id ;?>" /></td></tr>
		<?php } ?>
		<tr><td>
		<input type="submit" name="submit" value="<?php echo JText::_( 'Delete' );?>" />
		<input type="hidden" name="option" value="com_fabrik" />
		<input type="hidden" name="task" value="doRemove" />
		<input type="hidden" name="c" value="table" />
		</td></tr>
		</table>
		<?php echo JHTML::_( 'form.token' ); ?>
	</form>
	  <?php
	}
}
?>