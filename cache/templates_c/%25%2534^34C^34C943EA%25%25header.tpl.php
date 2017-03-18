<?php /* Smarty version 2.6.19, created on 2017-03-18 15:53:43
         compiled from guest/header.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"  dir="ltr" lang="ru-RU">
<head>
    <base href="<?php echo $this->_tpl_vars['rootPath']; ?>
" />
    <script>
        var rootPath = "<?php echo $this->_tpl_vars['rootPath']; ?>
";
    </script>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="icon" type="image/png" href="http://ace-hookah.com/icon/favicon.png" />
    <title>
        <?php if (empty ( $this->_tpl_vars['title'] )): ?>
            Учетка Ace Hookah
        <?php else: ?>
            <?php echo $this->_tpl_vars['title']; ?>

        <?php endif; ?>
    </title>
    <link rel='stylesheet' href='styles/admin/dashboard.css' type='text/css' media='all' />
    <link rel='stylesheet' href='styles/admin/colors-fresh.css' type='text/css' media='all' />
    <link rel='stylesheet' href='styles/admin/guest.css' type='text/css' media='all' />
    <link rel='stylesheet' href='styles/jqueryui/jquery-ui-1.9.1.custom.css' type='text/css' media='all' />
    <?php if (isset ( $this->_tpl_vars['styles'] ) && ! empty ( $this->_tpl_vars['styles'] )): ?>
        <?php $_from = $this->_tpl_vars['styles']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['s']):
?>
            <link rel='stylesheet' href='styles/admin/<?php echo $this->_tpl_vars['s']; ?>
' type='text/css' media='all' />
        <?php endforeach; endif; unset($_from); ?>
    <?php endif; ?>

    <script type='text/javascript' src='scripts/admin/jquery_utils_quicktags.js'></script>
    <script type='text/javascript' src='scripts/admin/script.js'></script>
    <script type='text/javascript' src='scripts/jquery-1.8.2.min.js'></script>
    <script type='text/javascript' src='scripts/jquery-ui-1.9.1.min.js'></script>
    <script type='text/javascript' src='scripts/jquery.json-2.3.min.js'></script>
    <script type='text/javascript' src='scripts/admin.js'></script>

    <?php if (isset ( $this->_tpl_vars['scripts'] ) && ! empty ( $this->_tpl_vars['scripts'] )): ?>
        <?php $_from = $this->_tpl_vars['scripts']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['s']):
?>
            <script type="text/javascript" src="<?php echo $this->_tpl_vars['s']; ?>
"></script>
        <?php endforeach; endif; unset($_from); ?>
    <?php endif; ?>

    <style type="text/css">
    <?php echo '
            * html #adminmenu { /* for IE6 only */
                    margin-left: -115px; /* default 80px + 5px */
            }
    '; ?>

    </style>
</head>
<body class="wp-admin no-js  index-php">
    <?php if (! empty ( $this->_tpl_vars['headerMessage'] )): ?>
        <?php echo '
        <script type="text/javascript">
        $(document).ready(function(){
            $(\'.main-page-notice\').fadeIn(500);
                setTimeout("$(\'.main-page-notice\').fadeOut(800)", 5000);
        });
        </script>
        '; ?>

        <div class="main-page-notice" style="display: none;"><?php echo $this->_tpl_vars['headerMessage']; ?>
</div>
    <?php endif; ?>

<div id="wpwrap">
<div id="wpcontent">

<div id="wpbody">
    <ul id="adminmenu">
            <li class="wp-first-item current menu-top menu-top-first menu-top-last">
                <div class='wp-menu-image'><a href='index/logout'><br /></a></div>
                <div class="wp-menu-toggle"><br /></div>
                <a href='index/logout' class="wp-first-item current menu-top menu-top-first menu-top-last" style="background-color: red;">Выйти</a>
            </li>
            <li class="wp-menu-separator"><a class="separator" href="?unfoldmenu=1"><br /></a></li>

            <?php if ($this->_tpl_vars['isWork']['value'] == '0'): ?>
                <li class="wp-first-item current menu-top menu-top-first menu-top-last">
                    <div class="setupButtonActive"><a href='guest/loungeopen'>Открыть смену</a></div>
                </li>
                <li class="wp-menu-separator"><a class="separator" href="?unfoldmenu=1"><br /></a></li>
            <?php else: ?>
                <li class="wp-first-item current menu-top menu-top-first menu-top-last">
                    <div class="setupButtonCancel"><a href='javascript:void(0);' onclick="loungeclose();">Закрыть смену</a></div>
                </li>
                <li class="wp-menu-separator"><a class="separator" href="?unfoldmenu=1"><br /></a></li>            
            <?php endif; ?>
            
            <li class="wp-first-item current menu-top menu-top-first menu-top-last">
                <div class="wp-menu-toggle"><br /></div>
                <a href='guest/' class="wp-first-item current menu-top menu-top-first menu-top-last">На главную</a>
            </li>
            <li class="wp-menu-separator"><a class="separator" href="?unfoldmenu=1"><br /></a></li>            

            <li class="wp-has-submenu open-if-no-js menu-top menu-top <?php if (isset ( $this->_tpl_vars['menuOpen'] ) && $this->_tpl_vars['menuOpen'] == 'list'): ?>wp-menu-open<?php endif; ?> menu-top-first">
                <div class="wp-menu-toggle"><br /></div>
                <a href='guest/list' class="wp-has-submenu open-if-no-js menu-top menu-top-first">Члены клуба</a>
            </li> 
            
            <li class="wp-has-submenu open-if-no-js menu-top menu-top <?php if (isset ( $this->_tpl_vars['menuOpen'] ) && $this->_tpl_vars['menuOpen'] == 'todaytable'): ?>wp-menu-open<?php endif; ?>">
                <div class="wp-menu-toggle"><br /></div>
                <a href='guest/dayreport/id/0' class="wp-has-submenu open-if-no-js menu-top menu-top-first">Отчет за сегодня</a>
            </li>                   
                
            <?php if ($_SESSION['user']['isAdmin'] == 2): ?>
                <li class="wp-has-submenu open-if-no-js menu-top menu-top <?php if (isset ( $this->_tpl_vars['menuOpen'] ) && $this->_tpl_vars['menuOpen'] == 'report'): ?>wp-menu-open<?php endif; ?>">
                    <div class="wp-menu-toggle"><br /></div>
                    <a href='guest/report' class="wp-has-submenu open-if-no-js menu-top menu-top-first">Отчет по месяцам</a>
                </li>  
                    
                <li class="wp-has-submenu open-if-no-js menu-top menu-top <?php if (isset ( $this->_tpl_vars['menuOpen'] ) && $this->_tpl_vars['menuOpen'] == 'guestproductсategory'): ?>wp-menu-open<?php endif; ?>">
                    <div class="wp-menu-toggle"><br /></div>
                    <a href='guest/guestproductcategory' class="wp-has-submenu open-if-no-js menu-top menu-top-first">Категории меню</a>
                </li> 

                <li class="wp-has-submenu open-if-no-js menu-top menu-top <?php if (isset ( $this->_tpl_vars['menuOpen'] ) && $this->_tpl_vars['menuOpen'] == 'guestproduct'): ?>wp-menu-open<?php endif; ?>">
                    <div class="wp-menu-toggle"><br /></div>
                    <a href='guest/guestproduct' class="wp-has-submenu open-if-no-js menu-top menu-top-first">Продукты в меню</a>
                </li> 

                <li class="wp-has-submenu open-if-no-js menu-top menu-top <?php if (isset ( $this->_tpl_vars['menuOpen'] ) && $this->_tpl_vars['menuOpen'] == 'guestsale'): ?>wp-menu-open<?php endif; ?>menu-top-last">
                    <div class="wp-menu-toggle"><br /></div>
                    <a href='guest/guestsale' class="wp-has-submenu open-if-no-js menu-top menu-top-first">Скидки</a>
                </li> 
            <?php endif; ?>

    
            <li class="wp-menu-separator-last"><a class="separator" href="?unfoldmenu=1"><br /></a></li>
    </ul>
    <div id="wpbody-content">
        <div id="screen-meta">


        </div>

        <script>setTimeout("$('.noticeUp').slideUp(500)",4000);</script>
        <div id='update-nag' class="noticeUp" style="color: green">      <?php echo $this->_tpl_vars['notice']; ?>
     </div>
        <?php if (! empty ( $this->_tpl_vars['error'] )): ?>
        <div id='update-nag'>      <?php echo $this->_tpl_vars['error']; ?>
     </div>
        <?php endif; ?>
    </div>

    <div class="wrap">
        
        
        <h2><?php echo $this->_tpl_vars['title']; ?>
</h2>
        <div class='postbox-container' style='width:95%;'>
        <div id="dashboard_quick_press" class="postbox " >
            <div class="inside">