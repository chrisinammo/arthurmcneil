<?php
/**
* @package Joomla
* @subpackage Fabrik
* @copyright Copyright (C) 2005 Rob Clayburn. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/

/**
 * methods invoked by the table :
 * 
 * onStartRender()
 * onError()
 * onBeforeDisplay()
 * onAfterDisplay()
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

class FabrikModelChart extends FabrikModelVisualization {
	
	/**
	* Constructor
	*/
	
	var $_url = 'http://chart.apis.google.com/chart';

	function __contruct()
	{
		parent::__construct();
	}
	
	function render()
	{
		$params =& $this->getParams();
		$w = $params->get('chart_width');
		$h = $params->get('chart_height');
		
		$graph =$params->get( 'graph_type' );
		
		$fillGraphs 		= $params->get( 'fill_line_graph' );
		
		$x_axis_label 	= $params->get( 'x_axis_label', array(), '_default', 'array' );
		$chartElements 	= $params->get('chart_elementList', array(), '_default', 'array');
		$chartColours 	= $params->get('chart_colours', array(), '_default', 'array');
		$tableid 				= $params->get('chart_table', array(), '_default', 'array');
		$axisLabels 		= $params->get('chart_axis_labels', array(), '_default', 'array');
		$legends  			= $params->get( 'graph_show_legend' );
		$c = 0;
		$gdata = array();
		$glabels = array();
		$gcolours = array();
		$gfills = array();
		$max = 0;
		$min = 0;
		foreach($tableid as $tid){
			$tableModel = null;
			$tableModel =& JModel::getInstance( 'Table', 'FabrikModel' );
			$tableModel->setId( $tid );
	 		$table =& $tableModel->getTable();
	 		$tableModel->_pageNav			=& $tableModel->_getPagination( 0, 0, 0 );
			$alldata = $tableModel->getData( );
			
			$column = $chartElements[$c]. "_raw";
			$label = $x_axis_label[$c];
			$tmpgdata = array();
			$tmpglabels = array();
			$colour = str_replace("#", '', $chartColours[$c]);
			
			if ($fillGraphs) {
				$c2 = $c + 1;
				$gfills[] ='b,'. $colour . "," . $c  . ",". $c2 .",0";
			}
		
			$gcolours[] = $colour;
			foreach ($alldata as $group) {
				foreach ($group as $row) {
					if (trim($row->$column) == '') {
						$tmpgdata[] = - 1;
					}else{
						$tmpgdata[] = (float)$row->$column;
					}
					$tmpglabels[] = $row->$label;
				}
				if(max($tmpgdata) > $max){
					$max = max($tmpgdata);
				}
			if(min($tmpgdata) < $min){
					$min = min($tmpgdata);
				}
				$gdata[$c] = implode(',', $tmpgdata);
				$glabels[$c] = implode('|', $tmpglabels);
			}
			$c ++;
		}


$return = '<img src="' . $this->_url . '?';
$qs = 'chs='.$w.'x'.$h.'
&amp;chd=t:'.implode('|', $gdata). '
&amp;cht='.$graph.'
&amp;chco='.implode(',', $gcolours);
$qs .= '&amp;chxt=x,y
&amp;chxl=
0:|'.$glabels[0].'|
1:|'.$min.'|'.$max.'|';

if ($fillGraphs) {
	$qs .=  '&amp;chm=' . implode('|', $gfills);
}
if ($legends) {
	$qs .= '&amp;chdl=' . implode('|', $axisLabels);
}


$return .= $qs . '"
alt="'.$this->_row->label.'" />';
		$this->image =  $return;

	}

 	/**
 	 * write out the admin form for customising the plugin
 	 *
 	 * @param object $row
 	 */

 	function renderAdminSettings( )
 	{
		$pluginParams =& $this->getPluginParams();
		$document =& JFactory::getDocument();
?>
		<div id="page-<?php echo $this->_name;?>" class="pluginSettings" style="display:none">
			<?php
			//echo $pluginParams->render( 'params' );
		$pluginParams->_duplicate = false;
		echo $pluginParams->render('params', 'rest');
		
		$c = count($pluginParams->get('chart_table'));
		$pluginParams->_duplicate = true;
		echo $pluginParams->render('params', 'connection');
		
		for ($x=0;$x<$c;$x++) {
			echo $pluginParams->render('params', '_default', true, $x);
		}
 	}
}
?>