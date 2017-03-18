{if isset($mostViewedProduct) && count($mostViewedProduct)>0}
    <div class="mostViewed">
        <div class="rightTitle">Самые популярные</div>
        <div class="clr"></div>
        {foreach from=$mostViewedProduct item=mvp}
            <div class="rigthItem">
                <div class="rightItemImage">
                    <a href="product/{$mvp.url}.html" target="_blank">
                        <img src="images/product/{$mvp.productId}/{$mvp.imageSmall}" alt="{$mvp.metaTitle}" title="{$mvp.metaTitle}" />
                    </a>
                </div>
                <div class="rightItemDescription">
                    <a href="product/{$mvp.url}.html" target="_blank">{$mvp.title}, {$mvp.price} руб</a>
                    <div class="clr"></div>
                    {$mvp.shortDescription}
                    <div class="clr"></div>
                </div>  
                <div class="clr"></div>
            </div>
            <div class="clr"></div>
        {/foreach}
    </div>
    <div class="clr"></div>
{/if}

{if isset($mostBuyedProduct) && count($mostBuyedProduct)>0}
    <div class="mostViewed">
        <div class="rightTitle">Самые продаваемые</div>
        <div class="clr"></div>
        {foreach from=$mostBuyedProduct item=mbp}
            <div class="rigthItem">
                <div class="rightItemImage">
                    <a href="product/{$mbp.url}.html" target="_blank">
                        <img src="images/product/{$mbp.productId}/{$mbp.imageSmall}" alt="{$mbp.metaTitle}" title="{$mbp.metaTitle}" />
                    </a>
                </div>
                <div class="rightItemDescription">
                    <a href="product/{$mbp.url}.html" target="_blank">{$mbp.title}, {$mbp.price} руб</a>
                    <div class="clr"></div>
                    {$mbp.shortDescription}
                    <div class="clr"></div>
                </div>  
                <div class="clr"></div>
            </div>
            <div class="clr"></div>
        {/foreach}
    </div> 
    <div class="clr"></div>
{/if}

{if isset($productLike) && count($productLike.data)>0}
    <div class="mostViewed">
        {if isset($p)}
            <div class="rightTitle">С "{$p.title}" часто покупают</div>
        {else}
            <div class="rightTitle">С этими товарами часто покупают</div>            
        {/if}
        <div class="clr"></div>
        {foreach from=$productLike.data item=mvp}
            <div class="rigthItem">
                <div class="rightItemImage">
                    <a href="product/{$mvp.url}.html" target="_blank">
                        <img src="images/product/{$mvp.productId}/{$mvp.imageSmall}" alt="{$mvp.metaTitle}" title="{$mvp.metaTitle}" />
                    </a>
                </div>
                <div class="rightItemDescription">
                    <a href="product/{$mvp.url}.html" target="_blank">{$mvp.title}, {$mvp.price} руб</a>
                    <div class="clr"></div>
                    {$mvp.shortDescription}
                    <div class="clr"></div>
                    <div class="likeProductButton" 
                         {if $current == 'checkout'}
                            onclick="toCart('{$mvp.productId}', false);"                             
                         {else}
                            onclick="toCart('{$mvp.productId}', true);"
                         {/if}
                    >В корзину</div>
                    <div class="clr"></div>                            
                </div>  
                <div class="clr"></div>

            </div>
            <div class="clr"></div>
        {/foreach}
    </div>
    <div class="clr"></div>
{/if}