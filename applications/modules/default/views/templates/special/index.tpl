{include file='header.tpl'}

<div class="contentInner">
    <div class="contentInnerLeft">
        <h1>{$pageTitle}</h1>
        <div class="clr"></div>             
        {if count($specials.data)>0}
            {foreach from=$specials.data item=p name=iter}
                <div class="mixSearchResultBlock" {if $smarty.foreach.iter.iteration is even}style='margin-right: 0;'{/if}>
                    <div class="mixSearchBlockLeft">
                        <div class="specialImage">
                            <img src="images/special/{$p.specialId}/{$p.imageMedium}" alt="{$p.title}" title="{$p.title}" />
                            <div class="clr"></div>
                        </div>
                        <div class="specialDescription">
                            <div class="specialTitle">{$p.title}</div>
                            <div class="clr"></div>                            
                            {$p.description}      
                            <div class="clr"></div>                            
                        </div>
                        <div class="clr"></div>
                    </div>
                    <div class="orangeLine"></div>
                    <div class="mixSearchBlockRight">
                        <div class="share42initVert"
                                data-url="http://ace-hookah.com/special"
                                data-title="{$p.title}"
                                data-description="{$p.description}"
                                data-image="http://ace-hookah.com/images/special/{$p.specialId}/{$p.imageMedium}"
                        ></div>   
                    </div>
                    <div class="clr"></div>
                </div>                
            {/foreach}    
            {literal}
                <script type="text/javascript" src="share42/share42Vert.js"></script>
            {/literal}             
        {else}
            Нет Данных.
        {/if}
        <div class="clr"></div>
    </div>
    <div class="clr"></div>
    {if count($mostViewedProduct)>0}
        <div class="likeProductBlock">
            <div class="likeProductTitle">Самые популярные товары</div>
            {foreach from=$mostViewedProduct item=pr name=iter}
                <div id="productBlock_{$pr.productId}" {if $smarty.foreach.iter.iteration is div by 3}class="productBlockMainLast"{else}class="productBlockMain"{/if}>
                    <div class="mainProductImage" 
                         style="background:transparent url('images/product/{$pr.productId}/{$pr.imageBig}') no-repeat 0 0;"
                         onclick="redirect('product/{$pr.url}.html');">
                        <div class="priceAngle">
                            <span class="anglePriceVal">{$pr.price}</span><br/>рублей
                        </div>
                        <div class="clr"></div>
                        <div class="mainProductTitle"><a href="product/{$pr.url}.html">{$pr.title}</a></div>
                        <div class="clr"></div>
                    </div>
                    <div class="clr"></div>
                    <div class="mainProductBuy analiticsToCartButton" onclick="toCart('{$pr.productId}', true);">В корзину заказа</div>
                    <div class="clr"></div>
                    <div class="mainProductBuy" onclick="openModalBuyClick({$pr.productId});">Купить в один клик</div>                    
                    <div class="clr"></div>
                    {include file='on_click.tpl'}  
                    <div class="clr"></div>
                </div>
            {/foreach} 
            <div class="clr"></div>
        </div>
        <div class="clr"></div>
    {/if}         
</div>
        
{include file='footer.tpl'}