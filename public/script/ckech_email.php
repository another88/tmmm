<?php
 
if ($_GET)
{
    require dirname(__FILE__) .'/../../settings/config.php';

    $databaseSettings = $config['db']['params'];
    
//    var_dump($databaseSettings);exit;
    
    mysql_connect(
            $databaseSettings['host'],
            $databaseSettings['username'],
            $databaseSettings['password']) OR DIE("No database");
    mysql_select_db($databaseSettings['dbname']) or die(mysql_error());
    mysql_query("SET NAMES UTF8");

    if($_GET['type'] == 'oc')
    {
        $sql="UPDATE `buyonclick`
                SET 
                    `emailOpen` = 1
                WHERE `buyOnClickId` = ".(int)$_GET['id']; 
        mysql_query($sql) or die(mysql_error());          
    }
    elseif($_GET['type'] == 'cart')
    {
        $sql="UPDATE `order`
                SET 
                    `emailOpen` = 1
                WHERE `orderId` = ".(int)$_GET['id']; 
        mysql_query($sql) or die(mysql_error());         
    }
    mysql_close();
}

header('Content-Type: image/gif');
echo base64_decode('R0lGODlhAQABAJAAAP8AAAAAACH5BAUQAAAALAAAAAABAAEAAAICBAEAOw==');
 
?>