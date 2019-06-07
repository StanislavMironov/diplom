<?php
session_start();
include ("db_connect.php");
if(isset($_POST["aD"]))
{
	$id_app = $_POST["aD"];
	
	$sqlApp = mysqli_query($link, "SELECT * FROM application WHERE user = '{$_SESSION['auth_id']}' AND id_application = '{$id_app}'") or die("Ошибка вывода заявки");
	$row = mysqli_fetch_array($sqlApp);
	
	print_r($row);
	
	if(empty($row['manager']) == true) {
		$row['manager'] = 0;
	}
	elseif (empty($row['date_last_update']) == true){
		$row['date_last_update'] = $row['start_date'];
	}
	elseif (empty($row['author_update']) == true) {
		$row['author_update'] = $_SESSION["auth_name"];
	}
	if (($row['deadline'] == null) || empty($row['deadline'] == true) || ($row['deadline'] == 0) || ($row['deadline'] == "")) {
		$row['deadline'] = $row['start_date'];
	}
	if (empty($row['performers'] == true)) {
		$row['performers'] = "Нет";
	}
	$row['status'] = 4;
	
	if(mysqli_num_rows($sqlApp) > 0){
	do {
		$addArchive = mysqli_query($link, "INSERT INTO archive (id_application, department, date_last_update, start_date, initiator, author_update, deadline, status, performers, user, description, title) VALUES ('{$row['id_application']}', '{$row['department']}', NOW() , '{$row['start_date']}', '{$row['initiator']}', '{$row['author_update']}', '{$row['deadline']}', '{$row['status']}', '{$row['performers']}', '{$row['user']}', '{$row['description']}', '{$row['title']}')")or die("Ошибка перемещения!");
	}
	while($row = mysqli_fetch_array($sqlApp));
	}
	 else 
	{
		echo 'Error';
	}
	

//$addArchive = mysqli_query($link, "INSERT INTO archive (id_application, department, manager, title, description, start_date, initiator, date_last_update, author_update, category, deadline, status, performers, spent_time, user) VALUES ('{$row['id_application']}', '{$row['department']}', '{$row['manager']}', '{$row['title']}', '{$row['description']}', '{$row['start_date']}', '{$row['initiator']}', '{$row['date_last_update']}', '{$row['author_update']}', '{$row['category']}', '{$row['deadline']}', 4, '{$row['performers']}', '{$row['spent_time']}', '{$row['user']}')")or die("Ошибка перемещения!");


if($addArchive){
	
	$sql2 = mysqli_query($link, "SELECT * FROM application WHERE user = '{$_SESSION['auth_id']}' ") or die("Ошибка вывода заявки");
	$sql = mysqli_query($link, "DELETE FROM application WHERE id_application = '{$id_app}'") or die("Ошибка удаления заявки!");
	$_SESSION["id_app"] = $id_app;
	
	if (mysqli_num_rows($sql2) > 0 && $sql  == true)
	{
		echo "ok";
	}else
	{
		echo '<div class="error">Заявок нет!</div>';
	}
	} else 
	{
		echo 'Error';
	} 
	
	
	
	
	
	
	}

?>