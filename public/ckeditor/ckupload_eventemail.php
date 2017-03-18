<?php
/**
 * Проверка POST запроса
 */
if ( $_SERVER['REQUEST_METHOD'] != 'POST' || !count($_FILES) )
    exit('Hacking attempt!');

/**
 * Загрузка настроек
 */
$filePath = dirname(__FILE__);
require $filePath .'/../../settings/config.php';
    
/**
 * Определение директории для сохранения изображения
 */
$imagePath = $config['path']['public'] .'images/events/' . date('Y/m/d/');
$frontendPath = $baseFull .'images/events/' . date('Y/m/d/');
    
//deleteDirectory ($root .'public/images/events');exit($root .'public/images/events');
/**
 * Создание папки для картинок для её отсутствия
 */

    
$callback = $_GET['CKEditorFuncNum'];
$fileExt = strtolower(end(explode('.', $_FILES['upload']['name'])));

$newFileName = '';
$str = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
for ($i = 0; $i < 10; $i++) {
    $newFileName .= substr(str_shuffle($str), 0, 1);
}
$newFileName = $newFileName .'.'. $fileExt;
$serverImagePath = trim($imagePath.$newFileName);

if ( !preg_match('~jpg|jpeg|gif|png~i', $fileExt) )
{
    $error = 'Allowed extensions jpg, jpeg, gif and png';
}
else
{
    $error = '';
//    var_dump();
//    exit($frontendPath.$newFileName);
    if ( !file_exists($imagePath) )
        mkdir($imagePath, 0777, true);
        @chmod($imagePath, 0777);
    file_put_contents($serverImagePath, file_get_contents($_FILES['upload']['tmp_name']));
}

echo '<script type="text/javascript">window.parent.CKEDITOR.tools.callFunction('. $callback .',  "'. $frontendPath.$newFileName .'", "'. $error .'" );</script>';

//function deleteDirectory($dir) {
//    if (!file_exists($dir)) return true;
//    if (!is_dir($dir) || is_link($dir)) return unlink($dir);
//        foreach (scandir($dir) as $item) {
//            if ($item == '.' || $item == '..') continue;
//            if (!deleteDirectory($dir . "/" . $item)) {
//                chmod($dir . "/" . $item, 0777);
//                if (!deleteDirectory($dir . "/" . $item)) return false;
//            };
//        }
//        return rmdir($dir);
//}