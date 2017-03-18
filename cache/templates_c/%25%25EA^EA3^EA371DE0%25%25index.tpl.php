<?php /* Smarty version 2.6.19, created on 2017-03-06 00:16:38
         compiled from checkout/index.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<script type="text/javascript">
    var constructorIsset = '<?php echo $this->_tpl_vars['constructorIsset']; ?>
';
</script>   

<div class="contentInner">
    <div class="contentInnerLeft">
        <h1><?php echo $this->_tpl_vars['pageTitle']; ?>
</h1>
        <div class="clr"></div>            
        <?php if (isset ( $this->_tpl_vars['cart'] ) && count ( $this->_tpl_vars['cart'] ) > 0): ?>
            <table class="checkoutTable">
                <thead>
                    <tr>
                        <td>
                            Картинка
                        </td>
                        <td>
                            Название
                        </td> 
                        <td>
                            Цена
                        </td>
                        <td>
                            Количество
                        </td>     
                        <td>
                            Стоимость позиции
                        </td> 
                        <td>
                            Удалить
                        </td>                         
                    </tr>
                </thead>
                <tbody>
                    <?php $_from = $this->_tpl_vars['cart']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['c']):
?>
                        <tr>
                            <td width="10%">
                                <?php if (! empty ( $this->_tpl_vars['c']['details']['imageSmall'] )): ?>
                                    <img src="images/product/<?php echo $this->_tpl_vars['c']['details']['productId']; ?>
/<?php echo $this->_tpl_vars['c']['details']['imageSmall']; ?>
" />
                                <?php else: ?>
                                                                    <?php endif; ?>                                
                            </td>
                            <td width="55%" style="text-align: left;">
                                <?php if (! isset ( $this->_tpl_vars['c']['elements'] )): ?>
                                    <a href="product/<?php echo $this->_tpl_vars['c']['details']['url']; ?>
.html" target="_blank"><?php echo $this->_tpl_vars['c']['details']['title']; ?>
</a>
                                <?php else: ?>
                                    <input type="hidden" name="jsonData_<?php echo $this->_tpl_vars['c']['uniKey']; ?>
" id="<?php echo $this->_tpl_vars['c']['uniKey']; ?>
" class="cartJsonInput" value='<?php echo $this->_tpl_vars['c']['elementsJSON']; ?>
' />
                                    <div id="consPreviewBlock_<?php echo $this->_tpl_vars['c']['uniKey']; ?>
"></div>
                                <?php endif; ?>                                
                            </td> 
                            <td width="10%">
                                <?php echo $this->_tpl_vars['c']['details']['price']; ?>
 рублей
                            </td>
                            <td width="11%">
                                <div class="amountBlockCheckout">
                                    <input type="text" value="<?php echo $this->_tpl_vars['c']['amount']; ?>
" name="amount" onblur="changeAmountBlur($(this), true);" />
                                    <input type="hidden" value="<?php echo $this->_tpl_vars['c']['uniKey']; ?>
" name="uniKey" />
                                    <div class="amountChangeCheckout">
                                        <div class="amountUpCheckout" title="Больше" onclick="changeAmount('up', $(this), true);"></div>
                                        <div class="clr"></div> 
                                        <div class="amountDownCheckout" title="Меньше" onclick="changeAmount('down', $(this), true);"></div>
                                        <div class="clr"></div> 
                                    </div>
                                    <div class="clr"></div> 
                                </div>
                            </td>     
                            <td width="9%">
                                <?php echo $this->_tpl_vars['c']['allPrice']; ?>
 рублей
                            </td> 
                            <td width="5%">
                                <img src="icon/delete.png" class="cursotPointer" onclick="deleteFromCart('<?php echo $this->_tpl_vars['c']['uniKey']; ?>
', false);"/>
                            </td>                         
                        </tr>    
                    <?php endforeach; endif; unset($_from); ?>
                </tbody>
            </table>
            <div class="clr"></div>
            <div class="checkoutPriceBlock">
                <?php if ($_SESSION['cartPrice']['discount']): ?>
                     <div class="checkoutPriceBlockItem">
                         <div class="checkoutPriceBlockItemTitle">
                             Стоимость без скидки:
                         </div>
                         <div class="checkoutPriceBlockItemValue">
                             <?php echo $_SESSION['cartPrice']['totalProductsPrice']; ?>
 руб
                         </div>                    
                         <div class="clr"></div>
                     </div>
                     <div class="clr"></div>
                     <div class="checkoutPriceBlockItem">
                         <div class="checkoutPriceBlockItemTitle">
                             Скидка:
                         </div>
                         <div class="checkoutPriceBlockItemValue">
                             <?php echo $_SESSION['cartPrice']['discount']; ?>
 руб
                         </div>                    
                         <div class="clr"></div>
                     </div>
                     <div class="clr"></div>  
                 <?php endif; ?>                
                <div class="checkoutPriceBlockItem">
                    <div class="checkoutPriceBlockItemTitle">
                        Стоимость заказа:
                    </div>
                    <div class="checkoutPriceBlockItemValue">
                        <?php echo $_SESSION['cartPrice']['orderPrice']; ?>
 руб
                    </div>                    
                    <div class="clr"></div>
                </div>
                <div class="clr"></div>
                <div class="toOrderButton" onclick="scrollTo('orderForm');">К оформлению заказа</div>
                <div class="clr"></div>
            </div>
            <div class="clr"></div>
            <?php if (count ( $this->_tpl_vars['productLike']['data'] ) > 0): ?>
                <div class="likeProductBlock">
                    <div class="likeProductTitle">С этими товарами часто покупают</div>
                    <?php $_from = $this->_tpl_vars['productLike']['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['iter'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['iter']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['p']):
        $this->_foreach['iter']['iteration']++;
?>
                        <div id="productBlock_<?php echo $this->_tpl_vars['p']['productId']; ?>
" <?php if (!($this->_foreach['iter']['iteration'] % 3)): ?>class="productBlockMainLast"<?php else: ?>class="productBlockMain"<?php endif; ?>>
                            <div class="mainProductImage" 
                                 style="background:transparent url('images/product/<?php echo $this->_tpl_vars['p']['productId']; ?>
/<?php echo $this->_tpl_vars['p']['imageBig']; ?>
') no-repeat 0 0;"
                                 onclick="redirect('product/<?php echo $this->_tpl_vars['p']['url']; ?>
.html');">
                                <div class="priceAngle">
                                    <span class="anglePriceVal"><?php echo $this->_tpl_vars['p']['price']; ?>
</span><br/>рублей
                                </div>
                                <div class="clr"></div>
                                <div class="mainProductTitle"><a href="product/<?php echo $this->_tpl_vars['p']['url']; ?>
.html"><?php echo $this->_tpl_vars['p']['title']; ?>
</a></div>
                                <div class="clr"></div>
                            </div>
                            <div class="clr"></div>
                            <div class="mainProductBuy analiticsToCartButton" onclick="toCart('<?php echo $this->_tpl_vars['p']['productId']; ?>
', false);">Добавить к заказу</div>
                            <div class="clr"></div>
                        </div>
                    <?php endforeach; endif; unset($_from); ?> 
                    <div class="clr"></div>
                </div>
                <div class="clr"></div>
            <?php endif; ?>
            <div class="orderFormTitle" id="orderForm">оформление заказа</div>
            <div class="clr"></div>
            <div class="orderForm">
                <input type="text" name="phoneNumber" value="" class="phoneNumberClass" /> 
                Для заказа, заполните поля ниже Вашими данными.
                Поля, отмеченные <span class="redColor">*</span> обязательны для заполнения.
                <div class="clr"></div><br/>
                <div class="checkoutInputTitle">
                    Имя<span class="redColor">*</span>
                </div>
                <div class="checkoutInputField">
                    <input type="text" name="firstName" class="popupInp clickToWhite" content-type="text" valid="1"
                            errortext="Введите Ваше Имя, например 'Иван'"
                           <?php if (isset ( $_SESSION['user'] )): ?>value="<?php echo $_SESSION['user']['firstName']; ?>
"<?php endif; ?>/>         
                </div>   
                <div class="checkoutInputTitle">
                    Фамилия<span class="redColor">*</span>
                </div>
                <div class="checkoutInputField">
                    <input type="text" name="lastName" class="popupInp clickToWhite" content-type="text" valid="1" 
                            errortext="Введите Вашу Фамилию, например 'Иванов'"
                           <?php if (isset ( $_SESSION['user'] )): ?>value="<?php echo $_SESSION['user']['lastName']; ?>
"<?php endif; ?>/>         
                </div>           
                <div class="clr"></div><br/>
                <div class="checkoutInputTitle">
                    Страна<span class="redColor">*</span>
                </div>
                <div class="checkoutInputField">
                    <input type="text" name="country" class="popupInp clickToWhite" content-type="text" valid="1" 
                            errortext="Введите Вашу Страну, например 'Россия'" value="Россия"/>         
                </div>   
                <div class="checkoutInputTitle">
                    Город<span class="redColor">*</span>
                </div>
                <div class="checkoutInputField">
                    <input type="text" name="city" class="popupInp clickToWhite" content-type="text" valid="1"
                            errortext="Введите Ваш Город, например 'Севастополь'"
                           <?php if (isset ( $_SESSION['user'] )): ?>value="<?php echo $_SESSION['user']['city']; ?>
"<?php endif; ?>/>         
                </div>           
                <div class="clr"></div><br/>
                <div class="checkoutInputTitle">
                    Телефон<span class="redColor">*</span>
                </div>
                <div class="checkoutInputField">
                    <input type="text" name="phone" class="popupInp clickToWhite" content-type="text" valid="1" 
                            errortext="Введите Ваш номер телефона, например '+79787771115'"
                           <?php if (isset ( $_SESSION['user'] )): ?>value="<?php echo $_SESSION['user']['phone']; ?>
"<?php endif; ?>/>         
                </div>   
                <div class="checkoutInputTitle">
                    E-mail<span class="redColor">*</span>
                </div>
                <div class="checkoutInputField">
                    <input type="text" name="email" class="popupInp clickToWhite" content-type="email" valid="1"
                           errortext="Введите Ваш E-mail, например 'ivan1989@mail.ru'"
                           <?php if (isset ( $_SESSION['user'] )): ?>value="<?php echo $_SESSION['user']['email']; ?>
"<?php endif; ?>/>         
                </div>  
                <div class="clr"></div><br/> 
                <div class="checkoutInputTitle">
                    Доставка<span class="redColor">*</span>
                </div>
                <div class="checkoutInputField">
                    <select name="deliveryType" class="popupInp selectBlock">
                        <option value="samo" selected="selected">Самовывоз</option>
                        <option value="company">Транспортной компанией</option>
                    </select>       
                </div>  
                <div class="clr"></div><br/>                 
                <div class="checkoutInputTitle">
                    Комментарий, адрес доставки
                </div>
                <div class="checkoutInputFieldBig">
                    <textarea class="checkoutTextarea" name="comment" content-type="text" valid="0"></textarea>         
                </div>                 
                <div class="clr"></div><br/>        
                <div id="checkout_message"></div>  
                <div class="checkout_button" onclick="order();">Заказать</div>
                <div class="clr"></div>           
            </div>
        <?php else: ?>
            Корзина заказа пуста.
        <?php endif; ?>
        <div class="clr"></div>
    </div>
    <div class="clr"></div>
</div>

<?php if (isset ( $this->_tpl_vars['json'] )): ?>
    <input type="hidden" name="jsonData" value='<?php echo $this->_tpl_vars['json']; ?>
' />
    <div id="cartConsModals"></div>
<?php endif; ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>