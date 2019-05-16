<?php 
session_start();
include ("db_connect.php");
if(isset($_POST["num"]))
{
	$id_app = $_POST["num"];
	$sql = mysqli_query($link, "SELECT * FROM application WHERE id_application = $id_app ") or die("Ошибка вывода заявки");
	while($row = mysqli_fetch_assoc($sql)){
	
	
	$dates = $row["start_date"];
	$dates = strtotime($dates);
	$dates = date("Y-m-d\TH:i",$dates);
	
	
	$lastDate = $row["deadline"];
	$lastDate = strtotime($lastDate);
	$lastDate = date("Y-m-d\TH:i",$lastDate);
	
	$row["start_date"] = $dates;
	$row["deadline"] = $lastDate;
	
		$arr[]=$row;
	}
	echo json_encode($arr, JSON_UNESCAPED_UNICODE);
	
	$_SESSION["id_app"] = $id_app;
}
?>