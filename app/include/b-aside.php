<?php
	include ('rule.php');
?>
		<div class="main-right">
			<div class="main__title">
				Ваша роль:
				<div class="helper">
					<div class="mes">
					<img src="./img/icons/question-mark.svg">
					<div class="mes__info">
						Права доступа
					</div>	
					</div>
				</div>
			</div>
			<div class="main-right__item">
				<div>
					<?php
						if(@$_SESSION['auth'] == 'yes_auth'){
							echo '<p class="main-right__title"><img class="test" src="./img/icons/avatar.png" /><span>'.$temp.'</span></p>';
						}else 
						{
							echo "Тест";
						}
					?>
				</div>
			</div>

			<div class="main__title">
				Полученные задачи: 
				<div class="helper">
					<div class="mes">
					<img src="./img/icons/question-mark.svg">
					<div class="mes__info">
						Задачи для выполнения
					</div>	
					</div>
				</div>
			</div>
			<div class="main-right__item" id="getTask">
			
			</div>

			<div class="main__title" data-tooltip="Всплывающая подсказка">
			Поставленные задачи:
			<div class="helper">
					<div class="mes">
					<img src="./img/icons/question-mark.svg">
					<div class="mes__info">
						Ваши задачи
					</div>	
					</div>
				</div>
			</div>
			<div class="main-right__item" id="giveTask">
				<?php 
			/* 	if($temp == "Пользователь")
				{
				$result = mysqli_query($link, "SELECT * FROM application WHERE initiator =  '{$_SESSION["auth_name"]}'");
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
				else if ($temp == "Диспетчер")
				{
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
				}
				else
				{
					echo '
						<div>
						<div><a href="#">Задач нет.</a></div>
						</div>
					';
				} */
			?>
			</div>				
		</div>