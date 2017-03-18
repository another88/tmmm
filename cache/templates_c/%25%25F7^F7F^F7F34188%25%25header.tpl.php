<?php /* Smarty version 2.6.19, created on 2017-03-18 15:55:26
         compiled from header.tpl */ ?>
<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $this->_tpl_vars['meta']['title']; ?>
</title>
        <script type="text/javascript">
            var rootPath = '<?php echo $this->_tpl_vars['rootPath']; ?>
';
        </script>    
        <?php if ($this->_tpl_vars['current'] == 'checkout'): ?>
            <script type="text/javascript">
                var isCheckoutPage = true;
            </script>      
        <?php else: ?>
            <script type="text/javascript">
                var isCheckoutPage = false;
            </script>                  
        <?php endif; ?>
        <base href="<?php echo $this->_tpl_vars['rootPath']; ?>
" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="description" content="<?php echo $this->_tpl_vars['meta']['description']; ?>
" />
        <meta name="keywords" content="<?php echo $this->_tpl_vars['meta']['keywords']; ?>
" />
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
        
        <?php if ($this->_tpl_vars['current'] == 'contacts'): ?>
            
            <script type="text/javascript">
                var loadMap = false;
            </script> 
            
               
        <?php else: ?>
            <script type="text/javascript">
                var loadMap = false;
            </script>                  
        <?php endif; ?>        
        <?php if (isset ( $this->_tpl_vars['scripts'] ) && ! empty ( $this->_tpl_vars['scripts'] )): ?>
            <?php $_from = $this->_tpl_vars['scripts']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['s']):
?>
                <script type="text/javascript" src="scripts/<?php echo $this->_tpl_vars['s']; ?>
"></script>
            <?php endforeach; endif; unset($_from); ?>
        <?php endif; ?>
        <?php if (isset ( $this->_tpl_vars['styles'] ) && ! empty ( $this->_tpl_vars['styles'] )): ?>
            <?php $_from = $this->_tpl_vars['styles']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['s']):
?>
                <link rel="stylesheet" type="text/css" href="styles/<?php echo $this->_tpl_vars['s']; ?>
" />
            <?php endforeach; endif; unset($_from); ?>
        <?php endif; ?>
            
        <?php echo '
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
              (function(i,s,o,g,r,a,m){i[\'GoogleAnalyticsObject\']=r;i[r]=i[r]||function(){
              (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
              m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
              })(window,document,\'script\',\'//www.google-analytics.com/analytics.js\',\'ga\');

              ga(\'create\', \'UA-46315929-2\', \'auto\');
              ga(\'send\', \'pageview\');

            </script>            
        '; ?>

    </head>
    <body id="top">
        <div id="mask"></div>
        <header>
            <div class="header_top">
                <div class="centerPage">
                    <div class="header_top_menu">
                        <div class="top_header_menu_block<?php if ($this->_tpl_vars['current'] == 'special'): ?> selected_header_menu<?php endif; ?>">
                            <a href="special">Дешевле</a>
                        </div>    
                       
                        <div class="top_header_menu_block<?php if ($this->_tpl_vars['current'] == 'interesting'): ?> selected_header_menu<?php endif; ?>">
                            <a href="interesting">Интересное</a>
                        </div>                          
                        <div class="top_header_menu_block<?php if ($this->_tpl_vars['current'] == 'contacts'): ?> selected_header_menu<?php endif; ?>">
                            <a href="content/contacts.html">Контакты</a>
                        </div>  
                           
                        <div class="top_header_menu_block<?php if ($this->_tpl_vars['current'] == 'testimonial'): ?> selected_header_menu<?php endif; ?>">
                            <a href="testimonial">Отзывы</a>
                        </div> 
                                                   
                        <div class="clr"></div>
                    </div>
                    <?php if (isset ( $_SESSION['user'] ) && ! empty ( $_SESSION['user'] )): ?>
                        <div class="header_user_menu">
                            <a href="user/logout">выйти</a>
                        </div>                          
                    <?php else: ?>
                        <div class="header_user_menu">
                            <a href="javascript:void(0);" onclick="openModal('login');">войти</a>
                        </div>                          
                        <div class="header_user_menu no_margin_left">
                            <a href="user/registry" target="_blank">регистрация</a>
                        </div>    
                    <?php endif; ?>
                    <div class="clr"></div>
                </div>
                <div class="clr"></div>
            </div>
            <div class="clr"></div>
            <div class="header_middle">
                <div class="header_logo"<?php if ($this->_tpl_vars['current'] != 'home'): ?> style="cursor: pointer;" onclick="redirect('#');"<?php endif; ?>>
                    <img src="i/logo.png" width="285px" height="70px" />
                </div>
                <div class="header_logo_subs">
                    <div class="header_divider"></div>
                    <div class="header_logo_subs_text">
                        Деревянные шахты, моющиеся шланги, оригинальные решения
                        <div class="header_phone">
                            +7<span class="color_orange">(978)</span>200-84-46
                        </div>
                        <div class="header_email">
                            manager<span class="color_orange">@</span>ace-hookah.com
                        </div>                             
                        <div class="clr"></div>
                    </div>
                    <div class="header_divider"></div>
                    <div class="clr"></div>
                </div>
                <div class="basket">
                    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'cart.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                </div>
                <div class="clr"></div>
            </div>
            <div class="clr"></div>
            <div class="header_menu">
                <div class="centerPage">
                    <div class="header_menu_block home_icon<?php if ($this->_tpl_vars['current'] == 'home'): ?> home_icon_active<?php endif; ?>" onclick="redirect('#');"></div>                         
                    <?php $_from = $this->_tpl_vars['categoryMenu']['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['mc']):
?>
                        <div class="header_menu_block<?php if ($this->_tpl_vars['current'] == $this->_tpl_vars['mc']['url']): ?> selected_header_menu<?php endif; ?>">
                            <a href="catalog/<?php echo $this->_tpl_vars['mc']['url']; ?>
.html"><?php echo $this->_tpl_vars['mc']['title']; ?>
</a>
                        </div>                         
                    <?php endforeach; endif; unset($_from); ?>    
                    <div class="header_menu_block<?php if ($this->_tpl_vars['current'] == 'constructor'): ?> selected_header_menu<?php endif; ?>">
                        <a href="constructor">Конструктор</a>
                    </div>     
                    <div class="header_menu_block<?php if ($this->_tpl_vars['current'] == 'ourwork'): ?> selected_header_menu<?php endif; ?>">
                        <a href="ourwork">портфолио</a>
                    </div>      
                    <div class="header_menu_block last_menu_block<?php if ($this->_tpl_vars['current'] == 'mix'): ?> selected_header_menu<?php endif; ?>">
                        <a href="mix">миксы</a>
                    </div>                    
                    <div class="mobile_menu">
                        <div class="m_m_click" onclick="slideMenu();">
                            <div class="m_m_icon"></div>
                            <div class="m_m_title">Меню</div>
                            <div class="clr"></div>
                        </div>
                        <div class="m_m_cart"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'cart.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div>
                        <div class="clr"></div>
                        <div class="slide_menu">
                            <?php $_from = $this->_tpl_vars['categoryMenu']['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['mc']):
?>
                                <div class="header_menu_block_slide<?php if ($this->_tpl_vars['current'] == $this->_tpl_vars['mc']['url']): ?> selected_header_menu_slide<?php endif; ?>" onclick="redirect('catalog/<?php echo $this->_tpl_vars['mc']['url']; ?>
.html');">
                                    <a href="catalog/<?php echo $this->_tpl_vars['mc']['url']; ?>
.html"><?php echo $this->_tpl_vars['mc']['title']; ?>
</a>
                                </div>                                              
                            <?php endforeach; endif; unset($_from); ?> 
                            <div class="header_menu_block_slide<?php if ($this->_tpl_vars['current'] == 'constructor'): ?> selected_header_menu_slide<?php endif; ?>" onclick="redirect('constructor');">
                                <a href="constructor">Конструктор</a>
                            </div>     
                            <div class="header_menu_block_slide<?php if ($this->_tpl_vars['current'] == 'ourwork'): ?> selected_header_menu_slide<?php endif; ?>" onclick="redirect('ourwork');">
                                <a href="ourwork">Портфолио</a>
                            </div>      
                            <div class="header_menu_block_slide<?php if ($this->_tpl_vars['current'] == 'mix'): ?> selected_header_menu_slide<?php endif; ?>" onclick="redirect('mix');">
                                <a href="mix">Миксы</a>
                            </div>                                   
                            <div class="header_menu_block_slide<?php if ($this->_tpl_vars['current'] == 'special'): ?> selected_header_menu_slide<?php endif; ?>" onclick="redirect('special');">
                                <a href="special">Дешевле</a>
                            </div>    
                            <div class="header_menu_block_slide<?php if ($this->_tpl_vars['current'] == 'taste'): ?> selected_header_menu_slide<?php endif; ?>" onclick="redirect('taste');">
                                <a href="taste">Попробовать</a>
                            </div>                      
                            <div class="header_menu_block_slide<?php if ($this->_tpl_vars['current'] == 'interesting'): ?> selected_header_menu_slide<?php endif; ?>" onclick="redirect('interesting');">
                                <a href="interesting">Интересное</a>
                            </div>                          
                            <div class="header_menu_block_slide<?php if ($this->_tpl_vars['current'] == 'contacts'): ?> selected_header_menu_slide<?php endif; ?>" onclick="redirect('content/contacts.html');">
                                <a href="content/contacts.html">Контакты</a>
                            </div>  
                            <div class="header_menu_block_slide<?php if ($this->_tpl_vars['current'] == 'pay_delivery'): ?> selected_header_menu_slide<?php endif; ?>" onclick="redirect('content/pay_delivery.html');">
                                <a href="content/pay_delivery.html">Оплата и Доставка</a>
                            </div>    
                            <div class="header_menu_block_slide<?php if ($this->_tpl_vars['current'] == 'testimonial'): ?> selected_header_menu_slide<?php endif; ?>" onclick="redirect('testimonial');">
                                <a href="testimonial">Отзывы</a>
                            </div>              
                                                              
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
                <?php if (isset ( $this->_tpl_vars['bread'] )): ?>
                    <div class="headerBread"><?php echo $this->_tpl_vars['bread']; ?>
</div>
                <?php elseif ($this->_tpl_vars['current'] == 'home'): ?>
                    <div class="headerBread" style="padding-top: 7px;"><div class="whyWeTitle" style="margin-bottom: 0;">лучшие предложения</div></div>
                <?php endif; ?>
                <div class="allProductButton" onclick="redirect('catalog/all');">вся продукция</div>
                <div class="exclusiveButton" onclick="redirect('exclusive');">заказать именной кальян</div>
                <div class="searchDiv">
                    <div class="searchButton" onclick="search();">
                        <img src="i/search.png" />
                    </div>
                    <div class="searchBlock">
                        <input type="text" id="searchInp" 
                               <?php if (! empty ( $this->_tpl_vars['searchKey'] )): ?>value="<?php echo $this->_tpl_vars['searchKey']; ?>
" class="searchNotEmpty"<?php else: ?>value="Поиск по каталогу"<?php endif; ?> 
                               name="searchKey"
                               onkeyup="headerSearchEnter(event);"
                               onclick="searchInputClick();"
                               onblur="searchInputBlur();"/>
                    </div>  
                    <div class="clr"></div>
                </div>
                <div class="clr"></div>
                <?php if (isset ( $this->_tpl_vars['bread'] )): ?>
                    <div class="headerBreadHidden"><?php echo $this->_tpl_vars['bread']; ?>
</div>
                <?php elseif ($this->_tpl_vars['current'] == 'home'): ?>
                    <div class="headerBreadHidden" style="padding-top: 7px;"><div class="whyWeTitle" style="margin-bottom: 0;">лучшие предложения</div></div>
                <?php endif; ?>                
                <div class="clr"></div>
            </div>
            <div class="clr"></div>