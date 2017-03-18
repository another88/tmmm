{include file='header.tpl'}

<div class="contentInner">
    <div class="contentInnerLeft">
        <h1>{$pageTitle}</h1>
        <div class="clr"></div><br/>   
        <div class="smLeft">
            <div class="smTitle">каталог</div>
            <div class="clr"></div>
            <div class="smSubBlock">
                {foreach from=$categorySm.data item=mc name=fcm}
                    <div class="sm_item{if $smarty.foreach.fcm.last} last_sm_block{/if}">
                        <a href="catalog/{$mc.url}.html" target="_blank">{$mc.title}</a>
                    </div>       
                    <div class="clr"></div>
                    {if count($mc.product.data)>0}
                        <div class="smSubSubBlock">
                            {foreach from=$mc.product.data item=mcp name=fcmp}
                                <div class="sm_item{if $smarty.foreach.fcmp.last} last_sm_block{/if}">
                                    <a href="product/{$mcp.url}.html" target="_blank">{$mcp.title}</a>
                                </div>       
                                <div class="clr"></div>
                            {/foreach}                            
                        </div>
                        <div class="clr"></div>
                    {/if}
                {/foreach}
            </div>
            <div class="clr"></div>
        </div>
        <div class="smRight">
            <div class="smBlock">
                <div class="smTitle">На ознакомление</div>
                <div class="clr"></div>
                <div class="smSubBlock">
                    <div class="sm_item">
                        <a href="constructor" target="_blank">Конструктор</a>
                    </div>    
                    <div class="clr"></div>
                    <div class="sm_item">
                        <a href="mix" target="_blank">Миксы</a>
                    </div>   
                    <div class="clr"></div>
                    <div class="sm_item">
                        <a href="ourwork" target="_blank">Портфолио</a>
                    </div>   
                    <div class="clr"></div>
                    <div class="sm_item">
                        <a href="interesting" target="_blank">Интересное</a>
                    </div>     
                    <div class="clr"></div>  
                    {if count($interestingList.data)>0}
                        <div class="smSubSubBlock">
                            {foreach from=$interestingList.data item=il name=iter}
                                <div class="sm_item">
                                    <a href="interesting/{$il.url}.html" target="_blank">{$il.title}</a>
                                </div>                              
                                <div class="clr"></div>
                            {/foreach}
                        </div>
                        <div class="clr"></div>
                    {/if}                    
                    <div class="sm_item last_sm_block">
                        <a href="special" target="_blank">Дешевле</a>
                    </div>  
                    <div class="clr"></div>
                </div>
                <div class="clr"></div>
            </div>
            <div class="smBlock">
                <div class="smTitle">О нас</div>
                <div class="clr"></div>
                <div class="smSubBlock">
                    <div class="sm_item ">
                        <a href="taste" target="_blank">Попробовать</a>
                    </div>   
                    <div class="clr"></div>
                    <div class="sm_item ">
                        <a href="testimonial" target="_blank">Отзывы</a>
                    </div>     
                    <div class="clr"></div>
                    <div class="sm_item ">
                        <a href="content/pay_delivery.html" target="_blank">Оплата и Доставка</a>
                    </div>   
                    <div class="clr"></div>
                    <div class="sm_item ">
                        <a href="content/contacts.html" target="_blank">Контакты</a>
                    </div>    
                    <div class="clr"></div>
                    <div class="sm_item last_sm_block">
                        <a href="sitemap" target="_blank">Карта сайта</a>
                    </div>    
                    <div class="clr"></div>  
                </div>
                <div class="clr"></div>
            </div>  
            <div class="clr"></div>
        </div>
        <div class="clr"></div>
    </div>
    <div class="contentInnerRight">
        {include file='right_side.tpl'}
    </div>
    <div class="clr"></div>
</div>

{include file='footer.tpl'}