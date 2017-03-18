<input type="hidden" value="{$to.guestTableId}" name="guestTableId" />
<input type="hidden" value="{$to.totalPrice}" name="totalPrice" />
<table class="tableProductTable">
    <thead>
        <tr>
            <td>
                Фото
            </td>
            <td>
                ФИО
            </td>  
            {if !empty($to.pointSale)}
                <td>
                    Баллов списано
                </td>                  
            {else}
                <td>
                    Баллов есть
                </td>  
                <td>
                    Баллов списать
                </td>  
            {/if}
        </tr>
    </thead>
    <tbody>
        {foreach from=$to.pointSaleGuest item=tg}
            <tr>
                <td>
                    <img src="images/guest/{$tg.guestId}/{$tg.imageSmall}" style="max-width: 60px; max-height: 60px;" />
                </td>
                <td>
                    {$tg.thirdName} {$tg.name} {$tg.secondName}
                </td>  
                {if !empty($to.pointSale)}
                    <td>
                        {$tg.points}
                    </td>                  
                {else}
                    <td>
                        {$tg.points}
                    </td>  
                    <td class="">
                        <input type="text" value="0" oldval="{$tg.points}" name="p_{$tg.guestId}" class="guestPointInp"/>
                    </td>  
                {/if}                
            </tr>
        {/foreach}  
    </tbody>
</table>
<div class="clear"></div>
{if empty($to.pointSale)}
    <div class="tableEditButton" onclick="doGuestPoints('{$tg.inTable}');" style="margin-top: 5px;">Применить списание баллов</div>
    <div class="tableEditButton" style="background-color: red; margin-top: 5px;" onclick="cancelGuestPoints('{$tg.inTable}');">Отмена</div>
    <div class="clear"></div>
{/if}