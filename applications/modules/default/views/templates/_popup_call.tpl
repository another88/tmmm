<div id="popup_callOrder" class="popup">
    <div class="feedbackHeader">
        Заказать обратный звонок
        <div class="clr"></div>
    </div>
    <div class="clr"></div>
    <div class="popupContent">
        <div class="inputTitle">
            Ваше Имя<span class="redColor">*</span>
        </div>
        <div class="inputField">
            <input type="text" name="name" class="popupInp" 
                   content-type="text" valid="1" onkeyup="popupEnter(event, $(this));"
                   {if isset($smarty.session.user)}value="{$smarty.session.user.firstName} {$smarty.session.user.lastName}"{/if}/>         
        </div>
        <div class="clr"></div><br/>          
        <div class="inputTitle">
            Ваш E-mail<span class="redColor">*</span>
        </div>
        <div class="inputField">
            <input type="text" name="email" class="popupInp" 
                   content-type="email" valid="1" onkeyup="popupEnter(event, $(this));"
                   {if isset($smarty.session.user)}value="{$smarty.session.user.email}"{/if}/>         
        </div>
        <div class="clr"></div><br/>
        <div class="inputTitle">
            Ваш Телефон<span class="redColor">*</span>
        </div>
        <div class="inputField">
            <input type="text" name="phone" class="popupInp" 
                   content-type="text" valid="1" onkeyup="popupEnter(event, $(this));"
                   {if isset($smarty.session.user)}value="{$smarty.session.user.phone}"{/if}/>         
        </div>
        <div class="clr"></div><br/>        
        <div class="menuItem loginButton popupDoButton" onclick="orderCall();">Заказать</div>
        <div id="callOrder_message"></div>
        <div class="clr"></div>
    </div>  
    <div class="clr"></div>        
</div>
<div class="clr"></div> 