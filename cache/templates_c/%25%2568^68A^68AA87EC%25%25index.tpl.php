<?php /* Smarty version 2.6.19, created on 2017-03-18 11:37:13
         compiled from testimonial/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'testimonial/index.tpl', 24, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div class="contentInner">
    <div class="contentInnerLeft">
        <h1><?php echo $this->_tpl_vars['pageTitle']; ?>
</h1>
        <div class="clr"></div>          
        <div class="testimonial_button" onclick="openModalTestimonial();">Оставить отзыв</div>
        <div class="clr"></div>
        <?php if ($this->_tpl_vars['testimonialAdded']): ?>
            <div class="testimonialSucces">Ваш отзыв успешно отправлен на модерацию! Спасибо!</div>
        <?php endif; ?>
        <div class="clr"></div>
        <?php if (count ( $this->_tpl_vars['testimonials']['data'] ) > 0): ?>
            <?php $_from = $this->_tpl_vars['testimonials']['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['t']):
?>
                <div class="testimonialBlock">
                    <?php if (! empty ( $this->_tpl_vars['t']['imageMedium'] )): ?>
                        <div class="testimonialImage">
                            <img src="images/testimonial/<?php echo $this->_tpl_vars['t']['testimonialId']; ?>
/<?php echo $this->_tpl_vars['t']['imageMedium']; ?>
" class="resizebleImg" />
                            <div class="clr"></div>
                        </div>
                    <?php endif; ?>
                    <div class="testimonialDescription<?php if (empty ( $this->_tpl_vars['t']['imageMedium'] )): ?> bigTestimonialDesc<?php endif; ?>">
                        <div class="testimonialTitle"><?php echo $this->_tpl_vars['t']['firstName']; ?>
 <?php echo $this->_tpl_vars['t']['lastName']; ?>
</div>
                        <div class="testimonialDate"><?php echo ((is_array($_tmp=$this->_tpl_vars['t']['dateAdded'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y %k:%M") : smarty_modifier_date_format($_tmp, "%d.%m.%Y %k:%M")); ?>
</div>
                        <div class="clr"></div>
                        <div class="testimonialEmailLink"><?php if (! empty ( $this->_tpl_vars['t']['vklink'] )): ?><a href="<?php echo $this->_tpl_vars['t']['vklink']; ?>
" target="_blank"><?php echo $this->_tpl_vars['t']['vklink']; ?>
</a><?php endif; ?></div>
                        <div class="clr"></div>            
                        <?php echo $this->_tpl_vars['t']['comment']; ?>
         
                        <div class="clr"></div>                            
                    </div>
                    <div class="clr"></div>
                </div>
                <div class="clr"></div>
            <?php endforeach; endif; unset($_from); ?>          
        <?php endif; ?>
        <?php if (count ( $this->_tpl_vars['testimonials']['data'] ) > 3): ?>
            <div class="testimonial_button" onclick="openModalTestimonial();">Оставить отзыв</div>
        <?php endif; ?>
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'popup_testimonial.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> 
    </div>
    <div class="clr"></div>
</div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>