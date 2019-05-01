<?php
$db_host = 'localhost';
$db_user = 'admin';
$db_pass = '123456';
$db_database = 'diplom';

$link = mysqli_connect($db_host, $db_user, $db_pass);
mysqli_select_db($link, $db_database) or die("Нет соединения с БД" . mysql_error());
mysqli_query($link, "SET NAMES UTF8");
?>