<?php
	session_start();
	require_once('FirePHPCore/FirePHP.class.php');
	require_once('FirePHPCore/fb.php');
	ob_start();	
	fb($_FILES, "FILES-Array: ");

	// ============================
	// Directory the files are uploaded to needs to be "images";
	// not included in the github repo.
	// ============================	
	$path = "images/" . $_FILES['picture']['name'];
	if (move_uploaded_file($_FILES['picture']['tmp_name'], $path)){
		echo "Upload to " . $path . " successful!";
	}
	else{
		echo "No upload";
	}

?>