<?php
/**
* @package Joomla
* @subpackage Fabrik
* @copyright Copyright (C) 2005 Rob Clayburn. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

jimport( 'joomla.application.component.model' );

/**
 * install packages
 */
class FabrikModelImport extends JModel{ // extends InstallerElement

	/**
	 *
	 */

	function setId( $id )
	{
		$this->_id = $id;
	}

	/**
	 *
	 */

	function setAdmin( $admin )
	{
		$this->_admin = $admin;
	}

	/**
	 *
	 */

	function install(){
		$package = $this->_getPackageFromUpload();
		$config =& JFactory::getConfig();

		if( !$package ){
			$userfile 	= JRequest::getVar('userfile', '', 'files', 'array' );
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
	<tr>
		<td><input type="checkbox" checked="checked" name="character[]"
			id="<?php echo $c;?>" value="<?php echo $c;?>"></td>
		<td><label for="<?php echo $c;?>"><?php echo $c;?></label></td>
	</tr>
	<?php }?>
</table>
<h1>Sequences</h1>
Name <input type="field" name="addSequence" id="addSequence" /><br />
Prefix <input type="field" name="addSequencePrefix"
	id="addSequencePrefix" /><br />
<input type="button" id="addSequenceButton" value="Add" />
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
	<tr>
		<td><input type="checkbox" checked="checked" name="scence[]"
			id="<?php echo $c;?>" value="<?php echo $c;?>"></td>
		<td><label for="<?php echo $c;?>"><?php echo $c;?></label></td>
		<td><select name="sequence_id[]" class="sequenceDd"></select></td>
	</tr>
	<?php }?>
</table>
<input type="hidden" name="option" value="com_fabrik" /> <input
	type="hidden" name="task" value="createImportedScript" /> <input
	type="submit" name="submit" value="import" /> <?php
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

class FabrikModelImportCsv extends FabrikModelImport{

	var $headings = null;
	var $data = null;

	/**
	 * checks uploaded file, and installs it
	 */

	function checkUpload(){
		if (!(bool)ini_get('file_uploads')) {
			echo "The installer can't continue before file uploads are enabled. Please use the install from directory method.";
			return false;
		}
		$userfile = mosGetParam( $_FILES, 'userfile', null );
		if (!$userfile) {
			echo 'No file selected<br />';
			return false;
		}
		$userfile_name = $userfile['name'];
		$msg = '';
		$resultdir = $this->uploadFile( $userfile['tmp_name'], $userfile['name'], $msg );
		if ($resultdir !== false) {
			$this->readCSV($userfile['name']);

		} else {
			echo $msg . '  Upload Error<br />';
			return false;
		}
		return true;
	}

	/**
	 * read the CSV file, store results in $this->headings and $this->data
	 */

	function readCSV( $userfile_name ){
		global $mosConfig_absolute_path, $database;
		$baseDir 			= mosPathName( $mosConfig_absolute_path . '/media' );
		$file_handle 		= fopen($baseDir . '/' . $userfile_name, "r");
		$this->headings 	= array();
		$this->data 		= array();
		$field_delimiter 	= JRequest::getVar( 'field_delimiter', ',' );
		$text_delimiter 	= stripslashes( JRequest::getVar( 'text_delimiter', '"' ) );
		$table 				= JRequest::getVar( 'table_name', '' );
		$csv				 = & new csv_bv($baseDir . '/' . $userfile_name, $field_delimiter, $text_delimiter, '\\');
		$csv->SkipEmptyRows(TRUE); // Will skip empty rows. TRUE by default. (Shown here for example only).
		$csv->TrimFields(TRUE); // Remove leading and trailing \s and \t. TRUE by default.

		while ($arr_data = $csv->NextLine()){
			if(empty($this->headings)){
				$this->headings =  $arr_data;
			}else{
				$this->data[] = $arr_data;
			}
		}
		fclose($file_handle);
	}
}

/********************** */

/**
 * This class will parse a csv file in either standard or MS Excel format.
 * Two methods are provided to either process a line at a time or return the whole csv file as an array.
 *
 * It can deal with:
 * - Line breaks within quoted fields
 * - Character seperator (usually a comma or semicolon) in quoted fields
 * - Can leave or remove leading and trailing \s or \t
 * - Can leave or skip empty rows.
 * - Windows and Unix line breaks dealt with automatically. Care must be taken with Macintosh format.
 *
 * Also, the escape character is automatically removed.
 *
 * NOTICE:
 * - Quote character can be escaped by itself or by using an escape character, within a quoted field (i.e. "" or \" will work)
 *
 * USAGE:
 *
 * include_once 'class.csv_bv.php';
 *
 * $csv = & new csv_bv('test.csv', ';', '"' , '\\');
 * $csv->SkipEmptyRows(TRUE); // Will skip empty rows. TRUE by default. (Shown here for example only).
 * $csv->TrimFields(TRUE); // Remove leading and trailing \s and \t. TRUE by default.
 *
 * while ($arr_data = $csv->NextLine()){
 *
 *         echo "<br><br>Processing line ". $csv->RowCount() . "<br>";
 *         echo implode(' , ', $arr_data);
 *
 * }
 *
 * echo "<br><br>Number of returned rows: ".$csv->RowCount();
 * echo "<br><br>Number of skipped rows: ".$csv->SkippedRowCount();
 *
 * ----
 * OR using the csv2array function.
 * ----
 *
 * include_once 'class.csv_bv.php';
 *
 * $csv = & new csv_bv('test.csv', ';', '"' , '\\');
 * $csv->SkipEmptyRows(TRUE); // Will skip empty rows. TRUE by default. (Shown here for example only).
 * $csv->TrimFields(TRUE); // Remove leading and trailing \s and \t. TRUE by default.
 *
 * $_arr = $csv->csv2Array();
 * print_r($_arr);
 *
 * echo "<br><br>Number of returned rows: ".$csv->RowCount();
 * echo "<br><br>Number of skipped rows: ".$csv->SkippedRowCount();
 *
 *
 * WARNING:
 * - Macintosh line breaks need to be dealt with carefully. See the PHP help files for the function 'fgetcsv'
 *
 * The coding standards used in this file can be found here: http://www.dagbladet.no/development/phpcodingstandard/
 *
 *    All commets and suggestions are welcomed.
 *
 * SUPPORT: Visit http://vhd.com.au/forum/
 *
 * CHANGELOG:
 *
 * - Fixed skipping of last row if the last row did not have a new line. Thanks to Florian Bruch and Henry Flurry. (2006_05_15)
 * - Changed the class name to csv_bv for consistency. (2006_05_15)
 * - Fixed small problem where line breaks at the end of file returned a warning (2005_10_28)
 *
 * @author Ben Vautier <classes@vhd.com.au>
 * @copyright (c) 2006
 * @license BSD
 * @version 1.2 (2006_05_15)
 */


class csv_bv
{
	/**
	 * Seperator character
	 * @var char
	 * @access private
	 */
	var $mFldSeperator;

	/**
	 * Enclose character
	 * @var char
	 * @access private
	 */
	var $mFldEnclosure;

	/**
	 * Escape character
	 * @var char
	 * @access private
	 */
	var $mFldEscapor;

	/**
	 * Length of the largest row in bytes.Default is 4096
	 * @var int
	 * @access private
	 */
	var $mRowSize;

	/**
	 * Holds the file pointer
	 * @var resource
	 * @access private
	 */
	var $mHandle;

	/**
	 * Counts the number of rows that have been returned
	 * @var int
	 * @access private
	 */
	var $mRowCount;

	/**
	 * Counts the number of empty rows that have been skipped
	 * @var int
	 * @access private
	 */
	var $mSkippedRowCount;

	/**
	 * Determines whether empty rows should be skipped or not.
	 * By default empty rows are returned.
	 * @var boolean
	 * @access private
	 */
	var $mSkipEmptyRows;

	/**
	 * Specifies whether the fields leading and trailing \s and \t should be removed
	 * By default it is TRUE.
	 * @var boolean
	 * @access private
	 */
	var $mTrimFields;

	/**
	 * Constructor
	 *
	 * Only used to initialise variables.
	 *
	 * @param str $file - file path
	 * @param str $seperator - Only one character is allowed (optional)
	 * @param str $enclose - Only one character is allowed (optional)
	 * @param str $escape - Only one character is allowed (optional)
	 * @access public
	 */
	Function csv_bv($file, $seperator = ',', $enclose = '"', $escape = ''){

		$this->mFldSeperator = $seperator;
		$this->mFldEnclosure = $enclose;
		$this->mFldEscapor = $escape;

		$this->mSkipEmptyRows = TRUE;
		$this->mTrimFields =  TRUE;

		$this->mRowCount = 0;
		$this->mSkippedRowCount = 0;

		$this->mRowSize = 4096;

		// Open file
		$this->mHandle = @fopen($file, "r") or trigger_error('Unable to open csv file', E_USER_ERROR);
	}


	/**
	 * csv::NextLine() returns an array of fields from the next csv line.
	 *
	 * The position of the file pointer is stored in PHP internals.
	 *
	 * Empty rows can be skipped
	 * Leading and trailing \s and \t can be removed from each field
	 *
	 * @access public
	 * @return array of fields
	 */
	Function NextLine(){

		if (feof($this->mHandle)){
			return False;
		}

		$arr_row = fgetcsv ($this->mHandle, $this->mRowSize, $this->mFldSeperator, $this->mFldEnclosure);

		$this->mRowCount++;

		//-------------------------
		// Skip empty rows if asked to
		if ($this->mSkipEmptyRows){


			if ($arr_row[0] === ''  && count($arr_row) === 1){

				$this->mRowCount--;
				$this->mSkippedRowCount++;

				$arr_row = $this->NextLine();

				// This is to avoid a warning when empty lines are found at the bvery end of a file.
				if (!is_array($arr_row)){ // This will only happen if we are at the end of a file.
					return FALSE;
				}
			}
		}

		//-------------------------
		// Remove leading and trailing spaces \s and \t
		if ($this->mTrimFields && is_array($arr_row)){
			array_walk($arr_row, array($this, 'ArrayTrim'));
		}

		//-------------------------
		// Remove escape character if it is not empty and different from the enclose character
		// otherwise fgetcsv removes it automatically and we don't have to worry about it.
		if ($this->mFldEscapor !== '' && $this->mFldEscapor !== $this->mFldEnclosure && is_array($arr_row)){
			array_walk($arr_row, array($this, 'ArrayRemoveEscapor'));
		}

		return $arr_row;
	}

	/**
	 * csv::Csv2Array will return the whole csv file as 2D array
	 *
	 * @access public
	 */
	Function Csv2Array(){

		$arr_csv = array();

		while ($arr_row = $this->NextLine()){
			$arr_csv[] = $arr_row;
		}

		return $arr_csv;
	}

	/**
	 * csv::ArrayTrim will remove \s and \t from an array
	 *
	 * It is called from array_walk.
	 * @access private
	 */
	Function ArrayTrim(&$item, $key){
		$item = trim($item, " \t"); // space and tab
	}

	/**
	 * csv::ArrayRemoveEscapor will escape the enclose character
	 *
	 * It is called from array_walk.
	 * @access private
	 */
	Function ArrayRemoveEscapor(&$item, $key){
		$item = str_replace($this->mFldEscapor.$this->mFldEnclosure, $this->mFldEnclosure, $item);
	}

	/**
	 * csv::RowCount return the current row count
	 *
	 * @access public
	 * @return int
	 */
	Function RowCount(){
		return $this->mRowCount;
	}

	/**
	 * csv::RowCount return the current skipped row count
	 *
	 * @access public
	 * @return int
	 */
	Function SkippedRowCount(){
		return $this->mSkippedRowCount;
	}

	/**
	 * csv::SkipEmptyRows, sets whether empty rows should be skipped or not
	 *
	 * @access public
	 * @param bool $bool
	 * @return void
	 */
	Function SkipEmptyRows($bool = TRUE){
		$this->mSkipEmptyRows = $bool;
	}

	/**
	 * csv::TrimFields, sets whether fields should have their \s and \t removed.
	 *
	 * @access public
	 * @param bool $bool
	 * @return void
	 */
	Function TrimFields($bool = TRUE){
		$this->mTrimFields = $bool;
	}

}

/************************/


?>