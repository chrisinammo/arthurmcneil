<?php
/**
* @package Joomla
* @subpackage Fabrik
* @copyright Copyright (C) 2005 Rob Clayburn. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/


// Check to ensure this file is within the rest of the framework
defined('JPATH_BASE') or die();

/**
 * Renders a upload size field
 *
 * @package 	Joomla.Framework
 * @subpackage		Parameter
 * @since		1.5
 */

class JElementUploadsize extends JElement
{
	/**
	* Element name
	*
	* @access	protected
	* @var		string
	*/
	var	$_name = 'Uploadsize';

	
	function fetchElement($name, $value, &$node, $control_name)
	{
		$id = $control_name.$name ;
		$size = ( $node->attributes('size') ? 'size="'.$node->attributes('size').'"' : '' );
		$class = ( $node->attributes('class') ? 'class="'.$node->attributes('class').'"' : 'class="text_area"' );
    $value = htmlspecialchars(html_entity_decode($value, ENT_QUOTES), ENT_QUOTES);
    if ($value == '') {
			$value 	= str_replace("M", "", ini_get('post_max_size')) * 1000;
			$uploadkb = str_replace("M", "", ini_get('upload_max_filesize')) * 1000;
			if ($uploadkb < $value) {
				$value = $uploadkb;
			}
    }
    $fullname = $control_name.'['.$name.']';
		return '<input type="text" name="'.$fullname.'" id="'.$id.'" value="'.$value.'" '.$class.' '.$size.' />';
	}
	
	function fetchTooltip($label, $description, &$xmlElement, $control_name='', $name='')
	{
		$output = '<label id="'.$control_name.$name.'-lbl" for="'.$control_name.$name.'"';
		if ($description) {
			$description = JText::_($description). $this->getMax();
			$output .= ' class="hasTip" title="'.JText::_($label).'::'.$description.'">';
		} else {
			$output .= '>';
		}
		$output .= JText::_( $label ).'</label>';

		return $output;
	}
	
	/**
	 * get the max upload size allowed by the server.
	 * @return int kilobyte upload size
	 */
	
	function getMax()
	{
		$postkb 	= str_replace("M", "", ini_get('post_max_size')) * 1000;
		$uploadkb = str_replace("M", "", ini_get('upload_max_filesize')) * 1000;
		if ($uploadkb < $postkb) {
			$postkb = $uploadkb;
		}
		return $postkb . " Kb";
	}
}