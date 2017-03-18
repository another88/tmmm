<?php /* Smarty version 2.6.19, created on 2017-03-18 15:53:43
         compiled from guest/check.tpl */ ?>
<style type="text/css">
<?php echo '
    head{
        visibility: hidden;
    }
    .tableProductTable{
        border-collapse: collapse;
        border: 1px solid black;    
        width: 250px;
    }
    .tableProductTable thead tr td{
        font-size: 12px;
        padding: 5px;
        border: 1px solid black;
    }
    .tableProductTable tbody tr td{
        padding: 5px;
        border: 1px solid black;
        font-size: 12px;
    }
    .clear {
        clear: both;
    }    
    .tableTotalPrice{
        margin: 10px 0;
        text-align: right;
        font-size: 13px;
    }    
    .tableInfo{
        font-size: 13px;
        margin-bottom: 10px;
    }
    .tableInfoBot{
        font-size: 12px;
        margin-top: 10px;   
        text-align: center;
    }
    .checkImg{
        text-align: center;
        margin-bottom: 10px;
    }
'; ?>

</style>


<?php if ($this->_tpl_vars['details']['isCheck'] == 1): ?>
    <b style="font-size: 24px; color: red;"> Невозможно напичатать чек повторно!</b>
<?php else: ?>
    <div class="checkImg">
        <img src="http://ace-hookah.com/icon/logo7.jpg" width="180px" />
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
    <div class="tableInfo">
        Стол № <?php echo $this->_tpl_vars['details']['title']; ?>
 (<?php echo $this->_tpl_vars['details']['guestTableId']; ?>
)
        <div class="clear"></div>
        Открыт <?php echo $this->_tpl_vars['details']['dateAdded']; ?>

        <div class="clear"></div>
    </div>
    <div class="clear"></div>
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
            <?php $_from = $this->_tpl_vars['products']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
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
        <b>Итого:</b> <?php echo $this->_tpl_vars['details']['price']; ?>
 руб.
        <?php if (! empty ( $this->_tpl_vars['details']['sale'] )): ?>
            <div class="clear"></div>
            <b>Скидка(<?php echo $this->_tpl_vars['details']['salesDet']['title']; ?>
):</b> <?php echo $this->_tpl_vars['details']['sale']; ?>
 руб.                
            <div class="clear"></div>
            <?php if (! empty ( $this->_tpl_vars['details']['pointSale'] )): ?>
                <b>Оплаченно баллами:</b> <?php echo $this->_tpl_vars['details']['pointSale']; ?>
 руб.                
                <div class="clear"></div>
            <?php endif; ?>                    
            <b>Итого к оплате:</b> <?php echo $this->_tpl_vars['details']['totalPrice']; ?>
 руб.
        <?php elseif (! empty ( $this->_tpl_vars['details']['pointSale'] )): ?>
            <div class="clear"></div>
            <b>Оплаченно баллами:</b> <?php echo $this->_tpl_vars['details']['pointSale']; ?>
 руб.    
            <div class="clear"></div>
            <b>Итого к оплате:</b> <?php echo $this->_tpl_vars['details']['totalPrice']; ?>
 руб.               
        <?php endif; ?>    
        <div class="clear"></div>
        <b>Вам начисленно:</b> по <?php echo $this->_tpl_vars['addGuestPoints']; ?>
 баллов. 
        <div class="clear"></div>
    </div>
    <div class="clear"></div>   
    <div class="tableInfoBot">
        Присоединяйтесь к нам в соц сетях, чтобы не пропустить специальные предложения и конкурсы
        <div class="clear"></div><br/>ВК: vk.com/ace_hookah 
        <div class="clear"></div>ИНСТАГРАМ: instagram.com/hookahace/ 
        <div class="clear"></div>
    </div>


    <script>
        window.print();
    </script>
<?php endif; ?>