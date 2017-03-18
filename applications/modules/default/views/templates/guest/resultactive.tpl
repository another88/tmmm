<h4>Результаты поиска</h4>

{if isset($serror)}
    {$serror}
{else}
    {foreach from=$res item=gr name=iter}
        <div class="guestCardBlock" id="g_{$gr.guestId}">
            <div class="guestPhoto">
                <img src="images/guest/{$gr.guestId}/{$gr.imageBig}" style="max-width: 360px; max-height: 360px;" 
                     onmouseover="" onmouseout=""/>
                <div class="clear"></div>
            </div>
            <div class="guestDesc">
                <input type="hidden" name="guestId" value="{$gr.guestId}" />
{*                <div class="guestDescTitle">ID:</div>
                <div class="guestDescInput">{$gr.guestId}</div>
                <div class="clear"></div>    *}         
                {if !empty($gr.remark)}
                    <div class="guestDescTitle guestRemark" style="color: red;">
                        Проблема:
                        <img src="icon/active.png" style="cursor: pointer;" title="Устранена" onclick="deleteRemark('{$gr.guestId}', 'search');"/>
                        <div class="clear"></div>   
                    </div>
                    <div class="guestDescInput guestRemark" style="color: red;">{$gr.remark}</div>
                    <div class="clear guestRemark"></div>            
                {/if}
                
                <div class="guestDescTitle">Карта номер:</div>
                <div class="guestDescInput guestCardNumber">{$gr.cardNumber}</div>
                <div class="clear"></div>
                <div class="guestDescTitle">Имя(ФИО):</div>
                <div class="guestDescInput guestName">{$gr.thirdName} {$gr.name} {$gr.secondName}</div>
                <div class="clear"></div>
                <div class="guestDescTitle">Дата рождения:</div>
                <div class="guestDescInput guestBirth">{$gr.birthday}</div>                
                <div class="clear"></div>
                <div class="guestDescTitle">Телефон:</div>
                <div class="guestDescInput guestPhone">{$gr.phone}</div>
                <div class="clear"></div>                
                <div class="guestDescTitle">E-mail:</div>
                <div class="guestDescInput guestEmail">{$gr.email}</div>
                <div class="clear"></div>
                <div class="guestDescTitle">Страна:</div>
                <div class="guestDescInput guestCountry">{$gr.country}</div>
                <div class="clear"></div>
                <div class="guestDescTitle">Город:</div>
                <div class="guestDescInput guestCity">{$gr.city}</div>
                <div class="clear"></div>
                <div class="guestDescTitle">Баллов:</div>
                <div class="guestDescInput">{$gr.points}</div>
                <div class="clear"></div>
            </div>    
            <div class="guestSetup">
                <div class="setupButtonActive" onclick="editGuest($(this));">Редактировать</div>
                <div class="clear"></div>
                <div class="setupButtonActive" onclick="findGuestActive();">Добавить баллы</div>
                <div class="clear"></div> 
                <div class="setupButtonActive" onclick="findGuestActive();">Списать баллы</div>
                <div class="clear"></div>   
                <div class="setupButtonActive" onclick="findGuestActive();">История баллов</div>
                <div class="clear"></div>                   
                <div class="setupButtonActive" onclick="guestEnter({$gr.guestId});">Гость зашел</div>
                <div class="clear"></div>                   
            </div>  
            <div class="guestSetupEdit">
                <div class="setupButtonActive" onclick="saveGuestChanges('{$gr.guestId}', $(this));">Сохранить</div>
                <div class="clear"></div>
                <div class="setupButtonCancel" onclick="cancelGuestChanges($(this));">Отменить</div>
                <div class="clear"></div>                 
            </div>                  
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    {/foreach}
{/if}
<div class="clear"></div>