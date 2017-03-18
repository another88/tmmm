<?php /* Smarty version 2.6.19, created on 2017-03-18 14:39:57
         compiled from guest/todaytable.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'guest/header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

Кассовый день: <?php echo $this->_tpl_vars['dayDet']['currentDate']; ?>
, Открыт: <?php echo $this->_tpl_vars['dayDet']['openDate']; ?>
, Закрыт: <?php echo $this->_tpl_vars['dayDet']['closeDate']; ?>
.
<div class="clear"></div>
Касса: <?php echo $this->_tpl_vars['report']['cashTotal']; ?>
 руб., Бар: <?php echo $this->_tpl_vars['report']['barCashTotal']; ?>
 руб., Кальяны: <?php echo $this->_tpl_vars['report']['hookahCashTotal']; ?>
 руб., Оплаченно баллами: <?php echo $this->_tpl_vars['report']['pointSale']; ?>
 руб.
<div class="clear"></div>
Кол-ство кальянов: <?php echo $this->_tpl_vars['report']['hookahCount']; ?>
 шт., Всего столов: <?php echo $this->_tpl_vars['report']['tableCount']; ?>
 шт.
<div class="clear"></div><br/>

<div class="report_table dayReportButton activeReport" onclick="showReportDet('table');">Детали по столам</div>
<div class="report_product dayReportButton" onclick="showReportDet('product');">Детали по позициям</div>
<div class="clear"></div><br/>

<div class="tableReport_table dayReportBlock" style="display: block;">
    <?php $_from = $this->_tpl_vars['tableList']['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['to']):
?>
        <div class="opensTableDiv">
            <div class="numberOfTables">
                <?php if ($this->_tpl_vars['to']['isAdmin'] == 0): ?>
                    №<?php echo $this->_tpl_vars['to']['title']; ?>

                <?php else: ?>
                    <?php echo $this->_tpl_vars['to']['title']; ?>

                <?php endif; ?>
            </div>
            <div class="tableOpenDate">
                Открыт: <?php echo $this->_tpl_vars['to']['dateAdded']; ?>

                Закрыт: <?php echo $this->_tpl_vars['to']['dateClosed']; ?>

            </div>   
            <div class="clear"></div>
            <div class="openTableLeft" style="width: 647px;">
                <div class="clear"></div>
                <div class="guestInThisTable">
                    <?php if (count ( $this->_tpl_vars['to']['guests'] ) > 0): ?>
                        <?php $_from = $this->_tpl_vars['to']['guests']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['tg']):
?>
                            <div class="gInTabImg">
                                <img src="images/guest/<?php echo $this->_tpl_vars['tg']['guestId']; ?>
/<?php echo $this->_tpl_vars['tg']['imageBig']; ?>
" style="max-width: 120px; max-height: 120px;" />
                                <div class="clear"></div>
                            </div>
                        <?php endforeach; endif; unset($_from); ?>             
                    <?php endif; ?>
                </div>
                <div class="clear"></div>
            </div>
            <div class="openTableRight">
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
                                        <?php echo $this->_tpl_vars['tp']['amount']; ?>

                                    </td>
                                    <td>
                                        <?php echo $this->_tpl_vars['tp']['price']; ?>

                                    </td>
                                    <td>
                                        <?php echo $this->_tpl_vars['tp']['totalPrice']; ?>

                                    </td>
                                </tr>
                            <?php endforeach; endif; unset($_from); ?>                     
                        </tbody>                
                    </table>       
                    <div class="clear"></div>
                    <div class="tableTotalPrice">
                        <b>Итого:</b> <?php echo $this->_tpl_vars['to']['price']; ?>
 руб.
                        <?php if (! empty ( $this->_tpl_vars['to']['sale'] )): ?>
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
                    <?php if (! empty ( $this->_tpl_vars['to']['pointSale'] ) && ! empty ( $this->_tpl_vars['to']['pointSaleGuest'] )): ?>
                        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'guest/tableguestpoints.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                        <div class="clear"></div><br/>
                    <?php endif; ?>                   
                <?php endif; ?>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    <?php endforeach; endif; unset($_from); ?>    
</div>
<div class="tableReport_product dayReportBlock">
    <div class="productReportBlock">
        <b>Кальяны</b>
        <div class="clear"></div>  
        <div class="productReportTitle productReportHeader">Наименование</div>
        <div class="productReportAmount productReportHeader">Количество</div>    
        <div class="clear"></div>        
        <?php $_from = $this->_tpl_vars['productsArr']['hookah']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['pak'] => $this->_tpl_vars['pa']):
?>
            <div class="productReportTitle"><?php echo $this->_tpl_vars['pa']['title']; ?>
</div>
            <div class="productReportAmount"><?php echo $this->_tpl_vars['pa']['amount']; ?>
</div>    
            <div class="clear"></div>        
        <?php endforeach; endif; unset($_from); ?>
    </div>
    <div class="productReportBlock">
        <b>Бар</b>
        <div class="clear"></div>          
        <div class="productReportTitle productReportHeader">Наименование</div>
        <div class="productReportAmount productReportHeader">Количество</div>    
        <div class="clear"></div>        
        <?php $_from = $this->_tpl_vars['productsArr']['bar']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['pak'] => $this->_tpl_vars['pa']):
?>
            <div class="productReportTitle"><?php echo $this->_tpl_vars['pa']['title']; ?>
</div>
            <div class="productReportAmount"><?php echo $this->_tpl_vars['pa']['amount']; ?>
</div>    
            <div class="clear"></div>        
        <?php endforeach; endif; unset($_from); ?>
    </div>    
    <div class="clear"></div> 
</div>
<div class="clear"></div

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'guest/footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>