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


class FabrikModelFabrikVMImage  extends FabrikModelElement {
	
	var $_imageWidth = 200;
	var $_imageHeight = 200;
	var $_maxUploadedSize = null;
	/** @var array allowed file extensions*/
	var $_aDefaultFileTypes = array('.gif', '.jpg', '.png', '.bmp', '.doc', '.xls', 'ppt', '.swf', '.pdf', '.dcr');

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

	function _renderTableData( $data, $oAllRowsData )
	{
		$params =& $this->getParams();
		$i = $params->get('vm_thumb_dir') . "/" . $data;
		return "<img src='$i' />";
	}

	/**
	 * formats the posted data for insertion into the database
	 * @param mixed thie elements posted form data  
	 * @param array posted form data
	 */
		
	function storeDatabaseFormat($val, $data){
		if (is_array( $val )) {
			$val = implode( $this->_groupSplitter, $val );
		}
		return $val;
	}
	
	function ignoreOnUpdate( $val ){
		if( $val == ''){
			return true;
		}
		return false;
	}
	
	/**
	 * checks the posted form data against elements INTERNAL validataion rule - e.g. file upload size / type
	 * @param string elements data
	 * @return bol true if passes / false if falise validation
	 */

	function validate( $data )
	{
		$params = $this->getParams();
		$this->_validationErr = '';
		$elName = $this->getFullName( );
		$elName = str_replace('[]', '', $elName); //remove any repeat group labels
		//echo $elName;
		if( $groupModel->is_join ){
		  $elTempName = str_replace('join', '', $elName);
			$elTempName = str_replace('[', '', $elTempName);
			$joinArray = explode(']', $elTempName);
			$aFile 	=  $_FILES['join'];
			$myFileName = $aFile['name'][$joinArray[0]][$joinArray[1]];
			$myFileSize = $aFile['size'][$joinArray[0]][$joinArray[1]];
		} else {
			$aFile 	=  $_FILES[$elName];
			$myFileName = $aFile['name'];
			$myFileSize = $aFile['size'];
		}
		$ok = true;
		if ( !$this->_fileUploadFileTypeOK( $data, $elName ) ) {
			$this->_validationErr .= JText::_('File type not allowed');
			$ok = false;
		}
		if ( !$this->_fileUploadSizeOK( $elName ) ) {
      $ok = false;
			if( is_array( $myFileName ) ){
				$this->_validationErr .= JText::sprintf( 'The file is too large. The maximum file size is %s KB and your file is %s KB.',  $params->get('ul_max_file_size'), $this->_maxUploadedSize / 1000 );
			}else{
				$mySize = $myFileSize / 1000;
				$this->_validationErr .= JText::sprintf( 'The file is too large. The maximum file size is %s KB and your file is %s KB.',  $params->get('ul_max_file_size'), $mySize );
			}
		}
		return $ok;
	}
	
	/**
	 * This checks the uploaded file type against the csv specified in the upload
	 * element
	 * @access PRIVATE
	 * @param array posted data
	 * @param string element name
	 * @return bol true if upload file type ok 
	 */
	
	function _fileUploadFileTypeOK($data, $elName){
		$params = $this->getParams();
		$allowedFiles = $params->get('ul_file_types') ;
		if($allowedFiles != ''){
			$aFileTypes = explode( ",", $allowedFiles );
		}else{
			$aFileTypes = $this->_aDefaultFileTypes;
		}
		
		$elName = str_replace('[]', '', $elName); //remove any repeat group labels
		if(strstr($elName, 'join')){
		    $elTempName = str_replace('join', '', $elName);
			$elTempName = str_replace('[', '', $elTempName);
			$joinArray = explode(']', $elTempName);
			$aFile 	=  $_FILES['join'];
			$myFileName = $aFile['name'][$joinArray[0]][$joinArray[1]];
		} else {
			$aFile 	=  $_FILES[$elName];
			$myFileName = $aFile['name'];
		}
		
		if(is_array($myFileName)){
			$ok = true;
			foreach($myFileName as $elName){
				$curr_f_ext = strtolower(substr($elName, -4));
				if(!in_array($curr_f_ext, $aFileTypes)){
					$ok = false;
				}
			}
			return $ok;
		}else{
			if($myFileName == ''){
				return true;
			}
			$curr_f_ext = strtolower(substr($myFileName, -4));
			if(in_array($curr_f_ext, $aFileTypes)){
					return true;
			}
		}
		return false;
	}
	
	/**
	 * This checks that thte fileupload size is not greater than that specified in
	 * the upload element
	 * @access PRIVATE
	 * @param string element name
	 * @return bol true if upload file type ok 
	 */ 
	
	function _fileUploadSizeOK( $elName ){
		$params = $this->getParams();
		$max_size = $params->get('ul_max_file_size') * 1000;
		
		$elName = str_replace('[]', '', $elName); //remove any repeat group labels
		if(strstr($elName, 'join')){
		    $elTempName = str_replace('join', '', $elName);
			$elTempName = str_replace('[', '', $elTempName);
			$joinArray = explode(']', $elTempName);
			$aFile 	=  $_FILES['join'];
			$myFileSize = $aFile['size'][$joinArray[0]][$joinArray[1]];
		} else {
			$aFile 	=  $_FILES[$elName];
			$myFileSize = $aFile['size'];
		}
		
		if(is_array($myFileSize)){
			$ok = true;
			foreach($myFileSize as $tmpSize){
				if($tmpSize > $this->_maxUploadedSize){
					$this->_maxUploadedSize = $tmpSize;
				}
				if($tmpSize > $max_size){
					$ok = false;
				}
			}
			return $ok;
		}else{
			$mySize = $myFileSize;
			/* convert kb to bytes */
			
			if ($mySize <= $max_size) {
				return true;
			} 
		}
		return false;
	}
	
	/**
	 * OPTIONAL
	 */
	
	function processUpload( ){
		$aData =& JRequest::get( 'post' );
	  $elName = $elementModel->getFullName(  true,  true, false );
		$groupModel = $this->_group;
		if(strstr($elName, 'join')){
		    $elTempName = str_replace('join', '', $elName);
			$elTempName = str_replace('[', '', $elTempName);
			$joinArray = explode(']', $elTempName);
			$elName = $joinArray[1];
			$aFile 	=  $_FILES['join'];
			$myFileName = $aFile['name'][$joinArray[0]][$joinArray[1]];
			$myTempFileName = $aFile['tmp_name'][$joinArray[0]][$joinArray[1]];
			$aData['join'][$joinArray[0]][$joinArray[1]] = '';
		} else {
			$aFile 	=  $_FILES[$elName];
			$myFileName = $aFile['name'];
			$myTempFileName = $aFile['tmp_name'];
		}
		$_POST[$elName] = '';
		$files = array();
		if(is_array($myFileName)){
			for($i=0;$i<count($myFileName);$i++){
				$fileName 	= $myFileName[$i];
				$tmpFile	= $myTempFileName[$i];
				if(is_array($joinArray)){
				    $myFileDir = $_POST['join'][$joinArray[0]][$joinArray[1]][$i+1]['ul_end_dir'];
					$file = $this->_processIndUpload($oUploader, $fileName, $tmpFile, $i, $elName, $myFileDir );
					$aData['join'][$joinArray[0]][$joinArray[1]][$i][$this->name] = $file;
				} else {
					$files[] = $this->_processIndUpload($oUploader, $fileName, $tmpFile, $i, $elName );
				}
			}
		} else {
			$tmpFile = $myTempFileName;
			$files[] = $this->_processIndUpload($oUploader, $myFileName, $tmpFile, '', $elName );
		}
		if(!is_array($joinArray)){
			$aData[$this->name] = implode("|", $files);
		}
		$aData['product_thumb_image'] = $this->_thumbNailImage;
		return $aData;
	}
	
	/**
	 * ACCESS: restricted
	 * @param object uploader object
	 * @param string file name 
	 * @param string temp uploaded file name
	 * @param mixed int if multiple file uploads from repreat group element, otherwise empty string
	 * @param string element name
	 * @return string  location of uploaded file
	 */
	
	function _processIndUpload(&$oUploader, $myFileName, $tmpFile, $arrayInc, $elName, $myFileDir =''){
		
		$params = $this->getParams();
		$oController 	= new imageController();//imageHelper
		$oImage 		= $oController->loadLib( $params->get( 'image_library' ) );
		$ext = strtolower(end(explode('.', $myFileName)));	
					
		if($myFileDir){
			$ul_end_dir = $myFileDir;
		} else {
			$ul_end_dir = $_POST[$elName]['ul_end_dir'];
		}
		if( $myFileName != '' ){
			$myTargetFolder = $params->get('ul_directory');
			if($ul_end_dir != ''){
				$myTargetFolder .= '/' . $ul_end_dir;
			}
			$oUploader->_makeRecursiveFolders( $myTargetFolder );
			$uploadFolder 	=  JPath::clean( JPATH_SITE . DS . $myTargetFolder .DS);
			$destFile 		= $uploadFolder . md5(uniqid("VirtueMart")) . ".$ext";
			$fileIncrement 	= $params->get('ul_file_increment', 0);
			if ( file_exists( $destFile ) and $fileIncrement ){
				
				$destFile = $oUploader->incrementFileName( $destFile, $destFile, 1 );
				//get the filename with out the path
				$newFileName = explode( "/", $destFile );
				$newFileName = end( $newFileName );
				//update the $_FILES data to contain the new file name
				if($arrayInc == ''){
					$_FILES[$elName]['name'] = $newFileName;
				}else{
					$_FILES[$elName]['name'][$arrayInc] = $newFileName;
				}
			}
			if ( move_uploaded_file( $tmpFile, $destFile ) == false ) {
				$arErrors['ul_userfile'][] = "The file upload was unsuccessful (from $tmpFile to $destFile), please try again";
				$oUploader->moveError = true;
			}else{
				mosChmod( $destFile );
				
				$oImage->resize( $this->_imageWidth, $this->_imageHeight, $destFile, $destFile );
				
				if($params->get( 'make_thumbnail' ) == '1'){
					$thumbPath 		= $params->get('thumb_dir');
					$thumbPrefix 	= $params->get('thumb_prefix');
					$maxWidth 		= $params->get('thumb_max_width');
					$maxHeight 		= $params->get('thumb_max_height');
					$oUploader->_makeRecursiveFolders( $thumbPath );
					$destFolder = $oUploader->addEndSlash( JPATH_SITE ) . $thumbPath . '/';
					$destThumbFile = $destFolder . $thumbPrefix . basename($destFile);
					
					 
					$msg = $oImage->resize( $maxWidth, $maxHeight, $destFile, $destThumbFile );
					$this->_thumbNailImage =  str_replace( $destFolder, '', $destThumbFile );
				}
				return  str_replace( $uploadFolder, '', $destFile );
			}
		}	
	}
	

	/**
	 * draws the form element
	 * @param int repeat group counter
	 * @return string returns element html
	 */
		
	function render( $data, $repeatCounter = 0 ) {
		$elementHTMLName = $this->getHTMLId();
		$groupModel = $this->_group;
		$element = $this->getElement();
		$params 	= $this->getParams();
		if($element->hidden == '1'){
			echo $this->getHiddenField($elementHTMLName, $data[$elementHTMLName], $this->_elementHTMLId );
			return;
		}			
		$str = "";
		if( array_key_exists( 'jos_vm_product___product_thumb_image', $data) ){
			if( $data['jos_vm_product___product_thumb_image'] != '' ){
				$file = $params->get('vm_thumb_dir') . '/' . $data[$elementHTMLName];
				$str =	"<img src='$file' alt='$this->label' /><br />";
			}
		}
		if(!$this->_editable ){
			if(isset($data[$elementHTMLName])){
				return $str;
			}
			return '';
		}
		if (isset ($_FILES[$elementHTMLName]['name'])) {
			$value = $_FILES[$elementHTMLName]['name'];
		} else {
			$value = $this->default;
		}
		$str .= '<input type="hidden" name="'.$elementHTMLName.'[ul_id]" value="'.$value.'" />'."\n";
		if( $params->get('upload_allow_folderselect') == '1'){
			$rDir = JPATH_SITE . "/" .  $params->get('vm_ul_directory');
			$images = array( );
			$folders = array( );
			
			$this->readImages( $rDir, "/", $folders, $images, array() );
			$folderOpts = array();
			if ( is_array( $folders ) ) {
				foreach ( $folders as $oDir ) {
					$dir = $oDir->value;
					$newFolderopt = str_replace( $rDir, '', $dir );
					$folderOpts[] = JHTML::_('select.option', $newFolderopt );
				}
			}
			$folderList = JHTML::_('select.genericlist',  $folderOpts, $elementHTMLName . '[ul_end_dir]', ' class="inputbox" size="1" ', 'value', 'text' );
			$str .= $folderList . "<br />";
		}
		$str .= '<input class="fabrikinput" name="'.$elementHTMLName.'" value="'.$value.'" type="file" id="'. $this->_elementHTMLId .'" />'."\n";
		return $str;
	}
	
	function getFieldDescription()
	{
		return "VARCHAR (255)";
	}
	
	/**
	 * OPTIONAL FUNCTION
	 * code to create lists that are later used in the renderAdminSettings function
	 * @param array list of default values
	 */
	
	function getAdminLists( &$lists )
	{
	}	
	
	/**
	 * 
	 */

	function renderAdminSettings( &$lists )
	{
		$params =& $this->getParams();
		$pluginParams =& $this->getPluginParams();
		$this->getAdminLists( $lists );
		$oImage = new imageController(); //imageHelper
		$imageLibs = $oImage->getLibs();
		$lists['imageLibs'] 		= JHTML::_('select.genericlist',  $imageLibs, 'params[vm '.JText::_( 'Image library' ).']', 'class="inputbox" size="1" ', 'value', 'text', $params->get('vm_image_library') );
		?>
		<div id="page-<?php echo $this->_name;?>" class="elementSettings" style="display:none">
				<?php 
				echo $pluginParams->render( 'params' );
				if ( !empty($imageLibs) ) {
					?> 
					<table class="admintable"><tr><td><?php echo  JText::_( 'Image library' );?></td><td><?php echo $lists['imageLibs'];?></td></tr></table>
					<?php 
					 echo $pluginParams->render( 'params', 'thumbs' );
				}else{
					echo "<table class=\"admintable\"><tr><td colspan='2'>No Image Library found!</td></tr>	</table>";
				}
?>
		</div><?php
	}
	
	/**
	 * used to format the data when shown in the form's email
	 * @param string data
	 * @return string formatted value
	 */
	
	function getEmailValue( $data ){	
			return   $data ;
	}
	
	/**
	 * attach documents to the email
	 * @param string data
	 * @return string formatted value
	 */
	function addEmailAttachement( $data ){
		
		$config		=& JFactory::getConfig();
		$liveSite = JURI::base() ;
		/// todo: check what happens here with open base_dir in effect //
		return str_replace(JURI::base() , JPATH_SITE, $data);

	}
}	
?>