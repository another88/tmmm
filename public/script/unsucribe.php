<?php
 
if ($_GET)
{
    require dirname(__FILE__) .'/../../settings/config.php';

    $databaseSettings = $config['db']['params'];
    
    mysql_connect(
            $databaseSettings['host'],
            $databaseSettings['username'],
            $databaseSettings['password']) OR DIE("No database");
    mysql_select_db($databaseSettings['dbname']) or die(mysql_error());
    mysql_query("SET NAMES UTF8");

    if($_GET['type'] == 'guest')
    {
        $sql="UPDATE `guest`
                SET `subs` = 0
                WHERE `idHush` = '".$_GET['id']."'"; 
        mysql_query($sql) or die(mysql_error());          
    }
    
    
//    elseif($_GET['type'] == 'cart')
//    {
//        $sql="UPDATE `order`
//                SET 
//                    `emailOpen` = 1
//                WHERE `orderId` = ".(int)$_GET['id']; 
//        mysql_query($sql) or die(mysql_error());         
//    }
    mysql_close();
    
    exit ('Вы успешно отписались от новостей от Ace Hookah.'); 
//    sleep(3);
//    header("Location: " . $config['url']['baseFull']);
       
}
else
{
    exit('Ошибка передачи данных. Попробуйте заново.');
}
 
?>