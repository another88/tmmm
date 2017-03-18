{include file='header.tpl'}

<div class="contentInner">
{*    <div class="contentInnerLeft">*}
        <h1>{$pageTitle}</h1>
        <div class="clr"></div>           
        <div class="exslText">
            {$content.description}
            <div class="mixPageTextShare">
                <div class="share42init"
                     data-url="http://ace-hookah.com/exclusive"
                     data-title="{$content.title}"
                     data-description="{$content.description}"
                ></div>        
                {literal}
                    <script type="text/javascript" src="share42/share42.js"></script>
                {/literal}                  
            </div>           
            <div class="clr"></div>             
        </div>        
        <div class="clr"></div>
        {if $exclAdded}
            <div class="exclSucces">Ваш заказ успешно оформлен! Мы с Вами свяжемся. Спасибо!</div>
        {/if}
        <div class="clr"></div>        
        <form id="exclForm" action="exclusive/addexcl" method="post" enctype="multipart/form-data">
            <input type="text" name="phoneNumber" value="" class="phoneNumberClass" />
            <div class="stepOne">
                <div class="stepTitle">шаг 1. личные данные.</div>
                На первом шаге нужно внести личные данные. Это необходимо, чтобы 
                мы могли с Вами связаться для уточнения дизайна.
                <div class="clr"></div><br/>
                <div class="exclInputBlock">
                    <div class="exclInputTitle">
                        Имя<span class="redColor">*</span>
                    </div>
                    <div class="exclInputField">
                        <input type="text" name="firstName" {if isset($smarty.session.user)}value="{$smarty.session.user.firstName}"{/if} class="popupInp" content-type="text" valid="1" />         
                    </div>  
                    <div class="clr"></div>
                </div>
                <div class="exclInputBlock">
                    <div class="exclInputTitle">
                        Фамилия<span class="redColor">*</span>
                    </div>
                    <div class="exclInputField">
                        <input type="text" name="lastName" {if isset($smarty.session.user)}value="{$smarty.session.user.lastName}"{/if} class="popupInp" content-type="text" valid="1" />         
                    </div>  
                    <div class="clr"></div>
                </div>         
                <div class="exclInputBlock">
                    <div class="exclInputTitle">
                        E-mail<span class="redColor">*</span>
                    </div>
                    <div class="exclInputField">
                        <input type="text" name="email" {if isset($smarty.session.user)}value="{$smarty.session.user.email}"{/if} class="popupInp" content-type="email" valid="1" />         
                    </div>  
                    <div class="clr"></div>
                </div>
                <div class="exclInputBlock">
                    <div class="exclInputTitle">
                        Телефон<span class="redColor">*</span>
                    </div>
                    <div class="exclInputField">
                        <input type="text" name="phone" {if isset($smarty.session.user)}value="{$smarty.session.user.phone}"{/if} class="popupInp" content-type="text" valid="1" />         
                    </div>  
                    <div class="clr"></div>
                </div>
                <div class="exclInputBlock">
                    <div class="exclInputTitle">
                        Ссылка vk.com
                    </div>
                    <div class="exclInputField">
                        <input type="text" name="vklink" class="popupInp" />         
                    </div>  
                    <div class="clr"></div>
                </div>         
                <div class="clr"></div>
            </div>
            <div class="clr"></div>
            <div class="stepTwo">
                <div class="stepTitle">шаг 2. тематика.</div>
                На втором шаге нужно максимально подробно объяснить нам
                тематику и стилистику Вашей именной шахты. 
                Ниже Вы можете загрузить фото-эскиз проекта. Например как эти:
                <div class="clr"></div>
                <img class="exclExImg" src="i/exclusive/1.jpg" />
                <img class="exclExImg" src="i/exclusive/2.jpg" />
                <img class="exclExImg" src="i/exclusive/3.jpg" />
                <img class="exclExImg exclExImgLast" src="i/exclusive/4.jpg" />
                <img class="exclExImg" src="i/exclusive/5.jpg" />
                <img class="exclExImg" src="i/exclusive/6.jpg" />  
                <img class="exclExImg" src="i/exclusive/7.jpg" />
                <img class="exclExImg exclExImgLast" src="i/exclusive/8.jpg" />                  
                <div class="clr" style="margin-bottom: 10px;"></div>
                Если пока нет понимания как должна выглядеть Ваша эксклюзивная 
                деревянная шахта, то ничего страшного, мы Вам поможем. 
                Просто оставляйте поля ниже пустыми.
                <div class="clr"></div><br/>
                <div class="exclInputTitle">
                    Описание
                </div>
                <div class="exclInputField exclTextBlock">
                    <textarea class="exclTextarea" name="description"></textarea>
                </div>           
                <div class="clr"></div><br/>  
                <div class="exclInputTitle">
                    Файл
                </div>
                <div class="exclInputField">
                    <input type="file" class="popupInp" name="imageOriginal"  />        
                </div>  
                <div class="exclButton" onclick="exclusiveSend();">Заказать</div> 
                <div id="excl_message"></div>
                <div class="clr"></div>
            </div>
        </form>
        <div class="clr"></div>        
{*    </div>
    <div class="contentInnerRight">
        {include file='right_side.tpl'}
    </div>
    <div class="clr"></div>*}
</div>

{include file='footer.tpl'}