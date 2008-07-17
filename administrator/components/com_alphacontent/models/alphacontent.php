<?php
/*
 * @package Joomla 1.5
 * @copyright Copyright (C) 2005 Open Source Matters. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 *
 * @component AlphaContent
 * @copyright Copyright (C) 2008 Bernard Gilly
 * @license : DonationWare
 * @Website : http://www.alphaplug.com
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

jimport( 'joomla.application.component.model' );

class configurationModelalphacontent extends Jmodel {

	var $_configuration = null;
	
	function __construct(){
		parent::__construct();
	}

	function _set_configuration () {
		require_once (JPATH_ADMINISTRATOR.DS.'components'.DS.'com_alphacontent'.DS.'configuration'.DS.'configuration.php' );

		$this->_configuration = new alphaConfiguration();
	}

	// Saves the configuration;
	function _save_configuration() {

		$configuration = new JRegistry('configuration');
		$config_array = array();

		$config_array['list_homeresult']			= JRequest::getVar('list_homeresult', '0', 'post', 'int');
		$config_array['list_featuredID']			= JRequest::getVar('list_featuredID', '', 'post', 'string');		
		$config_array['list_numcols']				= JRequest::getVar('list_numcols', '0', 'post', 'int');		
		$config_array['list_introstyle']			= JRequest::getVar('list_introstyle', '1', 'post', 'int');		
		$config_array['list_numcharsintro']			= JRequest::getVar('list_numcharsintro', '', 'post', 'int');		
		$config_array['list_titlelinkable']			= JRequest::getVar('list_titlelinkable', '1', 'post', 'int');
		$config_array['list_numindex']				= JRequest::getVar('list_numindex', '1', 'post', 'int');
		$config_array['list_iconnew']				= JRequest::getVar('list_iconnew', '1', 'post', 'int');
		$config_array['list_numdaynew']				= JRequest::getVar('list_numdaynew', '7', 'post', 'int');
		$config_array['list_iconhot']				= JRequest::getVar('list_iconhot', '1', 'post', 'int');
		$config_array['list_numhitshot']			= JRequest::getVar('list_numhitshot', '50', 'post', 'int');
		$config_array['list_showdate']				= JRequest::getVar('list_showdate', 'created', 'post', 'string');
		$config_array['list_formatdate']			= JRequest::getVar('list_formatdate', JText::_( DATE_FORMAT_LC2 ), 'post', 'string');
		$config_array['list_showauthor']			= JRequest::getVar('list_showauthor', '1', 'post', 'int');
		$config_array['list_showsectioncategory']	= JRequest::getVar('list_showsectioncategory', '1', 'post', 'int');
		$config_array['list_showhits']				= JRequest::getVar('list_showhits', '1', 'post', 'int');
		$config_array['list_shownumcomments']		= JRequest::getVar('list_shownumcomments', '0', 'post', 'int');
		$config_array['list_commentsystem']			= JRequest::getVar('list_commentsystem', '0', 'post', 'string');
		$config_array['list_showprint']				= JRequest::getVar('list_showprint', '1', 'post', 'int');
		$config_array['list_showpdf']				= JRequest::getVar('list_showpdf', '1', 'post', 'int');
		$config_array['list_showemail']				= JRequest::getVar('list_showemail', '1', 'post', 'int');
		$config_array['list_showreadmore']			= JRequest::getVar('list_showreadmore', '1', 'post', 'int');
		$config_array['list_showlinkmap']			= JRequest::getVar('list_showreadmore', '0', 'post', 'int');		
		$config_array['list_shownumberpagetotal']	= JRequest::getVar('list_shownumberpagetotal', '1', 'post', 'int');		
		$config_array['list_resultperpage']			= JRequest::getVar('list_resultperpage', '10', 'post', 'int');
		$config_array['list_showsearchbox']			= JRequest::getVar('list_showsearchbox', '1', 'post', 'int');
		$config_array['list_showsearchboxbutton']	= JRequest::getVar('list_showsearchboxbutton', '0', 'post', 'int');
		$config_array['list_showorderinglist']		= JRequest::getVar('list_showorderinglist', '1', 'post', 'int');
		$config_array['list_defaultordering']		= JRequest::getVar('list_defaultordering', 'created DESC', 'post', 'string');
		$config_array['list_showimage']				= JRequest::getVar('list_showimage', '1', 'post', 'int');
		$config_array['list_imageposition']			= JRequest::getVar('list_imageposition', '2', 'post', 'int');
		$config_array['list_widthimage']			= JRequest::getVar('list_widthimage', '120', 'post', 'int');
		$config_array['apikeygooglemap']			= JRequest::getVar('apikeygooglemap', '', 'post', 'string');
		$config_array['zoomlevel']					= JRequest::getVar('zoomlevel', '9', 'post', 'int');
		$config_array['widthgooglemap']				= JRequest::getVar('widthgooglemap', '400', 'post', 'int');
		$config_array['heightgooglemap']			= JRequest::getVar('heightgooglemap', '250', 'post', 'int');
		$config_array['showmaptypemenu']			= JRequest::getVar('showmaptypemenu', '0', 'post', 'int');
		$config_array['showmapcontrolsmenu']		= JRequest::getVar('showmapcontrolsmenu', '1', 'post', 'int');
		$config_array['activeglobalsystemrating']	= JRequest::getVar('activeglobalsystemrating', '1', 'post', 'int');
		$config_array['numstars']					= JRequest::getVar('numstars', '5', 'post', 'int');
		$config_array['widthstars']					= JRequest::getVar('widthstars', '1', 'post', 'int');
		$config_array['showsharethis']				= JRequest::getVar('showsharethis', '0', 'post', 'int');
		//$config_array['sharethiscode']				= JRequest::getVar('sharethiscode', '', 'post', 'string');
		$config_array['sharethiscode']				= stripslashes(str_replace('"', "'", $_POST['sharethiscode']));

		$configuration->loadArray($config_array);
		// Set the configuration filename
		$filename = JPATH_ADMINISTRATOR.DS.'components'.DS.'com_alphacontent'.DS.'configuration'.DS.'configuration.php';

		if ( JPath::isOwner($filename) && !JPath::setPermissions($filename, '0644')) {
			JError::raiseNotice('2002', 'Could not make the ' . $filename . '  writable');
		}

		jimport('joomla.filesystem.file');
		if (JFile::write($filename, $configuration->toString('PHP', 'configuration', array('class' => 'alphaConfiguration')))) {
			return true;
		} else {
			return false;
		}
	}
}
?>