<?php /* Smarty version 2.6.19, created on 2015-02-19 11:42:01
         compiled from catalog/all2.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div class="contentInner">
    <?php if (count ( $this->_tpl_vars['products']['data'] ) > 0): ?>
        <?php $_from = $this->_tpl_vars['products']['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['iter'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['iter']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['p']):
        $this->_foreach['iter']['iteration']++;
?>
            <div class="productPageImage" id="productImage">
                <a href="images/product/<?php echo $this->_tpl_vars['p']['productId']; ?>
/<?php echo $this->_tpl_vars['p']['imageOriginal']; ?>
" class="imageFancy" rel="group">
                    <img src="images/product/<?php echo $this->_tpl_vars['p']['productId']; ?>
/<?php echo $this->_tpl_vars['p']['imageBig']; ?>
" alt="<?php echo $this->_tpl_vars['p']['metaTitle']; ?>
" title="<?php echo $this->_tpl_vars['p']['metaTitle']; ?>
" />
                </a>
                <div class="clr"></div>
            </div>
            <div class="productPageText">
                <div class="productPriceUp"><?php echo $this->_tpl_vars['p']['price']; ?>
 руб.</div>
                <h1><?php echo $this->_tpl_vars['p']['title']; ?>
</h1>
                
                <div class="clr"></div>              
                <?php echo $this->_tpl_vars['p']['description']; ?>

                <div class="clr"></div>
            </div>
            <div class="clr"></div>
        <?php endforeach; endif; unset($_from); ?>          
    <?php else: ?>
        <div class="justErrorText">Нет товаров.</div>
    <?php endif; ?>
    <div class="clr"></div>
</div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>