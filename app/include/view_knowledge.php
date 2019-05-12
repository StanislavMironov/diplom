<?php 
session_start();
include ("db_connect.php");
if(isset($_POST["num"]))
{
	$id_app = $_POST["num"];
	$num = (string)(preg_replace('|[^0-9]*|','',$id_app));
	
	$idApp = $num[0];
	$idCat = $num[1];
	$sql = mysqli_query($link, "SELECT * FROM knowledge WHERE id = '$idApp' AND category = '$idCat' ") or die("Ошибка вывода справки");
	while($row = mysqli_fetch_assoc($sql)){
		$arr[]=$row;
	}
	echo json_encode($arr, JSON_UNESCAPED_UNICODE);
	$_SESSION["id_app"] = $id_app;
}
?>