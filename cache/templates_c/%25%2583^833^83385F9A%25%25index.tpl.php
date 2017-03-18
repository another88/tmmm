<?php /* Smarty version 2.6.19, created on 2017-03-18 15:50:30
         compiled from index/index.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div class="inMainProduct">
    <?php $_from = $this->_tpl_vars['mainProduct']['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['iter'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['iter']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['p']):
        $this->_foreach['iter']['iteration']++;
?>
        <div id="productBlock_<?php echo $this->_tpl_vars['p']['productId']; ?>
" <?php if (!($this->_foreach['iter']['iteration'] % 3)): ?>class="productBlockMainLast"<?php else: ?>class="productBlockMain"<?php endif; ?>>
            <div class="mainProductImage" 
                 style="background:transparent url('images/product/<?php echo $this->_tpl_vars['p']['productId']; ?>
/<?php echo $this->_tpl_vars['p']['imageBig']; ?>
') no-repeat 0 0;"
                 onclick="redirect('product/<?php echo $this->_tpl_vars['p']['url']; ?>
.html');">
                <div class="priceAngle">
                    <span class="anglePriceVal"><?php echo $this->_tpl_vars['p']['price']; ?>
</span><br/>рублей
                </div>
                <div class="clr"></div>
                <div class="mainProductTitle"><a href="product/<?php echo $this->_tpl_vars['p']['url']; ?>
.html"><?php echo $this->_tpl_vars['p']['title']; ?>
</a></div>
                <div class="clr"></div>
            </div>
            <div class="clr"></div>
            <div class="mainProductBuy analiticsToCartButton" onclick="toCart('<?php echo $this->_tpl_vars['p']['productId']; ?>
', true);">В корзину заказа</div>
            <div class="clr"></div>
            <div class="mainProductBuy" onclick="openModalBuyClick(<?php echo $this->_tpl_vars['p']['productId']; ?>
);">Купить в один клик</div>                    
            <div class="clr"></div>
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'on_click.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>            
        </div>
    <?php endforeach; endif; unset($_from); ?>
    <div class="clr"></div>
    <h1><?php echo $this->_tpl_vars['meta']['title']; ?>
</h1>
    <div class="clr"></div>
    <?php if (! empty ( $this->_tpl_vars['content']['description'] )): ?>
        <div class="mainText"><?php echo $this->_tpl_vars['content']['description']; ?>
</div>
        <div class="clr"></div> 
    <?php endif; ?>
</div>
<div class="clr"></div>
<div class="whyWe">
    <div class="whyWeInner">
        <div class="whyWeTitle">наши преимущества</div>
        <div class="clr"></div>
        <div class="whyWeImages"></div>
        <div class="clr"></div>
        <div class="whyWeBlock">
            <div class="whyWeBlockTitle">Приятные цены</div>
            <div class="clr"></div>
            <div class="whyWeText">
                Мы не перепродавцы, мы производители, а поэтому наши цены ниже.
                С нами выгодно и розничным и оптовым клиентам!
            </div>
            <div class="clr"></div>
        </div>
        <div class="whyWeBlock">
            <div class="whyWeBlockTitle">Качество</div>
            <div class="clr"></div>
            <div class="whyWeText">
                Наши кальяны успешно прошли проверку путем ежедневной эксплуатации
                в сетях заведений города.  
            </div>            
            <div class="clr"></div>
        </div>
        <div class="whyWeBlock last_menu_block">
            <div class="whyWeBlockTitle">Доверие</div>
            <div class="clr"></div>
            <div class="whyWeText">
                Нас рекомендуют своим близким и друзьям. 
                А это говорит о высоком уровне доверия к нам.
            </div>            
            <div class="clr"></div>
        </div>        
        <div class="clr"></div>
    </div>
    <div class="clr"></div>
</div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>