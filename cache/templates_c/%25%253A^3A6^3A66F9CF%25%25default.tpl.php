<?php /* Smarty version 2.6.19, created on 2017-02-13 00:14:01
         compiled from default.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php if ($this->_tpl_vars['title'] == 'Заказы'): ?>
    <input type="button" class="addOrderButton" value="Добавить заказ" onclick="location.href=rootPath+'admin/order/addorder';" />
<?php endif; ?>

<?php echo $this->_tpl_vars['html']; ?>


<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>