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
					switch ($_SESSION['auth_access']) {
					case '1':
					  $temp = "Пользователь";
					  break;
					case '2':
					  $temp = "Исполнитель";
					  break;
					case '3':
					  $temp = "Диспетчер";
					  break;
  }
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
				<div>
					<div><a href="#">Заявка № 266 : Проверка работы техники</a></div>
				</div>
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
				<div>
					<div><a href="#">Задач нет</a></div>
				</div>
			</div>				
		</div>