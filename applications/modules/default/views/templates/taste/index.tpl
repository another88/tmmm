{include file='header.tpl'}

<div class="contentInner">
    <div class="contentInnerLeft">
        <h1>{$pageTitle}</h1>
        <div class="clr"></div>             
        {if count($taste.data)>0}
            {foreach from=$taste.data item=p name=iter}
                <div class="tasteBlock">
                    <div class="tasteImage">
                        <img src="images/taste/{$p.tasteId}/{$p.imageMedium}" class="resizebleImg" />
                        <div class="clr"></div>
                    </div>
                    <div class="tasteDescription">
                        <div class="tasteTitle">{$p.title}</div>
                        <div class="clr"></div>
                        {$p.description}
                        <div class="clr"></div>
                    </div>
                    <div class="clr"></div>
                </div>
                <div class="clr"></div>
            {/foreach}        
        {else}
            Нет Данных.
            <div class="clr"></div>
        {/if}
    </div>
    <div class="clr"></div>
</div>

{include file='footer.tpl'}