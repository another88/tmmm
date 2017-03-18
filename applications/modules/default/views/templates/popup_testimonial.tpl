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
                <input type="text" name="firstName" {if isset($smarty.session.user)}value="{$smarty.session.user.firstName}"{/if} 
                       class="popupInp clickToWhite"  errortext="Введите Ваше Имя, например 'Иван'"
                       content-type="text" valid="1" onkeyup="popupEnterTestimonial(event, $(this));"/>         
            </div>
            <div class="popupInputTitle">
                Фамилия<span class="redColor">*</span>
            </div>
            <div class="popupInputField">
                <input type="text" name="lastName" {if isset($smarty.session.user)}value="{$smarty.session.user.lastName}"{/if} 
                       class="popupInp clickToWhite" errortext="Введите Вашу Фамилию, например 'Иванов'"
                       content-type="text" valid="1" onkeyup="popupEnterTestimonial(event, $(this));"/>         
            </div>
            <div class="clr"></div><br/>        
            <div class="popupInputTitle">
                E-mail<span class="redColor">*</span>
            </div>
            <div class="popupInputField">
                <input type="text" name="email" {if isset($smarty.session.user)}value="{$smarty.session.user.email}"{/if} 
                       class="popupInp clickToWhite" errortext="Введите Ваш E-mail, например 'ivan1989@mail.ru'"
                       content-type="email" valid="1" onkeyup="popupEnterTestimonial(event, $(this));"/>         
            </div>
            <div class="popupInputTitle">
                Ссылка vk.com
            </div>
            <div class="popupInputField">
                <input type="text" name="vklink" {if isset($smarty.session.user)}value="{$smarty.session.user.vklink}"{else} 
                       value="http://vk.com/"{/if} class="popupInp" content-type="email" 
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