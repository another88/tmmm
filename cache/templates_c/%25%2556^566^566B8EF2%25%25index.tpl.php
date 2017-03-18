<?php /* Smarty version 2.6.19, created on 2017-03-14 19:09:37
         compiled from taste/index.tpl */ ?>
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
        <?php if (count ( $this->_tpl_vars['taste']['data'] ) > 0): ?>
            <?php $_from = $this->_tpl_vars['taste']['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['iter'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['iter']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['p']):
        $this->_foreach['iter']['iteration']++;
?>
                <div class="tasteBlock">
                    <div class="tasteImage">
                        <img src="images/taste/<?php echo $this->_tpl_vars['p']['tasteId']; ?>
/<?php echo $this->_tpl_vars['p']['imageMedium']; ?>
" class="resizebleImg" />
                        <div class="clr"></div>
                    </div>
                    <div class="tasteDescription">
                        <div class="tasteTitle"><?php echo $this->_tpl_vars['p']['title']; ?>
</div>
                        <div class="clr"></div>
                        <?php echo $this->_tpl_vars['p']['description']; ?>

                        <div class="clr"></div>
                    </div>
                    <div class="clr"></div>
                </div>
                <div class="clr"></div>
            <?php endforeach; endif; unset($_from); ?>        
        <?php else: ?>
            Нет Данных.
            <div class="clr"></div>
        <?php endif; ?>
    </div>
    <div class="clr"></div>
</div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>