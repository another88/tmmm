<?php /* Smarty version 2.6.19, created on 2017-03-18 15:53:43
         compiled from guest/bday.tpl */ ?>
<div class="guestCardBlock insideBlockG" id="gb_<?php echo $this->_tpl_vars['gi']['guestId']; ?>
">
    <div class="guestPhoto insideBlockP">
        <img src="images/guest/<?php echo $this->_tpl_vars['gi']['guestId']; ?>
/<?php echo $this->_tpl_vars['gi']['imageBig']; ?>
" 
             style="max-width: 360px; max-height: 360px;" 
             onmouseover="" onmouseout="" onclick="guestCardClickBday(<?php echo $this->_tpl_vars['gi']['guestId']; ?>
);"/>
        <div class="clear"></div>
    </div>
    <div class="guestDesc">
        <div class="guestDescTitle">ID:</div>
        <div class="guestDescInput"><?php echo $this->_tpl_vars['gi']['guestId']; ?>
</div>
        <div class="clear"></div>                
        <div class="guestDescTitle">Карта номер:</div>
        <div class="guestDescInput guestCardNumber"><?php echo $this->_tpl_vars['gi']['cardNumber']; ?>
</div>
        <div class="clear"></div>
        <div class="guestDescTitle">Имя:</div>
        <div class="guestDescInput guestName"><?php echo $this->_tpl_vars['gi']['name']; ?>
 <?php echo $this->_tpl_vars['gi']['secondName']; ?>
 <?php echo $this->_tpl_vars['gi']['thirdName']; ?>
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
    <div class="clear"></div>
</div>