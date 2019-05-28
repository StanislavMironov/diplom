<?php
	session_start();
	define( '_JEXEC', 1 );
	//global $lastname;
	$newpass = '';
	if($_SESSION['auth'] == "yes_auth"){	
	if(isset($_GET["logout"]))
	{
		unset($_SESSION['auth']);
		unset($_SESSION['auth_name']);
		header("Location: auth/login.php");
	}
	include ("include/header.php");
	include ("functions/functions.php");
	if (@$_POST["save_submit"])
	{
		$_POST["info_surname"] = trim($_POST["info_surname"]);
		$_POST["info_name"] = trim($_POST["info_name"]);
		$_POST["info_patronymic"] = trim($_POST["info_patronymic"]);
		$_POST["info_login"] = trim($_POST["info_login"]);
		$_POST["info_email"] = trim($_POST["info_email"]);
		$_POST["info_phone"] = trim($_POST["info_phone"]);
		
		$error = array();
		
		$pass = md5($_POST["info_pass"]);
		$pass = strrev($pass);
		$pass = "n".$pass."z";
		
		if($_SESSION['auth_pass'] != $pass) {
			$error[] = 'Неверный текущий пароль!';
		}else
		{
			if($_POST["info_new_pass"] != "")
			{
				if(strlen($_POST["info_new_pass"]) < 7 || strlen($_POST["info_new_pass"]) > 15){
					$error[]='Укажите новый пароль от 7 до 15 символов!';
				}else
				{
					$newpass = md5($_POST["info_new_pass"]);
					$newpass = strrev($newpass);
					$newpass = "n".$newpass."z";	
					$newpassquery = "pass='".$newpass."',";
				}
			}
			
			if(strlen($_POST["info_surname"]) < 3 || strlen($_POST["info_surname"]) > 30)
				{
					$error[]='Укажите Фамилию от 3 до 15 символов!';
				}
			
			if(strlen($_POST["info_name"]) < 3 || strlen($_POST["info_name"]) > 30)
				{
					$error[]='Укажите Имя от 3 до 15 символов!';
				}
				
			if(strlen($_POST["info_patronymic"]) < 3 || strlen($_POST["info_patronymic"]) > 30)
				{
					$error[]='Укажите Отчество от 3 до 25 символов!';
				}	
			
			if(!preg_match("/^(?:[a-z0-9]+(?:[-_.]?[a-z0-9]+)?@[a-z0-9_.-]+(?:\.?[a-z0-9]+)?\.[a-z]{2,5})$/i",trim($_POST["info_email"])))
				{
					$error[]='Укажите корректный email!';
				}
			
			if(strlen($_POST["info_phone"]) == "")
				{
					$error[]='Укажите номер телефона!';
				}	
		}
		
		if (count($error))
		{
			$_SESSION['msg'] = "<p align='left' id='form_error'>".implode('<br />',$error)."</p>";
		}else
		{
			$_SESSION['msg'] = "<p align='left' id='form-success'>Данные успешно сохранены!</p>";
		
		
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
			$imgext = strtolower(preg_replace("#.+\.([a-z]+)$#i", "$1", $_FILES['upload_image']['name']));
			//Папка для загрузки
			$uploaddir = './uploads_images/';
			//Новое название файла
			$newfilename = rand(10,100).'.'.$imgext;
			$lastname  = $newfilename;
			//Путь к файлу (папка,файл)
			$uploadfile = $uploaddir.$newfilename;
		
		}else
		{
			$error_img[] = 'Допустимые расширения: jpeg, jpg, png';
		}
		
		
		
	}
	if(empty($_POST['rez'])){
			$_POST['rez'] = $_SESSION['auth_access'];
		}
		
		if(empty($_POST['rez'])){
			$_POST['rez'] = $_SESSION['auth_access'];
		}
		
		if($_FILES['upload_image']['tmp_name'] === '' ){
		 $lastname = 'default.jpg';
		 $uploaddir = './uploads_images/';
			//Путь к файлу (папка,файл)
			$uploadfile = $uploaddir.$lastname;
		}
		if(move_uploaded_file($_FILES['upload_image']['tmp_name'], $uploadfile))
		{
			$dataquery = @$newpassquery."second_name='".$_POST["info_surname"]."',img='{$lastname}',login='".$_POST["info_login"]."',first_name='".$_POST["info_name"]."',last_name='".$_POST["info_patronymic"]."',email='".$_POST["info_email"]."',phone='".$_POST["info_phone"]."',access='".$_POST['rez']."',img='{$lastname}'";
		$update = mysqli_query($link, "UPDATE user SET $dataquery WHERE login ='{$_SESSION['auth_login']}'")or die("Ошибка");
			$_SESSION['auth_surname'] = $_POST["info_surname"];
			$_SESSION['auth_name'] = $_POST["info_name"];
			$_SESSION['auth_patronymic'] = $_POST["info_patronymic"];
			$_SESSION['auth_email'] = $_POST["info_email"];
			$_SESSION['auth_phone'] = $_POST["info_phone"];
			$_SESSION['auth_login'] = $_POST["info_login"];
			$_SESSION['auth_access'] = $_POST['rez'];
		}

		if($newpass){ $_SESSION['auth_pass'] = $newpass;} 
	
			$_SESSION['auth_surname'] = $_POST["info_surname"];
			$_SESSION['auth_name'] = $_POST["info_name"];
			$_SESSION['auth_patronymic'] = $_POST["info_patronymic"];
			$_SESSION['auth_email'] = $_POST["info_email"];
			$_SESSION['auth_phone'] = $_POST["info_phone"];
			$_SESSION['auth_login'] = $_POST["info_login"];
			$_SESSION['auth_access'] = $_POST['rez'];
		}
	}
	
?>
	<div class="profile">
	<h3>Изменение профиля</h3>
	
	<?php
		if(@$_SESSION['msg'])
		{
			echo $_SESSION['msg'];
			unset($_SESSION['msg']);
		}
	?>
	
	<div class="profile__grid">
	<div class="profile__left">
		<div class="profile__photo">
			<img src="./uploads_images/<?php echo $_SESSION['auth_img'];?>" />
		</div>
	</div>
	<div class="profile_right">
		<form enctype="multipart/form-data" method="post">
		<div id="block-form-registration">
			<ul id="info-profile" class="profile__list">
				<li>
				<div class="field">
					<label for="info_login">Логин</label>
					<span>*</span>
					<input type="text" id="info_login" name="info_login" id="info_login" value="<?php echo $_SESSION['auth_login']?>" />
				</div>	
				</li>
				
				<li>
				<div class="field">
					<label for="info_pass">Текущий пароль</label>
					<span>*</span>
					<input type="text" id="info_pass" name="info_pass" id="info_pass" required />
				</div>	
				</li>
				<li>
				<div class="field">
					<label for="info_new_pass">Новый пароль</label>
					<span>*</span>
					<input type="text" id="info_new_pass" name="info_new_pass" id="info_new_pass" />
				</div>	
				</li>
				
				<li>
				<div class="field">
					<label for="info_surname">Фамилия</label>
					<span>*</span>
					<input type="text" name="info_surname" id="info_surname" value="<?php echo $_SESSION['auth_surname'];?>"/>
				</div>	
				</li>
				
				<li>
				<div class="field">
					<label for="info_name">Имя</label>
					<span>*</span>
					<input type="text" name="info_name" id="info_name" value="<?php echo $_SESSION['auth_name'];?>"/>
				</div>	
				</li>
				
				<li>
				<div class="field">
					<label for="info_patronymic">Отчество</label>
					<span>*</span>
					<input type="text" name="info_patronymic" id="info_patronymic" value="<?php echo $_SESSION['auth_patronymic'];?>"/>
				</div>	
				</li>
				
				<li>
				<div class="field">
					<label for="info_email">E-mail</label>
					<span>*</span>
					<input type="text" name="info_email" id="info_email" value="<?php echo $_SESSION['auth_email'];?>" />
				</div>	
				</li>
				
				<li>
				<div class="field">
					<label for="info_phone">Телефон</label>
					<span>*</span>
					<input type="text" name="info_phone" id="info_phone" value="<?php echo $_SESSION['auth_phone'];?>"/>
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
				
				<div class="center-on-page">
				  <div class="select">
					<select name="sitetime" id="sitetime" onchange="document.getElementById('rez').value=value">
					  <option value="" >Выберите роль</option>
					  <option value="1" >Пользователь</option>
					  <option value="2" >Исполнитель</option>
					  <option value="3" >Диспетчер</option>
					</select>
				  </div>
				</div>
				
				<input type='hidden' id='rez' name='rez'/>
				<div class="profile__func">
					<p class="profile__btn"><input type="submit" class="submit" name="save_submit" id="form_submit" value="Сохранить" /></p>
					<p class="profile__btn"><input type="reset" class="submit" value="Сброс" /></p>
				</div>
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
}else
{
	header("Location: auth/login.php");
}
?>