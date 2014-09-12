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
	$effect='';
	$number = '';
	if(isset($_POST['effect'])){
		$effect = $_POST['effect'];
		if(isset($_POST['number']))
			$number = $_POST['number'];
	}
	echo "Page for editing this image: " . $imagetoedit . "<br>";
	echo "<img src='imagetoedit.php?edit=$imagetoedit&effect=$effect&number=$number'>";
?>
<html>
<body>
	<form id="greyscale" method="post" action="edit.php<?php echo '?edit='.$imagetoedit?>">
		<input type="submit" name="effect" value="grey">
	</form>
	<form id="brightness" method="post" action="edit.php<?php echo '?edit='.$imagetoedit?>">
		<input type="text" name="number" size="3">
		<input type="submit" name="effect" value="brighter">
	</form>
	<?php
	// ============================
	// Can only undo one edit, so hide "undo" botton if it will have no effect
	// ============================	
	if($effect!='undo')
		echo'<form id="default" method="post" action="edit.php?edit='.$imagetoedit.'">
		<input type="submit" name="effect" value="undo">
	</form>'
	?>
	<a href="photoapp.php">Back to overview</a>
</body>
</html>
