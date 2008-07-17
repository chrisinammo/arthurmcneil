<tr id="table_<?php echo $this->table->id;?>_row_<?php echo @$this->_row->__pk_val;?>" class="fabrik_row oddRow<?php echo $this->_c;?>">
	<?php foreach ($this->headings as $heading=>$label) {	?>
		<td class="fabrik_row___<?php echo $heading ?>" ><?php echo @$this->_row->$heading;?></td>
	<?php }?>
</tr>
<?php
$this->_c = 1-$this->_c;?>
