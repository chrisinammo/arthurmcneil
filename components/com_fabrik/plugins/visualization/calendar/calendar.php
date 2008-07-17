<?php
/**
* Visualization plugin - display js calendar
* @package Joomla
* @subpackage Fabrik
* @copyright Copyright (C) 2005 Rob Clayburn. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

jimport('joomla.application.component.model');
//did extend FabrikModelPlugin
require_once( COM_FABRIK_FRONTEND.DS.'helpers'.DS.'html.php' );

class FabrikModelCalendar extends FabrikModelVisualization {

	/** @var array of elements whose labels are used for events 
	e.g.
	tableid => array('label'=>'elementname', 'date'=>'elementname', colour=>hex*/
	var $_events = null;
	
	/** @var object params */
	var $_params = null;

	
	function renderAdminSettings()
	{
		JHTML::stylesheet( 'fabrikadmin.css', 'administrator/components/com_fabrik/views/' );
		$pluginParams =& $this->getPluginParams();
		$document =& JFactory::getDocument( );
		FabrikHelperHTML::script( 'admincalendar.js', 'components/com_fabrik/plugins/visualization/calendar/', true );
		?>
		<div id="page-<?php echo $this->_name;?>" class="pluginSettings" style="display:none">
		<?php
			echo $pluginParams->render( 'params' );
			echo $pluginParams->render( 'params', 'fields');
			?>
		</div>		
		<?php
		return ;
	}

	function updateevent()
	{
		echo "updateevent: ";print_r($_REQUEST);
		$oPluginManager =& JModel::getInstance( 'Pluginmanager', 'FabrikModel' );
		
	}
	
	function chooseaddevent( &$view )
	{
		FabrikHelperHTML::script( 'mootools-ext.js', 'components/com_fabrik/libs/', true );
		$view->_layout = 'chooseaddevent';
		$db =& JFactory::getDBO();
		$params =& $this->getParams();
		$tables = $params->get( 'calendar_table', array(), '_default',  'array' );
		
		$options = array();
		//get the standand event form
		$db->setQuery( "SELECT form_id FROM #__fabrik_tables WHERE db_table_name = 'jos_fabrik_calendar_events' AND private = '1'" );
		$formId = $db->loadResult();
		$options[] = JHTML::_('select.option', '', JText::_('Please select'));
		$options[] = JHTML::_('select.option', $formId, JText::_('Standard event'));
		
		
		$db->setQuery( "SELECT form_id AS value, label AS text FROM #__fabrik_tables WHERE id IN ('" . implode("','", $tables)  . "')" );
		$rows = $db->loadObjectList();
		$options = array_merge( $options, $rows );
		
		$this->_eventTypeDd = JHTML::_( 'select.genericlist', $options, 'event_type', 'class="inputbox" size="1" ', 'value', 'text', '', 'fabrik_event_type' );
		
		$script = "window.addEvent('domready', function(){
			$('fabrik_event_type').addEvent('change', function(e){
				var sel = e.target.getValue();
				var url = 'index.php?option=com_fabrik&view=form&fabrik=' + sel + '&rowid=&tmpl=component' ;
				$('fabrik_event_form').src = url;
				/* js wont load if you update a div via ajax call??
				new Ajax(url, {
					'update':'fabrik_event_form',
					method: 'get',
					'evalScripts':true
				}).request();*/
			});
	});
	";
		$document =& JFactory::getDocument();
		$document->addScriptDeclaration( $script );
	}
	
	function render()
	{
		require_once(COM_FABRIK_FRONTEND.DS.'helpers'.DS.'html.php');
		$config		=& JFactory::getConfig();
		$document =& JFactory::getDocument();
		FabrikHelperHTML::loadCalendar();
		require_once( COM_FABRIK_FRONTEND.DS.'helpers'.DS.'html.php' );
		FabrikHelperHTML::script( 'package.js', 'components/com_fabrik/views/package/', true );
		FabrikHelperHTML::script( 'calendar.js', 'components/com_fabrik/views/calendar/', true );
		FabrikHelperHTML::script( 'element.js', 'components/com_fabrik/views/form/', true );
		FabrikHelperHTML::script( 'form.js', 'components/com_fabrik/views/form/', true );

		FabrikHelperHTML::mocha( );
		
		FabrikHelperHTML::script( 'calendar.js', 'components/com_fabrik/plugins/visualization/calendar/', true );
		$params =& $this->getParams();
		
		//Get the active menu item
		$usersConfig = &JComponentHelper::getParams( 'com_fabrik' );
		
		$user 		=& JFactory::getUser();
		$calendar = $this->_row;
		$this->events = $this->getEvents();
		$tmpl = $params->get('calendar_layout', 'default');
		$oPluginManager =& JModel::getInstance( 'Pluginmanager', 'FabrikModel' );
		$oPluginManager->loadJS();
		$str = "window.addEvent('domready', function(e){\n".
		"oCalendar = new fabrikCalendar('calendar');\n".
		"oCalendar.render({}, {calendarId:$calendar->id, 'tmpl':'$tmpl'});\n".
		"oPackage.addBlock('calendar_" . $calendar->id . "', oCalendar);\n".
		$this->events . $this->legend . "});\n";
		
		$document->addScriptDeclaration( $str );
		
	}
	//deprecaited use chooseaddevent instead
	function ajax_addEventForm(){
	}
	
	/**
	 * query all tables linked to the calendar and return them 
	 * @return string javascript array containg json objects
	 */

	function getEvents(){
		global $Itemid;
		$db		=& JFactory::getDBO();
		$params =& $this->getParams();
		$tables 			= $params->get( 'calendar_table', '', '_default',  'array' );
		$table_date 	= $params->get( 'calendar_date_element', '', '_default',  'array' );
		$table_label 	= $params->get( 'calendar_label_element', '', '_default',  'array' );
		
		$colour 		= $params->get('colour', '#ccccff', '_default',  'array');
		$this->_events = array();
		$calendar = $this->_row;


		
		for ($i=0; $i<count( $tables ); $i++) {
			$this->_events[$tables[$i]][] = array(
				'date'=>$table_date[$i], 
				'label'=>$table_label[$i], 
				'colour'=>$colour[$i] 
			);
		}
		$tableModel =& JModel::getInstance( 'Table', 'FabrikModel' );
		$tableModel->setAdmin( false );
		
		$aLegend = "oCalendar.addLegend([";
		$addEvent = "oCalendar.addEntries([\n";
		foreach ($this->_events as $tableId	 => $record) {
			$tableModel->setId( $tableId );
			$table =& $tableModel->getTable();
			foreach ($record as $data ) {
				$db 		=& $tableModel->getDb();
				$rubbish = $table->db_table_name . '___';
				$date 		= FabrikString::ltrimword( $data['date'], $rubbish );
				$label 		= FabrikString::ltrimword( $data['label'], $rubbish );
				$colour 	= FabrikString::ltrimword( $data['colour'], $rubbish );
				
				$pk = $tableModel->getPrimaryKeyAndExtra();
				$pk = $pk['colname'];
				$db->setQuery("SELECT $pk, $date, $label FROM $table->db_table_name" );
				$formdata 	= $db->loadObjectList();
				$aLegend  	.= "{'label':'" .  $table->label . "','colour':'" . $colour . "'},";
				foreach ($formdata as $row) {
					if ($row->$date != '' && $row->$label != '') {
						$pkVal = $row->$pk;
						$link = ("index.php?option=com_fabrik&Itemid=$Itemid&view=form&fabrik=$table->form_id&rowid=$pkVal&tmpl=component");
						$addEvent .= '{\'id\':\'' . $pkVal . '\', \'link\':\'' . $link . '\',\'date\':\'' .$row->$date .'\',\'label\':\''. $row->$label . '\',\'colour\':\'' . $colour . '\', \'formid\':\'' . 0 .'\'}, ' . "\n";
					}
				}
			}
		}
		
		$db =& JFactory::getDBO();
		//get internal events for the calendar
		$db->setQuery( "SELECT * FROM #__fabrik_calendar_events WHERE visualization_id = '$calendar->id'");
		$defEvents = $db->loadObjectList();
		foreach ($defEvents as $row ){
			$link = '';
			$addEvent .= '{\'id\':\'' . $row->id . '\', \'link\':\'' . $link . '\',\'date\':\'' .$row->start_date .'\',\'label\':\''. $row->label . '\',\'colour\':\'#EEEEEE\', \'formid\':\''.$this->_serializedFormId.'\'}, '. "\n";
		}
		$aLegend  	.= "{'label':'Events','colour':'#EEEEEE'},";
		
		$addEvent = rtrim( $addEvent, "," ). "]);";
		$aLegend = rtrim( $aLegend, "," ). "]);";
		//echo $aLegend;
		$this->legend = $aLegend;
		return $addEvent;
	}
	
 	/**
	* Save the calendar
	* @return boolean false if not saved, otherwise id of saved calendar
	*/
	
	function save( )
	{
		$user	  = &JFactory::getUser();
		$post	= JRequest::get( 'post' );
		if (!$this->bind( $post )) {
			return JError::raiseWarning( 500, $this->getError() );
		}
		
		$params = JRequest::getVar( 'params', array(), 'post' );
		$this->attribs = $this->updateAttribsFromParams( $params );
		if ($this->id == 0) {
			$this->created 		= date( 'Y-m-d H:i:s' );
			$this->created_by 	= $user->get('id');
		} else {
			$this->modified 	= date( 'Y-m-d H:i:s' );
			$this->modified_by 	= $user->get('id');
		}
		
		if (!$this->check( )) {
			return JError::raiseWarning( 500, $this->getError() );
		} 

		if (!$this->store( )) {
			return JError::raiseWarning( 500, $this->getError() );
		}
		$this->checkin( );
		return $this->id; 
	}
	
	function getParams()
	{
		if (is_null( $this->_params )) {
			$v =& $this->getVisualization();
			$this->_params 	= new fabrikParams( $v->attribs, JPATH_SITE . '/administrator/components/com_fabrik/xml/connection.xml', 'component' );	
		}
		return $this->_params;
	}
}
?>