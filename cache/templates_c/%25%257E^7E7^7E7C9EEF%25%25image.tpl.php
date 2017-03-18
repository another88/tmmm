<?php /* Smarty version 2.6.19, created on 2016-02-15 13:01:20
         compiled from ourwork/image.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<table class="adminTable">
    <tr>
        <td colspan="2">Изображения:</td>
    </tr>
    <tr>
        <td colspan="2">
            <?php if (count ( $this->_tpl_vars['image']['data'] ) > 0): ?>
                <?php $_from = $this->_tpl_vars['image']['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['i']):
?>
                    <div class="productImages">
                        <div  class="img">
                            <img src="images/ourwork/<?php echo $this->_tpl_vars['i']['ourWorkId']; ?>
/<?php echo $this->_tpl_vars['i']['imageSmall']; ?>
" />
                        </div>
                        <div>
                            <a class="delete" href="admin/ourwork/imagedelete/id/<?php echo $this->_tpl_vars['i']['ourWorkImageId']; ?>
" onclick="return confirm('Удалить?')">
                                Удалить
                            </a>
                        </div>
                    </div>
                <?php endforeach; endif; unset($_from); ?>
            <?php else: ?>
                No photo
            <?php endif; ?>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <form id="article" action="admin/ourwork/image/id/<?php echo $this->_tpl_vars['ourwork']['ourWorkId']; ?>
" method="post" enctype="multipart/form-data">
                <table border="1">
                    <tbody>
                        <tr>
                            <td>Выбирите фото:</td>
                            <td><input type="file" class="file" name="imageOriginal" id="imageOriginal" value="" /></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <button type="submit" class="button">Загрузить</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </td>
    </tr>
</table>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>