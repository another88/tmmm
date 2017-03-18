<?php /* Smarty version 2.6.19, created on 2017-03-18 14:21:51
         compiled from guest/resultactive.tpl */ ?>
<h4>Результаты поиска</h4>

<?php if (isset ( $this->_tpl_vars['serror'] )): ?>
    <?php echo $this->_tpl_vars['serror']; ?>

<?php else: ?>
    <?php $_from = $this->_tpl_vars['res']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['iter'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['iter']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['gr']):
        $this->_foreach['iter']['iteration']++;
?>
        <div class="guestCardBlock" id="g_<?php echo $this->_tpl_vars['gr']['guestId']; ?>
">
            <div class="guestPhoto">
                <img src="images/guest/<?php echo $this->_tpl_vars['gr']['guestId']; ?>
/<?php echo $this->_tpl_vars['gr']['imageBig']; ?>
" style="max-width: 360px; max-height: 360px;" 
                     onmouseover="" onmouseout=""/>
                <div class="clear"></div>
            </div>
            <div class="guestDesc">
                <input type="hidden" name="guestId" value="<?php echo $this->_tpl_vars['gr']['guestId']; ?>
" />
         
                <?php if (! empty ( $this->_tpl_vars['gr']['remark'] )): ?>
                    <div class="guestDescTitle guestRemark" style="color: red;">
                        Проблема:
                        <img src="icon/active.png" style="cursor: pointer;" title="Устранена" onclick="deleteRemark('<?php echo $this->_tpl_vars['gr']['guestId']; ?>
', 'search');"/>
                        <div class="clear"></div>   
                    </div>
                    <div class="guestDescInput guestRemark" style="color: red;"><?php echo $this->_tpl_vars['gr']['remark']; ?>
</div>
                    <div class="clear guestRemark"></div>            
                <?php endif; ?>
                
                <div class="guestDescTitle">Карта номер:</div>
                <div class="guestDescInput guestCardNumber"><?php echo $this->_tpl_vars['gr']['cardNumber']; ?>
</div>
                <div class="clear"></div>
                <div class="guestDescTitle">Имя(ФИО):</div>
                <div class="guestDescInput guestName"><?php echo $this->_tpl_vars['gr']['thirdName']; ?>
 <?php echo $this->_tpl_vars['gr']['name']; ?>
 <?php echo $this->_tpl_vars['gr']['secondName']; ?>
</div>
                <div class="clear"></div>
                <div class="guestDescTitle">Дата рождения:</div>
                <div class="guestDescInput guestBirth"><?php echo $this->_tpl_vars['gr']['birthday']; ?>
</div>                
                <div class="clear"></div>
                <div class="guestDescTitle">Телефон:</div>
                <div class="guestDescInput guestPhone"><?php echo $this->_tpl_vars['gr']['phone']; ?>
</div>
                <div class="clear"></div>                
                <div class="guestDescTitle">E-mail:</div>
                <div class="guestDescInput guestEmail"><?php echo $this->_tpl_vars['gr']['email']; ?>
</div>
                <div class="clear"></div>
                <div class="guestDescTitle">Страна:</div>
                <div class="guestDescInput guestCountry"><?php echo $this->_tpl_vars['gr']['country']; ?>
</div>
                <div class="clear"></div>
                <div class="guestDescTitle">Город:</div>
                <div class="guestDescInput guestCity"><?php echo $this->_tpl_vars['gr']['city']; ?>
</div>
                <div class="clear"></div>
                <div class="guestDescTitle">Баллов:</div>
                <div class="guestDescInput"><?php echo $this->_tpl_vars['gr']['points']; ?>
</div>
                <div class="clear"></div>
            </div>    
            <div class="guestSetup">
                <div class="setupButtonActive" onclick="editGuest($(this));">Редактировать</div>
                <div class="clear"></div>
                <div class="setupButtonActive" onclick="findGuestActive();">Добавить баллы</div>
                <div class="clear"></div> 
                <div class="setupButtonActive" onclick="findGuestActive();">Списать баллы</div>
                <div class="clear"></div>   
                <div class="setupButtonActive" onclick="findGuestActive();">История баллов</div>
                <div class="clear"></div>                   
                <div class="setupButtonActive" onclick="guestEnter(<?php echo $this->_tpl_vars['gr']['guestId']; ?>
);">Гость зашел</div>
                <div class="clear"></div>                   
            </div>  
            <div class="guestSetupEdit">
                <div class="setupButtonActive" onclick="saveGuestChanges('<?php echo $this->_tpl_vars['gr']['guestId']; ?>
', $(this));">Сохранить</div>
                <div class="clear"></div>
                <div class="setupButtonCancel" onclick="cancelGuestChanges($(this));">Отменить</div>
                <div class="clear"></div>                 
            </div>                  
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    <?php endforeach; endif; unset($_from); ?>
<?php endif; ?>
<div class="clear"></div>