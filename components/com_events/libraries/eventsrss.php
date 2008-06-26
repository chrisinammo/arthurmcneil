<?php
/**
* @version $Id: eventsrss.php 963 2008-02-16 10:59:26Z geraint $
* @package Joomla
* @subpackage Eventscalrss
* @copyright (C) 2004 - 2005 Open Source Matters. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* Joomla! is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

// load feed creator class
require_once( JPATH_SITE .'/includes/feedcreator.class.php' );

$info	=	null;
$rss	=	null;

/*
* Creates feed from Events that are published and take place now or in the future
*/
function feedOpenEvents( $showFeed ) {

	global  $mainframe;
	$cfg = & EventsConfig::getInstance();
	$option = $cfg->get("com_componentname");
	$db	=& JFactory::getDBO();
	$lang =& JFactory::getLanguage();
	$langname = $lang->getBackwardLang();

	$nullDate = $db->getNullDate();

	$cfg = & EventsConfig::getInstance();

	$jEventsView = $cfg->get('com_calViewName',"default");

	$now 	= date( 'Y-m-d H:i:s', time() + $mainframe->getCfg('offset') * 60 * 60 );

	// parameter intialization
	$info[ 'date' ] 		= date( 'r' );
	$info[ 'year' ] 		= date( 'Y' );
	$info[ 'encoding' ] 	= "utf-8";
	$info[ 'link' ] 		= htmlspecialchars( JURI::root() );
	$info[ 'cache' ] 		= $cfg->get( 'com_rss_cache', 1 );
	$info[ 'cache_time' ] 	= $cfg->get( 'com_rss_cache_time', 3600 );
	$info[ 'count' ]		= $cfg->get( 'com_rss_count', 5 );
	$info[ 'orderby' ] 		= $cfg->get( 'com_rss_orderby', '' );
	// LANGUAGE FILE
	$info[ 'title' ] 		= $cfg->get( 'com_rss_title', 'Powered by Joomla!' );
	$info[ 'description' ] 	= $cfg->get( 'com_rss_description', 'Joomla! Events Calendar syndication' );

	$info[ 'image_file' ]	= $cfg->get( 'com_rss_image_file', 'joomla_atom.png' );
	if ( $info[ 'image_file' ] == -1 ) {
		$info[ 'image' ]	= NULL;
	} else{
		$info[ 'image' ]	= JURI::root() . '/images/M_images/'. $info[ 'image_file' ];
	}
	$info[ 'image_alt' ] 	= $cfg->get( 'com_rss_image_alt', 'Powered by Joomla!' );
	$info[ 'limit_text' ] 	= $cfg->get( 'com_rss_limit_text', 1 );
	$info[ 'text_length' ] 	= $cfg->get( 'com_rss_text_length', 20 );
	// get feedtype from url
	$info[ 'feed' ] = JRequest::getVar( 'feed', 'RSS2.0',"get" );
	// live bookmarks
	$info[ 'live_bookmark' ]	= $cfg->get( 'com_rss_live_bookmark', '' );
	$info[ 'bookmark_file' ]	= $cfg->get( 'com_rss_bookmark_file', '' );

	$conf =& JFactory::getConfig();
	// set filename for live bookmarks feed
	if ( !$showFeed & $info[ 'live_bookmark' ] ) {
		if ( $info[ 'bookmark_file' ] ) {
			// custom bookmark filename
			$info[ 'file' ] = JPATH_SITE .$conf->getValue('config.cache_path'). $info[ 'bookmark_file' ];
		} else {
			// standard bookmark filename
			$info[ 'file' ] = JPATH_SITE .$conf->getValue('config.cache_path'). $info[ 'live_bookmark' ];
		}
	} else {
		// set filename for rss feeds
		$feed = $info["feed"];
		$info[ 'file' ] = strtolower( str_replace( '.', '', $feed ) );
		$info[ 'file' ] = JPATH_SITE .$conf->getValue('config.cache_path'). $info[ 'file' ] .'.xml';
	}

	$filename = $info[ 'file' ].md5($option.$langname) .'.xml';

	$info[ 'file' ] =  $filename;

	// load feed creator class
	$rss = new UniversalFeedCreator();
	// load image creator class
	$image = new FeedImage();

	// loads cache file
	if ( $showFeed && $info[ 'cache' ] ) {
		$rss->useCached( $info[ 'feed' ], $info[ 'file' ], $info[ 'cache_time' ] );
	}

	$rss->title 			= $info[ 'title' ];
	$rss->description 		= $info[ 'description' ];
	$rss->link 				= $info[ 'link' ];
	$rss->syndicationURL 	= $info[ 'link' ];
	$rss->cssStyleSheet 	= NULL;
	$rss->encoding 			= $info[ 'encoding' ];

	if ( $info[ 'image' ] ) {
		$image->url 		= $info[ 'image' ];
		$image->link 		= $info[ 'link' ];
		$image->title 		= $info[ 'image_alt' ];
		$image->description	= $info[ 'description' ];
		// loads image info into rss array
		$rss->image 		= $image;
	}


	// setup for all required function and classes
	$file = JPATH_SITE . "/components/$option/includes/modutils.php";
	if (file_exists($file) ) {
		include_once($file);
	} else {
		die ("Events Latest\n<br />This module needs the Events component");
	}

	// load language constants
	EventsHelper::loadLanguage('modlatest');

	// include the appropraite VIEW - this should be based on config and/or URL?
	$JEventsModCalClass = EventsViewer::viewClassName("mod_latest");

	$jeventCalObject = & new $JEventsModCalClass($cfg);
	$jeventCalObject->getLatestEventsData();
	$eventsByRelDay = $jeventCalObject->eventsByRelDay;

	foreach ($eventsByRelDay as $relDay => $ebrd) {
		foreach ($ebrd as $row) {
			// title for particular item
			$item_title = htmlspecialchars( $row->title() );
			$item_title = html_entity_decode( $item_title );

			// url link to article
			$startDate = $row->publish_up();
			$eventDate = mktime(substr($startDate,11,2),substr($startDate,14,2), substr($startDate,17,2),
					$jeventCalObject->now_m,$jeventCalObject->now_d + $relDay,$jeventCalObject->now_Y);

			
			$link = $row->viewDetailLink(date("Y", $eventDate),date("m", $eventDate),date("d", $eventDate),false);
			$item_link  = JURI::root().JRoute::_($link.$jeventCalObject->datamodel->getItemidLink().$jeventCalObject->datamodel->getCatidsOutLink());
			// & used instead of &amp; as this is converted by feedcreator
			$item_link = str_replace("&amp;","&",$item_link);
			
			// removes all formating from the intro text for the description text
			$item_description = $row->content();
			$item_description = JFilterOutput::cleanText( $item_description );
			if ( $info[ 'limit_text' ] ) {
				if ( $info[ 'text_length' ] ) {
					// limits description text to x words
					$item_description_array = split( ' ', $item_description );
					$count = count( $item_description_array );
					if ( $count > $info[ 'text_length' ] ) {
						$item_description = '';
						for ( $a = 0; $a < $info[ 'text_length' ]; $a++ ) {
							$item_description .= $item_description_array[$a]. ' ';
						}
						$item_description = trim( $item_description );
						$item_description .= '...';
					}
				} else  {
					// do not include description when text_length = 0
					$item_description = NULL;
				}
			}

			// type for particular item - category name (use cat id for now!)
			$item_type = ( $row->catid() );
			// organizer for particular item
			$item_organizer = htmlspecialchars( $row->contact_info() );
			$item_organizer = html_entity_decode( $item_organizer );
			// location for particular item
			$item_location = htmlspecialchars( $row->location() );
			$item_location = html_entity_decode( $item_location );
			// start date for particular item
			$item_startdate = htmlspecialchars( $row->publish_up());
			// end date for particular item
			$item_enddate = htmlspecialchars( $row->publish_down() );


			// load individual item creator class
			$item = new FeedItem();
			// item info
			$item->title 		= $item_title;
			$item->link 		= $item_link;
			$item->description 	= $item_description;
			$item->source 		= $info[ 'link' ];

			$item->type 		= $item_type;
			$item->organizer 	= $item_organizer;
			$item->location 	= $item_location;
			$item->startdate 	= $item_startdate;
			$item->enddate 		= $item_enddate;

			// loads item info into rss array
			$rss->addItem( $item );
		}
	}

	// save feed file
	$rss->saveFeed( $info[ 'feed' ], $info[ 'file' ], $showFeed );
}
?>
