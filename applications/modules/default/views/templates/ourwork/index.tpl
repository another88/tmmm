{include file='header.tpl'}

<script type="text/javascript">
    var pid = {$pid};
</script>       

<div class="contentInner">
    <h1>{$pageTitle}</h1>
    <div class="clr"></div>           
    {if count($list.data)>0}
        {foreach from=$list.data item=p name=iter}
            <div class="ourWorkBlock" id="pid_{$p.ourWorkId}" {if $smarty.foreach.iter.first}style="margin-top: 0;"{/if}
                 {if $smarty.foreach.iter.last}style="border-bottom: none;"{/if}>
                <div class="ourWorkTitle">{$p.title}</div>
{*                <div class="clr"></div>
                {$p.description}*}
                <div class="clr"></div>
                {foreach from=$p.images.data item=pi name=pit}
                    <div class="ourWorkImage"
                         {if $smarty.foreach.pit.iteration is div by 4}style="margin-right: 0;"{/if}
                         >
                        <a href="images/ourwork/{$pi.ourWorkId}/{$pi.imageOriginal}" class="imageFancy" rel="group_{$p.ourWorkId}">
                            <img src="images/ourwork/{$pi.ourWorkId}/{$pi.imageMedium}" alt="Эксклюзивный кальян от Ace Hookah '{$p.title}'" title="Эксклюзивный кальян от Ace Hookah '{$p.title}'" />
                        </a>
                    </div>
                    {if $smarty.foreach.pit.iteration is div by 4}
                        <div class="clr"></div>
                    {/if}
                {/foreach}
                <div class="clr"></div>
                <div class="ourWorkShare">
                    <div class="share42init"
                         data-url="http://ace-hookah.com/ourwork?pid={$p.ourWorkId}"
                         data-title="{$p.title}"
                         data-description="{$p.description}"
                         data-image="http://ace-hookah.com/images/ourwork/{$pi.ourWorkId}/{$pi.imageMedium}"
                    ></div>
                    <div class="likeBlock">
                        <div class="likeImg">
                            {if $p.isLike}
                                <img src="i/like_active.png" class="activeLike" />                                
                            {else}
                                <img src="i/like.png" 
                                        onmouseover="likeHover($(this));" 
                                        onmouseout="likeOut($(this));"
                                        onclick="like('{$p.ourWorkId}');" />
                            {/if}
                        </div>
                        <div class="likeCount">{$p.likeCount}</div>
                    </div>
                </div>    
                <div class="clr"></div>
            </div>
        {/foreach}    
        {literal}
            <script type="text/javascript" src="share42/share42.js"></script>
        {/literal}                
    {else}
        Нет Данных.
    {/if}
    <div class="clr"></div>
</div>

{include file='footer.tpl'}