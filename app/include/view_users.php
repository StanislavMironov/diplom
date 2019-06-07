<?php 
session_start();
include ("db_connect.php");

	echo '
		<div>
		<button class="setting__accordion">
		Пользователи
		</button>
		<div class="panel">';
		$sql = mysqli_query($link, "SELECT * FROM user WHERE access = 1");
		$row = mysqli_fetch_array($sql);
		if (mysqli_num_rows($sql) > 0){
		
		echo '
		<div class="table">
		<div class="table__row">
		<div class="table__column td">
		Номер
		</div>
		<div class="table__column">
		ФИО
		</div>
		<div class="table__column">
		Email
		</div>
		<div class="table__column">
		Отдел
		</div>
		</div>';
		}
		
		$sql = mysqli_query($link, "SELECT * FROM user WHERE access = 1");
		$row = mysqli_fetch_array($sql);
		if (mysqli_num_rows($sql) > 0)
		{
			do {
			switch($row["department"]){
			case 1:
				$tmp_department = "Отдел кадров";
			break;
			case 2:
				$tmp_department  = "Транспортный отдел";
			break;
			case 3:
				$tmp_department  = "Финансовый отдел";
			break;
			case 4:
				$tmp_department  = "Отдел продаж";
			break;
			case 5:
				$tmp_department  = "Отдел закупок";
			break;
			case 6:
				$tmp_department  = "Отдел маркетинга";
			break;
			case 7:
				$tmp_department  = "Отдел рекламы";
			break;
			case 8:
				$tmp_department  = "Технический отдел";
			break;
			}
			echo '
				<div class="table__row">
				<div class="table__column td">
				'.$row["id_user"].'
				</div>
				<div class="table__column">
				'.$row["second_name"].' '.$row["first_name"].' '.$row["last_name"].'
				</div>
				<div class="table__column">
				'.$row["email"].'
				</div>
				<div class="table__column">
				'.$tmp_department.'
				</div>
				<div class="table__column">
				<a onclick="return false;" href="'.$row["id_user"].'" class="link" >Удалить</a>
				</div>
				</div>
			';
			
			} while($row = mysqli_fetch_array($sql));
		}
		else 
		{
			echo 'Нет';
		}
		echo '
		</div>
		</div>
		</div>';
		
			echo '
		
		<div>
		<button class="setting__accordion">
		Исполнители
		</button>
		<div class="panel">';
		$sql = mysqli_query($link, "SELECT * FROM user WHERE access = 2");
		$row = mysqli_fetch_array($sql);
		if (mysqli_num_rows($sql) > 0){
		echo '
		<div class="table">
		<div class="table__row">
		<div class="table__column td">
		Номер
		</div>
		<div class="table__column">
		ФИО
		</div>
		<div class="table__column">
		Email
		</div>
		<div class="table__column">
		Отдел
		</div>
		</div>';
		}
	$sql = mysqli_query($link, "SELECT * FROM user WHERE access = 2");
	$row = mysqli_fetch_array($sql);
	if (mysqli_num_rows($sql) > 0)
	{
		do {
		switch($row["department"]){
			case 1:
				$tmp_department = "Отдел кадров";
			break;
			case 2:
				$tmp_department  = "Транспортный отдел";
			break;
			case 3:
				$tmp_department  = "Финансовый отдел";
			break;
			case 4:
				$tmp_department  = "Отдел продаж";
			break;
			case 5:
				$tmp_department  = "Отдел закупок";
			break;
			case 6:
				$tmp_department  = "Отдел маркетинга";
			break;
			case 7:
				$tmp_department  = "Отдел рекламы";
			break;
			case 8:
				$tmp_department  = "Технический отдел";
			break;
			}
		echo '
			<div class="table__row">
			<div class="table__column td">
			'.$row["id_user"].'
			</div>
			<div class="table__column">
			'.$row["second_name"].' '.$row["first_name"].' '.$row["last_name"].'
			</div>
			<div class="table__column">
				'.$row["email"].'
			</div>
			<div class="table__column">
			'.$tmp_department.'
			</div>
			<div class="table__column">
			<a onclick="return false;" href="'.$row["id_user"].'" class="link">Удалить</a>
			</div>
			</div>
		';
		
		} while($row = mysqli_fetch_array($sql));
	}
	else 
		{
			echo 'Нет';
		}
	echo '</div>
	</div>
	</div>';
		
	echo '
	<div>
	<button class="setting__accordion">
	Диспетчеры
	</button>
	<div class="panel">';
	$sql = mysqli_query($link, "SELECT * FROM user WHERE access = 3");
	$row = mysqli_fetch_array($sql);
	if (mysqli_num_rows($sql) > 0){
	echo '
	<div class="table">
	<div class="table__row">
	<div class="table__column td">
	Номер
	</div>
	<div class="table__column">
	ФИО
	</div>
	<div class="table__column">
	Email
	</div>
	<div class="table__column">
	Отдел
	</div>
	</div>';
	}
	$sql = mysqli_query($link, "SELECT * FROM user WHERE access = 3");
	$row = mysqli_fetch_array($sql);
	if (mysqli_num_rows($sql) > 0)
	{
		do {
		switch($row["department"]){
			case 1:
				$tmp_department = "Отдел кадров";
			break;
			case 2:
				$tmp_department  = "Транспортный отдел";
			break;
			case 3:
				$tmp_department  = "Финансовый отдел";
			break;
			case 4:
				$tmp_department  = "Отдел продаж";
			break;
			case 5:
				$tmp_department  = "Отдел закупок";
			break;
			case 6:
				$tmp_department  = "Отдел маркетинга";
			break;
			case 7:
				$tmp_department  = "Отдел рекламы";
			break;
			case 8:
				$tmp_department  = "Технический отдел";
			break;
			}
		echo '
			<div class="table__row">
			<div class="table__column td">
			'.$row["id_user"].'
			</div>
			<div class="table__column">
			'.$row["second_name"].' '.$row["first_name"].' '.$row["last_name"].'
			</div>
			<div class="table__column">
			'.$row["email"].'
			</div>
			<div class="table__column">
			'.$tmp_department.'
			</div>
			<div class="table__column">
			<a onclick="return false;" class ="link" href="'.$row["id_user"].'">Удалить</a>
			</div>
			</div>
		';
		
		} while($row = mysqli_fetch_array($sql));
	}
	else 
		{
			echo 'Нет';
		}
	echo '
	</div>
	</div>
	</div>
	';	
	
?>