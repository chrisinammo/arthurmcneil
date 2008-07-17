<?php
$c = 0;
foreach($this->group as $row){?>
	<tr id="table_<?php echo $this->table->id;?>_row_<?php echo $row->__pk_val;?>" class="fabrik_row oddRow<?php echo $c % 2;?> row<?php echo $c % 2;?>">
		<?php foreach($this->headings as $heading=>$label){	?>
			<td><?php echo($row->$heading);?></td>
		<?php }?>
	</tr>
<?php
}
$c++;?>
