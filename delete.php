<?php
	session_start();
	require_once('FirePHPCore/FirePHP.class.php');
	require_once('FirePHPCore/fb.php');
	ob_start();	
	fb($_GET, "Get-Array: ");


	// ============================
	// Delete image (image sent with GET method)
	// TODO: redirect to photoapp page
	// ============================	

	if(unlink("images/" . $_GET['delete'])){
		echo "Deleted images/" . $_GET['delete'];
	}
	else echo "Couldn't delete images/ " . $_GET['delete'];
	
?>