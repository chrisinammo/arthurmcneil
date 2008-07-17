<?php
/**
* @package Joomla
* @subpackage Fabrik
* @copyright Copyright (C) 2005 Rob Clayburn. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/

/* MOS Intruder Alerts */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );



class InstallerElement extends JObject{
	
	/**
	 * Extension Type
	 * @var	string
	 */

	var $_type = 'fabrikplugin';

	function InstallerElement(){
		require_once('..'.DS.'administrator'.DS.'components'.DS.'com_installer'.DS.'models'.DS.'extension.php');
		require_once(  dirname(__FILE__) .DS."adaptors".DS."fabrikplugin.php" );
	}
	
	function install(){
		$package = $this->_getPackageFromUpload();
		// Was the package unpacked?
		if (!$package) {
			$this->setState('message', JText::_('Unable to find install package'));
			return false;
		}
		
		$installer =& JInstaller::getInstance();
		
		$adaptor = new JInstallerFabrikPlugin( $installer );
		
		$installer->setAdapter( "fabrikplugin", $adaptor );

		// 	Install the package
		if (!$installer->install($package['dir'])) {
			// There was an error installing the package
			$msg = JText::sprintf('INSTALLEXT', JText::_($package['type']), JText::_('Error'));
			$result = false;
		} else {
			// Package installed sucessfully
			$msg = JText::sprintf('INSTALLEXT', JText::_($package['type']), JText::_('Success'));
			$result = true;
		}
		

		// Cleanup the install files
		if (!is_file($package['packagefile'])) {
			$config =& JFactory::getConfig();
			$package['packagefile'] = $config->getValue('config.tmp_path').DS.$package['packagefile'];
		}
		JInstallerHelper::cleanupInstall($package['packagefile'], $package['extractdir']);
		return $result;
	}
	
	function _getPackageFromUpload()
	{
		// Get the uploaded file information
		$userfile = JRequest::getVar('userfile', '', 'files', 'array' );

		// Make sure that file uploads are enabled in php
		if (!(bool) ini_get('file_uploads')) {
			JError::raiseWarning('SOME_ERROR_CODE', JText::_('WARNINSTALLFILE'));
			return false;
		}

		// Make sure that zlib is loaded so that the package can be unpacked
		if (!extension_loaded('zlib')) {
			JError::raiseWarning('SOME_ERROR_CODE', JText::_('WARNINSTALLZLIB'));
			return false;
		}

		// If there is no uploaded file, we have a problem...
		if (!is_array($userfile) || $userfile['size'] < 1) {
			JError::raiseWarning('SOME_ERROR_CODE', JText::_('No file selected'));
			return false;
		}

		// Build the appropriate paths
		$config =& JFactory::getConfig();
		$tmp_dest 	= $config->getValue('config.tmp_path').DS.$userfile['name'];
		$tmp_src	= $userfile['tmp_name'];

		// Move uploaded file
		jimport('joomla.filesystem.file');

		$uploaded = JFile::upload($tmp_src, $tmp_dest);

		// Unpack the downloaded package file
		$package = JInstallerHelper::unpack($tmp_dest);

		return $package;
	}
}

class fabrik_element_installer extends InstallerElement{
	

}

/**
 * install packages
 */
class fabrik_package_installer extends InstallerElement{
	
	function install(){
		$package = $this->_getPackageFromUpload();
		$config =& JFactory::getConfig();
		
		if( !$package ){
			$userfile = JRequest::getVar('userfile', '', 'files', 'array' );
			$script 	= $config->getValue('config.tmp_path').DS.$userfile['name'];
			$installer =& JInstaller::getInstance();
			
			$ar = explode(".", $script);
	$ext = array_pop($ar);
	switch(strtolower($ext)){
		case 'rtf':
			$this->importRTF($script);
			break;
		case 'txt':
			$this->importTxt($script);
			break;
		case 'fdr':
			$this->importFdr($script);
			break;
	}
	
		
		$adaptor = new JInstallerFabrikPlugin( $installer );
		}else{
			//TODO: J1.5 deal with zipped packages
			echo "a zip file - to do - deal with zipped pacakges";
		}
	}
	
function importFdr($script){
	$theData = file_get_contents($script);

}

function importTxt($script){
	$theData = file_get_contents($script);
	$theData = ltrim($theData,  " ");
	$theData = ltrim($theData, "\n");
	$theData = ltrim($theData,  "\r");
	$theData = explode("\n", $theData);
	$newData = array();
	$currentLine = '';
	$firstLine = rtrim($theData[0]);
	$trucLine = ltrim($firstLine, " ");;
	$lastCount = strlen($firstLine) - strlen($trucLine);
	$inScene = false;
	$sceneKey = null;
	foreach ($theData as $key => $thisLine) {
         $trucLine 	= ltrim($thisLine, " ");
         $spaceCount = strlen($thisLine) - strlen($trucLine);
		if(is_null($sceneKey)){
			if( strstr( $trucLine, "INT.") || strstr( $trucLine, "EXT.")){
				$sceneKey = $spaceCount;
				
			}
		}
		 if ($thisLine == "" || $thisLine == "\n" || $thisLine == "\r") unset($theData[$key]);
     }
	$theData = array_values($theData);
	$c  = count($theData);
	$currentLine ='';
	$sceneBuffer = '';
	$actionBuffer = '';
	for($i=0;$i<$c;$i++){
		$thisLine 	= rtrim($theData[$i]);
		$trucLine 	= ltrim($thisLine, " ");
		$spaceCount = strlen($thisLine) - strlen($trucLine);
		
		if($i+1 < $c ){
			$nextLine 		= rtrim($theData[$i+1]);
			$nexttrucLine 	= ltrim($nextLine, " ");;
			$nextspaceCount = strlen($nextLine) - strlen($nexttrucLine);
		}else{
			$nextCount = -10;
		}
		if( $sceneKey == $spaceCount ){ //either an action or a scene heading
			if($trucLine !== strtoupper($trucLine)){
				$actionBuffer .= $trucLine;
				if($inScene && $sceneBuffer != ''){
					$newData['scene'][] = $sceneBuffer;
					$sceneBuffer = '';
				}
				$inAction = true;
				$inScene = false;
			}else{
				$sceneBuffer .= $trucLine;
				if($inAction && $actionBuffer != ''){
					$newData['action'][] = $actionBuffer;
					$actionBuffer = '';
				}
				$inAction = false;
				$inScene = true;
			}
		}else{
			$currentLine .=   $trucLine;
		}
		
		if( $nextspaceCount != $spaceCount ){
			if($actionBuffer != ''){
				$newData['action'][] = $actionBuffer;
			}
			if($sceneBuffer != ''){
				$newData['scene'][] = $sceneBuffer;
			}
			if($currentLine != ''){
				$newData[$spaceCount][] = $currentLine;
			}
			$actionBuffer = '';
			$sceneBuffer = '';
			$currentLine = '';
		}
	}	

	$characters = $newData[35];
	foreach($characters as $key=>$val){
		$characters[$key] = preg_replace("/(\(.*\))/", "", $characters[$key]);
		$characters[$key] = preg_replace("/[^a-z|A-Z|0-9 ]/", "", $characters[$key]);
		
		$characters[$key] = trim(str_replace(array('CONTINUED'), '', $characters[$key]));
	}
	$characters = array_unique($characters);
	?>
	<form name="adminForm" action="index.php" method="post">
	<h1>Characters</h1>
	<table>
	<?php foreach($characters as $c){?>
		<tr><td><input type="checkbox" checked="checked" name="character[]" id="<?php echo $c;?>" value="<?php echo $c;?>"></td>
		<td><label for="<?php echo $c;?>"><?php echo $c;?></label></td></tr>
	<?php }?>
	</table>
	<h1>Sequences</h1>
	Name <input type="field" name="addSequence" id="addSequence" /><br />
	Prefix <input type="field" name="addSequencePrefix" id="addSequencePrefix" /><br />
	<input type="button" id="addSequenceButton" value="Add"/>
	<ol id="sequences">
	</ol>
	<script type="text/javascript">
		window.addEvent('domready', function(e){
			$('addSequenceButton').addEvent('click', function(e){
				var seq = $('addSequence').value;
				var prefix = $('addSequencePrefix').value;
				new Element('li').adopt(
					[
						new Element('input', {'type':'hidden', 'value':seq, 'name':'sequence[]' }),
						new Element('input', {'type':'hidden', 'value':prefix, 'name':'prefix[]' })
					]
				
				).appendText(seq + "/" + prefix ).injectInside($('sequences'));
				
				$$('.sequenceDd').each(function(dd){
					new Element('option', {'value':seq}).appendText(seq).injectInside($(dd));
				});
				new Sortables('sequences');
			});
			
		});
	</script>
	<h1>Scenes</h1>
	<table>
	<?php foreach($newData['scene'] as $c){?>
		<tr><td><input type="checkbox" checked="checked" name="scence[]" id="<?php echo $c;?>" value="<?php echo $c;?>"></td>
		<td><label for="<?php echo $c;?>"><?php echo $c;?></label></td>
		<td><select name="sequence_id[]" class="sequenceDd"></select></td>
		</tr>
	<?php }?>
	</table>
	<input type="hidden" name="option" value="com_fabrik" />
	<input type="hidden" name="task" value="createImportedScript" />
	<input type="submit" name="submit" value="import" />
	<?php
}

function importRTF($script){
	$theData = file_get_contents($script);
	$theData = explode("{", $theData);
	$characters = array();
	$styles = array();
	$aFormattedData = array();
	for($i=0;$i<count($theData);$i++){
		if( substr($theData[$i], 0, 2)== "\s"){
			$s = explode(" ", $theData[$i]);
			$key = explode("\\", $s[0]);
			$key = $key[1];
			if(count($s) > 2){ //ignore the start style tag
				array_shift($s);
				array_shift($s);
				$s = implode(" ", $s);
				$endMarkerLoc = strpos($s, ";}") ;
				$s = substr($s, 0, $endMarkerLoc);
				//unset($s[1]);
				$styles[$key]  =  $s;
				$aFormattedData[$s] = array();
			}
		}
		if( strstr($theData[$i], '\s4') && strstr($theData[$i], '\pard\plain')){
			$characters[]= $theData[$i];
		}
	}
	foreach($styles as $style=>$label){
		$lastFoundLine = -10;
		for($i=0;$i<count($theData);$i++){
			if(strstr($theData[$i], "\\" . "$style\\" ) && strstr($theData[$i], '\pard\plain')){
				
				$s = explode(" ", $theData[$i]); 
				 array_shift($s);
				 array_shift($s);
				 array_shift($s);
				 $s = implode(" ", $s);
				 $s =str_replace( "\par }", "", $s);
				 $s =str_replace( "\par", "", $s);
				 $s =str_replace( array("\line", "\n", "\r", "\rn". "\}", "}"), "", $s);
				 
				 if( $i-1 == $lastFoundLine){
					//echo "shoul merge this line with the previous <br>";
					$lastLine = array_pop($aFormattedData[$label]);
					$s = $lastLine . $s;
				} 
				 
				$aFormattedData[$label][] = $s;
				$lastFoundLine = $i;
			} 
		}
	}
}
}
?>