<?php /* Smarty version 2.6.19, created on 2017-03-18 09:42:52
         compiled from ourwork/index.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<script type="text/javascript">
    var pid = <?php echo $this->_tpl_vars['pid']; ?>
;
</script>       

<div class="contentInner">
    <h1><?php echo $this->_tpl_vars['pageTitle']; ?>
</h1>
    <div class="clr"></div>           
    <?php if (count ( $this->_tpl_vars['list']['data'] ) > 0): ?>
        <?php $_from = $this->_tpl_vars['list']['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['iter'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['iter']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['p']):
        $this->_foreach['iter']['iteration']++;
?>
            <div class="ourWorkBlock" id="pid_<?php echo $this->_tpl_vars['p']['ourWorkId']; ?>
" <?php if (($this->_foreach['iter']['iteration'] <= 1)): ?>style="margin-top: 0;"<?php endif; ?>
                 <?php if (($this->_foreach['iter']['iteration'] == $this->_foreach['iter']['total'])): ?>style="border-bottom: none;"<?php endif; ?>>
                <div class="ourWorkTitle"><?php echo $this->_tpl_vars['p']['title']; ?>
</div>
                <div class="clr"></div>
                <?php $_from = $this->_tpl_vars['p']['images']['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['pit'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['pit']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['pi']):
        $this->_foreach['pit']['iteration']++;
?>
                    <div class="ourWorkImage"
                         <?php if (!($this->_foreach['pit']['iteration'] % 4)): ?>style="margin-right: 0;"<?php endif; ?>
                         >
                        <a href="images/ourwork/<?php echo $this->_tpl_vars['pi']['ourWorkId']; ?>
/<?php echo $this->_tpl_vars['pi']['imageOriginal']; ?>
" class="imageFancy" rel="group_<?php echo $this->_tpl_vars['p']['ourWorkId']; ?>
">
                            <img src="images/ourwork/<?php echo $this->_tpl_vars['pi']['ourWorkId']; ?>
/<?php echo $this->_tpl_vars['pi']['imageMedium']; ?>
" alt="Эксклюзивный кальян от Ace Hookah '<?php echo $this->_tpl_vars['p']['title']; ?>
'" title="Эксклюзивный кальян от Ace Hookah '<?php echo $this->_tpl_vars['p']['title']; ?>
'" />
                        </a>
                    </div>
                    <?php if (!($this->_foreach['pit']['iteration'] % 4)): ?>
                        <div class="clr"></div>
                    <?php endif; ?>
                <?php endforeach; endif; unset($_from); ?>
                <div class="clr"></div>
                <div class="ourWorkShare">
                    <div class="share42init"
                         data-url="http://ace-hookah.com/ourwork?pid=<?php echo $this->_tpl_vars['p']['ourWorkId']; ?>
"
                         data-title="<?php echo $this->_tpl_vars['p']['title']; ?>
"
                         data-description="<?php echo $this->_tpl_vars['p']['description']; ?>
"
                         data-image="http://ace-hookah.com/images/ourwork/<?php echo $this->_tpl_vars['pi']['ourWorkId']; ?>
/<?php echo $this->_tpl_vars['pi']['imageMedium']; ?>
"
                    ></div>
                    <div class="likeBlock">
                        <div class="likeImg">
                            <?php if ($this->_tpl_vars['p']['isLike']): ?>
                                <img src="i/like_active.png" class="activeLike" />                                
                            <?php else: ?>
                                <img src="i/like.png" 
                                        onmouseover="likeHover($(this));" 
                                        onmouseout="likeOut($(this));"
                                        onclick="like('<?php echo $this->_tpl_vars['p']['ourWorkId']; ?>
');" />
                            <?php endif; ?>
                        </div>
                        <div class="likeCount"><?php echo $this->_tpl_vars['p']['likeCount']; ?>
</div>
                    </div>
                </div>    
                <div class="clr"></div>
            </div>
        <?php endforeach; endif; unset($_from); ?>    
        <?php echo '
            <script type="text/javascript" src="share42/share42.js"></script>
        '; ?>
                
    <?php else: ?>
        Нет Данных.
    <?php endif; ?>
    <div class="clr"></div>
</div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>