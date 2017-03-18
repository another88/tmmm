<?php /* Smarty version 2.6.19, created on 2017-03-15 14:31:21
         compiled from sitemap/index.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div class="contentInner">
    <div class="contentInnerLeft">
        <h1><?php echo $this->_tpl_vars['pageTitle']; ?>
</h1>
        <div class="clr"></div><br/>   
        <div class="smLeft">
            <div class="smTitle">каталог</div>
            <div class="clr"></div>
            <div class="smSubBlock">
                <?php $_from = $this->_tpl_vars['categorySm']['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['fcm'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['fcm']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['mc']):
        $this->_foreach['fcm']['iteration']++;
?>
                    <div class="sm_item<?php if (($this->_foreach['fcm']['iteration'] == $this->_foreach['fcm']['total'])): ?> last_sm_block<?php endif; ?>">
                        <a href="catalog/<?php echo $this->_tpl_vars['mc']['url']; ?>
.html" target="_blank"><?php echo $this->_tpl_vars['mc']['title']; ?>
</a>
                    </div>       
                    <div class="clr"></div>
                    <?php if (count ( $this->_tpl_vars['mc']['product']['data'] ) > 0): ?>
                        <div class="smSubSubBlock">
                            <?php $_from = $this->_tpl_vars['mc']['product']['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['fcmp'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['fcmp']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['mcp']):
        $this->_foreach['fcmp']['iteration']++;
?>
                                <div class="sm_item<?php if (($this->_foreach['fcmp']['iteration'] == $this->_foreach['fcmp']['total'])): ?> last_sm_block<?php endif; ?>">
                                    <a href="product/<?php echo $this->_tpl_vars['mcp']['url']; ?>
.html" target="_blank"><?php echo $this->_tpl_vars['mcp']['title']; ?>
</a>
                                </div>       
                                <div class="clr"></div>
                            <?php endforeach; endif; unset($_from); ?>                            
                        </div>
                        <div class="clr"></div>
                    <?php endif; ?>
                <?php endforeach; endif; unset($_from); ?>
            </div>
            <div class="clr"></div>
        </div>
        <div class="smRight">
            <div class="smBlock">
                <div class="smTitle">На ознакомление</div>
                <div class="clr"></div>
                <div class="smSubBlock">
                    <div class="sm_item">
                        <a href="constructor" target="_blank">Конструктор</a>
                    </div>    
                    <div class="clr"></div>
                    <div class="sm_item">
                        <a href="mix" target="_blank">Миксы</a>
                    </div>   
                    <div class="clr"></div>
                    <div class="sm_item">
                        <a href="ourwork" target="_blank">Портфолио</a>
                    </div>   
                    <div class="clr"></div>
                    <div class="sm_item">
                        <a href="interesting" target="_blank">Интересное</a>
                    </div>     
                    <div class="clr"></div>  
                    <?php if (count ( $this->_tpl_vars['interestingList']['data'] ) > 0): ?>
                        <div class="smSubSubBlock">
                            <?php $_from = $this->_tpl_vars['interestingList']['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['iter'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['iter']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['il']):
        $this->_foreach['iter']['iteration']++;
?>
                                <div class="sm_item">
                                    <a href="interesting/<?php echo $this->_tpl_vars['il']['url']; ?>
.html" target="_blank"><?php echo $this->_tpl_vars['il']['title']; ?>
</a>
                                </div>                              
                                <div class="clr"></div>
                            <?php endforeach; endif; unset($_from); ?>
                        </div>
                        <div class="clr"></div>
                    <?php endif; ?>                    
                    <div class="sm_item last_sm_block">
                        <a href="special" target="_blank">Дешевле</a>
                    </div>  
                    <div class="clr"></div>
                </div>
                <div class="clr"></div>
            </div>
            <div class="smBlock">
                <div class="smTitle">О нас</div>
                <div class="clr"></div>
                <div class="smSubBlock">
                        <div class="sm_item ">
                            <a href="testimonial" target="_blank">Отзывы</a>
                        </div>     
                        <div class="clr"></div>
                        <div class="sm_item ">
                            <a href="content/pay_delivery.html" target="_blank">Оплата и Доставка</a>
                        </div>  
                     
                        <div class="clr"></div>
                        <div class="sm_item ">
                            <a href="content/contacts.html" target="_blank">Контакты</a>
                        </div>    
                        <div class="clr"></div>
                        <div class="sm_item last_sm_block">
                            <a href="sitemap" target="_blank">Карта сайта</a>
                        </div>    
                        <div class="clr"></div>  
                </div>
                <div class="clr"></div>
            </div>  
            <div class="clr"></div>
        </div>
        <div class="clr"></div>
    </div>
    <div class="clr"></div>
</div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>