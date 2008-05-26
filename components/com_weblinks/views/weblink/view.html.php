<?php
/**
* @version		$Id: view.html.php 10094 2008-03-02 04:35:10Z instance $
* @package		Joomla
* @subpackage	Weblinks
* @copyright	Copyright (C) 2005 - 2008 Open Source Matters. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* Joomla! is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted access' );

jimport( 'joomla.application.component.view');

/**
 * HTML View class for the WebLinks component
 *
 * @static
 * @package		Joomla
 * @subpackage	Weblinks
 * @since 1.0
 */
class WeblinksViewWeblink extends JView
{
	function display($tpl = null)
	{
		global $mainframe;

		if($this->getLayout() == 'form') {
			$this->_displayForm($tpl);
			return;
		}

		//get the weblink
		$weblink =& $this->get('data');

		if ($weblink->url) {
			// redirects to url if matching id found
			$mainframe->redirect($weblink->url);
		}

		parent::display($tpl);
	}

	function _displayForm($tpl)
	{
		global $mainframe;

		// Get some objects from the JApplication
		$pathway	=& $mainframe->getPathway();
		$document	=& JFactory::getDocument();
		$model		=& $this->getModel();
		$user		=& JFactory::getUser();
		$uri     	=& JFactory::getURI();

		// Make sure you are logged in and have the necessary access rights
		if ($user->get('gid') < 19) {
			JError::raiseError( 403, JText::_('ALERTNOTAUTH') );
			return;
		}

		//get the weblink
		$weblink	=& $this->get('data');
		$isNew	= ($weblink->id < 1);

		// Edit or Create?
		if (!$isNew)
		{
			// Is this link checked out?  If not by me fail
			//if ($model->isCheckedOut($user->get('id'))) {
			//	$mainframe->redirect("index.php?option=$option", "The weblink $weblink->title is currently being edited by another administrator.");
			//}

			// Set page title
			$document->setTitle(JText::_('Links').' - '.JText::_('Edit'));

			//set breadcrumbs
			if($item->query['view'] != 'weblink')
			{
				switch ($item->query['view'])
				{
					case 'categories':
						$pathway->addItem($weblink->category, 'index.php?view=category&id='.$weblink->catid);
						$pathway->addItem(JText::_('Edit').' '.$weblink->title, '');
						break;
					case 'category':
						$pathway->addItem(JText::_('Edit').' '.$weblink->title, '');
						break;
				}
			}
		}
		else
		{
			/*
			 * The web link does not already exist so we are creating a new one.  Here
			 * we want to manipulate the pathway and pagetitle to indicate this.  Also,
			 * we need to initialize some values.
			 */
			$weblink->published = 0;
			$weblink->approved = 1;
			$weblink->ordering = 0;

			// Set page title
			$document->setTitle(JText::_('Links').' - '.JText::_('New'));

			// Add pathway item
			$pathway->addItem(JText::_('New'), '');
		}

		// build list of categories
		$lists['catid'] = JHTML::_('list.category', 'jform[catid]', 'com_weblinks', intval($weblink->catid));

		// build the html select list for ordering
		$query = 'SELECT ordering AS value, title AS text'
			. ' FROM #__weblinks'
			. ' WHERE catid = ' . (int) $weblink->catid
			. ' ORDER BY ordering';

		$lists['ordering'] 			= JHTML::_('list.specificordering',  $weblink, $weblink->id, $query );

		// Radio Buttons: Should the article be published
		$lists['published'] 		= JHTML::_('select.booleanlist',  'jform[published]', 'class="inputbox"', $weblink->published );

		JFilterOutput::objectHTMLSafe( $weblink, ENT_QUOTES, 'description' );

		$this->assign('action', 	$uri->toString());

		$this->assignRef('lists'   , $lists);
		$this->assignRef('weblink' , $weblink);

		parent::display($tpl);
	}
}
?>