<link href="modules/mod_tabmods/style/<?php echo $this->styleCSSfile; ?>.css" rel="stylesheet" type="text/css" />
<?php if($this->useMoo == 1) : ?>
<script type="text/javascript" src="modules/mod_tabmods/scripts/mootools.js"></script>
<?php endif; ?>
<?php if($this->useScript == 1) : ?>
<script type="text/javascript" src="modules/mod_tabmods/scripts/mod_tabmods.js"></script>
<script type="text/javascript">
		try{$Gavick;}catch(e){$Gavick = {};}
	</script>
<?php endif; ?>
<script type="text/javascript">
	$Gavick["gk_tabmods<?php echo $this->module_id;?>"] = {
		"activator" : <?php echo (($this->activator == 'click') ? 0:1);?>,
		"autoAnimation" : <?php echo $this->animation;?>,
		"animationTransition" : <?php echo $this->animationFun;?>,
		"animationType" : <?php echo $this->animationType;?>,
		"animationSpeed" : <?php echo $this->animationSpeed;?>,
		"animationInterval" : <?php echo $this->animationInterval;?>,
		"styleType": <?php echo $this->styleType;?>
	};
</script>
<div class="gk_tabmods clearfix" id="<?php echo $this->module_id;?>">
        <?php if($this->styleType == 0) : ?>
			<div class="gk_tabmods_wrap clearfix" style="<?php echo $this->hstyle; ?>">
		<?php endif; ?>	
		
                <ul class="gk_tabmodsmenu_ul">
                        <?php for($i = 0;$i<count($this->tabsTitles);$i++) : ?>
                        <li><span><?php echo $this->tabsTitles[$i]; ?></span></li>
                        <?php endfor; ?>
                </ul>
                
				<div class="gk_tabmods_container0 clearfix" style="<?php echo $this->style; ?>">
                        <div class="gk_tabmods_container1 clearfix" style="<?php echo $this->style; ?>">
                                <div class="gk_tabmods_container2 clearfix">
                                        <?php TabModsHelper::moduleRender(); ?>
                                </div>
                        </div>
                </div>
      
		<?php if($this->styleType == 0) : ?>
			</div>
		<?php endif; ?>	
		
        <?php if($this->buttons == 1) : ?>
        <div class="gk_tabmods_button_next">
        </div>
        <div class="gk_tabmods_button_prev">
        </div>
        <?php endif; ?>
</div>
<div style="clear:both;width: 100%;">
</div>
