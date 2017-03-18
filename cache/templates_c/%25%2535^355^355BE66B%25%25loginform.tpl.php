<?php /* Smarty version 2.6.19, created on 2017-03-09 12:14:44
         compiled from loginform.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru-RU">
    <head>
        <base href="<?php echo $this->_tpl_vars['rootPath']; ?>
" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Login</title>
        <link href="styles/login.css" rel="stylesheet" media="screen,projection" type="text/css" />
    </head>
    <body>
        <div class="wrap">
            <?php if (isset ( $this->_tpl_vars['error'] ) && ! empty ( $this->_tpl_vars['error'] )): ?>
                <div class="error"><?php echo $this->_tpl_vars['error']; ?>
</div>
            <?php endif; ?>
            <form name="loginform" id="loginform" action="index/login" method="post">
                <p>
                    <label>Email<br />
                        <input type="text" name="login" id="user_login" class="input" value="" size="20" /></label>
                </p>
                <p>
                    <label>Password<br />
                        <input type="password" name="password" id="user_pass" class="input" value="" size="20" /></label>
                </p>
                
                <p>
                    <button>Enter</button>
                </p>
            </form>


        </div>
    </body>
</html>