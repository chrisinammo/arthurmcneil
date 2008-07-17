<?php
/**
* @package Joomla
* @subpackage Fabrik
* @copyright Copyright (C) 2005 Rob Clayburn. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();	

/**
 * Version information
 * @package Joomla
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

jimport('joomla.application.component.model');
jimport('joomla.filesystem.file');

class FabrikModelVersion extends JModel {
	/** @var string Product */
	var $PRODUCT 	= 'Fabrik';
	/** @var int Main Release Level */
	var $RELEASE 	= '2.0';
	/** @var string Development Status */
	var $DEV_STATUS = 'Beta2';
	/** @var int Sub Release Level */
	var $DEV_LEVEL 	= '0';
	/** @var int build Number */
	var $BUILD	 	= '$Revision: 782 $';
	/** @var string Date */
	var $RELDATE 	= '7 March 2008';
	/** @var string Time */
	var $RELTIME 	= '16:00';
	/** @var string Timezone */
	var $RELTZ 		= 'UTC';
	/** @var string Copyright Text */
	var $COPYRIGHT 	= "Copyright (C) 2005 - 2007 Rob Clayburn. All rights reserved.";
	/** @var string URL */
	var $URL 		= '<a href="http://www.fabrikar.com">Farbik</a> is Free Software released under the GNU/GPL License.';
	/** last svn revision number before release */
	var $REV = 789;
	
	/** last svn commit downloaded by the user 
	NOTE to devs you have to manually update this file on each commit
	*/
	var $SVNREV = 789;
	/**
	 * codename ***/
  var $CODENAME = 'pixel';
  
  /** enable experimental feautres **/
  var $ADVANCED = true;
		
	var $headers = array(
		'acc'  => 'Accept: %s',
		'cont' => 'Content-Type: %s'
	);
	
	/**
	 * sets the instances admin state
	 * @param bol admin state
	 */

	function setAdmin( $bol )
	{
		$this->_admin = $bol;
	}
	
	function construct_headers($request)
	{
		return array(
			sprintf($this->headers['acc'],  $this->config['response_type']),
			sprintf($this->headers['cont'], $this->config['response_type'])				
		);
	}
	/**
	 * calls the unfuddle api to get the latest svn revision and compares it to the rev
	 * listed in this class 
	 */

	function checkRevision()
	{
		global $mosConfig_absolute_path;
	  if (!function_exists( 'curl_init' )) {
			return JText::_("sorry you need the curl extension to check revision");
			return false;
		}
		$this->_error = '';
		$this->_msg = '';
		$this->config = array(
			'port'             => 80,
			'version'          => 1,
			'account'          => 'account_identifier',
			'response_type'    => 'application/xml',
			'username'         => 'anonymous',
			'password'         => 'anonymous',
			'project'			=> 7429,
			'default_assignee' => 8527,
			'default_milestone' => 0
		);
		
		$headers = array(
			'Content-Type: application/xml',
			'Accept: application/xml'
		);
		$headers = $this->construct_headers('');		
			
		$url = "http://fabrik.unfuddle.com/api/v1/projects/17220/changesets/latest";
		
		$this->connection = curl_init($url);
		
		$xml_string = '';
		$curl_options = array(
			CURLOPT_URL            => $url,
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_VERBOSE => 1,
			CURLOPT_HTTPHEADER     => $headers,
			CURLOPT_SSL_VERIFYHOST => 0,
			CURLOPT_SSL_VERIFYPEER => 0,
			CURLOPT_USERPWD        => 'anonymous:anonymous'
		);
		
		foreach ($curl_options as $key => $value)
		{
			curl_setopt($this->connection, $key, $value);
		}
		
		$xml = $this->handle_response(curl_exec($this->connection));
	//	echo $xml;
		require_once( $mosConfig_absolute_path . "/includes/domit/xml_domit_lite_parser.php");
		$xmlDoc = new DOMIT_Lite_Document();
		
		$ok = $xmlDoc->parseXML( $xml );
		echo "<div>" . $this->getLongVersion() . "</div>";
		if ($ok) {
		 	$this->_msg .= "<p style='color:green'>Version info obtained from SNV server</p>";
		  $rev = $xmlDoc->getElementsByTagName('revision');
		  $rev = $rev->item(0);
		  $lastestRev = $rev->getText();
		  
		  if( $this->SVNREV != $lastestRev ){
		    $this->_msg .= "An update is available from the SVN<br>";
		    $msg = $xmlDoc->getElementsByTagName('message');
		    $msg = $msg->item(0);
		    $date = $xmlDoc->getElementsByTagName('created-at');
		    $date = $date->item(0);
		    $this->_msg .= "<br />message:" . $msg->getText() . "<br>date:" . $date->getText() . "<br><br>";
		  }
		  $this->_msg .= "This release versions revision = '$this->REV' <br>
		  This installations current SVN revision = '$this->SVNREV' <br>
		    Latest available SVN rev = '$lastestRev'<br />";
		} else {
		  $this->_error = JText::_("Unable to parse reseponse");
		}
	}
	
	function handle_response($response, $post = false)
	{
		if (false)
		{
			header('Content-Type: text/xml');
			die($response);
		}
		
		if (curl_errno($this->connection))
		{
			die("ERROR: " . curl_error($this->connection));
		}
		curl_close($this->connection);
		
		if ($post)
		{
			return true;
		}
		return json_decode($response,true);
	}

	/**
	 * @return string Long format version
	 */
	function getLongVersion()
	{
		return $this->PRODUCT .' '. $this->RELEASE .'.'. $this->DEV_LEVEL .' '
			. $this->DEV_STATUS
			.' [ '.$this->CODENAME .' ] '. $this->RELDATE .' '
			. $this->RELTIME .' '. $this->RELTZ;
	}

	/**
	 * @return string Short version format
	 */
	function getShortVersion()
	{
		return $this->RELEASE .'.'. $this->DEV_LEVEL;
	}

	/**
	 * @return string Version suffix for help files
	 */
	function getHelpVersion()
	{
		if ($this->RELEASE > '1.0') {
			return '.' . str_replace( '.', '', $this->RELEASE );
		} else {
			return '';
		}
	}
}
?>