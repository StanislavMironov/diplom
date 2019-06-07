<?php 
session_start();
include ("db_connect.php");
include ('rule.php');
$appTitle = $_POST["title_app"];
$appDescription = $_POST["description_app"];
$appDate = $_POST["date_app"];
$qtyComment = $_POST["comment"];
$appComment = $_POST["add_app"] . $qtyComment;
$appPerform = $_POST["add_app"];

if(isset($_POST["progress"])){
$progressApp = $_POST["progress"];
}


if(isset($_POST["lastDate"]) && isset($_POST["categoryApp"])){
	$lastDate = $_POST["lastDate"];
	$categoryApp = $_POST["categoryApp"];
} 

$test = mysqli_query($link, "SELECT * FROM application WHERE id_application= '{$_SESSION["id_app"]}'") or die("Ошибка вывод заявки!!!");
$testRow = mysqli_fetch_array($test);
$tempUser = $_SESSION["auth_id"];

if($_POST["rezStatus"]!= null){
	$newStatus = $_POST["rezStatus"];
} else
{
	$newStatus = $testRow["status"];
}

$Manager = mysqli_query($link, "SELECT * FROM manager WHERE user = $tempUser") or die("Диспетчер не найден!");;
$rowManager = mysqli_fetch_array($Manager);


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

if(strlen($_POST["categoryApp"]) == null)
	{
		$error[]='Укажите категорию!';
	}		
	
if(strlen($_POST["rezStatus"]) == null)
	{
		$error[]='Укажите статус!';
	}		
}
	
if (count($error)) {
	$msg = implode('<br />',$error);
	echo $msg;
}
else
{	
$_SESSION["id_manager"] = $rowManager["id_manager"];

switch($temp){
	case  "Пользователь":
		$update = mysqli_query($link,"UPDATE application SET status = '$newStatus', title='$appTitle', description = '$appDescription', start_date = '$appDate', comment = '$text', department = '{$_SESSION['auth_department']}', date_last_update = NOW(), author_update = '{$_SESSION['auth_name']}' WHERE id_application= '{$_SESSION["id_app"]}' ") or die("Ошибка изменения заявки!");
	break;	

	case  "Диспетчер":
		$update = mysqli_query($link,"UPDATE application SET status = '$newStatus', title='$appTitle', description = '$appDescription', start_date = '$appDate', comment = '$text', deadline='$lastDate', category = '$categoryApp', manager = '{$rowManager["id_manager"]}', department = '{$_SESSION['auth_department']}', date_last_update = NOW(), author_update = '{$_SESSION['auth_name']}' WHERE id_application= '{$_SESSION["id_app"]}' ") or die("Ошибка изменения заявки!");
	break;	
	
	case "Исполнитель":
		$update = mysqli_query($link,"UPDATE application SET percent = '$progressApp', status = '$newStatus', title='$appTitle', description = '$appDescription', comment = '$text', department = '{$_SESSION['auth_department']}', date_last_update = NOW(), author_update = '{$_SESSION['auth_name']}' WHERE id_application= '{$_SESSION["id_app"]}' ") or die("Ошибка изменения заявки!");
	break;
}

if($newStatus == 4)
	{
		$App = mysqli_query($link, "SELECT * FROM application WHERE id_application= '{$_SESSION["id_app"]}'") or die("Ошибка вывод заявки");
		$appRow = mysqli_fetch_array($App);
		$lastDate = $appRow["date_last_update"];
		
		$update = mysqli_query($link,"UPDATE application SET deadline='$lastDate' WHERE id_application= '{$_SESSION["id_app"]}'") or die("Ошибка изменения заявки!");
	}


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