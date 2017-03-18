<?php /* Smarty version 2.6.19, created on 2016-03-21 12:08:18
         compiled from order/detail.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<table class="adminTable">
    <tr>
        <td class="title">
            Пользователь ID
        </td>
        <td class="content"><?php echo $this->_tpl_vars['order']['userId']; ?>
</td>
    </tr>    
    <tr>
        <td class="title">
            Имя
        </td>
        <td class="content"><?php echo $this->_tpl_vars['order']['firstName']; ?>
</td>
    </tr>
    <tr>
        <td class="title">
            Фамилия
        </td>
        <td class="content"><?php echo $this->_tpl_vars['order']['lastName']; ?>
</td>
    </tr>
    <tr>
        <td class="title">
            Страна
        </td>
        <td class="content"><?php echo $this->_tpl_vars['order']['country']; ?>
</td>
    </tr>
    <tr>
        <td class="title">
            Город
        </td>
        <td class="content"><?php echo $this->_tpl_vars['order']['city']; ?>
</td>
    </tr>
    <tr>
        <td class="title">
            Телефон
        </td>
        <td class="content"><?php echo $this->_tpl_vars['order']['phone']; ?>
</td>
    </tr>
    <tr>
        <td class="title">
            email
        </td>
        <td class="content"><?php echo $this->_tpl_vars['order']['email']; ?>
</td>
    </tr>
    <tr>
        <td class="title">
            Комментарий
        </td>
        <td class="content"><?php echo $this->_tpl_vars['order']['comment']; ?>
</td>
    </tr>
    <tr>
        <td class="title">
            Дата заказа
        </td>
        <td class="content"><?php echo $this->_tpl_vars['order']['dateAdded']; ?>
</td>
    </tr>
    <tr>
        <td class="title">
            Цена
        </td>
        <td class="content"><?php echo $this->_tpl_vars['order']['price']; ?>
 руб</td>
    </tr>
    <tr>
        <td class="title">
            Скидка
        </td>
        <td class="content"><?php echo $this->_tpl_vars['order']['discount']; ?>
 руб</td>
    </tr>    
    <tr>
        <td class="title">
            Комментарий админа
        </td>
        <td class="content">
            <form id="article" action="admin/order/admincomment/id/<?php echo $this->_tpl_vars['order']['orderId']; ?>
" method="post" enctype="multipart/form-data">
                <textarea name="adminComment"><?php echo $this->_tpl_vars['order']['adminComment']; ?>
</textarea>
                <button type="submit" class="button">Сохранить</button>
            </form>            
        </td>
    </tr>    
</table>
<div class="clear"></div><br/>
<strong>Продукты в заказе</strong>
<div class="clear"></div><br/>
<?php $_from = $this->_tpl_vars['order']['products']['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['op']):
?>
    <?php if ($this->_tpl_vars['op']['productId'] != '0'): ?>
        <div class="orderProductItem">
            <img src="images/product/<?php echo $this->_tpl_vars['op']['productDetails']['productId']; ?>
/<?php echo $this->_tpl_vars['op']['productDetails']['imageMedium']; ?>
" />
            <div class="clear"></div><br/>
            <span class="orderProductItemTitle">ID</span> <?php echo $this->_tpl_vars['op']['productDetails']['productId']; ?>

            <div class="clear"></div>
            <span class="orderProductItemTitle">Название</span> <a href="product/details/id/<?php echo $this->_tpl_vars['op']['productDetails']['productId']; ?>
" target="_blank"><?php echo $this->_tpl_vars['op']['productDetails']['title']; ?>
</a>
            <div class="clear"></div>        
            <span class="orderProductItemTitle">Цена за ед</span> <?php echo $this->_tpl_vars['op']['price']; ?>
 руб
            <div class="clear"></div>
            <span class="orderProductItemTitle">Количество</span> <?php echo $this->_tpl_vars['op']['amount']; ?>

            <div class="clear"></div>
            <span class="orderProductItemTitle">Полная цена</span> <?php echo $this->_tpl_vars['op']['totalPrice']; ?>
 руб
            <div class="clear"></div>        
        </div>
    <?php else: ?>
        <div class="orderProductItem">
            <div class="conLeftPart">
                <div class="conShaxta conElement conMain_shaxta">
                    <?php if (isset ( $this->_tpl_vars['op']['elements']['shaxta'] )): ?>
                        <img src="images/consshaxta/<?php echo $this->_tpl_vars['op']['elements']['shaxta']['consShaxtaId']; ?>
/<?php echo $this->_tpl_vars['op']['elements']['shaxta']['imageSmall']; ?>
" width="79px" />
                    <?php endif; ?>
                </div>
                <div class="clr"></div>
                <div class="conKolba conElement conMain_kolba">
                    <?php if (isset ( $this->_tpl_vars['op']['elements']['kolba'] )): ?>
                        <img src="images/conskolba/<?php echo $this->_tpl_vars['op']['elements']['kolba']['consKolbaId']; ?>
/<?php echo $this->_tpl_vars['op']['elements']['kolba']['imageSmall']; ?>
" width="79px" />
                    <?php endif; ?>                    
                </div>
                <div class="clr"></div>
            </div>
            <div class="consRightPart">
                <div class="conTrybka conElement conMain_trybka">
                    <?php if (isset ( $this->_tpl_vars['op']['elements']['trybka'] )): ?>
                        <img src="images/constrybka/<?php echo $this->_tpl_vars['op']['elements']['trybka']['consTrybkaId']; ?>
/<?php echo $this->_tpl_vars['op']['elements']['trybka']['imageSmall']; ?>
" width="106px" />
                    <?php endif; ?>                       
                </div>
                <div class="clr"></div>                
                <div class="conBowl conElement conMain_bowl">
                    <?php if (isset ( $this->_tpl_vars['op']['elements']['bowl'] )): ?>
                        <img src="images/consbowl/<?php echo $this->_tpl_vars['op']['elements']['bowl']['consBowlId']; ?>
/<?php echo $this->_tpl_vars['op']['elements']['bowl']['imageSmall']; ?>
" width="50px" />
                    <?php endif; ?>                       
                </div>
                <div class="conBludce conElement conMain_bludce">
                    <?php if (isset ( $this->_tpl_vars['op']['elements']['bludce'] )): ?>
                        <img src="images/consbludce/<?php echo $this->_tpl_vars['op']['elements']['bludce']['consBludceId']; ?>
/<?php echo $this->_tpl_vars['op']['elements']['bludce']['imageSmall']; ?>
" width="50px" />
                    <?php endif; ?>                      
                </div>
                <div class="clr"></div>
                <div class="conShipci conElement conMain_shipci">
                    <?php if (isset ( $this->_tpl_vars['op']['elements']['shipci'] )): ?>
                        <img src="images/consshipci/<?php echo $this->_tpl_vars['op']['elements']['shipci']['consShipciId']; ?>
/<?php echo $this->_tpl_vars['op']['elements']['shipci']['imageSmall']; ?>
" width="50px" />
                    <?php endif; ?>                      
                </div>
                <div class="clr"></div>
            </div>   
            <div class="clear"></div>
            <span class="orderProductItemTitle">ID</span> <?php echo $this->_tpl_vars['op']['elementsId']; ?>

            <div class="clear"></div>
            <span class="orderProductItemTitle">Цена за ед</span> <?php echo $this->_tpl_vars['op']['price']; ?>
 руб
            <div class="clear"></div>
            <span class="orderProductItemTitle">Количество</span> <?php echo $this->_tpl_vars['op']['amount']; ?>

            <div class="clear"></div>
            <span class="orderProductItemTitle">Полная цена</span> <?php echo $this->_tpl_vars['op']['totalPrice']; ?>
 руб
            <div class="clear"></div>    
        </div>
    <?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
<div class="clear"></div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>