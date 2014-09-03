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

	<!-- jQuery IU -->
	<script src="../js/jquery-ui-1.10.4.custom.js"></script>

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
			$(".gallery").fancybox();
		});

		// ============================
		// 	Drag & Drop javascript/jQuery code from examples in lecture.
		// =======================
		// function init() {
		  // var dropbox = document.getElementById('dropbox');        
		  // dropbox.addEventListener('dragenter', noopHandler, false);
		  // dropbox.addEventListener('dragexit', noopHandler, false);
		  // dropbox.addEventListener('dragover', noopHandler, false);
		  // dropbox.addEventListener('drop', drop, false);
		// }

		// function noopHandler(evt) {
		// evt.stopPropagation();
		// evt.preventDefault();   
		// }   

		// function drop(evt) {
		// evt.stopPropagation();
		// evt.preventDefault();
		// var files = evt.dataTransfer.files;
		// var count = files.length; 
		// for (i=0; i<count;i++) {   
			// var formData = new FormData();
			// formData.append("file", files[i]);

			// $.ajax({
				// type: "POST",
				// data: formData,
				// url: "upload.php",
				// cache: false,
				// contentType: false,
				// processData: false,
				// success: transferComplete
			// });
		// }
		// }         

		// function transferComplete(response, error) {
		// console.log(response);
		// var result = document.getElementById('result'); 
		// result.innerHTML = response;	
		// }
		// ============================
		// 	droppable function
		// =======================
		$(function() {
			$( "#dropbox" ).droppable({
				drop: function( event, ui ) {
				}
			});
		});

	</script>
	
</head>
<body>
<?php
	if(isset($_GET['upload']))
	{
		if($_GET['upload'] == "true")
			echo "<p id='top'>Upload worked!</p>";
		else
			echo "<p id='top'>Upload didn't work.</p>";
	}
	if(isset($_GET['deletion']))
	{
		if($_GET['deletion'] == "true")
			echo "<p id='top'>Image deleted!</p>";
		else
			echo "<p id='top'>No deletion.</p>";
	}
?>
	<div ID="tumbnails">
<?php
	$imagesDir = opendir("images/");
	
	while ($image = readdir($imagesDir)){
		if ($image != '.' && $image != '..'){
			echo '<a class="gallery" rel="gallery" href="images/' . $image . '" title="Campus Wien im Herbst.">
			<img src="images/' . $image . '" alt="" />
			</a>';
			echo	'<a href="delete.php?delete=' . $image.'">D</a>
					<a href="edit.php?edit=' . $image.'">E</a>
					<a href="rename.php?rename=' . $image.'">R</a>';
		}
	}
	closedir($imagesDir);
?>
	</div>
	<div id="uploadForm">
		<form enctype="multipart/form-data" method="post" action="upload.php">
			File to upload: <input type="file" name="picture"><br>
			<input type="submit" value="Upload File">
		</form>
	</div> 
	<div id="dropbox" class="ui-widget-header">
	
	</div>
</body>
</html>