<?php /* Smarty version 2.6.19, created on 2017-03-18 15:53:43
         compiled from guest/inside.tpl */ ?>
<div class="guestCardBlock insideBlockG onlyInsideGuests <?php if ($this->_tpl_vars['gi']['inTable'] != 0): ?>inTableGuestBlock<?php endif; ?>" id="gs_<?php echo $this->_tpl_vars['gi']['guestId']; ?>
">
    <div class="guestPhoto insideBlockP">
        <img src="images/guest/<?php echo $this->_tpl_vars['gi']['guestId']; ?>
/<?php echo $this->_tpl_vars['gi']['imageBig']; ?>
" 
             style="max-width: 360px; max-height: 360px;" 
             onmouseover="" onmouseout="" onclick="guestCardClick(<?php echo $this->_tpl_vars['gi']['guestId']; ?>
);"/>
        <div class="clear"></div>
    </div>
    <div class="guestInsideQuick">
        <input type="checkbox" name="quickSelect" style="cursor: pointer; margin-bottom: 8px;" title="Быстрый выбор" onclick="checkboxClick();" />
        <img src="icon/edit.png" style="cursor: pointer; margin-bottom: 8px;" title="Редактировать" onclick="editGuestQuick('<?php echo $this->_tpl_vars['gi']['guestId']; ?>
');"/>
        <img src="icon/exit.png" style="cursor: pointer; margin-bottom: 8px;" title="Гость ушел" onclick="guestOut('<?php echo $this->_tpl_vars['gi']['guestId']; ?>
');"/>
        <?php if ($this->_tpl_vars['openTableCheck']): ?>
            <?php if ($this->_tpl_vars['gi']['inTable'] == 0): ?>        
                <img src="icon/table.png" class="toTableQuickIcon" style="cursor: pointer;" title="На стол" onclick="toTable('<?php echo $this->_tpl_vars['gi']['guestId']; ?>
');"/>
            <?php else: ?>
                <div class="insideGuestTableNum" title="Гость за столом №<?php echo $this->_tpl_vars['gi']['title']; ?>
"><?php echo $this->_tpl_vars['gi']['title']; ?>
</div>
            <?php endif; ?>
        <?php endif; ?>
        <div class="clear"></div>
    </div>
    <div class="tableChoose"></div>          
    <div class="guestDesc">
        <input type="hidden" name="guestId" value="<?php echo $this->_tpl_vars['gi']['guestId']; ?>
" />
        <?php if (! empty ( $this->_tpl_vars['gi']['remark'] )): ?>
            <div class="guestDescTitle guestRemark" style="color: red;">
                Проблема:
                <img src="icon/active.png" style="cursor: pointer;" title="Устранена" onclick="deleteRemark('<?php echo $this->_tpl_vars['gi']['guestId']; ?>
', 'inside');"/>
                <div class="clear"></div>   
            </div>
            <div class="guestDescInput guestRemark" style="color: red;"><?php echo $this->_tpl_vars['gi']['remark']; ?>
</div>
            <div class="clear"></div>    
        <?php else: ?>
            <div class="guestDescTitle guestTitleRemark">Проблема:</div>
            <div class="guestDescInput guestEditRemark"></div>
            <div class="clear"></div>              
        <?php endif; ?>        
        <div class="guestDescTitle">Карта номер:</div>
        <div class="guestDescInput guestCardNumber"><?php echo $this->_tpl_vars['gi']['cardNumber']; ?>
</div>
        <div class="clear"></div>
        <div class="guestDescTitle">Имя(ФИО):</div>
        <div class="guestDescInput guestName"><?php echo $this->_tpl_vars['gi']['thirdName']; ?>
 <?php echo $this->_tpl_vars['gi']['name']; ?>
 <?php echo $this->_tpl_vars['gi']['secondName']; ?>
</div>
        <div class="clear"></div>
        <div class="guestDescTitle">Дата рождения:</div>
        <div class="guestDescInput guestBirth"><?php echo $this->_tpl_vars['gi']['birthday']; ?>
</div>                
        <div class="clear"></div>
        <div class="guestDescTitle">Телефон:</div>
        <div class="guestDescInput guestPhone"><?php echo $this->_tpl_vars['gi']['phone']; ?>
</div>
        <div class="clear"></div>                
        <div class="guestDescTitle">E-mail:</div>
        <div class="guestDescInput guestEmail"><?php echo $this->_tpl_vars['gi']['email']; ?>
</div>
        <div class="clear"></div>
        <div class="guestDescTitle">Страна:</div>
        <div class="guestDescInput guestCountry"><?php echo $this->_tpl_vars['gi']['country']; ?>
</div>
        <div class="clear"></div>
        <div class="guestDescTitle">Город:</div>
        <div class="guestDescInput guestCity"><?php echo $this->_tpl_vars['gi']['city']; ?>
</div>
        <div class="clear"></div>
        <div class="guestDescTitle">Баллов:</div>
        <div class="guestDescInput"><?php echo $this->_tpl_vars['gi']['points']; ?>
</div>
        <div class="clear"></div>
    </div>    
    <div class="guestSetup">
        <div class="setupButtonActive editButtonActive" onclick="editGuest('<?php echo $this->_tpl_vars['gi']['guestId']; ?>
');">Редактировать</div>
        <div class="clear"></div>
    </div>  
    <div class="guestSetupEdit">
        <div class="setupButtonActive" onclick="saveGuestChanges('<?php echo $this->_tpl_vars['gi']['guestId']; ?>
', $(this));">Сохранить</div>
        <div class="clear"></div>
        <div class="setupButtonCancel" onclick="cancelGuestChanges($(this));">Отменить</div>
        <div class="clear"></div>                 
    </div>                  
    <div class="clear"></div>
</div>