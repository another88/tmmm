{include file='header.tpl'}

<div class="contentInner">
    {if count($products.data)>0}
        {foreach from=$products.data item=p name=iter}
            <div class="productPageImage" id="productImage">
                <a href="images/product/{$p.productId}/{$p.imageOriginal}" class="imageFancy" rel="group">
                    <img src="images/product/{$p.productId}/{$p.imageBig}" alt="{$p.metaTitle}" title="{$p.metaTitle}" />
                </a>
                <div class="clr"></div>
            </div>
            <div class="productPageText">
                <div class="productPriceUp">{$p.price} руб.</div>
                <h1>{$p.title}</h1>
                
                <div class="clr"></div>              
                {$p.description}
                <div class="clr"></div>
            </div>
            <div class="clr"></div>
        {/foreach}          
    {else}
        <div class="justErrorText">Нет товаров.</div>
    {/if}
    <div class="clr"></div>
</div>

{include file='footer.tpl'}