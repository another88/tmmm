<?php /* Smarty version 2.6.19, created on 2015-02-09 11:06:31
         compiled from mix/saveall.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<script type="text/javascript">
    var mid = 0;
</script>    
    

<?php $_from = $this->_tpl_vars['mix']['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['iterm'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['iterm']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['sr']):
        $this->_foreach['iterm']['iteration']++;
?>
    <div class="mixSearchResultBlock" <?php if (!(1 & $this->_foreach['iterm']['iteration'])): ?>style='margin-right: 0;'<?php endif; ?>>
        <div class="mixSearchBlockLeft" id="mix_<?php echo $this->_tpl_vars['sr']['mixId']; ?>
">
            <div style="padding: 15px 0 15px 15px;">
                <img src='i/ace_mix_logo.png' />
                <div class="clr"></div> 
                <?php if (! empty ( $this->_tpl_vars['sr']['author'] )): ?>
                    Автор: <a href="javascript:void(0);"><?php echo $this->_tpl_vars['sr']['author']; ?>
</a>
                    <div class="clr"></div> 
                <?php endif; ?>                
                <div class="diagramBlock">
                    <input type="hidden" name="diaData" value='<?php echo $this->_tpl_vars['sr']['json']; ?>
' />
                    <input type="hidden" name="mixId" value='<?php echo $this->_tpl_vars['sr']['mixId']; ?>
' />
                    <canvas id="dia_<?php echo $this->_tpl_vars['sr']['mixId']; ?>
" width="150" height="150"/>
                </div>
                <div class="tabacsInMix">
                    <?php $_from = $this->_tpl_vars['sr']['mixDetails']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['t']):
?>
                        <div class="tabacBlockInSearch">
                            <div class="tabacColorBlock" style="background-color: #<?php echo $this->_tpl_vars['t']['color']; ?>
"></div>
                            <div class="tabacTitleInSearch"><?php echo $this->_tpl_vars['t']['tabacCategoryTitle']; ?>
-<?php echo $this->_tpl_vars['t']['tabacTitle']; ?>
: <?php echo $this->_tpl_vars['t']['percent']; ?>
%</div>
                            <div class="clr"></div> 
                        </div>
                        <div class="clr"></div> 
                    <?php endforeach; endif; unset($_from); ?>    
                    <div class="clr"></div> 
                </div>
                <div class="clr"></div> 
                <div class="toKolba">в колбу:</div>
                <div class="toKolbaText"><?php echo $this->_tpl_vars['sr']['waterDescription']; ?>
</div>
                <div class="clr"></div> 
            </div>

            <div class="clr"></div> 
        </div>
        <div class="orangeLine"></div>
        <div class="clr"></div>
    </div>
    <?php if (!(1 & $this->_foreach['iterm']['iteration'])): ?>
        <div class="clr"></div>
    <?php endif; ?>            
<?php endforeach; endif; unset($_from); ?>
<div class="clr"></div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>