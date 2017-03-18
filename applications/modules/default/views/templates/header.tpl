<!DOCTYPE html>
<html>
    <head>
        <title>{$meta.title}</title>
        <script type="text/javascript">
            var rootPath = '{$rootPath}';
        </script>    
        {if $current == 'checkout'}
            <script type="text/javascript">
                var isCheckoutPage = true;
            </script>      
        {else}
            <script type="text/javascript">
                var isCheckoutPage = false;
            </script>                  
        {/if}
        <base href="{$rootPath}" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="description" content="{$meta.description}" />
        <meta name="keywords" content="{$meta.keywords}" />
        <meta name="google-site-verification" content="Evj6qv-ldin4P7t5iXTIieBXJYjVkcJM-OQHi9Ga5ME" />
        <link rel="icon" type="image/png" href="http://ace-hookah.com/icon/favicon.png" />

        <link href='http://fonts.googleapis.com/css?family=Roboto:400,300italic,300,400italic,700' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="styles/main.css" type="text/css" />
        <link rel="stylesheet" href="styles/popup.css" type="text/css" />
        <link rel='stylesheet' href='styles/jqueryui/jquery-ui-1.9.1.custom.css' type='text/css' media='all' />
        <link rel='stylesheet' href='scripts/fancybox/jquery.fancybox-1.3.4.css' type='text/css' media='all' />

        <script type='text/javascript' src="scripts/jquery-1.8.2.min.js"></script>
        <script type='text/javascript' src='scripts/jquery-ui-1.9.1.min.js'></script>
        <script type='text/javascript' src="scripts/main.js"></script>
        <script type='text/javascript' src="scripts/validate.js"></script>
        <script type='text/javascript' src="scripts/popup.js"></script>
        <script type='text/javascript' src="scripts/fancybox/jquery.fancybox-1.3.4.js"></script>
        
        {if $current == 'contacts'}
            
            <script type="text/javascript">
                var loadMap = false;
            </script> 
            
{*            <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
            <script type="text/javascript">
                var loadMap = true;
            </script>  *}               
        {else}
            <script type="text/javascript">
                var loadMap = false;
            </script>                  
        {/if}        
        {if isset($scripts) && !empty($scripts)}
            {foreach from=$scripts item=s}
                <script type="text/javascript" src="scripts/{$s}"></script>
            {/foreach}
        {/if}
        {if isset($styles) && !empty($styles)}
            {foreach from=$styles item=s}
                <link rel="stylesheet" type="text/css" href="styles/{$s}" />
            {/foreach}
        {/if}
            
        {literal}
            <!-- Yandex.Metrika counter -->
            <script type="text/javascript">
            (function (d, w, c) {
                (w[c] = w[c] || []).push(function() {
                    try {
                        w.yaCounter27195152 = new Ya.Metrika({id:27195152,
                                webvisor:true,
                                clickmap:true,
                                trackLinks:true,
                                accurateTrackBounce:true});
                    } catch(e) { }
                });

                var n = d.getElementsByTagName("script")[0],
                    s = d.createElement("script"),
                    f = function () { n.parentNode.insertBefore(s, n); };
                s.type = "text/javascript";
                s.async = true;
                s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

                if (w.opera == "[object Opera]") {
                    d.addEventListener("DOMContentLoaded", f, false);
                } else { f(); }
            })(document, window, "yandex_metrika_callbacks");
            </script>
            <noscript><div><img src="//mc.yandex.ru/watch/27195152" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
            <!-- /Yandex.Metrika counter -->   
            
            <!-- Rating@Mail.ru counter -->
            <script type="text/javascript">
            var _tmr = _tmr || [];
            _tmr.push({id: "2598912", type: "pageView", start: (new Date()).getTime()});
            (function (d, w) {
               var ts = d.createElement("script"); ts.type = "text/javascript"; ts.async = true;
               ts.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//top-fwz1.mail.ru/js/code.js";
               var f = function () {var s = d.getElementsByTagName("script")[0]; s.parentNode.insertBefore(ts, s);};
               if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); }
            })(document, window);
            </script><noscript><div style="position:absolute;left:-10000px;">
            <img src="//top-fwz1.mail.ru/counter?id=2598912;js=na" style="border:0;" height="1" width="1" alt="Рейтинг@Mail.ru" />
            </div></noscript>
            <!-- //Rating@Mail.ru counter -->      
            
            <script>
              (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
              (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
              m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
              })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

              ga('create', 'UA-46315929-2', 'auto');
              ga('send', 'pageview');

            </script>            
        {/literal}
    </head>
    <body id="top">
        <div id="mask"></div>
        <header>
            <div class="header_top">
                <div class="centerPage">
                    <div class="header_top_menu">
                        <div class="top_header_menu_block{if $current == 'special'} selected_header_menu{/if}">
                            <a href="special">Дешевле</a>
                        </div>    
   {*                     <div class="top_header_menu_block{if $current == 'taste'} selected_header_menu{/if}">
                            <a href="taste">Попробовать</a>
                        </div>  *}                    
                        <div class="top_header_menu_block{if $current == 'interesting'} selected_header_menu{/if}">
                            <a href="interesting">Интересное</a>
                        </div>                          
                        <div class="top_header_menu_block{if $current == 'contacts'} selected_header_menu{/if}">
                            <a href="content/contacts.html">Контакты</a>
                        </div>  
                        {*<div class="top_header_menu_block{if $current == 'pay_delivery'} selected_header_menu{/if}">
                            <a href="content/pay_delivery.html">Оплата и Доставка</a>
                        </div> *}   
                        <div class="top_header_menu_block{if $current == 'testimonial'} selected_header_menu{/if}">
                            <a href="testimonial">Отзывы</a>
                        </div> 
                       {* <div class="top_header_menu_block no_margin_right{if $current == 'wholesale'} selected_header_menu{/if}">
                            <a href="wholesale">Сотрудничество</a>
                        </div> *}                            
                        <div class="clr"></div>
                    </div>
                    {if isset($smarty.session.user) && !empty($smarty.session.user)}
                        <div class="header_user_menu">
                            <a href="user/logout">выйти</a>
                        </div>                          
                    {else}
                        <div class="header_user_menu">
                            <a href="javascript:void(0);" onclick="openModal('login');">войти</a>
                        </div>                          
                        <div class="header_user_menu no_margin_left">
                            <a href="user/registry" target="_blank">регистрация</a>
                        </div>    
                    {/if}
                    <div class="clr"></div>
                </div>
                <div class="clr"></div>
            </div>
            <div class="clr"></div>
            <div class="header_middle">
                <div class="header_logo"{if $current != 'home'} style="cursor: pointer;" onclick="redirect('#');"{/if}>
                    <img src="i/logo.png" width="285px" height="70px" />
                </div>
                <div class="header_logo_subs">
                    <div class="header_divider"></div>
                    <div class="header_logo_subs_text">
                        Деревянные шахты, моющиеся шланги, оригинальные решения
                        <div class="header_phone">
                            +7<span class="color_orange">(978)</span>200-84-46
                        </div>
{*                        <div class="header_phone">
                            +7<span class="color_orange">(978)</span>719-98-87
                        </div> *}
                        <div class="header_email">
                            manager<span class="color_orange">@</span>ace-hookah.com
                        </div>                             
                        <div class="clr"></div>
                    </div>
                    <div class="header_divider"></div>
                    <div class="clr"></div>
                </div>
                <div class="basket">
                    {include file='cart.tpl'}
                </div>
                <div class="clr"></div>
            </div>
            <div class="clr"></div>
            <div class="header_menu">
                <div class="centerPage">
                    <div class="header_menu_block home_icon{if $current == 'home'} home_icon_active{/if}" onclick="redirect('#');"></div>                         
                    {foreach from=$categoryMenu.data item=mc}
                        <div class="header_menu_block{if $current == $mc.url} selected_header_menu{/if}">
                            <a href="catalog/{$mc.url}.html">{$mc.title}</a>
                        </div>                         
                    {/foreach}    
                    <div class="header_menu_block{if $current == 'constructor'} selected_header_menu{/if}">
                        <a href="constructor">Конструктор</a>
                    </div>     
                    <div class="header_menu_block{if $current == 'ourwork'} selected_header_menu{/if}">
                        <a href="ourwork">портфолио</a>
                    </div>      
                    <div class="header_menu_block last_menu_block{if $current == 'mix'} selected_header_menu{/if}">
                        <a href="mix">миксы</a>
                    </div>                    
                    <div class="mobile_menu">
                        <div class="m_m_click" onclick="slideMenu();">
                            <div class="m_m_icon"></div>
                            <div class="m_m_title">Меню</div>
                            <div class="clr"></div>
                        </div>
                        <div class="m_m_cart">{include file='cart.tpl'}</div>
                        <div class="clr"></div>
                        <div class="slide_menu">
                            {foreach from=$categoryMenu.data item=mc}
                                <div class="header_menu_block_slide{if $current == $mc.url} selected_header_menu_slide{/if}" onclick="redirect('catalog/{$mc.url}.html');">
                                    <a href="catalog/{$mc.url}.html">{$mc.title}</a>
                                </div>                                              
                            {/foreach} 
                            <div class="header_menu_block_slide{if $current == 'constructor'} selected_header_menu_slide{/if}" onclick="redirect('constructor');">
                                <a href="constructor">Конструктор</a>
                            </div>     
                            <div class="header_menu_block_slide{if $current == 'ourwork'} selected_header_menu_slide{/if}" onclick="redirect('ourwork');">
                                <a href="ourwork">Портфолио</a>
                            </div>      
                            <div class="header_menu_block_slide{if $current == 'mix'} selected_header_menu_slide{/if}" onclick="redirect('mix');">
                                <a href="mix">Миксы</a>
                            </div>                                   
                            <div class="header_menu_block_slide{if $current == 'special'} selected_header_menu_slide{/if}" onclick="redirect('special');">
                                <a href="special">Дешевле</a>
                            </div>    
                            <div class="header_menu_block_slide{if $current == 'taste'} selected_header_menu_slide{/if}" onclick="redirect('taste');">
                                <a href="taste">Попробовать</a>
                            </div>                      
                            <div class="header_menu_block_slide{if $current == 'interesting'} selected_header_menu_slide{/if}" onclick="redirect('interesting');">
                                <a href="interesting">Интересное</a>
                            </div>                          
                            <div class="header_menu_block_slide{if $current == 'contacts'} selected_header_menu_slide{/if}" onclick="redirect('content/contacts.html');">
                                <a href="content/contacts.html">Контакты</a>
                            </div>  
                            <div class="header_menu_block_slide{if $current == 'pay_delivery'} selected_header_menu_slide{/if}" onclick="redirect('content/pay_delivery.html');">
                                <a href="content/pay_delivery.html">Оплата и Доставка</a>
                            </div>    
                            <div class="header_menu_block_slide{if $current == 'testimonial'} selected_header_menu_slide{/if}" onclick="redirect('testimonial');">
                                <a href="testimonial">Отзывы</a>
                            </div>              
                            {*<div class="header_menu_block_slide{if $current == 'wholesale'} selected_header_menu_slid{/if}" onclick="redirect('wholesale');">
                                <a href="wholesale">Сотрудничество</a>
                            </div>  *}                                  
                            <div class="clr"></div>
                        </div>
                        <div class="clr"></div>
                    </div>
                    <div class="clr"></div>
                </div>
                <div class="clr"></div>
            </div>
            <div class="clr"></div>
        </header>
        <div id="content">  
            <div class="pageHeader">
                {if isset($bread)}
                    <div class="headerBread">{$bread}</div>
                {elseif $current == 'home'}
                    <div class="headerBread" style="padding-top: 7px;"><div class="whyWeTitle" style="margin-bottom: 0;">лучшие предложения</div></div>
                {/if}
                <div class="allProductButton" onclick="redirect('catalog/all');">вся продукция</div>
                <div class="exclusiveButton" onclick="redirect('exclusive');">заказать именной кальян</div>
                <div class="searchDiv">
                    <div class="searchButton" onclick="search();">
                        <img src="i/search.png" />
                    </div>
                    <div class="searchBlock">
                        <input type="text" id="searchInp" 
                               {if !empty($searchKey)}value="{$searchKey}" class="searchNotEmpty"{else}value="Поиск по каталогу"{/if} 
                               name="searchKey"
                               onkeyup="headerSearchEnter(event);"
                               onclick="searchInputClick();"
                               onblur="searchInputBlur();"/>
                    </div>  
                    <div class="clr"></div>
                </div>
                <div class="clr"></div>
                {if isset($bread)}
                    <div class="headerBreadHidden">{$bread}</div>
                {elseif $current == 'home'}
                    <div class="headerBreadHidden" style="padding-top: 7px;"><div class="whyWeTitle" style="margin-bottom: 0;">лучшие предложения</div></div>
                {/if}                
                <div class="clr"></div>
            </div>
            <div class="clr"></div>