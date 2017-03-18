<?php /* Smarty version 2.6.19, created on 2017-03-18 01:19:53
         compiled from guest/list.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'guest/header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<h3>Поиск члена клуба</h3>
<div class="findBlock">
    <div class="findItem">
        <div class="findMTitle">По номеру карты</div>
        <div class="findMInput"><input type="text" name="cardNumber" value="" class="guestFilter" /></div>
        <div class="findMButton" onclick="findGuest('cardNumber');">Искать</div>
        <div class="clear"></div>
    </div>
    <div class="findItem">
        <div class="findMTitle">По фамилии</div>
        <div class="findMInput"><input type="text" name="thirdName" value="" class="guestFilter" /></div>
        <div class="findMButton" onclick="findGuest('thirdName');">Искать</div>
        <div class="clear"></div>
    </div>
    <div class="findItem">
        <div class="findMTitle">По телефону</div>
        <div class="findMInput"><input type="text" name="phone" value="" class="guestFilter" /></div>
        <div class="findMButton" onclick="findGuest('phone');">Искать</div>
        <div class="clear"></div> 
    </div>
    <div class="clear"></div> 
    <div class="guestSearchRes"></div>
    <div class="clear"></div>
</div>

<table class="adminTable">
    <thead>
        <tr>
            <td colspan="3">
                <div class="findMButton" 
                     onclick="location.href=rootPath+'guest/actions/actionName/edit/referer/guest_list/modelName/Guest/';">
                    Добавить члена клуба
                </div>
            </td>
            <td colspan="2">
                Всего членов клуба: <?php echo $this->_tpl_vars['guestList']['total']; ?>

            </td>   
            <td colspan="6">
                <div <?php if ($this->_tpl_vars['sort'] == ''): ?>class="findMButton activeSortButton"<?php else: ?>class="findMButton"<?php endif; ?> style="margin-right: 10px;"
                     onclick="location.href=rootPath+'guest/list/';">
                    По фамилии(От А)
                </div>
                <div <?php if ($this->_tpl_vars['sort'] == 'id'): ?>class="findMButton activeSortButton"<?php else: ?>class="findMButton"<?php endif; ?> style="margin-right: 10px;"
                     onclick="location.href=rootPath+'guest/list/sort/id';">
                    По дате(От последних)
                </div>
                <div <?php if ($this->_tpl_vars['sort'] == 'empty'): ?>class="findMButton activeSortButton"<?php else: ?>class="findMButton"<?php endif; ?> 
                     onclick="location.href=rootPath+'guest/list/sort/empty';">
                    Не заполненные
                </div>                     
            </td>               
        </tr>       
    </thead>
    <thead>
        <tr>
            <td>ID</td>
            <td>№Карты</td>
            <td>ФИО</td>
            <td>Дата рожд.</td>
            <td>Телефон</td>
            <td>E-mail</td>
            <td>Страна</td>
            <td>Город</td>
            <td>Баллов</td>
            <td>Фото</td>
            <td width="1%">Ред.</td>
        </tr>
    </thead>
    <tbody>
        <?php $_from = $this->_tpl_vars['guestList']['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['g']):
?>
            <tr>
                <td><?php echo $this->_tpl_vars['g']['guestId']; ?>
</td>
                <td><?php echo $this->_tpl_vars['g']['cardNumber']; ?>
</td>
                <td><?php echo $this->_tpl_vars['g']['thirdName']; ?>
 <?php echo $this->_tpl_vars['g']['name']; ?>
 <?php echo $this->_tpl_vars['g']['secondName']; ?>
</td>
                <td><?php echo $this->_tpl_vars['g']['birthday']; ?>
</td>
                <td><?php echo $this->_tpl_vars['g']['phone']; ?>
</td>
                <td><?php echo $this->_tpl_vars['g']['email']; ?>
</td>
                <td><?php echo $this->_tpl_vars['g']['country']; ?>
</td>
                <td><?php echo $this->_tpl_vars['g']['city']; ?>
</td>
                <td><?php echo $this->_tpl_vars['g']['points']; ?>
</td>
                <td><img src="images/guest/<?php echo $this->_tpl_vars['g']['guestId']; ?>
/<?php echo $this->_tpl_vars['g']['imageSmall']; ?>
" /></td>
                <td class="icon">
                    <a title="Ред." href="guest/actions/actionName/edit/referer/guest_list/modelName/Guest/id/<?php echo $this->_tpl_vars['g']['guestId']; ?>
">
                        <img alt="Ред." src="icon/edit.png">
                    </a>
                </td> 
               
            </tr>
        <?php endforeach; endif; unset($_from); ?>
        <tr>
            <td colspan="13"><?php echo $this->_tpl_vars['paging']; ?>
</td>
        </tr>
    </tbody>
</table>



<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'guest/footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>