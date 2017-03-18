<?php /* Smarty version 2.6.19, created on 2017-03-18 12:25:24
         compiled from guest/tablelist.tpl */ ?>

<?php $_from = $this->_tpl_vars['tableList']['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['tl']):
?>
    <div class="tableIcon" onclick="guestToTable('<?php echo $this->_tpl_vars['tl']['guestTableId']; ?>
', '<?php echo $this->_tpl_vars['guestId']; ?>
');">
        <?php echo $this->_tpl_vars['tl']['title']; ?>

        <div class="clear"></div>
    </div>
<?php endforeach; endif; unset($_from); ?>  
<div class="clear"></div>