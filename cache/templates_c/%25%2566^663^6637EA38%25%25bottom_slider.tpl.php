<?php /* Smarty version 2.6.19, created on 2015-12-24 10:14:52
         compiled from bottom_slider.tpl */ ?>
<div class="mostViewedCenter">
    <?php if (isset ( $this->_tpl_vars['mostViewedProduct'] ) && count ( $this->_tpl_vars['mostViewedProduct'] ) > 0): ?>
        <div class="mostViewed">
            <h2>Самые популярные</h2>
            <div class="clr"></div>
            <div id="mostPop" class="scroll-img">
              <ul>        
                <?php $_from = $this->_tpl_vars['mostViewedProduct']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['mvp']):
?>
                    <li>
                        <a href="product/<?php echo $this->_tpl_vars['mvp']['url']; ?>
.html" target="_blank">
                            <img src="images/product/<?php echo $this->_tpl_vars['mvp']['productId']; ?>
/<?php echo $this->_tpl_vars['mvp']['imageMedium']; ?>
" alt="<?php echo $this->_tpl_vars['mvp']['metaTitle']; ?>
" title="<?php echo $this->_tpl_vars['mvp']['metaTitle']; ?>
"/>
                        </a>
                        <div class="clr"></div> 
                        <a href="product/<?php echo $this->_tpl_vars['mvp']['url']; ?>
.html" target="_blank"><?php echo $this->_tpl_vars['mvp']['title']; ?>
, <?php echo $this->_tpl_vars['mvp']['price']; ?>
 руб</a>
                        <div class="clr"></div> 
                    </li>
                <?php endforeach; endif; unset($_from); ?>
              </ul>
              <div class="clr"></div> 
            </div>   
            <div class="clr"></div> 
        </div>
    <?php endif; ?>

    <?php if (isset ( $this->_tpl_vars['mostBuyedProduct'] ) && count ( $this->_tpl_vars['mostBuyedProduct'] ) > 0): ?>
        <div class="mostViewed no_margin_right">
            <h2>Самые продаваемые</h2>
            <div class="clr"></div>
            <div id="mostBuy" class="scroll-img">
              <ul>        
                <?php $_from = $this->_tpl_vars['mostBuyedProduct']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['mbp']):
?>
                    <li>
                        <a href="product/<?php echo $this->_tpl_vars['mbp']['url']; ?>
.html" target="_blank">
                            <img src="images/product/<?php echo $this->_tpl_vars['mbp']['productId']; ?>
/<?php echo $this->_tpl_vars['mbp']['imageMedium']; ?>
" alt="<?php echo $this->_tpl_vars['mbp']['metaTitle']; ?>
" title="<?php echo $this->_tpl_vars['mbp']['metaTitle']; ?>
"/>
                        </a>
                        <div class="clr"></div> 
                        <a href="product/<?php echo $this->_tpl_vars['mbp']['url']; ?>
.html" target="_blank"><?php echo $this->_tpl_vars['mbp']['title']; ?>
, <?php echo $this->_tpl_vars['mbp']['price']; ?>
 руб</a>
                        <div class="clr"></div> 
                    </li>
                <?php endforeach; endif; unset($_from); ?>
              </ul>
              <div class="clr"></div> 
            </div>   
            <div class="clr"></div> 
        </div>
    <?php endif; ?>
    
 
    <div class="clr"></div> 
</div> 
<div class="clr"></div> 