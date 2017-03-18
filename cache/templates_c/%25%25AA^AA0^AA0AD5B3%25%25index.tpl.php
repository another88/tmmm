<?php /* Smarty version 2.6.19, created on 2017-03-18 14:50:11
         compiled from mix/index.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php if (isset ( $this->_tpl_vars['mixDetails'] )): ?>
    <script type="text/javascript">
        var mid = <?php echo $this->_tpl_vars['mixDetails']['mixId']; ?>
;
    </script>       
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'popup_current_mix.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php else: ?>
    <script type="text/javascript">
        var mid = 0;
    </script>     
<?php endif; ?>

<div class="contentInner">
    <div class="mixText">
        <h1><?php echo $this->_tpl_vars['pageTitle']; ?>
</h1>
        <div class="clr"></div>            
        <?php echo $this->_tpl_vars['content']['description']; ?>

        <div class="mixPageTextShare">
            <div class="share42init"
                 data-url="http://ace-hookah.com/mix"
                 data-title="<?php echo $this->_tpl_vars['content']['title']; ?>
"
                 data-description="<?php echo $this->_tpl_vars['content']['description']; ?>
"
                 data-image="http://ace-hookah.com/i/mix_logo_main.jpg"
            ></div>        
            <?php echo '
                <script type="text/javascript" src="share42/share42.js"></script>
            '; ?>
                  
        </div>           
        <div class="clr"></div>             
    </div>        
    <div class="clr"></div><br/>
    <div class="searchTitle">Поиск микса</div>
    <div class="clr"></div>
    <div class="mixMain">
        <select class="mixSelectSearch" onchange="selectTabacCategorySearch($(this).val());">
            <option value="0">Выбирите фирму табака</option>
            <?php $_from = $this->_tpl_vars['tabacCategory']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['tc']):
?>
                <option value="<?php echo $this->_tpl_vars['tc']['tabacCategoryId']; ?>
"><?php echo $this->_tpl_vars['tc']['title']; ?>
</option>
            <?php endforeach; endif; unset($_from); ?>
        </select>      
        <div class="mixSearchType">
            <label for="check1">По выбранным вкусам</>
            <input id="check1" type="checkbox" name="onlySelected" />
            <div class="clr"></div>
        </div>
        <div class="mixButton" onclick="searchMix();">Искать миксы</div>
        <div class="mixButtonRight" onclick="addMixModal();">Добавить свой микс</div>
        <div class="clr"></div>
        <div class="tabacSelectedSearch"></div>
        <div class="clr"></div>  
        <div class="tabacList">
            <?php $_from = $this->_tpl_vars['tabacCategory']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['tc']):
?>
                <div class="tabacCategoryListSearch" id="tabacCategorySearch_<?php echo $this->_tpl_vars['tc']['tabacCategoryId']; ?>
">
                    <?php $_from = $this->_tpl_vars['tc']['tabac']['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['t']):
?>
                        <div class="tabacBlock" id="tabacSearch_<?php echo $this->_tpl_vars['t']['tabacId']; ?>
_<?php echo $this->_tpl_vars['t']['tabacCategoryId']; ?>
" onclick="selectTabacSearch('<?php echo $this->_tpl_vars['t']['tabacId']; ?>
', '<?php echo $this->_tpl_vars['t']['title']; ?>
', '<?php echo $this->_tpl_vars['t']['tabacCategoryId']; ?>
', '<?php echo $this->_tpl_vars['tc']['title']; ?>
');">
                            <?php echo $this->_tpl_vars['t']['title']; ?>

                        </div>
                    <?php endforeach; endif; unset($_from); ?>  
                    <div class="clr"></div>
                </div>
            <?php endforeach; endif; unset($_from); ?>                        
        </div>  
        <div class="clr"></div>
        <div id="mixSearchResultError"></div>
        <div class="clr"></div>            
    </div>
    <div class="clr"></div>
    <div id="mixSearchResult"></div>
    <div class="clr"></div>
</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'popup_mix.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>  

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>