<?php
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();
$row = $this->plugin->_row;
?>
<h1><?php echo $row->label;?></h1>
<div><?php echo $row->intro_text;?></div>
<?php echo $this->plugin->image; ?>