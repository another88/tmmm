<?php

$baseFull = '';
$filePath = dirname(__FILE__);
require $filePath .'/../../settings/config.php';

$callback = $_GET['CKEditorFuncNum'];

$nameExp = explode('.', $_FILES['upload']['name']);
$fileExt = $nameExp[count($nameExp)-1];

$file_name = MD5($_FILES['upload']['name']).'.'.$fileExt;
$file_name_tmp = $_FILES['upload']['tmp_name'];

$error = '';

$imagesDir = dirname(__FILE__).'/../images/upload/'.date('Y').'/';
if (!file_exists($imagesDir)) {
    umask(0);
    mkdir($imagesDir, 0777, true);
}
$imagesDir .= date('m').'/';
if (!file_exists($imagesDir)) {
    umask(0);
    mkdir($imagesDir, 0777, true);
}
$imagesDir .= date('d').'/';
if (!file_exists($imagesDir)) {
    umask(0);
    mkdir($imagesDir, 0777, true);
}

$str = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
$unikey = '';
for ($i = 0; $i < 7; $i++) 
{
    $unikey .= substr(str_shuffle($str), 0, 1);
}


$http_path = $baseFull .'images/upload/'.date('Y').'/'.date('m').'/'.date('d').'/'.$unikey.'_'.$file_name;

copy($file_name_tmp, $imagesDir.$unikey.'_'.$file_name);
echo "<script type=\"text/javascript\">window.parent.CKEDITOR.tools.callFunction(".$callback.",  \"".$http_path."\", \"".$error."\" );</script>";

?>