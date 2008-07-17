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

class flashRender{
	
	function renderTableData( &$model, &$params, $file )
	{
		$this->render( $model, $params, $file );
	}
	
	function render(&$element, &$params, $file )
	{
		if ($file == '') {
			$this->output = '';
		} else {
			$w = $params->get( 'fu_main_max_width' );
			$h = $params->get( 'fu_main_max_height' );
			$file = str_replace("\\", "/", COM_FABRIK_LIVESITE  . '/'. $file);
			$this->output = "<object width=\"$w\" height=\"$h\">
			<param name=\"movie\" value=\"$file\">
			<embed src=\"$file\" width=\"$w\" height=\"$h\">
			</embed>
			</object>";
		}
	}
}
?>