<?php
	session_start();
	require_once('FirePHPCore/FirePHP.class.php');
	require_once('FirePHPCore/fb.php');
	ob_start();	
	fb($_GET, "Get-Array: ");


	// ============================
	// Edit the image sent by GET
	// ============================
	
	$imagetoedit = $_GET['edit'];
	
	echo "Page for editing this image: " . $imagetoedit . "<br>";
	
	echo "<img src='imagetoedit.php?edit=$imagetoedit'>";
	
	echo "<br>There could be buttons here!<br><a href='photoapp.php'>Back to overview</a>";
?>
