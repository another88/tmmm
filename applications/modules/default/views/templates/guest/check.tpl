<style type="text/css">
{literal}
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
{/literal}
</style>


{if $details.isCheck == 1}
    <b style="font-size: 24px; color: red;"> Невозможно напичатать чек повторно!</b>
{else}
    <div class="checkImg">
        <img src="http://ace-hookah.com/icon/logo7.jpg" width="180px" />
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
    <div class="tableInfo">
        Стол № {$details.title} ({$details.guestTableId})
        <div class="clear"></div>
        Открыт {$details.dateAdded}
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
            {foreach from=$products item=tp}
                <tr>
                    <td>
                        {$tp.title}
                    </td>
                    <td>
                        {$tp.amount}
                    </td>
                    <td>
                        {$tp.price}
                    </td>
                    <td>
                        {$tp.totalPrice}
                    </td>                          
                </tr>
            {/foreach}                     
        </tbody>                
    </table>       
    <div class="clear"></div>
    <div class="tableTotalPrice">
        <b>Итого:</b> {$details.price} руб.
        {if !empty($details.sale)}
            <div class="clear"></div>
            <b>Скидка({$details.salesDet.title}):</b> {$details.sale} руб.                
            <div class="clear"></div>
            {if !empty($details.pointSale)}
                <b>Оплаченно баллами:</b> {$details.pointSale} руб.                
                <div class="clear"></div>
            {/if}                    
            <b>Итого к оплате:</b> {$details.totalPrice} руб.
        {elseif !empty($details.pointSale)}
            <div class="clear"></div>
            <b>Оплаченно баллами:</b> {$details.pointSale} руб.    
            <div class="clear"></div>
            <b>Итого к оплате:</b> {$details.totalPrice} руб.               
        {/if}    
        <div class="clear"></div>
        <b>Вам начисленно:</b> по {$addGuestPoints} баллов. 
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
{/if}