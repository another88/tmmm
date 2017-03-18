<?php /* Smarty version 2.6.19, created on 2017-03-13 21:09:41
         compiled from guest/tablebdguest.tpl */ ?>
<?php if (count ( $this->_tpl_vars['bdayGuests'] ) > 0): ?>
    <table class="tableProductTable">
        <thead>
            <tr>
                <td>
                    Фото
                </td>
                <td>
                    ФИО
                </td>  
                <td>
                    Применить
                </td>                  
            </tr>
        </thead>
        <tbody>
            <?php $_from = $this->_tpl_vars['bdayGuests']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['tg']):
?>
                <tr>
                    <td>
                        <img src="images/guest/<?php echo $this->_tpl_vars['tg']['guestId']; ?>
/<?php echo $this->_tpl_vars['tg']['imageSmall']; ?>
" style="max-width: 60px; max-height: 60px;" />
                    </td>
                    <td>
                        <?php echo $this->_tpl_vars['tg']['thirdName']; ?>
 <?php echo $this->_tpl_vars['tg']['name']; ?>
 <?php echo $this->_tpl_vars['tg']['secondName']; ?>

                    </td>  
                    <td>
                        <div class="tableEditButton" onclick="doBDHookah('<?php echo $this->_tpl_vars['bdTableId']; ?>
', '<?php echo $this->_tpl_vars['tg']['guestId']; ?>
');">Исп.&nbsp;кальян&nbsp;ДР</div>
                    </td>                  
                </tr>
            <?php endforeach; endif; unset($_from); ?>  
        </tbody>
    </table>
    <div class="clear"></div>
<?php else: ?>
    Нет гостей с ДР!
    <div class="clear"></div>
<?php endif; ?>