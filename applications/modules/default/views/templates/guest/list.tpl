{include file = 'guest/header.tpl'}

<h3>Поиск члена клуба</h3>
<div class="findBlock">
    <div class="findItem">
        <div class="findMTitle">По номеру карты</div>
        <div class="findMInput"><input type="text" name="cardNumber" value="" class="guestFilter" /></div>
        <div class="findMButton" onclick="findGuest('cardNumber');">Искать</div>
        <div class="clear"></div>
    </div>
    <div class="findItem">
        <div class="findMTitle">По фамилии</div>
        <div class="findMInput"><input type="text" name="thirdName" value="" class="guestFilter" /></div>
        <div class="findMButton" onclick="findGuest('thirdName');">Искать</div>
        <div class="clear"></div>
    </div>
    <div class="findItem">
        <div class="findMTitle">По телефону</div>
        <div class="findMInput"><input type="text" name="phone" value="" class="guestFilter" /></div>
        <div class="findMButton" onclick="findGuest('phone');">Искать</div>
        <div class="clear"></div> 
    </div>
    <div class="clear"></div> 
    <div class="guestSearchRes"></div>
    <div class="clear"></div>
</div>

<table class="adminTable">
    <thead>
        <tr>
            <td colspan="3">
                <div class="findMButton" 
                     onclick="location.href=rootPath+'guest/actions/actionName/edit/referer/guest_list/modelName/Guest/';">
                    Добавить члена клуба
                </div>
            </td>
            <td colspan="2">
                Всего членов клуба: {$guestList.total}
            </td>   
            <td colspan="6">
                <div {if $sort == ''}class="findMButton activeSortButton"{else}class="findMButton"{/if} style="margin-right: 10px;"
                     onclick="location.href=rootPath+'guest/list/';">
                    По фамилии(От А)
                </div>
                <div {if $sort == 'id'}class="findMButton activeSortButton"{else}class="findMButton"{/if} style="margin-right: 10px;"
                     onclick="location.href=rootPath+'guest/list/sort/id';">
                    По дате(От последних)
                </div>
                <div {if $sort == 'empty'}class="findMButton activeSortButton"{else}class="findMButton"{/if} 
                     onclick="location.href=rootPath+'guest/list/sort/empty';">
                    Не заполненные
                </div>                     
            </td>               
        </tr>       
    </thead>
    <thead>
        <tr>
            <td>ID</td>
            <td>№Карты</td>
            <td>ФИО</td>
            <td>Дата рожд.</td>
            <td>Телефон</td>
            <td>E-mail</td>
            <td>Страна</td>
            <td>Город</td>
            <td>Баллов</td>
            <td>Фото</td>
            <td width="1%">Ред.</td>
{*            <td width="1%">Дет.</td>*}
        </tr>
    </thead>
    <tbody>
        {foreach from=$guestList.data item=g}
            <tr>
                <td>{$g.guestId}</td>
                <td>{$g.cardNumber}</td>
                <td>{$g.thirdName} {$g.name} {$g.secondName}</td>
                <td>{$g.birthday}</td>
                <td>{$g.phone}</td>
                <td>{$g.email}</td>
                <td>{$g.country}</td>
                <td>{$g.city}</td>
                <td>{$g.points}</td>
                <td><img src="images/guest/{$g.guestId}/{$g.imageSmall}" /></td>
                <td class="icon">
                    <a title="Ред." href="guest/actions/actionName/edit/referer/guest_list/modelName/Guest/id/{$g.guestId}">
                        <img alt="Ред." src="icon/edit.png">
                    </a>
                </td> 
{*                <td class="icon">
                    <a title="Дет." href="guest/actions/actionName/view/referer/guest_index/modelName/Guest/id/{$g.guestId}">
                        <img alt="Дет." src="icon/view.png">
                    </a>
                </td>  *}               
            </tr>
        {/foreach}
        <tr>
            <td colspan="13">{$paging}</td>
        </tr>
    </tbody>
</table>



{include file = 'guest/footer.tpl'}