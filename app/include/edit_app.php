<?php 
session_start();
include ("db_connect.php");
include ('rule.php');
$appTitle = $_POST["title_app"];
$appDescription = $_POST["description_app"];
$appDate = $_POST["date_app"];
$qtyComment = $_POST["comment"];
$appComment = $_POST["add_app"] . $qtyComment;
$lastDate = $_POST["lastDate"];
$appPerform = $_POST["add_app"];

$newStatus = $_POST["rezStatus"];




function delete_duplicates_words($text)
{
    $text = implode(array_reverse(preg_split('//u', $text)));
    $text = preg_replace('/(\b[\pL0-9]++\b)(?=.*?\1)/siu', '', $text);
    $text = implode(array_reverse(preg_split('//u', $text)));
    return $text;
}
$text = delete_duplicates_words($appComment);

$error = array();

if(strlen($_POST["title_app"]) < 15 || strlen($_POST["title_app"]) > 85)
	{
		$error[]='Укажите краткое описание от 15 до 85 символов!';
	}
	

if($temp == "Диспетчер"){	
if(strlen($_POST["lastDate"]) == false)
	{
		$error[]='Укажите дату завершения!';
	}			
}
	
if (count($error)) {
	$msg = implode('<br />',$error);
	echo $msg;
}
else
{	
$update = mysqli_query($link,"UPDATE application SET status = '$newStatus', title='$appTitle', description = '$appDescription', start_date = '$appDate', comment = '$text', deadline='$lastDate' WHERE id_application= '{$_SESSION["id_app"]}' ") or die("Ошибка изменения заявки!");
	if ($update == true)
	{
		echo "ok";
	}
	else
	{
		echo "false";
	}
}
?>