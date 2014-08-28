<?php
	session_start();
	require_once('FirePHPCore/FirePHP.class.php');
	require_once('FirePHPCore/fb.php');
	ob_start();	
	fb($_GET, "Get-Array: ");


	// ============================
	// ============================	

	echo "Page for editing this image: " . $_GET['edit'];	
?>