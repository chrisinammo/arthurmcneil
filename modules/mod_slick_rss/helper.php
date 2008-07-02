<?php
/**
* @version	$Id: mod_slick_rss.php 9764 2008-03-22 17:32:11Z davidwhthomas $
* @package	Joomla 1.5
* @copyright	Copyright (C) 2008 David W.H Thomas. All rights reserved.
* @license	GNU/GPL, see LICENSE.php
* Parse and display XML news feeds with mootools DHTML tooltip
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

class modSlickRSSHelper
{
	function getFeed(&$params)
	{
		//global $mainframe;
		$slick_rss = array(); //init feed array
		if(!class_exists('SimplePie')){
			//include Simple Pie processor class
			require_once (JPATH_SITE.DS.'libraries'.DS.'simplepie'.DS.'simplepie.php');
		}
		// check if cache directory exists and is writeable
		$cacheDir =  JPATH_BASE.DS.'cache';	
		if ( !is_writable( $cacheDir ) ) {	
			$slick_rss['error'][] = 'Cache folder is unwriteable. Solution: chmod 777 '.$cacheDir;
			$cache_exists = false;
		}else{
			$cache_exists = true;
		}
		//get local module parameters from xml file module config settings
		$rssurl 		= $params->get( 'rssurl', NULL );
		$rssitems 		= $params->get( 'rssitems', 5 );
		$rssdesc 		= $params->get( 'rssdesc', 1 );
		$rssimage 		= $params->get( 'rssimage', 1 );
		$rssitemtitle_words 	= $params->get( 'rssitemtitle_words', 0 );
		$rssitemdesc		= $params->get( 'rssitemdesc', 0 );
		$rssitemdesc_images	= $params->get( 'rssitemdesc_images', 1 );
		$rssitemdesc_words	= $params->get( 'rssitemdesc_words', 0 );
		$rsstitle		= $params->get( 'rsstitle', 1 );
		$rsscache		= $params->get( 'rsscache', 3600 );
		$link_target		= $params->get( 'link_target', 1 );
		$no_follow		= $params->get( 'no_follow', 0 );	
		$enable_tooltip     	= $params->get( 'enable_tooltip','yes' );
		$tooltip_desc_words	= $params->get( 't_word_count_desc', 25 );
		$tooltip_desc_images	= $params->get( 'tooltip_desc_images', 1 );
		$tooltip_title_words	= $params->get( 't_word_count_title', 25 );
		
		
		if(!$rssurl){
			$slick_rss['error'][] = 'Invalid feed url. Please enter a valid url in the module settings.';
			return $slick_rss; //halt if no valid feed url supplied
		}
		
		switch($link_target){ //open links in current or new window
			case 1:
				$link_target='_blank';
				break;
			case 0:
				$link_target='_self';
				break;
			default:
				$link_target='_blank';
				break;
		}
		$slick_rss['target'] = $link_target;
		if($no_follow){
			$slick_rss['nofollow'] = 'rel="nofollow"';
		}
		
		//Load and build the feed array
		$feed = new SimplePie();
		$feed->set_feed_url($rssurl);
		
		//check and set caching
		if($cache_exists) {
			$feed->set_cache_location($cacheDir);
			$feed->enable_cache();
			$cache_time = (intval($rsscache));
			$feed->set_cache_duration($cache_time);
		}
		else {
			$feed->enable_cache('false');
		}

		$feed->init(); //process the loaded feed
		$feed->handle_content_type();
		//store any error message
		if (isset($feed->error)) {
			$slick_rss['error'][] = $feed->error;
		}
			
		//start building the feed meta-info (title, desc and image)
		// feed title			
		if ( $feed->get_title() && $rsstitle ) {
			$slick_rss['title']['link'] = $feed->get_link();
			$slick_rss['title']['title'] = $feed->get_title();
		}	
		// feed description
		if ( $rssdesc ) {
			$slick_rss['description'] = $feed->get_description();
		}	
		// feed image
		if ( $rssimage && $feed->get_image_url() ) {
			$slick_rss['image']['url'] = $feed->get_image_url();
			$slick_rss['image']['title'] = $feed->get_image_title();
		}		
		//end feed meta-info
		
		//start processing feed items
		//if there are items in the feed
		if($feed->get_item_quantity()){	
		//start looping through the feed items
		$slick_rss_item = 0; //item counter for array indexing in the loop
		foreach ($feed->get_items(0, $rssitems) as $currItem) {
			
			// item title							
			$item_title = trim($currItem->get_title());
			// item title word limit check
			if ( $rssitemtitle_words ) {
				$item_titles = explode( ' ', $item_title );
				$count = count( $item_titles );
				if ( $count > $rssitemtitle_words ) {
					$item_title = '';
					for( $i=0; $i < $rssitemtitle_words; $i++ ) {
						$item_title .= ' '. $item_titles[$i];
					}
					$item_title .= '...';
				}
			}
			$slick_rss['items'][$slick_rss_item]['title'] = $item_title; // Item Title
			$slick_rss['items'][$slick_rss_item]['link'] = $currItem->get_permalink();
			
			// item description
			if($rssitemdesc){
				$desc = trim($currItem->get_description());
				if(!$rssitemdesc_images){
					$desc = preg_replace("/<img[^>]+\>/i", "", $desc); //strip image tags
				}	
				
				//item description word limit check
				if ( $rssitemdesc_words ) {
					$texts = explode( ' ', $desc );
					$count = count( $texts );
					if ( $count > $rssitemdesc_words ) {
						$desc = '';
						for( $i=0; $i < $rssitemdesc_words; $i++ ) {
							$desc .= ' '. $texts[$i]; //build words
						}
						$desc .= '...';
					}
				}
				$slick_rss['items'][$slick_rss_item]['description'] = $desc; //Item Description
			}
			
			// tooltip text
			if ( $enable_tooltip == 'yes' ) {
				
				//tooltip item title
				$t_item_title = trim($currItem->get_title());
				
				// tooltip title word limit check
				if ( $tooltip_title_words ) {
					$t_item_titles = explode( ' ', $t_item_title );
					$count = count( $t_item_titles );
					if ( $count > $tooltip_title_words ) {
						$tooltip_title = '';
						for( $i=0; $i < $tooltip_title_words; $i++ ) {
							$tooltip_title .= ' '. $t_item_titles[$i];
						}
						$tooltip_title .= '...';						
					}else{
						$tooltip_title = $t_item_title;	
					}
				}else{
					$tooltip_title = $t_item_title;	
				}
				
				$tooltip_title = preg_replace("/(\r\n|\n|\r)/", " ", $tooltip_title); //replace new line characters in tooltip title, important!
				$tooltip_title = htmlspecialchars(html_entity_decode($tooltip_title), ENT_QUOTES); //format text for tooltip
				$slick_rss['items'][$slick_rss_item]['tooltip']['title'] = $tooltip_title; //Tooltip Title
				
				//tooltip item description
				$text = trim($currItem->get_description());
				if(!$tooltip_desc_images){
					$text = preg_replace("/<img[^>]+\>/i", "", $text);
				}
				
				// tooltip desc word limit check
				if ( $tooltip_desc_words ) {
					$texts = explode( ' ', $text );
					$count = count( $texts );
					if ( $count > $tooltip_desc_words ) {
						$text = '';
						for( $i=0; $i < $tooltip_desc_words; $i++ ) {
							$text .= ' '. $texts[$i];
						}
						$text .= '...';
					}
				}
				$text = preg_replace("/(\r\n|\n|\r)/", " ", $text); //replace new line characters in tooltip, important!
				$text = htmlspecialchars(html_entity_decode($text), ENT_QUOTES); //format text for tooltip
				$slick_rss['items'][$slick_rss_item]['tooltip']['description'] = $text; //Tooltip Body
			}else{ 
				$slick_rss['items'][$slick_rss_item]['tooltip'] = array(); //blank
			}									
			
			$slick_rss_item++; //increment item counter
		}				
		
		} //end item quantity check if statement
			
		//return the feed data structure for the template	
		return $slick_rss;
	}
}