<?php
 /* this is the group template used by the html template and by the ajax updating of the table 
if group_by is not used then this in only repeated once.
*/
//@TODO: the id here will be repeated if group_by is on - need to add a group identifier to it

foreach( $this->rows as $this->group ){
	?>
	<table class="adminlist fabrikTable" id="table_<?php echo $this->table->id;?>" >
		<thead>
		<tr>
		<?php foreach( $this->headings as $heading ){?>
			<th class="title"><?php echo $heading; ?></th>
			<?php }?>
		</tr>
		</thead>
		<tbody>
		<?php echo $this->loadTemplate('row'); ?>
		<tr class="fabrik_calculations">
			<?php
			foreach($this->calculations as $cal){
				echo "<td>" . $cal->calc ."</td>";
			}
			?>
		</tr>
		</tbody>
	</table>
<?php }?>