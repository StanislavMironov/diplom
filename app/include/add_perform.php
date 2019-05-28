<?php 
session_start();
include ("db_connect.php");
if(isset($_POST["num"]))
{
	$id_app = $_POST["num"];
	$sql = mysqli_query($link, "UPDATE application SET performers = '$id_app' WHERE id_application= '{$_SESSION["id_app"]}'  ") or die("Ошибка вывода заявки");
	$sqlPerf = mysqli_query($link, "SELECT * FROM performer WHERE first_name = '$id_app' ") or die("Ошибка вывода заявки");
	$_SESSION["tmp_perf"] = $id_app;
	
	$sqlPerf = mysqli_query($link, "SELECT * FROM performer") or die("Ошибка вывода исполнителей!");
	$rowPerf = mysqli_fetch_array($sqlPerf);
	$qtyTask = mysqli_query($link, "SELECT COUNT(id_application) FROM application WHERE performers = '{$rowPerf["first_name"]}'") or die("Ошибка вывода количества задач!");
	$rowQty = mysqli_fetch_array($qtyTask);
		
	while($rowPerf = mysqli_fetch_array($sqlPerf)){
		$arrPerf[] = $rowPerf;
		$arrPerf["test"] = $rowQty["COUNT(id_application)"];
	}
	echo json_encode($arrPerf, JSON_UNESCAPED_UNICODE);
}
?>