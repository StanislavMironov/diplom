<?php 
include ("db_connect.php");
include ('rule.php');
?>
<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
	<link rel="stylesheet" href="css/main.css">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Главная</title>
    <meta name="author" content="Dobrovoimaster" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <link rel="shortcut icon" href="favicon.ico" />
	<script src="./js/jquery.min.js"></script>
	<script src="./js/jquery.form.js"></script>
	<script src="./js/jquery.validate.js"></script>
	<script src="./js/script.js"></script>
	

</head>
<body>
<header class="header">
	<div class="container">
	<nav>
		<div class="header__logo">
			<a class="link" href="index.php">Smart Assistent</a> 
		</div>	
		<!-- <ul class="header__menu">
		</ul>	 -->
		  <form method="get" action="/search" id="searchbox5">
        <input id="search51" name="q" type="text" size="40" placeholder="Поиск..." />
    </form>
	</nav>
	</div>
</header>
<div class="profile-menu" id="prMenu">
<div class="profile-menu__grid">
 <div class="profile-menu__item"><span>Приветствую!</span> <a class="profile-menu__link" href="javascript:void(0);"><?php echo @$_SESSION['auth_name'];?></a></div>
 <div class="profile-menu__item"><a class="profile-menu__link exit" href="profile.php">Профиль</a></div>
 <div class="profile-menu__item"><a class="profile-menu__link exit" id="logout">Выход</a></div>
</div>
<i id="tool"></i>
</div>
<script>
	let prBtn = document.getElementById("tool");
	prBtn.addEventListener('click', ()=>{
	prMenu.classList.toggle('active');
	});
	$('#logout').click(function(){
	$.ajax({
		type: "POST",
		url: "./include/logout.php",
		dataType: "html",
		cache: false,
		success: function(data) {
			if(data == 'logout')
			{
				var url = "auth/login.php";
				$(location).attr('href',url);
			}
		}
	});
}); 
</script>
<input type="checkbox" id="nav-toggle" hidden>
    <nav class="nav">
        <label for="nav-toggle" class="nav-toggle" onclick></label>
        <h2 class="logo"> 
            <a class="link link--orange" href="./index.php">Smart Assistent</a> 
        </h2>
        <ul>
		<?php
			switch($temp){
			case "Пользователь":
			echo '
				<li>
				<a href="./application.php">Заявки</a>
				</li>	
				<li>
				<a href="./knowledge.php">База знаний</a>
				</li>
				';
			break;
			
			case "Исполнитель":
			echo '
				<li>
				<a href="./application.php">Заявки</a>
				</li>	
				<li>
				<a href="./knowledge.php">База знаний</a>
				</li>
				<li>
				<a href="#">Документы</a>
				</li>
				<li>
				<a href="#">Оргструктура</a>
				</li>
				';
			break;
			
			case "Диспетчер":
			echo '
				<li>
				<a href="./application.php">Заявки</a>
				</li>	
				<li>
				<a href="./knowledge.php">База знаний</a>
				</li>
				<li>
				<a href="#">Документы</a>
				</li>
				<li>
				<a href="#">Оргструктура</a>
				</li>
				<li>
				<a href="#">Отчёты</a>
				</li>
				';
			break;
			
			case "Руководитель":
			echo '
				<li>
				<a href="#">Пользователи</a>
				</li>
				<li>
				<a href="./application.php">Заявки</a>
				</li>	
				<li>
				<a href="./knowledge.php">База знаний</a>
				</li>
				<li>
				<a href="#">Документы</a>
				</li>
				<li>
				<a href="#">Оргструктура</a>
				</li>
				<li>
				<a href="#">Отчёты</a>
				</li>
				';
			break;
			
			case "Администратор":
			echo '
				<li>
				<a href="#">Пользователи</a>
				</li>
				<li>
				<a href="#">Новости</a>
				</li>
				<li>
				<a href="./application.php">Заявки</a>
				</li>	
				<li>
				<a href="./knowledge.php">База знаний</a>
				</li>
				<li>
				<a href="#">Документы</a>
				</li>
				<li>
				<a href="#">Оргструктура</a>
				</li>
				<li>
				<a href="#">Отчёты</a>
				</li>
				<li>
				<a href="#">Настройки</a>
				</li>
				';
			break;
			}
		?>
        </ul>
    </nav>
    <main class="container">