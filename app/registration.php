<?php
	session_start();
	//define( '_JEXEC', 1 );
	
	
	//if(!$_SESSION['auth'] == "yes_auth"){	
	//if(isset($_GET["logout"]))
	//{
		//unset($_SESSION['auth']);
		//unset($_SESSION['auth_name']);
		//header("Location: auth/login.php"); 
	//}
	include ("include/header.php");
	include("include/db_connect.php");
	include ("functions/functions.php");

if (isset($_POST["CR_submit"])){
	$error = array();
	
	$surname = $_POST['reg_surname'];
	$name = $_POST['reg_name'];
	$patronymic = $_POST['reg_patronymic'];
	$email = $_POST['reg_email'];
	$phone = $_POST['reg_phone']; 
	$access = $_POST['Rule'];
	$department = $_POST['department'];
	$error_img = array();
	
	if(isset($_POST['reg_login']) && isset($_POST['reg_pass'])){
	$login = $_POST['reg_login'];
	$pass = $_POST['reg_pass'];

	$pass = iconv("UTF-8","windows-1251", strtolower(clear_string($link, $_POST['reg_pass'])));
	$pass = md5($pass);
	$pass = strrev($pass);
	$pass = "n".$pass."z";

	$ip = $_SERVER['REMOTE_ADDR'];
	$result = mysqli_query($link, "SELECT login FROM user WHERE login='$login' AND pass = '$pass'")or die("Ошибка запроса регистрации!");

	if(strlen($name) < 5 || strlen($name) > 15){
		$error[]='Укажите Имя от 5 до 15 символов!';
	}
	if(strlen($surname) < 5 || strlen($surname) > 15){
		$error[]='Укажите Фамилию от 5 до 15 символов!';
	}
	if(strlen($login) < 4 || strlen($login) > 15){
		$error[]='Укажите Логин от 4 до 15 символов!';
	}
	if(strlen($patronymic) < 10 || strlen($patronymic) > 55){
		$error[]='Укажите Отчество от 10 до 25 символов!';
	}
	if(strlen($pass) == 0){
		$error[]='Укажите Пароль!';
	}
	
	
	if (count($error))
		{
			$_SESSION['msg'] = "<p align='left' id='form_error'>".implode('<br />',$error)."</p>";
		}else
	{
	if(mysqli_num_rows($result) > 0)
	{
	$msg = 'Логин занят!';
	echo $msg;
	}else
	{
	if($_FILES['upload_image']['error'] > 0){
		switch ($_FILES['upload_image']['error'])
		{
		case 1: $error_img[] = 'Размер файла превышает допустимое значение UPLOAD_MAX_FILE_SIZE'; break;
		case 2: $error_img[] = 'Не удалось загрузить часть файла'; break;
		case 3: $error_img[] = 'Файл не был загружен'; break;
		}
	} else
	{
	//проверяем расширения
		if($_FILES['upload_image']['type'] == 'image/jpeg' || $_FILES['upload_image']['type'] == 'image/jpg' || $_FILES['upload_image']['type'] == 'image/png')
		{
		if(!isset($_FILES['upload_image']['name'])){
			$imgext = 'default.jpg';
			//Папка для загрузки
			$uploaddir = './uploads_images/';
			//Новое название файла
			$newfilename = $imgext;
			//Путь к файлу (папка,файл)
			$uploadfile = $uploaddir.$newfilename;
			echo 'Файл :' . $newfilename;
		}else{
			$imgext = strtolower(preg_replace("#.+\.([a-z]+)$#i", "$1", $_FILES['upload_image']['name']));
			//Папка для загрузки
			$uploaddir = './uploads_images/';
			//Новое название файла
			$newfilename = rand(10,100).'.'.$imgext;
			//Путь к файлу (папка,файл)
			$uploadfile = $uploaddir.$newfilename;
		}
		//Загружаем файл
		if(move_uploaded_file($_FILES['upload_image']['tmp_name'], $uploadfile))
		{
			$sql = mysqli_query($link, "INSERT INTO user (second_name, first_name, last_name, email, phone, login, pass, access, img, department) VALUES('$surname', '$name', '$patronymic', '$email', '$phone', '$login', '$pass', '$access', '$newfilename', '$department')")or die("Ошибка запроса регистрации(Пользователь не создан)!");
			
			
			if($sql == true)
			{
				$_SESSION['msg'] = "<p align='left' class='form-success'>Новый пользователь успешно создан!</p>";
				header("Location: ./setting.php");
			} else {
			 $_SESSION['msg'] = "<p align='left' class='form-error'>Ошибка!</p>";
			}
		}
		}else
		{
			$error_img[] = 'Допустимые расширения: jpeg, jpg, png';
		}
	}
	}
	}
	}
	}
	
	$users = mysqli_query($link, "SELECT * FROM user WHERE access = 2");
			while($rule = mysqli_fetch_array($users)){
					$user = $rule["id_user"];
					$sql2 = mysqli_query($link, "INSERT INTO performer (first_name, last_name, user) VALUES('{$rule["first_name"]}', '{$rule["second_name"]}', '{$rule["id_user"]}')");
			}
?>

	<div class="registration">
	<h2 class="borderTitle">Создание нового пользователя</h2>
	<?php
		if(@$_SESSION['msg'])
		{
			echo $_SESSION['msg'];
			unset($_SESSION['msg']);
		}
	?>
	<div class="registration__grid">
	<div class="registration__left">
		<div  class="registration__img">
			<img src="./img/auth.jpg" />
		</div>
	</div>
	
	<div class="registration__right">
		<form enctype='multipart/form-data' method="post" id="form_reg">
		<div id="block-form-registration">
			<ul class="registration__list">
				<li>
				<div class="field">
					<label>Логин</label>
					<span>*</span>
					<input type="text" name="reg_login" id="reg_login" />
				</div>	
				</li>
				
				<li>
				<div class="field">
					<label>Пароль</label>
					<span>*</span>
					<input type="text" name="reg_pass" id="reg_pass"  required/>
				</div>	
				</li>
				
				<li>
				<div class="field">
					<label>Фамилия</label>
					<span>*</span>
					<input type="text" name="reg_surname" id="reg_surname" />
				</div>	
				</li>
				
				<li>
				<div class="field">
					<label>Имя</label>
					<span>*</span>
					<input type="text" name="reg_name" id="reg_name" />
				</div>	
				</li>
				
				<li>
				<div class="field">
					<label>Отчество</label>
					<span>*</span>
					<input type="text" name="reg_patronymic" id="reg_patronymic" />
				</div>	
				</li>
				
				<li>
				<div class="field">
					<label>E-mail</label>
					<span>*</span>
					<input type="text" name="reg_email" id="reg_email" />
				</div>	
				</li>
				
				<li>
				<div class="field">
					<label>Телефон</label>
					<span>*</span>
					<input type="text" name="reg_phone" id="reg_phone" />
				</div>	
				</li>
				
					<li>
				<div class="field">
					<label for="info_phone">Изображение</label>
					<span>*</span>
					<input type="hidden" name="MAX_FILE_SIZE" value="5000000"/>
					<input type="file" name="upload_image" />
				</div>	
				</li>
			
			<li>	
				<div class="center-on-page">
				  <div class="select">
					<select name="sitetime" id="sitetime" onchange="document.getElementById('Rule').value=value">
					  <option value="" >Выберите роль</option>
					  <option value="1" >Пользователь</option>
					  <option value="2" >Исполнитель</option>
					  <option value="3" >Диспетчер</option>
					  <option value="4" >Руководитель</option>
					  <option value="5" >Администратор</option>
					</select>
				  </div>
				</div>		
				<input type='text' id='Rule' name='Rule'/>
			</li>
			
			<li>
				<div class="center-on-page">
				  <div class="select">
					<select name="sitetime" id="sitetime" onchange="document.getElementById('department').value=value">
					  <option value="" >Выберите отдел</option>
					  	<?php
						 	$department = mysqli_query($link, "SELECT * FROM department");
							while($rowDepartment = mysqli_fetch_array($department)){
								echo '
									<option value="'.$rowDepartment["id_department"].'" >'.$rowDepartment["Title"].'</option>
								';
							} 
						?>
					</select>
				  </div>
				</div>		
				<input type='text' id='department' name='department'/>
			</li>
			
			<li>	
				<div class="registration__func">
					<input type="submit"  value = "Создать" name="CR_submit">
					<p class="registration__btn"><input type="reset" class="submit" value="Сброс" /></p>
				</div>	
			</li>	
			</ul>
		</div>
		
		</form>
	</div>	
	</div>
	</div>		
<?php
	include ("include/footer.php");
?>
</body>
</html>
<?php
/* }else
{
	header("Location: auth/login.php");
} */
?>