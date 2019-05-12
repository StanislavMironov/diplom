<?php 
session_start();
include ("db_connect.php");
if(isset($_POST["num"]))
{
	$id_app = $_POST["num"];
	$sql = mysqli_query($link, "SELECT * FROM application WHERE user = '{$_SESSION['auth_id']}' AND id_application = $id_app ") or die("Ошибка вывода заявки");
	while($row = mysqli_fetch_assoc($sql)){
		$arr[]=$row;
	}
	echo json_encode($arr, JSON_UNESCAPED_UNICODE);
	
	$_SESSION["id_app"] = $id_app;
}
?>