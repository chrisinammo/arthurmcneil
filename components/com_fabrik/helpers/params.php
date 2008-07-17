<?php
/**
* @package Joomla
* @subpackage Fabrik
* @copyright Copyright (C) 2005 Rob Clayburn. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/

/* MOS Intruder Alerts */
defined('_JEXEC') or die();
/*
 * Created on 10-Nov-2005
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */


class fabrikParams extends JParameter {

	/** @var bol duplicatable param (if true add []" to end of element name)*/
	var $_duplicate = false;

	var $_splitter_1 = "//..*..//";

	var $_splitter_2 = '$$..*..$$';

	/** used by form plugins - to set id in name of radio buttons **/
	var $_counter_override = null;
	/**
	 * constructor
	 */

	function __construct($data, $path = '')
	{
		$this->_identifier = str_replace("\\", "-", str_replace(".xml", "", str_replace(JPATH_SITE, '', $path)));
		$this->_identifier = str_replace('/', '-', $this->_identifier);
		parent::__construct($data, $path);
	}

	/**
	 * when objs are saved we convert the params data into the attribs field
	 * @param array parameter settings
	 */

	function updateAttribsFromParams( $params ){
		if ( is_array( $params ) ) {
			$txt = array();
			foreach ( $params as $k => $v ) {
				$deep = 0;
				if ( is_array( $v ) ) {
					$str = '';
					foreach ( $v as $key2=>$val2 ) {
						if ( is_array( $val2 ) ) {
							foreach ( $val2 as $key3 => $val3 ) {
								$deep = 1;
								$str .= $val3 . $this->_splitter_2;
							}
							
							$str =  substr( $str, 0, - strlen( $this->_splitter_2 ) ) . $this->_splitter_1;
						} else {
							$str .= "$val2" . $this->_splitter_1;
						}
					}
					$v =  substr($str, 0, - strlen($this->_splitter_1));
				}
				if ($deep) {
					//$v = $this->_splitter_1 . $v . $this->_splitter_1;
					$v =  $v . $this->_splitter_1;
				}
				$v = str_replace( "\n", "", $v );
				if (get_magic_quotes_gpc()) {
					$v = stripslashes( $v );
				}
				$txt[] = "$k=$v";
			}
			$this->attribs = implode( "\n", $txt );
		}
		return $this->attribs;
	}


	/**
	 * Get the names of all the parameters in the object
	 * @access private
	 * @return array parameter names
	 */

	function _getParamNames(){
		$p = array();
		$default = $this->_xml['_default'];
		foreach ($default->children() as $node)  {
			$p[] = $node->attributes('name');
		}
		return $p;
	}

	/**
	 * overwrite core get function so we can decode our encoded ","'s
	 * @param string key
	 * @param string default
	 * @param string group
	 * @param string output format (string or array)
	 * @return mixed - string or array
	 */

	function get( $key, $default='', $group = '_default', $outputFormat = 'string', $counter = null )
	{

		$group = isset($this->_fb_group) ? $this->_fb_group : '_default' ;
		$value = $this->getValue( $group.'.'.$key );
		$result = (empty($value) && ($value !== 0) && ($value !== '0')) ? $default : $value;
		if ($outputFormat == 'array' && is_array( $result ) && empty( $result )) {
			return array('');//test to ensure new calendar repeat params are rendered
		}

		if (strstr( $result, $this->_splitter_1 )) {
			$aReturn = array();
			$bothsplitters =  strstr( $result, $this->_splitter_1 ) && strstr( $result, $this->_splitter_2 ); 
			$result = explode($this->_splitter_1, $result);
		
			//	if in "|..*..|17|//*//|167|..*..|" format (e.g. chart_elements)
			//then remove first and last record from array
			if ( $bothsplitters && $result[0] == '') {
				unset($result[0]);
			}
			if (@$result[count($result)-1] == '') {
				unset($result[count($result)-1]);
			}
			
			foreach ($result as $res) {
				if(strstr($res, $this->_splitter_2)){
					$aReturn[] = explode($this->_splitter_2, $res);
				} else {
					$aReturn[] = $res;
				}
			}

			return $aReturn;
		} else {
			if ($outputFormat == 'array') {
				if ($result == '') {
					return array();
				} else {
					return array($result);
				}
			}
			return $result;
		}

		///////////////////////////////////

		$value = $this->getValue($group.'.'.$key);
		$result = (empty($value) && ($value !== 0) && ($value !== '0')) ? $default : $value;
		return $result;
	}

	function getParams($name = 'params', $group = '_default', $ouputformat = 'string', $counter = null)
	{
		if (!isset($this->_xml[$group])) {
			return false;
		}
			
		$results = array();
		foreach ($this->_xml[$group]->children() as $param)  {
			$results[] = $this->getParam($param, $name, $group, $ouputformat, $counter);
		}
		return $results;
	}

	/**
	 * Render a parameter type
	 *
	 * @param	object A param tag node
	 * @param	string The control name
	 * @return	array Any array of the label, the form element and the tooltip
	 * @since	1.5
	 */

	function getParam(&$node, $control_name = 'params', $group = '_default', $outPutFormat ='string', $counter = null)
	{
		//get the type of the parameter
		$type = $node->attributes('type');

		//remove any occurance of a mos_ prefix
		$type = str_replace('mos_', '', $type);

		$element =& $this->loadElement($type);

		// error happened
		if ($element === false)
		{
			$result = array();
			$result[0] = $node->attributes('name');
			$result[1] = JText::_('Element not defined for type').' = '.$type;
			$result[5] = $result[0];
			return $result;
		}

		//get value
		

		
		if ($outPutFormat == 'array' && !is_null( $counter )) {
			$nodeName = str_replace("[]", "",$node->attributes('name'));
		} else {
			$nodeName = $node->attributes('name');
		}
		//end test

		$value = $this->get($nodeName, $node->attributes('default'), $group, $outPutFormat, $counter);
		
		if ($outPutFormat == 'array' && !is_null( $counter )) {
			if (array_key_exists( $counter, $value )) {
				$value = $value[$counter];
			} else {
				$value = '';
			}
		}
		//value must be a string  
		$element->_array_counter = $counter;
		$result = $element->render($node, $value, $control_name);
		
		$reqParamName = $result[5];
		if( $this->_duplicate ){ //_duplicate property set in view pages			
			if ($type == 'radio') {
				//otherwise only a single entry is recorded no matter how many duplicates we make
				if($counter == 0 && isset($this->_counter_override)){
					$counter = $this->_counter_override;
				}
				$replacewith = "[$reqParamName][$counter][]";
			} else {
				$replacewith = "[$reqParamName][]";
			}
			$result[1] = str_replace( "[$reqParamName]", $replacewith, $result[1]);
		}
		return $result;
	}

	/**
	 *DEPRECIATED - PUT PARAMS IN GROUPS AND RENDER THE GROUP INSTEAD!
	 * @param string param name to render
	 * @param string $name = params
	 * @param counter - if param is array type then we need to use the correct val in array
	 * @param string group default = '_default'
	 */

	function renderSingleParam( $reqParamName, $name='params', $counter = null, $group = '_default') {
		$html = array();
		foreach ($this->_xml['_default']->children() as $node )  {
			if ($node->_attributes['name'] == $reqParamName ) {
				$outPutFormat = (is_null($counter)) ? 'string' : 'array';
				$result = $this->getParam( $node, $name, $group, $outPutFormat, $counter );
				
				$html[] = '<tr>';
				$html[] = '<td width="40%" class="paramlist_key"><span class="editlinktip">' . $result[0] . '</span></td>';
				$el = $result[1];
				if( $this->_duplicate ){
					$el = str_replace( "[$reqParamName]", "[$reqParamName][]", $el);
				}
				//commented out as this replaces double quotes in field vals with \" which in tern means they are not shown in the field 
				//$el = stripslashes(htmlspecialchars_decode( $el, ENT_QUOTES ));
				$el =  stripslashes( $el );
				$html[] = '<td class="paramlist_value">' .$el . '</td>';
				$html[] = '</tr>';
				return implode( "\n", $html );
			}
		}
	}


	function _loadXMLEl()
	{
		require_once( JPATH_SITE . '/includes/domit/xml_domit_lite_include.php' );
		$xmlDoc = new DOMIT_Lite_Document();
		$xmlDoc->resolveErrors( true );
		if ($xmlDoc->loadXML( $this->_path, false, true )) {
			$root =& $xmlDoc->documentElement;
			$tagName = $root->getTagName();
			$isParamsFile = ($tagName == 'mosinstall' || $tagName == 'mosparams');
			if ($isParamsFile && $root->getAttribute( 'type' ) == $this->_type) {
				if ($params = &$root->getElementsByPath( 'params', 1 )) {
					$this->_xmlElem =& $params;
				}
			}
		}
	}

	/**
	 * @param string The name of the form element
	 * @param string The value of the element
	 * @param object The xml element for the parameter
	 * @param string The control name
	 * @return string The html for the element
	 */

	function _form_folderlist( $name, $value, &$node, $control_name ) {

		$path 	= JPATH_SITE . '/' . $node->getAttribute( 'directory' );
		$filter = $node->getAttribute( 'filter' );
		$options = fabrikParams::_getRecursiveFolders($path, $filter);
		/* path to images directory */
		if ( !$node->getAttribute( 'hide_none' ) ) {
			array_unshift( $options, JHTML::_('select.option', '-1', '- '. 'Do not use a folder' .' -' ) );
		}
		if ( !$node->getAttribute( 'hide_default' ) ) {
			array_unshift( $options, JHTML::_('select.option', '', '- '. 'Use Default folder' .' -' ) );
		}
		return JHTML::_('select.genericlist',  $options, ''. $control_name .'['. $name .']', 'class="inputbox"', 'value', 'text', $value, "param$name" );
	}

	/**
	 * internal function get recucrsive folder list
	 * @param string path
	 * @param string filter text
	 * @param array options to go into folder list
	 */

	function _getRecursiveFolders($path, $filter, $options = array()){

		$files 	= JFolder::files( $path, $filter );
		foreach ($files as $file) {
			$i_f 	= $path .'/'. $file;
			if(is_dir($i_f)){
				$displayFolder = str_replace(JPATH_SITE . '//', '', $i_f);
				$displayFolder = str_replace(JPATH_SITE . '/', '', $displayFolder);
				$displayFolder = str_replace(JPATH_SITE, '', $displayFolder);
				$options[] = JHTML::_('select.option', $displayFolder, $displayFolder );
				$options = fabrikParams::_getRecursiveFolders( $i_f, $filter, $options );
			}
		}
		return $options;
	}

	/**
	 * Render
	 *
	 * @access	public
	 * @param	string	The name of the control, or the default text area if a setup file is not found
	 * @param string group
	 * @param bol write out or return
	 * @param int if set and group is repeat only return int row from rendered params
	 * used for form plugin admin pages.
	 * @return	string	HTML
	 * @since	1.5
	 */
	function render($name = 'params', $group = '_default', $write = true, $repeatSingleVal = null)
	{
		$return = '';
		$this->_group = $group;
		//$$$rob experimental again
		//problem - when rendering plugin params - e.g. calendar vis - params like the table drop down
		// are repeated n times. I think the best way to deal with this is to get the data recorded for
		// the viz and udpate this objects _xml array duplicate the relavent JSimpleXMLElement Objects
		// for the required number of table drop downs
		//echo " $name : $group <br>";
		
		$repeat = false;
		$repeatControls = true;
		if (is_array( $this->_xml )) {
			if (array_key_exists( $group, $this->_xml )) {
				$repeat = $this->_xml[$group]->attributes( 'repeat' ) ;
				$repeatControls = $this->_xml[$group]->attributes( 'repeatcontrols' ) ;
			}
		}
	
		if ($repeat) {
			//get the name of the first element in the group
			$children = $this->_xml[$group]->children();
			$firstElName = str_replace("[]", "", $children[0]->attributes('name'));
			
			$allParamData = $this->_registry['_default']['data'];
			
			$value = $this->get( $firstElName, array(), $group, 'array' );
			
			//add in the 'add' button to duplicate the group
			//only show for first added group
			if ($repeatControls && $repeatSingleVal == 0) {
				$return .= "<a href='#' class='addButton' id='addgroup-$this->_identifier'>" . JText::_('Add') . "</a>";
			}
			$c = 0;
			
			//limit the number of groups of repeated params written out
			if (!is_null( $repeatSingleVal )) {
				$total = $repeatSingleVal + 1;
				$start = $repeatSingleVal;
			} else {
				$total = count( $value );
				$start = 0;
			}
			for ($x=$start; $x<$total; $x++) {
				//call render for the number of time the group is repeated
				//echo parent::render($name, $group);
				$return .= "<div class='repeat-$this->_identifier'>";
				////new
				$params =& $this->getParams( $name, $group, 'array', $x );
				$html = array ();
				$html[] = '<table width="100%" class="paramlist admintable" cellspacing="1">';
		
				if ($description = $this->_xml[$group]->attributes( 'description' )) {
					// add the params description to the display
					$desc	= JText::_($description);
					$html[]	= '<tr><td class="paramlist_description" colspan="2">'.$desc.'</td></tr>';
				}
				foreach ($params as $param)
				{
					$html[] = '<tr>';
					//	test
					$el =& $param[1];
			
				//end test
					if ($param[0]) {
						$html[] = '<td width="40%" class="paramlist_key"><span class="editlinktip">'.$param[0].'</span></td>';
						$html[] = '<td class="paramlist_value">'.$param[1].'</td>';
					} else {
						$html[] = '<td class="paramlist_value" colspan="2">'.$param[1].'</td>';
					}
		
					$html[] = '</tr>';
				}
		
				if (count($params) < 1) {
					$html[] = "<tr><td colspan=\"2\"><i>".JText::_('There are no Parameters for this item')."</i></td></tr>";
				}
		
				$html[] = '</table>';
		// $x!=0 &&
			if ( $repeatControls) {
						$html[]= "<a href='#' class='removeButton paramsRemoveButton' id='delete-$this->_identifier'>[-]</a>";
				}
				$return .= implode("\n", $html);
	
				///end new
				$c ++;
				$return .= "</div>";
			}
		
			//if ($c != 0 && $repeatControls) {
			//	$return .= "<a href='#' class='removeButton' id='delete-$this->_identifier'>[-]</a>";
			//}
		} else {
			$return .= parent::render( $name, $group );
		}
		
		if ($repeat && $repeatControls && ($repeatSingleVal == null || $repeatSingleVal == 0)) {
			// watch add and remove buttons
			$document =& JFactory::getDocument();
			$script = "window.addEvent('domready', function(){
		$('addgroup-$this->_identifier').addEvent('click', function(e){
			var div = $$('.repeat-$this->_identifier').pop();
			div.clone().injectAfter(div);
			new Event(e).stop();
			watchDeleteParamsGroup()
		});
		watchDeleteParamsGroup();
		function watchDeleteParamsGroup(){
			if($('delete-$this->_identifier')){
			//$('delete-$this->_identifier')	
			$$('.paramsRemoveButton').removeEvents();
			$$('.paramsRemoveButton').addEvent('click', function(e){
				var divs = $$('.repeat-$this->_identifier');
				if(divs.length > 1){
					var div = divs.pop();	
					div.remove();
				}
				new Event(e).stop();
				});
			}
		}
	});";
			$document->addScriptDeclaration( $script );
		}
		if ($write) {
			echo $return;
		} else {
			return $return;
		}
	}
}
?>