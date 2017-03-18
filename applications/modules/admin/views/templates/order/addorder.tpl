{include file='header.tpl'}

<table class="adminTable">   
    <tr>
        <td class="title">
            Имя
        </td>
        <td class="content">
            <input type="text" name="firstName" value="" />
        </td>
    </tr>
    <tr>
        <td class="title">
            Фамилия
        </td>
        <td class="content">
            <input type="text" name="lastName" value="" />
        </td>        
    </tr>
    <tr>
        <td class="title">
            Страна
        </td>
        <td class="content">
            <input type="text" name="country" value="Россия" />
        </td>          
    </tr>
    <tr>
        <td class="title">
            Город
        </td>
        <td class="content">
            <input type="text" name="city" value="" />
        </td>         
    </tr>
    <tr>
        <td class="title">
            Телефон
        </td>
        <td class="content">
            <input type="text" name="phone" value="" />
        </td>             
    </tr>
    <tr>
        <td class="title">
            email
        </td>
        <td class="content">
            <input type="text" name="email" value="" />
        </td>          
    </tr>
    <tr>
        <td class="title">
            Дата заказа
        </td>
        <td class="content">
            <input type="text" name="dateAdded" value="{$currentDate}" />
        </td>           
    </tr>
    <tr>
        <td class="title">
            Комментарий админа
        </td>
        <td class="content">
            <textarea name="adminComment"></textarea>
        </td>
    </tr>     
    <tr>
        <td class="title">
            Стоимость заказа
        </td>
        <td class="content" id="priceField">{$smarty.session.adminCartPrice.orderPrice} руб</td>
    </tr>   
</table>
<div class="clear"></div><br/>
<strong>Продукты в заказе</strong>
<div class="clear"></div>
<div class="productSelect">
    <select name="productId" id="selectProduct">
        <option value="0">Выбери продукт</option>
        {foreach from=$products.data item=p}
            <option value="{$p.productId}">{$p.title}, {$p.price} руб.</option>
        {/foreach}
    </select>
</div>
<div class="productAddButton" onclick="addProductToOrder();">
    Добавить к заказу
</div>
<div class="clear"></div>
{foreach from=$adminCart item=op}
    <div class="orderProductItem">
        <img src="images/product/{$op.details.productId}/{$op.details.imageMedium}" />
        <div class="clear"></div><br/>
        <span class="orderProductItemTitle">ID</span> {$op.details.productId}
        <div class="clear"></div>
        <span class="orderProductItemTitle">Название</span> <a href="product/details/id/{$op.details.productId}" target="_blank">{$op.details.title}</a>
        <div class="clear"></div>        
        <span class="orderProductItemTitle">Цена за ед</span> {$op.details.price} руб
        <div class="clear"></div>
        <span class="orderProductItemTitle">Количество</span> {$op.amount}
        <div class="clear"></div>
        <span class="orderProductItemTitle">Полная цена</span> {$op.allPrice} руб
        <div class="clear"></div>        
    </div>
{/foreach}
<div class="clear"></div>
<div class="productAddButton" onclick="addAdminOrder();">
    Оформить заказ
</div>
<div class="clear"></div>
{include file='footer.tpl'}