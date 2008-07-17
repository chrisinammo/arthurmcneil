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

class fileRender{
	
	function renderTableData( &$model, &$params, $file )
	{
		$this->render( $model, $params, $file );
	}
	
	function render(&$element, &$params, $file )
	{
		if ($file == '') {
			$this->output = '';
		} else {
			$file = str_replace("\\", "/", COM_FABRIK_LIVESITE  . '/'. $file);
			$this->output = "<a class='download-archieve' title='$file' href='$file'>" . JText::_('Download Files') . "</a>";
		}
	}
}

?>