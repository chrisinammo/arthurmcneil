<?php 
/**
* @package Joomla
* @subpackage Fabrik
* @copyright Copyright (C) 2005 Rob Clayburn. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/

/* MOS Intruder Alerts */
defined('_JEXEC') or die();

/**
 *	image manipulation class
* @author Rob Clayburn <rob@pollen-8.co.uk>
* @version $Revision: 1.0 $
* @since 1.0
* @package pollen8
* @access public
* @copyright Pollen 8 design Ltd
*/

class imageHelper{
	
	/** @var object image manipulation lib, sepecific to library */
	var $_lib = null;
	
	function getLibs(){
		$libs = array();
		$gds = imageHelper::_testGD();
		foreach($gds as $key=>$val){
			$libs[] = JHTML::_('select.option',$key, $val);
		}
		$im = imageHelper::_testImagemagick();
		foreach($im as $key=>$val){
			$libs[] = JHTML::_('select.option',$key, $val);
		}
		return $libs;
	}
	
	/**
	 * load in the correct image library
	 *
	 * @param string image lib to load
	 * @return object image lib
	 */
	function loadLib( $lib ){
		$class = "image" . $lib;
		if(class_exists($class)){
			return new $class();
		}else{
			return JError::raiseError( 500, "can't load class: $class");
		}
	}
	
	function _testGD(){
		$gd = array();
		$GDfuncList = get_extension_funcs('gd');
		ob_start();
		@phpinfo(INFO_MODULES);
		$output=ob_get_contents();
		ob_end_clean();
		$matches[1]='';
		if(preg_match("/GD Version[ \t]*(<[^>]+>[ \t]*)+([^<>]+)/s",$output,$matches)){
			$gdversion = $matches[2];
		}
		if (function_exists('imagecreatetruecolor') && function_exists('imagecreatefromjpeg')) {
			$gd['gd2'] = "GD: " . $gdversion;
		} elseif (function_exists('imagecreatefromjpeg')) {
			$gd['gd1'] = "GD: " . $gdversion;
		}
		return $gd;
	}
	
	function _testImagemagick(){
		if (function_exists("NewMagickWand")) {
			$im["IM"] = "Magick wand";
		}else{
			@exec('convert -version', $output, $status);
			$im = array();
			if(!$status){
				if(preg_match("/imagemagick[ \t]+([0-9\.]+)/i",$output[0],$matches))
				  $im["IM"] = $matches[0] ;
			}
			unset($output, $status);
		}
		return $im;
	}
}

class image{
	var $_thumbPath = null;
	

	function GetImgType( $filename ){
		$info = getimagesize( $filename );
		switch($info[2]) {
			case 1:
				return "gif";
				break;
			case 2:
				return "jpg";
				break;
			case 3:
				return "png";
				break;
			default:
				return false;
		}
	}
	
		function resize( $maxWidth, $maxHeight, $origFile, $destFile )
	{
		echo "this should be overwritten in the library class";
	}
}

class imageGD extends image{
	
	/**
	 * resize an image to a specific width/height using standard php gd graphics lib
	 * @param int maximum image Width (px)
	 * @param int maximum image Height (px)
	 * @param string current images folder pathe (must have trailing end slash)
	 * @param string destination folder path for resized image (must have trailing end slash)
	 * @param string file name of the image to resize
	 * @param bol save the resized image
	 * @return object? image
	 * 
	 */
	function resize( $maxWidth, $maxHeight, $origFile, $destFile )
	{
		/* check if the file exists*/
		if (!JFile::exists ($origFile)) {
			return JError::raiseError(500, "no file found for $origFile");
		}
		/* Load image*/
		$img = null;
		$ext = strtolower(end(explode('.', $origFile)));
		if ($ext == 'jpg' || $ext == 'jpeg') {
			$img = @imagecreatefromjpeg($origFile);
			$header = "image/jpeg";
		} else if ($ext == 'png') {
			$img = @imagecreatefrompng($origFile);
			$header = "image/png";
			/* Only if your version of GD includes GIF support*/
		} else if ($ext == 'gif') {
			if (function_exists(imagecreatefromgif)) {
				$img = @imagecreatefromgif($origFile);
				$header = "image/gif";
			} else {
				return JError::raiseWarning(21,"imagecreate from gif not available");
			}
		}
		/* If an image was successfully loaded, test the image for size*/
		if ($img) {
			/* Get image size and scale ratio*/
			$width = imagesx($img);
			$height = imagesy($img);
			$scale = min($maxWidth / $width, $maxHeight / $height);
			/* If the image is larger than the max shrink it*/
			if ($scale < 1) {
				$new_width = floor($scale * $width);
				$new_height = floor($scale * $height);
				/* Create a new temporary image*/
				$tmp_img = imagecreatetruecolor($new_width, $new_height);
				/* Copy and resize old image into new image*/
				imagecopyresampled($tmp_img, $img, 0, 0, 0, 0,
				$new_width, $new_height, $width, $height);
				imagedestroy($img);
				$img = $tmp_img;
			}
		}
		/* Create error image if necessary*/
		if (!$img) {
			return JError::raiseWarning( 21, "no image created for $origFile, extension = $ext  ");
		}
		/* save the file */
		if ($header == "image/jpeg") {
				imagejpeg($img, $destFile); 
		} else {
			if ($header == "image/png") {
				imagepng($img, $destFile);
			} else {
				/* imagegif($img);*/
				if (function_exists("imagegif")) {
					imagegif($img, $destFile);
				}else{
					/* try using imagemagick to convert gif to png:*/
					$image_file = imgkConvertImage($image_file,$baseDir,$destDir, ".png");
				}
			}
		}
		$this->_thumbPath = $destFile;
	}
}

class imageGD2 extends image{

	
	/**
	 * resize an image to a specific width/height using standard php gd graphics lib
	 * @param int maximum image Width (px)
	 * @param int maximum image Height (px)
	 * @param string current images folder pathe (must have trailing end slash)
	 * @param string destination folder path for resized image (must have trailing end slash)
	 * @param string file name of the image to resize
	 * @param bol save the resized image
	 * @return object? image
	 * 
	 */
	function resize( $maxWidth, $maxHeight, $origFile, $destFile )
	{
	
		/* check if the file exists*/
		if (!JFile::exists ($origFile)) {
			return JError::raiseError(500, "no file found for $origFile");
		}

		/* Load image*/
		$img = null;
		$ext = $this->GetImgType( $origFile );
		if(!$ext){
			return;
		}
		ini_set('display_errors', true);
		$memory = 	ini_get('memory_limit');
		ini_set('memory_limit', '50M');
		
		if ($ext == 'jpg' || $ext == 'jpeg') {
			$img = imagecreatefromjpeg($origFile);
			$header = "image/jpeg";
		} else if ($ext == 'png') {
			$img = imagecreatefrompng($origFile);
			$header = "image/png";
			/* Only if your version of GD includes GIF support*/
		} else if ($ext == 'gif') {
			if (function_exists(imagecreatefromgif)) {
				$img = imagecreatefromgif($origFile);
				$header = "image/gif";
			} else {
				JError::raiseWarning(21, "imagecreate from gif not available");
			}
		}
		/* If an image was successfully loaded, test the image for size*/
		if ($img) {
			
			/* Get image size and scale ratio*/
			$width = imagesx($img);
			$height = imagesy($img);
			$scale = min($maxWidth / $width, $maxHeight / $height);
			/* If the image is larger than the max shrink it*/
			if ($scale < 1) {
				$new_width = floor($scale * $width);
				$new_height = floor($scale * $height);
				/* Create a new temporary image*/
				$tmp_img = imagecreatetruecolor($new_width, $new_height);
				/* Copy and resize old image into new image*/
				imagecopyresampled($tmp_img, $img, 0, 0, 0, 0,
				$new_width, $new_height, $width, $height);
				imagedestroy($img);
				$img = $tmp_img;
			}
			
		}
		if (!$img) {
			JError::raiseWarning(21, "no image created for $origFile, extension = $ext  ");
		} 
		
		/* save the file */
		if ($header == "image/jpeg") {
			if (!imagejpeg($img, $destFile)) {
				//go figure sometimes this returns false but the image is saved??
				JError::raiseWarning(21, "could not create image - $destFile");
			}
		} else {
			if ($header == "image/png") {
				if (!imagepng($img, $destFile)) {
					JError::raiseWarning(21, "could not create image - $destFile");
				}
			} else {
				/* imagegif($img);*/
				if (function_exists("imagegif")) {
					if (!imagegif($img, $destFile)){
						JError::raiseWarning(21, "could not create image - $destFile");
					}
				}else{
					/* try using imagemagick to convert gif to png:*/
					$image_file = imgkConvertImage($image_file,$baseDir,$destDir, ".png");
				}
			}
		}
		$this->_thumbPath = $destFile;
		ini_set('memory_limit', $memory);
	}
}

class imageIM extends image{
	
	var $imageMagickDir = '/usr/local/bin/';

	function imageIM(){
		
	}
					
	/**
	 * resize an image to a specific width/height using imagemagick
	 * you cant set the quality of the resized image
	 * @param int maximum image Width (px)
	 * @param int maximum image Height (px)
	 * @param string full path of image to resize
	 * @param string full file path to save resized image to
	 * @return string output from image magick command
	 */

	function resize($maxWidth, $maxHeight, $origFile, $destFile ){
		
		$ext = $this->GetImgType( $origFile );
		if (!$ext) {
			//false so not an image type so cant resize
			return;
		}
		ini_set('display_errors', true);
		//see if the imagick image lib is installed
		if(class_exists('Imagick')){
		
			$im = new Imagick();
		 
			/* Read the image file */
			$im->readImage( $origFile );
			 
			/* Thumbnail the image ( width 100, preserve dimensions ) */
			$im->thumbnailImage( $maxWidth, $maxHeight, true );
			// $thumb->resizeImage(320,240,Imagick::FILTER_LANCZOS,1);
			 
			/* Write the thumbail to disk */
			$im->writeImage( $destFile);
		 
			/* Free resources associated to the Imagick object */
			$im->destroy();
		} else {
			$resource = NewMagickWand();
			
			if(!MagickReadImage( $resource, $origFile )){
				echo "ERROR!";
				print_r(MagickGetException( $resource ));
			}else{
			}
			$resource = MagickTransformImage( $resource, '0x0', $maxWidth . 'x' . $maxWidth );
			$this->_thumbPath = $destFile;
			MagickWriteImage( $resource, $destFile ); 
		}
	}
}
?>