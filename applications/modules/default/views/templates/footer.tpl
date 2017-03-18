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
                        {foreach from=$categoryMenu.data item=mc}
                            <div class="footer_menu_block_new">
                                  <a href="catalog/{$mc.url}.html">{$mc.title}</a>
                            </div>       
                            <div class="clr"></div>
                        {/foreach}
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
{*                        <div class="footer_menu_block_new">
                            <a href="taste">Попробовать</a>
                        </div>   
                        <div class="clr"></div>*}
                        <div class="footer_menu_block_new">
                            <a href="testimonial">Отзывы</a>
                        </div>     
                        <div class="clr"></div>
                        <div class="footer_menu_block_new">
                            <a href="content/pay_delivery.html">Оплата и Доставка</a>
                        </div>   
                        {*<div class="footer_menu_block_new">
                            <a href="wholesale">Сотрудничество</a>
                        </div>                           
                        <div class="clr"></div>*}
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
            {include file='popup_login.tpl'}  
            {include file='to_basket.tpl'}
            {include file='popup_subscribe.tpl'}     
    </body>
</html>