<?php 

if (extension_loaded('zlib') && !ini_get('zlib.output_compression')) @ob_start('ob_gzhandler');
header('Content-type: text/css; charset: UTF-8');
header('Expires: ' . gmdate('D, d M Y H:i:s', time() + 86400) . ' GMT');

define('DS', DIRECTORY_SEPARATOR);
define('PATH_ROOT', dirname(__FILE__) . DS);

/* general styling */
include(PATH_ROOT . 'styles/style.css');

/* default styling */
include(PATH_ROOT . 'styles/default/style.css');

/* watermark styling */
include(PATH_ROOT . 'styles/watermark/style.css');

/* whitespace styling */
include(PATH_ROOT . 'styles/whitespace/style.css');

?>