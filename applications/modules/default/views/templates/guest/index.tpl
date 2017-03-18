{include file = 'guest/header.tpl'}

{if $isWork.value == '1'}
    <h3>Открытые столы</h3>
    <div class="findBlock">
        <div class="opensTable">
            <div class="findButtonActive" onclick="newTable();">Новый стол</div>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
        <div class="opensTableOnline">
            {foreach from=$openTableList.data item=to}
                {include file = 'guest/opentable.tpl'}
            {/foreach}        
        </div>
        <div class="clear"></div>    
    </div>
    <div class="clear"></div>

    <h3>Гости внутри</h3>
    <div class="findBlock">
        <div class="guestInside">
            <div class="findMButton" 
                 onclick="showQuickAdd();">
                Быстрое добавление члена клуба
            </div>  
            <div class="forCheckboxBlock">
                <div class="findMButton afterChekbox toTableAllBlock" 
                     onclick="toTableAll();">
                    На стол
                </div>  
                <div class="findMButton afterChekbox" 
                     onclick="guestsOut();">
                    Гости ушли
                </div>    
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
            <div class="quickAddGuest">
                <form method="post" action="guest/quickadd" enctype="multipart/form-data">
                    Номер карточки: <input name="cardNumber" type="text" />
                    Фото: <input name="imageOriginal" type="file" />
                    <input type="button" value="Добавить" class="button-primary" onclick="quickAdd();"/>
                </form>
                <div class="clear"></div>
            </div>
            <div class="clear"></div><br/>
            {foreach from=$guestInsideList.data item=gi}
                {include file = 'guest/inside.tpl'}
            {/foreach}
        </div>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>

    {if count($guestBdayList)>0}
        <h3>Сегодня день рождения</h3>
        <div class="findBlock">
            <div class="guestInsideBD">
                {foreach from=$guestBdayList item=gi}
                    {include file = 'guest/bday.tpl'}
                {/foreach}
            </div>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>        
    {/if}
    
    <h3>Поиск члена клуба</h3>
    <div class="findBlock">
        <div class="findTitleActive">Вводи номер карты, номер телефона, имя, отчество или фамилию:</div>
        <div class="findInputActive">
            <input type="text" name="searchField" value="" 
                   class="searchInput" onkeyup="popupEnterAdmin(event, $(this));"/>
        </div>
        <div class="findButtonActive" onclick="findGuestActive();">Искать</div>
        <div class="clear"></div>
        <div class="guestSearchRes"></div>
        <div class="clear"></div>
    </div>

    <div class="clear"></div>
{/if}

{include file = 'guest/footer.tpl'}