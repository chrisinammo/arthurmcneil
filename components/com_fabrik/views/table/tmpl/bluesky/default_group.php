<?php
 /* this is the group template used by the html template and by the ajax updating of the table 
if group_by is not used then this in only repeated once.
*/
//@TODO: the id here will be repeated if group_by is on - need to add a group identifier to it

foreach ($this->rows as $group) {
	?>
	<table class="fabrikTable" id="table_<?php echo $this->table->id;?>" >
		<?php
			echo $this->headingstmpl;
			?>
			<tfoot>
				<tr class="fabrik_calculations">
				<?php
				foreach ($this->calculations as $cal) {
					echo "<td>" . $cal->calc ."</td>";
				}
				?>
			</tr>
			</tfoot>
			<?php 
			$this->_c = 0;
			foreach ($group as $this->_row) {
				echo $this->loadTemplate( 'row' ); 
		 	}
		 	?>
	</table>
<?php }?>