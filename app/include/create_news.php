<?php
session_start();
include ("db_connect.php");
if (isset($_POST["news_title"]) && isset($_POST["news_description"]))
{
	$title = trim($_POST["news_title"]);
	$description = trim($_POST["news_description"]); 
	
	$error = array();
	if(strlen($_POST["news_title"]) < 15 || strlen($_POST["news_title"]) > 50)
		{
			$error[]='Укажите название от 15 до 50 символов!';
		}
		
		if (count($error))
		{
			$msg = implode('<br />',$error);
			echo $msg;
		}else
		{
			$_SESSION['msg'] = "<p align='left' id='form-success'>Новость успешно создана!</p>";
			
			$sql = mysqli_query($link, "INSERT INTO news (title, description, period) VALUES ('$title', '$description', NOW())")or die("Ошибка создания новости!");
			echo 'ok';
		}
}
else
{
	echo 'error';
}

?>