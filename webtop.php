<?php
	session_start();
	// $db = mysqli_connect( 'localhost', 'root', '', 'webtop' );
	// if (mysqli_connect_errno() == 0){
		// echo "connection works";
	// }
	// else {
		// echo 'no connection';
	// }
	// $result = $db->query("Select * from user");
	// if($result){
		// while($z= $result->fetch_object()){
			// echo "<br>" .$z->Username;
		// }
	// }
	
	// ============================
	// FirePHP core pages for easier debugging.
	// ============================	
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

	// ============================
	// 	Default values set for session variables that save
	//	state of the applications; all windows set to closed etc.
	// ============================
	if (isset($_SESSION['username'])){
		if(!isset($_SESSION['infoDialogOpen'])){
			$_SESSION['infoDialogOpen']='false';
		}
		if(!isset($_SESSION['infoDialogPosition'])){
			$_SESSION['infoDialogPosition']=['left'=>0, 'top'=>0];
		}
		if(!isset($_SESSION['photoDialogOpen'])){
			$_SESSION['photoDialogOpen']='false';
		}
		if(!isset($_SESSION['photoDialogPosition'])){
			$_SESSION['photoDialogPosition']=['left'=>0, 'top'=>0];
		}
		if(!isset($_SESSION['boxbot'])){
			$_SESSION['boxbot']=['left'=>0, 'top'=>0];
		}
		if(!isset($_SESSION['vase1'])){
			$_SESSION['vase1']=['left'=>0, 'top'=>0];
		}
		if(!isset($_SESSION['vase2'])){
			$_SESSION['vase2']=['left'=>0, 'top'=>0];
		}
		if(!isset($_SESSION['vase3'])){
			$_SESSION['vase3']=['left'=>0, 'top'=>0];
		}
	}
	
	fb($_SESSION, "Mein SESSION-Array");
	fb($_POST, "Mein POST-Array");

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
<!--	<script src="application.js"></script> -->


</head>
<body>
	<div id="login">
		<?php
			if($_SESSION==NULL){
				include 'login.php';
			}
		?>
	</div>
	<p id="top">
		<?php
		if(isset($_SESSION['username']) ){
			echo 'Hi ' . $_SESSION['username'] . '!';
		} elseif (isset($_POST['username'])){
				echo $wronglogin . '<br>' . ' No-one is logged in';} else {
					echo 'No-one is logged in. ';
					}
		?>
	</p>
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
	<div id="infoDialog" class="dialog" title="About PHP">
		<?php
			if (isset($_SESSION['username'])){
				include 'dialog.php';
			}
		?>
	<div id="photoDialog" class="dialog" title="Photographs">
		<?php
			if (isset($_SESSION['username'])){
				include 'photoDialog.php';
			}
		?>
	<?php
		if(isset($_SESSION['username']) ){
			include 'application.php';
		}
			fb($_SESSION, "SESSION-Array: ");
	?>
	</div>
</body>
</html>