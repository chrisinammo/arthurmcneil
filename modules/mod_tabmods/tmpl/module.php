<div class="gk_tabmods_item" style="<?php echo $this->style;?>">
	<?php foreach(array_keys($this->modGetter) as $m) : ?>
	<?php echo JModuleHelper::renderModule($this->modGetter[$m]); ?>
	<?php endforeach;?>
</div>