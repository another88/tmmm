<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"  dir="ltr" lang="ru-RU">
<head>
<base href="{$rootPath}" />
<script>
    var rootPath = "{$rootPath}";
</script>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Control panel</title>
<link rel='stylesheet' href='styles/admin/dashboard.css' type='text/css' media='all' />
<link rel='stylesheet' href='styles/admin/colors-fresh.css' type='text/css' media='all' />
<link rel='stylesheet' href='styles/jqueryui/jquery-ui-1.8.11.custom.css' type='text/css' media='all' />
{if isset($styles) && !empty($styles)}
    {foreach from=$styles item=s}
        <link rel='stylesheet' href='styles/admin/{$s}' type='text/css' media='all' />
    {/foreach}
{/if}

<script type='text/javascript' src='scripts/admin/jquery_utils_quicktags.js'></script>
<script type='text/javascript' src='scripts/admin/script.js'></script>
<script type='text/javascript' src='scripts/jquery-1.8.2.min.js'></script>
<script type='text/javascript' src='scripts/jquery-ui-1.9.1.min.js'></script>
<script type='text/javascript' src='scripts/admin.js'></script>

<script type='text/javascript' src='scripts/colorpicker/js/colorpicker.js'></script>
<link rel='stylesheet' href='scripts/colorpicker/css/colorpicker.css' type='text/css' media='all' />

{if isset($scripts) && !empty($scripts)}
    {foreach from=$scripts item=s}
        <script type="text/javascript" src="{$s}"></script>
    {/foreach}
{/if}

<style type="text/css">
{literal}
    #adminmenu {
		width: 185px; /* default 145px + 10px */
		margin-left: -200px; /* default 160px + 10px */
	}
	#wpbody {
		margin-left: 215px; /* default 175px + 10px */
	}
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
<script type="text/javascript">
{literal}
//<![CDATA[
(function(){
var c = document.body.className;
c = c.replace(/no-js/, 'js');
document.body.className = c;
})();
//]]>
{/literal}

</script>

<div id="wpwrap">
<div id="wpcontent">
<div id="wphead">

 <h1><a href="admin/">Control Panel</a></h1>
 <a href="index/logout" class="adminLogout">Logout</a>
<div id="wphead-info">

</div>
</div>

<div id="wpbody">

<ul id="adminmenu">


	<li class="wp-first-item current menu-top menu-top-first menu-top-last" id="menu-dashboard">
            <div class='wp-menu-image'><a href='admin/'><br /></a></div>
            <div class="wp-menu-toggle"><br /></div>
            <a href='admin/' class="wp-first-item current menu-top menu-top-first menu-top-last" tabindex="1">Admin</a>
	</li>
	<li class="wp-menu-separator"><a class="separator" href="?unfoldmenu=1"><br /></a></li>
            
        <li class="wp-has-submenu open-if-no-js menu-top menu-top {if isset($menuOpen) && $menuOpen=='content'}wp-menu-open{/if} menu-top-first">
            <div class='wp-menu-image'><a href='admin/content/'><br /></a></div>
            <div class="wp-menu-toggle"><br /></div>
            <a href='admin/content/' class="wp-has-submenu open-if-no-js menu-top menu-top-first">Контент</a>
        </li>  
            
        <li class="wp-has-submenu open-if-no-js menu-top menu-top {if isset($menuOpen) && $menuOpen=='category'}wp-menu-open{/if}">
            <div class='wp-menu-image'><a href='admin/category/'><br /></a></div>
            <div class="wp-menu-toggle"><br /></div>
            <a href='admin/category/' class="wp-has-submenu open-if-no-js menu-top menu-top-first">Категории Товаров</a>
        </li>     
            
        <li class="wp-has-submenu open-if-no-js menu-top menu-top {if isset($menuOpen) && $menuOpen=='product'}wp-menu-open{/if}">
            <div class='wp-menu-image'><a href='admin/product/'><br /></a></div>
            <div class="wp-menu-toggle"><br /></div>
            <a href='admin/product/' class="wp-has-submenu open-if-no-js menu-top menu-top-first">Товары</a>
        </li>   
            
{*        <li class="wp-has-submenu open-if-no-js menu-top menu-top {if isset($menuOpen) && $menuOpen=='comment'}wp-menu-open{/if}">
            <div class='wp-menu-image'><a href='admin/comment/'><br /></a></div>
            <div class="wp-menu-toggle"><br /></div>
            <a href='admin/comment/' class="wp-has-submenu open-if-no-js menu-top menu-top-first">Коменнтарии к товару</a>
        </li>     *}          

{*        <li class="wp-has-submenu open-if-no-js menu-top menu-top {if isset($menuOpen) && $menuOpen=='slider'}wp-menu-open{/if}">
            <div class='wp-menu-image'><a href='admin/slider/'><br /></a></div>
            <div class="wp-menu-toggle"><br /></div>
            <a href='admin/slider/' class="wp-has-submenu open-if-no-js menu-top menu-top-first">Слайдер</a>
        </li>  *} 
            
{*        <li class="wp-has-submenu open-if-no-js menu-top menu-top {if isset($menuOpen) && $menuOpen=='callorder'}wp-menu-open{/if}">
            <div class='wp-menu-image'><a href='admin/callorder/'><br /></a></div>
            <div class="wp-menu-toggle"><br /></div>
            <a href='admin/callorder/' class="wp-has-submenu open-if-no-js menu-top menu-top-first">Заказ звонков</a>
        </li>   *}
            
        <li class="wp-has-submenu open-if-no-js menu-top menu-top {if isset($menuOpen) && $menuOpen=='buyonclick'}wp-menu-open{/if}">
            <div class='wp-menu-image'><a href='admin/buyonclick/'><br /></a></div>
            <div class="wp-menu-toggle"><br /></div>
            <a href='admin/buyonclick/' class="wp-has-submenu open-if-no-js menu-top menu-top-first">Покупки в один клик</a>
        </li> 
            
        <li class="wp-has-submenu open-if-no-js menu-top menu-top {if isset($menuOpen) && $menuOpen=='order'}wp-menu-open{/if}">
            <div class='wp-menu-image'><a href='admin/order/'><br /></a></div>
            <div class="wp-menu-toggle"><br /></div>
            <a href='admin/order/' class="wp-has-submenu open-if-no-js menu-top menu-top-first">Заказы</a>
        </li>             
            
        <li class="wp-has-submenu open-if-no-js menu-top menu-top {if isset($menuOpen) && $menuOpen=='feedback'}wp-menu-open{/if}">
            <div class='wp-menu-image'><a href='admin/feedback/'><br /></a></div>
            <div class="wp-menu-toggle"><br /></div>
            <a href='admin/feedback/' class="wp-has-submenu open-if-no-js menu-top menu-top-first">Обратная связь</a>
        </li>   
            
        <li class="wp-has-submenu open-if-no-js menu-top menu-top {if isset($menuOpen) && $menuOpen=='exclusive'}wp-menu-open{/if}">
            <div class='wp-menu-image'><a href='admin/exclusive/'><br /></a></div>
            <div class="wp-menu-toggle"><br /></div>
            <a href='admin/exclusive/' class="wp-has-submenu open-if-no-js menu-top menu-top-first">Заказ именных</a>
        </li>                
            
        <li class="wp-has-submenu open-if-no-js menu-top menu-top {if isset($menuOpen) && $menuOpen=='special'}wp-menu-open{/if}">
            <div class='wp-menu-image'><a href='admin/special/'><br /></a></div>
            <div class="wp-menu-toggle"><br /></div>
            <a href='admin/special/' class="wp-has-submenu open-if-no-js menu-top menu-top-first">Акции</a>
        </li>               
    
        <li class="wp-has-submenu open-if-no-js menu-top menu-top {if isset($menuOpen) && $menuOpen=='constructor'}wp-menu-open{/if}">
            <div class='wp-menu-image'><a href='admin/constructor/shaxta'><br /></a></div>
            <div class="wp-menu-toggle"><br /></div>
            <a href='admin/constructor/shaxta' class="wp-has-submenu menu-top menu-top-last" tabindex="1">Конструктор</a>
            <div class='wp-submenu'>
                <ul>
                    <li class="wp-first-item"><a href='admin/constructor/shaxta' class="wp-first-item">Шахта</a></li>
                    <li class="wp-first-item"><a href='admin/constructor/kolba' class="wp-first-item">Колба</a></li>
                    <li class="wp-first-item"><a href='admin/constructor/bowl' class="wp-first-item">Чаша</a></li>
                    <li class="wp-first-item"><a href='admin/constructor/trybka' class="wp-first-item">Трубка</a></li>
                    <li class="wp-first-item"><a href='admin/constructor/bludce' class="wp-first-item">Блюдце</a></li>
                    <li class="wp-first-item"><a href='admin/constructor/shipci' class="wp-first-item">Щипцы</a></li>
                    <li class="wp-first-item"><a href='admin/constructor/base' class="wp-first-item">База</a></li>
                </ul>
            </div>
        </li>                
            
        <li class="wp-has-submenu open-if-no-js menu-top menu-top {if isset($menuOpen) && $menuOpen=='mix'}wp-menu-open{/if}">
            <div class='wp-menu-image'><a href='admin/mix/tabac'><br /></a></div>
            <div class="wp-menu-toggle"><br /></div>
            <a href='admin/mix/tabac' class="wp-has-submenu menu-top menu-top-last" tabindex="1">Миксы</a>
            <div class='wp-submenu'>
                <ul>
                    <li class="wp-first-item"><a href='admin/mix/tabac' class="wp-first-item">Табаки</a></li>
                    <li class="wp-first-item"><a href='admin/mix/tabaccategory' class="wp-first-item">Категории табаков</a></li>
                </ul>
            </div>
        </li>  
            
        <li class="wp-has-submenu open-if-no-js menu-top menu-top {if isset($menuOpen) && $menuOpen=='ourwork'}wp-menu-open{/if}">
            <div class='wp-menu-image'><a href='admin/ourwork/'><br /></a></div>
            <div class="wp-menu-toggle"><br /></div>
            <a href='admin/ourwork/' class="wp-has-submenu open-if-no-js menu-top menu-top-first">Наши работы</a>
        </li>  
            
        <li class="wp-has-submenu open-if-no-js menu-top menu-top {if isset($menuOpen) && $menuOpen=='taste'}wp-menu-open{/if}">
            <div class='wp-menu-image'><a href='admin/taste/'><br /></a></div>
            <div class="wp-menu-toggle"><br /></div>
            <a href='admin/taste/' class="wp-has-submenu open-if-no-js menu-top menu-top-first">Попробовать</a>
        </li>    
            
        <li class="wp-has-submenu open-if-no-js menu-top menu-top {if isset($menuOpen) && $menuOpen=='testimonial'}wp-menu-open{/if}">
            <div class='wp-menu-image'><a href='admin/testimonial/'><br /></a></div>
            <div class="wp-menu-toggle"><br /></div>
            <a href='admin/testimonial/' class="wp-has-submenu open-if-no-js menu-top menu-top-first">Отзывы</a>
        </li>       
            
{*        <li class="wp-has-submenu open-if-no-js menu-top menu-top {if isset($menuOpen) && $menuOpen=='socialpost'}wp-menu-open{/if}">
            <div class='wp-menu-image'><a href='admin/socialpost/'><br /></a></div>
            <div class="wp-menu-toggle"><br /></div>
            <a href='admin/socialpost/' class="wp-has-submenu open-if-no-js menu-top menu-top-first">Посты в соц сети</a>
        </li>*}              
  
        <li class="wp-has-submenu open-if-no-js menu-top menu-top {if isset($menuOpen) && $menuOpen=='setting'}wp-menu-open{/if}">
            <div class='wp-menu-image'><a href='admin/setting/'><br /></a></div>
            <div class="wp-menu-toggle"><br /></div>
            <a href='admin/setting/' class="wp-has-submenu open-if-no-js menu-top menu-top-first">Настройки</a>
        </li>   
            
        <li class="wp-has-submenu open-if-no-js menu-top menu-top {if isset($menuOpen) && $menuOpen=='meta'}wp-menu-open{/if}">
            <div class='wp-menu-image'><a href='admin/meta/'><br /></a></div>
            <div class="wp-menu-toggle"><br /></div>
            <a href='admin/meta/' class="wp-has-submenu open-if-no-js menu-top menu-top-first">Мета Данные</a>
        </li>   
            
        <li class="wp-has-submenu open-if-no-js menu-top menu-top {if isset($menuOpen) && $menuOpen=='subscribe'}wp-menu-open{/if}">
            <div class='wp-menu-image'><a href='admin/subscribe/'><br /></a></div>
            <div class="wp-menu-toggle"><br /></div>
            <a href='admin/subscribe/' class="wp-has-submenu open-if-no-js menu-top menu-top-first">Подписчики</a>
        </li>   

        <li class="wp-has-submenu open-if-no-js menu-top menu-top {if isset($menuOpen) && $menuOpen=='letter'}wp-menu-open{/if}">
            <div class='wp-menu-image'><a href='admin/letter/'><br /></a></div>
            <div class="wp-menu-toggle"><br /></div>
            <a href='admin/letter/' class="wp-has-submenu open-if-no-js menu-top menu-top-first">Рассылка</a>
        </li>               
 
        <li class="wp-has-submenu menu-top {if isset($menuOpen) && $menuOpen=='user'}wp-menu-open{/if} menu-top-last" id="menu-tools">
            <div class='wp-menu-image' style="background: url('styles/images/menu.png') no-repeat scroll -302px -33px transparent;">
            <div class="wp-menu-toggle"><br /></div></div>
            <a href='admin/user' class="wp-has-submenu menu-top menu-top-last" tabindex="1">Пользователи</a>
            <div class='wp-submenu'>
                <ul>
                    <li class="wp-first-item"><a href='admin/user' class="wp-first-item">Список</a></li>
<!--                    <li class="wp-first-item"><a href='admin/permissions' class="wp-first-item">Permission</a></li>-->
                </ul>
            </div>
        </li>
            

            
	<li class="wp-menu-separator-last"><a class="separator" href="?unfoldmenu=1"><br /></a></li></ul>
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

<h2>{$title}</h2>

<div class='postbox-container' style='width:95%;'>
<div id="dashboard_quick_press" class="postbox " >
    <div class="inside">


