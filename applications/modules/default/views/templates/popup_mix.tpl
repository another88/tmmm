<div id="popup_mix" class="popup">
    <div class="feedbackHeader">
        Добавить свой микс
        <div class="clr"></div>
    </div>
    <div class="clr"></div>
    <div class="popupContent">
        <div class="mixInputTitle marginBottom10">
            Автор
        </div>
        <div class="mixInputField marginBottom10">
            <input type="text" name="phoneNumber" value="" class="phoneNumberClass" />
            <input type="hidden" name="authorId" {if isset($smarty.session.user)}value="{$smarty.session.user.userId}"{else}value="0"{/if}>
            <input type="text" name="author" class="popupInp mixPopupInp"
                   {if isset($smarty.session.user)}value="{$smarty.session.user.firstName} {$smarty.session.user.lastName}"{/if}/>         
        </div>
        <div class="clr"></div>
        <div class="mixInputTitle marginBottom10">
            Что в колбу
        </div>
        <div class="mixRightInputFieldBig marginBottom10">
            <textarea class="commentTextareaMix" name="water"></textarea>       
        </div>
        <div class="clr"></div>
        <div class="mixInputTitle marginBottom10">
            Табак
        </div>
        <div class="mixRightInputFieldBig marginBottom10">
            <select class="mixSelect" onchange="selectTabacCategory($(this).val());">
                <option value="0">Выбирите фирму табака</option>
                {foreach from=$tabacCategoryAdd.data item=tc}
                    <option value="{$tc.tabacCategoryId}">{$tc.title}</option>
                {/foreach}
            </select>      
        </div>
        <div class="clr"></div>  
        <div class="tabacSelected"></div>
        <div class="clr"></div>  
        <div class="tabacList">
            {foreach from=$tabacCategoryAdd.data item=tc}
                <div class="tabacCategoryList" id="tabacCategory_{$tc.tabacCategoryId}">
                    {foreach from=$tc.tabac.data item=t}
                        <div class="tabacBlock" id="tabac_{$t.tabacId}_{$t.tabacCategoryId}" onclick="selectTabac('{$t.tabacId}', '{$t.title}', '{$t.tabacCategoryId}', '{$tc.title}');">
                            {$t.title}
                        </div>
                    {/foreach}  
                    <div class="clr"></div>
                </div>
            {/foreach}   
            <div class="clr"></div>
        </div>  
        <div class="clr"></div><br/>
        <div class="mixButton" onclick="saveMix();">Добавить</div>
        <div id="mix_message"></div>   
        <div class="clr"></div>
    </div>
    <div class="clr"></div><br/>   
    <div id="testimonial_message"></div>
    <div class="testimonialPopupButton testimonialDoButton" onclick="testimonialSend();">Отправить</div>
    <div class="clr"></div>
</div>
<div class="clr"></div> 