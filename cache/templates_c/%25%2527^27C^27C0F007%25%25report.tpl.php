<?php /* Smarty version 2.6.19, created on 2017-03-15 22:47:59
         compiled from guest/report.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'guest/header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php echo '
    <script>
        $(document).ready(function() {
            $(\'#yearpicker\').MonthPicker(
                { 
                    MaxMonth: 0,
                    MonthFormat: \'yy-mm\',
                    Button: function() {
                        return $("<button class=\'selectMonthBut\'>Выбери месяц</button>").button();
                    },
                    OnAfterChooseMonth: function() {
                        var selDate = $(\'#yearpicker\').val();
                        location.href=rootPath+\'guest/report/date/\'+selDate; 
                    }                        
                }
            );
        });
    </script>
'; ?>


<input type="text" id="yearpicker" name='date' />
<div class="clear"></div><br/>

<?php if (count ( $this->_tpl_vars['daysList'] ) > 0): ?>
    <table class="tableProductTable">
        <thead>
            <tr>
                <td>
                    Касса,руб
                </td>
                <td>
                    Кальяны,руб
                </td>  
                <td>
                    Бар,руб
                </td>  
                <td>
                    Баллами,руб
                </td>  
                <td>
                    Кальянов,шт
                </td>  
                <td>
                    Столов,шт
                </td>  
                <td>
                    Кальянов&nbsp;в&nbsp;день,шт
                </td>  
                <td>
                    Касса&nbsp;в&nbsp;день,руб
                </td>  
                <td>
                    Средний&nbsp;чек,руб
                </td>                  
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <?php echo $this->_tpl_vars['report']['totalCash']; ?>

                </td>
                <td>
                    <?php echo $this->_tpl_vars['report']['hookahCash']; ?>

                </td>  
                <td>
                    <?php echo $this->_tpl_vars['report']['barCash']; ?>

                </td>  
                <td>
                    <?php echo $this->_tpl_vars['report']['pointSale']; ?>

                </td>  
                <td>
                    <?php echo $this->_tpl_vars['report']['hookahCount']; ?>

                </td>  
                <td>
                    <?php echo $this->_tpl_vars['report']['tableCount']; ?>

                </td>  
                <td>
                    <?php echo $this->_tpl_vars['report']['hookahPerDay']; ?>

                </td>  
                <td>
                    <?php echo $this->_tpl_vars['report']['cashPerDay']; ?>

                </td>  
                <td>
                    <?php echo $this->_tpl_vars['report']['cashPerTable']; ?>

                </td>                  
            </tr>
        </tbody>
    </table>    
    <div class="clear"></div><br/>
    <table class="adminTable">
        <thead>
            <tr>
                <td>ID</td>
                <td>Дата</td>
                <td>Открыт</td>
                <td>Закрыт</td>
                <td>Касса</td>
                <td>Сумма бар</td>
                <td>Сумма кальяны</td>
                <td>Баллами</td>
                <td>Кальянов</td>
                <td width="1%">Дет.</td>
            </tr>
        </thead>
        <tbody>
            <?php $_from = $this->_tpl_vars['daysList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['d']):
?>
                <tr>
                    <td><?php echo $this->_tpl_vars['d']['guestDayId']; ?>
</td>
                    <td><?php echo $this->_tpl_vars['d']['currentDate']; ?>
</td>
                    <td><?php echo $this->_tpl_vars['d']['openDate']; ?>
</td>
                    <td><?php echo $this->_tpl_vars['d']['closeDate']; ?>
</td>
                    <td><?php echo $this->_tpl_vars['d']['totalSum']; ?>
 руб.</td>
                    <td><?php echo $this->_tpl_vars['d']['barSum']; ?>
 руб.</td>
                    <td><?php echo $this->_tpl_vars['d']['hookahSum']; ?>
 руб.</td>
                    <td><?php echo $this->_tpl_vars['d']['pointSale']; ?>
 руб.</td>
                    <td><?php echo $this->_tpl_vars['d']['hookahCount']; ?>
 шт.</td>
                    <td class="icon">
                        <a title="Дет." href="guest/dayreport/id/<?php echo $this->_tpl_vars['d']['guestDayId']; ?>
" target="_blank">
                            <img alt="Дет." src="icon/view.png">
                        </a>
                    </td>                 
                </tr>
            <?php endforeach; endif; unset($_from); ?>
        </tbody>
    </table>
<?php else: ?>
    За этот период нет данных!
<?php endif; ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'guest/footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>