<h4>Результаты поиска</h4>

{if isset($serror)}
    {$serror}
{else}
    {foreach from=$res item=gr}
        <div class="gsrBlock">
            <div class="grImage">
                <img src="images/guest/{$gr.guestId}/{$gr.imageBig}" />
                <div class="clear"></div>
            </div>
            <div class="grRight">
                <div class="grrTitle">ID:</div>
                <div class="grrInput">{$gr.guestId}</div>
                <div class="clear"></div>                
                <div class="grrTitle">Карта номер:</div>
                <div class="grrInput">{$gr.cardNumber}</div>
                <div class="clear"></div>
                <div class="grrTitle">Имя:</div>
                <div class="grrInput">{$gr.name} {$gr.secondName} {$gr.thirdName}</div>
                <div class="clear"></div>
                <div class="grrTitle">Дата рождения:</div>
                <div class="grrInput">{$gr.birthday}</div>                
                <div class="clear"></div>
                <div class="grrTitle">Телефон:</div>
                <div class="grrInput">{$gr.phone}</div>
                <div class="clear"></div>                
                {if !empty($gr.email)}
                    <div class="grrTitle">E-mail:</div>
                    <div class="grrInput">{$gr.email}</div>
                    <div class="clear"></div>
                {/if}
                <div class="grrTitle">Страна:</div>
                <div class="grrInput">{$gr.country}</div>
                <div class="clear"></div>
                <div class="grrTitle">Город:</div>
                <div class="grrInput">{$gr.city}</div>
                <div class="clear"></div>
                <div class="grrTitle">Баллов:</div>
                <div class="grrInput">{$gr.points}</div>
                <div class="clear"></div>
                <a class="guestEnterButton" href="guest/actions/actionName/edit/referer/guest_list/modelName/Guest/id/{$gr.guestId}" target="_blank">Редактировать</a>
                <div class="clear"></div>                  
            </div>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    {/foreach}
{/if}
<div class="clear"></div>