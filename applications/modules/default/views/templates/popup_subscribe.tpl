<div id="popup_subscribe" class="popup">
    <div class="feedbackHeader"></div>
    <div class="clr"></div>
    <div class="popupContent" id="subsForm">
        <input type="hidden" name="subsType" value="" /> 
        <input type="text" name="phoneNumber" value="" class="phoneNumberClass" /> 
        <div class="subsInputTitle">
            Имя<span class="redColor">*</span>
        </div>
        <div class="popupInputField">
            <input type="text" name="name" {if isset($smarty.session.user)}value="{$smarty.session.user.firstName}"{/if} 
                   class="popupInp clickToWhite"  errortext="Введите Ваше Имя, например 'Иван'"
                   content-type="text" valid="1"/>         
        </div>
        <div class="clr"></div><br/>
        <div class="subsInputTitle">
            E-mail<span class="redColor">*</span>
        </div>
        <div class="popupInputField">
            <input type="text" name="email" {if isset($smarty.session.user)}value="{$smarty.session.user.email}"{/if} 
                   class="popupInp clickToWhite" errortext="Введите Ваш E-mail, например 'ivan1989@mail.ru'"
                   content-type="email" valid="1"/>         
        </div>
        <div class="clr"></div><br/>   
        <div id="subs_message"></div>
        <div class="subsPopupButton subsDoButton" onclick="subsSend();"></div>
        <div class="clr"></div>
    </div>  
    <div class="clr"></div>        
</div>
<div class="clr"></div> 