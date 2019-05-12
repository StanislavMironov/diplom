<?php
session_start();
include ("db_connect.php");	
$sql = mysqli_query($link, "SELECT * FROM application WHERE user = '{$_SESSION['auth_id']}' ") or die("Ошибка вывода заявки");
$row = mysqli_fetch_array($sql);
$statusApp = $row["status"];

switch($statusApp){
	case 0:
		$_SESSION["statusApp"] = "Открыта";
	break;
	case 1:
		$_SESSION["statusApp"] = "Назначен исполнитель";
	break;
	case 2:
		$_SESSION["statusApp"] = "На исполнении";
	break;
	case 3:
		$_SESSION["statusApp"] = "Закрыта";
	break;
}


if (mysqli_num_rows($sql) > 0)
{
echo
	'
	<div class="table__row">
	<div class="table__column">Номер</div>
	<div class="table__column">Название</div>
	<div class="table__column">Автор</div>
	<div class="table__column">Дата</div>
	<div class="table__column">Статус</div>
	<div class="table__column"></div>
	</div>';
	do {
	echo '
	 <div class="table__row">
	<div class="table__column">'.$row["id_application"].'</div>
	<div class="table__column">'.$row["title"].'</div>
	<div class="table__column">'.$_SESSION['auth_name'].'</div>
	<div class="table__column">'.$row["start_date"].'</div>
	<div class="table__column">Открыта</div>
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