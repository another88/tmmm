<?php /* Smarty version 2.6.19, created on 2017-03-17 09:42:53
         compiled from user/registry.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div class="contentInner">
    <div class="contentInnerLeft">
        <h1><?php echo $this->_tpl_vars['pageTitle']; ?>
</h1>
        <div class="clr"></div>          
        <div class="registryText">
            <input type="text" name="phoneNumber" value="" class="phoneNumberClass" /> 
            Для завершения регистрации, заполните поля ниже Вашими данными.
            <div class="clr"></div>
            Поля, отмеченные <span class="redColor">*</span> обязательны для заполнения.
            <div class="clr"></div><br/>
            <div class="regInputBlock">
                <div class="regInputTitle">
                    Имя<span class="redColor">*</span>
                </div>
                <div class="regInputField">
                    <input type="text" name="firstName" class="popupInp" content-type="text" valid="1" />         
                </div>  
                <div class="clr"></div>
            </div>   
            <div class="regInputBlock">
                <div class="regInputTitle">
                    Фамилия<span class="redColor">*</span>
                </div>
                <div class="regInputField">
                    <input type="text" name="lastName" class="popupInp" content-type="text" valid="1" />         
                </div>  
                <div class="clr"></div>
            </div>            
            <div class="regInputBlock">
                <div class="regInputTitle">
                    Страна<span class="redColor">*</span>
                </div>
                <div class="regInputField">
                    <input type="text" name="country" class="popupInp" content-type="text" valid="1" value="Россия"/>         
                </div>  
                <div class="clr"></div>
            </div>    
            <div class="regInputBlock">
                <div class="regInputTitle">
                    Город<span class="redColor">*</span>
                </div>
                <div class="regInputField">
                    <input type="text" name="city" class="popupInp" content-type="text" valid="1" />         
                </div>  
                <div class="clr"></div>
            </div>            
            <div class="regInputBlock">
                <div class="regInputTitle">
                    Телефон<span class="redColor">*</span>
                </div>
                <div class="regInputField">
                    <input type="text" name="phone" class="popupInp" content-type="text" valid="1" />         
                </div>  
                <div class="clr"></div>
            </div>   
            <div class="regInputBlock">
                <div class="regInputTitle">
                    E-mail<span class="redColor">*</span>
                </div>
                <div class="regInputField">
                    <input type="text" name="email" class="popupInp" content-type="email" valid="1" />         
                </div>  
                <div class="clr"></div>
            </div>            
            <div class="regInputBlock">   
                <div class="regInputTitle" style="padding-top: 0;">
                    Ссылка vk.com
                </div>
                <div class="regInputField">
                    <input type="text" name="vklink" class="popupInp" content-type="text" value="http://vk.com/"  />         
                </div>  
                <div class="clr"></div>
            </div>            
            <div class="regInputBlock">              
                <div class="regInputTitle">
                    Пароль<span class="redColor">*</span>
                </div>
                <div class="regInputField">
                    <input type="text" name="password" class="popupInp" content-type="text" valid="1" />         
                </div>  
                <div class="clr"></div>
            </div>    
            <div class="regInputBlock">   
                <div class="regInputTitle" style="padding-top: 0;">
                    Ещё раз Пароль<span class="redColor">*</span>
                </div>
                <div class="regInputField">
                    <input type="text" name="passwordTwo" class="popupInp" content-type="text" valid="1" />         
                </div>  
                <div class="clr"></div>
            </div>        
            <div class="clr"></div><br/>        
            <div class="registryButton" onclick="registry();">Зарегистрироваться</div>
            <div id="registry_message"></div>
            <div class="clr"></div>   
        </div>
        <div class="clr"></div>   
    </div>
    <div class="clr"></div>
</div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>