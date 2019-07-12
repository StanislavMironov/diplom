<?php
session_start();
define( '_JEXEC', 1 );
include('functions/functions.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" href="../css/main.css">
<!--===============================================================================================-->
</head>
<body>
	<div class="auth-login" id="top">
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-50">
				
						<form class="login100-form validate-form" method="post" id="formAuth" action="javascript:void(null);" onsubmit="callauth()">
					<span class="login100-form-title p-b-33">
						Smart Assistant
					</span>
					<p id="message-auth">Неверный логин и(или) Пароль</p>
					<div class="wrap-input100">
						<input class="input100" type="text" placeholder="Логин" id="auth_login" name="login">
						<span class="focus-input100-1"></span>
						<span class="focus-input100-2"></span>
					</div>

					<div class="wrap-input100">
						<input class="input100" type="password" placeholder="Пароль" id="auth_pass" name="pass">
						<span class="focus-input100-1"></span>
						<span class="focus-input100-2"></span>
					</div>
					
					<div class="link-login">
						<a id="rise-pass" href="javascript:void(0);">Забыли пароль?</a>
					</div>
					
					<div class="container-login100-form-btn m-t-20">
						<button class="login100-form-btn" id="button-auth">
							Войти
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
<div id="popup"></div>	
<div id="block-remind" class="block-remind">
<h3 class="block-remind__title">Восстановление пароля</h3>
<p id="message-remind" class="message-remind-success"></p>
<center><input type="text" class="block-remind__input" id="remind-email" placeholder="Ваш E-mail"/></center>
<center>
<p align="right" id="button-remind"><a id="remind" href="javascript:void(0);">Готово</a></p>
</center>
<div id="popap-close"></div>
</div>
</div>	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>
	<script src="js/auth.js"></script>
	<script src="js/popap.js"></script>

</body>
</html>