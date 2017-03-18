{include file='header.tpl'}

<div class="contentInner">
    <div class="catalogLeft">
        {foreach from=$products.data item=p name=iter}
            <div class="productBlock" onclick="redirect('product/details/id/{$p.productId}');">
                <div class="productInner">
                    <div class="productImage">
                        <img src="images/product/{$p.productId}/{$p.imageMedium}" />
                        <div class="clr"></div>
                    </div>
                    <div class="productDescription">
                        <div class="productTitle">{$p.title}</div>
                        <div class="productPriceTest">{$p.price} руб</div>
                        <div class="clr"></div>
                        <div class="productDescriptionInner">
                            {$p.shortDescription}
                        </div>
                        <div class="clr"></div>
{*                        <div class="productPrice">{$p.price} грн</div>
                        <div class="clr"></div>*}
                    </div>
                    <div class="clr"></div>
                </div>                
                <div class="clr"></div>
            </div>
            <div class="clr"></div>
            <div class="onClickOrder" onclick="openModal('buyOnClick_{$p.productId}');">Купить в один клик</div> 
            <div class="toCartButton analiticsToCartButton" onclick="toCart('{$p.productId}', true);">В корзину</div>
            {include file='on_click.tpl'}
            <div class="clr"></div>
        {/foreach}        
        <div class="clr"></div>
    </div>
    <div class="catalogRight">
        {include file='right_side.tpl'}
    </div>
    <div class="clr"></div>
</div>

{include file='footer.tpl'}