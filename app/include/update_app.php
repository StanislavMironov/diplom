<?php
session_start();
include ("db_connect.php");	
$sql = mysqli_query($link, "SELECT * FROM application WHERE user = '{$_SESSION['auth_id']}' ") or die("Ошибка вывода заявки");
				$row = mysqli_fetch_array($sql);
				
				if (mysqli_num_rows($sql) > 0)
				{
				echo
					'
					<div class="table__row">
			        <div class="table__column">Номер</div>
			        <div class="table__column">Название</div>
			        <div class="table__column">Автор</div>
			        <div class="table__column">Время</div>
			        <div class="table__column"></div>
					</div>';
					do {
					echo '
					 <div class="table__row">
			        <div class="table__column">'.$row["id_application"].'</div>
			        <div class="table__column">'.$row["title"].'</div>
			        <div class="table__column">'.$_SESSION['auth_name'].'</div>
			        <div class="table__column">00.00.00</div>
			        <div class="table__column table__column--function">
			        	<div class="table__func">
				        	<a href="#">
				        		<svg class="icon">
	                              <use xlink:href="#my-first-icon" />
	                            </svg>
	                        </a>

				        	<a class="delApp" onclick="return false;" href="'.$row["id_application"].'">
							</a>
			        	</div>
			        </div>
			    </div>';
				}	
					while($row = mysqli_fetch_array($sql));
				}
				else
				{
					echo '<div class="error">Заявок пока нет!</div>';
				}
?>