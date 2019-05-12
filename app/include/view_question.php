<?php 
session_start();
include ("db_connect.php");
if(isset($_POST["idBlock"]))
{
	$idBlock = $_POST["idBlock"];

	$sql = mysqli_query($link, "SELECT * FROM knowledge WHERE category = '$idBlock' ") or die("Ошибка вывода справки");
	$row = mysqli_fetch_array($sql);
	
	if (mysqli_num_rows($sql) > 0)
		{
			do {
				echo '<a class="knowledge__link" href="?idQu = '.$row["id"].'&idCat = '.$row["category"].'"  onclick="return false;"><p>'.$row["title"].'</p></a>';
			}	
	while($row = mysqli_fetch_array($sql));
		}else {
			echo '<div class="error">Вопросов пока нет!</div>';
		}
}
?>