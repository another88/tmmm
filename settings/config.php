<?php

/**
 * Configuration
 *
 */
// site root
$root = dirname(__FILE__);
$root .= '/../';
$root = str_replace("\\", "/", $root);
// Base URL.
$baseUrl = '/';
$baseFull = 'http://ace-hookah.com/';
$baseTitle = 'Ace Hookah';

// Configuration Array
$config = array(
    'adminMail' => 'acehookah@mail.ru',
    'db' => array(
        'adapter' => 'Mysqli',
        'params' => array(
            'host' => 'p271847.mysql.ihc.ru',
            'username' => 'p271847_ace',
            'password' => '73y85Fz3zT',
            'dbname' => 'p271847_ace'
        ),
    ),
    'url' => array(
        'base' => $baseUrl,
        'baseFull' => $baseFull,
        'baseFullHttps' => $baseFull,
        'images' => 'images',
        'styles' => 'styles'
    ),     
    // Paths
   'path' => array(
        'root' => $root,
        'mpdf' => $root . 'libs/mpdf/',
        'applications' => $root . 'applications/',
        'libs' => $root . 'libs/',
        'templates' => array(
            'default' => $root . 'applications/modules/default/views/templates/',
            'admin' => $root . 'applications/modules/admin/views/templates/'
        ),
        'templates_c' => $root . 'cache/templates_c/',
        'system' => $root . 'applications/system/',
        'settings' => $root . 'settings/',
        'images'   =>   array(
                        'product'               => $root . 'public/images/product/',
                        'mix'               => $root . 'public/images/mix/'
                    ),
        'public' => $root . 'public/',
        'basecontroller' => $root . 'applications/modules/default/controllers/',
        'modelbase' => $root . 'applications/modules/default/models/',
        'models' => array(
            $root . 'applications/modules/default/models/',
            $root . 'applications/modules/admin/models/'
        ),
        'modules' => $root . 'applications/modules/',
    ),
    'defaultMeta'=> array(
        'title'=>'Кальяны от Ace Hookah. Деревянные шахты, моющиеся шланги, оригинальные решения',
        'description'=>'Кальяны от Ace Hookah. Деревянные шахты, моющиеся шланги, оригинальные решения',
        'keywords'=>'Ace Hookah, купить кальян Ace Hookah, купить кальян в Крыму, купить кальян в России'
    ),    
    'common' => array(
        'charset' => 'utf-8',
    ),
    'debug' => array(
        'on' => true,
    ),
    'commandList' => array(
        'convert' => '/usr/bin/convert',
        'identify' => '/usr/bin/identif',
        'ghostScript' => '/usr/bin/convert'
    )
);
