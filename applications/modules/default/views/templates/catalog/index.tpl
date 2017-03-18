{include file='header.tpl'}

<div class="contentInner">
    <h1>{$pageTitle}</h1>
    {if count($currentCategory.product.data)>0}
        {foreach from=$currentCategory.product.data item=p name=iter}
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
        {/foreach}          
    {else}
        <div class="justErrorText">В данной категории нет товаров.</div>
    {/if}
    {if !empty($currentCategory.description)}
        <div class="clr"></div><br/>  
        <div class="catText">
            {$currentCategory.description}
            <div class="catPageTextShare">
                <div class="share42init"
                     data-url="http://ace-hookah.com/catalog/{$currentCategory.url}.html"
                     data-title="{$currentCategory.title}"
                     data-description="{$currentCategory.description}"
                ></div>        
                {literal}
                    <script type="text/javascript" src="share42/share42.js"></script>
                {/literal}                  
            </div>           
            <div class="clr"></div>             
        </div>        
        <div class="clr"></div> 
    {/if}    
    <div class="clr"></div>
</div>

{include file='footer.tpl'}