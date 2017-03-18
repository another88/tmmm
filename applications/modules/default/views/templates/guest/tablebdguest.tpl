{if count($bdayGuests)>0}
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
            {foreach from=$bdayGuests item=tg}
                <tr>
                    <td>
                        <img src="images/guest/{$tg.guestId}/{$tg.imageSmall}" style="max-width: 60px; max-height: 60px;" />
                    </td>
                    <td>
                        {$tg.thirdName} {$tg.name} {$tg.secondName}
                    </td>  
                    <td>
                        <div class="tableEditButton" onclick="doBDHookah('{$bdTableId}', '{$tg.guestId}');">Исп.&nbsp;кальян&nbsp;ДР</div>
                    </td>                  
                </tr>
            {/foreach}  
        </tbody>
    </table>
    <div class="clear"></div>
{else}
    Нет гостей с ДР!
    <div class="clear"></div>
{/if}