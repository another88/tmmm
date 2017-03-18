<div class="searchTitle">Найденные миксы</div>
{if count($serachResult)>0}
    {foreach from=$serachResult item=sr name=iterm}
        <div class="mixSearchResultBlock" {if $smarty.foreach.iterm.iteration is even}style='margin-right: 0;'{/if}>
            <div class="mixSearchBlockLeft" id="mix_{$sr.mixId}">
                <div style="padding: 15px 0 15px 15px;">
                    <img src='i/ace_mix_logo.png' />
                    <div class="clr"></div> 
                    {if !empty($sr.author)}
                        Автор: <a href="javascript:void(0);">{$sr.author}</a>
                        <div class="clr"></div> 
                    {/if}                
                    <div class="diagramBlock">
                        <input type="hidden" name="diaData" value='{$sr.json}' />
                        <input type="hidden" name="mixId" value='{$sr.mixId}' />
                        <canvas id="dia_{$sr.mixId}" width="150" height="150"/>
                    </div>
                    <div class="tabacsInMix">
                        {foreach from=$sr.mixDetails item=t}
                            <div class="tabacBlockInSearch">
                                <div class="tabacColorBlock" style="background-color: #{$t.color}"></div>
                                <div class="tabacTitleInSearch">{$t.tabacCategoryTitle}-{$t.tabacTitle}: {$t.percent}%</div>
                                <div class="clr"></div> 
                            </div>
                            <div class="clr"></div> 
                        {/foreach}    
                        <div class="clr"></div> 
                    </div>
                    <div class="clr"></div> 
                    <div class="toKolba">в колбу:</div>
                    <div class="toKolbaText">{$sr.waterDescription}</div>
                    <div class="clr"></div> 
                </div>
                 
                <div class="clr"></div> 
            </div>
            <div class="orangeLine"></div>
            <div class="mixSearchBlockRight">
                <div class="share42initVert"
                    data-url="http://ace-hookah.com/mix"
                    data-title="Ace Hookah Микс"
                    data-description="{$sr.shareDesc}"
                    data-image="http://ace-hookah.com/i/mix_logo_main.jpg"
                ></div>   
                <div class="mix_social_button save" onclick="saveImg({$sr.mixId});"></div>
            </div>
            <div class="clr"></div>
        </div>
        {if $smarty.foreach.iterm.iteration is even}
            <div class="clr"></div>
        {/if}            
    {/foreach}
{else}
    <span style="color: red;">В нашей базе не найдено миксов с такими вкусами.</span>
    <div class="clr"></div>
{/if}
<div class="clr"></div>