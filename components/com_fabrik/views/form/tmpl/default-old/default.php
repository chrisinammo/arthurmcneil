<?php $form = $this->form; ?>
<form action="<?php echo $form->action;?>" class="fabrikForm" method="post" name="<?php echo $form->name;?>" id="<?php echo $form->formid;?>" enctype="<?php echo $form->encType;?>">
<h1><?php echo $form->label;?></h1>
<?php 
echo $form->intro;
$active = ($form->error != '') ? '' : ' fabrikHide';
echo "<div class='fabrikMainError fabrikError$active'>" . $form->error . "</div>";?>


	<?php 
	if ($this->showEmail) {
		echo $this->emailLink;
	}
	if ($this->showPDF) {
		echo $this->pdfLink;
	}
	if ($this->showPrint) {
		echo $this->printLink;
	}
	
	foreach ( $this->groups as $group ) {?>
		<div class="fabrikGroup" id="group<?php echo $group->id;?>" style="<?php echo $group->css;?>">
		<h3><?php echo $group->title;?></h3>
		<?php if ($group->canRepeat) {
			$subgroupCounter = 0;
			foreach ($group->subgroups as $subgroup) {
			?>
				<div class="fabrikSubGroup" id="subgroup<?php echo $group->id . "_" . $subgroupCounter;?>">
				<div class="fabrikSubGroupElements">
					<?php foreach( $subgroup as $element ){?>
						<div class="fabrikElement" id="<?php echo $element->className;?>">
						<?php //have to show error divs in package - swap classes on it to de/active 
					 $active = ($element->error != '') ? '' : 'fabrikHide';?>
					<div class="fabrikError <?php echo $active; ?>"><?php echo $element->error;?></div>
							
							<?php echo $element->label;?>
							<div class="fabirkElement">
								<?php echo $element->element;?>
							</div>
						</div>
					<?php }?>
					
				</div>
				<?php if ($group->canRepeat) {?>
					<div class="fabrikGroupRepeater"><a class="addGroup" href="#" id=<?php echo $group->addId;?>>
					<img src="components/com_fabrik/views/form/tmpl/default/images/add.png" alt="add" /></a> <a class="deleteGroup" href="#" id="<?php echo $group->delId;?>"><img src="components/com_fabrik/views/form/tmpl/default/images/del.png" alt="delete" /></a></div>
				<?php }?>
				<div style="clear:both;" ></div>
				</div>
				<?php $subgroupCounter ++;
			} ?>
		<?php } else {?>
			<?php foreach ( $group->elements as $element ) {
			?>
				<div class="fabrikElement" id="<?php echo $element->className;?>">
				<?php //have to show error divs in package - swap classes on it to de/active 
				 $active = ($element->error != '') ? '' : 'fabrikHide';?>
				<div class="fabrikError <?php echo $active; ?>"><?php echo $element->error;?></div>
				<?php echo $element->label;?>
				<div class="fabirkElement">
					<?php echo $element->element;?>
				</div>
				</div>
			<?php }
		 }?>
	</div>
<?php
	}
	?><?php echo $this->hiddenFields;
	?>
	<div class="fabrikActions"><?php echo $form->resetButton;?> <?php echo $form->submitButton;?>
	<?php echo $form->copyButton  . " " . $form->gobackButton?>
	</div>
</form>
<?php 
echo $this->jsActions;
echo JHTML::_('behavior.keepalive'); ?>