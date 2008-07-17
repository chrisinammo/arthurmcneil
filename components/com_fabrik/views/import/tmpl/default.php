<?php 

/**
* @package Joomla
* @subpackage Fabrik
* @copyright Copyright (C) 2005 Rob Clayburn. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/

// no direct access
defined('_JEXEC') or die('Restricted access');
?>

	<script language="javascript" type="text/javascript">
		function submitbutton3(pressbutton) {
			form.submit();
		}
		</script>

<form enctype="multipart/form-data" action="index.php" method="post" name="csv">

<table class="adminform">
	<tr>
		<th colspan="2"><?php echo JText::_('Import CSV file') . ": " . $this->table->label;?></th>
	</tr>
	<tr>
		<td align="left"><label for="userfile"><?php echo JText::_('CSV File');?></label>
		</td>
		<td><input class="text_area" name="userfile" id="userfile" type="file" size="40" /></td>
	</tr>
	
	<tr>
		<td align="left"><label for="drop_data"><?php echo JText::_('Drop exisitng data');?></label>
		</td>
		<td><input type="checkbox" name="drop_data" id="drop_data" value="1" />
		</td>
	</tr>
	<tr>
		<td align="left"><label for="overwrite"><?php echo JText::_( 'Overwrite matching records' );?></label>
		</td>
		<td><input type="checkbox" name="overwrite" id="overwrite" value="1" />
		</td>
	</tr>
	
	<tr>
		<td align="left"><label for="field_delimiter"><?php echo JText::_( 'Field delimiter' );?></label>
		</td>
		<td>
		<input size="2" class="input" id="field_delimiter" name="field_delimiter" value="," />
		</td>
	</tr>
	<tr>
		<td align="left"><label for="text_delimiter"><?php echo JText::_( 'Text delimiter' );?></label>
		</td>
		<td>
		<input size="2" class="input" name="text_delimiter" id="text_delimiter" value='&quot;' />
		</td>
	</tr>
	<tr>
		<td colspan="2" align="left"><input class="button" type="submit"
			value="<?php echo JText::_( 'Import CSV' );?>" /></td>
	</tr>
</table>
<input type="hidden" name="option" value="com_fabrik" />
<input type="hidden" name="view" value="import" />
<input type="hidden" name="task" value="doimport" />
<input type="hidden" name="tableid" value="<?php echo $this->tableid;?>" />
</form>

		
	