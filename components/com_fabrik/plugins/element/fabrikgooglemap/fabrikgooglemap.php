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


class FabrikModelFabrikGooglemap  extends FabrikModelElement {

	var $_pluginName = 'googlemap';

	/**
	 * Constructor
	 */

	function __construct()
	{
		parent::__construct();
	}


	/**
	 * shows the data formatted for the table view
	 * @param string data
	 * @param object all the data in the tables current row
	 * @return string formatted value
	 */

	function renderTableData( $data, $oAllRowsData )
	{
		$str = '';
		$params =& $this->getParams();
		if (strstr( $data, $this->_groupSplitter )) {
			foreach ($data as $d) {
				$str .= $this->_microformat($d);
			}
		} else {
			$str .= $this->_microformat($data);
		}
		return $str;
	}
	
	/**
	 * format the data as a microformat
	 *
	 * @param string $data
	 * @return unknown
	 */
	function _microformat( $data )
	{
		$o = $this->_strToCoords($data, 0);
		if($data != ''){
			$data = "<div class=\"geo\">
 <span class=\"latitude\">{$o->coords[0]}</span>, 
 <span class=\"longitude\">{$o->coords[1]}</span>
</div>
			";
		}
		return $data;
	}

	/**
	 * formats the posted data for insertion into the database
	 * @param mixed thie elements posted form data
	 * @param array posted form data
	 */

	function storeDatabaseFormat( $val, $data )
	{
		if (is_array( $val )) {
			$val = implode( $this->_groupSplitter, $val );
		}
		return $val;
	}

	/**
	 * load the javascript class that manages interaction with the form element
	 * should only be called once
	 * @return string javascript class file
	 */

	function formJavascriptClass()
	{
		$document =& JFactory::getDocument();
		$params = $this->getParams();
		$src = "http://maps.google.com/maps?file=api&amp;v=2&amp;key=" . $params->get( 'fb_gm_key' );
		$document->addScript( $src );
		FabrikHelperHTML::script( 'fabrikgooglemap.js', 'components/com_fabrik/plugins/element/fabrikgooglemap/', true );
	}

	/**
	 * return the javascript to create an instance of the class defined in formJavascriptClass
	 * @return string javascript to create instance. Instance name must be 'el'
	 */

	function elementJavascript( )
	{
		$params =& $this->getParams();
		$id = $this->getHTMLId( );
		$element =& $this->getElement();
		$v = $element->default;
		$zoomlevel = $params->get( 'fb_gm_zoomlevel' );
		$o = $this->_strToCoords($v, $zoomlevel);
		$opts =& $this->getElementJSOptions();
		
		$opts->lat = $o->coords[0];
		$opts->lon = $o->coords[1];
		$opts->zoomlevel = $o->zoomlevel;
		$opts->control = $params->get( 'fb_gm_mapcontrol' );
		$opts->scalecontrol = $params->get( 'fb_gm_scalecontrol' );
		$opts->maptypecontrol = $params->get( 'fb_gm_maptypecontrol' );
		$opts->overviewcontrol = $params->get( 'fb_gm_overviewcontrol' );
		$opts->drag = ($this->_form->_editable) ? true:false;
		$opts = FastJSON::encode($opts);
		
		return "new fbGoogleMap('$id', $opts)" ;
	}
	
	/**
	 * util function to turn the saved string into coordinate array
	 *@param string coordinates
	 * @param int default zoom level
	 * @return object coords array and zoomlevel int
	 */
	
	function _strToCoords( $v, $zoomlevel = 0)
	{
		$o = new stdClass();
		$o->coords = array('','');
		$o->zoomlevel = (int) $zoomlevel;
		if (strstr( $v, "," )) {
			$ar = explode( ":", $v );
			$o->zoomlevel = count($ar) == 2 ? array_pop( $ar ) : 4;
			$v = FabrikString::ltrimword( $ar[0], "(" );
			$v = rtrim( $v, ")" );
			$o->coords = explode( ",", $v );
		} else {
			$o->coords = array( 0,0 );
		}
		return $o;
	}

	/**
	 * draws the form element
	 * @param int repeat group counter
	 * @return string returns element html
	 */

	function render( $data, $repeatCounter = 0 )
	{
		require_once( COM_FABRIK_FRONTEND.DS.'helpers'.DS.'string.php' );
		$elementHTMLName = $this->getHTMLName();
		$groupModel = $this->_group;
		$element = $this->getElement();
		$params 	= $this->getParams();
		$val = (array_key_exists( $elementHTMLName, $data )) ? $data[$elementHTMLName] : '';
		
		if ($element->hidden == '1') {
			return $this->getHiddenField( $elementHTMLName, $data[$elementHTMLName], $this->_elementHTMLId );
		}
		
		$str = "<div id=\"" . $this->_elementHTMLId . "_map\" style=\"width: " . $params->get('fb_gm_mapwidth') . "px; height: ". $params->get('fb_gm_mapheight') . "px\"></div>";
		$str .= "<input type='hidden' name='$elementHTMLName' id='" . $this->getHTMLId() . "' value='$val'/>";

		if (!$this->_editable) {
			$str .= $data = $this->_microformat($val);
		}
		return $str;
	}

/**
 * get field description
 * @return string field description
 */

	function getFieldDescription()
	{
		return "VARCHAR (255)";
	}

	/**
	 * render admin settings 
	 */

	function renderAdminSettings( )
	{
		$pluginParams =& $this->getPluginParams();
		?>
		<div id="page-<?php echo $this->_name;?>" class="elementSettings" style="display:none">
		<?php
		echo $pluginParams->render();
		?>
		</div>
		<?php
	}
	
	/**
	 * can be overwritten in the plugin class - see database join element for example
	 * @param array 
	 * @param array
	 * @param string table name
	 */

	function getAsField_html( &$aFields, &$aAsFields, $dbtable )
	{
		$tableModel =& $this->_table;
		$table 		=& $tableModel->getTable();
		$fullElName = "$dbtable" . "___" . $this->_element->name;
		$str 				= "`$dbtable`.". "`".$this->_element->name."` AS `$fullElName`" ;
		if ($table->db_primary_key == $fullElName) {
			array_unshift( $aFields, $fullElName );
			array_unshift( $aAsFields, $fullElName );
		} else {
			$aFields[] 	= $str;
			$aAsFields[] =  $fullElName;
			$aFields[]				= "`$dbtable`.`{$this->_element->name}` AS `$fullElName" . "_raw`" ;
			$aAsFields[]			= "`$fullElName". "_raw`";
		}
	}

}
?>