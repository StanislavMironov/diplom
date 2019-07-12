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
?>
	<div class="news-detail">
		Детальная
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