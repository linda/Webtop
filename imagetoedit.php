<?php
	session_start();
	require_once('FirePHPCore/FirePHP.class.php');
	require_once('FirePHPCore/fb.php');
	ob_start();	
	fb($_GET, "Get-Array: ");


	// ============================
	// Load a JPEG image.
	// ============================
	
	$imagename = "images/" . $_GET['edit'];
	
	$im = @imagecreatefromjpeg($imagename);
	
	if(!$im)
	{
		$im = ImageCreate (200, 200);
	}
	header ("Content-type: image/JPEG");
	imagejpeg($im);
?>
