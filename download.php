<?php
	session_start();
	require_once('FirePHPCore/FirePHP.class.php');
	require_once('FirePHPCore/fb.php');
	ob_start();	
	fb($_FILES, "FILES-Array: ");

	// ============================
	// 
	// ============================
	$imagetodownload = $_GET['download'];	
	echo "Page for downloading this image: " . $imagetodownload . "<br>";	
?>