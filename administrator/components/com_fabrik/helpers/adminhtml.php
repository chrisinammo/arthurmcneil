<?php

/**
* @package Joomla
* @subpackage Fabrik
* @copyright Copyright (C) 2005 Rob Clayburn. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/


// no direct access
defined('_JEXEC') or die('Restricted access');

/**
 * Content Component HTML Helper
 *
 * @static
 * @package		Joomla
 * @subpackage	Content
 * @since 1.5
 */
class FabrikHelperAdminHTML
{
						
	function menuLinksContent( &$menus, $type )
	{
		$document =& JFactory::getDocument();
		$script = "
		function go2( pressbutton, menu, id ) {
			
			var form = document.adminForm;
			if($('current_groups')){
				mergeFormGroups();
			}
			if (pressbutton == 'go2menu') {
				form.menu.value = menu;
				form.menuid.value 	= id;
				submitform( pressbutton );
				return false;
			}
	
			if (pressbutton == 'go2menuitem') {
				form.menu.value 	= menu;
				form.menuid.value 	= id;
				submitform( pressbutton );
				return false;
			}
		}
		";
		$document->addScriptDeclaration( $script );
		foreach( $menus as $menu ) {
			?>
			<tr>
				<td colspan="2">
				<hr />
				</td>
			</tr>
			<tr>
				<td width="90px" valign="top">
				Menu
				</td>
				<td>
				<a href="#" onclick="return go2( 'go2menu', '<?php echo $menu->menutype; ?>', '<?php echo $menu->id; ?>' );" title="Go to Menu">
				<?php echo $menu->menutype; ?>
				</a>
				</td>
			</tr>
			<tr>
				<td width="90px" valign="top">
				Link Name
				</td>
				<td>
				<strong>
				<a href="#" onclick="go2( 'go2menuitem', '<?php echo $menu->menutype; ?>', '<?php echo $menu->id; ?>' );" title="Go to Menu Item">
				<?php echo $menu->name; ?>
				</a>
				</strong>
				</td>
			</tr>
			<tr>
				<td width="90px" valign="top">
				State
				</td>
				<td>
				<?php
				switch ( $menu->published ) {
					case -2:
						echo '<font color="red">Trashed</font>';
						break;
					case 0:
						echo 'UnPublished';
						break;
					case 1:
					default:
						echo '<font color="green">Published</font>';
						break;
				}
				?>
				</td>
			</tr>
			<?php
		}
		?>
		<input type="hidden" name="menu" value="" />
		<input type="hidden" name="menuid" value="" />
		<?php
	}
	/*
	 * user elements/width.php param instead
	function widthField( &$row )
	{
		if( $row->id == '0' ) { 
			$row->width = '20';
		}
		?>
		<tr>
			<td class="paramlist_key" >
				<label for="width">
					<?php echo JText::_('Width');?>
				</label>
			</td>
			<td><input onblur="setAll(this.value, 'details[width]');" class="inputbox" type="text" name="width" id="width" size="3" value="<?php echo $row->width; ?>" /></td>
		</tr> 	
	<?php
	}
*/
	
	/**
	 * get a list of directories
	 * @param string path to read from
	 * @param bol return full paths or not
	 */
	
	function fabrikListDirs($path, $fullpath = false)
	{
		$arr = array();
		if (!@is_dir( $path )) {
			return $arr;
		}
		$handle = opendir( $path );
	
		while ($file = readdir($handle)) {
			$dir =  JPath::clean( $path.'/'.$file );
			$isDir = is_dir( $dir );
			if (($file != ".") && ($file != "..") && ($file != ".svn")) {
				if ($isDir) {
					if ($fullpath) {
						$arr[] = trim(  JPath::clean( $path.'/'.$file ) );
					} else {
						$arr[] = trim( $file );
					}
				}
			}
		}
		closedir($handle);
		asort($arr);
		return $arr;
	
	}
	
	/**
	 * write only once the hidden fields to store the sub element data in 
	 * @param object element table
	 */

	function subElementFields( &$element )
	{
		if (!defined( '_SUBELEMENT_FIELDS_ADDED' )){
			define( '_SUBELEMENT_FIELDS_ADDED', 1 );
			?>
			<input class="inputbox" type="hidden" name="sub_values" id="sub_values" value="<?php echo $element->sub_values ?>" />
			<input class="inputbox" type="hidden" name="sub_labels" id="sub_labels" value="<?php echo $element->sub_labels ?>" />
			<input class="inputbox" type="hidden" name="sub_intial_selection" id="sub_intial_selection" value="<?php echo $element->sub_intial_selection ?>" />
			<?php
		}
	}
	
	function templateList( $type, $default = '')
	{
		//get the table templates
    $templates = FabrikHelperAdminHTML::fabrikListDirs( COM_FABRIK_FRONTEND. DS."views".DS.$type.DS."tmpl" );
    if ( is_array( $templates ) ){
      foreach ( $templates as $file ) {
        $oTemplates[] = JHTML::_('select.option',$file);
      }
    }
   	return JHTML::_( 'select.genericlist',  $oTemplates, 'template', 'class="inputbox"', 'value', 'text', $default );
		
	}
}
?>