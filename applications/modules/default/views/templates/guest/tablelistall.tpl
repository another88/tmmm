
{foreach from=$tableList.data item=tl}
    <div class="tableIcon" onclick="guestToTableAll('{$tl.guestTableId}');">
        {$tl.title}
        <div class="clear"></div>
    </div>
{/foreach}  
<div class="clear"></div>
