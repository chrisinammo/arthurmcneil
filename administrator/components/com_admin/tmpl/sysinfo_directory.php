<?php
/**
 * @version		$Id: sysinfo_directory.php 9506 2007-12-08 21:00:27Z willebil $
 */
// No direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.filesystem.folder');
$cparams = JComponentHelper::getParams ('com_media');
?>
<fieldset class="adminform">
	<legend><?php echo JText::_( 'Directory Permissions' ); ?></legend>
		<table class="adminlist">
		<thead>
			<tr>
				<th width="650">
					<?php echo JText::_( 'Directory' ); ?>
				</th>
				<th>
					<?php echo JText::_( 'Status' ); ?>
				</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<td colspan="2">
					&nbsp;
				</td>
			</tr>
		</tfoot>
		<tbody>
			<?php
			writableCell( 'administrator/backups' );
			writableCell( 'administrator/components' );
			writableCell( 'administrator/language' );

			// List all admin languages
			$admin_langs = JFolder::folders(JPATH_ADMINISTRATOR.DS.'language');
			foreach ($admin_langs as $alang)
			{
				writableCell( 'administrator/language/'.$alang );
			}

			writableCell( 'administrator/modules' );
			writableCell( 'administrator/templates' );
			writableCell( 'components' );
			writableCell( 'images' );
			writableCell( 'images/banners' );
			writableCell( $cparams->get('image_path'));
			writableCell( 'language' );

			// List all site languages
			$site_langs	= JFolder::folders(JPATH_SITE.DS.'language');
			foreach ($site_langs as $slang)
			{
				writableCell( 'language/'.$slang );
			}

			writableCell( 'modules' );
			writableCell( 'plugins' );
			writableCell( 'plugins/content' );
			writableCell( 'plugins/editors' );
			writableCell( 'plugins/editors-xtd' );
			writableCell( 'plugins/search' );
			writableCell( 'plugins/system' );
			writableCell( 'plugins/user' );
			writableCell( 'plugins/xmlrpc' );
			writableCell( 'tmp' );
			writableCell( 'templates' );
			writableCell( JPATH_SITE.DS.'cache', 0, '<strong>'. JText::_( 'Cache Directory' ) .'</strong> ' );
			writableCell( JPATH_ADMINISTRATOR.DS.'cache', 0, '<strong>'. JText::_( 'Cache Directory' ) .'</strong> ' );
			?>
		</tbody>
		</table>
</fieldset>