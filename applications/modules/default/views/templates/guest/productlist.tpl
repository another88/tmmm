{foreach from=$productList.data item=tl}
    <div class="tableIcon" onclick="productToTable('{$tableId}', '{$tl.guestProductId}');">
        {$tl.title} - {$tl.price} руб
        <div class="clear"></div>
    </div>
{/foreach}  
<div class="clear"></div>