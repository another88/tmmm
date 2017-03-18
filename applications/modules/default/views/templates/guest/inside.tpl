<div class="guestCardBlock insideBlockG onlyInsideGuests {if $gi.inTable != 0}inTableGuestBlock{/if}" id="gs_{$gi.guestId}">
    <div class="guestPhoto insideBlockP">
        <img src="images/guest/{$gi.guestId}/{$gi.imageBig}" 
             style="max-width: 360px; max-height: 360px;" 
             onmouseover="" onmouseout="" onclick="guestCardClick({$gi.guestId});"/>
        <div class="clear"></div>
    </div>
    <div class="guestInsideQuick">
        <input type="checkbox" name="quickSelect" style="cursor: pointer; margin-bottom: 8px;" title="Быстрый выбор" onclick="checkboxClick();" />
        <img src="icon/edit.png" style="cursor: pointer; margin-bottom: 8px;" title="Редактировать" onclick="editGuestQuick('{$gi.guestId}');"/>
        <img src="icon/exit.png" style="cursor: pointer; margin-bottom: 8px;" title="Гость ушел" onclick="guestOut('{$gi.guestId}');"/>
        {if $openTableCheck}
            {if $gi.inTable == 0}        
                <img src="icon/table.png" class="toTableQuickIcon" style="cursor: pointer;" title="На стол" onclick="toTable('{$gi.guestId}');"/>
            {else}
                <div class="insideGuestTableNum" title="Гость за столом №{$gi.title}">{$gi.title}</div>
            {/if}
        {/if}
        <div class="clear"></div>
    </div>
    <div class="tableChoose"></div>          
    <div class="guestDesc">
        <input type="hidden" name="guestId" value="{$gi.guestId}" />
        {if !empty($gi.remark)}
            <div class="guestDescTitle guestRemark" style="color: red;">
                Проблема:
                <img src="icon/active.png" style="cursor: pointer;" title="Устранена" onclick="deleteRemark('{$gi.guestId}', 'inside');"/>
                <div class="clear"></div>   
            </div>
            <div class="guestDescInput guestRemark" style="color: red;">{$gi.remark}</div>
            <div class="clear"></div>    
        {else}
            <div class="guestDescTitle guestTitleRemark">Проблема:</div>
            <div class="guestDescInput guestEditRemark"></div>
            <div class="clear"></div>              
        {/if}        
        <div class="guestDescTitle">Карта номер:</div>
        <div class="guestDescInput guestCardNumber">{$gi.cardNumber}</div>
        <div class="clear"></div>
        <div class="guestDescTitle">Имя(ФИО):</div>
        <div class="guestDescInput guestName">{$gi.thirdName} {$gi.name} {$gi.secondName}</div>
        <div class="clear"></div>
        <div class="guestDescTitle">Дата рождения:</div>
        <div class="guestDescInput guestBirth">{$gi.birthday}</div>                
        <div class="clear"></div>
        <div class="guestDescTitle">Телефон:</div>
        <div class="guestDescInput guestPhone">{$gi.phone}</div>
        <div class="clear"></div>                
        <div class="guestDescTitle">E-mail:</div>
        <div class="guestDescInput guestEmail">{$gi.email}</div>
        <div class="clear"></div>
        <div class="guestDescTitle">Страна:</div>
        <div class="guestDescInput guestCountry">{$gi.country}</div>
        <div class="clear"></div>
        <div class="guestDescTitle">Город:</div>
        <div class="guestDescInput guestCity">{$gi.city}</div>
        <div class="clear"></div>
        <div class="guestDescTitle">Баллов:</div>
        <div class="guestDescInput">{$gi.points}</div>
        <div class="clear"></div>
    </div>    
    <div class="guestSetup">
        <div class="setupButtonActive editButtonActive" onclick="editGuest('{$gi.guestId}');">Редактировать</div>
        <div class="clear"></div>
    </div>  
    <div class="guestSetupEdit">
        <div class="setupButtonActive" onclick="saveGuestChanges('{$gi.guestId}', $(this));">Сохранить</div>
        <div class="clear"></div>
        <div class="setupButtonCancel" onclick="cancelGuestChanges($(this));">Отменить</div>
        <div class="clear"></div>                 
    </div>                  
    <div class="clear"></div>
</div>