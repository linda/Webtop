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

	// ============================
	// Effects; overwrite old image immediately;
	// TODO: allow for atleast one step back before overwriting
	// ============================		
	$im = @imagecreatefromjpeg($imagename);
		if($_GET['effect']=='grey'){
			imagefilter($im, IMG_FILTER_GRAYSCALE);
			imagejpeg($im, $imagename);
		}
		else if ($_GET['effect']=='brighter'){
			imagefilter($im, IMG_FILTER_BRIGHTNESS, 50);
			imagejpeg($im, $imagename);
		}
	if(!$im)
	{
		$im = ImageCreate (200, 200);
	}
	header ("Content-type: image/JPEG");
	imagejpeg($im);
?>
