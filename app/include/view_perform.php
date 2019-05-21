<?php 
session_start();
include ("db_connect.php");

	$sqlPerf = mysqli_query($link, "SELECT * FROM performer") or die("Ошибка вывода исполнителей!");
	$rowPerf = mysqli_fetch_array($sqlPerf);
	$qtyTask = mysqli_query($link, "SELECT COUNT(id_application) FROM application WHERE performers = '{$rowPerf["first_name"]}'") or die("Ошибка вывода количества задач!");
	$rowQty = mysqli_fetch_array($qtyTask);
	
	
	
	if(mysqli_num_rows($sqlPerf) > 0){
	echo '
		<div class="table__row">
		<div class="table__column">Исполнители</div>
		<div class="table__column">Задачи</div>
		<div class="table__column">Действия</div>
		</div>
	';
		do {
			echo '
			<div class="table__row">
			<div class="table__column">
			'.$rowPerf["first_name"].'
			</div>
			<div class="table__column" id="countTask">
			'.$rowQty["COUNT(id_application)"].'
			</div>
			<div class="table__column">
			<a id = "hPerform" onclick="return false;" href="'.$rowPerf["first_name"].'">Выбрать</a>
			</div>
			</div>';
		}
	while($rowPerf = mysqli_fetch_array($sqlPerf));
	}
?>