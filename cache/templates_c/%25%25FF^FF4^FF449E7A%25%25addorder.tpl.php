<?php /* Smarty version 2.6.19, created on 2016-03-21 12:11:28
         compiled from order/addorder.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<table class="adminTable">   
    <tr>
        <td class="title">
            Имя
        </td>
        <td class="content">
            <input type="text" name="firstName" value="" />
        </td>
    </tr>
    <tr>
        <td class="title">
            Фамилия
        </td>
        <td class="content">
            <input type="text" name="lastName" value="" />
        </td>        
    </tr>
    <tr>
        <td class="title">
            Страна
        </td>
        <td class="content">
            <input type="text" name="country" value="Россия" />
        </td>          
    </tr>
    <tr>
        <td class="title">
            Город
        </td>
        <td class="content">
            <input type="text" name="city" value="" />
        </td>         
    </tr>
    <tr>
        <td class="title">
            Телефон
        </td>
        <td class="content">
            <input type="text" name="phone" value="" />
        </td>             
    </tr>
    <tr>
        <td class="title">
            email
        </td>
        <td class="content">
            <input type="text" name="email" value="" />
        </td>          
    </tr>
    <tr>
        <td class="title">
            Дата заказа
        </td>
        <td class="content">
            <input type="text" name="dateAdded" value="<?php echo $this->_tpl_vars['currentDate']; ?>
" />
        </td>           
    </tr>
    <tr>
        <td class="title">
            Комментарий админа
        </td>
        <td class="content">
            <textarea name="adminComment"></textarea>
        </td>
    </tr>     
    <tr>
        <td class="title">
            Стоимость заказа
        </td>
        <td class="content" id="priceField"><?php echo $_SESSION['adminCartPrice']['orderPrice']; ?>
 руб</td>
    </tr>   
</table>
<div class="clear"></div><br/>
<strong>Продукты в заказе</strong>
<div class="clear"></div>
<div class="productSelect">
    <select name="productId" id="selectProduct">
        <option value="0">Выбери продукт</option>
        <?php $_from = $this->_tpl_vars['products']['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['p']):
?>
            <option value="<?php echo $this->_tpl_vars['p']['productId']; ?>
"><?php echo $this->_tpl_vars['p']['title']; ?>
, <?php echo $this->_tpl_vars['p']['price']; ?>
 руб.</option>
        <?php endforeach; endif; unset($_from); ?>
    </select>
</div>
<div class="productAddButton" onclick="addProductToOrder();">
    Добавить к заказу
</div>
<div class="clear"></div>
<?php $_from = $this->_tpl_vars['adminCart']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['op']):
?>
    <div class="orderProductItem">
        <img src="images/product/<?php echo $this->_tpl_vars['op']['details']['productId']; ?>
/<?php echo $this->_tpl_vars['op']['details']['imageMedium']; ?>
" />
        <div class="clear"></div><br/>
        <span class="orderProductItemTitle">ID</span> <?php echo $this->_tpl_vars['op']['details']['productId']; ?>

        <div class="clear"></div>
        <span class="orderProductItemTitle">Название</span> <a href="product/details/id/<?php echo $this->_tpl_vars['op']['details']['productId']; ?>
" target="_blank"><?php echo $this->_tpl_vars['op']['details']['title']; ?>
</a>
        <div class="clear"></div>        
        <span class="orderProductItemTitle">Цена за ед</span> <?php echo $this->_tpl_vars['op']['details']['price']; ?>
 руб
        <div class="clear"></div>
        <span class="orderProductItemTitle">Количество</span> <?php echo $this->_tpl_vars['op']['amount']; ?>

        <div class="clear"></div>
        <span class="orderProductItemTitle">Полная цена</span> <?php echo $this->_tpl_vars['op']['allPrice']; ?>
 руб
        <div class="clear"></div>        
    </div>
<?php endforeach; endif; unset($_from); ?>
<div class="clear"></div>
<div class="productAddButton" onclick="addAdminOrder();">
    Оформить заказ
</div>
<div class="clear"></div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>