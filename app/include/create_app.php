<?php
session_start();
include ("db_connect.php");
include ('rule.php');
global $lastname;
$lastname = '';
$title = trim($_POST["description"]);
$description = trim($_POST["full_text"]); 

$category_app = $_POST["rez"];


$error = array();

if(strlen($_POST["description"]) < 25 || strlen($_POST["description"]) > 95)
	{
		$error[]='Укажите краткое описание от 35 до 50 символов!';
	}

if (count($error))
{
	$msg = implode('<br />',$error);
	echo $msg;
}else
{
	$_SESSION['msg'] = "<p align='left' id='form-success'>Заявка успешно создана!</p>";
	
	
	if($_FILES['upload_image']['type'] == 'image/jpeg' || $_FILES['upload_image']['type'] == 'image/jpg' || $_FILES['upload_image']['type'] == 'image/png')
{
	$imgext = strtolower(preg_replace("#.+\.([a-z]+)$#i", "$1", $_FILES['upload_image']['name']));
	//Папка для загрузки
	$uploaddir = '../application_images/';
	//Новое название файла
	$newfilename = rand(10,100).'.'.$imgext;
	
	$lastname = $newfilename;
	//Путь к файлу (папка,файл)
	$uploadfile = $uploaddir.$newfilename;

 move_uploaded_file($_FILES['upload_image']['tmp_name'], $uploadfile);
}else
{
	$error_img[] = 'Допустимые расширения: jpeg, jpg, png';
}


switch($category_app){
	case 1:
		$timeForWork = '00:30:00';
	break;
	
	case 2:
		$timeForWork = '01:30:00';
	break;
}


if($temp == "Исполнитель"){
$sql = mysqli_query($link, "INSERT INTO application (department, title, description, attachment, user, start_date, initiator, performers, category_app, deadline) VALUES ('{$_SESSION['auth_department']}', '$title', '$description', '$lastname', '{$_SESSION['auth_id']}', NOW(), '{$_SESSION['auth_name']}','{$_SESSION['auth_name']}', '$category_app', '$timeForWork')")or die("Ошибка создания заявки!");
}
else{
$sql = mysqli_query($link, "INSERT INTO application (department, title, description, attachment, user, start_date, initiator, category_app, deadline) VALUES ('{$_SESSION['auth_department']}', '$title', '$description', '$lastname', '{$_SESSION['auth_id']}', NOW(), '{$_SESSION['auth_name']}', '$category_app', '$timeForWork')")or die("Ошибка создания заявки!");
}
echo 'create';
}
?>