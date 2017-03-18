<?php
// Errors on
error_reporting(E_ALL ^ E_STRICT);
ini_set('display_errors', 0);

require '../settings/config.php';

global $uri;
$uri= $_SERVER['REQUEST_URI'];

if ( isset($_REQUEST['realuri'])){
    $_SERVER['REQUEST_URI'] = $_REQUEST['realuri'];
}

$paths = implode(PATH_SEPARATOR, array(
            $config['path']['libs'],
            implode(PATH_SEPARATOR, $config['path']['models']),
            $config['path']['system'],
            $config['path']['basecontroller'],
            $config['path']['modelbase'],
            $config['path']['mpdf'],));

set_include_path($paths);

// Main system class
require 'Kernel.php';
// Run application
Kernel::run($config);