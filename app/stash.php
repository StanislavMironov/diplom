<?php
	session_start();
	$title = trim($_POST["userid"]);
	$description = trim($_POST["filelabel"]); 
	$imgext = strtolower(preg_replace("#.+\.([a-z]+)$#i", "$1", $_FILES['file']['name']));
	echo $title;
	move_uploaded_file(

    // временное расположение файла
    $_FILES['file']['tmp_name'],

    // конечный путь к файлу и его название
    './uploads_images/' . $_FILES['file']['name']
);

if ( 0 < $_FILES['file']['error'] ) {
        echo 'Error: ' . $_FILES['file']['error'] . '<br>';
    }
    else {
        move_uploaded_file($_FILES['file']['tmp_name'], './uploads_images/' . $_FILES['file']['name']);
    }
?>