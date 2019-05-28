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
				case '4':
					$temp = "Руководитель";
				break;
				case '5':
					$temp = "Администратор";
				break;
			}
	
?>