<?php
	function registerUser ($username, $password){
		$db = mysqli_connect( 'localhost', 'root', '', 'webtop' );
		if (mysqli_connect_errno() != 0){
			echo "Could not establish connection to database";
		}
		else {
		//The actual function
			$sqlUserName = "Select * FROM user WHERE Username = '$username'";
			$result = $db->query($sqlUserName);
			if($result && $result->num_rows)
				echo "This username already exists";
			else{
				$sqlRegData =
				"Insert INTO user (Username, Password)
				values ('$username', '$password')";
				$db->query($sqlRegData);
			}
		}
	}
?>

<html>
<head></head>
<body>
	<form action="webtop.php?register" method="post">
		<fieldset>
			<legend>Registration</legend>
			<table>
				<tr>
					<td>Username:</td>
					<td><input type="text" name="newusername"></td>
				</tr>
				<tr>
					<td>Password:</td>
					<td><input type="password" name="newuserpassword"></td>
				</tr>
<!--
			Add all the other fields. This is boring.
				<tr>
					<td>First Name:</td>
					<td><input type="text" name="vorname"></td>
				<tr>
				<tr>
					<td>First Name:</td>
					<td><input type="text" name="vorname"></td>
				<tr>
				<tr>
					<td>Last Name:</td>
					<td><input type="text" name="nachname"></td>
				<tr>
-->
			</table>
			<p><input type="submit" value="Register">
			<input type="reset" name="Reset"></p>
		</fieldset>
	</form>
	
<?php
	if(isset($_POST['newusername']) && isset($_POST['newuserpassword']))
		registerUser($_POST['newusername'], md5($_POST['newuserpassword']));
?>