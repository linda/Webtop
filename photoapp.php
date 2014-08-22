<?php
	session_start();
	require_once('FirePHPCore/FirePHP.class.php');
	require_once('FirePHPCore/fb.php');
	ob_start();	
	fb($_FILES, "FILES-Array: ");

?>

<html>
<head>

	<!-- jQuery library -->
	<script type="text/javascript" src="../fancybox/jquery-1.11.1.min.js"></script>
	<!-- fancyBox -->
	<link rel="stylesheet" href="../fancybox/source/jquery.fancybox.css" type="text/css" media="screen" />
	<script type="text/javascript" src="../fancybox/source/jquery.fancybox.pack.js"></script>

	<!-- Helpers - button, thumbnail and/or media -->
	<link rel="stylesheet" href="../fancybox/source/helpers/jquery.fancybox-buttons.css" type="text/css" media="screen" />
	<script type="text/javascript" src="../fancybox/source/helpers/jquery.fancybox-buttons.js"></script>
	<link rel="stylesheet" href="../fancybox/source/helpers/jquery.fancybox-thumbs.css" type="text/css" media="screen" />
	<script type="text/javascript" src="../fancybox/source/helpers/jquery.fancybox-thumbs.js"></script>

	<script type="text/javascript" src="../fancybox/source/helpers/jquery.fancybox-media.js"></script>

	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
	<title>Linda's Webtop - Photo App</title>
	<link rel="stylesheet" type="text/css" href="webtopstyle.css">

	<script>
			
		// ============================
		// 	Include fancyBox.
		// =======================
		$(document).ready(function() {
			$(".gallery").fancybox({
				helpers:  {
					thumbs : {
						width: 50,
						height: 50
					}
				}
			});
		});

	</script>
	
</head>
<body>
<!--	<div ID="tumbnails"> -->
		<a class="gallery" rel="gallery" href="images/herbstcampus017.jpg" title="Campus Wien im Herbst">
			<img src="images/herbstcampus017.jpg" alt="" />
		</a>
		<a class="gallery" rel="gallery" href="images/herbstcampus012.jpg" title="Campus Wien im Herbst bis">
			<img src="images/herbstcampus012.jpg" alt="" />
		</a>
<!--	</div> -->
	<div id="uploadForm">
		<form enctype="multipart/form-data" method="post" action="upload.php">
			File to upload: <input type="file" name="picture"><br>
			<input type="submit" value="Upload File">
		</form>
	</div> 
</body>
</html>