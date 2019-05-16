<?php 
session_start();
include ("db_connect.php");
if(isset($_POST["num"]))
{
	$id_app = $_POST["num"];
	$sql = mysqli_query($link, "UPDATE application performers = '$id_app' WHERE id_application= '{$_SESSION["id_app"]}'  ") or die("Ошибка вывода заявки");
	
	if($sql){
		echo 'ok';
	}
	else {
		echo 'error';
	}
	
}
?>