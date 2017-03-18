<div id="popup_buyOnClick_{$r.productId}" class="popup">
    <div class="feedbackHeader">
        Купить в один клик
        <div class="clr"></div>
    </div>
    <div class="clr"></div>
    <div class="popupContent">
        <input type="hidden" name="productId" value="{$r.productId}" />
        <div class="popupInputTitle">
            Ваше Имя<span class="redColor">*</span>
        </div>
        <div class="popupInputField">
            <input type="text" name="name" class="popupInp" 
                   content-type="text" valid="1" onkeyup="popupEnter(event, $(this));"
                   {if isset($smarty.session.user)}value="{$smarty.session.user.firstName} {$smarty.session.user.lastName}"{/if}/>         
        </div>
        <div class="clr"></div><br/>          
        <div class="popupInputTitle">
            Ваш E-mail<span class="redColor">*</span>
        </div>
        <div class="popupInputField">
            <input type="text" name="email" class="popupInp" 
                   content-type="email" valid="1" onkeyup="popupEnter(event, $(this));"
                   {if isset($smarty.session.user)}value="{$smarty.session.user.email}"{/if}/>         
        </div>
        <div class="clr"></div><br/>
        <div class="popupInputTitle">
            Ваш Телефон<span class="redColor">*</span>
        </div>
        <div class="popupInputField">
            <input type="text" name="phone" class="popupInp" 
                   content-type="text" valid="1" onkeyup="popupEnter(event, $(this));"
                   {if isset($smarty.session.user)}value="{$smarty.session.user.phone}"{/if}/>         
        </div>
        <div class="clr"></div><br/>        
        <div class="popupButton popupDoButton" onclick="buyOnClick('{$r.productId}');">Купить</div>
        <div id="popup_message"></div>
        <div class="clr"></div>
    </div>  
    <div class="clr"></div>        
</div>
<div class="clr"></div> 