            </div>  {* end content *}
            <div class="clr"></div>
            <footer>
                <div class="centerPage">
                    {foreach from=$categoryMenu.data item=mc}
                        <div class="footer_menu_block">
                              <a href="catalog/{$mc.url}.html">{$mc.title}</a>
                        </div>                         
                    {/foreach}                       
                    <div class="footer_menu_block">
                        <a href="constructor">Конструктор</a>
                    </div>   
                    <div class="footer_menu_block">
                        <a href="ourwork">портфолио</a>
                    </div>   
                    <div class="footer_menu_block">
                        <a href="mix">миксы</a>
                    </div>   
                    <div class="footer_menu_block">
                        <a href="special">Дешевле</a>
                    </div>   
                    <div class="footer_menu_block">
                        <a href="taste">Попробовать</a>
                    </div>   
                    <div class="footer_menu_block">
                        <a href="interesting">Интересное</a>
                    </div>                       
                    <div class="footer_menu_block">
                        <a href="content/pay_delivery.html">Оплата и Доставка</a>
                    </div>   
                    <div class="footer_menu_block last_menu_block">
                        <a href="content/contacts.html">Контакты</a>
                    </div>        
                    <div class="toTop">
                        <img src="i/top_arrow_back.png" onclick="scrollTo('top');"/>
                    </div>
                    <div class="clr"></div><br/><br/><br/>
                    <div class="socialFooter">
                        <div class="footer_social_button vk" onclick="window.open('http://vk.com/ace_hookah');"></div>
                        <div class="footer_social_button fb" onclick="window.open('https://www.facebook.com/pages/Ace-Hookah/530153360452187');"></div>
                        <div class="footer_social_button tw last_menu_block" onclick="window.open('https://twitter.com/hookahace');"></div>
                        <div class="clr"></div>
                    </div>
                    <div class="clr"></div><br/><br/><br/>
                    <div class="authorFooter">
                        &copy; ace-hookah.com
                    </div>                    
                    <div class="clr"></div>
                </div>
                <div class="clr"></div>          
            </footer>
            <div class="clr"></div>
            {include file='popup_login.tpl'}  
{*            {include file='popup_call.tpl'}*}
            {include file='to_basket.tpl'}
                        <span id="openstat2372424"></span>
                        {literal}
                            <script type="text/javascript">
                            var openstat = { counter: 2372424, next: openstat, track_links: "all" };
                            (function(d, t, p) {
                            var j = d.createElement(t); j.async = true; j.type = "text/javascript";
                            j.src = ("https:" == p ? "https:" : "http:") + "//openstat.net/cnt.js";
                            var s = d.getElementsByTagName(t)[0]; s.parentNode.insertBefore(j, s);
                            })(document, "script", document.location.protocol);
                            </script>
                        {/literal}            
    </body>
</html>