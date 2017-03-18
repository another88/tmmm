<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en-US">
    <head>
        <base href="{$rootPath}" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Mining Expo</title>
        <link href="styles/login.css" rel="stylesheet" media="screen,projection" type="text/css" />
        <!--[if lt IE 8]>
            <link rel="stylesheet" href="styles/blueprint/ie.css" type="text/css" media="screen, projection">
        <![endif]-->

    </head>
    <body>
        <div class="wrap">
            {if isset($error) && !empty($error)}
                <div class="error">{$error}</div>
            {/if}
            <form name="loginform" id="loginform" action="admin/login" method="post">
                <p>
                    <label>Login<br />
                        <input type="text" name="login" id="user_login" class="input" value="" size="20" /></label>
                </p>
                <p>
                    <label>Password<br />
                        <input type="password" name="password" id="user_pass" class="input" value="" size="20" /></label>
                </p>
                
                <p>
                    <button>Submit</button>
                </p>
            </form>
        </div>
    </body>
</html>