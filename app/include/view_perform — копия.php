<?php 
session_start();
include ("db_connect.php");
	$sum = 0;
	$sqlPerf = mysqli_query($link, "SELECT * FROM performer") or die("Ошибка вывода исполнителей!");
	$rowPerf = mysqli_fetch_array($sqlPerf);
	
	$sql = mysqli_query($link, "SELECT * FROM application WHERE performers = '{$rowPerf["first_name"]}'") or die("Ошибка");
	$row = mysqli_fetch_array($sql);
	
	do	
	{
		$sum += $row["percent"];
		$qty_effect = ceil($sum/mysqli_num_rows($sql));
	}
	while($row = mysqli_fetch_array($sql));
	
	if(mysqli_num_rows($sqlPerf) > 0){
	echo '
		<div class="table__row">
		<div class="table__column">Исполнители</div>
		<div class="table__column">Задачи</div>
		<div class="table__column">Эффективность</div>
		<div class="table__column">Действия</div>
		</div>
	';
		do {
		$qtyTask = mysqli_query($link, "SELECT COUNT(id_application) FROM application WHERE performers = '{$rowPerf["first_name"]}'") or die("Ошибка вывода количества задач!");
		$rowQty = mysqli_fetch_array($qtyTask);
			echo '
			<div class="table__row">
			<div class="table__column">
			'.$rowPerf["first_name"].'
			</div>
			<div class="table__column" id="countTask">
			'.$rowQty["COUNT(id_application)"].'
			</div>
			<div class="table__column">
			<div class="level">
		    <div class="progress">
			<progress max="100" value="'.$qty_effect .'"></progress>
			<div class="progress-value"></div>
			<div class="progress-bg"><div class="progress-bar"></div></div>
			</div>      
			</div>  			
			</div>
			<div class="table__column">
			<a id = "hPerform" onclick="return false;" href="'.$rowPerf["first_name"].'">Выбрать</a>
			</div>
			</div>';
		}
	while($rowPerf = mysqli_fetch_array($sqlPerf));
	}
?>