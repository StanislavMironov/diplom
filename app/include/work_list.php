<?php
session_start();
include ('rule.php');
include ("db_connect.php");	
$sum = 0;

$sql = mysqli_query($link, "SELECT * FROM application WHERE performers = '{$_SESSION["auth_name"]}'") or die("Ошибка вывода заявки");
$row = mysqli_fetch_array($sql);
$statusApp = $row["status"];

if(mysqli_num_rows($sql) > 0)
{

echo '
<div id = "msg">
Список задач
</div>

<div class="wrapper">
<div class="wrapper__title" >
Общая эффективность:
</div>

<div class="level">

<div class="progress">
<progress max="100" value="'.$_SESSION["qty_effect"] .'"></progress>
<div class="progress-value"></div>
<div class="progress-bg"><div class="progress-bar"></div></div>
</div>
</div>

</div>';

do {
$sum += $row["percent"];
$_SESSION["qty_effect"] = ceil($sum/mysqli_num_rows($sql));

switch($row["category"]){
	case 1:
		$_SESSION["tmp_category"] = "Лёгкий";
	break;
	case 2:
		$_SESSION["tmp_category"] = "Средний";
	break;
	case 3:
		$_SESSION["tmp_category"] = "Трудный";
	break;
}

echo '
<div id="workList">
<button class="knowledge__accordion progress" id="'.$row["id_application"].'">'.$row["title"].'</button>
<div class="panel_app">

<div class="workList-table">
<div class="workList-table__row">
	<div class="workList-table__column"><span>Номер:</span></div>
	<div class="workList-table__column"><span>Название:</span></div>
	<div class="workList-table__column"><span>Автор:</span></div>
	<div class="workList-table__column"><span>Дата создания:</span></div>
	<div class="workList-table__column"><span>Крайний срок:</span></div>
	<div class="workList-table__column"><span>Категория:</span></div>
	<div class="workList-table__column pr"><span>Прогресс:</span></div>
</div>	
<div class="workList-table__row">
	<div class="workList-table__column">'.$row["id_application"].'</div>
	<div class="workList-table__column title">'.$row["title"].'</div>
	<div class="workList-table__column">'.$row["initiator"].'</div>
	<div class="workList-table__column">'.$row["start_date"].'</div>
	<div class="workList-table__column">'.$row["deadline"].'</div>
	<div class="workList-table__column">'.$_SESSION["tmp_category"].'</div>
	<div class="workList-table__column">
	<div class="progress">
    <progress max="100" value="'.$row["percent"].'"></progress>
    <div class="progress-value"></div>
    <div class="progress-bg"><div class="progress-bar"></div></div>
</div>
	</div>
</div>	
</div>

</div>
</div>
';

}
while($row = mysqli_fetch_array($sql));


}



?>