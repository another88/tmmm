<?php /* Smarty version 2.6.19, created on 2017-03-18 07:28:05
         compiled from interesting/view.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div class="contentInner">
    <div class="interestLeft">
        <h1><?php echo $this->_tpl_vars['pageTitle']; ?>
</h1>
        <div class="clr"></div>
        <?php echo $this->_tpl_vars['content']['description']; ?>

        <div class="clr"></div>
        <div class="interestingPageTextShare">
            <div class="share42init"
                 data-url="http://ace-hookah.com/interesting/<?php echo $this->_tpl_vars['content']['url']; ?>
.html"
                 data-title="<?php echo $this->_tpl_vars['content']['title']; ?>
"
                 data-description="<?php echo $this->_tpl_vars['content']['shortDescription']; ?>
"
            ></div>         
            <?php echo '
                <script type="text/javascript" src="share42/share42.js"></script>
            '; ?>
   
        </div>  
        <div class="interestViews" title="Просмотров">
            <img src="i/views.png" />
            <div class="viewsCount"><?php echo $this->_tpl_vars['content']['veiwCount']; ?>
</div>
        </div>
        <div class="clr"></div>
        <div class="interestNav">
            <h2>Другие статьи</h2>
            <?php $_from = $this->_tpl_vars['list']['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ld']):
?>
                <div class="interestMenuBlock<?php if ($this->_tpl_vars['ld']['contentId'] == $this->_tpl_vars['content']['contentId']): ?> interestMenuActiveBlock<?php endif; ?>" onclick="redirect('interesting/<?php echo $this->_tpl_vars['ld']['url']; ?>
.html');">
                    <a href="interesting/<?php echo $this->_tpl_vars['ld']['url']; ?>
.html"><?php echo $this->_tpl_vars['ld']['title']; ?>
</a>
                    <div class="clr"></div>
                    <div class="inNavDesc"><?php echo $this->_tpl_vars['ld']['shortDescription']; ?>
</div>
                    <div class="clr"></div>
                </div>
            <?php endforeach; endif; unset($_from); ?>
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