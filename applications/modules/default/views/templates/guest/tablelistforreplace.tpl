{if count($tableList)>0}
    {if $type == 'product'}
        <input type="text" name="amountToReplace" id="atr_{$oldTableId}_{$productId}" value="{$amount}" oldval="{$amount}" onblur="changeAmountToReplaceValid('{$oldTableId}', '{$productId}');"/>
        {foreach from=$tableList item=tl}
            <div class="tableIcon" onclick="productToTableReplace('{$tl.guestTableId}', '{$oldTableId}', '{$productId}');">
                {$tl.title}
                <div class="clear"></div>
            </div>
        {/foreach}  
        <div class="clear"></div>
    {else}
        {foreach from=$tableList item=tl}
            <div class="tableIcon" onclick="guestToTableReplace('{$tl.guestTableId}', '{$oldTableId}', '{$guestId}');">
                {$tl.title}
                <div class="clear"></div>
            </div>
        {/foreach}  
        <div class="clear"></div>    
    {/if}
{/if}