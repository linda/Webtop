<form action="webtop.php" method="post">
	<p><input type="submit" name="logout" value="Logout"></p>
</form>


<?php
if(isset ($_POST['logout'])){
	$_SESSION = array();
	session_destroy();
	if(isset ($_COOKIE['username'])){
		setcookie('username', '', time()-1);
	}
	header( 'Location: webtop.php' ) ;
	}
?>