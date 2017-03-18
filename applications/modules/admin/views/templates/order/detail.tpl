{include file='header.tpl'}

<table class="adminTable">
    <tr>
        <td class="title">
            Пользователь ID
        </td>
        <td class="content">{$order.userId}</td>
    </tr>    
    <tr>
        <td class="title">
            Имя
        </td>
        <td class="content">{$order.firstName}</td>
    </tr>
    <tr>
        <td class="title">
            Фамилия
        </td>
        <td class="content">{$order.lastName}</td>
    </tr>
    <tr>
        <td class="title">
            Страна
        </td>
        <td class="content">{$order.country}</td>
    </tr>
    <tr>
        <td class="title">
            Город
        </td>
        <td class="content">{$order.city}</td>
    </tr>
    <tr>
        <td class="title">
            Телефон
        </td>
        <td class="content">{$order.phone}</td>
    </tr>
    <tr>
        <td class="title">
            email
        </td>
        <td class="content">{$order.email}</td>
    </tr>
    <tr>
        <td class="title">
            Комментарий
        </td>
        <td class="content">{$order.comment}</td>
    </tr>
    <tr>
        <td class="title">
            Дата заказа
        </td>
        <td class="content">{$order.dateAdded}</td>
    </tr>
    <tr>
        <td class="title">
            Цена
        </td>
        <td class="content">{$order.price} руб</td>
    </tr>
    <tr>
        <td class="title">
            Скидка
        </td>
        <td class="content">{$order.discount} руб</td>
    </tr>    
    <tr>
        <td class="title">
            Комментарий админа
        </td>
        <td class="content">
            <form id="article" action="admin/order/admincomment/id/{$order.orderId}" method="post" enctype="multipart/form-data">
                <textarea name="adminComment">{$order.adminComment}</textarea>
                <button type="submit" class="button">Сохранить</button>
            </form>            
        </td>
    </tr>    
</table>
<div class="clear"></div><br/>
<strong>Продукты в заказе</strong>
<div class="clear"></div><br/>
{foreach from=$order.products.data item=op}
    {if $op.productId != '0'}
        <div class="orderProductItem">
            <img src="images/product/{$op.productDetails.productId}/{$op.productDetails.imageMedium}" />
            <div class="clear"></div><br/>
            <span class="orderProductItemTitle">ID</span> {$op.productDetails.productId}
            <div class="clear"></div>
            <span class="orderProductItemTitle">Название</span> <a href="product/details/id/{$op.productDetails.productId}" target="_blank">{$op.productDetails.title}</a>
            <div class="clear"></div>        
            <span class="orderProductItemTitle">Цена за ед</span> {$op.price} руб
            <div class="clear"></div>
            <span class="orderProductItemTitle">Количество</span> {$op.amount}
            <div class="clear"></div>
            <span class="orderProductItemTitle">Полная цена</span> {$op.totalPrice} руб
            <div class="clear"></div>        
        </div>
    {else}
        <div class="orderProductItem">
            <div class="conLeftPart">
                <div class="conShaxta conElement conMain_shaxta">
                    {if isset($op.elements.shaxta)}
                        <img src="images/consshaxta/{$op.elements.shaxta.consShaxtaId}/{$op.elements.shaxta.imageSmall}" width="79px" />
                    {/if}
                </div>
                <div class="clr"></div>
                <div class="conKolba conElement conMain_kolba">
                    {if isset($op.elements.kolba)}
                        <img src="images/conskolba/{$op.elements.kolba.consKolbaId}/{$op.elements.kolba.imageSmall}" width="79px" />
                    {/if}                    
                </div>
                <div class="clr"></div>
            </div>
            <div class="consRightPart">
                <div class="conTrybka conElement conMain_trybka">
                    {if isset($op.elements.trybka)}
                        <img src="images/constrybka/{$op.elements.trybka.consTrybkaId}/{$op.elements.trybka.imageSmall}" width="106px" />
                    {/if}                       
                </div>
                <div class="clr"></div>                
                <div class="conBowl conElement conMain_bowl">
                    {if isset($op.elements.bowl)}
                        <img src="images/consbowl/{$op.elements.bowl.consBowlId}/{$op.elements.bowl.imageSmall}" width="50px" />
                    {/if}                       
                </div>
                <div class="conBludce conElement conMain_bludce">
                    {if isset($op.elements.bludce)}
                        <img src="images/consbludce/{$op.elements.bludce.consBludceId}/{$op.elements.bludce.imageSmall}" width="50px" />
                    {/if}                      
                </div>
                <div class="clr"></div>
                <div class="conShipci conElement conMain_shipci">
                    {if isset($op.elements.shipci)}
                        <img src="images/consshipci/{$op.elements.shipci.consShipciId}/{$op.elements.shipci.imageSmall}" width="50px" />
                    {/if}                      
                </div>
                <div class="clr"></div>
            </div>   
            <div class="clear"></div>
            <span class="orderProductItemTitle">ID</span> {$op.elementsId}
            <div class="clear"></div>
            <span class="orderProductItemTitle">Цена за ед</span> {$op.price} руб
            <div class="clear"></div>
            <span class="orderProductItemTitle">Количество</span> {$op.amount}
            <div class="clear"></div>
            <span class="orderProductItemTitle">Полная цена</span> {$op.totalPrice} руб
            <div class="clear"></div>    
        </div>
    {/if}
{/foreach}
<div class="clear"></div>
{include file='footer.tpl'}