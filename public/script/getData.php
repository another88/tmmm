<?php
 
if ($_GET)
{
    if( !empty($_GET['id']) )
    {
        require dirname(__FILE__) .'/../../settings/config.php';

        $databaseSettings = $config['db']['params'];

        mysql_connect(
                $databaseSettings['host'],
                $databaseSettings['username'],
                $databaseSettings['password']) OR DIE("No database");
        mysql_select_db($databaseSettings['dbname']) or die(mysql_error());
        mysql_query("SET NAMES UTF8");

        $sql="SELECT *
                FROM `guest`
                WHERE `guestId` = ".(int)$_GET['id']; 
        $sqlres = mysql_query($sql) or die(mysql_error());
        $row = mysql_fetch_assoc($sqlres);
        var_dump($row);exit;
    }
}