<?php /* Smarty version 2.6.19, created on 2017-03-18 15:55:26
         compiled from on_click.tpl */ ?>
<div id="popup_buyOnClick_<?php echo $this->_tpl_vars['p']['productId']; ?>
" class="popup">
    <div class="feedbackHeader">
        Купить в один клик
        <div class="clr"></div>
    </div>
    <div class="clr"></div>
    <div class="popupContent">
        <input type="text" name="phoneNumber" value="" class="phoneNumberClass" /> 
        <input type="hidden" name="productId" value="<?php echo $this->_tpl_vars['p']['productId']; ?>
" />
        <div class="popupproductPageImage">
            <img src="images/product/<?php echo $this->_tpl_vars['p']['productId']; ?>
/<?php echo $this->_tpl_vars['p']['imageBig']; ?>
" />
            <div class="clr"></div>
        </div>
        <div class="popupproductPageText">
            <div class="popupProductTitle"><?php echo $this->_tpl_vars['p']['title']; ?>
</div>
            <div class="clr"></div><br/>
            <?php echo $this->_tpl_vars['p']['description']; ?>

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
                       <?php if (isset ( $_SESSION['user'] )): ?>value="<?php echo $_SESSION['user']['firstName']; ?>
 <?php echo $_SESSION['user']['lastName']; ?>
"<?php endif; ?>/>         
            </div>
            <div class="popupInputTitle popupProductMargin">
                E-mail<span class="redColor">*</span>
            </div>
            <div class="popupInputField popupProductMargin">
                <input type="text" name="email" class="popupInp clickToWhite" 
                       content-type="email" valid="1" errortext="Введите Ваш E-mail, например 'ivan1989@mail.ru'" onkeyup="popupEnter(event, $(this));"
                       <?php if (isset ( $_SESSION['user'] )): ?>value="<?php echo $_SESSION['user']['email']; ?>
"<?php endif; ?>/>         
            </div>
            <div class="clr"></div>  
            <div class="popupInputTitle popupProductMargin">
                Телефон<span class="redColor">*</span>
            </div>
            <div class="popupInputField popupProductMargin">
                <input type="text" name="phone" class="popupInp clickToWhite" 
                       content-type="text" valid="1" errortext="Введите Ваш номер телефона, например '+79787771115'" onkeyup="popupEnter(event, $(this));"
                       <?php if (isset ( $_SESSION['user'] )): ?>value="<?php echo $_SESSION['user']['phone']; ?>
"<?php endif; ?>/>         
            </div> 
            <div class="popupInputTitle popupProductMargin">
                Город
            </div>
            <div class="popupInputField popupProductMargin">
                <input type="text" name="city" class="popupInp" 
                       content-type="text" onkeyup="popupEnter(event, $(this));"
                       <?php if (isset ( $_SESSION['user'] )): ?>value="<?php echo $_SESSION['user']['city']; ?>
"<?php endif; ?>/>         
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
            <div class="popupButton popupProductBuyButton" onclick="buyOnClick('<?php echo $this->_tpl_vars['p']['productId']; ?>
');">Купить</div>            
            <div class="popupproductPrice"><?php echo $this->_tpl_vars['p']['price']; ?>
 руб</div>        
            <div id="product_popup_message"></div>
            <div class="clr"></div>            
        </div>
        <div class="clr"></div>
    </div>  
    <div class="clr"></div>        
</div>
<div class="clr"></div> 