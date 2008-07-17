<?php 

if (extension_loaded('zlib') && !ini_get('zlib.output_compression')) @ob_start('ob_gzhandler');
header('Content-type: application/x-javascript');
header('Expires: ' . gmdate('D, d M Y H:i:s', time() + 86400) . ' GMT');

define('DS', DIRECTORY_SEPARATOR);
define('PATH_ROOT', dirname(__FILE__) . DS);

/* lightbox */
if (isset($_GET['lb']) && $_GET['lb'] == 1) include(PATH_ROOT . 'lightbox/shadowbox_packed.js');

/* reflection */
if (isset($_GET['re']) && $_GET['re'] == 1) include(PATH_ROOT . 'reflection/reflection_packed.js');

/* spotlight */
if (isset($_GET['sl']) && $_GET['sl'] == 1) include(PATH_ROOT . 'spotlight/spotlight_packed.js');

?>