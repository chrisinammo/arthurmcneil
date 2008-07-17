<?php
/**
* Plugin element to render fields
* @package fabrikar
* @author Rob Clayburn
* @copyright (C) Rob Clayburn
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

require_once(COM_FABRIK_FRONTEND.DS.'helpers'.DS.'image.php');

jimport('joomla.application.component.model');

class FabrikModelfabrikvideo extends FabrikModelElement {

	var $_pluginName = 'fabrikvideo';
	
	var $_maxUploadedSize = null;
	
	/** @var array allowed file extensions*/
	var $_aDefaultFileTypes = array('.mov', '.qtif', '.mp4');
	
	
	/**
	* Constructor
	*/

	function __construct()
	{
		parent::__construct();
		$this->_is_upload = true;
	}
	
	/**
	 * shows the data formatted for the table view
	 * @param string data
	 * @param object all the data in the tables current row
	 * @return string formatted value
	 */

	function renderTableData( $data, $oAllRowsData ){
		$str = '';
		if (strstr( $data, $this->_groupSplitter )) {
			$data = explode($this->_groupSplitter, $data);
			foreach($data as $d){
				$str .= $this->_renderTableData( $d, $oAllRowsData );			
			}
		}else{
			$str .= $this->_renderTableData( $data, $oAllRowsData );
		}
		return $str;
	}

	/**
	 * shows the data formatted for the table view
	 * @param string data
	 * @param object all the data in the tables current row
	 * @return string formatted value
	 */
	
	function _renderTableData( $data, $oAllRowsData )
	{
		$document =& JFactory::getDocument();
		$params =& $this->getParams();
		$str = $data;
		if($params->get('fbVideoShowVideoInTable') == true){
			if($data != ''){
				$data = COM_FABRIK_LIVESITE . '/' . str_replace("\\", "/", $data);
				$url = COM_FABRIK_LIVESITE . "/index.php?option=com_fabrik&tmpl=component&task=elementPluginAjax&plugin=" . $this->_name . "&method=renderPopup&element_id=". $this->_id ."&data=$data";
				FabrikHelperHTML::modal('a.popupwin');
				$w = $params->get('fbVideoWidth', 300)+20;
				$h = $params->get('fbVideoHeight', '300')+50;
				$src = COM_FABRIK_LIVESITE.'/components/com_fabrik/plugins/element/' . $this->_name . '/icon.gif';
				$data = '<a rel="{\'moveable\':true,useOverlay:false,handler: \'iframe\', size: {x: '.$w.', y: '.$h.'}}" href="'. $url.'" class="popupwin"><img src="'. $src . '"alt="' . JText::_('View') .'" /></a>';
			}
		}
		return $data;
	}
	
	function renderPopup()
	{
		$document =& JFactory::getDocument();
		$format 	= JRequest::getVar('format', '');
		JHTML::_('behavior.mootools');
		//when loaded via ajax adding scripts into the doc head wont load them
		echo "<script type='text/javascript'>";
		require('components/com_fabrik/views/form/element.js');
		echo "</script>";
		echo "<script type='text/javascript'>";
		require('components/com_fabrik/plugins/element/fabrikvideo/javascript.js');
		echo "</script>";

		$params =& $this->getParams();
		$value = JRequest::getVar('data');
		$loop 					= ( $params->get('fbVideoLoop', 0) == 1 ) ? 'true' : 'false';
		$autoplay 			= ( $params->get('fbVideoAutoPlay', 0) == 1 ) ? 'true' : 'false'; 
		$controller 		= ( $params->get('fbVideoController', 0) == 1 ) ? 'true' : 'false'; 
		$enablejs 			= ( $params->get('fbVideoEnableJS', 0) == 1 ) ? 'true' : 'false'; 
		$playallframes 	= ( $params->get('fbVideoPlayEveryFrame', 0) == 1 ) ? 'true' : 'false';
		$f = str_replace("\\", "/", $element->default); 
		//	domready works when u load via ajax - loaded doesnt
		$str = "window.addEvent('domready', function(){\n";
		$str .= "var el = new fabrikvideo('video', " . "{'file':'$value'
		, 'width':". $params->get('fbVideoWidth', 300).", 'height':".$params->get('fbVideoHeight', '300')."
		, 'enablejs':true
		, 'controller':" . $controller . "
		, 'autoplay':" . $autoplay. "
		, 'loop':" . $loop . "
		, 'livesite':'" . COM_FABRIK_LIVESITE . "' 
		, 'ENABLEJAVASCRIPT':" . $enablejs . "
		, 'PLAYEVERYFRAME':" . $playallframes . "

		}" .");\n" ;
		$str .="el.insertMovie();\n";
		$str .= "})";
		echo "<script type='text/javascript'>$str</script>";
		?>
		<div id="video_placeholder">vide</div>
		<?php
	}
	
	/**
	 * determines if the element can contain data used in sending receipts, e.g. fabrikfield returns true
	 */
	
	function isReceiptElement()
	{
		return false;
	}
	
		/**
	 * draws the form element
	 * @param int repeat group counter
	 * @return string returns element html
	 */
		
	function render( $data, $repeatCounter = 0 ) 
	{
		$element					=& $this->getElement();
		$value 						= $element->default;
		$elementHTMLName 	= $this->getHTMLName();
		$params 					=& $this->getParams();
		
		$maxlength  = $params->get('maxlength');
		if ($maxlength == "0" or $maxlength == "") {
			$maxlength = $element->width;
		}
	
		$type = ( $params->get('password') == "1" ) ?"password" : "text";

		if( isset($this->_elementError) && $this->_elementError != '' ){
			$type .= " elementErrorHighlight";
		}
		if ( $element->hidden == '1' ) {
			$type = "hidden";
		}
		$sizeInfo =  " size=\"$element->width\" maxlength=\"$maxlength\"";
		if( !$this->_editable ){
			$format = $params->get('text_format_string');
			if ( $format  != '') {
				 $value =  eval( sprintf( $format,$value )) ;
			}
			if ( $element->hidden == '1' ) {
				return "<!--" . $value . "-->";
			} else {
				return  "<div id='". $this->getHTMLId() ."_placeholder'>$value</div>";
			}
		}
		
		$elementHTMLName = str_replace( '.', '___', $elementHTMLName );
		$str .= '<input class="fabrikinput" name="'.$elementHTMLName.'" type="file" id="'. $this->getHTMLId() .'" />'."\n";
		$str .= "<div id='". $this->getHTMLId() ."_placeholder'>$value</div>";
		return $str;
	}
	
	/**
	 * return tehe javascript to create an instance of the class defined in formJavascriptClass
	 * @return string javascript to create instance. Instance name must be 'el'
	 */
	
	function elementJavascript()
	{
		$id = $this->getHTMLId();
		$element	=& $this->getElement();
		$params =& $this->getParams();
		$f = str_replace("\\", "/", $element->default); 
		$value = ( $element->default != '' ) ? COM_FABRIK_LIVESITE . $f : '';
		
		$opts =& $this->getElementJSOptions();
		$opts->file = $value;
		$opts->width = $params->get('fbVideoWidth', 300);
		$opts->height= $params->get('fbVideoHeight', 300);
		$opts->enablejs = true;
		$opts->controller = ( $params->get('fbVideoController', 0) == 1 ) ? true : false;
		$opts->autoplay =   ( $params->get('fbVideoAutoPlay', 0) == 1 ) ? true : false;
		$opts->loop =  ( $params->get('fbVideoLoop', 0) == 1 ) ? true : false;
		$opts->livesite = COM_FABRIK_LIVESITE;
		$opts->ENABLEJAVASCRIPT = ( $params->get('fbVideoEnableJS', 0) == 1 ) ? true : false; 
		$opts->PLAYEVERYFRAME = ( $params->get('fbVideoPlayEveryFrame', 0) == 1 ) ? true : false; 
		$opts = FastJSON::encode($opts);
		return "new fabrikvideo('$id', $opts)";
	}
	
	/**
	 * load the javascript class that manages interaction with the form element
	 * should only be called once
	 * @return string javascript class file
	 */
	
	function formJavascriptClass()
	{
		FabrikHelperHTML::script('javascript.js', 'components/com_fabrik/plugins/element/fabrikvideo/', false);
	}
	
	/**
	 * defines the type of database table field that is created to store the element's data
	 */
	function getFieldDescription()
	{
		$objtype = "VARCHAR (255)";
		return $objtype;
	}
	
	/**
	 * render the element admin settings
	 */

	function renderAdminSettings( )
	{
		$params =& $this->getParams();
		?>
		<div id="page-<?php echo $this->_name;?>" class="elementSettings" style="display:none">
	<?php 
	echo  $params->render();?>
	</div><?php
	}
	
	/**
	 * OPTIONAL
	 *
	 */
	
	function processUpload( )
	{
	  $aData =& JRequest::get( 'post' );
		$elName = $this->getFullName(  true,  true, false );
		if (strstr( $elName, 'join' )) {
			$elTempName = str_replace('join', '', $elName);
			$elTempName = str_replace('[', '', $elTempName);
			$joinArray = explode(']', $elTempName);
			$elName = $joinArray[1];
			$aFile 	=  $_FILES['join'];
			$aFile 		= JRequest::getVar( 'join', '', 'files', 'array' );
			$myFileName = $aFile['name'][$joinArray[0]][$joinArray[1]];
			$myTempFileName = $aFile['tmp_name'][$joinArray[0]][$joinArray[1]];
			$aData['join'][$joinArray[0]][$joinArray[1]] = '';
		} else {
			$aFile 		= JRequest::getVar( $elName, '', 'files', 'array' );
			$myFileName = $aFile['name'];
			$myTempFileName = $aFile['tmp_name'];
		}
		$_POST[$elName] = '';
		$files = array();
		if (is_array( $myFileName )) {
			for( $i=0; $i<count($myFileName); $i++) {
				$fileName 	= $myFileName[$i];
				$tmpFile	= $myTempFileName[$i];
				if (is_array( $joinArray )) {
					$myFileDir = $_POST['join'][$joinArray[0]][$joinArray[1]][$i+1]['ul_end_dir'];
					$file = $this->_processIndUpload($oUploader , $fileName, $tmpFile, $i, $myFileDir, $aFile );
					$aData['join'][$joinArray[0]][$joinArray[1]][$i][$this->name] = $file;
				} else {
					$myFileDir = $aData[$elName]['ul_end_dir'];
					$files[] = $this->_processIndUpload($oUploader, $fileName, $tmpFile, $i, $myFileDir, $aFile );
				}
			}
		} else {
			$tmpFile = $myTempFileName;
			$myFileDir = $aData[$elName]['ul_end_dir'];
			$files[] = $this->_processIndUpload( $oUploader , $myFileName, $tmpFile, '' , $myFileDir, $aFile );
		}
		$group = $this->_group->getGroup();
		if (!$group->is_join) {
			$aData[$elName] = implode("|", $files);
		} else {
			$aData['join'][$group->join_id][$elName] = implode("|", $files);
		}
		return $aData;
	}
	
	/**
	 * 
	 */

	function _processIndUpload( &$oUploader, $myFileName, $tmpFile, $arrayInc, $myFileDir ='', $file ){
		global $mainframe;
		$params = $this->getParams();
		if($params->get('ul_file_types') == ''){
			$params->set('ul_file_types', implode(',', $this->_aDefaultFileTypes));
		}
		$folder = $params->get('ul_directory');
		if($myFileDir != ''){
			$folder .= JPath::clean( JPATH_SITE . DS . $myFileDir );
		}
		$oUploader->_makeRecursiveFolders( $folder );
		
		$folder 	= JPath::clean( JPATH_SITE . DS . $folder );
			
		$err		= null;

		// Set FTP credentials, if given
		jimport('joomla.client.helper');
		JClientHelper::setCredentialsFromRequest('ftp');

		if ( $myFileName != '' ) {
			$filepath = JPath::clean( $folder.DS.strtolower($myFileName) );
			
			if (!uploader::canUpload( $file, $err, $params )) {
				return JError::raiseNotice(100, JText::_($err));
			}
			if (JFile::exists($filepath)) {
				if( $params->get('ul_file_increment', 0) ){
					$filepath = uploader::incrementFileName( $filepath, $filepath, 1 );
				} else{
					return JError::raiseNotice(100, JText::_('A file of that name already exists'));
				}
			}
			if (!JFile::upload($tmpFile, $filepath)) {
				$oUploader->moveError = true;
				JError::raiseWarning(100, JText::_("Error. Unable to upload file (from $tmpFile to $destFile)"));
			} else {
				jimport('joomla.filesystem.path');
				JPath::setPermissions( $destFile );
				//resize main image

				
				$oImage 		= imageHelper::loadLib( $params->get( 'image_library' ) );
				$mainWidth 		= $params->get('fu_main_max_width');
				$mainHeight 	= $params->get('fu_main_max_height');
				if($params->get( 'make_thumbnail' ) == '1'){
					$thumbPath 		=  JPath::clean( $params->get('thumb_dir') . DS . $myFileDir . DS);
					$thumbPrefix 	= $params->get('thumb_prefix');
					$maxWidth 		= $params->get('thumb_max_width');
					$maxHeight 		= $params->get('thumb_max_height');
					if( $thumbPath != '' ){
						$oUploader->_makeRecursiveFolders( $thumbPath );
					}
					$destThumbFile =  JPath::clean(( JPATH_SITE ) . DS . $thumbPath . DS . $thumbPrefix . basename($filepath) );
					$msg = $oImage->resize( $maxWidth, $maxHeight, $filepath, $destThumbFile );
				}
				
				if($mainWidth != '' || $mainHeight != ''){
					$msg = $oImage->resize( $mainWidth, $mainHeight, $filepath, $filepath );
				}
				
				$res = str_replace(JPATH_SITE, '', $filepath);
				return $res;
			}
		}
		
	}
}	

?>