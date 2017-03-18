<?php /* Smarty version 2.6.19, created on 2017-03-13 18:39:38
         compiled from guest/tablelistforreplace.tpl */ ?>
<?php if (count ( $this->_tpl_vars['tableList'] ) > 0): ?>
    <?php if ($this->_tpl_vars['type'] == 'product'): ?>
        <input type="text" name="amountToReplace" id="atr_<?php echo $this->_tpl_vars['oldTableId']; ?>
_<?php echo $this->_tpl_vars['productId']; ?>
" value="<?php echo $this->_tpl_vars['amount']; ?>
" oldval="<?php echo $this->_tpl_vars['amount']; ?>
" onblur="changeAmountToReplaceValid('<?php echo $this->_tpl_vars['oldTableId']; ?>
', '<?php echo $this->_tpl_vars['productId']; ?>
');"/>
        <?php $_from = $this->_tpl_vars['tableList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['tl']):
?>
            <div class="tableIcon" onclick="productToTableReplace('<?php echo $this->_tpl_vars['tl']['guestTableId']; ?>
', '<?php echo $this->_tpl_vars['oldTableId']; ?>
', '<?php echo $this->_tpl_vars['productId']; ?>
');">
                <?php echo $this->_tpl_vars['tl']['title']; ?>

                <div class="clear"></div>
            </div>
        <?php endforeach; endif; unset($_from); ?>  
        <div class="clear"></div>
    <?php else: ?>
        <?php $_from = $this->_tpl_vars['tableList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['tl']):
?>
            <div class="tableIcon" onclick="guestToTableReplace('<?php echo $this->_tpl_vars['tl']['guestTableId']; ?>
', '<?php echo $this->_tpl_vars['oldTableId']; ?>
', '<?php echo $this->_tpl_vars['guestId']; ?>
');">
                <?php echo $this->_tpl_vars['tl']['title']; ?>

                <div class="clear"></div>
            </div>
        <?php endforeach; endif; unset($_from); ?>  
        <div class="clear"></div>    
    <?php endif; ?>
<?php endif; ?>