
{foreach from=$tableList.data item=tl}
    <div class="tableIcon" onclick="guestToTable('{$tl.guestTableId}', '{$guestId}');">
        {$tl.title}
        <div class="clear"></div>
    </div>
{/foreach}  
<div class="clear"></div>
