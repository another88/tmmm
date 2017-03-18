{if count($result)>0}
    {foreach from=$result item=u}
        <div style="background-color: #3f3f3f; border: 1px solid #6c6761; margin-bottom:3px; cursor: pointer;" 
             onclick="location.href=rootPath+'admin/{$smarty.session.htmlParams.controller}/{$smarty.session.htmlParams.indexActionName}/filterresult/{$u.on}/i/{$i}';">
            {$u.on}
        </div>
    {/foreach}
{else}
    <div style="background-color: #3f3f3f;">
        No results.
    </div>    
{/if}