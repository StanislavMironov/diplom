<?php
	session_start();
	include ("include/header.php");
	include ("include/db_connect.php");
?>
<div class="setting">
	<div class="setting__block">
		<div class="setting__title">
			Настройки
		</div>
		
		<div class="setting__menu">
		<a href="javascript:void(0)" class="setting__link active" id="users">
		Пользователи
		</a>
		<a href="javascript:void(0)" class="setting__link">
		Новости
		</a>
		<a href="javascript:void(0)" class="setting__link">
		База знаний
		</a>
		<a href="javascript:void(0)" class="setting__link">
		Документы
		</a>
		<a href="javascript:void(0)" class="setting__link">
		Оргструктура
		</a>
		</div>
		<div class="setting__info show">
		<div class="changeSetting">
		</div>
		<div class="setting__smenu">	
			<div class="setting__article">
			Добавить нового пользователя:
			</div>
			<a href="./registration.php">
			Выбрать
			</a>
		</div>	
		<div class="setting__container">

		</div>
		</div>	
		
		<div class="setting__info hide">
		<div class="changeNews">
		</div>
		<div class="setting__grid">
		<div class="setting__left">
		<div class="setting__st">
		Создать новость:
		</div>
		<form id="formNews">
		<div>
			<ul class="setting__list">
				<li>
				<div class="field">
					<label>Название</label>
					<span>*</span>
					<input type="text" name="news_title" id="news_title" />
				</div>	
				</li>
				<li>
				<div class="field">
					<label>Описание</label>
					<span>*</span>
					<input type="text" name="news_description" id="news_description" />
				</div>	
				</li>
				<div class="setting_func">
				<a href="javascript:void(0);" id="save_news" class="Btn" type="submit">Сохранить</a>
				<input class="Btn" type="reset" value="Cброс"/>
				</div>
			</ul>
			</form>
			</div>
		</form>
		</div>
		
		<div class="setting__right">
		<div class="setting__st">
		Новости:
		</div>
		<div class="setting__news">
		<div class="table">
		<div class="table__row">
			<div class="table__column td">
			Номер
			</div>
			<div class="table__column">
			Название
			</div>
			<div class="table__column">
			Дата создания
			</div>
			</div>
		<?php
		$sql = mysqli_query($link, "SELECT * FROM news");
		$row = mysqli_fetch_array($sql);
		do {
			echo '
	
			<div class="table__row">
			
			<div class="table__column td">
			'.$row["id"].'
			</div>
			<div class="table__column">
			'.$row["title"].'
			</div>
			<div class="table__column">
			'.$row["period"].'
			</div>
			<div class="table__column">
			<a onclick="return false;" class ="news_del" href="'.$row["id"].'">Удалить</a>
			</div>
			</div>
			';
		}
		while ($row = mysqli_fetch_array($sql));
		?>
		</div>
		</div>
		</div>
		
		
		</div>
		</div>	
		
		<div class="setting__info hide">
		wwfwfw
		</div>

<?php
	include ("include/footer.php");
?>
</body>
</html>