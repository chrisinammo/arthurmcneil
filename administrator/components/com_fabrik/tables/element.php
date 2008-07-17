<?php
/**
* @package Joomla
* @subpackage Fabrik
* @copyright Copyright (C) 2005 Rob Clayburn. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/


// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

/**
 * @package		Joomla
 * @subpackage	Fabrik
 */
class TableElement extends JTable
{
	/** @var int Primary key */
	var $id = null;

	/** @var string The label used in the form*/
	var $label = null;

	/** @var string The classname that defines the element type*/
	var $plugin = 'fabrikfield';

	/** @var int The group id that the element belongs to */
	var $group_id = null;

	/** @var string The element name*/
	var $name = null;

	/** var string created by date */
	var $created = null;

	/** @var int creator id */
	var $created_by = null;

	/** @var string name of creator */
	var $created_by_alias = null;

	/** @var last date modified */
	var $modified = null;

	/** @var int last user to modifiy the element */
	var $modified_by = null;

	/** @var bol is the element checked out or not */
	var $checked_out = null;

	/** @var datetime time element was checked out at */
	var $checked_out_time = null;

	/** @var int width for text box area */
	var $width = null;

	/** @var int text box height */
	var $height = null;

	/** @var string default value */
	var $default  = null;

	/** @var bol is the element visible */
	var $hidden = 0;
	
	/** @var bol is the default value evalued by php */
	var $eval = 0;

	/** @var int order of element */
	var $ordering = null;

	/** @var bol show the element in the table summary */
	var $show_in_table_summary = 0;
	
	/** @var bol alllows people to order by this column in table view*/
	var $can_order = 0;
	
	/** @var string filter type dropdown or field*/
	var $filter_type = null;
	
	/** @var bol filter search string exact (true) or partial (false) match will return record*/
	var $filter_exact_match = 0;
	
	/** @var bol published state of element*/
	var $state = 0;
    
	/** @var bol states if the element acts as a link though to the row's detail page*/
	 var $link_to_detail = 0;
     
	/** @var bol is this element a primary key for the table */
	var $primary_key = 0;
	
	/** @var bol if primary key then is it an autoincrementing number */
	  var $auto_increment = 0;
	  
	/** @var bol sets if this elements data is added to the page title */
	var $use_in_page_title = 0;
	
	/** @var int access to element */
	var $access = 0;
	
	/** @var string pipe separated list of sub element values */
	var $sub_values = null;

	/** @var string pipe separated list of sub element labels */
	var $sub_labels = null;
	
	/** @var string pipe separeated list of default selected subelements*/
	var $sub_intial_selection = null;
	
	/** @var int if created by a table join this references the original element if found */
	var $parent_id = null;
	
	/** @var string xml element attributes */
	var $attribs = null;

 	/*
 	 * 
 	 */

	function __construct( &$_db )
	{
		parent::__construct( '#__fabrik_elements', 'id', $_db );
	}

}
?>
