<div class="mostViewedCenter">
    {if isset($mostViewedProduct) && count($mostViewedProduct)>0}
        <div class="mostViewed">
            <h2>Самые популярные</h2>
            <div class="clr"></div>
            <div id="mostPop" class="scroll-img">
              <ul>        
                {foreach from=$mostViewedProduct item=mvp}
                    <li>
                        <a href="product/{$mvp.url}.html" target="_blank">
                            <img src="images/product/{$mvp.productId}/{$mvp.imageMedium}" alt="{$mvp.metaTitle}" title="{$mvp.metaTitle}"/>
                        </a>
                        <div class="clr"></div> 
                        <a href="product/{$mvp.url}.html" target="_blank">{$mvp.title}, {$mvp.price} руб</a>
                        <div class="clr"></div> 
                    </li>
                {/foreach}
              </ul>
              <div class="clr"></div> 
            </div>   
            <div class="clr"></div> 
        </div>
    {/if}

    {if isset($mostBuyedProduct) && count($mostBuyedProduct)>0}
        <div class="mostViewed no_margin_right">
            <h2>Самые продаваемые</h2>
            <div class="clr"></div>
            <div id="mostBuy" class="scroll-img">
              <ul>        
                {foreach from=$mostBuyedProduct item=mbp}
                    <li>
                        <a href="product/{$mbp.url}.html" target="_blank">
                            <img src="images/product/{$mbp.productId}/{$mbp.imageMedium}" alt="{$mbp.metaTitle}" title="{$mbp.metaTitle}"/>
                        </a>
                        <div class="clr"></div> 
                        <a href="product/{$mbp.url}.html" target="_blank">{$mbp.title}, {$mbp.price} руб</a>
                        <div class="clr"></div> 
                    </li>
                {/foreach}
              </ul>
              <div class="clr"></div> 
            </div>   
            <div class="clr"></div> 
        </div>
    {/if}
    
{*    {if isset($productLike) && count($productLike.data)>0}
        <div class="mostViewed">
            <h2>
            {if isset($p)}
                С "{$p.title}" часто покупают
            {else}
                С этими товарами часто покупают            
            {/if}                
            </h2>
            <div class="clr"></div>
            <div id="prLke" class="scroll-img">
              <ul>        
                {foreach from=$productLike.data item=mvp}
                    <li>
                        <a href="product/{$mvp.url}.html" target="_blank">
                            <img src="images/product/{$mvp.productId}/{$mvp.imageMedium}" alt="{$mvp.metaTitle}" title="{$mvp.metaTitle}" />
                        </a>
                        <div class="clr"></div> 
                        <a href="product/{$mvp.url}.html" target="_blank">{$mvp.title}, {$mvp.price} руб</a>
                        <div class="clr"></div> 
                        <div class="likeProductButton" 
                             {if $current == 'checkout'}
                                onclick="toCart('{$mvp.productId}', false);"                             
                             {else}
                                onclick="toCart('{$mvp.productId}', true);"
                             {/if}
                        >В корзину</div>                        
                        <div class="clr"></div> 
                    </li>
                {/foreach}
              </ul>
              <div class="clr"></div> 
            </div>   
            <div class="clr"></div> 
        </div>   
              
              
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
    {/if}   *} 
    <div class="clr"></div> 
</div> 
<div class="clr"></div> 
