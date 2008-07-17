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
	
	//var $_data 		= null;
	//var $_lists 	= null;
	//var $_pageNav 	= null;
	//var $_params 	= null;
	//var $_aLinkElements = null;

	
	function display()
	{
		require_once( COM_FABRIK_FRONTEND.DS.'helpers'.DS.'parent.php' );
		require_once( COM_FABRIK_FRONTEND.DS.'helpers'.DS.'json.php' );
		global $Itemid, $mainframe;
		$config		=& JFactory::getConfig();
		$user 		=& JFactory::getUser();
		$model		=& $this->getModel();
		$model->_outPutFormat == 'feed';
		$document =& JFactory::getDocument();
		
		//Get the active menu item
		$usersConfig = &JComponentHelper::getParams( 'com_fabrik' );
		
		if (!isset( $this->_id )) {
			if ($model->_admin) {
				$tpl = "admin";
			} else {
				$model->setId( JRequest::getVar( 'tableid', $usersConfig->get('tableid') ) );
			}
		} else {
			//when in a package the id is set from the package view
			$model->setId( $this->_id );
		}
		
		$table			=& $model->getTable();
		$model->render();
		$params 		=& $model->getParams();
		
		if ($params->get('rss') == '0') {
			return '';
		}
		
		$formModel =& $model->getForm();
		$form =& $formModel->getForm();
		
		$aJoinsToThisKey = $model->getJoinsToThisKey();
		/* get headings */ 
		$aTableHeadings = array();
		foreach ($formModel->_groups as $oGroup) {
			foreach ($oGroup->_aElements as $elementModel) {
				$element = $elementModel->getElement();
				$elParams =& $elementModel->getParams();
					
				//$elParams =& new fabrikParams( $oElement->attribs, $mosConfig_absolute_path . '/administrator/components/com_fabrik/xml/element.xml', 'component' );
				if ($elParams->get( 'show_in_rss_feed' ) == '1') {
					$heading = $element->label;
					if ($elParams->get( 'show_label_in_rss_feed' ) == '1') {
						$aTableHeadings[$heading]['label']	 = $heading;
					} else {
						$aTableHeadings[$heading]['label']	 = '';	
					}
					$aTableHeadings[$heading]['colName'] = $elementModel->getFullName( false, true );
					$aTableHeadings[$heading]['dbField'] = $element->name;
					$aTableHeadings[$heading]['key'] = $elParams->get( 'use_as_fake_key' );
				}
			}
		}
		
		foreach ($aJoinsToThisKey as $element) {
			$element = $elementModel->getElement();
			$elParams = new fabrikParams( $element->attribs, JPATH_SITE . '/administrator/components/com_fabrik/xml/element.xml', 'component' );
			if ( $elParams->get( 'show_in_rss_feed' ) == '1' ) {
				$heading = $element->label;
				
				if( $elParams->get( 'show_label_in_rss_feed' ) == '1' ){
					$aTableHeadings[$heading]['label']	 = $heading;
				} else {
					$aTableHeadings[$heading]['label']	 = '';	
				}
				$aTableHeadings[$heading]['colName'] = $element->db_table_name . "___" . $element->name;
				$aTableHeadings[$heading]['dbField'] = $element->name;
				$aTableHeadings[$heading]['key'] = $elParams->get( 'use_as_fake_key' );
			}
		}	
		
		$dateCol = $params->get( 'feed_date', '' );
		$rows =& $model->_tableData;
		$document->title = $table->label;
		$document->link = JRoute::_( 'index.php?option=com_fabrik&view=table&tableid=' . $table->id . '&Itemid=' . $Itemid );
		$titleEl = $params->get( 'feed_title' );
		$dateEl = $params->get( 'feed_date' );
		$dateEl = $params->get('feed_date');
		$view = $model->canEdit() ? 'form' : 'details';

		foreach ($rows as $group)
		{
			foreach ($group as $row)
			{
				// strip html from feed item title
				//$title = html_entity_decode($this->escape( $row->$titleEl ));
	
				//get the content
				$str2 = '';
				$str = '<table style="margin-top:10px;padding-top:10px;">'; 
				//used for content not in dl
				//ok for feed gator you cant have the same item title so we'll take the first value from the table (asume its the pk and use that to append to the item title)'
				$title = '';
				foreach ($aTableHeadings as $heading=>$dbcolname) {
					if ($title == '') { 
						//set a default title
						$title = $row->$dbcolname['colName'];
					}
					if ($dbcolname['label'] == '') {
						$str2 .= $row->$dbcolname['colName'] . "<br />\n";
					} else {
						$str .= "<tr><td>" . $dbcolname['label'] . ":</td><td>" . $row->$dbcolname['colName'] . "</td></tr>\n";
					}
				}
				
				if (isset( $row->$titleEl )) {
					$title = $row->$titleEl;
				}
				$str = $str2 . $str . "</table>";
						
				// url link to article
				$link = JRoute::_('index.php?option=com_fabrik&view='.$view.'&tableid='.$table->id.'&fabrik='.$form->id.'&rowid='. $row->__pk_val );
	
				// strip html from feed item description text
				$author			= @$row->created_by_alias ? @$row->created_by_alias : @$row->author;

				if ($dateEl != '') {
					$date = ( $row->$dateEl ? date( 'r', strtotime(@$row->$dateEl) ) : '' );
				} else {
					$data = '';
				}
				// load individual item creator class
				$item =& new JFeedItem();
				$item->title 		= $title;
				$item->link 		= $link;
				$item->guid 		= $link;
				$item->description 	= $str;
				$item->date			= $date;
				$item->category   	= $row->category;
				
				// loads item info into rss array
				$document->addItem( $item );
			}
		}
	}
	
}
?>