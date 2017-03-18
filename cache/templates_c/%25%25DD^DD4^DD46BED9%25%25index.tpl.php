<?php /* Smarty version 2.6.19, created on 2017-03-17 09:42:43
         compiled from special/index.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div class="contentInner">
    <div class="contentInnerLeft">
        <h1><?php echo $this->_tpl_vars['pageTitle']; ?>
</h1>
        <div class="clr"></div>             
        <?php if (count ( $this->_tpl_vars['specials']['data'] ) > 0): ?>
            <?php $_from = $this->_tpl_vars['specials']['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['iter'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['iter']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['p']):
        $this->_foreach['iter']['iteration']++;
?>
                <div class="mixSearchResultBlock" <?php if (!(1 & $this->_foreach['iter']['iteration'])): ?>style='margin-right: 0;'<?php endif; ?>>
                    <div class="mixSearchBlockLeft">
                        <div class="specialImage">
                            <img src="images/special/<?php echo $this->_tpl_vars['p']['specialId']; ?>
/<?php echo $this->_tpl_vars['p']['imageMedium']; ?>
" alt="<?php echo $this->_tpl_vars['p']['title']; ?>
" title="<?php echo $this->_tpl_vars['p']['title']; ?>
" />
                            <div class="clr"></div>
                        </div>
                        <div class="specialDescription">
                            <div class="specialTitle"><?php echo $this->_tpl_vars['p']['title']; ?>
</div>
                            <div class="clr"></div>                            
                            <?php echo $this->_tpl_vars['p']['description']; ?>
      
                            <div class="clr"></div>                            
                        </div>
                        <div class="clr"></div>
                    </div>
                    <div class="orangeLine"></div>
                    <div class="mixSearchBlockRight">
                        <div class="share42initVert"
                                data-url="http://ace-hookah.com/special"
                                data-title="<?php echo $this->_tpl_vars['p']['title']; ?>
"
                                data-description="<?php echo $this->_tpl_vars['p']['description']; ?>
"
                                data-image="http://ace-hookah.com/images/special/<?php echo $this->_tpl_vars['p']['specialId']; ?>
/<?php echo $this->_tpl_vars['p']['imageMedium']; ?>
"
                        ></div>   
                    </div>
                    <div class="clr"></div>
                </div>                
            <?php endforeach; endif; unset($_from); ?>    
            <?php echo '
                <script type="text/javascript" src="share42/share42Vert.js"></script>
            '; ?>
             
        <?php else: ?>
            Нет Данных.
        <?php endif; ?>
        <div class="clr"></div>
    </div>
    <div class="clr"></div>
    <?php if (count ( $this->_tpl_vars['mostViewedProduct'] ) > 0): ?>
        <div class="likeProductBlock">
            <div class="likeProductTitle">Самые популярные товары</div>
            <?php $_from = $this->_tpl_vars['mostViewedProduct']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['iter'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['iter']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['pr']):
        $this->_foreach['iter']['iteration']++;
?>
                <div id="productBlock_<?php echo $this->_tpl_vars['pr']['productId']; ?>
" <?php if (!($this->_foreach['iter']['iteration'] % 3)): ?>class="productBlockMainLast"<?php else: ?>class="productBlockMain"<?php endif; ?>>
                    <div class="mainProductImage" 
                         style="background:transparent url('images/product/<?php echo $this->_tpl_vars['pr']['productId']; ?>
/<?php echo $this->_tpl_vars['pr']['imageBig']; ?>
') no-repeat 0 0;"
                         onclick="redirect('product/<?php echo $this->_tpl_vars['pr']['url']; ?>
.html');">
                        <div class="priceAngle">
                            <span class="anglePriceVal"><?php echo $this->_tpl_vars['pr']['price']; ?>
</span><br/>рублей
                        </div>
                        <div class="clr"></div>
                        <div class="mainProductTitle"><a href="product/<?php echo $this->_tpl_vars['pr']['url']; ?>
.html"><?php echo $this->_tpl_vars['pr']['title']; ?>
</a></div>
                        <div class="clr"></div>
                    </div>
                    <div class="clr"></div>
                    <div class="mainProductBuy analiticsToCartButton" onclick="toCart('<?php echo $this->_tpl_vars['pr']['productId']; ?>
', true);">В корзину заказа</div>
                    <div class="clr"></div>
                    <div class="mainProductBuy" onclick="openModalBuyClick(<?php echo $this->_tpl_vars['pr']['productId']; ?>
);">Купить в один клик</div>                    
                    <div class="clr"></div>
                    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'on_click.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>  
                    <div class="clr"></div>
                </div>
            <?php endforeach; endif; unset($_from); ?> 
            <div class="clr"></div>
        </div>
        <div class="clr"></div>
    <?php endif; ?>         
</div>
        
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>