<?php /* Smarty version 2.6.19, created on 2017-03-18 04:57:00
         compiled from mix/search.tpl */ ?>
<div class="searchTitle">Найденные миксы</div>
<?php if (count ( $this->_tpl_vars['serachResult'] ) > 0): ?>
    <?php $_from = $this->_tpl_vars['serachResult']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['iterm'] = array('total' => count($_from), 'iteration' => 0);
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
            <div class="mixSearchBlockRight">
                <div class="share42initVert"
                    data-url="http://ace-hookah.com/mix"
                    data-title="Ace Hookah Микс"
                    data-description="<?php echo $this->_tpl_vars['sr']['shareDesc']; ?>
"
                    data-image="http://ace-hookah.com/i/mix_logo_main.jpg"
                ></div>   
                <div class="mix_social_button save" onclick="saveImg(<?php echo $this->_tpl_vars['sr']['mixId']; ?>
);"></div>
            </div>
            <div class="clr"></div>
        </div>
        <?php if (!(1 & $this->_foreach['iterm']['iteration'])): ?>
            <div class="clr"></div>
        <?php endif; ?>            
    <?php endforeach; endif; unset($_from); ?>
<?php else: ?>
    <span style="color: red;">В нашей базе не найдено миксов с такими вкусами.</span>
    <div class="clr"></div>
<?php endif; ?>
<div class="clr"></div>