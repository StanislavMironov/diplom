<?php
	session_start();
	include("../include/db_connect.php");
	include ("../functions/functions.php");
	$error = array();
	$surname = $_POST['reg_surname'];
	$name = $_POST['reg_name'];
	$patronymic = $_POST['reg_patronymic'];
	$email = $_POST['reg_email'];
	$phone = $_POST['reg_phone']; 
	$access = $_POST['rez'];
	
	$error_img = array();
	

	if(isset($_POST['reg_login']) && isset($_POST['reg_pass'])){
	$login = $_POST['reg_login'];
	$pass = $_POST['reg_pass'];

	$pass = iconv("UTF-8","windows-1251", strtolower(clear_string($link, $_POST['reg_pass'])));
	$pass = md5($pass);
	$pass = strrev($pass);
	$pass = "n".$pass."z";

	$ip = $_SERVER['REMOTE_ADDR'];
	$result = mysqli_query($link, "SELECT login FROM user WHERE login='$login' AND pass = '$pass'")or die("Ошибка запроса регистрации!");
	if(mysqli_num_rows($result) > 0)
	{
	$msg = 'Логин занят!';
	echo $msg;
	}else
	{
	if(@$_FILES['upload_image']['error'] > 0){
		switch ($_FILES['upload_image']['error'])
		{
		case 1: $error_img[] = 'Размер файла превышает допустимое значение UPLOAD_MAX_FILE_SIZE'; break;
		case 2: $error_img[] = 'Не удалось загрузить часть файла'; break;
		case 3: $error_img[] = 'Файл не был загружен'; break;
		}
	} else
	{
	//проверяем расширения
		if(@$_FILES['upload_image']['type'] == 'image/jpeg' || @$_FILES['upload_image']['type'] == 'image/jpg' || @$_FILES['upload_image']['type'] == 'image/png')
		{
			$imgext = strtolower(preg_replace("#.+\.([a-z]+)$#i", "$1", $_FILES['upload_image']['name']));
			//Папка для загрузки
			$uploaddir = '../uploads_images/';
			//Новое название файла
			$newfilename = rand(10,100).'.'.$imgext;
			//Путь к файлу (папка,файл)
			$uploadfile = $uploaddir.$newfilename;
		
		//Загружаем файл
		if(move_uploaded_file(@$_FILES['upload_image']['tmp_name'], $uploadfile))
		{
			$sql = mysqli_query($link, "INSERT INTO user (second_name, first_name, last_name, email, phone, login, pass, access, img) VALUES('$surname', '$name', '$patronymic', '$email', '$phone', '$login', '$pass', '$access', '$newfilename')")or die("Ошибка запроса регистрации(Пользователь не создан)!") or die("Ошибка!");
		}
		}else
		{
			$error_img[] = 'Допустимые расширения: jpeg, jpg, png';
		}
	}
	}
	}//$sql = mysqli_query($link, "INSERT INTO test (access) VALUES('$access')")or die("Ошибка запроса регистрации(Пользователь не создан)!");
?>