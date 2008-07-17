<table class="filtertable fabrikTable">
	<tr>
		<th style="text-align:left"><?php echo JText::_( 'Search' );?>:</th>
		<th style="text-align:right"><a href="#" class="clearFilters"><?php echo JText::_( 'Clear' ); ?></a></th>
	</tr>
	<?php 
	$c = 0;
	foreach ($this->filters as $filter) {?>
		<tr class="fabrik_row oddRow<?php echo $c % 2;?>">
			<td><?php echo $filter->label;?></td>
			<td style="text-align:right;"><?php echo $filter->element;?></td>
		</tr>
	<?php $c ++;
	} ?>
	<?php if ($this->filter_action != 'onchange') {?>
	<tr class="fabrik_row oddRow<?php echo $c % 2;?>">
		<td colspan="2" style="text-align:right;">
		<input type="button" class="fabrik_filter_submit button" value="<?php echo JText::_( 'Go' );?>"
			name="filter" />
		</td>
	</tr>
	<?php }?>
</table>