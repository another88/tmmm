{include file = 'guest/header.tpl'}

{literal}
    <script>
        $(document).ready(function() {
            $('#yearpicker').MonthPicker(
                { 
                    MaxMonth: 0,
                    MonthFormat: 'yy-mm',
                    Button: function() {
                        return $("<button class='selectMonthBut'>Выбери месяц</button>").button();
                    },
                    OnAfterChooseMonth: function() {
                        var selDate = $('#yearpicker').val();
                        location.href=rootPath+'guest/report/date/'+selDate; 
                    }                        
                }
            );
        });
    </script>
{/literal}

<input type="text" id="yearpicker" name='date' />
<div class="clear"></div><br/>

{if count($daysList)>0}
    <table class="tableProductTable">
        <thead>
            <tr>
                <td>
                    Касса,руб
                </td>
                <td>
                    Кальяны,руб
                </td>  
                <td>
                    Бар,руб
                </td>  
                <td>
                    Баллами,руб
                </td>  
                <td>
                    Кальянов,шт
                </td>  
                <td>
                    Столов,шт
                </td>  
                <td>
                    Кальянов&nbsp;в&nbsp;день,шт
                </td>  
                <td>
                    Касса&nbsp;в&nbsp;день,руб
                </td>  
                <td>
                    Средний&nbsp;чек,руб
                </td>                  
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    {$report.totalCash}
                </td>
                <td>
                    {$report.hookahCash}
                </td>  
                <td>
                    {$report.barCash}
                </td>  
                <td>
                    {$report.pointSale}
                </td>  
                <td>
                    {$report.hookahCount}
                </td>  
                <td>
                    {$report.tableCount}
                </td>  
                <td>
                    {$report.hookahPerDay}
                </td>  
                <td>
                    {$report.cashPerDay}
                </td>  
                <td>
                    {$report.cashPerTable}
                </td>                  
            </tr>
        </tbody>
    </table>    
    <div class="clear"></div><br/>
    <table class="adminTable">
        <thead>
            <tr>
                <td>ID</td>
                <td>Дата</td>
                <td>Открыт</td>
                <td>Закрыт</td>
                <td>Касса</td>
                <td>Сумма бар</td>
                <td>Сумма кальяны</td>
                <td>Баллами</td>
                <td>Кальянов</td>
                <td width="1%">Дет.</td>
            </tr>
        </thead>
        <tbody>
            {foreach from=$daysList item=d}
                <tr>
                    <td>{$d.guestDayId}</td>
                    <td>{$d.currentDate}</td>
                    <td>{$d.openDate}</td>
                    <td>{$d.closeDate}</td>
                    <td>{$d.totalSum} руб.</td>
                    <td>{$d.barSum} руб.</td>
                    <td>{$d.hookahSum} руб.</td>
                    <td>{$d.pointSale} руб.</td>
                    <td>{$d.hookahCount} шт.</td>
                    <td class="icon">
                        <a title="Дет." href="guest/dayreport/id/{$d.guestDayId}" target="_blank">
                            <img alt="Дет." src="icon/view.png">
                        </a>
                    </td>                 
                </tr>
            {/foreach}
        </tbody>
    </table>
{else}
    За этот период нет данных!
{/if}

{include file = 'guest/footer.tpl'}