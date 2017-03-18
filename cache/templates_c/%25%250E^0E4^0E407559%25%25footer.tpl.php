<?php /* Smarty version 2.6.19, created on 2017-03-18 15:55:26
         compiled from footer.tpl */ ?>
            </div>
            <div class="clr"></div>
            <div class="toTopBig" id="toTopBig" onmouseover="toTopHover($(this));" onmouseout="toTopOut($(this));"
                 onclick="scrollTo('top');">
                <div class="toTopInfo">
                    <div class="toTopImg"><img src="i/up_arrow.png" /></div>
                    <div class="toTopText">Наверх</div>
                </div>
            </div>            
            <div class="clr"></div>
            <footer id="footerBlock">
                <div class="centerPage">
                    <div class="footerLeft">
                        <?php $_from = $this->_tpl_vars['categoryMenu']['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['mc']):
?>
                            <div class="footer_menu_block_new">
                                  <a href="catalog/<?php echo $this->_tpl_vars['mc']['url']; ?>
.html"><?php echo $this->_tpl_vars['mc']['title']; ?>
</a>
                            </div>       
                            <div class="clr"></div>
                        <?php endforeach; endif; unset($_from); ?>
                        <div class="footer_menu_block_new last_footer_block">
                            <a href="catalog/all">Вся продукция</a>
                        </div>  
                    </div>
                    <div class="footerCenter">
                        <div class="footer_menu_block_new">
                            <a href="constructor">Конструктор</a>
                        </div>    
                        <div class="clr"></div>
                        <div class="footer_menu_block_new">
                            <a href="mix">миксы</a>
                        </div>   
                        <div class="clr"></div>
                        <div class="footer_menu_block_new">
                            <a href="ourwork">портфолио</a>
                        </div>   
                        <div class="clr"></div>
                        <div class="footer_menu_block_new">
                            <a href="exclusive">заказать именной</a>
                        </div>   
                        <div class="clr"></div>                        
                        <div class="footer_menu_block_new">
                            <a href="interesting">Интересное</a>
                        </div>     
                        <div class="clr"></div>                        
                        <div class="footer_menu_block_new last_footer_block">
                            <a href="special">Дешевле</a>
                        </div>  
                        <div class="clr"></div>
                    </div>
                    <div class="footerRight">
                        <div class="footer_menu_block_new">
                            <a href="testimonial">Отзывы</a>
                        </div>     
                        <div class="clr"></div>
                        <div class="footer_menu_block_new">
                            <a href="content/pay_delivery.html">Оплата и Доставка</a>
                        </div>   
                                                <div class="footer_menu_block_new">
                            <a href="content/contacts.html">Контакты</a>
                        </div>    
                        <div class="clr"></div>
                        <div class="footer_menu_block_new last_footer_block">
                            <a href="sitemap">Карта сайта</a>
                        </div>    
                        <div class="clr"></div>                        
                    </div>                    
                    <div class="clr"></div><br/><br/><br/>
                    <div class="socialFooter">
                        <div class="footer_social_button vk" onclick="window.open('http://vk.com/ace_hookah');"></div>
                        <div class="footer_social_button fb" onclick="window.open('https://www.facebook.com/pages/Ace-Hookah/530153360452187');"></div>
                        <div class="footer_social_button tw last_menu_block" onclick="window.open('https://twitter.com/hookahace');"></div>
                        <div class="clr"></div>
                    </div>
                    <div class="clr"></div><br/><br/>
                    <div class="authorFooter">
                        &copy; ace-hookah.com
                    </div>                       
                    <div class="footerSubs">
                        <div class="footerSubsButton" onclick="openModalSubs('user', 'footer');">подписаться</div>
                        <div class="clr"></div>
                    </div>                    
                   
                    <div class="clr"></div>
                </div>
                <div class="clr"></div>          
            </footer>
            <div class="clr"></div>
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'popup_login.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>  
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'to_basket.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'popup_subscribe.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>     
    </body>
</html>