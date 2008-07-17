<?php
/**
* @package Joomla
* @subpackage Fabrik
* @copyright Copyright (C) 2005 Rob Clayburn. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

jimport('joomla.application.component.view');

class FabrikViewTable extends JView{

	var $_data 		= null;
	var $_pageNav 	= null;
	var $_params 	= null;
	var $_aLinkElements = null;
	var $_id = null;

	function setId( $id )
	{
		$this->_id = $id;
	}



	function display($tpl = null)
	{
		require_once( COM_FABRIK_FRONTEND.DS.'helpers'.DS.'parent.php' );
		require_once( COM_FABRIK_FRONTEND.DS.'helpers'.DS.'json.php' );
		global $Itemid, $mainframe;
		$config		=& JFactory::getConfig();
		$user 		=& JFactory::getUser();
		$model		=& $this->getModel();
		$document =& JFactory::getDocument();
		
		//set layout to landscape
		$document->_engine->CurOrientation = 'L';
		$document->_engine->DefOrientation = 'L';
		
		$document->_engine->wPt = $document->_engine->fhPt;
		$document->_engine->hPt=$document->_engine->fwPt;
				
		$document->_engine->w=$document->_engine->wPt/$document->_engine->k;
		$document->_engine->h=$document->_engine->hPt/$document->_engine->k;
				
		//this gets teh component settings
		$usersConfig = &JComponentHelper::getParams( 'com_fabrik' );
		if (!isset( $this->_id )) {
			if ($model->_admin) {
				$tpl = "admin";
			} else {
				$model->setId( JRequest::getVar( 'tableid', $usersConfig->get( 'tableid' ) ) );
			}
		} else {
			//when in a package the id is set from the package view
			$model->setId( $this->_id );
		}
		$table			=& $model->getTable();
		$model->render( );
		$this->rows = $model->_tableData;
		$params 		=& $model->getParams();

		if ( !$model->canPublish( ) ){
			echo JText::_( 'Sorry this table is not published' );
			return false;
		}
		if (!$model->canView( ) ){
			echo JText::_('ALERTNOTAUTH');
			return false;
		}

		//$inPackage = $model->_inPackage;
		//echo $inPackage ? 'in package' : 'not in package';
		$this->table 					= new stdClass();
		$w = new FabrikWorker(); 
		$this->table->label 	= $w->parseMessageForPlaceHolder( $table->label, $_REQUEST );
		$this->table->intro 	= $table->introduction;
		$this->table->id			= $table->id;
		$this->group_by				= $table->group_by;
		//$this->formid = ( $inPackage ) ?  'tableform_' . $table->id : 'fabrikTableForm';
		//$page = ( $inPackage ) ? "index.php?&format=raw" : "index.php?";
		$this->formid = 'tableform_' . $table->id;
		$page = "index.php?";
		
		$this->table->action 	=  $page . str_replace('&', '&amp;', $_SERVER['QUERY_STRING']);

		$this->fabrik_userid 	= $user->get('id');
		$this->filter_action = $table->filter_action;

		$this->emptyDataMessage = $model->_params->get( 'empty_data_msg' ) ;
		$aReturn = $model->_getTableHeadings( );

		$aTableHeadings 				= $aReturn[0];
		$aCols 									= $aReturn[1];
		$aNamedHeadings 				= $aReturn[3];
		$this->headings 				= $aTableHeadings;

		$this->calculations 	= $this->_getCalculations( $aTableHeadings );

		echo "<h1>" . $this->table->label . "</h1>";
		echo $this->table->intro;

		if( count( $this->rows ) == 0 ){?>
<div class="emptyDataMessage"><?php echo $this->emptyDataMessage; ?></div>
		<?php }else{
			foreach( $this->rows as $group ){
				?>
<table class="fabrikTable" id="table_<?php echo $this->table->id;?>">
	<tr>
	<?php foreach( $this->headings as $heading ){?>
		<th><?php echo $heading; ?></th>
		<?php }?>
	</tr>
	<?php
	$c = 0;
	foreach($group as $this->_row){?>
	<tr
		id="table_<?php echo $this->table->id;?>_row_<?php echo $this->_row->__pk_val;?>"
		class="fabrik_row oddRow<?php echo $c % 2;?>">
		<?php foreach ($this->headings as $heading=>$label) {	?>
		<td><?php echo $this->_row->$heading;?></td>
		<?php }?>
	</tr>
	<?php
	$c++;

}?>
	<tr class="fabrik_calculations">
	<?php
	foreach($this->calculations as $cal){
		echo "<td>" . $cal->calc ."</td>";
	}
	?>
	</tr>
</table>
	<?php }
	} //end not empty
}

/**
 *
 */

function _getCalculations( $aCols )
{
	$aData = array();
	$model = $this->getModel();
	//if ( is_array( $this->rows ) ) {
	foreach ( $aCols as $key=>$val ){
		$calc = '';
		$res = '';
		$oCalcs = new stdClass();
		if ( array_key_exists( $key, $model->_aRunCalculations['sums'] ) ){
			$res = $model->_aRunCalculations['sums'][$key];
			$calc .= JText::_('Sum') . ": " . $res . "<br />";
			$tmpKey = str_replace(".", "___", $key) . "_calc_sum";
			$oCalcs->$tmpKey = $res;
		}
		if ( array_key_exists( $key . '_obj', $model->_aRunCalculations['sums'] ) ){
			$res = $model->_aRunCalculations['sums'][$key. '_obj'];
			$tmpKey =  "obj";
			$oCalcs->$tmpKey = $res;
		}

		if ( array_key_exists( $key, $model->_aRunCalculations['avgs'] ) ){
			$res = $model->_aRunCalculations['avgs'][$key];
			$calc .= JText::_('Average') . ": " . $res . "<br />";
			$tmpKey = str_replace(".", "___", $key) . "_calc_average";
			$oCalcs->$tmpKey = $res;
				
		}
		if ( array_key_exists( $key, $model->_aRunCalculations['medians'] ) ){
			$res = $model->_aRunCalculations['medians'][$key];
			$calc .= JText::_('Median') . ": " . $res . "<br />";
			$tmpKey = str_replace(".", "___", $key) . "_calc_median";
			$oCalcs->$tmpKey = $res;
				
		}
		if ( array_key_exists( $key, $model->_aRunCalculations['count'] ) ){
			$res = $model->_aRunCalculations['count'][$key];
			$calc .= JText::_('Count') . ": " . $res . "<br />";
			$tmpKey = str_replace(".", "___", $key) . "_calc_count";
			$oCalcs->$tmpKey = $res;
		}
		$key = str_replace(".", "___", $key);
		$oCalcs->calc = $calc;
		$aData[$key] = $oCalcs;
	}
	//}
	return $aData;
}


}

?>