<html>
<head></head>
<body>
	<form action="registration.php" method="post">
		<fieldset>
			<legend>Registration</legend>
			<table>
				<tr>
					<td>Username:</td>
					<td><input type="text" name="username"></td>
				</tr>
				<tr>
					<td>Password:</td>
					<td><input type="password" name="password"></td>
				</tr>
			</table>

			<p><input type="submit" value="Registration">
			<input type="reset" name="Reset"></p>
		</fieldset>
	</form>
	<?php
?>