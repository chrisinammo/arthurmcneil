<?PHP
/**
 * Base class for patTemplate variable modifiers
 *
 * $Id: Modifier.php 8287 2007-08-01 08:38:59Z eddieajau $
 *
 * A modifier is used to modify a variable when it's parsed
 * into the template.
 *
 * @package		patTemplate
 * @subpackage	Modifiers
 * @author		Stephan Schmidt <schst@php.net>
 */

// Check to ensure this file is within the rest of the framework
defined('JPATH_BASE') or die();

/**
 * Base class for patTemplate variable modifiers
 *
 * $Id: Modifier.php 8287 2007-08-01 08:38:59Z eddieajau $
 *
 * A modifier is used to modify a variable when it's parsed
 * into the template.
 *
 * @abstract
 * @package		patTemplate
 * @subpackage	Modifiers
 * @author		Stephan Schmidt <schst@php.net>
 */
class patTemplate_Modifier extends patTemplate_Module
{
	/**
	* modify the value
	*
	* @access	public
	* @param	string		value
	* @return	string		modified value
	*/
	function modify( $value, $params = array() )
	{
		return $value;
	}
}
?>
