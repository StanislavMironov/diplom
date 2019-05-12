<?php
	session_start();
	define( '_JEXEC', 1 );
	
	if($_SESSION['auth'] == "yes_auth"){	
	if(isset($_GET["logout"]))
	{
		unset($_SESSION['auth']);
		unset($_SESSION['auth_name']);
		header("Location: auth/login.php");
	}
	include ("include/header.php");
	include ("functions/functions.php");
	include ('/include/rule.php');
?>

	<div class="application">
		<div class="application__left">
		<p style="display:none;" align='left' id='form-success'></p>
			<div class="info-header">
			<?php 
				switch($temp){
				case "Пользователь":
				echo '
					<div class="info-header__tab active">
					Создать
					</div>
					<div class="info-header__tab appCreate">
					Созданные мною
					</div>
					<div class="info-header__tab">
						Архив
					</div>
					';
				break;
				}
			
			?>
				<!--
				<div class="info-header__tab">
					Заявки в работе
				</div>
				<div class="info-header__tab appCreate">
					Созданные мною
				</div>
				<div class="info-header__tab">
					Архив
				</div>-->
			</div>	
			
			<div class="application__tabcontent fade">
				<form id="createApp" enctype="multipart/form-data" method="post">
				<div class="application__option">
				<a href="javascript:void(0);" id="create_submit" class='Btn' name="save_submit" >Создать</a>
				<a href="javascript:void(0);" id="clear_submit" class='Btn' name="clear_submit" >Очистить</a>
				</div>

				<div class="application__option ">
					<div class="fileload">
						
						<div class="fileload__title">
						<h2>Загрузка файла:</h2>
						<div class="helper">
							<div class="mes">
							<img src="./img/icons/question-mark.svg">
							<div class="mes__info">
								Можно прикрепить скрин экрана
							</div>	
							</div>
						</div>
						</div>
						
						<div class="file-load-block">
						
							<input type="file" name="upload_image" id="file" required />
							<input type="hidden" name="MAX_FILE_SIZE" value="5000000"/>
							<div class="fileLoad">
								<input id="sFile" type="text" value="Select file" />
								<button>Выберите файл</button>
							</div>
						</div>
					</div>
				</div>

				<div class="application__field">
				<label for="description">
					Краткое описание*
				</label>
				<input type="text" id="description" name="description" required>
				</div>

				<div class="application__field">
				<label for="full-description">
					Подробное описание
				</label>
				<textarea id="full-description" rows="10" cols="45" name="full_text"></textarea>
				</div>

				<script>
					function vT(){
						var valueInput = document.getElementById("sitetime").options.selectedIndex;
						console.log(valueInput);

						switch(valueInput){
							case 1: 
								$('#description').val('Установить \"Программу\" для учёта бухгалтерии.');
								$('#full-description').val('Желательно последнюю версию');
							break;
					}
}
				</script>
				
				<div class="center-on-page">
				  <div class="select">
					<select name="sitetime" id="sitetime" onchange="vT()">
					  <option value="" >Выберите шаблон</option>
					  <option value="1" >Установка ПО</option>
					  <option value="2" >Замена запчастей</option>
					</select>
				  </div>
				</div>

				<input type='text' id='rez' name='rez'/>
				</form>
				
			</div>
			<?php
			if ($temp != "Пользователь")
			{
				echo '<div class="application__tabcontent fade">
			<div class="table">
			    <div class="table__row">
			        <div class="table__column">Номер</div>
			        <div class="table__column">Название</div>
			        <div class="table__column">Автор</div>
			        <div class="table__column">Время</div>
			        <div class="table__column"></div>
			    </div>

			    <div class="table__row">
			        <div class="table__column">Center 1</div>
			        <div class="table__column">Center 2</div>
			        <div class="table__column">Center 3</div>
			        <div class="table__column">00.00.00</div>
			        <div class="table__column table__column--function">
			        	<div class="table__func">
				        	<a href="#">
				        		<svg class="icon">
	                              <use xlink:href="#my-first-icon" />
	                            </svg>
	                        </a>
				        	<a href="#">
				        		<svg class="icon">
                                  <use xlink:href="#my-second-icon" />
                                </svg>
							</a>
			        	</div>
			        </div>
			    </div>

			    <div class="table__row">
			        <div class="table__column">Center 1</div>
			        <div class="table__column">Center 2</div>
			        <div class="table__column">Center 3</div>
			        <div class="table__column">00.00.00</div>
			        <div class="table__column table__column--function">
			        	<div class="table__func">
				        	<a href="#">
				        		<svg class="icon">
	                              <use xlink:href="#my-first-icon" />
	                            </svg>
	                        </a>
				        	<a href="#">
				        		<svg class="icon">
                                  <use xlink:href="#my-second-icon" />
                                </svg>
							</a>
			        	</div>
			        </div>
			    </div>

			    <div class="table__row">
			        <div class="table__column">Center 1</div>
			        <div class="table__column">Center 2</div>
			        <div class="table__column">Center 3</div>
			        <div class="table__column">00.00.00</div>
			        <div class="table__column table__column--function">
			        	<div class="table__func">
				        	<a href="#">
				        		<svg class="icon">
	                              <use xlink:href="#my-first-icon" />
	                            </svg>
	                        </a>
				        	<a href="#">
				        		<svg class="icon">
                                  <use xlink:href="#my-second-icon" />
                                </svg>
							</a>
			        	</div>
			        </div>
			    </div>
			</div>
			</div>';
			}
			?>
			
			<div class="application__tabcontent fade">
			<script>
		
			</script>
			<div class="table" id="myApp">
			</div>
			
			</div>

			<div class="application__tabcontent fade">
				<div class="table">
			    <div class="table__row">
			        <div class="table__column">Номер</div>
			        <div class="table__column">Название</div>
			        <div class="table__column">Автор</div>
			        <div class="table__column">Время</div>
			        <div class="table__column"></div>
			    </div>

			    <div class="table__row">
			        <div class="table__column">Center 1</div>
			        <div class="table__column">Center 2</div>
			        <div class="table__column">Center 3</div>
			        <div class="table__column">00.00.00</div>
			        <div class="table__column table__column--function">
			        	<div class="table__func">
				        	<a href="#">
				        		<svg class="icon">
	                              <use xlink:href="#my-first-icon" />
	                            </svg>
	                        </a>
				        	<a href="#">
				        		<svg class="icon">
                                  <use xlink:href="#my-second-icon" />
                                </svg>
							</a>
			        	</div>
			        </div>
			    </div>

			    <div class="table__row">
			        <div class="table__column">Center 1</div>
			        <div class="table__column">Center 2</div>
			        <div class="table__column">Center 3</div>
			        <div class="table__column">00.00.00</div>
			        <div class="table__column table__column--function">
			        	<div class="table__func">
				        	<a href="#">
				        		<svg class="icon">
	                              <use xlink:href="#my-first-icon" />
	                            </svg>
	                        </a>
				        	<a href="#">
				        		<svg class="icon">
                                  <use xlink:href="#my-second-icon" />
                                </svg>
							</a>
			        	</div>
			        </div>
			    </div>

			    <div class="table__row">
			        <div class="table__column">Center 1</div>
			        <div class="table__column">Center 2</div>
			        <div class="table__column">Center 3</div>
			        <div class="table__column">00.00.00</div>
			        <div class="table__column table__column--function">
			        	<div class="table__func">
				        	<a href="#">
				        		<svg class="icon">
	                              <use xlink:href="#my-first-icon" />
	                            </svg>
	                        </a>
				        	<a href="#">
				        		<svg class="icon">
                                  <use xlink:href="#my-second-icon" />
                                </svg>
							</a>
			        	</div>
			        </div>
			    </div>
			</div>
			</div>
		</div>	

	<?php
		include ("include/b-aside.php");
		$sql = mysqli_query($link, "SELECT * FROM application WHERE user = '{$_SESSION['auth_id']}' ") or die("Ошибка вывода заявки");
		$row = mysqli_fetch_array($sql);
	?>
<div class="podlogka" id="appPopup">	
<div class="application__popup">
<div class="application__popup-Container">
<form class="editApp_form"  method="post" name="application__form" id="formEditApp">
<div id="resStatus">
	 <h2 id="num_app"></h2>
	 <span class="required_notification">* Поля обязательные для заполнения</span>
</div>
<ul>
<div class="changeStatus">
</div>
	<li>
	<div>
		<span>Отдел:</span>
	</div>	
	
	<div>
		Отдел кадров
	</div>
    </li>
	
	<li>
		<span>Статус:</span> <div><?php echo $_SESSION["statusApp"];?></div>
	</li>
	
    <li>
	<div>
        <label for="title_app">Название:*</label>
        <input id="title_app" type="text" name="title_app"  />
	</div>	
    </li>
	<li>
		<label for="description">Подробное описание:</label>
		<textarea id="description_app" name="description_app" cols="40" rows="6" >
		</textarea>
	</li>
	<li>
		<label for="date">Дата создания: </label>
		<input type="date" id="date" name="date_app"/>
	</li>
	<li>
    <label for="comment">Комментарии:</label>
    <textarea name="comment" cols="40" rows="6" id="comment_app" >
	</textarea>
	</li>
	<li>
	<div>
        <label for="add_app">Добавить комментарий:</label>
        <input id="add_app" type="text" name="add_app" />
	</div>	
    </li>
</ul>
<div class="saveApp">
<a href="javascript:void(0);" id="save_app" class="Btn" type="submit">Сохранить</a>
</div>
</form>
</div>
<div id="popup-close">
</div>
</div>
</div>	

</div>	
</div>		
<?php
	include ("include/footer.php");
?>

<svg xmlns="http://www.w3.org/2000/svg" style="display: none"  width="350" height="200">
  <symbol id="my-first-icon" viewBox="0 0 20 33">
    <title>my-first-icon</title>
    <path d="M7.127 22.562l-7.127 1.438 1.438-7.128 5.689 5.69zm1.414-1.414l11.228-11.225-5.69-5.692-11.227 11.227 5.689 5.69zm9.768-21.148l-2.816 2.817 5.691 5.691 2.816-2.819-5.691-5.689z" />
  </symbol>
</svg>
<svg xmlns="http://www.w3.org/2000/svg" style="display: none"  width="350" height="200">
  <symbol id="my-second-icon" viewBox="0 0 20 33">
    <title>my-first-icon</title>
    <path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm4.151 17.943l-4.143-4.102-4.117 4.159-1.833-1.833 4.104-4.157-4.162-4.119 1.833-1.833 4.155 4.102 4.106-4.16 1.849 1.849-4.1 4.141 4.157 4.104-1.849 1.849z" />
  </symbol>
</svg>




</body>
</html>

<?php
}else
{
	header("Location: auth/login.php");
}
?>