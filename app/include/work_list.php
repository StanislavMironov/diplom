<?php
session_start();
include ('rule.php');
include ("db_connect.php");	

$sql = mysqli_query($link, "SELECT * FROM application WHERE performers = '{$_SESSION["auth_name"]}'") or die("Ошибка вывода заявки");
$row = mysqli_fetch_array($sql);
$statusApp = $row["status"];

if(mysqli_num_rows($sql) > 0)
{

echo '

<div id="workList">
<button class="knowledge__accordion progress" id="'.$row["id_application"].'">'.$row["title"].'</button>
<div class="panel_app">

<div class="workList-table">
<div class="workList-table__row">
	<div class="workList-table__column">Номер:</div>
	<div class="workList-table__column">Название:</div>
	<div class="workList-table__column">Автор:</div>
	<div class="workList-table__column">Дата создания:</div>
	<div class="workList-table__column">Крайний срок:</div>
	<div class="workList-table__column">Категория:</div>
	<div class="workList-table__column">Прогресс:</div>
</div>	
<div class="workList-table__row">
	<div class="workList-table__column">'.$row["id_application"].'</div>
	<div class="workList-table__column">'.$row["title"].'</div>
	<div class="workList-table__column">'.$row["initiator"].'</div>
	<div class="workList-table__column">'.$row["start_date"].'</div>
	<div class="workList-table__column">'.$row["deadline"].'</div>
	<div class="workList-table__column">'.$row["category"].'</div>
	<div class="workList-table__column">
	<div class="progress">
    <progress max="100" value="50"></progress>
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



?>