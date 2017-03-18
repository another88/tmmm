<div id="popup_buyOnClick_{$p.productId}" class="popup">
    <div class="feedbackHeader">
        Купить в один клик
        <div class="clr"></div>
    </div>
    <div class="clr"></div>
    <div class="popupContent">
        <input type="text" name="phoneNumber" value="" class="phoneNumberClass" /> 
        <input type="hidden" name="productId" value="{$p.productId}" />
        <div class="popupproductPageImage">
            <img src="images/product/{$p.productId}/{$p.imageBig}" />
            <div class="clr"></div>
        </div>
        <div class="popupproductPageText">
            <div class="popupProductTitle">{$p.title}</div>
            <div class="clr"></div><br/>
            {$p.description}
            <div class="clr"></div><br/>
        </div>         
        <div class="clr"></div>
        Для заказа, заполните поля ниже Вашими данными.
        Поля, отмеченные <span class="redColor">*</span> обязательны для заполнения.
        <div class="clr"></div>       
        <div class="popupFinishDiv">
            <div class="popupInputTitle popupProductMargin">
                Имя<span class="redColor">*</span>
            </div>
            <div class="popupInputField popupProductMargin">
                <input type="text" name="name" class="popupInp clickToWhite" 
                       content-type="text" valid="1" errortext="Введите Ваше Имя, например 'Иван Иванов'" onkeyup="popupEnter(event, $(this));"
                       {if isset($smarty.session.user)}value="{$smarty.session.user.firstName} {$smarty.session.user.lastName}"{/if}/>         
            </div>
            <div class="popupInputTitle popupProductMargin">
                E-mail<span class="redColor">*</span>
            </div>
            <div class="popupInputField popupProductMargin">
                <input type="text" name="email" class="popupInp clickToWhite" 
                       content-type="email" valid="1" errortext="Введите Ваш E-mail, например 'ivan1989@mail.ru'" onkeyup="popupEnter(event, $(this));"
                       {if isset($smarty.session.user)}value="{$smarty.session.user.email}"{/if}/>         
            </div>
            <div class="clr"></div>  
            <div class="popupInputTitle popupProductMargin">
                Телефон<span class="redColor">*</span>
            </div>
            <div class="popupInputField popupProductMargin">
                <input type="text" name="phone" class="popupInp clickToWhite" 
                       content-type="text" valid="1" errortext="Введите Ваш номер телефона, например '+79787771115'" onkeyup="popupEnter(event, $(this));"
                       {if isset($smarty.session.user)}value="{$smarty.session.user.phone}"{/if}/>         
            </div> 
            <div class="popupInputTitle popupProductMargin">
                Город
            </div>
            <div class="popupInputField popupProductMargin">
                <input type="text" name="city" class="popupInp" 
                       content-type="text" onkeyup="popupEnter(event, $(this));"
                       {if isset($smarty.session.user)}value="{$smarty.session.user.city}"{/if}/>         
            </div>  
            <div class="clr"></div>  
            <div class="popupInputTitle popupProductMargin">
                Доставка<span class="redColor">*</span>
            </div>
            <div class="popupInputField popupProductMargin">
                <select name="deliveryType" class="popupInp selectBlock">
                    <option value="samo" selected="selected">Самовывоз</option>
                    <option value="company">Транспортной компанией</option>
                </select>       
            </div>              
            <div class="popupButton popupProductBuyButton" onclick="buyOnClick('{$p.productId}');">Купить</div>            
            <div class="popupproductPrice">{$p.price} руб</div>        
            <div id="product_popup_message"></div>
            <div class="clr"></div>            
        </div>
        <div class="clr"></div>
    </div>  
    <div class="clr"></div>        
</div>
<div class="clr"></div> 