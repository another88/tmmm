{include file='header.tpl'}

<script type="text/javascript">
    var constructorIsset = '{$constructorIsset}';
</script>   

<div class="contentInner">
    <div class="contentInnerLeft">
        <h1>{$pageTitle}</h1>
        <div class="clr"></div>            
        {if isset($cart) && count($cart)>0}
            <table class="checkoutTable">
                <thead>
                    <tr>
                        <td>
                            Картинка
                        </td>
                        <td>
                            Название
                        </td> 
                        <td>
                            Цена
                        </td>
                        <td>
                            Количество
                        </td>     
                        <td>
                            Стоимость позиции
                        </td> 
                        <td>
                            Удалить
                        </td>                         
                    </tr>
                </thead>
                <tbody>
                    {foreach from=$cart item=c}
                        <tr>
                            <td width="10%">
                                {if !empty($c.details.imageSmall)}
                                    <img src="images/product/{$c.details.productId}/{$c.details.imageSmall}" />
                                {else}
                                    {*<img src="i/constr_logo.jpg" />*}
                                {/if}                                
                            </td>
                            <td width="55%" style="text-align: left;">
                                {if !isset($c.elements)}
                                    <a href="product/{$c.details.url}.html" target="_blank">{$c.details.title}</a>
                                {else}
                                    <input type="hidden" name="jsonData_{$c.uniKey}" id="{$c.uniKey}" class="cartJsonInput" value='{$c.elementsJSON}' />
                                    <div id="consPreviewBlock_{$c.uniKey}"></div>
                                {/if}                                
                            </td> 
                            <td width="10%">
                                {$c.details.price} рублей
                            </td>
                            <td width="11%">
                                <div class="amountBlockCheckout">
                                    <input type="text" value="{$c.amount}" name="amount" onblur="changeAmountBlur($(this), true);" />
                                    <input type="hidden" value="{$c.uniKey}" name="uniKey" />
                                    <div class="amountChangeCheckout">
                                        <div class="amountUpCheckout" title="Больше" onclick="changeAmount('up', $(this), true);"></div>
                                        <div class="clr"></div> 
                                        <div class="amountDownCheckout" title="Меньше" onclick="changeAmount('down', $(this), true);"></div>
                                        <div class="clr"></div> 
                                    </div>
                                    <div class="clr"></div> 
                                </div>
                            </td>     
                            <td width="9%">
                                {$c.allPrice} рублей
                            </td> 
                            <td width="5%">
                                <img src="icon/delete.png" class="cursotPointer" onclick="deleteFromCart('{$c.uniKey}', false);"/>
                            </td>                         
                        </tr>    
                    {/foreach}
                </tbody>
            </table>
            <div class="clr"></div>
            <div class="checkoutPriceBlock">
                {if $smarty.session.cartPrice.discount}
                     <div class="checkoutPriceBlockItem">
                         <div class="checkoutPriceBlockItemTitle">
                             Стоимость без скидки:
                         </div>
                         <div class="checkoutPriceBlockItemValue">
                             {$smarty.session.cartPrice.totalProductsPrice} руб
                         </div>                    
                         <div class="clr"></div>
                     </div>
                     <div class="clr"></div>
                     <div class="checkoutPriceBlockItem">
                         <div class="checkoutPriceBlockItemTitle">
                             Скидка:
                         </div>
                         <div class="checkoutPriceBlockItemValue">
                             {$smarty.session.cartPrice.discount} руб
                         </div>                    
                         <div class="clr"></div>
                     </div>
                     <div class="clr"></div>  
                 {/if}                
                <div class="checkoutPriceBlockItem">
                    <div class="checkoutPriceBlockItemTitle">
                        Стоимость заказа:
                    </div>
                    <div class="checkoutPriceBlockItemValue">
                        {$smarty.session.cartPrice.orderPrice} руб
                    </div>                    
                    <div class="clr"></div>
                </div>
                <div class="clr"></div>
                <div class="toOrderButton" onclick="scrollTo('orderForm');">К оформлению заказа</div>
                <div class="clr"></div>
            </div>
            <div class="clr"></div>
            {if count($productLike.data)>0}
                <div class="likeProductBlock">
                    <div class="likeProductTitle">С этими товарами часто покупают</div>
                    {foreach from=$productLike.data item=p name=iter}
                        <div id="productBlock_{$p.productId}" {if $smarty.foreach.iter.iteration is div by 3}class="productBlockMainLast"{else}class="productBlockMain"{/if}>
                            <div class="mainProductImage" 
                                 style="background:transparent url('images/product/{$p.productId}/{$p.imageBig}') no-repeat 0 0;"
                                 onclick="redirect('product/{$p.url}.html');">
                                <div class="priceAngle">
                                    <span class="anglePriceVal">{$p.price}</span><br/>рублей
                                </div>
                                <div class="clr"></div>
                                <div class="mainProductTitle"><a href="product/{$p.url}.html">{$p.title}</a></div>
                                <div class="clr"></div>
                            </div>
                            <div class="clr"></div>
                            <div class="mainProductBuy analiticsToCartButton" onclick="toCart('{$p.productId}', false);">Добавить к заказу</div>
                            <div class="clr"></div>
                        </div>
                    {/foreach} 
                    <div class="clr"></div>
                </div>
                <div class="clr"></div>
            {/if}
            <div class="orderFormTitle" id="orderForm">оформление заказа</div>
            <div class="clr"></div>
            <div class="orderForm">
                <input type="text" name="phoneNumber" value="" class="phoneNumberClass" /> 
                Для заказа, заполните поля ниже Вашими данными.
                Поля, отмеченные <span class="redColor">*</span> обязательны для заполнения.
                <div class="clr"></div><br/>
                <div class="checkoutInputTitle">
                    Имя<span class="redColor">*</span>
                </div>
                <div class="checkoutInputField">
                    <input type="text" name="firstName" class="popupInp clickToWhite" content-type="text" valid="1"
                            errortext="Введите Ваше Имя, например 'Иван'"
                           {if isset($smarty.session.user)}value="{$smarty.session.user.firstName}"{/if}/>         
                </div>   
                <div class="checkoutInputTitle">
                    Фамилия<span class="redColor">*</span>
                </div>
                <div class="checkoutInputField">
                    <input type="text" name="lastName" class="popupInp clickToWhite" content-type="text" valid="1" 
                            errortext="Введите Вашу Фамилию, например 'Иванов'"
                           {if isset($smarty.session.user)}value="{$smarty.session.user.lastName}"{/if}/>         
                </div>           
                <div class="clr"></div><br/>
                <div class="checkoutInputTitle">
                    Страна<span class="redColor">*</span>
                </div>
                <div class="checkoutInputField">
                    <input type="text" name="country" class="popupInp clickToWhite" content-type="text" valid="1" 
                            errortext="Введите Вашу Страну, например 'Россия'" value="Россия"/>         
                </div>   
                <div class="checkoutInputTitle">
                    Город<span class="redColor">*</span>
                </div>
                <div class="checkoutInputField">
                    <input type="text" name="city" class="popupInp clickToWhite" content-type="text" valid="1"
                            errortext="Введите Ваш Город, например 'Севастополь'"
                           {if isset($smarty.session.user)}value="{$smarty.session.user.city}"{/if}/>         
                </div>           
                <div class="clr"></div><br/>
                <div class="checkoutInputTitle">
                    Телефон<span class="redColor">*</span>
                </div>
                <div class="checkoutInputField">
                    <input type="text" name="phone" class="popupInp clickToWhite" content-type="text" valid="1" 
                            errortext="Введите Ваш номер телефона, например '+79787771115'"
                           {if isset($smarty.session.user)}value="{$smarty.session.user.phone}"{/if}/>         
                </div>   
                <div class="checkoutInputTitle">
                    E-mail<span class="redColor">*</span>
                </div>
                <div class="checkoutInputField">
                    <input type="text" name="email" class="popupInp clickToWhite" content-type="email" valid="1"
                           errortext="Введите Ваш E-mail, например 'ivan1989@mail.ru'"
                           {if isset($smarty.session.user)}value="{$smarty.session.user.email}"{/if}/>         
                </div>  
                <div class="clr"></div><br/> 
                <div class="checkoutInputTitle">
                    Доставка<span class="redColor">*</span>
                </div>
                <div class="checkoutInputField">
                    <select name="deliveryType" class="popupInp selectBlock">
                        <option value="samo" selected="selected">Самовывоз</option>
                        <option value="company">Транспортной компанией</option>
                    </select>       
                </div>  
                <div class="clr"></div><br/>                 
                <div class="checkoutInputTitle">
                    Комментарий, адрес доставки
                </div>
                <div class="checkoutInputFieldBig">
                    <textarea class="checkoutTextarea" name="comment" content-type="text" valid="0"></textarea>         
                </div>                 
                <div class="clr"></div><br/>        
                <div id="checkout_message"></div>  
                <div class="checkout_button" onclick="order();">Заказать</div>
                <div class="clr"></div>           
            </div>
        {else}
            Корзина заказа пуста.
        {/if}
        <div class="clr"></div>
    </div>
    <div class="clr"></div>
</div>

{if isset($json)}
    <input type="hidden" name="jsonData" value='{$json}' />
    <div id="cartConsModals"></div>
{/if}

{include file='footer.tpl'}