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
		//	Passing values from POST to SESSION-Array
		// ============================
		if (isset($_POST['dialog'])){
				$_SESSION['dialog'] = $_POST['dialog'];
		}
		// if (isset($_POST['icon1'])){
				// $_SESSION['dialog'] = $_POST['dialog'];
		// }

	?>
</body>
</html>