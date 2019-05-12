<?php
	session_start();
	include ("include/header.php");
	include ("include/db_connect.php");
	
	$sql = mysqli_query($link, "SELECT * FROM knowledge ") or die();
	$sqlKn = mysqli_query($link, "SELECT * FROM knowledge_category ") or die();
?>
<div class="knowledge">
	<div class="knowledge__block">
		<div class="knowledge__title">
			Здесь вы сможете самостоятельно найти ответ на свой вопрос.
		</div>
		<div class="knowledge__info">
			<?php
			while($rowCat = mysqli_fetch_assoc($sqlKn))
				{
					echo '<button class="knowledge__accordion" id="'.$rowCat["category"].'">'.$rowCat["title"].'</button>';
					echo '<div class="panel">';
					echo '</div>';
				}
			?>
		</div>
	</div>
</div>	

<div class="podlogka" id="appPopup">	
<div class="knowledge__popup">

<div class="knowledge__container">
<h3 class="knowTitle">
</h3>

<p class="knowDescription">
</p>
</div>

<div id="popup-close">
</div>
</div>	
</div>
<?php
	include ("include/footer.php");
?>
</body>
</html>