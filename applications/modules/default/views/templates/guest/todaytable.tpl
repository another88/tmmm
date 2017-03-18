{include file = 'guest/header.tpl'}

Кассовый день: {$dayDet.currentDate}, Открыт: {$dayDet.openDate}, Закрыт: {$dayDet.closeDate}.
<div class="clear"></div>
Касса: {$report.cashTotal} руб., Бар: {$report.barCashTotal} руб., Кальяны: {$report.hookahCashTotal} руб., Оплаченно баллами: {$report.pointSale} руб.
<div class="clear"></div>
Кол-ство кальянов: {$report.hookahCount} шт., Всего столов: {$report.tableCount} шт.
<div class="clear"></div><br/>

<div class="report_table dayReportButton activeReport" onclick="showReportDet('table');">Детали по столам</div>
<div class="report_product dayReportButton" onclick="showReportDet('product');">Детали по позициям</div>
<div class="clear"></div><br/>

<div class="tableReport_table dayReportBlock" style="display: block;">
    {foreach from=$tableList.data item=to}
        <div class="opensTableDiv">
            <div class="numberOfTables">
                {if $to.isAdmin == 0}
                    №{$to.title}
                {else}
                    {$to.title}
                {/if}
            </div>
            <div class="tableOpenDate">
                Открыт: {$to.dateAdded}
                Закрыт: {$to.dateClosed}
            </div>   
            <div class="clear"></div>
            <div class="openTableLeft" style="width: 647px;">
                <div class="clear"></div>
                <div class="guestInThisTable">
                    {if count($to.guests)>0}
                        {foreach from=$to.guests item=tg}
                            <div class="gInTabImg">
                                <img src="images/guest/{$tg.guestId}/{$tg.imageBig}" style="max-width: 120px; max-height: 120px;" />
                                <div class="clear"></div>
                            </div>
                        {/foreach}             
                    {/if}
                </div>
                <div class="clear"></div>
            </div>
            <div class="openTableRight">
                {if count($to.products)>0}
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
                            {foreach from=$to.products item=tp}
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
                        <b>Итого:</b> {$to.price} руб.
                        {if !empty($to.sale)}
                            <div class="clear"></div>
                            <b>Скидка({$to.salesDet.title}):</b> {$to.sale} руб.                
                            <div class="clear"></div>
                            {if !empty($to.pointSale)}
                                <b>Оплаченно баллами:</b> {$to.pointSale} руб.                
                                <div class="clear"></div>
                            {/if}                    
                            <b>Итого к оплате:</b> {$to.totalPrice} руб.
                        {elseif !empty($to.pointSale)}
                            <div class="clear"></div>
                            <b>Оплаченно баллами:</b> {$to.pointSale} руб.    
                            <div class="clear"></div>
                            <b>Итого к оплате:</b> {$to.totalPrice} руб.               
                        {/if}
                        <div class="clear"></div>
                    </div>
                    <div class="clear"></div>    
                    {if !empty($to.pointSale) && !empty($to.pointSaleGuest)}
                        {include file = 'guest/tableguestpoints.tpl'}
                        <div class="clear"></div><br/>
                    {/if}                   
                {/if}
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    {/foreach}    
</div>
<div class="tableReport_product dayReportBlock">
    <div class="productReportBlock">
        <b>Кальяны</b>
        <div class="clear"></div>  
        <div class="productReportTitle productReportHeader">Наименование</div>
        <div class="productReportAmount productReportHeader">Количество</div>    
        <div class="clear"></div>        
        {foreach from=$productsArr.hookah item=pa key=pak}
            <div class="productReportTitle">{$pa.title}</div>
            <div class="productReportAmount">{$pa.amount}</div>    
            <div class="clear"></div>        
        {/foreach}
    </div>
    <div class="productReportBlock">
        <b>Бар</b>
        <div class="clear"></div>          
        <div class="productReportTitle productReportHeader">Наименование</div>
        <div class="productReportAmount productReportHeader">Количество</div>    
        <div class="clear"></div>        
        {foreach from=$productsArr.bar item=pa key=pak}
            <div class="productReportTitle">{$pa.title}</div>
            <div class="productReportAmount">{$pa.amount}</div>    
            <div class="clear"></div>        
        {/foreach}
    </div>    
    <div class="clear"></div> 
</div>
<div class="clear"></div

{include file = 'guest/footer.tpl'}