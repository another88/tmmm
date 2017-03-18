<div class="opensTableDiv" id="o_{$to.guestTableId}">
    {if $to.isAdmin == 1}
        <div class="numberOfTables">
                {$to.title}
        </div>
    {else}
        <div class="numberOfTables">
                №{$to.title}
        </div>
        <div class="numberOfTablesEdit">
            <img src="icon/edit48.png" style="cursor: pointer; width: 36px;" title="Изменить номер стола" onclick="tableTitleChange('{$to.guestTableId}');"/>    
        </div>
        <div class="tableTitleInp">
            <input type="text" name="tableRemark" value="{$to.title}" />
            <div class="setupButtonActive" style="float: right; margin-bottom: 0;" onclick="saveTableTitle('{$to.guestTableId}');">Сохранить</div>
            <div class="setupButtonCancel" style="float: right; margin-right: 5px; margin-bottom: 0;" onclick="cancelTableTitle('{$to.guestTableId}');">Отменить</div>
            <div class="clear"></div>
        </div>   
    {/if}    
    <div class="tableOpenDate">
        Открыт: {$to.dateAdded}
    </div>   
    <div class="clear"></div>
    <div class="openTableLeft">
        <div class="clear"></div>
        <div class="guestInThisTable">
            {if count($to.guests.data)>0}
                {foreach from=$to.guests.data item=tg}
                    <div class="gInTabImg" id="git_{$tg.guestId}">
                        <img src="images/guest/{$tg.guestId}/{$tg.imageBig}" style="max-width: 120px; max-height: 120px;" />
                        <div class="guestInTableSet">
                            {if $to.isCheck == '0'}
                                <img src="icon/replace.png" style="cursor: pointer;" title="Перенос" onclick="getTableForReplace('{$to.guestTableId}', 0, '{$tg.guestId}', 'guest', $(this), 0);"/>
                                <img src="icon/view.png" style="cursor: pointer;" title="Детали" onclick="toGuestDet('{$tg.guestId}');"/>
                            {/if}
                            <div class="clear"></div>
                        </div>
                        <div class="clear"></div>
                    </div>
                {/foreach}             
            {/if}
        </div>
        <div class="clear"></div>
        {if $to.isCheck == '0'}
            <div class="tableProductList">
                {foreach from=$productHookah.data item=tl}
                    {if $tl.guestProductId == 38}
                        {if $to.forFriends}
                            <div class="tableIcon" onclick="productToPrevTable('{$tl.guestProductId}', '{$tl.title}', '{$tl.price}', '{$to.guestTableId}');">
                                {$tl.title} {$tl.price} руб
                                <div class="clear"></div>
                            </div>                                
                        {/if}
                    {else}
                        <div class="tableIcon" onclick="productToPrevTable('{$tl.guestProductId}', '{$tl.title}', '{$tl.price}', '{$to.guestTableId}');">
                            {$tl.title} {$tl.price} руб
                            <div class="clear"></div>
                        </div>                        
                    {/if}
                {/foreach}  
                <div class="clear"></div><br/>
                {foreach from=$productBar.data item=tl}
                    <div class="tableIcon" onclick="productToPrevTable('{$tl.guestProductId}', '{$tl.title}', '{$tl.price}', '{$to.guestTableId}');">
                        {$tl.title} {$tl.price} руб
                        <div class="clear"></div>
                    </div>
                {/foreach}  
                <div class="clear"></div>        
            </div>  
            <div class="clear"></div>
        {/if}
    </div>
    <div class="openTableRight">
        <div id="prevOrder_{$to.guestTableId}" isset="0"></div>
        {if count($to.products)>0}
{*Таблица заказа*}
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
                        {if $to.isCheck == '0'}
                            <td>
                                Пер.
                            </td>                        
                            {if $smarty.session.user.isAdmin == 2 }
                                <td>
                                    Уд.
                                </td>     
                            {/if}
                        {/if}
                    </tr>
                </thead>
                <tbody>
                    {foreach from=$to.products item=tp}
                        <tr>
                            <td>
                                {$tp.title}
                            </td>
                            <td>
                                {if $smarty.session.user.isAdmin == 2 && $to.isCheck == '0'}
                                    <input type="text" name="amount" value="{$tp.amount}" onblur="quickChangeAmount($(this).val(), '{$to.guestTableId}', '{$tp.guestProductId}', '{$tp.amount}');"/>
                                {else}
                                    {$tp.amount}
                                {/if}
                            </td>
                            <td>
                                {$tp.price}
                            </td>
                            <td>
                                {$tp.totalPrice}
                            </td>
                            {if $to.isCheck == '0'}
                                <td>
                                    <img src="icon/replace.png" style="cursor: pointer;" title="Перенос" onclick="getTableForReplace('{$to.guestTableId}', '{$tp.guestProductId}', 0, 'product', $(this), {$tp.amount});"/>
                                </td>                              
                                {if $smarty.session.user.isAdmin == 2 }
                                    <td>
                                        <img src="icon/101.png" style="cursor: pointer;" title="Удалить" onclick="deleteGuestProduct('{$to.guestTableId}', '{$tp.guestProductId}');"/>
                                    </td>     
                                {/if}  
                            {/if}
                        </tr>
                    {/foreach}                     
                </tbody>                
            </table>       
            <div class="clear"></div>
            <div class="tableTotalPrice">
                <b>Итого:</b> {$to.price} руб.
                {if !empty($to.saleCode)}
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
            {if $to.isAdmin == 0}
                {if $to.isCheck == '0'}
                    {if empty($to.pointSale)}
                        <div class="tableEditButton" onclick="getGuestPoints('{$to.guestTableId}', '{$to.totalPrice}');">Списать баллы</div>
                    {/if}
                    <div class="tableEditButton" onclick="getBDGuest('{$to.guestTableId}');">Применить кальян ДР</div>
                    <div class="clear"></div>   
                    <div class="tablePointsList" id="tpl_{$to.guestTableId}"></div>
                    <div class="clear"></div>  
                    <div class="tableBDList" id="tbl_{$to.guestTableId}"></div>
                    <div class="clear"></div>                  
                {/if}
                {if !empty($to.pointSale) && !empty($to.pointSaleGuest)}
                    {include file = 'guest/tableguestpoints.tpl'}
                {/if}     
                <div class="tableEditBlock">
                    {if $to.isCheck == '0' && empty($to.saleCode)}
                        {if count($to.sales)>0}
                            Скидки:
                            <select name="sale" onchange="dotablesale($(this).val(), '{$to.guestTableId}');">
                                <option value="">Нет скидки</option>
                                {foreach from=$to.sales item=ps}
                                    {if $ps.check}
                                        <option value="{$ps.code}">{$ps.title}</option>
                                    {/if}
                                {/foreach}
                            </select>
                        {/if}
                    {/if}
                    {if $to.isCheck == '0'}
                        <div class="tableEditButton" onclick="getCheck('{$to.guestTableId}');">Счет</div>
                    {else}
                        <div class="tableEditButton" onclick="closesTable('{$to.guestTableId}');">Закрыть стол</div>
                        {if $smarty.session.user.isAdmin == 2 }
                            <div class="tableEditButton" onclick="cancelCheck('{$to.guestTableId}');">Отмена предчека</div>    
                        {/if}                          
                    {/if}
                    <div class="clear"></div>
                </div>                 
            {/if}
        {/if}
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
</div>
<div class="clear"></div>