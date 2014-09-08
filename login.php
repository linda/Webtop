<?php
		// ============================
		// Contains both php function for login and 
		// HTML part of the login form.
		// Also contains GET link to the registration form.
		// ============================	


		function authenticateuser($user, $password){
			// ============================
			// If possible later replace this simple authentication with one using LDAP
			// ============================	
			if( ($user == "Marie") && ($password == "aramis") ){
				return TRUE;
			}
			// ldap_connect();
			// ldap_bind();
			// ldap_close();
			// ============================
			// Second step, look up in db
			// ============================	
			else
			{
				$db = mysqli_connect( 'localhost', 'root', '', 'webtop' );
				if (mysqli_connect_errno() == 0){
					echo "connection works";
				}
				else {
					echo 'no connection';
				}
				if(isset($db)){
					$sql = "Select * FROM user WHERE username ='$user'";
					$result = $db->query($sql);
					if($row = $result->fetch_object()){
							if (md5($password) == $row->Password)
								return TRUE;
							else return FALSE;
						}
					else return FALSE;
					}
				else echo "what db?";
				return FALSE;
			}
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
						<td colspan="2"><input type="checkbox" name="stayloggedin" value="ja"> Stay logged in</td>
					</tr>
				</table>

				<p><input type="submit" value="Login">
				<input type="reset" name="Zuruecksetzen"></p>
			</fieldset>
		</form>
		<a href="webtop.php?register">Register</a>
	<?php
		if (isset($_POST['username']) && isset ($_POST['password'])){
			$who = $_POST['username'];
			$how = $_POST['password'];
			if ( authenticateuser($who, $how) == TRUE) {
				$_SESSION['username'] = $who;
				if(isset($_POST['stayloggedin'])){
					setcookie('username', $_POST['username'], time()+60000);
				}
				else if(isset($_POST['username'])){
					setcookie('username', "");
				}
				header( 'Location: webtop.php' ) ;
				
				} else $wronglogin = 'Wrong username and password combination. ';
		}
?>