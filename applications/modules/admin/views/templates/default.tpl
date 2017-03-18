{include file = 'header.tpl'}

{if $title == 'Заказы'}
    <input type="button" class="addOrderButton" value="Добавить заказ" onclick="location.href=rootPath+'admin/order/addorder';" />
{/if}

{$html}

{include file = 'footer.tpl'}