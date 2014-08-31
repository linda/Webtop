<?php
	require_once('FirePHPCore/FirePHP.class.php');
	require_once('FirePHPCore/fb.php');
	ob_start();	
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
	<title>Save Stuff</title>
	<link href="../css/ui-lightness/jquery-ui-1.10.4.custom.css" rel="stylesheet">
	<script src="../js/jquery-1.10.2.js"></script>
	<script src="../js/jquery-ui-1.10.4.custom.js"></script>
</head>
<body>
	<?php
		session_start();
		$db = mysqli_connect( 'localhost', 'root', '', 'webtop' );
			if (mysqli_connect_errno() == 0){
				echo "connection works<br>";
			}
			else {
				echo 'no connection<br>';
			}
		fb($_POST, "Mein POST-Array");
		fb($_SESSION, "Mein SESSION-Array");

		// ============================
		//	Passing values from POST to SESSION-Array
		//	and saving them into database
		//	Needs to be cleaned up.
		// ============================
		
		$username = $_SESSION['username'];
		
		$sqlUser = "Select * FROM apps WHERE UserIn = '$username'";
		$result = $db->query($sqlUser);
		if($result && $result->num_rows){
			$row = $result->fetch_object();
			echo "<br>We already have this user.<br>";
		}
		else{
			echo "<br>This is this user's first app OMG!<br>";
			$sqlUserCreation = "Insert INTO apps (UserIn) values ('$username')";
			$db->query($sqlUserCreation);
			$result = $db->query($sqlUser);
			if($result && $result->num_rows)
				$row = $result->fetch_object();
			else echo "Couldn't create user " . $username;
		}
		$result->free_result();
		
		echo "Current user: " . $row->UserIn;


		if (isset($_POST['infoDialogOpen'])){
				$_SESSION['infoDialogOpen'] = $_POST['infoDialogOpen'];
		}
		if (isset($_POST['infoDialogPosition'])){
				$_SESSION['infoDialogPosition'] = $_POST['infoDialogPosition'];
		}
		if (isset($_POST['photoDialogOpen'])){
				$_SESSION['photoDialogOpen'] = $_POST['photoDialogOpen'];
		}
		if (isset($_POST['photoDialogPosition'])){
				$_SESSION['photoDialogPosition'] = $_POST['photoDialogPosition'];
		}
		if (isset($_POST['boxbot'])){
				$_SESSION['boxbot'] = $_POST['boxbot'];
		}
		if (isset($_POST['vase1'])){
				$_SESSION['vase1'] = $_POST['vase1'];
		}
		if (isset($_POST['vase2'])){
				$_SESSION['vase2'] = $_POST['vase2'];
		}
		if (isset($_POST['vase3'])){
				$_SESSION['vase3'] = $_POST['vase3'];
		}

	?>
	
</body>
</html>