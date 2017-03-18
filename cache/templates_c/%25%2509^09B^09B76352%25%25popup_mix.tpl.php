<?php /* Smarty version 2.6.19, created on 2017-03-18 14:50:11
         compiled from popup_mix.tpl */ ?>
<div id="popup_mix" class="popup">
    <div class="feedbackHeader">
        Добавить свой микс
        <div class="clr"></div>
    </div>
    <div class="clr"></div>
    <div class="popupContent">
        <div class="mixInputTitle marginBottom10">
            Автор
        </div>
        <div class="mixInputField marginBottom10">
            <input type="text" name="phoneNumber" value="" class="phoneNumberClass" />
            <input type="hidden" name="authorId" <?php if (isset ( $_SESSION['user'] )): ?>value="<?php echo $_SESSION['user']['userId']; ?>
"<?php else: ?>value="0"<?php endif; ?>>
            <input type="text" name="author" class="popupInp mixPopupInp"
                   <?php if (isset ( $_SESSION['user'] )): ?>value="<?php echo $_SESSION['user']['firstName']; ?>
 <?php echo $_SESSION['user']['lastName']; ?>
"<?php endif; ?>/>         
        </div>
        <div class="clr"></div>
        <div class="mixInputTitle marginBottom10">
            Что в колбу
        </div>
        <div class="mixRightInputFieldBig marginBottom10">
            <textarea class="commentTextareaMix" name="water"></textarea>       
        </div>
        <div class="clr"></div>
        <div class="mixInputTitle marginBottom10">
            Табак
        </div>
        <div class="mixRightInputFieldBig marginBottom10">
            <select class="mixSelect" onchange="selectTabacCategory($(this).val());">
                <option value="0">Выбирите фирму табака</option>
                <?php $_from = $this->_tpl_vars['tabacCategoryAdd']['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['tc']):
?>
                    <option value="<?php echo $this->_tpl_vars['tc']['tabacCategoryId']; ?>
"><?php echo $this->_tpl_vars['tc']['title']; ?>
</option>
                <?php endforeach; endif; unset($_from); ?>
            </select>      
        </div>
        <div class="clr"></div>  
        <div class="tabacSelected"></div>
        <div class="clr"></div>  
        <div class="tabacList">
            <?php $_from = $this->_tpl_vars['tabacCategoryAdd']['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['tc']):
?>
                <div class="tabacCategoryList" id="tabacCategory_<?php echo $this->_tpl_vars['tc']['tabacCategoryId']; ?>
">
                    <?php $_from = $this->_tpl_vars['tc']['tabac']['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['t']):
?>
                        <div class="tabacBlock" id="tabac_<?php echo $this->_tpl_vars['t']['tabacId']; ?>
_<?php echo $this->_tpl_vars['t']['tabacCategoryId']; ?>
" onclick="selectTabac('<?php echo $this->_tpl_vars['t']['tabacId']; ?>
', '<?php echo $this->_tpl_vars['t']['title']; ?>
', '<?php echo $this->_tpl_vars['t']['tabacCategoryId']; ?>
', '<?php echo $this->_tpl_vars['tc']['title']; ?>
');">
                            <?php echo $this->_tpl_vars['t']['title']; ?>

                        </div>
                    <?php endforeach; endif; unset($_from); ?>  
                    <div class="clr"></div>
                </div>
            <?php endforeach; endif; unset($_from); ?>   
            <div class="clr"></div>
        </div>  
        <div class="clr"></div><br/>
        <div class="mixButton" onclick="saveMix();">Добавить</div>
        <div id="mix_message"></div>   
        <div class="clr"></div>
    </div>
    <div class="clr"></div><br/>   
    <div id="testimonial_message"></div>
    <div class="testimonialPopupButton testimonialDoButton" onclick="testimonialSend();">Отправить</div>
    <div class="clr"></div>
</div>
<div class="clr"></div> 