<?php /* Smarty version 2.6.19, created on 2017-03-18 15:55:26
         compiled from popup_subscribe.tpl */ ?>
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
            <input type="text" name="name" <?php if (isset ( $_SESSION['user'] )): ?>value="<?php echo $_SESSION['user']['firstName']; ?>
"<?php endif; ?> 
                   class="popupInp clickToWhite"  errortext="Введите Ваше Имя, например 'Иван'"
                   content-type="text" valid="1"/>         
        </div>
        <div class="clr"></div><br/>
        <div class="subsInputTitle">
            E-mail<span class="redColor">*</span>
        </div>
        <div class="popupInputField">
            <input type="text" name="email" <?php if (isset ( $_SESSION['user'] )): ?>value="<?php echo $_SESSION['user']['email']; ?>
"<?php endif; ?> 
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