<?php
	session_start();
	require_once('FirePHPCore/FirePHP.class.php');
	require_once('FirePHPCore/fb.php');
	ob_start();	
	fb($_GET, "Get-Array: ");


	// ============================
	// Create a php image from a JPEG image.
	// ============================
	
	$imagename = "images/" . $_GET['edit'];
	
	$im = @imagecreatefromjpeg($imagename);
	
	header ("Content-type: image/JPEG");
	imagejpeg($im);
?>