<?php /* Smarty version 2.6.19, created on 2015-04-02 17:41:43
         compiled from constructor/page.tpl */ ?>
<input type="hidden" name="constructorBaseJson" value='<?php echo $this->_tpl_vars['constructorBaseJson']; ?>
' />
<div class="rightTitle cursorPointer">Готовые решения<span class="backButtonChoice" style="padding-right: 0;" onclick="elementsFromBaseShow();">Посмотреть</span></div>
<div class="clr"></div>
<div class="constructorBaseItem">
    <?php $_from = $this->_tpl_vars['constructorBase']['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['cb']):
?>
        <div class="baseChoiceBlockItem" onclick="setElementsFromBase('<?php echo $this->_tpl_vars['cb']['constructorId']; ?>
');">Автор: <?php echo $this->_tpl_vars['cb']['author']; ?>
</div>
        <div class="clr"></div>                    
    <?php endforeach; endif; unset($_from); ?>
    <?php if ($this->_tpl_vars['constructorBase']['total'] > $this->_tpl_vars['constructorBase']['pageLength']): ?>
        <?php echo $this->_tpl_vars['paging']; ?>

        <div class="clr"></div> 
    <?php endif; ?>
</div>
<div class="clr"></div>