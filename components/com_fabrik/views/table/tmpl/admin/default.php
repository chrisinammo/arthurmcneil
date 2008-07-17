<h1><?php echo $this->table->label;?></h1>
<?php echo $this->table->intro;?>
<form action="<?php echo $this->table->action;?>" method="post" id="<?php echo $this->formid;?>" name="fabrikTable">

<?php if ($this->showAdd) {?>
	<span class="pagenav">
		<a href="<?php echo $this->addRecordLink;?>"><?php echo JText::_( 'Add Listing' );?></a>
	</span>
<?php }?>

<?php if ($this->showCSV) {?>
	<span class="pagenav">
		<a href="<?php echo $this->csvLink;?>"><?php echo JText::_( 'Export to CSV' );?></a>
	</span>
<?php }?> 

<?php if ($this->showRSS) {?>
	<span class="pagenav">
		<a href="<?php echo $this->rssLink;?>"><?php echo JText::_( 'Subscribe RSS' );?></a>
	</span>
<?php }?>

<?php if ($this->showFilters) {?>
	<table class="filtertable">
		<tr>
			<th colspan="2" style="text-align:left"><?php echo JText::_( 'Search' );?>:</th>
		</tr>
		<?php foreach ($this->filters as $filter) {?>
		<tr>
			<td><?php echo $filter->label;?></td>
			<td style="text-align:right;"><?php echo $filter->element;?></td>
		</tr>
		<?php } ?>
		<?php if($this->filter_action != 'onchange') {?>
		<tr>
			<td colspan="2" style="text-align:right;"><input type="button"
				class="fabrik_filter_submit button" value="<?php echo JText::_( 'Go' );?>"
				name="filter" /></td>
		</tr>
		<?php }?>
	</table>
<?php } // end show filters ?>


<?php if( count( $this->rows ) == 0 ){?>
	<div class="emptyDataMessage"><?php echo $this->emptyDataMessage; ?></div>
<?php }else{
	echo $this->loadTemplate('group'); 
	?>
	<label><input type="checkbox" id="table_<?php echo $this->table->id;?>_checkAll" /><?php echo JText::_( 'Check All' );?></label>
	<?php print_r( $this->hiddenFields );?>
	<?php echo $this->nav;
	echo $this->deleteButton;
	echo "&nbsp;" . $this->emptyButton;?>
	</form>
<?php } //end not empty?> 


