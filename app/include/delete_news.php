<?php
session_start();
include ("db_connect.php");
if(isset($_POST["num"]))
{
	$id_app = $_POST["num"];
	
	$sql = mysqli_query($link, "DELETE FROM news WHERE id = '{$id_app}'") or die("Ошибка удаления новости!");
	if ($sql)
	{
		echo "ok";
	}else
	{
		echo 'error';
	}
	
}

?>