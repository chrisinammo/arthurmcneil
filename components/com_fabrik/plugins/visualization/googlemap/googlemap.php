<?php
/**
* @package Joomla
* @subpackage Fabrik
* @copyright Copyright (C) 2005 Rob Clayburn. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/

/**
 * methods invoked by the plugin :
 * 
 * onStartRender()
 * onError()
 * onBeforeDisplay()
 * onAfterDisplay()
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

class FabrikModelGooglemap extends FabrikModelVisualization {
	
	/**
	* Constructor
	*/


	function __contruct()
	{
		parent::__construct();
	}
	
 	
 	/**
 	 * write out the admin form for customising the plugin
 	 *
 	 * @param object $row
 	 */

 	function renderAdminSettings( )
	{
		$pluginParams =& $this->getPluginParams();
		?>
		<div id="page-<?php echo $this->_name;?>" class="pluginSettings" style="display:none">
		<?php 
		$c = count($pluginParams->get('googlemap_table'));
		$pluginParams->_duplicate = true;
		echo $pluginParams->render('params', 'connection');
		
		for ($x=0;$x<$c;$x++) {
			echo $pluginParams->render('params', '_default', true, $x);
		}
		
		$pluginParams->_duplicate = false;
		echo $pluginParams->render('params', 'rest');?>
		</div><?php
 	}
 		
 	/**
 	 * internally render the plugin, and add required script declarations 
 	 * to the document 
 	 */

 	function render( )
 	{
 		require_once( COM_FABRIK_FRONTEND.DS.'helpers'.DS.'html.php' );
 		require_once( COM_FABRIK_FRONTEND.DS.'helpers'.DS.'parent.php' );
 		$params 	=& $this->getParams();
 		$config		=& JFactory::getConfig();
		$document =& JFactory::getDocument();
 		
 		$document->addScript( "http://maps.google.com/maps?file=api&amp;v=2&amp;key=" . $params->get( 'fb_gm_key' ) );
		FabrikHelperHTML::script( 'googlemap.js', 'components/com_fabrik/plugins/visualization/googlemap/', true );
		$w = new FabrikWorker();
		$str = "window.addEvent('domready', function(){\n";
		$str .= "var icons = \$A(new Array());\n";
		
		$templates = $params->get( 'fb_gm_detailtemplate', array(), '_default', 'array' );
 	 	$aTables = $params->get('googlemap_table', array(), '_default', 'array');
 	 	$c = 0;
 		
 	 	foreach ($aTables as $tableid) {
	 		$template = $templates[$c];
	 		$c ++;
 			$tableModel =& JModel::getInstance( 'Table', 'FabrikModel' );
	 		
	 		$tableModel->setId( $tableid );
	 		$table =& $tableModel->getTable();
	 		
	 		$groups =& $tableModel->getFormGroupElementData( false, true );
	 		foreach ($groups as $groupModel) {
	 			if (is_array( $groupModel->_aElements )) {
					foreach ($groupModel->_aElements as $elementModel) {
						if ($elementModel->_element->plugin == 'fabrikgooglemap') {
							$coordColumn =  $elementModel->getFullName( false, true, false ) . "_raw";
						}
					}
				}
	 		}
	 		if ($coordColumn == '') {
	 			JError::raiseError( 500, JText::_('No google map element present in this table'));
	 			continue;
	 		}
	 		
			$tableModel->_onlyTableData = false;
			$tableModel->_pageNav			=& $tableModel->_getPagination( 0, 0, 0 );
			$data = $tableModel->getData( );
			
			foreach ($data as $group) {
				foreach ($group as $row) {
					$v = trim($row->$coordColumn);
					$v = FabrikString::ltrimword( $v, "(" );
					if (strstr( $v, "," )) {
						if(strstr($v, ":")){
							$ar = explode( ":", $v );
							array_pop( $ar );
							$v = explode( ",", $ar[0] );
						} else {
							$v = explode( ",", $v );
						}
						$v[1] = FabrikString::rtrimword($v[1], ")");
					} else {
						continue;//dont show icons with no data
						$v = array( 0,0 );
					}
					$data = JArrayHelper::fromObject( $row );
					
					$html = addSlashes( $w->parseMessageForPlaceHolder( $template, $data ) );
					
					if (array_key_exists( 'fabrik_view', $row )) {
						$html .= "<br />" . addSlashes( $row->fabrik_view );
					}
					$html = str_replace(array("\n", "\r"), "<br />", $html);
					$str .= "icons.push([".$v[0].",".$v[1].",'$html']);\n";
				}
			}
 		}
		$str .= "fabrikMap = new fbGoogleTableMap('table_map', {'icons':icons,
			'zoomlevel':'" . $params->get( 'fb_gm_zoomlevel' ) . "',
			'control':'" . $params->get( 'fb_gm_mapcontrol' ) . "',
			'scalecontrol':'" . $params->get( 'fb_gm_scalecontrol' ) . "',
			'maptypecontrol':'" .  $params->get( 'fb_gm_maptypecontrol' ) . "',
			'overviewcontrol':'" . $params->get( 'fb_gm_overviewcontrol' ) . "'
		});\n";
		$str .="})\n";		
		$document->addScriptDeclaration( $str );
 	}
 	
 	function canUse()
 	{
 		return true;
 	}
}
?>