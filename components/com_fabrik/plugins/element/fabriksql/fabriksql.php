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


class FabrikModelFabrikSQL  extends FabrikModelElement {

	var $_pluginName = 'sql';
	
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
		$thisRow = JArrayHelper::fromObject( $thisRow );
		return $this->_runSQL( $thisRow );
		//return $data;
	}	
	
	/**
	 * draws the form element
	 * @param array data
	 * @param int repeat group counter
	 * @return string returns element html
	 */
		
	function render( $data, $repeatCounter = 0 )
	{
		$elementHTMLName = $this->getHTMLName();
		foreach($data as $key=>$val){
			$data[$key . "_raw"] = $val;
			$key = array_pop(explode("___", $key));
			$data[$key] = $val;
		}
		$res = $this->_runSQL( $data );
		return $res . "<input type='hidden' class='fabrikinput' name=\"$elementHTMLName\" value=\"$res\" id=\"" . $this->getHTMLId() . "\" />\n";
	}
	
	/**
	 * @access private
	 * run sql query
	 * @param array data
	 * @return string result of query
	 */

	function _runSQL( $data )
	{
		$user  = &JFactory::getUser();
		$params = $this->_params;
		$sql = $params->get('sql');
		$w = new FabrikWorker(); 
		$sql = $w->parseMessageForPlaceHolder( $sql, $data );
		$sql 	= str_replace(array("\n", "\r", "\n\r", "\r\n", "<br>", "<br/>",  "<br />") , "", $sql );
		$db->setQuery( $sql );
		$res = $db->loadResult();
		echo $db->getErrorMsg();
		return $res;
	}

	/**
	 * defines the type of database table field that is created to store the element's data
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
			<?php echo $pluginParams->render( );?>
		</div><?php
	}
}	
?>