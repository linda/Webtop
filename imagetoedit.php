<?php
	session_start();
	require_once('FirePHPCore/FirePHP.class.php');
	require_once('FirePHPCore/fb.php');
	ob_start();	
	fb($_GET, "Get-Array: ");
	fb($_POST, "POST-Array: ");

	// ============================
	// Load a JPEG image.
	// ============================
	$imagename = "images/" . $_GET['edit'];
	$temp_image = "temp_images/backone.jpeg";

	// ============================
	//	Effects; overwrite old image immediately.
	//	Before overwriting, save old image in different folder
	//	to allow for one step back.
	// ============================
	if($_GET['effect'] == 'back')
		$im = @imagecreatefromjpeg($temp_image);
	else
		$im = @imagecreatefromjpeg($imagename);

	if($im){
		switch ($_GET['effect']){
			case 'grey':
				imagejpeg($im, 'temp_images/backone.jpeg');
				imagefilter($im, IMG_FILTER_GRAYSCALE);
				break;
			case 'brighter':
				imagejpeg($im, 'temp_images/backone.jpeg');
				imagefilter($im, IMG_FILTER_BRIGHTNESS, 50);
				break;
		}
		imagejpeg($im, $imagename);
	}
	else
	{
		$im = ImageCreate (200, 200);
	}
	header ("Content-type: image/JPEG");
	imagejpeg($im);
?>
