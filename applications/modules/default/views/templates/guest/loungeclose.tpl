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
{/literal}
</style>

<div class="tableInfo">
    Кассовый день: {$dayDet.currentDate}
    <div class="clear"></div>
    Открыта: {$dayDet.openDate}
    <div class="clear"></div>
    Закрыта: {$dayDet.closeDate}
    <div class="clear"></div>
</div>
<div class="clear"></div>
<table class="tableProductTable">
    <thead>
        <tr>
            <td>
                Общая касса
            </td>
            <td>
                Касса Бар
            </td>
            <td>
                Касса кальяны
            </td>
            <td>
                Баллами
            </td>            
            <td>
                Кол-ство кальянов
            </td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                {$dayDet.totalSum} руб.
            </td>
            <td>
                {$dayDet.barSum} руб.
            </td>
            <td>
                {$dayDet.hookahSum} руб.
            </td>
            <td>
                {$dayDet.pointSale} руб.
            </td>            
            <td>
                {$dayDet.hookahCount}
            </td>                          
        </tr>
    </tbody>                
</table>       
<div class="clear"></div>

<script>
    window.print();
</script>