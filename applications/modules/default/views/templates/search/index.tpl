{include file='header.tpl'}

<div class="contentInner">
    <div class="contentInnerLeft">
        {if count($result)>0}
            {foreach from=$result item=p name=iter}
                <div {if $smarty.foreach.iter.iteration is div by 2}class="productBlockLast"{else}class="productBlock"{/if}>
                    <div class="productImageCatalog" 
                         style="background:transparent url('images/product/{$p.productId}/{$p.imageBig}') no-repeat 0 0;"
                         onclick="redirect('product/details/id/{$p.productId}');">
                        <div class="priceAngleCatalog">
                            <span class="anglePriceValCatalog">{$p.price}</span><br/>рублей
                        </div>
                        <div class="clr"></div>
                        <div class="productTitleCatalog">{$p.title}</div>
                        <div class="clr"></div>
                    </div>
                    <div class="clr"></div>
                    <div class="productBuyButton" onclick="toCart('{$p.productId}', true);">Купить</div>
                    <div class="clr"></div>
                    <div class="productBuyClickButton" onclick="openModalBuyClick({$p.productId});">Купить в один клик</div>                    
                    <div class="clr"></div>
                    {include file='on_click.tpl'}
                </div>
{*                {if $smarty.foreach.iter.iteration is div by 2}
                    <div class="clr"></div>
                {/if}  *}             
            {/foreach}
        {else}
            <div class="justErrorText">По введеному ключу поиска нет результатов.</div>
        {/if}        
        <div class="clr"></div>        
    </div>
    <div class="contentInnerRight">
        {include file='right_side.tpl'}
    </div>
    <div class="clr"></div>
</div>

{include file='footer.tpl'}