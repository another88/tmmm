{include file='header.tpl'}

{if isset($mixDetails)}
    <script type="text/javascript">
        var mid = {$mixDetails.mixId};
    </script>       
    {include file='popup_current_mix.tpl'}
{else}
    <script type="text/javascript">
        var mid = 0;
    </script>     
{/if}

<div class="contentInner">
    <div class="mixText">
        <h1>{$pageTitle}</h1>
        <div class="clr"></div>            
        {$content.description}
        <div class="mixPageTextShare">
            <div class="share42init"
                 data-url="http://ace-hookah.com/mix"
                 data-title="{$content.title}"
                 data-description="{$content.description}"
                 data-image="http://ace-hookah.com/i/mix_logo_main.jpg"
            ></div>        
            {literal}
                <script type="text/javascript" src="share42/share42.js"></script>
            {/literal}                  
        </div>           
        <div class="clr"></div>             
    </div>        
    <div class="clr"></div><br/>
    <div class="searchTitle">Поиск микса</div>
    <div class="clr"></div>
    <div class="mixMain">
        <select class="mixSelectSearch" onchange="selectTabacCategorySearch($(this).val());">
            <option value="0">Выбирите фирму табака</option>
            {foreach from=$tabacCategory item=tc}
                <option value="{$tc.tabacCategoryId}">{$tc.title}</option>
            {/foreach}
        </select>      
        <div class="mixSearchType">
            <label for="check1">По выбранным вкусам</>
            <input id="check1" type="checkbox" name="onlySelected" />
            <div class="clr"></div>
        </div>
        <div class="mixButton" onclick="searchMix();">Искать миксы</div>
        <div class="mixButtonRight" onclick="addMixModal();">Добавить свой микс</div>
        <div class="clr"></div>
        <div class="tabacSelectedSearch"></div>
        <div class="clr"></div>  
        <div class="tabacList">
            {foreach from=$tabacCategory item=tc}
                <div class="tabacCategoryListSearch" id="tabacCategorySearch_{$tc.tabacCategoryId}">
                    {foreach from=$tc.tabac.data item=t}
                        <div class="tabacBlock" id="tabacSearch_{$t.tabacId}_{$t.tabacCategoryId}" onclick="selectTabacSearch('{$t.tabacId}', '{$t.title}', '{$t.tabacCategoryId}', '{$tc.title}');">
                            {$t.title}
                        </div>
                    {/foreach}  
                    <div class="clr"></div>
                </div>
            {/foreach}                        
        </div>  
        <div class="clr"></div>
        <div id="mixSearchResultError"></div>
        <div class="clr"></div>            
    </div>
    <div class="clr"></div>
    <div id="mixSearchResult"></div>
    <div class="clr"></div>
</div>
{include file='popup_mix.tpl'}  

{include file='footer.tpl'}