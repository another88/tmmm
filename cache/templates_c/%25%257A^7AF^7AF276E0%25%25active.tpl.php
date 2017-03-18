<?php /* Smarty version 2.6.19, created on 2017-02-12 20:37:29
         compiled from active.tpl */ ?>
<?php if ($this->_tpl_vars['status'] == 1): ?>
    <img style="cursor: pointer" 
         src="icon/active.png" 
         title="Disapproved" 
         onclick="approveRecord('<?php echo $this->_tpl_vars['address']; ?>
', '<?php echo $this->_tpl_vars['id']; ?>
', '<?php echo $this->_tpl_vars['fieldActive']; ?>
');" 
     />
<?php else: ?>
    <img style="cursor: pointer" 
         src="icon/inactive.png" 
         title="Approved" 
         onclick="approveRecord('<?php echo $this->_tpl_vars['address']; ?>
', '<?php echo $this->_tpl_vars['id']; ?>
', '<?php echo $this->_tpl_vars['fieldActive']; ?>
');" 
     />    
<?php endif; ?>