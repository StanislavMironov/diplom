<?php
include ("db_connect.php");
if(isset($_POST["aD"]))
{
	$id_app = $_POST["aD"];
	$sql = mysqli_query($link, "DELETE FROM application WHERE id_application = '{$id_app}'") or die("Ошибка удаления заявки!");
	echo "ok";
}

?>