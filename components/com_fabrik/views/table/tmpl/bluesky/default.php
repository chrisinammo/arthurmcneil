<?php if ($this->tablePicker != '') { ?>
	<div style="text-align:right"><?php echo JText::_( 'Table') ?>: <?php echo $this->tablePicker; ?></div>
<?php } ?>
<h1><?php echo $this->table->label;?></h1>
<?php echo $this->table->intro;?>
<form class="fabrikForm" action="<?php echo $this->table->action;?>" method="post" id="<?php echo $this->formid;?>" name="fabrikTable">
	<?php
	echo $this->loadTemplate('buttons');  
	
	//for some really ODD reason loading the headings template inside the group
	//template causes an error as $this->_path['template'] doesnt cotain the correct 
	// path to this template - go figure!
	$this->headingstmpl =  $this->loadTemplate('headings');
	if ($this->showFilters) {
		echo $this->loadTemplate('filter'); 
	}
	?>
	<br style="clear:right;" />

	<?php if ($this->nodata) {?>
		<div class="emptyDataMessage"><?php echo $this->emptyDataMessage;;?></div>
	<?php }else{
		echo $this->loadTemplate('group');
		echo $this->nav;
		if ($this->canDelete) {
	 		echo $this->deleteButton;
		}
		echo "&nbsp;" . $this->emptyButton;
	}
	print_r($this->hiddenFields);?>
</form>

<script type="text/javascript" src="<?php echo $this->jsPath;?>" />
