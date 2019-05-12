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
						Тестовый текст
					</div>	
					</div>
				</div>
			</div>
			<div class="main-right__item">
				<div>
					<?php
						if(@$_SESSION['auth'] == 'yes_auth'){
							echo '<p id="main-right__title"><img class="test" src="./img/icons/avatar.png" /><span>'.$temp.'</span></p>';
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
						Тестовый текст
					</div>	
					</div>
				</div>
			</div>
			<div class="main-right__item">
			<?php 
				if($temp == "Пользователь")
				{
					echo '
						<div>
						<div><a href="#">Заявок нет.</a></div>
						</div>
					';
				}
				else
				{
					echo '<div>
						 <div><a href="#">Заявка № 266 : Проверка работы техники</a></div>
						 </div>
						 ';
				
				}
			?>
			</div>

			<div class="main__title" data-tooltip="Всплывающая подсказка">
			Поставленные задачи:
			<div class="helper">
					<div class="mes">
					<img src="./img/icons/question-mark.svg">
					<div class="mes__info">
						Тестовый текст
					</div>	
					</div>
				</div>
			</div>
			<div class="main-right__item">
				<?php 
				if($temp == "Пользователь")
				{
					echo '
						<div>
						<div><a href="#">Задач нет.</a></div>
						</div>
					';
				}
				else
				{
					echo '<div>
						 <div><a href="#">Заявка № 266 : Проверка работы техники</a></div>
						 </div>
						 ';
				
				}
			?>
			</div>				
		</div>