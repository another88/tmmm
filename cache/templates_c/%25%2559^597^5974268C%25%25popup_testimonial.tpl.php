<?php /* Smarty version 2.6.19, created on 2017-03-18 11:37:13
         compiled from popup_testimonial.tpl */ ?>
<div id="popup_testimonial" class="popup">
    <div class="feedbackHeader">
        Оставить отзыв
        <div class="clr"></div>
    </div>
    <div class="clr"></div>
    <div class="popupContent">
        <form id="testimonialForm" action="testimonial/addtestimonial" method="post" enctype="multipart/form-data">
            <input type="text" name="phoneNumber" value="" class="phoneNumberClass" />
            <div class="popupInputTitle">
                Имя<span class="redColor">*</span>
            </div>
            <div class="popupInputField">
                <input type="text" name="firstName" <?php if (isset ( $_SESSION['user'] )): ?>value="<?php echo $_SESSION['user']['firstName']; ?>
"<?php endif; ?> 
                       class="popupInp clickToWhite"  errortext="Введите Ваше Имя, например 'Иван'"
                       content-type="text" valid="1" onkeyup="popupEnterTestimonial(event, $(this));"/>         
            </div>
            <div class="popupInputTitle">
                Фамилия<span class="redColor">*</span>
            </div>
            <div class="popupInputField">
                <input type="text" name="lastName" <?php if (isset ( $_SESSION['user'] )): ?>value="<?php echo $_SESSION['user']['lastName']; ?>
"<?php endif; ?> 
                       class="popupInp clickToWhite" errortext="Введите Вашу Фамилию, например 'Иванов'"
                       content-type="text" valid="1" onkeyup="popupEnterTestimonial(event, $(this));"/>         
            </div>
            <div class="clr"></div><br/>        
            <div class="popupInputTitle">
                E-mail<span class="redColor">*</span>
            </div>
            <div class="popupInputField">
                <input type="text" name="email" <?php if (isset ( $_SESSION['user'] )): ?>value="<?php echo $_SESSION['user']['email']; ?>
"<?php endif; ?> 
                       class="popupInp clickToWhite" errortext="Введите Ваш E-mail, например 'ivan1989@mail.ru'"
                       content-type="email" valid="1" onkeyup="popupEnterTestimonial(event, $(this));"/>         
            </div>
            <div class="popupInputTitle">
                Ссылка vk.com
            </div>
            <div class="popupInputField">
                <input type="text" name="vklink" <?php if (isset ( $_SESSION['user'] )): ?>value="<?php echo $_SESSION['user']['vklink']; ?>
"<?php else: ?> 
                       value="http://vk.com/"<?php endif; ?> class="popupInp" content-type="email" 
                       onkeyup="popupEnterTestimonial(event, $(this));"/>         
            </div>
            <div class="clr"></div><br/>  
            <div class="popupInputTitle">
                Фото
            </div>
            <div class="popupInputField">
                <input type="file" class="popupInp" name="imageOriginal" value="" />        
            </div>        
            <div class="clr"></div><br/>
            <div class="popupInputTitle">
                Отзыв<span class="redColor">*</span>
            </div>
            <div class="popupInputField commentTextBlock">
                <textarea class="testimonialTextarea clickToWhite" name="comment" 
                          content-type="text" valid="1" errortext="Введите Ваш Отзыв"></textarea>
            </div>
        </form>
        <div class="clr"></div><br/>   
        <div id="testimonial_message"></div>
        <div class="testimonialPopupButton testimonialDoButton" onclick="testimonialSend();">Отправить</div>
        <div class="clr"></div>
    </div>  
    <div class="clr"></div>        
</div>
<div class="clr"></div> 