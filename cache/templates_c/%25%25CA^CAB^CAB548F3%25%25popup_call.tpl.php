<?php /* Smarty version 2.6.19, created on 2014-10-22 14:18:34
         compiled from popup_call.tpl */ ?>
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
                   <?php if (isset ( $_SESSION['user'] )): ?>value="<?php echo $_SESSION['user']['firstName']; ?>
 <?php echo $_SESSION['user']['lastName']; ?>
"<?php endif; ?>/>         
        </div>
        <div class="clr"></div><br/>          
        <div class="inputTitle">
            Ваш E-mail<span class="redColor">*</span>
        </div>
        <div class="inputField">
            <input type="text" name="email" class="popupInp" 
                   content-type="email" valid="1" onkeyup="popupEnter(event, $(this));"
                   <?php if (isset ( $_SESSION['user'] )): ?>value="<?php echo $_SESSION['user']['email']; ?>
"<?php endif; ?>/>         
        </div>
        <div class="clr"></div><br/>
        <div class="inputTitle">
            Ваш Телефон<span class="redColor">*</span>
        </div>
        <div class="inputField">
            <input type="text" name="phone" class="popupInp" 
                   content-type="text" valid="1" onkeyup="popupEnter(event, $(this));"
                   <?php if (isset ( $_SESSION['user'] )): ?>value="<?php echo $_SESSION['user']['phone']; ?>
"<?php endif; ?>/>         
        </div>
        <div class="clr"></div><br/>        
        <div class="menuItem loginButton popupDoButton" onclick="orderCall();">Заказать</div>
        <div id="callOrder_message"></div>
        <div class="clr"></div>
    </div>  
    <div class="clr"></div>        
</div>
<div class="clr"></div> 