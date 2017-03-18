<?php /* Smarty version 2.6.19, created on 2017-03-18 01:14:59
         compiled from guest/tableguestpoints.tpl */ ?>
<input type="hidden" value="<?php echo $this->_tpl_vars['to']['guestTableId']; ?>
" name="guestTableId" />
<input type="hidden" value="<?php echo $this->_tpl_vars['to']['totalPrice']; ?>
" name="totalPrice" />
<table class="tableProductTable">
    <thead>
        <tr>
            <td>
                Фото
            </td>
            <td>
                ФИО
            </td>  
            <?php if (! empty ( $this->_tpl_vars['to']['pointSale'] )): ?>
                <td>
                    Баллов списано
                </td>                  
            <?php else: ?>
                <td>
                    Баллов есть
                </td>  
                <td>
                    Баллов списать
                </td>  
            <?php endif; ?>
        </tr>
    </thead>
    <tbody>
        <?php $_from = $this->_tpl_vars['to']['pointSaleGuest']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
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
                <?php if (! empty ( $this->_tpl_vars['to']['pointSale'] )): ?>
                    <td>
                        <?php echo $this->_tpl_vars['tg']['points']; ?>

                    </td>                  
                <?php else: ?>
                    <td>
                        <?php echo $this->_tpl_vars['tg']['points']; ?>

                    </td>  
                    <td class="">
                        <input type="text" value="0" oldval="<?php echo $this->_tpl_vars['tg']['points']; ?>
" name="p_<?php echo $this->_tpl_vars['tg']['guestId']; ?>
" class="guestPointInp"/>
                    </td>  
                <?php endif; ?>                
            </tr>
        <?php endforeach; endif; unset($_from); ?>  
    </tbody>
</table>
<div class="clear"></div>
<?php if (empty ( $this->_tpl_vars['to']['pointSale'] )): ?>
    <div class="tableEditButton" onclick="doGuestPoints('<?php echo $this->_tpl_vars['tg']['inTable']; ?>
');" style="margin-top: 5px;">Применить списание баллов</div>
    <div class="tableEditButton" style="background-color: red; margin-top: 5px;" onclick="cancelGuestPoints('<?php echo $this->_tpl_vars['tg']['inTable']; ?>
');">Отмена</div>
    <div class="clear"></div>
<?php endif; ?>