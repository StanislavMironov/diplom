<?php
if($_SERVER["REQUEST_METHOD"] == "POST")
{
include["db_connect"];
include["../functions/functions.php"];
$email = clear_string($_POST["email"]);

if ($email != "")
   {
	$result = mysqli_query($link, "SELECT email FROM user WHERE email='$email'")or die("Ошибка запроса восстановления!");
	if(mysqli_num_rows($result) > 0)
	  {
	//Генерация пароля.
		$newpass = fungenpass();
	//Шифрование пароля.
		$pass = md5($newpass);
		$pass = strrev($pass);
		$pass = "n".$pass."z";
		
	//Обновление пароля	на новый
	
	$update = mysqli_query($link,"UPDATE user SET pass='$pass' WHERE email='$email'");
	
	//Отправка нового пароля
	
	send_mail( 'SmartAssistant("Ситилинк")',
				$email,
				'Новый пароль для SmartAssistant',
				'Ваш пароль: '.$newpass);
		
		echo 'yes';		
	  }else
	  {
		echo 'Данный email не найден!';
	  }
    }
}
?>