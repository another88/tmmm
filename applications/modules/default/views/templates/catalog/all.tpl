{include file='header.tpl'}

<div class="contentInner">
    <h1>{$pageTitle}</h1>
    <div class="clr"></div>         
    {if count($products.data)>0}
        {foreach from=$products.data item=p name=iter}
            <div id="productBlock_{$p.productId}" {if $smarty.foreach.iter.iteration is div by 3}class="productBlockLast"{else}class="productBlock"{/if}>
                <div class="productImageCatalog" 
                     style="background:transparent url('images/product/{$p.productId}/{$p.imageBig}') no-repeat 0 0;"
                     onclick="redirect('product/{$p.url}.html');">
                    <div class="priceAngleCatalog">
                        <span class="anglePriceValCatalog">{$p.price}</span><br/>рублей
                    </div>
                    <div class="clr"></div>
                    <div class="productTitleCatalog"><a href="product/{$p.url}.html">{$p.title}</a></div>
                    <div class="clr"></div>
                </div>
                <div class="clr"></div>
                <div class="productBuyButton analiticsToCartButton" onclick="toCart('{$p.productId}', true);">В корзину заказа</div>
                <div class="clr"></div>
                <div class="productBuyClickButton" onclick="openModalBuyClick({$p.productId});">Купить в один клик</div>                    
                <div class="clr"></div>
                {include file='on_click.tpl'}
            </div>
{*            {if $smarty.foreach.iter.iteration is div by 3}
                <div class="clr"></div>
            {/if} *}               
        {/foreach}          
    {else}
        <div class="justErrorText">Нет товаров.</div>
    {/if}
    <div class="clr"></div>
</div>

{include file='footer.tpl'}