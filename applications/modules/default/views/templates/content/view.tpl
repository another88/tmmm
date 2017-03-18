{include file='header.tpl'}

{if $content.contentId == '3'}
    <div class="contentInner">
        <div class="contentInnerLeftContact">
            <h1>{$pageTitle}</h1>
            <div class="clr"></div>          
            <div class="contentText">
                {$content.description}
            </div>
            <div class="clr"></div>
        </div>
        <div class="contentInnerRightContact">
            <div class="feedbackBlock" id="feedback">
                <div class="rightTitle">Форма обратной связи</div>
                <div class="clr"></div>
                <div class="feedBackInner">
                    <input type="text" name="phoneNumber" value="" class="phoneNumberClass" />
                    Ваше Имя<span class="redColor">*</span>
                    <div class="clr"></div>
                    <input type="text" name="name" class="feedbackInp" content-type="text" valid="1" 
                           {if isset($smarty.session.user)}value="{$smarty.session.user.firstName} {$smarty.session.user.lastName}"{/if}/>         
                    <div class="clr" style="margin-bottom: 10px;"></div>
                    Ваш E-mail<span class="redColor">*</span>
                    <div class="clr"></div>
                    <input type="text" name="email" class="feedbackInp" content-type="email" valid="1" 
                           {if isset($smarty.session.user)}value="{$smarty.session.user.email}"{/if}/>         
                    <div class="clr" style="margin-bottom: 10px;"></div>            
                    Ваш вопрос<span class="redColor">*</span>
                    <div class="clr"></div>
                    <textarea class="feedbackTextarea" name="comment" content-type="text" valid="1"></textarea>         
                    <div class="clr" style="margin-bottom: 10px;"></div> 
                    <div class="feedbackButton" onclick="addFeedback();">Отправить</div>
                    <div id="feedback_message"></div>
                    <div class="clr"></div>
                </div>
                <div class="clr"></div>
            </div>
            <div class="clr"></div>            
        </div>
        <div class="clr"></div>
    </div>    
{else}
    <div class="contentInner">
        <div class="contentInnerLeft">
            <h1>{$pageTitle}</h1>
            <div class="clr"></div>          
            <div class="contentText">
                {$content.description}
            </div>
            <div class="clr"></div>
        </div>
        <div class="clr"></div>
    </div>     
{/if}

{include file='footer.tpl'}