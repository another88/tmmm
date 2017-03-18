<?php /* Smarty version 2.6.19, created on 2017-03-18 15:53:43
         compiled from guest/index.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'guest/header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php if ($this->_tpl_vars['isWork']['value'] == '1'): ?>
    <h3>Открытые столы</h3>
    <div class="findBlock">
        <div class="opensTable">
            <div class="findButtonActive" onclick="newTable();">Новый стол</div>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
        <div class="opensTableOnline">
            <?php $_from = $this->_tpl_vars['openTableList']['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['to']):
?>
                <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'guest/opentable.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
            <?php endforeach; endif; unset($_from); ?>        
        </div>
        <div class="clear"></div>    
    </div>
    <div class="clear"></div>

    <h3>Гости внутри</h3>
    <div class="findBlock">
        <div class="guestInside">
            <div class="findMButton" 
                 onclick="showQuickAdd();">
                Быстрое добавление члена клуба
            </div>  
            <div class="forCheckboxBlock">
                <div class="findMButton afterChekbox toTableAllBlock" 
                     onclick="toTableAll();">
                    На стол
                </div>  
                <div class="findMButton afterChekbox" 
                     onclick="guestsOut();">
                    Гости ушли
                </div>    
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
            <div class="quickAddGuest">
                <form method="post" action="guest/quickadd" enctype="multipart/form-data">
                    Номер карточки: <input name="cardNumber" type="text" />
                    Фото: <input name="imageOriginal" type="file" />
                    <input type="button" value="Добавить" class="button-primary" onclick="quickAdd();"/>
                </form>
                <div class="clear"></div>
            </div>
            <div class="clear"></div><br/>
            <?php $_from = $this->_tpl_vars['guestInsideList']['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['gi']):
?>
                <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'guest/inside.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
            <?php endforeach; endif; unset($_from); ?>
        </div>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>

    <?php if (count ( $this->_tpl_vars['guestBdayList'] ) > 0): ?>
        <h3>Сегодня день рождения</h3>
        <div class="findBlock">
            <div class="guestInsideBD">
                <?php $_from = $this->_tpl_vars['guestBdayList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['gi']):
?>
                    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'guest/bday.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                <?php endforeach; endif; unset($_from); ?>
            </div>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>        
    <?php endif; ?>
    
    <h3>Поиск члена клуба</h3>
    <div class="findBlock">
        <div class="findTitleActive">Вводи номер карты, номер телефона, имя, отчество или фамилию:</div>
        <div class="findInputActive">
            <input type="text" name="searchField" value="" 
                   class="searchInput" onkeyup="popupEnterAdmin(event, $(this));"/>
        </div>
        <div class="findButtonActive" onclick="findGuestActive();">Искать</div>
        <div class="clear"></div>
        <div class="guestSearchRes"></div>
        <div class="clear"></div>
    </div>

    <div class="clear"></div>
<?php endif; ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'guest/footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>