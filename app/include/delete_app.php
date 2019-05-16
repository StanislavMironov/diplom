<?php
session_start();
include ("db_connect.php");
if(isset($_POST["aD"]))
{
	$id_app = $_POST["aD"];
	
	$sql2 = mysqli_query($link, "SELECT * FROM application WHERE user = '{$_SESSION['auth_id']}' ") or die("Ошибка вывода заявки");
	$sql = mysqli_query($link, "DELETE FROM application WHERE id_application = '{$id_app}'") or die("Ошибка удаления заявки!");
	$_SESSION["id_app"] = $id_app;
	
	if (mysqli_num_rows($sql2) > 0 && $sql  == true)
	{
		echo "ok";
	}else
	{
		echo '<div class="error">Заявок нет!</div>';
	}
	
}

?>