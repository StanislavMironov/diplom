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
	include ("include/db_connect.php");
?>
	<div class="main">
		<div class="main-left">
			<div class="main-left__title">
				<div>Новости</div>
				<div class="helper">
					<div class="mes">
					<img src="./img/icons/question-mark.svg">
					<div class="mes__info">
						Блок последних новостей
					</div>	
					</div>
				</div>
			</div>	

			<div class="main-left__news">
						<?php
			
			
			$result = mysqli_query($link, "SELECT * FROM news") or die("Ошибка запроса!");
			if (mysqli_num_rows($result) > 0)
			{
			$row = mysqli_fetch_array($result);
			do{
				echo '
							<div  class="main-left__item">
							<a href="#" class="main-left__article">'.$row["title"].'</a>
							<div class="main-left__info">
								'.$row["description"].'
							<div class="main-left__date">Дата: '.$row["period"].'</div>
							</div>
							</div>
							';
			}
			while($row = mysqli_fetch_array($result));	
			} else {
				echo '<p>Новостей нет</p>';
			}	


            for($i=0;$i<3;$i++)
			{
				echo '
							<div  class="main-left__item">
							<a href="#" class="main-left__article">Test</a>
							<div class="main-left__info">Lorem Ipsum is simply dummy text of the printing and typesetting industry.
								
							<div class="main-left__date">Дата: '.$row["period"].'</div>
							</div>
							</div>
							';
			}			
			?>

			</div>
		</div>
		<?php
		include ("include/b-aside.php");
		?>
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