<?php
$_SESSION['auth'] = 'no_auth';
include ("db_connect.php");
include ("../functions/functions.php");

global $temp;
$login = clear_string($link, $_POST["login"]);
$pass = md5($_POST["pass"]);
$pass = strrev($pass);
$pass = "n".$pass."z";

$result = mysqli_query($link, "SELECT * FROM user WHERE login='$login' AND pass = '$pass'")or die("Ошибка!");
if (mysqli_num_rows($result) > 0)
{
$row = mysqli_fetch_array($result);
	session_start();
			$_SESSION['auth'] = 'yes_auth';
			$_SESSION['auth_id'] = $row["id_user"];
			$_SESSION['auth_pass'] = $row["pass"];
			$_SESSION['auth_login'] = $row["login"];
			$_SESSION['auth_surname'] = $row["second_name"];
			$_SESSION['auth_name'] = $row["first_name"];
			$_SESSION['auth_patronymic'] = $row["last_name"];
			$_SESSION['auth_email'] = $row["email"];
			$_SESSION['auth_phone'] = $row["phone"];
			$_SESSION['auth_access'] = $row["access"];
			$_SESSION['auth_img'] = $row["img"];
			$_SESSION['auth_department'] = $row["department"];
			echo 'yes_auth';	
}else
{
echo 'no_auth';
}


?>