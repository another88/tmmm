<?php

require dirname(__FILE__) .'/../../settings/config.php';

$databaseSettings = $config['db']['params'];
mysql_connect($databaseSettings['host'],
$databaseSettings['username'],
$databaseSettings['password']) OR DIE("No database");
mysql_select_db($databaseSettings['dbname']) or die(mysql_error());
mysql_query("SET NAMES UTF8");

$sql2="UPDATE `setting` 
            SET `value` = '0'
            WHERE `code` = 'letter_count'"; 
mysql_query($sql2) or die(mysql_error());   