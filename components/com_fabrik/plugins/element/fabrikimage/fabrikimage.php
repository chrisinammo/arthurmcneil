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


class FabrikModelFabrikImage  extends FabrikModelElement {

	var $_images = null;

	var $_pluginName = 'image';

	/**
	 * Constructor
	 */

	function __construct()
	{
		parent::__construct();
	}

	/**
	 * shows the data formatted for the table view
	 * @param string data
	 * @param object all the data in the tables current row
	 * @return string formatted value
	 */

	function renderTableData( $data, $oAllRowsData )
	{

		$params =& $this->getParams();
		$selectImage_root_folder = $params->get( 'selectImage_root_folder', '');
		$showImage = $params->get( 'show_image_in_table', 0 );
		if ($showImage) {
			$str = '';
			if (strstr( $this->_groupSplitter, $data )) {
				foreach ($data as $d) {
					$str .= "<img src='" . JPath::clean('/images/stories/' . $selectImage_root_folder . '/' . $d ) ."' alt=\"$d\" /><br/>";
				}
			} else {
				$str .= "<img src='" . JPath::clean('/images/stories/' . $selectImage_root_folder . '/' . $data ) ."' alt=\"$data\" />";
			}
			return  $str;
		}
		//return parent::renderTableData($data, $oAllRowsData );
		return $data;
	}

	/**
	 * shows the data formatted for RSS export
	 * @param string data
	 * @param object all the data in the tables current row
	 * @return string formatted value
	 */

	function renderTableData_rss( $data, $oAllRowsData )
	{
		$params =& $this->getParams();
		$selectImage_root_folder = $params->get( 'selectImage_root_folder', '' );
		return "<img src='" . JURI::base()  . '/images/stories/' . $selectImage_root_folder . '/'. $data . "' />";
	}

	//TODO: front end select running on my localhost doesnt show the correct image
	/**
	 * draws the form element
	 * @param int repeat group counter
	 * @return string returns element html
	 */

	function render( $data, $repeatCounter = 0 )
	{
		$elementHTMLName 	= $this->getHTMLName();
		$params 					=& $this->getParams();
		$align 						= $params->get( 'image_float', 'none');
		$canSelect 				= $params->get( 'image_front_end_select', '0' );
		$imageName 				= $params->get('image_path');
		$imgElementId 		= $this->getHTMLId() . "_img";
		$rootDir 	=  $params->get( 'selectImage_root_folder', '' ) . '/';
		$style = ($align != "none" and $align != "") ?  "style=\"float:$align;\"" :  "";

		if (isset( $data[$elementHTMLName] )) {
			$imageName = $data[$elementHTMLName];
		}
		$str = '';

		if ($canSelect && $this->_editable ) {

			if ($style=='') {
				$str .="<br />";
			} else {
				//$str .="<br style=\"clear:both\"/>";
			}
			$imgPathToShowInDd = '';
			$folderPathToShow = '';
			if (isset( $data[$elementHTMLName] )) {
				$data[$elementHTMLName] = urldecode($data[$elementHTMLName]);
				$imgPathToShowInDd = str_replace( $rootDir, '', $data[$elementHTMLName]);
			} else {
				$imgPathToShowInDd = $imageName;
			}
			$aTmp = explode('/', $imgPathToShowInDd);
			for ($x = 0; $x < count($aTmp)-1; $x++) {
				$folderPathToShow .= '/' . $aTmp[$x];
			}
			$folderPathToShow .= '/';
			$ddId 		= $this->_elementHTMLId . "_dd";
			$ddFolderId = $this->_elementHTMLId . "_folder";
			//$hiddenId =
			/*folder change observed in fbImage class (not here)*/
			echo  JPATH_SITE . '/images/stories/'.  $rootDir;
			$imageFiles = JFolder::files( JPATH_SITE . '/images/stories/'.  $rootDir );
				
			$defImages = array(  JHTML::_('select.option', '', '- Select Image -' ) );
			foreach ($imageFiles as $file) {
				if (eregi( "bmp|gif|jpg|png", $file )) {
					$defImages[] = JHTML::_('select.option', $file );
				}
			}
			$rDir = JPATH_SITE . "/images/stories" .  $rootDir;
			$images = array( );
			$folders = array( );
			$this->readImages( $rDir, "/", $folders, $images, array() );
				
			$images['/'] = $defImages;
			$jsStr = '';
			$imageOpts = array();
			$folderOpts = array( );
			$folderOpts[] = JHTML::_('select.option', "/", JText::_("- Select Folder -") );
			$firstFolderFound = false;
				

			array_unshift($folders, JHTML::_('select.option', "/"));
			if ( is_array( $folders ) ) {
				foreach ( $folders as $oDir ) {
					$dir = $oDir->value;
					//$jsStr .= "el_" . $elementHTMLId . ".addImageListOption('$dir'," . "new Array(";
					$newFolderopt = str_replace( $rDir, '', $dir );
					$folderOpts[] = JHTML::_('select.option', $newFolderopt );
						
					if( array_key_exists( $dir, $images ) ){
						$aImgs = $images[$dir];
						foreach( $aImgs as $oImg ){
							if( $newFolderopt == $folderPathToShow ){
								$imageOpts[] = JHTML::_('select.option',$oImg->value, $oImg->text);
							}
						}
						$jsStr = substr($jsStr, 0, strlen($jsStr)-1 );
						$firstFolderFound = true;
					}
				}
			}
				
			//if no folder selected show the root dir images
			if (empty( $imageOpts )) {
				$imageOpts = $defImages;
			}
				
			$dirPath = JHTML::_('select.genericlist',  $folderOpts, 'ul_directory', 'id="' . $this->getHTMLId() . '_folder" class="inputbox" size="1" ', 'value', 'text', $folderPathToShow, $ddFolderId );
			$str .= $dirPath . "<br />";
			$str .= JHTML::_('select.genericlist',  $imageOpts, $elementHTMLName, ' class="inputbox" size="1" ', 'value', 'text', $imgPathToShowInDd, $ddId );
			$str .="<br/>";
			$str .= "<input type='hidden' id='" . $this->getHTMLId(). "' name='$elementHTMLName' value='" . $imageName . "' />";
		}

		$src = COM_FABRIK_LIVESITE . '/images/stories/' . $imageName;
		if ($params->get('link_url') != "") {
			$str .= "<a href=\"". $params->get('link_url') ." \" target=\"_blank\" />";
			$str .= ('<img '.$style . ' src="' . $src . '" alt="'. $imageName .'" id="' . $imgElementId . '"/>'."\n");
			$str .= "</a>";
		} else {
			$str .= ('<img '.$style. ' src="' . $src . '" alt="'. $imageName .'" id="' . $imgElementId . '"/>'."\n");
		}
		return $str;
	}

	function ajax_GetImages( )
	{

		$params 	= $this->getParams();
		$v = urldecode( JRequest::getVar( 'f', '', 'get' ) );
		$rootDir 	=  $params->get( 'selectImage_root_folder', 'na' );
		$rDir =  JPath::clean(JPATH_SITE . "/images/stories" .  $rootDir . DS . $v . DS);
		$images = array( );
		//echo $rDir;

		$folders = array( );
		$this->readImages( $rDir, "/", $folders, $images, array(), false );
		//echo "looking fdor index $v    ";
		$images = $images['/'];
		$js = "[";
		foreach( $images as $i ){
			$js .= "'$i',";
		}
		$js = rtrim($js, ",");
		$js .= "]";
		echo $js;
	}

	/**
	 * return the javascript to create an instance of the class defined in formJavascriptClass
	 * @return string javascript to create instance. Instance name must be 'el'
	 */

	function elementJavascript()
	{
		global $Itemid;
		$params =& $this->getParams();
		$element =& $this->getElement();
		$id = $this->getHTMLId();
		$selRoot = JURI::base()  . '/images/stories/' . $params->get( 'selectImage_root_folder', '' );
		$opts =& $this->getElementJSOptions();
		$opts->rootDir = $selRoot;
		$opts->Itemid = $Itemid;
		$opts->id = $element->id;
		$opts = FastJSON::encode($opts);
		return " new fbImage('$id', $opts)" ;
	}

	/**
	 * load the javascript class that manages interaction with the form element
	 * should only be called once
	 * @return string javascript class file
	 */

	function formJavascriptClass()
	{
		FabrikHelperHTML::script( 'javascript.js', 'components/com_fabrik/plugins/element/fabrikimage/', true );
	}

	/**
	 *
	 */

	function getFieldDescription()
	{
		return "TEXT";
	}

	/**
	 *
	 */

	function getAdminLists( &$lists )
	{

		/**
		 * IMPORTANT NOTE FOR HACKERS!
		 * 	if your images folder contains massive sub directories which you dont want fabrik
		 * accessing (and hance slowing down to a crawl the loading of this page)
		 * then put the folders in the $ignoreFolders array
		 */
		$params =& $this->getParams();
		$ignoreFolders = array('cache', 'lib', 'install', 'modules', 'themes', 'upgrade', 'locks', 'smarty', 'tmp');
		$images = array( );
		$folders = array( );
		$pathA = JPATH_SITE . '/images/stories';
		$pathL = JURI::base() . '/images/stories/';
		$folders[] = JHTML::_('select.option', '', 'n/a');
		$folders[] = JHTML::_('select.option', '/', '/');
		if ( $params->get('image_path', '') != '' ) {
			$aParts = explode('/', $params->get('image_path', ''));
			$file = array_pop($aParts);
			$pathToFile = '/' . implode('/', $aParts) . '/';
		} else {
			$pathToFile = '/';
			$file = '';
		}
		$model = JModel::getInstance( 'Element', 'FabrikModel' );
		$model->readImages( $pathA, "/", $folders, $images, $ignoreFolders );
		$this->_images = $images;
		$lists['folders'] 	= FabrikHelperHTML::GetImageFolders( $folders, $pathL, $pathToFile );
		$javascript	= "onchange=\"previewImage( )\" onfocus=\"previewImage( )\"";
		$lists['imagefiles']	= JHTML::_('select.genericlist',  $images['/'], 'imagefiles', 'class="inputbox" size="10" multiple="multiple" '. $javascript , 'value', 'text', $file );

		$defRootFolder = $params->get( 'selectImage_root_folder', '');
		$lists['selectImage_root_folder'] 	= JHTML::_('select.genericlist',  $folders, 'params[selectImage_root_folder]', "class=\"inputbox\"  size=\"1\" ", 'value', 'text', $defRootFolder );

	}

	/**
	 *
	 */

	function renderAdminSettings( &$lists )
	{
		$params =& $this->getParams();
		$pluginParams =& $this->getPluginParams();
		$this->getAdminLists( $lists );
		?>
<script language="javascript" type="text/javascript">
			var folderimages = new Array;
			<?php
			$i = 0;
			if (is_array( $this->_images )) {
				foreach ($this->_images as $k=>$items) {
					foreach ($items as $v) {
						echo "folderimages[".$i++."] = new Array( '$k','".addslashes( $v->value )."','".addslashes( $v->text )."' );\n\t\t";
					}
				}
			}
			?>
			function setImageName(){
				var image = document.adminForm.imagefiles;
				var linkurl = document.getElementsByName('params[image_path]')[0];
				linkurl.value =  (image).getValue();
			}
			
			function previewImage(){
				var root = '<?php echo COM_FABRIK_LIVESITE ;?>';
				var file = $('imagefiles').getValue()[0];
				var folder = ($('folders').getValue());
				$('view_imagefiles').src = root + "/images/stories/" + file;
			}
		</script>
<div id="page-<?php echo $this->_name;?>" class="elementSettings"
	style="display: none">
<table class="admintable">
	<tr>
		<td class="paramlist_key"><?php echo JText::_('Image' ); ?></td>
		<td><?php echo $lists['folders'] ;echo "<br />" . $lists['imagefiles']; ?>
		<img name="view_imagefiles" id="view_imagefiles"
			src="<?php echo JURI::base() . '/images/stories/'. $params->get('image_path');?>"
			width="100" /> <br />
		<input type="button" class="input" onclick="setImageName();"
			value="<?php echo JText::_( 'Add' );?>" /></td>
	</tr>
	<tr>
		<td class="paramlist_key"><?php echo JText::_( 'Root folder' );?>:</td>
		<td><?php echo $lists['selectImage_root_folder'];?></td>
	</tr>
</table>
			<?php echo $pluginParams->render();?></div>
			<?php
}

/**
 * used to format the data when shown in the form's email
 * @param string data
 * @return string formatted value
 */

function getEmailValue( $data )
{
	$selectImage_root_folder = $params->get( 'selectImage_root_folder', '' );
	$val =  "<img src='" . JURI::base() . '/images/stories/' . $selectImage_root_folder . '/'. $data . "' />";
	return $val ;
}
}
?>