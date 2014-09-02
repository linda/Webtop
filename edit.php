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
	if(isset($_POST['grey']))
		$effect = $_POST['grey'];
	else $effect='default';
	
	echo "Page for editing this image: " . $imagetoedit . "<br>";
	echo "<img src='imagetoedit.php?edit=$imagetoedit&effect=$effect'>";
?>
<html>
<body>
	<form id="greyscale" method="post" action="edit.php<?php echo '?edit='.$imagetoedit?>" name="grey">
		<input type="submit" name="grey" value="grey">
	</form>
</body>
</html>
