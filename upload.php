<?php
	session_start();
	require_once('FirePHPCore/FirePHP.class.php');
	require_once('FirePHPCore/fb.php');
	ob_start();	
	fb($_FILES, "FILES-Array: ");

	// ============================
	// Directory "images" not included in the github repo.
	// ============================	
	$path = "images/" . uniqid() . ".JPG";
	
	
	$fileupload=$_FILES['picture'];
	if( !$fileupload['error'] && $fileupload['size']>0
		&& $fileupload['tmp_name']
		&& is_uploaded_file($fileupload['tmp_name'] )
		&& ($fileupload['type'] == 'image/jpeg')
		&& move_uploaded_file($fileupload['tmp_name'], $path)
	)
		echo "Upload to " . $path . " successful!";
	else{
		echo "No upload for you";
	}
?>