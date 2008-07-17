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
	
	var $_oTable 	= null;
	var $_data 		= null;
	var $_lists 	= null;
	var $_pageNav 	= null;
	var $_params 	= null;
	var $_aLinkElements = null;
	
	function FabrikViewTable( &$oTable ){
		$this->_oTable = $oTable;
	}
	
	function display(){
		$model			= &$this->getModel();
		$model->setId( JRequest::getInt('tableid') );
		$table 			=& $model->getTable();
		$params 		=& $model->getParams();
		$model->render( );
		$this->emptyDataMessage = $params->get( 'empty_data_msg' ) ;
		$ret = $model->_getTableHeadings( );
		$headings = $ret[0];

		//$safeHtmlFilter = & JFilterInput::clear(null, null, 1, 1);
		$useragent = JFilterInput::clean($_SERVER['HTTP_USER_AGENT'], 'none');
		
		$phpver = phpversion();
		//$canZip = mosGetParam( $_SERVER, 'HTTP_ACCEPT_ENCODING', '' );
		$canZip = JFilterInput::clean($_SERVER['HTTP_ACCEPT_ENCODING'], 'none');
		
		if ( $phpver >= '4.0.4pl1' &&
				( strpos($useragent,'compatible') !== false ||
					strpos($useragent,'Gecko') !== false
				)
			) {
			// Check for gzip header or northon internet securities
			if ( isset($_SERVER['HTTP_ACCEPT_ENCODING']) ) {
				$encodings = explode(',', strtolower($_SERVER['HTTP_ACCEPT_ENCODING']));
			}
			if ( (in_array('gzip', $encodings) || isset( $_SERVER['---------------']) ) && extension_loaded('zlib') && function_exists('ob_gzhandler') && !ini_get('zlib.output_compression') && !ini_get('session.use_trans_sid') ) {
				// You cannot specify additional output handlers if
				// zlib.output_compression is activated here
				ob_start( 'ob_gzhandler' );
			}
		} else if ( $phpver > '4.0' ) {
			if ( strpos($canZip,'gzip') !== false ) {
				if (extension_loaded( 'zlib' )) {
					$do_gzip_compress = TRUE;
					ob_start();
					ob_implicit_flush(0);

					header( 'Content-Encoding: gzip' );
				}
			}
		}
		
		header('Content-Type: text/plain');
		header('Content-Disposition: attachment; filename="' . $table->label . '-export.csv"');
	
		$str = '';
		echo implode( $headings, ",") . "\n";	  	
		foreach ($model->_tableData as $group) {
			foreach ($group as $row) {
				echo implode(",", array_map(array($this, "_quote"), array_values(  JArrayHelper::fromObject( $row ) )));
				echo "\n";
			}
		}
	}
	
	function _quote($n) {
		return '"'.str_replace('"', '""', $n).'"'; 
	}
	
	
}

?>