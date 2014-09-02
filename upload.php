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
	$imageSeparated = explode(".", $_FILES['picture']['name']);
	$imageExtension = $imageSeparated[1];		
	$path = "images/" . uniqid() . "." . $imageExtension;
	
	if( !$fileupload['error'] && $fileupload['size']>0
		&& $fileupload['tmp_name']
		&& is_uploaded_file($fileupload['tmp_name'] )
		&& ( ($fileupload['type'] == 'image/jpeg') || ($fileupload['type'] == 'image/gif') || ($fileupload['type'] == 'image/png'))
		&& ((strtolower($imageExtension) == 'jpg') || (strtolower($imageExtension) == 'jpeg') || (strtolower($imageExtension) == 'gif') || (strtolower($imageExtension) == 'png'))
		&& move_uploaded_file($fileupload['tmp_name'], $path)
	)
	{
		echo "Upload to " . $path . " successful!";
		// Can I use header('Location:') like that?
		header( 'Location: photoapp.php?upload=true' ) ;
	}
	else {
		echo "No upload for you";
		header( 'Location: photoapp.php?upload=false' ) ;
	}
?>