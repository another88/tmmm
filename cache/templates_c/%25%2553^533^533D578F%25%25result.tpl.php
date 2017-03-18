<?php /* Smarty version 2.6.19, created on 2017-03-15 18:51:13
         compiled from guest/result.tpl */ ?>
<h4>Результаты поиска</h4>

<?php if (isset ( $this->_tpl_vars['serror'] )): ?>
    <?php echo $this->_tpl_vars['serror']; ?>

<?php else: ?>
    <?php $_from = $this->_tpl_vars['res']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['gr']):
?>
        <div class="gsrBlock">
            <div class="grImage">
                <img src="images/guest/<?php echo $this->_tpl_vars['gr']['guestId']; ?>
/<?php echo $this->_tpl_vars['gr']['imageBig']; ?>
" />
                <div class="clear"></div>
            </div>
            <div class="grRight">
                <div class="grrTitle">ID:</div>
                <div class="grrInput"><?php echo $this->_tpl_vars['gr']['guestId']; ?>
</div>
                <div class="clear"></div>                
                <div class="grrTitle">Карта номер:</div>
                <div class="grrInput"><?php echo $this->_tpl_vars['gr']['cardNumber']; ?>
</div>
                <div class="clear"></div>
                <div class="grrTitle">Имя:</div>
                <div class="grrInput"><?php echo $this->_tpl_vars['gr']['name']; ?>
 <?php echo $this->_tpl_vars['gr']['secondName']; ?>
 <?php echo $this->_tpl_vars['gr']['thirdName']; ?>
</div>
                <div class="clear"></div>
                <div class="grrTitle">Дата рождения:</div>
                <div class="grrInput"><?php echo $this->_tpl_vars['gr']['birthday']; ?>
</div>                
                <div class="clear"></div>
                <div class="grrTitle">Телефон:</div>
                <div class="grrInput"><?php echo $this->_tpl_vars['gr']['phone']; ?>
</div>
                <div class="clear"></div>                
                <?php if (! empty ( $this->_tpl_vars['gr']['email'] )): ?>
                    <div class="grrTitle">E-mail:</div>
                    <div class="grrInput"><?php echo $this->_tpl_vars['gr']['email']; ?>
</div>
                    <div class="clear"></div>
                <?php endif; ?>
                <div class="grrTitle">Страна:</div>
                <div class="grrInput"><?php echo $this->_tpl_vars['gr']['country']; ?>
</div>
                <div class="clear"></div>
                <div class="grrTitle">Город:</div>
                <div class="grrInput"><?php echo $this->_tpl_vars['gr']['city']; ?>
</div>
                <div class="clear"></div>
                <div class="grrTitle">Баллов:</div>
                <div class="grrInput"><?php echo $this->_tpl_vars['gr']['points']; ?>
</div>
                <div class="clear"></div>
                <a class="guestEnterButton" href="guest/actions/actionName/edit/referer/guest_list/modelName/Guest/id/<?php echo $this->_tpl_vars['gr']['guestId']; ?>
" target="_blank">Редактировать</a>
                <div class="clear"></div>                  
            </div>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    <?php endforeach; endif; unset($_from); ?>
<?php endif; ?>
<div class="clear"></div>