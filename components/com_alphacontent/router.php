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

function AlphacontentBuildRoute(&$query) {
	$segments = array();
	$db		  = & JFactory::getDBO();

	$section = '';
	$category = '';
	
	if(isset($query['section'])) {
		$section = $query['section'];
		unset($query['section']);
	};
	
	if ( $section=='0' ) $section = "uncategorized";
	
	/* Get section name */
	if ( $section ) {
		switch ( $section ) {
		
			case 'weblinks':
				$section ='weblinks';
				break;
			case 'contacts':
				$section ='contacts';
				break;
			case 'uncategorized':
				$section = urlencode(JText::_('AC_UNCATEGORIZED'));	
				break;
			default:			
				if ( $section > 0 ) {
					$sql = "SELECT `title` FROM `#__sections`
							WHERE `id` = " . $section . " LIMIT 1";
			
					$db->setQuery($sql);
					$section = urlencode($db->loadResult());
					if (!$section) $section = '';				
				} else $section = '';			
		}		
		$segments[] = $section;		
	}


	if(isset($query['category'])) {
		$category = $query['category'];
		unset($query['category']);
	};
	
	/* Get category name */
	if ( $category ) {
		
		$sql = "SELECT `title` FROM `#__categories`
				WHERE `id` = " . $category . " LIMIT 1";

		$db->setQuery($sql);
		$category = urlencode($db->loadResult());
		if (!$section) $category = '';
		
		$segments[] = $category;
		
	}

	return $segments;
}

function AlphacontentParseRoute($segments)
{
	$vars = array();	
	$db	= & JFactory::getDBO();
	
	JPlugin::loadLanguage( 'com_alphacontent' );
	
	// Count route segments
	$count = count($segments);

	if ( $count ) {
	
		$segments[0] = str_replace( '.html', '', $segments[0] );
		
		if ( $segments[0] == urldecode(JText::_('AC_UNCATEGORIZED')) ) $segments[0] = 'uncategorized';
		
		switch ( $segments[0] ) {
			case 'weblinks':
				$vars['section'] = 'weblinks';
				break;
			case 'contacts':
				$vars['section'] = 'contacts';
				break;
			case 'uncategorized': 
				$vars['section'] = '0';
				break;
			default:
				$sql = "SELECT `id` FROM `#__sections`
						WHERE `title` = '" . urldecode($segments[0]) . "' LIMIT 1";
		
				$db->setQuery($sql);
				$section = $db->loadResult();
				
				if (!$section) $section = '';
				$vars['section'] = $section;
		}
		
		if ( $count==2 ) {
		
			echo  $segments[1];
			
			$segments[1] = str_replace( ".html", "", $segments[1] );
			$sql = "SELECT `id` FROM `#__categories`
					WHERE `title` = '" . urldecode($segments[1]) . "' LIMIT 1";
	
			$db->setQuery($sql);
			$category = $db->loadResult();
			if (!$category) $category = '';	
			$vars['category'] = $category;

		}
	}

	return $vars;
}
?>