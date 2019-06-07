<?php
session_start();
include ("db_connect.php");
if(isset($_POST["appArch"]))
{
	$id_app = $_POST["appArch"];
	$sql = mysqli_query($link, "DELETE FROM archive WHERE id_application = '{$id_app}'") or die("Ошибка удаления заявки!");
	
	if($sql){
		echo "ok";
	} else
	{
		echo "error";
	}
}

?>