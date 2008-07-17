<h1><?php echo $this->form->label;?></h1>
<?php 
echo $this->form->intro;?>
<?php if( $this->form->error != '' ){
	echo "<div class='fabrikError'>" . $this->form->error . "</div>";
}?>
<form action="<?php echo $this->form->action;?>" class="fabrikForm" <?php echo $this->form->js;?> method="post" name="<?php echo $this->form->name;?>" id="<?php echo $this->form->formid;?>" enctype="<?php echo $this->form->encType;?>">
	<?php if($this->showEmail){
		echo $this->emailLink;
	}?> <?php if($this->showPDF){
		echo $this->pdfLink;
	}?> <?php if($this->showPrint){
		echo $this->printLink;
	}?> <?php
	
	foreach( $this->groups as $group ){?>
		<div class="fabrikGroup" id="group<?php echo $group->id;?>" style="<?php echo $group->css;?>">
		<h3><?php echo $group->title;?></h3>
		<?php if($group->canRepeat){
			$subgroupCounter = 0;
			foreach($group->subgroups as $subgroup){
			?>
				<div class="fabrikSubGroup" id="subgroup<?php echo $group->id . "_" . $subgroupCounter;?>">
				<div class="fabrikSubGroupElements">
					<?php foreach( $subgroup as $element ){?>
						<div class="fabrikElement" id="<?php echo $element->className;?>">
							<?php if($element->error != ''){?>
								<div class="fabrikError"><?php echo $element->error;?></div>
							<?php }?> 
							<?php echo $element->label;?>
							<?php echo $element->element;?>
						</div>
					<?php }?>
					
				</div>
				<?php if($group->canRepeat){?>
					<div class="fabrikGroupRepeater"><a class="addGroup" href="#" id=<?php echo $group->addId;?>>
					<img src="<?php echo COM_FABRIK_LIVESITE; ?>components/com_fabrik/views/form/tmpl/default/images/add.png" alt="add" /></a> 
					<a class="deleteGroup" href="#" id="<?php echo $group->delId;?>"><img src="<?php echo COM_FABRIK_LIVESITE; ?>components/com_fabrik/views/form/tmpl/default/images/del.png" alt="delete" /></a></div>
				<?php }?>
				<div style="clear:both;" ></div>
				</div>
				<?php $subgroupCounter ++;
			} ?>
		<?php }else{?>
			<?php foreach( $group->elements as $element ){
			?>
				<div class="fabrikElement" id="<?php echo $element->className;?>"><?php if($element->error != ''){?>
				<div class="fabrikError"><?php echo $element->error;?></div>
				<?php }?> <?php echo $element->label;?> <?php echo $element->element;?>
				</div>
			<?php }
		 }?>
	</div>
<?php
	}
	?><?php echo $this->hiddenFields;
	?>
	<div class="fabrikActions"><?php echo $this->form->resetButton;?> <?php echo $this->form->submitButton;?>
	<?php echo $this->form->copyButton ?>
	</div>
</form>
<?php echo $this->jsActions; ?> 
