<?php
session_start();
include ("db_connect.php");
if(isset($_POST["num"]))
{
	$id_app = $_POST["num"];
	
	$sql = mysqli_query($link, "DELETE FROM user WHERE id_user = '{$id_app}'") or die("Ошибка удаления пользователя!");
	
	sessi
	if ($sql)
	{
		echo "ok";
	}else
	{
		echo 'error';
	}
	
}

?>