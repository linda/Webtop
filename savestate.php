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

		fb($_POST, "Mein POST-Array");
		fb($_SESSION, "Mein SESSION-Array");
		$username = $_SESSION['username'];

		// ============================
		// Function for save information on the appsinto the database
		// ============================
		function saveAppState ($username, $currentapp){
			$db = mysqli_connect( 'localhost', 'root', '', 'webtop' );
			if (mysqli_connect_errno() == 0){
				echo "connection works<br>";
			}
			else {
				echo 'no connection<br>';
			}		
			if($_POST[$currentapp] == 'true')
				$isOpen = 1;
			else $isOpen = 0;
			// ============================
			//	Check if this particular user/app combination is already saved in the database;
			//	if yes update it, if no create it;
			//	TODO try to condense this into one REPLACE statement? or other
			// ============================			
			$sqlUserApp = "Select * FROM apps WHERE UserIn = '$username' && Applikationsname = '$currentapp'";
			$result = $db->query($sqlUserApp);
			if($result && $result->num_rows){
				$row = $result->fetch_object();
//				echo "<br>This user and app combination has been here before! Hi " . $username . "!<br>";
				$sqlNewStatus = 
					"UPDATE apps SET Status='$isOpen' WHERE ID='$row->ID'";
				$db->query($sqlNewStatus);				
			}
			else{
//				echo "<br>This user used this app for the first time! How exiting!<br>";
				$sqlUserCreation = "Insert INTO apps (UserIn, Applikationsname, Status) values ('$username', '$currentapp', '$isOpen')";
				$db->query($sqlUserCreation);
				$result = $db->query($sqlUserApp);
				if($result && $result->num_rows)
					$row = $result->fetch_object();
//				else echo "Couldn't create this row ";
			}
			$result->free_result();		
		}
		// ============================
		//	Passing values from POST to SESSION-Array
		//	and saving them into database
		//	Needs to be cleaned up.
		// ============================
		if(isset($_POST['infoDialogOpen'])){
			$_SESSION['infoDialogOpen'] = $_POST['infoDialogOpen'];
			saveAppState ($username, 'infoDialog');
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