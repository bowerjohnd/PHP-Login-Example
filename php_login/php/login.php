<?php

require 'classes/Pdo_methods.php';

class DBComm_Member_Login extends PdoMethods {

	function checkLoginCredentials() {
		
		$records = "";

		$pdo = new PdoMethods();

		$sql = 'SELECT * FROM members where username = :username';
		
		$bindings = [
			[':username',$_POST['username'],'str']
		];

		try {
			$records = $pdo->selectBinded($sql, $bindings);

			if($records === 'error'){
				return 'There was an error logging in.';
			}
			else {
				$this->loginUser($records);
			}
		
		} catch (Exception $e) {
			echo "There was an error.";
		}

	}

	function loginUser($records) {
	
		$hashPass = $records['0']['password'];
		
		if (password_verify($_POST['password'], $hashPass)) {

			//echo "Password is correct";
			
			$_SESSION['userId'] = $records['0']['userId'];
			$_SESSION['username'] = $records['0']['username'];
			$_SESSION['email'] = $records['0']['email'];
			$_SESSION['login_type'] = $records['0']['login_type'];

			header("Location: index.php?page=home");

		} else {
			header("Location: index.php?page=login");
		}
			

	}	





	function displayLogin() {
		$display = "";

		$display .= '<p><form method="post" action="index.php?page=login">'

			. '<label for="username">User: </label>'
			. '<input type="text" id="username" name="username"><br>'				

			. '<label for="password">Password: </label>'
			. '<input type="password" id="password" name="password"><br>'

			. '<input type="submit" name="submit_login" id="submit_login">'
			. '</form></p>'
			;
	
		return $display;
	}
}
?>
