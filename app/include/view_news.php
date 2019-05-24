<?php 
session_start();
include ("db_connect.php");
if(isset($_POST["hrefNum"]))
{
	$id_app = $_POST["hrefNum"];
	
	$sql = mysqli_query($link, "SELECT * FROM news WHERE id = '$id_app'") or die("Ошибка вывода новостей!");
	while($row = mysqli_fetch_assoc($sql)){
		$arr[]=$row;
	}
	echo json_encode($arr, JSON_UNESCAPED_UNICODE);
}
?>