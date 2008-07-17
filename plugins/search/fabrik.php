<?php
/**
 * @package		Joomla
 * @subpackage	Fabik
 * @copyright	Copyright (C) 2005 - 2008 Pollen 8 Design Ltd. All rights reserved.
 * @license		GNU/GPL
 */

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

$mainframe->registerEvent( 'onSearch', 'plgSearchFabrik' );
$mainframe->registerEvent( 'onSearchAreas', 'plgSearchFabrikAreas' );

JPlugin::loadLanguage( 'plg_search_categories' );

/**
 * @return array An array of search areas
 */
function &plgSearchFabrikAreas()
{
	static $areas = array(
		'fabrik' => 'Fabrik'
	);
	return $areas;
}

/**
 * Fabrik Search method
 *
 * The sql must return the following fields that are
 * used in a common display routine: href, title, section, created, text,
 * browsernav
 * @param string Target search string
 * @param string mathcing option, exact|any|all
 * @param string ordering option, newest|oldest|popular|alpha|category
 * @param mixed An array if restricted to areas, null if search all
 */
function plgSearchFabrik( $text, $phrase='', $ordering='', $areas=null )
{
	$db		=& JFactory::getDBO();
	$user	=& JFactory::getUser();

	require_once(JPATH_SITE.DS.'components'.DS.'com_content'.DS.'helpers'.DS.'route.php');

	if (is_array( $areas )) {
		if (!array_intersect( $areas, array_keys( plgSearchFabrikAreas() ) )) {
			return array();
		}
	}

	// load plugin params info
 	$plugin =& JPluginHelper::getPlugin('search', 'categories');
 	$pluginParams = new JParameter( $plugin->params );

	$limit = $pluginParams->def( 'search_limit', 50 );

	$text = trim( $text );
	if ( $text == '' ) {
		return array();
	}

	switch ($ordering) {
		case 'oldest':
			$order = 'a.created ASC';
			break;

		case 'popular':
			$order = 'a.hits DESC';
			break;

		case 'alpha':
			$order = 'a.title ASC';
			break;

		case 'category':
			$order = 'b.title ASC, a.title ASC';
			$morder = 'a.title ASC';
			break;

		case 'newest':
		default:
			$order = 'a.created DESC';
			break;
	}
	generalIncludes('table');
	//get all tables
	$sql = "select ID from #__fabrik_tables ";
	$db->setQuery($sql);
	$list = array();
	$ids = $db->loadResultArray();
	foreach($ids as $id) {
		$model =& JModel::getInstance( 'Table', 'FabrikModel' );
		$model->setId( $id );
		
		if ($model->canPublish( ) && $model->canView( )) {
			$elData 	= $model->getFormGroupElementData(true);
			$table = $model->getTable();
			$fabrikDb = $model->getDb();
			$formModel =& $model->getForm();
			$form =& $formModel->getForm();
			$fields = array();
			$sqlfields = array();
			$pKey = '';
			$joinSQL = $model->_getJoinSQL();
			foreach ($formModel->_groups as $groupModel) {
				foreach ($groupModel->_aElements as $elementModel) {
					$element =& $elementModel->getElement();
					$sqlfields[] ="`$element->name`";
					$fields[] = "'$element->label:'"   ;
					$fields[] = $elementModel->getFullName( false, false, false );
					$fields[] = "'&nbsp;&nbsp;&nbsp;&nbsp;'";
				}
			}
			$where = getWhere( $sqlfields, $phrase, $text );
			$sFields = implode( ", ' ', ", $fields );
			$sql = "SELECT '$table->label' AS title,
						$table->db_primary_key AS _pkey, "
						. "\n 'Fabrik/record'  AS section," .
						 "CONCAT('index.php?option=com_fabrik&view=details&tableid=" . $table->id . "&fabrik=" . $form->id . "&rowid=', $table->db_primary_key) AS href,
						'' as created,
						'2' as browsernav,
						 CONCAT($sFields) AS text FROM `$table->db_table_name` $joinSQL WHERE $where";
			$fabrikDb->setQuery($sql, 0, $limit);
			
			$allrows = $fabrikDb->loadObjectList();
			$aAllowedList = array();
		 	if (is_array( $allrows )) {
			 	foreach ($allrows as $oData) {
			 		$data = JArrayHelper::fromObject( $oData );
				 	$aAllowedList[] = $oData;
			 	}
			 	$list[] = $aAllowedList;
		 	}
		}
		
	}
	$allList = array();
	foreach($list as $li){
		if(is_array($li) && !empty($li)){
			$allList = array_merge($allList, $li);
		}
	}
	
	return $allList;
	
}

	/**
	 * load the required fabrik files
	 *
	 * @param string $view
	 */
	function generalIncludes( $view )
	{
		define( "COM_FABRIK_BASE",  JPATH_BASE );
		define( "COM_FABRIK_FRONTEND",  JPATH_BASE.DS.'components'.DS.'com_fabrik' );
		define( "COM_FABRIK_LIVESITE",  JURI::base() );
		
		require_once('components/com_fabrik/controller.php');
		
		require_once('components/com_fabrik/models/parent.php');
		JTable::addIncludePath( JPATH_ADMINISTRATOR.DS.'components'.DS.'com_fabrik'.DS.'tables' );
		JModel::addIncludePath( COM_FABRIK_BASE.DS.'components'.DS.'com_fabrik'.DS.'models' );
		
		require_once('components/com_fabrik/views/'.$view.'/view.html.php');
	}
	
function getWhere($fields, $phrase, $text){
	$allWheres = array();
	$where = '';
	foreach($fields as $field){
		switch ($phrase) {
		case 'exact':
			$wheres2 	= array();
			$wheres2[] 	= "LOWER($field) LIKE LOWER('%$text%')";
			//$wheres2[] 	= "LOWER($field) LIKE LOWER('%$text%')";
			//$wheres2[] 	= "LOWER($field) LIKE LOWER('%$text%')";
			//$wheres2[] 	= "LOWER($field) LIKE LOWER('%$text%')";
			//$wheres2[] 	= "LOWER($field) LIKE LOWER('%$text%')";
			$where 		= '(' . implode( ') OR (', $wheres2 ) . ')';
			break;

		case 'all':
		case 'any':
		default:
			$words = explode( ' ', $text );
			$wheres = array();
			foreach ($words as $word) {
				$wheres2 	= array();
				$wheres2[] 	= "LOWER($field) LIKE LOWER('%$word%')";
				//$wheres2[] 	= "LOWER($field) LIKE LOWER('%$word%')";
				//$wheres2[] 	= "LOWER($field) LIKE LOWER('%$word%')";
				//$wheres2[] 	= "LOWER($field) LIKE LOWER('%$word%')";
				//$wheres2[] 	= "LOWER($field) LIKE LOWER('%$word%')";
				$wheres[] 	= implode( ' OR ', $wheres2 );
			}
			$allWheres[] = '(' . implode( ($phrase == 'all' ? ') AND (' : ') OR ('), $wheres ) . ')';
			break;
	}		
	}
	return implode(' OR ', $allWheres);
}