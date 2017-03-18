<input type="hidden" name="constructorBaseJson" value='{$constructorBaseJson}' />
<div class="rightTitle cursorPointer">Готовые решения<span class="backButtonChoice" style="padding-right: 0;" onclick="elementsFromBaseShow();">Посмотреть</span></div>
<div class="clr"></div>
<div class="constructorBaseItem">
    {foreach from=$constructorBase.data item=cb}
        <div class="baseChoiceBlockItem" onclick="setElementsFromBase('{$cb.constructorId}');">Автор: {$cb.author}</div>
        <div class="clr"></div>                    
    {/foreach}
    {if $constructorBase.total > $constructorBase.pageLength}
        {$paging}
        <div class="clr"></div> 
    {/if}
</div>
<div class="clr"></div>