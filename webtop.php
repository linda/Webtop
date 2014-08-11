<?php
	session_start();
	
	require_once('FirePHPCore/FirePHP.class.php');
	ob_start();
	require_once('FirePHPCore/fb.php');
	?>
<?php
	if (isset($_COOKIE['username'])) {
		$_SESSION['username']=$_COOKIE['username'];
	}

	if(isset($_POST['stayloggedin'])){
		setcookie('username', $_POST['username'], time()+60000);
	}
	else if(isset($_POST['username'])){
		setcookie('username', "");
	}
	
	
	fb($_SESSION, "Mein SESSION-Array");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
	<title>Linda's Webtop</title>
	<link rel="stylesheet" type="text/css" href="webtopstyle.css">
	<link href="../css/ui-lightness/jquery-ui-1.10.4.custom.css" rel="stylesheet">
	<script src="../js/jquery-1.10.2.js"></script>
	<script src="../js/jquery-ui-1.10.4.custom.js"></script>

	<?php
		include 'application.php';
		fb($_SESSION, "SESSION-Array: ");
	?>

</head>
<body>
<input type="hidden" value=0 id="someID">

	<div id="login">
		<?php
			if($_SESSION==NULL){
				include 'login.php';
			}
//			else{
//				include 'logout.php';
//			}
		?>
	</div>
	<p id="top">
		<?php
		if(isset($_SESSION['username']) ){
			echo 'Hi ' . $_SESSION['username'] . '!';
		} elseif ($_POST!=NULL){
				echo $wronglogin . '<br>' . ' No-one is logged in';} else {
					echo 'No-one is logged in. ';
					}
		?>
	</p>

	<div id="dialog" title="About PHP">
		<?php
			if (isset($_SESSION['username'])){
				include 'dialog.php';
			}
		?>
	</div>
	<div id="userdaten" title="Ihre Daten">
		<?php
			if (isset($_SESSION['username'])){
				include 'userdaten.php';
			}
		?>
	</div>
	<div id="icons">
		<?php
		if (isset($_SESSION['username'])){
			include 'icons.php';
		}
		?>
	</div>
	<div id="menudiv">
	<?php
		if (isset($_SESSION['username'])){
			include 'menudiv.php';
		}
	?>
	</div>
	<?php
		if (isset($_SESSION['username'])){
			include 'taskleiste.php';
		}
	?>

</body>
</html>