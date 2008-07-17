<?php
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();
global $Itemid;
$row = $this->plugin->_row;
?>
<h1><?php echo $row->label;?></h1>
<a href="#" id="addEventButton">add</a>
<div><?php echo $row->intro_text;?></div>
<div id='calendar'></div>



<script type="text/javascript">
window.addEvent('domready', function(){
	$('addEventButton').addEvent('click', function(e){
			document.mochaDesktop.newWindow({
				id: 'adeventx',
				title: 'Add event',
				contentType: 'xhr',
				loadMethod:'xhr',
				contentURL: 'index.php?option=com_fabrik&tmpl=component&view=visualization&Itemid=<?php echo $Itemid; ?>&plugintask=chooseaddevent',
				width: 320,
				height: 320,
				x: 20,
				y: 60
			});
	});
})
</script>
