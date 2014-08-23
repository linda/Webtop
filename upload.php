<?php
	session_start();
	require_once('FirePHPCore/FirePHP.class.php');
	require_once('FirePHPCore/fb.php');
	ob_start();	
	fb($_FILES, "FILES-Array: ");

	// ============================
	// Directory "images" not included on github repo.
	// ============================	
	$fileupload=$_FILES['picture'];

	$path = "images/" . uniqid() . ".JPG";

	
	if( !$fileupload['error'] && $fileupload['size']>0
		&& $fileupload['tmp_name']
		// && $whitelist
		&& is_uploaded_file($fileupload['tmp_name'] )
		&& ( ($fileupload['type'] == 'image/jpeg') || ($fileupload['type'] == 'image/gif') || ($fileupload['type'] == 'image/png'))
		&& move_uploaded_file($fileupload['tmp_name'], $path)
	)
		echo "Upload to " . $path . " successful!";
	else{
		echo "No upload for you";
	}
	header( 'Location: photoapp.php' ) ;

?>