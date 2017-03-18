<?php /* Smarty version 2.6.19, created on 2017-03-18 15:55:26
         compiled from product/details.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div class="contentInner">
       
        <div id="productBlock_<?php echo $this->_tpl_vars['p']['productId']; ?>
" class="productPageImage" id="productImage">
            <a href="images/product/<?php echo $this->_tpl_vars['p']['productId']; ?>
/<?php echo $this->_tpl_vars['p']['imageOriginal']; ?>
" class="imageFancy" rel="group">
                <img src="images/product/<?php echo $this->_tpl_vars['p']['productId']; ?>
/<?php echo $this->_tpl_vars['p']['imageBig']; ?>
" alt="<?php echo $this->_tpl_vars['p']['metaTitle']; ?>
 Ace Hookah" title="<?php echo $this->_tpl_vars['p']['metaTitle']; ?>
 Ace Hookah" />
            </a>
            <div class="clr"></div>
        </div>
        <div class="productPageText">
            <h1><?php echo $this->_tpl_vars['pageTitle']; ?>
</h1>
            <div class="clr"></div>              
            <?php echo $this->_tpl_vars['p']['description']; ?>

            <div class="clr"></div>
            <div class="productDelLink">
                Ознакомиться с условиями оплаты и доставки Вы можете 
                на странице <a href="content/pay_delivery.html" target="_blank">Оплата и Доставка</a>.
            </div>
            <div class="clr"></div>
        </div>
        <div class="clr"></div>
        <?php if (count ( $this->_tpl_vars['productImages']['data'] ) > 0): ?>
            <div class="productPageImageSmall">
                <?php $_from = $this->_tpl_vars['productImages']['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['iter'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['iter']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['pi']):
        $this->_foreach['iter']['iteration']++;
?>
                    <div class="productSmallImage" 
                         <?php if (!($this->_foreach['iter']['iteration'] % 3)): ?>style="margin-right: 0;"<?php endif; ?>>
                        <a href="images/product/<?php echo $this->_tpl_vars['p']['productId']; ?>
/<?php echo $this->_tpl_vars['pi']['imageOriginal']; ?>
" class="imageFancy" rel="group">
                            <img src="images/product/<?php echo $this->_tpl_vars['p']['productId']; ?>
/<?php echo $this->_tpl_vars['pi']['imageSmall']; ?>
" width="75px"/>
                        </a>
                    </div>
                    <?php if (!($this->_foreach['iter']['iteration'] % 3)): ?>
                        <div class="clr"></div>
                    <?php endif; ?>                     
                <?php endforeach; endif; unset($_from); ?>
                <div class="clr"></div>
            </div>
        <?php endif; ?>
        <div class="productBuyButtons">
            <div class="toCartButtonOnProductPage analiticsToCartButton" onclick="toCart('<?php echo $this->_tpl_vars['p']['productId']; ?>
', true);">в корзину заказа</div>            
            <div class="onClickOrderOnProductPage" onclick="openModalBuyClick(<?php echo $this->_tpl_vars['p']['productId']; ?>
);">Купить в один клик</div> 
            <div class="amountBlock">
                <input type="text" value="1" id="productAmount" name="amount" onblur="changeAmountBlur($(this), false);" />
                <div class="amountChange">
                    <div class="amountUp" title="Больше" onclick="changeAmount('up', $(this), false);"></div>
                    <div class="clr"></div> 
                    <div class="amountDown" title="Меньше" onclick="changeAmount('down', $(this), false);"></div>
                    <div class="clr"></div> 
                </div>
                <div class="clr"></div> 
            </div>  
            <div class="productPrice"><?php echo $this->_tpl_vars['p']['price']; ?>
 руб</div>
            <div class="clr"></div>
            <div class="productPageTextShare">
                <div class="share42init"
                     data-url="http://ace-hookah.com/product/<?php echo $this->_tpl_vars['p']['url']; ?>
.html"
                     data-title="<?php echo $this->_tpl_vars['p']['title']; ?>
"
                     data-description="<?php echo $this->_tpl_vars['p']['description']; ?>
"
                     data-image="http://ace-hookah.com/images/product/<?php echo $this->_tpl_vars['p']['productId']; ?>
/<?php echo $this->_tpl_vars['p']['imageSmall']; ?>
"
                ></div>         
                <?php echo '
                    <script type="text/javascript" src="share42/share42.js"></script>
                '; ?>
   
            </div>     
            <div class="clr"></div>
        </div>        
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'on_click.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
        <div class="clr"></div> 
     
</div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>