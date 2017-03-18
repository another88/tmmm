<?php /* Smarty version 2.6.19, created on 2017-03-18 09:42:30
         compiled from exclusive/index.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div class="contentInner">
        <h1><?php echo $this->_tpl_vars['pageTitle']; ?>
</h1>
        <div class="clr"></div>           
        <div class="exslText">
            <?php echo $this->_tpl_vars['content']['description']; ?>

            <div class="mixPageTextShare">
                <div class="share42init"
                     data-url="http://ace-hookah.com/exclusive"
                     data-title="<?php echo $this->_tpl_vars['content']['title']; ?>
"
                     data-description="<?php echo $this->_tpl_vars['content']['description']; ?>
"
                ></div>        
                <?php echo '
                    <script type="text/javascript" src="share42/share42.js"></script>
                '; ?>
                  
            </div>           
            <div class="clr"></div>             
        </div>        
        <div class="clr"></div>
        <?php if ($this->_tpl_vars['exclAdded']): ?>
            <div class="exclSucces">Ваш заказ успешно оформлен! Мы с Вами свяжемся. Спасибо!</div>
        <?php endif; ?>
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
                        <input type="text" name="firstName" <?php if (isset ( $_SESSION['user'] )): ?>value="<?php echo $_SESSION['user']['firstName']; ?>
"<?php endif; ?> class="popupInp" content-type="text" valid="1" />         
                    </div>  
                    <div class="clr"></div>
                </div>
                <div class="exclInputBlock">
                    <div class="exclInputTitle">
                        Фамилия<span class="redColor">*</span>
                    </div>
                    <div class="exclInputField">
                        <input type="text" name="lastName" <?php if (isset ( $_SESSION['user'] )): ?>value="<?php echo $_SESSION['user']['lastName']; ?>
"<?php endif; ?> class="popupInp" content-type="text" valid="1" />         
                    </div>  
                    <div class="clr"></div>
                </div>         
                <div class="exclInputBlock">
                    <div class="exclInputTitle">
                        E-mail<span class="redColor">*</span>
                    </div>
                    <div class="exclInputField">
                        <input type="text" name="email" <?php if (isset ( $_SESSION['user'] )): ?>value="<?php echo $_SESSION['user']['email']; ?>
"<?php endif; ?> class="popupInp" content-type="email" valid="1" />         
                    </div>  
                    <div class="clr"></div>
                </div>
                <div class="exclInputBlock">
                    <div class="exclInputTitle">
                        Телефон<span class="redColor">*</span>
                    </div>
                    <div class="exclInputField">
                        <input type="text" name="phone" <?php if (isset ( $_SESSION['user'] )): ?>value="<?php echo $_SESSION['user']['phone']; ?>
"<?php endif; ?> class="popupInp" content-type="text" valid="1" />         
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
</div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>