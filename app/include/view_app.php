<?php 
session_start();
include ("db_connect.php");
if(isset($_POST["num"]))
{
	$id_app = $_POST["num"];
	$sql = mysqli_query($link, "SELECT * FROM application WHERE id_application = $id_app ") or die("Ошибка вывода заявки");
	while($row = mysqli_fetch_assoc($sql)){
	
	if(isset($row["date_last_update"])){
		$datesLastUpdate = $row["date_last_update"];
		$datesLastUpdate = strtotime($datesLastUpdate);
		$datesLastUpdate = date("Y-m-d\TH:i",$datesLastUpdate);
		$row["date_last_update"] = $datesLastUpdate;
	}
	
	$dates = $row["start_date"];
	$dates = strtotime($dates);
	$dates = date("Y-m-d\TH:i",$dates);
	$row["start_date"] = $dates;
	
	$timeWork = $row["spent_time"];
	$endWork = $row["deadline"];
	
	if (strtotime($endWork) <= strtotime($timeWork)){
      $row["temp"] = "Error";
	  $deadline = strtotime($timeWork);
	  $deadline =  date("Y-m-d\TH:i", $deadline);
	  $row["finishing"] = $deadline;
	}
	else
	{
		$row["temp"] = "Good";
	}
		
		$arr[]=$row;
	}
	echo json_encode($arr, JSON_UNESCAPED_UNICODE);
	
	$_SESSION["id_app"] = $id_app;
}
?>