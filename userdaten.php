<?php
	if (isset($_COOKIE)) echo '<p>' . 'Name: ' . $_COOKIE['username'] . '</p>';
	else echo '<p>' . 'Name: ' . $_SESSION['username'] . '</p>';
	include 'logout.php';
?>