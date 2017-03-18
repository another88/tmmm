<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"  dir="ltr" lang="ru-RU">
<head>
    <base href="{$rootPath}" />
    <script>
        var rootPath = "{$rootPath}";
    </script>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="icon" type="image/png" href="http://ace-hookah.com/icon/favicon.png" />
    <title>
        {if empty($title)}
            Учетка Ace Hookah
        {else}
            {$title}
        {/if}
    </title>
    <link rel='stylesheet' href='styles/admin/dashboard.css' type='text/css' media='all' />
    <link rel='stylesheet' href='styles/admin/colors-fresh.css' type='text/css' media='all' />
    <link rel='stylesheet' href='styles/admin/guest.css' type='text/css' media='all' />
    <link rel='stylesheet' href='styles/jqueryui/jquery-ui-1.9.1.custom.css' type='text/css' media='all' />
    {if isset($styles) && !empty($styles)}
        {foreach from=$styles item=s}
            <link rel='stylesheet' href='styles/admin/{$s}' type='text/css' media='all' />
        {/foreach}
    {/if}

    <script type='text/javascript' src='scripts/admin/jquery_utils_quicktags.js'></script>
    <script type='text/javascript' src='scripts/admin/script.js'></script>
    <script type='text/javascript' src='scripts/jquery-1.8.2.min.js'></script>
    <script type='text/javascript' src='scripts/jquery-ui-1.9.1.min.js'></script>
    <script type='text/javascript' src='scripts/jquery.json-2.3.min.js'></script>
    <script type='text/javascript' src='scripts/admin.js'></script>

    {if isset($scripts) && !empty($scripts)}
        {foreach from=$scripts item=s}
            <script type="text/javascript" src="{$s}"></script>
        {/foreach}
    {/if}

    <style type="text/css">
    {literal}
            * html #adminmenu { /* for IE6 only */
                    margin-left: -115px; /* default 80px + 5px */
            }
    {/literal}
    </style>
</head>
<body class="wp-admin no-js  index-php">
    {if !empty($headerMessage)}
        {literal}
        <script type="text/javascript">
        $(document).ready(function(){
            $('.main-page-notice').fadeIn(500);
                setTimeout("$('.main-page-notice').fadeOut(800)", 5000);
        });
        </script>
        {/literal}
        <div class="main-page-notice" style="display: none;">{$headerMessage}</div>
    {/if}

<div id="wpwrap">
<div id="wpcontent">

<div id="wpbody">
    <ul id="adminmenu">
            <li class="wp-first-item current menu-top menu-top-first menu-top-last">
                <div class='wp-menu-image'><a href='index/logout'><br /></a></div>
                <div class="wp-menu-toggle"><br /></div>
                <a href='index/logout' class="wp-first-item current menu-top menu-top-first menu-top-last" style="background-color: red;">Выйти</a>
            </li>
            <li class="wp-menu-separator"><a class="separator" href="?unfoldmenu=1"><br /></a></li>

            {if $isWork.value == '0'}
                <li class="wp-first-item current menu-top menu-top-first menu-top-last">
                    <div class="setupButtonActive"><a href='guest/loungeopen'>Открыть смену</a></div>
                </li>
                <li class="wp-menu-separator"><a class="separator" href="?unfoldmenu=1"><br /></a></li>
            {else}
                <li class="wp-first-item current menu-top menu-top-first menu-top-last">
                    <div class="setupButtonCancel"><a href='javascript:void(0);' onclick="loungeclose();">Закрыть смену</a></div>
                </li>
                <li class="wp-menu-separator"><a class="separator" href="?unfoldmenu=1"><br /></a></li>            
            {/if}
            
            <li class="wp-first-item current menu-top menu-top-first menu-top-last">
                <div class="wp-menu-toggle"><br /></div>
                <a href='guest/' class="wp-first-item current menu-top menu-top-first menu-top-last">На главную</a>
            </li>
            <li class="wp-menu-separator"><a class="separator" href="?unfoldmenu=1"><br /></a></li>            

            <li class="wp-has-submenu open-if-no-js menu-top menu-top {if isset($menuOpen) && $menuOpen=='list'}wp-menu-open{/if} menu-top-first">
                <div class="wp-menu-toggle"><br /></div>
                <a href='guest/list' class="wp-has-submenu open-if-no-js menu-top menu-top-first">Члены клуба</a>
            </li> 
            
            <li class="wp-has-submenu open-if-no-js menu-top menu-top {if isset($menuOpen) && $menuOpen=='todaytable'}wp-menu-open{/if}">
                <div class="wp-menu-toggle"><br /></div>
                <a href='guest/dayreport/id/0' class="wp-has-submenu open-if-no-js menu-top menu-top-first">Отчет за сегодня</a>
            </li>                   
                
            {if $smarty.session.user.isAdmin == 2 }
                <li class="wp-has-submenu open-if-no-js menu-top menu-top {if isset($menuOpen) && $menuOpen=='report'}wp-menu-open{/if}">
                    <div class="wp-menu-toggle"><br /></div>
                    <a href='guest/report' class="wp-has-submenu open-if-no-js menu-top menu-top-first">Отчет по месяцам</a>
                </li>  
                    
                <li class="wp-has-submenu open-if-no-js menu-top menu-top {if isset($menuOpen) && $menuOpen=='guestproductсategory'}wp-menu-open{/if}">
                    <div class="wp-menu-toggle"><br /></div>
                    <a href='guest/guestproductcategory' class="wp-has-submenu open-if-no-js menu-top menu-top-first">Категории меню</a>
                </li> 

                <li class="wp-has-submenu open-if-no-js menu-top menu-top {if isset($menuOpen) && $menuOpen=='guestproduct'}wp-menu-open{/if}">
                    <div class="wp-menu-toggle"><br /></div>
                    <a href='guest/guestproduct' class="wp-has-submenu open-if-no-js menu-top menu-top-first">Продукты в меню</a>
                </li> 

                <li class="wp-has-submenu open-if-no-js menu-top menu-top {if isset($menuOpen) && $menuOpen=='guestsale'}wp-menu-open{/if}menu-top-last">
                    <div class="wp-menu-toggle"><br /></div>
                    <a href='guest/guestsale' class="wp-has-submenu open-if-no-js menu-top menu-top-first">Скидки</a>
                </li> 
            {/if}

    {*        <li class="wp-has-submenu menu-top {if isset($menuOpen) && $menuOpen=='user'}wp-menu-open{/if} menu-top-last" id="menu-tools">
                <div class='wp-menu-image' style="background: url('styles/images/menu.png') no-repeat scroll -302px -33px transparent;">
                <div class="wp-menu-toggle"><br /></div></div>
                <a href='admin/user' class="wp-has-submenu menu-top menu-top-last" tabindex="1">Пользователи</a>
                <div class='wp-submenu'>
                    <ul>
                        <li class="wp-first-item"><a href='admin/user' class="wp-first-item">Список</a></li>
    <!--                    <li class="wp-first-item"><a href='admin/permissions' class="wp-first-item">Permission</a></li>-->
                    </ul>
                </div>
            </li>*}

            <li class="wp-menu-separator-last"><a class="separator" href="?unfoldmenu=1"><br /></a></li>
    </ul>
    <div id="wpbody-content">
        <div id="screen-meta">


        </div>

        <script>setTimeout("$('.noticeUp').slideUp(500)",4000);</script>
        <div id='update-nag' class="noticeUp" style="color: green">      {$notice}     </div>
        {if !empty($error)}
        <div id='update-nag'>      {$error}     </div>
        {/if}
    </div>

    <div class="wrap">
        
{*<div class="clear"></div>
<p id="status" style="height:22px; color:#c00;font-weight:bold;"></p>

<div id="webcam">
    <img src="http://ruseller.com/adds/adds1993/example/img/antenna.png" alt="" />
    <span>jQuery</span>
    <div><a onClick="toggleFilter(this);"><img src="http://ruseller.com/adds/adds1993/example/img/icon_filter.png" alt="" /></a></div>
</div>
<div class="clear"></div>
<p><canvas id="canvas" height="240" width="320"></canvas></p>
<div class="clear"></div>*}
        
        <h2>{$title}</h2>
        <div class='postbox-container' style='width:95%;'>
        <div id="dashboard_quick_press" class="postbox " >
            <div class="inside">