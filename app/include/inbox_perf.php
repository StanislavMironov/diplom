<?php
session_start();
include ('rule.php');
include ("db_connect.php");	
$sql = mysqli_query($link, "SELECT * FROM application WHERE performers = $_SESSION['auth_name']") or die("Ошибка вывода заявки");
$row = mysqli_fetch_array($sql);
$statusApp = $row["status"];

if (mysqli_num_rows($sql) > 0)
{
echo
	'
	<div class="table__row">
	<div class="table__column">Номер</div>
	<div class="table__column">Название</div>
	<div class="table__column">Автор</div>
	<div class="table__column">Дата создания</div>';
	
	if($temp != "Пользователь"){
		echo '
			<div class="table__column">Время на выполнение:</div>
			';
	}	
	
echo	'
		<div class="table__column">Статус</div>
		<div class="table__column"></div>
		</div>';
	do {
		switch($row["status"]){
	case 0:
		$_SESSION["statusApp"] = "Открыта";
	break;
	case 1:
		$_SESSION["statusApp"] = "Назначен исполнитель";
	break;
	case 2:
		$_SESSION["statusApp"] = "Исполняется";
	break;
	case 3:
		$_SESSION["statusApp"] = "На проверке";
	break;
	case 4:
		$_SESSION["statusApp"] = "Закрыта";
	break;
}
	echo '
	 <div class="table__row">
	<div class="table__column"><span>Номер: </span>'.$row["id_application"].'</div>
	<div class="table__column"><span>Название: </span>'.$row["title"].'</div>
	<div class="table__column"><span>Автор: </span>'.$row["initiator"].'</div>
	<div class="table__column"><span>Дата создания: </span>'.$row["start_date"].'</div>';
	
	if($temp != "Пользователь"){
	echo '
		<div class="table__column"><span>Время на выполнение: </span>'.$row["deadline"].'</div>
		';
	}	
	
	echo '
	<div class="table__column"><span>Статус: </span>'.$_SESSION["statusApp"].'</div>
	<div class="table__column table__column--function">
		<div class="table__func">
			<a class="editApp" onclick="return false;" href="'.$row["id_application"].'">
				<svg class="icon">
				  <use xlink:href="#my-first-icon" />
				</svg>
			</a>

			<a class="delApp" onclick="return false;" href="'.$row["id_application"].'">
			</a>
		</div>
	</div>
</div>';
}	
	while($row = mysqli_fetch_array($sql));
}
else
{
	echo '<div class="error">Заявок пока нет!</div>';
}
?>