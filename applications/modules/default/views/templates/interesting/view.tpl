{include file='header.tpl'}

<div class="contentInner">
    <div class="interestLeft">
        <h1>{$pageTitle}</h1>
        <div class="clr"></div>
        {$content.description}
        <div class="clr"></div>
        <div class="interestingPageTextShare">
            <div class="share42init"
                 data-url="http://ace-hookah.com/interesting/{$content.url}.html"
                 data-title="{$content.title}"
                 data-description="{$content.shortDescription}"
            ></div>         
            {literal}
                <script type="text/javascript" src="share42/share42.js"></script>
            {/literal}   
        </div>  
        <div class="interestViews" title="Просмотров">
            <img src="i/views.png" />
            <div class="viewsCount">{$content.veiwCount}</div>
        </div>
        <div class="clr"></div>
        <div class="interestNav">
            <h2>Другие статьи</h2>
            {foreach from=$list.data item=ld}
                <div class="interestMenuBlock{if $ld.contentId == $content.contentId} interestMenuActiveBlock{/if}" onclick="redirect('interesting/{$ld.url}.html');">
                    <a href="interesting/{$ld.url}.html">{$ld.title}</a>
                    <div class="clr"></div>
                    <div class="inNavDesc">{$ld.shortDescription}</div>
                    <div class="clr"></div>
                </div>
            {/foreach}
            <div class="clr"></div>
        </div>    
        <div class="clr"></div>        
    </div>           
    <div class="clr"></div>
</div>

{include file='footer.tpl'}