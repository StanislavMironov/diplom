<?php 
session_start();
include ("db_connect.php");
include ('rule.php');

switch ($temp) {

case "Пользователь":
	$result = mysqli_query($link, "SELECT * FROM application WHERE initiator =  '{$_SESSION["auth_name"]}'");
	if(mysqli_num_rows($result) > 0){
		while($row = mysqli_fetch_array($result)){
			echo '<div>
				  <div><a href="#" class="myApp" article = "'.$row["title"].'" title="'.$row["title"].'">Заявка № '.$row["id_application"].' : '.$row["title"].'</a></div>
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
	
case "Исполнитель":
	$result = mysqli_query($link, "SELECT * FROM application WHERE initiator =  '{$_SESSION["auth_name"]}' AND user = '{$_SESSION["auth_id"]}'");
	if(mysqli_num_rows($result) > 0){
		while($row = mysqli_fetch_array($result)){
			echo '<div>
				 <div><a href="#" class="myApp" article = "'.$row["title"].'" title="'.$row["title"].'">Заявка № '.$row["id_application"].' : '.$row["title"].'</a></div>
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
if(isset($_SESSION["id_manager"]))
	{
	$result = mysqli_query($link, "SELECT * FROM application WHERE manager =  '{$_SESSION["id_manager"]}'");
	if(mysqli_num_rows($result) > 0){
	while($row = mysqli_fetch_array($result)){
		echo '<div>
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
	
case "Руководитель":
	
break;

case "Администратор":
		$result = mysqli_query($link, "SELECT * FROM application WHERE initiator =  '{$_SESSION["auth_name"]}'");
	if(mysqli_num_rows($result) > 0){
		while($row = mysqli_fetch_array($result)){
			echo '<div>
				  <div><a href="#" class="myApp" article = "'.$row["title"].'" title="'.$row["title"].'">Заявка № '.$row["id_application"].' : '.$row["title"].'</a></div>
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
}
?>