<?php /* Smarty version 2.6.19, created on 2017-03-18 15:55:26
         compiled from popup_login.tpl */ ?>
<div id="popup_login" class="popup">
    <div class="feedbackHeader">
        Вход на сайт
        <div class="clr"></div>
    </div>
    <div class="clr"></div>
    <div class="popupContent">
        <div class="popupInputTitle">
            Ваш E-mail<span class="redColor">*</span>
        </div>
        <div class="popupInputField">
            <input type="text" name="email" class="popupInp" content-type="email" valid="1" onkeyup="popupEnter(event, $(this));"/>         
        </div>
        <div class="clr"></div><br/>
        <div class="popupInputTitle">
            Ваш Пароль<span class="redColor">*</span>
        </div>
        <div class="popupInputField">
            <input type="password" name="password" class="popupInp" content-type="text" valid="1" onkeyup="popupEnter(event, $(this));"/>         
        </div>
        <div class="clr"></div><br/>
        <div class="popupInputTitle">&nbsp;</div>
        <div class="popupInputField">
            <input id="check2" type="checkbox" name="rememberme" /> 
            <label for="check2">Запомнить меня</>
        </div>
        <div class="clr"></div><br/>        
        <div class="popupButton popupDoButton" onclick="login();">Войти</div>
        <div id="login_message"></div>
        <div class="clr"></div>
    </div>  
    <div class="clr"></div>        
</div>
<div class="clr"></div> 