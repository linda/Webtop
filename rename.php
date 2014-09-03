<?php
	session_start();
	require_once('FirePHPCore/FirePHP.class.php');
	require_once('FirePHPCore/fb.php');
	ob_start();	
	fb($_GET, "Get-Array: ");

	// ============================
	// Rename the image sent with GET
	// ============================
		$imagetorename = $_GET['rename'];
		// $imageSeparated = explode(".", $imagetorename);
		// $imageExtension = $imageSeparated[1];
		// $imageName = $imageSeparated[0];
		echo "Page for renaming this image: " . $imagetorename . "<br>";
		
	if(isset($_POST['newname'])){
		$newName = $_POST['newname'];
		if (rename('images/'.$imagetorename, 'images/'.$newName))
			echo "Image successfully renamed to " . $newName;
		else echo "Could not rename";
	}
?>
<html>
<body>
		<form action="rename.php<?php echo'?rename='.$imagetorename; ?>" method="POST">
			New name: <input type="text" name="newname">
			<p><input type="submit" value="rename">
	</form>
	<a href="photoapp.php">Back to overview</a>
</body>
</html>	