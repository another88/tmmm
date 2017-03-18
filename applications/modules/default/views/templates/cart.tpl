{if $smarty.session.cartPrice.totalProductsCount > 0}
    <div class="basketIsset" onclick="redirect('checkout');">
        <div class="noEmptyBasket"></div>
        <div class="basketPrice">
            {$smarty.session.cartPrice.orderPrice} р.
        </div>
        <div class="basketProductCount">
            {$smarty.session.cartPrice.totalProductsCount}
        </div>
        <div class="basketProductCountLeft"></div>
        <div class="clr"></div>
    </div>
{else}
    <div class="emptyBasket">
        <img src="i/basket_empty.png" width="40px" height="40px" />
    </div>
{/if}
<div class="clr"></div>
