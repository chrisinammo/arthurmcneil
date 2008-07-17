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

class FabrikModelFabrikFileupload  extends FabrikModelElement {
	
	var $_maxUploadedSize = null;
	
	/**
	* Constructor
	*/

	function __construct()
	{
		parent::__construct();
		$this->_is_upload = true;
	}
	
	function ignoreOnUpdate( $val )
  {
		if ($val == '') {
			return true;
		}
		return false;
	}
	
	function getValue( $data, $repeatCounter = 0 )
  {
		$groupModel =& $this->_group;
		$formModel =& $this->_form;
		$defaultVal = '';
		$data = $_FILES;
		$element =& $this->getElement();
		$group = $groupModel->getGroup();
		if ($groupModel->canRepeat() == '1') {
			$tableName = $formModel->getTableName();
			$fullName = $tableName . $formModel->_joinTableElementStep . $this->name;
			if (isset( $data[$fullName ])) {
				$defaultVal = $data[$fullName];
				if (is_array( $defaultVal ) && array_key_exists( $repeatCounter, $defaultVal )) {
					$defaultVal = $defaultVal[$repeatCounter];
					if (is_array( $defaultVal )) {
						$defaultVal = implode(',', $defaultVal );
					}
					return $defaultVal;		
				}
			}
		}
		//@TODO: load the join once into the group rather than reloading each time
		if ($group->is_join) {
			$join =& JTable::getInstance( 'Join', 'Table');
			$join->load( $group->join_id );
			$fullName = $join->table_join . $formModel->_joinTableElementStep . $element->name;
			if (isset( $data[$fullName ] )) {
				$defaultVal = $data[$fullName];
				if (is_array( $defaultVal ) && array_key_exists( $repeatCounter, $defaultVal )) {
					$defaultVal = $defaultVal[$repeatCounter];	
				}
			} else {
				if (array_key_exists( $fullName, $data['join']['name'][$group->join_id] )) {
					return $data['join']['name'][$group->join_id][$fullName];	
				}
			}
		} else {
			$tableName = $formModel->getTableName();
			$fullName = $tableName . $formModel->_joinTableElementStep . $element->name;
			if (isset( $data[ $fullName ] )) {
				/* drop down  */
				if (is_array( $data[ $fullName ] )) { 
					if (isset( $data[ $fullName ]['value'] )) { 
						/* if not its a file upload el */
						$defaultVal = $data[ $fullName ]['value'];
					}
				} else {
					$defaultVal = $data[$fullName];
				} 
			}
		}
		/** ensure that the data is a string **/
		if (is_array( $defaultVal )) {
			$defaultVal = implode( ',', $defaultVal );
		}
		return $defaultVal;		
	}	
	
	/**
	 * shows the data formatted for the table view
	 * @param string data
	 * @param object all the data in the tables current row
	 * @return string formatted value
	 */

	function renderTableData( $data, $oAllRowsData )
  {
		$str ='';
		if (strstr( $data, $this->_groupSplitter )) {
			$data = explode( $this->_groupSplitter, $data );
			foreach ($data as $d) {
				$str .= $this->_renderTableData( $d, $oAllRowsData ) ;
				$str .= "<br/>";
			}
		}else{
			$str .= $this->_renderTableData( $data, $oAllRowsData );
		}
		return $str;
	}
	
	/**
	 * examine the file being displayed and load in the corresponding
	 * class that deals with its display
	 * @param string file
	 */
	
	function loadElement( $file )
	{
		$ext = JFile::getExt( $file );
		if (JFile::exists( "components/com_fabrik/plugins/element/fabrikfileupload/element/$ext.php" )) {
			require( "components/com_fabrik/plugins/element/fabrikfileupload/element/$ext.php" );
		} else {
			require( "components/com_fabrik/plugins/element/fabrikfileupload/element/default.php" );
		}
		return $render;
	}
	
	/**
	 * Display the file in the table
	 *
	 * @param strng $data
	 * @param array $oAllRowsData
	 * @return string
	 */
	
	function _renderTableData( $data, $oAllRowsData )
	{
		$element =& $this->getElement();
		$params =& $this->getParams();
		if ($params->get( 'fu_show_image_in_table' )  == '0') {
			$render =& $this->loadElement( 'default' );
		} else {
			$render =& $this->loadElement( $data );
		}
		$render->renderTableData( $this, $params, $data );
		return $render->output;
	}
	
	/**
	 * get the thumbnail file for the file given
	 *
	 * @param string $file
	 * @return string thumbnail
	 */
	
	function _getThumb( $file )
	{
		$params =& $this->getParams();
		$ulDir = JPath::clean($params->get('ul_directory'));
		$ulDir = str_replace("\\", "/", $ulDir);
		$file = str_replace($ulDir, $params->get('thumb_dir') , $file);
		$f = basename($file);
		$dir = dirname($file);
		$file = $dir . '/' . $params->get('thumb_prefix') .  $f;
		return $file;
	}

	/**
	 * formats the posted data for insertion into the database
	 * @param mixed thie elements posted form data  
	 * @param array posted form data
	 */
		
	function storeDatabaseFormat( $val, $data )
	{
		if (is_array( $val )) {
			$val = implode($this->_groupSplitter, $val);
		}
		return $val;
	}
	
	/**
	 * checks the posted form data against elements INTERNAL validataion rule - e.g. file upload size / type
	 * @param string elements data
	 * @return bol true if passes / false if falise validation
	 */

	function validate( $data )
	{
		$params =& $this->getParams();
		$groupModel =& $this->_group;
		$group =& $groupModel->getGroup();
		$this->_validationErr = '';
		$errors = array();
		$elName = $this->getFullName( );
		$elName = str_replace('[]', '', $elName); //remove any repeat group labels
		if ($group->is_join) {
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
		
		if (!$this->_fileUploadFileTypeOK( $data, $elName )) {
			$errors[] = JText::_('File type not allowed');
			$ok = false;
		}
		if (!$this->_fileUploadSizeOK( $elName )) {
      $ok = false;
			if (is_array( $myFileName )) {
				$errors[] = JText::sprintf( 'The file is too large. The maximum file size is %s KB and your file is %s KB.',  $params->get('ul_max_file_size'), $this->_maxUploadedSize / 1000 );
			} else {
				$mySize = $myFileSize / 1000;
				$errors[] = JText::sprintf( 'The file is too large. The maximum file size is %s KB and your file is %s KB.',  $params->get('ul_max_file_size'), $mySize );
			}
		}
		$filepath = $this->_getFilePath();
		jimport('joomla.filesystem.file');
	  if (JFile::exists( $filepath )) {
			if (!$params->get( 'ul_file_increment', 0 )) {
				$errors[] = JText::_('A file of that name already exists');
				$ok = false;
			}
		}
		$this->_validationErr = implode('<br />', $errors);
		return $ok;
	}
	
	function _getAllowedExtension()
	{
		$params =& $this->getParams();
		$allowedFiles = $params->get('ul_file_types') ;
		if ($allowedFiles != '') {
			$aFileTypes = explode( ",", $allowedFiles );
		} else {
			$mediaparams =& JComponentHelper::getParams( 'com_media' );
			$aFileTypes = explode( ',', $mediaparams->get( 'upload_extensions' ));
		}
		return $aFileTypes;
	}
	
	/**
	 * This checks the uploaded file type against the csv specified in the upload
	 * element
	 * @access PRIVATE
	 * @param array posted data
	 * @param object upload element
	 * @param string element name
	 * @return bol true if upload file type ok 
	 */
	
	function _fileUploadFileTypeOK( $data, $elName )
	{
		$params =& $this->getParams();
		$aFileTypes = $this->_getAllowedExtension();
		$elName = str_replace('[]', '', $elName); //remove any repeat group labels
		if (strstr( $elName, 'join' )) {
		  $elTempName = str_replace('join', '', $elName);
			$elTempName = str_replace('[', '', $elTempName);
			$joinArray = explode(']', $elTempName);
			$aFile 	=  $_FILES['join'];
			$myFileName = $aFile['name'][$joinArray[0]][$joinArray[1]];
		} else {
			$aFile 	=  $_FILES[$elName];
			$myFileName = $aFile['name'];
		}
		if (is_array( $myFileName )) {
			foreach ($myFileName as $elName) {
				$bits = explode( ".", $name );
				$curr_f_ext = strtolower( array_pop( $bits ) );
				if (in_array( $curr_f_ext, $aFileTypes ) || in_array( ".".$curr_f_ext, $aFileTypes )) {
					return true;
				}
			}
			return false;
		} else {
			if ($myFileName == '') {
				return true;
			}
			$bits = explode( ".", $myFileName );
			$curr_f_ext = strtolower(array_pop( $bits ));
			if (in_array( $curr_f_ext, $aFileTypes ) || in_array( ".".$curr_f_ext, $aFileTypes ) ) {
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
	
	function _fileUploadSizeOK( $elName )
	{
		$params =& $this->getParams();
		$max_size = $params->get('ul_max_file_size') * 1000;
		
		$elName = str_replace('[]', '', $elName); //remove any repeat group labels
		if (strstr( $elName, 'join' )) {
		  $elTempName = str_replace('join', '', $elName);
			$elTempName = str_replace('[', '', $elTempName);
			$joinArray = explode(']', $elTempName);
			$aFile 	=  $_FILES['join'];
			$myFileSize = $aFile['size'][$joinArray[0]][$joinArray[1]];
		} else {
			$aFile 	=  $_FILES[$elName];
			$myFileSize = $aFile['size'];
		}
		
		if (is_array( $myFileSize )) {
			$ok = true;
			foreach ($myFileSize as $tmpSize) {
				if ($tmpSize > $this->_maxUploadedSize) {
					$this->_maxUploadedSize = $tmpSize;
				}
				if ($tmpSize > $max_size) {
					$ok = false;
				}
			}
			return $ok;
		} else {
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
	
	function processUpload( )
	{
	  $aData =& JRequest::get( 'post' );
		$elName = $this->getFullName( true, true, false );
		$groupModel =& $this->_group;
		if (strstr( $elName, 'join' )) {
			$elTempName = str_replace( 'join', '', $elName );
			$elTempName = str_replace( '[', '', $elTempName );
			$joinArray = explode( ']', $elTempName );
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
		$files = array();
		if (is_array( $myFileName )) {
			for ($i=0; $i<count( $myFileName ); $i++) {
				$fileName 	= $myFileName[$i];
				$tmpFile	= $myTempFileName[$i];
				if( is_array( $joinArray )) {
					$myFileDir = $_POST['join'][$joinArray[0]][$joinArray[1]][$i+1]['ul_end_dir'];
					$file = $this->_processIndUpload( $fileName, $tmpFile, $i, $myFileDir, $aFile );
					$aData['join'][$joinArray[0]][$joinArray[1]][$i][$this->name] = $file;
				} else {
					$myFileDir = $aData[$elName]['ul_end_dir'];
					$files[] = $this->_processIndUpload( $fileName, $tmpFile, $i, $myFileDir, $aFile );
				}
			}
		} else {
			$tmpFile = $myTempFileName;
			$myFileDir = (array_key_exists( $elName, $aData )) ? $aData[$elName]['ul_end_dir'] : null;
			$files[] = $this->_processIndUpload( $myFileName, $tmpFile, '' , $myFileDir, $aFile);
		}
		$group =& $this->_group->getGroup();
		if (!$group->is_join) {
			$aData[$elName] = implode("|", $files);
			JRequest::setVar($elName,  implode("|", $files));
		} else {
			//TODO this wont work now!
		  $aData['join'][$group->join_id][$elName] = implode("|", $files);
		}
		return $aData;
	}
	

	
	function _processIndUpload( $myFileName, $tmpFile, $arrayInc, $myFileDir ='', $file)
	{
		global $mainframe;
		$uploader =& $this->_form->getUploader();
		$params = $this->getParams();
		if ($params->get( 'ul_file_types' ) == '') {
			$params->set('ul_file_types', implode(',', $this->_getAllowedExtension()));
		}
		$err		= null;
		// Set FTP credentials, if given
		jimport('joomla.client.helper');
		JClientHelper::setCredentialsFromRequest('ftp');

		if ( $myFileName != '' ) {
			$filepath = $this->_getFilePath();

			if (!uploader::canUpload( $file, $err, $params )) {
				JError::raiseNotice(100, $file .': '. JText::_($err));
			}

			if (JFile::exists($filepath) &&  $params->get('ul_file_increment', 0) ){
					$filepath = uploader::incrementFileName( $filepath, $filepath, 1 );
			}
			if (!JFile::upload($tmpFile, $filepath)) {
				$uploader->moveError = true;
				JError::raiseWarning(100, JText::_("Error. Unable to upload file (from $tmpFile to $destFile)"));
			} else {
				jimport('joomla.filesystem.path');
				
				JPath::setPermissions( $filepath );
				//resize main image
				$oImage 		= imageHelper::loadLib( $params->get( 'image_library' ) );
				$mainWidth 		= $params->get('fu_main_max_width');
				$mainHeight 	= $params->get('fu_main_max_height');
				
				if ($mainWidth != '' || $mainHeight != '') {
					$oImage->resize( $mainWidth, $mainHeight, $filepath, $filepath );
				}
				
				if ($params->get( 'make_thumbnail' ) == '1') {
					$thumbPath 		=  JPath::clean( JPATH_SITE . DS .$params->get('thumb_dir') . DS . $myFileDir . DS);
					$thumbPrefix 	= $params->get('thumb_prefix');
					$maxWidth 		= $params->get('thumb_max_width');
					$maxHeight 		= $params->get('thumb_max_height');
					if ($thumbPath != '') {
						$uploader->_makeRecursiveFolders( $thumbPath, '0777' );
					}
					$destThumbFile =  JPath::clean( $thumbPath . DS . $thumbPrefix . basename($filepath) );
					$oImage->resize( $maxWidth, $maxHeight, $filepath, $destThumbFile );
					if(!JPath::setPermissions( $thumbPath )){
						//JError::raiseWarning(21, 'Couldnt reset thumbnail folder permissions');
					}
					
				}
				JPath::setPermissions( $filepath );
				$res = str_replace(JPATH_SITE, '', $filepath);
				return $res;
			}
		}
	}
	
	/**
	 * get the full server file path for the upload, including the file name i
	 *
	 * @return string path
	 */
	
	function _getFilePath( $aData = null )
	{
	  if (is_null( $aData )) {
	  	$aData   =& JRequest::get( 'post' );
	  }
	  $elName   = $this->getFullName( true, true, false );
	  $params   =& $this->getParams();
	  //@TODO test with fileuploads in join groups
	  $myFileDir    = @array_key_exists( $elName, $aData) ? $aData[$elName]['ul_end_dir'] : '';
	  $myFileName   = @$_FILES[$elName]['name'];
	  $folder = $params->get( 'ul_directory' );
	  $folder  = $folder . DS . $myFileDir;
		$folder = JPath::clean( JPATH_SITE . DS . $folder );
		JPath::check($folder);
		$uploader =& $this->_form->getUploader();
		$uploader->_makeRecursiveFolders( $folder, '0777' );
	  $p =$folder . DS . $myFileName;
	  return JPath::clean( $p );
	}
	
	/**
	 * draws the form element
		 * @param int repeat group counter
	 * @return string returns element html
	 */
		
	function render( $data, $repeatCounter = 0 )
	{
		$id 							= $this->getHTMLId();
		$elementHTMLName 	= $this->getHTMLName();
		$element 					=& $this->getElement();
		$params 					=& $this->getParams();
		if ($element->hidden == '1') {
			return $this->getHiddenField( $elementHTMLName, $data[$elementHTMLName], $this->_elementHTMLId );
		}		
		$str = "";
		
		$value = $element->default;
		$ulDir = $params->get( 'ul_directory' );
		
		if ($params->get( 'fu_show_image' )  == '1') {
			$render =& $this->loadElement( $value );
			$render->renderTableData( $this, $params, $value );
			$str = $render->output;
			if (!$this->_editable) {
				return $str;
			}
		}
		if (!$this->_editable) {
			return $str;
		}
		$str .=  "<br />";
		if ($params->get('upload_allow_folderselect') == '1') {
			$rDir		= JPATH_SITE . "/" .  $params->get('ul_directory');
			$images 	= array( );
			$folders 	= array( );
			$this->readImages( $rDir, "/", $folders, $images, array() );
			$folderOpts = array();
			if (is_array( $folders )) {
				foreach ($folders as $oDir) {
					$dir = $oDir->value;
					$newFolderopt = str_replace( $rDir, '', $dir );
					$folderOpts[] = JHTML::_('select.option', $newFolderopt );
				}
			}
			$folderList = JHTML::_('select.genericlist',  $folderOpts, $elementHTMLName . '[ul_end_dir]', ' class="inputbox" size="1" ', 'value', 'text' );
			$str .= $folderList . "<br />";
		}
		$str .= '<input class="fabrikinput" name="'.$elementHTMLName.'" type="file" id="'.$this->_elementHTMLId.'" />'."\n";
		return $str;
	}
	
	function getFieldDescription()
	{
		return "TEXT";
	}
	
	function renderAdminSettings( &$lists )
	{
		$params =& $this->getParams();
		$pluginParams =& $this->getPluginParams();
		?>
		<div id="page-<?php echo $this->_name;?>" class="elementSettings" style="display:none">
		<?php $this->maxUpload(); ?>
			<?php echo $pluginParams->render();?>
			<fieldset>
				<legend>
					<?php echo JText::_('Display');?>
				</legend>	
				<?php echo $pluginParams->render( 'params', 'display' );?>
			</fieldset>
			<fieldset>
				<legend>
					<?php echo JText::_('Thumbnail');?>
				</legend>
				<?php echo $pluginParams->render( 'params', 'thumbnail' );?>
			</fieldset>
		</div><?php
	}
	
	/**
	 * used to format the data when shown in the form's email
	 * @param string data
	 * @return string formatted value
	 */
	
	function getEmailValue( $data )
	{	
			return $data ;
	}
	
	/**
	 * attach documents to the email
	 * @param string data
	 * @return string formatted value
	 */
	
	function addEmailAttachement( $data )
	{
		/// @TODO: check what happens here with open base_dir in effect //
		$config		=& JFactory::getConfig();
		return str_replace(JURI::base() , JPATH_SITE, $data);
	}
	
	/**
	 * If a database join element's value field points to the same db field as this element
	 * then this element can, within modifyJoinQuery, update the query.
	 * E.g. if the database join element points to a file upload element then you can replace
	 * the file path that is the standard $val with the html to create the image
	 *
	 * @param string $val
	 * @param string view form or table
	 * @return string modified val
	 * @TODO: base the returned string completely on the params specified for the element
	 * e.g. thumbnail, show image, link etc
	 */

	function modifyJoinQuery( $val, $view='form' )
	{
		$params =& $this->getParams();
		if( !$params->get( 'fu_show_image', 0 ) && $view == 'form'){
			return $val;
		}
		if( $params->get( 'make_thumbnail')){
			$ulDir = JPath::clean($params->get('ul_directory')) . DS;
			$ulDir = str_replace("\\", "\\\\", $ulDir);
			$thumbDir = $params->get('thumb_dir');
			$thumbDir = JPath::clean($params->get('thumb_dir')) . DS;
			$thumbDir = str_replace("\\", "\\\\", $thumbDir);
			$thumbDir .= $params->get('thumb_prefix') ;
				
			$str = "CONCAT('<img src=\"".COM_FABRIK_LIVESITE."',".
			"REPLACE(".
 			"REPLACE($val, '$ulDir', '".$thumbDir."')".	//replace the main image dir with thumb dir
			", '\\\', '/')".														//replace the backslashes with forward slashes
			", '\" alt=\"database join image\" />')";
			
		}else{
			$str = " REPLACE(CONCAT('<img src=\"".COM_FABRIK_LIVESITE. "' , $val, '\" alt=\"database join image\"/>'), '\\\', '/') ";
		}
		return $str;
	}
	
	/**
	 * trigger called when a row is deleted
	 *
	 */
	function onDeleteRows( $rows )
	{
		require_once( COM_FABRIK_FRONTEND.DS.'helpers'.DS.'uploader.php' );
		$params =& $this->getParams();
		if ($params->get('upload_delete_image')) {
			jimport('joomla.filesystem.file');
			$elName   = $this->getFullName( true, true, false );
			foreach($rows as $row){
				$file = JPath::clean( JPATH_SITE . DS . $row->$elName );
				$thumb = JPath::clean( $this->_getThumb($file) );
				if (JFile::exists( $file )) {
					JFile::delete( $file );
				}
				if (JFile::exists( $thumb )) {
					JFile::delete( $thumb );
				}
			}
		}	
	}
	
	/**
	 * get the max upload size allowed by the server.
	 * @return int kilobyte upload size
	 */
	
	function maxUpload()
	{
		$postkb 	= str_replace("M", "", ini_get('post_max_size')) * 1000;
		$uploadkb = str_replace("M", "", ini_get('upload_max_filesize')) * 1000;
		if ($uploadkb < $postkb) {
			$postkb = $uploadkb;
		}
		return $postkb;
	}
}	
?>