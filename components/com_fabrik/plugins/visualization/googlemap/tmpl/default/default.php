<?php
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();
$row = $this->plugin->_row;
$params = $this->plugin->getParams();
?>
<h1><?php echo $row->label;?></h1>
<div><?php echo $row->intro_text;?></div>
<div id="table_map" style="width:<?php echo $params->get('fb_gm_mapwidth');?>px; height:<?php echo $params->get( 'fb_gm_mapheight' );?>px"></div>
