<?php /* Smarty version 2.6.19, created on 2017-03-18 15:53:50
         compiled from right_side.tpl */ ?>
<?php if (isset ( $this->_tpl_vars['mostViewedProduct'] ) && count ( $this->_tpl_vars['mostViewedProduct'] ) > 0): ?>
    <div class="mostViewed">
        <div class="rightTitle">Самые популярные</div>
        <div class="clr"></div>
        <?php $_from = $this->_tpl_vars['mostViewedProduct']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['mvp']):
?>
            <div class="rigthItem">
                <div class="rightItemImage">
                    <a href="product/<?php echo $this->_tpl_vars['mvp']['url']; ?>
.html" target="_blank">
                        <img src="images/product/<?php echo $this->_tpl_vars['mvp']['productId']; ?>
/<?php echo $this->_tpl_vars['mvp']['imageSmall']; ?>
" alt="<?php echo $this->_tpl_vars['mvp']['metaTitle']; ?>
" title="<?php echo $this->_tpl_vars['mvp']['metaTitle']; ?>
" />
                    </a>
                </div>
                <div class="rightItemDescription">
                    <a href="product/<?php echo $this->_tpl_vars['mvp']['url']; ?>
.html" target="_blank"><?php echo $this->_tpl_vars['mvp']['title']; ?>
, <?php echo $this->_tpl_vars['mvp']['price']; ?>
 руб</a>
                    <div class="clr"></div>
                    <?php echo $this->_tpl_vars['mvp']['shortDescription']; ?>

                    <div class="clr"></div>
                </div>  
                <div class="clr"></div>
            </div>
            <div class="clr"></div>
        <?php endforeach; endif; unset($_from); ?>
    </div>
    <div class="clr"></div>
<?php endif; ?>

<?php if (isset ( $this->_tpl_vars['mostBuyedProduct'] ) && count ( $this->_tpl_vars['mostBuyedProduct'] ) > 0): ?>
    <div class="mostViewed">
        <div class="rightTitle">Самые продаваемые</div>
        <div class="clr"></div>
        <?php $_from = $this->_tpl_vars['mostBuyedProduct']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['mbp']):
?>
            <div class="rigthItem">
                <div class="rightItemImage">
                    <a href="product/<?php echo $this->_tpl_vars['mbp']['url']; ?>
.html" target="_blank">
                        <img src="images/product/<?php echo $this->_tpl_vars['mbp']['productId']; ?>
/<?php echo $this->_tpl_vars['mbp']['imageSmall']; ?>
" alt="<?php echo $this->_tpl_vars['mbp']['metaTitle']; ?>
" title="<?php echo $this->_tpl_vars['mbp']['metaTitle']; ?>
" />
                    </a>
                </div>
                <div class="rightItemDescription">
                    <a href="product/<?php echo $this->_tpl_vars['mbp']['url']; ?>
.html" target="_blank"><?php echo $this->_tpl_vars['mbp']['title']; ?>
, <?php echo $this->_tpl_vars['mbp']['price']; ?>
 руб</a>
                    <div class="clr"></div>
                    <?php echo $this->_tpl_vars['mbp']['shortDescription']; ?>

                    <div class="clr"></div>
                </div>  
                <div class="clr"></div>
            </div>
            <div class="clr"></div>
        <?php endforeach; endif; unset($_from); ?>
    </div> 
    <div class="clr"></div>
<?php endif; ?>

<?php if (isset ( $this->_tpl_vars['productLike'] ) && count ( $this->_tpl_vars['productLike']['data'] ) > 0): ?>
    <div class="mostViewed">
        <?php if (isset ( $this->_tpl_vars['p'] )): ?>
            <div class="rightTitle">С "<?php echo $this->_tpl_vars['p']['title']; ?>
" часто покупают</div>
        <?php else: ?>
            <div class="rightTitle">С этими товарами часто покупают</div>            
        <?php endif; ?>
        <div class="clr"></div>
        <?php $_from = $this->_tpl_vars['productLike']['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['mvp']):
?>
            <div class="rigthItem">
                <div class="rightItemImage">
                    <a href="product/<?php echo $this->_tpl_vars['mvp']['url']; ?>
.html" target="_blank">
                        <img src="images/product/<?php echo $this->_tpl_vars['mvp']['productId']; ?>
/<?php echo $this->_tpl_vars['mvp']['imageSmall']; ?>
" alt="<?php echo $this->_tpl_vars['mvp']['metaTitle']; ?>
" title="<?php echo $this->_tpl_vars['mvp']['metaTitle']; ?>
" />
                    </a>
                </div>
                <div class="rightItemDescription">
                    <a href="product/<?php echo $this->_tpl_vars['mvp']['url']; ?>
.html" target="_blank"><?php echo $this->_tpl_vars['mvp']['title']; ?>
, <?php echo $this->_tpl_vars['mvp']['price']; ?>
 руб</a>
                    <div class="clr"></div>
                    <?php echo $this->_tpl_vars['mvp']['shortDescription']; ?>

                    <div class="clr"></div>
                    <div class="likeProductButton" 
                         <?php if ($this->_tpl_vars['current'] == 'checkout'): ?>
                            onclick="toCart('<?php echo $this->_tpl_vars['mvp']['productId']; ?>
', false);"                             
                         <?php else: ?>
                            onclick="toCart('<?php echo $this->_tpl_vars['mvp']['productId']; ?>
', true);"
                         <?php endif; ?>
                    >В корзину</div>
                    <div class="clr"></div>                            
                </div>  
                <div class="clr"></div>

            </div>
            <div class="clr"></div>
        <?php endforeach; endif; unset($_from); ?>
    </div>
    <div class="clr"></div>
<?php endif; ?>