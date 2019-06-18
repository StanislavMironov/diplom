<?php 
session_start();
include ("db_connect.php");
include ('rule.php');

switch ($temp) {

	case "Пользователь":
		echo '
			<div>
			<div><a href="#">Задач нет.</a></div>
			</div>
		';
	break;
	
	case "Исполнитель":
		$getApp = mysqli_query($link, "SELECT * FROM application WHERE performers =  '{$_SESSION["auth_name"]}' AND NOT status = 3") or die();
		if(mysqli_num_rows($getApp) > 0){
		while($row = mysqli_fetch_array($getApp)){
		echo '
			 <div>
			 <div><a href="#" class="myApp">Заявка № '.$row["id_application"].' : '.$row["title"].'</a></div>
			 </div>
			 ';
		}	 
		}
		else
		{
			echo '
				<div>
				<div><a href="#">Задач нет.</a></div>
				</div>
				';
		}
	break;
	
	case "Диспетчер":
	echo '
			<div>
			<div><a href="#">Задач нет.</a></div>
			</div>
	';
	break;
	
	case "Руководитель":
		echo '
			<div>
			<div><a href="#">Задач нет.</a></div>
			</div>
		';
	break;
	
		case "Администратор":
		echo '
			<div>
			<div><a href="#">Задач нет.</a></div>
			</div>
		';
	break; 
}
?>