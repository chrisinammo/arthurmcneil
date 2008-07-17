<?php
/**
* Plugin element to render fields
* @package fabrikar
* @author Rob Clayburn
* @copyright (C) Rob Clayburn
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();



class videoRender
{
	function renderTableData( &$model, &$params, $file )
	{
		$this->render( $model, $params, $file );
	}
	
	function render( &$model, &$params, $file )
	{
		if ($file == '') {
			$this->output = '';
		} else {
			$src = str_replace("\\", "/", COM_FABRIK_LIVESITE  . '/'. $file);
			ini_set('display_errors', true);
			require_once( COM_FABRIK_FRONTEND.DS.'libs'.DS.'getid3'.DS.'getid3'.DS.'getid3.php' );
			require_once( COM_FABRIK_FRONTEND.DS.'libs'.DS.'getid3'.DS.'getid3'.DS.'getid3.lib.php' );
			
			getid3_lib::IncludeDependency(COM_FABRIK_FRONTEND.DS.'libs'.DS.'getid3'.DS.'getid3'.DS.'extension.cache.mysql.php', __FILE__, true);
			$config =& JFactory::getConfig();
			$host =  $config->getValue('host');
			$database = $config->getValue('db');
			$username = $config->getValue('user');
			$password = $config->getValue('password');
			$getID3 = new getID3_cached_mysql($host, $database, $username, $password);
			// Analyze file and store returned data in $ThisFileInfo
			$relPath = JPATH_SITE . "$file";
			$thisFileInfo = $getID3->analyze($relPath);

			if (array_key_exists('video', $thisFileInfo)) {
				$w = $thisFileInfo['video']['resolution_x'];
				$h = $thisFileInfo['video']['resolution_y'];
				switch($thisFileInfo['fileformat']){
					//add in space for controller
					case 'quicktime':
						$h += 16;
						break;
					default:
						$h += 64;
				}
			}
			$file = str_replace("\\", "/", COM_FABRIK_LIVESITE  . '/'. $file);
			$this->output = "<object width=\"$w\" height=\"$h\"
			classid=\"clsid:02BF25D5-8C17-4B23-BC80-D3488ABDDC6B\"
			codebase=\"http://www.apple.com/qtactivex/qtplugin.cab\">
			<param name=\"src\" value=\"$src\">
			<param name=\"autoplay\" value=\"false\">
			<param name=\"controller\" value=\"true\">
			<embed src=\"$src\" width=\"$w\" height=\"$h\"
			autoplay=\"false\" controller=\"true\"
			pluginspage=\"http://www.apple.com/quicktime/download/\">
			</embed>
			
			</object>";
		}
	}
}

?>