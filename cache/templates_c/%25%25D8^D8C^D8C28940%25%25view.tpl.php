<?php /* Smarty version 2.6.19, created on 2017-03-17 09:42:50
         compiled from content/view.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php if ($this->_tpl_vars['content']['contentId'] == '3'): ?>
    <div class="contentInner">
        <div class="contentInnerLeftContact">
            <h1><?php echo $this->_tpl_vars['pageTitle']; ?>
</h1>
            <div class="clr"></div>          
            <div class="contentText">
                <?php echo $this->_tpl_vars['content']['description']; ?>

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
                           <?php if (isset ( $_SESSION['user'] )): ?>value="<?php echo $_SESSION['user']['firstName']; ?>
 <?php echo $_SESSION['user']['lastName']; ?>
"<?php endif; ?>/>         
                    <div class="clr" style="margin-bottom: 10px;"></div>
                    Ваш E-mail<span class="redColor">*</span>
                    <div class="clr"></div>
                    <input type="text" name="email" class="feedbackInp" content-type="email" valid="1" 
                           <?php if (isset ( $_SESSION['user'] )): ?>value="<?php echo $_SESSION['user']['email']; ?>
"<?php endif; ?>/>         
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
<?php else: ?>
    <div class="contentInner">
        <div class="contentInnerLeft">
            <h1><?php echo $this->_tpl_vars['pageTitle']; ?>
</h1>
            <div class="clr"></div>          
            <div class="contentText">
                <?php echo $this->_tpl_vars['content']['description']; ?>

            </div>
            <div class="clr"></div>
        </div>
        <div class="clr"></div>
    </div>     
<?php endif; ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>