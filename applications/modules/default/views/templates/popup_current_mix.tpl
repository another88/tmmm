<div id="popup_current_mix" class="popup">
    <div class="mixSearchResultBlock">
        <div class="mixSearchBlockLeft" id="pop_mix_{$mixDetails.mixId}">
            <div style="padding: 15px 0 15px 15px;">
                <img src='i/ace_mix_logo.png' />
                <div class="clr"></div> 
                {if !empty($mixDetails.author)}
                    Автор: <a href="javascript:void(0);">{$mixDetails.author}</a>
                    <div class="clr"></div> 
                {/if}                
                <div class="diagramBlock">
                    <input type="hidden" name="pop_diaData" value='{$mixDetails.json}' />
                    <input type="hidden" name="pop_mixId" value='{$mixDetails.mixId}' />
                    <canvas id="pop_dia_{$mixDetails.mixId}" width="150" height="150"/>
                </div>
                <div class="tabacsInMix">
                    {foreach from=$mixDetails.mixDetails item=t}
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
                <div class="toKolbaText">{$mixDetails.waterDescription}</div>
                <div class="clr"></div> 
            </div>

            <div class="clr"></div> 
        </div>
        <div class="orangeLine"></div>
        <div class="mixSearchBlockRight">
            <div class="share42initVert"
                data-url="http://ace-hookah.com/mix"
                data-title="Ace Hookah Микс"
                data-description="{$mixDetails.shareDesc}"
                data-image="http://ace-hookah.com/i/mix_logo_main.jpg"
            ></div>   
            <div class="mix_social_button save" onclick="saveImg({$mixDetails.mixId});"></div>
        </div>
        <div class="clr"></div>
    </div>   
    <div class="clr"></div>
</div>
<div class="clr"></div> 