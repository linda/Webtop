<?php
	session_start();
	require_once('FirePHPCore/FirePHP.class.php');
	require_once('FirePHPCore/fb.php');
	ob_start();	
	fb($_GET, "Get-Array: ");
	fb($_POST, "POST-Array: ");

	// ============================
	// Edit the image sent by GET
	// ============================	
	$imagetoedit = $_GET['edit'];
	if(isset($_POST['effect']))
		$effect = $_POST['effect'];
	else $effect='default';
	
	echo "Page for editing this image: " . $imagetoedit . "<br>";
	echo "<img src='imagetoedit.php?edit=$imagetoedit&effect=$effect'>";
?>
<html>
<body>
	<form id="greyscale" method="post" action="edit.php<?php echo '?edit='.$imagetoedit?>" name="grey">
		<input type="submit" name="effect" value="grey">
	</form>
	<form id="brightness" method="post" action="edit.php<?php echo '?edit='.$imagetoedit?>" name="brighter">
		<input type="submit" name="effect" value="brighter">
	</form>
	<form id="default" method="post" action="edit.php<?php echo '?edit='.$imagetoedit?>">
		<input type="submit" name="effect" value="No filters">
	</form>
	<a href="photoapp.php">Back to overview</a>
</body>
</html>
