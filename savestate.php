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
		//	Function for saving app state (open/closed and position) into db
		// ============================
		function saveAppState ($username, $currentapp, $value){
			$db = mysqli_connect( 'localhost', 'root', '', 'webtop' );
			if (mysqli_connect_errno() == 0){
				echo "connection works<br>";
			}
			else {
				echo 'no connection<br>';
			}

			// ============================
			//	Check if value is a position array or single true/false value
			// ============================			
			if(count($value)==1){
				if($value == 'true')
					$isOpen = 1; //TODO: automatise this, save 0/1 instead of true/false string
				else $isOpen = 0;
				$saveWhat = 'Status';
			}
			else{
				$posX = $value['left'];
				$posY = $value['top'];
				$saveWhat = 'Position';
			}
			// ============================
			//	Check if this particular user/app combination is already saved in the database;
			//	if yes update it, if no create it;
			//	TODO try to condense this
			//	(using REPLACE statement not possible because the values to check against
			//	- Username and Applikationsname - are not primary key or/and unique)
			// ============================			
			$sqlUserApp = "Select * FROM apps WHERE UserIn = '$username' && Applikationsname = '$currentapp'";
			$result = $db->query($sqlUserApp);
			// ============================
			//	If this particular user and app combination already exists,
			//	update the row, otherwise create it.
			// ============================
			if($result && $result->num_rows){
				$row = $result->fetch_object();
				if($saveWhat == 'Status'){
					$sqlNewValues = 
						"UPDATE apps SET Status='$isOpen' WHERE ID='$row->ID'";
				}
				else{
					$sqlNewValues = 
						"UPDATE apps SET PositionX='$posX', PositionY='$posY' WHERE ID='$row->ID'";
				}
				$db->query($sqlNewValues);				
			}
			
			else{
				if($saveWhat == 'Status'){
					$sqlUserCreation = 
						"Insert INTO apps (UserIn, Applikationsname, Status)
						values ('$username', '$currentapp', '$isOpen')";
				}
				else{
					$sqlUserCreation = 
						"Insert INTO apps (UserIn, Applikationsname, PositionX, PositionY)
						values ('$username', '$currentapp', '$posX', '$posY')";
				}
				$db->query($sqlUserCreation);
				$result = $db->query($sqlUserApp);
				if($result && $result->num_rows)
					$row = $result->fetch_object();
			}
			$result->free_result();		
		}
		// ============================
		//	Passing values from POST to SESSION-Array
		//	and saving them into database
		// ============================
		if(isset($_POST['infoDialogOpen'])){
			$_SESSION['infoDialogOpen'] = $_POST['infoDialogOpen'];
			saveAppState ($username, 'infoDialog', $_POST['infoDialogOpen']);
		}
		if (isset($_POST['infoDialogPosition'])){
			$_SESSION['infoDialogPosition'] = $_POST['infoDialogPosition'];
			saveAppState ($username, 'infoDialog', $_POST['infoDialogPosition']);				
		}
		if (isset($_POST['photoDialogOpen'])){
			$_SESSION['photoDialogOpen'] = $_POST['photoDialogOpen'];
			saveAppState ($username, 'photoDialog', $_POST['photoDialogOpen']);
		}
		if (isset($_POST['photoDialogPosition'])){
			$_SESSION['photoDialogPosition'] = $_POST['photoDialogPosition'];
			saveAppState ($username, 'photoDialog', $_POST['photoDialogPosition']);
		}
		if (isset($_POST['boxbot'])){
			$_SESSION['boxbot'] = $_POST['boxbot'];
			saveAppState ($username, 'boxbot', $_POST['boxbot']);
		}
		if (isset($_POST['vase1'])){
			$_SESSION['vase1'] = $_POST['vase1'];
			saveAppState ($username, 'vase1', $_POST['vase1']);
		}
		if (isset($_POST['vase2'])){
			$_SESSION['vase2'] = $_POST['vase2'];
			saveAppState ($username, 'vase2', $_POST['vase2']);
		}
		if (isset($_POST['vase3'])){
			$_SESSION['vase3'] = $_POST['vase3'];
			saveAppState ($username, 'vase3', $_POST['vase3']);
		}

	?>
	
</body>
</html>