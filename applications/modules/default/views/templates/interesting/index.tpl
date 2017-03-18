{include file='header.tpl'}

<div class="contentInner">
    <div class="contentInnerLeft">
        <h1>{$pageTitle}</h1>
        <div class="clr"></div>          
        {if count($list.data)>0}
            {foreach from=$list.data item=p name=iter}
                <div class="interestingBlockNew" {if $smarty.foreach.iter.iteration is even}style='margin-right: 0;'{/if}>
                    <div class="interestingBlockLeft" onclick="redirect('interesting/{$p.url}.html');">
                        {if !empty($p.imageMedium)}
                            <div class="interesImage">
                                <img src="images/content/{$p.contentId}/{$p.imageMedium}" alt="{$p.title}" title="{$p.title}" />
                                <div class="clr"></div>
                            </div>
                            <div class="interesDescription">
                        {else}
                            <div class="interesDescriptionLong">
                        {/if}
                                <div class="interesTitle">{$p.title}</div>
                                <div class="clr"></div>                            
                                {$p.shortDescription}      
                                <div class="clr"></div>                            
                            </div>
                            <div class="clr"></div>
                    </div>
{*                    <div class="orangeLine"></div>
                    <div class="interestingRight">
                        <div class="share42initVert"
                                data-url="http://ace-hookah.com/interesting/{$p.url}.html"
                                data-title="{$p.title}"
                                data-description="{$p.shortDescription}"
                                data-image="http://ace-hookah.com/images/content/{$p.contentId}/{$p.imageMedium}"
                        ></div>   
                    </div>*}
                    <div class="clr"></div>
                </div>   
            {/foreach}                
        {else}
            Нет Данных.
        {/if}
        <div class="clr"></div>
    </div>
    <div class="clr"></div>
    {if count($mostViewedProduct)>0}
        <div class="likeProductBlock">
            <div class="likeProductTitle">Самые популярные товары</div>
            {foreach from=$mostViewedProduct item=p name=iter}
                <div id="productBlock_{$p.productId}" {if $smarty.foreach.iter.iteration is div by 3}class="productBlockMainLast"{else}class="productBlockMain"{/if}>
                    <div class="mainProductImage" 
                         style="background:transparent url('images/product/{$p.productId}/{$p.imageBig}') no-repeat 0 0;"
                         onclick="redirect('product/{$p.url}.html');">
                        <div class="priceAngle">
                            <span class="anglePriceVal">{$p.price}</span><br/>рублей
                        </div>
                        <div class="clr"></div>
                        <div class="mainProductTitle"><a href="product/{$p.url}.html">{$p.title}</a></div>
                        <div class="clr"></div>
                    </div>
                    <div class="clr"></div>
                    <div class="mainProductBuy analiticsToCartButton" onclick="toCart('{$p.productId}', true);">В корзину заказа</div>
                    <div class="clr"></div>
                    <div class="mainProductBuy" onclick="openModalBuyClick({$p.productId});">Купить в один клик</div>                    
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