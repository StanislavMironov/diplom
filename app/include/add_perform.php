<?php 
session_start();
include ("db_connect.php");
if(isset($_POST["num"]))
{
	$id_app = $_POST["num"];
	$sql = mysqli_query($link, "UPDATE application SET performers = '$id_app' WHERE id_application= '{$_SESSION["id_app"]}'  ") or die("Ошибка вывода заявки");
	$sqlPerf = mysqli_query($link, "SELECT * FROM performer WHERE first_name = '$id_app' ") or die("Ошибка вывода заявки");

	while($row = mysqli_fetch_assoc($sqlPerf)){
		$arrPerf[] = $row;
	}
	echo json_encode($arrPerf, JSON_UNESCAPED_UNICODE);

}
?>