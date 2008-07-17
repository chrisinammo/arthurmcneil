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


class FabrikModelFabrikCalculation extends FabrikModelElement {

	var $_pluginName = 'calculation';
	
	/**
	* Constructor
	*/

	function __construct()
	{
		parent::__construct();
	}
	
	/**
	 * formats the posted data for insertion into the database
	 * @param mixed thie elements posted form data  
	 * @param array posted form data
	 */
	
	function storeDatabaseFormat( $val, $data )
	{
		$params =& $this->getParams();
		$cal =  $params->get('calculation', '');
		foreach ( $_POST as $key=>$val) { //need to use post to get full element names
			//@TODO: this will not allow for the use of some elements types in calcs
			if (is_string( $val)) {
				$cal = str_replace("{" . $key . "}", $val, $cal);
				$key = str_replace('.', '___', $key);
				$cal = str_replace("{" . $key . "}", $val, $cal);
			}
		}
		//tidy up any mssing results
		preg_match( "/{(.*)}/", $cal, $matches );
		$res = @eval( $cal );
		return $res;
	}
	
		/**
	 * shows the data formatted for the table view
	 * @param string data
	 * @param object  current row's data
	 * @return string formatted value
	 */

	function renderTableData( $data, $thisRow )
	{
		$params =& $this->getParams();
		$element =& $this->getElement();
		$cal =  $params->get( 'calculation', '' );
		foreach ( $thisRow as $key=>$val ) {
			$cal = str_replace( "{" . $key . "}", $val, $cal );
			$key = str_replace( '.', '___', $key );
			$cal = str_replace( "{" . $key . "}", $val, $cal );
		}
		//tidy up any mssing results
		preg_match( "/{(.*)}/", $cal, $matches );
		$res = @eval( $cal );
		
		//reinsert calcs back into database
		$tables = $this->myTables( 'db_table_name' );
		foreach ($tables as $tableModel) {
 			$table =& $tableModel->getTable();
 			$k = str_replace( '`', '', $table->db_primary_key );
			$k = str_replace( ".", "___", $k );
			$sql = "UPDATE $table->db_table_name SET $element->name = '$res' WHERE $table->db_primary_key = '" .$thisRow->$k ."' ";
			$db =& $tableModel->getDb();
			$db->setQuery( $sql );
			if (!$db->query( )) {
				echo $db->getErrorMsg();
			}
		}
		return parent::renderTableData( $res, $oAllRowsData );
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
		$value = '';
		if (array_key_exists( $elementHTMLName, $data )) {
			$value = $data[$elementHTMLName];
		}
		$str = "<input class=\"inputbox\" type=\"hidden\" name=\"$elementHTMLName\"  id=\"" . $this->getHTMLId() . "\" value=\"$value\" />\n";
		return $str;
	}
	
	/**
	 * get the element's label
	 *
	 * @return string label
	 */
	
	function getLabel( )
	{
		return '';
	}
	
	function getFieldDescription()
	{
		return "TEXT";
	}
	
	/**
	 * render admin settings
	 */

	function renderAdminSettings( )
	{
		$params =& $this->getParams();
		$pluginParams =& $this->getPluginParams();
		?>
		<div id="page-<?php echo $this->_name;?>" class="elementSettings" style="display:none">calculation
			<?php echo $pluginParams->render(); ?>
		</div><?php
	}
}	
?>