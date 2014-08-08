<?php
		function authenticateuser($user, $password){
			if( ($user == "Marie") && ($password == "aramis") ){
				return TRUE;
			}
			else return FALSE;
		}
?>


		<form action="webtop.php" method="post">
			<fieldset>
				<legend>Login</legend>
				<table>
					<tr>
						<td>Username:</td>
						<td><input type="text" name="username"></td>
					</tr>
					<tr>
						<td>Password:</td>
						<td><input type="password" name="password"></td>
					</tr>
					<tr>
						<td colspan="2"><input type="checkbox" name="stayloggedin" value="ja"> Eingelogged bleiben?</td>
					</tr>
				</table>

				<p><input type="submit" value="Login">
				<input type="reset" name="Zuruecksetzen"></p>
			</fieldset>
		</form>
	<?php

		if ($_POST!=NULL){
			$who = $_POST['username'];
			$how = $_POST['password'];

			if ( authenticateuser($who, $how) == TRUE) {
				$_SESSION['username'] = $who;
				$_SESSION['dialog'] = "true";
				header( 'Location: webtop.php' ) ;

				} else $wronglogin = 'Wrong username and password combination. ';
		}
?>