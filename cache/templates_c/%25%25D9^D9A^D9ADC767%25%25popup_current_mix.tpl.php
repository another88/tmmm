<?php /* Smarty version 2.6.19, created on 2017-03-16 09:57:50
         compiled from popup_current_mix.tpl */ ?>
<div id="popup_current_mix" class="popup">
    <div class="mixSearchResultBlock">
        <div class="mixSearchBlockLeft" id="pop_mix_<?php echo $this->_tpl_vars['mixDetails']['mixId']; ?>
">
            <div style="padding: 15px 0 15px 15px;">
                <img src='i/ace_mix_logo.png' />
                <div class="clr"></div> 
                <?php if (! empty ( $this->_tpl_vars['mixDetails']['author'] )): ?>
                    Автор: <a href="javascript:void(0);"><?php echo $this->_tpl_vars['mixDetails']['author']; ?>
</a>
                    <div class="clr"></div> 
                <?php endif; ?>                
                <div class="diagramBlock">
                    <input type="hidden" name="pop_diaData" value='<?php echo $this->_tpl_vars['mixDetails']['json']; ?>
' />
                    <input type="hidden" name="pop_mixId" value='<?php echo $this->_tpl_vars['mixDetails']['mixId']; ?>
' />
                    <canvas id="pop_dia_<?php echo $this->_tpl_vars['mixDetails']['mixId']; ?>
" width="150" height="150"/>
                </div>
                <div class="tabacsInMix">
                    <?php $_from = $this->_tpl_vars['mixDetails']['mixDetails']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
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
                <div class="toKolbaText"><?php echo $this->_tpl_vars['mixDetails']['waterDescription']; ?>
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
                data-description="<?php echo $this->_tpl_vars['mixDetails']['shareDesc']; ?>
"
                data-image="http://ace-hookah.com/i/mix_logo_main.jpg"
            ></div>   
            <div class="mix_social_button save" onclick="saveImg(<?php echo $this->_tpl_vars['mixDetails']['mixId']; ?>
);"></div>
        </div>
        <div class="clr"></div>
    </div>   
    <div class="clr"></div>
</div>
<div class="clr"></div> 