<?php /* Smarty version 2.6.19, created on 2015-02-10 15:43:50
         compiled from search/index.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div class="contentInner">
    <div class="contentInnerLeft">
        <?php if (count ( $this->_tpl_vars['result'] ) > 0): ?>
            <?php $_from = $this->_tpl_vars['result']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['iter'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['iter']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['p']):
        $this->_foreach['iter']['iteration']++;
?>
                <div <?php if (!($this->_foreach['iter']['iteration'] % 2)): ?>class="productBlockLast"<?php else: ?>class="productBlock"<?php endif; ?>>
                    <div class="productImageCatalog" 
                         style="background:transparent url('images/product/<?php echo $this->_tpl_vars['p']['productId']; ?>
/<?php echo $this->_tpl_vars['p']['imageBig']; ?>
') no-repeat 0 0;"
                         onclick="redirect('product/details/id/<?php echo $this->_tpl_vars['p']['productId']; ?>
');">
                        <div class="priceAngleCatalog">
                            <span class="anglePriceValCatalog"><?php echo $this->_tpl_vars['p']['price']; ?>
</span><br/>рублей
                        </div>
                        <div class="clr"></div>
                        <div class="productTitleCatalog"><?php echo $this->_tpl_vars['p']['title']; ?>
</div>
                        <div class="clr"></div>
                    </div>
                    <div class="clr"></div>
                    <div class="productBuyButton" onclick="toCart('<?php echo $this->_tpl_vars['p']['productId']; ?>
', true);">Купить</div>
                    <div class="clr"></div>
                    <div class="productBuyClickButton" onclick="openModalBuyClick(<?php echo $this->_tpl_vars['p']['productId']; ?>
);">Купить в один клик</div>                    
                    <div class="clr"></div>
                    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'on_click.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                </div>
                <?php if (!($this->_foreach['iter']['iteration'] % 2)): ?>
                    <div class="clr"></div>
                <?php endif; ?>               
            <?php endforeach; endif; unset($_from); ?>
        <?php else: ?>
            <div class="justErrorText">По введеному ключу поиска нет результатов.</div>
        <?php endif; ?>        
        <div class="clr"></div>        
    </div>
    <div class="contentInnerRight">
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