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
?>
	<div class="registration">
		<form method="post" id="form_reg" action="reg/handler_reg.php">
		<p id="reg_message"></p>
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
					<input type="text" name="reg_pass" id="reg_pass" />
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
				
<input type='text' id='rez' name='rez'/>
				<div class="registration__func">
					<p class="registration__btn"><input type="submit" class="submit" name="reg_submit" id="form_submit" value="Регистрация" /></p>
					<p class="registration__btn"><input type="reset" class="submit" value="Сброс" /></p>
				</div>	
			</ul>
		</div>
		</form>
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