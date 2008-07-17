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

class imageRender{
	
	function renderTableData( &$model, &$params, $file )
	{
		$this->render( $model, $params, $file );
	}
	
	function render( &$model, &$params, $file )
	{
		$element =& $model->getElement();
		
		if ($file == '') {
			$this->output = '';
		} else {
			$file = str_replace("\\", "/", COM_FABRIK_LIVESITE  . '/'. $file);
			$fullSize = $file;
			if ($params->get( 'make_thumbnail' )  == '1') {
				$file = $model->_getThumb( $file );
			}
			$this->output =	"<a href='$fullSize' rel='lightbox[]'><img title='$file' src='$file' alt='$element->label' /></a>";
		}
	}
}

?>