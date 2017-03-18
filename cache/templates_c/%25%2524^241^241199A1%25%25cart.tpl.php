<?php /* Smarty version 2.6.19, created on 2017-03-18 15:55:26
         compiled from cart.tpl */ ?>
<?php if ($_SESSION['cartPrice']['totalProductsCount'] > 0): ?>
    <div class="basketIsset" onclick="redirect('checkout');">
        <div class="noEmptyBasket"></div>
        <div class="basketPrice">
            <?php echo $_SESSION['cartPrice']['orderPrice']; ?>
 р.
        </div>
        <div class="basketProductCount">
            <?php echo $_SESSION['cartPrice']['totalProductsCount']; ?>

        </div>
        <div class="basketProductCountLeft"></div>
        <div class="clr"></div>
    </div>
<?php else: ?>
    <div class="emptyBasket">
        <img src="i/basket_empty.png" width="40px" height="40px" />
    </div>
<?php endif; ?>
<div class="clr"></div>