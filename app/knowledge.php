<?php
session_start();
define( '_JEXEC', 1 );
if(isset($_SESSION['auth'])) {
if($_SESSION['auth'] == "yes_auth"){	
if(isset($_GET["logout"]))
{
	unset($_SESSION['auth']);
	unset($_SESSION['auth_name']);
	header("Location: auth/login.php");
}
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
<?php 
}else
{
 header("Location: auth/login.php");
}
}
else
{
	 header("Location: auth/login.php");
}
?>