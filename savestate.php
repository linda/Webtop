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
	// ============================
	//	Dialog opened or closed
	// ============================
	if (isset($_POST['dialog'])){
			$_SESSION['dialog'] = $_POST['dialog'];
//		} else {$_SESSION['dialog'] = "closed";
	}
//	if (isset($_POST['menu'])){
			$_SESSION['menu'] = $_POST['menu'];
//		} else {$_SESSION['menu'] = "closed";
//	}

	// ============================
	//	Bellow code for easy output of the session variables
	//	as a json object; not necessary at this time
	// ============================
	$dialog=$_SESSION['dialog'];
	$menu=$_SESSION['menu'];
	$return = ["dialog"=>$dialog, "menu"=>$menu];

	fb($_SESSION, "Mein SESSION-Array");
	?>
	<div ID="returnValue">
		<?php echo json_encode($return); ?>
	</div>
</body>
</html>