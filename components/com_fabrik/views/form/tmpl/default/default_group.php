<ul>
<?php foreach ( $this->elements as $element ) {
	?>
	<li class="<?php echo @$element->hidden ? 'fabrikHide' : '' ?>">
		<div id="<?php echo @$element->id . "_error";?>" class="fabrikError <?php echo ($element->error != '') ? '' : 'fabrikHide'; ?>">
			<?php echo $element->error;?>
		</div>
		<?php echo $element->label;?>
		<div class="fabrikElement">
			<?php echo $element->element;?>
		</div>
		<div style="clear:both"></div>
	</li>
	<?php }?>
</ul>
