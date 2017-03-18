<?php /* Smarty version 2.6.19, created on 2017-03-18 15:53:43
         compiled from guest/opentable.tpl */ ?>
<div class="opensTableDiv" id="o_<?php echo $this->_tpl_vars['to']['guestTableId']; ?>
">
    <?php if ($this->_tpl_vars['to']['isAdmin'] == 1): ?>
        <div class="numberOfTables">
                <?php echo $this->_tpl_vars['to']['title']; ?>

        </div>
    <?php else: ?>
        <div class="numberOfTables">
                №<?php echo $this->_tpl_vars['to']['title']; ?>

        </div>
        <div class="numberOfTablesEdit">
            <img src="icon/edit48.png" style="cursor: pointer; width: 36px;" title="Изменить номер стола" onclick="tableTitleChange('<?php echo $this->_tpl_vars['to']['guestTableId']; ?>
');"/>    
        </div>
        <div class="tableTitleInp">
            <input type="text" name="tableRemark" value="<?php echo $this->_tpl_vars['to']['title']; ?>
" />
            <div class="setupButtonActive" style="float: right; margin-bottom: 0;" onclick="saveTableTitle('<?php echo $this->_tpl_vars['to']['guestTableId']; ?>
');">Сохранить</div>
            <div class="setupButtonCancel" style="float: right; margin-right: 5px; margin-bottom: 0;" onclick="cancelTableTitle('<?php echo $this->_tpl_vars['to']['guestTableId']; ?>
');">Отменить</div>
            <div class="clear"></div>
        </div>   
    <?php endif; ?>    
    <div class="tableOpenDate">
        Открыт: <?php echo $this->_tpl_vars['to']['dateAdded']; ?>

    </div>   
    <div class="clear"></div>
    <div class="openTableLeft">
        <div class="clear"></div>
        <div class="guestInThisTable">
            <?php if (count ( $this->_tpl_vars['to']['guests']['data'] ) > 0): ?>
                <?php $_from = $this->_tpl_vars['to']['guests']['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['tg']):
?>
                    <div class="gInTabImg" id="git_<?php echo $this->_tpl_vars['tg']['guestId']; ?>
">
                        <img src="images/guest/<?php echo $this->_tpl_vars['tg']['guestId']; ?>
/<?php echo $this->_tpl_vars['tg']['imageBig']; ?>
" style="max-width: 120px; max-height: 120px;" />
                        <div class="guestInTableSet">
                            <?php if ($this->_tpl_vars['to']['isCheck'] == '0'): ?>
                                <img src="icon/replace.png" style="cursor: pointer;" title="Перенос" onclick="getTableForReplace('<?php echo $this->_tpl_vars['to']['guestTableId']; ?>
', 0, '<?php echo $this->_tpl_vars['tg']['guestId']; ?>
', 'guest', $(this), 0);"/>
                                <img src="icon/view.png" style="cursor: pointer;" title="Детали" onclick="toGuestDet('<?php echo $this->_tpl_vars['tg']['guestId']; ?>
');"/>
                            <?php endif; ?>
                            <div class="clear"></div>
                        </div>
                        <div class="clear"></div>
                    </div>
                <?php endforeach; endif; unset($_from); ?>             
            <?php endif; ?>
        </div>
        <div class="clear"></div>
        <?php if ($this->_tpl_vars['to']['isCheck'] == '0'): ?>
            <div class="tableProductList">
                <?php $_from = $this->_tpl_vars['productHookah']['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['tl']):
?>
                    <?php if ($this->_tpl_vars['tl']['guestProductId'] == 38): ?>
                        <?php if ($this->_tpl_vars['to']['forFriends']): ?>
                            <div class="tableIcon" onclick="productToPrevTable('<?php echo $this->_tpl_vars['tl']['guestProductId']; ?>
', '<?php echo $this->_tpl_vars['tl']['title']; ?>
', '<?php echo $this->_tpl_vars['tl']['price']; ?>
', '<?php echo $this->_tpl_vars['to']['guestTableId']; ?>
');">
                                <?php echo $this->_tpl_vars['tl']['title']; ?>
 <?php echo $this->_tpl_vars['tl']['price']; ?>
 руб
                                <div class="clear"></div>
                            </div>                                
                        <?php endif; ?>
                    <?php else: ?>
                        <div class="tableIcon" onclick="productToPrevTable('<?php echo $this->_tpl_vars['tl']['guestProductId']; ?>
', '<?php echo $this->_tpl_vars['tl']['title']; ?>
', '<?php echo $this->_tpl_vars['tl']['price']; ?>
', '<?php echo $this->_tpl_vars['to']['guestTableId']; ?>
');">
                            <?php echo $this->_tpl_vars['tl']['title']; ?>
 <?php echo $this->_tpl_vars['tl']['price']; ?>
 руб
                            <div class="clear"></div>
                        </div>                        
                    <?php endif; ?>
                <?php endforeach; endif; unset($_from); ?>  
                <div class="clear"></div><br/>
                <?php $_from = $this->_tpl_vars['productBar']['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['tl']):
?>
                    <div class="tableIcon" onclick="productToPrevTable('<?php echo $this->_tpl_vars['tl']['guestProductId']; ?>
', '<?php echo $this->_tpl_vars['tl']['title']; ?>
', '<?php echo $this->_tpl_vars['tl']['price']; ?>
', '<?php echo $this->_tpl_vars['to']['guestTableId']; ?>
');">
                        <?php echo $this->_tpl_vars['tl']['title']; ?>
 <?php echo $this->_tpl_vars['tl']['price']; ?>
 руб
                        <div class="clear"></div>
                    </div>
                <?php endforeach; endif; unset($_from); ?>  
                <div class="clear"></div>        
            </div>  
            <div class="clear"></div>
        <?php endif; ?>
    </div>
    <div class="openTableRight">
        <div id="prevOrder_<?php echo $this->_tpl_vars['to']['guestTableId']; ?>
" isset="0"></div>
        <?php if (count ( $this->_tpl_vars['to']['products'] ) > 0): ?>
            <table class="tableProductTable">
                <thead>
                    <tr>
                        <td>
                            Наименование
                        </td>
                        <td>
                            Кол-ство
                        </td>
                        <td>
                            Цена
                        </td>
                        <td>
                            Сумма
                        </td>
                        <?php if ($this->_tpl_vars['to']['isCheck'] == '0'): ?>
                            <td>
                                Пер.
                            </td>                        
                            <?php if ($_SESSION['user']['isAdmin'] == 2): ?>
                                <td>
                                    Уд.
                                </td>     
                            <?php endif; ?>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php $_from = $this->_tpl_vars['to']['products']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['tp']):
?>
                        <tr>
                            <td>
                                <?php echo $this->_tpl_vars['tp']['title']; ?>

                            </td>
                            <td>
                                <?php if ($_SESSION['user']['isAdmin'] == 2 && $this->_tpl_vars['to']['isCheck'] == '0'): ?>
                                    <input type="text" name="amount" value="<?php echo $this->_tpl_vars['tp']['amount']; ?>
" onblur="quickChangeAmount($(this).val(), '<?php echo $this->_tpl_vars['to']['guestTableId']; ?>
', '<?php echo $this->_tpl_vars['tp']['guestProductId']; ?>
', '<?php echo $this->_tpl_vars['tp']['amount']; ?>
');"/>
                                <?php else: ?>
                                    <?php echo $this->_tpl_vars['tp']['amount']; ?>

                                <?php endif; ?>
                            </td>
                            <td>
                                <?php echo $this->_tpl_vars['tp']['price']; ?>

                            </td>
                            <td>
                                <?php echo $this->_tpl_vars['tp']['totalPrice']; ?>

                            </td>
                            <?php if ($this->_tpl_vars['to']['isCheck'] == '0'): ?>
                                <td>
                                    <img src="icon/replace.png" style="cursor: pointer;" title="Перенос" onclick="getTableForReplace('<?php echo $this->_tpl_vars['to']['guestTableId']; ?>
', '<?php echo $this->_tpl_vars['tp']['guestProductId']; ?>
', 0, 'product', $(this), <?php echo $this->_tpl_vars['tp']['amount']; ?>
);"/>
                                </td>                              
                                <?php if ($_SESSION['user']['isAdmin'] == 2): ?>
                                    <td>
                                        <img src="icon/101.png" style="cursor: pointer;" title="Удалить" onclick="deleteGuestProduct('<?php echo $this->_tpl_vars['to']['guestTableId']; ?>
', '<?php echo $this->_tpl_vars['tp']['guestProductId']; ?>
');"/>
                                    </td>     
                                <?php endif; ?>  
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; endif; unset($_from); ?>                     
                </tbody>                
            </table>       
            <div class="clear"></div>
            <div class="tableTotalPrice">
                <b>Итого:</b> <?php echo $this->_tpl_vars['to']['price']; ?>
 руб.
                <?php if (! empty ( $this->_tpl_vars['to']['saleCode'] )): ?>
                    <div class="clear"></div>
                    <b>Скидка(<?php echo $this->_tpl_vars['to']['salesDet']['title']; ?>
):</b> <?php echo $this->_tpl_vars['to']['sale']; ?>
 руб.                
                    <div class="clear"></div>
                    <?php if (! empty ( $this->_tpl_vars['to']['pointSale'] )): ?>
                        <b>Оплаченно баллами:</b> <?php echo $this->_tpl_vars['to']['pointSale']; ?>
 руб.                
                        <div class="clear"></div>
                    <?php endif; ?>                    
                    <b>Итого к оплате:</b> <?php echo $this->_tpl_vars['to']['totalPrice']; ?>
 руб.
                <?php elseif (! empty ( $this->_tpl_vars['to']['pointSale'] )): ?>
                    <div class="clear"></div>
                    <b>Оплаченно баллами:</b> <?php echo $this->_tpl_vars['to']['pointSale']; ?>
 руб.    
                    <div class="clear"></div>
                    <b>Итого к оплате:</b> <?php echo $this->_tpl_vars['to']['totalPrice']; ?>
 руб.               
                <?php endif; ?>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
            <?php if ($this->_tpl_vars['to']['isAdmin'] == 0): ?>
                <?php if ($this->_tpl_vars['to']['isCheck'] == '0'): ?>
                    <?php if (empty ( $this->_tpl_vars['to']['pointSale'] )): ?>
                        <div class="tableEditButton" onclick="getGuestPoints('<?php echo $this->_tpl_vars['to']['guestTableId']; ?>
', '<?php echo $this->_tpl_vars['to']['totalPrice']; ?>
');">Списать баллы</div>
                    <?php endif; ?>
                    <div class="tableEditButton" onclick="getBDGuest('<?php echo $this->_tpl_vars['to']['guestTableId']; ?>
');">Применить кальян ДР</div>
                    <div class="clear"></div>   
                    <div class="tablePointsList" id="tpl_<?php echo $this->_tpl_vars['to']['guestTableId']; ?>
"></div>
                    <div class="clear"></div>  
                    <div class="tableBDList" id="tbl_<?php echo $this->_tpl_vars['to']['guestTableId']; ?>
"></div>
                    <div class="clear"></div>                  
                <?php endif; ?>
                <?php if (! empty ( $this->_tpl_vars['to']['pointSale'] ) && ! empty ( $this->_tpl_vars['to']['pointSaleGuest'] )): ?>
                    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'guest/tableguestpoints.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                <?php endif; ?>     
                <div class="tableEditBlock">
                    <?php if ($this->_tpl_vars['to']['isCheck'] == '0' && empty ( $this->_tpl_vars['to']['saleCode'] )): ?>
                        <?php if (count ( $this->_tpl_vars['to']['sales'] ) > 0): ?>
                            Скидки:
                            <select name="sale" onchange="dotablesale($(this).val(), '<?php echo $this->_tpl_vars['to']['guestTableId']; ?>
');">
                                <option value="">Нет скидки</option>
                                <?php $_from = $this->_tpl_vars['to']['sales']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ps']):
?>
                                    <?php if ($this->_tpl_vars['ps']['check']): ?>
                                        <option value="<?php echo $this->_tpl_vars['ps']['code']; ?>
"><?php echo $this->_tpl_vars['ps']['title']; ?>
</option>
                                    <?php endif; ?>
                                <?php endforeach; endif; unset($_from); ?>
                            </select>
                        <?php endif; ?>
                    <?php endif; ?>
                    <?php if ($this->_tpl_vars['to']['isCheck'] == '0'): ?>
                        <div class="tableEditButton" onclick="getCheck('<?php echo $this->_tpl_vars['to']['guestTableId']; ?>
');">Счет</div>
                    <?php else: ?>
                        <div class="tableEditButton" onclick="closesTable('<?php echo $this->_tpl_vars['to']['guestTableId']; ?>
');">Закрыть стол</div>
                        <?php if ($_SESSION['user']['isAdmin'] == 2): ?>
                            <div class="tableEditButton" onclick="cancelCheck('<?php echo $this->_tpl_vars['to']['guestTableId']; ?>
');">Отмена предчека</div>    
                        <?php endif; ?>                          
                    <?php endif; ?>
                    <div class="clear"></div>
                </div>                 
            <?php endif; ?>
        <?php endif; ?>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
</div>
<div class="clear"></div>