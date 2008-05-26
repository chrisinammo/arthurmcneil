<?PHP
/**
 * patTemplate StripWhitespace output filter
 *
 * $Id: StripWhitespace.php 8287 2007-08-01 08:38:59Z eddieajau $
 *
 * Will remove all whitespace and replace it with a single space.
 *
 * @package		patTemplate
 * @subpackage	Filters
 * @author		Stephan Schmidt <schst@php.net>
 */

// Check to ensure this file is within the rest of the framework
defined('JPATH_BASE') or die();

/**
 * patTemplate StripWhitespace output filter
 *
 * $Id: StripWhitespace.php 8287 2007-08-01 08:38:59Z eddieajau $
 *
 * Will remove all whitespace and replace it with a single space.
 *
 * @package		patTemplate
 * @subpackage	Filters
 * @author		Stephan Schmidt <schst@php.net>
 */
class patTemplate_OutputFilter_StripWhitespace extends patTemplate_OutputFilter
{
	/**
	* filter name
	*
	* @access	protected
	* @abstract
	* @var	string
	*/
	var	$_name	=	'StripWhitespace';

	/**
	* remove all whitespace from the output
	*
	* @access	public
	* @param	string		data
	* @return	string		data without whitespace
	*/
	function apply( $data )
	{
		$data = str_replace( "\n", ' ', $data );
		$data = preg_replace( '/\s\s+/', ' ', $data );

		return $data;
	}
}
?>
