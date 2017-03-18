<?php /* Smarty version 2.6.19, created on 2014-10-14 09:42:04
         compiled from catalog/view.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div class="contentInner">
    <div class="catalogLeft">
        <?php $_from = $this->_tpl_vars['products']['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['iter'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['iter']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['p']):
        $this->_foreach['iter']['iteration']++;
?>
            <div class="productBlock" onclick="redirect('product/details/id/<?php echo $this->_tpl_vars['p']['productId']; ?>
');">
                <div class="productInner">
                    <div class="productImage">
                        <img src="images/product/<?php echo $this->_tpl_vars['p']['productId']; ?>
/<?php echo $this->_tpl_vars['p']['imageMedium']; ?>
" />
                        <div class="clr"></div>
                    </div>
                    <div class="productDescription">
                        <div class="productTitle"><?php echo $this->_tpl_vars['p']['title']; ?>
</div>
                        <div class="productPriceTest"><?php echo $this->_tpl_vars['p']['price']; ?>
 руб</div>
                        <div class="clr"></div>
                        <div class="productDescriptionInner">
                            <?php echo $this->_tpl_vars['p']['shortDescription']; ?>

                        </div>
                        <div class="clr"></div>
                    </div>
                    <div class="clr"></div>
                </div>                
                <div class="clr"></div>
            </div>
            <div class="clr"></div>
            <div class="onClickOrder" onclick="openModal('buyOnClick_<?php echo $this->_tpl_vars['p']['productId']; ?>
');">Купить в один клик</div> 
            <div class="toCartButton" onclick="toCart('<?php echo $this->_tpl_vars['p']['productId']; ?>
', true);">В корзину</div>
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'on_click.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
            <div class="clr"></div>
        <?php endforeach; endif; unset($_from); ?>        
        <div class="clr"></div>
    </div>
    <div class="catalogRight">
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'right_side.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    </div>
    <div class="clr"></div>
</div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>