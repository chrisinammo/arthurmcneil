<?php // @version $Id: default.php 8796 2007-09-09 15:46:34Z jinx $
defined('_JEXEC') or die('Restricted access');
?>

<?php
srand((double) microtime() * 1000000);
$flashnum = rand(0, $items - 1);
$item = $list[$flashnum];
modNewsFlashHelper::renderItem($item, $params, $access);
?>
