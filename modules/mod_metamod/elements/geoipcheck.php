<?php
/**
* @version		1.5d
* @copyright	Copyright (C) 2007-2008 Stephen Brandon
* @license		GNU/GPL
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

class JElementGeoipcheck extends JElement
{
	/**
	 * Element name
	 *
	 * @access	protected
	 * @var		string
	 */
	var	$_name = 'Geoipcheck';

	function fetchElement($name, $value, &$node, $control_name)
	{
		global $mosConfig_absolute_path;
		$files = $this->geoIPFolders();
		foreach ($files as $file) {
			$country = file_exists(JPATH_SITE.DS.$file.'GeoIP.dat');
			$litecity = file_exists(JPATH_SITE.DS.$file.'GeoLiteCity.dat');
			$city = file_exists(JPATH_SITE.DS.$file.'GeoIPCity.dat');
			$messages = array();
			
			if ($country) {
				$age = intval((time() - filemtime(JPATH_SITE.DS.$file.'GeoIP.dat'))/(24*60*60));
				if ($age > 30) $age = "<span style='color:red;'>File is $age days old. Please update your database from <a href='http://www.maxmind.com/app/ip-location' target='_blank'>MaxMind</a>.</span>";
				else $age = "";
				$messages[] = $file."GeoIP.dat found. All GeoIP Country features enabled. $age";
			}
			if ($litecity) {
				$age = intval((time() - filemtime(JPATH_SITE.DS.$file.'GeoLiteCity.dat'))/(24*60*60));
				if ($age > 30) $age = "<span style='color:red;'>File is $age days old. Please update your database from <a href='http://www.maxmind.com/app/ip-location' target='_blank'>MaxMind</a>.</span>";
				else $age = "";
				$messages[] = $file."GeoLiteCity.dat found. All GeoIP City/region features enabled. $age";
			}
			if ($city) {
				$age = intval((time() - filemtime(JPATH_SITE.DS.$file.'GeoIPCity.dat'))/(24*60*60));
				if ($age > 30) $age = "<span style='color:red;'>File is $age days old. Please update your database from <a href='http://www.maxmind.com/app/ip-location' target='_blank'>MaxMind</a>.</span>";
				else $age = "";
				$messages[] = $file."GeoIPCity.dat found. All GeoIP City/region features enabled. $age";
			}
			
			if ($country || $litecity || $city) {
				return "<b>".implode("<br/>",$messages).'</b>
				<br />Keep your GeoIP databases up to date from
				<a href="http://www.maxmind.com/app/ip-location" target="_blank">MaxMind</a>';
			}
		}
		return '<b>I couldn\'t find any GeoIP database at <i>jooma_root</i>/geoip/GeoIP.dat or GeoFreeCity.dat or GeoIPCity.dat.</b><br />
			If you want to use the GeoIP Country features, please obtain the GeoLite Country or GeoIP Country database
			at <a href="http://www.maxmind.com/app/geolitecountry" target="_blank">MaxMind</a>
			(<a href="http://www.maxmind.com/download/geoip/database/GeoIP.dat.gz">direct download</a>),
			uncompress it, and install it as <i>jooma_root</i>/geoip/GeoIP.dat. For full City and 
			location features, please obtain the GeoLite City or GeoIP City database
			at <a href="http://www.maxmind.com/app/geolitecity" target="_blank">MaxMind</a>,
			uncompress it, and install it as <i>jooma_root</i>/geoip/GeoLiteCity.dat';
	}
	
	function geoIPFolders() {
		return array(
			"geoip".DS,
			"GeoIP".DS,
			"geoIP".DS,
			"GEOIP".DS,
			"GEO IP".DS,
			"",
			"geo_ip".DS,
			"geo_IP".DS,
			"Geo_IP".DS
			);
		
	}
	
}