<div id="fbPackageStatus"><img src="components/com_fabrik/views/package/tmpl/default/images/ajax-loader.gif" alt="loading"/> <?php echo JText::_('Loading') ?> </div>
<dl id="fabrik_package">
<?php
JHTML::script('tabs.js');
$i = 0;
foreach($this->blocks as $key => $block){
	if( $i % 2  == 0){
		echo "<dt>$key</dt><dd>";
	}
	echo "<div class='fabrik_block fabrik_block_col" . $i % 2 . "'>";
	echo $block->display();
	echo "</div>";
	if( $i % 2  != 0){
		echo "<br style='clear:left' / ></dd>";
	}
	$i ++;
}
?>
</dl>

<script type="text/javascript">
window.addEvent('domready', function(){
 new JTabs('fabrik_package');
});
</script>